<?php
require_once '../config.php';

class Users {
    private $connect;

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function getMahasiswaLogin($username, $password) {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM mahasiswa WHERE nim = ? AND password = ?");
            $stmt->execute([$username, $password]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getDosenLogin($username, $password) {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM dosen WHERE nidn = ? AND password = ?");
            $stmt->execute([$username, $password]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getAllUsers() {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM mahasiswa UNION ALL SELECT * FROM dosen");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>