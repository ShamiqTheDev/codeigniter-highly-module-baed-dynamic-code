<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TreatySubTypes extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

        $this->headers = array("user" =>$this->config->item("pakre_username"), "pass" => $this->config->item("pakre_password"));

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
            $sourceLocation = $this->config->item("treatySubType_listing");
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
                'label'         => 'Name',
                'placeholder'   => 'Enter Name',
                'name'          => 'subTypeName',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("subTypeName"=>$this->lang->line('col_treatySubTypeName'),"status" =>$this->lang->line('col_Status')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('treatySubTypes/view',false,true),
            "Insert" => $this->isPermission('treatySubTypes/create',false,true),
            "Edit"   => $this->isPermission('treatySubTypes/edit',false,true),
            "Delete" => $this->isPermission('treatySubTypes/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_treatysubtypes');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_treatySubType');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        $this->data["action"] = "add_record";

        if ($this->input->post('subTypeName'))
        {
            $sourceLocation = $this->config->item("treatySubType_create");
            $sendData = http_build_query($this->input->post());
            $response = $this->restservice->post($sourceLocation, $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('TreatySubTypes');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('treaty/treaty_subtype_form', $this->data);
    }

    public function view($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "view_record";

        if (isset($id) AND $id !='')
        {
            $sourceLocation = $this->config->item("treatySubType_view");
            $sourceLocation .="/".$id;
            $response = $this->restservice->get($sourceLocation, $this->headers,'');
            $response->token = $this->security->get_csrf_hash();
            $this->data['data'] = $response;

        }

        $this->load->view('treaty/treaty_subtype_form', $this->data);
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "edit_record";


        if (isset($id) AND $id !='')
        {
            $sourceLocation = $this->config->item("treatySubType_view");
            $sourceLocation .="/".$id;
            $response = $this->restservice->get($sourceLocation, $this->headers,'');
            $response->token = $this->security->get_csrf_hash();
            $this->data['data'] = $response;

        }
        if ($this->input->post('subTypeName'))
        {
            $_POST['id'] = $id;
            $sourceLocation = $this->config->item("treatySubType_update");
            $sendData = http_build_query($this->input->post());
            $response = $this->restservice->post($sourceLocation, $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('TreatySubTypes');
            }
            echo json_encode($response);
            return TRUE;
        }

        $this->load->view('treaty/treaty_subtype_form', $this->data);
    }

    public function delete()
    {
        if($this->input->post('id'))
        {
            $sourceLocation = $this->config->item("treatySubType_delete");
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $sourceLocation .='/'.base64_decode($this->input->post('id'));
            $response = $this->restservice->get($sourceLocation, $headers,'');
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }

    }

    public function get()
    {
        $response = $this->getData('treatySubType_getAll');
        return $response;
    }




}
