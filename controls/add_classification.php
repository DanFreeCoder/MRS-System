<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$add = new admin_side($db);

$add->class_item_id = $_POST['item_id'];
$add->items = $_POST['items'];

$ins = $add->add_classification();

if ($ins) {
    echo 1;
} else {
    echo 0;
}
