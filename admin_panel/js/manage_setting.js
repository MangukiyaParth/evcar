jQuery(function () {
    $("[data-password]").on('click', function () {
        if ($(this).attr('data-password') == "false") {
            $(this).siblings("input").attr("type", "text");
            $(this).attr('data-password', 'true');
            $(this).addClass("show-password");
        } else {
            $(this).siblings("input").attr("type", "password");
            $(this).attr('data-password', 'false');
            $(this).removeClass("show-password");
        }
    });
});

if($('#'+FORMNAME).length){		
    $('#'+FORMNAME).validate({
        rules:{
            tb_password:{
                required: true,			
            },
            tb_cn_password:{
                required: true,	
                equalTo: "#tb_password"		
            },
        },messages:{
            tb_password:{
                required:"Password is required",
            },
            tb_cn_password:{
                required:"password is required",
                equalTo: "Confirm password must equal to Password"		
            },
        },
        submitHandler: function(form){
            showLoading();
            var req_data = {
                op: CURRENT_PAGE
                , action: "update_data"
                , password: $('#tb_password').val()
            };
            doAPICall(req_data, async function(data){
                if (data && data != null && data.success == true) {
                    showMessage(data.message);
                    resetValidation(FORMNAME);
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
