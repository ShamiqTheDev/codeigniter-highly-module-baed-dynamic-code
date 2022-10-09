<?php defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\IOFactory;


class Borduex extends CI_Controller {

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
     *  Borduex Listing Service 
     *
    */
    public function index()
    {
        if ($this->input->post('get_data')) {

            $response = $this->postData($this->module.'_listing_filter',$this->input->post(),true);
            $token = $this->security->get_csrf_hash();

            $this->data['get_data'] = $response['data'];
            $this->data['token'] = $token;

            toJson($this->data);
            return TRUE;
        }

        $dataColumns = [
            // 'referenceNo'                               => 'Reference No.',
            // 'conditionTypeDTOs_conditionType[0]'           => 'Condition Type',
        ];
        
        $module = $this->module;

        $ListingConfig = [
            'PageTitle'     => 'Borduex',
            'URl'           => current_url(),
            'DataColumns'   => json_encode($dataColumns),
            'ActionButtons' => array(
                "View" => false,
                "Insert" => true,
                "Edit"   => false,
                "Delete" => true
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
            'pageTitle' => 'Borduex',
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs
                    [ // Year
                        'label'         => 'Year',
                        'placeholder'   => 'Year (eg. 2019)',
                        'name'          => 'year',
                        'type'          => 'text',
                        'class'         => 'form-control numeric',
                        'validation'    => [
                            'required'      => true,
                            'email'         => false,
                            'number'        => true,
                        ],
                    ],
                    [ // Quarter
                        'type'          => 'select',
                        'label'         => 'Quarter',
                        'attributes'    => [
                            'placeholder'   => 'Select Quarter',
                            'name'          => 'quarter',
                            'class'         => 'form-control select2',
                        ],
                        'options'       => $this->config->item('borduexQuarterOptions'),
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [ // uploadDate
                        'label'         => 'Date',
                        'placeholder'   => 'MM/DD/YY',
                        'name'          => 'uploadDate',
                        'type'          => 'text',
                        'class'         => 'form-control fc-datepicker',
                        'autocomplete'  => 'off',
                        'required'      => 'required',
                        // 'readonly'      => 'readonly',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                            // 'minlength'     => 1,
                            // 'maxlength'     => 15,
                        ],
                    ],
                    [ //Borduex
                        'type'          => 'select',
                        'label'         => 'Borduex',
                        'attributes'    => [
                            'placeholder'   => 'Select Borduex',
                            'name'          => 'borduex',
                            'class'         => 'form-control select2',
                        ],
                        'options'       => $this->config->item('borduexOptions'),
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [ // Borduex File
                        'label'         => 'Borduex File',
                        'name'          => 'file',
                        'type'          => 'file',
                        'class'         => 'form-control',
                        'required'      => 'required',
                        'accept'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],                    
                    [ // cedent
                        'type'          => 'select',
                        'label'         => 'Cedent',
                        'attributes'    => [
                            'placeholder'   => 'Select Cedent',
                            'name'          => 'cedentDTO.id',
                            'class'         => 'form-control select2 cedentOptions',
                        ],
                        'validation'    => [
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [ // Business Class
                        'label'         => 'Business Class',
                        'type'          => 'select',
                        'attributes'    => [
                            'data-placeholder'  => 'Choose Business Class',
                            'name'              => 'businessDTO.id',
                            'class'             => 'form-control select2 getBusinessOptions',
                            // 'multiple'          => 'multiple',
                        ],
                        'required'      => 'required',
                        'validation'    =>[
                            'required'      => true,
                            'email'         => false,
                            'number'        => false,
                        ],
                    ],
                    [ // Sub Business
                        'label'         => 'Sub Business Class',
                        'type'          => 'select',
                        'attributes'    => [
                            'data-placeholder'  => 'Choose Sub Business Class',
                            'name'              => 'subBusinessDTO.id',
                            'class'             => 'form-control select2 getSubBusinessOptions',
                            // 'multiple'          => 'multiple',
                        ],
                        'required'      => 'required',
                        'validation'    => [],
                    ],
                    [ // Treaty Type
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
                    [ // Treaty Category
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
     *  Borduex Create Service 
     *
    */
    public function create()
    {
        if ($this->input->post('borduex')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
            $borduex = $post['borduex'];
                unset($post['borduex']);

            if (isset($post['subBusinessDTO.id'])) {
                unset($post['businessDTO.id']);
                $post['businessId'] = $post['subBusinessDTO.id'];
            } else {
                $post['businessId'] = $post['businessDTO.id'];
            }

            $fileUploadData = [
                'file'          => $_FILES,
                'name'          => 'file',
                'extensions'    => 'xlsx',
                'uploadPath'    => './uploads/'.$borduex,
            ];
            
            $uploadedFile = uploadFile($fileUploadData);
            $uploadedFilePath = $uploadedFile['imagePath'];
            $fileData = $this->readExcel($uploadedFilePath);

            switch ($borduex) {
                case 'lossesPaidFire':
                    $postData = $this->lossesPaidFire($fileData,$post,$borduex);
                    break;
                case 'lossesPaidEngineering':
                    $postData = $this->lossesPaidEngineering($fileData,$post,$borduex);
                    break;
                case 'lossesPaidBond':
                    $postData = $this->lossesPaidBond($fileData,$post,$borduex);
                    break;
                case 'lossesPaidAccident':
                    $postData = $this->lossesPaidAccident($fileData,$post,$borduex);
                    break;
                case 'lossesPaidMarineCargo':
                    $postData = $this->lossesPaidMarineCargo($fileData,$post,$borduex);
                    break;
                case 'lossesPaidMarineHull':
                    $postData = $this->lossesPaidMarineHull($fileData,$post,$borduex);
                    break;
                case 'premiumFire':
                    $postData = $this->premiumFire($fileData,$post,$borduex);
                    break;
                case 'bondPremium':
                    $postData = $this->bondPremium($fileData,$post,$borduex);
                    break;

                case 'premiumAccident':
                    $postData = $this->premiumAccident($fileData,$post,$borduex);
                    break;
                case 'premiumEngineering':
                    $postData = $this->premiumEngineering($fileData,$post,$borduex);
                    break;
                case 'premiumMarineCargo':
                    $postData = $this->premiumMarineCargo($fileData,$post,$borduex);
                    break;
                case 'premiumMarineHull':
                    $postData = $this->premiumMarineHull($fileData,$post,$borduex);
                    break;

                default:
                    //
                    break;
            }
               
            // dd($postData);

            // $response = $this->postData($borduex.'_create',$postData,1,1);
            $response = $this->postJsonData($borduex.'_create',$postData);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;
            debug($response);
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

    /*
        Losses Paid Services
    */
    public function lossesPaidFire($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $serialNo = $data['A'];
                $lossNo = $data['B'];
                $policyNo = $data['C'];
                $typeOfPolicy = $data['D'];
                $from = $data['E'];
                $to = $data['F'];
                $dateOfLoss = $data['G'];
                $insured = $data['H'];
                $particularsOfLoss = $data['I'];
                $totalSumInsuredInRs = $data['J'];
                $grossEstimatedLoss = $data['K'];
                $TreatyLoss100 = $data['L'];
                $PRCLSharePercent = $data['M'];
                $PRCLShareAmount = $data['N'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    'serialNo' => $serialNo,
                    'lossNo' => $lossNo,
                    'policyNo' => $policyNo,
                    'typeOfPolicy' => $typeOfPolicy,
                    'periodFrom' => $from,
                    'periodTo' => $to,
                    'dateOfLoss' => $dateOfLoss,
                    'insured' => $insured,
                    'particularsOfLoss' => $particularsOfLoss,
                    'totalSumInsuredInRs' => $totalSumInsuredInRs,
                    'grossEstimatedLoss' => $grossEstimatedLoss,
                    'treatyLoss' => $TreatyLoss100,
                    'prclSharePercent' => $PRCLSharePercent,
                    'prclShareAmount' => $PRCLShareAmount,
                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function lossesPaidEngineering($fileData=Null,$post,$key)
    {   
        // dd($fileData);
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';
                // dd($parsedData);
                $serialNo = $data['A'];
                $lossNo = $data['B'];
                $policyNo = $data['C'];
                $typeOfPolicy = $data['D'];
                $from = $data['E'];
                $to = $data['F'];
                $dateOfLoss = $data['G'];
                $insured = $data['H'];
                $particularsOfLoss = $data['I'];
                // $totalSumInsuredInRs = $data['J'];
                $grossLossPaid = $data['J'];
                $TreatyLoss100 = $data['K'];
                $PRCLSharePercent = $data['L'];
                $PRCLShareAmount = $data['M'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO.id' => $cedentId,
                    'businessSubBusinessDTO.id' => $businessId,
                    'treatyCategoryDTO.id' => $treatyCategoryId,
                    'treatyTypeDTO.id' => $treatyTypeId,

                    // changes recordwise
                    // 'serialNo' => $serialNo,
                    'lossNo' => $lossNo,
                    'policyNo' => $policyNo,
                    'typeOfPolicy' => $typeOfPolicy,
                    'periodFrom' => $from,
                    'periodTo' => $to,
                    'dateOfLoss' => $dateOfLoss,
                    'insured' => $insured,
                    'particularsOfLoss' => $particularsOfLoss,
                    // 'totalSumInsuredInRs' => $totalSumInsuredInRs,
                    'grossLossPaid' => $grossLossPaid,
                    'treatyLoss' => $TreatyLoss100,
                    'prclSharePercent' => $PRCLSharePercent,
                    'prclShareAmount' => $PRCLShareAmount,
                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function lossesPaidBond($fileData=Null,$post,$key)
    {   
        // dd($fileData);
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';
                // dd($parsedData);
                $serialNo = $data['A'];
                $lossNo = $data['B'];
                $policyNo = $data['C'];
                // $typeOfPolicy = $data['D'];
                $from = $data['D'];
                $to = $data['E'];
                $dateOfLoss = $data['F'];
                $insured = $data['G'];
                $particularsOfLoss = $data['H'];
                $grossLossPaid = $data['I'];
                $TreatyLoss100 = $data['J'];
                $PRCLSharePercent = $data['K'];
                $PRCLShareAmount = $data['L'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO.id' => $cedentId,
                    'businessSubBusinessDTO.id' => $businessId,
                    'treatyCategoryDTO.id' => $treatyCategoryId,
                    'treatyTypeDTO.id' => $treatyTypeId,

                    // changes recordwise
                    'lossNo' => $lossNo,
                    'policyNo' => $policyNo,
                    // 'typeOfPolicy' => $typeOfPolicy,
                    'periodFrom' => $from,
                    'periodTo' => $to,
                    'dateOfLoss' => $dateOfLoss,
                    'insured' => $insured,
                    'typeOfLoss' => $particularsOfLoss,
                    'grossLossPaid' => $grossLossPaid,
                    'treatyLoss' => $TreatyLoss100,
                    'prclSharePercent' => $PRCLSharePercent,
                    'prclShareAmount' => $PRCLShareAmount,
                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function lossesPaidAccident($fileData=Null,$post,$key)
    {   
        // dd($fileData);
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';
                // dd($parsedData);
                $serialNo = $data['A'];
                $lossNo = $data['B'];
                $policyNo = $data['C'];
                $typeOfPolicy = $data['D'];
                $from = $data['E'];
                $to = $data['F'];
                $dateOfLoss = $data['G'];
                $insured = $data['H'];
                $subClass = $data['I'];
                $grossLossPaid = $data['J'];
                $TreatyLoss100 = $data['K'];
                $PRCLSharePercent = $data['L'];
                $PRCLShareAmount = $data['M'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO.id' => $cedentId,
                    'businessSubBusinessDTO.id' => $businessId,
                    'treatyCategoryDTO.id' => $treatyCategoryId,
                    'treatyTypeDTO.id' => $treatyTypeId,

                    // changes recordwise
                    'serialNo' => $serialNo,
                    'lossNo' => $lossNo,
                    'policyNo' => $policyNo,
                    'typeOfPolicy' => $typeOfPolicy,
                    'periodFrom' => $from,
                    'periodTo' => $to,
                    'dateOfLoss' => $dateOfLoss,
                    'insured' => $insured,
                    'subClass' => $subClass,
                    
                    'grossLossPaid' => $grossLossPaid,
                    'treatyLoss' => $TreatyLoss100,
                    'prclSharePercent' => $PRCLSharePercent,
                    'prclShareAmount' => $PRCLShareAmount,
                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function lossesPaidMarineCargo($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $serialNo = $data['A'];
                $lossNo = $data['B'];
                $policyNo = $data['C'];
                $typeOfPolicy = $data['D'];
                $modeOfTransportation = $data['E'];
                $from = $data['F'];
                $to = $data['G'];
                $dateOfLoss = $data['H'];
                $insured = $data['I'];
                $particularsOfLoss = $data['J'];
                $totalSumInsuredInRs = $data['K'];
                $grossEstimatedLoss = $data['L'];
                $TreatyLoss100 = $data['M'];
                $PRCLSharePercent = $data['N'];
                $PRCLShareAmount = $data['O'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    'serialNo' => $serialNo,
                    'lossNo' => $lossNo,
                    'policyNo' => $policyNo,
                    'typeOfPolicy' => $typeOfPolicy,
                    'modeOfTransportAction' => $modeOfTransportation,
                    'voyageFrom' => $from,
                    'voyageTo' => $to,
                    'dateOfLoss' => $dateOfLoss,
                    'insured' => $insured,
                    'particularsOfLoss' => $particularsOfLoss,
                    'totalSumInsured' => $totalSumInsuredInRs,
                    'grossLossPaid' => $grossEstimatedLoss,
                    'treatyLoss' => $TreatyLoss100,
                    'prclSharePercent' => $PRCLSharePercent,
                    'prclShareAmount' => $PRCLShareAmount,
                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function lossesPaidMarineHull($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $serialNo = $data['A'];
                $lossNo = $data['B'];
                $policyNo = $data['C'];
                $typeOfPolicy = $data['D'];
                $vessel = $data['E'];
                $from = $data['F'];
                $to = $data['G'];
                $dateOfLoss = $data['H'];
                $insured = $data['I'];
                $particularsOfLoss = $data['J'];
                $totalSumInsuredInRs = $data['K'];
                $grossEstimatedLoss = $data['L'];
                $TreatyLoss100 = $data['M'];
                $PRCLSharePercent = $data['N'];
                $PRCLShareAmount = $data['O'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    // 'serialNo' => $serialNo,
                    'lossNo' => $lossNo,
                    'policyNo' => $policyNo,
                    'typeOfPolicy' => $typeOfPolicy,
                    'modeOfTransportAction' => $vessel,
                    'periodFrom' => $from,
                    'periodTo' => $to,
                    'dateOfLoss' => $dateOfLoss,
                    'insured' => $insured,
                    'particularsOfLoss' => $particularsOfLoss,
                    'totalSumInsuredInRs' => $totalSumInsuredInRs,//may be changed or not
                    'grossLossPaid' => $grossEstimatedLoss,
                    'treatyLoss' => $TreatyLoss100,
                    'prclSharePercent' => $PRCLSharePercent,
                    'prclShareAmount' => $PRCLShareAmount,
                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    /*
        Premium Services
    */
    public function premiumFire($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $policyNo = $data['B'];
                $cessionNo = $data['C'];
                $insured = $data['D'];
                $particularOfRisk = $data['E'];
                $periodFrom = $data['F'];
                $periodTo = $data['G'];
                $grossAmountInsured = $data['H'];
                $grossAmountPremium = $data['I'];
                $surplusTreatyInsured = $data['J'];
                $surplusTreatyPremium = $data['K'];
                $prclShareInsured = $data['L'];
                $prclSharePremium = $data['M'];




                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    'policyNo' => $policyNo,
                    'cessionNo' => $cessionNo,
                    'particularOfRisk' => $particularOfRisk,
                    'grossAmountInsured' => $grossAmountInsured,
                    'grossAmountPremium' => $grossAmountPremium,
                    'surplusTreatyInsured' => $surplusTreatyInsured,
                    'surplusTreatyPremium' => $surplusTreatyPremium,
                    'prclShareInsured' => $prclShareInsured,
                    'prclSharePremium' => $prclSharePremium,
                    'lossNo' => $lossNo,
                    'periodFrom' => $periodFrom,
                    'periodTo' => $periodTo,
                    'insured' => $insured,

                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function bondPremium($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $cessionNo = $data['B'];
                $insured = $data['C'];
                $particularOfRisk = $data['D'];
                $periodFrom = $data['E'];
                $periodTo = $data['F'];
                $grossAmountInsured = $data['G'];
                $grossAmountPremium = $data['H'];
                $treatyInsured = $data['I'];
                $treatyPremium = $data['J'];
                $prclShareInsured = $data['K'];
                $prclSharePremium = $data['L'];




                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    'cessionNo' => $cessionNo,
                    'insured' => $insured,
                    'particularOfRisk' => $particularOfRisk,
                    'periodFrom' => $periodFrom,
                    'periodTo' => $periodTo,
                    'grossInsured' => $grossAmountInsured,
                    'grossPremium' => $grossAmountPremium,
                    'treatyInsured' => $treatyInsured,
                    'treatyPremium' => $treatyPremium,
                    'prclShareInsured' => $prclShareInsured,
                    'prclSharePremium' => $prclSharePremium,

                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function premiumAccident($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $policyNo = $data['B'];
                $cessionNo = $data['C'];
                $insured = $data['D'];
                $particularOfRisk = $data['E'];
                $periodFrom = $data['F'];
                $periodTo = $data['G'];
                $grossAmountInsured = $data['H'];
                $grossAmountPremium = $data['I'];
                $treatyInsured = $data['J'];
                $treatyPremium = $data['K'];
                $prclShareInsured = $data['L'];
                $prclSharePremium = $data['M'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    'policyNo' => $policyNo,
                    'cessionNo' => $cessionNo,
                    'insured' => $insured,
                    'particularOfRisk' => $particularOfRisk,
                    'periodFrom' => $periodFrom,
                    'periodTo' => $periodTo,
                    'grossSumInsured' => $grossAmountInsured,
                    'grossPremium' => $grossAmountPremium,
                    'surplusTreatySumInsured' => $treatyInsured,
                    'surplusTreatyPremium' => $treatyPremium,
                    'prclShareSumInsured' => $prclShareInsured,
                    'prclSharePremium' => $prclSharePremium,

                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function premiumEngineering($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $serialNo = $data['A'];
                $policyNo = $data['B'];
                $insured = $data['C'];
                $particularOfRisk = $data['D'];
                $subClause = $data['E'];
                $periodFrom = $data['F'];
                $periodTo = $data['G'];
                $grossAmountInsured = $data['H'];
                $grossAmountPremium = $data['I'];
                $treatyInsured = $data['J'];
                $treatyPremium = $data['K'];
                $prclShareInsured = $data['L'];
                $prclSharePremium = $data['M'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    'policyNo' => $policyNo,
                    'cessionNo' => $cessionNo,
                    'insured' => $insured,
                    'particularOfRisk' => $particularOfRisk,
                    'periodFrom' => $periodFrom,
                    'periodTo' => $periodTo,
                    'grossSumInsured' => $grossAmountInsured,
                    'grossPremium' => $grossAmountPremium,
                    'surplusTreatySumInsured' => $treatyInsured,
                    'surplusTreatyPremium' => $treatyPremium,
                    'prclShareSumInsured' => $prclShareInsured,
                    'prclSharePremium' => $prclSharePremium,

                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function premiumMarineCargo($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $serialNo = $data['A'];
                $policyNo = $data['B'];
                $vessel = $data['C'];
                $sellingDate = $data['D'];
                $voyageFrom = $data['E'];
                $voyageTo = $data['F'];
                // $subClause = $data['E'];
                $grossInsured = $data['G'];
                $grossPremium = $data['H'];
                $treatyInsured = $data['I'];
                $treatyPremium = $data['J'];
                $prclShareInsured = $data['K'];
                $prclSharePremium = $data['L'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    'policyNo' => $policyNo,
                    'vessel' => $vessel,
                    'sellingDate' => $sellingDate,
                    'voyageFrom' => $voyageFrom,
                    'voyageTo' => $voyageTo,
                    'grossInsured' => $grossInsured,
                    'grossPremium' => $grossPremium,
                    'treatyInsured' => $treatyInsured,
                    'treatyPremium' => $treatyPremium,
                    'prclShareInsured' => $prclShareInsured,
                    'prclSharePremium' => $prclSharePremium,

                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    public function premiumMarineHull($fileData=Null,$post,$key)
    {   
        $parsedData = [];
        if (isset($fileData)) {
            for ($i=1; $i <= 7; $i++) { 
                unset($fileData[$i]);
            }
            
            $quarter            = $post['quarter'];
            $year               = $post['year'];
            $uploadDate         = $post['uploadDate'];
            $cedentId           = $post['cedentDTO.id'];
            $businessId         = $post['businessId'];
            $treatyCategoryId   = $post['treatyCategoryDTO.id'];
            $treatyTypeId       = $post['treatyTypeDTO.id'];

            $i = 0;
            foreach ($fileData as $data) {
                $dataKey = $key.'DTOs';

                // dd($parsedData);
                $serialNo = $data['A'];
                $policyNo = $data['B'];
                $cessionNo = $data['C'];
                $insured = $data['D'];
                $particularOfRisk = $data['E'];
                $periodFrom = $data['F'];
                $periodTo = $data['G'];
                $grossInsured = $data['H'];
                $grossPremium = $data['I'];
                $treatyInsured = $data['J'];
                $treatyPremium = $data['K'];
                $prclShareInsured = $data['L'];
                $prclSharePremium = $data['M'];

                $parsedData[$dataKey][] = [
                    // constant data
                    'quarter' => $quarter,
                    'year' => $year,
                    'uploadDate' => $uploadDate,
                    'cedentDTO' => ['id' => $cedentId],
                    'businessSubBusinessDTO' => ['id' => $businessId],
                    'treatyCategoryDTO' => ['id' => $treatyCategoryId],
                    'treatyTypeDTO' => ['id' => $treatyTypeId],

                    // changes recordwise
                    'policyNo' => $policyNo,
                    'cessionNo' => $cessionNo,
                    'insured' => $insured,
                    'particularOfRisk' => $particularOfRisk,
                    'periodFrom' => $periodFrom,
                    'periodTo' => $periodTo,
                    'grossAmountInsured' => $grossInsured,
                    'grossAmountPremium' => $grossPremium,
                    'surplusTreatyInsured' => $treatyInsured,
                    'surplusTreatyPremium' => $treatyPremium,
                    'prclShareInsured' => $prclShareInsured,
                    'prclSharePremium' => $prclSharePremium,

                ];
                $i++;
            }     
        }
        // dd($parsedData);
        // ee(json_encode($parsedData));
        return $parsedData;
    }

    /**
     *
     *  Borduex Edit Service 
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
     *  Borduex View Service 
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
     *  Borduex Delete Service 
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