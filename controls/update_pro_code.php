<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$update = new admin_side($db);

$update->proj_code = $_POST['upd_code_id'];
$update->id = $_POST['upd_id_code'];

$upd = $update->update_pro_code();

echo ($upd) ? 1 : 0;
