<?php
require_once 'config/database.php';
require_once 'controllers/TatibController.php';

// Menangani URL, pastikan tidak ada awalan atau akhiran garis miring '/' pada URL
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';

// Routing URL berdasarkan nilai yang didapatkan
switch ($url) {
    case 'home':
        include 'views/Home.php'; // Pastikan file ini sesuai dengan penulisan
        break;
    case 'tatatertib':
        $controller = new TatibController();
        $controller->index(); // Memanggil metode index dari controller Tatib
        break;
    default:
        echo "404 Not Found"; // Tampilkan pesan kesalahan jika URL tidak ditemukan
        break;
}
