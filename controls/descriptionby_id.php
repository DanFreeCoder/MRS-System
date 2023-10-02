<?php
include '../config/intranetConnect.php';
include '../objects/clsitemcode.class.php';

$database2 = new IntraConnection();
$db2 = $database2->connect();

$search_descby_id = new itemcode($db2);


$search_descby_id->itemcode = $_POST['itemcode'];
//description_bycode
$code = $search_descby_id->description_bycode();
while ($row = $code->fetch(PDO::FETCH_ASSOC)) {
    $itemdesc = $row['itemdesc'];
    $unit = $row['unit'];
}
$result = array($itemdesc, $unit);
echo json_encode($result);
