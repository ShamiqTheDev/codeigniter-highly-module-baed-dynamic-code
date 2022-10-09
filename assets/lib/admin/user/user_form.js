function CreateUser()
{
    $("#confirmed").attr('disabled',true);
    $('#create_form :input[type=submit]').attr('disabled',true);
    $.ajax({
        url: base_url + 'user/create',
        type: 'POST',
        data: new FormData(document.getElementById("create_form")),
        contentType: false,
        cache: false,
        processData:false,

        dataType: 'json',
        // headers: {
        //     'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        // },
        success: function (response) {
            $("input[name=csrf_test_name]").val(response.token); // NEW
            if (response.code == 1) {
                         window.location.replace(base_url+"user");
            }else if(response.code == 0)
            {
                $('#confirmationModal_once').modal('hide');
                $("#confirmed").attr('disabled',false);
                $('#create_form :input[type=submit]').attr('disabled',false);
                $(".h_heading").text(response.message);
                $('#modaldemo5').modal('show');
            }
            else {
                console.log("Issue During Insertion: ");
                console.log(response);
            }
        },
        error: function (r) {
            $("input[name=csrf_test_name]").val(r.token); // NEW
            console.log(r);
            console.log('Error in retrieving Site.');
        }
    });
}


$(".update_user").click(function () {
    var formData = new FormData(document.getElementById("create_form"));
    $('#confirmationModal_once').modal('show');

    $("#confirmed").on("click",function()
    {
        $("#confirmed").attr('disabled',true);
        $('#create_form :input[type=submit]').attr('disabled',true);
        $.ajax({
            url: base_url + 'user/edit',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData:false,

            dataType: 'json',
            headers: {
                'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
            },
            success: function (response) {
                // $("input[name=csrf_test_name]").val(response.token); // NEW

                if (response.code == 1) {
                    console.log("Updated Token: " + $('input[name="csrf_test_name"]').attr('value'));
                    console.log(response);
                    window.location.href = base_url + 'user' ;
                }else if(response.code == 0){
                    $('#confirmationModal_once').modal('hide');
                    $("#confirmed").attr('disabled',false);
                    $('#create_form :input[type=submit]').attr('disabled',false);
                    $(".h_heading").text(response.message);
                    $('#modaldemo5').modal('show');
                }
                else{
                    console.log("Issue During Updating: ");
                    console.log(response);
                }
            },
            error: function (r) {
                $("input[name=csrf_test_name]").val(r.token); // NEW
                console.log(r);
                console.log('Error in retrieving Site.');
            }
        });

    });

    $("#close_alert").on("click",function(){
        $('#create_form :input[type=submit]').attr('disabled',false);
    });


});


$(document).on('click','.submitUser',function (e) {
    e.preventDefault();
    $('#create_form').submit();
});
$.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
}, 'File size must be less than {0} mb');

jQuery(document).ready(function () {
    FormValidator.init();
});
var FormValidator = function () {

    var AddRecordValidation = function () {
        var form1 = $('#create_form');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#create_form').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            },
            ignore: "",
            rules: {
                userName: {
                    required: true,
                    minlength: 6,
                    maxlength: 10
                },
                email: {
                    required: true,
                    email: true
                },
                mobileNo: {
                    required: true,
                    number:true
                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 16
                },
                'roleDTO.id': {
                    required: true
                },

                userImage: {
                    required: true,
                    extension: "jpg,JPG,jpeg,JPEG,png,PNG",
                    filesize: 2000000,
                },

            },
            messages: {
                userImage: {
                    accept: "Only jpeg,jpg or png files allowed.",
                },
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

                $('#confirmationModal_once').modal('show');

                $("#confirmed").on("click",function(){
                    CreateUser();
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
$('.roleOptions').select2({}).on("change", function (e) {
    $(this).valid()
});