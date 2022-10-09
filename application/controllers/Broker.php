<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Broker extends CI_Controller {

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

    /**
     *
     *  Broker Listing Service 
     *
    */
    public function index()
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data')) {
            $post = $this->input->post();
            $post = array_merge($post,$this->config->item('listing'));
            $response = $this->postData($this->module.'_listing_filter',$post,true);
            $token = $this->security->get_csrf_hash();

            $this->data['get_data'] = $response['data'];
            $this->data['token'] = $token;

            toJson($this->data);
            return TRUE;
        }

        $dataColumns = [
            'name'          => $this->lang->line('col_brokerName'),
            'shortName'     => $this->lang->line('col_shortName'),
            'email'         => $this->lang->line('col_email'),
            'code'          => $this->lang->line('col_code'),
            'customerCode'  => $this->lang->line('col_customerCode'),
            'landline'      => $this->lang->line('col_Landline'),
            'supplierCode'  => $this->lang->line('col_supplierCode'),
            'website'       => $this->lang->line('col_website'),
        ];
        
        $module = $this->module;

        $ListingConfig = [
            'PageTitle'     => $this->lang->line('menu_broker'),
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'ActionButtons'     => array(
                "View"   => $this->isPermission('broker/view',false,true),
                "Insert" => $this->isPermission('broker/create',false,true),
                "Edit"   => $this->isPermission('broker/edit',false,true),
                "Delete" => $this->isPermission('broker/delete',false,true)
            ),
            'currentPage'   => 0,
            'ItemPerpage'   => 10,
            'BtnAddNewRecordTitle'     => $this->lang->line('btn_add_new_Broker'),
        ];

        $SearchFilters = array(

            array(
                'label'         => 'Broker Name',
                'placeholder'   => 'Enter Broker Name',
                'name'          => 'name',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
            array(
                'label'         => 'Broker Email',
                'placeholder'   => 'Enter Broker Email',
                'name'          => 'email',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
            array(
                'label'         => 'Code',
                'placeholder'   => 'Enter Code',
                'name'          => 'code',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
            array(
                'label'         => 'Customer Code',
                'placeholder'   => 'Enter Customer Code',
                'name'          => 'customerCode',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
            array(
                'label'         => 'Supplier Code',
                'placeholder'   => 'Enter Supplier Code',
                'name'          => 'supplierCode',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->load->view('listing', compact('module','ListingConfig'));
    }

    /**
     *
     *   This Module Create Form
     *
    */
    public function moduleFormData($formValues='')
    {
        $data = [
            'pageTitle' => 'Broker',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs

                    [
                        'label'         => 'Broker Name',
                        'placeholder'   => 'Enter Broker Name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'minlength'     => 1,
                            'maxlength'     => 15,
                        ],
                    ],
                    [
                        'label'         => 'Broker Short Name',
                        'placeholder'   => 'Enter Broker Short Name',
                        'name'          => 'shortName',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'minlength'     => 1,
                            'maxlength'     => 4,
                        ],
                    ],
                    [
                        'label'         => 'Broker Email',
                        'placeholder'   => 'Enter Broker Email',
                        'name'          => 'email',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'email'         => true,
                        ],
                    ],
                    [
                        'label'         => 'City',
                        'placeholder'   => 'Enter City',
                        'name'          => 'city',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                        ],
                    ],
                    [
                        'label'         => 'Broker Code',
                        'placeholder'   => 'Enter Broker Code',
                        'name'          => 'code',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                        ],
                    ],
                    [
                        'label'         => 'Country',
                        'placeholder'   => 'Enter Country',
                        'name'          => 'country',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                        ],
                    ],
                    [
                        'label'         => 'Customer Code',
                        'placeholder'   => 'Enter Customer Code',
                        'name'          => 'customerCode',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                        ],
                    ],
                    [
                        'label'         => 'Landline',
                        'placeholder'   => 'Enter Landline',
                        'name'          => 'landline',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'minlength'     => 11,
                            'maxlength'     => 11,
                        ],
                    ],
                    [
                        'label'         => 'Supplier Code',
                        'placeholder'   => 'Enter Supplier Code',
                        'name'          => 'supplierCode',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                        ],
                    ],
                    [
                        'label'         => 'POC Address',
                        'placeholder'   => 'Enter POC Address',
                        'name'          => 'pocAddress',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                        ],
                    ],
                    [
                        'label'         => 'POC Contact',
                        'placeholder'   => 'Enter POC Contact',
                        'name'          => 'pocContact',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                        ],
                    ],
                    [
                        'label'         => 'GST',
                        'placeholder'   => 'Enter GST',
                        'name'          => 'gst',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                        ],
                    ],
                    [
                        'label'         => 'NTN',
                        'placeholder'   => 'Enter NTN',
                        'name'          => 'ntn',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                        ],
                    ],
                    [
                        'label'         => 'POC Name',
                        'placeholder'   => 'Enter POC Name',
                        'name'          => 'pocName',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'minlength'     => 1,
                            'maxlength'     => 15,
                        ],
                    ],
                    [
                        'label'         => 'State',
                        'placeholder'   => 'Enter State',
                        'name'          => 'state',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                        ],
                    ],
                    [
                        'label'         => 'Website',
                        'placeholder'   => 'e.g. http://www.your-website.com',
                        'name'          => 'website',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            // 'no-http-url'   => true,
                            'custom-url'           => true,
                        ],
                    ],
                    [
                        'label'         => 'Description',
                        'placeholder'   => 'Enter Description',
                        'name'          => 'description',
                        'type'          => 'textarea',
                        'rows'          => '3',
                        'class'         => 'form-control',
                    ],

                ], // END: Inputs
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
     *  Broker Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('name')) {
            $post = replaceInArrayKey($this->input->post(),'_','.');
            $response = $this->postData($this->module.'_create',$post,1,1);
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
     *  Broker Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);
        if ($this->input->post('id')) {

            $response = $this->postData($this->module.'_update',$this->input->post(),1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;
            
            toJson($this->data);
            return TRUE;
        }
        $response = $this->getData($this->module.'_view', $id, false, false);

        $response = $response['data'];
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->data =  compact('module','html','response');
        $this->load->view('form',$this->data);
    }

    /**
     *
     *  Broker View Service 
     *
    */
    public function view($id=NULL)
    {
        $id = base64_decode($id);

        $response = $this->getData($this->module.'_view',$id,0,0,0);
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->load->view('/form',compact('module','html','response'));
    }

    /**
     *
     *  Broker Delete Service 
     *
    */
    public function delete() 
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            $response = $this->getData($this->module.'_delete',$id,0,0,0);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

    public function get()
    {
        $response = $this->getData($this->module.'_listing');
        return $response;
    }

}