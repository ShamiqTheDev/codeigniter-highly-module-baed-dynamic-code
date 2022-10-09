<?php $this->load->view('includes/header', $this->data);?>
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Treaty Slip</span>
        </nav>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Treaty Slip</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>
<div class="br-pagebody mg-t-5 pd-x-30">

<div class="br-section-wrapper section-wrapper-shadow">

    
        <div id="wizard1">
                <h3>General</h3>
      
    <section>
            <div class="row mg-b-25">
              
        <div class="col-lg-4">
                <div class="form-group form-validate">
                  <label class="form-control-label">Reinsured<span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Option">
                        <option label="Choose Option"></option>
                        <option value="Option">Atlas Insurance</option>
                        <option value="Option">Adam Jee Insurance</option>
                        <option value="Option">New Jubilee Insurance</option>
                        <option value="Option">EFU Insurance</option>
                    </select>
                </div>
        </div>
        
        <div class="col-lg-4">
                <div class="form-group form-validate">
                  <label class="form-control-label">PRCL Participation Flag<span class="tx-danger">*</span></label>
                     <select class="form-control select2" data-placeholder="Choose Option">
                        <option label="Choose Option"></option>
                        <option value="Option">Leader</option>
                        <option value="Option">Follower</option>
                     </select>
                 </div>
        </div>
        
        <div class="col-lg-4">
                <div class="form-group form-validate">
                     <label class="form-control-label">Leader/Follower<span class="tx-danger">*</span></label>
                     <select class="form-control select2" data-placeholder="Choose Option">
                        <option label="Choose Option"></option>
                        <option value="Option">Hannover RE</option>
                        <option value="Option">ABC Re</option>
                        <option value="Option">XYZ Re</option>
                      </select>
                </div>
         </div>
        
         <div class="col-lg-4">
                <div class="form-group form-validate">
                    <label class="form-control-label">Treaty Period </label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                      <input type="text" class="form-control fc-datepicker" placeholder="01-Jan-2019 To 31-Dec-2019">
                    </div>
                </div>
         </div><!-- col-4 -->
              
        <div class="col-lg-4">
                <div class="form-group form-validate">
                  <label class="form-control-label">Business Class<span class="tx-danger">*</span></label>
                     <select class="form-control select2" data-placeholder="Choose Option">
                        <option label="Choose Option"></option>
                        <option value="Option">Option 1</option>
                        <option>Choose Class</option>
                        <option>Fire</option>
                        <option>Marine</option>
                        <option>Engineering</option>
                        <option>Aviation</option>
                        <option>Accident</option>
                        <option>---</option>
                     </select>
                </div>
         </div><!-- col-4 -->

        <div class="col-lg-4">
                <div class="form-group form-validate mg-b-10-force">
                  <label class="form-control-label">Underwriting Type </label>
                  <input class="form-control" type="text" name="address" value="Treaty" placeholder="">
                </div>
              </div>
        
        <div class="col-lg-4">
                <div class="form-group form-validate">
                  <label class="form-control-label">Type Of Treaty<span class="tx-danger">*</span></label>
                 <select class="form-control select2" data-placeholder="Choose Option">
                    <option label="Choose Option"></option>
                    <option value="Option">Option 1</option>
          <option>Choose Treaty</option>
                    <option>Fire 1st Surplus</option>
                  <option>Marine Surplus</option>
          <option>Terrorism Quota Share</option>
          <option>---</option>
                    
                  </select>
          
                </div>
              </div><!-- col-4 -->
        
        
        <div class="col-lg-4">
                <div class="form-group form-validate mg-b-10-force">
                  <label class="form-control-label">Unique Market Risk (UMR) </label>
                  <input class="form-control" type="text" name="address" value="12191810238009" placeholder="">
                </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group form-validate ">
                  <label class="form-control-label">Portfolio <span class="tx-danger">*</span></label>
                     <select class="form-control select2" data-placeholder="Choose Option">
                        <option label=""></option>
                        <option value="Option">Run Off</option>
                        <option value="Option">Cut Off</option>
                        <option value="Option">Risk Attaching</option>
                        <option value="Option">Clean Cut</option>
                     </select>
             </div>
        </div>

        <div class="col-lg-4">
                <div class="form-group form-validate ">
                  <label class="form-control-label">Class Of Business <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Option">
                        <option label=""></option>
                        <option value="Option">All Personal Accident business</option>
                        <option value="Option">Accident & Sickness Medical Expense</option>
                        <option value="Option">Individual Travel (ITA)</option>
                        <option value="Option">Group Travel (GTA)</option>
                    </select>
                </div>
        </div>

        <div class="col-lg-4">
                <div class="form-group form-validate">
                      <label class="form-control-label">Offered To PRCL<span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="firstname" value="35% " placeholder="123">
                </div>
        </div><!-- col-4 -->

        <div class="col-lg-4">
                <div class="form-group form-validate">
                  <label class="form-control-label">OF %<span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="firstname" value="100% " placeholder="123">
                </div>
        </div><!-- col-4 -->

        <div class="col-lg-4">
                <div class="form-group form-validate">
                      <label class="form-control-label">Accepted By PRCL<span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="firstname" value="100% " placeholder="123">
                </div>
        </div><!-- col-4 -->


        <div class="col-lg-4">
            <div class="form-group form-validate">
                <label class="form-control-label">Territorial Limit <span class="tx-danger">*</span></label>
                <input class="form-control" type="text" name="firstname" value="Losses wheresoever in pakistan" placeholder="123">
            </div>
        </div><!-- col-4 -->
        
        <div class="col-lg-4">
                <div class="form-group form-validate">
                      <label class="form-control-label">Premium <span class="tx-danger">*</span></label>
                      <input class="form-control" type="text" name="firstname" value="PKR 1,340,000" placeholder="123">
                </div>
        </div><!-- col-4 -->
        
        <div class="col-lg-4">
                <div class="form-group form-validate">
                  <label class="form-control-label">Premium payment Term <span class="tx-danger">*</span></label>
                  <input class="form-control" type="text" name="firstname" value="Nil" placeholder="123">
                </div>
          </div><!-- col-4 -->
  
        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Adjustment Rate <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="firstname" value="1.65%" placeholder="123">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">EGNPI <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="firstname" value="PKR 90,000,0000" placeholder="123">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">GNPI <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="firstname" value="GNPI 2018 PKR 925,000,0000/GNPI 2017(Revised) PKR 900,000,0000/GNPI 2017(Original Est.) PKR 800,000,0000 " placeholder="123">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Maximum Net Retention <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="firstname" value="PKR 40,000,0000 any one vehicle" placeholder="123">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Leader Share <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="firstname" value="50% of 100% across all layers" placeholder="123">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group form-validate">
              <label class="form-control-label">Special Acceptance <span class="tx-danger">*</span></label>
              <input class="form-control" type="text" name="firstname" value="----" placeholder="123">
            </div>
        </div>
      
        
        <div class="clear"></div>
        
                <div class="form-layout form-layout-1 mg-b-15" style="width:97%; margin:10px auto; background:#fff;display: block;" >
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="form-control-label">Premium <span class="tx-danger">*</span></label>
                                <div class="form-group form-validate">
                                    <label class="rdiobox rdiobox-success radio_div">
                                        <input type="radio" class="radio_w" name="radio_w" onclick="ShowHideToggle('PremiumContainer','LayerContainer')"><span>Single</span>
                                    </label>

                                    <label class="rdiobox rdiobox-success radio_div">
                                        <input type="radio" class="radio_w"  name="radio_w" onclick="ShowHideToggle('LayerContainer','PremiumContainer')"><span>Layer</span>
                                    </label>

                                </div>
                            </div>
                        </div>

                    <div class="form-layout form-layout-1 mg-b-15" style="width:97%; margin:10px auto; background:#fff;display: none;" id="PremiumContainer">
                        <h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Premium </h6>

                        <div class="row ">
                            <div class="col-lg-12">
                                <div class="form-group form-validate">
                                    <label class="form-control-label">Premium</label>
                                    <input class="form-control" type="text" name="firstname" value="" placeholder="">
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->
                     </div><!-- form-layout -->


                    <div class="form-layout form-layout-1 mg-b-15" style="width:97%; margin:10px auto; background:#fff;display: none;" id="LayerContainer">

                            <h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Layer 1</h6>
                            <div class="row ">
                                <div class="col-lg-4">
                                    <div class="form-group form-validate">
                                      <label class="form-control-label">Amount</label>
                                      <input class="form-control" type="text" id="firstname_layer1" name="firstname_layer1" value="" placeholder="Enter Amount">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group form-validate">
                                        <label class="form-control-label">Percent</label>
                                        <input class="form-control" type="text" id="Percent_layer1" name="Percent_layer1" value="" placeholder="Enter Percent">
                                    </div>
                                </div><!-- col-4 -->
                                <div class="col-lg-4">
                                    <div class="form-group form-validate">
                                        <label class="form-control-label">Amount</label>
                                        <input class="form-control" type="text" id="Amount_layer1" name="Amount_layer1" value="" placeholder="Enter Amount">
                                    </div>
                                </div><!-- col-4 -->


                            </div><!-- row -->
                            <p class="tx-gray-600">A bordered form group wrapper with a label on top of each form control.</p>


                            <h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Layer 2</h6>

                            <div class="row ">

                              <div class="col-lg-4">

                                <div class="form-group form-validate">
                                  <input class="form-control" type="text" id="firstname_layer2" name="firstname_layer2" value="" placeholder="Enter Amount">
                                </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                <div class="form-group form-validate">
                                  <input class="form-control" type="text" id="Percent_layer2" name="Percent_layer2" value="" placeholder="Enter Percent">
                                </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                <div class="form-group form-validate">
                                  <input class="form-control" type="text" id="Amount_layer2" name="Amount_layer2" value="" placeholder="Enter Amount">
                                </div>
                              </div><!-- col-4 -->


                            </div><!-- row -->
                            <p class="tx-gray-600">A bordered form group wrapper with a label on top of each form control.</p>


                            <h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Layer 3</h6>

                            <div class="row " >

                              <div class="col-lg-4">

                                <div class="form-group form-validate">
                                  <input class="form-control" type="text" id="firstname_layer3" name="firstname_layer3" value="" placeholder="Enter Amount">
                                </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                <div class="form-group form-validate">
                                  <input class="form-control" type="text" id="Percent_layer3" name="Percent_layer3" value="Percent" placeholder="Enter Percent">
                                </div>
                              </div><!-- col-4 -->
                              <div class="col-lg-4">
                                <div class="form-group form-validate">
                                  <input class="form-control" type="text" id="Amount_layer3" name="Amount_layer3" value="" placeholder="Enter Amount">
                                </div>
                              </div><!-- col-4 -->


                            </div><!-- row -->
                            <p class="tx-gray-600" id="AppendableLayer_Container_3">A bordered form group wrapper with a label on top of each form control.</p>


                              <div class="pd-y-30 tx-right">
                                <button class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-spacing-2" onclick="AppendableLayer_Container_1();">Add More</button>
                              </div>
                        </div><!-- form-layout -->


                </div><!-- form-layout -->


                <div class="form-layout form-layout-1 mg-b-15" style="width:97%; margin:10px auto; background:#fff;display: block;" >
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="form-control-label">Treaty Limit <span class="tx-danger">*</span></label>
                            <div class="form-group form-validate">
                                <label class="rdiobox rdiobox-success radio_div">
                                    <input type="radio" class="radio_w" name="TreatyLimit_radio_w" onclick="ShowHideToggleTreaty('TreatyLimitContainer','TreatyLayerContainer')"><span>Single</span>
                                </label>

                                <label class="rdiobox rdiobox-success radio_div">
                                    <input type="radio" class="radio_w"  name="TreatyLimit_radio_w" onclick="ShowHideToggleTreaty('TreatyLayerContainer','TreatyLimitContainer')"><span>Layer</span>
                                </label>

                            </div>
                        </div>
                    </div>

                    <div class="form-layout form-layout-1 mg-b-15" style="width:97%; margin:10px auto; background:#fff;display: none;" id="TreatyLimitContainer">
                        <h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Treaty Limit </h6>

                        <div class="row ">

                            <div class="col-lg-12">

                                <div class="form-group form-validate">
                                    <label class="form-control-label">Treaty Limit</label>
                                    <input class="form-control" type="text" id="TreatyLimit_TreatyLimit" name="TreatyLimit_TreatyLimit" value="" placeholder="">
                                </div>
                            </div><!-- col-4 -->



                        </div><!-- row -->



                    </div><!-- form-layout -->


                    <div class="form-layout form-layout-1 mg-b-15" style="width:97%; margin:10px auto; background:#fff;display: none;" id="TreatyLayerContainer">

                        <h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Layer 1</h6>
                        <div class="row ">
                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <label class="form-control-label">Amount</label>
                                    <input class="form-control" type="text" id="firstname_TreatyLayer1" name="firstname_TreatyLayer1" value="" placeholder="Enter Amount">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <label class="form-control-label">Percent</label>
                                    <input class="form-control" type="text" id="Percent_TreatyLayer1" name="Percent_TreatyLayer1" value="" placeholder="Enter Percent">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <label class="form-control-label">Amount</label>
                                    <input class="form-control" type="text" id="Amount_TreatyLayer1" name="Amount_TreatyLayer1" value="" placeholder="Enter Amount">
                                </div>
                            </div><!-- col-4 -->


                        </div><!-- row -->
                        <p class="tx-gray-600">A bordered form group wrapper with a label on top of each form control.</p>


                        <h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Layer 2</h6>

                        <div class="row ">

                            <div class="col-lg-4">

                                <div class="form-group form-validate">
                                    <input class="form-control" type="text" id="firstname_TreatyLayer2" name="firstname_TreatyLayer2" value="" placeholder="Enter Amount">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <input class="form-control" type="text" id="Percent_TreatyLayer2" name="Percent_TreatyLayer2" value="" placeholder="Enter Percent">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <input class="form-control" type="text" id="Amount_TreatyLayer2" name="Amount_TreatyLayer2" value="" placeholder="Enter Amount">
                                </div>
                            </div><!-- col-4 -->


                        </div><!-- row -->
                        <p class="tx-gray-600">A bordered form group wrapper with a label on top of each form control.</p>


                        <h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Layer 3</h6>

                        <div class="row " >

                            <div class="col-lg-4">

                                <div class="form-group form-validate">
                                    <input class="form-control" type="text" id="firstname_TreatyLayer3" name="firstname_TreatyLayer3" value="" placeholder="Enter Amount">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <input class="form-control" type="text" id="Percent_TreatyLayer3" name="Percent_TreatyLayer3" value="Percent" placeholder="Enter Percent">
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <input class="form-control" type="text" id="Amount_TreatyLayer3" name="Amount_TreatyLayer3" value="" placeholder="Enter Amount">
                                </div>
                            </div><!-- col-4 -->


                        </div><!-- row -->
                        <p class="tx-gray-600" id="Appendable_TreatyLayer_Container_3">A bordered form group wrapper with a label on top of each form control.</p>


                        <div class="pd-y-30 tx-right">
                            <button class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-spacing-2" onclick="Append_TreatyLayer_Container();">Add More</button>
                        </div>
                    </div><!-- form-layout -->


                </div><!-- form-layout -->


      
     </section> 
            
      
      
       <h3>Layers</h3>
            <section>
                <div class="br-section-wrapper">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                                                                          <!--thead class="thead-dark"-->
                                                                          <tr>
                                                                              <th scope="col">S #</b></th>
                                                                              <th scope="col">Layer</th>
                                            <th scope="col">Layer Detail</th>
                                            
                                                                          </tr>
                                                                          <tbody>
                                                                          <tr>
                                                                              <th scope="row" >1</th>
                                                                              <td>Layer1</td>
                                            <td>******</td>
                                                                          </tr>
                                                                          
          <tr>
                                                                              <th scope="row" >2</th>
                                                                              <td>Layer2</td>
                                            <td>******</td>
                                            
                                                                          </tr>
          <tr>
                                                                              <th scope="row" >3</th>
                                                                              <td>Layer3</td>
                                            <td>******</td>
                                                                          </tr>
          <tr>
                                                                              <th scope="row" >4</th>
                                                                              <td>Layer4</td>
                                            <td>******</td>
                                                                          </tr>
          <tr>
                                                                              <th scope="row" >5</th>
                                                                              <td>Layer5</td>
                                            <td>******</td>
                                                                          </tr>
          <tr>
                                                                              <th scope="row" >6</th>
                                                                              <td>Layer6</td>
                                            <td>******</td>
                                                                          </tr>
          <tr>
                                                                              <th scope="row" >7</th>
                                                                              <td>Layer7</td>
                                            <td>******</td>
                                                                          </tr>

                                          </thead>
                                                                          <tbody>
                                                                          
                                                                          </tbody>
                                                                      </table>
                 </div> 
            </section>      
       
       <h3>Lines</h3>
            <section>
                <div class="br-section-wrapper">
                <table id="datatable-buttons" class="table table-striped table-bordered">
                                                                          <!--thead class="thead-dark"-->
          <tr> <th scope="col">S #</b></th> <th scope="col">Line</th> <th scope="col">Line Detail</th> </tr>
          <tbody>
          <tr><th scope="row" >1</th><td>Line1</td><td>******</td></tr>
                                                                          
          <tr><th scope="row" >2</th><td>Line2</td><td>******</td>
                                            </tr>
          <tr><th scope="row" >3</th><td>Line3</td><td>******</td></tr>
          <tr><th scope="row" >4</th><td>Line4</td><td>******</td></tr>
          <tr><th scope="row" >5</th><td>Line5</td><td>******</td></tr>
          <tr><th scope="row" >6</th><td>Line6</td><td>******</td></tr>
          <tr><th scope="row" >7</th><td>Line7</td><td>******</td></tr>

          </thead> <tbody> </tbody></table>
                 </div> 
          </section>      
      
       <h3>Conditions</h3>
            <section>
                  <div class="br-section-wrapper">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                                                                            <!--thead class="thead-dark"-->
                                                                            <tr>
                                                                                <th scope="col">S #</b></th>
                                                                                <th scope="col">Conditions</th>
                                              <th scope="col">Applicable</th>
                                              
                                                                            </tr>
                                                                            <tbody>
                                                                            <tr>
                                                                                <th scope="row" >1</th>
                                                                                <td>Condition1</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
                                                                            
            <tr>
                                                                                <th scope="row" >2</th>
                                                                                <td>Condition2</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >3</th>
                                                                                <td>Condition3</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >4</th>
                                                                                <td>Condition4</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >5</th>
                                                                                <td>Condition5</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >6</th>
                                                                                <td>Condition6</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >7</th>
                                                                                <td>Condition7</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>

                                            </thead>
                                                                            <tbody>
                                                                            
                                                                            </tbody>
                                                                        </table>
                   </div> 
            </section>
           
         <h3>Special Condition</h3>
            <section>
                  <div class="br-section-wrapper">
                  <table id="datatable-buttons" class="table table-striped table-bordered">
                                                                            <!--thead class="thead-dark"-->
                                                                            <tr>
                                                                                <th scope="col">S #</b></th>
                                                                                <th scope="col">Special Condition</th>
                                              <th scope="col">Applicable</th>
                                              
                                                                            </tr>
                                                                            <tbody>
                                                                            <tr>
                                                                                <th scope="row" >1</th>
                                                                                <td>Special Condition1</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
                                                                            
            <tr>
                                                                                <th scope="row" >2</th>
                                                                                <td>Special Condition2</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >3</th>
                                                                                <td>Special Condition3</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >4</th>
                                                                                <td>Special Condition4</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >5</th>
                                                                                <td>Special Condition5</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >6</th>
                                                                                <td>Special Condition16</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>
            <tr>
                                                                                <th scope="row" >7</th>
                                                                                <td>Special Condition7</td>
                                              <td><input type="checkbox"></td>
                                                                            </tr>

                                            </thead>
                                                                            <tbody>
                                                                            
                                                                            </tbody>
                                                                        </table>
                   </div> 
            </section>
      
           <h3>Exclusions</h3>
            <section>
              <div class="br-section-wrapper">
              <table id="datatable-buttons" class="table table-striped table-bordered">
                                                                        
                                                                        <tr><th scope="col">S #</b></th><th scope="col">Exclusions</th>
                                          <th scope="col">Applicable</th></tr>
                                                                        <tbody>
                                                                        <tr><th scope="row" >1</th><td>Exclusions1</td>
                                          <td><input type="checkbox"></td> </tr>
                                                                        
                                              <tr><th scope="row" >2</th><td>Exclusions2</td><td><input type="checkbox"></td></tr>
                      <tr>
                                                                                          <th scope="row" >3</th>
                                                                                          <td>Exclusions3</td>
                                                        <td><input type="checkbox"></td>
                                                                                      </tr>
                      <tr>
                                                                                          <th scope="row" >4</th>
                                                                                          <td>Exclusions4</td>
                                                        <td><input type="checkbox"></td>
                                                                                      </tr>
                      <tr>
                                                                                          <th scope="row" >5</th>
                                                                                          <td>Exclusions5</td>
                                                        <td><input type="checkbox"></td>
                                                                                      </tr>
                      <tr><th scope="row" >6</th><td>Exclusions6</td><td><input type="checkbox"></td> </tr>
                                      <tr><th scope="row" >7</th><td>Exclusions7</td><td><input type="checkbox"></td> </tr>

                                        </thead><tbody> </tbody> </table>
               </div> 
            </section>
      
      
         
    </div>
 
   


<?php $this->load->view('includes/footer', $this->data);?>

<script>
  //$(document).ready(function(){ alert('call')});

        function ShowHideToggle(ShowContainerId)
        {
            
            $('#PremiumContainer').hide();
            $('#LayerContainer').hide();

            $('#'+ShowContainerId).show();


        }

        function ShowHideToggleTreaty(ShowContainerId)
        {
            $('#TreatyLimitContainer').hide();
            $('#TreatyLayerContainer').hide();

            $('#'+ShowContainerId).show();


        }
        
       $('#wizard1').steps({
          headerTag: 'h3',
          bodyTag: 'section',
          autoFocus: true,
          titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>'
        });
    // Datepicker
        $('.fc-datepicker').datepicker({
          showOtherMonths: true,
          selectOtherMonths: true
        });

        var Index = 3;
        function  AppendableLayer_Container_1()
        {
            Index++;
            var IdIndex = Index - 1;
            var AppendableLayer_ContainerId = "#AppendableLayer_Container_"+IdIndex;
            var Removed_ContainerId = "AppendableLayer_Container_"+Index;
            var html = '';
            html +='<div id="'+Removed_ContainerId+'" class="AppendableLayer1"><h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Layer '+Index+'</h6>' +
                '<div class="row"><div class="col-lg-4">' +
                '<div class="form-group form-validate"><input class="form-control" type="text" id="firstname_layer'+Index+'" name="firstname_layer'+Index+'" value="" placeholder="Enter Amount"></div></div>' +
                '<div class="col-lg-4"><div class="form-group form-validate">' +
                '<input class="form-control" type="text" id="Percent_layer'+Index+'" name="Percent_layer'+Index+'" value="" placeholder="Enter Percent"></div></div>' +
                '<div class="col-lg-4"><div class="form-group form-validate"><input class="form-control" type="text" id="Amount_layer'+Index+'" name="Amount_layer'+Index+'" value="" placeholder="Enter Amount"></div> <label style="float: right;" onclick="RemoveMe(\'#'+Removed_ContainerId+'\')">Remove</label>' +
                '</div></div><p class="tx-gray-600" id="AppendableLayer_Container_'+Index+'" >A bordered form group wrapper with a label on top of each form control.</p></div>';

            $(AppendableLayer_ContainerId).after(html);


        }
        var Index_2 = 3;
        function  Append_TreatyLayer_Container()
        {
            Index_2++;
            var IdIndex_2 = Index_2 - 1;
            var AppendableLayer_ContainerId = "#Appendable_TreatyLayer_Container_"+IdIndex_2;
            var Removed_ContainerId = "Appendable_TreatyLayer_Container_"+Index_2;
            var html = '';
            html +='<div id="'+Removed_ContainerId+'" class="AppendableLayer2"><h6 class="tx-success tx-uppercase tx-bold tx-14 mg-b-10">Layer '+Index_2+'</h6>' +
                '<div class="row"><div class="col-lg-4">' +
                '<div class="form-group form-validate"><input class="form-control" type="text" id="firstname_TreatyLayer'+Index_2+'" name="firstname_TreatyLayer'+Index_2+'" value="" placeholder="Enter Amount"></div></div>' +
                '<div class="col-lg-4"><div class="form-group form-validate">' +
                '<input class="form-control" type="text" id="Percent_TreatyLayer'+Index_2+'" name="Percent_TreatyLayer'+Index_2+'" value="" placeholder="Enter Percent"></div></div>' +
                '<div class="col-lg-4"><div class="form-group form-validate"><input class="form-control" type="text" id="Amount_TreatyLayer'+Index_2+'" name="Amount_TreatyLayer'+Index_2+'" value="" placeholder="Enter Amount"></div> <label style="float: right;" onclick="RemoveMe(\'#'+Removed_ContainerId+'\')">Remove</label>' +
                '</div></div><p class="tx-gray-600" id="Appendable_TreatyLayer_Container_'+Index_2+'" >A bordered form group wrapper with a label on top of each form control.</p></div>';
            // alert('hell');
            $(AppendableLayer_ContainerId).after(html);


        }

        function RemoveMe(ContainerId)
        {
            $(ContainerId).hide()
        }

    </script>