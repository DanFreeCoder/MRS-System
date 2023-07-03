
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


// $get_count_id = $count_id->count_draft_id();
// while ($row = $get_count_id->fetch(PDO::FETCH_ASSOC)) {
//     $pro_id = $row['id'];
// }


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
        $itemdescriptions->status = 4;

        $ex = $itemdescriptions->save_as_draft_item();
    }

    echo ($ex) ? 1 : 0;
}
