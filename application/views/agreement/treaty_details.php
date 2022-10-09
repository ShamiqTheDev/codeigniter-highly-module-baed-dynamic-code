<?php 
    $isCreate = $this->uri->segment(2) == 'create'?true:false;
?>
<div class="br-section-wrapper mg-t-20 mg-r-20 section-wrapper-shadow" style="overflow-x: auto;" >
  <h3 style="width:1480px;">
    Treaty Details
    <?php if (!$isCreate && !empty($treatyDetails)) { ?>
      <a href="<?php echo base_url($module .'/letter/'. base64_encode($response->id).'/'.$templateId) ?>" class="btn btn-success tx-12 tx-spacing-2" target="_blank">
        <span class="fa fa-print"></span> Print Letter
      </a>
    <?php } ?>
  </h3>

  <table class="table table-striped table-bordered treaty-detail-table" style="width: 1450px; margin-right: 20px;">
    <thead>
      <tr>
        <th width="50">S #</b></th>

        <th width="200">Treaty Name</th>
        <th width="200">Treaty Codes</th>
        <!-- <th width="200">Treaty Name</th> -->
        <th width="250">PRCL Share Previous Year</th>
        <th width="200">Proposed PRCL Share </th>
        <th width="200">Approved PRCL Share </th>

        <th width="150">Currency </th>
        <th width="100">Stats</th>
        <th width="100">Actions</th>
        <th width="100">Accept</th>
        <th width="100">Reject</th>
      <?php if (!$isCreate) {
          echo '<th width="100">Slip Entry</th>';
          echo '<th width="100">Status</th>';
          echo '<th width="100">Remarks</th>';
      } ?>

      </tr>
    </thead>
    <tbody id="treaty_details">
      <?php 
      $sn=1;
      if (!$isCreate) {
//        debug($treatyDetails);
        $i=0;
        foreach ($treatyDetails as $treatyDetail)
        {
            $id                 = $treatyDetail->id;
            $name               = $treatyDetail->name;
            $prePreviousShare   = $treatyDetail->prePreviousShare;
            $preProposedShare   = $treatyDetail->preProposedShare;
            $preApprovedShare   = $treatyDetail->preApprovedShare;
            $currencyCode       = $treatyDetail->currencyCode;
            $statsId            = $treatyDetail->treatyStatisticsDTO->id;
            $treatyStatus       = $treatyDetail->treatyStatus;
            $treatyType         = isset($treatyDetail->treatyTypeDTO->id)?$treatyDetail->treatyTypeDTO->id:'';
            $treatyDetailsName  = $treatyDetail->name;
            $treatyCode         = $treatyDetail->treatierCode;
            $treatyName         = $treatyDetail->treatierCode;
            $flagChangeHistory  = (isset($treatyDetail->flagChangeHistoryDTOs) ? end($treatyDetail->flagChangeHistoryDTOs) : '');
            $flagChangeHistoryRemarks  = (isset($flagChangeHistory) ? $flagChangeHistory->remarks : '');
            $flagChangeHistory  = ($flagChangeHistory !='' ? $flagChangeHistory->treatierFlagDTO : '');
            $isSlipEntered      = $treatyDetail->isSlipEntered == 'true'?'Yes':'No';
            $disabled           = '';
        if(isset($flagChangeHistory) && $flagChangeHistory !='') {
            if($flagChangeHistory->name == 'cancelled' OR $flagChangeHistory->name == 'terminated' OR $flagChangeHistory->name == 'discontinued'){
                $disabled = 'disabled';
            }
        }

        ?>
        <input type="hidden" name="treatyDetails[id][]" value="<?php echo $id?>">
        <tr class="tableDetails">
          <td scope="row" ><?php echo $sn?></td>
          <td>
              <select class="form-control selecct2 treatyTypeOptions"   style="display: none">
                  <?php
                  foreach($Treaty_types as $ObjTreatyType)
                  {
                      $selected = '';
                      echo "<option value='".$ObjTreatyType->id."' ".$selected.">".$ObjTreatyType->treatyName."</option>";
                  }

                  ?>
              </select>

              <select class="form-control selecct2 treatyTypeOptions2 2treatyNameRow_<?php echo $i?>" onchange="getCodes(<?=$i?>,$(this))" name="treatyDetails[treatyTypeDTO_id][]" data-select="<?php echo $treatyName?>">
                  <?php
                  foreach($Treaty_types as $ObjTreatyType)
                  {
                    // echo "$treatyCode <br>";
                    // dd($ObjTreatyType);
                      $selected = '';
                      if($treatyCode == $ObjTreatyType->treatyCode)
                      {
                          $selected = 'selected="selected"';
                      }
                      echo "<option value='".$ObjTreatyType->id."' ".$selected.">".$ObjTreatyType->treatyName."</option>";
                  }

                  ?>
              </select>
              <input type="hidden" name="treatyDetails[name][]" value="<?php echo $treatyDetailsName?>">
          </td>
          <td>
              <select class="form-control selecct2 treatyCodeOptions" style="display: none">
                  <?php
                  foreach($Treaty_types as $ObjTreatyType)
                  {
                      echo "<option value='".$ObjTreatyType->treatyCode."'>".$ObjTreatyType->treatyCode."</option>";
                  }

                  ?>
              </select>
              <select class="form-control selecct2 treatyCodeOptions2 2rowId_<?php echo $i?>" name="treatyDetails[treatierCode][]" data-select="<?php echo $treatyCode?>" readonly>
                  <?php
                    foreach($Treaty_types as $ObjTreatyType)
                    {
                        $selected = '';
                        if($treatyDetailsName == $ObjTreatyType->treatyName)
                        {
                            $selected = 'selected="selected"';
                        }
                        echo "<option value='".$ObjTreatyType->treatyCode."' ".$selected.">".$ObjTreatyType->treatyCode."</option>";
                    }

                  ?>
              </select>
          </td>
          <!-- <td><input type="text" <?php echo $disabled?> class="form-control" name="treatyDetails[name][]" placeholder="e.g. Fire & General Accident Q/S & Surplus" value="<?php echo $name?>"  <?php echo $disabled?>></td> -->
          <td><input type="text" <?php echo $disabled?> class="form-control decimal-numbers" name="treatyDetails[prePreviousShare][]" placeholder="e.g. 27.50%" value="<?php echo $prePreviousShare?>"  <?php echo $disabled?>></td>
          <td><input type="text" <?php echo $disabled?> class="form-control decimal-numbers" name="treatyDetails[preProposedShare][]" placeholder="e.g. 50%" value="<?php echo $preProposedShare?>"  <?php echo $disabled?>></td>
          <td><input type="text" <?php echo $disabled?> class="form-control decimal-numbers" name="treatyDetails[preApprovedShare][]" placeholder="e.g. 35%" value="<?php echo $preApprovedShare?>"  <?php echo $disabled?>></td>

          <td>
            <select <?php echo $disabled?> name="treatyDetails[currencyCode][]" data-select="<?php echo $currencyCode?>" class="form-control currencyOptions" data-placeholder="Currency" id="currency"  <?php echo $disabled?>>
            </select>
          </td>

          <td><a href="javascript:void(0)" class="anchor getStatsIdBtn" data-id="<?php echo $statsId?>" data-toggle="modal" class="stats-modal-btn" data-target=".stat-form-1" <?php echo $disabled?>>stats</a></td>
          <td><a href="javascript:void(0)" class="anchor" data-toggle="modal" data-target=".bd-example-modal-lg"  <?php echo $disabled?>>View</a></td>
          <td><input type="radio" <?php echo $disabled?> name="treatyDetails[treatyStatus][<?php echo $i?>]" value="1" <?php echo $treatyStatus == 'true' ?'checked':''?>></td>
          <td><input type="radio" <?php echo $disabled?> name="treatyDetails[treatyStatus][<?php echo $i?>]" value="0" <?php echo $treatyStatus == 'false' ?'checked':''?>></td>
          <?php if (!$isCreate) { ?>
         <td><?=$isSlipEntered?></td>
          <td>
                <?php
                if(isset($flagChangeHistory) && $flagChangeHistory !='') {
                    ?>
                    <!--                    <a href="--><?php //echo base_url('treaty/treaty_status/').base64_encode($id);
                    ?><!--"  target="_blank" class="btn btn-default" id="change_statuslink" style="background: white;margin: 10px 0px 0px 0px;">Treaty Slip Status</a>-->
                    <?php if ($flagChangeHistory->name == 'opened') { ?>
                        <a href="<?php echo base_url('treaty/treaty_status/') . base64_encode("terminated") . "/" . base64_encode($id). "/" . base64_encode($response->id); ?>"
                           target="_blank" class="btn btn-default" id="terminated"
                           style="background: white;margin: 10px 0px 0px 0px;">terminate</a>
                    <?php } ?>

                    <?php if ($flagChangeHistory->name == 'opened' OR $flagChangeHistory->name == 'entered') { ?>
                        <a href="<?php echo base_url('treaty/treaty_status/') . base64_encode("cancelled") . "/" . base64_encode($id). "/" . base64_encode($response->id); ?>"
                           target="_blank" class="btn btn-default" id="cancelled"
                           style="background: white;margin: 10px 0px 0px 0px;">cancel</a>
                    <?php } ?>

                    <?php if ($flagChangeHistory->name == 'opened') { ?>
                        <a href="<?php echo base_url('treaty/treaty_status/') . base64_encode("discontinued") . "/" . base64_encode($id). "/" . base64_encode($response->id); ?>"
                           target="_blank" class="btn btn-default" id="discontinued"
                           style="background: white;margin: 10px 0px 0px 0px;">discontinue</a>
                    <?php }

                    if($flagChangeHistory->name == 'cancelled')
                        echo "Cancelled";
                    if($flagChangeHistory->name == 'discontinued')
                        echo "Discontinued";
                    if($flagChangeHistory->name == 'terminated')
                        echo "Terminated";
                } else {
                    echo "flag data not available";
                }
                echo '</td><td>';
                if(isset($flagChangeHistory) && $flagChangeHistory !='') {
                    echo '<p>'.$flagChangeHistoryRemarks.'</p>';
                }
                echo '</td>';
                }
                ?>
        </tr>
        <?php 
        $i++;
        $sn++;
        }
      } else { ?>
      <tr class="tableDetails">
        <td scope="row" >1</td>

        <td>
            <select class="form-control selecct2 treatyTypeOptions treatyNameRow_0" name="treatyDetails[treatyTypeDTO_id][]">
            </select>
            <input type="hidden" name="treatyDetails[name][]">
        </td>
        <td>
            <select readonly class="form-control selecct2 treatyCodeOptions rowId_0" name="treatyDetails[treatierCode][]">
            </select>
        </td>


       <!--  <td><input type="text" class="form-control" name="treatyDetails[name][]" placeholder="e.g. Fire & General Accident Q/S & Surplus"></td> -->

        <td><input type="text" class="form-control decimal-numbers" name="treatyDetails[prePreviousShare][]" placeholder="e.g. 27.50%"></td>
        <td><input type="text" class="form-control decimal-numbers" name="treatyDetails[preProposedShare][]" placeholder="e.g. 50%"></td>
        <td><input type="text" class="form-control decimal-numbers" name="treatyDetails[preApprovedShare][]" placeholder="e.g. 35%"></td>

        <td>
          <select name="treatyDetails[currencyCode][]" class="form-control currencyOptions" data-placeholder="Currency" id="currency">
          </select>
        </td>

        <td><a href="javascript:void(0)" class="anchor" data-toggle="modal" class="stats-modal-btn" data-target=".stat-form-1">stats</a></td>
        <td><a href="javascript:void(0)" class="anchor" data-toggle="modal" data-target=".bd-example-modal-lg">View</a></td>
        
        <td><input type="radio" name="treatyDetails[treatyStatus][]" value="1"></td>
        <td><input type="radio" name="treatyDetails[treatyStatus][]" value="0"></td>

      </tr>
      <?php 
      } 
      ?>

    </tbody>
  </table>
  <?php if ($this->uri->segment(2) != 'view') { ?>
  <div class="pd-t-30-force">
      <button type="button" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 add_treaty_detail"><span class="fa fa-plus"></span></button>
  </div>  
  <?php } ?>
</div>