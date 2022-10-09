<script src="<?php echo $includes_dir;?>lib/jquery/jquery.js"></script>
    <script>
      $(document).ready(function() {
        $('.js-example-basic-multiple').attr("multiple", "multiple");
      });
    </script>
    <script src="<?php echo $includes_dir;?>lib/popper.js/popper.js"></script>
    <script src="<?php echo $includes_dir;?>lib/bootstrap/bootstrap.js"></script>
    <script src="<?php echo $includes_dir;?>lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js"></script>
    <script src="<?php echo $includes_dir;?>lib/moment/moment.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery-ui/jquery-ui.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery-switchbutton/jquery.switchButton.js"></script>
    <script src="<?php echo $includes_dir;?>lib/peity/jquery.peity.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery.sparkline.bower/jquery.sparkline.min.js"></script>
    <script src="<?php echo $includes_dir;?>lib/d3/d3.js"></script>
    <script src="<?php echo $includes_dir;?>lib/rickshaw/rickshaw.min.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery.steps/jquery.steps.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery.maskedinput/jquery.maskedinput.js"></script>
    <script src="<?php echo $includes_dir;?>js/bracket.js"></script>
    <script src="<?php echo $includes_dir;?>js/ResizeSensor.js"></script>
    <script src="<?php echo $includes_dir;?>lib/admin/general.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery-validation/jquery.validate.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery-validation/additional-methods.min.js"></script>
    <script src="<?php echo $includes_dir;?>lib/jquery-toggles-checkbox/bootstrap-toggle.min.js"></script>
    <script src="<?php echo $includes_dir;?>lib/select2/js/select2.min.js"></script>

<link rel="stylesheet" href="<?php echo $includes_dir;?>lib/jquery-datatables-bs3/assets/css/datatables.css" />

<script src="<?php echo $includes_dir;?>lib/excel_working/jquery.dataTables.min.js"></script>
<script src="<?php echo $includes_dir;?>lib/excel_working/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $includes_dir;?>lib/excel_working/dataTables.buttons.min.js"></script>
<script src="<?php echo $includes_dir;?>lib/excel_working/jszip.min.js"></script>
<script src="<?php echo $includes_dir;?>lib/excel_working/pdfmake.min.js"></script>
<script src="<?php echo $includes_dir;?>lib/excel_working/vfs_fonts.js"></script>
<script src="<?php echo $includes_dir;?>lib/excel_working/buttons.html5.min.js"></script>

    <script>

      $(function(){
        'use strict'

        // FOR DEMO ONLY
        // menu collapsed by default during first page load or refresh with screen
        // having a size between 992px and 1299px. This is intended on this page only
        // for better viewing of widgets demo.
        $(window).resize(function(){
          minimizeMenu();
        });

        minimizeMenu();

        function minimizeMenu() {
          if(window.matchMedia('(min-width: 992px)').matches && window.matchMedia('(max-width: 1299px)').matches) {
            // show only the icons and hide left menu label by default
            $('.menu-item-label,.menu-item-arrow').addClass('op-lg-0-force d-lg-none');
            $('body').addClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideUp();
          } else if(window.matchMedia('(min-width: 1300px)').matches && !$('body').hasClass('collapsed-menu')) {
            $('.menu-item-label,.menu-item-arrow').removeClass('op-lg-0-force d-lg-none');
            $('body').removeClass('collapsed-menu');
            $('.show-sub + .br-menu-sub').slideDown();
          }
        }
      });
    </script>

    <!-- This is input type validation fields -->
    <script>
        
        // $(".numeric").keyup(function() {
            // var $this = $(this);
            // $this.val($this.val().replace(/[^\d.]/g, ''));        
        // });

        // $(".decimal-numbers").keypress(function (e) {
        //     if(e.which == 46){
        //         if($(this).val().indexOf('.') != -1) {
        //             return false;
        //         }
        //     }

        //     if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
        //         return false;
        //     }
        // });

        // $('.string').keypress(function (e) {
        //     var regex = new RegExp("^[a-zA-Z ]+$");
        //     var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
        //     if (regex.test(strigChar)) {
        //         return true;
        //     }
        //     return false
        // });

        $(function () {
            triggerAlertClose();
        });
        function triggerAlertClose() {
            window.setTimeout(function () {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function () {
                    $(this).remove();
                });
            }, 3000);
        }

        function clogd(data,color='#39ff14',bgColor='#222') {
            if (DEBUG == true) {
                const styles = 'padding:10px;'+
                                'background:'+bgColor+';'+
                                'color:'+color+';'+
                                'font-family: "Lucida Console", Courier, monospace;';
                console.log('%c'+data, styles);
            }
        }
        function clog(data) {
            if (DEBUG == true) {
                console.log(data);
            }
        }

        function a(data,heading='') {
            if (DEBUG == true) {
                if (typeof data != 'object') {
                    alert(data);
                }else{
                    alert('Type Of data '+heading+' is not Object please check console');
                    clogd(heading + ': Object Detected in alert box !','#FFE450','#17a2b8');
                    clog(data);
                }
            }
        }

    </script>

        <script>
        $(".numeric").keyup(function() {
            var $this = $(this);
            $this.val($this.val().replace(/[^\d.]/g, ''));        
        });

        $(".decimal-numbers").keypress(function (e) {
            if(e.which == 46){
                if($(this).val().indexOf('.') != -1) {
                    return false;
                }
            }

            if (e.which != 8 && e.which != 0 && e.which != 46 && (e.which < 48 || e.which > 57)) {
                return false;
            }
        });

        $('.string').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z ]+$");
            var strigChar = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(strigChar)) {
                return true;
            }
            return false
        });

        $(".modal_error_btn").on("click",function(){
            // $('#modal').modal('toggle');
            // $('#modal_error').hide();
            // $('.modal-backdrop').removeClass("modal-backdrop");
        });


    </script>