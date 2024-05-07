var table;
var SUBPRIMARYID = 0;
jQuery(function () {
    get_data();
    $("#resetpass_modal #resetpass").on('submit', function (e) {
        e.preventDefault();
        resetuserpass();
    });
});
function resetform(){
    $('.passdiv').removeClass('d-none');
    $('#formevent').val('submit');
    fill_user_field();
}
$('#roleid').change(function (e) { 
    e.preventDefault();
    $('.ledgerDiv').addClass('d-none');
    if ($('#roleid :selected').attr('data-haslogin')==1) {
        $('.logindiv').removeClass('d-none');
    }
});

function fill_user_field(roleid='',stateid='',cityid='') {
    showLoading();
    var req_data = {
        op: "fill_selection"
        ,action: "fill_user_field"
    };
    doAPICall(req_data, function (res) { success_user_field(res) });
    function success_user_field(data) {
        if (data && data != null && data.success == true) {
            hideLoading();
            
            var role_html='';
            var row_role=data.roles;
            for(var i=0;i< row_role.length;i++)
            {
                role_html+="<option value='"+row_role[i].id+"' data-haslogin='1'>"+row_role[i].role+"</option>";
            }
            $('#roleid').html(role_html);
            if(roleid)
            {
                $('#roleid').val(roleid);
            }
            $('.logindiv').addClass('d-none');
            if ($('#roleid :selected').attr('data-haslogin')==1) {
                $('.logindiv').removeClass('d-none');
            }

            var state_html='';
            var row_state=data.state;
            for(var i=0;i< row_state.length;i++)
            {
                state_html+="<option value='"+row_state[i].id+"'>"+row_state[i].statename+"</option>";
            }
            
            $('#stateid').html(state_html);
            if(stateid)
            {
                $('#stateid').val(stateid);
            }
            fill_city(cityid);
            return false;
        }
        else if (data && data != null && data.success == false) {
            hideLoading();
            // showError(data.message);
            $('#roleid').html('');
            $('#stateid').html('');
            return false;
        }
    }
}
$('#stateid').change(function (e) { 
    e.preventDefault();
    fill_city();
});
function fill_city(cityid= '') {
    showLoading();
    var req_data = {
        op: "fill_selection"
        ,action: "fill_city"
        ,stateid: $('#stateid').val()
    };
    doAPICall(req_data, function (res) { success_city(res) });
    function success_city(data) {
        if (data && data != null && data.success == true) {
            hideLoading();
    
            var cty_html='';
            var row_cty=data.city;
            for(var i=0;i< row_cty.length;i++)
            {
                cty_html+="<option value='"+row_cty[i].id+"'>"+row_cty[i].cityname+"</option>";
            }
            $('#cityid').html(cty_html);
            if(cityid)
            {
                $('#cityid').val(cityid);
            }
            return false;
        }
        else if (data && data != null && data.success == false) {
            hideLoading();
            $('#ctyid').html('');
            return false;
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
            { data: 'id', name: 'id', "width": "0%", className: "d-none" },
            { data: 'rolename', name: 'rolename' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
        ],
        "columnDefs": [{
            "targets": 4,
            "className": "text-end",
            "data": "id",
            "render": function (data, type, row, meta) {
                var rowid="'"+row.id+"'";
                var html='<button class="btn btn-info rounded-pill tbl-btn" onclick="view_user_details(' + meta.row + ')"><i class="uil-layer-group"></i></button>';
                if(addright == 1)
                {
                    html+='\<button class="btn btn-warning rounded-pill tbl-btn" onclick="reset_pass(' + meta.row + ')"><i class="ri-arrow-left-right-fill"></i></button>';
                }
                if(editright == 1)
                {
                    html+='\<button class="btn btn-primary rounded-pill tbl-btn" onclick="edit_user(' + meta.row + ')"><i class="ri-pencil-fill"></i></button>';
                }
                if(deleteright == 1)
                {
                    html+='\<button class="btn btn-danger rounded-pill tbl-btn" onclick="delete_record(' + rowid + ')"><i class="uil-trash-alt"></i></button>';
                }
                return type === 'display' ? html : "";
            }
        }]
    });
}
if($('#'+FORMNAME).length){		
    $('#'+FORMNAME).validate({
        rules:{
            roleid:{
                required: true,			
            },
            personname:{
                required: true,			
            },
            contact1:{
                required: true,			
            },
            stateid:{
                required: true,			
            },
            cityid:{
                required: true,			
            },
            username:{
                required: true,			
            },
            password:{
                required: true,			
            },
            cn_password:{
                required: true,	
                equalTo: "#password"		
            },
            
        },messages:{
            roleid:{
                required:"Role is required",		
            },
            personname:{
                required:"Person name is required",		
            },
            contact1:{
                required:"Contact1 is required",		
            },
            stateid:{
                required:"State is required",		
            },
            cityid:{
                required:"City is required",		
            },
            username:{
                required:"User name is required",		
            },
            password:{
                required:"password is required",		
            },
            cn_password:{
                required:"password is required",
                equalTo: "Confirm password must equal to Password"		
            },
        },
        submitHandler: function(form){
            showLoading();
            var formData = {
                op: CURRENT_PAGE
                , action: "add_data"
            };
            $.each($('#'+FORMNAME).serializeArray(), function(_, kv) {
                if (formData.hasOwnProperty(kv.name)) {
                    formData[kv.name] = $.makeArray(formData[kv.name]);
                    formData[kv.name].push(kv.value);
                }
                else {
                    formData[kv.name] = kv.value;
                }
            });

            doAPICall(formData, async function(data){
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

function edit_user(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        $('#id').val(CURRENT_DATA.id);
        if($('#stateid').html().trim()=='' || $('#cityid').html().trim()=='' || $('#roleid').html().trim()=='')
        {
            fill_user_field(CURRENT_DATA.roleid,CURRENT_DATA.stateid,CURRENT_DATA.city);
        }
        else{
            $('#stateid').val(CURRENT_DATA.stateid);
            $('#roleid').val(CURRENT_DATA.roleid);
            fill_city(CURRENT_DATA.city);
        }
        
        $('#personname').val(CURRENT_DATA.name);
        $('#contact1').val(CURRENT_DATA.contact);
        $('#email').val(CURRENT_DATA.email);
        $('#address').val(CURRENT_DATA.address);
        $('#pincode').val(CURRENT_DATA.pincode);
        $('#username').val(CURRENT_DATA.username);
        $('.passdiv').addClass('d-none');
        
        $('#formevent').val('update');
        changeView('form', true);
    }
}

async function view_user_details(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        var current_index = $("#rate_list .index-rows").length;
        var html = '<table class="table table-striped"><tbody>';
        html += '<tr class="index-rows">';
            html += '<th class="index-rows">Role</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.rolename+'</td>';
            html += '<th class="index-rows">Person Name</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.name+'</td>';
        html += '</tr>';
        html += '<tr class="index-rows">';
            html += '<th class="index-rows">Contact</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.contact+'</td>';
            html += '<th class="index-rows">Email</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.email+'</td>';
        html += '</tr>';
        html += '<tr class="index-rows">';
            html += '<th class="index-rows">Addess</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.address+'</td>';
            html += '<th class="index-rows">State</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.statename+'</td>';
        html += '</tr>';
        html += '<tr class="index-rows">';
            html += '<th class="index-rows">City</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.cityname+'</td>';
            html += '<th class="index-rows">Pincode</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.pincode+'</td>';
        html += '</tr>';
        html += '<tr class="index-rows">';
            html += '<th class="index-rows">User Name</th>';
            html += '<td class="index-rows">'+CURRENT_DATA.username+'</td>';
        html += '</tr>';
        html += '</tbody></table>';
        await $("#comman_ListModal #comman_list_model_div").html(html);
    }
    $("#comman_ListModal").modal('show');
    $("#comman_ListModal .comman_list_model_header").html('Ledger Details');
}

async function reset_pass(index) {
    if (TBLDATA.length > 0) {
        CURRENT_DATA = TBLDATA[index];
        $('#resetpass_modal #userid').val(CURRENT_DATA.id);
        $('#resetpass_modal .usernamesp').html(CURRENT_DATA.username);
        $('#resetpass_modal #confirmPassword').val('');
        $('#resetpass_modal #mdpassword').val('');
    }
    $("#resetpass_modal").modal('show');
}

async function resetuserpass() {
    var password = document.getElementById("mdpassword").value;
    var confirmPassword = document.getElementById("confirmPassword").value;
    var passwordError = document.getElementById("passwordError");

    if (password !== confirmPassword) {
        passwordError.textContent = "Passwords do not match.";
    } else {
        showLoading();
        var req_data = {
            op:CURRENT_PAGE
            , action: 'resetuserpass'
            , password: $('#resetpass #mdpassword').val()
            , id: $('#resetpass #userid').val()
        };
        doAPICall(req_data, function (data) {
            if (data && data != null && data.success == true) {
                hideLoading();
                showMessage(data.message);
                $("#resetpass_modal").modal('hide');
                return false;
            }
            else if (data && data != null && data.success == false) {
                hideLoading();
                PRIMARY_ID = 0;
                showError(data.message);
                return false;
            }
        });
    }
    return false;
}