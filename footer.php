<!-- footer -->
<div class="evefooter">
    <div class="logocontainer container">
        <div class="footerbroda">
            <div class="footerflex">
                <div class="footerlfle1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/footerlogo.png" alt="logo" class="footerlogoimage">
                    <div class="footericon mt-3">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                        <i class="fa fa-youtube-play" aria-hidden="true"></i>

                    </div>
                </div>
                <div class="footerflex2">
                    <h4 class="carinfotitle">EV Cars info</h4>
                    <ul class="carlistfooter">
                        <li class="carlistsubtutitle"><a href="#">About Us</a></li>
                        <li class="carlistsubtutitle"><a href="#">Contact Us</a></li>
                        <li class="carlistsubtutitle"><a href="#">News</a></li>
                        <li class="carlistsubtutitle"><a href="#">Support</a></li>

                    </ul>
                </div>

                <div class="footerflex2">
                    <h4 class="carinfotitle">Best EV Cars</h4>
                    <ul class="carlistfooter">
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                    </ul>
                </div>

                <div class="footerflex2">
                    <h4 class="carinfotitle">Best Hybrid</h4>
                    <ul class="carlistfooter">
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                    </ul>
                </div>

                <div class="footerflex2">
                    <h4 class="carinfotitle">Best Fuel</h4>
                    <ul class="carlistfooter">
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                        <li class="carlistsubtutitle"><a href="#">Lorem Ipsum is simply</a></li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="copyright">
            <div class="copyrightflex d-flex justify-content-between flex-wrap">
                <div class="copyflex1">
                    <p class="copyrightitle"><a href="#">© Copyright 2024 EV CAR .IN. All Rights Reserved.</a></p>
                </div>
                <div class="copyflex1">
                    <ul class="d-flex flex-wrap">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms & Conditions</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo ROOT_URL; ?>assets/js/jquery-1.11.0.min.js"></script>
<script src="<?php echo ROOT_URL; ?>assets/js/slick.min.js"></script>
<script src="<?php echo ROOT_URL; ?>assets/js/data.js"></script>
<script src="<?php echo ROOT_URL; ?>assets/js/popper.min.js"></script>
<script src="<?php echo ROOT_URL; ?>assets/js/bootstrap.bundle.min.js"></script>

<?php 
$include_javscript_at_bottom = '<script src="' . ROOT_URL.'assets/js/custom.js' . '"></script>' . $include_javscript_at_bottom;
$include_javscript_at_bottom = str_replace('<script ', '<script defer ', $include_javscript_at_bottom);
echo $include_javscript_at_bottom;
?>

</body>

</html>