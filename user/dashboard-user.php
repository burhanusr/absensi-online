<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../index.php");
}

require "../class/read-class.php";

if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $updateObj = new Read($id);

    $rows = $updateObj->getUserData();
}
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
    <link rel="stylesheet" href="../css/user/section-dashboard.css">

    <title>AbsensiOnline</title>
</head>
<body>

    <?php
        require 'sidebar-user.php';
    ?>

    <header>
        <div class="head-container">
            <div class="head-title">
                <i class='bx bx-menu' ></i>
                <span class="text">Dashboard</span>
            </div>
            <div class="head-profile">
                <a href="profile-user.php">
                    <div class="name-job">
                        <div class="profile-name"><?= $_SESSION['name'];?></div>
 
                    </div>
                    <div class="profile-content">
                        <img src="../uploads/<?= $rows['gambar']; ?>" alt="profile">
                    </div>
                </a> 
            </div>     
        </div>
    </header>

    <section>
        <div class="dashboard-page">
            <div class="container">
                <div class="user-container">
                    <div class="user-content">
                        <h2 class="user-level">Absensi Online</h2>
                        <span class="welcome">Selamat Datang, <?= $_SESSION['name'];?></span>
                    </div>
                </div>

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
            </div>
            
            <div class="content-container">
                <div class="feature-wrap first">
                    <div class="feature-head">
                        <span>Absensi Harian</span>
                    </div>
                    <div class="attendance">
                        <form action="../includes/attendance-inc.php" method="POST">
                            <table>
                                <thead>
                                    <th class="head">Tanggal</th>
                                    <th></th>
                                    <th></th>
                                </thead>
                                <tbody>
                                    <input type="hidden" name="nip" value="<?= $rows['nip'] ?>">
                                    <?php require "input-user.php"; ?>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>

                <div class="feature-wrap second">
                    <div class="feature-head">
                        <span>Daftar Absensi</span>
                    </div>
                    <div class="attendance-list">
                        <table>
                            <thead>
                                <th>NIP</th>
                                <th>Tanggal</th>
                                <th>Masuk</th>
                                <th>Pulang</th>
                            </thead>
                            <tbody>
                                <?php 
                                    $values = $updateObj->getUserAbsen($rows['nip']);
                                    foreach($values as $val) : 
                                ?>
  
                                <tr>
                                    <td><?= $val['nip'] ?></td>
                                    <td><?= $val['tanggal'] ?></td>
                                    <td><?= $val['masuk'] ?></td>
                                    <td><?= $val['pulang'] ?></td>
                                </tr>

                                <?php endforeach; ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <script src="../js/sidebar.js"></script>
    
</body>
</html>