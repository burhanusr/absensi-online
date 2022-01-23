<?php

class Create extends DbConnect
{

    protected function setUser($nip, $name, $gender, $hp, $email, $password, $file, $level) {
        $query = $this->connect()->prepare("INSERT INTO tb_users (nama, email, password_hash, nip, no_hp, jenis_kelamin, gambar) VALUES (?, ?, ?, ?, ?, ?, ?);");

        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Check query excecution fail or not
        if(!$query->execute(array($name, $email, $password_hash, $nip, $hp, $gender, $file))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/tambah-admin.php?error-queryfailed");
            exit();
        }

        switch ($level) {
            case 2:
                if(!$this->setUserLevel($email, $level)) {
                    header("location: ../admin/tambah-admin.php?error=fail");
                    exit();
                } else {
                    header("location: ../admin/guru-admin.php?error=none");
                    exit();
                }
                break;
            case 3:
                if(!$this->setUserLevel($email, $level)) {
                    header("location: ../admin/tambah-admin.php?error=fail");
                    exit();
                } else {
                    header("location: ../admin/kepala-sekolah-admin.php?error=none");
                    exit();
                }
                break;
        }

        
        
    }

    protected function setUserLevel($email, $level){
        // Take user id
        $query = $this->connect()->prepare("SELECT id FROM tb_users WHERE email = ?;");

        if(!$query->execute(array($email))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/tambah-admin.php?error=setuserqueryfailed");
            exit();
        }

        $user_id = $query->fetch(PDO::FETCH_ASSOC);

        $queryLevel = $this->connect()->prepare("INSERT INTO tb_group_user (level_id, user_id) VALUES (?, ?);");

        if(!$queryLevel->execute(array($level, $user_id['id']))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/tambah-admin.php?error=setuserqueryfailed");
            exit();
        }

        if($query->rowCount() === 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }

    protected function checkUserInDatabase($nip, $email) {
        $query = $this->connect()->prepare("SELECT id FROM tb_users WHERE nip = ? OR email = ?;");

        // Check query excecution fail or not
        if(!$query->execute(array($nip, $email))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/tambah-guru-admin.php?error=queryfailed");
            exit();
        }
        
        // Check nip and email already taken or not
        if($query->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }
}