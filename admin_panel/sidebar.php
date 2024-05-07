<!-- ========== Left Sidebar Start ========== -->
<div class="leftside-menu">

    <!-- Logo Light -->
    <a href="page/manage_dashboard" class="logo logo-light">
        <span class="logo-lg py-2">
            <img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo.png" alt="logo" height="50">
        </span>
        <span class="logo-sm">
            <img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-sm.png" alt="small logo" height="25">
        </span>
    </a>

    <!-- Logo Dark -->
    <a href="index.php" class="logo logo-dark">
        <span class="logo-lg py-2">
            <img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-dark.png" alt="dark logo" height="50">
        </span>
        <span class="logo-sm">
            <img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-dark-sm.png" alt="small logo" height="25">
        </span>
    </a>

    <!-- Sidebar Hover Menu Toggle Button -->
    <button type="button" class="btn button-sm-hover p-0" data-bs-toggle="tooltip" data-bs-placement="right" title="Show Full Sidebar">
        <i class="ri-checkbox-blank-circle-line align-middle"></i>
    </button>

    <!-- Sidebar -left -->
    <div class="h-100" id="leftside-menu-container" data-simplebar>
        <?php
        if(str_contains($userObj['userroleid'], $const->admin_role_id))
        {
            $manage_role_viewright =1;
            $manage_user_viewright =1;
            $manage_brand_viewright =1;
            $manage_slider_viewright =1;
            $manage_testimonial_viewright =1;

            $manage_car_viewright =1;
            $manage_news_viewright =1;
            $manage_home_viewright =1;
            $manage_setting_viewright =1;
            $manage_userrights_viewright =1;

        }else{
            //Masters
            $manage_role_Array = $gh->findArrayByValue($setrights, 'pagename','manage_role');
            $manage_user_Array = $gh->findArrayByValue($setrights, 'pagename','manage_user');
            $manage_brand_Array = $gh->findArrayByValue($setrights, 'pagename','manage_brand');
            $manage_slider_Array = $gh->findArrayByValue($setrights, 'pagename','manage_slider');
            $manage_testimonial_Array = $gh->findArrayByValue($setrights, 'pagename','manage_testimonial');

            $manage_car_Array = $gh->findArrayByValue($setrights, 'pagename','manage_car');
            $manage_news_Array = $gh->findArrayByValue($setrights, 'pagename','manage_news');
            $manage_home_Array = $gh->findArrayByValue($setrights, 'pagename','manage_home');
            $manage_setting_Array = $gh->findArrayByValue($setrights, 'pagename','manage_setting');
            $manage_userrights_Array = $gh->findArrayByValue($setrights, 'pagename','manage_userrights');

            //====================================================  View Rights ====================================================
            //Masters
            $manage_role_viewright =$manage_role_Array['viewright'];
            $manage_user_viewright =$manage_user_Array['viewright'];
            $manage_brand_viewright =$manage_brand_Array['viewright'];
            $manage_slider_viewright =$manage_slider_Array['viewright'];
            $manage_testimonial_viewright =$manage_testimonial_Array['viewright'];

            $manage_car_viewright =$manage_car_Array['viewright'];
            $manage_news_viewright =$manage_news_Array['viewright'];
            $manage_home_viewright =$manage_home_Array['viewright'];
            $manage_setting_viewright =$manage_setting_Array['viewright'];
            $manage_userrights_viewright =$manage_userrights_Array['viewright'];
        }
        
        ?>
        <!--- Sidemenu -->
        <ul class="side-nav">
            <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_dashboard')" class="side-nav-link" data-name="manage_dashboard"><i class="uil-home-alt"></i><span> Dashboard </span></a></li>
            <?php
            if($manage_brand_viewright == 1 || $manage_slider_viewright == 1 || $manage_testimonial_viewright == 1 ||
            $manage_role_viewright == 1 || $manage_user_viewright == 1)
            {
                ?>
                <li class="side-nav-item">
                    <a data-bs-toggle="collapse" href="#sidebarmaster" aria-expanded="false" aria-controls="sidebarmaster" class="side-nav-link">
                        <i class="mdi mdi-store-settings-outline"></i><span> Master </span><span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarmaster">
                        
                        <ul class="side-nav-second-level">
                            <?php
                            if($manage_role_viewright ==1){
                                ?>
                                <li><a href="javascript:void(0);" onclick="openPage('manage_role')" data-name="manage_role">Role Master</a></li>
                                <?php
                            }
                            if($manage_user_viewright ==1){
                                ?>
                                <li><a href="javascript:void(0);" onclick="openPage('manage_user')" data-name="manage_user">User Master</a></li>
                                <?php
                            }
                            if($manage_brand_viewright ==1){
                                ?>
                                <li><a href="javascript:void(0);" onclick="openPage('manage_brand')" data-name="manage_brand">Brand Master</a></li>
                                <?php
                            }
                            if($manage_slider_viewright ==1){
                                ?>
                                <li><a href="javascript:void(0);" onclick="openPage('manage_slider')" data-name="manage_slider">Slider Master</a></li>
                                <?php
                            }
                            if($manage_testimonial_viewright ==1){
                                ?>
                                <li><a href="javascript:void(0);" onclick="openPage('manage_testimonial')" data-name="manage_testimonial">Testimonial Master</a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </li>
                <?php
            }
            if($manage_car_viewright ==1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_car')" data-name="manage_car"  class="side-nav-link"><i class="uil-car-sideview"></i><span>Cars</span></a></li>
                <?php
            }
            if($manage_news_viewright ==1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_news')" data-name="manage_news"  class="side-nav-link"><i class="uil-newspaper"></i><span>News</span></a></li>
                <?php
            }
            if($manage_home_viewright ==1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_home')" data-name="manage_home"  class="side-nav-link"><i class="mdi mdi-web-refresh"></i><span>Home Manage</span></a></li>
                <?php
            }
            if($manage_userrights_viewright ==1)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_userrights')" data-name="manage_userrights"  class="side-nav-link"><i class="ri-settings-5-line"></i><span>User Rights</span></a></li>
                <?php
            }
            if(true)
            {
                ?>
                <li class="side-nav-item"><a href="javascript:void(0);" onclick="openPage('manage_setting')" data-name="manage_setting"  class="side-nav-link"><i class="ri-settings-5-line"></i><span>Settings</span></a></li>
                <?php
            }
            ?>
        </ul>
        <!--- End Sidemenu -->
        <div class="clearfix"></div>
    </div>
</div>
<!-- ========== Left Sidebar End ========== -->