<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$edit = new admin_side($db);


switch (true) {
    case isset($_POST['del_pro_id']):
        $edit->id = $_POST['del_pro_id'];
        $exe = $edit->remove_project();
        echo ($exe) ? 1 : 0;
        break;
    case isset($_POST['del_pro_type_id']):
        $edit->id = $_POST['del_pro_type_id'];
        $exe1 = $edit->remove_project_type();
        echo ($exe1) ? 1 : 0;
        break;
    case isset($_POST['del_class_id']):
        $edit->id = $_POST['del_class_id'];
        $exe2 = $edit->remove_classification();
        echo ($exe2) ? 1 : 0;
        break;
    case isset($_POST['del_cip_type_id']):
        $edit->id = $_POST['del_cip_type_id'];
        $exe3 = $edit->remove_cip();
        echo ($exe3) ? 1 : 0;
        break;
    case isset($_POST['del_code_id']):
        $edit->id = $_POST['del_code_id'];
        $exe4 = $edit->remove_pro_code();
        echo ($exe4) ? 1 : 0;
        break;
}
