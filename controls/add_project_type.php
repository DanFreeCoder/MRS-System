<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$add = new admin_side($db);

$add->project_type = $_POST['project_type'];

$ins = $add->add_proj_type();

echo ($ins) ? 1 : 0;
