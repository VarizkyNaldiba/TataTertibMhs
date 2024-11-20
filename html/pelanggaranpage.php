<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelanggaran</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/perlanggaranPage.css">
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="sidebar">
        <img class="logo" src="../img/logo copy.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
            <li><a href="homepage.php"><i data-feather="home"></i></a></li>
            <li><a href="listTatib.php"><i data-feather="book"></i></a></li>
            <li class="active"><a href="pelanggaranpage.php"><i data-feather="x-square"></i></a></li>
            <li><a href=""><i data-feather="bell"></i></a></li>
        </ul>
    </div>

    <div class="content">
            <div class="header">
                <h1>Pelanggaran</h1>
            </div>
            <div class="profile">
                <p><strong>Nama :Ahmad Rusdi Ambarawa</strong></p>
                <p><strong>NIM : 2341010203</strong></p>
                <p><strong>Semester : 2</strong></p>
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
                            <td><button class="submit-btn">Kumpulkan</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
    
            
            <div class="footer">
                <p>© Copyright 2024 web Tatib. All Rights Reserved.</p>
                <img class="footer-logo" src="../img/Logo name.png" alt="">
            </div>
        </div>

    <!-- feather icons -->
    <script>
        feather.replace();
    </script>
</body>
</html>
