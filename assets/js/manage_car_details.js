var carData = [];
jQuery(function () {
    getcarData();
});
    
function getcarData(){
    var req_data = {
        op: "manage_homepage",
        action: "get_car_details",
        id: PRIMARY_ID,
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            carData = data.data;
            if(carData)
            {
                $(".brand_url").attr('href',ROOT_URL+'brand/'+carData.encode_brand_name);
                $(".brand_url").html(carData.brand_name);
                $(".vname").html(carData.name);
                $(".vprice").html('₹ '+carData.price);
                $(".vfuel").html(carData.fule_type_name);
                if(carData.engine)
                {
                    $(".vengin").html(carData.engine + ' cc');
                }
                else{
                    $(".vengin-div").remove();
                }
                $(".vmodel").html(carData.modal_year + ' Model');
                $(".vseater").html(carData.seater + ' Seater');
                $(".vtransmision").html(carData.transmision_name);
                $(".vtype").html(carData.car_type_name);
                $(".vdesc").html(carData.description);

                if(carData.mileage){
                    $(".vmileage").html(carData.mileage);
                    $(".vmileage-div").removeClass('d-none');
                }
                else {
                    $(".vmileage-div").remove();
                }
                if(carData.ground_clearance){
                    $(".vground-clearance").html(carData.ground_clearance);
                    $(".vground-clearance-div").removeClass('d-none');
                }
                else {
                    $(".vground-clearance-div").remove();
                }
                if(carData.warranty){
                    $(".vwarranty").html(carData.warranty);
                    $(".vwarranty-div").removeClass('d-none');
                }
                else {
                    $(".vwarranty-div").remove();
                }
                if(carData.length && carData.width && carData.height){
                    $(".vdimension").html(carData.length+' mm L X '+carData.width+' mm W X '+carData.height+' mm H');
                    $(".vdimension-div").removeClass('d-none');
                }
                else {
                    $(".vdimension-div").remove();
                }
                if(carData.fuel_tank){
                    $(".vfuel-tank").html(carData.fuel_tank + " Ltr");
                    $(".vfuel-tank-div").removeClass('d-none');
                }
                else {
                    $(".vfuel-tank-div").remove();
                }

                if(carData.driving_range){
                    $(".vdriveing-range").html(carData.driving_range);
                    $(".vdriveing-range-div").removeClass('d-none');
                }
                else {
                    $(".vdriveing-range-div").remove();
                }
                if(carData.ncap_rating){
                    $(".vncap-rating").html(carData.ncap_rating);
                    $(".vncap-rating-div").removeClass('d-none');
                }
                else {
                    $(".vncap-rating-div").remove();
                }
                if(carData.battery_warranty){
                    $(".vbattery-warranty").html(carData.battery_warranty);
                    $(".vbattery-warranty-div").removeClass('d-none');
                }
                else {
                    $(".vbattery-warranty-div").remove();
                }
                if(carData.battery_capacity){
                    $(".vbattery-capacity").html(carData.battery_capacity);
                    $(".vbattery-capacity-div").removeClass('d-none');
                }
                else {
                    $(".vbattery-capacity-div").remove();
                }

                manageColorDetails();
                manageVerientDetails();
            }
            return false;
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}

function manageColorDetails(){
    if(carData.color_data && carData.color_data.trim() != "" && carData.color_data.trim() != "[]"){
        var clrData = JSON.parse(carData.color_data);
        if(clrData && clrData.length > 0)
        {
            var html_clr = "";
            var clr_index = 0;
            clrData.forEach(function (colorData) {
                html_clr += `<li class="productcartab-link" data-index="${clr_index}">${colorData.color}</li>`;
                clr_index++;
            });
            $("#color_list").html(html_clr);
            $("#color_list li").on('click', function(){
                var ind = $(this).attr('data-index');
                manageColorClick(ind, false);
            });
            manageColorClick(0, true);
        }
    }
    else {
        var html_clr = `<img src="${WEB_API_FOLDER+carData.file}" alt="productimage">`;
        $("#color_img").html(html_clr);
        $('.productcarslide').slick({
            dots: true,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            // adaptiveHeight: true,
            arrows: true
        });
    }
}

function manageColorClick(ind, first_time = false){
    var clrData = JSON.parse(carData.color_data);
    var imgData = clrData[ind].img_url;
    if(imgData){
        var imageData = JSON.parse(imgData);
        if(imageData && imageData.length > 0)
        {
            var html_clr = "";
            imageData.forEach(function (colorImg) {
                html_clr += `<img src="${WEB_API_FOLDER+colorImg}" alt="productimage">`;
            });
            if(!first_time){
                $('.productcarslide').slick('unslick');
            }
            $("#color_img").html(html_clr);
            $('.productcarslide').slick({
                dots: true,
                infinite: true,
                speed: 300,
                slidesToShow: 1,
                // adaptiveHeight: true,
                arrows: true
            });
            
        }
    }
    $("#color_list li").removeClass('pdcarcurrent');
    $("#color_list li:nth-child("+(+ind + 1)+")").addClass('pdcarcurrent');
}

function manageVerientDetails(){
    if(carData.vdata && carData.vdata.trim() != "" && carData.vdata.trim() != "[]"){
        var verientData = JSON.parse(carData.vdata);
        if(verientData && verientData.length > 0)
        {
            var html_verient = "";
            var verient_index = 0;
            verientData.forEach(function (verientData) {
                if(carData.id != verientData.id){
                    html_verient += `<div class="newflexreviw">
                                        <div class="newflexed">
                                            <div class="">
                                                <h3 class="nxtweltitle"> ${verientData.name} 
                                                <span> ${verientData.fule_type_name} </span></h3>
                                            </div>
                                            <!--<div class="nexflex2">
                                                <ul class="variandown">
                                                    <li class="varainround variantroundactive" data-tab="round1">1</li>
                                                    <li class="varainround" data-tab="round2">2</li>
                                                    <li class="varainround" data-tab="round3">3</li>
                                                    <li class="varainround" data-tab="round4">4</li>
                                                </ul>
                                            </div>-->
                                        </div>


                                        <div class="compareflex">
                                            <div class="">
                                                <h5 class="carprice">Rs. ${verientData.price}</h5>
                                                <p class="showroomtitle">Estimated price</p>
                                            </div>
                                            <!--<div class="nexflex2">
                                                <p class="compareprice"><a href="#">+ COMPARE </a></p>
                                            </div>-->
                                        </div>
                                        <div class="details">
                                            <p class="detailbutton"><a href="${ROOT_URL}cars/${verientData.encode_name}">See Details</a></p>
                                        </div>
                                    </div>`;
                    verient_index++;
                }
            });
            $("#verient_list").html(html_verient);
            if(verient_index == 0){
                $(".varient-section").remove();
            }
        }
    }
}