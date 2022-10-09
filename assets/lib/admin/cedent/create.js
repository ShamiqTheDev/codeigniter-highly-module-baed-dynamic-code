console.log("Token: " + $('input[name="csrf_test_name"]').attr('value'));
$(".create_cedent").click(function () {
    $.ajax({
        url: base_url + 'cedent/create',
        type: 'POST',
        data: $('#create_form').serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
            if (response.code == 1) {
                $("input[name=csrf_test_name]").val(response.token); // NEW              
                console.log("Updated Token: " + $('input[name="csrf_test_name"]').attr('value'));
                console.log(response);
                $(".h_heading").text("Record Added Successfully");
                $('#modaldemo4').modal('show');
            } else {
                console.log("Issue During Insertion: ");
                console.log(response);
            }
        },
        error: function (r) {
            console.log(r);
            console.log('Error in retrieving Site.');
        }
    });

});


$(".update_cedent").click(function () {
    $.ajax({
        url: base_url + 'cedent/edit',
        type: 'POST',
        data: $('#create_form').serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
            $("input[name=csrf_test_name]").val(response.token); // NEW              
            console.log("Updated Token: " + $('input[name="csrf_test_name"]').attr('value'));
            console.log(response);
            $(".h_heading").text("Record Updated Successfully");
            $('#modaldemo4').modal('show');
        },
        error: function (r) {
            console.log(r);
            console.log('Error in retrieving Site.');
        }
    });

});