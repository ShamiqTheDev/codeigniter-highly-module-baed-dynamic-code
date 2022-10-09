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
  $status = $style='';
  // $showFormForView = false;
  if ($this->uri->segment(2) == "view")
  {
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
              <select <?php echo $status?> class="form-control select2 treatyYear" name="currentYear" data-placeholder="Choose Year">
                  <option label="Choose Year"></option>
                  <?php
                  $treatyYear = isset($response->currentYear)?$response->currentYear:'';
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
                    <label class="form-control-label">Treaty Type<span class="tx-danger">*</span></label>
                    <select <?php echo $status?> required class="form-control select2 treatyTypeOptions" data-select="<?php echo isset($response->treatyTypeDTO->id)?$response->treatyTypeDTO->id:''?>" name="treatyTypeDTO.id" data-placeholder="Choose Option">

                    </select>
                </div>
            </div>

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
        <?php if ($this->uri->segment(2) != "view" AND false){ ?>
        <button type="button" class="<?php echo (isset($response->id)) ? "update_".$module : "create_".$module; ?> btn btn-success tx-12 tx-uppercase tx-spacing-2 subUsingConfirmBtn">
            <?php echo (isset($response->id)) ? "Update" : "Create"; ?>
        </button>
        <?php } ?>
        

      </section>  
    </div>
    <?php if ($this->uri->segment(2) == "edit")
            { echo '<div class="ajaxAppend"></div>'; }
          elseif ($this->uri->segment(2) == "view")
            { echo '<div class="br-section-wrapper mg-t-20 treatyStatesTable"></div>';}
         ?>

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
                      window.location.href = base_url+'treatyStates';
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

  validationRules = '{"statisticsDate":{"required":true,"email":false,"number":false},"cedentDTO.id":{"required":true,"email":false,"number":false},"treatyYear":{"required":true,"email":false,"number":false},"businessDTO.id[]":{"required":true,"email":false,"number":false},"subBusniessClass[]":[],"treatyTypeDTO.id":{"required":true,"email":false,"number":false},"treatyCategoryDTO.id":{"required":true,"email":false,"number":false},"remarks":{"required":true,"email":false,"number":false}}';


  /*
*
*   FORM VALIDATION JS THIS IS DYNAMIC USED ACROSS THE BOARD.
*
*/

/*Modal Confirmation Code*/


  $.validator.addMethod("fax_number", function(value, element) {
      return this.optional(element) ||
          value.match(/^[0-9,\+]+$/);
  }, "Please enter a valid fax number");

  $.validator.addMethod("lettersonly", function(value, element) {
      return this.optional(element) || /^[a-z," "]+$/i.test(value);
  }, "Only letters and spaces allowed");

  $.validator.addMethod('filesize', function (value, element, param) {
      return this.optional(element) || (element.files[0].size <= param)
  }, 'File size must be less than {0}');

  $.validator.addMethod("no-http-url", function(value, element, param) {
  return this.optional(element) || /^(www\.)(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value);
  }, jQuery.validator.messages.url);

  $.validator.addMethod("custom-url", function(value, element, param) {
  return this.optional(element) || 
  (new RegExp(/^(ftp|http|https)[^ "]+$/).test(value))?true:(/^(www\.)(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)*(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value));
  }, jQuery.validator.messages.url);


  var FormValidator = function () {

      var AddRecordValidation = function () {
          var formId = '#'+$module+'_form';
          var form1 = $(formId);
          var errorHandler1 = $('.errorHandler', form1);
          var successHandler1 = $('.successHandler', form1);
          errorClass = 'help-block';
          errorElement = 'span';
          $(formId).validate({
              errorElement: errorElement, // contain the error msg in a span tag
              errorClass: errorClass,
              errorPlacement: function (error, element)
              {

                  if(element.hasClass('select2') && element.next('.select2-container').length)
                  {
                      error.insertAfter(element.next('.select2-container'));
                  }
                  else if(element.hasClass('cke_editor') && element.next('.cke_editor_content').length)
                  {
                       error.insertAfter(element.next('.cke_editor_content'));
                  }else
                  {
                      error.insertAfter(element);
                  }
   
              },
              ignore: [],
              rules: JSON.parse(validationRules),
              // messages: JSON.parse(validationMessage),
              invalidHandler: function (event, validator) { //display error alert on form submit
                  successHandler1.hide();
                  errorHandler1.show();
              },
              highlight: function (element, errorClass, validClass)
              {
                  $(element).closest('.help-block').removeClass('valid');
                  $(element).closest('.form-validate')
                              // .removeClass('has-success')
                              .addClass('has-error')
                              .find('.symbol')
                              .removeClass('ok')
                              .addClass('required');

              },
              unhighlight: function (element, errorClass, validClass)
              {
                  $(element).closest('.form-validate').removeClass('has-error');
              },
              success: function (label, element) {
                  label.addClass('help-block valid');
                  $(element).closest('.form-validate')
                              .removeClass('has-error')
                              // .addClass('has-success')
                              .find('.symbol')
                              .removeClass('required')
                              .addClass('ok');            

              },
              submitHandler: function (form)
              {
                  successHandler1.show();
                  errorHandler1.hide();

                  $('#confirmationModal_once').modal('show');

                  $(document).on('click','#confirmed',function () {
                      $('#'+ $module+'_form :input[type=submit]').attr('disabled',true);
                      createUpdateDataAjax();
                      $('#confirmationModal_once').modal('hide');
                  });


                  $("#close_alert").on("click",function(){
                      $('#create_form :input[type=submit]').attr('disabled',false);
                  });

                  return false;
              }
          });


      };
      return {
          init: function () {
              AddRecordValidation();
          }
      };
  }();
  jQuery(document).ready(function () {
      FormValidator.init();
  });





</script>
<script src="<?php echo $includes_dir; ?>lib/admin/<?php echo $module?>/<?php echo $module?>_form.js"></script>
