<?php
include('header.php');
$include_javscript_at_bottom .= '<script src="' . $gh->auto_version('js/login.js') . '"></script>';
$include_javscript_library_before_custom_script_at_bottom .= '<script type="text/javascript">
var MODULE_NAME = "login";
</script>';
?>
<style>
    .card {
        background: var(--ct-card-transparent-bg);
        border: 1px solid var(--ct-card-bg);
        border-radius: 8px;
    }
    .card-body {
        background: var(--ct-card-transparent-bg);
    }
</style>
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">

                    <!-- Logo -->
                    <div class="card-header pt-2 pb-2 text-center">
                        <a href="index.html">
                            <span><img src="<?php echo ADMIN_PANEL_URL; ?>assets/images/logo-dark.webp" alt="logo" width="100%"></span>
                        </a>
                        <!-- <h1><b>LM Account</b></h1> -->
                    </div>

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <h2 class="text-dark-50 text-center pb-0 fw-bold mb-3">Sign In</h2>
                            <!-- <p class="text-muted mb-4">Enter your username and password to access admin panel.</p> -->
                        </div>

                        <form method="post" class="formclass">

                            <div class="mb-3 non-otp-div">
                                <!-- <label for="tb_username" class="form-label">Username </label> -->
                                <input class="logininput form-control" type="text" id="tb_username" required="" placeholder="Username">
                            </div>

                            <div class="mb-3 non-otp-div">
                                <!-- <label for="tb_password" class="form-label">Password</label> -->
                                <div class="input-group input-group-merge">
                                    <input type="password" id="tb_password" class="logininput form-control" required="" placeholder="Password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 otp-div d-none">
                                <label for="otp" class="form-label">OTP</label>
                                <input type="text" id="otp" class="form-control" required="" placeholder="OTP">
                            </div>

                            <div class="mb-3 mb-0 text-center non-otp-div">
                                <button class="btn btn-primary loginbtn" type="button" onclick="return login_user();"> Log In </button>
                            </div>
                            <div class="mb-3 mb-0 text-center otp-div d-none">
                                <button class="btn btn-primary loginbtn" type="button" onclick="return verify_otp();"> Verify OTP </button>
                            </div>
                        </form>
                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<?php
include('footer.php')
?>