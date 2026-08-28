-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 28, 2021 at 08:06 AM
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
-- Table structure for table `allowance_percentage_master`
--

DROP TABLE IF EXISTS `allowance_percentage_master`;
CREATE TABLE IF NOT EXISTS `allowance_percentage_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scale` varchar(50) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `basic_pay` varchar(50) DEFAULT NULL,
  `hra` varchar(50) DEFAULT NULL,
  `da` varchar(50) DEFAULT NULL,
  `cca` varchar(50) DEFAULT NULL,
  `Other_allow` varchar(100) DEFAULT NULL,
  `Bonus` varchar(100) DEFAULT NULL,
  `splallow` varchar(100) DEFAULT NULL,
  `ds` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `allowance_percentage_master`
--

INSERT INTO `allowance_percentage_master` (`id`, `scale`, `from_date`, `basic_pay`, `hra`, `da`, `cca`, `Other_allow`, `Bonus`, `splallow`, `ds`) VALUES
(1, 'S1', '2018-05-18', '2500', '25', '50', '30', '10', '10', '10', '67'),
(2, 'S2', '2018-06-07', '2520', '25', '50', '30', '10', '10', '10', '56'),
(3, 'S1', '2018-05-18', '300', '25', '50', '30', '10', '10', '10', '657'),
(4, 'S3', '2018-12-10', '10000', '5100', '200', '100', '100', '56', '200', '567'),
(5, '78', '2021-01-01', '657', '356.5', '56', '56', '56', '56', '56', '56'),
(6, '78', '2021-01-01', '657', '356.5', '56', '56', '56', '56', '56', '56');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_qn_master`
--

DROP TABLE IF EXISTS `assessment_qn_master`;
CREATE TABLE IF NOT EXISTS `assessment_qn_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qn_name` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `Questions` varchar(255) NOT NULL,
  `Option_A` varchar(255) NOT NULL,
  `Option_B` varchar(255) NOT NULL,
  `Option_C` varchar(255) NOT NULL,
  `Option_D` varchar(255) NOT NULL,
  `answer_key` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `assets_master`
--

DROP TABLE IF EXISTS `assets_master`;
CREATE TABLE IF NOT EXISTS `assets_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(234) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets_master`
--

INSERT INTO `assets_master` (`id`, `name`) VALUES
(1, 'Monitor'),
(2, 'Keyboard'),
(3, 'CPU'),
(4, 'Mouse'),
(5, 'Fan'),
(6, 'AC');

-- --------------------------------------------------------

--
-- Table structure for table `assets_system`
--

DROP TABLE IF EXISTS `assets_system`;
CREATE TABLE IF NOT EXISTS `assets_system` (
  `id` int(12) NOT NULL AUTO_INCREMENT,
  `asset_no` varchar(255) DEFAULT NULL,
  `asset_name` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `p_date` date DEFAULT NULL,
  `Serial_no` varchar(255) DEFAULT NULL,
  `config` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assets_system`
--

INSERT INTO `assets_system` (`id`, `asset_no`, `asset_name`, `brand_name`, `p_date`, `Serial_no`, `config`, `warranty`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'As001', '3', 'HP', '2021-04-08', '32145', 'done', '2', 1, 1, '2021-04-07 11:27:42', NULL, NULL),
(2, '001', '3', 'lenovo', '2021-04-06', '3321', 'finihsed', '3', 1, 1, '2021-04-12 04:39:07', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ECODE` varchar(155) DEFAULT NULL,
  `Name` varchar(155) DEFAULT NULL,
  `Shift` varchar(155) DEFAULT NULL,
  `InTime` varchar(155) DEFAULT NULL,
  `OutTime` varchar(155) DEFAULT NULL,
  `Duration` varchar(155) DEFAULT NULL,
  `Status` int(155) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `ECODE`, `Name`, `Shift`, `InTime`, `OutTime`, `Duration`, `Status`, `created_by`, `created_on`) VALUES
(1, 'E00015', 'jai', '', '9', '6', '9', 1, 1, '2021-03-24');

-- --------------------------------------------------------

--
-- Table structure for table `birthday`
--

DROP TABLE IF EXISTS `birthday`;
CREATE TABLE IF NOT EXISTS `birthday` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `txt` varchar(255) NOT NULL,
  `comments` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `birthday`
--

INSERT INTO `birthday` (`id`, `txt`, `comments`) VALUES
(1, 'WISH YOU A VERY HAPPY BIRTHDAY', 'HAPPY BIRTHDAY VANITHA');

-- --------------------------------------------------------

--
-- Table structure for table `calls_master`
--

DROP TABLE IF EXISTS `calls_master`;
CREATE TABLE IF NOT EXISTS `calls_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calls_master`
--

INSERT INTO `calls_master` (`id`, `name`, `status`, `created_by`) VALUES
(1, 'Incoming', 1, '2021-04-01 04:48:00'),
(2, 'Outgoing', 1, '2021-04-01 04:48:00'),
(3, 'Direct', 1, '2021-04-01 04:48:00');

-- --------------------------------------------------------

--
-- Table structure for table `candicate_results`
--

DROP TABLE IF EXISTS `candicate_results`;
CREATE TABLE IF NOT EXISTS `candicate_results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qn_name_id` int(11) DEFAULT NULL,
  `ueser_id` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candicate_results`
--

INSERT INTO `candicate_results` (`id`, `qn_name_id`, `ueser_id`, `question`, `answer`, `Status`, `created`) VALUES
(1, 1, 18, 1, 2, 1, '2021-03-29 09:04:40'),
(2, 1, 18, 2, 4, 1, '2021-03-29 09:04:44'),
(3, 1, 19, 1, 1, 1, '2021-03-29 09:04:49'),
(4, 1, 19, 2, 4, 1, '2021-03-29 09:04:52'),
(5, 1, 18, 1, 2, 1, '2021-03-29 09:04:56'),
(6, 1, 18, 2, 3, 1, '2021-03-29 09:04:59'),
(7, 1, 35, 1, 2, 1, '2021-04-12 07:47:17'),
(8, 1, 38, 1, 2, 1, '2021-04-17 04:40:30'),
(9, 1, 40, 1, 2, 1, '2021-04-19 09:23:48');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_form_details`
--

DROP TABLE IF EXISTS `candidate_form_details`;
CREATE TABLE IF NOT EXISTS `candidate_form_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) DEFAULT NULL,
  `round_id` int(11) DEFAULT NULL,
  `qn_name_id` int(11) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `department` varchar(25) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `comments` varchar(255) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `paddress` varchar(250) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `alternative_phone` varchar(25) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `adharnumber` varchar(100) DEFAULT NULL,
  `pannumber` varchar(100) DEFAULT NULL,
  `voternumber` varchar(100) DEFAULT NULL,
  `educationalDetails` varchar(150) DEFAULT NULL,
  `EmployeeStatus` varchar(100) DEFAULT NULL,
  `year_of_pass` varchar(10) DEFAULT NULL,
  `companyname` varchar(250) DEFAULT NULL,
  `no_of_year` varchar(10) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_form_details`
--

INSERT INTO `candidate_form_details` (`id`, `resource_id`, `round_id`, `qn_name_id`, `company_name`, `position`, `department`, `first_name`, `last_name`, `father_name`, `gender`, `dob`, `comments`, `address`, `paddress`, `phone`, `alternative_phone`, `mail`, `adharnumber`, `pannumber`, `voternumber`, `educationalDetails`, `EmployeeStatus`, `year_of_pass`, `companyname`, `no_of_year`, `resume`, `status`, `created_by`, `created_on`) VALUES
(1, NULL, NULL, 1, '1', '2', '1', 'Rajeshwari', '', '', 'female', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-24 00:00:00'),
(2, NULL, NULL, NULL, '1', '4', '3', 'Jaikumar', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-24 00:00:00'),
(3, NULL, NULL, NULL, '1', '1', '1', 'Girish Madhavan', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-25 00:00:00'),
(4, NULL, NULL, NULL, '1', '3', '1', 'Ramakrishnan', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', '', NULL, '', '', NULL, 18, 1, '2021-03-25 00:00:00'),
(5, NULL, NULL, 1, '1', '5', '3', 'Laxmi', 'Priya', 'kamaraj', 'female', '1996-04-19', 'Advance Happy Birthday', 'Aruppukottai', 'Aruppukottai', '9790218732', NULL, 'laxmipriya@blubase.in', '1234567896', '89546', '132', 'BE.CSE', 'experience', '2016', 'Bluebase', '3', NULL, 18, 1, '2021-03-25 00:00:00'),
(6, NULL, NULL, NULL, '1', '5', '3', 'Gopinath', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 1, 1, '2021-03-25 00:00:00'),
(7, NULL, NULL, NULL, '1', '6', '3', 'Umadevi', '', '', 'female', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-25 00:00:00'),
(8, NULL, NULL, NULL, '1', '6', '3', 'Sindhu G', '', '', 'female', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-25 00:00:00'),
(9, NULL, NULL, NULL, '1', '7', '3', 'Sebastain', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-25 00:00:00'),
(10, NULL, NULL, NULL, '1', '9', '3', 'Rizwana', '', '', 'female', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-25 00:00:00'),
(11, NULL, NULL, NULL, '1', '10', '3', 'Mohana Krishnan (Android)', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-25 00:00:00'),
(12, NULL, NULL, NULL, '1', '13', '2', 'Meena', '', '', 'female', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'experience', NULL, '', '', NULL, 18, 1, '2021-03-25 00:00:00'),
(15, NULL, NULL, NULL, '1', '8', '3', 'Vanitha', '', '', 'female', '1995-06-11', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(16, NULL, NULL, NULL, '1', '11', '2', 'Jefferson', 'Fernando', 'Suresh Fernando', 'male', '1997-12-19', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(17, NULL, NULL, NULL, '1', '12', '4', 'Arunachalam', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(23, NULL, NULL, NULL, '1', '14', '5', 'Arun', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(24, NULL, NULL, NULL, '1', '16', '6', 'Mythili\r\n', '', '', 'female', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(22, NULL, NULL, NULL, '1', '8', '3', 'test', '', 'test', 'male', '1970-01-01', '', 'asdasd', '', '9790218732', '1234567890', 'xxxx@gmail.com', '5485 5000 8000', '', '', 'BE', 'new', '2020', NULL, NULL, NULL, 4, 3, '2021-04-01 00:00:00'),
(25, NULL, NULL, NULL, '1', '17', '7', 'Karthikeyan\r\n', '', '', 'female', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(26, NULL, NULL, NULL, '1', '15', '6', 'Sakthi\r\n', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(27, NULL, NULL, NULL, '1', '15', '6', 'Selvaraj', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(28, NULL, NULL, NULL, '1', '15', '6', 'Vaidyanathan\r\n', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(29, NULL, NULL, NULL, '1', '15', '6', 'Christy', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(30, NULL, NULL, NULL, '1', '15', '6', 'Muthuraj\r\n', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(31, NULL, NULL, NULL, '1', '15', '6', 'Kalai\r\n', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(32, NULL, NULL, NULL, '1', '15', '6', 'Shanmuganathan\r\n', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(33, NULL, NULL, NULL, '1', '15', '6', 'Karthik', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(34, NULL, NULL, NULL, '1', '15', '6', 'Venkatesan', '', '', 'male', '1970-01-01', '', '', '', '', NULL, '', '', '', '', '', 'new', '', NULL, NULL, NULL, 18, 1, '2021-03-25 00:00:00'),
(35, NULL, NULL, NULL, '', '6', '3', 'resource', 'k', 'test', 'male', '2021-04-08', '', 'asdasd', 'asdasd', '+91 9790218732', '91', 'xxxx@gmail.com', '5485 5000 8000', '', '', 'BE', 'new', '2020', NULL, NULL, '', 4, 46, '2021-04-08 00:00:00'),
(36, 2, NULL, NULL, '', '6', '3', 'test', 'resource', 'qqqq', 'male', '2021-03-01', '', 'asdasd', 'frewrf', '+91 9790218732', '+91 1234567890', 'xxxx@gmail.com', '5485 5000 8000', '', '', 'B.E', 'new', '2020', NULL, NULL, '', 3, 2, '2021-04-13 00:00:00'),
(37, 3, NULL, NULL, '', '6', '3', 'New', 'Resource', 'new twst', 'male', '2021-04-06', '', 'asdasd', 'asdasd', '+91 9790218732', '+91 1234567890', 'xxxx@gmail.com', '5485 5000 8000', '', '', 'B.E', 'new', '2020', NULL, NULL, '', 3, 3, '2021-04-15 00:00:00'),
(38, 4, NULL, NULL, '', '7', '3', 'test', 'UI', 'qqqq', 'male', '2021-04-01', '', 'asdasd', 'asdasd', ' +91 9790218732', ' 1234567890', 'xxxx@gmail.com', '5485 5000 8000', '', '', 'B.E', 'new', '2020', NULL, NULL, '', 3, 4, '2021-04-17 00:00:00'),
(39, 5, NULL, NULL, '', '5', '3', 'test1', 'SD', 'wwww', 'male', '2021-04-01', '', 'asdasd', 'asdasd', ' +91 9790218732', ' 1234567890', 'xxxx@gmail.com', '5485 5000 8000', '', '', 'B.E', 'new', '2020', NULL, NULL, '', 6, 5, '2021-04-17 00:00:00'),
(40, 6, NULL, NULL, '', '6', '3', 'candid', 'resource', 'kumar', 'male', '2021-04-19', NULL, 'asdasd12', 'asdasd', ' +91 9790218732', ' 1234567890', 'xxxx@gmail.com', '5485 5000 8000', '', '', 'B.E', 'new', '2020', NULL, NULL, '', 8, 6, '2021-04-19 00:00:00'),
(41, 7, NULL, NULL, '', '6', '3', 'canresource', 'technical', '', 'male', '1970-01-01', NULL, '', '', ' +91 9790218732', ' ', 'xxxx@gmail.com', '5485 5000 8000', '', '', 'B.E', 'new', '2020', NULL, NULL, '', 13, 7, '2021-04-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_round_details`
--

DROP TABLE IF EXISTS `candidate_round_details`;
CREATE TABLE IF NOT EXISTS `candidate_round_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candid_id` int(11) DEFAULT NULL,
  `round_id` int(11) DEFAULT NULL,
  `qn_id` int(11) DEFAULT NULL,
  `person_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `candidate_round_details`
--

INSERT INTO `candidate_round_details` (`id`, `candid_id`, `round_id`, `qn_id`, `person_id`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 35, 1, 1, NULL, 2, 3, '2021-04-09', NULL, NULL),
(2, 36, 2, 0, 7, 1, 3, '2021-04-13', NULL, NULL),
(3, 37, 2, 0, 1, 6, 3, '2021-04-15', NULL, NULL),
(4, 38, 1, 1, NULL, 2, 3, '2021-04-17', NULL, NULL),
(5, 39, 2, NULL, 1, 6, 3, '2021-04-17', NULL, NULL),
(7, 37, 2, NULL, 1, 1, NULL, NULL, NULL, NULL),
(8, 38, 2, NULL, 1, 1, NULL, NULL, NULL, NULL),
(9, 40, 1, 1, NULL, 2, 3, '2021-04-19', NULL, NULL),
(10, 41, 2, NULL, 1, 5, 3, '2021-04-19', NULL, NULL),
(11, 40, 2, NULL, 1, 1, 3, '2021-04-19', NULL, NULL),
(12, 41, 3, NULL, 3, 1, 3, '2021-04-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `client_master`
--

DROP TABLE IF EXISTS `client_master`;
CREATE TABLE IF NOT EXISTS `client_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `org_name` varchar(255) DEFAULT NULL,
  `org_type` int(11) DEFAULT NULL,
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
  `status` int(11) NOT NULL DEFAULT '1',
  `flow` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_master`
--

INSERT INTO `client_master` (`id`, `company_id`, `department_id`, `employee_id`, `client_name`, `org_name`, `org_type`, `designation`, `mobile_no1`, `mobile_no2`, `land_line_no`, `email_id1`, `email_id2`, `address1`, `address2`, `area`, `town_city`, `pincode`, `district`, `state`, `country`, `gst_no`, `website`, `status`, `flow`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '1', 3, 6, 'praba1', 'hp', 1, 'sales1123', '78945612311', '1123', '224456231234', 'uma1@gmail.com', 'uma1@gmail.com', 'no:1234', 'no:1234', 'vandalur1', 'chennai1', '6032021', 'kanchee1', 'tamil nadu123', 'india123', '1234567891', '', 1, 1, 3, '2021-03-30 13:44:45', 3, NULL),
(5, '1', 2, 12, 'uma', 'hcl', 2, 'sales', '7894561231', '', '22445623', 'uma@gmail.com', '', 'no:123', 'kovil street', 'vandalur', 'chennai', '603202', 'kanchee', 'tamil nadu', 'india', '123', '', 1, 1, 3, '2021-03-30 15:42:07', 0, NULL),
(6, '1', 3, 6, 'laxmi', 'TCS', 4, 'sales', '7894561231', '1', '22445623', 'uma1@gmail.com', 'uma@gmail.com', 'no:123', 'kovil street', 'vandalur', 'chennai', '603202', 'kanchee', 'tamil nadu', 'india1', '111111111111111', '', 1, 1, 3, '2021-04-01 13:45:59', NULL, NULL),
(7, '2', 2, 2, 'arun', 'Wibro', 2, 'sales1123', '78945612311', '1123', '224456231234', 'uma1@gmail.com', 'uma1@gmail.com', 'no:123', 'no:123', 'vandalur1', 'chennai1', '603202', 'kanchee1', 'tamil nadu123', 'india123', '123456789112412', 'ffgdgsfs', 1, 1, 3, '2021-04-02 10:14:02', 3, '2021-04-05 03:58:02'),
(8, 'Bluebase Software Services Pvt Ltd', 2, 12, 'rajeshwaran', 'hexaware', 2, 'seo', '321654987', '252352352', '234234234', 'gnath@gmail.com', 'sdcdc@gmail.com', 'Plot No 57 sri kamachi nagar,sirucheri ', 'csk', 'csk', 'chennai', '23423423', 'dfvfddv', 'dfgdfg', 'dfvdfv', '34r343', 'dfvgb', 1, 1, 3, '2021-04-21 11:57:48', NULL, NULL),
(9, 'Bluebase Software Services Pvt Ltd', 3, 6, 'radhaa', 'Forum', 2, 'development', '13256489', '3242', '34234', 'radha@gmail,com', 'df@gmail.com', 'vadapalani', 'aad', 'sdf', 'chennai', 'dfs', 'sdf', 'sdf', 'sdf', '434', 'vd', 1, 1, 3, '2021-04-21 15:39:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

DROP TABLE IF EXISTS `company_master`;
CREATE TABLE IF NOT EXISTS `company_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `companyname` varchar(100) DEFAULT NULL,
  `address` text,
  `phone_number` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `Gst_number` varchar(255) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`id`, `companyname`, `address`, `phone_number`, `email_id`, `Gst_number`, `status`, `created_on`) VALUES
(1, 'Bluebase Software Services Pvt Ltd', NULL, NULL, NULL, NULL, 1, '2021-04-13 08:51:54'),
(2, 'Quadsel Systems Private Limited', NULL, NULL, NULL, NULL, 1, '2021-04-13 08:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `cost_sheet_entry`
--

DROP TABLE IF EXISTS `cost_sheet_entry`;
CREATE TABLE IF NOT EXISTS `cost_sheet_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(11) DEFAULT NULL,
  `Phases` varchar(255) DEFAULT NULL,
  `task` varchar(255) DEFAULT NULL,
  `QTY` varchar(255) DEFAULT NULL,
  `Amount` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cost_sheet_entry`
--

INSERT INTO `cost_sheet_entry` (`id`, `enquiry_id`, `Phases`, `task`, `QTY`, `Amount`, `created_by`, `created_on`) VALUES
(1, 4, '1', 'thr', '45', '44', '6', NULL),
(2, 4, '1', '44', '44', '44', '6', NULL),
(3, 1, '1', 'we', '34', '34', '12', NULL),
(4, 1, '2', 'gg', '34', '34', '12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ctc_approval_table`
--

DROP TABLE IF EXISTS `ctc_approval_table`;
CREATE TABLE IF NOT EXISTS `ctc_approval_table` (
  `id` int(150) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `candidate_name` varchar(255) NOT NULL,
  `present_ctc` varchar(255) NOT NULL,
  `expected_ctc` varchar(255) NOT NULL,
  `ctc_offered` varchar(255) NOT NULL,
  `offered_take_home` varchar(255) NOT NULL,
  `offered_designation` varchar(255) NOT NULL,
  `dept_head_approval` varchar(255) NOT NULL,
  `dept_director_approval` varchar(255) NOT NULL,
  `CUG` varchar(255) NOT NULL,
  `mail_id` varchar(255) NOT NULL,
  `system` varchar(255) NOT NULL,
  `seating` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ctc_approval_table`
--

INSERT INTO `ctc_approval_table` (`id`, `candidate_id`, `candidate_name`, `present_ctc`, `expected_ctc`, `ctc_offered`, `offered_take_home`, `offered_designation`, `dept_head_approval`, `dept_director_approval`, `CUG`, `mail_id`, `system`, `seating`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 0, 'Bala', '1200', '1200', '1400', '1800', 'php', 'ash', 'lax', '7458965874', 'bala@bluebase.in', 'No', '100', 1, 1, '2020-11-04 07:24:28', 1, '2020-11-04 01:54:28'),
(2, 0, '3', '4000000.00', '7000000.00', '12000', '1000', 'web', 'yes', 'yes', '', 'maial.@gmail.com', '101', '10', 10, 1, '2020-11-24 02:32:23', NULL, NULL),
(3, 0, '3', '4000000.00', '7000000.00', '12000', '1000', 'web', 'yes', 'yes', '9585478596', 'maial.@gmail.com', '101', '10', 10, 1, '2020-11-24 02:33:55', NULL, NULL),
(4, 0, 'Gopinath', '4000000.00', '7000000.00', '120000', '220000', 'web', 'yes', 'yes', '8547854785', 'bala@gmail.com', 'yes', '10', 10, 1, '2020-11-24 02:35:02', NULL, NULL),
(5, 0, 'aswini', '654665', '546454', '546+54', '56+4', 'IT', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 1, 1, '2021-03-02 01:50:18', NULL, NULL),
(6, 0, 'aswini', '555555', '55555', '55555', '55555', 'IT', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 1, 1, '2021-03-02 01:51:16', NULL, NULL),
(7, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, '2021-03-02 01:53:54', NULL, NULL),
(8, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, '2021-03-02 01:58:18', NULL, NULL),
(9, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, '2021-03-02 02:06:36', NULL, NULL),
(10, 0, 'aswini', '12121223', '132464.2', '877897121', '212321321', 'sdgfdh', 'ok', 'ok', 'ok', 'abc@gmail.com', 'gdfgf', 'dgdh', 1, 1, '2021-03-02 02:16:21', NULL, NULL),
(11, 0, 'aswini', '52198', '15656', '15646', '1221213456', 'SOFTWARE', 'ok', 'ok', 'ok', 'abc@gmail.com', 'ok', 'ok', 1, 1, '2021-03-02 02:16:27', NULL, NULL),
(12, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, '2021-03-02 02:16:32', NULL, NULL),
(13, 0, 'aswini', '147852369', '369852147', '456321789', '65562565', 'software', 'ok', 'ok', 'ok', 'abc@gmail.com', 'ok', 'ok', 1, 1, '2021-03-02 02:16:37', NULL, NULL),
(14, 0, 'aswini', '654665', '546454', '546+54', '56+4', 'IT', 'ok', 'ok', 'ok', 'ok', 'ok', 'ok', 1, 1, '2021-03-02 02:16:41', NULL, NULL),
(15, 0, '', '', '', '', '', '', '', '', '', '', '', '', 1, 1, '2021-03-02 02:17:04', NULL, NULL),
(16, 0, 'aswini', '123456', '123456', '123456', '123456', 'IT', 'OK', 'OK', 'OK', 'abc@gmail.com', 'OK', 'OK', 1, 1, '2021-03-02 05:31:46', NULL, NULL),
(17, 0, 'Bala', '12345', '12345', '12345', '12000', 'IT', 'OK', 'OK', '123', 'abc@gmail.com', 'OK', 'OK', 1, 1, '2021-03-02 06:04:55', NULL, NULL),
(18, 0, 'Bala', '15000', '15000', '15000', '12500', 'IT', 'OK', 'OK', '1234', 'abc@gmail.com', 'OK', 'OK', 1, 1, '2021-03-02 06:11:54', NULL, NULL),
(19, 0, 'Bala', '15000', '15000', '15000', '12500', 'IT', 'OK', 'OK', '1234', 'abc@gmail.com', 'OK', 'OK', 1, 1, '2021-03-02 06:12:00', NULL, NULL),
(20, 0, 'Bala', '15000', '15000', '15000', '12500', 'IT', 'OK', 'OK', '1234', 'abc@gmail.com', 'OK', 'OK', 1, 1, '2021-03-02 06:39:11', NULL, NULL),
(21, 20, 'laxmipriya', '20000.00', '20000.00', '20000', '20000', 'erwe', 'dsf', 'cvx', 'fdfs', 'cv', 'xcv', 'fg', 16, 1, '2021-03-17 05:24:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department_mapping`
--

DROP TABLE IF EXISTS `department_mapping`;
CREATE TABLE IF NOT EXISTS `department_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(250) NOT NULL,
  `department_id` int(10) NOT NULL,
  `department_head` int(8) NOT NULL,
  `status` int(10) NOT NULL,
  `created_by` int(10) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department_mapping`
--

INSERT INTO `department_mapping` (`id`, `company_name`, `department_id`, `department_head`, `status`, `created_by`, `created_on`) VALUES
(1, '6', 8, 7, 1, 2, '2020-11-27'),
(2, '', 1, 7, 1, 2, '2020-11-27'),
(3, '1', 5, 7, 1, 2, '2021-02-16'),
(4, '6', 2, 7, 1, 2, '2021-02-22'),
(5, '2', 5, 6, 1, 2, '2021-03-15'),
(6, '1', 5, 6, 1, 2, '2021-03-17'),
(7, '1', 5, 7, 1, 2, '2021-03-23'),
(8, '1', 2, 56, 1, 2, '2021-03-26'),
(9, '1', 4, 56, 1, 2, '2021-03-26'),
(10, '1', 2, 43, 1, 2, '2021-03-26'),
(11, '1', 1, 46, 1, 2, '2021-03-26'),
(12, '1', 2, 46, 1, 2, '2021-03-26'),
(13, '1', 1, 47, 1, 2, '2021-03-26'),
(14, '1', 2, 43, 1, 2, '2021-03-26'),
(15, '1', 2, 43, 1, 2, '2021-03-26'),
(16, '1', 2, 46, 1, 2, '2021-03-26'),
(17, '1', 1, 46, 1, 2, '2021-03-26'),
(18, '1', 2, 46, 1, 2, '2021-03-26');

-- --------------------------------------------------------

--
-- Table structure for table `designation_master`
--

DROP TABLE IF EXISTS `designation_master`;
CREATE TABLE IF NOT EXISTS `designation_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_id` int(11) NOT NULL,
  `designation_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation_master`
--

INSERT INTO `designation_master` (`id`, `dep_id`, `designation_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'Managing Director', 1, 2, '2021-03-31', 2, '2021-03-31'),
(2, 1, 'AGM - Operations', 1, 2, '2021-03-31', 2, '2021-03-31'),
(3, 1, 'Operations Manager', 1, 2, '2021-03-31', 2, '2021-03-31'),
(4, 3, 'Team Lead - QC', 1, 2, '2021-03-31', 2, '2021-03-31'),
(5, 3, 'Senior Developer', 1, 2, '2021-03-31', 2, '2021-03-31'),
(6, 3, 'Junior Developers', 1, 2, '2021-03-31', 2, '2021-03-31'),
(7, 3, 'UI Developer', 1, 2, '2021-03-31', 2, '2021-03-31'),
(8, 3, 'Trainee', 1, 2, '2021-03-31', 2, '2021-03-31'),
(9, 3, 'RPA Developer', 1, 2, '2021-03-31', 2, '2021-03-31'),
(10, 3, 'Android Developer', 1, 2, '2021-03-31', 2, '2021-03-31'),
(11, 2, 'Website Designer', 1, 2, '2021-03-31', 2, '2021-03-31'),
(12, 4, 'SEO Analyst', 1, 2, '2021-03-31', 2, '2021-03-31'),
(13, 2, 'Graphic Designer', 1, 2, '2021-03-31', 2, '2021-03-31'),
(14, 5, 'Marketing', 1, 2, '2021-03-31', 2, '2021-03-31'),
(15, 6, 'HR & Admin', 1, 2, '2021-03-31', 2, '2021-03-31'),
(16, 6, 'Recruiter', 1, 2, '2021-03-31', 2, '2021-03-31'),
(17, 7, 'Finance - Manager', 1, 2, '2021-03-31', 2, '2021-03-31'),
(18, 8, 'Purchase', 1, 2, '2021-04-07', 2, '2021-04-07'),
(19, 9, 'Service', 1, 2, '2021-04-07', 2, '2021-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `division_master`
--

DROP TABLE IF EXISTS `division_master`;
CREATE TABLE IF NOT EXISTS `division_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_id` int(255) NOT NULL,
  `div_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `division_master`
--

INSERT INTO `division_master` (`id`, `dep_id`, `div_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'Management', 1, 2, '2021-03-30', 2, '2021-03-30'),
(2, 2, 'Software', 1, 2, '2021-03-30', 2, '2021-03-30'),
(3, 2, 'UI/UX', 1, 2, '2021-03-30', 2, '2021-03-30'),
(4, 2, 'RPA', 1, 2, '2021-03-30', 2, '2021-03-30'),
(5, 2, 'Mobile App', 1, 2, '2021-03-30', 2, '2021-03-30'),
(6, 3, 'Website', 1, 2, '2021-03-30', 2, '2021-03-30'),
(7, 4, 'Analyst', 1, 2, '2021-03-30', 2, '2021-03-30'),
(8, 3, 'Graphic Designing', 1, 2, '2021-03-30', 2, '2021-03-30'),
(9, 5, 'Marketing', 1, 2, '2021-03-30', 2, '2021-03-30'),
(10, 6, 'HR', 1, 2, '2021-03-30', 2, '2021-03-30'),
(11, 7, 'Finance', 1, 2, '2021-03-30', 2, '2021-03-30'),
(12, 8, 'Purchase', 1, 2, '2021-04-07', 2, '2021-04-07'),
(13, 9, 'Service', 1, 2, '2021-04-07', 2, '2021-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `doller_vendor_mastor`
--

DROP TABLE IF EXISTS `doller_vendor_mastor`;
CREATE TABLE IF NOT EXISTS `doller_vendor_mastor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendor_name` varchar(255) NOT NULL,
  `vendor_type` int(11) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `town_city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `district` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `pincode` int(11) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `swift_code` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `mail_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doller_vendor_mastor`
--

INSERT INTO `doller_vendor_mastor` (`id`, `vendor_name`, `vendor_type`, `address1`, `address2`, `area`, `town_city`, `state`, `district`, `country`, `pincode`, `account_name`, `account_no`, `swift_code`, `ifsc_code`, `mail_id`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(3, 'Quadsel System Pvt Ltd', 1, 'PURASAWALKAM', 'PB NO 48414', 'PURASAWALKAM', 'CHENNAI', 'KACHEEPPURAM', 'TAMIL NADU', 'INDIA', 600007, 'UCO BANK', '01000500001217', '0', 'UCBA0000100', 'UCO', 1, 3, '2021-04-05 10:09:05', 3, '2021-04-09 04:45:46'),
(4, 'Quadsel System Pvt Ltd', 1, '51 OLD 12', 'ASHOK MANASAROVER,1ST AVENUE,100 FEET ROAD', 'ASHOK NAGAR', 'CHENNAI', 'TAMIL NADU', 'KACHEEPPURAM', 'INDIA', 600083, 'CITY UNION BANK', '130109000092771', '0', 'CIUB0000130', 'ciub@gmail.com', 1, 3, '2021-04-05 10:20:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `employee_assessment_result`
--

DROP TABLE IF EXISTS `employee_assessment_result`;
CREATE TABLE IF NOT EXISTS `employee_assessment_result` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `qn_name_id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_assessment_result`
--

INSERT INTO `employee_assessment_result` (`id`, `emp_id`, `qn_name_id`, `question`, `answer`, `status`, `created_on`) VALUES
(1, 1, 1, '1', '3', 0, '2021-03-23'),
(2, 1, 1, '2', '3', 0, '2021-03-23'),
(9, 6, 1, '2', '4', 0, '2021-03-29'),
(8, 6, 1, '1', '2', 0, '2021-03-29');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance`
--

DROP TABLE IF EXISTS `employee_attendance`;
CREATE TABLE IF NOT EXISTS `employee_attendance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeCode` int(255) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `LogTime` varchar(255) DEFAULT NULL,
  `Direction` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=943 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_attendance`
--

INSERT INTO `employee_attendance` (`id`, `EmployeeCode`, `Date`, `LogTime`, `Direction`, `status`, `created_by`, `created_on`) VALUES
(1, 15, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(2, 15, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(3, 15, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(4, 15, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(5, 15, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(6, 15, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(7, 15, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(8, 15, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(9, 15, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(10, 15, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(11, 15, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(12, 15, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(13, 15, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(14, 15, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(15, 15, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(16, 15, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(17, 15, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(18, 15, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(19, 15, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(20, 15, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(21, 15, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(22, 15, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(23, 15, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(24, 15, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(25, 15, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(26, 15, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(27, 15, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(28, 15, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(29, 15, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(30, 15, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(31, 15, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(32, 15, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(33, 15, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(34, 15, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(35, 15, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(36, 15, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(37, 15, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(38, 15, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(39, 15, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(40, 15, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(41, 15, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(42, 15, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(43, 15, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(44, 15, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(45, 15, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(46, 15, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(47, 16, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(48, 16, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(49, 16, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(50, 16, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(51, 16, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(52, 16, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(53, 16, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(54, 16, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(55, 16, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(56, 16, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(57, 16, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(58, 16, '2021-03-06', '16:00:00', 'out', 1, 1, '2021-04-07'),
(59, 16, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(60, 16, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(61, 16, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(62, 16, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(63, 16, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(64, 16, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(65, 16, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(66, 16, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(67, 16, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(68, 16, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(69, 16, '2021-03-15', '10:00:00', 'in', 1, 1, '2021-04-07'),
(70, 16, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(71, 16, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(72, 16, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(73, 16, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(74, 16, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(75, 16, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(76, 16, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(77, 16, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(78, 16, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(79, 16, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(80, 16, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(81, 16, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(82, 16, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(83, 16, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(84, 16, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(85, 16, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(86, 16, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(87, 16, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(88, 16, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(89, 16, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(90, 16, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(91, 16, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(92, 16, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(93, 16, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(94, 16, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(95, 16, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(96, 16, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(97, 18, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(98, 18, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(99, 18, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(100, 18, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(101, 18, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(102, 18, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(103, 18, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(104, 18, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(105, 18, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(106, 18, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(107, 18, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(108, 18, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(109, 18, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(110, 18, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(111, 18, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(112, 18, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(113, 18, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(114, 18, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(115, 18, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(116, 18, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(117, 18, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(118, 18, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(119, 18, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(120, 18, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(121, 18, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(122, 18, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(123, 18, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(124, 18, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(125, 18, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(126, 18, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(127, 18, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(128, 18, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(129, 18, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(130, 18, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(131, 18, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(132, 18, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(133, 18, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(134, 18, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(135, 18, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(136, 18, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(137, 18, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(138, 18, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(139, 18, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(140, 18, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(141, 18, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(142, 18, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(143, 19, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(144, 19, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(145, 19, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(146, 19, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(147, 19, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(148, 19, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(149, 19, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(150, 19, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(151, 19, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(152, 19, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(153, 19, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(154, 19, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(155, 19, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(156, 19, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(157, 19, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(158, 19, '2021-03-18', '16:30:00', 'out', 1, 1, '2021-04-07'),
(159, 19, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(160, 19, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(161, 19, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(162, 19, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(163, 19, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(164, 19, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(165, 19, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(166, 19, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(167, 19, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(168, 19, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(169, 19, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(170, 19, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(171, 19, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(172, 19, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(173, 19, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(174, 19, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(175, 19, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(176, 19, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(177, 20, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(178, 20, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(179, 20, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(180, 20, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(181, 20, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(182, 20, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(183, 20, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(184, 20, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(185, 20, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(186, 20, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(187, 20, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(188, 20, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(189, 20, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(190, 20, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(191, 20, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(192, 20, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(193, 20, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(194, 20, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(195, 20, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(196, 20, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(197, 20, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(198, 20, '2021-03-12', '13:00:00', 'out', 1, 1, '2021-04-07'),
(199, 20, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(200, 20, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(201, 20, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(202, 20, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(203, 20, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(204, 20, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(205, 20, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(206, 20, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(207, 20, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(208, 20, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(209, 20, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(210, 20, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(211, 20, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(212, 20, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(213, 20, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(214, 20, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(215, 20, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(216, 20, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(217, 20, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(218, 20, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(219, 20, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(220, 20, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(221, 20, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(222, 20, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(223, 20, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(224, 20, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(225, 21, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(226, 21, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(227, 21, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(228, 21, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(229, 21, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(230, 21, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(231, 21, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(232, 21, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(233, 21, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(234, 21, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(235, 21, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(236, 21, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(237, 21, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(238, 21, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(239, 21, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(240, 21, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(241, 21, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(242, 21, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(243, 21, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(244, 21, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(245, 21, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(246, 21, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(247, 21, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(248, 21, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(249, 21, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(250, 21, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(251, 21, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(252, 21, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(253, 21, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(254, 21, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(255, 21, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(256, 21, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(257, 21, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(258, 21, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(259, 21, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(260, 21, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(261, 21, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(262, 21, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(263, 21, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(264, 21, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(265, 21, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(266, 21, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(267, 21, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(268, 21, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(269, 21, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(270, 21, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(271, 22, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(272, 22, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(273, 22, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(274, 22, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(275, 22, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(276, 22, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(277, 22, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(278, 22, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(279, 22, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(280, 22, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(281, 22, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(282, 22, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(283, 22, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(284, 22, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(285, 22, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(286, 22, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(287, 22, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(288, 22, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(289, 22, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(290, 22, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(291, 22, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(292, 22, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(293, 22, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(294, 22, '2021-03-15', '03:00:00', 'out', 1, 1, '2021-04-07'),
(295, 22, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(296, 22, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(297, 22, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(298, 22, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(299, 22, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(300, 22, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(301, 22, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(302, 22, '2021-03-22', '14:00:00', 'out', 1, 1, '2021-04-07'),
(303, 22, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(304, 22, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(305, 22, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(306, 22, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(307, 22, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(308, 22, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(309, 22, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(310, 22, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(311, 22, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(312, 22, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(313, 22, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(314, 22, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(315, 22, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(316, 22, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(317, 23, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(318, 23, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(319, 23, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(320, 23, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(321, 23, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(322, 23, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(323, 23, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(324, 23, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(325, 23, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(326, 23, '2021-03-05', '16:30:00', 'out', 1, 1, '2021-04-07'),
(327, 23, '2021-03-06', '10:00:00', 'in', 1, 1, '2021-04-07'),
(328, 23, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(329, 23, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(330, 23, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(331, 23, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(332, 23, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(333, 23, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(334, 23, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(335, 23, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(336, 23, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(337, 23, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(338, 23, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(339, 23, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(340, 23, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(341, 23, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(342, 23, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(343, 23, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(344, 23, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(345, 23, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(346, 23, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(347, 23, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(348, 23, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(349, 23, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(350, 23, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(351, 23, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(352, 23, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(353, 23, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(354, 23, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(355, 23, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(356, 23, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(357, 24, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(358, 24, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(359, 24, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(360, 24, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(361, 24, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(362, 24, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(363, 24, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(364, 24, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(365, 24, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(366, 24, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(367, 24, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(368, 24, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(369, 24, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(370, 24, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(371, 24, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(372, 24, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(373, 24, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(374, 24, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(375, 24, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(376, 24, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(377, 24, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(378, 24, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(379, 24, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(380, 24, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(381, 24, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(382, 24, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(383, 24, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(384, 24, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(385, 24, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(386, 24, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(387, 24, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(388, 24, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(389, 24, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(390, 24, '2021-03-20', '17:00:00', 'out', 1, 1, '2021-04-07'),
(391, 24, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(392, 24, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(393, 24, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(394, 24, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(395, 24, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(396, 24, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(397, 24, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(398, 24, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(399, 24, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(400, 24, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(401, 24, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(402, 24, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(403, 24, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(404, 24, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(405, 24, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(406, 24, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(407, 25, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(408, 25, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(409, 25, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(410, 25, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(411, 25, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(412, 25, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(413, 25, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(414, 25, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(415, 25, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(416, 25, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(417, 25, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(418, 25, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(419, 25, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(420, 25, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(421, 25, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(422, 25, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(423, 25, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(424, 25, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(425, 25, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(426, 25, '2021-03-11', '16:00:00', 'out', 1, 1, '2021-04-07'),
(427, 25, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(428, 25, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(429, 25, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(430, 25, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(431, 25, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(432, 25, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(433, 25, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(434, 25, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(435, 25, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(436, 25, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(437, 25, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(438, 25, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(439, 25, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(440, 25, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(441, 25, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(442, 25, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(443, 25, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(444, 25, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(445, 25, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(446, 25, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(447, 25, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(448, 25, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(449, 25, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(450, 25, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(451, 25, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(452, 25, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(453, 25, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(454, 25, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(455, 26, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(456, 26, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(457, 26, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(458, 26, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(459, 26, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(460, 26, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(461, 26, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(462, 26, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(463, 26, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(464, 26, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(465, 26, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(466, 26, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(467, 26, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(468, 26, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(469, 26, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(470, 26, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(471, 26, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(472, 26, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(473, 26, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(474, 26, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(475, 26, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(476, 26, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(477, 26, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(478, 26, '2021-03-15', '16:00:00', 'out', 1, 1, '2021-04-07'),
(479, 26, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(480, 26, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(481, 26, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(482, 26, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(483, 26, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(484, 26, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(485, 26, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(486, 26, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(487, 26, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(488, 26, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(489, 26, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(490, 26, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(491, 26, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(492, 26, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(493, 26, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(494, 26, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(495, 26, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(496, 26, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(497, 26, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(498, 26, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(499, 26, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(500, 26, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(501, 26, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(502, 26, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(503, 27, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(504, 27, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(505, 27, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(506, 27, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(507, 27, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(508, 27, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(509, 27, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(510, 27, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(511, 27, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(512, 27, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(513, 27, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(514, 27, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(515, 27, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(516, 27, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(517, 27, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(518, 27, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(519, 27, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(520, 27, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(521, 27, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(522, 27, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(523, 27, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(524, 27, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(525, 27, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(526, 27, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(527, 27, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(528, 27, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(529, 27, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(530, 27, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(531, 27, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(532, 27, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(533, 27, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(534, 27, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(535, 17, '2021-03-01', '09:00:00', 'in', 1, 1, '2021-04-07'),
(536, 17, '2021-03-01', '18:00:00', 'out', 1, 1, '2021-04-07'),
(537, 17, '2021-03-02', '09:00:00', 'in', 1, 1, '2021-04-07'),
(538, 17, '2021-03-02', '18:00:00', 'out', 1, 1, '2021-04-07'),
(539, 17, '2021-03-03', '09:00:00', 'in', 1, 1, '2021-04-07'),
(540, 17, '2021-03-03', '18:00:00', 'out', 1, 1, '2021-04-07'),
(541, 17, '2021-03-04', '09:00:00', 'in', 1, 1, '2021-04-07'),
(542, 17, '2021-03-04', '18:00:00', 'out', 1, 1, '2021-04-07'),
(543, 17, '2021-03-05', '09:00:00', 'in', 1, 1, '2021-04-07'),
(544, 17, '2021-03-05', '18:00:00', 'out', 1, 1, '2021-04-07'),
(545, 17, '2021-03-06', '09:00:00', 'in', 1, 1, '2021-04-07'),
(546, 17, '2021-03-06', '18:00:00', 'out', 1, 1, '2021-04-07'),
(547, 17, '2021-03-08', '09:00:00', 'in', 1, 1, '2021-04-07'),
(548, 17, '2021-03-08', '18:00:00', 'out', 1, 1, '2021-04-07'),
(549, 17, '2021-03-09', '09:00:00', 'in', 1, 1, '2021-04-07'),
(550, 17, '2021-03-09', '18:00:00', 'out', 1, 1, '2021-04-07'),
(551, 17, '2021-03-10', '09:00:00', 'in', 1, 1, '2021-04-07'),
(552, 17, '2021-03-10', '18:00:00', 'out', 1, 1, '2021-04-07'),
(553, 17, '2021-03-11', '09:00:00', 'in', 1, 1, '2021-04-07'),
(554, 17, '2021-03-11', '18:00:00', 'out', 1, 1, '2021-04-07'),
(555, 17, '2021-03-12', '09:00:00', 'in', 1, 1, '2021-04-07'),
(556, 17, '2021-03-12', '18:00:00', 'out', 1, 1, '2021-04-07'),
(557, 17, '2021-03-15', '09:00:00', 'in', 1, 1, '2021-04-07'),
(558, 17, '2021-03-15', '18:00:00', 'out', 1, 1, '2021-04-07'),
(559, 17, '2021-03-16', '09:00:00', 'in', 1, 1, '2021-04-07'),
(560, 17, '2021-03-16', '13:00:00', 'out', 1, 1, '2021-04-07'),
(561, 17, '2021-03-17', '09:00:00', 'in', 1, 1, '2021-04-07'),
(562, 17, '2021-03-17', '18:00:00', 'out', 1, 1, '2021-04-07'),
(563, 17, '2021-03-18', '09:00:00', 'in', 1, 1, '2021-04-07'),
(564, 17, '2021-03-18', '18:00:00', 'out', 1, 1, '2021-04-07'),
(565, 17, '2021-03-19', '09:00:00', 'in', 1, 1, '2021-04-07'),
(566, 17, '2021-03-19', '18:00:00', 'out', 1, 1, '2021-04-07'),
(567, 17, '2021-03-20', '09:00:00', 'in', 1, 1, '2021-04-07'),
(568, 17, '2021-03-20', '18:00:00', 'out', 1, 1, '2021-04-07'),
(569, 17, '2021-03-22', '09:00:00', 'in', 1, 1, '2021-04-07'),
(570, 17, '2021-03-22', '18:00:00', 'out', 1, 1, '2021-04-07'),
(571, 17, '2021-03-23', '09:00:00', 'in', 1, 1, '2021-04-07'),
(572, 17, '2021-03-23', '18:00:00', 'out', 1, 1, '2021-04-07'),
(573, 17, '2021-03-24', '09:00:00', 'in', 1, 1, '2021-04-07'),
(574, 17, '2021-03-24', '18:00:00', 'out', 1, 1, '2021-04-07'),
(575, 17, '2021-03-25', '09:00:00', 'in', 1, 1, '2021-04-07'),
(576, 17, '2021-03-25', '18:00:00', 'out', 1, 1, '2021-04-07'),
(577, 17, '2021-03-26', '09:00:00', 'in', 1, 1, '2021-04-07'),
(578, 17, '2021-03-26', '18:00:00', 'out', 1, 1, '2021-04-07'),
(579, 17, '2021-03-29', '09:00:00', 'in', 1, 1, '2021-04-07'),
(580, 17, '2021-03-29', '18:00:00', 'out', 1, 1, '2021-04-07'),
(581, 17, '2021-03-30', '09:00:00', 'in', 1, 1, '2021-04-07'),
(582, 17, '2021-03-30', '18:00:00', 'out', 1, 1, '2021-04-07'),
(583, 17, '2021-03-31', '09:00:00', 'in', 1, 1, '2021-04-07'),
(584, 17, '2021-03-31', '18:00:00', 'out', 1, 1, '2021-04-07'),
(585, 1285, '2021-03-22', '10:31:15.0000000', 'in', 1, 1, '2021-04-21'),
(586, 22, '2021-03-22', '14:32:15.0000000', 'in', 1, 1, '2021-04-21'),
(587, 1184, '2021-03-22', '16:24:44.0000000', 'in', 1, 1, '2021-04-21'),
(588, 15, '2021-03-22', '17:46:36.0000000', 'in', 1, 1, '2021-04-21'),
(589, 1141, '2021-03-22', '17:58:16.0000000', 'in', 1, 1, '2021-04-21'),
(590, 58, '2021-03-22', '17:59:59.0000000', 'in', 1, 1, '2021-04-21'),
(591, 23, '2021-03-22', '18:00:04.0000000', 'in', 1, 1, '2021-04-21'),
(592, 52, '2021-03-22', '18:01:02.0000000', 'in', 1, 1, '2021-04-21'),
(593, 22, '2021-03-22', '18:01:49.0000000', 'in', 1, 1, '2021-04-21'),
(594, 19, '2021-03-22', '18:01:52.0000000', 'in', 1, 1, '2021-04-21'),
(595, 25, '2021-03-22', '18:01:56.0000000', 'in', 1, 1, '2021-04-21'),
(596, 24, '2021-03-22', '18:01:58.0000000', 'in', 1, 1, '2021-04-21'),
(597, 1290, '2021-03-22', '18:02:44.0000000', 'in', 1, 1, '2021-04-21'),
(598, 26, '2021-03-22', '18:03:47.0000000', 'in', 1, 1, '2021-04-21'),
(599, 1123, '2021-03-22', '18:51:53.0000000', 'in', 1, 1, '2021-04-21'),
(600, 19, '2021-03-22', '18:51:55.0000000', 'in', 1, 1, '2021-04-21'),
(601, 1285, '2021-03-22', '18:52:56.0000000', 'in', 1, 1, '2021-04-21'),
(602, 1272, '2021-03-22', '18:54:24.0000000', 'in', 1, 1, '2021-04-21'),
(603, 1272, '2021-03-22', '18:54:34.0000000', 'in', 1, 1, '2021-04-21'),
(604, 1272, '2021-03-22', '18:54:35.0000000', 'in', 1, 1, '2021-04-21'),
(605, 1289, '2021-03-22', '18:55:11.0000000', 'in', 1, 1, '2021-04-21'),
(606, 3333, '2021-03-22', '19:05:32.0000000', 'in', 1, 1, '2021-04-21'),
(607, 70000, '2021-03-22', '19:09:25.0000000', 'in', 1, 1, '2021-04-21'),
(608, 70000, '2021-03-22', '19:11:08.0000000', 'in', 1, 1, '2021-04-21'),
(609, 70000, '2021-03-22', '19:11:24.0000000', 'in', 1, 1, '2021-04-21'),
(610, 70000, '2021-03-22', '20:39:29.0000000', 'in', 1, 1, '2021-04-21'),
(611, 70000, '2021-03-23', '01:56:37.0000000', 'in', 1, 1, '2021-04-21'),
(612, 70000, '2021-03-23', '01:59:03.0000000', 'in', 1, 1, '2021-04-21'),
(613, 70000, '2021-03-23', '05:54:58.0000000', 'in', 1, 1, '2021-04-21'),
(614, 70000, '2021-03-23', '07:37:02.0000000', 'in', 1, 1, '2021-04-21'),
(615, 25, '2021-03-23', '08:46:57.0000000', 'in', 1, 1, '2021-04-21'),
(616, 58, '2021-03-23', '08:47:33.0000000', 'in', 1, 1, '2021-04-21'),
(617, 16, '2021-03-23', '08:47:42.0000000', 'in', 1, 1, '2021-04-21'),
(618, 1289, '2021-03-23', '08:57:13.0000000', 'in', 1, 1, '2021-04-21'),
(619, 52, '2021-03-23', '08:58:12.0000000', 'in', 1, 1, '2021-04-21'),
(620, 20, '2021-03-23', '09:00:26.0000000', 'in', 1, 1, '2021-04-21'),
(621, 22, '2021-03-23', '09:06:19.0000000', 'in', 1, 1, '2021-04-21'),
(622, 1259, '2021-03-23', '09:11:04.0000000', 'in', 1, 1, '2021-04-21'),
(623, 26, '2021-03-23', '09:11:18.0000000', 'in', 1, 1, '2021-04-21'),
(624, 19, '2021-03-23', '09:11:52.0000000', 'in', 1, 1, '2021-04-21'),
(625, 24, '2021-03-23', '09:13:09.0000000', 'in', 1, 1, '2021-04-21'),
(626, 1002, '2021-03-23', '09:13:14.0000000', 'in', 1, 1, '2021-04-21'),
(627, 23, '2021-03-23', '09:15:57.0000000', 'in', 1, 1, '2021-04-21'),
(628, 3333, '2021-03-23', '09:16:23.0000000', 'in', 1, 1, '2021-04-21'),
(629, 15, '2021-03-23', '09:16:51.0000000', 'in', 1, 1, '2021-04-21'),
(630, 19, '2021-03-23', '09:17:18.0000000', 'in', 1, 1, '2021-04-21'),
(631, 1285, '2021-03-23', '09:22:28.0000000', 'in', 1, 1, '2021-04-21'),
(632, 17, '2021-03-23', '09:23:57.0000000', 'in', 1, 1, '2021-04-21'),
(633, 755, '2021-03-23', '09:26:13.0000000', 'in', 1, 1, '2021-04-21'),
(634, 1290, '2021-03-23', '09:27:37.0000000', 'in', 1, 1, '2021-04-21'),
(635, 1271, '2021-03-23', '09:32:52.0000000', 'in', 1, 1, '2021-04-21'),
(636, 1123, '2021-03-23', '09:34:43.0000000', 'in', 1, 1, '2021-04-21'),
(637, 1184, '2021-03-23', '09:40:17.0000000', 'in', 1, 1, '2021-04-21'),
(638, 888, '2021-03-23', '10:59:04.0000000', 'in', 1, 1, '2021-04-21'),
(639, 888, '2021-03-23', '12:34:05.0000000', 'in', 1, 1, '2021-04-21'),
(640, 19, '2021-03-23', '14:10:53.0000000', 'in', 1, 1, '2021-04-21'),
(641, 1272, '2021-03-23', '14:20:04.0000000', 'in', 1, 1, '2021-04-21'),
(642, 58, '2021-03-23', '17:06:00.0000000', 'in', 1, 1, '2021-04-21'),
(643, 61, '2021-03-23', '17:06:09.0000000', 'in', 1, 1, '2021-04-21'),
(644, 1281, '2021-03-23', '17:06:14.0000000', 'in', 1, 1, '2021-04-21'),
(645, 25, '2021-03-23', '17:56:52.0000000', 'in', 1, 1, '2021-04-21'),
(646, 3333, '2021-03-23', '18:00:28.0000000', 'in', 1, 1, '2021-04-21'),
(647, 61, '2021-03-23', '18:01:46.0000000', 'in', 1, 1, '2021-04-21'),
(648, 1281, '2021-03-23', '18:01:48.0000000', 'in', 1, 1, '2021-04-21'),
(649, 58, '2021-03-23', '18:01:49.0000000', 'in', 1, 1, '2021-04-21'),
(650, 58, '2021-03-23', '18:01:55.0000000', 'in', 1, 1, '2021-04-21'),
(651, 58, '2021-03-23', '18:02:02.0000000', 'in', 1, 1, '2021-04-21'),
(652, 16, '2021-03-23', '18:02:11.0000000', 'in', 1, 1, '2021-04-21'),
(653, 23, '2021-03-23', '18:02:18.0000000', 'in', 1, 1, '2021-04-21'),
(654, 58, '2021-03-23', '18:02:32.0000000', 'in', 1, 1, '2021-04-21'),
(655, 26, '2021-03-23', '18:03:41.0000000', 'in', 1, 1, '2021-04-21'),
(656, 21, '2021-03-23', '18:05:56.0000000', 'out', 1, 1, '2021-04-21'),
(657, 21, '2021-03-23', '18:06:00.0000000', 'out', 1, 1, '2021-04-21'),
(658, 52, '2021-03-23', '18:06:31.0000000', 'out', 1, 1, '2021-04-21'),
(659, 19, '2021-03-23', '18:06:34.0000000', 'out', 1, 1, '2021-04-21'),
(660, 22, '2021-03-23', '18:10:06.0000000', 'out', 1, 1, '2021-04-21'),
(661, 24, '2021-03-23', '18:10:09.0000000', 'out', 1, 1, '2021-04-21'),
(662, 20, '2021-03-23', '18:10:11.0000000', 'out', 1, 1, '2021-04-21'),
(663, 15, '2021-03-23', '18:10:50.0000000', 'out', 1, 1, '2021-04-21'),
(664, 1285, '2021-03-23', '18:16:57.0000000', 'out', 1, 1, '2021-04-21'),
(665, 19, '2021-03-23', '18:39:38.0000000', 'out', 1, 1, '2021-04-21'),
(666, 1272, '2021-03-23', '18:54:39.0000000', 'out', 1, 1, '2021-04-21'),
(667, 1289, '2021-03-23', '19:04:22.0000000', 'out', 1, 1, '2021-04-21'),
(668, 1123, '2021-03-23', '19:04:26.0000000', 'out', 1, 1, '2021-04-21'),
(669, 19, '2021-03-23', '19:54:59.0000000', 'out', 1, 1, '2021-04-21'),
(670, 70000, '2021-03-23', '20:51:56.0000000', 'out', 1, 1, '2021-04-21'),
(671, 70000, '2021-03-23', '21:14:42.0000000', 'out', 1, 1, '2021-04-21'),
(672, 1290, '2021-03-23', '22:05:02.0000000', 'out', 1, 1, '2021-04-21'),
(673, 847, '2021-03-23', '22:44:08.0000000', 'out', 1, 1, '2021-04-21'),
(674, 70000, '2021-03-23', '22:46:19.0000000', 'out', 1, 1, '2021-04-21'),
(675, 70000, '2021-03-24', '06:27:32.0000000', 'in', 1, 1, '2021-04-21'),
(676, 70000, '2021-03-24', '07:41:19.0000000', 'in', 1, 1, '2021-04-21'),
(677, 21, '2021-03-24', '08:40:33.0000000', 'in', 1, 1, '2021-04-21'),
(678, 25, '2021-03-24', '08:53:09.0000000', 'in', 1, 1, '2021-04-21'),
(679, 1289, '2021-03-24', '08:56:16.0000000', 'in', 1, 1, '2021-04-21'),
(680, 1141, '2021-03-24', '08:56:52.0000000', 'in', 1, 1, '2021-04-21'),
(681, 20, '2021-03-24', '08:58:25.0000000', 'in', 1, 1, '2021-04-21'),
(682, 22, '2021-03-24', '08:58:28.0000000', 'in', 1, 1, '2021-04-21'),
(683, 26, '2021-03-24', '08:59:02.0000000', 'in', 1, 1, '2021-04-21'),
(684, 26, '2021-03-24', '08:59:08.0000000', 'in', 1, 1, '2021-04-21'),
(685, 19, '2021-03-24', '09:00:08.0000000', 'in', 1, 1, '2021-04-21'),
(686, 19, '2021-03-24', '09:00:19.0000000', 'in', 1, 1, '2021-04-21'),
(687, 24, '2021-03-24', '09:07:59.0000000', 'in', 1, 1, '2021-04-21'),
(688, 847, '2021-03-24', '09:09:11.0000000', 'in', 1, 1, '2021-04-21'),
(689, 15, '2021-03-24', '09:09:19.0000000', 'in', 1, 1, '2021-04-21'),
(690, 3333, '2021-03-24', '09:10:09.0000000', 'in', 1, 1, '2021-04-21'),
(691, 52, '2021-03-24', '09:17:26.0000000', 'in', 1, 1, '2021-04-21'),
(692, 1002, '2021-03-24', '09:20:09.0000000', 'in', 1, 1, '2021-04-21'),
(693, 23, '2021-03-24', '09:21:56.0000000', 'in', 1, 1, '2021-04-21'),
(694, 1290, '2021-03-24', '09:27:56.0000000', 'in', 1, 1, '2021-04-21'),
(695, 1285, '2021-03-24', '09:39:09.0000000', 'in', 1, 1, '2021-04-21'),
(696, 17, '2021-03-24', '09:41:19.0000000', 'in', 1, 1, '2021-04-21'),
(697, 1271, '2021-03-24', '09:43:40.0000000', 'in', 1, 1, '2021-04-21'),
(698, 755, '2021-03-24', '09:44:34.0000000', 'in', 1, 1, '2021-04-21'),
(699, 888, '2021-03-24', '09:59:12.0000000', 'in', 1, 1, '2021-04-21'),
(700, 847, '2021-03-24', '10:11:26.0000000', 'in', 1, 1, '2021-04-21'),
(701, 1123, '2021-03-24', '10:11:31.0000000', 'in', 1, 1, '2021-04-21'),
(702, 847, '2021-03-24', '12:42:53.0000000', 'in', 1, 1, '2021-04-21'),
(703, 19, '2021-03-24', '13:29:46.0000000', 'in', 1, 1, '2021-04-21'),
(704, 19, '2021-03-24', '13:51:02.0000000', 'in', 1, 1, '2021-04-21'),
(705, 19, '2021-03-24', '14:39:43.0000000', 'in', 1, 1, '2021-04-21'),
(706, 19, '2021-03-24', '16:51:43.0000000', 'in', 1, 1, '2021-04-21'),
(707, 19, '2021-03-24', '16:51:59.0000000', 'out', 1, 1, '2021-04-21'),
(708, 19, '2021-03-24', '16:52:08.0000000', 'in', 1, 1, '2021-04-21'),
(709, 19, '2021-03-24', '16:52:13.0000000', 'in', 1, 1, '2021-04-21'),
(710, 19, '2021-03-24', '16:52:18.0000000', 'in', 1, 1, '2021-04-21'),
(711, 19, '2021-03-24', '16:52:22.0000000', 'in', 1, 1, '2021-04-21'),
(712, 19, '2021-03-24', '16:52:47.0000000', 'in', 1, 1, '2021-04-21'),
(713, 19, '2021-03-24', '16:52:55.0000000', 'out', 1, 1, '2021-04-21'),
(714, 19, '2021-03-24', '16:53:03.0000000', 'out', 1, 1, '2021-04-21'),
(715, 19, '2021-03-24', '16:53:10.0000000', 'out', 1, 1, '2021-04-21'),
(716, 19, '2021-03-24', '16:53:17.0000000', 'in', 1, 1, '2021-04-21'),
(717, 19, '2021-03-24', '16:53:25.0000000', 'in', 1, 1, '2021-04-21'),
(718, 15, '2021-03-24', '16:58:30.0000000', 'in', 1, 1, '2021-04-21'),
(719, 15, '2021-03-24', '16:58:39.0000000', 'in', 1, 1, '2021-04-21'),
(720, 15, '2021-03-24', '17:10:42.0000000', 'in', 1, 1, '2021-04-21'),
(721, 15, '2021-03-24', '17:10:46.0000000', 'in', 1, 1, '2021-04-21'),
(722, 15, '2021-03-24', '17:10:53.0000000', 'in', 1, 1, '2021-04-21'),
(723, 15, '2021-03-24', '17:11:01.0000000', 'in', 1, 1, '2021-04-21'),
(724, 15, '2021-03-24', '17:13:07.0000000', 'out', 1, 1, '2021-04-21'),
(725, 15, '2021-03-24', '17:14:24.0000000', 'in', 1, 1, '2021-04-21'),
(726, 15, '2021-03-24', '17:14:28.0000000', 'out', 1, 1, '2021-04-21'),
(727, 1002, '2021-03-24', '17:15:47.0000000', 'out', 1, 1, '2021-04-21'),
(728, 888, '2021-03-24', '17:22:45.0000000', 'out', 1, 1, '2021-04-21'),
(729, 1141, '2021-03-24', '17:57:51.0000000', 'out', 1, 1, '2021-04-21'),
(730, 21, '2021-03-24', '18:02:31.0000000', 'out', 1, 1, '2021-04-21'),
(731, 23, '2021-03-24', '18:02:41.0000000', 'out', 1, 1, '2021-04-21'),
(732, 15, '2021-03-24', '18:03:14.0000000', 'in', 1, 1, '2021-04-21'),
(733, 15, '2021-03-24', '18:03:19.0000000', 'out', 1, 1, '2021-04-21'),
(734, 26, '2021-03-24', '18:03:52.0000000', 'out', 1, 1, '2021-04-21'),
(735, 25, '2021-03-24', '18:03:55.0000000', 'out', 1, 1, '2021-04-21'),
(736, 17, '2021-03-24', '18:04:04.0000000', 'out', 1, 1, '2021-04-21'),
(737, 22, '2021-03-24', '18:06:19.0000000', 'out', 1, 1, '2021-04-21'),
(738, 52, '2021-03-24', '18:06:21.0000000', 'out', 1, 1, '2021-04-21'),
(739, 19, '2021-03-24', '18:08:16.0000000', 'out', 1, 1, '2021-04-21'),
(740, 24, '2021-03-24', '18:08:33.0000000', 'out', 1, 1, '2021-04-21'),
(741, 3333, '2021-03-24', '18:13:37.0000000', 'out', 1, 1, '2021-04-21'),
(742, 1285, '2021-03-24', '18:20:04.0000000', 'out', 1, 1, '2021-04-21'),
(743, 1289, '2021-03-24', '18:20:36.0000000', 'out', 1, 1, '2021-04-21'),
(744, 20, '2021-03-24', '18:46:52.0000000', 'out', 1, 1, '2021-04-21'),
(745, 1123, '2021-03-24', '18:47:29.0000000', 'out', 1, 1, '2021-04-21'),
(746, 19, '2021-03-24', '19:38:51.0000000', 'out', 1, 1, '2021-04-21'),
(747, 847, '2021-03-24', '20:15:41.0000000', 'out', 1, 1, '2021-04-21'),
(748, 70000, '2021-03-25', '06:17:51.0000000', 'out', 1, 1, '2021-04-21'),
(749, 70000, '2021-03-25', '06:18:07.0000000', 'in', 1, 1, '2021-04-21'),
(750, 70000, '2021-03-25', '07:38:05.0000000', 'out', 1, 1, '2021-04-21'),
(751, 24, '2021-03-25', '08:43:36.0000000', 'in', 1, 1, '2021-04-21'),
(752, 21, '2021-03-25', '08:43:45.0000000', 'in', 1, 1, '2021-04-21'),
(753, 25, '2021-03-25', '08:57:54.0000000', 'in', 1, 1, '2021-04-21'),
(754, 19, '2021-03-25', '08:58:13.0000000', 'in', 1, 1, '2021-04-21'),
(755, 22, '2021-03-25', '08:58:15.0000000', 'in', 1, 1, '2021-04-21'),
(756, 20, '2021-03-25', '08:59:54.0000000', 'in', 1, 1, '2021-04-21'),
(757, 15, '2021-03-25', '09:00:17.0000000', 'in', 1, 1, '2021-04-21'),
(758, 3333, '2021-03-25', '09:02:01.0000000', 'in', 1, 1, '2021-04-21'),
(759, 1290, '2021-03-25', '09:03:21.0000000', 'out', 1, 1, '2021-04-21'),
(760, 1290, '2021-03-25', '09:03:29.0000000', 'in', 1, 1, '2021-04-21'),
(761, 23, '2021-03-25', '09:04:07.0000000', 'in', 1, 1, '2021-04-21'),
(762, 1289, '2021-03-25', '09:04:13.0000000', 'in', 1, 1, '2021-04-21'),
(763, 70000, '2021-03-25', '09:05:13.0000000', 'in', 1, 1, '2021-04-21'),
(764, 70000, '2021-03-25', '09:05:43.0000000', 'out', 1, 1, '2021-04-21'),
(765, 1272, '2021-03-25', '09:12:38.0000000', 'in', 1, 1, '2021-04-21'),
(766, 1285, '2021-03-25', '09:13:12.0000000', 'in', 1, 1, '2021-04-21'),
(767, 1002, '2021-03-25', '09:14:48.0000000', 'in', 1, 1, '2021-04-21'),
(768, 52, '2021-03-25', '09:18:49.0000000', 'in', 1, 1, '2021-04-21'),
(769, 847, '2021-03-25', '09:20:28.0000000', 'in', 1, 1, '2021-04-21'),
(770, 1123, '2021-03-25', '09:25:13.0000000', 'in', 1, 1, '2021-04-21'),
(771, 1141, '2021-03-25', '09:33:25.0000000', 'in', 1, 1, '2021-04-21'),
(772, 888, '2021-03-25', '09:47:01.0000000', 'in', 1, 1, '2021-04-21'),
(773, 1259, '2021-03-25', '09:56:41.0000000', 'out', 1, 1, '2021-04-21'),
(774, 1259, '2021-03-25', '09:56:45.0000000', 'in', 1, 1, '2021-04-21'),
(775, 1271, '2021-03-25', '09:57:42.0000000', 'out', 1, 1, '2021-04-21'),
(776, 1271, '2021-03-25', '09:57:46.0000000', 'in', 1, 1, '2021-04-21'),
(777, 17, '2021-03-25', '10:05:05.0000000', 'in', 1, 1, '2021-04-21'),
(778, 19, '2021-03-25', '10:45:05.0000000', 'in', 1, 1, '2021-04-21'),
(779, 847, '2021-03-25', '10:52:47.0000000', 'out', 1, 1, '2021-04-21'),
(780, 847, '2021-03-25', '10:52:51.0000000', 'in', 1, 1, '2021-04-21'),
(781, 1272, '2021-03-25', '12:03:26.0000000', 'out', 1, 1, '2021-04-21'),
(782, 1290, '2021-03-25', '12:53:44.0000000', 'out', 1, 1, '2021-04-21'),
(783, 1290, '2021-03-25', '13:03:57.0000000', 'in', 1, 1, '2021-04-21'),
(784, 1272, '2021-03-25', '14:09:44.0000000', 'in', 1, 1, '2021-04-21');
INSERT INTO `employee_attendance` (`id`, `EmployeeCode`, `Date`, `LogTime`, `Direction`, `status`, `created_by`, `created_on`) VALUES
(785, 19, '2021-03-25', '14:45:01.0000000', 'out', 1, 1, '2021-04-21'),
(786, 847, '2021-03-25', '16:15:46.0000000', 'out', 1, 1, '2021-04-21'),
(787, 847, '2021-03-25', '16:26:03.0000000', 'in', 1, 1, '2021-04-21'),
(788, 1259, '2021-03-25', '17:43:24.0000000', 'out', 1, 1, '2021-04-21'),
(789, 1141, '2021-03-25', '18:01:32.0000000', 'out', 1, 1, '2021-04-21'),
(790, 21, '2021-03-25', '18:03:56.0000000', 'out', 1, 1, '2021-04-21'),
(791, 23, '2021-03-25', '18:03:58.0000000', 'out', 1, 1, '2021-04-21'),
(792, 15, '2021-03-25', '18:04:17.0000000', 'out', 1, 1, '2021-04-21'),
(793, 24, '2021-03-25', '18:04:49.0000000', 'out', 1, 1, '2021-04-21'),
(794, 22, '2021-03-25', '18:04:51.0000000', 'out', 1, 1, '2021-04-21'),
(795, 3333, '2021-03-25', '18:05:00.0000000', 'out', 1, 1, '2021-04-21'),
(796, 25, '2021-03-25', '18:05:01.0000000', 'out', 1, 1, '2021-04-21'),
(797, 19, '2021-03-25', '18:05:12.0000000', 'out', 1, 1, '2021-04-21'),
(798, 20, '2021-03-25', '18:06:03.0000000', 'out', 1, 1, '2021-04-21'),
(799, 52, '2021-03-25', '18:11:44.0000000', 'out', 1, 1, '2021-04-21'),
(800, 847, '2021-03-25', '18:17:52.0000000', 'out', 1, 1, '2021-04-21'),
(801, 1290, '2021-03-25', '18:40:59.0000000', 'out', 1, 1, '2021-04-21'),
(802, 1285, '2021-03-25', '18:41:07.0000000', 'out', 1, 1, '2021-04-21'),
(803, 1271, '2021-03-25', '18:41:23.0000000', 'out', 1, 1, '2021-04-21'),
(804, 888, '2021-03-25', '18:52:49.0000000', 'out', 1, 1, '2021-04-21'),
(805, 1123, '2021-03-25', '18:53:28.0000000', 'out', 1, 1, '2021-04-21'),
(806, 1272, '2021-03-25', '19:11:56.0000000', 'out', 1, 1, '2021-04-21'),
(807, 1289, '2021-03-25', '19:11:59.0000000', 'out', 1, 1, '2021-04-21'),
(808, 70000, '2021-03-25', '20:26:37.0000000', 'in', 1, 1, '2021-04-21'),
(809, 70000, '2021-03-25', '20:26:46.0000000', 'out', 1, 1, '2021-04-21'),
(810, 70000, '2021-03-26', '05:58:23.0000000', 'in', 1, 1, '2021-04-21'),
(811, 70000, '2021-03-26', '07:25:25.0000000', 'out', 1, 1, '2021-04-21'),
(812, 21, '2021-03-26', '08:33:21.0000000', 'in', 1, 1, '2021-04-21'),
(813, 26, '2021-03-26', '08:47:02.0000000', 'in', 1, 1, '2021-04-21'),
(814, 1141, '2021-03-26', '08:47:45.0000000', 'in', 1, 1, '2021-04-21'),
(815, 22, '2021-03-26', '08:52:11.0000000', 'in', 1, 1, '2021-04-21'),
(816, 24, '2021-03-26', '08:52:19.0000000', 'in', 1, 1, '2021-04-21'),
(817, 23, '2021-03-26', '08:55:34.0000000', 'in', 1, 1, '2021-04-21'),
(818, 20, '2021-03-26', '08:57:50.0000000', 'in', 1, 1, '2021-04-21'),
(819, 1272, '2021-03-26', '08:58:11.0000000', 'in', 1, 1, '2021-04-21'),
(820, 25, '2021-03-26', '09:00:01.0000000', 'in', 1, 1, '2021-04-21'),
(821, 19, '2021-03-26', '09:02:24.0000000', 'in', 1, 1, '2021-04-21'),
(822, 15, '2021-03-26', '09:03:17.0000000', 'in', 1, 1, '2021-04-21'),
(823, 1285, '2021-03-26', '09:10:44.0000000', 'in', 1, 1, '2021-04-21'),
(824, 19, '2021-03-26', '09:12:06.0000000', 'in', 1, 1, '2021-04-21'),
(825, 52, '2021-03-26', '09:14:02.0000000', 'in', 1, 1, '2021-04-21'),
(826, 1002, '2021-03-26', '09:21:22.0000000', 'out', 1, 1, '2021-04-21'),
(827, 1290, '2021-03-26', '09:21:23.0000000', 'in', 1, 1, '2021-04-21'),
(828, 1002, '2021-03-26', '09:21:27.0000000', 'in', 1, 1, '2021-04-21'),
(829, 3333, '2021-03-26', '09:22:40.0000000', 'in', 1, 1, '2021-04-21'),
(830, 1123, '2021-03-26', '09:25:00.0000000', 'in', 1, 1, '2021-04-21'),
(831, 1271, '2021-03-26', '09:45:08.0000000', 'in', 1, 1, '2021-04-21'),
(832, 17, '2021-03-26', '09:45:49.0000000', 'out', 1, 1, '2021-04-21'),
(833, 17, '2021-03-26', '09:45:53.0000000', 'in', 1, 1, '2021-04-21'),
(834, 888, '2021-03-26', '09:51:14.0000000', 'in', 1, 1, '2021-04-21'),
(835, 847, '2021-03-26', '11:15:05.0000000', 'in', 1, 1, '2021-04-21'),
(836, 847, '2021-03-26', '13:06:47.0000000', 'out', 1, 1, '2021-04-21'),
(837, 1272, '2021-03-26', '15:08:56.0000000', 'out', 1, 1, '2021-04-21'),
(838, 888, '2021-03-26', '15:30:04.0000000', 'out', 1, 1, '2021-04-21'),
(839, 1271, '2021-03-26', '16:11:18.0000000', 'out', 1, 1, '2021-04-21'),
(840, 847, '2021-03-26', '17:22:24.0000000', 'in', 1, 1, '2021-04-21'),
(841, 21, '2021-03-26', '17:32:28.0000000', 'out', 1, 1, '2021-04-21'),
(842, 1285, '2021-03-26', '17:55:46.0000000', 'out', 1, 1, '2021-04-21'),
(843, 15, '2021-03-26', '17:59:23.0000000', 'out', 1, 1, '2021-04-21'),
(844, 23, '2021-03-26', '17:59:26.0000000', 'out', 1, 1, '2021-04-21'),
(845, 26, '2021-03-26', '18:00:18.0000000', 'out', 1, 1, '2021-04-21'),
(846, 25, '2021-03-26', '18:00:23.0000000', 'out', 1, 1, '2021-04-21'),
(847, 19, '2021-03-26', '18:00:25.0000000', 'out', 1, 1, '2021-04-21'),
(848, 52, '2021-03-26', '18:00:28.0000000', 'out', 1, 1, '2021-04-21'),
(849, 20, '2021-03-26', '18:01:35.0000000', 'out', 1, 1, '2021-04-21'),
(850, 1141, '2021-03-26', '18:02:22.0000000', 'out', 1, 1, '2021-04-21'),
(851, 22, '2021-03-26', '18:03:20.0000000', 'out', 1, 1, '2021-04-21'),
(852, 24, '2021-03-26', '18:03:22.0000000', 'out', 1, 1, '2021-04-21'),
(853, 1290, '2021-03-26', '18:07:35.0000000', 'out', 1, 1, '2021-04-21'),
(854, 1002, '2021-03-26', '18:24:45.0000000', 'out', 1, 1, '2021-04-21'),
(855, 847, '2021-03-26', '18:25:09.0000000', 'out', 1, 1, '2021-04-21'),
(856, 1123, '2021-03-26', '18:39:18.0000000', 'out', 1, 1, '2021-04-21'),
(857, 3333, '2021-03-26', '18:49:38.0000000', 'out', 1, 1, '2021-04-21'),
(858, 70000, '2021-03-26', '19:02:39.0000000', 'in', 1, 1, '2021-04-21'),
(859, 70000, '2021-03-26', '19:02:48.0000000', 'out', 1, 1, '2021-04-21'),
(860, 70000, '2021-03-26', '19:02:58.0000000', 'in', 1, 1, '2021-04-21'),
(861, 1000102, '2021-03-26', '19:17:03.0000000', 'out', 1, 1, '2021-04-21'),
(862, 70000, '2021-03-26', '19:19:38.0000000', 'out', 1, 1, '2021-04-21'),
(863, 70000, '2021-03-26', '19:20:07.0000000', 'in', 1, 1, '2021-04-21'),
(864, 70000, '2021-03-26', '19:23:42.0000000', 'out', 1, 1, '2021-04-21'),
(865, 70000, '2021-03-26', '20:13:56.0000000', 'in', 1, 1, '2021-04-21'),
(866, 1000102, '2021-03-26', '20:14:15.0000000', 'in', 1, 1, '2021-04-21'),
(867, 70000, '2021-03-26', '20:18:31.0000000', 'out', 1, 1, '2021-04-21'),
(868, 70000, '2021-03-26', '20:18:36.0000000', 'in', 1, 1, '2021-04-21'),
(869, 70000, '2021-03-26', '20:24:54.0000000', 'out', 1, 1, '2021-04-21'),
(870, 70000, '2021-03-27', '08:05:45.0000000', 'in', 1, 1, '2021-04-21'),
(871, 70000, '2021-03-27', '08:12:24.0000000', 'out', 1, 1, '2021-04-21'),
(872, 1123, '2021-03-27', '09:25:58.0000000', 'in', 1, 1, '2021-04-21'),
(873, 70000, '2021-03-27', '09:26:32.0000000', 'in', 1, 1, '2021-04-21'),
(874, 1123, '2021-03-27', '09:26:40.0000000', 'out', 1, 1, '2021-04-21'),
(875, 1123, '2021-03-27', '09:26:43.0000000', 'in', 1, 1, '2021-04-21'),
(876, 70000, '2021-03-27', '09:28:51.0000000', 'out', 1, 1, '2021-04-21'),
(877, 70000, '2021-03-27', '09:29:21.0000000', 'in', 1, 1, '2021-04-21'),
(878, 70000, '2021-03-27', '09:44:49.0000000', 'out', 1, 1, '2021-04-21'),
(879, 70000, '2021-03-27', '09:45:28.0000000', 'in', 1, 1, '2021-04-21'),
(880, 19, '2021-03-27', '09:45:36.0000000', 'out', 1, 1, '2021-04-21'),
(881, 19, '2021-03-27', '09:46:04.0000000', 'in', 1, 1, '2021-04-21'),
(882, 70000, '2021-03-27', '09:46:19.0000000', 'out', 1, 1, '2021-04-21'),
(883, 70000, '2021-03-27', '10:07:31.0000000', 'in', 1, 1, '2021-04-21'),
(884, 1002, '2021-03-27', '10:13:01.0000000', 'in', 1, 1, '2021-04-21'),
(885, 1001, '2021-03-27', '10:15:04.0000000', 'in', 1, 1, '2021-04-21'),
(886, 19, '2021-03-27', '10:36:19.0000000', 'out', 1, 1, '2021-04-21'),
(887, 19, '2021-03-27', '10:38:17.0000000', 'in', 1, 1, '2021-04-21'),
(888, 19, '2021-03-27', '11:00:06.0000000', 'out', 1, 1, '2021-04-21'),
(889, 19, '2021-03-27', '11:00:12.0000000', 'in', 1, 1, '2021-04-21'),
(890, 1184, '2021-03-27', '11:00:46.0000000', 'out', 1, 1, '2021-04-21'),
(891, 1184, '2021-03-27', '11:00:50.0000000', 'in', 1, 1, '2021-04-21'),
(892, 1184, '2021-03-27', '12:04:09.0000000', 'out', 1, 1, '2021-04-21'),
(893, 70000, '2021-03-27', '14:58:16.0000000', 'out', 1, 1, '2021-04-21'),
(894, 70000, '2021-03-27', '14:58:19.0000000', 'in', 1, 1, '2021-04-21'),
(895, 19, '2021-03-27', '15:16:35.0000000', 'out', 1, 1, '2021-04-21'),
(896, 19, '2021-03-27', '15:17:18.0000000', 'in', 1, 1, '2021-04-21'),
(897, 19, '2021-03-27', '15:28:06.0000000', 'out', 1, 1, '2021-04-21'),
(898, 19, '2021-03-27', '15:30:57.0000000', 'in', 1, 1, '2021-04-21'),
(899, 70000, '2021-03-27', '15:35:17.0000000', 'out', 1, 1, '2021-04-21'),
(900, 70000, '2021-03-27', '16:39:58.0000000', 'in', 1, 1, '2021-04-21'),
(901, 70000, '2021-03-27', '16:45:22.0000000', 'out', 1, 1, '2021-04-21'),
(902, 1123, '2021-03-27', '16:51:27.0000000', 'out', 1, 1, '2021-04-21'),
(903, 19, '2021-03-27', '16:51:32.0000000', 'out', 1, 1, '2021-04-21'),
(904, 70000, '2021-03-27', '18:07:34.0000000', 'in', 1, 1, '2021-04-21'),
(905, 70000, '2021-03-27', '20:12:54.0000000', 'out', 1, 1, '2021-04-21'),
(906, 70000, '2021-03-28', '08:37:06.0000000', 'in', 1, 1, '2021-04-21'),
(907, 70000, '2021-03-28', '08:48:12.0000000', 'out', 1, 1, '2021-04-21'),
(908, 70000, '2021-03-28', '09:03:23.0000000', 'in', 1, 1, '2021-04-21'),
(909, 70000, '2021-03-28', '09:46:58.0000000', 'out', 1, 1, '2021-04-21'),
(910, 70000, '2021-03-28', '17:14:52.0000000', 'in', 1, 1, '2021-04-21'),
(911, 70000, '2021-03-28', '17:59:31.0000000', 'out', 1, 1, '2021-04-21'),
(912, 70000, '2021-03-28', '18:17:56.0000000', 'in', 1, 1, '2021-04-21'),
(913, 70000, '2021-03-28', '19:46:39.0000000', 'out', 1, 1, '2021-04-21'),
(914, 70000, '2021-03-29', '07:21:19.0000000', 'in', 1, 1, '2021-04-21'),
(915, 70000, '2021-03-29', '08:09:47.0000000', 'out', 1, 1, '2021-04-21'),
(916, 21, '2021-03-29', '08:45:06.0000000', 'in', 1, 1, '2021-04-21'),
(917, 15, '2021-03-29', '08:52:32.0000000', 'in', 1, 1, '2021-04-21'),
(918, 1289, '2021-03-29', '08:55:31.0000000', 'in', 1, 1, '2021-04-21'),
(919, 20, '2021-03-29', '08:57:07.0000000', 'in', 1, 1, '2021-04-21'),
(920, 1141, '2021-03-29', '08:57:21.0000000', 'in', 1, 1, '2021-04-21'),
(921, 26, '2021-03-29', '08:59:49.0000000', 'in', 1, 1, '2021-04-21'),
(922, 25, '2021-03-29', '08:59:54.0000000', 'in', 1, 1, '2021-04-21'),
(923, 19, '2021-03-29', '08:59:57.0000000', 'in', 1, 1, '2021-04-21'),
(924, 24, '2021-03-29', '09:06:38.0000000', 'in', 1, 1, '2021-04-21'),
(925, 52, '2021-03-29', '09:11:20.0000000', 'in', 1, 1, '2021-04-21'),
(926, 1285, '2021-03-29', '09:13:47.0000000', 'in', 1, 1, '2021-04-21'),
(927, 3333, '2021-03-29', '09:14:01.0000000', 'in', 1, 1, '2021-04-21'),
(928, 1002, '2021-03-29', '09:21:06.0000000', 'out', 1, 1, '2021-04-21'),
(929, 1002, '2021-03-29', '09:21:09.0000000', 'in', 1, 1, '2021-04-21'),
(930, 1290, '2021-03-29', '09:21:50.0000000', 'in', 1, 1, '2021-04-21'),
(931, 1123, '2021-03-29', '09:22:10.0000000', 'in', 1, 1, '2021-04-21'),
(932, 19, '2021-03-29', '09:25:40.0000000', 'in', 1, 1, '2021-04-21'),
(933, 1271, '2021-03-29', '09:37:58.0000000', 'in', 1, 1, '2021-04-21'),
(934, 755, '2021-03-29', '09:45:59.0000000', 'out', 1, 1, '2021-04-21'),
(935, 755, '2021-03-29', '09:46:03.0000000', 'in', 1, 1, '2021-04-21'),
(936, 1259, '2021-03-29', '09:46:51.0000000', 'in', 1, 1, '2021-04-21'),
(937, 888, '2021-03-29', '09:54:55.0000000', 'in', 1, 1, '2021-04-21'),
(938, 19, '2021-03-29', '10:18:27.0000000', 'out', 1, 1, '2021-04-21'),
(939, 1272, '2021-03-29', '10:30:03.0000000', 'in', 1, 1, '2021-04-21'),
(940, 1184, '2021-03-29', '10:46:46.0000000', 'in', 1, 1, '2021-04-21'),
(941, 1290, '2021-03-29', '14:34:41.0000000', 'out', 1, 1, '2021-04-21'),
(942, 888, '2021-03-29', '14:44:17.0000000', 'out', 1, 1, '2021-04-21');

-- --------------------------------------------------------

--
-- Table structure for table `employee_attendance1`
--

DROP TABLE IF EXISTS `employee_attendance1`;
CREATE TABLE IF NOT EXISTS `employee_attendance1` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeCode` int(255) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `LogTime` varchar(255) DEFAULT NULL,
  `Direction` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=359 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee_attendance1`
--

INSERT INTO `employee_attendance1` (`id`, `EmployeeCode`, `Date`, `LogTime`, `Direction`, `status`, `created_by`, `created_on`) VALUES
(1, 1285, '2021-03-22', '10:31:15.0000000', 'in', 1, 1, '2021-04-05'),
(2, 22, '2021-03-22', '14:32:15.0000000', 'in', 1, 1, '2021-04-05'),
(3, 1184, '2021-03-22', '16:24:44.0000000', 'in', 1, 1, '2021-04-05'),
(4, 15, '2021-03-22', '17:46:36.0000000', 'in', 1, 1, '2021-04-05'),
(5, 1141, '2021-03-22', '17:58:16.0000000', 'in', 1, 1, '2021-04-05'),
(6, 58, '2021-03-22', '17:59:59.0000000', 'in', 1, 1, '2021-04-05'),
(7, 23, '2021-03-22', '18:00:04.0000000', 'in', 1, 1, '2021-04-05'),
(8, 52, '2021-03-22', '18:01:02.0000000', 'in', 1, 1, '2021-04-05'),
(9, 22, '2021-03-22', '18:01:49.0000000', 'in', 1, 1, '2021-04-05'),
(10, 19, '2021-03-22', '18:01:52.0000000', 'in', 1, 1, '2021-04-05'),
(11, 25, '2021-03-22', '18:01:56.0000000', 'in', 1, 1, '2021-04-05'),
(12, 24, '2021-03-22', '18:01:58.0000000', 'in', 1, 1, '2021-04-05'),
(13, 1290, '2021-03-22', '18:02:44.0000000', 'in', 1, 1, '2021-04-05'),
(14, 26, '2021-03-22', '18:03:47.0000000', 'in', 1, 1, '2021-04-05'),
(15, 1123, '2021-03-22', '18:51:53.0000000', 'in', 1, 1, '2021-04-05'),
(16, 19, '2021-03-22', '18:51:55.0000000', 'in', 1, 1, '2021-04-05'),
(17, 1285, '2021-03-22', '18:52:56.0000000', 'in', 1, 1, '2021-04-05'),
(18, 1272, '2021-03-22', '18:54:24.0000000', 'in', 1, 1, '2021-04-05'),
(19, 1272, '2021-03-22', '18:54:34.0000000', 'in', 1, 1, '2021-04-05'),
(20, 1272, '2021-03-22', '18:54:35.0000000', 'in', 1, 1, '2021-04-05'),
(21, 1289, '2021-03-22', '18:55:11.0000000', 'in', 1, 1, '2021-04-05'),
(22, 3333, '2021-03-22', '19:05:32.0000000', 'in', 1, 1, '2021-04-05'),
(23, 70000, '2021-03-22', '19:09:25.0000000', 'in', 1, 1, '2021-04-05'),
(24, 70000, '2021-03-22', '19:11:08.0000000', 'in', 1, 1, '2021-04-05'),
(25, 70000, '2021-03-22', '19:11:24.0000000', 'in', 1, 1, '2021-04-05'),
(26, 70000, '2021-03-22', '20:39:29.0000000', 'in', 1, 1, '2021-04-05'),
(27, 70000, '2021-03-23', '01:56:37.0000000', 'in', 1, 1, '2021-04-05'),
(28, 70000, '2021-03-23', '01:59:03.0000000', 'in', 1, 1, '2021-04-05'),
(29, 70000, '2021-03-23', '05:54:58.0000000', 'in', 1, 1, '2021-04-05'),
(30, 70000, '2021-03-23', '07:37:02.0000000', 'in', 1, 1, '2021-04-05'),
(31, 25, '2021-03-23', '08:46:57.0000000', 'in', 1, 1, '2021-04-05'),
(32, 58, '2021-03-23', '08:47:33.0000000', 'in', 1, 1, '2021-04-05'),
(33, 16, '2021-03-23', '08:47:42.0000000', 'in', 1, 1, '2021-04-05'),
(34, 1289, '2021-03-23', '08:57:13.0000000', 'in', 1, 1, '2021-04-05'),
(35, 52, '2021-03-23', '08:58:12.0000000', 'in', 1, 1, '2021-04-05'),
(36, 20, '2021-03-23', '09:00:26.0000000', 'in', 1, 1, '2021-04-05'),
(37, 22, '2021-03-23', '09:06:19.0000000', 'in', 1, 1, '2021-04-05'),
(38, 1259, '2021-03-23', '09:11:04.0000000', 'in', 1, 1, '2021-04-05'),
(39, 26, '2021-03-23', '09:11:18.0000000', 'in', 1, 1, '2021-04-05'),
(40, 19, '2021-03-23', '09:11:52.0000000', 'in', 1, 1, '2021-04-05'),
(41, 24, '2021-03-23', '09:13:09.0000000', 'in', 1, 1, '2021-04-05'),
(42, 1002, '2021-03-23', '09:13:14.0000000', 'in', 1, 1, '2021-04-05'),
(43, 23, '2021-03-23', '09:15:57.0000000', 'in', 1, 1, '2021-04-05'),
(44, 3333, '2021-03-23', '09:16:23.0000000', 'in', 1, 1, '2021-04-05'),
(45, 15, '2021-03-23', '09:16:51.0000000', 'in', 1, 1, '2021-04-05'),
(46, 19, '2021-03-23', '09:17:18.0000000', 'in', 1, 1, '2021-04-05'),
(47, 1285, '2021-03-23', '09:22:28.0000000', 'in', 1, 1, '2021-04-05'),
(48, 17, '2021-03-23', '09:23:57.0000000', 'in', 1, 1, '2021-04-05'),
(49, 755, '2021-03-23', '09:26:13.0000000', 'in', 1, 1, '2021-04-05'),
(50, 1290, '2021-03-23', '09:27:37.0000000', 'in', 1, 1, '2021-04-05'),
(51, 1271, '2021-03-23', '09:32:52.0000000', 'in', 1, 1, '2021-04-05'),
(52, 1123, '2021-03-23', '09:34:43.0000000', 'in', 1, 1, '2021-04-05'),
(53, 1184, '2021-03-23', '09:40:17.0000000', 'in', 1, 1, '2021-04-05'),
(54, 888, '2021-03-23', '10:59:04.0000000', 'in', 1, 1, '2021-04-05'),
(55, 888, '2021-03-23', '12:34:05.0000000', 'in', 1, 1, '2021-04-05'),
(56, 19, '2021-03-23', '14:10:53.0000000', 'in', 1, 1, '2021-04-05'),
(57, 1272, '2021-03-23', '14:20:04.0000000', 'in', 1, 1, '2021-04-05'),
(58, 58, '2021-03-23', '17:06:00.0000000', 'in', 1, 1, '2021-04-05'),
(59, 61, '2021-03-23', '17:06:09.0000000', 'in', 1, 1, '2021-04-05'),
(60, 1281, '2021-03-23', '17:06:14.0000000', 'in', 1, 1, '2021-04-05'),
(61, 25, '2021-03-23', '17:56:52.0000000', 'in', 1, 1, '2021-04-05'),
(62, 3333, '2021-03-23', '18:00:28.0000000', 'in', 1, 1, '2021-04-05'),
(63, 61, '2021-03-23', '18:01:46.0000000', 'in', 1, 1, '2021-04-05'),
(64, 1281, '2021-03-23', '18:01:48.0000000', 'in', 1, 1, '2021-04-05'),
(65, 58, '2021-03-23', '18:01:49.0000000', 'in', 1, 1, '2021-04-05'),
(66, 58, '2021-03-23', '18:01:55.0000000', 'in', 1, 1, '2021-04-05'),
(67, 58, '2021-03-23', '18:02:02.0000000', 'in', 1, 1, '2021-04-05'),
(68, 16, '2021-03-23', '18:02:11.0000000', 'in', 1, 1, '2021-04-05'),
(69, 23, '2021-03-23', '18:02:18.0000000', 'in', 1, 1, '2021-04-05'),
(70, 58, '2021-03-23', '18:02:32.0000000', 'in', 1, 1, '2021-04-05'),
(71, 26, '2021-03-23', '18:03:41.0000000', 'in', 1, 1, '2021-04-05'),
(72, 21, '2021-03-23', '18:05:56.0000000', 'out', 1, 1, '2021-04-05'),
(73, 21, '2021-03-23', '18:06:00.0000000', 'out', 1, 1, '2021-04-05'),
(74, 52, '2021-03-23', '18:06:31.0000000', 'out', 1, 1, '2021-04-05'),
(75, 19, '2021-03-23', '18:06:34.0000000', 'out', 1, 1, '2021-04-05'),
(76, 22, '2021-03-23', '18:10:06.0000000', 'out', 1, 1, '2021-04-05'),
(77, 24, '2021-03-23', '18:10:09.0000000', 'out', 1, 1, '2021-04-05'),
(78, 20, '2021-03-23', '18:10:11.0000000', 'out', 1, 1, '2021-04-05'),
(79, 15, '2021-03-23', '18:10:50.0000000', 'out', 1, 1, '2021-04-05'),
(80, 1285, '2021-03-23', '18:16:57.0000000', 'out', 1, 1, '2021-04-05'),
(81, 19, '2021-03-23', '18:39:38.0000000', 'out', 1, 1, '2021-04-05'),
(82, 1272, '2021-03-23', '18:54:39.0000000', 'out', 1, 1, '2021-04-05'),
(83, 1289, '2021-03-23', '19:04:22.0000000', 'out', 1, 1, '2021-04-05'),
(84, 1123, '2021-03-23', '19:04:26.0000000', 'out', 1, 1, '2021-04-05'),
(85, 19, '2021-03-23', '19:54:59.0000000', 'out', 1, 1, '2021-04-05'),
(86, 70000, '2021-03-23', '20:51:56.0000000', 'out', 1, 1, '2021-04-05'),
(87, 70000, '2021-03-23', '21:14:42.0000000', 'out', 1, 1, '2021-04-05'),
(88, 1290, '2021-03-23', '22:05:02.0000000', 'out', 1, 1, '2021-04-05'),
(89, 847, '2021-03-23', '22:44:08.0000000', 'out', 1, 1, '2021-04-05'),
(90, 70000, '2021-03-23', '22:46:19.0000000', 'out', 1, 1, '2021-04-05'),
(91, 70000, '2021-03-24', '06:27:32.0000000', 'in', 1, 1, '2021-04-05'),
(92, 70000, '2021-03-24', '07:41:19.0000000', 'in', 1, 1, '2021-04-05'),
(93, 21, '2021-03-24', '08:40:33.0000000', 'in', 1, 1, '2021-04-05'),
(94, 25, '2021-03-24', '08:53:09.0000000', 'in', 1, 1, '2021-04-05'),
(95, 1289, '2021-03-24', '08:56:16.0000000', 'in', 1, 1, '2021-04-05'),
(96, 1141, '2021-03-24', '08:56:52.0000000', 'in', 1, 1, '2021-04-05'),
(97, 20, '2021-03-24', '08:58:25.0000000', 'in', 1, 1, '2021-04-05'),
(98, 22, '2021-03-24', '08:58:28.0000000', 'in', 1, 1, '2021-04-05'),
(99, 26, '2021-03-24', '08:59:02.0000000', 'in', 1, 1, '2021-04-05'),
(100, 26, '2021-03-24', '08:59:08.0000000', 'in', 1, 1, '2021-04-05'),
(101, 19, '2021-03-24', '09:00:08.0000000', 'in', 1, 1, '2021-04-05'),
(102, 19, '2021-03-24', '09:00:19.0000000', 'in', 1, 1, '2021-04-05'),
(103, 24, '2021-03-24', '09:07:59.0000000', 'in', 1, 1, '2021-04-05'),
(104, 847, '2021-03-24', '09:09:11.0000000', 'in', 1, 1, '2021-04-05'),
(105, 15, '2021-03-24', '09:09:19.0000000', 'in', 1, 1, '2021-04-05'),
(106, 3333, '2021-03-24', '09:10:09.0000000', 'in', 1, 1, '2021-04-05'),
(107, 52, '2021-03-24', '09:17:26.0000000', 'in', 1, 1, '2021-04-05'),
(108, 1002, '2021-03-24', '09:20:09.0000000', 'in', 1, 1, '2021-04-05'),
(109, 23, '2021-03-24', '09:21:56.0000000', 'in', 1, 1, '2021-04-05'),
(110, 1290, '2021-03-24', '09:27:56.0000000', 'in', 1, 1, '2021-04-05'),
(111, 1285, '2021-03-24', '09:39:09.0000000', 'in', 1, 1, '2021-04-05'),
(112, 17, '2021-03-24', '09:41:19.0000000', 'in', 1, 1, '2021-04-05'),
(113, 1271, '2021-03-24', '09:43:40.0000000', 'in', 1, 1, '2021-04-05'),
(114, 755, '2021-03-24', '09:44:34.0000000', 'in', 1, 1, '2021-04-05'),
(115, 888, '2021-03-24', '09:59:12.0000000', 'in', 1, 1, '2021-04-05'),
(116, 847, '2021-03-24', '10:11:26.0000000', 'in', 1, 1, '2021-04-05'),
(117, 1123, '2021-03-24', '10:11:31.0000000', 'in', 1, 1, '2021-04-05'),
(118, 847, '2021-03-24', '12:42:53.0000000', 'in', 1, 1, '2021-04-05'),
(119, 19, '2021-03-24', '13:29:46.0000000', 'in', 1, 1, '2021-04-05'),
(120, 19, '2021-03-24', '13:51:02.0000000', 'in', 1, 1, '2021-04-05'),
(121, 19, '2021-03-24', '14:39:43.0000000', 'in', 1, 1, '2021-04-05'),
(122, 19, '2021-03-24', '16:51:43.0000000', 'in', 1, 1, '2021-04-05'),
(123, 19, '2021-03-24', '16:51:59.0000000', 'out', 1, 1, '2021-04-05'),
(124, 19, '2021-03-24', '16:52:08.0000000', 'in', 1, 1, '2021-04-05'),
(125, 19, '2021-03-24', '16:52:13.0000000', 'in', 1, 1, '2021-04-05'),
(126, 19, '2021-03-24', '16:52:18.0000000', 'in', 1, 1, '2021-04-05'),
(127, 19, '2021-03-24', '16:52:22.0000000', 'in', 1, 1, '2021-04-05'),
(128, 19, '2021-03-24', '16:52:47.0000000', 'in', 1, 1, '2021-04-05'),
(129, 19, '2021-03-24', '16:52:55.0000000', 'out', 1, 1, '2021-04-05'),
(130, 19, '2021-03-24', '16:53:03.0000000', 'out', 1, 1, '2021-04-05'),
(131, 19, '2021-03-24', '16:53:10.0000000', 'out', 1, 1, '2021-04-05'),
(132, 19, '2021-03-24', '16:53:17.0000000', 'in', 1, 1, '2021-04-05'),
(133, 19, '2021-03-24', '16:53:25.0000000', 'in', 1, 1, '2021-04-05'),
(134, 15, '2021-03-24', '16:58:30.0000000', 'in', 1, 1, '2021-04-05'),
(135, 15, '2021-03-24', '16:58:39.0000000', 'in', 1, 1, '2021-04-05'),
(136, 15, '2021-03-24', '17:10:42.0000000', 'in', 1, 1, '2021-04-05'),
(137, 15, '2021-03-24', '17:10:46.0000000', 'in', 1, 1, '2021-04-05'),
(138, 15, '2021-03-24', '17:10:53.0000000', 'in', 1, 1, '2021-04-05'),
(139, 15, '2021-03-24', '17:11:01.0000000', 'in', 1, 1, '2021-04-05'),
(140, 15, '2021-03-24', '17:13:07.0000000', 'out', 1, 1, '2021-04-05'),
(141, 15, '2021-03-24', '17:14:24.0000000', 'in', 1, 1, '2021-04-05'),
(142, 15, '2021-03-24', '17:14:28.0000000', 'out', 1, 1, '2021-04-05'),
(143, 1002, '2021-03-24', '17:15:47.0000000', 'out', 1, 1, '2021-04-05'),
(144, 888, '2021-03-24', '17:22:45.0000000', 'out', 1, 1, '2021-04-05'),
(145, 1141, '2021-03-24', '17:57:51.0000000', 'out', 1, 1, '2021-04-05'),
(146, 21, '2021-03-24', '18:02:31.0000000', 'out', 1, 1, '2021-04-05'),
(147, 23, '2021-03-24', '18:02:41.0000000', 'out', 1, 1, '2021-04-05'),
(148, 15, '2021-03-24', '18:03:14.0000000', 'in', 1, 1, '2021-04-05'),
(149, 15, '2021-03-24', '18:03:19.0000000', 'out', 1, 1, '2021-04-05'),
(150, 26, '2021-03-24', '18:03:52.0000000', 'out', 1, 1, '2021-04-05'),
(151, 25, '2021-03-24', '18:03:55.0000000', 'out', 1, 1, '2021-04-05'),
(152, 17, '2021-03-24', '18:04:04.0000000', 'out', 1, 1, '2021-04-05'),
(153, 22, '2021-03-24', '18:06:19.0000000', 'out', 1, 1, '2021-04-05'),
(154, 52, '2021-03-24', '18:06:21.0000000', 'out', 1, 1, '2021-04-05'),
(155, 19, '2021-03-24', '18:08:16.0000000', 'out', 1, 1, '2021-04-05'),
(156, 24, '2021-03-24', '18:08:33.0000000', 'out', 1, 1, '2021-04-05'),
(157, 3333, '2021-03-24', '18:13:37.0000000', 'out', 1, 1, '2021-04-05'),
(158, 1285, '2021-03-24', '18:20:04.0000000', 'out', 1, 1, '2021-04-05'),
(159, 1289, '2021-03-24', '18:20:36.0000000', 'out', 1, 1, '2021-04-05'),
(160, 20, '2021-03-24', '18:46:52.0000000', 'out', 1, 1, '2021-04-05'),
(161, 1123, '2021-03-24', '18:47:29.0000000', 'out', 1, 1, '2021-04-05'),
(162, 19, '2021-03-24', '19:38:51.0000000', 'out', 1, 1, '2021-04-05'),
(163, 847, '2021-03-24', '20:15:41.0000000', 'out', 1, 1, '2021-04-05'),
(164, 70000, '2021-03-25', '06:17:51.0000000', 'out', 1, 1, '2021-04-05'),
(165, 70000, '2021-03-25', '06:18:07.0000000', 'in', 1, 1, '2021-04-05'),
(166, 70000, '2021-03-25', '07:38:05.0000000', 'out', 1, 1, '2021-04-05'),
(167, 24, '2021-03-25', '08:43:36.0000000', 'in', 1, 1, '2021-04-05'),
(168, 21, '2021-03-25', '08:43:45.0000000', 'in', 1, 1, '2021-04-05'),
(169, 25, '2021-03-25', '08:57:54.0000000', 'in', 1, 1, '2021-04-05'),
(170, 19, '2021-03-25', '08:58:13.0000000', 'in', 1, 1, '2021-04-05'),
(171, 22, '2021-03-25', '08:58:15.0000000', 'in', 1, 1, '2021-04-05'),
(172, 20, '2021-03-25', '08:59:54.0000000', 'in', 1, 1, '2021-04-05'),
(173, 15, '2021-03-25', '09:00:17.0000000', 'in', 1, 1, '2021-04-05'),
(174, 3333, '2021-03-25', '09:02:01.0000000', 'in', 1, 1, '2021-04-05'),
(175, 1290, '2021-03-25', '09:03:21.0000000', 'out', 1, 1, '2021-04-05'),
(176, 1290, '2021-03-25', '09:03:29.0000000', 'in', 1, 1, '2021-04-05'),
(177, 23, '2021-03-25', '09:04:07.0000000', 'in', 1, 1, '2021-04-05'),
(178, 1289, '2021-03-25', '09:04:13.0000000', 'in', 1, 1, '2021-04-05'),
(179, 70000, '2021-03-25', '09:05:13.0000000', 'in', 1, 1, '2021-04-05'),
(180, 70000, '2021-03-25', '09:05:43.0000000', 'out', 1, 1, '2021-04-05'),
(181, 1272, '2021-03-25', '09:12:38.0000000', 'in', 1, 1, '2021-04-05'),
(182, 1285, '2021-03-25', '09:13:12.0000000', 'in', 1, 1, '2021-04-05'),
(183, 1002, '2021-03-25', '09:14:48.0000000', 'in', 1, 1, '2021-04-05'),
(184, 52, '2021-03-25', '09:18:49.0000000', 'in', 1, 1, '2021-04-05'),
(185, 847, '2021-03-25', '09:20:28.0000000', 'in', 1, 1, '2021-04-05'),
(186, 1123, '2021-03-25', '09:25:13.0000000', 'in', 1, 1, '2021-04-05'),
(187, 1141, '2021-03-25', '09:33:25.0000000', 'in', 1, 1, '2021-04-05'),
(188, 888, '2021-03-25', '09:47:01.0000000', 'in', 1, 1, '2021-04-05'),
(189, 1259, '2021-03-25', '09:56:41.0000000', 'out', 1, 1, '2021-04-05'),
(190, 1259, '2021-03-25', '09:56:45.0000000', 'in', 1, 1, '2021-04-05'),
(191, 1271, '2021-03-25', '09:57:42.0000000', 'out', 1, 1, '2021-04-05'),
(192, 1271, '2021-03-25', '09:57:46.0000000', 'in', 1, 1, '2021-04-05'),
(193, 17, '2021-03-25', '10:05:05.0000000', 'in', 1, 1, '2021-04-05'),
(194, 19, '2021-03-25', '10:45:05.0000000', 'in', 1, 1, '2021-04-05'),
(195, 847, '2021-03-25', '10:52:47.0000000', 'out', 1, 1, '2021-04-05'),
(196, 847, '2021-03-25', '10:52:51.0000000', 'in', 1, 1, '2021-04-05'),
(197, 1272, '2021-03-25', '12:03:26.0000000', 'out', 1, 1, '2021-04-05'),
(198, 1290, '2021-03-25', '12:53:44.0000000', 'out', 1, 1, '2021-04-05'),
(199, 1290, '2021-03-25', '13:03:57.0000000', 'in', 1, 1, '2021-04-05'),
(200, 1272, '2021-03-25', '14:09:44.0000000', 'in', 1, 1, '2021-04-05'),
(201, 19, '2021-03-25', '14:45:01.0000000', 'out', 1, 1, '2021-04-05'),
(202, 847, '2021-03-25', '16:15:46.0000000', 'out', 1, 1, '2021-04-05'),
(203, 847, '2021-03-25', '16:26:03.0000000', 'in', 1, 1, '2021-04-05'),
(204, 1259, '2021-03-25', '17:43:24.0000000', 'out', 1, 1, '2021-04-05'),
(205, 1141, '2021-03-25', '18:01:32.0000000', 'out', 1, 1, '2021-04-05'),
(206, 21, '2021-03-25', '18:03:56.0000000', 'out', 1, 1, '2021-04-05'),
(207, 23, '2021-03-25', '18:03:58.0000000', 'out', 1, 1, '2021-04-05'),
(208, 15, '2021-03-25', '18:04:17.0000000', 'out', 1, 1, '2021-04-05'),
(209, 24, '2021-03-25', '18:04:49.0000000', 'out', 1, 1, '2021-04-05'),
(210, 22, '2021-03-25', '18:04:51.0000000', 'out', 1, 1, '2021-04-05'),
(211, 3333, '2021-03-25', '18:05:00.0000000', 'out', 1, 1, '2021-04-05'),
(212, 25, '2021-03-25', '18:05:01.0000000', 'out', 1, 1, '2021-04-05'),
(213, 19, '2021-03-25', '18:05:12.0000000', 'out', 1, 1, '2021-04-05'),
(214, 20, '2021-03-25', '18:06:03.0000000', 'out', 1, 1, '2021-04-05'),
(215, 52, '2021-03-25', '18:11:44.0000000', 'out', 1, 1, '2021-04-05'),
(216, 847, '2021-03-25', '18:17:52.0000000', 'out', 1, 1, '2021-04-05'),
(217, 1290, '2021-03-25', '18:40:59.0000000', 'out', 1, 1, '2021-04-05'),
(218, 1285, '2021-03-25', '18:41:07.0000000', 'out', 1, 1, '2021-04-05'),
(219, 1271, '2021-03-25', '18:41:23.0000000', 'out', 1, 1, '2021-04-05'),
(220, 888, '2021-03-25', '18:52:49.0000000', 'out', 1, 1, '2021-04-05'),
(221, 1123, '2021-03-25', '18:53:28.0000000', 'out', 1, 1, '2021-04-05'),
(222, 1272, '2021-03-25', '19:11:56.0000000', 'out', 1, 1, '2021-04-05'),
(223, 1289, '2021-03-25', '19:11:59.0000000', 'out', 1, 1, '2021-04-05'),
(224, 70000, '2021-03-25', '20:26:37.0000000', 'in', 1, 1, '2021-04-05'),
(225, 70000, '2021-03-25', '20:26:46.0000000', 'out', 1, 1, '2021-04-05'),
(226, 70000, '2021-03-26', '05:58:23.0000000', 'in', 1, 1, '2021-04-05'),
(227, 70000, '2021-03-26', '07:25:25.0000000', 'out', 1, 1, '2021-04-05'),
(228, 21, '2021-03-26', '08:33:21.0000000', 'in', 1, 1, '2021-04-05'),
(229, 26, '2021-03-26', '08:47:02.0000000', 'in', 1, 1, '2021-04-05'),
(230, 1141, '2021-03-26', '08:47:45.0000000', 'in', 1, 1, '2021-04-05'),
(231, 22, '2021-03-26', '08:52:11.0000000', 'in', 1, 1, '2021-04-05'),
(232, 24, '2021-03-26', '08:52:19.0000000', 'in', 1, 1, '2021-04-05'),
(233, 23, '2021-03-26', '08:55:34.0000000', 'in', 1, 1, '2021-04-05'),
(234, 20, '2021-03-26', '08:57:50.0000000', 'in', 1, 1, '2021-04-05'),
(235, 1272, '2021-03-26', '08:58:11.0000000', 'in', 1, 1, '2021-04-05'),
(236, 25, '2021-03-26', '09:00:01.0000000', 'in', 1, 1, '2021-04-05'),
(237, 19, '2021-03-26', '09:02:24.0000000', 'in', 1, 1, '2021-04-05'),
(238, 15, '2021-03-26', '09:03:17.0000000', 'in', 1, 1, '2021-04-05'),
(239, 1285, '2021-03-26', '09:10:44.0000000', 'in', 1, 1, '2021-04-05'),
(240, 19, '2021-03-26', '09:12:06.0000000', 'in', 1, 1, '2021-04-05'),
(241, 52, '2021-03-26', '09:14:02.0000000', 'in', 1, 1, '2021-04-05'),
(242, 1002, '2021-03-26', '09:21:22.0000000', 'out', 1, 1, '2021-04-05'),
(243, 1290, '2021-03-26', '09:21:23.0000000', 'in', 1, 1, '2021-04-05'),
(244, 1002, '2021-03-26', '09:21:27.0000000', 'in', 1, 1, '2021-04-05'),
(245, 3333, '2021-03-26', '09:22:40.0000000', 'in', 1, 1, '2021-04-05'),
(246, 1123, '2021-03-26', '09:25:00.0000000', 'in', 1, 1, '2021-04-05'),
(247, 1271, '2021-03-26', '09:45:08.0000000', 'in', 1, 1, '2021-04-05'),
(248, 17, '2021-03-26', '09:45:49.0000000', 'out', 1, 1, '2021-04-05'),
(249, 17, '2021-03-26', '09:45:53.0000000', 'in', 1, 1, '2021-04-05'),
(250, 888, '2021-03-26', '09:51:14.0000000', 'in', 1, 1, '2021-04-05'),
(251, 847, '2021-03-26', '11:15:05.0000000', 'in', 1, 1, '2021-04-05'),
(252, 847, '2021-03-26', '13:06:47.0000000', 'out', 1, 1, '2021-04-05'),
(253, 1272, '2021-03-26', '15:08:56.0000000', 'out', 1, 1, '2021-04-05'),
(254, 888, '2021-03-26', '15:30:04.0000000', 'out', 1, 1, '2021-04-05'),
(255, 1271, '2021-03-26', '16:11:18.0000000', 'out', 1, 1, '2021-04-05'),
(256, 847, '2021-03-26', '17:22:24.0000000', 'in', 1, 1, '2021-04-05'),
(257, 21, '2021-03-26', '17:32:28.0000000', 'out', 1, 1, '2021-04-05'),
(258, 1285, '2021-03-26', '17:55:46.0000000', 'out', 1, 1, '2021-04-05'),
(259, 15, '2021-03-26', '17:59:23.0000000', 'out', 1, 1, '2021-04-05'),
(260, 23, '2021-03-26', '17:59:26.0000000', 'out', 1, 1, '2021-04-05'),
(261, 26, '2021-03-26', '18:00:18.0000000', 'out', 1, 1, '2021-04-05'),
(262, 25, '2021-03-26', '18:00:23.0000000', 'out', 1, 1, '2021-04-05'),
(263, 19, '2021-03-26', '18:00:25.0000000', 'out', 1, 1, '2021-04-05'),
(264, 52, '2021-03-26', '18:00:28.0000000', 'out', 1, 1, '2021-04-05'),
(265, 20, '2021-03-26', '18:01:35.0000000', 'out', 1, 1, '2021-04-05'),
(266, 1141, '2021-03-26', '18:02:22.0000000', 'out', 1, 1, '2021-04-05'),
(267, 22, '2021-03-26', '18:03:20.0000000', 'out', 1, 1, '2021-04-05'),
(268, 24, '2021-03-26', '18:03:22.0000000', 'out', 1, 1, '2021-04-05'),
(269, 1290, '2021-03-26', '18:07:35.0000000', 'out', 1, 1, '2021-04-05'),
(270, 1002, '2021-03-26', '18:24:45.0000000', 'out', 1, 1, '2021-04-05'),
(271, 847, '2021-03-26', '18:25:09.0000000', 'out', 1, 1, '2021-04-05'),
(272, 1123, '2021-03-26', '18:39:18.0000000', 'out', 1, 1, '2021-04-05'),
(273, 3333, '2021-03-26', '18:49:38.0000000', 'out', 1, 1, '2021-04-05'),
(274, 70000, '2021-03-26', '19:02:39.0000000', 'in', 1, 1, '2021-04-05'),
(275, 70000, '2021-03-26', '19:02:48.0000000', 'out', 1, 1, '2021-04-05'),
(276, 70000, '2021-03-26', '19:02:58.0000000', 'in', 1, 1, '2021-04-05'),
(277, 1000102, '2021-03-26', '19:17:03.0000000', 'out', 1, 1, '2021-04-05'),
(278, 70000, '2021-03-26', '19:19:38.0000000', 'out', 1, 1, '2021-04-05'),
(279, 70000, '2021-03-26', '19:20:07.0000000', 'in', 1, 1, '2021-04-05'),
(280, 70000, '2021-03-26', '19:23:42.0000000', 'out', 1, 1, '2021-04-05'),
(281, 70000, '2021-03-26', '20:13:56.0000000', 'in', 1, 1, '2021-04-05'),
(282, 1000102, '2021-03-26', '20:14:15.0000000', 'in', 1, 1, '2021-04-05'),
(283, 70000, '2021-03-26', '20:18:31.0000000', 'out', 1, 1, '2021-04-05'),
(284, 70000, '2021-03-26', '20:18:36.0000000', 'in', 1, 1, '2021-04-05'),
(285, 70000, '2021-03-26', '20:24:54.0000000', 'out', 1, 1, '2021-04-05'),
(286, 70000, '2021-03-27', '08:05:45.0000000', 'in', 1, 1, '2021-04-05'),
(287, 70000, '2021-03-27', '08:12:24.0000000', 'out', 1, 1, '2021-04-05'),
(288, 1123, '2021-03-27', '09:25:58.0000000', 'in', 1, 1, '2021-04-05'),
(289, 70000, '2021-03-27', '09:26:32.0000000', 'in', 1, 1, '2021-04-05'),
(290, 1123, '2021-03-27', '09:26:40.0000000', 'out', 1, 1, '2021-04-05'),
(291, 1123, '2021-03-27', '09:26:43.0000000', 'in', 1, 1, '2021-04-05'),
(292, 70000, '2021-03-27', '09:28:51.0000000', 'out', 1, 1, '2021-04-05'),
(293, 70000, '2021-03-27', '09:29:21.0000000', 'in', 1, 1, '2021-04-05'),
(294, 70000, '2021-03-27', '09:44:49.0000000', 'out', 1, 1, '2021-04-05'),
(295, 70000, '2021-03-27', '09:45:28.0000000', 'in', 1, 1, '2021-04-05'),
(296, 19, '2021-03-27', '09:45:36.0000000', 'out', 1, 1, '2021-04-05'),
(297, 19, '2021-03-27', '09:46:04.0000000', 'in', 1, 1, '2021-04-05'),
(298, 70000, '2021-03-27', '09:46:19.0000000', 'out', 1, 1, '2021-04-05'),
(299, 70000, '2021-03-27', '10:07:31.0000000', 'in', 1, 1, '2021-04-05'),
(300, 1002, '2021-03-27', '10:13:01.0000000', 'in', 1, 1, '2021-04-05'),
(301, 1001, '2021-03-27', '10:15:04.0000000', 'in', 1, 1, '2021-04-05'),
(302, 19, '2021-03-27', '10:36:19.0000000', 'out', 1, 1, '2021-04-05'),
(303, 19, '2021-03-27', '10:38:17.0000000', 'in', 1, 1, '2021-04-05'),
(304, 19, '2021-03-27', '11:00:06.0000000', 'out', 1, 1, '2021-04-05'),
(305, 19, '2021-03-27', '11:00:12.0000000', 'in', 1, 1, '2021-04-05'),
(306, 1184, '2021-03-27', '11:00:46.0000000', 'out', 1, 1, '2021-04-05'),
(307, 1184, '2021-03-27', '11:00:50.0000000', 'in', 1, 1, '2021-04-05'),
(308, 1184, '2021-03-27', '12:04:09.0000000', 'out', 1, 1, '2021-04-05'),
(309, 70000, '2021-03-27', '14:58:16.0000000', 'out', 1, 1, '2021-04-05'),
(310, 70000, '2021-03-27', '14:58:19.0000000', 'in', 1, 1, '2021-04-05'),
(311, 19, '2021-03-27', '15:16:35.0000000', 'out', 1, 1, '2021-04-05'),
(312, 19, '2021-03-27', '15:17:18.0000000', 'in', 1, 1, '2021-04-05'),
(313, 19, '2021-03-27', '15:28:06.0000000', 'out', 1, 1, '2021-04-05'),
(314, 19, '2021-03-27', '15:30:57.0000000', 'in', 1, 1, '2021-04-05'),
(315, 70000, '2021-03-27', '15:35:17.0000000', 'out', 1, 1, '2021-04-05'),
(316, 70000, '2021-03-27', '16:39:58.0000000', 'in', 1, 1, '2021-04-05'),
(317, 70000, '2021-03-27', '16:45:22.0000000', 'out', 1, 1, '2021-04-05'),
(318, 1123, '2021-03-27', '16:51:27.0000000', 'out', 1, 1, '2021-04-05'),
(319, 19, '2021-03-27', '16:51:32.0000000', 'out', 1, 1, '2021-04-05'),
(320, 70000, '2021-03-27', '18:07:34.0000000', 'in', 1, 1, '2021-04-05'),
(321, 70000, '2021-03-27', '20:12:54.0000000', 'out', 1, 1, '2021-04-05'),
(322, 70000, '2021-03-28', '08:37:06.0000000', 'in', 1, 1, '2021-04-05'),
(323, 70000, '2021-03-28', '08:48:12.0000000', 'out', 1, 1, '2021-04-05'),
(324, 70000, '2021-03-28', '09:03:23.0000000', 'in', 1, 1, '2021-04-05'),
(325, 70000, '2021-03-28', '09:46:58.0000000', 'out', 1, 1, '2021-04-05'),
(326, 70000, '2021-03-28', '17:14:52.0000000', 'in', 1, 1, '2021-04-05'),
(327, 70000, '2021-03-28', '17:59:31.0000000', 'out', 1, 1, '2021-04-05'),
(328, 70000, '2021-03-28', '18:17:56.0000000', 'in', 1, 1, '2021-04-05'),
(329, 70000, '2021-03-28', '19:46:39.0000000', 'out', 1, 1, '2021-04-05'),
(330, 70000, '2021-03-29', '07:21:19.0000000', 'in', 1, 1, '2021-04-05'),
(331, 70000, '2021-03-29', '08:09:47.0000000', 'out', 1, 1, '2021-04-05'),
(332, 21, '2021-03-29', '08:45:06.0000000', 'in', 1, 1, '2021-04-05'),
(333, 15, '2021-03-29', '08:52:32.0000000', 'in', 1, 1, '2021-04-05'),
(334, 1289, '2021-03-29', '08:55:31.0000000', 'in', 1, 1, '2021-04-05'),
(335, 20, '2021-03-29', '08:57:07.0000000', 'in', 1, 1, '2021-04-05'),
(336, 1141, '2021-03-29', '08:57:21.0000000', 'in', 1, 1, '2021-04-05'),
(337, 26, '2021-03-29', '08:59:49.0000000', 'in', 1, 1, '2021-04-05'),
(338, 25, '2021-03-29', '08:59:54.0000000', 'in', 1, 1, '2021-04-05'),
(339, 19, '2021-03-29', '08:59:57.0000000', 'in', 1, 1, '2021-04-05'),
(340, 24, '2021-03-29', '09:06:38.0000000', 'in', 1, 1, '2021-04-05'),
(341, 52, '2021-03-29', '09:11:20.0000000', 'in', 1, 1, '2021-04-05'),
(342, 1285, '2021-03-29', '09:13:47.0000000', 'in', 1, 1, '2021-04-05'),
(343, 3333, '2021-03-29', '09:14:01.0000000', 'in', 1, 1, '2021-04-05'),
(344, 1002, '2021-03-29', '09:21:06.0000000', 'out', 1, 1, '2021-04-05'),
(345, 1002, '2021-03-29', '09:21:09.0000000', 'in', 1, 1, '2021-04-05'),
(346, 1290, '2021-03-29', '09:21:50.0000000', 'in', 1, 1, '2021-04-05'),
(347, 1123, '2021-03-29', '09:22:10.0000000', 'in', 1, 1, '2021-04-05'),
(348, 19, '2021-03-29', '09:25:40.0000000', 'in', 1, 1, '2021-04-05'),
(349, 1271, '2021-03-29', '09:37:58.0000000', 'in', 1, 1, '2021-04-05'),
(350, 755, '2021-03-29', '09:45:59.0000000', 'out', 1, 1, '2021-04-05'),
(351, 755, '2021-03-29', '09:46:03.0000000', 'in', 1, 1, '2021-04-05'),
(352, 1259, '2021-03-29', '09:46:51.0000000', 'in', 1, 1, '2021-04-05'),
(353, 888, '2021-03-29', '09:54:55.0000000', 'in', 1, 1, '2021-04-05'),
(354, 19, '2021-03-29', '10:18:27.0000000', 'out', 1, 1, '2021-04-05'),
(355, 1272, '2021-03-29', '10:30:03.0000000', 'in', 1, 1, '2021-04-05'),
(356, 1184, '2021-03-29', '10:46:46.0000000', 'in', 1, 1, '2021-04-05'),
(357, 1290, '2021-03-29', '14:34:41.0000000', 'out', 1, 1, '2021-04-05'),
(358, 888, '2021-03-29', '14:44:17.0000000', 'out', 1, 1, '2021-04-05');

-- --------------------------------------------------------

--
-- Table structure for table `emp_assessment_login_detail`
--

DROP TABLE IF EXISTS `emp_assessment_login_detail`;
CREATE TABLE IF NOT EXISTS `emp_assessment_login_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) DEFAULT NULL,
  `qn_name_id` varchar(11) DEFAULT NULL,
  `company_name` varchar(150) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `department` varchar(25) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(150) DEFAULT NULL,
  `father_name` varchar(100) DEFAULT NULL,
  `gender` varchar(15) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `paddress` varchar(250) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `mail` varchar(150) DEFAULT NULL,
  `adharnumber` varchar(100) DEFAULT NULL,
  `pannumber` varchar(100) DEFAULT NULL,
  `voternumber` varchar(100) DEFAULT NULL,
  `educationalDetails` varchar(150) DEFAULT NULL,
  `EmployeeStatus` varchar(100) DEFAULT NULL,
  `year_of_pass` int(10) DEFAULT NULL,
  `companyname` varchar(250) DEFAULT NULL,
  `no_of_year` varchar(10) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_assessment_login_detail`
--

INSERT INTO `emp_assessment_login_detail` (`id`, `staff_id`, `qn_name_id`, `company_name`, `position`, `department`, `first_name`, `last_name`, `father_name`, `gender`, `dob`, `address`, `paddress`, `phone`, `mail`, `adharnumber`, `pannumber`, `voternumber`, `educationalDetails`, `EmployeeStatus`, `year_of_pass`, `companyname`, `no_of_year`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, '1', '1', NULL, '3', 'jaikumar', '', '', 'male', '1970-01-01', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 3, '2021-03-28 18:30:00'),
(2, 7, '10', '1', NULL, '3', 'Laxmi', '', '', 'female', '1995-04-19', '', '', '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, 3, '2021-04-07 18:30:00'),
(3, 2, '1', '1', NULL, '3', 'Rizwana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(4, 3, '1', '1', NULL, '6', 'Rajeshwari', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(5, 4, '1', '1', NULL, '3', 'Mohanakrishnan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(6, 5, '1', '1', NULL, '3', 'Gopinath', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(7, 6, '1', '1', NULL, '2', 'Sebastain', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, NULL),
(8, 8, '1', '1', NULL, '4', 'Arunachalam', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(9, 9, '1', '1', NULL, '3', 'Vanitha', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(10, 10, '1', '1', NULL, '2', 'Jefferson', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(11, 11, '1', '1', NULL, '2', 'Meena B', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(12, 12, '1', '1', NULL, '3', 'Uma Devi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL),
(13, 13, '1', '1', NULL, '3', 'Sindhu G', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_certification`
--

DROP TABLE IF EXISTS `emp_certification`;
CREATE TABLE IF NOT EXISTS `emp_certification` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `emp_id` int(255) NOT NULL,
  `certification_name` varchar(150) NOT NULL,
  `certification_number` varchar(150) NOT NULL,
  `validity_from` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `validity_to` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `attachment` varchar(150) NOT NULL,
  `status` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(255) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_certification`
--

INSERT INTO `emp_certification` (`id`, `emp_id`, `certification_name`, `certification_number`, `validity_from`, `validity_to`, `attachment`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(11, 8, 'dotnet', '65456', '2021-04-01 18:30:00', '2021-04-14 18:30:00', 'Resume.docx', 1, 8, '2021-04-02 05:07:33', NULL, NULL),
(12, 8, 'java', '65456', '2021-04-07 18:30:00', '2021-04-15 18:30:00', 'Resume-1 dinesh changeds.docx', 1, 8, '2021-04-02 05:07:33', NULL, NULL),
(17, 8, 'Dotnet', 'ETS143', '2016-07-31 18:30:00', '2016-11-10 18:30:00', 'New Doc 2021-03-08 10.34.06_19 (1).jpg', 1, 8, '2021-04-18 12:30:33', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_exp_detail`
--

DROP TABLE IF EXISTS `emp_exp_detail`;
CREATE TABLE IF NOT EXISTS `emp_exp_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `organization_name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `total_experience` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_exp_detail`
--

INSERT INTO `emp_exp_detail` (`id`, `emp_id`, `organization_name`, `designation`, `from_date`, `to_date`, `total_experience`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 5, 'Bluebase software services', 'Software developer', '2016-06-16', '2018-12-28', '', 5, '2021-03-30 08:50:35', NULL, NULL),
(11, 8, 'Jobuli Technologies private limited', 'Trainee Software Engineer', '2021-08-21', '2019-04-30', '7 months', 8, '2021-04-18 12:43:57', NULL, NULL),
(12, 8, 'Fues Technology Solutions Private Limited', 'Software Developer', '2019-05-17', '2021-02-28', '2.2', 8, '2021-04-18 12:43:57', NULL, NULL),
(13, 2, 'Bluebase software services pvt limited', 'Senior Software Developer', '2015-09-02', '2021-04-19', '5.6', 2, '2021-04-19 03:57:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_personal_details`
--

DROP TABLE IF EXISTS `emp_personal_details`;
CREATE TABLE IF NOT EXISTS `emp_personal_details` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `emp_id` int(11) NOT NULL,
  `position` text NOT NULL,
  `name` varchar(150) NOT NULL,
  `fathers_name` varchar(150) NOT NULL,
  `DOB` varchar(222) NOT NULL,
  `communication_address` text NOT NULL,
  `permanent_address` text NOT NULL,
  `mobile_num` varchar(150) NOT NULL,
  `email_id` varchar(150) NOT NULL,
  `adharcard_number` varchar(255) DEFAULT NULL,
  `pan_number` varchar(255) DEFAULT NULL,
  `Voter_no` varchar(255) DEFAULT NULL,
  `aadhar_num` varchar(150) DEFAULT NULL,
  `pan_num` varchar(150) DEFAULT NULL,
  `voter_id` varchar(150) DEFAULT NULL,
  `resume` varchar(150) DEFAULT NULL,
  `status` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(255) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`name`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_personal_details`
--

INSERT INTO `emp_personal_details` (`id`, `emp_id`, `position`, `name`, `fathers_name`, `DOB`, `communication_address`, `permanent_address`, `mobile_num`, `email_id`, `adharcard_number`, `pan_number`, `Voter_no`, `aadhar_num`, `pan_num`, `voter_id`, `resume`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 17, 'SEO Analyst', 'Arunachalam.', 'Magudeshwaran', '1999-08-11', '7/300 Avvaiyar street, Gandhi nagar, Medavakkam Koot road, chennai, 600100.', '10/13 Giramachavadi street,  Sankagiri, Salem, 637301.', '9597680649', 'arunachalamak1120@gmail.com', '', '', '', '', '', '', '', 1, 17, '2021-03-30 04:30:01', NULL, NULL),
(2, 16, 'Website Designer', 'Jefferson.Fernando', 'Suresh Fernando', '1997-12-19', 'Dno.1 , Shiv Apartments, Vallalar Colony , Anna Nagar West, Chennai - 600040', 'D-85, Second Main Road, 7th cross street, Maharaja nagar, Tirunelveli-627011', '8838938349', 'jefferson@bluebase.in', '815270467488', 'AGPPF2641H', '', '', '', '', '', 1, 16, '2021-03-30 04:43:24', NULL, NULL),
(3, 7, 'Junior Developers', 'Umadevi.', 'Venkatesan. R', '1997-07-09', 'no :194 karumari amman kovil street kumaran nagar deffence colony ,guduvanchery, 603202.', 'no :194 karumari amman kovil street kumaran nagar deffence colony ,guduvanchery, 603202.', '7010140801', 'umadevidevi284@gmail.com', '321599240518', 'AFXPU2912B', '', '', '', '', '', 1, 7, '2021-03-30 04:43:32', NULL, NULL),
(4, 12, 'Graphic Designer', 'Meena', 'Baskar', '1996-07-11', '1st, Roja street, ponnan nagar, Irubuliyur, Peerkankaranai -600063', '15A, konar street, KKP nagar , A.S.Pettai , Namakkal', '9789041302', 'baskarmeena888@gmail.com', '860948616555', 'COXPM8166G', 'RHBO930735', '', '', '', '', 1, 12, '2021-03-30 04:43:37', NULL, NULL),
(6, 5, 'Senior Developer', 'Laxmi.Priya', 'kamaraj', '1995-07-19', 'Aruppukottai', 'Aruppukottai', '9790218732', 'laxmipriya@blubase.in', '1234567896', '89546', '132', '', '', '', '', 1, 5, '2021-04-16 10:42:54', NULL, NULL),
(5, 15, 'TRAINEE', 'VANITHA', 'PALANICHAMY C', '1995-06-11', 'J-46 NALVARAVU 1ST CROSS STREET, ARUMBAKKAM, MMDA, CHENNAI-600 106', '87/30 BHARATHIYAR FLAT, THIRUVALLUVAR PURAM 2ND STREET, CHOOLAIMEDU, CHENNAI-600 094 ', '9176643877', 'vanitha@gmail.com', '9008 4211 3858', 'AWLPV4158P', 'URT1016625', '', '', '', '', 1, 15, '2021-03-30 04:43:42', NULL, NULL),
(1, 11, 'Android Developer', 'Mohana Krishnan (Android).', 'P. Shanmugam', '1996-08-16', 'Plot No. 4, 3rd Street, AGS Nagar, Zamin Pallavaram, Chennai - 600117', 'Plot No. 4, 3rd Street, AGS Nagar, Zamin Pallavaram, Chennai - 600117', '9087178703', 'mohanakrishnan.s@bluebase.in', '433924153523', 'EILPM9259L', 'RTO2959807', 'Aadhar.pdf', 'PAN .pdf', 'Voter ID.pdf', 'SMK_Resume.pdf', 1, 11, '2021-04-19 00:43:09', NULL, NULL),
(1, 8, 'Junior Developers', 'Sindhu G', 'Gunasekaran K', '1996-07-15', '2, Varathapuram Main Rd, Nesamani Nagar, Perumbakkam, Chennai, Tamil Nadu 600100', '2/295,West st,Manakudi(po),Kallankurichi(via),Ariyalur (Dt),Pincode:621705', '8110956075', 'sindhucse97@gmail.com', 'New Doc 2021-03-08 10.34.06_14 (1).jpg', 'New Doc 2021-03-08 10.34.06_16.jpg', 'SSL0841726', '643381666365', 'FORPS6979L', 'New Doc 2021-03-08 10.34.06_17 (1).jpg', 'sindhu resume.doc', 1, 8, '2021-04-18 12:14:15', NULL, NULL),
(7, 15, 'TRAINEE', 'VANITHA', 'PALANICHAMY C', '1995-06-11', 'J-46 NALVARAVU 1ST CROSS STREET, ARUMBAKKAM, MMDA, CHENNAI-600 106', '87/30 BHARATHIYAR FLAT, THIRUVALLUVAR PURAM 2ND STREET, CHOOLAIMEDU, CHENNAI-600 094 ', '9176643877', 'vanitha@gmail.com', '9008 4211 3858', 'AWLPV4158P', 'URT1016625', '', '', '', '', 1, 15, '2021-04-16 10:43:13', NULL, NULL),
(1, 2, 'Team Lead - QC', 'Jaikumar', 'Kumar P', '1992-12-24', 'Bharathi hostel,voc street,ekkatuthangal, chennai', '7,Main road, kodikkalam, tittagudi , cuddalore 606111', '8344378374', 'jaikumarselvam24@gmail.com', '', '', '', '', '', '', '', 1, 2, '2021-04-19 03:55:08', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `emp_qualification`
--

DROP TABLE IF EXISTS `emp_qualification`;
CREATE TABLE IF NOT EXISTS `emp_qualification` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(255) NOT NULL,
  `education` text NOT NULL,
  `institution_name` text NOT NULL,
  `degree` varchar(150) NOT NULL,
  `field_of_specialization` varchar(150) NOT NULL,
  `year_of_passing` varchar(255) NOT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `attachment` varchar(150) DEFAULT NULL,
  `status` int(255) NOT NULL DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(255) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  `modified_by` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=161 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emp_qualification`
--

INSERT INTO `emp_qualification` (`id`, `emp_id`, `education`, `institution_name`, `degree`, `field_of_specialization`, `year_of_passing`, `percentage`, `attachment`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, '16', 'SSLC', 'K.S.S.A.M.S', '10th', 'State Board', '2013', '96', '', 1, '2021-03-30 04:35:57', 16, NULL, NULL),
(2, '16', 'HSC', 'K.S.S.A.M.S', '12th', 'Matriculation', '2015', '89', '', 1, '2021-03-30 04:35:57', 16, NULL, NULL),
(3, '16', 'B.E', 'PSN Institute of Science & Technology', 'B.E', 'Computer Science', '2019', '69', '', 1, '2021-03-30 04:35:57', 16, NULL, NULL),
(4, '17', 'B.Com', 'Mahendra arts science College', 'B.Com', 'Commerce', '2019', '60%', '', 1, '2021-03-30 04:36:50', 17, NULL, NULL),
(5, '17', '10th', 'Government Boys Higher Secondary School', '10th', '', '2014', '75%', '', 1, '2021-03-30 04:36:50', 17, NULL, NULL),
(6, '17', '12th', 'government Boys Higher Secondary School', '12th', 'Arts & Science', '2016', '70%', '', 1, '2021-03-30 04:36:50', 17, NULL, NULL),
(7, '12', 'B.TECH', 'ACET', 'B.TECH', 'DESIGNING', '2017', '78%', '', 1, '2021-03-30 04:43:35', 12, NULL, NULL),
(8, '12', '12th', 'KMHS', '', '', '2011', '72%', '', 1, '2021-03-30 04:43:35', 12, NULL, NULL),
(9, '12', '10th', 'KMHS', '', '', '2013', '92%', '', 1, '2021-03-30 04:43:35', 12, NULL, NULL),
(10, '15', 'ME-CSE', 'CHENNAI INSTITUTE OF TECHNOLOGY', 'ME', 'COMPUTER SCIENCE AND ENGINEERING', '2020', '80', '', 1, '2021-03-30 04:43:44', 15, NULL, NULL),
(11, '15', 'BE-ECE', 'CHENNAI INSTITUTE OF TECHNOLOGY', 'BE', 'ELECTRONICS COMMUNICATION AND ENGINEERING', '2017', '67', '', 1, '2021-03-30 04:43:44', 15, NULL, NULL),
(12, '15', 'HSC', 'JAIGOPAL GARODIA GOVT GIRLS HR SEC SCHOOL', 'HSC', 'COMPUTER SCIENCE WITH MATHS,PHYSICS,CHEMISTRY', '2013', '66', '', 1, '2021-03-30 04:43:44', 15, NULL, NULL),
(13, '15', 'SSLC', 'JAIGOPAL GARODIA GOVT GIRLS HR SEC SCHOOL', 'SSLC', 'MATHS,SCIENCE,SOCIAL', '2011', '85', '', 1, '2021-03-30 04:43:44', 15, NULL, NULL),
(14, '5', 'SSLC', 'Devangar girls higher secondary schoolr ', '10th', 'State board', '2010', '81.2', 'IMG_20201015_114612.jpg', 1, '2021-03-30 05:01:18', 5, NULL, NULL),
(15, '5', 'HSC', 'Devangar girls higher secondary schoolr ', '12th', 'State board', '2012', '77.75', 'IMG_20201015_114627.jpg', 1, '2021-03-30 05:01:18', 5, NULL, NULL),
(16, '5', 'B.E', 'Sree sowdambika college of engineering', 'E.E', 'Computer Science', '2016', '7.04', 'IMG_20201015_114543.jpg', 1, '2021-03-30 05:01:18', 5, NULL, NULL),
(100, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:03', 0, NULL, NULL),
(101, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(102, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(103, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(104, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(105, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(106, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(107, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(108, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(92, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:01:59', 0, NULL, NULL),
(93, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:01:59', 0, NULL, NULL),
(94, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:01:59', 0, NULL, NULL),
(95, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:00', 0, NULL, NULL),
(96, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:00', 0, NULL, NULL),
(97, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:00', 0, NULL, NULL),
(98, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:03', 0, NULL, NULL),
(99, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:03', 0, NULL, NULL),
(109, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(110, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(111, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(112, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:04', 0, NULL, NULL),
(113, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:17', 0, NULL, NULL),
(114, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:17', 0, NULL, NULL),
(115, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:17', 0, NULL, NULL),
(116, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:21', 0, NULL, NULL),
(117, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:21', 0, NULL, NULL),
(118, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:21', 0, NULL, NULL),
(119, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:25', 0, NULL, NULL),
(120, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:25', 0, NULL, NULL),
(121, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:25', 0, NULL, NULL),
(122, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(123, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(124, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(125, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(126, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(127, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(128, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(129, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(130, '', '', '', '', '', '', '', '', 1, '2021-04-05 09:02:26', 0, NULL, NULL),
(131, '', 'BE-ECE', 'CHENNAI INSTITUTE OF TECHNOLOGY', 'BE', 'ECE', '2017', '70', 'Tasksheet.xlsx', 1, '2021-04-05 09:03:05', 0, NULL, NULL),
(132, '8', '10th', 'Nirmala Girls Hr Sec School,Ariyalur', '10th', 'Computer science', '2011', '88.8%', 'New Doc 2021-03-08 10.34.06_1.jpg', 1, '2021-04-18 12:25:16', 8, NULL, NULL),
(133, '8', '12th', 'Raja vignesh Hr Sec School,Melamathur', 'Biomaths', 'BioMaths', '2013', '88%', 'New Doc 2021-03-08 10.34.06_2 (1).jpg', 1, '2021-04-18 12:25:16', 8, NULL, NULL),
(134, '8', 'BE', 'University College Of Engineering,Trichy,BIT Campus.', 'CSE', 'Computer Science', '2017', '66%', '', 1, '2021-04-18 12:25:16', 8, NULL, NULL),
(135, '8', '10th', 'Nirmala Girls Hr Sec School,Ariyalur', '10th', 'Computer science', '2011', '88.8%', 'New Doc 2021-03-08 10.34.06_1.jpg', 1, '2021-04-18 12:25:31', 8, NULL, NULL),
(136, '8', '12th', 'Raja vignesh Hr Sec School,Melamathur', 'Biomaths', 'BioMaths', '2013', '88%', 'New Doc 2021-03-08 10.34.06_2 (1).jpg', 1, '2021-04-18 12:25:31', 8, NULL, NULL),
(137, '8', 'BE', 'University College Of Engineering,Trichy,BIT Campus.', 'CSE', 'Computer Science', '2017', '66%', '', 1, '2021-04-18 12:25:31', 8, NULL, NULL),
(138, '8', '10th', 'Nirmala Girls Hr Sec School,Ariyalur', '10th', 'Computer science', '2011', '88.8%', 'New Doc 2021-03-08 10.34.06_1.jpg', 1, '2021-04-18 12:26:05', 8, NULL, NULL),
(139, '8', '12th', 'Raja vignesh Hr Sec School,Melamathur', 'Biomaths', 'BioMaths', '2013', '88%', 'New Doc 2021-03-08 10.34.06_2 (1).jpg', 1, '2021-04-18 12:26:05', 8, NULL, NULL),
(140, '8', 'BE', 'University College Of Engineering,Trichy,BIT Campus.', 'CSE', 'Computer Science', '2017', '66%', '', 1, '2021-04-18 12:26:05', 8, NULL, NULL),
(141, '8', '10th', 'Nirmala Girls Hr Sec School,Ariyalur', '10th', 'Computer science', '2011', '88.8%', 'New Doc 2021-03-08 10.34.06_1.jpg', 1, '2021-04-18 12:26:50', 8, NULL, NULL),
(142, '8', '12th', 'Raja vignesh Hr Sec School,Melamathur', 'Biomaths', 'BioMaths', '2013', '88%', 'New Doc 2021-03-08 10.34.06_2 (1).jpg', 1, '2021-04-18 12:26:50', 8, NULL, NULL),
(143, '8', 'BE', 'University College Of Engineering,Trichy,BIT Campus.', 'CSE', 'Computer Science', '2017', '66%', '', 1, '2021-04-18 12:26:50', 8, NULL, NULL),
(144, '8', '10th', 'Nirmala Girls Hr Sec School,Ariyalur', '10th', 'Computer science', '2011', '88.8%', 'New Doc 2021-03-08 10.34.06_1.jpg', 1, '2021-04-18 12:27:03', 8, NULL, NULL),
(145, '8', '12th', 'Raja vignesh Hr Sec School,Melamathur', 'Biomaths', 'BioMaths', '2013', '88%', 'New Doc 2021-03-08 10.34.06_2 (1).jpg', 1, '2021-04-18 12:27:03', 8, NULL, NULL),
(146, '8', 'BE', 'University College Of Engineering,Trichy,BIT Campus.', 'CSE', 'Computer Science', '2017', '66%', '', 1, '2021-04-18 12:27:03', 8, NULL, NULL),
(147, '8', '10th', 'Nirmala Girls Hr Sec School,Ariyalur', '10th', 'Computer science', '2011', '88.8%', 'New Doc 2021-03-08 10.34.06_1.jpg', 1, '2021-04-18 12:27:32', 8, NULL, NULL),
(148, '8', '12th', 'Raja vignesh Hr Sec School,Melamathur', 'Biomaths', 'BioMaths', '2013', '88%', 'New Doc 2021-03-08 10.34.06_2 (1).jpg', 1, '2021-04-18 12:27:32', 8, NULL, NULL),
(149, '8', 'BE', 'University College Of Engineering,Trichy,BIT Campus.', 'CSE', 'Computer Science', '2017', '66%', '', 1, '2021-04-18 12:27:32', 8, NULL, NULL),
(150, '11', '10TH', 'Suddhananda Vidyalaya', '', '', '2012', '10/10', '10 th.pdf', 1, '2021-04-19 01:49:52', 11, NULL, NULL),
(151, '11', '12TH', 'Sri Sankara Vidyasharam', '', '', '2014', '56%', '12 th.pdf', 1, '2021-04-19 01:49:52', 11, NULL, NULL),
(152, '11', 'BE CSE', 'Vels University', '', '', '2018', '7.8/10', 'Vels University BE CSE.pdf', 1, '2021-04-19 01:49:52', 11, NULL, NULL),
(153, '2', 'BE', 'VRS college of Engineering /Anna university ', 'UG', 'ECE', '2014', '63.5', '', 1, '2021-04-19 04:03:15', 2, NULL, NULL),
(154, '2', 'BE', 'VRS college of Engineering /Anna university ', 'UG', 'ECE', '2014', '63.5', '', 1, '2021-04-19 04:04:00', 2, NULL, NULL),
(155, '2', 'BE', 'VRS college of Engineering /Anna university ', 'UG', 'ECE', '2014', '63.5', '', 1, '2021-04-19 04:04:00', 2, NULL, NULL),
(156, '2', 'BE', 'VRS college of Engineering /Anna university ', 'UG', 'ECE', '2014', '63.5', '', 1, '2021-04-19 04:04:00', 2, NULL, NULL),
(157, '2', 'BE', 'VRS college of Engineering /Anna university ', 'UG', 'ECE', '2014', '63.5', '', 1, '2021-04-19 04:04:02', 2, NULL, NULL),
(158, '2', 'BE', 'VRS college of Engineering /Anna university ', 'UG', 'ECE', '2014', '63.5', '', 1, '2021-04-19 04:04:02', 2, NULL, NULL),
(159, '2', 'BE', 'VRS college of Engineering /Anna university ', 'UG', 'ECE', '2014', '63.5', '', 1, '2021-04-19 04:04:03', 2, NULL, NULL),
(160, '2', 'BE', 'VRS college of Engineering /Anna university ', 'UG', 'ECE', '2014', '63.5', '', 1, '2021-04-19 04:04:03', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

DROP TABLE IF EXISTS `enquiry`;
CREATE TABLE IF NOT EXISTS `enquiry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Call_type` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `Client_type` varchar(255) DEFAULT NULL,
  `Company_name` varchar(255) DEFAULT NULL,
  `Location` varchar(255) DEFAULT NULL,
  `Address` text,
  `Client` varchar(255) DEFAULT NULL,
  `Designation` varchar(255) DEFAULT NULL,
  `Mobile` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `Product` varchar(255) DEFAULT NULL,
  `list` varchar(255) DEFAULT NULL,
  `Feedback` varchar(255) DEFAULT NULL,
  `Follup` varchar(255) DEFAULT NULL,
  `companys` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `employee` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT '1',
  `flag` int(11) NOT NULL DEFAULT '0',
  `created_by` varchar(255) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Modified_by` varchar(255) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `Call_type`, `date`, `Client_type`, `Company_name`, `Location`, `Address`, `Client`, `Designation`, `Mobile`, `mail`, `Product`, `list`, `Feedback`, `Follup`, `companys`, `Department`, `employee`, `status`, `flag`, `created_by`, `created_on`, `Modified_by`, `modified_on`) VALUES
(1, '1', '2021-03-18', '2', 'accenture', 'chennai', 'tambaram', 'meena', 'devloper', '879564132', 'gnath9375@gmail.com', '1', '1', 'itsk good', '2021-03-31', 'Quadsel Systems Private Limited', '2', '12', '3', 0, '1', '2021-03-29 11:12:04', NULL, NULL),
(2, '2', '2021-03-06', '2', 'Forum', 'chennai', 'vadapalani', 'radhaa', 'development', '13256489', 'radha@gmail,com', '2', '5', 'nice', '2021-03-26', 'Quadsel Systems Private Limited', '3', '6', '2', 0, '1', '2021-03-29 11:47:42', NULL, NULL),
(3, '3', '2021-03-31', '2', 'Aircraft', 'chennai', 'meenabakkam', 'jeya kumar', 'junior maintanance', '5648792', 'jeya@gmail.com', '1', '3', 'thank you nice', '2021-03-24', 'Quadsel Systems Private Limited', '6', '1', '2', 0, '1', '2021-03-30 09:35:26', NULL, NULL),
(4, '1', '2021-03-24', '1', 'airtel', 'pune', 'mumbai', 'christy', 'marketing', '87956421', 'christy@gmail.com', '2', '4', 'not yet', '2021-03-28', 'Quadsel Systems Private Limited', '3', '6', '4', 0, '1', '2021-03-30 10:28:04', NULL, NULL),
(15, '1', '2021-04-16', '2', 'hexaware', 'chennai', 'Plot No 57 sri kamachi nagar,sirucheri ', 'rajeshwaran', 'seo', '321654987', 'gnath@gmail.com', '1', '1', 'nice', '2021-04-16', 'Quadsel Systems Private Limited', '2', '12', '1', 0, '1', '2021-04-03 06:53:41', NULL, NULL),
(7, '2', '2021-04-10', '1', 'amaintance aircraft', 'chennai', 'chennai', 'laxmi raja', 'development', '9484848', 'gnath@gmail.com', '2', '8', 'ter', '2021-04-28', 'Quadsel Systems Private Limited', '3', '7', '1', 0, '1', '2021-04-01 10:39:12', NULL, NULL),
(16, '1', '2021-04-12', '2', 'qvision', 'chennai', 'door no 57', 'sindhubath', 'accounts', '564132879', 'asd@gmail.com', '2', '10', 'edf', '2021-05-02', 'Quadsel Systems Private Limited', '3', '15', '1', 0, '1', '2021-04-03 06:57:09', NULL, NULL),
(17, '1', '2021-04-17', '1', 'hp', 'vandalur1', 'no:1234', 'praba1', 'sales1123', '78945612311', 'uma1@gmail.com', '2', '8', 'ok ', '2021-04-14', 'Quadsel Systems Private Limited', '3', '6', '3', 0, '1', '2021-04-03 07:01:38', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `esi_master`
--

DROP TABLE IF EXISTS `esi_master`;
CREATE TABLE IF NOT EXISTS `esi_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_date` date NOT NULL,
  `percentage` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `esi_master`
--

INSERT INTO `esi_master` (`id`, `from_date`, `percentage`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '1970-01-01', '1', 2, 1, '2021-03-17', 1, '2021-03-17');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_enquiry_crm`
--

DROP TABLE IF EXISTS `feedback_enquiry_crm`;
CREATE TABLE IF NOT EXISTS `feedback_enquiry_crm` (
  `Feedback_id` int(11) NOT NULL AUTO_INCREMENT,
  `enquiry_id` int(11) NOT NULL,
  `Feedback` text NOT NULL,
  `feedback_date` date NOT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(12) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(13) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`Feedback_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_enquiry_crm`
--

INSERT INTO `feedback_enquiry_crm` (`Feedback_id`, `enquiry_id`, `Feedback`, `feedback_date`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 2, 'ok', '2021-03-18', 1, 6, '2021-03-30 11:20:45', NULL, NULL),
(2, 2, 'accepted', '2021-04-01', 1, 6, '2021-03-30 11:20:45', NULL, NULL),
(3, 4, 'client call ok', '2021-03-31', 1, 6, '2021-03-30 11:22:58', NULL, NULL),
(4, 4, 'procet sucess', '2021-03-23', 1, 6, '2021-03-30 11:22:58', NULL, NULL),
(5, 2, 'xfg', '2021-04-03', 1, 6, '2021-04-01 10:48:48', NULL, NULL),
(6, 2, 'sdf', '2021-04-03', 1, 6, '2021-04-01 10:48:48', NULL, NULL),
(7, 2, 'sdf', '2021-04-10', 1, 6, '2021-04-01 10:55:37', NULL, NULL),
(8, 4, 'xcv', '2021-04-24', 1, 6, '2021-04-01 10:59:35', NULL, NULL),
(9, 4, 'xcv', '2021-04-22', 1, 6, '2021-04-01 10:59:35', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `feedback_master`
--

DROP TABLE IF EXISTS `feedback_master`;
CREATE TABLE IF NOT EXISTS `feedback_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback_master`
--

INSERT INTO `feedback_master` (`id`, `name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Not Selected', 1, 3, '2021-04-01', 42, '2021-04-02'),
(2, 'Schedule Interview', 1, 3, '2021-04-01', 42, '2021-04-02'),
(3, 'Profile On Hold', 2, 3, '2021-04-01', 42, '2021-04-02');

-- --------------------------------------------------------

--
-- Table structure for table `final_technical_person_feedback`
--

DROP TABLE IF EXISTS `final_technical_person_feedback`;
CREATE TABLE IF NOT EXISTS `final_technical_person_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `technical_person_name` varchar(150) DEFAULT NULL,
  `technical_skill` varchar(150) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `response` varchar(150) DEFAULT NULL,
  `overall_ratings` int(255) DEFAULT NULL,
  `remarks` varchar(150) DEFAULT NULL,
  `feedback` varchar(150) DEFAULT NULL,
  `status` int(255) DEFAULT NULL,
  `created_by` int(255) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `modified_by` int(255) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_technical_person_feedback`
--

INSERT INTO `final_technical_person_feedback` (`id`, `technical_person_name`, `technical_skill`, `rating`, `response`, `overall_ratings`, `remarks`, `feedback`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Raji', 'php', 5, 'ok', 10, 'ok', 'ok', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `final_technical_team_commands`
--

DROP TABLE IF EXISTS `final_technical_team_commands`;
CREATE TABLE IF NOT EXISTS `final_technical_team_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `technical_id` int(100) DEFAULT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `response` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_technical_team_commands`
--

INSERT INTO `final_technical_team_commands` (`id`, `technical_id`, `skill`, `rating`, `response`) VALUES
(1, 3, 'node.js', 3, '3'),
(2, 20, 'tyu', 3, '4'),
(3, 41, 'php12', 4, '5'),
(4, 41, 'sql12', 4, '4');

-- --------------------------------------------------------

--
-- Table structure for table `final_technical_team_details`
--

DROP TABLE IF EXISTS `final_technical_team_details`;
CREATE TABLE IF NOT EXISTS `final_technical_team_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(100) DEFAULT NULL,
  `head_name` varchar(50) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `remarks` varchar(150) DEFAULT NULL,
  `head_status` varchar(50) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `modified_by` int(5) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `final_technical_team_details`
--

INSERT INTO `final_technical_team_details` (`id`, `candidate_id`, `head_name`, `rating`, `remarks`, `head_status`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'raji', 5, 'good', '4', 13, 1, '2021-03-01 18:30:00', NULL, '2021-03-02'),
(2, 1, 'raji', 5, 'good', '4', 13, 1, '2021-03-01 18:30:00', NULL, '2021-03-02'),
(3, 3, '', 5, 'OK', '13', NULL, NULL, NULL, NULL, NULL),
(4, 20, 'Rizwana', 4, 'tyuyu', '13', NULL, NULL, NULL, NULL, NULL),
(5, 41, '', 4, 'tyuyu', '13', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `form_data`
--

DROP TABLE IF EXISTS `form_data`;
CREATE TABLE IF NOT EXISTS `form_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `file_names` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_data`
--

INSERT INTO `form_data` (`id`, `name`, `email`, `file_names`) VALUES
(1, 'dsvfd', 'dsg@gmail.com', 'bb 11 88.png'),
(2, 'sindhu', 'dsg@gmail.com', 'adhar.png,bb 11 88.png'),
(3, 'sindhuu', 'dsg@gmail.com', 'bb 11 88.png,pan.png'),
(4, 'sindhu', 'dsg@gmail.com', 'pan.png,voter.png'),
(5, 'dsvfd', 'dsg@gmail.com', 'pan.png,voter.png');

-- --------------------------------------------------------

--
-- Table structure for table `hod`
--

DROP TABLE IF EXISTS `hod`;
CREATE TABLE IF NOT EXISTS `hod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `asset` varchar(255) NOT NULL,
  `mail_id` varchar(255) NOT NULL,
  `Others` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hod`
--

INSERT INTO `hod` (`id`, `dept_name`, `emp_name`, `asset`, `mail_id`, `Others`, `created_by`, `created_on`) VALUES
(1, '', 'laxmi priya', 'lapTop', 'BB', '', 1, '2021-03-31'),
(2, '', 'sindhu', 'visiting card', 'BB', '', 1, '2021-03-31'),
(3, '', 'vanitha', 'LapTop', 'BB', '', 1, '2021-03-31'),
(4, '', '2', '4', '0', '', 2, '2021-03-31'),
(5, '', '2', '4', '0', '1', 2, '2021-03-31'),
(6, '', '4', '5', 'BB', '1', 2, '2021-03-31'),
(7, '', '6', '7', 'BB', '1', 2, '2021-03-31'),
(8, '', '13', '6', 'BB', '1', 2, '2021-04-02'),
(9, '', '11', '6', 'BB', '1', 2, '2021-04-02'),
(10, '', '13', '5', '', '1', 2, '2021-04-02'),
(11, '', '11', '3', '', '1', 2, '2021-04-02'),
(12, '', '7', '6', 'BB', '1', 2, '2021-04-02'),
(13, '1', '12', '2', 'BB', '1', 2, '2021-04-02'),
(14, '', '0', 'Array', 'BB', '1', 2, '2021-04-02'),
(15, '', '0', 'Array', '', '', 2, '2021-04-02'),
(16, '', '9', 'Array', 'BB', '1', 2, '2021-04-02'),
(17, '', '7', 'Array', 'BB', '1', 2, '2021-04-05'),
(18, '', '7', 'Array', 'BB', '1', 2, '2021-04-05'),
(19, 'Development', 'Laxmi Priya', 'Laptop', 'BB', '1', 2, '2021-04-05'),
(20, '', '9', 'Array', 'BB', '1', 2, '2021-04-05'),
(21, '', '7', '6', 'BB', '1', 2, '2021-04-05'),
(22, '', '7', '6', 'BB', '1', 2, '2021-04-05'),
(23, '', '11', '6', 'BB', '1', 2, '2021-04-05'),
(24, '', '7', '6', 'BB', '1', 2, '2021-04-05'),
(25, '', '13', '4', 'BB', '1', 2, '2021-04-05'),
(26, '', '11', '9', 'BB', '1', 2, '2021-04-05'),
(27, '', '9', '2', 'BB', '1', 2, '2021-04-05'),
(28, '', '17', '7', 'BB', '1', 2, '2021-04-05'),
(29, '', '6', '9', 'BB', '1', 2, '2021-04-05'),
(30, '', '14', '1', 'BB', '1', 2, '2021-04-05'),
(31, '1', '3', 'Array', 'BB', '1', 2, '2021-04-05'),
(32, '1', '3', 'Array', 'BB', '1', 2, '2021-04-05'),
(33, '1', '13', 'Array', 'sindhu@bluebase.in', '1', 2, '2021-04-07'),
(34, 'all', '', 'Array', '', '', 2, '2021-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `holiday_master`
--

DROP TABLE IF EXISTS `holiday_master`;
CREATE TABLE IF NOT EXISTS `holiday_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `year` varchar(50) DEFAULT NULL,
  `leave_date` date DEFAULT NULL,
  `leave_name` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holiday_master`
--

INSERT INTO `holiday_master` (`id`, `year`, `leave_date`, `leave_name`, `status`) VALUES
(6, '2021', '2021-01-01', 'NEW YEAR', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hr_feedback`
--

DROP TABLE IF EXISTS `hr_feedback`;
CREATE TABLE IF NOT EXISTS `hr_feedback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `hr_comments` varchar(150) NOT NULL,
  `status` varchar(150) NOT NULL,
  `feedback` varchar(150) NOT NULL,
  `flag_id` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(255) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hr_feedback`
--

INSERT INTO `hr_feedback` (`id`, `hr_comments`, `status`, `feedback`, `flag_id`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'xyz', 'MD', 'xyz', 1, 1, '2020-09-08 11:09:24', 1, '2020-09-08 11:11:18'),
(2, 'yyy', 'MD & HOD', 'xyz', 1, 1, '2020-09-08 11:12:28', 1, '2020-09-08 11:15:00'),
(3, 'abc', 'MD', 'aaaa', 1, 1, '2020-10-09 09:20:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Filename` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`id`, `Filename`) VALUES
(1, 'pan.jpg'),
(2, ''),
(3, 'rsume.jpg'),
(4, 'adhar.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `interview_feedback`
--

DROP TABLE IF EXISTS `interview_feedback`;
CREATE TABLE IF NOT EXISTS `interview_feedback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `position` varchar(150) NOT NULL,
  `department` varchar(150) NOT NULL,
  `type` varchar(150) NOT NULL,
  `candidate` varchar(150) NOT NULL,
  `candidate_name` varchar(150) NOT NULL,
  `replacement_candidate_name` varchar(150) NOT NULL,
  `location` varchar(150) NOT NULL,
  `reason_to_leave_job` varchar(150) NOT NULL,
  `reference_name` varchar(150) NOT NULL,
  `total_exp` int(255) NOT NULL,
  `current_ctc` int(255) NOT NULL,
  `expexted_ctc` int(255) NOT NULL,
  `notice_period` int(255) NOT NULL,
  `expected_doj` date NOT NULL,
  `feedback` varchar(150) NOT NULL,
  `status` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(255) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interview_feedback`
--

INSERT INTO `interview_feedback` (`id`, `position`, `department`, `type`, `candidate`, `candidate_name`, `replacement_candidate_name`, `location`, `reason_to_leave_job`, `reference_name`, `total_exp`, `current_ctc`, `expexted_ctc`, `notice_period`, `expected_doj`, `feedback`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Software Trainee', 'developer', 'xxx', 'aaaa', 'bbbb', 'ccccc', 'chennai', 'personal', 'yyyyy', 2, 500000, 700000, 3, '2020-05-09', 'xxxxxx', 1, 1, '2020-09-08 11:00:26', 1, '2020-09-08 11:01:37'),
(2, 'hr executive', 'hr', 'payroll', 'xyz', 'xxx', 'yyy', 'andhra pradesh', 'personal', 'zzz', 5, 1000000, 1200000, 3, '2020-09-30', 'qqq', 1, 1, '2020-09-08 11:20:12', 1, '2020-09-08 11:20:19'),
(3, 'sales manager', 'sales', 'xxx', 'male', 'krishna', 'reddy', 'chennai', 'personal', 'shah', 4, 500000, 700000, 30, '2020-04-06', 'gud', 1, 1, '2020-10-09 10:20:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `interview_rounds`
--

DROP TABLE IF EXISTS `interview_rounds`;
CREATE TABLE IF NOT EXISTS `interview_rounds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interview_rounds`
--

INSERT INTO `interview_rounds` (`id`, `name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Assessment', 1, 2, '2021-03-31', 2, '2021-03-31'),
(2, 'PHP Technical', 1, 2, '2021-03-31', 2, '2021-03-31'),
(3, 'HOD', 1, 2, '2021-03-31', 2, '2021-03-31'),
(4, 'MD', 1, 2, '2021-03-31', 2, '2021-03-31'),
(5, 'Android Technical', 1, 2, '2021-03-31', 2, '2021-03-31'),
(6, 'Java Technical', 1, 2, '2021-03-31', 2, '2021-03-31'),
(7, 'Angular Technical', 1, 2, '2021-03-31', 2, '2021-03-31'),
(8, 'HR', 1, 2, '2021-04-17', 2, '2021-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `interview_rounds_mapping`
--

DROP TABLE IF EXISTS `interview_rounds_mapping`;
CREATE TABLE IF NOT EXISTS `interview_rounds_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `round_id` int(11) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interview_rounds_mapping`
--

INSERT INTO `interview_rounds_mapping` (`id`, `round_id`, `person_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 3, '3', 1, 2, '2021-03-31', 2, '2021-03-31'),
(2, 4, '14', 1, 2, '2021-03-31', 2, '2021-03-31'),
(3, 2, '1', 1, 2, '2021-04-08', 2, '2021-04-08'),
(4, 5, '4', 1, 2, '2021-04-17', 2, '2021-04-17'),
(5, 2, '7', 1, 2, '2021-04-17', 2, '2021-04-17'),
(6, 2, '5', 1, 2, '2021-04-17', 2, '2021-04-17'),
(7, 6, '4', 1, 2, '2021-04-17', 2, '2021-04-17'),
(8, 8, '18', 1, 2, '2021-04-17', 2, '2021-04-17'),
(9, 8, '17', 1, 2, '2021-04-17', 2, '2021-04-17');

-- --------------------------------------------------------

--
-- Table structure for table `interview_schedule_detail`
--

DROP TABLE IF EXISTS `interview_schedule_detail`;
CREATE TABLE IF NOT EXISTS `interview_schedule_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `resource_id` int(11) NOT NULL,
  `feedback` int(11) NOT NULL,
  `interview_date` date DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `user_role` varchar(25) DEFAULT NULL,
  `user_name` varchar(25) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interview_schedule_detail`
--

INSERT INTO `interview_schedule_detail` (`id`, `resource_id`, `feedback`, `interview_date`, `remarks`, `status`, `user_role`, `user_name`, `password`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(2, 1, 2, '2021-04-05', 'qwewreytrhfgbv', 2, 'ROLE-010', 'resource', 'cd84d683cc5612c69efe115c80d0b7dc', 3, NULL, NULL, NULL),
(3, 2, 2, '2021-04-14', 'testing', 1, 'ROLE-011', 'test', 'cd84d683cc5612c69efe115c80d0b7dc', 3, '2021-04-13', NULL, NULL),
(4, 3, 2, '2021-04-19', 'qwewreytrhfgbv', 1, 'ROLE-010', 'New', 'cd84d683cc5612c69efe115c80d0b7dc', 3, '2021-04-15', NULL, NULL),
(5, 4, 2, '2021-04-19', 'qqqqqqqq', 1, 'ROLE-010', 'test', 'cd84d683cc5612c69efe115c80d0b7dc', 3, '2021-04-17', NULL, NULL),
(6, 5, 2, '2021-04-19', 'wwwww', 1, 'ROLE-010', 'test1', 'cd84d683cc5612c69efe115c80d0b7dc', 3, '2021-04-17', NULL, NULL),
(7, 6, 2, '2021-04-20', 'wwwww', 1, 'ROLE-010', 'candid', 'cd84d683cc5612c69efe115c80d0b7dc', 3, '2021-04-19', NULL, NULL),
(8, 7, 2, '2021-04-20', 'sds', 1, 'ROLE-010', 'canresource', 'cd84d683cc5612c69efe115c80d0b7dc', 3, '2021-04-19', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `manual_att`
--

DROP TABLE IF EXISTS `manual_att`;
CREATE TABLE IF NOT EXISTS `manual_att` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_id` varchar(150) DEFAULT NULL,
  `customer_name` varchar(50) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `purpose` varchar(150) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` varchar(50) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manual_att`
--

INSERT INTO `manual_att` (`id`, `emp_id`, `customer_name`, `location`, `date`, `purpose`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '1', 'ials', 'chennais', '2021-03-14', 'softwares', NULL, NULL, NULL, NULL),
(2, '7', 'clms', 'chennai', '2021-03-20', 'software', NULL, '2021-03-11 16:17:09', NULL, NULL),
(3, '2', 'IAL', 'Chennai', '2021-03-10', 'Software', NULL, '2021-03-15 10:15:34', NULL, NULL),
(4, '3', 'Ial', 'chennai', '2021-03-17', 'No', NULL, '2021-03-15 11:33:15', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_leave`
--

DROP TABLE IF EXISTS `master_leave`;
CREATE TABLE IF NOT EXISTS `master_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_name` varchar(100) DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_leave`
--

INSERT INTO `master_leave` (`id`, `leave_name`, `no_of_days`, `status`) VALUES
(1, 'Sick Leave', 3, 1),
(2, 'Official Leave', 1, 1),
(3, 'Unofficail Leave', 1, 1),
(4, 'Year Leaves', 10, 1),
(5, 'Temporary Leave', 1, 1),
(7, 'sick', 1, 1),
(8, 'casual', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `master_scale_master`
--

DROP TABLE IF EXISTS `master_scale_master`;
CREATE TABLE IF NOT EXISTS `master_scale_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scale_name` varchar(100) NOT NULL,
  `from_date` date DEFAULT NULL,
  `basic_pay` float(50,2) DEFAULT NULL,
  `spl_pay` float(50,2) DEFAULT NULL,
  `grade_pay` float(50,2) DEFAULT NULL,
  `da` float(50,2) DEFAULT NULL,
  `hra` float(50,2) DEFAULT NULL,
  `cca` float(50,2) DEFAULT NULL,
  `bonus` float(50,2) DEFAULT NULL,
  `addition_allowance` float(50,2) DEFAULT NULL,
  `others` float(50,2) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_scale_master`
--

INSERT INTO `master_scale_master` (`id`, `scale_name`, `from_date`, `basic_pay`, `spl_pay`, `grade_pay`, `da`, `hra`, `cca`, `bonus`, `addition_allowance`, `others`, `status`, `created_on`, `modified_on`) VALUES
(1, 'scale-1', '2020-05-08', 10000.00, 1000.00, 200.00, 165.00, 220.00, 458.00, 806.00, 987.00, 10.00, 1, '2020-05-08 00:00:00', '2021-03-16 00:00:00'),
(2, 'scale-2', '2020-05-29', 10000.00, 1000.00, 1200.00, 160.00, 220.00, 50.00, 500.00, 110.00, 55.00, 1, '2020-05-29 00:00:00', '2020-11-27 00:00:00'),
(3, 'scale-3', '2021-03-11', 1.00, 2.00, 3.00, 4.00, 5.00, 6.00, 7.00, 8.00, 9.00, 1, '2021-03-11 00:00:00', NULL),
(4, 'scale-0', '1970-01-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '2021-03-16 00:00:00', NULL),
(5, 'scale-1', '2021-03-09', 42.00, 452.00, 4523.00, 452.00, 425.00, 452.00, 452.00, 452.00, 4523.00, 1, '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
(6, 'scale-1', '2021-03-10', 544.00, 3653.00, 356.00, 365.00, 3636.00, 53536.00, 5353.00, 556.00, 556.00, 1, '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
(7, 'scale-1', '2021-03-10', 544.00, 3653.00, 356.00, 365.00, 3636.00, 53536.00, 5353.00, 556.00, 556.00, 1, '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
(8, 'scale-1', '2021-03-10', 544.00, 3653.00, 356.00, 365.00, 3636.00, 53536.00, 5353.00, 556.00, 556.00, 1, '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
(9, 'scale-1', '2021-03-17', 245.00, 4254.00, 4525.00, 54254.00, 452.00, 254.00, 254.00, 542.00, 54.00, 1, '2021-03-17 00:00:00', '2021-03-17 00:00:00'),
(10, 'scale-1', '2021-03-17', 245.00, 4254.00, 4525.00, 54254.00, 452.00, 254.00, 254.00, 542.00, 54.00, 1, '2021-03-17 00:00:00', '2021-03-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `md_commands`
--

DROP TABLE IF EXISTS `md_commands`;
CREATE TABLE IF NOT EXISTS `md_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) DEFAULT NULL,
  `md_commands` varchar(150) DEFAULT NULL,
  `md_status` int(15) DEFAULT NULL,
  `status` int(10) DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(10) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_commands`
--

INSERT INTO `md_commands` (`id`, `candidate_id`, `md_commands`, `md_status`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'xxx', 1, 16, 1, '2020-11-09', NULL, NULL),
(2, 3, 'yyy', 1, 7, 1, '2020-09-15', NULL, NULL),
(3, 20, 'good', 7, 16, 5, '2021-03-16', NULL, NULL),
(4, 22, 'ok', 7, 16, 5, '2021-03-17', NULL, NULL),
(5, 21, '', 7, 16, 5, '2021-03-17', NULL, NULL),
(6, 23, 'ee', 7, 1, 5, '2021-03-17', NULL, NULL),
(7, 24, 'ok', 7, 1, 5, '2021-03-17', NULL, NULL),
(8, 25, 'ok', 7, 1, 5, '2021-03-17', NULL, NULL),
(9, 26, 'this person will ok ', 7, 1, 5, '2021-03-17', NULL, NULL),
(10, 27, 'dsf', 7, 1, 5, '2021-03-17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `md_details`
--

DROP TABLE IF EXISTS `md_details`;
CREATE TABLE IF NOT EXISTS `md_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `rating` varchar(100) NOT NULL,
  `md_remarks` varchar(100) NOT NULL,
  `status_recruiter` varchar(100) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `md_details`
--

INSERT INTO `md_details` (`id`, `candidate_id`, `rating`, `md_remarks`, `status_recruiter`, `created`) VALUES
(5, 1, '5', '5', '7', '2020-11-27 04:11:58');

-- --------------------------------------------------------

--
-- Table structure for table `non_it_assets`
--

DROP TABLE IF EXISTS `non_it_assets`;
CREATE TABLE IF NOT EXISTS `non_it_assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_no` varchar(255) DEFAULT NULL,
  `asset_name` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `p_date` date DEFAULT NULL,
  `Serial_no` varchar(255) DEFAULT NULL,
  `config` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `org_type_master`
--

DROP TABLE IF EXISTS `org_type_master`;
CREATE TABLE IF NOT EXISTS `org_type_master` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `organization_type` varchar(255) NOT NULL,
  `status` int(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_type_master`
--

INSERT INTO `org_type_master` (`id`, `organization_type`, `status`) VALUES
(1, 'PVT', 1),
(2, 'LLP', 1),
(3, 'PL', 1),
(4, 'Proprietorship', 1),
(5, 'Partnership', 1),
(6, 'Government', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_deduction_master`
--

DROP TABLE IF EXISTS `payroll_deduction_master`;
CREATE TABLE IF NOT EXISTS `payroll_deduction_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `from_date` date DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `min_amount` int(11) NOT NULL,
  `max_amount` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_deduction_master`
--

INSERT INTO `payroll_deduction_master` (`id`, `name`, `from_date`, `amount`, `percentage`, `min_amount`, `max_amount`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Quadsel CLUB', '2021-01-01', 100, '0', 0, 0, 1, 1, '2021-04-09', 1, '2021-04-09'),
(2, 'BB - ESI', '2021-01-01', 0, '0.75', 0, 20000, 1, 1, '2021-04-09', 1, '2021-04-09');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_master`
--

DROP TABLE IF EXISTS `payroll_master`;
CREATE TABLE IF NOT EXISTS `payroll_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `month` int(50) NOT NULL,
  `year` int(50) NOT NULL,
  `date` date NOT NULL,
  `flag` int(50) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_master`
--

INSERT INTO `payroll_master` (`id`, `month`, `year`, `date`, `flag`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 3, 2021, '2021-03-05', 1, '1', '2021-04-09 04:09:34', '1', '2021-03-15 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `payroll_salary_deduction`
--

DROP TABLE IF EXISTS `payroll_salary_deduction`;
CREATE TABLE IF NOT EXISTS `payroll_salary_deduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `payroll_month` int(11) DEFAULT NULL,
  `payroll_year` int(11) DEFAULT NULL,
  `employee_code` varchar(255) DEFAULT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `deduction` varchar(155) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_salary_deduction`
--

INSERT INTO `payroll_salary_deduction` (`id`, `date`, `payroll_month`, `payroll_year`, `employee_code`, `employee_name`, `deduction`, `amount`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '2021-04-12', 3, 2021, '00015', 'Jaikumar ', 'Quadsel CLUB', 100, 1, 1, '2021-04-12', NULL, NULL),
(2, '2021-04-12', 3, 2021, '00015', 'Jaikumar ', 'Loss Of Pay', 2000, 1, 1, '2021-04-12', NULL, NULL),
(3, '2021-04-12', 3, 2021, '00016', 'Rizwana ', 'Quadsel CLUB', 100, 1, 1, '2021-04-12', NULL, NULL),
(4, '2021-04-12', 3, 2021, '00016', 'Rizwana ', 'BB - ESI', 0, 1, 1, '2021-04-12', NULL, NULL),
(5, '2021-04-13', 3, 2021, '00015', 'Jaikumar ', 'Quadsel CLUB', 100, 1, 1, '2021-04-13', NULL, NULL),
(6, '2021-04-13', 3, 2021, '00015', 'Jaikumar ', 'Loss Of Pay', 2000, 1, 1, '2021-04-13', NULL, NULL),
(7, '2021-04-13', 3, 2021, '00016', 'Rizwana ', 'Quadsel CLUB', 100, 1, 1, '2021-04-13', NULL, NULL),
(8, '2021-04-13', 3, 2021, '00016', 'Rizwana ', 'BB - ESI', 0, 1, 1, '2021-04-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_salary_earnings`
--

DROP TABLE IF EXISTS `payroll_salary_earnings`;
CREATE TABLE IF NOT EXISTS `payroll_salary_earnings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `payroll_month` int(11) DEFAULT NULL,
  `payroll_year` int(11) DEFAULT NULL,
  `employee_code` varchar(155) DEFAULT NULL,
  `employee_name` varchar(155) DEFAULT NULL,
  `earnings` varchar(155) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_salary_earnings`
--

INSERT INTO `payroll_salary_earnings` (`id`, `date`, `payroll_month`, `payroll_year`, `employee_code`, `employee_name`, `earnings`, `amount`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '2021-04-12', 3, 2021, '00015', 'Jaikumar ', 'Basics', 12000, 1, 1, '2021-04-12', NULL, NULL),
(2, '2021-04-12', 3, 2021, '00015', 'Jaikumar ', 'Dearness Allowance', 6000, 1, 1, '2021-04-12', NULL, NULL),
(3, '2021-04-12', 3, 2021, '00015', 'Jaikumar ', 'House Rent Allowance', 9000, 1, 1, '2021-04-12', NULL, NULL),
(4, '2021-04-12', 3, 2021, '00015', 'Jaikumar ', 'Other Allowance', 3000, 1, 1, '2021-04-12', NULL, NULL),
(5, '2021-04-12', 3, 2021, '00016', 'Rizwana ', 'Basics', 4000, 1, 1, '2021-04-12', NULL, NULL),
(6, '2021-04-12', 3, 2021, '00016', 'Rizwana ', 'Dearness Allowance', 2000, 1, 1, '2021-04-12', NULL, NULL),
(7, '2021-04-12', 3, 2021, '00016', 'Rizwana ', 'House Rent Allowance', 3000, 1, 1, '2021-04-12', NULL, NULL),
(8, '2021-04-12', 3, 2021, '00016', 'Rizwana ', 'Other Allowance', 1000, 1, 1, '2021-04-12', NULL, NULL),
(9, '2021-04-13', 3, 2021, '00015', 'Jaikumar ', 'Basics', 12000, 1, 1, '2021-04-13', NULL, NULL),
(10, '2021-04-13', 3, 2021, '00015', 'Jaikumar ', 'Dearness Allowance', 6000, 1, 1, '2021-04-13', NULL, NULL),
(11, '2021-04-13', 3, 2021, '00015', 'Jaikumar ', 'House Rent Allowance', 9000, 1, 1, '2021-04-13', NULL, NULL),
(12, '2021-04-13', 3, 2021, '00015', 'Jaikumar ', 'Other Allowance', 3000, 1, 1, '2021-04-13', NULL, NULL),
(13, '2021-04-13', 3, 2021, '00016', 'Rizwana ', 'Basics', 4000, 1, 1, '2021-04-13', NULL, NULL),
(14, '2021-04-13', 3, 2021, '00016', 'Rizwana ', 'Dearness Allowance', 2000, 1, 1, '2021-04-13', NULL, NULL),
(15, '2021-04-13', 3, 2021, '00016', 'Rizwana ', 'House Rent Allowance', 3000, 1, 1, '2021-04-13', NULL, NULL),
(16, '2021-04-13', 3, 2021, '00016', 'Rizwana ', 'Other Allowance', 1000, 1, 1, '2021-04-13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_scale_details`
--

DROP TABLE IF EXISTS `payroll_scale_details`;
CREATE TABLE IF NOT EXISTS `payroll_scale_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_master_id` int(11) DEFAULT NULL,
  `payroll_master_name` varchar(255) NOT NULL,
  `salary_structure_id` int(11) DEFAULT NULL,
  `salary_structure_name` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_scale_details`
--

INSERT INTO `payroll_scale_details` (`id`, `payroll_master_id`, `payroll_master_name`, `salary_structure_id`, `salary_structure_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'BB Scale', 1, 'Basics', 1, 1, '2021-04-09', NULL, NULL),
(2, 1, 'BB Scale', 2, 'Dearness Allowance', 1, 1, '2021-04-09', NULL, NULL),
(3, 1, 'BB Scale', 3, 'House Rent Allowance', 1, 1, '2021-04-09', NULL, NULL),
(4, 1, 'BB Scale', 36, 'Other Allowance', 1, 1, '2021-04-09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_scale_master`
--

DROP TABLE IF EXISTS `payroll_scale_master`;
CREATE TABLE IF NOT EXISTS `payroll_scale_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_scale_master`
--

INSERT INTO `payroll_scale_master` (`id`, `name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'BB Scale', 1, 1, '2021-04-09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payroll_structure`
--

DROP TABLE IF EXISTS `payroll_structure`;
CREATE TABLE IF NOT EXISTS `payroll_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `percentage` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_structure`
--

INSERT INTO `payroll_structure` (`id`, `name`, `amount`, `percentage`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Basics', 0, '40', 1, 1, '2021-03-11', NULL, NULL),
(2, 'Dearness Allowance', 0, '20', 1, 1, '2021-03-11', NULL, NULL),
(3, 'House Rent Allowance', 0, '30', 1, 1, '2021-03-11', NULL, NULL),
(4, 'Conveyance Allowance', 0, '', 1, 1, '2021-03-11', NULL, NULL),
(5, 'Leave Travel Allowance', 0, '', 1, 1, '2021-03-11', NULL, NULL),
(6, 'Medical Allowance', 0, '', 1, 1, '2021-03-11', NULL, NULL),
(7, 'Books and Periodicals Allowance', 0, '', 1, 1, '2021-03-11', NULL, NULL),
(36, 'Other Allowance', 0, '10', 1, 1, '2021-04-09', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product/services`
--

DROP TABLE IF EXISTS `product/services`;
CREATE TABLE IF NOT EXISTS `product/services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mapping_id` varchar(234) NOT NULL,
  `name` varchar(234) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product/services`
--

INSERT INTO `product/services` (`id`, `mapping_id`, `name`) VALUES
(1, '1', 'Desktop'),
(2, '1', 'Laptop'),
(3, '1', 'Printer'),
(4, '1', 'Ups'),
(5, '1', 'Software'),
(6, '1', 'Others'),
(7, '2', 'IMS'),
(8, '2', 'AMC'),
(9, '2', 'MPS'),
(10, '2', 'Migration'),
(11, '2', 'Others');

-- --------------------------------------------------------

--
-- Table structure for table `products_master`
--

DROP TABLE IF EXISTS `products_master`;
CREATE TABLE IF NOT EXISTS `products_master` (
  `Product_id` int(11) NOT NULL AUTO_INCREMENT,
  `Product_name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `cratedby` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`Product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_master`
--

INSERT INTO `products_master` (`Product_id`, `Product_name`, `status`, `cratedby`) VALUES
(1, 'Desktop', 1, '2021-04-01 04:05:02'),
(2, 'Laptops', 1, '2021-04-01 04:05:02'),
(3, 'Printer', 1, '2021-04-01 04:05:23'),
(4, 'Ups', 1, '2021-04-01 04:05:23'),
(5, 'Software', 1, '2021-04-01 04:05:36'),
(6, 'Others', 1, '2021-04-01 04:05:36');

-- --------------------------------------------------------

--
-- Table structure for table `ptdeduction`
--

DROP TABLE IF EXISTS `ptdeduction`;
CREATE TABLE IF NOT EXISTS `ptdeduction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `Nov` varchar(255) DEFAULT NULL,
  `Oct` varchar(255) DEFAULT NULL,
  `Sep` varchar(255) DEFAULT NULL,
  `Aug` varchar(255) DEFAULT NULL,
  `Decc` varchar(255) DEFAULT NULL,
  `Jan` varchar(255) DEFAULT NULL,
  `Total_Gross` varchar(255) DEFAULT NULL,
  `PT_Slab` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ptdeduction`
--

INSERT INTO `ptdeduction` (`id`, `code`, `name`, `Nov`, `Oct`, `Sep`, `Aug`, `Decc`, `Jan`, `Total_Gross`, `PT_Slab`) VALUES
(1, '101', 'abcd', '500', '1580', '2500', '2500', '2500', '2560', '50000', '452000');

-- --------------------------------------------------------

--
-- Table structure for table `question_master`
--

DROP TABLE IF EXISTS `question_master`;
CREATE TABLE IF NOT EXISTS `question_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `qn_name` int(11) DEFAULT NULL,
  `section` int(11) DEFAULT NULL,
  `Questions` text NOT NULL,
  `Option_A` varchar(100) NOT NULL,
  `Option_B` varchar(100) NOT NULL,
  `Option_C` varchar(100) NOT NULL,
  `Option_D` varchar(100) NOT NULL,
  `answer_key` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_master`
--

INSERT INTO `question_master` (`id`, `qn_name`, `section`, `Questions`, `Option_A`, `Option_B`, `Option_C`, `Option_D`, `answer_key`, `status`, `created`) VALUES
(1, 1, 1, 'add a+b a=5 b=10', '10', '15', '25', '35', '2', 1, '2021-03-25 07:47:32'),
(3, 4, 2, 'a=5 b=10 b-a=?', '10', '5', '25', '35', '2', 1, '2021-04-12 07:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `question_name_master`
--

DROP TABLE IF EXISTS `question_name_master`;
CREATE TABLE IF NOT EXISTS `question_name_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question_name_master`
--

INSERT INTO `question_name_master` (`id`, `name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Question-A', 1, 2, '2021-03-23', NULL, NULL),
(2, 'Question-B', 1, 2, '2021-03-23', NULL, NULL),
(3, 'quess', 1, 2, '2021-03-26', NULL, NULL),
(4, 'Question_Development_1', 1, 2, '2021-03-29', NULL, NULL),
(5, 'Question_Development_2', 1, 2, '2021-03-29', NULL, NULL),
(6, 'Question_Development_3', 1, 2, '2021-03-29', NULL, NULL),
(7, 'Question_Development_4', 1, 2, '2021-03-29', NULL, NULL),
(8, 'Question_Development_5', 1, 2, '2021-03-29', NULL, NULL),
(9, 'Question_Development_6', 1, 2, '2021-03-29', NULL, NULL),
(10, 'Question_Development_7', 1, 2, '2021-03-29', NULL, NULL),
(11, 'Question_Designing_3', 1, 2, '2021-03-29', NULL, NULL),
(12, 'Question_Designing_2', 1, 2, '2021-03-29', NULL, NULL),
(13, 'Question_Designing_1', 1, 2, '2021-03-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

DROP TABLE IF EXISTS `quotation`;
CREATE TABLE IF NOT EXISTS `quotation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Enquire_id` int(11) DEFAULT NULL,
  `proposal` varchar(255) DEFAULT NULL,
  `Client` varchar(255) DEFAULT NULL,
  `Date` date DEFAULT NULL,
  `Version` varchar(255) DEFAULT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `email_id` varchar(255) DEFAULT NULL,
  `tel_no` varchar(255) DEFAULT NULL,
  `scope` text,
  `Proposal_statement` text,
  `Conditions` text,
  `status` int(12) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modify_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_entry`
--

DROP TABLE IF EXISTS `quotation_entry`;
CREATE TABLE IF NOT EXISTS `quotation_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Quotation_id` int(123) DEFAULT NULL,
  `phases` varchar(255) DEFAULT NULL,
  `specification` varchar(255) DEFAULT NULL,
  `qty` int(15) DEFAULT NULL,
  `unit_rate` int(15) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `gst_percentage` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recruiter_commands`
--

DROP TABLE IF EXISTS `recruiter_commands`;
CREATE TABLE IF NOT EXISTS `recruiter_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(10) DEFAULT NULL,
  `skill_question` varchar(100) DEFAULT NULL,
  `rating` varchar(10) DEFAULT NULL,
  `response` varchar(150) DEFAULT NULL,
  `tech_dept_ass` varchar(255) NOT NULL,
  `tech_dept_per` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruiter_commands`
--

INSERT INTO `recruiter_commands` (`id`, `candidate_id`, `skill_question`, `rating`, `response`, `tech_dept_ass`, `tech_dept_per`, `created_by`, `created_on`) VALUES
(1, 1, 'php', '4', 'good', '', '', 0, '0000-00-00 00:00:00'),
(2, 1, 'java', '1', 'bad', '', '', 0, '0000-00-00 00:00:00'),
(3, 2, 'htmls', '1', 'oks', '', '', 0, '0000-00-00 00:00:00'),
(4, 2, 'ajaxs', '4', 'goods', '', '', 0, '0000-00-00 00:00:00'),
(5, 3, 'php', '3', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(6, 3, 'java', '5', 'good', '', '', 0, '0000-00-00 00:00:00'),
(7, 4, 'php', '3', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(8, 4, 'what is php', '4', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(9, 4, 'what is sql', '5', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(10, 6, 'php', '4', 'what', '', '', 0, '0000-00-00 00:00:00'),
(11, 6, 'what is php', '4', 'query', '', '', 0, '0000-00-00 00:00:00'),
(12, 6, '', '', '', '', '', 0, '0000-00-00 00:00:00'),
(13, 5, 'php', '5', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(14, 5, 'what is php?', '5', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(15, 10, 'php', '3', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(16, 11, 'php', '4', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(17, 12, 'php', '3', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(21, 19, 'php', '1', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(20, 20, 'sss', '3', 'good', '', '', 0, '0000-00-00 00:00:00'),
(22, 19, 'java', '3', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(23, 21, 'php', '4', 's', '', '', 0, '0000-00-00 00:00:00'),
(24, 21, 'java', '2', 's', '', '', 0, '0000-00-00 00:00:00'),
(25, 22, 'php', '5', '5', '', '', 0, '0000-00-00 00:00:00'),
(26, 22, 'java', '3', '2', '', '', 0, '0000-00-00 00:00:00'),
(27, 22, 'seo', '3', '8', '', '', 0, '0000-00-00 00:00:00'),
(28, 23, 'php', '3', '2', '', '', 0, '0000-00-00 00:00:00'),
(29, 24, 'php', '4', '3', '', '', 0, '0000-00-00 00:00:00'),
(30, 25, 'php', '4', '2', '', '', 0, '0000-00-00 00:00:00'),
(31, 25, 'java', '2', '2', '', '', 0, '0000-00-00 00:00:00'),
(32, 25, 'php', '2', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(33, 26, 'wnat is php', '3', 'ok', '', '', 0, '0000-00-00 00:00:00'),
(34, 26, 'what is sql', '4', 'its satisfity', '', '', 0, '0000-00-00 00:00:00'),
(35, 27, 'dfg', '1', 'dfg', '', '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `recruiter_details`
--

DROP TABLE IF EXISTS `recruiter_details`;
CREATE TABLE IF NOT EXISTS `recruiter_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(100) DEFAULT NULL,
  `position` varchar(50) DEFAULT NULL,
  `tech_department` varchar(50) DEFAULT NULL,
  `replacement` varchar(25) DEFAULT NULL,
  `replaced_name` varchar(50) DEFAULT NULL,
  `site` varchar(50) DEFAULT NULL,
  `reason_leave` varchar(100) DEFAULT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `tot_year_exp` int(10) DEFAULT NULL,
  `current_ctc` float(50,2) DEFAULT NULL,
  `exp_ctc` float(50,2) DEFAULT NULL,
  `notice_period` int(10) DEFAULT NULL,
  `date_of_join` date DEFAULT NULL,
  `recruiter_name` varchar(50) DEFAULT NULL,
  `ratings` int(10) DEFAULT NULL,
  `remarks` varchar(150) DEFAULT NULL,
  `status_recruiter` varchar(50) DEFAULT NULL,
  `command_technical_person` varchar(150) DEFAULT NULL,
  `interview_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(5) DEFAULT '1',
  `created_by` int(5) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruiter_details`
--

INSERT INTO `recruiter_details` (`id`, `candidate_id`, `position`, `tech_department`, `replacement`, `replaced_name`, `site`, `reason_leave`, `reference`, `tot_year_exp`, `current_ctc`, `exp_ctc`, `notice_period`, `date_of_join`, `recruiter_name`, `ratings`, `remarks`, `status_recruiter`, `command_technical_person`, `interview_date`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'Web', 'Software', 'new', NULL, 'Chennai', 'Closed the company', 'mani', 5, 56789.00, 6576788.00, 7, '2020-11-27', 'Vasanth', 5, 'good in php', '16', '5', '2020-11-23 07:22:17', 1, NULL, '2020-11-23 07:22:17', NULL, NULL),
(2, 2, 'web', 'Software', 'replace', 'Arun kmar', 'Chennai', 'pacakge', 'aishu', 6, 560000.00, 456789.00, 3, '2020-11-30', 'Gopi', 5, 'yes', '7', '5', '2020-11-23 07:32:29', 1, NULL, '2020-11-23 07:32:29', NULL, NULL),
(3, 3, 'php developer', 'Software', 'new', NULL, 'Aswini', 'fresher', 'online', 4, 4000000.00, 7000000.00, 7, '2020-11-26', 'vasanth', 6, 'good in html', '10', '5', '2020-11-23 07:42:25', 1, NULL, '2020-11-23 07:42:25', NULL, NULL),
(4, 4, 'php', 'Software', 'new', NULL, 'Chennai', 'salary', 'vanitha', 1, 100000.00, 200000.00, 0, '2021-02-09', 'sakthi', 5, 'selected', '13', '5', '2021-02-20 11:05:43', 1, NULL, '2021-02-20 11:05:43', NULL, NULL),
(5, 6, 'php', 'Software', 'replace', 'sakthi', 'chennai', 'pressure', 'girish', 2, 1000000.00, 1000000.00, 6, '2021-02-23', 'mythilli', 4, 'ok', '1', '5', '2021-02-22 05:57:25', 1, NULL, '2021-02-22 05:57:25', NULL, NULL),
(7, 20, 'Developer', 'Software', 'new', NULL, 'chennai', 'nothing', 'qq', 3, 12233.00, 15555.00, 30, '2021-03-19', 'raji', 5, 'sds', '16', '5', '2021-03-16 07:08:35', 1, NULL, '2021-03-16 07:08:35', NULL, NULL),
(8, 19, 'hr', 'Hr', 'new', NULL, 'chennai', 'slary', 'sebastian', 0, 10000.00, 20000.00, 2, '2021-03-18', 'jai', 5, 'nice', '4', '5', '2021-03-16 07:12:50', 1, NULL, '2021-03-16 07:12:50', NULL, NULL),
(9, 21, 'php', 'Service', 'new', NULL, 'chennai', 'package', 'laxmi', 2, 20000.00, 20000.00, 2, '2021-03-17', 'jai', 5, 'no', '16', '1', '2021-03-16 09:05:34', 1, NULL, '2021-03-16 09:05:34', NULL, NULL),
(10, 22, 'Digital marketing', 'Software', 'new', NULL, 'chennai', 'package', 'raji', 8, 20000.00, 20000.00, 2, '2021-03-17', 'sakthi', 8, 'good', '16', '5', '2021-03-17 04:02:05', 1, NULL, '2021-03-17 04:02:05', NULL, NULL),
(11, 23, 'php', 'Admin', 'new', NULL, 'chennai', 'salary', 'gopi', 2, 23.00, 22.00, 2, '2021-03-18', 'vasanth', 3, 'yes', '7', '1', '2021-03-17 04:25:19', 1, NULL, '2021-03-17 04:25:19', NULL, NULL),
(12, 24, 'SEO', 'Admin', 'new', NULL, 'chennai', 'salary', 'raji', 5, 879564.00, 132564.00, 5, '2021-03-18', 'raji', 3, 'ok', '7', '1', '2021-03-17 04:36:16', 1, NULL, '2021-03-17 04:36:16', NULL, NULL),
(13, 25, 'php', 'Network', 'new', NULL, 'chennai', 'package', 'gopi', 5, 50000.00, 2000.00, 4, '2021-03-19', 'mythilli', 5, 'ok', '7', '5', '2021-03-17 05:31:29', 1, NULL, '2021-03-17 05:31:29', NULL, NULL),
(14, 26, 'java', 'Software', 'new', NULL, 'chennai', 'package', 'gopi', 2, 100000.00, 200000.00, 15, '2021-04-01', 'raji', 8, 'ok performance', '7', '5', '2021-03-17 06:37:05', 1, NULL, '2021-03-17 06:37:05', NULL, NULL),
(15, 27, 'php', 'Service', 'new', NULL, 'csf', 'dfgfdg', 'dfgdfg', 4, 444.00, 444.00, 4, '2021-03-17', 'dfg', 4, 'fdg', '7', '5', '2021-03-17 09:20:23', 1, NULL, '2021-03-17 09:20:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recruiter_feedback`
--

DROP TABLE IF EXISTS `recruiter_feedback`;
CREATE TABLE IF NOT EXISTS `recruiter_feedback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `recruiter_name` varchar(150) NOT NULL,
  `interpersonal_skill` varchar(150) NOT NULL,
  `rating` int(255) NOT NULL,
  `response` varchar(150) NOT NULL,
  `overall_ratings` int(255) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `feedback` varchar(150) NOT NULL,
  `status` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(255) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruiter_feedback`
--

INSERT INTO `recruiter_feedback` (`id`, `recruiter_name`, `interpersonal_skill`, `rating`, `response`, `overall_ratings`, `remarks`, `feedback`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'rajesh', 'good', 5, 'good', 4, 'to be improve', 'qqqqq', 1, 1, '2020-09-08 11:04:11', 1, '2020-09-08 11:04:22'),
(2, 'abc', 'good atitude', 5, 'good', 5, 'nill', 'rrrr', 1, 1, '2020-09-08 11:27:19', 1, '2020-09-08 11:26:39'),
(3, 'andrews', 'good intracting', 4, 'gud', 5, 'nill', 'good', 1, 1, '2020-10-09 10:20:20', NULL, NULL),
(4, 'ram', 'good intracting', 4, 'gud', 4, 'nill', 'good', 1, 1, '2020-10-09 10:20:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `resource_form_detail`
--

DROP TABLE IF EXISTS `resource_form_detail`;
CREATE TABLE IF NOT EXISTS `resource_form_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source` int(11) NOT NULL,
  `consultant_name` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `position` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `whatsapp` varchar(25) DEFAULT NULL,
  `mail` varchar(25) DEFAULT NULL,
  `aadhar_no` varchar(25) NOT NULL,
  `degree` varchar(25) NOT NULL,
  `university` varchar(255) NOT NULL,
  `year_of_pass` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `employement_status` varchar(255) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `year_experience` varchar(11) DEFAULT NULL,
  `certification_status` varchar(25) NOT NULL,
  `certification` varchar(255) DEFAULT NULL,
  `validity` date DEFAULT NULL,
  `certified_from` date DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` text,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `resource_form_detail`
--

INSERT INTO `resource_form_detail` (`id`, `source`, `consultant_name`, `date`, `position`, `first_name`, `last_name`, `gender`, `mobile`, `whatsapp`, `mail`, `aadhar_no`, `degree`, `university`, `year_of_pass`, `percentage`, `employement_status`, `company_name`, `year_experience`, `certification_status`, `certification`, `validity`, `certified_from`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 2, 'xyz', '2021-04-02', 8, 'resource', '', 'male', '+91 9790218732', '+91 12345678', 'xxxx@gmail.com', '5485 5000 8000', 'B.E', 'test', 2020, 12, 'Fresher', '', '', 'yes', 'php', '2021-04-02', '2021-04-02', 2, 3, '2021-04-02 14:53:08', NULL, NULL),
(2, 2, 'xyz', '2021-04-13', 6, 'test', 'resource', 'male', '+91 9790218732', '+91 12345678', 'xxxx@gmail.com', '5485 5000 8000', 'B.E', 'test', 2020, 70, 'Fresher', '', '', 'no', NULL, NULL, NULL, 2, 3, '2021-04-13 13:23:12', NULL, NULL),
(3, 3, '', '2021-04-15', 6, 'New', 'Resource', 'male', '+91 9790218732', '+91 12345678', 'xxxx@gmail.com', '5485 5000 8000', 'B.E', 'test', 2020, 70, 'Fresher', '', '', 'yes', 'php', '2021-04-04', '2021-04-16', 2, 3, '2021-04-15 12:34:54', NULL, NULL),
(4, 5, '', '2021-04-01', 7, 'test', 'UI', 'male', '+91 9790218732', '+91 12345678', 'xxxx@gmail.com', '5485 5000 8000', 'B.E', 'test', 2020, 70, 'Experience', 'xxx', '2', 'no', NULL, NULL, NULL, 2, 3, '2021-04-17 09:11:15', NULL, NULL),
(5, 1, '', '2021-04-17', 5, 'test1', 'SD', 'male', '+91 9790218732', '+91 12345678', 'xxxx@gmail.com', '5485 5000 8000', 'B.E', 'test1', 2020, 70, 'Experience', 'xxx', '2', 'no', NULL, NULL, NULL, 2, 3, '2021-04-17 09:13:55', NULL, NULL),
(6, 1, '', '2021-04-19', 6, 'candid', 'resource', 'male', '+91 9790218732', '+91 12345678', 'xxxx@gmail.com', '5485 5000 8000', 'B.E', 'test', 2020, 70, 'Fresher', '', '', 'no', NULL, NULL, NULL, 2, 3, '2021-04-19 12:14:50', NULL, NULL),
(7, 1, '', '2021-04-19', 6, 'canresource', 'technical', 'male', '+91 9790218732', '+91 12345678', 'xxxx@gmail.com', '5485 5000 8000', 'B.E', 'test', 2020, 70, 'Fresher', '', '', 'no', NULL, NULL, NULL, 2, 3, '2021-04-19 15:02:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role_g`
--

DROP TABLE IF EXISTS `role_g`;
CREATE TABLE IF NOT EXISTS `role_g` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(355) DEFAULT NULL,
  `menu_id` int(200) DEFAULT NULL,
  `submenu_id` int(200) DEFAULT NULL,
  `view_only` varchar(200) DEFAULT NULL,
  `edit_only` varchar(200) DEFAULT NULL,
  `all_only` varchar(200) DEFAULT NULL,
  `approval` varchar(200) DEFAULT '0',
  `created_by` int(11) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `section_master`
--

DROP TABLE IF EXISTS `section_master`;
CREATE TABLE IF NOT EXISTS `section_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section_master`
--

INSERT INTO `section_master` (`id`, `name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Aptitude', 0, 2, '2021-03-23', NULL, NULL),
(2, 'Logical Reasoning', 1, 2, '2021-03-23', NULL, NULL),
(3, 'Reasoning', 1, 2, '2021-03-26', NULL, NULL),
(4, 'Communication', 1, 2, '2021-03-29', NULL, NULL),
(5, 'Technical', 1, 2, '2021-03-29', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_master`
--

DROP TABLE IF EXISTS `service_master`;
CREATE TABLE IF NOT EXISTS `service_master` (
  `service_id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_by` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_master`
--

INSERT INTO `service_master` (`service_id`, `service_name`, `status`, `created_by`) VALUES
(1, 'IMS', 1, '2021-04-01 04:38:16'),
(2, 'AMC', 1, '2021-04-01 04:38:16'),
(3, 'MPS', 1, '2021-04-01 04:38:33'),
(4, 'Migration', 1, '2021-04-01 04:38:33'),
(5, 'Others', 1, '2021-04-01 04:38:41');

-- --------------------------------------------------------

--
-- Table structure for table `source_master`
--

DROP TABLE IF EXISTS `source_master`;
CREATE TABLE IF NOT EXISTS `source_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `source_master`
--

INSERT INTO `source_master` (`id`, `name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Nakuri', 1, 3, '2021-04-01', 3, '2021-04-01'),
(2, 'Consultant', 1, 3, '2021-04-01', 42, '2021-04-02'),
(3, 'Walk in', 1, 3, '2021-04-01', 3, '2021-04-01'),
(4, 'Facebook', 1, 3, '2021-04-01', 42, '2021-04-02'),
(5, 'Indeed', 1, 42, '2021-04-02', NULL, NULL),
(6, 'Linkedin', 1, 42, '2021-04-02', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `staff_asset`
--

DROP TABLE IF EXISTS `staff_asset`;
CREATE TABLE IF NOT EXISTS `staff_asset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(255) NOT NULL,
  `stationaries` varchar(255) NOT NULL,
  `system_or_laptop` varchar(255) NOT NULL,
  `pur_dept` varchar(255) NOT NULL,
  `id_card` int(11) NOT NULL,
  `cug` varchar(255) NOT NULL,
  `access_card` int(11) NOT NULL,
  `erp_access` int(11) NOT NULL,
  `mail_id` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_asset`
--

INSERT INTO `staff_asset` (`id`, `emp_name`, `stationaries`, `system_or_laptop`, `pur_dept`, `id_card`, `cug`, `access_card`, `erp_access`, `mail_id`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '8', '', '', '1', 14, '14', 14, 14, 'arun@bluebase.in', 1, '2021-03-30', 1, '2021-03-30'),
(2, '16', 'Keys[]', 'LapTop[]', '2', 28, '00028', 28, 28, 'arun@bluebase.in', 2, '2021-03-30', 2, '2021-03-30'),
(3, '', 'Keys', 'System', '', 25, 'Aircel', 25, 25, 'xyz@gmail.com', 2, '2021-03-30', 2, '2021-03-30'),
(4, '9', 'visiting_cards', 'system_or_laptop', '', 23, '0023', 23, 23, 'vanitha@bluebase.in', 2, '2021-03-30', 2, '2021-03-30'),
(5, '3', 'visiting_cards', 'system_or_laptop', '', 23, '0023', 23, 23, 'rizwana@bluebase.in', 2, '2021-03-30', 2, '2021-03-30'),
(6, '4', '', 'system_or_laptop', '', 24, '0024', 24, 24, 'raji@bluebase.in', 2, '2021-03-30', 2, '2021-03-30'),
(7, '5', '', '', '', 26, '26', 26, 26, 'mohan@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(8, '10', '', '', '', 27, '27', 27, 27, 'jef@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(9, '11', '', '', '', 17, '17', 17, 17, 'meena@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(10, '12', 'Array', '', '', 16, '16', 16, 16, 'uma@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(11, '8', '', '', '', 14, '14', 14, 14, 'arun@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(12, '9', '', '', '', 23, '0023', 23, 23, 'vanitha@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(13, '1', 'Visiting Cards[]', '', '', 15, '15', 15, 15, 'jai@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(14, '1', '', '', '', 15, '15', 15, 15, 'jai@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(15, '13', '', '', '', 24, '0024', 24, 24, 'sindhu@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(16, '2', 'Array', '', '', 15, '15', 15, 15, 'laxmi@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(17, '9', 'Files[]', '', '', 23, '0023', 23, 23, 'vanitha@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(18, '1', 'Keys[]', 'LapTop[]', '', 15, '15', 15, 15, 'jai@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(19, '9', 'Array', 'LapTop[]', '', 23, '0023', 23, 23, 'vanitha@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(20, '1', 'Array', 'LapTop[]', '', 15, '15', 15, 15, 'jai@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(21, '8', 'Visiting Cards[]', 'LapTop[]', '', 24, '0024', 24, 24, 'arun@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(22, '1', 'Visiting Cards[]', 'LapTop[]', '', 15, '00015', 15, 15, 'jaikumar@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(23, '2', 'Visiting Cards[]', 'System[]', '', 16, '00016', 16, 16, 'rizwana@bluebase.in', 2, '2021-03-31', 2, '2021-03-31'),
(24, '18', 'Keys[]', 'System[]', '', 14, '00014', 14, 14, 'mythili@gmail.com', 2, '2021-03-31', 2, '2021-03-31'),
(25, '7', 'Visiting Cards[]', 'System[]', '', 21, '00021', 21, 21, 'laxmi@bluebase.in', 2, '2021-04-02', 2, '2021-04-02'),
(26, '16', 'Keys[]', 'System[]', '', 28, '00028', 28, 28, 'arun@bluebase.in', 2, '2021-04-05', 2, '2021-04-05'),
(27, '16', 'Keys[]', 'LapTop[]', '', 28, '00028', 28, 28, 'arun@bluebase.in', 2, '2021-04-05', 2, '2021-04-05'),
(28, '16', 'Keys[]', 'LapTop[]', 'Kalai', 28, '00028', 28, 28, 'arun@bluebase.in', 2, '2021-04-05', 2, '2021-04-05'),
(29, '2', 'Office Stationary[]', 'LapTop[]', '', 16, '00016', 16, 16, '00016', 2, '2021-04-05', 2, '2021-04-05'),
(30, '2', 'Files[]', 'System[]', 'Office Stationery', 16, '00016', 16, 16, 'rizwana@bluebase.in', 2, '2021-04-05', 2, '2021-04-05'),
(31, '2', 'Office Stationary[]', 'LapTop[]', 'ALL', 16, '00016', 16, 16, 'rizwana@bluebase.in', 2, '2021-04-05', 2, '2021-04-05'),
(32, '6', 'Visiting Cards[]', 'LapTop[]', 'Ramakrishnan', 20, '00020', 20, 20, 'sebastain@bluebase.in', 2, '2021-04-07', 2, '2021-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `staff_asset_master`
--

DROP TABLE IF EXISTS `staff_asset_master`;
CREATE TABLE IF NOT EXISTS `staff_asset_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_asset_master`
--

INSERT INTO `staff_asset_master` (`id`, `asset`, `created_by`, `created_on`) VALUES
(3, 'Files', 1, '2021-04-06 18:30:00'),
(2, 'Visiting Cards', 1, '2021-04-06 18:30:00'),
(1, 'Office Stationary', 1, '2021-04-06 18:30:00'),
(4, 'Keys', 1, '2021-04-06 18:30:00'),
(5, 'System ', 1, '2021-04-06 18:30:00'),
(6, 'Laptop', 1, '2021-04-06 18:30:00'),
(7, 'ID Card', 1, '2021-04-06 18:30:00'),
(8, 'CUG', 1, '2021-04-06 18:30:00'),
(9, 'Access Card', 1, '2021-04-06 18:30:00'),
(10, 'ERP Access', 1, '2021-04-06 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `staff_master`
--

DROP TABLE IF EXISTS `staff_master`;
CREATE TABLE IF NOT EXISTS `staff_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candid_id` int(11) DEFAULT NULL,
  `prefix_code` varchar(25) NOT NULL,
  `emp_code` varchar(155) DEFAULT NULL,
  `emp_name` varchar(155) DEFAULT NULL,
  `dep_id` int(11) DEFAULT NULL,
  `div_id` int(11) DEFAULT NULL,
  `design_id` int(11) DEFAULT NULL,
  `scale_master_id` int(11) DEFAULT NULL,
  `payroll_deduction_id` varchar(155) DEFAULT NULL,
  `salary_amount` int(155) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `reporting_person` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff_master`
--

INSERT INTO `staff_master` (`id`, `candid_id`, `prefix_code`, `emp_code`, `emp_name`, `dep_id`, `div_id`, `design_id`, `scale_master_id`, `payroll_deduction_id`, `salary_amount`, `status`, `reporting_person`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 2, 'BB', '00015', 'Jaikumar ', 3, 2, 4, 1, '1', 30000, 1, 3, 1, '2021-03-23', 3, '2021-04-09'),
(2, 10, 'BB', '00016', 'Rizwana ', 3, 4, 9, 1, '1,2', 10000, 1, NULL, 1, '2021-03-23', 42, '2021-03-31'),
(3, 1, 'BB', '00017', 'Rajeshwari ', 1, 1, 2, 1, '1', 40000, 1, NULL, 1, '2021-03-23', 42, '2021-03-31'),
(4, 11, 'BB', '00018', 'Mohana Krishnan', 3, 5, 10, 1, '1,2', 12000, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(5, 6, 'BB', '00019', 'Gopinath ', 3, 2, 5, 1, '1,2', 18000, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(6, 9, 'BB', '00020', 'Sebastain ', 3, 3, 7, 1, '1,2', 15200, 1, NULL, 1, '2021-03-23', 42, '2021-03-31'),
(7, 5, 'BB', '00021', 'Laxmi Priya', 3, 2, 5, 1, '1,2', 15600, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(8, 17, 'BB', '00022', 'Arunachalam ', 4, 7, 12, 1, '1,2', 8400, 1, NULL, 1, '2021-03-23', 42, '2021-03-31'),
(9, 15, 'BB', '00023', 'Vanitha ', 3, 2, 8, 1, '1,2', 6000, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(10, 16, 'BB', '00024', 'Jefferson Fernando', 2, 6, 11, 1, '1,2', 6000, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(11, 12, 'BB', '00025', 'Meena B', 2, 8, 13, 1, '1,2', 12800, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(12, 7, 'BB', '00026', 'Umadevi ', 3, 2, 6, 1, '1,2', 12800, 1, NULL, 1, '2021-03-23', 42, '2021-03-31'),
(13, 8, 'BB', '00027', 'Sindhu G ', 3, 2, 6, 1, '1,2', 20000, 1, NULL, 1, '2021-03-23', 42, '2021-03-31'),
(14, 3, 'BB', '00011\r\n', 'Girish Madhavan ', 1, 1, 1, 1, '0', NULL, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(15, 4, 'BB', '00012\r\n', 'Ramakrishnan ', 1, 1, 3, 1, '0', NULL, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(16, 23, 'BB', '00028\r\n', 'Arun ', 5, 9, 14, 1, '0', NULL, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(17, 26, 'BB', '00029\r\n', 'Sakthi ', 6, 10, 15, 1, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(18, 24, 'BB', '00014\r\n', 'Mythili ', 6, 10, 16, 1, '0', NULL, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(19, 25, 'BB', '00013\r\n', 'Karthikeyan ', 7, 11, 17, 1, '0', NULL, 1, NULL, 1, '2021-03-23', 3, '2021-04-02'),
(20, 27, 'BC', '00001\r\n', 'Selvaraj ', 5, 9, 14, 0, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(21, 28, 'BC', '00002\r\n', 'Vaidyanathan ', 5, 9, 14, 0, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(22, 29, 'BC', '00003\r\n', 'Christy ', 5, 9, 14, 0, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(23, 30, 'BC', '00004\r\n', 'Muthuraj ', 5, 9, 14, 0, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(24, 31, 'BC', '00005\r\n', 'Kalai ', 8, 12, 18, 0, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(25, 32, 'BC', '00006\r\n', 'Shanmuganathan ', 9, 13, 19, 0, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(26, 33, 'BC', '00007\r\n', 'Karthik ', 9, 13, 19, 0, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07'),
(27, 34, 'BC', '00008\r\n', 'Venkatesan ', 9, 13, 19, 0, '0', NULL, 1, NULL, 1, '2021-03-23', 42, '2021-04-07');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

DROP TABLE IF EXISTS `tbl_comment`;
CREATE TABLE IF NOT EXISTS `tbl_comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_comment_id` int(11) DEFAULT NULL,
  `comment` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `comment_sender_name` varchar(40) CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `parent_comment_id`, `comment`, `comment_sender_name`, `date`) VALUES
(1, 12, 'ok', 'abc', '2021-04-15 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `technical_person_feedback`
--

DROP TABLE IF EXISTS `technical_person_feedback`;
CREATE TABLE IF NOT EXISTS `technical_person_feedback` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `technical_person_name` varchar(150) NOT NULL,
  `technical_skill` varchar(150) NOT NULL,
  `rating` int(11) NOT NULL,
  `response` varchar(150) NOT NULL,
  `overall_ratings` int(255) NOT NULL,
  `remarks` varchar(150) NOT NULL,
  `feedback` varchar(150) NOT NULL,
  `status` int(255) NOT NULL,
  `created_by` int(255) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(255) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `technical_person_feedback`
--

INSERT INTO `technical_person_feedback` (`id`, `technical_person_name`, `technical_skill`, `rating`, `response`, `overall_ratings`, `remarks`, `feedback`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'ramesh', 'programming', 5, 'good', 5, 'qqqq', 'to be improve', 1, 1, '2020-09-08 11:06:13', 1, '2020-09-08 11:06:23'),
(2, 'rajesh', 'php', 5, 'good', 5, 'nill', 'xxx', 1, 1, '2020-09-08 11:22:17', 1, '2020-09-08 11:23:00'),
(3, 'jhon', 'programming', 5, 'gud', 5, 'nill', 'good', 1, 1, '2020-10-09 12:20:20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `technical_team_commands`
--

DROP TABLE IF EXISTS `technical_team_commands`;
CREATE TABLE IF NOT EXISTS `technical_team_commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `technical_id` int(100) DEFAULT NULL,
  `skill` varchar(100) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `response` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `technical_team_commands`
--

INSERT INTO `technical_team_commands` (`id`, `technical_id`, `skill`, `rating`, `response`) VALUES
(4, 1, 'etg', 4, '5'),
(3, 1, 'er', 5, '5'),
(5, 4, 'java', 3, '4'),
(6, 4, 'sql', 2, '3'),
(7, 4, 'javascript', 5, '5'),
(8, 6, 'sql', 3, '5'),
(9, 6, 'java', 3, '5'),
(10, 2, 'php', 4, '4'),
(11, 2, 'sql', 3, '4'),
(12, 3, 'PHP', 3, '3'),
(13, 3, 'Node.js', 3, '3'),
(14, 3, 'SQL', 4, '4'),
(15, 3, 'JAVA', 5, '5'),
(16, 3, '', 3, '4'),
(17, 3, 'php', 4, '4'),
(18, 3, 'sql', 4, '2'),
(19, 3, 'PHP', 4, '4'),
(20, 4, 'PHP', 5, '5'),
(21, 3, 'PHP', 4, '2'),
(22, 3, 'SQL', 4, '2'),
(23, 3, 'PHP', 4, '2'),
(24, 3, 'PHP', 3, '2'),
(25, 6, 'node.js', 3, '2'),
(26, 3, 'PHP', 4, '2'),
(27, 19, 'php', 2, '5'),
(28, 19, 'hf', 1, '4'),
(29, 21, 'php', 4, '5'),
(30, 21, 'sdf', 4, '5'),
(31, 20, 'wer', 4, '4'),
(32, 20, 'rtyt', 4, '4'),
(33, 22, 'php', 5, '5'),
(34, 22, 'java', 4, '4'),
(35, 23, 'php', 3, '5'),
(36, 24, 'php', 4, '5'),
(37, 25, 'php', 3, '5'),
(38, 26, 'netwotk', 4, '4'),
(39, 26, 'router', 2, '4'),
(40, 26, 'php', 4, '3'),
(41, 26, 'java', 3, '2'),
(42, 27, 'sdf', 1, '5'),
(43, 27, 'sdf', 3, '3'),
(47, 37, 'javascript', 4, '5'),
(46, 37, 'sql', 3, '2'),
(48, 39, 'sql', 4, '5'),
(49, 39, '', 3, '4'),
(50, 41, 'sql', 4, '5'),
(51, 41, '', 3, '4');

-- --------------------------------------------------------

--
-- Table structure for table `technical_team_details`
--

DROP TABLE IF EXISTS `technical_team_details`;
CREATE TABLE IF NOT EXISTS `technical_team_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(100) DEFAULT NULL,
  `head_name` varchar(50) DEFAULT NULL,
  `rating` int(10) DEFAULT NULL,
  `remarks` varchar(150) DEFAULT NULL,
  `head_status` varchar(50) DEFAULT NULL,
  `status` int(10) DEFAULT '0',
  `created_by` int(5) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(5) DEFAULT NULL,
  `modified_on` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `technical_team_details`
--

INSERT INTO `technical_team_details` (`id`, `candidate_id`, `head_name`, `rating`, `remarks`, `head_status`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'gopi', 5, 'pgp', '16', 7, NULL, '2020-11-23 10:48:11', NULL, NULL),
(2, 4, 'jai', 5, 'sql is not satisfied', '13', 0, NULL, '2021-02-20 11:07:50', NULL, NULL),
(3, 6, 'rajeshwari', 5, 'sdfg', '13', 0, NULL, '2021-02-22 06:02:55', NULL, NULL),
(4, 2, 'Vani', 5, 'ok', '7', 0, NULL, '2021-02-22 10:31:34', NULL, NULL),
(5, 3, 'Raji', 5, 'ok', '10', 0, NULL, '2021-03-01 11:10:32', NULL, NULL),
(6, 3, '', 5, 'GOOD', '10', 0, NULL, '2021-03-01 11:38:05', NULL, NULL),
(7, 3, '', 5, 'ok', '10', 0, NULL, '2021-03-01 11:42:37', NULL, NULL),
(8, 3, '', 5, 'ok', '10', 0, NULL, '2021-03-01 11:44:39', NULL, NULL),
(9, 3, 'Raji', 5, 'GOOD', '10', 0, NULL, '2021-03-02 04:12:35', NULL, NULL),
(10, 4, 'Raji', 5, 'GOOD', '13', 0, NULL, '2021-03-02 04:14:33', NULL, NULL),
(11, 3, 'Raji', 5, 'GOOD', '10', 0, NULL, '2021-03-02 05:14:39', NULL, NULL),
(12, 3, 'Raji', 5, 'GOOD', '10', 0, NULL, '2021-03-02 05:17:29', NULL, NULL),
(13, 3, '', 5, 'OK', '10', 0, NULL, '2021-03-02 05:25:06', NULL, NULL),
(14, 6, '', 5, 'OK', '13', 0, NULL, '2021-03-02 05:30:32', NULL, NULL),
(15, 3, '', 5, 'GOOD', '10', 0, NULL, '2021-03-02 10:00:55', NULL, NULL),
(16, 19, 'laxmi', 5, 'tht', '4', 0, NULL, '2021-03-16 08:28:41', NULL, NULL),
(17, 21, 'jai', 5, 's', '16', 0, NULL, '2021-03-16 09:07:58', NULL, NULL),
(18, 20, 'jai', 4, 'wer', '16', 0, NULL, '2021-03-16 10:58:26', NULL, NULL),
(19, 22, 'laxmi', 3, 'the', '16', 0, NULL, '2021-03-17 04:05:37', NULL, NULL),
(20, 23, 'jai', 8, '8', '7', 0, NULL, '2021-03-17 04:27:30', NULL, NULL),
(21, 24, 'jeffarson', 8, 'ok', '7', 0, NULL, '2021-03-17 04:37:13', NULL, NULL),
(22, 25, 'jai', 5, 'ok', '7', 0, NULL, '2021-03-17 05:34:44', NULL, NULL),
(23, 26, 'gopinath', 5, 'willing', '7', 0, NULL, '2021-03-17 06:39:51', NULL, NULL),
(24, 27, 'sdf', 4, 'dsf', '7', 0, NULL, '2021-03-17 09:27:16', NULL, NULL),
(26, 37, '', 5, '', '4', 0, NULL, '2021-04-16 06:14:25', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

DROP TABLE IF EXISTS `user_master`;
CREATE TABLE IF NOT EXISTS `user_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `ass_emp_id` int(11) DEFAULT NULL,
  `candidate_id` int(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `email_id` varchar(250) DEFAULT NULL,
  `user_group_code` varchar(250) DEFAULT NULL,
  `mobile_no` varchar(200) DEFAULT NULL,
  `profile` varchar(250) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `created_by` varchar(200) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` varchar(250) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `user_id`, `ass_emp_id`, `candidate_id`, `department`, `user_name`, `password`, `full_name`, `status`, `email_id`, `user_group_code`, `mobile_no`, `profile`, `gender`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 0, NULL, '1', 'candidate', 'cd84d683cc5612c69efe115c80d0b7dc', 'Intreviewer', 1, 'hr@quadsel.in', 'ROLE-001', '9876543211', 'userlog/intreviewer.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(2, 2, 0, NULL, '2', 'Recruiter', 'cd84d683cc5612c69efe115c80d0b7dc', 'Recruiter', 1, 'hr@quadsel.in', 'ROLE-002', '9876543211', 'userlog/hr.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(3, 3, 0, NULL, '2', 'admin', 'cd84d683cc5612c69efe115c80d0b7dc', 'Admin', 1, 'hr@admin.in', 'ROLE-003', '9876543211', 'userlog/hr.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(4, 4, 0, NULL, '3', 'technical', 'cd84d683cc5612c69efe115c80d0b7dc', 'Technical', 1, 'hr@admin.in', 'ROLE-004', '9876543211', 'userlog/hr.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(5, 5, 0, NULL, '2', 'md', 'cd84d683cc5612c69efe115c80d0b7dc', 'Md', 1, 'hr@quadsel.in', 'ROLE-005', '9876543211', '', 'male', '1', '2020-08-10', '1', '2020-08-10 00:00:00'),
(6, 6, 0, 1, '5', 'balachandar', 'cd84d683cc5612c69efe115c80d0b7dc', 'balachandar', 1, 'bala@bluebase.in', 'ROLE-007', '9089786756', NULL, 'male', '1', '2020-11-20', NULL, NULL),
(7, 7, 0, 2, '5', 'bala ', 'cd84d683cc5612c69efe115c80d0b7dc', 'bala ', 1, 'bala@bluebase.in', 'ROLE-007', '9089786756', NULL, 'male', '1', '2020-11-20', NULL, NULL),
(8, 8, 0, 3, '5', 'Gopinath', 'cd84d683cc5612c69efe115c80d0b7dc', 'Gopinath', 1, 'gopi@gmail.com', 'ROLE-006', '8547856985', NULL, 'male', '1', '2020-11-23', NULL, NULL),
(9, 9, 0, 4, '5', 'aishwaria', 'cd84d683cc5612c69efe115c80d0b7dc', 'aishwaria', 1, 'aishu@gmail.com', 'ROLE-006', '879564122', NULL, 'female', '1', '2021-02-20', NULL, NULL),
(10, 10, 0, 5, '5', 'Ishwarya', 'cd84d683cc5612c69efe115c80d0b7dc', 'Ishwarya', 1, 'abc@gmail.com', 'ROLE-006', '3435567123', NULL, 'male', '1', '2021-02-22', NULL, NULL),
(11, 11, 0, 6, '5', 'sakthi', 'cd84d683cc5612c69efe115c80d0b7dc', 'sakthi', 1, 'kk_arun@yahoo.com', 'ROLE-006', '89756216', NULL, 'male', '1', '2021-02-22', NULL, NULL),
(12, 12, 0, 7, '5', 'Abinaya', 'cd84d683cc5612c69efe115c80d0b7dc', 'Abinaya', 1, 'ishu@gmail.com', 'ROLE-006', '9548361423', NULL, 'female', '1', '2021-02-24', NULL, NULL),
(13, 13, 0, 8, '', '', 'cd84d683cc5612c69efe115c80d0b7dc', '', 1, '', 'ROLE-006', '', NULL, 'male', '1', '2021-02-24', NULL, NULL),
(14, 14, 0, NULL, '3', 'hod', 'cd84d683cc5612c69efe115c80d0b7dc', 'HOD', 1, 'hr@admin.in', 'ROLE-008', '9876543211', NULL, 'male', '1', '2021-03-01', '1', '2021-03-01 09:31:47'),
(15, 15, 0, NULL, '3', 'technical1', 'cd84d683cc5612c69efe115c80d0b7dc', 'Technical1', 1, 'hr@admin.in', 'ROLE-008', '9876543211', NULL, 'male', '1', '2021-03-01', '1', '2021-03-01 09:31:47'),
(16, 17, 0, 10, '5', 'Vani', 'cd84d683cc5612c69efe115c80d0b7dc', 'Vani', 1, 'abc@gmail.com', 'ROLE-006', '1234566789', NULL, 'female', '1', '2021-03-03', NULL, NULL),
(17, 18, 0, 11, '5', 'Vanitha', 'cd84d683cc5612c69efe115c80d0b7dc', 'Vanitha', 1, 'vanitha@gmail.com', 'ROLE-006', '1234567890', NULL, 'female', '1', '2021-03-04', NULL, NULL),
(18, 19, 0, NULL, '2', 'Rajeshwari', 'cd84d683cc5612c69efe115c80d0b7dc', 'Rajeshwari', 1, 'hr@admin.in', 'ROLE-003', '9876543211', 'userlog/hr.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(19, 25, 0, 12, '5', 'Rohan', 'cd84d683cc5612c69efe115c80d0b7dc', 'Rohan', 1, 'rohan@gmail.com', 'ROLE-006', '9874561230', NULL, 'male', '1', '2021-03-06', NULL, NULL),
(20, 26, 1, 0, '5', 'Laxmi', 'cd84d683cc5612c69efe115c80d0b7dc', 'laxmi', 1, 'rohan@gmail.com', 'ROLE-009', '9874561230', NULL, 'male', '1', '2021-03-06', NULL, NULL),
(21, 27, 3, NULL, '5', 'vanitha', 'cd84d683cc5612c69efe115c80d0b7dc', 'vanitha', 1, NULL, 'ROLE-009', 'fghfgh', NULL, 'female', '1', '2021-03-06', NULL, NULL),
(22, 28, NULL, 19, '2', 'meena', 'cd84d683cc5612c69efe115c80d0b7dc', 'meena', 1, 'sdf@gmail.com', 'ROLE-006', '879564132', NULL, 'male', '1', '2021-03-16', NULL, NULL),
(23, 29, NULL, 20, '5', 'Laxmipriya', 'cd84d683cc5612c69efe115c80d0b7dc', 'Laxmipriya', 1, 'laxmipriya@bluebase.in', 'ROLE-007', 'adfsdaf', NULL, 'female', '1', '2021-03-16', NULL, NULL),
(24, 30, NULL, 21, '3', 'mekala', 'cd84d683cc5612c69efe115c80d0b7dc', 'mekala', 1, 'laxmipriya@bluebase.in', 'ROLE-007', '9994996010', NULL, 'male', '1', '2021-03-16', NULL, NULL),
(25, 31, NULL, 22, '5', 'Jefferarason', 'cd84d683cc5612c69efe115c80d0b7dc', 'Jefferarason', 1, 'jegff@gmail.com', 'ROLE-007', '879564132', NULL, 'male', '1', '2021-03-17', NULL, NULL),
(26, 32, NULL, 23, '1', 'sindhu', 'cd84d683cc5612c69efe115c80d0b7dc', 'sindhu', 1, 'sindhu@gmail.com', 'ROLE-006', '879564', NULL, 'male', '1', '2021-03-17', NULL, NULL),
(27, 33, NULL, 24, '1', 'sakthi', 'cd84d683cc5612c69efe115c80d0b7dc', 'sakthi', 1, 'sakthi@gmail.com', 'ROLE-006', '879564', NULL, 'male', '1', '2021-03-17', NULL, NULL),
(28, 34, NULL, 25, '4', 'Uma', 'cd84d683cc5612c69efe115c80d0b7dc', 'Uma', 1, 'una@gmail.com', 'ROLE-006', '8794123', NULL, 'male', '1', '2021-03-17', NULL, NULL),
(29, 35, NULL, 26, '5', 'meenakshi', 'cd84d683cc5612c69efe115c80d0b7dc', 'meenakshi', 1, 'meena@gmail.com', 'ROLE-006', '98765432', NULL, 'male', '1', '2021-03-17', NULL, NULL),
(30, 36, NULL, 27, '3', 'sathish', 'cd84d683cc5612c69efe115c80d0b7dc', 'sathish', 1, 'sa@gmail.com', 'ROLE-006', '879456', NULL, 'male', '1', '2021-03-17', NULL, NULL),
(31, 37, NULL, 28, '1', 'mani', 'cd84d683cc5612c69efe115c80d0b7dc', 'mani', 1, 'dsaf@gmail.com', 'ROLE-006', '5436456', NULL, 'male', '1', '2021-03-17', NULL, NULL),
(32, 38, 1, NULL, '5', 'Laxmi Priya', 'cd84d683cc5612c69efe115c80d0b7dc', 'Laxmi Priya', 1, NULL, 'ROLE-009', '9790218732', NULL, 'female', '1', '2021-03-23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vms`
--

DROP TABLE IF EXISTS `vms`;
CREATE TABLE IF NOT EXISTS `vms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Date` date DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mob_num` varchar(255) DEFAULT NULL,
  `Coming_from` varchar(255) DEFAULT NULL,
  `companys` varchar(255) DEFAULT NULL,
  `Purpose` varchar(255) DEFAULT NULL,
  `Department` varchar(255) DEFAULT NULL,
  `employee` varchar(255) DEFAULT NULL,
  `vehicle` varchar(255) DEFAULT NULL,
  `veh_no` varchar(255) DEFAULT NULL,
  `Remarks` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1',
  `created_by` int(11) DEFAULT '1',
  `created_on` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vms`
--

INSERT INTO `vms` (`id`, `Date`, `first_name`, `email`, `mob_num`, `Coming_from`, `companys`, `Purpose`, `Department`, `employee`, `vehicle`, `veh_no`, `Remarks`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '2021-04-11', 'gopinath', 'gnath@gmailcom', '5641325', 'chennai', 'Quadsel Systems Private Limited', 'project', '3', '6', 'two wheeler', 'TN12 3456', 'no', 2, 1, '2021-04-07 05:11:03', NULL, NULL),
(2, '2021-04-08', 'arun', 'aruna@gmail.com', '9876543215', 'salem', 'Quadsel Systems Private Limited', 'project', '3', '5', 'cycle', 'TN12345', 'ok', 2, 1, '2021-04-07 05:29:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `x_table_recruitment`
--

DROP TABLE IF EXISTS `x_table_recruitment`;
CREATE TABLE IF NOT EXISTS `x_table_recruitment` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `position` varchar(100) NOT NULL,
  `candidate_name` varchar(100) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `Paddress` varchar(100) NOT NULL,
  `phone` int(10) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `adharnumber` int(100) NOT NULL,
  `adharcard` varchar(100) NOT NULL,
  `pannumber` int(100) NOT NULL,
  `pancard` varchar(100) NOT NULL,
  `voternumber` int(100) NOT NULL,
  `votercard` varchar(100) NOT NULL,
  `resume` varchar(100) NOT NULL,
  `Examination_passed_1` varchar(100) NOT NULL,
  `instute_1` varchar(100) NOT NULL,
  `degree_1` varchar(100) NOT NULL,
  `field_1` varchar(100) NOT NULL,
  `passing_1` varchar(100) NOT NULL,
  `percentage_1` varchar(100) NOT NULL,
  `attachment_1` varchar(100) NOT NULL,
  `certifcatename_1` varchar(100) NOT NULL,
  `certifcatnumber_1` varchar(100) NOT NULL,
  `validityfrom_1` varchar(100) NOT NULL,
  `validityto_1` varchar(100) NOT NULL,
  `certifcatefile_1` varchar(100) NOT NULL,
  `organization_1` varchar(100) NOT NULL,
  `Designation_1` varchar(100) NOT NULL,
  `From_1` varchar(100) NOT NULL,
  `to_1` varchar(100) NOT NULL,
  `yearofexperience_1` varchar(100) NOT NULL,
  `overallexp` varchar(100) NOT NULL,
  `reference` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `interview_date` date NOT NULL,
  `Status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `x_table_recruitment`
--

INSERT INTO `x_table_recruitment` (`id`, `position`, `candidate_name`, `father_name`, `dob`, `Paddress`, `phone`, `mail`, `adharnumber`, `adharcard`, `pannumber`, `pancard`, `voternumber`, `votercard`, `resume`, `Examination_passed_1`, `instute_1`, `degree_1`, `field_1`, `passing_1`, `percentage_1`, `attachment_1`, `certifcatename_1`, `certifcatnumber_1`, `validityfrom_1`, `validityto_1`, `certifcatefile_1`, `organization_1`, `Designation_1`, `From_1`, `to_1`, `yearofexperience_1`, `overallexp`, `reference`, `signature`, `interview_date`, `Status`) VALUES
(1, 'developer', 'ram', 'raju', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '245465776', 12547687, '453768979', 445, '23245546', 'ramu resume', '34', 'MZCET', 'BE', 'Marketing', 'ok', '50', 'ok', 'xyz', '23435', '2', '4', 'fgh', 'fghgf', 'ghh', '67', 'ty', '7', 'tyuy', 'rtyu', 'tyu', '2021-02-17', 'active'),
(4, 'developer', 'ram', 'raju', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '245465776', 12547687, '453768979', 445, '23245546', 'ramu resume', '34', 'MZCET', 'BE', 'Marketing', 'ok', '50', 'ok', 'xyz', '23435', '2', '4', 'fgh', 'fghgf', 'ghh', '67', 'ty', '7', 'tyuy', 'rtyu', 'tyu', '2021-02-17', 'active'),
(2, 'developer', 'ram', 'raju', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '245465776', 12547687, '453768979', 445, '23245546', 'ramu resume', '34', 'MZCET', 'BE', 'Marketing', 'ok', '50', 'ok', 'xyz', '23435', '2', '4', 'fgh', 'fghgf', 'ghh', '67', 'ty', '7', 'tyuy', 'rtyu', 'tyu', '2021-02-17', 'active'),
(3, 'developer', 'ram', 'raju', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '245465776', 12547687, '453768979', 445, '23245546', 'ramu resume', '34', 'MZCET', 'BE', 'Marketing', 'ok', '50', 'ok', 'xyz', '23435', '2', '4', 'fgh', 'fghgf', 'ghh', '67', 'ty', '7', 'tyuy', 'rtyu', 'tyu', '2021-02-17', 'active'),
(6, 'tester', 'rani', 'vibu', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '32545', 435, '345', 344, '45', '56', '45', '565', 'complete', 'computer', 'ok', '50', 'ok', 'ok', '34546', '4', '7', '4', 'ryuu', 'yuyi', '6', '567', '2', 'jhk', 'vani', 'jjhk', '2021-02-01', '1'),
(8, 'tester', 'rani', 'vibu', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '32545', 435, '345', 344, '45', '56', '45', '565', 'complete', 'computer', 'ok', '50', 'ok', 'ok', '34546', '4', '7', '4', 'ryuu', 'yuyi', '6', '567', '2', 'jhk', 'vani', 'jjhk', '2021-02-01', '1'),
(9, 'tester', 'rani', 'vibu', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '32545', 435, '345', 344, '45', '56', '45', '565', 'complete', 'computer', 'ok', '50', 'ok', 'ok', '34546', '4', '7', '4', 'ryuu', 'yuyi', '6', '567', '2', 'jhk', 'vani', 'jjhk', '2021-02-01', '1'),
(10, 'tester', 'rani', 'vibu', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '32545', 435, '345', 344, '45', '56', '45', '565', 'complete', 'computer', 'ok', '50', 'ok', 'ok', '34546', '4', '7', '4', 'ryuu', 'yuyi', '6', '567', '2', 'jhk', 'vani', 'jjhk', '2021-02-01', '1'),
(11, 'tester', 'rani', 'vibu', '2021-02-09', 'chennai', 1234677899, 'abc@gmail.com', 2343466, '32545', 435, '345', 344, '45', '56', '45', '565', 'complete', 'computer', 'ok', '50', 'ok', 'ok', '34546', '4', '7', '4', 'ryuu', 'yuyi', '6', '567', '2', 'jhk', 'vani', 'jjhk', '2021-02-01', '1');

-- --------------------------------------------------------

--
-- Table structure for table `y_leave_category`
--

DROP TABLE IF EXISTS `y_leave_category`;
CREATE TABLE IF NOT EXISTS `y_leave_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL,
  `leave_ids` int(10) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `y_leave_category`
--

INSERT INTO `y_leave_category` (`id`, `type`, `leave_ids`, `status`) VALUES
(1, 'employee', 1, 1),
(2, 'contractor', 2, 1),
(3, 'test', 3, 1),
(4, 'check', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `y_leave_details`
--

DROP TABLE IF EXISTS `y_leave_details`;
CREATE TABLE IF NOT EXISTS `y_leave_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_name` varchar(100) DEFAULT NULL,
  `count` int(10) DEFAULT NULL,
  `balance_leave` varchar(150) DEFAULT NULL,
  `leave_type` int(10) DEFAULT NULL,
  `no_of_days` int(10) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `from_time` int(10) DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `to_time` int(10) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `phone` varchar(25) DEFAULT NULL,
  `approver_name` varchar(100) DEFAULT NULL,
  `month` int(5) DEFAULT NULL,
  `year` int(10) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `reject_reason` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `y_leave_details`
--

INSERT INTO `y_leave_details` (`id`, `employee_name`, `count`, `balance_leave`, `leave_type`, `no_of_days`, `from_date`, `from_time`, `to_date`, `to_time`, `reason`, `address`, `phone`, `approver_name`, `month`, `year`, `status`, `reject_reason`, `created_on`, `modified_on`) VALUES
(1, '1', 2, 'Sick Leave', 1, 2, '2020-05-01', NULL, '2020-05-02', NULL, 'Going Hometown', '8978674523', '', 'Rajeshwari', 6, 2020, 2, NULL, '2020-06-10 00:00:00', '2020-06-10 00:00:00'),
(2, '1', 2, 'Sick Leave', 1, 2, '2020-05-04', NULL, '2020-05-05', NULL, 'Going Hometown', '8978674523', '', 'Rajeshwari', 6, 2020, 2, NULL, '2020-06-10 00:00:00', '2020-06-10 00:00:00'),
(3, '4', 2, 'Sick Leave', 1, 1, '2020-06-18', NULL, '2020-06-18', NULL, 'Fever', 'Kodambakkam', '988675645', 'Rajeshwari', 6, 2020, 2, NULL, '2020-06-18 00:00:00', '2020-06-18 00:00:00'),
(4, '1', 2, 'Sick Leave', 1, 2, '2020-08-01', NULL, '2020-08-06', NULL, 'Going Hometown', 'sasa', '9089786756', 'Rajeshwari', 8, 2020, 1, NULL, '2020-08-06 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `y_masters_employee`
--

DROP TABLE IF EXISTS `y_masters_employee`;
CREATE TABLE IF NOT EXISTS `y_masters_employee` (
  `id` int(155) NOT NULL AUTO_INCREMENT,
  `emp_no` int(15) DEFAULT NULL,
  `tittle` varchar(30) DEFAULT NULL,
  `gender` varchar(100) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `department` varchar(10) DEFAULT NULL,
  `designation` varchar(10) DEFAULT NULL,
  `country` varchar(50) DEFAULT NULL,
  `region` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `id_type` varchar(100) DEFAULT NULL,
  `id_number` varchar(100) DEFAULT NULL,
  `id_upload` varchar(50) DEFAULT NULL,
  `remark` varchar(50) DEFAULT NULL,
  `doj` date DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `leave_type` varchar(50) DEFAULT NULL,
  `father_name` varchar(160) DEFAULT NULL,
  `walkin_way` varchar(100) DEFAULT NULL,
  `date_of_interview` date DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `y_masters_employee`
--

INSERT INTO `y_masters_employee` (`id`, `emp_no`, `tittle`, `gender`, `first_name`, `last_name`, `user_name`, `email`, `password`, `DOB`, `phone`, `department`, `designation`, `country`, `region`, `city`, `address`, `id_type`, `id_number`, `id_upload`, `remark`, `doj`, `salary`, `leave_type`, `father_name`, `walkin_way`, `date_of_interview`, `status`) VALUES
(1, 1001, 'Employee', 'male', 'Bala', 'Chandar', 'balachandars', 'bala@bluebase.in', 'c8774ef5702b5950b488cadc9b64048d', '1995-07-30', '8978674523', '1', '3', 'India', 'Tamilnadu', 'Chennai', 'Kknagar', 'ahdar', '7856HAGA12', NULL, ' test', '2018-04-09', '1', '1', NULL, NULL, NULL, 1),
(2, 1002, NULL, 'female', 'Rizwana', 'shaik', 'rizwana', 'riz@bluebase.in', '249d24fe522f9a1a5a96024fea1faad7', '2020-06-03', '89786745', '1', '3', 'India', 'Andhra', 'Chennai', 'kknagar', 'adhar', '1788JHASS1', NULL, 'employee', '2020-06-10', '2', '1', NULL, NULL, NULL, 1),
(3, 1003, NULL, 'male', 'Jai', 'Kumar', 'jaikumar', 'jai@bluebase.in', '0decd5c563c0f47e3a074ce427bfb838', '2020-06-04', '8967563412', '1', '2', 'India', 'Tamilnadu', 'chennai', 'kodambakkam', 'ahdar', '7878HJKHJ1', NULL, 'contract', '2020-06-10', '1', '2', NULL, NULL, NULL, 1),
(7, NULL, NULL, 'male', 'mohan', 'c', 'mohan', 'mohan@gmail.com', 'e9206237def4b4ef46fd933ed0f5a08f', '2020-07-02', '8767564534', '1', '3', 'india', 'tamilnadu', 'chennai', 'kknagar', 'ahdar', '1261987289', NULL, 'join', '1970-01-01', '2', '1', NULL, NULL, '2020-07-14', 1),
(6, 1004, NULL, 'male', 'Bala', 'Chandar', 'bala', 'bala@bluebase.in', '51d29ccef331f229c7b90b0b68971406', '1995-07-30', '8767564534', '1', '3', 'India', 'Tamilnadiu', 'chennai', 'kknagar', 'adhar', '61627167', NULL, 'Leave', '2020-07-13', '1', '1', NULL, NULL, '2020-07-13', 1),
(8, 1, NULL, 'male', 'jai', 'kumar', 'jai', 'jai@bluebase.in', '421493fa48fc8df84d1f5f3478cf247a', '2020-06-04', '8978676543', '1', '3', 'Indai', 'tamilnadu', 'chennai', 'kodambakkam', 'adhar', '354313234131', NULL, 'Joining', '1970-01-01', '1', '1', NULL, NULL, '2020-07-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `y_master_leave`
--

DROP TABLE IF EXISTS `y_master_leave`;
CREATE TABLE IF NOT EXISTS `y_master_leave` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_name` varchar(100) DEFAULT NULL,
  `no_of_days` int(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `y_master_leave`
--

INSERT INTO `y_master_leave` (`id`, `leave_name`, `no_of_days`, `status`) VALUES
(1, 'Sick Leave', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `z_department_master`
--

DROP TABLE IF EXISTS `z_department_master`;
CREATE TABLE IF NOT EXISTS `z_department_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dept_name` varchar(50) DEFAULT NULL,
  `status` int(5) DEFAULT NULL,
  `created_by` int(5) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_department_master`
--

INSERT INTO `z_department_master` (`id`, `dept_name`, `status`, `created_by`, `created_on`) VALUES
(1, 'Management', 1, 2, '2021-03-30 20:42:09'),
(2, 'Designing', 1, 2, '2021-03-30 20:42:51'),
(3, 'Development', 1, 2, '2021-03-30 20:43:21'),
(4, 'Digital Marketing', 1, 2, '2021-03-30 20:44:03'),
(5, 'Marketing', 1, 2, '2021-03-30 20:44:22'),
(6, 'HR & Admin', 1, 2, '2021-03-30 20:45:44'),
(7, 'Finance', 1, 2, '2021-03-30 20:46:30'),
(8, 'Purchase', 1, 2, '2021-04-07 16:44:35'),
(9, 'Service', 1, 2, '2021-04-07 16:52:31');

-- --------------------------------------------------------

--
-- Table structure for table `z_log_entry`
--

DROP TABLE IF EXISTS `z_log_entry`;
CREATE TABLE IF NOT EXISTS `z_log_entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(200) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `logdate` date NOT NULL,
  `system_ip` varchar(200) NOT NULL,
  `time` time DEFAULT NULL,
  `logout` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1522 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_log_entry`
--

INSERT INTO `z_log_entry` (`id`, `user_id`, `user_name`, `logdate`, `system_ip`, `time`, `logout`) VALUES
(1, '', '', '2020-08-10', '::1', '23:24:42', NULL),
(2, '', 'Intreviewer', '2020-08-10', '::1', '23:27:08', NULL),
(3, '', 'Recruiter', '2020-08-10', '::1', '23:59:16', NULL),
(4, '', 'Recruiter', '2020-08-10', '::1', '23:59:28', NULL),
(5, '', 'Recruiter', '2020-08-10', '::1', '23:59:48', NULL),
(6, '', 'Intreviewer', '2020-08-11', '::1', '00:00:21', NULL),
(7, '', 'Intreviewer', '2020-08-11', '::1', '00:01:24', NULL),
(8, '', 'Recruiter', '2020-08-11', '::1', '00:03:00', NULL),
(9, '', 'Intreviewer', '2020-08-11', '::1', '01:04:05', NULL),
(10, '', 'Intreviewer', '2020-08-11', '::1', '01:14:41', NULL),
(11, '', 'Intreviewer', '2020-08-11', '49.249.229.10', '19:44:35', NULL),
(12, '', 'Recruiter', '2020-08-11', '49.249.229.10', '19:48:15', NULL),
(13, '', 'Intreviewer', '2020-08-11', '49.249.229.10', '19:50:13', NULL),
(14, '', 'Recruiter', '2020-08-12', '::1', '11:32:54', NULL),
(15, '', 'Recruiter', '2020-08-12', '::1', '12:29:52', NULL),
(16, '', 'Recruiter', '2020-08-12', '192.168.201.109', '14:25:53', NULL),
(17, '', 'Intreviewer', '2020-08-12', '192.168.201.109', '14:27:58', NULL),
(18, '', 'Recruiter', '2020-08-12', '192.168.201.109', '14:31:27', NULL),
(19, '', 'Recruiter', '2020-08-12', '49.249.229.10', '18:45:33', NULL),
(20, '', 'Intreviewer', '2020-08-12', '49.249.229.10', '18:50:07', NULL),
(21, '', 'Intreviewer', '2020-08-13', '::1', '11:49:55', NULL),
(22, '', 'Recruiter', '2020-08-13', '::1', '12:03:18', NULL),
(23, '', 'intreviewer', '2020-08-17', '::1', '11:13:10', NULL),
(24, '', 'Recruiter', '2020-08-17', '::1', '11:15:39', NULL),
(25, '', 'Recruiter', '2020-08-17', '49.249.229.10', '11:49:40', NULL),
(26, '', 'admin', '2020-08-17', '::1', '13:08:05', NULL),
(27, '', 'candidate', '2020-08-17', '::1', '13:09:35', NULL),
(28, '', 'admin', '2020-08-17', '::1', '15:38:27', NULL),
(29, '', 'admin', '2020-08-17', '192.168.201.109', '19:18:45', NULL),
(30, '', 'admin', '2020-08-18', '192.168.201.109', '10:21:34', NULL),
(31, '', 'Recruiter', '2020-08-18', '192.168.201.109', '10:33:33', NULL),
(32, '', 'candidate', '2020-08-18', '192.168.201.109', '10:35:12', NULL),
(33, '', 'Recruiter', '2020-08-18', '192.168.201.109', '10:36:06', NULL),
(34, '', 'admin', '2020-08-18', '::1', '11:43:47', NULL),
(35, '', 'admin', '2020-08-18', '192.168.201.109', '12:16:14', NULL),
(36, '', 'Recruiter', '2020-08-18', '::1', '12:47:03', NULL),
(37, '', 'Recruiter', '2020-08-18', '192.168.201.109', '13:00:58', NULL),
(38, '', 'Recruiter', '2020-08-19', '192.168.201.109', '09:34:38', NULL),
(39, '', 'candidate', '2020-08-19', '::1', '14:54:51', NULL),
(40, '', 'Recruiter', '2020-08-19', '::1', '14:55:32', NULL),
(41, '', 'Recruiter', '2020-08-19', '::1', '18:47:38', NULL),
(42, '', 'Recruiter', '2020-08-21', '::1', '09:23:08', NULL),
(43, '', 'technical', '2020-08-22', '49.249.229.10', '11:24:59', NULL),
(44, '', 'admin', '2020-08-22', '49.249.229.10', '11:25:16', NULL),
(45, '', 'Recruiter', '2020-08-22', '::1', '11:39:13', NULL),
(46, '', 'technical', '2020-08-22', '::1', '20:56:51', NULL),
(47, '', 'Recruiter', '2020-08-22', '::1', '21:07:55', NULL),
(48, '', 'technical', '2020-08-22', '::1', '21:09:03', NULL),
(49, '', 'admin', '2020-08-24', '::1', '14:31:23', NULL),
(50, '', 'candidate', '2020-08-24', '::1', '14:31:58', NULL),
(51, '', 'Recruiter', '2020-08-24', '::1', '14:34:36', NULL),
(52, '', 'technical', '2020-08-24', '::1', '14:37:47', NULL),
(53, '', 'admin', '2020-08-24', '::1', '14:39:00', NULL),
(54, '', 'technical', '2020-08-24', '::1', '16:46:14', NULL),
(55, '', 'Recruiter', '2020-08-24', '::1', '17:01:03', NULL),
(56, '', 'md', '2020-08-26', '::1', '08:21:37', NULL),
(57, '', 'technical', '2020-08-26', '::1', '08:30:44', NULL),
(58, '', 'md', '2020-08-26', '::1', '08:32:23', NULL),
(59, '', 'admin', '2020-08-27', '::1', '10:32:04', NULL),
(60, '', 'md', '2020-08-27', '::1', '11:36:32', NULL),
(61, '', 'admin', '2020-08-27', '::1', '11:38:02', NULL),
(62, '', 'md', '2020-08-27', '::1', '12:54:31', NULL),
(63, '', 'admin', '2020-08-27', '::1', '13:08:13', NULL),
(64, '', 'technical', '2020-08-27', '::1', '13:22:55', NULL),
(65, '', 'admin', '2020-08-27', '::1', '13:30:16', NULL),
(66, '', 'md', '2020-08-27', '::1', '14:20:35', NULL),
(67, '', 'technical', '2020-08-27', '::1', '14:29:48', NULL),
(68, '', 'admin', '2020-08-27', '::1', '14:30:24', NULL),
(69, '', 'md', '2020-08-27', '::1', '14:32:39', NULL),
(70, '', 'admin', '2020-08-28', '49.249.229.10', '11:31:36', NULL),
(71, '', 'technical', '2020-08-31', '49.249.229.10', '21:11:44', NULL),
(72, '', 'admin', '2020-08-31', '49.249.229.10', '21:12:32', NULL),
(73, '', 'admin', '2020-09-01', '::1', '21:03:44', NULL),
(74, '', 'technical', '2020-09-01', '::1', '21:05:06', NULL),
(75, '', 'admin', '2020-09-01', '::1', '21:06:22', NULL),
(76, '', 'candidate', '2020-09-02', '::1', '13:32:16', NULL),
(77, '', 'candidate', '2020-09-02', '::1', '15:43:15', NULL),
(78, '', 'Recruiter', '2020-09-02', '::1', '15:44:31', NULL),
(79, '', 'candidate', '2020-09-02', '::1', '17:07:52', NULL),
(80, '', 'Recruiter', '2020-09-02', '::1', '17:21:44', NULL),
(81, '', 'technical', '2020-09-02', '::1', '17:22:32', NULL),
(82, '', 'Recruiter', '2020-09-02', '::1', '17:26:31', NULL),
(83, '', 'candidate', '2020-09-02', '::1', '17:48:06', NULL),
(84, '', 'admin', '2020-09-03', '192.168.200.53', '10:49:49', NULL),
(85, '', 'admin', '2020-09-03', '::1', '11:53:55', NULL),
(86, '', 'admin', '2020-09-03', '::1', '11:55:15', NULL),
(87, '', 'Recruiter', '2020-09-03', '::1', '11:59:49', NULL),
(88, '', 'candidate', '2020-09-03', '::1', '12:00:39', NULL),
(89, '', 'admin', '2020-09-03', '::1', '15:38:39', NULL),
(90, '', 'admin', '2020-09-05', '::1', '10:21:15', NULL),
(91, '', 'admin', '2020-09-05', '49.249.229.10', '15:22:26', NULL),
(92, '', 'admin', '2020-09-05', '::1', '15:32:42', NULL),
(93, '', 'admin', '2020-09-07', '49.249.229.10', '12:09:52', NULL),
(94, '', 'Recruiter', '2020-09-07', '::1', '20:40:09', NULL),
(95, '', 'admin', '2020-09-07', '::1', '20:40:53', NULL),
(96, '', 'admin', '2020-09-08', '49.249.229.10', '10:41:25', NULL),
(97, '', 'admin', '2020-09-08', '49.249.229.10', '10:45:07', NULL),
(98, '', 'technical', '2020-09-08', '49.249.229.10', '10:45:53', NULL),
(99, '', 'admin', '2020-09-08', '49.249.229.10', '10:46:27', NULL),
(100, '', 'admin', '2020-09-08', '49.249.229.10', '10:58:14', NULL),
(101, '', 'admin', '2020-09-08', '49.249.229.10', '15:17:46', NULL),
(102, '', 'admin', '2020-09-08', '49.249.229.10', '16:39:24', NULL),
(103, '', 'admin', '2020-09-09', '49.249.229.10', '08:59:22', NULL),
(104, '', 'admin', '2020-09-09', '192.168.201.188', '10:49:08', NULL),
(105, '', 'admin', '2020-09-09', '49.249.229.10', '12:35:42', NULL),
(106, '', 'admin', '2020-09-09', '192.168.201.188', '17:00:09', NULL),
(107, '', 'admin', '2020-09-09', '49.249.229.10', '21:37:52', NULL),
(108, '', 'admin', '2020-09-10', '192.168.201.109', '12:02:12', NULL),
(109, '', 'admin', '2020-09-11', '49.249.229.10', '08:22:06', NULL),
(110, '', 'Recruiter', '2020-09-13', '::1', '10:04:44', NULL),
(111, '', 'candidate', '2020-09-13', '::1', '10:05:20', NULL),
(112, '', 'admin', '2020-09-13', '::1', '10:06:58', NULL),
(113, '', 'admin', '2020-09-13', '::1', '10:50:13', NULL),
(114, '', 'candidate', '2020-09-13', '::1', '12:04:57', NULL),
(115, '', 'candidate', '2020-09-13', '::1', '12:05:37', NULL),
(116, '', 'Recruiter', '2020-09-13', '::1', '12:06:29', NULL),
(117, '', 'md', '2020-09-13', '::1', '12:07:02', NULL),
(118, '', 'admin', '2020-09-13', '::1', '13:15:23', NULL),
(119, '', 'admin', '2020-09-15', '::1', '19:57:48', NULL),
(120, '', 'Recruiter', '2020-09-15', '::1', '19:58:05', NULL),
(121, '', 'admin', '2020-09-16', '49.249.229.10', '09:35:25', NULL),
(122, '', 'Recruiter', '2020-09-16', '49.249.229.10', '10:50:03', NULL),
(123, '', 'admin', '2020-09-16', '49.249.229.10', '15:35:34', NULL),
(124, '', 'Recruiter', '2020-09-16', '49.249.229.10', '16:04:36', NULL),
(125, '', 'technical', '2020-09-16', '49.249.229.10', '16:06:25', NULL),
(126, '', 'technical', '2020-09-16', '::1', '16:14:14', NULL),
(127, '', 'admin', '2020-09-16', '::1', '21:15:06', NULL),
(128, '', 'admin', '2020-09-17', '49.249.229.10', '10:18:08', NULL),
(129, '', 'admin', '2020-09-18', '192.168.201.170', '14:41:51', NULL),
(130, '', 'admin', '2020-09-18', '192.168.201.170', '14:42:55', NULL),
(131, '', 'admin', '2020-09-18', '192.168.201.180', '14:44:57', NULL),
(132, '', 'admin', '2020-09-18', '49.249.229.10', '16:10:48', NULL),
(133, '', 'admin', '2020-09-18', '49.249.229.10', '16:34:40', NULL),
(134, '', 'technical', '2020-09-18', '49.249.229.10', '16:39:25', NULL),
(135, '', 'admin', '2020-09-19', '::1', '06:32:28', NULL),
(136, '', 'admin', '2020-09-19', '::1', '09:27:33', NULL),
(137, '', 'technical', '2020-09-19', '::1', '09:27:56', NULL),
(138, '', 'md', '2020-09-19', '::1', '20:24:54', NULL),
(139, '', 'candidate', '2020-10-20', '::1', '12:45:45', NULL),
(140, '', 'candidate', '2020-11-03', '::1', '12:10:01', NULL),
(141, '', 'admin', '2020-11-03', '::1', '13:14:53', NULL),
(142, '', 'candidate', '2020-11-03', '::1', '16:00:48', NULL),
(143, '', 'admin', '2020-11-04', '::1', '11:31:30', NULL),
(144, '', 'admin', '2020-11-05', '10.225.1.78', '11:26:54', NULL),
(145, '', 'admin', '2020-11-07', '10.225.1.78', '11:54:53', NULL),
(146, '', 'admin', '2020-11-07', '10.225.1.78', '18:47:43', NULL),
(147, '', 'candidate', '2020-11-07', '10.225.1.78', '18:48:41', NULL),
(148, '', 'admin', '2020-11-09', '10.225.1.78', '09:50:39', NULL),
(149, '', 'admin', '2020-11-09', '10.225.1.78', '10:42:16', NULL),
(150, '', 'admin', '2020-11-09', '10.225.1.78', '17:36:32', NULL),
(151, '', 'candidate', '2020-11-11', '192.168.200.114', '14:12:48', NULL),
(152, '', 'admin', '2020-11-11', '192.168.200.114', '14:18:24', NULL),
(153, '', 'candidate', '2020-11-11', '192.168.200.114', '14:21:11', NULL),
(154, '', 'candidate', '2020-11-11', '192.168.200.114', '14:24:06', NULL),
(155, '', 'admin', '2020-11-11', '192.168.200.114', '14:25:31', NULL),
(156, '', 'candidate', '2020-11-11', '192.168.200.114', '15:14:30', NULL),
(157, '', 'candidate', '2020-11-11', '192.168.200.114', '15:20:26', NULL),
(158, '', 'admin', '2020-11-11', '192.168.200.114', '15:21:00', NULL),
(159, '', 'admin', '2020-11-12', '192.168.200.114', '10:19:21', NULL),
(160, '', 'Recruiter', '2020-11-12', '192.168.200.114', '10:22:00', NULL),
(161, '', 'admin', '2020-11-14', '10.225.1.78', '09:45:40', NULL),
(162, '', 'candidate', '2020-11-14', '10.225.1.78', '09:51:38', NULL),
(163, '', 'admin', '2020-11-14', '10.225.1.78', '09:52:55', NULL),
(164, '', 'Recruiter', '2020-11-14', '10.225.1.78', '09:57:34', NULL),
(165, '', 'admin', '2020-11-17', '192.168.200.114', '09:20:15', NULL),
(166, '', 'Recruiter', '2020-11-17', '192.168.200.114', '14:18:20', NULL),
(167, '', 'admin', '2020-11-17', '192.168.200.114', '14:38:08', NULL),
(168, '', 'Recruiter', '2020-11-17', '10.225.1.78', '16:32:34', NULL),
(169, '', 'admin', '2020-11-17', '10.225.1.78', '16:39:45', NULL),
(170, '', 'Recruiter', '2020-11-17', '10.225.1.78', '16:49:53', NULL),
(171, '', 'Recruiter', '2020-11-17', '192.168.200.114', '16:51:30', NULL),
(172, '', 'technical', '2020-11-18', '192.168.200.114', '09:34:25', NULL),
(173, '', 'admin', '2020-11-18', '192.168.200.16', '09:53:10', NULL),
(174, '', 'candidate', '2020-11-18', '192.168.200.16', '10:04:34', NULL),
(175, '', 'admin', '2020-11-18', '192.168.200.16', '10:06:10', NULL),
(176, '', 'candidate', '2020-11-18', '192.168.200.16', '10:07:55', NULL),
(177, '', 'admin', '2020-11-18', '192.168.200.16', '10:08:56', NULL),
(178, '', 'candidate', '2020-11-18', '192.168.200.16', '10:16:18', NULL),
(179, '', 'admin', '2020-11-18', '192.168.200.16', '10:34:38', NULL),
(180, '', 'admin', '2020-11-18', '192.168.200.114', '10:39:33', NULL),
(181, '', 'candidate', '2020-11-18', '192.168.200.114', '10:40:11', NULL),
(182, '', 'md', '2020-11-18', '192.168.200.16', '10:41:39', NULL),
(183, '', 'technical', '2020-11-18', '192.168.200.16', '10:42:18', NULL),
(184, '', 'candidate', '2020-11-18', '192.168.200.16', '10:45:26', NULL),
(185, '', 'admin', '2020-11-18', '192.168.200.16', '10:57:06', NULL),
(186, '', 'technical', '2020-11-18', '192.168.200.114', '11:16:36', NULL),
(187, '', 'Recruiter', '2020-11-18', '192.168.200.114', '11:17:15', NULL),
(188, '', 'Recruiter', '2020-11-18', '192.168.200.114', '11:33:21', NULL),
(189, '', 'technical', '2020-11-19', '192.168.200.16', '09:08:56', NULL),
(190, '', 'admin', '2020-11-19', '192.168.200.16', '09:12:13', NULL),
(191, '', 'Recruiter', '2020-11-19', '192.168.200.114', '09:25:36', NULL),
(192, '', 'Recruiter', '2020-11-19', '10.225.1.78', '10:04:54', NULL),
(193, '', 'admin', '2020-11-19', '192.168.200.114', '11:32:35', NULL),
(194, '', 'technical', '2020-11-19', '192.168.200.114', '11:36:59', NULL),
(195, '', 'Recruiter', '2020-11-19', '192.168.200.114', '11:37:51', NULL),
(196, '', 'admin', '2020-11-19', '192.168.200.114', '11:39:06', NULL),
(197, '', 'Recruiter', '2020-11-19', '192.168.200.114', '11:41:05', NULL),
(198, '', 'Recruiter', '2020-11-19', '192.168.200.114', '11:45:18', NULL),
(199, '', 'technical', '2020-11-19', '192.168.200.114', '11:57:04', NULL),
(200, '', 'Recruiter', '2020-11-19', '192.168.200.114', '11:57:48', NULL),
(201, '', 'technical', '2020-11-19', '192.168.200.114', '14:00:31', NULL),
(202, '', 'candidate', '2020-11-19', '10.225.1.78', '15:12:13', NULL),
(203, '', 'technical', '2020-11-19', '192.168.200.16', '15:44:31', NULL),
(204, '', 'Recruiter', '2020-11-19', '10.225.1.78', '16:45:15', NULL),
(205, '', 'Recruiter', '2020-11-19', '192.168.200.114', '16:48:16', NULL),
(206, '', 'candidate', '2020-11-19', '10.225.1.78', '16:54:02', NULL),
(207, '', 'candidate', '2020-11-19', '10.225.1.78', '17:13:29', NULL),
(208, '', 'candidate', '2020-11-19', '10.225.1.78', '17:32:42', NULL),
(209, '', 'candidate', '2020-11-19', '192.168.200.16', '17:34:46', NULL),
(210, '', 'technical', '2020-11-19', '192.168.200.114', '17:35:08', NULL),
(211, '', 'Recruiter', '2020-11-19', '10.225.1.78', '17:52:09', NULL),
(212, '', 'technical', '2020-11-19', '10.225.1.78', '17:52:37', NULL),
(213, '', 'candidate', '2020-11-19', '::1', '18:03:48', NULL),
(214, '', 'candidate', '2020-11-19', '::1', '18:45:54', NULL),
(215, '', 'candidate', '2020-11-19', '::1', '20:32:10', NULL),
(216, '', 'balachandar', '2020-11-19', '::1', '20:36:35', NULL),
(217, '', 'candidate', '2020-11-19', '::1', '20:37:44', NULL),
(218, '', 'candidate', '2020-11-19', '::1', '20:43:50', NULL),
(219, '', 'candidate', '2020-11-19', '10.225.1.78', '20:46:20', NULL),
(220, '', 'bala', '2020-11-19', '10.225.1.78', '20:47:05', NULL),
(221, '', 'candidate', '2020-11-20', '192.168.200.16', '09:10:29', NULL),
(222, '', 'admin', '2020-11-20', '192.168.200.16', '09:13:37', NULL),
(223, '', 'Laxmi Priya', '2020-11-20', '192.168.200.16', '09:13:58', NULL),
(224, '', 'admin', '2020-11-20', '192.168.200.16', '09:16:12', NULL),
(225, '', 'Recruiter', '2020-11-20', '192.168.200.114', '09:16:44', NULL),
(226, '', 'technical', '2020-11-20', '192.168.200.114', '09:18:12', NULL),
(227, '', 'technical', '2020-11-20', '192.168.200.114', '11:07:25', NULL),
(228, '', 'Recruiter', '2020-11-20', '192.168.200.114', '11:19:55', NULL),
(229, '', 'candidate', '2020-11-20', '::1', '11:57:00', NULL),
(230, '', 'candidate', '2020-11-20', '192.168.200.16', '12:14:40', NULL),
(231, '', 'Laxmi Priya', '2020-11-20', '192.168.200.16', '12:15:54', NULL),
(232, '', 'Laxmi Priya', '2020-11-20', '192.168.200.16', '12:16:18', NULL),
(233, '', 'candidate', '2020-11-20', '::1', '12:17:34', NULL),
(234, '', 'balachandar', '2020-11-20', '::1', '12:18:57', NULL),
(235, '', 'candidate', '2020-11-20', '::1', '12:36:56', NULL),
(236, '', 'balachandar', '2020-11-20', '::1', '13:13:51', NULL),
(237, '', 'balachandar', '2020-11-20', '::1', '13:13:52', NULL),
(238, '', 'candidate', '2020-11-20', '::1', '13:24:15', NULL),
(239, '', 'balachandar', '2020-11-20', '::1', '13:27:16', NULL),
(240, '', 'admin', '2020-11-20', '192.168.200.16', '14:14:10', NULL),
(241, '', 'Recruiter', '2020-11-20', '192.168.200.16', '14:17:58', NULL),
(242, '', 'Recruiter', '2020-11-20', '192.168.200.114', '15:06:25', NULL),
(243, '', 'admin', '2020-11-20', '192.168.200.16', '15:55:22', NULL),
(244, '', 'admin', '2020-11-20', '::1', '16:12:46', NULL),
(245, '', 'Recruiter', '2020-11-20', '::1', '16:49:35', NULL),
(246, '', 'candidate', '2020-11-20', '::1', '16:50:50', NULL),
(247, '', 'bala ', '2020-11-20', '::1', '16:52:58', NULL),
(248, '', 'admin', '2020-11-20', '::1', '16:53:49', NULL),
(249, '', 'Recruiter', '2020-11-20', '::1', '16:54:19', NULL),
(250, '', 'admin', '2020-11-21', '192.168.200.16', '09:14:50', NULL),
(251, '', 'Recruiter', '2020-11-21', '192.168.200.16', '09:15:49', NULL),
(252, '', 'admin', '2020-11-21', '192.168.200.114', '09:23:51', NULL),
(253, '', 'technical', '2020-11-21', '192.168.200.114', '09:38:08', NULL),
(254, '', 'md', '2020-11-21', '192.168.200.114', '09:40:04', NULL),
(255, '', 'Recruiter', '2020-11-21', '192.168.200.114', '10:04:18', NULL),
(256, '', 'Recruiter', '2020-11-21', '192.168.200.114', '10:31:43', NULL),
(257, '', 'md', '2020-11-21', '192.168.200.114', '10:42:33', NULL),
(258, '', 'Recruiter', '2020-11-21', '10.225.1.78', '12:37:23', NULL),
(259, '', 'Recruiter', '2020-11-21', '192.168.200.114', '12:37:57', NULL),
(260, '', 'Recruiter', '2020-11-21', '192.168.200.114', '14:10:35', NULL),
(261, '', 'technical', '2020-11-23', '192.168.200.16', '09:18:34', NULL),
(262, '', 'admin', '2020-11-23', '192.168.200.16', '09:18:56', NULL),
(263, '', 'technical', '2020-11-23', '192.168.200.16', '09:21:55', NULL),
(264, '', 'Recruiter', '2020-11-23', '192.168.200.16', '10:09:32', NULL),
(265, '', 'Recruiter', '2020-11-23', '192.168.200.47', '10:24:12', NULL),
(266, '', 'candidate', '2020-11-23', '10.225.1.78', '10:46:10', NULL),
(267, '', 'Gopinath', '2020-11-23', '10.225.1.78', '10:53:43', NULL),
(268, '', 'Gopinath', '2020-11-23', '10.225.1.78', '10:58:06', NULL),
(269, '', 'Gopinath', '2020-11-23', '10.225.1.78', '11:05:04', NULL),
(270, '', 'admin', '2020-11-23', '10.225.1.78', '11:20:12', NULL),
(271, '', 'Recruiter', '2020-11-23', '10.225.1.78', '11:20:56', NULL),
(272, '', 'admin', '2020-11-23', '10.225.1.78', '11:33:16', NULL),
(273, '', 'Recruiter', '2020-11-23', '10.225.1.78', '11:36:02', NULL),
(274, '', 'Recruiter', '2020-11-23', '10.225.1.78', '12:08:14', NULL),
(275, '', 'Recruiter', '2020-11-23', '192.168.200.16', '12:52:01', NULL),
(276, '', 'technical', '2020-11-23', '192.168.200.47', '14:05:16', NULL),
(277, '', 'admin', '2020-11-23', '192.168.200.16', '15:36:19', NULL),
(278, '', 'Recruiter', '2020-11-23', '192.168.200.47', '15:49:36', NULL),
(279, '', 'Recruiter', '2020-11-23', '192.168.200.16', '15:56:52', NULL),
(280, '', 'admin', '2020-11-23', '192.168.200.16', '16:02:52', NULL),
(281, '', 'Recruiter', '2020-11-23', '192.168.200.16', '16:03:52', NULL),
(282, '', 'Recruiter', '2020-11-23', '192.168.200.16', '16:07:03', NULL),
(283, '', 'technical', '2020-11-23', '10.225.1.78', '17:06:43', NULL),
(284, '', 'md', '2020-11-23', '10.225.1.78', '17:07:18', NULL),
(285, '', 'admin', '2020-11-23', '10.225.1.78', '17:07:41', NULL),
(286, '', 'admin', '2020-11-23', '::1', '17:15:11', NULL),
(287, '', 'md', '2020-11-23', '192.168.200.47', '17:52:51', NULL),
(288, '', 'md', '2020-11-23', '10.225.1.78', '17:58:27', NULL),
(289, '', 'md', '2020-11-24', '192.168.200.47', '10:15:43', NULL),
(290, '', 'admin', '2020-11-24', '192.168.200.16', '10:45:22', NULL),
(291, '', 'md', '2020-11-24', '10.225.1.78', '12:05:33', NULL),
(292, '', 'admin', '2020-11-25', '10.225.1.78', '12:22:59', NULL),
(293, '', 'md', '2020-11-27', '192.168.200.114', '09:03:49', NULL),
(294, '', 'admin', '2020-11-27', '192.168.200.16', '09:17:39', NULL),
(295, '', 'md', '2020-11-27', '192.168.200.47', '09:41:48', NULL),
(296, '', 'md', '2020-11-27', '192.168.200.47', '10:31:48', NULL),
(297, '', 'Recruiter', '2020-11-27', '192.168.200.16', '11:06:12', NULL),
(298, '', 'technical', '2020-11-27', '192.168.200.47', '11:22:18', NULL),
(299, '', 'Recruiter', '2020-11-27', '192.168.200.47', '11:32:12', NULL),
(300, '', 'technical', '2020-11-27', '192.168.200.47', '11:47:52', NULL),
(301, '', 'admin', '2021-02-16', '192.168.201.12', '09:57:23', NULL),
(302, '', 'admin', '2021-02-16', '192.168.201.15', '10:06:40', NULL),
(303, '', 'admin', '2021-02-16', '192.168.201.12', '10:30:13', NULL),
(304, '', 'admin', '2021-02-17', '192.168.201.12', '09:59:56', NULL),
(305, '', 'admin', '2021-02-17', '192.168.201.15', '10:09:15', NULL),
(306, '', 'admin', '2021-02-20', '192.168.201.17', '10:30:57', NULL),
(307, '', 'candidate', '2021-02-20', '192.168.201.17', '10:33:22', NULL),
(308, '', 'Gopinath', '2021-02-20', '192.168.201.17', '10:34:11', NULL),
(309, '', 'Gopinath', '2021-02-20', '192.168.201.17', '10:36:35', NULL),
(310, '', 'Recruiter', '2021-02-20', '192.168.201.17', '10:41:42', NULL),
(311, '', 'technical', '2021-02-20', '192.168.201.17', '10:42:40', NULL),
(312, '', 'md', '2021-02-20', '192.168.201.17', '10:43:31', NULL),
(313, '', 'admin', '2021-02-20', '192.168.201.176', '12:03:35', NULL),
(314, '', 'admin', '2021-02-20', '192.168.201.176', '12:06:49', NULL),
(315, '', 'candidate', '2021-02-20', '192.168.201.176', '12:11:20', NULL),
(316, '', 'Gopinath', '2021-02-20', '192.168.201.176', '12:12:46', NULL),
(317, '', 'Recruiter', '2021-02-20', '192.168.201.176', '12:13:46', NULL),
(318, '', 'admin', '2021-02-20', '192.168.201.17', '16:24:53', NULL),
(319, '', 'admin', '2021-02-20', '192.168.201.17', '16:26:26', NULL),
(320, '', 'candidate', '2021-02-20', '192.168.201.17', '16:27:40', NULL),
(321, '', 'aishwaria', '2021-02-20', '192.168.201.17', '16:29:36', NULL),
(322, '', 'Recruiter', '2021-02-20', '192.168.201.17', '16:31:51', NULL),
(323, '', 'admin', '2021-02-20', '192.168.201.17', '16:32:43', NULL),
(324, '', 'Recruiter', '2021-02-20', '192.168.201.17', '16:33:27', NULL),
(325, '', 'technical', '2021-02-20', '192.168.201.17', '16:36:13', NULL),
(326, '', 'md', '2021-02-20', '192.168.201.17', '16:39:04', NULL),
(327, '', 'admin', '2021-02-20', '192.168.201.17', '16:46:57', NULL),
(328, '', 'candidate', '2021-02-20', '192.168.201.17', '17:00:18', NULL),
(329, '', 'aishwaria', '2021-02-20', '192.168.201.17', '17:02:23', NULL),
(330, '', 'admin', '2021-02-20', '192.168.201.17', '17:03:32', NULL),
(331, '', 'admin', '2021-02-20', '192.168.201.176', '17:04:44', NULL),
(332, '', 'Recruiter', '2021-02-20', '192.168.201.17', '17:08:02', NULL),
(333, '', 'Recruiter', '2021-02-20', '192.168.201.176', '17:08:10', NULL),
(334, '', 'technical', '2021-02-20', '192.168.201.17', '17:10:21', NULL),
(335, '', 'technical', '2021-02-20', '192.168.201.176', '17:10:48', NULL),
(336, '', 'md', '2021-02-20', '192.168.201.17', '17:11:06', NULL),
(337, '', 'candidate', '2021-02-20', '192.168.201.176', '17:15:21', NULL),
(338, '', 'aishwaria', '2021-02-20', '192.168.201.176', '17:16:54', NULL),
(339, '', 'admin', '2021-02-20', '192.168.201.176', '17:17:59', NULL),
(340, '', 'Recruiter', '2021-02-20', '192.168.201.176', '17:18:55', NULL),
(341, '', 'technical', '2021-02-20', '192.168.201.17', '17:38:44', NULL),
(342, '', 'admin', '2021-02-22', '192.168.201.176', '09:22:13', NULL),
(343, '', 'candidate', '2021-02-22', '192.168.201.176', '09:34:16', NULL),
(344, '', 'Ishwarya', '2021-02-22', '192.168.201.176', '09:41:26', NULL),
(345, '', 'admin', '2021-02-22', '192.168.201.176', '09:50:37', NULL),
(346, '', 'admin', '2021-02-22', '192.168.201.10', '11:06:13', NULL),
(347, '', 'candidate', '2021-02-22', '192.168.201.10', '11:08:34', NULL),
(348, '', 'sakthi', '2021-02-22', '192.168.201.10', '11:12:18', NULL),
(349, '', 'Recruiter', '2021-02-22', '192.168.201.10', '11:15:58', NULL),
(350, '', 'admin', '2021-02-22', '192.168.201.10', '11:17:07', NULL),
(351, '', 'Recruiter', '2021-02-22', '192.168.201.10', '11:22:54', NULL),
(352, '', 'admin', '2021-02-22', '192.168.201.15', '11:24:41', NULL),
(353, '', 'candidate', '2021-02-22', '192.168.201.15', '11:25:30', NULL),
(354, '', 'admin', '2021-02-22', '192.168.201.15', '11:27:37', NULL),
(355, '', 'admin', '2021-02-22', '192.168.201.15', '11:28:40', NULL),
(356, '', 'technical', '2021-02-22', '192.168.201.10', '11:28:49', NULL),
(357, '', 'Recruiter', '2021-02-22', '192.168.201.15', '11:30:56', NULL),
(358, '', 'technical', '2021-02-22', '192.168.201.15', '11:31:48', NULL),
(359, '', 'md', '2021-02-22', '192.168.201.15', '11:32:32', NULL),
(360, '', 'aishwaria', '2021-02-22', '192.168.201.15', '11:33:05', NULL),
(361, '', 'md', '2021-02-22', '192.168.201.10', '11:33:18', NULL),
(362, '', 'aishwaria', '2021-02-22', '192.168.201.15', '11:33:43', NULL),
(363, '', 'admin', '2021-02-22', '192.168.201.10', '11:33:51', NULL),
(364, '', 'aishwaria', '2021-02-22', '192.168.201.15', '11:38:05', NULL),
(365, '', 'candidate', '2021-02-22', '192.168.201.15', '11:41:15', NULL),
(366, '', 'Recruiter', '2021-02-22', '192.168.201.15', '11:41:50', NULL),
(367, '', 'aishwaria', '2021-02-22', '192.168.201.15', '11:47:51', NULL),
(368, '', 'aishwaria', '2021-02-22', '192.168.201.15', '11:51:06', NULL),
(369, '', 'aishwaria', '2021-02-22', '192.168.201.15', '11:53:12', NULL),
(370, '', 'admin', '2021-02-22', '192.168.201.176', '11:58:43', NULL),
(371, '', 'aishwaria', '2021-02-22', '192.168.201.15', '12:13:01', NULL),
(372, '', 'aishwaria', '2021-02-22', '192.168.201.15', '12:13:56', NULL),
(373, '', 'aishwaria', '2021-02-22', '192.168.201.15', '12:14:49', NULL),
(374, '', 'aishwaria', '2021-02-22', '192.168.201.15', '12:20:47', NULL),
(375, '', 'Ishwarya', '2021-02-22', '192.168.201.15', '12:26:07', NULL),
(376, '', 'Ishwarya', '2021-02-22', '192.168.201.15', '12:33:42', NULL),
(377, '', 'Ishwarya', '2021-02-22', '192.168.201.15', '12:36:42', NULL),
(378, '', 'admin', '2021-02-22', '192.168.201.15', '12:40:26', NULL),
(379, '', 'admin', '2021-02-22', '192.168.201.12', '14:21:38', NULL),
(380, '', 'admin', '2021-02-22', '192.168.201.12', '14:59:03', NULL),
(381, '', 'Recruiter', '2021-02-22', '192.168.201.12', '15:17:12', NULL),
(382, '', 'admin', '2021-02-22', '192.168.201.12', '15:22:50', NULL),
(383, '', 'Recruiter', '2021-02-22', '192.168.201.12', '15:32:47', NULL),
(384, '', 'admin', '2021-02-22', '192.168.201.12', '15:34:52', NULL),
(385, '', 'technical', '2021-02-22', '192.168.201.12', '15:59:30', NULL),
(386, '', 'md', '2021-02-22', '192.168.201.12', '16:03:37', NULL),
(387, '', 'md', '2021-02-22', '192.168.201.12', '16:04:12', NULL),
(388, '', 'technical', '2021-02-22', '192.168.201.12', '16:06:05', NULL),
(389, '', 'md', '2021-02-22', '192.168.201.12', '16:13:01', NULL),
(390, '', 'technical', '2021-02-22', '192.168.201.12', '16:30:20', NULL),
(391, '', 'Gopinath', '2021-02-22', '192.168.201.12', '16:38:11', NULL),
(392, '', 'admin', '2021-02-22', '192.168.201.12', '16:38:59', NULL),
(393, '', 'admin', '2021-02-22', '192.168.201.12', '16:56:34', NULL),
(394, '', 'aishwaria', '2021-02-22', '192.168.201.12', '17:10:07', NULL),
(395, '', 'admin', '2021-02-22', '192.168.201.12', '17:18:12', NULL),
(396, '', 'technical', '2021-02-22', '192.168.201.12', '17:25:12', NULL),
(397, '', 'admin', '2021-02-22', '192.168.201.12', '17:32:39', NULL),
(398, '', 'admin', '2021-02-24', '192.168.201.12', '11:59:43', NULL),
(399, '', 'admin', '2021-02-24', '192.168.201.12', '12:00:45', NULL),
(400, '', 'candidate', '2021-02-24', '192.168.201.12', '12:02:01', NULL),
(401, '', 'Recruiter', '2021-02-24', '192.168.201.12', '12:29:56', NULL),
(402, '', 'Abinaya', '2021-02-24', '192.168.201.12', '12:47:11', NULL),
(403, '', 'admin', '2021-02-24', '192.168.201.12', '12:53:03', NULL),
(404, '', 'technical', '2021-02-24', '192.168.201.12', '13:00:20', NULL),
(405, '', 'md', '2021-02-24', '192.168.201.12', '13:01:52', NULL),
(406, '', 'md', '2021-02-24', '192.168.201.12', '13:22:43', NULL),
(407, '', 'admin', '2021-02-24', '192.168.201.12', '14:18:31', NULL),
(408, '', 'admin', '2021-02-24', '192.168.201.12', '14:20:27', NULL),
(409, '', 'Recruiter', '2021-02-24', '192.168.201.12', '14:21:47', NULL),
(410, '', 'Recruiter', '2021-02-24', '192.168.201.12', '14:31:10', NULL),
(411, '', 'technical', '2021-02-24', '192.168.201.12', '14:31:32', NULL),
(412, '', 'md', '2021-02-24', '192.168.201.12', '14:33:36', NULL),
(413, '', 'admin', '2021-02-24', '192.168.201.12', '14:38:39', NULL),
(414, '', 'Recruiter', '2021-02-24', '192.168.201.12', '15:49:20', NULL),
(415, '', 'technical', '2021-02-24', '192.168.201.12', '15:52:55', NULL),
(416, '', 'md', '2021-02-24', '192.168.201.12', '15:54:17', NULL),
(417, '', 'candidate', '2021-02-24', '192.168.201.161', '16:14:01', NULL),
(418, '', 'candidate', '2021-02-24', '192.168.201.161', '16:15:10', NULL),
(419, '', 'Abinaya', '2021-02-24', '192.168.201.161', '16:17:25', NULL),
(420, '', 'admin', '2021-02-24', '192.168.201.161', '16:18:22', NULL),
(421, '', 'Recruiter', '2021-02-24', '192.168.201.161', '16:25:09', NULL),
(422, '', 'technical', '2021-02-24', '192.168.201.161', '16:32:43', NULL),
(423, '', 'md', '2021-02-24', '192.168.201.161', '16:33:12', NULL),
(424, '', 'admin', '2021-02-24', '192.168.201.161', '16:33:47', NULL),
(425, '', 'admin', '2021-02-24', '192.168.201.12', '17:00:19', NULL),
(426, '', 'admin', '2021-02-25', '192.168.201.176', '10:21:32', NULL),
(427, '', 'Abinaya', '2021-02-25', '192.168.201.176', '10:36:13', NULL),
(428, '', 'admin', '2021-02-25', '192.168.201.176', '10:37:47', NULL),
(429, '', 'Ishwarya', '2021-02-25', '192.168.201.176', '11:20:45', NULL),
(430, '', 'admin', '2021-02-25', '192.168.201.176', '12:10:36', NULL),
(431, '', 'Recruiter', '2021-02-25', '192.168.201.176', '12:17:45', NULL),
(432, '', 'Recruiter', '2021-02-25', '192.168.201.176', '13:19:03', NULL),
(433, '', 'admin', '2021-02-25', '192.168.201.176', '13:20:31', NULL),
(434, '', 'admin', '2021-03-01', '192.168.201.15', '09:27:01', NULL),
(435, '', 'admin', '2021-03-01', '192.168.201.176', '09:30:37', NULL),
(436, '', 'technical', '2021-03-01', '192.168.201.15', '09:37:49', NULL),
(437, '', 'admin', '2021-03-01', '192.168.201.15', '10:06:36', NULL),
(438, '', 'hod', '2021-03-01', '192.168.201.15', '10:53:56', NULL),
(439, '', 'hod', '2021-03-01', '192.168.201.15', '11:15:25', NULL),
(440, '', 'technical', '2021-03-01', '192.168.201.15', '11:38:04', NULL),
(441, '', 'hod', '2021-03-01', '192.168.201.15', '11:49:29', NULL),
(442, '', 'md', '2021-03-01', '192.168.201.15', '11:49:59', NULL),
(443, '', 'hod', '2021-03-01', '192.168.201.15', '11:52:31', NULL),
(444, '', 'technical', '2021-03-01', '192.168.201.15', '11:55:20', NULL),
(445, '', 'md', '2021-03-01', '192.168.201.15', '11:57:55', NULL),
(446, '', 'hod', '2021-03-01', '192.168.201.15', '11:59:17', NULL),
(447, '', 'technical', '2021-03-01', '192.168.201.15', '12:10:48', NULL),
(448, '', 'md', '2021-03-01', '192.168.201.15', '12:11:33', NULL),
(449, '', 'hod', '2021-03-01', '192.168.201.15', '12:20:36', NULL),
(450, '', 'technical', '2021-03-01', '192.168.201.15', '12:40:29', NULL),
(451, '', 'hod', '2021-03-01', '192.168.201.15', '12:40:51', NULL),
(452, '', 'hod', '2021-03-01', '192.168.201.15', '12:43:04', NULL),
(453, '', 'hod', '2021-03-01', '192.168.201.15', '12:44:08', NULL),
(454, '', 'md', '2021-03-01', '192.168.201.15', '12:44:30', NULL),
(455, '', 'hod', '2021-03-01', '192.168.201.15', '12:49:51', NULL),
(456, '', 'hod', '2021-03-01', '192.168.201.15', '12:50:38', NULL),
(457, '', 'md', '2021-03-01', '192.168.201.15', '12:52:21', NULL),
(458, '', 'technical', '2021-03-01', '192.168.201.15', '13:05:27', NULL),
(459, '', 'hod', '2021-03-01', '192.168.201.15', '13:07:54', NULL),
(460, '', 'technical', '2021-03-01', '192.168.201.15', '13:18:17', NULL),
(461, '', 'hod', '2021-03-01', '192.168.201.15', '13:21:48', NULL),
(462, '', 'hod', '2021-03-01', '192.168.201.15', '13:28:07', NULL),
(463, '', 'hod', '2021-03-01', '192.168.201.15', '14:13:46', NULL),
(464, '', 'hod', '2021-03-01', '192.168.201.15', '14:14:58', NULL),
(465, '', 'hod', '2021-03-01', '192.168.201.15', '14:28:42', NULL),
(466, '', 'technical', '2021-03-01', '192.168.201.15', '14:32:11', NULL),
(467, '', 'hod', '2021-03-01', '192.168.201.15', '14:44:59', NULL),
(468, '', 'md', '2021-03-01', '192.168.201.15', '15:04:51', NULL),
(469, '', 'hod', '2021-03-01', '192.168.201.15', '15:10:23', NULL),
(470, '', 'technical', '2021-03-01', '192.168.201.15', '15:11:04', NULL),
(471, '', 'md', '2021-03-01', '192.168.201.15', '16:11:28', NULL),
(472, '', 'technical', '2021-03-01', '192.168.201.15', '16:49:58', NULL),
(473, '', 'md', '2021-03-01', '192.168.201.15', '16:58:42', NULL),
(474, '', 'Gopinath', '2021-03-01', '192.168.201.15', '17:11:22', NULL),
(475, '', 'technical', '2021-03-01', '192.168.201.15', '17:16:23', NULL),
(476, '', 'md', '2021-03-01', '192.168.201.15', '17:16:42', NULL),
(477, '', 'md', '2021-03-02', '192.168.201.15', '09:26:19', NULL),
(478, '', 'hod', '2021-03-02', '192.168.201.15', '09:40:10', NULL),
(479, '', 'Gopinath', '2021-03-02', '192.168.201.15', '09:41:36', NULL),
(480, '', 'technical', '2021-03-02', '192.168.201.15', '09:53:18', NULL),
(481, '', 'hod', '2021-03-02', '192.168.201.15', '09:55:38', NULL),
(482, '', 'md', '2021-03-02', '192.168.201.15', '09:56:30', NULL),
(483, '', 'admin', '2021-03-02', '192.168.201.15', '09:57:29', NULL),
(484, '', 'candidate', '2021-03-02', '192.168.201.15', '09:59:13', NULL),
(485, '', 'Recruiter', '2021-03-02', '192.168.201.15', '09:59:33', NULL),
(486, '', 'technical', '2021-03-02', '192.168.201.15', '10:10:35', NULL),
(487, '', 'md', '2021-03-02', '192.168.201.15', '10:16:12', NULL),
(488, '', 'technical', '2021-03-02', '192.168.201.15', '10:23:15', NULL),
(489, '', 'md', '2021-03-02', '192.168.201.15', '10:38:32', NULL),
(490, '', 'technical', '2021-03-02', '192.168.201.15', '10:45:01', NULL),
(491, '', 'md', '2021-03-02', '192.168.201.15', '10:45:59', NULL),
(492, '', 'hod', '2021-03-02', '192.168.201.15', '10:46:49', NULL),
(493, '', 'Recruiter', '2021-03-02', '192.168.201.15', '10:47:52', NULL),
(494, '', 'hod', '2021-03-02', '192.168.201.15', '10:53:21', NULL),
(495, '', 'technical', '2021-03-02', '192.168.201.15', '10:53:47', NULL),
(496, '', 'hod', '2021-03-02', '192.168.201.15', '10:54:22', NULL),
(497, '', 'md', '2021-03-02', '192.168.201.15', '10:55:36', NULL),
(498, '', 'technical', '2021-03-02', '192.168.201.15', '10:56:43', NULL),
(499, '', 'hod', '2021-03-02', '192.168.201.15', '10:59:27', NULL),
(500, '', 'technical', '2021-03-02', '192.168.201.15', '11:00:58', NULL),
(501, '', 'md', '2021-03-02', '192.168.201.15', '11:01:18', NULL),
(502, '', 'hod', '2021-03-02', '192.168.201.15', '11:01:44', NULL),
(503, '', 'technical', '2021-03-02', '192.168.201.15', '11:02:04', NULL),
(504, '', 'hod', '2021-03-02', '192.168.201.15', '11:02:35', NULL),
(505, '', 'Recruiter', '2021-03-02', '192.168.201.15', '11:03:11', NULL),
(506, '', 'Ishwarya', '2021-03-02', '192.168.201.15', '11:04:54', NULL),
(507, '', 'candidate', '2021-03-02', '192.168.201.15', '11:07:11', NULL),
(508, '', 'admin', '2021-03-02', '192.168.201.15', '11:07:49', NULL),
(509, '', 'Recruiter', '2021-03-02', '192.168.201.15', '11:15:53', NULL),
(510, '', 'admin', '2021-03-02', '192.168.201.15', '11:27:32', NULL),
(511, '', 'Recruiter', '2021-03-02', '192.168.201.15', '11:34:09', NULL),
(512, '', 'admin', '2021-03-02', '192.168.201.15', '11:40:50', NULL),
(513, '', 'technical', '2021-03-02', '192.168.201.15', '14:33:33', NULL),
(514, '', 'admin', '2021-03-02', '192.168.201.15', '14:34:17', NULL),
(515, '', 'technical', '2021-03-02', '192.168.201.15', '14:38:07', NULL),
(516, '', 'admin', '2021-03-02', '192.168.201.15', '15:11:24', NULL),
(517, '', 'technical1', '2021-03-02', '192.168.201.15', '15:23:01', NULL),
(518, '', 'hod', '2021-03-02', '192.168.201.15', '15:25:37', NULL),
(519, '', 'technical1', '2021-03-02', '192.168.201.15', '15:31:46', NULL),
(520, '', 'admin', '2021-03-02', '192.168.201.15', '15:32:33', NULL),
(521, '', 'technical1', '2021-03-02', '192.168.201.15', '15:34:06', NULL),
(522, '', 'admin', '2021-03-02', '192.168.201.15', '15:34:35', NULL),
(523, '', 'technical', '2021-03-02', '192.168.201.15', '15:40:37', NULL),
(524, '', 'admin', '2021-03-02', '192.168.201.163', '16:20:23', NULL),
(525, '', 'candidate', '2021-03-02', '192.168.201.15', '16:44:55', NULL),
(526, '', 'VANITHA', '2021-03-02', '192.168.201.15', '16:48:01', NULL),
(527, '', 'admin', '2021-03-02', '192.168.201.15', '16:49:36', NULL),
(528, '', 'candidate', '2021-03-02', '192.168.201.15', '16:50:34', NULL),
(529, '', 'VANITHA', '2021-03-02', '192.168.201.15', '16:51:06', NULL),
(530, '', 'Gopinath', '2021-03-02', '192.168.201.15', '16:52:08', NULL),
(531, '', 'admin', '2021-03-02', '192.168.201.15', '16:56:50', NULL),
(532, '', 'VANITHA', '2021-03-02', '192.168.201.15', '16:57:42', NULL),
(533, '', 'Gopinath', '2021-03-02', '192.168.201.15', '16:58:07', NULL),
(534, '', 'Recruiter', '2021-03-02', '192.168.201.15', '17:01:15', NULL),
(535, '', 'admin', '2021-03-02', '192.168.201.15', '17:03:34', NULL),
(536, '', 'admin', '2021-03-02', '192.168.201.176', '17:06:12', NULL),
(537, '', 'admin', '2021-03-02', '192.168.201.176', '17:10:50', NULL),
(538, '', 'admin', '2021-03-02', '192.168.201.15', '17:44:35', NULL),
(539, '', 'Recruiter', '2021-03-02', '192.168.201.176', '17:44:54', NULL),
(540, '', 'admin', '2021-03-02', '192.168.201.176', '17:46:31', NULL),
(541, '', 'admin', '2021-03-03', '192.168.201.15', '09:36:21', NULL),
(542, '', 'admin', '2021-03-03', '192.168.201.15', '11:00:00', NULL),
(543, '', 'Recruiter', '2021-03-03', '192.168.201.15', '11:00:58', NULL),
(544, '', 'admin', '2021-03-03', '192.168.201.15', '11:15:54', NULL),
(545, '', 'candidate', '2021-03-03', '192.168.201.15', '11:39:26', NULL),
(546, '', 'technical', '2021-03-03', '192.168.201.15', '11:40:11', NULL),
(547, '', 'md', '2021-03-03', '192.168.201.15', '11:40:38', NULL),
(548, '', 'Abinaya', '2021-03-03', '192.168.201.15', '11:41:55', NULL),
(549, '', 'candidate', '2021-03-03', '192.168.201.15', '11:43:01', NULL),
(550, '', 'Recruiter', '2021-03-03', '192.168.201.15', '11:43:39', NULL),
(551, '', 'technical', '2021-03-03', '192.168.201.15', '11:44:26', NULL),
(552, '', 'md', '2021-03-03', '192.168.201.15', '11:45:01', NULL),
(553, '', 'hod', '2021-03-03', '192.168.201.15', '11:45:44', NULL),
(554, '', 'hod', '2021-03-03', '192.168.201.15', '11:48:38', NULL),
(555, '', 'admin', '2021-03-03', '192.168.201.15', '11:49:00', NULL),
(556, '', 'technical1', '2021-03-03', '192.168.201.15', '12:16:32', NULL),
(557, '', 'hod', '2021-03-03', '192.168.201.15', '12:19:30', NULL),
(558, '', 'technical', '2021-03-03', '192.168.201.15', '12:20:49', NULL),
(559, '', 'md', '2021-03-03', '192.168.201.15', '12:21:20', NULL),
(560, '', 'Recruiter', '2021-03-03', '192.168.201.15', '12:21:59', NULL),
(561, '', 'technical', '2021-03-03', '192.168.201.15', '12:22:56', NULL),
(562, '', 'hod', '2021-03-03', '192.168.201.15', '12:23:14', NULL),
(563, '', 'md', '2021-03-03', '192.168.201.15', '12:23:42', NULL),
(564, '', 'technical', '2021-03-03', '192.168.201.15', '12:27:24', NULL),
(565, '', 'technical', '2021-03-03', '192.168.201.15', '12:27:55', NULL),
(566, '', 'Recruiter', '2021-03-03', '192.168.201.15', '12:28:16', NULL),
(567, '', 'hod', '2021-03-03', '192.168.201.15', '12:28:46', NULL),
(568, '', 'md', '2021-03-03', '192.168.201.15', '12:33:09', NULL),
(569, '', 'Ishwarya', '2021-03-03', '192.168.201.15', '12:51:51', NULL),
(570, '', 'Recruiter', '2021-03-03', '192.168.201.15', '12:52:56', NULL),
(571, '', 'technical', '2021-03-03', '192.168.201.15', '12:53:55', NULL),
(572, '', 'hod', '2021-03-03', '192.168.201.15', '12:54:26', NULL),
(573, '', 'technical1', '2021-03-03', '192.168.201.15', '12:55:27', NULL),
(574, '', 'admin', '2021-03-03', '192.168.201.15', '12:56:15', NULL),
(575, '', 'Recruiter', '2021-03-03', '192.168.201.15', '14:35:50', NULL),
(576, '', 'candidate', '2021-03-03', '192.168.201.15', '15:49:27', NULL),
(577, '', 'Recruiter', '2021-03-03', '192.168.201.15', '15:50:16', NULL),
(578, '', 'admin', '2021-03-03', '192.168.201.15', '15:50:37', NULL),
(579, '', 'Recruiter', '2021-03-03', '192.168.201.15', '16:15:24', NULL),
(580, '', 'admin', '2021-03-03', '192.168.201.15', '17:00:13', NULL),
(581, '', 'VANITHA', '2021-03-03', '192.168.201.15', '17:00:36', NULL),
(582, '', 'admin', '2021-03-03', '192.168.201.15', '17:02:36', NULL),
(583, '', 'technical', '2021-03-03', '192.168.201.15', '17:03:08', NULL),
(584, '', 'admin', '2021-03-03', '192.168.201.15', '17:03:40', NULL),
(585, '', 'Recruiter', '2021-03-03', '192.168.201.15', '17:06:01', NULL),
(586, '', 'technical', '2021-03-03', '192.168.201.15', '17:08:01', NULL),
(587, '', 'Recruiter', '2021-03-03', '192.168.201.15', '17:12:00', NULL),
(588, '', 'VANITHA', '2021-03-03', '192.168.201.15', '17:22:45', NULL),
(589, '', 'candidate', '2021-03-03', '192.168.201.15', '17:28:03', NULL),
(590, '', 'Recruiter', '2021-03-03', '192.168.201.15', '17:31:25', NULL),
(591, '', 'technical', '2021-03-03', '192.168.201.15', '17:32:06', NULL),
(592, '', 'Recruiter', '2021-03-03', '192.168.201.15', '17:33:32', NULL),
(593, '', 'admin', '2021-03-03', '192.168.201.15', '17:34:25', NULL),
(594, '', 'Gopinath', '2021-03-03', '192.168.201.15', '17:35:39', NULL),
(595, '', 'technical', '2021-03-03', '192.168.201.15', '17:37:28', NULL),
(596, '', 'Vani', '2021-03-03', '192.168.201.15', '17:50:35', NULL),
(597, '', 'Recruiter', '2021-03-03', '192.168.201.15', '17:50:56', NULL),
(598, '', 'technical1', '2021-03-03', '192.168.201.15', '17:54:45', NULL),
(599, '', 'admin', '2021-03-04', '192.168.201.12', '09:46:14', NULL),
(600, '', 'technical', '2021-03-04', '192.168.201.12', '09:46:40', NULL),
(601, '', 'admin', '2021-03-04', '192.168.201.12', '10:02:55', NULL),
(602, '', 'technical', '2021-03-04', '192.168.201.12', '10:03:37', NULL),
(603, '', 'hod', '2021-03-04', '192.168.201.12', '10:04:12', NULL),
(604, '', 'md', '2021-03-04', '192.168.201.12', '10:04:58', NULL),
(605, '', 'Vani', '2021-03-04', '192.168.201.12', '10:07:38', NULL),
(606, '', 'admin', '2021-03-04', '192.168.201.12', '10:10:06', NULL),
(607, '', 'admin', '2021-03-04', '192.168.201.12', '10:15:51', NULL),
(608, '', 'Vani', '2021-03-04', '192.168.201.12', '10:24:16', NULL),
(609, '', 'admin', '2021-03-04', '192.168.201.12', '10:25:20', NULL),
(610, '', 'admin', '2021-03-04', '192.168.201.12', '11:01:51', NULL),
(611, '', 'technical', '2021-03-04', '192.168.201.12', '11:38:49', NULL),
(612, '', 'Gopinath', '2021-03-04', '192.168.201.12', '11:42:07', NULL),
(613, '', 'Recruiter', '2021-03-04', '192.168.201.12', '11:42:48', NULL),
(614, '', 'hod', '2021-03-04', '192.168.201.12', '12:01:13', NULL),
(615, '', 'technical', '2021-03-04', '192.168.201.12', '12:04:28', NULL),
(616, '', 'admin', '2021-03-04', '192.168.201.12', '12:05:58', NULL),
(617, '', 'Recruiter', '2021-03-04', '192.168.201.12', '12:06:53', NULL),
(618, '', 'technical', '2021-03-04', '192.168.201.12', '12:16:34', NULL),
(619, '', 'hod', '2021-03-04', '192.168.201.12', '12:18:41', NULL),
(620, '', 'md', '2021-03-04', '192.168.201.12', '12:19:24', NULL),
(621, '', 'Recruiter', '2021-03-04', '192.168.201.12', '12:29:01', NULL),
(622, '', 'technical', '2021-03-04', '192.168.201.12', '12:30:48', NULL),
(623, '', 'Recruiter', '2021-03-04', '192.168.201.12', '12:31:14', NULL),
(624, '', 'Recruiter', '2021-03-04', '192.168.201.12', '12:41:18', NULL),
(625, '', 'admin', '2021-03-04', '192.168.201.12', '14:35:24', NULL),
(626, '', 'Recruiter', '2021-03-04', '192.168.201.12', '15:52:07', NULL),
(627, '', 'candidate', '2021-03-04', '192.168.201.12', '15:52:26', NULL),
(628, '', 'Vanitha', '2021-03-04', '192.168.201.12', '15:54:41', NULL),
(629, '', 'Recruiter', '2021-03-04', '192.168.201.12', '15:55:32', NULL),
(630, '', 'admin', '2021-03-04', '192.168.201.12', '16:00:10', NULL),
(631, '', 'technical', '2021-03-04', '192.168.201.12', '16:05:30', NULL),
(632, '', 'Recruiter', '2021-03-04', '192.168.201.12', '16:15:18', NULL),
(633, '', 'admin', '2021-03-04', '192.168.201.12', '16:15:51', NULL),
(634, '', 'admin', '2021-03-04', '192.168.201.12', '16:23:11', NULL),
(635, '', 'hod', '2021-03-04', '192.168.201.12', '16:54:02', NULL),
(636, '', 'candidate', '2021-03-04', '192.168.201.12', '16:55:18', NULL),
(637, '', 'admin', '2021-03-04', '192.168.201.12', '17:02:37', NULL),
(638, '', 'admin', '2021-03-05', '192.168.201.15', '10:59:32', NULL),
(639, '', 'Recruiter', '2021-03-05', '192.168.201.15', '11:04:26', NULL),
(640, '', 'candidate', '2021-03-05', '192.168.201.12', '12:44:14', NULL),
(641, '', 'Recruiter', '2021-03-05', '192.168.201.12', '12:57:07', NULL),
(642, '', 'admin', '2021-03-05', '192.168.201.12', '13:11:57', NULL),
(643, '', 'Rajeshwari', '2021-03-05', '192.168.201.12', '13:15:03', NULL),
(644, '', 'Recruiter', '2021-03-05', '192.168.201.12', '13:22:21', NULL),
(645, '', 'Rajeshwari', '2021-03-05', '192.168.201.12', '14:21:22', NULL),
(646, '', 'admin', '2021-03-05', '192.168.201.12', '14:32:46', NULL),
(647, '', 'Rajeshwari', '2021-03-05', '192.168.201.48', '14:57:38', NULL),
(648, '', 'admin', '2021-03-05', '192.168.201.163', '15:29:27', NULL),
(649, '', 'Recruiter', '2021-03-05', '192.168.201.12', '15:37:23', NULL),
(650, '', 'technical', '2021-03-05', '192.168.201.12', '16:05:32', NULL),
(651, '', 'technical', '2021-03-05', '192.168.201.12', '16:14:57', NULL),
(652, '', 'technical', '2021-03-05', '192.168.201.12', '16:14:59', NULL),
(653, '', 'technical', '2021-03-05', '192.168.201.163', '16:20:31', NULL),
(654, '', 'technical', '2021-03-05', '192.168.201.12', '16:21:20', NULL),
(655, '', 'admin', '2021-03-05', '192.168.201.12', '16:22:17', NULL),
(656, '', 'admin', '2021-03-05', '192.168.201.12', '16:44:49', NULL),
(657, '', 'admin', '2021-03-06', '192.168.201.163', '09:14:02', NULL),
(658, '', 'Recruiter', '2021-03-06', '192.168.201.163', '10:02:22', NULL),
(659, '', 'Recruiter', '2021-03-06', '192.168.201.163', '10:04:21', NULL),
(660, '', 'candidate', '2021-03-06', '192.168.201.163', '10:12:38', NULL),
(661, '', 'Vanitha', '2021-03-06', '192.168.201.163', '10:12:55', NULL),
(662, '', 'admin', '2021-03-06', '192.168.201.12', '10:14:28', NULL),
(663, '', 'technical', '2021-03-06', '192.168.201.12', '10:17:10', NULL),
(664, '', 'Recruiter', '2021-03-06', '192.168.201.12', '10:18:33', NULL),
(665, '', 'technical', '2021-03-06', '192.168.201.12', '10:19:58', NULL),
(666, '', 'Recruiter', '2021-03-06', '192.168.201.12', '10:22:58', NULL),
(667, '', 'technical', '2021-03-06', '192.168.201.12', '10:23:39', NULL),
(668, '', 'Recruiter', '2021-03-06', '192.168.201.163', '10:24:19', NULL),
(669, '', 'candidate', '2021-03-06', '192.168.201.12', '10:26:00', NULL),
(670, '', 'candidate', '2021-03-06', '192.168.201.163', '10:26:05', NULL),
(671, '', 'admin', '2021-03-06', '192.168.201.12', '10:27:19', NULL),
(672, '', 'Recruiter', '2021-03-06', '192.168.201.12', '10:29:04', NULL),
(673, '', 'Rajeshwari', '2021-03-06', '192.168.201.48', '10:29:42', NULL),
(674, '', 'candidate', '2021-03-06', '192.168.201.12', '10:47:31', NULL),
(675, '', 'Recruiter', '2021-03-06', '192.168.201.12', '10:48:00', NULL),
(676, '', 'admin', '2021-03-06', '192.168.201.12', '10:48:17', NULL),
(677, '', 'admin', '2021-03-06', '192.168.201.12', '10:48:59', NULL),
(678, '', 'hod', '2021-03-06', '192.168.201.12', '11:02:08', NULL),
(679, '', 'md', '2021-03-06', '192.168.201.12', '11:02:44', NULL),
(680, '', 'admin', '2021-03-06', '192.168.201.12', '11:06:34', NULL),
(681, '', 'Recruiter', '2021-03-06', '192.168.201.12', '11:07:17', NULL),
(682, '', 'admin', '2021-03-06', '192.168.201.12', '11:16:56', NULL),
(683, '', 'technical', '2021-03-06', '192.168.201.12', '11:28:52', NULL),
(684, '', 'admin', '2021-03-06', '192.168.201.12', '11:42:11', NULL),
(685, '', 'Recruiter', '2021-03-06', '192.168.201.12', '11:42:44', NULL),
(686, '', 'technical', '2021-03-06', '192.168.201.12', '11:43:28', NULL),
(687, '', 'laxmi', '2021-03-06', '192.168.201.163', '11:45:03', NULL),
(688, '', 'candidate', '2021-03-06', '192.168.201.163', '11:54:07', NULL),
(689, '', 'Recruiter', '2021-03-06', '192.168.201.12', '11:57:54', NULL),
(690, '', 'candidate', '2021-03-06', '192.168.201.12', '12:12:56', NULL),
(691, '', 'admin', '2021-03-06', '192.168.201.163', '12:16:04', NULL),
(692, '', 'Rohan', '2021-03-06', '192.168.201.12', '12:16:17', NULL),
(693, '', 'Recruiter', '2021-03-06', '192.168.201.12', '12:17:12', NULL),
(694, '', 'admin', '2021-03-06', '192.168.201.12', '12:17:31', NULL),
(695, '', 'Recruiter', '2021-03-06', '192.168.201.12', '12:25:24', NULL),
(696, '', 'laxmi', '2021-03-06', '192.168.201.163', '12:27:11', NULL),
(697, '', 'technical', '2021-03-06', '192.168.201.12', '12:27:28', NULL),
(698, '', 'admin', '2021-03-06', '192.168.201.12', '12:30:46', NULL),
(699, '', 'Recruiter', '2021-03-06', '192.168.201.12', '12:33:48', NULL),
(700, '', 'admin', '2021-03-06', '192.168.201.12', '13:19:36', NULL),
(701, '', 'technical', '2021-03-06', '192.168.201.12', '16:03:59', NULL),
(702, '', 'admin', '2021-03-06', '192.168.201.12', '17:03:10', NULL),
(703, '', 'Recruiter', '2021-03-06', '192.168.201.12', '17:03:49', NULL),
(704, '', 'Vanitha', '2021-03-06', '192.168.201.163', '17:11:42', NULL),
(705, '', 'vanitha', '2021-03-06', '192.168.201.163', '17:11:42', NULL),
(706, '', 'admin', '2021-03-08', '192.168.201.163', '09:06:38', NULL),
(707, '', 'admin', '2021-03-08', '192.168.201.163', '13:02:47', NULL),
(708, '', 'Laxmi', '2021-03-08', '192.168.201.163', '15:20:43', NULL),
(709, '', 'Vani', '2021-03-08', '192.168.201.163', '15:21:48', NULL),
(710, '', 'Laxmi', '2021-03-08', '192.168.201.163', '15:25:48', NULL),
(711, '', 'Vani', '2021-03-08', '192.168.201.163', '15:48:12', NULL),
(712, '', 'Laxmi', '2021-03-08', '192.168.201.163', '15:48:32', NULL),
(713, '', 'Laxmi', '2021-03-08', '192.168.201.163', '15:55:47', NULL),
(714, '', 'Vani', '2021-03-08', '192.168.201.163', '16:54:27', NULL),
(715, '', 'Laxmi', '2021-03-08', '192.168.201.163', '16:54:51', NULL),
(716, '', 'Laxmi', '2021-03-08', '192.168.201.163', '17:04:50', NULL),
(717, '', 'Laxmi', '2021-03-08', '192.168.201.163', '17:05:27', NULL),
(718, '', 'admin', '2021-03-09', '192.168.201.163', '11:59:19', NULL),
(719, '', 'Laxmi', '2021-03-09', '192.168.201.163', '11:59:40', NULL),
(720, '', 'Laxmi', '2021-03-09', '192.168.201.163', '12:32:39', NULL),
(721, '', 'admin', '2021-03-09', '192.168.201.163', '12:35:15', NULL),
(722, '', 'admin', '2021-03-10', '192.168.201.163', '09:07:24', NULL),
(723, '', 'Laxmi', '2021-03-10', '192.168.201.163', '11:12:24', NULL),
(724, '', 'admin', '2021-03-11', '192.168.201.163', '09:11:52', NULL),
(725, '', 'admin', '2021-03-11', '192.168.201.163', '09:27:02', NULL),
(726, '', 'admin', '2021-03-11', '192.168.201.163', '10:04:55', NULL),
(727, '', 'admin', '2021-03-11', '192.168.201.163', '10:55:23', NULL),
(728, '', 'admin', '2021-03-11', '192.168.201.15', '11:00:59', NULL),
(729, '', 'admin', '2021-03-11', '192.168.201.17', '11:11:10', NULL),
(730, '', 'admin', '2021-03-11', '192.168.201.17', '11:13:22', NULL),
(731, '', 'Recruiter', '2021-03-11', '192.168.201.17', '11:17:03', NULL),
(732, '', 'admin', '2021-03-11', '192.168.201.17', '11:17:21', NULL),
(733, '', 'admin', '2021-03-11', '192.168.201.17', '11:22:46', NULL),
(734, '', 'admin', '2021-03-11', '192.168.201.12', '11:39:28', NULL);
INSERT INTO `z_log_entry` (`id`, `user_id`, `user_name`, `logdate`, `system_ip`, `time`, `logout`) VALUES
(735, '', 'Ishwarya', '2021-03-11', '192.168.201.12', '14:25:17', NULL),
(736, '', 'Ishwarya', '2021-03-11', '192.168.201.12', '14:28:58', NULL),
(737, '', 'admin', '2021-03-11', '192.168.201.163', '14:30:01', NULL),
(738, '', 'Ishwarya', '2021-03-11', '192.168.201.12', '14:30:21', NULL),
(739, '', 'admin', '2021-03-11', '192.168.201.163', '15:51:21', NULL),
(740, '', 'admin', '2021-03-11', '192.168.201.12', '16:22:53', NULL),
(741, '', 'admin', '2021-03-11', '192.168.201.15', '17:41:00', NULL),
(742, '', 'admin', '2021-03-12', '192.168.201.17', '11:42:19', NULL),
(743, '', 'admin', '2021-03-15', '192.168.201.17', '09:48:53', NULL),
(744, '', 'admin', '2021-03-15', '192.168.201.12', '09:57:07', NULL),
(745, '', 'admin', '2021-03-15', '192.168.201.17', '09:58:31', NULL),
(746, '', 'admin', '2021-03-15', '192.168.201.14', '11:33:37', NULL),
(747, '', 'admin', '2021-03-15', '192.168.201.161', '11:35:26', NULL),
(748, '', 'Rajeshwari', '2021-03-15', '192.168.201.48', '11:45:13', NULL),
(749, '', 'admin', '2021-03-15', '192.168.201.17', '12:41:03', NULL),
(750, '', 'admin', '2021-03-15', '192.168.201.161', '13:15:02', NULL),
(751, '', 'admin', '2021-03-15', '192.168.201.17', '13:21:49', NULL),
(752, '', 'admin', '2021-03-15', '192.168.201.12', '15:23:16', NULL),
(753, '', 'admin', '2021-03-15', '192.168.201.17', '15:49:29', NULL),
(754, '', 'Recruiter', '2021-03-15', '192.168.201.12', '16:12:11', NULL),
(755, '', 'admin', '2021-03-15', '192.168.201.12', '17:15:07', NULL),
(756, '', 'Recruiter', '2021-03-15', '192.168.201.12', '17:15:46', NULL),
(757, '', 'admin', '2021-03-16', '192.168.201.15', '09:04:55', NULL),
(758, '', 'admin', '2021-03-16', '192.168.201.161', '09:17:07', NULL),
(759, '', 'admin', '2021-03-16', '192.168.201.12', '09:22:59', NULL),
(760, '', 'admin', '2021-03-16', '192.168.201.14', '09:30:24', NULL),
(761, '', 'admin', '2021-03-16', '192.168.201.163', '09:41:45', NULL),
(762, '', 'admin', '2021-03-16', '192.168.201.17', '10:41:42', NULL),
(763, '', 'candidate', '2021-03-16', '192.168.201.17', '10:53:31', NULL),
(764, '', 'Recruiter', '2021-03-16', '192.168.201.163', '11:22:59', NULL),
(765, '', 'hod', '2021-03-16', '192.168.201.163', '11:23:43', NULL),
(766, '', 'md', '2021-03-16', '192.168.201.163', '11:24:06', NULL),
(767, '', 'hod', '2021-03-16', '192.168.201.163', '11:33:33', NULL),
(768, '', 'technical', '2021-03-16', '192.168.201.163', '11:33:58', NULL),
(769, '', 'admin', '2021-03-16', '192.168.201.163', '11:39:14', NULL),
(770, '', 'candidate', '2021-03-16', '192.168.201.163', '11:40:28', NULL),
(771, '', 'Laxmipriya', '2021-03-16', '192.168.201.163', '11:44:58', NULL),
(772, '', 'admin', '2021-03-16', '192.168.201.163', '11:47:53', NULL),
(773, '', 'Rajeshwari', '2021-03-16', '192.168.201.17', '12:07:21', NULL),
(774, '', 'balachandar', '2021-03-16', '192.168.201.17', '12:07:48', NULL),
(775, '', 'Laxmipriya', '2021-03-16', '192.168.201.17', '12:08:10', NULL),
(776, '', 'admin', '2021-03-16', '192.168.201.17', '12:09:10', NULL),
(777, '', 'Recruiter', '2021-03-16', '192.168.201.17', '12:13:12', NULL),
(778, '', 'admin', '2021-03-16', '192.168.201.17', '12:31:30', NULL),
(779, '', 'meena', '2021-03-16', '192.168.201.17', '12:40:03', NULL),
(780, '', 'admin', '2021-03-16', '192.168.201.17', '12:41:03', NULL),
(781, '', 'Recruiter', '2021-03-16', '192.168.201.17', '12:41:27', NULL),
(782, '', 'admin', '2021-03-16', '192.168.201.17', '13:06:58', NULL),
(783, '', 'Recruiter', '2021-03-16', '192.168.201.17', '13:07:23', NULL),
(784, '', 'technical', '2021-03-16', '192.168.201.17', '13:08:11', NULL),
(785, '', 'md', '2021-03-16', '192.168.201.17', '14:00:44', NULL),
(786, '', 'admin', '2021-03-16', '192.168.201.17', '14:16:21', NULL),
(787, '', 'Vanitha', '2021-03-16', '192.168.201.17', '14:18:25', NULL),
(788, '', 'vanitha', '2021-03-16', '192.168.201.17', '14:18:25', NULL),
(789, '', 'admin', '2021-03-16', '192.168.201.17', '14:20:06', NULL),
(790, '', 'Laxmipriya', '2021-03-16', '192.168.201.17', '14:20:35', NULL),
(791, '', 'Recruiter', '2021-03-16', '192.168.201.17', '14:25:12', NULL),
(792, '', 'admin', '2021-03-16', '192.168.201.17', '14:26:27', NULL),
(793, '', 'admin', '2021-03-16', '192.168.201.17', '14:27:13', NULL),
(794, '', 'Vanitha', '2021-03-16', '192.168.201.17', '14:27:58', NULL),
(795, '', 'vanitha', '2021-03-16', '192.168.201.17', '14:27:58', NULL),
(796, '', 'Gopinath', '2021-03-16', '192.168.201.17', '14:28:38', NULL),
(797, '', 'admin', '2021-03-16', '192.168.201.17', '14:29:29', NULL),
(798, '', 'candidate', '2021-03-16', '192.168.201.17', '14:30:44', NULL),
(799, '', 'mekala', '2021-03-16', '192.168.201.17', '14:32:23', NULL),
(800, '', 'Recruiter', '2021-03-16', '192.168.201.17', '14:33:13', NULL),
(801, '', 'admin', '2021-03-16', '192.168.201.17', '14:33:38', NULL),
(802, '', 'Recruiter', '2021-03-16', '192.168.201.17', '14:34:06', NULL),
(803, '', 'Recruiter', '2021-03-16', '192.168.201.17', '14:36:45', NULL),
(804, '', 'technical', '2021-03-16', '192.168.201.17', '14:37:24', NULL),
(805, '', 'md', '2021-03-16', '192.168.201.17', '14:38:41', NULL),
(806, '', 'admin', '2021-03-16', '192.168.201.17', '14:59:21', NULL),
(807, '', 'admin', '2021-03-16', '192.168.201.163', '15:21:43', NULL),
(808, '', 'Recruiter', '2021-03-16', '192.168.201.163', '15:22:07', NULL),
(809, '', 'technical', '2021-03-16', '192.168.201.163', '16:27:53', NULL),
(810, '', 'hod', '2021-03-16', '192.168.201.163', '16:28:50', NULL),
(811, '', 'Recruiter', '2021-03-16', '192.168.201.163', '16:30:27', NULL),
(812, '', 'admin', '2021-03-16', '192.168.201.163', '16:30:45', NULL),
(813, '', 'md', '2021-03-16', '192.168.201.163', '16:45:46', NULL),
(814, '', 'admin', '2021-03-16', '192.168.201.163', '17:10:33', NULL),
(815, '', 'Recruiter', '2021-03-16', '192.168.201.163', '17:11:19', NULL),
(816, '', 'admin', '2021-03-16', '192.168.201.163', '17:28:09', NULL),
(817, '', 'md', '2021-03-16', '192.168.201.163', '17:38:24', NULL),
(818, '', 'admin', '2021-03-17', '192.168.201.12', '09:10:24', NULL),
(819, '', 'md', '2021-03-17', '192.168.201.163', '09:19:00', NULL),
(820, '', 'admin', '2021-03-17', '192.168.201.19', '09:24:57', NULL),
(821, '', 'admin', '2021-03-17', '192.168.201.19', '09:25:35', NULL),
(822, '', 'candidate', '2021-03-17', '192.168.201.19', '09:27:03', NULL),
(823, '', 'admin', '2021-03-17', '192.168.201.163', '09:27:18', NULL),
(824, '', 'Jefferarason', '2021-03-17', '192.168.201.19', '09:28:29', NULL),
(825, '', 'Recruiter', '2021-03-17', '192.168.201.19', '09:29:23', NULL),
(826, '', 'admin', '2021-03-17', '192.168.201.19', '09:29:44', NULL),
(827, '', 'Recruiter', '2021-03-17', '192.168.201.19', '09:30:14', NULL),
(828, '', 'admin', '2021-03-17', '192.168.201.163', '09:32:31', NULL),
(829, '', 'Recruiter', '2021-03-17', '192.168.201.19', '09:32:51', NULL),
(830, '', 'technical', '2021-03-17', '192.168.201.19', '09:33:42', NULL),
(831, '', 'md', '2021-03-17', '192.168.201.19', '09:37:26', NULL),
(832, '', 'admin', '2021-03-17', '192.168.201.163', '09:38:17', NULL),
(833, '', 'technical', '2021-03-17', '192.168.201.163', '09:43:57', NULL),
(834, '', 'candidate', '2021-03-17', '192.168.201.19', '09:48:01', NULL),
(835, '', 'sindhu', '2021-03-17', '192.168.201.19', '09:50:57', NULL),
(836, '', 'admin', '2021-03-17', '192.168.201.19', '09:52:00', NULL),
(837, '', 'Recruiter', '2021-03-17', '192.168.201.19', '09:53:22', NULL),
(838, '', 'technical', '2021-03-17', '192.168.201.19', '09:55:49', NULL),
(839, '', 'md', '2021-03-17', '192.168.201.19', '09:58:45', NULL),
(840, '', 'candidate', '2021-03-17', '192.168.201.19', '09:59:50', NULL),
(841, '', 'sakthi', '2021-03-17', '192.168.201.19', '10:01:51', NULL),
(842, '', 'sakthi', '2021-03-17', '192.168.201.19', '10:01:51', NULL),
(843, '', 'admin', '2021-03-17', '192.168.201.19', '10:03:04', NULL),
(844, '', 'Recruiter', '2021-03-17', '192.168.201.19', '10:03:54', NULL),
(845, '', 'technical', '2021-03-17', '192.168.201.19', '10:06:43', NULL),
(846, '', 'md', '2021-03-17', '192.168.201.19', '10:07:37', NULL),
(847, '', 'admin', '2021-03-17', '192.168.201.19', '10:08:56', NULL),
(848, '', 'md', '2021-03-17', '192.168.201.163', '10:23:31', NULL),
(849, '', 'technical', '2021-03-17', '192.168.201.163', '10:52:50', NULL),
(850, '', 'admin', '2021-03-17', '192.168.201.163', '10:54:20', NULL),
(851, '', 'admin', '2021-03-17', '192.168.201.17', '10:54:52', NULL),
(852, '', 'Recruiter', '2021-03-17', '192.168.201.17', '10:55:33', NULL),
(853, '', 'admin', '2021-03-17', '192.168.201.17', '10:57:13', NULL),
(854, '', 'candidate', '2021-03-17', '192.168.201.17', '10:57:36', NULL),
(855, '', 'Uma', '2021-03-17', '192.168.201.17', '10:59:01', NULL),
(856, '', 'admin', '2021-03-17', '192.168.201.17', '10:59:45', NULL),
(857, '', 'Recruiter', '2021-03-17', '192.168.201.17', '11:00:12', NULL),
(858, '', 'mekala', '2021-03-17', '192.168.201.163', '11:00:36', NULL),
(859, '', 'Recruiter', '2021-03-17', '192.168.201.17', '11:02:58', NULL),
(860, '', 'technical', '2021-03-17', '192.168.201.17', '11:04:15', NULL),
(861, '', 'md', '2021-03-17', '192.168.201.17', '11:05:17', NULL),
(862, '', 'admin', '2021-03-17', '192.168.201.17', '11:56:42', NULL),
(863, '', 'candidate', '2021-03-17', '192.168.201.163', '11:56:55', NULL),
(864, '', 'mekala', '2021-03-17', '192.168.201.17', '11:58:11', NULL),
(865, '', 'meenakshi', '2021-03-17', '192.168.201.163', '11:59:36', NULL),
(866, '', 'admin', '2021-03-17', '192.168.201.12', '12:03:13', NULL),
(867, '', 'Recruiter', '2021-03-17', '192.168.201.12', '12:04:04', NULL),
(868, '', 'technical', '2021-03-17', '192.168.201.12', '12:08:16', NULL),
(869, '', 'md', '2021-03-17', '192.168.201.12', '12:10:36', NULL),
(870, '', 'admin', '2021-03-17', '192.168.201.12', '12:11:29', NULL),
(871, '', 'admin', '2021-03-17', '192.168.201.12', '12:13:32', NULL),
(872, '', 'admin', '2021-03-17', '192.168.201.17', '12:16:00', NULL),
(873, '', 'mekala', '2021-03-17', '192.168.201.12', '12:23:03', NULL),
(874, '', 'admin', '2021-03-17', '192.168.201.12', '12:33:02', NULL),
(875, '', 'admin', '2021-03-17', '192.168.201.163', '12:34:43', NULL),
(876, '', 'mekala', '2021-03-17', '192.168.201.163', '12:46:26', NULL),
(877, '', 'admin', '2021-03-17', '192.168.201.15', '14:21:07', NULL),
(878, '', 'candidate', '2021-03-17', '192.168.201.17', '14:42:55', NULL),
(879, '', 'candidate', '2021-03-17', '192.168.201.17', '14:45:15', NULL),
(880, '', 'sathish', '2021-03-17', '192.168.201.17', '14:46:23', NULL),
(881, '', 'mani', '2021-03-17', '192.168.201.17', '14:46:34', NULL),
(882, '', 'admin', '2021-03-17', '192.168.201.163', '14:46:34', NULL),
(883, '', 'admin', '2021-03-17', '192.168.201.17', '14:47:19', NULL),
(884, '', 'admin', '2021-03-17', '192.168.201.17', '14:48:11', NULL),
(885, '', 'Recruiter', '2021-03-17', '192.168.201.17', '14:49:41', NULL),
(886, '', 'Recruiter', '2021-03-17', '192.168.201.17', '14:51:10', NULL),
(887, '', 'technical', '2021-03-17', '192.168.201.17', '14:56:49', NULL),
(888, '', 'md', '2021-03-17', '192.168.201.17', '14:57:42', NULL),
(889, '', 'Recruiter', '2021-03-17', '192.168.201.17', '15:00:55', NULL),
(890, '', 'md', '2021-03-17', '192.168.201.17', '15:01:43', NULL),
(891, '', 'technical', '2021-03-17', '192.168.201.17', '15:02:03', NULL),
(892, '', 'mekala', '2021-03-17', '192.168.201.17', '15:15:43', NULL),
(893, '', 'candidate', '2021-03-17', '192.168.201.163', '16:07:59', NULL),
(894, '', 'mekala', '2021-03-17', '192.168.201.163', '16:15:50', NULL),
(895, '', 'admin', '2021-03-17', '192.168.201.15', '17:26:28', NULL),
(896, '', 'admin', '2021-03-17', '192.168.201.12', '17:41:50', NULL),
(897, '', 'admin', '2021-03-18', '192.168.201.15', '09:06:58', NULL),
(898, '', 'admin', '2021-03-18', '192.168.201.163', '09:07:13', NULL),
(899, '', 'admin', '2021-03-18', '192.168.201.163', '09:08:12', NULL),
(900, '', 'admin', '2021-03-18', '192.168.201.12', '09:32:23', NULL),
(901, '', 'admin', '2021-03-18', '192.168.201.161', '09:34:28', NULL),
(902, '', 'admin', '2021-03-18', '192.168.201.15', '09:57:23', NULL),
(903, '', 'technical', '2021-03-18', '192.168.201.163', '10:03:07', NULL),
(904, '', 'hod', '2021-03-18', '192.168.201.163', '10:06:58', NULL),
(905, '', 'md', '2021-03-18', '192.168.201.163', '10:07:31', NULL),
(906, '', 'admin', '2021-03-18', '192.168.201.163', '10:07:57', NULL),
(907, '', 'mekala', '2021-03-18', '192.168.201.163', '10:08:15', NULL),
(908, '', 'Laxmipriya', '2021-03-18', '192.168.201.163', '10:26:02', NULL),
(909, '', 'admin', '2021-03-18', '192.168.201.12', '12:35:47', NULL),
(910, '', 'admin', '2021-03-18', '192.168.201.17', '14:29:00', NULL),
(911, '', 'admin', '2021-03-18', '192.168.201.12', '15:01:56', NULL),
(912, '', 'admin', '2021-03-18', '192.168.201.163', '15:22:00', NULL),
(913, '', 'Laxmipriya', '2021-03-18', '192.168.201.163', '15:22:58', NULL),
(914, '', 'admin', '2021-03-18', '192.168.201.163', '16:00:44', NULL),
(915, '', 'admin', '2021-03-18', '192.168.201.10', '16:02:45', NULL),
(916, '', 'admin', '2021-03-18', '192.168.201.17', '16:28:47', NULL),
(917, '', 'Laxmipriya', '2021-03-18', '192.168.201.163', '17:26:54', NULL),
(918, '', 'admin', '2021-03-19', '192.168.201.163', '09:06:38', NULL),
(919, '', 'Laxmipriya', '2021-03-19', '192.168.201.163', '09:08:21', NULL),
(920, '', 'Laxmipriya', '2021-03-19', '192.168.201.163', '09:09:25', NULL),
(921, '', 'admin', '2021-03-19', '192.168.201.12', '09:12:37', NULL),
(922, '', 'admin', '2021-03-19', '192.168.201.15', '09:18:07', NULL),
(923, '', 'admin', '2021-03-19', '192.168.201.163', '09:22:55', NULL),
(924, '', 'Laxmipriya', '2021-03-19', '192.168.201.163', '09:23:05', NULL),
(925, '', 'admin', '2021-03-19', '192.168.201.163', '10:16:45', NULL),
(926, '', 'candidate', '2021-03-19', '192.168.201.163', '10:18:13', NULL),
(927, '', 'admin', '2021-03-19', '192.168.201.15', '17:26:42', NULL),
(928, '', 'admin', '2021-03-19', '192.168.201.15', '17:30:21', NULL),
(929, '', 'admin', '2021-03-20', '192.168.201.163', '09:20:04', NULL),
(930, '', 'admin', '2021-03-20', '192.168.201.15', '09:36:46', NULL),
(931, '', 'admin', '2021-03-20', '192.168.201.12', '09:40:46', NULL),
(932, '', 'candidate', '2021-03-20', '192.168.201.163', '10:49:16', NULL),
(933, '', 'admin', '2021-03-20', '192.168.201.17', '11:10:02', NULL),
(934, '', 'admin', '2021-03-20', '192.168.201.17', '11:19:18', NULL),
(935, '', 'admin', '2021-03-20', '192.168.201.41', '15:01:18', NULL),
(936, '', 'Laxmipriya', '2021-03-20', '192.168.201.12', '15:43:02', NULL),
(937, '', 'Laxmipriya', '2021-03-20', '192.168.201.163', '15:44:27', NULL),
(938, '', 'admin', '2021-03-20', '192.168.201.15', '16:24:49', NULL),
(939, '', 'admin', '2021-03-22', '192.168.201.12', '09:18:42', NULL),
(940, '', 'Laxmipriya', '2021-03-22', '192.168.201.12', '09:20:02', NULL),
(941, '', 'admin', '2021-03-22', '192.168.201.151', '09:20:56', NULL),
(942, '', 'admin', '2021-03-22', '192.168.201.17', '09:25:48', NULL),
(943, '', 'admin', '2021-03-22', '192.168.201.17', '09:26:10', NULL),
(944, '', 'admin', '2021-03-22', '192.168.201.163', '09:37:31', NULL),
(945, '', 'Laxmipriya', '2021-03-22', '192.168.201.12', '09:39:41', NULL),
(946, '', 'admin', '2021-03-22', '192.168.201.15', '09:44:06', NULL),
(947, '', 'admin', '2021-03-22', '192.168.201.163', '10:00:33', NULL),
(948, '', 'admin', '2021-03-22', '192.168.201.163', '10:04:12', NULL),
(949, '', 'admin', '2021-03-22', '192.168.201.12', '10:05:09', NULL),
(950, '', 'Laxmipriya', '2021-03-22', '192.168.201.12', '13:22:12', NULL),
(951, '', 'admin', '2021-03-22', '192.168.201.12', '13:31:44', NULL),
(952, '', 'Laxmipriya', '2021-03-22', '192.168.201.12', '16:40:55', NULL),
(953, '', 'admin', '2021-03-22', '192.168.201.15', '16:44:59', NULL),
(954, '', 'admin', '2021-03-22', '192.168.201.12', '16:45:47', NULL),
(955, '', 'admin', '2021-03-22', '192.168.201.40', '17:41:54', NULL),
(956, '', 'admin', '2021-03-23', '192.168.201.163', '09:03:47', NULL),
(957, '', 'Laxmipriya', '2021-03-23', '192.168.201.12', '09:25:49', NULL),
(958, '', 'Gopinath', '2021-03-23', '192.168.201.14', '09:35:55', NULL),
(959, '', 'admin', '2021-03-23', '192.168.201.15', '09:38:11', NULL),
(960, '', 'admin', '2021-03-23', '192.168.201.14', '09:39:32', NULL),
(961, '', 'admin', '2021-03-23', '192.168.201.14', '10:00:26', NULL),
(962, '', 'admin', '2021-03-23', '192.168.201.15', '10:27:28', NULL),
(963, '', 'admin', '2021-03-23', '192.168.201.15', '10:29:08', NULL),
(964, '', 'admin', '2021-03-23', '192.168.201.15', '10:29:33', NULL),
(965, '', 'admin', '2021-03-23', '192.168.201.17', '10:45:03', NULL),
(966, '', 'admin', '2021-03-23', '192.168.201.12', '10:47:06', NULL),
(967, '', 'Laxmipriya', '2021-03-23', '192.168.201.12', '10:51:52', NULL),
(968, '', 'admin', '2021-03-23', '192.168.201.163', '10:59:17', NULL),
(969, '', 'admin', '2021-03-23', '192.168.201.163', '11:09:20', NULL),
(970, '', 'admin', '2021-03-23', '192.168.201.163', '11:09:51', NULL),
(971, '', 'admin', '2021-03-23', '192.168.201.12', '11:19:48', NULL),
(972, '', 'admin', '2021-03-23', '192.168.201.163', '11:19:53', NULL),
(973, '', 'Laxmipriya', '2021-03-23', '192.168.201.163', '11:46:09', NULL),
(974, '', 'Laxmi Priya', '2021-03-23', '192.168.201.163', '12:30:33', NULL),
(975, '', 'admin', '2021-03-23', '192.168.201.163', '12:42:42', NULL),
(976, '', 'Laxmi Priya', '2021-03-23', '192.168.201.163', '12:56:36', NULL),
(977, '', 'admin', '2021-03-23', '192.168.201.163', '12:57:14', NULL),
(978, '', 'Laxmi Priya', '2021-03-23', '192.168.201.163', '14:24:20', NULL),
(979, '', 'Laxmi Priya', '2021-03-23', '192.168.201.163', '14:38:35', NULL),
(980, '', 'Laxmi Priya', '2021-03-23', '192.168.201.163', '14:52:35', NULL),
(981, '', 'admin', '2021-03-23', '192.168.201.17', '15:07:00', NULL),
(982, '', 'admin', '2021-03-23', '192.168.201.163', '16:11:53', NULL),
(983, '', 'admin', '2021-03-23', '192.168.201.15', '16:15:14', NULL),
(984, '', 'admin', '2021-03-23', '192.168.201.14', '17:00:20', NULL),
(985, '', 'admin', '2021-03-24', '192.168.201.14', '08:57:20', NULL),
(986, '', 'admin', '2021-03-24', '192.168.201.14', '08:58:57', NULL),
(987, '', 'admin', '2021-03-24', '192.168.201.163', '09:05:52', NULL),
(988, '', 'admin', '2021-03-24', '192.168.201.15', '09:18:36', NULL),
(989, '', 'admin', '2021-03-24', '192.168.201.17', '09:22:05', NULL),
(990, '', 'admin', '2021-03-24', '192.168.201.12', '09:32:17', NULL),
(991, '', 'candidate', '2021-03-24', '192.168.201.163', '11:06:08', NULL),
(992, '', 'candidate', '2021-03-24', '192.168.201.163', '11:35:23', NULL),
(993, '', 'admin', '2021-03-24', '192.168.201.14', '11:43:24', NULL),
(994, '', 'admin', '2021-03-24', '192.168.201.14', '11:44:32', NULL),
(995, '', 'admin', '2021-03-24', '192.168.201.163', '13:10:41', NULL),
(996, '', 'admin', '2021-03-24', '192.168.201.12', '13:12:08', NULL),
(997, '', 'admin', '2021-03-24', '192.168.201.15', '14:29:50', NULL),
(998, '', 'admin', '2021-03-24', '192.168.201.12', '14:37:40', NULL),
(999, '', 'candidate', '2021-03-24', '192.168.201.12', '16:30:18', NULL),
(1000, '', 'Rajeshwari', '2021-03-24', '192.168.201.163', '17:10:08', NULL),
(1001, '', 'Recruiter', '2021-03-24', '192.168.201.12', '17:16:23', NULL),
(1002, '', 'candidate', '2021-03-24', '192.168.201.12', '17:16:48', NULL),
(1003, '', 'Recruiter', '2021-03-24', '192.168.201.163', '17:33:46', NULL),
(1004, '', 'admin', '2021-03-24', '192.168.201.12', '17:43:29', NULL),
(1005, '', 'Rajeshwari', '2021-03-24', '192.168.201.163', '17:43:55', NULL),
(1006, '', 'admin', '2021-03-25', '192.168.201.14', '09:00:14', NULL),
(1007, '', 'admin', '2021-03-25', '192.168.201.163', '09:03:31', NULL),
(1008, '', 'admin', '2021-03-25', '192.168.201.163', '09:03:48', NULL),
(1009, '', 'admin', '2021-03-25', '192.168.201.12', '09:18:58', NULL),
(1010, '', 'admin', '2021-03-25', '192.168.201.14', '10:16:25', NULL),
(1011, '', 'candidate', '2021-03-25', '192.168.201.12', '10:33:45', NULL),
(1012, '', 'candidate', '2021-03-25', '192.168.201.12', '10:34:47', NULL),
(1013, '', 'candidate', '2021-03-25', '192.168.201.12', '10:36:19', NULL),
(1014, '', 'candidate', '2021-03-25', '192.168.201.12', '10:37:05', NULL),
(1015, '', 'candidate', '2021-03-25', '192.168.201.12', '10:37:53', NULL),
(1016, '', 'candidate', '2021-03-25', '192.168.201.12', '10:39:13', NULL),
(1017, '', 'candidate', '2021-03-25', '192.168.201.12', '10:40:04', NULL),
(1018, '', 'candidate', '2021-03-25', '192.168.201.12', '10:44:51', NULL),
(1019, '', 'candidate', '2021-03-25', '192.168.201.12', '10:57:25', NULL),
(1020, '', 'admin', '2021-03-25', '192.168.201.14', '10:57:48', NULL),
(1021, '', 'candidate', '2021-03-25', '192.168.201.12', '10:59:01', NULL),
(1022, '', 'Lakshmi', '2021-03-25', '192.168.201.163', '11:01:00', NULL),
(1023, '', 'candidate', '2021-03-25', '192.168.201.12', '11:07:53', NULL),
(1024, '', 'admin', '2021-03-25', '192.168.201.12', '11:32:54', NULL),
(1025, '', 'admin', '2021-03-25', '192.168.201.15', '11:33:13', NULL),
(1026, '', 'candidate', '2021-03-25', '192.168.201.12', '11:33:44', NULL),
(1027, '', 'admin', '2021-03-25', '192.168.201.12', '11:39:07', NULL),
(1028, '', 'candidate', '2021-03-25', '192.168.201.163', '11:39:15', NULL),
(1029, '', 'Test', '2021-03-25', '192.168.201.163', '11:41:38', NULL),
(1030, '', 'Lakshmi', '2021-03-25', '192.168.201.163', '12:01:14', NULL),
(1031, '', 'Test', '2021-03-25', '192.168.201.163', '12:15:56', NULL),
(1032, '', 'admin', '2021-03-25', '192.168.201.17', '13:06:31', NULL),
(1033, '', 'admin', '2021-03-25', '192.168.201.17', '13:07:51', NULL),
(1034, '', 'Lakshmi', '2021-03-25', '192.168.201.17', '13:11:20', NULL),
(1035, '', 'Recruiter', '2021-03-25', '192.168.201.163', '13:14:46', NULL),
(1036, '', 'Test', '2021-03-25', '192.168.201.163', '13:19:35', NULL),
(1037, '', 'admin', '2021-03-25', '192.168.201.15', '13:33:39', NULL),
(1038, '', 'Test', '2021-03-25', '192.168.201.163', '13:33:53', NULL),
(1039, '', 'Test', '2021-03-25', '192.168.201.163', '13:34:50', NULL),
(1040, '', 'admin', '2021-03-25', '192.168.201.15', '13:35:21', NULL),
(1041, '', 'admin', '2021-03-25', '192.168.201.15', '13:36:08', NULL),
(1042, '', 'admin', '2021-03-25', '192.168.201.14', '14:29:32', NULL),
(1043, '', 'Test', '2021-03-25', '192.168.201.163', '15:42:59', NULL),
(1044, '', 'Test', '2021-03-25', '192.168.201.163', '15:45:09', NULL),
(1045, '', 'candidate', '2021-03-25', '192.168.201.17', '15:50:11', NULL),
(1046, '', 'Lakshmi', '2021-03-25', '192.168.201.17', '16:00:17', NULL),
(1047, '', 'Test', '2021-03-25', '192.168.201.163', '16:01:14', NULL),
(1048, '', 'Test', '2021-03-25', '192.168.201.163', '16:02:26', NULL),
(1049, '', 'Lakshmi', '2021-03-25', '192.168.201.17', '16:21:43', NULL),
(1050, '', 'Test', '2021-03-25', '192.168.201.163', '16:39:24', NULL),
(1051, '', 'admin', '2021-03-25', '192.168.201.163', '16:42:20', NULL),
(1052, '', 'Recruiter', '2021-03-25', '192.168.201.163', '16:45:39', NULL),
(1053, '', 'admin', '2021-03-25', '192.168.201.14', '16:50:29', NULL),
(1054, '', 'Test', '2021-03-25', '192.168.201.151', '17:39:18', NULL),
(1055, '', 'admin', '2021-03-25', '192.168.201.14', '17:42:41', NULL),
(1056, '', 'admin', '2021-03-26', '192.168.201.151', '08:56:50', NULL),
(1057, '', 'admin', '2021-03-26', '192.168.201.14', '08:59:06', NULL),
(1058, '', 'admin', '2021-03-26', '192.168.201.12', '09:07:19', NULL),
(1059, '', 'admin', '2021-03-26', '192.168.201.14', '09:14:02', NULL),
(1060, '', 'admin', '2021-03-26', '192.168.201.15', '09:14:35', NULL),
(1061, '', 'admin', '2021-03-26', '192.168.201.14', '09:28:37', NULL),
(1062, '', 'Test', '2021-03-26', '192.168.201.163', '09:29:55', NULL),
(1063, '', 'Lakshmi', '2021-03-26', '192.168.201.17', '09:30:08', NULL),
(1064, '', 'admin', '2021-03-26', '192.168.201.15', '09:39:33', NULL),
(1065, '', 'Lakshmi', '2021-03-26', '192.168.201.17', '10:11:24', NULL),
(1066, '', 'Lakshmi', '2021-03-26', '192.168.201.14', '11:04:06', NULL),
(1067, '', 'admin', '2021-03-26', '192.168.201.17', '11:14:25', NULL),
(1068, '', 'admin', '2021-03-26', '192.168.201.17', '11:18:13', NULL),
(1069, '', 'admin', '2021-03-26', '192.168.201.17', '11:21:02', NULL),
(1070, '', 'admin', '2021-03-26', '192.168.201.17', '11:40:44', NULL),
(1071, '', 'admin', '2021-03-26', '192.168.201.12', '11:49:20', NULL),
(1072, '', 'Recruiter', '2021-03-26', '192.168.201.12', '11:50:47', NULL),
(1073, '', 'admin', '2021-03-26', '192.168.201.12', '11:55:26', NULL),
(1074, '', 'Lakshmi', '2021-03-26', '192.168.201.163', '11:56:18', NULL),
(1075, '', 'admin', '2021-03-26', '192.168.201.17', '12:09:24', NULL),
(1076, '', 'admin', '2021-03-26', '192.168.201.17', '12:16:02', NULL),
(1077, '', 'Jaikumar', '2021-03-26', '192.168.201.163', '14:27:58', NULL),
(1078, '', 'Jaikumar', '2021-03-26', '192.168.201.163', '14:27:58', NULL),
(1079, '', 'Gopinath', '2021-03-26', '192.168.201.163', '15:00:38', NULL),
(1080, '', 'admin', '2021-03-26', '192.168.201.12', '15:00:40', NULL),
(1081, '', 'Recruiter', '2021-03-26', '192.168.201.12', '15:01:54', NULL),
(1082, '', 'admin', '2021-03-26', '192.168.201.12', '15:37:25', NULL),
(1083, '', 'Recruiter', '2021-03-26', '192.168.201.12', '15:38:23', NULL),
(1084, '', 'md', '2021-03-26', '192.168.201.17', '16:20:44', NULL),
(1085, '', 'md', '2021-03-26', '192.168.201.17', '16:21:26', NULL),
(1086, '', 'Gopinath', '2021-03-26', '192.168.201.163', '16:22:14', NULL),
(1087, '', 'admin', '2021-03-26', '192.168.201.17', '16:25:07', NULL),
(1088, '', 'Recruiter', '2021-03-26', '192.168.201.12', '16:32:30', NULL),
(1089, '', 'admin', '2021-03-26', '192.168.201.163', '16:40:34', NULL),
(1090, '', 'Lakshmi', '2021-03-26', '192.168.201.17', '16:42:10', NULL),
(1091, '', 'admin', '2021-03-29', '192.168.201.12', '09:05:13', NULL),
(1092, '', 'admin', '2021-03-29', '192.168.201.163', '09:08:01', NULL),
(1093, '', 'admin', '2021-03-29', '192.168.201.14', '09:10:04', NULL),
(1094, '', 'Recruiter', '2021-03-29', '192.168.201.12', '09:10:13', NULL),
(1095, '', 'Lakshmi', '2021-03-29', '192.168.201.17', '09:11:07', NULL),
(1096, '', 'admin', '2021-03-29', '192.168.201.12', '09:11:29', NULL),
(1097, '', 'Lakshmi', '2021-03-29', '192.168.201.163', '09:18:19', NULL),
(1098, '', 'laxmipriya', '2021-03-29', '192.168.201.163', '09:19:19', NULL),
(1099, '', 'candidate', '2021-03-29', '192.168.201.12', '09:38:41', NULL),
(1100, '', 'Recruiter', '2021-03-29', '192.168.201.12', '09:39:21', NULL),
(1101, '', 'Rajeshwari', '2021-03-29', '192.168.201.163', '10:06:49', NULL),
(1102, '', 'Rajeshwari', '2021-03-29', '192.168.201.163', '10:07:38', NULL),
(1103, '', 'Test', '2021-03-29', '192.168.201.163', '10:50:35', NULL),
(1104, '', 'Test', '2021-03-29', '192.168.201.163', '10:52:01', NULL),
(1105, '', 'Gopinath', '2021-03-29', '192.168.201.17', '10:53:05', NULL),
(1106, '', 'Recruiter', '2021-03-29', '192.168.201.163', '11:00:04', NULL),
(1107, '', 'candidate', '2021-03-29', '192.168.201.163', '11:07:53', NULL),
(1108, '', 'test1', '2021-03-29', '192.168.201.163', '11:09:13', NULL),
(1109, '', 'Recruiter', '2021-03-29', '192.168.201.163', '11:11:30', NULL),
(1110, '', 'test1', '2021-03-29', '192.168.201.163', '11:17:13', NULL),
(1111, '', 'Recruiter', '2021-03-29', '192.168.201.163', '11:17:26', NULL),
(1112, '', 'Recruiter', '2021-03-29', '192.168.201.163', '11:22:16', NULL),
(1113, '', 'Test', '2021-03-29', '192.168.201.163', '11:36:02', NULL),
(1114, '', 'test1', '2021-03-29', '192.168.201.163', '11:36:59', NULL),
(1115, '', 'test1', '2021-03-29', '192.168.201.163', '11:37:29', NULL),
(1116, '', 'Recruiter', '2021-03-29', '192.168.201.163', '11:37:44', NULL),
(1117, '', 'Test', '2021-03-29', '192.168.201.12', '11:38:06', NULL),
(1118, '', 'Recruiter', '2021-03-29', '192.168.201.12', '11:38:31', NULL),
(1119, '', 'Rajeshwari', '2021-03-29', '115.243.95.114', '12:02:13', NULL),
(1120, '', 'laxmipriya', '2021-03-29', '192.168.201.163', '12:12:44', NULL),
(1121, '', 'Rajeshwari', '2021-03-29', '192.168.201.48', '12:16:57', NULL),
(1122, '', 'admin', '2021-03-29', '192.168.201.17', '12:18:24', NULL),
(1123, '', 'Test', '2021-03-29', '192.168.201.163', '12:43:51', NULL),
(1124, '', 'Jaikumar', '2021-03-29', '192.168.201.15', '12:46:26', NULL),
(1125, '', 'Mohana Krishnan', '2021-03-29', '192.168.201.163', '12:51:43', NULL),
(1126, '', 'admin', '2021-03-29', '192.168.201.17', '12:59:04', NULL),
(1127, '', 'Gopinath', '2021-03-29', '192.168.201.17', '12:59:32', NULL),
(1128, '', 'Gopinath', '2021-03-29', '192.168.201.17', '13:01:31', NULL),
(1129, '', 'admin', '2021-03-29', '192.168.201.12', '13:51:37', NULL),
(1130, '', 'Recruiter', '2021-03-29', '192.168.201.163', '14:03:04', NULL),
(1131, '', 'laxmipriya', '2021-03-29', '192.168.201.17', '14:08:09', NULL),
(1132, '', 'admin', '2021-03-29', '192.168.201.12', '14:10:39', NULL),
(1133, '', 'admin', '2021-03-29', '192.168.201.17', '14:18:06', NULL),
(1134, '', 'admin', '2021-03-29', '192.168.201.163', '14:18:29', NULL),
(1135, '', 'laxmipriya', '2021-03-29', '192.168.201.17', '14:33:59', NULL),
(1136, '', 'technical', '2021-03-29', '192.168.201.12', '14:40:23', NULL),
(1137, '', 'Recruiter', '2021-03-29', '192.168.201.12', '14:41:13', NULL),
(1138, '', 'admin', '2021-03-29', '192.168.201.12', '14:42:06', NULL),
(1139, '', 'admin', '2021-03-29', '192.168.201.12', '14:43:12', NULL),
(1140, '', 'Recruiter', '2021-03-29', '192.168.201.12', '14:51:52', NULL),
(1141, '', 'Mohana Krishnan', '2021-03-29', '192.168.201.40', '14:53:42', NULL),
(1142, '', 'admin', '2021-03-29', '192.168.201.17', '14:53:58', NULL),
(1143, '', 'admin', '2021-03-29', '192.168.201.12', '15:12:12', NULL),
(1144, '', 'Recruiter', '2021-03-29', '192.168.201.12', '15:12:49', NULL),
(1145, '', 'technical', '2021-03-29', '192.168.201.12', '15:13:21', NULL),
(1146, '', 'Gopinath', '2021-03-29', '192.168.201.17', '15:14:48', NULL),
(1147, '', 'admin', '2021-03-29', '192.168.201.17', '15:17:19', NULL),
(1148, '', 'Recruiter', '2021-03-29', '192.168.201.12', '15:18:43', NULL),
(1149, '', 'admin', '2021-03-29', '192.168.201.17', '15:19:05', NULL),
(1150, '', 'admin', '2021-03-29', '192.168.201.17', '15:19:30', NULL),
(1151, '', 'hod', '2021-03-29', '192.168.201.12', '15:20:07', NULL),
(1152, '', 'technical1', '2021-03-29', '192.168.201.12', '15:25:42', NULL),
(1153, '', 'admin', '2021-03-29', '192.168.201.17', '15:25:57', NULL),
(1154, '', 'md', '2021-03-29', '192.168.201.12', '15:28:23', NULL),
(1155, '', 'admin', '2021-03-29', '192.168.201.17', '15:34:20', NULL),
(1156, '', 'md', '2021-03-29', '192.168.201.17', '15:34:45', NULL),
(1157, '', 'test1', '2021-03-29', '192.168.201.163', '15:44:41', NULL),
(1158, '', 'Sebastain', '2021-03-29', '192.168.201.163', '15:45:58', NULL),
(1159, '', 'Sebastain', '2021-03-29', '192.168.201.163', '16:03:29', NULL),
(1160, '', 'admin', '2021-03-29', '192.168.201.17', '16:06:08', NULL),
(1161, '', 'md', '2021-03-29', '192.168.201.17', '16:07:14', NULL),
(1162, '', 'Sebastain', '2021-03-29', '192.168.201.163', '16:08:12', NULL),
(1163, '', 'Recruiter', '2021-03-29', '192.168.201.163', '16:12:38', NULL),
(1164, '', 'Meena', '2021-03-29', '192.168.201.17', '17:05:14', NULL),
(1165, '', 'admin', '2021-03-29', '192.168.201.12', '17:09:39', NULL),
(1166, '', 'Recruiter', '2021-03-29', '192.168.201.12', '17:09:57', NULL),
(1167, '', 'admin', '2021-03-29', '192.168.201.17', '17:15:55', NULL),
(1168, '', 'Meena', '2021-03-29', '192.168.201.17', '17:21:31', NULL),
(1169, '', 'md', '2021-03-29', '192.168.201.17', '17:24:46', NULL),
(1170, '', 'laxmipriya', '2021-03-29', '192.168.201.17', '17:31:35', NULL),
(1171, '', 'Sindhu ', '2021-03-29', '192.168.201.14', '17:32:14', NULL),
(1172, '', 'Vanitha', '2021-03-29', '192.168.201.12', '17:32:21', NULL),
(1173, '', 'admin', '2021-03-29', '192.168.201.12', '17:39:27', NULL),
(1174, '', 'Recruiter', '2021-03-29', '192.168.201.12', '17:40:05', NULL),
(1175, '', 'Mohana Krishnan', '2021-03-29', '192.168.201.40', '17:41:53', NULL),
(1176, '', 'laxmipriya', '2021-03-29', '192.168.201.17', '17:59:47', NULL),
(1177, '', 'Rajeshwari', '2021-03-29', '27.5.246.178', '20:43:18', NULL),
(1178, '', 'Gopinath', '2021-03-30', '192.168.201.17', '09:38:27', NULL),
(1179, '', 'admin', '2021-03-30', '192.168.201.163', '09:38:43', NULL),
(1180, '', 'admin', '2021-03-30', '192.168.201.163', '09:39:07', NULL),
(1181, '', 'admin', '2021-03-30', '192.168.201.12', '09:43:15', NULL),
(1182, '', 'Umadevi', '2021-03-30', '192.168.201.161', '09:48:32', NULL),
(1183, '', 'Vanitha', '2021-03-30', '192.168.201.12', '09:52:22', NULL),
(1184, '', 'Meena', '2021-03-30', '192.168.201.224', '09:52:28', NULL),
(1185, '', 'Jefferson', '2021-03-30', '192.168.201.212', '09:52:45', NULL),
(1186, '', 'Arunachalam', '2021-03-30', '192.168.201.19', '09:54:08', NULL),
(1187, '', 'laxmipriya', '2021-03-30', '192.168.201.163', '10:08:34', NULL),
(1188, '', 'admin', '2021-03-30', '192.168.201.12', '10:25:58', NULL),
(1189, '', 'Rajeshwari', '2021-03-30', '115.243.95.114', '10:34:17', NULL),
(1190, '', 'admin', '2021-03-30', '192.168.201.161', '10:51:37', NULL),
(1191, '', 'admin', '2021-03-30', '192.168.201.12', '11:05:41', NULL),
(1192, '', 'admin', '2021-03-30', '192.168.201.17', '11:06:36', NULL),
(1193, '', 'Recruiter', '2021-03-30', '192.168.201.12', '11:09:12', NULL),
(1194, '', 'admin', '2021-03-30', '192.168.201.17', '11:10:53', NULL),
(1195, '', 'Gopinath', '2021-03-30', '192.168.201.17', '11:11:18', NULL),
(1196, '', 'admin', '2021-03-30', '192.168.201.20', '11:12:08', NULL),
(1197, '', 'admin', '2021-03-30', '192.168.201.161', '11:35:16', NULL),
(1198, '', 'Meena', '2021-03-30', '192.168.201.17', '11:38:56', NULL),
(1199, '', 'Gopinath', '2021-03-30', '192.168.201.17', '11:40:40', NULL),
(1200, '', 'Gopinath', '2021-03-30', '192.168.201.17', '11:45:55', NULL),
(1201, '', 'md', '2021-03-30', '192.168.201.17', '11:46:37', NULL),
(1202, '', 'admin', '2021-03-30', '192.168.201.17', '12:10:30', NULL),
(1203, '', 'admin', '2021-03-30', '192.168.201.12', '12:36:19', NULL),
(1204, '', 'admin', '2021-03-30', '192.168.201.163', '12:56:48', NULL),
(1205, '', 'Gopinath', '2021-03-30', '192.168.201.17', '13:27:33', NULL),
(1206, '', 'admin', '2021-03-30', '192.168.201.15', '13:34:30', NULL),
(1207, '', 'laxmipriya', '2021-03-30', '192.168.201.163', '14:16:10', NULL),
(1208, '', 'admin', '2021-03-30', '192.168.201.12', '14:30:53', NULL),
(1209, '', 'admin', '2021-03-30', '192.168.201.161', '15:15:46', NULL),
(1210, '', 'admin', '2021-03-30', '192.168.201.161', '15:19:53', NULL),
(1211, '', 'Gopinath', '2021-03-30', '192.168.201.17', '15:36:45', NULL),
(1212, '', 'admin', '2021-03-30', '192.168.201.17', '15:56:18', NULL),
(1213, '', 'technical', '2021-03-30', '192.168.201.17', '16:09:37', NULL),
(1214, '', 'md', '2021-03-30', '192.168.201.17', '16:10:12', NULL),
(1215, '', 'Gopinath', '2021-03-30', '192.168.201.17', '16:16:22', NULL),
(1216, '', 'Rajeshwari', '2021-03-30', '115.243.95.114', '16:37:22', NULL),
(1217, '', 'Rajeshwari', '2021-03-30', '115.243.95.114', '16:37:54', NULL),
(1218, '', 'admin', '2021-03-30', '192.168.201.161', '16:57:35', NULL),
(1219, '', 'admin', '2021-03-30', '192.168.201.17', '17:18:06', NULL),
(1220, '', 'md', '2021-03-30', '192.168.201.17', '17:23:48', NULL),
(1221, '', 'Gopinath', '2021-03-30', '192.168.201.17', '17:24:27', NULL),
(1222, '', 'Gopinath', '2021-03-30', '192.168.201.17', '17:46:13', NULL),
(1223, '', 'laxmipriya', '2021-03-30', '192.168.201.163', '18:00:06', NULL),
(1224, '', 'Rajeshwari', '2021-03-30', '27.5.147.50', '20:40:33', NULL),
(1225, '', 'admin', '2021-03-31', '27.62.42.135', '00:56:16', NULL),
(1226, '', 'admin', '2021-03-31', '192.168.201.163', '09:03:49', NULL),
(1227, '', 'admin', '2021-03-31', '192.168.201.20', '09:04:55', NULL),
(1228, '', 'admin', '2021-03-31', '192.168.201.12', '09:10:25', NULL),
(1229, '', 'admin', '2021-03-31', '192.168.201.161', '09:29:29', NULL),
(1230, '', 'Rajeshwari', '2021-03-31', '115.243.95.114', '09:51:00', NULL),
(1231, '', 'admin', '2021-03-31', '192.168.201.161', '10:05:13', NULL),
(1232, '', 'Sindhu ', '2021-03-31', '192.168.201.20', '10:44:09', NULL),
(1233, '', 'candidate', '2021-03-31', '192.168.201.163', '10:58:21', NULL),
(1234, '', 'laxmipriya', '2021-03-31', '192.168.201.163', '11:24:56', NULL),
(1235, '', 'Sindhu ', '2021-03-31', '192.168.201.41', '14:43:44', NULL),
(1236, '', 'admin', '2021-03-31', '192.168.201.163', '14:51:05', NULL),
(1237, '', 'admin', '2021-03-31', '192.168.201.12', '14:57:34', NULL),
(1238, '', 'Rajeshwari', '2021-03-31', '192.168.201.38', '15:16:53', NULL),
(1239, '', 'Rajeshwari', '2021-03-31', '115.243.95.114', '17:19:00', NULL),
(1240, '', 'admin', '2021-04-01', '192.168.201.163', '09:12:12', NULL),
(1241, '', 'Sindhu ', '2021-04-01', '192.168.201.20', '09:12:30', NULL),
(1242, '', 'admin', '2021-04-01', '192.168.201.17', '09:24:10', NULL),
(1243, '', 'Sindhu ', '2021-04-01', '192.168.201.17', '09:57:12', NULL),
(1244, '', 'admin', '2021-04-01', '192.168.201.161', '10:19:43', NULL),
(1245, '', 'admin', '2021-04-01', '192.168.201.17', '10:26:54', NULL),
(1246, '', 'admin', '2021-04-01', '192.168.201.17', '10:45:44', NULL),
(1247, '', 'admin', '2021-04-01', '192.168.201.17', '10:56:26', NULL),
(1248, '', 'admin', '2021-04-01', '192.168.201.163', '11:59:53', NULL),
(1249, '', 'Rajeshwari', '2021-04-01', '115.243.95.114', '12:20:59', NULL),
(1250, '', 'admin', '2021-04-01', '192.168.201.163', '15:12:32', NULL),
(1251, '', 'admin', '2021-04-01', '192.168.201.163', '15:26:41', NULL),
(1252, '', 'admin', '2021-04-01', '192.168.201.15', '15:34:29', NULL),
(1253, '', 'admin', '2021-04-01', '192.168.201.20', '15:37:58', NULL),
(1254, '', 'Sindhu ', '2021-04-01', '192.168.201.163', '15:48:37', NULL),
(1255, '', 'Gopinath', '2021-04-01', '192.168.201.17', '16:16:38', NULL),
(1256, '', 'admin', '2021-04-01', '192.168.201.17', '16:20:21', NULL),
(1257, '', 'md', '2021-04-01', '192.168.201.17', '16:21:10', NULL),
(1258, '', 'admin', '2021-04-01', '192.168.201.17', '16:21:31', NULL),
(1259, '', 'admin', '2021-04-01', '192.168.201.17', '16:32:00', NULL),
(1260, '', 'admin', '2021-04-01', '192.168.201.161', '16:33:15', NULL),
(1261, '', 'admin', '2021-04-01', '192.168.201.41', '16:39:38', NULL),
(1262, '', 'admin', '2021-04-01', '192.168.201.161', '17:59:29', NULL),
(1263, '', 'admin', '2021-04-02', '192.168.201.12', '08:51:30', NULL),
(1264, '', 'admin', '2021-04-02', '192.168.201.163', '09:04:52', NULL),
(1265, '', 'admin', '2021-04-02', '192.168.201.17', '09:15:59', NULL),
(1266, '', 'Sindhu ', '2021-04-02', '192.168.201.20', '09:17:04', NULL),
(1267, '', 'admin', '2021-04-02', '192.168.201.20', '09:17:40', NULL),
(1268, '', 'Sindhu ', '2021-04-02', '192.168.201.20', '10:14:12', NULL),
(1269, '', 'Rajeshwari', '2021-04-02', '115.243.95.114', '10:17:59', NULL),
(1270, '', 'candidate', '2021-04-02', '192.168.201.17', '10:37:39', NULL),
(1271, '', 'Recruiter', '2021-04-02', '192.168.201.17', '10:39:08', NULL),
(1272, '', 'Recruiter', '2021-04-02', '192.168.201.17', '10:39:49', NULL),
(1273, '', 'admin', '2021-04-02', '192.168.201.17', '10:40:22', NULL),
(1274, '', 'Sindhu ', '2021-04-02', '192.168.201.20', '10:41:21', NULL),
(1275, '', 'Sindhu ', '2021-04-02', '192.168.201.20', '11:01:05', NULL),
(1276, '', 'admin', '2021-04-02', '192.168.201.17', '11:54:44', NULL),
(1277, '', 'admin', '2021-04-02', '192.168.201.17', '15:37:40', NULL),
(1278, '', 'admin', '2021-04-02', '192.168.201.17', '16:04:23', NULL),
(1279, '', 'Sindhu ', '2021-04-03', '192.168.201.20', '09:04:00', NULL),
(1280, '', 'admin', '2021-04-03', '192.168.201.163', '09:08:37', NULL),
(1281, '', 'admin', '2021-04-03', '192.168.201.12', '09:10:44', NULL),
(1282, '', 'admin', '2021-04-03', '192.168.201.17', '10:03:24', NULL),
(1283, '', 'Gopinath', '2021-04-03', '192.168.201.17', '12:42:42', NULL),
(1284, '', 'Rajeshwari', '2021-04-03', '115.243.95.114', '16:50:23', NULL),
(1285, '', 'admin', '2021-04-03', '192.168.201.17', '17:01:08', NULL),
(1286, '', 'admin', '2021-04-05', '192.168.201.12', '09:08:05', NULL),
(1287, '', 'admin', '2021-04-05', '192.168.201.163', '09:13:23', NULL),
(1288, '', 'admin', '2021-04-05', '192.168.201.161', '09:23:24', NULL),
(1289, '', 'admin', '2021-04-05', '192.168.201.17', '09:41:34', NULL),
(1290, '', 'admin', '2021-04-05', '192.168.201.15', '09:49:06', NULL),
(1291, '', 'admin', '2021-04-05', '192.168.201.163', '10:29:59', NULL),
(1292, '', 'Gopinath', '2021-04-05', '192.168.201.17', '10:30:04', NULL),
(1293, '', 'admin', '2021-04-05', '192.168.201.17', '11:58:57', NULL),
(1294, '', 'admin', '2021-04-05', '192.168.201.163', '12:30:35', NULL),
(1295, '', 'admin', '2021-04-05', '192.168.201.163', '12:47:15', NULL),
(1296, '', 'admin', '2021-04-05', '192.168.201.163', '12:48:12', NULL),
(1297, '', 'admin', '2021-04-05', '192.168.201.17', '12:49:00', NULL),
(1298, '', 'admin', '2021-04-05', '192.168.201.163', '12:49:02', NULL),
(1299, '', 'admin', '2021-04-05', '192.168.201.163', '12:50:35', NULL),
(1300, '', 'admin', '2021-04-05', '192.168.201.161', '13:14:24', NULL),
(1301, '', 'admin', '2021-04-05', '192.168.201.161', '13:15:58', NULL),
(1302, '', 'admin', '2021-04-05', '192.168.201.161', '13:53:12', NULL),
(1303, '', 'admin', '2021-04-05', '192.168.201.161', '14:25:29', NULL),
(1304, '', 'admin', '2021-04-05', '192.168.201.15', '14:32:03', NULL),
(1305, '', 'admin', '2021-04-07', '192.168.201.12', '09:18:48', NULL),
(1306, '', 'admin', '2021-04-07', '192.168.201.163', '09:21:00', NULL),
(1307, '', 'Rajeshwari', '2021-04-07', '115.243.95.114', '09:54:37', NULL),
(1308, '', 'admin', '2021-04-07', '192.168.201.163', '10:06:06', NULL),
(1309, '', 'admin', '2021-04-07', '192.168.201.12', '10:52:54', NULL),
(1310, '', 'Gopinath', '2021-04-07', '192.168.201.17', '12:07:41', NULL),
(1311, '', 'Gopinath', '2021-04-07', '192.168.201.17', '12:14:23', NULL),
(1312, '', 'admin', '2021-04-07', '192.168.201.163', '12:21:51', NULL),
(1313, '', 'admin', '2021-04-07', '192.168.201.17', '12:50:08', NULL),
(1314, '', 'Rajeshwari', '2021-04-07', '115.243.95.114', '12:56:24', NULL),
(1315, '', 'admin', '2021-04-07', '192.168.201.163', '14:36:24', NULL),
(1316, '', 'Rajeshwari', '2021-04-07', '115.243.95.114', '14:49:06', NULL),
(1317, '', 'laxmipriya', '2021-04-07', '115.243.95.114', '14:52:53', NULL),
(1318, '', 'Rajeshwari', '2021-04-07', '115.243.95.114', '14:53:43', NULL),
(1319, '', 'admin', '2021-04-07', '192.168.201.20', '16:32:45', NULL),
(1320, '', 'admin', '2021-04-07', '192.168.201.20', '16:33:24', NULL),
(1321, '', 'admin', '2021-04-07', '192.168.201.163', '16:39:04', NULL),
(1322, '', 'admin', '2021-04-07', '192.168.201.20', '16:43:33', NULL),
(1323, '', 'admin', '2021-04-07', '192.168.201.163', '16:48:12', NULL),
(1324, '', 'admin', '2021-04-08', '192.168.201.161', '09:05:06', NULL),
(1325, '', 'admin', '2021-04-08', '192.168.201.20', '09:06:25', NULL),
(1326, '', 'admin', '2021-04-08', '192.168.201.17', '09:10:34', NULL),
(1327, '', 'admin', '2021-04-08', '192.168.201.163', '09:49:03', NULL),
(1328, '', 'admin', '2021-04-08', '192.168.201.15', '10:05:32', NULL),
(1329, '', 'admin', '2021-04-08', '192.168.201.163', '11:21:58', NULL),
(1330, '', 'laxmipriya', '2021-04-08', '192.168.201.163', '12:25:17', NULL),
(1331, '', 'Gopinath', '2021-04-08', '192.168.201.17', '12:26:46', NULL),
(1332, '', 'Gopinath', '2021-04-08', '192.168.201.163', '12:27:24', NULL),
(1333, '', 'laxmipriya', '2021-04-08', '192.168.201.163', '12:29:27', NULL),
(1334, '', 'admin', '2021-04-08', '192.168.201.17', '12:33:42', NULL),
(1335, '', 'Rajeshwari', '2021-04-08', '115.243.95.114', '12:48:41', NULL),
(1336, '', 'Rajeshwari', '2021-04-08', '115.243.95.114', '12:54:28', NULL),
(1337, '', 'admin', '2021-04-08', '192.168.201.15', '13:04:32', NULL),
(1338, '', 'Sebastain', '2021-04-08', '192.168.201.163', '14:05:44', NULL),
(1339, '', 'admin', '2021-04-08', '192.168.201.15', '14:29:13', NULL),
(1340, '', 'admin', '2021-04-08', '192.168.201.163', '15:58:25', NULL),
(1341, '', 'admin', '2021-04-08', '192.168.201.17', '15:58:48', NULL),
(1342, '', 'admin', '2021-04-08', '192.168.201.15', '16:12:59', NULL),
(1343, '', 'admin', '2021-04-08', '192.168.201.15', '17:06:54', NULL),
(1344, '', 'admin', '2021-04-08', '192.168.201.11', '17:58:19', NULL),
(1345, '', 'Rajeshwari', '2021-04-08', '27.5.239.64', '21:35:22', NULL),
(1346, '', 'admin', '2021-04-08', '116.72.122.1', '22:32:11', NULL),
(1347, '', 'admin', '2021-04-08', '27.62.133.179', '22:42:06', NULL),
(1348, '', 'laxmipriya', '2021-04-08', '27.62.133.179', '23:01:26', NULL),
(1349, '', 'admin', '2021-04-09', '192.168.201.12', '08:55:26', NULL),
(1350, '', 'admin', '2021-04-09', '192.168.201.161', '09:12:13', NULL),
(1351, '', 'admin', '2021-04-09', '192.168.201.163', '09:12:16', NULL),
(1352, '', 'admin', '2021-04-09', '192.168.201.17', '09:21:43', NULL),
(1353, '', 'admin', '2021-04-09', '192.168.201.15', '09:28:16', NULL),
(1354, '', 'Rajeshwari', '2021-04-09', '115.243.95.114', '09:31:22', NULL),
(1355, '', 'admin', '2021-04-09', '192.168.201.12', '10:28:53', NULL),
(1356, '', 'admin', '2021-04-09', '192.168.201.20', '12:33:08', NULL),
(1357, '', 'admin', '2021-04-09', '192.168.201.161', '14:50:45', NULL),
(1358, '', 'admin', '2021-04-09', '192.168.201.17', '16:55:59', NULL),
(1359, '', 'Rajeshwari', '2021-04-09', '115.243.95.114', '17:17:20', NULL),
(1360, '', 'admin', '2021-04-12', '192.168.201.163', '09:08:58', NULL),
(1361, '', 'admin', '2021-04-12', '192.168.201.161', '09:14:30', NULL),
(1362, '', 'admin', '2021-04-12', '192.168.201.161', '09:17:30', NULL),
(1363, '', 'admin', '2021-04-12', '192.168.201.15', '09:23:53', NULL),
(1364, '', 'admin', '2021-04-12', '192.168.201.18', '09:29:05', NULL),
(1365, '', 'admin', '2021-04-12', '192.168.201.163', '10:15:56', NULL),
(1366, '', 'resource', '2021-04-12', '192.168.201.163', '11:21:18', NULL),
(1367, '', 'admin', '2021-04-12', '192.168.201.163', '11:53:00', NULL),
(1368, '', 'resource', '2021-04-12', '192.168.201.163', '12:20:21', NULL),
(1369, '', 'admin', '2021-04-12', '192.168.201.20', '12:28:58', NULL),
(1370, '', 'resource', '2021-04-12', '192.168.201.163', '12:46:07', NULL),
(1371, '', 'resource', '2021-04-12', '192.168.201.163', '13:18:07', NULL),
(1372, '', 'admin', '2021-04-12', '192.168.201.163', '13:35:46', NULL),
(1373, '', 'admin', '2021-04-12', '192.168.201.224', '14:06:32', NULL),
(1374, '', 'admin', '2021-04-12', '192.168.201.15', '14:10:12', NULL),
(1375, '', 'admin', '2021-04-12', '192.168.201.224', '15:41:08', NULL),
(1376, '', 'admin', '2021-04-12', '192.168.201.25', '16:12:57', NULL),
(1377, '', 'admin', '2021-04-12', '192.168.201.224', '17:07:41', NULL),
(1378, '', 'admin', '2021-04-12', '192.168.201.224', '17:14:50', NULL),
(1379, '', 'admin', '2021-04-12', '192.168.201.224', '17:18:45', NULL),
(1380, '', 'admin', '2021-04-12', '192.168.201.224', '17:29:42', NULL),
(1381, '', 'admin', '2021-04-12', '192.168.201.224', '17:33:28', NULL),
(1382, '', 'admin', '2021-04-12', '192.168.201.224', '17:53:57', NULL),
(1383, '', 'admin', '2021-04-12', '192.168.201.20', '17:58:24', NULL),
(1384, '', 'admin', '2021-04-13', '192.168.201.163', '09:05:37', NULL),
(1385, '', 'Jaikumar', '2021-04-13', '192.168.201.163', '09:09:09', NULL),
(1386, '', 'admin', '2021-04-13', '192.168.201.161', '09:20:27', NULL),
(1387, '', 'Jaikumar', '2021-04-13', '192.168.201.163', '09:30:40', NULL),
(1388, '', 'admin', '2021-04-13', '192.168.201.18', '10:01:35', NULL),
(1389, '', 'admin', '2021-04-13', '192.168.201.161', '10:02:18', NULL),
(1390, '', 'admin', '2021-04-13', '192.168.201.161', '10:07:33', NULL),
(1391, '', 'admin', '2021-04-13', '192.168.201.20', '11:05:42', NULL),
(1392, '', 'admin', '2021-04-13', '192.168.201.18', '12:53:05', NULL),
(1393, '', 'Jaikumar', '2021-04-13', '192.168.201.163', '16:16:34', NULL),
(1394, '', 'Jaikumar', '2021-04-13', '192.168.201.163', '16:44:30', NULL),
(1395, '', 'admin', '2021-04-15', '192.168.201.163', '09:55:41', NULL),
(1396, '', 'admin', '2021-04-15', '192.168.201.56', '10:15:23', NULL),
(1397, '', 'admin', '2021-04-15', '192.168.201.163', '10:19:43', NULL),
(1398, '', 'admin', '2021-04-15', '192.168.201.18', '10:21:18', NULL),
(1399, '', 'Jaikumar', '2021-04-15', '192.168.201.163', '10:25:35', NULL),
(1400, '', 'resource', '2021-04-15', '192.168.201.163', '10:31:04', NULL),
(1401, '', 'resource', '2021-04-15', '192.168.201.163', '10:31:49', NULL),
(1402, '', 'admin', '2021-04-15', '192.168.201.20', '12:16:44', NULL),
(1403, '', 'admin', '2021-04-15', '192.168.201.18', '13:09:49', NULL),
(1404, '', 'admin', '2021-04-15', '192.168.201.163', '13:09:52', NULL),
(1405, '', 'New', '2021-04-15', '192.168.201.163', '14:06:16', NULL),
(1406, '', 'admin', '2021-04-15', '192.168.201.18', '14:09:05', NULL),
(1407, '', 'New', '2021-04-15', '192.168.201.163', '14:13:53', NULL),
(1408, '', 'admin', '2021-04-15', '192.168.201.163', '14:14:35', NULL),
(1409, '', 'Jaikumar', '2021-04-15', '192.168.201.163', '14:25:54', NULL),
(1410, '', 'Rajeshwari', '2021-04-15', '49.249.229.10', '14:40:28', NULL),
(1411, '', 'admin', '2021-04-15', '192.168.201.56', '14:44:03', NULL),
(1412, '', 'Rajeshwari', '2021-04-15', '49.249.229.10', '14:55:26', NULL),
(1413, '', 'laxmipriya', '2021-04-15', '192.168.201.163', '15:13:44', NULL),
(1414, '', 'admin', '2021-04-15', '192.168.201.56', '15:14:02', NULL),
(1415, '', 'laxmipriya', '2021-04-15', '192.168.201.163', '15:14:34', NULL),
(1416, '', 'resource', '2021-04-15', '192.168.201.163', '15:15:32', NULL),
(1417, '', 'admin', '2021-04-15', '192.168.201.163', '15:15:43', NULL),
(1418, '', 'Recruiter', '2021-04-15', '192.168.201.163', '15:21:24', NULL),
(1419, '', 'Jaikumar', '2021-04-15', '192.168.201.163', '15:35:59', NULL),
(1420, '', 'admin', '2021-04-15', '192.168.201.56', '15:39:23', NULL),
(1421, '', 'admin', '2021-04-15', '192.168.201.56', '15:43:47', NULL),
(1422, '', 'Rajeshwari', '2021-04-15', '49.249.229.10', '16:12:19', NULL),
(1423, '', 'technical', '2021-04-15', '192.168.201.163', '16:29:21', NULL),
(1424, '', 'technical', '2021-04-15', '192.168.201.163', '16:31:23', NULL),
(1425, '', 'Gopinath', '2021-04-15', '192.168.201.18', '16:31:37', NULL),
(1426, '', 'Jaikumar', '2021-04-15', '192.168.201.163', '16:33:00', NULL),
(1427, '', 'Recruiter', '2021-04-15', '192.168.201.163', '16:47:11', NULL),
(1428, '', 'Jaikumar', '2021-04-15', '192.168.201.163', '16:54:32', NULL),
(1429, '', 'admin', '2021-04-15', '192.168.201.18', '17:58:54', NULL),
(1430, '', 'admin', '2021-04-16', '192.168.201.56', '09:02:00', NULL),
(1431, '', 'admin', '2021-04-16', '192.168.201.163', '09:08:31', NULL),
(1432, '', 'Jaikumar', '2021-04-16', '192.168.201.163', '09:12:43', NULL),
(1433, '', 'admin', '2021-04-16', '192.168.201.18', '09:37:52', NULL),
(1434, '', 'admin', '2021-04-16', '192.168.201.18', '11:02:41', NULL),
(1435, '', 'Jaikumar', '2021-04-16', '192.168.201.163', '12:13:03', NULL),
(1436, '', 'admin', '2021-04-16', '192.168.201.18', '14:51:43', NULL),
(1437, '', 'admin', '2021-04-16', '192.168.201.18', '16:36:39', NULL),
(1438, '', 'admin', '2021-04-16', '192.168.201.163', '16:56:20', NULL),
(1439, '', 'New', '2021-04-16', '49.249.229.10', '17:29:54', NULL),
(1440, '', 'Rajeshwari', '2021-04-16', '49.249.229.10', '18:20:37', NULL),
(1441, '', 'admin', '2021-04-17', '192.168.201.163', '09:05:12', NULL),
(1442, '', 'admin', '2021-04-17', '192.168.201.56', '09:20:32', NULL),
(1443, '', 'test', '2021-04-17', '192.168.201.163', '09:40:46', NULL);
INSERT INTO `z_log_entry` (`id`, `user_id`, `user_name`, `logdate`, `system_ip`, `time`, `logout`) VALUES
(1444, '', 'Jaikumar', '2021-04-17', '192.168.201.163', '09:45:01', NULL),
(1445, '', 'admin', '2021-04-17', '192.168.201.46', '09:45:18', NULL),
(1446, '', 'test', '2021-04-17', '192.168.201.163', '10:10:15', NULL),
(1447, '', 'Jaikumar', '2021-04-17', '192.168.201.163', '10:14:10', NULL),
(1448, '', 'admin', '2021-04-17', '192.168.201.45', '10:31:32', NULL),
(1449, '', 'admin', '2021-04-17', '192.168.201.163', '11:29:07', NULL),
(1450, '', 'admin', '2021-04-17', '192.168.201.163', '11:30:24', NULL),
(1451, '', 'admin', '2021-04-17', '192.168.201.45', '11:49:03', NULL),
(1452, '', 'Jaikumar', '2021-04-17', '192.168.201.163', '12:23:02', NULL),
(1453, '', 'admin', '2021-04-17', '192.168.201.34', '12:28:06', NULL),
(1454, '', 'test1', '2021-04-17', '192.168.201.163', '12:35:13', NULL),
(1455, '', 'Rajeshwari', '2021-04-17', '49.249.229.10', '12:45:16', NULL),
(1456, '', 'Rajeshwari', '2021-04-17', '192.168.201.163', '13:20:49', NULL),
(1457, '', 'Rajeshwari', '2021-04-17', '192.168.201.163', '13:22:42', NULL),
(1458, '', 'Jaikumar', '2021-04-17', '192.168.201.163', '13:25:55', NULL),
(1459, '', 'Rajeshwari', '2021-04-17', '192.168.201.163', '13:28:18', NULL),
(1460, '', 'admin', '2021-04-17', '192.168.201.163', '13:35:45', NULL),
(1461, '', 'hod', '2021-04-17', '192.168.201.163', '14:22:21', NULL),
(1462, '', 'admin', '2021-04-17', '192.168.201.45', '14:30:16', NULL),
(1463, '', 'admin', '2021-04-17', '192.168.201.56', '14:33:01', NULL),
(1464, '', 'admin', '2021-04-17', '192.168.201.20', '14:38:11', NULL),
(1465, '', 'admin', '2021-04-17', '192.168.201.20', '15:12:13', NULL),
(1466, '', 'Rajeshwari', '2021-04-17', '49.249.229.10', '15:53:36', NULL),
(1467, '', 'Rajeshwari', '2021-04-18', '49.249.229.10', '12:37:01', NULL),
(1468, '', 'Sindhu ', '2021-04-18', '49.249.229.10', '17:34:26', NULL),
(1469, '', 'Jaikumar', '2021-04-18', '49.249.229.10', '20:47:07', NULL),
(1470, '', 'Mohana Krishnan', '2021-04-19', '49.249.229.10', '05:33:06', NULL),
(1471, '', 'Mohana Krishnan', '2021-04-19', '49.249.229.10', '06:11:01', NULL),
(1472, '', 'Jaikumar', '2021-04-19', '49.249.229.10', '09:16:34', NULL),
(1473, '', 'Umadevi', '2021-04-19', '192.168.201.161', '09:31:12', NULL),
(1474, '', 'admin', '2021-04-19', '192.168.201.163', '09:38:51', NULL),
(1475, '', 'Jaikumar', '2021-04-19', '192.168.201.163', '10:34:59', NULL),
(1476, '', 'candidate', '2021-04-19', '192.168.201.163', '12:15:30', NULL),
(1477, '', 'candid', '2021-04-19', '192.168.201.163', '14:19:30', NULL),
(1478, '', 'Jaikumar', '2021-04-19', '192.168.201.163', '14:28:36', NULL),
(1479, '', 'candid', '2021-04-19', '192.168.201.163', '14:44:35', NULL),
(1480, '', 'Jaikumar', '2021-04-19', '192.168.201.163', '15:21:40', NULL),
(1481, '', 'Rizwana', '2021-04-19', '49.249.229.10', '16:22:18', NULL),
(1482, '', 'admin', '2021-04-20', '192.168.201.163', '09:06:24', NULL),
(1483, '', 'technical1', '2021-04-20', '192.168.201.163', '09:11:28', NULL),
(1484, '', 'Rajeshwari', '2021-04-20', '192.168.201.163', '09:16:00', NULL),
(1485, '', 'admin', '2021-04-20', '192.168.201.45', '09:17:45', NULL),
(1486, '', 'admin', '2021-04-20', '192.168.201.20', '09:40:31', NULL),
(1487, '', 'admin', '2021-04-20', '192.168.201.45', '11:05:11', NULL),
(1488, '', 'Rajeshwari', '2021-04-20', '49.249.229.10', '14:30:35', NULL),
(1489, '', 'admin', '2021-04-20', '49.249.229.10', '14:31:07', NULL),
(1490, '', 'admin', '2021-04-20', '192.168.201.34', '15:02:07', NULL),
(1491, '', 'admin', '2021-04-20', '192.168.201.39', '15:18:50', NULL),
(1492, '', 'admin', '2021-04-21', '192.168.201.46', '09:44:14', NULL),
(1493, '', 'admin', '2021-04-21', '192.168.201.20', '09:47:59', NULL),
(1494, '', 'admin', '2021-04-21', '192.168.201.34', '09:49:31', NULL),
(1495, '', 'admin', '2021-04-21', '192.168.201.34', '10:29:03', NULL),
(1496, '', 'admin', '2021-04-21', '49.249.229.10', '12:04:24', NULL),
(1497, '', 'admin', '2021-04-21', '192.168.201.163', '13:02:00', NULL),
(1498, '', 'Rajeshwari', '2021-04-21', '192.168.201.163', '13:02:30', NULL),
(1499, '', 'admin', '2021-04-21', '192.168.201.20', '15:25:17', NULL),
(1500, '', 'admin', '2021-04-21', '192.168.201.46', '17:37:48', NULL),
(1501, '', 'admin', '2021-04-22', '192.168.201.41', '09:49:07', NULL),
(1502, '', 'admin', '2021-04-22', '192.168.201.163', '10:17:43', NULL),
(1503, '', 'Rajeshwari', '2021-04-22', '192.168.201.163', '10:18:51', NULL),
(1504, '', 'md', '2021-04-22', '192.168.201.163', '14:32:20', NULL),
(1505, '', 'admin', '2021-04-23', '192.168.201.163', '09:18:21', NULL),
(1506, '', 'md', '2021-04-23', '192.168.201.163', '11:10:37', NULL),
(1507, '', 'admin', '2021-04-23', '192.168.201.45', '17:35:11', NULL),
(1508, '', 'md', '2021-04-23', '192.168.201.45', '17:35:35', NULL),
(1509, '', 'Rajeshwari', '2021-04-23', '192.168.201.45', '17:36:21', NULL),
(1510, '', 'Gopinath', '2021-04-23', '192.168.201.45', '17:37:15', NULL),
(1511, '', 'admin', '2021-04-26', '192.168.201.46', '09:55:09', NULL),
(1512, '', 'Gopinath', '2021-04-26', '192.168.201.46', '09:56:04', NULL),
(1513, '', 'Rajeshwari', '2021-04-26', '192.168.201.46', '10:15:17', NULL),
(1514, '', 'admin', '2021-04-26', '192.168.201.46', '10:17:12', NULL),
(1515, '', 'Gopinath', '2021-04-26', '192.168.201.46', '10:26:27', NULL),
(1516, '', 'md', '2021-04-26', '192.168.201.46', '10:26:46', NULL),
(1517, '', 'Rajeshwari', '2021-04-26', '192.168.201.46', '10:27:05', NULL),
(1518, '', 'admin', '2021-04-26', '192.168.201.56', '15:17:59', NULL),
(1519, '', 'Rajeshwari', '2021-04-28', '49.249.229.10', '11:38:12', NULL),
(1520, '', 'admin', '2021-04-28', '49.249.229.10', '11:38:35', NULL),
(1521, '', 'admin', '2021-04-28', '192.168.201.46', '11:50:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `z_log_error`
--

DROP TABLE IF EXISTS `z_log_error`;
CREATE TABLE IF NOT EXISTS `z_log_error` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `ip_address` varchar(200) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_log_error`
--

INSERT INTO `z_log_error` (`id`, `user_name`, `password`, `ip_address`, `date`, `time`) VALUES
(1, 'Recruiter', 'Welcome@321', '::1', '2020-08-10', '23:58:19'),
(2, 'Recruiter', 'Welcome@321', '::1', '2020-08-10', '23:58:51'),
(3, 'Recruiter', 'Welcome@321', '::1', '2020-08-11', '00:00:05'),
(4, 'Intreviewer', 'WELCME@123', '192.168.201.109', '2020-08-12', '14:26:36'),
(5, 'Intreviewer', 'wELCOME@123', '192.168.201.109', '2020-08-12', '14:26:54'),
(6, 'Recruiter', 'Welcome@2020', '192.168.201.109', '2020-08-17', '19:24:11'),
(7, 'Recruiter', 'welcome@123', '192.168.201.109', '2020-08-17', '19:24:28'),
(8, 'admin', 'Welcome@2020', '192.168.201.109', '2020-08-18', '10:21:20'),
(9, 'Recruiter', 'wELCOME@123', '192.168.201.109', '2020-08-18', '10:35:48'),
(10, 'Recruiter', 'welcome@123', '::1', '2020-08-19', '18:47:16'),
(11, 'technical', 'welcome@123', '::1', '2020-08-22', '20:56:33'),
(12, 'Recruiter', 'welcome@123', '::1', '2020-08-24', '14:33:42'),
(13, 'Recruiter', 'Welcome', '::1', '2020-08-24', '14:34:00'),
(14, 'md', 'Welcome@123', '::1', '2020-08-26', '08:15:23'),
(15, 'md', 'Welcome@123', '::1', '2020-08-26', '08:15:41'),
(16, 'md', 'Welcome@123', '::1', '2020-08-26', '08:16:17'),
(17, 'admin', 'Welcme@123', '49.249.229.10', '2020-08-28', '11:31:18'),
(18, 'admin', 'Welcome123', '::1', '2020-09-01', '21:03:36'),
(19, 'md', 'Welcome@1233', '::1', '2020-09-01', '21:06:12'),
(20, 'candidate', 'Welocome@123', '::1', '2020-09-02', '17:07:28'),
(21, 'md', 'Welcoem@123', '::1', '2020-09-19', '20:24:46'),
(22, 'admin', 'WelcomeW@123', '::1', '2020-11-03', '13:14:45'),
(23, 'admin', 'Welcome2123', '10.225.1.78', '2020-11-14', '09:52:45'),
(24, 'admin', 'WElcome@123', '10.225.1.78', '2020-11-17', '16:39:31'),
(25, 'Recruiter', '123456', '192.168.200.114', '2020-11-17', '16:51:18'),
(26, 'admin', 'Welcoome@123', '192.168.200.16', '2020-11-19', '09:11:57'),
(27, 'technical', 'Welcome@!23', '192.168.200.114', '2020-11-20', '11:07:17'),
(28, 'balachandar', 'WElcome@123', '::1', '2020-11-20', '16:50:38'),
(29, 'admin', 'Welcome@2123', '192.168.201.15', '2021-02-16', '10:06:04'),
(30, 'admin', '123456', '192.168.201.15', '2021-02-16', '10:06:16'),
(31, 'admin', '123', '192.168.201.15', '2021-02-17', '10:09:03'),
(32, 'admin', '123456', '192.168.201.17', '2021-02-20', '10:30:45'),
(33, 'candidate', 'Welcome!@3', '192.168.201.17', '2021-02-20', '10:33:14'),
(34, 'Gopinath', 'Welcome@!23', '192.168.201.17', '2021-02-20', '10:36:28'),
(35, 'Recruiter', '123456', '192.168.201.17', '2021-02-20', '10:41:34'),
(36, 'admin', '123456', '192.168.201.176', '2021-02-20', '17:04:31'),
(37, 'admin', '123456', '192.168.201.176', '2021-02-22', '09:21:47'),
(38, 'admin', '123456', '192.168.201.176', '2021-02-22', '09:21:58'),
(39, 'admin', 'welcome@123', '192.168.201.15', '2021-02-22', '12:39:26'),
(40, 'Recruiter', 'Welcome@23', '192.168.201.12', '2021-02-22', '15:16:49'),
(41, 'md', 'welcome@123', '192.168.201.12', '2021-02-22', '16:12:49'),
(42, 'Gopinath', 'Welcome@2021', '192.168.201.12', '2021-02-22', '16:37:58'),
(43, 'admin', 'admin', '192.168.201.12', '2021-02-24', '15:43:16'),
(44, 'admin', 'Welcome2123', '192.168.201.12', '2021-02-24', '17:00:06'),
(45, 'admin', '231e@omlcWe', '192.168.201.176', '2021-02-25', '10:20:26'),
(46, 'technical', 'Welome@123', '192.168.201.15', '2021-03-01', '09:37:35'),
(47, 'hod', 'welcome@123', '192.168.201.15', '2021-03-01', '12:50:28'),
(48, 'technical', 'welcome@123', '192.168.201.15', '2021-03-01', '13:18:05'),
(49, 'hod', 'Welcome@1`23', '192.168.201.15', '2021-03-01', '13:21:38'),
(50, 'hod', 'welcome@123', '192.168.201.15', '2021-03-01', '14:44:47'),
(51, 'Gopinath', 'Welcome@!23', '192.168.201.15', '2021-03-01', '17:11:08'),
(52, 'admin', '', '192.168.201.15', '2021-03-02', '09:57:19'),
(53, 'hod', 'welcome@123', '192.168.201.15', '2021-03-02', '10:46:40'),
(54, 'technical', 'Welcome@1232', '192.168.201.15', '2021-03-02', '10:56:30'),
(55, '', '', '192.168.201.15', '2021-03-02', '11:01:33'),
(56, 'Ishwarya', 'Wlcome@123', '192.168.201.15', '2021-03-02', '11:04:42'),
(57, 'technical', 'Welcome@@123', '192.168.201.15', '2021-03-02', '15:40:22'),
(58, 'Gopinath', 'welcome@123', '192.168.201.15', '2021-03-02', '16:51:57'),
(59, 'hod', 'welcome@123', '192.168.201.15', '2021-03-03', '11:45:35'),
(60, 'technical1', 'Welcome@1`23', '192.168.201.15', '2021-03-03', '12:16:17'),
(61, 'Recruiter', '', '192.168.201.15', '2021-03-03', '14:35:36'),
(62, 'technical', 'Wecome@123', '192.168.201.15', '2021-03-03', '17:07:50'),
(63, 'technical', 'Welcome@1233', '192.168.201.15', '2021-03-03', '17:37:15'),
(64, 'md', 'welcome@123', '192.168.201.12', '2021-03-04', '10:04:50'),
(65, 'technical', 'Welcome@23', '192.168.201.12', '2021-03-04', '12:16:21'),
(66, 'Recruiter', 'Welconme@123', '192.168.201.12', '2021-03-05', '12:56:56'),
(67, 'Recruiter', 'Welcome123', '192.168.201.12', '2021-03-06', '10:18:10'),
(68, 'Recruiter', 'welcome@123', '192.168.201.12', '2021-03-06', '10:18:22'),
(69, 'technical', 'Welcome21123', '192.168.201.12', '2021-03-06', '10:19:44'),
(70, 'technical', 'Welcome123', '192.168.201.12', '2021-03-06', '12:27:04'),
(71, 'technical', 'Welcome@23', '192.168.201.12', '2021-03-06', '12:27:17'),
(72, 'admin', 'welcome@123', '192.168.201.12', '2021-03-06', '17:04:26'),
(73, 'Laxmi', 'Welcome@1223', '192.168.201.163', '2021-03-08', '15:25:38'),
(74, 'admin', '123', '192.168.201.14', '2021-03-15', '11:33:19'),
(75, '', '', '192.168.201.48', '2021-03-15', '11:45:09'),
(76, 'admin', '123456', '192.168.201.17', '2021-03-16', '10:41:32'),
(77, 'Uma', 'Welocme@123', '192.168.201.17', '2021-03-17', '10:58:52'),
(78, 'admin', 'Welcome@!123', '192.168.201.17', '2021-03-17', '12:15:49'),
(79, 'admin', '123', '192.168.201.15', '2021-03-17', '14:19:11'),
(80, 'admin', 'admin@123', '192.168.201.15', '2021-03-17', '14:20:56'),
(81, 'admin', '123', '192.168.201.10', '2021-03-18', '16:01:12'),
(82, 'admin', 'admin123', '192.168.201.10', '2021-03-18', '16:01:23'),
(83, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-20', '11:09:48'),
(84, 'Laxmipriya', 'Welcome123', '192.168.201.12', '2021-03-22', '09:19:39'),
(85, 'admin', 'Welcome123', '192.168.201.163', '2021-03-22', '09:37:22'),
(86, 'sindhu', 'sindhu@123', '192.168.201.41', '2021-03-22', '17:08:26'),
(87, 'sindhu', 'sindhu@123', '192.168.201.41', '2021-03-22', '17:11:13'),
(88, 'admin', 'admin', '192.168.201.40', '2021-03-22', '17:41:00'),
(89, 'admin', '123456', '192.168.201.40', '2021-03-22', '17:41:42'),
(90, '', '', '192.168.201.41', '2021-03-22', '17:49:02'),
(91, 'admin', 'Welcome123', '192.168.201.14', '2021-03-23', '09:38:59'),
(92, 'admin', 'admin@123', '192.168.201.15', '2021-03-23', '10:28:49'),
(93, 'admin', 'elcome@123', '192.168.201.12', '2021-03-23', '10:46:41'),
(94, 'admin', 'Welcome@23', '192.168.201.12', '2021-03-23', '10:46:53'),
(95, 'Laxmi Priya', 'Welcome123', '192.168.201.163', '2021-03-23', '14:24:08'),
(96, 'admin', 'WElcome@123', '192.168.201.14', '2021-03-23', '17:00:16'),
(97, 'admin', '', '192.168.201.12', '2021-03-24', '09:31:30'),
(98, 'Recruiter', 'Welcopme@123', '192.168.201.12', '2021-03-24', '17:16:13'),
(99, 'admin', 'Welcome@13', '192.168.201.12', '2021-03-26', '11:48:51'),
(100, 'admin', 'Welcome123', '192.168.201.12', '2021-03-26', '11:49:03'),
(101, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-26', '12:09:11'),
(102, 'md', '123456', '192.168.201.17', '2021-03-26', '16:20:32'),
(103, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-26', '16:24:48'),
(104, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-26', '16:24:57'),
(105, 'Recruiter', 'Welcome@13', '192.168.201.12', '2021-03-29', '09:09:39'),
(106, 'Recruiter', 'Welcome123', '192.168.201.12', '2021-03-29', '09:09:53'),
(107, 'admin', 'Weklcome@123', '192.168.201.17', '2021-03-29', '12:18:13'),
(108, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-29', '15:19:22'),
(109, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-29', '15:34:11'),
(110, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-29', '16:05:39'),
(111, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-29', '16:05:51'),
(112, 'md', 'Welcome@!23', '192.168.201.17', '2021-03-29', '16:07:04'),
(113, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-29', '17:15:47'),
(114, 'Recruiter', 'elcome@123', '192.168.201.12', '2021-03-29', '17:39:52'),
(115, 'Arunachalam', 'Welcom0e@123', '192.168.201.19', '2021-03-30', '09:53:40'),
(116, 'admin', '123', '192.168.201.161', '2021-03-30', '10:51:28'),
(117, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-30', '11:09:01'),
(118, 'admin', 'Welcome@!23', '192.168.201.17', '2021-03-30', '11:09:09'),
(119, 'Gopinath', 'Welcome@!23', '192.168.201.17', '2021-03-30', '12:10:16'),
(120, 'technical', 'Welcome@!23', '192.168.201.17', '2021-03-30', '16:09:26'),
(121, 'Sindhu ', 'Welcome123', '192.168.201.41', '2021-03-31', '14:41:57'),
(122, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-01', '10:45:34'),
(123, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-01', '10:56:17'),
(124, 'md', 'Welcome@!23', '192.168.201.17', '2021-04-01', '16:21:00'),
(125, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-01', '16:21:23'),
(126, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-01', '16:31:41'),
(127, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-01', '16:31:50'),
(128, 'admin', 'Welcoe@123', '192.168.201.12', '2021-04-02', '08:51:18'),
(129, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-02', '09:15:48'),
(130, 'Recruiter', 'Welcome@!23', '192.168.201.17', '2021-04-02', '10:38:58'),
(131, 'admin', '123456', '192.168.201.40', '2021-04-03', '11:39:43'),
(132, 'admin', '123', '192.168.201.15', '2021-04-05', '09:48:55'),
(133, ' ', '', '192.168.201.163', '2021-04-05', '10:30:03'),
(134, 'admin', 'Erlcome@123', '192.168.201.17', '2021-04-05', '11:58:49'),
(135, 'admin', '', '192.168.201.17', '2021-04-05', '12:48:50'),
(136, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-07', '12:49:42'),
(137, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-07', '12:49:52'),
(138, ' ', '', '192.168.201.20', '2021-04-07', '16:43:29'),
(139, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-08', '12:33:24'),
(140, 'admin', 'Welcome@!23', '192.168.201.17', '2021-04-08', '12:33:33'),
(141, ' ', '', '192.168.201.163', '2021-04-12', '10:13:11'),
(142, ' ', '', '192.168.201.163', '2021-04-12', '10:13:11'),
(143, ' ', '', '192.168.201.163', '2021-04-12', '10:13:32'),
(144, ' ', '', '192.168.201.163', '2021-04-12', '10:13:32'),
(145, 'resource', 'Welcome@123', '192.168.201.163', '2021-04-12', '11:20:34'),
(146, 'resource', 'Welcome@123', '192.168.201.163', '2021-04-12', '11:20:45'),
(147, 'resource', 'Welcome@123', '192.168.201.163', '2021-04-12', '11:20:54'),
(148, 'admin', 'welcome@123', '192.168.201.224', '2021-04-12', '14:06:22'),
(149, ' ', '', '192.168.201.163', '2021-04-15', '10:18:47'),
(150, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:03:47'),
(151, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:10:06'),
(152, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:10:15'),
(153, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:11:11'),
(154, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:11:28'),
(155, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:15:05'),
(156, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:15:12'),
(157, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:17:19'),
(158, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:18:04'),
(159, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:19:56'),
(160, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:20:44'),
(161, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:21:33'),
(162, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:21:55'),
(163, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:22:48'),
(164, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '13:23:08'),
(165, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '14:03:25'),
(166, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '14:04:03'),
(167, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '14:04:29'),
(168, 'New', 'Welcome@123', '192.168.201.163', '2021-04-15', '14:04:52'),
(169, 'New', '', '192.168.201.163', '2021-04-15', '14:05:31'),
(170, 'admin', 'Welome@123', '192.168.201.18', '2021-04-16', '09:37:41'),
(171, 'Jaikumar', 'Welome@123', '192.168.201.163', '2021-04-16', '12:12:55'),
(172, 'admin', 'Welcome@!23', '192.168.201.18', '2021-04-16', '14:51:33'),
(173, 'admin', '123456', '192.168.201.18', '2021-04-16', '16:36:31'),
(174, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:32:53'),
(175, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:33:05'),
(176, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:33:53'),
(177, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:34:28'),
(178, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:35:34'),
(179, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:35:52'),
(180, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:36:19'),
(181, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:36:33'),
(182, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:37:05'),
(183, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:37:32'),
(184, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:38:08'),
(185, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:39:01'),
(186, 'test', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:39:26'),
(187, 'test1', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:50:33'),
(188, 'test1', 'Welcome@123', '192.168.201.163', '2021-04-17', '09:50:58'),
(189, 'candid', 'Welcome@123', '192.168.201.163', '2021-04-19', '12:56:50'),
(190, 'candid', 'Welcome@123', '192.168.201.163', '2021-04-19', '14:19:04'),
(191, 'admin', 'Welcome@2020', '192.168.201.39', '2021-04-20', '15:18:23'),
(192, 'admin', 'Welcome@2021', '192.168.201.39', '2021-04-20', '15:18:36'),
(193, 'admin', 'welcome@123', '192.168.201.46', '2021-04-21', '17:32:38'),
(194, 'admin', 'Welcome@!23', '192.168.201.46', '2021-04-21', '17:37:37'),
(195, 'admin', 'admin@123', '192.168.201.41', '2021-04-22', '09:48:56'),
(196, 'Rajeshwari', 'Welcome@13', '192.168.201.163', '2021-04-22', '10:18:40'),
(197, 'hod', 'Welome@123', '192.168.201.45', '2021-04-23', '17:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `z_masters_menu`
--

DROP TABLE IF EXISTS `z_masters_menu`;
CREATE TABLE IF NOT EXISTS `z_masters_menu` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_description` varchar(255) DEFAULT NULL,
  `menu_order` varchar(255) DEFAULT NULL,
  `menu_class` varchar(255) DEFAULT NULL,
  `menu_url` varchar(255) DEFAULT NULL,
  `call_method` varchar(125) DEFAULT NULL,
  `created_by` int(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_masters_menu`
--

INSERT INTO `z_masters_menu` (`id`, `menu_name`, `menu_description`, `menu_order`, `menu_class`, `menu_url`, `call_method`, `created_by`, `created_on`) VALUES
(1, 'Recruitment', 'Form ', '1', 'fa fa-network-wired', 'Recruitment', 'recruitment()', 1, '2020-08-10 00:00:00'),
(2, 'Reports', 'Intreviewer Reports', '1', 'fa fa-list', 'Reports', 'reports()', 1, '2020-08-10 00:00:00'),
(4, 'Interview Question', 'Interview Question', '3', 'fa fa-list', 'Interview', 'interview()', 1, '2020-11-03 00:00:00'),
(5, 'Masters', 'Masters', '4', 'fa fa-list', 'Masters', 'masters()', 1, '2020-11-03 00:00:00'),
(6, 'Assessment', 'Assesment', '6', 'fa fa-list', 'Assesment', 'assesment()', 1, '2021-03-05 00:00:00'),
(7, 'Employee Assessment ', 'Employee Assessment Question', '7', 'fa fa-list', 'Assessment Question', 'assessment_question()', 1, '2021-03-05 00:00:00'),
(8, 'Payroll', 'Payroll', '8', 'fa fa-list', 'Payroll', 'Payroll()', 1, '2021-03-05 00:00:00'),
(9, 'Staff', 'Staff', '9', 'fa fa-list', 'staff', 'staff()', 1, '2021-03-19 00:00:00'),
(10, 'CRM', 'CRM', '10', 'fa fa-list', 'crm', 'crm()', 1, '2021-03-19 00:00:00'),
(12, 'Business Process', 'Business Process', '13', 'fa fa-list', 'Business Process', 'BusinessProcess()', 1, '2021-03-19 00:00:00'),
(13, 'Resource', 'Resource', '13', 'fa fa-list', 'Resource', 'resource()', 1, '2021-04-01 00:00:00'),
(14, 'Visitors', 'visitors', '14', 'fa fa-list', 'visitors', 'visitors()', 1, '2021-04-01 00:00:00'),
(15, 'Assets', 'Assets ', '15', 'fa fa-list', 'Assets', 'Assets()', 1, '2021-04-01 00:00:00'),
(17, 'Candidate Interview Question', 'Candidate Interview Question', '16', 'fa fa-list', 'Candidate Interview Question', 'candidate_qn()', 1, '2021-04-12 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `z_masters_sub_menu`
--

DROP TABLE IF EXISTS `z_masters_sub_menu`;
CREATE TABLE IF NOT EXISTS `z_masters_sub_menu` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `menu_id` int(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `call_method` varchar(255) DEFAULT NULL,
  `status` int(2) DEFAULT NULL,
  `created_by` int(2) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(2) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_masters_sub_menu`
--

INSERT INTO `z_masters_sub_menu` (`id`, `menu_id`, `name`, `call_method`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'Application Form', 'application()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(2, 1, 'Interview Feedback Form', 'feedback()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(3, 1, 'CTC Approval', 'ctc_approval()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(4, 2, 'Intreview Peoples', 'interview_reports()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(5, 2, 'Department Report', 'department_reports()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(11, 2, 'CTC Report', 'ctc_reports()', 1, 1, '2020-09-05 00:00:00', 1, '2020-09-05 00:00:00'),
(12, 3, 'Question ', 'question()', 1, 1, '2020-09-05 00:00:00', 1, '2020-09-05 00:00:00'),
(13, 3, 'Question Management', 'question_managements()', 1, 1, '2020-09-05 00:00:00', 1, '2020-09-05 00:00:00'),
(14, 3, 'Candidate Result', 'candicate_results()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(15, 1, 'Candidate Form', 'candidate_form()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(16, 5, 'Department Master', 'department_master()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(17, 5, 'Department Mapping', 'department_mapping()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(18, 5, 'Company Master', 'company_master()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(19, 6, 'Assessment Question', 'assesment_question()', 1, 1, '2021-03-05 00:00:00', 1, '2021-03-05 00:00:00'),
(20, 5, 'Question Name Master', 'question_name()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(21, 5, 'Section Master', 'section_master()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(22, 7, 'Employee Assessment Question', 'emp_assessment_question()', 1, 1, '2021-03-05 00:00:00', 1, '2021-03-05 00:00:00'),
(23, 6, 'Assessment Employee Master', 'assessment_employee()', 1, 1, '2021-03-05 00:00:00', 1, '2021-03-05 00:00:00'),
(24, 6, 'Assessment Employee Result', 'assessment_result()', 1, 1, '2021-03-09 00:00:00', 1, '2021-03-09 00:00:00'),
(25, 8, 'Attendance', 'Attendance()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(26, 8, 'Holidays', 'holidays()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(27, 8, 'Leaves', 'leave_master()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(28, 8, 'Scale', 'scale_master()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(29, 8, 'Deduction', 'deduction()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(30, 8, 'OD', 'od()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(31, 8, 'Payroll Generation', 'Payoll_generation()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(32, 8, 'payslip', 'pay_slip()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(33, 8, 'Payroll Close', 'Payroll_close()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(38, 8, 'Leave Management', 'leave_management()', 1, 1, '2021-03-11 00:00:00', 1, '2021-03-11 00:00:00'),
(39, 1, 'Document View and Approve', 'document_approve()', 1, 1, '2021-03-18 00:00:00', 1, '2021-03-18 00:00:00'),
(40, 5, 'Division Master', 'devision_master()', 1, 1, '2021-03-19 00:00:00', 1, '2021-03-19 00:00:00'),
(41, 5, 'Designation Master', 'designation_master()', 1, 1, '2021-03-19 00:00:00', 1, '2021-03-19 00:00:00'),
(42, 9, 'staff List', 'staff_list()', 1, 1, '2021-03-19 00:00:00', 1, '2021-03-19 00:00:00'),
(43, 2, 'Staff list report', 'staff_report()', 1, 1, '2021-03-20 00:00:00', 1, '2021-03-20 00:00:00'),
(44, 5, 'Interview Rounds', 'interview_rounds()', 1, 1, '2021-03-23 00:00:00', 1, '2021-03-23 00:00:00'),
(45, 5, 'Interview Rounds Mapping', 'interview_rounds_mapping()', 1, 1, '2021-03-23 00:00:00', 1, '2021-03-23 00:00:00'),
(46, 10, 'Enquiry', 'enquiry()', 1, 1, '2021-03-23 00:00:00', 1, '2021-03-23 00:00:00'),
(47, 5, 'Client Master', 'client_master()', 1, 1, '2021-03-30 00:00:00', 1, '2021-03-30 00:00:00'),
(48, 9, 'staff Asset', 'staff_asset()', 1, 1, '2021-03-30 00:00:00', 1, '2021-03-30 00:00:00'),
(49, 10, 'Lead', 'lead()', 1, 1, '2021-03-23 00:00:00', 1, '2021-03-23 00:00:00'),
(52, 1, 'Candidate List', 'interview_candidate_list()', 1, 1, '2021-03-31 00:00:00', 1, '2021-03-31 00:00:00'),
(51, 12, 'Quotation', 'Quotation()', 1, 1, '2021-03-30 00:00:00', 1, '2021-03-30 00:00:00'),
(53, 9, 'staff Asset Master', 'staff_asset_master()', 1, 1, '2021-03-31 00:00:00', 1, '2021-03-31 00:00:00'),
(54, 9, 'HOD', 'hod()', 1, 1, '2021-03-31 00:00:00', 1, '2021-03-31 00:00:00'),
(55, 5, 'Product Master', 'Product_master()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(56, 5, 'service_master', 'service_master()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(57, 5, 'calls_master', 'calls_master()', 1, 1, '2020-09-07 00:00:00', 1, '2020-09-05 00:00:00'),
(58, 5, 'Resource Master', 'resource_master()', 1, 1, '2021-04-01 00:00:00', 1, '2021-04-01 00:00:00'),
(59, 5, 'Feedback Master', 'feedback_master()', 1, 1, '2021-04-01 00:00:00', 1, '2021-04-01 00:00:00'),
(60, 12, 'vendor master', 'vendor_master()', 1, 1, '2021-04-01 00:00:00', 1, '2021-04-01 00:00:00'),
(61, 13, 'Resource Form', 'resource_form()', 1, 1, '2021-04-01 00:00:00', 1, '2021-04-01 00:00:00'),
(62, 13, 'Resource List', 'resource_list()', 1, 1, '2021-04-02 00:00:00', 1, '2021-04-02 00:00:00'),
(63, 14, 'Visitor Management', 'vms()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(64, 15, 'IT Form', 'Asset()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(65, 5, 'Role master', 'role()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(66, 12, 'Quotation approve', 'Quotation_approve()', 1, 1, '2021-03-30 00:00:00', 1, '2021-03-30 00:00:00'),
(67, 12, 'Quotation send', 'Quotation_send()', 1, 1, '2021-03-30 00:00:00', 1, '2021-03-30 00:00:00'),
(68, 15, 'Non IT Form', 'non_Asset()', 1, 1, '2020-08-10 00:00:00', 1, '2020-08-10 00:00:00'),
(69, 17, 'Candidate Interview Question', 'candidate_qn()\r\n', 1, 1, '2021-04-12 00:00:00', 1, '2021-04-12 00:00:00'),
(70, 9, 'Birthday List', 'birthday_list()', 1, 1, '2021-04-15 00:00:00', 1, '2021-04-15 00:00:00'),
(71, 10, 'Cost Sheet', 'cost()', 1, 1, '2021-03-23 00:00:00', 1, '2021-03-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `z_role_detail`
--

DROP TABLE IF EXISTS `z_role_detail`;
CREATE TABLE IF NOT EXISTS `z_role_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(200) NOT NULL,
  `menu_id` int(200) NOT NULL,
  `submenu_id` int(200) NOT NULL,
  `view_only` varchar(200) NOT NULL,
  `edit_only` int(200) NOT NULL,
  `all_only` varchar(50) NOT NULL,
  `approval` int(200) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=102 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_role_detail`
--

INSERT INTO `z_role_detail` (`id`, `code`, `menu_id`, `submenu_id`, `view_only`, `edit_only`, `all_only`, `approval`, `created_by`, `created_on`) VALUES
(1, 'Role-010', 1, 15, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(2, 'Role-002', 1, 2, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(4, 'Role-002', 2, 4, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(5, 'Role-003', 1, 1, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(6, 'Role-003', 1, 2, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(7, 'Role-003', 1, 3, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(8, 'Role-003', 2, 4, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(9, 'Role-002', 2, 5, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(10, 'Role-003', 2, 5, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(11, 'Role-004', 1, 2, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(12, 'Role-005', 1, 2, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(18, 'Role-003', 2, 11, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(19, 'Role-006', 4, 12, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(20, 'Role-003', 4, 13, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(21, 'Role-003', 4, 14, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(22, 'Role-003', 5, 16, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(23, 'Role-002', 5, 16, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(24, 'Role-002', 5, 17, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(25, 'Role-003', 5, 17, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(26, 'Role-003', 5, 18, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(27, 'Role-002', 5, 18, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(29, 'Role-008', 1, 2, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(30, 'Role-003', 6, 19, '0', 0, '1', 0, '1', '2021-03-05 00:00:00'),
(31, 'Role-003', 5, 20, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(32, 'Role-003', 5, 21, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(33, 'Role-003', 7, 22, '0', 0, '1', 0, '1', '2021-03-06 00:00:00'),
(34, 'Role-003', 6, 23, '0', 0, '1', 0, '1', '2021-03-05 00:00:00'),
(35, 'Role-003', 6, 24, '0', 0, '1', 0, '1', '2021-03-09 00:00:00'),
(36, 'Role-003', 8, 25, '0', 0, '1', 0, '1', '2021-03-11 00:00:00'),
(37, 'Role-003', 8, 26, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(38, 'Role-003', 8, 27, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(39, 'Role-003', 8, 28, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(40, 'Role-003', 8, 29, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(41, 'Role-003', 8, 30, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(42, 'Role-003', 8, 31, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(43, 'Role-003', 8, 32, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(45, 'Role-003', 8, 34, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(46, 'Role-003', 8, 35, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(48, 'Role-009', 1, 22, '0', 0, '1', 0, '1', '2021-03-17 00:00:00'),
(49, 'Role-007', 1, 1, '0', 0, '1', 0, '1', '2021-03-18 00:00:00'),
(50, 'Role-003', 8, 33, '0', 0, '1', 0, '1', '2021-03-17 00:00:00'),
(51, 'Role-003', 1, 39, '0', 0, '1', 0, '1', '2021-03-18 00:00:00'),
(52, 'Role-003', 5, 40, '0', 0, '1', 0, '1', '2021-03-19 00:00:00'),
(53, 'Role-003', 5, 41, '0', 0, '1', 0, '1', '2021-03-19 00:00:00'),
(54, 'Role-003', 9, 42, '0', 0, '1', 0, '1', '2021-03-19 00:00:00'),
(55, 'Role-003', 2, 43, '0', 0, '1', 0, '1', '2021-03-20 00:00:00'),
(56, 'Role-003', 5, 44, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(57, 'Role-003', 5, 45, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(58, 'Role-003', 10, 46, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(59, 'Role-007', 7, 22, '0', 0, '1', 0, '1', '2021-03-26 00:00:00'),
(60, 'ROLE-005', 10, 46, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(61, 'ROLE-007', 10, 46, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(62, 'ROLE-003', 5, 47, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(63, 'Role-003', 9, 48, '0', 0, '1', 0, '1', '2021-03-30 00:00:00'),
(64, 'ROLE-007', 10, 49, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(65, 'ROLE-005', 10, 49, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(66, 'Role-003', 11, 50, '0', 0, '1', 0, '1', '2020-08-31 00:00:00'),
(67, 'Role-003', 12, 51, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(68, 'Role-003', 1, 15, '0', 0, '1', 0, '1', '2021-03-31 00:00:00'),
(69, 'Role-003', 1, 52, '0', 0, '1', 0, '1', '2021-03-31 00:00:00'),
(70, 'Role-003', 9, 53, '0', 0, '1', 0, '1', '2021-03-31 00:00:00'),
(71, 'Role-003', 9, 54, '0', 0, '1', 0, '1', '2021-03-31 00:00:00'),
(72, 'Role-003', 5, 55, '0', 0, '1', 0, '1', '2021-03-31 00:00:00'),
(73, 'Role-003', 5, 56, '0', 0, '1', 0, '1', '2021-03-31 00:00:00'),
(74, 'Role-003', 5, 57, '0', 0, '1', 0, '1', '2021-03-31 00:00:00'),
(75, 'Role-003', 5, 58, '0', 0, '1', 0, '1', '2021-04-01 00:00:00'),
(76, 'Role-003', 5, 59, '0', 0, '1', 0, '1', '2021-04-01 00:00:00'),
(77, 'Role-003', 12, 60, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(78, 'ROLE-003', 10, 49, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(79, 'Role-003', 13, 61, '0', 0, '1', 0, '1', '2021-04-01 00:00:00'),
(80, 'Role-003', 13, 62, '0', 0, '1', 0, '1', '2021-04-02 00:00:00'),
(81, 'Role-003', 14, 63, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(82, 'ROLE-007', 14, 63, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(83, 'Role-003', 15, 64, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(84, 'Role-003', 5, 65, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(85, 'Role-003', 12, 66, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(86, 'Role-003', 12, 67, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(87, 'Role-003', 15, 68, '0', 0, '1', 0, '1', '2020-08-10 00:00:00'),
(88, 'Role-011', 17, 69, '0', 0, '1', 0, '1', '2021-04-12 00:00:00'),
(89, 'Role-012', 1, 1, '0', 0, '1', 0, '1', '2021-04-13 00:00:00'),
(90, 'Role-012', 7, 22, '0', 0, '1', 0, '1', '2021-04-13 00:00:00'),
(91, 'Role-012', 10, 46, '0', 0, '1', 0, '1', '2021-04-13 00:00:00'),
(92, 'Role-012', 10, 49, '0', 0, '1', 0, '1', '2021-04-13 00:00:00'),
(93, 'Role-012', 14, 63, '0', 0, '1', 0, '1', '2021-04-13 00:00:00'),
(96, 'Role-012', 1, 2, '0', 0, '1', 0, '1', '2021-04-13 00:00:00'),
(97, 'Role-003', 9, 70, '0', 0, '1', 0, '1', '2021-04-15 00:00:00'),
(98, 'ROLE-003', 10, 71, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(99, 'ROLE-007', 10, 71, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(100, 'ROLE-005', 10, 71, '0', 0, '1', 0, '1', '2021-03-23 00:00:00'),
(101, 'ROLE-008', 10, 71, '0', 0, '1', 0, '1', '2021-03-23 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `z_role_mapping`
--

DROP TABLE IF EXISTS `z_role_mapping`;
CREATE TABLE IF NOT EXISTS `z_role_mapping` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(200) NOT NULL,
  `code` varchar(200) NOT NULL,
  `descriptions` varchar(100) DEFAULT NULL,
  `modified_by` varchar(150) NOT NULL,
  `modified_on` date NOT NULL,
  `created_by` varchar(150) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_role_mapping`
--

INSERT INTO `z_role_mapping` (`id`, `user_id`, `code`, `descriptions`, `modified_by`, `modified_on`, `created_by`, `created_on`) VALUES
(1, '1', 'Role-001', 'Recruitment', '1', '2020-08-10', '1', '2020-08-10'),
(2, '2', 'Role-002', 'Intreviewer', '1', '2020-08-10', '1', '2020-08-10'),
(3, '4', 'Role-004', 'Technical', '1', '2020-08-10', '1', '2020-08-10'),
(4, '14', 'Role-006', 'HOD', '1', '2020-08-10', '1', '2020-08-10');

-- --------------------------------------------------------

--
-- Table structure for table `z_role_master`
--

DROP TABLE IF EXISTS `z_role_master`;
CREATE TABLE IF NOT EXISTS `z_role_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(250) NOT NULL,
  `role_name` varchar(200) NOT NULL,
  `status` int(250) DEFAULT '1',
  `created_on` date NOT NULL,
  `created_by` varchar(50) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_role_master`
--

INSERT INTO `z_role_master` (`id`, `code`, `role_name`, `status`, `created_on`, `created_by`) VALUES
(1, 'ROLE-001', 'Intreviewer', 1, '2020-08-10', '1'),
(2, 'ROLE-002', 'Recruiter', 1, '0000-00-00', '1'),
(3, 'ROLE-003', 'Admin', 1, '0000-00-00', '1'),
(4, 'ROLE-004', 'Technical', 1, '2020-08-19', '1'),
(5, 'ROLE-005', 'Md', 1, '2020-04-24', '1'),
(6, 'ROLE-006', 'Candidate Interview Question', 1, '2020-04-24', '1'),
(7, 'ROLE-007', 'Employee', 1, '2020-04-24', '1'),
(8, 'ROLE-008', 'HOD', 1, '2020-04-24', '1'),
(9, 'ROLE-009', 'Employee Assessment Question', 1, '2021-03-05', '1'),
(10, 'ROLE-010', 'Resource', 1, '2021-04-05', '1'),
(12, 'ROLE-011', 'Candidate Interview Question', 1, '2021-04-12', '1'),
(13, 'ROLE-012', 'Php Technical', 1, '2021-04-13', '1'),
(14, 'R003', 'HR', 1, '2021-04-16', '1'),
(15, 'R001', 'Managing Director', 1, '2021-04-16', '1'),
(16, 'R002', 'General Manager', 1, '2021-04-16', '1'),
(17, 'R004', 'Accounts', 1, '2021-04-16', '1'),
(18, 'R005', 'Senior Manager - Technical', 1, '2021-04-16', '1'),
(19, 'R006', 'Senior Developer', 1, '2021-04-16', '1'),
(20, 'R007', 'Junior Developer', 1, '2021-04-16', '1'),
(21, 'R008', 'Developer', 1, '2021-04-16', '1'),
(22, 'R009', 'Technical Trainee', 1, '2021-04-16', '1'),
(23, 'R010', 'Designer', 1, '2021-04-16', '1'),
(24, 'R011', 'Digital Marketing', 1, '2021-04-16', '1'),
(25, 'R012', 'Marketing', 1, '2021-04-16', '1'),
(26, 'R013', 'Purchase', 1, '2021-04-16', '1'),
(27, 'R014', 'Networking', 1, '2021-04-16', '1');

-- --------------------------------------------------------

--
-- Table structure for table `z_user_master`
--

DROP TABLE IF EXISTS `z_user_master`;
CREATE TABLE IF NOT EXISTS `z_user_master` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `ass_emp_id` int(11) DEFAULT NULL,
  `candidate_id` int(100) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `user_name` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `email_id` varchar(250) DEFAULT NULL,
  `user_group_code` varchar(250) DEFAULT NULL,
  `mobile_no` varchar(200) DEFAULT NULL,
  `profile` varchar(250) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `created_by` varchar(200) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_by` varchar(250) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `z_user_master`
--

INSERT INTO `z_user_master` (`user_id`, `ass_emp_id`, `candidate_id`, `department`, `user_name`, `password`, `full_name`, `status`, `email_id`, `user_group_code`, `mobile_no`, `profile`, `gender`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 0, NULL, '1', 'candidate', 'cd84d683cc5612c69efe115c80d0b7dc', 'Intreviewer', 1, 'hr@quadsel.in', 'ROLE-001', '9876543211', 'userlog/intreviewer.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(2, 0, NULL, '2', 'Recruiter', 'cd84d683cc5612c69efe115c80d0b7dc', 'Recruiter', 1, 'hr@quadsel.in', 'ROLE-002', '9876543211', 'userlog/hr.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(3, 0, NULL, '2', 'admin', 'cd84d683cc5612c69efe115c80d0b7dc', 'Admin', 1, 'hr@admin.in', 'ROLE-003', '9876543211', 'userlog/hr.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(4, 0, NULL, '3', 'technical', 'cd84d683cc5612c69efe115c80d0b7dc', 'Technical', 1, 'hr@admin.in', 'ROLE-004', '9876543211', 'userlog/hr.png', 'male', '1', '2020-08-10', '1', '2020-08-10 09:31:47'),
(5, 0, NULL, '2', 'md', 'cd84d683cc5612c69efe115c80d0b7dc', 'Md', 1, 'hr@quadsel.in', 'ROLE-005', '9876543211', '', 'male', '1', '2020-08-10', '1', '2020-08-10 00:00:00'),
(14, 0, NULL, '3', 'hod', 'cd84d683cc5612c69efe115c80d0b7dc', 'HOD', 1, 'hr@admin.in', 'ROLE-008', '9876543211', NULL, 'male', '1', '2021-03-01', '1', '2021-03-01 09:31:47'),
(15, 0, NULL, '3', 'technical1', 'cd84d683cc5612c69efe115c80d0b7dc', 'Technical1', 1, 'hr@admin.in', 'ROLE-008', '9876543211', NULL, 'male', '1', '2021-03-01', '1', '2021-03-01 09:31:47'),
(42, NULL, 1, '6', 'Rajeshwari', 'cd84d683cc5612c69efe115c80d0b7dc', 'Rajeshwari', 1, '', 'ROLE-008', '', NULL, 'female', '1', '2021-03-24', NULL, NULL),
(43, NULL, 2, '3', 'Jaikumar', 'cd84d683cc5612c69efe115c80d0b7dc', 'Jaikumar', 1, '', 'ROLE-012', '', NULL, 'male', '1', '2021-03-24', NULL, NULL),
(44, NULL, 3, '6', 'Girish Madhavan', 'cd84d683cc5612c69efe115c80d0b7dc', 'Girish Madhavan', 1, '', 'ROLE-006', '', NULL, 'male', '1', '2021-03-25', NULL, NULL),
(45, NULL, 4, '6', 'Ramakrishnan', 'cd84d683cc5612c69efe115c80d0b7dc', 'Ramakrishnan', 1, '', 'ROLE-006', '', NULL, 'male', '1', '2021-03-25', NULL, NULL),
(46, NULL, 5, '3', 'laxmipriya', 'cd84d683cc5612c69efe115c80d0b7dc', 'laxmipriya', 1, '', 'ROLE-012', '', NULL, 'female', '1', '2021-03-25', NULL, NULL),
(47, NULL, 6, '3', 'Gopinath', 'cd84d683cc5612c69efe115c80d0b7dc', 'Gopinath', 1, '', 'ROLE-007', '', NULL, 'male', '1', '2021-03-25', NULL, NULL),
(48, NULL, 7, '3', 'Umadevi', 'cd84d683cc5612c69efe115c80d0b7dc', 'Umadevi', 1, '', 'ROLE-007', '', NULL, 'female', '1', '2021-03-25', NULL, NULL),
(49, NULL, 8, '3', 'Sindhu ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Sindhu G', 1, '', 'ROLE-007', '', NULL, 'female', '1', '2021-03-25', NULL, NULL),
(50, NULL, 9, '2', 'Sebastain', 'cd84d683cc5612c69efe115c80d0b7dc', 'Sebastain', 1, '', 'ROLE-007', '', NULL, 'male', '1', '2021-03-25', NULL, NULL),
(51, NULL, 10, '3', 'Rizwana', 'cd84d683cc5612c69efe115c80d0b7dc', 'Rizwana', 1, '', 'ROLE-007', '', NULL, 'female', '1', '2021-03-25', NULL, NULL),
(52, NULL, 11, '3', 'Mohana Krishnan', 'cd84d683cc5612c69efe115c80d0b7dc', 'Mohana Krishnan (Android)', 1, '', 'ROLE-007', '', NULL, 'male', '1', '2021-03-25', NULL, NULL),
(53, NULL, 12, '2', 'Meena', 'cd84d683cc5612c69efe115c80d0b7dc', 'Meena', 1, '', 'ROLE-007', '', NULL, 'female', '1', '2021-03-25', NULL, NULL),
(55, NULL, 15, '3', 'Vanitha', 'cd84d683cc5612c69efe115c80d0b7dc', 'Vanitha', 1, '', 'ROLE-007', '', NULL, 'female', '1', '2021-03-25', NULL, NULL),
(56, NULL, 16, '2', 'Jefferson', 'cd84d683cc5612c69efe115c80d0b7dc', 'Jefferson', 1, '', 'ROLE-007', '', NULL, 'male', '1', '2021-03-25', NULL, NULL),
(57, NULL, 17, '9', 'Arunachalam', 'cd84d683cc5612c69efe115c80d0b7dc', 'Arunachalam', 1, '', 'ROLE-007', '', NULL, 'male', '1', '2021-03-25', NULL, NULL),
(64, NULL, 22, '3', ' ', ' ', 'test', 1, 'xxxx@gmail.com', 'ROLE-006', '9790218732', NULL, 'male', '3', '2021-04-01', NULL, NULL),
(65, NULL, 35, '3', 'resource', 'cd84d683cc5612c69efe115c80d0b7dc', 'resource', 1, 'xxxx@gmail.com', 'ROLE-011', '+91 9790218732', NULL, 'male', '46', '2021-04-08', NULL, NULL),
(66, NULL, 36, '3', ' test', 'cd84d683cc5612c69efe115c80d0b7dc', 'test', 2, 'xxxx@gmail.com', 'ROLE-006', '+91 +91 9790218732', NULL, 'male', '2', '2021-04-13', NULL, NULL),
(67, NULL, 37, 'Development', 'New', 'cd84d683cc5612c69efe115c80d0b7dc', 'NewResource', 1, 'xxxx@gmail.com', 'ROLE-011', '+91 +91 9790218732', NULL, 'male', '3', '2021-04-15', NULL, NULL),
(68, NULL, 38, '3', 'test', 'cd84d683cc5612c69efe115c80d0b7dc', 'testUI', 1, 'xxxx@gmail.com', 'ROLE-011', ' +91 9790218732', NULL, 'male', '4', '2021-04-17', NULL, NULL),
(69, NULL, 39, '3', 'test1', 'cd84d683cc5612c69efe115c80d0b7dc', 'test1SD', 1, 'xxxx@gmail.com', 'ROLE-011', ' +91 9790218732', NULL, 'male', '5', '2021-04-17', NULL, NULL),
(70, NULL, 40, '3', 'candid', 'cd84d683cc5612c69efe115c80d0b7dc', 'candidresource', 1, 'xxxx@gmail.com', 'ROLE-007', ' +91 9790218732', NULL, 'male', '6', '2021-04-19', NULL, NULL),
(71, NULL, 41, '3', 'canresource', 'cd84d683cc5612c69efe115c80d0b7dc', 'canresourcetechnical', 1, 'xxxx@gmail.com', 'ROLE-011', ' +91 9790218732', NULL, 'male', '7', '2021-04-19', NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
