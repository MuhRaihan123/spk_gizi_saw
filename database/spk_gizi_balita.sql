-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2025 at 12:34 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spk_gizi_balita`
--

-- --------------------------------------------------------

--
-- Table structure for table `log_activity`
--

CREATE TABLE `log_activity` (
  `id` int(11) NOT NULL,
  `user` varchar(100) DEFAULT NULL,
  `aktivitas` text DEFAULT NULL,
  `tanggal` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log_activity`
--

INSERT INTO `log_activity` (`id`, `user`, `aktivitas`, `tanggal`) VALUES
(1, 'Bagian Gizi', 'Login ke sistem', '2025-07-03 15:26:46'),
(2, 'Bagian Gizi', 'Menambahkan data balita: Zidan (A31)', '2025-07-03 15:27:21'),
(3, 'admin', 'Login ke sistem', '2025-07-03 15:27:35'),
(4, 'Bagian Gizi', 'Login ke sistem', '2025-07-03 15:27:58'),
(5, 'Bagian Gizi', 'Menghapus data balita: Zidan (A31)', '2025-07-03 15:28:34'),
(6, 'admin', 'Login ke sistem', '2025-07-03 15:29:07'),
(7, 'Bagian Gizi', 'Login ke sistem', '2025-07-03 15:29:22'),
(8, 'admin', 'Login ke sistem', '2025-07-03 15:30:47'),
(9, 'Bagian Gizi', 'Login ke sistem', '2025-07-03 15:32:12'),
(10, 'Bagian Gizi', 'Menambahkan data balita: Zidan (A31)', '2025-07-03 17:30:46'),
(11, 'Bagian Gizi', 'Menghapus data balita dengan kode A31', '2025-07-03 17:32:08');

-- --------------------------------------------------------

--
-- Table structure for table `tb_alternatif`
--

CREATE TABLE `tb_alternatif` (
  `id_alternatif` int(11) NOT NULL,
  `kode_alternatif` varchar(10) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `usia_tahun` varchar(15) DEFAULT NULL,
  `tinggi` int(100) DEFAULT NULL,
  `berat` int(100) DEFAULT NULL,
  `tinggi_lahir` varchar(50) DEFAULT NULL,
  `berat_lahir` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_alternatif`
--

INSERT INTO `tb_alternatif` (`id_alternatif`, `kode_alternatif`, `nama`, `jenis_kelamin`, `usia_tahun`, `tinggi`, `berat`, `tinggi_lahir`, `berat_lahir`) VALUES
(1, 'A01', 'Ameera Khairunnisa', 'Perempuan', '1 Tahun', 80, 9, '51', '3.5'),
(2, 'A02', 'Alfalah', 'Laki-laki', '1 Tahun', 80, 10, '49.5', '3.1'),
(3, 'A03', 'Zafran Dilan Arroyan', 'Laki-laki', '1 Tahun', 84, 12, '49', '3'),
(4, 'A04', 'Alvadan Ghailan', 'Laki-laki', '1 Tahun', 78, 9, '46', '2.1'),
(5, 'A05', 'Shafana Queesa', 'Perempuan', '1 Tahun', 71, 10, '50', '3.2'),
(6, 'A06', 'Meisya Amanda', 'Perempuan', '8 Bulan', 74, 8, '48', '2.6'),
(7, 'A07', 'Syaikila Mazaya', 'Perempuan', '7 Bulan', 65, 8, '48', '3.2'),
(8, 'A08', 'Farhan Raihan Nabil', 'Laki-laki', '5 Bulan', 66, 7, '49', '2.9'),
(9, 'A09', 'Azzam', 'Laki-laki', '2 Bulan', 62, 6, '48.2', '2.8'),
(10, 'A10', 'Zira ramadan', 'Perempuan', '1 Tahun', 85, 11, '49', '3.2'),
(11, 'A11', 'nazira ramadani', 'Perempuan', '1 Tahun', 83, 11, '50', '3.1'),
(12, 'A12', 'muhammad alfatih', 'Laki-laki', '1 Tahun', 82, 9, '49', '2.7'),
(13, 'A13', 'riskiana liva', 'Perempuan', '1 Tahun', 72, 8, '47', '2.27'),
(14, 'A14', 'm. razka rafasha', 'Laki-laki', '10 Bulan', 73, 9, '50', '3.5'),
(15, 'A15', 'hafsa firsty zyan', 'Perempuan', '7 Bulan', 65, 6, '45', '2.3'),
(16, 'A16', 'shavana zea almahira', 'Perempuan', '6 Bulan', 64, 6, '49', '3.1'),
(17, 'A17', 'diffia', 'Perempuan', '5 Bulan', 65, 6, '48', '3'),
(18, 'A18', 'naura altha funnisa', 'Perempuan', '5 Bulan', 64, 8, '59', '2.8'),
(19, 'A19', 'cyra athaya elsanium', 'Perempuan', '1 Bulan', 53, 4, '45', '2.01'),
(20, 'A20', 'jennaira medina putri', 'Perempuan', '1 Tahun', 50, 5, '49', '3.7'),
(21, 'A21', 'm. anugrah giandra', 'Laki-laki', '1 Tahun', 81, 11, '50', '3.2'),
(22, 'A22', 'mihammad attaqi rafandra', 'Laki-laki', '1 Tahun', 85, 11, '50', '2.7'),
(23, 'A23', 'kanaya cintami jidbran', 'Perempuan', '1 Tahun', 77, 9, '47', '2.7'),
(24, 'A24', 'Gina Saqi Innayah', 'Laki-laki', '1 Tahun', 78, 11, '48', '3.1'),
(25, 'A25', 'm. bayzan', 'Perempuan', '1 Tahun', 79, 11, '49', '3.3'),
(26, 'A26', 'aufa oktavia sari', 'Perempuan', '1 Tahun', 72, 8, '47', '2.9'),
(27, 'A27', 'alfarezel kinandra sergio', 'Laki-laki', '1 Tahun', 80, 10, '48', '2.8'),
(28, 'A28', 'aurel anita amanda', 'Perempuan', '1 Tahun', 70, 7, '47', '2.5'),
(29, 'A29', 'abizar putra yelaf', 'Laki-laki', '10 Bulan', 77, 10, '49', '3.1'),
(30, 'A30', 'aleshya azzahra', 'Perempuan', '10 Bulan', 68, 8, '49', '3');

-- --------------------------------------------------------

--
-- Table structure for table `tb_hasil`
--

CREATE TABLE `tb_hasil` (
  `id_hasil` int(11) NOT NULL,
  `kode_alternatif` varchar(100) DEFAULT NULL,
  `nilai_akhir` decimal(5,4) DEFAULT NULL,
  `ranking` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_hasil`
--

INSERT INTO `tb_hasil` (`id_hasil`, `kode_alternatif`, `nilai_akhir`, `ranking`) VALUES
(1, 'A03', 0.9200, 1),
(2, 'A10', 0.9200, 2),
(3, 'A11', 0.9200, 3),
(4, 'A21', 0.9200, 4),
(5, 'A22', 0.9200, 5),
(6, 'A24', 0.9200, 6),
(7, 'A25', 0.9200, 7),
(8, 'A01', 0.7867, 8),
(9, 'A02', 0.7867, 9),
(10, 'A05', 0.7867, 10),
(11, 'A12', 0.7867, 11),
(12, 'A27', 0.7867, 12),
(13, 'A29', 0.7867, 13),
(14, 'A18', 0.7333, 14),
(15, 'A04', 0.7067, 15),
(16, 'A06', 0.6533, 16),
(17, 'A07', 0.6533, 17),
(18, 'A08', 0.6533, 18),
(19, 'A09', 0.6533, 19),
(20, 'A14', 0.6533, 20),
(21, 'A16', 0.6533, 21),
(22, 'A17', 0.6533, 22),
(23, 'A20', 0.6533, 23),
(24, 'A23', 0.6533, 24),
(25, 'A26', 0.6533, 25),
(26, 'A30', 0.6533, 26),
(27, 'A13', 0.5733, 27),
(28, 'A15', 0.5733, 28),
(29, 'A19', 0.5733, 29),
(30, 'A28', 0.5733, 30);

-- --------------------------------------------------------

--
-- Table structure for table `tb_hitung`
--

CREATE TABLE `tb_hitung` (
  `id_data` int(11) NOT NULL,
  `kode_alternatif` varchar(11) DEFAULT NULL,
  `usia_tahun` varchar(15) DEFAULT NULL,
  `tinggi` decimal(5,2) DEFAULT NULL,
  `berat` decimal(5,2) DEFAULT NULL,
  `tinggi_lahir` decimal(5,2) DEFAULT NULL,
  `berat_lahir` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_hitung`
--

INSERT INTO `tb_hitung` (`id_data`, `kode_alternatif`, `usia_tahun`, `tinggi`, `berat`, `tinggi_lahir`, `berat_lahir`) VALUES
(1, 'A01', '5', 3.00, 1.00, 3.00, 5.00),
(2, 'A02', '5', 3.00, 1.00, 3.00, 5.00),
(3, 'A03', '5', 3.00, 3.00, 3.00, 5.00),
(4, 'A04', '5', 3.00, 1.00, 3.00, 3.00),
(5, 'A05', '5', 1.00, 3.00, 3.00, 5.00),
(6, 'A06', '5', 1.00, 1.00, 3.00, 5.00),
(7, 'A07', '5', 1.00, 1.00, 3.00, 5.00),
(8, 'A08', '5', 1.00, 1.00, 3.00, 5.00),
(9, 'A09', '5', 1.00, 1.00, 3.00, 5.00),
(10, 'A10', '5', 3.00, 3.00, 3.00, 5.00),
(11, 'A11', '5', 3.00, 3.00, 3.00, 5.00),
(12, 'A12', '5', 3.00, 1.00, 3.00, 5.00),
(13, 'A13', '5', 1.00, 1.00, 3.00, 3.00),
(14, 'A14', '5', 1.00, 1.00, 3.00, 5.00),
(15, 'A15', '5', 1.00, 1.00, 3.00, 3.00),
(16, 'A16', '5', 1.00, 1.00, 3.00, 5.00),
(17, 'A17', '5', 1.00, 1.00, 3.00, 5.00),
(18, 'A18', '5', 1.00, 1.00, 5.00, 5.00),
(19, 'A19', '5', 1.00, 1.00, 3.00, 3.00),
(20, 'A20', '5', 1.00, 1.00, 3.00, 5.00),
(21, 'A21', '5', 3.00, 3.00, 3.00, 5.00),
(22, 'A22', '5', 3.00, 3.00, 3.00, 5.00),
(23, 'A23', '5', 1.00, 1.00, 3.00, 5.00),
(24, 'A24', '5', 3.00, 3.00, 3.00, 5.00),
(25, 'A25', '5', 3.00, 3.00, 3.00, 5.00),
(26, 'A26', '5', 1.00, 1.00, 3.00, 5.00),
(27, 'A27', '5', 3.00, 1.00, 3.00, 5.00),
(28, 'A28', '5', 1.00, 1.00, 3.00, 3.00),
(29, 'A29', '5', 3.00, 1.00, 3.00, 5.00),
(30, 'A30', '5', 1.00, 1.00, 3.00, 5.00);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kriteria`
--

CREATE TABLE `tb_kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `kode_kriteria` varchar(5) DEFAULT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `bobot` decimal(5,4) DEFAULT NULL,
  `sifat` enum('benefit','cost') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_kriteria`
--

INSERT INTO `tb_kriteria` (`id_kriteria`, `kode_kriteria`, `nama_kriteria`, `bobot`, `sifat`) VALUES
(1, 'C1', 'usia_tahun', 0.2000, 'cost'),
(2, 'C2', 'tinggi', 0.2000, 'benefit'),
(3, 'C3', 'berat', 0.2000, 'benefit'),
(4, 'C4', 'tinggi_lahir', 0.2000, 'benefit'),
(5, 'C5', 'berat_lahir', 0.2000, 'benefit');

-- --------------------------------------------------------

--
-- Table structure for table `tb_sub_kriteria`
--

CREATE TABLE `tb_sub_kriteria` (
  `id_sub` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `deskripsi` varchar(100) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_sub_kriteria`
--

INSERT INTO `tb_sub_kriteria` (`id_sub`, `id_kriteria`, `deskripsi`, `nilai`) VALUES
(1, 1, '0 - 1', 5),
(2, 1, '1 - 3', 3),
(3, 1, '3 - 5', 1),
(4, 2, '1 - 1.5', 1),
(5, 2, '1.6 - 2.5', 3),
(6, 2, '2.6 - 4', 5),
(7, 2, '> 4', 7),
(8, 3, '< 45', 1),
(9, 3, '45 - 52', 3),
(10, 3, '> 53', 5),
(11, 4, '9 - 10 (Laki-laki)', 1),
(12, 4, '11 - 14 (Laki-laki)', 3),
(13, 4, '15 - 18 (Laki-laki)', 5),
(14, 4, '8 - 9.5 (Perempuan)', 1),
(15, 4, '9.6 - 13.5 (Perempuan)', 3),
(16, 4, '13.6 - 17 (Perempuan)', 5),
(17, 5, '48 - 76 (Laki-laki)', 1),
(18, 5, '77 - 96 (Laki-laki)', 3),
(19, 5, '97 - 110 (Laki-laki)', 5),
(20, 5, '47 - 78 (Perempuan)', 1),
(21, 5, '79 - 95 (Perempuan)', 3),
(22, 5, '96 - 108 (Perempuan)', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `role`) VALUES
(3, 'admin', '0192023a7bbd73250516f069df18b500', 'admin'),
(4, 'Kepala Puskesmas', '6ad14ba9986e3615423dfca256d04e3f', 'user'),
(5, 'Bagian Gizi', '00c08ae98427567f86e1ec0660d629ad', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `log_activity`
--
ALTER TABLE `log_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_alternatif`
--
ALTER TABLE `tb_alternatif`
  ADD PRIMARY KEY (`kode_alternatif`);

--
-- Indexes for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  ADD PRIMARY KEY (`id_hasil`);

--
-- Indexes for table `tb_hitung`
--
ALTER TABLE `tb_hitung`
  ADD PRIMARY KEY (`id_data`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log_activity`
--
ALTER TABLE `log_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tb_hasil`
--
ALTER TABLE `tb_hasil`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tb_hitung`
--
ALTER TABLE `tb_hitung`
  MODIFY `id_data` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
