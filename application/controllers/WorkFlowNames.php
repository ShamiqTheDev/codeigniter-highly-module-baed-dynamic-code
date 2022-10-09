<?php defined('BASEPATH') OR exit('No direct script access allowed');

class WorkFlowNames extends CI_Controller {

    protected $module;
	protected $headers; 

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

        $this->module = camelCase(__CLASS__);
    }

    /**
     *
     *  WorkFlow Listing Service 
     *
    */
    public function index()
    {
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
            'name'          => $this->lang->line('col_workFlowName'),
            // 'roleDTO_name'          => 'Role Name',
            // 'moduleDTO_moduleName'  => 'Module Name',
            // 'step'                  => 'Step Assigned',
        ];
        
        $module = $this->module;
        $SearchFilters = array(

            // array(
            //     'label'         => 'Role Name',
            //     'name'          => 'rollName',
            //     'type'          => 'dropdown',
            //     'class'         => 'form-control',
            //     'required'      => false,
            //     "optionValueColumn" =>"name",
            //     "optionTextColumn" =>"name",
            //     "options"       => $this->restservice->get($this->config->item('role_listing'), $this->headers),
            // ),
            // array(
            //     'label'         => 'Module Name',
            //     'placeholder'   => 'Enter Module Name',
            //     'name'          => 'moduleDTO_moduleName',
            //     'type'          => 'text',
            //     'class'         => 'form-control',
            //     'required'      => false,
            // ),
            array(
                'label'         => 'Work Flow Name',
                'placeholder'   => 'Enter Work Flow Name',
                'name'          => 'name',
                'type'          => 'number',
                'class'         => 'form-control',
                'required'      => false,
            ),
        );
        $ListingConfig = [
            'PageTitle'     => $this->lang->line('menu_workflownames'),
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'ActionButtons' => array(
                "Insert" => true,
                // "View" => true,
                "Edit"   => true,
                "Delete" => true,
                'ViewWorkFlowName' => true,
            ),
            'currentPage'   => 0,
            'ItemPerpage'   => 10,
            'BtnAddNewRecordTitle' => $this->lang->line('btn_add_new_workFlowName'),
        ];
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
            'pageTitle' => 'Work Flows',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs

                    [
                        'label'         => 'Work Flow Name ',
                        'placeholder'   => 'Please Enter Workflow Name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 3,

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
                    if (is_object($fieldValue)) {
                        $fieldValue = $fieldValue->id;
                    }
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
     *  WorkFlow Create Service 
     *
    */
    public function create()
    {   
        if ($this->input->post('name')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
            $response = $this->postData($this->module.'_create',$post,1,1);
            $token = $this->security->get_csrf_hash();

            // debug($response);
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
     *  WorkFlow Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);
        if ($this->input->post('id')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");

            $response = $this->postData($this->module.'_update',$post,1,1);
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
     *  WorkFlow View Service 
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
     *  WorkFlow Delete Service 
     *
    */
    public function delete() 
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            // method getData is used now instead of deleteData
            $response = $this->getData($this->module.'_delete',$id,0,0,0);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

    public function get() 
    {
        return $this->getData($this->module.'_listing');   
    }


}