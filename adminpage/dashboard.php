<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
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



            <!-- Submitted form Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded p-4">
                    <h6 class="mb-3">Submitted Form</h6>
                    <div class="btn-group mb-2 gap-1">
                        <a href="../addmrf.php">
                            <div class="btn btn-primary btn-sm">Add Request</div>
                        </a>
                        <div class="btn btn-danger btn-sm" id="remove">Remove Form</div>
                    </div>
                    <div class="table-responsive">
                        <table id="sub_table" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark">
                                    <th scope="col"><input type="checkbox" class="form-check-input" id="check_all"></th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Project</th>
                                    <th scope="col">Type of Project</th>
                                    <th scope="col">Classification</th>
                                    <th scope="col">Sub-Classification</th>
                                    <th scope="col">CIP Account</th>
                                    <th scope="col">Control#</th>
                                    <th scope="col">Submitted By</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $form = $submitted->submitted_form();
                                while ($row = $form->fetch(PDO::FETCH_ASSOC)) {
                                    echo '
                                    <tr>
                                    <td><input type="checkbox" name="form_sub" class="form-check-input" value="' . $row['id'] . '"></td>
                                    <td>' . $row['date_added'] . '</td>
                                    <td>' . $row['Project'] . '</td>
                                    <td>' . $row['project_type'] . '</td>
                                    <td>' . $row['classif'] . '</td>
                                    <td>' . $row['sub_class'] . '</td>
                                    <td>' . $row['cip_name'] . '</td>
                                    <td>' . $row['con_num'] . '</td>
                                    <td>' . $row['user'] . '</td>
                                    <td>
                                    <a href="../edit_form.php?user_id=' . $row['user_id'] . '&&' . 'id=' . $row['id'] . '" class="edit_form text-success" style="text-decoration:underline;" value="' . $row['id'] . '">Edit</a>
                                    <a href="#" class="detail text-primary" style="text-decoration:underline;" value="' . $row['id'] . '">Detail</a>
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

            <!-- Modal -->
            <div class="modal" id="view_item" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Item Descriptions</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table text-start align-middle table-bordered table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Quantity</th>
                                        <th>OUM</th>
                                        <th>Item Code</th>
                                        <th>Brand</th>
                                        <th>Description</th>
                                        <th>Specs</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody id="item-body">
                                    <!-- data goes here     -->
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-success"><i class="bi bi-pencil-square"></i> Edit</button> -->
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