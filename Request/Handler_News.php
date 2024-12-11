<?php
session_start();
require_once '../config.php';
require_once '../Controllers/NewsController.php';


$newsController = new NewsController();

try {
    $result = $newsController->simpanNews(
        $judul = $_POST['judul'],
        $konten = $_POST['konten'],
        $penulis = $_POST['penulis']
        );
        
} catch (Exception $e) {
    error_log('News Save Error: ' . $e->getMessage());
    return false;
}

header("Location: ../views/news-admin.php");
exit();

?>