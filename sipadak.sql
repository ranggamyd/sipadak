-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 21, 2024 at 02:58 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipadak`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama`, `username`, `password`, `email`) VALUES
(1, 'admin', 'admin', 'admin', 'admin@admin.com');

-- --------------------------------------------------------

--
-- Table structure for table `analisa_krit`
--

CREATE TABLE `analisa_krit` (
  `id_penyakit` int(11) NOT NULL,
  `kriteria_x` varchar(2) NOT NULL,
  `nilai_krit` float NOT NULL,
  `hasil_analis` double NOT NULL,
  `kriteria_y` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gejala`
--

CREATE TABLE `gejala` (
  `id_gejala` int(11) NOT NULL,
  `kode_gejala` varchar(10) NOT NULL,
  `nama_gejala` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gejala`
--

INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`) VALUES
(1, 'G01', 'Dehidrasi'),
(2, 'G02', 'Kotoran encer'),
(3, 'G03', 'Tubuh lemah'),
(4, 'G04', 'Mulut melepuh'),
(5, 'G05', 'Mulut menganga'),
(6, 'G06', 'Kaku'),
(7, 'G07', 'Kejang otot'),
(8, 'G08', 'Lubang hidung & dubur keluar darah'),
(9, 'G09', 'Suhu tubuh meninggi'),
(10, 'G10', 'Suka buang air'),
(11, 'G11', 'Nafsu makan menurun'),
(12, 'G12', 'Gatal di kulit dan badan'),
(13, 'G13', 'Senang menggaruk tubuh'),
(14, 'G14', 'Luka bulat dikulit badan & leher');

-- --------------------------------------------------------

--
-- Table structure for table `hasil`
--

CREATE TABLE `hasil` (
  `id_hasil` int(15) NOT NULL,
  `id_pasien` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `gejala` varchar(250) NOT NULL,
  `penyakit` varchar(250) NOT NULL,
  `hasil_id` int(11) NOT NULL,
  `hasil_nilai` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kondisi`
--

CREATE TABLE `kondisi` (
  `id_kondisi` int(11) NOT NULL,
  `kode_kondisi` varchar(20) NOT NULL,
  `nama_kondisi` varchar(100) NOT NULL,
  `nilai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kondisi`
--

INSERT INTO `kondisi` (`id_kondisi`, `kode_kondisi`, `nama_kondisi`, `nilai`) VALUES
(1, 'K01', 'Sangat Yakin', '1.0'),
(2, 'K02', 'Yakin', '0.8'),
(3, 'K03', 'Cukup Yakin', '0.6'),
(4, 'K04', 'Sedikit Yakin', '0.4'),
(5, 'K05', 'Tidak Tahu', '0.2'),
(10, 'K06', 'Tidak', '0');

-- --------------------------------------------------------

--
-- Table structure for table `nilai`
--

CREATE TABLE `nilai` (
  `id_nilai` int(11) NOT NULL,
  `jum_nilai` double NOT NULL,
  `ket_nilai` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `nilai`
--

INSERT INTO `nilai` (`id_nilai`, `jum_nilai`, `ket_nilai`) VALUES
(2, 9, 'Mutlak sangat penting dari'),
(3, 8, 'Mendekati mutlak dari'),
(8, 7, 'Sangat penting dari'),
(9, 6, 'Mendekati sangat penting dari'),
(10, 5, 'Lebih penting dari'),
(11, 4, 'Mendekati lebih penting dari'),
(12, 3, 'Sedikit lebih penting dari'),
(13, 2, 'Mendekati sedikit lebih penting dari'),
(14, 1, 'Sama penting dengan');

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id_pasien` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `umur` varchar(50) NOT NULL,
  `no_hp` varchar(100) NOT NULL,
  `jenis_hewan` ENUM('domba','kambing') NOT NULL;
  `alamat` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penyakit`
--

CREATE TABLE `penyakit` (
  `id_penyakit` int(11) NOT NULL,
  `kode_penyakit` varchar(10) NOT NULL,
  `deskripsi` text NOT NULL,
  `nama_penyakit` varchar(100) NOT NULL,
  `solusi` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyakit`
--

INSERT INTO `penyakit` (`id_penyakit`, `kode_penyakit`, `deskripsi`, `nama_penyakit`, `solusi`) VALUES
(1, 'P01', '', 'Diare', '− Berikan air minum yang bersih dan segar.\r\n− Berikan pakan yang mudah dicerna dan kaya\r\nserat.\r\n− Berikan obat antidiare yang diresepkan oleh\r\ndokter hewan'),
(2, 'P02', '', 'Cacar Mulut', '− Vaksinasi domba Anda secara rutin dengan\r\nvaksin cacar mulut.\r\n− Isolasi domba yang sakit dari domba yang\r\nsehat.\r\n− Bersihkan dan desinfeksi kandang dan\r\nperalatan yang terkontaminasi.'),
(3, 'P03', '', 'Tetanus', '− Vaksinasi domba Anda secara rutin dengan\r\nvaksin tetanus.\r\n− Bersihkan dan desinfeksi luka dengan benar.\r\n− Berikan antibiotik yang diresepkan oleh\r\ndokter hewan.'),
(4, 'P04', '', 'Radang Limpa', '− Berikan pakan yang berkualitas tinggi dan\r\nbergizi.\r\n− Hindari pemberian pakan yang berjamur atau\r\nberacun.\r\n− Berikan antibiotik yang diresepkan oleh\r\ndokter hewan.'),
(5, 'P05', '', 'Kudis', '− Berikan obat antiparasit yang diresepkan oleh\r\ndokter hewan.\r\n− Jaga kebersihan kandang dan peralatan.\r\n− Pisahkan domba yang sakit dari domba yang\r\nsehat'),
(6, 'P06', '', 'Dermatitis', '− Berikan obat antiparasit yang diresepkan oleh\r\ndokter hewan.\r\n− Jaga kebersihan kandang dan peralatan.\r\n− Hindari stres pada domba.');

-- --------------------------------------------------------

--
-- Table structure for table `rule`
--

CREATE TABLE `rule` (
  `id_rule` int(11) NOT NULL,
  `id_penyakit` int(11) NOT NULL,
  `id_gejala` int(11) NOT NULL,
  `cf_pakar` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rule`
--

INSERT INTO `rule` (`id_rule`, `id_penyakit`, `id_gejala`, `cf_pakar`) VALUES
(1, 1, 1, 0),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 2, 4, 0),
(5, 2, 5, 0),
(6, 3, 6, 0),
(7, 3, 7, 0),
(8, 4, 8, 0),
(9, 4, 9, 0),
(10, 4, 10, 0),
(11, 5, 11, 0),
(12, 5, 12, 0),
(13, 5, 13, 0),
(14, 6, 13, 0),
(15, 6, 14, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `analisa_krit`
--
ALTER TABLE `analisa_krit`
  ADD KEY `id_penyakit` (`id_penyakit`),
  ADD KEY `kriteria_x` (`kriteria_x`);
ALTER TABLE `analisa_krit` ADD FULLTEXT KEY `kriteria_x_2` (`kriteria_x`);
ALTER TABLE `analisa_krit` ADD FULLTEXT KEY `kriteria_x_3` (`kriteria_x`,`kriteria_y`);

--
-- Indexes for table `gejala`
--
ALTER TABLE `gejala`
  ADD PRIMARY KEY (`id_gejala`);

--
-- Indexes for table `hasil`
--
ALTER TABLE `hasil`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_pasien` (`id_pasien`);

--
-- Indexes for table `kondisi`
--
ALTER TABLE `kondisi`
  ADD PRIMARY KEY (`id_kondisi`);

--
-- Indexes for table `nilai`
--
ALTER TABLE `nilai`
  ADD PRIMARY KEY (`id_nilai`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id_pasien`);

--
-- Indexes for table `penyakit`
--
ALTER TABLE `penyakit`
  ADD PRIMARY KEY (`id_penyakit`);

--
-- Indexes for table `rule`
--
ALTER TABLE `rule`
  ADD PRIMARY KEY (`id_rule`),
  ADD KEY `id_penyakit` (`id_penyakit`),
  ADD KEY `id_gejala` (`id_gejala`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `gejala`
--
ALTER TABLE `gejala`
  MODIFY `id_gejala` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hasil`
--
ALTER TABLE `hasil`
  MODIFY `id_hasil` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kondisi`
--
ALTER TABLE `kondisi`
  MODIFY `id_kondisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nilai`
--
ALTER TABLE `nilai`
  MODIFY `id_nilai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id_pasien` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penyakit`
--
ALTER TABLE `penyakit`
  MODIFY `id_penyakit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rule`
--
ALTER TABLE `rule`
  MODIFY `id_rule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
