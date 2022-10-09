<?php if (isset($treater_id)){ // START: TREATIER ID CHECK?>
    <div class="pd-10 container">

        <div class="br-section-wrapper">
            <div class="bg-gray-100 bd pd-x-20 pd-t-20-force pd-b-10-force">
                <div class="row justify-content-center">
                   <div class="col-lg-12">
                        <div class="form-group form-validate mg-b-10-force">
                            <div class="list-group">
                                <a href="#" onclick="return false;" class="list-group-item list-group-item-success active">Previous Comments</a>
                                <?php
                                if (!empty($flowHistoryDTOs)) {
                                    foreach ($flowHistoryDTOs as $history) { 
                                        $sendFrom = isset($history->sendFrom)?$history->sendFrom:'';
                                        $remarks = isset($history->remarks)?$history->remarks:'';
                                        $createdDate = isset($history->createdDate)?$history->createdDate:'';
                                        $formatedDate = date('F jS, Y <\i\> h:i a <\/\i\>', strtotime($createdDate));
                                        if (empty($sendFrom)) {
                                            $sendFrom = 'Initiator';
                                        } // if !empty sendFrom
                                        ?>
                                        <a href="#" onclick="return false;" class="list-group-item list-group-item-action">
                                            <b><?php echo $sendFrom?>: </b> 
                                            <?php echo $remarks?>
                                            <br><div class="text-right"><small><?php echo $formatedDate?></small></div>
                                        </a>
                                        <?php 
                                    }//end foreach
                                } else { ?>
                                    <a href="#" onclick="return false;" class="list-group-item list-group-item-action">
                                        No Comments Yet!
                                    </a>
                                <?php }// end if !flowHistoryDTOs ?>
                            </div> 
                        </div>
                    </div>
                </div>
                <?php if ($this->uri->segment(2) != "view_treaty_slip"){ // START: VIEW CHECK?>
                    <div class="row">
                    <?php
                    // ee($admin);
                    // ee($uRoleName);
                    // dd(strpos($uRoleName, $admin) > -1);
                    if (strpos($uRoleName, $initiator) > -1 || strpos($uRoleName, $admin) > -1 || 
                        strpos($uRoleName, $reviewer1) > -1 || strpos($uRoleName, $reviewer2) > -1 ||
                        strpos($uRoleName, $approver) > -1) 
                    {
                        $formAttributes = [
                            'class' => 'form-horizontal', 
                            'role'  => 'proceedForm', 
                            'id'    => 'proceedForm',
                        ];
                        $initiatorCommentStatic = '';
                        if (strpos($uRoleName, $initiator) > -1) {
                            $formAttributes['style'] = 'display:none;';
                            $initiatorCommentStatic = 'Proceed!';
                        }
                        ?>
                        <div class="col-lg-6">
                        <?php echo form_open(base_url('treaty/proceedOrSendTo/'), $formAttributes)?>
                            <input type="hidden" name="id" value="<?php echo $treater_id?>">
                            <div class="form-group form-validate mg-b-10-force">
                                <label class="form-control-label">Proceed with Comment: </label>
                                <textarea name="remarks" class="form-control" placeholder="Please enter some comment before proceed to next step"><?php echo $initiatorCommentStatic; ?></textarea>
                            </div>
                            <button type="button" id="proceed" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 form-group pull-right">Proceed</button>
                        <?php echo form_close()?>
                        </div> 
                    <?php
                    }//end if
                    if (strpos($uRoleName, $initiator) == false ||strpos($uRoleName, $admin) > -1 || strpos($uRoleName, $reviewer1) > -1 
                        || strpos($uRoleName, $reviewer2) > -1 || strpos($uRoleName, $approver) > -1) {

                        $formAttributes = [
                            'class' => 'form-horizontal',
                            'role'  => 'commentsForm',
                            'id'    => 'commentsForm',
                        ];
                        ?>
                        <div class="col-lg-6">
                        <?php echo form_open(base_url('treaty/proceedOrSendTo/'), $formAttributes);?>
                            <input type="hidden" name="id" value="<?php echo $treater_id?>">
                            <div class="form-group form-validate mg-b-10-force">
                                <label class="form-control-label"> Role <span class="text-success">*</span>
                                </label>
                                <select name="roleId" class="form-control roleOptions select2"></select>
                                <br><span class="text-success"><small>*(Optional) select a role to pass slip to specific role </small></span>
                            </div>
                            <div class="form-group form-validate mg-b-10-force">
                                <label class="form-control-label">Write Comment: </label>
                                <textarea name="remarks" class="form-control" placeholder="Please enter some comment before sending back to role"></textarea>
                            </div>
                            <button type="button" id="addComment" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 form-group pull-right">Add Comment</button>
                        <?php echo form_close();?>
                        </div> 
                    <?php } ?>
                    </div>
                <?php } // END: View check ?>
            </div>
        </div>
</div>
<?php } // END: TREATIER ID CHECK ?>
