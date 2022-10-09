<?php 

// $referenceNo = isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->fileRefNo:'';
$conditions=isset($Treater_details->treatySlipGeneralDTO->treatyConditionDTOs)
                ?$Treater_details->treatySlipGeneralDTO->treatyConditionDTOs
                :[];

// $aConditions = $aConditionWithTypesArray = [];
// if (!empty($conditions)) {
//     foreach ($conditions as $condition){
//         $cn = $condition->conditionDTO;
//         // dd($cn);
//         $cnType = $cn->conditionTypeDTO;
//         $cnT = $cnType->conditionType;
//         $cnT = str_replace(' ', '', $cnT);
//         $cnTypeKey = camelCaseToSnakeCase($cnT);
//         $cId    = isset($cn->id)?$cn->id : '';
//         $cName = isset($cn->condition)?$cn->condition : '';
//         if (!empty($cName)) {
//             $aConditionWithTypesArray[$cnTypeKey][] = [
//                 'id' => $cId,
//                 'name' => $cName,
//             ];

//             $aConditions[]= [
//                 'id' => $cId,
//                 'name' => $cName,
//             ];

//         }
//     }
// }
// debug($conditions);

// $conditionDTOs = isset($treatyConditions->conditionTypeDTOs[0]->conditionDTOs)?
//                 $treatyConditions->conditionTypeDTOs[0]->conditionDTOs:[];

// debug($conditionDTOs);
?>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="loader-modal"></div>
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="modalTitle">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- data-pid is parent id -->
        <div class="modal-body">
            <!-- some ajax data -->
            <div class="checkBoxes"></div>

            <!-- Form show hide for add conditions -->
            <div class="createConditionField" style="display: none;">
                <div class="input-group mb-3">
                    <input type="text" class="form-control newCondInp" placeholder="Enter new conditions" aria-label="new condition name" aria-describedby="basic-addon2">
                    <input type="hidden" class="newCondInpParent" name="parentId">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary condAddBtn" type="button"> Add Condition </button>
                    </div>
                </div>
            </div>
        </div><!-- MODAL CONTENT -->

        <div class="modal-footer">
            <button type="button" class="btn btn-success addNewConditionBtn"> <i class="fa fa-plus"></i> Add </button>
            <button type="button" class="btn btn-success doneConditions" data-dismiss="modal">Done</button>
        </div>
    </div>
  </div>
</div>
<h3>Conditions</h3>
<section>
    <div class="form-layout form-layout-1 mg-b-15" id="div_add_more" style="width:97%; margin:10px auto; background:#fff;display: block;">

        <div class="conditions_list">
            <div class="list-group getConditionsListDiv">
                <a href="#" onclick="return false;" class="default-cursor list-group-item list-group-item-success active">Conditions</a>
                <a href="#" onclick="return false;" class="list-group-item list-group-item-action">Loading...</a>
            </div> 
        </div>
        <hr>

        <?php 
            $attributes = array('class' => 'conditions_form', 'id' => 'conditions_form');
            echo form_open(current_url(), $attributes);
        ?>
        <input type="hidden" name="conditions" value="1">

        <input type="hidden" name="treatySlipGeneralDTO.id" class="HiddentreatySlipGeneralId" value="<?php echo isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->id:''?>">
        <div class="conditions_list">
            <div class="list-group">
                <a href="#" onclick="return false;" class="default-cursor list-group-item list-group-item-success active">
                    Selected Conditions
                </a>
                <?php 
                    $conditions = isset($conditions[0])?$conditions[0]:'';
                    if (isset($conditions->id)) {
                        echo "<input type='hidden' value='{$conditions->id}' name='id' >";
                    }
                ?>
                <div id="data-list-user">
                        <?php 
                        $nullMsg = '<a href="#" onclick="return false;" class="removeable list-group-item list-group-item-action">Not Selected any condition yet! </a>';
                        if (!empty($conditions->conditionDTOs)) {
                            foreach ($conditions->conditionDTOs as $condition) {
                                    $parentId = isset($condition->conditionTypeDTO->id)
                                                ?$condition->conditionTypeDTO->id:'';
                                    $id = isset($condition->id)?$condition->id:'';
                                    $inpLabel = isset($condition->condition)?$condition->condition:'';
                                    $newInpsId = $parentId.'-'.$id;
                                    ?>
                                    <input type="hidden" name="conditionIds[]" class="<?php echo $newInpsId?>" value="<?php echo $id ?>">
                                    <a href="#" onclick="return false;" class="list-group-item list-group-item-action <?php echo $newInpsId?>"> <?php echo $inpLabel?> </a>
                                    <?php 
                            } // endforeach
                        } else { echo $nullMsg; }
                        ?>
                </div>
            </div> 
        </div> 
        <br>       
        <div class="col-lg-3">
            <div class="form-group">
                <button id="submitConditionsBtn" class="btn btn-success" type="button">Submit</button>
            </div>
        </div>
        <?php echo form_close() ?>

    </div>
</section>
