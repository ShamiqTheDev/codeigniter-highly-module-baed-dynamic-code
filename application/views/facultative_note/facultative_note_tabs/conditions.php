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
            <div class="list-group">
                <a href="#" onclick="return false;" class="default-cursor list-group-item list-group-item-success active">Conditions</a>
                 <a href="#" onclick="return false;" class="list-group-item list-group-item-action condition" data-toggle="modal" data-target="#exampleModalCenter" value="1">Special Condition</a>
                <a href="#" onclick="return false;" class="list-group-item list-group-item-action condition" data-toggle="modal" data-target="#exampleModalCenter" value="3">Exclusion</a>
            </div> 
        </div>
        <hr> 
        <form id="conditions_form" method="post" action="<?php echo current_url(); ?>"> 
            <div class="conditions_list">
                <div class="list-group">
                    <a href="#" onclick="return false;" class="default-cursor list-group-item list-group-item-success active">
                        Special Conditions
                    </a> 
                    
                    <div id="data-list-user"> 
                    <a href="#" onclick="return false;" class="list-group-item list-group-item-action 1-3"> sp3 </a>
                
                    </div>
                </div> 
            </div> 
            <br>       
           <div class="row">
            <div class="col-lg-12">
                    <div class="form-group">
                        <div class="form-group"> 
                            <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 " style="margin: 10px;float: right;" name="Conditions_Btn" id="Conditions_Btn" value="Add">
                        </div>

                    </div>
                </div>      
            </div>
       </form>

    </div>
</section>