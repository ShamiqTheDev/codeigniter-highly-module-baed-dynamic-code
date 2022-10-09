<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Condition extends CI_Controller {

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
            $sourceLocation = $this->config->item("condition_listing");
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
                'label'         => 'Condition',
                'placeholder'   => 'Enter Condition',
                'name'          => 'condition',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("condition"=>$this->lang->line('col_condition'),"conditionTypeDTO_conditionType"=>$this->lang->line('col_conditionType')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('Condition/view',false,true),
            "Insert" => $this->isPermission('Condition/create',false,true),
            "Edit"   => $this->isPermission('Condition/edit',false,true),
            "Delete" => $this->isPermission('Condition/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_conditions');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_condition');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        // redirect(base_url('conditionreference/create'));
        // return TRUE;
        
        $this->data["action"] = "add_record";

        $this->data['conditionTypes'] = $this->restservice->get($this->config->item("conditionTypes"), $this->headers);

        if ($this->input->post('conditionType'))
        {
            $conditionType = explode("|",$this->input->post('conditionType'));

            if (isset($conditionType[1]) && !empty(trim($conditionType[1]))) {
                $Data = array('conditionTypeDTO.id' => $conditionType[0],'condition' => $conditionType[1]);
                $sendData = http_build_query($Data);
                $response = $this->restservice->post($this->config->item("condition_create"), $this->headers, $sendData);   
            } else {
                $response = new StdClass();
                $response->code = 0;
                $response->message = "Condition Name cannot be empty";
            }
            
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('Condition');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('condition_form', $this->data);
    }

    public function view($id)
    {
        $this->data["action"] = "view_record";
        $this->data['conditionTypes'] = $this->restservice->get($this->config->item("conditionTypes"), $this->headers);
        $this->data['data'] = $this->restservice->get($this->config->item("condition_view")."/".base64_decode($id),$this->headers);
        $this->load->view('condition_form', $this->data);
    }

    public function edit($id)
    {
        $id = base64_decode($id);
        $this->data["action"] = "edit_record";


        if ($this->input->post('conditionType'))
        {
            $conditionType = explode("|",$this->input->post('conditionType'));
            $Data = array('conditionTypeDTO.id' => $conditionType[0],'conditionTypeDTO.conditionType' => $conditionType[1],
                'condition' => $this->input->post('condition'),"id" =>$id);

            $sendData = http_build_query($Data);
            $response = $this->restservice->post($this->config->item("condition_update"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('Condition');
            }
            echo json_encode($response);
            return TRUE;
        }

        $this->data['conditionTypes'] = $this->restservice->get($this->config->item("conditionTypes"), $this->headers);
        $this->data['data'] = $this->restservice->get($this->config->item("condition_view")."/".($id),$this->headers);
        $this->load->view('condition_form', $this->data);
    }

    public function delete()
    {

        if ($this->input->post('id')) {

            $id = base64_decode($this->input->post('id'));
            $response = $this->restservice->get($this->config->item("condition_delete"). "/" . $id, $this->headers);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

    public function get($cType) 
    {
        $cType = base64_decode($cType);

        $response = $this->getData('condition_getAll' ,'' ,true,false,true);
        $data = $response['data'];
        $parsedData=[];
        foreach ($data as $d) {
            // dd($d);
            $type = $d->conditionTypeDTO->conditionType;
            $id = $d->conditionTypeDTO->id;
            if ($cType == $type) {
                $response['condition_id'] = $id;
                $parsedData[] = $d;
            }
        }
        $response['data'] = $parsedData;
        echo json_encode($response) ;   
    }

    public function getByConditionTypeId($id)
    {
        $response = $this->getData('conditionTypes_get_by_condition_type_id',$id);

        return $response;
    }



}
