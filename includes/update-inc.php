<?php

include "../class/dbconnect-class.php";
include "../class/update-class.php";
include "../class/update-contr-class.php";

if(isset($_POST['submit'])) { 

    // Mengambil data dari signup.php
    $hp = $_POST['hp'];
    $email = $_POST['email'];

    // Deklarasi Objek
    $createObj = new UpdateContr($hp, $email); 
    $createObj->errorHandling();

    // header("location: ../admin/tambah-guru-admin.php?error=none");
}