<?php
require_once __DIR__ . '/../Models/News.php';

class NewsController {
    private $newsModel;
    private $connect;

    public function __construct($connect = null) {
        $this->newsModel = new News();
        
        // If no connection is passed, try to get it globally
        if ($connect === null) {
            global $connect;
        }
        
        $this->connect = $connect;
    }

    // Metode untuk mendapatkan berita berdasarkan ID admin
    public function AdminNews($id) {
        $query = "SELECT * FROM news WHERE penulis_id = :id_admin";
        $stmt = $this->connect->prepare($query);
        $stmt->bindParam(':id_admin', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        // Mengembalikan hasil sebagai array
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function getNewsById($id) {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM NEWS WHERE id_news = ?");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Log or display the error
            echo "Error: " . $e->getMessage();
            return null;
        }
    }

    /**
     * Ambil semua berita.
     */
    public function ReadNews() {
        return $this->newsModel->getAllNews();
    }

    /**
     * Ambil berita berdasarkan ID penulis (admin).
     */
    public function store($judul, $penulis, $konten, $gambar)
    {
        // Validasi input
        if (empty($judul) || empty($penulis) || empty($konten)) {
            die("Semua input harus diisi.");
        }
    
        // Proses gambar jika diunggah
        if (!empty($gambar['name'])) {
            $uploadDir = '../document/news/'; // Direktori upload
            $uploadFile = $uploadDir . basename($gambar['name']);
    
            // Cek tipe file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($gambar['type'], $allowedTypes)) {
                die("Format gambar tidak didukung.");
            }
    
            // Pindahkan file yang diunggah
            if (!move_uploaded_file($gambar['tmp_name'], $uploadFile)) {
                die("Gagal mengunggah gambar.");
            }
    
            // Simpan path gambar ke database
            $gambarPath = 'document/news/' . basename($gambar['name']);
        } else {
            $gambarPath = null; // Jika tidak ada gambar
        }
    
        // Cek ID admin berdasarkan nama_admin (penulis)
        try {
            $stmt = $this->connect->prepare("SELECT id_admin FROM ADMIN WHERE nama_admin = ?");
            $stmt->execute([$penulis]);
            $penulis_id = $stmt->fetchColumn();
    
            // Jika admin tidak ditemukan, kembalikan pesan error
            if (!$penulis_id) {
                die("Admin tidak ditemukan. Pastikan nama admin benar.");
            }
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    
        // Query untuk menyimpan berita
        $query = "INSERT INTO news (judul, penulis_id, konten, gambar) VALUES (?, ?, ?, ?)";
        $stmt = $this->connect->prepare($query);
        $stmt->execute([$judul, $penulis_id, $konten, $gambarPath]);
    }

    public function update($id, $judul, $konten, $gambarPath = null) {
        try {
            // Validasi ID berita
            if (empty($id)) {
                throw new Exception("ID berita tidak valid.");
            }
    
            // Ambil data lama
            $stmt = $this->connect->prepare("SELECT gambar FROM news WHERE id_news = ?");
            $stmt->execute([$id]);
            $oldNews = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if (!$oldNews) {
                throw new Exception("Data berita tidak ditemukan.");
            }
    
            // Tentukan gambar yang akan digunakan
            $gambar = $gambarPath ?: $oldNews['gambar'];
    
            // Update data berita
            $query = "UPDATE news SET judul = ?, konten = ?, gambar = ? WHERE id_news = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$judul, $konten, $gambar, $id]);
    
            return ['status' => 'success', 'message' => 'Berita berhasil diperbarui.'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
    
    /**
     * Hapus berita berdasarkan ID.
     */
    public function delete($id) {
        // Ambil path gambar untuk dihapus
        $news = $this->newsModel->getNewsById($id);
        if ($news && !empty($news['gambar'])) {
            $filePath = __DIR__ . '/../' . $news['gambar'];
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file gambar
            }
        }

        // Hapus berita dari database
        $result = $this->newsModel->deleteNews($id);

        if ($result) {
            return ['status' => 'success', 'message' => 'Berita berhasil dihapus.'];
        } else {
            return ['status' => 'error', 'message' => 'Gagal menghapus berita.'];
        }
    }
}
?>