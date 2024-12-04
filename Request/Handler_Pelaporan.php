<?php
session_start();
require_once '../config.php';
require_once '../Controllers/PelanggaranController.php';

try {
   if (!isset($_SESSION['user_data']) || $_SESSION['user_type'] !== 'dosen') {
       throw new Exception("Akses ditolak. Silakan login sebagai dosen.");
   }

   if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
       throw new Exception("Metode request tidak valid");
   }

   $requiredFields = ['nim', 'jenisPelanggaran', 'sanksi'];
   $errors = [];

   foreach ($requiredFields as $field) {
       if (empty(trim($_POST[$field] ?? ''))) {
           $errors[] = "$field harus diisi";
       }
   }

   if (!empty($errors)) {
       throw new Exception(implode(", ", $errors));
   }

   $pelanggaranController = new PelanggaranController();

   $result = $pelanggaranController->simpanDetailPelanggaran(
       $_SESSION['user_data']['nidn'],
       $_POST['jenisPelanggaran'],
       $_POST['nim'],
       $_POST['sanksi'],
       $_POST['deskripsiTugas'] ?? null,
       $_POST['deskripsiPelanggaran'],
       null,
       'pending'
    );
    // var_dump($result);

   $_SESSION['success_message'] = $result['success'] 
       ? ($result['message'] ?? 'Berhasil menyimpan pelanggaran')
       : throw new Exception($result['message'] ?? 'Gagal menyimpan pelanggaran');

} catch (Exception $e) {
   error_log('Pelanggaran Save Error: ' . $e->getMessage());
   $_SESSION['error_messages'] = [$e->getMessage()];
}

header("Location: ../views/pelaporan.php");
exit();
?>