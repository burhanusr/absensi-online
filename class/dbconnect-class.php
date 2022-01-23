<?php

class DbConnect {

    protected function connect() {
        try {
            $uname = "root";
            $password = "";
            $dbCon = new PDO('mysql:host=localhost;dbname=absensi_db', $uname, $password);
            return $dbCon;
        }
        catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br>";
            die();
        }
    }
}

?>