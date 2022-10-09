console.log("Token 1: " + $('input[name="csrf_test_name"]').attr('value'));
$.ajax({
    url: base_url + 'cedent/listing',
    type: 'POST',
    data: $('#create_form').serialize(),
    dataType: 'json',
    headers: {
        'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
    },
    success: function (response) {

        var html = "";
        var counter = 0;
        html += '<table class="listing_table table table-striped table-bordered">' +
                '<thead>' +
                '<tr>' +
                '<th scope="col">Sr#</th>' +
                '<th scope="col">Cedent Code</th>' +
                '<th scope="col">Name</th>' +
                '<th scope="col">NTN</th>' +
                '<th scope="col">Contact Person</th>' +
                '<th scope="col">Cedent Status</th>' +
                '<th scope="col">Action</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
        if (response.get_data.length > 0) {
            $.each(response.get_data, function (index, value) {
                counter = counter + 1;
                html += '<tr id="' + value.id + '">' +
                        '<td>' + counter + '</td>' +
                        '<td>' + value.cedentCode + '</td>' +
                        '<td>' + value.name + '</td>' +
                        '<td>' + value.ntn + '</td>' +
                        '<td>' + value.contactPerson + '</td>' +
                        '<td>' + value.cedentStatus + '</td>' +
                        '<td><a href="' + base_url + 'cedent/view/' + value.id + '">View</a> | <a href="' + base_url + 'cedent/edit/' + value.id + '">Edit</a> |<a href="javascript:void(0)" class="delete_cedent_href" get_id="' + value.id + '">Delete</a></td>' +
                        '</tr>';
            });
            $("input[name=csrf_test_name]").val(response.get_csrf_hash); // NEW            


            pagination += '<ul class="pagination pagination-sm">'+
                '<li class="page-item"><a class="page-link" href="#">Previous</a></li>';

            for (var i = 1; i < response.totalPages ; i++) {
                pagination += '<li class="page-item"><a class="page-link" href="' + i + '">' + i + '</a></li>';
            }        
            
            pagination += '<li class="page-item"><a class="page-link" href="#">Next</a></li>' +
                '</ul>';


        } else {
            html += '<tr>' +
                    '<td colspan="6">Sorry, No Record Found...</td>' +
                    '</tr>';
        }

        html += '</tbody>' +
                '</table>';

        $(".show_table").html(html);
        $("#pagination").html(pagination);
        console.log(response);
        console.log("Updated Token 2: " + $('input[name="csrf_test_name"]').attr('value'));
    },
    error: function (r) {
        console.log(r);
        console.log('Error in retrieving Site.');
    }
});


//$(".delete_cedent_href").click(function () {
$(document.body).on('click', ".delete_cedent_href", function () {
    $("#id").val($(this).attr("get_id"));
    $('#modaldemo5').modal('show');


});


$(".delete_cedent").click(function () {
    $('#modaldemo5').modal('hide');
    console.log("Token 3: " + $('input[name="csrf_test_name"]').attr('value'));
    $.ajax({
        url: base_url + 'cedent/delete',
        type: 'POST',
        data: $('#delete_cedent_popup').serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
            if (response.code == 1) {
                $("input[name=csrf_test_name]").val(response.token); // NEW              
                console.log("Updated Token 4: " + $('input[name="csrf_test_name"]').attr('value'));
                console.log(response);
                $(".h_heading").text("Record Deleted Successfully");
                $('#modaldemo4').modal('show');
                var get_tr_id = $('#id').val();
                $('.listing_table #' + get_tr_id).hide();
            }else{
                console.log("Having Issue While deleting Record");
                console.log(response);
            }
        },
        error: function (r) {
            console.log(r);
            console.log('Error in retrieving Site.');
        }
    });

});