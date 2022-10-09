<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CrestaZone extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

        $this->user = $this->config->item("pakre_username"); // check constant Auth_model.php Line# 79
        $this->pass = $this->config->item("pakre_password");


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
            $sourceLocation = $this->config->item("crestaZone_listing");
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
                'label'         => 'Name',
                'placeholder'   => 'Enter Name',
                'name'          => 'zoneName',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("zoneName"=>$this->lang->line('col_name'),
        "zoneCity" =>$this->lang->line('col_cityName'),
        "zoneLat" =>$this->lang->line('col_latitude'),
        "zoneLong" =>$this->lang->line('col_longitude')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('crestaZone/view',false,true),
            "Insert" => $this->isPermission('crestaZone/create',false,true),
            "Edit"   => $this->isPermission('crestaZone/edit',false,true),
            "Delete" => $this->isPermission('crestaZone/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_crestazone');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_crestaZone');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }

    public function create()
    {

        $headers = array("user" => $this->user, "pass" => $this->pass);
        $sourceLocation = $this->config->item("city_getAll");
        $this->data['cities'] = $this->restservice->get($sourceLocation, $headers, '');
        $this->data["action"] = "add_record";

        if ($this->input->post('zoneCity'))
        {
            $sourceLocation = $this->config->item("crestaZone_create");
            $sendData = http_build_query($this->input->post());
            $response = $this->restservice->post($sourceLocation, $headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('CrestaZone');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('crestazone/create', $this->data);
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "view_record";

        $headers = array("user" => $this->user, "pass" => $this->pass);
        $sourceLocation = $this->config->item("city_getAll");
        $this->data['cities'] = $this->restservice->get($sourceLocation, $headers, '');

        if (isset($id) AND $id !='')
        {
            $sourceLocation = $this->config->item("crestaZone_view");
            $sourceLocation .="/".$id;
            $response = $this->restservice->get($sourceLocation, $headers,'');
            $response->token = $this->security->get_csrf_hash();
            $this->data['data'] = $response;

        }

        $this->load->view('crestazone/create', $this->data);
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "edit_record";

        $headers = array("user" => $this->user, "pass" => $this->pass);
        $sourceLocation = $this->config->item("city_getAll");
        $this->data['cities'] = $this->restservice->get($sourceLocation, $headers, '');

        if (isset($id) AND $id !='')
        {
            $sourceLocation = $this->config->item("crestaZone_view");
            $sourceLocation .="/".$id;
            $response = $this->restservice->get($sourceLocation, $headers,'');
            $response->token = $this->security->get_csrf_hash();
            $this->data['data'] = $response;

        }

        if ($this->input->post('zoneCity'))
        {
            $_POST['id'] = $id;
            $sourceLocation = $this->config->item("crestaZone_update");
            $sendData = http_build_query($this->input->post());
            $response = $this->restservice->post($sourceLocation, $headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('CrestaZone');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('crestazone/create', $this->data);
    }

    public function delete()
    {
        if($this->input->post('id'))
        {
            $sourceLocation = $this->config->item("crestaZone_delete");
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $sourceLocation .='/'.base64_decode($this->input->post('id'));
            $response = $this->restservice->get($sourceLocation, $headers,'');
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }

    }




}
