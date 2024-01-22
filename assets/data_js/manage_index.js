var currentPageNumber = 1; // initialization before all functions
var dataAvailable = true;

$(document).ready(function () {
    getProduct();
    getHomepageData();
});

function getProduct(){
    var length = 10;
    var start = (currentPageNumber - 1) * length;
    var req_data = {
        op: "manage_product",
        action: "get_data",
        page: currentPageNumber,
        start: start,
        length: length
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var productData = data.data;
            var html = "";
            var i = 1;
            productData.forEach(function (value) {
                var discHTML = "";
                var oldpriceHTML = "";
                if(+value.last_srate > +value.srate )
                {
                    var ratper=100-((+value.srate*100)/value.last_srate);
                    discHTML=`<div class="product-badge">
                                        <div class="product-label new">
                                            <span>-${ratper.toFixed(2)}%</span>
                                        </div>
                                    </div>`;
                    oldpriceHTML=`<span class="price-old"><del>₹${value.last_srate}</del></span>`;
                }
                html += `<div class="product-item col-12 col-sm-3" style="display: inline-block;margin-top: 5px;">
                            <figure class="product-thumb">
                                <a href="${ROOT_URL}product-details/${value.id}">
                                    <img class="pri-img" style="height:300px" src="admin_panel/api_services/${value.file}" alt="product">
                                </a>
                                ${discHTML}
                                <div class="button-group">
                                    <a href="javascript:void(0);" onclick="addwishlist('${value.id}')" data-bs-toggle="tooltip" title="Add to Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="javascript:void(0);" onclick="addtocart('${value.id}')" data-bs-toggle="tooltip" title="Add to Cart"><i class="pe-7s-cart"></i></a>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <h6 class="product-name">
                                    <a href="${ROOT_URL}product-details/${value.id}">${value.productname}</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">₹${value.srate}</span>
                                    ${oldpriceHTML}
                                </div>
                            </div>
                        </div>`;
                i++;
            });
            if (currentPageNumber == 1) {
                $("#product_list").html(html);
            }
            else {
                $("#product_list").append(html);
            }
            return false;
        }
        else if (data && data != null && data.success == false) {
            if (currentPageNumber == 1) {
                $("#product_list").html("<h1 class='no-data-found'>" + data.message + "</h1>");
            }
            dataAvailable = false;
            return false;
        }
    });
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
            var futureProductData = data.future_data;

            if(sliderData && sliderData.length > 0)
            {
                var html_slider = "";
                sliderData.forEach(function (value) {
                    html_slider += `<div class="hero-single-slide hero-overlay">
                        <div class="hero-slider-item bg-img" data-bg="${WEB_API_FOLDER+value.file}" style="background-image: url(${WEB_API_FOLDER+value.file})">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="hero-slider-content slide-1">
                                            <h2 class="slide-title">${value.title}</h2>
                                            <h6 class="slide-desc">${value.description}</h6>
                                            <a href="shop.php" class="btn btn-hero">${value.btntext}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>`;
                });
                $("#slider_list").html(html_slider);
                
                $('.hero-slider-active').slick({
                    fade: true,
                    speed: 1000,
                    dots: false,
                    autoplay: false,
                    prevArrow: '<button type="button" class="slick-prev"><i class="pe-7s-angle-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="pe-7s-angle-right"></i></button>',
                    responsive: [{
                        breakpoint: 992,
                        settings: {
                            arrows: false,
                            dots: true
                        }
                    }]
                });
            }
            else{
                $(".slider-area").remove();
            }

            if(testimonialData && testimonialData.length > 0)
            {
                var html_testimonial = "";
                testimonialData.forEach(function (value) {
                    html_testimonial += `<div class="testimonial-content">
                                            <div class="testimonial-thumb">
                                                <img src="${WEB_API_FOLDER+value.file}" alt="testimonial-thumb">
                                            </div>
                                            <p>${value.description}</p>
                                            <h6 class="testimonial-author">${value.personname}</h6>
                                            <span>${value.desig}</span>
                                        </div>`;
                });
                $("#testimonial_list").html(html_testimonial);
                $('.testimonial-carousel').slick({
                    arrows: false,
                    centerPadding: 0,
                    focusOnSelect: true
                });
            }
            else{
                $(".testimonial-area").remove();
            }

            if(futureProductData && futureProductData.length > 0){
                var future_html = "";
                futureProductData.forEach(function (value) {
                    var discHTML = "";
                    var oldpriceHTML = "";
                    if(+value.last_srate > +value.srate )
                    {
                        var ratper=100-((+value.srate*100)/value.last_srate);
                        discHTML=`<div class="product-badge">
                                            <div class="product-label new">
                                                <span>-${ratper.toFixed(2)}%</span>
                                            </div>
                                        </div>`;
                        oldpriceHTML=`<span class="price-old"><del>₹${value.last_srate}</del></span>`;
                    }
                    future_html += `<div class="product-item col-12 col-sm-3" style="display: inline-block;margin-top: 5px;">
                                <figure class="product-thumb">
                                    <a href="${ROOT_URL}product-details/${value.id}">
                                        <img class="pri-img" style="height:300px" src="admin_panel/api_services/${value.file}" alt="product">
                                    </a>
                                    ${discHTML}
                                    <div class="button-group">
                                        <a href="javascript:void(0);" onclick="addwishlist('${value.id}')" data-bs-toggle="tooltip" title="Add to Wishlist"><i class="pe-7s-like"></i></a>
                                        <a href="javascript:void(0);" onclick="addtocart('${value.id}')" data-bs-toggle="tooltip" title="Add to Cart"><i class="pe-7s-cart"></i></a>
                                    </div>
                                </figure>
                                <div class="product-caption text-center">
                                    <h6 class="product-name">
                                        <a href="${ROOT_URL}product-details/${value.id}">${value.productname}</a>
                                    </h6>
                                    <div class="price-box">
                                        <span class="price-regular">₹${value.srate}</span>
                                        ${oldpriceHTML}
                                    </div>
                                </div>
                            </div>`;
                });
                $("#future_product_list").html(future_html);
            }
            else {
                $(".future-product-area").remove();
            }
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}

