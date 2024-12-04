<?php
session_start();
require_once "../Controllers/TatibController.php";
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

$tatibController = new TatibController();
$tatibData = $tatibController->ReadTatib();
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
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
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
                    <input type="text" id="nim" name="nim" placeholder="2341010203" required>
                </div>

                <!-- Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" value="Ahmad Rusdi Ambarawa" readonly>
                </div>

                <!-- Semester -->
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" id="semester" name="semester" value="2" readonly>
                </div>

                <!-- Jenis Pelanggaran -->
                <div class="form-group">
                    <label for="jenisPelanggaran">Jenis Pelanggaran</label>
                    <select id="jenisPelanggaran" name="jenisPelanggaran" style="width: 100%;" required>
                        <option readonly>Pilih Jenis Pelanggaran</option>
                        <?php foreach($tatibData as $data) :?>
                        <option value="<?= $data['id_tata_tertib']?>" data-tingkat="<?= $data['tingkat']?>"><?= $data['deskripsi']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Tingkat (ubah menjadi input yang tidak bisa diganti) -->
                <div class="form-group">
                    <label for="tingkat">Tingkat</label>
                    <input type="text" id="tingkat" name="tingkat" readonly required>
                </div>


                <!-- Sanksi -->
                <div class="form-group" id="sanksi-container">
                    <label for="sanksi">Sanksi</label>
                    <select id="sanksi" name="sanksi" style="width: 100%;" required>
                        <!-- Sanksi akan diubah dengan JavaScript -->
                    </select>
                </div>

                <!-- Deskripsi Pelanggaran -->
                <div class="form-group">
                    <label for="deskripsiPelanggaran">Deskripsi Pelanggaran</label>
                    <textarea id="deskripsiPelanggaran" name="deskripsiPelanggaran"
                        required></textarea>
                </div>

                <!-- Deskripsi Tugas Khusus -->
                <div class="form-group" id="deskripsiTugas-container" style="display: none;">
                    <label for="deskripsiTugas">Deskripsi Tugas Khusus</label>
                    <textarea id="deskripsiTugas" name="deskripsiTugas"></textarea>
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
                <img class="footer-logo" src="../img/logo.png" alt="logo polinema">
            </div>
            <div class="footer-center">
                <p>Jl. Soekarno Hatta No.9, Jatimulyo, Kec. Lowokwaru, <br>Kota Malang, Jawa Timur 65141</p>
                <p><a href="tel:(0341)404424" class="footer-link">(0341) 404424</a></p>
            </div>
            <div class="footer-right">
                <a href="https://instagram.com" class="social-link"><i class="fa-brands fa-instagram" alt="Instagram"
                        class="social-icon"></i></a>
                <a href="https://wa.me/1234567890" class="social-link"><i class="fa-brands fa-whatsapp" alt="WhatsApp"
                        class="social-icon"></i></a>
                <a href="https://wa.me/1234567890" class="social-link"><i class="fa-solid fa-envelope" alt="Email"
                        class="social-icon"></i></a>
            </div>
            <div class="footer-bottom">
                <p>© Copyright 2024 web Tatib. All Rights Reserved.</p>
            </div>
        </div>
    </div>

    <script src="../BackEnd/script_pelaporan.js"></script>
</body>

</html>