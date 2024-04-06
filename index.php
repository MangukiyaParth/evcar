<?php 
    include 'header.php'; 
    $include_javscript_at_bottom .= '<script src="'.ROOT_URL.'assets/js/manage_index.js"></script>';    
?> 

<!-- /slider section -->
<section class="slider-area">
    <div class="slidercontain">
        <div class="slidercrousal">
            <div class="carexibition one-time" id="slider_list">
                
            </div>
        </div>
    </div>
</section>

<!-- tabbing section -->

<section class="logocontainer container ev-area d-none">
    <div class="cartitle">
        <h2 class="carfont designed-title">Best EV Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="disflexcars" id="ev_list">
                
            </div>

            <div class="loadmorbtn">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_ev_txt ?>">More</a></p>
            </div>
        </div>
    </div>
</section>
<section class="logocontainer container hybrid-area d-none">
    <div class="cartitle">
        <h2 class="carfont designed-title">Best Hybrid Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="disflexcars" id="hybrid_list">
                
            </div>

            <div class="loadmorbtn">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_hybrid_txt ?>">More</a></p>
            </div>
        </div>
    </div>
</section>
<section class="logocontainer container fule-area d-none">
    <div class="cartitle">
        <h2 class="carfont designed-title">Best Fuel Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="disflexcars" id="fule_list">
            </div>

            <div class="loadmorbtn">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'fuel/'.$const->fule_type_fuel_txt ?>">More</a></p>
            </div>
        </div>
    </div>
</section>
<section class="logocontainer container upcoming-area d-none">
    <div class="cartitle">
        <h2 class="carfont designed-title">Upcomming Cars</h2>
    </div>
    <div class="foundcar">
        <div class="featuredcar featuredblock">
            <div class="disflexcars" id="upcoming_list">
            </div>

            <div class="loadmorbtn">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'cars' ?>">More</a></p>
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
            <div class="testiminialflexstart trandingslider" id="tranding_list">
            </div>

            <div class="loadmorbtn">
                <p class="morbtn"><a href="<?php echo ROOT_URL.'cars' ?>">More</a></p>
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
            <p class="morbtn"><a href="javascript:void(0)" onclick="loadMoreBrand()">More</a></p>
        </div>
        <div class="loadmorbtn load-less-brand-div d-none">
            <p class="morbtn"><a href="javascript:void(0)" onclick="loadlessBrand()">Show Less</a></p>
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

                            <img src="assets/img/icon3.png" alt="icon3">
                        </div>
                        <h3 class="customservice">BEST VALUE</h3>
                        <div class="servicepera">vehicles offering a blend of features, performance, reliability, and affordability. Users can compare models, read expert and user reviews, and find transparent pricing information</div>
                    </div>

                    <div class="cstomflex1">
                        <div class="cstompadding">

                            <img src="assets/img/icon5.png" alt="icon5">
                        </div>
                        <h3 class="customservice">HIGHEST QUALITY</h3>
                        <div class="servicepera">handpicked assortment of vehicles renowned for their exceptional craftsmanship, durability, reliability, and advanced engineering. </div>
                    </div>

                    <div class="cstomflex1">
                        <div class="cstompadding">

                            <img src="assets/img/icon6.png" alt="icon6">
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

<?php include 'footer.php' ?> 