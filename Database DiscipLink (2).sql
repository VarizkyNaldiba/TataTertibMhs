drop database DiscipLink;

CREATE DATABASE DiscipLink;

USE DiscipLink;

-- Tabel untuk prodi
CREATE TABLE PRODI(
	id_prodi VARCHAR(20) PRIMARY KEY, 
	nama_prodi VARCHAR(100) NOT NULL,
	jurusan VARCHAR(100)
);

-- Tabel untuk Admin
CREATE TABLE ADMIN (
    id_admin INT PRIMARY KEY IDENTITY(1,1),
    NIP VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,  -- Bisa diisi dengan 'admin'
);

-- Tabel untuk Dosen
CREATE TABLE DOSEN (
    id_dosen INT PRIMARY KEY IDENTITY(1,1),
    nidn VARCHAR(20) UNIQUE NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    jabatan VARCHAR(50) NOT NULL,  -- Seperti 'DPA', 'Kajur', dll
    id_prodi VARCHAR(20) NOT NULL, -- Foreign Key ke tabel PRODI
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,  -- Bisa diisi dengan 'dosen'
    CONSTRAINT FK_DosenProdi FOREIGN KEY (id_prodi) REFERENCES PRODI(id_prodi)
);

-- Tabel untuk Mahasiswa
CREATE TABLE MAHASISWA (
    id_mhs INT PRIMARY KEY IDENTITY(1,1),
    nim VARCHAR(20) UNIQUE NOT NULL,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    angkatan INT NOT NULL,
    id_prodi VARCHAR(20) NOT NULL, -- Foreign Key ke tabel PRODI
	id_dpa INT NOT NULL, -- FK ke tabel dosen yang menjadi DPA mahasiswa
    password VARCHAR(255) NOT NULL,
    role VARCHAR(50) NOT NULL,  -- Bisa diisi dengan 'mahasiswa'
    CONSTRAINT FK_MahasiswaProdi FOREIGN KEY (id_prodi) REFERENCES PRODI(id_prodi),
	CONSTRAINT FK_MahasiswaDPA FOREIGN KEY (id_dpa) REFERENCES DOSEN(id_dosen)
);

-- Tabel untuk Tata Tertib
CREATE TABLE TATA_TERTIB (
    id_tata_tertib INT PRIMARY KEY IDENTITY(1,1),
	id_adminTatib INT,
    deskripsi VARCHAR(MAX) NOT NULL,
    tingkat VARCHAR(5) NOT NULL,  -- 1-5, tingkat pelanggaran
    poin INT NOT NULL      -- Poin sesuai dengan tingkat pelanggaran
	CONSTRAINT FK_AdminTaTib FOREIGN KEY (id_adminTatib) REFERENCES ADMIN(id_admin)
);

-- Tabel untuk Sanksi
CREATE TABLE SANKSI (
    id_sanksi INT PRIMARY KEY IDENTITY(1,1),
	tingkat VARCHAR(5) NOT NULL, 
    deskripsi VARCHAR(255) NOT NULL
);

-- Tabel untuk Detail Pelanggaran
CREATE TABLE DETAIL_PELANGGARAN (
    id_detail INT PRIMARY KEY IDENTITY(1,1),
    id_dosen INT NOT NULL,  -- ID Dosen yang melaporkan pelanggaran
    id_tata_tertib INT NOT NULL,  -- ID Tata Tertib yang dilanggar
    id_mahasiswa INT NOT NULL,  -- ID Mahasiswa yang melakukan pelanggaran
    id_sanksi INT NOT NULL,  -- ID Sanksi yang diberikan
    tugas_khusus VARCHAR(255),
	detail_tugas_khusus VARCHAR(MAX),
    surat VARCHAR(255),  -- Penyimpanan path ke file agar lebih ringan
    status VARCHAR(50) NOT NULL DEFAULT 'Pending',  -- Status pelanggaran (misalnya: 'pending', 'terverifikasi', dll.)
	status_tugas VARCHAR(50) DEFAULT 'Belum Diberikan', -- status tugas khusus apakah sudah diiberikan atau tidak
    CONSTRAINT FK_Dosen FOREIGN KEY (id_dosen) REFERENCES DOSEN(id_dosen),
    CONSTRAINT FK_TataTertib FOREIGN KEY (id_tata_tertib) REFERENCES TATA_TERTIB(id_tata_tertib),
    CONSTRAINT FK_Mahasiswa FOREIGN KEY (id_mahasiswa) REFERENCES MAHASISWA(id_mhs),
    CONSTRAINT FK_Sanksi FOREIGN KEY (id_sanksi) REFERENCES SANKSI(id_sanksi)
);

-- Tabel untuk Notifikasi
CREATE TABLE NOTIFIKASI (
    id_notifikasi INT PRIMARY KEY IDENTITY(1,1),
    id_mhs INT NULL, -- ID Mahasiswa yang menerima notifikasi
    id_dosen INT NULL, -- ID Dosen (pelapor) yang menerima notifikasi
    id_admin INT NULL, -- ID Admin yang menerima notifikasi
    id_detail_pelanggaran INT, -- ID Pelanggaran tertentu (relasi ke DETAIL_PELANGGARAN)
    pesan TEXT NOT NULL,
    status VARCHAR(50) NOT NULL, -- Status notifikasi ('unread', 'read')
    role_penerima VARCHAR(50) NOT NULL, -- 'mahasiswa', 'dosen', atau 'admin'
    CONSTRAINT FK_NotifMahasiswa FOREIGN KEY (id_mhs) REFERENCES MAHASISWA(id_mhs),
    CONSTRAINT FK_NotifDosen FOREIGN KEY (id_dosen) REFERENCES DOSEN(id_dosen),
    CONSTRAINT FK_NotifAdmin FOREIGN KEY (id_admin) REFERENCES ADMIN(id_admin),
    CONSTRAINT FK_NotifPelanggaran FOREIGN KEY (id_detail_pelanggaran) REFERENCES DETAIL_PELANGGARAN(id_detail)
);

-- Tabel untuk News (Berita) yang dikelola oleh Admin
CREATE TABLE NEWS (
    id_news INT PRIMARY KEY IDENTITY(1,1),
    judul VARCHAR(100) NOT NULL,
    konten TEXT NOT NULL,
    penulis_id INT NOT NULL,  -- ID Admin yang membuat berita
	gambar VARCHAR(255), -- path gambar
    CONSTRAINT FK_AdminNews FOREIGN KEY (penulis_id) REFERENCES ADMIN(id_admin)
);

-- Views Pelanggaran Mahasiswa
CREATE VIEW v_PelanggaranMahasiswa AS
SELECT 
	DP.id_detail,
    M.nim,
	T.deskripsi AS pelanggaran,
	T.tingkat,
	S.deskripsi AS sanksi,
	D.nama_lengkap,
	DP.tugas_khusus,
	DP.surat,
	T.poin,
    DP.status
FROM DETAIL_PELANGGARAN DP
JOIN MAHASISWA M ON DP.id_mahasiswa = M.id_mhs
JOIN TATA_TERTIB T ON DP.id_tata_tertib = T.id_tata_tertib
JOIN SANKSI S ON DP.id_sanksi = S.id_sanksi
JOIN DOSEN D ON DP.id_dosen = D.id_dosen;

-- Views Pelanggaran Mahasiswa POV Dosen
CREATE VIEW v_DosenMelaporkan AS
SELECT 
	dp.id_detail,
	d.nidn,
    m.nama_lengkap AS nama_mahasiswa,
	T.deskripsi AS pelanggaran,
	T.tingkat,
    d.nama_lengkap AS dosen_pengampu,
	dp.tugas_khusus,
	dp.surat,
	t.poin,
    dp.status AS status_pelanggaran
FROM DETAIL_PELANGGARAN dp
JOIN DOSEN d ON dp.id_dosen = d.id_dosen
JOIN MAHASISWA m ON dp.id_mahasiswa = m.id_mhs
JOIN TATA_TERTIB t ON dp.id_tata_tertib = t.id_tata_tertib;

-- auto notif Dosen
CREATE PROCEDURE sp_PelanggaranDosenNotif
    @id_dosen INT,
    @id_mahasiswa INT,
    @id_detail INT
AS
BEGIN
    DECLARE @pesan NVARCHAR(MAX);

    -- Buat pesan notifikasi
    SET @pesan = CONCAT('Mahasiswa dengan NIM ', 
                        (SELECT nim FROM MAHASISWA WHERE id_mhs = @id_mahasiswa),
                        ' telah dilaporkan oleh Anda.');

    -- Masukkan notifikasi ke tabel NOTIFIKASI
    INSERT INTO NOTIFIKASI (id_dosen, id_mhs, id_detail_pelanggaran, pesan, status, role_penerima)
    VALUES (@id_dosen, @id_mahasiswa, @id_detail, @pesan, 'unread', 'dosen');
END;

-- auto notif mahasiswa terlapor
CREATE PROCEDURE sp_TugasKhususNotif
    @id_dosen INT,
    @id_mahasiswa INT,
    @id_detail INT
AS
BEGIN
    DECLARE @pesan NVARCHAR(MAX);

    -- Buat pesan notifikasi
    SET @pesan = CONCAT('Mahasiswa dengan NIM ', 
                        (SELECT nim FROM MAHASISWA WHERE id_mhs = @id_mahasiswa),
                        ' telah mengunggah tugas khusus yang perlu Anda periksa.');

    -- Masukkan notifikasi ke tabel NOTIFIKASI
    INSERT INTO NOTIFIKASI (id_dosen, id_mhs, id_detail_pelanggaran, pesan, status, role_penerima)
    VALUES (@id_dosen, @id_mahasiswa, @id_detail, @pesan, 'unread', 'dosen');
END;

-- auto notif mahasiswa dilaporkan
CREATE PROCEDURE sp_PelanggaranMahasiswaNotif
    @id_dosen INT,
    @id_mahasiswa INT,
    @id_detail INT
AS
BEGIN
    DECLARE @pesan NVARCHAR(MAX);

    -- Buat pesan notifikasi
    SET @pesan = CONCAT('Anda telah dilaporkan melakukan pelanggaran oleh ',
					(SELECT nama_lengkap FROM DOSEN WHERE id_dosen = @id_dosen));

    -- Masukkan notifikasi ke tabel NOTIFIKASI
    INSERT INTO NOTIFIKASI (id_dosen, id_mhs, id_detail_pelanggaran, pesan, status, role_penerima)
    VALUES (@id_dosen, @id_mahasiswa, @id_detail, @pesan, 'unread', 'mahasiswa');
END;

-- view notif Dosen
CREATE VIEW v_NotifikasiDosen AS
SELECT 
    N.id_notifikasi,
	D.nidn,
    D.nama_lengkap AS nama_dosen,
    M.nama_lengkap AS nama_mahasiswa,
    N.pesan,
    N.status
FROM NOTIFIKASI N
LEFT JOIN DOSEN D ON N.id_dosen = D.id_dosen
LEFT JOIN MAHASISWA M ON N.id_mhs = M.id_mhs
WHERE N.role_penerima = 'dosen';

-- view notif mahasiswa
CREATE VIEW v_NotifikasiMahasiswa AS
SELECT 
    N.id_notifikasi,
	M.nim,
    M.nama_lengkap AS nama_mahasiswa,
    N.pesan,
    N.status
FROM NOTIFIKASI N
LEFT JOIN MAHASISWA M ON N.id_mhs = M.id_mhs
WHERE N.role_penerima = 'mahasiswa';

-- sp insert detail pelanggaran
CREATE PROCEDURE sp_InsertDetailPelanggaran
    @nidn_dosen VARCHAR(20),
    @id_tata_tertib INT,
    @nim_mahasiswa VARCHAR(20),
    @id_sanksi INT,
    @tugas_khusus VARCHAR(255) = NULL,
    @detail_tugas_khusus VARCHAR(MAX) = NULL,
    @surat VARCHAR(255) = NULL,
    @status VARCHAR(50)
AS
BEGIN
    SET NOCOUNT ON;

    -- Validasi input
    IF @nidn_dosen IS NULL OR @nim_mahasiswa IS NULL
    BEGIN
        RAISERROR('NIDN atau NIM tidak boleh kosong', 16, 1);
        RETURN;
    END

    -- Cek keberadaan Dosen
    DECLARE @id_dosen INT;
    SELECT @id_dosen = id_dosen 
    FROM DOSEN 
    WHERE nidn = @nidn_dosen;

    IF @id_dosen IS NULL
    BEGIN
        RAISERROR('Dosen dengan NIDN tersebut tidak ditemukan', 16, 1);
        RETURN;
    END

    -- Cek keberadaan mahasiswa
    DECLARE @id_mahasiswa INT;
    SELECT @id_mahasiswa = id_mhs 
    FROM MAHASISWA 
    WHERE nim = @nim_mahasiswa;

    IF @id_mahasiswa IS NULL
    BEGIN
        RAISERROR('Mahasiswa dengan NIM tersebut tidak ditemukan', 16, 1);
        RETURN;
    END

    -- Validasi tata tertib
    IF NOT EXISTS (SELECT 1 FROM TATA_TERTIB WHERE id_tata_tertib = @id_tata_tertib)
    BEGIN
        RAISERROR('Tata tertib tidak valid', 16, 1);
        RETURN;
    END

    -- Validasi sanksi
    IF NOT EXISTS (SELECT 1 FROM SANKSI WHERE id_sanksi = @id_sanksi)
    BEGIN
        RAISERROR('Sanksi tidak valid', 16, 1);
        RETURN;
    END

    -- Validasi status
    IF @status NOT IN ('pending', 'proses', 'selesai')
    BEGIN
        RAISERROR('Status tidak valid', 16, 1);
        RETURN;
    END

    BEGIN TRY
        BEGIN TRANSACTION;

        -- Insert detail pelanggaran
        INSERT INTO DETAIL_PELANGGARAN (
            id_dosen, id_tata_tertib, id_mahasiswa, id_sanksi, 
            tugas_khusus, detail_tugas_khusus, surat, status
        ) VALUES (
            @id_dosen, @id_tata_tertib, @id_mahasiswa, @id_sanksi, 
            @tugas_khusus, @detail_tugas_khusus, @surat, @status
        );

        -- Ambil ID terakhir yang di-insert
        DECLARE @id_detail INT = SCOPE_IDENTITY();

        -- Panggil stored procedure notifikasi untuk Dosen
        EXEC sp_PelanggaranDosenNotif @id_dosen, @id_mahasiswa, @id_detail;

		-- Panggil stored procedure notifikasi untuk Dosen
        EXEC sp_PelanggaranMahasiswaNotif @id_dosen, @id_mahasiswa, @id_detail;

        COMMIT TRANSACTION;

        -- Kembalikan ID detail pelanggaran yang baru dibuat
        SELECT @id_detail AS id_detail;
    END TRY
    BEGIN CATCH
        IF @@TRANCOUNT > 0
            ROLLBACK TRANSACTION;

        DECLARE @ErrorMessage NVARCHAR(4000) = ERROR_MESSAGE();
        DECLARE @ErrorSeverity INT = ERROR_SEVERITY();
        DECLARE @ErrorState INT = ERROR_STATE();

        RAISERROR(@ErrorMessage, @ErrorSeverity, @ErrorState);
    END CATCH
END;

-- Pengecekan tugas oleh DPA
CREATE PROCEDURE sp_TugasSelesai
    @id_detail INT
AS
BEGIN
    BEGIN TRY
        BEGIN TRANSACTION;

        -- Update status tugas di tabel DETAIL_PELANGGARAN
        UPDATE DETAIL_PELANGGARAN
        SET status_tugas = 'Selesai'
        WHERE id_detail = @id_detail;

        -- Deklarasi variabel
        DECLARE @id_dosen INT, @id_dpa INT, @pesan NVARCHAR(MAX);

        -- Ambil id_dosen dari DETAIL_PELANGGARAN
        SELECT @id_dosen = id_dosen
        FROM DETAIL_PELANGGARAN
        WHERE id_detail = @id_detail;

        -- Ambil id_dpa dari tabel MAHASISWA
        SELECT @id_dpa = M.id_dpa
        FROM MAHASISWA M
        JOIN DETAIL_PELANGGARAN DP ON DP.id_mahasiswa = M.id_mhs
        WHERE DP.id_detail = @id_detail;

        -- Kirim notifikasi ke dosen pelapor
        SET @pesan = 'Tugas khusus telah selesai diperiksa oleh DPA.';
        INSERT INTO NOTIFIKASI (id_dosen, id_detail_pelanggaran, pesan, status, role_penerima)
        VALUES (@id_dosen, @id_detail, @pesan, 'unread', 'dosen');

        -- Kirim notifikasi ke DPA
        IF @id_dpa IS NOT NULL
        BEGIN
            INSERT INTO NOTIFIKASI (id_dosen, id_detail_pelanggaran, pesan, status, role_penerima)
            VALUES (@id_dpa, @id_detail, @pesan, 'unread', 'dosen');
        END

        COMMIT TRANSACTION;
    END TRY
    BEGIN CATCH
        IF @@TRANCOUNT > 0
            ROLLBACK TRANSACTION;
        THROW;
    END CATCH
END;

drop procedure sp_InsertDetailPelanggaran;
drop procedure sp_PelanggaranDosenNotif;
drop procedure sp_TugasKhususNotif;