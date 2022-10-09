<?php

/*
 * Class: RestService
 * Usage: Communicate with Given URL to get the desired Record
 * Returns: json object
 * Exception: Dies returning a JSON object with the error
 * Notes: Also connects to the database to read user information
 */

class RestService {

    public function __construct() {
        $this->ci = & get_instance();
    }

    public function get($service_url, $header, $data = NULL) {
        $userData = isset($_SESSION['userData'])?$_SESSION['userData']:'';
        $token = isset($userData->token)?$userData->token:'';
        $authorization = 'Authorization: '.$token;
        $curl = curl_init($service_url);
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, $header['user'] . ":" . $header['pass']);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded' , $authorization ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        if ($curl_response === false)
        {
            // return 'Curl error: ' . curl_error($curl);
        }

        curl_close($curl);
        $this->maintainLogs($service_url, $header, $data, $response);
        return $response;
    }

    public function post($location, $header, $data) {
        $userData = isset($_SESSION['userData'])?$_SESSION['userData']:'';
        $token = isset($userData->token)?$userData->token:'';
        $authorization = 'Authorization: '.$token;

        $curl = curl_init();
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, $header['user'] . ":" . $header['pass']); //Your credentials goes here
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded' , $authorization ));
        curl_setopt($curl, CURLOPT_URL, $location);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        if ($curl_response === false){
            // return 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);
        $this->maintainLogs($location, $header, $data, $response);
        return $response;
    }
    public function post_multipart($location, $header, $data)
    {
        $userData = isset($_SESSION['userData'])?$_SESSION['userData']:'';
        $token = isset($userData->token)?$userData->token:'';
        $authorization = 'Authorization: '.$token;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data', $authorization ));
        curl_setopt($curl, CURLOPT_URL, $location);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        if ($curl_response === false){
            return 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);
        $this->maintainLogs($location, $header, $data, $response);
        return $response;
    }

    public function postJson($location, $header, $data)
    {
        $userData = isset($_SESSION['userData'])?$_SESSION['userData']:'';
        $token = isset($userData->token)?$userData->token:'';
        $authorization = 'Authorization: '.$token;

        $ch = curl_init($location);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', $authorization));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_response = curl_exec($ch);
        if ($curl_response === false){
            return 'Curl error: ' . curl_error($ch);
        }
        $response = json_decode($curl_response);
        curl_close($ch);

        $this->maintainLogs($location, $header, $data, $response);
        return $response;

    }

    public function put($location, $header, $data) {


        // if(isset($header['pass']) && $header['pass'] != NULL){
        //     $this->ci->passwordencryption->setData($header['pass']);
        //     $header['pass'] = $this->ci->passwordencryption->decrypt();
        // }
        // json encode data

        $data_string = json_encode($data);
        //echo $location;
        // set up the curl resource
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $header['user'] . ":" . $header['pass']); //Your credentials goes here
        curl_setopt($curl, CURLOPT_URL, $location);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        curl_close($curl);

        $this->maintainLogs($location, $header, $data_string, $response);
        return $response;
    }

    /**
     *  Example API call PUT
     *  Delete Record from Database
     */
    public function delete($location, $header, $data) {

        $userData = isset($_SESSION['userData'])?$_SESSION['userData']:'';
        $token = isset($userData->token)?$userData->token:'';
        $authorization = 'Authorization: '.$token;

        $curl = curl_init();
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, $header['user'] . ":" . $header['pass']); //Your credentials goes here
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded' , $authorization ));
        curl_setopt($curl, CURLOPT_URL, $location);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE"); // it should be delete but with delete Custom Request not accepting
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        $curl_response = curl_exec($curl);
        $response = json_decode($curl_response);
        curl_close($curl);

        $this->maintainLogs($location, $header, $data, $response);

        return $response;
    }

    /**
     *  Example API call post
     *  Fetching Employee image in binary format
     */
    public function getEmployeeImageBinary($location, $header, $data) {

        $data_string = json_encode($data);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $header['user'] . ":" . $header['pass']); //Your credentials goes here
        curl_setopt($curl, CURLOPT_URL, $location);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_ENCODING, '');
        $curl_response = curl_exec($curl);
        curl_close($curl);
        return $curl_response;
    }

    public function maintainLogs($location, $header, $data_string, $response) {
        /*         * *****************  TO CHECK LOGS  ******************** */

        // if(isset($header['pass']) && $header['pass'] != NULL){
        //     $this->ci->passwordencryption->setData($header['pass']);
        //     $header['pass'] = $this->ci->passwordencryption->decrypt();
        // }


        if (config_item('customLogs')) {
            // create or add response to log file
            $time = date("Y-m-d h:i:s D", time());
            $dirPath = dirname(__DIR__) . "\logs";
            if (!is_dir($dirPath)) {
                mkdir($dirPath, 0777);
            }
            //$requestPath = $dirPath . "/RequestLogs.txt";
            $responsePath = $dirPath . "/WebServicesEmpLogs.txt";

            $resp = "\r\n-----------------------------------\r\n";
            $resp .= $time . "\r\n";
            $resp .= "-----------------------------------\r\n";
            $resp .= $location . "\r\n";
            $resp .= "-----------------------------------\r\n";
            $resp .= json_encode($header) . "\r\n";
            $resp .= "-----------------------------------\r\n";
            $resp .= "Requested Data:" . json_encode($data_string) . "\r\n";
            $resp .= "-----------------------------------\r\n";
            $resp .= "Response Data:" . json_encode($response) . "\r\n";
            $resp .= "####################################\r\n";


            // $file = (file_exists($responsePath)) ? fopen($responsePath, "a+") : fopen($responsePath, "w+");
            // fwrite($file, $resp);
            // fclose($file);
            // chmod($responsePath, 0777);
        }
    }

    public function test() {
        echo "CALLED";
    }

    function docs_uploading_function($location, $header, $data) {

        // if(isset($header['pass']) && $header['pass'] != NULL){
        //     $this->ci->passwordencryption->setData($header['pass']);
        //     $header['pass'] = $this->ci->passwordencryption->decrypt();
        // }



        $userData = isset($_SESSION['userData'])?$_SESSION['userData']:'';
        $token = isset($userData->token)?$userData->token:'';
        $authorization = 'Authorization: '.$token;


        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data", $authorization));
        curl_setopt($curl, CURLOPT_URL, $location);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        // curl_setopt($curl, CURLOPT_HEADER, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($curl);
        if ($response === false){
            return 'Curl error: ' . curl_error($curl);
        }
        curl_close($curl);

        $this->maintainLogs($location, $header, json_encode($data), $response);

        return $response;


//        $curl = curl_init();
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, $header['user'] . ":" . $header['pass']); //Your credentials goes here
//        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data", $authorization));
//        curl_setopt($curl, CURLOPT_URL, $location);
//        curl_setopt($curl, CURLOPT_POST, 1);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
//        $response = curl_exec($curl);
//        curl_close($curl);
//
//        $this->maintainLogs($location, $header, json_encode($data), $response);
//
//        return $response;
    }

    function efile_post($location, $header, $data, $maintainLogsAction = null) {
        $data_string = json_encode($data);

        $userData = isset($_SESSION['userData'])?$_SESSION['userData']:'';
        $token = isset($userData->token)?$userData->token:'';
        $authorization = 'Authorization: '.$token;
        
        $curl = curl_init();
        // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // curl_setopt($curl, CURLOPT_USERPWD, $header['user'] . ":" . $header['pass']); //Your credentials goes here
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded' , $authorization ));
        curl_setopt($curl, CURLOPT_URL, $location);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        $response = curl_exec($curl);
        curl_close($curl);

        $this->maintainLogs($location, $header, $data_string, $response, $maintainLogsAction);

        return json_decode($response);
    }

}
