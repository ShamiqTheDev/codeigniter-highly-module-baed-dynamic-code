console.log("Token: " + $('input[name="csrf_test_name"]').attr('value'));

/*
*   Creation of dropdowns/etc functions
*/

function getCedents() {
    getOptions('getCedents','cedentOptions','Cedent');
}

$(document).ready(function () {
    /*
    *   Calling all dropdown functions
    */
    getCedents();
});

// Datepicker
$('.datepicker').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true
});



