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

            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded p-4">
                    <h6 class="mb-2">Manage Data</h6>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="Project-tab" data-bs-toggle="tab" data-bs-target="#Project" type="button" role="tab" aria-controls="Project" aria-selected="true">Project</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="project_type-tab" data-bs-toggle="tab" data-bs-target="#project_type" type="button" role="tab" aria-controls="project_type" aria-selected="false">Project Type</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="classification-tab" data-bs-toggle="tab" data-bs-target="#classification" type="button" role="tab" aria-controls="classification" aria-selected="false">Classification</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="cip-tab" data-bs-toggle="tab" data-bs-target="#cip" type="button" role="tab" aria-controls="cip" aria-selected="false">CIP Type</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pro-code-tab" data-bs-toggle="tab" data-bs-target="#pro-code" type="button" role="tab" aria-controls="pro-code" aria-selected="false">Project Code</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <!-- project table start -->
                        <div class="tab-pane fade show active" id="Project" role="tabpanel" aria-labelledby="Project-tab">
                            <div class="row mt-4">
                                <div class="col-4">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Project</label>
                                            <input type="text" class="form-control" id="f_project">
                                            <b class="text-danger m-0 p-0" id="pro_restrict" style="font-size:x-small;" hidden>Please fill out this field.</b>
                                        </div>
                                        <div class="btn btn-success btn-sm" id="add_proj">Add</div>
                                        <div class="btn btn-success btn-sm" id="upd_proj">Update</div>
                                        <div class="btn btn-danger btn-sm" id="cancel_proj">Cancel</div>
                                        <input type="text" class="form-control" id="upd_id_project" hidden>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <table id="project_table" class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Project</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $project = $admin_side->projects();
                                            while ($row = $project->fetch(PDO::FETCH_ASSOC)) {
                                                echo '
                                                <tr>
                                                    <td>' . $row['id'] . '</td>
                                                    <td>' . $row['Project'] . '</td>
                                                    <td>
                                                    <div class="btn btn-success btn-sm edit_pro" value="' . $row['id'] . '" >Edit</div>
                                                    <div class="btn btn-danger btn-sm remove_pro" value="' . $row['id'] . '" >Remove</div>
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
                        <!-- project table end -->

                        <!-- Project Type table start -->
                        <div class="tab-pane fade" id="project_type" role="tabpanel" aria-labelledby="project_type-tab">
                            <div class="row mt-4">
                                <div class="col-4">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Project Type</label>
                                            <input type="text" class="form-control" id="f_project_type">
                                            <b class="text-danger m-0 p-0" id="protype_restrict" style="font-size:x-small;" hidden>Please fill out this field.</b>
                                        </div>
                                        <div class="btn btn-success btn-sm" id="add_pro_type">Add</div>
                                        <div class="btn btn-success btn-sm" id="upd_pro_type">Update</div>
                                        <div class="btn btn-danger btn-sm" id="cancel_proj_type">Cancel</div>
                                        <input type="text" class="form-control" id="upd_id_project_type" hidden>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <table id="project_type_table" class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Project Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $project_typess = $admin_side->Project_type();
                                            while ($row = $project_typess->fetch(PDO::FETCH_ASSOC)) {
                                                echo '
                                                <tr>
                                                    <td>' . $row['id'] . '</td>
                                                    <td>' . $row['project_type'] . '</td>
                                                    <td>
                                                    <div class="btn btn-success btn-sm edit_pro_type" value="' . $row['id'] . '" >Edit</div>
                                                    <div class="btn btn-danger btn-sm remove_pro_type" value="' . $row['id'] . '" >Remove</div>
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
                        <!-- Project Type table end -->

                        <!-- Classification table start -->
                        <div class="tab-pane fade" id="classification" role="tabpanel" aria-labelledby="classification-tab">
                            <div class="row mt-4">
                                <div class="col-4">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Item ID</label>
                                            <input type="text" class="form-control" id="f_item_id">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Items</label>
                                            <input type="text" class="form-control" id="f_items">
                                        </div>
                                        <div class="btn btn-success btn-sm" id="add_class">Add</div>
                                        <div class="btn btn-success btn-sm" id="upd_class">Update</div>
                                        <div class="btn btn-danger btn-sm" id="cancel_class">Cancel</div>
                                        <input type="text" class="form-control" id="upd_id_class" hidden>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <table id="classification_table" class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Item ID</th>
                                                <th>Items</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $classificationss = $admin_side->Classification();
                                            while ($row = $classificationss->fetch(PDO::FETCH_ASSOC)) {
                                                echo '
                                                <tr>
                                                    <td>' . $row['id'] . '</td>
                                                    <td>' . $row['class_item_id'] . '</td>
                                                    <td>' . $row['items'] . '</td>
                                                    <td>
                                                    <div class="btn btn-success btn-sm edit_class" value="' . $row['id'] . '" >Edit</div>
                                                    <div class="btn btn-danger btn-sm remove_class" value="' . $row['id'] . '" >Remove</div>
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
                        <!-- Classification table end -->

                        <!-- CIP table start -->
                        <div class="tab-pane fade" id="cip" role="tabpanel" aria-labelledby="cip-tab">
                            <div class="row mt-4">
                                <div class="col-4">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">CIP ID</label>
                                            <input type="number" class="form-control" id="f_cip_id">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">CIP Account</label>
                                            <input type="text" class="form-control" id="f_cip_account">
                                        </div>
                                        <div class="btn btn-success btn-sm" id="add_cip">Add</div>
                                        <div class="btn btn-success btn-sm" id="upd_cip">Update</div>
                                        <div class="btn btn-danger btn-sm" id="cancel_cip">Cancel</div>
                                        <input type="text" class="form-control" id="upd_id_cip" hidden>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <table id="cip_type_table" class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>CIP ID</th>
                                                <th>CIP Account</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $cip_types = $admin_side->CIP_types();
                                            while ($row = $cip_types->fetch(PDO::FETCH_ASSOC)) {
                                                echo '
                                                <tr>
                                                    <td>' . $row['id'] . '</td>
                                                    <td>' . $row['cip_id'] . '</td>
                                                    <td>' . $row['cip_account'] . '</td>
                                                    <td>
                                                    <div class="btn btn-success btn-sm edit_cip" value="' . $row['id'] . '" >Edit</div>
                                                    <div class="btn btn-danger btn-sm remove_cip" value="' . $row['id'] . '" >Remove</div>
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
                        <!-- CIP table end -->

                        <!-- Project Code start -->
                        <div class="tab-pane fade" id="pro-code" role="tabpanel" aria-labelledby="pro-code-tab">
                            <div class="row mt-4">
                                <div class="col-4">
                                    <form>
                                        <div class="mb-3">
                                            <label class="form-label">Project Code</label>
                                            <input type="text" class="form-control" id="f_pro_code">
                                            <b class="text-danger m-0 p-0" id="procode_restrict" style="font-size:x-small;" hidden>Please fill out this field.</b>
                                        </div>
                                        <div class="btn btn-success btn-sm" id="add_code">Add</div>
                                        <div class="btn btn-success btn-sm" id="upd_code">Update</div>
                                        <div class="btn btn-danger btn-sm" id="cancel_code">Cancel</div>
                                        <input type="text" class="form-control" id="upd_id_code" hidden>
                                    </form>
                                </div>
                                <div class="col-8">
                                    <table id="pro_code_table" class="table text-start align-middle table-bordered table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Project Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $project_codes = $admin_side->project_code();
                                            while ($row = $project_codes->fetch(PDO::FETCH_ASSOC)) {
                                                echo '
                                                <tr>
                                                    <td>' . $row['id'] . '</td>
                                                    <td>' . $row['proj_code'] . '</td>
                                                    <td>
                                                    <div class="btn btn-success btn-sm edit_code" value="' . $row['id'] . '" >Edit</div>
                                                    <div class="btn btn-danger btn-sm remove_code" value="' . $row['id'] . '" >Remove</div>
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
                        <!-- Project Code end -->
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