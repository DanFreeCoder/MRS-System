<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$objremove = new admin_side($db);

$id = $_POST['id'];

$objremove->id = $id;
$objremove->status = 0;

$result = $objremove->remove_items();

echo ($result) ? 1 : 0;
