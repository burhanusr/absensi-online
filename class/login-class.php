<?php

class Login extends DbConnect
{

    protected function getUser($email, $password) {

        $query = $this->connect()->prepare("SELECT * FROM tb_users WHERE email = ?");

        if(!$query->execute(array($email))) {
            $query = null;
            header("location: ../index.php?error=queryfailed");
            exit();
        }
        
        if($query->rowCount() === 0) {
            $query = null;
            header("location: ../index.php?error=emailnotregistered");
            exit();
        }

        $password_hash = $query->fetch(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $password_hash["password_hash"]);

        if($checkPassword === false) {
            $query = null;
            header("location: ../index.php?error=wrongpassword");
            exit();
        } else {
            $query = $this->connect()->prepare("SELECT * FROM tb_users WHERE email = ?");

            if(!$query->execute(array($email))) {
                $query = null;
                header("location: ../index.php?error=queryfailed");
                exit();
            }

            $user = $query->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['name'] = $user['nama'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['nip'] = $user['nip'];
            $this->getUserLevel($email);
        }

        $query = null;
    }

    private function getUserLevel($email)
    {
        $query = $this->connect()->prepare("SELECT tb_user_level.level FROM tb_users 
                                INNER JOIN tb_group_user ON tb_users.id=tb_group_user.user_id 
                                INNER JOIN tb_user_level ON tb_user_level.id=tb_group_user.level_id 
                                WHERE tb_users.email = ?;");

        if(!$query->execute(array($email))) {
            $query = null;
            header("location: ../index.php?error=queryfailed");
            exit();
        }

        if($query->rowCount() === 0) {
            $query = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $level = $query->fetch(PDO::FETCH_ASSOC);
        if($level['level'] === "admin") {
            header("location: ../admin/dashboard-admin.php");
            exit();
        } else if($level['level'] === "guru" || $level['level'] === "kepsek"){
            header("location: ../user/dashboard-user.php");
            exit();
        }
    }

}