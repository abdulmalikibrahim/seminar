-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2025 at 08:36 AM
-- Server version: 8.4.3
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `seminar`
--

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `universitas` char(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `otheruniversity` char(150) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nim` int DEFAULT NULL,
  `kelas` char(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `namalengkap` char(25) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nomorhp` char(14) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` char(100) COLLATE utf8mb4_general_ci NOT NULL,
  `status_kehadiran` enum('Hadir','Belum') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Belum',
  `status_cetak_sertifikat` enum('Sudah','Belum') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Belum',
  `seminar` char(50) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`universitas`, `otheruniversity`, `nim`, `kelas`, `namalengkap`, `nomorhp`, `email`, `status_kehadiran`, `status_cetak_sertifikat`, `seminar`) VALUES
('President University', 'Other', NULL, NULL, 'Abdul Malik Ibrahim', '083815608343', 'cuymalik9151@gmail.com', 'Belum', 'Sudah', 'Fisika'),
('Universitas Pelita Bangsa', '', 123231, 'TI.24.B1', 'Abdul Malik Ibrahim', '083815608343', 'cuymalik915@gmail.com', 'Hadir', 'Sudah', 'Fisika');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
