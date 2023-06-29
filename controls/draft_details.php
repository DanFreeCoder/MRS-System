<?php
// include '../config/connection.php';
// include '../objects/clsitem_desc.class.php';
// session_start();
// ini_set("display_errors", "off"); //hide error if draft table is 0 data
// $database = new clsMRFconnection();
// $db = $database->connect();
// $get_mrf_data = new clsitem_descriptions($db);

// $output = array();

// header("Content-Type: application/json");

// $sql = "SELECT save_as_draft.id, save_as_draft.date_added, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, save_as_draft.sub_class, cip_type.cip_account as cip_name, save_as_draft.status FROM save_as_draft, projects, type_of_project, class_of_item, cip_type";


// $sql1 = "SELECT save_as_draft.id, save_as_draft.date_added, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, save_as_draft.sub_class, cip_type.cip_account as cip_name FROM save_as_draft, projects, type_of_project, class_of_item, cip_type WHERE save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . "  AND save_as_draft.status != 0";
// $get_all_rows = $get_mrf_data->display_item_desc($sql1);
// $total_all_rows = $get_all_rows->rowcount();

// //for column to table   
// $columns = array(
//     0 => 'date_added',
//     1 => 'project',
//     2 => 'typeof_project',
//     3 => 'classification',
//     4 => 'sub_class',
//     5 => 'cip_account',
//     6 => 'id',
// );
// //if search is keyup query will process
// if (isset($_POST['search']['value'])) {
//     $searh_value = $_POST['search']['value'];
//     $sql .= " WHERE save_as_draft.date_added LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
//     $sql .= " OR projects.Project LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
//     $sql .= " OR type_of_project.project_type LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
//     $sql .= " OR CONCAT(class_of_item.class_item_id, '-', class_of_item.items) LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
//     $sql .= " OR save_as_draft.sub_class LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
//     $sql .= " OR cip_type.cip_account LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
// } else {
//     $sql .= " WHERE save_as_draft.id LIKE '%" . $searh_value . "%' AND save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0";
// }

// if (isset($_POST['order'])) {
//     $column_name = $_POST['order'][0]['column'];
//     $order = $_POST['order'][0]['dir'];
//     $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . ""; //OK
// }

// if (isset($_POST['length']) != '') {
//     $start = $_POST['start'];
//     $length = $_POST['length'];
//     $sql .= " LIMIT " . $start . ", " . $length . " ";
// }


// $run_query = $get_mrf_data->display_item_desc($sql);
// while ($row = $run_query->fetch(PDO::FETCH_ASSOC)) {

//     $date_added = $row['date_added'];
//     $project = $row['Project'];
//     $typeof_project = $row['project_type'];
//     $classification = $row['classif'];
//     $sub_class = $row['sub_class'];
//     $cip_account = $row['cip_name'];
//     $id = '<a href="draft.php?id=' . $row['id'] . '" class="edit" style="color:green;"><i class="bi bi-pencil-square"></i>Edit</a>';

//     $data[] = array($date_added, $project, $typeof_project, $classification, $sub_class, $cip_account, $id);
// }

// $count_rows = $run_query->rowcount();
// // echo $count_rows;

// if (!isset($_POST['draw'])) {
//     echo 'draw is not isset';
// }


// $output = array(
//     'draw' => $_POST['draw'],
//     'recordsTotal' => $count_rows,
//     'recordsFiltered' => $total_all_rows,
//     'data' => $data,

// );


// echo json_encode($output, JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE);
