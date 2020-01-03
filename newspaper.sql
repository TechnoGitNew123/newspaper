-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2020 at 01:58 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

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
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bill_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `bill_no` bigint(20) DEFAULT NULL,
  `bill_date` varchar(20) DEFAULT NULL,
  `bill_cycle_id` int(11) NOT NULL,
  `delivery_line_id` int(11) NOT NULL,
  `customer_id` bigint(11) NOT NULL,
  `del_charges` double NOT NULL,
  `paper_wise` varchar(100) NOT NULL,
  `tot_gros_amt` double NOT NULL,
  `tot_del_charges` double NOT NULL,
  `tot_less_amt` double NOT NULL,
  `tot_add_amt` double DEFAULT NULL,
  `tot_net_amt` double NOT NULL,
  `bill_addedby` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill`
--

INSERT INTO `bill` (`bill_id`, `company_id`, `bill_no`, `bill_date`, `bill_cycle_id`, `delivery_line_id`, `customer_id`, `del_charges`, `paper_wise`, `tot_gros_amt`, `tot_del_charges`, `tot_less_amt`, `tot_add_amt`, `tot_net_amt`, `bill_addedby`, `date`) VALUES
(1, 3, 1, '01-12-2019', 2, 1, 1, 0, 'Per Paper Wise', 500, 50, 0, 0, 550, '5', '2019-12-29 05:17:29'),
(5, 3, 3, '03-01-2020', 1, 2, 1, 100, '0', 1000, 500, 50, 100, 1500, '5', '2020-01-03 12:08:37');

-- --------------------------------------------------------

--
-- Table structure for table `bill_cycle`
--

CREATE TABLE `bill_cycle` (
  `bill_cycle_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `bill_cycle_name` varchar(250) DEFAULT NULL,
  `bill_cycle_from` varchar(20) DEFAULT NULL,
  `bill_cycle_to` varchar(20) DEFAULT NULL,
  `bill_cycle_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_cycle`
--

INSERT INTO `bill_cycle` (`bill_cycle_id`, `company_id`, `bill_cycle_name`, `bill_cycle_from`, `bill_cycle_to`, `bill_cycle_addedby`, `date`) VALUES
(2, 1, 'Dec 2019', '01-12-2019', '31-12-2019', '5', '2020-01-03 12:52:54'),
(3, 1, 'January 2020', '01-01-2020', '31-01-2020', NULL, '2020-01-03 12:53:00'),
(5, 3, 'February 2020', '01-02-2020', '29-02-2020', '5', '2020-01-01 12:23:50');

-- --------------------------------------------------------

--
-- Table structure for table `bill_paper`
--

CREATE TABLE `bill_paper` (
  `bill_paper_id` bigint(11) NOT NULL,
  `bill_id` bigint(11) NOT NULL,
  `newspaper_info_id` bigint(11) DEFAULT NULL,
  `newspaper_qty` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_paper`
--

INSERT INTO `bill_paper` (`bill_paper_id`, `bill_id`, `newspaper_info_id`, `newspaper_qty`, `amount`, `date`) VALUES
(16, 5, 1, 10, 11, '2019-12-27 10:41:03'),
(17, 5, 1, 20, 22, '2019-12-27 10:41:04'),
(18, 1, 1, 1, 500, '2019-12-29 05:17:29'),
(21, 5, 1, 1, 300, '2020-01-03 12:08:37'),
(22, 5, 1, 2, 200, '2020-01-03 12:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `bill_scheme`
--

CREATE TABLE `bill_scheme` (
  `bill_scheme_id` bigint(20) NOT NULL,
  `bill_id` bigint(20) NOT NULL,
  `scheme_info_id` bigint(20) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bill_scheme`
--

INSERT INTO `bill_scheme` (`bill_scheme_id`, `bill_id`, `scheme_info_id`, `qty`, `amount`, `date`) VALUES
(15, 5, 4, 1, 300, '2020-01-03 12:08:38'),
(16, 5, 4, 2, 200, '2020-01-03 12:08:38');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` bigint(20) NOT NULL,
  `c_name` varchar(250) DEFAULT NULL,
  `company_name` varchar(250) NOT NULL,
  `company_address` varchar(350) NOT NULL,
  `company_city` varchar(150) NOT NULL,
  `company_state` varchar(150) NOT NULL,
  `company_district` varchar(150) NOT NULL,
  `company_statecode` bigint(20) NOT NULL,
  `company_mob1` varchar(12) NOT NULL,
  `company_mob2` varchar(12) NOT NULL,
  `company_email` varchar(150) NOT NULL,
  `company_gpay_no` varchar(20) DEFAULT NULL,
  `company_website` varchar(150) NOT NULL,
  `company_pan_no` varchar(12) NOT NULL,
  `company_gst_no` varchar(100) NOT NULL,
  `company_lic1` varchar(150) NOT NULL,
  `company_lic2` varchar(150) NOT NULL,
  `company_start_date` varchar(15) NOT NULL,
  `company_end_date` varchar(15) NOT NULL,
  `company_logo` varchar(200) NOT NULL,
  `company_imei` varchar(250) DEFAULT NULL,
  `company_imei2` varchar(100) DEFAULT NULL,
  `company_status` varchar(100) NOT NULL DEFAULT 'Inactive',
  `company_reg_date` varchar(20) DEFAULT NULL,
  `admin_roll_id` int(11) NOT NULL DEFAULT 1,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `c_name`, `company_name`, `company_address`, `company_city`, `company_state`, `company_district`, `company_statecode`, `company_mob1`, `company_mob2`, `company_email`, `company_gpay_no`, `company_website`, `company_pan_no`, `company_gst_no`, `company_lic1`, `company_lic2`, `company_start_date`, `company_end_date`, `company_logo`, `company_imei`, `company_imei2`, `company_status`, `company_reg_date`, `admin_roll_id`, `date`) VALUES
(3, 'dfgsdfg sdfg', 'Pudhari', 'Bhausingji Road  Karvir', 'kolhapur', 'Maharashtra', 'kolhapur', 27, '9876543210', '9876543210', 'root@gmail.com', '9876543210', 'abd.com', '124578', '1245678', '12457', '1245', '01-4-2019', '07-12-2019', '', '111', NULL, 'Active', '12-12-2019', 1, '2019-12-28 12:38:24'),
(6, 'fsdgdfg', 'Demo Company', 'dfsgdfg', 'PUNE', 'Maharashtra', '', 0, '9988776655', '', 'demo1@mail.com', '', '', '5r67fh', '', 'dfgh', '', '', '', '', '111', NULL, 'Inactive', '28-12-2019', 1, '2019-12-28 12:44:44'),
(7, 'api up demo', 'up demo', 'rrr', 'kkk', 'mmm', '', 0, '9966332211', '9988774411', 'demo@www.com', '9955663322', '', '444', '', '555', '666', '', '', '', '777', '888', 'Inactive', NULL, 1, '2019-12-29 09:56:33'),
(8, 'datta mhs', 'Api Demo', '', 'Kop', '', '', 0, '9988776655', '', '', NULL, '', '', '', '', '', '', '', '', '222', '333', 'Inactive', NULL, 1, '2019-12-29 10:03:26'),
(9, 'datta mhs', 'Api Demo', '', 'Kop', '', '', 0, '9988776655', '', '', NULL, '', '', '', '', '', '', '', '', '222', '333', 'Inactive', NULL, 1, '2019-12-29 10:05:09');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customer_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `delivery_line_id` bigint(20) DEFAULT NULL,
  `customer_name` varchar(250) DEFAULT NULL,
  `customer_address` varchar(250) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `bill_send_sms` varchar(50) DEFAULT NULL,
  `bill_send_email` varchar(50) DEFAULT NULL,
  `delivery_charges` double DEFAULT NULL,
  `paperwise` varchar(20) DEFAULT NULL,
  `opening_bal` double DEFAULT NULL,
  `advance` double DEFAULT NULL,
  `customer_status` varchar(50) NOT NULL DEFAULT 'active',
  `customer_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `company_id`, `delivery_line_id`, `customer_name`, `customer_address`, `mobile`, `email`, `bill_send_sms`, `bill_send_email`, `delivery_charges`, `paperwise`, `opening_bal`, `advance`, `customer_status`, `customer_addedby`, `date`) VALUES
(1, 3, 1, 'demo api', 'ghfgh', '8855870751', 'demo@eee.com', 'sms', '', 100, 'all', 1000, 500, 'active', '5', '2020-01-03 11:09:31');

-- --------------------------------------------------------

--
-- Table structure for table `customer_pdetails`
--

CREATE TABLE `customer_pdetails` (
  `customer_pdetails_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `papertype_id` bigint(20) NOT NULL,
  `newspaper_info_id` bigint(20) NOT NULL,
  `newspaper_qty` int(11) DEFAULT NULL,
  `s_date` varchar(250) DEFAULT NULL,
  `e_date` varchar(50) DEFAULT NULL,
  `customer_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_pdetails`
--

INSERT INTO `customer_pdetails` (`customer_pdetails_id`, `customer_id`, `company_id`, `papertype_id`, `newspaper_info_id`, `newspaper_qty`, `s_date`, `e_date`, `customer_addedby`, `date`) VALUES
(1, 1, 3, 1, 1, 3, '11-11-2019', '11-12-2019', '5', '2020-01-03 12:14:10'),
(2, 1, 3, 1, 1, 3, '11-10-2019', '11-11-2019', '5', '2020-01-03 12:14:10');

-- --------------------------------------------------------

--
-- Table structure for table `customer_schdetails`
--

CREATE TABLE `customer_schdetails` (
  `customer_schdetails_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `scheme_info_id` bigint(20) NOT NULL,
  `qty` varchar(250) DEFAULT NULL,
  `sch_amount` double DEFAULT NULL,
  `s_date` varchar(250) DEFAULT NULL,
  `e_date` varchar(250) DEFAULT NULL,
  `customer_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_schdetails`
--

INSERT INTO `customer_schdetails` (`customer_schdetails_id`, `customer_id`, `company_id`, `scheme_info_id`, `qty`, `sch_amount`, `s_date`, `e_date`, `customer_addedby`, `date`) VALUES
(1, 1, 3, 4, '1', 300, '11-10-2019', '11-11-2019', '5', '2020-01-03 12:14:33'),
(2, 1, 3, 4, '2', 0, '11-11-2019', '11-12-2019', '5', '2020-01-03 12:14:33');

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
(2, 3, 'Shahupuri', 1, 1, 'active', NULL, '2019-12-07 10:17:05'),
(4, 9, 'zzz', 3, 4, 'active', NULL, '2019-12-29 10:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `expense_vc_no` bigint(20) NOT NULL,
  `expense_date` varchar(20) DEFAULT NULL,
  `expense_type` varchar(150) DEFAULT NULL,
  `expense_amount` double DEFAULT NULL,
  `expense_notes` text DEFAULT NULL,
  `expense_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_id`, `company_id`, `expense_vc_no`, `expense_date`, `expense_type`, `expense_amount`, `expense_notes`, `expense_addedby`, `date`) VALUES
(2, 3, 1, '01-12-2019', '3', 222, 'jklhjk', '5', '2019-12-28 06:38:08'),
(4, 3, 2, '01-01-2020', '2', 1000, 'kdfghj dsklfghklsdfjg lkdfj', '5', '2020-01-01 11:40:13');

-- --------------------------------------------------------

--
-- Table structure for table `expense_type`
--

CREATE TABLE `expense_type` (
  `expense_type_id` bigint(20) NOT NULL,
  `company_id` bigint(20) DEFAULT NULL,
  `expense_type_name` varchar(250) NOT NULL,
  `expense_type_addedby` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `expense_type`
--

INSERT INTO `expense_type` (`expense_type_id`, `company_id`, `expense_type_name`, `expense_type_addedby`, `date`) VALUES
(2, 3, 'Asdfgh Jklpo', '5', '2019-12-28 06:00:15'),
(3, 3, 'Zxcvb Nmlkj', '5', '2019-12-28 06:00:24'),
(5, 3, 'qwer ert', '5', '2020-01-01 11:23:16');

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
  `l_imei` varchar(250) DEFAULT NULL,
  `is_lineboy` varchar(50) NOT NULL DEFAULT 'no',
  `is_collectionboy` varchar(50) NOT NULL DEFAULT 'no',
  `lineboy_status` varchar(50) NOT NULL DEFAULT 'active',
  `lineboy_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lineboy`
--

INSERT INTO `lineboy` (`lineboy_id`, `company_id`, `lineboy_name`, `lineboy_address`, `mobile1`, `mobile2`, `password`, `salary`, `l_imei`, `is_lineboy`, `is_collectionboy`, `lineboy_status`, `lineboy_addedby`, `date`) VALUES
(1, 3, 'Sumit Patil', 'Kolhapur', 9876543210, 9876543210, '123456', 1500, '555', 'yes', 'yes', 'active', NULL, '2019-12-28 11:30:20');

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
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `purchase_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `purchase_vc_no` bigint(20) NOT NULL,
  `purchase_date` varchar(20) DEFAULT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `newspaper_info_id` int(11) DEFAULT NULL,
  `purchase_qty` int(11) DEFAULT NULL,
  `purchase_tot_amt` double DEFAULT NULL,
  `purchase_pay_amt` double DEFAULT NULL,
  `purchase_out_amt` double DEFAULT NULL,
  `purchase_note` text DEFAULT NULL,
  `purchase_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`purchase_id`, `company_id`, `purchase_vc_no`, `purchase_date`, `supplier_id`, `newspaper_info_id`, `purchase_qty`, `purchase_tot_amt`, `purchase_pay_amt`, `purchase_out_amt`, `purchase_note`, `purchase_addedby`, `date`) VALUES
(2, 3, 1, '01-12-2019', 2, 1, 200, 800, 500, 300, 'dfgdfgdfg', '5', '2019-12-28 06:33:56'),
(7, 3, 3, '01-01-2020', 1, 2, 100, 1000, 300, 700, 'ghjghj fjhfgjh', '6', '2020-01-01 11:57:46');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

CREATE TABLE `receipt` (
  `receipt_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `receipt_no` bigint(20) NOT NULL,
  `receipt_date` varchar(20) DEFAULT NULL,
  `delivery_line_id` int(11) DEFAULT NULL,
  `customer_id` bigint(11) DEFAULT NULL,
  `out_amount` double DEFAULT NULL,
  `rec_amount` double DEFAULT NULL,
  `pay_mode` varchar(100) DEFAULT NULL,
  `cheque_no` double DEFAULT NULL,
  `cheque_date` varchar(20) DEFAULT NULL,
  `cheque_amt` double DEFAULT NULL,
  `receipt_ref_no` varchar(50) DEFAULT NULL,
  `receipt_note` text DEFAULT NULL,
  `receipt_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt`
--

INSERT INTO `receipt` (`receipt_id`, `company_id`, `receipt_no`, `receipt_date`, `delivery_line_id`, `customer_id`, `out_amount`, `rec_amount`, `pay_mode`, `cheque_no`, `cheque_date`, `cheque_amt`, `receipt_ref_no`, `receipt_note`, `receipt_addedby`, `date`) VALUES
(1, 3, 1, '01-12-2019', 1, 1, 1150, 550, 'Cash', 0, '', 0, '', 'dhfgh dfghdfgh', '5', '2019-12-29 05:17:50'),
(4, 3, 3, '03-01-2020', 1, 1, 3, 4, 'Cash', 5, '03-01-2020', 6, '7', 'gvhfgh', '5', '2020-01-03 05:36:54');

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
  `is_monthly_bill` varchar(20) DEFAULT 'No',
  `scheme_info_status` varchar(50) NOT NULL DEFAULT 'active',
  `scheme_info_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scheme_info`
--

INSERT INTO `scheme_info` (`scheme_info_id`, `company_id`, `scheme_info_name`, `month_count`, `booking_fee`, `scheme_fee`, `gift_count`, `scheme_type_id`, `newspaper_info_id`, `is_monthly_bill`, `scheme_info_status`, `scheme_info_addedby`, `date`) VALUES
(4, 3, 'diwali 3', 200, 200, 0, 200, 2, 1, 'Yes', '', NULL, '2019-12-27 09:19:56');

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
(1, 'Monthly'),
(2, 'Yearly');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `supplier_id` bigint(20) NOT NULL,
  `company_id` bigint(20) NOT NULL,
  `supplier_name` varchar(250) DEFAULT NULL,
  `supplier_mobile` bigint(20) DEFAULT NULL,
  `supplier_email` varchar(150) DEFAULT NULL,
  `supplier_city` varchar(100) DEFAULT NULL,
  `supplier_op_bal` double DEFAULT NULL,
  `supplier_status` varchar(50) DEFAULT 'active',
  `supplier_addedby` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`supplier_id`, `company_id`, `supplier_name`, `supplier_mobile`, `supplier_email`, `supplier_city`, `supplier_op_bal`, `supplier_status`, `supplier_addedby`, `date`) VALUES
(1, 3, 'Demo sup', 9988776655, 'sup@demo.com', 'Kop', 500, 'active', '5', '2019-12-25 11:52:00'),
(2, 3, 'sdzfgdfg sdfgdfg', 9966558877, 'demo@www.nom', 'dfghdfh', 500, 'active', '5', '2019-12-28 06:22:59'),
(3, 3, 'xdzfgxdfg111', 8866552233, 'hgjkhjk@dfg.ghj', 'jhkl', 400, 'deactive', '5', '2019-12-28 06:30:08');

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
  `user_imei` varchar(250) DEFAULT NULL,
  `user_otp` varchar(20) DEFAULT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_status` varchar(20) NOT NULL DEFAULT 'active',
  `user_addedby` varchar(100) NOT NULL,
  `user_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_admin` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `company_id`, `roll_id`, `user_name`, `user_city`, `user_email`, `user_mobile`, `user_imei`, `user_otp`, `user_password`, `user_status`, `user_addedby`, `user_date`, `is_admin`) VALUES
(5, 3, 1, 'Admin', 'Kolhapur', 'demo@mail.com', '9876543210', NULL, NULL, '123456', 'active', 'Admin', '2019-12-28 10:43:29', 1),
(9, 6, 1, 'Admin', 'PUNE', 'admin@demo.com', '9988776655', NULL, NULL, '123456', 'active', 'Admin', '2019-12-28 12:24:35', 1),
(10, 9, 1, 'datta mhs', 'Kop', '', '9988776644', '222', '926466', '123456', 'active', '', '2019-12-29 10:26:54', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `bill_cycle`
--
ALTER TABLE `bill_cycle`
  ADD PRIMARY KEY (`bill_cycle_id`);

--
-- Indexes for table `bill_paper`
--
ALTER TABLE `bill_paper`
  ADD PRIMARY KEY (`bill_paper_id`);

--
-- Indexes for table `bill_scheme`
--
ALTER TABLE `bill_scheme`
  ADD PRIMARY KEY (`bill_scheme_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_pdetails`
--
ALTER TABLE `customer_pdetails`
  ADD PRIMARY KEY (`customer_pdetails_id`),
  ADD KEY `customer_pdetails_ibfk_1` (`newspaper_info_id`);

--
-- Indexes for table `customer_schdetails`
--
ALTER TABLE `customer_schdetails`
  ADD PRIMARY KEY (`customer_schdetails_id`),
  ADD KEY `customer_schdetails_ibfk_1` (`scheme_info_id`);

--
-- Indexes for table `delivery_line`
--
ALTER TABLE `delivery_line`
  ADD PRIMARY KEY (`delivery_line_id`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_id`);

--
-- Indexes for table `expense_type`
--
ALTER TABLE `expense_type`
  ADD PRIMARY KEY (`expense_type_id`);

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
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`purchase_id`);

--
-- Indexes for table `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`receipt_id`),
  ADD KEY `receipt_ibfk_1` (`customer_id`);

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
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`supplier_id`);

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
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bill_cycle`
--
ALTER TABLE `bill_cycle`
  MODIFY `bill_cycle_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bill_paper`
--
ALTER TABLE `bill_paper`
  MODIFY `bill_paper_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `bill_scheme`
--
ALTER TABLE `bill_scheme`
  MODIFY `bill_scheme_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customer_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customer_pdetails`
--
ALTER TABLE `customer_pdetails`
  MODIFY `customer_pdetails_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_schdetails`
--
ALTER TABLE `customer_schdetails`
  MODIFY `customer_schdetails_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `delivery_line`
--
ALTER TABLE `delivery_line`
  MODIFY `delivery_line_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expense`
--
ALTER TABLE `expense`
  MODIFY `expense_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `expense_type`
--
ALTER TABLE `expense_type`
  MODIFY `expense_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `language_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lineboy`
--
ALTER TABLE `lineboy`
  MODIFY `lineboy_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `newspaper_info`
--
ALTER TABLE `newspaper_info`
  MODIFY `newspaper_info_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `papertype`
--
ALTER TABLE `papertype`
  MODIFY `papertype_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `purchase_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `receipt`
--
ALTER TABLE `receipt`
  MODIFY `receipt_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `scheme_info`
--
ALTER TABLE `scheme_info`
  MODIFY `scheme_info_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `scheme_type`
--
ALTER TABLE `scheme_type`
  MODIFY `scheme_type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `supplier_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON UPDATE CASCADE;

--
-- Constraints for table `customer_pdetails`
--
ALTER TABLE `customer_pdetails`
  ADD CONSTRAINT `customer_pdetails_ibfk_1` FOREIGN KEY (`newspaper_info_id`) REFERENCES `newspaper_info` (`newspaper_info_id`) ON UPDATE CASCADE;

--
-- Constraints for table `customer_schdetails`
--
ALTER TABLE `customer_schdetails`
  ADD CONSTRAINT `customer_schdetails_ibfk_1` FOREIGN KEY (`scheme_info_id`) REFERENCES `scheme_info` (`scheme_info_id`) ON UPDATE CASCADE;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`customer_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
