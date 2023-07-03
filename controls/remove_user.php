<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();
$remove = new admin_side($db);

$remove->id = $_POST['id'];
$del = $remove->remove_user();

echo ($del) ? 1 : 0;
