<h3>Request Note Information</h3>
<section>
    

    <div class="br-section-wrapper mg-b-25">
        <br>
        <form id="requestNotInfo_Form" method="post" action="<?php echo current_url(); ?>">
        <div class="row"> 

            <div class="col-lg-4">
                <div class="form-group facinceptionDateErrorDiv">
                    <label class="form-control-label">Inception Date</label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="text" class="form-control fc-datepicker" name="facinceptionDate" id="facinceptionDate" >
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Request Note No <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="facReqNo" id="facReqNo" placeholder="Enter Request Note No">
                </div>
            </div> 
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Request Note Date <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="text" class="form-control fc-datepicker" name="facReqDate" id="facReqDate" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Request Note Id <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="facReqNo" id="facReqNo" placeholder="Enter Request Note Id">
                </div>
            </div>  
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Cedent <span class="tx-danger">*</span></label>
                    <select class="form-control select2 SelCedent" data-placeholder="Choose Option Cedent" id="SelCedent" name="cedentDTO.id" >
                        <option value="">Select Cedent</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Details Limit Of Liability </label>
                    <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Details Limit Of Liability" name="facPrcAcceptDesc"></textarea>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Original Insured Name<span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="facOriginalInsuredName" id="facOriginalInsuredName" placeholder="Enter Original Insured Name">
                </div>
            </div> 
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Insured<span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Option" id="SelectInsured" name="insuredDTO.id" >
                       <option value="">Select Insured</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Period From <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="text" class="form-control fc-datepicker" name="facReqDate" id="facReqDate" >
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Period To <span class="tx-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                        <input type="text" class="form-control fc-datepicker" name="facReqDate" id="facReqDate" >
                    </div>
                </div>
            </div>  

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Both Days </label><br>
                     <label class="radio-inline"> <input class="form-control" type="radio" name="bothDays" id="isRetro_Inclusive" value="Inclusive"> Inclusive</label>
                     <label class="radio-inline" style="margin: 5px 11px 0px 0px;"><input class="form-control" type="radio" name="bothDays" id="isRetro_Exclusive" value="Exclusive" checked >Exclusive</label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Time<span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="time" id="time" placeholder="Enter Time">
                </div>
            </div> 

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Type of Cover / Interest<span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="typeOfCoverInterest" id="typeOfCoverInterest" placeholder="Enter Type of Cover / Interest">
                </div>
            </div> 

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Cover(s)/ Perils<span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="typeOfCoverInterest" id="typeOfCoverInterest" placeholder="Enter Cover(s)/ Perils">
                </div>
            </div> 

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Cover(s)/ Perils Detail </label>
                    <textarea class="form-control" id="coverPerilsDetail"  name="coverPerilsDetail" placeholder="Enter Cover(s)/ Perils Detail"></textarea>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label"> Type of Project <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="typeOfCoverInterest" id="typeOfCoverInterest" placeholder="Enter Type of Project">
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label"> Sitting Capacity  <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="typeOfCoverInterest" id="typeOfCoverInterest" placeholder="Enter Sitting Capacity">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"> Sitting Capacity Description </label>
                    <textarea class="form-control" id="coverPerilsDetail"  name="coverPerilsDetail" placeholder="Enter Sitting Capacity Description"></textarea>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><input type="checkbox" value=""> Including Hull </label>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Maximum Probable Loss % <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="maxProbableLoss" id="maxProbableLoss" placeholder="Enter Maximum Probable Loss">
                </div>
            </div> 

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">CP Days <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="cpDays" id="cpDays" value="45" placeholder="Enter CP Days" readonly>
                </div>
            </div> 
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Premium Payment Warranty <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="premiumPaymentWarranty" id="premiumPaymentWarranty" value="30" readonly placeholder="Enter Premium Payment Warranty">
                </div>
            </div> 

            <div class="col-lg-4">
                <label class="form-control-label">Status <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <select class="form-control select2">
                        <option>Initiated</option>
                        <option>Reviewed1</option>
                        <option>Reviewed2</option>
                        <option>Rejected</option>
                        <option>Provisional</option>
                        <option>Approved</option>
                        <option>Revert</option>
                        <option>Renewal</option>
                    </select>
                </div>
            </div> 
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Business Class <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Option Business Class" onchange="GetSubBusinessClass($(this).val())" id="SelectBusinessClass" name="business_class"> 
                        <option value="">Select Business Class</option>
                    </select>
                </div>
             </div>

             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Sub-Business Class <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Option Sub-Business Class" id="SelectSubBusinessClass" name="businessSubBusinessDTO.id"> 
                        <option value="">Select Sub-Business Class</option>
                    </select>
                </div>
             </div>

             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Policy Type <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Option Policy Type" id="policyType" name="policyType"> 
                        <option value="">Select Policy Type</option>
                        <option value="Open Policy">Open Policy</option>
                        <option value="NA">NA</option>
                    </select>
                </div>
             </div>
             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Underwriting Year <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="underwritingYear" id="underwritingYear" placeholder="Enter Underwriting Year">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Underwriting Quarter <span class="tx-danger">*</span></label>
                    <select class="form-control select2" data-placeholder="Choose Option Underwriting Quarter" id="underwritingQuarter" name="UnderwritingQuarter"> 
                        <option value="">Select Underwriting Quarter</option>
                        <option value="1st">1st</option>
                        <option value="2nd">2nd</option>
                        <option value="3rd">3rd</option>
                        <option value="4th">4th</option>
                    </select>
                </div>
             </div>
             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Geographical/ Territorial Limit <span class="tx-danger">*</span></label>
                     <!-- <input class="form-control" type="text" name="geoTerritorialLimit" id="geoTerritorialLimit" placeholder="Enter Geographical/ Territorial Limit"> -->
                    <select class="form-control select2">
                        <option>Select Geographical/ Territorial Limit</option>
                        <option>In Land Limit</option>
                        <option>Is Retro </option>
                        <option>Retrocession</option>
                    </select>
                </div>
            </div>

             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Company Retention <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="CompanyRetention" id="CompanyRetention" placeholder="Enter Company Retention">
                </div>
            </div>
             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">In Land Limit <span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="inLandLimit" id="inLandLimit" placeholder="Enter In Land Limit">
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Is Retro </label><br>
                     <label class="radio-inline"> <input  type="radio" name="isRetro" id="isRetro_Yes" value="Yes">Yes </label>
                     <label class="radio-inline" style="margin: 5px 11px 0px 0px;"><input type="radio" name="isRetro" id="isRetro_No" value="No" checked >No</label>
                </div>
                 <div class="form-group" style="margin: -70px 0px 0px 0px;float: right;">
                    <a href="#" class="btn btn-success">Retrocession</a>
                </div>
            </div>
            

            <!-- Gross Treaty Share -->
            <div class="col-lg-12">
                <label class="form-control-label">Gross Treaty Share </label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PRC Treaty Share -->
            <div class="col-lg-12">
                <label class="form-control-label">PRC Treaty Share </label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" value=""> Checkbox</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fac RI Abroad -->
            <div class="col-lg-12">
                <label class="form-control-label">Fac RI Abroad </label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>

                    <!-- <div class="col-lg-4">
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" value=""> Checkbox</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Company Retention -->
            <div class="col-lg-12">
                <label class="form-control-label"> Company Retention </label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sum Insurred -->
            <div class="col-lg-12">
                <label class="form-control-label"><input type="checkbox" value=""> Sum Insurred </label>
                <div class="row">
                    <!-- <div class="col-lg-4">
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" value=""> Checkbox</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency(USD)">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Limit Of Liability -->
            <div class="col-lg-12">
                <label class="form-control-label"><input type="checkbox" value=""> Limit Of Liability </label>
                <div class="row">
                    <!-- <div class="col-lg-4">
                        <div class="form-group">
                            <div class="checkbox">
                                <label><input type="checkbox" value=""> Checkbox</label>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter % Of">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency(USD)">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Underwriting Limit -->
             <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3> Underwriting Limit </h3></label>
                </div>
            </div>
            <div class="col-lg-12">
                <label class="form-control-label"> Treaty Capacity </label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency(USD)">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <label class="form-control-label"> Facultative Capacity </label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter %">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency(USD)">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Enter Description"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Conveyance<span class="tx-danger">*</span></label>
                     <input class="form-control" type="text" name="conveyance" id="conveyance" placeholder="Enter Conveyance">
                </div>
            </div>


            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Vessel / Carrier<span class="tx-danger">*</span></label>
                     <!-- <input class="form-control" type="text" name="vesselCarrier" id="vesselCarrier" placeholder="Enter Vessel / Carrier"> -->
                     <select id="vesselCarrier" name="vesselCarrier" class="form-control select2">
                         <option>Select Vessel / Carrier </option>
                         <option value="By Road"> By Road </option>
                         <option value="By Sea"> By Sea </option>
                         <option value="By Air"> By Air </option>
                     </select>
                </div>
            </div>

            <!-- Annual Turnover -->
            <div class="col-lg-12">
                <label class="form-control-label">Annual Turnover <span class="tx-danger">*</span></label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Description" name="facPrcAcceptDesc"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Per Carry Limits -->
            <div class="col-lg-12">
                <label class="form-control-label">Per Carry Limits <span class="tx-danger">*</span></label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Description" name="facPrcAcceptDesc"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Per Transit -->
            <div class="col-lg-12">
                <label class="form-control-label">Per Transit <span class="tx-danger">*</span></label>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Currency">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Amount">
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <label class="form-control-label"> Description </label>
                        <div class="form-group">
                            <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Description" name="facPrcAcceptDesc"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Name Of Vessel -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Name Of Vessel <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Name Of Vessel">
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Description </label>
                    <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Description" name="facPrcAcceptDesc"></textarea>
                </div>
            </div>


            <!-- Voyage Type  -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Voyage Type <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Voyage Type">
                    <!-- <textarea class="form-control" placeholder="Enter Voyage Type"></textarea> -->
                </div>
            </div>

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Description </label>
                    <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Description" name="facPrcAcceptDesc"></textarea>
                </div>
            </div>


             <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Add Co-Insurer</h3></label>
                </div>
            </div>

             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Co-Insurer </label><br>
                     <label class="radio-inline"> <input  type="radio" name="facCoInsurer" id="facCoInsurer_yes" value="Yes">Yes </label>
                     <label class="radio-inline" style="margin: 5px 11px 0px 0px;"><input type="radio" name="facCoInsurer" id="facCoInsurer_no" value="No" checked >No</label>
                </div>
            </div>
             <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Co-Insurer <span class="tx-danger">*</span></label>
                    <select class="form-control select2 SelCedent" data-placeholder="Choose Option Co-Insurer" id="SelectfacCoInsurer" name="facInsurer"> 
                        <option value="">Select Co-Insurer</option>
                    </select>
                </div>
             </div>
             <div class="col-lg-4">
                    <label class="form-control-label">Co-Insurance %<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facInsurerPerc" id="facInsurerPerc" placeholder="Enter Co-Insurance %"> 
                    </div>
              </div>
              <div class="col-lg-4">
                    <label class="form-control-label">Currency<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facInsurerCurrency" id="facInsurerCurrency" placeholder="Enter Currency"> 
                    </div>
              </div>
             <div class="col-lg-4">
                    <label class="form-control-label">PRC Share %<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facPrcSharePerc" id="facPrcSharePerc" placeholder="Enter PRC Share %"> 
                    </div>
              </div>

                <div class="col-lg-4">
                    <label class="form-control-label">PRC Share % Of</label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facPrcSharePercOf" id="facPrcSharePercOf" placeholder="Enter PRC Share % 0f "> 
                    </div>
                </div>
                 <div class="col-lg-4">
                    <label class="form-control-label">PRC Share % Of</label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facPrcSharePercOf2" id="facPrcSharePercOf2" placeholder="Enter PRC Share % 0f "> 
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">PRC Share <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="facPrcShare" id="facPrcShare" placeholder="Enter PRC Share">
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="form-group">
                        <a  href="javascript:void(0)" style="margin: 0px 10px 10px 10px;" class='btn btn-success pull-right'>Add </a>
                    </div>
                </div>

                <div class="col-lg-12">
                   <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>S#</th>
                                    <th>Co-Insurer</th>
                                    <th>Co-Insurance %</th>
                                    <th>Currency</th>
                                    <th>PRC Share % </th>
                                    <th>PRC Share % Of </th>
                                    <th>PRC Share</th>
                                </tr>
                            </thead>
                            <tbody class="table_tbody_Deductibles" id='AppendAbleDeductiblesTr'>
                            <tr>
                                <td>1</td> 
                                <td><input class="form-control" type="text" name="facDeductCurrency1" id="facDeductCurrency1" placeholder="Co-Insurer"></td> 
                                <td><input class="form-control" type="text" name="facDeductCurrency1" id="facDeductCurrency1" placeholder="Co-Insurance %"> </td> 
                                <td><input class="form-control" type="text" name="facDeductAmount1" id="facDeductAmount1" placeholder="Enter Currency"> </td> 
                                <td><input class="form-control" type="text" name="facDeductNoDays1" id="facDeductNoDays1" placeholder="Enter PRC Share %"></td> 
                                <td><input class="form-control" type="text" name="facDeductPerc1" id="facDeductPerc1" placeholder="Enter PRC Share % Of"> </td> 
                                <td><input class="form-control" type="text" name="facDeductDesc1" id="facDeductDesc1" placeholder="Enter PRC Share"> </td> 
                            </tr>  

                            </tbody> 
                        </table>
                    </div>
                </div>  
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label"><h3>Business Offered & Acceptance </h3></label>
                    </div>
                </div>
                 <div class="col-lg-4">
                    <label class="form-control-label">PRCL Acceptance %</label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facPrcAcceptPerc" id="facPrcAcceptPerc" placeholder="Enter PRCL Acceptance %"> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Of % Offered </label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facPrcAcceptPercOffPerc" id="facPrcAcceptPercOffPerc" placeholder="Enter Of % Offered"> 
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Of %</label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facRate" id="facRate" placeholder="Enter Of %"> 
                    </div>
                </div>     
             <div class="col-lg-4">
                    <label class="form-control-label">% Acceptance<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facPrcAcceptCurrency" id="facPrcAcceptCurrency" placeholder="Enter % Acceptance"> 
                    </div>
              </div> 
                <div class="col-lg-4">
                    <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facGrossPremium" id="facGrossPremium" placeholder="Enter Currency"> 
                    </div>
              </div>    
               <div class="col-lg-4">
                    <label class="form-control-label">PRC Share Amount <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facPrcShareAmount" id="facPrcShareAmount" placeholder="Enter PRC Share Amount"> 
                    </div>
              </div>

            <div class="col-lg-12">
                <label class="form-control-label">Description</label>
                <div class="form-group">
                    <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Description" name="facPrcAcceptDesc"></textarea>
                </div>
            </div>  

            <div class="col-lg-4">
                <label class="form-control-label">RI Premium Rate/Value <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facPrcShareAmount" id="facPrcShareAmount" placeholder="Enter RI Premium Rate/Value"> 
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">Per Milli /Percent <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facPrcShareAmount" id="facPrcShareAmount" placeholder="Enter Per Milli /Percent"> 
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">Rate <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facPrcShareAmount" id="facPrcShareAmount" placeholder="Enter Rate"> 
                </div>
            </div>
            <!-- <div class="col-lg-4">
                <label class="form-control-label"> Gross Premium 100% <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facPrcShareAmount" id="facPrcShareAmount" placeholder="Enter Rate"> 
                </div>
            </div> -->
            <div class="col-lg-4">
                <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facPrcShareAmount" id="facPrcShareAmount" placeholder="Enter Currency"> 
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">Gross Premium 100% <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facPrcShareAmount" id="facPrcShareAmount" placeholder="Enter Gross Premium 100% "> 
                </div>
            </div>
            <!-- <div class="col-lg-4">
                <label class="form-control-label">PRC Gross Premium <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facPrcShareAmount" id="facPrcShareAmount" placeholder="Enter PRC Gross Premium"> 
                </div>
            </div> -->

            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Description</label>
                    <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Description" name="facPrcAcceptDesc"></textarea>
                </div>
            </div>  

            <!-- RI Commission  % -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>RI Commission  %</h3></label>
                </div>
            </div>
             <div class="col-lg-4">
                    <label class="form-control-label">Demanded %<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facCommisionDemand" id="facCommisionDemand" placeholder="Enter Demanded %"> 
                    </div>
              </div>  
              <div class="col-lg-4">
                    <label class="form-control-label">Accepted %<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facCommissionAccepted" id="facCommissionAccepted" placeholder="Enter Accepted %"> 
                    </div>
              </div>  
               <div class="col-lg-4">
                    <label class="form-control-label">Currency<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facCommissionCurrency" id="facCommissionCurrency" placeholder="Enter Currency"> 
                    </div>
              </div> 
               <div class="col-lg-4">
                    <label class="form-control-label">RI Commission <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input class="form-control" type="text" name="facCommissionPrcComm" id="facCommissionPrcComm" placeholder="Enter RI Commission "> 
                    </div>
              </div>


            <!-- Loss Limit -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Loss Limit</h3></label>
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">Occurance Type <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facCommisionDemand" id="facCommisionDemand" placeholder="Enter Occurance Type "> 
                </div>
            </div>  
            <div class="col-lg-4">
                <label class="form-control-label">Currency USD<span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facCommissionAccepted" id="facCommissionAccepted" placeholder="Enter Currency USD"> 
                </div>
            </div>  
            <div class="col-lg-4">
                <label class="form-control-label">Forex <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facCommissionCurrency" id="facCommissionCurrency" placeholder="Enter Forex "> 
                </div>
            </div> 
            <div class="col-lg-4">
                <label class="form-control-label">Currency PKR <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facCommissionPrcComm" id="facCommissionPrcComm" placeholder="Enter Currency PKR"> 
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">Event<span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facCommissionCurrency" id="facCommissionCurrency" placeholder="Enter Event"> 
                </div>
            </div> 
            <!-- <div class="col-lg-4">
                <label class="form-control-label">RI Commission <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="facCommissionPrcComm" id="facCommissionPrcComm" placeholder="Enter RI Commission "> 
                </div>
            </div> -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Description</label>
                    <textarea class="form-control" id="facPrcAcceptDesc" placeholder="Enter Description" name="facPrcAcceptDesc"></textarea>
                </div>
            </div>

            <!-- Deductibles -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Deductibles</h3></label>
                </div>
            </div>

            <div class="col-lg-12">
                   <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">

                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Deductibles</th>
                                <th>Currency</th>
                                <!-- <th>Amount</th> -->
                                <th>No. Of Days </th>
                                <th>Percentage</th>
                                <th>Value</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody class="table_tbody_Deductibles" id='AppendAbleDeductiblesTr'>
                        <tr>
                            <td>1</td> 
                            <td>
                            <select class="form-control select2" data-placeholder="Choose Option Deductible" id="facDeductables_1" name="facDeductables_1">
                                <option value="">Select Deductible</option>
                                <?php
                                    if(isset($Deductibles))
                                    {
                                        foreach ($Deductibles as $key => $objDeductibles)
                                        {
                                            print("<option value='".$objDeductibles->id."'>".$objDeductibles->deductables."</option>");
                                        }
                                    }

                                    ?>
                            </select></td> 
                            <td><input class="form-control" type="text" name="facDeductCurrency1" id="facDeductCurrency1" value="PKR" placeholder="Currency"> </td> 
                            <!-- <td><input class="form-control" type="text" name="facDeductAmount1" id="facDeductAmount1" value="3000" placeholder="Enter Amount"> </td>  -->
                            <td><input class="form-control" type="text" name="facDeductNoDays1" id="facDeductNoDays1" value="6" placeholder="Enter No. Of Days"></td> 
                            <td><input class="form-control" type="text" name="facDeductPerc1" id="facDeductPerc1" value="50%" placeholder="Enter Percentage"> </td> 
                            <td><input class="form-control" type="text" name="facDeductPerc1" id="facDeductPerc1" value="122" placeholder="Enter Value"> </td> 
                            <td><input class="form-control" type="text" name="facDeductDesc1" id="facDeductDesc1" value="Test" placeholder="Enter Description"> </td> 
                        </tr>  

                        </tbody> 
                    </table>
                     <a href="javascript:void(0)" style="margin: 0px 10px 10px 10px;" class='btn btn-success pull-right' onclick='AddMoreDeductible();'>Add More</a>
                </div>
            </div>  
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Premium Payment Plan </h3></label>
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">Percentage  <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="Percentage" id="Percentage" placeholder="Enter Percentage"> 
                </div>
            </div> 
<!--             <div class="col-lg-4">
                <label class="form-control-label">Premium  <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="Premium" id="Premium" placeholder="Enter Premium"> 
                </div>
            </div> 
            <div class="col-lg-4">
                <label class="form-control-label">Adjusted premium  <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="AdjustedPremium" id="AdjustedPremium" placeholder="Enter Adjusted premium"> 
                </div>
            </div>  -->
            <div class="col-lg-4">
                <label class="form-control-label">No. of Installment(s)<span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="NoofInstallment" id="NoofInstallment" placeholder="Enter No. of Installment(s)"> 
                </div>
            </div>
            <div class="col-lg-12">
                <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>S#</th>
                                <th>Installment Amount </th>
                                <th>Premium Due Date</th>
                                <th>Premium Received</th> 
                            </tr>
                        </thead>
                        <tbody class="table_tbody_PremiumPaymentPlan">
                        <tr>
                            <td>1</td> 
                            <td><input class="form-control" type="text" name="InstallmentAmount1" id="InstallmentAmount1" value="7823"> </td> 
                            <td><input class="form-control" type="text" class="fc-datepicker" name="PremiumDueDate1" id="PremiumDueDate1" value="02-10-2021"> </td> 
                            <td><input class="form-control" type="text" name="PremiumReceived1" id="PremiumReceived1" value="7823"> </td> 
                        </tr> 
                         <tr>
                           <td colspan="7"><button class="btn btn-success" style="float: right;">add more</button></td> 
                        </tr> 

                        </tbody> 
                    </table>
                </div>
            </div>


            <!-- Outstanding  -->
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Outstanding <span class="tx-danger">*</span></label>
                    <input class="form-control" type="text" name="annualTurnover" id="annualTurnover" placeholder="Enter Outstanding">
                </div>
            </div>

<!--             <div class="col-lg-4">
                <label class="form-control-label">Adjusted premium  <span class="tx-danger">*</span></label>
                <div class="form-group input-group">
                    <input class="form-control" type="text" name="AdjustedPremium" id="AdjustedPremium" placeholder="Enter Adjusted premium"> 
                </div>
            </div> -->


            <div class="col-lg-12">
                <div class="form-group">
                    <div class="form-group"> 
                         <input type="hidden" id="MNDP_layerRows" name="MNDP_layerRows" value="">
                         <input type="hidden" name="hiddenFacultativeNoteId" class="hiddenFacultativeNoteId" value="<?php print(isset($facultativeNoteId) ? $facultativeNoteId:'');?>">
                        <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 " style="margin: 10px;float: right;" name="requestNotInfo_Btn" id="requestNotInfo_Btn" value="Add">
                    </div>

                </div>
            </div>
        </div>
        </form>
       
    </div> 

</section>
 