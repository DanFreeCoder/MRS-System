<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>ADMINISTRATOR</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../assets/img/innoland.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../admin_assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../admin_assets/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../admin_assets/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link rel="stylesheet" href="../admin_assets/toastr/toastr.min.css">
    <link href="../admin_assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../admin_assets/dist/datatable/dataTables.bootstrap5.min.css">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <?php include 'includes/sidebar.php'; ?>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include 'includes/navbar.php'; ?>
            <!-- Navbar End -->

            <div class="container-fluid pt-2">
                <div class="bg-light rounded p-4">
                    <h6 class="mb-3">Users</h6>
                    <div class="btn btn-success btn-sm mb-2" id="add_user">Add User</div>
                    <div class="table-responsive">
                        <table id="user_table" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col">#</th>
                                    <th scope="col">Fullname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Account Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $result = $users->users();
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row['account_type'] == 3) {
                                        $acc_type = "Staff";
                                    } else {
                                        $acc_type = "Admin";
                                    }
                                    if ($row['status'] != 1) {
                                        $status = "Inactive";
                                    } else {
                                        $status = "Active";
                                    }
                                    echo '
                                        <tr>
                                            <td>' . $row['id'] . '</td>
                                            <td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
                                            <td>' . $row['email'] . '</td>
                                            <td>' . $row['username'] . '</td>
                                            <td>' . $acc_type . '</td>
                                            <td>' . $status . '</td>
                                            <td>
                                            <div class="btn btn-success btn-sm user_editt" value="' . $row['id'] . '">Edit</div>
                                            <div class="btn btn-danger btn-sm user_remove" value="' . $row['id'] . '">Remove</div>
                                            </td>
                                        </tr>
                                        ';
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Modal add user-->
            <div class="modal fade" id="user_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Firstname</label>
                                <input type="text" class="form-control" id="firstname" placeholder="Enter Firstname">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Lastname</label>
                                <input type="text" class="form-control" id="lastname" placeholder="Enter Lastname">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="name@example.com">
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Account Type</label>
                                <select class="form-control" id="account_user_type">
                                    <option value="1">Admin</option>
                                    <option value="3">Staff</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="save_user">Add User</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- edit user modal -->
            <div class="modal fade" id="modal-users" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" id="edit_user_modal">
                            <!-- user edit -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" id="btn_user">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer Start -->
            <?php include 'includes/footer.php'; ?>
            <!-- Footer End -->

            <!-- Back to Top -->
            <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
        </div>
        <!-- Content End -->

    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../admin_assets/lib/chart/chart.min.js"></script>
    <script src="../admin_assets/lib/easing/easing.min.js"></script>
    <script src="../admin_assets/lib/waypoints/waypoints.min.js"></script>
    <script src="../admin_assets/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../admin_assets/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../admin_assets/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../admin_assets/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="../admin_assets/dist/datatable/jquery-3.1.5.js"></script>
    <script src="../admin_assets/dist/datatable/jquery.dataTables.min.js"></script>
    <script src="../admin_assets/dist/datatable/dataTables.bootstrap.min.js"></script>
    <script src="../admin_assets/dist/js/bootstrap-multiselect.js" type="text/javascript"></script>

    <!-- Template Javascript -->
    <script src="../admin_assets/toastr/toastr.min.js"></script>
    <script src="../admin_assets/js/main.js"></script>



</body>

</html>