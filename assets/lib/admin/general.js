/*
*
*   Created By      : Muhammad Shamiq Hussain
*   Last Updated    : 07-Sept-2020
*   Update History  : (created)07-Sept-2020
*   INFO            : JS Global Variables Effecive Across the board
*
*/

CURRENT_YEAR = new Date().getFullYear();
CURRENT_QUARTER = getQuarter();

/*
*
*   Created By      : Adeel Ahmed Baloch
*   Last Updated    : 10-March-2020
*   WARNING         : please Don't change anything in AddRecord,ListingData,& Other Delete function without my permission..
*
*/

// Start From Hare AddRecord,ListingData,& Other Delete function
function AddRecord()
{
    $("#confirmed").attr('disabled',true);
    $('#create_form :input[type=submit]').attr('disabled',true);
     $.ajax({
            url:$("#create_form").attr('action'),
            type: 'POST',
            data: new FormData(document.getElementById("create_form")),
            contentType: false,
            cache: false,
            processData:false,
            dataType: 'json',
            headers: {
                'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
            },
            success: function (response)
            {
                $("input[name=csrf_test_name]").val(response.token); // NEW
                $(".h_heading").text(response.message);
                if(response.code == 1) {
                    window.location.replace(response.path);
                }else if(response.code == 0)
                {
                    $('#confirmationModal_once').modal('hide');
                    $("#confirmed").attr('disabled',false);
                    $('#modal_error').modal('show');
                    $('#create_form :input[type=submit]').attr('disabled',false);

                }
            },
            complete: function() {
                $(this).data('requestRunning', false);
            },
            error: function (r) {
                clog('Error in retrieving Site.');
                clog(r);
            }
        });
}


function ListingData(Url,DataColumns,pageNo=0,ContainerId='',ActionButtons,PageTitle='')
{


    if(ContainerId !='')
    {
        ContainerId='show_table'
    }


    if( pageNo =='')
    {
        pageNo=0;
    }


    $("#currentPage").val(pageNo);
    DataColumns = JSON.parse(decodeURIComponent(DataColumns));
    ActionButtons = JSON.parse(decodeURIComponent(ActionButtons));
    DataColsLength = Object.keys(DataColumns).length + 3; // + for SR# col 
    Url =  decodeURIComponent(Url);

    $.ajax({
        url: Url,
        type: 'POST',
        data: $('#listingform').serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response)
        { 
            // defined null variables
            var html = nextPageAttr = pgNextStatus = pgStatus = pgPrevStatus = "";
            var pgStart = pgEnd = pgPrevButton  = pgPages = pgNextButton = "";

            // data variable for table looping
            var data            = response.get_data.data;
            // clog(data);
            // Pagination variables
            var totalPages      = response.get_data.totalPages;
            var totalElements   = response.get_data.totalElements;
            var nextPageNo      = pageNo+1;
            var prevPageNo      = pageNo-1;

            if(response.pagination) {
                var pagination_server_side = "<div style='margin-top: 10px;' id='pagination'>"+response.pagination+"</div>";
            }
            /*
             *
             *  TABLE WORK START
             *
             */
            html += '<table class="listing_table table table-striped table-bordered" >' +
                '<thead>' +
                '<tr><th scope="col">'+col_serial+'</th>' +
                '';

            $.each(DataColumns, function(key, value){
                if (key == 'premium' || key == 'xlPremium' || key == 'premiumResWHeld' || key == 'premiumResReles') {
                    // show only after premium calcs premiumResReles *is last in DataColumns arr 
                    if (key == 'premiumResReles') {
                        html +='<th scope="col">'+value+'</th>' ;
                        // html +='<th scope="col">Premium</th>' ;
                    }
                } 
                else if(key == 'commission' || key == 'orCommission' || key == 'profitCommission' || key == 'brokerAge' || key == 'miscCharges' || key == 'exchangeDifference') {
                    // show only after premium calcs premiumResReles *is last in DataColumns arr 
                   if (key == 'exchangeDifference') {
                    html +='<th scope="col">'+value+'</th>' ;
                   //     html +='<th scope="col">Commission</th>' ;
                   }
               } 
                //else if(key == 'lossesPaid') {
                   // html +='<th scope="col">Losses</th>';
               // } 
              //  else if (key == 'cedentDTO_customerName') {
                //    html +='<th scope="col">Cedent Name</th>';
                //} 
                else {
                    html +='<th scope="col">'+value+'</th>' ;
                }
            });

            if(ActionButtons) {
                html +='<th scope="col">'+col_action+'</th>' ;
            }
            html +='</tr></thead><tbody>';

            if (data.length > 0) {
                var counter = pageNo*10;
                // clogd('data');
                // clog(data);
                $.each(data, function(index, subData) {
                    var sumOfPremium = sumOfComission = sumOfLosses = 0;
                    counter = counter + 1;
                    if (SEGMENT_1 == 'statistics') {
                        html += '<tr id="'+ subData.treatyStatisticsNo + '">';
                    } else {
                        html += '<tr id="'+ subData.id + '">';
                    }
                    html +='<td>' + counter + '</td>' ;
                    $.each(DataColumns, function(Columnkey, ColumnName) {
                        $.each(subData, function(index_subData, value_subData) {
                            
                            if(Columnkey == index_subData) {
                                if (Columnkey == 'premium' || Columnkey == 'xlPremium' || Columnkey == 'premiumResWHeld' || Columnkey == 'premiumResReles') {
                                    sumOfPremium += parseFloat(value_subData);
                                    
                                    if (Columnkey == 'premiumResReles') {
                                        html += '<td>' + sumOfPremium + '</td>';
                                    }
                                } else if(Columnkey == 'commission' || Columnkey == 'orCommission' || Columnkey == 'profitCommission' || Columnkey == 'brokerAge' || Columnkey == 'miscCharges' || Columnkey == 'exchangeDifference') {
                                    sumOfComission += parseFloat(value_subData);
                                    
                                    if (Columnkey == 'exchangeDifference') {
                                        html += '<td>' + sumOfComission + '</td>';
                                    }
                                } else if(Columnkey == 'lossesPaid') {
                                    sumOfLosses += parseFloat(value_subData);

                                    // this duplication is made due future flexibility formulas can be changed
                                    // if (Columnkey == 'lossesPaid') {
                                        html += '<td>' + sumOfLosses + '</td>';
                                    // }
                                } else if(Columnkey == 'arType') {
                                    var arType = '';
                                    switch (value_subData) {
                                        case 'a':
                                            arType = 'Auto'; break;
                                        case 'm':
                                            arType = 'Manual'; break;
                                        case 'r':
                                            arType = 'Reversal'; break;
                                        default:
                                            arType = '-';
                                    }
                                    html += '<td>' + arType + '</td>';
                                } else if(Columnkey == 'arDebitCredit') {
                                    var arDebitCredit = '';
                                    switch (value_subData) {
                                        case 'd':
                                            arDebitCredit = 'Dr'; break;
                                        case 'c':
                                            arDebitCredit = 'Cr'; break;
                                        default:
                                            arDebitCredit = '-';
                                    }
                                    html += '<td>' + arDebitCredit + '</td>';
                                } else if(Columnkey == 'arTreatyType') {
                                    var arTreatyType = '';
                                    switch (value_subData) {
                                        case 'p':
                                            arTreatyType = 'Proportional'; break;
                                        case 'n':
                                            arTreatyType = 'Non-Proportional'; break;
                                        default:
                                            arTreatyType = '-';
                                    }
                                    html += '<td>' + arTreatyType + '</td>';
                                }
                                
                                else {
                                    var value = '';
                                    if (value_subData) {
                                        value = value_subData;   
                                    }else{
                                        value = '-';
                                    }
                                    html += '<td>' + value + '</td>';
                                }
                            }


                            if(Columnkey.replace('_custom_date', '') == index_subData && Columnkey.search("_custom_date") !== -1) {
                                var NewDate =  moment(Date.parse(value_subData)).format('DD-MMM-YYYY');
                                html += '<td>' + NewDate + '</td>';
                            }

                            if(typeof(value_subData) == "object"  && Columnkey.search("_custom_date") == -1 && Columnkey.search("_") !== -1) {
                                var MyArr = Columnkey.split("_");

                                if(subData[MyArr[0]] != null) {
                                    var subVal = subData[MyArr[0]][MyArr[1]];
                                    if (MyArr[2]) {
                                        subVal = (typeof(subVal) == 'object')?subVal[MyArr[2]]:subVal;
                                    }
                                    if (SEGMENT_1 == 'statistics' && MyArr[0] == 'businessDTOs') {
                                        // alert(typeof subData[MyArr[0]][0][MyArr[1]]+'--'+subData[MyArr[0]][0][MyArr[1]]);
                                        subVal = (subData[MyArr[0]].length > 0)?subData[MyArr[0]][0][MyArr[1]]:'';
                                    }
                                    html += '<td>' + (subVal?subVal:'-') + '</td>';
                                }
                                // else if (Columnkey == 'cedentDTO_customerName') {
                                //     var val = ((subData.treatierDTOS) && (subData.treatierDTOS[0].treatyStatisticsDTO.cedentDTO.customerName))
                                //                 ?subData.treatierDTOS[0].treatyStatisticsDTO.cedentDTO.customerName:'-';
                                //     html += '<td>'+val+'</td>';
                                // }
                                // else if (Columnkey == 'businessDTOs_name') {
                                //     var val = ((subData.treatierDTOS) && subData.treatierDTOS[0].treatyStatisticsDTO.businessDTOs[0].name)
                                //                 ?subData.treatierDTOS[0].treatyStatisticsDTO.businessDTOs[0].name:'-';
                                //     html += '<td>'+val+'</td>';
                                // }
                                else{
                                    html += '<td> - </td>';
                                }
                                return false;
                            }
                        });
                        // if (Columnkey =='noOfTreaties') {
                        //     // alert('here');
                        //     var val = subData.treatierDTOS.length;
                        //         html += '<td>'+val+'</td>';
                        // }
                    });

                    if(ActionButtons)
                    {
                        html +=   '<td>';
                        var url = $(location).attr('href');
                        var segments = url.split( '/' );

                            if(ActionButtons['View_TreatySlip'] == true) {
                                // html +=   '<a href="' + Url + '/treaty_slip/' + btoa(subData.id) + '/agreemnt">Treaty Slip</a> |'  ;
                                html +=   '<a href="' + Url + '/slips/' + btoa(subData.id) + '">Edit & Endorsement & Renewal</a> ';
                            }

                            if(ActionButtons['ViewWorkFlowName'] == true) {
                                html +=   '<a href="' + BASE_URL + 'WorkFlow/index/' + btoa(subData.id) + '">View Work Flow Details</a> '  ;
                            }


                            if(ActionButtons['View_TreatySlips'] == true) {
                                var Flag = subData.flagChangeHistoryDTOs[subData.flagChangeHistoryDTOs.length-1]
                                var url_cont = BASE_URL + 'treaty/';
                                if(ActionButtons['Add_Endorsement'] == true) {
                                    if(Flag.treatierFlagDTO.name =="opened" || Flag.treatierFlagDTO.name =="open") {
                                        html +=   '<a href="' + url_cont + 'endorsement/' + btoa(subData.id) + '">Endorsement</a> '  ;
                                    }
                                }
                                if(ActionButtons['Create_Renewal'] == true) {
                                    html +=   '| <a href="' + url_cont + 'createRenewal/' + btoa(subData.id) + '">Renewal</a> '+ (ActionButtons['View_TreatySlips'] ?' | ':'') ;

                                }
                                if(ActionButtons['Account_Rendering'] == true) {
                                    var acRendUrl = BASE_URL + 'accountRendering/edit/' + btoa(subData.id);
                                    html +=   '| <a href="'+acRendUrl+'">Account Rendering</a> '  ;
                                }

                            }


                            if(ActionButtons['view_treaty_slip_entered'] == true) {

                                var view_treaty_slip_url = BASE_URL + 'treaty/view_treaty_slip/'+ btoa(subData.id);
                                var pipeOp = (SEGMENT_2 == 'entered') ?' | ':'';
                                html +=   '<a href="' + view_treaty_slip_url + '">View</a> '+ pipeOp ;
                            }

                            if(ActionButtons['view_slip'] == true) {
                                var roleId = response.get_data[index].roleDTO.id;
                                if (roleId == uRoleId /*|| uRoleId == 1*/) {
                                    var url = BASE_URL + 'treaty/treaty_slip/'+ btoa(subData.id);
                                    html += '| <a href="' + url + '">Treaty Slip </a> ';
                                }
                            }

                            if (ActionButtons['customView'] == true) {
                                var acRendUrl = BASE_URL + 'accountRendering/edit/' + btoa('noIdNeededHere') + '/' + btoa(subData.id);
                                html +=   '<a href="'+acRendUrl+'">View</a> ';
                            }

                            if(ActionButtons['view_by_batch'] == true) {
                                var url = BASE_URL + 'statistics/index/null/' + subData.batchId;
                                html += '<a href="'+url+'">View Statistics Batch</a> '  ;
                            }
                            if( SEGMENT_1=="statistics" && (SEGMENT_2 == 'index' || SEGMENT_2 == '') ) {
                                var CustomUrl = Url.slice(0, Url.lastIndexOf('/'));
                                var CustomUrl = CustomUrl.slice(0, CustomUrl.lastIndexOf('/'));
                                var CustomUrl = CustomUrl.slice(0, CustomUrl.lastIndexOf('/'));

                                if(ActionButtons['View'] == true) {
                                    var url = base_url + 'statistics/view/' + btoa(subData.id);
                                    html += '<a href="'+url+'"> View</a> | ';
                                }
                                if(ActionButtons['Edit'] == true) {
                                    var url = base_url + 'statistics/edit/' + btoa(subData.id);
                                    html += '<a href="'+url+'"> Edit</a> | ';
                                }
                                if(ActionButtons['Delete'] == true) {
                                    html += '<a href="javascript:void(0)" class="delete_record" get_id="' + btoa(subData.treatyStatisticsNo) + '"> Delete</a>';
                                }
                            }else{
                                if (SEGMENT_1 == 'WorkFlow') {
                                    Url = BASE_URL + 'WorkFlow';
                                }
                                if (SEGMENT_1 === 'facultativeNote' && (ActionButtons['View'] == true || ActionButtons['Edit'] == true)) {
                                    Url = BASE_URL + 'facultativeNote/details';
                                }

                                if(ActionButtons['View'] == true) {
                                    html +=   '<a href="' + Url + '/view/' + btoa(subData.id) + '/' + SEGMENT_3 +'">View</a> ';
                                }
                                if(ActionButtons['Edit'] == true) {

                                    html += ' | <a href="' + Url + '/edit/' + btoa(subData.id) + '/' + SEGMENT_3 + '">Edit</a>';
                                }
                                if(ActionButtons['Delete'] == true) {
                                    html += ( (ActionButtons['View'] || ActionButtons['Edit']) ?' | ':'')+'<a href="javascript:void(0)" class="delete_record" get_id="' + btoa(subData.id) + '">Delete</a>';
                                }
                                // if(ActionButtons['arCreate'] == true) {
                                //     html += ' | <a href="' + Url + '/arCreate/' + btoa(subData.id) + '">Create</a>';
                                // }
                            }


                            html += '</td>' ;


                    }
                    html +='</tr>' ;
                });

                $("input[name=csrf_test_name]").val(response.get_csrf_hash); // NEW

                /*
                 *
                 *  PAGINATION WORK START
                 *
                 */


                pgStart += '<ul class="pagination pagination-basic pagination-success mg-b-0">';

                pgPrevButton += '<li class="page-item"><a class="page-link" onClick=" ListingData(\''+encodeURIComponent(Url)+'\',\''+encodeURIComponent(JSON.stringify(DataColumns))+'\','+prevPageNo+',\''+ContainerId+'\',\''+encodeURIComponent(JSON.stringify(ActionButtons))+'\',\''+PageTitle+'\')" aria-label="Previous">'+
                    '<i class="fa fa-angle-left"></i></a></li>';

                var skipCounter = 0;
                // var j = (pageNo>6)?pageNo-4:1;
                for (var i = 1/*j*/; i <= totalPages ; i++) {
                    skipCounter++;
                    // alert(i);
                    if (i==(pageNo+1)) {
                        pgPages += '<li class="page-item active"><a class="page-link" href="javascript:void(0);">' + i + '</a></li>';
                    } 
                    // else if (skipCounter==(pageNo+6)) {
                    //     var jumpToIteration = (totalPages-(pageNo+1))-10;
                    //     i += jumpToIteration;
                    //     pgPages += '<li class="page-item"><a class="page-link"> ... </a></li>';   
                    // } 
                    else {
                        pgPages += '<li class="page-item"><a class="page-link" onClick="ListingData(\''+encodeURIComponent(Url)+'\',\''+encodeURIComponent(JSON.stringify(DataColumns))+'\',' + (i-1) + ',\''+ContainerId+'\',\''+encodeURIComponent(JSON.stringify(ActionButtons))+'\',\''+PageTitle+'\')">' + i + '</a></li>';
                    }
                }
                if (nextPageNo < totalPages) {
                    nextPageAttr = 'onClick="ListingData(\''+encodeURIComponent(Url)+'\',\''+encodeURIComponent(JSON.stringify(DataColumns))+'\',' + nextPageNo + ',\''+ContainerId+'\',\''+encodeURIComponent(JSON.stringify(ActionButtons))+'\',\''+PageTitle+'\')"';
                } else {
                    pgNextStatus = "disabled";
                }
                if ((pageNo+1) <= 1) {
                    pgPrevButton="";
                }
                pgNextButton += '<li class="page-item '+pgNextStatus+'"><a class="page-link" '+nextPageAttr+' aria-label="Next">'+
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
                    '<td colspan="'+DataColsLength+'">Sorry, No Record Found...</td>' +
                    '</tr>';
            }

            html += '</tbody>' +
                '</table>';

            /*
             *
             *  END TABLE WORK
             *
             */
            if(response.pagination)
            {
                // $( ".show_table" ).after( pagination_server_side );
                html +=pagination_server_side;
            }
            else
            {
                if(typeof pagination !='undefined')
                {
                    html +=pagination;
                    // $( ".show_table" ).after( pagination );
                }
            }

            $("."+ContainerId).html(html);

        },
        error: function (r) {
            clog(r);
        }
    });
}


$(document.body).on('click', ".delete_record", function () {
    $("#id").val($(this).attr("get_id"));
    $(".h_heading").text('Do you want to delete this Record?');
    $('#modaldemo5').modal('show');
});

$("#delete_record").on("submit",function(e){
    e.preventDefault();
    var url = $(this).attr('action');

    if (SEGMENT_1 == 'WorkFlow') {
        url = BASE_URL + SEGMENT_1 + '/delete';        
    }
    
    $.ajax({
        url: url,
        type: 'POST',
        data: $(this).serialize(),
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {

            $("input[name=csrf_test_name]").val(response.token); // NEW
            $(".h_heading").text(response.message);
            $('#modaldemo4').modal('show');
            $('#modaldemo5').modal('hide');
            var get_tr_id = $('input[name="id"]').val();
            $('.listing_table #' + atob(get_tr_id)).hide();
        },
        error: function (r) {
            clog('Error in retrieving Site.');
            clog(r);
        }
    });

});

// End Hare AddRecord,ListingData,& Other Delete function



/*
*
*   Created By      : Muhammad Shamiq Hussain
*   Last Updated    : 23-April-2020
*   Update History  : 23-April-2020, 16-April-2020, 16-March-2020
*   WARNING         : Updating/changing in this function may cause all site dropdowns failure .
*
*/
function getOptions($method,$appendClassName,$label='Option',$id='',customModule='',othersOption=false) {
    id = ($id?'/'+$id:'');
    var module = (customModule?customModule:$module);
    $.ajax({
        url: base_url + module +'/'+$method + id,
        type: 'GET',
        dataType: 'json',
        headers: {
            'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
        },
        success: function (response) {
            clog(response.data);
            $("input[name=csrf_test_name]").val(response.token);
            var options = '';
            if ($label) {
                options += '<option value="">Select '+$label+'</option>';
            }
            if (response.condition_id) {
                $('.'+$appendClassName).attr('data-id',response.condition_id);
            }
            var responseLength = response.data?response.data.length:0;
            if (responseLength > 0) {
                $('.'+$appendClassName).parent().parent().show();
                clogd($appendClassName);
                clog(response.data);
                var dbSelectVal = $('.'+$appendClassName).attr('data-select');

                var dbSelectIds = [];

                if (dbSelectVal != null) {
                    dbSelectIds = dbSelectVal.split(',');
                    clog('data-selected');
                    clog(dbSelectIds);
                }else{
                    dbSelectIds.push(dbSelectVal);
                }
                $.each(response.data ,function (key, val)
                {
                    var selected = '';
                    if (dbSelectIds.includes(val.id))
                    {
                        var selected = 'selected="selected"';                       
                    }

                    if (val.customerName)
                    {
                       options += '<option value="'+val.id+'" '+selected+'>'+val.customerName+'</option>';
                    }else if(val.name){
                        options += '<option value="'+val.id+'" '+selected+'>'+val.name+'</option>';
                    }else if(val.treatyName){
                        options += '<option value="'+val.id+'" '+selected+'>'+val.treatyName+'</option>';
                    }else if(val.moduleName){
                        options += '<option value="'+val.id+'" '+selected+'>'+val.moduleName+'</option>';
                    }else if(val.conditionType){
                        options += '<option value="'+val.id+'" '+selected+'>'+val.conditionType+'</option>';
                    }else if(val.condition){
                        options += '<option value="'+val.id+'" '+selected+'>'+val.condition+'</option>';
                    }else if(val.tCode){
                        options += '<option value="'+val.tCode+'" '+selected+'>'+val.tCode+'</option>';
                    }else if(val.tName){
                        options += '<option value="'+val.id+'" '+selected+'>'+val.tName+'</option>';
                    }else if(val.type){
                        options += '<option value="'+val.id+'" '+selected+'>'+val.type+'</option>';
                    }
                    
                });

                if (othersOption) {
                    options += '<option value="other">Other</option>';
                }

            }else{
                // $('.'+$appendClassName).parent().parent().hide();
                clog('Class '+$appendClassName+' loaded with empty options');
            }
            if (response.rowId) {
                // alert(response.rowId);
                $('.rowId_'+response.rowId).html(options);
                $('.2rowId_'+response.rowId).html(options);
            }else{
                $('.'+$appendClassName).html(options);                
            }
        },
        error: function (r) {
            $("input[name=csrf_test_name]").val(r.token);              
        }
    });
}


/*
*
*   Created By      : Muhammad Shamiq Hussain
*   Last Updated    : 07-Sept-2020
*   Update History  : (created)07-Sept-2020
*   INFO            : JS Global get quarter function
*
*/
function getQuarter(d) {
    d = d || new Date();
    var m = Math.floor(d.getMonth() / 3) + 2;
    m -= m > 4 ? 4 : 0;
    var y = d.getFullYear() + (m == 1? 1 : 0);
    return [y,m];
}

$(document).on('change','#givenFilters',function ()
{
    var filters = $('#givenFilters option:selected');
    // clog(filters);
    var inputs = '<input type="hidden" name="filter" value="1">';
    $.each(filters,function (k,filter) {
        var filterLabel = filter.label;
        var filterName = filter.value;
        inputs += '<div class="col-lg-4">'+
                    '<div class="form-group form-validate mg-b-10-force">'+
                        '<label class="form-control-label">'+filterLabel+'</label>'+
                        '<input type="text" class="form-control" name="filters['+filterName+']" placeholder="Search '+filterLabel.toLowerCase()+'" >'+ 
                    '</div>'+
               '</div>';
    });
    inputs += '<div class="col-lg-4" style="margin: 27px 0px 0px 0px;"> <input type="reset" value="Reset" class="btn btn-success"> <button class="btn btn-success" onclick="window.location.href=\''+BASE_URL+'\'">Exit</button></div>';
    $('#appendFilters').html(inputs);
});



/*
*
*   Created By            : Adeel Ahmed Baloch
*   Created Date          : 12-Jan-2021
*   Last Modifide Date    : 12-Jan-2021
*   Update History        : 12-Jan-2021,
*   WARNING               : Updating/changing in this function may cause all site dropdowns failure .
*   Description           : this function will fill select options via ajax 
*
*/
function AjaxFillAllList(sDataSource, sTargetListBoxName, iDefaultValue='')
{
        
     $(sTargetListBoxName).empty();
    
   
    var sURL = sDataSource;
    $.ajax({ 
        type: "GET", 
        url: sURL, 
        async: false,
        cache: false,
        dataType: 'json',
        success: function(data)
        {

            for (i=0; i < data.length; i++)
                $(sTargetListBoxName).append('<option value="' + data[i][0] + '">' + data[i][1] + '</option>');
       
           if (iDefaultValue != "")
                $(sTargetListBoxName).val(iDefaultValue);
            
           }

           
    });

    return true;
}