var currentPageNumber = 1; // initialization before all functions
var dataAvailable = true;

$(document).ready(function () {
    getaboutus();
});


function getaboutus(){
    var req_data = {
        op: "manage_aboutus_user",
        action: "get_data"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var aboutdata = data.data[0];
            // console.log(aboutdata.maindescr);
            $('#maindescr').html(aboutdata.maindescr);
            $('#vission').html(aboutdata.vission);
            $('#mission').html(aboutdata.mission);
            $('#goal').html(aboutdata.goal);
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}

