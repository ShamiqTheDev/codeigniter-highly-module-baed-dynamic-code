<?php $this->load->view('includes/header', $this->data); ?>

<div id="modaldemo5" class="modal fade show" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-danger  tx-semibold mg-b-20 h_heading"></h4>
                <?php
                $attributes = array('class' => 'form-horizontal', 'role' => 'delete_'.$module.'_popup', 'id' => 'delete_'.$module.'_popup');
                echo form_open(base_url().$module."/delete", $attributes);
                ?>
                <input type="hidden" id="id" name="id" value="">
                <?php echo form_close(); ?>

                <button type="button" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20 delete_<?=$module?>" data-dismiss="modal" aria-label="Close">
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
                <span class="breadcrumb-item active">Treaty Category</span>
            </nav>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="pd-30 form-heading-container" style="">
                    <h4 class="tx-gray-800 mg-b-5 form-heading">Treaty Category</h4>
                    <p class="mg-b-0"></p>
                </div>
            </div>
        </div><br>
        <div class="br-pagebody mg-t-5 pd-x-30">
            <div class="br-section-wrapper section-wrapper-shadow">


          <div id="wizard1">
<!--              <h3>Add New Treaty Category</h3>-->

              <section>
                
                  <?php
                    $attributes = array('class' => 'form-horizontal', 'id' => $module.'_form');
                    echo form_open(base_url().$module."/create", $attributes);
                    if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?=$response->id?>">
                  <?php
                    }
                  ?>

                  <div class="br-section-wrapper">

                      <div class="row mg-b-25">

                          <div class="col-lg-4">
                              <div class="form-group form-validate">
                                  <label class="form-control-label"><U></U>Treaty Category Name <span class="tx-danger">*</span></label>
                                  <input class="form-control" type="text" name="name" value="<?php echo (isset($response->name)) ? $response->name : ""; ?>" placeholder="Treaty Category Name">
                              </div>
                          </div>

                          <!-- form-layout-footer -->
                      </div>
                  </div><!-- form-layout -->
                  <br>
                  <?php if ($this->uri->segment(2) != "view"){ ?>
                  <button type="button" class="<?php echo (isset($response->name)) ? "update_".$module : "create_".$module; ?> btn btn-success tx-12 tx-uppercase tx-spacing-2"><?php echo (isset($response->name)) ? "Update" : "Create"; ?></button>
                  <?php } ?>
                  
                  <?php
                  echo form_close();
                  ?>
              </section>  



          </div>

      </div>

<?php $this->load->view('includes/footer', $this->data); ?>
<script>
    base_url = '<?=base_url()?>';
    $module = '<?=$module?>';
</script>
<script src="<?php echo $includes_dir; ?>lib/select2/js/select2.min.js"></script>

<script src="<?php echo $includes_dir; ?>lib/admin/<?=$module?>/<?=$module?>_form.js"></script>

