<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);

$users->email = $_POST['email'];
$check = $users->check_email();

if (!$check) {
    $users->firstname = $_POST['fname'];
    $users->lastname = $_POST['lname'];
    $users->email = $_POST['email'];
    $users->username = $_POST['username'];
    $users->password = md5('123456');
    $users->account_type = 3;
    $users->log = 0;
    $users->status = 1;

    $register = $users->register();

    echo ($register) ? 1 : 0;
} else {
    echo 2;
}
