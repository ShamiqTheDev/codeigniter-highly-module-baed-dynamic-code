<!-- ########## START: LEFT PANEL ########## -->
    <?php
        $module = strtolower($this->uri->segment(1));
    ?>
    <div class="br-logo"><a href="<?php echo base_url(); ?>"><img src="<?php echo $includes_dir;?>img/logo.png" alt=""></a></div>
    <!-- overflow-y-auto -->
    <div class="br-sideleft overflow-y-auto">
      <label class="sidebar-label pd-x-15 mg-t-20"></label>
      <div class="br-sideleft-menu">
        <a href="<?php echo base_url(); ?>" class="br-menu-link active">
          <div class="br-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label"><?php echo $this->lang->line('menu_dashboard');?></span>
          </div>
        </a>

          <?php

            $active_menu = '';
            $display = '';
            if ($module == 'user' || $module == 'role' || $module == 'permission') {
                $active_menu = ' show-sub';
                $display = "style='display: block;'";
            }

            $userData = $this->session->userdata('userData');
            $ModulesData = $userData->roles_permissions->moduleDTOS;

            if(count($ModulesData) > 0) {
                $html='';

                foreach ($ModulesData as $key => $ObjModule) {
                    $menu_name = "menu_".str_replace(" ","",strtolower($ObjModule->moduleName));
                    $html .='<a href="#" class="br-menu-link '.$active_menu.'">
                              <div class="br-menu-item">
                                  <i class="menu-item-icon icon ion-person-stalker tx-18"></i> <span class="menu-item-label">'.$this->lang->line($menu_name).'</span> <i class="menu-item-arrow fa fa-angle-down"></i>
                              </div>
                          </a>';
                    if($ObjModule->screenDTOList)
                    {
                        $ScreensData = $ObjModule->screenDTOList;
                        $html .='<ul class="br-menu-sub nav flex-column" '.$display.'>';
                        foreach ($ScreensData as $ObjScreen) {   
                            if (!empty($ObjScreen->url)) {   
                                $menu_name = "menu_".str_replace(" ","",strtolower($ObjScreen->name)); 
                                // $html .='<li class="nav-item"><a href="'.base_url($ObjScreen->url).'" class="nav-link">'.$this->lang->line($menu_name).'</a></li>';
                                $html .='<li class="nav-item"><a href="'.base_url($ObjScreen->url).'" class="nav-link">'.$this->lang->line($menu_name).'</a></li>';
                            }
                        }
                        $html .=' </ul>';
                    }
                }
                echo $html; 

            }
            else {

                ?>
                <a href="<?php echo base_url('facultativeNote/'); ?>" class="br-menu-link">
                <div class="br-menu-item">
                    <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
                    <span class="menu-item-label"><?php echo $this->lang->line('menu_facultativeNote');?></span>
                </div>
                </a>
                <a href="#" class="br-menu-link<?php echo  $active_menu ?>">
                    <div class="br-menu-item">
                        <i class="menu-item-icon icon ion-person-stalker tx-18"></i> <span class="menu-item-label"><?php echo $this->lang->line('menu_usermanagment');?></span>
                        <i class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub nav flex-column" <?php echo  $display ?> >
                    <li class="nav-item"><a href="<?php print(base_url() . 'user/') ?>" class="nav-link"><?php echo $this->lang->line('menu_users');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'role/') ?>" class="nav-link"><?php echo $this->lang->line('menu_roles');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'permission/') ?>" class="nav-link"><?php echo $this->lang->line('menu_permissions');?></a></li>
                </ul>
                <?php
                $active_menu = '';
                $display = '';
                if (
                        $module == 'agreement' || $module == 'statistics' || $module == 'treaty' 
                        || $module ==  'entered' || $module ==  'accountRendering'  || $module ==  'Bordereaux'
                        || $module ==  'Bordereaux'
                    ) {
                    $active_menu = ' show-sub';
                    $display = "style='display: block;'";
                }
                ?>
                <a href="#" class="br-menu-link<?php echo  $active_menu ?>">
                    <div class="br-menu-item">
                        <i class="menu-item-icon fa fa-money tx-18"></i> <span class="menu-item-label"><?php echo $this->lang->line('menu_treaty');?></span> <i
                                class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub nav flex-column" <?php echo  $display ?>>
                    <li class="nav-item"><a href="<?php print(base_url() . 'statistics') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatystatistics');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'agreement') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatyagreement');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'treaty') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatyslip');?></a> </li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'treaty/entered') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatycompletedtreatyslips');?></a> </li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'accountRendering') ?>" class="nav-link"><?php echo $this->lang->line('menu_accountrendering');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'Bordereaux') ?>" class="nav-link"><?php echo $this->lang->line('menu_bordereaux');?></a> </li>
                </ul>

                <?php
                $active_menu = '';
                $display = '';
                if (
                    $module == 'treatyCodes' || $module == 'treatyCategory' || $module == 'TreatyParticular' 
                    || $module == 'treatyType' || $module == 'treatySubTypes'
                ) {
                    $active_menu = ' show-sub';
                    $display = "style='display: block;'";
                }
                ?>
                <a href="#" class="br-menu-link<?php echo  $active_menu ?>">
                    <div class="br-menu-item">
                        <i class="menu-item-icon fa fa-cog tx-18"></i> <span class="menu-item-label"><?php echo $this->lang->line('menu_treatysettings');?></span> <i
                                class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub nav flex-column" <?php echo  $display ?>>
                    <li class="nav-item"><a href="<?php print(base_url() . 'treatyCodes') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatycode');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'treatyCategory') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatycategory');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'treatyParticular') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatyparticular');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'treatyType') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatytypes');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'treatySubTypes') ?>" class="nav-link"><?php echo $this->lang->line('menu_treatysubtypes');?></a></li>
                    
                </ul>

                <?php
                $active_menu = '';
                $display = '';
                if ($module == 'currency' || $module == 'currencyRate' || $module == 'rateType') {
                    $active_menu = ' show-sub';
                    $display = "style='display: block;'";
                }
                ?>
                <a href="#" class="br-menu-link<?php echo  $active_menu ?>">
                    <div class="br-menu-item">
                        <i class="menu-item-icon fa fa-cog tx-18"></i> <span class="menu-item-label"><?php echo $this->lang->line('menu_currencysettings');?></span> <i
                                class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub nav flex-column" <?php echo  $display ?>>
                    <li class="nav-item"><a href="<?php print(base_url() . 'currency') ?>" class="nav-link"><?php echo $this->lang->line('menu_currency');?></a> </li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'currencyRate') ?>" class="nav-link"><?php echo $this->lang->line('menu_currencyrate');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'rateType') ?>" class="nav-link"><?php echo $this->lang->line('menu_ratetype');?></a> </li>
                </ul>

                <?php
                $active_menu = '';
                $display = '';
                if (
                    $module == 'branch' || $module == 'business' || $module == 'broker' || $module == 'company' 
                    || $module == 'cedent' || $module == 'city' || $module == 'crestaZone' || $module == 'conditionType' 
                    || $module == 'condition' || $module == 'chargingItem' || $module == 'chargingHead' 
                    || $module == 'department' || $module == 'division' || $module == 'insured' || $module == 'location' 
                    || $module == 'module' || $module == 'primaryInsurer' || $module == 'riskCovered' || $module == 'screen' 
                    || $module == 'template' || $module == 'WorkFlowNames'
                ) {
                    $active_menu = ' show-sub';
                    $display = "style='display: block;'";
                }
                ?>
                <a href="#" class="br-menu-link<?php echo  $active_menu ?>">
                    <div class="br-menu-item">
                        <i class="menu-item-icon fa fa-cog tx-18"></i> <span class="menu-item-label"><?php echo $this->lang->line('menu_settings');?></span> <i
                                class="menu-item-arrow fa fa-angle-down"></i>
                    </div>
                </a><!-- br-menu-link -->
                <ul class="br-menu-sub nav flex-column" <?php echo  $display ?>>


                    <li class="nav-item"><a href="<?php print(base_url() . 'branch') ?>" class="nav-link"><?php echo $this->lang->line('menu_branch');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'business') ?>" class="nav-link"><?php echo $this->lang->line('menu_business');?></a> </li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'broker') ?>" class="nav-link"><?php echo $this->lang->line('menu_broker');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'company') ?>" class="nav-link"><?php echo $this->lang->line('menu_company');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'cedent') ?>" class="nav-link"><?php echo $this->lang->line('menu_cedent');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'city') ?>" class="nav-link"><?php echo $this->lang->line('menu_city');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'crestaZone') ?>" class="nav-link"><?php echo $this->lang->line('menu_crestazone');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'conditionType') ?>" class="nav-link"><?php echo $this->lang->line('menu_conditionstype');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'condition') ?>" class="nav-link"><?php echo $this->lang->line('menu_conditions');?></a>
                    </li>
                    <!-- <li class="nav-item"><a href="<?php //print(base_url() . 'conditionReference') ?>" class="nav-link">Condition Reference</a> </li> -->
                    <li class="nav-item"><a href="<?php print(base_url() . 'chargingItem') ?>" class="nav-link"><?php echo $this->lang->line('menu_chargingitem');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'chargingHead') ?>" class="nav-link"><?php echo $this->lang->line('menu_charginghead');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'department') ?>" class="nav-link"><?php echo $this->lang->line('menu_department');?></a> </li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'division') ?>" class="nav-link"><?php echo $this->lang->line('menu_division');?></a> </li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'insured') ?>" class="nav-link"><?php echo $this->lang->line('menu_insured');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'location') ?>" class="nav-link"><?php echo $this->lang->line('menu_location');?></a> </li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'module') ?>" class="nav-link"><?php echo $this->lang->line('menu_module');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'primaryInsurer') ?>" class="nav-link"><?php echo $this->lang->line('menu_primaryinsurer');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'riskCovered') ?>" class="nav-link"><?php echo $this->lang->line('menu_riskcovered');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'screen') ?>" class="nav-link"><?php echo $this->lang->line('menu_screen');?></a></li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'template') ?>" class="nav-link"><?php echo $this->lang->line('menu_template');?></a> </li>
                    <!-- <li class="nav-item"><a href="<?php print(base_url() . 'WorkFlow') ?>" class="nav-link"><?php echo $this->lang->line('menu_workflow');?></a> -->
                    </li>
                    <li class="nav-item"><a href="<?php print(base_url() . 'WorkFlowNames') ?>" class="nav-link"><?php echo $this->lang->line('menu_workflow');?></a>
                    </li>


                </ul>

                <?php
            }
        ?>
      </div><!-- br-sideleft-menu -->

    </div><!-- br-sideleft -->
    <!-- ########## END: LEFT PANEL ##########