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
    <link rel="stylesheet" href="assets/bootstrap@5.3.0/bootstrap.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito&display=swap');



        body {
            font-family: 'Nunito', sans-serif;
            box-sizing: border-box;
            font-size: 1rem;
        }

        @keyframes spinner-grow {
            0% {
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: none;
            }
        }

        a {
            text-decoration: none;
            cursor: pointer;
        }

        #requestor {
            width: 50%;
        }

        @media screen and (max-width: 990px) {
            .inputreq {
                width: 100%;
            }

            #requestor {
                width: 100%;
            }
        }
    </style>
</head>

<body style="background-color: #f1f1f3; padding:20px;">
    <div class="d-flex" id="wrapper">
        <!-- Sidebar-->
        <!-- hide sidebar -->

        <!-- Page content wrapper-->
        <div id="page-content-wrapper">
            <!-- Top navigation-->
            <?php include 'includes/navigation.php'; ?>
            <div class="container" style="margin-top: 100px;">
                <?php

                $get_id = $encryptor->decrypt_secretKey($_GET[md5('id')]);
                $view_description_draft->id = $get_id;
                $result = $view_description_draft->View_for_remarks();
                while ($rows = $result->fetch(PDO::FETCH_ASSOC)) {
                    $project1 = $rows['project'];
                    $project_type1 = $rows['typeof_project'];
                    $classname1 = $rows['classification'];
                    $sub_class1 = $rows['sub_class'];
                    $approver1 = $rows['approver'];
                    $cipname1 = $rows['cip_account'];
                    $requestor = $rows['requestor'];
                }
                ?>
                <div class="content1 p-3 mt-2" style="background-color:#f9f9fb; border-radius:5px; box-shadow: 5px 5px 5px 5px #888888;">
                    <center>
                        <h3 class="mb-5">Material Requisition Slip</h3>
                        <input type="text" id="get_id" value="<?php echo $get_id; ?>" hidden>
                    </center>
                    <div class="row">
                        <div class="col-4 mb-2 inputreq">
                            <div class="label">Project <span style="color:red;">*</span></div>
                            <select type="text" id="project" class="select2 form-control js-example-basic-single" style="width: 100%;" disabled>
                                <?php

                                $getpro = $projects->projects();
                                while ($row = $getpro->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row['id'] == $project1) {
                                        echo '<option  value="' . $row['id'] . '" selected>' . $row['Project'] . '</option>';
                                    } else {
                                        echo '<option  value="' . $row['id'] . '">' . $row['Project'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 mb-2 inputreq">
                            <div class="label">Type of Project <span style="color:red;">*</span></div>
                            <select type="text" id="project_type" class="select2 form-control js-example-basic-single" style="width: 100%" disabled>
                                <?php
                                $get = $project_type->get_type_of_project();
                                while ($row2 = $get->fetch(PDO::FETCH_ASSOC)) {
                                    if ($row2['id'] == $project_type1) {
                                        echo '<option value="' . $row2['id'] . '" selected>' . $row2['project_type'] . '</option>';
                                    } else {
                                        echo '<option value="' . $row2['id'] . '">' . $row2['project_type'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 mb-2 inputreq">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">Classification <span style="color:red;">*</span></div>
                            <select type="text" id="classification" class="select2 form-control js-example-basic-single" style="width: 100%;" disabled>
                                <?php
                                $get_class = $classification->get_class();
                                while ($rowc = $get_class->fetch(PDO::FETCH_ASSOC)) {
                                    if ($rowc['class_item_id'] == $classname1) {
                                        echo '<option  value="' . $rowc['class_item_id'] . '" selected>' . $rowc['class_item_id'] . '-' . $rowc['items'] . '</option>';
                                    } else {
                                        echo '<option  value="' . $rowc['class_item_id'] . '">' . $rowc['class_item_id'] . '-' . $rowc['items'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-4 mb-2 inputreq">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">Sub-Classification</div>
                            <input type="text" class="form-control text-secondary" value="<?php echo $sub_class1; ?>" id="sub_class" placeholder="Enter  Sub-Classification" disabled>
                            <input type="text" id="id" value="<?php echo $get_id; ?>" hidden>
                        </div>
                        <div class="col-5 mb-3 inputreq">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">CIP Account <span style="color:red;">*</span></div>
                            <select type="text" id="cip_account" class="select2 form-control js-example-basic-single" style="width: 100%;" disabled>
                                <?php

                                $get_CIP = $classification->CIP_type3();
                                while ($view_cip = $get_CIP->fetch(PDO::FETCH_ASSOC)) {
                                    if ($cipname1 == $view_cip['id']) {
                                        echo ' <option value="' . $view_cip['id'] . '" selected>' . $view_cip['cip_account'] . '</option>';
                                    } else {
                                        echo ' <option value="' . $view_cip['id'] . '">' . $view_cip['cip_account'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-3 mb-2 inputreq">
                            <!-- <div class="card mb-3" style="background-color:#f5f6fa"> -->
                            <div class="label">Approver <span style="color:red;">*</span></div>
                            <input type="text" class="form-control text-secondary" id="approver" value="<?php echo $approver1 ?>" placeholder="Enter Approver" disabled>
                        </div>
                        <div class="col-6 mb-2 inputreq">
                            <input type="text" class="form-control text-secondary inputreq" id="requestor" value="<?php echo $requestor ?>" <?php echo ($requestor == '') ? 'hidden' : ''; ?> placeholder="Requestor's Name" disabled>
                        </div>
                    </div>
                </div>
            </div>

            <!-- sub main -->
            <div class="container-fluid mb-5">
                <div class="sub-main mt-5 p-5 mb-5" style="background-color:#f9f9fb; border-radius:5px; box-shadow: 5px 5px 5px 5px #888888;">
                    <div class="row">
                        <center class="mb-3">
                            <h3>Item Descriptions</h3>
                        </center>
                        <form action="" method="post">
                            <div class="table-responsive">
                                <table class="table table-bordered bg-white table-hover" id="table">
                                    <thead>
                                        <th style="width: 1rem;" hidden>
                                            #
                                        </th>
                                        <th style="width: 1rem;">
                                            Quantity <span style="color:red;">*</span>
                                        </th>
                                        <th style="width: 5rem;">
                                            UOM <span style="color:red;">*</span>
                                        </th>
                                        <th style="width: 7rem;">
                                            Item Code <span style="color:red;">*</span>
                                        </th>
                                        <th style="width: 14rem;">
                                            Description <span style="color:red;">*</span>
                                        </th>
                                        <th style="width: 8rem;">
                                            Remarks
                                        </th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 0;
                                        $view_description_draft->id = $get_id;
                                        $get_desc = $view_description_draft->view_for_remarks_item_descriptions();
                                        $count = $get_desc->rowcount();
                                        $data = '';
                                        while ($view_desc = $get_desc->fetch(PDO::FETCH_ASSOC)) {
                                            $rem = '<td style="width:2px; margin-right:0px;" class="drafted_id" "value="' . $view_desc['id'] . '"><a><i class="btn btn-danger btn-sm rounded-5 btn-sm bi bi-x remove" value="' . $view_desc['id'] . '"></i></a></td>';

                                            $data .= '
                                           <tr id="row">
                                           <td class="editable-cell" hidden id="id2-' . $i . '">' . $view_desc['id'] . '</td>
                                           <td contenteditable class="editable-cell qty" name="qty" id="qty-' . $i . '">' . $view_desc['qty'] . '</td>
                                           <td contenteditable class="editable-cell oum" id="uom-' . $i . '">' . $view_desc['oum'] . '</td>
                                           <td contenteditable class="editable-cell code" id="cod-' . $i . '">' . $view_desc['itemcode'] . '</td>
                                           <td contenteditable class="editable-cell desc" id="des-' . $i . '">' . $view_desc['description'] . '</td>
                                           <td contenteditable class="editable-cell remark" id="rem-' . $i . '">' . $view_desc['remarks'] . '</td>
                                           </tr>';

                                            $i++;
                                        }
                                        if ($count < 5) {
                                            for ($i = $count; $i < 5; $i++) {
                                                $data .= ' 
                                                <tr id="row" ' . $i . ' style="font-size">
                                                <td contenteditable class="editable-cell qty" name="qty" id="qty-' . $i . '"></td>
                                                <td contenteditable class="editable-cell oum" id="uom-' . $i . '"></td>
                                                <td contenteditable class="editable-cell code" id="cod-' . $i . '"></td>
                                                <td contenteditable class="editable-cell desc" id="des-' . $i . '"></td>
                                                <td contenteditable class="editable-cell remarks" id="rem-' . $i . '"></td>
                                               </tr>';
                                            }
                                        }
                                        echo $data;
                                        ?>
                                    </tbody>
                                </table>
                        </form>
                    </div>
                </div>
                <br>
                <a class="p-2 bg-success text-light update" id="update" name="update" style=" border:none;"><i class="bi bi-arrow-repeat"><b></i> Update</b></a>
            </div>
        </div>
    </div>
    </div>

    <!-- Bootstrap core JS-->
    <script src="dist/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/jqueryv3.6.4/jquery.min.js?v=1.2"></script>
    <script src="assets/toastr/toastr.min.js"></script>
    <script src="assets/select2/js/select2.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="includes/js/update.js"></script>
    <script src="includes/js/functions/function.js?v=1.2"></script>

</body>

</html>