var pageLoadFlag = true;
var current_user = null;
var timezone = jstz.determine();
$(".overlay-modal").removeClass('hide').hide();
var complete_execution = 1;
if (typeof MODULE_NAME === 'undefined' || MODULE_NAME === null) {
    var MODULE_NAME = '';
}
var FIRST_PAGE_LOAD = 1;
var CLOSE_CONSTANT = 'Close';
var CANCEL_CONSTANT = 'Cancel';
var saveMessage = 'Saved';
var updateMessage = 'Updated';
var CURRENT_DATA = [];
var editor = [];
var myDropzone = [];
var load_pages = [];
var dataNotDeleteFileOnRemove = false;
if(CURRENT_PAGE != 'logout' && CURRENT_PAGE != 'login')
{
    openPage();
}

Dropzone.autoDiscover = false;
/* document.onpaste = function(event){
    const items = (event.clipboardData || event.originalEvent.clipboardData).items;
    items.forEach((item) => {
        if (item.kind === 'file') {
        // adds the file to your dropzone instance
        myDropzone.addFile(item.getAsFile())
        }
    })
} */
function remove_file(url, ismupltiple = false) {
    showLoading();
    if(!ismupltiple){
        url = [url]
    }
    var data = {
        "op": "remove_file"
        , "url": url
        , "ismupltiple": ismupltiple
    };
    doAPICall(data, function (response) { 
        if (response && response.success) {
            hideLoading();
        }
        else if (response && !response.success) {
            hideLoading();
        }
     });
    return true;
}

// NProgress
(function ($) {

    'use strict';

    if (typeof NProgress !== 'undefined' && $.isFunction(NProgress.configure)) {

        NProgress.configure({
            showSpinner: true,
            ease: 'ease',
            speed: 750
        });

    }

}).apply(this, [jQuery]);

function apply_after_page_load(){

    $('[data-plugin="dropzone"]').each(function () {
        setFileDropzone($(this));
    });

    // Datetime and date range picker
    var defaultOptions = {
        cancelClass: "btn-light",
        applyButtonClasses: "btn-success",
        autoApply: true,
        showDropdowns: true,
        singleDatePicker: true,
        locale: {
            format: 'DD/MM/YYYY'
        }
    };

    $('[data-toggle="date-picker"]').each(function (idx, obj) {
        var objOptions = $.extend({}, defaultOptions, $(obj).data());
        $(obj).daterangepicker(objOptions);
    });
    
    $('[data-provide="date-picker"]').each(function (index, obj) {
        var format = "dd/mm/yyyy";
        var defaultView = "date";
        if($(this).attr('data-date-min-view-mode') == 2){
            //Year Picker
            format = "yyyy";
            defaultView = "year";
        }
        else if($(this).attr('data-date-min-view-mode') == 1){
            //Month Picker
            format = "mm/yyyy";
            defaultView = "month";
        }

        $(obj).datepicker({
            defaultViewDate: defaultView,
            format: format,
            autoclose: true
        });
    });
    

    $('.numbersOnlyField').on('paste', function (event) {
        if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
            event.preventDefault();
        }
    });

    $(".numbersOnlyField").on('keydown', function (e) {
        if (!(e.keyCode >= 48 && e.keyCode <= 57) && !(e.keyCode >= 96 && e.keyCode <= 105) && !(e.ctrlKey && e.keyCode == 86) && e.keyCode != 18 && e.keyCode != 8 && e.keyCode != 9 && e.keyCode != 13 && e.keyCode != 16 && e.keyCode != 36) {
            return false;
        }
    });

    $('.desimalnumberField').on('paste', function (event) {
        if (event.originalEvent.clipboardData.getData('Text').match(/[.]/)) {

        }
        else if (event.originalEvent.clipboardData.getData('Text').match(/[^\d]/)) {
            event.preventDefault();
        }
    });
    
    $(".desimalnumberField").keydown(function (e) {
        if (!(e.keyCode >= 48 && e.keyCode <= 57) && !(e.keyCode >= 96 && e.keyCode <= 105) && !(e.ctrlKey && e.keyCode == 86) && e.keyCode != 18 && e.keyCode != 8 && e.keyCode != 9 && e.keyCode != 13 && e.keyCode != 16 && e.keyCode != 36 && e.keyCode != 110) {
            return false;
        }
    });

    $('.select2').each(function (index, obj) {
        var searchCnt = ($(this).attr('data-live-search')) ? $(this).attr('data-live-search') : -1;
        $(obj).select2({
            placeholder: 'Select an option',
            minimumResultsForSearch: searchCnt
        });
    });

    //Prevent Submit Form on press Enter
    $('form').on('keyup keypress', function (e) {
        ///Get Target
        if (e.target.nodeName != 'TEXTAREA' && 
        e.target.id != 'q' && e.target.id != 'tb_email' && e.target.id != 'tb_password' && 
        $(e.target).attr('class') != "note-editable" && 
        !$(e.target).attr('class')?.includes("ck-editor__editable") &&
        !$(e.target).parents('ul')?.attr('class')?.includes('tag-editor'))//For Allow Enter in TextArea, Allow when global search enter
        {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13 && !$(e.target).hasClass('select2-search__field')) {
                e.preventDefault();
                return false;
            }
        }
    });
}

function setFileDropzone(element){
    var previewContainer = element.data("previewsContainer");
    var t = element.attr("action"),
    multipe = element.attr("is-multipe"),
    multiple = (multipe == 'true') ? true : false,
    previewsContainer = (previewContainer != "") ? "#"+previewContainer : "",
    acceptedFiles = element.attr("acceptedFiles"),
    page = element.attr("data-page"),
    hideen_id = element.find('.file_name'),
    pname = "file";
    var previewEle = element.data("uploadPreviewTemplate");
    var previewHTML = $(previewEle).html();
    // console.log((multiple) ? null : 1);
    element.dropzone({ 
        init() {
            var dropzoneIndex = myDropzone.length;
            myDropzone[dropzoneIndex] = this;
            // this.on("maxfilesexceeded", function(file){
            //     alert("No more files please!");
            // });
        },
        url: API_SERVICE_URL ,
        paramName: pname,
        maxFilesize: 100, //MB
        parallelUploads: 2,
        createImageThumbnails: true,
        acceptedFiles: acceptedFiles,
        uploadMultiple: true,
        previewTemplate: previewHTML,
        previewsContainer: previewsContainer,
        maxFiles: (multiple) ? null : 1,
        dictMaxFilesExceeded: "You can not upload any more then {{maxFiles}} files.",
        paramName: pname,
        params(files, xhr, chunk) {
            var uuid = files.map(function (el) { return el.upload.uuid; });
            return {
                page: page,
                uuid: JSON.stringify(uuid),
                user_id: CURRENT_USER_ID,
                from: "panel",
                op: "upload_file",
            }
        },
        successmultiple(files,response){
            var res_files = JSON.parse(response.files);
            var curr_file = hideen_id.val();
            curr_file = (curr_file == "" || curr_file == undefined) ? [] : JSON.parse(curr_file);
            var new_files = $.merge(curr_file, res_files);
            hideen_id.val(JSON.stringify(new_files));
        },
        error(file, message) {
            showError(message);
            if (file.previewElement) {
                if (file.previewElement != null && file.previewElement.parentNode != null) {
                    file.previewElement.parentNode.removeChild(file.previewElement);
                }
                file.previewElement.classList.add("dz-error");
                if (typeof message !== "string" && message.error) {
                    message = message.error;
                }
                for (let node of file.previewElement.querySelectorAll(
                    "[data-dz-errormessage]"
                )) {
                    node.textContent = message;
                }
            }
        },
        // errormultiple(files){
        //     console.log(files);
        //     var file = files[0];
        //     if (file.previewElement != null && file.previewElement.parentNode != null) {
        //         file.previewElement.parentNode.removeChild(file.previewElement);
        //     }
        // },
        removedfile(file) {
            var uuid = file.uuid;
            if(file.upload && file.upload != ""){
                uuid = file.upload.uuid;
            }
            var curr_file = hideen_id.val();
            curr_file = (curr_file == "" || curr_file == undefined) ? [] : JSON.parse(curr_file);
            var foundindex = curr_file.findIndex((obj => obj.uuid == uuid));
            if(foundindex >= 0)
            {
                if (file.previewElement != null && file.previewElement.parentNode != null) {
                    file.previewElement.parentNode.removeChild(file.previewElement);
                }
                var remove_url = curr_file[foundindex].url;
                if(!dataNotDeleteFileOnRemove){
                    remove_file(remove_url);
                }
                curr_file = curr_file.filter(function( obj ) {
                    return obj.uuid != uuid;
                });
                hideen_id.val(JSON.stringify(curr_file));
            }
            return this._updateMaxFilesReachedClass();
        },
        maxfilesexceeded(file){
            alert("No more files please!");
            this.removeFile(file);
        },
        success (file, responseText) {
        },
        // For Mor Options https://github.com/dropzone/dropzone/blob/main/src/options.js
    });
}

$(document).ready(function () {
    window.addEventListener('scroll', () => {
        document.documentElement.style.setProperty('--scroll-y', `${window.scrollY}px`);
    });
    // handle common show event of all dialog
    $('.modal').on('shown.bs.modal', function (s) {
        const scrollY = document.documentElement.style.getPropertyValue('--scroll-y'); const body = document.body; body.style.position = 'fixed'; body.style.top = `-${scrollY}`;// Hide scroll when modal open
        var zIndex = 1040 + (10 * $('.modal:visible').length);
        $(this).css('z-index', zIndex);
        setTimeout(function () {
            $('.modal-backdrop').not('.modal-stack').css('z-index', zIndex - 1).addClass('modal-stack');
        }, 0);
    });
    // handle common close event of all dialog
    $('.modal').on('hide.bs.modal', function (s) {
        const body = document.body; const scrollY = body.style.top; body.style.position = ''; body.style.top = ''; window.scrollTo(0, parseInt(scrollY || '0') * -1); // Manage scroll when modal hide
    });

    //Prevent Submit Form on press Enter
    $('form').on('keyup keypress', function (e) {
        ///Get Target
        if (e.target.nodeName != 'TEXTAREA' && e.target.id != 'tags'  && e.target.id != 'q' && e.target.id != 'tb_email' && e.target.id != 'tb_password' && $(e.target).attr('class') != "note-editable" && !$(e.target).attr('class').includes("ck-editor__editable"))//For Allow Enter in TextArea, Allow when global search enter
        {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13 && !$(e.target).hasClass('select2-search__field')) {
                e.preventDefault();
                return false;
            }
        }
    });

});

function url_title(title){
    // return encodeURIComponent(title.replace(/ /g,'-'));
    if(title){
        return title.replace(/[^a-z0-9\s]/gi, '').replace(/ /g,'-').replace(/[_\s]/g, '-').toLowerCase();
    }
    else{
        return title;
    }
}

function showLoading() {
    NProgress.start();
}

function hideLoading() {
    NProgress.done();
}

function changeView(view, isEditMode = false) {
    if (view == 'form') {
        $("#addBtn, #detailsDiv").hide();
        $("#backBtn, #formDiv").show();
        if (editor.length != 0 && isEditMode == false) {
            $("#verientList").html("");
        }
        if(isEditMode){
            $('#formevent').val('update');
            setDatepickerValue();
        }
        else{
            if (FORMNAME != "") {
                resetValidation(FORMNAME);
                $('#formevent').val('submit');
                if(typeof resetform != 'undefined')
                {
                    resetform();
                }
            }
        }
    }
    else {
        $('#formevent').val('submit');
        for (let i = 0; i < myDropzone.length; ++i) {
            myDropzone[i].removeAllFiles(true); 
        }
        $("#addBtn, #detailsDiv").show();
        $("#backBtn, #formDiv").hide();
        CURRENT_DATA = [];
    }
}

function setDatepickerValue(){
    $('[data-toggle="date-picker"]').each(function (idx, obj) {
        var dateVal = $(this).val();
        $(this).data('daterangepicker').startDate = moment(dateVal, "DD/MM/YYYY");
        $(this).data('daterangepicker').endDate = moment(dateVal, "DD/MM/YYYY");
    });
}

function showMessage(msg, title) {
    PNotify.removeAll();
    var title = (typeof (title) == 'undefined') ? "Success" : title;
    new PNotify({
        title: title,
        text: msg,
        maxOpen: 1,
        animate_speed: 'fast',
        type: 'success'
    });
}

function showAlert(msg, title) {
    PNotify.removeAll();
    var title = (typeof (title) == 'undefined') ? "Alert" : title;
    new PNotify({
        title: title,
        text: msg,
        type: 'info',
        maxOpen: 1,
        animate_speed: 'fast',
        buttons: {
            closer: true,
            sticker: false, //ugly
            labels: { close: "Fechar", stick: "Manter" }
        }
    });
    //$.notify(msg, 'info');
}

function showError(msg, title) {
    PNotify.removeAll();
    var title = (typeof (title) == 'undefined') ? "Alert" : title;
    new PNotify({
        title: title,
        text: msg,
        type: 'error',
        maxOpen: 1,
        animate_speed: 'fast',
        buttons: {
            closer: true,
            sticker: false, //ugly
            labels: { close: "Fechar", stick: "Manter" }
        }
    });
    //$.notify(msg, 'danger');
    hideLoading();
}

jQuery["postJSON"] = function (url, data, callback) {
    // shift arguments if data argument was omitted
    if (jQuery.isFunction(data)) {
        callback = data;
        data = undefined;
    }

    return jQuery.ajax({
        url: url,
        type: "POST",
        contentType: "application/json; charset=utf-8",
        dataType: "json",
        data: data,
        success: callback
    });
};

function doAPICall(obj, callback, is_async) {

    showLoading();

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
    data["from"] = "panel";
    data["tz"] = getTzOffset();
    data["tzid"] = timezone.name();
    // data["curr_time"] = $.format.date(new Date(), 'yyyy-MM-dd HH:mm:ss');
    data["curr_time"] = moment().format('D-MM-YYYY');
    if (CURRENT_USER_ID != "") data["user_id"] = CURRENT_USER_ID;
    if (CURRENT_USERROLE_ID != "") data["userrole_id"] = CURRENT_USERROLE_ID;

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
            window.location = notify_panel_url+"logout";
        }
        if (response.error) {
            showError(JSON.stringify(response.error), "ERROR");
        }
        else {
            callback(response);
        }
    }).fail(function (err) {
        $("#btn_save,button.edit.btn-success").button('reset');
        hideLoading();
        //console.log(err);
        if (err.readyState != 0) {
            showError("System failure: ") + JSON.stringify(err);
            $("body").html(err.responseText);
        }
    });
}

function fmt(format_string, params) {
    var _format = format_string || "";
    var _ret = _format + "";
    var r = null;
    try {
        for (var i in params) {
            r = new RegExp("\\{" + i + "\\}", "g");
            _ret = _ret.replace(r, params[i] == null ? "" : params[i].toString());
        }
    } catch (e) { }
    return _ret;
}


/*
 POSTED TIME AGO PRINT FUNCTION
 TIMEZONE WISE DATE CALCULATION USING OFFSET

 db_date = MYSQL DATETIME FORMAT [YYYY-MM-DD HH:II:SS]
 */

function posted_ago(db_date, tz_offset) {
    //console.log("DB DATE : "+db_date + " OFFSET: "+tz_offset);
    var dateString = db_date.match(/^(\d{4})-(\d{2})-(\d{2}) (\d{2}):(\d{2}):(\d{2})$/);
    var db_date = new Date(dateString[1], dateString[2] - 1, dateString[3], dateString[4], dateString[5], dateString[6]);
    //var db_date  = new Date(""+db_date);
    var client_tz_ms = db_date.getTime() + (-1 * tz_offset * 60 * 1000);
    var client_date = new Date(client_tz_ms);

    if (client_date) {
        var seconds = Math.floor(((new Date()).getTime() - client_date.getTime()) / 1000);
        var minutes = Math.floor(seconds / 60);
        var hours = Math.floor(minutes / 60);
        var days = Math.floor(hours / 24);
        var time_display_text = seconds + " seconds ago.";
        if (minutes > 0) {
            if (hours > 0) {
                if (days > 0) {
                    time_display_text = days + " day ago.";
                }
                else {
                    time_display_text = hours + " hour ago.";
                }
            }
            else {
                time_display_text = minutes + " minute ago.";
            }
        }

        return time_display_text;
    }

    return false;
}

function createCookie(name, value, days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        var expires = "; expires=" + date.toGMTString();
    }
    else
        var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return decodeURIComponent(c.substring(nameEQ.length, c.length));
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name, "", -1);
}

function addToLocalStorage(name, value) {
    window.localStorage.setItem(name, value);
}

function readLocalStorage(name) {
    return window.localStorage.getItem(name);
}

function removeLocalStorage(name) {
    return window.localStorage.removeItem(name);
}

function logEvents(logString) {
    if (clevertap) {
        clevertap.event.push(logString);
    }
    if (mixpanel) {
        mixpanel.track(logString);
    }
}

function sumObjectValues(items, prop) {
    if (items == null) {
        return 0;
    }
    return items.reduce(function (a, b) {
        return b[prop] == null || b[prop] == "" || isNaN(parseFloat(b[prop])) ? parseFloat(a) : parseFloat(a) + parseFloat(b[prop]);
    }, 0);
}

function getTzOffset() {
    var offset = new Date().getTimezoneOffset();
    var minutes = Math.abs(offset);
    var hours = Math.floor(minutes / 60);
    var prefix = offset < 0 ? "+" : "-";
    return prefix + hours + ":" + (minutes % 60);
}

function getCurrentDate() {
    return moment(new Date()).format(COMPANY_DATE_FORMAT.toUpperCase());
}

function getCurrentTime() {
    return $.format.date(new Date(), "hh:mm a");
}

function getCustomCurrentTimeDate() {
    return moment(new Date()).format("DD/MM/YYYY") + " " + moment(new Date()).format("HH:mm:ss");
}

function resetValidation(formID) {
    $("#" + formID + " #id").val(0);
    $("#" + formID)[0].reset();
    $("#" + formID).removeClass('was-validated');
    $('.select2').val("").trigger('change');
    $('#image_preview').attr('src', "");
    $(".default-hide").addClass('hide');
    CURRENT_DATA = [];
}

$(".numbersOnlyField").keydown(function (e) {
    if (e.keyCode == 107 || e.keyCode == 109 || e.keyCode == 110 || e.keyCode == 187 || e.keyCode == 189 || e.keyCode == 61 || e.keyCode == 173 || e.keyCode == 220) {
        return false;
    }
});

$(".numberTypeField").keydown(function (e) {
    if (!(e.keyCode >= 48 && e.keyCode <= 57) && !(e.keyCode >= 96 && e.keyCode <= 105) && e.keyCode != 18 && e.keyCode != 8 && e.keyCode != 9 && e.keyCode != 13 && e.keyCode != 16 && e.keyCode != 36) {
        showAlert("Only numbers can be entered into the field.");
        $(this).val("");
        return false;
    }
});

function MyCustomUploadAdapterPlugin(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
        // Configure the URL to the upload script in your back-end here!
        return new MyUploadAdapter(loader);
    };
}

async function HTMLEditor(id, index = '') {

    editor[index] = ClassicEditor.create(document.getElementById(id), {
        // updateSourceElementOnDestroy: true,
        Plugins: ['ckEditorEnterBreaks'],
        extraPlugins: [MyCustomUploadAdapterPlugin],
        // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
        toolbar: {
            items: [
                'findAndReplace', 'selectAll', '|',
                'heading', '|',
                'bold', 'italic', 'strikethrough', 'underline', 'subscript', 'superscript', 'removeFormat', '|',
                'bulletedList', 'numberedList', 'todoList', '|',
                'outdent', 'indent', '|',
                'undo', 'redo',
                '-',
                'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                'alignment', '|',
                'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                'specialCharacters', 'horizontalLine', '|',
                'sourceEditing'
            ],
            shouldNotGroupWhenFull: true
        },
        // Changing the language of the interface requires loading the language file using the <script> tag.
        // language: 'es',
        list: {
            properties: {
                styles: true,
                startIndex: true,
                reversed: true
            }
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
        heading: {
            options: [
                { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
            ]
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
        placeholder: 'Description',
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
        fontFamily: {
            options: [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif'
            ],
            supportAllValues: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
        fontSize: {
            options: [10, 12, 14, 'default', 18, 20, 22],
            supportAllValues: true
        },
        // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
        // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
        htmlSupport: {
            allow: [
                {
                    name: /.*/,
                    attributes: true,
                    classes: true,
                    styles: true
                }
            ]
        },
        // Be careful with enabling previews
        // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
        htmlEmbed: {
            showPreviews: true
        },
        // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
        link: {
            decorators: {
                addTargetToExternalLinks: true,
                defaultProtocol: 'https://',
                toggleDownloadable: {
                    mode: 'manual',
                    label: 'Downloadable',
                    attributes: {
                        download: 'file'
                    }
                }
            }
        },
        removePlugins: [
            'CKBox',
            'CKFinder',
            'EasyImage',
            'Base64UploadAdapter',
            'RealTimeCollaborativeComments',
            'RealTimeCollaborativeTrackChanges',
            'RealTimeCollaborativeRevisionHistory',
            'PresenceList',
            'Comments',
            'TrackChanges',
            'TrackChangesData',
            'RevisionHistory',
            'Pagination',
            'WProofreader',
            // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
            // from a local file system (file://) - load this site via HTTP server if you enable MathType.
            'MathType',
            // The following features are part of the Productivity Pack and require additional license.
            'SlashCommand',
            'Template',
            'DocumentOutline',
            'FormatPainter',
            'TableOfContents'
        ]
    })
    .then(newEditor => {
        editor[index] = newEditor;
    });
}
function numonly(id)
{
    $('#'+id).val($('#'+id).val().replace(/[^0-9]/g, ''));
}
function to_number_format(x) {
    x=Number(x).toFixed(2).toString();
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
    return res;
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
        $("#delete_modal").modal('hide');
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
            , type: CURRENT_PAGE
        };
        doAPICall(req_data, delete_current_record);
    }
    return false;
}

async function delete_all() {
    $("#delete_all_modal").modal('show');
}
async function delete_all_record(data) {

    if (data && data != null && data.success == true) {
        hideLoading();
        showMessage(data.message);
        await table.clearPipeline().draw();
        return false;
    }
    else if (data && data != null && data.success == false) {
        hideLoading();
        showError(data.message);
        return false;
    }
    else if (!data) {
        showLoading();
        var req_data = {
            op: "delete_all_record"
            , type: CURRENT_PAGE
        };
        doAPICall(req_data, delete_all_record);
    }
    return false;
}