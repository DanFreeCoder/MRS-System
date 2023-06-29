<?php
session_start();
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$log = new Users($db);

$log->id = $_SESSION['id'];
$result = $log->check_log();

while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    if ($row['log'] == 0) {
        echo 1;
    } else {
        echo 0;
    }
}
