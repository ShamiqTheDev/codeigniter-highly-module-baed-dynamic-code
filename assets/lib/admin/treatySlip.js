jQuery(document).ready(function () {
    FormValidator_General.init();
    FormValidator_Layer.init();
    FormValidator_section.init();
    FormValidator_Layer_Reinstatement.init();
    FormValidator_Section_class.init();
    FormValidator_SlidingScale.init();
    FormValidator_LossHistory.init();
});


// var getUrl = window.location;
// var base_url = window.location.origin;
// base_url += "/"+getUrl.pathname.split('/')[3];

$(function () {
  $(".with-add-new-select2")
  .select2({
    minimumResultsForSearch: '',
    placeholder: "Choose Option Risk Covered",
  })
  .on('select2:close', function() {
    var el = $(this);
    if(el.val() && el.val().includes('NEW')) {
        var newval = prompt('Please Enter Risk Type: ');
        if(newval) {
            var url = base_url+'riskCovered/create';
            $.ajax({
                url: url,
                type: 'POST',
                data: { 
                    'name': newval,
                    'riskCovered': '1',
                    'action': 'singleCreate',
                },
                // contentType: false,
                // cache: false,
                // processData:false,
                dataType: 'json',
                headers: {
                    'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
                },
                success: function (resp)
                {
                    val = resp.data.entity;
                    el.append('<option value="'+val.id+'">'+val.name+'</option>')
                      .val(newval);
                },
                complete: function() {
                    $(this).data('requestRunning', false);
                },
                error: function (r) {
                    clog('Error in retrieving Site.');
                    clog(r);
                }
            });
        }
    }
  });
});


// Treaty General Form Validation
var FormValidator_General = function () {

    var AddRecordValidation = function () {
        var form1 = $('#TreatySlipForm');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#TreatySlipForm').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            },
            ignore: "",
            rules: {
                treater_agreementNumber: {
                    required: true
                },
                treatier_code: {
                    required: true
                },
                treater_name: {
                    required: true
                },
                cedent_name: {
                    required: true
                },
                uwInceptionYear: {
                    required: true
                },
                business_class: {
                    required: true
                },
                treaty_type: {
                    required: true
                },
                treaty_category: {
                    required: true
                },
                effectiveFrom: {
                    required: true
                },
                expireOn: {
                    required: true
                },
                currency: {
                    required: true
                },
                Rate_Type: {
                    required: true
                },
                leader_follower: {
                    required: true
                },
                currency_rate: {
                    required: true,
                    number: true
                },
                liabilityLimit: {
                    required: true
                },
                portfolioType: {
                    required: true
                },
                umrNumber: {
                    required: true
                },
                territorialScope: {
                    required: true
                },
                managementExpenses: {
                    required: true,
                    number: true
                },
                fileRefNo: {
                    required: true
                },
                participationFlag: {
                    required: true
                },
                cedent_id: {
                    required: true
                },
                prcShare: {
                    required: true,
                    number: true
                },
                // prcAmount: {
                //     required: true,
                //     number: true
                // },
                profitCommissionRate: {
                    required: true,
                    number: true
                },
                // profitCommission: {
                //     required: true,
                //     number: true
                // },
                jurisdiction: {
                    required: true
                },
                perils: {
                    required: true, 
                },
                premiumWarrantyPayable: {
                    required: true, 
                },
                treatyLimitCoInsurance: {
                    required: true,
                    number: true
                },
                treatyLimitCoFacultative: {
                    required: true,
                    number: true
                },
                // sumInsured: {
                //     required: true,
                //     number: true
                // },
                // riskCovered: {
                //     required: true,
                // },
                riskCoveredIds: {
                    required: true,
                },
                // mpl_value: {
                //     required: true,
                //     number: true
                // },
                // mplError: {
                //     required: true
                // },
                payment_terms: {
                    required: true
                },
                treatyComments: {
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

                var FormData = $("#TreatySlipForm").serialize();

                $.ajax({
                    url:$("#TreatySlipForm").attr("action"),
                    type: 'POST',
                    data:FormData,
                    dataType: 'json',
                    success: function (response)
                    {
                        $(".h_heading").text(response.message);
                        if(response.code == 1)
                        {
                            if(response.entity != null)
                            {
                                $(".HiddentreatySlipGeneralId").val(response.entity.id);
                            }


                            $('#modaldemo4').modal('show');
                        }else if(response.code == 0){
                            $('#modal_error').modal('show');
                        }
                    }
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

// treaty Layer Form Validation
var FormValidator_Layer = function () {

    var AddRecordValidation = function () {
        var form1 = $('#treaty_layer_form');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#treaty_layer_form').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            },
            ignore: "",
            rules: {

                layer_name: {
                    required: true
                },
                treatySubType: {
                    required: true
                },
                coMaxRetention: {
                    required: true
                },
                treatyLimit: {
                    required: true,
                    number: true
                },
                prcShare: {
                    required: true,
                    number: true
                },
                prcMaxLiability: {
                    required: true,
                    number: true
                },
                fixRates: { 
                    number: true
                },
                minRates: { 
                    number: true
                },
                maxRates: { 
                    number: true
                },
                adjRates: {
                    required: true,
                    number: true
                },
                mndp: {
                    required: true,
                    number: true
                },
                mndpPrcShare: {
                    required: true,
                    number: true
                },
                depositePerimum: { 
                    number: true
                },
                noOfIntallment: {
                    required: true,
                    number: true
                },
                deductable: {
                    required: true,
                    number: true
                },
                bc: {
                    required: true, 
                },
                annualAggregatePrc: {
                    required: true,
                    number: true
                },
                estimatedGnpi: {
                    required: true,
                    number: true
                },
                noOfReinstatement: {
                    required: true,
                    number: true
                },
                layerDescription: {
                    required: true
                },
                basisofRecovery: {
                    required: true,
                },
                // risk: {
                //     required: true,
                // },
                // lossOccurancy: {
                //     required: true,
                // },

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

                $('#treaty_layer_form :input[type=submit]').attr('disabled',true);
                var FormData = $("#treaty_layer_form").serialize();

                $.ajax({
                    url:$("#treaty_layer_form").attr("action"),
                    type: 'POST',
                    data:FormData,
                    dataType: 'json',
                    success: function (response)
                    {

                        $("#treatyslip_layerBtn").val("Add");
                        LoadTreatyLayers(TreaterId);
                        $('#layer_treaty_type').prop('selectedIndex',0);

                        $(".h_heading").text(response.message);
                        if(response.code == 1) {
                            $('#modaldemo4').modal('show');
                            $("#treatySlipLayerId").val("");
                            $('#treaty_layer_form')[0].reset();
                            $("#payment_terms_layer").val("");
                            $('.payment_terms_desc_layer').html('');
                            $('#layer_business_class').val(['']).change();
                            $('#treatySubTypes_layer').val(['']).change();
                            DefaultLayoutPRCShare();
                            DefaultLayoutlayerMndp();
                            $("#PrcShare_layerRows").val("");
                            $("#MNDP_layerRows").val("");

                            if(TypeOfEndorsement !='')
                            {
                                $("#adjRates").attr("readonly",false);
                                $("#annualAggregatePrc").attr("readonly",false);
                                $("#basisofRecovery").attr("readonly",false);
                                $("#bc").attr("readonly",false);
                                $("#coMaxRetention").attr("readonly",false);
                                $("#comanLiability").attr("readonly",false);
                                $("#deductable").attr("readonly",false);
                                $("#depositePerimum").attr("readonly",false);
                                $("#estimatedGnpi").attr("readonly",false);
                                $("#fixRates").attr("readonly",false);
                                $("#lossOccurancy").attr("readonly",false);
                                $("#calculatedGNPI").attr("readonly",false);
                                $("#excessLimit").attr("readonly",false);
                                $("#maxRates").attr("readonly",false);
                                $("#minRates").attr("readonly",false);
                                $("#mdp_100_percentage").attr("readonly",false);
                                $("#mdp_field").attr("readonly",false);
                                $("#noOfIntallment").attr("readonly",false);
                                $("#noOfReinstatement").attr("readonly",false);
                                $("#prcMaxLiability").attr("readonly",false);
                                $(".prc_share_percentage").attr("readonly",false);
                                $("#risk").attr("readonly",false);
                                $("#treatyLimit").attr("readonly",false);
                                $("#layerDescription").attr("readonly",true);
                                $("#layerName").attr("readonly",true);
                            }

                        }else if(response.code == 0){
                            $('#modal_error').modal('show');
                        }
                        $('#treaty_layer_form :input[type=submit]').attr('disabled',false);
                    }
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

// treaty Section Form Validation
var FormValidator_section = function () {

    var AddRecordValidation = function () {
        var form1 = $('#treaty_section_form');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#treaty_section_form').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                if (element.attr("name") == "quotaCompanyRetention" ) { error.insertAfter('.quotaCompanyRetentionError'); }
                else if (element.attr("name") == "quotaCompanyRetentionOf" ) { error.insertAfter('.quotaCompanyRetentionOfError'); }
                else if (element.attr("name") == "section_reInsurerLiabilityPrcShare" ) { error.insertAfter('.section_reInsurerLiabilityPrcShareError'); }
                else if (element.attr("name") == "surplusQuotaShareCommission" ) { error.insertAfter('.surplusQuotaShareCommissionError'); }
                else if (element.attr("name") == "surplusQuotaShareCommissionOf" ) { error.insertAfter('.surplusQuotaShareCommissionOfError'); }
                else if (element.attr("name") == "riCommission" ) { error.insertAfter('.riCommissionError'); }
                else if(element.hasClass('select2') && element.next('.select2-container').length) {
                    error.insertAfter(element.next('.select2-container'));
                }
                else{
                    error.insertAfter(element);
                }
            },
            ignore: "",
            rules: {

                sectionName: {
                    required: true
                },
                quotaCompanyRetention: {
                    required: true,
                    number: true
                },
                quotaCompanyRetentionOf: {
                    required: true,
                    number: true
                },
                surplusQuotaShareCommission: {
                    required: true,
                    number: true
                },
                surplusQuotaShareCommissionOf: {
                    required: true,
                    number: true
                },
                surplusCompanyRetention: {
                    required: true,
                    number: true
                },
                surplusCession: {
                    required: true,
                    number: true
                },
                surplusMPL: {
                    required: true,
                    number: true
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
                $('#treaty_section_form :input[type=submit]').attr('disabled',true);
                var FormData = $("#treaty_section_form").serialize();
                $.ajax({
                    url:$("#treaty_section_form").attr("action"),
                    type: 'POST',
                    data:FormData,
                    dataType: 'json',
                    success: function (response)
                    {


                        $("#treatyslip_sectionBtn").val("Add");
                        LoadTreatySections(TreaterId)

                        $(".h_heading").text(response.message);
                        if(response.code == 1)
                        {
                            $("#treatySlipSectionId").val("");
                            $('#treaty_section_form')[0].reset();
                            $('#modaldemo4').modal('show');
                            $('#section_treatySubTypes').val(['']).change();
                            if(TypeOfEndorsement !='')
                            {
                                $("#quotaCompanyRetention").attr("readonly",false);
                                $("#quotaCompanyRetentionOf").attr("readonly",false);
                                $("#surplusQuotaShareCommission").attr("readonly",false);
                                $("#surplusQuotaShareCommissionOf").attr("readonly",false);
                                $("#surplusCompanyRetention").attr("readonly",false);
                                $("#surplusCession").attr("readonly",false);
                                $("#surplusMPL").attr("readonly",false);
                                $("#riRate").attr("readonly",false);
                                $("#premium").attr("readonly",false);
                                $("#riCommission").attr("readonly",false);
                                // $("#premiumRate").attr("readonly",false);
                                $("#rate_section_quota").attr("readonly",false);
                                $("#rate_section_surplus").attr("readonly",false);
                                $("#value_section_quota").attr("readonly",false);
                                $("#value_section_surplus").attr("readonly",false);
                                $("#prcShare_percentage_quota").attr("readonly",false);
                                $("#prcShare_percentage_surplus").attr("readonly",false);
                                $("#PRCLShare_section_quota").attr("readonly",false);
                                $("#PRCLShare_section_surplus").attr("readonly",false);
                                $("#profitCommission_section").attr("readonly",false);
                                $("#treatySubLimit").attr("readonly",false);
                                $("#sectionName").attr("readonly",false);
                                $("#section_quata_Description").attr("readonly",false);
                                $("#section_surplus_Description").attr("readonly",false);
                            }


                        }
                        else if(response.code == 0){1
                            $('#modal_error').modal('show');
                        }
                        $('#treaty_section_form :input[type=submit]').attr('disabled',false);
                    }
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

// treaty Layer Reinstatement Form Validation
var FormValidator_Layer_Reinstatement = function () {

    var AddRecordValidation = function () {
        var form1 = $('#treaty_layer_Instatementform');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#treaty_layer_Instatementform').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            },
            ignore: "",
            rules: {

                reinstatement: {
                    required: true
                },
                additionalProPermiumRate: {
                    required: true
                },
                instDueDate: {
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

                $('#treaty_layer_Instatementform :input[type=submit]').attr('disabled',true);
                $.ajax({
                    url:$("#treaty_layer_Instatementform").attr("action"),
                    type: 'POST',
                    data:$("#treaty_layer_Instatementform").serialize(),
                    dataType: 'json',
                    success: function (response)
                    {

                        $('#treaty_layer_Instatementform :input[type=submit]').attr('disabled',false);
                        $('input[name="treatyslip_layer_reinstatement"]').val("Create");
                        LoadTreatyLayerReinstatement(TreaterId);

                        $('#ReinstatementModal').modal('hide');

                        $(".h_heading").text(response.message);
                        if(response.code == 1)
                        {
                            $("#TreatyLayerId_Reinstatement").val("");
                            $('#treaty_layer_Instatementform')[0].reset();
                            $('#modaldemo4').modal('show');

                            if(TypeOfEndorsement !='')
                            {
                                $("#additionalProPermiumRate").attr("readonly",false);
                                $("#reinstatement").attr("readonly",false);
                                $('#instDueDate').attr("readonly",false);
                            }

                        }else if(response.code == 0){
                            $('#modal_error').modal('show');
                        }
                    }
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

// treaty Section Form Validation
var FormValidator_Section_class = function () {

    var AddRecordValidation = function () {
        var form1 = $('#treaty_section_classForm');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#treaty_section_classForm').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                if (element.attr("name") == "prcMaxLiability" ) { error.insertAfter('.prcMaxLiabilityError'); }
                else{
                    error.insertAfter(element);
                }
            },
            ignore: "",
            rules: {

                sectionName: {
                    required: true
                },
                className: {
                    required: true
                },
                corManRefention: {
                    required: true
                },
                treatyLimit: {
                    required: true
                },
                prcShare: {
                    required: true
                },
                prcMaxLiability: {
                    required: true
                },
                classCommission: {
                    required: true
                },
                pc: {
                    required: true
                },
                lcf: {
                    required: true
                },
                me: {
                    required: true
                },
                locAdvice: {
                    required: true
                },
                cashLoss: {
                    required: true
                },
                portPremium: {
                    required: true
                },
                portLoss: {
                    required: true
                },
                epi: {
                    required: true
                },
                epiPrc: {
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

                $('#treaty_section_classForm :input[type=submit]').attr('disabled',true);

                $.ajax({
                    url:$("#treaty_section_classForm").attr("action"),
                    type: 'POST',
                    data:$("#treaty_section_classForm").serialize(),
                    dataType: 'json',
                    success: function (response)
                    {

                        $('#treaty_section_classForm :input[type=submit]').attr('disabled',false);
                        $('#treatyslip_section_classBtn').val("Create");
                        LoadTreatySectionsClasses(TreaterId);

                        $('#SectionClassModal').modal('hide');

                        $(".h_heading").text(response.message);
                        if(response.code == 1)
                        {
                            $("#treatySectionId_sectionClass").val("");
                            $('#treaty_section_classForm')[0].reset();
                            $('#modaldemo4').modal('show');


                            if(TypeOfEndorsement !='')
                            {
                                $("#corManRefention").attr("readonly",false);
                                $("#treatyLimit_field").attr("readonly",false);
                                $("#prcShare_field").attr("readonly",false);
                                $("#prcMaxLiability_field").attr("readonly",false);
                                $("#classCommission").attr("readonly",false);
                                $("#pc").attr("readonly",false);
                                $("#lcf").attr("readonly",false);
                                $("#me").attr("readonly",false);
                                $("#locAdvice").attr("readonly",false);
                                $("#cashLoss").attr("readonly",false);
                                $("#portPremium").attr("readonly",false);
                                $("#portLoss").attr("readonly",false);
                                $("#epi_field").attr("readonly",false);
                                $("#epiPrc_field").attr("readonly",false);
                                $("#className").attr("readonly",false);

                            }

                        }
                        else if(response.code == 0){
                            $('#modal_error').modal('show');
                        }
                    }
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

// treaty Sliding Scale Form Validation
var FormValidator_SlidingScale = function () {

    var AddRecordValidation = function () {
        var form1 = $('#TreatySlipSlidingScaleForm');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#TreatySlipSlidingScaleForm').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            },
            ignore: "",
            rules: {

                slidingCommission: {
                    required: true,
                    number: true
                },
                slidingLossRatio: {
                    required: true,
                    number: true
                },
                slidingScale: {
                    required: true, 
                },
                combineRatio: {
                    required: true,
                    number: true
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
                $('#TreatySlipSlidingScaleForm :input[type=submit]').attr('disabled',true);
                $.ajax({
                    url:$("#TreatySlipSlidingScaleForm").attr("action"),
                    type: 'POST',
                    data:$("#TreatySlipSlidingScaleForm").serialize(),
                    dataType: 'json',
                    success: function (response)
                    {

                        $('#treatyslip_slidingScaleBtn').val("Create");
                        LoadTreatySlidingScales(TreaterId,ObjSlidingScale);
                        $('#TreatySlipSlidingScaleForm :input[type=submit]').attr('disabled',false);

                        $(".h_heading").text(response.message);
                        if(response.code == 1)
                        {
                            $("#treatySlipslidingScaleId").val("");
                            $('#TreatySlipSlidingScaleForm')[0].reset();
                            $('#sliding_treaty_type option[value=""]').attr('selected','selected');
                            $('#sliding_business_class').val('').change();
                            $('#slidingScale_treatySubTypes').val(['']).change();

                            $('#modaldemo4').modal('show');
                            if(TypeOfEndorsement !='')
                            {
                                $("#slidingCommission").attr("readonly",false);
                                $("#slidingLossRatio").attr("readonly",false);
                                $("#combineRatio").attr("readonly",false);
                                $('#slidingScaleOptions').attr("readonly",false);
                            }

                        }else if(response.code == 0){
                            $('#modal_error').modal('show');
                        }
                    }
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


// treaty Layer Reinstatement Form Validation
var FormValidator_LossHistory = function () {

    var AddRecordValidation = function () {
        var form1 = $('#loss_history_form');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#loss_history_form').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                error.insertAfter(element);
            },
            ignore: "",
            rules: {

                outStandingLoss: {
                    required: true,
                    number: true
                },
                lossPaid: {
                    required: true,
                    number: true
                },
                cashCallLog: {
                    required: true,
                    number: true
                },
                lossAdvice: {
                    required: true,
                    number: true
                },
                lossCarryForward: {
                    required: true,
                    number: true
                },
                technicalBalance: {
                    required: true,
                    number: true
                },
                lossesIncurred: {
                    required: true,
                    number: true
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

                var url = $('#loss_history_form').attr('action');
                var type = $('#loss_history_form').attr('method');
                var formData = $('#loss_history_form').serialize();

                $.ajax({
                    url 		: url,
                    type 		: type,
                    data 		: formData,
                    dataType    : 'json',
                    success: function (res) {
                        var resCode = res.data.code;
                        if (resCode==1) {
                            $('[href=#next] ').trigger('click');
                        }
                    }

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

function LoadTreatyLayers(TreaterId)
{
    $.ajax({
        url:base_url+"/Treaty/LoadTreatySlipServices",
        type: 'POST',
        data:{"TreaterId":TreaterId,"service_type":'treaty_layers'},
        dataType: 'json',
        success: function (response)
        {
            var html = "";
            $.each(response, function(i, item)
            { 
                html += '<tr class="">';
                html += '<td> ' + item.layerName +' </td>';
                html += '<td>'+item.BusnessClasses+'</td>';
                if(typeof(item.treatyTypeDTO) != "undefined" && item.treatyTypeDTO !== null) {
                    html += '<td> ' + item.treatyTypeDTO.type+' </td>';
                }else{
                    html += '<td>null</td>';
                }
                html += '<td>'+item.treatySubTypes+'</td>';
                html += '<td>'+item.coMaxRetentionPercent+'</td>';
                html += '<td>'+item.coMaxRetention+'</td>';
                html += '<td> ' + item.treatyLimitPercent+' </td>';
                html += '<td> ' + item.treatyLimit+' </td>';
                html += '<td> ' + item.prcShare+' </td>';
                html += '<td> ' + item.prcMaxLiability+' </td>';
                html += '<td> ' + item.fixRates+' </td>';
                html += '<td> ' + item.minRates+' </td>';
                html += '<td> ' + item.maxRates+' </td>';
                html += '<td> ' + item.adjRates+' </td>';
                html += '<td> ' + item.mndp+' </td>';
                html += '<td> ' + item.mndpPrcShare+' </td>';
                html += '<td> ' + item.depositePerimum+' </td>';
                html += '<td> ' + item.noOfIntallment+' </td>';
                html += '<td> ' + item.bc+' </td>';
                html += '<td> ' + item.annualAggregatePrc+' </td>';
                html += '<td> ' + item.noOfReinstatement+' </td>';
                html += '<td> ' + item.layerDescription+' </td>';
                html += '<td> ' + item.paymentTerm+' </td>';
                html += '<td  > ' + item.PaymentTermRanges+' </td>';
                html += '<td><button type="button" class="btn btn-success tx-12 tx-uppercase tx-spacing-2" onclick="LoadLayerData('+item.id+');">Edit</button></td>';
                html += '<td><button type="button" class="btn btn-danger tx-12 tx-uppercase tx-spacing-2 delete_btn" onclick="ShowDeleteDataModal('+item.id+',\'delete_layer\');">Delete</button></td>';
                html += '<td><a href="javascript:void(0)" class="anchor" onclick="ShowReinstatmentModal('+item.id+');">Reinstatement</a></td>';
                html += "</tr>";


            });

            $(".table_tbody").html(html);
        }
    });
}

function LoadTreatySections(TreaterId)
{
    $.ajax({
        url:base_url+"/Treaty/LoadTreatySlipServices",
        type: 'POST',
        data:{"TreaterId":TreaterId,"service_type":'treaty_sections'},
        dataType: 'json',
        success: function (response)
        { 
            var currencyCode =  response.currencyCode;
            var html = "";
            $.each(response.SectionData, function(i, item)
            {
 
                html += '<tr class="">';
                html += '<td>' + item.sectionName+'</td>';
                html += '<td>' + currencyCode+'</td>';
                html += '<td>' + item.treatySubTypes+'</td>';
                html += '<td>' + item.BusnessClasses+'</td>'; 

                html += '<td>' + item.treatySubLimit+'</td>';
                html += '<td>' + item.prcShareRate+'</td>';
                html += '<td>' + item.prcShareValue+'</td>';
                html += '<td>' + item.descriptionTreatySubLimit+'</td>';

                html += '<td>' + item.prcShareRateQuota+'</td>';
                html += '<td>' + item.grossRetentionQuota+'</td>';
                html += '<td>' + item.quotaCompanyRetention+'</td>';
                html += '<td>' + item.quotaCompanyRetentionOf+'</td>';
                html += '<td>' + item.reinsuranceCommissionRateQouta+'</td>';
                html += '<td>' + item.cededShareRate+'</td>';
                html += '<td>' + item.reInsurerLiability+'</td>';
                html += '<td>' + item.reInsurerLiabilityPrcShare+'</td>';
                html += '<td>' + item.mplQuota+'</td>';
                html += '<td>' + item.mplErrorQuota+'</td>';
                html += '<td>' + item.description1+'</td>';

                html += '<td>' + item.surplusQuotaShareCommission+'</td>';
                html += '<td>' + item.surplusQuotaShareCommissionOf+'</td>';
                html += '<td>' + item.surplusCompanyRetention+'</td>';
                html += '<td>' + item.surplusCession+'</td>';
                html += '<td>' + item.reinsuranceCommissionRateSurplus+'</td>';
                html += '<td>' + item.premium+'</td>';
                html += '<td>' + item.riCommission+'</td>';
                html += '<td>' + item.description2+'</td>';
                html += '<td>' + item.profitCommission+'</td>';
                html += '<td>' + item.grossRetentionSurplus+'</td>';
                html += '<td>' + item.originalGrossRateSurplus+'</td>';
                html += '<td>' + item.noOfLines+'</td>';
                html += '<td>' + item.profitCommissionRate+'</td>';
                html += '<td>' + item.lossesCarryForward+'</td>';
                html += '<td>' + item.mplSurplus+'</td>';
                html += '<td>' + item.mplErrorSurplus+'</td>';
                html += '<td>' + item.surplusLimit+'</td>';


                html += '<td><button type="button" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 " onclick="LoadSectionData('+item.id+');">Edit</button></td>';
                html += '<td><button type="button" class="btn btn-danger tx-12 tx-uppercase tx-spacing-2" onclick="ShowDeleteDataModal('+item.id+',\'delete_section\');">Delete</button></td>';
                html += '<td><a href="javascript:void(0)" class="anchor section_classes"  onclick="ShowSectionClassModal('+item.id+');">Classes</a></td>';

                html += "</tr>";

            });

            $(".table_tbody_section").html(html);
        }
    });
}

function LoadLayerData(treaty_layerid)
{

    $.ajax({
        url:base_url+"/Treaty/LoadTreatySlipServices",
        type: 'POST',
        data:{"treaty_layerid":treaty_layerid,"service_type":'signle_treaty_layer'},
        dataType: 'json',
        success: function (response)
        {

            $("#adjRates").val(parseFloat(response.adjRates));
            $("#annualAggregatePrc").val(parseFloat(response.annualAggregatePrc));
            $("#basisofRecovery").val(response.basisofRecovery);
            $("#bc").val(response.bc);
            $("#coMaxRetentionPercent").val(response.coMaxRetentionPercent);
            $("#coMaxRetention").val(response.coMaxRetention);
            $("#comanLiability").val(response.comanLiability);
            $("#deductable").val(response.deductable);
            $("#depositePerimum").val(response.depositePerimum);
            $("#estimatedGnpi").val(parseFloat(response.estimatedGnpi));
            $("#fixRates").val(parseFloat(response.fixRates));
            $("#layerDescription").val(response.layerDescription);
            $("#layerName").val(response.layerName);
            $("#lossOccurancy").val(response.lossOccurancy);
            $("#calculatedGNPI").val(response.calculatedGNPI);
            $("#excessLimit").val(response.excessLimit);
            $("#maxRates").val(parseFloat(response.maxRates));
            $("#minRates").val(parseFloat(response.minRates));
            $("#mdp_100_percentage").val(parseFloat(response.mndp));
            $("#mdp_field").val(parseFloat(response.mndpPrcShare));
            $("#noOfIntallment").val(response.noOfIntallment);
            $("#noOfReinstatement").val(response.noOfReinstatement);
            $("#prcMaxLiability").val(parseFloat(response.prcMaxLiability));
            $(".prc_share_percentage").val(parseFloat(response.prcShare));
            $("#risk").val(response.risk);
            $("#treatyLimit").val(response.treatyLimit);
            $("#treatyLimitPercent").val(response.treatyLimitPercent);

            $("#treatySlipLayerId").val(response.id);
            $("#treatyslip_layerBtn").val("Update");

            $('#treatySubTypes_layer').val(response.treatySubTypes).change();
            $('#layer_business_class').val(response.BusnessClasses).change();
            if(typeof(response.treatyTypeDTO) != "undefined" && response.treatyTypeDTO !== null) {
                $('#layer_treaty_type option[value='+response.treatyTypeDTO.id+']').attr('selected','selected');
            } 

            if(TypeOfEndorsement !='' && TypeOfEndorsement =='NonFinancial')
            {
                $("#adjRates").attr("readonly",true);
                $("#annualAggregatePrc").attr("readonly",true);
                $("#basisofRecovery").attr("readonly",true);
                $("#bc").attr("readonly",true);
                $("#coMaxRetention").attr("readonly",true);
                $("#comanLiability").attr("readonly",true);
                $("#deductable").attr("readonly",true);
                $("#depositePerimum").attr("readonly",true);
                $("#estimatedGnpi").attr("readonly",true);
                $("#fixRates").attr("readonly",true);
                $("#lossOccurancy").attr("readonly",true);
                $("#calculatedGNPI").attr("readonly",true);
                $("#excessLimit").attr("readonly",true);
                $("#maxRates").attr("readonly",true);
                $("#minRates").attr("readonly",true);
                $("#mdp_100_percentage").attr("readonly",true);
                $("#mdp_field").attr("readonly",true);
                $("#noOfIntallment").attr("readonly",true);
                $("#noOfReinstatement").attr("readonly",true);
                $("#prcMaxLiability").attr("readonly",true);
                $(".prc_share_percentage").attr("readonly",true);
                $("#risk").attr("readonly",true);
                $("#treatyLimit").attr("readonly",true);
                $('#payment_terms_layer').attr("readonly",true);
            }

            if(TypeOfEndorsement !='' && TypeOfEndorsement =='Financial')
            {
                $("#layerDescription").attr("readonly",true);
                $("#layerName").attr("readonly",true);
            }


            LoadSelectedlayerMndp(response.layerMndpDTOS);
            LoadSelectedPRCS(response.layerPrcShareDTOS);
            GetPaymentRanges(response.paymentTermRangeDTOs,'.payment_terms_desc_layer',TypeOfEndorsement);

            if(response.paymentTerm =='yearly')
            {
                $('#payment_terms_layer').val('yearly');
            }
            else if(response.paymentTerm =='bi_annually')
            {
                $('#payment_terms_layer').val('bi_annually');
            }
            else if(response.paymentTerm =='quarterly')
            {
                $('#payment_terms_layer').val('quarterly');
            }
            else if(response.paymentTerm =='monthly')
            {
                $('#payment_terms_layer').val('monthly');
            }
            else if(response.paymentTerm =='manual')
            {
                $('#payment_terms_layer').val('manual');
            }

            var form = $('#treaty_layer_form');
            form.validate();
            form.valid();


        }});
}

function LoadSectionData(secton_id)
{

    $.ajax({
        url:base_url+"/Treaty/LoadTreatySlipServices",
        type: 'POST',
        data:{"SectionId":secton_id,"service_type":'signle_section'},
        dataType: 'json',
        success: function (response)
        {

            $("#sectionName").val(response.sectionName);
            $("#quotaCompanyRetention").val(response.quotaCompanyRetention);
            $("#quotaCompanyRetentionOf").val(response.quotaCompanyRetentionOf);
            $("#surplusQuotaShareCommission").val(response.surplusQuotaShareCommission);
            $("#surplusQuotaShareCommissionOf").val(response.surplusQuotaShareCommissionOf);
            $("#surplusCompanyRetention").val(response.surplusCompanyRetention);
            $("#surplusCession").val(response.surplusCession);
            $("#surplusMPL").val(response.surplusMPL);
            $("#reinsuranceCommissionRateSurplus").val(response.reinsuranceCommissionRateSurplus);
            $("#premium").val(response.premium);
            $("#riCommission").val(response.riCommission);
            $("#cededShareRate").val(response.cededShareRate);

            // $("#premiumRate").val(response.premiumRate);
            // $("#rate_section_quota").val(response.rate1);
            // $("#rate_section_surplus").val(response.rate2);
            // $("#value_section_quota").val(response.value1);
            // $("#value_section_surplus").val(response.value2);
            // $("#prcShare_percentage_quota").val(response.prclSharePercentage1);
            // $("#prcShare_percentage_surplus").val(response.prclSharePercentage2);
            // $("#PRCLShare_section_quota").val(response.prclShare1);
            // $("#PRCLShare_section_surplus").val(response.prclShare2);
            $("#section_quata_Description").val(response.description1);
            $("#section_surplus_Description").val(response.description2);
            $("#profitCommission_section").val(response.profitCommission);
            $("#treatySubLimit").val(response.treatySubLimit); 
            $("#section_prcShareRate").val(response.prcShareRate); 
            $("#section_prcShareValue").val(response.prcShareValue); 
            $("#descriptionTreatySubLimit").val(response.descriptionTreatySubLimit); // missing from service side
            $("#section_prcShareRateQuota").val(response.prcShareRateQuota);
            $("#section_grossRetentionQuota").val(response.grossRetentionQuota); 
            $("#reinsuranceCommissionRateQouta").val(response.reinsuranceCommissionRateQouta); // missing from service side 
            $("#section_reInsurerLiability").val(response.reInsurerLiability); 
            $("#section_reInsurerLiabilityPrcShare").val(response.reInsurerLiabilityPrcShare); 
            $("#section_mplQuota").val(response.mplQuota); 
            $("#section_mplErrorQuota").val(response.mplErrorQuota); 
            $("#section_grossRetentionSurplus").val(response.grossRetentionSurplus); 
            $("#section_originalGrossRateSurplus").val(response.originalGrossRateSurplus); 
            $("#section_noOfLines").val(response.noOfLines); 
            $("#section_profitCommissionRate").val(response.profitCommissionRate); 
            $("#section_lossesCarryForward").val(response.lossesCarryForward); 
            $("#section_mplSurplus").val(response.mplSurplus); 
            $("#section_mplErrorSurplus").val(response.mplErrorSurplus); 
            $("#surplusLimit").val(response.surplusLimit); 


            $("#treatySlipSectionId").val(response.id);
            $("#treatyslip_sectionBtn").val("Update");

            $('#section_treatySubTypes').val(response.treatySubTypes).change();
            $('#section_business_class1').val(response.BusnessClasses).change();

            if(TypeOfEndorsement !='' && TypeOfEndorsement =='NonFinancial')
            {
                $("#quotaCompanyRetention").attr("readonly",true);
                $("#quotaCompanyRetentionOf").attr("readonly",true);
                $("#surplusQuotaShareCommission").attr("readonly",true);
                $("#surplusQuotaShareCommissionOf").attr("readonly",true);
                $("#surplusCompanyRetention").attr("readonly",true);
                $("#surplusCession").attr("readonly",true);
                $("#surplusMPL").attr("readonly",true);
                $("#riRate").attr("readonly",true);
                $("#premium").attr("readonly",true);
                $("#riCommission").attr("readonly",true);

                // $("#premiumRate").attr("readonly",true);
                $("#rate_section_quota").attr("readonly",true);
                $("#rate_section_surplus").attr("readonly",true);
                $("#value_section_quota").attr("readonly",true);
                $("#value_section_surplus").attr("readonly",true);
                $("#prcShare_percentage_quota").attr("readonly",true);
                $("#prcShare_percentage_surplus").attr("readonly",true);
                $("#PRCLShare_section_quota").attr("readonly",true);
                $("#PRCLShare_section_surplus").attr("readonly",true);
                $("#profitCommission_section").attr("readonly",true);
                $("#treatySubLimit").attr("readonly",true);
            }

            if(TypeOfEndorsement !='' && TypeOfEndorsement =='Financial')
            {
                $("#sectionName").attr("readonly",true);
                $("#section_quata_Description").attr("readonly",true);
                $("#section_surplus_Description").attr("readonly",true);
            }

            var form = $('#treaty_section_form');
            form.validate();
            form.valid();

        }});
}


function ShowDeleteDataModal(Id,serviceType)
{
    $("#id").val(Id);
    $("#serviceType_delete").val(serviceType);
    $(".h_heading").text('Do you want to delete this Record?');
    $('#modaldemo5').modal('show');

}

$(".delete_recordBtn").on("click",function(e)
{
    var Id = $("#id").val();
    var service_type = $("#serviceType_delete").val();

    if(service_type !='' && service_type !='undefined')
    {
            $.ajax({
                url: base_url+"Treaty/LoadTreatySlipServices",
                type: 'POST',
                data:{"id":Id,"service_type":service_type},
                dataType: 'json',

                success: function (response)
                {

                    $(".h_heading").text(response.message);
                    $('#modaldemo4').modal('show');
                    $('#modaldemo5').modal('hide');
                    console.log(service_type);
                    if(service_type =='delete_section')
                    {
                        LoadTreatySections(TreaterId);
                        LoadTreatySectionsClasses(TreaterId);
                    }

                    if(service_type =='delete_sectionClass')
                    {
                        LoadTreatySectionsClasses(TreaterId);
                    }
                    if(service_type =='delete_layer')
                    {
                        LoadTreatyLayers(TreaterId);
                    }
                    if(service_type =='delete_reinstatement')
                    {
                        LoadTreatyLayerReinstatement(TreaterId);
                        $('#treaty_layer_Instatementform')[0].reset();
                    }
                    if(service_type =='treatySlipSectionClass_delete')
                    {
                        LoadTreatySectionsClasses(TreaterId);
                    }
                    if(service_type =='delete_slidingScale')
                    {
                        LoadTreatySlidingScales(TreaterId,ObjSlidingScale);
                    }


                },
                error: function (r) {
                    console.log('Error in retrieving Site.');
                    console.log(r);
                }
            });
    }

});

function ShowReinstatmentModal(LayerId,ReInstatementId='')
{
    if(ReInstatementId !='')
    {
        $('#treaty_layer_Instatementform')[0].reset();
        $.ajax({
            url:base_url+"/Treaty/LoadTreatySlipServices",
            type: 'POST',
            data:{"ReInstatementId":ReInstatementId,"service_type":'single_reinstatement'},
            dataType: 'json',
            success: function (response)
            {
                $("#additionalProPermiumRate").val(response.additionalProPermiumRate);
                 $("#reinstatement").val(response.reinstatement);
                $("#TreatyLayerId_Reinstatement").val(response.Layerid);
                document.getElementById("instDueDate").value = response.instDueDate;
                $('input[name="treatyslip_layer_reinstatement"]').val("Update");

                if(TypeOfEndorsement !='' && TypeOfEndorsement =='NonFinancial')
                {
                    $("#additionalProPermiumRate").attr("readonly",true);
                    $("#reinstatement").attr("readonly",true);
                    $('#instDueDate').attr("readonly",true);
                }

                var form = $('#treaty_layer_Instatementform');
                form.validate();
                form.valid();

            }
        });
    }

    $("#TreatyLayerId_Reinstatement").val(LayerId);
    $("#ReinstatementId").val(ReInstatementId);
    $('#ReinstatementModal').modal('show');


}


function LoadTreatyLayerReinstatement(TreaterId)
{
    $.ajax({
        url:base_url+"/Treaty/LoadTreatySlipServices",
        type: 'POST',
        data:{"TreaterId":TreaterId,"service_type":'treaty_reinstatement'},
        dataType: 'json',
        success: function (response)
        {
            var html = "";
            $.each(response, function (i, item)
            {
                html += '<tr class="">';
                html += '<td>'+item.LayerName+'</td>';
                html += '<td>'+item.reinstatement+'</td>';
                html += '<td>'+item.additionalProPermiumRate+'</td>';
                html += '<td>'+item.instDueDate+'</td>';
                html += '<td><button type="button" class="btn btn-success tx-12 tx-uppercase tx-spacing-2" onclick="ShowReinstatmentModal(\'\','+item.id+')">Edit</button></td>';
                html += '<td><button type="button" class="btn btn-danger tx-12 tx-uppercase tx-spacing-2" onclick="ShowDeleteDataModal('+item.id+',\'delete_reinstatement\');">Delete</button></td>';
                html += "</tr>";

            });
            $(".table_tbody_re").html(html);
        }
    });
}

function ShowSectionClassModal(SectionId,SectionClassId='')
{
    $("#treatySectionId_sectionClass").val("");
    $('#treatyslip_section_classBtn').val("Create");
    $("#sectionClassId").val("");
    $('#treaty_section_classForm')[0].reset();
    // $('#treaty_section_classForm help-block').hide();

    if(SectionClassId !='')
    {
        $('#treaty_section_classForm')[0].reset();


        $.ajax({
            url:base_url+"/Treaty/LoadTreatySlipServices",
            type: 'POST',
            data:{"SectionClassId":SectionClassId,"service_type":'single_sectionClass'},
            dataType: 'json',
            success: function (response)
            {
                $("#className").val(response.className);
                $("#corManRefention").val(response.corManRefention);
                $("#treatyLimit_field").val(response.treatyLimit);
                $("#SectionClass_prcShare").val(response.prcShare);
                $("#prcMaxLiability_field").val(response.prcMaxLiability);
                $("#classCommission").val(response.classCommission);
                $("#pc").val(response.pc);
                $("#lcf").val(response.lcf);
                $("#me").val(response.me);
                $("#locAdvice").val(response.locAdvice);
                $("#cashLoss").val(response.cashLoss);
                $("#portPremium").val(response.portPremium);
                $("#portLoss").val(response.portLoss);
                $("#SectionClass_epi_field").val(response.epi);

                $("#SectionClass_EPI_Revised").val(response.epiRevised);
                $("#SectionClass_EPI_Estimated").val(response.epiEstimated);
                $("#SectionClass_epiPrc_field").val(response.epiPrc);
                $("#sectionClass_treatySubTypes").val(response.treatySubTypeDTO.id);
                $("#sectionClassId").val(response.id);
                $("#treatySectionId_sectionClass").val(response.treatySectionDTO.id);
                // alert(response.treatySubTypeDTO.id);

                if(TypeOfEndorsement !='' && TypeOfEndorsement =='NonFinancial')
                {
                    $("#corManRefention").attr("readonly",true);
                    $("#treatyLimit_field").attr("readonly",true);
                    $("#prcShare_field").attr("readonly",true);
                    $("#prcMaxLiability_field").attr("readonly",true);
                    $("#classCommission").attr("readonly",true);
                    $("#pc").attr("readonly",true);
                    $("#lcf").attr("readonly",true);
                    $("#me").attr("readonly",true);
                    $("#locAdvice").attr("readonly",true);
                    $("#cashLoss").attr("readonly",true);
                    $("#portPremium").attr("readonly",true);
                    $("#portLoss").attr("readonly",true);
                    $("#epi_field").attr("readonly",true);
                    $("#epiPrc_field").attr("readonly",true);
                }

                if(TypeOfEndorsement !='' && TypeOfEndorsement =='Financial')
                {
                    $("#className").attr("readonly",true);

                }




                $('input[name="treatyslip_section_class"]').val("Update");
                var form = $('#treaty_section_classForm');
                form.validate();
                form.valid();
            }
        });


    }else{
        $("#treatySectionId_sectionClass").val(SectionId);
        $("#sectionClassId").val(SectionClassId);

    }
    $('#SectionClassModal').modal('show');



}

function LoadTreatySectionsClasses(TreaterId)
{
    $.ajax({
        url:base_url+"/Treaty/LoadTreatySlipServices",
        type: 'POST',
        data:{"TreaterId":TreaterId,"service_type":'treaty_sectionClassess'},
        dataType: 'json',
        success: function (response)
        {
            var html = "";
            $.each(response, function (i, item)
            {

                    html += '<tr class="">';
                    html += '<td>'+item.SectionName+'</td>';
                    html += '<td>'+item.corManRefention+'</td>';
                    html += '<td>'+item.treatyLimit+'</td>';
                    html += '<td>'+item.prcShare+'</td>';
                    html += '<td>'+item.prcMaxLiability+'</td>';
                    html += '<td>'+item.classCommission+'</td>';
                    html += '<td>'+item.pc+'</td>';
                    html += '<td>'+item.lcf+'</td>';
                    html += '<td>'+item.me+'</td>';
                    html += '<td>'+item.locAdvice+'</td>';
                    html += '<td>'+item.cashLoss+'</td>';
                    html += '<td>'+item.portPremium+'</td>';
                    html += '<td>'+item.portLoss+'</td>';
                    html += '<td>'+item.epi+'</td>';
                    html += '<td>'+item.epiPrc+'</td>';
                    html += '<td><button type="button" class="btn btn-success tx-12 tx-uppercase tx-spacing-2" onclick="ShowSectionClassModal(\'\','+item.id+')">Edit</button></td>';
                    html += '<td><button type="button" class="btn btn-danger tx-12 tx-uppercase tx-spacing-2" onclick="ShowDeleteDataModal('+item.id+',\'delete_sectionClass\');">Delete</button></td>';
                    html += '<td>-</td>';

                    html += "</tr>";

            });
            $(".table_tbody_re_section").html(html);
        }
    });
}

function LoadTreatySlidingScales(TreaterId,ObjSlidingScale)
{
    $.ajax({
        url:base_url+"/Treaty/LoadTreatySlipServices",
        type: 'POST',
        data:{"TreaterId":TreaterId,"service_type":'SlidingScales'},
        dataType: 'json',
        success: function (response)
        {
            var html = "";
            $.each(response, function (i, item)
            {
                html += '<tr class="">';
                html += '<td>'+item.section+'</td>';
                if(typeof(item.treatyTypeDTO) != "undefined" && item.treatyTypeDTO !== null) {
                    html += '<td>'+item.treatyTypeDTO.type+'</td>';
                }else{
                    html += '<td>null</td>';
                }
                html += '<td>'+item.treatySubTypes+'</td>';
                html += '<td>'+item.BusnessClasses+'</td>';
               
                html += '<td>'+item.rate+'</td>';
                html += '<td>'+item.slidingLossRatio+'</td>';
                html += '<td>'+ObjSlidingScale[item.slidingScale]+'</td>';
                html += '<td>'+item.combineRatio+'</td>';
                html += '<td>'+item.slidingCommission+'</td>';
                html += '<td>'+item.description+'</td>';
                html += '<td><button type="button" class="btn btn-success tx-12 tx-uppercase tx-spacing-2" onclick="EditTreatySlidingScale('+item.id+')">Edit</button></td>';
                html += '<td><button type="button" class="btn btn-danger tx-12 tx-uppercase tx-spacing-2" onclick="ShowDeleteDataModal('+item.id+',\'delete_slidingScale\');">Delete</button></td>';
                html += "</tr>";

            });
            $(".table_tbody_sst").html(html);
        }
    });
}

function EditTreatySlidingScale(SlidingScaleId)
{
    $.ajax({
        url:base_url+"/Treaty/LoadTreatySlipServices",
        type: 'POST',
        data:{"id":SlidingScaleId,"service_type":'single_slidingScale'},
        dataType: 'json',
        success: function (response)
        {
            $("#sectionName_slidingScale").val(response.section);
            $("#Sliding_Rate").val(response.rate);
            $("#SlidingDescription").val(response.description);
            $("#slidingCommission").val(response.slidingCommission);
            $("#slidingLossRatio").val(response.slidingLossRatio);
            $("#combineRatio").val(response.combineRatio);
            $('#slidingScaleOptions option[value='+response.slidingScale+']').attr('selected','selected');

            if(typeof(response.treatyTypeDTO) != "undefined" && response.treatyTypeDTO !== null) {
                $('#sliding_treaty_type option[value='+response.treatyTypeDTO.id+']').attr('selected','selected');
            }

            $('#sliding_business_class').val(response.BusnessClasses).change();
            $('#slidingScale_treatySubTypes').val(response.treatySubTypes).change();

            if(TypeOfEndorsement !='' && TypeOfEndorsement =='NonFinancial')
            {
                $("#slidingCommission").attr("readonly",true);
                $("#slidingLossRatio").attr("readonly",true);
                $("#combineRatio").attr("readonly",true);
                $('#slidingScaleOptions').attr("readonly",true);
            }

            $("#treatySlipslidingScaleId").val(response.id);
            $('input[name="treatyslip_slidingScale"]').val("Update");

            var form = $('#TreatySlipSlidingScaleForm');
            form.validate();
            form.valid();

        }
    });
}

function get1DArray(arr){
    return arr.join().split(",");
}



$(document).on('change', '#otherTreaties', function () {
    var redirectToTreatyUrl = $(this).val();
    // alert(redirectToTreatyUrl);
    if (redirectToTreatyUrl !== null) {
        window.location.replace(redirectToTreatyUrl); 
    } 
});