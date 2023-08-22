$(document).ready(function () {

    $('#change_pass').on('click', function () {
        var password = $('#upd_pass').val();
        var retype = $('#retype_pass').val();
        var id = location.search.split('id=')[1] // get the GET value 

        var mydata = 'password=' + password + '&id=' + id;
        if (password != '') {
            if (password == retype) {
                $.ajax({
                    type: 'POST',
                    url: 'controls/change_pass.php',
                    data: mydata,
                    success: function (response) {
                        if (response > 0) {
                            toastr.success(`Your account's password has been successfully changed.`).css("background-color", "#05c46b");
                        } else {
                            toastr.error(`ERROR! Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                        }
                    }
                });
            } else {
                toastr.error(`password is not match`).css("background-color", "#ff5e57");
            }
        } else {
            toastr.error(`All fields are required`).css("background-color", "#ff5e57");
        }
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
});



