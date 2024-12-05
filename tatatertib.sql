-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 15 Okt 2024 pada 08.50
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tatatertib`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tatatertib`
--

CREATE TABLE `tatatertib` (
  `id` int(11) NOT NULL,
  `pelanggaran` text NOT NULL,
  `tingkat` varchar(50) NOT NULL,
  `poin` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tatatertib`
--

INSERT INTO `tatatertib` (`id`, `pelanggaran`, `tingkat`, `poin`) VALUES
(1, 'Berkomunikasi dengan tidak sopan, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, karyawan, atau orang lain', 'Tingkat V', 1),
(2, 'Berbusana tidak sopan dan tidak rapi (contoh: berpakaian ketat, transparan, memakai t-shirt, dll)', 'Tingkat IV', 2),
(3, 'Mahasiswa laki-laki berambut tidak rapi, gondrong', 'Tingkat IV', 2),
(4, 'Mahasiswa berambut dengan model punk, dicat selain hitam', 'Tingkat IV', 2),
(5, 'Makan atau minum di dalam ruang kuliah/laboratorium/bengkel', 'Tingkat IV', 2),
(6, 'Melanggar peraturan yang berlaku di Polinema', 'Tingkat III', 5),
(7, 'Tidak menjaga kebersihan di seluruh area Polinema', 'Tingkat III', 5),
(8, 'Membuat kegaduhan yang mengganggu pelaksanaan perkuliahan', 'Tingkat III', 5),
(9, 'Merokok di luar area kawasan merokok', 'Tingkat III', 5),
(10, 'Bermain kartu, game online di area kampus', 'Tingkat III', 5),
(11, 'Mengotori atau mencoret-coret meja, kursi, tembok di lingkungan Polinema', 'Tingkat III', 5),
(12, 'Bertingkah laku kasar atau tidak sopan kepada mahasiswa, dosen, dan/atau karyawan', 'Tingkat III', 5),
(13, 'Merusak sarana dan prasarana yang ada di area Polinema', 'Tingkat II', 7),
(14, 'Tidak menjaga ketertiban dan keamanan di seluruh area Polinema', 'Tingkat II', 7),
(15, 'Melakukan pengotoran/pengrusakan barang milik orang lain', 'Tingkat II', 7),
(16, 'Mengakses materi pornografi di kelas atau area kampus', 'Tingkat II', 7),
(17, 'Membawa dan/atau menggunakan senjata tajam dan/atau senjata api untuk hal kriminal', 'Tingkat II', 7),
(18, 'Melakukan perkelahian, serta membentuk geng/kelompok yang bertujuan negatif', 'Tingkat II', 7),
(19, 'Melakukan kegiatan politik praktis di dalam kampus', 'Tingkat II', 7),
(20, 'Melakukan tindakan kekerasan atau perkelahian di dalam kampus', 'Tingkat II', 7),
(21, 'Melakukan penyalahgunaan identitas untuk perbuatan negatif', 'Tingkat II', 7),
(22, 'Mengancam, baik tertulis atau tidak tertulis kepada mahasiswa, dosen, dan/atau karyawan', 'Tingkat II', 7),
(23, 'Mencuri dalam bentuk apapun', 'Tingkat I/II', 7),
(24, 'Melakukan kecurangan dalam bidang akademik, administratif, dan keuangan', 'Tingkat I/II', 7),
(25, 'Melakukan pemerasan dan/atau penipuan', 'Tingkat I/II', 7),
(26, 'Melakukan pelecehan dan/atau tindakan asusila dalam segala bentuk di dalam dan di luar kampus', 'Tingkat I/II', 7),
(27, 'Berjudi, mengkonsumsi minum-minuman keras, dan/atau bermabuk-mabukan di lingkungan dan di luar lingkungan Kampus Polinema', 'Tingkat I/II', 7),
(28, 'Mengikuti organisasi dan atau menyebarkan faham-faham yang dilarang oleh Pemerintah', 'Tingkat I/II', 7),
(29, 'Melakukan pemalsuan data / dokumen / tanda tangan', 'Tingkat I/II', 7),
(30, 'Melakukan plagiasi (copy paste) dalam tugas-tugas atau karya ilmiah', 'Tingkat I/II', 7),
(31, 'Tidak menjaga nama baik Polinema di masyarakat dan/atau mencemarkan nama baik Polinema melalui media apapun', 'Tingkat I', 10),
(32, 'Melakukan kegiatan atau sejenisnya yang dapat menurunkan kehormatan atau martabat Negara, Bangsa dan Polinema', 'Tingkat I', 10),
(33, 'Menggunakan barang-barang psikotropika dan/atau zat-zat adiktif lainnya', 'Tingkat I', 10),
(34, 'Mengedarkan serta menjual barang-barang psikotropika dan/atau zat-zat adiktif lainnya', 'Tingkat I', 10),
(35, 'Terlibat dalam tindakan kriminal dan dinyatakan bersalah oleh Pengadilan', 'Tingkat I', 10);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tatatertib`
--
ALTER TABLE `tatatertib`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tatatertib`
--
ALTER TABLE `tatatertib`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
