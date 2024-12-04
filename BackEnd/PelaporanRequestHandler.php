<?php
session_start();
require_once '../config.php';
require_once '../Controllers/PelanggaranController.php';

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    // Check if user is logged in and is a dosen
    if (!isset($_SESSION['user_data']) || $_SESSION['user_type'] !== 'dosen') {
        throw new Exception("Akses ditolak. Silakan login sebagai dosen.");
    }

    // Ensure it's a POST request
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Metode request tidak valid");
    }

    // Validate required inputs
    $requiredFields = [
        'nim' => 'NIM',
        'jenisPelanggaran' => 'Jenis Pelanggaran',
        'sanksi' => 'Sanksi',
        'deskripsiPelanggaran' => 'Deskripsi Pelanggaran'
    ];

    $errors = [];
    foreach ($requiredFields as $field => $label) {
        if (empty($_POST[$field])) {
            $errors[] = "$label harus diisi";
        }
    }

    if (!empty($errors)) {
        throw new Exception(implode(", ", $errors));
    }

    // Create controller instance
    $pelanggaranController = new PelanggaranController();

    // Prepare data for saving
    $result = $pelanggaranController->simpanDetailPelanggaran(
        $_SESSION['user_data']['nidn'],       // NIDN Dosen
        $_POST['jenisPelanggaran'],           // ID Tata Tertib
        $_POST['nim'],                        // NIM Mahasiswa
        $_POST['sanksi'],                     // ID Sanksi
        null,                                 // Tugas Khusus (optional)
        $_POST['deskripsiTugas'] ?? null,     // Detail Tugas (optional)
        null,                                 // Surat (optional)
        'pending'                             // Status default
    );

    // Check result and set appropriate session message
    if ($result['success']) {
        $_SESSION['success_message'] = $result['message'] ?? 'Berhasil menyimpan pelanggaran';
    } else {
        throw new Exception($result['message'] ?? 'Gagal menyimpan pelanggaran');
    }

} catch (Exception $e) {
    // Log error
    error_log('Pelanggaran Save Error: ' . $e->getMessage());
    
    // Set error message in session
    $_SESSION['error_messages'] = [$e->getMessage()];
}

// Always redirect back to the page
header("Location: ../views/pelaporan.php");
exit();
?>