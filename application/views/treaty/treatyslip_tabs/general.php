<h3>General</h3>
<section>
    <form id="TreatySlipForm" method="post" action="<?php echo current_url(); ?>">
        <input type="hidden" value="" name="TreatyTab" id="TreatyTab">

    <div class="row mg-b-25">
        
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Treaty Status <span class="tx-danger">*</span></label>
                <!-- <input class="form-control NonFinancial" type="text" id="treatyStatus" placeholder="Enter Agreement No" name="treatyStatus" value="<?=isset($Treaty->agreementDTO) ? $Treaty->agreementDTO->agreementNumber:'';?>"  readonly> -->

                <select class="form-control NonFinancial" id="treatyStatus" name="treatyStatus" readonly>
                    <?php foreach ($treatyStatusOptions as $k => $v) { ?>
                        <option value="<?=$k?>"><?=$v?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Agreement No <span class="tx-danger">*</span></label>
                <input class="form-control NonFinancial" type="text" id="treater_agreementNumber" placeholder="Enter Agreement No" name="treater_agreementNumber" value="<?php print(isset($Treaty->agreementDTO) ? $Treaty->agreementDTO->agreementNumber:'');?>"  readonly>
            </div>
        </div>

<!--        <div class="col-lg-4">-->
<!--            <div class="form-group">-->
<!--                <label class="form-control-label">Treaty No <span class="tx-danger">*</span></label>-->
<!--                <input class="form-control NonFinancial" type="text" id="treatier_code" name="treatier_code" placeholder="Enter Treaty No" value="--><?php //print(isset($Treaty) ? $Treaty->treatierCode:'');?><!--" readonly>-->
<!--            </div>-->
<!--        </div>-->


        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Treaty Name <span class="tx-danger">*</span></label>
                <input class="form-control NonFinancial"  type="text" id="treater_name" name="treater_name" placeholder="Enter Treaty Name" value="<?php print(isset($Treaty->name)?$Treaty->name:'');?>" readonly >
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Cedent<span class="tx-danger">*</span></label>
                <select class="form-control select2 NonFinancial" data-placeholder="Choose Option" id="cedent_id" name="cedent_id" readonly>
                    <option value="">Select Cedent</option>
                    <?php
                    if(isset($Cedent))
                    {
                        foreach ($Cedent as $key => $objCedent)
                        {
                            $selected ='';
                            if(isset($Treater_details))
                            {

                                if($Treater_details->treatyStatisticsDTO->cedentDTO->id == $objCedent->id) {
                                    $selected = 'selected';
                                }
                            }
                            print("<option value='".$objCedent->id."' ".$selected.">".$objCedent->customerName."</option>");
                        }
                    }

                    ?>
                </select>
            </div>
        </div>




        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">UW/Inception Year <span class="tx-danger">*</span></label>
                <input class="form-control NonFinancial" type="text" name="uwInceptionYear" id="uwInceptionYear" placeholder="Enter UW/Inception Year" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->uwInceptionYear:'');?>">
            </div>
        </div>


        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Business Class <span class="tx-danger">*</span></label>

                <select class="form-control select2 NonFinancial business_class" data-placeholder="Choose Option Business Class" id="business_class" name="business_class[]" multiple>

                    <?php
                    if(isset($Business_class)) {
                        foreach ($Business_class as $key => $objBusiness_class) {
                            print("<option value='".$objBusiness_class->id."' >".$objBusiness_class->name."</option>");
                        }
                    }

                    ?>
                </select>
            </div>
        </div>
        <?php //debug($Treaty->treatyStatisticsDTO); ?>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Treaty Type <span class="tx-danger">*</span></label>
                <select class="form-control select2 NonFinancial" data-placeholder="Choose Option" id="treaty_type" name="treaty_type">
                    <option value="">Select Treaty Type</option>
                    <?php
                    if(isset($Treaty_type)) {
                        foreach ($Treaty_type as $key => $objTreaty_type) {
                            $selected=$readonly='';
                            if(isset($Treaty)) {
                                if(isset($Treaty->treatyStatisticsDTO->treatyTypeDTO->id) 
                                    && $Treaty->treatyStatisticsDTO->treatyTypeDTO->id == $objTreaty_type->id) {
                                    $selected = 'selected';
                                    $readonly = ' readonly ';
                                }
                            }
                            print("<option value='".$objTreaty_type->id."' ".$selected.$readonly.">".$objTreaty_type->type."</option>");
                        }
                    }

                    ?>
                </select>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Treaty Sub Types <span class="tx-danger">*</span></label>

                <select class="form-control select2 NonFinancial"   data-placeholder="Choose Option Treaty Sub Types" id="treatySubTypes" name="treatySubTypes[]" multiple>
                    <option value="">Select Treaty Types</option>
                    <?php
                    if (isset($Treaty_Subtype)) {
                        foreach ($Treaty_Subtype as $key => $objTreaty_Subtype) {
                            print("<option value='".$objTreaty_Subtype->id."'>".$objTreaty_Subtype->subTypeName."</option>");
                        }
                    }
                    ?>
                </select>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Treaty Category <span class="tx-danger">*</span></label>
                <select class="form-control NonFinancial"  id="treaty_categorySel" name="treaty_categorySel" readonly="true" disabled>
                    <option value="">Select Treaty Category</option>
                    <?php
                    $selectedCatId ='';
                    if (isset($Treaty_category))
                    {
                        foreach ($Treaty_category as $key => $objTreaty_category)
                        {
                            $selected ='';
                            if(isset($Treaty))
                            {
                                if($Treaty->agreementDTO->treatyCategoryDTO->id == $objTreaty_category->id) {
                                    $selected = 'selected';
                                    $selectedCatId = $objTreaty_category->id;
                                }
                            }
                            print("<option value='".$objTreaty_category->id."' ".$selected.">".$objTreaty_category->name."</option>");
                        }
                    }

                    ?>
                </select>
                <input type="hidden" name="treaty_category" id="treaty_category" value="<?php echo $selectedCatId;?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Effective From </label>
                    <div class="input-group">
                    <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                    <?php
                        $effectiveFrom = '';
                        if(isset($Treater_details->treatySlipGeneralDTO))
                        {
                            $effectiveFrom = date("Y-m-d",strtotime($Treater_details->treatySlipGeneralDTO->effectiveFrom));
                        }  
                    ?>
                    <input type="date" class="form-control NonFinancial" autocomplete="off"  name="effectiveFrom" id="effectiveFrom" placeholder="Enter Effective From" value="<?php echo $effectiveFrom;?>" >
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Expiring On </label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icon ion-calendar tx-16 lh-0 op-6"></i></span>
                    <?php
                        $expireOn = '';
                        if(isset($Treater_details->treatySlipGeneralDTO))
                        {
                            $expireOn = date("Y-m-d",strtotime($Treater_details->treatySlipGeneralDTO->expireOn));
                        }  
                    ?>
                    <input type="date" class="form-control NonFinancial" name="expireOn" autocomplete="off"  placeholder="Enter Expiring On"  id="expireOn" value="<?php echo $expireOn;?>" >
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="form-group">
                <label class="form-control-label">Both Days <span class="tx-danger"></span></label>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <input type="checkbox" class="form-check-input NonFinancial" name="inclusive" value="1" <?php if(isset($Treater_details->treatySlipGeneralDTO->inclusive) && $Treater_details->treatySlipGeneralDTO AND $Treater_details->treatySlipGeneralDTO->inclusive == true){ echo 'checked'; } ?>>
                <label class="form-control-label">Inclusive <span class="tx-danger"></span></label>
            </div>

            <div class="form-group">
                <input type="checkbox" class="form-check-input NonFinancial" name="exclusive" value="1" <?php if(isset($Treater_details->treatySlipGeneralDTO) AND  $Treater_details->treatySlipGeneralDTO->exclusive == true){ echo 'checked'; } ?>>
                <label class="form-control-label">Exclusive <span class="tx-danger"></span></label>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Time  <span class="tx-danger"></span></label>
                <input class="form-control NonFinancial" type="text" name="incExcTime" id="incExcTime" placeholder="Enter Time"  value="<?php print(isset($Treater_details->treatySlipGeneralDTO)
                            ?$Treater_details->treatySlipGeneralDTO->incExcTime:'');?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Currency <span class="tx-danger">*</span></label>
                <select class="form-control select2 Financial" data-placeholder="Choose Option" id="currency" name="currency" >
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



                            print("<option value='".$objCurrency->code."|".$objCurrency->id."' ".$selected.">".$objCurrency->country." (".$objCurrency->code.")</option>");
                        }
                    }

                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Currency Rate Type <span class="tx-danger">*</span></label>
                 <select class="form-control select2 Financial" data-placeholder="Choose Option" id="Rate_Type" name="Rate_Type">
                        <option value="">Select Rate Type</option>
                        <?php
                        if(isset($RateTypes))
                        {
                            foreach ($RateTypes as $key => $objRateTypes)
                            {
                                $selected ='';
                                if(isset($Selected_RateType))
                                {



                                    if($Selected_RateType->id == $objRateTypes->id)
                                    {
                                        $selected = 'selected';
                                    }else
                                    {
                                        if($objRateTypes->name == "Fixed") {
                                            $selected = 'selected';
                                        }
                                    }
                                }else
                                {
                                    if(isset($Treater_details) AND $Treater_details->treatySlipGeneralDTO->currencyRateDTO =='' && $Treater_details->treatySlipGeneralDTO->currencyRate !='' && $objRateTypes->name == "Fixed") {
                                        $selected = 'selected';
                                    }
                                }

                                print("<option value='".$objRateTypes->id."|".$objRateTypes->name."' ".$selected.">".$objRateTypes->name. "</option>");
                            }
                        }

                        ?>
                    </select>

            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Currency Rate <span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="currency_rate" id="currency_rate" placeholder="Enter Currency Rate" value="<?php print(isset($Treater_details->treatySlipGeneralDTO)
                                ?$Treater_details->treatySlipGeneralDTO->currencyRate:'');?>">
                <p id="currency_rate_error" style="color: red;"></p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Limit Of Liability <span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="liabilityLimit" id="liabilityLimit" placeholder="Enter Limit Of Liability" value="<?php print(isset($Treater_details->treatySlipGeneralDTO)
                                    ? $Treater_details->treatySlipGeneralDTO->liabilityLimit:'');?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group ">
                <label class="form-control-label">Portfolio Type <span class="tx-danger">*</span></label>
                <?php
                        $portfolioTypes = array("Run Off","Cut Off","Risk Attaching","Clean Cut");
                ?>
                <select class="form-control select2 NonFinancial" data-placeholder="Choose Option" id="portfolioType" name="portfolioType" required>
                    <option label="" value="">Select portfolio type</option>
                    <?php
                    foreach ($portfolioTypes as $key => $portfolioType)
                    {
                        $selected ='';
                        if(isset($Treater_details) AND isset($Treater_details->treatySlipGeneralDTO->portfolioType))
                        {
                            if( $Treater_details->treatySlipGeneralDTO->portfolioType == $portfolioType) {
                                $selected = 'selected';
                            }
                        }
                        print("<option value='".$portfolioType."' ".$selected.">".$portfolioType."</option>");
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group mg-b-10-force">
                <label class="form-control-label">UMR Number <span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="umrNumber" id="umrNumber" placeholder="Enter UMR Number" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->umrNumber:'');?>">
            </div>
        </div>



        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Territorial Scope <span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="territorialScope" id="territorialScope"  placeholder="Enter Territorial Scope" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->territorialScope:'');?>">
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Management Expense <span class="tx-danger"></span></label>
                <input class="form-control Financial" type="text" name="managementExpenses" id="managementExpenses" placeholder="Enter Management Expense"  value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->managementExpense:'');?>">
            </div>
        </div> -->
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">File & Referrence No.  <span class="tx-danger">*</span></label>
                <input class="form-control NonFinancial" type="text" name="fileRefNo" id="fileRefNo" placeholder="Enter File & Referrence No"  value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->fileRefNo:'');?>">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <?php
                    $participationFlags = array("Leader","Follower");
                ?>
                <label class="form-control-label">Participation Flag<span class="tx-danger">*</span></label>
                <select class="form-control select2 NonFinancial" data-placeholder="Choose Option" id="participationFlag" name="participationFlag" required>
                    <option value="">Select Option</option>
                    <?php
                    foreach ($participationFlags as $key => $participationFlag)
                    {
                        $selected ='';
                        if(isset($Treater_details))
                        {
                            if($Treater_details->treatySlipGeneralDTO->participationFlag == $participationFlag)
                                $selected = 'selected';

                        }
                         print("<option value='".$participationFlag."' ".$selected.">".$participationFlag."</option>");
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Leader/Follower </label>
                <select class="form-control select2 NonFinancial" data-placeholder="Choose Option" id="leader_id" name="leader_id">
                    <option value="">Select Option</option>
                    <?php
                    if(isset($leader_follower))
                    {
                        foreach ($leader_follower as $key => $objleader_follower)
                        {
                            $selected ='';
                                echo  $Treater_details->treatySlipGeneralDTO->leaderFollowerDTO->id."  ==  ".$objleader_follower->id;
                            if(isset($Treater_details->treatySlipGeneralDTO->leaderFollowerDTO)  && $Treater_details->treatySlipGeneralDTO->leaderFollowerDTO->id == $objleader_follower->id)
                            {
                                $selected = 'selected';
                            }

                            print("<option value='".$objleader_follower->id."' ".$selected.">".$objleader_follower->name. "</option>");
                        }
                    }

                    ?>
                </select>
            </div>
        </div>


       <!-- <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">PRC Share<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="prcShare" id="prcShare_general"  placeholder="Enter PRC Share" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->prcShare:'');?>">
            </div>
        </div> -->
        <!-- <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">PRC Amount<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="prcAmount" id="prcAmount"  placeholder="Enter PRC Amount" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->prcAmount:'');?>">
            </div>
        </div> -->
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">R.I Commission<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="profitCommissionRate" id="profitCommissionRate" placeholder="Enter PRC Commission Rate" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->profitCommissionRate:'');?>">
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">PRC Commission<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="profitCommission" id="profitCommission" placeholder="Enter PRC Commission" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->profitCommission:'');?>">
            </div>
        </div> -->
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Jurisdiction<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" maxlength="400" name="jurisdiction" id="jurisdiction" placeholder="Enter Jurisdiction" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->jurisdiction:'');?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Perils<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="perils" id="perils"  placeholder="Enter Perils" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->perils:'');?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Premium Warranty Payable<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="premiumWarrantyPayable" id="premiumWarrantyPayable" placeholder="Enter Premium Warranty Payable" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->premiumWarrantyPayable:'');?>">
            </div>
        </div>


        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Treaty Limit Co Insurance %<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="treatyLimitCoInsurance" id="treatyLimitCoInsurance" placeholder="Enter Treaty Limit Co Insurance %" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->treatyLimitCoInsurance:'');?>">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Treaty Limit Facultative<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="treatyLimitCoFacultative" id="treatyLimitCoFacultative" placeholder="Enter Treaty Limit Co Facultative %" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->treatyLimitCoFacultative:'');?>">
            </div>
        </div>

        <!-- <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Sum Insured<span class="tx-danger">*</span></label>
                <input class="form-control Financial" type="text" name="sumInsured" id="sumInsured" placeholder="Enter Sum Insured"  value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->sumInsured:'');?>">
            </div>
        </div> -->
        <!-- <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Insured<span class="tx-danger">*</span></label>
                <select class="form-control select2 Financial" data-placeholder="Choose Option" id="rmsInsured" name="rmsInsured" required>
                    <option value="">Select Option</option> -->
                    <?php
                    // if(isset($rmsInsured))
                    // {
                    //     foreach ($rmsInsured as $key => $ObjrmsInsured)
                    //     {

                    //         $data = json_encode($ObjrmsInsured);
                    //         $aRmsInsured = json_decode($data,true);
                    //         $selected ='';
                    //         if(isset($Treater_details->treatySlipGeneralDTO->rmsInsuredDTO))
                    //         {

                    //             if($Treater_details->treatySlipGeneralDTO->rmsInsuredDTO->id == $aRmsInsured[0])
                    //             {
                    //                 $selected = 'selected';
                    //             }

                    //         }
                    //         print("<option value='".$aRmsInsured[0]."' ".$selected.">".$aRmsInsured[1]."</option>");
                    //     }
                    // }

                    ?>
                <!-- </select>
            </div>
        </div> -->


        <div class="col-lg-4">
            <div class="form-group egnpi_field_error">
                <label class="form-control-label">GNPI  (Actual)<span class="tx-danger">*</span>
                    <?php

                    $isCheckeEGNPI = '';
                    if(isset($Treater_details->treatySlipGeneralDTO))
                    {
                        if($Treater_details->treatySlipGeneralDTO->egnpiActual !='' OR $Treater_details->treatySlipGeneralDTO->egnpiRevise !='' )
                        {
                            $isCheckeEGNPI= 'checked';
                        }

                    }
                    ?>
                    <input type="checkbox" id="egnpi" class="Financial" <?php echo $isCheckeEGNPI;?>>
                </label>
                <input class="form-control egnpi_field Financial" readonly="readonly" type="text" name="egnpiActual" id="egnpiActual" placeholder="Enter GNPI (Actual)" id="egnpiActual" value="<?php echo(isset($Treater_details->treatySlipGeneralDTO)? $Treater_details->treatySlipGeneralDTO->egnpiActual:'')?>">
            </div>
        </div>


        <div class="col-lg-4">
            <div class="form-group egnpi_field_error">
                <label class="form-control-label">GNPI (Revise)<span class="tx-danger">*</span>
                </label>
                <input class="form-control egnpi_field Financial" id="egnpi_field" readonly="readonly" placeholder="Enter GNPI (Revise)" type="text" name="egnpiRevise" id="egnpiRevise" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->egnpiRevise:'');?>">
            </div>
        </div>

        <div class="col-lg-4"></div>

        <div class="col-lg-4">
            <div class="form-group epi_field_error">
                <label class="form-control-label">EPI (Actual)<span class="tx-danger">*</span>
                    <?php

                        $isCheckEPI = '';
                        if(isset($Treater_details->treatySlipGeneralDTO))
                        {
                            if($Treater_details->treatySlipGeneralDTO->epiActual !='' OR $Treater_details->treatySlipGeneralDTO->epiRevised !=''
                                                        OR $Treater_details->treatySlipGeneralDTO->lossCap !='' OR $Treater_details->treatySlipGeneralDTO->lossParticipation !='')
                            {
                                $isCheckEPI = 'checked';
                            }

                        }
                    ?>
                    <input type="checkbox" id="epi" class="Financial" <?php echo $isCheckEPI;?>>
                </label>
                <input class="form-control epi_field Financial" readonly="readonly" placeholder="Enter EPI (Actual)" type="text" name="epiActual" id="epiActual" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->epiActual:'');?>">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-group epi_field_error">
                <label class="form-control-label">EPI (Revise)<span class="tx-danger">*</span>
                </label>
                <input class="form-control epi_field Financial" readonly="readonly" placeholder="Enter EPI (Revise)" type="text" id="epiRevised"  name="epiRevised" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->epiRevised:'');?>">
            </div>
        </div>

        <!-- <div class="col-lg-4"></div> -->

        <div class="col-lg-4">
            <div class="form-group epi_field_error">
                <label class="form-control-label">Loss Cap<span class="tx-danger">%</span>
                </label>
                <input class="form-control  Financial" type="text" name="lossCap" id="lossCap" placeholder="Enter Loss Cap %" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->lossCap:'');?>">
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <div class="form-group ">
                <label class="form-control-label">Loss Cap Value  </label>
                <input class="form-control  Financial" type="text" placeholder="Enter Loss Cap Value %" name="lossCapValue" id="lossCapValue"  value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->lossCapValue:'');?>">
            </div>
        </div> -->
        <!-- <div class="col-lg-4">
            <div class="form-group ">
                <label class="form-control-label">Loss Participation  </label>
                <input class="form-control  Financial"  type="text" placeholder="Enter Loss Participation" name="lossParticipation" id="lossParticipation" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->lossParticipation:'');?>">
            </div>
        </div> -->

        <div class="col-lg-4">
            <div class="form-group ">
                <label class="form-control-label">Cash Loss Advice </label>
                <input class="form-control Financial"  type="text" placeholder="Enter Cash Loss Advice" name="cashLossRate" id="cashLossRate" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->cashLossRate:'');?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group ">
                <label class="form-control-label">PLA (Preliminary Loss Advice)  </label>
                <input class="form-control Financial"  type="text" placeholder="Enter PLA (Preliminary Loss Advice)" name="cashLossValue" id="cashLossValue" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->cashLossValue:'');?>">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group ">
                <label class="form-control-label">Prc Share Rate </label>
                <input class="form-control Financial"  type="text" placeholder="Enter Prc Share Rate" name="prcShareRate" id="prcShareRate" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->prcShareRate:'');?>">
            </div>
        </div>
        <div class="col-lg-4">
            <label class="form-control-label">CLA PRC Share value </label>
            <div class="form-group input-group">
                <input  class="form-control" type="text" name="claPrcShareValue" id="claPrcShareValue" placeholder="Enter CLA PRC Share value" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->claPrcShareValue:'');?>" >&nbsp;
                <button  id="claPrcShareValueBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
            </div>
        </div>
        <div class="col-lg-4">
            <label class="form-control-label">PLA PRC Share value </label>
            <div class="form-group input-group">
                <input  class="form-control" type="text" name="plaPrcShareValue" id="plaPrcShareValue" placeholder="Enter PLA PRC Share value" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->plaPrcShareValue:'');?>" >&nbsp;
                <button  id="plaPrcShareValueBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
            </div>
        </div>
        <!-- <div class="col-lg-4">
            <label class="form-control-label">Prc Share Value </label>
            <div class="form-group input-group">
                <input  required class="form-control Financial" type="text" name="prcShareValue" id="prcShareValue" placeholder="Enter Prc Share Value" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->prcShareValue:'');?>">&nbsp;
                <button  id="prcShareValueBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
            </div>
        </div> -->
        <!-- <div class="col-lg-4">
            <label class="form-control-label">GNPI PRCL SHARE </label>
            <div class="form-group input-group">
                <input  required class="form-control Financial" type="text" name="egnpi_prcShare" id="egnpi_prcShare" placeholder="Enter EGNPI PRCL SHARE" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->egnpiPrclShare:'');?>">&nbsp;
                <button  id="egnpi_prcShareBtn" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">Calculate</button>
            </div>
        </div> -->
        <!-- <div class="col-lg-8">
            <div class="form-group">
                <label class="form-control-label">Description </label>
                <textarea class="form-control NonFinancial" id="description" placeholder="Enter Description" name="description"><?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->description:'');?></textarea>
            </div>
        </div> -->

        <!-- <div class="col-lg-8">
            <div class="form-group">
                <label class="form-control-label">Special Acceptance </label>
                <textarea class="form-control NonFinancial" id="specialAcceptance" placeholder="Enter Special Acceptance" name="specialAcceptance"><?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->specialAcceptance:'');?></textarea>
            </div>
        </div> -->
        <!-- <div class="col-lg-4"></div> -->
        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Event Limit Value </label>
                <!-- <textarea class="form-control Financial" id="eventLimitValue" placeholder="Enter Event Limit Value" name="eventLimitValue">
                    <?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->eventLimitValue:'');?>
                </textarea> -->

                <input type="text" class="form-control Financial" id="eventLimitValue" placeholder="Enter Event Limit Value" name="eventLimitValue" value="<?=isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->eventLimitValue:'';?>">
            </div>
        </div>


        <div class="col-lg-4">
            <div class="form-group">
                <label class="form-control-label">Risk Covered<span class="tx-danger">*</span></label>
                <!-- <textarea class="form-control Financial" id="riskCovered" placeholder="Enter Risk Covered" name="riskCovered"><?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->riskCovered:'');?></textarea> -->
                <?php
                $riskCoveredids = '';
                if(isset($Treater_details->treatySlipGeneralDTO->riskCoveredDTOS))
                {
                    $riskCovereds = json_decode(json_encode($Treater_details->treatySlipGeneralDTO->riskCoveredDTOS), true);
                    $riskCovereds = array_column($riskCovereds, 'id');
                    $riskCoveredids = implode(",",$riskCovereds);
                }

                ?>
                <select class="form-control Financial with-add-new-select2" id="riskCoveredIds" placeholder="Enter Risk Covered" name="riskCoveredIds[]" multiple="multiple">
                    <option value=""></option>
                    <option value="NEW">Add new Risk Covered</option>
                    <?php foreach ($risksCovered as $riskCovered) { ?>
                        <option value="<?=$riskCovered->id?>"><?=$riskCovered->name?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <script>
            // $ is not defined here !!!!!
            // $('#riskCoveredIds').val([<?=$riskCoveredids;?>]).change();
        </script>
        <!-- <div class="col-lg-8">
            <div class="form-group">
                <label class="form-control-label">MPL %<span class="tx-danger">*</span></label>
                <textarea class="form-control Financial" id="mpl_value" placeholder="Enter MPL %" name="mpl_value"><?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->mpl:'');?></textarea>
            </div>
        </div> -->

        <!-- <div class="col-lg-8">
            <div class="form-group">
                <label class="form-control-label">MPL Error %<span class="tx-danger">*</span></label>
                <textarea class="form-control Financial" id="mplError" name="mplError" placeholder="Enter Loss Cap %" ><?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->mplError:'');?></textarea>
            </div>
        </div> -->

        <!-- <div class="col-lg-4"> </div> -->

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Broker involved </label>
                    <select name="Broker" id="Broker" class="form-control NonFinancial" >
                        <option value="">Select broker</option>
                        <?php
                        if(isset($Brokers)) {
                            foreach ($Brokers as $key => $objBroker) {
                                $selected ='';
                                if(isset($Treater_details)) {
                                    if(isset($Treater_details->treatySlipGeneralDTO->brokerDTO->id) && $Treater_details->treatySlipGeneralDTO->brokerDTO->id == $objBroker->id) {
                                        $selected = 'selected';
                                    }
                                }
                                print("<option value='".$objBroker->id."' ".$selected.">".$objBroker->name."</option>");
                            }
                        }

                        ?>
                    </select>
                </div>
            </div>





        <!-- Payment Terms -->
        <div class="clear"></div>
        <hr>
        <div class="col-lg-4">
            <div class="form-group">
                <?php
                $payment_terms = array("yearly"=>"Yearly","bi_annually"=>"Bi Annually","quarterly"=>"Quarterly","monthly"=>"Monthly","manual"=>"Manual");
                ?>
                <label class="form-control-label">Payment Terms<span class="tx-danger">*</span></label>
                <select name="payment_terms" class="form-control Financial" id="payment_terms">
                    <option value="">--Select--</option>
                    <?php
                    foreach ($payment_terms as $key => $payment_terms)
                    {
                        $selected ='';
                        if(isset($Treater_details) AND isset($Treater_details->treatySlipGeneralDTO))
                        {
                            if(strtoupper($Treater_details->treatySlipGeneralDTO->paymentTerm) == strtoupper($key)) {
                                $selected = 'selected';
                            }
                        }
 
                        print("<option value='".$key."' ".$selected.">".$payment_terms."</option>");
                    }
                    ?>
                </select>
            </div>
        </div><!-- col-4 -->
        <div class="payment_terms_desc col-lg-8">
            <?php
            if(isset($Treater_details) AND isset($Treater_details->treatySlipGeneralDTO))
            {
                $html = '<div class="row">';
                    for($i = 1; $i <= count($Treater_details->treatySlipGeneralDTO->paymentTermRangeDTOs); $i++)
                    {
                        $DateFrom = date("Y-m-d",strtotime($Treater_details->treatySlipGeneralDTO->paymentTermRangeDTOs[$i-1]->paymentTermFrom));
                        $DateTo = date("Y-m-d",strtotime($Treater_details->treatySlipGeneralDTO->paymentTermRangeDTOs[$i-1]->paymentTermTo));
                        $paymentTermRangeId =  $Treater_details->treatySlipGeneralDTO->paymentTermRangeDTOs[$i-1]->id ;

                        $html .=' <input type="hidden" name="paymentTermRangeId"  value="'.$paymentTermRangeId.'">';
                        $html .= '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control Financial" type="date" id="date_from_'.$i. '" name="date_from_' .$i.' "  value="'.$DateFrom.'"> </div></div>';
                        $html .= '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control Financial" type="date" id="date_to_'.$i.'" name="date_to_'.$i.'" value="'.$DateTo.'"></div></div><div class="clear"></div>';

                    }
                $html .= '</div>';
                echo $html;
            }

            ?>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label class="form-control-label">Comments<span class="tx-danger">*</span></label>
                <textarea class="form-control" id="treatyComments" name="treatyComments" placeholder="Enter Comments" ><?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->treatyComments:'');?></textarea>
            </div>
        </div>
            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">UW Status<span class="tx-danger">*</span></label>
                    <select class="form-control NonFinancial" id="uwStatus" name="uwStatus">
                        <?= getSelectedOptions($treatySlipGeneral->uwStatus,'uwStatusOptions') ?>
                        <!-- <?php foreach ($uwStatusOptions as $k => $v) { ?>
                            <option value="<?=$k?>"><?=$v?></option>
                        <?php } ?> -->
                    </select>
                </div>
            </div>
            <div class="col-lg-8"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Assign To<span class="tx-danger">*</span></label>
                    <select class="form-control NonFinancial" id="assignTo" name="assignTo">
                        <?= getSelectedOptions($treatySlipGeneral->assignTo,'assignToOptions') ?>
                        <!-- <?php foreach ($assignToOptions as $k => $v) { ?>
                            <option value="<?=$k?>"><?=$v?></option>
                        <?php } ?> -->
                    </select>
                </div>
            </div>
            <div class="col-lg-8"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">UW Type<span class="tx-danger">*</span></label>
                    <select class="form-control NonFinancial" id="uwType" name="uwType">
                        <?= getSelectedOptions($treatySlipGeneral->uwType,'uwTypeOptions') ?>
                        <!-- <?php foreach ($uwTypeOptions as $k => $v) { ?>
                            <option value="<?=$k?>"><?=$v?></option>
                        <?php } ?> -->
                    </select>
                </div>
            </div>
            <div class="col-lg-8"></div>

            <div class="col-lg-4">
                <div class="form-group">
                    <label class="form-control-label">Is Preapproved<span class="tx-danger">*</span></label>
                    <select class="form-control NonFinancial" id="isPreApproved" name="isPreApproved">
                        <?= getSelectedOptions($treatySlipGeneral->isPreApproved,'isPreapprovedOptions') ?>
                        <!-- <?php foreach ($isPreapprovedOptions as $k => $v) { ?>
                            <option value="<?=$k?>"><?=$v?></option>
                        <?php } ?> -->
                    </select>
                </div>
            </div>
            <div class="col-lg-8"></div>

    </div>

    <div class="row">
        <div class="col-12">
            <input type="hidden" name="agreementId" id="agreementId" value="<?php print(isset($Treaty->agreementDTO) ? $Treaty->agreementDTO->id:'');?>">
            <input type="hidden" name="treatySlipGeneralId" class="HiddentreatySlipGeneralId" value="<?php print(isset($Treater_details->treatySlipGeneralDTO) ? $Treater_details->treatySlipGeneralDTO->id:'');?>">
            <input type="hidden" name="currency_rateId" id="currency_rateId" value="<?php if(isset($Treater_details->treatySlipGeneralDTO)){ if($Treater_details->treatySlipGeneralDTO->currencyRateDTO){ echo $Treater_details->treatySlipGeneralDTO->currencyRateDTO->id; }else{ echo 0;} }?>">
            <input type="hidden" name="currency_RatType" id="currency_RatType" value="<?php if(isset($Treater_details->treatySlipGeneralDTO)){ if($Treater_details->treatySlipGeneralDTO->currencyRateDTO){ if($Treater_details->treatySlipGeneralDTO->currencyRateDTO->rateTypeDTO){ echo $Treater_details->treatySlipGeneralDTO->currencyRateDTO->rateTypeDTO->id;}else{ echo 0; }}else{ echo 0;} }?>">
            <input type="submit" class="btn btn-success pull-right submit" style="margin: 10px;" name="treatyslip_general" value="Save Changes">
        </div>
    </div>



</form>
</section>
<script>


    var business_String = [<?php echo $business_String;?>];
    var BusinessClass_General = document.getElementById('business_class');
    for (var i = 0; i < BusinessClass_General.options.length; i++) {
        BusinessClass_General.options[i].selected = business_String.indexOf(BusinessClass_General.options[i].value) >= 0;
    }

    var treatySubTypes = document.getElementById('treatySubTypes');
    var values = [<?php echo $treatySubTypes_String;?>];
    for (var i = 0; i < treatySubTypes.options.length; i++) {
        treatySubTypes.options[i].selected = values.indexOf(treatySubTypes.options[i].value) >= 0;
    }
</script>