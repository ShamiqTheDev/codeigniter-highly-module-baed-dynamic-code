<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TreatyDetails extends CI_Controller {

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
     *  TreatyDetails Listing Service 
     *
    */
    public function index()
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data')) {
            $post = $this->input->post();
            // $post = replaceInArrayKey($post,'_','.');
            $response = $this->postData('treaty_details_listing', $post, true);
            $token = $this->security->get_csrf_hash();

            $this->data['get_data'] = $response['data'];
            $this->data['token'] = $token;

            toJson($this->data);
            return TRUE;
        }

        $dataColumns = [
            'name'              => 'Name',
            'prePreviousShare'  => 'Previous Share',
            'preProposedShare'  => 'Proposed Share',
            'preApprovedShare'  => 'Approved Share',
        ];
        
        $module = $this->module;

        $ListingConfig = [
            'PageTitle'     => 'Treaty Details Table',
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'ActionButtons' => array(
                "View"   => $this->isPermission('TreatyDetails/view',false,true),
                "Insert" => $this->isPermission('TreatyDetails/create',false,true),
                "Edit"   => $this->isPermission('TreatyDetails/edit',false,true),
                "Delete" => $this->isPermission('TreatyDetails/delete',false,true)
            ),
            'currentPage'   => 0,
            'ItemPerpage'   => 10,
        ];


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
            'pageTitle' => 'Treaty Details',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs

                    // [
                    //     'type'          => 'select',
                    //     'label'         => 'Role',

                    //     'attributes'    =>[
                    //         'placeholder'   => 'Select Role',
                    //         'name'          => 'roleDTO.id',
                    //         'class'         => 'form-control select2 roleOptions',
                    //     ],
                    //     'validation'    =>[
                    //         'required'      => true,
                    //         'email'         => false,
                    //         'number'        => false,
                    //         // 'minlength'     => 0,
                    //         // 'maxlength'     => 0,
                    //     ],
                    //     'validationMessage' => 'Please select a Role',
                    // ],
                    // [
                    //     'type'          => 'select',
                    //     'label'         => 'Module',

                    //     'attributes'    =>[
                    //         'placeholder'   => 'Select Module',
                    //         'name'          => 'moduleDTO.id',
                    //         'class'         => 'form-control select2 moduleOptions',
                    //     ],
                    //     'validation'    =>[
                    //         'required'      => true,
                    //         'email'         => false,
                    //         'number'        => false,
                    //         // 'minlength'     => 0,
                    //         // 'maxlength'     => 0,
                    //     ],
                    //     // 'validationMessage' => 'Please select a module',
                    // ],
                    // Name
                    [
                        'label'         => 'Name',
                        'placeholder'   => 'Treaty Name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'class'         => 'form-control string',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            'minlength'     => 3,
                            'maxlength'     => 40,

                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    // Previous Share
                    [
                        'label'         => 'Previous Share',
                        'placeholder'   => 'Enter Previous Share',
                        'name'          => 'prePreviousShare',
                        'type'          => 'text',
                        'class'         => 'form-control decimal-numbers',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => true,
                            // 'minlength'     => 3,
                            'maxlength'     => 11,

                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],

                    // Proposed Share
                    [
                        'label'         => 'Proposed Share',
                        'placeholder'   => 'Enter Proposed Share',
                        'name'          => 'preProposedShare',
                        'type'          => 'text',
                        'class'         => 'form-control decimal-numbers',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => true,
                            // 'minlength'     => 3,
                            'maxlength'     => 11,

                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    
                    // Approved Share
                    [
                        'label'         => 'Approved Share',
                        'placeholder'   => 'Enter Approved Share',
                        'name'          => 'preApprovedShare',
                        'type'          => 'text',
                        'class'         => 'form-control decimal-numbers',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => true,
                            // 'minlength'     => 3,
                            'maxlength'     => 11,

                        ],
                        // 'validationMessage' => 'Please enter url',
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
     *  TreatyDetails Create Service 
     *
    */
    // public function create()
    // {
    //     if ($this->input->post('step')) {

    //         $post = replaceInArrayKey($this->input->post(),"_",".");
    //         $response = $this->postData('treaty_details_create',$post,1,1);
    //         $token = $this->security->get_csrf_hash();

    //         $this->data['data'] = $response;
    //         $this->data['token'] = $token;
            
    //         toJson($this->data);
    //         return TRUE;
    //     }

    //     $html = $this->moduleFormData();
    //     $module = $this->module;
        
    //     $this->load->view('/form',compact('module','html'));
    // }


    /**
     *
     *  TreatyDetails Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);
        if ($this->input->post('id')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
        // dd($post);
            $response = $this->postData('treaty_details_update',$post,1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;
            
            toJson($this->data);
            return TRUE;
        }
        $response = $this->getData('treaty_details_view', $id, false, false);

        $response = $response['data'];
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->data =  compact('module','html','response');
        $this->load->view('form',$this->data);
    }

    /**
     *
     *  TreatyDetails View Service 
     *
    */
    public function view($id=NULL)
    {
        $id = base64_decode($id);

        $response = $this->getData('treaty_details_view',$id,0,0,0);
        $module = $this->module;
        $html = $this->moduleFormData($response);

        $this->load->view('/form',compact('module','html','response'));
    }

    /**
     *
     *  TreatyDetails Delete Service 
     *
    */
    public function delete() 
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            $response = $this->getData('treaty_details_delete',$id,0,0,0);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

}