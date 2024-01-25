var table;
var SUBPRIMARYID = 0;
var colorData = [];
var verientData = [];
jQuery(function () {
    HTMLEditor("description", 0);
    get_data();
});
function resetform(){
    $('#formevent').val('submit');
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
                    return "&#x20B9;"+to_number_format(row.price);
                }, name: 'price', width: "10%"
            },
        ],
        "columnDefs": [{
            "targets": 9,
            "className": "text-end",
            "data": "id",
            "render": function (data, type, row, meta) {
                var rowid="'"+row.id+"'";
                var html='<button class="btn btn-info rounded-pill tbl-btn" onclick="view_news_details(' + meta.row + ')"><i class="uil-notes"></i></button>';
                if(editright == 1)
                {
                    html+='<button class="btn btn-primary rounded-pill tbl-btn" onclick="edit_slider(' + meta.row + ')"><i class="ri-pencil-fill"></i></button>';
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
        $("#color_list").html(getColorTbl(true));
        dataNotDeleteFileOnRemove = true;
        myDropzone[1].removeAllFiles(true); 
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
                <td>${clrdata.color}</td>
                <td>${imgs_html}</td>`
                if(editable){
                    clr_html+=`<td><button class="btn btn-danger" onclick="removeColor(${i})">Remove</button></td>`;
                }
            clr_html+=`</tr>`;
            i++;
        });
    }
    return clr_html;
    
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
}

$("#add_verient").on("click", function(){
    var verient_name = $("#verient_name").val();
    var fule_type = $("#verient_fule_type :selected").val();
    var fule_type_text = $("#verient_fule_type :selected").text();
    var transmision = $("#verient_transmision :selected").val();
    var transmision_text = $("#verient_transmision :selected").text();
    var engine = $("#verient_engine").val();
    var price = $("#verient_price").val();
    if(verient_name && fule_type && transmision && engine && price){
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
                <td>&#x20B9;${to_number_format(verdata.price)}</td>`;
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
            engine:{
                required: true,
            },
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
            engine:{
                required:"engine displacement is required",
            },
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
                modal_year: $('#modal_year').val(),
                transmision: $('#transmision :selected').val(),
                transmision_name: $('#transmision :selected').text(),
                seater: $('#seater').val(),
                car_type: $('#car_type :selected').val(),
                car_type_name: $('#car_type :selected').text(),
                description: editor[0].getData(),
                color_data: JSON.stringify(colorData),
                verient_data: JSON.stringify(verientData),
                formevent: $('#formevent').val(),
                id: $('#id').val()
            };
            if($('#file_name').val())
            {
                req_data['file']=JSON.stringify(JSON.parse($('#file_name').val()));
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

function edit_slider(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        colorData = JSON.parse(CURRENT_DATA.color_data);
        verientData = JSON.parse(CURRENT_DATA.verient_data);

        $('#id').val(CURRENT_DATA.id);
        $('#formevent').val('update');

        $('#name').val(CURRENT_DATA.name);
        $('#price').val(CURRENT_DATA.price);
        $('#engine').val(CURRENT_DATA.engine);
        $('#modal_year').val(CURRENT_DATA.modal_year);
        $('#seater').val(CURRENT_DATA.seater);

        editor[0].setData(CURRENT_DATA.description);

        var logoData = (CURRENT_DATA.file_data == "" || CURRENT_DATA.file_data == undefined) ? [] : JSON.parse(CURRENT_DATA.file_data);
        logoData.forEach(function(imgData) {
            myDropzone[0].emit( "addedfile", imgData );
            myDropzone[0].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
            myDropzone[0].files.push( imgData );
        });
        if($("#cars_file").attr('is-multipe') != 'true' && logoData.length > 0)
        {
            $("#cars_file").addClass('dz-max-files-reached');
        }
        $('#file_name').val(JSON.stringify(logoData));

        $("#verient_list").html(getVerientTblData(true));
        $("#color_list").html(getColorTbl(true));

        fill_details();
        changeView('form', true);
    }
}

function view_news_details(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        colorData = JSON.parse(CURRENT_DATA.color_data);
        verientData = JSON.parse(CURRENT_DATA.verient_data);
        var html = '<table class="table table-striped"><tbody>';
            html += '<tr class="index-rows">';
                html += '<th class="index-rows">Description</th>';
                html += '<td class="index-rows">'+CURRENT_DATA.description+'</td>';
            html += '</tr>';
        html += '</tbody></table>';


        var html = `<div class="accordion" id="accordionExample">
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