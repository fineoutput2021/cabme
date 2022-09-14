-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2022 at 03:23 PM
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
(5, 'Banner', 'Banner/view_banner', 3),
(6, 'Users', 'Users/view_users', 4),
(10, 'Booking', '#', 9),
(11, 'Promocode', 'Promocode/view_promocode', 10),
(21, 'City', 'City/view_cities', 5),
(22, 'Self Drive', 'Self_drive/view_selfdrive', 6),
(23, 'Outstation', 'Outstation/View_outstation', 7),
(24, 'Intercity', 'Intercity/View_intercity', 8);

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
(5, 10, 'Outstation Booking', 'Booking/view_outstation_booking');

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
  `payment_status` int(11) NOT NULL,
  `order_status` int(11) DEFAULT NULL COMMENT '1 for orderPlaced , 2 for orderConfirmed , 3 for orderDispatched , 4 for orderDelivered , 5 for rejected, 6 for cancelled by user ',
  `city` varchar(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `start_date` int(11) NOT NULL,
  `end_date` int(11) NOT NULL,
  `start_time` varchar(255) NOT NULL,
  `end_time` varchar(255) NOT NULL,
  `cab_type` int(11) NOT NULL,
  `pick_location` varchar(255) NOT NULL,
  `drop_location` varchar(255) NOT NULL,
  `start_kilometer` varchar(255) NOT NULL,
  `end_kilometer` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `aadhar_image` varchar(255) NOT NULL,
  `lience_image` varchar(255) NOT NULL,
  `txnid` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `date` varchar(1000) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `booking_type`, `user_id`, `total_amount`, `promocode`, `promo_discount`, `final_amount`, `payment_type`, `payment_status`, `order_status`, `city`, `car_id`, `start_date`, `end_date`, `start_time`, `end_time`, `cab_type`, `pick_location`, `drop_location`, `start_kilometer`, `end_kilometer`, `fname`, `lname`, `email`, `phone`, `aadhar_image`, `lience_image`, `txnid`, `ip`, `date`) VALUES
(1, 1, 2, 500, 9, 5, '100000', 0, 1, 1, '1', 2, 5, 7, '5.00', '10.00', 1, 'sikar', 'jaipur', '10', '50', 'ramesh ', 'singh', 'ram@gmail.com', '9828866639', '', '', 'hh', '1.100000.100', '9'),
(2, 2, 2, 10000, 9, 5, '55555', 1, 1, 2, '1', 2, 5, 2, '10', '', 1, 'nagor', 'didwana', '20', '40', 'hello2', 'hello1', 'so12@gmail.com', '9680814546', '', '', NULL, NULL, NULL),
(3, 3, 2, 10000, 9, 5, '55555', 1, 1, 3, '1', 10, 5, 2, '10', '', 1, 'nagor', 'didwana', '70', '99', 'hello2', 'hello1', 'so12@gmail.com', '9680814546', '', '', NULL, NULL, NULL);

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
(10, 'sonu', 'thar', '69', 'assets/uploads/outstation/category20220912010946.jpg', 0, 'jaipur', 5, 1),
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
  `aadhar_no` varchar(255) DEFAULT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `driving_lience` varchar(255) DEFAULT NULL,
  `aadhar_image` varchar(200) DEFAULT NULL,
  `lience_image` varchar(255) DEFAULT NULL,
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

INSERT INTO `tbl_users` (`id`, `f_name`, `l_name`, `aadhar_no`, `passport`, `driving_lience`, `aadhar_image`, `lience_image`, `email`, `dob`, `phone`, `ip`, `is_active`, `date`) VALUES
(2, 'Brain', 'Storm', NULL, NULL, NULL, 'jgvjgvg', 'htdf ht', NULL, '', '6377687630', NULL, 1, NULL);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_temp`
--
ALTER TABLE `tbl_user_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
