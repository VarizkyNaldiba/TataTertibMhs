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

// Ambil data user dari session
$userData = $_SESSION['user_data'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggaran</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/perlanggaranPage.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <img class="logo" src="../img/logo copy.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
            <li><a href="../index.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="listTatib.php"><i class="fa-solid fa-book"></i></a></li>
            <li class="active"><a href="pelanggaranpage.php"><i class="fa-solid fa-hand"></i></a></li>
            <li><a href="notifikasi_dosen.php"><i class="fa-solid fa-bell"></i></a></li>
            <li class="logout"><a href="?logout=true"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="content">
        <div class="header">
            <h1>Pelanggaran</h1>
        </div>
        <div class="profile">
            <p><strong>Nama: <?= $userData['nama_lengkap'] ?></strong></p>
            <p><strong>NIM: <?= $userData['nim'] ?></strong></p>
            <p><strong>Semester: <?= $userData['angkatan'] ?></strong></p>
        </div>

        <h3>Tabel Pelanggaran</h3>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Pelanggaran</th>
                        <th>Tingkat Pelanggaran</th>
                        <th>Dosen Pengampu</th>
                        <th>Tugas Khusus</th>
                        <th>Surat</th>
                        <th>Poin</th>
                        <th>Status</th>
                        <th>Pengumpulan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Berkomunikasi dengan tidak sopan, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, karyawan, atau orang lain</td>
                        <td>V</td>
                        <td>Dr. Wawan Agung S.pd</td>
                        <td>-</td>
                        <td><a href="#">Unduh File</a></td>
                        <td>2 Poin</td>
                        <td>On Progress</td>
                        <td><button class="submit-btn" id="openModalButton">Kumpulkan</button></td>
                    </tr>
                </tbody>
            </table>
        </div>

<!-- untuk modal ini ada 2 pengumpulan tugas khusus dan akhir gimana caranya biar kalo tugas akhir nya ga ada, form untuk input tugas akhir nya ga ada juga?? -->
       <!-- Modal -->
<div id="uploadModal" class="modal">
    <div class="modal-dialog">
        <div class="modal-header">
            <h2>Upload File</h2>
            <p><i>*File yang diupload maksimal 2 MB</i></p>
        </div>
        <div class="modal-body">
            <!-- Form Surat Pernyataan -->
            <form id="formSuratPernyataan">
                <div class="form-control">
                    <label for="suratPernyataan">Surat Pernyataan: *</label>
                    <input type="file" id="suratPernyataan" name="suratPernyataan" required>
                </div>
            </form>

            <!-- Form Tugas Khusus -->
            <form id="formTugasKhusus">
                <div class="form-control">
                    <label for="tugasKhusus">Tugas Khusus: *</label>
                    <input type="file" id="tugasKhusus" name="tugasKhusus" required>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Batal</button>
            <button type="submit" class="btn btn-primary" form="formSuratPernyataan">Simpan</button>
        </div>
    </div>
</div>




        <!-- Footer -->
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
        <a href="https://instagram.com" class="social-link"><i class="fa-brands fa-instagram" alt="Instagram" class="social-icon"></i></a>
        <a href="https://wa.me/1234567890" class="social-link"><i class="fa-brands fa-whatsapp" alt="WhatsApp" class="social-icon"></i></a>
        <a href="https://wa.me/1234567890" class="social-link"><i class="fa-solid fa-envelope" alt="Email" class="social-icon"></i></a>
    </div>
            <div class="footer-bottom">
                <p>© Copyright 2024 web Tatib. All Rights Reserved.</p>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script src="../BackEnd/scriptmodal.js" >
    </script>
</body>

</html>