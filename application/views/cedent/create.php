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
            <span class="breadcrumb-item active">Cedent</span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Cedent</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>



    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper section-wrapper-shadow">


            <div id="wizard1">
                <section>
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'role' => 'create_form', 'id' => 'create_form');
                    echo form_open(current_url(), $attributes);
                    
                    if (isset($response->id)) { ?>
                        <input type="hidden" name="id" value="<?php echo (isset($response->id)) ? $response->id : ""; ?>">    
                    <?php 
                    } 
                    ?>
                    <div class="br-section-wrapper">

                        <div class="row mg-b-25">

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Created Date <span class="tx-danger">*</span></label>
                                    <input class="form-control datepicker" type="text" name="dateOfCreation" value="<?php echo (isset($response->dateOfCreation)) ? date($this->config->item('backend_date_format'), strtotime($response->dateOfCreation)) : ""; ?>" placeholder="Enter Created Date" <?php echo $disabled?>>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Inactive Date </label>
                                    <input id="inactiveDate" class="form-control datepicker" type="text" name="inactiveDate" value="<?php echo (isset($response->inactiveDate)) ? date($this->config->item('backend_date_format'), strtotime($response->inactiveDate)) : ""; ?>" placeholder="Enter Inactive Date" <?php echo $disabled?>>
                                    <?php if (isset($response->id)) { ?>
                                        <input type="hidden" name="id" value="<?php echo (isset($response->id)) ? $response->id : ""; ?>">    
                                    <?php } ?>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                                    <select id="cedentStatus" class="form-control" type="text" name="cedentStatus" <?=$disabled?>>
                                        <?php 
                                        $options = $this->config->item('cedentStatus');
                                        $selectedVal = $response->cedentStatus?$response->cedentStatus:'';
                                        foreach ($options as $key => $value) { 
                                            $select = ($selectedVal === $key ? 'selected="selected"':'');
                                        ?>
                                            <option value="<?=$key?>"><?=$value?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Cedent Code <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="cedentCode" value="<?php echo (isset($response->cedentCode)) ? $response->cedentCode : ""; ?>" placeholder="Enter Cedent Code" <?php echo $disabled?>>
                                    <?php if (isset($response->id)) { ?>
                                        <input type="hidden" name="id" value="<?php echo (isset($response->id)) ? $response->id : ""; ?>">    
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Cedent name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="customerName" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->customerName  : ""; ?>" placeholder="Enter Cedent Name"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Cedent short name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="customerShortName" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->customerShortName  : ""; ?>" placeholder="Enter Cedent Short Name"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Number <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="customerNumber" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->customerNumber  : ""; ?>"  <?php echo $disabled?> maxlength="11" placeholder="Enter Number">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Category <span class="tx-danger">*</span></label>

                                    <select class="form-control" type="text" name="category" <?=$disabled?>>
                                        <?php 
                                        $options = $this->config->item('cedentCategory');
                                        $selectedVal = $response->category?$response->category:'';
                                        foreach ($options as $key => $value) { 
                                            $select = $selectedVal == $key? 'selected="selected"':'';
                                        ?>
                                            <option value="<?=$key?>" <?=$select?>><?=$value?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Type <span class="tx-danger">*</span></label>
                                    <select class="form-control" type="text" name="type" <?=$disabled?>>
                                        <?php 
                                        $options = $this->config->item('cedentType');
                                        $selectedVal = $response->type?$response->type:'';
                                        foreach ($options as $key => $value) { 
                                            $select = $selectedVal == $key? 'selected="selected"':'';
                                        ?>
                                            <option value="<?=$key?>" <?=$select?>><?=$value?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">NTN # <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter NTN" name="ntn" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->ntn  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">CNIC # <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter CNIC" name="nic" id="CNIC_No" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->nic  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Country <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Country Name" name="country" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->country  : ""; ?>" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">City <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter City Name" name="city" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->city  : ""; ?>" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Address <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Address" name="address" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->address  : ""; ?>" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Address Line <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Address Line" name="addressLine" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->addressLine  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Address Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Address Name" name="addressNameSupplierSite" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->addressNameSupplierSite  : ""; ?>" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Location <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Location" name="location" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->location  : ""; ?>" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Landline # <span class="tx-danger">*</span></label>
                                    <input class="form-control" maxlength="11" type="text" placeholder="Enter Landline Number" name="landLine" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->landLine  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Fax # <span class="tx-danger">*</span></label>
                                    <input class="form-control" maxlength="11" placeholder="Enter Fax Number" type="text" name="fax" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->fax  : ""; ?>" placeholder="" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Contact Person <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Contact Person" name="contactPerson" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->contactPerson  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>



                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Operating Unit <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Operating Unit" name="operatingUnit" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->operatingUnit  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Liability Account <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Liability Account" name="liabilityAccount" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->liabilityAccount  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Prepayment <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Prepayment" name="prepayment" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->prepayment  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Classification <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Classification" name="classification" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->classification  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Profile <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter Profile" name="profile" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->profile  : ""; ?>"  <?php echo $disabled?>>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <label class="form-control-label">Bill TO <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter bill To" name="billTo" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->billTo  : ""; ?>" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <label class="form-control-label">WHT <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" placeholder="Enter WHT" name="withHoldingTax" value="<?php echo ($action == "edit_record" || $action == "view_record") ? $response->withHoldingTax  : ""; ?>" <?php echo $disabled?>>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <div class="group_purchasing">
                                        <label class="form-control-label">Purchasing <span class="tx-danger">*</span></label><br>
                                        Yes <input type="radio" name="purchasing" value="Yes" style="margin: 0px 10px 0px 0px;" <?php if(($action == "edit_record" || $action == "view_record") AND $response->purchasing =='Yes' ){ echo 'Checked'; } ?> <?php echo $disabled?>>
                                        No <input  type="radio" name="purchasing" value="No"  style="margin: 0px 10px 0px 0px;" <?php if(($action == "edit_record" || $action == "view_record") AND $response->purchasing =='No' ){ echo 'Checked'; } ?> <?php echo $disabled?>>

                                     </div>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <div class="group_payment">
                                        <label class="form-control-label">Payment <span class="tx-danger">*</span></label><br>
                                        Yes <input type="radio" name="payment" value="Yes" style="margin: 0px 10px 0px 0px;" <?php if(($action == "edit_record" || $action == "view_record") AND $response->payment =='Yes' ){ echo 'Checked'; } ?> <?php echo $disabled?>>
                                        No <input  type="radio" name="payment" value="No"  style="margin: 0px 10px 0px 0px;" <?php if(($action == "edit_record" || $action == "view_record") AND $response->payment =='No' ){ echo 'Checked'; } ?> <?php echo $disabled?>>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-12">


                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <div class="group_allowWHT">
                                        <label class="form-control-label">Allow WHT <span class="tx-danger">*</span></label><br>
                                        Yes <input type="radio" name="allowWHT" value="Yes" style="margin: 0px 10px 0px 0px;" <?php if(($action == "edit_record" || $action == "view_record") AND $response->allowWHT =='Yes' ){ echo 'Checked'; } ?> <?php echo $disabled?>>
                                        No <input  type="radio" name="allowWHT" value="No"  style="margin: 0px 10px 0px 0px;" <?php if(($action == "edit_record" || $action == "view_record") AND $response->allowWHT =='No' ){ echo 'Checked'; } ?> <?php echo $disabled?>>
                                    </div>
                                </div>

                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <div class="group_allowTaxWHT">
                                        <label class="form-control-label">Allow Tax WHT <span class="tx-danger">*</span></label><br>
                                        Yes <input type="radio" name="allowTaxWHT" value="Yes" style="margin: 0px 10px 0px 0px;" <?php if(($action == "edit_record" || $action == "view_record") AND $response->allowTaxWHT =='Yes' ){ echo 'Checked'; } ?> <?php echo $disabled?>>
                                        No <input  type="radio" name="allowTaxWHT" value="No"  style="margin: 0px 10px 0px 0px;" <?php if(($action == "edit_record" || $action == "view_record") AND $response->allowTaxWHT =='No' ){ echo 'Checked'; } ?> <?php echo $disabled?>>
                                     </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group form-validate">
                                    <label class="form-control-label">Remarks <span class="tx-danger">*</span></label>
                                    <textarea class="form-control" type="text" placeholder="Enter Remarks" name="remarks" <?php echo $disabled?>><?php echo ($action == "edit_record" || $action == "view_record") ? $response->remarks : ""; ?></textarea>
                                </div>
                            </div>

                            <!-- <input type="hidden" value="1" name="cedentStatus"> -->
                            <!-- form-layout-footer -->
                        </div>
                    </div><!-- form-layout -->
                    <br>
                    <?php if ($action =="edit_record" || $action =="add_record"){ ?>
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
            $('#CNIC_No').mask("99999-9999999-9");
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

                        if ( element.is(":radio") ) {
                            error.insertAfter( element.parent() );
                        }
                        else {
                            error.insertAfter(element);
                        }
                    },
                    ignore: "",
                    rules: {
                        cedentCode: {
                            required: true
                        },
                        customerName : {
                            required: true
                        },
                        customerNumber : {
                            required: true,
                            number: true
                        },
                        ntn : {
                            required: true
                        },
                        nic : {
                            required: true
                        },
                        fax : {
                            required: true,
                        },
                        remarks : {
                            required: true
                        },
                        country : {
                            required: true
                        },
                        address : {
                            required: true
                        },
                        addressLine : {
                            required: true
                        },
                        addressNameSupplierSite : {
                            required: true
                        },
                        landLine : {
                            required: true,
                            number: true
                        },
                        operatingUnit : {
                            required: true
                        },
                        liabilityAccount : {
                            required: true
                        },
                        prepayment : {
                            required: true
                        },
                        classification : {
                            required: true
                        },
                        profile : {
                            required: true
                        },
                        billTo : {
                            required: true
                        },
                        contactPerson : {
                            required: true
                        },
                        purchasing:{
                            required:true
                        },
                        payment:{
                            required:true
                        },
                        allowWHT:{
                            required:true
                        },
                        allowTaxWHT:{
                            required:true
                        },
                        category:{
                            required:true
                        },
                        type:{
                            required:true
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

        function checkInactive() {
            var inactiveDate = $('#inactiveDate').val();
            var active = '';
            if (inactiveDate) {
                active = '0';
            } else {
                active = '1';
            }
            $('#cedentStatus').val(active);
        }
        $(document).on('change', '#inactiveDate', function () {
            checkInactive();
        });

        if (SEGMENT_2 !== 'create') {
            checkInactive();
        }
    </script>
