/**
 *
 *	Conditions Work Starts here
 *
*/

// function getConditionTypeOptions(otherOption=true) {
//     getOptions('get','conditionTypeOptions','Condition','','ConditionType',otherOption);
// }


function getList(into='', methodName,moduleName='',$id='') {
    id = ($id?'/'+$id:'');
    var theModule = (moduleName?moduleName:$module);
    $.ajax({
        url: base_url + theModule +'/'+ methodName + id,
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
            clogd("-----------------------------------------------------");
            clog(response.data);
            $("input[name=csrf_test_name]").val(response.token);

            var list='<a href="#" onclick="return false;" class="default-cursor list-group-item list-group-item-success active">Conditions</a>';
            var responseLength = response.data.length?response.data.length:0;
            if (responseLength > 0) {
                var rData = response.data
                $.each(rData ,function (key, val) {
                    clog(val);
                    if(val.conditionType){
                        list += '<a href="#" onclick="return false;" class="list-group-item list-group-item-action condition" data-toggle="modal" data-target="#exampleModalCenter" value="'+val.id+'">'+val.conditionType+'</a>';
                    }
                });
                $(into).html(list);
            }
        },
        error: function (r) {
            $("input[name=csrf_test_name]").val(r.token);
        }
    });
}
$(document).on('click','.condition',function () {
    var id = $(this).attr('value');
    var title = $(this).text();
    var url = base_url + 'condition/getByConditionTypeId/'+ id;

    $('.newCondInpParent').val(id);

    $('.loader-modal').show();

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
            clogd('- - - - condiion class clicked with id: '+id+' - - - -');
            var data = response.data;
            var conditions = data.conditionDTOs;
            clog(data);

            var modalBody = '';

            if (conditions.length && conditions.length > 0) {
                var parentId = data.id;
                $.each(conditions, function (key, val) {
                    var id = val.id;
                    var name = val.condition;
                    var newInpsId = parentId+'-'+id; // new key for dom inps
                    var checked = '';
                    
                    if ($('.'+newInpsId).length) {
                        checked = 'checked="checked"';
                    } else{
                        checked = '';
                    }
                    if (name && name !== ' ') {
                        modalBody +='<div class="checkbox">'+
                            '<label><input '+checked+'" class="chkInp" type="checkbox" data-pid="'+parentId+'" id="'+id+'" data-label="'+name+'" value="'+id+'">'+name+'</label>'+
                        '</div>';
                    }

                });
            }
            modalBody = modalBody?modalBody:'sorry no conditions data found';

            $('#modalTitle').html(title);
            $('.checkBoxes').html(modalBody);
            $('.loader-modal').hide();
        }
    });
});
$(document).on('click','.addNewConditionBtn', function(){
    $('.createConditionField').show();
});

$(document).on("click",".condAddBtn",function () {
    var condInpVal = $('.newCondInp').val();
    var condInpId = $('.newCondInpParent').val()
    var condPostVal = condInpId+'|'+condInpVal;

    $.ajax({
            url: base_url + 'condition/create',
            type: 'POST',
            dataType: 'json',
            data: {
                'conditionType':condPostVal,
            },
            headers: {
                'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
            },
            success: function (response) {
                clogd('--------------------------some response--------------------------');
                clog(response);
                if (response.code == 1) {
                    $('.createConditionField').hide();
                    $('.newCondInp').val('');
                }
                $('.doneConditions').trigger('click');


            },
            error: function (r) {
                // $("input[name=csrf_test_name]").val(r.token);              
            }
        });

});

$(document).on('change','.chkInp',function () {
    var id = $(this).attr('id');
    var parentId = $(this).attr('data-pid');
    var inpLabel = $(this).attr('data-label');

    var newInpsId = parentId+'-'+id; // new key for dom inps

    if( $(this).is(':checked') ) {
        var input = '<input type="hidden" name="conditionIds[]" class="'+newInpsId+'" value="'+id+'">';
            input += '<a href="#" onclick="return false;" class="list-group-item list-group-item-action '+newInpsId+'"> '+inpLabel+' </a>';
        
        if (!$('#data-list-user .'+newInpsId).html()) {
            $('#data-list-user').append(input);
        }
        
        $('.removeable').remove();
    }else{
        $('.'+newInpsId).remove();
        var dataList = $('#data-list-user').html();
            dataList = dataList.replace(/\s/g,'');
        if (dataList == '') {
            var emptyCondMsg = '<a href="#" onclick="return false;" class="removeable list-group-item list-group-item-action">Not Selected any condition yet! </a>';
            $('#data-list-user').html(emptyCondMsg);
        }
    }

});

function getConditionTypesList() {
    getList('.getConditionsListDiv','get','ConditionType');
}

function getConditionOptions(cType,appendClass, otherOption=true) {
    getOptions('get',appendClass, cType, btoa(cType),'Condition',otherOption);
}

function getSpConOps() {
    getConditionOptions('Special Condition','splConditionTypeOptions');
}
function getWarOps() {
    getConditionOptions('Warranties','warrantiesConditionTypeOptions');
}

function getExcOps() {
    getConditionOptions('Exclusion','exclusionConditionTypeOptions');
}

function getElOps() {
    getConditionOptions('Event Limit','eventLimitConditionTypeOptions');
}
function getLpcOps() {
    getConditionOptions('Loss Participation Clause','lossPartConditionTypeOptions');
}

function getBordoOps() {
    getConditionOptions('Bordo Condition','bordoConditionTypeOptions');
}
function callPhpMethod($module,$method,$appendClassName,$param='') {
        $.ajax({
            url: base_url + $module +'/'+$method+'/'+$param,
            type: 'POST',
            dataType: 'html',
            headers: {
                'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
            },
            success: function (response) {
                // console.log(response.data);
                // $("input[name=csrf_test_name]").val(response.token);
                $('.'+$appendClassName).html(response);
            },
            error: function (r) {
                // $("input[name=csrf_test_name]").val(r.token);              
            }
        });
}
// function getTreatyConditions() {
//     var referenceNo = $('#fileRefNo').val()?$('#fileRefNo').val():'';
//     callPhpMethod('Treaty','getConditionsList','getConditionsList',referenceNo);
// }
function getRoleOptions() {
    getOptions('get','roleOptions','Role','','Role');
}
function getStepRoleOptions(tretierId) {
    getOptions('getWorkFlowRolesByTretierId','roleOptions','Role',tretierId,'Role');
}

// slip general options
function getBrokerOptions() {
    getOptions('get','brokerOptions','Broker','','Broker');
}

function getCedentOptions() {
    getOptions('get','cedentOptions','Cedent','','Cedent');
}

function getTreatyTypeOptions() {
    getOptions('get','treatyTypeOptions','Treaty Type','','TreatyType');
}

function getTreatySubTypesOptions() {
    getOptions('get','treatySubTypesOptions','Treaty Sub-types','','TreatySubTypes');
}

function getTreatyCategoryOptions() {
    getOptions('get','treatyCategoryOptions','Treaty Category','','TreatyCategory');
}

function getBusinessOptions() {
    getOptions('get','BusinessOptions','Business','','Business');
}

function getCurrencyOptions() {
    getOptions('get','currencyOptions','Currency','','Currency');
}

function getRateTypeOptions() {
    getOptions('get','rateTypeOptions','Rate Type','','RateType');
}

function getCurrencyRateOptions() {
    getOptions('get','currencyRateOptions','Currency Rate','','CurrencyRate');
}

$(document).ready(function(){
    // getTreatyConditions(); // functionality changed
    getStepRoleOptions(tretierId);
    // getConditionTypeOptions();
    getConditionTypesList();
    // getExcOps();
    // getWarOps();
    // getSpConOps();
    // getBordoOps();
    // getLpcOps();
    // getElOps();

    /*dropdowns*/
    // getBrokerOptions();
    // getCedentOptions();
    // getTreatyTypeOptions();
    // getTreatySubTypesOptions();
    // getTreatyCategoryOptions();
    // getBusinessOptions();
    // getCurrencyOptions();
    // getRateTypeOptions();
    // getCurrencyRateOptions();
    /*end dropdowns*/

});

function qsCalcQuotaCompRet() {
    var grossRetQuot = $('#section_grossRetentionQuota').val();
    var quotCompRet = $('#quotaCompanyRetention').val();

    var result = (grossRetQuot * quotCompRet)/100;

    $('#quotaCompanyRetentionOf').val(result);
}

function qsReInsLiab() {
    var grossRetQuot = $('#section_grossRetentionQuota').val();
    var cededShareRate = $('#cededShareRate').val();

    var result = (grossRetQuot * cededShareRate)/100;

    $('#section_reInsurerLiability').val(result);
}

$(document).on('click','.remove',function () {
    var rmInpVal = $(this).parent().text().trim();
        rmInpVal = rmInpVal.trim();
        rmInpVal = rmInpVal.replace(' ✘','');
        rmInpVal = rmInpVal.replace(/\s+/g, '');

    $(this).parent().remove();
    $('[data-val='+rmInpVal+']').remove();

});

// Condition DD #1
$(".condition_dd").on('change',function () {
    var cType = $('.conditionTypeOptions option:selected').text();
    var cTypeVal = $('.conditionTypeOptions option:selected').val();
    
    if ($(this).val() == "other") {
        $(".other_condistion_dd").show();
    } else if ($(this).val() !== '' ){
        $(".other_condistion_dd").hide();
        var condition_dd_list = $(".condition_dd_list").text();
        if (!condition_dd_list.includes(cType)) {
            
            $('<input>').attr({
                type: 'hidden',
                value: cTypeVal,
                name: 'conditionIds[]'
            }).appendTo('#data-list');

            $(".condition_dd_list").append("<span>" + cType + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
        }
    }else{
        $(".other_condistion_dd").hide();
    }
});
$(".other_condistion_dd_btn").click(function () {
    var conditionType = $(".other_condistion_dd_txt").val();
    $.ajax({
        method:'POST',
        url: base_url+'/conditiontype/create',
        data: { conditionType: conditionType },
        success: function (resp) {
            getConditionTypeOptions();
        }
    });

    $(".condition_dd_list").append("<span>" + conditionType + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
    $(".other_condistion_dd_txt").val("");
    $(".other_condistion_dd").hide();
});

// Special Condition DD #2
$(".spl_condition_dd").on('change',function () {
    var splCType = $('.splConditionTypeOptions option:selected').text();
    var splCTypeVal = $('.splConditionTypeOptions option:selected').val();

    if ($(this).val() == "other") {
        $(".spl_other_condistion_dd").show();
    } else if ($(this).val() !== '' ){
        $(".spl_other_condistion_dd").hide();
        var spl_condition_dd_list = $(".spl_condition_dd_list").text();
        if (!spl_condition_dd_list.includes(splCType)) {

            $('<input>').attr({
                type: 'hidden',
                value: splCTypeVal,
                name: 'conditionIds[]'
            }).appendTo('#data-list');

            $(".spl_condition_dd_list").append("<span>" + splCType + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
            
        }
    }else{
        $(".spl_other_condistion_dd").hide();
    }
});
$(".spl_other_condistion_dd_btn").click(function () {
    var cTypeId = $('.splConditionTypeOptions').attr('data-id');
    var newCond = $(".spl_other_condistion_dd_txt").val();
    $.ajax({
        method:'POST',
        url: base_url+'/condition/create',
        data: { 
            conditionType   : cTypeId+'|'+newCond,
            condition       : newCond,
        },
        success: function (resp) {
            getSpConOps();
        }
    });

    $(".spl_condition_dd_list").append("<span>" + newCond + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
    $(".spl_other_condistion_dd_txt").val("");
    $(".spl_other_condistion_dd").hide();
});

// Warranty Condition DD #3
$(".warranties_dd").on('change',function () {
    var warrantyType = $('.warrantiesConditionTypeOptions option:selected').text();
    var warrantyTypeVal = $('.warrantiesConditionTypeOptions option:selected').val();
    if ($(this).val() == "other") {
        $(".other_warranties_dd").show();
    } else if ($(this).val() !== '' ){
        $(".other_warranties_dd").hide();
        var warranties_dd_list = $(".warranties_dd_list").text();
        if (!warranties_dd_list.includes(warrantyType)) {

            $('<input>').attr({
                type: 'hidden',
                value: warrantyTypeVal,
                name: 'conditionIds[]'
            }).appendTo('#data-list');

            $(".warranties_dd_list").append("<span>" + warrantyType + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
        }
    }else{
        $(".other_warranties_dd").hide();
    }
});
$(".other_warranties_dd_btn").click(function () {
    var cTypeId = $('.warrantiesConditionTypeOptions').attr('data-id');
    var newCond = $(".other_warranties_dd_txt").val();
    $.ajax({
        method:'POST',
        url: base_url+'/condition/create',
        data: { 
            conditionType   : cTypeId+'|'+newCond,
            condition       : newCond,
        },
        success: function (resp) {
            getWarOps();
        }
    });

    $(".warranties_dd_list").append("<span>" + newCond + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
    $(".other_warranties_dd_txt").val("");
    $(".other_warranties_dd").hide();
});

// Exclusion DD #4
$(".exclusion_dd").on('change',function () {
    var exclusionType = $('.exclusionConditionTypeOptions option:selected').text();
    var exclusionTypeVal = $('.exclusionConditionTypeOptions option:selected').val();
    if ($(this).val() == "other") {
        $(".other_exclusion_dd").show();
    } else if ($(this).val() !== '' ){
        $(".other_exclusion_dd").hide();
        var exclusion_dd_list = $(".exclusion_dd_list").text();
        if (!exclusion_dd_list.includes(exclusionType)) {

            $('<input>').attr({
                type: 'hidden',
                value: exclusionTypeVal,
                name: 'conditionIds[]'
            }).appendTo('#data-list');
            $(".exclusion_dd_list").append("<span>" + exclusionType + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
        }
    }else{
        $(".other_exclusion_dd").hide();
    }
});
$(".other_exclusion_dd_btn").click(function () {
    var cTypeId = $('.exclusionConditionTypeOptions').attr('data-id');
    var newCond = $(".other_exclusion_dd_txt").val();
    $.ajax({
        method:'POST',
        url: base_url+'/condition/create',
        data: { 
            conditionType   : cTypeId+'|'+newCond,
            condition       : newCond,
        },
        success: function (resp) {
            getExcOps();
        }
    });
    $(".exclusion_dd_list").append("<span>" + newCond + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
    $(".other_exclusion_dd_txt").val("");
    $(".other_exclusion_dd").hide();
});


// Event Limit DD #5
$(".event_limit").on('change',function () {
    var eventLimit = $('.eventLimitConditionTypeOptions option:selected').text();
    var eventLimitVal = $('.eventLimitConditionTypeOptions option:selected').val();

    if ($(this).val() == "other") {
        $(".other_event_limit").show();
    } else if ($(this).val() !== '' ){
        $(".other_event_limit").hide();
        var event_limit_list = $(".event_limit_list").text();
        if (!event_limit_list.includes(eventLimit)) {

            $('<input>').attr({
                type: 'hidden',
                value: eventLimitVal,
                name: 'conditionIds[]'
            }).appendTo('#data-list');

            $(".event_limit_list").append("<span>" + eventLimit + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");

        }
    }else{
        $(".other_event_limit").hide();
    }
});
$(".other_event_limit_btn").click(function () {
    var cTypeId = $('.eventLimitConditionTypeOptions').attr('data-id');
    var newCond = $(".other_event_limit_txt").val();
    $.ajax({
        method:'POST',
        url: base_url+'/condition/create',
        data: { 
            conditionType   : cTypeId+'|'+newCond,
            condition       : newCond,
        },
        success: function (resp) {
            getElOps();
        }
    });
    $(".event_limit_list").append("<span>" + newCond + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
    $(".other_event_limit_txt").val("");
    $(".other_event_limit").hide();
});

// Loss Participation Clause DD #6
$(".loss_part").on('change',function () {
    var lossPartType = $('.lossPartConditionTypeOptions option:selected').text();
    var lossPartTypeVal = $('.lossPartConditionTypeOptions option:selected').val();
    if ($(this).val() == "other") {
        $(".other_loss_part").show();
    } else if ($(this).val() !== '' ){
        $(".other_loss_part").hide();
        var loss_part_list = $(".loss_part_list").text();
        if (!loss_part_list.includes(lossPartType)) {

            $('<input>').attr({
                type: 'hidden',
                value: lossPartTypeVal,
                name: 'conditionIds[]'
            }).appendTo('#data-list');

            $(".loss_part_list").append("<span>" + lossPartType + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
        }
    }else{
        $(".other_loss_part").hide();
    }
});
$(".other_loss_part_btn").click(function () {
    var cTypeId = $('.lossPartConditionTypeOptions').attr('data-id');
    var newCond = $(".other_loss_part_txt").val();
    $.ajax({
        method:'POST',
        url: base_url+'/condition/create',
        data: { 
            conditionType   : cTypeId+'|'+newCond,
            condition       : newCond,
        },
        success: function (resp) {
            getLpcOps();
        }
    });


    $(".loss_part_list").append("<span>" + newCond + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
    $(".other_loss_part_txt").val("");
    $(".other_loss_part").hide();
});

// Bordo Condition #6
$(".bordo_condition").on('change',function () {
    var bordoConditionType = $('.bordoConditionTypeOptions option:selected').text();
    var bordoConditionTypeVal = $('.bordoConditionTypeOptions option:selected').val();
    
    if ($(this).val() == "other") {
        $(".other_bordo_condition").show();
    } else if ($(this).val() !== '' ){
        $(".other_bordo_condition").hide();
        var bordo_condition_list = $(".bordo_condition_list").text();
        if (!bordo_condition_list.includes(bordoConditionType)) {

            $('<input>').attr({
                type: 'hidden',
                value: bordoConditionTypeVal,
                name: 'conditionIds[]'
            }).appendTo('#data-list');

            $(".bordo_condition_list").append("<span>" + bordoConditionType + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");

        }
    }else{
        $(".other_bordo_condition").hide();
    }
});
$(".other_bordo_condition_btn").click(function () {
    var cTypeId = $('.bordoConditionTypeOptions').attr('data-id');
    var newCond = $(".other_bordo_condition_txt").val();
    $.ajax({
        method:'POST',
        url: base_url+'/condition/create',
        data: { 
            conditionType   : cTypeId+'|'+newCond,
            condition       : newCond,
        },
        success: function (resp) {
            getBordoOps();
        }
    });
    $(".bordo_condition_list").append("<span>" + newCond + "<span class='remove' style='margin-left:4px;color:red;cursor:pointer;'> &#10008;</span></span><br>");
    $(".other_bordo_condition_txt").val("");
    $(".other_bordo_condition").hide();
});



$(document).on('click','#submitConditionsBtn',function () {
    createUpadateConditions();
});


function createUpadateConditions(id=null) {
    var url = $('#conditions_form').attr('action');
    var type = $('#conditions_form').attr('method');
    var formData = $('#conditions_form').serialize();

    $.ajax({
        url         : url,
        type        : type,
        data        : formData,
        dataType    : 'json',
        success: function (res) {
            clogd('------------------Response-----------------');
            clog(res);
            var resCode = res.data.code;
            if (resCode==1) {
                $('[href=#next] ').trigger('click');
            }
        }

    });
    
}


/**
 *
 *	Loss History work Starts Here
 *
*/
// $(document).on('click','#submitLossHistoryBtn',function () {
// 	createUpadateLossHistory();
// });


// function createUpadateLossHistory(id=null) {
// 	var url = $('#loss_history_form').attr('action');
// 	var type = $('#loss_history_form').attr('method');
// 	var formData = $('#loss_history_form').serialize();
//
// 	$.ajax({
// 		url 		: url,
//         type 		: type,
//         data 		: formData,
//         dataType    : 'json',
//         success: function (res) {
//         	clogd('------------------Response-----------------');
//         	clog(res);
//             var resCode = res.data.code;
//             if (resCode==1) {
//                 $('[href=#next] ').trigger('click');
//             }
//         }
//
// 	});
//
// }


/**
 *
 *  Documents/Attachments work Starts Here
 *
*/
$(document).on('click','#submitDocumentBtn',function () {
    createUpadateDocument();
});


function createUpadateDocument(id=null) {
    var url = $('#document_form').attr('action');
    var type = $('#document_form').attr('method');
    var formData = new FormData(document.getElementById("document_form"));

    $.ajax({
        url         : url,
        type        : type,
        data        : formData,
        contentType : false,
        cache       : false,
        processData : false,
        dataType    : 'json',
        success     : function (res) {
            clogd('------------------Response-----------------');
            clog(res);
            var resCode = res.data.code;
            if (resCode==1) {
                $('#finishConfirmationModal').modal('show');
            }
        }

    });
    
}

/*Modal Confirmation Code*/
$(document).on('click','[href=#finish]',function () {
    $('#finishConfirmationModal').modal('show');
});

$('#openConfirmModal').click(function () {

    var fieldCount = 0;
    var requiredFieldsCount  = $('#'+$module+'_form *:required').length;
    $('#'+$module+'_form *:required').each(function() {
        if ($(this).val() === ''){
            $('.h_heading').text('Please fill all required fields');
            $('#modaldemo4').modal('show');
        }else{
            fieldCount++;
        }

    });
    if (fieldCount == requiredFieldsCount) {
        $('#finishConfirmationModal').modal('show');
    }else{
        $('#finishConfirmationModal').modal('hide');
    }
});

$(document).on('click','#confirmed',function () {
    proceedWithComment();
    // $('#finishConfirmationModal').modal('hide');
    // location.replace(base_url+'treaty');
    // location.replace(base_url+'treaty/entered');
});

/**
 *
 *  Comments Section work Starts Here
 *
*/
function createUpadateComment(id=null) {
    var url = $('#commentsForm').attr('action');
    var type = $('#commentsForm').attr('method');
    var formData = new FormData(document.getElementById("commentsForm"));

    $.ajax({
        url         : url,
        type        : type,
        data        : formData,
        contentType : false,
        cache       : false,
        processData : false,
        dataType    : 'json',
        success     : function (res) {
            clogd('------------------Response-----------------');
            clog(res);
            var resCode = res.data.code;
            if (resCode==1) {
                location.replace(base_url+'treaty');
            }
        }

    });   
}

function proceedWithComment(id=null) {
    var url = $('#proceedForm').attr('action');
    var type = $('#proceedForm').attr('method');
    var formData = new FormData(document.getElementById("proceedForm"));

    $.ajax({
        url         : url,
        type        : type,
        data        : formData,
        contentType : false,
        cache       : false,
        processData : false,
        dataType    : 'json',
        success     : function (res) {
            clogd('------------------Response-----------------');
            clog(res);
            var resCode = res.data.code;
            $('#finishConfirmationModal').modal('hide');
            if (resCode==1) {
                location.replace(base_url+'treaty/entered');
            }
        }

    });   
}
$(document).on('click','#addComment',function () {
    createUpadateComment();
});

$(document).on('click','#proceed',function () {
    proceedWithComment();
});


