<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GlCode extends CI_Controller {

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
     *  GL Code Listing Service 
     *
    */
    public function index()
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data')) {
            $post = $this->input->post();

            $response = $this->postData('glcodes_listing_filter',$post,true);

            $token = $this->security->get_csrf_hash();

            $this->data['get_data'] = $response['data'];
            $this->data['token'] = $token;
            
            toJson($this->data);
            return TRUE;
        }

        $ListingConfig = [];
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode([
            'glCode'    => 'Gl Code',
            'glDate'    => 'Gl Date',
            'glHeader'  => 'Gl Header',
        ]);
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('GlCode/view',false,true),
            "Insert" => $this->isPermission('GlCode/create',false,true),
            "Edit"   => $this->isPermission('GlCode/edit',false,true),
            "Delete" => $this->isPermission('GlCode/delete',false,true)
        );
        $SearchFilters = array(

            array(
                'label'         => 'GI Code',
                'placeholder'   => 'Enter GI Code',
                'name'          => 'glCode',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig['PageTitle'] = "GL Code";

        $ListingConfig['SearchFilters'] = $SearchFilters;
        $module = $this->module;

        $this->data = compact('module','ListingConfig');
        $this->load->view('listing', $this->data);
    }


    /*
     *
     *  GL Code Form Data 
     *
    */
    public function moduleFormData($formValues='')
    {
        $data = [
            'pageTitle' => 'Gl Code',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [

                    [
                        'label'         => 'Gl Code',
                        'placeholder'   => 'Enter GL Code',
                        'name'          => 'glCode',
                        'type'          => 'text',
                        'class'         => 'form-control',
                    ],
                    [
                        'label'         => 'Gl Date',
                        'placeholder'   => 'Pick Date',
                        'readonly'      => 'readonly',
                        'name'          => 'glDate',
                        'type'          => 'text',
                        'class'         => 'form-control datepicker',
                    ],
                    [
                        'label'         => 'Gl Header',
                        'placeholder'   => 'Enter GL Code Header',
                        'name'          => 'glHeader',
                        'type'          => 'text',
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


    /*
     *
     *  GL Code Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('glCode')) {

            $sendData = http_build_query($this->input->post());
            $url = $this->config->item('glcodes_create');
            $response = $this->restservice->post($url, $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;
            
            toJson($this->data);
            return TRUE;
        }

        $html = $this->moduleFormData();

        $module = $this->module;
        $this->data = compact('module','html');
        $this->load->view('/form',$this->data);
    }


    /*
     *
     *  GL Code Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);
        if ($this->input->post('id')) {

            $sendData = http_build_query($this->input->post());
            $url = $this->config->item('glcodes_update');
            $response = $this->restservice->post($url, $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;
            
            toJson($this->data);
            return TRUE;
        }
        $response = $this->getData('glcodes_view', $id, false, false);

        $response = $response['data'];
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->data =  compact('module','html','response');
        $this->load->view('form',$this->data);
    }

    /*
     *
     *  GL Code View Service 
     *
    */
    public function view($id=NULL)
    {
        $id = base64_decode($id);

        $url = $this->config->item('glcodes_view').'/'.$id;
        $response = $this->restservice->get($url, $this->headers);

        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->data =  compact('module','html','response');
        $this->load->view('/form',$this->data);
    }


    /*
     *
     *  GL Code Delete Service 
     *
    */
    public function delete() 
    {

        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            $url = $this->config->item('glcodes_delete').'/'.$id;
            $response = $this->restservice->get($url, $this->headers);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }


    public function getCedents()
    {
        return $this->getData('cedent_listing_filter');
    }


}