$(document).on('click','.add_treaty_detail',function(){
    var html = "";
    var currencyOptions = $('#currency').html();
    var treatyTypeOptions = $('.treatyTypeOptions').html();
    var treatyCodeOptions = $('.treatyCodeOptions').html();


    html += '<tr class="tableDetails">'+
          '<td scope="row"></td>'+

          // '<td><input type="text" class="form-control" name="treatyDetails[name][]" placeholder="e.g. Fire & General Accident Q/S & Surplus" ></td>'+
          
            '<td><select class="form-control selecct2 treatyTypeOptions" name="treatyDetails[treatyTypeDTO_id][]">'+treatyTypeOptions+'</select>'+
                '<input type="hidden" name="treatyDetails[name][]">'+
            '</td>'+
            '<td><select class="form-control selecct2 treatyCodeOptions" name="treatyDetails[treatierCode][]" readonly></select></td>'+

            '<td><input type="text" class="form-control decimal-numbers" name="treatyDetails[prePreviousShare][]" placeholder="e.g. 27.50%" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>'+
            '<td><input type="text" class="form-control decimal-numbers" name="treatyDetails[preProposedShare][]" placeholder="e.g. 50%" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>'+
            '<td><input type="text" class="form-control decimal-numbers" name="treatyDetails[preApprovedShare][]" placeholder="e.g. 35%" onkeypress="return event.charCode >= 48 && event.charCode <= 57"></td>'+
          '<td>'+
            '<select name="treatyDetails[currencyCode][]" class="form-control" data-placeholder="Currency">'+
                currencyOptions +
            '</select>'+
          '</td>'+
          //'<td><a href="javascript:void(0)" class="anchor" data-toggle="modal" class="stats-modal-btn" data-target=".stat-form">stats</a></td>'+
          '<td><a href="javascript:void(0)" class="anchor" data-toggle="modal" class="stats-modal-btn" data-target=".stat-form-1">stats</a></td>'+
          '<td><a href="javascript:void(0)" class="anchor" data-toggle="modal" data-target=".bd-example-modal-lg">View</a></td>'+
          '<td><input type="radio" name="" value="1"></td>'+
          '<td><input type="radio" name="" value="0"></td>'+
        '</tr>';

    $('#treaty_details').append(html);
    tableRowUnique();
});

function tableRowUnique() {
    $('.tableDetails').each(function(index) {
        newModal = '';
        var rowNum = index+1;
        // adding row number
        $(this).find('input[type=radio]').attr('name','treatyDetails[treatyStatus]['+index+']');
        $(this).find('td:nth-child(1)').html(rowNum);
        $(this).find('td:nth-child(2) select').addClass('treatyNameRow_'+index);
        $(this).find('td:nth-child(3) select').addClass('rowId_'+index);
     /*   
        // adding unique data-target id for different modal
        $(this).find('td:nth-child(7) a').attr('data-target','.stat-form-'+rowNum);

        // clowning modal
        var firstCopyModal = $('.stat-form-1').html();
        

        newModal += '<div class="modal fade stat-form-'+rowNum+'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow'+rowNum+'">';
        newModal += firstCopyModal;
        newModal +=+'</div>'; 

        $('#closemodal').click(function() {
          $('#modalwindow'+rowNum).modal('hide');
        });
        $('.statModals').append(newModal);

        $('.stat-form-'+rowNum).find('input[type=radio]').attr('name','treatyDetails[statisticsYear]['+index+']');*/
    });
}

function callPhpMethod($module,$method,$appendClassName,$prams='') {
        $.ajax({
            url: base_url + $module +'/'+$method,
            type: 'POST',
            data:{prams : $prams ,'action':SEGMENT_2,'view_from_agreement':'yes'},
            dataType: 'html',
            headers: {
                'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
            },
            success: function (response) {
                // clog(response.data);
                // $("input[name=csrf_test_name]").val(response.token);
                $('.'+$appendClassName).html(response);
            },
            error: function (r) {
                // $("input[name=csrf_test_name]").val(r.token);              
            }
        });
}

function getStatisticsTable($year) {
    callPhpMethod('statistics','statisticstable','statesFor5Year',$year);
}

function getCedents() {
    getOptions('getCedents','cedentOptions','Cedent');
}

function getTreatyTypes(appendClass='treatyTypeOptions') {
    getOptions('getTreatyTypes',appendClass,'Treaty Name');
}

function getTreatyCodes(treatyName='') {
    getOptions('getTreatyCodes','treatyCodeOptions','Treaty Code',treatyName);
}
// function getTreatyCodes2(treatyName='') {
//     getOptions('getTreatyCodes','treatyCodeOptions2','Treaty Code',treatyName);
// }
function getTreatyCategories() {
    getOptions('getTreatyCategories','treatyCategoryOptions','Treaty Category');
}

function getCurrencies() {
    getOptions('getCurrencies','currencyOptions','Currency');
}


function getStates(year='',cedent='',id='',pageOperation=''){
    $('.loader').show();
    var sUrl = base_url + $module +'/getStates';
    var data = {
      year    : year,
      cedent  : cedent,
      id      : id,
      page    : pageOperation,
    };
    $.ajax({
        url: sUrl,
        type: 'POST',
        data: data,
        dataType: 'html',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
            $("input[name=csrf_test_name]").val(response.token); // NEW
            $('#treatyStateRows').html(response);
            $('.loader').hide();
        },
        error: function (r) {
            $("input[name=csrf_test_name]").val(r.token); // NEW
        }
    });

}
$(document).ready(function () {
    var statsIdVal = $('.getStatsIdBtn').attr('data-id');
    var cedentId = '';

    getCedents();
    getTreatyCategories();
    getStates('','',statsIdVal,pageOperation);
    getCurrencies();


    $('.statisticsYear').on('change',function(){
        var statsYear = $(this).val();
        var cedentId = $('.cedentOptions').val();
        getStatisticsTable(statsYear);
        getStates(statsYear,cedentId,statsIdVal,pageOperation);
    });

    $('.cedentOptions').on('change', function () {
      var statsYear = $('.statisticsYear').val();
      var cedentId = $(this).val();
      getStatisticsTable(statsYear);
      getStates(statsYear,cedentId,statsIdVal,pageOperation);
    });
    if (pageOperation == 'edit' || pageOperation == 'view') {
        var statsIdVal = $('.getStatsIdBtn').attr('data-id');
        var statsYear = $('.statisticsYear').val();
        var cedentId = $('.cedentOptions').attr('data-select');
        getStatisticsTable(statsYear);
        getStates(statsYear,cedentId,statsIdVal,pageOperation);
        // setTimeout(function(args) {
        //     var statsYear = $('.statisticsYear').val();
        //     var cedentId = $('.cedentOptions').attr('data-select');
        //     getStates(statsYear,cedentId,statsIdVal,pageOperation);
        //     getStatisticsTable(statsYear);


        // }, 2000);
        // for (var i = 0; i < detailsCount; i++) {
        //     getTreatyTypes('treatyNameRow_'+i);
        //     getTreatyCodes(btoa('null|noClass_'+i));
        // }

    }else{
        getTreatyTypes();
        getTreatyCodes(btoa('null|noClass_0'));
    }
});

$(document).on('change','.treatyTypeOptions', function () {
    var treatyName = $(this).find(":selected").text();
    var treatyId = $(this).find(":selected").val();
    var classes = $(this).attr('class');
    var rowClass = classes.split(" ").slice(-1);
    $('.treatyCodeOptions').attr('data-select',treatyId);

    getTreatyCodes(btoa(treatyName+'|'+rowClass));

    $(this).next('input').val(treatyName);
});

// $(document).on('change','.treatyTypeOptions2', function () {

//     var treatyName = $(this).find(":selected").text();
//     var treatyId = $(this).find(":selected").val();
//     var classes = $(this).attr('class');
//     var rowClass = classes.split(" ").slice(-1);

//     $('.treatyCodeOptions2').attr('data-select',treatyId);

//     getTreatyCodes2(btoa(treatyName+'|'+rowClass));

//     $(this).next('input').val(treatyName);
// });

$('#wizard1').steps({
  headerTag: 'h3',
  bodyTag: 'section',
  autoFocus: true,
  titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
});
// Datepicker
$('.fc-datepicker-agreement').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true
});

$('.fc-datepicker-meeting').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true
});

$('#closemodal').click(function()
{
    var SelectedState = parseInt($("input[name='treatyDetails[statisticsId][]']:checked").val());
    if(SelectedState > 0)
    {
        $('#modalwindow1').modal('hide');
    }else{
        $("#error_msg").text("Please select a State")
    } 

});

$('#closemodal2').click(function() {
  $('#modalwindow2').modal('hide');
});

$.validator.addMethod('filesize', function (value, element, param) {
  clog(element.files[0]);
  return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0} mb');

jQuery(document).ready(function () {
   FormValidator_Fun.init();
});

function agreementConfirmation() {
    $('#confirmationModal_once').modal('show');
};

$(document).on('click','#confirmed',function () {
    agreementCreateUpdate();
    $('#confirmationModal_once').modal('hide');
});
function agreementCreateUpdate() {
   var url = base_url + $module + '/create';
   if($("#action").val() =='update')
   {
       var url = base_url + $module + '/edit';
   }

   var formData = new FormData(document.getElementById($module+'_form'));

    $(".create_"+$module).prop("disabled", true);
    $(".update_"+$module).prop("disabled", true);
   $.ajax({
       url: url,
       type: 'POST',
       data: formData,
       contentType: false,
       cache: false,
       processData:false,
       dataType: 'json',
       success: function (response)
       {
           $("input[name=csrf_test_name]").val(response.token); // NEW
           if (response.code == 1) {
               window.location.href = base_url + $module+'/';
           }else if(response.code == 0) {
               $(".h_heading").text(response.message);
               $('#modaldemo5').modal('show');
           }
           else {
               clog("Issue During Insertion: ");
               clog(response);
           }
            $(".create_"+$module).prop("disabled", false);
            $(".update_"+$module).prop("disabled", false);
       },
       error: function (r) {
           $("input[name=csrf_test_name]").val(r.token); // NEW
           clog(r);
           clog('Error in retrieving Site.');
       }
   });
}

// treaty Sliding Scale Form Validation
var FormValidator_Fun = function () {

   var AddRecordValidation = function () {
       var form1 = $('#'+$module+'_form');
       var errorHandler1 = $('.errorHandler', form1);
       var successHandler1 = $('.successHandler', form1);
       $('#'+$module+'_form').validate({
           errorElement: "span", // contain the error msg in a span tag
           errorClass: 'help-block',
           errorPlacement: function (error, element)
           {
               error.insertAfter(element);
           },
           ignore: "",
           rules: {
               'treatyAgreement[agreementDate]':{
                   required : true,
               },
               file: {
                    required : true,
                    extension: "png,PNG,docx,pdf,txt,xlsx,jpg,JPG,jpeg,JPEG",
                    filesize: 2000000,
               }
           },
           messages: {
           },
           invalidHandler: function (event, validator) { //display error alert on form submit
               successHandler1.hide();
               errorHandler1.show();
           },
           highlight: function (element) {
               $(element).closest('.help-block').removeClass('valid');
               $(element).closest('.form-validate').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
           },
           unhighlight: function (element) {
               $(element).closest('.form-validate').removeClass('has-error');
           },
           success: function (label, element) {
               label.addClass('help-block valid');
               $(element).closest('.form-validate').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
           },
           submitHandler: function (form)
           {
               successHandler1.show();
               errorHandler1.hide();

                // agreementCreateUpdate();
                agreementConfirmation();

               return false;
           }
       });

   };
   return {
       init: function () {
           AddRecordValidation();
       }
   };
}();

if (pageOperation == 'view') {
    $(document).ready(function () {
        $('input[type=radio]').attr('disabled',true);
    });
}


function getCodes(id,$this) {
    var optClass = '2rowId_'+id;
    var treatyName = $this.find(":selected").text();
    var params = btoa(treatyName+'|'+optClass);
    getOptions('getTreatyCodes', optClass,'',params);
}




