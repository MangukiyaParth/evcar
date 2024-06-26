jQuery(function () {
    // var footer_data = localStorage.getItem("footer_data");
    // var itemData = (footer_data == null) ? [] : JSON.parse(footer_data);
    // if(itemData.length > 0){
    //     set_footer_data();
    // }
    // else {
    //     get_footer_data();
    // }
    $('.search').keyup(function() {
		var query = $(this).val();
        var searchListDiv = $(this).parent('.search-div').find('.searchCarList');
		if (query != '') {
			get_car_suggestion(query, searchListDiv);
		} else {
			searchListDiv.fadeOut();
			searchListDiv.html('');
		}
	});

	$(document).on('click', 'li.searchresult', function() {
		$(this).parents('.search-div').find('.search').val($(this).text());
		$(this).parents('.search-div').find('.searchCarList').fadeOut();
	});

    $(".btnSearch").on('click', function(){
        if($(this).parent('.search-div').find('.search').val() != ""){
            window.location = ROOT_URL+'search/'+$(this).parent('.search-div').find('.search').val().replace(/ /g, '-');
        }
    });

    $('#web_comman_ListModal').on('hidden.bs.modal', function () {
        if($('#web_comman_ListModal .preview-img').length == 1){
            $('#web_comman_ListModal .preview-img').remove();
            $('.preview-img').slick('unslick');
        }
    });
});
    
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

function showLoading(){}
function hideLoading(){}

function to_number_format(x) {
    x=x.toFixed(2).toString();
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

function number2text(value) {
    var fraction = Math.round((value % 1)*100);
    var f_text  = "";

    if(fraction > 0) {
        f_text = " AND "+convert_number(fraction);
    }

    return convert_number(value)+""+f_text;
}

function convert_number(number)
{
    if ((number < 0) || (number > 999999999)) 
    { 
        return "NUMBER OUT OF RANGE!";
    }
    var Gn = Math.floor(number / 10000000);  /* Crore */ 
    number -= Gn * 10000000; 
    var kn = Math.floor(number / 100000);     /* lakhs */ 
    number -= kn * 100000; 
    var Hn = Math.floor(number / 1000);      /* thousand */
    var res = ""; 

    if (Gn>0){ 
        res += Gn; 
    } 

    if (kn>0) { 
        res += kn; 
    } 
    else if(Gn>0){
        res += '00'; 
    }

    if (Hn>0 && kn == 0) {
        res += "0."+Hn; 
    } 
    else if (Hn>0) { 
        res += "."+Hn; 
    } 
    res += " Lakh"; 
    return res;
}

function get_footer_data(){
    var req_data = {
        op: "manage_homepage",
        action: "get_data"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var fuleData = data.fule_car;
            var evData = data.ev_car;
            var hybridData = data.hybrid_car;

            var footer_data = [];
            footer_data.push(fuleData);
            footer_data.push(evData);
            footer_data.push(hybridData);
            localStorage.setItem("footer_data", JSON.stringify(footer_data));
            
            set_footer_data();
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}

function set_footer_data(){
    var footer_data = localStorage.getItem("footer_data");
    var itemData = (footer_data == null) ? [] : JSON.parse(footer_data);
    if(itemData.length > 0){
        var fuleData = itemData[0];
        var hybridData = itemData[1];
        var evData = itemData[2];

        if(fuleData && fuleData.length > 0)
        {
            var html_fule = "";
            fuleData.forEach(function (value) {     
                html_fule += `<li class="carlistsubtutitle"><a href="${ROOT_URL}cars/${value.encode_name}">${value.name}</a></li>`;
            });
            $("#footer_fule_list").html(html_fule);
        }
        else{
            $(".footer-fule-area").remove();
        }
        if(hybridData && hybridData.length > 0)
        {
            var html_hybrid = "";
            hybridData.forEach(function (value) {
                html_hybrid += `<li class="carlistsubtutitle"><a href="${ROOT_URL}cars/${value.encode_name}">${value.name}</a></li>`;
            });
            $("#footer_hybrid_list").html(html_hybrid);
        }
        else{
            $(".footer-hybrid-area").remove();
        }
        if(evData && evData.length > 0)
        {
            var html_ev = "";
            evData.forEach(function (value) {
                html_ev += `<li class="carlistsubtutitle"><a href="${ROOT_URL}cars/${value.encode_name}">${value.name}</a></li>`;
            });
            $("#footer_ev_list").html(html_ev);
        }
        else{
            $(".footer-ev-area").remove();
        }
    }
}

function get_car_suggestion(search, element){
    var req_data = {
        op: "manage_homepage",
        action: "get_car_suggestion",
        search: search
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var carData = data.data;
            element.fadeIn();
            var html_car = "";
            carData.forEach(function (value) {     
                html_car += `<li class="searchresult">${value.name}</li>`;
            });
            console.log(element);
            element.html(html_car);
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}

function show_real_image(ele){
    $(ele).each(function () {
        // var tmp_url = $(this).prop('src');
        // var main_url = tmp_url.replace('/images_thumb/','/images/');
        let main_img_ele = $(this)[0].outerHTML.replace('/images_thumb/','/images/').replace('tmp-img','main-img d-none');
        $(this).after(main_img_ele);
        
        $(this).next('.main-img').on('load', function(){
            $(this).removeClass('d-none');
            // $(this).prev('.tmp-img').addClass('d-none');
            $(this).prev('.tmp-img').remove();
        })
    });
}

function manage_single_slide(element){
    element.slick({
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