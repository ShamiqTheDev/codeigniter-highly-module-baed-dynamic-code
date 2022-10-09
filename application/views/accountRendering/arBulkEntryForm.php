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
            <span class="breadcrumb-item active">Accounts Rendering</span>
        </nav>
    </div>






    <div class="row">
        <div class="col-sm-12">
            <div class="pd-30 form-heading-container" style="">
                <h4 class="tx-gray-800 mg-b-5 form-heading">Accounts Rendering</h4>
                <p class="mg-b-0"></p>
            </div>
        </div>
    </div><br>
    <div class="pd-30">
        <?php
        echo form_open(current_url(), array('class' => 'form-horizontal', 'role' => 'searchform', 'id' => 'searchform'));
        ?>
        <div class="br-section-wrapper">
            <div class="bg-gray-100 bd pd-x-20 pd-t-20-force pd-b-10-force">
                <div class="row">

                    <div class="col-lg-4">
                        <div class="form-group form-validate mg-b-10-force">
                            <label class="form-control-label">Cedent</label>
                            <select class="form-control select2 " name="cedentId" id="cedentId">
                                <option value="">Select Cedent</option>
                                <?php foreach ($cedents as $cedent){ ?>
                                    <option value="<?=$cedent->id?>"><?=$cedent->customerName?></option>
                                <?php } ?>
                            </select> 
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group form-validate mg-b-10-force">
                            <label class="form-control-label">Treaty Type</label>
                            <select class="form-control select2" name="treatyTypeId" id="treatyTypeId">
                                <option value="">Select Treaty Type</option>
                                <?php foreach ($tTypes as $tType){ ?>
                                    <option value="<?=$tType->id?>"><?=$tType->type?></option>
                                <?php } ?>
                            </select> 
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group form-validate mg-b-10-force">
                            <label class="form-control-label">Business</label>
                            <select class="form-control select2 " name="businessId" id="businessId">
                                <option value="">Select Business</option>
                                <?php foreach ($bClasses as $bClass){ ?>
                                    <option value="<?=$bClass->id?>"><?=$bClass->name?></option>
                                <?php } ?>
                            </select> 
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group form-validate mg-b-10-force">
                            <label class="form-control-label">Treaty Year</label>
                            <input class="form-control" type="text" name="treatyYear" id="treatyYear" placeholder="Enter Treaty Year">
                        </div>
                    </div>
                    <div class="col-lg-4" style="margin: 29px 0px 0px 0px;">
                        <input type="reset" value="Reset" class="btn btn-success" onclick="form_reset();">
                        <a href="<?=base_url();?>" class="btn btn-success">Exit</a>
                    </div>
                    <div class="col-lg-4">
                        <div class="pd-t-30-force">
                            <button type="submit" id="search" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 search pull-right" name="search"><a>Search</a></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        echo form_close();
        ?>
    </div>
    <div class="br-pagebody mg-t-5 pd-x-30">
        <div class="br-section-wrapper section-wrapper-shadow">


            <div id="wizard1">
                <section>
                    <?php
                    $attributes = array('class' => 'form-horizontal', 'role' => 'create_form', 'id' => 'create_form');
                    echo form_open_multipart(current_url(), $attributes);
                    ?>

                    <!-- <h3>Account Rendering Uploaded Data</h3> -->
                    <div class="table-wrapper1 table-responsive1" style="overflow-y: scroll;">
                        <input type="hidden" name="bulkEntry" value="1">
                        <table id="table-data" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Slip Name</th>
                                <th>uw Year</th>
                                <th>PRC Year</th>
                                <th>PRC Qtr</th>
                                <th>prc Share</th>
                                <th>DEPT.</th>
                                <th>Business Class</th>
                                <th>reins Arr</th>
                                <th>treaty Code</th>
                                <th>cedent Code</th>
                                <th>cedent name</th>
                                <th>broker Code</th>
                                <th>broker name</th>
                                <th>broker Code Ref No.</th>
                                <th>co Qtr.</th>
                                <th>co Year</th>
                                <th>identity Insured</th>
                                <th>type Risk</th>
                                <th>cur Type</th>
                                <th>cur Code</th>
                                <th>premium</th>
                                <th>commission</th>
                                <th>or Commission</th>
                                <th>brokerAge</th>
                                <th>profit Commission</th>
                                <th>xl Premium</th>
                                <th>losses Paid</th>
                                <th>premium Res W Held</th>
                                <th>premium Res Reles</th>
                                <th>interest On Pl Res</th>
                                <th>taxes</th>
                                <th>losses Res W Held</th>
                                <th>losses Res Reles</th>
                                <th>cash Loss W Held</th>
                                <th>cash Loss Reles</th>
                                <th>cash Loss Refund</th>
                                <th>exchange Difference</th>
                                <th>port Premium</th>
                                <th>port Losses</th>
                                <th>misc. Charges</th>
                                <th>balance</th>

                                <th>Dr/Cr</th>
                                <th>A/c Rendering Type</th>
                                <th>Treaty Type</th>

                                <th colspan="2">Action</th>
                            </tr>
                            </thead>

                            <tbody id="arTblForm">
                            </tbody>

                        </table>
                        <div class="pd-b-20-force">
                            <button type="submit" id="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2 submit" name="submit">Submit</button>
                        </div>
                    </div>

<!-- This is file upload section will be enabled after confirming form BA -->
<!--                     <div class="br-section-wrapper">
                        <div class="row" id="ActionMsgDiv" >
                            <div class="col-lg-12" id="ActionMsg">
                            </div>
                        </div>
                        <div class="row  mg-b-25">
                            <div class="col-sm-10">
                                <input type="file" id="data_file" name="data_file">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input  type="hidden" name="upload_account_rendering" value="true">
                                <input type="submit" class="btn btn-success tx-12 tx-uppercase tx-spacing-2"  name="SubmitBtn" value="Submit">
                            </div>
                        </div>
                    </div>
                    <br> -->


                    <?php
                    echo form_close();
                    ?>
                </section>
            </div>
        </div>

        <?php $this->load->view('includes/footer', $this->data); ?>
        <script>
            /*
                CONSTANTS
            */
            BASE_URL = '<?=base_url()?>';
            CURRENT_URL = '<?=current_url()?>';
        </script>
        <script src="<?php echo $includes_dir;?>lib/admin/accountRendering/bulk_entry_form.js"></script>
  
        <script>

        


        </script>



        <script>
            function form_reset()
            {
                $( "#businessId" ).val('').trigger('change');
                $( "#cedentId" ).val('').trigger('change');
                $( "#treatyTypeId" ).val('').trigger('change');
            }
        </script>