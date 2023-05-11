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
        if ($exe) {
            echo 1;
        } else {
            echo 0;
        }
        break;
    case isset($_POST['del_pro_type_id']):
        $edit->id = $_POST['del_pro_type_id'];
        $exe1 = $edit->remove_project_type();

        if ($exe1) {
            echo 1;
        } else {
            echo 0;
        }
        break;
    case isset($_POST['del_class_id']):
        $edit->id = $_POST['del_class_id'];
        $exe2 = $edit->remove_classification();
        if ($exe2) {
            echo 1;
        } else {
            echo 0;
        }
        break;
    case isset($_POST['del_cip_type_id']):
        $edit->id = $_POST['del_cip_type_id'];
        $exe3 = $edit->remove_cip();
        if ($exe3) {
            echo 1;
        } else {
            echo 0;
        }
        break;
    case isset($_POST['del_code_id']):
        $edit->id = $_POST['del_code_id'];
        $exe4 = $edit->remove_pro_code();
        if ($exe4) {
            echo 1;
        } else {
            echo 0;
        }
        break;
}
