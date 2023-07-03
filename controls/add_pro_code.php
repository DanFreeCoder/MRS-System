<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$add = new admin_side($db);

$add->proj_code = $_POST['proj_code'];

$ins = $add->add_pro_code();

echo ($ins) ? 1 : 0;
