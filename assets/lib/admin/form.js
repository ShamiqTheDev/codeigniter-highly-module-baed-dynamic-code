$(".create_"+$module).click(function (e) {
    e.preventDefault();
    $('#'+$module+'_form').submit();
});



function createUpdateDataAjax() {
    $(".create_"+$module).prop("disabled", true);
    $(".update_"+$module).prop("disabled", true);
    $.ajax({
        url: $('#'+ $module+'_form').attr('action'),
        type: 'POST',
        data: new FormData(document.getElementById($module+'_form')),

        contentType: false,
        cache: false,
        processData:false,
        
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response)
        {
            $("input[name=csrf_test_name]").val(response.token); // NEW
             var response = response.data;
            if (response.code == 1) {
                $('input[name="csrf_test_name"]').attr('value')
                if ($module == 'statistics')
                {
                    window.location.replace(response.path);
                } 
                else if ($module == 'accountRendering') {
                    updateRowsAccRend();
                    resetFormSpecificAccRend();
                }
                else if ($module == 'workflow') {
                    // window.location.href = base_url + SEGMENT_1 + '/index/' + SEGMENT_4;
                    window.location.href = work_flow_index_url;
                } 
                else {
                    window.location.href = base_url+SEGMENT_1;
                }
            }else if(response.code == 0){
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
            $(".create_"+$module).prop("disabled", false);
            $(".update_"+$module).prop("disabled", false);
        }
    });
}

$(".update_"+$module).click(function () {
    $('#'+$module+'_form').submit();
});

/*
*
*   FORM VALIDATION JS THIS IS DYNAMIC USED ACROSS THE BOARD.
*
*/

/*Modal Confirmation Code*/



$('.select2').on('change', function() {
    $(this).trigger('blur');
});

$.validator.addMethod("fax_number", function(value, element) {
    return this.optional(element) ||
        value.match(/^[0-9,\+]+$/);
}, "Please enter a valid fax number");

$.validator.addMethod("lettersonly", function(value, element) {
    return this.optional(element) || /^[a-z," "]+$/i.test(value);
}, "Only letters and spaces allowed");

$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0}');

$.validator.addMethod("no-http-url", function(value, element, param) {
return this.optional(element) || /^(www\.)(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value);
}, jQuery.validator.messages.url);

$.validator.addMethod("custom-url", function(value, element, param) {
return this.optional(element) || 
(new RegExp(/^(ftp|http|https)[^ "]+$/).test(value))?true:(/^(www\.)(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value));
}, jQuery.validator.messages.url);


var FormValidator = function () {

    var AddRecordValidation = function () {
        var formId = '#'+$module+'_form';
        var form1 = $(formId);
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        errorClass = 'help-block';
        errorElement = 'span';
        $(formId).validate({
            errorElement: errorElement, // contain the error msg in a span tag
            errorClass: errorClass,
            errorPlacement: function (error, element)
            {

                if(element.hasClass('select2') && element.next('.select2-container').length)
                {
                    error.insertAfter(element.next('.select2-container'));
                }
                else if(element.hasClass('cke_editor') && element.next('.cke_editor_content').length)
                {
                     error.insertAfter(element.next('.cke_editor_content'));
                }else
                {
                    error.insertAfter(element);
                }
 
            },
            ignore: [],
            rules: JSON.parse(validationRules),
            messages: JSON.parse(validationMessage),
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler1.hide();
                errorHandler1.show();
            },
            highlight: function (element, errorClass, validClass)
            {
                $(element).closest('.help-block').removeClass('valid');
                $(element).closest('.form-validate')
                            // .removeClass('has-success')
                            .addClass('has-error')
                            .find('.symbol')
                            .removeClass('ok')
                            .addClass('required');

            },
            unhighlight: function (element, errorClass, validClass)
            {
                $(element).closest('.form-validate').removeClass('has-error');
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                $(element).closest('.form-validate')
                            .removeClass('has-error')
                            // .addClass('has-success')
                            .find('.symbol')
                            .removeClass('required')
                            .addClass('ok');            

            },
            submitHandler: function (form)
            {
                successHandler1.show();
                errorHandler1.hide();

                $('#confirmationModal_once').modal('show');

                $(document).on('click','#confirmed',function () {
                    $('#'+ $module+'_form :input[type=submit]').attr('disabled',true);
                    createUpdateDataAjax();
                    $('#confirmationModal_once').modal('hide');
                });


                $("#close_alert").on("click",function(){
                    $('#create_form :input[type=submit]').attr('disabled',false);
                });

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
jQuery(document).ready(function () {
    FormValidator.init();
});

// Datepicker
$('.fc-datepicker').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true
});