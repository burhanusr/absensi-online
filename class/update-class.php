<?php

class Update extends DbConnect
{

    protected function updateData($hp, $email) {
        $query = $this->connect()->prepare("UPDATE tb_users SET no_hp = ? WHERE email = ?");

        // Check query excecution fail or not
        if(!$query->execute(array($hp, $email))) {
            // if fail, query set to null
            $query = null;
            header("location: ../user/profile-user.php?error-queryfailed");
            exit();
        }

        header("location: ../user/profile-user.php?error=none");
        exit();
  
    }
}