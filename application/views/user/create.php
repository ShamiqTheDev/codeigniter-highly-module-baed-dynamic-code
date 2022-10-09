<?php $this->load->view('includes/header', $this->data); ?>

<?php
$disabled = '';
if($action == "view_record"){
    $disabled = 'disabled';
}
?>
<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Users</span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Users</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>



    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper section-wrapper-shadow">


            <div id="wizard1">
                <?php
//                if($action == "add_record")
//                { print('<h3>Create new user account</h3>'); }
//                elseif($action == "view_record")
//                { print('<h3>View user account</h3>'); }
//                elseif($action == "edit_record")
//                { print('<h3>Edit user account</h3>'); }
                ?>


                <section>
                     <?php
                    $action_path = current_url();
                    if(isset($edit_record))
                    {
                        $action_path .= '/edit/'.base64_encode($response->id);
                    }

                    $attributes = array('class' => 'form-horizontal ', 'role' => 'create_form', 'id' => 'create_form');
                    echo form_open_multipart($action_path, $attributes);
                    ?>

                    <?php if (isset($response->id)){ ?>
                        <input type="hidden" name="id" value="<?php echo $response->id?>">
                    <?php } ?>
                    <div class="br-section-wrapper">

                        <div class="row mg-b-25">

                            <div class="col-lg-4">
                                <div class="form-group form-validate">
                                    <label class="form-control-label"><?=$this->lang->line('field_userName');?><span class="tx-danger">*</span></label>
                                    <input class="form-control" type="text" name="userName" maxlength="20" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $response->userName : ""; ?>" placeholder="<?=$this->lang->line('placehoder_userName');?>" <?php echo $disabled?>>
                                </div>
                            </div>
                            
                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label"><?=$this->lang->line('field_email');?> <span class="tx-danger">*</span> </label>
                                    <input class="form-control" type="email" name="email" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $response->email  : ""; ?>" placeholder="<?=$this->lang->line('placehoder_emailAddress');?>" <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label"><?=$this->lang->line('field_mobileNo');?> <span class="tx-danger">*</span> </label>
                                    <input class="form-control" type="text" name="mobileNo" value="<?php echo ($action == "edit_record" OR $action == "view_record") ? $response->mobileNo : ""; ?>" minlength="11" maxlength="11" placeholder="<?=$this->lang->line('placehoder_mobNo');?>" <?php echo $disabled?>>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label"><?=$this->lang->line('field_userImage');?></label>
                                     <?php if ($action == "edit_record" OR $action == "add_record") { ?> <input class="form-control" type="file" name="userImage">  <?php } ?>
                                    <?php if ($action == "view_record" OR $action == "edit_record") 
                                    {   
                                        // $newFileName = pathinfo($response->userImagePath, PATHINFO_BASENAME);
                                        $imgPath = 'uploads/'.$response->userImagePath;
                                        ?>
                                        <img src="<?php echo base_url($imgPath)?>" width="100" height="100" style="margin: 10px 0px 0px 0px;border: 1px solid #c1aaaa;">
                                        <?php 
                                    } 
                                    ?>
                                </div>
                            </div>


                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label"><?=$this->lang->line('field_password');?> <span class="tx-danger">*</span> </label>
                                    <input class="form-control" type="password" name="password" minlength="5" maxlength="12" placeholder="<?=$this->lang->line('placehoder_password');?> "  <?php echo $disabled?>>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label"><?=$this->lang->line('field_roleName');?> <span class="tx-danger">*</span> </label>
                                    
                                    <select class="form-control select2 roleOptions" name="roleDTO.id" <?php echo $disabled?>>
                                        <option value=""><?=$this->lang->line('placehoder_roleSelect');?></option>
                                        <?php
                                        foreach ($roles as $role)
                                        {

                                            $selected = '';
                                            if($role->id == $response->roleDTO->id)
                                            {
                                                $selected = 'selected';
                                            }
                                            if (!empty($role->name)) {
                                                print("<option value='".$role->id."' $selected> $role->name </option>");
                                            }

                                        } ?>
                                    </select>

                                </div>

                            </div>




                            <!-- form-layout-footer -->
                        </div>
                    </div><!-- form-layout -->
                    <br>
                    <?php if ($action =="edit_record" OR $action =="add_record"){ ?>
                    <button type="button" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 <?php echo ($action =="edit_record") ? "update_user" : "submitUser"; ?>"><?php echo ($action =="edit_record") ? "Update" : "Create"; ?></button>
                    <?php } ?>
                    
                    <?php
                    echo form_close();
                    ?>
                </section>	



            </div>

        </div>

        <?php $this->load->view('includes/footer', $this->data); ?>
        <script src="<?php echo $includes_dir;?>lib/select2/js/select2.min.js"></script>
        <script type="text/javascript">
            base_url = '<?php echo base_url()?>';
        </script>
        <script src="<?php echo $includes_dir;?>lib\admin\user\user_form.js"></script>

