<?php
session_start();
require_once '../config.php'; // Include the config file to access the database connection

// Check if the uploads directory exists, if not create it
$uploadDir = '../document/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Create directory with permissions
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idDetail = $_POST['id_detail'];
    $fileType = '';
    $filePath = ''; // To store the file path

    // Handle Surat Pernyataan upload
    if (isset($_FILES['suratPernyataan'])) {
        $fileType = 'suratPernyataan';
    }
    // Handle Tugas Khusus upload
    if (isset($_FILES['tugasKhusus'])) {
        $fileType = 'tugasKhusus';
    }

    if ($fileType) {
        $file = $_FILES[$fileType];
        $originalFileName = basename($file['name']);
        $customFileName = $idDetail . '_' . $fileType . '_' . uniqid() . '.' . pathinfo($originalFileName, PATHINFO_EXTENSION);
        $targetFilePath = $uploadDir . $customFileName;

        // Move the uploaded file to the uploads directory
        if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
            // Save the file path in the database based on file type
            $filePath = $customFileName; // Save the custom file name directly
            if ($fileType == 'suratPernyataan') {
                $updateColumn = 'surat';
            } elseif ($fileType == 'tugasKhusus') {
                $updateColumn = 'pengumpulan_tgsKhusus';
            }

            // Insert the file path into the database
            $stmt = $connect->prepare("UPDATE DETAIL_PELANGGARAN SET $updateColumn = :filePath WHERE id_detail = :idDetail");
            $stmt->bindValue(':filePath', $filePath);
            $stmt->bindValue(':idDetail', $idDetail, PDO::PARAM_INT);

            if ($stmt->execute()) {
                // Update status to 'dikumpulkan'
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