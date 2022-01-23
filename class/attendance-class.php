<?php

class Attendance extends DbConnect
{

    protected function setDataMasuk($nip, $nama, $tanggal, $waktu) {
        $query = $this->connect()->prepare("INSERT INTO tb_absen (nip, nama, tanggal, masuk) VALUES (?, ?, ?, ?);");

        // Check query excecution fail or not
        if(!$query->execute(array($nip, $nama, $tanggal, $waktu))) {
            // if fail, query set to null
            $query = null;
            header("location: ../user/dashboard-user.php?error-queryfailed");
            exit();
        }

        header("location: ../user/dashboard-user.php?error=none");
        exit();
  
    }

    protected function setDataPulang($nip, $waktu) {
        $query = $this->connect()->prepare("UPDATE tb_absen SET pulang = ? WHERE nip = ?;");

        // Check query excecution fail or not
        if(!$query->execute(array($waktu, $nip))) {
            // if fail, query set to null
            $query = null;
            header("location: ../user/dashboard-user.php?error-queryfailed");
            exit();
        }

        header("location: ../user/dashboard-user.php?error=updatework");
        exit();
    }

    protected function checkAttendanceInDatabase($nip, $tanggal) {
        $query = $this->connect()->prepare("SELECT id FROM tb_absen WHERE nip = ? AND tanggal = ?;");

        // Check query excecution fail or not
        if(!$query->execute(array($nip, $tanggal))) {
            // if fail, query set to null
            $query = null;
            header("location: ../user/dashboard-user.php?error=queryfailed");
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