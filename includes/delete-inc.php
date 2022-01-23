<?php

include "../class/dbconnect-class.php";
include "../class/delete-class.php";

$id = $_GET['id'];
$level = $_GET['level'];

// Set url to pass error messege
switch($level) {
    case 2:
        $url = "guru-admin.php";
        break;
    case 3:
        $url = "kepala-sekolah-admin.php";
        break;
}

$deleteObj = new Delete($id, $url);
$deleteObj->deleteDataUserLevel();