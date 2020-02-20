-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2019 at 11:28 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tanah_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(3) NOT NULL,
  `nama_buku` varchar(10) NOT NULL,
  `mulai` int(5) NOT NULL,
  `selesai` int(5) NOT NULL,
  `kurang` int(5) DEFAULT NULL,
  `ket` varchar(100) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Aktif'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `nama_buku`, `mulai`, `selesai`, `kurang`, `ket`, `status`) VALUES
(7, 'Buku C 2', 544, 1512, 0, 'Buku Pethok', 'Aktif'),
(8, 'Buku C 1', 1, 543, 0, 'Buku Pethok', 'Aktif'),
(10, 'Buku C 3', 1513, 2710, 0, 'Buku Pethok', 'Aktif'),
(11, 'Buku C 4', 2711, 4012, 0, 'Buku Pethok', 'Aktif'),
(13, 'Buku C 1B', 1, 1, NULL, '-', 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(2) NOT NULL,
  `nama_jab` varchar(20) NOT NULL,
  `ket` varchar(20) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jab`, `ket`) VALUES
(1, 'Penata Muda', '-'),
(2, 'Penata Muda Tk. I', '-'),
(3, 'Penata', '(-)'),
(4, 'Penata Tk. I', '-');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_jualbeli`
--

CREATE TABLE `jenis_jualbeli` (
  `id_jb` int(2) NOT NULL,
  `id_transaksi` int(2) DEFAULT NULL,
  `jenis_jb` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_jualbeli`
--

INSERT INTO `jenis_jualbeli` (`id_jb`, `id_transaksi`, `jenis_jb`) VALUES
(1, 1, 'Dibawah Tangan / Persaksian / Pernyataan'),
(2, 1, 'Ikatan Jual Beli'),
(3, 1, 'Akta Jual Beli'),
(4, 2, 'Akta Notaris'),
(5, 2, 'Dibawah Tangan / Persaksian / Pernyataan'),
(6, 3, 'Tidak Tersedia'),
(7, 4, 'Tidak Tersedia'),
(8, 5, 'Tidak Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_transaksi` int(2) NOT NULL,
  `nama_jenis` varchar(10) NOT NULL,
  `ket_jenis` varchar(30) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_transaksi`, `nama_jenis`, `ket_jenis`) VALUES
(1, 'Jual-Beli', ''),
(2, 'Hibah', ''),
(3, 'Waris', ''),
(4, 'Waqaf', ''),
(5, 'Mutasi', '');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `ket_kelas` varchar(30) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `ket_kelas`) VALUES
(1, 'S-I', ''),
(2, 'S-II', ''),
(3, 'S-III', ''),
(4, 'D-I', '-'),
(5, 'D-II', ''),
(6, 'D-III', '');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `kode_kel` varchar(15) NOT NULL,
  `nama_kel` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`kode_kel`, `nama_kel`, `alamat`, `telp`, `email`) VALUES
('436.9.10.4', 'Kelurahan Medokan Ayu 1', 'Jl. Jimerto No. 25-27', '(031) 870-89', 'kel_medokanayu@surabaya.go.id');

-- --------------------------------------------------------

--
-- Table structure for table `lurah`
--

CREATE TABLE `lurah` (
  `nip` varchar(18) NOT NULL,
  `id_jabatan` int(2) NOT NULL,
  `nama_lurah` varchar(50) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date DEFAULT NULL,
  `ket` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lurah`
--

INSERT INTO `lurah` (`nip`, `id_jabatan`, `nama_lurah`, `tgl_masuk`, `tgl_keluar`, `ket`) VALUES
('173901000617390188', 3, 'Moch Alief Hafizh', '2016-12-30', '2019-06-30', '-a'),
('198305172001121002', 3, 'Ahmad Yardo Wifaqo, S.Ap., M.Ap.', '2019-06-30', '2019-10-30', '-');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi`
--

CREATE TABLE `mutasi` (
  `id_mutasi` int(10) NOT NULL,
  `id_tanah` int(10) NOT NULL,
  `kohir` varchar(10) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `id_transaksi` int(2) NOT NULL,
  `id_jb` int(2) NOT NULL,
  `notaris` varchar(100) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `tanggal_regis` date NOT NULL,
  `luas` int(10) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutasi`
--

INSERT INTO `mutasi` (`id_mutasi`, `id_tanah`, `kohir`, `nama_lengkap`, `id_transaksi`, `id_jb`, `notaris`, `nomor`, `tgl`, `tanggal_regis`, `luas`, `foto`, `ket`) VALUES
(10, 28, '12', 'bjk', 1, 2, '-', '37/2019', '0001-01-01', '2016-01-01', 100, '', ''),
(11, 28, '12', 'Taufik', 1, 3, '-', '12/2017', '0001-01-01', '2017-03-01', 200, '', ''),
(12, 28, '535', 'Ismiati', 1, 3, '-', '31/2013', '0001-01-01', '2013-01-01', 200, '', ''),
(13, 28, '28', 'Joko', 2, 4, '-', '0', '0001-01-01', '2013-10-01', 200, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `mutasi2`
--

CREATE TABLE `mutasi2` (
  `id_mutasi2` int(10) NOT NULL,
  `dulu` int(10) NOT NULL,
  `skrg` int(10) NOT NULL,
  `golongan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mutasi2`
--

INSERT INTO `mutasi2` (`id_mutasi2`, `dulu`, `skrg`, `golongan`) VALUES
(2, 28, 46, 2),
(4, 28, 50, 0),
(5, 46, 51, 2),
(6, 46, 56, 2),
(9, 28, 59, 0),
(18, 46, 59, 0),
(45, 50, 99, 0),
(46, 99, 100, 0),
(47, 28, 102, 0),
(48, 51, 103, 0),
(49, 36, 104, 0);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(1) NOT NULL,
  `nama_satuan` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `nama_satuan`) VALUES
(1, 'm2.'),
(2, 'ha.');

-- --------------------------------------------------------

--
-- Table structure for table `tanah`
--

CREATE TABLE `tanah` (
  `id_tanah` int(10) NOT NULL,
  `kohir` varchar(10) NOT NULL,
  `id_buku` int(3) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `id_transaksi` int(2) NOT NULL,
  `id_jb` int(2) NOT NULL,
  `nama_notaris` varchar(50) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `tgl` date NOT NULL,
  `persil` varchar(10) NOT NULL,
  `id_kelas` int(2) NOT NULL,
  `luas` double(10,3) NOT NULL,
  `id_satuan` int(1) NOT NULL,
  `tgl_regis` date NOT NULL,
  `foto` varchar(100) NOT NULL,
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanah`
--

INSERT INTO `tanah` (`id_tanah`, `kohir`, `id_buku`, `nama_lengkap`, `alamat`, `id_transaksi`, `id_jb`, `nama_notaris`, `nomor`, `tgl`, `persil`, `id_kelas`, `luas`, `id_satuan`, `tgl_regis`, `foto`, `ket`) VALUES
(28, '12', 8, 'Oesman', 'Jalan Jimerto', 1, 3, '-', '0', '0001-01-01', '12', 2, 34600.000, 1, '1981-12-22', 'picture/77303-ID-none.pdf', ''),
(29, '222', 8, 'Susilo', 'Jalan Medokan Ayu', 1, 3, '-', '0', '0001-01-01', '88', 5, 2400.000, 1, '2015-01-01', '', ''),
(36, '57', 8, 'Ibrahim', 'Jalan Semolo Waru', 1, 1, '-', '0', '0001-01-01', '200', 4, 2100.000, 1, '1998-02-16', '', ''),
(37, '57', 8, 'Ibrahim', 'Jalan Semolo Waru', 1, 1, '-', '0', '0001-01-01', '79', 3, 5720.000, 1, '1998-02-16', '', ''),
(38, '57', 8, 'Ibrahim', 'Jalan Semolo Waru', 1, 1, '-', '0', '0001-01-01', '89', 4, 1266.000, 1, '1998-02-16', '', ''),
(46, '12', 8, 'Ubaidilah Adnan', 'Jalan Jimerto 12', 1, 1, '-', '0', '0001-01-01', '12', 2, 1290.000, 1, '2009-12-06', 'picture/[46]77303-ID-none.pdf', ''),
(47, '49', 8, 'Sultan Abdul', 'Jalan Gubeng', 1, 1, '-', '0', '0001-01-01', '35', 4, 3100.000, 1, '2012-04-07', '', ''),
(48, '49', 8, 'Sultan Abdul', 'Jalan Gubeng', 1, 1, '-', '0', '0001-01-01', '80', 5, 2388.000, 1, '2012-04-07', '', ''),
(50, '12', 8, 'Maulana', 'Jalan Jimerto', 1, 1, '-', '0', '0001-01-01', '12', 2, 100.000, 1, '2008-03-03', '', ''),
(51, '12', 8, 'Agung', 'Jalan Jimerto', 1, 3, 'Haikal', '12/2009', '2009-12-20', '12', 2, 250.000, 1, '2010-11-29', '', ''),
(56, '12', 8, 'Malik', 'Jalan Jimerto 12', 1, 1, '-', '0', '0001-01-01', '12', 2, 210.000, 1, '2013-10-31', '', ''),
(57, '57', 8, 'Abbas', 'Jalan Semolo Waru', 1, 1, '-', '0', '0001-01-01', '89', 4, 1266.000, 1, '2014-09-06', '', ''),
(59, '600', 7, 'jon', 'Jalan Jimerto', 1, 3, '-', '0', '2019-06-15', '12', 2, 500.000, 1, '2019-06-15', '', ''),
(63, '88', 8, 'Trrrr', 'Jalan Jimerto', 2, 5, '-', '0', '0001-01-01', '12', 2, 12.000, 1, '2018-12-31', '', ''),
(64, '88', 8, 'Trrrr', 'Jalan Jimerto', 2, 5, '-', '0', '0001-01-01', '12', 2, 12.000, 1, '2018-12-31', '', ''),
(65, '88', 8, 'Trrrr', 'Jalan Jimerto', 2, 5, '-', '0', '0001-01-01', '12', 2, 12.000, 1, '2018-12-31', '', ''),
(66, '88', 8, 'Trrrr', 'Jalan Jimerto', 2, 5, '-', '0', '0001-01-01', '12', 2, 12.000, 1, '2018-12-31', '', ''),
(69, '341', 8, 'Sutris', 'Jalan Jimerto 12', 3, 6, '-', '0', '0001-01-01', '12', 2, 100.000, 1, '2016-03-03', '', ''),
(73, '750', 7, 'Alief', 'Jalan Jimerto', 1, 1, '-', '0', '0001-01-01', '12', 2, 230.000, 1, '2017-12-29', '', ''),
(74, '12', 8, 'Burhan', 'Jalan Jimerto 12', 2, 5, '-', '0', '0001-01-01', '12', 2, 100.000, 1, '2012-10-29', '', ''),
(75, '12', 8, 'Geo', 'Jalan Jimerto 12', 1, 1, '-', '0', '0001-01-01', '12', 2, 100.000, 1, '2016-11-30', '', ''),
(76, '23', 8, 'Vani', 'Jalan Jimerto 12', 2, 4, '-', '0', '0001-01-01', '12', 2, 50.000, 1, '2013-10-30', '', ''),
(77, '90', 8, 'Testing 2', 'Jalan Semolo Waru', 1, 3, '-', '0', '0001-01-01', '79', 3, 150.128, 1, '2016-06-24', '', ''),
(78, '12', 8, 'Agung 2', 'Jalan Jimerto', 1, 3, '-', '0', '0001-01-01', '12', 2, 60.231, 1, '2016-11-19', '', ''),
(79, '57', 8, 'Malik', 'Jalan Semolo Waru', 2, 4, '-', '0', '0001-01-01', '200', 4, 131.212, 1, '2017-10-02', '', ''),
(80, '57', 8, 'Sunan', 'Jalan Semolo Waru', 1, 1, '-', '0', '0001-01-01', '200', 4, 100.212, 1, '2018-06-02', '', ''),
(81, '57', 8, 'Sunan', 'Jalan Semolo Waru', 2, 4, '-', '0', '0001-01-01', '200', 4, 100.000, 1, '2019-03-02', '', ''),
(82, '12', 8, 'Maul 2', 'Jalan Jimerto', 1, 3, '-', '0', '0001-01-01', '12', 2, 50.000, 1, '2018-11-30', '', ''),
(83, '23', 8, 'Lancar', 'Jalan Jimerto 12', 1, 1, '-', '0', '0001-01-01', '12', 2, 111.000, 1, '2015-12-02', '', ''),
(84, '12', 8, 'asaas', 'Jalan Jimerto 12', 1, 3, '-', '0', '0001-01-01', '12', 2, 121.000, 1, '2017-10-02', '', ''),
(85, '12', 8, 'asaas', 'Jalan Jimerto 12', 1, 3, '-', '0', '0001-01-01', '12', 2, 121.000, 1, '2017-10-02', '', ''),
(86, '677', 7, 'tyty', 'Jalan Jimerto 12', 2, 4, '-', '0', '0001-01-01', '12', 2, 190.000, 1, '2017-10-02', '', ''),
(87, '231', 8, 'Da', 'Jalan Jimerto', 2, 5, '-', '0', '0001-01-01', '12', 2, 30.000, 1, '2016-07-04', '', ''),
(88, '11', 8, 'cvxvx', 'Jalan Jimerto 12', 1, 3, '-', '0', '0001-01-01', '12', 2, 14.000, 1, '2017-02-02', '', ''),
(89, '676', 7, 'lfogk', 'Jalan Jimerto 12', 1, 1, '-', '0', '0001-01-01', '12', 2, 321.000, 1, '2017-09-02', '', ''),
(90, '12', 8, 'popo', 'Jalan Jimerto 12', 2, 4, '-', '0', '0001-01-01', '12', 2, 100.000, 1, '2017-02-02', '', ''),
(91, '12', 8, 'vcz', 'Jalan Jimerto 12', 1, 3, '-', '0', '0001-01-01', '12', 2, 100.000, 1, '2017-04-02', '', ''),
(92, '12', 8, 'vcz', 'Jalan Jimerto 12', 1, 3, '-', '0', '0001-01-01', '12', 2, 100.000, 1, '2017-04-02', '', ''),
(93, '64', 8, 'FINAL', 'Jalan Jimerto 12', 1, 1, '-', '0', '0001-01-01', '12', 2, 21.000, 1, '2018-11-30', '', ''),
(94, '521', 8, 'Abbas', 'Jalan Semolo Waru', 1, 1, '-', '0', '0001-01-01', '200', 4, 100.000, 1, '2017-07-01', '', ''),
(95, '12', 8, 'zxer', 'Jalan Jimerto', 2, 4, '-', '0', '0001-01-01', '12', 2, 99.000, 1, '2016-10-02', '', ''),
(96, '121', 8, 'Huyy', 'Jalan Jimerto', 1, 3, '-', '0', '0001-01-01', '12', 2, 99.000, 1, '2017-11-05', '', ''),
(97, '231', 8, 'mbm', 'Jalan Jimerto', 2, 5, '-', '0', '0001-01-01', '12', 2, 50.000, 1, '2018-01-01', '', ''),
(98, '123', 8, 'qu', 'Jalan Jimerto', 2, 4, '-', '0', '0001-01-01', '12', 2, 30.000, 1, '2016-11-02', '', ''),
(99, '131', 8, 'weq', 'Jalan Jimerto', 1, 3, '-', '0', '0001-01-01', '12', 2, 10.000, 1, '2016-01-02', '', ''),
(100, '123', 8, 'daad', 'Jalan Jimerto', 2, 4, '-', '0', '0001-01-01', '12', 2, 10.000, 1, '2017-10-31', '', ''),
(101, '33', 8, 'Pro', 'Jalan Jimerto', 1, 3, '-', '0', '0001-01-01', '12', 2, 200.000, 1, '2017-05-02', '', ''),
(102, '33', 8, 'Pro', 'Jalan Jimerto', 1, 3, '-', '0', '0001-01-01', '12', 2, 200.000, 1, '2017-05-02', '', ''),
(103, '13', 8, 'Agung 99', 'Jalan Jimerto', 1, 1, '-', '0', '0001-01-01', '12', 2, 120.000, 1, '2017-02-02', '', ''),
(104, '800', 7, 'Ibra', 'Jalan Semolo Waru', 1, 3, '-', '0', '0001-01-01', '200', 4, 1900.000, 1, '2017-03-02', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indexes for table `jenis_jualbeli`
--
ALTER TABLE `jenis_jualbeli`
  ADD PRIMARY KEY (`id_jb`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indexes for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`kode_kel`);

--
-- Indexes for table `lurah`
--
ALTER TABLE `lurah`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_jabatan` (`id_jabatan`);

--
-- Indexes for table `mutasi`
--
ALTER TABLE `mutasi`
  ADD PRIMARY KEY (`id_mutasi`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_jb` (`id_jb`);

--
-- Indexes for table `mutasi2`
--
ALTER TABLE `mutasi2`
  ADD PRIMARY KEY (`id_mutasi2`),
  ADD KEY `dulu` (`dulu`),
  ADD KEY `skrg` (`skrg`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `tanah`
--
ALTER TABLE `tanah`
  ADD PRIMARY KEY (`id_tanah`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_transaksi` (`id_transaksi`),
  ADD KEY `id_transaksi_2` (`id_transaksi`),
  ADD KEY `id_jb` (`id_jb`),
  ADD KEY `id_kelas` (`id_kelas`),
  ADD KEY `id_satuan` (`id_satuan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jenis_jualbeli`
--
ALTER TABLE `jenis_jualbeli`
  MODIFY `id_jb` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_transaksi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mutasi`
--
ALTER TABLE `mutasi`
  MODIFY `id_mutasi` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `mutasi2`
--
ALTER TABLE `mutasi2`
  MODIFY `id_mutasi2` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tanah`
--
ALTER TABLE `tanah`
  MODIFY `id_tanah` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jenis_jualbeli`
--
ALTER TABLE `jenis_jualbeli`
  ADD CONSTRAINT `jenis_jualbeli_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `jenis_transaksi` (`id_transaksi`);

--
-- Constraints for table `lurah`
--
ALTER TABLE `lurah`
  ADD CONSTRAINT `lurah_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`);

--
-- Constraints for table `mutasi2`
--
ALTER TABLE `mutasi2`
  ADD CONSTRAINT `mutasi2_ibfk_1` FOREIGN KEY (`dulu`) REFERENCES `tanah` (`id_tanah`),
  ADD CONSTRAINT `mutasi2_ibfk_2` FOREIGN KEY (`skrg`) REFERENCES `tanah` (`id_tanah`);

--
-- Constraints for table `tanah`
--
ALTER TABLE `tanah`
  ADD CONSTRAINT `tanah_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `jenis_transaksi` (`id_transaksi`),
  ADD CONSTRAINT `tanah_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `tanah_ibfk_3` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `tanah_ibfk_4` FOREIGN KEY (`id_jb`) REFERENCES `jenis_jualbeli` (`id_jb`),
  ADD CONSTRAINT `tanah_ibfk_5` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
