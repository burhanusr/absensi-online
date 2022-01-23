<?php
 session_start();
 if (!isset($_SESSION['name'])) {
     header("Location: ../index.php");
 }

if(isset($_GET['level'])) {
    $level = $_GET['level'];
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
    <link rel="stylesheet" href="../css/admin/section-create.css">


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
                <span class="text">Tambah</span>
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
                        <?php if($level == 2) : ?>
                            <span>/</span>
                            <span>Guru</span>
                        <?php elseif ($level == 3) :?>
                            <span>/</span>
                            <span>Kepala Sekolah</span>
                        <?php endif; ?>
                    </li>
                    <li>
                        <span>/</span>
                        <span>Tambah</span>
                    </li>
                </ul>
            </div>
            <div class="page-add">
                <div class="fill-blank">

                </div>
                <div class="content-details">
                    <div class="content-wrap">
                        <form action="../includes/create-inc.php?level=<?= $level; ?>" method="POST" enctype="multipart/form-data">
                            <!-- FORM - NIP -->
                            <div class="input-form">
                            
                                <label for="nip">NIP</label>
                                <input type="text" class="form nip" name="nip" placeholder="NIP" id="nip">
                            </div>
                            <!-- FORM - NAME -->
                            <div class="input-form">
                                <label for="name">Nama Guru</label>
                                <input type="text" class="form name" name="name" placeholder="Name" id="name">
                            </div>
                            

                            <div class="flex">
                                <!-- FORM - GENDER -->
                                <div class="gender-wrap">
                                    <span>Jenis Kelamin</span>
                                    <div class="radio">
                                        <div class="radio-form">
                                            <input type="radio" class="form gender" name="gender" id="male" value="Laki-laki">
                                            <label for="male">Laki-laki</label>
                                        </div>
                                        <div class="radio-form">
                                            <input type="radio" class="form gender" name="gender" id="female" value="Perempuan">
                                            <label for="female">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <!-- FORM - NO HP -->
                                <div class="handphone">
                                    <div class="input-form">
                                        <label for="hp">Nomor Hp</label>
                                        <input type="text" class="form hp" name="hp" placeholder="Nomor Hp" id="hp">
                                    </div> 
                                </div>
                            </div>
                            
                            <!-- FORM - EMAIL -->
                            <div class="input-form">
                                <label for="email">Email</label>
                                <input type="text" class="form email" name="email" placeholder="Email" id="email">
                            </div>
                            <!-- FORM - PASSWORD -->
                            <div class="input-form">
                                <label for="password">Password</label>
                                <input type="password" class="form password" name="password" placeholder="Password" id="password">
                                <i class='fas fa-eye' id="togglePassword"></i>
                            </div>
                            <!-- FORM - IMAGE -->
                            <div class="file-form">
                                <label for="gambar">Foto</label>
                                <div class="profile-image" id="image_preview"></div>
                                <input type="file" class="form image" name="image" id="gambar" accept="image/png, image/jpeg">
                            </div>
                            
                            <!-- FORM - BUTTON --> 
                            <div class="btn-form">
                                <a href="guru-admin.php">Batal</a>
                                <button class="form btn-submit" type="submit" name="tambah">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="../js/sidebar.js"></script>
    <script src="../js/imagePreview.js"></script>
    <script src="https://kit.fontawesome.com/8355c3a700.js" crossorigin="anonymous"></script>
    <script src="../js/togglePassword.js"></script>
</body>
</html>