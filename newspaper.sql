-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2019 at 07:06 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newspaper`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_email` varchar(150) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Techno', 'tech@demo.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` bigint(20) NOT NULL,
  `company_name` varchar(250) NOT NULL,
  `company_address` varchar(350) NOT NULL,
  `company_city` varchar(150) NOT NULL,
  `company_state` varchar(150) NOT NULL,
  `company_district` varchar(150) NOT NULL,
  `company_statecode` bigint(20) NOT NULL,
  `company_mob1` varchar(12) NOT NULL,
  `company_mob2` varchar(12) NOT NULL,
  `company_email` varchar(150) NOT NULL,
  `company_website` varchar(150) NOT NULL,
  `company_pan_no` varchar(12) NOT NULL,
  `company_gst_no` varchar(100) NOT NULL,
  `company_lic1` varchar(150) NOT NULL,
  `company_lic2` varchar(150) NOT NULL,
  `company_start_date` varchar(15) NOT NULL,
  `company_end_date` varchar(15) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `admin_roll_id` int(11) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `company_name`, `company_address`, `company_city`, `company_state`, `company_district`, `company_statecode`, `company_mob1`, `company_mob2`, `company_email`, `company_website`, `company_pan_no`, `company_gst_no`, `company_lic1`, `company_lic2`, `company_start_date`, `company_end_date`, `company_logo`, `admin_roll_id`, `date`) VALUES
(3, 'Pudhari', 'Bhausingji Road  Karvir', 'kolhapur', '27', 'kolhapur', 27, '9876543210', '9876543210', 'root@gmail.com', 'abd.com', '124578', '1245678', '12457', '1245', '01-04-2019', '07-12-2019', '', 1, '2019-12-07 05:56:08');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_line`
--

CREATE TABLE `delivery_line` (
  `delivery_line_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `delivery_line_name` varchar(250) NOT NULL,
  `liboy_id` bigint(20) NOT NULL,
  `collboy_id` bigint(20) NOT NULL,
  `delivery_line_status` varchar(50) NOT NULL DEFAULT 'active',
  `delivery_line_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `delivery_line`
--

INSERT INTO `delivery_line` (`delivery_line_id`, `company_id`, `delivery_line_name`, `liboy_id`, `collboy_id`, `delivery_line_status`, `delivery_line_addedby`, `date`) VALUES
(1, 3, 'Rajarampuri', 4, 4, 'active', NULL, '2019-12-07 10:17:14'),
(2, 3, 'Shahupuri', 1, 1, 'active', NULL, '2019-12-07 10:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `language_id` bigint(20) NOT NULL,
  `language_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`language_id`, `language_name`) VALUES
(1, 'English'),
(2, 'Hindi'),
(3, 'Marathi');

-- --------------------------------------------------------

--
-- Table structure for table `lineboy`
--

CREATE TABLE `lineboy` (
  `lineboy_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `lineboy_name` varchar(250) NOT NULL,
  `lineboy_address` varchar(250) NOT NULL,
  `mobile1` bigint(20) NOT NULL,
  `mobile2` bigint(20) NOT NULL,
  `password` varchar(250) NOT NULL,
  `salary` bigint(20) NOT NULL,
  `is_lineboy` varchar(50) NOT NULL DEFAULT 'no',
  `is_collectionboy` varchar(50) NOT NULL DEFAULT 'no',
  `lineboy_status` varchar(50) NOT NULL DEFAULT 'active',
  `lineboy_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lineboy`
--

INSERT INTO `lineboy` (`lineboy_id`, `company_id`, `lineboy_name`, `lineboy_address`, `mobile1`, `mobile2`, `password`, `salary`, `is_lineboy`, `is_collectionboy`, `lineboy_status`, `lineboy_addedby`, `date`) VALUES
(1, 3, 'Sumit Patil', 'Kolhapur', 9876543210, 9876543210, '123456', 1500, 'yes', 'yes', 'active', NULL, '2019-12-07 07:45:17'),
(4, 3, 'Abhijeet', 'panhala', 6543210214, 0, '123456', 4000, 'yes', 'yes', 'active', NULL, '2019-12-07 07:53:15');

-- --------------------------------------------------------

--
-- Table structure for table `newspaper_info`
--

CREATE TABLE `newspaper_info` (
  `newspaper_info_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `newspaper_info_name` varchar(250) NOT NULL,
  `rate` bigint(20) NOT NULL,
  `papertype_id` bigint(20) NOT NULL,
  `language_id` bigint(20) NOT NULL,
  `newspaper_info_status` varchar(50) NOT NULL DEFAULT 'active',
  `newspaper_info_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `newspaper_info`
--

INSERT INTO `newspaper_info` (`newspaper_info_id`, `company_id`, `newspaper_info_name`, `rate`, `papertype_id`, `language_id`, `newspaper_info_status`, `newspaper_info_addedby`, `date`) VALUES
(1, 3, 'The Hindu', 5, 1, 1, 'active', NULL, '2019-12-07 12:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `papertype`
--

CREATE TABLE `papertype` (
  `papertype_id` bigint(20) NOT NULL,
  `papertype_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `papertype`
--

INSERT INTO `papertype` (`papertype_id`, `papertype_name`) VALUES
(1, 'Newspaper'),
(2, 'Weekly');

-- --------------------------------------------------------

--
-- Table structure for table `scheme_info`
--

CREATE TABLE `scheme_info` (
  `scheme_info_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `scheme_info_name` varchar(250) NOT NULL,
  `month_count` bigint(20) NOT NULL,
  `booking_fee` bigint(20) NOT NULL,
  `scheme_fee` bigint(20) NOT NULL,
  `gift_count` bigint(20) NOT NULL,
  `scheme_type_id` bigint(20) NOT NULL,
  `newspaper_info_id` bigint(20) NOT NULL,
  `scheme_info_status` varchar(50) NOT NULL DEFAULT 'active',
  `scheme_info_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scheme_info`
--

INSERT INTO `scheme_info` (`scheme_info_id`, `company_id`, `scheme_info_name`, `month_count`, `booking_fee`, `scheme_fee`, `gift_count`, `scheme_type_id`, `newspaper_info_id`, `scheme_info_status`, `scheme_info_addedby`, `date`) VALUES
(4, 3, 'diwali 3', 200, 200, 200, 200, 2, 1, '', NULL, '2019-12-08 06:06:28');

-- --------------------------------------------------------

--
-- Table structure for table `scheme_type`
--

CREATE TABLE `scheme_type` (
  `scheme_type_id` bigint(20) NOT NULL,
  `scheme_type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scheme_type`
--

INSERT INTO `scheme_type` (`scheme_type_id`, `scheme_type_name`) VALUES
(1, 'monthly'),
(2, 'yearly');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `roll_id` int(11) NOT NULL DEFAULT 1,
  `user_name` varchar(250) NOT NULL,
  `user_city` varchar(150) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_mobile` varchar(12) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_status` varchar(20) NOT NULL DEFAULT 'active',
  `user_addedby` varchar(100) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `company_id`, `roll_id`, `user_name`, `user_city`, `user_email`, `user_mobile`, `user_password`, `user_status`, `user_addedby`, `user_date`, `is_admin`) VALUES
(5, 3, 1, 'Admin', 'Kolhapur', 'demo@mail.com', '9876543210', '123456', 'active', 'Admin', '2019-12-07 05:40:13', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `delivery_line`
--
ALTER TABLE `delivery_line`
  ADD PRIMARY KEY (`delivery_line_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `lineboy`
--
ALTER TABLE `lineboy`
  ADD PRIMARY KEY (`lineboy_id`);

--
-- Indexes for table `newspaper_info`
--
ALTER TABLE `newspaper_info`
  ADD PRIMARY KEY (`newspaper_info_id`);

--
-- Indexes for table `papertype`
--
ALTER TABLE `papertype`
  ADD PRIMARY KEY (`papertype_id`);

--
-- Indexes for table `scheme_info`
--
ALTER TABLE `scheme_info`
  ADD PRIMARY KEY (`scheme_info_id`);

--
-- Indexes for table `scheme_type`
--
ALTER TABLE `scheme_type`
  ADD PRIMARY KEY (`scheme_type_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `delivery_line`
--
ALTER TABLE `delivery_line`
  MODIFY `delivery_line_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lineboy`
--
ALTER TABLE `lineboy`
  MODIFY `lineboy_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newspaper_info`
--
ALTER TABLE `newspaper_info`
  MODIFY `newspaper_info_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `papertype`
--
ALTER TABLE `papertype`
  MODIFY `papertype_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scheme_info`
--
ALTER TABLE `scheme_info`
  MODIFY `scheme_info_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scheme_type`
--
ALTER TABLE `scheme_type`
  MODIFY `scheme_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
