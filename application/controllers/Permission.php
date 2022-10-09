<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {

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
     *  Permission Listing Service 
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
            'name'       => $this->lang->line('col_permission'),
            'action'     => $this->lang->line('col_action_type'),
            'url'        => $this->lang->line('col_url'),

        ];

        $SearchFilters = array(

            array(
                'label'         => 'Permission Name',
                'placeholder'   => 'Enter Permission Name',
                'name'          => 'name',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );



        $module = $this->module;

        $ListingConfig = array(
            'PageTitle'     => $this->lang->line('menu_permissions'),
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'currentPage'   => 0,
            'ItemPerpage'   => 10,
        );
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('permission/view',false,true),
            "Insert" => $this->isPermission('permission/create',false,true),
            "Edit"   => $this->isPermission('permission/edit',false,true),
            "Delete" => $this->isPermission('permission/delete',false,true)
        );
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_permission');

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
            'pageTitle' => 'Permission',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs

                    [   // Name
                        'label'         => 'Name',
                        'placeholder'   => 'Enter Name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'required'      => 'required',
                        'class'         => 'form-control string',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [   // action
                        'label'         => 'Action',
                        'placeholder'   => 'Enter Action e.g. Delete',
                        'name'          => 'action',
                        'type'          => 'text',
                        'required'      => 'required',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [   //Module id
                        'type'          => 'select',
                        'label'         => 'Module',
                        'attributes'    => [
                            'required'      => 'required',
                            'placeholder'   => 'Select Module',
                            'name'          => 'moduleDTO.id',
                            'class'         => 'form-control select2 moduleOptions',
                        ],
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [   // Url
                        'label'         => 'URL',
                        'placeholder'   => 'Enter URL e.g. delete/delete',
                        'name'          => 'url',
                        'type'          => 'text',
                        'class'         => 'form-control', 
                        'required'      => 'required',
                        'validation'    => [
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [   // Sort Order
                        'label'         => 'Sort Order',
                        'placeholder'   => 'Enter Sort Order',
                        'name'          => 'sidebarOrder',
                        'type'          => 'text',
                        'required'      => 'required',
                        'class'         => 'form-control numeric',
                        'validation'    =>[
                            'required'      => true,
                            'number'        => true,
                        ],
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
     *  Permission Create Service 
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
            
            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('permission');
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
     *  Permission Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);

        if ($this->input->post('id')) {
            $post = replaceInArrayKey($this->input->post(),'_','.');
            $response = $this->postData($this->module.'_update',$post,1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('permission');
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
     *  Permission View Service 
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
     *  Permission Delete Service 
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

    /**
     *
     *  Method for Dropdown Calls.
     *
    */
    public function getModules()
    {
        return $this->getData('module_getAll');
    }

    public function LoadPermissionsByModule()
    {
        $SendData = array();
        $Data = (object) array('status'=>'');
        $Data->Permissions = null;
        if($this->input->post('moduleId') !='')
        {
            $Modules = $this->input->post('moduleId');
            for ($i=0;$i<count($Modules);$i++)
            {
                $SendData['moduleDTOS['.$i.'].id'] = $Modules[$i];
            } 
        
            $SendData = http_build_query($SendData);
            
            $Data->Permissions = $this->restservice->post($this->config->item("module_getPermissionsListByModuleIdList"), $this->headers,$SendData);
     
        } 
       
        if($Data->Permissions !=null)
        {
            $Data->status  = 'true';
        }
        else{
            $Data->status  = 'false';
         }
        echo json_encode($Data);

        return true;

    }


}