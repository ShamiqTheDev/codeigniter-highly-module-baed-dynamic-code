function getRoleOptions() {
	getOptions('get','roleOptions','Role','','Role');
}
function getModuleOptions() {
	getOptions('get','moduleOptions','Module','','Module');
}
function getCurrencyOptions() {
	getOptions('get','currencyOptions','Currency','','Currency');
}
function getBusiness(){
    getOptions('getBusiness','getBusinessOptions','Business Class','','Business');
}
function getSubBusiness(businessId){
    getOptions('getBusiness','getSubBusinessOptions','Sub Business Class',btoa(businessId),'Business');
}

function getWorkFlowNames(){
    getOptions('get','getWorkFlowNamesOptions','Work Flow Names','','WorkFlowNames');
}


$(document).ready(function () {
    getWorkFlowNames();
	getModuleOptions();
	getRoleOptions();
	getCurrencyOptions();

	/* BUSINESS dropdown WORK START*/
    getBusiness();
    var businessId = $('.getBusinessOptions').attr('data-select');
    if (businessId != '') {
	    getSubBusiness(businessId);
    }

    $('.getBusinessOptions').on('change',function(){
        var businessId = $('.getBusinessOptions').val();
        getSubBusiness(businessId);
    });


});