<!DOCTYPE html>
<html lang="en">

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
        header("Cache-Control: max-age=31536000");
    ?>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EV Cars Info: The Ultimate Guide to Price, Features, Performance, News</title>
    <meta name="description" content="EV Cars Info, car info, The Ultimate Guide to Price, Features, Performance, News">
    <!-- <link rel="icon" href="<?= ROOT_URL.'assets/img/favicon.ico'; ?>" type="image/x-icon" /> -->
     
    <link rel="apple-touch-icon" sizes="180x180" href="<?= ROOT_URL.'assets/img/apple-touch-icon.png'; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= ROOT_URL.'assets/img/favicon-32x32.png'; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= ROOT_URL.'assets/img/favicon-16x16.png'; ?>">
    <link rel="manifest" href="<?= ROOT_URL.'assets/img/site.webmanifest'; ?>">
    <link rel="mask-icon" href="<?= ROOT_URL.'assets/img/safari-pinned-tab.svg'; ?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">


    <link rel="preload" as="image" href="<?= ROOT_URL.'assets/img/logo.webp'; ?>">

    <link async rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link async rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link async rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/slick-theme.min.css">
    <!-- <link async rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integritPy="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link async rel="stylesheet" href="<?php echo ROOT_URL; ?>assets/css/style.min.css">
    <link async rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700;800;900&display=swap">
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
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-GHWWB6EPB4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-GHWWB6EPB4');
    </script>
</head>

<body>
    <header class="headerborder">

        <div class="logosection logocontainer">
            <div class="carlogoflex d-flex justify-content-between align-items-center container px-0 py-2">
                <div class="carlogo navdisnonemobile w-25">
                    <a href="<?php echo ROOT_URL; ?>home">
                        <img src="<?php echo ROOT_URL; ?>assets/img/logo.webp" alt="logo" class="logoimage w-100" loading="lazy">
                    </a>
                </div>
                <!-- navbar -->
                <nav class="navbarcustom navbar navbar-expand-lg bg-body-tertiary w-100">
                    <div class="container-fluid">
                        <div class="mobilelogoflex py-2">
                            <div class="carlogo">
                                <img src="<?php echo ROOT_URL; ?>assets/img/logo.webp" alt="logo" class="logoimage" loading="lazy">
                            </div>
                            <div class="nav-mobile">
                                <a id="navbar-toggle" href="#" aria-label="Toggle Navbar"><img src="<?php echo ROOT_URL; ?>assets/img/bars.svg" class="width-25" loading="lazy"></a>
                            </div>
                            <div class="loginbutton">
                                <img src="<?php echo ROOT_URL; ?>assets/img/search.svg" class="btnSearch seracbar mobsearchbtn header-search h-45" loading="lazy">
                                <span class="seracbar mobsearchbtn mobsearchclosebtn"><img src="<?php echo ROOT_URL; ?>assets/img/close.svg" class="h-45" loading="lazy"></span>
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
                                <li class="nav-item d-none">
                                    <a class="nav-link px-3" href="<?php echo ROOT_URL; ?>ev-calculator">EV Calculator</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>

                <div class="searchbar navdisnonemobile w-50">
                    <div class="borderline">
                        <div>
                            <form class="d-flex align-items-center position-relative flex-column search-div" role="search">
                                <input class="form-control me-2 ps-4 pe-5 rounded-pill search" type="text" placeholder="Search" aria-label="Search">
                                <img src="<?php echo ROOT_URL; ?>assets/img/search.svg" class="btnSearch seracbar position-absolute right-0 header-search" loading="lazy">
                                <div class="searchCarList" id="search_car_list" style="display: none;"></div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- <div class="loginbutton">
                    <p class="loggedin"><a href="#" class="btn">Login</a></p>
                </div> -->
            </div>

            

            <!-- mobileview start -->
            <div class="navonlysearchbar carlogoflex">
                <div class="searchbar">
                    <div class="borderline">
                        <div class="my-3">
                            <form class="d-flex align-items-center position-relative search-div" role="search">
                                <input class="form-control me-2 rounded-pill search" type="text" placeholder="Search" aria-label="Search">
                                <img src="<?php echo ROOT_URL; ?>assets/img/search.svg" class="seracbar btnSearch header-search position-absolute right-0" loading="lazy">
                                <div class="searchCarList" id="mob_search_car_list" style="display: none;"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
