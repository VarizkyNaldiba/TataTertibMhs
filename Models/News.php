<?php
require_once __DIR__ . '/../config.php';

class News {
    private $connect;

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function getAllNews() {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM NEWS");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }

    public function getNewsAdmin($id){
        $query = "SELECT * FROM NEWS WHERE penulis_id = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(1, $id, PDO::PARAM_STR); 
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        return $result;
    }

    public function insertNews($judul, $konten, $id){
        $query = "INSERT INTO news (judul, konten, penulis_id) 
              VALUES (?, ?, ?)";
              
        try {
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$judul, $konten, $id]);
            return true;
        } catch(PDOException $e) {
            error_log('Error in insertNews: ' . $e->getMessage());
            return false;
        }
    }

    public function updateNews($id, $judul, $konten, $id_penulis){
        $query = "UPDATE news SET judul = ?, konten = ?, penulis_id = ? WHERE id_news = ?";
              
        try {
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$judul, $konten, $id_penulis, $id]);
            return true;
        } catch(PDOException $e) {
            error_log('Error in updateNews: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteNews($news_id) {
        $query = "DELETE FROM news WHERE id_news = ?";
        try {
            $stmt = $this->connect->prepare($query);
            return $stmt->execute([$news_id]);
        } catch(PDOException $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
?>