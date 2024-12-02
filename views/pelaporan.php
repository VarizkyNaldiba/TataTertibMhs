<?php
session_start();
require_once '../Controllers/UserController.php';
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
}

// Ambil data user dari session
$userData = $_SESSION['user_data'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelaporan</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/pelaporan.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="sidebar">
        <img class="logo" src="../img/logo copy.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
            <li><a href="../index.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="listTatib.php"><i class="fa-solid fa-book"></i></a></li>
            <li class="active"><a href="pelanggaranpage.php"><i class="fa-solid fa-hand"></i></i></a></li>
            <li><a href="notifikasi_dosen.php"><i class="fa-solid fa-bell"></i></a></li>
            <li class="logout"><a href="?logout=true"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>

    <div class="content">
            <div class="header">
                <h1>Pelanggaran</h1>
            </div>
            <div class="profile">
                <p><strong>Nama : <?= $userData['nama_lengkap']?></strong></p>
                <p><strong>NIP  : <?= $userData['nidn']?></strong></p>
            </div>




            <div class="form-container">
        <form id="pelanggaranForm">
            <!-- NIM -->
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" placeholder="Ketikkan NIM" required>
            </div>

            <!-- Nama -->
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" id="nama" name="nama" placeholder="Ketikkan Nama" readonly>
            </div>

            <!-- Semester -->
            <div class="form-group">
                <label for="angkatan">Angkatan</label>
                <input type="text" id="angkatan" name="angkatan" placeholder="Ketikkan Angkatan" readonly>
            </div>

            <!-- Jenis Pelanggaran -->
            <div class="form-group">
                <label for="jenisPelanggaran">Jenis Pelanggaran</label>
                <div class="suggestions">
                    <input type="text" id="jenisPelanggaran" name="jenisPelanggaran" placeholder="Ketik jenis pelanggaran">
                    <div id="suggestionsList" class="suggestions-list" style="display: none;"></div>
                </div>
            </div>

            <!-- Deskripsi Pelanggaran -->
            <div class="form-group">
                <label for="deskripsiPelanggaran">Deskripsi Pelanggaran</label>
                <textarea id="deskripsiPelanggaran" name="deskripsiPelanggaran" placeholder="Berkata kasar kepada teman sekelas" required></textarea>
            </div>

            <!-- Tugas Khusus -->
            <div class="form-group">
                <label for="tugasKhusus">Tugas Khusus</label>
                <div class="file-input-container">
                    <input type="checkbox" id="tugasKhusus" name="tugasKhusus">
                    <label for="tugasKhusus">Aktifkan untuk menulis deskripsi tugas khusus</label>
                </div>
            </div>

            <!-- Deskripsi Tugas Khusus -->
            <div class="form-group">
                <label for="deskripsiTugas">Deskripsi Tugas Khusus</label>
                <textarea id="deskripsiTugas" name="deskripsiTugas" disabled></textarea>
            </div>

            <!-- Buttons -->
            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" onclick="resetForm()">Batal</button>
            </div>
        </form>
    </div>

            
            <div class="footer">
    <div class="footer-left">
        <img class="footer-logo" src="../img/full.png" alt="Logo">
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
</div>
        </div>
        <script src="../BackEnd/script_pelaporan.js" >
    </script>
</body>
</html>