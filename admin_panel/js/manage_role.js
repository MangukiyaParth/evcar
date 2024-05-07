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
            { data: 'role', name: 'role', width: "60%" },
        ],
        "columnDefs": [{
            "targets": 2,
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
                if(deleteright == 1 && row.user_cnt == 0)
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
            role:{
                required: true,			
            },
        },messages:{
            role:{
                required:"role is required",
            },
        },
        submitHandler: function(form){
            showLoading();
            var req_data = {
                op: CURRENT_PAGE
                , action: "add_data"
                , role: $('#role').val()
                , formevent: $('#formevent').val()
                , id: $('#id').val()
            };
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
        $('#role').val(CURRENT_DATA.role);
        $('#formevent').val('update');
        changeView('form', true);
    }
}
