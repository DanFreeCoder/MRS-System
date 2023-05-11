<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$add = new admin_side($db);

$add->cip_id = $_POST['cip_id'];
$add->cip_account = $_POST['cip_account'];

$ins = $add->add_cip();

if ($ins) {
    echo 1;
} else {
    echo 0;
}
