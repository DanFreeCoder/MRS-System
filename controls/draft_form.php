<?php
include '../config/connection.php';
include '../objects/clscip.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();

$draft = new clsType($db);

$data = array();
$output = array();
header("Content-Type: application/json");

$query = "SELECT save_as_draft.id, save_as_draft.date_added, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, save_as_draft.sub_class, cip_type.cip_account as cip_name FROM save_as_draft, projects, type_of_project, class_of_item, cip_type";

$columns = array(
    0 => 'save_as_draft.date_added',
    1 => 'projects.Project',
    2 => 'type_of_project.project_type',
    3 => "CONCAT(class_of_item.class_item_id, '-', class_of_item.items)",
    4 => 'save_as_draft.sub_class',
    5 => 'cip_type.cip_account',
    6 => 'action'
);

if (isset($_POST['search']['value'])) {
    $searh_value = $_POST['search']['value'];
    $query .= " WHERE save_as_draft.date_added LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
    $query .= " OR projects.Project LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
    $query .= " OR type_of_project.project_type LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
    $query .= " OR CONCAT(class_of_item.class_item_id, '-', class_of_item.items) LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
    $query .= " OR save_as_draft.sub_class LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
    $query .= " OR cip_type.cip_account LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
}

$get_all_rows = $draft->draft_form($query);
$recordsFiltered = $get_all_rows->rowcount();


if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $query .= " ORDER BY " . $columns[$column_name] . " " . $order . " ";
}

if (isset($_POST['length']) != '') {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $query .= " LIMIT " . $start . ", " . $length . " ";
}

$get_data = $draft->draft_form($query);
while ($row = $get_data->fetch(PDO::FETCH_ASSOC)) {
    $date_added = $row['date_added'];
    $Project = $row['Project'];
    $project_type = $row['project_type'];
    $classif = $row['classif'];
    $sub_class = $row['sub_class'];
    $cip_name = $row['cip_name'];
    $action = '<a href="draft.php?id=' . $row['id'] . '" class="edit" style="color:green;"><i class="bi bi-pencil-square"></i>Edit</a>';

    $data[] = array($date_added, $Project, $project_type, $classif, $sub_class, $cip_name, $action);
}

$recordsTotal = $get_data->rowcount();

$output  = array(
    'draw' => $_POST['draw'],
    'recordsTotal' => $recordsTotal,
    'recordsFiltered' => $recordsFiltered,
    'data' => $data
);
//print_r($get_data);
echo json_encode($output);
