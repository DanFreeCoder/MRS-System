<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);

$users->firstname = $_POST['fname'];
$users->lastname = $_POST['lname'];
$users->email = $_POST['email'];
$users->username = $_POST['username'];
$users->password = md5('123456');
$users->account_type = 3;
$users->log = 0;
$users->status = 1;

$register = $users->register();

if ($register) {
    echo 1;
} else {
    echo 0;
}
