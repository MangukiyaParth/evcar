var table;
var SUBPRIMARYID = 0;
jQuery(function () {
    get_data();
});
function resetform(){
    $('#formevent').val('submit');
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
            { data: 'id', name: 'id', "width": "0%", className: "d-none" },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    var details ='';
                    if(row.logo)
                    {
                        details = "<a href='" + WEB_API_FOLDER + row.logo + "' target='_blank'><img style='height: 60px;' src='" + WEB_API_FOLDER + row.logo + "'></a>";
                    }
                    return details;
                }, name: 'logo', width: "5%", className: "tbl-img"
            },
            { data: 'brand', name: 'brand', width: "55%" },
        ],
        "columnDefs": [{
            "targets": 3,
            "className": "text-end",
            "data": "id",
            "width": "40%",
            "render": function (data, type, row, meta) {
                var rowid="'"+row.id+"'";
                var html='';
                if(editright == 1)
                {
                    html+='<button class="btn btn-primary rounded-pill tbl-btn" onclick="edit_slider(' + meta.row + ')"><i class="ri-pencil-fill"></i></button>';
                }
                if(deleteright == 1)
                {
                    html+='<button class="btn btn-danger rounded-pill tbl-btn" onclick="delete_record(' + rowid + ')"><i class="uil-trash-alt"></i></button>';
                }
                return type === 'display' ? html: "";
            }
        }]
    });
}
if($('#'+FORMNAME).length){		
    $('#'+FORMNAME).validate({
        rules:{
            brand:{
                required: true,			
            },
        },messages:{
            brand:{
                required:"brand is required",
            },
        },
        submitHandler: function(form){
            showLoading();
            var req_data = {
                op: CURRENT_PAGE
                , action: "add_data"
                , brand: $('#brand').val()
                , formevent: $('#formevent').val()
                , id: $('#id').val()
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
        $('#id').val(CURRENT_DATA.id);
        $('#brand').val(CURRENT_DATA.brand);
        $('#formevent').val('update');
        var logoData = (CURRENT_DATA.logo_data == "" || CURRENT_DATA.logo_data == undefined) ? [] : JSON.parse(CURRENT_DATA.logo_data);
        logoData.forEach(function(imgData) {
            imgData.upload = imgData;
            myDropzone[0].emit( "addedfile", imgData );
            myDropzone[0].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
            myDropzone[0].files.push( imgData );
            imgData.upload = "";
        });
        if($("#brand_logo").attr('is-multipe') != 'true' && logoData.length > 0)
        {
            $("#brand_logo").addClass('dz-max-files-reached');
        }
        $('#file_name').val(JSON.stringify(logoData));

        changeView('form', true);
    }
}
