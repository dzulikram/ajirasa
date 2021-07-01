-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2020 at 12:46 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pinjam_ruang`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback_transaksi`
--

CREATE TABLE `feedback_transaksi` (
  `id` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `kritik` text NOT NULL,
  `saran` text NOT NULL,
  `lampiran_foto_1` text NOT NULL,
  `lampiran_foto_2` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_transaksi`
--

INSERT INTO `feedback_transaksi` (`id`, `id_transaksi`, `kritik`, `saran`, `lampiran_foto_1`, `lampiran_foto_2`, `created_at`, `updated_at`) VALUES
(1, 7, 'kurang', 'harus bersih', 'abbd279f2b5d84bf4e4c513409cc060b57db9477.jpg', 'abbd279f2b5d84bf4e4c513409cc060b57db9477.jpg', '2020-07-08 19:00:16', '2020-07-08 19:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ruangan`
--

CREATE TABLE `ruangan` (
  `id` int(11) NOT NULL,
  `kode_ruangan` varchar(200) NOT NULL,
  `nama_ruangan` varchar(300) NOT NULL,
  `status` enum('tersedia','dipinjam','','') NOT NULL,
  `foto_ruangan` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ruangan`
--

INSERT INTO `ruangan` (`id`, `kode_ruangan`, `nama_ruangan`, `status`, `foto_ruangan`, `created_at`, `updated_at`) VALUES
(4, 'R-01', 'Ruang 1', 'tersedia', '74ed1c0af2d8ced6d1b21e3eb13b0f86ab0ac0e6.jpeg', '2018-09-17 15:05:37', '2020-07-08 18:49:32'),
(7, 'R-03', 'Ruang 3', 'tersedia', 'ba0b90adfd060bb2cbcea9d2d1ca6bfb756930b3.jpg', '2020-07-08 11:04:46', '2020-07-08 11:04:58'),
(8, 'R-02', 'Ruang 2', 'tersedia', '344535eb69b8f3b0da4f00cd8f1ab7ff55be8e43.jpg', '2020-07-08 18:46:22', '2020-07-08 18:59:53');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_ruangan` int(11) NOT NULL,
  `tanggal_peminjaman` datetime NOT NULL,
  `tanggal_pengembalian` datetime NOT NULL,
  `deskripsi_kegiatan` text NOT NULL,
  `scan_lembar_persetujuan` text NOT NULL,
  `status` enum('pending','acc','tolak','selesai') NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `id_user`, `id_ruangan`, `tanggal_peminjaman`, `tanggal_pengembalian`, `deskripsi_kegiatan`, `scan_lembar_persetujuan`, `status`, `created_at`, `updated_at`) VALUES
(4, 7, 4, '2018-09-18 15:07:07', '2018-09-17 16:07:07', 'coba', '913c62f72e7c74afc600779e20d82a914b1b7740.jpg', 'selesai', '2018-09-17 15:07:37', '2018-09-17 15:15:38'),
(5, 7, 4, '2018-09-18 15:10:05', '2018-09-17 16:10:05', 'Rapat Besar', 'd644f5e8ab8afa887cccb93a7ad9471bbbaade8e.jpg', 'selesai', '2018-09-17 15:12:00', '2020-07-08 18:49:32'),
(6, 7, 7, '2018-09-18 21:47:48', '2018-09-19 21:47:48', 'tes', 'cebf9aef8019c3ae33576f2035d930c964ccfbd0.png', 'selesai', '2018-09-17 21:49:47', '2018-09-17 21:50:44'),
(7, 7, 8, '2020-06-04 10:58:44', '2020-06-04 12:58:44', 'rapat anggota', '43293ee25cb9c878ccf3a1e23c01d7d93466b681.jpg', 'selesai', '2020-06-03 10:59:32', '2020-07-08 18:59:53'),
(8, 8, 8, '2020-07-09 18:47:05', '2020-07-09 19:47:05', 'tes', '3224671172c281f2c7cc8dc100e28d0e50b3f6f3.jpg', 'acc', '2020-07-08 18:48:11', '2020-07-08 18:48:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `ttl` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nrp` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pegawai` int(11) NOT NULL,
  `bagian_majelis` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `remember_token`, `created_at`, `updated_at`, `ttl`, `nrp`, `alamat`, `no_telp`, `pegawai`, `bagian_majelis`) VALUES
(7, 'Pegawai', '11223344', NULL, '$2y$10$9uZT9O10jzYtowxTolGF6uvXSP2V34aEISnYoO19vVWmOdNJfTqtG', 'uPYBms46c2fWYLbI7pOqpx0nGNRtjTSK1IcQqcLkybmPwXcbwjaIH6rBYrog', '2018-09-17 08:02:25', '2018-09-17 08:02:25', '', '11223344', '', '087823179122', 0, 'Bagian Keuangan'),
(8, 'Admin', '1234', NULL, '$2y$10$8ioNYebPXsIlQIuQBwd17.00o54V..t7OaPHbB1Tw7FHU4m77w3Fa', 'GNg9lfPDI1yZP00PhLmPAR9vbSIxzpIt44v75TsBd80bPvFSVJNspZz9V6Fb', '2018-09-17 08:12:56', '2018-09-17 08:12:56', '', '1234', '', '087362613217', 1, NULL),
(9, 'Manajer', '4321', NULL, '$2y$10$A7KG64Lg8Viq8BwUz4dLLOuVbyD152GXjF6oyscs6/FZUz5c5h47C', '3YD0ONVFbHNFGHaBULvwAvs1VJQzlEO83mm0f2E9mCzzQB6msvQmkWo6nexO', '2020-07-08 04:15:56', '2020-07-08 04:15:56', '', '4321', '', '08123123123', 2, 'Manajer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback_transaksi`
--
ALTER TABLE `feedback_transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `ruangan`
--
ALTER TABLE `ruangan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback_transaksi`
--
ALTER TABLE `feedback_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ruangan`
--
ALTER TABLE `ruangan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
