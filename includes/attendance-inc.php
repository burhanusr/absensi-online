<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../index.php");
}

include "../class/dbconnect-class.php";
include "../class/attendance-class.php";
include "../class/attendance-contr-class.php";

if(isset($_POST['masuk'])) {

    $nip = $_POST['nip'];
    $nama = $_SESSION['name'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['time'];

    $attObj = new AttendanceContr($nip, $nama, $tanggal, $waktu);
    $attObj->masuk();
}

if(isset($_POST['pulang'])) {

    $nip = $_POST['nip'];
    $nama = $_SESSION['name'];
    $tanggal = $_POST['tanggal'];
    $waktu = $_POST['time'];

    $attObj = new AttendanceContr($nip, $nama, $tanggal, $waktu);
    $attObj->pulang();
}