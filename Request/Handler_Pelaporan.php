<?php
session_start();
require_once '../config.php';
require_once '../Controllers/PelanggaranController.php';

try {
   $pelanggaranController = new PelanggaranController();

   $result = $pelanggaranController->simpanDetailPelanggaran(
       $_SESSION['user_data']['nidn'],
       $_POST['jenisPelanggaran'],
       $_POST['nim'],
       $_POST['sanksi'],
       $_POST['deskripsiPelanggaran'],
       $_POST['deskripsiTugas'] ?? null,
       null,
       'Pending',
       'Belum Dikumpulkan'
    );

} catch (Exception $e) {
   error_log('Pelanggaran Save Error: ' . $e->getMessage());
   $_SESSION['error_messages'] = [$e->getMessage()];
}

header("Location: ../views/pelanggaran_dosen.php");
exit();
?>
