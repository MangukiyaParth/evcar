<?php
require_once('ajax.php');
include_once dirname(__DIR__, 1)."/config/_CONST.php";
include_once dirname(__DIR__, 1)."/config/gatter_satter.php";
$const = new ProjectConst();

$acc_bank=$const->accgrp_bank;
$acc_purparty=$const->accgrp_purchaseparty;
$acc_puracc=$const->accgrp_purchaseacc;
$admin_role_id=$const->admin_role_id;

$current_file_name = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
// $current_page = basename($_SERVER['PHP_SELF']);
$current_page = basename($_SERVER['REQUEST_URI']);
$pname=explode('.',$current_page);
$pagename=$pname[0];
$user_id = isset($userObj["id"]) ? $userObj["id"] : '';
$user_role_id = isset($userObj["userroleid"]) ? $userObj["userroleid"] : '';
$viewright =0;
$addright =0;
$editright =0;
$deleteright =0;
if ($current_page == "login" || $current_page == "index" || $current_page == "logout" || ($admin_role_id !== '' && str_contains($user_role_id, $admin_role_id)) )
{
	$viewright =1;
	$addright =1;
	$editright =1;
	$deleteright =1;
}
$favicon_path = ADMIN_PANEL_URL.'assets/images/favicon.ico';
$favicon_type = 'image/x-icon';
$site_name = "Admin Panel";

$resultArray = [];
if($setrights){
	$resultArray = $gh->findArrayByValue($setrights, 'pagename',$pagename);
}
$logged_in_username = isset($userObj["name"]) ? $userObj["name"] : "";
if ($current_page == "login") {
	$current_module_name = "Login";
}
else if ($current_page == "index") {
	$current_module_name = "Dashboard";
}
else if(!empty($resultArray)){
	$current_module_name = $resultArray['menuname'];
}

$js_current_page = $current_page;
if($current_page == 'index'){
	$js_current_page = "manage_dashboard";
}
$include_javscript_library_before_custom_script_at_bottom .= '<script type="text/javascript">
var PRIMARY_ID = ' . (empty($primary_id) ? 0 : $primary_id) . ';
var CURRENT_PAGE = "' . $js_current_page . '";
var LOGGED_IN_ROLE_ID = "' . ($userObj['role_id'] ?? 0) . '";
var IS_PRODUCTION="' . IS_PRODUCTION . '";
var TBLDATA = [];
var selata = [];
</script>';
?>
<!doctype html>
<html class="fixed sidebar-left-collapsed <?php if($current_page == 'login') { echo 'authentication-bg'; } ?>">

<head>
	<!-- Basic -->
	<meta charset="UTF-8">
	<title><?= $site_name ?></title>
	<meta name="keywords" content="<?php echo $site_name; ?>" />
	<meta name="description" content="<?php echo $site_name; ?> User Panel">
	<meta name="google" content="notranslate">
	<link rel="icon" href="<?= $favicon_path; ?>" type="<?= $favicon_type; ?>" />
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="<?= $favicon_path; ?>">
	<meta name="theme-color" content="#ffffff">

	<!-- Mobile Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link rel="shortcut icon" href="<?php echo ADMIN_PANEL_URL; ?>assets/images/favicon.ico">
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_URL; ?>assets/css/custom.css">
	<!-- Plugin css -->
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_URL; ?>assets/css/bootstrap-datepicker.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_URL; ?>assets/css/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_URL; ?>assets/css/pnotify.custom.css" />
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_URL; ?>assets/css/dataTables.bootstrap5.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo ADMIN_PANEL_URL; ?>assets/css/select2.min.css" type="text/css" />
	<link href="<?php echo ADMIN_PANEL_URL; ?>assets/css/app-saas.min.css" rel="stylesheet" type="text/css" id="app-style" />
	<link href="<?php echo ADMIN_PANEL_URL; ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo ADMIN_PANEL_URL; ?>assets/css/jquery.tag-editor.css" rel="stylesheet" type="text/css" />

	<!-- Web Fonts  -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
	<script> var editright = <?php echo $editright; ?>;
	var deleteright = <?php echo $deleteright; ?>;
	var addright = <?php echo $addright; ?>;
	</script>
	<!-- Vendor CSS -->
	<?php echo $include_stylesheet_in_header; ?>

	<!-- Theme Config Js -->
	<script src="<?php echo ADMIN_PANEL_URL; ?>assets/js/hyper-config.js"></script>
	<script>
		var clevertap = null;
		var mixpanel = null;
		// Domain
		const domain = '<?= ADMIN_PANEL_URL ?>manage_projects.php';
		const domain_global = '<?= ADMIN_PANEL_URL ?>index.php';

		// MySQL API
		const notify_panel_url = '<?= ADMIN_PANEL_URL ?>';
	</script>
</head>

<body class="<?php if($current_page == 'login') {
					echo 'authentication-bg';
				} ?>">
	<div class="wrapper">
		<?php if ($current_user_id != "" && !in_array($current_page, $login_not_needed_pages) && !in_array($current_page, $header_not_needed_pages)) { ?>

			<!-- ========== Topbar Start ========== -->
			<div class="navbar-custom topnav-navbar pe-0">
				<div class="container-fluid detached-nav pe-0">

					<!-- Topbar Logo -->
					<div class="logo-topbar">
						<!-- Logo light -->
						<a href="index.html" class="logo-light">
							<span class="logo-lg">
								<img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo.png" alt="logo" height="22">
							</span>
							<span class="logo-sm">
								<img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-sm.png" alt="small logo" height="22">
							</span>
						</a>

						<!-- Logo Dark -->
						<a href="index.html" class="logo-dark">
							<span class="logo-lg">
								<img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-dark.png" alt="dark logo" height="22">
							</span>
							<span class="logo-sm">
								<img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-dark-sm.png" alt="small logo" height="22">
							</span>
						</a>
					</div>

					<!-- Sidebar Menu Toggle Button -->
					<button class="button-toggle-menu">
						<i class="mdi mdi-menu"></i>
					</button>

					<!-- Horizontal Menu Toggle Button -->
					<button class="navbar-toggle" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
						<div class="lines">
							<span></span>
							<span></span>
							<span></span>
						</div>
					</button>

					<span class="page-name"></span>

					<ul class="list-unstyled topbar-menu float-end mb-0">
						<li class="notification-list d-sm-inline-block me-2">
							<div class="action-btn d-none">
								<div id="addBtn">
									<button class="btn btn-info" onclick="changeView('form')"> Add </button>
								</div>
								<button class="btn btn-info" id="backBtn" onclick="changeView('details')" style="display: none;"> Back </button>
							</div>
						</li>
						<li class="notification-list d-none d-sm-inline-block">
							<a class="nav-link" data-bs-toggle="offcanvas" href="#theme-settings-offcanvas">
								<i class="ri-settings-3-line noti-icon"></i>
							</a>
						</li>

						<!-- <li class="notification-list d-none d-sm-inline-block">
							<a class="nav-link" href="javascript:void(0)" id="light-dark-mode">
								<i class="ri-moon-line noti-icon"></i>
							</a>
						</li> -->

						<li class="notification-list d-none d-md-inline-block">
							<a class="nav-link" href="#" data-toggle="fullscreen">
								<i class="ri-fullscreen-line noti-icon"></i>
							</a>
						</li>

						<li class="dropdown notification-list">
							<a class="nav-link dropdown-toggle nav-user me-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
								<span class="account-user-avatar">
									<img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/user_profile.png" alt="user-image" class="rounded-circle">
								</span>
								<span>
									<span class="account-user-name" style="margin-top: 0.2rem; margin-right: 0.2rem;"><?php echo $logged_in_username; ?></span>
								</span>
							</a>
							<div class="dropdown-menu dropdown-menu-end dropdown-menu-animated topbar-dropdown-menu profile-dropdown">
								<!-- item-->
								<!-- <div class=" dropdown-header noti-title">
								<h6 class="text-overflow m-0">Welcome !</h6>
							</div> -->

								<!-- item-->
								<a href="javascript:void(0);" class="dropdown-item notify-item">
									<i class="mdi mdi-account-circle me-1"></i>
									<span>My Account</span>
								</a>
								<!-- item-->
								<a href="<?php echo ADMIN_PANEL_URL; ?>logout" class="dropdown-item notify-item">
									<i class="mdi mdi-logout me-1"></i>
									<span>Logout</span>
								</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
			<!-- ========== Topbar End ========== -->
		<?php } ?>