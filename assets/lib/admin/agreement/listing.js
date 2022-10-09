console.log("Token 1: " + $('input[name="csrf_test_name"]').attr('value'));
function listUsers(pageNo=1) {
    $.ajax({
        url: base_url + 'user/listing/'+pageNo,
        type: 'POST',
        data: $('#create_form').serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {

            // defined null variables
            var html = nextPageAttr = pgNextStatus = pgStatus = pgPrevStatus = "";
            var pgStart = pgEnd = pgPrevButton  = pgPages = pgNextButton = ""; 

            // data variable for table looping
            var data            = response.get_data.data;
            
            // Pagination variables
            var totalPages      = response.get_data.totalPages;
            var totalElements   = response.get_data.totalElements;
            var nextPageNo      = pageNo+1;
            var prevPageNo      = pageNo-1;
            /*
             *
             *  TABLE WORK START
             *
             */
            html += '<table class="listing_table table table-striped table-bordered">' +
                    '<thead>' +
                    '<tr>' +

                    '<th scope="col">Sr#</th>' +

                    '<th scope="col">User Name</th>' +
                    '<th scope="col">Email</th>' +
                    '<th scope="col">Mobile No.</th>' +
                    '<th scope="col">Role Name</th>' +
                    '<th scope="col">Acion</th>' +

                    
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
            if (data.length > 0) {
                var counter = 0;
                $.each(data, function (index, value) {
                    counter = counter + 1;
                    html += '<tr id="' + value.pageNo + '">' +

                            '<td>' + counter + '</td>' +
                           
                            '<td>' + value.userName + '</td>' +
                            '<td>' + value.email + '</td>' +
                            '<td>' + value.mobileNo + '</td>' +
                            '<td>' + value.roleDTO.name + '</td>' +
                           

                            '<td>'+
                            '<a href="' + base_url + 'user/view/' + value.id + '">View</a> | '+
                            '<a href="' + base_url + 'user/edit/' + value.id + '">Edit</a> | '+
                            '<a href="javascript:void(0)" class="delete_user_href" get_id="' + value.id + '">Delete</a>'+
                            '</td>' +
                            
                            '</tr>';
                });
                $("input[name=csrf_test_name]").val(response.get_csrf_hash); // NEW    

                
                /*
                 *
                 *  PAGINATION WORK START
                 *
                 */

                pgStart += '<ul class="pagination pagination-basic pagination-success mg-b-0">';

                pgPrevButton += '<li class="page-item"><a class="page-link" onClick="listUsers('+prevPageNo+')" aria-label="Previous">'+
                '<i class="fa fa-angle-left"></i></a></li>';

                for (var i = 1; i < totalPages ; i++) {

                    if (i==pageNo) {
                        pgStatus="active";
                    }else{
                        pgStatus="";
                    }

                    pgPages += '<li class="page-item '+pgStatus+'"><a class="page-link" onClick="listUsers('+i+')">' + i + '</a></li>';
                }

                if (nextPageNo < totalPages) {
                    nextPageAttr = 'onClick="listUsers('+nextPageNo+')"';                    
                }else{
                    pgNextStatus = "disabled";
                }

                if (pageNo <= 1) {
                    pgPrevButton="";
                }

                pgNextButton += '<li class="page-item '+pgNextStatus+'"><a class="page-link"  '+nextPageAttr+' aria-label="Next">'+
                '<i class="fa fa-angle-right"></i></a></li>';

                if ( !(nextPageNo < totalPages) ) {
                    pgNextButton="";                    
                }

                pgEnd += '</ul>' ;

                var pagination = pgStart + pgPrevButton + pgPages + pgNextButton + pgEnd; // forming pagination

                /*
                 *
                 *  END PAGINATION WORK
                 *
                 */

            } else {
                html += '<tr>' +
                        '<td colspan="6">Sorry, No Record Found...</td>' +
                        '</tr>';
            }
                    
            html += '</tbody>' +
                    '</table>';

            /*
             *
             *  END TABLE WORK
             *
             */
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
    
}
$(document).ready(function(){
    listUsers();
});


//$(".delete_cedent_href").click(function () {
$(document.body).on('click', ".delete_user_href", function () {
    $("#id").val($(this).attr("get_id"));
    $('#modaldemo5').modal('show');
});


$(".delete_user").click(function () {
    $('#modaldemo5').modal('hide');
    console.log("Token 3: " + $('input[name="csrf_test_name"]').attr('value'));
    $.ajax({
        url: base_url + 'user/delete',
        type: 'POST',
        data: $('#delete_user_popup').serialize(),
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