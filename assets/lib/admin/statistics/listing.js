console.log("Token 1: " + $('input[name="csrf_test_name"]').attr('value'));
function list(pageNo=0) {
    $.ajax({
        url: base_url + $module + '/index/'+btoa(pageNo),
        type: 'POST',
        data: $('#create_form').serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {

            $("input[name=csrf_test_name]").val(response.get_data.token); // NEW
            // defined null variables
            var html = "";
            var pgStart = pgEnd = pgPrevButton  = pgPages = pgNextButton = nextPageAttr = pgNextStatus = pgStatus = pgPrevStatus = ""; 

            // data variable for table looping
            var data            = response.get_data.data;
            console.log(response.get_data);
            
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


                    '<th scope="col">Treaty Year</th>' +
                    '<th scope="col">Treaty Statistics Value</th>' +
                    '<th scope="col">Treaty Particular</th>' +
                    '<th scope="col">Statistics Date</th>' +


                    '<th scope="col">Acions</th>' +
                    
                    '</tr>' +
                    '</thead>' +
                    '<tbody>';
                    console.log(data+'----');
            if (data.length > 0) {
                var counter = 0;
                $.each(data, function (index, value) {
                    
                    counter = counter + 1;
                    html += '<tr id="' + value.id + '">' +

                            '<td>' + counter + '</td>' +

                            '<td>' + value.treatyYear + '</td>' +
                            '<td>' + value.statisticsValue + '</td>' +
                            '<td>' + value.treatyParticularDTO.name + '</td>' +
                            '<td>' + value.statisticsDate + '</td>' +


                            '<td>'+
                                '<a href="' + base_url + $module +'/view/' + btoa(value.id) + '">View</a> | '+
                                '<a href="' + base_url + $module +'/edit/' + btoa(value.id) + '">Edit</a> | '+
                                '<a href="javascript:void(0)" class="delete_'+$module+'_href" get_id="' + value.id + '">Delete</a>'+
                            '</td>' +
                            
                            '</tr>';
                });
                $("input[name=csrf_test_name]").val(response.token); // NEW    

                
                /*
                 *
                 *  PAGINATION WORK START
                 *
                 */

                pgStart += '<ul class="pagination pagination-basic pagination-success mg-b-0">';

                pgPrevButton += '<li class="page-item"><a class="page-link" onClick="list('+prevPageNo+')" aria-label="Previous">'+
                '<i class="fa fa-angle-left"></i></a></li>';

                for (var i = 1; i < totalPages ; i++) {

                    if (i==pageNo) {
                        pgStatus="active";
                    }else{
                        pgStatus="";
                    }

                    pgPages += '<li class="page-item '+pgStatus+'"><a class="page-link" onClick="list('+i+')">' + i + '</a></li>';
                }

                if (nextPageNo < totalPages) {
                    nextPageAttr = 'onClick="list('+nextPageNo+')"';                    
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
            console.log("Updated Token 2: " + $('input[name="csrf_test_name"]').attr('value'));
        },
        error: function (r) {
            console.log(r);
            console.log('Error in retrieving Site.');
        }
    });
    
}
$(document).ready(function(){
    list();
});
