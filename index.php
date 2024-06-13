<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_index.min.js"></script>';    
?> 

<!-- /slider section -->
<section class="slider-area skeleton skeleton-main-slider">
    <div class="slidercontain">
        <div class="slidercrousal">
            <div class="carexibition one-time" id="slider_list">
                
            </div>
        </div>
    </div>
</section>

<!-- tabbing section -->

<section class="logocontainer container ev-area">
    <div class="cartitle d-none">
        <h2 class="carfont designed-title">Best EV Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="skeleton skeleton-car-list-title"></div>
            <div class="disflexcars" id="ev_list">
                <div class="item">
                    <div class="carimagrang">
                        <div class="skeleton skeleton-car-list-img"></div>
                    </div>
                    <div class="pricebox">
                        <div class="pricebox1 w-100">
                            <div class="boxtitle skeleton skeleton-car-list-name"></div>
                            <div class="carprice skeleton skeleton-car-list-price"></div>
                            <div class="pricebox-bottom skeleton skeleton-car-list-extra">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="carimagrang">
                        <div class="skeleton skeleton-car-list-img"></div>
                    </div>
                    <div class="pricebox">
                        <div class="pricebox1 w-100">
                            <div class="boxtitle skeleton skeleton-car-list-name"></div>
                            <div class="carprice skeleton skeleton-car-list-price"></div>
                            <div class="pricebox-bottom skeleton skeleton-car-list-extra">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="carimagrang">
                        <div class="skeleton skeleton-car-list-img"></div>
                    </div>
                    <div class="pricebox">
                        <div class="pricebox1 w-100">
                            <div class="boxtitle skeleton skeleton-car-list-name"></div>
                            <div class="carprice skeleton skeleton-car-list-price"></div>
                            <div class="pricebox-bottom skeleton skeleton-car-list-extra">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="carimagrang">
                        <div class="skeleton skeleton-car-list-img"></div>
                    </div>
                    <div class="pricebox">
                        <div class="pricebox1 w-100">
                            <div class="boxtitle skeleton skeleton-car-list-name"></div>
                            <div class="carprice skeleton skeleton-car-list-price"></div>
                            <div class="pricebox-bottom skeleton skeleton-car-list-extra">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="loadmorbtn d-none">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_ev_txt ?>">More EVs</a></p>
            </div>
        </div>
    </div>
</section>
<section class="logocontainer container hybrid-area">
    <div class="cartitle d-none">
        <h2 class="carfont designed-title">Best Hybrid Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="skeleton skeleton-car-list-title"></div>
            <div class="disflexcars" id="hybrid_list">
                <div class="item">
                    <div class="carimagrang">
                        <div class="skeleton skeleton-car-list-img"></div>
                    </div>
                    <div class="pricebox">
                        <div class="pricebox1 w-100">
                            <div class="boxtitle skeleton skeleton-car-list-name"></div>
                            <div class="carprice skeleton skeleton-car-list-price"></div>
                            <div class="pricebox-bottom skeleton skeleton-car-list-extra">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="loadmorbtn d-none">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_hybrid_txt ?>">More Hybrid Cars</a></p>
            </div>
        </div>
    </div>
</section>
<section class="logocontainer container fule-area">
    <div class="cartitle d-none">
        <h2 class="carfont designed-title">Best Fuel Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="skeleton skeleton-car-list-title"></div>
            <div class="disflexcars" id="fule_list">
                <div class="item">
                    <div class="carimagrang">
                        <div class="skeleton skeleton-car-list-img"></div>
                    </div>
                    <div class="pricebox">
                        <div class="pricebox1 w-100">
                            <div class="boxtitle skeleton skeleton-car-list-name"></div>
                            <div class="carprice skeleton skeleton-car-list-price"></div>
                            <div class="pricebox-bottom skeleton skeleton-car-list-extra">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="loadmorbtn d-none">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_fuel_txt ?>">More Fuel Cars</a></p>
            </div>
        </div>
    </div>
</section>
<section class="logocontainer container upcoming-area">
    <div class="cartitle d-none">
        <h2 class="carfont designed-title">Upcomming Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="skeleton skeleton-car-list-title"></div>
            <div class="disflexcars" id="upcoming_list">
                <div class="item">
                    <div class="carimagrang">
                        <div class="skeleton skeleton-car-list-img"></div>
                    </div>
                    <div class="pricebox">
                        <div class="pricebox1 w-100">
                            <div class="boxtitle skeleton skeleton-car-list-name"></div>
                            <div class="carprice skeleton skeleton-car-list-price"></div>
                            <div class="pricebox-bottom skeleton skeleton-car-list-extra">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="loadmorbtn d-none">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'upcomming' ?>">More Upcomming Cars</a></p>
            </div>
        </div>
    </div>
</section>
<section class="logocontainer container tranding-area d-none">
    <div class="cartitle">
        <h2 class="carfont designed-title">Tranding Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="testiminialflexstart trandingslider mb-0" id="tranding_list">
            </div>

            <div class="loadmorbtn">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'cars' ?>">More Tranding Cars</a></p>
            </div>
        </div>
    </div>
</section>

<!-- symbol section -->
<div class="symbol brand-area">
    <div class="logocontainer container">
        <div class="dreamtitle">
            <h2 class="dreamsubtitle designed-title">Find your dream car</h2>
        </div>
        <div class="d-flex flex-wrap limited-list my-3" id="brand_list">
        </div>
        <div class="loadmorbtn load-more-brand-div">
            <p class="morbtn"><button href="javascript:void(0)" onclick="loadMoreBrand()">Show More Brands</button></p>
        </div>
        <div class="loadmorbtn load-less-brand-div d-none">
            <p class="morbtn"><button href="javascript:void(0)" onclick="loadlessBrand()">Show Less</button></p>
        </div>
    </div>
</div>

<!-- indias car -->
<div class="indiacar">
    <div class="hundai">
        <div class="logocontainer container">
            <div class="incartitle">
                <h2 class="indiacarsub">WHAT MAKES US THE <span class="carnumber">#1</span> ONLINE EV CARS IN INDIA?</h2>
            </div>

            <div class="iconimage">
                <div class="customflex">

                    <div class="cstomflex1">
                        <div class="cstompadding">
                            <img src="assets/img/icon3.webp" loading="lazy" alt="icon3">
                        </div>
                        <h3 class="customservice">BEST VALUE</h3>
                        <div class="servicepera">vehicles offering a blend of features, performance, reliability, and affordability. Users can compare models, read expert and user reviews, and find transparent pricing information</div>
                    </div>

                    <div class="cstomflex1">
                        <div class="cstompadding">
                            <img src="assets/img/icon5.webp" loading="lazy" alt="icon5">
                        </div>
                        <h3 class="customservice">HIGHEST QUALITY</h3>
                        <div class="servicepera">handpicked assortment of vehicles renowned for their exceptional craftsmanship, durability, reliability, and advanced engineering. </div>
                    </div>

                    <div class="cstomflex1">
                        <div class="cstompadding">
                            <img src="assets/img/icon6.webp" loading="lazy" alt="icon6">
                        </div>
                        <h3 class="customservice">TRUST</h3>
                        <div class="servicepera">vehicles that have earned a reputation for reliability, safety, and customer satisfaction. </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial -->
<div class="testimonial testimonial-area">
    <div class="testinmonialbg">
        <div class="logocontainer container">
            <div class="carnewstitle">
                <h2 class="colortestimonial carnewsubtitle designed-title">CUSTOMER TESTIMONIALS</h2>
            </div>
            <div class="testiminialflexstart testimonialslider" id="testimonial_list">
                
            </div>
        </div>
    </div>
</div>
<!-- blogsection -->
<div class="blogsection news-area">
    <div class="logocontainer container">
        <div class="borderlineblog">
            <div class="carnewflex d-flex flex-wrap justify-content-between align-items-center">

                <div class="carnewstitle">
                    <h2 class="carnewsubtitle designed-title">EV CARS NEWS</h2>
                </div>
                <div class="caeblog">
                    <a href="<?php echo ROOT_URL; ?>news" class="showall">Show All</a>
                </div>
            </div>
        </div>


        <div class="vaildityall">
            <div class="vaildiflex " id="news_list">
            </div>
        </div>
    </div>
</div>

<div class="subscribe-div">
    <div class="subscribe-container container">
        <div>
            <h2 class="text-success">Stay Updated <span class="f-shape"></span><span class="s-shape"></span></h2>
            <h5>Subscribe to Our Newsletter</h5>
        </div>
        <form id="subscribeForm" class="subscribe-form">
            <input type="email" name="email" id="sub_email" class="form-control rounded-pill" placeholder="Your email address" required>
            <button type="submit">Subscribe<i class="fa fa-arrow-right ms-2"></i></button>
        </form>
    </div>
</div>

<?php include 'footer.php' ?> 