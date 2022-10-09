<?php $this->load->view('includes/header', $this->data); ?>

<?php
$disabled = '';
if($action =="view_record"){
    $disabled = 'disabled';
}
?>


<div class="br-mainpanel">

    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Module</span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Module</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>


    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper section-wrapper-shadow">


            <div id="wizard1">

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
                                    <label class="form-control-label">Module Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="moduleName" id="moduleName" value="<?php if(isset($module_data)){print($module_data->moduleName);}?>" placeholder="Enter Module Name" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Url <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="url" id="url" value="<?php if(isset($module_data)){print($module_data->url);}?>" placeholder="Enter Url" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                  <label class="form-control-label">Sort Order <span class="tx-danger">*</span></label>
                                  <input type="text" name="sidebarOrder" placeholder="Enter Sort Order" required="required" value="<?php if(isset($module_data)){print($module_data->sidebarOrder);}?>" id="sidebarOrder" class="form-control numeric sidebarOrder" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Description <span class="tx-danger">*</span></label>
                                    <textarea rows="3" class="form-control" placeholder="Enter Description" name="description" id="description" <?php echo $disabled?>><?php if(isset($module_data)){print($module_data->description);}?></textarea>
                                </div>
                            </div>



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
                            moduleName: {
                                required: true
                            },
                            description : {
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
