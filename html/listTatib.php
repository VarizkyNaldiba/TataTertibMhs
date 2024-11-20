<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tatib</title>
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/listTatib.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
</head>

<body>

    <div class="sidebar">
        <img class="logo" src="../img/logo copy.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
            <li><a href="homepage.php"><i data-feather="home"></i></a></li>
            <li class="active"><a href="listTatib.php"><i data-feather="book"></i></a></li>
            <li><a href="pelanggaranpage.php"><i data-feather="x-square"></i></a></li>
            <li><a href=""><i data-feather="bell"></i></a></li>
        </ul>
    </div>

    <!-- Konten Utama -->
    <div class="content">
        <div class="header">
            <h1>List Tata Tertib</h1>
        </div>

        <!-- Filter Section -->
        <div class="filter-container">
            <div>
                <label for="filter-tingkat">Filter Tingkat:</label>
                <select id="filter-tingkat" onchange="filterTingkat()">
                    <option value="">Semua Tingkat</option>
                    <option value="I">I</option>
                    <option value="II">II</option>
                    <option value="III">III</option>
                    <option value="IV">IV</option>
                    <option value="V">V</option>
                </select>
            </div>
        </div>

        <!-- Tabel Pelanggaran -->
        <div class="table-container">
            <table id="tatib-table">
                <thead>
                    <tr>
                        <th>Pelanggaran</th>
                        <th>Tingkat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-tingkat="V">
                        <td>Berkomunikasi dengan tidak sopan kepada mahasiswa, dosen, karyawan, atau orang lain</td>
                        <td>V</td>
                    </tr>
                    <tr data-tingkat="IV">
                        <td>Mahasiswa laki-laki berambut tidak rapi</td>
                        <td>IV</td>
                    </tr>
                    <tr data-tingkat="III">
                        <td>Membuat kegaduhan yang mengganggu perkuliahan</td>
                        <td>III</td>
                    </tr>
                    <tr data-tingkat="II">
                        <td>Merusak sarana dan prasarana Polinema</td>
                        <td>II</td>
                    </tr>
                    <tr data-tingkat="I">
                        <td>Terlambat datang ke kelas lebih dari 15 menit</td>
                        <td>I</td>
                    </tr>
                    <tr data-tingkat="II">
                        <td>Tidak mengenakan pakaian sesuai aturan kampus</td>
                        <td>II</td>
                    </tr>
                </tbody>
            </table>
        </div>


        <!-- Sanksi Section -->
        <div class="sanksi-section">
            <h3>Sanksi Berdasarkan Tingkat</h3>
            <div class="sanksi-tingkat" data-tingkat="I"><b>Tingkat I:</b> Teguran lisan atau tertulis.</div>
            <div class="sanksi-tingkat" data-tingkat="II"><b>Tingkat II:</b> Skorsing maksimal 1 minggu.</div>
            <div class="sanksi-tingkat" data-tingkat="III"><b>Tingkat III:</b> Skorsing maksimal 1 bulan.</div>
            <div class="sanksi-tingkat" data-tingkat="IV"><b>Tingkat IV:</b> Dilarang mengikuti kegiatan akademik selama
                1 semester.</div>
            <div class="sanksi-tingkat" data-tingkat="V"><b>Tingkat V:</b> Dikeluarkan dari institusi (Drop Out).</div>
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
    <script src="../BackEnd/script.js"></script>
</body>

</html>