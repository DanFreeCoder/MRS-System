
<?php
include '../config/connection.php';
include '../objects/clscip.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();
$generate = new clsType($db);
$update = new clsType($db);
$itemdescriptions = new clsType($db);
$proj_code = new clsType($db);
$count_id = new clsType($db);



//generate after update without adding rows

$update->date_added = date('Y-m-d');
$update->project = $_POST['project'];
$update->typeof_project = $_POST['project_type'];
$update->classification = $_POST['classification'];
$update->sub_class = $_POST['sub_class'];
$update->cip_account = $_POST['cip_account'];
$update->approver = $_POST['approver'];
$update->requestor = $_POST['requestor'];
$update->status = 1;
$update->id = $_POST['id'];
$update->user_id = $_SESSION['id'];

$save = $update->update();


$data = json_decode($_POST['data'], true);

foreach ($data as $row) {
    $col1 = $row['id2']; //id
    $col2 = $row['qty'];
    $col3 = $row['uom'];
    $col4 = $row['code'];
    $col6 = $row['desc'];
    $col8 = $row['remark'];

    $itemdescriptions->qty = $col2;
    $itemdescriptions->oum = $col3;
    $itemdescriptions->itemcode = $col4;
    // $itemdescriptions->brand = $col5;
    $itemdescriptions->description = $col6;
    // $itemdescriptions->color = $col7;
    $itemdescriptions->remarks = $col8;
    $itemdescriptions->status = 1;
    $itemdescriptions->item_id = $_POST['id'];
    $itemdescriptions->id = $col1;
    $itemdescriptions->user_id = $_SESSION['id'];

    $ex = $itemdescriptions->update_item();
}

if ($ex) {

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
    $save = $generate->gen_after_upd();

    $data = json_decode($_POST['data'], true);

    foreach ($data as $row) {
        $col1 = $row['id2']; //id
        $col2 = $row['qty'];
        $col3 = $row['uom'];
        $col4 = $row['code'];
        // $col5 = $row[4];
        $col6 = $row['desc'];
        // $col7 = $row[6];
        $col8 = $row['remark'];

        $generate->qty = $col2;
        $generate->oum = $col3;
        $generate->itemcode = $col4;
        // $generate->brand = $col5;
        $generate->description = $col6;
        // $generate->color = $col7;
        $generate->remarks = $col8;
        $generate->user_id = $_SESSION['id'];
        $generate->status = 1;
        $generate->item_id = $pro_id;


        $ex = $generate->gen_after_upd_item();
    }

    echo ($ex) ? 1 : 0;
} else {
    echo 0;
}
