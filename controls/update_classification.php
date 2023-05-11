<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$update = new admin_side($db);

$update->class_item_id = $_POST['upd_item_id'];
$update->items = $_POST['upd_items'];
$update->id = $_POST['upd_id_class'];

$upd = $update->update_classification();

if ($upd) {
    echo 1;
} else {
    echo 0;
}
