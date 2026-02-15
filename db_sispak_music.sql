-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2026 at 10:27 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sispak_music`
--

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `skor_teknik` decimal(3,2) DEFAULT NULL,
  `skor_ritme` decimal(3,2) DEFAULT NULL,
  `skor_ekspresi` decimal(3,2) DEFAULT NULL,
  `skor_teori` decimal(3,2) DEFAULT NULL,
  `skor_kreativitas` decimal(3,2) DEFAULT NULL,
  `skor_total` decimal(3,2) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hasil`
--

INSERT INTO `hasil` (`id_hasil`, `id_user`, `skor_teknik`, `skor_ritme`, `skor_ekspresi`, `skor_teori`, `skor_kreativitas`, `skor_total`, `level`, `tanggal`) VALUES
(1, 3, '3.40', '3.24', '3.20', '3.20', '3.00', '3.25', 'Menengah', '2026-02-16 02:57:17'),
(2, 4, '4.00', '4.00', '3.33', '4.00', '2.00', '3.70', 'Mahir', '2026-02-16 03:55:22');

-- --------------------------------------------------------

--
-- Table structure for table `jawaban`
--

CREATE TABLE `jawaban` (
  `id_jawaban` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_pertanyaan` int(11) NOT NULL,
  `nilai` int(11) NOT NULL CHECK (`nilai` between 1 and 5)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jawaban`
--

INSERT INTO `jawaban` (`id_jawaban`, `id_user`, `id_pertanyaan`, `nilai`) VALUES
(151, 4, 26, 3),
(152, 4, 27, 5),
(153, 4, 28, 4),
(154, 4, 29, 4),
(155, 4, 30, 4),
(156, 4, 31, 4),
(157, 4, 32, 4),
(158, 4, 33, 3),
(159, 4, 34, 3),
(160, 4, 35, 5),
(161, 4, 36, 2),
(162, 4, 37, 5),
(163, 4, 38, 3),
(164, 4, 39, 1),
(165, 4, 40, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `bobot` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `bobot`) VALUES
(1, 'Teknik Dasar', '30.00'),
(2, 'Ritme & Tempo', '25.00'),
(3, 'Musikalitas & Ekspresi', '15.00'),
(4, 'Teori Musik', '20.00'),
(5, 'Kreativitas', '10.00');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_skill`
--

CREATE TABLE `kategori_skill` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL,
  `min_skor` decimal(4,2) DEFAULT NULL,
  `max_skor` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `kategori_skill`
--

INSERT INTO `kategori_skill` (`id_level`, `nama_level`, `min_skor`, `max_skor`) VALUES
(1, 'Pemula', '0.00', '1.49'),
(2, 'Dasar', '1.50', '2.49'),
(3, 'Menengah', '2.50', '3.49'),
(4, 'Mahir', '3.50', '4.49'),
(5, 'Profesional', '4.50', '5.00');

-- --------------------------------------------------------

--
-- Table structure for table `pertanyaan`
--

CREATE TABLE `pertanyaan` (
  `id_pertanyaan` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `pertanyaan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pertanyaan`
--

INSERT INTO `pertanyaan` (`id_pertanyaan`, `id_kategori`, `pertanyaan`) VALUES
(26, 1, 'Saya dapat memainkan alat musik/menyanyi tanpa sering melakukan kesalahan nada.'),
(27, 1, 'Saya mampu memainkan tangga nada (scale) dengan lancar dan stabil.'),
(28, 1, 'Teknik jari/pernapasan/ketukan saya sudah terkontrol dengan baik saat bermain musik.'),
(29, 2, 'Saya dapat mengikuti tempo metronom dengan konsisten dari awal hingga akhir lagu.'),
(30, 2, 'Saya jarang bermain terlalu cepat atau terlalu lambat dari tempo yang ditentukan.'),
(31, 2, 'Saya mampu menjaga kestabilan ritme saat bermain bersama tim/musisi lain.'),
(32, 3, 'Saya mampu menampilkan dinamika (keras-lembut) dalam permainan musik saya.'),
(33, 3, 'Saya dapat menghayati dan mengekspresikan emosi lagu dengan baik.'),
(34, 3, 'Permainan musik saya terdengar hidup dan tidak datar.'),
(35, 4, 'Saya memahami dasar-dasar tangga nada dan progresi chord.'),
(36, 4, 'Saya mampu membaca not balok atau simbol chord dengan baik.'),
(37, 4, 'Saya dapat menganalisis struktur lagu dengan baik misalnya dapat membedakan (intro, verse, chorus, bridge).'),
(38, 5, 'Saya mampu melakukan improvisasi saat memainkan lagu.'),
(39, 5, 'Saya pernah menciptakan atau mengaransemen ulang sebuah lagu.'),
(40, 5, 'Saya dapat mengembangkan variasi permainan tanpa menghilangkan karakter lagu.');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id_rekomendasi` int(11) NOT NULL,
  `kategori_target` varchar(100) DEFAULT NULL,
  `batas_skor` decimal(4,2) DEFAULT NULL,
  `isi_rekomendasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rekomendasi`
--

INSERT INTO `rekomendasi` (`id_rekomendasi`, `kategori_target`, `batas_skor`, `isi_rekomendasi`) VALUES
(1, 'Teknik Dasar', '3.00', 'Latihan teknik skala mayor dan minor 15 menit per hari.'),
(2, 'Ritme & Tempo', '3.00', 'Latihan metronom 60–100 BPM rutin'),
(3, 'Teori Musik', '3.00', '1.Hafalkan circle of fifths\r\n2. Pahami triad (major, minor, diminished)\r\n3. Tulis ulang chord progression dikertas\r\n4. Latihan progresi dasar (II V I)\r\n5. Tebak chord'),
(4, 'Kreativitas', '3.00', 'Mulai improvisasi sederhana di tangga nada mayor');

-- --------------------------------------------------------

--
-- Table structure for table `rule_base`
--

CREATE TABLE `rule_base` (
  `id_rule` int(11) NOT NULL,
  `min_skor` decimal(3,1) NOT NULL,
  `max_skor` decimal(3,1) NOT NULL,
  `hasil` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Dumping data for table `rule_base`
--

INSERT INTO `rule_base` (`id_rule`, `min_skor`, `max_skor`, `hasil`, `created_at`) VALUES
(6, '1.0', '1.8', 'Pemula', '2026-02-15 19:19:16'),
(7, '1.9', '2.9', 'Dasar', '2026-02-15 19:20:16'),
(9, '3.0', '3.3', 'Menengah', '2026-02-15 19:21:44'),
(10, '3.4', '4.2', 'Mahir', '2026-02-15 19:23:10'),
(11, '4.3', '5.0', 'Profesional', '2026-02-15 19:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','musisi') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Admin', 'admin@mail.com', '$2y$10$grsSuBhyIwnlFEa5ciI6GeAXXDXl8LgXzYcMS7xNeXVsk/DSenX7u', 'admin', '2026-02-15 17:17:30'),
(2, 'Musisi 1', 'musisi@mail.com', '$2y$10$2z/yhZcy5MmKXzU73KCXwOrssQFab.ZGyDTYCR1c6ryvzTjXmldOS', 'musisi', '2026-02-15 17:27:48'),
(3, 'Daniel Hermanto', 'dan@mail.com', '$2y$10$Bc5M7ECD.d7euSMkS2pD8OJqkdCJ2OGOsWae3rOacvBZWyZW9A2je', 'musisi', '2026-02-15 17:58:20'),
(4, 'Lidya', 'lid@mail.com', '$2y$10$JU5GgZcS/4Y6NB/D5gXVGuNAmpSqf7E8F/mU/ClTQo1OqeXB/eaC2', 'musisi', '2026-02-15 20:44:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD PRIMARY KEY (`id_jawaban`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `id_pertanyaan` (`id_pertanyaan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kategori_skill`
--
ALTER TABLE `kategori_skill`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD PRIMARY KEY (`id_pertanyaan`),
  ADD KEY `id_kategori` (`id_kategori`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id_rekomendasi`);

--
-- Indexes for table `rule_base`
--
ALTER TABLE `rule_base`
  ADD PRIMARY KEY (`id_rule`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jawaban`
--
ALTER TABLE `jawaban`
  MODIFY `id_jawaban` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kategori_skill`
--
ALTER TABLE `kategori_skill`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  MODIFY `id_pertanyaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  MODIFY `id_rekomendasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `rule_base`
--
ALTER TABLE `rule_base`
  MODIFY `id_rule` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jawaban`
--
ALTER TABLE `jawaban`
  ADD CONSTRAINT `jawaban_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  ADD CONSTRAINT `jawaban_ibfk_2` FOREIGN KEY (`id_pertanyaan`) REFERENCES `pertanyaan` (`id_pertanyaan`) ON DELETE CASCADE;

--
-- Constraints for table `pertanyaan`
--
ALTER TABLE `pertanyaan`
  ADD CONSTRAINT `pertanyaan_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id_kategori`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
