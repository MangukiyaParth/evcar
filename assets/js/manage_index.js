var sliderData = [];
var testimonialData = [];
var brandData = [];
var newsData = [];
var fuleData = [];
var evData = [];
var hybridData = [];
var upcomingData = [];
var trandingData = [];
var is_all_brand_listed = false;

jQuery(function () {
    getHomepageData();
});

function loadMoreBrand(){
    if(!is_all_brand_listed && brandData && brandData.length > 0)
    {
        var html_brand = "";
        var brand_index = 0;
        brandData.forEach(function (value) {
            if(brand_index >= 12){
                html_brand += `<a class="symbol1 text-decoration-none" href="${ROOT_URL}brand/${value.encode_name}">
                                    <div class="kiaheight"> 
                                    <img src="${WEB_API_FOLDER+value.logo.replace('/images_thumb/','/images_thumb/')}" class="h-100 tmp-img1" alt="${value.brand}">
                                    </div>
                                    <p class="symbolname">${value.brand}</p>
                                </a>`;
            }
            brand_index++;
        });
        $("#brand_list").append(html_brand);
        // show_real_image("#brand_list .tmp-img");
        is_all_brand_listed = true;
    }
    $("#brand_list").toggleClass("limited-list");
    $(".load-more-brand-div").toggleClass("d-none");
    $(".load-less-brand-div").toggleClass("d-none");
    $("#brand_list").css("max-height", "auto");
}
function loadlessBrand(){
    $("#brand_list").toggleClass("limited-list");
    $(".load-more-brand-div").toggleClass("d-none");
    $(".load-less-brand-div").toggleClass("d-none");
    var margin = (+$("#brand_list a:nth-child(1)").css('margin-top').replace('px','') * 2);
    var tot_height = +$("#brand_list a:nth-child(1)")[0].clientHeight + margin;
    var two_line_height = Math.round((tot_height * 2) + 2);
    $("#brand_list").css('max-height', two_line_height+' px'.trim());
}
    
function getHomepageData(){
    var req_data = {
        op: "manage_homepage",
        action: "get_data"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            sliderData = data.slider;
            testimonialData = data.testimonial;
            brandData = data.brand;
            newsData = data.news;
            fuleData = data.fule_car;
            evData = data.ev_car;
            hybridData = data.hybrid_car;
            upcomingData = data.upcoming_car;
            trandingData = data.tranding_car;

            if(sliderData && sliderData.length > 0)
            {
                var html_slider = "";
                var slider_index = 0;
                sliderData.forEach(function (value) {
                    html_slider += `<div class="carimage" style="background-image: linear-gradient( rgba(8, 14, 19, 0), rgba(8, 14, 19, 1), #FFFFFF)');">
                                        <img src="${WEB_API_FOLDER+value.file.replace('/images_thumb/','/images_thumb/')}" alt="slider-${slider_index}" class="tmp-img1 w-100"/>
                                        <div class="bgimagecar">
                                            <h2 class="worldtitle">${value.title}</h2>
                                            <p class="worldsubtitle">${value.description}</p>
                                        </div>
                                    </div>`;
                    slider_index++;
                });
                $("#slider_list").html(html_slider);
                // show_real_image("#slider_list .tmp-img");
                
                $('.one-time').slick({
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    adaptiveHeight: false,
                    arrows: true,
                    prevArrow: '<button type="button" class="slick-custom-arrow slick-prev" title="slide Prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </button>',
                    nextArrow: '<button type="button" class="slick-custom-arrow slick-next" title="slide Next">  <i class="fa fa-angle-right" aria-hidden="true"></i> </button>',
                });
                $(".slider-area").removeClass('skeleton');
            }
            else{
                $(".slider-area").remove();
            }

            if(evData && evData.length > 0)
            {
                var html_ev = "";
                evData.forEach(function (value) {
                    html_ev += `<div class="item" onclick="window.location.href='${ROOT_URL}cars/${value.encode_name}'">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file.replace('/images_thumb/','/images_thumb/')}" alt="${value.name}" class="tmp-img1">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1 w-100">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${value.price}</h5>
                                            <div class="pricebox-bottom">
                                                <p class="showroomtitle">Estimated price</p>
                                                <p class="compareprice"><a href="${ROOT_URL}cars/${value.encode_name}"> View Details </a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;       
                });
                $("#ev_list").html(html_ev);
                // show_real_image("#ev_list .tmp-img");
                $(".ev-area .loadmorbtn, .ev-area .cartitle").removeClass('d-none');
                $(".ev-area .skeleton-car-list-title").remove();
            }
            else{
                $(".ev-area").remove();
            }

            if(hybridData && hybridData.length > 0)
            {
                var html_hybrid = "";
                hybridData.forEach(function (value) {
                    html_hybrid += `<div class="item" onclick="window.location.href='${ROOT_URL}cars/${value.encode_name}'">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file.replace('/images_thumb/','/images_thumb/')}" alt="${value.name}" loading="lazy" class="tmp-img1">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1 w-100">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${value.price}</h5>
                                            <div class="pricebox-bottom">
                                                <p class="showroomtitle">Estimated price</p>
                                                <p class="compareprice"><a href="${ROOT_URL}cars/${value.encode_name}"> View Details </a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;       
                });
                $("#hybrid_list").html(html_hybrid);
                // show_real_image("#hybrid_list .tmp-img");
                $(".hybrid-area .loadmorbtn, .hybrid-area .cartitle").removeClass('d-none');
                $(".hybrid-area .skeleton-car-list-title").remove();
            }
            else{
                $(".hybrid-area").remove();
            }

            if(fuleData && fuleData.length > 0)
            {
                var html_fule = "";
                fuleData.forEach(function (value) {
                    html_fule += `<div class="item" onclick="window.location.href='${ROOT_URL}cars/${value.encode_name}'">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file.replace('/images_thumb/','/images_thumb/')}" alt="${value.name}" loading="lazy" class="tmp-img1">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1 w-100">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${value.price}</h5>
                                            <div class="pricebox-bottom">
                                                <p class="showroomtitle">Estimated price</p>
                                                <p class="compareprice"><a href="${ROOT_URL}cars/${value.encode_name}"> View Details </a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;       
                });
                $("#fule_list").html(html_fule);
                // show_real_image("#fule_list .tmp-img");
                $(".fule-area .loadmorbtn, .fule-area .cartitle").removeClass('d-none');
                $(".fule-area .skeleton-car-list-title").remove();
            }
            else{
                $(".fule-area").remove();
            }

            if(upcomingData && upcomingData.length > 0)
            {
                var html_upcoming = "";
                upcomingData.forEach(function (value) {
                    html_upcoming += `<div class="item" onclick="window.location.href='${ROOT_URL}cars/${value.encode_name}'">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file.replace('/images_thumb/','/images_thumb/')}" alt="${value.name}" loading="lazy" class="tmp-img1">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1 w-100">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${value.price}</h5>
                                            <div class="pricebox-bottom">
                                                <p class="showroomtitle">Estimated price</p>
                                                <p class="compareprice"><a href="${ROOT_URL}cars/${value.encode_name}"> View Details </a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;       
                });
                $("#upcoming_list").html(html_upcoming);
                // show_real_image("#upcoming_list .tmp-img");
                $(".upcoming-area .loadmorbtn, .upcoming-area .cartitle").removeClass('d-none');
                $(".upcoming-area .skeleton-car-list-title").remove();
            }
            else{
                $(".upcoming-area").remove();
            }
            
            if(trandingData && trandingData.length > 0)
            {
                var html_tranding = "";
                let slide_index = 1;
                trandingData.forEach(function (value) {
                    html_tranding += `<a class="tranding-item" href="${ROOT_URL}cars/${value.encode_name}">
                                        <div class="pricebox">
                                            <span class="slide-index">${slide_index}</span>
                                            <div class="pricebox1 w-100">
                                                <h5>${value.name}</h5>
                                            </div>
                                        </div>
                                        <div class="carimagrang">
                                            <img src="${WEB_API_FOLDER+value.file.replace('/images_thumb/','/images_thumb/')}" loading="lazy" alt="${value.name}" class="tmp-img1">
                                        </div>
                                    </a>`;   
                    slide_index++;   
                });
                $("#tranding_list").html(html_tranding);
                // show_real_image("#tranding_list .tmp-img");
                $(".tranding-area").removeClass('d-none');
                $('.trandingslider').slick({
                    dots: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    centerPadding: '60px',
                    prevArrow: '<button type="button" class="slick-custom-arrow slick-prev" title="slide Prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </button>',
                    nextArrow: '<button type="button" class="slick-custom-arrow slick-next" title="slide Next">  <i class="fa fa-angle-right" aria-hidden="true"></i> </button>',
                    responsive: [{
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
            else{
                $(".tranding-area").remove();
            }

            if(brandData && brandData.length > 0)
            {
                var html_brand = "";
                var brand_index = 0;
                brandData.forEach(function (value) {
                    if(brand_index < 12){
                        html_brand += `<a class="symbol1 text-decoration-none" href="${ROOT_URL}brand/${value.encode_name}">
                                                <div class="kiaheight"> 
                                                <img src="${WEB_API_FOLDER+value.logo.replace('/images_thumb/','/images_thumb/')}" class="h-100 tmp-img1" loading="lazy" alt="Brand ${value.brand}">
                                                </div>
                                                <p class="symbolname">${value.brand}</p>
                                            </a>`;
                        brand_index++;
                    }
                    else{
                        return true;
                    }
                });
                $("#brand_list").html(html_brand);
                // show_real_image("#brand_list .tmp-img");
                var margin = (+$("#brand_list a:nth-child(1)").css('margin-top').replace('px','') * 2);
                var tot_height = +$("#brand_list a:nth-child(1)")[0].clientHeight + margin;
                var two_line_height = Math.round((tot_height * 2) + 2);
                $("#brand_list").css('max-height', two_line_height+' px'.trim());
            }
            else{
                $(".brand-area").remove();
            }

            if(testimonialData && testimonialData.length > 0)
            {
                var html_testimonial = "";
                testimonialData.forEach(function (value) {
                    html_starts = "";
                    for (let st = 1; st <= 5; st++) {
                        cls = "greycolor";
                        if(st <= value.rating) cls="yellowcolor";
                        html_starts += `<i class="fa fa-star ${cls}" aria-hidden="true"></i> `;
                    }
                    html_testimonial += `<div class="alltestimonial">
                                            <div class="reviwprevioue">
                                                <div class="testimonialfle d-flex align-items-center ">
                                                    <div class="testimonialman">
                                                        <img src="${WEB_API_FOLDER+value.file.replace('/images_thumb/','/images_thumb/')}" loading="lazy" alt="${value.personname}" class="tmp-img1 prsonalman">
                                                    </div>
                                                    <div class="testimonailperson">
                                                        <h5 class="personname reviedetail">${value.personname}</h5>
                                                    </div>
                                                </div>
                                                <div class="testborder"></div>
                                                <div class="starname">
                                                    <div class="review">
                                                        ${html_starts}
                                                    </div>
                                                    <p class="reviedetail">${value.description}</p>
                                                    <h6 class="reviewdate">${value.disp_date}</h6>
                                                </div>
                                            </div>
                                        </div>`;
                    
                });
                $("#testimonial_list").html(html_testimonial);
                // show_real_image("#testimonial_list .tmp-img");
                $('.testimonialslider').slick({
                    dots: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    centerPadding: '60px',
                    prevArrow: '<button type="button" class="slick-custom-arrow slick-prev" title="slide Prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </button>',
                    nextArrow: '<button type="button" class="slick-custom-arrow slick-next" title="slide Next">  <i class="fa fa-angle-right" aria-hidden="true"></i> </button>',
                    responsive: [{
                            breakpoint: 991,
                            settings: {
                                slidesToShow: 3,
                                slidesToScroll: 1,
                                infinite: true,
                                dots: true
                            }
                        },
                        {
                            breakpoint: 600,
                            settings: {
                                slidesToShow: 2,
                                slidesToScroll: 2
                            }
                        },
                        {
                            breakpoint: 480,
                            settings: {
                                slidesToShow: 1,
                                slidesToScroll: 1
                            }
                        }
                    ]
                });
            }
            else{
                $(".testimonial-area").remove();
            }
            
            if(newsData && newsData.length > 0)
            {
                var html_news = "";
                newsData.forEach(function (value) {
                    html_news += `<a class="validflex1" href="${ROOT_URL}news/${value.sub_title}">
                                    <img src="${WEB_API_FOLDER+value.main_image.replace('/images_thumb/','/images_thumb/')}" class="2stcar tmp-img1" loading="lazy" alt="${value.title}">
                                    <span class="dates">${value.disp_date}</span>
                                    <h4 class="customservice news-title">${value.title}</h4>
                                    <p class="csrnewsub news-desc">${value.short_desc}</p>
                                    <span class="showall">Read More</span>
                                </a>`;
                    
                });
                $("#news_list").html(html_news);
                // show_real_image("#news_list .tmp-img");
            }
            else{
                $(".news-area").remove();
            }
            
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}