<?php

if(isset($_GET['error'])){
    $error = $_GET['error'];
    
    switch ($error) {
        case "empty":
            echo '<p class="error">Username or password is empty!</p>';
            break;
        case "email":
            echo '<p class="error">Invalid email format!</p>';
            break;
        case "password":
            echo '<p class="error">Your Password Must Contain At Least 1 Number or capital letter!</p>';
            break;
        case "wrongpassword":
            echo '<p class="error">You entered wrong password!</p>';
            break;
        case "emailnotregistered":
            echo '<p class="error">Your email is not registered!</p>';
            break;
        case "erroroccured":
            echo '<p class="error">Unknown error occured!</p>';
            break;
        case "largefile":
            echo '<p class="error">Your file is too large!</p>';
            break;
        case "invalidfiletype":
            echo '<p class="error">Invalid file type!</p>';
            break;
        case "updatework":
            echo '<p class="error">Anda sudah mengisi absen pulang!</p>';
            break;
    }

}