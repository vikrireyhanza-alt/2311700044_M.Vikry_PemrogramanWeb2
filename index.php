<?php
require_once 'Mahasiswa.php';
require_once 'Dosen.php';
require_once 'Staff.php';
require_once 'Login.php'; // pastikan interface Login tersedia

// Fungsi tampilkanInfoUser didefinisikan sekali (sebelum dipanggil)
function tampilkanInfoUser(User $user)
{
    echo "Polymorphism: " . $user->getUsername() . " memiliki peran sebagai " . $user->getRole();
    
    // Jika objek adalah Staff, tampilkan departemen juga
    if ($user instanceof Staff) {
        echo " (Departemen: " . $user->getDepartemen() . ")";
    }
    echo "<br>";
}

// Buat object dari Mahasiswa dan Dosen
$mahasiswa = new Mahasiswa('Marcus');
$dosen = new Dosen('Pa Juprianto');

// Tampilkan info dasar
echo "<h2>Info User:</h2>";
echo $mahasiswa->getUsername() . " adalah seorang " . $mahasiswa->getRole() . "<br>";
echo $dosen->getUsername() . " adalah seorang " . $dosen->getRole() . "<br>";

echo "<hr>";

// Demonstrasi Polymorphism
echo "<h2>Demonstrasi Polymorphism:</h2>";
tampilkanInfoUser($mahasiswa);
tampilkanInfoUser($dosen);

echo "<hr>";

// Demonstrasi Interface
echo "<h2>Demonstrasi Interface:</h2>";
$dosen->kirimNotifikasi("Jadwal kuliah besok dibatalkan.");

echo "<hr>";

// Latihan 3: Polymorphism Lebih Kompleks
echo "<h2>Latihan 3: Polymorphism Lebih Kompleks</h2>";

$objects = [
    new Mahasiswa('Marcus'),
    new Dosen('Dr.Bojan'),
    new Staff('Febri', 'IT Support'),
    new Mahasiswa('Kepa'),
    new Dosen('Prof. Jufrianto'),
    new Staff('Ratu Tisha', 'Administrasi')
];

foreach ($objects as $obj) {
    tampilkanInfoUser($obj);
    
    // Jika objek mengimplementasikan Login, panggil login()
    if ($obj instanceof Login) {
        echo "Testing login: ";
        $obj->login($obj->getUsername(), "1234"); // Password benar
        
        echo "Testing login dengan password salah: ";
        $obj->login($obj->getUsername(), "wrong"); // Password salah
    }
    
    echo "---<br>";
}

// Tampilkan info staff terpisah
echo "<h2>Info Staff:</h2>";
$staff = new Staff('Ahmad', 'IT Support');
echo $staff->getUsername() . " adalah seorang " . $staff->getRole() . 
     " di departemen " . $staff->getDepartemen() . "<br>";
?>
