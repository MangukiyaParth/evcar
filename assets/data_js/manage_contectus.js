var currentPageNumber = 1; // initialization before all functions
var dataAvailable = true;
jQuery(function () {
    get_contectus();
});


function get_contectus(){
    var req_data = {
        op: "manage_contect_user",
        action: "get_data"
    };
    doAPICall(req_data, async function(data){
        if (data && data != null && data.success == true) {
            var aboutdata = data.data[0];
            // console.log(aboutdata.email);
            $('#address').html(aboutdata.address);
            $('#emailid').html(aboutdata.email);
            $('#phoneno').html(aboutdata.contactno);
            $('#workinghours').html(aboutdata.workinghour);
        }
        else if (data && data != null && data.success == false) {
            return false;
        }
    });
}

if($('#manage_contectus_form').length)
{		
    $('#manage_contectus_form').validate({
        
        rules:{
            name:{
                required: true,
            },
            phone:{
                required: true,
            },		
            email:{
                required: true,
            },		
        },
        messages:{
            name:{
                required: "Name is Required",
            },
            phone:{
                required: "Phone is required",
            },
            email:{
                required: "Email is required",
            },
        },
        submitHandler: function(form){
            var req_data = {
                op: 'manage_contect_user'
                ,action :'add_data'
                , name: $('#name').val()
                , phone: $('#phone').val()
                , email: $('#email').val()
                , subject: $('#subject').val()
                , message: $('#message').val()
            };
            doAPICall(req_data, success_contectus);
            async function success_contectus(data) {
                if (data && data != null && data.success == true) {
                    $("#manage_contectus_form")[0].reset();
                    changeView('details');
                    showMessage(data.message);
                    await table.clearPipeline().draw();
                }
                else if (data && data != null && data.success == false) {
                    showError(data.message);
                    return false;
                }
            }
        }
    });
}
