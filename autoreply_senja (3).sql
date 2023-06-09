-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2023 at 11:52 AM
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
-- Database: `autoreply_senja`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_history_keeping`
--

CREATE TABLE `tb_history_keeping` (
  `id_history_keeping` varchar(255) NOT NULL,
  `id_keeping` varchar(255) NOT NULL,
  `status_keeping` varchar(10) NOT NULL,
  `count_keeping` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_history_keeping`
--

INSERT INTO `tb_history_keeping` (`id_history_keeping`, `id_keeping`, `status_keeping`, `count_keeping`, `tanggal`, `create_at`, `update_at`) VALUES
('1cc1d430-06ab-11ee-b8c2-fd7999ffae4d', '1cc1c380-06ab-11ee-8012-19bbe8449569', 'IN', 2, '2023-06-09', '2023-06-09 16:50:48', NULL),
('1cc204c0-06ab-11ee-bb80-f5fcf8838ae0', '1cc1fbe0-06ab-11ee-8fb6-556f51c759dc', 'IN', 1, '2023-06-09', '2023-06-09 16:50:48', NULL),
('1cc23fa0-06ab-11ee-b98b-6f1a2ef28c0e', '1cc236a0-06ab-11ee-9fc8-69a22598436b', 'IN', 2, '2023-06-09', '2023-06-09 16:50:48', NULL),
('2807fe20-06ab-11ee-b18b-ffc0e76d4fd3', '1cc236a0-06ab-11ee-9fc8-69a22598436b', 'IN', 1, '2023-06-09', '2023-06-09 16:51:07', NULL),
('2d5eb520-06ab-11ee-9bae-bb07aa51d3d8', '1cc236a0-06ab-11ee-9fc8-69a22598436b', 'OUT', 1, '2023-06-09', '2023-06-09 16:51:16', NULL),
('3d013030-06ab-11ee-8c4e-a35d98df8e70', '1cc236a0-06ab-11ee-9fc8-69a22598436b', 'OUT', 2, '2023-06-09', '2023-06-09 16:51:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id_menu` varchar(255) NOT NULL,
  `kode_menu` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id_menu`, `kode_menu`, `name`, `thumbnail`, `create_at`, `update_at`) VALUES
('1', 'MENU1', 'Anker', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//101/MTA-2199881/anker_anker-bir-botol-minuman-alkohol--620-ml-_full02.jpg', '2023-06-07 19:41:15', NULL),
('10', 'MENU1', 'Anker', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//101/MTA-2199881/anker_anker-bir-botol-minuman-alkohol--620-ml-_full02.jpg', '2023-06-07 19:41:15', NULL),
('11', 'MENU2', 'Guiness', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/MTA-28451228/guinness_beer_guinness_large_-_bir_hitam_guiness_620_ml_full01_r6gy2281.jpeg', '2023-06-07 19:41:44', NULL),
('12', 'MENU3', 'Martel', 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2021/9/1/e9b50e0a-09f3-4391-aeba-afde04540f93.jpg', '2023-06-07 19:59:35', NULL),
('2', 'MENU2', 'Guiness', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/MTA-28451228/guinness_beer_guinness_large_-_bir_hitam_guiness_620_ml_full01_r6gy2281.jpeg', '2023-06-07 19:41:44', NULL),
('3', 'MENU3', 'Martel', 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2021/9/1/e9b50e0a-09f3-4391-aeba-afde04540f93.jpg', '2023-06-07 19:59:35', NULL),
('4', 'MENU1', 'Anker', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//101/MTA-2199881/anker_anker-bir-botol-minuman-alkohol--620-ml-_full02.jpg', '2023-06-07 19:41:15', NULL),
('5', 'MENU2', 'Guiness', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/MTA-28451228/guinness_beer_guinness_large_-_bir_hitam_guiness_620_ml_full01_r6gy2281.jpeg', '2023-06-07 19:41:44', NULL),
('6', 'MENU3', 'Martel', 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2021/9/1/e9b50e0a-09f3-4391-aeba-afde04540f93.jpg', '2023-06-07 19:59:35', NULL),
('7', 'MENU1', 'Anker', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//101/MTA-2199881/anker_anker-bir-botol-minuman-alkohol--620-ml-_full02.jpg', '2023-06-07 19:41:15', NULL),
('8', 'MENU2', 'Guiness', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/MTA-28451228/guinness_beer_guinness_large_-_bir_hitam_guiness_620_ml_full01_r6gy2281.jpeg', '2023-06-07 19:41:44', NULL),
('9', 'MENU3', 'Martel', 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2021/9/1/e9b50e0a-09f3-4391-aeba-afde04540f93.jpg', '2023-06-07 19:59:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user_keeping`
--

CREATE TABLE `tb_user_keeping` (
  `id_keeping` varchar(255) NOT NULL,
  `id_product` varchar(255) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `cust_name` varchar(150) DEFAULT NULL,
  `product_count` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_keeping`
--

INSERT INTO `tb_user_keeping` (`id_keeping`, `id_product`, `phone_number`, `cust_name`, `product_count`, `create_at`, `update_at`) VALUES
('1cc1c380-06ab-11ee-8012-19bbe8449569', '1', '085714342528', 'Feri', 2, '2023-06-09 16:50:48', NULL),
('1cc1fbe0-06ab-11ee-8fb6-556f51c759dc', '10', '085714342528', 'Feri', 1, '2023-06-09 16:50:48', NULL),
('1cc236a0-06ab-11ee-9fc8-69a22598436b', '12', '085714342528', 'Feri', 0, '2023-06-09 16:50:48', '2023-06-09 04:51:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_history_keeping`
--
ALTER TABLE `tb_history_keeping`
  ADD PRIMARY KEY (`id_history_keeping`);

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tb_user_keeping`
--
ALTER TABLE `tb_user_keeping`
  ADD PRIMARY KEY (`id_keeping`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
