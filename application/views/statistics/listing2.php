<?php $this->load->view('includes/header', $this->data); ?>

<!-- <div id="modaldemo5" class="modal fade show" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger  tx-semibold mg-b-20">Are you sure? You want to delete Treaty Statistics?</h4>
                <?php
                $attributes = array('class' => 'form-horizontal', 'role' => 'delete_'.$module.'_popup', 'id' => 'delete_'.$module.'_popup');
                echo form_open(base_url().$module."/delete", $attributes);
                ?>
                <input type="hidden" id="id" name="id" value="">
                <?php echo form_close(); ?>

                <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20 delete_<?php echo $module?>">
                    Continue
                </button>
                <button type="button" class="btn tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
            </div
        </div>
    </div>
</div> -->


<!-- <div id="modaldemo4" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-success tx-semibold mg-b-20 h_heading"></h4>
                <p class="mg-b-20 mg-x-20 p_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>
                <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                    OK</button>
            </div>
        </div>
    </div>
</div>
 -->
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



    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper">


            <div id="wizard1">
                <div class="br-section-wrapper mg-t-20">
                    <h3>Treaty Statistics</h3>

                    <div class="show_table">Loading...</div>
                    <div id="pagination" class="ht-80 d-flex align-items-center justify-content-center"></div>

                </div>



            </div>

        </div>

<!--         <script>
            base_url = '<?php echo base_url()?>';
            $module = '<?php echo $module?>';
        </script> -->
        <!-- <script src="<?php echo $includes_dir; ?>lib/admin/<?php echo $module?>/listing.js"></script> -->
        <?php $this->load->view('includes/footer', $this->data); ?>
<!-- 
        <script>
            Url = '<?php echo current_url(); ?>';
            // DataColumns = {"userName":"User Name","email":"Email","roleDTO_name":"Role Name"};
            DataColumns = {
                "treatyYear":"Treaty Year",
                "statisticsValue":"Treaty Statistics Value",
                "treatyParticularDTO.name":"Treaty Particular",
                "statisticsDate":"Statistics Date",
            };
            ListingData(Url,encodeURIComponent(JSON.stringify(DataColumns)),'','show_table',true);

        </script>
 -->

        <?php
            $attributes = array('class' => 'form-horizontal', 'role' => 'listingform', 'id' => 'listingform');
            echo form_open(current_url(), $attributes);
        ?>
            <input type="hidden" name="get_data" value="1">
            <input type="hidden" name="itemsPerPages" value="10">
            <input type="hidden" name="currentPage" value="0">
            <input type="hidden" name="direction" value="desc">
        <?php echo form_close(); ?>

        <?php $this->load->view('includes/footer', $this->data); ?>

        <script>
            Url = '<?php echo current_url(); ?>';
            DataColumns = {
                'treatyYear':'Treaty Year',
                'statisticsValue':'Treaty Statistics Value',
                // 'treatyParticularDTO_name':'Treaty Particular',
                'statisticsDate':'Statistics Date',
            };
            ListingData(Url,encodeURIComponent(JSON.stringify(DataColumns)),'','show_table',true);

        </script>
