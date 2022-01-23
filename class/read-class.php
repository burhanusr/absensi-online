<?php

require "dbconnect-class.php";

class Read extends DbConnect
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }
    
    public function getTeacherData()
    {
        $sql = "SELECT * FROM `tb_users` INNER JOIN tb_group_user ON tb_users.id = tb_group_user.user_id INNER JOIN tb_user_level ON tb_user_level.id = tb_group_user.level_id WHERE tb_user_level.level = 'guru';";
        $query = $this->connect()->query($sql);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getHeadmasterData()
    {
        $sql = "SELECT * FROM `tb_users` INNER JOIN tb_group_user ON tb_users.id = tb_group_user.user_id INNER JOIN tb_user_level ON tb_user_level.id = tb_group_user.level_id WHERE tb_user_level.level = 'kepsek';";
        $query = $this->connect()->query($sql);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getCountUser()
    {
        $sql = "SELECT COUNT(level_id) FROM tb_group_user WHERE level_id = 2 OR level_id = 3;";
        $query = $this->connect()->query($sql);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getUserTeacher(){
        $query = $this->connect()->prepare("SELECT * FROM tb_users WHERE id = ?;");

        if(!$query->execute(array($this->id))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/guru-admin.php?error=querydeletefail");
            exit();
        }

        if(!$query->rowCount() > 0) {
            header("location: ../admin/guru-admin.php?error=nothingupdated");
            exit();
        } else {
            $userData = $query->fetch(PDO::FETCH_ASSOC);
        }

        return $userData;
    }

    public function getUserHeadmaster(){
        $query = $this->connect()->prepare("SELECT * FROM tb_users WHERE id = ?;");

        if(!$query->execute(array($this->id))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/kepala-sekolah-admin.php?error=querydeletefail");
            exit();
        }

        if(!$query->rowCount() > 0) {
            header("location: ../admin/kepala-sekolah-admin.php?error=nothingupdated");
            exit();
        } else {
            $userData = $query->fetch(PDO::FETCH_ASSOC);
        }

        return $userData;
    }

    public function getUserData(){
        $query = $this->connect()->prepare("SELECT * FROM tb_users WHERE id = ?;");

        if(!$query->execute(array($this->id))) {
            // if fail, query set to null
            $query = null;
            exit();
        }

        if(!$query->rowCount() > 0) {
            // header("location: ../admin/kepala-sekolah-admin.php?error=nothingupdated");
            exit();
        } else {
            $userData = $query->fetch(PDO::FETCH_ASSOC);
        }

        return $userData;
    }

    public function getUserAbsen($nip)
    {
        $sql = "SELECT * FROM `tb_absen` WHERE nip = $nip";
        $query = $this->connect()->query($sql);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getAbsenData()
    {
        $sql = "SELECT * FROM `tb_absen`";
        $query = $this->connect()->query($sql);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getSelectedAbsenData($date)
    {
        $sql = "SELECT * FROM `tb_absen` WHERE tanggal = '$date';";
        $query = $this->connect()->query($sql);

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function getCountAbsen($today)
    {
        $sql = "SELECT COUNT(tanggal) FROM tb_absen WHERE tanggal = '$today';";
        $query = $this->connect()->query($sql);

        $data = $query->fetch(PDO::FETCH_ASSOC);

        return $data;
    }
}

// date_default_timezone_set('Asia/Jakarta');
//                         $time = new DateTime();
//                         $todayDate = $time->format("Y-m-d");

// $read = new Read();
// print_r($read->getCountAbsen($todayDate));
// echo $todayDate;

