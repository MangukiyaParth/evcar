<?php
// error_reporting(0);
// error_reporting(E_ALL);
date_default_timezone_set('Asia/Calcutta');

// server credentials file
include_once "MANAGE_CONFIG.php";
include_once "gatter_satter.php";

define("UPLOAD", "upload/");

header('Access-Control-Allow-Origin: https://evcarsinfo.in');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Content-Range, Content-Disposition");
header('Access-Control-Allow-Methods: GET, HEAD, OPTIONS, POST, PUT');

/*
DEBUG_MODE = 0  // Do not debug
DEBUG_MODE = 1  // Append query only
DEBUG_MODE = 2  // Append query and output into JSON
 */
define("DEBUG_MODE", "0");

/*
LOG_MODE = 0  // Do not log
LOG_MODE = 1  // Log only request
LOG_MODE = 2  // Log request and response
LOG_MODE = 3  // Log only query
LOG_MODE = 4  // Log query & result to log file
 */
define("LOG_MODE", "1");

define("PANEL_CONSTANT", "panel");
define("FRONTEND_CONSTANT", "frontend");
// Default: false,  Set to true when releasing website changes so no one uses it.
define("WEBSITE_UNDER_MAINTENANCE", false);
define("PHPFASTCACHE_EXPIRE_SEC", 30 * 24 * 60 * 60); // 30 days
define("COMPANY_LOGO_URL", ADMIN_PANEL_URL . 'assets/images/logo.png');
