<?php $this->load->view('includes/header', $this->data);?>
<style>
    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
        color: #FF0000;
    }
    .has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline, .has-error.radio label, .has-error.checkbox label, .has-error.radio-inline label, .has-error.checkbox-inline label {
        color: #FF0000;
    }


</style>

<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Facultative Note</span>
        </nav>
    </div>

 
 
 
<div class="br-pagebody mg-t-5 pd-x-30">

    <div class="br-section-wrapper section-wrapper-shadow">
        <div id="wizard1">
                    <?php
                        $this->load->view('facultative_note/facultative_note_tabs/request_note_info'); 
                        $this->load->view('facultative_note/facultative_note_tabs/policy_info'); 
                        $this->load->view('facultative_note/facultative_note_tabs/insurance_loss_history'); 
                        $this->load->view('facultative_note/facultative_note_tabs/conditions'); 
                        $this->load->view('facultative_note/facultative_note_tabs/underwriting_position'); 
                    ?>    
        </div>
    </div> 
<?php $this->load->view('includes/footer', $this->data);?>
<script> 
        base_url = '<?php echo base_url()?>';
        action = '<?php echo $action?>';
        facultativeNoteId = '<?php print(isset($facultativeNoteId) ? $facultativeNoteId:'');?>';
        var Deductibles = jQuery.parseJSON('<?php if(isset($Deductibles)){ echo json_encode($Deductibles); }else{ echo ''; } ?>');
    
</script>
<script src="<?php echo base_url('assets\lib\select2\js\select2.min.js')?>" ></script> 
<script src="<?php echo base_url('assets\lib\admin\general.js')?>"></script>
<script src="<?php echo base_url('assets\lib\admin\facultativeNote.js')?>"></script>
   
    <script>
        
        $('#wizard1').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
             
        }); 
        
         $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
       
       if(action == "view_record")
       {
            $('input').prop('disabled', true);
            $('select').prop('disabled', true);
            $('textarea').prop('disabled', true);
       }

    </script> 