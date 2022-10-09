<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;
        $this->headers = array("user" => $this->config->item("pakre_username"), "pass" => $this->config->item("pakre_password"));

    }

    public function index($pageNo='')
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data'))
        {
            if (!empty($pageNo)) {
                $_POST['totalPages'] = $pageNo;
            }
            $_POST = array_merge($_POST,$this->config->item('listing'));
            $sourceLocation = $this->config->item("module_listing");
            $sendData = http_build_query($_POST);
            $response = new StdClass();
            $response = $this->restservice->post($sourceLocation, $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();
            $get_responce["get_data"] = $response;
            $get_responce["get_csrf_hash"] = $token;
            echo json_encode($get_responce);
            return TRUE;

        }

        $SearchFilters = array(

            array(
                'label'         => 'Module Name',
                'placeholder'   => 'Enter Module Name',
                'name'          => 'name',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("moduleName"=>$this->lang->line('col_moduleName'),"description"=>$this->lang->line('col_description')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('module/view',false,true),
            "Insert" => $this->isPermission('module/create',false,true),
            "Edit"   => $this->isPermission('module/edit',false,true),
            "Delete" => $this->isPermission('module/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_module');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_module');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }


    public function create()
    {

        $this->data["action"] = "add_record";
        if (isset($_POST["moduleName"]))
        {
            $sendData = http_build_query($_POST);
            $response = $this->restservice->post($this->config->item("module_create"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('Module');
            }

            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('module/create', $this->data);
    }
    public function view($module_id)
    {
        $module_id = base64_decode($module_id);

        $this->data["action"] = "view_record";
        if (isset($module_id) AND $module_id !='')
        {
            $this->data['module_data'] = $this->restservice->get($this->config->item("module_view")."/".$module_id, $this->headers);

        }
        $this->load->view('module/create', $this->data);
    }

    public function edit($module_id)
    {
        $module_id = base64_decode($module_id);
        $this->data["action"] = "edit_record";

        if (isset($module_id) AND $module_id !='')
        {
             $this->data['module_data'] = $this->restservice->get($this->config->item("module_view")."/".$module_id, $this->headers);

        }

        if (isset($_POST["moduleName"]))
        {

            $sendData = http_build_query($this->input->post());
            $sendData .= "&id=".$module_id;
            $response = $this->restservice->post($this->config->item("module_update"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('Module');
            }
            echo json_encode($response);
            return TRUE;
        }

        $this->load->view('module/create', $this->data);
    }


    public function delete()
    {
        if($this->input->post('id'))
        {
            $sourceLocation = $this->config->item("module_delete");
            $sourceLocation .='/'.base64_decode($this->input->post('id'));
            $response = $this->restservice->get($sourceLocation, $this->headers,'');
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }

    }


    public function get() 
    {
        return $this->getData('module_getAll');   
    }




}
