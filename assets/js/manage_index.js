jQuery(function () {
    getHomepageData();
});
    
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
            var fuleData = data.fule_car;
            var evData = data.ev_car;
            var hybridData = data.hybrid_car;

            if(sliderData && sliderData.length > 0)
            {
                var html_slider = "";
                sliderData.forEach(function (value) {
                    html_slider += `<div class="carimage" style="background-image: linear-gradient( rgba(8, 14, 19, 0), rgba(8, 14, 19, 1)), url('${WEB_API_FOLDER+value.file}');">
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
                    adaptiveHeight: true,
                    arrows: false
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
                    html_brand += `<div class="symbol1">
                                            <div class="kiaheight"> <img src="${WEB_API_FOLDER+value.logo}" alt="${value.brand}"></div>
                                            <p class="symbolname">${value.brand}</p>
                                        </div>`;
                    
                });
                $("#brand_list").html(html_brand);
            }
            else{
                $(".brand-area").remove();
            }
            
            if(fuleData && fuleData.length > 0)
            {
                var html_fule = "";
                fuleData.forEach(function (value) {
                    html_fule += `<div class="item" data-id="${value.id}">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file}" alt="${value.name}">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${number2text(value.price)}</h5>
                                            <p class="showroomtitle">Avg. Ex-Showroom price</p>
                                        </div>
                                        <div class="pricebox2">
                                            <p class="compareprice"><a href="#"> View Details </a></p>
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
                    html_hybrid += `<a class="item" href="${ROOT_URL}cars/${value.id}">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file}" alt="${value.name}">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${number2text(value.price)}</h5>
                                            <p class="showroomtitle">Avg. Ex-Showroom price</p>
                                        </div>
                                        <div class="pricebox2">
                                            <p class="compareprice"><a href="#"> View Details </a></p>
                                        </div>
                                    </div>
                                </a>`;       
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
                    html_ev += `<div class="item ">
                                    <div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file}" alt="${value.name}">
                                    </div>
                                    <div class="pricebox">
                                        <div class="pricebox1">
                                            <h4 class="boxtitle">${value.name}</h4>
                                            <h5 class="carprice">Rs. ${number2text(value.price)}</h5>
                                            <p class="showroomtitle">Avg. Ex-Showroom price</p>
                                        </div>
                                        <div class="pricebox2">
                                            <p class="compareprice"><a href="#"> View Details </a></p>
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