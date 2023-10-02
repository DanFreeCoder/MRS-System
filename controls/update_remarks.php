<?php
include '../config/connection.php';
include '../objects/clsdraft.class.php';
$database = new clsMRFconnection();
$db = $database->connect();

$update = new cls_draft($db);

$data = json_decode($_POST['data'], true);

foreach ($data as $d) {
    $update->remarks = $d['remarks'];
    $update->id = $d['id'];
    $res = $update->update_remarks();
}

echo ($res) ? 1 : 0;
