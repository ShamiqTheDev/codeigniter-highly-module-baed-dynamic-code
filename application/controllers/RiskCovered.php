<?php defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'third_party/PhpSpreadsheet/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;


class RiskCovered extends CI_Controller {

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
     *  RiskCovered Listing Service 
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
            'name'          => $this->lang->line('col_name'),
        ];
        
        $module = $this->module;
        $SearchFilters = array(

            array(
                'label'         => 'Risk Name',
                'name'          => 'name',
                'type'          => 'dropdown',
                'class'         => 'form-control',
                'required'      => false,
                "optionValueColumn" =>"name",
                "optionTextColumn" =>"name",
                "options"       => $this->restservice->get($this->config->item($this->module.'_listing'), $this->headers),
            ),
        );
        $ListingConfig = [
            'PageTitle'     => $this->lang->line('menu_riskcovered'),
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'ActionButtons' => array(
                // "View" => true,
                "Insert" => true,
                // "Edit"   => true,
                "Delete" => true
            ),
            'currentPage'   => 0,
            'ItemPerpage'   => 10,
            'BtnAddNewRecordTitle'  => $this->lang->line('btn_add_new_riskCovered')
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
            'pageTitle' => 'RiskCovered',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs
                    [ // tretierId
                        'name'          => 'riskCovered',
                        'type'          => 'hidden',
                        'class'         => 'riskCovered',
                        'value'         => 'riskCovered',
                    ],
                    [ // RiskCovered Excel File
                        'label'         => 'Risk Covered Excel File',
                        'name'          => 'file',
                        'type'          => 'file',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'accept'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'validation'    => [
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
     *  RiskCovered Create Service 
     *
    */
    public function create()
    {
        // dd($this->input->post());
        if ($this->input->post('riskCovered')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
            unset($post['riskCovered']);
            if (isset($post['action']) && $post['action'] == 'singleCreate') {
                $postUrlName = $this->module.'_singleCreate';
                $postData = $post;
            } else {
                $postUrlName = $this->module.'_create';
                $fileUploadData = [
                    'file'          => $_FILES,
                    'name'          => 'file',
                    'extensions'    => 'xlsx',
                    'uploadPath'    => './uploads/'.$this->module,
                ];
                
                $uploadedFile = uploadFile($fileUploadData);
                $uploadedFilePath = $uploadedFile['imagePath'];
                $fileData = $this->readExcel($uploadedFilePath);

                $postData = $this->parseExcel($fileData,$post,$this->module);
            }

            $response = $this->postData($postUrlName,$postData);
            $response = json_decode($response,true);
            $token = $this->security->get_csrf_hash();

            if($response['data']['code'] == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response['data']['message'].'</div>');

            }
            toJson($response);
            return TRUE;
        }

        $html = $this->moduleFormData();
        $module = $this->module;
        
        $this->load->view('/form',compact('module','html'));
    }

    /*
        Losses Paid Services
    */
    public function parseExcel($fileData=Null,$post=null,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 1; $i++) { 
                unset($fileData[$i]);
            }

            $n = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOS['.$n.']';

                $serialNo = $data['A'];
                        
                if (!empty($serialNo)) {

                    $name = $data['B'];
                    $parsedData[$dataKey.'.name'] = $name;
                }
                $n++;
            }     
        }
        return $parsedData;
    }

    /**
     *
     *  RiskCovered Edit Service 
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
     *  RiskCovered View Service 
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
     *  RiskCovered Delete Service 
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