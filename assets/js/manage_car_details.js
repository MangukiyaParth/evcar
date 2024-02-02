jQuery(function () {
    getHomepageData();
});
    
function getHomepageData(){
    var req_data = {
        op: "manage_homepage",
        action: "get_car_list",
        list_type: list_type,
        id: PRIMARY_ID,
    };
    doAPICall(req_data, async function(data){
        $(".page-heading").html(data.heading);
        if (data && data != null && data.success == true) {
            var carData = data.data;
            if(carData && carData.length > 0)
            {
                var html_car = "";
                carData.forEach(function (value) {
                    html_car += `<div class="item">
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
                                            <p class="compareprice"><a href="${ROOT_URL}cars/${value.id}"> View Details </a></p>
                                        </div>
                                    </div>
                                </div>`;       
                });
                $("#car_list").html(html_car);
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