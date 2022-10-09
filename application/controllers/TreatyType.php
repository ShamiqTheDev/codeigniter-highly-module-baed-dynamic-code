<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TreatyType extends CI_Controller {

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
        $this->headers = [ "user" => $this->user, "pass" => $this->pass ];
        $this->module = 'treatytype';
    }


    /*
     *
     *  Treaty Type Listing Service 
     *
     */
    public function index()
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data')) {

            $url = $this->config->item('treaty_type_listing_filter');
            $post = $this->input->post();
            $post = array_merge($post,$this->config->item('listing'));
            $sendData = http_build_query($post);

            $response = $this->restservice->post($url, $this->headers, $sendData);

            $token = $this->security->get_csrf_hash();

            $data['get_data'] = $response;
            $data['token'] = $token;



            toJson($data);
            return TRUE;
        }

        $SearchFilters = [
            [
                'label'         => 'Treaty Type',
                'placeholder'   => 'Enter Treaty Type',
                'name'          => 'type',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,
            ],
        ];
        $lsitingCols = [
            "treatyCategoryDTO_name"=> $this->lang->line('col_TreatyCategory'),
            "type"=>$this->lang->line('col_treatyType'),
        ];

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode($lsitingCols);
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('treatyType/view',false,true),
            "Insert" => $this->isPermission('treatyType/create',false,true),
            "Edit"   => $this->isPermission('treatyType/edit',false,true),
            "Delete" => $this->isPermission('treatyType/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_treatytypes');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_treatyType');
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
            'pageTitle' => 'Treaty Type',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [
                    [ //treaty Category
                        'type'          => 'select',
                        'label'         => 'Treaty Category',

                        'attributes'    =>[
                            'placeholder'   => 'Select Treaty Category',
                            'name'          => 'treatyCategoryDTO.id',
                            'class'         => 'form-control select2 treatyCategoryOptions',
                        ],
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ // treaty name
                        'label'         => 'Treaty Type Name',
                        'placeholder'   => 'Enter Treaty Type Name',
                        'name'          => 'type',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            'minlength'     => 1,
                            'maxlength'     => 50,
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


    /*
     *
     *  Treaty Type Create Service 
     *
     */
    public function create()
    {
        if ($this->input->post('type')) {

            $post = replaceInArrayKey($this->input->post(),'_','.');
            $sendData = http_build_query($post);
            $url = $this->config->item('treaty_type_create');
            $response = $this->restservice->post($url, $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();

            $data['data'] = $response;
            $data['token'] = $token;

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');

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
        if ($this->input->post('type')) {
            $post = replaceInArrayKey($this->input->post(),'_','.');
            $sendData = http_build_query($post);
            $url = $this->config->item('treaty_type_update');
            $response = $this->restservice->post($url, $this->headers, $sendData);
            $token = $this->security->get_csrf_hash();

            $data['data'] = $response;
            $data['token'] = $token;

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');

            }
            
            toJson($data);
            return TRUE;
        }

        $response = $this->getData('treaty_type_view',$id,0,0,0);
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

        $response = $this->getData('treaty_type_view',$id,0,0,0);
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
            $response = $this->getData('treaty_type_delete',$id,0,0,0);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }
    public function get()
    {
        return $this->getData('treaty_type_listing');
    }

}