<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$user = new admin_side($db);

$user->firstname = $_POST['firstname'];
$user->lastname = $_POST['lastname'];
$user->email = $_POST['email'];
$user->username = strtolower($_POST['firstname'] . '.' . $_POST['lastname']);
$user->password = md5('123456');
$user->account_type = $_POST['acc_type'];
$user->status = 1;

$add_user = $user->add_user();
if ($add_user) {
    echo 1;
} else {
    echo 0;
}
