<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);

$username = strtolower($_POST['fname'] . "." . $_POST['lname']);
$users->firstname = $_POST['fname'];
$users->lastname = $_POST['lname'];
$users->email = $_POST['email'];
$users->username = str_replace(" ", ".", $username);
$users->password = md5('123456');
$users->account_type = 3;
$users->status = 1;

$register = $users->register();

if ($register) {
    echo 1;
} else {
    echo 0;
}
