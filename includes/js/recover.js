$(document).ready(function () {

    $('#recover').on('click', function (e) {
        e.preventDefault();
        var email = $('#email').val();
        if (email != '') {
            $.ajax({
                type: 'POST',
                url: 'controls/recover.php',
                data: {
                    email: email
                },
                success: function (response) {
                    if (response > 0) {
                        $('#email_sent').modal('show');
                    } else {
                        toastr.error(`ERROR! Email request failed. Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                    }
                }
            })
        } else {
            toastr.error(`Enter your email`).css("background-color", "#ff5e57");
        }

    })

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