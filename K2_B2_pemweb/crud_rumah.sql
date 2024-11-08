-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 03, 2024 at 06:49 AM
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
-- Database: `crud_rumah`
--

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int(11) NOT NULL,
  `id_rumah` int(11) DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `tanggal` date NOT NULL,
  `ponsel` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `perihal` varchar(255) NOT NULL,
  `pesan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `id_rumah`, `nama`, `tanggal`, `ponsel`, `email`, `perihal`, `pesan`) VALUES
(8, NULL, 'M Ibnu Ansari', '2024-11-02', '2309106082', 'ibnuansari042412@gmail.com', 'Info Rumah', 'ffgfgfg'),
(9, NULL, 'jennaira', '2024-11-02', '2309106082', 'ibnuansari042412@gmail.com', 'Info Rumah', 'fgfgf');

-- --------------------------------------------------------

--
-- Table structure for table `rumah`
--
-- Error reading structure for table crud_rumah.rumah: #1932 - Table 'crud_rumah.rumah' doesn't exist in engine
-- Error reading data for table crud_rumah.rumah: #1064 - You have an error in your SQL syntax; check the manual that corresponds to your MariaDB server version for the right syntax to use near 'FROM `crud_rumah`.`rumah`' at line 1

-- --------------------------------------------------------

--
-- Table structure for table `unit_rumah`
--

CREATE TABLE `unit_rumah` (
  `id_rumah` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `tipe` varchar(255) NOT NULL,
  `luas_tanah` varchar(255) NOT NULL,
  `luas_bangunan` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_rumah`
--

INSERT INTO `unit_rumah` (`id_rumah`, `gambar`, `tipe`, `luas_tanah`, `luas_bangunan`, `deskripsi`, `harga`) VALUES
(34, '899-Flamboyan.jpg', 'Flamboyan', '100', '70', '3 Kamar Tidur, 2 Kamar Mandi, Dapur, Ruang Tamu, Garasi.', 500000000),
(35, '882-melati.jpg', 'Melati', '120', '80', '5 Kamar Tidur, 4 Kamar Mandi, Dapur, Ruang Tamu, Garasi.', 650000000),
(36, '912-mawar.jpg', 'Mawar', '150', '120', '7 Kamar Tidur, 5 Kamar Mandi, Dapur, Ruang Tamu, Garasi.', 750000000),
(37, '203-anggrek.jpg', 'Anggrek', '200', '150', '10 Kamar Tidur, 10 Kamar Mandi, Dapur, Ruang Tamu, Garasi.', 800000000),
(39, '754-kamboja.jpeg', 'Kamboja', '300', '250', '10 Kamar Tidur, 10 Kamar Mandi, Dapur, Ruang Tamu, Garasi.', 1000000000),
(40, '584-sepatu.jpg', 'Sepatu', '250', '200', '10 Kamar Tidur, 10 Kamar Mandi, Dapur, Ruang Tamu, Garasi.', 1000000000);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(5, 'admin', '$2y$10$33qWGqaFdntEnogdWFavIe2DvRYDPie1gh410iORPVhs7i5duGr2S', 'Admin'),
(6, 'ibnu', '$2y$10$CG7fx1/BChQAjYOYX1qUxe.svukmG0oqhR3ipX9sVf0QG7NE9giOW', 'user'),
(7, 'udin', '$2y$10$ok.8wGBLLpaAlCpsU.uxA.xcTrLQv2VcaskYPkixNVDBlseLWcCBG', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit_rumah`
--
ALTER TABLE `unit_rumah`
  ADD PRIMARY KEY (`id_rumah`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `unit_rumah`
--
ALTER TABLE `unit_rumah`
  MODIFY `id_rumah` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
