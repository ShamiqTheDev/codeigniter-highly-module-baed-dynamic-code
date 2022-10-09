<?php 

// dd($Treater_details->treatySlipGeneralDTO);
$attachments = isset($Treater_details->treatySlipGeneralDTO->treatyAttachmentsDTOs[0])
                    ?$Treater_details->treatySlipGeneralDTO->treatyAttachmentsDTOs[0]:'';
$attachmentLink = isset($attachments->docPath)?$attachments->docPath:'';

$downloadLink = "";
if (!empty($attachmentLink)) {
    $downloadLink = "(<a href='".$attachmentLink."' download> Download Recent File </a>)";
}

?>

<h3>Documents</h3>
<section>
    <?php
        $attributes = array('class' => 'document_form', 'id' => 'document_form');
        echo form_open(current_url(), $attributes);
    ?>
    <div class="form-layout form-layout-1 mg-b-15" id="div_add_more" style="width:97%; margin:10px auto; background:#fff;display: block;" >
        <div class="br-section-wrapper mg-b-25">
            <div class="row">
                <input type="hidden" name="treatySlipGeneralId" class="HiddentreatySlipGeneralId" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->id:'');?>">
                <input type="hidden" name="document" value="1">
                <div class="col-lg-8">
                    <span><?php echo $downloadLink?></span>
                    <b>Upload File (2MB Max)</b>
                    <label class="custom-file w-100">
                        <input type="file" name="file" id="document" class="custom-file-input ">
                        <span class="custom-file-control custom-file-control-primary"></span>
                    </label>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <button id="submitDocumentBtn" class="btn btn-success" type="button">Upload</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php echo form_close() ?>
</section>