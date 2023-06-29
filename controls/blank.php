<?php
include '../config/connection.php';
include '../objects/clscip.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();
$generate = new clsType($db);
$itemdescriptions = new clsType($db);
$proj_code = new clsType($db);
$count_id = new clsType($db);



$proj_code->id = $_POST['project'];
$get_code_name = $proj_code->get_proj_code();
while ($row = $get_code_name->fetch(PDO::FETCH_ASSOC)) {
    $pro_code_name = $row['proj_code'];
}

$year = substr(date('Y'), 2);
$get_count_id = $count_id->count_id();
while ($row = $get_count_id->fetch(PDO::FETCH_ASSOC)) {
    $pro_id = $row['id'];
}

$pro_num = str_pad($pro_id, 5, "0", STR_PAD_LEFT);



$generate->date_added = date('Y-m-d');
$generate->project = $_POST['project'];
$generate->typeof_project = $_POST['project_type'];
$generate->classification = $_POST['classification'];
$generate->sub_class = $_POST['sub_class'];
$generate->con_num = $pro_code_name . '-' . $year . '-' . $pro_num; //'PRO-23-00001';
$generate->cip_account = $_POST['cip_account'];
$generate->approver = $_POST['approver'];
$generate->requestor = $_POST['requestor'];
$generate->user_id = $_SESSION['id'];
$generate->status = 2;
$insert = $generate->generate();


if ($insert) {
    echo 1;
} else {
    echo 0;
}
