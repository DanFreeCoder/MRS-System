<?php
include '../config/connection.php';
include '../objects/clscip.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();
$remove = new clsType($db);


$remove->status = 0;
$remove->id = $_POST['id'];
$remove->user_id = $_SESSION['id'];

$del = $remove->remove_draft_id();

if ($del) {
    echo 1;
} else {
    echo 0;
}
