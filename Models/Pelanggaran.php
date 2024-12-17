<?php
require_once '../config.php';

class Pelanggaran {
    private $connect;

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function getDetailPelanggaranMahasiswa($nim) {
        $query = "SELECT * FROM v_PelanggaranMahasiswa WHERE nim = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $nim, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function getDetailLaporanDosen($nidn) {
        $query = "SELECT * FROM v_DosenMelaporkan WHERE nidn = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $nidn, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function getUpdatePelanggar($id) {
        // $query = "SELECT * FROM v_DosenMelaporkan WHERE nidn = ?";
    }

    public function simpanDetailPelanggaran($nidn_dosen, $id_tata_tertib, $nim_mahasiswa, $id_sanksi, $detail_pelanggaran, $tugas_khusus, $surat, $status, $status_tugas) {
        try {
            $query = "EXEC sp_InsertDetailPelanggaran 
                @nidn_dosen = :nidn_dosen, 
                @id_tata_tertib = :id_tata_tertib, 
                @nim_mahasiswa = :nim_mahasiswa, 
                @id_sanksi = :id_sanksi, 
                @tugas_khusus = :tugas_khusus, 
                @detail_pelanggaran = :detail_pelanggaran,
                @surat = :surat, 
                @status = :status,
                @status_tugas = :status_tugas";
    
            $stmt = $this->connect->prepare($query);
    
            $params = [
                ':nidn_dosen' => $nidn_dosen,
                ':id_tata_tertib' => $id_tata_tertib,
                ':nim_mahasiswa' => $nim_mahasiswa,
                ':id_sanksi' => $id_sanksi,
                ':tugas_khusus' => $tugas_khusus,
                ':detail_pelanggaran' => $detail_pelanggaran,
                ':surat' => $surat,
                ':status' => $status,
                ':status_tugas' => $status_tugas
            ];
    
            $stmt->execute($params);
            return true; // Return true if a row was affected
        } catch (PDOException $e) {
            error_log('Error in simpanDetailPelanggaran: ' . $e->getMessage());
            return false;
        }
    }

    public function getNotifikasiMahasiswa($id) {
        $query = "SELECT * FROM v_NotifikasiMahasiswa WHERE nim = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
    public function getNotifikasiDosen($id) {
        $query = "SELECT * FROM v_NotifikasiDosen WHERE nidn = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }
}
?>