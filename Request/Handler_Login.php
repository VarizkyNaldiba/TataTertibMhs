<?php
session_start();
require_once '../config.php';
require_once '../Controllers/UserController.php';

$user = new UserController();
try {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $userType = $_POST['user_type'];
        
        if (!$user->login($username, $password)) {
            echo "<div class='alert alert-danger' style='color: red; text-align: center; margin-bottom: 15px;'>
                    Login gagal! Username atau password salah.
                  </div>";
        }
    }
} catch (Exception $e) {
    error_log('Pelanggaran Save Error: ' . $e->getMessage());
    $_SESSION['error_messages'] = [$e->getMessage()];
}
?>