<?php $this->load->view('includes/header', $this->data); ?>

<?php
$disabled = '';
if($action =='view_record'){
    $disabled = 'disabled';

}
?>
 <div class="br-mainpanel">
     <div class="br-pageheader pd-y-15 pd-l-20">
         <nav class="breadcrumb pd-0 mg-0 tx-12">
             <a class="breadcrumb-item" href="#">Setup</a>
             <span class="breadcrumb-item active">Primary Insurer</span>
         </nav>
     </div>

     <div class="row">
         <div class="col-sm-12">
             <div class="pd-30 form-heading-container" style="">
                 <h4 class="tx-gray-800 mg-b-5 form-heading">Primary Insurer</h4>
                 <p class="mg-b-0"></p>
             </div>
         </div>
     </div><br>
     <div class="br-pagebody mg-t-5 pd-x-30">
         <div class="br-section-wrapper section-wrapper-shadow">
            <div id="wizard1">
<!--                <h3>Create New Primary Insurer</h3>-->
                <section>
                    <?php
                    $action_path = current_url();
                    $attributes = array('class' => 'form-horizontal ', 'role' => 'create_form', 'id' => 'create_form');
                    echo form_open($action_path, $attributes);
                    ?>
                    <div class="br-section-wrapper">

                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="insName" id="insName" required value="<?php if(isset($data)){print($data->insName);}?>" placeholder="Enter Name" <?=$disabled?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Primary Insurer Type <span class="tx-danger">*</span></label>
                                    <select class="form-control" name="insType" id="insType" <?=$disabled?>>
                                        <option value="">Select Type</option>
                                        <option value="textile" <?php if(isset($data)){ print($data->insType == "textile" ? 'selected':'');}?>>Textile</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label"> Category <span class="tx-danger">*</span></label>
                                    <select class="form-control" name="insCategory" id="insCategory" <?=$disabled?>>
                                        <option value="" >Select Category</option>
                                        <option value="local" <?php if(isset($data)){ print($data->insCategory == "local" ? 'selected':'');}?>>Local</option>
                                        <option value="international" <?php if(isset($data)){ print($data->insCategory == "International" ? 'selected':'');}?>>international</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Website <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="insWebsite" id="insWebsite" required value="<?php if(isset($data)){print($data->insWebsite);}?>" placeholder="Enter Website " <?=$disabled?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Location <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="inslocation" id="inslocation" required value="<?php if(isset($data)){print($data->inslocation);}?>" placeholder="Enter Location" <?=$disabled?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Address <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="insAddress" id="insAddress" required value="<?php if(isset($data)){print($data->insAddress);}?>" placeholder="Enter Address" <?=$disabled?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Contact Focal <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="insContactFocal" id="insContactFocal" required value="<?php if(isset($data)){print($data->insContactFocal);}?>" placeholder="Enter Contact Focal" <?=$disabled?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Contact Phone <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="insContactPhone" id="insContactPhone" required value="<?php if(isset($data)){print($data->insContactPhone);}?>" placeholder="Enter Contact Phone" <?=$disabled?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Map Code <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="insMapCode" id="insMapCode" maxlength="9" required value="<?php if(isset($data)){print($data->insMapCode);}?>" placeholder="Enter Map Code" <?=$disabled?>>
                                </div>
                            </div>
                        </div>
                            <input type="hidden" value="">
                    </div><!-- form-layout -->
                    <br>
                    <?php if ($action =="edit_record" OR $action =="add_record"){ ?>
                        <input type="hidden" name="SubForm" value="SubForm">
                        <button type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2"><?php echo ($action =="edit_record") ? "Update" : "Create"; ?></button>
                    <?php } ?>
                    <?php echo form_close(); ?>
                </section>	
            </div>
    </div>
    <script>

    </script>
  <?php $this->load->view('includes/footer', $this->data); ?>
        <script>
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
                            insName: {
                                required: true
                            },
                            insType : {
                                required: true
                            },
                            insCategory : {
                                required: true
                            },
                            insWebsite : {
                                required: true
                            },
                            inslocation : {
                                required: true
                            },
                            insAddress : {
                                required: true
                            },
                            insContactFocal : {
                                required: true
                            },
                            insContactPhone : {
                                required: true,
                                number:true,
                                maxlength:11
                            },
                            insMapCode : {
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
                            $('#confirmationModal_once').modal('show');

                            $("#confirmed").on("click",function(){
                                AddRecord();
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
        </script>