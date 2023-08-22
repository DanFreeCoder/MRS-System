<!DOCTYPE html>
<html lang="en">

<head>
    <meta description="Innogroup Innoland System">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>MRS System</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="/" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/innoland.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/mystyle.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="assets/bootstrap@5.3.0/bootstrap.min.css">


    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');



        body {
            font-family: 'Nunito', sans-serif;
            box-sizing: border-box;
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <main>
        <div class="container" style="height:max-content;">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-3">
                                <a href="index.php" class="logo d-flex align-items-center w-auto" style="text-decoration:none;">
                                    <img src="assets/img/innoland.png" alt="">
                                    <h1 class="d-none d-lg-block" style="color:#00b6aa; font-weight:700; font-family: 'Nunito', sans-serif;">MRS</h1>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                        <p class="text-center small">Enter your username & password to login</p>
                                    </div>

                                    <form class="row g-3 needs-validation" id="loginform" novalidate>

                                        <div class="col-12">
                                            <label for="yourUsername" class="form-label">Username</label>
                                            <div class="input-group has-validation">
                                                <input type="text" name="username" class="form-control" id="username" required>
                                                <div class="invalid-feedback">Please enter your username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="yourPassword" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <input type="password" name="password" class="form-control password" id="password" required>
                                                <!-- <span class="input-group-text toggle-password" id="inputGroupPrepend"><a href="#" id="show_pass"><i class="bi bi-eye"></i></a></span> -->
                                                <div class="invalid-feedback">Please enter your password!</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <a href="email_request.php">Forgot Password?</a>
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn w-100 login" id="login" style="background-color: #00b6aa; color:white;">Login</button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a href="register.php">Create an account</a></p>
                                        </div>
                                    </form>


                                </div>
                            </div>



                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <center>
                                                <h6 class="mt-3"> Login Successfully</h6>
                                                <h1 class="mt-2 mb-0"><i class="bi bi-check-circle" style="color:green;"></i></h1>
                                            </center>
                                        </div>
                                        <div align="center">
                                            <button type="button" class="btn btn-success btn-sm m-2 rounded-circle" id="ok">OK</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="credits">
                                <!-- All the links in the footer should remain intact. -->
                                <!-- You can delete the links only if you purchased the pro version. -->
                                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                                <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
                            </div>

                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Bootstrap core JS-->
    <script src="dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/jqueryv3.6.4/jquery.min.js" type="text/javascript"></script>

    <script src="assets/toastr/toastr.min.js"></script>
    <script src="assets/select2/js/select2.min.js"></script>
    <script src="https://www.google.com/recaptcha/enterprise.js?render=6Lfn5U4mAAAAAGlqhcoNylxg9Ct3fABximVjO1xo"></script>
    <script src="includes/js/index.js"></script>
</body>

</html>