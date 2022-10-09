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
            <span class="breadcrumb-item active">Currency Rate</span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Currency Rate</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>
    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="br-section-wrapper section-wrapper-shadow">


            <div id="wizard1">
                <!--                <h3>Create New Condition</h3>-->
                <section>
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'role' => 'create_form', 'id' => 'create_form');
                    echo form_open(current_url(), $attributes);
                    ?>
                    <div class="br-section-wrapper">

                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Rate Type <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Select Rate Type" id="rateType" name="rateType" required <?php echo $disabled?>>
                                        <option value="">Select Rate Type</option>

                                        <?php
                                        $RatTypeName = '';
                                        foreach($rat_types as $key => $rat_type)
                                        {
                                            $selected ='';


                                            if(isset($data))
                                            {
                                                if($data->rateTypeDTO->id == $rat_type->id) {
                                                    $selected = 'selected';
                                                    $RatTypeName = $rat_type->name;
                                                }
                                            }

                                            if(strtoupper($rat_type->name) !='FIXED')
                                                print('<option value="'.$rat_type->id.'" '.$selected.'>'.$rat_type->name.'</option>');
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                                    <select class="form-control select2" data-placeholder="Select Currency" id="currency" name="currency" required <?php echo $disabled?>>
                                        <option value="">Select Currency</option>

                                        <?php
                                        foreach($currncy_types as $key => $currncy)
                                        {
                                            $selected ='';
                                            if(isset($data))
                                            {
                                                if($data->currencyDTO->id == $currncy->id) {
                                                    $selected = 'selected';
                                                }
                                            }
                                            print('<option value="'.$currncy->id.'" '.$selected.'>'.$currncy->name.'</option>');
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Effective Type </label>
                                    <input class="form-control" type="text" name="effectiveType" placeholder="Enter Effective Type"  value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $data->effectiveType  : ""; ?>" <?php echo $disabled?>>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Effective From <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date" name="effectiveFrom" id="effectiveFrom"  placeholder="Enter Effective From" autocomplete="off" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? date("Y-m-d",strtotime($data->effectiveFrom))   : ""; ?>" <?php echo $disabled?> <?php echo (($RatTypeName !='Corporate') ? 'disabled':'')?>>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Effective To <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date" name="effectiveTo" id="effectiveTo"  placeholder="Enter Effective To"  autocomplete="off" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? date("Y-m-d",strtotime($data->effectiveTo)) : ""; ?>" <?php echo $disabled?> <?php echo (($RatTypeName =='Spot') ? 'disabled':'disabled')?> >
                                    <p id="effectiveTo_error" style="color: red;"></p>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Precisions <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="precisions"  placeholder="Enter Precisions" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $data->precisions  : ""; ?>" <?php echo $disabled?>>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Rate <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="rate" id="rate" placeholder="Enter Rate" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $data->rate  : ""; ?>"  <?php echo $disabled?>>

                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Year <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="year" id="year" placeholder="Enter Year" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $data->year  : ""; ?>"  <?php echo $disabled?>>

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

            var Action = '<?php echo $action?>';
            var RatTypeName = '<?php echo $RatTypeName?>';

            disablePrevousDates();
            if(Action == 'edit_record' && RatTypeName =='Corporate')
            {
                $("#effectiveFrom").attr('disabled',false);
                $("#effectiveTo").attr('disabled',false);
                disablePrevousDates();
            } 
            if(Action == 'edit_record' && RatTypeName =='Spot')
            {
                $("#effectiveFrom").attr('disabled',false);
                disablePrevousDates();
            }

            $('.datepicker').datepicker({
                format: "dd/mm/yyyy",
                endDate : new Date(),
                autoclose: true,
                setDate:new Date()
            });
            $("#rateType").on("change",function(){
                var selectedText = $(this).find('option:selected').text();



                if(selectedText =="Corporate")
                {
                    $("#effectiveFrom").attr('disabled',false);
                    $("#effectiveTo").attr('disabled',false);
                    disablePrevousDates();
                }

                if(selectedText =="Spot")
                {
                    $("#effectiveTo").attr('disabled',true);
                    $("#effectiveFrom").attr('disabled',false);
                }
            });

            $("#effectiveFrom").on("change",function(){
                var effectiveFrom = $(this).val();
                var selectedText = $("#rateType").find('option:selected').text();

                if(selectedText =="Spot")
                {
                    $('#effectiveTo'). val(effectiveFrom);

                }

                if(selectedText =="Corporate")
                {
                    disablePrevousDates();
                }

            });

            function disablePrevousDates() {
                var dtToday = new Date();
                var month = dtToday.getMonth() + 1;
                var day = dtToday.getDate();
                var year = dtToday.getFullYear();
                if (month < 10)
                    month = '0' + month.toString();
                if (day < 10)
                    day = '0' + day.toString();

                var maxDate = year + '-' + month + '-' + day;
                $('#effectiveTo').attr('min', maxDate);
            }

            // $("#effectiveTo").on("change",function(){
            //     var effectiveFrom = $('#effectiveFrom').val();
            //     var effectiveTo = $(this).val();
            //     var selectedText = $("#rateType").find('option:selected').text();
            //
            //
            //     $("#effectiveTo_error").hide('');
            //     $("#effectiveTo_error").hide('');
            //
            //
            //
            //     if( effectiveTo < effectiveFrom && selectedText == "Corporate")
            //     {   $("#effectiveTo_error").show();
            //         $("#effectiveTo_error").text('Please select correct date');
            //     }
            //
            // });



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
                            currency: {
                                required: true
                            },
                            effectiveFrom : {
                                required: true
                            },
                            effectiveTo : {
                                required: true
                            },
                            precisions : {
                                required: true
                            },
                            rateType : {
                                required: true
                            },
                            rate : {
                                number: true,
                                required: true
                            },
                            year : {
                                number: true,
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

