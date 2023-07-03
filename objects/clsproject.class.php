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
        $sel = $this->con->prepare($sql);

        $sel->execute();

        return $sel;
    }
}
