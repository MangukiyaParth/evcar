var table;
var SUBPRIMARYID = 0;
jQuery(function () {
    get_data();
});
function resetform(){
    $('#formevent').val('submit');
}
$('#dis_order').on('input', function() {
    // Allow only numbers (0-9) and backspace
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
  });
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
            { data: 'title', name: 'title' },
            { data: 'orderno', name: 'orderno' },
            { data: 'btntext', name: 'btntext' },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    var details ='';
                    if(row.file)
                    {
                        var filee=(row.file).split('.');
                        if(filee[1] == 'pdf')
                        {
                            var details = "<a href='" + WEB_API_FOLDER + row.file + "' target='_blank'><i style='font-size: 40px;' class='ri-file-pdf-line'></i></a>";
                        }else{
                            var details = "<a href='" + WEB_API_FOLDER + row.file + "' target='_blank'><img style='height: 60px;' src='" + WEB_API_FOLDER + row.file + "'></a>";
                        }
                    }
                    return details;
                }, name: 'file'
            },
        ],
        "columnDefs": [{
            "targets": 5,
            "className": "text-end",
            "data": "id",
            "render": function (data, type, row, meta) {
                var rowid="'"+row.id+"'";
                var html='<button class="btn btn-info rounded-pill tbl-btn" onclick="view_slider_details(' + meta.row + ')"><i class="uil-notes"></i></button>';
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
            title:{
                required: true,			
            },
            dis_order:{
                required: true,			
            },
            button:{
                required: true,			
            },
            description:{
                required: true,			
            },
        },messages:{
            title:{
                required:"title name is required",
            },
            dis_order:{
                required:"dispaly order is required",
            },
            button:{
                required:"button is required",
            },
            description:{
                required:"description is required",
            },
        },
        submitHandler: function(form){
            showLoading();
            var req_data = {
                op: CURRENT_PAGE
                , action: "add_data"
                , title: $('#title').val()
                , dis_order: $('#dis_order').val()
                , button: $('#button').val()
                , description: $('#description').val()
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
        $('#title').val(CURRENT_DATA.title);
        $('#button').val(CURRENT_DATA.btntext);
        $('#dis_order').val(CURRENT_DATA.orderno);
        $('#description').val(CURRENT_DATA.description); 
        $('#formevent').val('update');
        var logoData = (CURRENT_DATA.file_data == "" || CURRENT_DATA.file_data == undefined) ? [] : JSON.parse(CURRENT_DATA.file_data);
        logoData.forEach(function(imgData) {
            myDropzone[0].emit( "addedfile", imgData );
            myDropzone[0].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
            myDropzone[0].files.push( imgData );
        });
        if($("#brand_logo").attr('is-multipe') != 'true' && logoData.length > 0)
        {
            $("#brand_logo").addClass('dz-max-files-reached');
        }
        $('#file_name').val(JSON.stringify(logoData));

        changeView('form', '', true);
    }
}

async function view_slider_details(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        var html = '<table class="table table-striped"><tbody>';
            html += '<tr class="index-rows">';
                html += '<th class="index-rows">Description</th>';
                html += '<td class="index-rows">'+CURRENT_DATA.description+'</td>';
            html += '</tr>';
        html += '</tbody></table>';

       
        await $("#comman_ListModal #comman_list_model_div").html(html);
    }
    $("#comman_ListModal").modal('show');
    $("#comman_ListModal .comman_list_model_header").html('Slider Details');
}