
<?php
include '../config/connection.php';
include '../objects/clscip.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();
$draft = new clsType($db);
$itemdescriptions = new clsType($db);
$proj_code = new clsType($db);
$count_id = new clsType($db);


$draft->date_added = date('Y-m-d');
$draft->project = $_POST['project'];
$draft->typeof_project = $_POST['project_type'];
$draft->classification = $_POST['classification'];
$draft->sub_class = $_POST['sub_class'];
$draft->cip_account = $_POST['cip_account'];
$draft->approver = $_POST['approver'];
$draft->requestor = $_POST['requestor'];
$draft->user_id = $_SESSION['id'];
$draft->status = 4;
$insert = $draft->save_as_draft();

if ($insert) {

    $data = json_decode($_POST['data'], true);
    if ($data == null) {
        echo 1;
    } else {
        foreach ($data as $row) {
            $col1 = $row['qty'];
            $col2 = $row['uom'];
            $col3 = $row['code'];
            $col4 = $row['desc'];
            $col5 = $row['remark'];

            $itemdescriptions->qty = $col1;
            $itemdescriptions->oum = $col2;
            $itemdescriptions->itemcode = $col3;
            $itemdescriptions->description = $col4;
            $itemdescriptions->remarks = $col5;
            $itemdescriptions->user_id = $_SESSION['id'];
            $itemdescriptions->status = 4;

            $ex = $itemdescriptions->save_as_draft_item();
        }

        echo ($ex) ? 1 : 0;
    }
}
