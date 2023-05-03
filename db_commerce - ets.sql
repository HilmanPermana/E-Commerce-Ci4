-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 09:21 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `kemeja`
--

CREATE TABLE `kemeja` (
  `idkemeja` int(11) NOT NULL,
  `namabrg` varchar(100) NOT NULL,
  `harga` decimal(12,0) NOT NULL,
  `diskon` int(11) NOT NULL,
  `stok` int(10) NOT NULL,
  `namafile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kemeja`
--


-- --------------------------------------------------------

--
-- Table structure for table `jual`
--

CREATE TABLE `detailjual` (
  `idtrans` int(11) NOT NULL,
  `idkemeja` int(11) NOT NULL,
  `hargajual` decimal(12,0) NOT NULL,
  `jmljual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jual`
--


-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualan`
--

CREATE TABLE `transaksipjl` (
  `idtrans` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `hp` varchar(15) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `kecamatan` varchar(50) NOT NULL,
  `kota` varchar(50) NOT NULL,
  `total` decimal(12,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi_penjualan`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `kemeja`
--
ALTER TABLE `kemeja`
  ADD PRIMARY KEY (`idkemeja`);

--
-- Indexes for table `jual`
--
ALTER TABLE `detailjual`
  ADD KEY `idkemeja` (`idkemeja`),
  ADD KEY `idtrans` (`idtrans`);

--
-- Indexes for table `transaksi_penjualan`
--
ALTER TABLE `transaksipjl`
  ADD PRIMARY KEY (`idtrans`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kemeja`
--
ALTER TABLE `kemeja`
  MODIFY `idkemeja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `transaksi_penjualan`
--
ALTER TABLE `transaksipjl`
  MODIFY `idtrans` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jual`
--
ALTER TABLE `detailjual`
  ADD CONSTRAINT `jual_ibfk_1` FOREIGN KEY (`idkemeja`) REFERENCES `kemeja` (`idkemeja`),
  ADD CONSTRAINT `jual_ibfk_2` FOREIGN KEY (`idtrans`) REFERENCES `transaksi_penjualan` (`idtrans`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
