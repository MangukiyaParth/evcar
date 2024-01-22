jQuery(function () {
    get_data();
    manage_payment_div();
});

async function manage_payment_div() {
    $("#pay_type").on("change", function () {
        if ($(this).prop('checked')) {
            $(".pay_type_1").addClass("d-none");
            $(".pay_type_2").removeClass("d-none");
        }
        else {
            $(".pay_type_1").removeClass("d-none");
            $(".pay_type_2").addClass("d-none");
        }
    });
}

async function get_data(data) {
    if (data && data != null && data.success == true) {
        var { company_name, company_email, admin_email, admin_email_password, contact1, contact2, address, show_gpay, pay_type, payment_script, upi, pixel, allowed_ip } = data.data;
        $('#cmp_name').val(company_name);
        $('#cmp_email').val(company_email);
        $('#admin_email').val(admin_email);
        $('#admin_email_password').val(admin_email_password);
        $('#contact1').val(contact1);
        $('#contact2').val(contact2);
        $('#address').val(address);
        $('#upi').val(upi);
        $('#payment_script').val(payment_script);
        $('#pixel').val(pixel);
        $('#allowed_ip').val(allowed_ip);
        if (show_gpay) {
            $("#show_gpay").prop("checked", true);
        }
        else {
            $("#show_gpay").prop("checked", false);
        }
        if (pay_type) {
            $("#pay_type").prop("checked", true);
        }
        else {
            $("#pay_type").prop("checked", false);
        }
        manage_payment_div();
        hideLoading();
        return false;
    }
    else if (data && data != null && data.success == false) {
        hideLoading();
        showError(data.message);
        return false;
    }
    else if (!data) {
        var req_data = {
            op: "get_settings"
        };
        doAPICall(req_data, get_data);
    }
    return false;
}

function sendotp(data){
    if (data && data != null && data.success == true) {
        $(".otp-div").show();
        $(".btn-send-otp").hide();
        showMessage(data.message);
        hideLoading();
        return false;
    }
    else if (data && data != null && data.success == false) {
        $(".otp-div").hide();
        $(".btn-send-otp").show();
        hideLoading();
        showError(data.message);
        return false;
    }
    else if (!data) {
        showLoading();
        var req_data = {
            op: "send_settings_otp"
        };
        doAPICall(req_data, sendotp);
    }
    return false;
}

$("#" + FORM_NAME).on('submit', function (e) {
    e.preventDefault();
    add_record();
});

async function add_record(data) {
    if (data && data != null && data.success == true) {
        $(".otp-div").hide();
        $(".btn-send-otp").show();
        showMessage(data.message);
        hideLoading();
        return false;
    }
    else if (data && data != null && data.success == false) {
        if(data.manage && data.manage == 2)
        {
            $(".otp-div").hide();
            $(".btn-send-otp").show();
        }
        hideLoading();
        showError(data.message);
        return false;
    }
    else if (!data) {
        if ($('#upi').val() == "") {
            showError("Please enter UPI ID");
            hideLoading();
            return false;
        }
        // else if ($("#pay_type").prop("checked") && $('#payment_script').val() == "") {
        //     showError("Please enter Payment Script");
        //     hideLoading();
        //     return false;
        // }

        showLoading();
        var req_data = {
            op: "update_settings"
            , cmp_name: $('#cmp_name').val()
            , cmp_email: $('#cmp_email').val()
            , admin_email: $('#admin_email').val()
            , admin_email_password: $('#admin_email_password').val()
            , contact1: $('#contact1').val()
            , contact2: $('#contact2').val()
            , address: $('#address').val()
            , show_gpay: $("#show_gpay").prop("checked")
            , pay_type: $("#pay_type").prop("checked")
            , payment_script: $('#payment_script').val()
            , upi: $('#upi').val()
            , pixel: $('#pixel').val()
            , password: $('#tb_password').val()
            , allowed_ip: $('#allowed_ip').val()
            , otp: $('#otp').val()
        };
        doAPICall(req_data, add_record);
    }
    return false;
}

function edit_record(id, source, container, name) {
    $('#id').val(id);
    $('#source').val(source).trigger('change');
    $('#container').val(container).trigger('change');
    $('#name').val(name);
    changeView('form');
}

function delete_record(id) {
    PRIMARY_ID = id;
    $("#delete_modal").modal('show');
}

async function delete_current_record(data) {

    if (data && data != null && data.success == true) {
        hideLoading();
        PRIMARY_ID = 0;
        showMessage(data.message);
        await table.clearPipeline().draw();
        return false;
    }
    else if (data && data != null && data.success == false) {
        hideLoading();
        PRIMARY_ID = 0;
        showError(data.message);
        return false;
    }
    else if (!data) {
        showLoading();
        var req_data = {
            op: "delete_record"
            , id: PRIMARY_ID
            , type: 'SHIPPING_LINE'
        };
        doAPICall(req_data, delete_current_record);
    }
    return false;
}
