-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2024 at 01:05 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `yoladigital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp_admin` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `nama_admin`, `email`, `no_telp_admin`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Yola', 'admin@yoladigital.com', 81572848300, '$2y$10$fMm1HOJDjaVW.1Ev.nEI/u9ylgl.ZtEZuiZFECI8fQmqm5Mao3w3W', '2024-01-03 22:45:48', '2024-01-03 22:45:48');

-- --------------------------------------------------------

--
-- Table structure for table `data_perusahaan`
--

CREATE TABLE `data_perusahaan` (
  `id` int(11) NOT NULL,
  `nama_perusahaan` varchar(255) NOT NULL,
  `deskripsi_perusahaan` longtext NOT NULL,
  `email_perusahaan` varchar(255) NOT NULL,
  `no_telp_perusahaan` varchar(255) NOT NULL,
  `alamat_perusahaan` varchar(255) NOT NULL,
  `logo_perusahaan` varchar(255) NOT NULL,
  `logo_perusahaan_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `gaji`
--

CREATE TABLE `gaji` (
  `id_gaji` varchar(12) NOT NULL,
  `pekerja_id` varchar(4) NOT NULL,
  `proyek_id` varchar(8) NOT NULL,
  `jumlah_gaji` bigint(20) NOT NULL,
  `status_gaji` enum('Belum Dibayarkan','Sudah Dibayar') NOT NULL,
  `bukti_gaji` varchar(255) NOT NULL,
  `bukti_gaji_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `klien`
--

CREATE TABLE `klien` (
  `id_klien` varchar(6) NOT NULL,
  `nama_klien` varchar(255) NOT NULL,
  `email_klien` varchar(255) NOT NULL,
  `no_telp_klien` bigint(20) NOT NULL,
  `alamat_klien` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klien`
--

INSERT INTO `klien` (`id_klien`, `nama_klien`, `email_klien`, `no_telp_klien`, `alamat_klien`, `created_at`, `updated_at`) VALUES
('404', 'Klien Dihapus', 'kliendihapus@yoladigital.com', 1111111, 'Klien Dihapus', '2024-01-04 23:43:47', '2024-01-04 23:43:47'),
('iDThqo', 'Gampang', 'gampang@saksake.com', 1231231, 'Magelang Kota', '2024-01-05 01:55:49', '2024-01-05 01:55:49');

-- --------------------------------------------------------

--
-- Table structure for table `layanan`
--

CREATE TABLE `layanan` (
  `id_layanan` varchar(3) NOT NULL,
  `nama_layanan` varchar(255) NOT NULL,
  `keterangan_layanan` longtext NOT NULL,
  `foto_layanan` varchar(255) NOT NULL,
  `foto_layanan_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `layanan`
--

INSERT INTO `layanan` (`id_layanan`, `nama_layanan`, `keterangan_layanan`, `foto_layanan`, `foto_layanan_path`, `created_at`, `updated_at`) VALUES
('404', 'Layanan Dihapus', 'Layanan Dihapus', 'Layanan Dihapus', 'Layanan Dihapus', '2024-01-04 23:44:36', '2024-01-04 23:44:36'),
('eDV', 'Fotografi Photoboth', 'Fotografi Jalan', '1704417774.png', 'C:\\xampp\\htdocs\\yoladigital\\public\\uploads/layanan/1704417774.png', '2024-01-05 01:21:35', '2024-01-05 01:22:54'),
('GNd', 'Editing Video After Premiere', 'Editing Video After Premiere dengan aplikasi after Premiere', '1704418327.png', 'C:\\xampp\\htdocs\\yoladigital\\public\\uploads/layanan/1704418327.png', '2024-01-05 01:30:37', '2024-01-05 01:32:07'),
('We4', 'Editing Audio', 'Editing Audio dengan Winamp', '1704419687.png', 'C:\\xampp\\htdocs\\yoladigital\\public\\uploads/layanan/1704419687.png', '2024-01-05 01:52:48', '2024-01-05 01:54:47');

-- --------------------------------------------------------

--
-- Table structure for table `pekerja`
--

CREATE TABLE `pekerja` (
  `id_pekerja` varchar(4) NOT NULL,
  `nama_pekerja` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp_pekerja` bigint(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pekerja`
--

INSERT INTO `pekerja` (`id_pekerja`, `nama_pekerja`, `email`, `no_telp_pekerja`, `password`, `created_at`, `updated_at`) VALUES
('404', 'Pekerja Dihapus', 'pekerjadihapus@yoladigital.com', 222222222, '$2a$12$c1aQaR7oU9vPWzVjLcGfve0mCqXmkx5AUv.tOGbSHHkXQwPNvqoe2', '2024-01-04 23:45:40', '2024-01-04 23:45:40'),
('cMX4', 'Kerja', 'kerja@yoladigital.com', 12313213, '$2y$10$.EEnr8qxhebHt.FYgv24ienuqAKDjFf9rrMdCH/bVPQCDN2L.O4wi', '2024-01-04 07:07:50', '2024-01-04 07:07:50'),
('LQqw', 'Pemas', 'pemas@gmail.com', 123213123, '$2y$10$NU22vNxK7LYDAskn4h3JfO2Zsd/Ij6PB50d5GVpY1Pc7k.ZJYpo..', '2024-01-04 01:54:43', '2024-01-04 08:02:45'),
('mc6n', 'Rivan', 'rivan@gmail.com', 92112389, '$2y$10$M2RBm9EkyzV64d7e5EB.rezIVhnze8UZ4eMLcn/FirRbfxk0YXWbG', '2024-01-05 01:33:18', '2024-01-05 01:33:18'),
('U2is', 'Gatotkaca', 'a@gmail.com', 123123123, '$2y$10$wA39VDEMsOW3Z.TozyncR.0ZTKlZKxA7U6Bp4fcWC.Q4wU3Ne.0Sm', '2024-01-04 09:50:38', '2024-01-04 09:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `pemasukkan`
--

CREATE TABLE `pemasukkan` (
  `id_pemasukkan` int(11) NOT NULL,
  `proyek_id` varchar(8) NOT NULL,
  `penyewaan_id` varchar(7) NOT NULL,
  `keterangan_pemasukkan` longtext NOT NULL,
  `bukti_pemasukkan` varchar(255) NOT NULL,
  `bukti_pemasukkan_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemasukkan`
--

INSERT INTO `pemasukkan` (`id_pemasukkan`, `proyek_id`, `penyewaan_id`, `keterangan_pemasukkan`, `bukti_pemasukkan`, `bukti_pemasukkan_path`, `created_at`, `updated_at`) VALUES
(5, 'fr1o1npL', '404', 'asasdasd', '1704412491.jpg', 'C:\\xampp\\htdocs\\yoladigital\\public\\uploads/pemasukkan/1704412491.jpg', '2024-01-04 23:54:51', '2024-01-04 23:54:51'),
(6, 'c17lgcbA', '404', 'Lunas', '1704419850.png', 'C:\\xampp\\htdocs\\yoladigital\\public\\uploads/pemasukkan/1704419850.png', '2024-01-05 01:57:30', '2024-01-05 01:57:30');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `proyek_id` varchar(8) NOT NULL,
  `nama_pengeluaran` varchar(255) NOT NULL,
  `keterangan_pengeluaran` longtext NOT NULL,
  `jumlah_pengeluaran` bigint(20) NOT NULL,
  `bukti_pengeluaran` varchar(255) NOT NULL,
  `bukti_pengeluaran_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `penyewaan`
--

CREATE TABLE `penyewaan` (
  `id_penyewaan` varchar(7) NOT NULL,
  `klien_id` varchar(6) NOT NULL,
  `harga_penyewaan` bigint(20) NOT NULL,
  `ket_tambahan` longtext DEFAULT NULL,
  `status_penyewaan` enum('Disewa','Dikembalikan') NOT NULL,
  `bukti_penyewaan` varchar(255) NOT NULL,
  `bukti_penyewaan_path` varchar(255) NOT NULL,
  `bukti_pengembalian` varchar(255) NOT NULL,
  `bukti_pengembalian_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `penyewaan`
--

INSERT INTO `penyewaan` (`id_penyewaan`, `klien_id`, `harga_penyewaan`, `ket_tambahan`, `status_penyewaan`, `bukti_penyewaan`, `bukti_penyewaan_path`, `bukti_pengembalian`, `bukti_pengembalian_path`, `created_at`, `updated_at`) VALUES
('404', '404', 0, NULL, 'Dikembalikan', 'Penyewaan Dihapus', 'Penyewaan Dihapus', 'Penyewaan Dihapus', 'Penyewaan Dihapus', '2024-01-04 23:46:33', '2024-01-04 23:46:33');

-- --------------------------------------------------------

--
-- Table structure for table `proyek`
--

CREATE TABLE `proyek` (
  `id_proyek` varchar(8) NOT NULL,
  `layanan_id` varchar(3) NOT NULL,
  `klien_id` varchar(6) NOT NULL,
  `pekerja_id` varchar(4) NOT NULL,
  `harga_proyek` bigint(20) NOT NULL,
  `ket_tambahan` longtext DEFAULT NULL,
  `status_proyek` enum('Diproses','Proses Verifikasi','Revisi','Selesai') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `proyek`
--

INSERT INTO `proyek` (`id_proyek`, `layanan_id`, `klien_id`, `pekerja_id`, `harga_proyek`, `ket_tambahan`, `status_proyek`, `created_at`, `updated_at`) VALUES
('404', '404', '404', '404', 0, 'Proyek Dihapus', 'Selesai', '2024-01-04 23:47:05', '2024-01-04 23:47:05'),
('9KR1Nbob', '404', '404', 'LQqw', 12313, NULL, 'Revisi', '2024-01-04 23:36:00', '2024-01-05 01:55:33'),
('A5ZzhCGs', '404', '404', 'LQqw', 21222, NULL, 'Diproses', '2024-01-04 23:34:50', '2024-01-05 01:55:33'),
('Bkn5o3GX', '404', '404', 'LQqw', 21222, NULL, 'Diproses', '2024-01-04 23:35:23', '2024-01-05 01:55:33'),
('c17lgcbA', 'We4', 'iDThqo', 'LQqw', 100000, NULL, 'Diproses', '2024-01-05 01:57:30', '2024-01-05 01:57:30'),
('FPN7wwqL', '404', '404', 'LQqw', 12313, NULL, 'Diproses', '2024-01-04 23:36:28', '2024-01-05 01:55:33'),
('fr1o1npL', '404', '404', 'LQqw', 22222, NULL, 'Diproses', '2024-01-04 23:54:51', '2024-01-05 01:55:33'),
('jgY7DcPV', '404', '404', 'LQqw', 21222, NULL, 'Diproses', '2024-01-04 23:34:15', '2024-01-05 01:55:33'),
('QhQK5Srb', '404', '404', 'LQqw', 12313, NULL, 'Diproses', '2024-01-04 23:40:48', '2024-01-05 01:55:33'),
('VB5RWvkX', '404', '404', 'LQqw', 12313, NULL, 'Diproses', '2024-01-04 23:37:34', '2024-01-05 01:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `proyek_update`
--

CREATE TABLE `proyek_update` (
  `id_update` varchar(10) NOT NULL,
  `proyek_id` varchar(8) NOT NULL,
  `keterangan_update` longtext NOT NULL,
  `bukti_update` varchar(255) NOT NULL,
  `bukti_update_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gaji`
--
ALTER TABLE `gaji`
  ADD PRIMARY KEY (`id_gaji`),
  ADD KEY `pekerja_id` (`pekerja_id`),
  ADD KEY `proyek_id` (`proyek_id`);

--
-- Indexes for table `klien`
--
ALTER TABLE `klien`
  ADD PRIMARY KEY (`id_klien`);

--
-- Indexes for table `layanan`
--
ALTER TABLE `layanan`
  ADD PRIMARY KEY (`id_layanan`);

--
-- Indexes for table `pekerja`
--
ALTER TABLE `pekerja`
  ADD PRIMARY KEY (`id_pekerja`);

--
-- Indexes for table `pemasukkan`
--
ALTER TABLE `pemasukkan`
  ADD PRIMARY KEY (`id_pemasukkan`),
  ADD KEY `proyek_id` (`proyek_id`),
  ADD KEY `penyewaan_id` (`penyewaan_id`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `proyek_id` (`proyek_id`);

--
-- Indexes for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD PRIMARY KEY (`id_penyewaan`),
  ADD KEY `klien_id` (`klien_id`);

--
-- Indexes for table `proyek`
--
ALTER TABLE `proyek`
  ADD PRIMARY KEY (`id_proyek`),
  ADD KEY `layanan_id` (`layanan_id`),
  ADD KEY `klien_id` (`klien_id`),
  ADD KEY `pekerja_id` (`pekerja_id`);

--
-- Indexes for table `proyek_update`
--
ALTER TABLE `proyek_update`
  ADD PRIMARY KEY (`id_update`),
  ADD KEY `proyek_id` (`proyek_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pemasukkan`
--
ALTER TABLE `pemasukkan`
  MODIFY `id_pemasukkan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gaji`
--
ALTER TABLE `gaji`
  ADD CONSTRAINT `gaji_ibfk_1` FOREIGN KEY (`pekerja_id`) REFERENCES `pekerja` (`id_pekerja`),
  ADD CONSTRAINT `gaji_ibfk_2` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id_proyek`);

--
-- Constraints for table `pemasukkan`
--
ALTER TABLE `pemasukkan`
  ADD CONSTRAINT `pemasukkan_ibfk_1` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id_proyek`),
  ADD CONSTRAINT `pemasukkan_ibfk_2` FOREIGN KEY (`penyewaan_id`) REFERENCES `penyewaan` (`id_penyewaan`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id_proyek`);

--
-- Constraints for table `penyewaan`
--
ALTER TABLE `penyewaan`
  ADD CONSTRAINT `penyewaan_ibfk_1` FOREIGN KEY (`klien_id`) REFERENCES `klien` (`id_klien`);

--
-- Constraints for table `proyek`
--
ALTER TABLE `proyek`
  ADD CONSTRAINT `proyek_ibfk_1` FOREIGN KEY (`layanan_id`) REFERENCES `layanan` (`id_layanan`),
  ADD CONSTRAINT `proyek_ibfk_2` FOREIGN KEY (`klien_id`) REFERENCES `klien` (`id_klien`),
  ADD CONSTRAINT `proyek_ibfk_3` FOREIGN KEY (`pekerja_id`) REFERENCES `pekerja` (`id_pekerja`);

--
-- Constraints for table `proyek_update`
--
ALTER TABLE `proyek_update`
  ADD CONSTRAINT `proyek_update_ibfk_1` FOREIGN KEY (`proyek_id`) REFERENCES `proyek` (`id_proyek`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
