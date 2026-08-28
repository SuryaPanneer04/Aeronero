-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 09, 2021 at 08:14 AM
-- Server version: 5.7.26
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrs`
--

-- --------------------------------------------------------

--
-- Table structure for table `client_master`
--

DROP TABLE IF EXISTS `client_master`;
CREATE TABLE IF NOT EXISTS `client_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_manager_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `org_type` varchar(11) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `mobile_no1` text,
  `mobile_no2` text,
  `land_line_no` text,
  `email_id1` varchar(255) DEFAULT NULL,
  `email_id2` varchar(255) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `town_city` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `gst_no` varchar(55) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `pur_name` varchar(250) DEFAULT NULL,
  `pur_designation` varchar(250) DEFAULT NULL,
  `pur_contact` varchar(250) DEFAULT NULL,
  `pur_mail` varchar(250) DEFAULT NULL,
  `fin_name` varchar(250) DEFAULT NULL,
  `fin_designation` varchar(250) DEFAULT NULL,
  `fin_contact` varchar(250) DEFAULT NULL,
  `fin_mail` varchar(250) DEFAULT NULL,
  `pur_bran_address` varchar(250) DEFAULT NULL,
  `pur_bran_area` varchar(250) DEFAULT NULL,
  `pur_bran_city` varchar(250) DEFAULT NULL,
  `pur_bran_district` varchar(250) DEFAULT NULL,
  `pur_bran_pincode` varchar(250) DEFAULT NULL,
  `pur_bran_state` varchar(250) DEFAULT NULL,
  `pur_bran_country` varchar(250) DEFAULT NULL,
  `fin_bran_address` varchar(250) DEFAULT NULL,
  `fin_bran_area` varchar(250) DEFAULT NULL,
  `fin_bran_city` varchar(250) DEFAULT NULL,
  `fin_bran_district` varchar(250) DEFAULT NULL,
  `fin_bran_pincode` varchar(250) DEFAULT NULL,
  `fin_bran_state` varchar(250) DEFAULT NULL,
  `fin_bran_country` varchar(250) DEFAULT NULL,
  `pur_bran_status` varchar(114) DEFAULT NULL,
  `fin_bran_status` varchar(123) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `flow` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_master`
--

INSERT INTO `client_master` (`id`, `account_manager_id`, `department_id`, `employee_id`, `client_name`, `org_name`, `org_type`, `designation`, `mobile_no1`, `mobile_no2`, `land_line_no`, `email_id1`, `email_id2`, `address1`, `address2`, `area`, `town_city`, `pincode`, `district`, `state`, `country`, `gst_no`, `website`, `pur_name`, `pur_designation`, `pur_contact`, `pur_mail`, `fin_name`, `fin_designation`, `fin_contact`, `fin_mail`, `pur_bran_address`, `pur_bran_area`, `pur_bran_city`, `pur_bran_district`, `pur_bran_pincode`, `pur_bran_state`, `pur_bran_country`, `fin_bran_address`, `fin_bran_area`, `fin_bran_city`, `fin_bran_district`, `fin_bran_pincode`, `fin_bran_state`, `fin_bran_country`, `pur_bran_status`, `fin_bran_status`, `status`, `flow`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(8, NULL, 3, 5, 'umarajesh', 'TCS', '5', 'development', '9994998908', '', '', 'gnath9275@gmail.com', '', '56 east cart street', '', '', 'chennai', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, 1, 3, '2021-07-07 09:35:34', NULL, NULL),
(9, NULL, 3, 9, 'Priya', 'CTS', '2', 'software Development', '9990009990', '', '', 'gnath@gmail.com', '', 'chennai', '', '', 'chennai kancheepuram', '', '', '', '', 'ASASDD234234SDF', 'WWW.king.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '0', 2, 1, 3, '2021-07-09 09:22:46', NULL, NULL),
(10, NULL, 1, 1, 'Girish Madhavan', 'Bluebase', '', 'MD', '9841013361', '', '', 'girish@bluebase.in', '', '118', 'Manikkam Lane', 'Guindy', 'Chennai', '600032', 'Chennai', 'Tamilnadu', 'India', '33AAFCB5950L2ZI', 'www.bluebase.in', '', '', '', '', 'Ramakrishnan', 'Finance', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, 3, '2021-07-09 11:34:36', NULL, NULL),
(6, NULL, 3, 6, 'raja', 'wipro', '1', 'software deeeloper', '9994996010', '', '', 'gnath9375@gmail.com', '', 'plot no 57', '', '', 'chennai', '', '', '', '', 'SDSDF33333fdfsf', 'www.cop.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, 1, 3, '2021-07-06 11:23:43', NULL, NULL),
(11, NULL, 3, 5, 'Rajeshwari', 'IBM', '2', 'Software DEveloper', '9994991010', '', '', 'gnth@gmail.com', '', 'sholliganallur', '', '', 'chennai', '', '', '', '', 'zdvgsgsdgs34334', 'www.blu.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, 1, 3, '2021-07-09 11:55:47', NULL, NULL),
(12, 0, 3, 6, 'priya', 'GRT', '4', 'software  developer', '9994996012', '', '', 'gnath@gmail.com', '', '56 east cart street', '', '', 'chennai', '', '', '', '', 'fddfdd343433434', 'www.com.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, 1, 3, '2021-07-09 12:40:35', NULL, NULL),
(13, 0, 2, 12, 'Priya', 'tata', '2', 'software Development', '9990009990', '', '', 'gnath@gmail.com', '', 'chennai', '', '', 'chnnai', '', '', '', '', 'dfgsgdgsd343453', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, 1, 3, '2021-07-09 12:45:43', NULL, NULL),
(14, 0, 3, 49, 'selva rathinam', 'Saravana Stored', '1', 'software engineer', '9994995010', '9994995010', '', 'uma@gmail.com', '', 'tnagar', '', '', 'chennai', '', '', '', '', 'sfsdfsdf4345345', 'www.com', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 2, 1, 3, '2021-07-09 12:54:32', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
