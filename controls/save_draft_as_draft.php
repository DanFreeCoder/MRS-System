
<?php
include '../config/connection.php';
include '../objects/clscip.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();
$draft = new clsType($db);
$itemdescriptions = new clsType($db);
$itemdescriptions_s = new clsType($db);
$proj_code = new clsType($db);
$count_id = new clsType($db);
$saves = new clsType($db);


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
$draft->id = $_POST['id'];
$draft->user_id = $_SESSION['id'];
$draft->status = 0;
$insert = $draft->update();

if ($insert) {

    $data = json_decode($_POST['data']);

    foreach ($data as $row) {
        $col1 = $row[0]; //id
        $col2 = $row[1];
        $col3 = $row[2];
        $col4 = $row[3];
        // $col5 = $row[4];
        $col6 = $row[4];
        // $col7 = $row[6];
        $col8 = $row[5];

        $itemdescriptions->qty = $col2;
        $itemdescriptions->oum = $col3;
        $itemdescriptions->itemcode = $col4;
        // $itemdescriptions->brand = $col5;
        $itemdescriptions->description = $col6;
        // $itemdescriptions->color = $col7;
        $itemdescriptions->remarks = $col8;
        $itemdescriptions->status = 0;
        $itemdescriptions->item_id = $_POST['id'];
        $itemdescriptions->id = $col1;
        $itemdescriptions->user_id = $_SESSION['id'];

        $ex = $itemdescriptions->update_item();
    }
}
if ($ex) {
    echo 1;

    $saves->date_added = date('Y-m-d');
    $saves->project = $_POST['project'];
    $saves->typeof_project = $_POST['project_type'];
    $saves->classification = $_POST['classification'];
    $saves->sub_class = $_POST['sub_class'];
    $saves->cip_account = $_POST['cip_account'];
    $saves->approver = $_POST['approver'];
    $saves->user_id = $_SESSION['id'];
    $saves->status = 4;
    $save = $saves->save_as_draft();

    if ($save) {

        $data = json_decode($_POST['data']);

        foreach ($data as $row) {
            $col1 = $row[0]; //id
            $col2 = $row[1];
            $col3 = $row[2];
            $col4 = $row[3];
            // $col5 = $row[4];
            $col6 = $row[4];
            // $col7 = $row[6];
            $col8 = $row[5];

            $itemdescriptions_s->qty = $col2;
            $itemdescriptions_s->oum = $col3;
            $itemdescriptions_s->itemcode = $col4;
            // $itemdescriptions_s->brand = $col5;
            $itemdescriptions_s->description = $col6;
            // $itemdescriptions_s->color = $col7;
            $itemdescriptions_s->remarks = $col8;
            $itemdescriptions_s->user_id = $_SESSION['id'];
            $itemdescriptions_s->status = 4;

            $ins = $itemdescriptions_s->save_as_draft_item();
        }
        if ($ins) {
            echo 1;
        }
    }
} else {
    echo 0;
}
