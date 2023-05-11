<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MRS System</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/img/innoland.png" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/mystyle.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/toastr/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/datatable/dataTables.bootstrap5.min.css">
</head>

<body style="background-color: #f1f1f3; padding-top:20px;">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <!-- hide sidebar -->

        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php include 'includes/navigation.php'; ?>
            <div style="margin-top: 100px; width:100%;">
                <!-- tab container -->
                <div class="card p-3" style="background-color:#f8f9fa;">
                    <div>
                        <button class="btn btn-outline-success p-0"><a class="nav-link p-2" href="addmrf.php"><b>New</b></a></button>
                        <button class="btn btn-outline-secondary p-2" id="blank" name="blank"><b>Print as Blank</b></button>
                    </div>
                    <hr class="m-1">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="submitted-tab" data-bs-toggle="tab" data-bs-target="#submitted_tab" type="button" role="tab" aria-controls="submitted" aria-selected="true">Submitted Form</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="draft-tab" data-bs-toggle="tab" data-bs-target="#draft_tab" type="button" role="tab" aria-controls="draft" aria-selected="false">Draft Form</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="submitted_tab" role="tabpanel" aria-labelledby="home-tab">
                            <div class="table-responsive">
                                <table class="table sub_table table-hover submitted_table" style="background-color:#f8f9fa;" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date Added</th>
                                            <th>Project</th>
                                            <th>
                                                <center>Type of Project</center>
                                            </th>
                                            <th>
                                                <center>Classification</center>
                                            </th>
                                            <th>
                                                <center>Sub-Classification</center>
                                            </th>
                                            <th>
                                                <center>CIP Account</center>
                                            </th>
                                            <th>
                                                <center>Control No.</center>
                                            </th>
                                            <th>
                                                <center>Item Descriptions</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="submitted-body">
                                        <?php
                                        $submitted = $tbl_details->submitted_data();
                                        while ($row = $submitted->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                            <tr>
                                            <td>' . $row['date_added'] . '</td>
                                            <td>' . $row['Project'] . '</td>
                                            <td>' . $row['project_type'] . '</td>
                                            <td>' . $row['classif'] . '</td>
                                            <td>' . $row['sub_class'] . '</td>
                                            <td>' . $row['cip_name'] . '</td>
                                            <td>' . $row['con_num'] . '</td>
                                            <td><a href="#" value="' . $row['id'] . '" class="views" >View</a> | <a href="#" value="' . $row['id'] . '" class="print" >Print</a></td>
                                            </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div><!-- end of submitted form -->
                        </div>
                        <div class="tab-pane fade" id="draft_tab" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="table-responsive">
                                <table class="table table-hover draft_table" style="width: 100%; background-color:#f8f9fa;" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Date Added</th>
                                            <th>Project</th>
                                            <th>
                                                <center>Type of Project</center>
                                            </th>
                                            <th>
                                                <center>Classification</center>
                                            </th>
                                            <th>
                                                <center>Sub-Classification</center>
                                            </th>
                                            <th>
                                                <center>CIP Account</center>
                                            </th>
                                            <th>
                                                <center>Item Descriptions</center>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="draft-body">
                                        <?php
                                        $drafted = $tbl_details->drafted_data();
                                        while ($row = $drafted->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                            <tr>
                                            <td>' . $row['date_added'] . '</td>
                                            <td>' . $row['Project'] . '</td>
                                            <td>' . $row['project_type'] . '</td>
                                            <td>' . $row['classif'] . '</td>
                                            <td>' . $row['sub_class'] . '</td>
                                            <td>' . $row['cip_name'] . '</td>
                                            <td><a href="draft.php?id=' . $row['id'] . '" class="edit" style="color:green;"><i class="bi bi-pencil-square"></i>Edit</a></td> 
                                            </tr>
                                            ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Quantity</th>
                                    <th>UOM</th>
                                    <th>Item Code</th>
                                    <th>Description</th>
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

        <!-- Modal -->
        <div class="modal" id="mrf_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Item Descriptions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div>
                                <div class="label">Project <span style="color:red;">*</span></div>
                                <select type="text" id="project" class="select2 form-control js-example-basic-single" style="width: 100%;">
                                    <option class="form-control" value="0" selected disabled>Please select project</option>
                                    <?php
                                    $getpro = $projects->projects();
                                    while ($row = $getpro->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                    <option  value="' . $row['id'] . '">' . $row['Project'] . '</option>
                                    ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <div class="label mb-1">Type of Project <span style="color:red;">*</span></div>
                                <select type="text" id="project_type" class="select2 form-control js-example-basic-single" style="width: 100%;">
                                    <option value="0" selected disabled>Please select type of project</option>
                                    <?php
                                    $get = $project_type->get_type_of_project();
                                    while ($row2 = $get->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                            <option value="' . $row2['id'] . '">' . $row2['project_type'] . '</option>
                                            ';
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                                <div class="label">Classification <span style="color:red;">*</span></div>
                                <select type="text" id="classification" class="select2 form-control js-example-basic-single" style="width: 100%;">
                                    <option value="0" selected disabled>Please select Classification</option>
                                    <?php
                                    $get_class = $classification->get_class();

                                    while ($rowc = $get_class->fetch(PDO::FETCH_ASSOC)) {
                                        echo '
                                    <option  value="' . $rowc['class_item_id'] . '">' . $rowc['class_item_id'] . '-' . $rowc['items'] . '</option>
                                    ';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                                <div class="label">Sub-Classification <span style="color:red;">*</span></div>
                                <input type="email" class="form-control" id="sub_class" placeholder="Enter  Sub-Classification">
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <div class="label">Approver <span style="color:red;">*</span></div>
                                <input type="email" class="form-control" id="approver" placeholder="Enter  Approver">
                            </div>
                        </div>
                        <div class="row">
                            <div>
                                <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                                <div class="label">CIP Account <span style="color:red;">*</span></div>
                                <select type="text" id="cip_account" class="select2 form-control js-example-basic-single" style="width: 100%;">
                                    <option value="0" selected disabled>No project type selected</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="print_as_blank">Print</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>


    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="dist/datatable/jquery-3.1.5.js"></script>
    <script src="dist/datatable/jquery.dataTables.min.js"></script>
    <script src="dist/datatable/dataTables.bootstrap.min.js"></script>
    <script src="dist/js/bootstrap-multiselect.js" type="text/javascript"></script>


    <script src="assets/toastr/toastr.min.js"></script>
    <script src="assets/select2/js/select2.min.js"></script>
    <script src="includes/js/home.js"></script>
    <!-- Core theme JS-->
</body>

</html>