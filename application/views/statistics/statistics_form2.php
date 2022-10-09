<?php $this->load->view('includes/header', $this->data); ?>

<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
        </nav>
    </div>




<div class="br-pagebody mg-t-5 pd-x-30">
<?php
  $attributes = array('class' => 'form-horizontal', 'id' => $module.'_form');
  echo form_open(current_url(), $attributes);
  if ($this->uri->segment(2) == 'edit') { ?>
      <input type="hidden" name="id" value="<?php echo $response->id?>">
      <input type="hidden" name="treatyUploadedFilePath" value="no-upload.xlsx">
<?php
  }
  $status=$style='';
  // $showFormForView = false;
  if ($this->uri->segment(2) == "view"){
    $status = 'disabled="disabled"';
    // $showFormForView = false;
    $style = 'style="display: none"';
  }
?>

    <div <?=$style?> class="br-section-wrapper mg-t-20">
      <h3>Treaty States</h3>

      <section>
      
        <div class="row mg-b-25">
    
          <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Statistics ID <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" id="statisticsId" value="<?php echo $response->treatyStatisticsNo?>" placeholder="Statistics ID" readonly> 
            </div>
          </div>
          <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Date <span class="tx-danger">*</span></label>
              <input <?php echo $status?> class="form-control fc-datepicker" type="text" id="statisticsDate" name="statisticsDate" value="<?php echo (isset($response->statisticsDate)) ? $response->statisticsDate : ""; ?>" placeholder="Date"> 
            </div>
          </div>
      
          <div class="col-lg-4">
              <div class="form-group form-validate">
                <label class="form-control-label">Cedent Name   <span class="tx-danger">*</span></label>
                <select <?php echo $status?> class="form-control select2 cedentOptions" data-select="<?php echo isset($response->cedentDTO->id)?$response->cedentDTO->id:''?>" name="cedentDTO.id" data-placeholder="Choose Option">
                  
                </select>
              </div>
          </div>

          <?php if ($this->uri->segment(2) == "create"){ ?>
          <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Treaty Statistics Document:<span class="tx-danger">*</span></label>
              <input class="form-control" type="file" id="date" name="treatyUploadedFile" placeholder="Date"> 
            </div>
          </div>
          <?php } ?>
          <div class="col-lg-4">
            <div class="form-group form-validate mg-b-10-force">
              <label class="form-control-label"> Year </label>
              <select <?php echo $status?> class="form-control select2 treatyYear" name="treatyYear" data-placeholder="Choose Year">
                  <option label="Choose Year"></option>
                  <?php
                  $treatyYear = isset($response->treatyYear)?$response->treatyYear:'';
                  $yearsBack = date('Y')-10;
                  foreach (range(date('Y'), $yearsBack) as $year) {
                  ?>
                  <option value="<?php echo $year?>" <?php echo activeInput('select', $treatyYear, $year )?>><?php echo $year?></option>
                  <?php
                  }
                  ?>     
              </select>
            </div>
          </div>


          <?php
            $dataIds='';
            $busnessDTO = isset($response->businessDTOs)?$response->businessDTOs:[];
            foreach ($busnessDTO as $business) {
              if (isset($business->id)) {
                $dataIds .= $business->id.',';
              }
            }
          ?>
          <div class="col-lg-4">
            <div class="form-group form-validate">
                <label class="form-control-label">Business Class <span class="tx-danger">*</span></label>
                <select <?php echo $status?> class="form-control select2 getBusinessOptions" data-select="<?php echo !empty($dataIds)?$dataIds:''?>" name="businessDTO.id[]" data-placeholder="Choose Business Class" multiple>
                  
                </select>
            </div>
          </div><!-- col-4 -->                  
          <?php
            $busnessDTO = isset($response->businessDTOs)?$response->businessDTOs:[];
            $dataIds='';
            foreach ($busnessDTO as $business) {
              if (isset($business->id)) {
                $dataIds .= $business->id.',';
              }
            }
          ?>
          <div class="col-lg-4" >
            <div class="form-group form-validate">
              <label class="form-control-label">Sub Business Class</label>
              <select <?php echo $status?> class="form-control select2 getSubBusinessOptions" data-select="<?php echo !empty($dataIds)?$dataIds:''?>" data-placeholder="Choose Sub Business Class" name="subBusniessClass[]" multiple>
              </select>

            </div>
          </div><!-- col-4 -->
          <div class="col-lg-4">
              <div class="form-group form-validate">
                  <label class="form-control-label">Treaty Category <span class="tx-danger">*</span></label>
                    <select <?php echo $status?> class="form-control select2 treatyCategoryOptions" data-select="<?php echo isset($response->treatyCategoryDTO->id)?$response->treatyCategoryDTO->id:''?>" name="treatyCategoryDTO.id" data-placeholder="Choose Treaty Category">
                    </select>
              </div>
          </div><!-- col-4 -->

          <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Treaty Remarks <span class="tx-danger">*</span></label>
              <input <?php echo $status?> class="form-control" type="text" id="remarks" name="remarks" value="<?php echo isset($response->remarks)?$response->remarks:''?>" placeholder="Treaty Remarks">                    
            </div>
          </div><!-- col-4 -->
            <!-- form-layout-footer -->
        </div>
        <br>
        <?php if ($this->uri->segment(2) != "view"){ ?>
        <button type="button" class="<?php echo (isset($response->id)) ? "update_".$module : "create_".$module; ?> btn btn-success tx-12 tx-uppercase tx-spacing-2 subUsingConfirmBtn">
            <?php echo (isset($response->id)) ? "Update" : "Create"; ?>
        </button>
        <?php } ?>
        

      </section>  
    </div>

  <div class="br-section-wrapper mg-t-20 treatyStatesTable">
  </div>

 <?php
echo form_close();
?>


<?php $this->load->view('includes/footer', $this->data); ?>
<script>
    base_url = '<?php echo base_url()?>';
    $module = '<?php echo $module?>';
    pageAction = '<?php echo $this->uri->segment(2)?>';
</script>
<script src="<?php echo $includes_dir; ?>lib/select2/js/select2.min.js"></script>

<script>
  clog("Token: " + $('input[name="csrf_test_name"]').attr('value'));
  $(".create_"+$module).click(function (e) {
      e.preventDefault();

      $('#'+$module+'_form').submit();

  });

  function createUpdateDataAjaxConfirmation() {
      $('#confirmationModal').modal('show');
  }

  function submitConfirmed()
  {
      $('#'+ $module+'_form :input[type=submit]').attr('disabled',true);
      createUpdateDataAjax();
  }

  function createUpdateDataAjax() {
      $(".create_"+$module).prop("disabled", true);
      $(".update_"+$module).prop("disabled", true);
      $.ajax({
          url: $('#'+ $module+'_form').attr('action'),
          type: 'POST',
          data: new FormData(document.getElementById($module+'_form')),

          contentType: false,
          cache: false,
          processData:false,
          
          dataType: 'json',
          headers: {
              'X-CSRF-Token': $('input[name="csrf_test_name"]').attr('value')
          },
          success: function (response) {
              $("input[name=csrf_test_name]").val(response.token); // NEW
              clog(response);
              var response = response.data;
              if (response.code == 1) {
                  clog("Updated Token: " + $('input[name="csrf_test_name"]').attr('value'));
                  clog(response);
                  if ($module == 'treatyStates') {
                      window.location.href = base_url+'treatyStates/batches';
                  }else{
                      window.location.href = base_url+$module;
                  }
              }else if(response.code == 0){
                  clog(response);
                  $(".h_heading").text(response.message);
                  $('#modaldemo5').modal('show');
              } 
              else {
                  clog("Issue During Insertion: ");
                  clog(response);
              }
              $(".create_"+$module).prop("disabled", false);
              $(".update_"+$module).prop("disabled", false);
          },
          error: function (r) {
              $("input[name=csrf_test_name]").val(r.token); // NEW              
              clog(r);
              clog('Error in retrieving Site.');
              $(".create_"+$module).prop("disabled", false);
              $(".update_"+$module).prop("disabled", false);
          }
      });
  }

  $(".update_"+$module).click(function () {
      $('#'+$module+'_form').submit();
  });

  /*
  *
  *   FORM VALIDATION JS THIS IS DYNAMIC USED ACROSS THE BOARD.
  *
  */

  /*Modal Confirmation Code*/

  $(document).on('click','#confirmed',function () {
      submitConfirmed();
      $('#confirmationModal').modal('hide');
  });

  $('.select2').on('change', function() {
      $(this).trigger('blur');
  });

</script>
<script src="<?php echo $includes_dir; ?>lib/admin/<?php echo $module?>/<?php echo $module?>_form.js"></script>

