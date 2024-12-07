-- Menambahkan data dummy ke tabel PRODI
INSERT INTO PRODI (id_prodi, nama_prodi, jurusan)
VALUES
    ('TI01', 'Teknik Informatika', 'Teknologi Informasi'),
    ('TI02', 'Sistem Informasi Bisnis', 'Teknologi Informasi'),
    ('TI03', 'Pengembangan Perangkat Lunak Sistem', 'Teknologi Informasi');

-- Data Dummy untuk Tabel DOSEN
INSERT INTO DOSEN (nidn, nama_lengkap, email, jabatan, id_prodi, password, role)
VALUES
    ('1234567890', 'Dr. Andi Wijaya', 'andi.wijaya@polinema.ac.id', 'DPA', 'TI01', 'password123', 'dosen'),
    ('1234567891', 'Prof. Siti Aminah', 'siti.aminah@polinema.ac.id', 'Kajur', 'TI01', 'password456', 'dosen'),
    ('1234567892', 'Dr. Bambang Sutrisno', 'bambang.sutrisno@polinema.ac.id', 'DPA', 'TI02', 'password789', 'dosen'),
    ('1234567893', 'Dr. Sri Wahyuni', 'sri.wahyuni@polinema.ac.id', 'Dosen Tetap', 'TI02', 'password101', 'dosen');


-- Data Dummy untuk Tabel MAHASISWA (dengan id_dpa)
INSERT INTO MAHASISWA (nim, nama_lengkap, email, angkatan, id_prodi, id_dpa, password, role)
VALUES
    ('2347120088', 'Ahmad Irsyad', 'ahmad.irsyad@student.example.com', 2023, 'TI01', 2, 'password123', 'mahasiswa'),
    ('2347120090', 'Budi Santoso', 'budi.santoso@student.example.com', 2023, 'TI01', 3, 'password456', 'mahasiswa'),
    ('2347120100', 'Citra Dewi', 'citra.dewi@student.example.com', 2023, 'TI01', 4, 'password789', 'mahasiswa'),
    ('2347120110', 'Dian Putri', 'dian.putri@student.example.com', 2023, 'TI02', 4, 'password101', 'mahasiswa'),
    ('2347120120', 'Eko Prasetyo', 'eko.prasetyo@student.example.com', 2023, 'TI02', 5, 'password102', 'mahasiswa');

-- Data Dummy untuk Tabel ADMIN
INSERT INTO ADMIN (NIP, password)
VALUES
('ADMIN001', 'admin123'),
('ADMIN002', 'admin456'),
('ADMIN003', 'admin789'),
('ADMIN004', 'admin101'),
('ADMIN005', 'admin102');

-- Data Dummy untuk Tabel TATA_TERTIB
INSERT INTO TATA_TERTIB (deskripsi, tingkat, poin)
VALUES
    -- Tingkat V (Poin 2)
    ('Berkomunikasi dengan tidak sopan, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, karyawan, atau orang lain', 'V', 2),

    -- Tingkat IV (Poin 4)
    ('Berbusana tidak sopan dan tidak rapi. Yaitu antara lain adalah: berpakaian ketat, transparan, memakai t-shirt (baju kaos tidak berkerah), tank top, hipster, you can see, rok mini, backless, celana pendek, celana tiga per empat, legging, model celana atau baju koyak, sandal, sepatu sandal di lingkungan kampus', 'IV', 4),
    ('Mahasiswa laki-laki berambut tidak rapi, gondrong yaitu panjang rambutnya melewati batas alis mata di bagian depan, telinga di bagian samping atau menyentuh kerah baju di bagian leher', 'IV', 4),
    ('Mahasiswa berambut dengan model punk, dicat selain hitam dan/atau skinned.', 'IV', 4),
    ('Makan, atau minum di dalam ruang kuliah/laboratorium/bengkel.', 'IV', 4),

    -- Tingkat III (Poin 8)
    ('Melanggar peraturan/ketentuan yang berlaku di Polinema baik di Jurusan/Program Studi', 'III', 8),
    ('Tidak menjaga kebersihan di seluruh area Polinema', 'III', 8),
    ('Membuat kegaduhan yang mengganggu pelaksanaan perkuliahan atau praktikum yang sedang berlangsung', 'III', 8),
    ('Merokok di luar area kawasan merokok', 'III', 8),
    ('Bermain kartu, game online di area kampus', 'III', 8),
    ('Mengotori atau mencoret-coret meja, kursi, tembok, dan lain-lain di lingkungan Polinema', 'III', 8),
    ('Bertingkah laku kasar atau tidak sopan kepada mahasiswa, dosen, dan/atau karyawan.', 'III', 8),

    -- Tingkat II (Poin 16)
    ('Merusak sarana dan prasarana yang ada di area Polinema', 'II', 16),
    ('Tidak menjaga ketertiban dan keamanan di seluruh area Polinema (misalnya: parkir tidak pada tempatnya, konvoi selebrasi wisuda dll)', 'II', 16),
    ('Melakukan pengotoran/pengrusakan barang milik orang lain termasuk milik Politeknik Negeri Malang', 'II', 16),
    ('Mengakses materi pornografi di kelas atau area kampus', 'II', 16),
    ('Membawa dan/atau menggunakan senjata tajam dan/atau senjata api untuk hal kriminal', 'II', 16),
    ('Melakukan perkelahian, serta membentuk geng/kelompok yang bertujuan negatif.', 'II', 16),
    ('Melakukan kegiatan politik praktis di dalam kampus', 'II', 16),
    ('Melakukan tindakan kekerasan atau perkelahian di dalam kampus.', 'II', 16),
    ('Melakukan penyalahgunaan identitas untuk perbuatan negatif', 'II', 16),
    ('Mengancam, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, dan/atau karyawan.', 'II', 16),

    -- Tingkat I (Poin 32)
    ('Mencuri dalam bentuk apapun', 'I', 32),
    ('Melakukan kecurangan dalam bidang akademik, administratif, dan keuangan.', 'I', 32),
    ('Melakukan pemerasan dan/atau penipuan', 'I', 32),
    ('Melakukan pelecehan dan/atau tindakan asusila dalam segala bentuk di dalam dan di luar kampus', 'I', 32),
    ('Berjudi, mengkonsumsi minum-minuman keras, dan/atau bermabuk-mabukan di lingkungan dan di luar lingkungan Kampus Polinema', 'I', 32),
    ('Mengikuti organisasi dan atau menyebarkan faham-faham yang dilarang oleh Pemerintah.', 'I', 32),
    ('Melakukan pemalsuan data / dokumen / tanda tangan.', 'I', 32),
    ('Melakukan plagiasi (copy paste) dalam tugas-tugas atau karya ilmiah', 'I', 32),
    ('Tidak menjaga nama baik Polinema di masyarakat dan/atau mencemarkan nama baik Polinema melalui media apapun', 'I', 32),
    ('Melakukan kegiatan atau sejenisnya yang dapat menurunkan kehormatan atau martabat Negara, Bangsa dan Polinema.', 'I', 32),
    ('Menggunakan barang-barang psikotropika dan/atau zat-zat Adiktif lainnya', 'I', 32),
    ('Mengedarkan serta menjual barang-barang psikotropika dan/atau zat-zat Adiktif lainnya', 'I', 32),
    ('Terlibat dalam tindakan kriminal dan dinyatakan bersalah oleh Pengadilan', 'I', 32);


-- Data Dummy untuk Tabel SANKSI (dipisah sub-bab nya)
INSERT INTO SANKSI (tingkat, deskripsi)
VALUES
    ('V', 'Teguran lisan disertai dengan surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa yang bersangkutan dan DPA'),
    ('IV', 'Teguran tertulis disertai dengan pemanggilan orang tua/wali dan membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa, orang tua/wali, dan DPA'),
    ('III', 'Membuat surat pernyataan tidak mengulangi perbuatan tersebut, dibubuhi materai, ditandatangani mahasiswa, orang tua/wali, dan DPA'),
    ('III', 'Melakukan tugas khusus, misalnya bertanggung jawab untuk memperbaiki atau membersihkan kembali, dan tugas-tugas lainnya'),
    ('II', 'Dikenakan penggantian kerugian atau penggantian benda/barang semacamnya'),
    ('II', 'Melakukan tugas layanan sosial dalam jangka waktu tertentu'),
    ('II', 'Diberikan nilai D pada mata kuliah terkait saat melakukan pelanggaran'),
    ('I', 'Dinonaktifkan (Cuti Akademik/Terminal) selama dua semester'),
    ('I', 'Diberhentikan sebagai mahasiswa');

-- Data Dummy untuk tabel DETAIL_PELANGGARAN
INSERT INTO DETAIL_PELANGGARAN (id_dosen, id_tata_tertib, id_mahasiswa, id_sanksi, tugas_khusus, detail_tugas_khusus, pengumpulan_tgsKhusus, surat, pengumpulan_surat, status, status_tugas)
VALUES 
-- Pelanggaran 1
(1, 2, 3, 4, 
 'Membuat Artikel', 
 'Mahasiswa wajib membuat artikel tentang etika kedisiplinan minimal 1000 kata.', 
 'data:application/pdf;base64,JVBERi0xLjQKJcfsj6IK...', 
 'data:application/pdf;base64,JVBERi0xLjQKJcfsj7IK...', 
 NULL, 
 'Pending', 
 'Belum Diberikan'),

-- Pelanggaran 2
(2, 1, 5, 2, 
 'Membersihkan Ruangan', 
 'Mahasiswa diwajibkan membersihkan ruangan kelas G-102 dan melampirkan bukti foto.', 
 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD...', 
 'data:application/pdf;base64,JVBERi0xLjQKJcfsj8IK...', 
 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUA...', 
 'Terverifikasi', 
 'Sudah Diberikan'),

-- Pelanggaran 3
(3, 3, 6, 3, 
 'Mengikuti Seminar', 
 'Mahasiswa diwajibkan mengikuti seminar kedisiplinan dan melampirkan ringkasan.', 
 'data:application/pdf;base64,JVBERi0xLjQKJcfsj9IK...', 
 'data:application/pdf;base64,JVBERi0xLjQKJcfsj10IK...', 
 NULL, 
 'Pending', 
 'Belum Diberikan'),

-- Pelanggaran 4
(4, 4, 7, 5, 
 'Membuat Poster', 
 'Mahasiswa harus membuat poster digital tentang peraturan kampus dengan format PNG.', 
 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUA...', 
 'data:application/pdf;base64,JVBERi0xLjQKJcfsj11IK...', 
 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAUA...', 
 'Selesai', 
 'Sudah Diberikan'),

-- Pelanggaran 5
(5, 5, 8, 1, 
 'Menulis Ringkasan Buku', 
 'Mahasiswa wajib membaca buku tentang etika mahasiswa dan membuat ringkasan minimal 500 kata.', 
 'data:application/pdf;base64,JVBERi0xLjQKJcfsj12IK...', 
 'data:application/pdf;base64,JVBERi0xLjQKJcfsj13IK...', 
 NULL, 
 'Pending', 
 'Belum Diberikan');

-- Data Dummy untuk Tabel NOTIFIKASI
INSERT INTO NOTIFIKASI (id_mhs, id_dosen, pesan, status, role_penerima)
VALUES
    (2, NULL, 'Anda mendapatkan teguran lisan terkait pelanggaran tata tertib.', 'unread', 'mahasiswa'),
    (NULL, 2, 'Laporan pelanggaran mahasiswa Budi Santoso telah selesai.', 'read', 'dosen'),
    (3, NULL, 'Anda mendapatkan surat peringatan untuk pelanggaran tata tertib.', 'unread', 'mahasiswa'),
    (NULL, 4, 'Mahasiswa Dian Putri melanggar aturan dan telah disanksi.', 'read', 'dosen'),
    (5, NULL, 'Laporan pelanggaran mahasiswa Eko Prasetyo telah selesai.', 'unread', 'mahasiswa');

-- Data Dummy untuk Tabel NEWS
INSERT INTO NEWS (judul, konten, penulis_id)
VALUES
    ('Perubahan Tata Tertib Kampus', 'Mulai semester ini, aturan terkait kehadiran diperketat.', 1),
    ('Pelatihan Anti Kekerasan', 'Mahasiswa yang melanggar akan diwajibkan mengikuti pelatihan.', 2),
    ('Peningkatan Disiplin', 'Kami mengajak seluruh mahasiswa meningkatkan kedisiplinan.', 3),
    ('Larangan Merokok', 'Merokok di area kampus akan dikenakan sanksi tegas.', 4),
    ('Penggunaan Seragam Baru', 'Setiap mahasiswa wajib menggunakan seragam sesuai program studi.', 5);
