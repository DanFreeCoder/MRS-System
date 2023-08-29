<?php
include 'config/connection.php';
include 'objects/clscip.class.php';
include 'objects/clsdraft.class.php';
include 'objects/clsitem_desc.class.php';
include 'objects/clsadmin_side.class.php';
include 'objects/clsEncryptor.php';
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
$encryptor = new Encryptor();

if (!isset($_SESSION['firstname'])) {
    header('Location: controls/logout.php');
}


?>
<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom fixed-top">
    <div class="container-fluid">
        <div class="logo" style="margin-left:5%;">
            <a href="home.php"><img src="./assets/img/innoland.png" alt="" style="height: 60px; margin-right:0px;"></a>
        </div>
        <a href="home.php" style="text-decoration:none;">
            <h1 class="" style="font-weight: 700; color:#00b5a9; font-family: 'Nunito', sans-serif;">MRS</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <span> &nbsp; &nbsp;</span>
            <select name="" id="finddesc" class="select2  finddesc" style="width:30%;">
                <option value="0" class="form-control">Enter Item Code</option>
            </select>
            <select name="" id="findcode" class="select2 findcode form-control" style="width: 70%;">
                <option value="0" class="form-control">Enter Item Description</option>
            </select>
            <span> &nbsp; &nbsp;</span>
            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                <li class="nav-item active"><a class="nav-link" href="home.php"><b>Dashboard</b></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><b><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname'] ?></b></a>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" id="settings" href="#!">Account Settings</a>
                        <?php
                        if ($_SESSION['account_type'] != 3) {
                            echo '<a class="dropdown-item" id="admin_side" href="#!">Admin Side</a>';
                        }
                        ?>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" id="logout" href="#">Log out</a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>



<!-- Modal -->
<div class="modal fade" id="settingmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #00aa9f;">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Account Settings</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <label>First Name</label>
                    <div>
                        <input type="text" class="form-control" id="upd-id" value="<?php echo $_SESSION['id'] ?>" hidden>
                        <input type="text" class="form-control" id="upd-fname" value="<?php echo $_SESSION['firstname'] ?>">
                    </div>
                    <label>Last Name</label>
                    <div><input type="text" class="form-control" id="upd-lname" value="<?php echo $_SESSION['lastname'] ?>"></div>
                    <label>Username</label>
                    <div>
                        <input type="text" class="form-control" id="upd-uname" value="<?php echo $_SESSION['username'] ?>" readonly="true">
                    </div>

                    <label>Password</label>
                    <div>
                        <input type="password" id="password" class="form-control">
                    </div>

                    <label>Re-type Password</label>
                    <div>
                        <input type="password" id="retype_password" class="form-control">
                    </div>
                    <br>
                    <br>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" id="save_upd" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="user_current_pass" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">MRS</h5>
            </div>
            <div class="modal-body">
                <center>Congratulation, your password has been successfully updated. You need to login again to complete the process <a style="color: red;" href="../mrs/controls/logout.php">Click here</a> to continue.</center>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade p-0 m-0" id="log_out" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body m-0">
                <center>
                    <h6 class="mt-3">Are you sure you want to log out?</h6>
                    <h1 class="mt-2 mb-0"><i class="bi bi-x-circle" style="color:red;"></i></h1>
                </center>
            </div>
            <div align="center">
                <button class="btn btn-success btn-sm m-2" id="out">Yes</button>
                <button type="button" class="btn btn-info btn-sm m-2" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>