<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$add = new admin_side($db);

$add->project = $_POST['project'];

$ins = $add->add_projects();

if ($ins) {
    echo 1;
} else {
    echo 0;
}
