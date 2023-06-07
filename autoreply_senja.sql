-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2023 at 04:36 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id_menu` varchar(255) NOT NULL,
  `kode_menu` varchar(25) NOT NULL,
  `name` varchar(100) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id_menu`, `kode_menu`, `name`, `thumbnail`, `create_at`, `update_at`) VALUES
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id_menu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
