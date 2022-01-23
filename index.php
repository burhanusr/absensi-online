

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <!-- CSS -->
    <link rel="stylesheet" href="css/login/style.css">

    <title>Login - AbsensiOnline</title>
</head>
<body>

    <header>
        <div class="head-container">
            <div class="head-logo">
                <a href="#" class="head-brand">
                    <img src="image/absensi_logo.png" alt="">
                </a>
            </div>
        </div>
    </header>

    <section>
        <!-- WARP -->
        <div class="login-container">
            <!-- LEFT CONTENT -->
            <div class="left-content">
                <img src="image/character 20.svg" alt="">
            </div>

            <!-- CENTER CONTENT -->
            <div class="center-content">
                <!-- FORM WARP -->
                <div class="login-form">
                    <!-- FORM HEADER -->
                    <div class="login-form-head">
                        <h4>Selamat Datang</h4>
                    </div>

                    <!-- FORM ERROR MESSEGE -->
                    <?php 
                        require "error.php";
                    ?>
                        
                    <!-- FORM -->
                    <form action="includes/login-inc.php" method="POST">
                        <!-- FORM - EMAIL -->
                        <div class="input-form">
                            <input type="text" class="form email" name="email" placeholder="Email">
                        </div>
                        <!-- FORM - PASSWORD -->
                        <div class="input-form">
                            <input type="password" class="form password" name="password" placeholder="Password" id="password">
                            <div class="icon-pass">
                                <i class="fas fa-eye" id="togglePassword"></i>
                            </div>
                        </div>
                        <!-- FORM - FORGOT PASSWORD -->
                        <div class="pass-reset">
                            <a href="#">Lupa password?</a>
                        </div>
                        <!-- FORM - BUTTON -->
                        <div class="btn-form">
                            <button class="form btn-signup" type="submit" name="login">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RIGHT CONTENT -->
            <div class="right-content">
                <img src="image/character 15.svg" alt="">
            </div>
        </div>
    </section>

    <script src="https://kit.fontawesome.com/8355c3a700.js" crossorigin="anonymous"></script>
    <script src="js/togglePassword.js"></script>
</body>
</html>