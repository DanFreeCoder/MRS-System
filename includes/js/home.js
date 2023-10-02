$(document).ready(function () {

    $('.submitted_table').dataTable({
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
            'url': 'controls/submitted_form.php',
            'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": 'true',
            "aTargets": [8]
        },],
        aoColumnDefs: [{
            bSortable: false,
            aTargets: [8]
        }]
    });
    $('.draft_table').dataTable({
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'order': [],
        'ajax': {
            'url': 'controls/draft_form.php',
            'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": 'true',
            "aTargets": [6]
        },],
        aoColumnDefs: [{
            bSortable: false,
            aTargets: [6]
        }]
    });

    //requestor
    $('#requestor').hide();
    $('#checkbox').on('click', function () {
        if ($(this).is(':checked')) {
            $('#requestor').show();
        } else {
            $('#requestor').hide();
        }
    })
    //check log
    $.ajax({
        type: 'post',
        url: 'controls/check_log.php',

        success: function (response) {
            if (response > 0) {
                $('#logcount').modal('show');
            }
        }
    });

    //change later
    $('#later').on('click', () => {
        $.ajax({
            type: 'post',
            url: 'controls/change_later.php',

            success: function (response) {
                if (response > 0) {
                    $('#logcount').hide();
                }
            }
        })
    })
    //select two
    $('.select2').select2({
        dropdownParent: $('#mrf_modal')
    });

    $('#admin_side').on('click', () => window.location = "adminpage/dashboard.php?click=" + 'man');
    $('#logout').on('click', () => $('#log_out').modal('show'));
    $('#out').on('click', () => window.location = "../mrs/controls/logout.php");
    $('#settings').on('click', function (e) {
        e.preventDefault();
        $('#settingmodal').modal('show');
    });

    //modal update user settings
    $('#save_upd').on('click', (e) => {
        e.preventDefault();
        const fname = $('#upd-fname').val();
        const lname = $('#upd-lname').val();
        const uname = $('#upd-uname').val();
        const password = $('#password').val();
        const retype = $('#retype_password').val();
        const id = $('#upd-id').val();
        const mydata = 'id=' + id + '&fname=' + fname + '&lname=' + lname + '&username=' + uname + '&password=' + password;

        if (password != '') {
            if (password == retype) {
                $.ajax({
                    type: 'POST',
                    url: 'controls/update-pass.php?module=with_password',
                    data: mydata,
                    success: function (response) {
                        if (response > 0) {
                            $('#settingmodal').modal('toggle')
                            $('#user_current_pass').modal('show')
                            setTimeout(function () {
                                window.location = "../mrs/controls/logout.php";
                            }, 6000);
                        }
                    }
                })
            } else {
                toastr.error(`password is not match`).css("background-color", "#ff5e57");
            }
        } else {
            //update user dettails only
            $.ajax({
                type: 'POST',
                url: 'controls/update-pass.php?module=details_only',
                data: mydata,
                success: function (response) {
                    if (response > 0) {
                        $('#settingmodal').modal('toggle')
                        $('#user_current_pass').modal('show')
                        setTimeout(function () {
                            window.location = "../mrs/controls/logout.php";
                        }, 6000);
                    }
                }
            })
        }
    });
});
// update password first login
$(document).on('click', '.update_pass', function () {
    var password = $('#new-password').val();
    var repass = $('#con-password').val();
    if (password == repass) {
        $.ajax({
            type: 'post',
            url: 'controls/update_default_pass.php',
            data: { password: password },
            success: function (response) {
                if (response > 0) {
                    $('#logcount').modal('toggle');
                    $('#user_current_pass').modal('show')
                    setTimeout(function () {
                        window.location = "../mrs/controls/logout.php";
                    }, 6000);
                }
            }
        })
    } else {
        toastr.error(`Password is not match.`).css("background-color", "#ff5e57");
    }
});

//modal
$(document).on('click', '.views', function () {
    var id = $(this).attr('value');
    $.ajax({
        type: 'POST',
        url: 'controls/view_item_desc.php',
        data: {
            id: id
        },
        success: function (response) {
            $('#view_item').modal('show');
            $('#item-body').html(response);
        }
    })
});

$(document).on('click', '.print', function () {
    var id = $(this).attr('value');
    window.open("TCPDF-main/examples/print_by_id.php?" + 'id=' + id, '_blank');
});

$('#print_as_blank').on('click', function () {
    var project = $('#project').val();
    var project_type = $('#project_type').val();
    var classification = $('#classification').val();
    var sub_class = $('#sub_class').val();
    var cip_account = $('#cip_account').val();
    var approver = $('#approver').val();
    var requestor = $('#requestor').val();

    var checked = $('#checkbox').is(":checked");
    if (!checked) {
        requestor = '';
    }
    var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&requestor=' + requestor;
    if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
        $.ajax({
            type: 'POST',
            url: 'controls/blank.php',
            data: mydata,

            success: function (response) {
                if (response > 0) {
                    window.open("TCPDF-main/examples/blank.php", '_blank');
                } else {
                    toastr.error(`ERROR! Print Failed. Please contact the system Administrator at local 124.`).css("background-color", "#ff5e57")
                }
            }
        });
    } else {
        //show toast
        toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");
    }
})

$('#blank').on('click', () => {
    $('#mrf_modal').modal('show');
});

$('#project_type').on('change', function () {
    var selectedVal = $(this).val();
    $.ajax({
        type: 'POST',
        url: 'controls/get_cip_acc.php',
        data: {
            id: selectedVal
        },
        success: function (response) {
            $('#cip_account').html(response);
        }
    })
})

// < !--USERNAME AUTO GENERATE-- >

$(document).on('blur', '#upd-fname', function (e) {
    e.preventDefault();

    var str = $('#upd-fname').val();
    var fname = str.replace(/\s/g, '');
    var f = fname.toLowerCase();
    var str1 = $('#upd-lname').val();
    var lname = str1.replace(/\s/g, '');
    var l = lname.toLowerCase();
    var uname = f.concat('.').concat(l);
    $('#upd-uname').val(uname);
});
$(document).on('blur', '#upd-lname', function (e) {
    e.preventDefault();

    var str = $('#upd-fname').val();
    var fname = str.replace(/\s/g, '');
    var f = fname.toLowerCase();
    var str1 = $('#upd-lname').val();
    var lname = str1.replace(/\s/g, '');
    var l = lname.toLowerCase();
    var uname = f.concat('.').concat(l);
    $('#upd-uname').val(uname);
});





