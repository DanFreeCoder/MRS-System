<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$edit = new admin_side($db);


switch (true) {
    case isset($_POST['pro_id']):
        $edit->id = $_POST['pro_id'];
        $exe = $edit->edit_project();
        while ($row = $exe->fetch(PDO::FETCH_ASSOC)) {
            $project = $row['Project'];
        }
        $array = [1, $project];
        echo ($exe) ? json_encode($array) : 0;
        break;
    case isset($_POST['pro_type_id']):
        $edit->id = $_POST['pro_type_id'];
        $exe1 = $edit->edit_project_type();
        while ($row = $exe1->fetch(PDO::FETCH_ASSOC)) {
            $project_type = $row['project_type'];
        }
        $array1 = [1, $project_type];
        echo ($exe1) ? json_encode($array1) : 0;
        break;
    case isset($_POST['class_id']):
        $edit->id = $_POST['class_id'];
        $exe2 = $edit->edit_classification();
        while ($row = $exe2->fetch(PDO::FETCH_ASSOC)) {
            $item_id = $row['class_item_id'];
            $items = $row['items'];
        }
        $array2 = [1, $item_id, $items];
        echo ($exe2) ? json_encode($array2) : 0;
        break;
    case isset($_POST['cip_type_id']):
        $edit->id = $_POST['cip_type_id'];
        $exe3 = $edit->edit_cip();
        while ($row = $exe3->fetch(PDO::FETCH_ASSOC)) {
            $cip_id = $row['cip_id'];
            $cip_account = $row['cip_account'];
        }
        $array3 = [1, $cip_id, $cip_account];
        echo ($exe3) ? json_encode($array3) : 0;
        break;
    case isset($_POST['code_id']):
        $edit->id = $_POST['code_id'];
        $exe4 = $edit->edit_pro_code();
        while ($row = $exe4->fetch(PDO::FETCH_ASSOC)) {
            $proj_code = $row['proj_code'];
        }
        $array4 = [1, $proj_code];
        echo ($exe4) ? json_encode($array4) : 0;
        break;
}
