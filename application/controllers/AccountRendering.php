<?php

defined('BASEPATH') OR exit('No direct script access allowed');
// require_once(APPPATH . 'third_party/PhpSpreadsheet/autoload.php');
// use PhpOffice\PhpSpreadsheet\IOFactory;

class AccountRendering extends CI_Controller {
    protected $module;
    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;
        $this->headers = array("user" => $this->config->item("pakre_username"), "pass" => $this->config->item("pakre_password"));

        $this->module = 'accountRendering';
        // dd($this->module);

    }
    public function index($pageNo='')
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data'))
        {
            if (!empty($pageNo)) {
                $_POST['totalPages'] = $pageNo;
            }

            $_POST = array_merge($_POST,$this->config->item('listing'));
            
            $sourceLocation = $this->config->item("accountRendering_listing");
            $headers = array("user" => $this->user, "pass" => $this->pass);
            $sendData = http_build_query($_POST);
            $response = new StdClass();
            $response = $this->restservice->post($sourceLocation, $headers, $sendData);
            $token = $this->security->get_csrf_hash();
            $get_responce["get_data"] = $response;
            $get_responce["get_csrf_hash"] = $token;
            echo json_encode($get_responce);
            return TRUE;
        }

        $DataColumns = array(
            // "id" => "#",
            "dept" => $this->lang->line('col_dept'),
            "cedingCode" => $this->lang->line('col_CedingCode'),
            "recordDateTime_custom_date" => $this->lang->line('col_DataEntryDate'),
            "curCode" => $this->lang->line('col_CurrencyCode'),
            "prcYear" => $this->lang->line('col_PrcYear'),
            "prcQtr" => $this->lang->line('col_PrcQtr'),
            "busType" => $this->lang->line('col_businessClass'),
            // "reinsArr" => "Reins. Arr",
            // "treatyCode" => "Treaty Code",
            // "brokerCode" => "Broker Code",
            // "brokerCoRefNo" => "Broker/Co Ref No",
            "coQtr" => $this->lang->line('col_CompQtr'),
            "coYear" => $this->lang->line('col_CompYear'),
            "uwYear" => $this->lang->line('col_UWYear'),
            // "identityInsured" => "Identity Insured",
            // "typeRisk" => "Type Risk",
            // "curType" => "Currency Type",
            // "prcShare" => "PRC Share",
            "premium" => $this->lang->line('col_Premium'),//
            "commission" => $this->lang->line('col_Commission'),
            "orCommission" => $this->lang->line('col_orCommission'), 
            "profitCommission" => $this->lang->line('col_profitCommission'), 
            "exchangeDifference" => $this->lang->line('col_Commission'), 
            "brokerAge" => $this->lang->line('col_brokerAge'), 
            "miscCharges" => $this->lang->line('col_miscCharges'), 
            "xlPremium" => $this->lang->line('col_xlPremium'), 
            "lossesPaid" => $this->lang->line('col_lossesPaid'), 
            "premiumResWHeld" => $this->lang->line('col_premiumResWHeld'), 
            "premiumResReles" => $this->lang->line('col_Premium'), 
            // "interestOnPlRes" => "Interest On P/L Res",
            // "taxes" => "Taxes",
            // "lossesResWHeld" => "Losses Res. W/Held",
            // "lossesResReles" => "Losses Res. Reles",
            // "cashLossWHeld" => "Cash Loss W/Held",
            // "cashLossReles" => "Cash Loss Reles",
            // "cashLossRefund" => "Cash Loss Refund",
            // "portPremium" => "Port Premium",//
            // "portLosses" => "Port Losses",
            "balance" =>  $this->lang->line('col_Balance'),
            "arType"  =>  $this->lang->line('col_AccountRenderingType'),
            "arDebitCredit"  => $this->lang->line('col_TransactionType'),
            "arTreatyType"  => $this->lang->line('col_treatyType'),
        );
        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode($DataColumns);
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
           // "Insert"     => $this->isPermission('accountRendering/view',false,true),
           "arCreate"   => $this->isPermission('accountRendering/arCreate',false,true),
           "View"       => $this->isPermission('accountRendering/view',false,true),
           // "Reverse"    => $this->isPermission('accountRendering/reverse',false,true),
           // "customView"    => $this->isPermission('accountRendering/edit',false,true),
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_accountrendering');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_accountRendering');
        $this->data['ListingConfig'] = $ListingConfig; 
        $this->load->view('listing', $this->data);
    }

    public function create()
    {
        $this->data["action"] = "add_record";

        $post = replaceInArrayKey($this->input->post(),"_",".");
        // dd($post);
        if($this->input->post('upload_account_rendering')) {
            if (!file_exists('./uploads/AccountRendering')) {
                mkdir('./uploads/AccountRendering', 0777, true);
            }

            $config['upload_path'] = './uploads/AccountRendering/';
            $config['allowed_types'] = 'xlsx';
            $this->load->library('upload', $config);


            if ($this->upload->do_upload('data_file')) {

                //    $response =  json_encode(array('status'=>0,"msg"=>$this->upload->display_errors()));
                //    return TRUE;
                // } else {
                $File_data = $this->upload->data();
                $AccountRendering = $this->readExcel($File_data['full_path']);

                $counter = 0;

                $AccountRenderingData = array();
                unset($AccountRendering[1]);

                foreach ($AccountRendering as $ObjAccountRendering) {
                    if(count(array_filter($ObjAccountRendering)) > 0) {
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].prcYear"] = $this->StrToInt($ObjAccountRendering['B']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].prcQtr"] = $this->StrToInt($ObjAccountRendering['C']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].dept"] = $this->isEmpty($ObjAccountRendering['D']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].busType"] = $this->isEmpty($ObjAccountRendering['E']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].reinsArr"] = $ObjAccountRendering['G'];
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].treatyCode"] = $this->StrToInt($ObjAccountRendering['H']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].brokerCode"] = $this->StrToInt($ObjAccountRendering['I']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].cedingCode"] = $this->StrToInt($ObjAccountRendering['J']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].brokerCoRefNo"] = $ObjAccountRendering['K'];
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].coQtr"] = $this->StrToInt($ObjAccountRendering['L']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].coYear"] = $this->StrToInt($ObjAccountRendering['M']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].uwYear"] = $this->StrToInt($ObjAccountRendering['N']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].identityInsured"] = $ObjAccountRendering['O'];
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].typeRisk"] = $ObjAccountRendering['P'];
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].curType"] = $ObjAccountRendering['Q'];
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].curCode"] = $ObjAccountRendering['R'];
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].prcShare"] = $this->StrToInt($ObjAccountRendering['S']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].premium"] = $this->StrToInt($ObjAccountRendering['T']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].commission"] = $this->StrToInt($ObjAccountRendering['U']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].orCommission"] = $this->StrToInt($ObjAccountRendering['V']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].brokerAge"] = $this->StrToInt($ObjAccountRendering['W']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].profitCommission"] = $this->StrToInt($ObjAccountRendering['X']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].xlPremium"] = $this->StrToInt($ObjAccountRendering['Y']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].lossesPaid"] = $this->StrToInt($ObjAccountRendering['Z']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].premiumResWHeld"] = $this->StrToInt($ObjAccountRendering['AA']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].premiumResReles"] = $this->StrToInt($ObjAccountRendering['AB']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].interestOnPlRes"] = $this->StrToInt($ObjAccountRendering['AD']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].taxes"] = $this->StrToInt($ObjAccountRendering['AD']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].lossesResWHeld"] = $this->StrToInt($ObjAccountRendering['AE']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].lossesResReles"] = $this->StrToInt($ObjAccountRendering['AF']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].cashLossWHeld"] = $this->StrToInt($ObjAccountRendering['AG']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].cashLossReles"] = $this->StrToInt($ObjAccountRendering['AH']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].cashLossRefund"] = $this->StrToInt($ObjAccountRendering['AI']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].exchangeDifference"] = $this->StrToInt($ObjAccountRendering['AJ']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].portPremium"] =$this->StrToInt($ObjAccountRendering['AK']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].portLosses"] = $this->StrToInt($ObjAccountRendering['AL']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].miscCharges"] = $this->StrToInt($ObjAccountRendering['AM']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].balance"] = $this->StrToInt($ObjAccountRendering['AN']);
                        $AccountRenderingData["accountRenderingDTOS[" . $counter . "].recordDateTime"] = date("m/d/Y h:m:s a", time());
                    }
                    $counter++;
                }

                $AccountRenderingData = http_build_query($AccountRenderingData);
                $response = $this->restservice->post($this->config->item("accountRendering_create"), $this->headers,$AccountRenderingData );

            }

            echo json_encode($response);
            return TRUE;
        }

        if($this->input->post('bulkEntry')) {
            unset($post['bulkEntry']);
            $accountRenderingDTOS = $post['accountRenderingDTOS'];
            // dd($accountRenderingDTOS);

            $postData = $response = [];
            $appDateTimeFormat = $this->config->item('backend_datetime_format');
            $cKey = $uKey = 0;
            foreach ($accountRenderingDTOS as $acRendDto) {
                // dd($acRendDto);
                if (!empty($acRendDto['premium']))
                {
                    $update = isset($acRendDto['id'])?true:false;
                    if ($update) {
                        $index = $uKey;
                        $postUrl = $this->module.'_update';
                        $cOrU = 'u';
                        $postData[$cOrU]['accountRenderingDTOS['.$index.'].id'] = $this->StrToInt($acRendDto['id']);
                        $uKey++;
                    } else {
                        $index = $cKey;
                        $postUrl = $this->module.'_create';
                        $cOrU = 'c';
                        $postData[$cOrU]['accountRenderingDTOS['.$index.'].recordDateTime'] = date($appDateTimeFormat, time());
                        $cKey++;
                    }
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].treatyName'] = $acRendDto['treatyName'];

                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].cedentName'] = $acRendDto['cedentName'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].brokerName'] = $acRendDto['brokerName'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].identityInsured'] = $acRendDto['identityInsured'];

                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].treatierDTO.id'] = $this->StrToInt($acRendDto['treatierDTO_id']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].prcYear'] = $this->StrToInt($acRendDto['prcYear']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].prcQtr'] = $this->StrToInt($acRendDto['prcQtr']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].dept'] = $this->isEmpty($acRendDto['dept']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].busType'] = $this->isEmpty($acRendDto['busType']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].reinsArr'] = $acRendDto['reinsArr'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].treatyCode'] = $this->StrToInt($acRendDto['treatyCode']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].brokerCode'] = $acRendDto['brokerCode'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].cedingCode'] = $acRendDto['cedingCode'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].brokerCoRefNo'] = $acRendDto['brokerCoRefNo'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].coQtr'] = $this->StrToInt($acRendDto['coQtr']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].coYear'] = $this->StrToInt($acRendDto['coYear']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].uwYear'] = $this->StrToInt($acRendDto['uwYear']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].identityInsured'] = $acRendDto['identityInsured'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].typeRisk'] = $acRendDto['typeRisk'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].curType'] = $acRendDto['curType'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].curCode'] = $acRendDto['curCode'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].prcShare'] = $this->StrToInt($acRendDto['prcShare']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].premium'] = $this->StrToInt($acRendDto['premium']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].commission'] = $this->StrToInt($acRendDto['commission']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].orCommission'] = $this->StrToInt($acRendDto['orCommission']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].brokerAge'] = $this->StrToInt($acRendDto['brokerAge']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].profitCommission'] = $this->StrToInt($acRendDto['profitCommission']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].xlPremium'] = $this->StrToInt($acRendDto['xlPremium']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].lossesPaid'] = $this->StrToInt($acRendDto['lossesPaid']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].premiumResWHeld'] = $this->StrToInt($acRendDto['premiumResWHeld']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].premiumResReles'] = $this->StrToInt($acRendDto['premiumResReles']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].interestOnPlRes'] = $this->StrToInt($acRendDto['interestOnPlRes']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].taxes'] = $this->StrToInt($acRendDto['taxes']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].lossesResWHeld'] = $this->StrToInt($acRendDto['lossesResWHeld']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].lossesResReles'] = $this->StrToInt($acRendDto['lossesResReles']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].cashLossWHeld'] = $this->StrToInt($acRendDto['cashLossWHeld']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].cashLossReles'] = $this->StrToInt($acRendDto['cashLossReles']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].cashLossRefund'] = $this->StrToInt($acRendDto['cashLossRefund']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].exchangeDifference'] = $this->StrToInt($acRendDto['exchangeDifference']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].portPremium'] = $this->StrToInt($acRendDto['portPremium']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].portLosses'] = $this->StrToInt($acRendDto['portLosses']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].miscCharges'] = $this->StrToInt($acRendDto['miscCharges']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].balance'] = $this->StrToInt($acRendDto['balance']);
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].arType'] = $acRendDto['arType'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].arDebitCredit'] = $acRendDto['arDebitCredit'];
                    $postData[$cOrU]['accountRenderingDTOS['.$index.'].arTreatyType'] = $acRendDto['arTreatyType'];
                } // if !empty premium
            } // end foreach

            if (!empty($postData['c'])) {
                $response = $this->postData($postUrl,$postData['c'],1,1);
            }
            if (!empty($postData['u'])) {
                $response = $this->postData($postUrl,$postData['u'],1,1);
            }

            if($response->code == 1)
            {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                $response->path = base_url('accountRendering');
            }

            echo json_encode($response);
            return TRUE;

        }

        $this->data['cedents'] = $this->getData('cedent_listing','',false,false,false);
        $this->data['tTypes'] = $this->getData('treaty_type_listing','',false,false,false);
        $this->data['bClasses'] = $this->getData('business_listing','',false,false,false);

        $this->load->view($this->module.'/arBulkEntryForm', $this->data);
    }


    public function searchAr()
    {
        $data = $accountRenderings = [];

        $post = replaceInArrayKey($this->input->post(),"_",".");

        if (!empty($post['cedentId']))
            $data['cedentId'] = $post['cedentId'];
        if (!empty($post['treatyTypeId']))
            $data['treatyTypeId'] = $post['treatyTypeId'];
        if (!empty($post['businessId']))
            $data['businessId'] = $post['businessId'];
        if (!empty($post['treatyYear']))
            $data['treatyYear'] = $post['treatyYear'];

        // dd($data);
        if (!empty($data)) {
            $accountRenderings = $this->postData('treatySlipGeneral_get_with_filters',$data,true,true);
            // if (!empty($accountRenderings)) {
                echo json_encode($accountRenderings);
                return true;
            // }
            
            // $resp = [
            //     'code' => 2,    
            //     'message' => 'Service returned with empty data',    
            // ];
            // echo json_encode($resp);
            // return true;
        }

        $resp = [
            'code' => 11,    
            'message' => 'No Search Filter Selected',    
        ];

        echo json_encode($resp);
        return true;
    }


    /**
     *
     *   This Module Form
     *
    */
    public function moduleFormData($formValues='')
    {
        $data = [
            'pageTitle' => 'Account Rendering',
            'addModuleView' => 'listingTable',// loadpage and can be array for multiple pages
            'form' => [
                'action' => base_url($this->module."/create"),
                'attributes' => [
                    'class' => 'form-horizontal', 
                    'id'    => $this->module.'_form',
                ],
                'inputs' => [ // START: Inputs
                    [ //tretierId
                        'name'          => 'treatierDTO.id',
                        'type'          => 'hidden',
                        'class'         => 'tretierId',
                    ],
                    /* treatyName */
                    [
                        'label'         => 'Treaty Name',
                        'placeholder'   => 'Treaty Name',
                        'name'          => 'treatyName',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control treatyName',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //prcYear
                        'label'         => 'PRC Year',
                        'placeholder'   => 'Enter PRC Year',
                        'name'          => 'prcYear',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control prcYear',
                        'validation'    => [
                            'required'      => true,
                            'number'        => true,
                            'minlength'     => 4,
                            'maxlength'     => 4 ,

                        ],
                    ],
                    [ //dept
                        'label'         => 'Department',
                        'placeholder'   => 'Enter Department',
                        'name'          => 'dept',
                        'type'          => 'text',
                        'class'         => 'form-control dept',
                        'readonly'      => 'readonly',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //busType
                        'label'         => 'Business Class',
                        'placeholder'   => 'Enter Business Class',
                        'name'          => 'busType',
                        'type'          => 'text',
                        'class'         => 'form-control busType',
                        'readonly'      => 'readonly',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //curCode
                        'label'         => 'Currency Code',
                        'placeholder'   => 'Enter Currency Code',
                        'name'          => 'curCode',
                        'type'          => 'text',
                        'class'         => 'form-control curCode',
                        'readonly'      => 'readonly',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //prcShare
                        'label'         => 'PRC Share',
                        'placeholder'   => 'Enter PRC Share',
                        'name'          => 'prcShare',
                        'type'          => 'text',
                        'class'         => 'form-control prcShare',
                        'readonly'      => 'readonly',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //treatyCode
                        'label'         => 'Treaty Code',
                        'placeholder'   => 'Enter Treaty Code',
                        'name'          => 'treatyCode',
                        'type'          => 'text',
                        'class'         => 'form-control treatyCode',
                        'readonly'      => 'readonly',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    /* arTreatyType */
                    // [
                    //     'type'          => 'select',
                    //     'label'         => 'Treaty Type',
                    //     'attributes'    =>[
                    //         'readonly'      => 'readonly',
                    //         'placeholder'   => 'Select Treaty Type',
                    //         'name'          => 'arTreatyType',
                    //         'class'         => 'form-control arTreatyType',
                    //     ],
                    //     'options'       => $this->config->item('arTreatyType'),
                    //     'validation'    =>[
                    //         'required'      => true,
                    //     ],
                    // ],
                    /* arTreatyType main input */
                    [ 
                        'name'          => 'arTreatyType',
                        'type'          => 'hidden',
                        'class'         => 'arTreatyType',
                        'value'         => '',
                    ],
                    /* arTreatyTypeDummy dummy for UI */
                    [
                        'label'         => 'Treaty Type',
                        'placeholder'   => 'Auto Treaty Type',
                        'name'          => '',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control arTreatyTypeDummy',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //uwYear
                        'label'         => 'UW Year',
                        'placeholder'   => 'Enter UW Year',
                        'name'          => 'uwYear',
                        'type'          => 'text',
                        'class'         => 'form-control uwYear',
                        'readonly'      => 'readonly',
                        'validation'    => [
                            'required'      => true,
                            'number'        => true,
                            'minlength'     => 4,
                            'maxlength'     => 4 ,

                        ],
                    ],
                    [ //cedingCode
                        'label'         => 'Ceding Code',
                        'placeholder'   => 'Enter Ceding Code',
                        'name'          => 'cedingCode',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control cedingCode',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                   [ //cedingName
                        'label'         => 'Cedent Name',
                        'placeholder'   => 'Enter Cedent Name',
                        'name'          => 'cedingName',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control cedingName',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //brokerCode
                        'label'         => 'Broker Code',
                        'placeholder'   => 'Enter Broker Code',
                        'name'          => 'brokerCode',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control brokerCode',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //brokerName
                        'label'         => 'Broker Name',
                        'placeholder'   => 'Enter Broker Name',
                        'name'          => 'brokerName',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control brokerName',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],

                    [ //prcQtr
                        'label'         => 'PRC Qtr',
                        'placeholder'   => 'Enter PRC Qtr',
                        'name'          => 'prcQtr',
                        'type'          => 'text',
                        'class'         => 'form-control prcQtr',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //reinsArr
                        'label'         => 'Reins Arr',
                        'placeholder'   => 'Enter Reins Arr',
                        'name'          => 'reinsArr',
                        'type'          => 'text',
                        'class'         => 'form-control reinsArr',
                        // 'readonly'      => 'readonly',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //brokerCoRefNo
                        'label'         => 'Broker Code Ref. No.',
                        'placeholder'   => 'Enter Broker Code Ref. No.',
                        'name'          => 'brokerCoRefNo',
                        'type'          => 'text',
                        'class'         => 'form-control brokerCoRefNo',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //coQtr
                        'label'         => 'Company Qtr.',
                        'placeholder'   => 'Enter Company Qtr.',
                        'name'          => 'coQtr',
                        'type'          => 'text',
                        'class'         => 'form-control coQtr',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //coYear
                        'label'         => 'Company Year',
                        'placeholder'   => 'Enter Company Year',
                        'name'          => 'coYear',
                        'type'          => 'text',
                        'class'         => 'form-control coYear',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],

                    [ //identityInsured
                        'label'         => 'Identity Insured',
                        'placeholder'   => 'Enter Identity Insured',
                        'name'          => 'identityInsured',
                        'type'          => 'text',
                        'class'         => 'form-control identityInsured',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //typeRisk
                        'label'         => 'Type Risk',
                        'placeholder'   => 'Enter Type Risk',
                        'name'          => 'typeRisk',
                        'type'          => 'text',
                        'class'         => 'form-control typeRisk',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //curType
                        'label'         => 'Currrency Type',
                        'placeholder'   => 'Enter Currrency Type',
                        'name'          => 'curType',
                        'type'          => 'text',
                        'class'         => 'form-control curType',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],

                    /* SUM Starts here*/
                    [ //premium
                        'label'         => 'Premium',
                        'placeholder'   => 'Enter Premium',
                        'name'          => 'premium',
                        'type'          => 'text',
                        'class'         => 'form-control premium',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //commission
                        'label'         => 'Commission',
                        'placeholder'   => 'Enter Commission',
                        'name'          => 'commission',
                        'type'          => 'text',
                        'class'         => 'form-control commission',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //orCommission
                        'label'         => 'OR Commission',
                        'placeholder'   => 'Enter OR Commission',
                        'name'          => 'orCommission',
                        'type'          => 'text',
                        'class'         => 'form-control orCommission',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //brokerAge
                        'label'         => 'Brokerage',
                        'placeholder'   => 'Enter Brokerage',
                        'name'          => 'brokerAge',
                        'type'          => 'text',
                        'class'         => 'form-control brokerAge',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //profitCommission
                        'label'         => 'Profit Commission',
                        'placeholder'   => 'Enter Profit Commission',
                        'name'          => 'profitCommission',
                        'type'          => 'text',
                        'onchange'      => 'calcBalance()',
                        'class'         => 'form-control profitCommission',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //xlPremium
                        'label'         => 'XL Premium',
                        'placeholder'   => 'Enter XL Premium',
                        'name'          => 'xlPremium',
                        'type'          => 'text',
                        'onchange'      => 'calcBalance()',
                        'class'         => 'form-control xlPremium',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //lossesPaid
                        'label'         => 'Losses Paid',
                        'placeholder'   => 'Enter Losses Paid',
                        'name'          => 'lossesPaid',
                        'type'          => 'text',
                        'onchange'      => 'calcBalance()',
                        'class'         => 'form-control lossesPaid',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //premiumResWHeld
                        'label'         => 'Premium Res W Held',
                        'placeholder'   => 'Enter Premium Res W Held',
                        'name'          => 'premiumResWHeld',
                        'type'          => 'text',
                        'class'         => 'form-control premiumResWHeld',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //premiumResReles
                        'label'         => 'Premium Res. Reles',
                        'placeholder'   => 'Enter Premium Res. Reles',
                        'name'          => 'premiumResReles',
                        'type'          => 'text',
                        'onchange'      => 'calcBalance()',
                        'class'         => 'form-control premiumResReles',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //interestOnPlRes
                        'label'         => 'Interest On Pl Res.',
                        'placeholder'   => 'Enter Interest On Pl Res.',
                        'name'          => 'interestOnPlRes',
                        'type'          => 'text',
                        'class'         => 'form-control interestOnPlRes',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //taxes
                        'label'         => 'Taxes',
                        'placeholder'   => 'Enter Taxes',
                        'name'          => 'taxes',
                        'type'          => 'text',
                        'class'         => 'form-control taxes',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //lossesResWHeld
                        'label'         => 'losses Res. W Held',
                        'placeholder'   => 'Enter losses Res. W Held',
                        'name'          => 'lossesResWHeld',
                        'type'          => 'text',
                        'class'         => 'form-control lossesResWHeld',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //lossesResReles
                        'label'         => 'Losses Res. Reles.',
                        'placeholder'   => 'Enter Losses Res. Reles.',
                        'name'          => 'lossesResReles',
                        'type'          => 'text',
                        'class'         => 'form-control lossesResReles',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //cashLossWHeld
                        'label'         => 'Cash Loss W Held',
                        'placeholder'   => 'Enter Cash Loss W Held',
                        'name'          => 'cashLossWHeld',
                        'type'          => 'text',
                        'class'         => 'form-control cashLossWHeld',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //cashLossReles
                        'label'         => 'Cash Loss Reles',
                        'placeholder'   => 'Enter Cash Loss Reles',
                        'name'          => 'cashLossReles',
                        'type'          => 'text',
                        'class'         => 'form-control cashLossReles',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //cashLossRefund
                        'label'         => 'Cash Loss Re-fund',
                        'placeholder'   => 'Enter Cash Loss Re-fund',
                        'name'          => 'cashLossRefund',
                        'type'          => 'text',
                        'class'         => 'form-control cashLossRefund',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //exchangeDifference
                        'label'         => 'Exchange Difference',
                        'placeholder'   => 'Enter Exchange Difference',
                        'name'          => 'exchangeDifference',
                        'type'          => 'text',
                        'class'         => 'form-control exchangeDifference',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //portPremium
                        'label'         => 'Port Premium',
                        'placeholder'   => 'Enter Port Premium',
                        'name'          => 'portPremium',
                        'type'          => 'text',
                        'class'         => 'form-control portPremium',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //portLosses
                        'label'         => 'Port Losses',
                        'placeholder'   => 'Enter Port Losses',
                        'name'          => 'portLosses',
                        'type'          => 'text',
                        'class'         => 'form-control portLosses',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //miscCharges
                        'label'         => 'Misc. Charges',
                        'placeholder'   => 'Enter Misc. Charges',
                        'name'          => 'miscCharges',
                        'type'          => 'text',
                        'class'         => 'form-control miscCharges',
                        'onchange'      => 'calcBalance()',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    [ //balance /* This field Value is sum from premiums to miscCharges*/
                        'label'         => 'Balance',
                        'placeholder'   => 'Enter Balance',
                        'name'          => 'balance',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control balance',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],
                    /* arDebitCredit */
                    // [
                    //     'type'          => 'select',
                    //     'label'         => 'Dr/Cr',
                    //     'attributes'    =>[
                    //         'placeholder'   => 'Select Dr/Cr',
                    //         'readonly'      => 'readonly',
                    //         'name'          => 'arDebitCredit',
                    //         'class'         => 'form-control arDebitCredit',
                    //     ],
                    //     'options'       => $this->config->item('arDebitCredit'),
                    //     'validation'    =>[
                    //         'required'      => true,
                    //     ],
                    // ],

                    [ /* arDebitCreditDummy its dummy just for UI */
                        'label'         => 'Cr/Dr',
                        'placeholder'   => 'Auto Cr/Dr',
                        'name'          => '',
                        'type'          => 'text',
                        'readonly'      => 'readonly',
                        'class'         => 'form-control arDebitCreditDummy',
                        'validation'    => [
                            'required'      => true,
                        ],
                    ],

                    [ /* arDebitCredit this is main ac rend cr dr field */
                        'name'          => 'arDebitCredit',
                        'type'          => 'hidden',
                        'class'         => 'arDebitCredit',
                        'value'         => '',
                    ],
                    // [ //recordDateTime
                    //     'label'         => 'Record Date',
                    //     'placeholder'   => 'Enter Record Date',
                    //     'name'          => 'recordDateTime',
                    //     'type'          => 'text',
                    //     'class'         => 'form-control recordDateTime fc-datepicker',
                    //     'validation'    => [
                    //         'required'      => true,
                    //     ],
                    // ],

                    [ //recordDateTime
                        // 'label'         => 'Record Date',
                        // 'placeholder'   => 'Enter Record Date',
                        'name'          => 'recordDateTime',
                        'type'          => 'hidden',
                        'class'         => 'recordDateTime',
                        'value'         => date($this->config->item('backend_datetime_format')),
                    ],

                    /* arType */
                    [
                        'type'          => 'select',
                        'label'         => 'A/c Rendering Type',
                        'attributes'    =>[
                            'placeholder'   => 'Select AR Type',
                            'name'          => 'arType',
                            'class'         => 'form-control arType',
                        ],
                        'options'       => $this->config->item('arType'),
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

    /**
     *
     *  AccountRendering Create Service 
     *
    */
    public function arCreate()
    {
        if ($this->input->post('treatierDTO_id')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
            $response = $this->postData($this->module.'_singleCreate',$post,1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;

            if($response->code == 1) {
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
     *  AccountRendering Edit Service 
     *
    */
    public function edit($id=NULL)
    {
        $id = base64_decode($id);
        if ($this->input->post('treatierDTO_id')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
            $post['treatierDTO.id'] = base64_decode($post['treatierDTO.id']);
            if (isset($post['id'])) {
                $post['id'] = base64_decode($post['id']);
                $createOrUpate = '_singleUpdate';
            } else {
                $createOrUpate = '_singleCreate';
            }

            $response = $this->postData($this->module.$createOrUpate,$post,1,1);
            $token = $this->security->get_csrf_hash();
            // dd($response);
            $this->data['data'] = $response;
            $this->data['token'] = $token;

            if($response->code == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
            }
            
            toJson($this->data);
            return TRUE;
        }
        $response = $this->getData($this->module.'_view', $id, false, false);

        $response = $response['data'];
        $module = $this->module;
        $html = $this->moduleFormData();

        $this->data =  compact('module','html','response');
        $this->load->view('form',$this->data);
    }

    public function get($id='')
    {
        if (!empty($id)) {
            $id = base64_decode($id);
            $singleOrMulti = $this->module.'_view';
        } else {
            $singleOrMulti = $this->module.'_listing';
        }
        $response = $this->getData($singleOrMulti , $id);
        return $response;
    }

    public function getAllByTreatier($treatierId='')
    {
        $treatierId = base64_decode($treatierId);
        $url = $this->module.'_getAllByTreatierId';
        $data = $this->getData($url,$treatierId);
        return $data;
    }

    public function view($id='')
    {
        $id = base64_decode($id);
        if ($this->input->post('treatierDTO_id')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
            $post['treatierDTO.id'] = base64_decode($post['treatierDTO.id']);
            if (isset($post['id'])) {
                $post['id'] = base64_decode($post['id']);
                $createOrUpate = '_singleUpdate';
            } else {
                $createOrUpate = '_singleCreate';
            }

            $response = $this->postData($this->module.$createOrUpate,$post,1,1);
            $token = $this->security->get_csrf_hash();
            // dd($response);
            $this->data['data'] = $response;
            $this->data['token'] = $token;

            if($response->code == 1) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
            }
            
            toJson($this->data);
            return TRUE;
        }
        $response = $this->getData($this->module.'_view', $id, false, false);

        $response = $response['data'];
        $module = $this->module;
        $html = $this->moduleFormData();

        $this->data =  compact('module','html','response');
        $this->load->view('form',$this->data);
    }

    public function reverse($value='')
    {
        # add reverse link in listing from js as well
    }
    function StrToInt($str_value)
    {
        if($str_value !='')
        {
            if(strpos($str_value,"(") AND strpos($str_value,")"))
            {
                $str_value = str_replace(array('(',")"), '', $str_value);
                $str_value = str_replace(",", '', $str_value);
                $str_value = intval(-abs($str_value));
                $str_value = round($str_value ,3);
                return $str_value;
            }
            else{
                $str_value = intval(str_replace(',', '', $str_value));
                $str_value = round($str_value ,3);
                return $str_value;
            }

        }else{
            return 0;
        }
    }

    public function delete()
    {

        if ($this->input->post('id')) {

            $id = base64_decode($this->input->post('id'));
            $response = $this->restservice->get($this->config->item("accountRendering_delete"). "/" . $id, $this->headers);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

    public function readExcel($filePath='')
    {
        $spreadsheet = IOFactory::load($filePath);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        return $sheetData;
    }

    function isEmpty($value)
    {
        if($value =='' OR $value == null)
            return 'null';
        else
            return $value;

    }




}
