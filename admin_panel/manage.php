<?php
include 'header.php';
include 'sidebar.php';
$user_id = $userObj["id"];
$formname = $current_page."_form";
$include_javscript_at_bottom .= '<script src="' . $gh->auto_version(ADMIN_PANEL_URL.'js/manage_datatable.js') . '"></script>';
// $include_javscript_at_bottom .= '<script src="' . $gh->auto_version('js/'.$current_page.'.js') . '"></script>';
$include_javscript_library_before_custom_script_at_bottom .= "<script>
	var ORIG_MODULE_NAME = 'Dashboard';
	var MODULE_KEY = 'index';
	var LOGGED_IN_USER_ID = '$user_id';
	var FORMNAME = '" . $formname . "';
    </script>";

?>
<div class="content-page" id="main_page_data">
</div>
<?php
include 'footer.php';
?>