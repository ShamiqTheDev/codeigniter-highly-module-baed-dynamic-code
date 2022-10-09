<?php $this->load->view('includes/header', $this->data); ?>


<div class="br-mainpanel">
    <div class="br-pageheader pd-y-15 pd-l-20">
        <nav class="breadcrumb pd-0 mg-0 tx-12">
            <a class="breadcrumb-item" href="#">Setup</a>
            <span class="breadcrumb-item active">Permission</span>
        </nav>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Permission</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>



    <div class="br-pagebody mg-t-5 pd-x-30">

        <div class="br-section-wrapper">


            <div id="wizard1">
                <h3>Create New Permission</h3>

                <section>
                    <?php
                    /* echo "<pre>";
                      print_r($response);
                      exit; */
                    $attributes = array('class' => 'form-horizontal', 'role' => 'create_form', 'id' => 'create_form');
                    echo form_open(current_url(), $attributes);
                    ?>
                    <div class="br-section-wrapper">

                        <div class="row mg-b-25">


                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label"><?=$this->lang->line('col_action');?> </label>
                                    <input class="form-control" type="text" name="action" value="<?php echo (isset($response->action)) ? $response->action : ""; ?>" placeholder="Delete">
                                    <?php if (isset($response->id)) { ?>
                                        <input type="hidden" name="id" value="<?php echo (isset($response->id)) ? $response->id : ""; ?>">    
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label"><?=$this->lang->line('col_roleName');?>  <span class="tx-danger">*</span> </label>

                                    <select class="form-control" name="moduleDTO.id">
                                        <option><?=$this->lang->line('col_roleName');?></option>
                                        <?php
                                        foreach ($modules as $module) {
                                            $select = activeInput('select', $module->id, @$response->moduleDTO->id);
                                            ?>
                                            <option value="<?php echo  $module->id ?>" <?php echo  $select ?>><?php echo  $module->name ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">Name </label>
                                    <input class="form-control" type="text" name="name" value="<?php echo (isset($response->name)) ? $response->name : ""; ?>" placeholder="Delete">
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="form-group form-validate mg-b-10-force">
                                    <label class="form-control-label">URL  </label>
                                    <input class="form-control" type="text" name="url" value="<?php echo (isset($response->url)) ? $response->url : ""; ?>" placeholder="delete/delete">
                                </div>
                            </div>

                            


                            <!-- form-layout-footer -->
                        </div>
                    </div><!-- form-layout -->
                    <br>
                    <?php if ($this->uri->segment(2) != "view") { ?>
                        <button type="button" class="<?php echo (isset($response->action)) ? "update_permission" : "create_permission"; ?> btn btn-success tx-12 tx-uppercase tx-spacing-2" onclick=""><?php echo (isset($response->action)) ? "Update" : "Create"; ?></button>
                    <?php } ?>

                    <?php
                    echo form_close();
                    ?>
                </section>	



            </div>

        </div>


        <?php $this->load->view('includes/footer_js', $this->data); ?>
        <script>
            base_url = '<?php echo base_url(); ?>';
        </script>
        <script src="<?php echo $includes_dir; ?>lib/admin/permission/create.js"></script>
        <?php $this->load->view('includes/footer', $this->data); ?>