<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$obj_update = new admin_side($db);

$project = $_POST['project'];
$typeof_project = $_POST['project_type'];
$classification = $_POST['classification'];
$sub_class = $_POST['sub_class'];
$cip_account = $_POST['cip_account'];
$approver = $_POST['approver'];
$id = $_POST['id'];

$obj_update->project = $project;
$obj_update->typeof_project = $typeof_project;
$obj_update->classification = $classification;
$obj_update->sub_class = $sub_class;
$obj_update->cip_account = $cip_account;
$obj_update->approver = $approver;
$obj_update->id = $id;
$save = $obj_update->update_generated_form();


$data = json_decode($_POST['data']);

foreach ($data as $row) {
    $col1 = $row[0]; //id
    $col2 = $row[1]; //qty
    $col3 = $row[2]; //uom
    $col4 = $row[3]; //itemcode
    // $col5 = $row[4];
    $col6 = $row[4]; //description
    // $col7 = $row[6];
    $col8 = $row[5]; //remarks

    $obj_update->qty = $col2;
    $obj_update->oum = $col3;
    $obj_update->itemcode = $col4;
    // $obj_update->brand = $col5;
    $obj_update->description = $col6;
    // $obj_update->color = $col7;
    $obj_update->remarks = $col8;
    $obj_update->item_id = $_POST['id'];
    $obj_update->id = $col1;
    $obj_update->user_id = $_POST['user_id'];

    $exs = $obj_update->update_generated_form_item();
}

echo ($exs) ? 1 : 0;
