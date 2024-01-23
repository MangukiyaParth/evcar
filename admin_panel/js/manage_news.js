var table;
var SUBPRIMARYID = 0;
jQuery(function () {
    callOnLoad();
});

function callOnLoad(){
    HTMLEditor("description", 0);
    get_data();
}

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
            { data: 'title', name: 'title', "width": "20%" },
            { data: 'news_date', name: 'news_date', "width": "10%" },
            { data: 'short_desc', name: 'short_desc', "width": "50%" },
            {
                data: null,
                orderable: false,
                render: function (data, type, row) {
                    var details ='';
                    if(row.main_image)
                    {
                        var filee=(row.main_image).split('.');
                        if(filee[1] == 'pdf')
                        {
                            var details = "<a href='" + WEB_API_FOLDER + row.main_image + "' target='_blank'><i style='font-size: 40px;' class='ri-file-pdf-line'></i></a>";
                        }else{
                            var details = "<a href='" + WEB_API_FOLDER + row.main_image + "' target='_blank'><img style='height: 60px;' src='" + WEB_API_FOLDER + row.main_image + "'></a>";
                        }
                    }
                    return details;
                }, name: 'file', "width": "10%"
            },
        ],
        "columnDefs": [{
            "targets": 5,
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
            }, "width": "10%"
        }]
    });
}
if($('#'+FORMNAME).length){		
    $('#'+FORMNAME).validate({
        rules:{
            title:{
                required: true,			
            },
            news_date:{
                required: true,			
            },
            short_description:{
                required: true,			
            },
            description:{
                required: true,			
            },
        },messages:{
            title:{
                required:"title is required",
            },
            news_date:{
                required:"Date is required",
            },
            short_description:{
                required:"Short description is required",
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
                , news_date: $('#news_date').val()
                , short_description: $('#short_description').val()
                , description: editor[0].getData()
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
        $('#news_date').val(CURRENT_DATA.news_date);
        $('#short_description').val(CURRENT_DATA.short_desc);
        // $('#description').val(CURRENT_DATA.description); 
        editor[0].setData(CURRENT_DATA.description)
        $('#formevent').val('update');
        var logoData = (CURRENT_DATA.main_image_data == "" || CURRENT_DATA.main_image_data == undefined) ? [] : JSON.parse(CURRENT_DATA.main_image_data);
        logoData.forEach(function(imgData) {
            myDropzone[0].emit( "addedfile", imgData );
            myDropzone[0].emit( "thumbnail", imgData, WEB_API_FOLDER+imgData.url );
            myDropzone[0].files.push( imgData );
        });
        if($("#news_file").attr('is-multipe') != 'true' && logoData.length > 0)
        {
            $("#news_file").addClass('dz-max-files-reached');
        }
        $('#file_name').val(JSON.stringify(logoData));

        changeView('form', '', true);
    }
}

async function view_news_details(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        var html = '<table class="table table-striped"><tbody>';
            html += '<tr class="index-rows">';
                html += '<th class="index-rows">Description</th>';
                html += '<td class="index-rows">'+CURRENT_DATA.description+'</td>';
            html += '</tr>';
        html += '</tbody></table>';

       
        await $("#comman_ListModal #comman_list_model_div").html(CURRENT_DATA.description);
    }
    $("#comman_ListModal").modal('show');
    $("#comman_ListModal .comman_list_model_header").html('News Description');
}