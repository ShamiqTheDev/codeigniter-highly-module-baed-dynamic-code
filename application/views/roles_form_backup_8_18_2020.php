<?php $this->load->view('includes/header', $this->data); ?>


<?php
$disabled = '';
if($action == "view_record"){
    $disabled = 'disabled';
}
?>

<style>
    .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open>.dropdown-toggle.btn-default {
        color: #333;
        background-color: #e6e6e6;
        border-color: #adadad;
    }
    .toggle-handle {
        position: relative;
        margin: 0 auto;
        padding-top: 0px;
        padding-bottom: 0px;
        height: 100%;
        width: 0px;
        border-width: 0 1px;
    }
    .btn-default {
        color: #333;
        background-color: #fff;
        border-color: #ccc;
    }
</style>
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Roles</span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Roles</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>
    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="br-section-wrapper section-wrapper-shadow">


            <div id="wizard1">
                <!--                <h3>Create New Condition</h3>-->
                <section>
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'role' => 'create_form', 'id' => 'create_form');
                    echo form_open(current_url(), $attributes);
                    ?>
                    <div class="br-section-wrapper">

                        <div class="row mg-b-25">

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Role Name <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="name" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $data->name  : ""; ?>" placeholder="Enter Role Name" <?php echo $disabled?>>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Financial Limit <span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="financialLimit" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $data->financialLimit  : ""; ?>" placeholder="Enter Financial Limit" <?php echo $disabled?>>

                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Module <span class="tx-danger">*</span></label> 
                                    <select class="form-control select2"   data-placeholder="Choose Modules" id="moduleId" name="moduleId[]" multiple <?php echo $disabled?>>
            
                                        <?php
                                        $selectedModuleId =array();
                                        foreach($Modules as $key => $Module)
                                        {
                                            $selected ='';
                                            if(isset($data))
                                            {
                                                foreach($data->moduleDTOS as $key => $data_module)
                                                {
                                                    if($data_module->isCheckedfront == true && $data_module->moduleName == $Module->moduleName) {
                                                        $selected = 'selected';
                                                        $selectedModuleId["moduleId[]"] = $data_module->id;
                                                    }
                                                }

                                            }
                                            print('<option value="'.$Module->id.'" '.$selected.'>'.$Module->moduleName.'</option>');
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Description <span class="tx-danger">*</span></label>
                                    <textarea class="form-control" name="description"  placeholder="Enter Description" <?php echo $disabled?>><?php echo ($action == "edit_record" OR $action == "view_record") ? $data->description  : ""; ?></textarea>

                                </div>
                            </div>
                            <div id="Permissions_Wrapper"></div>


<!--                            --><?php //if(isset($Permissions) && count($Permissions) > 0)
//                            {
//                                $counter = 1;
//                                foreach ($Permissions as $key => $value)
//                                {
//
//                                    $isChecked ='';
//                                    if(isset($data))
//                                    {
//                                        foreach($data->moduleDTOS as $data_module)
//                                        {
//                                            if($data_module->isCheckedfront == true)
//                                            {
//                                                if(is_array($data_module->permissionDTOList)){
//                                                    foreach($data_module->permissionDTOList as $permission)
//                                                    {
//                                                        if($permission->isChecked != 0 && $permission->isChecked != false && $permission->id == $value->id )
//                                                        {
//                                                            $isChecked = 'Checked';
//                                                        }
//                                                    }
//                                                }
//
//
//                                            }
//                                        }
//
//                                    }
//
//                                    if($counter == 1)
//                                      echo '<div class="row" style="margin: 10px 0px 10px 0px;">';
//
                                    ?>
<!---->
<!--                                    <div style="width: 280px;margin: 0px 0px 0px 0px;">-->
<!--                                        <div class="checkbox">-->
<!--                                                <input type="checkbox" name="permission[]" --><?//=$isChecked;?><!-- data-toggle="toggle" value="--><?//=$value->id;?><!--" --><?//=$disabled?>
                                            <!--<label class="form-control-label">--><?php //echo $value->name;?><!--</label>-->
<!--                                        </div>-->
<!--                                     </div>-->
<!---->
<!---->
<?php
//                                    if($counter == 4)
//                                    {
//                                        echo '</div><br>'; $counter=0;
//
//                                    }
//                                    $counter++;
//                                }
//
//                            } ?>

                            <!-- form-layout-footer -->
                        </div>
                    </div><!-- form-layout -->
                    <br>
                    <?php if ($action =="edit_record"){ ?>
                        <input type="hidden" value="<?php echo base64_encode(json_encode($Permissions));?>" name="data">
                    <?php } ?>
                    <?php if ($action =="edit_record" OR $action =="add_record"){ ?>

                        <button type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2"><?php echo ($action =="edit_record") ? "Update" : "Create"; ?></button>
                    <?php } ?>

                    <?php
                    echo form_close();
                    ?>
                </section>



            </div>

        </div>

        <?php $this->load->view('includes/footer', $this->data); ?>
        <script src="<?php echo base_url('assets\lib\select2\js\select2.min.js')?>" ></script>
        <script>
            var action = '<?php echo $action;?>';
            var disabled = '<?php echo $disabled?>';
            var SelectedModuleId = $("#moduleId").val();
            var RoleData = '<?php if(isset($data)){ echo json_encode($data); } else { echo ''; }?>';
 
            if (action == "edit_record" || action == 'view_record')
            { 
                RoleData = JSON.parse(RoleData);


                LoadPermissionsByModule(SelectedModuleId,RoleData,disabled);
            }

           $("#moduleId").on("change",function () {

               LoadPermissionsByModule($(this).val());
           });

           function LoadPermissionsByModule(SelectedModuleId,LoadedRoleData='',disabled='')
           {
               $.ajax({
                   url:'<?php echo base_url("Permission/LoadPermissionsByModule");?>',
                   type: 'POST',
                   data:{moduleId:SelectedModuleId },
                   dataType: 'json',
                   success: function (response)
                   {
                       if(response.status =='true')
                       {
                           var sHtml = '';
                        
                           
                           $.each(response.Permissions, function(index, ModuleDTOList)
                           { 
                                
                               sHtml +='<h3 style="margin: 10px 0px 0px 0px;">'+ModuleDTOList.moduleName+'</h3>';
                               sHtml +='<div class="row" style="padding: 15px; ">';
                              
                               var counter = 1;
                             
                               $.each(ModuleDTOList.permissionDTOList, function(index, subData)
                                {
                                    
                                    var isChecked ='';
                                    if(LoadedRoleData !='')
                                    {
                                        $.each(LoadedRoleData.moduleDTOS, function(index, data_module)
                                        {
                                            if(data_module.isCheckedfront == 'true')
                                            {

                                                if(Array.isArray(data_module.permissionDTOList))
                                                {

                                                    $.each(data_module.permissionDTOList, function(index, permission)
                                                    {

                                                        if(permission.isChecked != 0 && permission.isChecked == true && permission.id == subData.id )
                                                        {
                                                            isChecked = 'Checked';

                                                        }
                                                    });


                                                }


                                            }
                                        });
                                    }

                                    sHtml +='<div  class="col-md-4" >\n' +
                                      ' <input type="checkbox" name="permission[]"  data-toggle="toggle" '+disabled+' '+isChecked+' value="'+ModuleDTOList.id+'_'+subData.id+'" style="margin: 5px; "><label class="form-control-label">'+subData.name+'</label> </div>';

                                     counter++;
                                });

                                sHtml += '</div><br>';
                              
                           });
                          
                           $("#Permissions_Wrapper").html(sHtml);
                       }else{
                            $("#Permissions_Wrapper").html("<p>The Module does not have any permissions</p>");
                       }


                   }
               });
           }

            jQuery(document).ready(function () {
                FormValidator.init();
                $('#toggle-two').bootstrapToggle({
                    on: 'Yes',
                    off: 'No'
                });
            });
            var FormValidator = function () {

                var AddRecordValidation = function () {
                    var form1 = $('#create_form');
                    var errorHandler1 = $('.errorHandler', form1);
                    var successHandler1 = $('.successHandler', form1);
                    $('#create_form').validate({
                        errorElement: "span", // contain the error msg in a span tag
                        errorClass: 'help-block',
                        errorPlacement: function (error, element)
                        {
                            error.insertAfter(element);
                        },
                        ignore: "",
                        rules: {
                            name : {
                                required: true
                            },
                            financialLimit : {
                                required: true
                            },
                            moduleId: {
                                required: true
                            },
                            description : {
                                required: true
                            }



                        },
                        messages: {
                        },
                        invalidHandler: function (event, validator) { //display error alert on form submit
                            successHandler1.hide();
                            errorHandler1.show();
                        },
                        highlight: function (element) {
                            $(element).closest('.help-block').removeClass('valid');
                            $(element).closest('.form-validate').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                        },
                        unhighlight: function (element) {
                            $(element).closest('.form-validate').removeClass('has-error');
                        },
                        success: function (label, element) {
                            label.addClass('help-block valid');
                            $(element).closest('.form-validate').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
                        },
                        submitHandler: function (form)
                        {
                            successHandler1.show();
                            errorHandler1.hide();
                            $('#confirmationModal_once').modal('show');

                            $("#confirmed").on("click",function(){
                                AddRecord();
                            });

                            $("#close_alert").on("click",function(){
                                $('#create_form :input[type=submit]').attr('disabled',false);
                            });
                            return false;
                        }
                    });

                };
                return {
                    init: function () {
                        AddRecordValidation();
                    }
                };
            }();
        </script>

