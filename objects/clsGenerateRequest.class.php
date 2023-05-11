<?php

class Generate
{
    private $con;

    public function __construct($db)
    {
        $this->con = $db;
    }



    public function get_base_data()
    {
        $sql = "SELECT * FROM generateddata WHERE status != 0 AND id = (SELECT MAX(id) FROM generateddata)";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $get = $this->con->prepare($sql);


        $get->execute();
        return $get;
    }

    public function print_by_id()
    {
        $sql = "SELECT * FROM generateddata WHERE id = ? AND status != 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $get = $this->con->prepare($sql);

        $get->bindParam(1, $this->id);

        $get->execute();
        return $get;
    }

    public function print_project()
    {
        $sql = "SELECT * FROM projects WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $get = $this->con->prepare($sql);

        $get->bindParam(1, $this->id);

        $get->execute();
        return $get;
    }

    public function print_type_of_project()
    {
        $sql = "SELECT * FROM type_of_project WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $get = $this->con->prepare($sql);

        $get->bindParam(1, $this->id);

        $get->execute();
        return $get;
    }

    public function print_classification()
    {
        $sql = "SELECT id, CONCAT(class_item_id, '-', items) as class_name FROM class_of_item WHERE class_item_id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $get = $this->con->prepare($sql);

        $get->bindParam(1, $this->id);

        $get->execute();
        return $get;
    }

    public function print_CIP_account()
    {
        $sql = "SELECT * FROM cip_type WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $get = $this->con->prepare($sql);

        $get->bindParam(1, $this->id);

        $get->execute();
        return $get;
    }

    public function get_item_table()
    {
        $sql = "SELECT * FROM item_description WHERE item_id = ? AND user_id = ? AND status != 0"; //generateddata id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->item_id);
        $view->bindParam(2, $this->user_id);

        $view->execute();

        return $view;
    }


    public function get_item_table_by_id()
    {
        $sql = "SELECT * FROM item_description WHERE item_id = ? AND status != 0"; //generateddata id
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->item_id);

        $view->execute();

        return $view;
    }
}
