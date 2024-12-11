<?php
session_start();

require_once '../Controllers/UserController.php';
require_once '../Controllers/NewsController.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['logout'])) {
    $userController = new UserController();
    $userController->logout();
    exit();
}

if ($_SESSION['user_type'] === 'mahasiswa') {
    header("Location: pelanggaranpage.php");
    exit();
} else if ($_SESSION['user_type'] === 'dosen') {
    header("Location: pelanggaran_dosen.php");
    exit();
}
$newsController = new NewsController();
$newsData = $newsController->ReadNews();
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
    <link rel="stylesheet" href="../css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
</head>

<body>
    <div class="sidebar">
    <img class="logo" src="../img/logo aja.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
            <li class="active"><a href="home-admin.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="listTatib-admin.php"><i class="fa-solid fa-book"></i></a></li>
            <li><a href="news-admin.php"><i class="fa-solid fa-newspaper"></i></a></li>
            <li class="logout"><a href="../?logout=true"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>
    <div class="content">
    <div class="header">
    <h1>Home</h1>
    <?php if (!isset($_SESSION['username'])) : ?>
        <button class="login-btn" onclick="window.location.href='views/login.php'">Login</button>
    <?php endif; ?>
</div>

            <div class="judul">
                <h2>TATA TERTIB <br>MAHASISWA </h2>
                <p>Sebuah sistem yang dirancang untuk mengelola aturan, <br>pelanggaran, dan sanksi di Universitas</p>
            </div>
            <div class="dashboard-container">
                <img class="logo-disciplink" src="../img/full.png">
                <p>Disciplink adalah platform digital inovatif yang dirancang untuk menghubungkan mahasiswa dengan
                    sistem kedisiplinan kampus. Sebagai gabungan dari kata "Discipline" dan "Link", Disciplink berfokus
                    pada penyederhanaan proses pengelolaan tata tertib di lingkungan akademik, memudahkan mahasiswa dan
                    pihak kampus untuk memahami, memantau, dan menegakkan aturan secara efisien.</p>
            </div>
            <div class="news">
                <h2>Lastest News</h2>
                <div class="row">
                    <?php foreach($newsData as $news): ?>
                        <div class="news-content">
                            <img src="../img/news.jpg" alt="gambar">
                            <h5><?= $news['judul'] ?></h5>
                            <p><?= $news['konten'] ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
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