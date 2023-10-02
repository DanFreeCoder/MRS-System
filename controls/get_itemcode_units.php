<?php
include '../config/intranetConnect.php';
include '../objects/clsitemcode.class.php';

$database2 = new IntraConnection();
$db2 = $database2->connect();

$get_units = new itemcode($db2);


$res = $get_units->get_units($_POST['itemcode']);
while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $unit = $row['unit'];
}
echo json_encode($unit);
