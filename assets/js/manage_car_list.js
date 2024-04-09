var sorting = 0;
var brand_filter = [];
var fuel_filter = [];
var search_val = "";
jQuery(function () {
    get_brands();
    // history.replaceState({}, "title", ROOT_URL+"cars");

    $('[name="filter_car_type"]').on('click',function(){
        var fuel_type_id = $(this).val();
        $("#mob_"+fuel_type_id).prop('checked', true);
        addFule(fuel_type_id);
    });
    $('[name="mob_filter_car_type"]').on('click',function(){
        var fuel_type_id = $(this).val();
        $("#"+fuel_type_id).prop('checked', true);
        addFule(fuel_type_id);
    });
    
    $('body').on('click','[name="filter_brand"]',function(){
        var brand_id = $(this).val();
        $("#mob_"+brand_id).prop('checked', true);
        addBrand(brand_id);
    });
    $('body').on('click','[name="mob_filter_brand"]',function(){
        var brand_id = $(this).val();
        $("#"+brand_id).prop('checked', true);
        addBrand(brand_id);
    });

});

$(document).on('load', function(){

});

function defaultSelected(){
    if(list_type == 'FUEL'){
        if(PRIMARY_ID == fule_type_fuel_txt){
            fuel_filter.push(petrol_fule_id);
            addFule(diesel_fule_id);
            $("#mob_"+petrol_fule_id).prop('checked', true);
            $("#"+petrol_fule_id).prop('checked', true);
            $("#mob_"+diesel_fule_id).prop('checked', true);
            $("#"+diesel_fule_id).prop('checked', true);
        }
        else if(PRIMARY_ID == fule_type_hybrid_txt){
            addFule(hybrid_fule_id);
            $("#mob_"+hybrid_fule_id).prop('checked', true);
            $("#"+hybrid_fule_id).prop('checked', true);
        }
        else if(PRIMARY_ID == fule_type_ev_txt){
            addFule(ev_fule_id);
            $("#mob_"+ev_fule_id).prop('checked', true);
            $("#"+ev_fule_id).prop('checked', true);
        }
        $(".type_acc__title").click();
    }
    else if(list_type == 'BRAND'){
        addBrand(PRIMARY_ID);
        $("#mob_"+PRIMARY_ID).prop('checked', true);
        $("#"+PRIMARY_ID).prop('checked', true);
        $(".brand_acc__title").click();
    }
    else if(list_type == 'SEARCH'){
        search_val = PRIMARY_ID;
        getCarList();
    }
    else{
        getCarList();
    }
}

function addBrand(brandId){
    if(brand_filter.indexOf(brandId) === -1){ 
        brand_filter.push(brandId); 
    } else{ 
        brand_filter = jQuery.grep(brand_filter, function(value) {
        return value != brandId;
      }); 
    }
    getCarList();
}

function addFule(fuelId){
    if(fuel_filter.indexOf(fuelId) === -1){ 
        fuel_filter.push(fuelId); 
    } else{ 
        fuel_filter = jQuery.grep(fuel_filter, function(value) {
        return value != fuelId;
      }); 
    }
    getCarList();
}

function change_sorting(type){
    sorting = type;
    getCarList();
}
    
function get_brands(){
    var req_data = {
        op: "manage_homepage",
        action: "get_brand_list"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var brandData = data.brand;
            if(brandData && brandData.length > 0)
            {
                var html_brand = "";
                var mob_html_brand = "";
                brandData.forEach(function (value) {
                    var chkd = "";
                    if(list_type == 'BRAND' && value.id == PRIMARY_ID){
                        chkd = 'checked';
                    } 
                    html_brand += `<p class="customcheck">
                                        <input type="checkbox" id="${value.encode_name}" class="${value.encode_name} brand" ${chkd} name="filter_brand" value="${value.encode_name}">
                                        <label for="${value.encode_name}">${value.brand}</label><br>
                                    </p>`;
                    mob_html_brand += `<p class="customcheck">
                                        <input type="checkbox" id="mob_${value.encode_name}" class="${value.encode_name} brand" ${chkd} name="mob_filter_brand" value="${value.encode_name}">
                                        <label for="mob_${value.encode_name}">${value.brand}</label><br>
                                    </p>`;
                });
                $("#brand_list").html(html_brand);
                $("#mob_brand_list").html(mob_html_brand);
            }
            defaultSelected();
            return false;
        }
        else if (data && data != null && data.success == false) {
            $(".disflexcars").css('justify-content','center');
            $("#car_list").html(`<h1 class="text-center">${data.message}</h1>`);
            defaultSelected();
            return false;
        }
    });
}

function getCarList(){
    var req_data = {
        op: "manage_homepage",
        action: "get_car_list",
        sorting: sorting,
        brand_filter: brand_filter.join(','),
        fuel_filter: fuel_filter.join(','),
        search: search_val
    };
    doAPICall(req_data, async function(data){
        search_val="";
        $(".page-heading").html(data.heading);
        if (data && data != null && data.success == true) {
            var carData = data.data;
            if(carData && carData.length > 0)
            {
                var html_car = "";
                carData.forEach(function (value) {
                    html_car += `<div class="carfilteritem ">`;
                                    if(value.comming_soon == 1)
                                    {
                                        html_car += `<div class="commingsoon">
                                            <span>Comming Soon</span>
                                        </div>`;
                                    }
                                    html_car += `<div class="carimagrang">
                                        <img src="${WEB_API_FOLDER+value.file.replace('/images/','/images_thumb/')}" alt="${value.name}" class="tmp-img">
                                    </div>
                                    <div class="pricesettle">
                                        <div class="pricebox1 w-100">
                                            <div class="hearcar">
                                                <h4 class="boxtitle">${value.name}</h4>
                                            </div>
                                            <h5 class="carprice">Rs. ${value.price}</h5>
                                            <p class="showroomtitle">Avg. Ex-Showroom price</p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <p class="showroomtitle">Brand - ${value.brand_name} </p>
                                                <p class="compareprice"><a href="${ROOT_URL}cars/${value.encode_name}">Details</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                });
                $("#car_list").html(html_car);
                show_real_image("#car_list .tmp-img");
            }
            else {
                $("#car_list").html(data.message);
            }
            return false;
        }
        else if (data && data != null && data.success == false) {
            $(".disflexcars").css('justify-content','center');
            $("#car_list").html(`<h1 class="text-center">${data.message}</h1>`);
            return false;
        }
    });
}