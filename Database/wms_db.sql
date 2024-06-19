-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 19-06-2024 a las 18:26:32
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `wms_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `admin_user` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_pass` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_nama` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_alamat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_telepon` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_ip` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_online` int(10) NOT NULL,
  `admin_level_kode` int(3) NOT NULL,
  `admin_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_created` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`admin_user`, `admin_pass`, `admin_nama`, `admin_alamat`, `admin_email`, `admin_telepon`, `admin_ip`, `admin_online`, `admin_level_kode`, `admin_status`, `admin_created`, `admin_updated`) VALUES
('admin', '0192023a7bbd73250516f069df18b500', 'Mark Cooper', 'Here St. Over There, Anywhere, 2306', 'admin@mail.com', '9564897544', '', 0, 1, 'H', '2019-02-01 22:19:14', '2024-04-26 11:06:42'),
('admin2', '202cb962ac59075b964b07152d234b70', 'Ang?lica', 'Quer?taro, Qro.', '', '1234567890', '', 0, 1, 'H', '2024-04-19 15:42:39', '2024-04-26 11:06:44'),
('cliente1', 'd9b1d7db4cd6e70935368a1efb10e377', 'cliente_edit', 'Qro', '', '1234567890', '', 0, 3, 'H', '2024-04-19 14:49:21', '2024-04-19 15:45:23'),
('cliente2', '202cb962ac59075b964b07152d234b70', 'cliente_ prueba', 'Q', '', '12', '', 0, 3, 'A', '2024-04-19 14:51:41', '2024-04-29 13:12:16'),
('proveedor1', '202cb962ac59075b964b07152d234b70', 'Pro', 'Qro.', '', '1234567890', '', 0, 2, 'A', '2024-04-19 14:45:39', '2024-04-19 14:45:39'),
('staff1', 'ab4c31c66f9fe6485aefd34c3c9c88a1', 'Staff 101', 'Sample Address', '', '4569872', '', 0, 2, 'A', '2022-06-13 09:34:04', '2022-06-13 09:42:46'),
('staff2', '2bf4351232ec393d2a436d73dcb69dcf', 'Staff 102', 'Sample Address', '', '7864321', '', 0, 3, 'A', '2022-06-13 09:34:26', '2024-04-19 15:44:15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin_level`
--

CREATE TABLE `admin_level` (
  `admin_level_kode` int(3) NOT NULL,
  `admin_level_nama` varchar(30) NOT NULL,
  `admin_level_status` char(1) NOT NULL,
  `admin_level_created` datetime NOT NULL DEFAULT current_timestamp(),
  `admin_level_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `admin_level`
--

INSERT INTO `admin_level` (`admin_level_kode`, `admin_level_nama`, `admin_level_status`, `admin_level_created`, `admin_level_updated`) VALUES
(1, 'Administrador', 'A', '2018-07-26 22:31:41', '2024-04-25 11:58:26'),
(2, 'Proveedor', 'A', '2018-07-26 22:31:41', '2024-04-26 11:28:20'),
(3, 'Cliente', 'A', '2018-08-17 16:45:45', '2024-04-26 11:28:27');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

CREATE TABLE `customer` (
  `id_customer` int(11) NOT NULL,
  `nama_customer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `alamat_customer` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `notelp_customer` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `customer_created` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `customer`
--

INSERT INTO `customer` (`id_customer`, `nama_customer`, `alamat_customer`, `notelp_customer`, `customer_created`, `customer_updated`) VALUES
(1, 'John Watson', '855 Rosemary St', '46552000', '2022-01-18 18:40:10', '2022-01-18 18:40:10'),
(2, 'Jack Stuart', '854 Louis St', '04522260', '2022-01-19 10:59:12', '2022-01-19 10:59:12'),
(3, 'Douglas Stover', '17 Lake Forest Drive', '06665210', '2022-01-19 17:13:24', '2022-01-19 17:13:24'),
(4, 'Curtis Maury', '1342 Wayside Lane', '10458600', '2022-01-19 17:14:03', '2022-01-19 17:14:03'),
(5, 'Betty Wright', '1205 Cardinal Lane', '01478000', '2022-01-19 17:14:23', '2022-01-19 17:14:23'),
(6, 'George', '19 Gerald Bates Drive', '03690005', '2022-01-19 17:14:54', '2022-01-19 17:14:54'),
(7, 'Richard', '469 Providence Lane', '01478005', '2022-01-19 17:15:25', '2022-01-19 17:15:25'),
(8, 'Casie Dixon', '361 Bassel St', '02580014', '2022-01-19 17:15:54', '2022-01-19 17:15:54'),
(9, 'Will Williams', '4569 Down St', '45654000', '2022-01-20 11:19:58', '2022-01-20 11:19:58'),
(10, 'Customer 101', 'Sample Address 101', '0931456789', '2022-06-13 09:15:59', '2022-06-13 09:15:59');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fractionations`
--

CREATE TABLE `fractionations` (
  `id_fractionation` int(11) NOT NULL,
  `id_origin_pallet` int(11) NOT NULL,
  `id_destination_pallet` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `transferred_quantity` int(11) NOT NULL,
  `fractionation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `identitas`
--

CREATE TABLE `identitas` (
  `identitas_id` int(3) NOT NULL,
  `identitas_website` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_keyword` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_alamat` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_notelp` char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_fb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_tw` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_gp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_yb` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_favicon` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_author` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `identitas_created` datetime NOT NULL DEFAULT current_timestamp(),
  `identitas_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `identitas`
--

INSERT INTO `identitas` (`identitas_id`, `identitas_website`, `identitas_deskripsi`, `identitas_keyword`, `identitas_alamat`, `identitas_notelp`, `identitas_fb`, `identitas_email`, `identitas_tw`, `identitas_gp`, `identitas_yb`, `identitas_favicon`, `identitas_author`, `identitas_created`, `identitas_updated`) VALUES
(1, 'UPPER', 'UPPER SISTEMA DE GESTI?N DE  ALMACEN', 'SISTEMA DE GESTI?N DE  ALMACEN UPPER', '569 Eren Avenue', '08123456789', 'https://www.facebook.com/CIwms', 'info@wmsmail.com', 'https://twitter.com/CIwms', 'http://CIwms.com/', 'https://www.youtube.com/wms', 'Logo Upper Logistics 1.png', 'AB-Forti Corporativo PHP - Project', '2024-02-13 22:19:42', '2024-05-06 09:29:40');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `limitstock`
--

CREATE TABLE `limitstock` (
  `limitstock_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `limitstock_created` datetime DEFAULT current_timestamp(),
  `limitstock_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `limitstock`
--

INSERT INTO `limitstock` (`limitstock_id`, `stock`, `limitstock_created`, `limitstock_updated`) VALUES
(1, 100, '2024-04-18 23:33:38', '2024-06-04 16:48:58');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `master_barang`
--

CREATE TABLE `master_barang` (
  `id_barang` int(11) NOT NULL,
  `nama_barang` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `merek` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `stock` int(11) NOT NULL,
  `barang_created` datetime NOT NULL DEFAULT current_timestamp(),
  `barang_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `master_barang`
--

INSERT INTO `master_barang` (`id_barang`, `nama_barang`, `merek`, `stock`, `barang_created`, `barang_updated`) VALUES
(13, 'Test Item', 'Test Brand', 80, '2022-01-18 18:40:31', '2022-01-18 18:42:20'),
(14, 'Art?culo 01', 'B ONE', 1, '2022-01-19 10:58:26', '2024-04-24 18:20:54'),
(15, 'Item 02', 'B ONE', 192, '2022-01-19 17:41:44', '2022-01-20 10:59:24'),
(16, 'Item 03', 'B TWO', 111, '2022-01-19 17:42:01', '2022-01-19 17:59:26'),
(17, 'Item 04', 'B THREE', 80, '2022-01-20 10:58:40', '2022-01-20 11:26:36'),
(18, 'Item 05', 'B FOUR', 268, '2022-01-20 11:20:39', '2022-01-20 11:22:16'),
(19, 'Product 101', 'Brand 101', 70, '2022-06-13 09:13:45', '2022-06-13 11:33:17'),
(20, 'Az?car', 'Marca prueba', 1933, '2024-04-25 12:16:58', '2024-06-03 13:54:49'),
(21, 'sal', 'prueba', 2603, '2024-04-29 17:35:43', '2024-05-29 15:24:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movements`
--

CREATE TABLE `movements` (
  `id_movement` int(11) NOT NULL,
  `id_pallet` int(11) NOT NULL,
  `movement_date` datetime NOT NULL,
  `movement_type` varchar(50) NOT NULL,
  `origin_location` varchar(255) DEFAULT NULL,
  `destination_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pallets`
--

CREATE TABLE `pallets` (
  `id_pallet` int(11) NOT NULL,
  `expiration_date` datetime NOT NULL,
  `status` varchar(150) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `last_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `current_location` varchar(250) NOT NULL,
  `comments` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pallet_products`
--

CREATE TABLE `pallet_products` (
  `id_pallet_product` int(11) NOT NULL,
  `id_pallet` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `product_name` varchar(250) NOT NULL,
  `description` text DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `last_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `stock` decimal(10,2) DEFAULT NULL,
  `expiration_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `session_id` varchar(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `ip_address` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `user_agent` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `user_data` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('262ed206690c8ffa8c0880853ab67ce2', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1504186814, ''),
('49e9e36170db732c7314cb317b3c899e', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1504187151, ''),
('4b6baa8cbc478d7e38395c0d7a3fc212', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 1504186981, 'a:5:{s:9:\"user_data\";s:0:\"\";s:10:\"admin_nama\";s:13:\"Administrator\";s:10:\"admin_user\";s:5:\"admin\";s:11:\"admin_level\";s:1:\"1\";s:9:\"logged_in\";b:1;}'),
('648fe333a5f0d3d2515f2a2711e1751c', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 1532611686, ''),
('8f90fd01811f1c4f981059b36f932233', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 1504186981, ''),
('9f4279bb252307cbf1d9f5d87bf88a9c', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1504186691, ''),
('aa0a60fa0dba1e30487cce20443ba358', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/66.0.3359.181 Safari/537.36', 1532679275, ''),
('aa8fa7618237d5f7cb131b5777a1e564', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.101 Safari/537.36', 1504187079, ''),
('e3deff5ffd5e90e5ba3deef2c0681ff4', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 1504187005, 'a:2:{s:9:\"user_data\";s:0:\"\";s:10:\"admin_nama\";s:13:\"Administrator\";}'),
('f622232dd0c9c866affa9648415588ab', '0.0.0.0', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.113 Safari/537.36', 1504187039, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `paternal_last_name` varchar(250) DEFAULT NULL,
  `maternal_last_name` varchar(250) DEFAULT NULL,
  `curp` varchar(250) DEFAULT NULL,
  `commercial_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `person_type` tinyint(1) NOT NULL,
  `rfc` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `street` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `num_ext` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `num_in` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `neighborhood` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `locality` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `city` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `federal_entity` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cp` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `municipality` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_by` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `modified_by` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `disablement_date` datetime NOT NULL DEFAULT current_timestamp(),
  `disablement_reason` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notelp_supplier` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `supplier_created` datetime NOT NULL DEFAULT current_timestamp(),
  `supplier_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `paternal_last_name`, `maternal_last_name`, `curp`, `commercial_name`, `person_type`, `rfc`, `street`, `num_ext`, `num_in`, `neighborhood`, `locality`, `city`, `federal_entity`, `cp`, `municipality`, `email`, `created_by`, `status`, `modified_by`, `disablement_date`, `disablement_reason`, `notelp_supplier`, `supplier_created`, `supplier_updated`) VALUES
(1, 'XYZ Suppliers', NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '2024-06-04 11:39:36', NULL, '45478540', '2022-01-18 18:39:24', '2022-01-18 18:39:24'),
(2, 'Ultimate Suppliers', NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '2024-06-04 11:39:36', NULL, '01478500', '2022-01-19 17:37:13', '2022-01-19 17:37:13'),
(3, 'Verion Supplies', NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '2024-06-04 11:39:36', NULL, '01478540', '2022-01-19 17:38:21', '2022-01-19 17:38:21'),
(4, 'Avant Suppliers', NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '2024-06-04 11:39:36', NULL, '04550010', '2022-01-19 17:39:31', '2022-01-19 17:39:31'),
(5, 'Pegasus Suppliers', NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '2024-06-04 11:39:36', NULL, '40145550', '2022-01-19 17:40:25', '2022-01-19 17:40:25'),
(6, 'QWER Suppliers', NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '2024-06-04 11:39:36', NULL, '41000140', '2022-01-20 11:19:15', '2022-01-20 11:19:15'),
(7, 'Supplier 101', NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '2024-06-04 11:39:36', NULL, '09123564789', '2022-06-13 09:14:41', '2022-06-13 09:14:41'),
(8, 'Proveedor_prueba', NULL, NULL, NULL, NULL, 0, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', '2024-06-04 11:39:36', NULL, '1234567890', '2024-04-29 13:16:36', '2024-04-29 13:17:05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transaksi_barang`
--

CREATE TABLE `transaksi_barang` (
  `id_transaksi` int(11) NOT NULL,
  `jumlah` int(50) DEFAULT NULL,
  `tanggal_transaksi` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `transaksi_updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status_pergerakan` char(1) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'pergerakan barang masuk = 1 atau keluar = 2',
  `id_barang` int(11) NOT NULL,
  `admin_user` varchar(119) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_customer` int(11) NOT NULL,
  `quantity` int(220) DEFAULT NULL,
  `pallet` int(200) DEFAULT NULL,
  `measurement_unit` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `transaksi_barang`
--

INSERT INTO `transaksi_barang` (`id_transaksi`, `jumlah`, `tanggal_transaksi`, `transaksi_updated`, `status_pergerakan`, `id_barang`, `admin_user`, `id_supplier`, `id_customer`, `quantity`, `pallet`, `measurement_unit`) VALUES
(153, 64, '2024-05-30 10:24:56', '2024-05-29 15:24:56', '1', 21, 'admin2', 8, 0, 8, 8, 'Costal'),
(154, 81, '2024-05-30 10:24:56', '2024-05-29 15:24:56', '1', 21, 'admin2', 6, 0, 9, 9, 'Kg'),
(155, 10, '2024-06-04 08:54:49', '2024-06-03 13:54:49', '2', 20, 'admin2', 0, 7, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `transport`
--

CREATE TABLE `transport` (
  `id_transport` int(11) NOT NULL,
  `platenumber` varchar(150) NOT NULL,
  `vehicletype` varchar(250) NOT NULL,
  `loadcapacity` double NOT NULL,
  `vehiclemodel` varchar(150) NOT NULL,
  `vehiclestatus` varchar(150) NOT NULL,
  `drivername` varchar(250) NOT NULL,
  `licensenumber` varchar(150) NOT NULL,
  `licenseexpiry` date NOT NULL,
  `tripnumber` varchar(250) NOT NULL,
  `departureDate` datetime NOT NULL,
  `arrivaldate` datetime NOT NULL,
  `origin` varchar(250) NOT NULL,
  `destination` varchar(250) NOT NULL,
  `route` text NOT NULL,
  `tripstatus` varchar(150) NOT NULL,
  `notes` text NOT NULL,
  `attachments` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `transport`
--

INSERT INTO `transport` (`id_transport`, `platenumber`, `vehicletype`, `loadcapacity`, `vehiclemodel`, `vehiclestatus`, `drivername`, `licensenumber`, `licenseexpiry`, `tripnumber`, `departureDate`, `arrivaldate`, `origin`, `destination`, `route`, `tripstatus`, `notes`, `attachments`) VALUES
(1, 'SI28A47S', 'Camión', 6, 'Carrier Transicold', 'activo', 'Juan Chávez', '1254d44d52f22', '2024-06-23', '1', '2024-05-24 15:00:00', '2024-05-25 15:01:00', 'Ciudad de México', 'Ciudad de Querétaro', 'Autopista México- Querétaro.', 'en_curso', 'Revisar arribo', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_user`),
  ADD KEY `admin_level_kode` (`admin_level_kode`);

--
-- Indices de la tabla `admin_level`
--
ALTER TABLE `admin_level`
  ADD PRIMARY KEY (`admin_level_kode`);

--
-- Indices de la tabla `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id_customer`);

--
-- Indices de la tabla `fractionations`
--
ALTER TABLE `fractionations`
  ADD PRIMARY KEY (`id_fractionation`),
  ADD KEY `id_origin_pallet` (`id_origin_pallet`),
  ADD KEY `id_destination_pallet` (`id_destination_pallet`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `identitas`
--
ALTER TABLE `identitas`
  ADD PRIMARY KEY (`identitas_id`);

--
-- Indices de la tabla `limitstock`
--
ALTER TABLE `limitstock`
  ADD PRIMARY KEY (`limitstock_id`);

--
-- Indices de la tabla `master_barang`
--
ALTER TABLE `master_barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indices de la tabla `movements`
--
ALTER TABLE `movements`
  ADD PRIMARY KEY (`id_movement`),
  ADD KEY `id_pallet` (`id_pallet`);

--
-- Indices de la tabla `pallets`
--
ALTER TABLE `pallets`
  ADD PRIMARY KEY (`id_pallet`);

--
-- Indices de la tabla `pallet_products`
--
ALTER TABLE `pallet_products`
  ADD PRIMARY KEY (`id_pallet_product`),
  ADD KEY `id_pallet` (`id_pallet`),
  ADD KEY `id_product` (`id_product`);

--
-- Indices de la tabla `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `last_activity_idx` (`last_activity`);

--
-- Indices de la tabla `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indices de la tabla `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  ADD PRIMARY KEY (`id_transaksi`);

--
-- Indices de la tabla `transport`
--
ALTER TABLE `transport`
  ADD PRIMARY KEY (`id_transport`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin_level`
--
ALTER TABLE `admin_level`
  MODIFY `admin_level_kode` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `customer`
--
ALTER TABLE `customer`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `fractionations`
--
ALTER TABLE `fractionations`
  MODIFY `id_fractionation` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `identitas`
--
ALTER TABLE `identitas`
  MODIFY `identitas_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `limitstock`
--
ALTER TABLE `limitstock`
  MODIFY `limitstock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `master_barang`
--
ALTER TABLE `master_barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `movements`
--
ALTER TABLE `movements`
  MODIFY `id_movement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pallets`
--
ALTER TABLE `pallets`
  MODIFY `id_pallet` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pallet_products`
--
ALTER TABLE `pallet_products`
  MODIFY `id_pallet_product` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `transaksi_barang`
--
ALTER TABLE `transaksi_barang`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT de la tabla `transport`
--
ALTER TABLE `transport`
  MODIFY `id_transport` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `fractionations`
--
ALTER TABLE `fractionations`
  ADD CONSTRAINT `fractionations_ibfk_1` FOREIGN KEY (`id_origin_pallet`) REFERENCES `pallets` (`id_pallet`),
  ADD CONSTRAINT `fractionations_ibfk_2` FOREIGN KEY (`id_destination_pallet`) REFERENCES `pallets` (`id_pallet`),
  ADD CONSTRAINT `fractionations_ibfk_3` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Filtros para la tabla `movements`
--
ALTER TABLE `movements`
  ADD CONSTRAINT `movements_ibfk_1` FOREIGN KEY (`id_pallet`) REFERENCES `pallets` (`id_pallet`);

--
-- Filtros para la tabla `pallet_products`
--
ALTER TABLE `pallet_products`
  ADD CONSTRAINT `pallet_products_ibfk_1` FOREIGN KEY (`id_pallet`) REFERENCES `pallets` (`id_pallet`),
  ADD CONSTRAINT `pallet_products_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
