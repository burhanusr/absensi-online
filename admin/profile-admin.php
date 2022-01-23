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
    <link rel="stylesheet" href="../css/section-profile.css">

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
                <span class="text">Profil</span>
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
        <div class="profile-container">
            <div class="profile-cover"></div>

            <div class="profile-content">
                <?php
                    if(isset($_SESSION['id'])) {
                        $id = $_SESSION['id'];
                    
                        $updateObj = new Read($id);
                    
                        $rows = $updateObj->getUserData();
                    }
                ?>
                <div class="profile">
                    <div class="image">
                        <img src="../uploads/default-profile-pic.jpg" alt="">
                    </div>
                    <div class="name-job">
                        <span class="name"><?= $_SESSION['name'];?></span>
                        <span class="job">Administrator</span>
                    </div>
                </div>
                <div class="profile-details">
                    <div class="wrap">
                    
                        <form action="">
                            <!-- FORM - NIP -->
                            <div class="input-form">
                                <label for="nip">NIP</label>
                                <input type="text" class="form nip" name="nip" id="nip" value="<?= $rows['nip']; ?>">
                            </div>
                            <div class="input-form">
                                <label for="email">Email</label>
                                <input type="email" class="email form" id="email" value="<?= $rows['email']; ?>">
                            </div>
                            <div class="input-form">
                                <label for="hp">Nomor HP</label>
                                <input type="text" class="hp form" id="hp" value="<?= $rows['no_hp']; ?>">
                            </div>
                            <div class="input-form">
                                <label for="gender">Jenis Kelamin</label>
                                <input type="text" class="gender form" id="gender" value="<?= $rows['jenis_kelamin']; ?>">
                            </div>
                        </form>
                        <div class="btn">
                            <button type="submit" name="submit"><i class='bx bx-pencil'></i>Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    

    <script src="../js/sidebar.js"></script>
    
</body>
</html>