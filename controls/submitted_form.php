<?php
include '../config/connection.php';
include '../objects/clscip.class.php';
session_start();
$database = new clsMRFconnection();
$db = $database->connect();

$submitted = new clsType($db);

$data = array();
$output = array();

$sql = "SELECT generateddata.id, generateddata.date_added, generateddata.approver, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, generateddata.sub_class, cip_type.cip_account as cip_name, generateddata.con_num FROM generateddata, projects, type_of_project, class_of_item, cip_type";
//WHERE generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0 ORDER BY generateddata.con_num DESC
$columns = array(
    0 => 'generateddata.date_added',
    1 => 'projects.Project',
    2 => 'type_of_project.project_type',
    3 => "CONCAT(class_of_item.class_item_id, '-', class_of_item.items)",
    4 => 'generateddata.sub_class',
    5 => 'cip_type.cip_account',
    6 => 'generateddata.approver',
    7 => 'generateddata.con_num',
    8 => 'action'
);

if (isset($_POST['search']['value'])) {
    $search_value = $_POST['search']['value'];
    $sql .= " WHERE generateddata.date_added LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
    $sql .= " OR projects.Project LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
    $sql .= " OR type_of_project.project_type LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
    $sql .= " OR CONCAT(class_of_item.class_item_id,'-',class_of_item.items) LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
    $sql .= " OR generateddata.sub_class LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
    $sql .= " OR cip_type.cip_account LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
    $sql .= " OR generateddata.approver LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
    $sql .= " OR generateddata.con_num LIKE '%" . $search_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
}

$get_all_rows = $submitted->submitted_form($sql);
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

$get_data = $submitted->submitted_form($sql);
while ($row = $get_data->fetch(PDO::FETCH_ASSOC)) {
    $date_added = $row['date_added'];
    $Project = $row['Project'];
    $protype = $row['project_type'];
    $classification = $row['classif'];
    $sub_class = $row['sub_class'];
    $cip_account = $row['cip_name'];
    $approver = $row['approver'];
    $con_num = $row['con_num'];
    $action = '<a href="#" value="' . $row['id'] . '" class="views" >View</a><span class="text-success">||</span><a href="#" value="' . $row['id'] . '" class="print" >Print</a>';

    $data[] = array($date_added, $Project, $protype, $classification, $sub_class, $cip_account, $approver, $con_num, $action);
}

$recordsTotal = $get_data->rowcount();

$output = array(
    'draw' => $_POST['draw'],
    'recordsTotal' => $recordsTotal,
    'recordsFiltered' => $recordsFiltered,
    'data' => $data
);

echo json_encode($output);
