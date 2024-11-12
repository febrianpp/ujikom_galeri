-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 24, 2024 at 08:36 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ujikom_galeri`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id_album` int(11) NOT NULL,
  `nama_album` varchar(255) DEFAULT NULL,
  `deskripsi` text DEFAULT NULL,
  `tanggal_buat` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `id_foto` int(11) NOT NULL,
  `judul_foto` varchar(255) DEFAULT NULL,
  `deskripsi_foto` text DEFAULT NULL,
  `tanggal_unggah` date DEFAULT NULL,
  `lokasi_foto` varchar(255) DEFAULT NULL,
  `id_album` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `komentar_foto`
--

CREATE TABLE `komentar_foto` (
  `id_komentar` int(11) NOT NULL,
  `id_foto` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `isi_komentar` text DEFAULT NULL,
  `tanggal_komentar` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `like_foto`
--

CREATE TABLE `like_foto` (
  `id_like` int(11) NOT NULL,
  `id_foto` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `tanggal_like` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(255) DEFAULT NULL,
  `alamat` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `nama_lengkap`, `alamat`) VALUES
(5, 'aa', '$4124bc0a9335c27f086f24ba207a4912', '$aa@gmail.com', '', 'aa'),
(6, 'admin', '202cb962ac59075b964b07152d234b70', '$aa@gmail.com', '', 'edsa');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id_album`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `id_album` (`id_album`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_foto` (`id_foto`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD PRIMARY KEY (`id_like`),
  ADD KEY `id_foto` (`id_foto`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id_album` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `like_foto`
--
ALTER TABLE `like_foto`
  MODIFY `id_like` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `foto`
--
ALTER TABLE `foto`
  ADD CONSTRAINT `foto_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `foto_ibfk_2` FOREIGN KEY (`id_album`) REFERENCES `album` (`id_album`);

--
-- Constraints for table `komentar_foto`
--
ALTER TABLE `komentar_foto`
  ADD CONSTRAINT `komentar_foto_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `komentar_foto_ibfk_2` FOREIGN KEY (`id_foto`) REFERENCES `foto` (`id_foto`);

--
-- Constraints for table `like_foto`
--
ALTER TABLE `like_foto`
  ADD CONSTRAINT `like_foto_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `like_foto_ibfk_2` FOREIGN KEY (`id_foto`) REFERENCES `foto` (`id_foto`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
