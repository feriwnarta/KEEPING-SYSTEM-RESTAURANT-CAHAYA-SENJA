-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2023 at 10:59 AM
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_history_keeping`
--

INSERT INTO `tb_history_keeping` (`id_history_keeping`, `id_keeping`, `status_keeping`, `count_keeping`, `tanggal`, `create_at`, `update_at`) VALUES
('4d4b33d0-082f-11ee-8633-09553318dde3', '4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', 'IN', 1, '2023-06-11', '2023-06-11 15:09:34', NULL),
('4d4d1da0-082f-11ee-ac6c-a922ba8a3511', '4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', 'IN', 1, '2023-06-11', '2023-06-11 15:09:34', NULL),
('4d5071d0-082f-11ee-a2ea-efd408f0eec8', '4d4eaa20-082f-11ee-833e-dd0ca3a69e57', 'IN', 5, '2023-06-11', '2023-06-11 15:09:34', NULL),
('4d50ba50-082f-11ee-b826-87ef0aa7e591', '4d509440-082f-11ee-b45c-2384eb1c674d', 'IN', 5, '2023-06-11', '2023-06-11 15:09:34', NULL),
('4d53c4c0-082f-11ee-a184-a952bbc7417a', '4d523500-082f-11ee-a236-a3b75f025f12', 'IN', 1, '2023-06-11', '2023-06-11 15:09:34', NULL),
('4d53eca0-082f-11ee-a450-2df95bfb6aa3', '4d53da10-082f-11ee-aee4-9f3cfc37d98c', 'IN', 1, '2023-06-11', '2023-06-11 15:09:34', NULL),
('b3ffdd10-082f-11ee-a269-6fcccae82467', '4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', 'IN', 1, '2023-06-11', '2023-06-11 15:12:27', NULL),
('b4001360-082f-11ee-90ce-11ebd8d75aba', '4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', 'IN', 1, '2023-06-11', '2023-06-11 15:12:27', NULL),
('b43224a0-082f-11ee-860b-5b83bfa68f08', 'b4138c30-082f-11ee-a005-212db1a7da4e', 'IN', 3, '2023-06-11', '2023-06-11 15:12:27', NULL),
('b450b830-082f-11ee-b462-838431c5ebed', 'b4323400-082f-11ee-9728-a7c84dbd35b0', 'IN', 3, '2023-06-11', '2023-06-11 15:12:27', NULL),
('b4782660-082f-11ee-aafe-d9af7a4a4877', 'b46078a0-082f-11ee-8072-7918c0970232', 'IN', 1, '2023-06-11', '2023-06-11 15:12:27', NULL),
('b47ea540-082f-11ee-9ccc-29d024457417', 'b4783ef0-082f-11ee-8d12-35749f95e144', 'IN', 1, '2023-06-11', '2023-06-11 15:12:27', NULL),
('cdcea430-082f-11ee-9741-adcc33dcc147', '4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', 'IN', 2, '2023-06-11', '2023-06-11 15:13:10', NULL),
('cdcedaa0-082f-11ee-9b2e-15936b7afa50', '4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', 'IN', 2, '2023-06-11', '2023-06-11 15:13:10', NULL),
('cdd618c0-082f-11ee-80d1-19349e80396c', '4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', 'IN', 2, '2023-06-11', '2023-06-11 15:13:10', NULL),
('d8293440-082f-11ee-826f-49d839cfe4c1', '4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', 'OUT', 2, '2023-06-11', '2023-06-11 15:13:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_menu`
--

CREATE TABLE `tb_menu` (
  `id_menu` varchar(255) NOT NULL,
  `name` varchar(100) NOT NULL,
  `thumbnail` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id_menu`, `name`, `thumbnail`, `create_at`, `update_at`) VALUES
('52971010-082c-11ee-9c1a-3bc53a8c98a1', 'Smirnoff lemon', '64857c3f3739b.jpg', '2023-06-11 14:48:15', NULL),
('552b7b60-082a-11ee-ac62-ab1be0572d2d', 'Anker', '648578e8889fd.jpg', '2023-06-11 14:34:00', NULL),
('574777f0-082c-11ee-a8c5-9f9782742eec', 'Putao', '64857c4716a1d.jpg', '2023-06-11 14:48:23', NULL),
('5dae1510-082c-11ee-8a63-bf9fbc4dae36', 'Bir bali', '64857c51c94bc.jpg', '2023-06-11 14:48:33', NULL),
('61bf1b60-082c-11ee-bcc7-5593fc83d43f', 'Martel', '64857c589fdf4.jpg', '2023-06-11 14:48:40', NULL),
('733e4be0-082c-11ee-b428-c1904869b1cb', 'Chivas', '64857c760248d.jpg', '2023-06-11 14:49:10', NULL),
('7d5a4e30-082c-11ee-bb5f-737f439f898b', 'Black label', '64857c86ecebf.jpg', '2023-06-11 14:49:26', NULL),
('82040100-082c-11ee-ab8b-415a2d0c1048', 'Jack daniels', '64857c8ec1b5e.jpg', '2023-06-11 14:49:34', NULL),
('a0a13a20-082c-11ee-ad08-3f030980757b', 'Bintang besar', '64857cc225dc8.jpg', '2023-06-11 14:50:26', NULL),
('a7a03170-082c-11ee-9136-330848c1a69a', 'Guiness besar', '64857ccdd9bb2.jpg', '2023-06-11 14:50:37', NULL),
('cd2e98c0-082c-11ee-87a1-956863df12b9', 'Kawa kawa', '64857d0cd9084.jpg', '2023-06-11 14:51:40', NULL),
('d7a2b5c0-082c-11ee-92ba-af4c2ce4f31c', 'Anggur merah', '64857d1e6b640.jpg', '2023-06-11 14:51:58', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user_keeping`
--

INSERT INTO `tb_user_keeping` (`id_keeping`, `id_product`, `phone_number`, `cust_name`, `product_count`, `create_at`, `update_at`) VALUES
('4d4ae8b0-082f-11ee-940b-3bf44bd40ef8', '552b7b60-082a-11ee-ac62-ab1be0572d2d', '085714342528', 'Feri', 5, '2023-06-11 15:09:34', '2023-06-11 03:13:27'),
('4d4eaa20-082f-11ee-833e-dd0ca3a69e57', '61bf1b60-082c-11ee-bcc7-5593fc83d43f', '085714342528', 'Feri', 5, '2023-06-11 15:09:34', NULL),
('4d509440-082f-11ee-b45c-2384eb1c674d', '61bf1b60-082c-11ee-bcc7-5593fc83d43f', '085714342528', 'Feri', 5, '2023-06-11 15:09:34', NULL),
('4d523500-082f-11ee-a236-a3b75f025f12', '574777f0-082c-11ee-a8c5-9f9782742eec', '085714342528', 'Feri', 1, '2023-06-11 15:09:34', NULL),
('4d53da10-082f-11ee-aee4-9f3cfc37d98c', '574777f0-082c-11ee-a8c5-9f9782742eec', '085714342528', 'Feri', 1, '2023-06-11 15:09:34', NULL),
('b4138c30-082f-11ee-a005-212db1a7da4e', 'a7a03170-082c-11ee-9136-330848c1a69a', '085714342528', 'Feri', 3, '2023-06-11 15:12:27', NULL),
('b4323400-082f-11ee-9728-a7c84dbd35b0', 'a7a03170-082c-11ee-9136-330848c1a69a', '085714342528', 'Feri', 3, '2023-06-11 15:12:27', NULL),
('b46078a0-082f-11ee-8072-7918c0970232', 'a0a13a20-082c-11ee-ad08-3f030980757b', '085714342528', 'Feri', 1, '2023-06-11 15:12:27', NULL),
('b4783ef0-082f-11ee-8d12-35749f95e144', 'a0a13a20-082c-11ee-ad08-3f030980757b', '085714342528', 'Feri', 1, '2023-06-11 15:12:27', NULL);

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
