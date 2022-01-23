<?php

include "../class/dbconnect-class.php";
include "../class/login-class.php";
include "../class/login-contr-class.php";

if(isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginObj = new LoginContr($email, $password);
    $loginObj->errorHandling();
}