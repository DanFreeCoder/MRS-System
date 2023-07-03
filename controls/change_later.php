<?php
session_start();
include '../config/connection.php';
include '../objects/clsusers.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$later = new Users($db);

$later->log = $_SESSION['log'] + 2;
$later->id = $_SESSION['id'];

$result = $later->update_log();

echo ($result) ? 1 : 0;
