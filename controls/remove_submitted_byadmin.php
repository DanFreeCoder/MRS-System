<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();
$remove = new admin_side($db);

$items = $_POST['id'];
foreach ($items as $item) {

    $remove->id = $item;
    $remove->status = 0;

    $delete_post = $remove->delete_submitted();
}



if ($delete_post) {
    echo 1;
} else {
    echo 0;
}
