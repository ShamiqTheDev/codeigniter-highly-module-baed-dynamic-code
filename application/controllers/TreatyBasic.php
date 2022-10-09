<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TreatyBasic extends CI_Controller {

    protected $module;
	protected $headers; 

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

        $this->module = strtolower(__CLASS__);
    }

    /*
     *
     *  Treaty Basic Listing Service 
     *
     */
    public function index()
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data')) {

            $response = $this->postData('treaty_basic_listing_filter',$this->input->post(),true);
            $token = $this->security->get_csrf_hash();

            $this->data['get_data'] = $response['data'];
            $this->data['token'] = $token;

            toJson($this->data);
            return TRUE;
        }

        $ListingConfig = [];
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode([
            'name'          => 'Treaty Name',
            'treatyDate'    => 'Treaty Date',
            'year'          => 'Treaty Year',
        ]);
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('TreatyBasic/view',false,true),
            "Insert" => $this->isPermission('TreatyBasic/create',false,true),
            "Edit"   => $this->isPermission('TreatyBasic/edit',false,true),
            "Delete" => $this->isPermission('TreatyBasic/delete',false,true)
        );
        $ListingConfig['PageTitle'] = "Treaty Basic";

        $module = $this->module;

        $this->load->view('listing', compact('module','ListingConfig'));
    }

    /**
     *
     *  Treaty Basic Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('name')) {

            $response = $this->postData('treaty_basic_create',$this->input->post(),1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;
            
            toJson($this->data);
            return TRUE;
        }

        $html = $this->moduleFormData();
        $module = $this->module;
        
        $this->load->view('/form',compact('module','html'));
    }

    /**
     *
     *   This Module Create Form
     *
    */
    public function moduleFormData($formValues='')
    {
        $data = [
            'pageTitle' => 'Treaty Basic',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [

                    [
                        'label'         => 'Treaty Basic Name',
                        'placeholder'   => 'Treaty Basic Name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            'minlength'     => 1,
                            'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'type'          => 'select',
                        'label'         => 'Cedent',
                        'attributes'    =>[
                            'placeholder'   => 'Select Cedent',
                            'name'          => 'cedentDTO.id',
                            'class'         => 'form-control select2 cedentOptions',
                        ],
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'type'          => 'select',
                        'label'         => 'Treaty Year',
                        'attributes'    => [
                            'placeholder'   => 'Treaty Year',
                            'name'          => 'year',
                            'class'         => 'form-control select2',
                        ],
                        'options'       => years(),
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ], 
                    [
                        'label'         => 'Treaty Date',
                        'placeholder'   => 'Treaty Date',
                        'name'          => 'treatyDate',
                        'type'          => 'text',
                        'class'         => 'form-control datepicker',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],             
                    [
                        'label'         => 'Note',
                        'placeholder'   => 'Treaty Basic Note',
                        'name'          => 'note',
                        'type'          => 'textarea',
                        'rows'          => '3',
                        'class'         => 'form-control',
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
     *  Treaty Basic Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);
        if ($this->input->post('id')) {

            $response = $this->postData('treaty_basic_update',$this->input->post(),1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;
            
            toJson($this->data);
            return TRUE;
        }
        $response = $this->getData('treaty_basic_view', $id, false, false);

        $response = $response['data'];
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->data =  compact('module','html','response');
        $this->load->view('form',$this->data);
    }

    /**
     *
     *  Treaty Basic View Service 
     *
    */
    public function view($id=NULL)
    {
        $id = base64_decode($id);

        $response = $this->getData('treaty_basic_view',$id,0,0,0);
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->load->view($this->module.'/form',compact('module','html','response'));
    }

    /**
     *
     *  Treaty Basic Delete Service 
     *
    */
    public function delete() 
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            $response = $this->getData('treaty_basic_delete',$id,0,0,0);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }


    /**
     *
     *  Method for Dropdown Calls.
     *
    */
    public function getCedents()
    {
        return $this->getData('cedent_listing');
    }


}