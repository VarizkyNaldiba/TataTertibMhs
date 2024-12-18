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

    public function simpanDetailPelanggaran($nidn, $id_tata_tertib, $nim, $id_sanksi, $detail_pelanggaran, $tugas_khusus, $surat, $status, $status_tugas) {
        // Validate input
        if (!$id_tata_tertib || !$nidn || !$nim) {
            return [
                'success' => false, 
                'message' => 'ID Tata Tertib, NIDN, dan NIM harus diisi'
            ];
        }

        // Simpan detail pelanggaran menggunakan model
        $result = $this->pelanggaranModel->simpanDetailPelanggaran(
            $nidn, 
            $id_tata_tertib, 
            $nim, 
            $id_sanksi, 
            $detail_pelanggaran, 
            $tugas_khusus, 
            $surat, 
            $status,
            $status_tugas
        );
    }
    
    public function getNotifikasiMahasiswa($idMahasiswa) {
        return $this->pelanggaranModel->getNotifikasiMahasiswa($idMahasiswa);
    }

    public function getNotifikasiDosen($idDosen) {
        return $this->pelanggaranModel->getNotifikasiDosen($idDosen);
    }

    public function getDetailPelanggar($id){
        
    }
}

?>
