<?php
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$users = new Users($db);
$module = $_GET['module'];

switch ($module) {
    case 'with_password':
        $users->firstname = $_POST['fname'];
        $users->lastname = $_POST['lname'];
        $users->username = $_POST['username'];
        $users->password = md5($_POST['password']);
        $users->log = 0;
        $users->id = $_POST['id'];

        $upd_users = $users->update_current_logged();

        echo ($upd_users) ? 1 : 0;
        break;
    case 'details_only':
        $users->firstname = $_POST['fname'];
        $users->lastname = $_POST['lname'];
        $users->username = $_POST['username'];
        $users->id = $_POST['id'];

        $upd_details = $users->update_details_only();

        echo ($upd_details) ? 1 : 0;
}
