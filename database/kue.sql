-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 23, 2023 at 05:57 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kue`
--

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `banner_id` int NOT NULL,
  `gambar` varchar(300) NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`banner_id`, `gambar`, `status`) VALUES
(1, 'f5.jpg', 'on'),
(2, 'f6.jpg', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` int NOT NULL,
  `nama_karyawan` varchar(50) NOT NULL,
  `no_telp` int NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `jabatan` varchar(25) NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `nama_karyawan`, `no_telp`, `alamat`, `email`, `jabatan`, `status`) VALUES
(1, 'Sulhi', 74373737, 'walantaka cigoong', 'coysulhi@gmail.com', 'cheff', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int NOT NULL,
  `kategori` varchar(25) NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`, `status`) VALUES
(1, 'Katalog', 'on'),
(2, 'donat', 'on'),
(3, 'roti', 'on'),
(4, 'kue_tart', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `kirim`
--

CREATE TABLE `kirim` (
  `id_kirim` int NOT NULL,
  `id_pesanan` int NOT NULL,
  `id_karyawan` int NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kirim`
--

INSERT INTO `kirim` (`id_kirim`, `id_pesanan`, `id_karyawan`, `status`) VALUES
(1, 15, 1, 'Di Kirim'),
(2, 22, 1, 'selesai'),
(3, 23, 1, 'selesai'),
(4, 26, 1, 'selesai'),
(5, 3, 1, 'selesai');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pembayaran`
--

CREATE TABLE `konfirmasi_pembayaran` (
  `konfirmasi_id` int NOT NULL,
  `id_pesanan` int NOT NULL,
  `no_rek` varchar(25) NOT NULL,
  `nama_account` varchar(30) NOT NULL,
  `tgl_transfer` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi_pembayaran`
--

INSERT INTO `konfirmasi_pembayaran` (`konfirmasi_id`, `id_pesanan`, `no_rek`, `nama_account`, `tgl_transfer`) VALUES
(1, 0, '970866543', 'sueb', '2018-08-10'),
(2, 0, '12432432', 'kokom', '2018-08-10'),
(3, 0, '9886754', 'keke', '2018-08-10'),
(4, 0, '2545', 'azki', '2018-08-10'),
(5, 14, '7654343', 'kokok', '2018-08-10'),
(6, 15, '76654321234', 'diki', '2018-08-11'),
(7, 16, '5664329876', 'dikdik', '2018-08-19'),
(8, 17, '890787', 'sul sul', '2018-08-19'),
(9, 19, '534534', 'sul', '2018-08-20'),
(10, 20, '6356357', 'dik', '2018-08-20'),
(11, 21, '87865', 'jati', '2018-09-14');

-- --------------------------------------------------------

--
-- Table structure for table `konfirmasi_pesanan`
--

CREATE TABLE `konfirmasi_pesanan` (
  `id_konfirmasi_p` int NOT NULL,
  `id_pesanan` int NOT NULL,
  `id_karyawan` int NOT NULL,
  `lama_pesanan` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `konfirmasi_pesanan`
--

INSERT INTO `konfirmasi_pesanan` (`id_konfirmasi_p`, `id_pesanan`, `id_karyawan`, `lama_pesanan`) VALUES
(1, 15, 1, '2 jam'),
(2, 22, 1, '2 hari'),
(3, 22, 1, '2 hari'),
(4, 26, 1, '2 hari'),
(5, 2, 1, '2 hari'),
(6, 3, 1, '7 hari');

-- --------------------------------------------------------

--
-- Table structure for table `kota`
--

CREATE TABLE `kota` (
  `id_kota` int NOT NULL,
  `nama_kota` varchar(50) NOT NULL,
  `tarif` int NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kota`
--

INSERT INTO `kota` (`id_kota`, `nama_kota`, `tarif`, `status`) VALUES
(1, 'serang', 5000, 'on'),
(3, 'cilegon', 10000, 'on'),
(4, 'pandeglang', 8000, 'on');

-- --------------------------------------------------------

--
-- Table structure for table `kue`
--

CREATE TABLE `kue` (
  `id_kue` int NOT NULL,
  `id_kategori` int NOT NULL,
  `nama_kue` varchar(70) NOT NULL,
  `spesifikasi` text NOT NULL,
  `gambar` varchar(300) NOT NULL,
  `harga` int NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kue`
--

INSERT INTO `kue` (`id_kue`, `id_kategori`, `nama_kue`, `spesifikasi`, `gambar`, `harga`, `status`) VALUES
(1, 1, 'Donat Messes', '', 'donat1.jpg', 5000, 'on'),
(2, 1, 'Donat Salju', '', 'donat3.jpg', 5000, 'on'),
(3, 1, 'Brownis Coklat', '', 'kue2.jpg', 5000, 'on'),
(4, 3, 'Roti Pizza Abon', '', 'roti4.jpg', 5000, 'on'),
(5, 2, 'Donat Messes Keju', '', 'donat4.jpg', 5000, 'on'),
(6, 1, 'Roti Gulung', '', 'roti6.jpg', 20000, 'on'),
(7, 1, 'Kue Tart 25x25', '', 'kue3.jpg', 75000, 'on'),
(8, 1, 'Tart Mini', '', 'kue4.jpg', 20000, 'on'),
(9, 1, 'Roti Abon Keju', '', 'roti7.jpg', 7000, 'on'),
(10, 1, 'Roti Kepang Coklat', '', 'roti8.jpg', 10000, 'on'),
(11, 4, 'Kue Tart 22x10', '', 'kue1.jpg', 150000, 'on'),
(13, 1, 'Donat Messes', '', 'donat1.jpg', 5000, 'on'),
(14, 2, 'Donat Salju', '', 'donat3.jpg', 5000, 'on'),
(15, 4, 'Kue Tart 30x10', '', 'kue5.jpg', 120000, 'on'),
(16, 4, 'Kue Tart 22x30', '', 'kue6.jpg', 180000, 'on'),
(17, 4, 'Kue Tart 20x8', '', 'kue7.jpg', 140000, 'on'),
(18, 4, 'Kue Tart 30x10', '', 'kue8.jpg', 130000, 'on'),
(19, 4, 'Kue Tart 18x8', '', 'kue9.jpg', 120000, 'on'),
(20, 4, 'Kue Tart 22x25', '', 'kue10.jpg', 140000, 'on'),
(21, 4, 'Kue Tart 18x25', '', 'kue11.jpg', 145000, 'on'),
(22, 3, 'Roti Messes', '', 'roti9.jpg', 10000, 'on'),
(23, 3, 'Roti Pizza Keju', '', 'roti11.jpg', 10000, 'on'),
(24, 3, 'Roti Gula', '', 'roti12.jpg', 7000, 'on'),
(25, 3, 'Roti Pisang Coklat', '', 'roti13.jpg', 10000, 'on'),
(26, 3, 'Roti Roll', '', 'roti14.jpg', 12000, 'on'),
(27, 3, 'Roti Coklat Keju', '', 'roti16.jpg', 15000, 'on');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int NOT NULL,
  `user_id` int NOT NULL,
  `id_kota` int NOT NULL,
  `nama_penerima` varchar(30) NOT NULL,
  `no_telp` int NOT NULL,
  `alamat` text NOT NULL,
  `catatan` text NOT NULL,
  `tgl_pemesanan` date NOT NULL,
  `status` tinyint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `user_id`, `id_kota`, `nama_penerima`, `no_telp`, `alamat`, `catatan`, `tgl_pemesanan`, `status`) VALUES
(1, 5, 1, 'wahyu', 1234, 'Balung', '<p>123</p>', '2023-11-21', 0),
(2, 2, 1, 'afni', 822, 'ambulu', '<p>yang enak ya</p>', '2023-11-21', 1),
(3, 2, 1, 'afni', 2147483647, 'ambulu', '<p>123</p>', '2023-11-21', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id_pesanan` int NOT NULL,
  `id_kue` int NOT NULL,
  `qty` tinyint NOT NULL,
  `harga` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id_pesanan`, `id_kue`, `qty`, `harga`) VALUES
(2, 2, 0, 210000),
(3, 8, 1, 225000),
(4, 3, 1, 235000),
(5, 10, 1, 210000),
(6, 7, 1, 225000),
(7, 4, 1, 245000),
(8, 6, 1, 230000),
(9, 4, 1, 245000),
(10, 1, 1, 235000),
(11, 6, 1, 230000),
(12, 5, 1, 230000),
(13, 3, 1, 235000),
(14, 9, 1, 225000),
(15, 7, 1, 225000),
(16, 13, 1, 400000),
(17, 25, 1, 400000),
(18, 3, 1, 235000),
(19, 5, 1, 230000),
(20, 1, 1, 235000),
(21, 9, 1, 225000),
(22, 6, 1, 230000),
(22, 5, 2, 230000),
(22, 3, 1, 235000),
(23, 1, 1, 235000),
(23, 9, 1, 225000),
(24, 65, 1, 20000),
(24, 68, 1, 7000),
(25, 65, 1, 20000),
(25, 60, 1, 5000),
(26, 63, 1, 5000),
(26, 60, 2, 5000),
(26, 67, 1, 20000),
(6, 2, 1, 5000),
(6, 3, 1, 5000),
(7, 8, 1, 20000),
(2, 9, 1, 7000),
(2, 3, 1, 5000),
(2, 2, 1, 5000),
(3, 7, 1, 75000),
(3, 11, 1, 150000),
(3, 8, 1, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `shout_box`
--

CREATE TABLE `shout_box` (
  `id` int NOT NULL,
  `user` varchar(60) NOT NULL,
  `message` varchar(100) NOT NULL,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ip_address` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shout_box`
--

INSERT INTO `shout_box` (`id`, `user`, `message`, `date_time`, `ip_address`) VALUES
(1, 'diki', 'itu berapa gan', '2018-07-10 15:26:24', '::1'),
(2, 'agan', '100000 gan', '2018-07-11 01:32:24', '::1'),
(3, 'sulhi', 'gan coklat berapa', '2018-07-11 13:14:11', '::1'),
(4, 'agan', '60000', '2018-07-11 13:15:03', '::1'),
(5, 'dono', 'alamat dimana??', '2018-07-25 15:38:23', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_telp` varchar(15) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(40) NOT NULL,
  `level` enum('pembeli','admin') NOT NULL,
  `status` enum('on','off') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama_lengkap`, `email`, `no_telp`, `username`, `password`, `level`, `status`) VALUES
(1, 'admin', 'admin@gmail.com', '08987881597', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'on'),
(2, 'Mey Nur Afni', 'afni@gmail.com', '12345', 'Afni', '202cb962ac59075b964b07152d234b70', 'pembeli', 'on'),
(3, 'alya', 'alya@gmail.com', '12345', 'Alya', '202cb962ac59075b964b07152d234b70', 'pembeli', 'on'),
(4, 'Alfian', 'alfian@gmail.com', '12345', 'Alfian', '202cb962ac59075b964b07152d234b70', 'pembeli', 'on'),
(5, 'Wahyu', 'wayu@gmail.com', '0987654321', 'wahyu', '202cb962ac59075b964b07152d234b70', 'pembeli', 'on');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `kirim`
--
ALTER TABLE `kirim`
  ADD PRIMARY KEY (`id_kirim`);

--
-- Indexes for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  ADD PRIMARY KEY (`konfirmasi_id`);

--
-- Indexes for table `konfirmasi_pesanan`
--
ALTER TABLE `konfirmasi_pesanan`
  ADD PRIMARY KEY (`id_konfirmasi_p`);

--
-- Indexes for table `kota`
--
ALTER TABLE `kota`
  ADD PRIMARY KEY (`id_kota`);

--
-- Indexes for table `kue`
--
ALTER TABLE `kue`
  ADD PRIMARY KEY (`id_kue`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`);

--
-- Indexes for table `shout_box`
--
ALTER TABLE `shout_box`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `banner_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `id_karyawan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kirim`
--
ALTER TABLE `kirim`
  MODIFY `id_kirim` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `konfirmasi_pembayaran`
--
ALTER TABLE `konfirmasi_pembayaran`
  MODIFY `konfirmasi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `konfirmasi_pesanan`
--
ALTER TABLE `konfirmasi_pesanan`
  MODIFY `id_konfirmasi_p` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kota`
--
ALTER TABLE `kota`
  MODIFY `id_kota` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kue`
--
ALTER TABLE `kue`
  MODIFY `id_kue` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `shout_box`
--
ALTER TABLE `shout_box`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
