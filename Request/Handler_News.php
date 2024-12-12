<?php
session_start();
require_once '../config.php';
require_once '../Controllers/NewsController.php';


$newsController = new NewsController();


if(isset($_POST['delete']) && isset($_POST['news_id'])) {
    $newsController->delete($_POST['news_id']);
}

// Handle other actions (edit, insert) here
if(isset($_POST['judul']) && isset($_POST['konten']) && isset($_POST['penulis'])) {
    $newsController->store(
        $_POST['judul'],
        $_POST['konten'],
        $_POST['penulis']
    );
}

header("Location: ../views/news-admin.php");
exit();

?>