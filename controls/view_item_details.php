<?php
include '../config/connection.php';
include '../objects/clsitem_desc.class.php';
$database = new clsMRFconnection();
$db = $database->connect();

$view_desc = new clsitem_descriptions($db);

$view_desc->item_id = $_POST['id'];
$view = $view_desc->view_item_detail_by_id();

while ($row = $view->fetch(PDO::FETCH_ASSOC)) {

    echo '
    <tr>
    <td>' . $row['qty'] . '</td>
    <td>' . $row['oum'] . '</td>
    <td>' . $row['itemcode'] . '</td>
    <td>' . $row['description'] . '</td>
    <td>' . $row['remarks'] . '</td>
    </tr>
    ';
}
