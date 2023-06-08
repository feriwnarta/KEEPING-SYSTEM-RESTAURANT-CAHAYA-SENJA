-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 08, 2023 at 12:03 PM
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
  `code` varchar(25) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `cust_name` varchar(150) DEFAULT NULL,
  `product_count` int(11) NOT NULL,
  `id_product` varchar(255) NOT NULL,
  `tanggal_input` date DEFAULT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_keeping`
--

INSERT INTO `tb_user_keeping` (`id_keeping`, `code`, `phone_number`, `cust_name`, `product_count`, `id_product`, `tanggal_input`, `create_at`, `update_at`) VALUES
('71b02f80-05df-11ee-8f42-7df50e3e2649', 'KEEP2023064', '085714342528', 'Joko', 1, '12', '2023-06-08', '2023-06-08 16:32:53', NULL),
('87c64620-05df-11ee-9b32-2b412f255646', 'KEEP2023065', '08966131212', 'Tete', 1, '11', '2023-06-08', '2023-06-08 16:33:30', NULL),
('cef29980-05dd-11ee-b4c7-8994a660c39b', 'KEEP2023061', '085714342528', 'feri', 1, '1', '2023-06-08', '2023-06-08 16:21:11', NULL),
('cef2cee0-05dd-11ee-a19d-bf70d19e50c2', 'KEEP2023062', '085714342528', 'feri', 2, '11', '2023-06-08', '2023-06-08 16:21:11', NULL),
('cef2ed30-05dd-11ee-973e-535740daa3bf', 'KEEP2023063', '085714342528', 'feri', 2, '12', '2023-06-08', '2023-06-08 16:21:11', NULL),
('dc63d860-05df-11ee-8e7a-e961c575a670', 'KEEP2023066', '081210170910', 'tete', 1, '12', '2023-06-08', '2023-06-08 16:35:52', NULL),
('f0a56f50-05df-11ee-a1e8-cbd0c446c4e5', 'KEEP2023067', '08966123141', 'lolok', 1, '5', '2023-06-07', '2023-06-08 16:36:26', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_menu`
--
ALTER TABLE `tb_menu`
  ADD PRIMARY KEY (`id_menu`);

--
-- Indexes for table `tb_user_keeping`
--
ALTER TABLE `tb_user_keeping`
  ADD PRIMARY KEY (`id_keeping`),
  ADD KEY `id_product` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
