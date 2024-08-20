<!-- footer -->
<div class="evefooter">
    <div class="logocontainer container">
        <div class="footerbroda">
            <div class="footerflex">
                <div class="footerlfle1">
                    <img src="<?php echo ROOT_URL; ?>assets/img/footerlogo.webp" loading="lazy" alt="logo" class="footerlogoimage w-75">
                    <div class="footericon mt-3">
                        <img src="<?php echo ROOT_URL; ?>assets/img/facebook.svg">
                        <img src="<?php echo ROOT_URL; ?>assets/img/instagram.svg" class="insta">
                        <img src="<?php echo ROOT_URL; ?>assets/img/twitter.svg">
                        <img src="<?php echo ROOT_URL; ?>assets/img/youtube.svg">
                    </div>
                </div>

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

<div id="responseModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-body">
                <!-- <button type="button" class="btn-close" data-bs-target="#priceModal" data-bs-toggle="modal" data-bs-dismiss="modal" aria-label="Close"></button> -->
                <div class="d-flex flex-column text-center">
                    <img src="assets/img/success.gif" alt="Icon" class="w-25 m-auto">
                    <h4 class="px-3 pb-3">You are successfully subscribe with EV Cars.</h4>
                </div>
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