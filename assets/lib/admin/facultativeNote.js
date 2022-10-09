jQuery(document).ready(function () {
    FormValidator_General.init();
});


// Treaty General Form Validation
var FormValidator_General = function () {

    var AddRecordValidation = function () {
        var form1 = $('#requestNotInfo_Form');
        var errorHandler1 = $('.errorHandler', form1);
        var successHandler1 = $('.successHandler', form1);
        $('#requestNotInfo_Form').validate({
            errorElement: "span", // contain the error msg in a span tag
            errorClass: 'help-block',
            errorPlacement: function (error, element)
            {
                if (element.attr("name") == "facinceptionDate" ) { error.insertAfter('.facinceptionDateErrorDiv'); }
                else{
                    error.insertAfter(element);
                }

                // else if (element.attr("name") == "riCommission" ) { error.insertAfter('.riCommissionError'); }
                // else if(element.hasClass('select2') && element.next('.select2-container').length) {
                //     error.insertAfter(element.next('.select2-container'));
                // }
            },
            ignore: "",
            rules: {
                facinceptionDate: {
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

                var FormData = $("#requestNotInfo_Form").serialize();

                $.ajax({
                    url:$("#requestNotInfo_Form").attr("action"),
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
                                $(".hiddenFacultativeNoteGeneralId").val(response.entity.id);
                            }

                            alert
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


// AjaxFillAllList(base_url+'Cedent/GetCedentOptions', '.SelCedent');
// AjaxFillAllList(base_url+'Insured/GetInsuredOptions', '#SelectInsured');
// AjaxFillAllList(base_url+'Business/GetBusinessClassOptions', '#SelectBusinessClass');
// AjaxFillAllList(base_url+'Cedent/GetCedentOptions/Co-Insurer', '#SelectfacCoInsurer');
if(action == "view_record" || action == "edit_record")
{
    // LoadGeneralData(facultativeNoteId);
    // LoadCoInsurerData(facultativeNoteId);
    // LoadOfferedAcceptedData(facultativeNoteId);
}


function GetSubBusinessClass(businessClassId)
{
    AjaxFillAllList(base_url+'Business/GetBusinessClassOptions/'+businessClassId, '#SelectSubBusinessClass');
}


function LoadGeneralData(facultativeNoteId)
{
    $.ajax({
        url:base_url+"/facultativeNote/GetfacultativeNoteGeneral",
        type: 'POST',
        data:{"facultativeNoteId":facultativeNoteId},
        dataType: 'json',
        success: function (response)
        { 
            
            $("#facinceptionDate").val(response.facinceptionDate);
            $("#facReqNo").val(response.facReqNo);
            $("#facReqDate").val(response.facReqDate);
            if(typeof(response.cedentDTO) != "undefined" && response.cedentDTO !== null) {
                $('#SelCedent').val(response.cedentDTO.id).trigger('change');
            }
            if(typeof(response.insuredDTO) != "undefined" && response.insuredDTO !== null) {
                $('#SelectInsured').val(response.insuredDTO.id).trigger('change');
            }
            $("#facOriginalInsuredName").val(response.facOriginalInsuredName);
            $("#typeOfCoverInterest").val(response.typeOfCoverInterest);
            $("#coverPerilsDetail").val(response.coverPerilsDetail);
            $("#maxProbableLoss").val(response.maxProbableLoss);
            $("#cpDays").val(response.cpDays);
            $("#premiumPaymentWarranty").val(response.premiumPaymentWarranty);
            $("#premiumPaymentWarranty").val(response.premiumPaymentWarranty);
            if(typeof(response.businessDTO) != "undefined" && response.businessDTO !== null) 
            {
                $('#SelectBusinessClass').val(response.businessDTO.id).trigger('change');
                if(typeof(response.businessDTO.subBusinessDTO) != "undefined" && response.businessDTO.subBusinessDTO !== null) 
                {

                    $('#SelectSubBusinessClass').val(response.businessDTO.subBusinessDTO.id).trigger('change');
                }
            } 
            $('#policyType').val(response.policyType).trigger('change');
            $("#underwritingYear").val(response.underwritingYear);
            $("#underwritingQuarter").val(response.underwritingQuarter).trigger('change');
            $("#geoTerritorialLimit").val(response.geoTerritorialLimit);
            $("#CompanyRetention").val(response.companyRetention);
            $("#inLandLimit").val(response.inLandLimit);

            if(response.isRetro == "Yes" && response.isRetro !== null) 
            {
                jQuery("#isRetro_No").attr('checked', false);  
                jQuery("#isRetro_Yes").attr('checked', true);   
            }else{
                jQuery("#isRetro_Yes").attr('checked', false);   
                jQuery("#isRetro_No").attr('checked', true);   
            }
             $("#grossTreatyShare").val(response.grossTreatyShare);
             $("#grossTreatySharePercentage").val(response.grossTreatySharePercentage);
             $("#grossTreatyShareCurrency").val(response.grossTreatyShareCurrency);
             $("#grossTreatyShareAmount").val(response.grossTreatyShareAmount);
             $("#prcTreatyShare").val(response.prcTreatyShare);
             $("#prcTreatySharePercentage").val(response.prcTreatySharePercentage);
             $("#prcTreatyShareCurrecny").val(response.prcTreatyShareCurrecny);
             $("#prcTreatyShareAmount").val(response.prcTreatyShareAmount);
             $("#facRiAbroad").val(response.facRiAbroad);
             $("#facRiAbroadPercentage").val(response.facRiAbroadPercentage);
             $("#facRiAbroadCurrency").val(response.facRiAbroadCurrency);
             $("#facRiAbroadAmount").val(response.facRiAbroadAmount);
             $("#sumInsurred").val(response.sumInsurred);
             $("#sumInsurredPercentage").val(response.sumInsurredPercentage);
             $("#sumInsurredCurrency").val(response.sumInsurredCurrency);
             $("#sumInsuredAmount").val(response.sumInsuredAmount);
             $("#limitLiability").val(response.limitLiability);
             $("#limitLiabilityPercentage").val(response.limitLiabilityPercentage);
             $("#limitLiabilityCurrency").val(response.limitLiabilityCurrency);
             $("#limitLiabilityAmount").val(response.limitLiabilityAmount);
             $("#treatyCapacity").val(response.treatyCapacity);
             $("#treatyCapacityPercentage").val(response.treatyCapacityPercentage);
             $("#treatyCapacityCurrency").val(response.treatyCapacityCurrency);
             $("#treatyCapacityAmount").val(response.treatyCapacityAmount);
             $("#facultativeCapacity").val(response.facultativeCapacity);
             $("#facultativeCapacityPecentage").val(response.facultativeCapacityPecentage);
             $("#facultativeCapacityCurrency").val(response.facultativeCapacityCurrency);
             $("#facultativeCapacityAmount").val(response.facultativeCapacityAmount);
             $("#conveyance").val(response.conveyance);
             $("#vesselCarrier").val(response.vesselCarrier);
             $("#perCarryLimits").val(response.perCarryLimits);
             $("#perTransit").val(response.perTransit);
        }
    });
}

function LoadCoInsurerData(facultativeNoteId)
{
    $.ajax({
        url:base_url+"/facultativeNote/GetfacultativeNoteCoInsurer",
        type: 'POST',
        data:{"facultativeNoteId":facultativeNoteId},
        dataType: 'json',
        success: function (response)
        { 
            if(response.facCoInsurer == "Yes" && response.facCoInsurer !== null) 
            {
                jQuery("#facCoInsurer_no").attr('checked', false);  
                jQuery("#facCoInsurer_yes").attr('checked', true);   
            }else{
                jQuery("#facCoInsurer_yes").attr('checked', false);   
                jQuery("#facCoInsurer_no").attr('checked', true);   
            }
            $('#SelectfacCoInsurer').val(response.facInsurer).trigger('change');
            $("#facInsurerPerc").val(response.facInsurerPerc);
            $("#facInsurerCurrency").val(response.facInsurerCurrency);
            $("#facPrcSharePerc").val(response.facPrcSharePerc);
            $("#facPrcSharePercOf").val(response.facPrcSharePercOf);
            $("#facPrcSharePercOf2").val(response.facPrcSharePercOf2);
            $("#facPrcShare").val(response.facPrcShare);
        }
    });
}

// function LoadOfferedAcceptedData(facultativeNoteId)
// {
//     $.ajax({
//         url:base_url+"/facultativeNote/LoadOfferedAcceptedData",
//         type: 'POST',
//         data:{"facultativeNoteId":facultativeNoteId},
//         dataType: 'json',
//         success: function (response)
//         { 
//             $('#SelectfacCoInsurer').val(response.facInsurer).trigger('change');
//             $("#facInsurerPerc").val(response.facInsurerPerc);
//             $("#facInsurerCurrency").val(response.facInsurerCurrency);
//             $("#facPrcSharePerc").val(response.facPrcSharePerc);
//             $("#facPrcSharePercOf").val(response.facPrcSharePercOf);
//             $("#facPrcSharePercOf2").val(response.facPrcSharePercOf2);
//             $("#facPrcShare").val(response.facPrcShare);
//         }
//     });
// }

DeductibleOptions = '<option value="">Select Deductible</option>';
if(Deductibles !='')
{
    jQuery.each(Deductibles, function(index, item) {
        DeductibleOptions +="<option value='"+item.id+"' >"+item.deductables+"</option>";
    });   
}

var DeductibleFieldCount = 2;
function AddMoreDeductible()
{
    if($("#DeductibleRows").val() !='')
    {
        PrcsFieldCount = $("#DeductibleRows").val();
        $("#DeductibleRows").val('');
    }

    html = '<tr id="Deductible_'+DeductibleFieldCount+'_Tr"><td>'+DeductibleFieldCount+'</td><td><select class="form-control select2" data-placeholder="Choose Option Deductible" id="facDeductables_'+DeductibleFieldCount+'" name="facDeductables_'+DeductibleFieldCount+'" >'+DeductibleOptions+'</select></td>';
   
    html += '<td><input class="form-control" type="text" name="facDeductCurrency_'+DeductibleFieldCount+'" id="facDeductCurrency_'+DeductibleFieldCount+'" placeholder="Enter Currency"></td>';
    html += '<td><input class="form-control" type="text" name="facDeductAmount_'+DeductibleFieldCount+'" id="facDeductAmount_'+DeductibleFieldCount+'" placeholder="Enter Amount"></td>';
    html += '<td><input class="form-control" type="text" name="facDeductNoDays_'+DeductibleFieldCount+'" id="facDeductNoDays_'+DeductibleFieldCount+'" placeholder="Enter No. Of Days"></td>';
    html += '<td><input class="form-control" type="text" name="facDeductPerc_'+DeductibleFieldCount+'" id="facDeductPerc_'+DeductibleFieldCount+'" placeholder="Enter Percentage"></td>';
    html += '<td><input class="form-control" type="text" name="facDeductDesc_'+DeductibleFieldCount+'" id="facDeductDesc_'+DeductibleFieldCount+'" placeholder="Enter Description"></td>';
    html += '<td><a href="javascript:void(0)" onclick="RemoveMe(\'#Deductible_'+DeductibleFieldCount+'_Tr\')">Delete (X)</a></td><tr>';
    $('#AppendAbleDeductiblesTr').append(html);
    ++DeductibleFieldCount;
}

 function RemoveMe(ContainerId)
{
    $(ContainerId).remove()
}