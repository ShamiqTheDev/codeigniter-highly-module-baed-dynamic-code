<h3>NON-PROPORTIONAL</h3>
<section>

        <div class="modal fade bd-example-modal-lg" id="ReinstatementModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="br-section-wrapper mg-t-20">
                        <h3>Reinstatement</h3>
                        <form id="treaty_layer_Instatementform" method="post" action="<?php echo current_url(); ?>">
                        <div class="form-group">

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label">Reinstatement <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="reinstatement" id="reinstatement" required placeholder="Enter Reinstatement">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label">Additional Pro Rata Premium <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="additionalProPermiumRate" id="additionalProPermiumRate" required placeholder="Enter Additional Pro Rata Premium">
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label">Inst Due Date <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="date" name="instDueDate" id="instDueDate" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <input type="hidden" name="treatyLayerId" id="TreatyLayerId_Reinstatement">
                                <input type="hidden" name="ReinstatementId" id="ReinstatementId">
                                <input type="submit" id="closemodal" class="btn btn-success tx-12 tx-uppercase tx-spacing-2" name="treatyslip_layer_reinstatement" id="treatyslip_layer_reinstatementBtn" value="Create">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    <div class="br-section-wrapper mg-b-25">
        <br>
        <form id="treaty_layer_form" method="post" action="<?php echo current_url(); ?>">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Layer Name <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="layerName" id="layerName" placeholder="Enter Layer Name" required>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Business Class<span class="tx-danger">*</span></label><br>
                    <select class="form-control select2 business_class" data-placeholder="Choose Option Business Class" id="layer_business_class" name="layer_business_class[]" multiple>

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



            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Treaty Type<span class="tx-danger">*</span></label><br>
                    <select style="width: 100%;" class="form-control"  id="layer_treaty_type" name="layer_treaty_type">
                        <option label="Choose Treaty Type"></option>
                        <?php
                        if(isset($Treaty_type))
                        {
                            foreach ($Treaty_type as $key => $objTreaty_type)
                            {
                                // $selected ='';
                                // if(isset($Treaty))
                                // {
                                //     if($Treaty->treatyTypeDTO->id == $objTreaty_type->id) {
                                //         $selected = 'selected';
                                //     }
                                // }
                                print("<option value='".$objTreaty_type->id."'>".$objTreaty_type->type."</option>");
                            }
                        }

                        ?>
                    </select>

                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Treaty Sub Types <span class="tx-danger">*</span></label><br>
                    <select class="form-control select2"   data-placeholder="Choose Option Treaty Sub Types" id="treatySubTypes_layer" name="treatySubTypes_layer[]" multiple>
                        <option value="">Select Treaty Types</option>
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

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Co MAX Retention % <span class="tx-danger">*</span></label>
                    <input required class="form-control" type="text" name="coMaxRetentionPercent" id="coMaxRetentionPercent" placeholder="Enter Co MAX Retention %">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Co MAX Retention<span class="tx-danger">*</span></label>
                    <input required class="form-control" type="text" name="coMaxRetention" id="coMaxRetention" placeholder="Enter Co MAX Retention">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Treaty Limit %<span class="tx-danger">*</span></label>
                    <input required class="form-control treatyLimitPercent" type="text"  name="treatyLimitPercent" id="treatyLimitPercent" placeholder="Enter Treaty Limit %">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Treaty Limit <span class="tx-danger">*</span></label>
                    <input required class="form-control treaty_limit" type="text"  name="treatyLimit" id="treatyLimit" placeholder="Enter Treaty Limit">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">PRC Share % <span class="tx-danger">*</span></label>
                    <input required class="form-control prc_share_percentage decimal-numbers" type="text" name="prcShare" id="prcShare" placeholder="Enter PRC Share %">
                </div>
            </div>

            <div class="col-lg-4">
                <label class="form-control-label">PRC'S Max Liability<span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input style="" class="form-control prcmaxliability_layers" type="text" name="prcMaxLiability" id="prcMaxLiability" placeholder="Enter PRC'S Max Liability">&nbsp;
                    <button required type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 prcmaxliability">Calculate</button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Fixed Rates %<span class="tx-danger">*</span></label>
                    <input  class="form-control decimal-numbers" type="text" name="fixRates" id="fixRates" placeholder="Enter Fixed Rates">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Min Rates %<span class="tx-danger">*</span></label>
                    <input  class="form-control" type="text" name="minRates" id="minRates" placeholder="Enter Min Rates %">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Max Rates %<span class="tx-danger">*</span></label>
                    <input  class="form-control" type="text" name="maxRates" id="maxRates" placeholder="Enter Max Rates %">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Premium Adjustable Rate %<span class="tx-danger">*</span></label>
                    <input  class="form-control" type="text" name="adjRates" id="adjRates" placeholder="Enter Adj Rates %">
                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">M&DP  100% <span class="tx-danger">*</span></label>
                    <input required class="form-control" type="text" name="mndp" id="mdp_100_percentage" placeholder="Enter MNDP 100%">
                </div>
            </div>

            <div class="col-lg-4">
                <label class="form-control-label">Minimum Deposit Premium (PRC Share)<span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="mndpPrcShare" id="mdp_field" placeholder="Enter Minimum Deposit Premium (PRC Share)"> &nbsp;
                    <button required type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 mdp">Calculate</button>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Deposit Premium<span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="depositePerimum" id="depositePerimum" placeholder="Enter Deposit Premium">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">No. Of Installment<span class="tx-danger">*</span></label>
                    <input required class="form-control" type="text" name="noOfIntallment" id="noOfIntallment" placeholder="Enter No Of Installment">
                </div>
            </div>

            <!-- <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Deductable<span class="tx-danger">*</span></label>
                    <input required class="form-control" type="text" name="deductable" id="deductable" placeholder="Enter Deductable">
                </div>
            </div> -->

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Burning Cost Factor<span class="tx-danger">*</span></label>
                    <input required class="form-control" type="text" name="bc" id="bc" placeholder="Enter Burning Cost Factor">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Annual Aggregate Limit (PRC Share)<span class="tx-danger">*</span></label>
                    <input required class="form-control" type="text" name="annualAggregatePrc" id="annualAggregatePrc" placeholder="Enter Annual Aggregate Limit (PRC Share)">
                </div>
            </div>

            <!-- <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Estimated GNPI<span class="tx-danger">*</span></label>
                    <input required class="form-control" type="text" name="estimatedGnpi" id="estimatedGnpi" placeholder="Enter Estimated GNPI">
                </div>
            </div> -->

            <!-- <div class="col-lg-4">
                <label class="form-control-label">Calculated GNPI<span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input  required class="form-control" type="text" name="calculatedGNPI" id="calculatedGNPI" placeholder="Enter Calculated GNPI">&nbsp;
                    <button  id="calculatedGNPIBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                </div>
            </div> -->

            <!-- <div class="col-lg-4">
                <label class="form-control-label">Excess limit<span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input  required class="form-control" type="text" name="excessLimit" id="excessLimit" placeholder="Enter Excess limit">&nbsp;
                    <button  id="excessLimitBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                </div>
            </div> -->

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">No Of Reinstatement<span class="tx-danger">*</span></label>
                    <!-- <textarea required class="form-control" name="noOfReinstatement" id="noOfReinstatement" placeholder="Enter No Of Reinstatement"></textarea> -->
                    <input type="text" required class="form-control" name="noOfReinstatement" id="noOfReinstatement" placeholder="Enter No Of Reinstatement">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Description<span class="tx-danger">*</span></label>
                    <textarea required class="form-control"  name="layerDescription" id="layerDescription" placeholder="Enter Description"></textarea>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <?php
                    $payment_terms = array("yearly"=>"Yearly","bi_annually"=>"Bi Annually","quarterly"=>"Quarterly","monthly"=>"Monthly","manual"=>"Manual");
                    ?>
                    <label class="form-control-label">Payment Terms<span class="tx-danger">*</span></label>
                    <select name="payment_terms_layer" class="form-control" id="payment_terms_layer">
                        <option value="">--Select--</option>
                        <?php
                        foreach ($payment_terms as $key => $payment_terms) {
                            print("<option value='".$key."'>".$payment_terms."</option>");
                        }
                        ?>
                    </select>
                </div>
            </div><!-- col-4 -->
            <div class="payment_terms_desc_layer col-lg-12"></div>


            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Layer M&DP</h3></label>
                </div>
            </div>
            <div class="col-lg-12">
            <table class='table'>
                      <thead>
                            <tr>
                                <th>Business Class </th>
                                <th>Treaty-Sub-Type </th>
                                <th>M&DP 100% </th> 
<!--                                <th>PRC Share rate (%) </th>-->
                                <th>PRC Share value</th>
                                <th></th>
                            <tr>
                      </thead>
                       <tbody id='AppendAblelayerMndpTr'>
                       <tr>
                            <td><select class="form-control" id="businessclass_layerMndp_layer_1" name="businessclass_layerMndp_layer_1" ><option value="">Select Business Class</option>
                                <?php
                                    if(isset($Business_class))
                                    {
                                        foreach ($Business_class as $key => $objBusiness_class)
                                        {
                                            print("<option value='".$objBusiness_class->id."' >".$objBusiness_class->name."</option>");
                                        }
                                    }

                                    ?>
                            </select></td>
                            <td><select class="form-control"   id="treatySubType_layerMndp_layer_1" name="treatySubType_layerMndp_layer_1"><option value="">Select Treaty Sub Type</option>
                                    <?php
                                    if (isset($Treaty_Subtype))
                                    {
                                        foreach ($Treaty_Subtype as $key => $objTreaty_Subtype)
                                        {

                                            print("<option value='".$objTreaty_Subtype->id."'>".$objTreaty_Subtype->subTypeName."</option>");
                                        }
                                    }
                                    ?>
                            </select></td>  
                            <td><input class="form-control" type="text" name="mndp_layerMndp_layer_1" id="mndp_layerMndp_layer_1" placeholder="Enter M&DP 100%"></td>
<!--                            <td><input class="form-control" type="text" name="PRCLSharerate_layerMndp_layer_1" id="PRCLSharerate_layerMndp_layer_1" placeholder="Enter PRCL Share rate"></td>-->
                            <td><div class="form-group input-group">
                                    <input  required class="form-control" type="text" name="PRCLSharevalue_layerMndp_layer_1" id="PRCLSharevalue_layerMndp_layer_1" placeholder="Enter PRCL Share value (calculated)">&nbsp;
                                    <button  id='PRCLSharevalue_layerMndp_layerBtn_1' onclick='CalculationlayerMndp(1);' type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">=</button>
                                </div><td>
                            <td></td>
                            </tr> 
                       </tbody> 
                     </table>
                     <a href="javascript:void(0)" style="margin:0px 10px 0px 0px;" class='btn btn-success pull-right' onclick='AddMorelayerMndp();'>Add More</a>
            </div>


            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Layer PRC Share</h3></label>
                </div>
            </div>
            <div class="col-lg-12">
            <table class='table'>
                      <thead>
                            <tr>
                                <th>Business Class </th>
                                <th>Treaty-Sub-Type </th>
                                <th>GNPI (Actual) </th>
                                <th>GNPI (Revised) </th>
                                <th>GNPI(Estimated) </th>
<!--                                <th>PRCL Share rate  </th>-->
                                <th>PRCL Share value (calculated)</th>
                                <th> </th>
                            <tr>
                      </thead>
                       <tbody id='AppendAblePrcShareTr'>
                       <tr>
                            <td><select class="form-control" id="businessclass_PrcShare_layer_1" name="businessclass_PrcShare_layer_1" ><option value="">Select Business Class</option>
                                <?php
                                    if(isset($Business_class))
                                    {
                                        foreach ($Business_class as $key => $objBusiness_class)
                                        {
                                            print("<option value='".$objBusiness_class->id."' >".$objBusiness_class->name."</option>");
                                        }
                                    }

                                    ?>
                            </select></td>
                            <td><select class="form-control"   id="treatySubType_PrcShare_layer_1" name="treatySubType_PrcShare_layer_1"><option value="">Select Treaty Types</option>
                                    <?php
                                    if (isset($Treaty_Subtype))
                                    {
                                        foreach ($Treaty_Subtype as $key => $objTreaty_Subtype)
                                        {

                                            print("<option value='".$objTreaty_Subtype->id."'>".$objTreaty_Subtype->subTypeName."</option>");
                                        }
                                    }
                                    ?>
                            </select></td>  
                            <td><input class="form-control" type="text" name="GNPIActual_PrcShare_layer_1" id="GNPIActual_PrcShare_layer_1" placeholder="Enter GNPI(Actual)"></td>
                            <td><input class="form-control" type="text" name="GNPIRevised_PrcShare_layer_1" id="GNPIRevised_PrcShare_layer_1" placeholder="Enter GNPI(Revised)"></td>
                            <td><input class="form-control" type="text" name="GNPIEstimated_PrcShare_layer_1" id="GNPIEstimated_PrcShare_layer_1" placeholder="Enter GNPI(Estimated)"></td>
<!--                            <td><input class="form-control" type="text" name="PRCLSharerate_PrcShare_layer_1" id="PRCLSharerate_PrcShare_layer_1" placeholder="Enter PRCL Share rate"></td>-->
                            <td><div class="form-group input-group">
                                    <input  required class="form-control" type="text" name="PRCLSharevalue_PrcShare_layer_1" id="PRCLSharevalue_PrcShare_layer_1" placeholder="Enter PRCL Share value (calculated)">&nbsp;
                                    <button  id='PRCLSharevalue_PrcShare_layerBtn_1' onclick='CalculationPRCLShere(1);' type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">=</button>
                                </div><td>
                                <td></td>
                            </tr> 
                       </tbody> 
                     </table>
                     <a href="javascript:void(0)" style="margin:0px 10px 0px 0px;" class='btn btn-success pull-right' onclick='AddMorePRCS();'>Add More</a>
            </div>
            

            <!-- <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Basis Of Recovery<span class="tx-danger">*</span></label>
                    <textarea required class="form-control" maxlength="400" name="basisofRecovery" id="basisofRecovery" placeholder="Enter Basis Of Recovery"></textarea>
                </div>
            </div> -->

            <!-- <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Risk<span class="tx-danger">*</span></label>
                    <textarea required class="form-control"  maxlength="400" name="risk" id="risk" placeholder="Enter Risk"></textarea>
                </div>
            </div> -->

            <!-- <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Loss Occurrence<span class="tx-danger">*</span></label>
                    <textarea required class="form-control"  maxlength="400" name="lossOccurancy" id="lossOccurancy" placeholder="Enter Loss Occurrence"></textarea>
                </div>
            </div> -->  
          


            <div class="col-lg-12" id="LayerResponseMsgs" class="LayerResponseMsgs"></div>
            <div class="col-lg-12">
                <div class="form-group">

                    <input type="hidden" name="treatySlipGeneralId" class="HiddentreatySlipGeneralId" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->id:'');?>">
                    <input type="hidden" id="treatySlipLayerId" name="treatySlipLayerId" value="">
                    <input type="hidden" id="PrcShare_layerRows" name="PrcShare_layerRows" value="">
                    <input type="hidden" id="MNDP_layerRows" name="MNDP_layerRows" value="">

                    <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 table_btn submit" style="float: right;" name="treatyslip_layer"  id="treatyslip_layerBtn" value="Add">
                </div>
            </div>
        </div>
        </form>
        
        <div class="clear"></div>   
        <h3>Layers Details</h3>

        <div class="br-section-wrapper mg-t-20">

            <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                <style>
                    .th_width th{
                        width: 200px;
                    }
                </style>
                <table class="table table-striped table-bordered th_width" >
                    <thead>
                    <tr>
                        <th>Layer Name</th>
                        <th>Business Class</th>
                        <th>Treaty Type</th>
                        <th>Treaty Sub Type</th>
                        <th>Co MAX Retention %</th>
                        <th>Co MAX Retention</th>
                        <th>Treaty Limit %</th>
                        <th>Treaty Limit</th>
                        <th>PRC Share %</th>
                        <th>PRC'S Max Liability</th>
                        <th>Fixed Rates %</th>
                        <th>Min Rates %</th>
                        <th>Max Rates %</th>
                        <th>Premium Adjustable Rate %</th>
                        <th>M&DP 100% %</th>
                        <th>Minimum Deposit Premium (PRC Share)</th>
                        <th>Deposit Premium</th>
                        <th>No. Of Installment</th>
                        <th>Burning Cost Factor</th>
                        <th>Annual Aggregate Limit (PRC Share)</th>
                        <th>No Of Reinstatement</th>
                        <th>Description</th>
                        <th>Payment Term</th>
                        <th>payment Terms Range</th>
                        <th colspan="2">Action</th>
                        <th>Reinstatement</th>
                    </tr>
                    </thead>
                    <tbody class="table_tbody"> </tbody>
                </table>
 
            </div>
        </div>
 
        <div class="clear"></div>   
        <h3>Reinstatement</h3>
     
        <div class="br-section-wrapper mg-t-20">

            <div class="table-wrapper1 table-responsive1">

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Layer Name</th>
                        <th>Reinstatement</th>
                        <th>Additional Pro Primium Rata</th>
                        <th>Inst Due Date</th>
                        <th colspan="2">Action</th>

                    </tr>
                    </thead>
                    <tbody class="table_tbody_re">


                    </tbody>
                </table>




            </div>
        </div>
    </div>
    <!--   28-02-2020 END ---->

</section>

<script>


    var business_String = [<?php echo $business_String;?>];
    var BusinessClass_Layer = document.getElementById('layer_business_class');
    for (var i = 0; i < BusinessClass_Layer.options.length; i++) {
        BusinessClass_Layer.options[i].selected = business_String.indexOf(BusinessClass_Layer.options[i].value) >= 0;
    }

    var treatySubTypes_layer = document.getElementById('treatySubTypes_layer');
    var values = [<?php echo $treatySubTypes_String;?>];
    for (var i = 0; i < treatySubTypes_layer.options.length; i++) {
        treatySubTypes_layer.options[i].selected = values.indexOf(treatySubTypes_layer.options[i].value) >= 0;
    }
</script>


