
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
$delete = new clsType($db);
$delete_item = new clsType($db);



$proj_code->id = $_POST['project'];
$get_code_name = $proj_code->get_proj_code();
while ($row = $get_code_name->fetch(PDO::FETCH_ASSOC)) {
    $pro_code_name = $row['proj_code'];
}

$update->date_added = date('Y-m-d');
$update->project = $_POST['project'];
$update->typeof_project = $_POST['project_type'];
$update->classification = $_POST['classification'];
$update->sub_class = $_POST['sub_class'];
$update->cip_account = $_POST['cip_account'];
$update->approver = $_POST['approver'];
$update->requestor = $_POST['requestor'];
$update->id = $_POST['id'];
$update->status = 4;
$update->user_id = $_SESSION['id'];
$save = $update->update();


$data = json_decode($_POST['data'], true);
// echo print_r($data);

foreach ($data as $row) {
    if ($row['id2'] == '' || $row['id2'] == null) {
        $itemdescriptions->item_id = $_POST['id'];
        $itemdescriptions->qty = $row['qty'];
        $itemdescriptions->oum = $row['uom'];
        $itemdescriptions->itemcode = $row['code'];
        $itemdescriptions->description = $row['desc'];
        $itemdescriptions->remarks = $row['remark'];
        $itemdescriptions->user_id = $_SESSION['id'];
        $itemdescriptions->status = 4;

        $itemdescriptions->add_item_no_exist();
    }
    $col1 = $row['id2']; //id
    $col2 = $row['qty']; //qty
    $col3 = $row['uom']; //uom
    $col4 = $row['code']; //itemcode
    $col6 = $row['desc']; //description
    $col8 = $row['remark']; //remarks

    $itemdescriptions->qty = $col2;
    $itemdescriptions->oum = $col3;
    $itemdescriptions->itemcode = $col4;
    // $itemdescriptions->brand = $col5;
    $itemdescriptions->description = $col6;
    // $itemdescriptions->color = $col7;
    $itemdescriptions->remarks = $col8;
    $itemdescriptions->status = 4;
    $itemdescriptions->item_id = $_POST['id'];
    $itemdescriptions->id = $col1;
    $itemdescriptions->user_id = $_SESSION['id'];

    $ex = $itemdescriptions->update_item();

    echo ($ex) ? 1 : 0;
}
