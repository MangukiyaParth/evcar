<?php

include('header.php');
$user = $ud->getUser();
$include_javscript_library_before_custom_script_at_bottom .= '<script type="text/javascript">
var LOGGED_IN_USER_ID = "' . (($user) ? $user['id'] : 0) . '";
</script>';

$include_javscript_at_bottom .= '<script src="' . $gh->auto_version('js/logout.js') . '"></script>';


global $outputjson, $gh, $db, $DEBUG, $const_session_key_value;

$gh = new SUPPORT();
$result = array();

$const_session_key_value = "";

session_regenerate_id(true);

if (session_status() == PHP_SESSION_ACTIVE || isset($_SESSION)) {
	session_destroy();
}
include('footer.php');
?>