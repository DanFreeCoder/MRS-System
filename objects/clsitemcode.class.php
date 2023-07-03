<?php

class itemcode
{
    private $con;

    public function __construct($db)
    {
        $this->con = $db;
    }


    public function description_code()
    {
        $sql = "SELECT * FROM itemcodes LIMIT 50";
        $get = $this->con->prepare($sql);

        $get->execute();
        return $get;
    }
    public function search_code($desc)
    {
        $sql = "SELECT * FROM itemcodes WHERE itemdesc LIKE '%" . $desc . "%' LIMIT 100";
        $code = $this->con->prepare($sql);


        $code->execute();
        return $code;
    }

    public function search_desc($code)
    {
        $sql = "SELECT * FROM itemcodes WHERE itemcode LIKE '%" . $code . "%' LIMIT 100";
        $code = $this->con->prepare($sql);


        $code->execute();
        return $code;
    }

    public function description_bycode()
    {
        $sql = "SELECT itemdesc FROM itemcodes WHERE itemcode = ?";
        $desc = $this->con->prepare($sql);

        $desc->bindParam(1, $this->itemcode);

        $desc->execute();
        return $desc;
    }
}
