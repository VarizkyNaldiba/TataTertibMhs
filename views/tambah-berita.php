<?php
session_start();
require_once '../config.php';

require_once "../Controllers/NewsController.php";
require_once '../Controllers/UserController.php';

if (isset($_SESSION['username'])) {
  // Redirect based on role
  if ($_SESSION['user_type'] === 'mahasiswa') {
      header("Location: pelanggaranpage.php");
      exit();
  } else if ($_SESSION['user_type'] === 'dosen') {
    header("Location: pelanggaran_dosen.php");
    exit();
  }
}if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    $userController = new UserController();
    $userController->logout();
    exit();
}

// Ambil data user dari session
$userData = $_SESSION['user_data'];

$newsController = new NewsController();
$id_admin = $userData['id_admin'];
$newsData = $newsController->AdminNews($id_admin);

?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/news-form.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
</head>

<body>
<div class="sidebar">
    <img class="logo" src="../img/logo aja.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
        <li><a href="home-admin.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="listTatib-admin.php"><i class="fa-solid fa-book"></i></a></li>
            <li class="active"><a href="news-admin.php"><i class="fa-solid fa-newspaper"></i></a></li>
            <li class="logout"><a href="../?logout=true"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>
    <div class="content">
        <div class="header"></div>
        <div class="judul">
            <h1>Tambah Berita</h1>
        </div>
        <form id="insertBeritaForm" method="POST" action="../Request/Handler_News.php">
            <label for="insertPenulis">ID Penulis:</label>
            <input type="text" id="insertPenulis" name="penulis" value="<?= $userData['id_admin']?>" required readonly>

            <label for="insertPenulis">Penulis:</label>
            <input type="text" id="insertPenulisNama" name="penulis_nama" value="<?= htmlspecialchars($userData['nama_admin']) ?>" required readonly>
            <input type="hidden" id="insertPenulis" name="penulis" value="<?= htmlspecialchars($userData['id_admin']) ?>" required>
            
            <label for="insertJudul">Judul:</label>
            <input type="text" id="insertJudul" name="judul" required>
            
            <label for="insertKonten">Konten:</label>
            <textarea id="insertKonten" name="konten" rows="4" required></textarea>

            <label for="insertGambar">Unggah Gambar:</label>
            <input type="file" id="insertGambar" name="gambar" accept="image/*">

            <button type="submit" class="save-button" name="store">Simpan</button>
            <button class="cancel-button" name="cancel" onclick="window.location.href='news-admin.php'">cancel</button>
        </form>
    </div>
</body>
</html>
