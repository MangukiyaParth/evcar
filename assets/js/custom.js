jQuery(function () {
    // get_Settings_data();
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