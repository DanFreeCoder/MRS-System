<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);


$users->id = $_SESSION['id'];
$result1 = $users->check_log();
while ($row = $result1->fetch(PDO::FETCH_ASSOC)) {
    $log = $row['log'];
}

if ($log != 1) {
    $users->log = 0;
    $users->id = $_SESSION['id'];
    $result =  $users->update_log();
}

$logout = $users->logout();

if ($logout) {
    header("Location:../index.php");
} else {
    header("Location:../home.php");
}
