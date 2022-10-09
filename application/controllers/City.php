<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {

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
            $sourceLocation = $this->config->item("city_listing");
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


        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("name"=>$this->lang->line('col_cityName')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('city/view',false,true),
            "Insert" => $this->isPermission('city/create',false,true),
            "Edit"   => $this->isPermission('city/edit',false,true),
            "Delete" => $this->isPermission('city/delete',false,true)
        );

        $SearchFilters = array(

            array(
                'label'         => 'City Name',
                'placeholder'   => 'Enter City Name',
                'name'          => 'condition',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig['PageTitle'] = $this->lang->line('menu_city');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_City');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        $this->data["action"] = "add_record";

        if ($this->input->post('name'))
        {
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $sourceLocation = $this->config->item("city_create");
            $sendData = http_build_query($this->input->post());
            $response = $this->restservice->post($sourceLocation, $headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('City');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('city/create', $this->data);
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "view_record";

        if (isset($id) AND $id !='')
        {
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $sourceLocation = $this->config->item("city_view");
            $sourceLocation .="/".$id;
            $response = $this->restservice->get($sourceLocation, $headers,'');
            $response->token = $this->security->get_csrf_hash();
            $this->data['data'] = $response;

        }

        $this->load->view('city/create', $this->data);
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "edit_record";

        $headers = array("user" => $this->user, "pass" => $this->pass);
        if (isset($id) AND $id !='')
        {
            $sourceLocation = $this->config->item("city_view");
            $sourceLocation .="/".$id;
            $response = $this->restservice->get($sourceLocation, $headers,'');
            $response->token = $this->security->get_csrf_hash();
            $this->data['data'] = $response;

        }

        if ($this->input->post('name'))
        {
            $_POST['id'] = $id;
            $sourceLocation = $this->config->item("city_update");
            $sendData = http_build_query($this->input->post());
            $response = $this->restservice->post($sourceLocation, $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('City');
            }
            echo json_encode($response);
            return TRUE;
        }

        $this->load->view('city/create', $this->data);
    }

    public function delete()
    {
        if($this->input->post('id'))
        {
            $sourceLocation = $this->config->item("city_delete");
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $sourceLocation .='/'.base64_decode($this->input->post('id'));
            $response = $this->restservice->get($sourceLocation, $headers,'');
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }

    }




}
