<?php
 session_start();
 if (!isset($_SESSION['name'])) {
     header("Location: ../index.php");
 }

require "../class/read-class.php";

if(isset($_SESSION['id'])) {
    $id = $_SESSION['id'];

    $readObj = new Read($id);
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
    <link rel="stylesheet" href="../css/admin/section-read.css">

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
                <span class="text">Rekap Absen</span>
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
        <div class="page-container">
            <div class="page-header">
                <ul class="page-link">
                    <li>
                        <i class='bx bx-home'></i>
                        <span>Dashboard</span>
                    </li>
                    <li>
                        <span>/</span>
                        <span>Rekap Absen</span>
                    </li>
                </ul>
            </div>
            <div class="page-content">
                <div class="fill-blank"></div>
                <div class="content-details">
                    <div class="head-content">
                        <form action="" method="POST">
                            <label for="date">Daftar Kehadiran : </label>
                            <?php 
                                date_default_timezone_set('Asia/Jakarta');

                                $time = new DateTime();
                                $todayDate = $time->format("Y-m-d");
                            
                            ?>
                            <input type="date" id="date" name="tanggal" value="<?= $todayDate ?>">
                            <button type="submit" name="submit">Cari</button>
                        </form>
                    </div>
                    <div class="table-wrap rekap">
                        <table class="content-table rekap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Tanggal</th>
                                    <th>Masuk</th>
                                    <th>Pulang</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <!-- Ketika halaman baru dimuat -->
                                <?php $i = 1; ?>
                                <?php if(!isset($_POST['submit'])) :
                                        $rows = $readObj->getAbsenData();
                                        foreach($rows as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['nip']; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['tanggal']; ?></td>
                                                <td><?= $row['masuk']; ?></td>
                                                <td><?= $row['pulang']; ?></td>
                                            </tr>
                                <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>

                            <!-- Jika time range sudah dipilih -->
                                <?php $i = 1;
                                    if(isset($_POST['submit'])) :
                                        $rows = $readObj->getSelectedAbsenData($_POST['tanggal']);
                                        foreach($rows as $row) : ?>
                                            <tr>
                                                <td><?= $i; ?></td>
                                                <td><?= $row['nip']; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= $row['tanggal']; ?></td>
                                                <td><?= $row['masuk']; ?></td>
                                                <td><?= $row['pulang']; ?></td>
                                            </tr>
                                <?php $i++; ?>
                                    <?php endforeach; ?>
                                <?php endif; ?>      
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