<?php
require_once '../config.php';

class Pelanggaran {
    private $connect;

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function getDetailPelanggaranMahasiswa($nim) {
        $query = "SELECT * FROM PelanggaranMahasiswa WHERE nim = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $nim, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function getDetailLaporanDosen($nidn) {
        $query = "SELECT * FROM DosenMelaporkan WHERE nidn = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $nidn, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function simpanDetailPelanggaran($id_dosen, $id_tata_tertib, $id_mahasiswa, $id_sanksi, $tugas_khusus, $surat, $status) {
        $query = "INSERT INTO DETAIL_PELANGGARAN (id_dosen, id_tata_tertib, id_mahasiswa, id_sanksi, tugas_khusus, surat, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id_dosen, PDO::PARAM_INT);
        $stmt->bindParam(2, $id_tata_tertib, PDO::PARAM_INT);
        $stmt->bindParam(3, $id_mahasiswa, PDO::PARAM_INT);
        $stmt->bindParam(4, $id_sanksi, PDO::PARAM_INT);
        $stmt->bindParam(5, $tugas_khusus, PDO::PARAM_STR);
        $stmt->bindParam(6, $surat, PDO::PARAM_STR);
        $stmt->bindParam(7, $status, PDO::PARAM_STR);
        
        if ($stmt->execute()) {
            return $this->connect->lastInsertId(); // Return the ID of the inserted record
        } else {
            return false; // Return false if the insertion failed
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
}
?>
