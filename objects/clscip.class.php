<?php
class clsType
{
    private $con;
    private $tbl_type_of_project = 'type_of_project';
    private $tbl_project = 'projects';
    private $tbl_CIP_type = 'cip_type';
    private $tbl_classification = 'class_of_item';
    private $tbl_generate = 'generatedData';
    private $tbl_item_description = 'item_description';
    private $tbl_proj_code = 'project_code';


    public function __construct($db)
    {
        $this->con = $db;
    }

    public function get_type_of_project()
    {
        $sql = "SELECT * FROM " . $this->tbl_type_of_project .  " WHERE status != 0";
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    public function projects()
    {
        $sql = "SELECT * FROM " . $this->tbl_project .  " WHERE status != 0";
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }
    public function CIP_type()
    {
        $sql = "SELECT * FROM " . $this->tbl_CIP_type .  " WHERE cip_id = ? AND status != 0";
        $sel = $this->con->prepare($sql);

        $sel->bindParam(1, $this->cip_id);

        $sel->execute();
        return $sel;
    }

    public function CIP_type2()
    {
        $sql = "SELECT * FROM " . $this->tbl_CIP_type .  " WHERE id= ? AND status != 0";
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }
    public function CIP_type3()
    {
        $sql = "SELECT * FROM " . $this->tbl_CIP_type .  " WHERE status != 0";
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    public function get_class()
    {
        $sql = "SELECT * FROM " . $this->tbl_classification .  " WHERE status != 0";
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    public function generate()
    {
        $sql = "INSERT INTO generatedData SET date_added=?, project=?, typeof_project=?, classification=?, sub_class=?, con_num=?, cip_account=?, approver=?, requestor =?, user_id=?, status = ?";
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->date_added);
        $ins->bindParam(2, $this->project);
        $ins->bindParam(3, $this->typeof_project);
        $ins->bindParam(4, $this->classification);
        $ins->bindParam(5, $this->sub_class);
        $ins->bindParam(6, $this->con_num);
        $ins->bindParam(7, $this->cip_account);
        $ins->bindParam(8, $this->approver);
        $ins->bindParam(9, $this->requestor);
        $ins->bindParam(10, $this->user_id);
        $ins->bindParam(11, $this->status);

        return ($ins->execute()) ? true : false;
    }
    public function count_id()
    {
        $sql = "SELECT COUNT(id) + 1 as id FROM generateddata";
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    public function count_draft_id()
    {
        $sql = "SELECT COUNT(id) + 1 as id FROM save_as_draft WHERE status = 4";
        $sel = $this->con->prepare($sql);

        $sel->execute();
        return $sel;
    }

    public function generate_item()
    {
        $sql = "INSERT INTO item_description SET qty=?, oum=?, itemcode=?, description=?, remarks=?, status=?, user_id=?, item_id=?";
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->qty);
        $ins->bindParam(2, $this->oum);
        $ins->bindParam(3, $this->itemcode);
        $ins->bindParam(4, $this->description);
        $ins->bindParam(5, $this->remarks);
        $ins->bindParam(6, $this->status);
        $ins->bindParam(7, $this->user_id);
        $ins->bindParam(8, $this->item_id);

        return ($ins->execute()) ? true : false;
    }
    public function gen_item_in_draft()
    {
        $sql = "INSERT INTO item_description SET item_id=(SELECT COUNT(id) + 1 FROM generateddata as item_id), qty=?, oum=?, itemcode=?, brand=?, description=?, color=?, remarks=?";
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->qty);
        $ins->bindParam(2, $this->oum);
        $ins->bindParam(3, $this->itemcode);
        $ins->bindParam(4, $this->brand);
        $ins->bindParam(5, $this->description);
        $ins->bindParam(6, $this->color);
        $ins->bindParam(7, $this->remarks);

        return ($ins->execute()) ? true : false;
    }

    public function get_proj_code()
    {
        $sql = "SELECT proj_code FROM project_code WHERE id = ?";
        $sel = $this->con->prepare($sql);
        $sel->bindParam(1, $this->id);

        $sel->execute();
        return $sel;
    }

    public function save_as_draft()
    {
        $sql = "INSERT INTO save_as_draft SET date_added=?, project=?, typeof_project=?, classification=?, sub_class=?, cip_account=?, approver=?, requestor=?, user_id=?, status=?";
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->date_added);
        $ins->bindParam(2, $this->project);
        $ins->bindParam(3, $this->typeof_project);
        $ins->bindParam(4, $this->classification);
        $ins->bindParam(5, $this->sub_class);
        $ins->bindParam(6, $this->cip_account);
        $ins->bindParam(7, $this->approver);
        $ins->bindParam(8, $this->requestor);
        $ins->bindParam(9, $this->user_id);
        $ins->bindParam(10, $this->status);

        return ($ins->execute()) ? true : false;
    }

    public function save_as_draft_item()
    {
        $sql = "INSERT INTO item_as_draft SET item_id = (SELECT COUNT(id) as item_id FROM save_as_draft), qty=?, oum=?, itemcode=?, description=?, remarks=?, user_id=?, status=?";
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->qty);
        $ins->bindParam(2, $this->oum);
        $ins->bindParam(3, $this->itemcode);
        $ins->bindParam(4, $this->description);
        $ins->bindParam(5, $this->remarks);
        $ins->bindParam(6, $this->user_id);
        $ins->bindParam(7, $this->status);

        return ($ins->execute()) ? true : false;
    }
    public function update()
    {
        $sql = "UPDATE save_as_draft SET date_added =?, project=?, typeof_project=?, classification=?, sub_class=?, cip_account=?, approver=?, requestor=?, status=? WHERE id = ? AND user_id=?";
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->date_added);
        $upd->bindParam(2, $this->project);
        $upd->bindParam(3, $this->typeof_project);
        $upd->bindParam(4, $this->classification);
        $upd->bindParam(5, $this->sub_class);
        $upd->bindParam(6, $this->cip_account);
        $upd->bindParam(7, $this->approver);
        $upd->bindParam(8, $this->requestor);
        $upd->bindParam(9, $this->status);
        $upd->bindParam(10, $this->id);
        $upd->bindParam(11, $this->user_id);

        return ($upd->execute()) ? true : false;
    }

    public function update_item()
    {
        $sql = "UPDATE item_as_draft SET qty=?, oum=?, itemcode=?, description=?, remarks=? , status=? WHERE item_id = ? AND id = ? AND user_id=?";
        $upd = $this->con->prepare($sql);

        $upd->bindParam(1, $this->qty);
        $upd->bindParam(2, $this->oum);
        $upd->bindParam(3, $this->itemcode);
        $upd->bindParam(4, $this->description);
        $upd->bindParam(5, $this->remarks);
        $upd->bindParam(6, $this->status);
        $upd->bindParam(7, $this->item_id);
        $upd->bindParam(8, $this->id);
        $upd->bindParam(9, $this->user_id);

        return ($upd->execute()) ? true : false;
    }

    public function delete()
    {
        $sql = "UPDATE generateddata SET status = ? WHERE id = ?";
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->status);
        $del->bindParam(2, $this->id);

        return ($del->execute()) ? true : false;
    }
    public function delete_item()
    {
        $sql = "UPDATE item_description SET status = ? WHERE item_id = ?";
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->status);
        $del->bindParam(2, $this->id);

        return ($del->execute()) ? true : false;
    }

    public function remove_draft_id()
    {
        $sql = "UPDATE item_as_draft SET status =? WHERE id = ? AND user_id=?";
        $del = $this->con->prepare($sql);

        $del->bindParam(1, $this->status);
        $del->bindParam(2, $this->id);
        $del->bindParam(3, $this->user_id);

        return ($del->execute()) ? true : false;
    }

    public function gen_after_upd() //generate after update without adding new row
    {
        $sql = "INSERT INTO generateddata SET date_added=?, project=?, typeof_project=?, classification=?, sub_class=?, con_num=?, cip_account=?, approver=?, requestor=?, user_id=?, status = ?";
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->date_added);
        $ins->bindParam(2, $this->project);
        $ins->bindParam(3, $this->typeof_project);
        $ins->bindParam(4, $this->classification);
        $ins->bindParam(5, $this->sub_class);
        $ins->bindParam(6, $this->con_num);
        $ins->bindParam(7, $this->cip_account);
        $ins->bindParam(8, $this->approver);
        $ins->bindParam(9, $this->requestor);
        $ins->bindParam(10, $this->user_id);
        $ins->bindParam(11, $this->status);

        return ($ins->execute()) ? true : false;
    }

    public function gen_after_upd_item()
    {
        $sql = "INSERT INTO item_description SET qty=?, oum=?, itemcode=?, description=?, remarks=?, user_id=?, status=?, item_id=?";
        $ins = $this->con->prepare($sql);

        $ins->bindParam(1, $this->qty);
        $ins->bindParam(2, $this->oum);
        $ins->bindParam(3, $this->itemcode);
        $ins->bindParam(4, $this->description);
        $ins->bindParam(5, $this->remarks);
        $ins->bindParam(6, $this->user_id);
        $ins->bindParam(7, $this->status);
        $ins->bindParam(8, $this->item_id);

        return ($ins->execute()) ? true : false;
    }


    public function submitted_form($sql)
    {
        $view = $this->con->prepare($sql);

        $view->execute();
        return $view;
    }

    public function draft_form($query)
    {
        $view = $this->con->prepare($query);

        $view->execute();
        return $view;
    }
}
