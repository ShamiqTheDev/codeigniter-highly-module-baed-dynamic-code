<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Business extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
        $this->load->helper('debug');
        $this->load->helper('ui');

        $this->data = null;

        $this->module = strtolower(__CLASS__);
    }
	
    /*
     *
     *  Form Data 
     *
    */
    public function moduleFormData($formValues='')
    {
        $data = [
            'pageTitle' => $this->lang->line('menu_business'),
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [
                    [
                        'label'         => 'Business Class Name',
                        'placeholder'   => 'Enter Business Name',
                        'name'          => 'name',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            'url'           => false,
                            'minlength'     => 1,
                            'maxlength'     => 15,
                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],
                    [
                        'type'          => 'select',
                        'label'         => 'Parent Class',
                        'attributes'    =>[
                            'placeholder'   => 'Select Parent Business',
                            'name'          => 'subBusinessDTO.id',
                            'class'         => 'form-control select2 businessOptions',
                        ],
                        'validation'    =>[
                            // 'required'      => true,
                            // 'email'         => false,
                            // 'number'        => false,
                            // 'minlength'     => 0,
                            // 'maxlength'     => 0,
                        ],
                        // 'validationMessage' => 'Please select a Role',
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
     *  This method creates Business
     *
    */
    public function create() 
    {
        if ($this->input->post('name')) {
            $post = replaceInArrayKey($this->input->post(),'_','.');
            // dd($post);
            $response['data'] = $this->postData('business_create',$post,1,1);
            $response['token'] = $this->security->get_csrf_hash();
            if($response['data']->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response['data']->message.'</div>');

            }
            echo json_encode($response);
            return TRUE;
        }
        $html = $this->moduleFormData();
        $module = $this->module;
        $this->load->view('/form',compact('module','html'));
    }

    /*
     *
     *  This Listing Business
     *
    */
    public function index($pageNo='')
    {

        $this->isPermission($this->uri->segment(1));
	    if ($this->input->post('get_data')) {
            $post = $this->input->post();
            $post = array_merge($post,$this->config->item('listing'));
	        $data = [];

            if (!empty($pageNo)) {
                $post['currentPage'] = base64_decode($pageNo);
            }

            $response = $this->postData($this->module.'_listing_filter',$post,1,1);
	        $token = $this->security->get_csrf_hash();

	        $data["get_data"] = $response;
	        $data["get_csrf_hash"] = $token;
	        echo json_encode($data);
	        return TRUE;
	    }
	    // $this->load->view('business/listing', $this->data);

        $ListingConfig = [];
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode([
            'name'    => $this->lang->line('col_businessClass'),
        ]);
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('business/view',false,true),
            "Insert" => $this->isPermission('business/create',false,true),
            "Edit"   => $this->isPermission('business/edit',false,true),
            "Delete" => $this->isPermission('business/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_business');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_Business');
        $module = $this->module;

        $SearchFilters = array(

            array(
                'label'         => 'Business Name',
                'placeholder'   => 'Enter Business Name',
                'name'          => 'name',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,

            ),
        );

        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data = compact('module','ListingConfig');
        $this->load->view('listing', $this->data);
	}
    
    // Service#3 (Delete Business)
    public function delete() 
    {

        if (isset($_POST["id"])) {
            $id = base64_decode($_POST["id"]);
            $sourceLocation = $this->config->item("business_delete");
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $sendData = $id;
            $sourceLocation = $sourceLocation . "/" . $sendData;
            $response = $this->restservice->get($sourceLocation, $headers, $sendData);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;

        }
    }

    // Service#4 (Update Business)
    public function edit($id = NULL) 
    {
        $id = base64_decode($id); 
        if ($this->input->post('name')) {
            $post = $this->input->post();
            $response['data'] = $this->postData($this->module.'_update',$post,1,1);
            $response['token'] = $this->security->get_csrf_hash();
            if($response['data']->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response['data']->message.'</div>');

            }
            
            echo json_encode($response);
            return TRUE;
        }
        $response = $this->getData($this->module.'_view',$id,0,0,0);
        // dd($response);
        $html = $this->moduleFormData($response);
        $module = $this->module;
        $this->load->view('/form',compact('module','html','response'));
    }

    // Service#3 (View Business)
    public function view($id = NULL) {
        $id = base64_decode($id);
        
        $module = $this->module;
        $response  = $this->getData($this->module.'_view',$id,0,0,0);
        $html = $this->moduleFormData($response);
        
        $this->load->view('/form',compact('module','response','html'));
    }

    public function get() {
        $response  = $this->getData($this->module.'_listing');
        return $response;
    }

    public function getBusiness($sub = false)
    {
        $url = $this->config->item('business_listing');
        $response = $this->restservice->get($url, $this->headers);

        $newData = [];
        if (isset($sub)) {
            $sub = base64_decode($sub);
            $ids = explode(',', $sub);
        }
        if (isset($response)) {
            foreach ($response as $value) {
                if ($value->subBusinessDTO == null && $sub == false) { // returns business data
                    $newData[] = $value;
                }elseif(isset($value->subBusinessDTO->id)){ // returns sub business data
                    if (in_array($value->subBusinessDTO->id, $ids)) {
                        $newData[] = $value;
                    }
                }
            }
        }
        $data['data'] = $newData;
        $data['token'] = $this->security->get_csrf_hash();

        echo json_encode($data);
        return TRUE;
    }

    public function GetBusinessClassOptions($businessClassId = null) 
    {
       $BusinessClass = $this->restservice->get($this->config->item('business_listing'), $this->headers);
       $BusinessClass = json_decode(json_encode($BusinessClass));
       $aBusinessClass[0] = array(0, "Select Business Class");
       $aSubBusinessClass[0] = array(0, "Select Sub-Business Class");
       if(isset($BusinessClass))
       {
           foreach ($BusinessClass as $key => $ObjBusinessClass) 
           {
                if(!empty($ObjBusinessClass->subBusinessDTO) AND $businessClassId != null)
                { 
                    if($ObjBusinessClass->id == $businessClassId)
                    {
                        $aSubBusinessClass[] = array($ObjBusinessClass->subBusinessDTO->id,$ObjBusinessClass->subBusinessDTO->name);
                    }
                     
                }else{
                     $aBusinessClass[] = array($ObjBusinessClass->id, $ObjBusinessClass->name);
                }
          }
       }

       if($businessClassId != null)
            print(json_encode($aSubBusinessClass));
        else
            print(json_encode($aBusinessClass));

    }


    public function GetSubBusinessClassOptions($businessClassId)
    {
       $SubBusinessClass = $this->restservice->get($this->config->item('business_listing'), $this->headers);
       $SubBusinessClass = json_decode(json_encode($SubBusinessClass));
       $aSubBusinessClass[0] = array(0, "Select Sub Business Class");
       if(isset($SubBusinessClass))
       {
           foreach ($SubBusinessClass as $key => $ObjSubBusinessClass) 
           {
                if(isset($ObjSubBusinessClass->subBusinessDTO->id))
                { 
                     $aSubBusinessClass[] = array($ObjSubBusinessClass->id, $ObjSubBusinessClass->name);
                }
              
           }
       }
       print(json_encode($aSubBusinessClass));
    }
}