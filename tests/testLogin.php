<?php
declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include "class/dbconnect-class.php";
include "class/login-class.php";
include "class/login-contr-class.php";

class TestLogin extends TestCase
{
    public function test_emptyInput()
    {
        // memasukan input kosong
        $login = new LoginContr("", "");
        $sample = $login->emptyInput();
        // jika menghasilkan false, maka input kosong
        $this->assertFalse($sample);
    }

    public function test_invalidEmail()
    {
        // memasukan input email yang tidak valid
        $login = new LoginContr("user@example", "");
        $sample = $login->invalidEmail();
        // jika menghasilkan false, maka email tidak valid
        $this->assertFalse($sample);
    }

    public function test_invalidPassword()
    {
        // memasukan input password yang tidak sesuai syarat
        $login = new LoginContr("", "guru123");
        $sample = $login->invalidPassword();
        // jika menghasilkan false, maka password tidak sesuai syarat
        $this->assertFalse($sample);
    }
}