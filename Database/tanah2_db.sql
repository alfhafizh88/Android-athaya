-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2020 at 01:12 AM
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
-- Database: `tanah2_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `nama_akun` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `alamat` varchar(60) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `level` varchar(15) NOT NULL DEFAULT 'Staf',
  `password` varchar(50) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Aktif',
  `ket` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id`, `username`, `nama_akun`, `email`, `alamat`, `telepon`, `level`, `password`, `status`, `ket`) VALUES
(1, 'admin', 'Alief', 'ada@a.com', 'Jalan-jalan ke luar kota', '081283727271', 'Staf', '1844156d4166d94387f1a4ad031ca5fa', 'Tidak Aktif', ''),
(2, 'alf123', 'Wees', 'alief.hafizh88@gmail.com', 'Jalan', '082245567946', 'Staf', '21232f297a57a5a743894a0e4a801fc3', 'Staf', '-'),
(3, 'ilham', 'Ilham', 'saudara45@gmail.com', 'Jalan Semampir Indah No.4', '085850171320', 'Admin', '21232f297a57a5a743894a0e4a801fc3', 'Aktif', '-'),
(4, 'joko', 'Joko Setya', 'joko_setya12@gmail.com', 'Jalan Rata', '0822029049449', 'Warga', '1844156d4166d94387f1a4ad031ca5fa', 'Aktif', ''),
(5, 'rosi', 'Rosi Try', 'rosi@a.com', 'Jalan Lope', '082219777', 'Warga', '0192023a7bbd73250516f069df18b500', 'Aktif', '-'),
(6, 'superadmin', 'Moch Alief Hafizh', 'alief.hafizh88@gmail.com', 'Jalan Kedung Baruk', '083857483999', 'Lurah', '21232f297a57a5a743894a0e4a801fc3', 'Aktif', '');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(3) NOT NULL,
  `nama_buku` varchar(10) NOT NULL,
  `mulai` int(5) NOT NULL,
  `selesai` int(5) NOT NULL,
  `kurang` int(5) NOT NULL,
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
(11, 'Buku C 4', 2711, 4012, 1, 'Buku Pethok', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `desain`
--

CREATE TABLE `desain` (
  `id_desain` int(20) NOT NULL,
  `tema` varchar(20) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `nama_aplikasi` varchar(100) NOT NULL,
  `pengguna` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desain`
--

INSERT INTO `desain` (`id_desain`, `tema`, `logo`, `nama_aplikasi`, `pengguna`) VALUES
(1, 'theme-blue-grey', 'images/pemkot2.png', 'ATHAYA', 'Admin'),
(2, 'theme-indigo', 'images/pemkot2.png', 'Aplikasi Administrasi Pertanahan', 'Warga'),
(3, '', 'asa', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` int(2) NOT NULL,
  `nama_jab` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Aktif',
  `ket` varchar(20) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jab`, `status`, `ket`) VALUES
(1, 'Penata Muda', 'Aktif', '-'),
(2, 'Penata Muda Tk. I', 'Aktif', '-'),
(3, 'Penata', 'Aktif', '(-)'),
(4, 'Penata Tk. I', 'Aktif', '-'),
(8, 'Tidak Tersedia', 'Aktif', '-');

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
(6, 3, 'Akta Waris'),
(7, 4, 'Tidak Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_transaksi`
--

CREATE TABLE `jenis_transaksi` (
  `id_transaksi` int(2) NOT NULL,
  `nama_jenis` varchar(10) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Aktif',
  `ket_jenis` varchar(30) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_transaksi`
--

INSERT INTO `jenis_transaksi` (`id_transaksi`, `nama_jenis`, `status`, `ket_jenis`) VALUES
(1, 'Jual-Beli', 'Aktif', ''),
(2, 'Hibah', 'Aktif', '-'),
(3, 'Waris', 'Aktif', ''),
(4, 'Wakaf', 'Aktif', ''),
(5, 'Mutasi', 'Aktif', ''),
(6, '-', 'Tidak Aktif', '-');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `nama_kelas` varchar(10) NOT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Aktif',
  `ket_kelas` varchar(30) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`, `status`, `ket_kelas`) VALUES
(1, 'S-I', 'Aktif', '-'),
(2, 'S-II', 'Aktif', '-'),
(3, 'S-III', 'Aktif', '-'),
(4, 'D-I', 'Aktif', '-'),
(5, 'D-II', 'Aktif', '-'),
(6, 'D-III', 'Aktif', '-'),
(7, 'Tidak Ada', 'Aktif', '-');

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `kode_kel` varchar(15) NOT NULL,
  `nama_kel` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `telp` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`kode_kel`, `nama_kel`, `alamat`, `telp`, `email`) VALUES
('436.9.10.4', 'Kelurahan Medokan Ayu', 'Jl. Jimerto No. 25-27', '(031) 870-777', 'kel_medokanayu@surabaya.go.id');

-- --------------------------------------------------------

--
-- Table structure for table `lurah`
--

CREATE TABLE `lurah` (
  `nip` varchar(18) NOT NULL,
  `id_jabatan` int(2) NOT NULL,
  `nama_lurah` varchar(50) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `tgl_keluar` date DEFAULT '0000-00-00',
  `ket` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lurah`
--

INSERT INTO `lurah` (`nip`, `id_jabatan`, `nama_lurah`, `tgl_masuk`, `tgl_keluar`, `ket`) VALUES
('173901000617390188', 3, 'Moch Alief Hafizh', '2016-12-30', '2019-12-24', '-'),
('198305172001121002', 2, 'Ahmad Yardo Wifaqo, S.AP., M.AP.', '2019-06-30', '0000-00-00', 'Tidak Ada');

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
  `induk` varchar(1) DEFAULT '0',
  `kohir` varchar(10) NOT NULL,
  `id_buku` int(3) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `maps` varchar(500) NOT NULL DEFAULT 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d24131.78183286545!2d112.80055742941137!3d-7.321929432798988!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f075201743ad%3A0x6d3be78e3fe993ef!2sMedokan%20Ayu%2C%20Kec.%20Rungkut%2C%20Kota%20SBY%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1576037925089!5m2!1sid!2sid',
  `id_transaksi` int(2) NOT NULL,
  `id_jb` int(2) NOT NULL,
  `nama_notaris` varchar(50) NOT NULL,
  `nomor` varchar(20) NOT NULL,
  `tgl` date NOT NULL DEFAULT '0001-01-01',
  `persil` varchar(10) NOT NULL,
  `id_kelas` int(2) NOT NULL,
  `luas` int(10) NOT NULL,
  `id_satuan` int(1) NOT NULL DEFAULT '1',
  `tgl_regis` date NOT NULL,
  `foto` varchar(100) NOT NULL DEFAULT 'picture/imagetopdf.pdf',
  `gol` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL DEFAULT 'superadmin',
  `last_seen` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  `akun_pemilik` varchar(50) NOT NULL DEFAULT 'superadmin',
  `ket` varchar(50) NOT NULL DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tanah`
--

INSERT INTO `tanah` (`id_tanah`, `induk`, `kohir`, `id_buku`, `nama_lengkap`, `alamat`, `maps`, `id_transaksi`, `id_jb`, `nama_notaris`, `nomor`, `tgl`, `persil`, `id_kelas`, `luas`, `id_satuan`, `tgl_regis`, `foto`, `gol`, `username`, `last_seen`, `status`, `akun_pemilik`, `ket`) VALUES
(6, '1', '1', 8, 'Moch. Alief Hafizh', 'Jalan Medokan Ayu 2', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.2486520816547!2d112.79020291432137!3d-7.325944374078135!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fabe0b733021%3A0x86aaca18778782a!2sJl.%20Medokan%20Ayu%202%2C%20Medokan%20Ayu%2C%20Kec.%20Rungkut%2C%20Kota%20SBY%2C%20Jawa%20Timur%2060295!5e0!3m2!1sen!2sid!4v1576854846598!5m2!1sen!2sid', 1, 3, '-', '0', '0001-01-01', '23', 5, 1850, 1, '1999-06-30', 'picture/', '6', 'ilham', '2019-12-20 22:16:07', '0', 'ilham', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `desain`
--
ALTER TABLE `desain`
  ADD PRIMARY KEY (`id_desain`);

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
  ADD KEY `id_satuan` (`id_satuan`),
  ADD KEY `username` (`username`),
  ADD KEY `akun_pemilik` (`akun_pemilik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `desain`
--
ALTER TABLE `desain`
  MODIFY `id_desain` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id_jabatan` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jenis_jualbeli`
--
ALTER TABLE `jenis_jualbeli`
  MODIFY `id_jb` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `jenis_transaksi`
--
ALTER TABLE `jenis_transaksi`
  MODIFY `id_transaksi` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mutasi2`
--
ALTER TABLE `mutasi2`
  MODIFY `id_mutasi2` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
  ADD CONSTRAINT `tanah_ibfk_5` FOREIGN KEY (`id_satuan`) REFERENCES `satuan` (`id_satuan`),
  ADD CONSTRAINT `tanah_ibfk_6` FOREIGN KEY (`username`) REFERENCES `akun` (`username`),
  ADD CONSTRAINT `tanah_ibfk_7` FOREIGN KEY (`akun_pemilik`) REFERENCES `akun` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
