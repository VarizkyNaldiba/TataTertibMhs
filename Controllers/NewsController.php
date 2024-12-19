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
     * Tambah berita.
     */
    public function store($judul, $konten, $penulis_id, $gambar = null) {
        // Validasi input
        if (empty($judul) || empty($penulis_id) || empty($konten)) {
            throw new Exception("Semua input (judul, penulis, konten) harus diisi.");
        }
    
        // Proses gambar jika diunggah
        $gambarPath = null;
        if (!empty($gambar['name'])) {
            $uploadDir = '../document/news/'; // Direktori upload
            $fileName = time() . '_' . basename($gambar['name']);
            $uploadFile = $uploadDir . $fileName;
    
            // Cek tipe file
            $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($gambar['type'], $allowedTypes)) {
                throw new Exception("Format gambar tidak didukung.");
            }
    
            // Pindahkan file yang diunggah
            if (!move_uploaded_file($gambar['tmp_name'], $uploadFile)) {
                throw new Exception("Gagal mengunggah gambar.");
            }
    
            // Simpan path gambar ke database
            $gambarPath = 'document/news/' . $fileName;
        }
    
        // Query untuk menyimpan berita
        try {
            $query = "INSERT INTO news (judul, penulis_id, konten, gambar) VALUES (?, ?, ?, ?)";
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$judul, $penulis_id, $konten, $gambarPath]);

            return ['status' => 'success', 'message' => 'Berita berhasil disimpan.'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }

    /**
     * Update berita.
     */
    public function update($id, $judul, $konten, $gambar = null) {
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
            $gambarPath = $gambar['tmp_name'] ? $gambar['tmp_name'] : $oldNews['gambar'];
    
            // Proses unggah gambar baru jika ada
            if (!empty($gambar['name'])) {
                $uploadDir = '../document/news/'; // Direktori upload
                $fileName = time() . '_' . basename($gambar['name']);
                $uploadFile = $uploadDir . $fileName;
    
                // Cek tipe file
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
                if (!in_array($gambar['type'], $allowedTypes)) {
                    throw new Exception("Format gambar tidak didukung.");
                }
    
                // Pindahkan file ke direktori tujuan
                if (!move_uploaded_file($gambar['tmp_name'], $uploadFile)) {
                    throw new Exception("Gagal mengunggah gambar baru.");
                }
                $gambarPath = 'document/news/' . $fileName;
            }
    
            // Update data berita
            $query = "UPDATE news SET judul = ?, konten = ?, gambar = ? WHERE id_news = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$judul, $konten, $gambarPath, $id]);
    
            return ['status' => 'success', 'message' => 'Berita berhasil diperbarui.'];
        } catch (Exception $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
    
    /**
     * Hapus berita berdasarkan ID.
     */
    public function delete($id) {
        try {
            // Ambil path gambar untuk dihapus
            $stmt = $this->connect->prepare("SELECT gambar FROM news WHERE id_news = ?");
            $stmt->execute([$id]);
            $news = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($news && !empty($news['gambar'])) {
                $filePath = __DIR__ . '/../' . $news['gambar'];
                if (file_exists($filePath)) {
                    unlink($filePath); // Hapus file gambar
                }
            }

            // Hapus berita dari database
            $query = "DELETE FROM news WHERE id_news = ?";
            $stmt = $this->connect->prepare($query);
            $stmt->execute([$id]);

            return ['status' => 'success', 'message' => 'Berita berhasil dihapus.'];
        } catch (PDOException $e) {
            return ['status' => 'error', 'message' => $e->getMessage()];
        }
    }
}