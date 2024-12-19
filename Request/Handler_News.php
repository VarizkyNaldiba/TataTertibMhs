<?php
session_start();
require_once '../config.php';
require_once '../Controllers/NewsController.php';

// Instansiasi controller
$newsController = new NewsController();

try {
    // Validasi jika tombol "store" diklik
    if (isset($_POST['store'])) {
        // Validasi input
        $judul = $_POST['judul'] ?? '';
        $penulis = $_POST['penulis'] ?? '';
        $konten = $_POST['konten'] ?? '';
        $gambar = $_FILES['gambar'] ?? null;

        // Input tidak boleh kosong
        if (empty($judul) || empty($penulis) || empty($konten)) {
            throw new Exception("Semua input (judul, penulis, konten) harus diisi.");
        }

        // Validasi ID admin
        if (!is_numeric($penulis)) {
            throw new Exception("ID Admin tidak valid.");
        }

        // Panggil method store()
        $result = $newsController->store($judul, $penulis, $konten, $gambar);
        $_SESSION['message'] = $result['message'] ?? 'Berita berhasil disimpan.';
        $_SESSION['status'] = $result['status'] ?? 'success';
    } 
    
    // Validasi jika tombol "update" diklik
    elseif (isset($_POST['update'])) {
        $newsId = $_POST['news_id'] ?? '';
        $judul = $_POST['judul'] ?? '';
        $konten = $_POST['konten'] ?? '';
        $penulis = $_POST['penulis'] ?? '';
        $gambar = $_FILES['gambar'] ?? null;

        // Input tidak boleh kosong
        if (empty($newsId) || empty($judul) || empty($konten) || empty($penulis)) {
            throw new Exception("Semua input wajib diisi.");
        }

        // Validasi ID admin
        if (!is_numeric($penulis)) {
            throw new Exception("ID Admin tidak valid.");
        }

        // Cek ID admin di database (opsional untuk validasi tambahan)
        $stmt = $this->connect->prepare("SELECT id_admin FROM ADMIN WHERE id_admin = ?");
        $stmt->execute([$penulis]);
        $penulis_id = $stmt->fetchColumn();

        if (!$penulis_id) {
            throw new Exception("Admin tidak ditemukan. Pastikan ID Admin benar.");
        }

        // Panggil method update()
        $result = $newsController->update($newsId, $judul, $konten, $penulis, $gambar);
        $_SESSION['message'] = $result['message'] ?? 'Berita berhasil diperbarui.';
        $_SESSION['status'] = $result['status'] ?? 'success';
    } 
    
    // Validasi jika tombol "delete" diklik
    elseif (isset($_POST['delete'])) {
        $newsId = $_POST['news_id'] ?? '';

        if (empty($newsId)) {
            throw new Exception("ID berita tidak boleh kosong.");
        }

        // Panggil method delete()
        $result = $newsController->delete($newsId);
        $_SESSION['message'] = $result['message'] ?? 'Berita berhasil dihapus.';
        $_SESSION['status'] = $result['status'] ?? 'success';
    } 
    else {
        throw new Exception("Aksi tidak valid.");
    }
} catch (Exception $e) {
    // Tangkap semua error
    $_SESSION['message'] = 'Error: ' . $e->getMessage();
    $_SESSION['status'] = 'error';
}

// Redirect ke halaman admin
header("Location: ../views/news-admin.php");
exit();
