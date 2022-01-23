<?php

class Edit extends DbConnect
{

    protected function updateData($nip, $name, $gender, $hp, $email, $file, $url, $id, $level) {
        $query = $this->connect()->prepare("UPDATE tb_users SET nama = ?, email = ?, nip = ?, no_hp = ?, jenis_kelamin = ?, gambar = ? WHERE id = ?");

        // Check query excecution fail or not
        if(!$query->execute(array($name, $email, $nip, $hp, $gender, $file, $id))) {
            // if fail, query set to null
            $query = null;
            header("location: ../admin/" . $url . "?error-queryfailed");
            exit();
        }

        switch($level) {
            case 2:
                header("location: ../admin/guru-admin.php?error=none");
                exit();
                break;
            case 3:
                header("location: ../admin/kepala-sekolah-admin.php?error=none");
                exit();
                break;
        }
       
    }
}