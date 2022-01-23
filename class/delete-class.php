<?php

class Delete extends DbConnect
{
    private $id;
    private $url;

    public function __construct($id, $url)
    {
        $this->id = $id;
        $this->url = $url;
    }

    public function deleteDataUserLevel(){
        $query = $this->connect()->prepare("DELETE FROM tb_group_user WHERE user_id = ?;");

        if(!$query->execute(array($this->id))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/".$this->url."?error=querydeletefail");
            exit();
        }

        $this->deleteDataUser();
    }

    public function deleteDataUser(){
        $query = $this->connect()->prepare("DELETE FROM tb_users WHERE id = ?;");

        if(!$query->execute(array($this->id))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/".$this->url."?error=querydeletefail");
            exit();
        }

        if(!$query->rowCount() > 0) {
            header("location: ../admin/".$this->url."?error=nothingdeleted");
            exit();
        } else {
            header("location: ../admin/".$this->url."?error=none");
            exit();
        }
    }
}