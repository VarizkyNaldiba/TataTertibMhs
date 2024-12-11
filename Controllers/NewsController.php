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

    public function simpanNews($judul, $penulis, $id) {
        $result = $this->newsModel->insertNews(
            $judul, 
            $penulis, 
            $id
        );
    }
}

?>