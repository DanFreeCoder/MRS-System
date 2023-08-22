$(document).ready(function () {

    $('.select2').select2();
    //server-side select2
    $('#findcode').select2({
        placeholder: 'Search for data...',
        minimumInputLength: 2,
        ajax: {
            url: 'controls/search_code.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#finddesc').select2({
        placeholder: 'Search for data...',
        minimumInputLength: 2,
        ajax: {
            url: 'controls/search_desc.php',
            dataType: 'json',
            delay: 250,
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    ItemDescGenerator();
    ItemcodeGenerator();
    //resctrict &
    restrictSpecialChar();

    if ($('#requestor').val() != '') {
        $('#checkbox').attr('checked', true);
        $('#requestor').show();
    } else {
        $('#checkbox').attr('checked', false);
        $('#requestor').hide();
    }
    //requestor
    $('#checkbox').on('click', function () {
        if ($(this).is(':checked')) {
            $('#requestor').show();
        } else {
            $('#requestor').hide();
        }
    })
    function reload(duration) {
        setTimeout(function () {
            location.reload();
        }, duration)
    }

    $('#admin_side').on('click', () => window.location = "adminpage/dashboard.php?click=" + 'man');
    $('#logout').on('click', () => $('#log_out').modal('show'));
    $('#out').on('click', () => window.location = "../mrs/controls/logout.php");
    $('#clear').on('click', () => $('.editable-cell').text(''));

    $('#settings').on('click', (e) => {
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
                            $('#settingmodal').modal('toggle');
                            $('#user_current_pass').modal('show');
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

    $('.remove').on('click', function () {
        var drafted_id = $(this).attr('value');
        $.ajax({
            type: 'POST',
            url: 'controls/remove_draft.php',
            data: {
                id: drafted_id
            },
            success: function (response) {
                if (response > 0) {
                    toastr.info(`Remove Successfully`).css("background-color", "#67e6dc");
                    reload(2000);
                }
            }
        })
    });

    $('.generate').hide();
    $('.draft').hide();
    $('.upd_gen').hide();
    $('.draft_as_draft').hide();
    $('#clear').hide();

    $('#addrow').on('click', function () {
        $('.generate').show();
        $('.update').hide();
        $('.upd_gen').show();
        $('.draft').hide();
        $('.draft_as_draft').show();
    })

    //add row
    var num_row = $('table tbody tr').length;
    $('#num_row').text(num_row);
    //var count = 1;
    $('#addrow').on('click', function () {
        num_row = num_row += 1;
        $('#action').attr('hidden', false);
        //  count = count + 1;
        var html = `<tr id="row${num_row}" ${num_row}>`;
        html += `
            <td contenteditable class="editable-cell qty" name="qty" id="qty-${num_row - 1}"></td>
            <td contenteditable class="editable-cell oum" id="uom-${num_row - 1}"></td>
            <td contenteditable class="editable-cell code" id="cod-${num_row - 1}"></td>
            <td contenteditable class="editable-cell desc" id="des-${num_row - 1}"></td>
            <td contenteditable class="editable-cell remark" id="rem-${num_row - 1}"></td>
            <td style="width:2px; margin-right:0px;"><div class="removes btn btn-danger btn-sm" id="remove" data-row="row${num_row}" style="border-radius:100%; border:none;"><i class="bi bi-x"></i></div></td>
            `;
        html += `</tr>`;
        $('table tbody').append(html);
        $('#num_row').text(num_row);
        if (num_row == 20) {
            $(this).css("background-color", "red");
            $(this).attr('disabled', true);
        } else {
            $(this).attr('disabled', false);
            $('#num_row').text(num_row);
            $(this).css("background-color", "#5eb548");
        }
    });


    //remove row
    $(document).on('click', '.removes', function () {
        var delete_row = $(this).data('row');
        $('#' + delete_row).remove();
        var len = $('table tbody tr').length;
        if (len < 6) {
            $('.update').hide();
            $('.generate').show();
            $('.draft').show();
            $('#clear').show();
            $('#upd_gen').hide();
            $('.draft_as_draft').hide();
            $('#action').attr('hidden', true);
        }
        num_row = num_row -= 1;
        $('#num_row').text(num_row);
        if (num_row < 20) {
            $('#addrow').css("background-color", "#5eb548");
            $('#addrow').attr('disabled', false);
        }
    });

    //save as draft
    $(document).on('click', '.draft', function () {
        var id = $('#id').val();
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
        var data = [];

        var length = $('.table tbody tr').length;
        for (var i = 0; i < length; i++) {
            var id2 = $('#id2-' + i).text();
            var qty = $('#qty-' + i).text();
            var uom = $('#uom-' + i).text();
            var code = $('#cod-' + i).text();
            var desc = $('#des-' + i).text();
            var remark = $('#rem-' + i).text();

            // Check if any field in the row is empty except for rows that lack data
            if (qty == '' && uom == '' && code == '' && desc == '') {
                continue; // Skip the current row if all fields are empty
            } else {
                data.push({
                    'id2': id2,
                    'qty': qty,
                    'uom': uom,
                    'code': code,
                    'desc': desc,
                    'remark': remark
                });
            }

        }
        var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&requestor=' + requestor + '&data=' + JSON.stringify(data) + '&id=' + id;

        if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
            $.ajax({
                type: 'POST',
                url: 'controls/save_draft_as_draft.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        $('#modal_save_as_draft').modal('show');
                    } else {
                        toastr.error(`ERROR! Save as draft Failed. Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                    }
                },
                error: function (xhr, status, error) {
                    alert(xhr);
                    alert(status);
                    alert(error);
                }
            });
        } else {
            //show toast
            toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");
        }
    });

    //modal save as draft
    $(document).on('click', '#ok_save_as_draft', () => window.location = "home.php");

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

}); //end of document


$('.update').on('click', function () {
    var id = $('#id').val();
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
    var data = [];
    var length = $('.table tbody tr').length;
    for (var i = 0; i < length; i++) {
        var id2 = $('#id2-' + i).text();
        var qty = $('#qty-' + i).text();
        var uom = $('#uom-' + i).text();
        var code = $('#cod-' + i).text();
        var desc = $('#des-' + i).text();
        var remark = $('#rem-' + i).text();

        // Check if any field in the row is empty except for rows that lack data
        if (qty == '' && uom == '' && code == '' && desc == '') {
            continue; // Skip the current row if all fields are empty
        } else {
            data.push({
                'id2': id2,
                'qty': qty,
                'uom': uom,
                'code': code,
                'desc': desc,
                'remark': remark
            });
        }
    }
    console.log(data)
    var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&requestor=' + requestor + '&data=' + JSON.stringify(data) + '&id=' + id;

    if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
        $.ajax({
            type: 'POST',
            url: 'controls/update.php',
            data: mydata,
            success: function (response) {
                console.log(response)
                if (response > 0) {
                    toastr.success(`Update Successfullly`).css("background-color", "#05c46b");
                }
                $('.update').hide();
                $('.generate').show();
                $('.draft').show();
                $('#clear').show();
            },
            error: function (xhr, status, error) {
                alert(xhr);
                alert(status);
                alert(error);
            }
        });
    } else {
        //show toast
        alert('Fields with asterisks(*) are required');
    }
});
//save to print
$('.generate').on('click', function () {
    var id = $('#id').val();
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
    var data = [];
    var isDataValid = true;
    var length = $(document).find('table tbody td[name=qty]').length;
    for (var i = 0; i < length + 1; i++) {
        var id2 = $('#id2-' + i).text();
        var qty = $('#qty-' + i).text();
        var uom = $('#uom-' + i).text();
        var code = $('#cod-' + i).text();
        var desc = $('#des-' + i).text();
        var remark = $('#rem-' + i).text();

        // Check if any field in the row is empty except for rows that lack data
        if (qty === '' && uom === '' && code === '' && desc === '') {
            continue; // Skip the current row if all fields are empty
        } else if (qty === '' || uom === '' || code === '' || desc === '') {
            isDataValid = false; // Set isDataValid to false if any incomplete row is found
            break; // Exit the loop if any incomplete row is found
        }
        data.push({
            'id2': id2,
            'qty': qty,
            'uom': uom,
            'code': code,
            'desc': desc,
            'remark': remark
        });
    }
    console.log(data);
    if (isDataValid) {
        var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&requestor=' + requestor + '&data=' + JSON.stringify(data) + '&id=' + id;
        if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
            if (data.length > 0) {
                exe_generate(mydata)
            } else {
                toastr.error(`Please input item descriptions`).css("background-color", "#ff5e57");
            }
        } else {
            //show toast
            toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");
        }
    } else {
        toastr.error('Please fill out the required fields.').css("background-color", "#ff5e57");
    }
});
exe_generate = (mydata) => {
    $.ajax({
        type: 'POST',
        url: 'controls/generate.php',
        data: mydata,
        success: function (response) {
            if (response > 0) {
                window.open("TCPDF-main/examples/MRF_report.php", '_blank');
            } else {
                toastr.error(`ERROR! Generate Failed.  Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
            }
        },
        error: function (xhr, status, error) {
            alert(xhr);
            alert(status);
            alert(error);
        }
    });
}

//draft as draft
$('.draft_as_draft').on('click', function () {
    var id = $('#id').val();
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
    var data = [];

    var length = $('.table tbody tr').length;
    for (var i = 0; i < length; i++) {
        var id2 = $('#id2-' + i).text();
        var qty = $('#qty-' + i).text();
        var uom = $('#uom-' + i).text();
        var code = $('#cod-' + i).text();
        var desc = $('#des-' + i).text();
        var remark = $('#rem-' + i).text();

        // Check if any field in the row is empty except for rows that lack data
        if (qty == '' && uom == '' && code == '' && desc == '') {
            continue; // Skip the current row if all fields are empty
        } else {
            data.push({
                'id2': id2,
                'qty': qty,
                'uom': uom,
                'code': code,
                'desc': desc,
                'remark': remark
            });
        }
    }
    console.log(data)
    var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver + '&requestor=' + requestor + '&data=' + JSON.stringify(data) + '&id=' + id;

    if (project != '' && project_type != '' && classification != '' && cip_account != '' && approver != '') {
        $.ajax({
            type: 'POST',
            url: 'controls/save_draft_as_draft.php',
            data: mydata,
            success: function (response) {
                if (response > 0) {
                    $('#modal_draft').modal('show');
                }
            },
            error: function (xhr, status, error) {
                alert(xhr);
                alert(status);
                alert(error);
            }
        });
    } else {
        //show toast
        toastr.error(`Fields with asterisks(*) are required`).css("background-color", "#ff5e57");
    }
})

$('#ok_draft_as_draft').on('click', () => window.location = "home.php");

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

toastr.options = {
    "closeButton": true,
    "debug": false,
    "newestOnTop": true,
    "progressBar": false,
    "positionClass": "toast-top-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "1000",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}