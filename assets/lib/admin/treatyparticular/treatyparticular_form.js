console.log("Token: " + $('input[name="csrf_test_name"]').attr('value'));
// $(".create_"+$module).click(function (e) {
//     e.preventDefault();
//     // var url = base_url + $module + '/create';
//     // var formData = new FormData(document.getElementById($module+'_form'));

//     $.ajax({
//         url: $('#'+ $module+'_form').attr('action'),
//         type: 'POST',
//         data: new FormData(document.getElementById($module+'_form')),
//         contentType: false,
//         cache: false,
//         processData:false,
//         dataType: 'json',
//         headers: {
//             'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
//         },
//         success: function (response) {
//             $("input[name=csrf_test_name]").val(response.token); // NEW
//             var response = response.data;
//             if (response.code == 1) {
//                 console.log("Updated Token: " + $('input[name="csrf_test_name"]').attr('value'));
//                 // console.log(response);
//                 // $(".h_heading").text(response.message);
//                 // $('#modaldemo4').modal('show');
//                 window.location.href = base_url+$module;
//             }else if(response.code == 0){
//                 $(".h_heading").text(response.message);
//                 $('#modaldemo5').modal('show');
//             } 
//             else {
//                 console.log("Issue During Insertion: ");
//                 // console.log(response);
//             }
//         },
//         error: function (r) {
//             $("input[name=csrf_test_name]").val(r.token); // NEW              
//             console.log(r);
//             console.log('Error in retrieving Site.');
//         }
//     });

// });


// $(".update_"+$module).click(function () {
//     var formData = new FormData(document.getElementById($module+"_form"));

//     $.ajax({
//         url: base_url + $module +'/edit',
//         type: 'POST',
//         data: formData,
//         contentType: false,
//         cache: false,
//         processData: false,

//         dataType: 'json',
//         headers: {
//             'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
//         },
//         success: function (response) {
//             $("input[name=csrf_test_name]").val(response.token); // NEW
//             // console.log(response);
//             response = response.data;
//             if (response.code == 1) {
//                 console.log("Updated Token: " + $('input[name="csrf_test_name"]').attr('value'));
//                 $(".h_heading").text("Record Updated Successfully");
//                 $('#modaldemo4').modal('show');
//             }else if(response.code == 0){
//                 $(".h_heading").text(response.message);
//                 $('#modaldemo5').modal('show');
//             }
//             else{
//                 console.log("Issue During Updating: ");
//                 console.log(response);
//             }
//         },
//         error: function (r) {
//             $("input[name=csrf_test_name]").val(r.token); // NEW              
//             console.log(r);
//             console.log('Error in retrieving Site.');
//         }
//     });

// });



// $(document).on('click','.add_treaty_detail',function(){
//     var html = "";
//     var currencyOptions = $('#currency').html();


//     html += '<tr>'+
//           '<td scope="row"></td>'+

//           '<td><input type="text" class="form-control" name="treatyDetails[name][]" value=""></td>'+
//           '<td><input type="text" class="form-control" name="treatyDetails[prePreviousShare][]" ></td>'+
//           '<td><input type="text" class="form-control" name="treatyDetails[preProposedShare][]" ></td>'+
//           '<td><input type="text" class="form-control" name="treatyDetails[preApprovedShare][]" ></td>'+

//           '<td>'+
//             '<select name="treatyDetails[currencyCode][]" class="form-control" data-placeholder="Currency">'+
//                 currencyOptions +
//             '</select>'+
//           '</td>'+
//           '<td><a href="javascript:void(0)" class="anchor" data-toggle="modal" data-target=".stat-form">stats</a></td>'+
//           '<td><a href="javascript:void(0)" class="anchor" data-toggle="modal" data-target=".bd-example-modal-lg">View</a></td>'+
//           '<td><input type="radio" name="" value="1"></td>'+
//           '<td><input type="radio" name="" value="0"></td>'+
//         '</tr>';

//     $('#treaty_details').append(html);
//     tableRowUnique();
// });



