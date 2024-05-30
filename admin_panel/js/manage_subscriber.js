var table;
jQuery(function () {
    get_data();
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
            { data: 'email', name: 'email', width: "60%" },
            { data: 'entry_date', name: 'entry_date', width: "40%" },
        ],
            layout: {   
                topStart: {
                    pageLength: {
                        menu: [5, 10, 25, 50]
                    },
                    buttons: [
                        {
                            extend: 'excel',
                            text: 'Export To Excel',
                            sheetName: 'Subscribers',
                            className: 'ms-2 btn-primary'
                            // exportOptions: {
                            //     modifier: {
                            //         page: 'current'
                            //     }
                            // }
                        }
                    ]
                }
            }
    });
}