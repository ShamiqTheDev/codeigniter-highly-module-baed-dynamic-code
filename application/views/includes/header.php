 <!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Pakistan Reinsurance Company Limited">

    <title>Pakistan Reinsurance Company Limited</title>

    <!-- vendor css -->
    <link href="<?php echo $includes_dir;?>lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/jquery-switchbutton/jquery.switchButton.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/rickshaw/rickshaw.min.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/chartist/chartist.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/highlightjs/github.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/jquery.steps/jquery.steps.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/select2/css/select2.min.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/jt.timepicker/jquery.timepicker.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/jquery.steps/jquery.steps.css" rel="stylesheet">
    <link href="<?php echo $includes_dir;?>lib/jquery-toggles-checkbox/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- Bracket CSS -->
    <link href="<?php echo $includes_dir;?>css/bracket.css" rel="stylesheet">
    <!-- New Main Css For Website -->
    <link href="<?php echo $includes_dir;?>css/main.css" rel="stylesheet">
    <script>
        BASE_URL  = '<?=base_url()?>';
        SEGMENT_1 = '<?=$this->uri->segment(1)?>';
        SEGMENT_2 = '<?=$this->uri->segment(2)?>';
        SEGMENT_3 = '<?=$this->uri->segment(3)?>';
        SEGMENT_4 = '<?=$this->uri->segment(4)?>';
        DEBUG     = '<?=$this->config->item('js_debug')?>';
    </script>
  </head>

  <body class="collapsed-menu">

    <?php $this->load->view('includes/sidebar', $this->data);?>

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="br-header">
      <div class="br-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="input-group hidden-xs-down wd-170 transition">
          <input id="searchbox" type="text" class="form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
          </span>
        </div><!-- input-group -->
      </div><!-- br-header-left -->
      <div class="br-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link pd-x-7 pos-relative" data-toggle="dropdown">
              <i class="icon ion-ios-bell-outline tx-24"></i>
              <!-- start: if statement -->
              <span class="square-8 bg-danger pos-absolute t-15 r-5 rounded-circle"></span>
              <!-- end: if statement -->
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-300 pd-0-force">
              <div class="d-flex align-items-center justify-content-between pd-y-10 pd-x-20 bd-b bd-gray-200">
                <label class="tx-12 tx-info tx-uppercase tx-semibold tx-spacing-2 mg-b-0">Notifications</label>
                <a href="" class="tx-11">Mark All as Read</a>
              </div><!-- d-flex -->

              <div class="media-list">
                <!-- loop starts here -->
                <a href="" class="media-list-link read">
                  <div class="media pd-x-20 pd-y-15">
                    <img src="<?php echo $includes_dir;?>img/280x280.png" class="wd-40 rounded-circle" alt="">
                    <div class="media-body">
                      <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                      <span class="tx-12">October 03, 2019 8:45am</span>
                    </div>
                  </div><!-- media -->
                </a>
                <!-- loop ends here -->
                <a href="" class="media-list-link read">
                  <div class="media pd-x-20 pd-y-15">
                    <img src="<?php echo $includes_dir;?>img/280x280.png" class="wd-40 rounded-circle" alt="">
                    <div class="media-body">
                      <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Social Network</strong></p>
                      <span class="tx-12">October 02, 2017 12:44am</span>
                    </div>
                  </div><!-- media -->
                </a>
                <a href="" class="media-list-link read">
                  <div class="media pd-x-20 pd-y-15">
                    <img src="<?php echo $includes_dir;?>img/280x280.png" class="wd-40 rounded-circle" alt="">
                    <div class="media-body">
                      <p class="tx-13 mg-b-0 tx-gray-700">20+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                      <span class="tx-12">October 01, 2019 10:20pm</span>
                    </div>
                  </div><!-- media -->
                </a>
                <a href="" class="media-list-link read">
                  <div class="media pd-x-20 pd-y-15">
                    <img src="<?php echo $includes_dir;?>img/280x280.png" class="wd-40 rounded-circle" alt="">
                    <div class="media-body">
                      <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                      <span class="tx-12">October 01, 2019 6:08pm</span>
                    </div>
                  </div><!-- media -->
                </a>
                <div class="pd-y-10 tx-center bd-t">
                  <a href="" class="tx-12"><i class="fa fa-angle-down mg-r-5"></i> Show All Notifications</a>
                </div>
              </div><!-- media-list -->
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name hidden-md-down"><?php echo $this->session->userdata('userData')->userName?></span>
              <img src="<?php echo $includes_dir;?>img/64x64.png" class="wd-32 rounded-circle" alt="<?php echo $this->session->userdata('userData')->userName?>">
              <span class="square-10 bg-success"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="icon ion-ios-person"></i> Edit Profile</a></li>
                <li><a href=""><i class="icon ion-ios-gear"></i> Settings</a></li>
                <li><a href="<?php echo base_url('login/logout')?>"><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
      </div><!-- br-header-right -->
    </div><!-- br-header -->
    <!-- ########## END: HEAD PANEL ########## -->



    <div id="modaldemo5" class="modal fade show" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger  tx-semibold mg-b-20 h_heading">Do you want to delete this Record?</h4>
                    <?php

                    $attributes = array('class' => 'form-horizontal', 'role' => 'delete_popup', 'id' => 'delete_record');

                    if($this->uri->segment(1) =="statistics" AND $this->uri->segment(2) =="")
                    {
                        echo form_open(base_url('statistics/delete'), $attributes);

                    }
                    else if ($this->uri->segment(2) == 'entered')
                    {
                        echo form_open(base_url('treaty/delete'), $attributes);
                    }
                    else
                    {
                        if ($this->uri->segment(2) != 'treaty_slip'){
                            echo form_open(current_url()."/delete", $attributes);

                        }
                    }



                    ?>
                    <input type="hidden" id="token_csrf" name="token_csrf" value="">
                    <input type="hidden" id="id" name="id" value="">
                    <input type="hidden" id="serviceType_delete" name="serviceType_delete" value="">

                    <input type="submit" class="btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20 delete_recordBtn" value="Yes">

                    <button type="button" class="btn tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                        No
                    </button>
                    <?php

//                    if($this->uri->segment(1) =="statistics" OR (!empty($this->uri->segment(2)) AND $this->uri->segment(2) =="index"))
//                    {
//                        echo form_close();
//
//                    }
//                    else if ($this->uri->segment(2) == 'entered')
//                    {
//                        echo form_close();
//                    }
//                    else {
//                        if (empty($this->uri->segment(2)))
//                        {
//                            echo form_close();
//                        }
//                    }
//                    if ($this->uri->segment(2) != 'treaty_slip')
                         echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>


    <div id="modaldemo4" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon ion-ios-checkmark-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-success tx-semibold mg-b-20 h_heading"></h4>
                    <!--<p class="mg-b-20 mg-x-20 p_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>-->
                    <button type="button" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                        OK</button>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>


    <div id="modal_error" class="modal fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close modal_error_btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon icon ion-ios-close-outline tx-100 tx-danger lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-danger tx-semibold mg-b-20 h_heading"></h4>
                    <!--<p class="mg-b-20 mg-x-20 p_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration.</p>-->
                    <button type="button" class="modal_error_btn btn btn-danger tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                        OK</button>
                </div><!-- modal-body -->
            </div><!-- modal-content -->
        </div><!-- modal-dialog -->
    </div>


    <!-- modal for create update confirmation -->
    <div id="confirmationModal_once" class="modal fade show" style="display: none;">
        <div class="modal-dialog" role="document">
            <div class="modal-content tx-size-sm">
                <div class="modal-body tx-center pd-y-20 pd-x-20">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="icon icon ion-ios-information-outline tx-100 tx-success lh-1 mg-t-20 d-inline-block"></i>
                    <h4 class="tx-success tx-semibold mg-b-20">Do you want to <?php echo ($this->uri->segment(2)=='create'? 'Create':'Update' ).' record'?>?</h4>

                    <input type="button" id="confirmed" class="btn btn-success tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" value="Yes">
                    <button type="button" id="close_alert" class="btn tx-11 tx-uppercase pd-y-12 pd-x-25 tx-mont tx-medium mg-b-20" data-dismiss="modal" aria-label="Close">
                        No
                    </button>

                </div>
            </div>
        </div>
    </div>