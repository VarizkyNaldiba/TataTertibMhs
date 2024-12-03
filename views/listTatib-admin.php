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
    <link rel="stylesheet" href="../css/tatib-admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
</head>

<body>
    <div class="sidebar">
        <img class="logo" src="../img/logo copy.png" alt="logo">
        <div class="logo-separator"></div>
        <ul>
        <li><a href="home-admin.html"><i class="fa-solid fa-house"></i></a></li>
            <li class="active"><a href="listTatib-admin.php"><i class="fa-solid fa-book"></i></a></li>
            <li><a href="news-admin.html"><i class="fa-solid fa-newspaper"></i></a></li>
            <li class="logout"><a href="?logout=true"><i class="fa-solid fa-right-from-bracket"></i></a></li>
        </ul>
    </div>
<div class="content">
    <div class="header"></div>
    <div class="judul">
        <h1>DISCIPLINE</h1>
        <img src="../img/logo copy.png" alt="logo">
    </div>

    <button class="add-button" id="addButton">Tambah</button>
  <table class="news-table">
    <thead>
      <tr>
        <th>No</th>
        <th>Pelanggaran</th>
        <th>Tingkat</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>1</td>
        <td>Mahasiswa dengan NIM 2341024909 telah melakukan perusakan Fasilitas Jurusan Teknologi Informasi</td>
        <td>II</td>
        <td><button class="edit-button"><i class="fa-solid fa-pen-to-square"></i></button></td>
      </tr>
      <tr>
        <td>2</td>
        <td>Mahasiswa dengan NIM 2341024909 telah melakukan perusakan Fasilitas Jurusan Teknologi Informasi</td>
        <td>II</td>
        <td><button class="edit-button"><i class="fa-solid fa-pen-to-square"></i></button></td>
      </tr>
      <tr>
        <td>3</td>
        <td>Mahasiswa dengan NIM 2341024909 telah melakukan perusakan Fasilitas Jurusan Teknologi Informasi</td>
        <td>II</td>
        <td><button class="edit-button"><i class="fa-solid fa-pen-to-square"></i></button></td>
      </tr>
      <tr>
        <td>4</td>
        <td>Mahasiswa dengan NIM 2341024909 telah melakukan perusakan Fasilitas Jurusan Teknologi Informasi</td>
        <td>II</td>
        <td><button class="edit-button"><i class="fa-solid fa-pen-to-square"></i></button></td>
      </tr>
      <tr>
        <td>5</td>
        <td>Mahasiswa dengan NIM 2341024909 telah melakukan perusakan Fasilitas Jurusan Teknologi Informasi</td>
        <td>II</td>
        <td><button class="edit-button" onclick="openModal()"><i class="fa-solid fa-pen-to-square"></i></button></td>
      </tr>
    </tbody>
  </table>

  <!-- Modal -->
<div id="editModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Edit Pelanggaran</h2>
        <form id="editForm">
            <label for="nomor">no.</label>
            <input type="text" id="nomor" name="nomor" readonly>

            <label for="editKonten">Pelanggaran:</label>
            <textarea id="editKonten" name="konten" rows="4" required></textarea>

            <label for="editTingkat">Tingkat:</label>
            <input type="text" id="editTingkat" name="tingkat" required>

            <button type="submit" class="save-button">Simpan</button>
        </form>
    </div>
</div>

<!-- javascript -->
<script src="../BackEnd/admin-tatib.js"></script>

    <!-- footer -->
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

</body>
</html>