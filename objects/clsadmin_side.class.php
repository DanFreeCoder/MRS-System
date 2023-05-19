<?php
class admin_side
{
    private $con;

    public function __construct($db)
    {
        $this->con = $db;
    }

    public function submitted_form()
    {
        $sql = "SELECT generateddata.id, generateddata.date_added, generateddata.user_id, projects.Project, type_of_project.project_type, CONCAT(class_of_item.class_item_id, '-', class_of_item.items) as classif, generateddata.sub_class, cip_type.cip_account as cip_name, generateddata.con_num, CONCAT(users.firstname, ' ', users.lastname)as user FROM generateddata, projects, type_of_project, class_of_item, cip_type, users WHERE generateddata.project = projects.id AND generateddata.typeof_project = type_of_project.id AND generateddata.classification = class_of_item.class_item_id  AND generateddata.cip_account = cip_type.id AND generateddata.user_id = users.id AND generateddata.status != 4 AND generateddata.status != 2 AND generateddata.status != 0 ORDER BY generateddata.id DESC";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $select = $this->con->prepare($sql);

        $select->execute();
        return $select;
    }

    public function users()
    {
        $sql = "SELECT * FROM users";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $users = $this->con->prepare($sql);

        $users->execute();
        return $users;
    }

    public function data_submit()
    {
        $sql = "SELECT * FROM generateddata WHERE status != 0 AND id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    public function delete_submitted()
    {
        $sql = "UPDATE generateddata SET status = ? WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->status);
        $del->bindParam(2, $this->id);

        if ($del->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function add_user()
    {
        $sql = "INSERT INTO users SET firstname = ?, lastname = ?, email = ?, username = ?, password = ?, account_type = ?, status = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->firstname);
        $ins->bindParam(2, $this->lastname);
        $ins->bindParam(3, $this->email);
        $ins->bindParam(4, $this->username);
        $ins->bindParam(5, $this->password);
        $ins->bindParam(6, $this->account_type);
        $ins->bindParam(7, $this->status);

        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function view_user()
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $view = $this->con->prepare($sql);

        $view->bindParam(1, $this->id);

        $view->execute();
        return $view;
    }
    public function remove_user()
    {
        $sql = "UPDATE users SET status = 0 WHERE id= ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->id);

        if ($del->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function projects()
    {
        $sql = "SELECT * FROM projects WHERE status != 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    public function Project_type()
    {
        $sql = "SELECT * FROM type_of_project WHERE status != 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    public function Classification()
    {
        $sql = "SELECT * FROM class_of_item WHERE status != 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    public function CIP_types()
    {
        $sql = "SELECT * FROM cip_type WHERE status != 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    public function project_code()
    {
        $sql = "SELECT * FROM project_code WHERE status != 0";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    public function add_projects()
    {
        $sql = "INSERT INTO projects SET Project = ?, status = 1";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->project);

        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function add_proj_type()
    {
        $sql = "INSERT INTO type_of_project SET project_type = ?, status = 1";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->project_type);

        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function add_classification()
    {
        $sql = "INSERT INTO class_of_item SET class_item_id= ?, items=?, status = 1";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->class_item_id);
        $ins->bindParam(2, $this->items);

        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function add_cip()
    {
        $sql = "INSERT INTO cip_type SET cip_id= ?, cip_account=?, status = 1";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->cip_id);
        $ins->bindParam(2, $this->cip_account);

        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function add_pro_code()
    {
        $sql = "INSERT INTO project_code SET proj_code = ?, status = 1";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->proj_code);

        if ($ins->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function edit_project()
    {
        $sql = "SELECT Project FROM projects WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $edit = $this->con->prepare($sql);

        $edit->bindParam(1, $this->id);

        $edit->execute();
        return $edit;
    }
    public function edit_project_type()
    {
        $sql = "SELECT project_type FROM type_of_project WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $edit = $this->con->prepare($sql);

        $edit->bindParam(1, $this->id);

        $edit->execute();
        return $edit;
    }
    public function edit_classification()
    {
        $sql = "SELECT class_item_id, items FROM class_of_item WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $edit = $this->con->prepare($sql);

        $edit->bindParam(1, $this->id);

        $edit->execute();
        return $edit;
    }
    public function edit_cip()
    {
        $sql = "SELECT cip_id, cip_account FROM cip_type WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $edit = $this->con->prepare($sql);

        $edit->bindParam(1, $this->id);

        $edit->execute();
        return $edit;
    }
    public function edit_pro_code()
    {
        $sql = "SELECT proj_code FROM project_code WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $edit = $this->con->prepare($sql);

        $edit->bindParam(1, $this->id);

        $edit->execute();
        return $edit;
    }
    public function remove_project()
    {
        $sql = "UPDATE projects SET status = 0 WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->id);

        $del->execute();
        return $del;
    }
    public function remove_project_type()
    {
        $sql = "UPDATE type_of_project SET status = 0 WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->id);

        $del->execute();
        return $del;
    }
    public function remove_classification()
    {
        $sql = "UPDATE class_of_item SET status = 0 WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->id);

        $del->execute();
        return $del;
    }

    public function approver()
    {
        $sql = "SELECT approver FROM generateddata WHERE id=? AND user_id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $app = $this->con->prepare($sql);

        $app->bindParam(1, $this->id);
        $app->bindParam(2, $this->user_id);

        $app->execute();
        return $app;
    }
    public function remove_cip()
    {
        $sql = "UPDATE cip_type SET status = 0 WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->id);

        $del->execute();
        return $del;
    }
    public function remove_pro_code()
    {
        $sql = "UPDATE project_code SET status = 0 WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->id);

        $del->execute();
        return $del;
    }
    public function update_projects()
    {
        $sql = "UPDATE projects SET Project = ? WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->Project);
        $upd->bindParam(2, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function update_proj_type()
    {
        $sql = "UPDATE type_of_project SET project_type = ? WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->project_type);
        $upd->bindParam(2, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function update_classification()
    {
        $sql = "UPDATE class_of_item SET class_item_id= ?, items=? WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->class_item_id);
        $upd->bindParam(2, $this->items);
        $upd->bindParam(3, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function update_cip()
    {
        $sql = "UPDATE cip_type SET cip_id= ?, cip_account=? WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->cip_id);
        $upd->bindParam(2, $this->cip_account);
        $upd->bindParam(3, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }
    public function update_pro_code()
    {
        $sql = "UPDATE project_code SET proj_code = ? WHERE id=?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->proj_code);
        $upd->bindParam(2, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function remove_items()
    {
        $sql = "UPDATE item_description SET status=? WHERE id= ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $remove  = $this->con->prepare($sql);

        $remove->bindParam(1, $this->status);
        $remove->bindParam(2, $this->id);

        if ($remove->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_generated_form()
    {
        $sql = "UPDATE generateddata SET project = ?, typeof_project = ?, classification = ?, sub_class = ?, cip_account = ?, approver = ? WHERE id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->project);
        $upd->bindParam(2, $this->typeof_project);
        $upd->bindParam(3, $this->classification);
        $upd->bindParam(4, $this->sub_class);
        $upd->bindParam(5, $this->cip_account);
        $upd->bindParam(6, $this->approver);
        $upd->bindParam(7, $this->id);

        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function update_generated_form_item()
    {
        $sql = "UPDATE item_description SET qty =?, oum = ?, itemcode = ?, description = ?, remarks = ? WHERE item_id = ? AND id =? AND user_id = ?";
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        $upd = $this->con->prepare($sql);
        $upd->bindParam(1, $this->qty);
        $upd->bindParam(2, $this->oum);
        $upd->bindParam(3, $this->itemcode);
        $upd->bindParam(4, $this->description);
        $upd->bindParam(5, $this->remarks);
        $upd->bindParam(6, $this->item_id);
        $upd->bindParam(7, $this->id);
        $upd->bindParam(8, $this->user_id);


        if ($upd->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
