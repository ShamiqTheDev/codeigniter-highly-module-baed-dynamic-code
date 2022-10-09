function getCedentOptions() {
	getOptions('get','cedentOptions','Cedent','','Cedent');
}

function getTreatyTypeOptions() {
    getOptions('get','treatyTypeOptions','Treaty Type','','TreatyType');
}

function getTreatyCategoriesOptions() {
    getOptions('get','treatyCategoryOptions','Treaty Category','','TreatyCategory');
}

function getBusinessOptions() {
    getOptions('getBusiness','getBusinessOptions','Business Class','','Business');
}

function getSubBusinessOptions(businessId) {
    getOptions('getBusiness','getSubBusinessOptions','Sub Business Class',btoa(businessId),'Business');
}

$(document).ready(function () {
	getCedentOptions();
	getTreatyTypeOptions();
	getTreatyCategoriesOptions();
	getBusinessOptions();

    var businessId = $('.getBusinessOptions').attr('data-select');
    getSubBusinessOptions(businessId);


    $('.getBusinessOptions').on('change',function(){
        var businessId = $('.getBusinessOptions').val();
        getSubBusinessOptions(businessId);
    });

});

// Datepicker
$('.fc-datepicker').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true
});
