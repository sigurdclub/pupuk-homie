-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2022 at 04:58 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pupuk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_pupuk`
--

CREATE TABLE `admin_pupuk` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_pupuk`
--

INSERT INTO `admin_pupuk` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `pupuk_keluar`
--

CREATE TABLE `pupuk_keluar` (
  `id` int(11) NOT NULL,
  `id_pupuk` int(11) NOT NULL,
  `jenis_pupuk` varchar(25) NOT NULL,
  `jumlah` varchar(25) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pupuk_keluar`
--

INSERT INTO `pupuk_keluar` (`id`, `id_pupuk`, `jenis_pupuk`, `jumlah`, `satuan`, `tanggal`) VALUES
(1, 1, 'Organik', '10', 'Karung', '2022-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `pupuk_masuk`
--

CREATE TABLE `pupuk_masuk` (
  `id` int(11) NOT NULL,
  `id_pupuk` int(11) NOT NULL,
  `jenis_pupuk` varchar(25) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL,
  `tanggal` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pupuk_masuk`
--

INSERT INTO `pupuk_masuk` (`id`, `id_pupuk`, `jenis_pupuk`, `jumlah`, `satuan`, `tanggal`) VALUES
(6, 1, 'Organik', 10, 'Karung', '2022-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `stok_pupuk`
--

CREATE TABLE `stok_pupuk` (
  `id_pupuk` int(11) NOT NULL,
  `merek` varchar(25) NOT NULL,
  `jenis_pupuk` varchar(25) NOT NULL,
  `stok` int(11) NOT NULL,
  `satuan` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stok_pupuk`
--

INSERT INTO `stok_pupuk` (`id_pupuk`, `merek`, `jenis_pupuk`, `stok`, `satuan`) VALUES
(1, 'ZA', 'Organik', 10, 'Karung');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_pupuk`
--
ALTER TABLE `admin_pupuk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pupuk_keluar`
--
ALTER TABLE `pupuk_keluar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pupuk` (`id_pupuk`);

--
-- Indexes for table `pupuk_masuk`
--
ALTER TABLE `pupuk_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pupuk` (`id_pupuk`);

--
-- Indexes for table `stok_pupuk`
--
ALTER TABLE `stok_pupuk`
  ADD PRIMARY KEY (`id_pupuk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_pupuk`
--
ALTER TABLE `admin_pupuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pupuk_keluar`
--
ALTER TABLE `pupuk_keluar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pupuk_masuk`
--
ALTER TABLE `pupuk_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stok_pupuk`
--
ALTER TABLE `stok_pupuk`
  MODIFY `id_pupuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pupuk_keluar`
--
ALTER TABLE `pupuk_keluar`
  ADD CONSTRAINT `pupuk_keluar_ibfk_1` FOREIGN KEY (`id_pupuk`) REFERENCES `stok_pupuk` (`id_pupuk`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pupuk_masuk`
--
ALTER TABLE `pupuk_masuk`
  ADD CONSTRAINT `pupuk_masuk_ibfk_1` FOREIGN KEY (`id_pupuk`) REFERENCES `stok_pupuk` (`id_pupuk`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
