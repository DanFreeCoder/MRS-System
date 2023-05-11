<?php
include 'config/connection.php';
include 'objects/clscip.class.php';
include 'objects/clsdraft.class.php';
include 'objects/clsitem_desc.class.php';
include 'objects/clsadmin_side.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();
$project_type = new clsType($db);
$projects = new clsType($db);
$classification = new clsType($db);
$generate_item = new clsType($db);
$view_draft = new cls_draft($db);
$view_pro_type_draft = new cls_draft($db);
$view_classication_draft = new cls_draft($db);
$view_CIP_account_type_draft = new cls_draft($db);
$view_description_draft = new cls_draft($db);
$view_sub_class_draft = new cls_draft($db);
$tbl_details = new clsitem_descriptions($db);
$admin_side = new admin_side($db);
$CIP_type = new clsType($db);


?>

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
</head>

<body style="background-color: #f1f1f3; padding:20px;">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <!-- hide sidebar -->

        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <a href="adminpage/dashboard.php">
                <div class="btn btn-secondary">Back</div>
            </a>
            <div class="container" style="margin-top: 100px;">
                <div class="content1 p-3 mt-2" style="background-color:#f9f9fb; border-radius:5px; ">

                    <?php
                    $admin_side->id = $_GET['id'];
                    $data = $admin_side->data();
                    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
                        $project_d = $row['Project'];
                        $project_type_d = $row['project_type'];
                        $classif_d = $row['classif'];
                        $sub_class_d = $row['sub_class'];
                        $cip_name_d = $row['cip_name'];
                        $user_id = $row['user_id'];
                    }
                    ?>
                    <center>
                        <h3 class="mb-5">Material Requisition Form</h3>
                        <input type="text" id="get_id" value="<?php $_GET['id']; ?>" hidden>
                    </center>
                    <div class="row">
                        <div class="col-4 mb-2">
                            <div class="label">Project <span style="color:red;">*</span></div>
                            <select type="text" id="project" class="select2 form-control js-example-basic-single" style="width: 100%;">
                                <option selected><?php echo $project_d ?></option>
                                <?php
                                $getpro = $projects->projects();
                                while ($row = $getpro->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option  value="' . $row['id'] . '">' . $row['Project'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 mb-2">
                            <div class="label mb-1">Type of Project <span style="color:red;">*</span></div>
                            <select type="text" id="project_type" class="select2 form-control js-example-basic-single" style="width: 100%">
                                <option selected><?php echo $project_type_d ?></option>
                                <?php
                                $get = $project_type->get_type_of_project();
                                while ($row2 = $get->fetch(PDO::FETCH_ASSOC)) {
                                    echo '<option value="' . $row2['id'] . '">' . $row2['project_type'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 mb-2">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">Classification <span style="color:red;">*</span></div>
                            <select type="text" id="classification" class="select2 form-control js-example-basic-single" style="width: 100%;">
                                <option selected><?php echo $classif_d ?></option>
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
                            <div class="label">Sub-Classification <span style="color:red;">*</span></div>
                            <input type="text" id="sub_class" value="<?php echo $sub_class_d ?>" class="form-control">


                            <!-- <input type="text" id="id" value="<?php echo $id; ?>" hidden> -->
                        </div>
                        <div class="col-5 mb-3">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">CIP Account <span style="color:red;">*</span></div>
                            <select type="text" id="cip_account" class="select2 form-control js-example-basic-single" style="width: 100%;">
                                <option selected><?php echo $cip_name_d ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- sub main -->
            <div class="container-fluid mb-5">
                <div class="sub-main mt-5 p-5 mb-5" style="background-color:#f9f9fb; border-radius:5px;">
                    <div class="row">
                        <center class="mb-3">
                            <h3>Item Descriptions</h3>
                        </center>
                        <form action="" method="post">
                            <div class="table-responsive">
                                <button type="button" id="addrow" style="border-radius:100%; background-color:#5eb548; color:white; border:none;"><i class="bi bi-plus"></i></button>
                                <div class="btn btn-info btn-sm mb-2 p-1" id="clear">Clear</div>
                                <table class="table table-bordered bg-white table-hover">
                                    <thead>
                                        <th style="width: 1rem;" hidden>
                                            #
                                        </th>
                                        <th style="width: 1rem;">
                                            Quantity
                                        </th>
                                        <th style="width: 5rem;">
                                            OUM
                                        </th>
                                        <th style="width: 7rem;">
                                            Item Code
                                        </th>
                                        <th style="width: 14rem;">
                                            Description
                                        </th>
                                        <th style="width: 8rem;">
                                            Remarks
                                        </th>
                                        <!-- <th style="width: 5px;"><i class="bi bi-arrows-move"></i></th> -->
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tbl_details->item_id = $_GET['id'];
                                        $tbl_details->user_id = $_GET['user_id'];
                                        $get_desc = $tbl_details->view_item_desc_by_id();
                                        while ($view_desc = $get_desc->fetch(PDO::FETCH_ASSOC)) {
                                            echo '
                                                <tr id="row">
                                                <td class="editable-cell" hidden>' . $view_desc['id'] . '</td>
                                                <td contenteditable class="editable-cell qty">' . $view_desc['qty'] . '</td>
                                                <td contenteditable class="editable-cell">' . $view_desc['oum'] . '</td>
                                                <td contenteditable class="editable-cell code">' . $view_desc['itemcode'] . '</td>
                                                <td contenteditable class="editable-cell desc">' . $view_desc['description'] . '</td>
                                                <td contenteditable class="editable-cell">' . $view_desc['remarks'] . '</td>
                                                <td style="width:2px; margin-right:0px;" class="drafted_id" "value="' . $view_desc['id'] . '"><a><i class="btn btn-danger btn-sm rounded-5 btn-sm bi bi-x remove" value="' . $view_desc['id'] . '"></i></a></td>
                                            </tr>
                                                ';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                        </form>
                    </div>
                </div>
                <!-- alert for remove row -->
                <div id="alert" style="display:flex; justify-content:right;">

                </div>
                <button class="btn btn-sm mt-5 btn-success update" type="submit" id="update" name="update">Update</button>
                <button class="btn btn-sm mt-5 btn-success upd_gen" type="submit" id="upd_gen" name="upd_gen">Update & Generate</button>
                <button class="btn btn-sm btn-success mt-5 generate" type="submit" id="generate" name="generate">Generate</button>
                <button class="btn btn-sm btn-primary mt-5 draft" type="submit" name="draft">Save as Draft</button>
                <button class="btn btn-sm btn-primary mt-5 draft_as_draft" type="submit" name="draft">Save as Draft</button>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade p-0 m-0" id="modal_draft" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body m-0">
                        <center>
                            <h6 class="mt-3">Successfully Save as draft</h6>
                            <h1 class="mt-2 mb-0"><i class="bi bi-check-circle" style="color:green;"></i></h1>
                        </center>
                    </div>
                    <div align="center">
                        <button type="button" class="btn btn-success btn-sm m-2 rounded-circle" id="ok_draft_as_draft">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade p-0 m-0" id="modal_save_as_draft" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-body m-0">
                        <center>
                            <h6 class="mt-3">Successfully Save as draft</h6>
                            <h1 class="mt-2 mb-0"><i class="bi bi-check-circle" style="color:green;"></i></h1>
                        </center>
                    </div>
                    <div align="center">
                        <button type="button" class="btn btn-success btn-sm m-2 rounded-circle" id="ok_save_as_draft">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap core JS-->
    <!-- <script src="assets/toastr/toastr.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <script src="assets/toastr/toastr.min.js"></script>
    <script src="assets/select2/js/select2.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="includes/js/draft_update.js"></script>

</body>

</html>