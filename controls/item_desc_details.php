<?php
// include '../config/connection.php';
// include '../objects/clsitem_desc.class.php';
// ini_set("display_errors", "off"); //hide error if submitted table is 0 data
// session_start();
// $database = new clsMRFconnection();
// $db = $database->connect();
// $get_mrf_data = new clsitem_descriptions($db);

// $output = array();

// header("Content-Type: application/json");

// $sql = "SELECT generateddata.id, generateddata.date_added, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, generateddata.sub_class, cip_type.cip_account as cip_name, generateddata.con_num, generateddata.status FROM generateddata, projects, type_of_project, class_of_item, cip_type";


// $sql1 = "SELECT generateddata.id, generateddata.date_added, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, generateddata.sub_class, cip_type.cip_account as cip_name, generateddata.con_num FROM generateddata, projects, type_of_project, class_of_item, cip_type WHERE generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0 ORDER BY generateddata.id DESC";
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
//     6 => 'con_num',
//     7 => 'id',
// );
// //if search is keyup query will process
// if (isset($_POST['search']['value'])) {
//     $searh_value = $_POST['search']['value'];
//     $sql .= " WHERE generateddata.date_added LIKE '%" . $searh_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
//     $sql .= " OR projects.Project LIKE '%" . $searh_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
//     $sql .= " OR type_of_project.project_type LIKE '%" . $searh_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
//     $sql .= " OR CONCAT(class_of_item.class_item_id, '-', class_of_item.items) LIKE '%" . $searh_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
//     $sql .= " OR generateddata.sub_class LIKE '%" . $searh_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
//     $sql .= " OR cip_type.cip_account LIKE '%" . $searh_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
// } else {
//     $sql .= " OR generateddata.id LIKE '%" . $searh_value . "%' AND generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0";
// }



// if (isset($_POST['order'])) {
//     $column_name = $_POST['order'][0]['column'];
//     $order = $_POST['order'][0]['dir'];
//     $sql .= " ORDER BY " . $columns[$column_name] . " " . $order . ""; //OK
// } else {
//     $sql .= " ORDER BY generateddata.id DESC"; //OK
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
//     $con_num = $row['con_num'];
//     $id = '<a href="#" value="' . $row['id'] . '" class="views" >View</a> | <a href="#" value="' . $row['id'] . '" class="print" >Print</a>';



//     $data[] = array($date_added, $project, $typeof_project, $classification, $sub_class, $cip_account, $con_num, $id);
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
