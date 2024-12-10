<?php
require_once '../Models/News.php';

class NewsController {
    private $tatibModel;

    public function __construct() {
        $this->newsModel = new News();
    }

    public function ReadNews() {
        return $this->newsModel->getAllNews();
    }
}

?>