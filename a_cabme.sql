-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2022 at 02:33 PM
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
-- Table structure for table `all_states`
--

CREATE TABLE `all_states` (
  `id` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `all_states`
--

INSERT INTO `all_states` (`id`, `state_name`) VALUES
(1, 'Andaman & Nicobar [AN]'),
(2, 'Andhra Pradesh [AP]'),
(3, 'Arunachal Pradesh [AR]'),
(4, 'Assam [AS]'),
(5, 'Bihar [BH]'),
(6, 'Chandigarh [CH]'),
(7, 'Chhattisgarh [CG]'),
(8, 'Dadra & Nagar Haveli [DN]'),
(9, 'Daman & Diu [DD]'),
(10, 'Delhi [DL]'),
(11, 'Goa [GO]'),
(12, 'Gujarat [GU]'),
(13, 'Haryana [HR]'),
(14, 'Himachal Pradesh [HP]'),
(15, 'Jammu & Kashmir [JK]'),
(16, 'Jharkhand [JH]'),
(17, 'Karnataka [KR]'),
(18, 'Kerala [KL]'),
(19, 'Lakshadweep [LD]'),
(20, 'Madhya Pradesh [MP]'),
(21, 'Maharashtra [MH]'),
(22, 'Manipur [MN]'),
(23, 'Meghalaya [ML]'),
(24, 'Mizoram [MM]'),
(25, 'Nagaland [NL]'),
(26, 'Orissa [OR]'),
(27, 'Pondicherry [PC]'),
(28, 'Punjab [PJ]'),
(29, 'Rajasthan [RJ]'),
(30, 'Sikkim [SK]'),
(31, 'Tamil Nadu [TN]'),
(32, 'Tripura [TR]'),
(33, 'Uttar Pradesh [UP]'),
(34, 'Uttaranchal [UT]'),
(35, 'West Bengal [WB]');

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
(4, 'Slider', 'Slider/view_slider', 3),
(5, 'Banner', 'Banner/view_banner', 4),
(6, 'Users', 'Users/view_users', 9),
(7, 'Category', 'Category/view_category', 5),
(8, 'Subcategory', 'Subcategory/view_subcategory', 6),
(9, 'Product', 'Product/view_category', 7),
(10, 'Order', '#', 8),
(11, 'Promocode', 'Promocode/view_promocode', 10),
(12, 'Testimonials', 'Testimonials/view_testimonials', 11),
(13, 'Contact Us Enquiry', 'Contact_us/view_contact_us', 12),
(14, 'Newsletter Subscriptions', 'Subscribe/view_subscribe', 13),
(15, 'Size', 'Size/view_size', 14),
(16, 'Colour', 'Colour/view_colour', 15),
(17, 'Percentage_Off', 'Percentage_Off/view_percentage_off', 16),
(18, 'Pop-up Enquiry', 'Popup/view_popup', 0),
(19, 'Blog', 'Blog/view_blog', 0),
(20, 'Pop-up Image', 'Popup_Image/view_popup_image', 0),
(21, 'Cities', 'cities/view_cities', 0);

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
(17, 'assets/uploads/banner/banner20220909050932.jpg', 'assets/uploads/banner/banner220220909050932.jpg', '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_blog`
--

CREATE TABLE `tbl_blog` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `full_description` mediumtext DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_blog`
--

INSERT INTO `tbl_blog` (`id`, `heading`, `description`, `full_description`, `image`, `ip`, `date`, `added_by`, `is_active`) VALUES
(7, 'Bodycon Dress', 'The bodycon is a tight-fitting dress that hugs your figure and accentuates your assets..', '<p>he scandal broke loose in 1965 when model Jean Shrimpton wore a mini shift dress to the Melbourne Cup, showcasing her bare legs and hat-free head to the world. Nowadays, mini dresses are far more mini and far less scandalous, and they&rsquo;re a great way to capture attention and showcase your pins! This dress is ideal for anyone who wants to put emphasis on their legs and make the world stop and turn! If you&rsquo;ve got it, flaunt it!</p>\r\n', 'assets/uploads/blog/blog20220718060737.jpeg', '::1', '2022-07-18 18:00:37', 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`id`, `user_id`, `product_id`, `type_id`, `quantity`, `ip`, `date`) VALUES
(87, 3, 7, 14, '2', '49.204.165.255', '2022-07-02 15:28:07'),
(88, 4, 4, 2, '1', '49.204.165.255', '2022-07-02 15:40:25'),
(108, 8, 7, 14, '7', '49.204.165.255', '2022-07-05 10:33:58'),
(109, 8, 1, 3, '4', '49.204.165.255', '2022-07-05 10:34:29'),
(111, 11, 1, 3, '1', '49.204.165.255', '2022-07-05 11:57:38'),
(134, 12, 12, 20, '6', '49.204.165.255', '2022-07-05 17:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `added_by` int(100) DEFAULT NULL,
  `is_active` int(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `name`, `image`, `image2`, `ip`, `added_by`, `is_active`, `date`) VALUES
(4, 'Midi Dress', 'assets/uploads/category/category_image20220718020756.jpg', 'assets/uploads/category/category_image20220718020743.jpg', '::1', 19, 1, '2022-06-07 10:00:01'),
(5, 'shift-dress-pattern', 'assets/uploads/category/category_image20220718120741.jpg', 'assets/uploads/category/category_image220220718020746.jpg', '::1', 19, 1, '2022-06-07 10:00:52'),
(6, 'Off the Shoulder', 'assets/uploads/category/category_image20220718120751.jpg', 'assets/uploads/category/category_image220220718020756.jpg', '::1', 19, 1, '2022-06-07 10:01:10'),
(7, 'Bodycon Dress', 'assets/uploads/category/category_image20220718120754.jpg', 'assets/uploads/category/category_image220220718020705.jpg', '::1', 19, 1, '2022-06-07 10:01:31'),
(15, 'A-Line Dress', 'assets/uploads/category/category_image20220718120757.jpg', 'assets/uploads/category/category_image220220718020714.jpeg', '49.204.165.255', 19, 1, '2022-07-05 15:48:25');

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
(7, 'yhyh', '2', 'assets/uploads/cities/category20220909050913.jpeg', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_colour`
--

CREATE TABLE `tbl_colour` (
  `id` int(11) NOT NULL,
  `colour` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `is_active` int(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_colour`
--

INSERT INTO `tbl_colour` (`id`, `colour`, `ip`, `added_by`, `is_active`, `date`) VALUES
(1, '#0ccbe4', '::1', '19', 1, '2022-07-18 15:41:29'),
(2, '#850a0a', '::1', '19', 1, '2022-07-18 15:44:45');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_us`
--

CREATE TABLE `tbl_contact_us` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `message` varchar(1000) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `added_by` int(100) DEFAULT NULL,
  `is_active` int(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_contact_us`
--

INSERT INTO `tbl_contact_us` (`id`, `name`, `email`, `message`, `ip`, `added_by`, `is_active`, `date`) VALUES
(1, 'sdf fds', 'aa@sdafg.dfdg', '3453343434533', '49.204.165.255', NULL, NULL, '2022-07-03 13:17:45'),
(2, 'www eee', 'wwee@gdf.com', 'rss', '49.204.165.255', NULL, NULL, '2022-07-04 12:26:41'),
(3, 'nnn bb', 'nn@ghg.com', 'dfsgff', '49.204.165.255', NULL, NULL, '2022-07-04 13:03:01'),
(4, 'Ambati Rayudu', 'rayudu@gmail.com', 'When you left me out from Indian team.', '49.204.165.255', NULL, NULL, '2022-07-05 16:45:56');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_forgot_pass`
--

CREATE TABLE `tbl_forgot_pass` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `txn_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_forgot_pass`
--

INSERT INTO `tbl_forgot_pass` (`id`, `user_id`, `txn_id`, `status`, `ip`, `date`) VALUES
(1, 4, 'AiY60y', 1, '49.204.164.211', '2022-05-12 09:10:25'),
(2, 4, '3pJ5hv', 1, '49.204.164.211', '2022-05-12 09:10:26'),
(3, 4, 'sNuFdi', 1, '49.204.164.211', '2022-05-12 09:10:35'),
(4, 4, 'QCt64p', 1, '49.204.164.211', '2022-05-12 09:11:01'),
(5, 4, 'ghKeKX', 1, '49.204.164.211', '2022-05-12 09:11:29'),
(6, 4, '6La2a6', 1, '49.204.164.211', '2022-05-12 09:50:59'),
(7, 2, 'm4IZJr', 1, '49.204.164.211', '2022-05-12 09:54:23'),
(8, 2, 'mdg9MA', 1, '49.204.164.211', '2022-05-12 09:55:07'),
(9, 2, 'x3cdlG', 1, '49.204.164.211', '2022-05-12 09:55:12'),
(10, 3, 'jgNK5h', 1, '49.204.164.211', '2022-05-12 09:55:46'),
(11, 9, 'AhOrwW', 1, '1.39.219.93', '2022-05-21 06:36:51'),
(12, 2, 'fD5WN1', 1, '::1', '2022-07-15 13:03:16'),
(13, 2, 'EvzchM', 1, '::1', '2022-07-15 13:06:37'),
(14, 2, 'epgnZG', 1, '::1', '2022-07-15 13:06:42'),
(15, 2, 'cURPFp', 1, '::1', '2022-07-15 13:06:49'),
(16, 2, 'XOyvuq', 1, '::1', '2022-07-15 13:08:42'),
(17, 2, 'LZD743', 1, '::1', '2022-07-15 13:13:13'),
(18, 1, 'C2PlC7', 1, '::1', '2022-07-15 13:15:54'),
(19, 1, 'vOgCmn', 1, '::1', '2022-07-15 13:21:33'),
(20, 1, 'nIwJvY', 1, '::1', '2022-07-15 13:21:34'),
(21, 1, 'pk8lVc', 1, '::1', '2022-07-15 13:29:01'),
(22, 1, 'AbmfKX', 1, '::1', '2022-07-15 13:30:38'),
(23, 1, 'PgNzQ4', 1, '::1', '2022-07-15 13:32:42'),
(24, 1, 'e8lD1K', 1, '::1', '2022-07-15 13:49:02'),
(25, 1, 'ZXNzdQ', 1, '::1', '2022-07-15 13:53:50'),
(26, 1, 'txPFuf', 1, '::1', '2022-07-15 13:59:04'),
(27, 1, '40n1Fo', 1, '::1', '2022-07-15 14:04:32'),
(28, 1, 'AFSpvz', 1, '::1', '2022-07-15 14:05:56');

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
-- Table structure for table `tbl_popup`
--

CREATE TABLE `tbl_popup` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` varchar(255) DEFAULT NULL,
  `is_active` int(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_popup`
--

INSERT INTO `tbl_popup` (`id`, `name`, `phone`, `email`, `ip`, `added_by`, `is_active`, `date`) VALUES
(1, 'Manthan', '7073810988', 'manthan@gmail.com', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popup_image`
--

CREATE TABLE `tbl_popup_image` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `added_by` varchar(255) NOT NULL,
  `is_active` int(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_popup_image`
--

INSERT INTO `tbl_popup_image` (`id`, `image`, `text`, `ip`, `added_by`, `is_active`, `date`) VALUES
(3, 'assets/uploads/popup_image/image20220718060748.jpg', 'aasas', '::1', '19', 1, '2022-07-18 18:39:48');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(100) NOT NULL,
  `category_id` varchar(100) DEFAULT NULL,
  `subcategory_id` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `image1` varchar(255) NOT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `vendor_code` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `exclusive` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `added_by` int(100) DEFAULT NULL,
  `is_active` int(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `category_id`, `subcategory_id`, `name`, `image1`, `sku`, `vendor_code`, `description`, `exclusive`, `tags`, `ip`, `added_by`, `is_active`, `date`) VALUES
(24, '4', '1', 'Stunner Dress', 'assets/uploads/product/product20220718010711.jpg', '122', '10', '<p>gdgddgd</p>', NULL, 'jj', NULL, 19, 1, '2022-07-18 13:37:11');

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
-- Table structure for table `tbl_size`
--

CREATE TABLE `tbl_size` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(255) DEFAULT NULL,
  `is_active` int(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_size`
--

INSERT INTO `tbl_size` (`id`, `name`, `ip`, `added_by`, `is_active`, `date`) VALUES
(2, 'Neck size', '::1', 19, 1, '2022-07-18 15:25:57'),
(3, 'shoulder size', '::1', 19, 1, '2022-07-18 15:26:10');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_slider`
--

CREATE TABLE `tbl_slider` (
  `id` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `added_by` int(100) NOT NULL,
  `is_active` int(100) NOT NULL,
  `date` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_slider`
--

INSERT INTO `tbl_slider` (`id`, `image`, `link`, `ip`, `added_by`, `is_active`, `date`) VALUES
(12, 'assets/uploads/slider/slider20220718110707.jpg', 'http://www.anokhitrends.com/kurtis/', '::1', 19, 1, '2022-07-18 11:31:38');

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
-- Table structure for table `tbl_subscribe`
--

CREATE TABLE `tbl_subscribe` (
  `id` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `added_by` int(100) DEFAULT NULL,
  `is_active` int(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_subscribe`
--

INSERT INTO `tbl_subscribe` (`id`, `email`, `ip`, `added_by`, `is_active`, `date`) VALUES
(1, 'demo@gmail.com', '::1', NULL, 1, '2022-06-29 12:28:13'),
(2, 'demo@gmail.com', '::1', NULL, 1, '2022-06-29 12:59:39'),
(3, 'manthan321.mc@gmail.com', '::1', NULL, 1, '2022-06-29 13:00:25'),
(4, 'Bitcoin@gmail.com', '::1', NULL, 1, '2022-06-29 13:07:17'),
(5, 'manthan321.mc@gmail.com', '49.204.165.255', NULL, 1, '2022-06-29 18:46:41'),
(6, 'jatnarendra@gmail.com', '49.204.165.255', NULL, 1, '2022-07-02 15:40:35'),
(7, 'jhdfkjdsh@gdskjfj.com', '49.204.165.255', NULL, 1, '2022-07-02 17:12:57'),
(8, '03July@gmail.com', '49.204.165.255', NULL, 1, '2022-07-03 12:31:32'),
(9, '03July@gmail.com', '49.204.165.255', NULL, 1, '2022-07-03 12:32:18'),
(10, 'ttt@dfsfgfd.com', '49.204.165.255', NULL, 1, '2022-07-04 12:25:36'),
(11, 'hjsdfhjsd@gf.com', '49.204.165.255', NULL, 1, '2022-07-04 14:46:43'),
(12, 'vegeta@gmail.com', '49.204.165.255', NULL, 1, '2022-07-05 16:47:49');

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
-- Table structure for table `tbl_testimonials`
--

CREATE TABLE `tbl_testimonials` (
  `id` int(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `added_by` int(100) DEFAULT NULL,
  `is_active` int(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_testimonials`
--

INSERT INTO `tbl_testimonials` (`id`, `name`, `text`, `image`, `ip`, `added_by`, `is_active`, `date`) VALUES
(1, 'Manthan chauhan', 'To compete with modernized retail store, Kirana stores have to compete on the factors identified in the analysis. They need to keep exotic and specialty items and offer discounts on bulk purchase. But it becomes impossible for a single kirana stores to procure bulk quantity at low price and offer discounts.', NULL, '::1', 19, 1, '2022-06-09 10:48:47'),
(4, 'narendra', 'good', NULL, '49.204.164.251', 19, 1, '2022-06-13 16:29:01'),
(5, 'Rahul', 'best ttt', 'assets/uploads/testimonials/testimonials_image20220702050751.png', '49.204.165.255', 19, 1, '2022-07-02 17:08:51'),
(6, 'Kartik', 'Good quality products and very happy with the service', 'assets/uploads/testimonials/testimonials_image20220705040750.jpg', '49.204.165.255', 19, 1, '2022-07-05 16:44:50');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `id` int(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mrp` varchar(100) NOT NULL,
  `sp` varchar(100) NOT NULL,
  `gst` varchar(100) NOT NULL,
  `spgst` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `is_active` int(100) NOT NULL,
  `added_by` int(100) NOT NULL,
  `date` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`id`, `product_id`, `name`, `mrp`, `sp`, `gst`, `spgst`, `ip`, `is_active`, `added_by`, `date`) VALUES
(1, '3', 'coffeee', '100', '90', '5', '94.5', '::1', 1, 19, 2022),
(2, '4', 'asli butter', '100', '90', '4', '93.6', '::1', 1, 19, 2022),
(3, '1', 'soap', '100', '90', '10', '99', '::1', 1, 19, 2022),
(4, '5', 'surfexcel', '200', '300', '8', '324', '::1', 1, 19, 2022),
(5, '5', 'arielsurf', '100', '88', '10', '96.8', '::1', 1, 19, 2022),
(6, '5', 'surfexeefef', '100', '90', '10', '99', '::1', 1, 19, 2022),
(7, '5', 'surfexeefeff', '100', '90', '1', '90.9', '::1', 1, 19, 2022),
(8, '6', 'soap', '50', '51', '50', '100', '::1', 1, 19, 2022),
(10, '3', '1', '12', '12', '12', '13.44', '::1', 1, 19, 2022),
(11, '1', 'Dove', '12', '12', '12', '13.44', '::1', 1, 19, 2022),
(12, '5', 'ioil', '200', '120', '6', '127.2', '49.204.164.251', 1, 19, 2022),
(13, '1', 'kmh', '100', '60', '2', '61.2', '49.204.164.251', 1, 19, 2022),
(14, '7', 'not  mmmm', '200', '100', '11', '111', '49.204.165.255', 1, 19, 2022),
(15, '7', 'typ 2', '300', '150', '10', '165', '49.204.165.255', 1, 19, 2022),
(16, '9', 'lll', '200', '120', '3', '123.6', '49.204.165.255', 1, 19, 2022),
(17, '10', '75 gm', '40', '29', '5', '30.45', '49.204.165.255', 1, 19, 2022),
(18, '10', '100gm', '60', '48', '5', '50.4', '49.204.165.255', 1, 19, 2022),
(19, '11', '300gm', '85', '52', '5', '54.6', '49.204.165.255', 1, 19, 2022),
(20, '12', '300gm', '90', '55', '5', '57.75', '49.204.165.255', 1, 19, 2022),
(21, '13', '150gm', '40', '28', '5', '29.4', '49.204.165.255', 1, 19, 2022),
(22, '14', '150gm', '35', '23', '5', '24.15', '49.204.165.255', 1, 19, 2022),
(23, '15', '200gm', '35', '23', '5', '24.15', '49.204.165.255', 1, 19, 2022),
(24, '16', '300gm', '45', '40', '5', '42', '49.204.165.255', 1, 19, 2022),
(25, '17', '300g', '45', '40', '5', '42', '49.204.165.255', 1, 19, 2022),
(26, '18', '340ml', '350', '240', '5', '252', '49.204.165.255', 1, 19, 2022);

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_wishlist`
--

CREATE TABLE `tbl_wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_wishlist`
--

INSERT INTO `tbl_wishlist` (`id`, `user_id`, `product_id`, `type_id`, `ip`, `date`) VALUES
(17, 8, 7, 14, '49.204.165.255', '2022-07-04 13:55:40'),
(26, 8, 1, 3, '49.204.165.255', '2022-07-05 10:35:20'),
(32, 12, 14, 22, '49.204.165.255', '2022-07-05 17:15:24'),
(34, 12, 12, 20, '49.204.165.255', '2022-07-05 17:16:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `all_states`
--
ALTER TABLE `all_states`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_colour`
--
ALTER TABLE `tbl_colour`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_forgot_pass`
--
ALTER TABLE `tbl_forgot_pass`
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
-- Indexes for table `tbl_percentage`
--
ALTER TABLE `tbl_percentage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_popup`
--
ALTER TABLE `tbl_popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_popup_image`
--
ALTER TABLE `tbl_popup_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_promocode`
--
ALTER TABLE `tbl_promocode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_size`
--
ALTER TABLE `tbl_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subscribe`
--
ALTER TABLE `tbl_subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_team`
--
ALTER TABLE `tbl_team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_testimonials`
--
ALTER TABLE `tbl_testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
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
-- Indexes for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `all_states`
--
ALTER TABLE `all_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tbl_admin_sidebar`
--
ALTER TABLE `tbl_admin_sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
-- AUTO_INCREMENT for table `tbl_blog`
--
ALTER TABLE `tbl_blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_colour`
--
ALTER TABLE `tbl_colour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_contact_us`
--
ALTER TABLE `tbl_contact_us`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_forgot_pass`
--
ALTER TABLE `tbl_forgot_pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
-- AUTO_INCREMENT for table `tbl_percentage`
--
ALTER TABLE `tbl_percentage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_popup`
--
ALTER TABLE `tbl_popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_popup_image`
--
ALTER TABLE `tbl_popup_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_promocode`
--
ALTER TABLE `tbl_promocode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_size`
--
ALTER TABLE `tbl_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_slider`
--
ALTER TABLE `tbl_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_subscribe`
--
ALTER TABLE `tbl_subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_team`
--
ALTER TABLE `tbl_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tbl_testimonials`
--
ALTER TABLE `tbl_testimonials`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

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

--
-- AUTO_INCREMENT for table `tbl_wishlist`
--
ALTER TABLE `tbl_wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
