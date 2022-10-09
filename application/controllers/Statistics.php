<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'third_party/PhpSpreadsheet/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;

class Statistics extends CI_Controller {

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
                    'class' => 'form-horizontal statsForm', 
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
                        'validation'    => [
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
                            'name'              => 'treatyTypeDTO.id',
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

    /**
     *
     *  Treaty States Grouped by Batch Listing Service
     *
    */
    // public function batches($pageNo='')
    // {
    //     if ($this->input->post('get_data')) {
    //         $post = $this->input->post();
    //         if (!empty($pageNo)) {
    //             $pageNo = $pageNo;
    //             $post['currentPage'] = $pageNo;
    //         }
    //         unset($post['get_data']);
    //         // $post['itemsPerPage'] = $post['itemsPerPages'];
    //         // unset($post['itemsPerPages']);

    //         $post['direction'] = 'DESC';
    //         $post['sortBy'] = 'id';
    //         $response = $this->postData('treaty_states_group_by_batch_id',$post,true);
    //         $token = $this->security->get_csrf_hash();
    //         $get_response["get_data"] = $response['data'];
    //         $get_response["get_csrf_hash"] = $token;

    //         echo json_encode($get_response);
    //         return TRUE;
    //     }

    //     $ListingConfig = [];
    //     $ListingConfig['URl'] = base_url('statistics/batches');
    //     $ListingConfig['DataColumns'] = json_encode([
    //         // 'batchId' => 'Batch id',
    //         'statisticsDate_custom_date' => 'Date',
    //     ]);
    //     $ListingConfig['currentPage'] = 0;
    //     $ListingConfig['ItemPerpage'] = 10;
    //     $ListingConfig['ActionButtons'] = array(
    //         "view_by_batch" => true,
    //         "Insert" => true,
    //     );

    //     $SearchFilters = array(
    //         array(
    //             'label'         => 'Batch ID',
    //             'placeholder'   => 'Enter Batch ID',
    //             'name'          => 'batchId',
    //             'type'          => 'text',
    //             'class'         => 'form-control',
    //             'required'      => false,
    //         ),
    //         array(
    //             'label'         => 'Date',
    //             'placeholder'   => 'Enter Date',
    //             'name'          => 'treatyStatisticsDate',
    //             'type'          => 'date',
    //             'class'         => 'form-control fc-datepicker',
    //             'required'      => false,
    //         ),
    //     );

    //     $ListingConfig['PageTitle'] = "Treaty Statistics";

    //     $module = $this->module;
    //     $ListingConfig['SearchFilters'] = $SearchFilters;
    //     $this->data = compact('module','ListingConfig');
    //     $this->load->view('listing', $this->data);

    // }

    /**
     *
     *  Treaty States Batchwise Listing Service
     *
    */
    // public function index($pageNo='',$batchId='')
    // {
    //     if ($this->input->post('get_data')) {
    //         $post = $this->input->post();
    //         if (!empty($batchId)) {
    //             $post['batchId'] = $batchId;
    //         }
    //         if (!empty($pageNo) && $pageNo != 'null') {
    //             $pageNo = $pageNo;
    //             $post['currentPage'] = $pageNo;
    //         }

    //         $post['sortBy'] = 'id';
    //         $post['direction'] = 'DESC';

    //         unset($post['get_data']);
    //         $response = $this->postData('treaty_states_listing_filter',$post,true);
    //         $token = $this->security->get_csrf_hash();
    //         $get_response["get_data"] = $response['data'];
    //         $get_response["get_csrf_hash"] = $token;

    //         echo json_encode($get_response);
    //         return TRUE;
    //     }

    //     $ListingConfig = [];
    //     $ListingConfig['URl'] = current_url();
    //     $ListingConfig['DataColumns'] = json_encode([
    //         'treatyStatisticsNo'        => 'statistics id',
    //         'treatyYear'                => 'Statistics Year',
    //         'statisticsValue'           => 'Statistics Value',
    //         'treatyParticularDTO_name'  => 'Treaty Particular',
    //         'statisticsDate_custom_date'=> 'Statistics Date',
    //     ]);
    //     $ListingConfig['currentPage'] = 0;
    //     $ListingConfig['ItemPerpage'] = 10;
    //     $ListingConfig['PageTitle'] = "Treaty Statistics";
    //     $ListingConfig['ActionButtons'] = array(
    //         "View" => true,
    //         "Delete" => true
    //     );



    //     $module = $this->module;

    //     $this->data = compact('module','ListingConfig');
    //     $this->load->view('listing', $this->data);

    // }



    /**
     *
     *  Treaty States Batchwise Listing Service 
     *
    */
    public function index($pageNo='',$batchId='')
    {

        if($this->input->post('draw'))
        {
            $pageNo = $this->input->post('start');
            $draw = $this->input->post('draw');
            $post = $this->input->post('top_search');

            if (!empty($batchId))
            {
                $post['batchId'] = $batchId;
            }

            if ($pageNo != 'null')
            {

                if(isset($post['total_records']))
                {
                    $recordsTotal = $post['total_records'];
                    $itemsPerPages = $post['itemsPerPages'];
                    $total_pages = $recordsTotal / $itemsPerPages;

                    $cureent_page = 0;
                    for($i=0;$i <$total_pages;$i++)
                    {
                        if(($i * $itemsPerPages) == $pageNo)
                        {
                            $cureent_page = $i;
                            break;
                        }
                    }
                    $post['currentPage'] = $cureent_page;
                }


            }

            $post = array_merge($post,$this->config->item('listing'));
            unset($post['get_data']);

            $urlName = 'treaty_states_grp_by_stats_no';


            if (isset($post['myFilters']) && !empty($post['myFilters']))
            {

                $filters = $post['myFilters'];
                unset($post['myFilters'],$post['filters'],$post['givenFilters']);
                parse_str($filters, $filters);
                $filters = $filters['filters'];

                $post = array_merge($post,$filters);
                $urlName = "treaty_states_listing_filter";
            }
            $response = $this->postData($urlName,$post,true);
            $response = json_decode(json_encode($response), true);
            $responseData = $response['data']['data'];
            $customizedData = array();
            foreach ($responseData as $key => $ResponseObject)
            {
                $cedentName ='';
                $cedentCode ='';
                $businessClass = array();
                $treatyType ='';

                if(isset($ResponseObject['businessDTOs'])){
                    foreach ($ResponseObject['businessDTOs'] as $Objbusiness)
                    {
                        $businessClass[] = str_replace(array("-s","-S"),"",$Objbusiness['name']);
                    }
                    $businessClass = array_unique($businessClass);
                    $businessClass = implode(", ",$businessClass);
                }



                if(isset($ResponseObject['treatyTypeDTO'])){
                    $treatyType =$ResponseObject['treatyTypeDTO']['type'];
                }

                if(isset($ResponseObject['cedentDTO'])){
                    $cedentName = $ResponseObject['cedentDTO']['customerName'];
                    $cedentCode = $ResponseObject['cedentDTO']['cedentCode'];
                }
                
                $customizedData[] = array(
                    "id"                              => $ResponseObject['id'],
                    "treatyStatisticsNo"              => $ResponseObject['treatyStatisticsNo'],
                    "cedentName"                      => $cedentName,
                    "cedentCode"                      => $cedentCode,
                    "currentYear"                     => (isset($ResponseObject['currentYear'])) ? $ResponseObject['currentYear']: '',
                    "businessClasses"                 => $businessClass,
                    "treatyType"                      => $treatyType,

                );
            } 
            $response['data']['data']= $customizedData;
            $response = $obj = json_decode(json_encode($response));

            $aData = array(
                "draw" => $draw ,
                "recordsTotal" => $response->data->totalElements,
                "recordsFiltered"=> $response->data->totalElements,
                "data"=>$response->data->data);

            echo json_encode($aData);
            return TRUE;
        }

        $ListingConfig = [];
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = (array(
            'treatyStatisticsNo'        => $this->lang->line('col_statisticsId'),
            'cedentName'                => $this->lang->line('col_cedentName'),
            'cedentCode'                => $this->lang->line('col_cedentCode'),
            'currentYear'               => $this->lang->line('col_year'),
            'businessClasses'           => $this->lang->line('col_businessClass'),
            'treatyType'                => $this->lang->line('col_treatyType'),
        ));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['PageTitle'] = $this->lang->line('menu_treatystatistics');
        $ListingConfig['ActionButtons'] = array(
            "View" => true,
            "Delete" => true,
            "Insert" => true,
            "Edit" => true,
        );


        $filters = $this->config->item($this->module,'filters'); 
        $ListingConfig['filters'] = $filters;
        $module = $this->module;


        $this->data = compact('module','ListingConfig');
        $this->load->view($this->module.'/listing', $this->data);

    }

    /*
     *
     *  Treaty States Create Service
     *
     */
    public function create()
    {


        if ($this->input->post('statisticsDate'))
        {
            $response = $postDataArray = $parsedPostData = [];
            $postData = replaceInArrayKey($this->input->post(),'_','.');
            $postData['statisticsDate'] = date('m/d/Y',strtotime($this->input->post('statisticsDate')));
            
            // business class work start here
            $nBIds = isset($postData['subBusniessClass'])?count($postData['subBusniessClass']):0;
            if ($nBIds == 0) {
                foreach ($postData['businessDTO.id'] as $iBId) {
                    $postData['businessDTOs'][] = ['id' => $iBId];
                }
            } else {  
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
            $postData['treatyTypeDTO']['id'] = $postData['treatyTypeDTO.id'];
            $postData['treatyUploadedFilePath'] = 'RemovedInRequirementChanges';

            $treatyStatisticsYearsDTOS = array();
            $particularsData = $postData['particularsData'];
            foreach ($particularsData as $key => $particularYear)
            {


                $treatyStatisticsYearsParticularDTOs = array();
                $treatyStatisticsYears = array();
                $nRatio = 0;

                foreach ($particularYear as $particular)
                {
                    // particular wise
                    $particular['statisticsValue'] = str_replace('%','',$particular['statisticsValue']); //filtering
                    $particular['statisticsValue'] = str_replace(',','',$particular['statisticsValue']); //filtering

                    $pName = specialFormatting($particular['pNameDev']);
                    unset($particular['pNameDev']);


                    $treatyYear = $particular['treatyYear'];


                    $premiumVal = !empty($particularsData[$treatyYear]['premium']['statisticsValue']) ?$particularsData[$treatyYear]['premium']['statisticsValue']:0;
                    $PortPremiumVal = !empty($particularsData[$treatyYear]['portpremium']['statisticsValue']) ?$particularsData[$treatyYear]['portpremium']['statisticsValue']:0;
                    $NUBalanceVal = !empty($particularsData[$treatyYear]['nubalance']['statisticsValue']) ?$particularsData[$treatyYear]['nubalance']['statisticsValue']:0;
                    $lossesPaidDuringTheYearVal = !empty($particularsData[$treatyYear]['lossespaidduringtheyear']['statisticsValue'])?$particularsData[$treatyYear]['lossespaidduringtheyear']['statisticsValue']:0;
                    $plusLossesOsEndOfYearVal = !empty($particularsData[$treatyYear]['pluslossesosattheendofyear']['statisticsValue']) ?$particularsData[$treatyYear]['pluslossesosattheendofyear']['statisticsValue']:0;
                    $lessLossesOsPreviousYearVal = !empty($particularsData[$treatyYear]['lesslossesosattheendofprevious']['statisticsValue']) ?$particularsData[$treatyYear]['lesslossesosattheendofprevious']['statisticsValue']:0;
                    $commissionVal = !empty($particularsData[$treatyYear]['commission']['statisticsValue'])?$particularsData[$treatyYear]['commission']['statisticsValue']:0;
                    $profitCommissionVal = !empty($particularsData[$treatyYear]['profitcomm']['statisticsValue'])?$particularsData[$treatyYear]['profitcomm']['statisticsValue']:0;


                    $premiumVal =  (int)$premiumVal;
                    $PortPremiumVal = (int)$PortPremiumVal;
                    $NUBalanceVal = (float)$NUBalanceVal;
                    $lossesPaidDuringTheYearVal = (float)$lossesPaidDuringTheYearVal;
                    $plusLossesOsEndOfYearVal = (float)$plusLossesOsEndOfYearVal;
                    $lessLossesOsPreviousYearVal = (float)$lessLossesOsPreviousYearVal;
                    $commissionVal = (float)$commissionVal;
                    $profitCommissionVal = (float)$profitCommissionVal;


                    $losesIncuredVal =  ($lossesPaidDuringTheYearVal + $plusLossesOsEndOfYearVal) - $lessLossesOsPreviousYearVal;

                    $balanceVal = ($premiumVal-$commissionVal-$losesIncuredVal);
                    $netBalanceRatio = ($balanceVal !=0 AND $premiumVal !=0) ? $balanceVal/$premiumVal:0;
                    $netBalanceRatio = $balanceVal/$premiumVal;
                    $lossesIncludedRatio = ($losesIncuredVal !=0 AND $premiumVal !=0) ? $losesIncuredVal/$premiumVal : 0;
                    $netuwbalance = $balanceVal-$profitCommissionVal;


                    if ($pName == specialFormatting('balance')) {
                        $particularVal = $balanceVal;
                    }
                    elseif ($pName == specialFormatting('lossesincludedratio'))
                    {
                        $lossesIncludedRatio_Percentage = round((float)$lossesIncludedRatio * 100 );
                        $particularVal = $lossesIncludedRatio_Percentage;
                    }
                    elseif ($pName == specialFormatting('netbalance'))
                    {

                        $netBalanceRatio_Percentage = round((float)$netBalanceRatio * 100 );
                        $particularVal = $netBalanceRatio_Percentage;
                    }
                    elseif ($pName == specialFormatting('netuwbalance')) {
                        $particularVal = $netuwbalance;
                    }
                    elseif ($pName == specialFormatting('lossesincurred2') OR $pName == specialFormatting('lossesincurred1')) {
                        $particularVal = $losesIncuredVal;
                    }
                    elseif ($pName == specialFormatting('netuwbalance')) {
                        $particularVal = $netuwbalance;
                    }
                    else{
                        $particularVal = (float)$particular['statisticsValue'];
                    }

                        $treatyStatisticsYearsParticularDTOs["treatyStatisticsYearsParticularDTOs"][] = array(
                            'treatyParticularDTO' => array("id" =>$particular['id']),
                            "treatyStatisticsValue" => round($particularVal,3)
                        );


                    $treatyStatisticsYears = array("treatyYear" =>$treatyYear);



                }
                $treatyStatisticsYears = array_merge($treatyStatisticsYears,$treatyStatisticsYearsParticularDTOs);
                $treatyStatisticsYearsDTOS[] = $treatyStatisticsYears;

            }

            $parsedPostData['currentYear'] = $postData['treatyYear'];
            $parsedPostData['statisticsDate'] = $postData['statisticsDate'];
            $parsedPostData['remarks'] = $postData['remarks'];
            $parsedPostData['cedentDTO'] = $postData['cedentDTO'];
            $parsedPostData['treatyCategoryDTO'] = $postData['treatyCategoryDTO'];
            $parsedPostData['treatyTypeDTO'] = $postData['treatyTypeDTO'];
            $parsedPostData['businessDTOs'] = $postData['businessDTOs'];
            $parsedPostData['treatyStatisticsYearsDTOS'] = $treatyStatisticsYearsDTOS;
            $postDataArray['treatyStatisticsDTOs'][] = $parsedPostData;


            $response = $this->postJsonData('treaty_states_create',$postDataArray);


            $response = json_decode($response,true);
            if($response['data']['code'] == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response['data']['message'].'</div>');
                $response['data']['path'] = base_url($this->module);
            }
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
    public function statisticsTable($filterVars="")
    {
        $filterVars = $this->input->post('prams');


        $response = $postData = [];

        $filterVars 	= explode('-', $filterVars);// filterVars dash saparated
        $thisYear 		= isset($filterVars[0])?$filterVars[0]:date('Y');
        $onlyTableCall 	= isset($filterVars[1])?$filterVars[1]:true;
        $cedentId       = isset($filterVars[2])?$filterVars[2]:'';
        $businessId 	= isset($filterVars[3])?$filterVars[3]:'';

        $action = $this->input->post('action');

        if (!empty($thisYear)) {
        	$postData['year'] = $thisYear;
        }
        if (!empty($cedentId)) {
        	$postData['cedentId'] = $cedentId;
        }
        if (!empty($businessId)) {
            $postData['businessId'] = $businessId;
        }
        if($action !='create' AND $this->input->post('view_from_agreement') !='yes')
        {
            $Referer_url = $_SERVER['HTTP_REFERER'];
            $url_array = explode('/',$Referer_url);
            $state_id = base64_decode(end($url_array));


            $response = $this->restservice->get($this->config->item("treaty_states_view")."/$state_id", $this->headers);
            $response = array($response);


        }else{
            $response = $this->postData('treaty_states_get_all_by_year_cedent',$postData,1,1);

        }
        $statistics = [];

        $url = $this->config->item('treaty_particular_listing');
        $particulars = $this->restservice->get($url, $this->headers);


        foreach ($particulars as $particular) {
            $pId = $particular->id;
            $pName = $particular->name;

            $statistics[$pName]['particularId'] = $pId;
            $statistics[$pName]['particularName'] = $pName;
            for ($i=$thisYear; $i > $thisYear-5; $i--) {
                $statistics[$pName][$i] = '';
            }
        }



        if(isset($response[0]) AND isset($response[0]->treatyStatisticsYearsDTOS))
        {
            $treatyStatisticsYearsDTOS = $response[0]->treatyStatisticsYearsDTOS;
            foreach ($treatyStatisticsYearsDTOS as $treatyStatisticsYearsDTO)
            {

                $statesYear     = $treatyStatisticsYearsDTO->treatyYear;

                foreach ($treatyStatisticsYearsDTO->treatyStatisticsYearsParticularDTOs as $treatyStatisticsYearsParticularDTO)
                {
                    $Value    = $treatyStatisticsYearsParticularDTO->treatyStatisticsValue;
                    $Id   = isset($treatyStatisticsYearsParticularDTO->treatyParticularDTO->id)? $treatyStatisticsYearsParticularDTO->treatyParticularDTO->id:'';
                    $Name = isset($treatyStatisticsYearsParticularDTO->treatyParticularDTO->name)?$treatyStatisticsYearsParticularDTO->treatyParticularDTO->name:'';

                    $statistics[$Name]['particularId']    = $Id;
                    $statistics[$Name]['particularName']  = $Name;
                    $statistics[$Name][$statesYear]       = $Value;
                }
            }
        }


        if ($onlyTableCall) { // for agreement and other locations
            $view = $this->module.'/'.$this->module.'_table';
        } else{ // return with form for treaty states
            $view = $this->module.'/'.$this->module.'_table_form';
        }
        $this->load->view($view,compact('statistics','thisYear'));
    }


    /*
     *
     *  Treaty States Edit Service 
     *
    */
     public function edit($id=NULL)
     {
         $id = base64_decode($id);
         if ($this->input->post('statisticsDate'))
         {
             $response = $postDataArray = $parsedPostData = [];
             $postData = replaceInArrayKey($this->input->post(),'_','.');
             $postData['statisticsDate'] = date('m/d/Y',strtotime($this->input->post('statisticsDate')));

             // business class work start here
             $nBIds = isset($postData['subBusniessClass'])?count($postData['subBusniessClass']):0;
             if ($nBIds == 0) {
                 foreach ($postData['businessDTO.id'] as $iBId) {
                     $postData['businessDTOs'][] = ['id' => $iBId];
                 }
             } else {
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
             $postData['treatyTypeDTO']['id'] = $postData['treatyTypeDTO.id'];
             $postData['treatyUploadedFilePath'] = 'RemovedInRequirementChanges';

             $treatyStatisticsYearsDTOS = array();
             $particularsData = $postData['particularsData'];
             foreach ($particularsData as $key => $particularYear)
             {


                 $treatyStatisticsYearsParticularDTOs = array();
                 $treatyStatisticsYears = array();
                 $nRatio = 0;
                 foreach ($particularYear as $particular)
                 {
                     // particular wise
                     $particular['statisticsValue'] = str_replace('%','',$particular['statisticsValue']); //filtering
                     $particular['statisticsValue'] = str_replace(',','',$particular['statisticsValue']); //filtering

                     $pName = specialFormatting($particular['pNameDev']);
                     unset($particular['pNameDev']);


                     $treatyYear = $particular['treatyYear'];


                     $premiumVal = !empty($particularsData[$treatyYear]['premium']['statisticsValue']) ?$particularsData[$treatyYear]['premium']['statisticsValue']:0;
                     $PortPremiumVal = !empty($particularsData[$treatyYear]['portpremium']['statisticsValue']) ?$particularsData[$treatyYear]['portpremium']['statisticsValue']:0;
                     $NUBalanceVal = !empty($particularsData[$treatyYear]['nubalance']['statisticsValue']) ?$particularsData[$treatyYear]['nubalance']['statisticsValue']:0;
                     $lossesPaidDuringTheYearVal = !empty($particularsData[$treatyYear]['lossespaidduringtheyear']['statisticsValue'])?$particularsData[$treatyYear]['lossespaidduringtheyear']['statisticsValue']:0;
                     $plusLossesOsEndOfYearVal = !empty($particularsData[$treatyYear]['pluslossesosattheendofyear']['statisticsValue']) ?$particularsData[$treatyYear]['pluslossesosattheendofyear']['statisticsValue']:0;
                     $lessLossesOsPreviousYearVal = !empty($particularsData[$treatyYear]['lesslossesosattheendofprevious']['statisticsValue']) ?$particularsData[$treatyYear]['lesslossesosattheendofprevious']['statisticsValue']:0;
                     $commissionVal = !empty($particularsData[$treatyYear]['commission']['statisticsValue'])?$particularsData[$treatyYear]['commission']['statisticsValue']:0;
                     $profitCommissionVal = !empty($particularsData[$treatyYear]['profitcomm']['statisticsValue'])?$particularsData[$treatyYear]['profitcomm']['statisticsValue']:0;


                     $premiumVal =  (int)$premiumVal;
                     $PortPremiumVal = (int)$PortPremiumVal;
                     $NUBalanceVal = (float)$NUBalanceVal;
                     $lossesPaidDuringTheYearVal = (float)$lossesPaidDuringTheYearVal;
                     $plusLossesOsEndOfYearVal = (float)$plusLossesOsEndOfYearVal;
                     $lessLossesOsPreviousYearVal = (float)$lessLossesOsPreviousYearVal;
                     $commissionVal = (float)$commissionVal;
                     $profitCommissionVal = (float)$profitCommissionVal;


                     $losesIncuredVal =  ($lossesPaidDuringTheYearVal + $plusLossesOsEndOfYearVal) - $lessLossesOsPreviousYearVal;

                     $balanceVal = ($premiumVal-$commissionVal-$losesIncuredVal);
                     $netBalanceRatio = ($balanceVal !=0 AND $premiumVal !=0) ? $balanceVal/$premiumVal:0;
                     $lossesIncludedRatio = ($losesIncuredVal !=0 AND $premiumVal !=0) ? $losesIncuredVal/$premiumVal : 0;
                     $netuwbalance = $balanceVal-$profitCommissionVal;


                     if ($pName == specialFormatting('balance')) {
                         $particularVal = $balanceVal;
                     }
                     elseif ($pName == specialFormatting('lossesincludedratio'))
                     {
                         $lossesIncludedRatio_Percentage = round((float)$lossesIncludedRatio * 100 );
                         $particularVal = $lossesIncludedRatio_Percentage;
                     }
                     elseif ($pName == specialFormatting('netbalance'))
                     {

                         $netBalanceRatio_Percentage = round((float)$netBalanceRatio * 100 );
                         $particularVal = $netBalanceRatio_Percentage;
                     }
                     elseif ($pName == specialFormatting('netuwbalance')) {
                         $particularVal = $netuwbalance;
                     }
                     elseif ($pName == specialFormatting('lossesincurred2') OR $pName == specialFormatting('lossesincurred1')) {
                         $particularVal = $losesIncuredVal;
                     }
                     elseif ($pName == specialFormatting('netuwbalance')) {
                         $particularVal = $netuwbalance;
                     }
                     else{
                         $particularVal = (float)$particular['statisticsValue'];
                     }

                     $treatyStatisticsYearsParticularDTOs["treatyStatisticsYearsParticularDTOs"][] = array(
                         'treatyParticularDTO' => array("id" =>$particular['id']),
                         "treatyStatisticsValue" => round($particularVal,3)
                     );


                     $treatyStatisticsYears = array("treatyYear" =>$treatyYear);



                 }

                 $treatyStatisticsYears = array_merge($treatyStatisticsYears,$treatyStatisticsYearsParticularDTOs);
                 $treatyStatisticsYearsDTOS[] = $treatyStatisticsYears;

             }

             $parsedPostData['currentYear'] = $postData['currentYear'];
             $parsedPostData['statisticsDate'] = $postData['statisticsDate'];
             $parsedPostData['id'] = $postData['id'];
             $parsedPostData['remarks'] = $postData['remarks'];
             $parsedPostData['cedentDTO'] = $postData['cedentDTO'];
             $parsedPostData['treatyCategoryDTO'] = $postData['treatyCategoryDTO'];
             $parsedPostData['treatyTypeDTO'] = $postData['treatyTypeDTO'];
             $parsedPostData['businessDTOs'] = $postData['businessDTOs'];
             $parsedPostData['treatyStatisticsYearsDTOS'] = $treatyStatisticsYearsDTOS;
             $postDataArray['treatyStatisticsDTOs'][] = $parsedPostData;

             $response = $this->postJsonData('treaty_states_update',$postDataArray);
             $response = json_decode($response);

              $AlertClass = '';
              if($response->data->code == 1) { $AlertClass = 'alert-success'; }
              else{ $AlertClass = 'alert-danger'; }

             $this->session->set_flashdata('message', '<div class="alert '.$AlertClass.'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->data->message.'</div>');
             $response->path = base_url($this->module);
             echo json_encode($response);
             return TRUE;
         }


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
             $urlName = 'treaty_states_delete';
//            $urlName = 'treaty_states_del_by_stats_no';
            $response = $this->getData($urlName,$id,false,false,false);
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