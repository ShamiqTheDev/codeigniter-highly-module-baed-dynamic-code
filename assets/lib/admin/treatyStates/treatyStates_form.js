// var $module = 'treatyStates';// before it was dynamic creating from class name but in lower case will find out a solution for it
console.log("Token: " + $('input[name="csrf_test_name"]').attr('value'));
function getCedents() {
    getOptions('getCedents','cedentOptions','Cedent');
}

function getTreatyTypes(){
    // getOptions('getTreatyTypes','treatyTypeOptions','Treaty Type');
    getOptions('get','treatyTypeOptions','Treaty Type','','treatyType');
}

function getTreatyCategories(){
    getOptions('getTreatyCategories','treatyCategoryOptions','Treaty Category');
}

function getBusiness(){
    getOptions('getBusiness','getBusinessOptions','Business Class');
}

function getSubBusiness(businessId){
    getOptions('getBusiness','getSubBusinessOptions','Sub Business Class',btoa(businessId));
}


function callPhpMethod($module,$method,$appendClassName,$param='') {
        $.ajax({
        url: base_url + $module +'/'+$method+'/'+$param,
        type: 'POST',
        dataType: 'html',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
            // console.log(response.data);
            // $("input[name=csrf_test_name]").val(response.token);              

            $('.'+$appendClassName).html(response);
        },
        error: function (r) {
            // $("input[name=csrf_test_name]").val(r.token);              
        }
    });
}


function getTreatyStatesTable($year) {
    callPhpMethod($module,'treatyStatesTable','ajaxAppend',$year);
}

$(document).ready(function () {
    getCedents();
    getTreatyTypes();
    getTreatyCategories();
    getBusiness();
    
    var businessId = $('.getBusinessOptions').attr('data-select');
    getSubBusiness(businessId);

    $('.getBusinessOptions').on('change',function(){
        var businessId = $('.getBusinessOptions').val();
        getSubBusiness(businessId);
    });

    var treatyYear = $('.treatyYear').val();
    if (treatyYear > 0) {
        callPhpMethod($module,'treatyStatesTable','treatyStatesTable',treatyYear);
    }

    $('.treatyYear').on('change',function(){
        getTreatyStatesTable($(this).val());
    });

});

// Datepicker
$('.fc-datepicker').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true
});



