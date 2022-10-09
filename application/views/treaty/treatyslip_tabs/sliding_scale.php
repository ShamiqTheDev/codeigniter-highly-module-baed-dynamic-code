<h3>Sliding Scale</h3>
<section>
    <div class="form-layout form-layout-1 mg-b-15" id="div_add_more" style="width:97%; margin:10px auto; background:#fff;display: block;" >

        <form id="TreatySlipSlidingScaleForm" method="post" action="<?php echo current_url(); ?>">
        <div class="br-section-wrapper mg-b-25">

            <div class="row">

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Section Name <span class="tx-danger">*</span></label>
                        <input class="form-control" maxlength="200" type="text" placeholder="Add Section Name" name="sectionName_slidingScale" id="sectionName_slidingScale">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Treaty Sub Types <span class="tx-danger">*</span></label><br>
                        <select class="form-control select2"   data-placeholder="Choose Option Treaty Sub Types" id="slidingScale_treatySubTypes" name="slidingScale_treatySubTypes[]" multiple>
                            <?php
                            if (isset($Treaty_Subtype))
                            {
                                foreach ($Treaty_Subtype as $key => $objTreaty_Subtype)
                                {
                                    print("<option value='".$objTreaty_Subtype->id."'>".$objTreaty_Subtype->subTypeName."</option>");
                                }
                            }
                            ?>
                        </select>

                    </div>
                 </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Business Class<span class="tx-danger">*</span></label><br>
                        <select class="form-control select2 treatySlip_multiselect" data-placeholder="Select Business Class" id="sliding_business_class" name="sliding_business_class[]" multiple>

                            <?php
                            if(isset($Business_class))
                            {
                                foreach ($Business_class as $key => $objBusiness_class)
                                {
                                    print("<option value='".$objBusiness_class->id."' >".$objBusiness_class->name."</option>");
                                }
                            }

                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Treaty Type<span class="tx-danger">*</span></label><br>
                        <select  class="form-control select2 treatySlip_multiselect" data-placeholder="Select Treaty Type" id="sliding_treaty_type" name="sliding_treaty_type">

                            <?php
                            if(isset($Treaty_type))
                            {
                                foreach ($Treaty_type as $key => $objTreaty_type)
                                {
                                    print("<option value='".$objTreaty_type->id."' >".$objTreaty_type->type."</option>");
                                }
                            }

                            ?>
                        </select>

                    </div>
                </div>


                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Reinsurance Commission Flat <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="Sliding_Rate" id="Sliding_Rate" placeholder="Enter Reinsurance Commission Flat">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Reinsurance Commission <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="slidingCommission" id="slidingCommission" placeholder="Enter Reinsurance Commission">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Loss Ratio (LR) <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="slidingLossRatio" id="slidingLossRatio" placeholder="Enter Loss Ratio">
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Condition >=< <span class="tx-danger"></span></label>
                        <select class="form-control" data-placeholder="Choose Business Class"  name="slidingScale" id="slidingScaleOptions">
                            <option value="">--Select--</option>
                            <?php
                                foreach ($this->config->item("slidingScale_conditions") as $key => $value)
                                {
                                    print("<option value='".$key."'>".$value."</option>");
                                }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-lg-3">
                    <div class="form-group">
                        <label class="form-control-label">Loss Ratio2 (LR2) <span class="tx-danger"></span></label>
                        <input class="form-control" type="text" name="combineRatio" id="combineRatio" placeholder="Enter Loss Ratio2 (LR2)">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label">Description<span class="tx-danger">*</span></label>
                        <textarea required class="form-control"  name="SlidingDescription" id="SlidingDescription" placeholder="Enter Description"></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <input type="hidden" name="treatySlipGeneralId" class="HiddentreatySlipGeneralId" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->id:'');?>">
                        <input type="hidden" id="treatySlipslidingScaleId" name="treatySlipslidingScaleId" value="">
                        <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 table_btn_sst" style="float: right;" name="treatyslip_slidingScale" id="treatyslip_slidingScaleBtn" value="Add">

                    </div>
                </div>
        </form>
            </div>

            <br>
            <div class="br-section-wrapper">
                <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Section</th>
                            <th scope="col">Treaty Type</th>
                            <th scope="col">Treaty Sub Types</th>
                            
                            <th scope="col">Business Class</th>
                           
                            <th scope="col">Rate</th>
                            <th scope="col">Loss Ratio (LR)</th>
                            <th scope="col">Condition (>=<)</th>
                            <th scope="col">Combined Ratio</th>
                            <th scope="col">Commission</th>
                            <th scope="col">Description</th>
                            <th colspan="2" scope="col">Action</th>
                        </tr>
                        </thead>
                        <tbody class="table_tbody_sst">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>




</section>