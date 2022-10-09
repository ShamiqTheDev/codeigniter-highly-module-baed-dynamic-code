console.log("Token: " + $('input[name="csrf_test_name"]').attr('value'));

/*
*   Creation of dropdowns/etc functions
*/

function getModules() {
    getOptions('getModules','moduleOptions','Module');
}

$(document).ready(function () {
    /*
    *   Calling all dropdown functions
    */
    getModules();
});

// Datepicker
$('.datepicker').datepicker({
  showOtherMonths: true,
  selectOtherMonths: true
});



