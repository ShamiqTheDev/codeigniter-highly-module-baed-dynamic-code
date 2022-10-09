// console.log("Token 1: " + $('input[name="csrf_test_name"]').attr('value'));
// function listUsers(pageNo=0) {
//     $.ajax({
//         url: base_url + 'user/index/'+btoa(pageNo),
//         type: 'POST',
//         data: $('#create_form').serialize(),
//         dataType: 'json',
//         headers: {
//             'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
//         },
//         success: function (response) {
//
//             // defined null variables
//             var html = "";
//             var pgStart = pgEnd = pgPrevButton  = pgPages = pgNextButton = nextPageAttr = pgNextStatus = pgStatus = pgPrevStatus = "";
//
//             // data variable for table looping
//             var data            = response.get_data.data;
//
//             // Pagination variables
//             var totalPages      = response.get_data.totalPages;
//             var totalElements   = response.get_data.totalElements;
//             var nextPageNo      = pageNo+1;
//             var prevPageNo      = pageNo-1;
//             /*
//              *
//              *  TABLE WORK START
//              *
//              */
//             html += '<table class="listing_table table table-striped table-bordered">' +
//                     '<thead>' +
//                     '<tr>' +
//
//                     '<th scope="col">Sr#</th>' +
//
//                     '<th scope="col">User Name</th>' +
//                     '<th scope="col">Email</th>' +
//                     '<th scope="col">Mobile No.</th>' +
//                     '<th scope="col">Role Name</th>' +
//                     '<th scope="col">Acion</th>' +
//
//
//                     '</tr>' +
//                     '</thead>' +
//                     '<tbody>';
//             if (data.length > 0) {
//                 var counter = 0;
//                 $.each(data, function (index, value) {
//
//                     counter = counter + 1;
//                     html += '<tr id="' + value.id + '">' +
//
//                             '<td>' + counter + '</td>' +
//
//                             '<td>' + value.userName + '</td>' +
//                             '<td>' + value.email + '</td>' +
//                             '<td>' + value.mobileNo + '</td>' +
//                             '<td>' + value.roleDTO.name + '</td>' +
//
//
//                             '<td>'+
//                                 '<a href="' + base_url + 'user/view/' + btoa(value.id) + '">View</a> | '+
//                                 '<a href="' + base_url + 'user/edit/' + btoa(value.id) + '">Edit</a> | '+
//                                 '<a href="javascript:void(0)" class="delete_user_href" get_id="' + value.id + '">Delete</a>'+
//                             '</td>' +
//
//                             '</tr>';
//                 });
//                 $("input[name=csrf_test_name]").val(response.get_csrf_hash); // NEW
//
//
//                 /*
//                  *
//                  *  PAGINATION WORK START
//                  *
//                  */
//
//                 pgStart += '<ul class="pagination pagination-basic pagination-success mg-b-0">';
//
//                 pgPrevButton += '<li class="page-item"><a class="page-link" onClick="listUsers('+prevPageNo+')" aria-label="Previous">'+
//                 '<i class="fa fa-angle-left"></i></a></li>';
//
//                 for (var i = 1; i < totalPages ; i++) {
//
//                     if (i==pageNo) {
//                         pgStatus="active";
//                     }else{
//                         pgStatus="";
//                     }
//
//                     pgPages += '<li class="page-item '+pgStatus+'"><a class="page-link" onClick="listUsers('+i+')">' + i + '</a></li>';
//                 }
//
//                 if (nextPageNo < totalPages) {
//                     nextPageAttr = 'onClick="listUsers('+nextPageNo+')"';
//                 }else{
//                     pgNextStatus = "disabled";
//                 }
//
//                 if (pageNo <= 1) {
//                     pgPrevButton="";
//                 }
//
//                 pgNextButton += '<li class="page-item '+pgNextStatus+'"><a class="page-link"  '+nextPageAttr+' aria-label="Next">'+
//                 '<i class="fa fa-angle-right"></i></a></li>';
//
//                 if ( !(nextPageNo < totalPages) ) {
//                     pgNextButton="";
//                 }
//
//                 pgEnd += '</ul>' ;
//
//                 var pagination = pgStart + pgPrevButton + pgPages + pgNextButton + pgEnd; // forming pagination
//
//                 /*
//                  *
//                  *  END PAGINATION WORK
//                  *
//                  */
//
//             } else {
//                 html += '<tr>' +
//                         '<td colspan="6">Sorry, No Record Found...</td>' +
//                         '</tr>';
//             }
//
//             html += '</tbody>' +
//                     '</table>';
//
//             /*
//              *
//              *  END TABLE WORK
//              *
//              */
//             $(".show_table").html(html);
//             $("#pagination").html(pagination);
//             console.log(response);
//             console.log("Updated Token 2: " + $('input[name="csrf_test_name"]').attr('value'));
//         },
//         error: function (r) {
//             console.log(r);
//             console.log('Error in retrieving Site.');
//         }
//     });
//
// }
// $(document).ready(function(){
//     listUsers();
// });
//
//
// //$(".delete_cedent_href").click(function () {
// $(document.body).on('click', ".delete_user_href", function () {
//     $("#id").val($(this).attr("get_id"));
//     $('#modaldemo5').modal('show');
// });
//
//
// $(".delete_user").click(function () {
//     $('#modaldemo5').modal('hide');
//     console.log("Token 3: " + $('input[name="csrf_test_name"]').attr('value'));
//     $.ajax({
//         url: base_url + 'user/delete',
//         type: 'POST',
//         data: $('#delete_user_popup').serialize(),
//         dataType: 'json',
//         headers: {
//             'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
//         },
//         success: function (response) {
//             if (response.code == 1) {
//                 $("input[name=csrf_test_name]").val(response.token); // NEW
//                 console.log("Updated Token 4: " + $('input[name="csrf_test_name"]').attr('value'));
//                 console.log(response);
//                 $(".h_heading").text("Record Deleted Successfully");
//                 $('#modaldemo4').modal('show');
//                 var get_tr_id = $('#id').val();
//                 $('.listing_table #' + get_tr_id).hide();
//             }else{
//                 console.log("Having Issue While deleting Record");
//                 console.log(response);
//             }
//         },
//         error: function (r) {
//             console.log(r);
//             console.log('Error in retrieving Site.');
//         }
//     });
//
// });

// Filters
$(".search_form").on("click",function(e) {
	e.preventDefault();

	Url =  decodeURIComponent(Url);

	$.ajax({
        url: Url,
        type: 'POST',
        data: $('#searchingform').serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },

        success: function (response)
        {
        	var data = response.search_data.data
        	$("input[name=csrf_test_name]").val(response.token);
        	alert(response.data);
        },
        error: function (r) {
            alert(r);
        }
    });
});


function SearchingData(Url,DataColumns,ContainerId='')
{


    if(ContainerId !='')
    {
        ContainerId='searching_table'
    }

    DataColumns = JSON.parse(decodeURIComponent(DataColumns));

    Url =  decodeURIComponent(Url);


    $.ajax({
        url: Url,
        type: 'POST',
        data: $('#searchingform').serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response)
        { 
            // defined null variables
            var html  = "";
            

            // data variable for table looping
            var data            = response.get_data.data;
            // console.log(data);
            
            var totalElements   = response.get_data.totalElements;
            
            /*
             *
             *  TABLE WORK START
             *
             */
            html += '<table class="listing_table table table-striped table-bordered">' +
                '<thead>' +
                // '<tr><th scope="col">Sr#</th>' +
                '';

            $.each(DataColumns, function(key, value){
                html +='<th scope="col">'+value+'</th>' ;
            });

            
            html +='</tr></thead><tbody>';

            if (data.length > 0) {
                var counter = 0;

                $.each(data, function(index, subData)
                {


                    counter = counter + 1;
                    html += '<tr id="'+ subData.id + '">';
                    // html +='<td>' + counter + '</td>' ;
                    $.each(DataColumns, function(Columnkey, ColumnName)
                    {
                        $.each(subData, function(index_subData, value_subData)
                        {

                            if(Columnkey == index_subData)
                            {
                                html += '<td>' + value_subData + '</td>';
                            }

                            if(Columnkey.replace('_custom_date', '') == index_subData && Columnkey.search("_custom_date") !== -1)
                            {
                                const monthNames = ["January", "February", "March", "April", "May", "June",
                                    "July", "August", "September", "October", "November", "December"
                                ];
                                var CompleteDate = new Date(Date.parse(value_subData));
                                var Year = CompleteDate.getFullYear();
                                    var Month = CompleteDate.getMonth();
                                var Day = CompleteDate.getDay();
                                var NewDate =  Day+"-"+monthNames[Month]+"-"+Year;
                                html += '<td>' + NewDate + '</td>';
                            }

                            if(typeof(value_subData) == "object"  && Columnkey.search("_custom_date") == -1 && Columnkey.search("_") !== -1)
                            {
                                var MyArr = Columnkey.split("_");


                                if(subData[MyArr[0]] != null)
                                {
                                    html += '<td>' + subData[MyArr[0]][MyArr[1]] + '</td>';
                                }
                                else
                                {
                                    html += '<td>undefined</td>';
                                }

                                return false;
                            }



                        });

                    });
                    html +='</tr>' ;
                });

                $("input[name=csrf_test_name]").val(response.get_csrf_hash); // NEW

                /*
                 *
                 *  PAGINATION WORK START
                 *
                 */

            } else {
                html += '<tr>' +
                    '<td colspan="6">Sorry, No Record Found...</td>' +
                    '</tr>';
            }

            html += '</tbody>' +
                '</table>';

            $("."+ContainerId).html(html);

        },
        error: function (r) {
            console.log(r);
        }
    });
}