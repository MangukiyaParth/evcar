<!-- footer -->
<div class="evefooter">
    <div class="logocontainer container">
        <div class="footerbroda">
            <div class="footerflex">
                <div class="footerlfle1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/footerlogo.webp" loading="lazy" alt="logo" class="footerlogoimage w-75">
                    <div class="footericon mt-3">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        <i class="fa fa-instagram" aria-hidden="true"></i>
                        <i class="fa fa-twitter" aria-hidden="true"></i>
                        <i class="fa fa-youtube-play" aria-hidden="true"></i>

                    </div>
                </div>

                <!-- <div class="footerflex2 footer-ev-area">
                    <h4 class="carinfotitle mt-2">Best EV Cars</h4>
                    <ul class="carlistfooter" id="footer_ev_list">
                    </ul>
                </div>

                <div class="footerflex2 footer-hybrid-area">
                    <h4 class="carinfotitle mt-2">Best Hybrid</h4>
                    <ul class="carlistfooter" id="footer_hybrid_list">
                    </ul>
                </div>

                <div class="footerflex2 footer-fule-area">
                    <h4 class="carinfotitle mt-2">Best Fuel</h4>
                    <ul class="carlistfooter" id="footer_fule_list">
                    </ul>
                </div> -->
                <div class="footer-links">
                    <h4 class="carinfotitle mt-2">EV Cars info</h4>
                    <ul class="carlistfooter">
                        <li class="carlistsubtutitle"><a href="<?php echo ROOT_URL; ?>about-us">About Us</a></li>
                        <li class="carlistsubtutitle"><a href="<?php echo ROOT_URL; ?>contact-us">Contact Us</a></li>
                        <li class="carlistsubtutitle"><a href="<?php echo ROOT_URL; ?>privacy-policy">Privacy Policy</a></li>
                        <li class="carlistsubtutitle"><a href="<?php echo ROOT_URL; ?>terms-conditions">Terms & Conditions</a></li>
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
                    <p class="madeintitle"><a href="#">
                        Made in Bharat 
                        <img src="<?php echo ROOT_URL; ?>assets/img/ic_flag_india_in.webp" loading="lazy" alt="in" class="footer-flag-icon">
                    </a></p>
                </div>
                <!-- <div class="copyflex1">
                    <ul class="d-flex flex-wrap">
                        <li><a href="<?php echo ROOT_URL; ?>privacy-policy">Privacy Policy</a></li>
                        <li><a href="<?php echo ROOT_URL; ?>terms-conditions">Terms & Conditions</a></li>

                    </ul>
                </div> -->
            </div>
        </div>
    </div>
</div>
<div id="web_comman_ListModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title web_comman_list_model_header" id="multiple-twoModalLabel"></h4>
                <button type="button" class="btn-close" data-bs-target="#priceModal" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="accordion accordion-flush" id="web_comman_list_model_div">

                </div><!-- /.accordion -->

            </div><!-- /.modal-body -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script defer src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script defer type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js" integrity="sha512-TPh2Oxlg1zp+kz3nFA0C5vVC6leG/6mm1z9+mA81MI5eaUVqasPLO8Cuk4gMF4gUfP5etR73rgU/8PNMsSesoQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script defer src="<?php echo ROOT_URL; ?>assets/js/data.js"></script>
<script defer src="<?php echo ROOT_URL; ?>assets/js/custom.min.js"></script>

<?php 
$include_javscript_at_bottom = str_replace('<script ', '<script defer ', $include_javscript_at_bottom);
echo $include_javscript_at_bottom;
?>

</body>

</html>