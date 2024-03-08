var table;
var SUBPRIMARYID = 0;
var colorData = [];
var verientData = [];
var videoData = [];
var predefine_dropzones = 5;
jQuery(function () {
    HTMLEditor("description", 0);
    get_data();
    $("#fule_type").on('change',()=>{
        let f_type = $("#fule_type :selected").val();
        if(f_type == ev_fule_id){
            $("#engine").val("");
            $("#engine").prop("readonly", true);
        }
        else {
            $("#engine").prop("readonly", false);
        }
    });
    $("#verient_fule_type").on('change',()=>{
        let f_type = $("#verient_fule_type :selected").val();
        if(f_type == ev_fule_id){
            $("#verient_engine").val("");
            $("#verient_engine").prop("readonly", true);
        }
        else {
            $("#verient_engine").prop("readonly", false);
        }
    });
    manageCommingSoon();
    $("#comming_soon").on('change', ()=>{
        manageCommingSoon();
    })
});

function manageCommingSoon(){
    var comming_soon = $("#comming_soon").prop('checked');
    if(comming_soon){
        $("#modal_year").val("");
        $("#modal_year").addClass("hide");
    }
    else{
        $("#modal_year").removeClass("hide");
    }
}

function resetform(){
    $('#formevent').val('submit');
    var dz_ind = 0;
    myDropzone.forEach(function() {
        myDropzone.splice(dz_ind+predefine_dropzones, 1);
        dz_ind++;
    });
    colorData = [];
    verientData = [];
    videoData = [];
    $("#color_list").html("");
    $("#verient_list").html("");
    fill_details();
}

function fill_details(){
    if($("#brand").html().trim() == "" || $("#car_type").html().trim() == "" || $("#fule_type").html().trim() == "" || $("#transmision").html().trim() == ""){
        showLoading();
        var req_data = {
            op: "get_details"
            , action: "get_data"
        };
        doAPICall(req_data, async function(data){
            if (data && data != null && data.success) {
                hideLoading();
                var brandData = data.brand;
                var carTypeData = data.car_type;
                var fulesData = data.fules;
                var transmisionData = data.transmision;

                if (brandData && brandData.length > 0) {
                    var brand_html = "";
                    brandData.forEach(brands => {
                        brand_html += `<option value="${brands.id}">${brands.brand}</option>`;
                    });
                    $("#brand").html(brand_html);
                    if(CURRENT_DATA.brand){
                        $("#brand").val(CURRENT_DATA.brand).trigger('change');    
                    }
                    else{
                        $("#brand").trigger('change');
                    }
                }
                if (carTypeData && carTypeData.length > 0) {
                    var car_type_html = "";
                    carTypeData.forEach(car_type => {
                        car_type_html += `<option value="${car_type.id}">${car_type.car_type}</option>`;
                    });
                    $("#car_type").html(car_type_html);
                    if(CURRENT_DATA.car_type){
                        $("#car_type").val(CURRENT_DATA.car_type).trigger('change');    
                    }
                    else{
                        $("#car_type").trigger('change');
                    }
                }
                if (fulesData && fulesData.length > 0) {
                    var fule_html = "";
                    fulesData.forEach(fules => {
                        fule_html += `<option value="${fules.id}">${fules.fule}</option>`;
                    });
                    $(".fule_type").html(fule_html);
                    if(CURRENT_DATA.fule_type){
                        $("#fule_type").val(CURRENT_DATA.fule_type);    
                    }
                    $(".fule_type").trigger('change');
                }
                if (transmisionData && transmisionData.length > 0) {
                    var transmision_html = "";
                    transmisionData.forEach(transmisions => {
                        transmision_html += `<option value="${transmisions.id}">${transmisions.trans_type}</option>`;
                    });
                    $(".transmision").html(transmision_html);
                    if(CURRENT_DATA.transmision){
                        $("#transmision").val(CURRENT_DATA.transmision);    
                    }
                    $(".transmision").trigger('change');
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
    else {
        if(CURRENT_DATA.length != 0){
            $("#brand").val(CURRENT_DATA.brand).trigger('change');    
            $("#car_type").val(CURRENT_DATA.car_type).trigger('change');    
            $("#fule_type").val(CURRENT_DATA.fule_type).trigger('change');    
            $("#transmision").val(CURRENT_DATA.transmision).trigger('change');    
        }
    }
}

function get_data() {
    table = $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        fixedHeader: true,
        pagingType: "full_numbers",
        responsive: !0,
        language: { paginate: { previous: "<i class='mdi mdi-chevron-left'>", next: "<i class='mdi mdi-chevron-right'>" } },
        drawCallback: function () { $(".dataTables_paginate > .pagination").addClass("pagination-rounded") },
        ajax: $.fn.dataTable.pipeline({
            url: API_SERVICE_URL,
            pages: 1, // number of pages to cache
            op: CURRENT_PAGE,
            action: "get_data"
        }),
        columns: [
            { data: 'id', name: 'id', width: "0%", className: "d-none" },
            { data: 'brand_name', name: 'brand_name', width: "10%" },
            { data: 'name', name: 'name', width: "20%" },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    var details ='';
                    if(row.file)
                    {
                        details = "<a href='" + WEB_API_FOLDER + row.file + "' target='_blank'><img style='height: 60px;' src='" + WEB_API_FOLDER + row.file + "'></a>";
                    }
                    return details;
                }, name: 'file', width: "10%"
            },
            { data: 'fule_type_name', name: 'fule_type_name', width: "10%" },
            { data: 'modal_year', name: 'modal_year', width: "10%" },
            { data: 'transmision_name', name: 'transmision_name', width: "10%" },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    return row.car_type_name+"("+row.seater+" Seater)";
                }, name: 'car_type_name', width: "10%"
            },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    return "&#x20B9; "+row.price;
                }, name: 'price', width: "10%"
            },
        ],
        "columnDefs": [{
            "targets": 9,
            "className": "text-end",
            "data": "id",
            "render": function (data, type, row, meta) {
                var rowid="'"+row.id+"'";
                var html='<button class="btn btn-info rounded-pill tbl-btn" onclick="view_car_details(' + meta.row + ')"><i class="uil-notes"></i></button>';
                if(editright == 1)
                {
                    html+='<button class="btn btn-primary rounded-pill tbl-btn" onclick="edit_car_details(' + meta.row + ')"><i class="ri-pencil-fill"></i></button>';
                }
                if(deleteright == 1)
                {
                    html+='<button class="btn btn-danger rounded-pill tbl-btn" onclick="delete_record(' + rowid + ')"><i class="uil-trash-alt"></i></button>';
                }
                return type === 'display' ? html: "";
            }, width: "10%"
        }]
    });
}

$("#add_color").on("click", function(){
    var color = $("#color").val();
    var img_data = $("#color_file_name").val();
    if(color && img_data){
        var cdata = {
            color: color,
            img_data: img_data,
            isnew: ($('#formevent').val() == 'update') ? true : false
        };
        colorData.push(cdata);
        myDropzone.splice(predefine_dropzones, myDropzone.length - predefine_dropzones);
        $("#color_list").html(getColorTbl(true));
        manageColorImgDropzone();
        dataNotDeleteFileOnRemove = true;
        myDropzone[predefine_dropzones-1].removeAllFiles(true); 
        dataNotDeleteFileOnRemove = false;
        $("#color").val('');
    }
    else {
        showError("Please fill all the details.");
    }
});

function getColorTbl(editable = false){
    var clr_html = "";
    if(colorData.length > 0){
        var i=0;
        colorData.forEach(clrdata => {
            var clrimgdata = JSON.parse(clrdata.img_data);
            var imgs_html = "";
            clrimgdata.forEach(clrimg => {
                imgs_html += `<a href='${WEB_API_FOLDER + clrimg.url}' target='_blank'><img style='height: 60px;' src='${WEB_API_FOLDER + clrimg.url}'></a>`;
            });
            clr_html += `<tr class="color${i}">
                <td>${clrdata.color}</td>`;
                if(editable){
                    clr_html+=`<td>
                                    <div class="dropzone d-none" id="color_file_${i}" data-plugin="dropzone" data-previews-container="file-previews-${i}" data-upload-preview-template="#uploadPreviewTemplate" data-page="cars" acceptedFiles="image/*" is-multipe="true">
                                        <div class="fallback"><input type="text" name="color_file" id="color_file_${i}" class="" /></div>
                                        <div class="dz-message needsclick">
                                            <i class="h1 text-muted ri-upload-cloud-2-line"></i>
                                            <h4>Drop files here or click to upload.</h4>
                                        </div>
                                        <input type="hidden" name="color_file_name_${i}" id="color_file_name_${i}" class="file_name" />
                                    </div>
                                    <div class="dropzone-previews only-preview" id="file-previews-${i}" data-index="${i}"></div> 
                                </td>
                                <td><button class="btn btn-danger" onclick="removeColor(${i})">Remove</button></td>`;
                }
                else{
                    clr_html+=`<td>${imgs_html}</td>`;
                }
            clr_html+=`</tr>`;
            i++;
        });
    }
    return clr_html;
    
}

function manageColorImgDropzone(){
    if(colorData.length > 0){
        var cd_ind=0;
        colorData.forEach(clrdata => {
            var clrimgdata = JSON.parse(clrdata.img_data);
            setFileDropzone($("#color_file_"+cd_ind));
            clrimgdata.forEach(function(imgData) {
                imgData.upload = imgData;
                myDropzone[cd_ind+predefine_dropzones].emit( "addedfile", imgData );
                myDropzone[cd_ind+predefine_dropzones].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
                myDropzone[cd_ind+predefine_dropzones].files.push( imgData );
                imgData.upload = "";
            });
            $("#file-previews-"+cd_ind).sortable({
                items: '.dz-image-preview',
                cursor: 'move',
                opacity: 0.5,
                containment: "#file-previews-"+cd_ind,
                elMargin: [10, 10, 0, 0],
                distance: 150,
                tolerance: 'pointer',
                flow: 'h-flow',
                wrapWidth: 'auto',
                wrapHeight: 'auto',
                elWidth: 'auto',
                elHeight: 'auto',
                stop: function (e) {
                    var current_srt_index = +e.target.getAttribute('data-index');
                    // var queue = myDropzone[current_srt_index+2].files;
                    var queue = JSON.parse($('#color_file_name_'+current_srt_index).val());
                    var newQueue = [];
                    var newFileQueue = [];
                    $('#file-previews-'+current_srt_index+' .dz-image-preview [data-dz-name]').each(function (count, el) {           
                        var name = el.innerHTML;
                        queue.forEach(function(file) {
                           if (file.name === name) {
                               newQueue.push(file);
                               newFileQueue.push(file.url);
                            }
                        });
                    });
                    myDropzone[current_srt_index+predefine_dropzones].files = newQueue;
                    let string_newQueue = JSON.stringify(newQueue);
                    let string_newFileQueue = JSON.stringify(newFileQueue);
                    colorData[current_srt_index].img_data = string_newQueue;
                    colorData[current_srt_index].img_url = string_newFileQueue;
                    $('#color_file_name_'+current_srt_index).val(string_newQueue);
            
                }
            });
            $('#color_file_name_'+cd_ind).val(JSON.stringify(clrimgdata));
            cd_ind++;
        });
    }
}

function removeColor(i){
    var clrdata = colorData[i];
    var clrimgdata = JSON.parse(clrdata.img_data);
    var imgs = [];
    clrimgdata.forEach(clrimg => {
        imgs.push(clrimg.url);
    });
    remove_file(imgs, true);
    $("#color_list .color"+i).remove();
    colorData.splice(i, 1);
    myDropzone.splice(i+predefine_dropzones, 1);
}

$("#add_verient").on("click", function(){
    var verient_name = $("#verient_name").val();
    var fule_type = $("#verient_fule_type :selected").val();
    var fule_type_text = $("#verient_fule_type :selected").text();
    var transmision = $("#verient_transmision :selected").val();
    var transmision_text = $("#verient_transmision :selected").text();
    var engine = $("#verient_engine").val();
    var price = $("#verient_price").val();
    if(verient_name && fule_type && transmision && (engine || fule_type==ev_fule_id) && price){
        var vdata = {
            verient_name: verient_name,
            fule_type: fule_type,
            fule_type_text: fule_type_text,
            transmision: transmision,
            transmision_text: transmision_text,
            engine: engine,
            price: price,
            isnew: ($('#formevent').val() == 'update') ? true : false
        };
        verientData.push(vdata);
        $("#verient_list").html(getVerientTblData(true));

        $("#verient_name").val('');
        $("#verient_fule_type").val('').trigger('change');
        $("#verient_transmision").val('').trigger('change');
        $("#verient_engine").val('');
        $("#verient_price").val('');
    }
    else {
        showError("Please fill all the details.");
    }
});

function getVerientTblData(editable = false){
    var ver_html = "";
    if(verientData.length > 0){
        var i=0;
        verientData.forEach(verdata => {
            ver_html += `<tr class="verient${i}">
                <td>${verdata.verient_name}</td>
                <td>${verdata.fule_type_text}</td>
                <td>${verdata.transmision_text}</td>
                <td>${verdata.engine}</td>
                <td>&#x20B9;${verdata.price}</td>`;
            if(editable){
                ver_html+=`<td><button class="btn btn-danger" onclick="removeVerient(${i})">Remove</button></td>`;
            }
            ver_html+=`</tr>`;
            i++;
        });
    }
    return ver_html;
}

function removeVerient(i){
    $("#verient_list .verient"+i).remove();
    verientData.splice(i, 1);
}

$("#add_video").on("click", function(){
    var video_link = $("#video_link").val();
    if(video_link){
        videoData.push(video_link);
        $("#video_list").html(getVideoTblData(true));
        manageVideoTitle();
        $("#video_link").val('');
    }
    else {
        showError("Please fill all the details.");
    }
});

function getVideoTblData(editable = false){
    var ver_html = "";
    if(videoData && videoData.length > 0){
        var i=0;
        videoData.forEach(viddata => {
            var vid_match = viddata.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/);
            if(vid_match){
                var youtube_video_id = vid_match.pop();
                fetch(`https://noembed.com/embed?dataType=json&url=${viddata}`)
                .then(res => res.json())
                .then(data => {
                    var url = data.url;
                    var v_id = url.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
                    $("#vid_title_"+v_id).html(data.title);
                });

                ver_html+=`<div class="video-preview-div video${i}">`;
                ver_html += `<img src="//img.youtube.com/vi/${youtube_video_id}/0.jpg" class="video-preview">`;
                ver_html += `<a class="play-btn" href="${viddata}" target="_blank"><i class="ri-play-circle-fill"></i></a>`;
                ver_html += `<span id="vid_title_${youtube_video_id}" class="video-title"></span>`;
                // ver_html += `<iframe class="video-preview" src="${viddata}" allowfullscreen></iframe>`;
                if(editable){
                    ver_html+=`<button class="btn btn-default remove-video" onclick="removeVideo(${i})"><i class="ri-close-line"></i></button>`;
                }
                ver_html+=`</div>`;
            }
            i++;
        });
    }
    return ver_html;
}

function manageVideoTitle(){
    if(videoData && videoData.length > 0){
        videoData.forEach(viddata => {
            fetch(`https://noembed.com/embed?dataType=json&url=${viddata}`)
            .then(res => res.json())
            .then(data => {
                var url = data.url;
                var v_id = url.match(/youtube\.com.*(\?v=|\/embed\/)(.{11})/).pop();
                $("#vid_title_"+v_id).html(data.title);
            });
        });
    }
}

function removeVideo(i){
    $("#video_list .video"+i).remove();
    videoData.splice(i, 1);
}

if($('#'+FORMNAME).length){		
    $('#'+FORMNAME).validate({
        rules:{
            name:{
                required: true,
            },
            brand:{
                required: true,
            },
            price:{
                required: true,
            },
            fule_type:{
                required: true,
            },
            // engine:{
            //     required: true,
            // },
            modal_year:{
                required: true,
            },
            transmision:{
                required: true,
            },
            seater:{
                required: true,
            },
            car_type:{
                required: true,
            },
            description:{
                required: true,
            },
        },messages:{
            name:{
                required:"name is required",
            },
            brand:{
                required:"brand is required",
            },
            price:{
                required:"price is required",
            },
            fule_type:{
                required:"fule type is required",
            },
            // engine:{
            //     required:"engine displacement is required",
            // },
            modal_year:{
                required:"modal year is required",
            },
            transmision:{
                required:"transmision is required",
            },
            seater:{
                required:"seater is required",
            },
            car_type:{
                required:"car type is required",
            },
            description:{
                required:"description is required",
            },
        },
        submitHandler: function(form){
            showLoading();
            var req_data = {
                op: CURRENT_PAGE,
                action: "add_data",
                name: $('#name').val(),
                brand: $('#brand :selected').val(),
                brand_name: $('#brand :selected').text(),
                price: $('#price').val(),
                fule_type: $('#fule_type :selected').val(),
                fule_type_name: $('#fule_type :selected').text(),
                engine: $('#engine').val(),
                comming_soon: $("#comming_soon").prop('checked') ? 1 : 0, 
                modal_year: $('#modal_year').val(),
                transmision: $('#transmision :selected').val(),
                transmision_name: $('#transmision :selected').text(),
                seater: $('#seater').val(),
                car_type: $('#car_type :selected').val(),
                car_type_name: $('#car_type :selected').text(),
                mileage: $('#mileage').val(),
                ground_clearance: $('#ground_clearance').val(),
                warranty: $('#warranty').val(),
                fuel_tank: $('#fuel_tank').val(),
                length: $('#length').val(),
                width: $('#width').val(),
                height: $('#height').val(),
                img_360: $('#img_360').val(),
                driving_range: $('#driving_range').val(),
                battery_warranty: $('#battery_warranty').val(),
                battery_capacity: $('#battery_capacity').val(),
                ncap_rating: $('#ncap_rating').val(),
                discontinued: $("#discontinued").prop('checked') ? 1 : 0, 
                description: editor[0].getData(),
                color_data: JSON.stringify(colorData),
                verient_data: JSON.stringify(verientData),
                video_data: JSON.stringify(videoData),
                formevent: $('#formevent').val(),
                id: $('#id').val()
            };
            if($('#file_name').val())
            {
                req_data['file']=JSON.stringify(JSON.parse($('#file_name').val()));
            }
            if($('#gallery_file_name').val())
            {
                req_data['gallery_file']=JSON.stringify(JSON.parse($('#gallery_file_name').val()));
            }
            if($('#interior_gallery_file_name').val())
            {
                req_data['interior_gallery_file']=JSON.stringify(JSON.parse($('#interior_gallery_file_name').val()));
            }
            if($('#brochure_file_name').val())
            {
                req_data['brochure_file']=JSON.stringify(JSON.parse($('#brochure_file_name').val()));
            }
            doAPICall(req_data, async function(data){
                if (data && data != null && data.success == true) {
                    changeView('details');
                    showMessage(data.message);
                    resetValidation(FORMNAME);
                    hideLoading();
                    await table.clearPipeline().draw();
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

function edit_car_details(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        colorData = (CURRENT_DATA.color_data && CURRENT_DATA.color_data != "") ? JSON.parse(CURRENT_DATA.color_data) : [];
        verientData = (CURRENT_DATA.verient_data && CURRENT_DATA.verient_data != "") ? JSON.parse(CURRENT_DATA.verient_data) : [];
        videoData = (CURRENT_DATA.video_data && CURRENT_DATA.video_data != "") ? JSON.parse(CURRENT_DATA.video_data) : [];

        $('#id').val(CURRENT_DATA.id);
        $('#formevent').val('update');

        $('#name').val(CURRENT_DATA.name);
        $('#price').val(CURRENT_DATA.price);
        $('#engine').val(CURRENT_DATA.engine);
        $("#comming_soon").prop('checked', CURRENT_DATA.comming_soon);
        manageCommingSoon();
        $('#modal_year').val(CURRENT_DATA.modal_year);
        $('#seater').val(CURRENT_DATA.seater);

        $('#mileage').val(CURRENT_DATA.mileage);
        $('#ground_clearance').val(CURRENT_DATA.ground_clearance);
        $('#warranty').val(CURRENT_DATA.warranty);
        $('#fuel_tank').val(CURRENT_DATA.fuel_tank);
        $('#length').val(CURRENT_DATA.length);
        $('#width').val(CURRENT_DATA.width);
        $('#height').val(CURRENT_DATA.height);
        $('#img_360').val(CURRENT_DATA.img_360);
        
        $('#driving_range').val(CURRENT_DATA.driving_range);
        $('#battery_warranty').val(CURRENT_DATA.battery_warranty);
        $('#battery_capacity').val(CURRENT_DATA.battery_capacity);
        $('#ncap_rating').val(CURRENT_DATA.ncap_rating);

        $("#discontinued").prop('checked', CURRENT_DATA.discontinued);

        editor[0].setData(CURRENT_DATA.description);

        /** main img **/
        var logoData = (CURRENT_DATA.file_data == "" || CURRENT_DATA.file_data == undefined) ? [] : JSON.parse(CURRENT_DATA.file_data);
        logoData.forEach(function(imgData) {
            imgData.upload = imgData;
            myDropzone[0].emit( "addedfile", imgData );
            myDropzone[0].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
            myDropzone[0].files.push( imgData );
            imgData.upload = "";
        });
        if($("#cars_file").attr('is-multipe') != 'true' && logoData.length > 0)
        {
            $("#cars_file").addClass('dz-max-files-reached');
        }
        $('#file_name').val(JSON.stringify(logoData));

        /** brochure **/
        var brochureData = (CURRENT_DATA.brochure_file_data == "" || CURRENT_DATA.brochure_file_data == undefined) ? [] : JSON.parse(CURRENT_DATA.brochure_file_data);
        brochureData.forEach(function(imgData) {
            imgData.upload = imgData;
            myDropzone[1].emit( "addedfile", imgData );
            // myDropzone[1].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
            myDropzone[1].files.push( imgData );
            imgData.upload = "";
        });
        if($("#cars_brochure_file").attr('is-multipe') != 'true' && brochureData.length > 0)
        {
            $("#cars_brochure_file").addClass('dz-max-files-reached');
        }
        $('#brochure_file_name').val(JSON.stringify(brochureData));
        
        /** exterior **/
        var galleryData = (CURRENT_DATA.gallery_file_data == "" || CURRENT_DATA.gallery_file_data == undefined) ? [] : JSON.parse(CURRENT_DATA.gallery_file_data);
        galleryData.forEach(function(imgData) {
            imgData.upload = imgData;
            myDropzone[2].emit( "addedfile", imgData );
            myDropzone[2].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
            myDropzone[2].files.push( imgData );
            imgData.upload = "";
        });
        if($("#cars_gallery").attr('is-multipe') != 'true' && galleryData.length > 0)
        {
            $("#cars_gallery").addClass('dz-max-files-reached');
        }
        $('#gallery_file_name').val(JSON.stringify(galleryData));
       
        /** interior **/
        var interior_galleryData = (CURRENT_DATA.interior_gallery_file_data == "" || CURRENT_DATA.interior_gallery_file_data == undefined) ? [] : JSON.parse(CURRENT_DATA.interior_gallery_file_data);
        interior_galleryData.forEach(function(imgData) {
            imgData.upload = imgData;
            myDropzone[3].emit( "addedfile", imgData );
            myDropzone[3].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
            myDropzone[3].files.push( imgData );
            imgData.upload = "";
        });
        if($("#cars_interior_gallery").attr('is-multipe') != 'true' && interior_galleryData.length > 0)
        {
            $("#cars_interior_gallery").addClass('dz-max-files-reached');
        }
        $('#interior_gallery_file_name').val(JSON.stringify(interior_galleryData));
        
        $("#verient_list").html(getVerientTblData(true));
        $("#color_list").html(getColorTbl(true));
        manageColorImgDropzone();
        $("#video_list").html(getVideoTblData(true));
        manageVideoTitle();

        fill_details();
        changeView('form', true);
    }
}

function view_car_details(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        colorData = JSON.parse(CURRENT_DATA.color_data);
        verientData = JSON.parse(CURRENT_DATA.verient_data);
        var html = `<table class="table"><tbody>
            <tr class="index-rows">
                <th class="index-rows" style="width: 14%">Mileage</th>
                <td class="index-rows" style="width: 20%">${(CURRENT_DATA.mileage) ? CURRENT_DATA.mileage : '-'}</td>
                <th class="index-rows" style="width: 13%">Ground Clearance</th>
                <td class="index-rows" style="width: 20%">${(CURRENT_DATA.ground_clearance) ? CURRENT_DATA.ground_clearance + ' mm' : '-'}</td>
                <th class="index-rows" style="width: 13%">Warranty</th>
                <td class="index-rows" style="width: 20%">${(CURRENT_DATA.warranty) ? CURRENT_DATA.warranty : '-'}</td>
            </tr>
            <tr class="index-rows">
                <th class="index-rows">Fuel Tank</th>
                <td class="index-rows">${(CURRENT_DATA.fuel_tank) ? CURRENT_DATA.fuel_tank + ' litre' : '-'}</td>
                <th class="index-rows">Size</th>
                <td class="index-rows" colspan="3">${(CURRENT_DATA.length) ? CURRENT_DATA.length +' mm L' : '-'} X ${(CURRENT_DATA.width) ? CURRENT_DATA.width +  ' mm W' : '-'} X ${(CURRENT_DATA.height) ? CURRENT_DATA.height + ' mm H' : '-'}</td>
            </tr>
        </tbody></table>`;


        html+= `<div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Color
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="25%">Color</th>
                                            <th width="75%">Images</th>
                                        </tr>
                                    </thead>
                                    <tbody>${getColorTbl(false)}</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Verient
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th width="40%">Name</th>
                                            <th width="15%">Fule Type</th>
                                            <th width="15%">Transmision</th>
                                            <th width="15%">Engine</th>
                                            <th width="15%">Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>${getVerientTblData(false)}</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            Description
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                ${CURRENT_DATA.description}
                            </div>
                        </div>
                    </div>
                </div>`;
       
        $("#comman_ListModal #comman_list_model_div").html(html);
    }
    $("#comman_ListModal").modal('show');
    $("#comman_ListModal .comman_list_model_header").html('Cars Details');
}