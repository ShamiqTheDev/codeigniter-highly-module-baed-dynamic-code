<?php $this->load->view('includes/header', $this->data);

$disabled = '';



?>

<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Treaty Slip Status</span>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Treaty Slip Status</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>
    <?php
    $attributes = array('class' => 'form-horizontal', 'role' => 'create_form', 'id' => 'create_form');
    echo form_open(current_url(), $attributes);

    ?>

    <!-- d-flex -->
    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper mg-t-20 section-wrapper-shadow">
            <!--    <h3>Create New Agreement</h3>-->
            <div class="row mg-b-25">



                <?php
                $ButtonTitle = '';
                if($pre_selected_status == 'terminated'){ $ButtonTitle='Terminate'; ?>

                    <div class="col-lg-12">
                        <div class="form-group form-validate">
                            <label class="form-control-label">Termination Remarks  <span class="tx-danger">*</span></label>
                            <textarea  class="form-control" name="remarks" id="termination_remarks" placeholder="Enter Termination Remarks" required></textarea>
                        </div>
                    </div>

                <?php }  ?>
                <?php if($pre_selected_status == 'cancelled'){ $ButtonTitle='Cancel'; ?>
                    <div class="col-lg-12">
                        <div class="form-group form-validate">
                            <label class="form-control-label">Cancellation Remarks  <span class="tx-danger">*</span></label>
                            <textarea  class="form-control" name="remarks" id="cancellation_remarks" placeholder="Enter Cancellation Remarks" required></textarea>
                        </div>
                    </div>
                <?php }  ?>
                <?php if($pre_selected_status == 'discontinued'){ $ButtonTitle='Discontinue'; ?>
                    <div class="col-lg-12">
                        <div class="form-group form-validate">
                            <label class="form-control-label">Discontinuation Remarks  <span class="tx-danger">*</span></label>
                            <textarea  class="form-control" name="remarks" id="discontinuation_remarks" placeholder="Enter Discontinuation Remarks" required></textarea>
                        </div>
                    </div>
                <?php }  ?>






                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="hidden" name="flag_name" value="<?php echo $pre_selected_status;?>">
                        <input type="hidden" name="changeFlag" value="1">
                        <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2" style="margin: 10px;float: right;" name="update_statusBtn"  id="update_statusBtn" value="<?php echo $ButtonTitle;?>">
                    </div>
                </div>

            </div>
            <!-- form-layout -->
        </div>
     </div>

    <div>
        <?php $this->load->view('includes/footer', $this->data); ?>
    </div>
    <?php echo form_close(); ?>



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
                    rules: {},
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

