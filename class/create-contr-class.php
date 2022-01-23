<?php

class CreateContr extends Create
{
    private $nip;
    private $name;
    private $gender;
    private $hp;
    private $email;
    private $password;
    private $file;
    private $fileNameNew;
    private $level;

    public function __construct($nip, $name, $gender, $hp, $email, $password, $file, $level)
    {
        $this->nip = $nip;
        $this->name = $name;
        $this->gender = $gender;
        $this->hp = $hp;
        $this->email = $email;
        $this->password = $password;
        $this->file = $file;
        $this->level = $level;
    }

    public function errorHandling()
    {
        if($this->emptyInput() == false) {
            header("location: ../admin/tambah-admin.php?error=emptyinput&level=" . $this->level);
            exit();
        }

        if($this->invalidName() == false) {
            header("location: ../admin/tambah-admin.php?error=name&level=" . $this->level);
            exit();
        }

        if($this->invalidNip() == false) {
            header("location: ../admin/tambah-admin.php?error=nip&level=" . $this->level);
            exit();
        }

        if($this->invalidPhoneNumber() == false) {
            header("location: ../admin/tambah-admin.php?error=phonenumber&level=" . $this->level);
            exit();
        }

        if($this->invalidEmail() == false) {
            header("location: ../admin/tambah-admin.php?error=email&level=" . $this->level);
            exit();
        }

        if($this->invalidPassword() == false) {
            header("location: ../admin/tambah-admin.php?error=password&level=" . $this->level);
            exit();
        }

        if($this->uidTakenCheck() == false) {
            header("location: ../admin/tambah-admin.php?error=niporemailtaken&level=" . $this->level);
            exit();
        }

        if(!$this->emptyFile() == false) {
            if(!$this->fileError() === false) {
                if(!$this->fileSize() === false) {
                    if($this->fileType() === false) {
                        $msg = "invalidfiletype";
                        header("location: ../admin/tambah-admin.php?error=$msg&level=" . $this->level);
                        exit();
                    }
                } else {
                    $msg = "largefile";
                    header("location: ../admin/tambah-admin.php?error=$msg&level=" . $this->level);
                    exit();
                }
            } else {
                $msg = "erroroccured";
                header("location: ../admin/tambah-admin.php?error=$msg&level=" . $this->level);
                exit();
            }
        }

        $this->setUser($this->nip, $this->name, $this->gender, $this->hp, $this->email, $this->password, $this->fileNameNew, $this->level);
    }

    private function emptyInput()
    {
        if(empty($this->nip) || empty($this->name) || empty($this->gender) || empty($this->hp) || empty($this->email) || empty($this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidName()
    {
        if(!preg_match("/^[a-zA-Z.\s]+$/", $this->name)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidNip()
    {
        if(!preg_match("/^[0-9]{18}$/", $this->nip)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidPhoneNumber()
    {
        if(!preg_match("/^[0-9]*$/", $this->hp)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail()
    {
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidPassword()
    {
        if(!preg_match("/[A-Z][a-z]*[0-9]/", $this->password)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function emptyFile()
    {
        if ($this->file['size'] == 0) {
            $this->fileNameNew = "default-profile-pic.jpg";
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    private function fileError()
    {
        $fileError = $this->file['error'];
        if(!$fileError === 0) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function fileSize()
    {
        $fileSize = $this->file['size'];

        if($fileSize > 2000000) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function fileType()
    {
        $fileTmpName = $this->file['tmp_name'];
        $fileName = $this->file['name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileActualExt = strtolower($fileExt);

        $allowedExt = array("jpg", "jpeg", "png");

        if(!in_array($fileActualExt, $allowedExt)) {
            $result = false;
        } else {
            $this->fileNameNew = uniqid("IMG-", true). '.' . $fileActualExt;
            $fileDestination = '../uploads/' . $this->fileNameNew;
            move_uploaded_file($fileTmpName, $fileDestination);

            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck()
    {
        if(!$this->checkUserinDatabase($this->nip, $this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}