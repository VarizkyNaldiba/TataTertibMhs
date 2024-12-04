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

    public function simpanDetailPelanggaran($nidn, $id_tata_tertib, $nim, $id_sanksi, $tugas_khusus = null, $detail_tugas = null, $surat = null, $status = 'pending') {
        // Validate input
        if (!$id_tata_tertib || !$id_sanksi || !$nim) {
            return [
                'success' => false, 
                'message' => 'ID Tata Tertib, ID Sanksi, dan NIM harus diisi'
            ];
        }

        // Simpan detail pelanggaran menggunakan model
        $result = $this->pelanggaranModel->simpanDetailPelanggaran(
            $nidn, 
            $id_tata_tertib, 
            $nim, 
            $id_sanksi, 
            $tugas_khusus, 
            $detail_tugas, 
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
    
    // public function updateDetailPelanggaran($id_detail, $status, $tugas_khusus, $surat) {
    //     // Update detail pelanggaran menggunakan model
    //     $result = $this->pelanggaranModel->updateDetailPelanggaran($id_detail, $status, $tugas_khusus);
        
    //     // Logic to handle file upload for surat
    //     if (isset($_FILES['suratPernyataan']) && $_FILES['suratPernyataan']['error'] === UPLOAD_ERR_OK) {
    //         $targetDir = "../document/"; // Directory to save uploaded files
    //         $fileName = basename($_FILES['suratPernyataan']['name']);
    //         $targetFilePath = $targetDir . $fileName;

    //         // Move the uploaded file to the target directory
    //         if (move_uploaded_file($_FILES['suratPernyataan']['tmp_name'], $targetFilePath)) {
    //             // Update the surat path in the database
    //             $this->pelanggaranModel->updateSuratPath($id_detail, $targetFilePath);
    //         } else {
    //             return false; // Return false if file upload failed
    //         }
    //     }

    //     return $result; // Return the result of the update operation
    // }

    

    public function getNotifikasiMahasiswa($idMahasiswa) {
        return $this->pelanggaranModel->getNotifikasiMahasiswa($idMahasiswa);
    }

    public function getNotifikasiDosen($idDosen) {
        return $this->pelanggaranModel->getNotifikasiDosen($idDosen);
    }
}
?>
