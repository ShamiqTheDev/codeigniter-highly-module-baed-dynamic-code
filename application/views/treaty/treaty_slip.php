<?php $this->load->view('includes/header', $this->data);?>
<style>
    .help-block {
        display: block;
        margin-top: 5px;
        margin-bottom: 10px;
        color: #FF0000;
    }
    .has-error .help-block, .has-error .control-label, .has-error .radio, .has-error .checkbox, .has-error .radio-inline, .has-error .checkbox-inline, .has-error.radio label, .has-error.checkbox label, .has-error.radio-inline label, .has-error.checkbox-inline label {
        color: #FF0000;
    }


</style>

<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Treaty Slip</span>
        </nav>
    </div>

<!-- modal for create update confirmation -->
<div id="finishConfirmationModal" class="modal fade show" style="display: none;">
    <div class="modal-dialog" role="document">
        <div class="modal-content tx-size-sm">
            <div class="modal-body tx-center pd-y-20 pd-x-20">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <i class="icon icon ion-ios-information-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                <h4 class="tx-success tx-semibold mg-b-20">Do you want to Finish Submission?</h4>

                <input type="button" id="confirmed" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" value="Yes">
                <button type="button" class="btn tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                    No
                </button>

            </div>
        </div>
    </div>
</div>

<!--    <div class="row">-->
<!--        <div class="col-sm-12">-->
<!--            <div class="pd-30 form-heading-container" style="">-->
<!--                <h4 class="tx-gray-800 mg-b-5 form-heading">Treaty Slip</h4>-->
<!--                <p class="mg-b-0"></p>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div><br>-->

    <!--
<div class="br-section-wrapper ">
        <div class="bg-gray-100 bd pd-x-20 pd-t-20-force pd-b-10-force ">
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Agreement No.</label>
                        <select class="form-control select2" data-placeholder="Choose Agreement">
                            <option label="Choose Agreement"></option>
                            <option value="Option">AGR/20200210HO</option>
                            <option value="Option">AGR/20200211HO</option>
                            <option value="Option">AGR/20200212HO</option>
                            <option value="Option">AGR/20200213HO</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group mg-b-10-force">
                        <label class="form-control-label">Treaty No.</label>
                        <select class="form-control select2" data-placeholder="Choose Treaty">
                            <option label="Choose Treaty"></option>
                            <option value="Option">Fire & General Accident Q/S & Surplus</option>
                            <option value="Option">Fire & General Accident Q/S & Surplus</option>
                            <option value="Option">Fire & General Accident Q/S & Surplus</option>
                            <option value="Option">Fire & General Accident Q/S & Surplus</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="pd-t-30-force">
                        <button class="btn btn-dark tx-12 tx-uppercase tx-spacing-2 show_list">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
-->
 
<div class="br-pagebody mg-t-5 pd-x-30">

<div class="br-section-wrapper section-wrapper-shadow">

    <div class="row">
        <div class="col-sm-6">Treaty Name : <?php if(isset($Treaty)){ print($Treaty->name); }?> <br><br></div>

        <div class="col-sm-3">
            <?php if(isset($Treater_details->renewalTreatierDTOs) AND count($Treater_details->renewalTreatierDTOs) > 0 ) { ?>
                <div class="form-group">
                    <label class="form-control-label">Prevous Treaties</label>
                    <select class="form-control select2" data-placeholder="Choose Option" id="renewalTreatier" name="renewalTreatier">
                        <option value="">Select Option</option>
                        <?php

                            foreach ($Treater_details->renewalTreatierDTOs as $key => $ObjrenewalTreatier)
                            {
                                print("<option value='".base_url("treaty/treaty_slip/".base64_encode($ObjrenewalTreatier->id))."'>".$ObjrenewalTreatier->name."</option>");
                            }

                        ?>
                    </select>
                </div>
            <?php } ?>
        </div>

        <?php if(isset($action) && $action != "view_record"){ ?>
        <div class="col-sm-3">
            <div class="form-group">
                <label class="form-control-label">Goto Other Treaty</label>
                <?php //dd($treaties); ?>
                <select class="form-control select2" id="otherTreaties">
                    <option value="">Select other treaty to visit</option>
                    <?php 
                    foreach ($treaties as $treaty) {
                        if ($Treaty->id == $treaty->id)
                            $selected = ' selected="selected"';
                        else
                            $selected = '';
                    ?>
                        <option value="<?=base_url('treaty/treaty_slip/'.base64_encode($treaty->id))?>"<?=$selected?>><?=$treaty->name?></option>
                    <?php 
                    } 
                    ?>
                </select>
            </div>
        </div>
        <?php } ?>
    </div>

    <div id="wizard1">
            <?php
            $this->load->view('treaty/treatyslip_tabs/general');

                if(isset($Treaty->agreementDTO->treatyCategoryDTO))
                { 
                    
                     if($Treaty->agreementDTO->treatyCategoryDTO->name  =='Non-Proportional')
                     {
                         $this->load->view('treaty/treatyslip_tabs/layers');
                     }
                     elseif($Treaty->agreementDTO->treatyCategoryDTO->name =='Proportional')
                     {
                        $this->load->view('treaty/treatyslip_tabs/section');
                     }

                }

            
            
            $this->load->view('treaty/treatyslip_tabs/sliding_scale');
            $this->load->view('treaty/treatyslip_tabs/conditions');
          //  $this->load->view('treaty/treatyslip_tabs/loss_history'); // hide for temp
            $this->load->view('treaty/treatyslip_tabs/documents');
            $this->load->view('treaty/treaty_comments_section');
            ?>    
    </div>
</div>

<script>
    var TreaterId = <?php if(isset($Treaty)){ echo $Treaty->id; }else{ echo 0; } ?>;
</script>
<?php $this->load->view('includes/footer', $this->data);?>
    <script>
        // Global constants
        base_url = '<?php echo base_url()?>'; 
        var tretierId = '<?php if(isset($Treaty->id)){ echo $Treaty->id; }else{ echo ''; } ?>';
        var TypeOfEndorsement = '<?php if(isset($Treater_details->typeOfEndorsement)){ echo $Treater_details->typeOfEndorsement; }else{ echo ''; } ?>';
        ObjSlidingScale = <?php echo json_encode($this->config->item("slidingScale_conditions"));?>;

      
</script>
    <script src="<?php echo base_url('assets\lib\select2\js\select2.min.js')?>" ></script>
    <script src="<?php echo $includes_dir;?>lib/admin/treatySlip.js"></script>
    <script src="<?php echo base_url('assets\lib\admin\general.js')?>" type="text/javascript" charset="utf-8" async defer></script>
    <script src="<?php echo base_url('assets\lib\admin\treaty\treaty_slip.js')?>" type="text/javascript" charset="utf-8" async defer></script>

    <script>
        /* this code is placed here to fix a bug related to $ is not defined */
        $(document).ready(function () {
            $('#riskCoveredIds').val([<?=!empty($riskCoveredids)?$riskCoveredids:'';?>]).change();
        });

        var TypeOfEndorsement = '<?php if(isset($Treater_details->typeOfEndorsement)){ echo $Treater_details->typeOfEndorsement; }else{ echo ''; } ?>';
        var BusinessClass = jQuery.parseJSON('<?php if(isset($Business_class)){ echo json_encode($Business_class); }else{ echo ''; } ?>');
        var TreatySubTypes = jQuery.parseJSON('<?php if(isset($Treaty_Subtype)){ echo json_encode($Treaty_Subtype); }else{ echo ''; } ?>');

 
        
        BusinessClassOptions = '<option value="">Select Business Class</option>';
        if(BusinessClass !='')
        {
            jQuery.each(BusinessClass, function(index, item) {
                BusinessClassOptions +="<option value='"+item.id+"' >"+item.name+"</option>";
            });   
        }

        TreatySubTypesOptions = '<option value="">Select Treaty Sub Type</option>';
        if(TreatySubTypes !='')
        {
            jQuery.each(TreatySubTypes, function(index, TreatySubType) {
                TreatySubTypesOptions +="<option value='"+TreatySubType.id+"' >"+TreatySubType.subTypeName+"</option>";
            });   
        }

        function getBusinessClassWithSelected(BusinessClass,BusinessClassId)
        { 
            BusinessClassWithSelected = '<option value="">Select Business Class</option>';
            if(BusinessClass !='')
            {
                jQuery.each(BusinessClass, function(index, item) 
                {
                    selected = '';
                    if(BusinessClassId == item.id)
                    {
                        selected = ' selected';
                    }
                    BusinessClassWithSelected +="<option value='"+item.id+"' "+selected+">"+item.name+"</option>";
                });   
            }
            return BusinessClassWithSelected;
        }

        function getTreatySubTypeWithSelected(TreatySubTypes,TreatySubTypeId)
        { 
            TreatySubTypeWithSelected = '<option value="">Select Treaty Sub Type</option>';
            if(TreatySubTypes !='')
            {
                jQuery.each(TreatySubTypes, function(index, item) 
                {
                    selected = '';
                    if(TreatySubTypeId == item.id)
                    {
                        selected = ' selected';
                    }
                    TreatySubTypeWithSelected +="<option value='"+item.id+"' "+selected+">"+item.subTypeName+"</option>";
                });   
            }
            return TreatySubTypeWithSelected;
        }
 
        var PrcsFieldCount = 2;
        
        function AddMorePRCS()
        {
            if($("#PrcShare_layerRows").val() !='')
            {
                PrcsFieldCount = $("#PrcShare_layerRows").val();
                $("#PrcShare_layerRows").val('');
            }

            html = '<tr id="PrcShare_layer_'+PrcsFieldCount+'_Tr"><td><select class="form-control" id="businessclass_PrcShare_layer_'+PrcsFieldCount+'" name="businessclass_PrcShare_layer_'+PrcsFieldCount+'" >';
            html += BusinessClassOptions; 
            html += '</select></td><td><select class="form-control" id="treatySubType_PrcShare_layer_'+PrcsFieldCount+'" name="treatySubType_PrcShare_layer_'+PrcsFieldCount+'">';
            html += TreatySubTypesOptions;   
            html += '</select></td><td><input class="form-control" type="text" name="GNPIActual_PrcShare_layer_'+PrcsFieldCount+'" id="GNPIActual_PrcShare_layer_'+PrcsFieldCount+'" placeholder="Enter GNPI(Actual)"></td>'+
            '<td><input class="form-control" type="text" name="GNPIRevised_PrcShare_layer_'+PrcsFieldCount+'" id="GNPIRevised_PrcShare_layer_'+PrcsFieldCount+'" placeholder="Enter GNPI(Revised)"></td>'+
            '<td><input class="form-control" type="text" name="GNPIEstimated_PrcShare_layer_'+PrcsFieldCount+'" id="GNPIEstimated_PrcShare_layer_'+PrcsFieldCount+'" placeholder="Enter GNPI(Estimated)"></td>'+
            // '<td><input class="form-control" type="text" name="PRCLSharerate_PrcShare_layer_'+PrcsFieldCount+'" id="PRCLSharerate_PrcShare_layer_'+PrcsFieldCount+'" placeholder="Enter PRCL Share rate"></td>'+
            '<td><div class="form-group input-group"><input  required class="form-control" type="text" name="PRCLSharevalue_PrcShare_layer_'+PrcsFieldCount+'" id="PRCLSharevalue_PrcShare_layer_'+PrcsFieldCount+'" placeholder="Enter PRCL Share value (calculated)">&nbsp;' +
            '<button  id="PRCLSharevalue_PrcShare_layerBtn_'+PrcsFieldCount+'" onclick="CalculationPRCLShere('+PrcsFieldCount+')" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">=</button></div><td>' +
            '<td><a href="javascript:void(0)" onclick="RemoveMe(\'#PrcShare_layer_'+PrcsFieldCount+'_Tr\')">Delete (X)</a></td><tr>';
            $('#AppendAblePrcShareTr').append(html);
            ++PrcsFieldCount;
        }
        var LayerMndpFieldCount = 2;
        function AddMorelayerMndp()
        {
            if($("#MNDP_layerRows").val() !='')
            {
                PrcsFieldCount = $("#MNDP_layerRows").val();
                $("#MNDP_layerRows").val('');
            }

            html = '<tr id="layerMndp_layer_'+LayerMndpFieldCount+'_Tr"><td><select class="form-control" id="businessclass_layerMndp_layer_'+LayerMndpFieldCount+'" name="businessclass_layerMndp_layer_'+LayerMndpFieldCount+'" >';
            html += BusinessClassOptions; 
            html += '</select></td><td><select class="form-control" id="treatySubType_layerMndp_layer_'+LayerMndpFieldCount+'" name="treatySubType_layerMndp_layer_'+LayerMndpFieldCount+'">';
            html += TreatySubTypesOptions;   
            html += '</select></td><td><input class="form-control" type="text" name="mndp_layerMndp_layer_'+LayerMndpFieldCount+'" id="mndp_layerMndp_layer_'+LayerMndpFieldCount+'" placeholder="Enter M&DP 100%"></td>'+
            // '<td><input class="form-control" type="text" name="PRCLSharerate_layerMndp_layer_'+LayerMndpFieldCount+'" id="PRCLSharerate_layerMndp_layer_'+LayerMndpFieldCount+'" placeholder="Enter PRCL Share rate"></td>'+
            '<td><div class="form-group input-group"><input  required class="form-control" type="text" name="PRCLSharevalue_layerMndp_layer_'+LayerMndpFieldCount+'" id="PRCLSharevalue_layerMndp_layer_'+LayerMndpFieldCount+'" placeholder="Enter PRCL Share value (calculated)">&nbsp;' +
            '<button  id="PRCLSharevalue_layerMndp_layerBtn_'+LayerMndpFieldCount+'" onclick="CalculationlayerMndp('+LayerMndpFieldCount+')" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">=</button></div><td>' +
            '<td><a href="javascript:void(0)" onclick="RemoveMe(\'#layerMndp_layer_'+LayerMndpFieldCount+'_Tr\')">Delete (X)</a></td><tr>';
            $('#AppendAblelayerMndpTr').append(html);
            ++LayerMndpFieldCount;
        }
        
        

        function CalculationPRCLShere(fieldNumber)
        {
            var GNPIActual = parseInt($("#GNPIActual_PrcShare_layer_"+fieldNumber).val());
            var PRCLSharerate = parseInt($(".prc_share_percentage").val());
            $("#PRCLSharevalue_PrcShare_layer_"+fieldNumber).val(GNPIActual * PRCLSharerate / 100);
          
        }

        function CalculationlayerMndp(fieldNumber)
        {
            var MNDP = parseInt($("#mndp_layerMndp_layer_"+fieldNumber).val());
            var PRCLSharerate = parseInt($(".prc_share_percentage").val());
            $("#PRCLSharevalue_layerMndp_layer_"+fieldNumber).val(MNDP * PRCLSharerate / 100);
          
        }
       

        function LoadSelectedPRCS(objData)
        {
            SelectedPrcsFieldCount = 1;
            if(objData !='')
            { 
                html ='';
                jQuery.each(objData, function(index, item) 
                {

                    var business = 0;
                    var subTypeId = 0;

                    if (typeof item.businessSubBusinessDTO !== 'undefined' && item.treatySubTypeDTO !=null) {
                        business =  item.businessSubBusinessDTO.id
                    }
                    if (typeof item.treatySubTypeDTO !== 'undefined' && item.treatySubTypeDTO !=null) {
                        subTypeId =  item.treatySubTypeDTO.id;
                    }

                    html += '<tr id="PrcShare_layer_'+SelectedPrcsFieldCount+'_Tr"><td><select class="form-control" id="businessclass_PrcShare_layer_'+SelectedPrcsFieldCount+'" name="businessclass_PrcShare_layer_'+SelectedPrcsFieldCount+'" >';
                    html += getBusinessClassWithSelected(BusinessClass,business);
                    html += '</select></td><td><select class="form-control" id="treatySubType_PrcShare_layer_'+SelectedPrcsFieldCount+'" name="treatySubType_PrcShare_layer_'+SelectedPrcsFieldCount+'">';
                    html += getTreatySubTypeWithSelected(TreatySubTypes,subTypeId);
                    html += '</select></td><td><input class="form-control" type="text" value="'+item.gnpiActual+'" name="GNPIActual_PrcShare_layer_'+SelectedPrcsFieldCount+'" id="GNPIActual_PrcShare_layer_'+SelectedPrcsFieldCount+'" placeholder="Enter GNPI(Actual)"></td>'+
                    '<td><input class="form-control" type="text" value="'+item.gnpiResived+'" name="GNPIRevised_PrcShare_layer_'+SelectedPrcsFieldCount+'" id="GNPIRevised_PrcShare_layer_'+SelectedPrcsFieldCount+'" placeholder="Enter GNPI(Revised)"></td>'+
                    '<td><input class="form-control" type="text" value="'+item.gnipEstimated+'" name="GNPIEstimated_PrcShare_layer_'+SelectedPrcsFieldCount+'" id="GNPIEstimated_PrcShare_layer_'+SelectedPrcsFieldCount+'" placeholder="Enter GNPI(Estimated)"></td>'+
                    // '<td><input class="form-control" type="text" value="'+item.prclShareRate+'" name="PRCLSharerate_PrcShare_layer_'+SelectedPrcsFieldCount+'" id="PRCLSharerate_PrcShare_layer_'+SelectedPrcsFieldCount+'" placeholder="Enter PRCL Share rate"></td>'+
                    '<td><div class="form-group input-group"><input class="form-control" value="'+item.prclShareValue+'" type="text" name="PRCLSharevalue_PrcShare_layer_'+SelectedPrcsFieldCount+'" id="PRCLSharevalue_PrcShare_layer_'+SelectedPrcsFieldCount+'" placeholder="Enter PRCL Share value (calculated)">&nbsp;' +
                    '<button  id="PRCLSharevalue_PrcShare_layerBtn_'+SelectedPrcsFieldCount+'" onclick="CalculationPRCLShere('+SelectedPrcsFieldCount+')" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">=</button></div></td>' +
                    '<td><input type="hidden" value="'+item.id+'"  name="layerPrcShare_id_'+SelectedPrcsFieldCount+'" id="layerPrcShare_id_'+SelectedPrcsFieldCount+'" >' ;
                    

                     if(SelectedPrcsFieldCount > 1)
                     {
                        html += '<a href="javascript:void(0)" onclick="RemoveMe(\'#PrcShare_layer_'+SelectedPrcsFieldCount+'_Tr\')">Delete (X)</a>'; 
                     }   
                     html += '</td><tr>'; 

                    ++SelectedPrcsFieldCount;
                });
                $("#PrcShare_layerRows").val(SelectedPrcsFieldCount);
                $('#AppendAblePrcShareTr').html(html);

               
            }

            
        }


        function LoadSelectedlayerMndp(objData)
        {
            SelectedMNDPFieldCount = 1;
            if(objData !='')
            {
                html ='';
                jQuery.each(objData, function(index, item)
                {
                    var business = 0;
                    var subTypeId = 0;

                    if (typeof item.businessSubBusinessDTO !== 'undefined' && item.treatySubTypeDTO !=null) {
                        business =  item.businessSubBusinessDTO.id
                    }
                    if (typeof item.treatySubTypeDTO !== 'undefined' && item.treatySubTypeDTO !=null) {
                        subTypeId =  item.treatySubTypeDTO.id;
                    }

                    html += '<tr id="layerMndp_layer_'+SelectedMNDPFieldCount+'_Tr"><td><select class="form-control" id="businessclass_layerMndp_layer_'+SelectedMNDPFieldCount+'" name="businessclass_layerMndp_layer_'+SelectedMNDPFieldCount+'" >';
                    html += getBusinessClassWithSelected(BusinessClass,business) +'</select></td>';
                    html += '</select></td><td><select class="form-control" id="treatySubType_layerMndp_layer_'+SelectedMNDPFieldCount+'" name="treatySubType_layerMndp_layer_'+SelectedMNDPFieldCount+'">';

                    html += getTreatySubTypeWithSelected(TreatySubTypes,subTypeId) +'</select></td>';
                    html += '<td><input class="form-control" type="text" value="'+item.mndp+'" name="mndp_layerMndp_layer_'+SelectedMNDPFieldCount+'" id="mndp_layerMndp_layer_'+SelectedMNDPFieldCount+'" placeholder="Enter M&DP 100%"></td>'+
                        // '<td><input class="form-control" type="text" value="'+item.prcShareRate+'" name="PRCLSharerate_layerMndp_layer_'+SelectedMNDPFieldCount+'" id="PRCLSharerate_layerMndp_layer_'+SelectedMNDPFieldCount+'" placeholder="Enter PRCL Share rate"></td>'+
                        '<td><div class="form-group input-group"><input class="form-control" value="'+item.prcShareValue+'" type="text" name="PRCLSharevalue_layerMndp_layer_'+SelectedMNDPFieldCount+'" id="PRCLSharevalue_layerMndp_layer_'+SelectedMNDPFieldCount+'" placeholder="Enter PRCL Share value (calculated)">&nbsp;' +
                        '<button  id="PRCLSharevalue_layerMndp_layerBtn_'+SelectedMNDPFieldCount+'" onclick="CalculationlayerMndp('+SelectedMNDPFieldCount+')" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">=</button></div></td>' +
                        '<td><input type="hidden" value="'+item.id+'"  name="layerMndpid_'+SelectedMNDPFieldCount+'" id="layerMndpid_'+SelectedMNDPFieldCount+'" >' ;


                    if(SelectedMNDPFieldCount > 1)
                    {
                        html += '<a href="javascript:void(0)" onclick="RemoveMe(\'#layerMndp_layer_'+SelectedMNDPFieldCount+'_Tr\')">Delete (X)</a>';
                    }
                    html += '</td><tr>';

                    ++SelectedMNDPFieldCount;
                });
                $("#MNDP_layerRows").val(SelectedMNDPFieldCount);
                $('#AppendAblelayerMndpTr').html(html);


            }


        }


        function DefaultLayoutPRCShare()
        {

            html = '<tr><td><select class="form-control" id="businessclass_PrcShare_layer_1" name="businessclass_PrcShare_layer_1" >';
            html += BusinessClassOptions;
            html += '</select></td><td><select class="form-control" id="treatySubType_PrcShare_layer_1" name="treatySubType_PrcShare_layer_1">';
            html += TreatySubTypesOptions;
            html += '</select></td><td><input class="form-control" type="text" name="GNPIActual_PrcShare_layer_1" id="GNPIActual_PrcShare_layer_1" placeholder="Enter GNPI(Actual)"></td>'+
                '<td><input class="form-control" type="text" name="GNPIRevised_PrcShare_layer_1" id="GNPIRevised_PrcShare_layer_1" placeholder="Enter GNPI(Revised)"></td>'+
                '<td><input class="form-control" type="text" name="GNPIEstimated_PrcShare_layer_1" id="GNPIEstimated_PrcShare_layer_1" placeholder="Enter GNPI(Estimated)"></td>'+
                // '<td><input class="form-control" type="text" name="PRCLSharerate_PrcShare_layer_1" id="PRCLSharerate_PrcShare_layer_1" placeholder="Enter PRCL Share rate"></td>'+
                '<td><div class="form-group input-group"><input  required class="form-control" type="text" name="PRCLSharevalue_PrcShare_layer_1" id="PRCLSharevalue_PrcShare_layer_1" placeholder="Enter PRCL Share value (calculated)">&nbsp;' +
                '<button  id="PRCLSharevalue_PrcShare_layerBtn_1" onclick="CalculationPRCLShere(1)" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">=</button></div><td>' +
                '<td></td><tr>';
            $('#AppendAblePrcShareTr').html(html);

        }

        function DefaultLayoutlayerMndp()
        {


            html = '<tr><td><select class="form-control" id="businessclass_layerMndp_layer_1" name="businessclass_layerMndp_layer_1" >';
            html += BusinessClassOptions;
            html += '</select></td><td><select class="form-control" id="treatySubType_layerMndp_layer_1" name="treatySubType_layerMndp_layer_1">';
            html += TreatySubTypesOptions;
            html += '</select></td><td><input class="form-control" type="text" name="mndp_layerMndp_layer_1" id="mndp_layerMndp_layer_1" placeholder="Enter M&DP 100%"></td>'+
                // '<td><input class="form-control" type="text" name="PRCLSharerate_layerMndp_layer_1" id="PRCLSharerate_layerMndp_layer_1" placeholder="Enter PRCL Share rate"></td>'+
                '<td><div class="form-group input-group"><input  required class="form-control" type="text" name="PRCLSharevalue_layerMndp_layer_1" id="PRCLSharevalue_layerMndp_layer_1" placeholder="Enter PRCL Share value (calculated)">&nbsp;' +
                '<button  id="PRCLSharevalue_layerMndp_layerBtn_1" onclick="CalculationlayerMndp(1)" type="button" style="cursor: pointer;" class="btn btn-success tx-12 tx-uppercase tx-spacing-2">=</button></div><td>' +
                '<td></td><tr>';

            $('#AppendAblelayerMndpTr').html(html);
        }

        if(TypeOfEndorsement !='' && TypeOfEndorsement =='NonFinancial')
        {
            $(".Financial").attr("readonly",true);
        }
        if(TypeOfEndorsement !='' && TypeOfEndorsement =='Financial')
        {
            $(".NonFinancial").attr("readonly",true);
            _egnpi();
            _epi();
        }

         

        $( document ).ready(function() {
            $('#treatySubTypes').change(function(){ 
                $('#treatySubTypes_layer').val($(this).val()).change();
            });
            $('#business_class').change(function(){ 
                    $('#layer_business_class').val($(this).val()).change();
                    $('#section_business_class1').val($(this).val()).change();
            });
        });

        LoadTreatyLayers(TreaterId);
        LoadTreatyLayerReinstatement(TreaterId);
        LoadTreatySections(TreaterId);
        LoadTreatySectionsClasses(TreaterId);
        LoadTreatySlidingScales(TreaterId,ObjSlidingScale);


        function ShowHideToggle(ShowContainerId)
        {

            $('#PremiumContainer').hide();
            $('#LayerContainer').hide();

            $('#' + ShowContainerId).show();
        }

        function ShowHideToggleTreaty(ShowContainerId)
        {
            $('#TreatyLimitContainer').hide();
            $('#TreatyLayerContainer').hide();

            $('#' + ShowContainerId).show();
        }
        $('#wizard1').steps({
            headerTag: 'h3',
            bodyTag: 'section',
            autoFocus: true,
            titleTemplate: '<span class="number">#index#</span> <span class="title">#title#</span>',
            //onStepChanging: function (event, currentIndex, newIndex)
            //{
            //    //change color of the Go button
            //    $('.actions > ul > li:last-child a').css('background-color', '#f89406');
            //    var NewPageName = $("#wizard1-t-"+newIndex+" .title").text();
            //
            //    if( NewPageName !="Layers" && NewPageName !="General" )
            //    {
            //        LoadTreatySlipStepsServices('<?php //echo base_url();?>//',NewPageName);
            //    }
            //    return true;
            //},
        });
        // Datepicker
        $('.fc-datepicker').datepicker({
            showOtherMonths: true,
            selectOtherMonths: true
        });
        var Index = 3;
        var Index_2 = 3;
        function RemoveMe(ContainerId)
        {
            $(ContainerId).remove()
        }


        jQuery(document).on("click", ".reinstatement_div_delete", function () {
            $(this).parent().parent().parent().remove();
        });



        jQuery(document).on("click", ".premium_div_delete", function () {
            $(this).parent().parent().parent().remove();
        });

        $("#payment_terms").change(function () {
            var get_value = $(this).val(); 
            if (get_value != "") {
                var d = new Date();
                var month = d.getMonth();
                var day = d.getDate();
                var year = d.getFullYear();


                $(".payment_terms_desc").empty();
                var html = '<div class="row">';


                if (get_value == "manual") {
                    html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_1" name="date_from_1" > </div></div>' +
                            '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_1" name="date_to_1" ></div></div> <a style="line-height: 6.6;" class="add_more" href="javascript:void(0)">Add More</a><div class="clear"></div>';



                }
                else  if (get_value == "bi_annually") {

                    var counter = 1;
                    for (i = 1; i <= 2; i++) {
                        month = d.getMonth() + counter;
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_' + i + '" name="date_from_' + i + '" > </div></div>' +
                             '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_' + i + '" name="date_to_' + i + '" ></div></div><div class="clear"></div>';
                        counter++;
                    }

                }
                else  if (get_value == "monthly") {

                    var counter = 1;
                    for (i = 1; i <= 12; i++) {
                        month = d.getMonth() + counter;
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_' + i + '" name="date_from_' + i + '" > </div></div>' +
                            '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_' + i + '" name="date_to_' + i + '" ></div></div><div class="clear"></div>';
                        counter++;
                    }

                }
                else  if (get_value == "quarterly") {

                    var counter = 1;
                    for (i = 1; i <= 4; i++) {
                        month = d.getMonth() + counter;
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_' + i + '" name="date_from_' + i + '" > </div></div>' +
                            '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_' + i + '" name="date_to_' + i + '" ></div></div><div class="clear"></div>';
                        counter++;
                    }

                }
                else  if (get_value == "yearly") {

                    var counter = 1;
                    for (i = 1; i <= 1; i++) {
                        month = d.getMonth() + counter;
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_' + i + '" name="date_from_' + i + '" > </div></div>' +
                                '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_' + i + '" name="date_to_' + i + '" ></div></div><div class="clear"></div>';
                        counter++;
                    }

                }

                html += '</div>';
                $(".payment_terms_desc").append(html);
            }
        });

        fieldCounter = 2;
        $(document.body).on('click', ".add_more", function (e)
        {
            var html = '<div class="row">';
            html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_'+fieldCounter+'" name="date_from_'+fieldCounter+'"> </div></div>' +
                    '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_'+fieldCounter+'" name="date_to_'+fieldCounter+'"></div></div> <a style="line-height: 6.6;" class="tx-danger delete_filed" href="javascript:void(0)"><u><b>Delete (X)</b></u></a><div class="clear"></div>';
            html += '</div>';
            $(".payment_terms_desc").append(html);
            fieldCounter++;
        });

        $(document).on("click", ".delete_filed", function () {
            $(this).parent().remove();
        });


        $("#payment_terms_layer").change(function () {
            var get_value = $(this).val();
            if (get_value != "") {
                var d = new Date();
                var month = d.getMonth();
                var day = d.getDate();
                var year = d.getFullYear();


                $(".payment_terms_desc_layer").empty();
                var html = '<div class="row">';


                if (get_value == "manual") {
                    html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_1_layer" name="date_from_1_layer" > </div></div>' +
                        '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_1_layer" name="date_to_1_layer" ></div></div> <a style="line-height: 6.6;" class="add_more_layer" href="javascript:void(0)">Add More</a><div class="clear"></div>';



                }
                else  if (get_value == "bi_annually") {

                    var counter = 1;
                    for (i = 1; i <= 2; i++) {
                        month = d.getMonth() + counter;
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_' + i + '_layer" name="date_from_' + i + '_layer" > </div></div>' +
                            '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_' + i + '_layer" name="date_to_' + i + '_layer" ></div></div><div class="clear"></div>';
                        counter++;
                    }

                }
                else  if (get_value == "monthly") {

                    var counter = 1;
                    for (i = 1; i <= 12; i++) {
                        month = d.getMonth() + counter;
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_' + i + '_layer" name="date_from_' + i + '_layer" > </div></div>' +
                            '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_' + i + '_layer" name="date_to_' + i + '_layer" ></div></div><div class="clear"></div>';
                        counter++;
                    }

                }
                else  if (get_value == "quarterly") {

                    var counter = 1;
                    for (i = 1; i <= 4; i++) {
                        month = d.getMonth() + counter;
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_' + i + '_layer" name="date_from_' + i + '_layer" > </div></div>' +
                            '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_' + i + '_layer" name="date_to_' + i + '_layer" ></div></div><div class="clear"></div>';
                        counter++;
                    }

                }
                else  if (get_value == "yearly") {

                    var counter = 1;
                    for (i = 1; i <= 1; i++) {
                        month = d.getMonth() + counter;
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_' + i + '_layer" name="date_from_' + i + '_layer" > </div></div>' +
                            '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_' + i + '_layer" name="date_to_' + i + '_layer" ></div></div><div class="clear"></div>';
                        counter++;
                    }

                }

                html += '</div>';
                $(".payment_terms_desc_layer").append(html);
            }
        });

        function GetPaymentRanges(ObjData,ShowRangesDivIdClass,TypeOfEndorsement='')
        {
            if(TypeOfEndorsement !='' && TypeOfEndorsement =='NonFinancial')
            {
                TypeOfEndorsement = ' readonly="true"';
            }

            var html = '<div class="row">';
            if(ObjData !='')
            {
                var counter =1;
                for (var i = 0;i < ObjData.length;i++)
                {
                        paymentTermFrom =  moment(Date.parse(ObjData[i].paymentTermFrom)).format('YYYY-MM-DD');
                        paymentTermTo = moment(Date.parse(ObjData[i].paymentTermTo)).format('YYYY-MM-DD');
                        paymentTermRangeId =  ObjData[i].id;

                        html +=' <input type="hidden" name="paymentTermRangeId_' +counter+'_layer"  value="'+paymentTermRangeId+'">';
                        html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" '+TypeOfEndorsement+' id="date_from_' +counter+ '" name="date_from_' +counter+'_layer"  value="'+paymentTermFrom+'"> </div></div>';
                        html += '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" '+TypeOfEndorsement+' id="date_to_'+counter+'" name="date_to_'+counter+'_layer" value="'+paymentTermTo+'"></div></div><div class="clear"></div>';
                    
                        counter++;
                }

            }
            html += '</div>';
            $(ShowRangesDivIdClass).html(html);

        }

        fieldCounter_layer = 2;
        $(document.body).on('click', ".add_more_layer", function (e)
        {
            var html = '<div class="row">';
            html += '<div class="col-lg-4"><div class="form-group"><label class="form-control-label">From</label><input class="form-control" type="date" id="date_from_'+fieldCounter+'_layer" name="date_from_'+fieldCounter+'_layer"> </div></div>' +
                '<div class="col-lg-4"><div class="form-group"> <label class="form-control-label">To</label><input class="form-control" type="date" id="date_to_'+fieldCounter+'_layer" name="date_to_'+fieldCounter+'_layer"></div></div> <a style="line-height: 6.6;" class="tx-danger delete_filed" href="javascript:void(0)"><u><b>Delete (X)</b></u></a><div class="clear"></div>';
            html += '</div>';
            $(".payment_terms_desc_layer").append(html);
            fieldCounter_layer++;
        });




        function getNumberWithOrdinal(n) {
            var s = ["th", "st", "nd", "rd"],
                v = n % 100;
            return n + (s[(v - 20) % 10] || s[v] || s[0]) + " LAYER";
        }

        function getNumberWithOrdinal_section(n) {
            var s = ["th", "st", "nd", "rd"],
                v = n % 100;
            return n + (s[(v - 20) % 10] || s[v] || s[0]) + " SECTION";
        }




        $(document).on("click", ".edit_btn_re", function () {
            $('#modalwindow1').modal('show');
        });

        $(document).on("click", ".section_classes", function () {
            $('#modalwindow2').modal('show');
        });




        $('#egnpi').click(function () {
            _egnpi();
        });

        function _egnpi()
        {
            if ($("#egnpi").prop("checked") == true) {
                $(".egnpi_field").attr("readonly", false);
                $(".egnpi_field").attr("required", true);
                $(".egnpi_field").attr("number", true);
            } else if ($("#egnpi").prop("checked") == false) {
                $(".egnpi_field").attr("readonly", true);
                $(".egnpi_field").attr("required", false);
                $(".egnpi_field").attr("number", false);
                $(".egnpi_field_error .help-block").hide();

            }
        }

        $('#epi').click(function () {
            _epi();
        });

        function _epi()
        {
            if ($('#epi').prop("checked") == true) {
                $(".epi_field").attr("readonly", false);
                $(".epi_field").attr("required", true);
                $(".epi_field").attr("number", true);
            } else if ($('#epi').prop("checked") == false) {
                $(".epi_field").attr("readonly", true);
                $(".epi_field").attr("required", false);
                $(".epi_field").attr("number", false);
                $(".epi_field_error .help-block").hide();
            }
        }
        // THis Calculation Formula For Treaty Layer
        $(".prcmaxliability").click(function () {

            // PRC MAX Liability	(Treaaty limit * PRC Share %)/100
            var treaty_limit = $(".treaty_limit").val();
            var prc_share_percent = $(".prc_share_percentage").val(); 
            $(".prcmaxliability_layers").val((treaty_limit * prc_share_percent) / 100);


        });
        // THis Calculation Formula For Treaty Section Classis
        $("#prcmaxliability_sectionBtn").click(function () { 
            var treaty_limit = $("#treatyLimit_field").val();
            var prc_share_percent = $("#SectionClass_prcShare").val(); 
            $("#prcMaxLiability_field").val((treaty_limit * prc_share_percent) / 100);
        });


        $(".mdp").click(function () {
            // Layer 2
            // Minimum Deposit Premium (PRC Share)*	(MDP 100% * PRC Share %)/100
            var mdp_100_percent = $("#mdp_100_percentage").val();
            var prc_share_percent = $(".prc_share_percentage").val();
            $("#mdp_field").val((mdp_100_percent * prc_share_percent) / 100);


        });


        $(".epi_prc").click(function () {
            // Section 1
            // EPI PRC = 	(EPI 100% * PRC Share %)/100
            var epi_100_percentage = $(".epi_100_percentage").val();
            var prc_share_percent = $(".prc_share_percentage_section").val();
            $(".epi_prc_section").val((epi_100_percentage * prc_share_percent) / 100);


        });

        $("#calculatedGNPIBtn").on("click",function () {
            var MinRate = $("#minRates").val();
            var EstimatedGnpi = $("#estimatedGnpi").val();
            $("#calculatedGNPI").val(MinRate * EstimatedGnpi);

        });

        $("#excessLimitBtn").on("click",function () {
            var MaxRate = $("#maxRates").val();
            var EstimatedGnpi = $("#estimatedGnpi").val();
            $("#excessLimit").val(MaxRate * EstimatedGnpi);

        });

        $("#prcShareValueBtn").on("click",function () {
            var cashLossValue = $("#cashLossValue").val();
            var prcShareRate = $("#prcShareRate").val();
            $("#prcShareValue").val(cashLossValue * prcShareRate);

        });

        $("#riCommissionBtn").on("click",function () {
            var riRate = $("#reinsuranceCommissionRateSurplus").val();
            var premium = $("#premium").val();
            $("#riCommission").val(riRate * premium);

        });

        $("#PRCLShare_section_quotaBtn").on("click",function () {
            var Value = $("#value_section_quota").val();
            var prcShare_percentage = $("#prcShare_percentage_quota").val();
            $("#PRCLShare_section_quota").val(Value * prcShare_percentage);

        });

        $("#PRCLShare_section_surplusBtn").on("click",function () {
            var Value = $("#value_section_surplus").val();
            var prcShare_percentage = $("#prcShare_percentage_surplus").val();
            $("#PRCLShare_section_surplus").val(Value * prcShare_percentage);

        });

        $("#egnpi_prcShareBtn").on("click",function () {
            var prcShare = $("#prcShare_general").val();
            var egnpiActual = $("#egnpiActual").val();
            $("#egnpi_prcShare").val(prcShare * egnpiActual);

        });

    

        $("#reInsurerLiabilityPrcShareBtn").on("click",function () {
            var reInsurerLiability = $("#section_reInsurerLiability").val();
            var prcShareRate = $("#section_prcShareRateQuota").val();
            $("#section_reInsurerLiabilityPrcShare").val(reInsurerLiability * prcShareRate / 100);

        });

        $("#SectionClass_epiPrc_fieldBtn").on("click",function () {
            var epi = $("#SectionClass_epi_field").val();
            var prcShare = $("#SectionClass_prcShare").val();
            $("#SectionClass_epiPrc_field").val(epi * prcShare / 100);

        });

        $("#section_prcShareValueBtn").on("click",function () {
            var treatySubLimit = $("#treatySubLimit").val();
            var prcShareRate = $("#section_prcShareRate").val();
            $("#section_prcShareValue").val(treatySubLimit * prcShareRate / 100);

        });

        $("#claPrcShareValueBtn").on("click",function () {
            var CLA = $("#cashLossRate").val();
            var prcShareRate = $("#prcShareRate").val();
            $("#claPrcShareValue").val(CLA * prcShareRate / 100);

        });

        $("#plaPrcShareValueBtn").on("click",function () {
            var PLA = $("#cashLossValue").val();
            var prcShareRate = $("#prcShareRate").val();
            $("#plaPrcShareValue").val(PLA * prcShareRate / 100);

        });

       

        $("#Rate_Type").on("change",function(){

            var Rate_Type = $(this).val().split('|');
            var RateTypeId = Rate_Type[0];
            var RateType_text = Rate_Type[1];
            var Currency = $("#currency").val().split('|');
            var CurrencyCode = Currency[0];
            var CurrencyId = Currency[1];


            if(RateType_text !='Fixed' )
            {
                $("#currency_rate").attr("readonly",true);
                $.ajax({
                    url:'<?php echo base_url("Treaty/Get_CurrencyRat");?>',
                    type: 'POST',
                    data:{"get_data":true,"CurrencyCode":CurrencyCode,"CurrencyId":CurrencyId,"RateTypeId":RateTypeId,'RateType':RateType_text},
                    dataType: 'json',
                    success: function (response)
                    {
                        if(response.code == 1)
                        {
                            var CurrencyRateId =  response.id ;
                            var Rate = parseFloat(response.rate).toFixed(2);
                            $("#currency_rateId").val(CurrencyRateId);
                            $("#currency_rate").val(Rate);
                            $("#currency_rate_error").hide();
                            $("#currency_rate ").closest(".help-block").hide();
                            $('span[for="currency_rate"]').hide()
                        }
                        else
                        {
                            $("#currency_rate").val('');
                            $("#currency_rate").attr("readonly",true);
                            $("#currency_rate_error").show();
                            $("#currency_rate_error").text('Please Ask admin to add This Currency in System');
                        }

                    }
                });
            }
            else
            {
                $("#currency_rate").attr("readonly",false);
                $("#currency_rateId").val(0);
                $("#currency_rate").val('');
                $("#currency_rate_error").hide();
            }

            $("#currency_RatType").val(RateType_text);

         });
        

        $(document).ready(function() {
            $("#layer_business_class").select2({ width: '100%' });
            $("#treatySubTypes_layer").select2({ width: '100%' });
            $("#section_treatySubTypes").select2({ width: '100%' });
            $("#slidingScale_treatySubTypes").select2({ width: '100%' });
            $("#section_business_class1").select2({ width: '100%' });
            $(".select2-search__field").css({ width: '100%' });
            $(".treatySlip_multiselect").select2({ width: '100%' });

        });



        $("#renewalTreatier").on("change",function ()
        {
            window.open($(this).val(),'_blank');

        });
 
        $("#SurplusLimitBtn").on("click",function () {
            var grossRetentionSurplus = $(".section_grossRetentionSurplus").val();
            var noOfLines = $(".section_noOfLines").val();
            $("#surplusLimit").val(grossRetentionSurplus * noOfLines); 

        });

    </script>
    
<?php
if(isset($action) && $action == "view_record"){ ?>

    <script>
        $('input').prop('disabled', true);
        $('select').prop('disabled', true);
        $('textarea').prop('disabled', true);

    </script>

<?php } ?>