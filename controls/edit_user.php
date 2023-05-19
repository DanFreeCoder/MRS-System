<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$users = new admin_side($db);

$users->id = $_POST['id'];
$edit_user = $users->view_user();
while ($row = $edit_user->fetch(PDO::FETCH_ASSOC)) {
    $id = $row['id'];
    $firstname = $row['firstname'];
    $lastname = $row['lastname'];
    $email = $row['email'];

    echo '
        <div class="mb-3">
        <input type="text" class="form-control upd-id" value="' . $id . '" hidden>
        <label class="form-label">Firstname</label>
        <input type="text" class="form-control" id="upd-firstname" value="' . $firstname . '">
    </div>
    <div class="mb-3">
        <label class="form-label">Lastname</label>
        <input type="text" class="form-control" id="upd-lastname" value="' . $lastname . '">
    </div>
    <div class="mb-3">
        <label class="form-label">Email address</label>
        <input type="email" class="form-control" id="upd-email" value="' . $email . '">
    </div>
    <div class="mb-3">
        <label class="form-label">Account Type</label>
        <select class="form-control select2" id="upd-account_user_type">';
    if ($row['account_type'] != 3) {
        echo '
                <option value="1" selected>Admin</option>
                <option value="3">Staff</option>
                ';
    } else {
        echo '
                <option value="1">Admin</option>
                <option value="3" selected>Staff</option>
                ';
    }
    echo '</select>
    </div>
    ';
}
