<?php
 session_start();
 if (!isset($_SESSION['name'])) {
     header("Location: ../index.php");
 }

include "../class/read-class.php";
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
                <span class="text">Edit</span>
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
                        <span>Kepala Sekolah</span>
                    </li>
                    <li>
                        <span>/</span>
                        <span>Edit</span>
                    </li>
                </ul>
            </div>
            <div class="page-add">
                <div class="fill-blank">

                </div>
                <div class="content-details">
                    <div class="content-wrap">
                    <?php
                        if(isset($_GET['id'])) {
                            $id = $_GET['id'];
                        
                            $updateObj = new Read($id);
                        
                            $rows = $updateObj->getUserHeadmaster();
                        }
                    ?>

                        <form action="../includes/edit-inc.php?id=<?= $id ?>&level=3" method="POST" enctype="multipart/form-data">
                            <!-- FORM - NIP -->
                            <div class="input-form">
                                <label for="nip">NIP</label>
                                <input type="text" class="form nip" name="nip" placeholder="NIP" id="nip" value="<?= $rows['nip']; ?>">
                            </div>
                            <!-- FORM - NAME -->
                            <div class="input-form">
                                <label for="name">Nama Guru</label>
                                <input type="text" class="form name" name="name" placeholder="Name" id="name" value="<?= $rows['nama']; ?>">
                            </div>

                            <div class="flex">
                               
                                <!-- FORM - GENDER -->
                                <div class="gender-wrap">
                                    <span>Jenis Kelamin</span>
                                    <div class="radio">
                                        <div class="radio-form">
                                            <?php if($rows['jenis_kelamin'] == "Laki-laki") :?>
                                                <input type="radio" class="form gender" name="gender" id="male" value="Laki-laki" <?="checked"?>>
                                                <label for="male">Laki-laki</label>
                                            <?php else: ?>
                                                <input type="radio" class="form gender" name="gender" id="male" value="Laki-laki">
                                                <label for="male">Laki-laki</label>
                                            <?php endif; ?>
                                        </div>
                                        <div class="radio-form">
                                            <?php if($rows['jenis_kelamin'] == "Perempuan") :?>
                                                <input type="radio" class="form gender" name="gender" id="female" value="Perempuan" <?="checked"?>>
                                                <label for="female">Perempuan</label>
                                            <?php else: ?>
                                                <input type="radio" class="form gender" name="gender" id="female" value="Perempuan">
                                                <label for="female">Perempuan</label>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- FORM - NO HP -->
                                <div class="handphone">
                                    <div class="input-form">
                                        <label for="hp">Nomor Hp</label>
                                        <input type="text" class="form hp" name="hp" placeholder="Nomor Hp" id="hp" value="<?= $rows['no_hp']; ?>">
                                    </div> 
                                </div>
                            </div>
                            
                            <!-- FORM - EMAIL -->
                            <div class="input-form">
                                <label for="email">Email</label>
                                <input type="text" class="form email" name="email" placeholder="Email" id="email" value="<?= $rows['email']; ?>">
                            </div>
                            <!-- FORM - IMAGE -->
                            <div class="file-form">
                                <label for="gambar">Foto</label>
                                <div class="profile-image"><img src="../uploads/<?= $rows['gambar']; ?>" alt=""></div>
                                <input type="file" class="form image" name="image" id="gambar" accept="image/png, image/jpeg" value="<?= $rows['gambar']; ?>">
                            </div>
                            
                            <!-- FORM - BUTTON --> 
                            <div class="btn-form">
                                <a href="kepala-sekolah-admin.php">Batal</a>
                                <button class="form btn-submit" type="submit" name="tambah">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="../js/sidebar.js"></script>
</body>
</html>