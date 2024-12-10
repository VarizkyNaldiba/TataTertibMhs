<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Design by foolishdeveloper.com -->
    <title>Login Mahasiswa</title>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <div class="sidebar">
  <img class="logo" src="../img/logo aja.png" alt="logo">
    <div class="logo-separator"></div>
    <ul>
    <li><a href="homepage.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="listTatib.php"><i class="fa-solid fa-book"></i></a></li>
            <li class="active"><a href="pelanggaranpage.php"><i class="fa-solid fa-hand"></i></i></a></li>
    </ul>
</div>
<div class="content">
  <div class="header">
    <h1>login</h1>
  </div>
  <form method="POST" action="">
    <div class="admin-button" onclick="redirectToPage('login.php')">Mahasiswa/Dosen</div>
    <h3>Masuk</h3>
    <input type="hidden" id="user-type" name="user_type" value="nim">
    <label for="username">NIP</label>
    <input type="text" placeholder="Masukkan NIP" id="username" name="username" required>
    <label for="password">Kata Sandi</label>
    <input type="password" placeholder="Masukkan Kata Sandi" id="password" name="password" required>
    <button type="submit">Masuk</button>
</form>
  </div>
    <script src="../js/login.js">
  </script>

</body>
</html>
