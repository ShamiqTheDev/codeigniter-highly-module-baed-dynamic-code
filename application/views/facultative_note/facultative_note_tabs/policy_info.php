<h3>Policy Information</h3>
<section>
     <div class="br-section-wrapper mg-b-25">
        <br>
        <form id="policiesInfo_Form" method="post" action="<?php echo current_url(); ?>">
        <div class="row">

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Policy Area </h3></label>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">RI Policy #  </label>
                     <input class="form-control" type="text" name="RIPolicy" id="RIPolicy" value="" placeholder="Enter RI Policy #">
                </div>
            </div> 
             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Referrence Policy #</label>
                     <input class="form-control" type="text" name="ReferrencePolicy" id="ReferrencePolicy" value="" placeholder="Enter Referrence Policy #">
                </div>
            </div>   
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Type of Cover </label>
                     <input class="form-control" type="text" name="TypeofCover" id="TypeofCover" value="" placeholder="Enter Type of Cover">
                </div>
            </div> 
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Policy Period From</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="date" class="form-control" name="PolicyPeriodFrom" id="PolicyPeriodFrom" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Policy Period To</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="date" class="form-control" name="PolicyPeriodTo" id="PolicyPeriodTo" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">RI Period From </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="date" class="form-control" name="RIPeriodFrom" id="RIPeriodFrom" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">RI Period To</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="date" class="form-control" name="RIPeriodTo" id="RIPeriodTo" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Date of Inception</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="date" class="form-control" name="DateofInception" id="DateofInception" >
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group mt-3">
                    <label class="form-control-label"><input type="checkbox"> Retroactive </label>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Retroactive Date </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="date" class="form-control" name="PolicyPeriodTo" id="PolicyPeriodTo" placeholder="Retroactive Date">
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Month-Year</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="date" class="form-control" name="PolicyPeriodTo" id="PolicyPeriodTo" placeholder="Month-Year" >
                    </div>
                </div>
            </div>




            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Policy's Risk, Peril(s) & Cover(s)</h3></label>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><input type="checkbox"> Policy's Risk, Peril(s) & Cover(s) </label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Referrence Policy #</label>
                     <input class="form-control" type="text" name="ReferrencePolicy" id="ReferrencePolicy" value="" placeholder="Enter Referrence Policy #">
                </div>
            </div>   
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Risk(s)</label>
                     <input class="form-control" type="text" name="Risk" id="Risk" value="" placeholder="Enter Risk(s)">
                </div>
            </div> 
             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Perils /Cover</label>
                     <input class="form-control" type="text" name="Perils_Cover" id="Perils_Cover" value="" placeholder="Enter Perils /Cover">
                </div>
            </div> 
            <div class="col-lg-8">
                <div class="form-group">
                    <label class="form-control-label">Sum Insured</label>
                     <input class="form-control" type="text" name="SumInsured" id="SumInsured" value="" placeholder="Enter Sum Insured">
                </div>
            </div>
 
            <div class="col-lg-4">
                <div class="form-group pull-right mt-4 btn-block">
                    <a href="javascript:void(0)" class="btn btn-success btn-block" data-toggle="modal" data-target=".policy-risk-modal">Details Sum Insured</a>
                </div>
            </div>  


            <div class="col-lg-8">
                <div class="form-group">
                    <label class="form-control-label">Limit Of Liability </label>
                     <input class="form-control" type="text" name="SumInsured" id="SumInsured" value="" placeholder="Enter Limit Of Liability">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group pull-right mt-4 btn-block">
                    <a href="javascript:void(0)" class="btn btn-success btn-block" data-toggle="modal" data-target=".liability-limit-details-modal">Details Limit Of Liability</a>
                </div>
            </div>  

             <div class="col-lg-8">
                <div class="form-group">
                    <label class="form-control-label">Gross Premium</label>
                     <input class="form-control" type="text" name="GrossPremium" id="GrossPremium" value="" placeholder="Enter Gross Premium">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group pull-right mt-4 btn-block">
                    <a href="javascript:void(0)" class="btn btn-success btn-block" data-toggle="modal" data-target=".gross-premium-details-modal">Details Gross Premium</a>
                </div>
            </div>   


            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Premium Rate Type</label>
                     <input class="form-control" type="text" name="SumInsured" id="SumInsured" value="" placeholder="Enter Premium Rate Type">
                </div>
            </div>

            <div class="col-lg-6">
                <div class="form-group">
                    <label class="form-control-label">Premium Rate </label>
                     <input class="form-control" type="text" name="SumInsured" id="SumInsured" value="" placeholder="Enter Premium Rate">
                </div>
            </div>

<!--              <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">PRCL Share %</label>
                     <input class="form-control" type="text" name="PRCLShare" id="PRCLShare" value="" placeholder="Enter PRCL Share %">
                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">PRCL Share Amount</label>
                     <input class="form-control" type="text" name="PRCLShareAmount" id="PRCLShareAmount" value="" placeholder="Enter PRCL Share Amount">
                </div>
            </div>    -->


            <!-- PRC Share  -->
            <div class="col-lg-12">
                <label class="form-control-label">PRC Share </label>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Sum Insured">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Limit Of Liability ">
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRC Share  -->
            <div class="col-lg-12">
                <label class="form-control-label">PRC Share </label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter RI Commission %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter RI Commission">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter RI Commission">
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">RI Commission Demanded</label>
                     <input class="form-control" type="text" name="RICommissionDemanded" id="RICommissionDemanded" value="" placeholder="Enter RI Commission Demanded">
                </div>
            </div>   
           <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">RI Commission Accepted</label>
                     <input class="form-control" type="text" name="RICommissionAccepted" id="RICommissionAccepted" value="" placeholder="Enter RI Commission Accepted">
                </div>
            </div>  
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">RI Commission</label>
                     <input class="form-control" type="text" name="RICommission" id="RICommission" value="" placeholder="Enter RI Commission">
                </div>
            </div>  
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Currency</label>
                     <input class="form-control" type="text" name="Currency" id="Currency" value="" placeholder="Enter Currency">
                </div>
            </div>  
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Pro-Rata  Premium </label>
                     <input class="form-control" type="text" name="ProRataPremium" id="ProRataPremium " value="" placeholder="Enter Pro-Rata  Premium ">
                </div>
            </div> 
             <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><input type="checkbox"> Pro-Rata </label>
                     <!-- <input class="form-control" type="text" name="ProRata" id="ProRata " value="" placeholder="Enter Pro-Rata"> -->
                </div>
            </div>  

            <div class="col-lg-12">
                <div class="form-group">
                    <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target=".adj-sum-ins-modal">Adj button</a>
                </div>
            </div>

            <!-- PRCL Share Amount  -->
            <div class="col-lg-12">
                <label class="form-control-label">PRCL Share Amount </label>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Premium">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Commission">
                        </div>
                    </div>

                </div>
            </div>

            <!-- PRCL Share Amount  -->
            <div class="col-lg-12">
                <label class="form-control-label">PRCL Share Amount </label>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Sum Insured">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Limit Of Liability ">
                        </div>
                    </div>

                </div>
            </div>



             <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label"><h3>Location/Situation</h3></label>
                    </div>
              </div>

                <div class="col-lg-12">
                <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>City </th>
                                <th>Situation/Location</th>
                                <th>Cresta Zone</th> 
                                <th>Sum Insured</th> 
                                <th>Limit Of Liability</th> 
                                <th>PRCL Share %</th> 
                                <th>PRCL Share Amount</th> 
                                <th>Currency</th> 
                                <th>Premium</th> 
                                <th>Commission</th> 
                            </tr>
                        </thead>
                        <tbody class="table_tbody_PremiumPaymentPlan">
                        <tr>
                            <td>1</td> 
                            <td><input class="form-control" type="text" name="City1" id="City1" value="" placeholder="Enter City Name"> </td> 
                            <td><input class="form-control" type="text" name="Situation_Location1" id="Situation_Location1" value=""  placeholder="Enter Situation/Location"> </td> 
                            <td><input class="form-control" type="checkbox" name="CrestaZone1" id="CrestaZone1" placeholder="Enter Cresta Zone"> </td> 
                            <td><input class="form-control" type="text" name="SumInsured1" id="SumInsured1" value="" placeholder="Enter Sum Insured"> </td> 
                            <td><input class="form-control" type="text" name="SumInsured1" id="SumInsured1" value="" placeholder="Enter Limit Of Liability"> </td> 
                            <td><input class="form-control" type="text" name="PRCLShare1" id="PRCLShare1" value="" placeholder="Enter PRCL Share %"> </td> 
                            <td><input class="form-control" type="text" name="PRCLShareAmount1" id="PRCLShareAmount1" value="" placeholder="Enter PRCL Share Amount"> </td> 
                            <td><input class="form-control" type="text" name="Currency1" id="Currency1" value="" placeholder="Enter Currency"> </td> 
                            <td><input class="form-control" type="text" name="Premium1" id="Premium1" value="" placeholder="Enter Premium"> </td> 
                            <td><input class="form-control" type="text" name="Commission1" id="Commission1" value="" placeholder="Enter Commission"> </td> 
                        </tr> 
                         <tr>
                           <td colspan="12"><button type="button" class="btn btn-success" style="float: right;">add more</button></td> 
                        </tr> 

                        </tbody> 
                    </table>
                </div>
                </div> 

              

                 <div class="col-lg-12" style="margin: 40px 0px 0px 0px;">
                        <div class="form-group">
                            <label class="form-control-label"><h3>Cedent Wise</h3></label>
                        </div>
                  </div>    
                <div class="col-lg-12"> 
                       <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>S#</th>
                                <th>Cedent </th>
                                <th colspan="3" style="text-align: center;">Marine Cargo</th>
                                <th colspan="3" style="text-align: center;">Marine Hull</th> 
                                <th colspan="3" style="text-align: center;">Fire</th> 
                                <th colspan="3" style="text-align: center;">Enineering</th> 
                                <th colspan="3" style="text-align: center;">Accident</th> 
                                <th colspan="3" style="text-align: center;">Aviation</th>  
                            </tr>
                            <tr>
                                <td></td> 
                                <td></td> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th>  
                            </tr>  
                            </thead>
                            <tbody class="table_tbody_PremiumPaymentPlan">
                                
                            <tr>
                                <td>1</td> 
                                <td>Adamjee General Insurance</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                            </tr>  
                            <tr>
                                <td>2</td> 
                                <td>EFU General Insurance</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                            </tr>  
                             <tr>
                                <td>2</td> 
                                <td>New Jubilee Insurance</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                            </tr>  
                            </tbody> 
                        </table>
                    </div>
                </div> 

                 <div class="col-lg-12" style="margin: 40px 0px 0px 0px;">
                        <div class="form-group">
                            <label class="form-control-label"><h3>UW Year Wise</h3></label>
                        </div>
                  </div>    
                 <div class="col-lg-12"> 
                       <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">

                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>S#</th>
                                <th>Year </th>
                                <th colspan="3" style="text-align: center;">Marine Cargo</th>
                                <th colspan="3" style="text-align: center;">Marine Hull</th> 
                                <th colspan="3" style="text-align: center;">Fire</th> 
                                <th colspan="3" style="text-align: center;">Enineering</th> 
                                <th colspan="3" style="text-align: center;">Accident</th> 
                                <th colspan="3" style="text-align: center;">Aviation</th>  
                            </tr>
                            <tr>
                                <td></td> 
                                <td></td> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th> 
                                <th>Premium</th> 
                                <th>Claim</th> 
                                <th>L/R</th>  
                            </tr>  
                            </thead>
                            <tbody class="table_tbody_PremiumPaymentPlan">
                                
                            <tr>
                                <td>1</td> 
                                <td>2019</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                            </tr>  
                            <tr>
                                <td>2</td> 
                                <td>2020</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                            </tr>  
                             <tr>
                                <td>2</td> 
                                <td>2021</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                                <td>2000</td> 
                                <td>1000</td> 
                                <td>0.5</td> 
                            </tr>  
                            </tbody> 
                        </table>
                    </div>
                </div> 
 


            <div class="col-lg-12">
                <div class="form-group">
                    <div class="form-group"> 
                        <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 " style="margin: 10px;float: right;" name="policiesInfo_Btn" id="policiesInfo_Btn" value="Add">
                    </div>

                </div>
            </div>
        </div>
        </form>
       
    </div> 

</section>
 

<div class="modal fade adj-sum-ins-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content policyRiskData">

        <div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 5px 10px 0px 0px;"><span aria-hidden="true">×</span></button>
        </div>
        <div class="br-section-wrapper mg-t-20">
            <div class="loader" style="display: none;"></div>
            
            <div class="row">
                <!-- Adjusted Sum Insured / Premium -->
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label"><h3>Adjusted Sum Insured / Premium </h3></label>
                    </div>
                </div> 

                <div class="col-lg-4">
                    <label class="form-control-label">Adjusted Rate<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="facAdjustedRate" id="facAdjustedRate" placeholder="Enter Adjusted Rate"> 
                    </div>
                </div>  
                <div class="col-lg-4">
                    <label class="form-control-label">Adjusted Sum Insured <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="facAdjustedSumInsured " id="facAdjustedSumInsured" placeholder="Enter Adjusted Sum Insured "> 
                    </div>
                </div>  
                <div class="col-lg-4">
                    <label class="form-control-label">Currency<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="facAdjustedCurrency" id="facAdjustedCurrency" placeholder="Enter Currency"> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">PRC Share SI <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="facAdjustedPrcShareSi " id="facAdjustedPrcShareSi" placeholder="Enter PRC Share SI"> 
                    </div>
                </div> 
                <div class="col-lg-4">
                    <label class="form-control-label">PRC Share LL <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="facAdjustedPrcShareLL" id="facAdjustedPrcShareLL" placeholder="Enter PRC Share LL"> 
                    </div>
                </div> 
                <div class="col-lg-4">
                    <label class="form-control-label">PRC Share Premium  <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="facAdjustedPrcSharePremium" id="facAdjustedPrcSharePremium" placeholder="Enter PRC Share Premium "> 
                    </div>
                </div>

                <div class="col-lg-12">
                    <button type="button" class="btn btn-success"> Save </button>
                </div>

            </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade policy-risk-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content policyRiskData">

        <div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 5px 10px 0px 0px;"><span aria-hidden="true">×</span></button>
        </div>
        <div class="br-section-wrapper mg-t-20">
            <div class="loader" style="display: none;"></div>
            
            <div class="row">
                <!-- Details Sum Insured -->
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label"><h2> Details Sum Insured </h2></label>
                    </div>
                </div> 

                <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> S# </th>
                                <th> Head </th>
                                <th> Amount PKR </th>
                                <th> Amount Dollar </th>
                                <th> Rate </th>
                                <th> % </th>
                                <th> Amount </th>
                                <th> Description </th>
                            </tr>
                        </thead>
                        <tbody class="" id=''>
                        <tr>
                            <td>1</td> 
                            <td> Plant and Equipment Base plant </td> 
                            <td> 20,000 (PKR) </td> 
                            <td> 10,000 (USD) </td> 
                            <td> 20 </td> 
                            <td> 90% </td> 
                            <td> 90,000 </td> 
                            <td> Limit Of Liability  Section1 Plant and Equipment Base plant  </td> 
                        </tr>

                        <tr>
                            <td> 2 </td> 
                            <td> Plant and Equipment Base plant </td> 
                            <td> 20,000 (PKR) </td> 
                            <td> 10,000 (USD) </td> 
                            <td> 20 </td> 
                            <td> 90% </td> 
                            <td> 90,000 </td> 
                            <td> Limit Of Liability  Section1 Plant and Equipment Base plant  </td> 
                        </tr> 

                        </tbody> 
                    </table>
                </div>

            </div>
        </div>
      </div>
    </div>
</div>


<div class="modal fade liability-limit-details-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content policyRiskData">

        <div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 5px 10px 0px 0px;"><span aria-hidden="true">×</span></button>
        </div>
        <div class="br-section-wrapper mg-t-20">
            <div class="loader" style="display: none;"></div>
            
            <div class="row">
                <!-- Details Sum Insured -->
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label"><h2> Details Limit of Liability </h2></label>
                    </div>
                </div> 

                <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> S# </th>
                                <th> Head </th>
                                <th> Amount PKR </th>
                                <th> Amount Dollar </th>
                                <th> Rate </th>
                                <th> % </th>
                                <th> Amount </th>
                                <th> Description </th>
                            </tr>
                        </thead>
                        <tbody class="" id=''>
                        <tr>
                            <td>1</td> 
                            <td> Plant and Equipment Base plant </td> 
                            <td> 20,000 (PKR) </td> 
                            <td> 10,000 (USD) </td> 
                            <td> 20 </td> 
                            <td> 90% </td> 
                            <td> 90,000 </td> 
                            <td> Limit Of Liability  Section1 Plant and Equipment Base plant  </td> 
                        </tr>

                        <tr>
                            <td> 2 </td> 
                            <td> Plant and Equipment Base plant </td> 
                            <td> 20,000 (PKR) </td> 
                            <td> 10,000 (USD) </td> 
                            <td> 20 </td> 
                            <td> 90% </td> 
                            <td> 90,000 </td> 
                            <td> Limit Of Liability  Section1 Plant and Equipment Base plant  </td> 
                        </tr> 

                        </tbody> 
                    </table>
                </div>

            </div>
        </div>
      </div>
    </div>
</div>

<div class="modal fade gross-premium-details-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalwindow2">
    <div class="modal-dialog modal-lg">
      <div class="modal-content policyRiskData">

        <div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin: 5px 10px 0px 0px;"><span aria-hidden="true">×</span></button>
        </div>
        <div class="br-section-wrapper mg-t-20">
            <div class="loader" style="display: none;"></div>
            
            <div class="row">
                <!-- Details Gross Premium -->
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label"><h2> Details Gross Premium </h2></label>
                    </div>
                </div> 

                <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th> S# </th>
                                <th> Head </th>
                                <th> Amount PKR </th>
                                <th> Amount Dollar </th>
                                <th> Rate </th>
                                <th> % </th>
                                <th> Amount </th>
                                <th> Description </th>
                            </tr>
                        </thead>
                        <tbody class="" id=''>
                        <tr>
                            <td>1</td> 
                            <td> Plant and Equipment Base plant </td> 
                            <td> 20,000 (PKR) </td> 
                            <td> 10,000 (USD) </td> 
                            <td> 20 </td> 
                            <td> 90% </td> 
                            <td> 90,000 </td> 
                            <td> Limit Of Liability  Section1 Plant and Equipment Base plant  </td> 
                        </tr>

                        <tr>
                            <td> 2 </td> 
                            <td> Plant and Equipment Base plant </td> 
                            <td> 20,000 (PKR) </td> 
                            <td> 10,000 (USD) </td> 
                            <td> 20 </td> 
                            <td> 90% </td> 
                            <td> 90,000 </td> 
                            <td> Limit Of Liability  Section1 Plant and Equipment Base plant  </td> 
                        </tr> 

                        </tbody> 
                    </table>
                </div>

            </div>
        </div>
      </div>
    </div>
</div>