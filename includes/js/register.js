$(document).ready(function () {



    $('#create').on('click', (e) => {
        e.preventDefault();
        var myStr = $('#email').val();
        var last = myStr.substring(myStr.lastIndexOf("@") + 1);
        if (last === 'innogroup.com.ph' || last === 'induco.com.ph' || last === 'citrineland.com.ph' || last === 'innoland.com.ph' || last === 'innoprime.com.ph') {

            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var username = $('#uname').val();
            var email = $('#email').val();
            // var uname = $('#uname').val();

            var mydata = 'fname=' + fname + '&lname=' + lname + '&username=' + username + '&email=' + email;
            if (fname != '' && lname != '' && email != '') {
                $.ajax({
                    type: 'POST',
                    url: 'controls/register.php',
                    data: mydata,

                    success: function (response) {

                        if (response > 0) {
                            $('.modal').modal('show');
                            var cred = 'firstname=' + fname + '&lastname=' + lname + '&email=' + email;
                            $.ajax({
                                type: 'POST',
                                url: 'controls/regEmail.php',
                                data: cred,
                                success: function (response) {

                                }
                            })
                        } else {
                            toastr.error(`ERROR! Registration Failed. Please get in touch with the system administrator at local number 124.`).css("background-color", "#ff5e57");
                        }
                    }
                })
            } else {
                toastr.error(`All field are required.`).css("background-color", "#ff5e57");
            }
        } else {
            toastr.error(`Invalid email address.`).css("background-color", "#ff5e57");
        }

    })
});

$('#ok').on('click', function () {
    window.location = "index.php";
})



// < !--USERNAME AUTO GENERATE-- >

$('#fname').blur(function (e) {
    e.preventDefault();

    var str = $('#fname').val();
    var fname = str.replace(/\s/g, '');
    var f = fname.toLowerCase();
    var str1 = $('#lname').val();
    var lname = str1.replace(/\s/g, '');
    var l = lname.toLowerCase();
    var uname = f.concat('.').concat(l);
    $('#uname').val(uname);
})
$('#lname').blur(function (e) {
    e.preventDefault();

    var str = $('#fname').val();
    var fname = str.replace(/\s/g, '');
    var f = fname.toLowerCase();
    var str1 = $('#lname').val();
    var lname = str1.replace(/\s/g, '');
    var l = lname.toLowerCase();
    var uname = f.concat('.').concat(l);
    $('#uname').val(uname);
})


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