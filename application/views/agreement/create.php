<?php $this->load->view('includes/header', $this->data);

$disabled = '';
if($action =="view_record"){
    $disabled = 'disabled';
}

$downloadLink = "";
if (isset($response->filePath)) {
    $downloadLink = "(View: <a href='".base_url('uploads/agreement/'.$response->filePath) ."' download>Uploaded Agreement</a>)";
}

?>

<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Treaty Agrement</span>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Treaty Agreement</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>
<?php
  $attributes = array(
      'class'   => 'form-horizontal', 
      'id'      => $module.'_form',
  );
  echo form_open_multipart(base_url().$module."/create", $attributes);
  if ( $this->uri->segment(2) == 'edit') { ?>
    <input type="hidden" name="treatyAgreement[id]" value="<?php echo isset($response->id)?$response->id:''?>">
  <?php }
?>

<!-- d-flex -->
<div class="br-pagebody mg-t-5 pd-x-30">
  
  <div class="br-section-wrapper mg-t-20 section-wrapper-shadow">
<!--    <h3>Create New Agreement</h3>-->
    <div class="row mg-b-25">
        <?php //if ($this->uri->segment(2) != 'edit'){ ?>
        <!-- <div class="col-lg-4">
            <div class="form-group form-validate mg-b-10-force">
                <label class="form-control-label">AGR No. <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="treatyAgreement[agreementNumber]" value="<?php echo isset($response->agreementNumber)?$response->agreementNumber:'AGR'.date('Ymdh').'HO'?>" readonly <?php echo $disabled?>>
            </div>
        </div> -->
        <?php //dd($response); //} ?>

        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Agreement Date <span class="tx-danger">*</span></label>
              <div class="input-group"> <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                <input type="text" name="treatyAgreement[agreementDate]" class="form-control fc-datepicker-agreement" placeholder="MM/DD/YYYY" value="<?php echo isset($response->agreementDate)?date('m/d/Y',strtotime($response->agreementDate)):''?>" <?php echo $disabled?> autocomplete="off">
              </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group form-validate">
                <label class="form-control-label">File <span class="tx-danger">*</span> <?php echo $downloadLink?> </label>
                <input type="file" name="file" class="form-control" <?php echo $disabled?>>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group form-validate mg-b-10-force">
              <label class="form-control-label">Statistical Year <span class="tx-danger">*</span></label>
              <select name="treatyAgreement[statisticsYear]" required class="form-control statisticsYear select2" <?php echo $disabled?>>
                    <option value="">Choose Year</option>
                    <?php
                    $yearsBack = date('Y')-10;
                    foreach (range(date('Y'), $yearsBack) as $year) {
                      $selected = '';
                      if (isset($response->statisticsYear) && $response->statisticsYear == $year) {
                        $selected = 'selected="selected"'; 
                      }
                    ?>
                    <option value="<?php echo $year?>" <?php echo $selected?>><?php echo $year?></option>
                    <?php
                    }
                    ?>      
                </select>
            </div>
        </div>

        <?php ///if ($this->uri->segment(2) == 'create'){ ?>
          
        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Cedent Name <span class="tx-danger">*</span></label>
              <select name="treatyAgreement[cedentId]" class="form-control select2 cedentOptions"  <?php echo $disabled?> data-select="<?php echo isset($treatyDetails[0]->treatyStatisticsDTO->cedentDTO)? ($treatyDetails[0]->treatyStatisticsDTO->cedentDTO->id):''?>">

              </select>
            </div>
        </div>
        
        <?php //} ?>
        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Treaty Category <span class="tx-danger">*</span></label>
              <select name="treatyAgreement[treatyCategoryDTO_id]" required class="form-control treatyCategoryOptions select2" <?php echo $disabled?> data-placeholder="Choose Option" data-select="<?php echo isset($response->treatyCategoryDTO)? ($response->treatyCategoryDTO->id):''?>">

              </select>

            </div>
        </div>
        
          <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Meeting Date <span class="tx-danger">*</span></label>
              <div class="input-group"> <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                <input name="treatyAgreement[meetingDate]" type="text" required class="form-control fc-datepicker-meeting" placeholder="MM/DD/YYYY" value="<?php echo isset($response->meetingDate)?date('m/d/Y',strtotime($response->meetingDate)):''?>" <?php echo $disabled?> autocomplete="off">
              </div>
            </div>
          </div>

          <?php // if ($this->uri->segment(2) != 'edit'){ ?>
          <div class="col-lg-4">
            <div class="form-group form-validate mg-b-10-force">
              <label class="form-control-label">Meeting Locations <span class="tx-danger">*</span></label>
              <input class="form-control string" type="text" required name="treatyAgreement[meetingLocation]" placeholder="Enter Meeting Locations" value="<?php echo isset($response->meetingLocation)?$response->meetingLocation:''?>" <?php echo $disabled?>>
            </div>
          </div>
          <?php //} ?>

          <div class="col-lg-4">
            <div class="form-group form-validate mg-b-10-force">
              <label class="form-control-label">PRCL Officials <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" required name="treatyAgreement[prcOfficialsName]" placeholder="Enter PRCL Officials" value="<?php echo isset($response->prcOfficialsName)?$response->prcOfficialsName:''?>" <?php echo $disabled?>>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="form-group form-validate mg-b-10-force">
              <label class="form-control-label">Cedent Officials <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" required name="treatyAgreement[cedentOfficialsName]" placeholder="Enter Cedent Officials" value="<?php echo isset($response->cedentOfficialsName)?$response->cedentOfficialsName:''?>" <?php echo $disabled?>>
            </div>
          </div>

          <!-- col-4 -->
          <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Remarks  <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" required name="treatyAgreement[agreementRemarks]" placeholder="Enter Remarks" value="<?php echo isset($response->agreementRemarks)?$response->agreementRemarks:''?>" <?php echo $disabled?>>
            </div>
          </div>
      <!-- Right -->
    </div>
    <!-- form-layout -->
  </div>
  <?php 
      // Treaty Details
      $this->load->view($module.'/treaty_details'); 
  ?>

  </div>
  <?php if ($this->uri->segment(2) != 'view' ){ ?>
  <div class="pl-3">
    <div class="pl-3 col-lg-2">
      <div class="pd-t-30-force">
          <input type="hidden" name="action" id="action" value="<?php echo isset($response->id)?"update":"add";?>">
          <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 <?php echo  isset($response->id)?'update_'.$module:'create_'.$module ?>" value="<?php echo  isset($response->id)?'Update':'Submit' ?> Agreement">
      </div>
    </div>
  </div>
  <?php } ?>

  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content statesFor5Year">
      </div>
    </div>
  </div>
  <div class="statModals">
    <div class="modal fade stat-form-1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow1">
      <div class="modal-dialog modal-lg">
                      
        <div class="modal-content" style="width: 830px;">
            <div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 5px 10px 0px 0px;"><span aria-hidden="true">&times;</span></button>
            </div>
          <div class="br-section-wrapper mg-t-20">
            <div class="loader"></div>
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Select</th>
                  <th>Statistics ID</th>
                  <th>Year</th>
                  <th>Cedent</th>
                  <!-- <th>Business Class</th> -->
                  <th>Treaty Type</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody id="treatyStateRows">
              </tbody>
              <tfoot>
                <tr>
                  <td colspan="7">
                    <button type="button" class="btn btn-success" id="closemodal"> Select Stats </button>
                      <p id="error_msg"></p>
                  </td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
<div>
<?php $this->load->view('includes/footer', $this->data); ?>
</div>
<?php echo form_close(); ?>
<script>
    base_url = '<?php echo base_url()?>';
    $module = '<?php echo $module?>';
    pageOperation = '<?php echo $this->uri->segment(2)?>';
    detailsCount = '<?php echo isset($treatyDetails)?count($treatyDetails):"0"?>';
</script>

<script src="<?php echo $includes_dir; ?>lib/select2/js/select2.min.js"></script>

<script src="<?php echo $includes_dir; ?>lib/admin/<?php echo $module?>/create.js"></script>

<script> //moved all js to admin create.js </script>
