<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ConditionType extends CI_Controller {

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
            $sourceLocation = $this->config->item("conditionType_listing");
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $sendData = http_build_query($_POST);
            $response = new StdClass();
            $response = $this->restservice->post($sourceLocation, $headers, $sendData);
            $token = $this->security->get_csrf_hash();
            $get_responce["get_data"] = $response;
            $get_responce["get_csrf_hash"] = $token;
            echo json_encode($get_responce);
            return TRUE;
        }

        $SearchFilters = array(

            array(
                'label'         => 'Condition Type',
                'placeholder'   => 'Enter Condition Type',
                'name'          => 'conditionType',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("conditionType"=>$this->lang->line('col_conditionType')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('conditionType/view',false,true),
            "Insert" => $this->isPermission('conditionType/create',false,true),
            "Edit"   => $this->isPermission('conditionType/edit',false,true),
            "Delete" => $this->isPermission('conditionType/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_conditionstype');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_conditionType');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        $this->data["action"] = "add_record";

        if ($this->input->post('conditionType'))
        {
            $sendData = http_build_query($this->input->post());
            $response = $this->restservice->post($this->config->item("conditionType_create"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('ConditionType');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('conditiontype_form', $this->data);
    }

    public function view($id)
    {
        $this->data["action"] = "view_record";
        $response = $this->restservice->get($this->config->item("conditionType_view")."/".base64_decode($id),$this->headers);
        $this->data['data'] = $response;
        $this->load->view('conditiontype_form', $this->data);
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "edit_record";
        if ($this->input->post('conditionType'))
        {
            $sendData = http_build_query($this->input->post());
            $sendData .= "&id=".$id;
            $response = $this->restservice->post($this->config->item("conditionType_update"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('ConditionType');
            }
            echo json_encode($response);
            return TRUE;
        }

        $response = $this->restservice->get($this->config->item("conditionType_view")."/".($id),$this->headers);
        $this->data['data'] = $response;
        $this->load->view('conditiontype_form', $this->data);
    }

    public function delete()
    {

        if ($this->input->post('id')) {

            $id = base64_decode($this->input->post('id'));
            $response = $this->restservice->get($this->config->item("conditionType_delete"). "/" . $id, $this->headers);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

    public function get() 
    {
        return $this->getData('conditionTypes');
    }

}
