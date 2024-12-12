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
    <link rel="stylesheet" href="../css/news-admin.css">
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
        <h1>DISCIPLINK NEWS</h1>
    </div>

    <button class="add-button" id="addButton">Tambah</button>
    <div class="table-container">

    
  <table>
    <thead>
      <tr>
        <th>Judul</th>
        <th>Konten</th>
        <th>Penulis</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
        <?php if ($newsData) :?>
                <?php foreach ($newsData as $news) :?>
                <tr>
                    <td><?= $news['judul']?></td>
                    <td><?= $news['konten']?></td>
                    <td><?= $news['penulis_id']?></td>
                    <td class="button-cell">
                        <button class="edit-button" 
                                data-id="<?= $news['id_news'] ?>" 
                                data-judul="<?= htmlspecialchars($news['judul']) ?>" 
                                data-konten="<?= htmlspecialchars($news['konten']) ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    <!--tombol delete --> 
                    <form action="../Request/Handler_News.php" method="post">
                        <input type="hidden" name="news_id" value="<?= $news['id_news'] ?>">
                        <button class="delete" id="delete" name="delete" onclick="return confirm('Apakah anda yakin ingin menghapus?');"><i class="fa-solid fa-trash"></i></button></td>
                    </form>
                </tr>
                <?php endforeach;?>
        <?php endif;?>
    </tbody>
  </table>
</div>

<!-- Modal Edit Berita -->
<div id="editBeritaModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Berita</h2>
        <form id="editBeritaForm" method="POST" action="../Request/Handler_News.php">
            <input type="hidden" id="editNewsId" name="news_id" required>
            
            <label for="editPenulis">Penulis:</label>
            <input type="text" id="editPenulis" name="penulis" value="<?= $userData['id_admin']?>" required readonly>
            
            <label for="editJudul">Judul:</label>
            <input type="text" id="editJudul" name="judul" required>
            
            <label for="editKonten">Konten:</label>
            <textarea id="editKonten" name="konten" rows="4" required></textarea>

            <button type="submit" class="save-button">Simpan</button>
        </form>
    </div>
</div>

<!-- Modal Tambah Berita -->
<div id="insertBeritaModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Tambah Berita</h2>
        <form id="insertBeritaForm" method="POST" action="../Request/Handler_News.php">
            <label for="insertPenulis">ID Penulis:</label>
            <input type="text" id="insertPenulis" name="penulis" value="<?= $userData['id_admin']?>" required readonly>
            
            <label for="insertJudul">Judul:</label>
            <input type="text" id="insertJudul" name="judul" required>
            
            <label for="insertKonten">Konten:</label>
            <textarea id="insertKonten" name="konten" rows="4" required></textarea>

            <button type="submit" class="save-button" name="store">Simpan</button>
        </form>
    </div>
</div>


<!-- javascript -->
<script src="../js/script-news.js"></script>
</div>
</body>
<footer class="footer">
        <div class="footer-left">
        <img class="footer-logo" src="../img/logo aja.png" alt="Logo">
            <img class ="footer-logo" src="../img/logo.png" alt="logo polinema">
        </div>
        <div class="footer-center">
            <p>Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, <br>Kota Malang, Jawa Timur 65141</p>
            <p><a href="tel:(0341)404424" class="footer-link">(0341) 404424</a></p>
        </div>
        <div class="footer-right">
            <a href="https://instagram.com" class="social-link"><i class="fa-brands fa-instagram" alt="Instagram" class="social-icon"></i></a>
            <a href="https://wa.me/1234567890" class="social-link"><i class="fa-brands fa-whatsapp" alt="WhatsApp" class="social-icon"></i></a>
            <a href="https://wa.me/1234567890" class="social-link"><i class="fa-solid fa-envelope" alt="Email" class="social-icon"></i></a>
        </div>
        <div class="footer-bottom">
            <p>© Copyright 2024 web Tatib. All Rights Reserved.</p>
        </div>
</footer>
</html>
