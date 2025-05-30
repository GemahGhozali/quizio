-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 31, 2025 at 01:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pendidikan`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori_masalah`
--

CREATE TABLE `kategori_masalah` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori_masalah`
--

INSERT INTO `kategori_masalah` (`id`, `nama_kategori`) VALUES
(1, 'Bullying'),
(2, 'Fasilitas Rusak'),
(3, 'Guru Tidak Hadir'),
(4, 'Korupsi Dana'),
(5, 'Kurikulum Tidak Sesuai'),
(6, 'lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `pengaduan`
--

CREATE TABLE `pengaduan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kategori_id` int(11) DEFAULT NULL,
  `judul` varchar(200) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `status` enum('baru','diproses','selesai') DEFAULT 'baru',
  `tanggal_lapor` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengaduan`
--

INSERT INTO `pengaduan` (`id`, `user_id`, `kategori_id`, `judul`, `deskripsi`, `foto`, `status`, `tanggal_lapor`) VALUES
(17, 6, 2, 'Kerusakan Papan Tulis di Ruang Kelas 10B', 'Papan tulis di ruang kelas 10B retak dan sulit digunakan. Diduga ada siswa yang sengaja merusaknya saat pelajaran berlangsung. Mohon diperbaiki dan diberi pengawasan agar kejadian serupa tidak terulang.', 'foto_1748646367_kerusakan-papan-tulis.jfif', 'baru', '2025-05-30 23:06:07'),
(18, 6, 3, 'Guru Tidak Hadir Tanpa Keterangan', 'Guru Matematika kelas 11 sering tidak hadir tanpa pemberitahuan sebelumnya. Siswa jadi kehilangan pelajaran penting. Mohon agar kehadiran guru diperhatikan agar proses belajar berjalan lancar.', 'foto_1748646432_guru-tidak-hadir.jfif', 'baru', '2025-05-30 23:07:12'),
(19, 7, 4, 'Ada Praktik Korupsi Dana OSIS', 'Dana kegiatan OSIS tidak transparan penggunaannya. Beberapa pengeluaran tidak jelas dan tidak sesuai dengan laporan keuangan. Mohon pihak sekolah menginvestigasi agar dana siswa digunakan dengan baik.', NULL, 'baru', '2025-05-30 23:08:43'),
(20, 7, 5, 'Materi Pelajaran Tidak Sesuai Kurikulum', 'Materi yang diajarkan di kelas 11 IPA sering tidak sesuai dengan kurikulum yang berlaku. Hal ini membuat siswa kesulitan mempersiapkan ujian nasional. Mohon guru menyesuaikan materi sesuai standar kurikulum.', NULL, 'baru', '2025-05-30 23:09:16'),
(21, 8, 1, 'Siswa Sering Diejek Karena Penampilan', 'Beberapa siswa di kelas 12 IPS mengejek teman yang memiliki penampilan berbeda. Ini membuat korban merasa sedih dan stres. Tolong pihak sekolah memberikan perhatian dan tindakan tegas terhadap bullying ini.', 'foto_1748646633_bullying-1.jfif', 'baru', '2025-05-30 23:10:33'),
(22, 8, 1, 'Siswa Dilecehkan di Lingkungan Sekolah', 'Ada kasus pelecehan verbal di lingkungan sekolah yang membuat beberapa siswa merasa tidak aman. Mohon pihak sekolah segera menindaklanjuti agar kejadian serupa tidak terjadi lagi.', 'foto_1748646689_bullying-2.jfif', 'baru', '2025-05-30 23:11:29'),
(23, 9, 4, 'Penggunaan Dana Pramuka Tidak Jelas', 'Dana yang dikumpulkan untuk kegiatan pramuka tidak pernah dilaporkan secara transparan. Banyak siswa merasa curiga karena tidak ada laporan resmi. Mohon agar pengelolaan dana lebih terbuka dan akuntabel.', NULL, 'baru', '2025-05-30 23:13:30'),
(24, 9, 5, 'Guru Bahasa Inggris Tidak Mengikuti Kurikulum Baru', 'Guru Bahasa Inggris masih menggunakan buku dan metode lama, sehingga siswa kurang siap menghadapi ujian berbasis kurikulum baru. Mohon guru segera menyesuaikan metode pengajaran.', NULL, 'baru', '2025-05-30 23:14:13'),
(25, 10, 6, 'Laptop Sekolah Rusak Akibat Kelalaian', 'Beberapa laptop di ruang komputer rusak karena tidak dijaga dengan baik oleh siswa. Mohon agar ada aturan yang lebih ketat dalam penggunaan fasilitas sekolah.', 'foto_1748646934_laptop-rusak.jfif', 'baru', '2025-05-30 23:15:34'),
(26, 10, 6, 'Siswa Tidak Hadir Karena Kurangnya Pengawasan', 'Banyak siswa yang sering bolos tanpa alasan jelas. Kurangnya pengawasan dari pihak sekolah membuat masalah ini semakin parah. Mohon sekolah memperketat pengawasan kehadiran siswa.', 'foto_1748646988_bolos.jfif', 'baru', '2025-05-30 23:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id` int(11) NOT NULL,
  `pengaduan_id` int(11) DEFAULT NULL,
  `isi` text DEFAULT NULL,
  `tanggal_tanggapan` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('sekolah','dinas') NOT NULL,
  `is_anonim` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `is_anonim`, `created_at`) VALUES
(6, 'SMK Negeri 1 Samarinda', 'smknegeri1samarinda@gmail.com', '$2y$10$WI29pkUkLROeiLlY.KSh/O2WdYIicnJVFG1QvcRLMGBWTfgT32Ib6', 'sekolah', 0, '2025-05-30 23:00:00'),
(7, 'SMA Negeri 2 Samarinda', 'smanegeri2samarinda@gmail.com', '$2y$10$umKHJYP12fLpEFT/rUigYOKmlqiZE0zLPc2vmnAL1XoDNG2eK2M0e', 'sekolah', 0, '2025-05-30 23:00:43'),
(8, 'SMA Negeri 5 Samarinda', 'smanegeri5samarinda@gmail.com', '$2y$10$a3PPmu7d3a3N1.ScHECFfOcrZcoZqofKEYpnen2ea8qclTYy5.cZS', 'sekolah', 0, '2025-05-30 23:01:15'),
(9, 'MTS Negeri Samarinda', 'mtsnegerisamarinda@gmail.com', '$2y$10$9MNnnANVhF3nNsfB2ibWa.tBP.dZpi8ZwhelLNY.lz3C1nrmiA7f2', 'sekolah', 0, '2025-05-30 23:01:40'),
(10, 'SMK Negeri 7 Samarinda', 'smknegeri7samarinda@gmail.com', '$2y$10$xu98fda1unUmy3NDCvD1NOvvVxXCwE8BzaOUD8Hntp44uAd7j4lNy', 'sekolah', 0, '2025-05-30 23:02:42'),
(11, 'Dinas Pendidikan Samarinda', 'Smd@dinas', '$2y$10$F5iNe.cPDM1x5lCa.vugvOteKazLhjl6E7zPILTf0mW6/nwt9wZ4m', 'dinas', 0, '2025-05-30 23:18:29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori_masalah`
--
ALTER TABLE `kategori_masalah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengaduan_id` (`pengaduan_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori_masalah`
--
ALTER TABLE `kategori_masalah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pengaduan`
--
ALTER TABLE `pengaduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tanggapan`
--
ALTER TABLE `tanggapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengaduan`
--
ALTER TABLE `pengaduan`
  ADD CONSTRAINT `pengaduan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `pengaduan_ibfk_3` FOREIGN KEY (`kategori_id`) REFERENCES `kategori_masalah` (`id`);

--
-- Constraints for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD CONSTRAINT `tanggapan_ibfk_1` FOREIGN KEY (`pengaduan_id`) REFERENCES `pengaduan` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
