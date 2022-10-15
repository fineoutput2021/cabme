-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 15, 2022 at 05:32 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

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
(5, 'Banner', 'Banner/view_banner', 3),
(6, 'Users', 'Users/view_users', 4),
(10, 'Booking', '#', 9),
(11, 'Promocode', 'Promocode/view_promocode', 10),
(21, 'City', 'City/view_cities', 5),
(22, 'Self_drive', 'Self_drive/view_selfdrive', 6),
(23, 'Outstation', 'Outstation/View_outstation', 7),
(24, 'Intercity', 'Intercity/View_intercity', 8),
(25, 'Testimonials', 'Testimonials/view_testimonials', 11);

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
(3, 10, 'Self Drive Booking', 'Booking/view_self_booking'),
(4, 10, 'Intercity Booking', 'Booking/view_intercity_booking'),
(5, 10, 'Outstation Booking', 'Booking/view_outstation_booking'),
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
(16, 'assets/uploads/banner/banner20221012051018.jpg', 'assets/uploads/banner/banner220221012051018.jpg', '', 0, 1, ''),
(17, 'assets/uploads/banner/banner20221012051050.jpg', 'assets/uploads/banner/banner220221012051050.jpg', '', 0, 1, ''),
(18, 'assets/uploads/banner/banner20221012051003.jpg', 'assets/uploads/banner/banner220221012051003.jpg', '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `id` int(11) NOT NULL,
  `booking_type` int(11) DEFAULT NULL COMMENT '1 for selfdrive, 2 for intercity, 3 for outstation',
  `user_id` int(11) DEFAULT NULL,
  `total_amount` int(11) DEFAULT NULL,
  `promocode` int(11) DEFAULT NULL,
  `promo_discount` int(11) DEFAULT NULL,
  `final_amount` varchar(255) DEFAULT NULL,
  `payment_type` int(11) DEFAULT NULL COMMENT '1 for COD , 2 for online payment',
  `payment_status` int(11) DEFAULT NULL,
  `order_status` int(11) DEFAULT NULL COMMENT '1 for orderPlaced , 2 for orderConfirmed , 3 for orderDispatched , 4 for orderDelivered , 5 for rejected, 6 for cancelled by user ',
  `city_id` int(11) DEFAULT NULL,
  `car_id` int(11) DEFAULT NULL,
  `kilometer_type` int(11) DEFAULT NULL,
  `rsda` varchar(255) DEFAULT NULL,
  `kilometer` varchar(255) DEFAULT NULL,
  `kilometer_price` varchar(255) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `cab_type` int(11) DEFAULT NULL,
  `pick_location` varchar(255) DEFAULT NULL,
  `drop_location` varchar(255) DEFAULT NULL,
  `start_kilometer` varchar(255) DEFAULT NULL,
  `end_kilometer` varchar(255) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `booking_type`, `user_id`, `total_amount`, `promocode`, `promo_discount`, `final_amount`, `payment_type`, `payment_status`, `order_status`, `city_id`, `car_id`, `kilometer_type`, `rsda`, `kilometer`, `kilometer_price`, `start_date`, `start_time`, `end_date`, `end_time`, `duration`, `cab_type`, `pick_location`, `drop_location`, `start_kilometer`, `end_kilometer`, `fname`, `lname`, `email`, `phone`, `txnid`, `ip`, `date`) VALUES
(1, 2, 2, 500, 9, 5, '100000', 1, 1, 1, 1, 2, NULL, NULL, NULL, NULL, NULL, '5.00', NULL, '10.00', NULL, 2, 'sikar', 'jaipur', '10', '50', 'ramesh ', 'singh', 'ram@gmail.com', '9828866639', 'hh', '1.100000.100', '9'),
(2, 1, 3, 126000, NULL, NULL, '129000', NULL, 0, 0, 6, 16, 2, '3000', '400', '1800', '15 Oct 2022', '7:30 PM', '18 Oct 2022', '5:30 PM', '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-10-15 20:47:45'),
(3, 1, 3, 420000, NULL, NULL, '423000', NULL, 0, 0, 6, 16, 1, '3000', '200', '6000', '15 Oct 2022', '7:30 PM', '18 Oct 2022', '5:30 PM', '70', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '::1', '2022-10-15 20:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cities`
--

CREATE TABLE `tbl_cities` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `city_type` varchar(200) DEFAULT NULL,
  `photo` text NOT NULL,
  `top` int(4) DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_cities`
--

INSERT INTO `tbl_cities` (`id`, `name`, `city_type`, `photo`, `top`, `is_active`, `date`) VALUES
(5, 'Delhi', '1', 'assets/uploads/cities/category20221012061034.png', 1, 1, NULL),
(6, 'Jaipur', '1', 'assets/uploads/cities/category20221012061042.png', 0, 1, NULL),
(8, 'Udaipur', '2', 'assets/uploads/cities/category20221012061050.png', 1, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_intercity`
--

CREATE TABLE `tbl_intercity` (
  `id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `cab_type` varchar(500) NOT NULL,
  `price` int(11) NOT NULL,
  `Kilomitere_cab` int(11) NOT NULL,
  `min_amount` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_intercity`
--

INSERT INTO `tbl_intercity` (`id`, `city_id`, `cab_type`, `price`, `Kilomitere_cab`, `min_amount`, `is_active`) VALUES
(15, 6, '1', 99, 88, 88, 1),
(16, 8, '3', 44, 744, 44, 1);

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
(7, '00000', '123456', 1, 0, '::1', '2022-05-03 10:25:36'),
(8, 'v165161651', '612587', 0, 90, '::1', '2022-10-12 21:38:12'),
(9, 'v165161651', '823655', 0, 91, '::1', '2022-10-12 21:38:32'),
(10, '00000000000', '123456', 0, 92, '::1', '2022-10-13 12:08:25'),
(11, '0000000000', '123456', 1, 93, '::1', '2022-10-13 12:52:19'),
(12, '000000000', '123456', 0, 94, '::1', '2022-10-13 12:57:38'),
(13, '000000000', '123456', 0, 95, '::1', '2022-10-13 12:57:39'),
(14, '0000000000', '123456', 1, 96, '::1', '2022-10-13 12:59:10'),
(15, '0000000000', '123456', 1, 0, '::1', '2022-10-13 14:44:56'),
(16, '0000000000', '123456', 0, 0, '::1', '2022-10-13 14:45:12'),
(17, '0000000000', '123456', 0, 0, '::1', '2022-10-13 14:45:47'),
(18, '0000000000', '123456', 1, 0, '::1', '2022-10-13 14:45:57'),
(19, '1111111111', '123456', 0, 97, '::1', '2022-10-13 14:46:15'),
(20, '0000000000', '123456', 1, 0, '::1', '2022-10-13 14:47:40'),
(21, '0000000000', '123456', 1, 0, '::1', '2022-10-13 14:48:23'),
(22, '0000000000', '123456', 0, 0, '::1', '2022-10-13 16:35:21'),
(23, '0000000000', '123456', 1, 0, '::1', '2022-10-15 19:15:41');

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
  `min_booking_amt` varchar(200) NOT NULL,
  `city_id` int(11) NOT NULL,
  `is_active` tinyint(11) NOT NULL,
  `date` varchar(200) NOT NULL,
  `is_available` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_outstation`
--

INSERT INTO `tbl_outstation` (`id`, `brand_name`, `car_name`, `seatting`, `photo`, `per_kilometre`, `location`, `min_booking_amt`, `city_id`, `is_active`, `date`, `is_available`) VALUES
(10, 'sonu', 'thar', '69', 'assets/uploads/outstation/category20220912010946.jpg', 0, '20', '', 5, 1, '', 0),
(11, 'f', 'thar', '69', 'assets/uploads/outstation/category20220912010955.jpg', 10, '20', '', 6, 1, '', 1),
(16, 'brand111', 'thar', '1', 'assets/uploads/outstation/category20221012051016.jpg', 70, 'sikar', '200', 8, 1, '2022-10-12 17:10:16', 1);

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
-- Table structure for table `tbl_search`
--

CREATE TABLE `tbl_search` (
  `id` int(11) NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `start_time` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `end_time` varchar(255) DEFAULT NULL,
  `duration` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_search`
--

INSERT INTO `tbl_search` (`id`, `city_id`, `start_date`, `start_time`, `end_date`, `end_time`, `duration`, `date`) VALUES
(1, 6, '15 Oct 2022', '7:30 PM', '16 Oct 2022', '7:30 PM', '24', '2022-10-15 16:08:36'),
(2, 6, '15 Oct 2022', '7:30 PM', '18 Oct 2022', '5:30 PM', '70', '2022-10-15 18:00:12');

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
  `is_active` int(11) NOT NULL,
  `is_available` int(11) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_selfdrive`
--

INSERT INTO `tbl_selfdrive` (`id`, `city_id`, `brand_name`, `car_name`, `photo`, `fule_type`, `transmission`, `seatting`, `kilometer1`, `price1`, `kilometer2`, `price2`, `kilometer3`, `price3`, `extra_kilo`, `rsda`, `is_active`, `is_available`, `date`) VALUES
(15, '5', 'sonu', 'thar', 'assets/uploads/self_drive/category20220912040950.jpg', '2', '1', 'rht', 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, ''),
(16, '6', 'Audi', 'A3', 'assets/uploads/self_drive/category20221015121007.png', '1', '2', '1', 200, 6000, 400, 1200, 600, 1800, 100, 3000, 1, 1, ''),
(17, '8', 'brand1', 'car1', 'assets/uploads/self_drive/category20221012041018.png', '1', '1', '1', 80, 2000, 70, 100, 90, 100, 100, 5875858, 1, 1, '2022-10-12 16:49:18'),
(18, '6', 'Honda', 'Civic', 'assets/uploads/self_drive/category20221015011003.png', '2', '2', '1', 300, 3000, 500, 5000, 700, 7000, 150, 2000, 1, 1, '2022-10-15 13:52:03');

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
-- Table structure for table `tbl_testimonials`
--

CREATE TABLE `tbl_testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  `ip` varchar(200) NOT NULL,
  `added_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_testimonials`
--

INSERT INTO `tbl_testimonials` (`id`, `name`, `content`, `ip`, `added_by`, `is_active`, `date`) VALUES
(2, 'yhtyh', 'yhyh', '::1', 19, 1, '2022-10-12 13:51:08'),
(3, 'yhtyh', 'yhyh', '::1', 19, 1, '2022-10-12 13:56:43'),
(4, 'gt', 'yhyh', '::1', 19, 1, '2022-10-12 13:56:49'),
(5, 'yhyh', 'yhyyh', '::1', 19, 1, '2022-10-12 14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(100) DEFAULT NULL,
  `l_name` varchar(255) DEFAULT NULL,
  `aadhar_no` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `driving_lience` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `dob` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ip` int(100) DEFAULT NULL,
  `is_active` int(100) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`id`, `f_name`, `l_name`, `aadhar_no`, `passport`, `driving_lience`, `email`, `dob`, `phone`, `ip`, `is_active`, `date`) VALUES
(2, 'Brain', 'Storm', NULL, NULL, NULL, NULL, '', '6377687630', NULL, 1, NULL),
(3, 'First', 'User', NULL, NULL, NULL, NULL, '', '0000000000', 0, 1, '2022-10-13 12:59:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_temp`
--

CREATE TABLE `tbl_user_temp` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `ip` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_user_temp`
--

INSERT INTO `tbl_user_temp` (`id`, `fname`, `lname`, `email`, `phone`, `ip`, `date`) VALUES
(1, ']New test', NULL, NULL, '00000', '::1', '2022-04-19 16:31:32'),
(2, 'Test', NULL, NULL, '000000', '::1', '2022-04-22 15:45:25'),
(3, 'aasd', 'asd', NULL, '2342344233', '49.204.165.37', '2022-08-22 12:53:20'),
(4, 'First', 'User', NULL, '0000000000', '49.204.165.37', '2022-08-22 13:09:16'),
(5, 'First', 'User', NULL, '0000000000', '49.204.165.37', '2022-08-22 13:11:41'),
(6, 'First', 'Last', NULL, '0000000000', '49.204.165.37', '2022-08-25 16:32:05'),
(7, 'NARENDRA', 'JAT', NULL, '9649230623', '49.204.165.37', '2022-08-25 17:57:22'),
(8, 'tyt', 'fbfb', NULL, '9787868678', '49.204.165.37', '2022-08-27 14:53:39'),
(9, 'Narendra', 'jaat', NULL, '9649230623', '49.204.165.37', '2022-08-27 16:55:03'),
(10, 'JAT', 'NARENDRA', NULL, '9899999999', '49.204.165.37', '2022-08-27 17:10:52'),
(11, 'Narendra jaat', NULL, 'narendrajat@gmail.com', '9888888888', '49.204.165.37', '2022-08-27 17:52:49'),
(12, 'kunal', NULL, 'kunal@gmail.com', '9877777777', '49.204.165.37', '2022-08-27 17:56:33'),
(13, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:22:58'),
(14, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:22:59'),
(15, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:22:59'),
(16, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:00'),
(17, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:00'),
(18, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:00'),
(19, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:01'),
(20, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:01'),
(21, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:01'),
(22, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:01'),
(23, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:02'),
(24, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:02'),
(25, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:02'),
(26, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:02'),
(27, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:02'),
(28, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:03'),
(29, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:03'),
(30, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:03'),
(31, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:03'),
(32, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:03'),
(33, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:04'),
(34, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:04'),
(35, 'aa', 'aa', NULL, '2020101010', '49.204.165.37', '2022-08-29 18:23:04'),
(36, 'PULKIT', NULL, 'PULKIT123@gmail.com', '9000000000', '49.204.165.37', '2022-08-30 10:23:06'),
(37, 'kunal', 'sh', NULL, '9777777777', '49.204.164.159', '2022-08-30 14:57:16'),
(38, 'jkhj', 'hjgkj', NULL, '9111111111', '49.204.164.159', '2022-08-30 19:36:40'),
(39, 'karthik', 'verma', NULL, '9222222222', '49.204.164.159', '2022-09-01 10:37:16'),
(40, 'pulkit', NULL, 'pulkit@gmail.com', '9800000000', '49.204.164.159', '2022-09-01 14:02:14'),
(41, 'pulkit', NULL, 'pulkit@gmail.com', '9800000000', '49.204.164.159', '2022-09-01 14:02:14'),
(42, 'pulkit', NULL, 'pulkit@gmail.com', '9800000000', '49.204.164.159', '2022-09-01 14:02:14'),
(43, 'pulkit', NULL, 'pulkit@gmail.com', '9800000000', '49.204.164.159', '2022-09-01 14:02:14'),
(44, 'pulkit', NULL, 'pulkit@gmail.com', '9800000000', '49.204.164.159', '2022-09-01 14:02:14'),
(45, 'pulkit', NULL, 'pulkit@gmail.com', '9800000000', '49.204.164.159', '2022-09-01 14:02:14'),
(46, 'pulkit', NULL, 'pulkit@gmail.com', '9800000000', '49.204.164.159', '2022-09-01 14:02:14'),
(47, 'pulkit', NULL, 'pulkit@gmail.com', '9800000000', '49.204.164.159', '2022-09-01 14:02:14'),
(48, 'Animesh', 'Sharma', NULL, '7014224653', '49.36.235.115', '2022-09-01 16:00:32'),
(49, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:23'),
(50, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:28'),
(51, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:31'),
(52, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:32'),
(53, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:32'),
(54, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:33'),
(55, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:33'),
(56, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:33'),
(57, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:33'),
(58, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:33'),
(59, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:33'),
(60, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:34'),
(61, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:34'),
(62, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:34'),
(63, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:34'),
(64, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:34'),
(65, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:35'),
(66, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:09:35'),
(67, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:28'),
(68, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:28'),
(69, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:28'),
(70, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:28'),
(71, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:28'),
(72, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:29'),
(73, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:29'),
(74, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:29'),
(75, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:29'),
(76, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:30'),
(77, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:30'),
(78, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:30'),
(79, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:30'),
(80, 'son', 'goku', NULL, '8441849182', '49.36.235.115', '2022-09-01 17:10:43'),
(81, 'Gaurav', 'Jain', NULL, '8440993324', '49.36.235.81', '2022-09-02 01:36:45'),
(82, 'Gaurav', 'Jain', NULL, '8440993324', '49.36.235.81', '2022-09-02 01:39:26'),
(83, 'Gaurav', 'Jain', NULL, '8440993324', '157.38.209.182', '2022-09-02 10:35:06'),
(84, 'Gaurav', 'Jain', NULL, '8440993324', '49.36.235.81', '2022-09-02 18:03:20'),
(85, 'anu', NULL, 'dfvsda@gmail.com', '9876567898', '49.204.165.180', '2022-09-16 13:42:30'),
(86, 'aaaa', 'ssss', NULL, '0000000000', '49.204.165.180', '2022-09-16 14:36:51'),
(87, 'ankit', 'sharma', NULL, '1020304050', '49.204.165.180', '2022-09-16 15:46:00'),
(88, 'pulkit', 's djf', NULL, '9099999999', '49.204.165.55', '2022-09-26 17:02:38'),
(89, 'vdvd', 'vdvd', NULL, 'v165161651', '::1', '2022-10-12 21:37:43'),
(90, 'vdvd', 'vdvd', NULL, 'v165161651', '::1', '2022-10-12 21:38:12'),
(91, 'vdvd', 'vdvd', NULL, 'v165161651', '::1', '2022-10-12 21:38:32'),
(92, 'nitesh', 'Shah', NULL, '00000000000', '::1', '2022-10-13 12:08:25'),
(93, 'nitesh', 'shah', NULL, '0000000000', '::1', '2022-10-13 12:52:19'),
(94, 'nitesh', 'shah', NULL, '000000000', '::1', '2022-10-13 12:57:38'),
(95, 'nitesh', 'shah', NULL, '000000000', '::1', '2022-10-13 12:57:39'),
(96, 'nitesh', 'shah', 'nitesh@gmail.com', '0000000000', '::1', '2022-10-13 12:59:10'),
(97, 'nitesh', 'shaha', 'nitesh@gmail.com', '1111111111', '::1', '2022-10-13 14:46:15');

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
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
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
-- Indexes for table `tbl_search`
--
ALTER TABLE `tbl_search`
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
-- Indexes for table `tbl_testimonials`
--
ALTER TABLE `tbl_testimonials`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_admin_sidebar2`
--
ALTER TABLE `tbl_admin_sidebar2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_cities`
--
ALTER TABLE `tbl_cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_intercity`
--
ALTER TABLE `tbl_intercity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_outstation`
--
ALTER TABLE `tbl_outstation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
-- AUTO_INCREMENT for table `tbl_search`
--
ALTER TABLE `tbl_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_selfdrive`
--
ALTER TABLE `tbl_selfdrive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- AUTO_INCREMENT for table `tbl_testimonials`
--
ALTER TABLE `tbl_testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user_temp`
--
ALTER TABLE `tbl_user_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
