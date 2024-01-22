$(document).ready(function () {
    logout_user();
});

function logout_user(response) {

    if (response && response != null && response.success == true) {

        window.localStorage.clear();
        setTimeout(function () { window.location.href = "login"; }, 50);
        hideLoading();
        return false;
    }
    else if (response && response != null && response.success == false) {
        hideLoading();
        if (typeof response.redirect_to_login != 'undefined' && response.redirect_to_login.toString() == '1') {
            setTimeout(function () {
                window.location.href = "login";
            }, 50);
            return;
        }
        showError(response.message);
        return false;
    }
    else if (!response) {

        showLoading();
        if ($.isEmptyObject(LOGGED_IN_USER_ID)) {
            setTimeout(function () {
                window.location.href = "login";
            }, 50);
        }
        else {
            var data = {
                op: "logout_user"
                , original_user_id: LOGGED_IN_USER_ID
            };
            doAPICall(data, logout_user);
        }
    }
    return false;
}

