var pageLoadFlag = true;
var current_user = null;

$(document).ready(function () {
    get_cart_data();
});

// offcanvas minicart button js
$(".loginuser").on('click', function(){
    if(ISLOGIN == '1')
    {
        window.location=ROOT_URL+"my-account";
    }else{
        showLoginModal();    
    }
});

function showLoginModal(){
    changeLoginView(0);
    $("#login_registerModal").modal('show');
}

function changeLoginView(showSignup){
    if(showSignup){
        $(".signup-div").show();
        $(".login-div").hide();
    }
    else {
        $(".signup-div").hide();
        $(".login-div").show();
    }
}

$(".minicart-btn").on('click', function(){
    setcartdata();
})
$(".offcanvas-close, .minicart-close,.offcanvas-overlay").on('click', function(){
    $("body").removeClass('fix');
    $(".minicart-inner").removeClass('show')
})

jQuery["postJSON"] = function (url, data, callback) {
    if (jQuery.isFunction(data)) {
        callback = data;
        data = undefined;
    }

    return jQuery.ajax({
        url: url,
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: data,
        success: callback
    });
};

function doAPICall(obj, callback, is_async) {

    is_async = (typeof (is_async) == 'undefined' || is_async) ? true : false;
    var data = {};
    for (var key in obj) {
        if (obj.hasOwnProperty(key)) {
            if (typeof (obj[key]) != "string") {
                data[key] = obj[key];
            }
            else {

                if (obj[key] == "Invalid date") {
                    showError(ERROR_MESSAGE_INVALID_DATE);
                    PREVENT_API_CALL = true;
                    break;
                }
                data[key] = obj[key].replace(/''/g, '&apos;').replace(/\'/g, '&apos;').replace(/'/g, "&apos;");
            }
        }
    }

    data["version"] = "web";
    data["from"] = REQ_FROM;
    if (CURRENT_USER_ID != "") data["user_id"] = CURRENT_USER_ID;

    var settings = {
        type: "POST",
        url: API_SERVICE_URL,
        data: data,
        async: is_async,
        dataType: 'json',
        "crossDomain": true,
        "headers": {}
    }
    $.ajax(settings).done(function (response) {
        $("#btn_save,button.edit.btn-success").button('reset');
        response = response || {};
        responseString = JSON.stringify(response).replace(/''/g, '&apos;').replace(/\'/g, '&apos;').replace(/&apos;/g, "'");
        response = JSON.parse(responseString);
        if (parseInt(response.status) == -2) {
            // window.location = notify_panel_url+"logout";
        }
        if (response.error) {
            showError(JSON.stringify(response.error), "ERROR");
        }
        else {
            callback(response);
        }
    }).fail(function (err) {
        $("#btn_save,button.edit.btn-success").button('reset');
        //console.log(err);
        if (err.readyState != 0) {
        }
    });
}

function posted_ago(db_date, tz_offset) {
    //console.log("DB DATE : "+db_date + " OFFSET: "+tz_offset);
    var dateString = db_date.match(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/);
    var db_date = new Date(dateString[1], dateString[2] - 1, dateString[3], dateString[4], dateString[5], dateString[6]);
    //var db_date  = new Date(""+db_date);
    var client_tz_ms = db_date.getTime() + (-1 * tz_offset * 60 * 1000);
    var client_date = new Date(client_tz_ms);

    if (client_date) {
        var seconds = Math.floor(((new Date()).getTime() - client_date.getTime()) / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);
        var time_display_text = seconds + " seconds ago.";
        if (minutes > 0) {
            if (hours > 0) {
                if (days > 0) {
                    time_display_text = days + " day ago.";
                }
                else {
                    time_display_text = hours + " hour ago.";
                }
            }
            else {
                time_display_text = minutes + " minute ago.";
            }
        }

        return time_display_text;
    }

    return false;
}

function to_number_format(x) {
    x=Number(x).toFixed(2).toString();
    var afterPoint = '';
    if(x.indexOf('.') > 0)
        afterPoint = x.substring(x.indexOf('.'),x.length);
    x = Math.floor(x);
    x=x.toString();
    var lastThree = x.substring(x.length-3);
    var otherNumbers = x.substring(0,x.length-3);
    if(otherNumbers != '')
        lastThree = ',' + lastThree;
    var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
    return res;
}

function addwishlist(productid)
{
    if(ISLOGIN == '1')
    {
        $('.loading').show();
        var req_data = {
            op: "manage_frontend",
            action: "add_to_wishlist",
            productid: productid,
        };
        doAPICall(req_data, async function(data){
            $('.loading').hide();
            if (data && data != null && data.success) {
                alertify.success(data.message);
                if(data.added) {
                    $(".wishlist"+productid).addClass('active');
                }
                else {
                    $(".wishlist"+productid).removeClass('active');
                }
                return false;
            }
            else if (data && data != null && !data.success) {
                alertify.error(data.message);
                return false;
            }
        });

    }else{
        showLoginModal();
    }
}

function addtocart(productid,typeid = 1)
{
    if(ISLOGIN == '1')
    {
        $('.loading').show();
        var req_data = {
            op: "manage_frontend",
            action: "add_to_cart",
            productid: productid,
            typeid: typeid,
            pqty: $('#pqty').val() || 1,
        };
        doAPICall(req_data, async function(data){
            $('.loading').hide();
            if (data && data != null && data.success) {
                alertify.success(data.message);
                var itemData = data.data;
                add_item_to_localstorage(itemData);
                setcartdata();
                if(typeid == 2)
                {
                    window.location=ROOT_URL+"cart";
                }
                return false;
            }
            else if (data && data != null && !data.success) {
                alertify.error(data.message);
                return false;
            }
        });
    }else{
        showLoginModal();
    }
}

function add_item_to_localstorage(item){
    var cart_item = localStorage.getItem("cart_item");
    var item_data = (cart_item == null) ? [] : JSON.parse(cart_item);
    item_data = $.grep(item_data, function(e){ 
        return e.id != item.id; 
    });
    item_data.push(item);
    localStorage.setItem("cart_item", JSON.stringify(item_data));
    $(".cart_item_cnt").html(item_data.length);
}

function remove_item_from_localstorage(item_id){
    var cart_item = localStorage.getItem("cart_item");
    var item_data = (cart_item == null) ? [] : JSON.parse(cart_item);
    item_data = $.grep(item_data, function(e){ 
        return e.id != item_id; 
    });
    localStorage.setItem("cart_item", JSON.stringify(item_data));
    $(".cart_item_cnt").html(item_data.length);
}

function setcartdata(openCart=true) {
    var cart_item = localStorage.getItem("cart_item");
    var item_data = (cart_item == null) ? [] : JSON.parse(cart_item);

    if(item_data.length > 0)
    {
        var cart_html = `<div class="minicart-item-wrapper">
        <ul>`;
        var total_amt = 0;
        item_data.forEach(itemData => {
            total_amt=total_amt + (+itemData.qty * +itemData.srate);
            cart_html += `<li class="minicart-item">
                            <div class="minicart-thumb">
                                <a href="${ROOT_URL}product-details/${itemData.id}">
                                    <img src="${WEB_API_FOLDER+itemData.file}" alt="product">
                                </a>
                            </div>
                            <div class="minicart-content">
                                <h6 class="product-name">
                                    <a href="${ROOT_URL}product-details/${itemData.id}">${itemData.productname}</a>
                                </h6>
                                <p>
                                    <span class="cart-quantity"> ${itemData.qty} <strong>&times;</strong></span>
                                    <span class="cart-price">₹${itemData.srate}</span>
                                </p>
                            </div>
                            <button class="minicart-remove"><a javascript:void(0); onclick="removefromcart('${itemData.id}');"><i class="pe-7s-close"></i></a></button>
                        </li>`;
        });
        var gst_amt = (+total_amt*GST)/100;
        var final_amt = +total_amt + +gst_amt;

        cart_html += `</ul>
        </div>

        <div class="minicart-pricing-box">
            <ul>
                <li>
                    <span>sub-total</span>
                    <span><strong>₹${to_number_format(total_amt)}</strong></span>
                </li>
                <li>
                    <span>GST (${GST}%)</span>
                    <span><strong>₹${to_number_format(gst_amt)}</strong></span>
                </li>
                <li class="total">
                    <span>total</span>
                    <span><b><strong>₹${to_number_format(final_amt)}</strong></b></span>
                </li>
            </ul>
        </div>

        <div class="minicart-button">
            <!-- <a href="${ROOT_URL}cart"><i class="fa fa-shopping-cart"></i> View Cart</a> -->
            <a href="${ROOT_URL}checkout"><i class="fa fa-share"></i> Checkout</a>
        </div>`;
        $('.minicart-content-box').html(cart_html);
        if(openCart){
            $("body").addClass('fix');
            $(".minicart-inner").addClass('show');
        }
    }
    else{
        $('.minicart-content-box').html("<h3 class='no-products-msg'>No Products in your cart!</h3>");
    }
}

function get_cart_data(){
    if(ISLOGIN == '1')
    {
        $('.loading').show();
        var req_data = {
            op: "manage_frontend",
            action: "get_cart_data",
        };
        doAPICall(req_data, async function(data){
            $('.loading').hide();
            if (data && data != null && data.success) {
                var itemData = data.data;
                localStorage.setItem("cart_item", JSON.stringify(itemData));
                $(".cart_item_cnt").html(itemData.length);
                return false;
            }
            else if (data && data != null && !data.success) {
                return false;
            }
        }, true);
    }
}

function removefromcart(productid) {
    if(ISLOGIN == '1')
    {
        $('.loading').show();
        var req_data = {
            op: "manage_frontend",
            action: "remove_from_cart",
            productid: productid,
        };
        doAPICall(req_data, async function(data){
            $('.loading').hide();
            if (data && data != null && data.success) {
                alertify.success(data.message);
                var itemData = data.data;
                remove_item_from_localstorage(productid);
                setcartdata(false);
                return false;
            }
            else if (data && data != null && !data.success) {
                alertify.error(data.message);
                return false;
            }
        });
    }else{
        showLoginModal();
    }
}

function logout_user(){
    localStorage.removeItem("cart_item");
    $(".cart_item_cnt").html(0);
    $('.minicart-content-box').html("<h3 class='no-products-msg'>No Products in your cart!</h3>");
    window.location=ROOT_URL+"logout";
}
if($('#frmregister').length)
{		
    $('#frmregister').validate({
        rules:{
            firstname:{
                required: true,
            },
            lastname:{
                required: true,
            },
            email:{
                required:true,
                email: true,					
            },
            passw:{
                required: true,
            },
            repassword:{
                required: true,
                equalTo:'#passw',
            },		
        },
        messages:{
            firstname:{
                required: "First Name is required",
            },
            lastname:{
                required: "Last Name is required",
            },
            email:{
                required: "Username is required",
                alphanumunderdot: "Invalid username",
                remote: "User name is already exist",
            },
            passw:{
                required:"Password is required",
            },
            repassword:{
                required:"Confirm password is required",
                equalTo: "Confirm password must be same as password"
            },
        },
        submitHandler: function(form){
            
            $('.loading').show();
            var req_data = {
                op: "manage_frontend",
                action: "signup",
                firstname: $("#firstname").val(),
                lastname: $("#lastname").val(),
                contact: $("#contact").val(),
                email: $("#email").val(),
                passw: $("#passw").val(),
            };
            doAPICall(req_data, async function(data){
                $('.loading').hide();
                if (data && data != null && data.success == true) {
                    alertify.success(data.message);
                    ISLOGIN = '1';
                    get_cart_data();
                    $("#login_registerModal").modal('hide');
                    return false;
                }
                else if (data && data != null && data.success == false) {
                    alertify.error(data.message);
                    return false;
                }
            });
            
        }
    });
}
if($('#frmlogin').length)
{		
    $('#frmlogin').validate({
        rules:{
            
            login_email:{
                required:true,
                email: true,					
            },
            login_password:{
                required: true,
            },	
        },
        messages:{
            login_email:{
                required: "Username is required",
                alphanumunderdot: "Invalid username",
            },
            login_password:{
                required:"Password is required"
            },
        },
        submitHandler: function(form){
            
            $('.loading').show();
            var req_data = {
                op: "login_user",
                email: $("#login_email").val(),
                password: $("#login_password").val(),
            };
            doAPICall(req_data, async function(data){
                $('.loading').hide();
                if (data && data != null && data.success == true) {
                    alertify.success(data.message);
                    ISLOGIN = '1';
                    get_cart_data();
                    $("#login_registerModal").modal('hide');
                    return false;
                }
                else if (data && data != null && data.success == false) {
                    alertify.error(data.message);
                    return false;
                }
            });
            
        }
    });
}