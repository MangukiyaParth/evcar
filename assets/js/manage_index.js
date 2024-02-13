jQuery(function () {
    getHomepageData();
});

function loadMoreBrand(){
    $("#brand_list").toggleClass("limited-list");
    $(".load-more-brand-div").toggleClass("d-none");
    $("#brand_list").css("max-height", "auto");
}
    
function getHomepageData(){
    var req_data = {
        op: "manage_homepage",
        action: "get_data"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var sliderData = data.slider;
            var testimonialData = data.testimonial;
            var brandData = data.brand;
            var newsData = data.news;
            var fuleData = data.fule_car;
            var evData = data.ev_car;
            var hybridData = data.hybrid_car;

            if(sliderData && sliderData.length > 0)
            {
                var html_slider = "";
                sliderData.forEach(function (value) {
                    html_slider += `<div class="carimage" style="background-image: linear-gradient( rgba(8, 14, 19, 0), rgba(8, 14, 19, 1), #FFFFFF)');">
                                        <img src="${WEB_API_FOLDER+value.file}" class="w-100"/>
                                        <div class="bgimagecar">
                                            <h2 class="worldtitle">${value.title}</h2>
                                            <p class="worldsubtitle">${value.description}</p>
                                        </div>
                                    </div>`;
                });
                $("#slider_list").html(html_slider);
                
                $('.one-time').slick({
                    dots: true,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 1,
                    adaptiveHeight: false,
                    arrows: true,
                    prevArrow: '<button type="button" class="slick-custom-arrow slick-prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </button>',
                    nextArrow: '<button type="button" class="slick-custom-arrow slick-next">  <i class="fa fa-angle-right" aria-hidden="true"></i> </button>',
                });
            }
            else{
                $(".slider-area").remove();
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
                                                        <img src="${WEB_API_FOLDER+value.file}" alt="${value.personname}" class="prsonalman">
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
                $('.testimonialslider').slick({
                    dots: false,
                    infinite: true,
                    speed: 300,
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    centerPadding: '60px',
                    prevArrow: '<button type="button" class="slick-custom-arrow slick-prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </button>',
                    nextArrow: '<button type="button" class="slick-custom-arrow slick-next">  <i class="fa fa-angle-right" aria-hidden="true"></i> </button>',
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
            
            if(brandData && brandData.length > 0)
            {
                var html_brand = "";
                brandData.forEach(function (value) {
                    html_brand += `<a class="symbol1 text-decoration-none" href="${ROOT_URL}brand/${value.id}">
                                            <div class="kiaheight"> <img src="${WEB_API_FOLDER+value.logo}" class="h-100" alt="${value.brand}"></div>
                                            <p class="symbolname">${value.brand}</p>
                                        </a>`;
                    
                });
                $("#brand_list").html(html_brand);
                var margin = (+$("#brand_list a:nth-child(1)").css('margin-top').replace('px','') * 2);
                var tot_height = +$("#brand_list a:nth-child(1)")[0].clientHeight + margin;
                var two_line_height = Math.round((tot_height * 2) + 2);
                $("#brand_list").css('max-height', two_line_height+' px'.trim());
            }
            else{
                $(".brand-area").remove();
            }
            
            if(newsData && newsData.length > 0)
            {
                var html_news = "";
                newsData.forEach(function (value) {
                    html_news += `<div class="validflex1">
                                    <img src="${WEB_API_FOLDER+value.main_image}" alt="2stcar">
                                    <h6 class="dates">${value.disp_date}</h6>
                                    <h4 class="customservice">${value.title}</h4>
                                    <p class="csrnewsub">${value.short_desc}</p>
                                    <a href="${ROOT_URL}news/${value.sub_title}" class="showall">Read More</a>
                                </div>`;
                    
                });
                $("#news_list").html(html_news);
            }
            else{
                $(".news-area").remove();
            }
            
            if(fuleData && fuleData.length > 0)
            {
                var html_fule = "";
                fuleData.forEach(function (value) {
                    html_fule += `<div class="item">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file}" alt="${value.name}">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${value.price}</h5>
                                            <p class="showroomtitle">Estimated price</p>
                                        </div>
                                        <div class="pricebox2">
                                            <p class="compareprice"><a href="${ROOT_URL}cars/${value.id}"> View Details </a></p>
                                        </div>
                                    </div>
                                </div>`;       
                });
                $("#fule_list").html(html_fule);
            }
            else{
                $(".fule-area").remove();
            }
            if(hybridData && hybridData.length > 0)
            {
                var html_hybrid = "";
                hybridData.forEach(function (value) {
                    html_hybrid += `<div class="item">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file}" alt="${value.name}">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${value.price}</h5>
                                            <p class="showroomtitle">Estimated price</p>
                                        </div>
                                        <div class="pricebox2">
                                            <p class="compareprice"><a href="${ROOT_URL}cars/${value.id}"> View Details </a></p>
                                        </div>
                                    </div>
                                </div>`;       
                });
                $("#hybrid_list").html(html_hybrid);
            }
            else{
                $(".hybrid-area").remove();
            }
            if(evData && evData.length > 0)
            {
                var html_ev = "";
                evData.forEach(function (value) {
                    html_ev += `<div class="item">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file}" alt="${value.name}">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${value.price}</h5>
                                            <p class="showroomtitle">Estimated price</p>
                                        </div>
                                        <div class="pricebox2">
                                            <p class="compareprice"><a href="${ROOT_URL}cars/${value.id}"> View Details </a></p>
                                        </div>
                                    </div>
                                </div>`;       
                });
                $("#ev_list").html(html_ev);
            }
            else{
                $(".ev-area").remove();
            }
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}