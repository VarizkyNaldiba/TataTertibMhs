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

    public function simpanDetailPelanggaran($id_tata_tertib, $id_sanksi, $tugas_khusus = null, $surat = null, $status = 'pending') {
        // Validate input
        if (!$id_tata_tertib || !$id_sanksi) {
            return [
                'success' => false, 
                'message' => 'ID Tata Tertib dan ID Sanksi harus diisi'
            ];
        }

        // Mulai session untuk mendapatkan ID dosen dan mahasiswa
        if (!isset($_SESSION)) {
            session_start();
        }

        // Pastikan user sudah login
        if (!isset($_SESSION['user_id']) || !isset($_SESSION['mahasiswa_id'])) {
            return [
                'success' => false, 
                'message' => 'Anda harus login terlebih dahulu'
            ];
        }

        // Ambil ID Dosen dari session atau data user yang login
        $id_dosen = $_SESSION['user_id'];
        $id_mahasiswa = $_SESSION['mahasiswa_id'];

        // Proses upload surat jika ada
        if (isset($_FILES['surat']) && $_FILES['surat']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "../document/"; // Direktori untuk menyimpan file
            
            // Buat nama file unik
            $fileName = uniqid() . '_' . basename($_FILES['surat']['name']);
            $targetFilePath = $targetDir . $fileName;

            // Pindahkan file yang diupload
            if (move_uploaded_file($_FILES['surat']['tmp_name'], $targetFilePath)) {
                $surat = $targetFilePath;
            } else {
                return [
                    'success' => false, 
                    'message' => 'Gagal mengunggah surat'
                ];
            }
        }

        // Simpan detail pelanggaran menggunakan model
        $result = $this->pelanggaranModel->simpanDetailPelanggaran(
            $id_dosen, 
            $id_tata_tertib, 
            $id_mahasiswa, 
            $id_sanksi, 
            $tugas_khusus, 
            $surat, 
            $status
        );
        
        // Cek hasil penyimpanan
        if ($result) {
            return [
                'success' => true, 
                'message' => 'Berhasil menyimpan detail pelanggaran',
                'id_detail' => $result
            ];
        } else {
            return [
                'success' => false, 
                'message' => 'Gagal menyimpan detail pelanggaran'
            ];
        }
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

    

    public function getNotifikasiMahasiswa($idMahasiswa) {
        return $this->pelanggaranModel->getNotifikasiMahasiswa($idMahasiswa);
    }

    public function getNotifikasiDosen($idDosen) {
        return $this->pelanggaranModel->getNotifikasiDosen($idDosen);
    }
}
?>
