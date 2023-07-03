<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);

$users->id = $_POST['id'];
$users->firstname = $_POST['fname'];
$users->lastname = $_POST['lname'];
$users->email = $_POST['email'];
$users->account_type = $_POST['user_type'];
$users->username = str_replace(" ", ".", strtolower($_POST['fname'] . '.' . $_POST['lname']));

$upd_users = $users->update_user();

echo ($upd_users) ? 1 : 0;
