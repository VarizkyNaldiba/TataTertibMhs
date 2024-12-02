<?php
require_once '../config.php';
require_once '../Models/Pelanggaran.php';

class PelanggaranController {
    private $pelanggaranModel;

    public function __construct() {
        $this->pelanggaranModel = new Pelanggaran();
    }

    public function getDetailPelanggaranMahasiswa($idMahasiswa) {
        return $this->pelanggaranModel->getDetailPelanggaranMahasiswa($idMahasiswa);
    }
    
    public function getDetailLaporanDosen($idDosen) {
        return $this->pelanggaranModel->getDetailLaporanDosen($idDosen);
    }

    public function simpanDetailPelanggaran($id_tata_tertib, $id_sanksi, $tugas_khusus, $surat, $status) {
        // Ambil ID Dosen dari session atau data user yang login
        session_start();
        $id_dosen = $_SESSION['user_id']; // Asumsi user_id disimpan di session saat login

        // Ambil ID Mahasiswa dari session atau data user yang login
        $id_mahasiswa = $_SESSION['mahasiswa_id']; // Asumsi mahasiswa_id disimpan di session saat login

        // Simpan detail pelanggaran menggunakan model
        $result = $this->pelanggaranModel->simpanDetailPelanggaran($id_dosen, $id_tata_tertib, $id_mahasiswa, $id_sanksi, $tugas_khusus, $surat, $status);
        
        return $result; // Kembalikan hasil penyimpanan
    }
    
    public function updateDetailPelanggaran($id_detail, $status, $tugas_khusus, $surat) {
        // Update detail pelanggaran menggunakan model
        $result = $this->pelanggaranModel->updateDetailPelanggaran($id_detail, $status, $tugas_khusus);
        
        // Logic to handle file upload for surat
        if (isset($_FILES['suratPernyataan']) && $_FILES['suratPernyataan']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../document/"; // Directory to save uploaded files
            $fileName = basename($_FILES['suratPernyataan']['name']);
            $targetFilePath = $targetDir . $fileName;

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['suratPernyataan']['tmp_name'], $targetFilePath)) {
                // Update the surat path in the database
                $this->pelanggaranModel->updateSuratPath($id_detail, $targetFilePath);
            } else {
                return false; // Return false if file upload failed
            }
        }

        return $result; // Return the result of the update operation
    }
}
?>
