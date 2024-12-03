<?php
require_once '../config.php';
require_once '../Models/Users.php';

class UserController {
    private $userModel;

    public function __construct() {
        $this->userModel = new Users();
    }

    public function login($username, $password) {
        try {
            // Check mahasiswa login
            $user = $this->userModel->getMahasiswaLogin($username, $password);
            if ($user) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['user_type'] = 'mahasiswa';
                $_SESSION['user_data'] = $user;
                header("Location: pelanggaranpage.php");
                exit();
            }

            // Check dosen login
            $user = $this->userModel->getDosenLogin($username, $password);
            if ($user) {
                session_start();
                $_SESSION['username'] = $username; 
                $_SESSION['user_type'] = 'dosen';
                $_SESSION['user_data'] = $user;
                header("Location: pelanggaran_dosen.php");
                exit();
            }

            return false;

        } catch(Exception $e) {
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