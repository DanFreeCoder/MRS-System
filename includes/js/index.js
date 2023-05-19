$(document).ready(function () {

    var uname = location.search.split('uname=')[1] // get the GET value 
    $('#username').val(uname);

    $('#ok').on('click', () => {
        window.location = "home.php";
    })


    //login
    $('#login').on('click', (e) => {
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();

        var mydata = 'username=' + username + '&password=' + password;
        if (username != '' && password != '') {
            $.ajax({
                type: 'POST',
                url: 'controls/login.php',
                data: mydata,

                success: function (response) {
                    if (response > 0) {
                        $('.modal').modal('show');
                        // window.location = "home.php";
                    } else {
                        toastr.error(`ERROR! Login Failed. Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                    }
                }
            })
        } else {
            toastr.error(`All fields are required`).css("background-color", "#ff5e57");
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