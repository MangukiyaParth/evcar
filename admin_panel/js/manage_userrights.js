var table;
var SUBPRIMARYID = 0;
jQuery(function () {
    fill_role();
});
function resetform() { 
 }
function fill_role() {
    showLoading();
    var req_data = {
        op: "fill_selection"
        ,action: "fill_role"
    };
    doAPICall(req_data, function (res) { success_role(res) });
    function success_role(data) {
        if (data && data != null && data.success == true) {
            hideLoading();
            var op_html="<option value=''>Select Role</option>";
            var row=data.role;
            // console.log(row[0].statename);
            for(var i=0;i< row.length;i++)
            {
                op_html+="<option value='"+row[i].id+"'>"+row[i].role+"</option>";
            }
            // console.log(op_html);
            $('#roleid').html(op_html);
            
            return false;
        }
        else if (data && data != null && data.success == false) {
            hideLoading();
            $('#roleid').html('');
            return false;
        }
    }
    return false;
}
$("#roleid").change(function () { 
    fill_user(); 
    
});
function fill_user() {
    showLoading();
    var req_data = {
        op: "fill_selection"
        ,action: "fill_user"
        ,roleid:$('#roleid').val()
    };
    doAPICall(req_data, function (res) { success_user(res) });
    function success_user(data) {
        if (data && data != null && data.success == true) {
            hideLoading();
            var op_html="<option value=''>Select User</option>";
            var row=data.data;
            // console.log(row[0].statename);
            for(var i=0;i< row.length;i++)
            {
                op_html+="<option value='"+row[i].id+"'>"+row[i].name+"</option>";
            }
            // console.log(op_html);
            $('#personid').html(op_html);

            if($('#personid').val() =='')
            {
                fill_userrights(); 
            }
            return false;
        }
        else if (data && data != null && data.success == false) {
            hideLoading();
            $('#personid').html('');
            return false;
        }
    }
    return false;
}
$("#personid").change(function () { 
    fill_userrights(); 
})
function fill_userrights() {
    showLoading();
    var req_data = {
        op: "fill_selection"
        ,action: "fill_userrights"
        ,roleid:$('#roleid').val()
        ,personid:$('#personid').val()
    };
    doAPICall(req_data, function (res) { success_userrights(res) });
    function success_userrights(data) {
        if (data && data != null && data.success == true) {
            hideLoading();
            var op_html="";
            var row=data.data;
            for(var i=0;i< row.length;i++)
            {
                var viewchk='';
                var viewval=0;
                var addchk='';
                var addval=0;
                var editchk='';
                var editval=0;
                var deletechk='';
                var deleteval=0;
                if(row[i].viewright==1)
                {
                    var viewchk='checked';
                    var viewval=1;
                }
                if(row[i].addright==1)
                {
                    var addchk='checked';
                    var addval=1;
                }
                if(row[i].editright==1)
                {
                    var editchk='checked';
                    var editval=1;
                }
                if(row[i].deleteright==1)
                {
                    var deletechk='checked';
                    var deleteval=1;
                }
                op_html+='<tr data-index="'+row[i].id+'">';
                op_html+='<td>'+row[i].menuname+'<input type="hidden" name="tbl_menuid[]" id="tbl_menuid'+row[i].id+'" class="tbl_menuid" value="'+row[i].id+'"></td>';
                op_html+='<td><input class="form-check-input tbl_allchk" type="checkbox"  id="tbl_allchk'+row[i].id+'" name="tbl_allchk[]" ><label class="form-check-label" for="tbl_allchk'+row[i].id+'"></label></td>';
                op_html+='<td><input class="form-check-input tbl_viewright" type="checkbox"  id="tbl_viewright'+row[i].id+'" name="tbl_viewright[]" '+viewchk+' value="'+viewval+'"><label class="form-check-label" for="tbl_viewright'+row[i].id+'"></label></td>';
                op_html+='<td><input class="form-check-input tbl_addright" type="checkbox"  id="tbl_addright'+row[i].id+'" name="tbl_addright[]" '+addchk+' value="'+addval+'"><label class="form-check-label" for="tbl_addright'+row[i].id+'"></label></td>';
                op_html+='<td><input class="form-check-input tbl_editright" type="checkbox"  id="tbl_editright'+row[i].id+'" name="tbl_editright[]" '+editchk+' value="'+editval+'"><label class="form-check-label" for="tbl_editright'+row[i].id+'"></label></td>';
                op_html+='<td><input class="form-check-input tbl_deleteright" type="checkbox"  id="tbl_deleteright'+row[i].id+'" name="tbl_deleteright[]" '+deletechk+' value="'+deleteval+'"><label class="form-check-label" for="tbl_deleteright'+row[i].id+'"></label></td>';
                op_html+='</tr>';
            }
            // console.log(op_html);
            $('#addtable').html(op_html);
            return false;
        }
        else if (data && data != null && data.success == false) {
            hideLoading();
            $('#addtable').html('');
            return false;
        }
    }
    return false;
}
$('body').on('change', '.tbl_allchk', function () {
    var i=$(this).closest('tr').attr('data-index');
    $('#tbl_viewright'+i).prop('checked', false);
    $('#tbl_viewright'+i).val(0);
    
    $('#tbl_addright'+i).prop('checked', false);
    $('#tbl_addright'+i).val(0);

    $('#tbl_editright'+i).prop('checked', false);
    $('#tbl_editright'+i).val(0);

    $('#tbl_deleteright'+i).prop('checked', false);
    $('#tbl_deleteright'+i).val(0);
    if($('#tbl_allchk'+i).is(':checked'))
    {
        $('#tbl_viewright'+i).prop('checked', true);
        $('#tbl_viewright'+i).val(1);
        
        $('#tbl_addright'+i).prop('checked', true);
        $('#tbl_addright'+i).val(1);

        $('#tbl_editright'+i).prop('checked', true);
        $('#tbl_editright'+i).val(1);

        $('#tbl_deleteright'+i).prop('checked', true);
        $('#tbl_deleteright'+i).val(1);
    }
});
$('body').on('change', '.tbl_viewright', function () {
    var i=$(this).closest('tr').attr('data-index');
    $('#tbl_viewright'+i).val(0);
    if($('#tbl_viewright'+i).is(':checked'))
    {
        $('#tbl_viewright'+i).val(1);
    }
});
$('body').on('change', '.tbl_addright', function () {
    var i=$(this).closest('tr').attr('data-index');
    $('#tbl_addright'+i).val(0);
    if($('#tbl_addright'+i).is(':checked'))
    {
        $('#tbl_addright'+i).val(1);
    }
});
$('body').on('change', '.tbl_editright', function () {
    var i=$(this).closest('tr').attr('data-index');
    $('#tbl_editright'+i).val(0);
    if($('#tbl_editright'+i).is(':checked'))
    {
        $('#tbl_editright'+i).val(1);
    }
});
$('body').on('change', '.tbl_deleteright', function () {
    var i=$(this).closest('tr').attr('data-index');
    $('#tbl_deleteright'+i).val(0);
    if($('#tbl_deleteright'+i).is(':checked'))
    {
        $('#tbl_deleteright'+i).val(1);
    }
});
if($('#'+FORMNAME).length){		
    $('#'+FORMNAME).validate({
        rules:{
            roleid:{
                required: true,			
            },
        },messages:{
            roleid:{
                required:"Role is required",		
            },
        },
        submitHandler: function(form){
            var mfg_item = [];
            $('#addtable tr').each(function(){
                var sub_item = {
                    tbl_menuid: $(this).find('.tbl_menuid').val(),
                    tbl_viewright: $(this).find('.tbl_viewright').val(),
                    tbl_addright: $(this).find('.tbl_addright').val(),
                    tbl_editright: $(this).find('.tbl_editright').val(),
                    tbl_deleteright: $(this).find('.tbl_deleteright').val()
                };
                mfg_item.push(sub_item);
            });
            showLoading();
            var req_data = {
                op: CURRENT_PAGE
                ,action: 'add_data'
                , roleid: $('#roleid').val()
                , personid: $('#personid').val()
                , mfg_item: mfg_item
                , id: $('#id').val()
            };
            doAPICall(req_data, async function(data){
                if (data && data != null && data.success == true) {
                    changeView('details');
                    showMessage(data.message);
                    fill_userrights();
                    hideLoading();
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