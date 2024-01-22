<?php
if (!isset($include_stylesheet_in_header)) $include_stylesheet_in_header = "";
if (!isset($include_stylesheet_in_footer)) $include_stylesheet_in_footer = "";
$include_javscript_at_bottom = "";
global $DEBUG,$ur, $gh, $const, $const_session_key_value;

require_once('../config/_DEFINE.php');
if (WEBSITE_UNDER_MAINTENANCE == true) {
	header("Location: maintenance.php");
	exit(0);
}
require_once '../config/_SUPPORT.php';
$gh = new SUPPORT();

$primary_id = (int)$gh->read("id");
$current_page = basename($_SERVER['PHP_SELF']); /* Returns The Current PHP File Name */
$should_redirect_to = $_SERVER['REQUEST_URI'];
$current_module_name = '';

$current_user_id = "";
$current_role_id = "";
$auth_tkn = $at->getToken();
$auth_token = isset($auth_tkn) ? $auth_tkn : "";
if ($auth_token != "") {
	$isvalidate = $gh->validatejwt($auth_token, PANEL_CONSTANT);
	if($isvalidate['status'] == 1 && ($current_page == "login.php")){
		header("Location: ".ADMIN_PANEL_URL."page/manage_dashboard");
		exit(0);
	}
	else if($isvalidate['status'] == 1 && !$isvalidate['temp_user']){
		$current_user_id = $isvalidate['user_id'];
	}
}

$userObj = $ud->getUser();
$login_not_needed_pages = array("ajax.php", "login.php", "logout.php", "logout");
$header_not_needed_pages = array();
$gh->Log("Page View: " . $current_page . " " . $_SERVER['REQUEST_URI'] . " " . print_r($current_user_id, true));

if (empty($userObj) && !in_array($current_page, $login_not_needed_pages)) {
	$gh->Log("Auto Login Needed");
	if ($auth_token == "" || $should_redirect_to == "") {
		$gh->Log("Auto Login Failed " . $should_redirect_to);
		header("Location: ".ADMIN_PANEL_URL."login");
		exit(0);
	}
}
$useragent = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';
$setrights = $ur->getRights();
$Urights = json_encode($setrights);
$include_javscript_library_before_custom_script_at_bottom = "<script>
	var IS_PRODUCTION = '" . IS_PRODUCTION . "';
	var IS_DEVELOPMENT = '" . IS_DEVELOPMENT . "';
	var WEB_API_FOLDER = '" . API_SERVICE_URL . "';
	var API_SERVICE_URL = '" . API_SERVICE_URL . "manage.php';
	var ADMIN_PANEL_URL = '" . ADMIN_PANEL_URL . "';
	var USER_AVATAR = '" . ADMIN_PANEL_URL . "images/user_avtar.png';
	var CURRENT_USER_ID = '".$current_user_id."';
	var CURRENT_USERROLE_ID = '".$current_role_id."';
	</script>";
