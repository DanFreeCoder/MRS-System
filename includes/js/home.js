$(document).ready(function () {

    //select two
    $('.select2').select2({
        dropdownParent: $('#mrf_modal')
    });

    function reload(time) {
        setTimeout(function () {
            location.reload();
        }, time);
    }



    $('#admin_side').on('click', function () {
        window.location = "adminpage/dashboard.php?click=" + 'man';
    })
    //delete zero status in item_as_draft table // this is for amdin
    // $.ajax({
    //     type: 'POST',
    //     url: 'controls/delete_zero_status',

    //     success: function (response) {
    //         if (response > 0) {
    //             alert('rows has been remove');
    //         }
    //     }
    // })

    $('.submitted_table').dataTable();
    $('.draft_table').dataTable();


    $('#logout').on('click', function () {
        $('#log_out').modal('show');
    });
    $('#out').on('click', function () {
        window.location = "../mrf/controls/logout.php";
    });
    $('#settings').on('click', function (e) {
        e.preventDefault();
        $('#settingmodal').modal('show');
    });


    //modal update user settings
    $('#save_upd').on('click', function (e) {
        e.preventDefault();
        const password = $('#password').val();
        const retype = $('#retype_password').val();
        const id = $('#upd-id').val();
        const mydata = 'id=' + id + '&password=' + password;
        if (password != '') {
            if (password == retype) {
                $.ajax({
                    type: 'POST',
                    url: 'controls/update-pass.php',
                    data: mydata,
                    success: function (response) {
                        if (response > 0) {
                            $('#settingmodal').modal('toggle')
                            $('#user_current_pass').modal('show')

                            setTimeout(function () {
                                window.location = "../mrf/controls/logout.php";
                            }, 5000);

                        }
                    }
                })
            } else {
                toastr.error(`password is not match`).css("background-color", "#ff5e57");
            }
        } else {
            toastr.error(`All fields are required`).css("background-color", "#ff5e57");
        }
    })

});

// $(document).on('dblclick', '.sub_table tr', function () {
//     var data = table.row(this).data();
//     alert('You clicked on ' + data[0] + "'s row");
// });

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

    var mydata = 'project=' + project + '&project_type=' + project_type + '&classification=' + classification + '&sub_class=' + sub_class + '&cip_account=' + cip_account + '&approver=' + approver;

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



$('#project_type').on('change', () => {
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





