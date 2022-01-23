<?php

class UpdateContr extends Update
{
    private $hp;
    private $email;

    public function __construct($hp, $email)
    {
        $this->hp = $hp;
        $this->email = $email;

    }

    public function errorHandling()
    {
        $this->updateData($this->hp, $this->email);
    }

   
}