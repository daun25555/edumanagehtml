-- ============================================================
-- EduManage - Database Schema
-- Import file ini ke phpMyAdmin
-- Database: edumanage
-- ============================================================

CREATE DATABASE IF NOT EXISTS `edumanage` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `edumanage`;

-- --------------------------------------------------------
-- Tabel: users (login admin, guru, siswa)
-- --------------------------------------------------------
CREATE TABLE `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('admin','guru','siswa') NOT NULL,
  `nama` VARCHAR(150) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Tabel: siswa
-- --------------------------------------------------------
CREATE TABLE `siswa` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nisn` VARCHAR(20) UNIQUE,
  `nis` VARCHAR(20),
  `nama` VARCHAR(150) NOT NULL,
  `nama_panggilan` VARCHAR(50),
  `jk` ENUM('Laki-laki','Perempuan'),
  `tempat_lahir` VARCHAR(100),
  `tgl_lahir` DATE,
  `agama` VARCHAR(30),
  `kelas` VARCHAR(30),
  `tahun_masuk` VARCHAR(10),
  `hp` VARCHAR(20),
  `email` VARCHAR(100),
  `alamat` TEXT,
  `nama_ayah` VARCHAR(150),
  `nama_ibu` VARCHAR(150),
  `pekerjaan_ortu` VARCHAR(100),
  `hp_ortu` VARCHAR(20),
  `status` ENUM('Aktif','Tidak Aktif','Alumni','Pindah Sekolah') DEFAULT 'Aktif',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Tabel: guru
-- --------------------------------------------------------
CREATE TABLE `guru` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `nip` VARCHAR(30) UNIQUE,
  `nuptk` VARCHAR(30),
  `nama` VARCHAR(150) NOT NULL,
  `jk` ENUM('Laki-laki','Perempuan'),
  `tempat_lahir` VARCHAR(100),
  `tgl_lahir` DATE,
  `agama` VARCHAR(30),
  `pendidikan` VARCHAR(20),
  `mapel` VARCHAR(200),
  `jabatan` VARCHAR(100),
  `status_kepegawaian` VARCHAR(30),
  `tmt` DATE,
  `hp` VARCHAR(20),
  `email` VARCHAR(100),
  `alamat` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Tabel: jadwal
-- --------------------------------------------------------
CREATE TABLE `jadwal` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `kelas` VARCHAR(30) NOT NULL,
  `hari` ENUM('Senin','Selasa','Rabu','Kamis','Jumat') NOT NULL,
  `jam_mulai` TIME NOT NULL,
  `jam_selesai` TIME NOT NULL,
  `mapel` VARCHAR(100) NOT NULL,
  `guru_id` INT,
  `nama_guru` VARCHAR(150),
  `ruang` VARCHAR(50),
  `semester` VARCHAR(30),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`guru_id`) REFERENCES `guru`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Tabel: nilai
-- --------------------------------------------------------
CREATE TABLE `nilai` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `siswa_id` INT,
  `nisn` VARCHAR(20),
  `nama_siswa` VARCHAR(150),
  `kelas` VARCHAR(30),
  `mapel` VARCHAR(100),
  `jenis` VARCHAR(50),
  `semester` VARCHAR(30),
  `nilai` DECIMAL(5,2),
  `tgl_penilaian` DATE,
  `catatan` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`siswa_id`) REFERENCES `siswa`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Tabel: absensi
-- --------------------------------------------------------
CREATE TABLE `absensi` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `siswa_id` INT,
  `nisn` VARCHAR(20),
  `nama_siswa` VARCHAR(150),
  `kelas` VARCHAR(30),
  `tanggal` DATE NOT NULL,
  `status` ENUM('Hadir','Sakit','Izin','Alfa') NOT NULL,
  `jam` VARCHAR(30),
  `keterangan` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`siswa_id`) REFERENCES `siswa`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Tabel: kalender (agenda sekolah)
-- --------------------------------------------------------
CREATE TABLE `kalender` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `tanggal` DATE NOT NULL,
  `kegiatan` VARCHAR(200) NOT NULL,
  `keterangan` VARCHAR(100),
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- --------------------------------------------------------
-- Data awal: users (password: admin123 / guru123 / siswa123)
-- Hash dibuat dengan password_hash() PHP bcrypt
-- --------------------------------------------------------
INSERT INTO `users` (`username`, `password`, `role`, `nama`) VALUES
('admin',  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin',  'Administrator'),
('guru01', '$2y$10$TKh8H1.PFgs6h7p.4FPBmO5U/yRhFnXKRqy.kMU2I79vLrqKFMU.', 'guru',   'Guru Demo'),
('siswa01','$2y$10$TKh8H1.PFgs6h7p.4FPBmO5U/yRhFnXKRqy.kMU2I79vLrqKFMU.', 'siswa',  'Siswa Demo');

-- Data kalender awal
INSERT INTO `kalender` (`tanggal`, `kegiatan`, `keterangan`) VALUES
('2025-04-19', 'Isra Mi''raj Nabi Muhammad SAW', 'Libur Nasional'),
('2025-05-01', 'Hari Buruh Internasional', 'Libur Nasional'),
('2025-05-29', 'Kenaikan Yesus Kristus', 'Libur Nasional'),
('2025-06-01', 'Hari Lahir Pancasila', 'Libur Nasional');

-- ============================================================
-- CATATAN PASSWORD:
-- admin   -> password: admin123
-- guru01  -> password: password  (ganti sesuai kebutuhan)
-- siswa01 -> password: password  (ganti sesuai kebutuhan)
-- 
-- Gunakan script PHP untuk generate hash baru:
-- echo password_hash('passwordbaru', PASSWORD_DEFAULT);
-- ============================================================
