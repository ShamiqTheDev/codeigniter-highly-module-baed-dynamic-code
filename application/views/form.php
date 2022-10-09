<?php 
    $this->load->view('includes/header', $this->data); 

    /* PAGE DEFAULTS VARIABLES */
    $datetimepicker = false; // won't include by default
    $page = $this->uri->segment(1);
    $action = $this->uri->segment(2);
    $pageId = $this->uri->segment(3);

    $work_flow_index_url = $this->session->userdata('work_flow_index');

    $viewData['action'] = $action;

    if ($page == 'accountRendering' && $action == 'edit') {
        $confirmMsg = 'Do you want to {action} record for '.$html['pageTitle'].'?';
    } else {
        $confirmMsg = 'Do you want to '.($action=='create'? 'Create':'Update' ).' record for '.$html['pageTitle'].'?';
    }
?>

<div id="confirmationModal" class="modal fade show" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="icon icon ion-ios-information-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-success tx-semibold mg-b-20 modalCustomAction"><?php echo $confirmMsg ?></h4>

                <input type="button" id="confirmed" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" value="Yes">
                <button type="button" class="btn tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                    No
                </button>

            </div>
        </div>
    </div>
</div>

<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active"><?php echo $html['pageTitle']?></span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading"><?php echo $html['pageTitle']?></h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>
    <div class="br-pagebody mg-t-5 pd-x-30">
        <?php
            // $attributes = array('class' => 'form-horizontal', 'id' => $module.'_form');
            echo form_open(current_url(), $html['form']['attributes']);
        ?>
        <div class="br-section-wrapper section-wrapper-shadow">
           <div id="wizard1">

              <section>
                
                  <?php if ($this->uri->segment(2) == 'edit') { ?>
                        <input type="hidden" name="id" value="<?php echo isset($response->id)?$response->id:''?>">
                  <?php
                    }
                  ?>

                  <div class="br-section-wrapper">
                      <div class="row mg-b-25">
                        <?php 
                        $rulesArray=$messageArray= []; 
                        foreach ($html['form']['inputs'] as $input){
                          echo generateFields($input);
                          if (isset($input['validation'])) {
                            $inputName = isset($input['name'])?$input['name']:$input['attributes']['name'];
                            $rulesArray[$inputName] = json_decode(json_encode($input['validation']));
                          }
                          if (isset($input['validationMessage'])) {
                            $messageArray[$inputName] = json_decode(json_encode($input['validationMessage']));
                          }
                        } 
                        ?>
                      </div>
                  </div><!-- form-layout -->
                  <br>
                  <?php if ($this->uri->segment(2) != "view"){ 
                    $statsCreateButton='';
                    $showButton = true;
                    if ($page == "statistics") {
                      $showButton = false;
                    }
                    if ($showButton) { 
                    ?>                  
                        <button type="button" class="<?php echo (isset($response->id)) ? "update_".$module : "create_".$module; ?> btn btn-success tx-12 tx-uppercase tx-spacing-2 subUsingConfirmBtn"<?php echo $statsCreateButton; ?>>
                            <?php echo (isset($response->id)) ? "Update" : "Create"; ?>
                        </button>
                    <?php } else { ?>
                        <!-- <button type="button" class="getStats btn btn-success tx-12 tx-uppercase tx-spacing-2">
                            Get Statistics
                        </button> -->
                    <?php }
                    } ?>
              </section>  
          </div>
        </div>
      <div class="ajaxAppend">
      </div>
      <?php 
        if (isset($html['addModuleView'])){
            if (!is_array($html['addModuleView'])) {
                if ($module == 'accountRendering' && $action == 'view' ) {

                } else {
                    $this->load->view($module.'/'.$html['addModuleView']);
                }
            }else{
                $views = $html['addModuleView'];
                foreach ($views as $view) {
                    if (!empty($view)) {
                      $this->load->view($module.'/'.$view,$viewData);
                    }
                }
            } 
        }
      ?>
      
      <?php
      echo form_close();
      ?>

<?php $this->load->view('includes/footer', $this->data); ?>

<script>
    base_url = '<?php echo base_url()?>';
    $module = '<?php echo $module?>';
    validationRules = '<?php echo json_encode($rulesArray)?>';
    validationMessage = '<?php echo json_encode($messageArray)?>';
    includes_dir = '<?php echo $includes_dir?>';
    action = '<?=$action?>';
    pageId = '<?=!empty($pageId)?$pageId:""?>';
    work_flow_index_url = '<?=!empty($work_flow_index_url)?$work_flow_index_url:""?>';
</script>

<script src="<?php echo $includes_dir;?>lib/admin/form.js"></script>
<?php 
$formJsUrl = './assets/lib/admin/'.$module.'/'.$module.'_form.js';
if (file_exists($formJsUrl)){ 
    // dd($module);
    if ($module == 'accountRendering') { 
        $datetimepicker = true;
        $tretierId = !empty($this->uri->segment(3))?$this->uri->segment(3):'';
    ?>
    <script>
        tretierId = '<?php echo $tretierId?>';
    </script>
    <?php 
    }

    if ($datetimepicker == true) { ?>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.1.4/jquery.datetimepicker.js" integrity="sha512-8LxlsdI2Kkn251+4mFt7X26y6tAHaYMNC5/8/CXJnrJtY1a8KDL9yyDk4/7uC4/zJcQi/ByWHU+EvPtmK6DU0w==" crossorigin="anonymous"></script>        
    <?php 
    }
?>
<script src="<?php echo $includes_dir.'lib/admin/'.$module.'/'.$module.'_form.js'?>"></script>
<?php 
} 
?>



