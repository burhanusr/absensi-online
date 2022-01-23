<?php

class LoginContr extends Login
{
    private $email;
    private $password;


    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }

    public function errorHandling()
    {
        if($this->emptyInput() == false) {

            header("location: ../index.php?error=empty");
            exit();
        }

        if($this->invalidEmail() == false) {
            header("location: ../index.php?error=email");
            exit();
        }

        if($this->invalidPassword() == false) {
            header("location: ../index.php?error=password");
            exit();
        }

        // If there is no error, continue with getting user data
        $this->getUser($this->email, $this->password);
    }

    public function emptyInput()
    {
        if(empty($this->email) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function invalidEmail()
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    public function invalidPassword()
    {
        $result = false;
        if(!preg_match("/[A-Z][a-z]*[0-9]/", $this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}