-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2023 at 06:17 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arsip`
--

-- --------------------------------------------------------

--
-- Table structure for table `file_letter`
--

CREATE TABLE `file_letter` (
  `id` int(11) NOT NULL,
  `latter_id` int(11) NOT NULL,
  `document` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `instrukturs`
--

CREATE TABLE `instrukturs` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(191) NOT NULL,
  `tempat_lahir` varchar(191) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `sex` varchar(24) NOT NULL,
  `bidang_keahlian` varchar(32) NOT NULL,
  `nomor_sk` varchar(32) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `instrukturs`
--

INSERT INTO `instrukturs` (`id`, `nama_lengkap`, `tempat_lahir`, `tanggal_lahir`, `sex`, `bidang_keahlian`, `nomor_sk`, `status`) VALUES
(2, 'Aditya S.Kom', 'Deli Serdang', '2001-11-07', 'laki-laki', 'TKJ', '001/SK/ML/2019', 1);

-- --------------------------------------------------------

--
-- Table structure for table `letters`
--

CREATE TABLE `letters` (
  `id` int(11) NOT NULL,
  `slack` varchar(32) NOT NULL,
  `no_agenda` varchar(32) NOT NULL,
  `pengirim` varchar(191) NOT NULL,
  `notes` text NOT NULL,
  `no_surat` varchar(32) NOT NULL,
  `tgl_surat` datetime NOT NULL,
  `tgl_dikirim` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(5) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT 0,
  `type` varchar(32) NOT NULL,
  `menu_key` varchar(32) NOT NULL,
  `label` varchar(199) NOT NULL,
  `route` varchar(199) DEFAULT NULL,
  `icon` varchar(199) DEFAULT NULL,
  `short_order` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `type`, `menu_key`, `label`, `route`, `icon`, `short_order`, `status`, `created_at`, `updated_at`) VALUES
(1, 0, 'MAIN_MENU', 'DASHBOARDS', 'Dashboards', 'dashboard', 'fas fa-tachometer-alt', 1, 1, '2022-12-06 05:42:08', '2023-01-25 21:10:28'),
(6, 0, 'MAIN_MENU', 'MASTER_DATA', 'Master Data', 'sistem', 'fa fa-folder', 3, 1, '2022-12-06 13:34:12', '2023-01-26 03:52:16'),
(11, 6, 'SUB_MENU', 'MENU', 'Menu', 'data-menu', 'fas fa-bars', 1, 1, '2022-12-09 07:06:37', '2023-01-26 04:03:22'),
(93, 6, 'SUB_MENU', 'USER', 'User', 'data-user', 'fa fa-users', 7, 1, '2022-12-27 19:53:20', '2023-01-26 04:00:58'),
(112, 6, 'SUB_MENU', 'DATA_SISWA', 'Data Siswa', 'data-siswa', 'fas fa-user-graduate', 2, 1, '2023-01-01 01:13:18', '2023-01-26 04:07:08'),
(116, 0, 'MAIN_MENU', 'SETING_MENU', 'Seting Menu', 'role-menu', 'fa fa-cog', 4, 1, '2023-01-02 01:47:52', '2023-01-25 21:01:50'),
(117, 6, 'SUB_MENU', 'ROLE', 'Role', 'data-role', 'fas fa-user-check', 8, 1, '2023-01-02 01:56:54', '2023-01-26 04:08:41'),
(120, 0, 'MAIN_MENU', 'DATA_SURAT', 'Data Surat', 'data-surat', 'fas fa-mail-bulk', 2, 1, '2023-01-26 03:51:49', '2023-01-26 03:51:49'),
(121, 120, 'SUB_MENU', 'SURAT_MASUK', 'Surat Masuk', 'surat-masuk', 'fas fa-envelope', 1, 1, '2023-01-26 03:54:22', '2023-01-26 04:00:24'),
(122, 120, 'SUB_MENU', 'SURAT_KELUAR', 'Surat Keluar', 'surat-keluar', 'fas fa-envelope-open-text', 2, 1, '2023-01-26 03:55:51', '2023-01-26 03:58:49'),
(123, 6, 'SUB_MENU', 'DATA_INSTRUKTUR', 'Data Instruktur', 'data-instruktur', 'fas fa-user-tie', 3, 1, '2023-01-26 20:37:12', '2023-01-26 20:37:14');

-- --------------------------------------------------------

--
-- Table structure for table `menu_role`
--

CREATE TABLE `menu_role` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_role`
--

INSERT INTO `menu_role` (`id`, `role_id`, `menu_id`) VALUES
(111, 1, 94),
(112, 1, 113),
(113, 1, 114),
(116, 1, 1),
(117, 1, 6),
(118, 1, 11),
(119, 1, 115),
(120, 1, 116),
(121, 1, 119),
(122, 1, 112),
(123, 1, 3),
(124, 1, 5),
(125, 1, 102),
(126, 1, 111),
(127, 1, 93),
(128, 1, 117),
(129, 3, 1),
(130, 3, 94),
(131, 3, 113),
(132, 3, 114),
(133, 3, 6),
(135, 3, 112),
(136, 3, 3),
(137, 3, 5),
(138, 3, 102),
(139, 3, 111),
(140, 3, 119),
(141, 4, 1),
(142, 4, 119),
(143, 1, 120),
(144, 1, 121),
(145, 1, 122),
(146, 1, 123),
(147, 3, 123),
(148, 3, 93),
(149, 3, 120),
(150, 3, 121),
(151, 3, 122);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `slack` varchar(191) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `slack`, `role`) VALUES
(1, 'HpWeYcIxjz9hlbg', 'Super Admin'),
(3, 'PupeQHRX8d2eTWP', 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `nama_siswa` varchar(191) NOT NULL,
  `agama` varchar(24) NOT NULL,
  `alamat` text NOT NULL,
  `tempat_lahir` varchar(191) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `sex` varchar(24) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `nama_siswa`, `agama`, `alamat`, `tempat_lahir`, `tanggal_lahir`, `sex`, `status`, `created_at`) VALUES
(1, 'Siswa 1', 'islam', 'Ini tes input siswa 1', 'tes input', '2023-01-02', 'perempuan', 1, '2023-01-02'),
(4, 'tes', 'islam', 'tes', 'tes', '2023-01-27', 'laki-laki', 1, '2023-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `slack` varchar(191) NOT NULL,
  `nama_lengkap` varchar(191) NOT NULL,
  `username` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(191) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `slack`, `nama_lengkap`, `username`, `email`, `password`, `status`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 'HFsWVMg8oNX24Ru', 'Super Admins', 'superadmin', 'system@multi.com', '$2y$10$a8tj4ouFXGoYPG9A62/pS..UeuSRyqpSb2PhnPiIKpDVYp8Eqoome', 1, 1, 1, '2023-01-14 03:05:00', '2023-02-03 04:23:12'),
(3, 'UpwxgDsygyoUqx9', 'Admin ProTech Academy', 'Admin', 'admin@multi.com', '$2y$10$tI6JJBLjlXDPTn71Daem6OxaBxOdUd5XP3zZ9UEy.SkvKoKv9HY8K', 1, 1, 3, '2023-01-19 07:04:37', '2023-01-26 05:19:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `file_letter`
--
ALTER TABLE `file_letter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `instrukturs`
--
ALTER TABLE `instrukturs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `letters`
--
ALTER TABLE `letters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_role`
--
ALTER TABLE `menu_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `file_letter`
--
ALTER TABLE `file_letter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `instrukturs`
--
ALTER TABLE `instrukturs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `letters`
--
ALTER TABLE `letters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `menu_role`
--
ALTER TABLE `menu_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
