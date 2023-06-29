<!-- Sidebar Start -->
<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';
include '../objects/clscip.class.php';
$database = new clsMRFconnection();
$db = $database->connect();

$submitted = new admin_side($db);
$users = new admin_side($db);
$admin_side = new admin_side($db);
?>
<?php session_start();

if ($_SESSION['account_type'] != 1) {
    header('Location:../home.php');
}

if (!isset($_SESSION['firstname'])) {
    header('Location: ../controls/logout.php');
}
?>
<div class="sidebar pe-4 pb-3">
    <nav class="navbar bg-light navbar-light">
        <a href="dashboard.php" class="navbar-brand mx-4 mb-3">
            <h3 class="text-primary">MRS - ADMIN</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
            <div class="position-relative">
                <h3><a href="#" class="nav-link"><i class="bi bi-person-circle" style="width: 40px; height:40px;"></i></a></h3>
                <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
            </div>
            <div class="ms-3">
                <h6 class="mb-0"><?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?></h6>
                <span>Admin</span>
            </div>
        </div>
        <div class="navbar-nav w-100">
            <a href="dashboard.php?click=man" class="nav-item nav-link side" id="dash"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="manage.php?click=pro" class="nav-item nav-link side" id="pro"><i class="fa fa-sitemap me-2" aria-hidden="true"></i>Manage</a>
            <a href="users.php?click=usr" class="nav-item nav-link side" id="usr"><i class="fa fa-users me-2" aria-hidden="true"></i>Users</a>
        </div>
    </nav>
</div>
<!-- Sidebar End -->

<!-- Modal -->
<div class="modal fade" id="settingmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
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
                <h5 class="modal-title" id="staticBackdropLabel"></h5>
            </div>
            <div class="modal-body">
                <center>Congratulation, your password has been successfully updated. You need to login again to complete the process <a style="color: red;" href="../controls/logout.php">Click here</a> to continue.</center>
            </div>
        </div>
    </div>
</div>