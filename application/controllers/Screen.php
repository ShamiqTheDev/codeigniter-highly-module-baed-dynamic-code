<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Screen extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;
        $this->headers = array("user" => $this->config->item("pakre_username"), "pass" => $this->config->item("pakre_password"));

    }
    public function index()
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data'))
        {

            $rowperpage = 10;
            $pageNo  = $this->input->post('currentPage');

            if (!empty($pageNo)) {
                $_POST['currentPage'] = $pageNo;
                $_POST['itemsPerPages'] = $rowperpage;
            }
            $_POST = array_merge($_POST,$this->config->item('listing'));
            $sendData = http_build_query($_POST);
            $response = new StdClass();
            $response = $this->restservice->post($this->config->item("Screen_listing"), $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();


            $getResponce["get_data"] = $response;
            $getResponce["get_csrf_hash"] = $token;

            echo json_encode($getResponce);
            return TRUE;
        }

        $SearchFilters = array(

                array(
                        'label'         => 'Screen Name',
                        'placeholder'   => 'Enter Screen Name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'required'      => true,

                ),
        );

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("name"=>$this->lang->line('col_screenName'),"moduleDTO_moduleName"=>$this->lang->line('col_moduleName')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('screen/view',false,true),
            "Insert" => $this->isPermission('screen/create',false,true),
            "Edit"   => $this->isPermission('screen/edit',false,true),
            "Delete" => $this->isPermission('screen/delete',false,true)
        );

        $ListingConfig['PageTitle'] = $this->lang->line('menu_screen');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_screen');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        $this->data["action"] = "add_record";
        $this->data['Modules'] = $this->restservice->get($this->config->item("module_getAll"), $this->headers);
        if ($this->input->post('module'))
        {
            $_POST['moduleDTO.id'] = $this->input->post('module');
            unset($_POST['module']);
            $sendData = http_build_query($this->input->post());
            $response = $this->restservice->post($this->config->item("Screen_create"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('Screen');
            }
            echo json_encode($response);
            return TRUE;
        }

        $this->load->view('screen_form', $this->data);
    }

    public function view($id)
    {
        $this->data["action"] = "view_record";
        $response = $this->restservice->get($this->config->item("Screen_view")."/".base64_decode($id),$this->headers);
        $this->data['Modules'] = $this->restservice->get($this->config->item("module_getAll"), $this->headers);
        $this->data['data'] = $response;
        $this->load->view('screen_form', $this->data);
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "edit_record";
        $this->data['Modules'] = $this->restservice->get($this->config->item("module_getAll"), $this->headers);
        if ($this->input->post('module'))
        {
            $_POST['moduleDTO.id'] = $this->input->post('module');
            unset($_POST['module']);
            $sendData = $this->input->post();
            $sendData['id'] = $id;
            $sendData = http_build_query($sendData);
            $response = $this->restservice->post($this->config->item("Screen_update"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('Screen');
            }
            echo json_encode($response);
            return TRUE;
        }

        $response = $this->restservice->get($this->config->item("Screen_view")."/".($id),$this->headers);
        $this->data['data'] = $response;
        $this->load->view('screen_form', $this->data);
    }

    public function delete()
    {

        if ($this->input->post('id')) {

            $id = base64_decode($this->input->post('id'));
            $sendData = http_build_query(array("id"=>$id));
            $response = $this->restservice->get($this->config->item("Screen_delete")."/".$id, $this->headers,$sendData);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }



}
