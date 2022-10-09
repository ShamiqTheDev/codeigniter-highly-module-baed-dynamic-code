<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TreatyParticular extends CI_Controller {

    protected $module;
	protected $headers; 

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

        $this->user = $this->config->item("pakre_username"); // check constant Auth_model.php Line# 79
        $this->pass = $this->config->item("pakre_password");
        $this->headers = array( "user" => $this->user, "pass" => $this->pass );
        $this->module = 'treatyparticular';
    }


    /*
     *
     *  Treaty Type Listing Service 
     *
     */
    public function index()
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data'))
        {
            $post = $this->input->post();
            $post = array_merge($post,$this->config->item('listing'));
            unset($post['get_data']);

            $url = $this->config->item('treaty_particular_listing_filter');
            $sendData = http_build_query($post);
            $response = $this->restservice->post($url, $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();
            $data['get_data'] = $response;
            $data['token'] = $token;
            toJson($data);
            return TRUE;
        }

        $SearchFilters = array(

            array(
                'label'         => 'Treaty Particular Name',
                'placeholder'   => 'Enter Treaty Particular Name',
                'name'          => 'name',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("name"=>$this->lang->line('col_treatyParticularName')));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('treatyparticular/view',false,true),
            "Insert" => $this->isPermission('treatyparticular/create',false,true),
            "Edit"   => $this->isPermission('treatyparticular/edit',false,true),
            "Delete" => $this->isPermission('treatyparticular/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_treatyparticular');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_treatyParticular');

        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data['ListingConfig'] = $ListingConfig;
        $this->load->view('listing', $this->data);
    }


    /*
     *
     *  Form Data 
     *
    */
    public function moduleFormData($formValues='')
    {
        $data = [
            'pageTitle' => 'Treaty Particular',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [
                    [
                        'label'         => 'Treaty Particular Name',
                        'placeholder'   => 'Enter Treaty Particular Name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            'minlength'     => 1,
                            'maxlength'     => 40,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],

                ],
            ],
        ];

        if ($formValues instanceof stdClass) {
            $formValues = (array) $formValues;
        }
        if (is_array($formValues)) {
            $inputs = $data['form']['inputs'];
            $inputWithValues = [];
            foreach ($inputs as $input) {
                if ($input['type'] == 'text' || $input['type'] == 'textarea') {
                    
                    $input['value'] = $formValues[$input['name']];
                }elseif($input['type'] == 'select'){

                    $fieldName = $input['attributes']['name'];
                    $fieldValue = getArrayChildObject($fieldName,$formValues);
                    $input['attributes']['data-select'] = !empty($fieldValue)?$fieldValue:$fieldName;
                
                }
                $inputWithValues[] = $input;
            }
            $data['form']['inputs'] = $inputWithValues;
        }
        return $data;
    }


    /**
     *
     *  Treaty Type Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('name')) {

            $sendData = http_build_query($this->input->post());
            $url = $this->config->item('treaty_particular_create');
            $response = $this->restservice->post($url, $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();

            $data['data'] = $response;
            $data['token'] = $token;
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('CurrencyRate');
            }
            toJson($data);
            return TRUE;
        }

        $html = $this->moduleFormData();
        $module = $this->module;

        $this->load->view('/form',compact('module','html'));
    }


    /*
     *
     *  Treaty Type Edit Service 
     *
     */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);
        if ($this->input->post('name')) {

            $response = $this->postData('treaty_particular_update',$this->input->post(),1,1);
            $token = $this->security->get_csrf_hash();

            $data['data'] = $response;
            $data['token'] = $token;
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('CurrencyRate');
            }
            toJson($data);
            return TRUE;
        }

        $response = $this->getData('treaty_particular_view',$id,0,0,0);
        $html = $this->moduleFormData($response);
        $module = $this->module;
        $this->load->view('/form',compact('module','html','response'));
    }

    /*
     *
     *  Treaty Type View Service 
     *
     */
    public function view($id=NULL)
    {
        $id = base64_decode($id);
        $response = $this->getData('treaty_particular_view',$id,0,0,0);
        $html = $this->moduleFormData($response);
        $module = $this->module;
        $this->load->view('/form',compact('module','html','response'));
    }


    /*
     *
     *  Treaty Type Delete Service 
     *
     */
    public function delete() 
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            $response = $this->getData('treaty_particular_delete',$id,0,0,0);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }


}