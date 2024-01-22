var currentPageNumber = 1; // initialization before all functions
var dataAvailable = true;

$(document).ready(function () {
    getprivacypolicy();
});

function getprivacypolicy(){
    var req_data = {
        op: "manage_privacypolicy_user",
        action: "get_data"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var policy = data.data[0];
            // console.log(policy.description);
            $('#privacepolicy').html(policy.description);
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}

