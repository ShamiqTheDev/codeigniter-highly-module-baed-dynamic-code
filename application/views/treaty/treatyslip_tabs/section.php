<h3>PROPORTIONAL</h3>
<section>
    <div class="modal fade bd-example-modal-lg" id="SectionClassModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="br-section-wrapper mg-t-20">
                    <h3></h3>
                    <form id="treaty_section_classForm" method="post" action="<?php echo current_url(); ?>">

                    <div class="form-group">
                        <div class="row">
<!--                            <div class="col-lg-4">-->
<!--                                <div class="form-group">-->
<!--                                    <label class="form-control-label">Section Name <span class="tx-danger">*</span></label>-->
<!--                                    <input class="form-control" type="text" name="sectionName" id="sectionName">-->
<!--                                </div>-->
<!--                            </div>-->



                            <!-- <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Class Name<span class="tx-danger">*</span></label><br>
                                    <input class="form-control" type="text" name="className" id="className" placeholder="Enter Class Name">
                                </div>
                            </div> -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Business Class </label><br>
                                    <select class="form-control"  id="sectionClass_business_class" name="sectionClass_business_class">

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
                                    <label class="form-control-label">Treaty Type </label><br>
                                    <select class="form-control">
                                        <option value="">Select Treaty Type</option>
                                        <?php
                                        if (isset($Treaty_type)) {
                                            foreach ($Treaty_type as $key => $tType) {

                                                if (!empty($tType->type))
                                                {
                                                    if(isset($Treaty)) {
                                                        if(isset($Treaty->treatyStatisticsDTO->treatyTypeDTO->id)
                                                            && $Treaty->treatyStatisticsDTO->treatyTypeDTO->id == $tType->id) {
                                                            $selected = 'selected';
                                                            $readonly = ' readonly ';
                                                        }
                                                    }

                                                    print("<option value='".$tType->id."' ".$selected.$readonly.">".$tType->type."</option>");
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Treaty Sub Types </label><br>
                                    <select class="form-control" id="sectionClass_treatySubTypes" name="sectionClass_treatySubTypes">
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
                                    <label class="form-control-label">Co MAX Retention<span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="corManRefention" id="corManRefention" placeholder="Enter Co MAX Retention">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Treaty Limit <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="treatyLimit" id="treatyLimit_field" placeholder="Enter Treaty Limit">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">PRC Share % <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="prcShare" id="SectionClass_prcShare" placeholder="Enter PRC Share %">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <label class="form-control-label">PRC'S Max Liability <span class="tx-danger">*</span></label>
                                <div class="form-group input-group">
                                    <input style="" class="form-control" type="text" name="prcMaxLiability"  id="prcMaxLiability_field" placeholder="Enter PRC'S Max Liability">&nbsp;
                                    <button id="prcmaxliability_sectionBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <table style="margin: -18px 100px 10px 0px;float: right;">
                                    <tr>
                                        <td><span class="prcMaxLiabilityError" ></span></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Comm % <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="classCommission" id="classCommission" placeholder="Enter Comm %">
                                </div>
                            </div>

                             
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Profit Commission <span class="tx-danger">*</span></label>
                                    <textarea class="form-control" maxlength='400'  name="pc" id="pc" placeholder="Enter Profit Commission"></textarea>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">L.C.F <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="lcf" id="lcf" placeholder="Enter L.C.F">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">M.E % <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="me" id="me" placeholder="Enter M.E. %">
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Loss Advice <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="locAdvice" id="locAdvice" placeholder="Enter Loss Advice">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Cash Loss 100% <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="cashLoss" id="cashLoss" placeholder="Enter Cash Loss 100%">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Port Premium% <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="portPremium" id="portPremium" placeholder="Enter Port Premium">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Port Loss% <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="portLoss" id="portLoss" placeholder="Enter Port Loss">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">EPI 100% <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="epi"  id="SectionClass_epi_field" placeholder="Enter EPI 100%">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">EPI Revised  </label>
                                    <input class="form-control" type="text" name="epiReviesd"  id="SectionClass_EPI_Revised" placeholder="Enter EPI Revised">
                                </div>
                            </div>

                             <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">EPI Estimated  </label>
                                    <input class="form-control" type="text" name="epiEstimated"  id="SectionClass_EPI_Estimated" placeholder="Enter EPI Estimated">
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <label class="form-control-label">EPI PRC<span class="tx-danger">*</span></label>
                                <div class="form-group input-group">
                                    <input style="" class="form-control epi_prc_section" type="text" name="epiPrc" id="SectionClass_epiPrc_field" placeholder="Enter EPI PRC">&nbsp;
                                    <button id="SectionClass_epiPrc_fieldBtn"type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 epi_prc">Calculate</button>
                                </div>
                            </div>




                            <div class="col-lg-12">
                                <div class="form-group">
                                    <input type="hidden" value="" name="treatySectionId_sectionClass" id="treatySectionId_sectionClass">
                                    <input type="hidden" value="" name="sectionClassId" id="sectionClassId">
                                    <input type="submit"  style="float: right;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 table_btn_re_section" name="treatyslip_section_class" id="treatyslip_section_classBtn" value="Add">

                                </div>
                            </div>
                        </div>


                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="br-section-wrapper mg-b-25">
        <br>
        <form id="treaty_section_form" method="post" action="<?php echo current_url(); ?>">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Section Name <span class="tx-danger">*</span></label>
                    <!-- <input class="form-control" type="text" name="sectionName" id="sectionName" value="" placeholder="Enter Section Name" onkeypress="return (event.charCode > 60 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)" > -->
                    <input class="form-control" type="text" name="sectionName" id="sectionName" value="" placeholder="Enter Section Name"   >
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                    <select class="form-control" id="section_currency1" name="section_currency1" readonly disabled>
                        <option value="">Select Currency</option>
                        <?php
                        if(isset($Currency))
                        {
                            foreach ($Currency as $key => $objCurrency)
                            {
                                $selected ='';
                                if(isset($Treaty))
                                {
                                    if($Treaty->currencyCode == $objCurrency->id) {
                                        $selected = 'selected';
                                    }
                                }
                                print("<option value='".$objCurrency->code."' ".$selected.">".$objCurrency->country." (".$objCurrency->code.")</option>");
                            }
                        }

                        ?>
                    </select>
                </div>
            </div>



            <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Treaty Sub Types <span class="tx-danger">*</span></label><br>
                        <select class="form-control select2"   data-placeholder="Choose Option Treaty Sub Types" required id="section_treatySubTypes" name="sectiontreatySubTypes[]" multiple>
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
                    <label class="form-control-label">Business Class <span class="tx-danger">*</span></label><br>
                    <select class="form-control select2 business_class" required data-placeholder="Choose Option Business Class" id="section_business_class1" name="section_business_class[]" multiple>

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

                

               
                            
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label"><h3>Treaty Sub Limit</h3></label>
                </div>
            </div> 
                    
                    
                <div class="col-lg-4">
                    <label class="form-control-label">Treaty Sub Limit  </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="treatySubLimit" id="treatySubLimit" maxlength="100" placeholder="Enter Treaty Sub Limit">&nbsp;&nbsp;
                    </div>
                </div>
               
                <div class="col-lg-4">
                    <label class="form-control-label">PRC Share Rate  </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="section_prcShareRate" id="section_prcShareRate" maxlength="100" placeholder="Enter PRC Share Rate ">&nbsp;&nbsp;
                    </div>
                </div>

              <div class="col-lg-4">
                    <label class="form-control-label">PRC Share Value </label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="section_prcShareValue" id="section_prcShareValue" placeholder="Enter PRC Share Value">&nbsp;
                        <button  id="section_prcShareValueBtn" name="section_prcShareValue" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label">Description </label>
                        <textarea   class="form-control"  name="descriptionTreatySubLimit" id="descriptionTreatySubLimit" placeholder="Enter Description"></textarea>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label"><h3>Quota Share</h3></label>
                    </div>
                </div>
                <!-- <div class="col-lg-4">
                    <label class="form-control-label">Premium Rate  </label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="premiumRate" id="premiumRate" value="" placeholder="Enter Premium Rate">&nbsp;&nbsp;
                    </div>
                </div> -->
                <!-- <div class="col-lg-4">
                    <label class="form-control-label">Rate  </label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="rate1" id="rate_section_quota" value="" placeholder="Enter Rate">&nbsp;&nbsp;
                    </div>
                </div> -->
                <!-- <div class="col-lg-4">
                    <label class="form-control-label">Value  </label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="value1" id="value_section_quota" value="" placeholder="Enter Value">&nbsp;&nbsp;
                    </div>
                </div> -->
                <!-- <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">PRC Share %  </label>
                        <input   class="form-control decimal-numbers" type="text" name="prclSharePercentage1" id="prcShare_percentage_quota" placeholder="Enter PRC Share %">
                    </div>
                </div> -->
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">PRC Share Rate  </label>
                        <input   class="form-control decimal-numbers" type="text" name="section_prcShareRateQuota" id="section_prcShareRateQuota" placeholder="Enter PRC Share Rate">
                    </div>
                </div>
                <!-- <div class="col-lg-4">
                    <label class="form-control-label">PRCL Share </label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="prclShare1" id="PRCLShare_section_quota" placeholder="Enter PRCL Share">&nbsp;
                        <button  id="PRCLShare_section_quotaBtn" name="PRCLShare_section_quotaBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                    </div>
                </div> -->
                <div class="col-lg-4">
                    <label class="form-control-label">Gross Retention  </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="section_grossRetentionQuota" id="section_grossRetentionQuota" onchange="qsCalcQuotaCompRet();" maxlength="100" placeholder="Enter Gross Retention">&nbsp;&nbsp;
                    </div>
                </div>

                    <div class="col-lg-6">
                        <label class="form-control-label">Company Max. Retention(%) <span class="tx-danger">*</span></label>
                        <div class="form-group input-group">
                            <input style="" class="form-control" type="text" name="quotaCompanyRetention" id="quotaCompanyRetention" onchange="qsCalcQuotaCompRet();" placeholder="Enter Company Max. Retention(%)">&nbsp;&nbsp;

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <label class="form-control-label">&nbsp;Company Max. Retention <span class="tx-danger">*</span></label>
                        <div class="form-group input-group">
                            <input style="" class="form-control" type="text" name="quotaCompanyRetentionOf" id="quotaCompanyRetentionOf" value="" placeholder="Enter Company Max. Retention">&nbsp;&nbsp;
                            <span style="line-height: 38.6px;">%</span> &nbsp


                        </div>
                    </div>

                    <div class="col-sm-12">
                            <table width="100%" style="margin: -15px 0px 0px 0px;">
                                <tr>
                                    <td><span class="quotaCompanyRetentionError" ></span></td>
                                    <td><div style="margin: 0px 0px 0px -15px;"><span class="quotaCompanyRetentionOfError" ></span></div></td>
                                </tr>
                            </table>
                    </div>

            <div class="col-lg-12"></div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Re-Insurance Commission Rate % <span class="tx-danger">*</span></label>
                        <input required class="form-control" type="text" name="reinsuranceCommissionRateQouta" id="reinsuranceCommissionRateQouta" placeholder="Enter RI Rate">
                    </div>
                </div>

                <div class="col-lg-4">
                    <label class="form-control-label">Ceded share rate </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="cededShareRate" id="cededShareRate" maxlength="100" 
                        onchange="qsReInsLiab();" placeholder="Enter Ceded Share Rate">&nbsp;&nbsp;
                    </div>
                </div>

                <div class="col-lg-4">
                    <label class="form-control-label">Re-Insurer Liability </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="section_reInsurerLiability" id="section_reInsurerLiability" maxlength="100" placeholder="Enter Re-Insurer Liability">&nbsp;&nbsp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Re-Insurer Liability PRC Share <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input  required class="form-control" type="text" name="section_reInsurerLiabilityPrcShare" id="section_reInsurerLiabilityPrcShare" placeholder="Enter Re-Insurer Liability PRC Share">&nbsp;
                        <button  id="reInsurerLiabilityPrcShareBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                    </div>
                </div>
            <div class="col-sm-12">
                <table style="margin: -45px 166px 0px 0px;float: right;text-align: right;">
                    <tr>
                        <td><span class="section_reInsurerLiabilityPrcShareError" ></span></td>
                    </tr>
                </table>
            </div>
                <div class="col-lg-4">
                    <label class="form-control-label">MPL % </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="section_mplQuota" id="section_mplQuota" maxlength="100" placeholder="Enter MPL ">&nbsp;&nbsp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">MPL ERROR % </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="section_mplErrorQuota" id="section_mplErrorQuota" maxlength="100" placeholder="Enter MPL ERROR %">&nbsp;&nbsp;
                    </div>
                </div>
               
                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label">Description </label>
                        <textarea   class="form-control"  name="description1" id="section_quata_Description" placeholder="Enter Description"></textarea>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="form-group">
                        <label class="form-control-label"><h3>Surplus Line</h3></label>
                    </div>
                </div>
                <!-- <div class="col-lg-4">
                    <label class="form-control-label">Rate  </label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="rate2" id="rate_section_surplus" value="" placeholder="Enter Rate">&nbsp;&nbsp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Value  </label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="value2" id="value_section_surplus" value="" placeholder="Enter Value">&nbsp;&nbsp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">PRC Share %  </label>
                        <input   class="form-control decimal-numbers" type="text" name="prclSharePercentage2" id="prcShare_percentage_surplus" placeholder="Enter PRC Share %">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">PRCL Share </label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="prclShare2" id="PRCLShare_section_surplus" placeholder="Enter PRCL Share">&nbsp;
                        <button  id="PRCLShare_section_surplusBtn" name="PRCLShare_section_surplusBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                    </div>
                </div> -->

                <div class="col-lg-4">
                    <label class="form-control-label">Quota Share Commission (%)<span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="surplusQuotaShareCommission" id="surplusQuotaShareCommission" placeholder="Enter Quota Share Commission">&nbsp;&nbsp;
                        <span style="line-height: 38.6px;"></span> &nbsp


                    </div>
                </div>

                <div class="col-lg-4">
                    <label class="form-control-label">&nbsp;</label>
                    <div class="form-group input-group">
                        <input style="" class="form-control" type="text" name="surplusQuotaShareCommissionOf" id="surplusQuotaShareCommissionOf" placeholder="Enter Quota Share Commission Of">&nbsp;&nbsp;
                        <span style="line-height: 38.6px;"></span> &nbsp


                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Company Retention <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="surplusCompanyRetention" id="surplusCompanyRetention" value="" placeholder="Enter Company Retention">
                    </div>
                </div>
                <div class="col-sm-12">
                    <table width="100%" style="margin: -43px 0px 0px 0px;">
                        <tr>
                            <td><span class="surplusQuotaShareCommissionError" ></span></td>
                            <td><div style="margin: 0px 116px 0px 0px;"><span class="surplusQuotaShareCommissionOfError" ></span></div></td>
                        </tr>
                    </table>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Surplus Cessions <span class="tx-danger">*</span></label>
                        <input class="form-control" type="text" name="surplusCession" id="surplusCession" value="" placeholder="Enter Surplus Cessions">
                    </div>
                </div>
 
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Re-Insurance Commission Rate % <span class="tx-danger">*</span></label>
                        <input required class="form-control" type="text" name="reinsuranceCommissionRateSurplus" id="reinsuranceCommissionRateSurplus" placeholder="Enter RI Rate">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label class="form-control-label">Premium <span class="tx-danger">*</span></label>
                        <input required class="form-control" type="text" name="premium" id="premium" placeholder="Enter Premium">
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Re-Insurance commission <span class="tx-danger">*</span></label>
                    <div class="form-group input-group">
                        <input  required class="form-control" type="text" name="riCommission" id="riCommission" placeholder="Enter Re-Insurance commission">&nbsp;
                        <button  id="riCommissionBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                    </div>
                </div>
            <div class="col-sm-12">
                <table style="margin: -17px 0px 0px 0px;">
                    <tr>
                        <td><span class="riCommissionError" ></span></td>
                    </tr>
                </table>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Description <span class="tx-danger">*</span></label>
                    <textarea required class="form-control"  name="description2" id="section_surplus_Description" placeholder="Enter Description"></textarea>
                </div>
            </div>

            <div class="col-lg-4">
                <label class="form-control-label">Profit Commission  </label>
                <div class="form-group input-group">
                    <input  class="form-control" type="text" name="profitCommission_section" id="profitCommission_section" maxlength="500" placeholder="Enter Profit Commission">&nbsp;&nbsp;
                </div>
            </div>

            <div class="col-lg-4">
                <label class="form-control-label">Gross Retention  </label>
                <div class="form-group input-group">
                    <input  class="form-control section_grossRetentionSurplus" type="text" name="section_grossRetentionSurplus" id="section_grossRetentionSurplus" maxlength="100" placeholder="Enter Gross Retention">&nbsp;&nbsp;
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">Original Gross rate </label>
                <div class="form-group input-group">
                    <input  class="form-control" type="text" name="section_originalGrossRateSurplus" id="section_originalGrossRateSurplus" maxlength="100" placeholder="Enter Original Gross rate">&nbsp;&nbsp;
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">No. of Lines   </label>
                <div class="form-group input-group">
                    <input  class="form-control section_noOfLines" type="text" name="section_noOfLines" id="section_noOfLines" maxlength="100" placeholder="Enter No. of Lines ">&nbsp;&nbsp;
                </div>
            </div>
            <div class="col-lg-4">
                <label class="form-control-label">Profit Commission Rate </label>
                <div class="form-group input-group">
                    <input  class="form-control" type="text" name="section_profitCommissionRate" id="section_profitCommissionRate" maxlength="100" placeholder="Enter Profit Commission Rate">&nbsp;&nbsp;
                </div>
            </div>
            <!-- <div class="col-lg-4">
                <label class="form-control-label">Management Expensed</label>
                <div class="form-group input-group">
                    <input  class="form-control" type="text" name="section_managementExpensed" id="section_managementExpensed" maxlength="100" placeholder="Enter Management Expensed">&nbsp;&nbsp;
                </div>
            </div>  -->
            <div class="col-lg-12">
                <div class="form-group">
                    <label class="form-control-label">Losses Carry Forward  <span class="tx-danger">*</span></label>
                    <textarea required class="form-control"  name="section_lossesCarryForward" id="section_lossesCarryForward" placeholder="Enter Losses Carry Forward"></textarea>
                </div>
            </div>
            <div class="col-lg-4">
                    <label class="form-control-label">MPL % </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="section_mplSurplus" id="section_mplSurplus" maxlength="100" placeholder="Enter MPL %">&nbsp;&nbsp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">MPL ERROR % </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="section_mplErrorSurplus" id="section_mplErrorSurplus" maxlength="100" placeholder="Enter MPL ERROR %">&nbsp;&nbsp;
                    </div>
                </div>
                <div class="col-lg-4">
                    <label class="form-control-label">Surplus Limit </label>
                    <div class="form-group input-group">
                        <input  class="form-control" type="text" name="surplusLimit" id="surplusLimit" placeholder="Enter Surplus Limit">&nbsp;
                        <button  id="SurplusLimitBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
                    </div>
                </div>
            <div class="col-lg-12">
                    <div class="form-group">
                        <div class="form-group">

                            <input type="hidden" name="treatySlipGeneralId" class="HiddentreatySlipGeneralId" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->id:'');?>">
                            <input type="hidden" id="treatySlipSectionId" name="treatySlipSectionId" value="">
                            <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 table_btn_section " style="margin: 10px;float: right;" name="treatyslip_section" id="treatyslip_sectionBtn" value="Add">
                        </div>

                    </div>
                </div>
        </div>
        </form>
        <h3>Section Details</h3>

        <div class="br-section-wrapper mg-t-20">

            <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">
                <table class="table table-striped table-bordered th_width">
                    <thead>
                    <tr>
                        <th colspan="4"><center>Details</center></th>
                        <th colspan="4"><center>Treaty Sub Limit</center></th>
                        <th colspan="11"><center>Quota Share</center></th>
                        <th colspan="18"><center>Surplus Line</center></th>
                        <th colspan="3"></th>
                    </tr>
                    <tr>
                        <th>Section Name</th>
                        <th>Currency</th>
                        <th>Treaty Sub Types</th>
                        <th>Business Class</th>

                        <th>Treaty Sub Limit</th>
                        <th>PRC Share Rate</th>
                        <th>PRC Share Value</th>
                        <th>Description</th>

                        <th>PRC Share Rate</th>
                        <th>Gross Retention</th>
                        <th>Company Retention (%)</th>
                        <th>Company Retention</th>
                        <th>Re-Insurance Commission Rate %</th>
                        <th>Ceded share rate</th>
                        <th>Re-Insurer Liability</th>
                        <th>Re-Insurer Liability PRC Share</th>
                        <th>MPL %</th>
                        <th>MPL ERROR %</th>
                        <th>Description</th>


                        <th>Quota Share Commission (%)</th>
                        <th>Quota Share Commission Of</th>
                        <th>Company Retention</th>
                        <th>Surplus Cessions</th>
                        <th>Re-Insurance Commission Rate %</th>
                        <th>Premium</th>
                        <th>Re-Insurance Commission</th>
                        <th>Description</th>
                        <th>Profit Commission</th>
                        <th>Gross Retention</th>
                        <th>Original Gross Rate</th>
                        <th>No. of Lines</th>
                        <th>Profit Commission Rate</th>
                        <th>Losses Carry Forward</th>
                        <th>MPL %</th>
                        <th>MPL ERROR %</th>
                        <th>Surplus Limit</th>

                        <th colspan="2">Action</th>
                        <th>Classes</th>
                    </tr>
                    </thead>
                    <tbody class="table_tbody_section">


                    </tbody>

                </table>




            </div>
        </div>


        <br>
        <h3>Class Of Risk</h3>

        <div class="br-section-wrapper mg-t-20">

            <div class="table-wrapper1 table-responsive1" style="overflow-x: scroll;">

                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Section Name</th>
                        <th>Co MAX Retention</th>
                        <th>Treaty Limit</th>
                        <th>PRC Share %</th>
                        <th>PRC'S Max Liability</th>
                        <th>COMM. %</th>
                        <th>P.C. %</th>
                        <th>L.C.F </th>
                        <th>M.E. %</th>
                        <th>Loss Advice</th>
                        <th>Cash Loss 100%</th>
                        <th>Port Premium</th>
                        <th>Port Loss</th>
                        <th>EPI 100%</th>
                        <th>EPI PRC</th>
                        <th colspan="2">Action</th>

                    </tr>
                    </thead>
                    <tbody class="table_tbody_re_section">


                    </tbody>
                </table>




            </div>
        </div>
    </div>
    <!--   28-02-2020 END ---->

</section>

<script>


    var business_String = [<?php echo $business_String;?>];
    var section_business_class1 = document.getElementById('section_business_class1');
    for (var i = 0; i < section_business_class1.options.length; i++) {
        section_business_class1.options[i].selected = business_String.indexOf(section_business_class1.options[i].value) >= 0;
    } 
    
</script>
