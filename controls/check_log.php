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
    echo ($row['log'] == 0) ? 1 : 0;
}
