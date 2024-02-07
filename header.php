<!DOCTYPE html>
<html>

<head>
    <?php
        global $DEBUG,$ur, $ud, $gh, $const, $const_session_key_value, $current_user_id, $temp_user;
        include_once __DIR__."/config/_DEFINE.php";
        include_once __DIR__."/config/_SUPPORT.php";
        include_once __DIR__."/config/_CONST.php";
        $gh = new SUPPORT();
        $const = new ProjectConst();
        $primary_id = 0;
        if(isset($_REQUEST['id'])) {
            $primary_id = $_REQUEST['id'];
        }
        $auth_tkn = $at->getToken();
        $auth_token = isset($auth_tkn) ? $auth_tkn : "";
        $current_user_id = "";
        if ($auth_token == "") {
            $current_user_id = $gh->generateuuid();
            $temp_user = 1;
            $token_data = $gh->getjwt($current_user_id, FRONTEND_CONSTANT, 0, 1);
            if($token_data['status'] == "1")
            {
                $at->setToken($token_data['token']);
            }
        }
        else {
            $isvalidate = $gh->validatejwt($auth_token, FRONTEND_CONSTANT);
            if($isvalidate['status'] == 1){
                $current_user_id = $isvalidate['user_id'];
                $temp_user = $isvalidate['temp_user'];
            }
        }
        $current_page = basename($_SERVER['PHP_SELF']);
        $page = "";
        $include_javscript_at_bottom = "";
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Car</title>
    <link rel="icon" href="<?= ROOT_URL.'assets/img/favicon.ico'; ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/slick-theme.min.css">
    <link rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&family=Public+Sans:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        var PRIMARY_ID = '<?php echo $primary_id; ?>';
        var CURRENT_USER_ID = '<?php echo $current_user_id; ?>';
        var ROOT_URL = '<?php echo ROOT_URL; ?>';
        var WEB_API_FOLDER = '<?php echo API_SERVICE_URL; ?>';
        var API_SERVICE_URL = '<?php echo API_SERVICE_URL; ?>manage.php';
        var ADMIN_PANEL_URL = '<?php echo ADMIN_PANEL_URL; ?>';
        var REQ_FROM = '<?php echo FRONTEND_CONSTANT; ?>';
        var fule_type_hybrid_txt = '<?php echo $const->fule_type_hybrid_txt; ?>';
        var fule_type_ev_txt = '<?php echo $const->fule_type_ev_txt; ?>';
        var fule_type_fuel_txt = '<?php echo $const->fule_type_fuel_txt; ?>';
        var petrol_fule_id = '<?php echo $const->petrol_fule_id; ?>';
        var diesel_fule_id = '<?php echo $const->diesel_fule_id; ?>';
        var ev_fule_id = '<?php echo $const->ev_fule_id; ?>';
        var hybrid_fule_id = '<?php echo $const->hybrid_fule_id; ?>';
</script>
</head>

<body>
    <header class="headerborder">

        <div class="logosection logocontainer">
            <div class="navdisnonemobile carlogoflex d-flex justify-content-between align-items-center container">
                <div class="carlogo">
                    <h1>
                        <a href="<?php echo ROOT_URL; ?>home">
                            <img src="<?php echo ROOT_URL; ?>assets/img/logo.png" alt="logo" class="logoimage">
                        </a>
                    </h1>
                </div>
                <div class="searchbar">
                    <div class="borderline">
                        <div>
                            <form class="d-flex align-items-center" role="search">
                                <input class="form-control me-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                                <img src="<?php echo ROOT_URL; ?>assets/img/search-Button.png" alt="searchbtn" class="seracbar">
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="loginbutton">
                    <p class="loggedin"><a href="#" class="btn">Login</a></p>
                </div> -->
            </div>

            <!-- navbar -->
            <nav class="navbarcustom navbar navbar-expand-lg bg-body-tertiary">
                <div class="container-fluid">
                    <div class="mobilelogoflex py-2">
                        <div class="carlogo">
                            <img src="<?php echo ROOT_URL; ?>assets/img/logo.png" alt="logo" class="logoimage">
                        </div>
                        <div class="nav-mobile">
                            <a id="navbar-toggle" href="#"><i class="fa fa-bars" aria-hidden="true"></i></a>
                        </div>
                        <div class="loginbutton">
                            <!-- <p class="loggedin  "><a href="#" class="btn">Login</a></p> -->
                            <img src="<?php echo ROOT_URL; ?>assets/img/search-Button.png" alt="searchbtn" class="seracbar mobsearchbtn">
                            <span class="seracbar mobsearchbtn mobsearchclosebtn"><i class="fa fa-close"></i></span>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse justify-content-center" id="navbarNavDropdown">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link px-3 active" href="<?php echo ROOT_URL; ?>home">Home</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link px-3" href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_ev_txt; ?>">EV Cars</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3" href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_hybrid_txt; ?>">Hybrid Cars</a>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link px-3" href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_fuel_txt; ?>">Fuel Cars</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link px-3" href="<?php echo ROOT_URL; ?>news">Car News</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- mobileview start -->
            <div class="navonlysearchbar carlogoflex">
                <div class="searchbar">
                    <div class="borderline">
                        <div class="my-3">
                            <form class="d-flex align-items-center" role="search">
                                <input class="form-control me-2 rounded-pill" type="search" placeholder="Search" aria-label="Search">
                                <img src="<?php echo ROOT_URL; ?>assets/img/search-Button.png" alt="searchbtn" class="seracbar">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
