<?php
require_once '../config.php';
require_once '../Models/Users.php';

function login($username, $password) {
    global $connect;
    
    if (!$connect) {
        throw new Exception("Database connection failed");
    }
    
    try {
        // Check if login is using NIM (mahasiswa)
        $stmt = $connect->prepare("SELECT * FROM mahasiswa WHERE nim = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Mahasiswa login successful
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = 'mahasiswa';
            header("Location: pelanggaranpage.php");
            exit();
        }

        // If not found in mahasiswa, check dosen table
        $stmt = $connect->prepare("SELECT * FROM dosen WHERE nip = ? AND password = ?");
        $stmt->execute([$username, $password]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Dosen login successful
            session_start(); 
            $_SESSION['username'] = $username;
            $_SESSION['user_type'] = 'dosen';
            header("Location: pelanggaranpage.php");
            exit();
        }

        return false;

    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function logout() {
    session_start();
    session_destroy();
    header("Location: login.php");
    exit();
}

?>