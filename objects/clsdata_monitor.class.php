<?php

class monitor
{

    private $con;
    public function __construct($db)
    {
        $this->con = $db;
    }

    public function total_deleted()
    {
        $sql = "SELECT COUNT(id) as total FROM item_as_draft WHERE status = 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->execute();
        return $del;
    }

    public function delete_execute()
    {
        $sql = "DELETE FROM item_as_draft WHERE status = 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->execute();
        return $del;
    }
}
