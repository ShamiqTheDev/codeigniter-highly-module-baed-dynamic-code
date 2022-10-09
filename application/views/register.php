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
    <link href="<?php echo $includes_dir;?>lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Bracket CSS -->
    <link rel="stylesheet" href="<?php echo $includes_dir;?>css/bracket.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center login_bg ht-100v">
    <?php
        $attributes = array('id' => 'registration_form',"method"=>'post');
        echo form_open(current_url().'/register_user', $attributes);
        ?>
      <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-40 bg-white rounded shadow-base">
        <div class="signin-logo tx-center"><img src="<?php echo $includes_dir;?>img/login-logo.png" alt=""></div>
        <h5 class="tx-center mg-b-40">Prudent</h5>

        <div class="form-group">
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
        </div><!-- form-group -->
        <div class="form-group">
          <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Enter your fullname">
        </div><!-- form-group -->
        <div class="form-group">
          <label class="d-block tx-11 tx-uppercase tx-medium tx-spacing-1">Birthday</label>
          <div class="row row-xs">
            <div class="col-sm-4">
              <select class="form-control select2" data-placeholder="Month" name="DOB_Month" id="DOB_Month">
                <option label="Month"></option>
                <option value="1">January</option>
                <option value="2">February</option>
                <option value="3">March</option>
                <option value="4">April</option>
                <option value="5">May</option>
              </select>
            </div><!-- col-4 -->
            <div class="col-sm-4 mg-t-20 mg-sm-t-0">
              <select class="form-control select2" data-placeholder="Day" name="DOB_Day" id="DOB_Day">
                <option label="Day"></option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
              </select>
            </div><!-- col-4 -->
            <div class="col-sm-4 mg-t-20 mg-sm-t-0">
              <select class="form-control select2" data-placeholder="Year" name="DOB_Year" id="DOB_Year">
                <option label="Year"></option>
                <option value="1">2010</option>
                <option value="2">2011</option>
                <option value="3">2012</option>
                <option value="4">2013</option>
                <option value="5">2014</option>
              </select>
            </div><!-- col-4 -->
          </div><!-- row -->
        </div><!-- form-group -->
       
        <button type="submit" class="btn btn-info btn-block">Submit</button>

        <div class="mg-t-40 tx-center">Already a member? <a href="<?php echo base_url()?>login" class="tx-info">Sign In</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->
    <?php echo form_close(); ?>

    <script src="<?php echo $includes_dir;?>lib/jquery/jquery.js"></script>
    <script src="<?php echo $includes_dir;?>lib/popper.js/popper.js"></script>
    <script src="<?php echo $includes_dir;?>lib/bootstrap/bootstrap.js"></script>
    <script src="<?php echo $includes_dir;?>lib/select2/js/select2.min.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery-validation/jquery.validate.js"></script>

    <script>
	
	jQuery(document).ready(function () {
		FormValidator.init();
	});
	
	var FormValidator = function () { //alert('test');
		// function to initiate category
		var registerForm = function () { //alert('test 11');
			
				
			var errorHandler1 = $('.errorHandler', form1);
			var successHandler1 = $('.successHandler', form1);
			$('#registration_form').validate({
				errorElement: "span", // contain the error msg in a span tag
				errorClass: 'help-block',
				ignore: "",
				rules: {
            username:{
							required: true,
							
            },
            password:{
							required: true,
							
            },
            fullname:{
							required: true,
							
            },
            username:{
							required: true,
							
						},
			  },
				messages: {
				},
				errorPlacement:  function(error, element) {
					var placement = $(element).data('error');
					 
						error.insertAfter(element);
					 
				},
				invalidHandler: function (event, validator) { //display error alert on form submit
					successHandler1.hide();
					errorHandler1.show();
					
				},
				highlight: function (element) {
					
					$(element).closest('.help-block').removeClass('valid');
					// display OK icon
					$(element).closest('.form-validate').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
					
				},
				unhighlight: function (element) { // revert the change done by hightlight
					$(element).closest('.form-validate').removeClass('has-error');
					// set error class to the control group
				},
				success: function (label, element) {
					label.addClass('help-block valid');
					// mark the current input as valid and display OK icon
					$(element).closest('.form-validate').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
				},
				submitHandler: function (form) {
					
					//alert('submitHandler');
					
					successHandler1.show();
					errorHandler1.hide();
					// submit form
					//$('#search_form').submit();
					 
				}
			});
		};
		
		
		return {
			//main function to initiate pages
			init: function () {
				registerForm();
			}
		};
	}();
	
	
	
</script>

    <script>
      $(function(){
        'use strict';

        $('.select2').select2({
          minimumResultsForSearch: Infinity
        });
      });
    </script>

  </body>
</html>
