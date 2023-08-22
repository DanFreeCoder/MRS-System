<?php
include '../config/connection.php';
include '../objects/clsitem_desc.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();

$view_desc = new clsitem_descriptions($db);

$view_desc->item_id = $_POST['id'];
$view_desc->user_id = $_SESSION['id'];
$view = $view_desc->view_item_desc_by_id();
$count = $view->rowcount();
$data = '';
while ($row = $view->fetch(PDO::FETCH_ASSOC)) {

    $data .= '
    <tr>
    <td>' . $row['qty'] . '</td>
    <td>' . $row['oum'] . '</td>
    <td>' . $row['itemcode'] . '</td>
    <td>' . $row['description'] . '</td>
    <td>' . $row['remarks'] . '</td>
    </tr>
    ';
}
if ($count < 5) {
    for ($i = $count; $i < 5; $i++) {
        $data .= '
    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    ';
    }
}
echo $data;
