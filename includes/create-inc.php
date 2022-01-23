<?php

include "../class/dbconnect-class.php";
include "../class/create-class.php";
include "../class/create-contr-class.php";

if(isset($_POST['tambah'])) { 

    // Mengambil data dari signup.php
    $nip = $_POST['nip'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $hp = $_POST['hp'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $file = $_FILES['image'];
    $level = $_GET['level'];

    // Deklarasi Objek
    $createObj = new CreateContr($nip, $name, $gender, $hp, $email, $password, $file, $level);

    $createObj->errorHandling();

    // header("location: ../admin/tambah-guru-admin.php?error=none");
}