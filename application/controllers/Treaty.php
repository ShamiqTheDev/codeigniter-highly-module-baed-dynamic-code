<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class treaty extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->check_auth();

        // To load the CI benchmark and memory usage profiler - set 1==1.
        if (1 == 2) {
            $sections = array(
                'benchmarks' => TRUE, 'memory_usage' => TRUE,
                'config' => FALSE, 'controller_info' => FALSE, 'get' => FALSE, 'post' => FALSE, 'queries' => FALSE,
                'uri_string' => FALSE, 'http_headers' => FALSE, 'session_data' => FALSE
            );
            $this->output->set_profiler_sections($sections);
            $this->output->enable_profiler(TRUE);
        }

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;

    }

    public function index($pageNo='')
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data'))
        {
            $userData = $this->session->get_userdata('userData')['userData'];
            $uRoleId = $userData->roles_permissions->id;
            if (!empty($uRoleId)) {
                $_POST['roleId'] = $uRoleId;
            }
            if (!empty($pageNo)) {
                $_POST['totalPages'] = $pageNo;
            }

            $post = array_merge($_POST,$this->config->item('listing'));
            $response = new StdClass();

            if (isset($post['filters']) && !empty($post['filters']))
            {
                $filters = $post['filters'];
                unset($post['filters'],$post['givenFilters'],$post['filter'],$post['get_data']);
                $post = array_merge($post,$filters);
            }
            $sendData = http_build_query($_POST);
            $response = $this->restservice->post($this->config->item("treater_get_group_by_agreement_id"), $this->headers, $sendData);

            $customizedData = array();
            $responseData = $response->data;
            foreach ($responseData as $key => $ResponseObject)
            {
                    $treatyTypes ='';
                    $cedentNames ='';
                    $businessClass ='';
                    if(isset($ResponseObject->treatierDTOS))
                    {
                        $treatier =  $ResponseObject->treatierDTOS;
                        $treatyTypes = array();
                        $businessClass = array();
                        foreach ($treatier as $key => $Objtreatier)
                        {
                            if(isset($Objtreatier->treatyStatisticsDTO->treatyTypeDTO->type)){
                                $treatyTypes[] = $Objtreatier->treatyStatisticsDTO->treatyTypeDTO->type;
                            }


                            if(isset($Objtreatier->treatyStatisticsDTO->cedentDTO->customerName)){
                                $cedentNames = $Objtreatier->treatyStatisticsDTO->cedentDTO->customerName;
                            }

                            if(isset($Objtreatier->treatyStatisticsDTO->businessDTOs))
                            {
                                foreach ($Objtreatier->treatyStatisticsDTO->businessDTOs as $Objbusiness)
                                {
                                    $businessClass[] = str_replace(array("-s","-S"),"",$Objbusiness->name);
                                }
                            }

                        }
                        $treatyTypes = array_unique($treatyTypes);
                        $treatyTypes = implode(", ",$treatyTypes);

                        $businessClass = array_unique($businessClass);
                        $businessClass = implode(", ",$businessClass);

                    }


                    $customizedData[] = array(
                        "id"                                        => $ResponseObject->id,
                        "agreementNumber"                           => $ResponseObject->agreementNumber,
                        "cedentName"                                => $cedentNames,
                        "treatyCategory"                            => (isset($ResponseObject->treatyCategoryDTO->name)) ? $ResponseObject->treatyCategoryDTO->name : '',
                        "treatyType"                                => $treatyTypes,
                        "noOfTreaties"                              => (isset($ResponseObject->treatierDTOS)) ? count($ResponseObject->treatierDTOS):'',
                        "businessClass"                             => $businessClass,

                    );
            }
            $response->data = $customizedData;
            $response = $obj = json_decode(json_encode($response));
            $token = $this->security->get_csrf_hash();
            $get_responce["get_data"] = $response;
            $get_responce["get_csrf_hash"] = $token;
            echo json_encode($get_responce);
            return TRUE;

        }

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array(
            "agreementNumber"      => $this->lang->line('col_AgreementNumber'),
            "cedentName"           => $this->lang->line('col_cedentName'),
            "businessClass"        => $this->lang->line('col_businessClass'),
            "treatyCategory"       => $this->lang->line('col_TreatyCategory'),
            "treatyType"           => $this->lang->line('col_treatyType'),
            "noOfTreaties"         => $this->lang->line('col_NoOfTreaties'),
        ));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['direction'] = 'desc';
        $ListingConfig['sortBy'] = 'id';
        $ListingConfig['ActionButtons'] = array(
             "View_TreatySlip"  => $this->isPermission('treaty/treaty_slip',false,true),
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_treatydetails');

        $filters = $this->config->item('treaty_details','filters');

        $ListingConfig['filters'] = $filters;
        $this->data['ListingConfig'] = $ListingConfig;

        $this->load->view('listing', $this->data);
    }

    public function slips($slipId='')
    {
        $_SESSION['slips_url'] = current_url();
        $userData = $this->session->get_userdata('userData')['userData'];
        $uRoleId = $userData->roles_permissions->id;
        $uRoleName = $userData->roles_permissions->name;

        $this->data['userData'] = $userData;
        $this->data['uRoleId'] = $uRoleId;
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data'))
        {
            $slipId = base64_decode($slipId);
            $userData = $this->session->get_userdata('userData')['userData'];
            $uRoleId = $userData->roles_permissions->id;
            if (!empty($uRoleId)) {
                $_POST['roleId'] = $uRoleId;
            }
            if (!empty($pageNo)) {
                $_POST['totalPages'] = $pageNo;
            }

            $_POST = array_merge($_POST,$this->config->item('listing'));


            $post = $this->input->post();

            if (isset($post['filters']) && !empty($post['filters']))
            {
                $filters = $post['filters'];
                unset($post['filters'],$post['givenFilters']);
                $post = array_merge($post,$filters);

            }

            $response = $this->getData("treater_details_by_agreement",$slipId,0,0,0);
            $response['data'] = json_decode(json_encode($response));

            $customizedData = array();
            $responseData = $response['data'];
            foreach ($responseData as $key => $ResponseObject) {
                $businessDTOs ='';
                if(isset($ResponseObject->treatyStatisticsDTO->businessDTOs))
                {
                    $BusinesClasses = array();
                    foreach ($ResponseObject->treatyStatisticsDTO->businessDTOs as $key => $businessClass)
                    {
                        $BusinesClasses[] = str_replace(array("-s","-S"),"",$businessClass->name);

                    }
                    $BusinesClasses = array_unique($BusinesClasses);
                    $businessDTOs = implode(", ",$BusinesClasses);

                }

                $customizedData[] = array(
                    "id"                                        => $ResponseObject->id,
                    "treatierId"                                => $ResponseObject->id,
                    "name"                                      => $ResponseObject->name,
                    "cedentName"                                => (isset($ResponseObject->treatyStatisticsDTO->cedentDTO->customerName)) ? $ResponseObject->treatyStatisticsDTO->cedentDTO->customerName : '',
                    "treatyCategory"                            => (isset($ResponseObject->agreementDTO->treatyCategoryDTO->name)) ? $ResponseObject->agreementDTO->treatyCategoryDTO->name : '',
                    "treatyType"                                => (isset($ResponseObject->treatyStatisticsDTO->treatyTypeDTO->type))? $ResponseObject->treatyStatisticsDTO->treatyTypeDTO->type : '',
                    "currentYear"                               => (isset($ResponseObject->treatyStatisticsDTO->currentYear)) ? $ResponseObject->treatyStatisticsDTO->currentYear:'',
                    'businessClass'                             => $businessDTOs,
                    'flagChangeHistoryDTOs'                     => $ResponseObject->flagChangeHistoryDTOs,
                );
            }
            $response['data'] = $customizedData;
            $token = $this->security->get_csrf_hash();
            $get_responce["get_data"] =  json_decode(json_encode($response,true));
            $get_responce["get_csrf_hash"] = $token;
            echo json_encode($get_responce);
            return TRUE;

        }
        if ($this->uri->segment(4) == 'delete') {
            $delId = $this->uri->segment(3);
            $this->delete($delId);
        }

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array(
            "treatierId"          => "Treaty Id",
            "name"                  => "Treaty Name",
            "cedentName"            => "Cedent Name",
            "businessClass"         => "Business Class",
            "treatyCategory"        => "Treaty Category",
            "treatyType"            => "Treaty Type",
            "currentYear"           => "Treaty Year",
        ));

        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "view_treaty_slip_entered" => true,
            "view_slip" => true,
            // "Delete" => false,
            "View_TreatySlips"  => $this->isPermission('treaty/slips',false,true),
            "Add_Endorsement"  => $this->isPermission('treaty/endorsement',false,true),
            "Create_Renewal"   => $this->isPermission('treaty/createRenewal',false,true),
        );

        $ListingConfig['PageTitle'] = "Treaty Slip";
        $this->data['ListingConfig'] = $ListingConfig;

        $this->load->view('listing', $this->data);
    }


    public function treaty_statistics()
    {
        $this->load->view('treaty/treaty_statistics',$this->data);
    }


    public function entered($pageNo='')
    {
        $this->isPermission($this->uri->segment(1));
        if ($this->input->post('get_data'))
        {
            $userData = $this->session->get_userdata('userData')['userData'];
            $uRoleId = $userData->roles_permissions->id;
            if (!empty($uRoleId)) {
                $_POST['roleId'] = $uRoleId;
            }
            if (!empty($pageNo)) {
                $_POST['totalPages'] = $pageNo;
            }

            $_POST = array_merge($_POST,$this->config->item('listing'));


            $post = $this->input->post();

            if (isset($post['filters']) && !empty($post['filters']))
            {
                $filters = $post['filters'];
                unset($post['filters'],$post['givenFilters']);
                $post = array_merge($post,$filters);

            }

            $sendData = http_build_query($post);
            $response = $this->restservice->post($this->config->item("treater_completedTreaties"), $this->headers, $sendData);

            $customizedData = array();
            $responseData = $response->data;
            foreach ($responseData as $key => $ResponseObject)
            {
                $businessDTOs ='';
                if(isset($ResponseObject->treatyStatisticsDTO->businessDTOs))
                {
                    $BusinesClasses = array();
                    foreach ($ResponseObject->treatyStatisticsDTO->businessDTOs as $key => $businessClass)
                    {
                        $BusinesClasses[] = str_replace(array("-s","-S"),"",$businessClass->name);

                    }
                    $BusinesClasses = array_unique($BusinesClasses);
                    $businessDTOs = implode(", ",$BusinesClasses);

                }

                $assignToOptions = $this->config->item('assignToOptions');
                $customizedData[] = array(
                    "id"                                        => $ResponseObject->id,
                    "treatierId"                                => $ResponseObject->id,
                    "name"                                      => $ResponseObject->name,
                    "cedentName"                                => (isset($ResponseObject->treatyStatisticsDTO->cedentDTO->customerName)) ? $ResponseObject->treatyStatisticsDTO->cedentDTO->customerName : '',
                    "treatyCategory"                            => (isset($ResponseObject->agreementDTO->treatyCategoryDTO->name)) ? $ResponseObject->agreementDTO->treatyCategoryDTO->name : '',
                    "treatyType"                                => (isset($ResponseObject->treatyStatisticsDTO->treatyTypeDTO->type))? $ResponseObject->treatyStatisticsDTO->treatyTypeDTO->type : '',
                    "currentYear"                               => (isset($ResponseObject->treatyStatisticsDTO->currentYear)) ? $ResponseObject->treatyStatisticsDTO->currentYear:'',
                    'treatyStatus'                              => $ResponseObject->treatySlipGeneralDTO->treatyStatus,
                    'assignTo'                                  => (isset($assignToOptions[$ResponseObject->treatySlipGeneralDTO->assignTo]))? $assignToOptions[$ResponseObject->treatySlipGeneralDTO->assignTo] :'',
                    'businessClass'                             => $businessDTOs,
                );
            }
            $response->data = $customizedData;
            $token = $this->security->get_csrf_hash();
            $get_responce["get_data"] =  json_decode(json_encode($response,true));
            $get_responce["get_csrf_hash"] = $token;
            echo json_encode($get_responce);
            return TRUE;

        }

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array(
            "treatierId"            => $this->lang->line('col_Treatyid') ,
            "name"                  => $this->lang->line('col_TreatyName'),
            "cedentName"            => $this->lang->line('col_cedentName'),
            "businessClass"         => $this->lang->line('col_businessClass'),
            "treatyCategory"        => $this->lang->line('col_TreatyCategory'),
            "treatyType"            => $this->lang->line('col_treatyType'),
            "currentYear"           => $this->lang->line('col_TreatyYear'),
            'treatyStatus'          => $this->lang->line('col_Status'),
            'assignTo'              => $this->lang->line('col_Person'),
        ));

        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['ActionButtons'] = array(
            "view_treaty_slip_entered" => true,
            "Delete" => true,
        );

        $ListingConfig['PageTitle'] = $this->lang->line('menu_Treatyentered');
        $ListingConfig['BtnAddNewRecordTitle'] = $this->lang->line('btn_add_new_treatyEntered');

        $filters = $this->config->item('TreatyEntered','filters');

        $ListingConfig['filters'] = $filters;
        $this->data['ListingConfig'] = $ListingConfig;

        $this->load->view('listing', $this->data);
    }


    public function treaty_agrement()
    {
        $this->load->view('treaty/treaty_agrement',$this->data);
    }

    public function treaty_slip($Treater_id,$byAreementId = '')
    {
        $Treater_id = base64_decode($Treater_id);
        if($byAreementId !='')
        {
            $agreement_id = $Treater_id;
            $aTreaties = $this->restservice->get($this->config->item("treater_details_by_agreement")."/$agreement_id", $this->headers);
            $aTreaties = json_decode(json_encode($aTreaties), true);
            $aTreaties = array_column($aTreaties,"id");
            $Treater_id = $aTreaties[0];
        }
        /* this is because in url agreement id passed with name of treatier id */ 
        $this->data['treater_id'] = $Treater_id; 
        $this->data["action"] = "add_record";

        if($this->input->post('treatyslip_general'))
        {
            $Leader = $Inclusive = $Exclusive = $Follower = $incExcTime= 0;
            if($this->input->post('leader_follower') == 1)
                $Leader = 1;
            if($this->input->post('leader_follower') == 1)
                $Follower = 1;

            if($this->input->post('inclusive') == 1)
                $Inclusive = true;

            if($this->input->post('exclusive') == 1)
                $Exclusive = true;

            if($this->input->post('incExcTime'))
                $incExcTime = $this->input->post('incExcTime');

            $Currency = explode("|",$this->input->post('currency'));
            $Rate_Type = explode("|",$this->input->post('Rate_Type'));

            $TreatySlip_General_Data = array(
                        "treatierDTO.id" => $Treater_id,
                        // "rmsInsuredDTO.id" => $this->input->post('rmsInsured'),
                        "treatyStatus" => $this->input->post('treatyStatus'),
                        "agreementDTO.id" => $this->input->post('agreementId'),
                        "agreementNo" => $this->input->post('treater_agreementNumber'),
                        "currency" => $Currency[1],
                        "currencyRate" => $this->input->post('currency_rate'),
                        "effectiveFrom" => date("m/d/Y",strtotime($this->input->post('effectiveFrom'))),
                        "egnpiActual" => $this->input->post('egnpiActual'),
                        "egnpiRevise" => $this->input->post('egnpiRevise'),
                        "epiActual" => $this->input->post('epiActual'),
                        "epiRevised" => $this->input->post('epiRevised'),
                        "exclusive" => $Exclusive,
                        "expireOn" => date("m/d/Y",strtotime($this->input->post('expireOn'))),
                        "fileRefNo" => $this->input->post('fileRefNo'),
                        "follower" =>$Follower,
                        "incExcTime" => $this->input->post('incExcTime'),
                        "inclusive" => $Inclusive,
                        "jurisdiction" => $this->input->post('jurisdiction'),
                        "leader" =>$Leader,
                        "liabilityLimit" => $this->input->post('liabilityLimit'),
                        "lossCap" => $this->input->post('lossCap'),
                        // "lossCapValue" => $this->input->post('lossCapValue'),
                        // "lossParticipation" => $this->input->post('lossParticipation'),
                        // "managementExpense" => $this->input->post('managementExpenses'),
                        // "mpl" => $this->input->post('mpl_value'),
                        // "mplError" => $this->input->post('mplError'),
                        "participationFlag" => $this->input->post('participationFlag'),
                        "paymentTerm" => $this->input->post('payment_terms'),
                        "perils" => $this->input->post('perils'),
                        "portfolio" => $this->input->post('portfolioType'),
                        "portfolioType" => $this->input->post('portfolioType'),
                        // "prcAmount" => $this->input->post('prcAmount'),
                        "profitCommissionRate" => $this->input->post('profitCommissionRate'),
                        // "profitCommission" => $this->input->post('profitCommission'),
                       // "prcShare" => $this->input->post('prcShare'),
                        "premiumWarrantyPayable" => $this->input->post('premiumWarrantyPayable'),
                        // "riskCovered" => $this->input->post('riskCovered'),
                        "riskNo"=>0000,
                        // "sumInsured" => $this->input->post('sumInsured'),
                        "territorialScope" => $this->input->post('territorialScope'),
                        "timeInExpiry" => $this->input->post('incExcTime'),
                        "treatyComments" => $this->input->post('treatyComments'),
                        "treatyLimitCoFacultative" => $this->input->post('treatyLimitCoFacultative'),
                        "treatyLimitCoInsurance" => $this->input->post('treatyLimitCoInsurance'),
                       // "treatyNo" => $this->input->post('treatier_code'),
                        "umrNumber" => $this->input->post('umrNumber'),
                        "cashLossRate" => $this->input->post('cashLossRate'),
                        "cashLossValue" => $this->input->post('cashLossValue'),
                        "prcShareRate" => ($this->input->post('prcShareRate') ? $this->input->post('prcShareRate') : 0 ),
                        // "prcShareValue" => $this->input->post('prcShareValue'),
                        // "description" => $this->input->post('description'),
                        // "specialAcceptance" => $this->input->post('specialAcceptance'),
                        "eventLimitValue" => $this->input->post('eventLimitValue'),
                        "uwInceptionYear" => $this->input->post('uwInceptionYear'),
                        "claPrcShareValue" => $this->input->post('claPrcShareValue'),
                        "plaPrcShareValue" => $this->input->post('plaPrcShareValue'),

                        "uwStatus" => $this->input->post('uwStatus'),
                        "assignTo" => $this->input->post('assignTo'),
                        "uwType" => $this->input->post('uwType'),
                        "isPreApproved" => $this->input->post('isPreApproved'),
                     ); 
                    if($this->input->post('leader_id')) {
                        $TreatySlip_General_Data["leaderFollowerDTO.id"] = $this->input->post('leader_id');
                    }
                    if($this->input->post('Broker')) {
                        $TreatySlip_General_Data["brokerDTO.id"] = $this->input->post('Broker'); 
                    }

                    if($this->input->post('treatySubTypes'))
                    {
                        $treaty_subTypes = $this->input->post('treatySubTypes');
                        for ($a = 0;$a < count($treaty_subTypes);$a++)
                        {
                            $TreatySlip_General_Data["treatySubTypeDTOs[".$a."].id"] = $treaty_subTypes[$a];
                        }

                    }

                    if($this->input->post('riskCoveredIds'))
                    {
                        $riskCoveredIds = $this->input->post('riskCoveredIds');
                        for ($a = 0;$a < count($riskCoveredIds);$a++)
                        {
                            $TreatySlip_General_Data["riskCoveredDTOS[".$a."].id"] = $riskCoveredIds[$a];
                        }

                    }

                    if($Rate_Type[1] !='Fixed')
                    {
                        $TreatySlip_General_Data["currencyRateDTO.id"] = trim($this->input->post('currency_rateId'));
                    }

                    if($this->input->post('treatySlipGeneralId'))
                    {
                        $TreatySlip_General_Data['id'] = $this->input->post('treatySlipGeneralId');
                        $SendDataGeneral = http_build_query($TreatySlip_General_Data);
                        $response_treatySlip_general = $this->restservice->post($this->config->item("treatySlipGeneral_update"), $this->headers,$SendDataGeneral );

                    }else
                    {
                        $SendDataGeneral = http_build_query($TreatySlip_General_Data);
                        $response_treatySlip_general = $this->restservice->post($this->config->item("treatySlipGeneral_create"), $this->headers,$SendDataGeneral );
                    } 
                    if($response_treatySlip_general->code == 1)
                    {
                        if($this->input->post('treatySlipGeneralId')){
                            $treatySlipGeneral_Id = $this->input->post('treatySlipGeneralId');
                        } else {
                            $treatySlipGeneral_Id = $response_treatySlip_general->entity->id;
                        }


                        $this->restservice->get($this->config->item("paymentTermGeneral_deleteAllByTreatySlipGeneralId").$treatySlipGeneral_Id, $this->headers);
                        for ($i = 1;$i <=count($this->input->post());$i++)
                        {
                            if($this->input->post('date_from_'.$i))
                            {
                                $PaymentTerms = array(
                                    'treatySlipGeneralDTO.id'=>$treatySlipGeneral_Id,
                                    'paymentTermFrom'=>date("m/d/Y",strtotime($this->input->post('date_from_'.$i))),
                                    'paymentTermTo'=>date("m/d/Y",strtotime($this->input->post('date_to_'.$i))));

                                    $PaymentTerms_Data = http_build_query($PaymentTerms);
                                    $response =  $this->restservice->post($this->config->item("paymentTermGeneral_create"), $this->headers,$PaymentTerms_Data );

                            }
                        }
                        echo json_encode($response_treatySlip_general);
                        return TRUE;

                    } else {
                         $response_treatySlip_general->treatySlip_general = "Error";
                        echo json_encode($response_treatySlip_general);
                        return TRUE;
                    }


        }

        if($this->input->post('treatyslip_layer'))
        {

            $TreatySlip_Layer_Data = array(
                "adjRates" => $this->input->post('adjRates'),
                "annualAggregatePrc" => $this->input->post('annualAggregatePrc'),
                // "basisofRecovery" => $this->input->post('basisofRecovery'),
                "bc" => $this->input->post('bc'),
                "coMaxRetention" => $this->input->post('coMaxRetention'),
                "coMaxRetentionPercent" => $this->input->post('coMaxRetentionPercent'),
                "treatyLimitPercent"=>$this->input->post('treatyLimitPercent'),
                "treatyLimit"=>$this->input->post('treatyLimit'),
                "comanLiability" => $this->input->post('comanLiability'),
                // "deductable" => $this->input->post('deductable'),
                "depositePerimum" => $this->input->post('depositePerimum'),
                // "estimatedGnpi" => $this->input->post('estimatedGnpi'),
                "fixRates" => $this->input->post('fixRates'),
                "layerDescription" => $this->input->post('layerDescription'),
                "layerName" => $this->input->post('layerName'),
                // "lossOccurancy" => $this->input->post('lossOccurancy'),
                "maxRates" => $this->input->post('maxRates'),
                "minRates" => $this->input->post('minRates'),
                "mndp" => $this->input->post('mndp'),
                "mndpPrcShare" => $this->input->post('mndpPrcShare'),
                "noOfIntallment" => $this->input->post('noOfIntallment'),
                "noOfReinstatement" => $this->input->post('noOfReinstatement'),
                "prcMaxLiability" => $this->input->post('prcMaxLiability'),
                "prcShare" => $this->input->post('prcShare'),
                // "risk" => $this->input->post('risk'),
                "paymentTerm" => $this->input->post('payment_terms_layer'),
                "treatyTypeDTO.id" => $this->input->post('layer_treaty_type'),
                "treatySlipGeneralDTO.id" => $this->input->post('treatySlipGeneralId'),
                // "excessLimit" => $this->input->post('excessLimit'),
                // "calculatedGNPI" => $this->input->post('calculatedGNPI'),

            );

            $layer_business_class = $this->input->post('layer_business_class');
            for ($i=0;$i<count($layer_business_class);$i++)
            {
                $TreatySlip_Layer_Data['businessDTOs['.$i.'].id'] = $layer_business_class[$i];
            }

            $treatySubTypes_layer = $this->input->post('treatySubTypes_layer');
            for ($i=0;$i<count($treatySubTypes_layer);$i++)
            {
                $TreatySlip_Layer_Data['treatySubTypeDTOs['.$i.'].id'] = $treatySubTypes_layer[$i];
            }   
 

            if($this->input->post('treatySlipLayerId'))
            {
                $TreatySlip_Layer_Data['id'] = $this->input->post('treatySlipLayerId');
                $SendDataGeneral = http_build_query($TreatySlip_Layer_Data);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipLayer_update"), $this->headers,$SendDataGeneral );
            }else{
                $SendDataGeneral = http_build_query($TreatySlip_Layer_Data);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipLayer_create"), $this->headers,$SendDataGeneral );
            }
 
            if($response_treatySlipLayer->code == 1)
            {
                if($this->input->post('treatySlipLayerId')){
                    $treatySlipLayerId = $this->input->post('treatySlipLayerId');
                }
                else{
                    $treatySlipLayerId = $response_treatySlipLayer->entity->id;
                }

                $this->restservice->get($this->config->item("treatySlipLayer_deleteLayerMndpByLayer").$treatySlipLayerId, $this->headers);
                $this->restservice->get($this->config->item("treatySlipLayer_deleteLayerPrcShareByLayer").$treatySlipLayerId, $this->headers);
                $this->restservice->get($this->config->item("treatySlipLayer_deletePaymentTermByLayer").$treatySlipLayerId, $this->headers);

                $LayerPrcShare = array();
                $layerMndp = array();
                $LayerPrcShareCounter = 0;
                $layerMndpCounter = 0;
                for ($i = 1;$i <=count($this->input->post());$i++)
                {
                    if($this->input->post('GNPIActual_PrcShare_layer_'.$i))
                    {
                        $LayerPrcShare['layerPrcShareDTOS['.$LayerPrcShareCounter.'].gnpiActual'] = $this->input->post('GNPIActual_PrcShare_layer_'.$i);
                        $LayerPrcShare['layerPrcShareDTOS['.$LayerPrcShareCounter.'].gnpiResived'] = $this->input->post('GNPIRevised_PrcShare_layer_'.$i);
                        $LayerPrcShare['layerPrcShareDTOS['.$LayerPrcShareCounter.'].gnipEstimated'] = $this->input->post('GNPIEstimated_PrcShare_layer_'.$i);
                       // $LayerPrcShare['layerPrcShareDTOS['.$LayerPrcShareCounter.'].prclShareRate'] = $this->input->post('PRCLSharerate_PrcShare_layer_'.$i);
                        $LayerPrcShare['layerPrcShareDTOS['.$LayerPrcShareCounter.'].prclShareValue'] = $this->input->post('PRCLSharevalue_PrcShare_layer_'.$i);
                        $LayerPrcShare['layerPrcShareDTOS['.$LayerPrcShareCounter.'].businessSubBusinessDTO.id'] = $this->input->post('businessclass_PrcShare_layer_'.$i);
                        $LayerPrcShare['layerPrcShareDTOS['.$LayerPrcShareCounter.'].treatySlipLayerDTO.id'] = $treatySlipLayerId;
                        $LayerPrcShare['layerPrcShareDTOS['.$LayerPrcShareCounter.'].treatySubTypeDTO.id'] = $this->input->post('treatySubType_PrcShare_layer_'.$i);
                        $LayerPrcShareCounter++;
                    }

                    if($this->input->post('businessclass_layerMndp_layer_'.$i))
                    {
                        $layerMndp['layerMndpDTOS['.$layerMndpCounter.'].businessSubBusinessDTO.id'] = $this->input->post('businessclass_layerMndp_layer_'.$i);
                        $layerMndp['layerMndpDTOS['.$layerMndpCounter.'].treatySubTypeDTO.id'] = $this->input->post('treatySubType_layerMndp_layer_'.$i);
                        $layerMndp['layerMndpDTOS['.$layerMndpCounter.'].mndp'] = $this->input->post('mndp_layerMndp_layer_'.$i);
                       // $layerMndp['layerMndpDTOS['.$layerMndpCounter.'].prcShareRate'] = (float)$this->input->post('PRCLSharerate_layerMndp_layer_'.$i);
                        $layerMndp['layerMndpDTOS['.$layerMndpCounter.'].prcShareValue'] = (float)$this->input->post('PRCLSharevalue_layerMndp_layer_'.$i);
                        $layerMndp['layerMndpDTOS['.$layerMndpCounter.'].treatySlipLayerDTO.id'] = $treatySlipLayerId;
                        $layerMndpCounter++;
                    }


                         if($this->input->post('date_from_'.$i.'_layer'))
                         {
                             $PaymentTerms = array(
                                 'treatySlipLayerDTO.id'=>$treatySlipLayerId,
                                 'paymentTermFrom'=>date("m/d/Y",strtotime($this->input->post('date_from_'.$i.'_layer'))),
                                 'paymentTermTo'=>date("m/d/Y",strtotime($this->input->post('date_to_'.$i.'_layer'))));


                                 $PaymentTerms_Data = http_build_query($PaymentTerms);
                                 $this->restservice->post($this->config->item("paymentTermLayer_create"), $this->headers,$PaymentTerms_Data );

                         }
                }


                 $LayerPrcShareData = http_build_query($LayerPrcShare);
                 $this->restservice->post($this->config->item("treatySlipLayerPrcShare_create"), $this->headers,$LayerPrcShareData );

                 $layerMndpData = http_build_query($layerMndp);
                 $this->restservice->post($this->config->item("treatySlipLayerMndp_create"), $this->headers,$layerMndpData);

 
                echo json_encode($response_treatySlipLayer);
                return TRUE;

            }
            else{

                $response_treatySlipLayer->treatySlip_general = "Error";
                echo json_encode($response_treatySlipLayer);
                return TRUE;
            }

        }


        if($this->input->post('treatyslip_section'))
        {

            $TreatySlip_section_Data = array(
                "sectionName" => $this->input->post('sectionName'),
                "quotaCompanyRetention" => (int)$this->input->post('quotaCompanyRetention'),
                "quotaCompanyRetentionOf" => (int)$this->input->post('quotaCompanyRetentionOf'),
                "surplusQuotaShareCommission" => (int)$this->input->post('surplusQuotaShareCommission'),
                "surplusQuotaShareCommissionOf" => (int)$this->input->post('surplusQuotaShareCommissionOf'),
                "surplusCompanyRetention" => (int)$this->input->post('surplusCompanyRetention'),
                "surplusCession" => (int)$this->input->post('surplusCession'),
                "premium" =>(int)$this->input->post('premium'),
                "riCommission" => (int)$this->input->post('riCommission'),
                "treatySlipGeneralDTO.id" => (int)$this->input->post('treatySlipGeneralId'),
                // "premiumRate" => '$this->input->post('premiumRate')',
                "description1" => $this->input->post('description1'),
                "description2" => $this->input->post('description2'),
                // "rate1" => $this->input->post('rate1'),
                // "rate2" => $this->input->post('rate2'),
                // "value1" => $this->input->post('value1'),
                // "value2" => $this->input->post('value2'),
                "prclSharePercentage1" => (float)$this->input->post('prclSharePercentage1'),
                // "prclSharePercentage2" => $this->input->post('prclSharePercentage2'),
                // "prclShare1" => $this->input->post('prclShare1'),
                // "prclShare2" => $this->input->post('prclShare2'),
                "OriginalGrossrate" => (int)$this->input->post('section_OriginalGrossrate'),
                "profitCommission" => (float)$this->input->post('profitCommission_section'),
                "treatySubLimit" => (float)$this->input->post('treatySubLimit'),
                "grossRetentionQuota" => (float)$this->input->post('section_grossRetentionQuota'),
                "grossRetentionSurplus" => (float)$this->input->post('section_grossRetentionSurplus'),
                "reInsurerLiability" => (float)$this->input->post('section_reInsurerLiability'),
                "noOfLines" => (int)$this->input->post('section_noOfLines'),
                "mplQuota" => (float)$this->input->post('section_mplQuota'),
                "mplSurplus" => (float)$this->input->post('section_mplSurplus'),
                "mplErrorQuota" => (float)$this->input->post('section_mplErrorQuota'),
                "mplErrorSurplus" => (float)$this->input->post('section_mplErrorSurplus'),
                // "managementExpensed" => $this->input->post('section_managementExpensed'),
                "lossesCarryForward" =>  $this->input->post('section_lossesCarryForward'),
                "profitCommissionRate" => (int)$this->input->post('section_profitCommissionRate'),
                "prcShareRateQuota" => $this->input->post('section_prcShareRateQuota'),
                "originalGrossRateSurplus" => (int)$this->input->post('section_originalGrossRateSurplus'),
                "reInsurerLiabilityPrcShare" => (float)$this->input->post('section_reInsurerLiabilityPrcShare'),
                "surplusLimit" => (int)$this->input->post('surplusLimit'),
                "prcShareRate" => (int)$this->input->post('section_prcShareRate'),
                "prcShareValue" => (float)$this->input->post('section_prcShareValue'),
                "descriptionTreatySubLimit" => $this->input->post('descriptionTreatySubLimit'),
                "reinsuranceCommissionRateQouta" => $this->input->post('reinsuranceCommissionRateQouta'),
                "reinsuranceCommissionRateSurplus" => $this->input->post('reinsuranceCommissionRateSurplus'),
                "cededShareRate" => $this->input->post('cededShareRate'),

            );

            $section_business_class = $this->input->post('section_business_class');
            for ($i=0;$i<count($section_business_class);$i++)
            {
                $TreatySlip_section_Data['businessDTOs['.$i.'].id'] = $section_business_class[$i];
            }

            $sectiontreatySubTypes = $this->input->post('sectiontreatySubTypes');
            for ($i=0;$i<count($sectiontreatySubTypes);$i++)
            {
                $TreatySlip_section_Data['treatySubTypeDTOS['.$i.'].id'] = $sectiontreatySubTypes[$i];
            }   
            
            if($this->input->post('treatySlipSectionId'))
            {
                $TreatySlip_section_Data['id'] = $this->input->post('treatySlipSectionId');
                $SendDataGeneral = http_build_query($TreatySlip_section_Data);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipSection_update"), $this->headers,$SendDataGeneral );
            }else{
                $SendDataGeneral = http_build_query($TreatySlip_section_Data);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipSection_create"), $this->headers,$SendDataGeneral );
            }


             echo json_encode($response_treatySlipLayer);
             return TRUE;
        }

        if($this->input->post('treatyslip_layer_reinstatement'))
        {

            $aData = array(
                "reinstatement" => $this->input->post('reinstatement'),
                "additionalProPermiumRate" => $this->input->post('additionalProPermiumRate'),
                "instDueDate" => date("m/d/Y",strtotime($this->input->post('instDueDate'))),
                "treatySlipLayerDTO.id" => $this->input->post('treatyLayerId'),
            );



            if($this->input->post('ReinstatementId'))
            {
                $aData['id'] = $this->input->post('ReinstatementId');
                $SendData = http_build_query($aData);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipLayerReInstatement_update"), $this->headers,$SendData);
            }else{
                $SendData = http_build_query($aData);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipLayerReInstatement_create"), $this->headers,$SendData);
            }



            echo json_encode($response_treatySlipLayer);
            return TRUE;
        }

        if($this->input->post('treatyslip_section_class'))
        {

            $aData = array(
                "className" => 'no name',
                "corManRefention" => $this->input->post('corManRefention'),
                "treatyLimit" => $this->input->post('treatyLimit'),
                "prcShare" => $this->input->post('prcShare'),
                "prcMaxLiability" => $this->input->post('prcMaxLiability'),
                "classCommission" => $this->input->post('classCommission'),
                "pc" => $this->input->post('pc'),
                "lcf" => $this->input->post('lcf'),
                "me" => $this->input->post('me'),
                "locAdvice" => $this->input->post('locAdvice'),
                "cashLoss" => $this->input->post('cashLoss'),
                "portPremium" => $this->input->post('portPremium'),
                "portLoss" => $this->input->post('portLoss'),
                "epi" => $this->input->post('epi'),
                "epiPrc" => $this->input->post('epiPrc'),
                "treatySectionDTO.id" => (int)$this->input->post('treatySectionId_sectionClass'),
                "businessSubBusinessDTO.id" => (int)$this->input->post('sectionClass_business_class'),
                "treatySubTypeDTO.id" => (int)$this->input->post('sectionClass_treatySubTypes'),
                "epiRevised" => $this->input->post('epiReviesd'),
                "epiEstimated" => $this->input->post('epiEstimated'),

            );

            if($this->input->post('sectionClassId'))
            {
                $aData['id'] = $this->input->post('sectionClassId');
                $SendData = http_build_query($aData);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipSectionClass_update"), $this->headers,$SendData);
            }else{
                $SendData = http_build_query($aData);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipSectionClass_create"), $this->headers,$SendData);
            }



            echo json_encode($response_treatySlipLayer);
            return TRUE;
        }

        if($this->input->post('treatyslip_slidingScale'))
        {

            $Data = array(
                "section" => $this->input->post('sectionName_slidingScale'),
                "rate" => $this->input->post('Sliding_Rate'),
                "description" => $this->input->post('SlidingDescription'),
                "slidingCommission" => $this->input->post('slidingCommission'),
                "slidingLossRatio" => $this->input->post('slidingLossRatio'),
                "slidingScale" => strtolower($this->input->post('slidingScale')),
                "combineRatio" => $this->input->post('combineRatio'),
                "treatySlipGeneralDTO.id" => $this->input->post('treatySlipGeneralId'),
                "treatyTypeDTO.id" => $this->input->post('sliding_treaty_type'),

            );
            $sliding_business_class = $this->input->post('sliding_business_class');
            for ($i=0;$i<count($sliding_business_class);$i++)
            {
                $Data['businessDTOs['.$i.'].id'] = $sliding_business_class[$i];
            }

            $sectiontreatySubTypes = $this->input->post('slidingScale_treatySubTypes');
            for ($i=0;$i<count($sectiontreatySubTypes);$i++)
            {
                $Data['treatySubTypeDTOS['.$i.'].id'] = $sectiontreatySubTypes[$i];
            }   
            if($this->input->post('treatySlipslidingScaleId'))
            {
                $Data['id'] = $this->input->post('treatySlipslidingScaleId');
                $SendDataGeneral = http_build_query($Data);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipSlidingScale_update"), $this->headers,$SendDataGeneral );
            }else{
                $SendDataGeneral = http_build_query($Data);
                $response_treatySlipLayer = $this->restservice->post($this->config->item("treatySlipSlidingScale_create"), $this->headers,$SendDataGeneral );
            }


            echo json_encode($response_treatySlipLayer);
            return TRUE;
        }

        /* Treaty Conditions */
        if($this->input->post('conditions')) {
            $post = $this->input->post();
            unset($post['conditions']);
            $filteredPost = replaceInArrayKey($post,'_','.');
            $postFormatted = [];
            $i=0;
            
            for ($i=0; $i < sizeof($filteredPost['conditionIds']); $i++) {
                $conditionVal = $filteredPost['conditionIds'][$i];
                $conditionsKey = 'conditionDTOs['.$i.'].id';
                $postFormatted[$conditionsKey] = $conditionVal;
            }
            if (isset($filteredPost['treatySlipGeneralDTO.id'])) {
                $postFormatted['treatySlipGeneralDTO.id'] = $filteredPost['treatySlipGeneralDTO.id'];
            }
            if (isset($post['id'])) {
                $postFormatted['id'] = $post['id'];
            }
            $addOrUpdateUrl = isset($post['id'])?'treatyCondition_update':'treatyCondition_create';
            $jsonResp = $this->postData($addOrUpdateUrl, $postFormatted);
            echo $jsonResp;
            return TRUE;
        }

        /* Treaty Loss History */
        if($this->input->post('lossHistory')) {
            $post = $this->input->post();
            unset($post['lossHistory']);
            $filteredPost = replaceInArrayKey($post,'_','.');
            $addOrUpdateUrl = isset($post['id'])?'treatyLossHistory_update':'treatyLossHistory_create';
            $jsonResp = $this->postData($addOrUpdateUrl, $filteredPost);
            echo $jsonResp;
            return TRUE;
        }

        /* Treaty Document */
        if ($this->input->post('document')) {
            $post = $this->input->post();
            unset($post['document']);
            $fileData = [
                'file'              => $_FILES,
                'name'              => 'file',
                'inUploadsFolder'   => 'treatyDocuments',
                'extensions'        => 'jpg|jpeg|png|xlsx|txt|pdf'
            ];
            $fileInfo = uploadFile($fileData);

            $filteredPost = replaceInArrayKey($post,'_','.');
            $filteredPost['docPath'] = $fileInfo['imagePath'];
            $addOrUpdateUrl = isset($post['id'])?'treatyAttachments_update':'treatyAttachments_create';
            $jsonResp = $this->postData($addOrUpdateUrl, $filteredPost) ;
            echo $jsonResp;
            return TRUE;
        }

        $userData = $this->session->get_userdata('userData')['userData'];
        $uRoleId = $userData->roles_permissions->id;
        $uRoleName = $userData->roles_permissions->name;

        $this->data['userData'] = $userData;
        $this->data['uRoleId'] = $uRoleId;
        $this->data['uRoleName'] = strtolower($uRoleName);
        $this->data['admin'] = strtolower($this->config->item('admin'));
        $this->data['initiator'] = strtolower($this->config->item('initiator'));
        $this->data['reviewer1'] = strtolower($this->config->item('reviewer1'));
        $this->data['reviewer2'] = strtolower($this->config->item('reviewer2'));
        $this->data['approver'] = strtolower($this->config->item('approver'));
        $this->data['Treaty'] = $this->restservice->get($this->config->item("treaty_details_view")."/$Treater_id", $this->headers);
        $treatyDetails = $this->data['Treaty'];
        // dd($treatyDetails);
        $treatyStepRoleID = isset($treatyDetails->roleDTO->id)?$treatyDetails->roleDTO->id:'';
        // dd($treatyStepRoleID);
        // dd($uRoleId !== "1");
        if ($uRoleId !== $treatyStepRoleID && $uRoleId !== "1") {
            $message =  'Your role is not allowed to access this page.';
            $messageHTML = '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$message.'</div>';
            $this->session->set_flashdata('message', $messageHTML);
            if (isset($_SESSION['slips_url'])) {
                redirect($_SESSION['slips_url'],'refresh');    
            } else {
                redirect('treaty','refresh');
            }
        }
        $this->data['Treater_details'] = $this->restservice->post($this->config->item("treater_details"), $this->headers,http_build_query(array('id'=>$Treater_id)));

        if(isset($this->data['Treater_details']->treatySlipGeneralDTO)) {
            $this->data['treatySlipGeneral'] = $this->data['Treater_details']->treatySlipGeneralDTO;
            $treatySlipGeneral = $this->restservice->get($this->config->item("treatySlipGeneral_view")."/".$this->data['Treater_details']->treatySlipGeneralDTO->id, $this->headers);
            $this->data['Treater_details']->treatySlipGeneralDTO->currencyRateDTO =  $treatySlipGeneral->currencyRateDTO;
            if($treatySlipGeneral->currencyRateDTO){
                $this->data['Selected_RateType']  =  $treatySlipGeneral->currencyRateDTO->rateTypeDTO;
            }
        }
        $this->data['treatySlipGeneralDTO_id'] = isset($treatySlipGeneral->id)?$treatySlipGeneral->id:'0';
        $this->data['Brokers'] = $this->restservice->get($this->config->item("broker_listing"), $this->headers);
        $this->data['Cedent'] = $this->restservice->get($this->config->item("cedent_listing"), $this->headers);
        $this->data['Treaty_type'] = $this->restservice->get($this->config->item("treaty_type_listing"), $this->headers);
        $this->data['Treaty_Subtype'] = $this->restservice->get($this->config->item("treatySubType_getAll"), $this->headers);
        $this->data['Treaty_category'] = $this->restservice->get($this->config->item("treaty_category_listing"), $this->headers);
        $this->data['Business_class'] = $this->restservice->get($this->config->item("business_listing"), $this->headers);
        $this->data['Currency'] = $this->restservice->get($this->config->item("currency_getAll"), $this->headers);
        $this->data['RateTypes'] = $this->restservice->get($this->config->item("rateType_getAll"), $this->headers);
        $this->data['Currency_Rate'] = $this->restservice->get($this->config->item("currency_getAll"), $this->headers);
        $this->data['rmsInsured'] = $this->restservice->get($this->config->item("rmsInsured_getAllForCombo"), $this->headers);
        $this->data['leader_follower'] = $this->restservice->get($this->config->item("leaderFollower_getAll"), $this->headers);
        $this->data['risksCovered'] = $this->restservice->get($this->config->item("riskCovered_listing"), $this->headers);
        $this->data['referenceNo'] = isset($this->data['Treater_details']->treatySlipGeneralDTO->fileRefNo)? $this->data['Treater_details']->treatySlipGeneralDTO->fileRefNo:'0';

        $this->data['treaterId'] = isset($this->data['Treater_details']->treatySlipGeneralDTO->id)?
                                    $this->data['Treater_details']->treatySlipGeneralDTO->id:0;

        if(isset($treatyDetails->flowHistoryDTOs)) {
            $this->data['flowHistoryDTOs'] =   $treatyDetails->flowHistoryDTOs;
        }

        $this->data['business_String'] = '';
        $this->data['treatySubTypes_String'] = '';
        if(isset($this->data['Treaty'])) {
            if($this->data['Treaty']->treatyStatisticsDTO->businessDTOs) {
                foreach ($this->data['Treaty']->treatyStatisticsDTO->businessDTOs as $objbusinessDTO) {
                    $this->data['business_String'] .= ',"'.$objbusinessDTO->id.'"';
                }
                $this->data['business_String'] = trim($this->data['business_String'],",");
            }
        }

        if(isset($this->data['Treater_details'])) {
            if(isset($this->data['Treater_details']->treatySlipGeneralDTO->treatySubTypeDTOs)) {
                foreach ($this->data['Treater_details']->treatySlipGeneralDTO->treatySubTypeDTOs as $objtreatySubTypeDTO) {
                    $this->data['treatySubTypes_String'] .= ',"'.$objtreatySubTypeDTO->id.'"';
                }
                $this->data['treatySubTypes_String'] = trim($this->data['treatySubTypes_String'],",");
            }
        }

        $this->data['treatyStatusOptions'] = $this->config->item('treatyStatusOptions');
        $this->data['uwStatusOptions'] = $this->config->item('uwStatusOptions');
        $this->data['assignToOptions'] = $this->config->item('assignToOptions');
        $this->data['uwTypeOptions'] = $this->config->item('uwTypeOptions');
        $this->data['isPreapprovedOptions'] = $this->config->item('isPreapprovedOptions');

        $agrId = isset($this->data['Treater_details']->agreementDTO->id) ? $this->data['Treater_details']->agreementDTO->id:'';

        $this->data['treaties'] = !empty($agrId)?$this->getData('treater_details_by_agreement', $agrId, true, false)['data']:[];

        $this->load->view('treaty/treaty_slip',$this->data);
    }

    public function view_treaty_slip($Treater_id='')
    {
        $Treater_id = base64_decode($Treater_id);
        $this->data['treater_id'] = $Treater_id; 
        $this->data["action"] = "view_record";
        $userData = $this->session->get_userdata('userData')['userData'];
        $uRoleId = $userData->roles_permissions->id;
        $uRoleName = $userData->roles_permissions->name;
        $this->data['Treaty'] = $this->restservice->get($this->config->item("treaty_details_view")."/$Treater_id", $this->headers);

        $treatyDetails = $this->data['Treaty'];
        if(isset($treatyDetails->flowHistoryDTOs)) {
            $this->data['flowHistoryDTOs'] = $treatyDetails->flowHistoryDTOs;
        }

        $this->data['Treater_details'] = $this->restservice->post($this->config->item("treater_details"), $this->headers,http_build_query(array('id'=>$Treater_id)));
        // debug($this->data['Treater_details']);
        if(isset($this->data['Treater_details']->treatySlipGeneralDTO)) {
            $this->data['treatySlipGeneral'] = $this->data['Treater_details']->treatySlipGeneralDTO;
            $treatySlipGeneral = $this->restservice->get($this->config->item("treatySlipGeneral_view")."/".$this->data['Treater_details']->treatySlipGeneralDTO->id, $this->headers);
            $this->data['Treater_details']->treatySlipGeneralDTO->currencyRateDTO =  $treatySlipGeneral->currencyRateDTO;
            if($treatySlipGeneral->currencyRateDTO){
                $this->data['Selected_RateType']  =  $treatySlipGeneral->currencyRateDTO->rateTypeDTO;
            }
        }
        // debug($treatySlipGeneral);
        $this->data['treatySlipGeneralDTO_id'] = isset($treatySlipGeneral->id)?$treatySlipGeneral->id:'0';
        $this->data['Brokers'] = $this->restservice->get($this->config->item("broker_listing"), $this->headers);
        $this->data['Cedent'] = $this->restservice->get($this->config->item("cedent_listing"), $this->headers);
        $this->data['Treaty_type'] = $this->restservice->get($this->config->item("treaty_type_listing"), $this->headers);
        $this->data['Treaty_Subtype'] = $this->restservice->get($this->config->item("treatySubType_getAll"), $this->headers);
        $this->data['Treaty_category'] = $this->restservice->get($this->config->item("treaty_category_listing"), $this->headers);
        $this->data['Business_class'] = $this->restservice->get($this->config->item("business_listing"), $this->headers);
        $this->data['Currency'] = $this->restservice->get($this->config->item("currency_getAll"), $this->headers);
        $this->data['RateTypes'] = $this->restservice->get($this->config->item("rateType_getAll"), $this->headers);
        $this->data['Currency_Rate'] = $this->restservice->get($this->config->item("currency_getAll"), $this->headers);
        $this->data['rmsInsured'] = $this->restservice->get($this->config->item("rmsInsured_getAllForCombo"), $this->headers);
        $this->data['leader_follower'] = $this->restservice->get($this->config->item("leaderFollower_getAll"), $this->headers);
        $this->data['risksCovered'] = $this->restservice->get($this->config->item("riskCovered_listing"), $this->headers);
        $this->data['referenceNo'] = isset($this->data['Treater_details']->treatySlipGeneralDTO->fileRefNo)? $this->data['Treater_details']->treatySlipGeneralDTO->fileRefNo:'0';

        $this->data['userData'] = $userData;
        $this->data['uRoleId'] = $uRoleId;
        $this->data['uRoleName'] = strtolower($uRoleName);
        $this->data['admin'] = $this->config->item('admin');
        $this->data['initiator'] = $this->config->item('initiator');
        $this->data['reviewer1'] = $this->config->item('reviewer1');
        $this->data['reviewer2'] = $this->config->item('reviewer2');
        $this->data['approver'] = $this->config->item('approver');

        $this->data['treaterId'] = isset($this->data['Treater_details']->treatySlipGeneralDTO->id)?
            $this->data['Treater_details']->treatySlipGeneralDTO->id:0;

        if(isset($treatyDetails->flowHistoryDTOs)) {
            $this->data['flowHistoryDTOs'] =   $treatyDetails->flowHistoryDTOs;
        }


        $this->data['business_String'] = '';
        $this->data['treatySubTypes_String'] = '';
        if(isset($this->data['Treaty']))
        {
            if(isset($this->data['Treaty']->treatyStatisticsDTO->businessDTOs)) {
                foreach ($this->data['Treaty']->treatyStatisticsDTO->businessDTOs as $objbusinessDTO) {
                    $this->data['business_String'] .= ',"'.$objbusinessDTO->id.'"';
                }
                $this->data['business_String'] = trim($this->data['business_String'],",");
            }
        }

        if(isset($this->data['Treater_details'])) {
            if(isset($this->data['Treater_details']->treatySlipGeneralDTO->treatySubTypeDTOs)) {
                foreach ($this->data['Treater_details']->treatySlipGeneralDTO->treatySubTypeDTOs as $objtreatySubTypeDTO) {
                    $this->data['treatySubTypes_String'] .= ',"'.$objtreatySubTypeDTO->id.'"';
                }
                $this->data['treatySubTypes_String'] = trim($this->data['treatySubTypes_String'],",");
            }
        }

        $this->data['treatyStatusOptions'] = $this->config->item('treatyStatusOptions');
        $this->data['uwStatusOptions'] = $this->config->item('uwStatusOptions');
        $this->data['assignToOptions'] = $this->config->item('assignToOptions');
        $this->data['uwTypeOptions'] = $this->config->item('uwTypeOptions');
        $this->data['isPreapprovedOptions'] = $this->config->item('isPreapprovedOptions');

        $agrId = isset($treatySlipGeneral->agreementDTO->id)?$treatySlipGeneral->agreementDTO->id:'';

        $this->data['treaties'] = !empty($agrId)?$this->getData('treater_details_by_agreement', $agrId, true, false)['data']:[];

        $this->load->view('treaty/treaty_slip',$this->data);
    }

    public function delete($id='')
    {
        $id = empty($id)?$this->input->post('id'):$id;
        if (!empty($id))
        {
            $id = base64_decode($id);
            // ee($id);
            $sendData = http_build_query(array("id"=>$id));
            $response = $this->restservice->get($this->config->item("treaty_details_delete")."/".$id, $this->headers,$sendData);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }

    public function getTretierData($tretierId='')
    {
        $tretierId = base64_decode($tretierId);
        $data = $this->restservice->post($this->config->item("treater_details"), $this->headers,http_build_query(array('id'=>$tretierId)));
        echo json_encode($data);

        return true;
    }

    public function proceedOrSendTo()
    {
        // dd($this->input->post());
        if ($this->input->post('id')) {
            $post = replaceInArrayKey($this->input->post(),"_",".");
            //dd($post);
            if (!empty($post['roleId'])) {
                $proceedOrSendTo = 'sendTo';
            }else{
                $proceedOrSendTo = 'proceed';
            }
            $response = $this->postData('treater_'.$proceedOrSendTo,$post,1,1);
            $token = $this->security->get_csrf_hash();

            $this->data['data'] = $response;
            $this->data['token'] = $token;

            toJson($this->data);
            return TRUE;
        }
    }

    public function getConditionsList()
    {
        $referenceNo = $this->uri->segment(3);
        $treatyConditions = $this->getData('conditionreference_view_by_ref',$referenceNo,false,false,false);
        
        $conditionDTOs = isset($treatyConditions->conditionTypeDTOs[0]->conditionDTOs)?
                $treatyConditions->conditionTypeDTOs[0]->conditionDTOs:[];

        echo '<a href="#" onclick="return false;" class="list-group-item list-group-item-success active">Conditions</a>';
        if (empty($conditionDTOs)){ ?>
            <a href="#" onclick="return false;" class="list-group-item list-group-item-action">No Conditions has been added.</a>
            <?php } ?>
            <?php foreach ($conditionDTOs as $condition){ ?>
            <a href="#" onclick="return false;" class="list-group-item list-group-item-action"><?php echo $condition->condition?></a>
            <?php 
        }

    }

    function Get_CurrencyRat()
    {

        if ($this->input->post('get_data'))
        {

            $effectiveFrom = date("Y-m-d");
            $effectiveTo = date("Y-m-d");
            if($this->input->post('RateType') == "Corporate")
            {
                $sendData = array(
                    "currencyId" => $this->input->post('CurrencyId'),
                    "rateTypeId" => $this->input->post('RateTypeId'),
                    "currentPage" => '0',
                    "itemsPerPages" => '1',
                );
                $sendData = http_build_query($sendData);
                $CurrencyData = $this->restservice->post($this->config->item("currency_rate_listing"), $this->headers,$sendData);
                $CurrencyData = $CurrencyData->data;
                $CurrencyData = $CurrencyData[0];

                $effectiveFrom = date("Y-m-d",strtotime($CurrencyData->effectiveFrom));
//                $effectiveTo = date("Y-m-d",strtotime($CurrencyData->effectiveTo));

            }

            $aFilters = array(
                "currencyDTO.code"=>$this->input->post('CurrencyCode'),
                "rateTypeDTO.id"=>$this->input->post('RateTypeId'),
                "effectiveFrom"=> $effectiveFrom,
                "effectiveTo"=> $effectiveTo,
            );

            $sendData = http_build_query($aFilters);
            $response = $this->restservice->post($this->config->item("currency_rate"), $this->headers, $sendData);
            if(empty($response))
                echo json_encode(array("code"=>0));
            else{
                $response->code = 1;
                echo(json_encode($response));
            }


        }
    }

    function LoadTreatySlipServices()
    {

        if ($this->input->post('service_type') == 'treaty_layers') 
        {
            $SendData = http_build_query(array('id' => $this->input->post('TreaterId'), 'include' => 'treatySlipLayer'));
            // dd($SendData);
            $aData = $this->restservice->post($this->config->item("treater_details"), $this->headers, $SendData);
            $PaymentTerms = '';
            $BusnessClasses = '';
            if (isset($aData->treatySlipGeneralDTO->treatySlipLayerDTOs)) 
            {
                foreach ($aData->treatySlipGeneralDTO->treatySlipLayerDTOs as $key => $ObjtreatySlipLayer) 
                {
                    $ObjtreatySlipLayer->PaymentTermRanges = '';
                    foreach ($ObjtreatySlipLayer->paymentTermRangeDTOs as $key => $ObjPaymentTerm) {
                        $PaymentTerms .= "From : " . $ObjPaymentTerm->paymentTermFrom . " To : " . $ObjPaymentTerm->paymentTermTo . "<br>";
                    }
                    $ObjtreatySlipLayer->PaymentTermRanges = $PaymentTerms;
                    $PaymentTerms = '';


                    $ObjtreatySlipLayer->BusnessClasses = '';
                    foreach ($ObjtreatySlipLayer->businessDTOs as $key => $Objbusiness)
                    {
                        $BusnessClasses .= $Objbusiness->name . ", <br>";
                    }
                    $ObjtreatySlipLayer->BusnessClasses = $BusnessClasses;
                    $BusnessClasses = '';


                    $ObjtreatySlipLayer->treatySubTypes = '';
                    $treatySubTypes = '';
                    foreach ($ObjtreatySlipLayer->treatySubTypeDTOs as $key => $ObjtreatySubType)
                    {
                        $treatySubTypes .= $ObjtreatySubType->subTypeName . ", <br>";
                    }
                    $ObjtreatySlipLayer->treatySubTypes = $treatySubTypes;
                    $treatySubTypes = '';

                }
 

            } 


           
            echo json_encode($aData->treatySlipGeneralDTO->treatySlipLayerDTOs);
            // echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'signle_treaty_layer') 
        {
            $treaty_layerid = $this->input->post('treaty_layerid');
            $aData = $this->restservice->get($this->config->item("treatySlipLayer_view") . "/$treaty_layerid", $this->headers);

            
            $aData->BusnessClasses = json_decode(json_encode($aData->businessDTOs), true);
            $aData->BusnessClasses = array_column($aData->BusnessClasses,'id');

            $aData->treatySubTypes = json_decode(json_encode($aData->treatySubTypeDTOs), true);
            $aData->treatySubTypes = array_column($aData->treatySubTypes,'id');
            
            echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'delete_layer') {
            $treaty_layerid = $this->input->post('id');
            $aData = $this->restservice->get($this->config->item("treatySlipLayer_delete") . "/$treaty_layerid", $this->headers);
            echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'treaty_sections') 
        {
            $SendData = http_build_query(array('id' => $this->input->post('TreaterId'), 'include' => array('treatySection')));
            $aData = $this->restservice->post($this->config->item("treater_details"), $this->headers, $SendData);
            $response_currency_view = $this->restservice->get($this->config->item("currency_view")."/".$aData->currencyCode,$this->headers);
            $CustomizedData = new stdClass();
            $CustomizedData->SectionData = $aData->treatySlipGeneralDTO->treatySectionDTOs;
            $CustomizedData->currencyCode = $response_currency_view->country." (".$response_currency_view->code.")";


            
            if (isset($CustomizedData->SectionData))
            {  
                foreach ($CustomizedData->SectionData as $key => $ObjSection)
                { 
                    $ObjSection->treatySubTypes = '';
                    $treatySubTypes = '';
                    foreach ($ObjSection->treatySubTypeDTOS as $key => $ObjtreatySubType)
                    {
                        $treatySubTypes .= $ObjtreatySubType->subTypeName . ", <br>";
                    }
                    $ObjSection->treatySubTypes = $treatySubTypes;
                    $treatySubTypes = '';

                    $ObjSection->BusnessClasses = '';
                    $BusnessClasses = '';
                    foreach ($ObjSection->businessDTOs as $key => $Objbusiness)
                    {
                        $BusnessClasses .= $Objbusiness->name . ", <br>";
                    }
                    $ObjSection->BusnessClasses = $BusnessClasses;
                    $BusnessClasses = '';
                }
 
            } 

           


            echo json_encode($CustomizedData);
            return true;
        } else if ($this->input->post('service_type') == 'signle_section') 
        {
            $treaty_SectionId = $this->input->post('SectionId');
            $aData = $this->restservice->get($this->config->item("treatySlipSection_view") . "/$treaty_SectionId", $this->headers);

            $aData->treatySubTypes = json_decode(json_encode($aData->treatySubTypeDTOS), true);
            $aData->treatySubTypes = array_column($aData->treatySubTypes,'id');

            $aData->BusnessClasses = json_decode(json_encode($aData->businessDTOs), true);
            $aData->BusnessClasses = array_column($aData->BusnessClasses,'id'); 

            echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'delete_section') {
            $treaty_SectionId = $this->input->post('id');
            $aData = $this->restservice->get($this->config->item("treatySlipSection_delete") . "/$treaty_SectionId", $this->headers);
            echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'treaty_reinstatement') 
        {
            $SendData = http_build_query(array('id' => $this->input->post('TreaterId'), 'include' => array('treatySlipLayer')));
            $aData = $this->restservice->post($this->config->item("treater_details"), $this->headers, $SendData);
            $ReInstatements = array();
            foreach ($aData->treatySlipGeneralDTO->treatySlipLayerDTOs as $key => $objLayers) {
                foreach ($objLayers->layerReInstatementDTOs as $objlayerReInstatement) {
                    $ReInstatements[] = array(
                        "id" => $objlayerReInstatement->id,
                        "reinstatement" => $objlayerReInstatement->reinstatement,
                        "additionalProPermiumRate" => $objlayerReInstatement->additionalProPermiumRate,
                        "instDueDate" => date("d/m/Y", strtotime($objlayerReInstatement->instDueDate)),
                        "LayerName" => $objLayers->layerName
                    );

                }

            }
            echo json_encode($ReInstatements);
            return true;
        } else if ($this->input->post('service_type') == 'delete_reinstatement') {
            $ReinstatementId = $this->input->post('id');
            $aData = $this->restservice->get($this->config->item("treatySlipLayerReInstatement_delete") . "/$ReinstatementId", $this->headers);
            echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'single_reinstatement') {
            $ReInstatementId = $this->input->post('ReInstatementId');
            $aData = $this->restservice->get($this->config->item("treatySlipLayerReInstatement_view") . "/$ReInstatementId", $this->headers);
            $ReInstatements = array(
                "id" => $aData->id,
                "reinstatement" => $aData->reinstatement,
                "additionalProPermiumRate" => $aData->additionalProPermiumRate,
                "instDueDate" => date("Y-m-d", strtotime($aData->instDueDate)),
                "LayerName" => $aData->treatySlipLayerDTO->layerName,
                "Layerid" => $aData->treatySlipLayerDTO->id
            );
            echo json_encode($ReInstatements);
            return true;
        } else if ($this->input->post('service_type') == 'treaty_sectionClassess') {
            $SendData = http_build_query(array('id' => $this->input->post('TreaterId'), 'include' => array('treatySlipLayer')));
            $aData = $this->restservice->post($this->config->item("treater_details"), $this->headers, $SendData);
            $SectionClass = array();

            foreach ($aData->treatySlipGeneralDTO->treatySectionDTOs as $key => $objSections) {
                foreach ($objSections->sectionClassDTOs as $objsectionClass) {

                    $SectionClass[] = array(
                        "id" => $objsectionClass->id,
                        "className" => $objsectionClass->className,
                        "corManRefention" => $objsectionClass->corManRefention,
                        "treatyLimit" => $objsectionClass->treatyLimit,
                        "prcShare" => $objsectionClass->prcShare,
                        "prcMaxLiability" => $objsectionClass->prcMaxLiability,
                        "classCommission" => $objsectionClass->classCommission,
                        "pc" => $objsectionClass->pc,
                        "lcf" => $objsectionClass->lcf,
                        "me" => $objsectionClass->me,
                        "locAdvice" => $objsectionClass->locAdvice,
                        "cashLoss" => $objsectionClass->cashLoss,
                        "portPremium" => $objsectionClass->portPremium,
                        "portLoss" => $objsectionClass->portLoss,
                        "epi" => $objsectionClass->epi,
                        "epiPrc" => $objsectionClass->epiPrc,
                        "SectionName" => $objSections->sectionName,
                    );
                }

            }
            echo json_encode($SectionClass);
            return true;
        } else if ($this->input->post('service_type') == 'delete_sectionClass') {
            $ReinstatementId = $this->input->post('id');
            $aData = $this->restservice->get($this->config->item("treatySlipSectionClass_delete") . "/$ReinstatementId", $this->headers);
            echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'single_sectionClass') {
            $ReInstatementId = $this->input->post('SectionClassId');
            $aData = $this->restservice->get($this->config->item("treatySlipSectionClass_view") . "/$ReInstatementId", $this->headers);
            echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'SlidingScales')
        {
            $SendData = http_build_query(array('id' => $this->input->post('TreaterId'), 'include' => array('slidingScale')));
            $aData = $this->restservice->post($this->config->item("treater_details"), $this->headers, $SendData);

            $BusnessClasses = '';
            if (isset($aData->treatySlipGeneralDTO->slidingScaleDTOs))
            {
                foreach ($aData->treatySlipGeneralDTO->slidingScaleDTOs as $key => $ObjslidingScale)
                {
                    $ObjslidingScale->BusnessClasses = '';
                    foreach ($ObjslidingScale->businessDTOs as $key => $Objbusiness)
                    {
                        $BusnessClasses .= $Objbusiness->name . ", <br>";
                    }
                    $ObjslidingScale->BusnessClasses = $BusnessClasses;
                    $BusnessClasses = '';

                    $ObjslidingScale->treatySubTypes = '';
                    $treatySubTypes = '';
                    foreach ($ObjslidingScale->treatySubTypeDTOS as $key => $ObjtreatySubType)
                    {
                        $treatySubTypes .= $ObjtreatySubType->subTypeName . ", <br>";
                    }
                    $ObjslidingScale->treatySubTypes = $treatySubTypes;
                    $treatySubTypes = '';
                }


            } 

            echo json_encode($aData->treatySlipGeneralDTO->slidingScaleDTOs);
            return true;
        }
        else if ($this->input->post('service_type') == 'delete_slidingScale') {
            $Id = $this->input->post('id');
            $aData = $this->restservice->get($this->config->item("treatySlipSlidingScale_delete") . "/$Id", $this->headers);
            echo json_encode($aData);
            return true;
        } else if ($this->input->post('service_type') == 'single_slidingScale')
        {
            $id = $this->input->post('id');
            $aData = $this->restservice->get($this->config->item("treatySlipSlidingScale_view") . "/$id", $this->headers);

            $aData->BusnessClasses = json_decode(json_encode($aData->businessDTOs), true);
            $aData->BusnessClasses = array_column($aData->BusnessClasses,'id');

            $aData->treatySubTypes = json_decode(json_encode($aData->treatySubTypeDTOS), true);
            $aData->treatySubTypes = array_column($aData->treatySubTypes,'id');

            echo json_encode($aData);
            return true;
        }
    }
    
    function treaty_status($status,$treaterid,$agreementId)
    {
        $treaterid = base64_decode($treaterid);
        $status = base64_decode($status);
        $this->data['treaty_status'] = $this->config->item('treaty_status');

        if($this->input->post('changeFlag'))
        {
            $this->headers['Authorization'] = $this->session->userdata('authToken');
            $data = array(
                           "remarks"=>$this->input->post('remarks'),
                           "flagId" => array_search($this->input->post('flag_name'),$this->config->item('treaty_status')),
                           "id"=>$treaterid);
                $SendData = http_build_query($data);
                $response = $this->restservice->post($this->config->item("treater_changeFlag"), $this->headers ,$SendData );
                $response->token = $this->security->get_csrf_hash();

                if($response->code == 1)
                {
                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'.$response->message.'</div>');
                    $response->path = base_url('agreement/edit/'.$agreementId);
                }
                echo json_encode($response);
                return TRUE;
        }

         $this->data['pre_selected_status'] = $status;

         $this->load->view('treaty/treaty_status_form', $this->data);
    }

    function endorsement($treaterid)
    {
        $treaterid = base64_decode($treaterid);


        if($this->input->post('typeOfEndorsement'))
        {
            $createData = array(
                "id" => $treaterid,
                "typeOfEndorsement" => $this->input->post('typeOfEndorsement'),


            );
            $createData = http_build_query($createData);
            $response = $this->restservice->post($this->config->item("treater_createVersion"), $this->headers,$createData );

            if($response->code == 1)
            {
                $new_id = $response->entity->id;
                $response->path = base_url("treaty/treaty_slip/".base64_encode($new_id));
            }
            echo json_encode($response);
            return TRUE;
        }


        $this->load->view('treaty/endorsement_form', $this->data);
    }
    function createRenewal($treaterid)
    {
        $treaterid = base64_decode($treaterid);

        $createData = array("id" => $treaterid );
        $createData = http_build_query($createData);
        $response = $this->restservice->post($this->config->item("Renewal_create"), $this->headers,$createData );

        if(isset($response))
        {
            $new_id = $response->entity->id;
            return redirect(base_url("treaty/treaty_slip/".base64_encode($new_id)));
        }else
        {
            $Referer_url = $_SERVER['HTTP_REFERER'];
            $url_array = explode('/',$Referer_url);
            $agreement_id = base64_decode(end($url_array));

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button><b>We\'re Sorry.</b><br>Service is temporarily unavailable</div>');
            $response->path = base_url('Location');
            return redirect(base_url("treaty/slips/".base64_encode($agreement_id)));
        }

    }
}