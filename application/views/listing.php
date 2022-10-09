<?php $this->load->view('includes/header', $this->data); ?>

<div class="br-mainpanel">
<!--    <div class="br-pageheader pd-y-15 pd-l-20">-->
<!--        <nav class="breadcrumb pd-0 mg-0 tx-12">-->
<!--            <a class="breadcrumb-item" href="#">Setup</a>-->
<!--            <span class="breadcrumb-item active">--><?php //print($ListingConfig['PageTitle']);?><!--</span>-->
<!--        </nav>-->
<!--    </div>-->


<!--            <div class="row">-->
<!--                <div class="col-lg-4">-->
<!---->
<!--                </div>-->
<!---->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

    <div class="pd-30">
        <?php
            echo form_open(current_url(), array('class' => 'form-horizontal', 'role' => 'listingform', 'id' => 'listingform'));
        ?>
        <input type="hidden" name="get_data" value="1">
        <input type="hidden" name="itemsPerPages" value="<?php echo $ListingConfig['ItemPerpage']?>">
        <input type="hidden" name="currentPage" id="currentPage" value="<?php echo $ListingConfig['currentPage']?>">
        <?php if(isset($ListingConfig['sortBy'])){?>  <input type="hidden" name="direction" id="direction" value="<?php echo $ListingConfig['direction']?>"> <?php }?>

       <?php if(isset($ListingConfig['sortBy'])){?> <input type="hidden" name="sortBy" id="sortBy" value="<?php echo $ListingConfig['sortBy']?>"> <?php }?>
        <?php if(isset($ListingConfig['filters'])) { ?>
            <div class="br-section-wrapper">
                <div class="bg-gray-100 bd pd-x-20 pd-t-20-force pd-b-10-force">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group form-validate mg-b-10-force">
                                <label class="form-control-label"> Select Filters For <?=$ListingConfig['PageTitle']?></label>
                                <select id="givenFilters" class="select2 givenFilters" name="givenFilters" multiple="multiple">
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
                        <div class="col-sm-10 "><h3 style="border: none;margin-bottom: 10px;"   ><?php print($ListingConfig['PageTitle']);?></h3></div>
                        <?php 
                        if(isset($ListingConfig['ActionButtons']['Insert']) AND $ListingConfig['ActionButtons']['Insert'] != false) 
                        {
                            $BtnTitle = 'Add New '.$ListingConfig['PageTitle'];
                            if(isset($ListingConfig['BtnAddNewRecordTitle']))
                            {
                                $BtnTitle = $ListingConfig['BtnAddNewRecordTitle'];
                            }

                            if($ListingConfig['PageTitle'] =="Treaty Statistics" AND $this->uri->segment(2) =="index" OR $this->uri->segment(2) =="batches") {
                                $ButtonUrl = base_url('statistics/create');
                            } else if($this->uri->segment(1) == 'WorkFlow') {
                                $ButtonUrl = base_url('WorkFlow/create').'/'.$this->uri->segment(3);
                            } else if($this->uri->segment(1) == 'facultativeNote') {
                                $ButtonUrl =base_url('facultativeNote/details');
                            } else{
                                $ButtonUrl = ($ListingConfig['URl'] . '/create');
                            }
                            echo '<div class="col-sm-2 "><a href="'.$ButtonUrl.'" class="btn btn-success pull-right">'.$BtnTitle.'</a></div>';

                        }
                        ?>

                    </div>
                    <div class="show_table" style="overflow-x:auto;">Loading...</div>
                </div>
            </div>

        </div>
        <?php $this->load->view('includes/footer', $this->data); ?>
        <script>
            col_action = '<?php echo $this->lang->line('col_action')?>';
            col_serial = '<?php echo $this->lang->line('col_serial')?>';
            base_url = '<?php echo base_url()?>';
            Url = "<?php print($ListingConfig['URl']); ?>";
            DataColumns = '<?php print($ListingConfig['DataColumns']); ?>';
            ActionButtons = <?php if(isset($ListingConfig['ActionButtons']) && $ListingConfig['ActionButtons'] !=false && is_array($ListingConfig['ActionButtons'])){ echo "'".json_encode($ListingConfig['ActionButtons'])."';"; }else{ ?> false; <?php  } ?>
            PageTitle = "<?php print($ListingConfig['PageTitle']); ?>";

            ListingData(Url,encodeURIComponent(DataColumns),'','show_table',ActionButtons,PageTitle);
            
            $("#listingform").on("submit",function (e) {
                e.preventDefault();
                ListingData(Url,encodeURIComponent(DataColumns),'','show_table',ActionButtons,PageTitle);
            });
            
            
            setTimeout(function() {
                $('#alertbox').fadeOut('fast');
            }, 3000); // <-- time in milliseconds
            uRoleId = "<?php if(isset($uRoleId)){ echo $uRoleId;}else{echo '';}?>";
        </script>
