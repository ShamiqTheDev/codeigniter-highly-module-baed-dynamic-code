
/* Functions called on document ready */

function fillFormValsAccRend() {
	var url = base_url+'treaty/getTretierData/'+tretierId;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
        	if (response !== null) {
	        	var businessName = response.treatyStatisticsDTO?response.treatyStatisticsDTO.businessDTOs[0].name:'';
	        	var dept = businessName ;
	        	var treatyCode = response.treatierCode;
	        	var treatyName = response.name;
	        	var cedingCode = response.treatyStatisticsDTO?response.treatyStatisticsDTO.cedentDTO.cedentCode:'';
	        	var cedingName = response.treatyStatisticsDTO?response.treatyStatisticsDTO.cedentDTO.customerName:'';

	        	var brokerCode = response.treatySlipGeneralDTO?response.treatySlipGeneralDTO.brokerDTO.code:'';
	        	var brokerName = response.treatySlipGeneralDTO?response.treatySlipGeneralDTO.brokerDTO.name:'';

	        	var uwYear = response.treatySlipGeneralDTO.uwInceptionYear;
	        	var prcShare = response.treatySlipGeneralDTO.prcShare;
	        	var currencyCode = response.currencyCode;
	        	var treatyType = response.treatyStatisticsDTO?response.treatyStatisticsDTO.treatyCategoryDTO.name:'';
	        		treatyType = treatyType.toLowerCase();
	        		treatyType = treatyType == 'proportional'? 'p' : 'n';
				var arTreatyTypeDummy = treatyType=='p'?'Proportional':'Non-Proportional';
	        	var treatyYear = response.treatyStatisticsDTO?response.treatyStatisticsDTO.treatyYear:'';

	        	$('.dept').val(dept);
	        	$('.busType').val(businessName);
	        	$('.treatyCode').val(treatyCode);
	        	$('.cedingCode').val(cedingCode);
	        	$('.cedingName').val(cedingName);
	        	
	        	$('.brokerCode').val(brokerCode);
	        	$('.brokerName').val(brokerName);
	        	$('.brokerName').val(brokerName);
	        	$('.treatyName').val(treatyName);

	        	$('.uwYear').val(uwYear);
	        	$('.prcYear').val(treatyYear);
	        	$('.prcShare').val(prcShare);
	        	$('.curCode').val(currencyCode);
	        	$('.arTreatyType').val(treatyType);
	        	$('.arTreatyTypeDummy').val(arTreatyTypeDummy);
        	}

        },
        error: function (r) {
            clog('Error in retrieving Site.');
            clog(r);
        }
    });
}
function setTretierId() {
	$('.tretierId').val(tretierId);
}

function nullIdForUpdate() {
	$('input[name="id"]').val('');
}
function updateRowsAccRend() {
	var url = base_url+'accountRendering/getAllByTreatier/'+tretierId;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
        	var respCount = response.data.length;
        	var rowsData = response.data; 
        	if (respCount>0) {
        		var trs='';
        		var sn = 1;
        		$.each(rowsData,function (key, val) {
	        		var tds = '';
        			var dateFormatted = moment(Date.parse(val.recordDateTime)).format('DD-MMM-YYYY');
        			var arType = val.arType;
        			var drcr = val.arDebitCredit;
        			var arDRCR = drcr=='c'?'Cr':'Dr';
        			var tType = val.arTreatyType;
					var tTypeFull = tType.toLowerCase() == 'p'?'Proportional':'Non-Proportional';

        			switch (arType) {
					    case 'a':
					        arTypeFullForm = 'Auto'; break;
					    case 'm':
					        arTypeFullForm = 'Manual'; break;
					    case 'r':
					        arTypeFullForm = 'Reversal'; break;
					    default:
					        arTypeFullForm = '';
					}

	    			tds += '<td>'+ sn +'</td>';
	    			tds += '<td>'+ val.id +'</td>';
	    			tds += '<td>'+ val.prcYear +'</td>';
	    			tds += '<td>'+ val.prcQtr +'</td>';
	    			tds += '<td>'+ val.dept +'</td>';
	    			tds += '<td>'+ val.busType +'</td>';
	    			tds += '<td>'+ val.reinsArr +'</td>';
	    			tds += '<td>'+ val.treatyCode +'</td>';
	    			tds += '<td>'+ val.cedingCode +'</td>';
	    			tds += '<td>'+ val.brokerCode +'</td>';
	    			tds += '<td>'+ val.brokerCoRefNo +'</td>';
	    			tds += '<td>'+ val.coQtr +'</td>';
	    			tds += '<td>'+ val.coYear +'</td>';
	    			tds += '<td>'+ val.uwYear +'</td>';
	    			tds += '<td>'+ val.identityInsured +'</td>';
	    			tds += '<td>'+ val.typeRisk +'</td>';
	    			tds += '<td>'+ val.curType +'</td>';
	    			tds += '<td>'+ val.curCode +'</td>';
	    			tds += '<td>'+ val.prcShare +'</td>';
	    			tds += '<td>'+ val.premium +'</td>';
	    			tds += '<td>'+ val.commission +'</td>';
	    			tds += '<td>'+ val.orCommission +'</td>';
	    			tds += '<td>'+ val.brokerAge +'</td>';
	    			tds += '<td>'+ val.profitCommission +'</td>';
	    			tds += '<td>'+ val.xlPremium +'</td>';
	    			tds += '<td>'+ val.lossesPaid +'</td>';
	    			tds += '<td>'+ val.premiumResWHeld +'</td>';
	    			tds += '<td>'+ val.premiumResReles +'</td>';
	    			tds += '<td>'+ val.interestOnPlRes +'</td>';
	    			tds += '<td>'+ val.taxes +'</td>';
	    			tds += '<td>'+ val.lossesResWHeld +'</td>';
	    			tds += '<td>'+ val.lossesResReles +'</td>';
	    			tds += '<td>'+ val.cashLossWHeld +'</td>';
	    			tds += '<td>'+ val.cashLossReles +'</td>';
	    			tds += '<td>'+ val.cashLossRefund +'</td>';
	    			tds += '<td>'+ val.exchangeDifference +'</td>';
	    			tds += '<td>'+ val.portPremium +'</td>';
	    			tds += '<td>'+ val.portLosses +'</td>';
	    			tds += '<td>'+ val.miscCharges +'</td>';
	    			tds += '<td>'+ val.balance +'</td>';
	    			tds += '<td>'+ arTypeFullForm +'</td>';
	    			tds += '<td>'+ arDRCR +'</td>';
	    			tds += '<td>'+ tTypeFull +'</td>';
	    			tds += '<td>'+ dateFormatted +'</td>';
	    			tds += '<td>'
	    			+'<a href="#" class="prevent-default" onclick="editOrCloneAccRend(\''+btoa(val.id)+'\',\'edit\')"> Edit </a> |'
	    			+'<a href="#" class="prevent-default" onclick="editOrCloneAccRend(\''+btoa(val.id)+'\',\'clone\')"> Clone </a>'
	    			+'</td>';

        			trs += '<tr>'+tds+'</tr>';

        			sn++;
        		});

        		$('.acRendTbl').html(trs);
        	} else {
        		clogd('No Data Found in getAllByTreatier');
        	}
        },
        error: function (r) {
            clog('Error in retrieving Site.');
            clog(r);
        }
    });	
}
function loadDatePickerAccRend() {
	$('.fc-datepicker').datepicker({
	  showOtherMonths: true,
	  selectOtherMonths: true
	});
}
$(document).ready(function () { 
	setTretierId();
	nullIdForUpdate();
	fillFormValsAccRend();
	loadDatePickerAccRend();	
	updateRowsAccRend();
	preventDefaultAnchorClass();
	if (action == 'view') {
		editOrCloneAccRend(pageId,'clone');
	}
});

/* functions out of document ready */

function editOrCloneAccRend(id,action) {
	var url = base_url+'accountRendering/get/'+id;
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
        	var data = response.data;
        	var id = btoa(data.id);

			var tType = data.arTreatyType;

			var arTreatyTypeDummy = tType.toLowerCase()=='p'?'Proportional':'Non-Proportional';

			var arDebitCredit = data.arDebitCredit;
			var arDebitCreditDummy = arDebitCredit.toLowerCase()=='c'?'Cr':'Dr';


			var url2 = base_url+'accountRendering/edit/'+id;
        	$('#'+$module+'_form').attr('action',url2);

			$('.treatyName').val(data.treatyName);
			$('.prcYear').val(data.prcYear);
			$('.prcQtr').val(data.prcQtr);
			$('.dept').val(data.dept);
			$('.busType').val(data.busType);
			$('.reinsArr').val(data.reinsArr);
			$('.treatyCode').val(data.treatyCode);
			$('.cedingCode').val(data.cedingCode);
			$('.cedingName').val(data.cedentName);
			$('.brokerCode').val(data.brokerCode);
			$('.brokerName').val(data.brokerName);
			$('.brokerCoRefNo').val(data.brokerCoRefNo);
			$('.coQtr').val(data.coQtr);
			$('.coYear').val(data.coYear);
			$('.uwYear').val(data.uwYear);
			$('.identityInsured').val(data.identityInsured);
			$('.typeRisk').val(data.typeRisk);
			$('.curType').val(data.curType);
			$('.curCode').val(data.curCode);
			$('.prcShare').val(data.prcShare);
			$('.premium').val(data.premium);
			$('.commission').val(data.commission);
			$('.orCommission').val(data.orCommission);
			$('.brokerAge').val(data.brokerAge);
			$('.profitCommission').val(data.profitCommission);
			$('.xlPremium').val(data.xlPremium);
			$('.lossesPaid').val(data.lossesPaid);
			$('.premiumResWHeld').val(data.premiumResWHeld);
			$('.premiumResReles').val(data.premiumResReles);
			$('.interestOnPlRes').val(data.interestOnPlRes);
			$('.taxes').val(data.taxes);
			$('.lossesResWHeld').val(data.lossesResWHeld);
			$('.lossesResReles').val(data.lossesResReles);
			$('.cashLossWHeld').val(data.cashLossWHeld);
			$('.cashLossReles').val(data.cashLossReles);
			$('.cashLossRefund').val(data.cashLossRefund);
			$('.exchangeDifference').val(data.exchangeDifference);
			$('.portPremium').val(data.portPremium);
			$('.portLosses').val(data.portLosses);
			$('.miscCharges').val(data.miscCharges);
			$('.balance').val(data.balance);
			$('.recordDateTime').val(formatDate(data.recordDateTime));
			$('.arTreatyType').val(tType);
			$('.arTreatyTypeDummy').val(arTreatyTypeDummy);
			$('.arType').val(data.arType);
			$('.arDebitCredit').val(arDebitCredit);
			$('.arDebitCreditDummy').val(arDebitCreditDummy);

        	if (action == 'clone') {
				$('input[name="id"]').val('');
				$('.subUsingConfirmBtn').text('Clone');
        	} else {
				$('input[name="id"]').val(id);
				$('.subUsingConfirmBtn').text('Update');
        	}
			// calcBalance();
        },
        error: function (r) {
            clog('Error in retrieving Site.');
            clog(r);
        }
    });	
}

function resetFormSpecificAccRend() {
	// $('.prcYear').val('');
	$('.prcQtr').val('');
	// $('.dept').val('');
	// $('.busType').val('');
	$('.reinsArr').val('');
	// $('.treatyCode').val('');
	// $('.cedingCode').val('');
	// $('.brokerCode').val('');
	$('.brokerCoRefNo').val('');
	$('.coQtr').val('');
	$('.coYear').val('');
	// $('.uwYear').val('');
	$('.identityInsured').val('');
	$('.typeRisk').val('');
	$('.curType').val('');
	// $('.curCode').val('');
	// $('.prcShare').val('');
	$('.premium').val('');
	$('.commission').val('');
	$('.orCommission').val('');
	$('.brokerAge').val('');
	$('.profitCommission').val('');
	$('.xlPremium').val('');
	$('.lossesPaid').val('');
	$('.premiumResWHeld').val('');
	$('.premiumResReles').val('');
	$('.interestOnPlRes').val('');
	$('.taxes').val('');
	$('.lossesResWHeld').val('');
	$('.lossesResReles').val('');
	$('.cashLossWHeld').val('');
	$('.cashLossReles').val('');
	$('.cashLossRefund').val('');
	$('.exchangeDifference').val('');
	$('.portPremium').val('');
	$('.portLosses').val('');
	$('.miscCharges').val('');
	$('.balance').val('');
	$('.recordDateTime').val('');
	$('.arTreatyType').val('');
	$('.arType').val('');
	$('.arDebitCredit').val('');
	$('.subUsingConfirmBtn').text('Create');
}

function reverseAccRend(id) {
	alert(id);
}
function calcBalance() {
	var orCommission = $('.orCommission').val()?parseFloat($('.orCommission').val()):0;
	var brokerAge = $('.brokerAge').val()?parseFloat($('.brokerAge').val()):0;
	var profitCommission = $('.profitCommission').val()?parseFloat($('.profitCommission').val()):0;
	var xlPremium = $('.xlPremium').val()?parseFloat($('.xlPremium').val()):0;
	var lossesPaid = $('.lossesPaid').val()?parseFloat($('.lossesPaid').val()):0;
	var premium = $('.premium').val()?parseFloat($('.premium').val()):0;
	var commission = $('.commission').val()?parseFloat($('.commission').val()):0;
	var premiumResWHeld = $('.premiumResWHeld').val()?parseFloat($('.premiumResWHeld').val()):0;
	var premiumResReles = $('.premiumResReles').val()?parseFloat($('.premiumResReles').val()):0;
	var interestOnPlRes = $('.interestOnPlRes').val()?parseFloat($('.interestOnPlRes').val()):0;
	var taxes = $('.taxes').val()?parseFloat($('.taxes').val()):0;
	var lossesResWHeld = $('.lossesResWHeld').val()?parseFloat($('.lossesResWHeld').val()):0;
	var lossesResReles = $('.lossesResReles').val()?parseFloat($('.lossesResReles').val()):0;
	var cashLossWHeld = $('.cashLossWHeld').val()?parseFloat($('.cashLossWHeld').val()):0;
	var cashLossReles = $('.cashLossReles').val()?parseFloat($('.cashLossReles').val()):0;
	var cashLossRefund = $('.cashLossRefund').val()?parseFloat($('.cashLossRefund').val()):0;
	var exchangeDifference = $('.exchangeDifference').val()?parseFloat($('.exchangeDifference').val()):0;
	var portPremium = $('.portPremium').val()?parseFloat($('.portPremium').val()):0;
	var portLosses = $('.portLosses').val()?parseFloat($('.portLosses').val()):0;
	var miscCharges = $('.miscCharges').val()?parseFloat($('.miscCharges').val()):0;

	var totalBalance = orCommission + brokerAge + profitCommission + xlPremium + lossesPaid + premium + 
						commission + premiumResWHeld + premiumResReles + interestOnPlRes + taxes + 
						lossesResWHeld + lossesResReles + cashLossWHeld + cashLossReles + cashLossRefund + 
						exchangeDifference + portPremium + portLosses + miscCharges;

	$('.balance').val(totalBalance);

	var bal = parseFloat(totalBalance);
	if ( bal > 0 ) {
		$('.arDebitCredit').val('d');
		$('.arDebitCreditDummy').val('Dr');
	} else if( bal < 0 ) {
		$('.arDebitCredit').val('c');
		$('.arDebitCreditDummy').val('Cr');
	}

}


function preventDefaultAnchorClass() {
	$('.prevent-default').on('click', function (e) {
		e.preventDefault();
	});
}


function formatDate(dateVal) {
    var newDate = new Date(dateVal);

    var sMonth = padValue(newDate.getMonth() + 1);
    var sDay = padValue(newDate.getDate());
    var sYear = newDate.getFullYear();
    var sHour = newDate.getHours();
    var sMinute = padValue(newDate.getMinutes());
    var sAMPM = "am";

    var iHourCheck = parseInt(sHour);

    if (iHourCheck > 12) {
        sAMPM = "pm";
        sHour = iHourCheck - 12;
    }
    else if (iHourCheck === 0) {
        sHour = "12";
    }

    sHour = padValue(sHour);

    return sMonth + "/" + sDay + "/" + sYear + " " + sHour + ":" + sMinute + ":00 " + sAMPM;
}

function padValue(value) {
    return (value < 10) ? "0" + value : value;
}


$(document).on('click','.subUsingConfirmBtn', function () {
	var modalMsgAction = $(this).text().trim();
	var stringMsg = $('.modalCustomAction').text();
		stringMsg = stringMsg.replace('Create','{action}');
		stringMsg = stringMsg.replace('Update','{action}');
		stringMsg = stringMsg.replace('Clone','{action}');
					
	stringMsg = stringMsg.replace('{action}',modalMsgAction);

	$('.modalCustomAction').text(stringMsg);
});
