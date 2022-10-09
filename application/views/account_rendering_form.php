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
            <span class="breadcrumb-item active">Accounts Rendering</span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Accounts Rendering</h4>
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
                    echo form_open_multipart(current_url(), $attributes);
                    ?>
                    <div class="br-section-wrapper">
                        <div class="row" id="ActionMsgDiv" >
                            <div class="col-lg-12" id="ActionMsg">
                            </div>
                        </div>
                        <div class="row  mg-b-25">
                                <div class="col-sm-10">
                                    <input type="file" id="data_file" name="data_file"  >
                                </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input  type="hidden" name="upload_account_rendering" value="true">
                                <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2"  name="SubmitBtn" value="Submit">
                            </div>
                        </div>
                    </div>
                    <br>


                    <?php
                    echo form_close();
                    ?>
                </section>
                <br>
                <section style="display: none;" id="data_table_div">
                    <h3>Account Rendering Uploaded Data</h3>
                    <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;overflow-y: scroll;height: 800px;">

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th># No.</th>
                                <th>PRC Year</th>
                                <th>PRC Qtr</th>
                                <th>Dept</th>
                                <th>Bus Type</th>
                                <th>Reins. Arr</th>
                                <th>Treaty Code</th>
                                <th>Broker Code</th>
                                <th>Cedent Code</th>
                                <th>Broker/Co Ref No.</th>
                                <th>Co. Qtr</th>
                                <th>Co. year</th>
                                <th>U/W Year</th>
                                <th>Identity Insured</th>
                                <th>Type Risk</th>
                                <th>Currency Type</th>
                                <th>Currency Code</th>
                                <th>PRC Share</th>
                                <th>Premium</th>
                                <th>Commission</th>
                                <th>O.R Commission</th>
                                <th>Brokerage</th>
                                <th>Profit Commission</th>
                                <th>XL Premium</th>
                                <th>Losses Paid</th>
                                <th>Premium Res. W/Held</th>
                                <th>Premium Res. Release</th>
                                <th>Interest On P/L Res</th>
                                <th>Taxes</th>
                                <th>Losses Res. W/Held</th>
                                <th>Losses Res. Reles</th>
                                <th>Cash Loss W/Held</th>
                                <th>Cash Loss Reles</th>
                                <th>Cash Loss Refund</th>
                                <th>Exchange Difference</th>
                                <th>Port Premium </th>
                                <th>Port Losses</th>
                                <th>Misc. Charges</th>
                                <th>Balance </th>
                                <th>Hash Total </th>


                            </tr>
                            </thead>

                            <tbody id="table_tbody_re">
                                    <tr><td colspan="40">Please wait...</td></tr>

                            </tbody>
                        </table>





                    </div>
                </section>



            </div>

        </div>

        <?php $this->load->view('includes/footer', $this->data); ?>
        <script>
            setTimeout(function() {
                $('#ActionMsgDiv').fadeOut('fast');
            }, 1000); // <-- time in milliseconds

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
                            if (element.attr("name") == "data_file")
                            {
                                error.insertAfter(".custom-file");

                            } else {

                                error.insertAfter(element);

                            }
                        },
                        ignore: "",
                        rules: {
                            data_file:{
                                required:true,
                                extension: "xlsx|xls"
                            }

                        },
                        messages: {
                            username: {
                                required: "Please select a file",
                                extension: "Please select  Excel fiel.",
                            }
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

                            var formData = new FormData(document.getElementById("create_form"));
                            $.ajax({
                                url: $("#create_form").attr('action'),
                                type: 'POST',
                                contentType: "application/json",
                                data: formData,
                                success: function (data)
                                {

                                    var data = JSON.parse(data); 
                                    if(data.code == 1)
                                    {
                                        $("#ActionMsgDiv").show();
                                        $("#ActionMsg").html('<div class="alert alert-success" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> ' +data.message+ '</div> ');
                                        LoadTableData(data.response);

                                    }else
                                    {
                                        $("#ActionMsgDiv").show();
                                        $("#ActionMsg").html('<div class="alert alert-danger" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button> ' +data.message+ '</div> ');
                                    }
                                },
                                cache: false,
                                contentType: false,
                                processData: false
                            });


                            // $("#create_form").submit(); // Submit the form


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




            function LoadTableData(Data)
            {
                $("#data_table_div").show();
                var Html = '';
                for (var i = 0 ; i < Data.length;i++)
                {
                    Html +='<tr>\n' +
                    '<th>'+(i+1)+'</th>\n' +
                    '<th>'+Data[i]['prcShare']+'</th>\n' +
                    '<th>'+Data[i]['prcQtr']+'</th>\n' +
                    '<th>'+Data[i]['dept']+'</th>\n' +
                    '<th>'+Data[i]['busType']+'</th>\n' +
                    '<th>'+Data[i]['reinsArr']+'</th>\n' +
                    '<th>'+Data[i]['treatyCode']+'</th>\n' +
                    '<th>'+Data[i]['brokerCode']+'</th>\n' +
                    '<th>'+Data[i]['cedingCode']+'</th>\n' +
                    '<th>'+Data[i]['brokerCoRefNo']+'</th>\n' +
                    '<th>'+Data[i]['coQtr']+'</th>\n' +
                    '<th>'+Data[i]['coYear']+'</th>\n' +
                    '<th>'+Data[i]['uwYear']+'</th>\n' +
                    '<th>'+Data[i]['identityInsured']+'</th>\n' +
                    '<th>'+Data[i]['typeRisk']+'</th>\n' +
                    '<th>'+Data[i]['curType']+'</th>\n' +
                    '<th>'+Data[i]['curCode']+'</th>\n' +
                    '<th>'+Data[i]['prcShare']+'</th>\n' +
                    '<th>'+Data[i]['premium']+'</th>\n' +
                    '<th>'+Data[i]['commission']+'</th>\n' +
                    '<th>'+Data[i]['orCommission']+'</th>\n' +
                    '<th>'+Data[i]['brokerAge']+'</th>\n' +
                    '<th>'+Data[i]['profitCommission']+'</th>\n' +
                    '<th>'+Data[i]['xlPremium']+'</th>\n' +
                    '<th>'+Data[i]['lossesPaid']+'</th>\n' +
                    '<th>'+Data[i]['premiumResWHeld']+'</th>\n' +
                    '<th>'+Data[i]['premiumResReles']+'</th>\n' +
                    '<th>'+Data[i]['interestOnPlRes']+'</th>\n' +
                    '<th>'+Data[i]['taxes']+'</th>\n' +
                    '<th>'+Data[i]['lossesResWHeld']+'</th>\n' +
                    '<th>'+Data[i]['lossesResReles']+'</th>\n' +
                    '<th>'+Data[i]['cashLossWHeld']+'</th>\n' +
                    '<th>'+Data[i]['cashLossReles']+'</th>\n' +
                    '<th>'+Data[i]['cashLossRefund']+'</th>\n' +
                    '<th>'+Data[i]['exchangeDifference']+'</th>\n' +
                    '<th>'+Data[i]['portPremium']+'</th>\n' +
                    '<th>'+Data[i]['portLosses']+'</th>\n' +
                    '<th>'+Data[i]['miscCharges']+' </th>\n' +
                    '<th>'+Data[i]['balance']+'</th> \n' +
                    '<th>'+Data[i]['hashTotal']+'</th> \n' +
                    '</tr>';
                }
                $("#table_tbody_re").html(Html);
            }

        </script>

