<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;

class TreatyStates extends CI_Controller {

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
     *  Treaty States Grouped by Batch Listing Service 
     *
    */
    public function batches($pageNo='')
    {
        if ($this->input->post('get_data')) {
            $post = $this->input->post();
            if (!empty($pageNo)) {
                $pageNo = $pageNo;
                $post['currentPage'] = $pageNo;
            }
            unset($post['get_data']);
            // $post['itemsPerPage'] = $post['itemsPerPages'];
            // unset($post['itemsPerPages']);

            $post['sortBy'] = 'id';
            $post['direction'] = 'ASC';
            $response = $this->postData('treaty_states_group_by_batch_id',$post,true);
            $token = $this->security->get_csrf_hash();
            $get_response["get_data"] = $response['data'];
            $get_response["get_csrf_hash"] = $token;
            
            echo json_encode($get_response);
            return TRUE;
        }

        $ListingConfig = [];
        $ListingConfig['URl'] = base_url('treatyStates/batches');
        $ListingConfig['DataColumns'] = json_encode([
            'batchId' => 'Batch id',
            'statisticsDate_custom_date' => 'Date',
        ]);
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "view_by_batch" => true,
            "Insert" => true,
        );

        $SearchFilters = array(
            array(
                'label'         => 'Batch ID',
                'placeholder'   => 'Enter Batch ID',
                'name'          => 'batchId',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,
            ),
            array(
                'label'         => 'Date',
                'placeholder'   => 'Enter Date',
                'name'          => 'treatyStatisticsDate',
                'type'          => 'date',
                'class'         => 'form-control fc-datepicker',
                'required'      => false,
            ),
        );

        $ListingConfig['PageTitle'] = "Treaty Statistics";

        $module = $this->module;
        $ListingConfig['SearchFilters'] = $SearchFilters;
        $this->data = compact('module','ListingConfig');
        $this->load->view('listing', $this->data);

    }

    /**
     *
     *  Treaty States Batchwise Listing Service 
     *
    */
    public function index($pageNo='',$batchId='')
    {
        if ($this->input->post('get_data')) {
            $post = $this->input->post();
            if (!empty($batchId)) {
                $post['batchId'] = $batchId;
            }
            if (!empty($pageNo) && $pageNo != 'null') {
                $pageNo = $pageNo;
                $post['currentPage'] = $pageNo;
            }
            unset($post['get_data']);
            $response = $this->postData('treaty_states_listing_filter',$post,true);
            $token = $this->security->get_csrf_hash();
            $get_response["get_data"] = $response['data'];
            $get_response["get_csrf_hash"] = $token;
            
            echo json_encode($get_response);
            return TRUE;
        }

        $ListingConfig = [];
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode([
            'treatyStatisticsNo'        => 'statistics id',
            'treatyYear'                => 'Statistics Year',
            'statisticsValue'           => 'Statistics Value',
            'treatyParticularDTO_name'  => 'Treaty Particular',
            'statisticsDate_custom_date'=> 'Statistics Date',
        ]);
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['PageTitle'] = "Treaty Statistics";
        $ListingConfig['ActionButtons'] = array(
            "View" => true,
            "Delete" => true
        );

        

        $module = $this->module;

        $this->data = compact('module','ListingConfig');
        $this->load->view('listing', $this->data);

    }


    /**
     *
     *   This Module Create Form
     *
    */
    public function moduleFormData($formValues='')
    {
        $data = [
            'pageTitle' => 'Treaty Statistics',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [
                    [
                        'label'         => 'Date',
                        'placeholder'   => 'MM/DD/YY',
                        'name'          => 'statisticsDate',
                        'type'          => 'text',
                        'class'         => 'form-control fc-datepicker',
                        'autocomplete'  => 'off',
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [
                        'type'          => 'select',
                        'label'         => 'Cedent Name',
                        'attributes'    => [
                            'placeholder'   => 'Select Cedent',
                            'name'          => 'cedentDTO.id',
                            'class'         => 'form-control select2 cedentOptions',
                        ],
                        'options'       => [],
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [
                        'label'         => 'Document',
                        'name'          => 'treatyUploadedFile',
                        'type'          => 'file',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'accept'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'validation'    => [
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'extension'     => 'xls',
                        ],
                    ],
                    [
                        'type'          => 'select',
                        'label'         => 'Year',
                        'attributes'    => [
                            'placeholder'   => 'Select Year',
                            'name'          => 'treatyYear',
                            'class'         => 'form-control select2 treatyYear',
                        ],
                        'options'       => years(),
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],

                    [
                        'label'         => 'Business Class',
                        'type'          => 'select',
                        'attributes'    => [
                            'data-placeholder'  => 'Choose Business Class',
                            'name'              => 'businessDTO.id[]',
                            'class'             => 'form-control select2 getBusinessOptions',
                            'multiple'          => 'multiple',
                        ],
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [
                        'label'         => 'Sub Business Class',
                        'type'          => 'select',
                        'attributes'    => [
                            'data-placeholder'  => 'Choose Sub Business Class',
                            'name'              => 'subBusniessClass[]',
                            'class'             => 'form-control select2 getSubBusinessOptions',
                            'multiple'          => 'multiple',
                        ],
                        'required'      => 'required',
                        'validation'    => [],
                    ],
                    [
                        'label'         => 'Treaty Type',
                        'type'          => 'select',
                        'attributes'    => [
                            'data-placeholder'  => 'Choose Treaty Type',
                            'name'              => 'treatyBasicDTO.treatTypeDTO.type',
                            'class'             => 'form-control select2 treatyTypeOptions',
                        ],
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [
                        'label'         => 'Treaty Category',
                        'type'          => 'select',
                        'attributes'    => [
                            'data-placeholder'  => 'Choose Treaty Category',
                            'name'              => 'treatyCategoryDTO.id',
                            'class'             => 'form-control select2 treatyCategoryOptions',
                        ],
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [
                        'label'         => 'Remarks',
                        'placeholder'   => 'Enter Remarks',
                        'name'          => 'remarks',
                        'type'          => 'textarea',
                        'rows'          => '2',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
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
     *  Treaty States Create Service 
     *
     */
    public function create()
    {
        if ($this->input->post('statisticsDate')) {
            $postData = replaceInArrayKey($this->input->post(),'_','.');
            unset($postData['treatyBasicDTO.treatTypeDTO.type']);
            $postData['statisticsDate'] = date('m/d/Y',strtotime($this->input->post('statisticsDate')));
            $nBIds = isset($postData['subBusniessClass'])?count($postData['subBusniessClass']):0;
            if ($nBIds == 0) {
                foreach ($postData['businessDTO.id'] as $iBId) {
                    $postData['businessDTOs'][] = ['id' => $iBId];
                }
            }else{  
                foreach ($postData['businessDTO.id'] as $iBId) {
                    $postData['businessDTOs'][] = ['id' => $iBId];
                }  
                for ($i=0; $i < $nBIds; $i++) { 
                    $iBId = $postData['subBusniessClass'][$i];                    
                    $postData['businessDTOs'][] = ['id' => $iBId];
                }
            }
            $postData['cedentDTO']['id'] = $postData['cedentDTO.id'];
            $postData['treatyCategoryDTO']['id'] = $postData['treatyCategoryDTO.id'];
            unset($postData['subBusniessClass']);
            unset($postData['businessDTO.id']);
            unset($postData['cedentDTO.id']);
            unset($postData['treatyCategoryDTO.id']);
            $fileUpload = [
                'file'          => $_FILES,
                'name'          => 'treatyUploadedFile',
                'extensions'    => 'xlsx',
                'uploadPath'    => './uploads/excel',
            ];
            $statesFile = uploadFile($fileUpload);
            $uploadedFilePath = $statesFile['imagePath'];
            $postData['treatyUploadedFilePath'] = $uploadedFilePath;

            $particularsData = $this->readExcel($uploadedFilePath);
            $url = $this->config->item('treaty_particular_listing');
            $particulars = $this->restservice->get($url, $this->headers);

            $cols = $particularsData[1];
            $response = $postDataArray = [];
            foreach ($particularsData as $postParticular) {
                $particularName         = $postParticular['A'];
                $yearVal[$cols['B']]    = $postParticular['B'];
                $yearVal[$cols['C']]    = $postParticular['C'];
                $yearVal[$cols['D']]    = $postParticular['D'];
                $yearVal[$cols['E']]    = $postParticular['E'];
                $yearVal[$cols['F']]    = $postParticular['F'];
                $uptoMonthPerYear       = $postParticular['G'];
                $total                  = $postParticular['H'];
                $years[$cols['B']]      = $cols['B'];
                $years[$cols['C']]      = $cols['C'];
                $years[$cols['D']]      = $cols['D'];
                $years[$cols['E']]      = $cols['E'];
                $years[$cols['F']]      = $cols['F'];

                foreach ($particulars as $dbParticular) {
                    if ($particularName == $dbParticular->name) {
                        foreach ($years as $key => $year) {
                            $postData['treatyParticularDTO']['id'] = $dbParticular->id;
                            $postData['treatyYear'] = $year;

                            $postData['statisticsValue'] = str_replace('%','',$yearVal[$key]); //filtering
                            $postData['statisticsValue'] = str_replace(',','',$postData['statisticsValue']); //filtering
                            if (!empty($yearVal[$key])) {
                                $postDataArray['treatyStatisticsDTOs'][] = $postData;
                            }
                        }
                    }
                } 
            }
            // dd($postDataArray);
            $response = $this->postJsonData('treaty_states_create',$postDataArray);
            $response = json_decode($response,true);
            echo json_encode($response);
            return true;
        }

        $html = $this->moduleFormData();
        $module = $this->module;
        
        $this->load->view('/form',compact('module','html'));

    }


    /**
     *
     *   This method returns Treaty States Table
     *
    */
    public function treatyStatesTable($thisYear="")
    {
        // $response = $this->getData('treaty_states_listing','',false,false,false);
        $thisYear = isset($thisYear)?$thisYear:date('Y');
        if (isset($thisYear)) {
            $response = $this->postData('treaty_states_get_all_by_year_cedent',['year'=>$thisYear],1,1);
        }

        $statistics = [];
        foreach ($response as $res) {
            $statesYear = $res->treatyYear;
            $statesValue = $res->statisticsValue;
            $particularName = isset($res->treatyParticularDTO->name)?$res->treatyParticularDTO->name:'';

            $statistics[$particularName]['particularName'] = $particularName;
            $statistics[$particularName][$statesYear] = $statesValue;
        }

        $this->load->view($this->module.'/'.$this->module.'_table',compact('statistics','thisYear'));
    }


    /*
     *
     *  Treaty States Edit Service 
     *
    */
    // public function edit($id=NULL)
    // {
    //     $id = base64_decode($id);
    //     if ($this->input->post('statisticsDate')) {
    //         $postData = replaceInArrayKey($this->input->post(),'_','.');
    //         // $nBIds = isset($postData['subBusniessClass'])?count($postData['subBusniessClass']):0;
    //         // if ($nBIds == 0) {
    //         //     $iBId = $postData['businessDTO.id'];
    //         //     $postData['businessDTOs'][] = ['id' => $iBId];
    //         // }else{            
    //         //     for ($i=0; $i < $nBIds; $i++) { 
    //         //         $iBId = $postData['subBusniessClass'][$i];                    
    //         //         $postData['businessDTOs'][] = ['id' => $iBId];
    //         //     }
    //         // }
    //         // $postData['cedentDTO']['id'] = $postData['cedentDTO.id'];
    //         // $postData['treatyCategoryDTO']['id'] = $postData['treatyCategoryDTO.id'];
    //         // unset($postData['subBusniessClass']);
    //         // unset($postData['businessDTO.id']);
    //         // unset($postData['cedentDTO.id']);
    //         // unset($postData['treatyCategoryDTO.id']);
    //         unset($postData['treatyBasicDTO.treatTypeDTO.type']);
    //         $postData['statisticsDate'] = date('d/m/Y',strtotime($this->input->post('statisticsDate')));

    //         $url = $this->config->item('treaty_particular_listing');
    //         $particulars = $this->restservice->get($url, $this->headers);

    //         $response = $this->postData('treaty_states_create',$postData);
    //         echo $response;
    //         return true;
    //     }


    //     $url = $this->config->item('treaty_states_view').'/'.$id;
    //     $response = $this->restservice->get($url, $this->headers);

    //     // debug($response);

    //     $data = [ 
    //         'module'    => $this->module,
    //         'response'  => $response,
    //     ];
    //     $this->load->view($this->module.'/'.$this->module.'_form',$data);
    // }


    /*
     *
     *  Treaty States View Service 
     *
     */
    public function view($id=NULL)
    {
        $id = base64_decode($id);
        $url = $this->config->item('treaty_states_view').'/'.$id;
        $response = $this->restservice->get($url, $this->headers);

        $data = [
            'module'    => $this->module,
            'response'  => $response,
        ];
        $this->load->view($this->module.'/'.$this->module.'_form',$data);
    }


    /*
     *
     *  Treaty States Delete Service 
     *
     */
    public function delete() 
    {
        if ($this->input->post('id')) {

            $id = base64_decode($this->input->post('id'));
            $response = $this->getData('treaty_states_delete',$id,false,false,false);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;

        }
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


    /*
     *
     *  Drop Down Option Methods
     *
    */
    public function getCedents()
    {
        return $this->getData('cedent_listing');
    }

    public function getTreatyTypes()
    {
        return $this->getData('treaty_type_listing');
    }

    public function getTreatyCategories()
    {
        return $this->getData('treaty_category_listing');
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

}