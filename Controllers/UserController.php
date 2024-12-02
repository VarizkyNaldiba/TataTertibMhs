<?php
require_once '../config.php';
require_once '../Models/Users.php';

class UserController {
    private $connect;

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function login($username, $password) {
        if (!$this->connect) {
            throw new Exception("Database connection failed");
        }
        
        try {
            // Check if login is using NIM (mahasiswa)
            $stmt = $this->connect->prepare("SELECT * FROM mahasiswa WHERE nim = ? AND password = ?");
            $stmt->execute([$username, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Mahasiswa login successful
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = 'mahasiswa';
                $_SESSION['user_data'] = $user; // Store user data in session
                header("Location: pelanggaranpage.php");
                exit();
            }

            // If not found in mahasiswa, check dosen table
            $stmt = $this->connect->prepare("SELECT * FROM dosen WHERE nip = ? AND password = ?");
            $stmt->execute([$username, $password]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                // Dosen login successful
                session_start(); 
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = 'dosen';
                $_SESSION['user_data'] = $user; // Store user data in session
                header("Location: pelanggaran_dosen.php");
                exit();
            }

            return false;

        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: login.php");
        exit();
    }
}
?>