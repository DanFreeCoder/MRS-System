<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);

$users->id = $_POST['id'];
$users->password = md5($_POST['password']);

$upd_users = $users->update_current_logged();

if ($upd_users) {
    echo 1;
} else {
    echo 0;
}
