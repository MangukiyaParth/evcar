$(document).ready(function () {
    getProductDetails();
});

function getProductDetails(){
    var req_data = {
        op: "manage_frontend",
        action: "product_details",
        id: PRIMARY_ID
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var productData = data.data[0];
            var relatedData = data.related;
            var slider_html = `<div class="pro-large-img img-zoom">
                                <img src="${WEB_API_FOLDER+productData.file}" alt="product-details" />
                            </div>`;
            var slider_nav_html = `<div class="pro-nav-thumb">
                            <img src="${WEB_API_FOLDER+productData.file}" alt="product-details" />
                            </div>`;
            productData.other_img.split(',').forEach(function (value) {
                slider_html += `<div class="pro-large-img img-zoom">
                                <img src="${WEB_API_FOLDER+value}" alt="product-details" />
                            </div>`;
                slider_nav_html += `<div class="pro-nav-thumb">
                            <img src="${WEB_API_FOLDER+value}" alt="product-details" />
                            </div>`;
            });

            $(".slider-images").html(slider_html);
            $(".slider-nav").html(slider_nav_html);
            // prodct details slider active
            $('.product-large-slider').slick({
                fade: true,
                arrows: false,
                asNavFor: '.pro-nav'
            });


            // product details slider nav active
            $('.pro-nav').slick({
                slidesToShow: 4,
                asNavFor: '.product-large-slider',
                centerMode: true,
                centerPadding: 0,
                focusOnSelect: true,
                prevArrow: '<button type="button" class="slick-prev"><i class="lnr lnr-chevron-left"></i></button>',
                nextArrow: '<button type="button" class="slick-next"><i class="lnr lnr-chevron-right"></i></button>',
                responsive: [{
                    breakpoint: 576,
                    settings: {
                        slidesToShow: 3,
                    }
                }]
            });
            var rat_html = "";
            for (let r = 0; r < productData.avgrating; r++) {
                rat_html += `<span><i class="fa fa-star-o"></i></span>`;
            }
            $(".avg-ratting").html(rat_html);
            $(".product-name").html(productData.productname);
            $(".review-cnt").html(productData.receiwcnt);
            $(".srate").html(productData.srate);
            if(+productData.srate < +productData.last_srate){
                $(".last_srate").html(productData.last_srate);
            }
            else{
                $(".price-old").remove();
            }
            $(".pro-desc").html(productData.descr);
            $(".color-name").html(productData.colorname);

            // Review
            if(productData.personproductchk == 1 && productData.reveiwadded == 0){
                var review_html = "";
                productData.reviews.forEach(function (reviewData) {
                    var rattings = "";
                    for (let ar = 0; ar < reviewData.rating; ar++) {
                        rattings += `<span class="good"><i class="fa fa-star"></i></span>`;
                    }
                    review_html += `<div class="total-reviews">
                            <div class="review-box">
                                <div class="ratings">
                                    ${rattings}
                                </div>
                                <div class="post-author">
                                    <p><span>${reviewData.name} -</span> ${reviewData.datef}</p>
                                </div>
                                <p>${reviewData.review}</p>
                                </div>
                        </div>`;
                });
            }
            else {
                $("#review-form").remove();
            }

            // Related Products
            if(relatedData && relatedData.length > 0){
                var relatedhtml = "";
                relatedData.forEach(function (value) {
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
                    relatedhtml += `<div class="product-item">
                            <figure class="product-thumb" style="width: 100%;display: inline-block;margin-top: 5px;">
                                <a href="${ROOT_URL}product-details/${value.id}">
                                    <img class="pri-img" style="height:300px" src="${WEB_API_FOLDER+value.file}" alt="product">
                                </a>
                                ${discHTML}
                                <div class="button-group">
                                    <a href="javascript:void(0);" class="wishlist${value.id} ${(value.in_wishlist) ? 'active' : ''}" onclick="addwishlist('${value.id}')" data-bs-toggle="tooltip" title="Add to Wishlist"><i class="pe-7s-like"></i></a>
                                    <a href="javascript:void(0);" onclick="addtocart('${value.id}')" data-bs-toggle="tooltip" title="Add to Cart"><i class="pe-7s-cart"></i></a>
                                </div>
                            </figure>
                            <div class="product-caption text-center">
                                <h6 class="product-name">
                                    <a href="${ROOT_URL}product-details/${value.id}">${value.productname}</a>
                                </h6>
                                <div class="price-box">
                                    <span class="price-regular">₹ ${value.srate}</span>
                                    ${oldpriceHTML}
                                </div>
                            </div>
                        </div>`;
                });
                $(".related-list").html(relatedhtml);

                // product carousel active js
                $('.product-carousel-4').slick({
                    speed: 1000,
                    slidesToShow: 4,
                    adaptiveHeight: true,
                    prevArrow: '<button type="button" class="slick-prev"><i class="pe-7s-angle-left"></i></button>',
                    nextArrow: '<button type="button" class="slick-next"><i class="pe-7s-angle-right"></i></button>',
                    responsive: [{
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 3
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 2,
                            arrows: false
                        }
                    },
                    {
                        breakpoint: 480,
                        settings: {
                            slidesToShow: 1,
                            arrows: false
                        }
                    }]
                });

                if(productData.in_wishlist) {
                    $(".wishlist"+productData.id).addClass('active');
                }
                else {
                    $(".wishlist"+productData.id).removeClass('active');
                }
            }
            else{
                $(".related-products").remove();
            }

            return false;
        }
        else if (data && data != null && data.success == false) {
            
            return false;
        }
    });
}

if($('#review-form').length)
{		
    $('#review-form').validate({
        rules:{
            rating:{
                required: true,
            },
            review:{
                required: true,
            },		
        },
        messages:{
            rating:{
                required: "Select at list one star",
            },
            review:{
                required: "Review is required",
            },
        },
        submitHandler: function(form){

            formdata = new FormData(form);
            formdata.append("action", "insertreveiw");
            $('.loading').show();
            jqXHR = $.ajax({
                url : "getdata.php",
                type : "POST",
                dataType: "json",
                data: formdata,
                processData: false,
                contentType: false,
                success : function(data) 
                {
                    var JsonData = JSON.stringify(data);
                    var resultdata = jQuery.parseJSON(JsonData);
    
                    $('.loading').hide();
                    if (resultdata.status == 0) 
                    {
                        alertify.error(resultdata.message);
                    }
                    else if(resultdata.status == 1)
                    {
                        alertify.success(resultdata.message);
                        $("#review-form").validate().resetForm();
                        $('#review-form').trigger("reset");
                    }
                }
            });
            
        }
    });
}