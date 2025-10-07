<?php
require_once 'User.php';

class Mahasiswa extends User
{
    public function __construct($nama)
    {
        parent::__construct($nama);
        $this->role = "Mahasiswa";
    }
    
    public function getRole()
    {
        return $this->role;
    }
}
?>