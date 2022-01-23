<?php

include "../class/dbconnect-class.php";
include "../class/edit-class.php";
include "../class/edit-contr-class.php";

if(isset($_POST['tambah'])) { 

    // Mengambil data dari signup.php
    $nip = $_POST['nip'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $file = $_FILES['image'];
    $level = $_GET['level'];
    $id = $_GET['id'];

    // Set url to pass error messege
switch($level) {
    case 2:
        $url = "update-guru-admin.php";
        break;
    case 3:
        $url = "update-kepsek-admin.php";
        break;
}
 

    // Deklarasi Objek
    $editObj = new EditContr($nip, $name, $gender, $hp, $email, $file, $url, $id, $level);

    $editObj->errorHandling();

    // header("location: ../admin/tambah-guru-admin.php?error=none");
}