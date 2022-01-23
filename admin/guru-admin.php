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
                <span class="text">Guru</span>
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
                        <span>Data Umum</span>
                    </li>
                    <li>
                        <span>/</span>
                        <span>Guru</span>
                    </li>
                </ul>
            </div>
            <div class="page-content">
                <div class="fill-blank"></div>

                <div class="content-details">
                    <div class="head-content">
                        <a href="tambah-admin.php?level=2">Tambah</a>
                    </div>

                    <div class="table-wrap">
                        <table class="content-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>NIP</th>
                                    <th>Foto</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Jenis Kelamin</th>
                                    <th>No.HP</th>
                                    <th>Pilihan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $readObj = new Read($_SESSION['id']);
                                    $rows = $readObj->getTeacherData();
                                ?>

                                <?php $i = 1; ?>
                                <?php foreach($rows as $row) : ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $row['nip']; ?></td>
                                            <td><img src="../uploads/<?= $row['gambar']; ?>"></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['email']; ?></td>
                                            <td><?= $row['jenis_kelamin']; ?></td>
                                            <td><?= $row['no_hp']; ?></td>
                                            <td>
                                                <a href="update-guru-admin.php?id=<?= $row['user_id']; ?>" class="edit"><i class='bx bx-edit-alt'></i></a>
                                                <a href="../includes/delete-inc.php?id=<?= $row['user_id']; ?>&level=2" class="delete"><i class='bx bx-trash' ></i></a>
                                            </td>
                                        </tr>
                                    <?php $i++; ?>
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