$(document).ready(() => {
    // disable all table row except remark column
    $(document).find('#table td:not(.remark)').attr('contenteditable', false);

    //update remarks
    $('#update').on('click', () => {
        const data = [];
        var length = $('.table tbody tr').length;
        for (var i = 0; i < length; i++) {
            var remark = $('#rem-' + i).text();
            const id = $('#id2-' + i).text()
            data.push({
                id: id,
                remarks: remark
            })
        }
        $.ajax({
            type: 'POST',
            url: 'controls/update_remarks.php',
            data: {
                data: JSON.stringify(data)
            },
            success: function (res) {
                if (res > 0) alert('Update Successfully');
            }
        })

    });

});//end of document ready


// header functions
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
}); //end of header functions
