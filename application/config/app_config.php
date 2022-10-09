<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Email Mode ---- DEV or PROD 
|--------------------------------------------------------------------------
|
*/
$config['email_mode'] = 'DEV';

/* SMS SETTING */
$config['sms_mode'] = 'DEVELOPMENT';
//$config['sms_mode'] = 'DEVELOPMENT';
$config['development_mode'] = 'ON'; // ON/OFF
$config['customLogs'] = 1;

//  Treaty Slip Flags
$config['treaty_status'] = [
	"21"=>'entered',
	"22"=>'opened',
	"23"=>'cancelled',
	"24"=>'terminated',
	"25"=>'discontinued'
];



/*
|--------------------------------------------------------------------------
| Services URLs 
|--------------------------------------------------------------------------
|
*/
$config['pakre_username'] = '';
$config['pakre_password'] = '';

// Service Root Url
$serviceUrl = "";

// Cedent
$config['cedent_create'] = $serviceUrl."cedent/create";
$config['cedent_listing_filter'] = $serviceUrl."cedent/views";
$config['cedent_listing'] = $serviceUrl."cedent/getAll";
$config['cedent_delete'] = $serviceUrl."cedent/delete";
$config['cedent_view'] = $serviceUrl."cedent/view";
$config['cedent_update'] = $serviceUrl."cedent/update";

$config['cedentCategory'] = [
	'' => 'Please select cedent category',
	'f' => 'Foreign',
	'l' => 'Local',
];

$config['cedentType'] = [
	'' => 'Please select cedent type',
	'b' => 'Broker',
	'c' => 'Cedent',
	's' => 'Security',
	'cl' => 'Client',
	'sd' => 'Syndicate',
];

$config['cedentStatus'] = [
	'1' => 'Active',
	'0' => 'Inactive',
];

// Module
$config['module_create'] = $serviceUrl."module/create";
$config['module_listing'] = $serviceUrl."module/views";
$config['module_view'] = $serviceUrl."module/view";
$config['module_update'] = $serviceUrl."module/update";
$config['module_delete'] = $serviceUrl."module/delete";
$config['module_getAll'] = $serviceUrl."module/getAll";
$config['module_getPermissionsListByModuleIdList'] = $serviceUrl."module/getPermissionsListByModuleIdList";

// Role
$config['role_create'] = $serviceUrl."role/create";
$config['role_listing_filter'] = $serviceUrl."role/views";
$config['role_listing'] = $serviceUrl."role/getAll";
$config['role_view'] = $serviceUrl."role/view";
$config['role_update'] = $serviceUrl."role/update";
$config['role_delete'] = $serviceUrl."role/delete";

// User
$config['user_create'] 	= $serviceUrl."user/create";
$config['user_listing'] = $serviceUrl."user/views";
$config['user_delete'] 	= $serviceUrl."user/delete";
$config['user_view'] 	= $serviceUrl."user/view";
$config['user_update'] 	= $serviceUrl."user/update";

// BusinessSubBusiness
$config['business_create'] = $serviceUrl."businessSubBusiness/create";
$config['business_listing_filter'] = $serviceUrl."businessSubBusiness/views";
$config['business_delete'] = $serviceUrl."businessSubBusiness/delete";
$config['business_view'] = $serviceUrl."businessSubBusiness/view";
$config['business_update'] = $serviceUrl."businessSubBusiness/update";
$config['business_listing'] = $serviceUrl."businessSubBusiness/getAll";


// Login
$config['login'] = $serviceUrl."auth";

// Agreement
$config['agreement_create'] = $serviceUrl."agreement/create";
$config['agreement_listing_filer'] = $serviceUrl."agreement/views";
$config['agreement_listing'] = $serviceUrl."agreement/getAll";
$config['agreement_delete'] = $serviceUrl."agreement/delete";
$config['agreement_view'] = $serviceUrl."agreement/view";
$config['agreement_update'] = $serviceUrl."agreement/update";

// Treaty Type
$config['treaty_type_create'] = $serviceUrl."treatyType/create";
$config['treaty_type_delete'] = $serviceUrl."treatyType/delete";
$config['treaty_type_listing'] = $serviceUrl."treatyType/getAll";
$config['treaty_type_update'] = $serviceUrl."treatyType/update";

$config['treaty_type_view'] = $serviceUrl."treatyType/view";
$config['treaty_type_listing_filter'] = $serviceUrl."treatyType/views";

// Treaty Particular
$config['treaty_particular_create'] = $serviceUrl."treatyParticular/create";
$config['treaty_particular_delete'] = $serviceUrl."treatyParticular/delete";
$config['treaty_particular_listing'] = $serviceUrl."treatyParticular/getAll";
$config['treaty_particular_update'] = $serviceUrl."treatyParticular/update";

$config['treaty_particular_view'] = $serviceUrl."treatyParticular/view";
$config['treaty_particular_listing_filter'] = $serviceUrl."treatyParticular/views";

// Treaty Category
$config['treaty_category_create'] = $serviceUrl."treatyCategory/create";
$config['treaty_category_delete'] = $serviceUrl."treatyCategory/delete";
$config['treaty_category_listing'] = $serviceUrl."treatyCategory/getAll";
$config['treaty_category_update'] = $serviceUrl."treatyCategory/update";

$config['treaty_category_view'] = $serviceUrl."treatyCategory/view";
$config['treaty_category_listing_filter'] = $serviceUrl."treatyCategory/views";

$config['treaty_category_parent_view'] = $serviceUrl."treatyCategory/findByParentId";
$config['treaty_category_parent_listing'] = $serviceUrl."treatyCategory/getAllParents";

// Treaty Details 
$config['treaty_details_create'] = $serviceUrl."treatier/create";
$config['treaty_details_listing'] = $serviceUrl."treatier/views";
$config['treaty_details_delete'] = $serviceUrl."treatier/delete";
$config['treaty_details_view'] = $serviceUrl."treatier/view";
$config['treaty_details_update'] = $serviceUrl."treatier/update"; // pelase do not change it is placed due to code conflict
$config['changeFlag'] = $serviceUrl."treatier/update";
$config['treater_details'] = $serviceUrl."treatier/getDataWithTreatierId";
$config['treater_details_by_agreement'] = $serviceUrl."treatier/getAllByAgreementId";
$config['treater_createVersion'] = $serviceUrl."treatier/createVersion";
$config['treater_changeFlag'] = $serviceUrl."treatier/changeFlag";
$config['treater_proceed'] = $serviceUrl."treatier/proceed";
$config['treater_sendTo'] = $serviceUrl."treatier/sendTo";
$config['treater_get_previous_roles_by_id'] = $serviceUrl."treatier/previousFLowByTreatierId";
$config['treater_get_group_by_agreement_id'] = $serviceUrl."treatier/getAllGroupByAgreementId";
$config['treater_entered'] = $serviceUrl."treatier/viewsWithIsSlipEnteredTrue";
$config['treater_completedTreaties'] = $serviceUrl."treatier/getCompletedTreaties";

$config['admin'] = 'Admin';
$config['initiator'] = 'initiator';
$config['reviewer1'] = 'reviewer 1';
$config['reviewer2'] = 'reviewer 2';
$config['approver'] = 'approver';

// Currency
$config['currency_listing'] = $serviceUrl."currency/views";
$config['currency_create'] = $serviceUrl."currency/create";
$config['currency_delete'] = $serviceUrl."currency/delete";
$config['currency_view'] = $serviceUrl."currency/view";
$config['currency_update'] = $serviceUrl."currency/update";
$config['currency_getAll'] = $serviceUrl."currency/getAll";

// Currency Rate
$config['currency_rate_listing'] = $serviceUrl."currencyRate/views";
$config['currency_rate_create'] = $serviceUrl."currencyRate/create";
$config['currency_rate_delete'] = $serviceUrl."currencyRate/delete";
$config['currency_rate_view'] = $serviceUrl."currencyRate/view";
$config['currency_rate_update'] = $serviceUrl."currencyRate/update";
$config['currency_rate_getAll'] = $serviceUrl."currencyRate/getAll";
$config['currency_rate'] = $serviceUrl."currencyRate/currencyFilterByProperties";


// Primary Insurer
$config['primary_insurer_listing'] = $serviceUrl."primaryInsurer/views";
$config['primary_insurer_create'] = $serviceUrl."primaryInsurer/create";
$config['primary_insurer_delete'] = $serviceUrl."primaryInsurer/delete";
$config['primary_insurer_view'] = $serviceUrl."primaryInsurer/view";
$config['primary_insurer_update'] = $serviceUrl."primaryInsurer/update";


// Treaty States
$config['treaty_states_create'] = $serviceUrl."treatyStatistics/create";
$config['treaty_states_delete'] = $serviceUrl."treatyStatistics/delete";
$config['treaty_states_listing'] = $serviceUrl."treatyStatistics/getAll";
$config['treaty_states_update'] = $serviceUrl."treatyStatistics/update";
$config['treaty_states_view'] = $serviceUrl."treatyStatistics/view";
$config['treaty_states_listing_filter'] = $serviceUrl."treatyStatistics/views";
$config['treaty_states_group_by_batch_id'] = $serviceUrl."treatyStatistics/getStatisticsGroupByBatchId";
$config['treaty_states_get_by_batch_id'] = $serviceUrl."treatyStatistics/getByBatchId";
$config['treaty_states_get_all_by_year_cedent'] = $serviceUrl."treatyStatistics/getAllByYearAndCedentId";
$config['treaty_states_grp_by_stats_no'] = $serviceUrl."treatyStatistics/getStatisticsGroupByStatisticsNo";
$config['treaty_states_del_by_stats_no'] = $serviceUrl."treatyStatistics/deleteByTreatyStatisticsNo";


// Treaty Basic
$config['treaty_basic_create'] = $serviceUrl."treatyBasic/create";
$config['treaty_basic_delete'] = $serviceUrl."treatyBasic/delete";
$config['treaty_basic_listing'] = $serviceUrl."treatyBasic/getAll";
$config['treaty_basic_update'] = $serviceUrl."treatyBasic/update";

$config['treaty_basic_view'] = $serviceUrl."treatyBasic/view";
$config['treaty_basic_listing_filter'] = $serviceUrl."treatyBasic/views";

// City
$config['city_listing'] = $serviceUrl."city/views";
$config['city_create'] = $serviceUrl."city/create";
$config['city_delete'] = $serviceUrl."city/delete";
$config['city_view'] = $serviceUrl."city/view";
$config['city_update'] = $serviceUrl."city/update";
$config['city_getAll'] = $serviceUrl."city/getAll";

// Cresta Zone
$config['crestaZone_listing'] = $serviceUrl."crestaZone/views";
$config['crestaZone_create'] = $serviceUrl."crestaZone/create";
$config['crestaZone_delete'] = $serviceUrl."crestaZone/delete";
$config['crestaZone_view'] = $serviceUrl."crestaZone/view";
$config['crestaZone_update'] = $serviceUrl."crestaZone/update";

// Treaty Sub Types
$config['treatySubType_listing'] = $serviceUrl."treatySubType/views";
$config['treatySubType_create'] = $serviceUrl."treatySubType/create";
$config['treatySubType_delete'] = $serviceUrl."treatySubType/delete";
$config['treatySubType_view'] = $serviceUrl."treatySubType/view";
$config['treatySubType_update'] = $serviceUrl."treatySubType/update";
$config['treatySubType_getAll'] = $serviceUrl."treatySubType/getAll";


// condition type
$config['conditionType_listing'] = $serviceUrl."conditionType/views";
$config['conditionType_create'] = $serviceUrl."conditionType/create";
$config['conditionType_delete'] = $serviceUrl."conditionType/delete";
$config['conditionType_view'] = $serviceUrl."conditionType/view";
$config['conditionType_update'] = $serviceUrl."conditionType/update";
$config['conditionTypes'] = $serviceUrl."conditionType/getAll";
$config['conditionTypes_get_by_condition_type_id'] = $serviceUrl."conditionType/getByConditionTypeId";


// condition
$config['condition_listing'] = $serviceUrl."condition/views";
$config['condition_create'] = $serviceUrl."condition/create";
$config['condition_delete'] = $serviceUrl."condition/delete";
$config['condition_view'] = $serviceUrl."condition/view";
$config['condition_update'] = $serviceUrl."condition/update";
$config['condition_getAll'] = $serviceUrl."condition/getAll";


// Treaty Codes
$config['treatyCodes_listing'] = $serviceUrl."treatyCodes/views";
$config['treatyCodes_create'] = $serviceUrl."treatyCodes/create";
$config['treatyCodes_delete'] = $serviceUrl."treatyCodes/delete";
$config['treatyCodes_view'] = $serviceUrl."treatyCodes/view";
$config['treatyCodes_update'] = $serviceUrl."treatyCodes/update";
$config['treatyCodes_views'] = $serviceUrl."treatyCodes/getAll";


// GL Codes
$config['glcodes_create'] = $serviceUrl."glCodes/create";
$config['glcodes_delete'] = $serviceUrl."glCodes/delete";
$config['glcodes_listing'] = $serviceUrl."glCodes/getAll";
$config['glcodes_update'] = $serviceUrl."glCodes/update";

$config['glcodes_view'] = $serviceUrl."glCodes/view";
$config['glcodes_listing_filter'] = $serviceUrl."glCodes/views";


// Treaty Slip
$config['treatyslip_create'] = $serviceUrl."treatySlip/create";
$config['treatyslip_delete'] = $serviceUrl."treatySlip/delete";
$config['treatyslip_listing'] = $serviceUrl."treatySlip/getAll";
$config['treatyslip_update'] = $serviceUrl."treatySlip/update";

$config['treatyslip_view'] = $serviceUrl."treatySlip/view";
$config['treatyslip_listing_filter'] = $serviceUrl."treatySlip/views";

// Treaty Slip Conditions
$config['treatyCondition_create'] = $serviceUrl."treatyCondition/create";
$config['treatyCondition_delete'] = $serviceUrl."treatyCondition/delete";
$config['treatyCondition_listing'] = $serviceUrl."treatyCondition/getAll";
$config['treatyCondition_update'] = $serviceUrl."treatyCondition/update";

$config['treatyCondition_view'] = $serviceUrl."treatyCondition/view";
$config['treatyCondition_listing_filter'] = $serviceUrl."treatyCondition/views";
$config['treatyCondition_getAllByGeneralId'] = $serviceUrl."treatyCondition/getAllByGeneralId";

// Treaty Slip Loss History
$config['treatyLossHistory_create'] = $serviceUrl."treatyLossHistory/create";
$config['treatyLossHistory_delete'] = $serviceUrl."treatyLossHistory/delete";
$config['treatyLossHistory_listing'] = $serviceUrl."treatyLossHistory/getAll";
$config['treatyLossHistory_update'] = $serviceUrl."treatyLossHistory/update";

$config['treatyLossHistory_view'] = $serviceUrl."treatyLossHistory/view";
$config['treatyLossHistory_listing_filter'] = $serviceUrl."treatyLossHistory/views";

// Treaty Slip Treaty Documents/Attachments
$config['treatyAttachments_create'] = $serviceUrl."treatyAttachments/create";
$config['treatyAttachments_delete'] = $serviceUrl."treatyAttachments/delete";
$config['treatyAttachments_listing'] = $serviceUrl."treatyAttachments/getAll";
$config['treatyAttachments_update'] = $serviceUrl."treatyAttachments/update";

$config['treatyAttachments_view'] = $serviceUrl."treatyAttachments/view";
$config['treatyAttachments_listing_filter'] = $serviceUrl."treatyAttachments/views";

// Branch
$config['branch_create'] = $serviceUrl."branch/create";
$config['branch_delete'] = $serviceUrl."branch/delete";
$config['branch_listing'] = $serviceUrl."branch/getAll";
$config['branch_update'] = $serviceUrl."branch/update";
$config['branch_view'] = $serviceUrl."branch/view";
$config['branch_listing_filter'] = $serviceUrl."branch/views";

// Company
$config['company_create'] = $serviceUrl."company/create";
$config['company_delete'] = $serviceUrl."company/delete";
$config['company_listing'] = $serviceUrl."company/getAll";
$config['company_update'] = $serviceUrl."company/update";
$config['company_view'] = $serviceUrl."company/view";
$config['company_listing_filter'] = $serviceUrl."company/views";

// Broker
$config['broker_create'] = $serviceUrl."broker/create";
$config['broker_delete'] = $serviceUrl."broker/delete";
$config['broker_listing'] = $serviceUrl."broker/getAll";
$config['broker_update'] = $serviceUrl."broker/update";
$config['broker_view'] = $serviceUrl."broker/view";
$config['broker_listing_filter'] = $serviceUrl."broker/views";

// Department
$config['department_listing'] = $serviceUrl."department/views";
$config['department_create'] = $serviceUrl."department/create";
$config['department_delete'] = $serviceUrl."department/delete";
$config['department_view'] = $serviceUrl."department/view";
$config['department_update'] = $serviceUrl."department/update";

// Division
$config['division_listing'] = $serviceUrl."division/views";
$config['division_create'] = $serviceUrl."division/create";
$config['division_delete'] = $serviceUrl."division/delete";
$config['division_view'] = $serviceUrl."division/view";
$config['division_update'] = $serviceUrl."division/update";


// Location
$config['location_listing'] = $serviceUrl."location/views";
$config['location_create'] = $serviceUrl."location/create";
$config['location_delete'] = $serviceUrl."location/delete";
$config['location_view'] = $serviceUrl."location/view";
$config['location_update'] = $serviceUrl."location/update";


// Insured
$config['insured_listing'] = $serviceUrl."insured/views";
$config['insured_create'] = $serviceUrl."insured/create";
$config['insured_delete'] = $serviceUrl."insured/delete";
$config['insured_view'] = $serviceUrl."insured/view";
$config['insured_update'] = $serviceUrl."insured/update";


// Rate Type
$config['rateType_listing'] = $serviceUrl."rateType/views";
$config['rateType_create'] = $serviceUrl."rateType/create";
$config['rateType_delete'] = $serviceUrl."rateType/delete";
$config['rateType_view'] = $serviceUrl."rateType/view";
$config['rateType_update'] = $serviceUrl."rateType/update";
$config['rateType_getAll'] = $serviceUrl."rateType/getAll";


// Charging Item
$config['chargingItem_listing'] = $serviceUrl."chargingItem/views";
$config['chargingItem_create'] = $serviceUrl."chargingItem/create";
$config['chargingItem_delete'] = $serviceUrl."chargingItem/delete";
$config['chargingItem_view'] = $serviceUrl."chargingItem/view";
$config['chargingItem_update'] = $serviceUrl."chargingItem/update";

// Screen
$config['Screen_listing'] = $serviceUrl."screen/views";
$config['Screen_create'] = $serviceUrl."screen/create";
$config['Screen_delete'] = $serviceUrl."screen/delete";
$config['Screen_view'] = $serviceUrl."screen/view";
$config['Screen_update'] = $serviceUrl."screen/update";
$config['Screen_getAll'] = $serviceUrl."screen/getAll";

// Charging Head
$config['chargingHead_listing'] = $serviceUrl."chargingHead/views";
$config['chargingHead_create'] = $serviceUrl."chargingHead/create";
$config['chargingHead_delete'] = $serviceUrl."chargingHead/delete";
$config['chargingHead_view'] = $serviceUrl."chargingHead/view";
$config['chargingHead_update'] = $serviceUrl."chargingHead/update";
$config['chargingHead_getAll'] = $serviceUrl."chargingHead/getAll";

// Permission
$config['permission_create'] = $serviceUrl."permission/create";
$config['permission_delete'] = $serviceUrl."permission/delete";
$config['permission_listing'] = $serviceUrl."permission/getAll";
$config['permission_update'] = $serviceUrl."permission/update";
$config['permission_view'] = $serviceUrl."permission/view";
$config['permission_listing_filter'] = $serviceUrl."permission/views";
$config['permission_ByModule'] = $serviceUrl."permission/getPermissionsByModules";



// Work flow
$config['workflow_create'] = $serviceUrl."workFlow/create";
$config['workflow_delete'] = $serviceUrl."workFlow/delete";
$config['workflow_listing'] = $serviceUrl."workFlow/getAll";
$config['workflow_update'] = $serviceUrl."workFlow/update";
$config['workflow_view'] = $serviceUrl."workFlow/view";
$config['workflow_listing_filter'] = $serviceUrl."workFlow/views";

// Work flow Names
$config['workFlowNames_create'] = $serviceUrl."workFlowNames/create";
$config['workFlowNames_delete'] = $serviceUrl."workFlowNames/delete";
$config['workFlowNames_listing'] = $serviceUrl."workFlowNames/getAll";
$config['workFlowNames_update'] = $serviceUrl."workFlowNames/update";
$config['workFlowNames_view'] = $serviceUrl."workFlowNames/view";
$config['workFlowNames_listing_filter'] = $serviceUrl."workFlowNames/views";


// condition reference
$config['conditionreference_create'] = $serviceUrl."conditionReference/create";
$config['conditionreference_delete'] = $serviceUrl."conditionReference/delete";
$config['conditionreference_listing_filter'] = $serviceUrl."conditionReference/views";
$config['conditionreference_update'] = $serviceUrl."conditionReference/update";
$config['conditionreference_view'] = $serviceUrl."conditionReference/view";
$config['conditionreference_getAll'] = $serviceUrl."conditionReference/getAll";
$config['conditionreference_view_by_ref'] = $serviceUrl."conditionReference/viewByReference";


// Payment Terms General
$config['paymentTermGeneral_create'] = $serviceUrl."paymentTermRangeWithGeneral/create";
$config['paymentTermGeneral_update'] = $serviceUrl."paymentTermRangeWithGeneral/update";
$config['paymentTermGeneral_deleteAllByTreatySlipGeneralId'] = $serviceUrl."paymentTermRangeWithGeneral/deleteByTreatySlipGeneralId/";

// Payment Terms Layer
$config['paymentTermLayer_create'] = $serviceUrl."paymentTermRangeWithLayer/create";
$config['paymentTermLayer_update'] = $serviceUrl."paymentTermRangeWithLayer/update";


// TreatySlip General
$config['treatySlipGeneral_create'] = $serviceUrl."treatySlipGeneral/create";
$config['treatySlipGeneral_update'] = $serviceUrl."treatySlipGeneral/update";
$config['treatySlipGeneral_view'] = $serviceUrl."treatySlipGeneral/view";
$config['treatySlipGeneral_get_with_filters'] = $serviceUrl."treatySlipGeneral/getAllWithFilters";

// TreatySlip Layer
$config['treatySlipLayer_create'] = $serviceUrl."treatySlipLayer/create";
$config['treatySlipLayer_view'] = $serviceUrl."treatySlipLayer/view";
$config['treatySlipLayer_update'] = $serviceUrl."treatySlipLayer/update";
$config['treatySlipLayer_delete'] = $serviceUrl."treatySlipLayer/delete";
$config['treatySlipLayer_deletePaymentTermByLayer'] = $serviceUrl."treatySlipLayer/deletePaymentTermByLayerId/";
$config['treatySlipLayer_deleteLayerMndpByLayer'] = $serviceUrl."treatySlipLayer/deleteLayerMndpByLayerId/";
$config['treatySlipLayer_deleteLayerPrcShareByLayer'] = $serviceUrl."treatySlipLayer/deleteLayerPrcShareByLayerId/";

// TreatySlip Layer Re Reinstatement
$config['treatySlipLayerReInstatement_create'] = $serviceUrl."LayerReInstatement/create";
$config['treatySlipLayerReInstatement_view'] = $serviceUrl."LayerReInstatement/view";
$config['treatySlipLayerReInstatement_update'] = $serviceUrl."LayerReInstatement/update";
$config['treatySlipLayerReInstatement_delete'] = $serviceUrl."LayerReInstatement/delete";

// TreatySlip Layer Prc Share
$config['treatySlipLayerPrcShare_create'] = $serviceUrl."layerPrcShare/create";
$config['treatySlipLayerPrcShare_view'] = $serviceUrl."layerPrcShare/view";
$config['treatySlipLayerPrcShare_update'] = $serviceUrl."layerPrcShare/update";
$config['treatySlipLayerPrcShare_delete'] = $serviceUrl."layerPrcShare/delete";


// TreatySlip Layer MNDP
$config['treatySlipLayerMndp_create'] = $serviceUrl."layerMndp/create";
$config['treatySlipLayerMndp_view'] = $serviceUrl."layerMndp/view";
$config['treatySlipLayerMndp_update'] = $serviceUrl."layerMndp/update";
$config['treatySlipLayerMndp_delete'] = $serviceUrl."layerMndp/delete";


// TreatySlip Section
$config['treatySlipSection_create'] = $serviceUrl."treatySection/create";
$config['treatySlipSection_view'] = $serviceUrl."treatySection/view";
$config['treatySlipSection_update'] = $serviceUrl."treatySection/update";
$config['treatySlipSection_delete'] = $serviceUrl."treatySection/delete";

// TreatySlip Section Classes
$config['treatySlipSectionClass_create'] = $serviceUrl."sectionClass/create";
$config['treatySlipSectionClass_view'] = $serviceUrl."sectionClass/view";
$config['treatySlipSectionClass_update'] = $serviceUrl."sectionClass/update";
$config['treatySlipSectionClass_delete'] = $serviceUrl."sectionClass/delete";

// Treaty Slip Rewal
$config['Renewal_create'] = $serviceUrl."treatier/createRenewal";
$config['Renewal_view'] = $serviceUrl."treatier/viewRenewal";

// Server Side Dynamic Pagination Html
$config['pagination_configs'] = array('full_tag_open' => '<ul class="pagination" style="margin: 10px 10px 10px 10px;">',
    'full_tag_close'  => '</ul>',
    'first_link'  => false,
    'last_link'  => false,
    'first_tag_open'  => '<li class="page-item">',
    'first_tag_close'  => '</li>',
    'prev_link'  => '&laquo',
    'prev_tag_open'  => '<li class="page-item prev">',
    'prev_tag_close'  => '</li>',
    'next_link'  => '&raquo',
    'next_tag_open'  => '<li class="page-item">',
    'next_tag_close'  => '</li>',
    'last_tag_open'  => '<li class="page-item">',
    'last_tag_close'  => '</li>',
    'cur_tag_open'  => '<li class="page-item active"><a class="page-link">',
    'cur_tag_close'  => '</a></li>',
    'num_tag_open'  => '<li class="page-item">',
    'num_tag_close'  => '</li>',
    'per_page'=>5,
    'total_rows'=>0,
    'use_page_numbers' =>false,
    'base_url' =>0);


//Sliding Scale
$config['slidingScale_conditions'] = array("GREATERTHAN"=>">","LESSTHAN"=>"<","EQUAL"=>"=");
$config['treatySlipSlidingScale_create'] = $serviceUrl."slidingScale/create";
$config['treatySlipSlidingScale_view'] = $serviceUrl."slidingScale/view";
$config['treatySlipSlidingScale_update'] = $serviceUrl."slidingScale/update";
$config['treatySlipSlidingScale_delete'] = $serviceUrl."slidingScale/delete";

// Template
$config['template_listing_filter'] = $serviceUrl."template/views";
$config['template_create'] = $serviceUrl."template/create";
$config['template_delete'] = $serviceUrl."template/delete";
$config['template_view'] = $serviceUrl."template/view";
$config['template_update'] = $serviceUrl."template/update";
$config['template_getAll'] = $serviceUrl."template/getAll";
// $config['noTemplateMessage'] = "Letter Template not found, Please ask system Admin to add template";
$config['defaultTemplatePath'] = "template/default_template";
$config['templateId'] = "MQ==";

$config['backend_date_format'] = 'm/d/Y';
$config['backend_datetime_format'] = 'm/d/Y h:i:s a';
$config['frontend_date_format'] = 'd/m/Y';

//Account Rendering
$config['accountRendering_create'] = $serviceUrl."accountRendering/create";
$config['accountRendering_update'] = $serviceUrl."accountRendering/update";
$config['accountRendering_view'] = $serviceUrl."accountRendering/view";
$config['accountRendering_listing'] = $serviceUrl."accountRendering/views";
$config['accountRendering_singleCreate'] = $serviceUrl."accountRendering/singleCreate";
$config['accountRendering_singleUpdate'] = $serviceUrl."accountRendering/singleUpdate";
$config['accountRendering_delete'] = $serviceUrl."accountRendering/delete";
$config['accountRendering_getAllByTreatierId'] = $serviceUrl."accountRendering/getAllByTreatierId";

$config['arTreatyType'] = [
	'' 	=> 'Please select Treaty Type',
	'p' => 'Proportional',
	'n' => 'Non-Proportional',
];
$config['arType'] = [
	'a' => 'Auto',
	'm' => 'Manual',
	'r' => 'Reversal',
];
$config['arDebitCredit'] = [ 
	// this field is based on Balance field which if +ve then d else c
	'' => 'Please select Dr/Cr',
	'd' => 'Dr',
	'c' => 'Cr',
];

//RMS Insured
$config['rmsInsured_getAllForCombo'] = $serviceUrl."rmsInsured/getAllForCombo";

// Bordu Ex Dropdowns Configs
$config['borduexOptions'] = [
	// Losses Paid Options
	'Select Bordereaux',
	'lossesPaidFire' 		=> 'Loses Paid Fire',
	'lossesPaidEngineering' => 'Loses Paid Engineering',
	'lossesPaidBond' 		=> 'Loses Paid Bond',
	'lossesPaidAccident' 	=> 'Loses Paid Accident',
	'lossesPaidMarineCargo' => 'Loses Paid Marine Cargo',
	'lossesPaidMarineHull' 	=> 'Loses Paid Marine Hull',
	// Premium Options
	'premiumFire' 			=> 'Premium Fire',
	'bondPremium' 			=> 'Bond Premium',
	'premiumAccident' 		=> 'Premium Accident',
	'premiumEngineering' 	=> 'Premium Engineering',
	'premiumMarineCargo' 	=> 'Premium Marine Cargo',
	'premiumMarineHull'		=> 'Premium Marine Hull',
	
];

$config['borduexQuarterOptions'] = [
	'' 	=> 'Select Quarter',
	'1' => '1st Quarter',
	'2' => '2nd Quarter',
	'3' => '3rd Quarter',
	'4' => '4th Quarter',
];

// lossesPaidFire
$config['lossesPaidFire_create'] = $serviceUrl."lossesPaidFire/create";
$config['lossesPaidFire_delete'] = $serviceUrl."lossesPaidFire/delete";
$config['lossesPaidFire_listing'] = $serviceUrl."lossesPaidFire/getAll";
$config['lossesPaidFire_update'] = $serviceUrl."lossesPaidFire/update";
$config['lossesPaidFire_view'] = $serviceUrl."lossesPaidFire/view";
$config['lossesPaidFire_listing_filter'] = $serviceUrl."lossesPaidFire/views";

// lossesPaidEngineering
$config['lossesPaidEngineering_create'] = $serviceUrl."lossesPaidEngineering/create";
$config['lossesPaidEngineering_delete'] = $serviceUrl."lossesPaidEngineering/delete";
$config['lossesPaidEngineering_listing'] = $serviceUrl."lossesPaidEngineering/getAll";
$config['lossesPaidEngineering_update'] = $serviceUrl."lossesPaidEngineering/update";
$config['lossesPaidEngineering_view'] = $serviceUrl."lossesPaidEngineering/view";
$config['lossesPaidEngineering_listing_filter'] = $serviceUrl."lossesPaidEngineering/views";

// lossesPaidBond
$config['lossesPaidBond_create'] = $serviceUrl."lossesPaidBond/create";
$config['lossesPaidBond_delete'] = $serviceUrl."lossesPaidBond/delete";
$config['lossesPaidBond_listing'] = $serviceUrl."lossesPaidBond/getAll";
$config['lossesPaidBond_update'] = $serviceUrl."lossesPaidBond/update";
$config['lossesPaidBond_view'] = $serviceUrl."lossesPaidBond/view";
$config['lossesPaidBond_listing_filter'] = $serviceUrl."lossesPaidBond/views";

// lossesPaidAccident
$config['lossesPaidAccident_create'] = $serviceUrl."lossesPaidAccident/create";
$config['lossesPaidAccident_delete'] = $serviceUrl."lossesPaidAccident/delete";
$config['lossesPaidAccident_listing'] = $serviceUrl."lossesPaidAccident/getAll";
$config['lossesPaidAccident_update'] = $serviceUrl."lossesPaidAccident/update";
$config['lossesPaidAccident_view'] = $serviceUrl."lossesPaidAccident/view";
$config['lossesPaidAccident_listing_filter'] = $serviceUrl."lossesPaidAccident/views";

// lossesPaidMarineCargo
$config['lossesPaidMarineCargo_create'] = $serviceUrl."lossesPaidMarineCargo/create";
$config['lossesPaidMarineCargo_delete'] = $serviceUrl."lossesPaidMarineCargo/delete";
$config['lossesPaidMarineCargo_listing'] = $serviceUrl."lossesPaidMarineCargo/getAll";
$config['lossesPaidMarineCargo_update'] = $serviceUrl."lossesPaidMarineCargo/update";
$config['lossesPaidMarineCargo_view'] = $serviceUrl."lossesPaidMarineCargo/view";
$config['lossesPaidMarineCargo_listing_filter'] = $serviceUrl."lossesPaidMarineCargo/views";

// lossesPaidMarineHull
$config['lossesPaidMarineHull_create'] = $serviceUrl."lossesPaidMarineHull/create";
$config['lossesPaidMarineHull_delete'] = $serviceUrl."lossesPaidMarineHull/delete";
$config['lossesPaidMarineHull_listing'] = $serviceUrl."lossesPaidMarineHull/getAll";
$config['lossesPaidMarineHull_update'] = $serviceUrl."lossesPaidMarineHull/update";
$config['lossesPaidMarineHull_view'] = $serviceUrl."lossesPaidMarineHull/view";
$config['lossesPaidMarineHull_listing_filter'] = $serviceUrl."lossesPaidMarineHull/views";

// premiumFire
$config['premiumFire_create'] = $serviceUrl."premiumFire/create";
$config['premiumFire_delete'] = $serviceUrl."premiumFire/delete";
$config['premiumFire_listing'] = $serviceUrl."premiumFire/getAll";
$config['premiumFire_update'] = $serviceUrl."premiumFire/update";
$config['premiumFire_view'] = $serviceUrl."premiumFire/view";
$config['premiumFire_listing_filter'] = $serviceUrl."premiumFire/views";

// bondPremium
$config['bondPremium_create'] = $serviceUrl."bondPremium/create";
$config['bondPremium_delete'] = $serviceUrl."bondPremium/delete";
$config['bondPremium_listing'] = $serviceUrl."bondPremium/getAll";
$config['bondPremium_update'] = $serviceUrl."bondPremium/update";
$config['bondPremium_view'] = $serviceUrl."bondPremium/view";
$config['bondPremium_listing_filter'] = $serviceUrl."bondPremium/views";

// premiumAccident
$config['premiumAccident_create'] = $serviceUrl."premiumAccident/create";
$config['premiumAccident_delete'] = $serviceUrl."premiumAccident/delete";
$config['premiumAccident_listing'] = $serviceUrl."premiumAccident/getAll";
$config['premiumAccident_update'] = $serviceUrl."premiumAccident/update";
$config['premiumAccident_view'] = $serviceUrl."premiumAccident/view";
$config['premiumAccident_listing_filter'] = $serviceUrl."premiumAccident/views";

// premiumEngineering
$config['premiumEngineering_create'] = $serviceUrl."premiumEngineering/create";
$config['premiumEngineering_delete'] = $serviceUrl."premiumEngineering/delete";
$config['premiumEngineering_listing'] = $serviceUrl."premiumEngineering/getAll";
$config['premiumEngineering_update'] = $serviceUrl."premiumEngineering/update";
$config['premiumEngineering_view'] = $serviceUrl."premiumEngineering/view";
$config['premiumEngineering_listing_filter'] = $serviceUrl."premiumEngineering/views";

// premiumMarineCargo
$config['premiumMarineCargo_create'] = $serviceUrl."premiumMarineCargo/create";
$config['premiumMarineCargo_delete'] = $serviceUrl."premiumMarineCargo/delete";
$config['premiumMarineCargo_listing'] = $serviceUrl."premiumMarineCargo/getAll";
$config['premiumMarineCargo_update'] = $serviceUrl."premiumMarineCargo/update";
$config['premiumMarineCargo_view'] = $serviceUrl."premiumMarineCargo/view";
$config['premiumMarineCargo_listing_filter'] = $serviceUrl."premiumMarineCargo/views";

// premiumMarineHull
$config['premiumMarineHull_create'] = $serviceUrl."premiumMarineHull/create";
$config['premiumMarineHull_delete'] = $serviceUrl."premiumMarineHull/delete";
$config['premiumMarineHull_listing'] = $serviceUrl."premiumMarineHull/getAll";
$config['premiumMarineHull_update'] = $serviceUrl."premiumMarineHull/update";
$config['premiumMarineHull_view'] = $serviceUrl."premiumMarineHull/view";
$config['premiumMarineHull_listing_filter'] = $serviceUrl."premiumMarineHull/views";

//Leader Follower
$config['leaderFollower_create'] = $serviceUrl."leaderFollower/create";
$config['leaderFollower_update'] = $serviceUrl."leaderFollower/update";
$config['leaderFollower_getAll'] = $serviceUrl."leaderFollower/getAll";
$config['leaderFollower_delete'] = $serviceUrl."leaderFollower/delete";
$config['leaderFollower_view'] = $serviceUrl."leaderFollower/view";
$config['leaderFollower_views'] = $serviceUrl."leaderFollower/views";


// Risk Covered
$config['riskCovered_create'] = $serviceUrl."riskCovered/create";
$config['riskCovered_singleCreate'] = $serviceUrl."riskCovered/singleCreate";
$config['riskCovered_delete'] = $serviceUrl."riskCovered/delete";
$config['riskCovered_listing'] = $serviceUrl."riskCovered/getAll";
$config['riskCovered_update'] = $serviceUrl."riskCovered/update";
$config['riskCovered_view'] = $serviceUrl."riskCovered/view";
$config['riskCovered_listing_filter'] = $serviceUrl."riskCovered/views";



// Facultative General
$config['facultative_General_listing'] = $serviceUrl."facGeneral/views";
$config['facultative_General_create'] = $serviceUrl."facGeneral/create";
$config['facultative_General_delete'] = $serviceUrl."facGeneral/delete";
$config['facultative_General_view'] = $serviceUrl."facGeneral/view";
$config['facultative_General_update'] = $serviceUrl."facGeneral/update";
$config['facultative_General_getAll'] = $serviceUrl."facGeneral/getAll";

// Facultative Co-Insured
$config['facultative_CoInsurer_listing'] = $serviceUrl."facCoInsurer/views";
$config['facultative_CoInsurer_create'] = $serviceUrl."facCoInsurer/create";
$config['facultative_CoInsurer_delete'] = $serviceUrl."facCoInsurer/delete";
$config['facultative_CoInsurer_view'] = $serviceUrl."facCoInsurer/view";
$config['facultative_CoInsurer_update'] = $serviceUrl."facCoInsurer/update";
$config['facultative_CoInsurer_getAll'] = $serviceUrl."facCoInsurer/getAll";

// Facultative Business Offered & Acceptance
$config['facultative_BusinessOfferedAcceptance_listing'] = $serviceUrl."facBusinessOfferedAcceptance/views";
$config['facultative_BusinessOfferedAcceptance_create'] = $serviceUrl."facBusinessOfferedAcceptance/create";
$config['facultative_BusinessOfferedAcceptance_delete'] = $serviceUrl."facBusinessOfferedAcceptance/delete";
$config['facultative_BusinessOfferedAcceptance_view'] = $serviceUrl."facBusinessOfferedAcceptance/view";
$config['facultative_BusinessOfferedAcceptance_update'] = $serviceUrl."facBusinessOfferedAcceptance/update";
$config['facultative_BusinessOfferedAcceptance_getAll'] = $serviceUrl."facBusinessOfferedAcceptance/getAll";

// Facultative RI Commission %
$config['facultative_RiCommission_listing'] = $serviceUrl."facRiCommission/views";
$config['facultative_RiCommission_create'] = $serviceUrl."facRiCommission/create";
$config['facultative_RiCommission_delete'] = $serviceUrl."facRiCommission/delete";
$config['facultative_RiCommission_view'] = $serviceUrl."facRiCommission/view";
$config['facultative_RiCommission_update'] = $serviceUrl."facRiCommission/update";
$config['facultative_RiCommission_getAll'] = $serviceUrl."facRiCommission/getAll";

// Facultative RI Commission %
$config['facultative_AdjustedSumInsured_listing'] = $serviceUrl."facAdjustedSumInsured/views";
$config['facultative_AdjustedSumInsured_create'] = $serviceUrl."facAdjustedSumInsured/create";
$config['facultative_AdjustedSumInsured_delete'] = $serviceUrl."facAdjustedSumInsured/delete";
$config['facultative_AdjustedSumInsured_view'] = $serviceUrl."facAdjustedSumInsured/view";
$config['facultative_AdjustedSumInsured_update'] = $serviceUrl."facAdjustedSumInsured/update";
$config['facultative_AdjustedSumInsured_getAll'] = $serviceUrl."facAdjustedSumInsured/getAll";

//Facultative Deductables
$config['facDeductables_listing'] = $serviceUrl."facDeductables/views";
$config['facDeductables_create'] = $serviceUrl."facDeductables/create";
$config['facDeductables_delete'] = $serviceUrl."facDeductables/delete";
$config['facDeductables_view'] = $serviceUrl."facDeductables/view";
$config['facDeductables_update'] = $serviceUrl."facDeductables/update";
$config['facDeductables_getAll'] = $serviceUrl."facDeductables/getAll";

//  deductables
$config['deductables_listing'] = $serviceUrl."deductables/views";
$config['deductables_create'] = $serviceUrl."deductables/create";
$config['deductables_delete'] = $serviceUrl."deductables/delete";
$config['deductables_view'] = $serviceUrl."deductables/view";
$config['deductables_update'] = $serviceUrl."deductables/update";
$config['deductables_getAll'] = $serviceUrl."deductables/getAll";


/*
 *
 * DYNAMIC FILTER SERVICE
 *
*/
$config['common'] = $serviceUrl."common/views";


// Treaty status
$config['treatyStatusOptions'] = [
	// '' => 'Select Treaty Status',
	'ini' => 'Initiated',
	'rev' => 'Reviewed',
	'appr' => 'Approved',
	'regr' => 'Regreted',
	'comp' => 'Completed',
	'set' => 'Settled',
	'disc' => 'Discontinued',
	'exp' => 'Expired',
	'can' => 'Cancelled',
	'term' => 'Terminated',
];



// UW Status Options
$config['uwStatusOptions'] = [
	// '' => 'Select UW Status',
	'pend' => 'Pending',
	'rev' => 'Reviewed',
	'aud' => 'Audited',
	'appr' => 'Approved',
	'regr' => 'Regreted',
	'comp' => 'Completed',
	'set' => 'Settled',
	'canc' => 'Cancelled',
];

// Assign to Options
$config['assignToOptions'] = [
	// '' => 'Select Assign to',
	'jr_off' => 'Junior Officer (Accident)',
	'am' => 'AM (Accident)',
	'dm_uw' => 'DM Underwriting',
	'exe_dir' => 'Executive Director',
	'ass_mng_tw' => 'Assistant Manager TW',
	'deputy_mng' => 'Deputy Manager (Accounts TW)',
	'ass_mng_ia' => 'Assistant Manager (I/A)',
	'mng_ia' => 'Manager (Internal Audit)',
	'cia' => 'Chief Internal Officer',
	'mng_retro' => 'Manager Retrocession',
	'chairman_ceo' => 'Chairman/CEO',
];

// UW Type Options
$config['uwTypeOptions'] = [
	// '' => 'Select UW Type',
	'prov' => 'Provisional',
	'final' => 'Final',
];

// Is Preapproved Options
$config['isPreapprovedOptions'] = [
	// '' => 'Select Is Preapproved',
	'y' => 'Yes',
	'n' => 'No',
];


/* listing config*/

$config['listing']['sortBy'] = 'id';
$config['listing']['direction'] = 'DESC';
$config['listing']['itemsPerPages'] = '10';



/*
 *
 * FiltersWork:START
 *
*/

	/* filter config */
	$config['listingFilter'] = $serviceUrl."common/views";

	/* stats filters */
	$config['filters']['statistics'][] = array('name'=>'treatyStatisticsNo','label'=>'STATISTICS ID');
	$config['filters']['statistics'][] = array('name'=>'cedentName','label'=>'CEDENT NAME');
    $config['filters']['statistics'][] = array('name'=>'cedentCode','label'=>'CEDENT CODE');
	$config['filters']['statistics'][] = array('name'=>'currentYear','label'=>'YEAR'); 
	$config['filters']['statistics'][] = array('name'=>'businessName','label'=>'BUSINESS CLASS');
	$config['filters']['statistics'][] = array('name'=>'treatyType','label'=>'TREATY TYPE');
    $config['filters']['statistics'][] = array('name'=>'treatyCode','label'=>'TREATY CODE');


	/* sats filters */
	$config['filters']['treaty_details'][] = array('name'=>'agreementNumber','label'=>'AGREEMENT NO');
    $config['filters']['treaty_details'][] = array('name'=>'customerName','label'=>'CEDENT NAME');
	$config['filters']['treaty_details'][] = array('name'=>'bussinessName','label'=>'BUSINESS NAME');
	$config['filters']['treaty_details'][] = array('name'=>'treatyCategoryName','label'=>'TREATY CATEGORY NAME');
    $config['filters']['treaty_details'][] = array('name'=>'type','label'=>'TREATY TYPE NAME');

//	Treaty Entered
    $config['filters']['TreatyEntered'][] = array('name'=>'treatyName','label'=>'TREATY NAME');
	$config['filters']['TreatyEntered'][] = array('name'=>'cedentName','label'=>'CEDENT NAME');
	$config['filters']['TreatyEntered'][] = array('name'=>'businessName','label'=>'BUSINESS NAME');
	$config['filters']['TreatyEntered'][] = array('name'=>'treatyTypeName','label'=>'TREATY TYPE NAME');
	$config['filters']['TreatyEntered'][] = array('name'=>'treatyCategoryName','label'=>'TREATY CATEGORY NAME');

/*
 *
 * FiltersWork:END
 *
*/
