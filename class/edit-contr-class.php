<?php

class EditContr extends Edit
{
    private $nip;
    private $name;
    private $gender;
    private $hp;
    private $email;

    private $file;
    private $fileNameNew;
    private $url;
    private $id;
    private $level;


    public function __construct($nip, $name, $gender, $hp, $email, $file, $url, $id, $level)
    {
        $this->nip = $nip;
        $this->name = $name;
        $this->gender = $gender;
        $this->hp = $hp;
        $this->email = $email;

        $this->file = $file;
        $this->url = $url;
        $this->id = $id;
        $this->level = $level;
   
    }

    public function errorHandling()
    {
        if($this->emptyInput() == false) {
            header("location: ../admin/" . $this->url . "?error=emptyinput&id=$this->id");
            exit();
        }

        if($this->invalidNip() == false) {
            header("location: ../admin/" . $this->url . "?error=nip&id=" . $this->id);
            exit();
        }

        if($this->invalidPhoneNumber() == false) {
            header("location: ../admin/" . $this->url . "?error=phonenumber&id=" . $this->id);
            exit();
        }

        if($this->invalidEmail() == false) {
            header("location: ../admin/" . $this->url . "?error=email&id=" . $this->id);
            exit();
        }

        if(!$this->emptyFile() == false) {
            if(!$this->fileError() === false) {
                if(!$this->fileSize() === false) {
                    if($this->fileType() === false) {
                        $msg = "invalidfiletype";
                        header("location: ../admin/" . $this->url . "?error=$msg&id=" . $this->id);
                        exit();
                    }
                } else {
                    $msg = "largefile";
                    header("location: ../admin/" . $this->url . "?error=$msg&id=" . $this->id);
                    exit();
                }
            } else {
                $msg = "erroroccured";
                header("location: ../admin/" . $this->url . "?error=$msg&id=" . $this->id);
                exit();
            }
        }

        $this->updateData($this->nip, $this->name, $this->gender, $this->hp, $this->email, $this->fileNameNew, $this->url, $this->id, $this->level);
    }

    private function emptyInput()
    {
        if(empty($this->nip) || empty($this->name) || empty($this->gender) || empty($this->hp) || empty($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidNip()
    {
        if(!preg_match("/^[0-9]*$/", $this->nip)) {
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

}