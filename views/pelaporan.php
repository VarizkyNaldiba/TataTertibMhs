<?php
session_start();

require_once "../Controllers/TatibController.php";
require_once '../Controllers/UserController.php';
require_once '../Controllers/PelanggaranController.php'; // Include PelanggaranController

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
$sanksiData = $tatibController->ReadSanksi();
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
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>

<body>
    <div class="sidebar">
    <img class="logo" src="../img/logo aja.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
            <li><a href="../index.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="listTatib.php"><i class="fa-solid fa-book"></i></a></li>
            <li class="active"><a href="pelanggaranpage.php"><i class="fa-solid fa-hand"></i></i></a></li>
            <li><a href="notifikasi.php"><i class="fa-solid fa-bell"></i></a></li>
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
            <form id="pelanggaranForm" method="POST" action="../Request/Handler_Pelaporan.php"> <!-- Added method POST -->
                <!-- NIM -->
                <div class="form-group">
                    <label for="nim">NIM</label>
                    <input type="text" id="nim" name="nim" placeholder="NIM" required>
                </div>

                <!-- Nama -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="nama" placeholder="Nama Lengkap">
                </div>

                <!-- Semester -->
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <input type="text" id="semester" name="semester" placeholder="Semester">
                </div>

                <!-- Tingkat -->
                <div class="form-group">
                    <label for="tingkat">Tingkat</label>
                    <select id="tingkat" name="tingkat" required>
                        <option value="">Pilih Tingkat</option>
                        <option value="I">Tingkat 1</option>
                        <option value="II">Tingkat 2</option>
                        <option value="III">Tingkat 3</option>
                        <option value="IV">Tingkat 4</option>
                        <option value="V">Tingkat 5</option>
                    </select>
                </div>

                <!-- Jenis Pelanggaran -->
                <div class="form-group">
                    <label for="jenisPelanggaran">Jenis Pelanggaran</label>
                    <select id="jenisPelanggaran" name="jenisPelanggaran" required>
                        <option value="" readonly>Pilih Jenis Pelanggaran</option>
                        <?php foreach($tatibData as $tatib) :?>
                            <option value="<?= $tatib['id_tata_tertib']?>" data-tingkat="<?= $tatib['tingkat']?>"><?= $tatib['deskripsi']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Sanksi -->
                <div class="form-group" id="sanksi-container">
                    <label for="sanksi">Sanksi</label>
                    <select id="sanksi" name="sanksi" required>
                        <option value="">Pilih Sanksi</option>
                        <?php foreach($sanksiData as $sanksi) :?>
                            <option value="<?= $sanksi['id_sanksi']?>" data-tingkat="<?= $sanksi['tingkat']?>"><?= $sanksi['deskripsi']?></option>
                        <?php endforeach; ?>
                    </select>
                </div>


                <!-- Deskripsi Pelanggaran -->
                <div class="form-group">
                    <label for="deskripsiPelanggaran">Deskripsi Pelanggaran</label>
                    <textarea id="deskripsiPelanggaran" name="deskripsiPelanggaran"
                        required></textarea>
                </div>

                <!-- Tombol Melempar ke DPA -->
                <div id="skipTugasKhusus-container" style="display: none;">
                    <label for="tugasKhusus">Kirim kan laporan ke DPA</label>
                    <button id="skipTugasKhusus" type="button" class="btn btn-third">kirim</button>
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
            <img class="footer-logo" src="../img/logo aja.png" alt="Logo">
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

    <script src="../js/script_pelaporan.js"></script>
</body>

</html>