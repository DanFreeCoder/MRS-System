<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$update = new admin_side($db);

$update->Project = $_POST['upd_project'];
$update->id = $_POST['upd_id_project'];

$upd = $update->update_projects();

if ($upd) {
    echo 1;
} else {
    echo 0;
}
