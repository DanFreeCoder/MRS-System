<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);


$users->password = md5($_POST['password']);
$users->log = 1;
$users->id = $_SESSION['id'];

$upd_users = $users->change_password();

echo ($upd_users) ? 1 : 0;
