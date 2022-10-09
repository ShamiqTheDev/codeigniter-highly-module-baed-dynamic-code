console.log("Token: " + $('input[name="csrf_test_name"]').attr('value'));
function getCedents() {
    getOptions('getCedents','cedentOptions','Cedent');
}

function getTreatyTypes(){
    getOptions('get','treatyTypeOptions','Treaty Type','','treatyType');
}

function getTreatyCategories(){
    getOptions('get','treatyCategoryOptions','Treaty Category','','treatyCategory');
}

function getBusiness(){
    getOptions('getBusiness','getBusinessOptions','Business Class');
}

function getSubBusiness(businessId){
    getOptions('getBusiness','getSubBusinessOptions','Sub Business Class',btoa(businessId));
}


function callPhpMethod($module,$method,$appendClassName,$param='')
{
        $.ajax({
        url: base_url + $module +'/'+$method,
        type: 'POST',
        data:{prams : $param,'action':SEGMENT_2,'view_from_agreement':'no'},
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


function statisticsTable($year) {
    callPhpMethod($module,'statisticsTable','ajaxAppend',$year);
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
    if (treatyYear > 0)
    {
        if(pageAction == 'view')
        {
            callPhpMethod($module,'statisticsTable','treatyStatesTable',treatyYear);

        }else{

            getFilteredStatesTable('-0');
        }

    }
    // if (SEGMENT_2 == 'view') {
    //     getFilteredStatesTable();
    // }

    $('.cedentOptions').on('change',function() {
        getFilteredStatesTable();
    });
    $('.treatyYear').on('change',function() {
        getFilteredStatesTable();
    });
    $('.getBusinessOptions').on('change',function() {
        getFilteredStatesTable();
    });



});
function getFilteredStatesTable(showTableFormate = '-0') {

        var edit = false;
        if (SEGMENT_2 == 'edit') {
            edit = true;
        }

        var treatyYear = $('.treatyYear').val();
        var cedentIdVal = edit?$('.cedentOptions').attr('data-select'):$('.cedentOptions').val();
        var businessIdVal = edit?$('.getBusinessOptions').attr('data-select'):$('.getBusinessOptions').val();
        treatyYear = treatyYear?treatyYear:'';
        cedentId = cedentIdVal?'-'+cedentIdVal:'';
        businessId = businessIdVal?'-'+businessIdVal:'';
        
       if (treatyYear && cedentId && businessId) {
            var dashedSaparatedPrams = treatyYear+showTableFormate+cedentId+businessId;
            statisticsTable(dashedSaparatedPrams);
       }


}
$(document).on('click','#calculate',function (e) {
    e.preventDefault();
    $('#'+$module+'_form').submit();
});
// Datepicker
$('.fc-datepicker').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true
});

// Stats create filter for table

// var treatyYear = $('.treatyYear').val();
// var cedentIdVal = $('.cedentOptions').val();
// var businessIdVal = $('.getBusinessOptions').val();

// if (treatyYear && cedentIdVal && businessIdVal) {
//     $('.getStats').prop("disabled", false);
// } else {
//     $('.getStats').prop("disabled", true);
// }

// $(document).on('click','.getStats', function (e) {
//     e.preventDefault();
//     alert('clicked');

// });



