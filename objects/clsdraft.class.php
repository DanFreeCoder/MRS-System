<?php
class cls_draft
{
    private $con;


    public function __construct($db)
    {
        $this->con = $db;
    }
    public function view_pro_draft()
    {
        $sql = "SELECT projects.id as pro_id, projects.Project as pro_name FROM projects, save_as_draft WHERE save_as_draft.project = projects.id AND save_as_draft.id = ?"; //drafted id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->id);

        $view->execute();

        return $view;
    }

    public function view_draft_type_of_project()
    {
        $sql = "SELECT type_of_project.id as pro_type_id, type_of_project.project_type as pro_type_name FROM type_of_project, save_as_draft WHERE save_as_draft.typeof_project = type_of_project.id AND save_as_draft.id = ?"; //drafted id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->id);

        $view->execute();

        return $view;
    }

    public function view_draft_classification()
    {
        $sql = "SELECT class_of_item.class_item_id as class_id, CONCAT(class_of_item.class_item_id, '-' , class_of_item.items ) as class_name, save_as_draft.id as draft_id FROM class_of_item, save_as_draft WHERE save_as_draft.classification = class_of_item.class_item_id AND save_as_draft.id = ?"; //drafted id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->id);

        $view->execute();

        return $view;
    }

    // public function view_draft_classification()
    // {
    //     $sql = "SELECT class_of_item.class_item_id as class_id, CONCAT(class_of_item.class_item_id, '-' , class_of_item.items ) as class_name, generateddata.id as gen_id FROM class_of_item, generateddata WHERE generateddata.classification = class_of_item.id";
    //     $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    //     $sel = $this->con->prepare($sql);

    //     $sel->execute();

    //     return $sel;
    // }


    public function view_draft_CIP()
    {
        $sql = "SELECT cip_type.id as cip_type_id, cip_type.cip_account as cip_name FROM cip_type, save_as_draft WHERE save_as_draft.cip_account = cip_type.id AND save_as_draft.id = ?"; //drafted id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->id);

        $view->execute();

        return $view;
    }

    public function view_draft_item_descriptions()
    {
        $sql = "SELECT item_as_draft.id, item_as_draft.qty, item_as_draft.oum, item_as_draft.itemcode, item_as_draft.description, item_as_draft.remarks FROM item_as_draft WHERE item_as_draft.item_id = ? AND item_as_draft.status != 0"; //drafted id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->id);

        $view->execute();

        return $view;
    }

    public function view_draft_sub_class()
    {
        $sql = "SELECT id, sub_class, approver FROM save_as_draft WHERE id = ?"; //drafted id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->id);

        $view->execute();

        return $view;
    }

    public function drafted_data()
    {
        $sql = "SELECT project, typeof_project, classification, sub_class, cip_account, approver, user_id FROM save_as_draft WHERE status !=0 AND id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->id);

        $view->execute();
        return $view;
    }
}
