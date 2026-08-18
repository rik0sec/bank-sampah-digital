-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 18, 2026 at 06:21 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bank_sampah`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `activity`, `description`, `ip_address`, `created_at`) VALUES
(4, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-03 16:21:36'),
(6, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-03 16:31:59'),
(13, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-03 17:25:21'),
(20, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-03 18:35:50'),
(30, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-05 05:53:55'),
(31, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-05 12:35:21'),
(33, 10, 'Update profil', 'Mengubah data diri', '127.0.0.1', '2026-07-05 13:17:04'),
(34, 10, 'Update profil', 'Mengubah data diri', '127.0.0.1', '2026-07-05 13:18:44'),
(35, 10, 'Update profil', 'Mengubah data diri', '127.0.0.1', '2026-07-05 13:26:03'),
(36, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-05 14:59:17'),
(40, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-05 15:55:55'),
(45, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-05 16:40:13'),
(49, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-05 16:55:33'),
(51, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-05 17:07:27'),
(54, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-06 01:33:55'),
(57, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-06 01:39:56'),
(58, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-06 03:04:56'),
(63, 10, 'Update profil', 'Mengubah data diri', '127.0.0.1', '2026-07-06 03:40:17'),
(66, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-12 12:09:17'),
(69, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-07-13 03:25:47'),
(70, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-08-18 14:46:46'),
(73, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-08-18 15:17:00'),
(75, 47, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-08-18 15:23:03'),
(76, 48, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-08-18 15:23:53'),
(77, 10, 'Login ke sistem', 'Login berhasil dari Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0', '127.0.0.1', '2026-08-18 15:32:30'),
(78, 10, 'Update profil', 'Mengubah data diri', '127.0.0.1', '2026-08-18 15:57:12');

-- --------------------------------------------------------

--
-- Table structure for table `detail_penyetoran`
--

CREATE TABLE `detail_penyetoran` (
  `id` int(11) NOT NULL,
  `penyetoran_id` int(11) NOT NULL,
  `jenis_sampah_id` int(11) NOT NULL,
  `berat` decimal(10,2) NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_penyetoran`
--

INSERT INTO `detail_penyetoran` (`id`, `penyetoran_id`, `jenis_sampah_id`, `berat`, `harga_per_kg`, `subtotal`) VALUES
(9, 5, 5, 1.50, 4000.00, 6000.00),
(15, 11, 4, 6.00, 2000.00, 12000.00),
(17, 13, 7, 23.00, 500.00, 11500.00),
(18, 14, 5, 20.00, 4000.00, 80000.00),
(19, 15, 7, 50.00, 500.00, 25000.00),
(20, 16, 5, 55.00, 4000.00, 220000.00),
(21, 17, 6, 25.00, 12000.00, 300000.00),
(22, 18, 2, 30.00, 1500.00, 45000.00),
(23, 19, 3, 40.00, 3500.00, 140000.00),
(24, 20, 6, 27.00, 12000.00, 324000.00),
(25, 21, 6, 25.00, 12000.00, 300000.00),
(26, 22, 1, 10.00, 2000.00, 20000.00),
(27, 23, 3, 30.00, 3500.00, 105000.00),
(28, 24, 1, 22.00, 2000.00, 44000.00),
(29, 25, 6, 50.00, 12000.00, 600000.00),
(30, 26, 3, 14.00, 3500.00, 49000.00),
(31, 27, 5, 15.00, 4000.00, 60000.00),
(32, 28, 2, 5.00, 1500.00, 7500.00);

-- --------------------------------------------------------

--
-- Table structure for table `harga_sampah`
--

CREATE TABLE `harga_sampah` (
  `id` int(11) NOT NULL,
  `jenis_sampah_id` int(11) NOT NULL,
  `harga_per_kg` decimal(10,2) NOT NULL,
  `berlaku_mulai` date NOT NULL,
  `berlaku_sampai` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `harga_sampah`
--

INSERT INTO `harga_sampah` (`id`, `jenis_sampah_id`, `harga_per_kg`, `berlaku_mulai`, `berlaku_sampai`, `created_at`, `updated_at`) VALUES
(1, 1, 2000.00, '2026-06-30', '2026-08-22', '2026-06-15 11:08:22', '2026-06-28 14:05:38'),
(2, 2, 1500.00, '2026-06-17', '2026-12-15', '2026-06-15 11:08:22', '2026-07-12 10:35:24'),
(3, 3, 3500.00, '2026-06-16', '2026-10-17', '2026-06-15 11:08:22', '2026-06-28 14:04:37'),
(4, 4, 2000.00, '2026-06-11', '2026-11-04', '2026-06-15 11:08:22', '2026-06-28 14:04:02'),
(5, 5, 4000.00, '2026-04-07', '2026-12-05', '2026-06-15 11:08:22', '2026-07-12 10:32:37'),
(6, 6, 12000.00, '2026-06-29', '2026-09-08', '2026-06-15 11:08:22', '2026-06-28 14:03:24'),
(7, 7, 500.00, '2026-06-29', '2026-12-21', '2026-06-15 11:08:22', '2026-06-30 00:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_sampah`
--

CREATE TABLE `jenis_sampah` (
  `id` int(11) NOT NULL,
  `kode_jenis` varchar(10) NOT NULL,
  `nama_jenis` varchar(100) NOT NULL,
  `kategori` enum('organik','anorganik','b3','elektronik','kertas','logam','plastik','kaca') NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jenis_sampah`
--

INSERT INTO `jenis_sampah` (`id`, `kode_jenis`, `nama_jenis`, `kategori`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'JS001', 'Kertas Koran', 'kertas', 'Kertas koran bekas dan sejenisnya', '2026-06-15 11:08:22', '2026-06-15 11:08:22'),
(2, 'JS002', 'Kardus', 'kertas', 'Kardus bekas semua jenis', '2026-06-15 11:08:22', '2026-06-15 11:08:22'),
(3, 'JS003', 'Botol Plastik', 'plastik', 'Botol plastik PET', '2026-06-15 11:08:22', '2026-06-15 11:08:22'),
(4, 'JS004', 'Gelas Plastik', 'plastik', 'Gelas plastik bekas', '2026-06-15 11:08:22', '2026-06-15 11:08:22'),
(5, 'JS005', 'Kabel bekas', 'elektronik', 'Kabel tembaga/listrik bekas', '2026-06-15 11:08:22', '2026-06-28 14:00:44'),
(6, 'JS006', 'Aluminium', 'logam', 'Kaleng aluminium bekas rel kereta \r\n', '2026-06-15 11:08:22', '2026-06-28 12:20:21'),
(7, 'JS007', 'Botol Kaca', 'kaca', 'Botol kaca bekas minuman/selai', '2026-06-15 11:08:22', '2026-06-28 14:01:02');

-- --------------------------------------------------------

--
-- Table structure for table `nasabah`
--

CREATE TABLE `nasabah` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `kode_nasabah` varchar(20) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `saldo` decimal(15,2) DEFAULT 0.00,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nasabah`
--

INSERT INTO `nasabah` (`id`, `user_id`, `kode_nasabah`, `nama`, `alamat`, `no_telp`, `email`, `saldo`, `created_at`, `updated_at`) VALUES
(5, NULL, 'NB-015', 'Zahra Alifia Maharani', 'jl.sribasuki 11', '0878985245', 'zahra@gmail.com', 161000.00, '2026-06-26 07:54:18', '2026-06-29 12:09:09'),
(6, NULL, 'NB-016', 'Maura azka', 'jl. rambutan salak No1', '0895728783', 'maura@gmail.com', 346950.00, '2026-06-26 07:55:58', '2026-06-29 12:21:59'),
(13, NULL, 'NSB-024', 'Yulinda Angelia', 'jl .penatih tuho, Kotabumi Tengah', '08978374537', 'angel@gmail.com', 624500.00, '2026-06-28 12:46:28', '2026-07-05 21:38:58'),
(14, NULL, 'NSB-025', 'davina karamoy', 'jl . wiijaya kusuma, Sribasuki, Kotabumi, Lampung Utara', '0897988731', 'davina@gmail.com', 537500.00, '2026-06-28 17:14:21', '2026-07-12 10:30:55'),
(18, NULL, 'NSB-030', 'Jefri Nickol', 'jl. bekasi timur raya\r\n', '08382744245', 'jefrinic@gmail.com', 105000.00, '2026-07-03 12:05:51', '2026-07-03 14:13:04'),
(25, NULL, 'NSB-036', 'firman saputra', 'jl. sribasuki', '0898438594', 'firman@gmail.com', 600000.00, '2026-07-05 12:52:49', '2026-07-05 12:56:33'),
(33, NULL, 'NSB-037', 'nasabah1', NULL, NULL, NULL, 0.00, '2026-08-18 15:20:35', '2026-08-18 15:20:35'),
(34, 48, 'NSB-038', 'nasabah', NULL, NULL, NULL, 0.00, '2026-08-18 15:23:40', '2026-08-18 15:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_setoran`
--

CREATE TABLE `pengajuan_setoran` (
  `id` int(11) NOT NULL,
  `nasabah_id` int(11) DEFAULT NULL,
  `jenis_sampah_id` int(11) DEFAULT NULL,
  `berat` decimal(10,2) DEFAULT NULL,
  `harga_per_kg` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  `status` enum('pending','disetujui','ditolak') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan_setoran`
--

INSERT INTO `pengajuan_setoran` (`id`, `nasabah_id`, `jenis_sampah_id`, `berat`, `harga_per_kg`, `subtotal`, `status`, `created_at`) VALUES
(2, 5, 5, 1.50, 4000.00, 6000.00, 'disetujui', '2026-06-26 10:19:40'),
(4, 6, 3, 4.50, 3500.00, 15750.00, 'disetujui', '2026-06-26 11:26:39'),
(5, 8, 5, 4.00, 4000.00, 16000.00, 'ditolak', '2026-06-26 12:32:02'),
(6, 9, 3, 2.35, 3500.00, 8225.00, 'disetujui', '2026-06-26 12:38:28'),
(7, 5, 1, 4.45, 2000.00, 8900.00, 'ditolak', '2026-06-26 12:41:46'),
(8, 6, 7, 2.40, 500.00, 1200.00, 'disetujui', '2026-06-26 12:43:37'),
(9, 6, 4, 1.01, 2000.00, 2020.00, 'ditolak', '2026-06-26 13:39:26'),
(10, 5, 1, 1.50, 2000.00, 3000.00, 'disetujui', '2026-06-28 10:12:14'),
(11, 6, 1, 3.00, 2000.00, 6000.00, 'disetujui', '2026-06-28 11:25:27'),
(12, 5, 4, 6.00, 2000.00, 12000.00, 'disetujui', '2026-06-28 16:15:38'),
(13, 10, 2, 10.00, 1500.00, 15000.00, 'disetujui', '2026-06-28 16:25:38'),
(14, 13, 7, 23.00, 500.00, 11500.00, 'disetujui', '2026-06-28 17:08:12'),
(15, 14, 5, 20.00, 4000.00, 80000.00, 'disetujui', '2026-06-28 17:34:49'),
(16, 14, 7, 50.00, 500.00, 25000.00, 'disetujui', '2026-06-28 18:29:58'),
(17, 13, 5, 55.00, 4000.00, 220000.00, 'disetujui', '2026-06-28 18:32:03'),
(18, 13, 6, 25.00, 12000.00, 300000.00, 'disetujui', '2026-06-29 15:40:32'),
(19, 14, 2, 30.00, 1500.00, 45000.00, 'disetujui', '2026-06-29 16:05:49'),
(20, 5, 3, 40.00, 3500.00, 140000.00, 'disetujui', '2026-06-29 16:08:09'),
(21, 5, 2, 10.00, 1500.00, 15000.00, 'ditolak', '2026-06-29 16:08:26'),
(22, 6, 6, 27.00, 12000.00, 324000.00, 'disetujui', '2026-06-29 16:21:36'),
(23, 14, 2, 25.00, 1500.00, 37500.00, 'ditolak', '2026-06-29 17:41:49'),
(24, 14, 6, 25.00, 12000.00, 300000.00, 'disetujui', '2026-07-03 15:28:48'),
(25, 14, 1, 10.00, 2000.00, 20000.00, 'disetujui', '2026-07-03 16:01:01'),
(26, 18, 3, 30.00, 3500.00, 105000.00, 'disetujui', '2026-07-03 16:07:20'),
(27, 13, 1, 22.00, 2000.00, 44000.00, 'disetujui', '2026-07-03 18:44:34'),
(28, 25, 6, 50.00, 12000.00, 600000.00, 'disetujui', '2026-07-05 16:53:46'),
(29, 13, 3, 14.00, 3500.00, 49000.00, 'disetujui', '2026-07-06 01:37:17'),
(30, 14, 5, 15.00, 4000.00, 60000.00, 'disetujui', '2026-07-12 13:53:53'),
(31, 14, 2, 5.00, 1500.00, 7500.00, 'disetujui', '2026-07-12 14:04:39'),
(32, 14, 2, 2.00, 1500.00, 3000.00, 'pending', '2026-07-12 14:30:36');

-- --------------------------------------------------------

--
-- Table structure for table `penyetoran`
--

CREATE TABLE `penyetoran` (
  `id` int(11) NOT NULL,
  `kode_transaksi` varchar(30) NOT NULL,
  `nasabah_id` int(11) NOT NULL,
  `petugas_id` int(11) DEFAULT NULL,
  `tanggal` date NOT NULL,
  `total_berat` decimal(10,2) DEFAULT 0.00,
  `total_harga` decimal(15,2) DEFAULT 0.00,
  `status` enum('pending','disetujui','ditolak') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penyetoran`
--

INSERT INTO `penyetoran` (`id`, `kode_transaksi`, `nasabah_id`, `petugas_id`, `tanggal`, `total_berat`, `total_harga`, `status`, `created_at`, `updated_at`) VALUES
(5, 'STR20260626142012', 5, NULL, '2026-06-26', 1.50, 6000.00, 'disetujui', '2026-06-26 10:20:12', '2026-06-28 11:15:24'),
(11, 'STR20260628161613', 5, NULL, '2026-06-28', 6.00, 12000.00, 'disetujui', '2026-06-28 12:16:13', '2026-06-28 12:19:34'),
(13, 'STR20260628171038', 13, NULL, '2026-06-28', 23.00, 11500.00, 'disetujui', '2026-06-28 13:10:38', '2026-06-28 13:10:38'),
(14, 'STR20260628173508', 14, NULL, '2026-06-28', 20.00, 80000.00, 'disetujui', '2026-06-28 13:35:08', '2026-06-28 13:35:08'),
(15, 'STR20260628183057', 14, NULL, '2026-06-28', 50.00, 25000.00, 'disetujui', '2026-06-28 14:30:57', '2026-06-28 14:30:57'),
(16, 'STR20260628183230', 13, NULL, '2026-06-28', 55.00, 220000.00, 'disetujui', '2026-06-28 14:32:30', '2026-06-28 14:32:30'),
(17, 'STR20260629154208', 13, NULL, '2026-06-29', 25.00, 300000.00, 'disetujui', '2026-06-29 11:42:08', '2026-06-29 11:42:08'),
(18, 'STR20260629160702', 14, 10, '2026-06-29', 30.00, 45000.00, 'disetujui', '2026-06-29 12:07:02', '2026-06-29 13:39:20'),
(19, 'STR20260629160909', 5, NULL, '2026-06-29', 40.00, 140000.00, 'disetujui', '2026-06-29 12:09:09', '2026-06-29 12:09:09'),
(20, 'STR20260629162159', 6, 10, '2026-06-29', 27.00, 324000.00, 'disetujui', '2026-06-29 12:21:59', '2026-06-29 13:29:36'),
(21, 'STR20260703152926', 14, NULL, '2026-07-03', 25.00, 300000.00, 'disetujui', '2026-07-03 11:29:26', '2026-07-03 11:29:26'),
(22, 'STR20260703160127', 14, NULL, '2026-07-03', 10.00, 20000.00, 'disetujui', '2026-07-03 12:01:27', '2026-07-03 12:01:27'),
(23, 'STR20260703160755', 18, NULL, '2026-07-03', 30.00, 105000.00, 'disetujui', '2026-07-03 12:07:55', '2026-07-03 12:07:55'),
(24, 'STR20260703184452', 13, NULL, '2026-07-03', 22.00, 44000.00, 'disetujui', '2026-07-03 14:44:52', '2026-07-03 14:44:52'),
(25, 'STR20260705165418', 25, 10, '2026-07-05', 50.00, 600000.00, 'disetujui', '2026-07-05 12:54:18', '2026-07-05 21:35:59'),
(26, 'STR20260706013858', 13, 10, '2026-07-06', 14.00, 49000.00, 'disetujui', '2026-07-05 21:38:58', '2026-07-12 09:22:31'),
(27, 'STR20260712135401', 14, NULL, '2026-07-12', 15.00, 60000.00, 'disetujui', '2026-07-12 09:54:01', '2026-07-12 09:54:01'),
(28, 'STR20260712143055', 14, NULL, '2026-07-12', 5.00, 7500.00, 'disetujui', '2026-07-12 10:30:55', '2026-07-12 10:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `role` enum('admin','petugas','nasabah') NOT NULL DEFAULT 'nasabah',
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires` datetime DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `last_device` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `nama_lengkap`, `email`, `no_telp`, `alamat`, `role`, `is_verified`, `otp_code`, `otp_expires`, `foto`, `created_at`, `updated_at`, `last_login`, `last_device`) VALUES
(10, 'admin_demo', '$2y$10$BuhaMl7hcn/PyKwdPvZwnevlx1Mhfv93cmM9sSHkYbPr.NK3yfB92', 'admin_demo', 'admindemo@gmail.com', '08932449', 'Jl. Paris Van Java', 'admin', 1, NULL, NULL, NULL, '2026-06-24 15:55:11', '2026-08-18 11:57:12', '2026-08-18 11:32:30', 'Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0'),
(46, 'admin', '$2y$10$XmSobJdr4bauy2SH3Jk3l.YDuSYXlE86E1kbvL0MNsNPP311d2Akq', 'admin ', NULL, NULL, NULL, 'admin', 1, NULL, NULL, NULL, '2026-08-18 11:21:05', '2026-08-18 11:21:05', NULL, NULL),
(47, 'petugas', '$2y$10$em3BSsIbJAxGk62kco5IDuQqyN2jCJPz0hF8UrGQ9XcROT.ZPEMQe', 'petugas', NULL, NULL, NULL, 'petugas', 1, NULL, NULL, NULL, '2026-08-18 11:22:32', '2026-08-18 11:23:03', '2026-08-18 11:23:03', 'Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0'),
(48, 'nasabah', '$2y$10$KtpA8mdGzWtK3wxBhcTqtuM7EZ6LMFfNRa6L6xT1cOQf7QQhimgFm', 'nasabah', NULL, NULL, NULL, 'nasabah', 1, NULL, NULL, NULL, '2026-08-18 11:23:40', '2026-08-18 11:23:53', '2026-08-18 11:23:53', 'Mozilla/5.0 (X11; Linux x86_64; rv:140.0) Gecko/20100101 Firefox/140.0');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `detail_penyetoran`
--
ALTER TABLE `detail_penyetoran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penyetoran_id` (`penyetoran_id`),
  ADD KEY `jenis_sampah_id` (`jenis_sampah_id`);

--
-- Indexes for table `harga_sampah`
--
ALTER TABLE `harga_sampah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jenis_sampah_id` (`jenis_sampah_id`);

--
-- Indexes for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_jenis` (`kode_jenis`);

--
-- Indexes for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_nasabah` (`kode_nasabah`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `pengajuan_setoran`
--
ALTER TABLE `pengajuan_setoran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penyetoran`
--
ALTER TABLE `penyetoran`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_transaksi` (`kode_transaksi`),
  ADD KEY `nasabah_id` (`nasabah_id`),
  ADD KEY `petugas_id` (`petugas_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `detail_penyetoran`
--
ALTER TABLE `detail_penyetoran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `harga_sampah`
--
ALTER TABLE `harga_sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jenis_sampah`
--
ALTER TABLE `jenis_sampah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `nasabah`
--
ALTER TABLE `nasabah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `pengajuan_setoran`
--
ALTER TABLE `pengajuan_setoran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `penyetoran`
--
ALTER TABLE `penyetoran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD CONSTRAINT `fk_activity_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `detail_penyetoran`
--
ALTER TABLE `detail_penyetoran`
  ADD CONSTRAINT `detail_penyetoran_ibfk_1` FOREIGN KEY (`penyetoran_id`) REFERENCES `penyetoran` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detail_penyetoran_ibfk_2` FOREIGN KEY (`jenis_sampah_id`) REFERENCES `jenis_sampah` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `harga_sampah`
--
ALTER TABLE `harga_sampah`
  ADD CONSTRAINT `harga_sampah_ibfk_1` FOREIGN KEY (`jenis_sampah_id`) REFERENCES `jenis_sampah` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `nasabah`
--
ALTER TABLE `nasabah`
  ADD CONSTRAINT `nasabah_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `penyetoran`
--
ALTER TABLE `penyetoran`
  ADD CONSTRAINT `penyetoran_ibfk_1` FOREIGN KEY (`nasabah_id`) REFERENCES `nasabah` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `penyetoran_ibfk_2` FOREIGN KEY (`petugas_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
