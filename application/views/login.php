<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>PakRe Insurance Company Ltd.</title>

    <!-- vendor css -->
    <link href="<?php echo $includes_dir;?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?php echo $includes_dir;?>css/bracket.css">

  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center login_bg ht-100v">

      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center"><img src="<?php echo $includes_dir;?>img/login-logo.png" alt="" class="img-fluid"></div>
        <h5 class="tx-center mg-b-60">Prudent</h5>
        <?php
          $attributes = array('class' => 'form-horizontal', 'role' => 'login_form', 'id' => 'login_form');
          echo form_open(current_url(), $attributes);
        ?>

            <div class="form-group form-validate">
              <input type="text" class="form-control" name="username" placeholder="<?php echo $this->lang->line('loginform_username_placehoder');?>" maxlength="20">
            </div><!-- form-group -->

            <div class="form-group form-validate">
              <input type="password" class="form-control" name="password" placeholder="<?php echo $this->lang->line('loginform_password_placehoder');?>" minlength="5" maxlength="12">
                <p class="error_msg" style="color:red;">
                    <?php if ($this->session->flashdata('message')) { echo $this->session->flashdata('message'); } ?>
                </p>
              <a href="<?php echo base_url()?>login/forget" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div><!-- form-group -->

            <input type="submit" name="SignInBtn" class="btn btn-info btn-block login_user" value="<?php echo $this->lang->line('Btn_signIn');?>">

        <?php echo form_close(); ?>

<!--        <div class="mg-t-60 tx-center">Not yet a member? <a href="--><?php //echo base_url()?><!--register" class="tx-info">Sign Up</a></div>-->
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="<?php echo $includes_dir;?>lib/jquery/jquery.js"></script>
    <script src="<?php echo $includes_dir;?>lib/popper.js/popper.js"></script>
    <script src="<?php echo $includes_dir;?>lib/bootstrap/bootstrap.js"></script>
    <script src="<?php echo $includes_dir?>/lib/admin/login/index.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery-validation/jquery.validate.js"></script>

    <script>
        jQuery(document).ready(function () {
            FormValidator.init();
        });
        var FormValidator = function () {

            var AddRecordValidation = function ()
            {
                var form1 = $('#login_form');
                var errorHandler1 = $('.errorHandler', form1);
                var successHandler1 = $('.successHandler', form1);
                $('#login_form').validate({
                    errorElement: "span", // contain the error msg in a span tag
                    errorClass: 'help-block',
                    errorPlacement: function (error, element)
                    {
                        error.insertAfter(element);
                    },
                    ignore: "",
                    rules: {
                        username: {
                            required: true
                        },
                        password : {
                            required: true
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
                        login();
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
    </script>

  </body>
</html>
