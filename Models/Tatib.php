<?php
require_once '../config.php';

class Tatib {
    private $connect;

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function getAllTatib() {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM TATA_TERTIB");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function insertTatib($admin, $deskripsi, $tingkat, $poin){
        $query = "INSERT INTO TATA_TERTIB (id_adminTatib, deskripsi, tingkat, poin) 
              VALUES (?, ?, ?, ?)";
              
        try {
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$admin, $deskripsi, $tingkat, $poin]);
            return true;
        } catch(PDOException $e) {
            error_log('Error in insertTatib: ' . $e->getMessage());
            return false;
        }
    }

    // public function updateTatib($id, $judul, $pelanggaran, $id_penulis){
    //     $query = "UPDATE news set judul = ?, deskripsi = ?, penulis_id = ? WHERE id = ?)";
              
    //     try {
    //         $stmt = $this->connect->prepare($query);
    //         $stmt->execute([$judul, $deskripsi, $id_penulis, $id]);
    //         return true;
    //     } catch(PDOException $e) {
    //         error_log('Error in updatedeskripsi: ' . $e->getMessage());
    //         return false;
    //     }
    // }

    public function deleteTatib($id) {
        $query = "DELETE FROM TATA_TERTIB WHERE id_tata_tertib = ?";
        try {
            $stmt = $this->connect->prepare($query);
            return $stmt->execute([$id]);
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>
