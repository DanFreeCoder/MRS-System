<?php

class clsMRFconnection
{

    private $host = 'localhost';
    private $dbname = 'mrfdb';
    private $username = 'root';
    private $password = '';

    protected $con;

    public function connect()
    {
        $this->con = null;

        try {
            $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname, $this->username, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            echo "connection:Error" . $e->getMessage();
        }
        return $this->con;
    }

    public function disconnect()
    {
        $this->con = null;
        return $this->con;
    }
}
