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
    public function simpanDetailPelanggaran($id_dosen, $id_tata_tertib, $id_mahasiswa, $id_sanksi, $tugas_khusus = null, $surat = null, $status = 'pending') {
        try {
            $query = "EXEC sp_InsertDetailPelanggaran 
                @id_dosen = :id_dosen, 
                @id_tata_tertib = :id_tata_tertib, 
                @id_mahasiswa = :id_mahasiswa, 
                @id_sanksi = :id_sanksi, 
                @tugas_khusus = :tugas_khusus, 
                @detail_tugas_khusus = :detail_tugas_khusus,
                @surat = :surat, 
                @status = :status";
    
            $stmt = $this->connect->prepare($query);
    
            $params = [
                ':id_dosen' => $id_dosen,
                ':id_tata_tertib' => $id_tata_tertib,
                ':id_mahasiswa' => $id_mahasiswa,
                ':id_sanksi' => $id_sanksi,
                ':tugas_khusus' => $tugas_khusus,
                ':detail_tugas_khusus' => $tugas_khusus,
                ':surat' => $surat,
                ':status' => $status,
            ];
    
            $stmt->execute($params);
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['id_detail'] ?? false;
        } catch (PDOException $e) {
            error_log('Error in simpanDetailPelanggaran: ' . $e->getMessage());
            return false;
        }
    }
    
        public function updateDetailPelanggaran($id_detail, $status, $tugas_khusus) {
        $query = "UPDATE DETAIL_PELANGGARAN SET status = ?, tugas_khusus = ? WHERE id_detail = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $status, PDO::PARAM_STR);
        $stmt->bindParam(2, $tugas_khusus, PDO::PARAM_STR);
        $stmt->bindParam(3, $id_detail, PDO::PARAM_INT);
        
        return $stmt->execute(); // Return true on success, false on failure
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
