<?php
class clsProject
{
    private $con;
    private $tbl_projects = 'projects';

    public function __construct($db)
    {
        $this->con = $db;
    }

    public function get_projects()
    {
        $sql = "SELECT id, Project FROM projects WHERE status != 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->execute();

        return $sel;
    }
}
