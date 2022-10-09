<?php $this->load->view('includes/header', $this->data); ?>

<?php
$disabled = '';
if($action == "view_record"){
    $disabled = 'disabled';
}
?>

<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Treaty Codes</span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Treaty Codes</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>
    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="br-section-wrapper section-wrapper-shadow">


            <div id="wizard1">
<!--                <h3>Create New Treaty Codes</h3>-->
                <section>
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'role' => 'create_form', 'id' => 'create_form');
                    echo form_open(current_url(), $attributes);
                    ?>
                    <div class="br-section-wrapper">

                        <div class="row mg-b-25">
                            <!-- <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Cedent <span class="tx-danger">*</span></label>
                                    <select class="form-control select2"  id="cedentId" name="cedentId"  <?php echo $disabled?>>
                                        <option value="">Select Cedent</option>

                                        <?php
                                        foreach($cedent_types as $key => $cedent)
                                        {
                                            $selected ='';
                                            if(isset($data))
                                            {
                                                if($data->cedentDTO->id == $cedent->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            print('<option value="'.$cedent->id.'" '.$selected.'>'.$cedent->customerName.'</option>');
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> -->
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Treaty Name  <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="treatyName" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $data->treatyName  : ""; ?>" placeholder="Enter Treaty Name" <?php echo $disabled?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Treaty Code  <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="treatyCode" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $data->treatyCode  : ""; ?>" placeholder="Enter Treaty Code" <?php echo $disabled?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Treaty Type <span class="tx-danger">*</span></label>
                                    <select class="form-control select2"  id="treatyType" name="treatyType"  <?php echo $disabled?>>
                                        <option value="">Select Treaty Type</option>

                                        <?php
                                        foreach($treaty_types as $key => $treaty_type)
                                        {
                                            $selected ='';
                                            if(isset($data))
                                            {
                                                if($data->treatyType == $treaty_type->type) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            print('<option value="'.$treaty_type->type.'" '.$selected.'>'.$treaty_type->type.'</option>');
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Business Class  <span class="tx-danger">*</span></label>
                                    <select class="form-control select2"  id="businessClass" name="businessClass"  <?php echo $disabled?>>
                                        <option value="">Select Business Class</option>

                                        <?php
                                        foreach($business_class as $key => $business)
                                        {
                                            $selected ='';
                                            if(isset($data))
                                            {
                                                if($data->businessClass == $business->name) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            print('<option value="'.$business->name.'" '.$selected.'>'.$business->name.'</option>');
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> -->

                            <!-- form-layout-footer -->
                        </div>
                    </div><!-- form-layout -->
                    <br>
                    <?php if ($action =="edit_record" OR $action =="add_record"){ ?>
                        <button type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2"><?php echo ($action =="edit_record") ? "Update" : "Create"; ?></button>

                    <?php } ?>

                    <?php
                    echo form_close();
                    ?>
                </section>



            </div>

        </div>

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
                            'cedentId': {
                                required: true
                            },
                            treatyCode: {
                                required: true
                            },
                            treatyType: {
                                required: true
                            },
                            businessClass: {
                                required: true
                            },

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
