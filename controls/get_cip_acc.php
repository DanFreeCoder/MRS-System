<?php
include '../config/connection.php';
include '../objects/clscip.class.php';
$database = new clsMRFconnection();
$db = $database->connect();
$CIP_type = new clsType($db);

$id = '';
if ($_POST['id'] == 1 || $_POST['id'] == 4) {
    $id = 1;
} else {
    $id = $_POST['id'];
}
$CIP_type->cip_id = $id;
$getcip = $CIP_type->CIP_type();
while ($row = $getcip->fetch(PDO::FETCH_ASSOC)) {
    echo  ' <option value="' . $row['id'] . '">' . $row['cip_account'] . '</option>';
}
