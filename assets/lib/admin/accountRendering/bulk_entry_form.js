// row cloning code here
var table = $('#table-data')[0];

$(table).on('click', '.tr_clone_add', function (e) {
    e.preventDefault();
    var thisRow = $( this ).closest('tr')[0];
    var prevRowId = $(thisRow).attr('id');
        prevRowId = prevRowId.replace('row_','');
    var newRowId = parseFloat(prevRowId)+1;
    var rCountBefCl = $('#arTblForm tr').length; // starts from 0 it should be new key for name as its 0+1
    
    var newRow = $(thisRow).clone().attr('id','row_'+newRowId).insertAfter(thisRow);
        newRow.find('td :input').attr('onchange','calcBalance('+newRowId+');');
        newRow.find(">:first-child").prepend('CL');
        newRow.find('.onCloneRemoveId').remove();

    var newRowNamesAll = newRow.find("[name^='accountRenderingDTOS']");

    $.each(newRowNamesAll, function (key, val) {
        var name = val.name;
        var newName = name.replace(/[0-9]/g, rCountBefCl);
        val.name = newName;
    });

});

// hide session msg { NOT USING }
setTimeout(function() {
    $('#ActionMsgDiv').fadeOut('fast');
}, 1000); // <-- time in milliseconds

$(document).on('click','#search',function (e) {
    e.preventDefault();

    var postURL = BASE_URL + 'accountRendering/searchAr';
    $.ajax({
        url: postURL,
        type: 'POST',
        data: new FormData(document.getElementById('searchform')),
        dataType: 'json',

        contentType: false,
        cache: false,
        processData: false,

        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (resp) {
            var tableRows = [] ;
            n = 0;

            $.each(resp,function (key, val) {
                var businessName = val.treatierDTO.treatyStatisticsDTO.businessDTOs[0].name;
                var dept = businessName;
                var treatyCode = val.treatierDTO.treatierCode;
                var cedingCode = val.cedentDTO?val.cedentDTO.cedentCode:'';
                var cedentName = val.cedentDTO?val.cedentDTO.customerName:'';
                var brokerCode = val.brokerDTO?val.brokerDTO.code:'';
                var brokerName = val.brokerDTO?val.brokerDTO.name:'';
                var uwYear = val.uwInceptionYear;
                var prcShare = val.prcShareRate;
                var currencyCode = val.treatierDTO.currencyCode;
                var treatierId = val.treatierDTO.id;
                var treatyName = val.treatierDTO.name;
                var rowId = val.id;
                
                var arTreatyType=arType=arDebitCredit='';
                // account rendering fields for update
                var arLength = val.treatierDTO.accountRenderingDTOS.length;
                if (arLength > 0 ) {
                    var ar = val.treatierDTO.accountRenderingDTOS;
                    var tn=1;
                    $.each(ar, function (k, v) {
                        var row = cols = '';
                        var id = v.id;
                        var treatyName = v.treatyName;
                        var pYear = v.prcYear;
                        var prcYear = pYear?pYear:CURRENT_YEAR;
                        var qtr = v.prcQtr;
                        var prcQtr = qtr?qtr:CURRENT_QUARTER;
                            dept = v.dept;
                        var busType = v.busType;
                        var reinsArr = v.reinsArr;
                            treatyCode = v.treatyCode;
                        var cedingCode = v.cedingCode;
                            cedingCode = cedingCode?cedingCode:val.cedingCode;
                        var cedentName = v.cedentName;
                        
                        var brokerCode = v.brokerCode;
                            brokerCode = brokerCode?brokerCode:val.brokerCode;
                        var brokerName = v.brokerName;
                        var brokerCoRefNo = v.brokerCoRefNo;
                        var coQtr = v.coQtr;
                        var coYear = v.coYear;
                            uwYear = v.uwYear;
                        var identityInsured = v.identityInsured;
                        var typeRisk = v.typeRisk;
                        var curType = v.curType;
                        var curCode = v.curCode;
                            prcShare = v.prcShareRate;
                        var premium = v.premium;
                        var commission = v.commission;
                        var orCommission = v.orCommission;
                        var brokerAge = v.brokerAge;
                        var profitCommission = v.profitCommission;
                        var xlPremium = v.xlPremium;
                        var lossesPaid = v.lossesPaid;
                        var premiumResWHeld = v.premiumResWHeld;
                        var premiumResReles = v.premiumResReles;
                        var interestOnPlRes = v.interestOnPlRes;
                        var taxes = v.taxes;
                        var lossesResWHeld = v.lossesResWHeld;
                        var lossesResReles = v.lossesResReles;
                        var cashLossWHeld = v.cashLossWHeld;
                        var cashLossReles = v.cashLossReles;
                        var cashLossRefund = v.cashLossRefund;
                        var exchangeDifference = v.exchangeDifference;
                        var portPremium = v.portPremium;
                        var portLosses = v.portLosses;
                        var miscCharges = v.miscCharges;
                        var balance = v.balance;
                            arTreatyType = v.arTreatyType;
                            arType = v.arType;
                            arDebitCredit = v.arDebitCredit;
                        var arDebitCreditDummy = arDebitCredit=='c'?'Cr':'Dr';


                        row += '<tr id="row_'+rowId+'" class="tr_clone">';
                            cols += '<td>'+
                                '<input type="hidden" name="accountRenderingDTOS['+n+'][treatierDTO_id]" value="'+ treatierId +'">'+ (notEmpty(treatierId)+'('+tn+')' )+
                            '</td>';
                            if (id) {
                                cols += '<input class="onCloneRemoveId" type="hidden" name="accountRenderingDTOS['+n+'][id]" value="'+ id +'">';
                            }
                            cols += '<td><input type="hidden" name="accountRenderingDTOS['+n+'][treatyName]" value="'+notEmpty(treatyName)+'">'+ notEmpty(treatyName) +'</td>';
                            cols += '<td><input type="text" placeholder="Enter uw year" name="accountRenderingDTOS['+n+'][uwYear]" value="'+ notEmpty(uwYear) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter prc year" name="accountRenderingDTOS['+n+'][prcYear]" value="'+ notEmpty(prcYear?prcYear:val.prcYear) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter prc qtr" name="accountRenderingDTOS['+n+'][prcQtr]" value="'+ notEmpty(prcQtr?prcQtr:val.prcQtr) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter prc share" name="accountRenderingDTOS['+n+'][prcShare]" value="'+ notEmpty(prcShare) +'" readonly></td>';
                            cols += '<td><input type="text" placeholder="Enter department" name="accountRenderingDTOS['+n+'][dept]" value="'+ notEmpty(dept) +'" readonly></td>';
                            cols += '<td><input type="text" placeholder="Enter business type" name="accountRenderingDTOS['+n+'][busType]" value="'+ notEmpty(businessName) +'" readonly></td>';
                            cols += '<td><input type="text" placeholder="Enter reins arr" name="accountRenderingDTOS['+n+'][reinsArr]" value="'+ notEmpty(reinsArr?reinsArr:val.reinsArr) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter treaty code" name="accountRenderingDTOS['+n+'][treatyCode]" value="'+ notEmpty(treatyCode) +'" readonly></td>';

                            cols += '<td><input type="text" placeholder="Enter cedent code" name="accountRenderingDTOS['+n+'][cedingCode]" value="'+ cedingCode+'"></td>';
                            cols += '<td><input type="text" placeholder="Enter cedent name" name="accountRenderingDTOS['+n+'][cedentName]" value="'+ notEmpty(cedentName?cedentName:val.cedentName) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter broker code" name="accountRenderingDTOS['+n+'][brokerCode]" value="'+ brokerCode +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter broker name" name="accountRenderingDTOS['+n+'][brokerName]" value="'+ notEmpty(brokerName?brokerName:val.brokerName) +'"></td>';
                            
                            cols += '<td><input type="text" placeholder="Enter broker co ref no." name="accountRenderingDTOS['+n+'][brokerCoRefNo]" value="'+ notEmpty(brokerCoRefNo?brokerCoRefNo:val.brokerCoRefNo) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter co qtr" name="accountRenderingDTOS['+n+'][coQtr]" value="'+ notEmpty(coQtr?coQtr:val.coQtr) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter co year" name="accountRenderingDTOS['+n+'][coYear]" value="'+ notEmpty(coYear?coYear:val.coYear) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter identity insured" name="accountRenderingDTOS['+n+'][identityInsured]" value="'+ notEmpty(identityInsured?identityInsured:val.identityInsured) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter type risk" name="accountRenderingDTOS['+n+'][typeRisk]" value="'+ notEmpty(typeRisk?typeRisk:val.typeRisk) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter cur type" name="accountRenderingDTOS['+n+'][curType]" value="'+ notEmpty(curType?curType:val.curType) +'"></td>';
                            cols += '<td><input type="text" placeholder="Enter cur code" name="accountRenderingDTOS['+n+'][curCode]" value="'+ notEmpty(currencyCode) +'" readonly></td>';
                            // BALANCE VALS STARTS HERE
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" placeholder="Enter premium" class="premium" name="accountRenderingDTOS['+n+'][premium]" value="'+ notEmpty(premium?premium:val.premium) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" placeholder="Enter commission" class="commission" name="accountRenderingDTOS['+n+'][commission]" value="'+ notEmpty(commission?commission:val.commission) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="orCommission" placeholder="Enter or commission" name="accountRenderingDTOS['+n+'][orCommission]" value="'+ notEmpty(orCommission?orCommission:val.orCommission) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="brokerAge" placeholder="Enter brokerage" name="accountRenderingDTOS['+n+'][brokerAge]" value="'+ notEmpty(brokerAge?brokerAge:val.brokerAge) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="profitCommission" placeholder="Enter profit commission" name="accountRenderingDTOS['+n+'][profitCommission]" value="'+ notEmpty(profitCommission?profitCommission:val.profitCommission) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="xlPremium" placeholder="Enter xl premium" name="accountRenderingDTOS['+n+'][xlPremium]" value="'+ notEmpty(xlPremium?xlPremium:val.xlPremium) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="lossesPaid" placeholder="Enter losses paid" name="accountRenderingDTOS['+n+'][lossesPaid]" value="'+ notEmpty(lossesPaid?lossesPaid:val.lossesPaid) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="premiumResWHeld" placeholder="Enter premium res w held" name="accountRenderingDTOS['+n+'][premiumResWHeld]" value="'+ notEmpty(premiumResWHeld?premiumResWHeld:val.premiumResWHeld) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="premiumResReles" placeholder="Enter premium res reles" name="accountRenderingDTOS['+n+'][premiumResReles]" value="'+ notEmpty(premiumResReles?premiumResReles:val.premiumResReles) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="interestOnPlRes" placeholder="Enter interest on pl res" name="accountRenderingDTOS['+n+'][interestOnPlRes]" value="'+ notEmpty(interestOnPlRes?interestOnPlRes:val.interestOnPlRes) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="taxes" placeholder="Enter taxes" name="accountRenderingDTOS['+n+'][taxes]" value="'+ notEmpty(taxes?taxes:val.taxes) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="lossesResWHeld" placeholder="Enter losses res w held" name="accountRenderingDTOS['+n+'][lossesResWHeld]" value="'+ notEmpty(lossesResWHeld?lossesResWHeld:val.lossesResWHeld) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="lossesResReles" placeholder="Enter losses res reles" name="accountRenderingDTOS['+n+'][lossesResReles]" value="'+ notEmpty(lossesResReles?lossesResReles:val.lossesResReles) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="cashLossWHeld" placeholder="Enter cash loss w held" name="accountRenderingDTOS['+n+'][cashLossWHeld]" value="'+ notEmpty(cashLossWHeld?cashLossWHeld:val.cashLossWHeld) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="cashLossReles" placeholder="Enter cash loss reles" name="accountRenderingDTOS['+n+'][cashLossReles]" value="'+ notEmpty(cashLossReles?cashLossReles:val.cashLossReles) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="cashLossRefund" placeholder="Enter cash loss refund" name="accountRenderingDTOS['+n+'][cashLossRefund]" value="'+ notEmpty(cashLossRefund?cashLossRefund:val.cashLossRefund) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="exchangeDifference" placeholder="Enter exchange difference" name="accountRenderingDTOS['+n+'][exchangeDifference]" value="'+ notEmpty(exchangeDifference?exchangeDifference:val.exchangeDifference) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="portPremium" placeholder="Enter port premium" name="accountRenderingDTOS['+n+'][portPremium]" value="'+ notEmpty(portPremium?portPremium:val.portPremium) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="portLosses" placeholder="Enter port losses" name="accountRenderingDTOS['+n+'][portLosses]" value="'+ notEmpty(portLosses?portLosses:val.portLosses) +'"></td>';
                            cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="miscCharges" placeholder="Enter misc charges" name="accountRenderingDTOS['+n+'][miscCharges]" value="'+ notEmpty(miscCharges?miscCharges:val.miscCharges) +'"></td>';
                            // FINAL SUM BALANCE
                            cols += '<td><input type="text" class="balance" placeholder="Enter balance" name="accountRenderingDTOS['+n+'][balance]" value="'+ notEmpty(balance?balance:val.balance) +'" readonly></td>';
                            // this is select field
                            cols += '<td>'+
                            '<input type="hidden" name="accountRenderingDTOS['+n+'][arDebitCredit]" class="arDebitCredit" value="'+ notEmpty(arDebitCredit) +'">'+
                            '<input type="text" placeholder="Enter Cr/Dr" class="arDebitCreditDummy" value="'+ notEmpty(arDebitCreditDummy) +'" readonly></td>';
                            cols += '<td>'+
                                '<select placeholder="Select AR Type" name="accountRenderingDTOS['+n+'][arType]" class="arType">'+
                                    // '<option value="">Please select a/c rendering Type</option>'+
                                    '<option value="a" '+ (arType == 'a'?'selected="selected"':'') +'>Auto</option>'+
                                    '<option value="m" '+ (arType == 'm'?'selected="selected"':'') +'>Manual</option>'+
                                    '<option value="r" '+ (arType == 'r'?'selected="selected"':'') +'>Reversal</option>'+
                                '</select>'+
                            '</td>';
                            cols += '<td>'+
                                '<select placeholder="Select Treaty Type" name="accountRenderingDTOS['+n+'][arTreatyType]" class="arTreatyType">'+
                                    '<option value="">Please select Treaty Type</option>'+
                                    '<option value="p" '+ (arTreatyType == 'p'?'selected="selected"':'') +'>Proportional</option>'+
                                    '<option value="n" '+ (arTreatyType == 'n'?'selected="selected"':'') +'>Non-Proportional</option>'+
                                '</select>'+
                            '</td>';
                            // this is clone button
                            cols += '<td><a href="app/clone/table/row" class="tr_clone_add">Clone Row</a></td>';
                            row += cols;
                        row += '</tr>';
                        tableRows += row;
                        n++;
                        tn++;
                    });
                } else {
                    var row = cols = '';
                    if (val.treatierDTO.accountRenderingDTOS[0]) {

                        var id = val.treatierDTO.accountRenderingDTOS[0].id;
                        var pYear = val.treatierDTO.accountRenderingDTOS[0].prcYear;
                        var prcYear = pYear?pYear:CURRENT_YEAR;
                        var qtr = val.treatierDTO.accountRenderingDTOS[0].prcQtr;
                        var prcQtr = qtr?qtr:CURRENT_QUARTER;
                            dept = val.treatierDTO.accountRenderingDTOS[0].dept;
                        var busType = val.treatierDTO.accountRenderingDTOS[0].busType;
                        var reinsArr = val.treatierDTO.accountRenderingDTOS[0].reinsArr;
                            treatyCode = val.treatierDTO.accountRenderingDTOS[0].treatyCode;
                        var cedingCode = val.treatierDTO.accountRenderingDTOS[0].cedingCode;
                            cedingCode = cedingCode?cedingCode:val.cedingCode;
                        var cedentName = val.treatierDTO.accountRenderingDTOS[0].cedentName;
                        
                        var brokerCode = val.treatierDTO.accountRenderingDTOS[0].brokerCode;
                            brokerCode = brokerCode?brokerCode:val.brokerCode;
                        var brokerName = val.treatierDTO.accountRenderingDTOS[0].brokerName;
                        var brokerCoRefNo = val.treatierDTO.accountRenderingDTOS[0].brokerCoRefNo;
                        var coQtr = val.treatierDTO.accountRenderingDTOS[0].coQtr;
                        var coYear = val.treatierDTO.accountRenderingDTOS[0].coYear;
                            uwYear = val.treatierDTO.accountRenderingDTOS[0].uwYear;
                        var identityInsured = val.treatierDTO.accountRenderingDTOS[0].identityInsured;
                        var typeRisk = val.treatierDTO.accountRenderingDTOS[0].typeRisk;
                        var curType = val.treatierDTO.accountRenderingDTOS[0].curType;
                        var curCode = val.treatierDTO.accountRenderingDTOS[0].curCode;
                            prcShare = val.treatierDTO.accountRenderingDTOS[0].prcShareRate;
                        var premium = val.treatierDTO.accountRenderingDTOS[0].premium;
                        var commission = val.treatierDTO.accountRenderingDTOS[0].commission;
                        var orCommission = val.treatierDTO.accountRenderingDTOS[0].orCommission;
                        var brokerAge = val.treatierDTO.accountRenderingDTOS[0].brokerAge;
                        var profitCommission = val.treatierDTO.accountRenderingDTOS[0].profitCommission;
                        var xlPremium = val.treatierDTO.accountRenderingDTOS[0].xlPremium;
                        var lossesPaid = val.treatierDTO.accountRenderingDTOS[0].lossesPaid;
                        var premiumResWHeld = val.treatierDTO.accountRenderingDTOS[0].premiumResWHeld;
                        var premiumResReles = val.treatierDTO.accountRenderingDTOS[0].premiumResReles;
                        var interestOnPlRes = val.treatierDTO.accountRenderingDTOS[0].interestOnPlRes;
                        var taxes = val.treatierDTO.accountRenderingDTOS[0].taxes;
                        var lossesResWHeld = val.treatierDTO.accountRenderingDTOS[0].lossesResWHeld;
                        var lossesResReles = val.treatierDTO.accountRenderingDTOS[0].lossesResReles;
                        var cashLossWHeld = val.treatierDTO.accountRenderingDTOS[0].cashLossWHeld;
                        var cashLossReles = val.treatierDTO.accountRenderingDTOS[0].cashLossReles;
                        var cashLossRefund = val.treatierDTO.accountRenderingDTOS[0].cashLossRefund;
                        var exchangeDifference = val.treatierDTO.accountRenderingDTOS[0].exchangeDifference;
                        var portPremium = val.treatierDTO.accountRenderingDTOS[0].portPremium;
                        var portLosses = val.treatierDTO.accountRenderingDTOS[0].portLosses;
                        var miscCharges = val.treatierDTO.accountRenderingDTOS[0].miscCharges;
                        var balance = val.treatierDTO.accountRenderingDTOS[0].balance;
                        // var recordDateTime = val.treatierDTO.accountRenderingDTOS[0].recordDateTime;
                            arTreatyType = val.treatierDTO.accountRenderingDTOS[0].arTreatyType;
                            arType = val.treatierDTO.accountRenderingDTOS[0].arType;
                            arDebitCredit = val.treatierDTO.accountRenderingDTOS[0].arDebitCredit;
                            // alert(arDebitCredit);
                        var arDebitCreditDummy = arDebitCredit=='c'?'Cr':'Dr';
                    }


                    row += '<tr id="row_'+rowId+'" class="tr_clone">';
                        cols += '<td>'+
                            '<input type="hidden" name="accountRenderingDTOS['+n+'][treatierDTO_id]" value="'+ treatierId +'">'+ notEmpty(treatierId) +
                        '</td>';
                        if (id) {
                            cols += '<input class="onCloneRemoveId" type="hidden" name="accountRenderingDTOS['+n+'][id]" value="'+ id +'">';
                        }
                        cols += '<td><input type="hidden" name="accountRenderingDTOS['+n+'][treatyName]" value="'+notEmpty(treatyName)+'">'+ notEmpty(treatyName) +'</td>';
                        cols += '<td><input type="text" placeholder="Enter uw year" name="accountRenderingDTOS['+n+'][uwYear]" value="'+ notEmpty(uwYear) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter prc year" name="accountRenderingDTOS['+n+'][prcYear]" value="'+ notEmpty(prcYear?prcYear:val.prcYear) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter prc qtr" name="accountRenderingDTOS['+n+'][prcQtr]" value="'+ notEmpty(prcQtr?prcQtr:val.prcQtr) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter prc share" name="accountRenderingDTOS['+n+'][prcShare]" value="'+ notEmpty(prcShare) +'" readonly></td>';
                        cols += '<td><input type="text" placeholder="Enter department" name="accountRenderingDTOS['+n+'][dept]" value="'+ notEmpty(dept) +'" readonly></td>';
                        cols += '<td><input type="text" placeholder="Enter business type" name="accountRenderingDTOS['+n+'][busType]" value="'+ notEmpty(businessName) +'" readonly></td>';
                        cols += '<td><input type="text" placeholder="Enter reins arr" name="accountRenderingDTOS['+n+'][reinsArr]" value="'+ notEmpty(reinsArr?reinsArr:val.reinsArr) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter treaty code" name="accountRenderingDTOS['+n+'][treatyCode]" value="'+ notEmpty(treatyCode) +'" readonly></td>';
                        cols += '<td><input type="text" placeholder="Enter cedent code" name="accountRenderingDTOS['+n+'][cedingCode]" value="'+ cedingCode +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter cedent name" name="accountRenderingDTOS['+n+'][cedentName]" value="'+ notEmpty(cedentName?cedentName:val.cedentName) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter broker code" name="accountRenderingDTOS['+n+'][brokerCode]" value="'+ brokerCode +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter broker name" name="accountRenderingDTOS['+n+'][brokerName]" value="'+ notEmpty(brokerName?brokerName:val.brokerName) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter broker co ref no." name="accountRenderingDTOS['+n+'][brokerCoRefNo]" value="'+ notEmpty(brokerCoRefNo?brokerCoRefNo:val.brokerCoRefNo) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter co qtr" name="accountRenderingDTOS['+n+'][coQtr]" value="'+ notEmpty(coQtr?coQtr:val.coQtr) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter co year" name="accountRenderingDTOS['+n+'][coYear]" value="'+ notEmpty(coYear?coYear:val.coYear) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter identity insured" name="accountRenderingDTOS['+n+'][identityInsured]" value="'+ notEmpty(identityInsured?identityInsured:val.identityInsured) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter type risk" name="accountRenderingDTOS['+n+'][typeRisk]" value="'+ notEmpty(typeRisk?typeRisk:val.typeRisk) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter cur type" name="accountRenderingDTOS['+n+'][curType]" value="'+ notEmpty(curType?curType:val.curType) +'"></td>';
                        cols += '<td><input type="text" placeholder="Enter cur code" name="accountRenderingDTOS['+n+'][curCode]" value="'+ notEmpty(currencyCode) +'" readonly></td>';
                        // BALANCE VALS STARTS HERE
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" placeholder="Enter premium" class="premium" name="accountRenderingDTOS['+n+'][premium]" value="'+ notEmpty(premium?premium:val.premium) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" placeholder="Enter commission" class="commission" name="accountRenderingDTOS['+n+'][commission]" value="'+ notEmpty(commission?commission:val.commission) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="orCommission" placeholder="Enter or commission" name="accountRenderingDTOS['+n+'][orCommission]" value="'+ notEmpty(orCommission?orCommission:val.orCommission) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="brokerAge" placeholder="Enter brokerage" name="accountRenderingDTOS['+n+'][brokerAge]" value="'+ notEmpty(brokerAge?brokerAge:val.brokerAge) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="profitCommission" placeholder="Enter profit commission" name="accountRenderingDTOS['+n+'][profitCommission]" value="'+ notEmpty(profitCommission?profitCommission:val.profitCommission) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="xlPremium" placeholder="Enter xl premium" name="accountRenderingDTOS['+n+'][xlPremium]" value="'+ notEmpty(xlPremium?xlPremium:val.xlPremium) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="lossesPaid" placeholder="Enter losses paid" name="accountRenderingDTOS['+n+'][lossesPaid]" value="'+ notEmpty(lossesPaid?lossesPaid:val.lossesPaid) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="premiumResWHeld" placeholder="Enter premium res w held" name="accountRenderingDTOS['+n+'][premiumResWHeld]" value="'+ notEmpty(premiumResWHeld?premiumResWHeld:val.premiumResWHeld) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="premiumResReles" placeholder="Enter premium res reles" name="accountRenderingDTOS['+n+'][premiumResReles]" value="'+ notEmpty(premiumResReles?premiumResReles:val.premiumResReles) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="interestOnPlRes" placeholder="Enter interest on pl res" name="accountRenderingDTOS['+n+'][interestOnPlRes]" value="'+ notEmpty(interestOnPlRes?interestOnPlRes:val.interestOnPlRes) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="taxes" placeholder="Enter taxes" name="accountRenderingDTOS['+n+'][taxes]" value="'+ notEmpty(taxes?taxes:val.taxes) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="lossesResWHeld" placeholder="Enter losses res w held" name="accountRenderingDTOS['+n+'][lossesResWHeld]" value="'+ notEmpty(lossesResWHeld?lossesResWHeld:val.lossesResWHeld) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="lossesResReles" placeholder="Enter losses res reles" name="accountRenderingDTOS['+n+'][lossesResReles]" value="'+ notEmpty(lossesResReles?lossesResReles:val.lossesResReles) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="cashLossWHeld" placeholder="Enter cash loss w held" name="accountRenderingDTOS['+n+'][cashLossWHeld]" value="'+ notEmpty(cashLossWHeld?cashLossWHeld:val.cashLossWHeld) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="cashLossReles" placeholder="Enter cash loss reles" name="accountRenderingDTOS['+n+'][cashLossReles]" value="'+ notEmpty(cashLossReles?cashLossReles:val.cashLossReles) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="cashLossRefund" placeholder="Enter cash loss refund" name="accountRenderingDTOS['+n+'][cashLossRefund]" value="'+ notEmpty(cashLossRefund?cashLossRefund:val.cashLossRefund) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="exchangeDifference" placeholder="Enter exchange difference" name="accountRenderingDTOS['+n+'][exchangeDifference]" value="'+ notEmpty(exchangeDifference?exchangeDifference:val.exchangeDifference) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="portPremium" placeholder="Enter port premium" name="accountRenderingDTOS['+n+'][portPremium]" value="'+ notEmpty(portPremium?portPremium:val.portPremium) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="portLosses" placeholder="Enter port losses" name="accountRenderingDTOS['+n+'][portLosses]" value="'+ notEmpty(portLosses?portLosses:val.portLosses) +'"></td>';
                        cols += '<td><input type="text" onchange="calcBalance('+rowId+');" class="miscCharges" placeholder="Enter misc charges" name="accountRenderingDTOS['+n+'][miscCharges]" value="'+ notEmpty(miscCharges?miscCharges:val.miscCharges) +'"></td>';
                        // FINAL SUM BALANCE
                        cols += '<td><input type="text" class="balance" placeholder="Enter balance" name="accountRenderingDTOS['+n+'][balance]" value="'+ notEmpty(balance?balance:val.balance) +'" readonly></td>';
                        // this is select field
                        cols += '<td>'+
                        '<input type="hidden" name="accountRenderingDTOS['+n+'][arDebitCredit]" class="arDebitCredit" value="'+ notEmpty(arDebitCredit) +'">'+
                        '<input type="text" placeholder="Enter Cr/Dr" class="arDebitCreditDummy" value="'+ notEmpty(arDebitCreditDummy) +'" readonly></td>';
                        cols += '<td>'+
                            '<select placeholder="Select AR Type" name="accountRenderingDTOS['+n+'][arType]" class="arType">'+
                                // '<option value="">Please select a/c rendering Type</option>'+
                                '<option value="a" '+ (arType == 'a'?'selected="selected"':'') +'>Auto</option>'+
                                '<option value="m" '+ (arType == 'm'?'selected="selected"':'') +'>Manual</option>'+
                                '<option value="r" '+ (arType == 'r'?'selected="selected"':'') +'>Reversal</option>'+
                            '</select>'+
                        '</td>';
                        cols += '<td>'+
                            '<select placeholder="Select Treaty Type" name="accountRenderingDTOS['+n+'][arTreatyType]" class="arTreatyType">'+
                                '<option value="">Please select Treaty Type</option>'+
                                '<option value="p" '+ (arTreatyType == 'p'?'selected="selected"':'') +'>Proportional</option>'+
                                '<option value="n" '+ (arTreatyType == 'n'?'selected="selected"':'') +'>Non-Proportional</option>'+
                            '</select>'+
                        '</td>';
                        // this is clone button
                        cols += '<td><a href="app/clone/table/row" class="tr_clone_add">Clone Row</a></td>';
                        row += cols;
                    row += '</tr>';
                    
                    tableRows += row;

                    n++;
                }
            });

            $('#arTblForm').html(tableRows);
        }
    });
});

function calcBalance(rowId) {
    var premium = $('#row_'+rowId+' td .premium').val()?parseFloat($('#row_'+rowId+' td .premium').val()):0;
    var commission = $('#row_'+rowId+' td .commission').val()?parseFloat($('#row_'+rowId+' td .commission').val()):0;
    var orCommission = $('#row_'+rowId+' td .orCommission').val()?parseFloat($('#row_'+rowId+' td .orCommission').val()):0;
    var brokerAge = $('#row_'+rowId+' td .brokerAge').val()?parseFloat($('#row_'+rowId+' td .brokerAge').val()):0;
    var profitCommission = $('#row_'+rowId+' td .profitCommission').val()?parseFloat($('#row_'+rowId+' td .profitCommission').val()):0;
    var xlPremium = $('#row_'+rowId+' td .xlPremium').val()?parseFloat($('#row_'+rowId+' td .xlPremium').val()):0;
    var lossesPaid = $('#row_'+rowId+' td .lossesPaid').val()?parseFloat($('#row_'+rowId+' td .lossesPaid').val()):0;
    var premiumResWHeld = $('#row_'+rowId+' td .premiumResWHeld').val()?parseFloat($('#row_'+rowId+' td .premiumResWHeld').val()):0;
    var premiumResReles = $('#row_'+rowId+' td .premiumResReles').val()?parseFloat($('#row_'+rowId+' td .premiumResReles').val()):0;
    var interestOnPlRes = $('#row_'+rowId+' td .interestOnPlRes').val()?parseFloat($('#row_'+rowId+' td .interestOnPlRes').val()):0;
    var taxes = $('#row_'+rowId+' td .taxes').val()?parseFloat($('#row_'+rowId+' td .taxes').val()):0;
    var lossesResWHeld = $('#row_'+rowId+' td .lossesResWHeld').val()?parseFloat($('#row_'+rowId+' td .lossesResWHeld').val()):0;
    var lossesResReles = $('#row_'+rowId+' td .lossesResReles').val()?parseFloat($('#row_'+rowId+' td .lossesResReles').val()):0;
    var cashLossWHeld = $('#row_'+rowId+' td .cashLossWHeld').val()?parseFloat($('#row_'+rowId+' td .cashLossWHeld').val()):0;
    var cashLossReles = $('#row_'+rowId+' td .cashLossReles').val()?parseFloat($('#row_'+rowId+' td .cashLossReles').val()):0;
    var cashLossRefund = $('#row_'+rowId+' td .cashLossRefund').val()?parseFloat($('#row_'+rowId+' td .cashLossRefund').val()):0;
    var exchangeDifference = $('#row_'+rowId+' td .exchangeDifference').val()?parseFloat($('#row_'+rowId+' td .exchangeDifference').val()):0;
    var portPremium = $('#row_'+rowId+' td .portPremium').val()?parseFloat($('#row_'+rowId+' td .portPremium').val()):0;
    var portLosses = $('#row_'+rowId+' td .portLosses').val()?parseFloat($('#row_'+rowId+' td .portLosses').val()):0;
    var miscCharges = $('#row_'+rowId+' td .miscCharges').val()?parseFloat($('#row_'+rowId+' td .miscCharges').val()):0;

    var totalBalance = orCommission + brokerAge + profitCommission + xlPremium + lossesPaid + premium + 
                        commission + premiumResWHeld + premiumResReles + interestOnPlRes + taxes + 
                        lossesResWHeld + lossesResReles + cashLossWHeld + cashLossReles + cashLossRefund + 
                        exchangeDifference + portPremium + portLosses + miscCharges;

    $('#row_'+rowId+' td .balance').val(totalBalance);

    if (totalBalance > 0 ) {
        $('#row_'+rowId+' td .arDebitCredit').val('d');
        $('#row_'+rowId+' td .arDebitCreditDummy').val('Dr');
    } else if(totalBalance < 0 ) {
        $('#row_'+rowId+' td .arDebitCredit').val('c');
        $('#row_'+rowId+' td .arDebitCreditDummy').val('Cr');
    }
    // $('#'+rowId+' .arDebitCredit').trigger('blur');
}


function notEmpty(stringInt, autofull = null) {
    var retVal='';
    if (stringInt) {
        if (parseFloat(stringInt) !== NaN) {
            retVal = stringInt;
        } else {
            retVal = parseFloat(stringInt);
        }
    }
    return retVal;
}

function chkEmptyStr(string) {
    var floatVal='';
    if (stringInt) {
        floatVal = parseFloat(stringInt);
    }
    alert(floatVal);
    return floatVal;
}

$(document).ready(function () {
    $('#submit').on('click', function (e) {
        e.preventDefault();

        var postURL = BASE_URL + 'accountRendering/create';
        $.ajax({
            url: postURL,
            type: 'POST',
            data: new FormData(document.getElementById('create_form')),
            dataType: 'json',

            contentType: false,
            cache: false,
            processData: false,

            headers: {
                'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
            },
            success: function (response)
            {
                $(".h_heading").text(response.message);
                if(response.code == 1) {
                    window.location.replace(response.path);
                }else if(response.code == 0)
                {
                    $('#modal_error').modal('show');

                }

            }
        });
    });
});


