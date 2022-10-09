<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;


class Conditionreference extends CI_Controller {

    protected $module;
	protected $headers; 

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

        $this->module = 'conditionreference';
    }

    /**
     *
     *  ConditionReference Listing Service 
     *
    */
    public function index()
    {
        // if ($this->input->post('get_data')) {

        //     $response = $this->postData($this->module.'_listing_filter',$this->input->post(),true);
        //     $token = $this->security->get_csrf_hash();

        //     $this->data['get_data'] = $response['data'];
        //     $this->data['token'] = $token;

        //     toJson($this->data);
        //     return TRUE;
        // }

        // $dataColumns = [
        //     'referenceNo'                               => 'Reference No.',
        //     // 'conditionTypeDTOs_conditionType[0]'           => 'Condition Type',
        // ];
        
        // $module = $this->module;

        // $ListingConfig = [
        //     'PageTitle'     => 'Condition Reference',
        //     'URl'           => current_url(),
        //     'DataColumns'   => json_encode($dataColumns),
        //     'ActionButtons' => array(
        //         "View" => false,
        //         "Insert" => true,
        //         "Edit"   => false,
        //         "Delete" => true
        //     ),
        //     'currentPage'   => 0,
        //     'ItemPerpage'   => 10,
        // ];


        // $this->load->view('listing', compact('module','ListingConfig'));

        redirect(base_url('conditionreference/create'));
    }

    /**
     *
     *   This Module Create Form
     *
    */
    public function moduleFormData($formValues='')
    {
        $data = [
            'pageTitle' => 'Condition Reference',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs
                    [
                        'label'         => 'Reference No.',
                        'placeholder'   => 'Reference no. (eg. 00003)',
                        'name'          => 'referenceNo',
                        'type'          => 'text',
                        'class'         => 'form-control',
                        'validation'    => [
                            'required'      => true,
                            'email'         => false,
                            'number'        => true,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 3,

                        ],
                        // 'validationMessage' => 'Please enter url',
                    ],

                    [
                        'type'          => 'select',
                        'label'         => 'Condition Type',

                        'attributes'    =>[
                            'placeholder'   => 'Select Condition',
                            'name'          => 'conditionTypeDTOs',
                            'class'         => 'form-control select2 conditionTypeOptions',
                        ],
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'minlength'     => 0,
                            // 'maxlength'     => 0,
                        ],
                        'validationMessage' => 'Please select a Role',
                    ],
                    [
                        'label'         => 'Conditions Excel File',
                        'name'          => 'file',
                        'type'          => 'file',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'accept'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'validation'    =>[
                            'required'      => true,
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


    /*
     *
     *  This Method Reads Excel File
     *
    */
    public function readExcel($filePath='')
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        return $sheetData;
    }

    /**
     *
     *  ConditionReference Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('referenceNo')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");

             $fileUploadData = [
                'file'          => $_FILES,
                'name'          => 'file',
                'extensions'    => 'xlsx',
                'uploadPath'    => './uploads/conditions',
            ];
            $uploadedFile = uploadFile($fileUploadData);
            $uploadedFilePath = $uploadedFile['imagePath'];
            $conditions = $this->readExcel($uploadedFilePath);

            $post['conditionTypeDTOs[0].id'] = $post['conditionTypeDTOs'];
                unset($post['conditionTypeDTOs']);
            $i=0;
            foreach ($conditions as $condition) {
                $cond = $condition['A'];
                $key = 'conditionTypeDTOs[0].conditionDTOs['.$i.'].condition';
                $post[$key] = $cond;
                $i++; 
            }   

            $response = $this->postData($this->module.'_create',$post,1,1);
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
     *  ConditionReference Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);
        if ($this->input->post('id')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
        // dd($post);
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
     *  ConditionReference View Service 
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
     *  ConditionReference Delete Service 
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

}