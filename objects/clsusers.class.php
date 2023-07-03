<?php

class Users
{

    private $con;


    public function __construct($db)
    {
        $this->con = $db;
    }

    public function register()
    {
        $sql = "INSERT INTO users SET firstname=?, lastname=?, email=?, username=?, password=?, account_type=?, log=?,status=?";
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->firstname);
        $ins->bindParam(2, $this->lastname);
        $ins->bindParam(3, $this->email);
        $ins->bindParam(4, $this->username);
        $ins->bindParam(5, $this->password);
        $ins->bindParam(6, $this->account_type);
        $ins->bindParam(7, $this->log);
        $ins->bindParam(8, $this->status);

        return ($ins->execute()) ? true : false;
    }

    public function check_email()
    {
        $sql = "SELECT email FROM users WHERE email = ?";
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->email);

        return ($sel->execute()) ? true : false;
    }

    public function login()
    {
        $sql = "SELECT * FROM users WHERE username= ? AND password= ? AND status != ?";
        $login = $this->con->prepare($sql);

        $login->bindParam(1, $this->username);
        $login->bindParam(2, $this->password);
        $login->bindParam(3, $this->status);

        $login->execute();
        return $login;
    }

    public function logout()
    {
        session_start();
        if (session_destroy()) {
            return true;
            unset($_SESSION['username']);
        }
    }

    public function update_current_logged()
    {
        $sql = "UPDATE users SET firstname=?, lastname=?, username=?, password=?, log=? WHERE id=?";
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->firstname);
        $upd->bindParam(2, $this->lastname);
        $upd->bindParam(3, $this->username);
        $upd->bindParam(4, $this->password);
        $upd->bindParam(5, $this->log);
        $upd->bindParam(6, $this->id);

        return ($upd->execute()) ? true : false;
    }
    public function update_details_only()
    {
        $sql = "UPDATE users SET firstname=?, lastname=?, username=? WHERE id=?";
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->firstname);
        $upd->bindParam(2, $this->lastname);
        $upd->bindParam(3, $this->username);
        $upd->bindParam(4, $this->id);

        return ($upd->execute()) ? true : false;
    }

    public function update_user()
    {
        $sql = "UPDATE users SET firstname = ?, lastname = ?, email=?, account_type=?, username=? WHERE id=?";
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->firstname);
        $upd->bindParam(2, $this->lastname);
        $upd->bindParam(3, $this->email);
        $upd->bindParam(4, $this->account_type);
        $upd->bindParam(5, $this->username);
        $upd->bindParam(6, $this->id);

        return ($upd->execute()) ? true : false;
    }
    public function recover_account()
    {
        $sql = "UPDATE users SET password = ? WHERE email = ? AND status != ?";
        $recover = $this->con->prepare($sql);

        $recover->bindParam(1, $this->password);
        $recover->bindParam(2, $this->email);
        $recover->bindParam(3, $this->status);

        return ($recover->execute()) ? true : false;
    }

    public function view_by_email()
    {
        $sql = "SELECT * FROM users WHERE email = ? AND status != ?";
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->email);
        $view->bindParam(2, $this->status);

        $view->execute();
        return $view;
    }

    public function email_by_id()
    {
        $sql = "SELECT id FROM users WHERE email = ? AND status != ?";
        $byid = $this->con->prepare($sql);

        $byid->bindParam(1, $this->email);
        $byid->bindParam(2, $this->status);

        $byid->execute();
        return $byid;
    }

    public function change_password()
    {
        $sql = "UPDATE users SET password=?, log=? WHERE id=? AND status != 0";
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->password);
        $upd->bindParam(2, $this->log);
        $upd->bindParam(3, $this->id);

        return ($upd->execute()) ? true : false;
    }

    public function update_log()
    {
        $sql = "UPDATE users SET log=? WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE . PDO::ERRMODE_WARNING);
        $log = $this->con->prepare($sql);

        $log->bindParam(1, $this->log);
        $log->bindParam(2, $this->id);

        return ($log->execute()) ? true : false;
    }

    public function check_log()
    {
        $sql = "SELECT log FROM users WHERE id =?";
        $ch = $this->con->prepare($sql);

        $ch->bindParam(1, $this->id);

        $ch->execute();
        return $ch;
    }
}
