var table;
var carList = [];
jQuery(function () {
    fill_cars();
    $("#list_type").on('change', function(){
        manageCarSelectionList();
    });
});

function resetform(){
    $('#formevent').val('submit');
}

function fill_cars(){
    showLoading();
    var req_data = {
        op: CURRENT_PAGE
        , action: "get_cars"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            var carData = data.data;

            if (carData && carData.length > 0) {
                var car_html = "";
                carData.forEach(car => {
                    car_html += `<option value="${car.id}" data-fule-type="${car.fule_type}" data-comming-soon="${car.comming_soon}">${car.name}</option>`;
                });
                $("#cars").html(car_html);
                manageCarSelectionList();
            }
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            showError(data.message);
            return false;
        }
    });
}

function manageCarSelectionList(){
    let list_type = $("#list_type :selected").val();
    $("#cars option").attr("disabled","");
    switch (list_type) {
        case '1':
            $("#cars option[data-fule-type='"+ev_fule_id+"']").removeAttr("disabled");
            break;
        case '2':
            $("#cars option[data-fule-type='"+hybrid_fule_id+"']").removeAttr("disabled");
            break;
        case '3':
            $("#cars option[data-fule-type='"+petrol_fule_id+"']").removeAttr("disabled");
            $("#cars option[data-fule-type='"+diesel_fule_id+"']").removeAttr("disabled");
            break;
        case '4':
            $("#cars option").removeAttr("disabled");
            break;
        case '5':
            $("#cars option[data-comming-soon='1']").removeAttr("disabled");
            break;
    
        default:
            break;
    }
    $("#cars").val("");
    $("#cars").trigger('change');

    load_saved_cars();
}

function load_saved_cars(){
    showLoading();
    var req_data = {
        op: CURRENT_PAGE
        , action: "get_data"
        , list_type: $("#list_type :selected").val()
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success) {
            hideLoading();
            var carListInfo = data.data;
            carList = [];
            carListInfo.forEach(car => {
                carList.push({
                    id: car.car_id,
                    name: car.car_name
                });
            });
            manageList();
            return false;
        }
        else if (data && data != null && !data.success) {
            hideLoading();
            carList = [];
            // showError(data.message);
            $("#car-list").html("");
            return false;
        }
    });
}

function addCar(){
    let car_id = $("#cars :selected").val();
    let car_name = $("#cars :selected").text();
    
    if(car_id){
        if(carList.findIndex((o)=>{ return o.id  === car_id }) === -1){
            carList.push({
                id: car_id,
                name: car_name
            });
            manageList();
        }
        else{
            showError("Car already exist in list");
        }
    }
    else{
        showError("Please select car");
    }
}

function manageList(){
    let car_html = "";
    var i = 0;
    carList.forEach(car => {
        var delete_btn = "";
        if(deleteright == 1){
            delete_btn = `<i class="uil-trash-alt text-danger" onclick="removeCar('${i}')" style="font-size: large; cursor: pointer;"></i>`;
        }
        car_html +=`<tr class="car-${i}">
                        <td>${car.name}</td>
                        <td>${delete_btn}</td>
                    </tr>`;
                    i++;
    });
    $("#car-list").html(car_html);
}

function removeCar(index){
    $(`#car-list .car-${index}`).remove();
    carList.splice(index, 1);
}

if($('#'+FORMNAME).length){		
    $('#'+FORMNAME).validate({
        rules:{
            list_type:{
                required: true,			
            },
        },messages:{
            list_type:{
                required:"List type is required",
            },
        },
        submitHandler: function(form){
            showLoading();
            var req_data = {
                op: CURRENT_PAGE
                , action: "add_data"
                , list_type: $("#list_type :selected").val()
                , car_list: JSON.stringify(carList)
            };
            doAPICall(req_data, async function(data){
                if (data && data != null && data.success == true) {
                    showMessage(data.message);
                    hideLoading();
                    return false;
                }
                else if (data && data != null && data.success == false) {
                    hideLoading();
                    showError(data.message);
                    return false;
                }
            });
        },
    });
}