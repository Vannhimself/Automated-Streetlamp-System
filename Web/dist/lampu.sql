-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18 Jul 2019 pada 05.11
-- Versi Server: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lampu`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `lampu_jalan`
--

CREATE TABLE `lampu_jalan` (
  `id` int(12) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `jalan` varchar(255) NOT NULL,
  `baterai` varchar(255) NOT NULL,
  `lat` varchar(255) NOT NULL,
  `long` varchar(255) NOT NULL,
  `ip_arduino` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `lampu_jalan`
--

INSERT INTO `lampu_jalan` (`id`, `nama`, `lokasi`, `status`, `jalan`, `baterai`, `lat`, `long`, `ip_arduino`) VALUES
(1, 'Satu Tidar', 'Dau, Tidar', 'Menyala', 'Villa Puncak Tidar Blok N No. 1, Karangwidoro, Dau, Doro, Karangwidoro, Kec. Dau, Malang, Jawa Timur 65151', '6.7', '-7.956761', '112.589505', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `petugas`
--

CREATE TABLE `petugas` (
  `id` int(12) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `petugas`
--

INSERT INTO `petugas` (`id`, `username`, `nama`, `password`) VALUES
(1, 'superadmin', 'Super Admin', 'superadmin'),
(2, 'admin', 'Admin Monitor', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lampu_jalan`
--
ALTER TABLE `lampu_jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
