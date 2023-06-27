-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 27, 2023 at 10:02 AM
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
-- Table structure for table `tb_blast_log`
--

CREATE TABLE `tb_blast_log` (
  `id` int(11) NOT NULL,
  `cust_phone` varchar(100) NOT NULL,
  `log_message` text NOT NULL,
  `log_status` varchar(20) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_blast_log`
--

INSERT INTO `tb_blast_log` (`id`, `cust_phone`, `log_message`, `log_status`, `create_at`) VALUES
(50, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Anker\nJumlah = 1\n================================\nNama Barang = Putao\nJumlah = 2\n================================\nNama Barang = Bir bali\nJumlah = 1\n================================\nNama Barang = Martel\nJumlah = 2\n================================\nNama Barang = Chivas\nJumlah = 1\nTanggal : 2023-06-26 16:05:15 \n================================ Anker => IN, Putao => IN, Bir bali => IN, Martel => IN, Chivas => IN, ', 'SEND', '2023-06-26 16:05:18'),
(51, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Putao\nJumlah = 1\n================================\nNama Barang = Bir bali\nJumlah = 1\n================================\nNama Barang = Martel\nJumlah = 1\n================================\nNama Barang = Chivas\nJumlah = 1\nTanggal : 2023-06-26 16:06:30 \n================================ Putao => IN, Bir bali => IN, Martel => IN, Chivas => IN, ', 'SEND', '2023-06-26 16:06:34'),
(52, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Putao\nJumlah = 1\nTanggal : 2023-06-26 16:08:27 \n================================ Putao => IN, ', 'SEND', '2023-06-26 16:08:29'),
(53, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian ================================\n================================\nNama Barang = Jack daniels\nJumlah = 1\n================================\nNama Barang = Bintang besar\nJumlah = 1\nTanggal : 2023-06-26 16:22:36 \n================================ Jack daniels => IN \nBintang besar => IN \n', 'SEND', '2023-06-26 16:22:38'),
(54, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian ================================\n\nNama Barang = Chivas\nJumlah = 1\nTanggal : 2023-06-26 16:23:14 \n================================ Chivas => IN \n', 'SEND', '2023-06-26 16:23:17'),
(55, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \\n================================Nama Barang = Putao\nJumlah = 1 \n\nTanggal : 2023-06-26 16:24:03 \n================================ Putao => IN \n', 'SEND', '2023-06-26 16:24:05'),
(56, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================Nama Barang = Putao\nJumlah = 1\nTanggal : 2023-06-26 16:25:38 \n================================ Putao => IN \n', 'SEND', '2023-06-26 16:25:40'),
(57, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\n\nNama Barang = Anker\nJumlah = 1\nTanggal : 2023-06-26 16:26:36 \n================================ Anker => IN \n', 'SEND', '2023-06-26 16:26:39'),
(58, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Putao\nJumlah = 1\n\nNama Barang = Bintang besar\nJumlah = 1\n\n\nTanggal : 2023-06-26 16:31:00 \n================================ Putao => IN \nBintang besar => IN \n', 'SEND', '2023-06-26 16:31:03'),
(59, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Anker\nJumlah = 1\n\nTanggal : 2023-06-26 16:31:48 \n================================ Anker => IN \n', 'SEND', '2023-06-26 16:31:50'),
(60, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Putao\nJumlah = 1\nTanggal : 2023-06-26 16:33:11 \n================================ Putao => IN \n', 'SEND', '2023-06-26 16:33:13'),
(61, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Bir bali\nJumlah = 1\nNama Barang = Jack daniels\nJumlah = 1\nTanggal : 2023-06-26 16:33:34 \n================================ Bir bali => IN \nJack daniels => IN \n', 'SEND', '2023-06-26 16:33:37'),
(62, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Putao\nJumlah = 1\nTanggal : 2023-06-26 16:34:44 \n================================ Putao => IN \n', 'SEND', '2023-06-26 16:34:47'),
(63, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Putao\nJumlah = 1\nNama Barang = Bir bali\nJumlah = 1\nTanggal : 2023-06-26 16:35:08 \n================================ Putao => IN \nBir bali => IN \n', 'SEND', '2023-06-26 16:35:11'),
(64, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Putao\nJumlah = 1\nNama Barang = Martel\nJumlah = 1\nTanggal : 2023-06-26 16:36:06 \n================================ Putao => IN \nMartel => IN \n', 'SEND', '2023-06-26 16:36:08'),
(65, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Putao\nJumlah = 1kontolNama Barang = Martel\nJumlah = 1\nTanggal : 2023-06-26 16:36:42 \n================================ Putao => IN \nMartel => IN \n', 'SEND', '2023-06-26 16:36:44'),
(66, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Anker\nJumlah = 1\n\nNama Barang = Putao\nJumlah = 1\nTanggal : 2023-06-26 16:37:48 \n================================ Anker => IN \nPutao => IN \n', 'SEND', '2023-06-26 16:37:51'),
(67, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Bir bali\nJumlah = 1\nTanggal : 2023-06-26 16:39:43 \n================================ Bir bali => IN \n', 'SEND', '2023-06-26 16:39:45'),
(68, '085714342528', 'Hai, feri\n Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Anker\nJumlah = 1\nTanggal : 2023-06-26 16:42:10 \n================================ Anker => IN \n', 'SEND', '2023-06-26 16:42:12'),
(69, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Anker\nJumlah = 1\nTanggal : 2023-06-26 16:42:56 \n================================ Anker => IN \n', 'SEND', '2023-06-26 16:42:58'),
(70, '085714342528', 'Hai, feri Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Anker\nJumlah = 1\nTanggal : 2023-06-26 16:44:29 \n================================ Anker => IN \n 2023-06-26 16:44:29', 'SEND', '2023-06-26 16:44:32'),
(71, '085714342528', 'Hei feri terima kasih sudah mengeluarkan minuman anda dengan rincian sebagai berikut : \n================================\nNama Barang = Anker\nJumlah = 1\nTanggal : 2023-06-26 16:44:51 \n================================', 'SEND', '2023-06-26 16:44:52'),
(72, '085714342528', 'Hai, \nferi Terima kasih sudah menyimpan minuman anda dengan rincian \n================================\nNama Barang = Anker\nJumlah = 1\nTanggal : 2023-06-26 16:45:49 \n================================ Anker => IN \n 2023-06-26 16:45:49', 'SEND', '2023-06-26 16:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `tb_config`
--

CREATE TABLE `tb_config` (
  `id` int(11) NOT NULL,
  `option_name` varchar(255) NOT NULL,
  `value_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_config`
--

INSERT INTO `tb_config` (`id`, `option_name`, `value_name`) VALUES
(1, '%cust_name%', 'dapatkan nama customer'),
(2, '%cust_phone%', 'dapatkan nomor telpon customer'),
(3, '%product_count%', 'dapatkan jumlah barang yang disimpan'),
(4, '%product_name%', 'dapatkan nama barang yang disimpan'),
(5, '%date%', 'dapatkan tanggal penyimpanan'),
(6, 'message_success_save_keeping', 'Hai, %cust_name% Terima kasih sudah menyimpan minuman anda dengan rincian %detail% %status% %date%'),
(7, '%status%', 'dapatkan status barang'),
(8, '%detail%', 'dapatkan detail barang'),
(9, 'message_success_out_keeping', 'Hei %cust_name% terima kasih sudah mengeluarkan minuman anda dengan rincian sebagai berikut : %detail%');

-- --------------------------------------------------------

--
-- Table structure for table `tb_customer`
--

CREATE TABLE `tb_customer` (
  `id_cust` varchar(255) NOT NULL,
  `phone_number` varchar(150) NOT NULL,
  `cust_name` varchar(255) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_customer`
--

INSERT INTO `tb_customer` (`id_cust`, `phone_number`, `cust_name`, `create_at`, `update_at`) VALUES
('8ae26800-1400-11ee-91e5-3b9ccdb606fc', '085714342528', 'feri', '2023-06-26 16:05:05', NULL);

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
('02ddbb40-1401-11ee-9f04-ef3c93f2e934', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:08:27', NULL),
('0bde9660-1406-11ee-a02e-1938009fb0ee', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'IN', 1, '2023-06-26', '2023-06-26 16:44:29', NULL),
('141ab690-1403-11ee-9285-35f2d480e7c4', '90e1cdc0-1400-11ee-a349-4b435ae8735b', 'IN', 1, '2023-06-26', '2023-06-26 16:23:14', NULL),
('1838ce60-1406-11ee-b096-f767a6f13bc1', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'OUT', 1, '2023-06-26', '2023-06-26 16:44:51', NULL),
('1ba20a00-1405-11ee-91ea-e94cc1a6a680', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'IN', 1, '2023-06-26', '2023-06-26 16:37:46', NULL),
('1cc9af60-1405-11ee-a8f6-f98016a9cc02', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:37:48', NULL),
('28610d40-1404-11ee-9e0d-71e6233fd21e', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:30:58', NULL),
('29ba5040-1404-11ee-8d22-7dfe8aa60d3b', 'fd31b160-1402-11ee-a42a-cbf4360276e4', 'IN', 1, '2023-06-26', '2023-06-26 16:31:00', NULL),
('31369c50-1403-11ee-99fe-05dbeb835d21', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:24:03', NULL),
('3b896e30-1406-11ee-b4c2-b5d7f9802668', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'IN', 1, '2023-06-26', '2023-06-26 16:45:49', NULL),
('463d4bc0-1404-11ee-80ba-99a45b897da1', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'IN', 1, '2023-06-26', '2023-06-26 16:31:48', NULL),
('614e4220-1405-11ee-8e18-5fdc0730962d', '8e760a40-1400-11ee-9869-951ba70fcbe8', 'IN', 1, '2023-06-26', '2023-06-26 16:39:43', NULL),
('69683cc0-1403-11ee-b444-c1a2c743ab06', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:25:38', NULL),
('77af3840-1404-11ee-80f9-c98b10de6d83', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:33:11', NULL),
('84379400-1404-11ee-995d-a3c017ac2c0c', '8e760a40-1400-11ee-9869-951ba70fcbe8', 'IN', 1, '2023-06-26', '2023-06-26 16:33:32', NULL),
('859a09b0-1404-11ee-b0fa-7b3659b5c207', 'fbfa6b90-1402-11ee-b398-938ea6ec9ae9', 'IN', 1, '2023-06-26', '2023-06-26 16:33:34', NULL),
('8ae2ebc0-1400-11ee-8da6-21de831cfe5e', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'IN', 1, '2023-06-26', '2023-06-26 16:05:05', NULL),
('8c6a81a0-1403-11ee-a55c-19ce4733ebf4', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'IN', 1, '2023-06-26', '2023-06-26 16:26:36', NULL),
('8d6819e0-1400-11ee-9282-75675054e8d5', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 2, '2023-06-26', '2023-06-26 16:05:10', NULL),
('8e763c50-1400-11ee-ac8b-c76050b4aa58', '8e760a40-1400-11ee-9869-951ba70fcbe8', 'IN', 1, '2023-06-26', '2023-06-26 16:05:11', NULL),
('8f946d70-1400-11ee-8a6c-91b87e811346', '8f943d80-1400-11ee-9e6b-73634947f5d7', 'IN', 2, '2023-06-26', '2023-06-26 16:05:13', NULL),
('90e1fbf0-1400-11ee-bcc6-699aa03d59b2', '90e1cdc0-1400-11ee-a349-4b435ae8735b', 'IN', 1, '2023-06-26', '2023-06-26 16:05:15', NULL),
('af53c1f0-1404-11ee-ad67-2394bac58aa3', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:34:44', NULL),
('b8d2ce20-1405-11ee-8094-e72e34904396', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'IN', 1, '2023-06-26', '2023-06-26 16:42:10', NULL),
('b95d0600-1400-11ee-bac6-ebd77af23d3a', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:06:23', NULL),
('bab02b30-1400-11ee-9d46-d9a36d7cca37', '8e760a40-1400-11ee-9869-951ba70fcbe8', 'IN', 1, '2023-06-26', '2023-06-26 16:06:25', NULL),
('bbf8fb10-1400-11ee-adf5-41508ff37fef', '8f943d80-1400-11ee-9e6b-73634947f5d7', 'IN', 1, '2023-06-26', '2023-06-26 16:06:28', NULL),
('bc229790-1404-11ee-947d-15065b5e5b05', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:35:06', NULL),
('bd72af90-1404-11ee-868a-091264244d73', '8e760a40-1400-11ee-9869-951ba70fcbe8', 'IN', 1, '2023-06-26', '2023-06-26 16:35:08', NULL),
('bd905130-1400-11ee-a617-1972e7ef6618', '90e1cdc0-1400-11ee-a349-4b435ae8735b', 'IN', 1, '2023-06-26', '2023-06-26 16:06:30', NULL),
('d4235b20-1405-11ee-a33c-f970282448b9', '8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', 'IN', 1, '2023-06-26', '2023-06-26 16:42:56', NULL),
('de404650-1404-11ee-9293-5f0df1834d39', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:36:03', NULL),
('dfb03a00-1404-11ee-81ad-b59a49d04339', '8f943d80-1400-11ee-9e6b-73634947f5d7', 'IN', 1, '2023-06-26', '2023-06-26 16:36:06', NULL),
('f433b4b0-1404-11ee-bede-2d7ec90e49b9', '8d680470-1400-11ee-a192-698b7fd9716a', 'IN', 1, '2023-06-26', '2023-06-26 16:36:40', NULL),
('f56bc280-1404-11ee-8f86-a1833d975657', '8f943d80-1400-11ee-9e6b-73634947f5d7', 'IN', 1, '2023-06-26', '2023-06-26 16:36:42', NULL),
('fbfa8970-1402-11ee-a962-859b7e687507', 'fbfa6b90-1402-11ee-b398-938ea6ec9ae9', 'IN', 1, '2023-06-26', '2023-06-26 16:22:34', NULL),
('fd31c9d0-1402-11ee-ab61-07b6db7fbf57', 'fd31b160-1402-11ee-a42a-cbf4360276e4', 'IN', 1, '2023-06-26', '2023-06-26 16:22:36', NULL);

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
  `id_customer` varchar(255) NOT NULL,
  `product_count` int(11) NOT NULL,
  `create_at` datetime NOT NULL DEFAULT current_timestamp(),
  `update_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user_keeping`
--

INSERT INTO `tb_user_keeping` (`id_keeping`, `id_product`, `id_customer`, `product_count`, `create_at`, `update_at`) VALUES
('8ae2e4e0-1400-11ee-a67e-61eea5ccdee3', '552b7b60-082a-11ee-ac62-ab1be0572d2d', '8ae26800-1400-11ee-91e5-3b9ccdb606fc', 7, '2023-06-26 16:05:05', '2023-06-26 04:45:49'),
('8d680470-1400-11ee-a192-698b7fd9716a', '574777f0-082c-11ee-a8c5-9f9782742eec', '8ae26800-1400-11ee-91e5-3b9ccdb606fc', 13, '2023-06-26 16:05:10', '2023-06-26 04:37:48'),
('8e760a40-1400-11ee-9869-951ba70fcbe8', '5dae1510-082c-11ee-8a63-bf9fbc4dae36', '8ae26800-1400-11ee-91e5-3b9ccdb606fc', 5, '2023-06-26 16:05:11', '2023-06-26 04:39:43'),
('8f943d80-1400-11ee-9e6b-73634947f5d7', '61bf1b60-082c-11ee-bcc7-5593fc83d43f', '8ae26800-1400-11ee-91e5-3b9ccdb606fc', 5, '2023-06-26 16:05:13', '2023-06-26 04:36:42'),
('90e1cdc0-1400-11ee-a349-4b435ae8735b', '733e4be0-082c-11ee-b428-c1904869b1cb', '8ae26800-1400-11ee-91e5-3b9ccdb606fc', 3, '2023-06-26 16:05:15', '2023-06-26 04:23:14'),
('fbfa6b90-1402-11ee-b398-938ea6ec9ae9', '82040100-082c-11ee-ab8b-415a2d0c1048', '8ae26800-1400-11ee-91e5-3b9ccdb606fc', 2, '2023-06-26 16:22:34', '2023-06-26 04:33:34'),
('fd31b160-1402-11ee-a42a-cbf4360276e4', 'a0a13a20-082c-11ee-ad08-3f030980757b', '8ae26800-1400-11ee-91e5-3b9ccdb606fc', 2, '2023-06-26 16:22:36', '2023-06-26 04:31:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_blast_log`
--
ALTER TABLE `tb_blast_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_config`
--
ALTER TABLE `tb_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_customer`
--
ALTER TABLE `tb_customer`
  ADD PRIMARY KEY (`id_cust`);

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

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_blast_log`
--
ALTER TABLE `tb_blast_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `tb_config`
--
ALTER TABLE `tb_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
