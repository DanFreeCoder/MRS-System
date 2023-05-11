<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);

$users->username = $_POST['username'];
$users->password = md5($_POST['password']);
$users->status = 0;

$login = $users->login();
if ($row = $login->fetch(PDO::FETCH_ASSOC)) {

    $_SESSION['firstname'] = $row['firstname'];
    $_SESSION['lastname'] = $row['lastname'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['password'] = $row['password'];
    $_SESSION['account_type'] = $row['account_type'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['id'] = $row['id'];
    echo 1;
} else {
    echo 0;
}
