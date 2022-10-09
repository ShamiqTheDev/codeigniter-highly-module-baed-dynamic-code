<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CurrencyRate extends CI_Controller {

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
            $sourceLocation = $this->config->item("currency_rate_listing");
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
        $ListingConfig['DataColumns'] = json_encode(array("currencyDTO_name"=>$this->lang->line('col_currency'),
                                                            "rateTypeDTO_name"=>$this->lang->line('col_rateType'),
                                                             "effectiveType"=>$this->lang->line('col_effectiveType'),
                                                             "year"=>$this->lang->line('col_year'),
                                                             "rate"=>$this->lang->line('col_rate'), 
                                                             "precisions" => $this->lang->line('col_precisions')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('currencyRate/view',false,true),
            "Insert" => $this->isPermission('currencyRate/create',false,true),
            "Edit"   => $this->isPermission('currencyRate/edit',false,true),
            "Delete" => $this->isPermission('currencyRate/delete',false,true)
        );

        $SearchFilters = array(

            array(
                'label'         => 'Currency',
                'name'          => 'currencyId',
                'type'          => 'dropdown',
                "optionValueColumn" =>"id",
                "optionTextColumn" =>"name",
                "options" => $this->restservice->get($this->config->item("currency_getAll"), $this->headers),
                'required'      => false

            ),
            array(
                'label'         => 'Rate Type',
                'name'          => 'rateTypeId',
                'type'          => 'dropdown',
                "optionValueColumn" =>"id",
                "optionTextColumn" =>"name",
                "options" => $this->restservice->get($this->config->item("rateType_getAll"), $this->headers),
                'required'      => false

            ),
            array(
                'label'         => 'Effective Type',
                'placeholder'   => 'Enter Effective Type',
                'name'          => 'effectiveType',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
            array(
                'label'         => 'Year',
                'placeholder'   => 'Enter Year',
                'name'          => 'year',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );
        
        $ListingConfig['PageTitle'] = $this->lang->line('menu_currencyrate'); 
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_currencyRate');
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        $this->data["action"] = "add_record";
        $this->data['currncy_types'] = $this->restservice->get($this->config->item("currency_getAll"), $this->headers);
        $this->data['rat_types'] = $this->restservice->get($this->config->item("rateType_getAll"), $this->headers);

        if ($this->input->post('currency'))
        {

            $data = array('currencyDTO.id' => $this->input->post('currency'),
                'effectiveFrom' => date("m/d/Y",strtotime($this->input->post('effectiveFrom'))),
                'effectiveTo' => ($this->input->post('effectiveTo')  ? date("m/d/Y",strtotime($this->input->post('effectiveTo'))) : date("m/d/Y",strtotime($this->input->post('effectiveFrom')))),
                'effectiveType' => $this->input->post('effectiveType'),
                'precisions' => $this->input->post('precisions'),
                'rate' => $this->input->post('rate'),
                'rateTypeDTO.id' => $this->input->post('rateType'),
                'year' => $this->input->post('year'),
                );

            $sendData = http_build_query($data); 
            $response = $this->restservice->post($this->config->item("currency_rate_create"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('CurrencyRate');
            }
            echo json_encode($response);
            return TRUE;
        }
        $this->load->view('currency/currency_rate_form', $this->data);
    }

    public function view($id)
    {
        $this->data["action"] = "view_record";
        $this->data['currncy_types'] = $this->restservice->get($this->config->item("currency_getAll"), $this->headers);
        $this->data['rat_types'] = $this->restservice->get($this->config->item("rateType_getAll"), $this->headers);

        $response = $this->restservice->get($this->config->item("currency_rate_view")."/".base64_decode($id),$this->headers);
        $this->data['data'] = $response;

        $this->load->view('currency/currency_rate_form', $this->data);
    }

    public function edit($id)
    {
        $id = base64_decode($id);

        $this->data["action"] = "edit_record";
        $this->data['currncy_types'] = $this->restservice->get($this->config->item("currency_getAll"), $this->headers);
        $this->data['rat_types'] = $this->restservice->get($this->config->item("rateType_getAll"), $this->headers);

        if ($this->input->post('currency'))
        {
            $data = array('currencyDTO.id' => $this->input->post('currency'),
                'effectiveFrom' => date("m/d/Y",strtotime($this->input->post('effectiveFrom'))),
                'effectiveTo' => ($this->input->post('effectiveTo')  ? date("m/d/Y",strtotime($this->input->post('effectiveTo'))) : date("m/d/Y",strtotime($this->input->post('effectiveFrom')))),
                'effectiveType' => $this->input->post('effectiveType'),
                'precisions' => $this->input->post('precisions'),
                'rate' => $this->input->post('rate'),
                'rateTypeDTO.id' => (int)$this->input->post('rateType'),
                'year' => (int)$this->input->post('year'),
                'id' => (int)$id,
            );

            $sendData = http_build_query($data);

            $response = $this->restservice->post($this->config->item("currency_rate_update"), $this->headers, $sendData);
            $response->token = $this->security->get_csrf_hash();

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('CurrencyRate');
            }
            echo json_encode($response);
            return TRUE;
        }

        $response = $this->restservice->get($this->config->item("currency_rate_view")."/".($id),$this->headers);
        $this->data['data'] = $response;
        $this->load->view('currency/currency_rate_form', $this->data);
    }

    public function delete()
    {

        if ($this->input->post('id')) {

            $id = base64_decode($this->input->post('id'));
            $response = $this->restservice->get($this->config->item("currency_rate_delete"). "/" . $id, $this->headers);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }
    public function get()
    {
        $response = $this->getData('currency_rate_getAll');
        return $response;
    }


}
