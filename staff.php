<?php
require_once 'User.php';
require_once 'Login.php';

class Staff extends User implements Login
{
    protected $departemen;

    public function __construct($nama, $departemen)
    {
        parent::__construct($nama);
        $this->role = "Staff";
        $this->departemen = $departemen;
    }

    public function getRole() {
        return $this->role;
    }

    public function getDepartemen() {
        return $this->departemen;
    }

    public function login($username, $password) {
        if ($password == "1234") {
            echo "Login berhasil untuk staff " . $this->username . "<br>";
            return true;
        } else {
            echo "Login gagal untuk staff " . $this->username . "<br>";
            return false;
        }
    }
}
?>