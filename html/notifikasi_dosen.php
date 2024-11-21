<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Italiana&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css" />
    <link rel="stylesheet" href="../css/notifikasi.css">
</head>
<body>
<div class="sidebar">
    <img class="logo" src="../img/logo copy.png" alt="logo">
    <div class="logo-separator"></div>
    <ul>
    <li><a href="homepage.php"><i class="fa-solid fa-house"></i></a></li>
            <li><a href="listTatib.php"><i class="fa-solid fa-book"></i></a></li>
            <li><a href="pelanggaranpage.php"><i class="fa-solid fa-hand"></i></i></a></li>
            <li class="active"><a href="notifikasi_dosen.php"><i class="fa-solid fa-bell"></i></a></li>
    </ul>
</div>
    <div class="content">
    <div class="header">
            <h1>Notifikasi</h1>
        </div>
        <div class="container">
    <!-- Sidebar -->
    <div class="side">
            <div class="profile">
                <img src="profile-placeholder.png" alt="Profile" class="profile-image">
                <h2>Wawan Agung</h2>
                <p>Dosen</p>
            </div>
            <div class="menu">
                <button class="menu-btn active">Semua</button>
                <button class="menu-btn">Pelapor</button>
                <button class="menu-btn">DPA</button>
            </div>
        </div>

        <!-- Notifications Section -->
        <div class="notifications">
            <div class="notification-item">
                <div class="icon">
                    <img src="icon-placeholder.png" alt="Icon">
                </div>
                <div class="notification-content">
                    <p><strong>Dosen A</strong> telah melaporkan <strong>Tri Sukma Sarah</strong>, Mahasiswa telah Melanggar Tata Tertib Mahasiswa <strong>Tingkat III</strong></p>
                    <small>5m ago</small>
                </div>
            </div>

            <div class="notification-item">
                <div class="icon">
                    <img src="icon-placeholder.png" alt="Icon">
                </div>
                <div class="notification-content">
                    <p><strong>Dosen Pembimbing Akademik</strong> telah memberikan tugas khusus kepada <strong>Ghoffar Abdullah</strong></p>
                    <small>5m ago</small>
                </div>
            </div>

            <!-- Duplicate items for demonstration -->
            <div class="notification-item">
                <div class="icon">
                    <img src="icon-placeholder.png" alt="Icon">
                </div>
                <div class="notification-content">
                    <p><strong>Dosen Pembimbing Akademik</strong> telah memberikan tugas khusus kepada <strong>Ghoffar Abdullah</strong></p>
                    <small>5m ago</small>
                </div>
            </div>
        </div>
        </div>
        <div class="footer">
                <p>© Copyright 2024 web Tatib. All Rights Reserved.</p>
                <img class="footer-logo" src="../img/Logo name.png" alt="">
            </div>
        </div>
    </div>
    

</body>
</html>