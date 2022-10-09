<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

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
     *  Branch Listing Service 
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
            'branchName'        => $this->lang->line('col_branchName'),
            'branchShortName'   => $this->lang->line('col_branchShortName'),
            'branchCode'        => $this->lang->line('col_branchCode'),
            'branchAddress'     => $this->lang->line('col_branchAddress'),
        ];
        
        $module = $this->module;

        $ListingConfig = [
            'PageTitle'     => $this->lang->line('menu_branch'),
            'BtnAddNewRecordTitle'     => $this->lang->line('btn_add_new_branchName'),
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'ActionButtons'     => array(
                "View"   => $this->isPermission('branch/view',false,true),
                "Insert" => $this->isPermission('branch/create',false,true),
                "Edit"   => $this->isPermission('branch/edit',false,true),
                "Delete" => $this->isPermission('branch/delete',false,true)
            ),
            'currentPage'   => 0,
            'ItemPerpage'   => 10,
        ];

        $SearchFilters = array(

            array(
                'label'         => 'Branch Name',
                'placeholder'   => 'Enter Branch Name',
                'name'          => 'branchName',
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
            'pageTitle' => 'Branch',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs

                    [
                        'label'         => 'Branch Name',
                        'placeholder'   => 'Enter Branch Name',
                        'name'          => 'branchName',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            'minlength'     => 3,
                            'maxlength'     => 20,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Branch Email',
                        'placeholder'   => 'Enter Branch Email',
                        'name'          => 'branchEmail',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => false,
                            'email'         => true,
                            'number'        => false,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Branch Fax',
                        'placeholder'   => 'Enter Branch Fax',
                        'name'          => 'branchFax',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => false,
                            'fax_number'    => true,
                            // 'email'         => false,
                            // 'number'        => false,
                            'minlength'     => 1,
                            'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Branch Landline',
                        'placeholder'   => 'Enter Branch Landline',
                        'name'          => 'branchLandline',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => false,
                            'email'         => false,
                            'number'        => true,
                            'minlength'     => 11,
                            'maxlength'     => 11,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],

                    [
                        'label'         => 'Branch State',
                        'placeholder'   => 'Enter Branch State',
                        'name'          => 'branchState',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => false,
                            'email'         => false,
                            'number'        => false,
                            'minlength'     => 1,
                            'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],

                    [
                        'label'         => 'Branch Zip',
                        'placeholder'   => 'Enter Branch Zip',
                        'name'          => 'branchZip',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => false,
                            'email'         => false,
                            'number'        => true,
                            'minlength'     => 1,
                            'maxlength'     => 10,
                        ],
                        // 'validationMessage' => 'Please enter url ',
                    ],


                    [
                        'label'         => 'Branch Short Name',
                        'placeholder'   => 'Enter Branch Short Name',
                        'name'          => 'branchShortName',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'required'      => 'required',
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
                        'label'         => 'Branch Code',
                        'placeholder'   => 'Enter Branch Code',
                        'name'          => 'branchCode',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'required'      => 'required',
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
                        'label'         => 'Branch City',
                        'placeholder'   => 'Enter Branch City',
                        'name'          => 'branchCity',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => false,
                            'email'         => false,
                            'number'        => false,
                            'lettersonly'   => true,
                            'minlength'     => 1,
                            'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'label'         => 'Branch Description',
                        'placeholder'   => 'Enter Branch Description',
                        'name'          => 'branchDescription',
                        'type'          => 'textarea',
                        'rows'          => '3',
                        'class'         => 'form-control',
                    ],

                    [
                        'label'         => 'Branch Address',
                        'placeholder'   => 'Enter Branch Address',
                        'name'          => 'branchAddress',
                        'type'          => 'textarea',
                        'rows'          => '3',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
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
     *  Branch Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('branchName')) {

            $response = $this->postData($this->module.'_create',$this->input->post(),1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');

            }
            toJson($this->data);
            return TRUE;
        }

        $html = $this->moduleFormData();
        $module = $this->module;
        
        $this->load->view('/form',compact('module','html'));
    }


    /**
     *
     *  Branch Edit Service 
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

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
            }

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
     *  Branch View Service 
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
     *  Branch Delete Service 
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