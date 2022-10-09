<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TreatyCodes extends CI_Controller {

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
            $sourceLocation = $this->config->item("treatyCodes_listing");
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $_POST = array_merge($_POST,$this->config->item('listing'));
            $sendData = http_build_query($_POST);
            $response = new StdClass();
            $response = $this->restservice->post($sourceLocation, $headers, $sendData);
            $token = $this->security->get_csrf_hash();
            $get_responce["get_data"] = $response;
            $get_responce["get_csrf_hash"] = $token;
            echo json_encode($get_responce);
            return TRUE;
        }

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("treatyName"=>$this->lang->line('col_TreatyName'),"treatyType"=>$this->lang->line('col_treatyType'),"treatyCode"=>$this->lang->line('col_TreatyCode')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('treatyCodes/view',false,true),
            "Insert" => $this->isPermission('treatyCodes/create',false,true),
            "Edit"   => $this->isPermission('treatyCodes/edit',false,true),
            "Delete" => $this->isPermission('treatyCodes    /delete',false,true)
        );

        $SearchFilters = array(
            array(
                'label'         => 'Treaty Type',
                'placeholder'   => 'Enter Treaty Type',
                'name'          => 'treatyType',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
            array(
                'label'         => 'Treaty Codes',
                'placeholder'   => 'Enter Treaty Codes',
                'name'          => 'treatyCode',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_treatyCode');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $ListingConfig['PageTitle'] = $this->lang->line('menu_treatycode');
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        $this->data["action"] = "add_record";
        // $this->data['cedent_types'] =  $this->restservice->get($this->config->item("cedent_listing"), $this->headers);
        $this->data['treaty_types'] = $this->restservice->get($this->config->item("treaty_type_listing"), $this->headers);
        // $this->data['business_class'] = $this->restservice->get($this->config->item("business_listing"), $this->headers);

        if ($this->input->post('treatyCode'))
        {
            $treaty_codes_data = array(
                // 'businessClass' =>  $this->input->post('businessClass'),
                // 'cedentDTO.id' =>  $this->input->post('cedentId'),
                'treatyName' =>  $this->input->post('treatyName'),
                'treatyCode' =>  $this->input->post('treatyCode'),
                'treatyType' => $this->input->post('treatyType'));
            $sendData = http_build_query($treaty_codes_data);

            $response = $this->restservice->post($this->config->item("treatyCodes_create"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('TreatyCodes');
            }
            echo json_encode($response);
            return TRUE;
        }

        $this->load->view('treaty/treaty_codes', $this->data);
    }

    public function view($id)
    {
        $this->data["action"] = "view_record";
        $this->data['cedent_types'] =  $this->restservice->get($this->config->item("cedent_listing"), $this->headers);
        $this->data['treaty_types'] = $this->restservice->get($this->config->item("treaty_type_listing"), $this->headers);
        $this->data['business_class'] = $this->restservice->get($this->config->item("business_listing"), $this->headers);
        $this->data['data'] = $this->restservice->get($this->config->item("treatyCodes_view")."/".base64_decode($id),$this->headers);
        $this->load->view('treaty/treaty_codes', $this->data);
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "edit_record";


        $this->data['cedent_types'] =  $this->restservice->get($this->config->item("cedent_listing"), $this->headers);
        $this->data['treaty_types'] = $this->restservice->get($this->config->item("treaty_type_listing"), $this->headers);
        $this->data['business_class'] = $this->restservice->get($this->config->item("business_listing"), $this->headers);
        $this->data['data'] = $this->restservice->get($this->config->item("treatyCodes_view")."/".($id),$this->headers);

        if ($this->input->post('treatyCode'))
        {
            $treaty_codes_data = array('businessClass' =>  $this->input->post('businessClass'),
                'cedentDTO.id' =>  $this->input->post('cedentId'),
                'treatyName' =>  $this->input->post('treatyName'),
                'treatyCode' =>  $this->input->post('treatyCode'),
                'treatyType' => $this->input->post('treatyType'),"id"=>$id);
            $sendData = http_build_query($treaty_codes_data);
            $response = $this->restservice->post($this->config->item("treatyCodes_update"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('TreatyCodes');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('treaty/treaty_codes', $this->data);
    }

    public function delete()
    {
        if ($this->input->post('id'))
        {
            $id = base64_decode($this->input->post('id'));
            $response = $this->restservice->get($this->config->item("treatyCodes_delete"). "/" . $id, $this->headers);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }



}
