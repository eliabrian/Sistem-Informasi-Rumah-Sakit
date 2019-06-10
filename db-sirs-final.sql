-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 10, 2019 at 10:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db-sirs-final`
--

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `kd_pasien` varchar(100) NOT NULL,
  `nama_pasien` varchar(100) NOT NULL,
  `jk` enum('Laki-Laki','Perempuan') NOT NULL,
  `nik` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `agama` enum('Islam','Kristen','Katholik','Hindu','Budha','Lainnya') NOT NULL,
  `sts_perkawinan` enum('Kawin','Belum Kawin') NOT NULL,
  `kewarganegaraan` enum('WNI','WNA') NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `pembayaran` enum('BPJS','Asuransi','Personal') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `flag_active` enum('y','n') NOT NULL DEFAULT 'y',
  `kd_wali` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id_pasien`, `kd_pasien`, `nama_pasien`, `jk`, `nik`, `tempat_lahir`, `tgl_lahir`, `alamat`, `agama`, `sts_perkawinan`, `kewarganegaraan`, `no_telp`, `pembayaran`, `created_at`, `flag_active`, `kd_wali`) VALUES
(1, 'ABC123', 'Elia Brian Baskoro', 'Laki-Laki', '3121092403210003', 'Bekasi', '1998-11-23', 'Jl. Harapan 1 No.3', 'Kristen', 'Belum Kawin', 'WNI', '081213389991', 'BPJS', '2019-05-20 13:12:06', 'y', NULL),
(2, 'ZXC987', 'Nico Julian', 'Laki-Laki', '1871010907930009', 'Bandar Lampung', '1993-07-03', 'Jl. S. Agung Way Halim 014/000, Kedaton', 'Islam', 'Belum Kawin', 'WNI', '081231248129', 'Personal', '2019-05-21 18:23:02', 'y', NULL),
(3, 'DFG991', 'Aldian Arif Sabdika', 'Perempuan', '3275060306960015', 'Jakarta', '1998-03-06', 'Jl. Cendrawasih 15 No.210C 004/013 Pejuang, Medan Satria', 'Islam', 'Kawin', 'WNI', '081471824914', 'BPJS', '2019-05-22 05:29:10', 'y', 'RBU798'),
(4, 'JKL881', 'Amelia Fransiska', 'Perempuan', '3121092403210003', 'Jakarta', '1991-05-20', 'Jl. Senapan 5 No.6 Sumur Batu', 'Kristen', 'Belum Kawin', 'WNI', '081313249184', 'Asuransi', '2019-05-24 10:28:06', 'y', NULL),
(5, 'YUI928', 'Charles Edward', 'Laki-Laki', '3219092303560001', 'Amsterdam', '1958-03-23', 'Dusun Kalapa Tiga 002/009, Babakan, Pangandaran', 'Islam', 'Kawin', 'WNA', '081213329145', 'Asuransi', '2019-05-24 10:30:26', 'y', NULL),
(6, 'TQY782', 'Yuliana Kaseh', 'Perempuan', '3203012503770011', 'Kupang', '1979-08-10', 'Jl. Basoka 2 No.6', 'Katholik', 'Kawin', 'WNI', '081277819848', 'BPJS', '2019-05-24 13:56:10', 'y', ''),
(7, 'POP441', 'Dimas Mahendra', 'Laki-Laki', '3509202609500001', 'Makasar', '1988-09-01', 'Jl. Kecapi 5 No.6B 006/005, Jagakarsa', 'Hindu', 'Belum Kawin', 'WNI', '081529490914', 'Personal', '2019-05-30 16:10:24', 'y', 'FBY388'),
(8, 'DQA705', 'Arthur Maringka', 'Laki-Laki', '3175072010800011', 'Pontianak', '1976-02-23', 'Jl. Ayub 2 No.3C 002/001 Cawang, Jakarta Timur', 'Kristen', 'Kawin', 'WNI', '081214857162', 'Personal', '2019-05-30 19:40:03', 'y', 'FIS135');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'admin', 'mNfFqDDaxltWo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
