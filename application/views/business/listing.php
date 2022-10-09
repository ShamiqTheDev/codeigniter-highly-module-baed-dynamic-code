<?php $this->load->view('includes/header', $this->data); ?>

<div id="modaldemo5" class="modal fade show" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger  tx-semibold mg-b-20">Are you sure? You want to delete Business?</h4>
                <?php
                $attributes = array('class' => 'form-horizontal', 'role' => 'delete_business_popup', 'id' => 'delete_business_popup');
                echo form_open(base_url()."business/delete", $attributes);
                ?>
                <input type="hidden" id="id" name="id" value="">
                <?php echo form_close(); ?>

                <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20 delete_business">
                    Continue
                </button>
                <button type="button" class="btn tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                    Cancel
                </button>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>


<div id="modaldemo4" class="modal fade" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-success tx-semibold mg-b-20 h_heading"></h4>
                <!--<p class="mg-b-20 mg-x-20 p_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>-->
                <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                    OK</button>
            </div><!-- modal-body -->
        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div>

<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Business</span>
        </nav>
    </div>
    <div class="pd-30">
        <h4 class="tx-gray-800 mg-b-5">Business Information</h4>
        <p class="mg-b-0">Listing</p>
    </div><!-- d-flex -->



    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper">


            <div id="wizard1">
                <div class="br-section-wrapper mg-t-20">
                    <h3>List of Business</h3>  

                    <div class="show_table">Loading...</div>
                    <div id="pagination" class="ht-80 d-flex align-items-center justify-content-center"></div>

                </div>



            </div>

        </div>
        <?php
        $attributes = array('class' => 'form-horizontal', 'role' => 'create_form', 'id' => 'create_form');
        echo form_open(current_url(), $attributes);
        ?>
        <input type="hidden" name="get_data" value="1">
        <input type="hidden" name="itemsPerPages" value="5">
        <input type="hidden" name="currentPage" value="0">
        <?php echo form_close(); ?>

        <?php $this->load->view('includes/footer_js', $this->data); ?>
        <script>
            base_url = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo $includes_dir; ?>lib/admin/business/listing.js"></script>
        <?php $this->load->view('includes/footer', $this->data); ?>