<?php
class Database {
    private static $instance = null;
    private $conn;

    private $host = "localhost";
    private $dbname = "akademik_db";
    private $username = "root";
    private $password = "";

    // Constructor private agar hanya bisa diakses dari dalam class
    private function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Koneksi gagal: " . $e->getMessage();
        }
    }

    // Method untuk mendapatkan instance
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Method untuk mengembalikan koneksi
    public function getConnection() {
        return $this->conn;
    }
}
?>;
}