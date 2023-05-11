<?php
include '../config/connection.php';
include '../objects/clsdata_monitor.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$delete = new monitor($db);

$total = $delete->total_deleted();
while ($row = $total->fetch(PDO::FETCH_ASSOC)) {
    $count = $row['total'];
}

if ($count > 50) {
    $delete->delete_execute();
}
