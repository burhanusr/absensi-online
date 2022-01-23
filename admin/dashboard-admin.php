<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../index.php");
}

require "../class/read-class.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- BOXICON CDN LINK -->
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

    <!-- CSS -->
    <link rel="stylesheet" href="../css/components/header.css">
    <link rel="stylesheet" href="../css/admin/section-dashboard.css">

    <title>Administrator - AbsensiOnline</title>
</head>
<body>

    <?php
        require 'sidebar-admin.php';
    ?>

    <header>
        <div class="head-container">
            <div class="head-title">
                <i class='bx bx-menu' ></i>
                <span class="text">Dashboard</span>
            </div>
            <div class="head-profile">
                <a href="profile-admin.php">
                    <div class="name-job">
                        <div class="profile-name"><?= $_SESSION['name'];?></div>
                        <div class="job">Administrator</div>
                    </div>
                    <div class="profile-content">
                        <img src="../uploads/default-profile-pic.jpg" alt="profile">
                    </div>
                </a> 
            </div>     
        </div>
    </header>

    <section>
        <div class="dashboard-page">
            <div class="user-container">
                <div class="user-content">
                    <h2 class="user-level">Administrator</h2>
                    <span class="welcome">Selamat Datang, <?= $_SESSION['name'];?></span>
                </div>
            </div>
            <div class="content-container">
                <div class="school-profile">
                    <div class="school-logo">
                        <img src="../image/madrasah.png" alt="">
                    </div>
                    <div class="school-details">
                        <span class="school-name">Nama Sekolah</span>
                        <span>Alamat</span>
                        <span>Telpon</span>
                        <span>Email</span>
                    </div>
                </div>
                <div class="card">
                    <div class="head-card">
                        <i class='bx bx-user'></i>
                        <span>Total Guru</span>
                    </div>
                    <div class="data-card">
                    <?php
                        $readObj = new Read($_SESSION['id']);
                        $count = $readObj->getCountUser();
                    ?>
                        <span><?= $count['COUNT(level_id)'];  ?></span>
                    </div>
                </div>
                <div class="card attendance">
                    <div class="head-card">
                        <i class='bx bx-book'></i>
                        <span>Total Kehadiran</span>
                    </div>
                    <div class="data-card">
                    <?php
                        date_default_timezone_set('Asia/Jakarta');
                        $time = new DateTime();
                        $todayDate = $time->format("Y-m-d");

                        $attendance = $readObj->getCountAbsen($todayDate);
                    ?>
                        <span class="data-date"><?= $todayDate ?></span>
                        <span><?= $attendance['COUNT(tanggal)']; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/sidebar.js"></script>
    
</body>
</html>