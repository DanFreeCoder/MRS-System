<?php
include '../config/intranetConnect.php';
include '../objects/clsitemcode.class.php';

$database2 = new IntraConnection();
$db2 = $database2->connect();

$search_desc = new itemcode($db2);

$code = $_GET['term']; //this is from select2 
$result = $search_desc->search_desc($code);
$data = []; // Prepare the data in a format that Select2 can understand
while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    //id and text are defined by select2.
    $data[] = [
        'id' => $row['id'],
        'text' => $row['itemcode']
    ];
}
// Return the data as JSON
echo json_encode($data);
