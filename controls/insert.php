
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



//select project name
$proj_code->id = $_POST['project'];
$get_code_name = $proj_code->get_proj_code();
while ($row = $get_code_name->fetch(PDO::FETCH_ASSOC)) {
    $pro_code_name = $row['proj_code'];
}

//select all from series number
$proj_code->project_code = $pro_code_name;
$code = $proj_code->last_series_num();
while ($row = $code->fetch(PDO::FETCH_ASSOC)) {
    $project_code = $row['project_code'];
    $num = $row['series_number'];
}

$series_number = $num + 1;
$proj_code->series_number = str_pad($series_number, 5, 0, STR_PAD_LEFT);
$proj_code->project_code = $pro_code_name;
$proj_code->update_series_num();


$year = substr(date('Y'), 2);
$get_count_id = $count_id->count_id();
while ($row = $get_count_id->fetch(PDO::FETCH_ASSOC)) {
    $pro_id = $row['id'];
}

$generate->date_added = date('Y-m-d');
$generate->project = $_POST['project'];
$generate->typeof_project = $_POST['project_type'];
$generate->classification = $_POST['classification'];
$generate->sub_class = $_POST['sub_class'];
$generate->con_num = $pro_code_name . '-' . $year . '-' . str_pad($series_number, 5, 0, STR_PAD_LEFT); //'PRO-23-00001';
$generate->cip_account = $_POST['cip_account'];
$generate->approver = $_POST['approver'];
$generate->requestor = $_POST['requestor'];
$generate->user_id = $_SESSION['id'];
$generate->status = 1;
$insert = $generate->generate();


$data = json_decode($_POST['data']);

foreach ($data as $row) {
    $col1 = $row[0];
    $col2 = $row[1];
    $col3 = $row[2];
    // $col4 = $row[3];
    $col5 = $row[3];
    // $col6 = $row[5];
    $col7 = $row[4];

    $itemdescriptions->qty = $col1;
    $itemdescriptions->oum = $col2;
    $itemdescriptions->itemcode = $col3;
    // $itemdescriptions->brand = $col4;
    $itemdescriptions->description = $col5;
    // $itemdescriptions->color = $col6;
    $itemdescriptions->remarks = $col7;
    $itemdescriptions->user_id = $_SESSION['id'];
    $itemdescriptions->status = 1;
    $itemdescriptions->item_id = $pro_id;

    $ex = $itemdescriptions->generate_item();
}

echo ($ex) ? 1 : 0;
