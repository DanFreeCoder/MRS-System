<?php
include '../config/connection.php';
include '../objects/clsadmin_side.class.php';

$database = new clsMRFconnection();
$db = $database->connect();

$submitted = new admin_side($db);

$data = array();
$output = array();
header("Content-Type: application/json");
$sql = "SELECT generateddata.id, generateddata.date_added, generateddata.user_id, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, generateddata.sub_class, cip_type.cip_account as cip_name, generateddata.con_num, CONCAT(users.firstname, ' ', users.lastname)as user FROM generateddata, projects, type_of_project, class_of_item, cip_type, users";

$columns = array(
    0 => 'id',
    1 => 'date_added',
    2 => 'Project',
    3 => 'type_of_project.project_type',
    4 => "class_of_item.class_item_id" . '-' . "class_of_item.items",
    5 => 'sub_class',
    6 => 'cip_type.cip_account',
    7 => 'con_num',
    8 => "CONCAT(users.firstname, ' ', users.lastname)",
    9 => 'action'
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE generateddata.date_added LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0";
    $sql .= " OR projects.Project LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0";
    $sql .= " OR type_of_project.project_type LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0";
    $sql .= " OR CONCAT(class_of_item.class_item_id, '-', class_of_item.items) LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0";
    $sql .= " OR generateddata.sub_class LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0";
    $sql .= " OR cip_type.cip_account LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0";
    $sql .= " OR generateddata.con_num LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0";
    $sql .= " OR CONCAT(users.firstname, ' ', users.lastname) LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0";
}

$get_all_rows = $submitted->all_submitted_form($sql);
$recordsFiltered = $get_all_rows->rowcount();

if (isset($_POST['order'])) {
    $column_name = $_POST['order'][0]['column'];
    $order = $_POST['order'][0]['dir'];
    $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . " ";
}

if (isset($_POST['length']) != '') {
    $start = $_POST['start'];
    $length = $_POST['length'];
    $sql .= " LIMIT " . $start . ", " . $length . " ";
}

$get_data = $submitted->all_submitted_form($sql);
while ($row = $get_data->fetch(PDO::FETCH_ASSOC)) {
    $checkbox = '<input type="checkbox" name="form_sub" class="form-check-input" value="' . $row['id'] . '">';
    $date_added = $row['date_added'];
    $Project = $row['Project'];
    $type = $row['project_type'];
    $classification = $row['classif'];
    $sub_class = $row['sub_class'];
    $cip_account = $row['cip_name'];
    $con_num = $row['con_num'];
    $user = $row['user'];
    $action = '<a href="../edit_form.php?user_id=' . $row['user_id'] . '&&' . 'id=' . $row['id'] . '" class="edit_form text-success" style="text-decoration:underline;" value="' . $row['id'] . '">Edit</a>
    <a href="#" class="detail text-primary" style="text-decoration:underline;" value="' . $row['id'] . '">Detail</a>';


    $data[] = array($checkbox, $date_added, $Project, $type, $classification, $sub_class, $cip_account, $con_num, $user, $action);
}

$recordsTotal = $get_data->rowcount();


$output = array(
    'draw' => $_POST['draw'],
    'recordsTotal' => $recordsTotal,
    'recordsFiltered' => $recordsFiltered,
    'data' => $data
);

echo json_encode($output);
