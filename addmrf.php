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
    <link rel="stylesheet" href="assets/toastr/toastr.min.css">
    <link rel="stylesheet" href="assets/select2/css/select2.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            box-sizing: border-box;
            font-weight: 500;
        }

        a {
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>

<body style="background-color: #f1f1f3;">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <!-- hide sidebar -->

        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php include 'includes/navigation.php'; ?>

            <div class="container" style="margin-top: 100px;">
                <div class="content1 p-3 mt-2" style="background-color:#f9f9fb; border-radius:5px; box-shadow: 5px 5px 5px 5px #888888;">
                    <center>
                        <h3 class="mb-5">Material Requisition Slip</h3>
                    </center>
                    <br>
                    <div class="row">
                        <div class="col-4 mb-2">
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
                        <div class="col-4 mb-2">
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
                        <div class="col-4 mb-2">
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
                        <div class="col-4 mb-2">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">Sub-Classification</div>
                            <input type="text" class="form-control text-secondary" id="sub_class" placeholder="Enter  Sub-Classification">
                        </div>
                        <div class="col-5 mb-3">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">CIP Account <span style="color:red;">*</span></div>
                            <select type="text" id="cip_account" class="select2 form-control js-example-basic-single" style="width: 100%;">
                                <option value="0" selected disabled>No project type selected</option>
                            </select>
                        </div>
                        <div class="col-3 mb-2">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">Approver <span style="color:red;">*</span></div>
                            <input type="text" class="form-control text-secondary" id="approver" placeholder="Enter Approver">
                        </div>
                    </div>
                </div>
            </div>

            <!-- sub main -->
            <div class="container-fluid mb-5">
                <div class="sub-main mt-5 p-3 mb-5" style="background-color:#f9f9fb; border-radius:5px; box-shadow: 5px 5px 5px 5px #888888;">
                    <div class="row">
                        <center class="mb-3">
                            <h3>Item Descriptions</h3>
                        </center>
                        <form action="" method="post">
                            <br> <br>
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white table-hover">
                                    <thead>
                                        <th style="width: 1rem;">
                                            Quantity
                                        </th>
                                        <th style="width: 5rem;">
                                            UOM
                                        </th>
                                        <th style="width: 7rem;">
                                            Item Code
                                        </th>
                                        <th style="width: 14rem;">
                                            Descriptions
                                        </th>
                                        <th style="width: 8rem;">
                                            Remarks
                                        </th>
                                        <th style="width: 5px;">Action</th>
                                    </thead>
                                    <tbody>
                                        <tr id="row">
                                            <td contenteditable class="editable-cell qty"></td>
                                            <td contenteditable class="editable-cell oum"></td>
                                            <td contenteditable class="editable-cell code"></td>
                                            <td contenteditable class="editable-cell desc"></td>
                                            <td contenteditable class="editable-cell remark"></td>
                                            <td><button type="button" id="addrow" style="border-radius:100%; background-color:#5eb548; color:white; border:none;"><i class="bi bi-plus"></i></button></td>
                                        </tr>
                                        <tr id="row">
                                            <td contenteditable class="editable-cell qty"></td>
                                            <td contenteditable class="editable-cell oum"></td>
                                            <td contenteditable class="editable-cell code"></td>
                                            <td contenteditable class="editable-cell desc"></td>
                                            <td contenteditable class="editable-cell remark"></td>
                                        </tr>
                                        <tr id="row">
                                            <td contenteditable class="editable-cell qty"></td>
                                            <td contenteditable class="editable-cell"></td>
                                            <td contenteditable class="editable-cell code"></td>
                                            <td contenteditable class="editable-cell desc"></td>
                                            <td contenteditable class="editable-cell remark"></td>
                                        </tr>
                                        <tr id="row">
                                            <td contenteditable class="editable-cell qty"></td>
                                            <td contenteditable class="editable-cell oum"></td>
                                            <td contenteditable class="editable-cell code"></td>
                                            <td contenteditable class="editable-cell desc"></td>
                                            <td contenteditable class="editable-cell remark"></td>
                                        </tr>
                                        <tr id="row">
                                            <td contenteditable class="editable-cell qty"></td>
                                            <td contenteditable class="editable-cell oum"></td>
                                            <td contenteditable class="editable-cell code"></td>
                                            <td contenteditable class="editable-cell desc"></td>
                                            <td contenteditable class="editable-cell remark"></td>
                                        </tr>
                                    </tbody>
                                </table>
                        </form>
                    </div>
                </div>
                <br>
                <a class="p-2 w-15 border-0 bg-success text-light" id="generate" name="generate" style=" border:none;"><b><i class="bi bi-check-lg text-light"></i> Generate</b></a>
                <a class="p-2 w-15 mt-5 draft bg-secondary text-light" style="border:none;"><b><i class="bi bi-clipboard-check text-light"></i> Save as Draft</b></a>
                <a class="p-2 w-15 text-light bg-success mb-3 p-2 w-25" id="clear"><b><i class="bi bi-eraser"></i> Clear</b></a>
            </div>

        </div>
    </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/jqueryv3.6.4/jquery.min.js"></script>

    <script src="assets/toastr/toastr.min.js"></script>
    <script src="assets/select2/js/select2.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="includes/js/addmrf.js"></script>

</body>

</html>