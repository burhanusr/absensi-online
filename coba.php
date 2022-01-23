<?php


$password = "Admin123";
$password_hash = password_hash($password, PASSWORD_DEFAULT);

echo $password_hash;