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

    public function store($judul, $penulis, $id) {
        $result = $this->newsModel->insertNews(
            $judul, 
            $penulis, 
            $id
        );
    }

    public function update($id, $judul, $penulis, $id_penulis) {
        $result = $this->newsModel->updateNews(
            $id, 
            $judul, 
            $penulis, 
            $id_penulis
        );
    }

    public function delete($id) {
        $result = $this->newsModel->deleteNews($id);
    }
}

?>