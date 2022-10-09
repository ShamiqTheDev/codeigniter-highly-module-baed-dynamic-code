<?php $this->load->view('includes/header', $this->data); ?>


<style>
    .pagination>li{display:inline}.pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd}
    .pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}.pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover{z-index:2;color:#23527c;background-color:#eee;border-color:#ddd}.pagination>.active>a,.pagination>.active>a:focus,.pagination>.active>a:hover,.pagination>
    .disabled {
        background: #e9ecef7a;
    }

    .fa-spinner {
        position: absolute;
        top: 90%;
        left: 43%;
        transform: translate(-10%, -50%);
        z-index: 5;
    }
</style>
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
<!--            <a class="breadcrumb-item" href="#">Setup</a>-->
<!--            <span class="breadcrumb-item active">Treaty Statistics</span>-->
        </nav>
    </div>
<!--    <div class="pd-30">-->
<!--        <h4 class="tx-gray-800 mg-b-5">Treaty Statistics Information</h4>-->
<!--        <p class="mg-b-0">Listing</p>-->
<!--    </div>-->
    <!-- d-flex -->


    <div class="pd-30">
        <?php
        echo form_open(current_url(), array('class' => 'form-horizontal', 'role' => 'listingform', 'id' => 'listingform'));
        ?>
        <input type="hidden" name="get_data" value="1">
        <input type="hidden" name="itemsPerPages" value="<?php echo $ListingConfig['ItemPerpage']?>">
        <input type="hidden" name="currentPage" id="currentPage" value="<?php echo $ListingConfig['currentPage']?>">
        <?php if(isset($ListingConfig['filters'])) { ?>
            <div class="br-section-wrapper">
                <div class="bg-gray-100 bd pd-x-20 pd-t-20-force pd-b-10-force">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group form-validate mg-b-10-force">
                                <label class="form-control-label"> Select Filters For <?=$ListingConfig['PageTitle']?></label>
                                <select id="givenFilters" class="select2 filters" name="givenFilters" multiple="multiple">
                                    <?php foreach ($ListingConfig['filters'] as $filter) { //dd($filter) ?>
                                        <option value="<?=$filter['name']?>" label="<?=$filter['label']?>"><?=$filter['label']?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div id="appendFilters" class="row">
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="pd-t-30-force pull-right">
                                <button type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        echo form_close();
        ?>
    </div>
    <div class="row">
        <div class="col-sm-12" id="alertbox"><?php echo $this->session->flashdata('message');?></div>
    </div>


    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper">
            <div id="wizard1">
                <div class="br-section-wrapper mg-t-20 " >
                    <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 11px;">
                        <div class="col-sm-10 "><h3 style="border: none;margin-bottom: 10px;"   ><?=$this->lang->line('menu_treatystatistics');?></h3></div>
                        <?php if(isset($ListingConfig['ActionButtons']['Insert']) AND $ListingConfig['ActionButtons']['Insert'] != false) 
                        { 
                            $btnTitle = $this->lang->line('btn_add_new_treatyStatistics');
                            if($ListingConfig['PageTitle'] =="Treaty Statistics" AND $this->uri->segment(2) =="index") 
                            {
                                echo '<div class="col-sm-2 "><a href="'.(base_url('statistics') . '/create').'" class="btn btn-success pull-right">'.$btnTitle.'</a></div>';
                            }elseif($ListingConfig['PageTitle'] =="Treaty Statistics" AND $this->uri->segment(2) =="batches"){
                                echo '<div class="col-sm-2 "><a href="'.(base_url('statistics') . '/create').'" class="btn btn-success pull-right">'.$btnTitle.'</a></div>';
                            }else {
                                echo '<div class="col-sm-2 "><a href="'.($ListingConfig['URl'] . '/create').'" class="btn btn-success pull-right">'.$btnTitle.'</a></div>';
                            }
                        }
                        ?>

                    </div>

                    <table class="listing_table table table-striped table-bordered" id="dataTable" >
                        <thead>
                        <tr>
                            <?php
                                foreach ($ListingConfig['DataColumns'] as $key => $ObjDataColumns)
                                {

                                    echo '<th>'.$ObjDataColumns.'</th>';
                                }

                                if(isset($ListingConfig['ActionButtons']))
                                {
                                    echo '<th>'.$this->lang->line('col_action').'</th>';
                                }

                            ?>

                        </tr>
                        </thead>
                        <tbody> </tbody>
                    </table>
                    <div class="row">
                        <div class="col-sm-12" id="dataTable_pagination">

                        </div>
                    </div>
                </div>
            </div>

        </div>




        <?php $this->load->view('includes/footer', $this->data); ?>



        <?php
            $attributes = array('class' => 'form-horizontal', 'role' => 'listingform', 'id' => 'listingform');
            echo form_open(current_url(), $attributes);
        ?>

            <input type="hidden" id="itemsPerPages" name="itemsPerPages" value="10">
            <input type="hidden" id="currentPage" name="currentPage" value="0">
            <input type="hidden" id="direction" name="direction" value="desc">
            <input type="hidden" id="total_records" name="total_records" value="0">
            <input type="hidden" id="myFilters" name="myFilters" value="">
        <?php echo form_close(); ?>


        <script>
            Url = '<?php echo current_url(); ?>';

            ActionButtons = <?php if(isset($ListingConfig['ActionButtons'])){ echo "'".json_encode($ListingConfig['ActionButtons'])."';"; }else{ ?> false; <?php  } ?>
            ActionButtons = JSON.parse(ActionButtons);
            DataColumns = '<?php print(json_encode($ListingConfig['DataColumns'])); ?>';

            var dataTable =  $('#dataTable').DataTable( {
                "processing": true,
                "language": {
                    processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                "drawCallback": function ()
                {
                    $('.dataTables_paginate > .pagination').addClass('pagination-basic pagination-success mg-b-0');
                    $('.dataTables_paginate > .pagination li').removeClass('paginate_button');
                    $('.dataTables_paginate > .pagination li').addClass('page-item');
                    $('.dataTables_paginate > .pagination a').addClass('page-link');
                },
                "serverSide": true,
                "searching": false,
                "bSort": false,
                "lengthChange": false,
                "info": false,
                'responsive': true,
                "autoWidth": false,
                "ajax":{
                    url: Url,
                    "type": "POST",
                    "data": function (d)
                    {
                        var top_search = {
                            total_records: $('#total_records').val(),
                            itemsPerPages: $('#itemsPerPages').val(),
                            currentPage: $('#currentPage').val(),
                            direction: $('#direction').val(),
                            myFilters: $('#myFilters').val(),

                        };

                        d.top_search = top_search;
                    },

                    "dataSrc" : function (json)
                    {
                        $("#total_records").val(json.recordsFiltered);
                        return json.data
                    },
                    "order": [[0, "asc"]],
                    "pageLength": 10,
                    "lengthMenu": [[10, 20, 50, -1], [10, 20, 50, "ALL"]],


                } ,
                columns: [


                    { data: 'treatyStatisticsNo' },
                    { data: 'cedentName'},
                    { data: 'cedentCode'},
                    { data: 'currentYear'},
                    { data: 'businessClasses' },
                    { data: 'treatyType' }

                ],

                createdRow: function( row, data, dataIndex )
                {
                    var sHtml = '';


                    sHtml +='<td>'+data['treatyStatisticsNo']+'</td>';
                    sHtml +='<td>'+data['cedentName']+'</td>';
                    sHtml +='<td>'+data['cedentCode']+'</td>';
                    sHtml +='<td>'+data['currentYear']+'</td>';
                    sHtml +='<td>'+data['businessClasses']+'</td>';
                    sHtml +='<td>'+data['treatyType']+'</td>';


                    sHtml +='<td>';

                    if(ActionButtons['View'] == true) {
                        sHtml +=   '<a href="' + Url + '/view/' + btoa(data['id']) + '">View</a> ';
                    }
                    if(ActionButtons['Edit'] == true) {
                        sHtml += ' | <a href="' + Url + '/edit/' + btoa(data['id']) + '">Edit</a> |';
                    }
                    if(ActionButtons['Delete'] == true) {
                        sHtml += '<a href="javascript:void(0)" class="delete_record" get_id="' + btoa(data['id']) + '">Delete</a>';
                    }
                    // dt_delete_record
                    sHtml +='</td>';

                    $(row).attr('id',data['id']);
                    $(row).html(sHtml);

                }

            } );

            $("#dataTable").removeClass("dataTable");

            $("#listingform").on('submit',function(e){
                e.preventDefault();
                $("#myFilters").val($(this).serialize());
                dataTable.draw();
            });

            $("#dataTable_wrapper").css({'display':'contents'});

            jQuery(document).ready(function(){
                $('.dataTables_paginate').insertAfter("#dataTable_pagination"); 
            });


        </script>
