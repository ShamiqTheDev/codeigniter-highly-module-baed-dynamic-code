// $("#login_form").on("submit",function(e){
//     e.preventDefault();
//
//     $.ajax({
//         url: $(this).attr('action'),
//         type: 'POST',
//         data: $(this).serialize(),
//         dataType: 'json',
//         headers: {
//             'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
//         },
//         success: function (response)
//         {
//             $("input[name=csrf_test_name]").val(response.csrf_token); // NEW
//             if (response.code == 1) {
//                 window.location.replace(response.path);
//
//             }else if(response.code == 0){
//
//                 $('.error_msg').html('<div class="alert alert-danger" role="alert" style="margin: 15px 0px 0px 0px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'+response.message+'</div>');
//             }
//             else {
//                 console.log(response);
//             }
//         },
//         error: function (r)
//         {
//             console.log('Error in retrieving Site.');
//         }
//     });
//
// });


function login()
{
    $.ajax({
        url: $("#login_form").attr('action'),
        type: 'POST',
        data: $("#login_form").serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response)
        {
            $("input[name=csrf_test_name]").val(response.csrf_token); // NEW
            if (response.code == 1) {
                window.location.replace(response.path);

            }else if(response.code == 0){

                $('.error_msg').html('<div class="alert alert-danger" role="alert" style="margin: 15px 0px 0px 0px;"><button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>'+response.message+'</div>');
            }
            else {
                console.log(response);
            }
        },
        error: function (r)
        {
            console.log('Error in retrieving Site.');
        }
    });
}