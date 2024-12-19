<?php
require_once __DIR__ . '/../config.php';

class News {
    private $connect;

    public function __construct($connect = null) {
        if ($connect === null) {
            global $connect;
        }
        $this->connect = $connect;
    }

    public function getNewsById($id) {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM NEWS WHERE id_news = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log or display the error
            echo "Error: " . $e->getMessage();
            return null;
        }
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

    // Dalam model News
    public function getNewsAdmin($adminId) {
        $query = "SELECT
                    news.id_news, news.judul, news.konten, news.gambar,
                    admin.nama_admin AS penulis_nama
                FROM NEWS news
                JOIN ADMIN admin ON news.penulis_id = admin.id_admin
                WHERE news.penulis_id = ?";
        $stmt = $this->connect->prepare($query);
        $stmt->execute([$adminId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertNews($judul, $konten, $penulis_id) {
        $query = "INSERT INTO NEWS (judul, konten, penulis_id ) VALUES (?, ?, ?)";
        try {
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$judul, $konten, $penulis_id]);
            return true;
        } catch (PDOException $e) {
            error_log('Error in insertNews: ' . $e->getMessage());
            return false;
        }
    }

    public function updateNews($id, $judul, $konten, $penulis_id, $gambarPath = null) {
        $query = "UPDATE NEWS SET judul = ?, konten = ?, penulis_id = ?" . 
                 ($gambarPath ? ", gambar = ?" : "") . " WHERE id_news = ?";
                  
        try {
            $stmt = $this->connect->prepare($query);
            $params = [$judul, $konten, $penulis_id];
            if ($gambarPath) $params[] = $gambarPath;
            $params[] = $id;
            $stmt->execute($params);
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