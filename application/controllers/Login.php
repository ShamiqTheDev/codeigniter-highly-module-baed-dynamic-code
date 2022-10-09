<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
        parent::__construct();

        // To load the CI benchmark and memory usage profiler - set 1==1.
        if (1 == 2) {
            $sections = array(
                'benchmarks' => TRUE, 'memory_usage' => TRUE,
                'config' => FALSE, 'controller_info' => FALSE, 'get' => FALSE, 'post' => FALSE, 'queries' => FALSE,
                'uri_string' => FALSE, 'http_headers' => FALSE, 'session_data' => FALSE
            );
            $this->output->set_profiler_sections($sections);
            $this->output->enable_profiler(TRUE);
        }

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;
        
        $this->user = $this->config->item("pakre_username"); // check constant Auth_model.php Line# 79
        $this->pass = $this->config->item("pakre_password");
        $this->load->model('login_model');  


	}

	public function index()
    {
 
        $this->is_Logged_in();

        if ($this->input->post('username') AND $this->input->post('password')) {

            $sendData = http_build_query($_POST); // converting $_POST to query string
            $response = $this->restservice->post($this->config->item("login"), $this->headers, $sendData);

            if (!is_object($response)) {
                $response = (object) $response;
            }

            if (isset($response->userId) && $response->code == 1) {

                $userToken = $this->login_model->tokenizeUser($response);// object of user_id and token
                $auth = $this->login_model->validateToken($userToken);

                $UserData = new stdClass();
                $UserData->userId = $response->userId;
                $UserData->userName = $response->userName;
                $UserData->email = $response->email;
                $UserData->roles_permissions = $response->roleDTO;
                $UserData->token = $response->token;

                $this->session->set_userdata('authToken',$auth->token);
                $this->session->set_userdata('userData',$UserData);
                $this->session->set_userdata('logged_in', TRUE);
                $response->path = base_url('Dashboard');
            }else{
                $response->status = 0;
                $response->code = 0;
                $response->message = "Incorrect User Name or Password";
            }
            toJson($response,1);
        }
		$this->load->view('login',$this->data);
	}

    public function forget(){
        $this->load->view('forgot_password',$this->data);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
}
