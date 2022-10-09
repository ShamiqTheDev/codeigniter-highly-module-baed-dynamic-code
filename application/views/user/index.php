<?php $this->load->view('includes/header', $this->data); ?>

<div class="br-mainpanel">
<!--    <div class="br-pageheader pd-y-15 pd-l-20">-->
<!--        <nav class="breadcrumb pd-0 mg-0 tx-12">-->
<!--            <a class="breadcrumb-item" href="#">Setup</a>-->
<!--            <span class="breadcrumb-item active">--><?php //print($ListingConfig['PageTitle']);?><!--</span>-->
<!--        </nav>-->
<!--    </div>-->
    <div class="pd-30">
<!--        <h4 class="tx-gray-800 mg-b-5">--><?php //print($ListingConfig['PageTitle']);?><!-- Information</h4>-->
<!--        <p class="mg-b-0">Listing</p>-->
    </div><!-- d-flex -->


    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="br-section-wrapper">
            <div id="wizard1">
                <div class="br-section-wrapper mg-t-20 " style="overflow-x:auto;">
                    <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 11px;">
                        <div class="col-sm-10 "><h3 style="border: none;margin-bottom: 10px;"   >Search <?php print($ListingConfig['PageTitle']);?></h3></div>

                    </div>
                    <!-- <div class="show_table">Loading...</div> -->
                    <?php
                        $attributes = array('class' => 'form-horizontal ', 'role' => 'searchingform', 'id' => 'searchingform');
                        echo form_open(current_url(), $attributes); ?>
                        <input type="hidden" name="search_data" value="1">
                        <div class="br-section-wrapper">
                            <!-- <input type="hidden" name="search_data" value="1"> -->
                            <div class="row mg-b-25">

                                <div class="col-lg-4">
                                    <div class="form-group form-validate">
                                        <label class="form-control-label"><U></U>User Name</label>
                                        <input class="form-control" type="text" name="userName"  placeholder="Enter User Name" >
                                    </div>
                                </div>
                                
                                <div class="col-lg-4">
                                    <div class="form-group form-validate mg-b-10-force">
                                        <label class="form-control-label">Email</label>
                                        <input class="form-control" type="email" name="email" placeholder="Enter Email Address">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="form-group form-validate mg-b-10-force">
                                        <label class="form-control-label">Role Name</label>
                                        <select class="form-control select2 roleOptions" name="roleDTO.id">
                                            <option value="">Select Role</option>
                                            <?php
                                            foreach ($roles as $role)
                                            {
                                                if (!empty($role->name)) {
                                                    print("<option value='".$role->id."'> $role->name </option>");
                                                }

                                            } ?>
                                        </select>
                                    </div>
                                </div><!-- form-layout-footer -->

                                
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-success pull-right search_form" id="search_form">Search <?php print($ListingConfig['PageTitle']);?></button>
                                </div>


                            </div>
                        </div><!-- form-layout -->
                    <?php echo form_close(); ?>


                </div>
            </div>

        </div>
    </div>

    

    <div class="row">
        <div class="col-sm-12" id="alertbox"><?php echo $this->session->flashdata('message');?></div>
    </div>



    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper">
            <div id="wizard1">
                <div class="br-section-wrapper mg-t-20 " style="overflow-x:auto;">
                    <div class="row" style="border-bottom: 1px solid #ccc;margin-bottom: 11px;">
                        <div class="col-sm-10 ">
                            <h3 style="border: none;margin-bottom: 10px;"   ><?php print($ListingConfig['PageTitle']);?></h3>
                        </div>
                        <?php if(isset($ListingConfig['ActionButtons']['Insert'])) {?>
                            <div class="col-sm-2 ">
                                <a href="<?php print($ListingConfig['URl'].'/create');?>" class="btn btn-success pull-right">Add New <?php print($ListingConfig['PageTitle']);?></a>
                            </div>
                        <?php }?>
                    </div>
                    <div class="show_table">Loading...</div>
                </div>
            </div>

        </div>


        <?php
        $attributes = array('class' => 'form-horizontal', 'role' => 'listingform', 'id' => 'listingform');
        echo form_open(current_url(), $attributes);
        ?>
        <input type="hidden" name="get_data" value="1">
        <input type="hidden" name="itemsPerPages" value="<?php echo $ListingConfig['ItemPerpage']?>">
        <input type="hidden" name="currentPage" id="currentPage" value="<?php echo $ListingConfig['currentPage']?>">
        <?php echo form_close(); ?>

        <?php $this->load->view('includes/footer', $this->data); ?>

        <script>
            Url = "<?php print($ListingConfig['URl']); ?>";
            DataColumns = '<?php print($ListingConfig['DataColumns']); ?>';
            ActionButtons = <?php if(isset($ListingConfig['ActionButtons']) && $ListingConfig['ActionButtons'] !=false && is_array($ListingConfig['ActionButtons'])){ echo "'".json_encode($ListingConfig['ActionButtons'])."';"; }else{ ?> false; <?php  } ?>
            PageTitle = "<?php print($ListingConfig['PageTitle']); ?>";

            ListingData(Url,encodeURIComponent(DataColumns),'','show_table',ActionButtons,PageTitle);

            setTimeout(function() {
                $('#alertbox').fadeOut('fast');
            }, 1000); // <-- time in milliseconds


        </script>
        <script src="<?php echo $includes_dir;?>lib\admin\user\listing.js"></script>
