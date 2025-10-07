<?php
require_once 'User.php';
require_once 'Notifikasi.php';
require_once 'Login.php';  // ✅ Tambahan interface Login

class Dosen extends User implements Notifikasi, Login  // ✅ Hanya satu deklarasi class
{
    public function __construct($nama)
    {
        parent::__construct($nama);
        $this->role = "Dosen";
    }

    public function getRole()
    {
        return $this->role;
    }

    public function kirimNotifikasi($pesan)
    {
        echo "Mengirim notifikasi ke Dosen " . $this->username . ": " . $pesan . "<br>";
    }

    // ✅ Implementasi method dari interface Login
    public function login($username, $password)
    {
        if ($password == "1234") {
            echo "Login berhasil untuk dosen " . $username . "<br>";
            return true;
        } else {
            echo "Login gagal untuk dosen " . $username . "<br>";
            return false;
        }
    }
}
?>
