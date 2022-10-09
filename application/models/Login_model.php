<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
    }



    /*
     *
     *  This method returns authenticated user data else returns false
     *
     */
    public function getTokenUser($token)
    {
        $data = FALSE;
        $query = "SELECT * FROM auth_data WHERE token='$token'";
        $authData = $this->db->query($query)->row();
        if (!empty($authData)) {
            $data = $authData;
        }
        return $data;
    }


    /*
     *
     *  This method updates user token . Return user updated token.
     *
     */
    public function tokenizeUser($data)
    {

        $insertData = [
            'user_id'   => $data->userId,
            'token'     => $data->token, // this is user authentication token.
        ];
        
        $data = $this->db->update('auth_data', $insertData);

        return $insertData['token'];
    }


    public function validateToken($token='')
    {
        $data = $this->getTokenUser($token);

        if (empty($data)) {
            return FALSE;
        }

        return $data;

    }

}
