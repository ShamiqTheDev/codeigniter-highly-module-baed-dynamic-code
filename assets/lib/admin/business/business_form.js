console.log("Token: " + $('input[name="csrf_test_name"]').attr('value'));


function getBusinessOptions() {
	getOptions('get','businessOptions','Parent Business');
}


$(document).ready(function () {
	getBusinessOptions();
});