-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2018 at 06:16 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjamanruangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `c_admin` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`c_admin`, `nama`, `username`, `password`) VALUES
('rino', 'Rino Oktavianto', 'admin', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi`
--

CREATE TABLE `konfirmasi` (
  `c_konfirmasi` int(11) NOT NULL,
  `c_users` varchar(10) NOT NULL,
  `email` varchar(100) NOT NULL,
  `kode` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifadmin`
--

CREATE TABLE `notifadmin` (
  `c_notifadmin` int(11) NOT NULL,
  `c_users` varchar(10) DEFAULT NULL,
  `c_pengajuan` varchar(100) DEFAULT NULL,
  `notif` varchar(20) DEFAULT NULL,
  `at` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifadmin`
--

INSERT INTO `notifadmin` (`c_notifadmin`, `c_users`, `c_pengajuan`, `notif`, `at`, `status`) VALUES
(1, 'g6dEJhmnL', NULL, 'register', '2018-04-25 05:55:38', 'off'),
(2, '17160449', '5lhule355', 'pengajuan', '2018-04-26 10:03:36', 'off'),
(3, 'g6dEJhmnL', 'K70mKzcQ3', 'pengajuan', '2018-04-26 17:27:28', 'off'),
(5, 'g6dEJhmnL', '8APZP2eCo', 'pengajuan', '2018-04-26 18:29:52', 'off'),
(6, 'g6dEJhmnL', 'K70mKzcQ3', 'edit', '2018-04-26 19:13:51', 'off'),
(7, 'g6dEJhmnL', 'K70mKzcQ3', 'edit', '2018-04-26 19:20:50', 'off'),
(8, 'g6dEJhmnL', 'K70mKzcQ3', 'edit', '2018-04-26 19:23:42', 'off'),
(9, 'g6dEJhmnL', 'K70mKzcQ3', 'edit', '2018-04-26 19:24:43', 'off'),
(10, 'g6dEJhmnL', '8APZP2eCo', 'batal', '2018-04-26 20:32:24', 'off'),
(11, 'g6dEJhmnL', 'M6HuIN3Y2', 'pengajuan', '2018-04-26 20:39:54', 'off'),
(12, 'g6dEJhmnL', '14uzYBh08', 'pengajuan', '2018-04-27 06:10:12', 'on'),
(13, 'g6dEJhmnL', '708NGaZ3G', 'pengajuan', '2018-04-27 07:50:21', 'on'),
(14, 'g6dEJhmnL', '708NGaZ3G', 'edit', '2018-04-27 07:51:14', 'on'),
(15, 'g6dEJhmnL', 'fzI8mbu3y', 'pengajuan', '2018-04-27 07:52:25', 'on'),
(16, '17160449', '7SG6phJ47', 'pengajuan', '2018-04-27 07:57:01', 'on'),
(17, '17160449', 'Mv57o51PZ', 'pengajuan', '2018-04-28 05:30:54', 'on'),
(18, '17160449', 'Mv57o51PZ', 'edit', '2018-04-28 05:42:09', 'on'),
(19, '17160449', 'Mv57o51PZ', 'edit', '2018-04-28 05:49:21', 'off'),
(20, '17160449', 'Mv57o51PZ', 'edit', '2018-04-28 05:49:58', 'on'),
(21, 'g6dEJhmnL', '6V63hZ2bd', 'pengajuan', '2018-04-28 15:46:37', 'on'),
(22, 'g6dEJhmnL', 'Lh3gt68NN', 'pengajuan', '2018-04-28 15:48:07', 'on'),
(23, 'g6dEJhmnL', 'T11y2eatM', 'pengajuan', '2018-04-28 15:48:33', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `notifuser`
--

CREATE TABLE `notifuser` (
  `c_notifuser` int(11) NOT NULL,
  `c_users` varchar(10) DEFAULT NULL,
  `c_pengajuan` varchar(10) DEFAULT NULL,
  `notif` varchar(20) DEFAULT NULL,
  `catatan` text,
  `at` datetime DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifuser`
--

INSERT INTO `notifuser` (`c_notifuser`, `c_users`, `c_pengajuan`, `notif`, `catatan`, `at`, `status`) VALUES
(2, 'g6dEJhmnL', '14uzYBh08', 'pending', '', '2018-04-27 06:29:43', 'on'),
(3, 'g6dEJhmnL', '14uzYBh08', 'reject', '', '2018-04-27 07:11:26', 'on'),
(4, 'g6dEJhmnL', '8APZP2eCo', 'delete', '', '2018-04-27 07:13:31', 'on'),
(5, 'g6dEJhmnL', '14uzYBh08', 'approve', '', '2018-04-27 07:13:49', 'on'),
(6, '17160449', '7SG6phJ47', 'pending', '', '2018-04-27 10:20:45', 'on'),
(7, '17160449', '7SG6phJ47', 'reject', '', '2018-04-27 10:22:56', 'on'),
(8, '17160449', '7SG6phJ47', 'approve', '', '2018-04-27 10:26:19', 'on'),
(9, '17160449', '7SG6phJ47', 'reject', '', '2018-04-27 10:29:49', 'on'),
(10, '17160449', '7SG6phJ47', 'pending', '', '2018-04-27 10:32:06', 'on'),
(11, '17160449', '7SG6phJ47', 'pending', '<p>cvcxdgdsg</p>\r\n', '2018-04-27 10:32:06', 'on'),
(12, '17160449', '7SG6phJ47', 'approve', '', '2018-04-27 10:33:15', 'on'),
(13, '17160449', '7SG6phJ47', 'reject', '', '2018-04-27 10:33:50', 'on'),
(14, '17160449', '7SG6phJ47', 'approve', '', '2018-04-27 10:34:22', 'on'),
(15, '17160449', '7SG6phJ47', 'pending', '', '2018-04-27 10:35:28', 'on'),
(16, '17160449', '7SG6phJ47', 'approve', '<p>vfgfg</p>\r\n', '2018-04-27 10:35:29', 'on'),
(17, '', '', 'pending', '', '2018-04-27 10:49:00', 'on'),
(18, '17160449', '7SG6phJ47', 'pending', 'jchjcv', '2018-04-27 10:51:14', 'off'),
(19, '17160449', '7SG6phJ47', 'approve', '', '2018-04-27 10:51:54', 'off'),
(20, '17160449', '7SG6phJ47', 'reject', 'Kami melihat ada kesalahan di data anda', '2018-04-27 10:52:49', 'on'),
(21, '17160449', '5lhule355', 'delete', 'Saya hapus', '2018-04-27 13:10:28', 'on'),
(22, '17160449', '7SG6phJ47', 'pending', 'ccd', '2018-04-27 13:12:31', 'on'),
(23, 'g6dEJhmnL', 'K70mKzcQ3', 'delete', '', '2018-04-28 13:20:31', 'on'),
(24, '17160449', 'Mv57o51PZ', 'delete', 'Anda Melakukan kesalahan', '2018-04-28 15:22:10', 'on'),
(25, 'g6dEJhmnL', 'T11y2eatM', 'pending', 'Kami Pending', '2018-04-28 15:48:52', 'on'),
(26, 'g6dEJhmnL', '6V63hZ2bd', 'approve', 'Kami Approve', '2018-04-28 15:49:06', 'on'),
(27, 'g6dEJhmnL', 'Lh3gt68NN', 'reject', 'Kami Reject', '2018-04-28 15:49:16', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `c_pengajuan` varchar(10) NOT NULL,
  `c_users` varchar(10) DEFAULT NULL,
  `c_ruangan` varchar(10) DEFAULT NULL,
  `mulai` datetime DEFAULT NULL,
  `selesai` datetime DEFAULT NULL,
  `keperluan` text,
  `berkas` text,
  `at` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`c_pengajuan`, `c_users`, `c_ruangan`, `mulai`, `selesai`, `keperluan`, `berkas`, `at`, `status`) VALUES
('14uzYBh08', 'g6dEJhmnL', '3gch7mS4J', '2018-04-27 06:30:00', '2018-04-27 07:30:00', '-', 'media/berkaspengajuan/test6.docx', '2018-04-27 06:10:12', 'approve'),
('6V63hZ2bd', 'g6dEJhmnL', '3gch7mS4J', '2018-04-28 15:45:00', '2018-04-28 17:00:00', 'Untuk Rapat', 'media/berkaspengajuan/test4.docx', '2018-04-28 15:46:37', 'approve'),
('708NGaZ3G', 'g6dEJhmnL', '2D70VHz41', '2018-04-27 07:50:00', '2018-04-27 08:50:00', 'Makan Bersama', 'media/berkaspengajuan/test2.docx', '2018-04-27 07:51:14', ''),
('7SG6phJ47', '17160449', '3gch7mS4J', '2018-04-27 16:55:00', '2018-04-27 15:55:00', 'x', 'media/berkaspengajuan/test8.docx', '2018-04-27 07:57:00', 'pending'),
('fzI8mbu3y', 'g6dEJhmnL', 'N0x75Z5n1', '2018-04-27 16:50:00', '2018-04-27 09:50:00', 'z', 'media/berkaspengajuan/test7.docx', '2018-04-27 07:52:25', ''),
('Lh3gt68NN', 'g6dEJhmnL', 'N0x75Z5n1', '2018-04-28 15:50:00', '2018-04-28 16:45:00', '-', 'media/berkaspengajuan/test10.docx', '2018-04-28 15:48:07', 'reject'),
('M6HuIN3Y2', 'g6dEJhmnL', '3gch7mS4J', '2018-04-26 20:35:00', '2018-04-26 20:55:00', '-', 'media/berkaspengajuan/test5.docx', '2018-04-26 20:39:54', ''),
('T11y2eatM', 'g6dEJhmnL', '2D70VHz41', '2018-04-28 15:45:00', '2018-04-29 16:45:00', '-', 'media/berkaspengajuan/test11.docx', '2018-04-28 15:48:33', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `pimpinan`
--

CREATE TABLE `pimpinan` (
  `c_pimpinan` varchar(10) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pimpinan`
--

INSERT INTO `pimpinan` (`c_pimpinan`, `nama`, `username`, `password`) VALUES
('pimpinan', 'Pimpinan', 'pimpinan', '90973652b88fe07d05a4304f0a945de8');

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `c_ruangan` varchar(10) NOT NULL,
  `ruangan` varchar(100) DEFAULT NULL,
  `keterangan` text,
  `gambar` text,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`c_ruangan`, `ruangan`, `keterangan`, `gambar`, `status`) VALUES
('2D70VHz41', 'Ruangan 3', 'Ruangan Untuk Praktek', 'media/ruangan/20180116050620_-_Copy.jpg', ''),
('3gch7mS4J', 'Ruangan 1', '-', 'media/ruangan/c.png', ''),
('N0x75Z5n1', 'Ruangan 2', 'Ruangan Untuk Rapat Penting', 'media/ruangan/065427600_1513750713-Teknisi_pemasangan_Lampu_Tenaga_Surya_Hemat_Energi__LTHSE___Arthur_Ridwal_Syahreza-ok.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `c_users` varchar(10) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `notelp` varchar(20) NOT NULL,
  `instansi` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `at` datetime NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `p` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`c_users`, `nama`, `email`, `notelp`, `instansi`, `username`, `password`, `at`, `status`, `p`) VALUES
('17160449', 'rino', '', '', '', 'rino', '1e4b6ced1eeb8e98917e98f7f100eec0', '2018-04-24 03:56:59', 'aktif', 'rinookta'),
('g6dEJhmnL', 'Muhammad Irsyad', 'verida@gmail.com', '081330707048', 'Swasta', 'verida', 'c3aa053a5bd3dac3c446539e438e0062', '2018-04-25 05:55:38', 'aktif', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`c_admin`);

--
-- Indexes for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  ADD PRIMARY KEY (`c_konfirmasi`);

--
-- Indexes for table `notifadmin`
--
ALTER TABLE `notifadmin`
  ADD PRIMARY KEY (`c_notifadmin`);

--
-- Indexes for table `notifuser`
--
ALTER TABLE `notifuser`
  ADD PRIMARY KEY (`c_notifuser`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`c_pengajuan`);

--
-- Indexes for table `pimpinan`
--
ALTER TABLE `pimpinan`
  ADD PRIMARY KEY (`c_pimpinan`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`c_ruangan`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`c_users`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `konfirmasi`
--
ALTER TABLE `konfirmasi`
  MODIFY `c_konfirmasi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifadmin`
--
ALTER TABLE `notifadmin`
  MODIFY `c_notifadmin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `notifuser`
--
ALTER TABLE `notifuser`
  MODIFY `c_notifuser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
