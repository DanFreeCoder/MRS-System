<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$update = new admin_side($db);

$update->cip_id = $_POST['upd_cip_id'];
$update->cip_account = $_POST['upd_cip_account'];
$update->id = $_POST['upd_id_cip'];

$upd = $update->update_cip();

if ($upd) {
    echo 1;
} else {
    echo 0;
}
