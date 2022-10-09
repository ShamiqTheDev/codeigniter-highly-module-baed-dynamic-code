<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RolePermissions extends CI_Controller {
    public $user;
    public $pass;

    function __construct() 
    {
        parent::__construct();
        $this->check_auth();

        $this->user = $this->config->item("pakre_username"); // check constant Auth_model.php Line# 79
        $this->pass = $this->config->item("pakre_password");
    }

    function get_permissions()
    {
        
        $link = $this->config->item("GetRolePermissions");
        $headers = array("user" => $this->user, "pass" => $this->pass);
        $data = array();
      
        $get_permissions = $this->restservice->put($link, $headers, $data);
        echo json_encode($get_permissions);
    }
    
}