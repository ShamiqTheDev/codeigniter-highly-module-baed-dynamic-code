<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FacultativeNote extends CI_Controller {

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
        // $this->isPermission($this->uri->segment(1));
       if ($this->input->post('get_data'))
        {
            if (!empty($pageNo)) {
                $_POST['totalPages'] = $pageNo;
            }
            $_POST = array_merge($_POST,$this->config->item('listing'));
            $sendData = http_build_query($_POST);
            $response = new StdClass();
            $response = $this->restservice->post($this->config->item("facultative_General_listing"), $this->headers,$sendData);
            
            $token = $this->security->get_csrf_hash();
            $get_responce["get_data"] = $response;
            $get_responce["get_csrf_hash"] = $token;
            echo json_encode($get_responce);
            return TRUE;

        }

        $ListingConfig = array();
        $ListingConfig['URl'] = current_url();
        $ListingConfig['DataColumns'] = json_encode(array("facInceptionDate"=>$this->lang->line('col_InceptionDate'),
                                                    "facReqDate"=>$this->lang->line('col_RequestNoteDate'),
                                                    "facReqNo"=>$this->lang->line('col_RequestNoteNo'),
                                                    "cedentDTO_customerName"=>$this->lang->line('col_cedentName'),
                                                    "insuredDTO_insuredName"=>$this->lang->line('col_insuredName')
        ));
        $ListingConfig['currentPage'] = 0;
        $ListingConfig['ItemPerpage'] = 10;
        $ListingConfig['direction'] = 'desc';
        $ListingConfig['sortBy'] = 'id';
        $ListingConfig['ActionButtons'] = array(
            "View"   => $this->isPermission('facultativeNote/view',false,true),
            "Insert" => $this->isPermission('facultativeNote/create',false,true),
            "Edit"   => $this->isPermission('facultativeNote/edit',false,true),
            "Delete" => $this->isPermission('facultativeNote/delete',false,true)
        );
        $ListingConfig['PageTitle'] = $this->lang->line('menu_facultativeNote');

        // $filters = $this->config->item('treaty_details','filters');

        // $ListingConfig['filters'] = $filters;
        $this->data['ListingConfig'] = $ListingConfig;

        $this->load->view('listing', $this->data);
    } 

    public function details($action='',$facultativeNoteId='')
    {
        
        $facultativeNoteId = base64_decode($facultativeNoteId);
        $this->data['facultativeNoteId'] = $facultativeNoteId;

        if($action =='view') $this->data["action"] = "view_record"; 
        elseif($action =='edit')  $this->data["action"] = "edit_record"; 
        else $this->data["action"] = "add_record";  


        if($this->input->post('requestNotInfo_Btn'))
        {
            $FacultativeNote_General_Data = array(
                        "facinceptionDate" => date("m/d/Y",strtotime($this->input->post('facinceptionDate'))),
                        "facReqNo" => $this->input->post('facReqNo'),
                        "facReqDate" => date("m/d/Y",strtotime($this->input->post('facReqDate'))),
                        "cedentDTO.id" => $this->input->post('cedentDTO_id'),
                        "facOriginalInsuredName" => $this->input->post('facOriginalInsuredName'),
                        "insuredDTO.id" => $this->input->post('insuredDTO_id'),
                        "typeOfCoverInterest" => $this->input->post('typeOfCoverInterest'),
                        "coverPerilsDetail" => $this->input->post('coverPerilsDetail'),
                        "maxProbableLoss" => $this->input->post('maxProbableLoss'),
                        "cpDays" => $this->input->post('cpDays'),
                        "premiumPaymentWarranty" => $this->input->post('premiumPaymentWarranty'),
                        // "status" => $this->input->post('SelectStatus'),
                        "businessDTO.id" => $this->input->post('business_class'),
                        "subBusinessDTO.id" => $this->input->post('businessSubBusinessDTO_id'),
                        "policyType" => $this->input->post('policyType'),
                        "underwritingYear" => $this->input->post('underwritingYear'),
                        "UnderwritingQuarter" => $this->input->post('UnderwritingQuarter'),
                        "geoTerritorialLimit" => $this->input->post('geoTerritorialLimit'),
                        "CompanyRetention" => $this->input->post('CompanyRetention'),
                        "inLandLimit" => $this->input->post('inLandLimit'),
                        "isRetro" => $this->input->post('isRetro'),
                        "grossTreatyShare" => $this->input->post('grossTreatyShare'),
                        "grossTreatySharePercentage" => $this->input->post('grossTreatySharePercentage'),
                        "grossTreatyShareCurrency" => $this->input->post('grossTreatyShareCurrency'),
                        "grossTreatyShareAmount" => $this->input->post('grossTreatyShareAmount'),
                        "prcTreatyShare" => $this->input->post('prcTreatyShare'),
                        "prcTreatySharePercentage" => $this->input->post('prcTreatySharePercentage'),
                        "prcTreatyShareCurrecny" => $this->input->post('prcTreatyShareCurrecny'),
                        "prcTreatyShareAmount" => $this->input->post('prcTreatyShareAmount'),
                        "facRiAbroad" => $this->input->post('facRiAbroad'),
                        "facRiAbroadPercentage" => $this->input->post('facRiAbroadPercentage'),
                        "facRiAbroadCurrency" => $this->input->post('facRiAbroadCurrency'),
                        "facRiAbroadAmount" => $this->input->post('facRiAbroadAmount'),
                        "sumInsurred" => $this->input->post('sumInsurred'),
                        "sumInsurredPercentage" => $this->input->post('sumInsurredPercentage'),
                        "sumInsurredCurrency" => $this->input->post('sumInsurredCurrency'),
                        "sumInsuredAmount" => $this->input->post('sumInsuredAmount'),
                        "limitLiability" => $this->input->post('limitLiability'),
                        "limitLiabilityPercentage" => $this->input->post('limitLiabilityPercentage'),
                        "limitLiabilityCurrency" => $this->input->post('limitLiabilityCurrency'),
                        "limitLiabilityAmount" => $this->input->post('limitLiabilityAmount'),
                        "treatyCapacity" => $this->input->post('treatyCapacity'),
                        "treatyCapacityPercentage" => $this->input->post('treatyCapacityPercentage'),
                        "treatyCapacityCurrency" => $this->input->post('treatyCapacityCurrency'),
                        "treatyCapacityAmount" => $this->input->post('treatyCapacityAmount'),
                        "facultativeCapacity" => $this->input->post('facultativeCapacity'),
                        "facultativeCapacityPecentage" => $this->input->post('facultativeCapacityPecentage'),
                        "facultativeCapacityCurrency" => $this->input->post('facultativeCapacityCurrency'),
                        "facultativeCapacityAmount" => $this->input->post('facultativeCapacityAmount'),
                        "conveyance" => $this->input->post('conveyance'),
                        "vesselCarrier" => $this->input->post('vesselCarrier'),
                        "perCarryLimits" => $this->input->post('perCarryLimits'),
                        "perTransit" => $this->input->post('perTransit'),
                     );

                    if($this->input->post('hiddenFacultativeNoteId'))
                    {
                        $FacultativeNote_General_Data['id'] = $this->input->post('hiddenFacultativeNoteId');
                        $SendDataGeneral = http_build_query($FacultativeNote_General_Data);
                        $response_facultativeNoteGeneral = $this->restservice->post($this->config->item("facultative_General_update"), $this->headers,$SendDataGeneral );

                    }else
                    {
                        $SendDataGeneral = http_build_query($FacultativeNote_General_Data);
                        $response_facultativeNoteGeneral = $this->restservice->post($this->config->item("facultative_General_create"), $this->headers,$SendDataGeneral );
                    }


                   if($response_facultativeNoteGeneral->code == 1)
                    {

                        if($this->input->post('hiddenFacultativeNoteId')){
                            $facultativeNoteGeneral_Id = $this->input->post('hiddenFacultativeNoteId');
                        } else {
                            $facultativeNoteGeneral_Id = $response_facultativeNoteGeneral->entity->id;
                        }

                         $FacultativeNote_CoInsurer_Data = array(
                            "facGeneralDTO.id" => $facultativeNoteGeneral_Id,
                            "facCoInsurer" => ($this->input->post('facCoInsurer') == 'Yes'  ? 'Yes' : 'No' ),
                            "facInsurer" => $this->input->post('facInsurer'),
                            "facInsurerPerc" => $this->input->post('facInsurerPerc'),
                            "facInsurerCurrency" => $this->input->post('facInsurerCurrency'),
                            "facPrcSharePerc" => $this->input->post('facPrcSharePerc'),
                            "facPrcSharePercOf" => $this->input->post('facPrcSharePercOf'),
                            "facPrcSharePercOf2" => $this->input->post('facPrcSharePercOf2'),
                            "facPrcShare" => $this->input->post('facPrcShare'),
                         );  

                        $FacultativeNote_CoInsurer_Data = http_build_query($FacultativeNote_CoInsurer_Data);
                        $this->restservice->post($this->config->item("facultative_CoInsurer_create"), $this->headers,$FacultativeNote_CoInsurer_Data);


                         $FacultativeNote_Accepted_Data = array(
                            "facGeneralDTO.id" => $facultativeNoteGeneral_Id,
                            "facPrcAcceptPerc" => $this->input->post('facPrcAcceptPerc'),
                            "facPrcAcceptPercOffPerc" => $this->input->post('facPrcAcceptPercOffPerc'),
                            "facRate" => $this->input->post('facRate'),
                            "facPrcAcceptCurrency" => $this->input->post('facPrcAcceptCurrency'),
                            "facGrossPremium" => $this->input->post('facGrossPremium'),
                            "facPrcShareAmount" => $this->input->post('facPrcShareAmount'),
                            "facPrcAcceptDesc" => $this->input->post('facPrcAcceptDesc'),
                         );   

                         $FacultativeNote_Accepted_Data = http_build_query($FacultativeNote_Accepted_Data);
                         $this->restservice->post($this->config->item("facultative_BusinessOfferedAcceptance_create"), $this->headers,$FacultativeNote_Accepted_Data);


                            $FacultativeNote_RICommision_Data = array(
                                "facGeneralDTO.id" => $facultativeNoteGeneral_Id,
                                "facCommisionDemand" => $this->input->post('facCommisionDemand'),
                                "facCommissionAccepted" => $this->input->post('facCommissionAccepted'),
                                "facCommissionCurrency" => $this->input->post('facCommissionCurrency'),
                                "facCommissionPrcComm" => $this->input->post('facCommissionPrcComm'),
                             );

                           $FacultativeNote_RICommision_Data = http_build_query($FacultativeNote_RICommision_Data);
                            $this->restservice->post($this->config->item("facultative_RiCommission_create"), $this->headers,$FacultativeNote_RICommision_Data);



                             $FacultativeNote_Adjusted_Data = array(
                                "facGeneralDTO.id" => $facultativeNoteGeneral_Id,
                                "facAdjustedRate" => $this->input->post('facAdjustedRate'),
                                "facAdjustedSumInsured" => $this->input->post('facAdjustedSumInsured'),
                                "facAdjustedCurrency" => $this->input->post('facAdjustedCurrency'),
                                "facAdjustedPrcShareSi" => $this->input->post('facAdjustedPrcShareSi'),
                                "facAdjustedPrcShareLL" => $this->input->post('facAdjustedPrcShareLL'),
                                "facAdjustedPrcSharePremium" => $this->input->post('facAdjustedPrcSharePremium'),
                             );

                           $FacultativeNote_Adjusted_Data = http_build_query($FacultativeNote_Adjusted_Data);
                            $this->restservice->post($this->config->item("facultative_AdjustedSumInsured_create"), $this->headers,$FacultativeNote_Adjusted_Data);

        

                        echo json_encode($response_facultativeNoteGeneral);
                        return TRUE;
                        exit;
                    } else {
                       $response_facultativeNoteGeneral->facultativeNoteGeneral = "Error";
                       echo json_encode($response_facultativeNoteGeneral);
                       return TRUE;
                       exit;
                    }

        }

        

        $this->data['Deductibles'] = $this->GetDeductiblesOptions();

        $this->load->view('facultative_note/facultative_note', $this->data);


    } 


    public function GetDeductiblesOptions() 
    {
       $Deductables = $this->restservice->get($this->config->item('deductables_getAll'), $this->headers);
       $Deductables = json_decode(json_encode($Deductables));
      
       return($Deductables);
    }

    public function GetfacultativeNoteGeneral() 
    {
       $facultativeNoteId = $this->input->post('facultativeNoteId');
       $aData = $this->restservice->get($this->config->item("facultative_General_view") . "/$facultativeNoteId", $this->headers);
       echo json_encode($aData);
        return true;
    }

    public function GetfacultativeNoteCoInsurer() 
    {
       $facultativeNoteId = $this->input->post('facultativeNoteId');
       $aData = $this->restservice->get($this->config->item("facultative_CoInsurer_view") . "/$facultativeNoteId", $this->headers);
       echo json_encode($aData);
        return true;
    }
     
}