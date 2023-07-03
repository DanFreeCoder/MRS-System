<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$update = new admin_side($db);

$update->project_type = $_POST['upd_project_type'];
$update->id = $_POST['upd_id_project_type'];

$upd = $update->update_proj_type();

echo ($upd) ? 1 : 0;
