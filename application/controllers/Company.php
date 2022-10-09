<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company extends CI_Controller {

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
     *  Company Listing Service 
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
            'companyName'      => $this->lang->line('col_companyrName'),
            'companyEmail'     => $this->lang->line('col_companyEmail'),
            'companyShortName' => $this->lang->line('col_companyshortName'), 
            'companyCode'      => $this->lang->line('col_companyCode'),
            'companyWebsite'   => $this->lang->line('col_companyWebsite'),
        ];
        
        $module = $this->module;

        $ListingConfig = [
            'PageTitle'     => $this->lang->line('menu_company'),
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'ActionButtons' => array(
                "View"   => $this->isPermission('Company/view',false,true),
                "Insert" => $this->isPermission('Company/create',false,true),
                "Edit"   => $this->isPermission('Company/edit',false,true),
                "Delete" => $this->isPermission('Company/delete',false,true)
            ),
            'currentPage'   => 0,
            'ItemPerpage'   => 10,
            'BtnAddNewRecordTitle'     => $this->lang->line('btn_add_new_Company'),
        ];

        $SearchFilters = array(

            array(
                'label'         => 'Company Name',
                'placeholder'   => 'Enter Company Name',
                'name'          => 'companyName',
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
            'pageTitle' => 'Company',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs

                    [
                        'label'         => 'Company Name',
                        'placeholder'   => 'Enter Company Name',
                        'name'          => 'companyName',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            'minlength'     => 1,
                            'maxlength'     => 100,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Company Short Name',
                        'placeholder'   => 'Enter Company Short Name',
                        'name'          => 'companyShortName',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            'minlength'     => 1,
                            'maxlength'     => 4,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Company Email',
                        'placeholder'   => 'Enter Company Email',
                        'name'          => 'companyEmail',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => true,
                            'number'        => false,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Company GST',
                        'placeholder'   => 'Enter Company GST',
                        'name'          => 'companyGST',
                        'type'          => 'text',
                        'class'         => 'form-control',
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
                        'label'         => 'Company NTN',
                        'placeholder'   => 'Enter Company NTN',
                        'name'          => 'companyNTN',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => true,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Company Website',
                        'placeholder'   => 'Enter website (e.g. www.pakre.org.pk)',
                        'name'          => 'companyWebsite',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'url'           => true,
                            'no-http-url'   => true,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Company Contact',
                        'placeholder'   => 'Enter Company Contact',
                        'name'          => 'companyContact',
                        'type'          => 'text',
                        'class'         => 'form-control numeric',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => true,
                            'url'           => false,
                            'minlength'     => 1,
                            'maxlength'     => 11,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Company Code',
                        'placeholder'   => 'Enter Company Code',
                        'name'          => 'companyCode',
                        'type'          => 'text',
                        'class'         => 'form-control',
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
                        'label'         => 'Company Description',
                        'placeholder'   => 'Enter Company Description',
                        'name'          => 'companyDescription',
                        'type'          => 'textarea',
                        'rows'          => '1',
                        'class'         => 'form-control',
                    ],
                    [
                        'label'         => 'Company Address',
                        'placeholder'   => 'Enter Company Address',
                        'name'          => 'companyAddress',
                        'type'          => 'textarea',
                        'rows'          => '3',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true, 
                        ],
                    ],

                ],              // END: Inputs
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
     *  Company Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('companyName')) {

            $response = $this->postData($this->module.'_create',$this->input->post(),1,1);
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
     *  Company Edit Service 
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
     *  Company View Service 
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
     *  Company Delete Service 
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

}