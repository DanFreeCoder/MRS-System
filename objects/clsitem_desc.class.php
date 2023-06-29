<?php
class clsitem_descriptions
{
    private $con;


    public function __construct($db)
    {
        $this->con = $db;
    }

    public function submitted_data()
    {
        $sql = "SELECT generateddata.id, generateddata.date_added, generateddata.approver, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, generateddata.sub_class, cip_type.cip_account as cip_name, generateddata.con_num FROM generateddata, projects, type_of_project, class_of_item, cip_type WHERE generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.user_id = " . $_SESSION['id'] . " AND generateddata.status != 0 ORDER BY SUBSTR(generateddata.con_num, 7) DESC";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->execute();

        return $sel;
    }

    public function drafted_data()
    {
        $sql = "SELECT save_as_draft.id, save_as_draft.date_added, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, save_as_draft.sub_class, cip_type.cip_account as cip_name FROM save_as_draft, projects, type_of_project, class_of_item, cip_type WHERE save_as_draft.project = projects.id AND save_as_draft.typeof_project = type_of_project.id AND save_as_draft.classification = class_of_item.class_item_id  AND save_as_draft.cip_account = cip_type.id AND save_as_draft.status = 4 AND save_as_draft.user_id = " . $_SESSION['id'] . " AND save_as_draft.status != 0 ORDER BY save_as_draft.date_added DESC";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->execute();

        return $sel;
    }

    public function view_item_desc_by_id()
    {
        $sql = "SELECT id, qty, oum, itemcode, description, remarks FROM item_description WHERE item_id = ? AND user_id = ? AND status != 0 AND status != 4"; //generateddata id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->item_id);
        $view->bindParam(2, $this->user_id);

        $view->execute();

        return $view;
    }



    public function view_item_detail_by_id()
    {
        $sql = "SELECT qty, oum, itemcode, description, remarks FROM item_description WHERE item_id = ? AND status != 0 AND status != 4"; //generateddata id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->item_id);

        $view->execute();

        return $view;
    }
}
