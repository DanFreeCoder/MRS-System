<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';
$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);

$logout = $users->logout();

if ($logout) {
    header("Location:../index.php");
} else {
    header("Location:../home.php");
}
