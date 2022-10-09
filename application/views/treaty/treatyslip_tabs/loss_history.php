<h3>Loss History</h3>
<section>

    <?php
        $lossHistory = isset($Treater_details->treatySlipGeneralDTO->treatyLossHistoryDTOs[0])
                            ?$Treater_details->treatySlipGeneralDTO->treatyLossHistoryDTOs[0]:'';
        
        $lhId               = isset($lossHistory->id)?$lossHistory->id:'';
        $outStandingLoss    = isset($lossHistory->outStandingLoss)?$lossHistory->outStandingLoss:'';
        $lossPaid           = isset($lossHistory->lossPaid)?$lossHistory->lossPaid:'';
        $cashCallLog        = isset($lossHistory->cashCallLog)?$lossHistory->cashCallLog:'';
        $lossAdvice         = isset($lossHistory->lossAdvice)?$lossHistory->lossAdvice:'';
        $lossCarryForward   = isset($lossHistory->lossCarryForward)?$lossHistory->lossCarryForward:'';
        $technicalBalance   = isset($lossHistory->technicalBalance)?$lossHistory->technicalBalance:'';
        $lossesIncurred     = isset($lossHistory->lossesIncurred)?$lossHistory->lossesIncurred:'';

        $attributes = array('class' => 'loss_history_form', 'id' => 'loss_history_form');
        echo form_open(current_url(), $attributes);
    ?>
    <input type="hidden" name="lossHistory" value="1">
    <?php if (isset($lossHistory->id)) { ?>
        <input type="hidden" name="id" value="<?php echo $lhId?>">
    <?php } ?>
    <input type="hidden" name="treatySlipGeneralDTO.id" class="HiddentreatySlipGeneralId" value="<?php echo $treatySlipGeneralDTO_id;?>">
    <div class="form-layout form-layout-1 mg-b-15" id="div_add_more" 
    style="width:97%; margin:10px auto; background:#fff;display: block;">
        <div class="br-section-wrapper mg-b-25">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Outstanding Loss <span class="tx-danger">*</span></label>
                        <input class="form-control decimal-numbers" type="text" name="outStandingLoss" value="<?php echo $outStandingLoss?>" placeholder="e.g. 1.10">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Loss Paid <span class="tx-danger">*</span></label>
                        <input class="form-control decimal-numbers" type="text" name="lossPaid" value="<?php echo $lossPaid?>" placeholder="e.g. 1.10">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Cash Call/Loss <span class="tx-danger">*</span></label>
                        <input class="form-control decimal-numbers" type="text" name="cashCallLog" value="<?php echo $cashCallLog?>" placeholder="e.g. 1.10">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Loss Advice<span class="tx-danger">*</span></label>
                        <input class="form-control decimal-numbers" type="text" name="lossAdvice" value="<?php echo $lossAdvice?>" placeholder="e.g. 1.10">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Loss Carry Forward<span class="tx-danger">*</span></label>
                        <input class="form-control decimal-numbers" type="text" name="lossCarryForward" value="<?php echo $lossCarryForward?>" placeholder="e.g. 1.10">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Technical Balance<span class="tx-danger">*</span></label>
                        <input class="form-control decimal-numbers" type="text" name="technicalBalance" value="<?php echo $technicalBalance?>" placeholder="e.g. 1.10">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Losses Incurred<span class="tx-danger">*</span></label>
                        <input class="form-control decimal-numbers" type="text" name="lossesIncurred" value="<?php echo $lossesIncurred?>" placeholder="e.g. 1.10">
                    </div>
                </div>
            </div>


            <div class="premium_div"></div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <button id="submitLossHistoryBtn2" class="btn btn-success" type="submit">Save</button>
            </div>
        </div>
    </div>
    <?php echo form_close();?>
</section>
