<?php
require_once __DIR__ . '/../Models/News.php';

class NewsController {
    private $tatibModel;

    public function __construct() {
        $this->newsModel = new News();
    }

    public function ReadNews() {
        return $this->newsModel->getAllNews();
    }

    public function AdminNews($id) {
        return $this->newsModel->getNewsAdmin($id);
    }

    public function store($judul, $konten, $id, $gambar) {
        $targetDir = __DIR__ . '/../document/news/';
        
        // Create directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Sanitize filename
        $originalFilename = preg_replace('/[^a-zA-Z0-9_-]/', '', $judul);
        $originalFilename = substr($originalFilename, 0, 50); // Limit filename length
        
        // Get file extension
        $fileExtension = strtolower(pathinfo($gambar['name'], PATHINFO_EXTENSION));
        
        // Create a readable unique filename
        $uniqueFilename = date('Y-m-d_') . 
                          $originalFilename . '_' . 
                          substr(md5(uniqid()), 0, 5) . 
                          '.' . $fileExtension;

        $targetFilePath = $targetDir . $uniqueFilename;

        // Move uploaded file
        if (move_uploaded_file($gambar['tmp_name'], $targetFilePath)) {
            // Use relative path for database storage
            $relativePath = 'document/news/' . $uniqueFilename;
            
            // Call model method to insert news with image
            $result = $this->newsModel->insertNews(
                $originalFilename, 
                $judul, 
                $konten, 
                $id
            );
        }
    }

    public function update($id, $judul, $konten, $id_penulis) {
        $result = $this->newsModel->updateNews(
            $id, 
            $judul, 
            $konten, 
            $id_penulis
        );
    }

    public function delete($id) {
        $result = $this->newsModel->deleteNews($id);
    }
}

?>