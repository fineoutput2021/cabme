-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2022 at 12:55 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_cabme`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_sidebar`
--

CREATE TABLE `tbl_admin_sidebar` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(2000) NOT NULL,
  `sequence` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_sidebar`
--

INSERT INTO `tbl_admin_sidebar` (`id`, `name`, `url`, `sequence`) VALUES
(1, 'Dashboard', 'home', 1),
(2, 'Team', '#', 2),
(5, 'Banner', 'Banner/view_banner', 4),
(6, 'Users', 'Users/view_users', 9),
(10, 'Order', '#', 8),
(11, 'Promocode', 'Promocode/view_promocode', 10),
(21, 'City', 'City/view_cities', 0),
(22, 'Self_drive', 'Self_drive/view_selfdrive', 0),
(23, 'Outstation', 'Outstation/View_outstation', 0),
(24, 'Intercity', 'Intercity/View_intercity', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin_sidebar2`
--

CREATE TABLE `tbl_admin_sidebar2` (
  `id` int(11) NOT NULL,
  `main_id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin_sidebar2`
--

INSERT INTO `tbl_admin_sidebar2` (`id`, `main_id`, `name`, `url`) VALUES
(1, 2, 'View Team', 'system/view_team'),
(2, 2, 'Add Team', 'system/add_team'),
(3, 10, 'New orders', 'Order/placed_order'),
(4, 10, 'Confirmed Orders', 'Order/confirmed_order'),
(5, 10, 'Dispatched order', 'Order/dispatched_order'),
(6, 10, 'Delievered order', 'Order/delievered_order'),
(7, 10, 'Rejected order', 'Order/cancelled_order');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `id` int(11) NOT NULL,
  `photo1` text NOT NULL,
  `photo2` text NOT NULL,
  `ip` varchar(100) NOT NULL,
  `added_by` int(100) NOT NULL,
  `is_active` int(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_banner`
--

INSERT INTO `tbl_banner` (`id`, `photo1`, `photo2`, `ip`, `added_by`, `is_active`, `date`) VALUES
(16, 'assets/uploads/banner/banner20220909050951.jpeg', 'assets/uploads/banner/banner220220909050951.jpeg', '', 0, 1, ''),
(17, 'assets/uploads/banner/banner20220912030948.jpg', 'assets/uploads/banner/banner220220909050932.jpg', '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

CREATE TABLE `tbl_cities` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `city_type` varchar(200) DEFAULT NULL,
  `photo` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`id`, `name`, `city_type`, `photo`, `status`, `is_active`) VALUES
(5, 'tseste', '1', 'assets/uploads/cities/category20220909050913.jpg', 0, 1),
(6, 'ramesh', '1', 'assets/uploads/cities/category20220909050952.jpeg', 0, 1),
(8, 'sonu singh', '2', 'assets/uploads/cities/category20220912030900.jpg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_intercity`
--

CREATE TABLE `tbl_intercity` (
  `id` int(11) NOT NULL,
  `cab_type` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `Kilomitere_cab` int(11) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_intercity`
--

INSERT INTO `tbl_intercity` (`id`, `cab_type`, `price`, `Kilomitere_cab`, `min_amount`, `is_active`) VALUES
(11, '1', 20000, 10, 1500, 1),
(12, '2', 20000, 50, 1500, 1),
(13, '3', 20000, 20, 1500, 1),
(14, '1', 20000, 20, 1500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order1`
--

CREATE TABLE `tbl_order1` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `promocode` int(11) DEFAULT NULL,
  `promo_discount` int(11) DEFAULT NULL,
  `final_amount` varchar(255) DEFAULT NULL,
  `shipping` varchar(255) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL COMMENT '1 for COD , 2 for online payment',
  `payment_status` int(11) DEFAULT NULL COMMENT '0 for pending , 1 for succeed',
  `order_status` int(11) DEFAULT NULL COMMENT '1 for orderPlaced , 2 for orderConfirmed , 3 for orderDispatched , 4 for orderDelivered , 5 for rejected, 6 for cancelled by user ',
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `gstin` varchar(255) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order1`
--

INSERT INTO `tbl_order1` (`id`, `user_id`, `total_amount`, `promocode`, `promo_discount`, `final_amount`, `shipping`, `payment_type`, `payment_status`, `order_status`, `name`, `phone`, `pincode`, `email`, `address`, `state`, `gstin`, `txnid`, `remarks`, `ip`, `date`) VALUES
(1, 1, 1200, 1, 150, '1050', NULL, 1, 1, 4, 'Name', '1234567890', '302020', 'name@email.ciom', NULL, NULL, NULL, NULL, NULL, NULL, '2021-08-10 00:00:00'),
(5, 3, 222, NULL, NULL, '222', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-02 15:42:58'),
(6, 4, 94, NULL, NULL, '94', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-02 15:43:19'),
(7, 3, 222, NULL, NULL, '222', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-02 15:44:48'),
(8, 3, 222, NULL, NULL, '222', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-02 15:45:34'),
(9, 5, 44, NULL, NULL, '44', NULL, 1, 1, 5, 'tw', '1222222222', '122222', 'two@gmail.com', 'jaipur', NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-02 15:51:10'),
(10, 5, 66, NULL, NULL, '66', NULL, 1, 1, 2, 'narendra', '1222222222', '122222', 'narendra@gmail.com', 'sodala', NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-02 16:22:08'),
(11, 5, 44, NULL, NULL, '44', NULL, 1, 1, 2, 'raaj', '1333333333', '133333', 'raaj@gmail.com', 'ramnagar', NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-02 16:38:04'),
(12, 5, 44, NULL, NULL, '44', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-02 16:38:31'),
(13, 7, 95, NULL, NULL, '95', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 11:51:03'),
(14, 7, 371, NULL, NULL, '371', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 12:11:50'),
(15, 7, 1380, NULL, NULL, '1380', NULL, 1, 1, 5, 'mmm', '1111111111', '111111', 'mmm@gmail.com', 'house1', '12jaipur', NULL, NULL, NULL, '49.204.165.255', '2022-07-04 12:19:37'),
(16, 7, 44, NULL, NULL, '44', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 12:23:27'),
(17, 8, 44, NULL, NULL, '44', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 13:07:21'),
(18, 8, 7820, 7, 60, '7760', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 13:10:05'),
(19, 8, 1166, 7, 60, '1106', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 13:11:54'),
(20, 8, 194, 7, 33, '161.02', NULL, 1, 1, 1, 'ON', '4444444444', '444455', 'ON@GDFG.COM', 'RAM', 'SHAYM', NULL, NULL, NULL, '49.204.165.255', '2022-07-04 13:15:02'),
(21, 8, 194, NULL, NULL, '194', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 13:16:26'),
(22, 8, 293, NULL, NULL, '293', NULL, 1, 1, 1, 'cvcx', '1222211111', '111111', 'cxv@h.com', 'dsfds', 'fds', NULL, NULL, NULL, '49.204.165.255', '2022-07-04 14:56:59'),
(23, 8, 194, NULL, NULL, '194', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 15:05:09'),
(24, 8, 194, NULL, NULL, '194', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 15:10:54'),
(25, 8, 1060, NULL, NULL, '1110', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 19:18:20'),
(26, 8, 1166, NULL, NULL, '1216.4', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-04 19:23:16'),
(27, 8, 1166, NULL, NULL, '1216.4', NULL, 1, 1, 2, 'gjgfh', '1111111111', '302019', 'fdg@g.com', 'dfdsf', 'sdfes', NULL, NULL, NULL, '49.204.165.255', '2022-07-04 19:26:58'),
(28, 8, 1173, NULL, NULL, '1223', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-05 10:40:17'),
(29, 8, 1173, NULL, NULL, '1223', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-05 10:42:13'),
(30, 12, 1012, NULL, NULL, '1062.2', NULL, 1, 1, 1, 'Son goku', '7014224653', '302019', 'goku@gmail.com', 'new sanganer road sodala jaipur', 'Rajasthan', NULL, NULL, NULL, '49.204.165.255', '2022-07-05 15:28:40'),
(31, 12, 1181, NULL, NULL, '1231.4', NULL, 1, 1, 1, 'vegeta sama', '7014224653', '302019', 'vegeta@gmail.com', 'new sanganer road sodala', 'rajasthan', NULL, NULL, NULL, '49.204.165.255', '2022-07-05 15:40:48'),
(32, 12, 1092, NULL, NULL, '1142', NULL, 1, 1, 4, 'vegeta', '7014224653', '302019', 'vegeta@gmail.com', 'new sanganer road', 'rajasthan', NULL, NULL, NULL, '49.204.165.255', '2022-07-05 16:35:36'),
(33, 12, 1204, 6, 150, '1104.05', NULL, 1, 1, 1, 'vegeta', '7014823628', '201020', 'vegeta@gmail.com', 'new sanaganer', 'rajasthan', NULL, NULL, NULL, '49.204.165.255', '2022-07-05 17:09:15'),
(34, 12, 1183, NULL, NULL, '1232.5', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-05 17:21:52'),
(35, 2, 1212, 7, 60, '1201.5', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '49.204.165.255', '2022-07-05 17:59:14'),
(36, 2, 1996, NULL, NULL, '1996', NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-07-07 17:07:56'),
(37, 1, 1028, 0, 0, '1077.95', '50', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-07-13 00:13:54'),
(38, 2, 1996, NULL, NULL, '2045.5', '50', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-07-13 10:58:53'),
(39, 2, 1996, NULL, NULL, '2045.5', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302020', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-13 12:35:21'),
(40, 2, 1078, NULL, NULL, '1127.6', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302020', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-13 12:39:43'),
(41, 2, 1088, NULL, NULL, '1137.8', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302021', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-13 12:49:18'),
(42, 2, 2476, NULL, NULL, '2525.9', '50', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-07-13 14:02:02'),
(43, 2, 2476, 6, 150, '2825.9', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302021', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-14 17:22:54'),
(44, 2, 1178, NULL, NULL, '1227.6', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302021', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-14 17:24:50'),
(45, 2, 1078, NULL, NULL, '1127.6', '50', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-07-14 17:25:09'),
(46, 2, 1078, NULL, NULL, '1127.6', '50', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-07-14 17:26:50'),
(47, 2, 1078, NULL, NULL, '1127.6', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302021', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-14 17:30:47'),
(48, 2, 1078, NULL, NULL, '1127.6', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302021', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-14 17:35:11'),
(49, 2, 1072, NULL, NULL, '1122', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302021', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-14 17:44:05'),
(50, 2, 1072, 0, 0, '1182', '50', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-07-14 17:45:43'),
(51, 2, 1072, 0, 0, '1272', '50', NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-07-14 17:52:28'),
(52, 2, 1072, 6, 150, '972', '50', 1, 1, 1, 'Divyanshu', '8237462178', '302012', 'dhoom.fineoutput@gmail.com', 'demo19, Jaipur', 'rajathan', NULL, NULL, NULL, '::1', '2022-07-14 18:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order2`
--

CREATE TABLE `tbl_order2` (
  `id` int(100) NOT NULL,
  `main_id` varchar(100) NOT NULL,
  `product_id` int(100) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `quantity` varchar(100) NOT NULL,
  `mrp` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `spgst` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_order2`
--

INSERT INTO `tbl_order2` (`id`, `main_id`, `product_id`, `type_id`, `product_name`, `quantity`, `mrp`, `selling_price`, `total_amount`, `date`, `gst`, `spgst`) VALUES
(1, '1', 5, 4, 'Surf', '3', '250', '200', '600', '2021-08-10 00:00:00', '8', '194.4'),
(2, '1', 4, 2, 'Amul Butter', '1', '630', '600', '600', '2021-08-10 00:00:00', '8', '194.4'),
(3, '5', 7, 14, NULL, '2', '200', '111', '222', '2022-07-02 15:42:58', NULL, NULL),
(4, '6', 4, 2, NULL, '1', '100', '93.6', '93.6', '2022-07-02 15:43:19', NULL, NULL),
(5, '7', 7, 14, NULL, '2', '200', '111', '222', '2022-07-02 15:44:48', NULL, NULL),
(6, '8', 7, 14, NULL, '2', '200', '111', '222', '2022-07-02 15:45:34', NULL, NULL),
(7, '9', 1, 3, NULL, '1', '50', '44', '44', '2022-07-02 15:50:23', NULL, NULL),
(8, '10', 1, 3, NULL, '1', '100', '66', '66', '2022-07-02 16:21:29', NULL, NULL),
(9, '11', 6, 8, NULL, '1', '50', '44', '44', '2022-07-02 16:35:57', NULL, NULL),
(10, '12', 6, 8, NULL, '1', '50', '44', '44', '2022-07-02 16:38:31', NULL, NULL),
(11, '13', 3, 1, NULL, '1', '100', '94.5', '94.5', '2022-07-04 11:51:03', NULL, NULL),
(12, '14', 3, 1, NULL, '1', '100', '94.5', '94.5', '2022-07-04 12:11:50', NULL, NULL),
(13, '14', 7, 15, NULL, '1', '300', '165', '165', '2022-07-04 12:11:50', NULL, NULL),
(14, '14', 7, 14, NULL, '1', '200', '111', '111', '2022-07-04 12:11:50', NULL, NULL),
(15, '15', 7, 14, NULL, '5', '200', '111', '555', '2022-07-04 12:17:05', NULL, NULL),
(16, '15', 7, 15, NULL, '5', '300', '165', '825', '2022-07-04 12:17:05', NULL, NULL),
(17, '16', 6, 8, NULL, '1', '50', '44', '44', '2022-07-04 12:23:27', NULL, NULL),
(18, '17', 6, 8, NULL, '1', '50', '44', '44', '2022-07-04 13:07:21', NULL, NULL),
(19, '18', 6, 8, NULL, '1', '50', '44', '44', '2022-07-04 13:10:05', NULL, NULL),
(20, '18', 5, 4, NULL, '40', '200', '194.4', '7776', '2022-07-04 13:10:05', NULL, NULL),
(21, '19', 5, 4, NULL, '6', '200', '194.4', '1166.4', '2022-07-04 13:11:54', NULL, NULL),
(22, '20', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-04 13:13:21', NULL, NULL),
(23, '21', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-04 13:16:26', NULL, NULL),
(24, '22', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-04 14:56:29', NULL, NULL),
(25, '22', 1, 3, NULL, '1', '100', '99', '99', '2022-07-04 14:56:29', NULL, NULL),
(26, '23', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-04 15:05:09', NULL, NULL),
(27, '24', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-04 15:10:54', NULL, NULL),
(28, '25', 5, 4, NULL, '5', '200', '194.4', '972', '2022-07-04 19:18:20', NULL, NULL),
(29, '25', 6, 8, NULL, '2', '50', '44', '88', '2022-07-04 19:18:20', NULL, NULL),
(30, '26', 5, 4, NULL, '6', '200', '194.4', '1166.4', '2022-07-04 19:23:16', NULL, NULL),
(31, '27', 5, 4, NULL, '6', '200', '194.4', '1166.4', '2022-07-04 19:26:37', NULL, NULL),
(32, '28', 7, 14, NULL, '7', '200', '111', '777', '2022-07-05 10:40:17', NULL, NULL),
(33, '28', 1, 3, NULL, '4', '100', '99', '396', '2022-07-05 10:40:17', NULL, NULL),
(34, '29', 7, 14, NULL, '7', '200', '111', '777', '2022-07-05 10:42:13', NULL, NULL),
(35, '29', 1, 3, NULL, '4', '100', '99', '396', '2022-07-05 10:42:13', NULL, NULL),
(36, '30', 5, 4, NULL, '3', '200', '194.4', '583.2', '2022-07-05 15:27:03', NULL, NULL),
(37, '30', 1, 3, NULL, '3', '100', '99', '297', '2022-07-05 15:27:03', NULL, NULL),
(38, '30', 6, 8, NULL, '3', '50', '44', '132', '2022-07-05 15:27:03', NULL, NULL),
(39, '31', 4, 2, NULL, '4', '100', '93.6', '374.4', '2022-07-05 15:38:09', NULL, NULL),
(40, '31', 3, 1, NULL, '4', '100', '94.5', '378', '2022-07-05 15:38:09', NULL, NULL),
(41, '31', 6, 8, NULL, '3', '50', '44', '132', '2022-07-05 15:38:09', NULL, NULL),
(42, '31', 1, 3, NULL, '3', '100', '99', '297', '2022-07-05 15:38:09', NULL, NULL),
(43, '32', 15, 23, NULL, '7', '35', '24.15', '169.05', '2022-07-05 16:34:59', NULL, NULL),
(44, '32', 13, 21, NULL, '7', '40', '29.4', '205.8', '2022-07-05 16:34:59', NULL, NULL),
(45, '32', 14, 22, NULL, '5', '35', '24.15', '120.75', '2022-07-05 16:34:59', NULL, NULL),
(46, '32', 10, 17, NULL, '8', '40', '30.45', '243.6', '2022-07-05 16:34:59', NULL, NULL),
(47, '32', 10, 18, NULL, '7', '60', '50.4', '352.8', '2022-07-05 16:34:59', NULL, NULL),
(48, '33', 11, 19, NULL, '1', '85', '54.6', '54.6', '2022-07-05 17:07:19', NULL, NULL),
(49, '33', 12, 20, NULL, '1', '90', '57.75', '57.75', '2022-07-05 17:07:19', NULL, NULL),
(50, '33', 13, 21, NULL, '1', '40', '29.4', '29.4', '2022-07-05 17:07:19', NULL, NULL),
(51, '33', 14, 22, NULL, '1', '35', '24.15', '24.15', '2022-07-05 17:07:19', NULL, NULL),
(52, '33', 15, 23, NULL, '1', '35', '24.15', '24.15', '2022-07-05 17:07:19', NULL, NULL),
(53, '33', 17, 25, NULL, '1', '45', '42', '42', '2022-07-05 17:07:19', NULL, NULL),
(54, '33', 5, 4, NULL, '5', '200', '194.4', '972', '2022-07-05 17:07:19', NULL, NULL),
(55, '34', 6, 8, NULL, '19', '50', '44', '836', '2022-07-05 17:21:52', NULL, NULL),
(56, '34', 12, 20, NULL, '6', '90', '57.75', '346.5', '2022-07-05 17:21:52', NULL, NULL),
(57, '35', 6, 8, NULL, '14', '50', '44', '616', '2022-07-05 17:59:14', NULL, NULL),
(58, '35', 10, 17, NULL, '6', '40', '30.45', '182.7', '2022-07-05 17:59:14', NULL, NULL),
(59, '35', 11, 19, NULL, '4', '85', '54.6', '218.4', '2022-07-05 17:59:14', NULL, NULL),
(60, '35', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-05 17:59:14', NULL, NULL),
(61, '36', 6, 8, NULL, '14', '50', '100', '1400', '2022-07-07 17:07:56', NULL, NULL),
(62, '36', 10, 17, NULL, '6', '40', '30.45', '182.7', '2022-07-07 17:07:56', NULL, NULL),
(63, '36', 11, 19, NULL, '4', '85', '54.6', '218.4', '2022-07-07 17:07:56', NULL, NULL),
(64, '36', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-07 17:07:56', NULL, NULL),
(65, '37', 15, 23, NULL, '17', '35', '24.15', '410.55', '2022-07-13 00:13:54', NULL, NULL),
(66, '37', 17, 25, NULL, '7', '45', '42', '294', '2022-07-13 00:13:54', NULL, NULL),
(67, '37', 13, 21, NULL, '11', '40', '29.4', '323.4', '2022-07-13 00:13:54', NULL, NULL),
(68, '38', 6, 8, NULL, '14', '50', '100', '1400', '2022-07-13 10:58:53', NULL, NULL),
(69, '38', 10, 17, NULL, '6', '40', '30.45', '182.7', '2022-07-13 10:58:53', NULL, NULL),
(70, '38', 11, 19, NULL, '4', '85', '54.6', '218.4', '2022-07-13 10:58:53', NULL, NULL),
(71, '38', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-13 10:58:53', NULL, NULL),
(72, '39', 6, 8, NULL, '14', '50', '100', '1400', '2022-07-13 12:33:57', NULL, NULL),
(73, '39', 10, 17, NULL, '6', '40', '30.45', '182.7', '2022-07-13 12:33:57', NULL, NULL),
(74, '39', 11, 19, NULL, '4', '85', '54.6', '218.4', '2022-07-13 12:33:57', NULL, NULL),
(75, '39', 5, 4, NULL, '1', '200', '194.4', '194.4', '2022-07-13 12:33:57', NULL, NULL),
(76, '40', 5, 4, NULL, '4', '200', '194.4', '777.6', '2022-07-13 12:39:22', NULL, NULL),
(77, '40', 6, 8, NULL, '3', '50', '100', '300', '2022-07-13 12:39:22', NULL, NULL),
(78, '41', 10, 17, NULL, '16', '40', '30.45', '487.2', '2022-07-13 12:48:49', NULL, NULL),
(79, '41', 11, 19, NULL, '11', '85', '54.6', '600.6', '2022-07-13 12:48:49', NULL, NULL),
(80, '42', 10, 17, NULL, '22', '40', '30.45', '669.9', '2022-07-13 14:02:02', NULL, NULL),
(81, '42', 11, 19, NULL, '21', '85', '54.6', '1146.6', '2022-07-13 14:02:02', NULL, NULL),
(82, '42', 13, 21, NULL, '1', '40', '29.4', '29.4', '2022-07-13 14:02:02', NULL, NULL),
(83, '42', 17, 25, NULL, '15', '45', '42', '630', '2022-07-13 14:02:02', NULL, NULL),
(84, '43', 10, 17, NULL, '22', '40', '30.45', '669.9', '2022-07-14 17:05:06', NULL, NULL),
(85, '43', 11, 19, NULL, '21', '85', '54.6', '1146.6', '2022-07-14 17:05:06', NULL, NULL),
(86, '43', 13, 21, NULL, '1', '40', '29.4', '29.4', '2022-07-14 17:05:06', NULL, NULL),
(87, '43', 17, 25, NULL, '15', '45', '42', '630', '2022-07-14 17:05:06', NULL, NULL),
(88, '44', 6, 8, NULL, '4', '50', '100', '400', '2022-07-14 17:24:25', NULL, NULL),
(89, '44', 5, 4, NULL, '4', '200', '194.4', '777.6', '2022-07-14 17:24:25', NULL, NULL),
(90, '45', 6, 8, NULL, '3', '50', '100', '300', '2022-07-14 17:25:09', NULL, NULL),
(91, '45', 5, 4, NULL, '4', '200', '194.4', '777.6', '2022-07-14 17:25:09', NULL, NULL),
(92, '46', 6, 8, NULL, '3', '50', '100', '300', '2022-07-14 17:26:50', NULL, NULL),
(93, '46', 5, 4, NULL, '4', '200', '194.4', '777.6', '2022-07-14 17:26:50', NULL, NULL),
(94, '47', 6, 8, NULL, '3', '50', '100', '300', '2022-07-14 17:28:04', NULL, NULL),
(95, '47', 5, 4, NULL, '4', '200', '194.4', '777.6', '2022-07-14 17:28:04', NULL, NULL),
(96, '48', 6, 8, NULL, '3', '50', '100', '300', '2022-07-14 17:35:07', NULL, NULL),
(97, '48', 5, 4, NULL, '4', '200', '194.4', '777.6', '2022-07-14 17:35:07', NULL, NULL),
(98, '49', 6, 8, NULL, '1', '50', '100', '100', '2022-07-14 17:43:59', NULL, NULL),
(99, '49', 5, 4, NULL, '5', '200', '194.4', '972', '2022-07-14 17:43:59', NULL, NULL),
(100, '50', 6, 8, NULL, '1', '50', '100', '100', '2022-07-14 17:45:43', NULL, NULL),
(101, '50', 5, 4, NULL, '5', '200', '194.4', '972', '2022-07-14 17:45:43', NULL, NULL),
(102, '51', 6, 8, NULL, '1', '50', '100', '100', '2022-07-14 17:52:28', NULL, NULL),
(103, '51', 5, 4, NULL, '5', '200', '194.4', '972', '2022-07-14 17:52:28', NULL, NULL),
(104, '52', 6, 8, NULL, '1', '50', '100', '100', '2022-07-14 17:58:12', NULL, NULL),
(105, '52', 5, 4, NULL, '5', '200', '194.4', '972', '2022-07-14 17:58:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

CREATE TABLE `tbl_otp` (
  `id` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `otp` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `temp_id` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_otp`
--

INSERT INTO `tbl_otp` (`id`, `phone`, `otp`, `status`, `temp_id`, `ip`, `date`) VALUES
(1, '00000', '123456', 1, 1, '::1', '2022-04-19 16:31:32'),
(2, '00000', '123456', 1, 0, '::1', '2022-04-22 15:40:09'),
(3, '000000', '123456', 1, 2, '::1', '2022-04-22 15:45:25'),
(4, '00000', '123456', 1, 0, '::1', '2022-04-22 16:42:41'),
(5, '00000', '123456', 1, 0, '::1', '2022-04-22 17:33:01'),
(6, '000000', '123456', 1, 0, '::1', '2022-04-26 16:08:13'),
(7, '00000', '123456', 1, 0, '::1', '2022-05-03 10:25:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_outstation`
--

CREATE TABLE `tbl_outstation` (
  `id` int(11) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `car_name` varchar(200) NOT NULL,
  `seatting` varchar(200) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `per_kilometre` int(11) NOT NULL,
  `location` varchar(20) NOT NULL,
  `city_id` int(11) NOT NULL,
  `is_active` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_outstation`
--

INSERT INTO `tbl_outstation` (`id`, `brand_name`, `car_name`, `seatting`, `photo`, `per_kilometre`, `location`, `city_id`, `is_active`) VALUES
(10, 'sonu', 'thar', '69', 'assets/uploads/outstation/category20220912010946.jpg', 0, '20', 5, 1),
(11, 'f', 'thar', '69', 'assets/uploads/outstation/category20220912010955.jpg', 10, '20', 6, 1),
(15, 'sonu', 'thar', '69', 'assets/uploads/outstation/category20220912030926.jpg', 10, '20', 8, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_percentage`
--

CREATE TABLE `tbl_percentage` (
  `id` int(11) NOT NULL,
  `percentage` int(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `is_active` int(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_percentage`
--

INSERT INTO `tbl_percentage` (`id`, `percentage`, `ip`, `added_by`, `is_active`, `date`) VALUES
(1, 16, '::1', '19', 1, '2022-07-18 16:41:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promocode`
--

CREATE TABLE `tbl_promocode` (
  `id` int(11) NOT NULL,
  `promocode` varchar(255) NOT NULL,
  `percentage` int(11) NOT NULL,
  `ptype` varchar(255) DEFAULT NULL,
  `start_date` text NOT NULL,
  `end_date` text NOT NULL,
  `mindays` varchar(200) NOT NULL,
  `giftpercent` varchar(255) NOT NULL,
  `expiry` varchar(100) NOT NULL,
  `minorder` varchar(255) NOT NULL,
  `max` varchar(255) NOT NULL,
  `ip` varchar(300) NOT NULL,
  `added_by` varchar(1111) NOT NULL,
  `is_active` varchar(200) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_promocode`
--

INSERT INTO `tbl_promocode` (`id`, `promocode`, `percentage`, `ptype`, `start_date`, `end_date`, `mindays`, `giftpercent`, `expiry`, `minorder`, `max`, `ip`, `added_by`, `is_active`, `date`) VALUES
(5, 'NEWUSER', 0, '1', '', '', '', '8', '2022-10-14', '500', '50', '49.204.164.251', '19', '1', '2022-06-10 15:32:00'),
(6, 'ONETEST', 0, '2', '', '', '', '16', '2022-11-19', '100', '150', '49.204.165.255', '19', '1', '2022-07-02 16:53:55'),
(8, 'rtvrt', 10, '1', '2022-09-23', '2022-10-02', '10', '', '', '', '20', '127.0.0.1', '19', '1', '2022-09-09 12:33:26'),
(9, 'sonu', 50, '2', '2022-09-21', '2022-09-30', '12', '', '', '', '10', '127.0.0.1', '19', '1', '2022-09-09 15:30:31');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_selfdrive`
--

CREATE TABLE `tbl_selfdrive` (
  `id` int(11) NOT NULL,
  `city_id` varchar(100) NOT NULL,
  `brand_name` varchar(200) NOT NULL,
  `car_name` varchar(200) NOT NULL,
  `photo` text NOT NULL,
  `fule_type` varchar(20) NOT NULL,
  `transmission` varchar(200) NOT NULL,
  `seatting` varchar(200) NOT NULL,
  `kilometer1` int(11) NOT NULL,
  `price1` int(11) NOT NULL,
  `kilometer2` int(11) NOT NULL,
  `price2` int(11) NOT NULL,
  `kilometer3` int(11) NOT NULL,
  `price3` int(11) NOT NULL,
  `extra_kilo` int(11) NOT NULL,
  `rsda` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_selfdrive`
--

INSERT INTO `tbl_selfdrive` (`id`, `city_id`, `brand_name`, `car_name`, `photo`, `fule_type`, `transmission`, `seatting`, `kilometer1`, `price1`, `kilometer2`, `price2`, `kilometer3`, `price3`, `extra_kilo`, `rsda`, `is_active`) VALUES
(15, '5', 'sonu', 'thar', 'assets/uploads/self_drive/category20220912040950.jpg', '2', '1', 'rht', 0, 0, 0, 0, 0, 0, 0, 0, 1),
(16, '6', 'sonu', 'odddi', 'assets/uploads/self_drive/category20220912040902.jpg', '1', '2', 'frfr', 0, 0, 0, 0, 0, 4, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `id` int(11) NOT NULL,
  `category_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `added_by` int(100) NOT NULL,
  `is_active` int(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`id`, `category_id`, `name`, `ip`, `added_by`, `is_active`, `date`) VALUES
(1, '4', 'Bodycon Midi Dress', '::1', 19, 1, '2022-06-07 10:22:35'),
(4, '5', 'shift midi dress', '::1', 19, 1, '2022-06-07 10:24:02'),
(5, '4', 'Soring  midi dress', '::1', 19, 1, '2022-06-07 10:24:54'),
(6, '6', 'Lace Midi Dress. .', '::1', 19, 1, '2022-06-07 10:25:10'),
(8, '7', 'midi dress bodycon', '::1', 19, 1, '2022-06-07 10:25:47'),
(14, '15', 'a-line spring', '49.204.165.255', 19, 1, '2022-07-05 15:54:50'),
(15, '15', 'a_line summer', '49.204.165.255', 19, 1, '2022-07-05 15:55:01');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_team`
--

CREATE TABLE `tbl_team` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(2000) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `power` int(11) NOT NULL,
  `services` varchar(1000) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `date` varchar(100) NOT NULL,
  `added_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_team`
--

INSERT INTO `tbl_team` (`id`, `name`, `email`, `password`, `phone`, `address`, `image`, `power`, `services`, `ip`, `date`, `added_by`, `is_active`) VALUES
(1, 'Anay Pareek', 'anaypareek@rocketmail.com', '9ffd3dfaf18c6c0dededaba5d7db9375', '9799655891', '19 kalyanpuri new sanganer road sodala', '', 1, '[\"999\"]', '1000000', '16-05-2018', 1, 1),
(19, 'Demo', 'demo@gmail.com', '202cb962ac59075b964b07152d234b70', '9999999999', 'jaipur', '', 1, '[\"999\"]', '::1', '2022-07-15 18:09:10', 19, 1),
(29, 'Animesh Sharma', 'animesh.skyline@gmail.com', '8bda6fe26dad2b31f9cb9180ec3823e8', '8441849182', 'pratap nagar sitapura jaipur', '', 2, '[\"999\"]', '::1', '2020-01-06 14:47:11', 1, 1),
(30, 'A', 'aa@gmail.com', '202cb962ac59075b964b07152d234b70', '', '', '', 3, '[\"1\",\"4\",\"5\",\"9\"]', '::1', '2022-06-09 13:33:25', 19, 1),
(31, 'Ns', 'ns@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9649230623', 'ram nagar', '', 2, '[\"1\",\"2\",\"4\"]', '49.204.164.251', '2022-06-10 15:14:45', 19, 1),
(32, 'karan', 'karan@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '9649230623', 'dfgfdg', '', 2, '[\"1\",\"4\"]', '49.204.164.251', '2022-06-10 18:09:23', 19, 1),
(33, 'narendra', 'narendra@gmail.com', 'bfd925fa86084bd0300fde7fd05ddd97', '9649230623', 'mhghjg', 'team20220613100622.jpg', 2, '[\"4\",\"5\"]', '49.204.164.251', '2022-06-13 16:07:22', 19, 1),
(35, 'manthan', 'dhsdj@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', '7070707070', 'knhsfjkdhfhj', 'assets/uploads/team/team20220715060749.jpg', 3, '[\"5\",\"6\"]', '::1', '2022-07-15 18:10:56', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ip` int(100) DEFAULT NULL,
  `is_active` int(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `f_name`, `l_name`, `phone`, `ip`, `is_active`, `date`) VALUES
(2, 'Brain', 'Storm', '6377687630', NULL, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_temp`
--

CREATE TABLE `tbl_user_temp` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_temp`
--

INSERT INTO `tbl_user_temp` (`id`, `name`, `phone`, `image`, `ip`, `date`) VALUES
(1, ']New test', '00000', '', '::1', '2022-04-19 16:31:32'),
(2, 'Test', '000000', 'assets/uploads/users/users20220422030425.jpg', '::1', '2022-04-22 15:45:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin_sidebar`
--
ALTER TABLE `tbl_admin_sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admin_sidebar2`
--
ALTER TABLE `tbl_admin_sidebar2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_intercity`
--
ALTER TABLE `tbl_intercity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order1`
--
ALTER TABLE `tbl_order1`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order2`
--
ALTER TABLE `tbl_order2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_outstation`
--
ALTER TABLE `tbl_outstation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_percentage`
--
ALTER TABLE `tbl_percentage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_promocode`
--
ALTER TABLE `tbl_promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_selfdrive`
--
ALTER TABLE `tbl_selfdrive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_team`
--
ALTER TABLE `tbl_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_temp`
--
ALTER TABLE `tbl_user_temp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin_sidebar`
--
ALTER TABLE `tbl_admin_sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_admin_sidebar2`
--
ALTER TABLE `tbl_admin_sidebar2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_intercity`
--
ALTER TABLE `tbl_intercity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_order1`
--
ALTER TABLE `tbl_order1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_order2`
--
ALTER TABLE `tbl_order2`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_outstation`
--
ALTER TABLE `tbl_outstation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tbl_percentage`
--
ALTER TABLE `tbl_percentage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_promocode`
--
ALTER TABLE `tbl_promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_selfdrive`
--
ALTER TABLE `tbl_selfdrive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_team`
--
ALTER TABLE `tbl_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_user_temp`
--
ALTER TABLE `tbl_user_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
