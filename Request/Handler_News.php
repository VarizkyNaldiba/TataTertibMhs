<?php
session_start();
require_once '../config.php';
require_once '../Controllers/NewsController.php';


$newsController = new NewsController();



if(isset($_POST['store']) && isset($_FILES['gambar']) && isset($_POST['judul']) && isset($_POST['konten']) && isset($_POST['penulis'])) {
    $result = $newsController->store(
        $_POST['judul'],
        $_POST['penulis'],
        $_POST['konten'],
        $_FILES['gambar']
    );
} else if(isset($_POST['store']) && isset($_POST['konten']) && isset($_POST['penulis'])) {
    $newsController->update(
        $_POST['judul'],
        $_POST['konten'],
        $_POST['penulis']
    );
} else if(isset($_POST['delete']) && isset($_POST['news_id'])) {
    $newsController->delete($_POST['news_id']);
}

header("Location: ../views/news-admin.php");
exit();

?>