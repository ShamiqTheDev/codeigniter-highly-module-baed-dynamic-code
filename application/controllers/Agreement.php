<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agreement extends CI_Controller {

    protected $module;
	protected $headers; 

    function __construct() {
        parent::__construct();
        $this->check_auth();

        $this->load->vars('base_url', base_url());
        $this->load->vars('includes_dir', base_url() . 'assets/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));

        $this->data = null;
        $this->module = strtolower(__CLASS__);

    }
	
    /*
     *
     *  Treaty Agreement Listing Service 
     *
    */
    public function index($pageNo='')
    {
        $this->isPermission($this->uri->segment(1));
        $post = $this->input->post();
        if (isset($post['get_data'])) {

            if (!empty($pageNo)) {
                $post['totalPages'] = $pageNo;
            }
            $post = array_merge($post,$this->config->item('listing'));
            $response = $this->postData('agreement_listing_filer',$post,true);
            $token = $this->security->get_csrf_hash();
            $get_response["get_data"] = $response['data'];
            $get_response["get_csrf_hash"] = $token;

            toJson($get_response,1);

            return TRUE;
        }

        $ListingConfig = array();
        $SearchFilters = array(
            array(
                'label'         => 'Agreement Number',
                'placeholder'   => 'Enter Agreement Number',
                'name'          => 'agreementNumber',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,
            ),
            array(
                'label'         => 'Agreement Date',
                'placeholder'   => 'Enter Agreement Date',
                'name'          => 'agreementDate',
                'type'          => 'date',
                'class'         => 'form-control',
                'required'      => false,
            ),
            array(
                'label'         => 'Statistical Year',
                'placeholder'   => 'Enter Statistical Year',
                'name'          => 'statisticsYear',
                'type'          => 'number',
                'class'         => 'form-control',
                'required'      => false,
                'minlength'     => 4,
                'maxlength'     => 4,
            ),
            array(
                'label'         => 'Meeting Location',
                'placeholder'   => 'Enter Meeting Location',
                'name'          => 'meetingLocation',
                'type'          => 'text',
                'class'         => 'form-control',
                'required'      => false,
            ),
        );
        $tableColumns = array(
            'agreementNumber'           => $this->lang->line('col_AgreementNumber'),
            'agreementDate_custom_date' => $this->lang->line('col_AgreementDate'),
            'statisticsYear'            => $this->lang->line('col_TreatyYear'),
            'meetingDate_custom_date'   => $this->lang->line('col_MeetingDate'),
            'meetingLocation'           => $this->lang->line('col_MeetingLocation'),
            'prcOfficialsName'          => $this->lang->line('col_PrcOfficialName'),
            'cedentOfficialsName'       => $this->lang->line('col_CedentOfficialName'),
        );

        $this->data['ListingConfig'] = array(
            'URl'               => current_url(),
            'DataColumns'       => json_encode($tableColumns),
            'currentPage'       => 0,
            'ItemPerpage'       => 10,
            'ActionButtons'     => array(
                "View"   => $this->isPermission('agreement/view',false,true),
                "Insert" => $this->isPermission('agreement/create',false,true),
                "Edit"   => $this->isPermission('agreement/edit',false,true),
                "Delete" => $this->isPermission('agreement/delete',false,true)
            ),
            'PageTitle'         => $this->lang->line('menu_treatyagreement'),
            'SearchFilters'     => $SearchFilters,
            'BtnAddNewRecordTitle' => $this->lang->line('btn_add_new_treatyAgreement')
        );

        $this->load->view('listing', $this->data);
    }


    /*
     *
     *  Treaty Agreement Create Service 
     *
    */
    public function create() 
    {
        $userData = $this->session->get_userdata('userData')['userData'];
        $uRoleId = $userData->roles_permissions->id;
        $post = $this->input->post();
        if (isset($post['treatyAgreement']['agreementDate']))
        {
            $responses=[];
            $agreementPost  = $post['treatyAgreement'];
            $agreementPost = replaceInArrayKey($agreementPost,'_','.');// filter 
            
            $detailsPost = $post['treatyDetails'];
            $detailsPost = replaceInArrayKey($detailsPost,'_','.');// filter 
            $agreementResponse = $this->docUpload('agreement_create',$agreementPost,$_FILES['file'],1,1);
            // if (isset($_FILES['file'])) {
                // $agreementResponse = $this->docUpload('agreement_create',$agreementPost,$_FILES['file'],1,1);
            // }else{
                // $agreementResponse = $this->postData('agreement_create',$agreementPost,1,1);
                // dd($agreementResponse);
            // }
            // dd($agreementResponse);
            $agreementResponse = json_decode($agreementResponse);
            $responses[] = $agreementResponse;
            $agreementId = isset($agreementResponse->entity->id)?$agreementResponse->entity->id:'';
            $statisticsId = isset($detailsPost['statisticsId'][0])?$detailsPost['statisticsId'][0]:'';
            $n = count(array_filter($detailsPost['treatierCode']));
            $temp = [];
            for ($i=0; $i < $n; $i++) {
                $bStatus = $detailsPost['treatyStatus'][$i] == 1 ?'true':'false';
                
                $temp['name']                   = $detailsPost['name'][$i];
                $temp['treatyCode.id']          = $detailsPost['treatyTypeDTO.id'][$i];
                $temp['treatierCode']           = $detailsPost['treatierCode'][$i];
                $temp['prePreviousShare']       = $detailsPost['prePreviousShare'][$i];
                $temp['preProposedShare']       = $detailsPost['preProposedShare'][$i];
                $temp['preApprovedShare']       = $detailsPost['preApprovedShare'][$i];
                $temp['currencyCode']           = $detailsPost['currencyCode'][$i];
                $temp['treatyStatus']           = $bStatus;
                $temp['agreementDTO.id']        = $agreementId;
                $temp['treatyStatisticsDTO.id'] = $statisticsId;
                $temp['createdBy']              = $uRoleId;

                // dd($temp);
                
                $url = $this->config->item('treaty_details_create');
                $postTreatyDetails = http_build_query($temp);
                $detailsResponse = $this->restservice->post($url, $this->headers, $postTreatyDetails);

                $responses[] = $detailsResponse;
                
            }


            $responses['token'] = $this->security->get_csrf_hash();
            if ( isset($responses[0]->code) && $responses[0]->code == 1 ) {
                $responses['response'] = 'Internal Server';
                $responses['code'] = 1;
                $responses['message'] = 'Agreement Added Successfully';
            }
            echo json_encode($responses);
            return TRUE;
        }

        $this->data['Treaty_types'] = $this->restservice->get($this->config->item("treatyCodes_views"), $this->headers);
        $this->data["module"] =  $this->module;
        $this->data["action"] = "add_record";

        $this->load->view($this->module."/create", $this->data);
    }

    /*
     *
     *  Treaty Agreement Edit Service 
     *
    */
    public function edit($id=NULL) 
    {
        $post = $this->input->post();
        $id = !empty(base64_decode($id))?base64_decode($id):$post['treatyAgreement']['id'];

        $response = [];
        if (isset($post['treatyAgreement']['agreementDate'])) {
            $agreementPost = $post['treatyAgreement'];
            $agreementPost = replaceInArrayKey($agreementPost,'_','.');// filter 

            $detailsPost = $post['treatyDetails'];
            $detailsPost = replaceInArrayKey($detailsPost,'_','.');// filter 
            $agreementResponse = $this->docUpload('agreement_update',$agreementPost,$_FILES['file'],1,1);
            $response = json_decode($agreementResponse,true);

            $n = count(array_filter($detailsPost['treatierCode']));

            $agreementId = isset($id)?$id:'';
            $statisticsId = isset($detailsPost['statisticsId'][0])?$detailsPost['statisticsId'][0]:'';
            $temp = [];
            $temp2 = [];

            for ($i=0; $i < $n; $i++) {
                if (isset($detailsPost['id'][$i])) {
                    $temp['id']                     = $detailsPost['id'][$i];
                    $temp['name']                   = $detailsPost['name'][$i];
                    $temp['treatyCode.id']          = $detailsPost['treatyTypeDTO.id'][$i];
                    $temp['treatierCode']           = $detailsPost['treatierCode'][$i];
                    $temp['prePreviousShare']       = $detailsPost['prePreviousShare'][$i];
                    $temp['preProposedShare']       = $detailsPost['preProposedShare'][$i];
                    $temp['preApprovedShare']       = $detailsPost['preApprovedShare'][$i];
                    $temp['currencyCode']           = $detailsPost['currencyCode'][$i];
                    $temp['treatyStatus']           = ($detailsPost['treatyStatus'][$i] == 1) ? 'true':'false';
                    $temp['agreementDTO.id']        = $agreementId;
                    $temp['treatyStatisticsDTO.id'] = $statisticsId;
                    
                }else{
                    $temp2['name']                   = $detailsPost['name'][$i];
                    $temp2['treatyCode.id']          = $detailsPost['treatyTypeDTO.id'][$i];
                    $temp2['treatierCode']           = $detailsPost['treatierCode'][$i];
                    $temp2['prePreviousShare']       = $detailsPost['prePreviousShare'][$i];
                    $temp2['preProposedShare']       = $detailsPost['preProposedShare'][$i];
                    $temp2['preApprovedShare']       = $detailsPost['preApprovedShare'][$i];
                    $temp2['currencyCode']           = $detailsPost['currencyCode'][$i];

                    $temp2['treatyStatus']           = ($detailsPost['treatyStatus'][$i] == 1) ? 'true':'false';
                    $temp2['agreementDTO.id']        = $agreementId;
                    $temp2['treatyStatisticsDTO.id'] = $statisticsId;

                }
                // dd($temp);
                $url = $this->config->item('treaty_details_update');
                $postTreatyDetailsUpdate = http_build_query($temp);
                $responseTd = $this->restservice->post($url, $this->headers, $postTreatyDetailsUpdate);

                if (!empty($temp2)) {
                    $url = $this->config->item('treaty_details_create');
                    $postTreatyDetailsCreate = http_build_query($temp2);
                    $responseTd = $this->restservice->post($url, $this->headers, $postTreatyDetailsCreate);
                }
                
                $token = $this->security->get_csrf_hash();
                $responses[] = $responseTd;
                
            }

            $response['token'] = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
        $response  = $this->getData('agreement_view',$id,0,0)['data'];
        $treatyDetails = $this->getData('treater_details_by_agreement',$id,0,0)['data'];

        $decoded = base64_decode($response->encodedFile);
        $pathToSaveDocument = './uploads/agreement';
        if (!is_dir($pathToSaveDocument)) {
            mkdir($pathToSaveDocument, 0775, true);
        }

        if (!file_exists($pathToSaveDocument.'/'.$response->filePath)) {
            file_put_contents($pathToSaveDocument.'/'.$response->filePath,$decoded);
        }

        $this->data['Treaty_types'] = $this->restservice->get($this->config->item("treatyCodes_views"), $this->headers);
        $this->data["templateId"] = $this->config->item('templateId');
        // dd($treatyDetails);
        $this->data["treatyDetails"] = $treatyDetails;
        $this->data["module"] =  $this->module;
        $this->data["response"] = $response;


        $this->data["action"] = "edit_record";
        $this->load->view($this->module.'/create',$this->data);
    }


    /*
     *
     *  Treaty Agreement Delete Service 
     *
    */
    public function delete() 
    {
        if ($this->input->post('id')) {
            $id = base64_decode($this->input->post('id'));
            $url = $this->config->item('agreement_delete').'/'.$id;
            $response = $this->restservice->get($url, $this->headers);
            $response->token = $this->security->get_csrf_hash();
            echo json_encode($response);
            return TRUE;
        }
    }


    /*
     *
     *  Treaty Agreement View Service 
     *
     */
    public function view($id=NULL)
    {

        $id = base64_decode($id);


        $this->data['Treaty_types'] = $this->restservice->get($this->config->item("treatyCodes_views"), $this->headers);

        $this->data["templateId"] = $this->config->item('templateId');
        $this->data["treatyDetails"] = $this->getData('treater_details_by_agreement',$id,0,0)['data'];
        $this->data["module"] =  $this->module;
        $this->data["response"] = $this->getData('agreement_view',$id,0,0)['data'];
        $this->data["action"] = "view_record";
        $this->load->view($this->module.'/create',$this->data);
    }

    public function letter($agrId=null,$templateId='')
    {
        $id = base64_decode($agrId);
        $agrResponse  = $this->getData('agreement_view',$id,0,0)['data'];
        $templateId = !empty($templateId)?base64_decode($templateId):$this->config->item('templateId');
        $response = $this->getData('template_view',$templateId,0,0,0);
        $treatyDetails = $this->getData('treater_details_by_agreement',$id,0,0)['data'];
        $module = $this->module;

        $html = isset($response->content)?$response->content:'';
        
        $defaultTemplatePath = $this->config->item('defaultTemplatePath');
        $mainView = 'template/view';
        $viewPath = !empty($html)?$mainView:$defaultTemplatePath;

        $currResp = $this->getData('currency_getAll','',false,false);
        $currRespData = $currResp['data'];
        $this->load->view($viewPath, compact('html','response','treatyDetails','agrResponse','currRespData'));
    }

    /*
     *
     *  Treaty Agreement Form Dropdowns 
     *
    */
    public function getCedents()
    {
        return $this->getData('cedent_listing');
    }

    public function getTreatyTypes()
    {
        $response = $this->getData('treatyCodes_views','',0,0,0);
        // dd($response);
        $customData=[];
        foreach ($response as $treatyCode) {
            if (!empty($treatyCode->treatyName)) {
                $customData[] = [
                    'id'            => $treatyCode->id,
                    'tName'    => $treatyCode->treatyName,
                ];
            }
        }

        $data['data'] = $customData;
        $data['token'] = $this->security->get_csrf_hash();

        echo json_encode($data);
        return true;
    }

    public function getTreatyCodes($tType='')
    {
        $tType = base64_decode($tType);
        // dd($tType);
        $tType = explode('|', $tType);

        $treatyName = $tType[0];
        $rowClass = isset($tType[1])?explode('_', $tType[1]):[];
        $rowId = $rowClass[1];
        $customData=[];
        $response = $this->getData('treatyCodes_views','',0,0,0);
        // dd($response);
        foreach ($response as $treatyCode) {
            if ($treatyName==$treatyCode->treatyName || $treatyName=='null') {
                $customData[] = [
                    'id'            => $treatyCode->id,
                    'treatyType'    => $treatyCode->treatyType,
                    'tCode'    => $treatyCode->treatyCode,
                ];
            }
        }
        $data['rowId'] = $rowId;
        $data['data'] = $customData;
        $data['token'] = $this->security->get_csrf_hash();
        echo json_encode($data);
        return true;
    }

    public function getTreatyCategories()
    {
        return $this->getData('treaty_category_listing');
    }

    public function getCurrencies()
    {
        return $this->getData('currency_getAll');
    }

    public function getStates()
    {
        $post = $this->input->post();
        $year = $post['year'];
        $cedent = $post['cedent'];
        $id = $post['id'];
        $page = $post['page'];

        $pData = [
            'treatyYear' => $year,
            'cedentId' => $cedent,
        ];
        if (isset($year) || isset($cedent)) {
            $states = $this->postData('treaty_states_get_all_by_year_cedent',$pData,1,1);
        }else{
            $states = $this->getData('treaty_states_listing','',0,0)['data'];
        }
        $disabled = '';
        if ($page == 'view') {
            $disabled = 'disabled ';
        }
        $states = !empty($states)?$states:[];
        foreach ($states as $state) {

            $treatyStatesYear = $state->currentYear;
            $cedentId = isset($state->cedentDTO->id)?$state->cedentDTO->id:'';
            $cedentName = isset($state->cedentDTO->customerName)?$state->cedentDTO->customerName:'';
            // $businessName = isset($state->businessDTO->name)?$state->businessDTO->name:'';
            $treatyCategoryName = isset($state->treatyCategoryDTO->name)?$state->treatyCategoryDTO->name:'';
            $statesDate = date('d/M/Y',strtotime($state->statisticsDate));
            $createRowWithYear = $createRowWithCedent = false;

            $checked='';
            if ($id==$state->id) {
                $checked = 'checked';
            }

            if (!empty($cedent) && $cedent == $cedentId) {
                $createRowWithYear = true;
            }

            if (!empty($year) && $year == $treatyStatesYear) {
                $createRowWithCedent = true;
            }

            if ($createRowWithYear && $createRowWithCedent) { 
            ?>
            <tr>
                <td>
                    <input type="radio" class="treatyYear" data-id="<?php echo $state->id?>" name="treatyDetails[statisticsId][]" value="<?php echo $state->id?>" <?php echo $disabled.$checked?>>
                </td>
                <td>  <?php echo $state->treatyStatisticsNo?></td>
                <td>  <?php echo $treatyStatesYear?></td>
                <td>  <?php echo $cedentName?></td>
                <!-- <td>  <?php echo $businessName?></td> -->
                <td>  <?php echo $treatyCategoryName?></td>
                <td>  <?php echo $statesDate?></td>
            </tr>
            <?php 
            }
        }
    }
}