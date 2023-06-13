-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 13, 2023 at 09:44 AM
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
('0106cea0-09be-11ee-a4b5-fb4f69c770d8', '0106be80-09be-11ee-8013-e9ef2dbc17a3', 'IN', 1, '2023-06-13', '2023-06-13 14:43:36', NULL),
('13f94130-09be-11ee-b7e9-bf146722bb72', 'ebba3500-09bd-11ee-9998-91a2251ea1a1', 'IN', 2, '2023-06-13', '2023-06-13 14:44:07', NULL),
('1edfa120-09be-11ee-998f-6d22180df007', 'ebba3500-09bd-11ee-9998-91a2251ea1a1', 'OUT', 2, '2023-06-13', '2023-06-13 14:44:27', NULL),
('31b3a190-09b9-11ee-8b2e-b17032025be4', '31b390d0-09b9-11ee-90f3-d1ffcc096580', 'IN', 10, '2023-06-13', '2023-06-13 14:09:10', NULL),
('33bb1bc0-09b9-11ee-956a-bdb8992bdc92', '33bb0870-09b9-11ee-ac6f-59fbab56fab8', 'IN', 10, '2023-06-13', '2023-06-13 14:09:13', NULL),
('34e0ab10-09b9-11ee-ba60-dd60f53cea0b', '34e08bb0-09b9-11ee-9d40-730ad011ed9d', 'IN', 10, '2023-06-13', '2023-06-13 14:09:15', NULL),
('425db560-09b9-11ee-87f1-dfac1fc61888', '31b390d0-09b9-11ee-90f3-d1ffcc096580', 'IN', 5, '2023-06-13', '2023-06-13 14:09:38', NULL),
('4ab8cf50-09b9-11ee-88e0-4b1b89d00244', '31b390d0-09b9-11ee-90f3-d1ffcc096580', 'OUT', 2, '2023-06-13', '2023-06-13 14:09:53', NULL),
('503b9bf0-09b9-11ee-9cfa-a5218ac2e3eb', '31b390d0-09b9-11ee-90f3-d1ffcc096580', 'OUT', 3, '2023-06-13', '2023-06-13 14:10:02', NULL),
('6206e680-09bd-11ee-8163-5553c190e86e', '33bb0870-09b9-11ee-ac6f-59fbab56fab8', 'IN', 2, '2023-06-13', '2023-06-13 14:39:09', NULL),
('6c0036a0-09bd-11ee-b5a7-f130e1d20c68', '6c001710-09bd-11ee-bf81-490cf252a470', 'IN', 1, '2023-06-13', '2023-06-13 14:39:26', NULL),
('743da800-09bd-11ee-8d24-514e5a973510', '33bb0870-09b9-11ee-ac6f-59fbab56fab8', 'OUT', 2, '2023-06-13', '2023-06-13 14:39:41', NULL),
('ebba45b0-09bd-11ee-bdc2-a1414e67702c', 'ebba3500-09bd-11ee-9998-91a2251ea1a1', 'IN', 3, '2023-06-13', '2023-06-13 14:43:00', NULL),
('ec835770-09bd-11ee-8131-619ef2551648', 'ec8337a0-09bd-11ee-be90-9756f8bef77a', 'IN', 2, '2023-06-13', '2023-06-13 14:43:01', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tb_menu`
--

INSERT INTO `tb_menu` (`id_menu`, `name`, `thumbnail`, `create_at`, `update_at`) VALUES
('552b7b60-082a-11ee-ac62-ab1be0572d2d', 'Anker', '648578e8889fd.jpg', '2023-06-11 14:34:00', NULL),
('574777f0-082c-11ee-a8c5-9f9782742eec', 'Putao', '64857c4716a1d.jpg', '2023-06-11 14:48:23', NULL),
('59f1f150-08dd-11ee-9bac-6bd2d58f24e8', 'Smirnoff lemon', '6486a54076b96.jpeg', '2023-06-12 11:55:28', NULL),
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
-- Table structure for table `tb_spreadsheet_version`
--

CREATE TABLE `tb_spreadsheet_version` (
  `id_spreadsheet` varchar(255) NOT NULL,
  `id_google_spreadsheet` varchar(255) NOT NULL,
  `tanggal` varchar(50) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_spreadsheet_version`
--

INSERT INTO `tb_spreadsheet_version` (`id_spreadsheet`, `id_google_spreadsheet`, `tanggal`, `create_at`, `update_at`) VALUES
('33ba6ca0-09b9-11ee-8c60-b95486cf0e4a', '1S8iZOVBJetpiJERXeiVHdOZnSXs_jwzpak3a7yHFJZY', '2023-06', '2023-06-13 14:09:13', '2023-06-13 14:09:13');

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
('0106be80-09be-11ee-8013-e9ef2dbc17a3', '59f1f150-08dd-11ee-9bac-6bd2d58f24e8', '089667026058', 'Joko', 1, '2023-06-13 14:43:36', NULL),
('31b390d0-09b9-11ee-90f3-d1ffcc096580', '552b7b60-082a-11ee-ac62-ab1be0572d2d', '085714342528', 'Feri', 10, '2023-06-13 14:09:10', '2023-06-13 02:10:01'),
('33bb0870-09b9-11ee-ac6f-59fbab56fab8', '61bf1b60-082c-11ee-bcc7-5593fc83d43f', '085714342528', 'Feri', 10, '2023-06-13 14:09:13', '2023-06-13 02:39:39'),
('34e08bb0-09b9-11ee-9d40-730ad011ed9d', '733e4be0-082c-11ee-b428-c1904869b1cb', '085714342528', 'Feri', 10, '2023-06-13 14:09:15', NULL),
('6c001710-09bd-11ee-bf81-490cf252a470', '7d5a4e30-082c-11ee-bb5f-737f439f898b', '085714342528', 'Feri', 1, '2023-06-13 14:39:26', NULL),
('ebba3500-09bd-11ee-9998-91a2251ea1a1', '552b7b60-082a-11ee-ac62-ab1be0572d2d', '089667026058', 'Joko', 3, '2023-06-13 14:43:00', '2023-06-13 02:44:26'),
('ec8337a0-09bd-11ee-be90-9756f8bef77a', '574777f0-082c-11ee-a8c5-9f9782742eec', '089667026058', 'Joko', 2, '2023-06-13 14:43:01', NULL);

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
-- Indexes for table `tb_spreadsheet_version`
--
ALTER TABLE `tb_spreadsheet_version`
  ADD PRIMARY KEY (`id_spreadsheet`),
  ADD UNIQUE KEY `tanggal` (`tanggal`);

--
-- Indexes for table `tb_user_keeping`
--
ALTER TABLE `tb_user_keeping`
  ADD PRIMARY KEY (`id_keeping`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
