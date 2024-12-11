<?php
session_start();
require_once '../config.php'; // Sertakan file konfigurasi untuk mengakses koneksi database


// Check if the uploads directory exists, if not create it
$uploadDir = '../document/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Buat direktori dengan izin akses
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idDetail = $_POST['id_detail'];
    $fileType = '';
    $filePath = ''; // Untuk menyimpan jalur file

    // Proses upload Surat Pernyataan
    if (isset($_FILES['suratPernyataan'])) {
        $fileType = 'suratPernyataan';
    }
    // Proses upload Tugas Khusus
    if (isset($_FILES['tugasKhusus'])) {
        $fileType = 'tugasKhusus';
    }

    if ($fileType) {
        $file = $_FILES[$fileType];
        $originalFileName = basename($file['name']);
        $customFileName = $idDetail . '_' . $fileType . '_' . uniqid() . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);
        $targetFilePath = $uploadDir . $customFileName;

        // Pindahkan file yang diunggah ke direktori uploads
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            // Simpan jalur file di database berdasarkan jenis file
            $filePath = $customFileName; // Simpan nama file khusus secara langsung
            if ($fileType == 'suratPernyataan') {
                $updateColumn = 'surat';
            } elseif ($fileType == 'tugasKhusus') {
                $updateColumn = 'pengumpulan_tgsKhusus';
            }

            // Masukkan jalur file ke dalam database
            $stmt = $connect->prepare("UPDATE DETAIL_PELANGGARAN SET $updateColumn = :filePath WHERE id_detail = :idDetail");
            $stmt->bindValue(':filePath', $filePath);
            $stmt->bindValue(':idDetail', $idDetail, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Perbarui status menjadi 'dikumpulkan'
                $statusUpdateStmt = $connect->prepare("UPDATE DETAIL_PELANGGARAN SET status = 'dikumpulkan' WHERE id_detail = :idDetail");
                $statusUpdateStmt->bindValue(':idDetail', $idDetail, PDO::PARAM_INT);
                $statusUpdateStmt->execute();

                echo "File berhasil diunggah dan path tersimpan di database: " . $customFileName;
            } else {
                echo "Gagal menyimpan path file di database.";
            }
        } else {
            echo "Gagal mengunggah file.";
        }
    } else {
        echo "Tidak ada file yang diunggah.";
    }
} else {
    echo "Request tidak valid.";
}
?>