-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2023 at 12:02 PM
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
('af3893b0-06ac-11ee-9774-77ceb8aea37e', 'af3875b0-06ac-11ee-bc65-d7849b1725d1', 'IN', 2, '2023-06-09', '2023-06-09 17:02:03', NULL),
('af38dac0-06ac-11ee-b581-cd06a53357c1', 'af38cd30-06ac-11ee-a14c-5db19c46badb', 'IN', 1, '2023-06-09', '2023-06-09 17:02:03', NULL),
('af390ea0-06ac-11ee-8e7f-53449f78d2ae', 'af390340-06ac-11ee-ada0-5d1c2e3cb9f8', 'IN', 2, '2023-06-09', '2023-06-09 17:02:03', NULL),
('b3202a00-06ac-11ee-9647-b11db92f7c2b', 'af390340-06ac-11ee-ada0-5d1c2e3cb9f8', 'OUT', 1, '2023-06-09', '2023-06-09 17:02:10', NULL);

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
('10', 'MENU1', 'Kawa-kawa', 'https://www.canggusky.com/wp-content/uploads/2021/11/kawa-kawa.jpg', '2023-06-07 19:41:15', NULL),
('11', 'MENU2', 'Bintang besar', 'https://images.tokopedia.net/img/cache/700/VqbcmM/2022/2/17/ba3781ed-1251-4424-a940-02c55ce0b2b3.jpg', '2023-06-07 19:41:44', NULL),
('12', 'MENU3', 'Martel', 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2021/9/1/e9b50e0a-09f3-4391-aeba-afde04540f93.jpg', '2023-06-07 19:59:35', NULL),
('2', 'MENU2', 'Guiness', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/MTA-28451228/guinness_beer_guinness_large_-_bir_hitam_guiness_620_ml_full01_r6gy2281.jpeg', '2023-06-07 19:41:44', NULL),
('3', 'MENU3', 'Smirnof besar', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//99/MTA-8266455/smirnoff_smirnoff_red_vodka_medan_75_cl_-_750_ml_-_full01_rkj4pt37.jpg', '2023-06-07 19:59:35', NULL),
('4', 'MENU1', 'Bir bali besar', 'https://images.tokopedia.net/img/cache/700/hDjmkQ/2020/11/2/db2d9a64-0eeb-4478-9e04-a01fb0c1aee6.jpg', '2023-06-07 19:41:15', NULL),
('5', 'MENU2', 'Tsingtao', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//111/MTA-36786198/tsingtao_bir_tsing_tao_-_bir_china_-_330ml_full01_01dc9629.jpg', '2023-06-07 19:41:44', NULL),
('6', 'MENU3', 'Captain morgan', 'https://cdn.shopify.com/s/files/1/0499/7660/6874/products/CAPTAIN-MORGAN-ORIGINAL-SPICED-GOLD.jpg?v=1675928780', '2023-06-07 19:59:35', NULL),
('7', 'MENU1', 'Jack daniel', 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full//108/MTA-49248980/jack_daniel-s_jack_daniels_whiskey_700ml_full01_q2e3fgvj.jpg', '2023-06-07 19:41:15', NULL),
('8', 'MENU2', 'Chivas', 'https://www.winespiritshop.com/images/products/5abd87bb6bd883baa7620ac3fa4847d7_20230110041027_Chivas_Regal_12O.jpg', '2023-06-07 19:41:44', NULL),
('9', 'MENU3', 'Anggur merah', 'https://vinyard.com/2507-medium_default/anggur-merah-cap-orang-tua-147-620-ml.jpg', '2023-06-07 19:59:35', NULL);

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
('af3875b0-06ac-11ee-bc65-d7849b1725d1', '1', '085714342528', 'Feri', 2, '2023-06-09 17:02:03', NULL),
('af38cd30-06ac-11ee-a14c-5db19c46badb', '12', '085714342528', 'Feri', 1, '2023-06-09 17:02:03', NULL),
('af390340-06ac-11ee-ada0-5d1c2e3cb9f8', '3', '085714342528', 'Feri', 1, '2023-06-09 17:02:03', '2023-06-09 05:02:10');

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
