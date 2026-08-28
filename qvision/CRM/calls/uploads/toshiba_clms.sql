-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 06, 2024 at 04:49 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toshiba_clms`
--

-- --------------------------------------------------------

--
-- Table structure for table `dbo.accident_master`
--

DROP TABLE IF EXISTS `dbo.accident_master`;
CREATE TABLE IF NOT EXISTS `dbo.accident_master` (
  `id` varchar(0) DEFAULT NULL,
  `employee_id` varchar(0) DEFAULT NULL,
  `emp_name` varchar(0) DEFAULT NULL,
  `shift` varchar(0) DEFAULT NULL,
  `gender` varchar(0) DEFAULT NULL,
  `work_area` varchar(0) DEFAULT NULL,
  `job_nature` varchar(0) DEFAULT NULL,
  `register` varchar(0) DEFAULT NULL,
  `address` varchar(0) DEFAULT NULL,
  `Precise` varchar(0) DEFAULT NULL,
  `description` varchar(0) DEFAULT NULL,
  `valid_from` varchar(0) DEFAULT NULL,
  `place` varchar(0) DEFAULT NULL,
  `involves_explosion` varchar(0) DEFAULT NULL,
  `involves_fire` varchar(0) DEFAULT NULL,
  `no_persons_injuired` varchar(0) DEFAULT NULL,
  `no_persons_injuired_inside_factory` varchar(0) DEFAULT NULL,
  `no_persons_injuired_outside_factory` varchar(0) DEFAULT NULL,
  `no_persons_killed` varchar(0) DEFAULT NULL,
  `no_persons_killed_inside_factory` varchar(0) DEFAULT NULL,
  `no_persons_killed_outside_factory` varchar(0) DEFAULT NULL,
  `cause_explosion` varchar(0) DEFAULT NULL,
  `cause_fire` varchar(0) DEFAULT NULL,
  `Toxic` varchar(0) DEFAULT NULL,
  `Other` varchar(0) DEFAULT NULL,
  `fatal` varchar(0) DEFAULT NULL,
  `non_fatal` varchar(0) DEFAULT NULL,
  `morethan` varchar(0) DEFAULT NULL,
  `location_injury` varchar(0) DEFAULT NULL,
  `hazardous` varchar(0) DEFAULT NULL,
  `hour` varchar(0) DEFAULT NULL,
  `wages` varchar(0) DEFAULT NULL,
  `traveling` varchar(0) DEFAULT NULL,
  `employeer` varchar(0) DEFAULT NULL,
  `behalf_employeer` varchar(0) DEFAULT NULL,
  `transport` varchar(0) DEFAULT NULL,
  `nature` varchar(0) DEFAULT NULL,
  `purpose_of_employeer` varchar(0) DEFAULT NULL,
  `Physician` varchar(0) DEFAULT NULL,
  `dispensary` varchar(0) DEFAULT NULL,
  `withness_one` varchar(0) DEFAULT NULL,
  `withness_two` varchar(0) DEFAULT NULL,
  `cause` varchar(0) DEFAULT NULL,
  `upload` varchar(0) DEFAULT NULL,
  `status` varchar(0) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.addressmaster`
--

DROP TABLE IF EXISTS `dbo.addressmaster`;
CREATE TABLE IF NOT EXISTS `dbo.addressmaster` (
  `id` tinyint(4) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `valid_from` varchar(10) DEFAULT NULL,
  `valid_to` varchar(10) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.addressmaster`
--

INSERT INTO `dbo.addressmaster` (`id`, `address`, `valid_from`, `valid_to`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'TOSHIBA JSW POWER SYSTEMS PVT. LTD. , S.No : 74-95, Vaikkadu Village, Andarkuppam Check Post, Manali New Town, Chennai - 600 103', '2017-11-10', '2020-11-10', 0, 1, '2017-11-10', '', '2017-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.approve_access`
--

DROP TABLE IF EXISTS `dbo.approve_access`;
CREATE TABLE IF NOT EXISTS `dbo.approve_access` (
  `id` tinyint(4) DEFAULT NULL,
  `menu` tinyint(4) DEFAULT NULL,
  `user_id` tinyint(4) DEFAULT NULL,
  `status` varchar(0) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `created_by` varchar(8) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `modified_by` varchar(8) DEFAULT NULL,
  `modified_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.approve_access`
--

INSERT INTO `dbo.approve_access` (`id`, `menu`, `user_id`, `status`, `date`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(44, 1, 70, '', '2019-07-15', '120287TJ', '2019-07-15 04:42:55', '120287TJ', '2019-07-15 04:43:04'),
(28, 4, 1, '', '2018-02-23', '120287Tj', '2018-02-23 08:57:55', '', ''),
(3, 2, 19, '', '2017-11-16', '120287TJ', '2017-11-16 10:10:16', '', ''),
(45, 3, 71, '', '2019-10-17', '120287TJ', '2019-10-17 04:29:06', '', ''),
(6, 3, 30, '', '2017-11-24', '120287tj', '2017-11-24 07:14:30', '', ''),
(7, 3, 31, '', '2017-11-24', '120287tj', '2017-11-24 07:14:46', '', ''),
(11, 2, 37, '', '2018-01-31', '120287TJ', '2018-01-31 08:25:58', '', ''),
(12, 2, 39, '', '2018-01-31', '120287TJ', '2018-01-31 08:26:10', '', ''),
(17, 1, 42, '', '2018-02-10', '120287TJ', '2018-02-10 09:29:24', '', ''),
(23, 1, 48, '', '2018-02-10', '120287TJ', '2018-02-10 09:30:31', '', ''),
(26, 4, 51, '', '2018-02-15', '120287TJ', '2018-02-15 10:34:06', '', ''),
(32, 1, 57, '', '2018-09-17', '120287TJ', '2018-09-17 06:00:16', '', ''),
(34, 1, 59, '', '2018-09-17', '120287TJ', '2018-09-17 06:00:34', '', ''),
(43, 3, 69, '', '2018-12-13', '120287TJ', '2018-12-13 03:20:05', '', ''),
(15, 1, 34, '', '2018-02-02', '120287TJ', '2018-02-02 05:26:09', '120287TJ', '2018-02-12 06:29:21'),
(24, 2, 49, '', '2018-02-15', '120287TJ', '2018-02-15 08:26:06', '', ''),
(27, 1, 21, '', '2018-02-16', '110101TJ', '2018-02-16 06:50:44', '', ''),
(36, 1, 62, '', '2018-09-17', '120287TJ', '2018-09-17 06:00:55', '', ''),
(37, 1, 63, '', '2018-09-17', '120287TJ', '2018-09-17 06:01:04', '', ''),
(38, 1, 64, '', '2018-09-17', '120287TJ', '2018-09-17 06:01:13', '', ''),
(39, 1, 65, '', '2018-09-17', '120287TJ', '2018-09-17 06:01:21', '', ''),
(40, 1, 66, '', '2018-09-17', '120287TJ', '2018-09-17 06:01:29', '', ''),
(42, 1, 68, '', '2018-09-17', '120287TJ', '2018-09-17 06:01:47', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.approve_menu_name`
--

DROP TABLE IF EXISTS `dbo.approve_menu_name`;
CREATE TABLE IF NOT EXISTS `dbo.approve_menu_name` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(19) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.approve_menu_name`
--

INSERT INTO `dbo.approve_menu_name` (`id`, `name`, `status`) VALUES
(1, 'Incharge Approve', 0),
(2, 'Procurement Approve', 0),
(3, 'HSE Approve', 0),
(4, 'HR Approve', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dbo.audit_compliance`
--

DROP TABLE IF EXISTS `dbo.audit_compliance`;
CREATE TABLE IF NOT EXISTS `dbo.audit_compliance` (
  `id` tinyint(4) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `sub_law_id_1` tinyint(4) DEFAULT NULL,
  `sub_law_id_2` tinyint(4) DEFAULT NULL,
  `sub_law_id_3` tinyint(4) DEFAULT NULL,
  `sub_law_id_4` tinyint(4) DEFAULT NULL,
  `sub_law_id_5` tinyint(4) DEFAULT NULL,
  `sub_law_id_6` tinyint(4) DEFAULT NULL,
  `sub_law_id_7` tinyint(4) DEFAULT NULL,
  `sub_law_id_8` tinyint(4) DEFAULT NULL,
  `sub_law_id_9` tinyint(4) DEFAULT NULL,
  `sub_law_id_10` tinyint(4) DEFAULT NULL,
  `sub_law_id_11` tinyint(4) DEFAULT NULL,
  `sub_law_id_12` tinyint(4) DEFAULT NULL,
  `sub_law_id_13` tinyint(4) DEFAULT NULL,
  `sub_law_id_14` tinyint(4) DEFAULT NULL,
  `sub_law_id_15` tinyint(4) DEFAULT NULL,
  `sub_law_id_16` tinyint(4) DEFAULT NULL,
  `sub_law_id_17` tinyint(4) DEFAULT NULL,
  `sub_law_id_18` tinyint(4) DEFAULT NULL,
  `sub_law_id_19` tinyint(4) DEFAULT NULL,
  `sub_law_id_20` tinyint(4) DEFAULT NULL,
  `sub_law_id_21` tinyint(4) DEFAULT NULL,
  `sub_law_id_22` tinyint(4) DEFAULT NULL,
  `sub_law_id_23` tinyint(4) DEFAULT NULL,
  `sub_law_id_24` tinyint(4) DEFAULT NULL,
  `sub_law_id_25` tinyint(4) DEFAULT NULL,
  `sub_law_id_26` tinyint(4) DEFAULT NULL,
  `sub_law_id_27` tinyint(4) DEFAULT NULL,
  `legal_compliance_yes` varchar(0) DEFAULT NULL,
  `legal_non_compliance_no` varchar(0) DEFAULT NULL,
  `legal_non_compliance_completed` varchar(0) DEFAULT NULL,
  `remarks` varchar(5) DEFAULT NULL,
  `month` varchar(7) DEFAULT NULL,
  `year` smallint(6) DEFAULT NULL,
  `upload` varchar(0) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `remarks1` varchar(3) DEFAULT NULL,
  `remarks2` varchar(8) DEFAULT NULL,
  `remarks3` varchar(5) DEFAULT NULL,
  `remarks4` varchar(5) DEFAULT NULL,
  `remarks5` varchar(6) DEFAULT NULL,
  `remarks6` varchar(5) DEFAULT NULL,
  `remarks7` varchar(5) DEFAULT NULL,
  `remarks8` varchar(5) DEFAULT NULL,
  `remarks9` varchar(5) DEFAULT NULL,
  `remarks10` varchar(4) DEFAULT NULL,
  `remarks11` varchar(4) DEFAULT NULL,
  `remarks12` varchar(4) DEFAULT NULL,
  `remarks13` varchar(4) DEFAULT NULL,
  `remarks14` varchar(14) DEFAULT NULL,
  `remarks15` varchar(7) DEFAULT NULL,
  `remarks16` varchar(6) DEFAULT NULL,
  `remarks17` varchar(0) DEFAULT NULL,
  `remarks18` varchar(0) DEFAULT NULL,
  `remarks19` varchar(0) DEFAULT NULL,
  `remarks20` varchar(0) DEFAULT NULL,
  `remarks21` varchar(5) DEFAULT NULL,
  `remarks22` varchar(5) DEFAULT NULL,
  `remarks23` varchar(6) DEFAULT NULL,
  `remarks24` varchar(10) DEFAULT NULL,
  `remarks25` varchar(5) DEFAULT NULL,
  `remarks26` varchar(7) DEFAULT NULL,
  `remarks27` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.audit_compliance`
--

INSERT INTO `dbo.audit_compliance` (`id`, `contractor_code`, `sub_law_id_1`, `sub_law_id_2`, `sub_law_id_3`, `sub_law_id_4`, `sub_law_id_5`, `sub_law_id_6`, `sub_law_id_7`, `sub_law_id_8`, `sub_law_id_9`, `sub_law_id_10`, `sub_law_id_11`, `sub_law_id_12`, `sub_law_id_13`, `sub_law_id_14`, `sub_law_id_15`, `sub_law_id_16`, `sub_law_id_17`, `sub_law_id_18`, `sub_law_id_19`, `sub_law_id_20`, `sub_law_id_21`, `sub_law_id_22`, `sub_law_id_23`, `sub_law_id_24`, `sub_law_id_25`, `sub_law_id_26`, `sub_law_id_27`, `legal_compliance_yes`, `legal_non_compliance_no`, `legal_non_compliance_completed`, `remarks`, `month`, `year`, `upload`, `created_by`, `created_on`, `remarks1`, `remarks2`, `remarks3`, `remarks4`, `remarks5`, `remarks6`, `remarks7`, `remarks8`, `remarks9`, `remarks10`, `remarks11`, `remarks12`, `remarks13`, `remarks14`, `remarks15`, `remarks16`, `remarks17`, `remarks18`, `remarks19`, `remarks20`, `remarks21`, `remarks22`, `remarks23`, `remarks24`, `remarks25`, `remarks26`, `remarks27`) VALUES
(1, 'CON-001', 0, 0, 1, 1, 1, 0, 1, 0, 0, 1, 0, 1, 0, 1, 1, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, '', '', '', '54165', 'March', 2018, '', 1, '2018-03-27', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(2, 'CON-002', 0, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 1, 0, 1, 0, 0, 1, 0, 0, 1, 0, 0, 1, 1, '', '', '', 'test', 'March', 2016, '', 1, '2018-05-18', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'CON-001', 0, 1, 0, 1, 0, 1, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, 1, 1, 0, '', '', '', '', 'January', 2018, '', 1, '2018-05-25', 'kll', 'lklklklk', 'lklkl', 'lklkl', 'lklklk', 'lklkl', 'lkllk', 'lklkl', 'lklkl', 'lkll', 'l;l;', ';414', ';l;;', 'klkllklklklklk', 'lklklkl', 'lklklk', '', '', '', '', 'lklkl', 'lklkl', 'lklklk', 'klklklklkl', 'lklkl', 'lklklkl', 'lklkl');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.blood_group`
--

DROP TABLE IF EXISTS `dbo.blood_group`;
CREATE TABLE IF NOT EXISTS `dbo.blood_group` (
  `id` tinyint(4) DEFAULT NULL,
  `blood` varchar(3) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(1) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.blood_group`
--

INSERT INTO `dbo.blood_group` (`id`, `blood`, `status`, `created_by`, `created_on`) VALUES
(1, 'AB+', 0, '', ''),
(2, 'AB-', 0, '', ''),
(3, 'O+', 0, '', ''),
(4, 'O-', 0, '', ''),
(5, 'B+', 0, '', ''),
(6, 'B-', 0, '', ''),
(7, 'A1+', 0, '1', '2018-02-23');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.color_code`
--

DROP TABLE IF EXISTS `dbo.color_code`;
CREATE TABLE IF NOT EXISTS `dbo.color_code` (
  `id` tinyint(4) DEFAULT NULL,
  `color_code` varchar(7) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.color_code`
--

INSERT INTO `dbo.color_code` (`id`, `color_code`) VALUES
(1, '#337ab7'),
(2, '#96b711'),
(3, '#179b77'),
(4, '#246679'),
(5, '#352479'),
(6, '#097917'),
(7, '#793d09'),
(8, '#8a6d3b'),
(9, '#337ab7'),
(10, '#96b711'),
(11, '#179b77'),
(12, '#246679'),
(13, '#352479'),
(14, '#097917'),
(15, '#793d09'),
(16, '#8a6d3b');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_aggrement`
--

DROP TABLE IF EXISTS `dbo.contractor_aggrement`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_aggrement` (
  `aggrement_id` tinyint(4) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `aggrement_number` mediumint(9) DEFAULT NULL,
  `aggrement_upload` varchar(5) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `is_deviation` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `remarks` varchar(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_aggrement`
--

INSERT INTO `dbo.contractor_aggrement` (`aggrement_id`, `contractor_code`, `aggrement_number`, `aggrement_upload`, `from_date`, `to_date`, `is_deviation`, `status`, `remarks`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CON-003', 12275, 'Array', '2017-08-02', '2017-10-07', 1, 0, 'NULL', '1         ', '2017-11-22 11:59:10', '', '2017-11-22 11:59:10');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_contract_license`
--

DROP TABLE IF EXISTS `dbo.contractor_contract_license`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_contract_license` (
  `contract_license_id` tinyint(4) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `license_number` varchar(12) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `max_workers` smallint(6) DEFAULT NULL,
  `active_workers` varchar(0) DEFAULT NULL,
  `wage_period` varchar(0) DEFAULT NULL,
  `license_upload` varchar(78) DEFAULT NULL,
  `agreement_upload` varchar(0) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_deviation` tinyint(4) DEFAULT NULL,
  `remarks` varchar(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_contract_license`
--

INSERT INTO `dbo.contractor_contract_license` (`contract_license_id`, `contractor_code`, `license_number`, `from_date`, `to_date`, `max_workers`, `active_workers`, `wage_period`, `license_upload`, `agreement_upload`, `status`, `is_deviation`, `remarks`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CON-002', '43/2013', '2016-12-31', '2018-12-31', 40, '', '', '/TOSHIBA/images/Contractor/license/CON-002-orignal labour licence sri jaya.pdf', '', 0, 1, '  ', '1         ', '2017-11-22', '', '2017-11-22'),
(2, 'CON-008', '351/CNI', '2016-01-01', '2017-12-31', 200, '', '', '/TOSHIBA/images/Contractor/license/CON-008-', '', 0, 1, 'NULL', '1         ', '2017-11-22', '', '2017-11-22'),
(3, 'CON-168', '2200129367  ', '2018-05-25', '2019-05-24', 3, '', '', '/TOSHIBA/images/Contractor/license/CON-168-', '', 0, 1, 'NULL', '53        ', '2018-09-20', '', '2018-09-20');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_ec_policy`
--

DROP TABLE IF EXISTS `dbo.contractor_ec_policy`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_ec_policy` (
  `ec_id` tinyint(4) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `ec_policy_number` varchar(29) DEFAULT NULL,
  `ec_policy_upload` varchar(44) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `max_workers` smallint(6) DEFAULT NULL,
  `active_workers` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_deviation` tinyint(4) DEFAULT NULL,
  `remarks` varchar(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_ec_policy`
--

INSERT INTO `dbo.contractor_ec_policy` (`ec_id`, `contractor_code`, `ec_policy_number`, `ec_policy_upload`, `from_date`, `to_date`, `max_workers`, `active_workers`, `status`, `is_deviation`, `remarks`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CON-005', '71290236170100000199', '/TOSHIBA/images/Contractor/ecpolicy/CON-005-', '2017-09-22', '2018-09-22', 22, 0, 0, 1, 'NULL', '1         ', '2017-11-22 12:23:33', '', ''),
(2, 'CON-006', '71330036170100000181', '/TOSHIBA/images/Contractor/ecpolicy/CON-006-', '2017-10-25', '2018-01-24', 16, 0, 0, 1, 'NULL', '1         ', '2017-11-22 12:31:20', '', ''),
(3, 'CON-007', 'P/111111/01/2017/000336', '/TOSHIBA/images/Contractor/ecpolicy/CON-007-', '2016-04-18', '2017-07-31', 250, 0, 0, 1, 'NULL', '1         ', '2017-11-22 13:41:23', '', ''),
(4, 'CON-063', '0118012716P114182388', '/TOSHIBA/images/Contractor/ecpolicy/CON-063-', '2017-02-02', '2018-02-01', 1, 1, 0, 1, 'NULL', '1         ', '2017-12-07 08:48:02', '', ''),
(5, 'CON-065', '71290036180100000110', '/TOSHIBA/images/Contractor/ecpolicy/CON-065-', '2018-07-13', '2019-07-12', 20, 0, 0, 1, '  ', '1         ', '2017-12-07 11:56:10', '', ''),
(11, 'CON-104', '2250001987', '/TOSHIBA/images/Contractor/ecpolicy/CON-104-', '2017-04-03', '2018-04-02', 1, 1, 0, 1, '  ', '53        ', '2018-02-21 11:39:23', '', ''),
(12, 'CON-049', '5004002717P116753216', '/TOSHIBA/images/Contractor/ecpolicy/CON-049-', '2018-02-21', '2018-05-20', 1, 1, 0, 1, 'NULL', '53        ', '2018-02-22 11:34:03', '', ''),
(13, 'CON-011', '4010/135623386/00/000', '/TOSHIBA/images/Contractor/ecpolicy/CON-011-', '2017-09-01', '2018-08-31', 30, -4, 0, 1, 'NULL', '53        ', '2018-02-23 15:42:13', '', ''),
(14, 'CON-094', '17080036170100000203', '/TOSHIBA/images/Contractor/ecpolicy/CON-094-', '2017-09-07', '2018-09-06', 2, 0, 0, 1, '  ', '53        ', '2018-02-26 16:25:09', '', ''),
(16, 'CON-040', 'OG-18-1501-2801-00000244', '/TOSHIBA/images/Contractor/ecpolicy/CON-040-', '2018-03-05', '2019-03-01', 2, 0, 0, 1, '  ', '53        ', '2018-03-06 16:44:04', '', ''),
(17, 'CON-048', '3114201864176000000', '/TOSHIBA/images/Contractor/ecpolicy/CON-048-', '2017-08-05', '2018-08-04', 5, 0, 0, 1, '  ', '53        ', '2018-03-14 10:50:06', '', ''),
(18, 'CON-115', '4010/142124640/00/000', '/TOSHIBA/images/Contractor/ecpolicy/CON-115-', '2018-01-04', '2019-01-03', 3, 0, 0, 1, 'NULL', '53        ', '2018-03-16 11:11:15', '', ''),
(19, 'CON-078', '0126002717P118257151', '/TOSHIBA/images/Contractor/ecpolicy/CON-078-', '2018-03-19', '2018-04-18', 2, 0, 0, 1, 'NULL', '53        ', '2018-03-21 12:06:15', '', ''),
(20, 'CON-078', '0126002717P118338833', '/TOSHIBA/images/Contractor/ecpolicy/CON-078-', '2018-03-20', '2019-04-19', 5, 0, 0, 1, '  ', '53        ', '2018-03-21 12:06:55', '', ''),
(23, 'CON-134', '4010/148558503/00/000', '/TOSHIBA/images/Contractor/ecpolicy/CON-134-', '2018-05-14', '2018-07-13', 5, 0, 0, 1, 'NULL', '53        ', '2018-05-14 17:21:34', '', ''),
(25, 'CON-095', '141531727210007465', '/TOSHIBA/images/Contractor/ecpolicy/CON-095-', '2018-02-22', '2018-05-21', 3, 0, 0, 1, 'NULL', '53        ', '2018-05-19 10:23:08', '', ''),
(26, 'CON-137', 'L0103726', '/TOSHIBA/images/Contractor/ecpolicy/CON-137-', '2017-11-23', '2018-11-22', 5, 0, 0, 1, 'NULL', '53        ', '2018-05-23 09:50:43', '', ''),
(27, 'CON-019', '0120832718P103822613', '/TOSHIBA/images/Contractor/ecpolicy/CON-019-', '2018-06-20', '2018-09-19', 5, 0, 0, 1, 'NULL', '53        ', '2018-06-21 09:57:55', '', ''),
(28, 'CON-166', '0107004218P100938757', '/TOSHIBA/images/Contractor/ecpolicy/CON-166-', '2018-08-01', '2018-08-30', 5, 0, 0, 1, 'NULL', '53        ', '2018-08-16 14:52:38', '', ''),
(29, 'CON-170', 'OG-19-1701-2801-00000154', '/TOSHIBA/images/Contractor/ecpolicy/CON-170-', '2018-08-29', '2019-08-28', 5, 0, 0, 1, 'NULL', '53        ', '2018-09-04 08:26:26', '', ''),
(31, 'CON-173', '0120002719P104516457', '/TOSHIBA/images/Contractor/ecpolicy/CON-173-', '2019-07-08', '2019-07-22', 5, 4, 0, 1, '  ', '53        ', '2018-09-25 10:21:54', '', ''),
(32, 'CON-174', ' 3114202161631600000  ', '/TOSHIBA/images/Contractor/ecpolicy/CON-174-', '2018-03-28', '2019-03-27', 2, 0, 0, 1, 'NULL', '53        ', '2018-10-03 17:23:50', '', ''),
(33, 'CON-055', '71290236180100000178', '/TOSHIBA/images/Contractor/ecpolicy/CON-055-', '2018-08-11', '2019-08-10', 5, 0, 0, 1, 'NULL', '53        ', '2018-10-20 13:06:33', '', ''),
(34, 'CON-016', '7129003618000000229 ', '/TOSHIBA/images/Contractor/ecpolicy/CON-016-', '2018-10-11', '2019-10-10', 5, 0, 0, 1, 'NULL', '53        ', '2018-11-26 11:32:34', '', ''),
(36, 'CON-198', '', '/TOSHIBA/images/Contractor/ecpolicy/CON-198-', '2019-07-29', '2019-09-30', 5, 1, 0, 1, 'NULL', '1         ', '2019-07-29 08:57:11', '', ''),
(37, 'CON-199', '23100036190100000048', '/TOSHIBA/images/Contractor/ecpolicy/CON-199-', '2019-05-09', '2020-05-08', 5, 0, 0, 1, 'NULL', '1         ', '2019-07-29 16:16:23', '', ''),
(38, 'CON-204', 'P/111113/02/2020/000428', '/TOSHIBA/images/Contractor/ecpolicy/CON-204-', '2019-09-12', '2020-09-11', 5, 0, 0, 1, 'NULL', '1         ', '2019-09-12 08:48:55', '', ''),
(39, 'CON-211', '1622002719P105530183', '/TOSHIBA/images/Contractor/ecpolicy/CON-211-', '2019-07-18', '2020-07-17', 2, 0, 0, 1, 'NULL', '1         ', '2019-10-31 10:01:11', '', ''),
(40, 'CON-131', '71320136190100000459', '/TOSHIBA/images/Contractor/ecpolicy/CON-131-', '2020-01-21', '2020-02-20', 15, 0, 0, 1, 'NULL', '1         ', '2020-01-22 12:08:02', '', ''),
(6, 'CON-045', '234', '/TOSHIBA/images/Contractor/ecpolicy/CON-045-', '2018-01-03', '2030-01-15', 5, 0, 0, 1, '  ', '1         ', '2018-01-31 16:18:14', '', ''),
(8, 'CON-099', 'OG-18-1501-9902-00000127', '/TOSHIBA/images/Contractor/ecpolicy/CON-099-', '1970-01-01', '2018-04-30', 5, 4, 0, 1, '  ', '1         ', '2018-02-15 11:18:11', '', ''),
(10, 'CON-103', '2017-L0097901-FWC', '/TOSHIBA/images/Contractor/ecpolicy/CON-103-', '2018-02-20', '2018-02-22', 2, 1, 0, 1, 'NULL', '53        ', '2018-02-20 17:08:02', '', ''),
(35, 'CON-184', '43154874', '/TOSHIBA/images/Contractor/ecpolicy/CON-184-', '2018-12-17', '2019-12-16', 5, 0, 0, 1, 'NULL', '53        ', '2019-01-02 09:46:58', '', ''),
(7, 'CON-097', '71290036170100000232', '/TOSHIBA/images/Contractor/ecpolicy/CON-097-', '2017-10-11', '2018-10-10', 3, 0, 0, 1, 'NULL', '1         ', '2018-02-12 11:16:08', '', ''),
(22, 'CON-133', '0126002816P106206867', '/TOSHIBA/images/Contractor/ecpolicy/CON-133-', '2017-07-09', '2018-07-09', 1, 0, 0, 1, 'NULL', '53        ', '2018-05-12 14:21:28', '', ''),
(9, 'CON-100', '2017-L0095338-FWC', '/TOSHIBA/images/Contractor/ecpolicy/CON-100-', '2018-02-15', '2018-05-31', 3, 2, 0, 1, '  ', '1         ', '2018-02-15 12:23:31', '', ''),
(15, 'CON-009', '3611-200101-16-1000252-00-000', '/TOSHIBA/images/Contractor/ecpolicy/CON-009-', '2018-03-17', '2019-06-30', 50, 0, 0, 1, '  ', '53        ', '2018-02-28 16:46:10', '', ''),
(21, 'CON-073', '4010148165817/00/000', '/TOSHIBA/images/Contractor/ecpolicy/CON-073-', '2018-05-05', '2018-08-04', 1, 0, 0, 1, 'NULL', '53        ', '2018-05-08 09:51:23', '', ''),
(30, 'CON-168', '2200129367  ', '/TOSHIBA/images/Contractor/ecpolicy/CON-168-', '2018-05-25', '2019-05-24', 3, 0, 0, 1, 'NULL', '53        ', '2018-09-20 08:40:17', '', ''),
(24, 'CON-110', '0108032718P101503899', '/TOSHIBA/images/Contractor/ecpolicy/CON-110-', '2018-04-30', '2018-05-29', 5, 0, 0, 1, 'NULL', '53        ', '2018-05-16 16:47:38', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_employee_master`
--

DROP TABLE IF EXISTS `dbo.contractor_employee_master`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_employee_master` (
  `emp_id` mediumint(9) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `emp_name` varchar(32) DEFAULT NULL,
  `dob` varchar(10) DEFAULT NULL,
  `DOB_upload` varchar(4) DEFAULT NULL,
  `mobile_no` varchar(36) DEFAULT NULL,
  `mobile_no1` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `emergency_contact_number` varchar(14) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `medical_fitness` varchar(1) DEFAULT NULL,
  `medical_conditional_remarks` varchar(4) DEFAULT NULL,
  `is_specially_disabled` varchar(0) DEFAULT NULL,
  `ec` varchar(14) DEFAULT NULL,
  `gpa` varchar(14) DEFAULT NULL,
  `disability_type` varchar(4) DEFAULT NULL,
  `disability_certificate_upload` varchar(4) DEFAULT NULL,
  `is_relatives_associated` varchar(1) DEFAULT NULL,
  `relative_association_type` varchar(4) DEFAULT NULL,
  `relative_employee_number` varchar(4) DEFAULT NULL,
  `relative_contractor_id` varchar(4) DEFAULT NULL,
  `religion` varchar(5) DEFAULT NULL,
  `caste` varchar(1) DEFAULT NULL,
  `nationality_id` varchar(6) DEFAULT NULL,
  `passport` varchar(1) DEFAULT NULL,
  `visa_from_date` varchar(10) DEFAULT NULL,
  `visa_to_date` varchar(10) DEFAULT NULL,
  `passport_number` varchar(9) DEFAULT NULL,
  `passport_upload` varchar(4) DEFAULT NULL,
  `overseas_insurance` varchar(0) DEFAULT NULL,
  `overseas_insurance_upload` varchar(4) DEFAULT NULL,
  `designation` varchar(40) DEFAULT NULL,
  `workers_category_id` varchar(20) DEFAULT NULL,
  `wages_period_id` varchar(8) DEFAULT NULL,
  `work_area` varchar(50) DEFAULT NULL,
  `id_proof_type` varchar(0) DEFAULT NULL,
  `id_proof_number` varchar(0) DEFAULT NULL,
  `id_proof_upload` varchar(0) DEFAULT NULL,
  `address_proof_type` varchar(0) DEFAULT NULL,
  `address_proof_upload` varchar(0) DEFAULT NULL,
  `pf_number` varchar(26) DEFAULT NULL,
  `esi_number` varchar(25) DEFAULT NULL,
  `ec_id` varchar(24) DEFAULT NULL,
  `gpa_id` varchar(21) DEFAULT NULL,
  `is_ismw` varchar(14) DEFAULT NULL,
  `ismw_id` varchar(0) DEFAULT NULL,
  `ismw_state` varchar(0) DEFAULT NULL,
  `ismw_certificate_upload` varchar(4) DEFAULT NULL,
  `photo_upload` varchar(56) DEFAULT NULL,
  `signature_upload` varchar(4) DEFAULT NULL,
  `is_deviation` varchar(1) DEFAULT NULL,
  `remarks` varchar(4) DEFAULT NULL,
  `esi` varchar(14) DEFAULT NULL,
  `esi_remarks` varchar(22) DEFAULT NULL,
  `pf_remarks` varchar(53) DEFAULT NULL,
  `pf` varchar(14) DEFAULT NULL,
  `shift_code` varchar(50) DEFAULT NULL,
  `finger_flag` tinyint(4) DEFAULT NULL,
  `ref_id` varchar(1) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modfied_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_employee_master`
--

INSERT INTO `dbo.contractor_employee_master` (`emp_id`, `contractor_code`, `emp_code`, `emp_name`, `dob`, `DOB_upload`, `mobile_no`, `mobile_no1`, `email`, `emergency_contact_number`, `gender`, `blood_group`, `medical_fitness`, `medical_conditional_remarks`, `is_specially_disabled`, `ec`, `gpa`, `disability_type`, `disability_certificate_upload`, `is_relatives_associated`, `relative_association_type`, `relative_employee_number`, `relative_contractor_id`, `religion`, `caste`, `nationality_id`, `passport`, `visa_from_date`, `visa_to_date`, `passport_number`, `passport_upload`, `overseas_insurance`, `overseas_insurance_upload`, `designation`, `workers_category_id`, `wages_period_id`, `work_area`, `id_proof_type`, `id_proof_number`, `id_proof_upload`, `address_proof_type`, `address_proof_upload`, `pf_number`, `esi_number`, `ec_id`, `gpa_id`, `is_ismw`, `ismw_id`, `ismw_state`, `ismw_certificate_upload`, `photo_upload`, `signature_upload`, `is_deviation`, `remarks`, `esi`, `esi_remarks`, `pf_remarks`, `pf`, `shift_code`, `finger_flag`, `ref_id`, `status`, `created_by`, `created_on`, `modfied_by`, `modified_on`) VALUES
(1, 'CON-045', 'EMP-001', 'VIKRAMAN T', '1989-06-25', 'NULL', '+918608401612', ' ', 'vikraman@bluebase.in', ' 918608401612', 'M', 'M', '0', 'NULL', '', 'not applicable', 'yes', 'NULL', 'NULL', '1', 'NULL', 'NULL', 'NULL', 'HINDU', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', 'NULL', '', 'NULL', ' Senior Developer', 'SKILLED', 'MONTHLY', 'Admin Block', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', 'NULL', '/TOSHIBA/images/employee/photo_upload/EMP-001-vikram.png', 'NULL', '1', 'NULL', 'yes', 'enter later    ', '     ', 'not applicable', 'Others', 1, ' ', 0, '53        ', '2017-11-23', '', ''),
(2, 'CON-009', 'EMP-002', 'SURESH J', '1983-05-15', '', '+919787479738', ' ', 'um.toshiba@compass-group.co.in', '9123577899', 'M', 'AB-', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Unit Chef', 'SKILLED', 'MONTHLY', 'canteen', '', '', '', '', '', '100374741247', ' 0311070011084526', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-002.jpg', '', '1', 'NULL', 'yes', '     ', '        ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(3, 'CON-009', 'EMP-003', 'MOHAN P', '1994-05-10', '', '917871725923', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'M', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Commi-I', 'SKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100230001353', '5122849635', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-003.jpg', '', '0', '', 'yes', '   ', '     ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(4, 'CON-009', 'EMP-004', 'RAMLAKHAN', '1962-10-02', '', '918428342782', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'M', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Commi-II', 'SEMISKILED', 'MONTHLY', ' canteen', '', '', '', '', '', '100878677504', '5124339496', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-004.jpg', '', '0', '', 'yes', '     ', '     ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(5, 'CON-009', 'EMP-005', 'KALPANA D', '1995-05-23', '', '919790185297', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100532337628', '5123921540', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-005.jpg', '', '0', '', 'yes', '     ', '     ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(6, 'CON-009', 'EMP-006', 'SRI PRIYA D', '1993-05-15', '', '919600929645', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100014281151', '5123617671', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-006.jpg', '', '0', '', 'yes', '     ', '     ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(7, 'CON-009', 'EMP-007', 'VIJAYA M', '1982-03-16', '', '+919952041727', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', 'F', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100404867972', '5121472175', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-007.jpg', '', '0', '', 'yes', '      ', '      ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(8, 'CON-009', 'EMP-008', 'DEEPAN T', '1989-04-03', '', '917871546478', '', '', ' 9123577899', 'M', ' ', '0', 'NULL', '', 'no', 'no', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Supervisor', 'SKILLED', 'MONTHLY', '', '', '', '', '', '', '101065246412', '5126956445', '', '', 'no', '', '', '', '', '', '0', '', 'yes', '  ', '  ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(9, 'CON-009', 'EMP-009', 'SUBULAKSHMI', '1975-01-01', '', '+919840396929', ' ', '', '9840693929', 'F', 'F', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', 'canteen', '', '', '', '', '', '101108065221', '5127200294', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-009.jpg', '', '0', '', 'yes', '       ', '       ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(10, 'CON-009', 'EMP-010', 'IYAPPAN S', '1988-09-10', '', '919629692361', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'M', 'M', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Commi-I', 'SKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100168305133', '5122165679', '', ' ', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-010.jpg', '', '0', '', 'yes', '          ', '          ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(11, 'CON-009', 'EMP-011', 'NIRESH KUMAR', '1994-05-26', '', '919003533217', '', '', '', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Commi-II', 'SEMISKILED', 'MONTHLY', '', '', '', '', '', '', '100897002015', '5123718295', '', '', '', '', '', '', '', '', '', '', 'yes', '', '', 'yes', 'Others', 1, '', 1, '1         ', '2017-11-23', '', ''),
(12, 'CON-009', 'EMP-012', 'GOWSALYA G', '1998-01-01', '', '918489271651', ' ', '', '7639735420', 'F', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', 'canteen', '', '', '', '', '', '101043915959', '5126735726', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-012.jpg', '', '0', '', 'yes', '      ', '      ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(13, 'CON-009', 'EMP-013', 'KALA .R', '1973-07-02', '', '918939243856', ' ', '', '8939243856', 'M', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', 'canteen', '', '', '', '', '', '101086363482', '5127105135', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-013.jpg', '', '0', '', 'yes', '     ', '     ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(14, 'CON-009', 'EMP-014', 'DILEEP KUMAR', '1998-01-01', '', ' ', '', '', '8115356614', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', '101108065232', '5127200352', '', '', '', '', '', '', '', '', '', '', 'yes', '', '', 'yes', 'Others', 0, '', 1, '1         ', '2017-11-23', '', ''),
(15, 'CON-009', 'EMP-015', 'MAYA', '1979-12-22', '', '918148798510', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Store Helper', 'SEMISKILED', 'MONTHLY', ' canteen', '', '', '', '', '', '100224253474', '5122936368', '', '', 'no', '', '', '', '', '', '0', '', 'yes', '      ', '      ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(16, 'CON-009', 'EMP-016', 'CHANDRASEKHAR', '1980-10-24', '', '918695480909', '', '', '9000170287', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Unit Manager', 'SKILLED', 'MONTHLY', '', '', '', '', '', '', '100123672950', '', '', '', '', '', '', '', '', '', '', '', 'yes', 'Not given', '', 'yes', 'Others', 0, '', 1, '1         ', '2017-11-23', '', ''),
(17, 'CON-009', 'EMP-017', 'DEVI S', '1980-05-15', '', '+917671842227', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', 'F', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100134365484', '5120484567', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-017.jpg', '', '0', '', 'yes', '       ', '       ', 'yes', 'Others', 1, ' ', 0, '53        ', '2017-11-23', '', ''),
(18, 'CON-009', 'EMP-018', 'RAJESHWARI', '1985-01-10', '', '+919952041727', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', 'F', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100581325798', '5124678949', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-018.jpg', '', '0', '', 'yes', '      ', '      ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(19, 'CON-009', 'EMP-019', 'VIJAYA D', '1978-01-15', '', '+919789909478', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', 'F', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100404723561', '5121380006', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-019.jpg', '', '0', '', 'yes', '       ', '       ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(20, 'CON-009', 'EMP-020', 'JELSING BAGLARY B', '1987-05-07', '', '+919962680311', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'M', 'M', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100602536944', '5125132978', '', ' ', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-020.jpg', '', '0', '', 'yes', '        ', '        ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(21, 'CON-009', 'EMP-021', 'KARTHIKEYAN S', '1991-04-09', '', '', '', '', '', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Store Keeper', 'SKILLED', 'MONTHLY', '', '', '', '', '', '', '100636472416', '5126709640', '', '', '', '', '', '', '', '', '', '', 'yes', '', '', 'yes', 'Others', 0, '', 1, '1         ', '2017-11-23', '', ''),
(22, 'CON-009', 'EMP-022', 'MAGESHWARI S', '1978-01-24', '', '+919952041727', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', 'F', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100668621626', '5125504314', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-022.jpg', '', '0', '', 'yes', '       ', '       ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(23, 'CON-009', 'EMP-023', 'TAMILSELVI S', '1972-12-27', '', '+917299150301', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'F', 'F', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100734450519', '5125604340', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-023.jpg', '', '0', '', 'yes', '       ', '       ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(24, 'CON-009', 'EMP-024', 'SENGAIYAN R', '1978-05-11', '', '+918098585965', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'M', 'M', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '100735358035', '5125604888', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-024.jpg', '', '0', '', 'yes', '       ', '       ', 'yes', 'Others', 1, ' ', 1, '53        ', '2017-11-23', '', ''),
(25, 'CON-009', 'EMP-025', 'SONOO M', '1990-01-01', '', '+919514189110', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'M', 'M', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Commi-II', 'SEMISKILED', 'MONTHLY', ' canteen', '', '', '', '', '', '100989100968', '5126461887', '', ' ', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-025.jpg', '', '0', '', 'yes', '        ', '        ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(26, 'CON-009', 'EMP-026', 'VIVEK R K VIVEK', '1993-05-15', '', '+919123577899', ' ', 'um.toshiba@compass-group.co.in', '9123577899', 'M', 'AB+', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Assistant Manager', 'SKILLED', 'MONTHLY', 'canteen', '', '', '', '', '', '101198499739', ' 0311070017697026', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-026.jpg', '', '0', '', 'yes', '     ', '      ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(27, 'CON-009', 'EMP-027', 'ROHITH KUMAR RAM', '1998-01-01', '', '', '', '', '', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', '101108065245', '5127200511', '', '', '', '', '', '', '', '', '', '', 'yes', '', '', 'yes', 'Others', 0, '', 1, '1         ', '2017-11-23', '', ''),
(967, 'CON-001', 'EMP-941', 'VENUGOPAL', '1975-07-07', 'NULL', '+918608487765', ' ', 'srinivasan.d@in.g4s.com', '+919962010970', 'M', 'AB+', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', 'NULL', '1', 'NULL', 'NULL', 'NULL', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', 'NULL', '', 'NULL', 'S/GUARD', 'SEMISKILED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', '3090255948', '5122387847', '', '', 'no', '', '', 'NULL', '/TOSHIBA/images/employee/photo_upload/EMP-941.jpg', 'NULL', '1', 'NULL', 'yes', '     ', '     ', 'yes', 'Others                                            ', 1, ' ', 0, '53        ', '2018-02-05', '', ''),
(1028, 'CON-009', 'EMP-994', 'VAWJIRAM.D', '1985-02-11', 'NULL', '+918939978121', ' ', '', '9123577899', 'M', 'M', '0', 'NULL', '', 'yes', 'yes', 'NULL', 'NULL', '1', 'NULL', 'NULL', 'NULL', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', 'NULL', '', 'NULL', ' Steward', 'SKILLED', 'MONTHLY', 'HR Admin', '', '', '', '', '', '100885578153', ' ', '15', '12', 'no', '', '', 'NULL', '/TOSHIBA/images/employee/photo_upload/EMP-994.jpg', 'NULL', '1', 'NULL', 'not applicable', '        ', '        ', 'yes', 'Others                                            ', 1, ' ', 0, '53        ', '2018-02-17', '', ''),
(1034, 'CON-099', 'EMP-1000', 'RAKESH KUMAR', '1969-09-23', 'NULL', '+917871939519', ' ', '', ' 8939493478', 'M', 'AB+', '0', 'NULL', '', 'yes', 'not applicable', 'NULL', 'NULL', '1', 'NULL', 'NULL', 'NULL', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', 'NULL', '', 'NULL', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'Plant', '', '', '', '', '', '100300001492', ' ', '8', '', 'no', '', '', 'NULL', '/TOSHIBA/images/employee/photo_upload/EMP-1000.jpg', 'NULL', '1', 'NULL', 'not applicable', '    ', '    ', 'yes', 'Others                                           ', 0, ' ', 0, '53        ', '2018-02-19', '', ''),
(28, 'CON-009', 'EMP-028', 'NIRANJAN RAVANI', '1995-01-01', '', '918521184593', '', '', '9572130852', 'M', ' ', '0', 'NULL', '', 'yes', 'no', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', '101108067566', '5127203130', '15', '', 'no', '', '', '', '', '', '0', '', 'yes', '  ', '  ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(29, 'CON-009', 'EMP-029', 'DHARMENDRA KUMAR', '1998-01-07', '', '917979970507', ' ', '', ' ', 'M', ' ', '0', 'NULL', '', 'no', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', ' ', '', '', '', '', '', '101108067578', '5127203137', '', '', 'no', '', '', '', '', '', '0', '', 'yes', '      ', '      ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(30, 'CON-009', 'EMP-030', 'JAYAPRAKASH V', '1977-04-15', '', '919940404261', '', '', '9840385348', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', '101108067584', '5127203139', '', '', '', '', '', '', '', '', '', '', 'yes', '', '', 'yes', 'Others', 0, '', 1, '1         ', '2017-11-23', '', ''),
(31, 'CON-009', 'EMP-031', 'LAKSHMANAN RENGASAMY', '1990-05-30', '', '919600392985', '', '', '9025310933', 'M', ' ', '0', 'NULL', '', 'yes', 'no', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Commi-II', 'SEMISKILED', 'MONTHLY', '', '', '', '', '', '', '101108067862', '5127203142', '15', '', 'no', '', '', '', '', '', '0', '', 'yes', '  ', '  ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(32, 'CON-009', 'EMP-032', 'DHIRENDRA KUMAR', '1996-05-01', '', '917979970507', '', '', '', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', '101108067623', '5127203148', '', '', '', '', '', '', '', '', '', '', 'yes', '', '', 'yes', 'Others', 0, '', 1, '1         ', '2017-11-23', '', ''),
(33, 'CON-009', 'EMP-033', 'DHEERAJ', '1983-09-21', '', '+918939664176', ' ', 'um.toshiba@compass-group.co.in', '9080142206', 'M', 'M', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'SKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '101108067647', '5127203152', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-033.jpg', '', '0', '', 'yes', '      ', '      ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(34, 'CON-009', 'EMP-034', 'ARUN KUMAR', '1991-01-01', '', ' ', ' ', '', '9117606948', 'M', 'M', '0', 'NULL', '', 'no', 'no', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', 'canteen', '', '', '', '', '', '101108067652', '5127203158', '', '', 'no', '', '', '', '', '', '0', '', 'yes', '   ', '   ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(35, 'CON-009', 'EMP-035', 'MANIKANDAN J', '1996-12-25', '', '917339354165', '', '', '9942904249', 'M', ' ', '0', 'NULL', '', 'no', 'no', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Commi-III', 'SEMISKILED', 'MONTHLY', '', '', '', '', '', '', '101108067870', '5127203145', '', '', 'no', '', '', '', '', '', '0', '', 'yes', '  ', '  ', 'yes', 'Others', 0, '', 0, '53        ', '2017-11-23', '', ''),
(36, 'CON-009', 'EMP-036', 'SEKAR V D', '1988-05-13', '', '919626386082', ' ', 'um.toshiba@compass-group.co.in', ' 9123577899', 'M', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Commi-I', 'SKILLED', 'MONTHLY', ' canteen', '', '', '', '', '', '101108067634', '5127203150', '', '', 'no', '', '', '', '', '', '0', '', 'yes', '      ', '      ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(37, 'CON-009', 'EMP-037', 'ARUNKUMAR', '1993-05-25', '', '918939363573', ' ', '', '8939322592', 'M', ' ', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Supervisor', 'SKILLED', 'MONTHLY', ' Canteen', '', '', '', '', '', ' ', ' 5128079564', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-037.jpg', '', '0', '', 'yes', '     ', 'Not given       ', 'not applicable', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(38, 'CON-009', 'EMP-038', 'IMTIYAJ RAIN', '1998-09-12', '', '917845702101', '', '', '8573959795', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'yes', 'Not given', 'Not given', 'yes', 'Others', 0, '', 1, '1         ', '2017-11-23', '', ''),
(39, 'CON-009', 'EMP-039', 'KESAVAN', '1995-07-25', '', '919710435019', '', '', '9840589276', 'M', '', '', '', '', 'no', 'no', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Steward', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'yes', 'Not given', 'Not given', 'yes', 'Others', 0, '', 1, '1         ', '2017-11-23', '', ''),
(40, 'CON-009', 'EMP-040', 'BHAVANI', '1989-05-04', '', '919176245564', ' ', 'um.toshiba@compass-group.co.in', '919123577899', 'F', 'AB+', '0', 'NULL', '', 'yes', 'yes', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'Utility Worker', 'UNSKILLED', 'MONTHLY', 'canteen', '', '', '', '', '', ' 101132320647', ' 5127338126', '15', '12', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-040.jpg', '', '0', '', 'yes', '     ', '     ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(43, 'CON-050', 'EMP-041', 'MOHAMMED KASIM', '1985-11-09', '', '9840016136', ' ', '', '9840016136', 'M', 'B+', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'SUPERVISOR', 'SKILLED', 'MONTHLY', 'SCRAP', '', '', '', '', '', ' TN/MAS/1647818000', '5127830442', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-041.jpg', '', '0', '', 'yes', '  ', '  ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(44, 'CON-050', 'EMP-042', 'NANDA BISHOYI  ', '1976-05-13', '', '+919840016136', ' ', '', '+919840016136', 'M', ' ', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'skilled', 'MONTHLY', 'SCRAP', '', '', '', '', '', ' TNMAS000006', ' 5128568359', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-042.jpg', '', '0', '', 'yes', 'NOT GIVEN   ', '  ', 'yes', 'Others', 1, ' ', 0, '53        ', '2017-11-23', '', ''),
(45, 'CON-050', 'EMP-043', 'PRAMOTH', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(46, 'CON-050', 'EMP-044', 'AJITH', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(47, 'CON-050', 'EMP-045', 'MUNNA', '1970-01-01', '', ' ', ' ', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', ' ', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN  ', 'NOT GIVEN  ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(48, 'CON-050', 'EMP-046', 'KUNNA', '1970-01-01', '', ' ', ' ', '', '9840016136 ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', 'SCRAP', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN  ', 'NOT GIVEN  ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(49, 'CON-050', 'EMP-047', 'VIAL', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(50, 'CON-050', 'EMP-048', 'SRIKANTH', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(51, 'CON-050', 'EMP-049', 'SANATHAN', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(52, 'CON-050', 'EMP-050', 'BABU RAM', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(53, 'CON-050', 'EMP-051', 'SOWRAH', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(54, 'CON-050', 'EMP-052', 'BIBAR', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(55, 'CON-050', 'EMP-053', 'THOULBOTH', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(56, 'CON-050', 'EMP-054', 'KAILASH', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(57, 'CON-050', 'EMP-055', 'BEVAN', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(58, 'CON-050', 'EMP-056', 'LAMBA', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(59, 'CON-050', 'EMP-057', 'DHANASEKAR', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(60, 'CON-050', 'EMP-058', 'MUNI', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(61, 'CON-050', 'EMP-059', 'VIJAYAN', '1970-01-01', '', ' ', '', '', ' ', 'M', ' ', '0', 'NULL', '', '', '', 'NULL', '', '1', '', '', '', '', '', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'WORKER', 'UNSKILLED', 'MONTHLY', '', '', '', '', '', '', ' ', ' ', '', '', 'no', '', '', '', '', '', '0', '', 'yes', 'NOT GIVEN ', 'NOT GIVEN ', 'yes', 'Others', 0, '', 1, '53        ', '2017-11-23', '', ''),
(63, 'CON-046', 'EMP-060', 'C Nandhakumar', '1990-03-05', '', '+919791151816', ' ', 'nandhakumar0222@gmail.com', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'no', 'no', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', ' PLUMBER', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10669', '5122988929', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-060.jpg', '', '0', '', 'yes', '   ', '', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(64, 'CON-046', 'EMP-061', 'R Xavier', '1970-01-01', '', ' ', ' ', '', ' +919940073828', 'M', ' ', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10622', '5111782036', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-061.jpg', '', '0', '', 'yes', '      ', '     ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(65, 'CON-046', 'EMP-062', 'S. Thiyagarajan', '1988-04-04', '', '+919840823770', ' ', '', ' 9940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', ' TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', ' TN/MAS/93310/10624', '5123930622', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-062.jpg', '', '0', '', 'yes', '     ', 'pf no remarks    ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(66, 'CON-046', 'EMP-063', 'P Pandeeswaran', '1982-07-05', '', '+919710280920', ' ', 'jkafj@gmail.com', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'JUNIOR ENGINEER', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10623', '5126620377', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-063.jpg', '', '0', '', 'yes', '    ', '  ', 'yes', 'Others', 1, ' ', 0, '53        ', '2017-11-23', '', ''),
(67, 'CON-046', 'EMP-064', 'C J jaison', '1983-06-10', '', '+919841539050', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10626', '5127458319', ' ', ' ', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-064.jpg', '', '0', '', 'yes', '     ', '   ', 'yes', 'Others', 0, ' ', 1, '1         ', '2017-11-23', '', ''),
(68, 'CON-046', 'EMP-065', 'Nehru K', '1975-06-10', '', '+919940104296', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10625', '5122989852', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-065.jpg', '', '0', '', 'yes', '    ', '  ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(69, 'CON-046', 'EMP-066', 'M Mohankumar', '1984-10-21', '', '+919884371191', ' ', 'manomohan2184@gmail.com', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10670', '5123411121', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-066.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(70, 'CON-046', 'EMP-067', 'N Rajesh', '1970-01-01', '', '+919543427351', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10627', '5127217816', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-067.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(71, 'CON-046', 'EMP-068', 'M Ajay', '1970-01-01', '', '+919176067186', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10688', '5127458332', '', '', 'no', '', '', '', '', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(72, 'CON-046', 'EMP-069', 'M Vinoth', '1986-08-14', '', '+919791012154', ' ', 'vinurock45@gmail.com', '+919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10689', '5126451401', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-069.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(73, 'CON-046', 'EMP-070', 'L Aravindhan', '1991-12-19', '', '+919600163330', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'PLUMBER', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10690', '5125688289', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-070.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(74, 'CON-046', 'EMP-071', 'Sathish K', '1994-10-10', '', '+919884479241', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10691', '5127704529', ' ', ' ', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-071.jpg', '', '0', '', 'yes', '     ', 'pf no remarks    ', 'yes', 'Others', 0, ' ', 1, '1         ', '2017-11-23', '', ''),
(75, 'CON-046', 'EMP-072', 'Vinod R', '1993-01-16', '', '+919094342041', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10629', '5123883157', ' ', ' ', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-072.jpg', '', '0', '', 'yes', '     ', 'pf no remarks    ', 'yes', 'Others', 0, ' ', 1, '1         ', '2017-11-23', '', ''),
(76, 'CON-046', 'EMP-073', 'G Sathishkumar', '1986-11-11', '', '+919884214184', ' ', '', '+919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10630', '5117277533', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-073.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(77, 'CON-046', 'EMP-074', 'P Nanda Kumar', '1995-10-27', '', '+919159493031', ' ', '', '+919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', ' GET', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10628', '5127704599', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-074.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(78, 'CON-046', 'EMP-075', 'R Thiyagarajan', '1970-01-01', '', '+919940073828', ' ', '', ' +919940073828', 'M', ' ', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10631', '5125724461', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-075.jpg', '', '0', '', 'yes', '     ', 'pf no remarks    ', 'yes', 'Others', 1, ' ', 0, '53        ', '2017-11-23', '', ''),
(79, 'CON-046', 'EMP-076', 'J Nareshkumar', '1991-06-21', '', '+917418578336', ' ', '', '+919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'JUNIOR ENGINEER', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10634', '5126566175', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-076.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(80, 'CON-046', 'EMP-077', 'I Sundaraj Maxon', '1985-06-10', '', '+919710568074', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'JUNIOR ENGINEER', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10692', '5114792890', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-077.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(81, 'CON-046', 'EMP-078', 'A Pavalamani', '1968-05-01', '', '+917358746107', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10632', '5122989850', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-078.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(82, 'CON-046', 'EMP-079', 'P Gopal', '1970-01-01', '', '+919382303536', ' ', '', '+919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10633', '5127356436', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-079.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(83, 'CON-046', 'EMP-080', 'RAJAVELU T', '1987-07-18', '', '+919962557703', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'SUPERVISOR', 'SKILLED', 'MONTHLY', ' ETP', '', '', '', '', '', 'TN/MAS/93310/10636', '5126572864', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-080.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(84, 'CON-046', 'EMP-081', 'S Ashok', '1995-09-20', '', '+918940444436', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10635', '5125276827', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-081.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(85, 'CON-046', 'EMP-082', 'T.S.Jagadeesh', '1991-08-22', '', '+918015131165', ' ', 't.s.jagadeesh09@gmail.com', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10638', '5127458319', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-082.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(86, 'CON-046', 'EMP-083', 'K Navaneetha krishnan', '1970-01-01', '', '+918883299756', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'STP', '', '', '', '', '', 'TN/MAS/93310/10683', '5127704732', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-083.jpg', '', '0', '', 'yes', '    ', '', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(87, 'CON-046', 'EMP-084', 'Damodharan K', '1995-12-17', '', '+918903507853', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'GET', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', ' 101193344796', '5127704750', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-084.jpg', '', '0', '', 'yes', '    ', '   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(88, 'CON-046', 'EMP-085', 'Elavarasan M', '1994-05-06', '', '+917867928694', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'GET', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10684', '5127704783', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-085.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(89, 'CON-046', 'EMP-086', 'Sankar V', '1971-02-11', '', '+919941388928', ' ', '', ' 9940073828', 'M', 'M', '0', 'NULL', '', 'no', 'no', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', ' GET', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', ' ', 'GMC', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-086.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 1, '53        ', '2017-11-23', '', ''),
(90, 'CON-046', 'EMP-087', 'KUMARASAN K', '1983-10-27', '', '+919940433775', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'STP ETP', '', '', '', '', '', 'TN/MAS/93310/10663', '5126702461', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-087.jpg', '', '0', '', 'yes', '     ', '  ', 'yes', 'Others', 1, ' ', 0, '53        ', '2017-11-23', '', ''),
(91, 'CON-046', 'EMP-088', 'Vignesh T', '1994-09-02', '', '+919962178848', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'OPERATOR', 'SKILLED', 'MONTHLY', 'PFM', '', '', '', '', '', 'TN/MAS/93310/10687', '5123030599', ' ', ' ', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-088.jpg', '', '0', '', 'yes', '     ', '   ', 'yes', 'Others', 0, ' ', 1, '1         ', '2017-11-23', '', ''),
(92, 'CON-046', 'EMP-089', 'Yesu Dasan T', '1970-01-01', '', '+919043448782', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/118', '5125714264', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-089.jpg', '', '0', '', 'yes', '    ', '  ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(93, 'CON-046', 'EMP-090', 'Prasanth S', '1995-04-11', '', '+919940470741', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/119', '5126021813', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-090.jpg', '', '0', '', 'yes', '    ', 'pf no remarks   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(94, 'CON-046', 'EMP-091', 'Navin K V', '1990-02-18', '', '+918056091829', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'TECHNICIAN', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10738', ' 5127704711', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-091.jpg', '', '0', '', 'yes', '  ', '', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(95, 'CON-046', 'EMP-092', 'Elumalai M', '1982-01-01', '', '+919786897568', ' ', '', ' +919940073828', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', ' CAPENTER', 'UNSKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/MAS/93310/10742', ' 5125546104', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-092.jpg', '', '0', '', 'yes', '  ', '  ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(96, 'CON-002', 'EMP-093', 'P.RAJESH PANDI ', '1991-08-08', '', '9841457579', ' ', '', '9884632406', 'M', ' ', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'SITE ENGINEER', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/84689/221', '5125251325', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-093.jpg', '', '0', '', 'yes', '   ', '   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', '');
INSERT INTO `dbo.contractor_employee_master` (`emp_id`, `contractor_code`, `emp_code`, `emp_name`, `dob`, `DOB_upload`, `mobile_no`, `mobile_no1`, `email`, `emergency_contact_number`, `gender`, `blood_group`, `medical_fitness`, `medical_conditional_remarks`, `is_specially_disabled`, `ec`, `gpa`, `disability_type`, `disability_certificate_upload`, `is_relatives_associated`, `relative_association_type`, `relative_employee_number`, `relative_contractor_id`, `religion`, `caste`, `nationality_id`, `passport`, `visa_from_date`, `visa_to_date`, `passport_number`, `passport_upload`, `overseas_insurance`, `overseas_insurance_upload`, `designation`, `workers_category_id`, `wages_period_id`, `work_area`, `id_proof_type`, `id_proof_number`, `id_proof_upload`, `address_proof_type`, `address_proof_upload`, `pf_number`, `esi_number`, `ec_id`, `gpa_id`, `is_ismw`, `ismw_id`, `ismw_state`, `ismw_certificate_upload`, `photo_upload`, `signature_upload`, `is_deviation`, `remarks`, `esi`, `esi_remarks`, `pf_remarks`, `pf`, `shift_code`, `finger_flag`, `ref_id`, `status`, `created_by`, `created_on`, `modfied_by`, `modified_on`) VALUES
(97, 'CON-002', 'EMP-094', 'M.PUGAZHENTHI', '1991-05-23', '', '9884632406', ' ', '', '9884632406', 'M', ' ', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'SITE ENGINEER', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/84689/229', '5126176763', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-094.jpg', '', '0', '', 'yes', '   ', '   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(98, 'CON-002', 'EMP-095', 'B.SATHISH', '1990-03-28', '', '7397438161', ' ', '', '9884632406', 'M', ' ', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'SUPERVISOR ', 'SKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', '101101889965', '5127166280', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-095.jpg', '', '0', '', 'yes', '   ', '   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(99, 'CON-002', 'EMP-096', 'K.S.SRINIVASAN', '1976-06-08', '', '9710441197', ' ', '', '9884632406', 'M', ' ', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'FITTER', 'SEMISKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/84689/156', '5123595301', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-096.jpg', '', '0', '', 'yes', '   ', '   ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', ''),
(100, 'CON-002', 'EMP-097', 'S.RAJKUMAR', '1979-06-05', '', '9962468119', ' ', '', '9884632406', 'M', 'M', '0', 'NULL', '', 'not applicable', 'not applicable', 'NULL', '', '1', '', '', '', ' ', ' ', 'INDIAN', '1', '1970-01-01', '1970-01-01', '', '', '', '', 'FABRICATOR', 'SEMISKILLED', 'MONTHLY', 'ALL AREA', '', '', '', '', '', 'TN/84689/060', '5122877635', '', '', 'no', '', '', '', '/TOSHIBA/images/employee/photo_upload/EMP-097.jpg', '', '0', '', 'yes', '    ', '    ', 'yes', 'Others', 0, ' ', 0, '53        ', '2017-11-23', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_gpa_policy`
--

DROP TABLE IF EXISTS `dbo.contractor_gpa_policy`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_gpa_policy` (
  `gpa_id` smallint(6) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `gpa_policy_number` varchar(29) DEFAULT NULL,
  `gpa_policy_upload` varchar(45) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `max_workers` smallint(6) DEFAULT NULL,
  `active_workers` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_deviation` tinyint(4) DEFAULT NULL,
  `remarks` varchar(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_gpa_policy`
--

INSERT INTO `dbo.contractor_gpa_policy` (`gpa_id`, `contractor_code`, `gpa_policy_number`, `gpa_policy_upload`, `from_date`, `to_date`, `max_workers`, `active_workers`, `status`, `is_deviation`, `remarks`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CON-007', 'P/111111/02/2016/000046', '/TOSHIBA/images/Contractor/gpapolicy/CON-007-', '2017-03-01', '2017-04-13', 250, 0, 1, 1, '  ', '1         ', '2017-11-22 13:37:41', '', ''),
(2, 'CON-007', 'P/111111/02/2018/000176', '/TOSHIBA/images/Contractor/gpapolicy/CON-007-', '2017-07-30', '2018-07-31', 193, 0, 0, 1, '  ', '1         ', '2017-11-22 13:40:04', '', ''),
(3, 'CON-008', 'GPA0004817 07', 'Array', '2017-01-07', '2018-01-06', 246, 0, 0, 1, 'NULL', '1         ', '2017-11-22 14:23:06', '', ''),
(4, 'CON-009', '04230 12816 P105476772', '/TOSHIBA/images/Contractor/gpapolicy/CON-009-', '2016-07-19', '2017-07-18', 40, 0, 1, 1, '  ', '1         ', '2017-11-22 14:44:25', '', ''),
(5, 'CON-053', '0126002817P116117233', '/TOSHIBA/images/Contractor/gpapolicy/CON-053-', '2018-02-13', '2019-02-12', 8, 0, 0, 1, '  ', '1         ', '2017-11-28 12:44:55', '', ''),
(6, 'CON-102', '2999201793498100000', 'Array', '2018-02-17', '2018-02-18', 1, 0, 0, 1, 'NULL', '53        ', '2018-02-17 09:35:33', '', ''),
(7, 'CON-044', '411601/48/2018/468', '/TOSHIBA/images/Contractor/gpapolicy/CON-044-', '2017-09-14', '2018-09-13', 15, 0, 0, 1, '  ', '53        ', '2018-02-22 15:04:19', '', ''),
(12, 'CON-009', '4112-200101-17-7000367-00-000', '/TOSHIBA/images/Contractor/gpapolicy/CON-009-', '2017-08-16', '2019-06-30', 50, 0, 0, 1, '  ', '53        ', '2018-03-01 09:21:13', '', ''),
(14, 'CON-111', '71090848176800000010', 'Array', '2017-09-22', '2018-09-21', 7, 0, 0, 1, 'NULL', '53        ', '2018-03-09 08:19:01', '', ''),
(15, 'CON-111', '71090848176800000013', '/TOSHIBA/images/Contractor/gpapolicy/CON-111-', '2017-10-31', '2018-10-30', 6, 0, 0, 1, '  ', '53        ', '2018-03-09 08:19:57', '', ''),
(16, 'CON-072', '2999200385452305000', '/TOSHIBA/images/Contractor/gpapolicy/CON-072-', '2018-12-15', '2019-12-14', 5, 0, 0, 1, '  ', '53        ', '2018-03-09 16:02:05', '', ''),
(1017, 'CON-062', '520000482017494', 'Array', '2017-09-25', '2018-09-24', 3, 0, 0, 1, 'NULL', '53        ', '2018-03-13 10:36:21', '', ''),
(1018, 'CON-113', '5019005017100251', 'Array', '2017-06-28', '2018-06-27', 2, 0, 0, 1, 'NULL', '53        ', '2018-03-15 10:55:22', '', ''),
(1022, 'CON-022', 'OG-18-1701-9902-00000230', 'Array', '2018-03-28', '2019-03-27', 2, 0, 0, 1, 'NULL', '53        ', '2018-04-06 13:49:17', '', ''),
(1024, 'CON-125', 'GPA0004121', 'Array', '2018-01-23', '2019-01-22', 2, 0, 0, 1, 'NULL', '53        ', '2018-04-23 10:09:14', '', ''),
(1025, 'CON-126', '0102024217P102592792', 'Array', '2017-06-16', '2018-06-15', 2, 0, 0, 1, 'NULL', '53        ', '2018-04-25 10:38:13', '', ''),
(1028, 'CON-130', '13100042170100000000', 'Array', '2017-11-11', '2018-11-10', 2, 0, 0, 1, 'NULL', '53        ', '2018-05-10 10:18:53', '', ''),
(1030, 'CON-145', '13150242170100000', 'Array', '2017-09-09', '2018-09-08', 4, 0, 0, 1, 'NULL', '53        ', '2018-06-07 09:03:48', '', ''),
(1031, 'CON-149', '411601/48/2018/1968', 'Array', '2018-05-30', '2018-10-30', 2, 0, 0, 1, 'NULL', '53        ', '2018-06-13 11:24:12', '', ''),
(1032, 'CON-160', 'OG-181904-9902-00000046', 'Array', '2018-05-25', '2018-09-30', 5, 0, 0, 1, 'NULL', '53        ', '2018-07-12 17:19:45', '', ''),
(1033, 'CON-162', '411601-48-2018-1968', 'Array', '2018-03-17', '2019-03-16', 2, 0, 0, 1, 'NULL', '53        ', '2018-07-31 09:33:58', '', ''),
(1034, 'CON-166', '', '/TOSHIBA/images/Contractor/gpapolicy/CON-166-', '2018-08-01', '2018-08-30', 3, 2, 1, 1, '  ', '53        ', '2018-08-14 13:12:13', '', ''),
(1035, 'CON-167', '0126022718P106345017', 'Array', '2018-08-14', '2018-09-13', 5, 0, 0, 1, 'NULL', '53        ', '2018-08-14 14:40:51', '', ''),
(1036, 'CON-171', '31010334189500000207', 'Array', '2018-08-23', '2019-08-22', 2, 0, 0, 1, 'NULL', '53        ', '2018-09-17 11:08:46', '', ''),
(1037, 'CON-178', '71290242180100000133 ', 'Array', '2018-10-15', '2019-10-14', 5, 0, 0, 1, 'NULL', '53        ', '2018-10-20 13:25:54', '', ''),
(1039, 'CON-209', '412400482020394', 'Array', '2019-06-28', '2020-06-27', 2, 0, 0, 1, 'NULL', '1         ', '2019-10-11 12:00:04', '', ''),
(1040, 'CON-215', '2999202169522301000', 'Array', '2019-04-01', '2020-03-31', 5, 0, 0, 1, 'NULL', '1         ', '2019-11-20 09:41:39', '', ''),
(8, 'CON-011', '', '/TOSHIBA/images/Contractor/gpapolicy/CON-011-', '2017-09-01', '2018-02-02', 30, 1, 1, 1, '  ', '53        ', '2018-02-23 14:10:31', '', ''),
(9, 'CON-106', '0722004216P115031166', 'Array', '2018-02-06', '2019-02-05', 2, 1, 0, 1, 'NULL', '53        ', '2018-02-26 11:28:50', '', ''),
(13, 'CON-108', '0305004217P117206634', 'Array', '2018-03-04', '2019-03-03', 2, 0, 0, 1, 'NULL', '53        ', '2018-03-05 10:21:38', '', ''),
(1019, 'CON-114', '5004004217P104958249', 'Array', '2017-07-01', '2018-06-30', 2, 0, 0, 1, 'NULL', '53        ', '2018-03-16 10:49:04', '', ''),
(1020, 'CON-111', '71090848176800000023', 'Array', '2018-03-16', '2019-03-15', 3, 0, 0, 1, 'NULL', '53        ', '2018-03-19 09:22:14', '', ''),
(1021, 'CON-119', '411693/48/2018/34', 'Array', '2017-04-26', '2018-04-25', 5, 0, 0, 1, 'NULL', '53        ', '2018-03-26 14:37:44', '', ''),
(1023, 'CON-087', 'GPA 000881302', 'Array', '2018-02-02', '2019-02-01', 1, 0, 0, 1, 'NULL', '53        ', '2018-04-20 10:13:43', '', ''),
(10, 'CON-005', '71290236170100000000', 'Array', '2017-09-22', '2018-09-21', 8, 0, 0, 1, 'NULL', '53        ', '2018-02-26 13:54:33', '', ''),
(11, 'CON-107', '13040042170100000118', 'Array', '2018-01-11', '2019-01-10', 2, 0, 0, 1, 'NULL', '53        ', '2018-02-27 10:03:31', '', ''),
(17, 'CON-079', 'T/111116/02/2018/001173', '/TOSHIBA/images/Contractor/gpapolicy/CON-079-', '2018-02-15', '2019-02-14', 10, 0, 0, 1, '  ', '53        ', '2018-03-10 12:08:59', '', ''),
(18, 'CON-112', 'P/111117/01/2017/009982', '/TOSHIBA/images/Contractor/gpapolicy/CON-112-', '2017-03-31', '2018-03-30', 7, 0, 0, 1, '  ', '53        ', '2018-03-10 12:14:08', '', ''),
(1029, 'CON-139', '411693/48/2019/38', 'Array', '2018-04-26', '2019-04-25', 5, 0, 0, 1, 'NULL', '53        ', '2018-05-23 15:55:21', '', ''),
(1038, 'CON-181', '52881875', 'Array', '2017-11-30', '2018-11-29', 2, 0, 0, 1, 'NULL', '53        ', '2018-11-20 15:23:42', '', ''),
(1026, 'CON-127', '71260042170100000000', 'Array', '2018-02-10', '2019-02-09', 2, 0, 0, 1, 'NULL', '53        ', '2018-04-27 16:24:32', '', ''),
(1027, 'CON-031', 'OG-18-1919-2801-00000-182', 'Array', '2017-09-01', '2018-08-30', 4, 0, 0, 1, 'NULL', '53        ', '2018-04-30 08:44:13', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_incharge`
--

DROP TABLE IF EXISTS `dbo.contractor_incharge`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_incharge` (
  `incharge_id` smallint(6) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `incharge_name` varchar(22) DEFAULT NULL,
  `incharge_email` varchar(33) DEFAULT NULL,
  `incharge_mobile` varchar(13) DEFAULT NULL,
  `incharge_phone` varchar(19) DEFAULT NULL,
  `incharge_designation` varchar(23) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_incharge`
--

INSERT INTO `dbo.contractor_incharge` (`incharge_id`, `contractor_code`, `incharge_name`, `incharge_email`, `incharge_mobile`, `incharge_phone`, `incharge_designation`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CON-001', 'srinivasan', 'srinivasan.d@in.g4s.com', '+919962010970', '2626289574,42054444', 'Branch Manager', 0, '1         ', '2017-11-22 11:12:39', '', '2017-11-22 11:12:39'),
(2, 'CON-003', 'J.MYTHEEN', 'kiruthikaelectricals@gmail.com', '+919710943831', '044-24927988', 'SITE ENGINEER', 0, '1         ', '2017-11-22 12:00:09', '', '2017-11-22 12:00:09'),
(3, 'CON-004', 'J . DARVIN', 'mariadarvin66@gmail.com', '+919941922213', '044 25551142', 'CEO', 0, '1         ', '2017-11-22 12:15:03', '', '2017-11-22 12:15:03'),
(4, 'CON-005', 'T.Palaniyappan', 'palani.nitin@gmail.com', '+917550306434', '', 'Supervisor', 0, '1         ', '2017-11-22 12:24:28', '', '2017-11-22 12:24:28'),
(5, 'CON-006', 'Kasthurirangan', 'nkr@sees.co.in', '+917395955238', '8248722406', 'Project Head', 0, '1         ', '2017-11-22 12:33:14', '', '2017-11-22 12:33:14'),
(6, 'CON-007', 'Anwar', '', '+919840285586', '', 'Manager', 0, '1         ', '2017-11-22 13:42:28', '', '2017-11-22 13:42:28'),
(7, 'CON-008', 'S.RAFEEK ALI', 'toshibachn@drivecarclub.com', '+919003273734', '', 'OPS.Executive', 0, '1         ', '2017-11-22 14:24:03', '', '2017-11-22 14:24:03'),
(8, 'CON-009', 'Vivek', 'um.toshiba@compass-group.co.in', '9123577899', ' 44 4343 4646 ', 'Unit Manager', 0, '1         ', '2017-11-22 14:48:19', '', '2017-11-22 14:48:19'),
(15, 'CON-053', 'SM SRINIVASAN', ' ', '+919940636947', ' ', ' incharge', 0, '1         ', '2017-11-28 12:45:43', '', '2017-11-28 12:45:43'),
(17, 'CON-061', 'SUNDAR', '', '+919884851766', '', '', 0, '1         ', '2017-12-05 11:33:15', '', '2017-12-05 11:33:15'),
(19, 'CON-064', 'PRABHAKAR J', '', '+919551564499', '', '', 0, '1         ', '2017-12-07 09:43:14', '', '2017-12-07 09:43:14'),
(20, 'CON-065', 'Ravindranathan', ' ', '+919840028249', ' ', ' Incharge', 0, '1         ', '2017-12-07 11:41:39', '', '2017-12-07 11:41:39'),
(21, 'CON-067', 'NEELAKANDAN', ' ', ' 8220026203', '', ' Incharge', 0, '1         ', '2017-12-07 15:00:34', '', '2017-12-07 15:00:34'),
(22, 'CON-068', 'MANO', '', '+919677024026', '', '', 0, '1         ', '2017-12-08 09:48:59', '', '2017-12-08 09:48:59'),
(24, 'CON-054', 'Balaji T', '', '+919092800093', '', '', 0, '1         ', '2017-12-08 17:04:13', '', '2017-12-08 17:04:13'),
(25, 'CON-070', 'NANTHAKUMAR', '', '+919840122652', '', '', 0, '1         ', '2017-12-12 10:35:14', '', '2017-12-12 10:35:14'),
(30, 'CON-075', 'Selvanayagam', '', '+917401672951', '', 'Manager', 0, '1         ', '2017-12-15 14:45:35', '', '2017-12-15 14:45:35'),
(34, 'CON-059', 'K Rajesh', ' ', '+919843995474', ' ', ' incharge', 0, '1         ', '2018-01-31 11:08:31', '', '2018-01-31 11:08:31'),
(35, 'CON-033', 'D Kingsley', 'kingsleyeee@gmail.com', '+917358076772', '', 'Supervisor', 0, '1         ', '2018-01-31 14:15:17', '', '2018-01-31 14:15:17'),
(38, 'CON-096', 'janagaraj', '', '+918939654740', '', '', 0, '1         ', '2018-02-06 10:31:29', '', '2018-02-06 10:31:29'),
(39, 'CON-002', 'Rajesh pandi', 'srijayaenterprisesasn72@gmail.com', '+919841457579', '', '', 0, '1         ', '2018-02-07 09:08:32', '', '2018-02-07 09:08:32'),
(40, 'CON-010', 'Savari sagaya Maghi', '', '7951255695', ' ', 'Incharge', 0, '1         ', '2018-02-07 09:24:57', '', '2018-02-07 09:24:57'),
(41, 'CON-011', 'maruthu pandian k', 'maruthupandian@bluestarindia.com', '+918754468336', ' ', ' Incharge', 0, '1         ', '2018-02-07 09:26:53', '', '2018-02-07 09:26:53'),
(42, 'CON-012', 'Balu', 'chellunagaraju@gmail.com', '9445195524', ' ', ' incharge', 0, '1         ', '2018-02-07 09:28:31', '', '2018-02-07 09:28:31'),
(43, 'CON-013', 'Aswin', '', '+919789995317', '', '', 0, '1         ', '2018-02-07 09:32:56', '', '2018-02-07 09:32:56'),
(44, 'CON-014', 'Anwar', 'flexistaffing@gmail.com ', '+919840285586', ' ', ' ', 0, '1         ', '2018-02-07 09:37:31', '', '2018-02-07 09:37:31'),
(45, 'CON-015', 'Suman A', 'toshiba@hariharanfoundations.com', '+917305750253', ' ', ' Incharge', 0, '1         ', '2018-02-07 09:39:18', '', '2018-02-07 09:39:18'),
(46, 'CON-040', 'Karthikeyan.k', '', '+917812091285', '', 'Inchrge', 0, '1         ', '2018-02-07 10:58:35', '', '2018-02-07 10:58:35'),
(52, 'CON-030', 'Selvam ', 'ruba.engineering@yahoo.com', '+919840278217', '', '', 0, '1         ', '2018-02-07 11:50:06', '', '2018-02-07 11:50:06'),
(53, 'CON-044', 'Mohan ', 'uhmohan@groupmechatronic.com', '+919940008521', ' ', ' Incharge', 0, '1         ', '2018-02-07 11:58:17', '', '2018-02-07 11:58:17'),
(58, 'CON-081', 'Alagesan', 'service@atlasace.in', '+919840937466', '', 'Senior Service Engineer', 0, '1         ', '2018-02-10 10:44:23', '', '2018-02-10 10:44:23'),
(59, 'CON-052', 'Seetharaman', 'shakthi_electri@yahoo.com', '+919551660206', '', 'Site Engineer', 0, '1         ', '2018-02-10 11:10:18', '', '2018-02-10 11:10:18'),
(61, 'CON-097', 'Gopalraj', 'Hitekautomation@gmail.com', '+919710503030', '', 'Incharge', 0, '1         ', '2018-02-12 11:07:44', '', '2018-02-12 11:07:44'),
(65, 'CON-101', 'Keerthi', '', '+917402107819', '', 'Incharge', 0, '1         ', '2018-02-15 13:34:49', '', '2018-02-15 13:34:49'),
(66, 'CON-102', 'srikanth', '', '+919789049050', '', 'Incharge', 0, '53        ', '2018-02-17 09:34:23', '', '2018-02-17 09:34:23'),
(67, 'CON-085', 'Alaguthamilvanan', ' ', ' 9500122233', ' ', 'Incharge', 0, '53        ', '2018-02-19 13:30:16', '', '2018-02-19 13:30:16'),
(69, 'CON-104', 'Venkatesh bharathi', ' ', '+919176928773', ' ', 'Incharge', 0, '53        ', '2018-02-21 11:30:35', '', '2018-02-21 11:30:35'),
(72, 'CON-049', 'Maria Yesu', '', '+919965905057', '', 'Incharge', 0, '53        ', '2018-02-22 11:32:29', '', '2018-02-22 11:32:29'),
(73, 'CON-094', 'Gopinath', '', '+918144551561', '', 'Incharge', 0, '53        ', '2018-02-22 12:16:11', '', '2018-02-22 12:16:11'),
(74, 'CON-105', 'Shiji.S', '', '+918179426661', '', 'Incharge', 0, '53        ', '2018-02-23 12:12:18', '', '2018-02-23 12:12:18'),
(75, 'CON-106', 'Vibin Krishna', '', '+919791040216', '', 'Incharge', 0, '53        ', '2018-02-26 11:29:49', '', '2018-02-26 11:29:49'),
(79, 'CON-048', 'Subburaj', '', '+919566426856', '', 'Incharge', 0, '53        ', '2018-02-28 14:20:05', '', '2018-02-28 14:20:05'),
(80, 'CON-035', 'Mohammed Ali', '', '+919094153822', '', 'Incharge', 0, '53        ', '2018-03-01 12:25:26', '', '2018-03-01 12:25:26'),
(81, 'CON-108', 'Saravana Kumar', '', '+917695988972', '', 'Incharge', 0, '53        ', '2018-03-05 10:22:03', '', '2018-03-05 10:22:03'),
(82, 'CON-109', 'Balasubramanian', '', '+919840078954', '', 'Incharge', 0, '53        ', '2018-03-06 15:15:51', '', '2018-03-06 15:15:51'),
(83, 'CON-110', 'Thirumurthi', '', '+919841894105', '', 'Managing Director', 0, '1         ', '2018-03-07 13:50:08', '', '2018-03-07 13:50:08'),
(85, 'CON-112', 'Thomson', '', '+919500082616', '', 'Incharge', 0, '53        ', '2018-03-09 16:36:14', '', '2018-03-09 16:36:14'),
(86, 'CON-079', 'Sivagnanam', '', '+919940572595', '', 'Incharge', 0, '53        ', '2018-03-10 12:09:31', '', '2018-03-10 12:09:31'),
(1086, 'CON-062', 'Revanth', '', '+919042940168', '', 'Incharge', 0, '53        ', '2018-03-13 10:29:24', '', '2018-03-13 10:29:24'),
(1092, 'CON-117', 'Sundar', '', '+919176539912', '', 'Incharge', 0, '53        ', '2018-03-21 10:09:55', '', '2018-03-21 10:09:55'),
(1099, 'CON-123', 'Maharaja', '', '+919940680104', '', 'Incharge', 0, '53        ', '2018-04-18 08:42:47', '', '2018-04-18 08:42:47'),
(1109, 'CON-129', 'Arul Kumar', 'arulkumar8422@gmail.com', '', '9600852343', 'Incharge', 0, '53        ', '2018-05-08 11:54:27', '', '2018-05-08 11:54:27'),
(1112, 'CON-132', 'Venkataraman', '', '+919444962099', '', 'Incharge', 0, '53        ', '2018-05-11 13:54:02', '', '2018-05-11 13:54:02'),
(1114, 'CON-134', ' Anil Chougule', '', '+919850957730', '', 'Incharge', 0, '53        ', '2018-05-14 17:16:54', '', '2018-05-14 17:16:54'),
(1116, 'CON-136', 'Vaiyaburi', '', '+919840962596', '', 'Incharge', 0, '53        ', '2018-05-22 09:34:28', '', '2018-05-22 09:34:28'),
(1117, 'CON-137', 'Pram Kumar', '', '+919884524597', '', 'Incharge', 0, '53        ', '2018-05-23 09:54:52', '', '2018-05-23 09:54:52'),
(1123, 'CON-144', 'Shanmuga Prakash', ' ', '9380105010', ' ', 'Senior Engineer', 0, '1         ', '2018-06-06 10:51:44', '', '2018-06-06 10:51:44'),
(1125, 'CON-146', 'Arif Shaikh	', '', '+919449595043', '', 'Incharge', 0, '53        ', '2018-06-08 08:33:05', '', '2018-06-08 08:33:05'),
(9, 'CON-045', 'vikramn', 'vikraman@bluebase.in', '+918608401612', ' ', 'Senior developer', 0, '1         ', '2017-11-23 08:57:49', '', '2017-11-23 08:57:49'),
(10, 'CON-050', 'MOHAMMED KASIM', '', '+919840016136', '', 'SUPERVISIOR', 0, '1         ', '2017-11-23 14:55:21', '', '2017-11-23 14:55:21'),
(36, 'CON-095', 'Rajesh.v', 'Email2Pascal@gmail.com', '+919980022929', '', 'Supervisor', 0, '1         ', '2018-02-01 10:34:29', '', '2018-02-01 10:34:29'),
(47, 'CON-018', 'Prathap', 'jayaenterprises2015@gmail.com', '+919566005815', '', '', 0, '1         ', '2018-02-07 11:34:04', '', '2018-02-07 11:34:04'),
(13, 'CON-051', 'MURALI', 'NORTHCHENNAI@GMAIL.COM', '+919600060703', ' +919789991215', 'SUPERVISIOR', 0, '1         ', '2017-11-23 16:08:18', '', '2017-11-23 16:08:18'),
(48, 'CON-021', 'Pugazhendhi', 'shivaexports3@yahoo.com', '+919444361077', '', '', 0, '1         ', '2018-02-07 11:35:57', '', '2018-02-07 11:35:57'),
(49, 'CON-026', 'Selvam', 'shakthi.electric@yahoo.com', '+919841816376', '', '', 0, '1         ', '2018-02-07 11:43:54', '', '2018-02-07 11:43:54'),
(50, 'CON-025', ' Rageesh', ' ', ' 8754093445', ' ', ' Incharge', 0, '1         ', '2018-02-07 11:44:53', '', '2018-02-07 11:44:53'),
(54, 'CON-046', 'Magesh M', ' ', '+919940073828', ' ', 'Incharge ', 0, '1         ', '2018-02-07 11:59:21', '', '2018-02-07 11:59:21'),
(55, 'CON-056', 'Saravanan', 'saravana.prabu@maxinadecors.com', '+919884221184', '', '', 0, '1         ', '2018-02-07 12:08:08', '', '2018-02-07 12:08:08'),
(56, 'CON-057', 'Venkatesan', ' Spvarunengineering@gmail.com', '+919843995747', ' ', ' incharge', 0, '1         ', '2018-02-07 12:09:03', '', '2018-02-07 12:09:03'),
(57, 'CON-088', 'Jeyalakshmi K', '', '+919840993079', '', 'Project Engineer', 0, '1         ', '2018-02-10 09:15:30', '', '2018-02-10 09:15:30'),
(60, 'CON-042', 'Muthu kumar R', '', '+919791010581', '', 'Senior Engineer', 0, '1         ', '2018-02-10 12:00:50', '', '2018-02-10 12:00:50'),
(63, 'CON-099', 'Mohammed Azarudeen', '', '+918939493478', '', 'Incharge', 0, '1         ', '2018-02-14 11:15:53', '', '2018-02-14 11:15:53'),
(68, 'CON-103', 'Kamal sekar', '', '+919444633629', '', 'Incharge', 0, '53        ', '2018-02-20 17:08:36', '', '2018-02-20 17:08:36'),
(76, 'CON-107', 'Thangavelu', ' ', '+919361122533', ' ', 'Unit Manager', 0, '53        ', '2018-02-27 09:57:52', '', '2018-02-27 09:57:52'),
(77, 'CON-071', 'Gopalakrishnan', '', '+919894881091', '', 'Incharge', 0, '53        ', '2018-02-27 15:02:07', '', '2018-02-27 15:02:07'),
(84, 'CON-111', 'Gunaraja.G', '', '+918940140980', '', 'Incharge', 0, '53        ', '2018-03-09 08:21:05', '', '2018-03-09 08:21:05'),
(1087, 'CON-113', 'Raj kumar', '', '+919790700716', '', 'Incharge', 0, '53        ', '2018-03-15 10:50:57', '', '2018-03-15 10:50:57'),
(1088, 'CON-114', 'Kishore kumar', '', '+919884591987', '', 'Incharge', 0, '53        ', '2018-03-16 10:42:58', '', '2018-03-16 10:42:58'),
(1089, 'CON-115', 'Gopalakrishnan', '', '+919003280873', '', 'Incharge', 0, '53        ', '2018-03-16 11:11:47', '', '2018-03-16 11:11:47'),
(1090, 'CON-077', 'Mohan selvaraj', '', '+919442604219', '', 'Incharge', 0, '53        ', '2018-03-19 12:45:19', '', '2018-03-19 12:45:19'),
(1093, 'CON-119', 'Sudhakar', '', '+919500016569', '', 'incharge', 0, '53        ', '2018-03-26 14:38:04', '', '2018-03-26 14:38:04'),
(1097, 'CON-121', 'Harshavardhan', '', '+918754498405', '', 'Incharge', 0, '53        ', '2018-04-09 14:37:28', '', '2018-04-09 14:37:28'),
(1101, 'CON-087', 'Vetri venthan', '', '+919894577690', '', 'Incharge', 0, '53        ', '2018-04-20 10:07:21', '', '2018-04-20 10:07:21'),
(1106, 'CON-069', 'Lawrence', '', '+917358626224', '', 'Incharge', 0, '53        ', '2018-04-30 11:15:00', '', '2018-04-30 11:15:00'),
(1110, 'CON-130', 'Ashok', 'Ashok.Chinnakannan@mt.com', '+919176041141', '', 'Incharge', 0, '53        ', '2018-05-10 10:19:37', '', '2018-05-10 10:19:37'),
(1126, 'CON-147', 'David', '', '+919940406867', '', 'Incharge', 0, '53        ', '2018-06-08 15:23:13', '', '2018-06-08 15:23:13'),
(1128, 'CON-149', 'Parthiban.R', '', '+919952826005', '', 'Incharge', 0, '53        ', '2018-06-13 11:22:56', '', '2018-06-13 11:22:56'),
(1129, 'CON-150', 'Manikandan', ' ', ' 7010646916', ' ', 'Incharge', 0, '53        ', '2018-06-15 08:04:34', '', '2018-06-15 08:04:34'),
(1134, 'CON-034', 'Dasan', '', '+919443788569', '', 'Incharge', 0, '53        ', '2018-06-21 09:19:27', '', '2018-06-21 09:19:27'),
(1137, 'CON-157', 'Parthiban', '', '+919840140106', '', 'Incharge', 0, '53        ', '2018-07-05 14:34:20', '', '2018-07-05 14:34:20'),
(1138, 'CON-158', 'Jagan Raj', '', '+919710109790', '', 'Incharge', 0, '53        ', '2018-07-10 15:18:36', '', '2018-07-10 15:18:36'),
(1140, 'CON-160', 'Vijayakumar', '', '+919566531454', '', 'Incharge', 0, '53        ', '2018-07-12 17:13:42', '', '2018-07-12 17:13:42'),
(1142, 'CON-164', 'Vaiyaburi', '', '+919840962596', '', 'Incharge', 0, '53        ', '2018-07-26 15:52:48', '', '2018-07-26 15:52:48'),
(1143, 'CON-165', 'Alex', '', '+919884017666', '', 'Incharge', 0, '53        ', '2018-08-06 13:36:15', '', '2018-08-06 13:36:15'),
(1144, 'CON-166', 'P.G.Krishnan 	', '', '+919444418045', '', 'Incharge', 0, '53        ', '2018-08-14 13:10:11', '', '2018-08-14 13:10:11'),
(2145, 'CON-169', 'Satheesh Kumar', '', '+919444969446', '', 'Incharge', 0, '53        ', '2018-08-29 10:40:33', '', '2018-08-29 10:40:33'),
(2149, 'CON-173', 'Balaji', '', '+919444480650', '', 'Incharge', 0, '53        ', '2018-09-25 10:17:03', '', '2018-09-25 10:17:03'),
(2150, 'CON-174', 'Sundar Rao  ', 'sundarrao_glicc@rediffmail.com', '+919448238269', '', 'MD', 0, '53        ', '2018-10-03 17:20:44', '', '2018-10-03 17:20:44'),
(2151, 'CON-175', 'Venkatesh', '', '+919600778894', '', 'Incharge', 0, '53        ', '2018-10-08 10:26:03', '', '2018-10-08 10:26:03'),
(2153, 'CON-177', 'Kaviyarasu', '', '+917358325625', '', 'Incharge', 0, '53        ', '2018-10-17 08:30:57', '', '2018-10-17 08:30:57');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_ismw_license`
--

DROP TABLE IF EXISTS `dbo.contractor_ismw_license`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_ismw_license` (
  `ismw_id` varchar(0) DEFAULT NULL,
  `contractor_code` varchar(0) DEFAULT NULL,
  `ismw_number` varchar(0) DEFAULT NULL,
  `ismw_upload` varchar(0) DEFAULT NULL,
  `from_date` varchar(0) DEFAULT NULL,
  `to_date` varchar(0) DEFAULT NULL,
  `max_workers` varchar(0) DEFAULT NULL,
  `active_workers` varchar(0) DEFAULT NULL,
  `is_deviation` varchar(0) DEFAULT NULL,
  `status` varchar(0) DEFAULT NULL,
  `remarks` varchar(0) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_master`
--

DROP TABLE IF EXISTS `dbo.contractor_master`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_master` (
  `contractor_id` smallint(6) DEFAULT NULL,
  `contractor_name` varchar(51) DEFAULT NULL,
  `period_from` varchar(10) DEFAULT NULL,
  `period_to` varchar(10) DEFAULT NULL,
  `contractor_address` varchar(183) DEFAULT NULL,
  `contractor_address1` varchar(142) DEFAULT NULL,
  `contractor_address_upload` varchar(0) DEFAULT NULL,
  `nature_of_work` varchar(80) DEFAULT NULL,
  `contractor_employer_name` varchar(37) DEFAULT NULL,
  `TIN` varchar(0) DEFAULT NULL,
  `TIN_upload` varchar(0) DEFAULT NULL,
  `PAN` varchar(0) DEFAULT NULL,
  `PAN_upload` varchar(0) DEFAULT NULL,
  `SERVICETAX` varchar(0) DEFAULT NULL,
  `SERVICETAX_upload` varchar(0) DEFAULT NULL,
  `pf` varchar(14) DEFAULT NULL,
  `pf_number` varchar(37) DEFAULT NULL,
  `pf_remarks` varchar(33) DEFAULT NULL,
  `pf_number1` varchar(1) DEFAULT NULL,
  `esi` varchar(14) DEFAULT NULL,
  `esi_number` varchar(25) DEFAULT NULL,
  `esi_remarks` varchar(64) DEFAULT NULL,
  `esi_number1` varchar(1) DEFAULT NULL,
  `contractor_photo` varchar(4) DEFAULT NULL,
  `contractor_signature` varchar(62) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `toshiba_employee_id` varchar(8) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_deviation` tinyint(4) DEFAULT NULL,
  `remarks` varchar(68) DEFAULT NULL,
  `sub_contractor_name` varchar(18) DEFAULT NULL,
  `no_of_workers` varchar(3) DEFAULT NULL,
  `approve_status` varchar(0) DEFAULT NULL,
  `wages_period_id` varchar(8) DEFAULT NULL,
  `created_by` varchar(2) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `modified_by` varchar(2) DEFAULT NULL,
  `modified_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_master`
--

INSERT INTO `dbo.contractor_master` (`contractor_id`, `contractor_name`, `period_from`, `period_to`, `contractor_address`, `contractor_address1`, `contractor_address_upload`, `nature_of_work`, `contractor_employer_name`, `TIN`, `TIN_upload`, `PAN`, `PAN_upload`, `SERVICETAX`, `SERVICETAX_upload`, `pf`, `pf_number`, `pf_remarks`, `pf_number1`, `esi`, `esi_number`, `esi_remarks`, `esi_number1`, `contractor_photo`, `contractor_signature`, `contractor_code`, `toshiba_employee_id`, `status`, `is_deviation`, `remarks`, `sub_contractor_name`, `no_of_workers`, `approve_status`, `wages_period_id`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'G4S Secure Solutions (India Pvt Ltd) ', '2019-01-07', '2020-03-31', 'Old No 42A/ New No 49, CP Ramasamy Road, Abhiramapuram,Chennai - 600018', 'Old No 42A/ New No 49, CP Ramasamy Road, Abhiramapuram,Chennai - 600018', '', 'Security Services', ' Kuppuswamy', '', '', '', '', '', '', 'yes', ' TNMAS0030902000', '                ', ' ', 'yes', '51110166400011018 ', '               ', ' ', 'NULL', 'NULL', 'CON-001', '120274TJ', 0, 1, '                        NULL                        ', '             ', '84', '', 'MONTHLY', '1 ', '2017-11-22 10:53:05', '', ''),
(2, 'SRI JAYA ENTERPRISES', '2019-01-08', '2019-09-30', 'NO 19, 5TH STREET,\r\nANNAI SIVAGAMI\r\nNAGAR, ENNORE\r\nCHENNAI - 600057\r\n', 'NO 19, 5TH STREET\r\nANNAI SIVAGAMI\r\nNAGAR, ENNORE\r\nCHENNAI - 600057\r\n', '', 'FABRICATION AND ERECTION WORK', 'B.TAMILARASAN', '', '', '', '', '', '', 'yes', 'EPF/CHN/RO/TN84689', '       ', ' ', 'yes', '51001070200000600', '       ', ' ', 'NULL', 'NULL', 'CON-002', '140840TJ', 0, 1, '      NULL      ', '    ', '40', '', 'MONTHLY', '1 ', '2017-11-22 11:35:41', '', ''),
(3, 'KIRUTHIKA ELECTRICALS & ENTERPRISES', '2018-01-01', '2018-09-30', '\"C-18, GOVINDAN NAGAR,\r\n2 ND MAIN ROAD,\r\n2 ND STREET,\r\nPALAVAKKAM,CHENNAI- 600 041.\"\r\n', '\"C-18, GOVINDAN NAGAR,\r\n2 ND MAIN ROAD,\r\n2 ND STREET,\r\nPALAVAKKAM,CHENNAI- 600 041.\"\r\n', '', 'ELECTRICAL INSTALLATION', ' ', '', '', '', '', '', '', 'yes', ' ', 'Enter Later ', ' ', 'yes', ' ', 'Enter Later ', ' ', 'NULL', 'NULL', 'CON-003', '160996TJ', 0, 1, ' NULL ', '', '15', '', 'MONTHLY', '1 ', '2017-11-22 11:51:40', '', ''),
(4, 'MOTHER MARIA ENTERPRISES', '2019-01-08', '2020-03-31', 'NO - 10 , AMIRDHAMMAL NAGAR\r\nSEETHAPATHY -  ST , (NEAR LOTUS\r\nCOLONY 1St STREET ) , MADHAVARAM ,\r\nCHENNAI - 600 060 .\r\n', 'NO - 10 , AMIRDHAMMAL NAGAR\r\nSEETHAPATHY -  ST , (NEAR LOTUS\r\nCOLONY 1St STREET ) , MADHAVARAM ,\r\nCHENNAI - 600 060 .\r\n', '', 'ENGINEERING & CONTRACTORS', 'D . JESINTHA', '', '', '', '', '', '', 'yes', 'TN/AMB/1395441/000', '       ', ' ', 'yes', '51001149530000900', '       ', ' ', 'NULL', 'NULL', 'CON-004', '110184TJ', 0, 1, '      NULL      ', '      ', '18', '', 'MONTHLY', '1 ', '2017-11-22 12:14:12', '', ''),
(5, 'ENVIRO METALS RECYCLERS PRIVATE LIMITED', '2019-01-28', '2020-03-31', 'S.No 104 & 106 Ezhichur Village, Oragadam, Chennai - 603204\r\n', 'S.No 104 & 106 Ezhichur Village, Oragadam, Chennai - 603204\r\n', '', 'Scrap Collection', 'Mr.Chinnakaruppan ', '', '', '', '', '', '', 'yes', 'TNAMB0069696000', '             ', ' ', 'not applicable', ' ', 'Not Applicable. They had submitted EC Policy Number.           ', ' ', 'NULL', 'NULL', 'CON-005', '130371TJ', 0, 1, '            NULL            ', '        ', '17', '', 'MONTHLY', '1 ', '2017-11-22 12:21:45', '', ''),
(6, 'Sanjay Engineering & Energy Solutions', '2018-01-01', '2018-09-30', 'No.18. Mangayarkarasi Street,\r\n1st Cross Street, Madhanandhapuram,\r\nPorur, Chennai - 600 116.\r\n', 'No.18. Mangayarkarasi Street,\r\n1st Cross Street, Madhanandhapuram,\r\nPorur, Chennai - 600 116.\r\n', '', 'A-Grade Electrical Contractor', 'DJEARANI', '', '', '', '', '', '', 'yes', 'TBTAM1443961000', '   ', ' ', 'yes', '51001148120000699', '   ', ' ', 'NULL', '/TOSHIBA/images/Contractor/Signature/CON-006-DJEARANI SIGN.JPG', 'CON-006', '130408TJ', 0, 1, '  NULL  ', '', '17', '', 'MONTHLY', '1 ', '2017-11-22 12:30:38', '1 ', '2017-11-22 12:34:16'),
(7, 'LEAD HR SERVICES PVT LTD', '2018-01-01', '2018-09-30', 'LEAD HR SERVICES PVT LTD,502,5 TH FLOOR,CHALLAMAL NO 11,SIR THIYAGARAYA ROAD, T.NAGAR, CHENNAI - 600017', 'LEAD HR SERVICES PVT LTD,502,5 TH FLOOR,CHALLAMAL NO 11,SIR THIYAGARAYA ROAD, T.NAGAR, CHENNAI - 600017', '', 'OUTSOURCING', ' Anvir', '', '', '', '', '', '', 'yes', 'TN/MAS/54043', '   ', ' ', 'yes', '51000896290001', '   ', ' ', 'NULL', 'NULL', 'CON-007', '100070TJ', 0, 1, '  NULL  ', '  ', '250', '', 'MONTHLY', '1 ', '2017-11-22 13:35:29', '', ''),
(8, 'BERGGRUEN CAR RENTALS PVT LTD', '2019-01-07', '2020-03-31', 'NO.MF 12 B\r\nTHIRU-VI-KA INDUSTRIAL ESTATE\r\nGUINDY, CHENNAI-600032.\r\n', 'NO.MF 12 B\r\nTHIRU-VI-KA INDUSTRIAL ESTATE\r\nGUINDY, CHENNAI-600032.\r\n', '', 'MOTOR TRANSPORT', 'S.P.BALASUBRAMANIYAN', '', '', '', '', '', '', 'yes', 'MH/BAN/49014', '      ', ' ', 'yes', '51310499190021000', '      ', ' ', 'NULL', 'NULL', 'CON-008', '150915TJ', 0, 1, '     NULL     ', '     ', '20', '', 'MONTHLY', '1 ', '2017-11-22 14:21:03', '', ''),
(9, 'COMPASS GROUP INDIA SUPPORT SERVICES PVT. LTD', '2019-01-07', '2020-03-31', ' #29, HM Centre, First Floor,  Nungambakkam High Road , Nungambakkam, Chennai Ã¢â‚¬â€œ 600 034,  India.', ' #29, HM Centre, First Floor,  Nungambakkam High Road , Nungambakkam, Chennai Ã¢â‚¬â€œ 600 034,  India.', '', 'CATERING', 'Vivek', '', '', '', '', '', '', 'yes', 'TN/MAS/52711', '                                 ', ' ', 'yes', ' 51000752910001001', '                            ', ' ', 'NULL', 'NULL', 'CON-009', '150915TJ', 0, 1, '                                NULL                                ', '       ', '50', '', 'MONTHLY', '1 ', '2017-11-22 14:37:47', '', ''),
(52, 'SHAKTHI ELECTRICALS CHENNAI (P) LTD', '2018-01-01', '2018-09-30', '2A,  (OLD -10C), MADHAVAMANI AVENUE, VELACHERY MAIN ROAD, VELACHERY, CHENNAI - 42.', ' \r\n', '', 'ELECTRICAL WORK', ' ', '', '', '', '', '', '', 'no', ' ', '        ', ' ', 'no', ' ', '        ', ' ', 'NULL', 'NULL', 'CON-052', '100044TJ', 0, 1, '       NULL       ', '', '15', '', 'MONTHLY', '1 ', '2017-11-27 16:00:13', '', ''),
(53, 'ANNA EQUIPMENTS PVT LTD', '2019-01-22', '2019-12-30', 'DR. SUBARAYA NAGAR,\r\n1 ST STREET, KODAMBAKKAM, CHENNAI-28', 'DR. SUBARAYA NAGAR,\r\n1 ST STREET, KODAMBAKKAM, CHENNAI-28', '', 'caftetery dishwash', 'V Anna Malai', '', '', '', '', '', '', 'not applicable', ' ', '       ', ' ', 'not applicable', ' ', '      ', ' ', 'NULL', 'NULL', 'CON-053', '150915TJ', 0, 1, '         NULL         ', '      ', '5', '', 'MONTHLY', '1 ', '2017-11-28 12:42:06', '', ''),
(55, 'SUPREME PETRO PRODUCTS', '2018-10-22', '2019-12-30', 'AP-200, I BLOCK, 10TH STREET, VALLALAR KUDYIRIPPU, ANNA NAGAR WEST, CHENNAI - 600040', ' ', '', 'VEST OIL WORK', 'MANAVALAN', '', '', '', '', '', '', 'not applicable', ' ', '    ', ' ', 'no', ' ', 'NOT ENTERED   ', ' ', 'NULL', 'NULL', 'CON-055', '120305TJ', 0, 1, '   NULL   ', '   ', '5', '', 'MONTHLY', '1 ', '2017-11-29 10:38:34', '', ''),
(58, 'SRI BALAJI GRANE SERVICE & VIJAYAN INSULATION', '2019-01-31', '2020-03-31', '4/130, M.A. KOVIL STREET, KANNAMPALAYAM, CHENNAI-52', '4/130, M.A. KOVIL STREET, KANNAMPALAYAM, CHENNAI-52', '', 'CRANE OPERATION', 'RAJA V', '', '', '', '', '', '', 'yes', 'TNAMB0069187000', '       ', ' ', 'no', ' ', '       ', ' ', 'NULL', 'NULL', 'CON-058', '110102TJ', 0, 1, '      NULL      ', '     ', '5', '', 'MONTHLY', '1 ', '2017-11-30 12:36:33', '', ''),
(59, 'SHAKKTI SANCHAR RENEWABLE ENERGY ', '2018-12-05', '2019-12-30', '73, SOUTH TANK STREET, THIRUVALLUR, TAMILNADU, 602001', '73, SOUTH TANK STREET, THIRUVALLUR, TAMILNADU, 602001', '', 'CCTV INSTALLATION', 'K RAJESH', '', '', '', '', '', '', 'not applicable', ' ', '    Update later     ', ' ', 'not applicable', '51001175910000999', '            ', ' ', 'NULL', 'NULL', 'CON-059', '100044TJ', 0, 1, '           NULL           ', '    ', '8', '', 'MONTHLY', '1 ', '2017-11-30 17:07:15', '', ''),
(62, 'RISHWA ENGINEERING AND RENTALS PVT LTD', '2018-10-10', '2019-01-30', '3/164, PERUMAL kOIL STREET KOSAPPUR, CHENNAI-600060', '3/164, PERUMAL kOIL STREET KOSAPPUR, CHENNAI-600060', '', 'FORK LIFT', 'Jayabalan', '', '', '', '', '', '', 'yes', ' TN/AMP1324690', '      ', ' ', 'yes', ' 510011328100606', '      ', ' ', 'NULL', 'NULL', 'CON-062', '100059TJ', 0, 1, '        NULL        ', '    ', '10', '', 'MONTHLY', '1 ', '2017-12-06 11:16:09', '', ''),
(64, 'EMINENT NDT Services', '2018-12-18', '2019-01-30', 'No.10,2nd cross street, Kalaimagal nagar ,Ekkattuthangal, Chennai -6000124', 'No.10,2nd cross street, Kalaimagal nagar ,Ekkattuthangal, Chennai -6000124', '', 'vedio scope inspection', ' ', '', '', '', '', '', '', 'not applicable', ' ', 'No    ', ' ', 'no', ' ', 'enter later   ', ' ', 'NULL', 'NULL', 'CON-064', '140768TJ', 0, 1, '   NULL   ', '   ', '3', '', 'MONTHLY', '1 ', '2017-12-07 09:42:04', '', ''),
(65, 'Lee &Muirhead Pvt Ltd', '2018-10-22', '2019-01-30', '10,G.N chetty Road,T. Nagar ,Chennai', ' ', '', 'Transportation Cargo Handling', 'Ravindranathan', '', '', '', '', '', '', 'no', ' ', ' No Number    ', ' ', 'no', ' ', 'No Number    ', ' ', 'NULL', 'NULL', 'CON-065', '110118TJ', 0, 1, '    NULL    ', '   ', ' 20', '', 'MONTHLY', '1 ', '2017-12-07 11:39:26', '', ''),
(66, 'RAYSONIC NDT SERVICES', '2018-10-03', '2019-01-30', '29-A ARCOT ROAD PORUR CHENNAI-600116', '29-A ARCOT ROAD PORUR CHENNAI-600116', '', 'POST WELD HEAT TREATMENT', 'SRIDHAR KANDHASAMY', '', '', '', '', '', '', 'yes', 'TBTAM0064032000', '      ', ' ', 'yes', '51001081670000999', '      ', ' ', 'NULL', 'NULL', 'CON-066', '140728TJ', 0, 1, '     NULL     ', '    ', ' 5', '', 'MONTHLY', '1 ', '2017-12-07 13:59:51', '', ''),
(68, 'OPTIMUS AUTOMATION SYSTEM', '2019-01-30', '2020-03-31', 'AMMBATHUR -OT,\r\nCHENNAI.', 'AMMBATHUR -OT,\r\nCHENNAI.', '', 'SERVICE', 'VINOTH', '', '', '', '', '', '', 'no', ' ', '        ', ' ', 'yes', ' ', 'NOT ENTER       ', ' ', 'NULL', 'NULL', 'CON-068', '090004TJ', 0, 1, '       NULL       ', '       ', '3', '', 'MONTHLY', '1 ', '2017-12-08 09:46:48', '', ''),
(70, 'EMPIRE MACHINE TOOLS', '2018-11-27', '2019-09-30', 'NO 548, MOUNT ROAD, TENAMPET,CHENNAI-600018', 'NO 548, MOUNT ROAD, TENAMPET,CHENNAI-600018', '', 'PROGRAMMING SUPPORT', ' ', '', '', '', '', '', '', 'yes', ' ', 'NOT ENTERD    ', ' ', 'yes', ' ', 'NOT ENTERD    ', ' ', 'NULL', 'NULL', 'CON-070', '100058TJ', 0, 1, '    NULL    ', '    ', '5', '', 'MONTHLY', '1 ', '2017-12-12 10:34:29', '', ''),
(73, 'MOGORA COSMIC PVT LTD', '2018-11-15', '2019-12-30', 'EL 31/16 ELECTRONIC ZONE, PIMPRI INDUSTRIAL AREA, M.I.D.C. BHOSARI, PUNE -411026', 'EL 31/16 ELECTRONIC ZONE, PIMPRI INDUSTRIAL AREA, M.I.D.C. BHOSARI, PUNE -411026', '', 'WELDING MACHINE', 'S S HEGDE', '', '', '', '', '', '', 'yes', 'MH/30488/315', '        ', ' ', 'yes', '4010/131435204/00/000', '        ', ' ', 'NULL', 'NULL', 'CON-073', '120307TJ', 0, 1, '       NULL       ', '       ', '4', '', 'MONTHLY', '1 ', '2017-12-15 10:48:58', '', ''),
(105, 'Benco Thermal technologies pvt ltd', '2018-12-07', '2019-01-30', 'No 236 /237 Sidco Industrial estate Thirumudivakkam ch-600044', 'No 236 /237 Sidco Industrial estate Thirumudivakkam ch-600044', '', 'Repair and service 100ton Furnace', 'Venkatesh Bharathi', '', '', '', '', '', '', 'yes', 'TBTAM0048183/000/0000', '         ', ' ', 'yes', ' 51000577320000506', '     ', ' ', 'NULL', 'NULL', 'CON-104', '120307TJ', 0, 1, '        NULL        ', '    ', '6', '', 'MONTHLY', '53', '2018-02-21 11:29:58', '', ''),
(2216, 'Blue Bird network ', '2019-12-10', '2019-12-30', 'NO. 3/408, 2A, KONDATHA AMMAN\r\nNAGAR,,PERUMANALLUR,,TIRUPUR,Dist:Ti\r\nruppurTamilnadu641666', '', '', 'PROGRAMMING WORK', '', '', '', '', '', '', '', 'no', '', '', '', 'yes', '56001132160000999', '', '', 'NULL', 'NULL', 'CON-216', '120289TJ', 0, 1, 'NULL', 'NULL', '2', '', ' MONTHLY', '1 ', '2019-12-10 09:43:49', '', ''),
(10, 'LIFETIME WELLNESS RX INTERNATIONAL LTD', '2019-01-18', '2020-03-31', '5TH FLOOR, LIFE SCIENCES BUILDING, APOLLO HEALTH CITY, JUBILEE HILLS, HYDERABAD, 500096, India ', '5TH FLOOR, LIFE SCIENCES BUILDING, APOLLO HEALTH CITY, JUBILEE HILLS, HYDERABAD, 500096, India ', '', 'Occupation Health Centre', ' Savari sagaya Maghi', '', '', '', '', '', '', 'yes', 'APHYD0042991000', '               ', ' ', 'yes', ' 51520230130011001', '               ', ' ', 'NULL', 'NULL', 'CON-010', '120287TJ', 0, 1, '                 NULL                 ', '           ', '25', '', 'MONTHLY', '1 ', '2017-11-22 15:27:19', '', ''),
(11, ' Blue Star Limited', '2019-02-01', '2019-09-30', 'No 2,KRM plaza Harring ton road cheatpet ch-600113', 'No 2 , KRM Plaza, Harington Road, Chetpet - 600113', '', 'Heat Ventilation and Air Conditioning Work', ' Maruthupandian', '', '', '', '', '', '', 'yes', ' TNMAS/26224', '          ', ' ', 'no', ' ', 'enter later                ', ' ', 'NULL', 'NULL', 'CON-011', '160998TJ', 0, 1, '                NULL                ', '       ', '30', '', 'MONTHLY', '1 ', '2017-11-22 15:34:15', '', ''),
(12, 'Chellu Nagaraju', '2019-01-09', '2020-03-31', 'Plot No: 17, 18 and 19, Kesava Towers, Balaji Nagar, Puliambedu, Chennai, 600077, India', 'Plot No: 17, 18 and 19, Kesava Towers, Balaji Nagar, Puliambedu, Chennai, 600077, India', '', 'Packing Work', ' Balu', '', '', '', '', '', '', 'yes', ' TBTAM1346485000', '       ', ' ', 'yes', ' 51001135730000999', '        ', ' ', 'NULL', 'NULL', 'CON-012', '150944TJ', 0, 1, '          NULL          ', '       ', '15', '', 'MONTHLY', '1 ', '2017-11-22 15:37:34', '', ''),
(13, 'ELECTRO KLEEN SYSTEMS', '2019-01-18', '2020-03-31', 'First Floor, 20 Raghava Reddy Colony, East Street, Ashok Nagar, Chennai, India, Tamil Nadu, 600 083, India', 'First Floor, 20 Raghava Reddy Colony, East Street, Ashok Nagar, Chennai, India, Tamil Nadu, 600 083, India', '', 'Oil Management system', ' ANAND', '', '', '', '', '', '', 'yes', ' TNMAS/1652169000', '                ', ' ', 'yes', ' 51001213950999', '               ', ' ', 'NULL', 'NULL', 'CON-013', '120326TJ', 0, 1, '                 NULL                 ', '           ', '15', '', 'MONTHLY', '1 ', '2017-11-22 15:40:27', '', ''),
(14, ' Flexi Staffing Services Pvt Ltd', '2019-01-29', '2020-03-31', 'A 4 Cosmo Towers, No 11, Dr. Thomas Road,\r\nT Nagar, Chennai - 600 017.', 'A 4 Cosmo Towers, No 11, Dr. Thomas Road,\r\nT Nagar, Chennai - 600 017.', '', 'Packing Work', ' ', '', '', '', '', '', '', 'yes', ' TN/MAS/1459962000', '     ', ' ', 'yes', ' 51001157780000999', '     ', ' ', 'NULL', 'NULL', 'CON-014', ' ', 0, 1, '      NULL      ', '      ', '15', '', 'MONTHLY', '1 ', '2017-11-22 15:43:28', '', ''),
(15, 'Hariharan Foundations (P) Ltd', '2018-09-20', '2019-12-30', 'No.19/9, Chandra Vilas, Ground Floor, 8th Street, Dr.Radhakrishnan Salai, Mylapore, Chennai â€“ 600 004', 'No.19/9, Chandra Vilas, Ground Floor, 8th Street, Dr.Radhakrishnan Salai, Mylapore, Chennai â€“ 600 004', '', 'Civil work', ' Suman.A', '', '', '', '', '', '', 'yes', ' TNMAS0049717000', '          ', ' ', 'yes', ' 51000907640001001', '            ', ' ', 'NULL', 'NULL', 'CON-015', '110097TJ', 0, 1, '             NULL             ', '      ', '155', '', 'MONTHLY', '1 ', '2017-11-22 15:45:34', '', ''),
(16, 'HI-Tech Services ', '2019-01-08', '2020-03-31', 'No. 5 Bharathiyar Street, Kothanda Nadar Nagar,Sriperumbudur,Kanchipuram â€“ Dist Pin 602 105', 'No. 5 Bharathiyar Street, Kothanda Nadar Nagar,Sriperumbudur,Kanchipuram â€“ Dist Pin 602 105', '', 'Pest Control Services', ' ', '', '', '', '', '', '', 'yes', ' TN/MAS/0084688000', '               ', ' ', 'yes', ' 51001028590000999', '               ', ' ', 'NULL', 'NULL', 'CON-016', '110097TJ', 0, 1, '                  NULL                  ', '                ', '13', '', 'MONTHLY', '1 ', '2017-11-22 15:48:34', '', ''),
(17, 'INDFAB Engineers', '2018-01-01', '2018-09-30', 'Plot No; 7, 1st Floor, Kambar Street,Venkateswara Nagar, Ambattur, Chennai 600 053', 'Plot No; 7, 1st Floor, Kambar Street,Venkateswara Nagar, Ambattur, Chennai 600 053', '', 'Floor plate installation', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later ', ' ', 'yes', ' ', 'enter later ', ' ', 'NULL', 'NULL', 'CON-017', '', 0, 1, ' NULL ', '', '10', '', 'MONTHLY', '1 ', '2017-11-22 15:50:23', '', ''),
(18, 'Jaya Enterprises', '2019-01-09', '2020-03-31', 'No 2/271, Vinayagar Koil Street, Andarkuppam, \r\nChennai - 600 103.', 'No 2/271, Vinayagar Koil Street, Andarkuppam, \r\nChennai - 600 103.', '', 'Supply of Manpower for Cleaning work', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later        ', ' ', 'yes', ' ', 'enter later        ', ' ', 'NULL', 'NULL', 'CON-018', '140834TJ', 0, 1, '        NULL        ', '      ', '10', '', 'MONTHLY', '1 ', '2017-11-22 15:53:37', '', ''),
(19, 'JR Furnace and Ovens Private Limited', '2018-01-01', '2018-09-30', 'L-4, Sidco Industrial Estate, Villivakkam,\r\nChennai - 600 049.', 'L-4, Sidco Industrial Estate, Villivakkam,\r\nChennai - 600 049.', '', 'Erection of Electrical Panel, Cable Laying and Lift Fixture', ' ', '', '', '', '', '', '', 'not applicable', ' ', '  ', ' ', 'not applicable', ' ', '  ', ' ', 'NULL', 'NULL', 'CON-019', '', 0, 1, '   NULL   ', '', '10', '', 'MONTHLY', '1 ', '2017-11-22 15:55:23', '', ''),
(20, 'K2 Cranes & components Pvt.Ltd', '2018-01-01', '2018-09-30', '14-A,Telugu Brahmin Street, Velachery,Chennai-600042', '14-A,Telugu Brahmin Street, Velachery,Chennai-600042', '', 'Crane Service', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later ', ' ', 'yes', ' ', 'enter later ', ' ', 'NULL', 'NULL', 'CON-020', '', 0, 1, ' NULL ', '', '5', '', 'MONTHLY', '1 ', '2017-11-22 15:56:58', '', ''),
(21, 'Kaveri Irrigation', '2019-01-18', '2020-03-31', 'No. 49, A/1 1st floor ,S.K.S Building, 2nd Street,Papathi Kadu Thottam, Municipal Colony,Veerapanchatram (PO) Erode - 638004', 'No. 49, A/1 1st floor ,S.K.S Building, 2nd Street,Papathi Kadu Thottam, Municipal Colony,Veerapanchatram (PO) Erode - 638004', '', 'Landscape Irrigation system Services', 'Athiban', '', '', '', '', '', '', 'yes', ' CBSLM1319166000', '             ', ' ', 'yes', ' 56001156000001001', '            ', ' ', 'NULL', 'NULL', 'CON-021', '110097TJ', 0, 1, '               NULL               ', '         ', '50', '', 'MONTHLY', '1 ', '2017-11-22 15:58:39', '', ''),
(22, 'Makino India Pvt Ltd', '2018-01-01', '2018-09-30', 'Salzburg Square, 4th Floor, No.107, Harrington Road, Chetpet, Chennai â€“ 600031', 'Salzburg Square, 4th Floor, No.107, Harrington Road, Chetpet, Chennai â€“ 600031', '', 'Machine Service', ' Eshan Chandra Pradhan', '', '', '', '', '', '', 'no', ' ', 'Update later', ' ', 'no', ' ', 'Update later', ' ', 'NULL', 'NULL', 'CON-022', '120307TJ', 0, 1, '    NULL    ', '  ', '3', '', 'MONTHLY', '1 ', '2017-11-22 16:00:25', '', ''),
(23, ' Masibus Automation & Instrumentation (P) Ltd', '2018-01-01', '2018-09-30', 'B / 30, G.I.D.C., Electronics Zone, Sector â€“ 25,  Gandhi Nagar â€“ 382 044 Gujarat ', 'B / 30, G.I.D.C., Electronics Zone, Sector â€“ 25,  Gandhi Nagar â€“ 382 044 Gujarat ', '', 'PLC systems configuration work in GTB Area', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later ', ' ', 'yes', ' ', 'enter later ', ' ', 'NULL', 'NULL', 'CON-023', '', 0, 1, ' NULL ', '', '10', '', 'MONTHLY', '1 ', '2017-11-22 16:02:03', '', ''),
(24, 'MAX Engineering Technologies Pvt Ltd', '2018-10-25', '2019-01-30', 'Carrier Authorised Dealer, #9, Sarojkhanna Complex, Dr. Radhakrishnan nagar,E.V.R. Road, Arumbakkam, Chennai - 600 106.', 'Carrier Authorised Dealer, #9, Sarojkhanna Complex, Dr. Radhakrishnan nagar,E.V.R. Road, Arumbakkam, Chennai - 600 106.', '', 'AC Service ', ' Praveen ', '', '', '', '', '', '', 'yes', ' TNAMB/1312585000', '  ', ' ', 'yes', '510010561900000999', '  ', ' ', 'NULL', 'NULL', 'CON-024', '160998TJ', 0, 1, '     NULL     ', '    ', '5', '', 'MONTHLY', '1 ', '2017-11-22 16:04:15', '', ''),
(25, ' Metec Design', '2018-01-01', '2018-09-30', 'No. 1/460, Multi Industrial Estate, Gerugambakkam,Porur, Chennai â€“ 600122', 'No. 1/460, Multi Industrial Estate, Gerugambakkam,Porur, Chennai â€“ 600122', '', 'Fire Fighting system Piping work', ' Rageesh', '', '', '', '', '', '', 'yes', ' TB/MAS/63100', '       ', ' ', 'yes', ' 51001024170001009', '       ', ' ', 'NULL', 'NULL', 'CON-025', '160998TJ', 0, 1, '            NULL            ', '  ', '18', '', 'MONTHLY', '1 ', '2017-11-22 16:14:27', '', ''),
(26, 'Shakthi Electricals chennai pvt. Ltd.', '2018-01-01', '2018-09-30', 'Old No: 10C, New No. 2A Madhavamani Avenue, Velachery Main Road, Velachary, Chennai â€“ 600 042', 'Old No: 10C, New No. 2A Madhavamani Avenue, Velachery Main Road, Velachary, Chennai â€“ 600 042', '', 'Erection of Electrical Panel, Cable Laying and Lift Fixture', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later   ', ' ', 'yes', ' ', 'Erection of Electrical Panel, Cable Laying and Lift Fixture\r\n   ', ' ', 'NULL', 'NULL', 'CON-026', '', 1, 1, '   NULL   ', '  ', '55', '', 'MONTHLY', '1 ', '2017-11-22 16:19:10', '', ''),
(27, 'Sun Star Engineering ', '2019-01-08', '2020-03-31', 'No. 1713 B- Type 3rd  Main Road Mathur, MMDA Manali , Chennai 600 068', 'No. 1713 B- Type 3rd  Main Road Mathur, MMDA Manali , Chennai 600 068', '', 'Chimney Painting', ' KALIDAS', '', '', '', '', '', '', 'yes', ' TN/MAS/0053728000', '                       ', ' ', 'yes', ' 51000889130001001', '                     ', ' ', 'NULL', 'NULL', 'CON-027', '100046TJ', 0, 1, '                          NULL                          ', '                  ', '150', '', 'MONTHLY', '1 ', '2017-11-22 16:20:56', '', ''),
(28, 'Toshiba Logistics India Private Limited', '2018-01-01', '2018-09-30', '4th Floor, Building No 10 Tower B,DLF Cyber City, Gurgoan, India, Haryana 122002.', '4th Floor, Building No 10 Tower B,DLF Cyber City, Gurgoan, India, Haryana 122002.', '', 'Packing Work', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later  ', ' ', 'yes', ' ', 'enter later  ', ' ', 'NULL', 'NULL', 'CON-028', '', 0, 1, '  NULL  ', '', '10', '', 'MONTHLY', '1 ', '2017-11-22 16:23:12', '', ''),
(29, ' TUV INDIA Pvt. Ltd', '2019-02-04', '2020-03-31', 'Dhun Building, 2nd Floor, 827, Annasalai, Chennai 600002', 'Dhun Building, 2nd Floor, 827, Annasalai, Chennai 600002', '', 'Third Party Inspection Service', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later     ', ' ', 'yes', ' ', 'enter later     ', ' ', 'NULL', 'NULL', 'CON-029', ' ', 0, 1, '     NULL     ', '     ', '3', '', 'MONTHLY', '1 ', '2017-11-22 16:25:07', '', ''),
(30, ' Ruba Engineering Contractors', '2018-01-01', '2018-12-31', 'No 4/15, Manali New Town, Chennai - 600 103.', 'No 4/15, Manali New Town, Chennai - 600 103.', '', 'Modification of existing pipelines and installation of new cartidge filter works', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later  ', ' ', 'yes', ' ', 'enter later  ', ' ', 'NULL', 'NULL', 'CON-030', '', 0, 1, '  NULL  ', '  ', '15', '', 'MONTHLY', '1 ', '2017-11-22 16:30:56', '', ''),
(31, 'SIEMENS LIMITED ', '2018-10-05', '2020-03-31', '130, P.B.Marg Worli, Mumbai, 400018, India', '130, P.B.Marg Worli, Mumbai, 400018, India', '', 'Erection of Electrical Panel, Cable Laying and Lift Fixture', ' ', '', '', '', '', '', '', 'yes', ' MH/BAN/4520/38288', '        ', ' ', 'not applicable', ' ', '        ', ' ', 'NULL', 'NULL', 'CON-031', '140700TJ', 0, 1, '          NULL          ', '      ', '15', '', 'MONTHLY', '1 ', '2017-11-22 16:33:38', '', ''),
(32, 'TESPRO SYSTEM ', '2019-01-18', '2020-03-31', 'A/215,V.M.Balakrishnan Street,S.M.Block,Ashok Nagar, Chennai, Tamilnadu, 600083, India', 'A/215,V.M.Balakrishnan Street,S.M.Block,Ashok Nagar, Chennai, Tamilnadu, 600083, India', '', 'Testing of Electrical Equipment', ' Senthamil Kumar V ', '', '', '', '', '', '', 'yes', 'TN/MAS/0093239000 ', '        ', ' ', 'yes', '51001086790000602 ', '        ', ' ', 'NULL', 'NULL', 'CON-032', '110189TJ', 0, 1, '           NULL           ', '          ', '25', '', 'MONTHLY', '1 ', '2017-11-22 16:37:11', '', ''),
(33, 'Samkal Electromech Private Limited', '2018-10-05', '2019-01-30', 'G-1, Solai Villa Anbu Nagar, 1st Street, Santhosapuram, Chennai - 600 073.', 'G-1, Solai Villa Anbu Nagar, 1st Street, Santhosapuram, Chennai - 600 073.', '', 'DG exhaust pipe and Insulation cladding material work ', ' Kingsley', '', '', '', '', '', '', 'yes', ' TBTAM1494362000', '                  ', ' ', 'yes', ' 51001166370000905', '                  ', ' ', 'NULL', 'NULL', 'CON-033', '100044TJ', 0, 1, '                       NULL                       ', '   ', '40', '', 'MONTHLY', '1 ', '2017-11-22 16:38:54', '', ''),
(34, ' M.M Engineers Pvt Ltd ', '2018-10-03', '2019-12-30', 'PB No 116, 15, Ponnuswamy Road Coimbatore 641 002', 'PB No 116, 15, Ponnuswamy Road Coimbatore 641 002', '', 'Electrical Overload travel   Crane Service', ' Dasan', '', '', '', '', '', '', 'yes', ' CB/CBE/0021606/000		', '        ', ' ', 'yes', ' 56000344470000600â€¦		', '        ', ' ', 'NULL', 'NULL', 'CON-034', ' ', 0, 1, '         NULL         ', '       ', '25', '', 'MONTHLY', '1 ', '2017-11-22 16:42:22', '', ''),
(35, 'Carrier Air Conditioning and refrigeration LTD. ', '2018-01-01', '2018-09-30', 'Old No.248 New No.114, Royapettah High Road, Royapettah, Chennai 600 014 ,Tamil Nadu, India.', 'Old No.248 New No.114, Royapettah High Road, Royapettah, Chennai 600 014 ,Tamil Nadu, India.', '', 'Chiller AMC and service', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later  ', ' ', 'yes', ' ', 'enter later  ', ' ', 'NULL', 'NULL', 'CON-035', '160998TJ', 0, 1, '  NULL  ', '  ', '10', '', 'MONTHLY', '1 ', '2017-11-22 16:44:04', '', ''),
(36, 'IMT EXIM INDIA PRIVATE LIMITED ', '2018-01-01', '2018-09-30', 'No.F4, 2nd Cross, 3rd North Phase, Thiru-Vi-Ka Industrial Estate, Ekkattuthangal,Chennaiâ€“ 97. Ph.044-45540442, Fax.044-42633445,Â Â Â Â Â Â ', 'No.F4, 2nd Cross, 3rd North Phase, Thiru-Vi-Ka Industrial Estate, Ekkattuthangal,Chennaiâ€“ 97. Ph.044-45540442, Fax.044-42633445,Â Â Â Â Â Â ', '', 'Servicing of Magnetic Lifters', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later ', ' ', 'yes', ' ', 'enter later ', ' ', 'NULL', 'NULL', 'CON-036', '', 0, 1, ' NULL ', '', '5', '', 'MONTHLY', '1 ', '2017-11-22 16:45:55', '', ''),
(37, 'AVM Labs pvt ltd', '2018-10-16', '2019-12-30', 'Door No.49, Moorthy Nagar,3rd Street, Chettiar Agaram, Porur, Chennai, Tamilnadu, 600077, India', 'Door No.49, Moorthy Nagar,3rd Street, Chettiar Agaram, Porur, Chennai, Tamilnadu, 600077, India', '', 'Instruments ( Flow meters ) Calibration work', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later        ', ' ', 'yes', ' ', 'enter later        ', ' ', 'NULL', 'NULL', 'CON-037', ' ', 0, 1, '        NULL        ', '        ', '8', '', 'MONTHLY', '1 ', '2017-11-23 08:18:56', '', ''),
(38, 'ALPHA AIRCON', '2018-10-24', '2019-12-30', 'N0.125, 1st main road, west Balaji Nagar, Kallikuppam, Ambattur, Chennai -600053', 'N0.125, 1st main road, west Balaji Nagar, Kallikuppam, Ambattur, Chennai -600053', '', 'Machine Breakdown Service / AMC', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later     ', ' ', 'yes', ' ', 'enter later     ', ' ', 'NULL', 'NULL', 'CON-038', ' ', 0, 1, '     NULL     ', '    ', '2', '', 'MONTHLY', '1 ', '2017-11-23 08:22:14', '', ''),
(39, 'POWERICA LIMITED ', '2019-01-08', '2019-12-30', '1E, GEE EMERALD 312, VILLAGE ROAD, NUNGAMBAKKAM, CHENNAI - 600 034', '1E, GEE EMERALD 312, VILLAGE ROAD, NUNGAMBAKKAM, CHENNAI - 600 034', '', 'Diesel Generator service & Diesel Generator Work', ' ', '', '', '', '', '', '', 'yes', ' MHBAN0036197000', '        ', ' ', 'yes', ' 51310325650011001', '        ', ' ', 'NULL', 'NULL', 'CON-039', '', 0, 1, '         NULL         ', '         ', '15', '', 'MONTHLY', '1 ', '2017-11-23 08:24:30', '', ''),
(40, 'All in Micron Service ', '2018-01-01', '2019-12-30', '12/16,LLIG,NH1 Manickawasgar Nagar,Maraimalai Nagar,Chennai-603209', '12/16,LLIG,NH1 Manickawasgar Nagar,Maraimalai Nagar,Chennai-603209', '', 'Laser Calibration', ' Karthikeyan', '', '', '', '', '', '', 'not applicable', ' ', '     ', ' ', 'not applicable', ' ', 'Submitted EC Policy      ', ' ', 'NULL', 'NULL', 'CON-040', '140834TJ', 0, 1, '            NULL            ', '  ', '2', '', 'MONTHLY', '1 ', '2017-11-23 08:26:43', '', ''),
(41, 'ROOTS MULTICLEAN LIMITED', '2018-01-01', '2019-09-30', '190, Defence Colony,Ekkattuthangal, Chennai â€“ 600032', '190, Defence Colony,Ekkattuthangal, Chennai â€“ 600032', '', 'Machine Breakdown Service / AMC', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later  ', ' ', 'yes', ' ', 'enter later  ', ' ', 'NULL', 'NULL', 'CON-041', '', 0, 1, '  NULL  ', '  ', '2', '', 'MONTHLY', '1 ', '2017-11-23 08:29:49', '', ''),
(42, 'T V Sundram Iyengar & Sons Limited', '2018-10-05', '2019-12-30', 'Construcion & Material Handling Services SBU,\r\n13/14, Bharathi Nagar 1st Street, Opp. North Usman Road, T.Nagar, Chennai - 600 017', 'Construcion & Material Handling Services SBU,\r\n13/14, Bharathi Nagar 1st Street, Opp. North Usman Road, T.Nagar, Chennai - 600 017', '', 'Scissors lift Servicing', ' ', '', '', '', '', '', '', 'yes', ' ', 'enter later     ', ' ', 'yes', ' ', 'enter later     ', ' ', 'NULL', 'NULL', 'CON-042', '100059TJ', 0, 1, '     NULL     ', '    ', '4', '', 'MONTHLY', '1 ', '2017-11-23 08:32:34', '', ''),
(43, ' PRECISE MACHINE TOOL SERVICES', '2018-10-03', '2020-03-31', '138, Pattaravakkam station Road, SIDCO Industrials Estate,\r\nAmbattur, Chennai - 600098, Tamil Nadu, India.', '138, Pattaravakkam station Road, SIDCO Industrials Estate,\r\nAmbattur, Chennai - 600098, Tamil Nadu, India.', '', 'Manpower supply for Machine Erection and Commissioning work', ' ', '', '', '', '', '', '', 'yes', ' TNAMB0067305000', '        ', ' ', 'yes', ' 51000881970000606', '       ', ' ', 'NULL', 'NULL', 'CON-043', '100058TJ', 0, 1, '           NULL           ', '      ', '25', '', 'MONTHLY', '1 ', '2017-11-23 08:35:42', '', ''),
(44, ' Prasad NC Machine systems Private Limited ', '2018-10-24', '2019-12-30', 'No.15/1, Mel Ayanambakkam Road, Ayanambakkam, Chennai 600 095.', 'No.15/1, Mel Ayanambakkam Road, Ayanambakkam, Chennai 600 095.', '', 'Boring Machine Erection Work (MM01)', 'Mohan', '', '', '', '', '', '', 'yes', ' TN/65704', 'enter later             ', ' ', 'not applicable', ' ', 'Not Applicable     ', ' ', 'NULL', 'NULL', 'CON-044', '120256TJ', 0, 1, '                     ', '    ', '15', '', 'MONTHLY', '1 ', '2017-11-23 08:38:14', '', ''),
(45, 'BLUEBASE SOFTWARE SERVICE PVT LTD', '2018-01-01', '2018-09-30', '#118,Anna salai,Manikkam Lane,\r\nGuindy, Chennai â€“ 600032\r\nINDIA', '#118,Anna salai,Manikkam Lane,\r\nGuindy, Chennai â€“ 600032\r\nINDIA', '', 'Software services', 'Chandrasehar', '', '', '', '', '', '', 'not applicable', ' ', '       ', ' ', 'yes', '51001150730009', '       ', ' ', 'NULL', 'NULL', 'CON-045', '120240TJ', 0, 1, '      NULL      ', '', '5', '', 'MONTHLY', '1 ', '2017-11-23 08:55:38', '', ''),
(46, 'GSH Utilities Services Private Limited', '2019-01-08', '2020-03-31', 'No 14, Thiru-Vi-Ka 3rd Street,Radhakrishnan Salai, Mylapore, Chennai - 600 004.', 'No 14, Thiru-Vi-Ka 3rd Street,Radhakrishnan Salai, Mylapore, Chennai - 600 004.', '', 'Operations and Electrical Maintenance work', ' Magesh', '', '', '', '', '', '', 'yes', 'TN/MAS/93310', '             ', ' ', 'yes', ' 51001098600001099', '             ', ' ', 'NULL', 'NULL', 'CON-046', '100067TJ', 0, 1, '                NULL                ', '           ', '60', '', 'MONTHLY', '1 ', '2017-11-23 09:57:20', '', ''),
(47, 'SEED FOR SAFETY', '2018-10-05', '2019-01-30', ' NO 5/414, AMBEDKAR STREET,NANMANGALAM, CHENNAI, INDIA. 600129', ' NO 5/414, AMBEDKAR STREET,NANMANGALAM, CHENNAI, INDIA. 600129', '', 'SERVICE', ' chandru', '', '', '', '', '', '', 'no', ' ', 'ENTER LATER       ', ' ', 'no', ' ', 'ENTER LATER       ', ' ', 'NULL', 'NULL', 'CON-047', '130383TJ', 0, 0, '       NULL       ', '    ', '6', '', 'MONTHLY', '1 ', '2017-11-23 10:20:56', '', ''),
(48, 'SAFETY LINKS', '2019-02-04', '2019-09-30', '7/275, LAKSHMI NAGAR,FIRST STREET,CHINNALOVILAMPAKKAM,CHENNAI.', '7/275, LAKSHMI NAGAR,FIRST STREET,CHINNALOVILAMPAKKAM,CHENNAI.', '', 'Inspection certificate service', 'Subburaj', '', '', '', '', '', '', 'yes', ' TBTAM0063653000', '           ', ' ', 'yes', 'TBTAM1474164', '       ', ' ', 'NULL', 'NULL', 'CON-048', '140639TJ', 0, 1, '              NULL              ', '      ', '10', '', 'MONTHLY', '1 ', '2017-11-23 10:23:18', '', ''),
(49, 'Quality Evaluation and system team pvt ltd', '2019-01-18', '2020-03-31', 'No 211 3rd floor 5th cross 9th main road jaya nagar second block  Banglore- 560011', ' No 211 3rd floor 5th cross 9th main road jaya nagar second block  Banglore- 560011', '', 'Inspection', ' maria Yesu', '', '', '', '', '', '', 'yes', ' BG/BNG/0011645/000/0000', 'enter later         ', ' ', 'no', ' ', 'enter later         ', ' ', 'NULL', 'NULL', 'CON-049', '100035TJ', 0, 1, '         NULL         ', '        ', '10', '', 'MONTHLY', '1 ', '2017-11-23 10:59:56', '', ''),
(50, 'LIMRAS POWER SOLUTION', '2018-01-01', '2018-09-30', 'NO 92,AADTHITHANAR SALAI,PUTHUPETAI,CHENNAI -600002', 'NO 92,AADTHITHANAR SALAI,PUTHUPETAI,CHENNAI -600002', '', 'LOADING ', 'Z SHAHUL HAMMED', '', '', '', '', '', '', 'yes', 'TNMAS1647818000', '   ', ' ', 'yes', '51001216020000699', '   ', ' ', 'NULL', 'NULL', 'CON-050', '130371TJ', 0, 1, '  NULL  ', '', '25', '', 'MONTHLY', '1 ', '2017-11-23 14:53:43', '', ''),
(107, 'Fanuc India pvt ltd', '2019-02-04', '2019-09-30', 'No 19,1st  floor RMK Towers sidco industial estates Ambattur ch-600098', 'No 19,1st  floor RMK Towers sidco industial estates Ambattur ch-600098', '', 'Repair & Maintenance (Fanuc Controller machines)', 'Vibin Krishna', '', '', '', '', '', '', 'yes', '1002082', '        ', ' ', 'no', ' ', '        ', ' ', 'NULL', 'NULL', 'CON-106', '120307TJ', 0, 1, '       NULL       ', '       ', '10', '', 'MONTHLY', '53', '2018-02-26 11:27:55', '', ''),
(1176, 'TECHNO PRODUCTS DEV P LTD', '2018-10-09', '2019-01-30', '21/121,4th Street,Metro Nagar,Alapakkam,Porur,Chennai-600116c\r\n\r\n', '21/121,4th Street,Metro Nagar,Alapakkam,Porur,Chennai-600116c', '', 'Service', 'Nethaji', '', '', '', '', '', '', 'no', '', 'Update Later', '', 'yes', '', 'Update Later', '', 'NULL', 'NULL', 'CON-176', '150866TJ', 0, 1, 'NULL', 'NULL', '5', '', 'MONTHLY', '53', '2018-10-09 09:47:07', '', ''),
(51, 'PARVEEN TRAVELS', '2019-01-07', '2020-03-31', 'NO 148 ,PERAMBUR BARRACKS ROAD, PURASAIVAKAM, CHENNAI-600007', 'NO 148 ,PERAMBUR BARRACKS ROAD, PURASAIVAKAM, CHENNAI-600007', '', 'TRAVELES', 'SHADHIK', '', '', '', '', '', '', 'yes', 'TNMAS0050550000', '                 ', ' ', 'yes', '51000760170001006', '                 ', ' ', 'NULL', 'NULL', 'CON-051', '120274TJ', 0, 1, '                NULL                ', '          ', '50', '', 'MONTHLY', '1 ', '2017-11-23 16:03:50', '', ''),
(54, 'TUNIP INFO SERVICES PVT LTD', '2018-09-27', '2019-01-30', '32,nehru nagar 1 st link street,\r\nRajivi gandhi salai,kottivakkam, chennai-600041.', '32,nehru nagar 1 st link street,\r\nRajivi gandhi salai,kottivakkam, chennai-600041.', '', 'PA Sysytems', 'JOSHY JOSEPH', '', '', '', '', '', '', 'yes', ' ', 'Enter later   ', ' ', 'yes', ' ', 'enter later   ', ' ', 'NULL', 'NULL', 'CON-054', '3000926', 0, 1, '   NULL   ', '   ', '6', '', 'MONTHLY', '1 ', '2017-11-28 15:19:39', '', ''),
(69, 'INFUSE KITCHEN EQUIPMENT SERVICE', '2018-01-01', '2018-09-30', 'OLD NO:2,NEW NO:3, ROYAPETTH HIGH ROAD,CHENNAI-600014', 'OLD NO:2,NEW NO:3, ROYAPETTH HIGH ROAD,CHENNAI-600014', '', 'BURNER CLEANING', ' Lawrence', '', '', '', '', '', '', 'no', ' ', 'Update later ', ' ', 'yes', '51001099060000606', '     ', ' ', 'NULL', 'NULL', 'CON-069', '150915TJ', 0, 1, '    NULL    ', '', ' 3', '', 'MONTHLY', '1 ', '2017-12-11 12:40:10', '', ''),
(74, 'GRAASS MHE PRIVATE LIMITED', '2019-01-09', '2020-03-31', '252,253 STEEL CITY, POONAMALLEE BYE PASS ROAD\r\nPOONAMALLEE CHENNAI- 600056\r\n', '252,253 STEEL CITY, POONAMALLEE BYE PASS ROAD\r\nPOONAMALLEE CHENNAI- 600056', '', 'FORK LIFT SERVICE', 'Ramanathan.N', '', '', '', '', '', '', 'yes', 'TBTAM0063066000', '              ', ' ', 'yes', '51001031860000999', '              ', ' ', 'NULL', 'NULL', 'CON-074', '100059TJ', 0, 1, '             NULL             ', '    ', ' 10', '', 'MONTHLY', '1 ', '2017-12-15 11:45:15', '', ''),
(76, 'SUN LABORATORIY SERVICES (SUN TEKNOLOZY)', '2019-01-30', '2019-12-30', 'LAKSHMI DWARAKA VILLA 14/1 THALAYARI STREET, WEST MAMBALAM CHENNAI 600033', 'LAKSHMI DWARAKA VILLA 14/1 THALAYARI STREET, WEST MAMBALAM CHENNAI 600033', '', 'AIR MONITORING', 'V D SRINATH', '', '', '', '', '', '', 'not applicable', ' ', '    ', ' ', 'yes', '120121727110000', '    ', ' ', 'NULL', 'NULL', 'CON-076', '100067TJ', 0, 1, '   NULL   ', '   ', '3', '', 'MONTHLY', '1 ', '2017-12-15 15:32:41', '', ''),
(77, 'VGR ENGINEERIN SERVICES PVT. lTD', '2019-01-28', '2019-09-30', 'NO 100 APPOLO DUBAI PLAZA S 6 2ND FLOOR KODAMBAKKAM, CHENNAI - 600034', '724, SECTOR-22, POCKET-B, GURGAON-122001', '', 'COOLENT MONITORING', 'HARI SHANKAR', '', '', '', '', '', '', 'yes', ' GNGGN0007628000', '          ', ' ', 'yes', ' 69220180710011002', '          ', ' ', 'NULL', 'NULL', 'CON-077', '120326TJ', 0, 1, '         NULL         ', '    ', '1', '', 'MONTHLY', '1 ', '2017-12-18 11:03:55', '', ''),
(88, 'VEGA INDIA LEVEL & PRESSURE MEASUREMENT PVT LTD', '2018-01-01', '2018-09-30', 'PLOT NO 1 GAT NO 181, VILLAGE - PHULGAON, TAL, HAVELI, PHULGAON INDUSTRIAL ESTATE, PUNE - 412216', 'PLOT NO 1 GAT NO 181, VILLAGE - PHULGAON, TAL, HAVELI, PHULGAON INDUSTRIAL ESTATE, PUNE - 412216', '', 'SENSER TUNING WORK', 'VETRI VENDHAN', '', '', '', '', '', '', 'not applicable', ' ', '   Update later  ', ' ', 'not applicable', '', '     ', ' ', 'NULL', 'NULL', 'CON-087', '140700TJ', 0, 1, '    NULL    ', '  ', '1', '', 'DAILY', '1 ', '2018-01-05 11:14:06', '', ''),
(90, 'SPK SALES AND SERVICES', '2018-10-26', '2019-12-30', 'NO 12/70 THAMBU LINE ROYAPURAM CHENNAI - 600013', ' ', '', 'AMC SERVICE VISIT FOR FIREPUMP DIESEL ENGINE', 'GUNASEKERAN', '', '', '', '', '', '', 'no', ' ', '     ', ' ', 'no', ' ', '     ', ' ', 'NULL', 'NULL', 'CON-089', '150909TJ', 0, 1, '    NULL    ', '   ', '1', '', 'MONTHLY', '1 ', '2018-01-09 13:43:40', '', ''),
(91, 'Toshiba Johnson Elevators and India Pvt Ltd', '2019-01-25', '2019-12-30', '602, 6th floor, C&B Square, Sangam Complex, 127 Andheri Kural Road Andheri (E) Mumbai - 400059', ' ', '', 'Battery Replacement', ' ', '', '', '', '', '', '', 'no', ' ', '       ', ' ', 'no', ' ', '       ', ' ', 'NULL', 'NULL', 'CON-090', '100044TJ', 0, 1, '      NULL      ', '      ', '5', '', 'MONTHLY', '1 ', '2018-01-17 11:51:11', '', ''),
(92, 'UNIQUE PUMP SOLUTIONS AND SERVICES', '2018-01-01', '2019-12-30', 'NO 3, VELLALAR STREET, 3RD MAIN ROAD AMBATTUR INDUSTRIAL ESTATE, CHENNAI - 600058', 'NO 3, VELLALAR STREET, 3RD MAIN ROAD AMBATTUR INDUSTRIAL ESTATE, CHENNAI - 600058', '', 'GROUNDFOS PUMPS SPARES REPLACEMENTS & SERVICES', 'ARUL RANGANATHAN', '', '', '', '', '', '', 'no', ' ', '     ', ' ', 'no', ' ', '     ', ' ', 'NULL', 'NULL', 'CON-091', '160998TJ', 0, 1, '    NULL    ', '    ', '4', '', 'MONTHLY', '1 ', '2018-01-23 10:51:43', '', ''),
(94, 'KOMATSU INDIA', '2018-01-01', '2018-09-30', 'PLOT NO A-1 SIPCOT INDUSTRIAL PARK, GROWTH CENTER, ORAGADAM - 6631604', ' ', '', 'INSTALLING OF 3D LASER CUTTING MACHINE PARTS', ' ', '', '', '', '', '', '', 'yes', 'BGBNG\0042194\000\0000090', '  ', ' ', 'yes', '2712/00/20627/000/00', '  ', ' ', 'NULL', 'NULL', 'CON-093', '110206TJ', 0, 1, ' NULL ', '', '4', '', 'MONTHLY', '1 ', '2018-01-30 08:41:11', '', ''),
(96, 'Pascal solutions', '2018-05-19', '2019-12-30', 'No 81, Second A cross Pipe line road JC Nagar Banglore', ' No 81, Second A cross Pipe line road JC Nagar Banglore', '', 'Lazer Calibration', ' Rajesh.v', '', '', '', '', '', '', 'not applicable', ' ', '      ', ' ', 'not applicable', ' ', '        ', ' ', 'NULL', 'NULL', 'CON-095', '140834TJ', 0, 1, '       NULL       ', '     ', '6', '', 'MONTHLY', '1 ', '2018-02-01 10:30:20', '', ''),
(97, 'karcher cleaning systems private limited', '2018-02-06', '2018-02-15', 'no 54,Alapakkam main road maduravayul', ' no 54,Alapakkam main road maduravayul', '', 'Service', 'Raja.D', '', '', '', '', '', '', 'yes', '1011031582881', '      ', ' ', 'no', ' ', '      ', ' ', 'NULL', 'NULL', 'CON-096', '110117TJ', 0, 1, '     NULL     ', '', ' 2', '', 'MONTHLY', '1 ', '2018-02-06 10:30:14', '', ''),
(99, 'Ametek Instrument India pvt ltd ', '2018-02-13', '2019-09-30', '  306,Delta wing,3rd Floor  Raheja Towers, 177,anna salai Chennai-600002\r\n\r\n', '306,Delta wing,3rd Floor  Raheja Towers, 177,anna salai Chennai-600002\r\n', '', 'Inspection', ' ', '', '', '', '', '', '', 'yes', 'PY/KRP/52043/064 ', '    ', ' ', 'no', ' ', '    ', ' ', 'NULL', 'NULL', 'CON-098', '110138TJ', 0, 1, '   NULL   ', '  ', ' 3', '', 'MONTHLY', '1 ', '2018-02-13 10:03:25', '', ''),
(100, 'Schenck Rotec India Limited', '2018-11-13', '2019-12-30', 'A5,Sector 81.Phase2,NOIDa-201035.UP', ' A5,Sector 81.Phase2,NOIDa-201035.UP', '', 'Machine Manufacturer', 'Mohammed Azarudeen', '', '', '', '', '', '', 'yes', ' 010634607261', '             ', ' ', 'not applicable', ' ', '      Not applicable       ', ' ', 'NULL', 'NULL', 'CON-099', '120286TJ', 0, 1, '            NULL            ', '     ', '10', '', 'MONTHLY', '1 ', '2018-02-14 11:14:59', '', ''),
(101, 'Konecranes pvt ltd', '2018-02-15', '2018-04-30', 'plot D16,Jejuri Taluka parandar pune -411303 Maharastra', 'plot D16,Jejuri Taluka parandar pune -411303 Maharastra', '', 'Crane operators', 'Angel raj', '', '', '', '', '', '', 'yes', 'PU/PUN/32330/214', '   ', ' ', 'no', ' ', '   ', ' ', 'NULL', 'NULL', 'CON-100', '100059TJ', 0, 1, '  NULL  ', '', '3', '', 'MONTHLY', '1 ', '2018-02-15 11:30:21', '', ''),
(102, 'Dynavac india pvt ltd', '2018-02-15', '2018-02-16', '302,ALG Farms ,Nambialagan Palayam Vedapatti post-Coimbatore 641007', ' ', '', 'Service visit', ' ', '', '', '', '', '', '', 'yes', '101125712270', '  ', ' ', 'no', ' ', '  ', ' ', 'NULL', 'NULL', 'CON-101', '161044TJ', 0, 1, ' NULL ', '', '1', '', 'MONTHLY', '1 ', '2018-02-15 13:34:21', '', ''),
(119, 'Micro engineering ', '2018-03-21', '2018-03-21', 'No 1', 'No 1', '', 'Freezer lifting', ' ', '', '', '', '', '', '', 'not applicable', ' ', '   ', ' ', 'not applicable', ' ', '   ', ' ', 'NULL', 'NULL', 'CON-118', '130401TJ', 0, 1, '  NULL  ', '  NULL', '3', '', 'MONTHLY', '53', '2018-03-21 14:42:03', '', ''),
(104, 'Consul Neowatt power solutions pvt ltd', '2018-02-20', '2019-12-31', 'N0 119 electrical and Electronics industrial estate perungudi\r\nch-600096', 'N0 119 electrical and Electronics industrial estate perungudi\r\nch-600096', '', 'BM-51 Repair & Maintenance', 'Kamal sekar', '', '', '', '', '', '', 'yes', 'TNMAS0022923000', '      ', ' ', 'no', ' ', 'EC POLICY AVAILABLE  ', ' ', 'NULL', 'NULL', 'CON-103', '120307TJ', 0, 1, '     NULL     ', '    ', '2', '', 'MONTHLY', '53', '2018-02-20 17:06:50', '', ''),
(108, 'M/S Machine tools India pvt ltd', '2019-02-04', '2019-09-30', '240 Mount road ch-600006', '240 Mount road ch-600006', '', 'CMM Machine service', 'Thangavelu', '', '', '', '', '', '', 'not applicable', ' ', '          ', ' ', 'yes', ' 53410508690010999', '          ', ' ', 'NULL', 'NULL', 'CON-107', '130367TJ', 0, 1, '         NULL         ', '       ', '10', '', 'MONTHLY', '53', '2018-02-27 09:57:17', '', ''),
(110, 'Microlab', '2019-02-05', '2020-03-31', 'SP 101,2 Main Road Ambattur Industrial Estate ch-600028', 'SP 101,2 Main Road Ambattur Industrial Estate ch-600028', '', 'Material testing', 'Balasubramanian', '', '', '', '', '', '', 'yes', 'TN/AMB/66736', '         ', ' ', 'yes', ' 51000870930000506', '       ', ' ', 'NULL', 'NULL', 'CON-109', '161064TJ', 0, 1, '        NULL        ', '      ', '10', '', 'MONTHLY', '53', '2018-03-06 15:15:12', '', ''),
(120, 'Tikona Infinite pvt ltd', '2018-03-26', '2018-09-30', 'Update later', 'Update later', '', 'Tower painting', 'Sudhakar', '', '', '', '', '', '', 'not applicable', ' ', '  ', ' ', 'not applicable', ' ', '  ', ' ', 'NULL', 'NULL', 'CON-119', '120289TJ', 0, 1, ' NULL ', ' NULL', '5', '', 'MONTHLY', '53', '2018-03-26 14:36:54', '', ''),
(56, 'MAXINA DECORS', '2018-01-01', '2018-09-30', '21,GROUND FLOOR , SECOND MAIN ROAD, 2 ND CROSS LANE,\r\nVENKATESHAWARA NAGAR, VELACHERRY-CHENNAI-600042.', '21,GROUND FLOOR , SECOND MAIN ROAD, 2 ND CROSS LANE,\r\nVENKATESHAWARA NAGAR, VELACHERRY-CHENNAI-600042.', '', 'CHILLER WORK', 'SIMPSON', '', '', '', '', '', '', 'yes', 'TBTAM1631704000', '    ', ' ', 'yes', '51001211000000606', '    ', ' ', 'NULL', 'NULL', 'CON-056', '110097TJ', 0, 1, '   NULL   ', '', '12', '', 'MONTHLY', '1 ', '2017-11-29 11:11:12', '', ''),
(61, 'SGS INDIA PVT LTD', '2019-02-06', '2020-03-31', 'NO 28 B/1 & 28 B/2, SECOND MAIN ROAD,\r\nAMBATTUR,INDUSTRIAL ESTATE, CHENNAI-6000058', 'NO 28 B/1 & 28 B/2, SECOND MAIN ROAD,\r\nAMBATTUR,INDUSTRIAL ESTATE, CHENNAI-6000058', '', 'POLLUTION CHEK', 'PREMCHAND T', '', '', '', '', '', '', 'yes', 'THTHA0039402000', '        ', ' ', 'yes', '51310181400010699', '        ', ' ', 'NULL', 'NULL', 'CON-061', '120305TJ', 0, 1, '       NULL       ', '       ', '7', '', 'MONTHLY', '1 ', '2017-12-05 11:18:07', '', ''),
(72, 'Vertiv', '2018-11-26', '2019-12-30', '6th floor platinum building\r\nEkatuthangal\r\nChennai-32', ' 6th floor platinum building\r\nEkatuthangal\r\nChennai-32', '', 'blade centre', ' ', '', '', '', '', '', '', 'yes', '101116971771', '                    ', ' ', 'yes', '5123970013', '                    ', ' ', 'NULL', 'NULL', 'CON-072', '160998TJ', 0, 1, '                   NULL                   ', '       ', ' 12', '', 'MONTHLY', '1 ', '2017-12-14 11:46:19', '', ''),
(89, 'BASE AUTOMATION TECH. PVT LTD.', '2018-11-26', '2019-01-30', '76, 2ND MAIN ROAD, NEHRU NAGAR, RAJIV GANDHI SALAI(OMR), KOTTIVAKKAM, CHENNAI - 600096', ' 76, 2ND MAIN ROAD, NEHRU NAGAR, RAJIV GANDHI SALAI(OMR), KOTTIVAKKAM, CHENNAI - 600096', '', 'CABLE TERMINATION', 'Jeyalakshmi K', '', '', '', '', '', '', 'yes', ' TN/MAS/0048901/000', '   Not Produced    ', ' ', 'yes', ' 51000599000000699', '       ', ' ', 'NULL', 'NULL', 'CON-088', '120307TJ', 0, 1, '      NULL      ', '   ', '10', '', 'MONTHLY', '1 ', '2018-01-08 10:19:48', '', ''),
(93, 'ALPHAPRIME LOGISTICS & ENGINEERING ', '2018-01-01', '2019-12-30', 'NO 56/22FIRST FLOOR, MADURAI VEERAN STREET, KALAIVANAR NAGAR, PADI, CHENNAI 600050.', ' NO 56/22FIRST FLOOR, MADURAI VEERAN STREET, KALAIVANAR NAGAR, PADI, CHENNAI 600050.', '', 'AMC FOR PTA MACHINE', 'BIJO THARAKAN', '', '', '', '', '', '', 'no', ' ', '         Update later   ', ' ', 'no', '      Update later', '            ', ' ', 'NULL', 'NULL', 'CON-092', '120326TJ', 0, 1, '           NULL           ', '     ', '15', '', 'MONTHLY', '1 ', '2018-01-24 12:01:31', '', ''),
(95, 'OPTION ENGINEERING PVT LTD', '2018-01-01', '2018-09-30', 'NO 908 KP AURUM BUILDING MAROL MAROSHI ROAD, ANDHERI EAST, MUMBAI 400059', ' NO 908 KP AURUM BUILDING MAROL MAROSHI ROAD, ANDHERI EAST, MUMBAI 400059', '', 'LPG WORK', 'JAYANT BHATAJARJEE', '', '', '', '', '', '', 'yes', ' MH/92725', '         ', ' ', 'yes', ' 35/05540/101 ', '         ', ' ', 'NULL', 'NULL', 'CON-094', '100067TJ', 0, 1, '        NULL        ', '', '5', '', 'MONTHLY', '1 ', '2018-01-30 13:12:30', '', ''),
(98, 'Hitek Automation', '2018-05-29', '2018-09-30', 'F3/11 First floor ,flat no 49 Srinivasan nagar second main road,Kolathur', 'F3/11 First floor ,flat no 49 Srinivasan nagar second main road,Kolathur', '', 'Trouble shooting ', ' ', '', '', '', '', '', '', 'yes', '100614296541', '   ', ' ', 'yes', '7129003617010000232', '   ', ' ', 'NULL', 'NULL', 'CON-097', '120307TJ', 0, 1, '  NULL  ', '', '3', '', 'MONTHLY', '1 ', '2018-02-12 11:05:57', '', ''),
(103, 'Mayuras Industrial services', '2018-02-17', '2018-02-18', 'No 25 Crecent Road West shenoy Nagar ch-600030', 'No 25 Crecent Road West shenoy Nagar ch-600030', '', 'PLC Programming', 'srikanth', '', '', '', '', '', '', 'no', '', ' GPA AVAILABLE', ' ', 'no', ' ', 'GPA AVAILABLE', ' ', 'NULL', 'NULL', 'CON-102', '160980TJ', 0, 1, ' NULL ', '  ', '1', '', 'MONTHLY', '53', '2018-02-17 09:33:49', '', ''),
(112, 'Teja Machinery pvt ltd', '2018-03-09', '2018-09-30', 'No 1227,1st floor 18th main road Anna Nagar West chennai-6000040', 'No 1227,1st floor 18th main road Anna Nagar West chennai-6000040', '', 'Reconditioning ,Geometry prove out services', 'Gunaraja.G', '', '', '', '', '', '', 'yes', 'TNAMB006659', '    ', ' ', 'yes', '51000860/0000/001', '    ', ' ', 'NULL', 'NULL', 'CON-111', '120252TJ', 0, 1, '   NULL   ', '', '13', '', 'MONTHLY', '53', '2018-03-09 08:17:28', '', ''),
(113, 'Buildcraft India pvt ltd', '2018-03-09', '2018-09-30', ' 8th Floor KRM centre N0 2 Harrinhton Road Cheatpet ch-600031', ' 8th Floor KRM centre N0 2 Harrinhton Road Cheatpet ch-600031', '', 'Furniture', 'Thomson', '', '', '', '', '', '', 'yes', 'TN/MS/52376', '   ', ' ', 'yes', '51000863210001001', '   ', ' ', 'NULL', 'NULL', 'CON-112', '110101TJ', 0, 1, '  NULL  ', '  NULL', '7', '', 'MONTHLY', '53', '2018-03-09 16:35:46', '', ''),
(114, 'Mcvan industrial corporation', '2018-03-15', '2019-09-30', '20/48 Post office street parrys ch-600001', '20/48 Post office street parrys ch-600001', '', 'Calibration', 'Rajkumar', '', '', '', '', '', '', 'no', ' ', 'Update later ', ' ', 'no', ' ', 'Update later ', ' ', 'NULL', 'NULL', 'CON-113', '130351TJ', 0, 1, ' NULL ', ' NULL', '2', '', 'MONTHLY', '53', '2018-03-15 10:50:32', '', ''),
(115, 'Yokogawa india limited', '2018-11-09', '2019-01-30', '115,Mahatma gandhi salai 2nd floor ,Kothari building ch-600034', '115,Mahatma gandhi salai 2nd floor ,Kothari building ch-600034', '', 'GTB flow meter general service', 'kishore kumar.R', '', '', '', '', '', '', 'yes', 'PYBOMOO13151000', '     ', ' ', 'not applicable', ' ', '     ', ' ', 'NULL', 'NULL', 'CON-114', '160980TJ', 0, 1, '    NULL    ', '   ', '3', '', 'MONTHLY', '53', '2018-03-16 10:42:23', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_permit`
--

DROP TABLE IF EXISTS `dbo.contractor_permit`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_permit` (
  `permit_id` smallint(6) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `permit_number` varchar(10) DEFAULT NULL,
  `permit_upload` varchar(42) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `is_deviation` tinyint(4) DEFAULT NULL,
  `remarks` varchar(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_permit`
--

INSERT INTO `dbo.contractor_permit` (`permit_id`, `contractor_code`, `permit_number`, `permit_upload`, `from_date`, `to_date`, `is_deviation`, `remarks`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CON-001', 'CONPER-001', '/TOSHIBA/images/Contractor/Permit/CON-001-', '2019-01-07', '2019-06-30', 1, '    NULL    ', 0, '1         ', '2017-11-22 10:53:49', '', '2017-11-22 10:53:49'),
(2, 'CON-002', 'CONPER-002', '/TOSHIBA/images/Contractor/Permit/CON-002-', '2019-01-08', '2019-06-30', 1, '    NULL    ', 0, '1         ', '2017-11-22 11:37:52', '', '2017-11-22 11:37:52'),
(3, 'CON-003', 'CONPER-003', '/TOSHIBA/images/Contractor/Permit/CON-003-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 11:52:58', '', '2017-11-22 11:52:58'),
(4, 'CON-004', 'CONPER-004', '/TOSHIBA/images/Contractor/Permit/CON-004-', '2019-01-08', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 12:15:43', '', '2017-11-22 12:15:43'),
(5, 'CON-005', 'CONPER-005', '/TOSHIBA/images/Contractor/Permit/CON-005-', '2019-01-28', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 12:24:45', '', '2017-11-22 12:24:45'),
(6, 'CON-006', 'CONPER-006', '/TOSHIBA/images/Contractor/Permit/CON-006-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 12:32:04', '', '2017-11-22 12:32:04'),
(7, 'CON-007', 'CONPER-007', '/TOSHIBA/images/Contractor/Permit/CON-007-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 13:43:02', '', '2017-11-22 13:43:02'),
(8, 'CON-008', 'CONPER-008', '/TOSHIBA/images/Contractor/Permit/CON-008-', '2019-01-07', '2019-06-30', 1, '  NULL  ', 0, '1         ', '2017-11-22 14:24:20', '', '2017-11-22 14:24:20'),
(9, 'CON-009', 'CONPER-009', '/TOSHIBA/images/Contractor/Permit/CON-009-', '2019-01-07', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 14:49:40', '', '2017-11-22 14:49:40'),
(54, 'CON-053', 'CONPER-052', '/TOSHIBA/images/Contractor/Permit/CON-053-', '2019-01-22', '2019-06-30', 1, '    NULL    ', 0, '1         ', '2017-11-28 12:46:17', '', '2017-11-28 12:46:17'),
(61, 'CON-064', 'CONPER-059', '/TOSHIBA/images/Contractor/Permit/CON-064-', '2018-12-18', '2019-01-30', 1, '  NULL  ', 0, '1         ', '2017-12-07 09:43:47', '', '2017-12-07 09:43:47'),
(62, 'CON-067', 'CONPER-060', '/TOSHIBA/images/Contractor/Permit/CON-067-', '2018-10-25', '2020-03-31', 1, '     NULL     ', 0, '1         ', '2017-12-07 15:01:21', '', '2017-12-07 15:01:21'),
(63, 'CON-068', 'CONPER-061', '/TOSHIBA/images/Contractor/Permit/CON-068-', '2019-01-30', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-12-08 09:47:20', '', '2017-12-08 09:47:20'),
(65, 'CON-070', 'CONPER-063', '/TOSHIBA/images/Contractor/Permit/CON-070-', '2018-11-27', '2019-03-31', 1, '   NULL   ', 0, '1         ', '2017-12-12 10:35:36', '', '2017-12-12 10:35:36'),
(68, 'CON-074', 'CONPER-065', '/TOSHIBA/images/Contractor/Permit/CON-074-', '2019-01-09', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-12-15 11:45:57', '', '2017-12-15 11:45:57'),
(69, 'CON-075', 'CONPER-066', '/TOSHIBA/images/Contractor/Permit/CON-075-', '2018-01-01', '2018-09-30', 1, '  NULL  ', 1, '1         ', '2017-12-15 14:45:57', '', '2017-12-15 14:45:57'),
(75, 'CON-059', 'CONPER-072', '/TOSHIBA/images/Contractor/Permit/CON-059-', '2018-12-05', '2019-01-30', 1, '    NULL    ', 0, '1         ', '2018-01-31 11:08:48', '', '2018-01-31 11:08:48'),
(76, 'CON-059', 'CONPER-073', 'Array', '2018-01-01', '2018-09-30', 1, 'NULL', 0, '1         ', '2018-01-31 11:17:53', '', '2018-01-31 11:17:53'),
(77, 'CON-078', 'CONPER-074', '/TOSHIBA/images/Contractor/Permit/CON-078-', '2018-10-15', '2019-01-30', 1, ' NULL ', 0, '1         ', '2018-01-31 12:05:30', '', '2018-01-31 12:05:30'),
(78, 'CON-062', 'CONPER-075', '/TOSHIBA/images/Contractor/Permit/CON-062-', '2018-10-10', '2019-01-30', 1, ' NULL ', 0, '1         ', '2018-01-31 15:39:15', '', '2018-01-31 15:39:15'),
(79, 'CON-065', 'CONPER-076', '/TOSHIBA/images/Contractor/Permit/CON-065-', '2018-10-22', '2019-01-30', 1, ' NULL ', 0, '1         ', '2018-01-31 15:43:37', '', '2018-01-31 15:43:37'),
(80, 'CON-066', 'CONPER-077', '/TOSHIBA/images/Contractor/Permit/CON-066-', '2018-10-03', '2019-01-30', 1, ' NULL ', 0, '1         ', '2018-01-31 15:44:39', '', '2018-01-31 15:44:39'),
(81, 'CON-092', 'CONPER-078', '/TOSHIBA/images/Contractor/Permit/CON-092-', '2018-01-01', '2019-09-30', 1, '  NULL  ', 0, '1         ', '2018-01-31 16:07:29', '', '2018-01-31 16:07:29'),
(88, 'CON-080', 'CONPER-083', 'Array', '2018-01-01', '2018-09-30', 1, 'NULL', 0, '1         ', '2018-01-31 16:17:13', '', '2018-01-31 16:17:13'),
(89, 'CON-081', 'CONPER-084', '/TOSHIBA/images/Contractor/Permit/CON-081-', '2018-06-01', '2019-06-30', 1, '  NULL  ', 0, '1         ', '2018-01-31 16:18:06', '', '2018-01-31 16:18:06'),
(91, 'CON-084', 'CONPER-086', '/TOSHIBA/images/Contractor/Permit/CON-084-', '2018-10-24', '2019-01-30', 1, ' NULL ', 0, '1         ', '2018-01-31 16:20:59', '', '2018-01-31 16:20:59'),
(93, 'CON-086', 'CONPER-088', 'Array', '2018-01-01', '2018-09-30', 1, 'NULL', 0, '1         ', '2018-01-31 16:24:11', '', '2018-01-31 16:24:11'),
(95, 'CON-088', 'CONPER-090', '/TOSHIBA/images/Contractor/Permit/CON-088-', '2018-11-26', '2019-01-30', 1, ' NULL ', 0, '1         ', '2018-01-31 16:26:17', '', '2018-01-31 16:26:17'),
(96, 'CON-089', 'CONPER-091', '/TOSHIBA/images/Contractor/Permit/CON-089-', '2018-10-26', '2019-01-30', 1, ' NULL ', 0, '1         ', '2018-01-31 16:27:14', '', '2018-01-31 16:27:14'),
(98, 'CON-091', 'CONPER-093', 'Array', '2018-01-01', '2018-09-30', 1, 'NULL', 0, '1         ', '2018-01-31 16:28:50', '', '2018-01-31 16:28:50'),
(99, 'CON-093', 'CONPER-094', 'Array', '2018-01-01', '2018-09-30', 1, 'NULL', 0, '1         ', '2018-01-31 16:30:11', '', '2018-01-31 16:30:11'),
(101, 'CON-083', 'CONPER-096', 'Array', '2018-01-01', '2018-09-30', 1, 'NULL', 0, '1         ', '2018-01-31 16:32:02', '', '2018-01-31 16:32:02'),
(103, 'CON-096', 'CONPER-098', 'Array', '2018-02-06', '2018-02-15', 1, 'NULL', 0, '1         ', '2018-02-06 10:30:53', '', '2018-02-06 10:30:53'),
(104, 'CON-097', 'CONPER-099', '/TOSHIBA/images/Contractor/Permit/CON-097-', '2018-05-29', '2018-09-30', 1, ' NULL ', 0, '1         ', '2018-02-12 11:08:09', '', '2018-02-12 11:08:09'),
(105, 'CON-098', 'CONPER-100', '/TOSHIBA/images/Contractor/Permit/CON-098-', '2018-02-13', '2019-09-30', 1, ' NULL ', 0, '1         ', '2018-02-13 10:04:33', '', '2018-02-13 10:04:33'),
(108, 'CON-101', 'CONPER-103', 'Array', '2018-02-15', '2018-02-16', 1, 'NULL', 0, '1         ', '2018-02-15 13:35:10', '', '2018-02-15 13:35:10'),
(109, 'CON-102', 'CONPER-104', 'Array', '2018-02-17', '2018-02-18', 1, 'NULL', 0, '53        ', '2018-02-17 09:34:42', '', '2018-02-17 09:34:42'),
(111, 'CON-104', 'CONPER-106', '/TOSHIBA/images/Contractor/Permit/CON-104-', '2018-12-07', '2019-01-30', 1, '  NULL  ', 0, '53        ', '2018-02-21 11:31:01', '', '2018-02-21 11:31:01'),
(112, 'CON-105', 'CONPER-107', 'Array', '2018-02-23', '2018-09-30', 1, 'NULL', 0, '53        ', '2018-02-23 12:12:48', '', '2018-02-23 12:12:48'),
(113, 'CON-106', 'CONPER-108', '/TOSHIBA/images/Contractor/Permit/CON-106-', '2018-11-21', '2019-01-30', 1, ' NULL ', 0, '53        ', '2018-02-26 11:30:29', '', '2018-02-26 11:30:29'),
(115, 'CON-108', 'CONPER-110', '/TOSHIBA/images/Contractor/Permit/CON-108-', '2018-10-03', '2019-12-31', 1, '  NULL  ', 0, '53        ', '2018-03-05 10:23:04', '', '2018-03-05 10:23:04'),
(116, 'CON-109', 'CONPER-111', '/TOSHIBA/images/Contractor/Permit/CON-109-', '2019-02-05', '2019-06-30', 1, '  NULL  ', 0, '53        ', '2018-03-06 15:16:48', '', '2018-03-06 15:16:48'),
(118, 'CON-112', 'CONPER-113', 'Array', '2018-03-09', '2018-09-30', 1, 'NULL', 0, '53        ', '2018-03-09 16:36:30', '', '2018-03-09 16:36:30'),
(119, 'CON-113', 'CONPER-114', '/TOSHIBA/images/Contractor/Permit/CON-113-', '2018-03-15', '2019-06-30', 1, ' NULL ', 0, '53        ', '2018-03-15 10:51:20', '', '2018-03-15 10:51:20'),
(122, 'CON-116', 'CONPER-117', 'Array', '2018-03-21', '2018-09-30', 1, 'NULL', 0, '53        ', '2018-03-21 08:37:54', '', '2018-03-21 08:37:54'),
(124, 'CON-118', 'CONPER-119', 'Array', '2018-03-21', '2018-03-21', 1, 'NULL', 0, '53        ', '2018-03-21 14:42:23', '', '2018-03-21 14:42:23'),
(125, 'CON-119', 'CONPER-120', 'Array', '2018-03-26', '2018-09-30', 1, 'NULL', 0, '53        ', '2018-03-26 14:38:27', '', '2018-03-26 14:38:27'),
(126, 'CON-120', 'CONPER-121', 'Array', '2018-04-04', '2018-04-10', 1, 'NULL', 0, '53        ', '2018-04-04 10:41:03', '', '2018-04-04 10:41:03'),
(127, 'CON-121', 'CONPER-122', 'Array', '2018-04-09', '2018-09-30', 1, 'NULL', 0, '53        ', '2018-04-09 14:37:46', '', '2018-04-09 14:37:46'),
(128, 'CON-122', 'CONPER-123', '/TOSHIBA/images/Contractor/Permit/CON-122-', '2018-10-09', '2019-06-30', 1, '  NULL  ', 0, '53        ', '2018-04-10 10:56:50', '', '2018-04-10 10:56:50'),
(130, 'CON-124', 'CONPER-125', 'Array', '2018-04-20', '2018-09-30', 1, 'NULL', 0, '53        ', '2018-04-20 09:11:47', '', '2018-04-20 09:11:47'),
(133, 'CON-127', 'CONPER-128', 'Array', '2018-04-27', '2018-09-30', 1, 'NULL', 0, '53        ', '2018-04-27 16:24:58', '', '2018-04-27 16:24:58'),
(134, 'CON-128', 'CONPER-129', 'Array', '2018-04-27', '2018-09-30', 1, 'NULL', 0, '53        ', '2018-04-27 17:21:32', '', '2018-04-27 17:21:32'),
(10, 'CON-010', 'CONPER-010', '/TOSHIBA/images/Contractor/Permit/CON-010-', '2019-01-18', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 15:27:47', '', '2017-11-22 15:27:47'),
(11, 'CON-011', 'CONPER-011', '/TOSHIBA/images/Contractor/Permit/CON-011-', '2019-02-01', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 15:34:34', '', '2017-11-22 15:34:34'),
(12, 'CON-012', 'CONPER-012', '/TOSHIBA/images/Contractor/Permit/CON-012-', '2019-01-09', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 15:37:53', '', '2017-11-22 15:37:53'),
(13, 'CON-013', 'CONPER-013', '/TOSHIBA/images/Contractor/Permit/CON-013-', '2019-01-18', '2019-06-30', 1, '    NULL    ', 0, '1         ', '2017-11-22 15:40:43', '', '2017-11-22 15:40:43'),
(14, 'CON-014', 'CONPER-014', '/TOSHIBA/images/Contractor/Permit/CON-014-', '2019-01-29', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 15:43:47', '', '2017-11-22 15:43:47'),
(15, 'CON-015', 'CONPER-015', '/TOSHIBA/images/Contractor/Permit/CON-015-', '2018-09-20', '2019-01-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 15:45:50', '', '2017-11-22 15:45:50'),
(16, 'CON-016', 'CONPER-016', '/TOSHIBA/images/Contractor/Permit/CON-016-', '2019-01-08', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 15:48:50', '', '2017-11-22 15:48:50'),
(17, 'CON-017', 'CONPER-017', '/TOSHIBA/images/Contractor/Permit/CON-017-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 15:50:42', '', '2017-11-22 15:50:42'),
(18, 'CON-018', 'CONPER-018', '/TOSHIBA/images/Contractor/Permit/CON-018-', '2019-01-09', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 15:53:55', '', '2017-11-22 15:53:55'),
(19, 'CON-019', 'CONPER-019', '/TOSHIBA/images/Contractor/Permit/CON-019-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 15:55:41', '', '2017-11-22 15:55:41'),
(20, 'CON-020', 'CONPER-020', '/TOSHIBA/images/Contractor/Permit/CON-020-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 15:57:13', '', '2017-11-22 15:57:13'),
(21, 'CON-021', 'CONPER-021', '/TOSHIBA/images/Contractor/Permit/CON-021-', '2019-01-18', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 15:58:56', '', '2017-11-22 15:58:56'),
(22, 'CON-022', 'CONPER-022', '/TOSHIBA/images/Contractor/Permit/CON-022-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 16:00:44', '', '2017-11-22 16:00:44'),
(23, 'CON-023', 'CONPER-023', '/TOSHIBA/images/Contractor/Permit/CON-023-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 16:02:17', '', '2017-11-22 16:02:17'),
(24, 'CON-024', 'CONPER-024', '/TOSHIBA/images/Contractor/Permit/CON-024-', '2018-10-25', '2019-01-30', 1, '  NULL  ', 0, '1         ', '2017-11-22 16:04:30', '', '2017-11-22 16:04:30'),
(25, 'CON-025', 'CONPER-025', '/TOSHIBA/images/Contractor/Permit/CON-025-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 16:14:50', '', '2017-11-22 16:14:50'),
(26, 'CON-026', 'CONPER-026', '/TOSHIBA/images/Contractor/Permit/CON-026-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 16:19:34', '', '2017-11-22 16:19:34'),
(27, 'CON-027', 'CONPER-027', '/TOSHIBA/images/Contractor/Permit/CON-027-', '2019-01-07', '2019-06-30', 1, '     NULL     ', 0, '1         ', '2017-11-22 16:21:16', '', '2017-11-22 16:21:16'),
(28, 'CON-028', 'CONPER-028', '/TOSHIBA/images/Contractor/Permit/CON-028-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 16:23:36', '', '2017-11-22 16:23:36'),
(29, 'CON-029', 'CONPER-029', '/TOSHIBA/images/Contractor/Permit/CON-029-', '2019-02-04', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 16:25:27', '', '2017-11-22 16:25:27'),
(30, 'CON-030', 'CONPER-030', '/TOSHIBA/images/Contractor/Permit/CON-030-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 16:31:13', '', '2017-11-22 16:31:13'),
(31, 'CON-031', 'CONPER-031', '/TOSHIBA/images/Contractor/Permit/CON-031-', '2018-10-05', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 16:34:06', '', '2017-11-22 16:34:06'),
(32, 'CON-032', 'CONPER-032', '/TOSHIBA/images/Contractor/Permit/CON-032-', '2019-01-08', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 16:37:33', '', '2017-11-22 16:37:33'),
(33, 'CON-033', 'CONPER-033', '/TOSHIBA/images/Contractor/Permit/CON-033-', '2018-10-05', '2019-01-30', 1, '  NULL  ', 0, '1         ', '2017-11-22 16:39:18', '', '2017-11-22 16:39:18'),
(34, 'CON-034', 'CONPER-034', '/TOSHIBA/images/Contractor/Permit/CON-034-', '2018-10-03', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-22 16:42:52', '', '2017-11-22 16:42:52'),
(35, 'CON-035', 'CONPER-035', '/TOSHIBA/images/Contractor/Permit/CON-035-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 16:44:28', '', '2017-11-22 16:44:28'),
(36, 'CON-036', 'CONPER-036', '/TOSHIBA/images/Contractor/Permit/CON-036-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-22 16:46:16', '', '2017-11-22 16:46:16'),
(37, 'CON-037', 'CONPER-037', '/TOSHIBA/images/Contractor/Permit/CON-037-', '2018-11-01', '2019-01-30', 1, '   NULL   ', 0, '1         ', '2017-11-23 08:19:31', '', '2017-11-23 08:19:31'),
(38, 'CON-038', 'CONPER-038', '/TOSHIBA/images/Contractor/Permit/CON-038-', '2018-10-24', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-23 08:22:31', '', '2017-11-23 08:22:31'),
(39, 'CON-039', 'CONPER-039', '/TOSHIBA/images/Contractor/Permit/CON-039-', '2019-01-08', '2019-06-30', 1, '    NULL    ', 0, '1         ', '2017-11-23 08:24:46', '', '2017-11-23 08:24:46'),
(40, 'CON-040', 'CONPER-040', '/TOSHIBA/images/Contractor/Permit/CON-040-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-23 08:27:06', '', '2017-11-23 08:27:06'),
(41, 'CON-041', 'CONPER-041', '/TOSHIBA/images/Contractor/Permit/CON-041-', '2018-01-01', '2019-06-30', 1, '  NULL  ', 0, '1         ', '2017-11-23 08:30:18', '', '2017-11-23 08:30:18'),
(42, 'CON-042', 'CONPER-042', '/TOSHIBA/images/Contractor/Permit/CON-042-', '2018-10-05', '2019-01-30', 1, '  NULL  ', 0, '1         ', '2017-11-23 08:33:15', '', '2017-11-23 08:33:15'),
(43, 'CON-043', 'CONPER-043', '/TOSHIBA/images/Contractor/Permit/CON-043-', '2018-10-03', '2019-09-30', 1, '   NULL   ', 0, '1         ', '2017-11-23 08:35:59', '', '2017-11-23 08:35:59'),
(44, 'CON-044', 'CONPER-044', '/TOSHIBA/images/Contractor/Permit/CON-044-', '2018-10-24', '2019-01-30', 1, '   NULL   ', 0, '1         ', '2017-11-23 08:38:33', '', '2017-11-23 08:38:33'),
(45, 'CON-045', 'CONPER-045', '/TOSHIBA/images/Contractor/Permit/CON-045-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-23 08:58:10', '', '2017-11-23 08:58:10'),
(46, 'CON-046', 'CONPER-046', '/TOSHIBA/images/Contractor/Permit/CON-046-', '2019-01-08', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-23 09:58:12', '', '2017-11-23 09:58:12'),
(47, 'CON-047', 'CONPER-047', '/TOSHIBA/images/Contractor/Permit/CON-047-', '2018-10-05', '2019-01-30', 1, '  NULL  ', 0, '1         ', '2017-11-23 10:21:16', '', '2017-11-23 10:21:16'),
(48, 'CON-048', 'CONPER-048', '/TOSHIBA/images/Contractor/Permit/CON-048-', '2019-02-04', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-23 10:23:38', '', '2017-11-23 10:23:38'),
(49, 'CON-048', 'CONPER-048', '/TOSHIBA/images/Contractor/Permit/CON-048-', '2018-01-30', '2019-01-30', 1, '   NULL   ', 1, '1         ', '2017-11-23 10:42:27', '', '2017-11-23 10:42:27'),
(50, 'CON-048', 'CONPER-048', '/TOSHIBA/images/Contractor/Permit/CON-048-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-23 10:43:10', '', '2017-11-23 10:43:10'),
(51, 'CON-049', 'CONPER-049', '/TOSHIBA/images/Contractor/Permit/CON-049-', '2019-01-18', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-11-23 11:00:13', '', '2017-11-23 11:00:13'),
(52, 'CON-050', 'CONPER-050', '/TOSHIBA/images/Contractor/Permit/CON-050-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-23 14:56:33', '', '2017-11-23 14:56:33'),
(53, 'CON-051', 'CONPER-051', '/TOSHIBA/images/Contractor/Permit/CON-051-', '2019-01-07', '2019-06-30', 1, '     NULL     ', 0, '1         ', '2017-11-23 16:05:55', '', '2017-11-23 16:05:55'),
(55, 'CON-054', 'CONPER-053', '/TOSHIBA/images/Contractor/Permit/CON-054-', '2018-09-27', '2019-01-30', 1, '  NULL  ', 0, '1         ', '2017-11-28 15:22:24', '', '2017-11-28 15:22:24'),
(57, 'CON-056', 'CONPER-055', '/TOSHIBA/images/Contractor/Permit/CON-056-', '2018-01-01', '2018-09-30', 1, ' NULL ', 0, '1         ', '2017-11-29 11:12:26', '', '2017-11-29 11:12:26'),
(59, 'CON-061', 'CONPER-057', '/TOSHIBA/images/Contractor/Permit/CON-061-', '2019-02-06', '2019-06-30', 1, '   NULL   ', 0, '1         ', '2017-12-05 11:32:38', '', '2017-12-05 11:32:38');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_pf`
--

DROP TABLE IF EXISTS `dbo.contractor_pf`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_pf` (
  `pf_id` varchar(0) DEFAULT NULL,
  `contractor_id` varchar(0) DEFAULT NULL,
  `pf_number` varchar(0) DEFAULT NULL,
  `pf_upload` varchar(0) DEFAULT NULL,
  `from_date` varchar(0) DEFAULT NULL,
  `to_date` varchar(0) DEFAULT NULL,
  `max_workers` varchar(0) DEFAULT NULL,
  `active_workers` varchar(0) DEFAULT NULL,
  `is_deviation` varchar(0) DEFAULT NULL,
  `remarks` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_status`
--

DROP TABLE IF EXISTS `dbo.contractor_status`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_status` (
  `id` smallint(6) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `statusdate` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contractor_status`
--

INSERT INTO `dbo.contractor_status` (`id`, `contractor_code`, `status`, `statusdate`) VALUES
(1, 'CON-001', 0, '2017-11-22'),
(2, 'CON-002', 0, '2017-11-22'),
(3, 'CON-003', 0, '2017-11-22'),
(4, 'CON-004', 0, '2017-11-22'),
(5, 'CON-005', 0, '2017-11-22'),
(6, 'CON-006', 0, '2017-11-22'),
(7, 'CON-007', 0, '2017-11-22'),
(8, 'CON-008', 0, '2017-11-22'),
(9, 'CON-009', 0, '2017-11-22'),
(52, 'CON-052', 0, '2017-11-27'),
(53, 'CON-053', 0, '2017-11-28'),
(55, 'CON-055', 0, '2017-11-29'),
(58, 'CON-058', 0, '2017-11-30'),
(59, 'CON-059', 0, '2017-11-30'),
(62, 'CON-062', 0, '2017-12-06'),
(64, 'CON-064', 0, '2017-12-07'),
(65, 'CON-065', 0, '2017-12-07'),
(66, 'CON-066', 0, '2017-12-07'),
(68, 'CON-068', 0, '2017-12-08'),
(70, 'CON-070', 0, '2017-12-12'),
(73, 'CON-073', 0, '2017-12-15'),
(74, 'CON-074', 0, '2017-12-15'),
(76, 'CON-076', 0, '2017-12-15'),
(77, 'CON-077', 0, '2017-12-18'),
(80, 'CON-079', 0, '2017-12-22'),
(81, 'CON-080', 0, '2017-12-22'),
(84, 'CON-083', 0, '2017-12-27'),
(87, 'CON-086', 0, '2018-01-04'),
(88, 'CON-087', 0, '2018-01-05'),
(90, 'CON-089', 0, '2018-01-09'),
(91, 'CON-090', 0, '2018-01-17'),
(92, 'CON-091', 0, '2018-01-23'),
(94, 'CON-093', 0, '2018-01-30'),
(97, 'CON-096', 0, '2018-02-06'),
(99, 'CON-098', 0, '2018-02-13'),
(102, 'CON-101', 0, '2018-02-15'),
(105, 'CON-104', 0, '2018-02-21'),
(106, 'CON-105', 0, '2018-02-23'),
(107, 'CON-106', 0, '2018-02-26'),
(109, 'CON-108', 0, '2018-03-05'),
(110, 'CON-109', 0, '2018-03-06'),
(111, 'CON-110', 0, '2018-03-07'),
(113, 'CON-112', 0, '2018-03-09'),
(114, 'CON-113', 0, '2018-03-15'),
(115, 'CON-114', 0, '2018-03-16'),
(116, 'CON-115', 0, '2018-03-16'),
(117, 'CON-116', 0, '2018-03-21'),
(119, 'CON-118', 0, '2018-03-21'),
(120, 'CON-119', 0, '2018-03-26'),
(121, 'CON-120', 0, '2018-04-04'),
(122, 'CON-121', 0, '2018-04-06'),
(123, 'CON-122', 0, '2018-04-10'),
(125, 'CON-124', 0, '2018-04-20'),
(128, 'CON-127', 0, '2018-04-27'),
(129, 'CON-128', 0, '2018-04-27'),
(132, 'CON-131', 0, '2018-05-10'),
(134, 'CON-133', 0, '2018-05-12'),
(136, 'CON-135', 0, '2018-05-18'),
(139, 'CON-138', 0, '2018-05-23'),
(140, 'CON-139', 0, '2018-05-23'),
(141, 'CON-140', 0, '2018-05-29'),
(142, 'CON-141', 0, '2018-06-04'),
(143, 'CON-142', 0, '2018-06-05'),
(144, 'CON-143', 0, '2018-06-06'),
(146, 'CON-145', 0, '2018-06-07'),
(149, 'CON-148', 0, '2018-06-13'),
(152, 'CON-151', 0, '2018-06-15'),
(153, 'CON-152', 0, '2018-06-19'),
(154, 'CON-153', 0, '2018-06-19'),
(156, 'CON-155', 0, '2018-07-02'),
(157, 'CON-156', 0, '2018-07-05'),
(160, 'CON-159', 0, '2018-07-12'),
(163, 'CON-162', 0, '2018-07-17'),
(164, 'CON-163', 0, '2018-07-26'),
(167, 'CON-166', 0, '2018-08-14'),
(168, 'CON-167', 0, '2018-08-14'),
(1169, 'CON-169', 0, '2018-08-29'),
(1173, 'CON-173', 0, '2018-09-25'),
(1174, 'CON-174', 0, '2018-10-03'),
(1175, 'CON-175', 0, '2018-10-08'),
(1176, 'CON-176', 0, '2018-10-09'),
(1177, 'CON-177', 0, '2018-10-17'),
(1178, 'CON-178', 0, '2018-10-20'),
(1179, 'CON-179', 0, '2018-10-29'),
(1180, 'CON-180', 0, '2018-11-19'),
(1181, 'CON-181', 0, '2018-11-20'),
(1184, 'CON-184', 0, '2019-01-02'),
(1185, 'CON-185', 0, '2019-01-24'),
(1186, 'CON-186', 0, '2019-02-08'),
(2186, 'CON-187', 0, '2019-03-27'),
(2187, 'CON-188', 0, '2019-04-01'),
(2188, 'CON-189', 0, '2019-04-10'),
(2190, 'CON-191', 0, '2019-04-25'),
(2192, 'CON-193', 0, '2019-05-17'),
(2194, 'CON-195', 0, '2019-06-06'),
(2195, 'CON-196', 0, '2019-06-07'),
(2196, 'CON-197', 0, '2019-07-08'),
(2198, 'CON-199', 0, '2019-07-29'),
(2199, 'CON-200', 0, '2019-07-31'),
(2201, 'CON-202', 0, '2019-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contractor_toshiba_incharge`
--

DROP TABLE IF EXISTS `dbo.contractor_toshiba_incharge`;
CREATE TABLE IF NOT EXISTS `dbo.contractor_toshiba_incharge` (
  `toshiba_emp_id` varchar(0) DEFAULT NULL,
  `toshiba_emp_code` varchar(0) DEFAULT NULL,
  `toshiba_emp_name` varchar(0) DEFAULT NULL,
  `toshiba_emp_department` varchar(0) DEFAULT NULL,
  `contractor_id` varchar(0) DEFAULT NULL,
  `from_date` varchar(0) DEFAULT NULL,
  `to_date` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contract_employee_work_permit`
--

DROP TABLE IF EXISTS `dbo.contract_employee_work_permit`;
CREATE TABLE IF NOT EXISTS `dbo.contract_employee_work_permit` (
  `permit_id` mediumint(9) DEFAULT NULL,
  `contract_license_id` varchar(0) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `permit_code` varchar(8) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `is_deviation` varchar(0) DEFAULT NULL,
  `remarks` varchar(0) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contract_employee_work_permit`
--

INSERT INTO `dbo.contract_employee_work_permit` (`permit_id`, `contract_license_id`, `emp_code`, `contractor_code`, `from_date`, `to_date`, `permit_code`, `status`, `is_deviation`, `remarks`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '', 'EMP-001', 'CON-045', '2018-02-01', '2019-09-30', 'PER-001', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(2, '', 'EMP-002', 'CON-009', '2019-01-31', '2020-03-31', 'PER-002', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(3, '', 'EMP-003', 'CON-009', '2018-09-21', '2020-03-31', 'PER-003', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(4, '', 'EMP-004', 'CON-009', '2019-01-07', '2020-03-31', 'PER-004', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(5, '', 'EMP-005', 'CON-009', '2018-09-21', '2020-03-31', 'PER-005', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(6, '', 'EMP-006', 'CON-009', '2018-09-21', '2020-03-31', 'PER-006', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(7, '', 'EMP-007', 'CON-009', '2019-01-07', '2020-03-31', 'PER-007', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(8, '', 'EMP-008', 'CON-009', '2017-12-01', '2019-09-30', 'PER-008', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(9, '', 'EMP-009', 'CON-009', '2019-01-07', '2020-03-31', 'PER-009', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(10, '', 'EMP-010', 'CON-009', '2019-02-04', '2020-03-31', 'PER-010', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(11, '', 'EMP-011', 'CON-009', '2017-12-01', '2019-09-30', 'PER-011', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(12, '', 'EMP-012', 'CON-009', '2017-12-01', '2019-09-30', 'PER-012', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(13, '', 'EMP-013', 'CON-009', '2017-12-01', '2020-03-31', 'PER-013', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(14, '', 'EMP-014', 'CON-009', '2017-12-01', '2019-09-30', 'PER-014', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(15, '', 'EMP-015', 'CON-009', '2017-12-01', '2019-09-30', 'PER-015', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(16, '', 'EMP-016', 'CON-009', '2017-12-01', '2019-09-30', 'PER-016', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(17, '', 'EMP-017', 'CON-009', '2019-01-07', '2020-03-31', 'PER-017', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(18, '', 'EMP-018', 'CON-009', '2019-01-07', '2020-03-31', 'PER-018', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(19, '', 'EMP-019', 'CON-009', '2019-01-07', '2020-03-31', 'PER-019', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(20, '', 'EMP-020', 'CON-009', '2019-01-07', '2020-03-31', 'PER-020', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(21, '', 'EMP-021', 'CON-009', '2017-12-01', '2019-09-30', 'PER-021', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(22, '', 'EMP-022', 'CON-009', '2019-01-07', '2020-03-31', 'PER-022', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(23, '', 'EMP-023', 'CON-009', '2019-01-07', '2020-03-31', 'PER-023', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(24, '', 'EMP-024', 'CON-009', '2019-01-07', '2019-12-30', 'PER-024', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(25, '', 'EMP-025', 'CON-009', '2019-01-07', '2020-03-31', 'PER-025', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(26, '', 'EMP-026', 'CON-009', '2019-01-07', '2020-03-31', 'PER-026', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(27, '', 'EMP-027', 'CON-009', '2017-12-01', '2019-09-30', 'PER-027', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(28, '', 'EMP-028', 'CON-009', '2017-12-01', '2019-09-30', 'PER-028', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(29, '', 'EMP-029', 'CON-009', '2017-12-01', '2019-09-30', 'PER-029', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(30, '', 'EMP-030', 'CON-009', '2017-12-01', '2019-09-30', 'PER-030', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(31, '', 'EMP-031', 'CON-009', '2017-12-01', '2019-09-30', 'PER-031', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(32, '', 'EMP-032', 'CON-009', '2017-12-01', '2019-09-30', 'PER-032', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(33, '', 'EMP-033', 'CON-009', '2019-01-07', '2020-03-31', 'PER-033', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(34, '', 'EMP-034', 'CON-009', '2017-12-01', '2019-09-30', 'PER-034', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(35, '', 'EMP-035', 'CON-009', '2018-12-30', '2020-03-31', 'PER-035', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(36, '', 'EMP-036', 'CON-009', '2017-12-01', '2019-09-30', 'PER-036', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(37, '', 'EMP-037', 'CON-009', '2017-12-01', '2019-09-30', 'PER-037', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(38, '', 'EMP-038', 'CON-009', '2017-12-01', '2019-09-30', 'PER-038', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(39, '', 'EMP-039', 'CON-009', '2017-12-01', '2019-09-30', 'PER-039', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(40, '', 'EMP-040', 'CON-009', '2019-01-07', '2020-03-31', 'PER-040', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(41, '', 'EMP-041', 'CON-050', '2017-12-01', '2019-09-30', 'PER-041', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(42, '', 'EMP-042', 'CON-050', '2018-06-27', '2019-09-30', 'PER-042', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(43, '', 'EMP-043', 'CON-050', '2017-12-01', '2019-09-30', 'PER-043', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(44, '', 'EMP-044', 'CON-050', '2017-12-01', '2019-09-30', 'PER-044', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(45, '', 'EMP-045', 'CON-050', '2017-12-01', '2019-09-30', 'PER-045', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(46, '', 'EMP-046', 'CON-050', '2017-12-01', '2019-09-30', 'PER-046', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(47, '', 'EMP-047', 'CON-050', '2017-12-01', '2019-09-30', 'PER-047', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(48, '', 'EMP-048', 'CON-050', '2017-12-01', '2019-09-30', 'PER-048', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(49, '', 'EMP-049', 'CON-050', '2017-12-01', '2019-09-30', 'PER-049', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(50, '', 'EMP-050', 'CON-050', '2017-12-01', '2019-09-30', 'PER-050', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(51, '', 'EMP-051', 'CON-050', '2017-12-01', '2019-09-30', 'PER-051', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(52, '', 'EMP-052', 'CON-050', '2017-12-01', '2019-09-30', 'PER-052', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(53, '', 'EMP-053', 'CON-050', '2017-12-01', '2019-09-30', 'PER-053', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(54, '', 'EMP-054', 'CON-050', '2017-12-01', '2019-09-30', 'PER-054', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(55, '', 'EMP-055', 'CON-050', '2017-12-01', '2019-09-30', 'PER-055', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(56, '', 'EMP-056', 'CON-050', '2017-12-01', '2019-09-30', 'PER-056', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(57, '', 'EMP-057', 'CON-050', '2017-12-01', '2019-09-30', 'PER-057', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(58, '', 'EMP-058', 'CON-050', '2017-12-01', '2019-09-30', 'PER-058', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(59, '', 'EMP-059', 'CON-050', '2017-12-01', '2019-09-30', 'PER-059', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(60, '', 'EMP-060', 'CON-046', '2019-01-08', '2020-03-31', 'PER-060', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(61, '', 'EMP-061', 'CON-046', '2019-01-08', '2020-03-31', 'PER-061', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(62, '', 'EMP-062', 'CON-046', '2019-01-08', '2020-03-31', 'PER-062', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(63, '', 'EMP-063', 'CON-046', '2019-01-08', '2020-03-31', 'PER-063', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(64, '', 'EMP-064', 'CON-046', '2019-01-08', '2019-09-30', 'PER-064', 1, '', '', '', '2017-12-01', '', '2017-12-01'),
(65, '', 'EMP-065', 'CON-046', '2019-01-08', '2020-03-31', 'PER-065', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(66, '', 'EMP-066', 'CON-046', '2019-01-08', '2020-03-31', 'PER-066', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(67, '', 'EMP-067', 'CON-046', '2019-01-08', '2020-03-31', 'PER-067', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(68, '', 'EMP-068', 'CON-046', '2019-01-08', '2020-03-31', 'PER-068', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(69, '', 'EMP-069', 'CON-046', '2017-12-01', '2020-03-31', 'PER-069', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(70, '', 'EMP-070', 'CON-046', '2019-01-08', '2020-03-31', 'PER-070', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(71, '', 'EMP-071', 'CON-046', '2017-12-01', '2019-09-30', 'PER-071', 1, '', '', '', '2017-12-01', '', '2017-12-01'),
(72, '', 'EMP-072', 'CON-046', '2017-12-01', '2019-09-30', 'PER-072', 1, '', '', '', '2017-12-01', '', '2017-12-01'),
(73, '', 'EMP-073', 'CON-046', '2017-12-01', '2020-03-31', 'PER-073', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(74, '', 'EMP-074', 'CON-046', '2017-12-01', '2020-03-31', 'PER-074', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(75, '', 'EMP-075', 'CON-046', '2017-12-01', '2020-03-31', 'PER-075', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(76, '', 'EMP-076', 'CON-046', '2019-01-08', '2020-03-31', 'PER-076', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(77, '', 'EMP-077', 'CON-046', '2017-12-01', '2020-03-31', 'PER-077', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(78, '', 'EMP-078', 'CON-046', '2019-01-08', '2020-03-31', 'PER-078', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(79, '', 'EMP-079', 'CON-046', '2019-01-08', '2020-03-31', 'PER-079', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(80, '', 'EMP-080', 'CON-046', '2019-01-08', '2020-03-31', 'PER-080', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(81, '', 'EMP-081', 'CON-046', '2019-01-08', '2020-03-31', 'PER-081', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(82, '', 'EMP-082', 'CON-046', '2017-12-01', '2020-03-31', 'PER-082', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(83, '', 'EMP-083', 'CON-046', '2019-01-08', '2020-03-31', 'PER-083', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(84, '', 'EMP-084', 'CON-046', '2017-12-01', '2020-03-31', 'PER-084', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(85, '', 'EMP-085', 'CON-046', '2017-12-01', '2020-03-31', 'PER-085', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(86, '', 'EMP-086', 'CON-046', '2017-12-01', '2019-09-30', 'PER-086', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(87, '', 'EMP-087', 'CON-046', '2019-01-08', '2020-03-31', 'PER-087', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(88, '', 'EMP-088', 'CON-046', '2019-01-08', '2019-09-30', 'PER-088', 1, '', '', '', '2017-12-01', '', '2017-12-01'),
(89, '', 'EMP-089', 'CON-046', '2017-12-01', '2020-03-31', 'PER-089', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(90, '', 'EMP-090', 'CON-046', '2017-12-01', '2020-03-31', 'PER-090', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(91, '', 'EMP-091', 'CON-046', '2019-01-08', '2020-03-31', 'PER-091', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(92, '', 'EMP-092', 'CON-046', '2019-01-08', '2020-03-31', 'PER-092', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(93, '', 'EMP-093', 'CON-002', '2019-01-08', '2019-09-30', 'PER-093', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(94, '', 'EMP-094', 'CON-002', '2019-01-08', '2019-09-30', 'PER-094', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(95, '', 'EMP-095', 'CON-002', '2019-01-08', '2019-09-30', 'PER-095', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(96, '', 'EMP-096', 'CON-002', '2019-01-08', '2019-09-30', 'PER-096', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(97, '', 'EMP-097', 'CON-002', '2018-03-28', '2019-09-30', 'PER-097', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(98, '', 'EMP-098', 'CON-002', '2018-03-28', '2019-09-30', 'PER-098', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(99, '', 'EMP-099', 'CON-002', '2018-09-19', '2019-09-30', 'PER-099', 0, '', '', '', '2017-12-01', '', '2017-12-01'),
(100, '', 'EMP-100', 'CON-002', '2019-01-08', '2019-09-30', 'PER-100', 0, '', '', '', '2017-12-01', '', '2017-12-01');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.contract_employee_work_permit_temp`
--

DROP TABLE IF EXISTS `dbo.contract_employee_work_permit_temp`;
CREATE TABLE IF NOT EXISTS `dbo.contract_employee_work_permit_temp` (
  `permit_id` smallint(6) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `permit_code` varchar(8) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(10) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.contract_employee_work_permit_temp`
--

INSERT INTO `dbo.contract_employee_work_permit_temp` (`permit_id`, `emp_code`, `contractor_code`, `from_date`, `to_date`, `permit_code`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'EMP-867', 'CON-059', '2018-01-03', '1970-01-01', 'PER-856', 0, '1         ', '2018-01-03', '1         ', '2018-01-03'),
(2, 'EMP-889', 'CON-039', '2018-01-17', '2018-01-16', 'PER-877', 0, '1         ', '2018-01-17', '1         ', '2018-01-17'),
(3, 'EMP-893', 'CON-042', '2018-01-23', '1970-01-01', 'PER-881', 0, '1         ', '2018-01-23', '1         ', '2018-01-23'),
(4, 'EMP-893', 'CON-042', '2018-01-23', '1970-01-01', 'PER-881', 0, '1         ', '2018-01-23', '1         ', '2018-01-23'),
(5, 'EMP-900', 'CON-015', '2018-01-19', '2018-03-01', 'PER-888', 0, '1         ', '2018-01-24', '1         ', '2018-01-24'),
(6, 'EMP-745', 'CON-033', '2017-12-11', '2018-03-31', 'PER-739', 0, '1         ', '2018-01-24', '1         ', '2018-01-24'),
(7, 'EMP-745', 'CON-033', '2017-12-11', '2018-03-31', 'PER-739', 1, '1         ', '2018-01-24', '1         ', '2018-01-24'),
(13, 'EMP-799', 'CON-059', '2017-12-21', '2018-03-31', 'PER-790', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(14, 'EMP-799', 'CON-059', '2017-12-21', '2018-03-31', 'PER-790', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(15, 'EMP-623', 'CON-059', '2017-12-01', '2018-03-31', 'PER-625', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(16, 'EMP-625', 'CON-059', '2017-12-01', '2018-03-31', 'PER-627', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(17, 'EMP-891', 'CON-059', '2018-01-18', '2018-03-31', 'PER-879', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(18, 'EMP-799', 'CON-059', '2017-01-31', '2018-04-30', 'PER-790', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(22, 'EMP-910', 'CON-033', '2018-01-25', '2018-01-25', 'PER-898', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(23, 'EMP-908', 'CON-033', '2018-01-25', '2018-01-25', 'PER-896', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(24, 'EMP-658', 'CON-033', '2017-12-05', '2018-03-31', 'PER-658', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(25, 'EMP-659', 'CON-033', '2017-12-05', '2018-03-31', 'PER-657', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(26, 'EMP-660', 'CON-033', '2017-12-05', '2018-03-31', 'PER-659', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(30, 'EMP-664', 'CON-033', '2017-12-05', '2018-03-31', 'PER-662', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(31, 'EMP-665', 'CON-033', '2017-12-05', '2018-03-31', 'PER-663', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(32, 'EMP-909', 'CON-033', '2018-01-25', '2018-01-25', 'PER-897', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(33, 'EMP-745', 'CON-033', '2017-12-11', '2018-03-31', 'PER-739', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(35, 'EMP-611', 'CON-047', '2018-02-01', '2018-03-31', 'PER-561', 0, '1         ', '2018-02-01', '1         ', '2018-02-01'),
(36, 'EMP-612', 'CON-047', '2017-12-01', '2018-03-31', 'PER-562', 0, '1         ', '2018-02-01', '1         ', '2018-02-01'),
(37, 'EMP-152', 'CON-007', '2017-12-01', '2018-03-31', 'PER-152', 0, '1         ', '2018-02-01', '1         ', '2018-02-01'),
(40, 'EMP-001', 'CON-045', '2017-12-01', '2018-03-31', 'PER-001', 0, '1         ', '2018-02-01', '1         ', '2018-02-01'),
(41, 'EMP-937', 'CON-043', '2018-02-05', '2018-03-05', 'PER-922', 0, '1         ', '2018-02-05', '1         ', '2018-02-05'),
(42, 'EMP-937', 'CON-043', '2018-02-05', '2018-03-05', 'PER-922', 0, '1         ', '2018-02-05', '1         ', '2018-02-05'),
(44, 'EMP-148', 'CON-006', '2017-12-01', '2018-03-31', 'PER-148', 0, '1         ', '2018-02-06', '1         ', '2018-02-06'),
(45, 'EMP-145', 'CON-006', '2017-12-01', '2018-03-31', 'PER-137', 0, '1         ', '2018-02-06', '1         ', '2018-02-06'),
(46, 'EMP-953', 'CON-033', '2018-02-07', '2018-03-30', 'PER-937', 0, '1         ', '2018-02-07', '1         ', '2018-02-07'),
(55, 'EMP-986', 'CON-101', '2018-02-15', '2018-02-16', 'PER-970', 0, '1         ', '2018-02-15', '1         ', '2018-02-15'),
(56, 'EMP-987', 'CON-060', '2017-12-01', '2018-03-31', 'PER-971', 0, '1         ', '2018-02-16', '1         ', '2018-02-16'),
(58, 'EMP-1000', 'CON-099', '2018-02-19', '2018-03-30', 'PER-984', 0, '1         ', '2018-02-19', '1         ', '2018-02-19'),
(59, 'EMP-1000', 'CON-099', '2018-02-19', '2018-04-30', 'PER-984', 0, '1         ', '2018-02-19', '1         ', '2018-02-19'),
(60, 'EMP-1000', 'CON-099', '2018-02-19', '2018-04-30', 'PER-984', 0, '1         ', '2018-02-19', '1         ', '2018-02-19'),
(62, 'EMP-1012', 'CON-009', '2018-02-22', '1970-01-01', 'PER-996', 0, '1         ', '2018-02-22', '1         ', '2018-02-22'),
(63, 'EMP-1012', 'CON-009', '2018-02-22', '2018-03-30', 'PER-996', 0, '1         ', '2018-02-22', '1         ', '2018-02-22'),
(64, 'EMP-1012', 'CON-009', '2018-02-22', '2018-03-30', 'PER-996', 0, '1         ', '2018-02-22', '1         ', '2018-02-22'),
(65, 'EMP-1020', 'CON-045', '2018-02-22', '2018-03-31', 'PER-1004', 0, '1         ', '2018-02-22', '1         ', '2018-02-22'),
(67, 'EMP-1020', 'CON-045', '2018-02-22', '2018-03-31', 'PER-1004', 0, '1         ', '2018-02-22', '1         ', '2018-02-22'),
(68, 'EMP-925', 'CON-094', '2018-01-30', '2018-02-26', 'PER-907', 0, '1         ', '2018-02-26', '1         ', '2018-02-26'),
(72, 'EMP-951', 'CON-040', '2018-02-07', '2018-02-10', 'PER-932', 0, '1         ', '2018-03-06', '1         ', '2018-03-06'),
(73, 'EMP-1073', 'CON-111', '2018-03-12', '2018-04-11', 'PER-1057', 0, '1         ', '2018-03-09', '1         ', '2018-03-09'),
(74, 'EMP-804', 'CON-079', '2017-12-22', '2018-03-31', 'PER-795', 0, '1         ', '2018-03-10', '1         ', '2018-03-10'),
(75, 'EMP-805', 'CON-079', '2017-12-22', '2018-03-31', 'PER-796', 0, '1         ', '2018-03-10', '1         ', '2018-03-10'),
(76, 'EMP-806', 'CON-079', '2017-12-22', '2018-03-31', 'PER-797', 0, '1         ', '2018-03-10', '1         ', '2018-03-10'),
(1074, 'EMP-1111', 'CON-001', '2018-03-13', '2018-04-30', 'PER-1096', 0, '1         ', '2018-03-13', '1         ', '2018-03-13'),
(1075, 'EMP-1111', 'CON-001', '2018-03-13', '2018-09-30', 'PER-1096', 0, '1         ', '2018-03-13', '1         ', '2018-03-13'),
(1077, 'EMP-782', 'CON-077', '2017-12-18', '2018-03-31', 'PER-773', 0, '1         ', '2018-03-19', '1         ', '2018-03-19'),
(1079, 'EMP-1014', 'CON-082', '2018-02-22', '2018-08-30', 'PER-998', 0, '1         ', '2018-03-22', '1         ', '2018-03-22'),
(1080, 'EMP-577', 'CON-018', '2017-12-01', '2018-03-31', 'PER-499', 0, '1         ', '2018-03-23', '1         ', '2018-03-23'),
(1081, 'EMP-520', 'CON-053', '2017-12-01', '2018-03-31', 'PER-477', 0, '1         ', '2018-03-26', '1         ', '2018-03-26'),
(1082, 'EMP-342', 'CON-001', '2017-12-01', '2018-03-31', 'PER-342', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1083, 'EMP-343', 'CON-001', '2017-12-01', '2018-03-31', 'PER-343', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1084, 'EMP-344', 'CON-001', '2017-12-01', '2018-03-31', 'PER-344', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1085, 'EMP-345', 'CON-001', '2017-12-01', '2018-03-31', 'PER-345', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1086, 'EMP-346', 'CON-001', '2017-12-01', '2018-03-31', 'PER-346', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1087, 'EMP-347', 'CON-001', '2017-12-01', '2018-03-31', 'PER-347', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1088, 'EMP-348', 'CON-001', '2017-12-01', '2018-03-31', 'PER-348', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1089, 'EMP-349', 'CON-001', '2017-12-01', '2018-03-31', 'PER-349', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1090, 'EMP-350', 'CON-001', '2017-12-01', '2018-03-31', 'PER-350', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1091, 'EMP-351', 'CON-001', '2017-12-01', '2018-03-31', 'PER-351', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1092, 'EMP-352', 'CON-001', '2017-12-01', '2018-03-31', 'PER-352', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1093, 'EMP-353', 'CON-001', '2017-12-01', '2018-03-31', 'PER-353', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1094, 'EMP-354', 'CON-001', '2017-12-01', '2018-03-31', 'PER-354', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1095, 'EMP-355', 'CON-001', '2017-12-01', '2018-03-31', 'PER-355', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1096, 'EMP-356', 'CON-001', '2017-12-01', '2018-03-31', 'PER-356', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1097, 'EMP-357', 'CON-001', '2017-12-01', '2018-03-31', 'PER-357', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1098, 'EMP-358', 'CON-001', '2017-12-01', '2018-03-31', 'PER-358', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1099, 'EMP-359', 'CON-001', '2017-12-01', '2018-03-31', 'PER-359', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1100, 'EMP-360', 'CON-001', '2017-12-01', '2018-03-31', 'PER-360', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1101, 'EMP-361', 'CON-001', '2017-12-01', '2018-03-31', 'PER-361', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1102, 'EMP-362', 'CON-001', '2017-12-01', '2018-03-31', 'PER-362', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1103, 'EMP-363', 'CON-001', '2017-12-01', '2018-03-31', 'PER-363', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1104, 'EMP-364', 'CON-001', '2017-12-01', '2018-03-31', 'PER-364', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1105, 'EMP-365', 'CON-001', '2017-12-01', '2018-03-31', 'PER-365', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1106, 'EMP-366', 'CON-001', '2017-12-01', '2018-03-31', 'PER-366', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(8, 'EMP-614', 'CON-057', '2017-12-01', '2018-03-31', 'PER-563', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(9, 'EMP-613', 'CON-057', '2017-12-01', '2018-03-31', 'PER-572', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(19, 'EMP-906', 'CON-033', '2018-01-25', '2018-01-25', 'PER-894', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(20, 'EMP-906', 'CON-033', '2018-01-01', '2018-03-31', 'PER-894', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(21, 'EMP-907', 'CON-033', '2018-01-25', '2018-01-25', 'PER-895', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(27, 'EMP-662', 'CON-033', '2017-12-05', '2018-03-31', 'PER-660', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(28, 'EMP-663', 'CON-033', '2017-12-05', '2018-03-31', 'PER-661', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(29, 'EMP-641', 'CON-033', '2017-12-01', '2018-03-31', 'PER-640', 0, '1         ', '2018-01-31', '1         ', '2018-01-31'),
(47, 'EMP-921', 'CON-015', '2008-02-18', '2018-03-30', 'PER-938', 0, '1         ', '2018-02-08', '1         ', '2018-02-08'),
(48, 'EMP-543', 'CON-015', '2017-12-01', '2018-03-31', 'PER-580', 0, '1         ', '2018-02-08', '1         ', '2018-02-08'),
(49, 'EMP-819', 'CON-081', '2018-02-01', '2018-03-31', 'PER-916', 0, '1         ', '2018-02-10', '1         ', '2018-02-10'),
(50, 'EMP-928', 'CON-081', '2018-01-31', '2018-01-31', 'PER-910', 0, '1         ', '2018-02-10', '1         ', '2018-02-10'),
(51, 'EMP-929', 'CON-081', '2018-01-31', '2018-01-31', 'PER-910', 0, '1         ', '2018-02-10', '1         ', '2018-02-10'),
(52, 'EMP-953', 'CON-033', '2018-02-07', '2018-03-30', 'PER-937', 0, '1         ', '2018-02-10', '1         ', '2018-02-10'),
(53, 'EMP-884', 'CON-089', '2018-01-09', '2018-03-31', 'PER-872', 0, '1         ', '2018-02-14', '1         ', '2018-02-14'),
(54, 'EMP-884', 'CON-089', '2018-01-09', '2018-05-30', 'PER-872', 0, '1         ', '2018-02-14', '1         ', '2018-02-14'),
(71, 'EMP-1064', 'CON-046', '2018-03-02', '2018-09-30', 'PER-1048', 0, '1         ', '2018-03-05', '1         ', '2018-03-05'),
(1078, 'EMP-855', 'CON-082', '2017-12-28', '2018-03-31', 'PER-843', 0, '1         ', '2018-03-22', '1         ', '2018-03-22'),
(1107, 'EMP-367', 'CON-001', '2017-12-01', '2018-03-31', 'PER-367', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1108, 'EMP-368', 'CON-001', '2017-12-01', '2018-03-31', 'PER-368', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1109, 'EMP-369', 'CON-001', '2017-12-01', '2018-03-31', 'PER-369', 0, '1         ', '2018-03-28', '1         ', '2018-03-28'),
(1110, 'EMP-370', 'CON-001', '2017-12-01', '2018-03-31', 'PER-370', 0, '1         ', '2018-03-28', '1         ', '2018-03-28');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.department_master`
--

DROP TABLE IF EXISTS `dbo.department_master`;
CREATE TABLE IF NOT EXISTS `dbo.department_master` (
  `dep_id` tinyint(4) DEFAULT NULL,
  `dep_name` varchar(13) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(1) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.department_master`
--

INSERT INTO `dbo.department_master` (`dep_id`, `dep_name`, `status`, `created_by`, `created_on`) VALUES
(1, 'HR', 0, '', ''),
(2, 'ADMIN', 0, '', ''),
(3, 'FINANCE', 0, '', ''),
(4, 'PURCHASE', 0, '', ''),
(5, 'Test', 0, '1', '2016-02-16 14:34:00'),
(6, 'now test edit', 0, '1', '2017-04-12 15:23:44');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.designation_master`
--

DROP TABLE IF EXISTS `dbo.designation_master`;
CREATE TABLE IF NOT EXISTS `dbo.designation_master` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(32) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(10) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.designation_master`
--

INSERT INTO `dbo.designation_master` (`id`, `name`, `status`, `created_by`, `created_on`) VALUES
(1, 'Accounts Assistant', 0, '', '2016-02-14 13:20:17'),
(2, 'Doccument Controller', 0, '', '2016-02-14 13:20:40'),
(3, 'Driver', 0, '', '2016-02-14 13:20:58'),
(4, 'EBS Assistant', 0, '', '2016-02-14 13:21:21'),
(5, 'ForkLift Operator', 0, '', '2016-02-14 13:21:42'),
(6, 'HouseKeeper', 0, '', '2016-02-14 13:21:53'),
(7, 'Hr Coordinator', 0, '', '2016-02-14 13:22:25'),
(8, 'Lab Chemist-QC', 0, '', '2016-02-14 13:22:44'),
(9, 'Marketing', 0, '', '2016-02-14 13:23:12'),
(10, 'NDC Inspector', 0, '', '2016-02-14 13:23:26'),
(11, 'Office Assistant', 0, '', '2016-02-14 13:23:39'),
(12, 'PPC', 0, '', '2016-02-14 13:24:01'),
(13, 'Procurment Assistant', 0, '', '2016-02-14 13:24:13'),
(14, 'Store Keeper', 0, '', '2016-02-14 13:24:50'),
(15, 'Store Assistant', 0, '', '2016-02-14 13:24:57'),
(16, 'Team Member Admin', 0, '', '2016-02-14 13:25:08'),
(17, 'Team Member HR', 0, '', '2016-02-14 13:25:21'),
(18, 'Technical Associate', 0, '', '2016-02-14 13:25:50'),
(19, 'Test', 0, '1         ', '2016-02-16 14:43:23'),
(20, 'Executive1', 1, '', '2016-09-15 08:21:08'),
(21, 'test1', 0, '1         ', '2017-04-12 14:45:55'),
(22, 'Assistant Manager', 0, '1         ', '2017-07-05 12:32:45'),
(23, 'Commi-I', 0, '1         ', '2017-07-05 12:32:49'),
(24, 'Commi-II', 0, '1         ', '2017-07-05 12:33:07'),
(25, 'Commi-III', 0, '1         ', '2017-07-05 12:33:13'),
(26, 'Steward', 0, '1         ', '2017-07-05 12:33:16'),
(27, 'Store Helper', 0, '1         ', '2017-07-05 12:33:19'),
(28, 'Store Keeper', 0, '1         ', '2017-07-05 12:33:23'),
(29, 'Supervisor', 0, '1         ', '2017-07-05 12:33:25'),
(30, 'Unit Chef', 0, '1         ', '2017-07-05 12:33:29'),
(31, 'Unit Manager', 0, '1         ', '2017-07-05 12:33:33'),
(32, 'Utility Worker', 0, '1         ', '2017-07-05 12:33:36'),
(33, 'STP-OPERATOR\r\n', 0, '1         ', '2017-07-12 11:24:16'),
(34, 'SENIOR-FACILITIES TEAM MEMBER\r\n', 0, '1         ', '2017-07-12 11:24:31'),
(35, 'SR. FTM MECH\r\n', 0, '1         ', '2017-07-12 11:25:02'),
(36, 'SHIFT ENGINEER\r\n', 0, '1         ', '2017-07-12 11:25:16'),
(37, 'FACILITIES TEAM MEMBER\r\n', 0, '1         ', '2017-07-12 11:25:31'),
(38, 'FACILITIES TEAM MEMBER-PLUMBER\r\n', 0, '1         ', '2017-07-12 11:25:47'),
(39, 'JUNIOR ENGINEER\r\n', 0, '1         ', '2017-07-12 11:26:02'),
(40, 'SR. FTM\r\n', 0, '1         ', '2017-07-12 11:26:17'),
(41, 'SR.UTILITY TECH\r\n', 0, '1         ', '2017-07-12 11:26:43'),
(42, 'SUPERVISOR - WTP\r\n', 0, '1         ', '2017-07-12 11:27:03'),
(43, 'SHIFT ENGINEER\r\n', 0, '1         ', '2017-07-12 11:27:16'),
(44, 'FACILITY MANAGER\r\n', 0, '1         ', '2017-07-12 11:27:36'),
(45, 'TECHNICIAN\r\n', 0, '1         ', '2017-07-12 11:27:50');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.device_master`
--

DROP TABLE IF EXISTS `dbo.device_master`;
CREATE TABLE IF NOT EXISTS `dbo.device_master` (
  `id` tinyint(4) DEFAULT NULL,
  `Device_code` varchar(12) DEFAULT NULL,
  `Device_id` tinyint(4) DEFAULT NULL,
  `Device_serial_no` varchar(38) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.device_master`
--

INSERT INTO `dbo.device_master` (`id`, `Device_code`, `Device_id`, `Device_serial_no`, `status`) VALUES
(1, 'In Device 1', 1, '{1517DF17-F1FB-4E95-A46E-5D941E740685}', 0),
(2, 'Out Device 1', 2, '{D6EA1FF3-23CB-4176-A919-166060A26778}', 0),
(3, 'In Device 1', 3, '{F5AB7351-9219-4226-B652-E7783E3BABCA}', 0),
(4, 'Out Device 1', 4, '{82A83DB3-9321-4A99-B505-C7E59A258453}', 0),
(5, 'In Device 1', 5, '{C510C8DC-2B83-463B-9A79-712CDFF9EC75}', 0),
(6, 'In Device 1', 6, '{CC965049-333C-C84D-940E-A4D584C09212}', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dbo.employee_attendence`
--

DROP TABLE IF EXISTS `dbo.employee_attendence`;
CREATE TABLE IF NOT EXISTS `dbo.employee_attendence` (
  `id` varchar(0) DEFAULT NULL,
  `emp_no` varchar(0) DEFAULT NULL,
  `month` varchar(0) DEFAULT NULL,
  `year` varchar(0) DEFAULT NULL,
  `barcode` varchar(0) DEFAULT NULL,
  `status` varchar(0) DEFAULT NULL,
  `in_time` varchar(0) DEFAULT NULL,
  `out_time` varchar(0) DEFAULT NULL,
  `in_date` varchar(0) DEFAULT NULL,
  `out_date` varchar(0) DEFAULT NULL,
  `ip` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.employee_status`
--

DROP TABLE IF EXISTS `dbo.employee_status`;
CREATE TABLE IF NOT EXISTS `dbo.employee_status` (
  `id` mediumint(9) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `statusdate` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.employee_status`
--

INSERT INTO `dbo.employee_status` (`id`, `emp_code`, `status`, `statusdate`) VALUES
(1, 'EMP-001', 0, '2017-11-23'),
(2, 'EMP-340', 0, '2017-11-24'),
(3, 'EMP-341', 0, '2017-11-24'),
(4, 'EMP-406', 0, '2017-11-27'),
(5, 'EMP-407', 0, '2017-11-27'),
(6, 'EMP-408', 0, '2017-11-27'),
(11, 'EMP-413', 0, '2017-11-27'),
(12, 'EMP-414', 0, '2017-11-27'),
(14, 'EMP-416', 0, '2017-11-27'),
(18, 'EMP-420', 0, '2017-11-27'),
(19, 'EMP-421', 0, '2017-11-27'),
(20, 'EMP-422', 0, '2017-11-27'),
(21, 'EMP-423', 0, '2017-11-27'),
(22, 'EMP-453', 0, '2017-11-27'),
(26, 'EMP-457', 0, '2017-11-27'),
(27, 'EMP-458', 0, '2017-11-27'),
(28, 'EMP-459', 0, '2017-11-27'),
(29, 'EMP-460', 0, '2017-11-27'),
(30, 'EMP-461', 0, '2017-11-27'),
(31, 'EMP-462', 0, '2017-11-27'),
(32, 'EMP-463', 0, '2017-11-27'),
(33, 'EMP-464', 0, '2017-11-27'),
(39, 'EMP-470', 0, '2017-11-28'),
(40, 'EMP-471', 0, '2017-11-28'),
(42, 'EMP-519', 0, '2017-11-28'),
(43, 'EMP-520', 0, '2017-11-28'),
(44, 'EMP-521', 0, '2017-11-28'),
(45, 'EMP-521', 0, '2017-11-28'),
(46, 'EMP-522', 0, '2017-11-28'),
(50, 'EMP-594', 0, '2017-11-29'),
(51, 'EMP-595', 0, '2017-11-29'),
(52, 'EMP-596', 0, '2017-11-29'),
(54, 'EMP-610', 0, '2017-11-29'),
(57, 'EMP-615', 0, '2017-11-30'),
(60, 'EMP-629', 0, '2017-12-01'),
(61, 'EMP-630', 0, '2017-12-01'),
(62, 'EMP-631', 0, '2017-12-01'),
(63, 'EMP-632', 0, '2017-12-01'),
(64, 'EMP-633', 0, '2017-12-01'),
(67, 'EMP-638', 0, '2017-12-01'),
(71, 'EMP-642', 0, '2017-12-01'),
(72, 'EMP-643', 0, '2017-12-04'),
(74, 'EMP-670', 0, '2017-12-05'),
(77, 'EMP-678', 0, '2017-12-05'),
(78, 'EMP-679', 0, '2017-12-05'),
(79, 'EMP-680', 0, '2017-12-05'),
(80, 'EMP-681', 0, '2017-12-05'),
(81, 'EMP-682', 0, '2017-12-05'),
(82, 'EMP-683', 0, '2017-12-05'),
(83, 'EMP-684', 0, '2017-12-05'),
(87, 'EMP-688', 0, '2017-12-05'),
(88, 'EMP-689', 0, '2017-12-05'),
(89, 'EMP-690', 0, '2017-12-05'),
(90, 'EMP-691', 0, '2017-12-06'),
(92, 'EMP-693', 0, '2017-12-06'),
(96, 'EMP-697', 0, '2017-12-06'),
(97, 'EMP-698', 0, '2017-12-06'),
(99, 'EMP-700', 0, '2017-12-06'),
(100, 'EMP-701', 0, '2017-12-06'),
(102, 'EMP-710', 0, '2017-12-06'),
(103, 'EMP-711', 0, '2017-12-06'),
(104, 'EMP-712', 0, '2017-12-06'),
(106, 'EMP-714', 0, '2017-12-06'),
(107, 'EMP-715', 0, '2017-12-06'),
(108, 'EMP-716', 0, '2017-12-06'),
(111, 'EMP-719', 0, '2017-12-07'),
(112, 'EMP-720', 0, '2017-12-07'),
(114, 'EMP-722', 0, '2017-12-07'),
(115, 'EMP-723', 0, '2017-12-07'),
(117, 'EMP-725', 0, '2017-12-07'),
(119, 'EMP-727', 0, '2017-12-07'),
(120, 'EMP-728', 0, '2017-12-07'),
(121, 'EMP-729', 0, '2017-12-07'),
(122, 'EMP-730', 0, '2017-12-07'),
(123, 'EMP-731', 0, '2017-12-07'),
(125, 'EMP-733', 0, '2017-12-07'),
(126, 'EMP-734', 0, '2017-12-07'),
(127, 'EMP-735', 0, '2017-12-07'),
(129, 'EMP-737', 0, '2017-12-07'),
(131, 'EMP-739', 0, '2017-12-08'),
(136, 'EMP-744', 0, '2017-12-08'),
(137, 'EMP-745', 0, '2017-12-11'),
(138, 'EMP-746', 0, '2017-12-11'),
(143, 'EMP-751', 0, '2017-12-11'),
(144, 'EMP-752', 0, '2017-12-11'),
(150, 'EMP-758', 0, '2017-12-11'),
(151, 'EMP-759', 0, '2017-12-12'),
(152, 'EMP-760', 0, '2017-12-12'),
(155, 'EMP-763', 0, '2017-12-12'),
(156, 'EMP-764', 0, '2017-12-13'),
(160, 'EMP-768', 0, '2017-12-14'),
(161, 'EMP-769', 0, '2017-12-15'),
(162, 'EMP-769', 0, '2017-12-15'),
(163, 'EMP-769', 0, '2017-12-15'),
(164, 'EMP-770', 0, '2017-12-15'),
(165, 'EMP-769', 0, '2017-12-15'),
(166, 'EMP-769', 0, '2017-12-15'),
(167, 'EMP-769', 0, '2017-12-15'),
(168, 'EMP-771', 0, '2017-12-15'),
(169, 'EMP-772', 0, '2017-12-15');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.fingerprint_master`
--

DROP TABLE IF EXISTS `dbo.fingerprint_master`;
CREATE TABLE IF NOT EXISTS `dbo.fingerprint_master` (
  `id` mediumint(9) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `finger_pos` tinyint(4) DEFAULT NULL,
  `finger_print` text,
  `status` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.fingerprint_master`
--

INSERT INTO `dbo.fingerprint_master` (`id`, `emp_code`, `finger_pos`, `finger_print`, `status`) VALUES
(10528, 'EMP-001', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAngAz/v8AAAD8AUQAxADEAQAAAFYVQLQAp0lXQHcAiExVQFwAik9VQEwAPkZUQIEAq1BUQEEAnlZUQJQAyE1TgHMAUUhSQGUAp6dRQCoBG2JRQDsA4VtQQKgAqaVOQCEAeVJOQKoAjqRMQKoAbUhMgNcAXUhIQOcA7qNHgO8Alqc5QDYBCgc4ANYAZksxAGMBO1EpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(10604, 'EMP-1945', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZgCoBHX9jQJYAv1JjgD8AIVVigGYAL1VfgI4A6FpfQEwAZrBcgDwATFxcgK8ANqxagHgA5rBZQLUATFFZQGUAsV5ZQMoAnaZXgBsAtGlWgIkAiFRWQKkAm1RVgEYAnmBVQIkAo6tQgKoBG01QQF8APVZPgHMA8WJPQG4BGXNOgIYAH09NgH4BK3NIAAgBA3g1AAIA+RouAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(3, 'EMP-342', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABuAAz/v8AAAD8AUQAxADEAQAAAFZEQHcBB1VkgDEArbBgQHkA01RZQEQAUlJXQCQBIHVXQDUBBwRWgDAA6wJWQBsA2GdVQGgAwlVUgFYBCV5QQKAAZExOgCYA8WxNQIMA7VVNQEIBI3dNQC4BKRxNQGwBImZMQIcAo09LQMQA+J5LgA4A4xBLQIIAZFFKgM8AvatJgF0BJXNIQL0A/55HQGsAN01EQDoBGm1EQOEAr1JDQD4BKHRDQIgBEVVDgBUA2HFCQMkA+Z5CgI8BG1BBgBMAeVtAgMMBJZw/gOEA4FE/QFwAQk0+QOAA0Z49gFUAN6U9gNsAr088QEQANak8QAcA12k7QM8A10Y7QNkA4aA5gBcAaK45QLgBJJs5QHMAPk84gDsAHE04gG4ANks3QGwASEY3gMUAlE03gIMAK0k3QMYAmk02QKkAQU01gOUAxVA1QA4A1mk1AHkBF6k0AIIBOE00AGMBOxg0AGYAG6YzAN0AykgzAOcA10QzANEAsUsyAN0A+KAyAHcBK6kxAO0Au6UwAOsAqUouANMAq0kuAGsAQk4uAMUA4KgtAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(4, 'EMP-342', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABuAAz/v8AAAD8AUQAxADEAQAAAFZEQFcA+2dhgBkAzXpdQBsA84VbQF0BEWdaQHcAiQhYQMkAzI1YQCkA7IlYQLQAMq5XgNEAlZlVQC8Ar3xVgI4AJGVUQCQAeHBUQF8AeA1UQKgA3oJSQHwAb2hRQKUAg6VRQDoA04dRgLAA539QgGsBHnFQQLgATK9QQHIA8nNQQJQAXghPQJkA43tOQJkAV2ROQKkA+ylNgEwBDRZMQL4ATatMQNEAYaJMgI8Am6NLQOAA/IlLgLABDnxLQCMAq3dLQN8AyI9KQJIBCXpKgEsBBxRJQJIA0H9EQFcA8mlEgOYA8zNEQHMAlQZDgA0AyhtCQGcAyxc/QL4A04k/QNkA24c/QNAAf54+gE8A+BE6gHEA63E5gCoBCrA5QGcBGRw5gDwA64M4QHUA7HE4QG4AvBg3gHcAv383QG4AoQg2AFAAL2k1AFIAyHI1ACoBEa00AGwBOHc0AJkAyjszAAIAtHMyAHUAsGkyAFcA0SAyAE8AxnoxAFgA2hcxAHEAsHExAEgA7S8xAC8BCLAxAAQAzRswAEEA/w0uAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(11, 'EMP-415', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAmAAz/v8AAAD8AUQAxADEAQAAAFYUQDUARVRdQB8AqlxbQGcA3lBZQFwAkFRWgKMA7kdUQGMAbVJTQFUAqVhTQNEAoKNQQHcATU9PQE8AdVFOQMAA60RNQNQAg6VMQKUA0aBLQDcAN6tLgCYAk1lJQM8A0qJJgOUAyElIQNYA0KRDQDcBAV48ACYAUlUwAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(21, 'EMP-420', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABQAAz/v8AAAD8AUQAxADEAQAAAFYwQJoAaFJgQCEA2INeQCYAt39aQKUAg6RYQCoARWZXQNEARqlWQDoAXGtVQE8AinBRgKAAvIxRgEwAhW5RQMUAxpFRQCAAdBJQQL0A0odQQEYA/5lPgNAAoKBPQG0Ak1tOQPEAuaBNQFAAxolNQLQAp55MQHMAaFJLQJIBFwVLQHIAXKxJQGwA0ZtJQIYAoE1HgDYAS2VGgEsA9DtFQKMA/hZFgKoBB15FQNYA25BEgHIAxp5DQA8ArXhCQJMA6w8/gIcA00Q+gIwA8UY9gNsAN1E8QGYAnXE8QJcA8V48QEgAEFs4QMoA4zU4QNcA+Yg4gG0AoW43gGUAvIc2AIkA66k1AHwAvZ8yALsAyz0xAJMA0TwrAI4A2EorACgBEZIqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(22, 'EMP-420', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABdgAz/v8AAAD8AUQAxADEAQAAAFY5QKgAhVJgQDEA14FdQDUAZGdZQB0AzHxZgF8A5ItYQNsAwJ5XQFAAMFpWQOAAZqtWgEUAfG1WQC8A+INVgK4A14xSQLQAnqVRgFoAoG5QQHgA3S1QQMAAxJ5PQC8AkxNPgEIAaGdOQMkA7olOQNMA45FMQH4AeKxMQH8Ag1JLQFUBG5dLQOQA+41KgDYAMAVKgFgBFDxKgOcAU1BIQHkArWhHQJIAu1ZFQHgA7JlFQOUBGYhFQK4BHhFEgJQA8UFDQI0AvVU/gJkBDUY/QKQBD1o/QIIAxWk/gFYBCpI/gBQAbww9gHEA2Is9QHMAtAI9gHsAvG49QOcAS6g6QMsAJFA3QJ4BBw43QIIA4aI2AJwBObA0AJYBB6kzALsBM2AyAIgA2KQuALgBKVwuAAQA84EsAA8AihArAA4AbA4rAAQAWWoqAAQAfnEpAKABHU0pAGYBOZ4pAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(23, 'EMP-420', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABLgAz/v8AAAD8AUQAxADEAQAAAFYtQKMAY2VigFYA9HVgQC4BB3VeQD4AzG5bQEEBKXxZQJcAt2tYQIYAiGpYQKgA4AZYQEIAiWtWQGYA3RRVQJIA0xFVQJ4A9AtUQJ0AVwtTQHkA53FTgKkBAQVSQOABF5VSQO0AtqxRQHkAdQ1RQIgAzW9QQOUBBZlQQM8Afq9PQMkBHUFPQCsA0G9OgGwBKH5OgKUBFAROQNEAyFVNgIYATA9MQMQAfl9KgKUAfwVKgI0BGYFKQPEAk1VIQDEA2BdHQBsAihBFQDEApGpFQJIBGYJAQN0BMpM+QLQBOH08QGgAJA86QMYBI403QMsAEmI2QKMBGgA2AMMBFZI0AKIBLiIyALQADg0tAKMBNiUtAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(30, 'EMP-407', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAwgAz/v8AAAD8AUQAxADEAQAAAFYbgKMA/F9jQFEAaFVigL4A21ZegEgAtGVdQFUA5GlZQKoAwlZYQCoAgFpXQGUASVRWQN8A9lRUQMAAlFVSgMAAp1ZQQIgAYbJPQIkAU1hPQKUA2rJPQOoAnqxOgH4A3mVMQCsAll1MQJkBImJHQNMAZlpGQGsAsFtDQH4A5GU8gK0AzLA8QL0AbVo3gB8Am2A2ABAAj2AuAKkA06wrAJYBKWEpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(31, 'EMP-407', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAngAz/v8AAAD8AUQAxADEAQAAAFYVQC4AlGlZQGgAm2dXgC8A9A9WQEIA/nBWQCkA4BFVQNMAbgRVgJcASwZSQEoAVwtSQIMAdQVRQE8Aqg9RQKUAMgpQQEQA4w1QQF0AxAtPQGMBBwhOQHgAp2dLQDoA53BGQOcAsaxAQCsAMWU8QO0AhgA7QDoA+W42APIAk64tAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(695, 'EMP-040', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZQHMAq1pkgHkAk1JggHcAYVJaQHwASU5ZQJMAxlhWQIIA5F9WgDYAYVRVQDQAXFVSgEsAKFBPQD8AiWBPQF0AiaxPgK4AtFJKgKAAbFRIgKQAsalHQIIA3WBDQF8A7mdDQEoA2GpAQEYA0gQ+gLgANUs3QGMA0mQ1AEYA7QwyAOwAvKQtAOcA000rAOsAxk0qAO8AsagpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1039, 'EMP-405', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABdgAz/v8AAAD8AUQAxADEAQAAAFY5QKkA2FZcQGMA82dZQJ0BDVtUQGcBAQ1RQLYAV1ZRgIwAwK5QQBQAv2VPQJIBDwlPQLsAc1ZOgO0Aq1JOQCsAPUtNgJYA+ABNQIIA9GdNQDAAmWJMQI0BAWJLQHwAtwJJQCsATE9IQEoAc6NIQIkAlGxGQG4BDmpGgEoAvWdFQOcA9FRFQEoA/GlEQNEAeKpDgHcAMk1CQIwAmgBCQNkAea5BQEgAO0s/QEYAg1Q/QHwAgAU+gFIAk0A9QIIAvAA9QGEAmzo6gHwAcwQ6QAkAZFQ4gEwAhUs4gGcAwA84gGYApCs3QGEAqn83QHkBCA03QEoAtRc1ADUAoWU0AFoAgJMzAGcAcwAzAHcAj0gzAIcAp14zAHsAnXgxADsAkFYwAF0Aho4wAHEAdAYvAHkBKWcuAHcAqwQtAIcAngIsAEIAiI8sAEQAL6cpAGgAhqwpAFAAuxYpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1136, 'EMP-777', 7, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAqgAz/v8AAAD8AUQAxADEAQAAAFYXgK8AWUhegJMA8ZFcgI4AbEpcgIcBEYxYQJcAO0hXgG4AYU1WQMoAPUdUQKAAZEpUQLYA7JJTQMAAUaJSQHkAj09QgIIAbalPgJoAr55NQLUAlqBLgFYA1p9JgFYA55BEgDwA9INDgBcA/Hw9gDwA63w8QEUA7os8QLYAO0Q6QJQAt5s3AEwA5GAwAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1139, 'EMP-778', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAqgAz/v8AAAD8AUQAxADEAQAAAFYXgDsBCV5aQOAA/0ZXQD8AQ09WQIYAtk9WgLsAckxTQFUApKtTQJkA5EtTQHgA4aRSQJMBFUlSQDQAzFZSQEQA/1ZRQGMAbVBRgCQAq6xRgOUA/kZOQJwAK0tOgGcA5KVNgIwA8kpNQMYA5KJMQOoAoaZJQG4A2KRGQHEA3VBDgHUA1qY/QGYBNac6AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1774, 'EMP-906', 6, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAjAAz/v8AAAD8AUQAxADEAQAAAFYSQMMAZmJiQIcAwm1cQMwAoVpYgK0A7XxWQM8AfKlWgMYA7oJWgH4AxhdTQG0AbmtSgLYA9n1MgLQAcwJMgJQA+x5KgIIA/3pFgOoASLBFQKkA3nhEgLQAtwI9QD8AbxE8QOUA2Ik2AD4AzB0uAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1289, 'EMP-842', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAqgAz/v8AAAD8AUQAxADEAQAAAFYXQJMA02VYQIcA/3VTQHsAXlpTQJYApGBTQKgAflhPgIIAzQZOQFEAc2RMQGgBB3ZMQNMAbaxMgIwAKFVLQLsBCGVKgFUAT15IgGYALa9IQL0AQlVDQGMBBxdBgLkAU1U8QMAAzao8QHUA6w07QA0AZGc6AGUA+XowABQAdQ8tAA4Ar2UqAAIAsWgpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(89, 'EMP-111', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAApAAz/v8AAAD8AUQAxADEAQAAAFYWQHsA52NdQIYAlmJYQL4AoKxYQJ0AcgRVgIgAxgJVQM8AZ1pTgK4A9J5TQFAAvXFSQGUAyg1PQGgA4wZNQJkA7qxNQGYATwlMQEsA/xBMgMwA7qJKgGMBBQhHQI4A+6JEQFYBB2w/gHEBB2Y7QHwBCaU6AA8AlRM1ANkA0KMyAOAAyKUxAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(5, 'EMP-413', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA+AAz/v8AAAD8AUQAxADEAQAAAFYkQGwAmQ1eQNEA2qBcQKQAta9bQM8Ay05ZgMAAdABXQLgA2qBXQDEAj2xVQCkA525VQJoA9KRTQGgAJBJSQMYAlVpSQO8A5JtSQJIARgtRQLUAja5RQK8ApABQQEIA3RdQQGYAjWtPQOsAQrFOQKoA66BNQLkBGZRNQOEA50ZKQHIBCA1HQF8Agw1GQMYA9khGgL0A+0hEQKkBF49EQN8A9JZDQOoA8z9DQIMBFaVAQCQAbw07QCMAeQs4gIgBImM4AMAA8ks1ACgAQRAzAK4BKzgzAN0AFwQyAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(6, 'EMP-413', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAmAAz/v8AAAD8AUQAxADEAQAAAFYUQCAAbVlhgJYAK0hdQK8BMD9agIwA0ktZgJ0AnqNZQMMA7p5YQCMBAm9YgJkBLppWgCYAN1lUgHkAXU1UQKUAkEhSQMMAdEROgOYAv6I5gAIA3WU1AHUBOU41AI4BO0E1ACgAkGAzANQBLpkyAHwBOUkpAGcBO6QpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(7, 'EMP-406', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA+AAz/v8AAAD8AUQAxADEAQAAAFYkQMMAfGVeQDwA+HVeQLQAtqxbQGwAgg1ZQMoAgwZWgKoAhQlWgFIA3Q9VQCsA5BdVQJMBAadVgL8AoK5UgDUAynNUQIwA1wBUgEEBExdSQMkAQWlRQGAAvRFRQI4AsQpQQI4AYQ9QQKgA5qpPgJkAwABPQGwA/gdOQHkAT2xOgDUAqhRMQDEAxXFLQIEBHaJDgLIAWAs/QIkAUxI+QHkAWBc8gNYA2082AHEA+GM1AGsAL2gyAKAAIhAxAI4A9KsuABUA0hctAHgBL1orAHMAKBEqAIcBLlgpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(8, 'EMP-406', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA/gAz/v8AAAD8AUQAxADEAQAAAFYlgGUA4VhdQL4A9E1bQCAAS0tXQIkAhUtWQEgAPUdWQC8A11pWQFIAj09VgCMAoVRVQGYAOERRgFEAlE5PQG0AFkJOQN8Av6lOQLYBF01OQIwAxKlNQHUBILJNgIkApU1NQIgAqk9LQCgAXUtLQDwA/2BKQIIA1lJJgIMAvE9HQNoAhktHQCEAv1hGgIgA2lJAQKoBHlE+QOUAeqc7QGAAu1Q7QK8AJ0g5gCMAZEs4gKIAJEQ4gKQBA004gHMAG0E1AJ4BKKcxAJIARkQwAOsAyk0sAKUAIEcrALIAIUgqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(9, 'EMP-414', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABKAAz/v8AAAD8AUQAxADEAQAAAFYsQJoAmlJkQGsBJV5gQHEANUReQG0A2lhdQGUAfFRdQIEAxVVdQGcBEa9dQNAAj09cQEIApLJbQKIAfqtZQEQBCWBZgLIBK6RZgHUAV1BYgL0BJE9YgGgAalJXQBoAZFBXgF0A9FpXgFIAMkFWgNMASUlWQEgAUUlWQCkAmVpWQKIAQ0pVgJIBJVFVgKkBGqRUgCEAUUZTgKgA01JSgCkAeVRQgOUBBaVQQMwBGklPQFUAmVVOQJ0A1q5OgFAA57BLQFwAWapJQFAAkK9HQM8AaE9FgNAAb6tFgAIAjVQ3AAIAmlc0AAIAoFguAIMBOVYrAL0BOKIqAAIAelMpAKMBOU4pALIBOUspAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(10, 'EMP-414', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABEAAz/v8AAAD8AUQAxADEAQAAAFYogHkBJHBfgNoA119dQLYAngpcQNYA7rJbQNoAMBdZQN8AtgNWQEsBKXJWQHgAeBJWgO0AdApVQKIAXxFUQOsAtV9SQFAA02lSQJkAPBRSQI8AH3FRQNoAZxFRQHgBEQ1PQKoA0QROgM8BA7JOQH8AFxdMgKUA/mRMQJ4AIRtKQNQA4QJJQCQANmlJgIYBEwtIgDEAdA1HgGMAGxdGgA8A4WlGQFAAIG5EgCoBKRZAgI4BM2k+gLABFwU4QNQBB1g3QD4Aq2c2AA0A3Ww1AGwAD3g0AH4BOw0yAGgBOxkxAPEAQw8vANoBD1osAHMBORMqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(12, 'EMP-415', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA+AAz/v8AAAD8AUQAxADEAQAAAFYkQKMA0mtdQFoA4xdaQFAA23FYQGcAX2tXQEgAaG5WQL8AUmVVgMMApwZVQOQAsVxVQDEAlHFUQIcAWGdUQL4A3a9TQNsAlrNSQHUAthdRQHgA8hNRQD8BAhhRQI0BHW5PQL8ARgtOQEoA9nJNQIEATxNMQNYAggJLQEoAOGlJQLQAVg1JQEQA1hdJQFgAbBNHQD8A7BhHQMsAywBHQH4AXg9GgMUA8aNFgIgA6xJEgK8BG243AOQAcwQ0ANMBG5czAL8BIn4vAIMAYW4uAKoBKhosALABKiEpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(13, 'EMP-416', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABNAAz/v8AAAD8AUQAxADEAQAAAFYugJcATFFiQFEAp11eQCkATVteQHwAqVRaQEYAPlZZQCkA23ZZgNkARlBZQFoBD5BYQDcBIIJXQN8A2pZXgGcAU1ZWgJkAK1JUQLUA0JZUQF8A4XFUQD8AmWNTQEEAS7BSQOwAxptSgEsA2HFRQI4BIm5RQL0A841QQCgBBXtQQIkA2FJPQDABDoBNQFABGpJNQDsAYQBMgEsAy2dLQIMAmadKQJ4BAYtIgG4BGi9IgFYBKTJHQIcA61RCgI8BFDtCQLkAPalAQHgBEYdAQEgA0AY9QI4A+UE9QIwBBYk9QHwBCY48gIYA7lY6QHEBFIw5gI8A8kg4QH4BFC83gH4BIiU2AHkBHjUwAIcBLnUuAIMBJB4qAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(14, 'EMP-416', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABFgAz/v8AAAD8AUQAxADEAQAAAFYpQK0AzDpfQHkAXWBeQGAAlABbQKQAbK9bQGcBCnNbQHsA2zVZQHwA/iNYgEgAZAlWQKgAqUFVQDoAywJVQHUAqadUQIMAbrJUQI0AUQJTQDEAf2lTQJQA4YFTQGUAbgVRQKIA04tPgC8ArQ5MQFIAsWBKQF8BFRdKQHUAxI9JQJkAnaZIgC4AvAhHQIEAvI9GgFIA5nNDQD8A22dAQK4Anpk/QEwAsQY/gAgAqxE+QGcAeQA8QFIAfwk6QJkAkFI4AL4ApZ4zAEwA3WcwAEUA4WktAL4Am6EsAKoA6IQsAKoA4DgrAFUA1okpALUAm00pAKQAo00pAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(15, 'EMP-417', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAyAAz/v8AAAD8AUQAxADEAQAAAFYcQKQA4VpfQBMAo1xeQIwAtVVcQFwBJGZbQFIAalZbQI4A01hbgF8AIlJaQE8Ay1xXQEgBEWRXQJwAVlBWQGYAiVRWQFIAlFhUQDEAME9TQN0Ap1RRQFgAywBRQF8AHE9NQBMAvQRNQI8AMU1LQK4AJK1IQJoAnlZIgM8A5KZHgK0AN089gOoA9lE1QKoBMqk1AMoA7FA0AOQArVgyAGEAEKMwAKQAOK8qAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(16, 'EMP-417', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA+AAz/v8AAAD8AUQAxADEAQAAAFYkQG0AvFhdQIEAylpdQEoAclJcQCoAtFpbgDsAT1RbQDUAelpaQD8AiFVZQG4AnlVZQIIAQU9YQMsAy6pTgHkAGkxSQDsAtABRQL4AlFRPQMoBB6ZOQIwBF6ZOQK0A1kxLQIIAelJJQMABDqVJQKQA0qpHgDUAg6xGQIgAzFZEgLQBGaVDQOYAhqtBQMUAo6tBQIYAiK88gKMAIq44gK4A0ag2QNQBCkg2gI0AIK41AI8AKEw0ANkA400yAMsAo64vAJwAFKwvAIwAJq4sAM8BDkssAHwADqcqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(17, 'EMP-418', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAwgAz/v8AAAD8AUQAxADEAQAAAFYbQJ0Ab0ZcgLsAYUhZQJQAqU1RQFUAxEhRQKQA0FZRQIEAfKJOQIcAN0RLgDsATJlLQC4AbZlLQJoAj0hLQDsAgjxKQJYASJ5HQFwA/1ZGQH8AaqFGQJ4Ag0hFQJkATKFCgNsAll4+QNQApAE9gIwAV548QMsA51g5QDoAOKA4AEoA5000AFAAIksyAIwAUUQuANYA5FwuAN0ApAUtAEQA408rAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(18, 'EMP-418', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAmAAz/v8AAAD8AUQAxADEAQAAAFYUQNMAVlhfQEQAlGtdQMQAWbBbgHMAegZYQJwA52JWQEgA0RJTgFoAcwtRQIMAxgZPQJYAbWBPQJ4A8wJKQJ4AwGNIgJ4A+QBHQKMA7WZEQJQA5wY+gKIAfAI7QKQBDbA5ANkA2k8xAJ4BDwAxALYBClgvALABD1AvAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(19, 'EMP-419', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA5gAz/v8AAAD8AUQAxADEAQAAAFYhQIIAr0tbQI0A2k9ZQDoAxlpYQHIAg0lWQF8A7F5WgHsASURUQFAAjU9TQGcA/GJQQMwA0ERPQFYA3VRPgDQAU09OQDEA2GxLQDUAWExKgNcA8aBKQEUA2wNHgCQAeKpGQCkAvK5EQBUAmltDQMAAK0VBgDcAtVpAQC8AtmI/QMkAxKA+gJYA/ks9QBoA0GE6QGYBGaI4gEEBFxo4gJwA/Eo3QLgA86M2QNAAg0Y1ALAA40Q1AKAA9qMyAKQA+U0uAA4AwGArAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(26, 'EMP-422', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAqgAz/v8AAAD8AUQAxADEAQAAAFYXQJIA/2BkgI0A3lxfQJ0BE1legLsAuatbQIkAYVVaQHEBAQZZQCQAampXQEwAcmJXQDEAS15WQEUAvAtUQG0AJ1VSQLYBE1RQgMMAXlROQDsAZAJNQDcAWGBNgBUAXAhNQF8Ap2ZNgCsA3mxGQBsAkA9CQHEADlBBQIgBDQZBgI4BDwc9AKQBKLAtAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(831, 'EMP-401', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAmAAz/v8AAAD8AUQAxADEAQAAAFYUgMQA0albQH4A4wBYQF8A1mVVQJkA+aVSgF0BCQhSQEUApApSQNMAp6tSgLkAtq5SgOEAeKxQgLgANQRPQO8APLJKQIEAUwRHQOsAtlBFgGABF2c9QDYAbgs5gNQAEgY5QFEAHwk4AD4BEw8yADwASwouAAQAhmYqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(832, 'EMP-401', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAgAAz/v8AAAD8AUQAxADEAQAAAFYQgJ4AlbJXQD8AS1hWQMoAbFRWQGsA2F9WQKMAv1hVQDoAr1xVQE8A2wRTQFUAMlFQQFoAVlhQQGYAnlhQQIMAWVJMQJkAMVJEgGwAN65BQK4A8Vw3gCQA0GA2AMAAU1UzAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(104, 'EMP-100', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAApAAz/v8AAAD8AUQAxADEAQAAAFYWQNoA/qtfQJ4A41ZegGgAp1ZXQOEA4K5XQH4AZ0tTQFYAPE1SQJkAoFJRQIgBKGRRQDcAWVRQQL4Ac01QQN0A0FJQQBQAiVxPQLQAgKtNQJkAhVFGgB0AqWVGgOcA1k4+QCYA8WY8QFwAblA7QOcAalI6gFoBBwQ2AFoBDmU1APEA5k8vAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(20, 'EMP-419', 2, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABCgAz/v8AAAD8AUQAxADEAQAAAFYngCQAlH5bQLIAYaJWQEIAfnpUQDUAu4tUgM8AXKBTQEUAxpRTgIgASwRSQM8A0nhSQK0AdJRRQHUAPhBQgLQAN6lPQHIA81dMgO0AsIlJgKMAo3ZIgOEA14NHQDUAg31HgM8AoIxGQMUAp4dFQIcAlndDQNkA3XhBgMAA7XFBQJIAeZ4+gGsAoak9QHUA3gg9QGYA6LI8gI0Axl88gHgA5Ek7QDcAZnQ6QLQAtXg6QGUA7kc5QLABFGk2ADoAfoE0ANQA7B00ADEAZhcyAGcAuaswAG4BE1EwANYA8yUvAIMAnRsrANAA+R4qAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1114, 'EMP-764', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAyAAz/v8AAAD8AUQAxADEAQAAAFYcQIcAigBbgEsAvWBagD4AsAVZgGcA4V9XgEIA9ghXgHcA+65WgCEBCWRWgHMAKgZWQEYATAhVQJwARQVUQHwATAZUgNcAwqlTQFoAywJTgL8AbqtTQM8AQ1pSgO0AhlBSQGABHgBRQHIAbgVPgMMAImBNQGAAcmJNQNMANa5GgGwAFQtEgL0AIGBAQAsAbAk+gOsA+U42AAIAo2QzAO0A8qkwAGsBL64rAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1146, 'EMP-767', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAwgAz/v8AAAD8AUQAxADEAQAAAFYbQG4A81VfQMMAlk1ZQI0A7FRZgEwBCWVZQGcAXU1XgDUAb1JWQDAAilVWgJYAu1VWQFEA569WgH8BHqdWQMAAbktWgDYA7mNUQIwAUqVUgGcAOEpTQFoA2FhTgD8AxFxSQGMBEV5QQH8AtqpNQHIApFBNQAsApF5MQCAA2gBMQDcBAgRKQEUBDgZFQBoAywJCQLkA/6dBAB8AXVI0AAIAp14sAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(28, 'EMP-423', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABFgAz/v8AAAD8AUQAxADEAQAAAFYpQHkA0qddQDsASGNaQCYAbWxWQHwAXwBWgCYAwHVVQIkAtVRUQHwApa9TQEIA83dSQGAAzQhQQKoAvU9PgIwAGlxOQJ4A9FBNQIkAQ1xNgJMA2lJNgL4ARqtMQIkAma5MQHsAHwJMQF8AvGpMQGUA3QJLQCsAmW5KQMwAr05KQJ4AualJgK0A401JQKAA/1BIQG0BAglHQFIApw9HQKkAV1hGQKUBEaRGQHsAtAFFQGAAoGdEQI4BJFQ+QIcA+VY9gAsAjhY8gKgA5qc8gE8BGh88QKMA+aM5QGEAEls4QG0BFQI2AK4AT6Y0AIEA+actALQAT1YqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(29, 'EMP-423', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAqgAz/v8AAAD8AUQAxADEAQAAAFYXQNMA7J5VQIgAoGJSQK8Au6JOQOQA0kZKQLQA0VZIQOEAvEdHQH4A9AtCQHUAgwVCQNkAjaFBQNsAzJ49gCsAv208QJMA8QU5QG4Aywo5QOoAxaA1AHkA62g0AIcA9gQ0ACMA62MxAJkA+V8wAKMBA1QuAOYA4aEsALkALbIqAKAA/lwqAIkA8bAqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(32, 'EMP-408', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAvAAz/v8AAAD8AUQAxADEAQAAAFYagL8Ag0tfgCsANlJdQEIAt2BbQHIAeVJaQFoAzF5agIEAJEhYgL4A6FFYQGwAK01XgEYAU1RXQGsAsVpXgCgAalhWQI4BK1lVQLIAN6lUQEgA0AdSgGwAPU9RgHUBGmdRgCMAhl5QQHUA0F9PQGsA9GNPQGYAvwBNgG0AY1RIQOcAhlBHgGcAaKlFQH4BK2dCgDQAq2A8AHgBNgUpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(33, 'EMP-408', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA2gAz/v8AAAD8AUQAxADEAQAAAFYfQIwBAqBYQLYA3aVXgIMARglWQIMBG5lWQK8ATQhWQEUAY2RVQFIA+wJVQJwA/KJVQDEAmwtVgKMAia9UQCgAwmdUQMwAdLJRQG0AbAhRgM8AOwlPQFoAygJPQGsAggROQDwA3QZMQFoBEWVKQCoBGW5KgFcAwGJJgFAASwtHgD4A5mNGQEYAxAVGQFYBIFlFQEwBIgZDgF0BGqI9AEgBJWUzAOYBBaAwAOwA16MsAG4BM0gsAD4BKBEoAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1775, 'EMP-906', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAngAz/v8AAAD8AUQAxADEAQAAAFYVgIMAwmdeQKkAnlZaQFUAkGlZgCsAwnBZgJYAPlpXQEUAxXVTgGAAfAZTgOAAtKJTQFwAaGJSgF8BD39SQEwAsAtRQHkA/xdKQDUAUmNDQKAAMVhDgLUBB5ZCQJwADlVAgIYBAn09gJkANVg5gDQAV2A3QJIBFJI3ACAA0XIsAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1822, 'EMP-1038', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAqgAz/v8AAAD8AUQAxADEAQAAAFYXQCoAgLBkgBkAm2RhQA0AxAhbQD8Ac1hbQKUAb0tYQFAAilZYgGAA01JVQLYAgkpTQDoBCWVSQK0AyEZSgM8AQk1RQHkAFUxQgK4A/kBQgEwBI1xQQFgAIlBQQEwAIKxPgFgBL1pOgMMATaZNQJ4BCUdMQDAA+WVMgLQAfKBBQCkAIlRAQNsBGkQ/AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1182, 'EMP-800', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZQEgAllpaQC8A7GtZgIkBMGdWQBMAxmdVQGMA7WBUQJYBGVZRQFoAu19QQHwBFK5QQEEBInpOQFIAf1xMQJkBKVRLgEEAf7FKQMsAgFJKgLUBE09KQJ0AlK9IgCQAMFRIQHcASVVHQMAAbadHQNQAdE1GQCkBLnw+QGwAdK48QLsAWVE3QO8A+6Y2QBAA/G02AAsA9Gw0AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(70, 'EMP-464', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZQEYAfFJdQHUAc01bgKkAp09ZQEEA/mRXgHIAQkhVQIcARkZVQJ0AzFJUQEUAiVpUQBkAeFhTQDYArWJTQAsAqmJSQMMAaKVSQDUATU1RgDAAbVJRQG0BCQBQQFUAxl5PgNEAnk1PQCoAtwVOgCEAZk9LQNkAlaZGgNAAhktDQKgBCVQ7AIYBI64qALUBD6YpAKQAO0goAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(71, 'EMP-464', 2, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABOgAz/v8AAAD8AUQAxADEAQAAAFYvQCEAo3FiQIwBKYZiQH8AOGJgQLAAqk9eQIkAWF9ZgJkBE41YQHgASQRVgIwA7Z5VQJ4AxaRVQNEAGrBUgHkAGwZUQLkA555UQFoAgghUQBoA8n1UQF8AQghTgDQA5n1TQNEAuaJSQMAAj6dRQFEBARlRgN0A60dQgNMAfFRQQJ4Ar1pQgGMAtAZQQKAApaxPgG4A0wRPgG4A8QRPQEQBAyBPQOQAZKRPgEoA3XlOQCoA0xlMgG4AxQVLgGsBKnVLgFUA5ntKgFIBDhdKQK0AHwBIgGwBCW9HQMoAPapHgOQA4ZpGgHIBFHFFQEIBHStDQIcBDYlAgJIBM4c/QHsBG3w+QGEBFxc8QHkBMig4AE8BIBc0AH8BMycuAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(82, 'EMP-110', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABpgAz/v8AAAD8AUQAxADEAQAAAFZBQEsATVFagCMAnWlWgKMA7nxWQHsAckxVgH8Aip5UQMUAhk9UQNcA9otRQKQAyo9RgIEAoURPQM8AwJhPgFUA6wBOgDwA7KJOQIEAPU9NQI8AvY1NgD4AqmBMQE8APKdMQHcBAwtMgMYA9n5LQEIA1qlKgDcAXVVJQK8Aqz9JgGUAsEtJgA8AzIdIQFIA5ABIQK8Av5RHQFoAYadHQKUAsJlFQGMAuZRFgJ4AY0REQI0AMk1DgOcA7JJDQLgAoJ5BQF0BJa5BQLsAN05AQF0A2E9AQHsAp58/QGgAqZ4/QBQA+5c/QKkAcks+QJcAV54+QDcAZFg9QC8A0Jk7QGcAykQ7gK8AeqU6QA4At4I5QGwApEs3QKIAbKU3gAgAoWg3QO8AzD42QOoBCI02QNYAf6A1AKQAL6sxAHIA+BYxAHEA7V4wAFIA01EvADsAyKovAFEAyFIuAPIAtpwtAFoA0kktAM8A8jgtAGsA4VUsADYAxKosAF0AtUYrAJcAIFMqAAgA2C4qAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(83, 'EMP-110', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABZAAz/v8AAAD8AUQAxADEAQAAAFY2QKAA9HhfgEsA80hagJcAJmNUgI8AWQZUQDoAinVUQI8ATWVSQCkA0pJRQK4AhqdQQK4AlKJQQKoAwolQQL8A2IFPQGMAo3lPQCAAt35PgKIApJ5OQJIAPgpOQG4AiQtOgJkAxn1NQHcA1mRMQMwA24tMgFIATAtLQEoAoBdLgIwA83NKQDYASWxHgDsAtIdFQFgA8l5FgGcArQ9EQKAAxDJDQHIAvW5DgI8ARQhCQNcAlp5CgOUA0JBBgGAAvBJBQH8A5GhBQCQA5pRBQF0A/mBBQF8BEWFAQJIAjQA+QO8Ayjs9QOUAg6Y8gHwAwGk7QJ4Av5I6QAgAwHY6gHUAwmw6gFgA61o5QEQA7gY1AIkAHAoyADoBFQUxAIwAvCgxADAA1zEwAD8BFwYvACYA86wuADcA9LItAOsAv5ktAO8A2zopAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(102, 'EMP-109', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAmAAz/v8AAAD8AUQAxADEAQAAAFYUgDwAYWdfgMAAtk9eQH4A0KxZgOcAoKVYQKUAeKxYQMkAUVVXQGYAXQhVgJIAq6xVQFoAoAhTQEwAUg1SgGMAgghSgE8A6w1RQHEAuwVPgNEA2J5PgKAA9phPgMAAKq5NQMwA7phLgCoAtBJCQHMA/qNBQGcBDqI9AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(103, 'EMP-109', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZgJoBCGJkQDAAo2lkQIwA3l5hgI8AMbBggJkAHFJeQIIAg1ZeQI8Ar1ZbgDsAIU5bQK4AZ1JZQFwAYVZYQDQAUlZXgH4ANlJWQJ0BIm5WQL8BKF5OgCAAtw9MQDEAeGBMQMYAxVVLgMUBA1VKgDcAfgJGQLIA+VZEQLkBOFxBQL8BAlY/QK0AD7A2gEUBF3Q2ACsAMU81AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1416, 'EMP-889', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAsAAz/v8AAAD8AUQAxADEAQAAAFYYQDcAoVpggGgAilVdgFgAZlRaQFIA5mBaQIgA9F9aQLQAhVVagEgAv15ZgCoAilVZgEQBE2dZQJwAyFpXQIYBKGlWgIYAS1RSQGcAUa5MgEEAXE1MQFEAPk5FgEIAU09CQC4AbK86QDUAdbA4QEEAdVM3ADQAX6ozACsAX08wADEAb08sADEAS00qAHkBAmAqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1520, 'EMP-931', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAngAz/v8AAAD8AUQAxADEAQAAAFYVgGUAXlphgEgAg2JhgIYAMlBbQEgAngZbQH8AU1JZQL0Au1BZgMMA3k9YQJwA56xYgNEAeKlXQI4AflZVgJIA3l5VQEYAt2pUQEUBD3hRQMMA8lJRQMYAnlBQgD8ANVRLgN0AbVFGgJQA9GNGgK8BK1U2AJ4BMwwrAKgBKlsqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(27, 'EMP-422', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABEAAz/v8AAAD8AUQAxADEAQAAAFYoQH8AJmVhQDAAj2lhQHkA7VxhgIIAdWBcQHEA3alZgGUAPg1ZgFwAfwZYQLAAg6lYgK0ANrBYQGMAaghYQJkBI5lYQFEANmlXQDQA0w1XQDsAoQ1WgHcA/qJWQGAA8rJVQNEAzEtUQC4A8w9UQDoA+wtUQCEAUQ9TQFcAWAtTQKQAIgJSQMYA46JRQM8BB5xRQN0AuaRPQFcBCKtNQN8AqahLQNEAoU1KQGsAJwpJgA8A9nFJQDoBIAZHQNYA26JFgA0Af2lAQIEBDU9AQB0BIhQ7gI0BGkQ7gNsA8Ug4QEEBJAI3AGUBM1YvAAgAihAsAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(58, 'EMP-458', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABRgAz/v8AAAD8AUQAxADEAQAAAFYxgIEAq4hcQHUAaGtagKQATV9RQJoAYV5RgMMAvDxQgGMAp3xPgIMAvDVPgJcA9ptNQGsAgHZHQJwA9phGgI8AuZZGQLAAuZtFgLsAiKVFQFwAQmdCgM8AgklCQHsAlYNBQIwAr5RBQNkApE5BQMYAkFBAgIEAT2U/QHkAV2o/QL8AtJg/QG4AbRI8gGwAkII8QHEAoIc6QNcAq0Q5QGEAino4QMMA5D84QJIAXQA3gGAAX3M3gNMAcqg3gNkAXKc2QGgAZnA1AIkASGA0AGwAhhs0AGcAoCEyANEA1p0yAFEASRAxAMAAqU8xAL8AlaQwANcAoFAwAE8AbGkvANYAsaAuAMYAqksuALkAQk8tAMsA3UEtAH4AQwcsAL8A65srAFYAoHgpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(59, 'EMP-458', 8, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAqgAz/v8AAAD8AUQAxADEAQAAAFYXgNYAp5ZaQL4AeKpWQFIAlBZUgH4A03dTgFoA8nRSgK0A8npSgM8A/ChQgI4A1ndPQGABCB5OQFIAenFNgKUAmqlLQIwAmghKQFoA43NKgHgAZgtIQL0AyIlIQKUAsZRCQNYA4IJCgNEA1o8/QJcA53o8gJ4AtZI4AFAA+Xc0AMsA8SswAKUAu1wpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(62, 'EMP-460', 8, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABcAAz/v8AAAD8AUQAxADEAQAAAFY4gHMASWVigCoAfm5hQJkAU15egHkAfq9aQFoAxahagB8Ar3dZQMAAwJZXgJYAjaRXQKQAdKRWgMoAeaVVgHgA7jVVgLAAkE1VgJoBCoFTQJcArZZSQLYAPqpQQEIAuQ9QgFAAvQVPgHsAYQROgGMAqQROQCoA3QJOQNQAbqJMQMAAip5MQOAAv5lMgBkAtxlKQMAA8Y9JgCMAxh5IQFoAcgZHgDAAmRJHQMQA5pJHgIYAzTxFQMUA8o1FQH8A05FEQCEA0gZDgGEAUwtCQOAAhkk9QM8AeqA8QMoAg6E8gHIAy1Q7QA4AqXc6QM8AiqA5gDwApxE3gDAAuxM3AC8AwBA0AMwA+Yw0AD4A/mc0AFEA8ak0AEIA+WIzABQAwngzAGsA0o8yAMsA9I0yAHEA2kEyAOwAqaExABcA5wYwAM8A6z0sAF0A6I8qAGsA2qMpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(63, 'EMP-460', 2, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABHAAz/v8AAAD8AUQAxADEAQAAAFYqQDYAQmxdgIwAbUhdgG4Ac2VZQGUAt51UQEQATWtSQLUAeY5RgH4AclJQQCEAq5FQgMkAbZJPQD8A5j5PQFwAMFpPgEUAdYNOQF8AoTNNQJIAMJ5MQFIAiJJMQCsAoJBMQEwAlJRLgJMAkIFKQD8AsZlKQCYAbH9JQGsAoKJIgNcAbZZHgGsAY1xDgHgAtkpBQEUA7UZAQHEAXKE/QDwASwI/QGsAUVQ/gJwAmXw+QLsAjTc7QFgAIVM6QJ4Aq346gHMAfGU3gKMAr3w2AJQAni81AJ4AoYM1ANoAepkyAI4AmjMuAJkAqYEtAI0AgE0tAHwAsKIqAGsAhZYpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(66, 'EMP-462', 7, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABRgAz/v8AAAD8AUQAxADEAQAAAFYxQNMAzJ5gQJcAaFldQDQAhW1bQMYAS1VZQMQAeaxZQNEA7JRZgI8AgmNZQLUBHolYQNQAlKdYgIYAigVXQHkAoAVXQLsAX69WQEEA+xxVQJwBFYNVQE8AuQ1UgC4BASJUQGMBE3hUgGwAUgZRQIgA64FQQI8BF39QQLQAzZ5PQGgA03NPQIEAagJNgJ0AyJ5MQHcA9HhMQEUAtXFLgNQA8pdLQH4BIHxKQK4AkKtJQLkA6JRIQKkA+4lIQM8BB5FHQIcAyKJHQK8Ay6NGQI0A2JJFgMwBD5JFgHkBInpEQHMBHnxEgH4AxbJCgIwA5Is/QLsAo6k9gCYBCCc8QJMAxKc5QHUBCnw1AIkAFwQzAAgAdG0yADEBHXgsAHMA3rErALAA7jooAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(67, 'EMP-462', 2, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABuAAz/v8AAAD8AUQAxADEAQAAAFZEQKoAdFRdQGgA0I1cQMQAtURaQNMAlUdaQEoAKmJZQH4AS1hYQNoAdJ5YQDwASF9YQMkATKRXQDsAXmdWQHgA2JJWgLUAwERVQJQA45lUQDcAmXFUgEgAnXVUQB0AzIFUQG0ANV5TQGgAkHRTQCMAmnVSgMMAv55RgLUA50BRQDoALQdQQEYAvIFQgF0Ay4JQgNMA0URPQGYAQgBNQDsA/49NQHcAvZBLQCkAPQVKQFUAZwdKgKQAsJ5KQEwANwRJQFUA0YlJQEsAhWxIQOwA1jpIQKoAy5lIQE8AlXFHgEYAcmlHgI8AiqlGgI0AyptGgJcAxJtGQCEApBRFQIMAt5RFgFUAlXlEQI8AeaxDgJ4BIpZDQNoBF0ZCQEUBIDVCgIgAZ7BAQHEAc2RAQIIAeWBAQKQBKZg/gDEAqXU+QHcAlnU9QF0Ak3c6QFYAbRM5gL8A7D84QFwAZGE4gGAAeWU4gIEAZK83gIEAjqU3QH8AlKc2QEIA0IU2QLgBK581AGUAaAg1AFcAdWkzAHwAf64zAIEA45YyAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(84, 'EMP-102', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA4AAz/v8AAAD8AUQAxADEAQAAAFYggDUApGRgQCYAIFJdQHwAwlxdQDUAU1pbQFwAiLJbQK8AylVbQNsAeFRagGwAQVRZgDYAym5ZgIkALVJYQHEAhmBYgFwAG1JYgBkA9nRYgEwBLntXQIIAXVhVgBAAsAtVQDAAY19VQH4A4WBUgMoAm1RUQIcAtFpTQIkA9mNRgK8BB6RQgNYA86RLgIwBF25LQEYAwAVKQOEAzaVEgIYBMgZBQNkA+6VAQN0AOFI+AIkBKwIwAJwAEKswAOcAzKYsAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(85, 'EMP-102', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA5gAz/v8AAAD8AUQAxADEAQAAAFYhgC8A63NhgMsA07BagFoAuWtYQF0AFhRXQI0AeAlXQJMAigZWQJIANwlUgCMA/xtUgEgAdQ5SgKkAIWVSQLkAJAhRgL8A+6VRgKgBImBRQIYAJAtRgNQAmVpRQGMAxgtQQI0A7ghQgKIBDwBPgLUBF6BOQHwAtWhNgPEAua5LgMUA+adKQEwAOw1JgB8AMmdIQJIBJQRBgEEAHBM/QNkAXFw+gHkAqwg9gPIA1607gG4BGw87QJcBFQg5QPIAzFU2AHEBNWcqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(88, 'EMP-111', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABCgAz/v8AAAD8AUQAxADEAQAAAFYnQGcAy0FdQFcAeFRcQCYAXa9ZQCoAcmVZQLUAXptXgJMAy0NWgMkA60lWgIYA80ZWQFUASVRTQJ0A3aNSQHsAc0NNgFAAwJtKQEgAwj9KQEsA8URIQHMAbUlHQFAAtkRHQOQA2kZHQEUAY1ZGgHwAG6VEQDQAlnNCgDUAowNCgEoAmVpBgHMBE6VAQH8AFEpAQIkBGU9AgF8AvZ4/QFEAml88QAgAb2Q6QEoAo2I6QEgAsKM6QEQAvJY5AAsAsHovADsAoXUvAEUAqp0uADsAtZguAAkAuS4tAAgAfmYsAAkAj20rAAkAoHUoAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(96, 'EMP-106', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABHAAz/v8AAAD8AUQAxADEAQAAAFYqQCkAtWlkgEgAr2dfQFgAT1pcgD4Aj2BaQIkAoVhZQF0A2HFXQIMAblhUQMoAxkZRgIYAo1pRQKAAMVZQQGEAtmhQQLsAjlFPQGcAXl5OgG0BHohOQK8A0E1LQKUA0lBLQNcAiaFLQDEAbAVJQLQA5ktGQL4A20VFQGAAWVxEQKABCqVDQHUA4XRCQIwA7m1BgHwBIpJBgIkBHZVAQLAA3U84gIgA5m42AIMA6G40AL4A4UgzAM8AWawyANQA7TMyAMUA9EsxANYBBSMxAN0A5n0wAOsAp54uALgBGqUsAO8A4I8rAMwBDbMrAOsAxZsrAOwAtZ0qAOwA2pIpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(97, 'EMP-106', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA2gAz/v8AAAD8AUQAxADEAQAAAFYfgEUAow9eQI0AoV5dQJIArQBcQFwApQtbQMAA8p5bgCAA4RpaQNcA3aBZQEwANQ9ZQEIAWGpWgGMAmmlWQJkAdVtWQGUAlWlVgKAA7qBTQD4A+xdTgFIBARRSgCsAZxFRQIkAeAVRQF8BCgtRQC4ARgtQQLUAQQBPgJMAXAJMgCgBBxxLgHwAmgBKQK8AKAhJgKQAzKlIgJQAwKxGQGEAXQtEgA4AwHE/gIEBFKE8QEwAeWo7ABQAcmkuAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(98, 'EMP-113', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABKAAz/v8AAAD8AUQAxADEAQAAAFYsQHwAaHhgQGEAT3FfgGYAZBFeQI0AK2BeQDQATHRbQFUAuYxaQHgA8T9YQFcAyjZXgEsBDkFWQNMAZ1BVgKgAt6dUQMwA+VJUgMUAN6dUQOYAqgFUgIEAUmtTQGsBA0RTQHgAF2BTQBQAgoFRQEoApIFRQJ0A8kNQQLQA9qpQQLUAyqlPgDYAtotOQGwAuZROQKgA0aROQH4AiRhOQGwAHAhNgMMAyExNQMQAva9LgM8AfFRKQHsAmpBIQH4AjxdFQHEAghpEgLIAjl5DQHcAo5A8AK8Ak64zAPIApF4wAJMAnZkvAG4AmyUtAIEAoZUtAGgAD2QsAO0Aj1gsAAsA0y0sAIkAlQkpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(262, 'EMP-484', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZgGgAUlJfQEQAMVBcQD8A2mVcQHsAy1ZZQBkAo15WgK0BE0hTQIwAZ1JTQCkAWFhSQEYBF3lSgDQA/21QQJkBE0tPgMUAZLJPQM8AealNQMkATVRKQDQAxGBKQDAAtgJCQMwAZ65AQLkA5549QL4A46M4gH8BK2A4gD8AEE44AJIBKE4zAMQBJKAyANEAL1QvAJQAElAqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1574, 'EMP-946', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAvAAz/v8AAAD8AUQAxADEAQAAAFYaQJMA8QBiQN8AwlRXQEQAwA1XQGwA4AZXgC4Ahg1WgNYAWalVQJwAT2NTgF0BMAVSQBUApw1RQGwAIQpRQHIAq2VRQOsAsU9RQEoALQ1QQIYAXAhQQKgAoK9PQDUA6A1PQKIAj19LQJYAImJKQNkAO65KQBMA42hDQJIAJAhBgB0A4Ws/QK0AFAY6QLQAEls3AMkAFbExAPEAiqkrAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(313, 'EMP-451', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAvAAz/v8AAAD8AUQAxADEAQAAAFYaQHIAt1hfQJMAlVBbQJkA+URaQK4AgqNZQGUAZldYQMUAzJdWQJ4APKdSQHEAxaxSQMoA9I1SQH4AykxRQDwAPK1QQOQAgKJQgFUA6GBLQIgA40VLQHsApVFJQL0A8YlIQHIAo6tHQEUASVZGQEgAPVZFgI0BHbJDQHgBG6RBQH8BHk9BgEEAQbA+QPEA3pg8QEoBFHU7AKUBDk80AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(38, 'EMP-430', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABIgAz/v8AAAD8AUQAxADEAQAAAFYrQDwAPmVggGAAbWNbQHMAf2JaQJ4AY1FYQFcAv39XQF8AMVhVQIcAvaBSgMoArUdSQHIAzJZSgEgA+URRQNcAoJ5QQEgA3S9MQH4AxplMQN8Ahp5LQLsAnURLQKMAnkZLQIEAqqNLQKMAr0pKQMsAyk1KQKkAxUlJQH8A+ERJQLsAlZZIQGgAk25GQIIAjatFQGEAxopEQHkA/kc+QGYA0jo9QB0AtHw9gHkAhmU8QIcAQlI2AGAA0ZczAMQA9FIyAJMAMk4yAGwAu5IxAHMA4UQwAHMAkAQvAH4A80YuACgA55gtAMkA0assAMoA5qkrAHMAtKArAIIAMk0qAOsAlEApAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(39, 'EMP-430', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA/gAz/v8AAAD8AUQAxADEAQAAAFYlQNcAgj9gQMkAxolgQKgAXZhcQIcAUZ5bQCoA4RFYQGcA3nFXgMsAjpZWQMUAqZBVgNYAwo5VQIEA4B5VQLQAQp5TgNkAxo9TgFUA4xdSQFAAOwZRQLsAf5FRQFgATwJNQLIAtYNNQEYA4WpNQJQAlolMQDEAiBBKgKgAxSlKgKkAq4dHQEEAcxRGgEQAZghFgE8ApW5FgBsAihlEQFIArxlDQC4Ay2xDQGgAq3U7gEwAcwU5QCkAyA85QF8Ag2k3QF8ApHM1AHwAJKs0AGwAg40wAOwAb5svANsA2o8rAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(42, 'EMP-433', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA2gAz/v8AAAD8AUQAxADEAQAAAFYfgBMAyHRcgMAA0kZbQBMBCnVZQHMAbq9YQCEBGnVYgDQAtRJSgHMASQJRQIMAglhRgKQAhahOgJwAQ6lOgIcBF1xNgG4AxgZMgH4AxFhLgDwBKBlIgEQAPQtIQF0A9gpHgHEApGdFgK0AblFEQKQAclRDgJIBLlZCQLIAK6w9QJQBIJs7QJ0BK6E6QI4BIk04gG4BKQA2AAIAdWs0ACoAFg80AAIAXGYyAGMBMxEvAJwAcq4uAO8Ao0QrAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(43, 'EMP-433', 2, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAsAAz/v8AAAD8AUQAxADEAQAAAFYYgFEARlpeQK0AkEtWQLQAU6dVgHMAsVJVQE8AgwBUgDQA4QxSgFYAoKxQgDcAjWVOgDcATwRNQDsA13BIgD4AxAREgKkAyJ5EQB8A5xdCQG0BFVpBgL0ALU09QK8A1kg9gF0BBV45gEIBBQI4gEsBJAQ3QKgA0J42AFUBHmc1AAgAZGkzAAgAbWkyAFcBF6UyAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1644, 'EMP-884', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAngAz/v8AAAD8AUQAxADEAQAAAFYVQJQAT2RaQEQBEW1RQHwAxARRQG4A0mRRQN8AYwJPQIMBKwJPQH4AVwtOQGYA8gZOQFwAfglNQIgBGmJLQIMAb2RKQL0AKwdJQHIBIwtGQC8BIBNGgCoBKWZEQJMAXwhCQMwAsLBBQJ0AiAU+gDEAqgs6QDoA6w01AFUARgsxAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1645, 'EMP-884', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAYgAz/v8AAAD8AUQAxADEAQAAAFYLgHkBFVxXQIcASE1OQL4AWU1OQL0AkE1NQKQAbqdMQFEBAwZLQHcA01pJQHwAbVRJQIYAp1RJQCkAblY+AA8AwGQuAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1830, 'EMP-1041', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAsAAz/v8AAAD8AUQAxADEAQAAAFYYQEQBD7BkQH8A5lJgQDAA/l9dQFYA81pbQKkBIqBaQHkAzKlZQHsBKlJXQL4BBU1UQF0Alk9TQB8A1lxTQDYAg1hQQHgBE1JQQMwBHaJQQGsBAatPQBoAtl9NgJ4ApKlJgFIAk6lGQG4AdVA+QOcAsKc9ALUAMFE1AA4AzAAzAD4ARU0uAA4AxV8uAG4AUlQrAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(60, 'EMP-459', 8, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA7AAz/v8AAAD8AUQAxADEAQAAAFYiQF0AuVJkQI4BCE1gQMQBAkRgQLIAjUtfQFwAUU1bQIwBIk1aQKAAy6VaQHIAzKZaQOUAtUdYQDQAyGBYQG4AQkpYQE8BG1xXQEEAkFVXQN0A+6FWQD4A865WQOoA0klUQNAAikpSQD4AaE1RQLgA0k1RQEYBAVRQQGsBF6ZQgKIAXk1QQEQAJ6NOQMsAmaNOgEUAkFFNQOsAektKQNMAXUdJgJcAXqdJQDcBAQFHQB0AfFQ+QJ0AXlA8gLkAIk05QBcAgFY3AGgBL00qAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(61, 'EMP-459', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA7AAz/v8AAAD8AUQAxADEAQAAAFYiQL8BFJtfQFwAgA9bgCoAghFagKIAVgZagNoAPQZYQIIAQg5YgFIAlW5YQEwAXRFXQJ0A9F5XQDUBAhxVQCoAvG5VQOEAVq5UQL4BAZ5UgL8ASAZUQJMAowJSQEUA7nFSgHMA7QZSQMsAtlRRQGsBCQtRQGEAyw1PQI8BCaVMgH8AfwtLQHkALxFLgJMBI6BKgGAA7BFKQH8ALQ9JgKoBFZZJgKoAsa89QH8BD6k9gHUBKQE4gNMBG0Q3AH4BIp40AOABD5szAPIAvaYsAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(64, 'EMP-461', 8, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA4AAz/v8AAAD8AUQAxADEAQAAAFYgQEoAjnNYQGsAwG5TQEwAzBdQQNEBEZdOQLUAyKZNgI8BLoBKQLsAoalKQJcBAVVKQDYAsBlJQEQBD3xJQGYA6BFIQJIA1gJIgJcBHoNCQKgBD5pBQLsBIj0/gG4BBRk+QFoAag89QNMAZ608QO0BDZg7QI4AHAQ7QFwBFXo6QI8A8qk6gHwA83I5gIgApQU4QLYBCUY3gMABDpQ1ANoAY1g1ANMBKJY0AJoA06szALIBAZ8yAK8BEY0uAJwBFT8sAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(65, 'EMP-461', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABHAAz/v8AAAD8AUQAxADEAQAAAFYqQK8A3ktgQJIAPUlZQL8A+EhZQJMAlU9SgGMAyFpRQEwBHltRQB8AwmJPQJcAhaRPQGMAvaxPQEUAb15OQJMA+6BOQKQAjUxNQEEAblxLQC8AsQVLQKoA+aNLQCkAgABKQB0Ag19KQEoAoFxJQFgAoVZJQBAAt2JJQK8A7KFJgHwBG0pIQIgALaJHQMoA0aRHQIwAf1FHQFEAPFRGQMkA4J9GQEoAyABFgGMAbKpEQMMBCklEQGUAYVVCQIYBGaFAQIwBHUg7QA4AhgY7QEUBIAc4gG0BFak1ANEA00s1ANEA8U0xANMA/KIwAJMBJJ8uAAgAiAUqANkA4EYpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(90, 'EMP-104', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA2gAz/v8AAAD8AUQAxADEAQAAAFYfQIgAeABkQNMAnUBhQMYAkKBcgBoA5nhaQJoAeFZZQMMAfqJUgHwAOGBTgI4AhqtTgDwA7HxTQMsAg0hSQHkA3nxSQGsA4XpSQLkAo5ZRQOYA2IxQQHcAtGpOQHsAlVxNgNMA0YtNgLQA2otMQHkAMABKgEQA+XlKQFEAQwZIQFcA53tIQEgAjwxHgHMAqgJGgDoA/CFDgJQApFpBQJoA9oJBgI4Apak+APIAyjgzAHkA0nssAOYANakpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(91, 'EMP-104', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAyAAz/v8AAAD8AUQAxADEAQAAAFYcQCoAXVlkQIkA2FBgQFoAxgJdQDwA8XlbQC4AoGdaQI4AqlJZgIwA/phVgEUBB3xVQDwAympVQF0A4GVTQIkAY61SQJ0A2KBSQCMAqQlSQD4AKlZQgKIAb6pQQLsAzU1PgGsBCphKQIgAhVFKgIgAf1JHgF0AlVZEQJ0AaE9CQF8Aj61CQK0AXVQ/gGMAjlY+QFgBFI08gKQAZKo5AFIAH64yAFoA+6cuAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(94, 'EMP-114', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABOgAz/v8AAAD8AUQAxADEAQAAAFYvQCEAZF9kQBAAV1thgI8Ag01ggLUAU0tfQGsAmaRcgFUAglZbQEsA3WVbQIcALUtagGMA/FZZQDUBCINZQFAANlBZQJQAT6VWQFgAsFhVQKIAoKNVQHsAPU1TgCoAu2pTQDUAJE1TQFEAclRTQJkAdaNSgDsATVJSgAsAcmJSQNAA1ppQQIgBCD9QQNcAqUZPQKAA4EFMQGEA6FhLQK4A85RLgHwAaE1LQLkAeE1LQKkBGpBBQEgA63NAQHgAY0s/QJcBHjU9gMAAdEs7gAkAoGY7gAgAj2U4gGgBHqI2QL8BIpQ2AF0BGY80AJ0BGYczAOYA0EQwAKQA25owAFgBB38wAAIAUQEvAAcAqmYvAOwAeaUtAAQAhmcrAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(339, 'EMP-574', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZgKAAv6VZQDsAMA1VQIEAigJUgFgA5A9TQIMAal5TQEwAuw9RgH4AygBRQHIAbAhQQHgAUmNPgI8A2qBPQHkA66JOQOUAp0pNgIkA9lhMQFUBBxdKQNoA3ppKQNAAnVJJQNoAoaREgGsAMWRBQKMBD5Y9gJwBCpY6AGMBHWwxAI0BHZYsAPEA554sAPEAxp8qAHkBG5sqAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1012, 'EMP-441', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAdAAz/v8AAAD8AUQAxADEAQAAAFYOQJQAX1JiQHIAoVZiQI0AMlBfQC8ATVxWgL0AyqRTgLIAiFFQQDcAGlFPQDcAKlJEgG0AzK5CgDUAElFCQLQAzU1BQMAAY00/gLYA0k89AL8AZ000AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(806, 'EMP-453', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZQKIA6H5ZQJwBCiJWgLkA2oFSQI4Au3xOQLUAlZhNQIEAqnpLgLAAeE1KQGMAbA1HgK8Aj6FHgMYAYaBGgGgAbQhEgJ0AdatEgOEAqTpAQNEAY6I+QKgAnpE+QJwAeqo+QGUAY249QMMAS6U4gMYAXZ44QJQAqYM3gKAAiF42ADAAaGg0AM8Aqos0AMMApz8xACsAZmsuAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(807, 'EMP-453', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZQG4AelxiQDAAg2dWgKkAnVZUQHEAzHVSQEUAo3FRQIwAzG5RgIIBDo1PQLQAjlZPQJYAlqlPQJQAvWBOQDoAY2ROgHMBA4RLgI0AsalGQFAAeAREgKAA649DQJoAkKpAgJ0A3Z8+QKQAk6c8QIwA3n08QI0A64c5gEIAtRI4gKkA0543QOUAjqY3AKoAk6ozALYA0J4xAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1650, 'EMP-978', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAtgAz/v8AAAD8AUQAxADEAQAAAFYZQMMAm0xjQH4AgFJjQEIA/2JcQLAAtU1aQI8A51FZQGsBB19ZQMUAakhZQJ4AbUtYQIIAsFJVQFAA019VQHkBF1ZVQKQAQUpUgF0A7F9UgD4AwgBSgJwBFaBRQDQBAwlQQD8A5AROQDsA8wVOQLQBK0dNgFcBFQA+QHwAp6o9gGEBNa46QFYBDgQ5AGMBO7IxAIIBO1UsAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(40, 'EMP-429', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAwgAz/v8AAAD8AUQAxADEAQAAAFYbQFYBD2VkQEIAb1RiQD4A+2VhQHMAsFRfQHUAUk1dQCkAeqxcgHwAhU1bQKgA5k1aQEUBGgRYQBMAWVdXQLIAf0tXQGMANktWQKQAPElWgEQAjVZWgDQAL09VQIkAMEpVQKIAjkxVgHMAfKdTgIgBCU9SgNAA8ktQgFgBImJQQHMAPaVNQBsA7GdNgCEA52VGQOoAikY7gOUAkEs6APEAc6krAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(41, 'EMP-429', 2, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAhgAz/v8AAAD8AUQAxADEAQAAAFYRgMkAygBZQNMA+KVZQHkAYRFYgJYAxQVWQJoA+ARTQJkAsQpRQGsANxJRgEYA3hZQQDwAbRRPgH8AzXFNQLUAbQpNQMsA2q5MQDsAXGxLQL0BHadAQO8AkAE8gHgBKRQ6QH4BGWw4AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(44, 'EMP-432', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA+AAz/v8AAAD8AUQAxADEAQAAAFYkQGAA6GJVQGAAjlZTQFYAvGBTQGYAbVRNgK4Am1JMQDoBB3pJQFEAy6tJQIcA5FBIQFwAhqpHQGAA0VZGQGYAzFxEQFEA0WVEgFgBD4tDQKgAeKpAQFYA0QQ+QLkAeE09QIIA8qQ7QKMAlKc4QK0AiE03gF8A+3o1QHIBDzo1ALAAkKU1AG4ANVAwAGgBDzkwAKoAblAvAHwBCkcvAKkAUqkvALIAf6otAGgBBTwtAKkAjk8sAIgA86IsAGYA/q0sAKMAbKkrAG4BAj4qAGYBGpcqAL8Aj0koAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(45, 'EMP-432', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABfAAz/v8AAAD8AUQAxADEAQAAAFY6gI8Ay3lbQHwBA2tZQJoA+3FYQIEAMmRWgF8AWAtVQOUAzZJVQF0A6ExVgIYAhgRTQK4AmqNTQK4At5JTQIYAX2RSgKQASa5RgKUA14FRgNoAsZtPQHcA7mRPQFIAmhRPgMUA2I1NQI8AlqlMgL0AOLNKgNQAxY9JgDcAvYxHgKkARq9HgHwA7WpHQNcA+XpHQI0AraNFgGcAtw1FgFUA+E1DQG4BA2lCgOEA8o1CQIEAr2dAQCMAy4ZAQJMAr5Y+QDsA86w9gDoAZ248QNkBB388gEQAuYw6QGUAyyA6gE8A2Cs6gNcBAn84gI0AuZE3QNYA1jg3QHMALwU3QNsAxpE3QHIA4R42QNsA7Ic2gIEAtHA1AH4Av3U0AMsA634zAHUBAWwxAGMA0B4xAGsA0HkwAPEAq54wAF8A3bIwAHgAxSAvAO0A0T8tAFEA0DEtAG4A2x4sAGgA13ksAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(50, 'EMP-455', 9, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAA7AAz/v8AAAD8AUQAxADEAQAAAFYiQK8AualcQKkAlQJUQKgAQWNTQLAA45RTQH8BG3FTgEgAy3NTQM8ApKlRgIIAnghQQI8BAnVQQGUBIBRQgK8Ag19QQGAAeGlPgGABChtPQGAA8hpNgJ0AhQhLQHMA8RdKQIMAsQZIgFEBFyNIgHkAbw1HQKoAzaJHQKABHXxGQIgBDx5FQKgAeQJFQIkBCHVDgKQA/n5CgHsBEXFAQIgBLnhAQIwA8nE/gH4A0Ww/QJMAvAA+QIgA2l8+gKQA26M+QOABF4o7gKoA2lU3AAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(51, 'EMP-455', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAmAAz/v8AAAD8AUQAxADEAQAAAFYUQCgAhnhdQEUAp4FbgHgAY2BZgLQAoE1ZQMkA/kZYgF0AvB9WgIEAdWJUQC8AwIdUgKgA0ptRgFoAWWNPQHMAZ2JNgGgAgG5KQKAA0ZVKQH8AqnhHQKQAxUZFgMABBaJFgGEAgAhAQJcAKFI2AIkAKLIvANkBG0cpAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1032, 'EMP-115', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABuAAz/v8AAAFlAYgAxADEAQAAAFZEQGMAdYxaQRcAiYdZQQAAfodXQJwA9GxWQIIA8mVVgOUBIxBVQIkBARBSQF8AqaBSQRABMGhSQKgAk2RQQNQA43FQgOoAKEFMQKkBNg5MgHMAV4dLgQcAV4xLQLAAXn9LQQcBMwpLgGEA83BLQH8AylpKgIEAdJlJQNEAjn1JgGsA11VIQTkA7HdIgLsAjXdIQSEAQpFHQLsAtSFFQP4AmilEQMUAST1EQMQAlH1EQFYA4FlDgFUA5llDgKIBYQRCQIkAwk9CgMMBVgxBQIMAJxc/gH8BGw8/QLYAoXU+gLgAryE+QLgAqh49gMABKA89gOYATIw8gKIAuWk8gNEBZgc8gG4Axkg7QMYBHhI7QTUBYIE6gK0BYgY5QRsBBxc5gL4BQgs5QMUAjXg4QSIBB3U4QIIAoUQ4gEsAxkc4QK8BUGY4QJQAfjM3QGgAygA3gRABSV82QHcAxEY1QFgBOAo1AEoArTw0AT0At4g0AFcA2lY0ALABb7A0AMQBUAszAOsBUQUzAIYBUoUyANoBVmMyAEoAoTkyAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1086, 'EMP-421', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAvAAz/v8AAAD8AUQAxADEAQAAAFYagK8AZK9gQGgAvA1cQFAAp21bQM8Ab1VagMYA5KNZQFgAiGtXQDUAvBRWQLgAmVpVgDYAoxFVQJYAy65VgHwA2wRVQKUASQJUgIcANQpTQIkAgwVSgDcAjxJRQJoAoAJOQMAANwRJgOUA8UpHgCAAeBJEQKIBCKBDgOEAzKlCgBQAtG05QIkBFVs3QNoANl41ANoBFZwyAIMA/2cvAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(75, 'EMP-103', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAzgAz/v8AAAD8AUQAxADEAQAAAFYdQDoA23NkQEEA/nhdQJIAj2tcQIYAqxFWgK4A0mxVQI4AahBUgF8BAXlTQNEAvQBTQFcA0HdTgK0AxARSQK4AgAtRgGEBHR9RgHUA8xlRQGAAPhZQgJIA0XFNgJMA5BFNQBoBB3RNgFgBDh1NQLYA4QBFQLkA/HM7gMQA/3g7QOYA06Q6gG0BMhY4QMMA4aI2AOsA0KQuAOUA9pcrAO0AxKwrAL4A/yEqAAQAymspAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(78, 'EMP-116', 0, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABXgAz/v8AAAD8AUQAxADEAQAAAFY1QEsAg2JkQJQAflFdQEEA+4lbgJ4BFXlagLQAU6lZgMUAq0lYQGYAhaxXgCAA7IFWgM8A9pRWgI4AQ1VUgJYA5pJTgGABEaBTgI4AtFJTQJwAv55TgOEAwJ5RQKAAkKRPQCMAq2pPQF0AKFZOgGUBLpxMQGsA7ZlJQOEAsaFIQNQAjktIQC8ApAtGQAsA0nRGQDQAxnNFgEQA0XdCQGAA7phBgEsAq69AgEoAzRQ/QDwAxWs/QIIAtlQ+QFEAr2A9gIwA7Iw9gJMAjlE8gDoAzA07gFYA0nY6QFYAt2I5QEgAv244QJ0Aiac2gHgBBT42AFgAsFk0AJQAHFAzAAkAzXczAGYA4HozAHkA/EQzABQApW4yAO8AvEUwAGYA6JYvAPIA0kItAFoAxAAsAFEAxGUqAAgA+XspALsBLospAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(79, 'EMP-116', 5, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAABOgAz/v8AAAD8AUQAxADEAQAAAFYvgIgA+H1kgGAA7HFhgLsBB4NggFoBA2JeQC4Abm5cQEEAihFagDQAzYVagEQAwoVYQCEAoXZWgIIA3X5WQHkAIGRWgD8BIlpVQGMBLnFVgHcAy4JVQK8A14tTQLgASapRgGYAhQVRQEUAUQtRQGcApAJQgJwBFX5QgJcAgKRPQLAAnZlPQGgAlQROQJMAU69NgBMA8YlMQJMA54NMQJ4ApElLQFYA0hdLQIMAuY9KgF8A/HNHQGUAzHFFQAcAxnpAgE8AzRs+QGwAxII4gEYA2yk4QEgA5hc4gFYAEA03QBcBDaU2AEgA7BA0AAgAY2gyADoA7a4xAAkAbRQvAI8AEgguAAIAtBkqAE8A2x4qAIYAFV8pAGgA0nMoAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', ''),
(1673, 'EMP-940', 1, '<?xml version=\"1.0\" encoding=\"UTF-8\"?><Fid><Bytes>Rk1SACAyMAAAjAAz/v8AAAD8AUQAxADEAQAAAFYSgEoArSBcQFcBAYdZgH4ApRlYQEIAX3NWQLUAamBWQLgA/4FUQGAAeXZTQGUAY3FTQL4Agq9TQLAA3X5IQLAAr2lEQL4AwGxEgMkAsJ5DQNoA24dBQK4AqQBAAOcA1zgyALkAxD8wALkA0XYsAAA=</Bytes><Format>1769473</Format><Version>1.0.0</Version></Fid>', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.finger_remove`
--

DROP TABLE IF EXISTS `dbo.finger_remove`;
CREATE TABLE IF NOT EXISTS `dbo.finger_remove` (
  `id` varchar(0) DEFAULT NULL,
  `emp_code` varchar(0) DEFAULT NULL,
  `date` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.groupupload_master`
--

DROP TABLE IF EXISTS `dbo.groupupload_master`;
CREATE TABLE IF NOT EXISTS `dbo.groupupload_master` (
  `id` tinyint(4) DEFAULT NULL,
  `group_code` varchar(7) DEFAULT NULL,
  `group_name` varchar(8) DEFAULT NULL,
  `name` varchar(11) DEFAULT NULL,
  `mobile` bigint(20) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.groupupload_master`
--

INSERT INTO `dbo.groupupload_master` (`id`, `group_code`, `group_name`, `name`, `mobile`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'SGR-001', 'Bluebase', 'Ravishankar', 9940946931, 0, 1, '2017-06-10', '', ''),
(2, 'SGR-001', 'Bluebase', 'Vikraman', 8608401612, 0, 1, '2017-06-10', '', ''),
(4, 'SGR-003', 'SGR-004', 'Ravishankar', 9840012549, 0, 1, '2017-06-16', '', ''),
(5, 'SGR-003', 'SGR-004', 'Vikraman', 7010916966, 0, 1, '2017-06-16', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.group_master`
--

DROP TABLE IF EXISTS `dbo.group_master`;
CREATE TABLE IF NOT EXISTS `dbo.group_master` (
  `id` tinyint(4) DEFAULT NULL,
  `group_code` varchar(7) DEFAULT NULL,
  `group_name` varchar(8) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.group_master`
--

INSERT INTO `dbo.group_master` (`id`, `group_code`, `group_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'SGR-001', 'Bluebase', 0, 1, '2017-06-10', '', ''),
(2, 'SGR-002', 'Quadsel', 0, 1, '2017-06-10', '', ''),
(3, 'SGR-003', 'SGR-004', 0, 1, '2017-06-16', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.holiday_allocation`
--

DROP TABLE IF EXISTS `dbo.holiday_allocation`;
CREATE TABLE IF NOT EXISTS `dbo.holiday_allocation` (
  `id` smallint(6) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `shift` varchar(50) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.holiday_allocation`
--

INSERT INTO `dbo.holiday_allocation` (`id`, `emp_code`, `date`, `shift`, `contractor_code`, `status`, `created_by`, `created_on`) VALUES
(1, 'EMP-737', '2017-12-10', '', 'CON-045', 0, 1, '2017-12-08 16:08:23'),
(2, 'EMP-736', '2017-12-10', '', 'CON-045', 0, 1, '2017-12-08 16:08:23'),
(3, 'EMP-470', '2017-12-10', 'Others                                            ', 'CON-016', 0, 1, '2017-12-08 16:58:46'),
(4, 'EMP-615', '2017-12-10', 'Others                                            ', 'CON-016', 0, 1, '2017-12-08 16:58:46'),
(5, 'EMP-527', '2017-12-10', 'Others                                            ', 'CON-054', 0, 1, '2017-12-08 17:00:31'),
(6, 'EMP-528', '2017-12-10', 'Others                                            ', 'CON-054', 0, 1, '2017-12-08 17:00:31'),
(7, 'EMP-530', '2017-12-10', 'Others                                            ', 'CON-054', 0, 1, '2017-12-08 17:00:31'),
(8, 'EMP-841', '2018-02-04', 'General-Plant                                     ', 'CON-032', 0, 1, '2018-02-02 16:09:25'),
(9, 'EMP-842', '2018-02-04', 'General-Plant                                     ', 'CON-032', 0, 1, '2018-02-02 16:09:25'),
(10, 'EMP-843', '2018-02-04', 'General-Plant                                     ', 'CON-032', 0, 1, '2018-02-02 16:09:25'),
(11, 'EMP-844', '2018-02-04', 'General-Plant                                     ', 'CON-032', 0, 1, '2018-02-02 16:09:25'),
(12, 'EMP-845', '2018-02-04', 'General-Plant                                     ', 'CON-032', 0, 1, '2018-02-02 16:09:25'),
(13, 'EMP-863', '2018-02-04', 'General-Plant                                     ', 'CON-032', 0, 1, '2018-02-02 16:09:25'),
(14, 'EMP-857', '2018-02-04', 'General-Plant                                     ', 'CON-032', 0, 1, '2018-02-02 16:09:25'),
(15, 'EMP-935', '2018-02-04', 'General-Plant                                     ', 'CON-032', 0, 1, '2018-02-02 16:09:25'),
(315, 'EMP-066', '2018-02-25', 'Shift-C                                           ', 'CON-046', 0, 1, '2018-02-24 15:07:12'),
(67, 'EMP-474', '2018-02-18', 'General-Plant                                     ', 'CON-021', 0, 1, '2018-02-13 12:06:12'),
(68, 'EMP-477', '2018-02-18', 'General-Plant                                     ', 'CON-021', 0, 1, '2018-02-13 12:06:12'),
(69, 'EMP-351', '2018-02-18', 'General-Plant                                     ', 'CON-001', 0, 1, '2018-02-15 11:51:23'),
(70, 'EMP-354', '2018-02-18', 'General-Plant                                     ', 'CON-001', 0, 1, '2018-02-15 11:51:23'),
(71, 'EMP-357', '2018-02-18', 'General-Plant                                     ', 'CON-001', 0, 1, '2018-02-15 11:51:23'),
(82, 'EMP-347', '2018-02-18', 'General-Plant                                     ', 'CON-001', 0, 1, '2018-02-15 17:08:03'),
(83, 'EMP-350', '2018-02-18', 'General-Plant                                     ', 'CON-001', 0, 1, '2018-02-15 17:08:03'),
(84, 'EMP-353', '2018-02-18', 'General-Plant                                     ', 'CON-001', 0, 1, '2018-02-15 17:08:03'),
(98, 'EMP-947', '2018-02-18', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-17 14:01:55'),
(99, 'EMP-948', '2018-02-18', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-17 14:01:55'),
(100, 'EMP-949', '2018-02-18', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-17 14:01:55'),
(101, 'EMP-950', '2018-02-18', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-17 14:01:55'),
(102, 'EMP-988', '2018-02-18', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-17 14:01:55'),
(103, 'EMP-989', '2018-02-18', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-17 14:01:55'),
(104, 'EMP-990', '2018-02-18', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-17 14:01:55'),
(139, 'EMP-414', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(140, 'EMP-416', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(141, 'EMP-420', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(142, 'EMP-421', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(143, 'EMP-422', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(144, 'EMP-423', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(145, 'EMP-424', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(146, 'EMP-425', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(147, 'EMP-426', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(148, 'EMP-427', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(149, 'EMP-428', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(150, 'EMP-429', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(151, 'EMP-430', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(152, 'EMP-431', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(153, 'EMP-432', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(154, 'EMP-433', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(155, 'EMP-434', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(156, 'EMP-435', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(157, 'EMP-436', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(158, 'EMP-415', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(159, 'EMP-417', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(160, 'EMP-418', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(161, 'EMP-419', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(162, 'EMP-437', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(163, 'EMP-438', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(164, 'EMP-439', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(165, 'EMP-440', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(166, 'EMP-441', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(167, 'EMP-442', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(168, 'EMP-443', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(169, 'EMP-444', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(170, 'EMP-445', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(171, 'EMP-446', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(172, 'EMP-447', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(173, 'EMP-448', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(174, 'EMP-449', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(175, 'EMP-450', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(176, 'EMP-451', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(177, 'EMP-452', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(178, 'EMP-765', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(179, 'EMP-785', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(180, 'EMP-791', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(181, 'EMP-792', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(182, 'EMP-997', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(183, 'EMP-637', '2018-02-25', 'General-Plant                                     ', 'CON-011', 0, 1, '2018-02-23 16:02:30'),
(16, 'EMP-841', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(17, 'EMP-842', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(18, 'EMP-843', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(19, 'EMP-844', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(20, 'EMP-845', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(21, 'EMP-863', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(22, 'EMP-857', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(23, 'EMP-946', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(24, 'EMP-935', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(25, 'EMP-936', '2018-02-11', 'Others                                            ', 'CON-032', 0, 1, '2018-02-09 12:20:35'),
(26, 'EMP-941', '2018-02-11', 'Others                                            ', 'CON-001', 0, 1, '2018-02-09 15:30:14'),
(27, 'EMP-344', '2018-02-11', 'Others                                            ', 'CON-001', 0, 1, '2018-02-09 15:30:14'),
(28, 'EMP-347', '2018-02-11', 'Others                                            ', 'CON-001', 0, 1, '2018-02-09 15:30:14'),
(29, 'EMP-350', '2018-02-11', 'Others                                            ', 'CON-001', 0, 1, '2018-02-09 15:30:14'),
(30, 'EMP-353', '2018-02-11', 'Others                                            ', 'CON-001', 0, 1, '2018-02-09 15:30:14'),
(31, 'EMP-453', '2018-02-11', 'Others                                            ', 'CON-052', 0, 1, '2018-02-10 11:09:14'),
(32, 'EMP-748', '2018-02-11', 'Others                                            ', 'CON-052', 0, 1, '2018-02-10 11:09:14'),
(33, 'EMP-749', '2018-02-11', 'Others                                            ', 'CON-052', 0, 1, '2018-02-10 11:09:14'),
(34, 'EMP-750', '2018-02-11', 'Others                                            ', 'CON-052', 0, 1, '2018-02-10 11:09:14'),
(35, 'EMP-834', '2018-02-11', 'Others                                            ', 'CON-052', 0, 1, '2018-02-10 11:09:14'),
(47, 'EMP-527', '2018-02-11', 'General-Plant                                     ', 'CON-054', 0, 1, '2018-02-10 14:49:57'),
(48, 'EMP-530', '2018-02-11', 'General-Plant                                     ', 'CON-054', 0, 1, '2018-02-10 14:49:57'),
(49, 'EMP-947', '2018-02-11', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-10 15:09:59'),
(50, 'EMP-948', '2018-02-11', 'General-Plant                                     ', 'CON-057', 0, 1, '2018-02-10 15:09:59');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.holiday_upload`
--

DROP TABLE IF EXISTS `dbo.holiday_upload`;
CREATE TABLE IF NOT EXISTS `dbo.holiday_upload` (
  `id` tinyint(4) DEFAULT NULL,
  `year` smallint(6) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `typeofleave` varchar(37) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.holiday_upload`
--

INSERT INTO `dbo.holiday_upload` (`id`, `year`, `date`, `typeofleave`, `status`, `created_on`, `created_by`) VALUES
(1, 2016, '2017-01-01', 'Newyear1', 1, '', ''),
(2, 2017, '2017-01-02', 'NEW YEAR', 1, '', ''),
(6, 2017, '2017-04-13', 'testdets', 0, '', ''),
(15, 2017, '2017-02-01', 'NEW YEAR', 0, '', ''),
(16, 2017, '2017-02-01', 'NEW YEAR', 0, '', ''),
(17, 2017, '2017-02-02', 'Teee', 0, '', ''),
(18, 2017, '2017-03-26', 'fhjjk', 0, '', ''),
(20, 2017, '2017-04-13', 'Testing', 0, '', ''),
(21, 2017, '2017-04-13', 'Testing', 0, '', ''),
(22, 2017, '2017-02-11', 'Ravishankar R', 0, '', ''),
(23, 2017, '2017-05-31', 'Test Holiday', 0, '', ''),
(24, 2017, '2017-08-15', 'Independence Day', 0, '', ''),
(25, 2017, '2017-06-27', 'Holiday', 0, '', ''),
(26, 2018, '2018-01-01', 'New Year ', 0, '', ''),
(27, 2018, '2018-01-15', 'Pongal - Thiruvalluvar Day', 0, '', ''),
(28, 2018, '2018-01-26', 'Republic Day', 0, '', ''),
(29, 2018, '2018-04-14', 'Tamil New Year  ', 0, '', ''),
(30, 2018, '2018-05-01', 'May Day', 0, '', ''),
(31, 2018, '2018-08-15', 'Independence Day ', 0, '', ''),
(32, 2018, '2018-09-13', 'Vinayakar Chathurthi ', 0, '', ''),
(33, 2018, '2018-10-02', 'Gandhi Jayanthi ', 0, '', ''),
(34, 2018, '2018-10-18', 'Ayudha Pooja ', 0, '', ''),
(35, 2018, '2018-11-05', 'Diwali', 0, '', ''),
(36, 2018, '2018-11-06', 'Diwali', 0, '', ''),
(37, 2018, '2018-11-07', 'Diwali', 0, '', ''),
(64, 2019, '2019-01-01', 'New Year Day \r\n', 0, '', ''),
(65, 2019, '2019-01-15', 'Pongal', 0, '', ''),
(66, 2019, '2019-01-16', 'Thiruvalluvar Day \r\n', 0, '', ''),
(67, 2019, '2019-01-26', 'Republic Day \r\n', 0, '', ''),
(68, 2019, '2019-04-18', 'Election Day \r\n', 0, '', ''),
(69, 2019, '2019-04-19', 'Holiday in lieu of 15th April 2019 \r\n', 0, '', ''),
(70, 2019, '2019-05-01', 'May Day \r\n', 0, '', ''),
(71, 2019, '2019-08-15', 'Independence Day \r\n', 0, '', ''),
(72, 2019, '2019-09-02', 'Vinayakar Chathurthi \r\n', 0, '', ''),
(73, 2019, '2019-10-02', 'Gandhi Jayanthi \r\n', 0, '', ''),
(74, 2019, '2019-10-07', 'Ayudha Pooja \r\n', 0, '', ''),
(75, 2019, '2019-10-26', 'Deepavali \r\n', 0, '', ''),
(76, 2019, '2019-10-28', 'Deepavali \r\n', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.holiday_work_permit`
--

DROP TABLE IF EXISTS `dbo.holiday_work_permit`;
CREATE TABLE IF NOT EXISTS `dbo.holiday_work_permit` (
  `id` smallint(6) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `incharge_approve` varchar(1) DEFAULT NULL,
  `incharge_remarks` varchar(0) DEFAULT NULL,
  `incharge_date` varchar(10) DEFAULT NULL,
  `incharge_name` varchar(2) DEFAULT NULL,
  `po_approve` varchar(1) DEFAULT NULL,
  `po_remarks` varchar(0) DEFAULT NULL,
  `po_date` varchar(10) DEFAULT NULL,
  `po_name` varchar(2) DEFAULT NULL,
  `hse_approve` varchar(1) DEFAULT NULL,
  `hse_remarks` varchar(31) DEFAULT NULL,
  `hse_date` varchar(10) DEFAULT NULL,
  `hse_name` varchar(2) DEFAULT NULL,
  `hr_approve` varchar(1) DEFAULT NULL,
  `hr_remarks` varchar(3) DEFAULT NULL,
  `hr_date` varchar(10) DEFAULT NULL,
  `hr_name` varchar(2) DEFAULT NULL,
  `isdeviation` varchar(3) DEFAULT NULL,
  `approver_name` varchar(1) DEFAULT NULL,
  `spl_name` varchar(1) DEFAULT NULL,
  `spl_remarks` varchar(4) DEFAULT NULL,
  `spl_date` varchar(10) DEFAULT NULL,
  `spl_approve` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.holiday_work_permit`
--

INSERT INTO `dbo.holiday_work_permit` (`id`, `emp_code`, `from_date`, `incharge_approve`, `incharge_remarks`, `incharge_date`, `incharge_name`, `po_approve`, `po_remarks`, `po_date`, `po_name`, `hse_approve`, `hse_remarks`, `hse_date`, `hse_name`, `hr_approve`, `hr_remarks`, `hr_date`, `hr_name`, `isdeviation`, `approver_name`, `spl_name`, `spl_remarks`, `spl_date`, `spl_approve`) VALUES
(1, 'EMP-737', '2017-12-10', '1', '', '2017-12-12', '18', '', '', '', '', '1', '', '2018-02-10', '32', '1', 'gvj', '2017-12-11', '1', 'Yes', '1', '1', 'ghch', '2017-12-11', '1'),
(2, 'EMP-736', '2017-12-10', '1', '', '2017-12-12', '18', '', '', '', '', '1', '', '2018-02-10', '32', '1', '', '2017-12-12', '1', '', '', '', '', '', ''),
(3, 'EMP-470', '2017-12-10', '1', '', '2019-01-14', '45', '', '', '', '', '1', '', '2018-07-18', '33', '1', '', '2018-08-25', '1', '', '', '', '', '', ''),
(4, 'EMP-615', '2017-12-10', '1', '', '2018-04-13', '45', '', '', '', '', '1', '', '2018-04-16', '33', '1', '', '2018-04-19', '1', '', '', '', '', '', ''),
(5, 'EMP-527', '2017-12-10', '1', '', '2018-09-08', '45', '', '', '', '', '1', '', '2018-06-30', '33', '1', '', '2018-07-14', '1', '', '', '', '', '', ''),
(6, 'EMP-528', '2017-12-10', '1', '', '2018-09-08', '45', '', '', '', '', '1', '', '2018-06-30', '33', '1', '', '2018-07-14', '1', '', '', '', '', '', ''),
(7, 'EMP-530', '2017-12-10', '1', '', '2018-09-08', '45', '', '', '', '', '1', '', '2018-06-30', '33', '1', '', '2018-07-14', '1', '', '', '', '', '', ''),
(8, 'EMP-841', '2018-02-04', '1', '', '2019-01-14', '45', '1', '', '2018-02-15', '36', '1', '', '2018-08-24', '33', '1', '', '2018-08-25', '1', '', '', '', '', '', ''),
(9, 'EMP-842', '2018-02-04', '1', '', '2018-08-28', '34', '1', '', '2018-02-15', '36', '1', '', '2018-08-24', '33', '1', '', '2018-08-25', '1', '', '', '', '', '', ''),
(10, 'EMP-843', '2018-02-04', '1', '', '2018-05-14', '34', '1', '', '2018-02-15', '36', '1', '', '2018-05-12', '33', '1', '', '2018-05-17', '1', '', '', '', '', '', ''),
(11, 'EMP-844', '2018-02-04', '1', '', '2019-01-14', '45', '1', '', '2018-02-15', '36', '1', '', '2018-08-24', '33', '1', '', '2018-08-25', '1', '', '', '', '', '', ''),
(12, 'EMP-845', '2018-02-04', '1', '', '2018-05-14', '34', '1', '', '2018-02-15', '36', '1', '', '2018-05-12', '33', '1', '', '2018-05-17', '1', '', '', '', '', '', ''),
(13, 'EMP-863', '2018-02-04', '1', '', '2018-05-14', '34', '1', '', '2018-02-15', '36', '1', '', '2018-05-12', '33', '1', '', '2018-05-17', '1', '', '', '', '', '', ''),
(14, 'EMP-857', '2018-02-04', '1', '', '2019-01-14', '45', '1', '', '2018-02-15', '36', '1', '', '2018-05-12', '33', '1', '', '2018-05-17', '1', '', '', '', '', '', ''),
(15, 'EMP-935', '2018-02-04', '1', '', '2019-01-14', '45', '1', '', '2018-02-15', '36', '1', '', '2018-04-28', '33', '1', '', '2018-04-28', '1', '', '', '', '', '', ''),
(67, 'EMP-474', '2018-02-18', '1', '', '2019-01-14', '45', '', '', '', '', '1', '', '2018-08-24', '33', '1', '', '2018-08-14', '1', '', '', '', '', '', ''),
(68, 'EMP-477', '2018-02-18', '1', '', '2019-01-14', '45', '', '', '', '', '1', '', '2018-07-07', '33', '1', '', '2018-07-14', '1', '', '', '', '', '', ''),
(69, 'EMP-351', '2018-02-18', '1', '', '2018-02-15', '34', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-02-15', '1', '', '', '', '', '', ''),
(70, 'EMP-354', '2018-02-18', '1', '', '2018-02-15', '34', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-02-15', '1', '', '', '', '', '', ''),
(71, 'EMP-357', '2018-02-18', '1', '', '2018-02-15', '34', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-02-15', '1', '', '', '', '', '', ''),
(82, 'EMP-347', '2018-02-18', '1', '', '2018-02-17', '34', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-02-15', '51', '', '', '', '', '', ''),
(83, 'EMP-350', '2018-02-18', '1', '', '2018-02-17', '34', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-02-15', '51', '', '', '', '', '', ''),
(84, 'EMP-353', '2018-02-18', '1', '', '2018-02-17', '34', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-02-15', '51', '', '', '', '', '', ''),
(98, 'EMP-947', '2018-02-18', '1', '', '2019-01-14', '45', '1', '', '2018-02-17', '36', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(99, 'EMP-948', '2018-02-18', '1', '', '2019-01-14', '45', '1', '', '2018-02-17', '36', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(100, 'EMP-949', '2018-02-18', '1', '', '2019-01-14', '45', '1', '', '2018-02-17', '36', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(101, 'EMP-950', '2018-02-18', '1', '', '2019-01-14', '45', '1', '', '2018-02-17', '36', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(102, 'EMP-988', '2018-02-18', '1', '', '2019-01-14', '45', '1', '', '2018-02-17', '36', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(103, 'EMP-989', '2018-02-18', '1', '', '2019-01-14', '45', '1', '', '2018-02-17', '36', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(104, 'EMP-990', '2018-02-18', '1', '', '2019-01-14', '45', '1', '', '2018-02-17', '36', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(139, 'EMP-414', '2018-02-25', '1', '', '2018-07-14', '44', '', '', '', '', '1', '', '2018-07-18', '33', '1', '', '2018-07-17', '1', '', '', '', '', '', ''),
(140, 'EMP-416', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(141, 'EMP-420', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(142, 'EMP-421', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(143, 'EMP-422', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(144, 'EMP-423', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(145, 'EMP-424', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(146, 'EMP-425', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(147, 'EMP-426', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(148, 'EMP-427', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(149, 'EMP-428', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(150, 'EMP-429', '2018-02-25', '1', '', '2018-03-21', '34', '', '', '', '', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(151, 'EMP-430', '2018-02-25', '1', '', '2018-08-13', '34', '', '', '', '', '1', '', '2018-08-14', '33', '1', '', '2018-08-14', '1', '', '', '', '', '', ''),
(152, 'EMP-431', '2018-02-25', '1', '', '2018-08-13', '34', '', '', '', '', '1', '', '2018-08-14', '33', '1', '', '2018-08-14', '1', '', '', '', '', '', ''),
(153, 'EMP-432', '2018-02-25', '1', '', '2018-08-13', '34', '', '', '', '', '1', '', '2018-08-14', '33', '1', '', '2018-08-14', '1', '', '', '', '', '', ''),
(154, 'EMP-433', '2018-02-25', '1', '', '2018-03-21', '34', '', '', '', '', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(155, 'EMP-434', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(156, 'EMP-435', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(157, 'EMP-436', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(158, 'EMP-415', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(159, 'EMP-417', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(160, 'EMP-418', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(161, 'EMP-419', '2018-02-25', '1', '', '2018-03-21', '34', '', '', '', '', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(162, 'EMP-437', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(163, 'EMP-438', '2018-02-25', '1', '', '2018-08-13', '34', '', '', '', '', '1', '', '2018-08-14', '33', '1', '', '2018-08-14', '1', '', '', '', '', '', ''),
(164, 'EMP-439', '2018-02-25', '1', '', '2018-08-13', '34', '', '', '', '', '1', '', '2018-07-18', '33', '1', '', '2018-07-17', '1', '', '', '', '', '', ''),
(165, 'EMP-440', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(166, 'EMP-441', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(167, 'EMP-442', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(168, 'EMP-443', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(169, 'EMP-444', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(170, 'EMP-445', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(171, 'EMP-446', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(172, 'EMP-447', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(173, 'EMP-448', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(174, 'EMP-449', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(175, 'EMP-450', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(176, 'EMP-451', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(177, 'EMP-452', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(178, 'EMP-765', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(179, 'EMP-785', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(180, 'EMP-791', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(181, 'EMP-792', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(182, 'EMP-997', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(183, 'EMP-637', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(184, 'EMP-635', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(185, 'EMP-636', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(186, 'EMP-682', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(187, 'EMP-683', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(188, 'EMP-1033', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(189, 'EMP-1034', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(190, 'EMP-1035', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(191, 'EMP-1036', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(192, 'EMP-1037', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-03', '32', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(229, 'EMP-414', '2018-02-25', '1', '', '2018-07-14', '44', '', '', '', '', '1', '', '2018-07-18', '33', '1', '', '2018-07-17', '1', '', '', '', '', '', ''),
(230, 'EMP-416', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(231, 'EMP-421', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(232, 'EMP-422', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(233, 'EMP-424', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(234, 'EMP-425', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(235, 'EMP-427', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(236, 'EMP-428', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(237, 'EMP-430', '2018-02-25', '1', '', '2018-08-13', '34', '', '', '', '', '1', '', '2018-08-14', '33', '1', '', '2018-08-14', '1', '', '', '', '', '', ''),
(238, 'EMP-431', '2018-02-25', '1', '', '2018-08-13', '34', '', '', '', '', '1', '', '2018-08-14', '33', '1', '', '2018-08-14', '1', '', '', '', '', '', ''),
(239, 'EMP-433', '2018-02-25', '1', '', '2018-03-21', '34', '', '', '', '', '1', '', '2018-03-19', '33', '1', '', '2018-03-27', '1', '', '', '', '', '', ''),
(240, 'EMP-434', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(241, 'EMP-436', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(242, 'EMP-415', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(243, 'EMP-418', '2018-02-25', '1', '', '2018-03-03', '44', '', '', '', '', '1', '', '2018-03-05', '33', '1', '', '2018-03-13', '1', '', '', '', '', '', ''),
(16, 'EMP-841', '2018-02-11', '1', '', '2019-01-14', '45', '1', '', '2018-02-15', '36', '1', '', '2018-08-24', '33', '1', '', '2018-08-25', '1', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.labour_law_master`
--

DROP TABLE IF EXISTS `dbo.labour_law_master`;
CREATE TABLE IF NOT EXISTS `dbo.labour_law_master` (
  `law_id` tinyint(4) DEFAULT NULL,
  `law_name` varchar(53) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.labour_law_master`
--

INSERT INTO `dbo.labour_law_master` (`law_id`, `law_name`, `status`) VALUES
(1, 'The contract Labour(R & A)Act,1970&Central Rules,1971', 0),
(2, 'T N Indl Est(N/FH)Act,1958', 0),
(3, 'Factories Act', 0),
(4, 'Payment Of Wages Act 1936', 0),
(5, 'Minimum Wages Act', 0),
(6, 'The Payment Of Bonus Act 1965', 0),
(7, 'The EPF Act,1952', 0),
(8, 'The ESI Act, 1948', 0),
(9, 'Employees Compensation Act', 0),
(10, 'L W F Act', 0),
(11, 'Prof. Tax', 0),
(12, 'Legal compliance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dbo.log_entry`
--

DROP TABLE IF EXISTS `dbo.log_entry`;
CREATE TABLE IF NOT EXISTS `dbo.log_entry` (
  `id` mediumint(9) DEFAULT NULL,
  `user_id` tinyint(4) DEFAULT NULL,
  `logdate` varchar(10) DEFAULT NULL,
  `logtime` varchar(8) DEFAULT NULL,
  `system_ip` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.log_entry`
--

INSERT INTO `dbo.log_entry` (`id`, `user_id`, `logdate`, `logtime`, `system_ip`) VALUES
(1, 1, '2016-03-16', '', '192.168.100.58'),
(2, 1, '2016-03-16', '16:38:41', '192.168.100.58'),
(3, 1, '2016-03-16', '16:39:34', '192.168.100.58'),
(4, 1, '2016-03-17', '15:02:10', '192.168.100.58'),
(5, 1, '2016-03-18', '15:54:48', '172.16.7.112'),
(6, 1, '2016-03-21', '10:51:32', '192.168.100.58'),
(7, 1, '2016-03-28', '11:13:38', '192.168.1.38'),
(8, 1, '2016-03-31', '13:39:11', '192.168.1.4'),
(9, 1, '2016-04-12', '14:00:31', '192.168.100.188'),
(10, 1, '2016-04-13', '11:06:53', '192.168.100.188'),
(11, 1, '2016-04-23', '14:12:31', '192.168.1.33'),
(12, 1, '2016-04-24', '14:13:14', '192.168.1.33'),
(13, 1, '2016-05-10', '14:53:35', '192.168.100.83'),
(14, 1, '2016-05-13', '15:46:50', '192.168.100.83'),
(15, 1, '2016-05-13', '17:19:39', '172.16.2.129'),
(16, 1, '2016-05-19', '11:33:57', '172.16.2.129'),
(17, 1, '2016-05-19', '16:14:17', '172.16.2.129'),
(18, 1, '2016-05-20', '09:54:53', '172.16.2.129'),
(19, 1, '2016-05-20', '11:03:15', '172.16.2.129'),
(21, 1, '2016-05-20', '16:05:22', '172.16.2.129'),
(22, 1, '2016-05-23', '12:21:28', '172.16.2.129'),
(23, 1, '2016-05-23', '12:37:28', '172.16.2.129'),
(24, 1, '2016-05-25', '09:13:54', '172.16.2.129'),
(25, 1, '2016-05-25', '10:11:01', '172.16.2.129'),
(26, 1, '2016-05-25', '10:25:13', '172.16.2.129'),
(27, 1, '2016-05-25', '14:33:25', '172.16.2.129'),
(28, 1, '2016-05-27', '10:24:09', '172.16.2.129'),
(29, 1, '2016-06-15', '08:32:21', '172.16.2.129'),
(30, 1, '2016-06-15', '09:02:52', '172.16.2.129'),
(38, 1, '2016-06-28', '13:59:13', '172.16.2.129'),
(39, 1, '2016-06-28', '14:02:38', '172.16.2.129'),
(20, 1, '2016-05-20', '16:00:08', '172.16.2.129'),
(31, 1, '2016-06-16', '12:04:13', '172.16.2.129'),
(32, 1, '2016-06-16', '13:40:24', '172.16.2.129'),
(33, 1, '2016-06-16', '13:52:35', '172.16.2.129'),
(34, 1, '2016-06-16', '15:33:49', '172.16.2.129'),
(35, 1, '2016-06-16', '15:48:08', '172.16.2.129'),
(36, 1, '2016-06-16', '16:44:03', '172.16.2.129'),
(37, 1, '2016-06-17', '09:56:44', '172.16.2.129'),
(40, 1, '2016-06-30', '10:01:34', '172.16.2.129'),
(41, 1, '2016-06-30', '10:03:35', '172.16.2.129'),
(42, 1, '2016-06-30', '10:32:24', '172.16.2.129'),
(43, 1, '2016-07-04', '14:18:05', '192.168.100.83'),
(44, 1, '2016-07-04', '14:47:54', '192.168.100.83'),
(45, 1, '2016-07-05', '15:48:40', '192.168.100.83'),
(46, 1, '2016-07-07', '10:47:12', '192.168.1.51'),
(47, 1, '2016-07-07', '12:15:36', '192.168.1.51'),
(48, 1, '2016-07-25', '17:27:31', '192.168.1.51'),
(49, 1, '2016-07-28', '09:46:46', '192.168.1.39'),
(50, 1, '2016-08-17', '13:47:51', '192.168.100.95'),
(51, 1, '2016-08-18', '11:00:20', '128.168.0.67'),
(52, 1, '2016-08-19', '09:35:37', '192.168.1.33'),
(53, 1, '2016-08-19', '10:09:36', '192.168.1.33'),
(54, 1, '2016-08-22', '12:04:46', '192.168.1.44'),
(55, 1, '2016-08-23', '15:27:09', '192.168.1.38'),
(56, 1, '2016-08-23', '16:36:01', '192.168.1.38'),
(57, 1, '2016-08-23', '16:56:28', '192.168.1.38'),
(58, 1, '2016-08-24', '11:32:23', '192.168.1.38'),
(59, 1, '2016-08-26', '09:45:29', '192.168.1.38'),
(60, 1, '2016-08-27', '09:35:52', '192.168.1.33'),
(61, 1, '2016-08-27', '11:05:10', '192.168.1.33'),
(62, 1, '2016-08-29', '17:04:47', '192.168.1.42'),
(63, 1, '2016-08-29', '21:40:25', '127.0.0.1'),
(64, 1, '2016-08-29', '21:41:47', '127.0.0.1'),
(65, 1, '2016-08-30', '08:38:32', '192.168.100.127'),
(66, 1, '2016-08-31', '12:09:27', '192.168.1.44'),
(67, 1, '2016-08-31', '12:10:26', '192.168.1.44'),
(68, 1, '2016-08-31', '13:00:46', '192.168.1.44'),
(69, 1, '2016-08-31', '13:03:12', '192.168.1.44'),
(70, 1, '2016-08-31', '13:25:53', '192.168.1.44'),
(71, 1, '2016-08-31', '15:39:45', '192.168.1.44'),
(72, 1, '2016-08-31', '15:40:18', '192.168.1.44'),
(73, 1, '2016-09-01', '10:07:52', '192.168.100.127'),
(74, 1, '2016-09-02', '08:15:54', '192.168.100.127'),
(75, 1, '2016-09-07', '14:30:28', '172.16.2.129'),
(1075, 1, '2016-09-12', '13:37:00', '172.16.2.129'),
(1076, 1, '2016-09-13', '12:05:18', '172.16.2.129'),
(1077, 1, '2016-09-14', '10:58:10', '172.16.2.129'),
(1078, 1, '2016-09-15', '08:12:22', '172.16.2.129'),
(1079, 1, '2016-09-15', '11:19:51', '172.16.2.129'),
(1080, 1, '2016-09-21', '08:02:59', '172.16.2.129'),
(1087, 1, '2016-10-04', '11:41:03', '172.16.2.129'),
(1088, 1, '2016-12-05', '12:03:22', '172.16.2.129'),
(1089, 1, '2016-12-22', '14:31:37', '172.16.2.129'),
(1090, 1, '2016-12-26', '16:30:24', '172.16.2.129'),
(1092, 1, '2017-01-06', '08:16:27', '172.16.2.129'),
(1094, 1, '2017-01-13', '17:56:01', '172.16.2.129'),
(1095, 1, '2017-01-20', '08:13:21', '172.16.2.129'),
(1096, 1, '2017-01-20', '13:47:11', '172.16.2.129'),
(1097, 1, '2017-01-20', '14:12:46', '172.16.2.129'),
(1098, 1, '2017-01-23', '15:27:06', '172.16.2.129'),
(1099, 14, '2017-02-20', '09:44:33', '172.16.2.129'),
(1100, 1, '2017-02-20', '09:52:07', '172.16.2.129'),
(1106, 1, '2017-02-20', '10:35:01', '172.16.2.129'),
(1107, 1, '2017-02-20', '10:38:33', '172.16.2.129'),
(1108, 1, '2017-02-20', '10:39:18', '172.16.2.129'),
(1109, 14, '2017-02-20', '10:44:21', '172.16.2.129'),
(1110, 1, '2017-02-20', '10:53:39', '172.16.2.129'),
(1111, 14, '2017-02-20', '14:30:20', '172.16.2.129'),
(1112, 14, '2017-02-20', '14:33:50', '172.16.2.129'),
(NULL, 18, '2024-04-27', '18:29:56', '::1'),
(NULL, 1, '2024-04-27', '18:34:27', '::1'),
(NULL, 34, '2024-04-27', '18:35:28', '::1'),
(NULL, 33, '2024-04-27', '18:36:42', '::1'),
(NULL, 52, '2024-04-27', '18:43:11', '::1');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.mailgroupupload_master`
--

DROP TABLE IF EXISTS `dbo.mailgroupupload_master`;
CREATE TABLE IF NOT EXISTS `dbo.mailgroupupload_master` (
  `id` tinyint(4) DEFAULT NULL,
  `group_code` varchar(7) DEFAULT NULL,
  `group_name` varchar(8) DEFAULT NULL,
  `name` varchar(11) DEFAULT NULL,
  `mail` varchar(39) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(1) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.mailgroupupload_master`
--

INSERT INTO `dbo.mailgroupupload_master` (`id`, `group_code`, `group_name`, `name`, `mail`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'MGR-002', 'QUAD', 'Ravishankar', 'ravi@bluebase.in', 0, 1, '2017-06-10', '', ''),
(2, 'MGR-002', 'QUAD', 'Vikraman', 'vikram@bluebase.in', 0, 1, '2017-06-10', '', ''),
(3, 'MGR-002', 'QUAD', 'Jegan', 'jegadesan1@bluebase.in', 0, 1, '2017-06-10', '1', '2017-06-10'),
(4, 'MGR-001', 'BB', 'vikram', 'vikraman@bluebase.in', 0, 1, '2017-06-14', '', ''),
(5, 'MGR-001', 'BB', 'Ravi', 'ravi@bluebase.in', 0, 1, '2017-06-14', '', ''),
(6, 'MGR-003', 'MGR -003', '', '', 0, 1, '2017-06-16', '', ''),
(7, 'MGR-003', 'MGR -003', 'test', 'sureshkumar.bathirappan@toshiba-tjps.in', 0, 1, '2017-06-16', '', ''),
(8, 'MGR-003', 'MGR -003', 'Ravishankar', 'ravi@bluebase.in', 1, 1, '2017-06-16', '1', '2017-06-16'),
(9, 'MGR-003', 'MGR -003', 'Vikraman', 'vikram@bluebase.in', 1, 1, '2017-06-16', '1', '2017-06-16'),
(10, 'MGR-003', 'MGR -003', 'Jegan', 'jegadesan@bluebase.in', 1, 1, '2017-06-16', '1', '2017-06-16'),
(11, 'MGR-003', 'MGR -003', 'Ravishankar', 'sureshkumar.bathirappan@toshiba-tjps.in', 0, 1, '2017-06-16', '', ''),
(12, 'MGR-003', 'MGR -003', 'Vikraman', 'teenraj.selvarajan@toshiba-tjps.in', 0, 1, '2017-06-16', '', ''),
(13, 'MGR-003', 'MGR -003', 'Jegan', 'Praveena.Gokul@toshiba-tjps.in', 0, 1, '2017-06-16', '', ''),
(14, 'MGR-003', 'MGR -003', 'D', 'ravikumar.vijayan@toshiba-tjps.in', 0, 1, '2017-06-16', '', ''),
(15, 'MGR-001', 'BB', 'Jegadesan', 'jegadesan@bluebase.in', 0, 1, '2017-06-23', '1', '2017-07-04');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.mailgroup_master`
--

DROP TABLE IF EXISTS `dbo.mailgroup_master`;
CREATE TABLE IF NOT EXISTS `dbo.mailgroup_master` (
  `id` tinyint(4) DEFAULT NULL,
  `group_code` varchar(7) DEFAULT NULL,
  `group_name` varchar(8) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.mailgroup_master`
--

INSERT INTO `dbo.mailgroup_master` (`id`, `group_code`, `group_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'MGR-001', 'BB', 0, 1, '2017-06-10', '', ''),
(2, 'MGR-002', 'QUAD', 0, 1, '2017-06-10', '', ''),
(3, 'MGR-003', 'MGR -003', 0, 1, '2017-06-16', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.mail_log`
--

DROP TABLE IF EXISTS `dbo.mail_log`;
CREATE TABLE IF NOT EXISTS `dbo.mail_log` (
  `id` varchar(0) DEFAULT NULL,
  `to_mail` varchar(0) DEFAULT NULL,
  `cc_mail` varchar(0) DEFAULT NULL,
  `subject` varchar(0) DEFAULT NULL,
  `message` varchar(0) DEFAULT NULL,
  `status` varchar(0) DEFAULT NULL,
  `send_date` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.mail_master`
--

DROP TABLE IF EXISTS `dbo.mail_master`;
CREATE TABLE IF NOT EXISTS `dbo.mail_master` (
  `id` tinyint(4) DEFAULT NULL,
  `mail_code` varchar(7) DEFAULT NULL,
  `mail_name` varchar(60) DEFAULT NULL,
  `from_mail` varchar(39) DEFAULT NULL,
  `to_mail` varchar(39) DEFAULT NULL,
  `cc` varchar(39) DEFAULT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `header1` varchar(4) DEFAULT NULL,
  `header2` varchar(0) DEFAULT NULL,
  `body` text,
  `footer` varchar(28) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` tinyint(4) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.mail_master`
--

INSERT INTO `dbo.mail_master` (`id`, `mail_code`, `mail_name`, `from_mail`, `to_mail`, `cc`, `subject`, `header1`, `header2`, `body`, `footer`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'MAC-001', 'Extended Work', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Extended work on previous day :', 'Hi,', '', 'The list contract below employees worked after the specified time as per their contract. \r\n\r\nThe details of your Work extended contract employees are given below:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(2, 'MAC-002', 'Pre Work Permit Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Pre Expiry of EmployeeWork Permit', 'Hi,', '', 'The validity of the below employees <b>Work Permit</b> is expiring. \r\nThis is a gentle reminder to renew your Agreement before the due date. \r\nThe details of your employees <b>Work permit</b> are given below:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(3, 'MAC-003', 'Post Work Permit Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Post Expiry of Employee Work Permit', 'Hi,', '', 'The validity of the below employees  <b>Work Permit</b> is expired. \r\nThis is an intimation mail. \r\nThe details of your employees <b>Work permit</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(4, 'MAC-004', 'Post Contract Period Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Post Expiry of Contract Period', 'Hi,', '', 'The validity of your <b>Contract Period</b> is expired. \r\nThis is an intimation mail. \r\nThe details of your <b>Contract Period</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(5, 'MAC-005', 'Post Licence Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Post Expiry of License', 'Hi,', '', 'The validity of your <b>Licence </b> is expired. \r\nThis is an intimation mail. \r\nThe details of your <b>Licence </b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(6, 'MAC-006', 'Post GPA Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Post Expiry of GPA', 'Hi,', '', 'The validity of your <b>GPA</b> is expired. \r\nThis is an intimation mail. \r\nThe details of your <b>GPA</b> are given below:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(7, 'MAC-007', 'Post EC Exipry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Post Expiry of EC', 'Hi,', '', 'The validity of your <b>EC</b> is expired. \r\nThis is an intimation mail. \r\nThe details of your <b>EC</b> are given below:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(8, 'MAC-008', 'Post ISMW Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Post Expiry of ISMW', 'Hi,', '', 'The validity of your <b>ISMW</b> is expired. \r\nThis is an intimation mail. \r\nThe details of your <b>ISMW</b> are given below:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(9, 'MAC-009', 'Post Aggrement Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Post Expiry of Agreement', 'Hi,', '', 'The validity of your <b>Agreement</b> is expired. \r\nThis is an intimation mail. \r\nThe details of your <b>Agreement</b>are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-06-30', 1, '2019-02-07'),
(24, 'MAC-010', 'Pre Contract Period', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Pre Expiry of Contract Period', ' Hi,', '', 'The validity of your <b>Contract Period</b> is expiring. \r\nThis is a gentle reminder to renew your Agreement before the due date. \r\nThe details of your <b>Contract Period</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(25, 'MAC-011', 'Pre Contract Work Permit Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Pre Expiry of Contractor Work Permit', 'Hi,', '', 'The validity of your <b>Contract Work Permit</b> is expiring. \r\nThis is a gentle reminder to renew your Agreement before the due date. \r\nThe details of your <b>Contract Work Permit</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(26, 'MAC-012', 'Post Expiry of Contract Work Permit', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Post Expiry of Contract Period', 'Hi,', '', 'The validity of your <b>Contract Work Permit</b> is expired. \r\nThis is an intimation mail. \r\nThe details of your <b>Contract Work Permit</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(27, 'MAC-013', 'Pre License Expiry ', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Pre License Expiry', 'Hi,', '', 'The validity of your <b>License</b> is expiring. \r\nThis is a gentle reminder to renew your Agreement before the due date. \r\nThe details of your <b>License</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(28, 'MAC-014', 'Pre GPA Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Pre GPA Expiry', 'Hi,', '', 'The validity of your <b>GPA</b> is expiring. \r\nThis is a gentle reminder to renew your Agreement before the due date. \r\nThe details of your <b>GPA</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(29, 'MAC-015', 'Pre EC Expiry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Pre EC Expiry', 'Hi,', '', 'The validity of your <b>EC</b> is expiring. \r\nThis is a gentle reminder to renew your Agreement before the due date. \r\nThe details of your <b>EC</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(33, 'MAC-019', 'Unauthorized access in Gate Entry', 'sureshkumar.bathirappan@toshiba-tjps.in', 'sureshkumar.bathirappan@toshiba-tjps.in', ' ', 'Unauthorized access in Gate Entry', 'Hi,', '', 'The details of unauthorized access in gate entry on:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(34, 'MAC-020', 'Deviation in Creation of Contractor Master', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Deviation in Creation of Contractor Master', 'Hi,', '', 'The below contractor newly created with the following deviations.', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(35, 'MAC-021', 'Deviation in Creation of Contract Employee Master', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Deviation in Creation of Contract Employee Master', 'Hi,', '', 'The below contract employee newly created with the following deviations. Please login CLMS and approve the work permit request', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(30, 'MAC-016', 'Pre ISMW Expiry  ', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Pre ISMW Expiry', 'Hi,', '', 'The validity of your <b>ISMW</b> is expiring. \r\nThis is a gentle reminder to renew your Agreement before the due date. \r\nThe details of your <b>ISMW</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(32, 'MAC-018', 'Unauthorized access in Gate Entry of Previous Day', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Unauthorized access in Gate Entry of Previous Day', 'Hi,', '', 'The details of unauthorized access in gate entry on <b>Date</b> are given below:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(31, 'MAC-017', 'Pre Agreement Expiry  ', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Mail Alert for Pre Agreement Expiry', 'Hi,', '', 'The validity of your <b>Agreement</b> is expiring. \r\nThis is a gentle reminder to renew your Agreement before the due date. \r\nThe details of your <b>Agreement</b> are given below:\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(36, 'MAC-022', 'OT/Excess Hours Limit crossed above 75 hours per quarter', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'OT/Excess Hours Limit Crossed Above 75 Hours Per Quarter', 'Hi,', '', 'The below contract employee have crossed the Overtime Limit during the quarter July 17 To Sep17.', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(37, 'MAC-023', 'Alerts if there is a Person beyond 18 hours inside the Plant', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Alerts if there is a Person beyond 18 hours inside the Plant', 'Hi,', '', 'The below contract employee is working  beyond 18 Hours inside the factory.', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(38, 'MAC-024', 'Alerts if a Contract Employee works continuously for 9 days', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Alerts if a Contract Employee Works Continuously for 9 Days', 'Hi,', '', 'The below contract employees have been working continuously  for 9 days without availing a Weekly off.', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(39, 'MAC-025', 'Audit Compliance', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Audit Compliance For The Month', 'Hi,', '', 'Find the attachment of your Audit Compliance Report for the month of <b>Month</b>. \r\n\r\nWe have observed and recorded the Audit compliances status. Request you to go through the attached observations.\r\n\r\nYou are also requested to close the pending AUDIT NON COMPLIANCES within 3 working days after receipt of this mail.\r\n\r\nThe attached compliance report must be attached along with monthly Bills for HR clearance.\r\n', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '2017-07-01', 1, '2019-02-07'),
(40, 'MAC-026', 'Deviation Approval', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Deviation Approval', 'Hi,', '', 'The Below Mentioned Employee  has need Deviation Approval:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '', 1, '2019-02-07'),
(41, 'MAC-027', 'Holiday Deviation Approval', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', 'sureshkumar.bathirappan@toshiba-tjps.in', 'Holiday Deviation Approval', 'Hi,', '', 'The Below Mentioned Employee  has need Holiday Deviation Approval:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '', 1, '2019-02-07'),
(42, 'MAC-028', 'Work Permit Approval', 'sureshkumar.bathirappan@toshiba-tjps.in', 'vikraman@bluebase.in', ' ', 'Gate Entry Permit Approval', 'Hi,', '', 'The Below Mentioned Employee  has newly added and need Gate Entry permit  Approval:', 'Regards, \r\n\r\nToshiba HR Team', 0, 1, '', 1, '2019-02-07');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.menu_access_right`
--

DROP TABLE IF EXISTS `dbo.menu_access_right`;
CREATE TABLE IF NOT EXISTS `dbo.menu_access_right` (
  `id` smallint(6) DEFAULT NULL,
  `user_id` tinyint(4) DEFAULT NULL,
  `menu_id` tinyint(4) DEFAULT NULL,
  `submenu_id` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.menu_access_right`
--

INSERT INTO `dbo.menu_access_right` (`id`, `user_id`, `menu_id`, `submenu_id`, `created_by`, `created_on`) VALUES
(149, 1, 1, 1, 1, '2017-04-06 11:14:05'),
(150, 1, 2, 3, 1, '2017-04-06 11:14:05'),
(151, 1, 3, 5, 1, '2017-04-06 11:14:05'),
(152, 1, 3, 15, 1, '2017-04-06 11:14:05'),
(153, 1, 3, 16, 1, '2017-04-06 11:14:05'),
(154, 1, 3, 24, 1, '2017-04-06 11:14:05'),
(155, 1, 3, 25, 1, '2017-04-06 11:14:05'),
(156, 1, 3, 26, 1, '2017-04-06 11:14:05'),
(157, 1, 3, 27, 1, '2017-04-06 11:14:05'),
(158, 1, 3, 28, 1, '2017-04-06 11:14:05'),
(159, 1, 3, 6, 1, '2017-04-06 11:14:05'),
(160, 1, 3, 8, 1, '2017-04-06 11:14:05'),
(161, 1, 3, 9, 1, '2017-04-06 11:14:05'),
(162, 1, 3, 10, 1, '2017-04-06 11:14:05'),
(163, 1, 3, 11, 1, '2017-04-06 11:14:05'),
(164, 1, 3, 12, 1, '2017-04-06 11:14:05'),
(166, 1, 3, 14, 1, '2017-04-06 11:14:05'),
(167, 1, 4, 7, 1, '2017-04-06 11:14:05'),
(168, 1, 5, 17, 1, '2017-04-06 11:14:05'),
(169, 1, 5, 21, 1, '2017-04-06 11:14:05'),
(170, 1, 5, 22, 1, '2017-04-06 11:14:05'),
(171, 1, 5, 23, 1, '2017-04-06 11:14:05'),
(172, 1, 6, 18, 1, '2017-04-06 11:14:05'),
(173, 1, 6, 29, 1, '2017-04-06 11:14:05'),
(181, 1, 5, 35, 1, ''),
(175, 1, 7, 19, 1, '2017-04-06 11:14:05'),
(176, 1, 7, 20, 1, '2017-04-06 11:14:05'),
(177, 1, 8, 31, 1, '2017-04-06 11:14:05'),
(178, 1, 9, 32, 1, '2017-04-06 11:14:05'),
(32, 14, 8, 31, 1, ''),
(54, 16, 1, 1, 1, '2017-04-06 10:34:18'),
(55, 16, 2, 3, 1, '2017-04-06 10:34:18'),
(56, 16, 8, 31, 1, '2017-04-06 10:34:18'),
(179, 1, 5, 33, 1, ''),
(180, 1, 5, 34, 1, ''),
(182, 1, 5, 36, 1, ''),
(183, 1, 5, 37, 1, ''),
(184, 1, 5, 38, 1, ''),
(185, 1, 5, 39, 1, ''),
(186, 1, 5, 40, 1, ''),
(187, 1, 3, 41, 1, ''),
(188, 1, 3, 42, 1, ''),
(189, 1, 3, 43, 1, ''),
(190, 1, 10, 44, 1, ''),
(191, 17, 10, 44, 1, ''),
(192, 17, 8, 31, 1, ''),
(193, 1, 11, 45, 1, ''),
(194, 1, 12, 46, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.menu_items`
--

DROP TABLE IF EXISTS `dbo.menu_items`;
CREATE TABLE IF NOT EXISTS `dbo.menu_items` (
  `menu_item_id` varchar(0) DEFAULT NULL,
  `menu_item_code` varchar(0) DEFAULT NULL,
  `menu_item_name` varchar(0) DEFAULT NULL,
  `sub_menu_id` varchar(0) DEFAULT NULL,
  `menu_item_order` varchar(0) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.menu_master`
--

DROP TABLE IF EXISTS `dbo.menu_master`;
CREATE TABLE IF NOT EXISTS `dbo.menu_master` (
  `id` tinyint(4) DEFAULT NULL,
  `menu_code` varchar(24) DEFAULT NULL,
  `menu_name` varchar(24) DEFAULT NULL,
  `menu_description` varchar(24) DEFAULT NULL,
  `menu_order` tinyint(4) DEFAULT NULL,
  `menu_class` varchar(8) DEFAULT NULL,
  `menu_url` varchar(19) DEFAULT NULL,
  `m_class` varchar(18) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.menu_master`
--

INSERT INTO `dbo.menu_master` (`id`, `menu_code`, `menu_name`, `menu_description`, `menu_order`, `menu_class`, `menu_url`, `m_class`, `created_by`, `created_on`) VALUES
(5, 'Master', 'Master', 'Master', 5, 'treeview', '', 'fa fa-shirtsinbulk', 1, ''),
(1, 'Contractor Master', 'Contractor Master', 'Contractor Master', 1, '', '/Contractor/new.php', 'fa fa-file', 1, ''),
(2, 'Contract Employee Master', 'Contract Employee Master', 'Contract Employee Master', 2, '', '/MENU2/MENU2.php', 'fa fa-user-o', 1, ''),
(3, 'Reports', 'Reports', 'Reports', 3, 'treeview', '', 'fa fa-folder', 1, ''),
(4, 'Barcode', 'Barcode', 'Barcode', 4, 'treeview', '', 'fa fa-barcode', 1, ''),
(6, 'Holiday Request', 'Holiday Request', 'Holiday Request', 6, 'teeview', '', 'fa fa-folder', 1, ''),
(7, 'Audit Compliance', 'Audit Compliance', 'Audit Compliance', 7, 'treeview', '', 'fa fa-user-o', 1, ''),
(8, 'Change Password', 'Change Password', 'Change Password', 8, 'treeview', '', 'fa fa-futbol-o', 1, ''),
(9, 'Register', 'Register', '`Register', 9, 'treeview', '', 'fa fa-user-plus', 1, ''),
(10, 'Photo capture', 'Photo capture', 'Photo capture', 10, 'treeview', '', 'fa fa-file', 1, ''),
(11, 'Finger remove', 'Finger remove', 'Finger remove', 11, 'treeview', '', 'fa fa-folder', 1, ''),
(12, 'Workpermit Approve', 'Workpermit Approve', 'Workpermit Approve', 12, 'treeview', '', 'fa fa-thumbs-o-up', 1, ''),
(13, 'Form 18', 'Form 18', 'Form 18', 13, 'treeview', '', 'fa fa-user-o', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.nationality_master`
--

DROP TABLE IF EXISTS `dbo.nationality_master`;
CREATE TABLE IF NOT EXISTS `dbo.nationality_master` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(6) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.nationality_master`
--

INSERT INTO `dbo.nationality_master` (`id`, `name`, `created_by`, `created_on`) VALUES
(1, 'INDIAN', '', ''),
(2, 'EXPATS', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.occupier_master`
--

DROP TABLE IF EXISTS `dbo.occupier_master`;
CREATE TABLE IF NOT EXISTS `dbo.occupier_master` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `valid_from` varchar(10) DEFAULT NULL,
  `valid_to` varchar(10) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.occupier_master`
--

INSERT INTO `dbo.occupier_master` (`id`, `name`, `valid_from`, `valid_to`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Mr. Yoshiaki Inayama', '2017-11-10', '2020-09-06', 0, 1, '2017-11-10', '', '2017-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.otherdetail_master`
--

DROP TABLE IF EXISTS `dbo.otherdetail_master`;
CREATE TABLE IF NOT EXISTS `dbo.otherdetail_master` (
  `id` tinyint(4) DEFAULT NULL,
  `employeer_code` varchar(14) DEFAULT NULL,
  `reg_number` mediumint(9) DEFAULT NULL,
  `licence_number` varchar(8) DEFAULT NULL,
  `nature_of_industry` varchar(41) DEFAULT NULL,
  `corporation_ofce_address` varchar(6) DEFAULT NULL,
  `classification_code` varchar(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.otherdetail_master`
--

INSERT INTO `dbo.otherdetail_master` (`id`, `employeer_code`, `reg_number`, `licence_number`, `nature_of_industry`, `corporation_ofce_address`, `classification_code`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Insurance Code', 43446, 'TVR 9264', 'Manufacturing Steam Turbine and Generator', 'Addrss', 'Code', 0, 1, '2017-11-10', '', '2017-11-10');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.proofupload_master`
--

DROP TABLE IF EXISTS `dbo.proofupload_master`;
CREATE TABLE IF NOT EXISTS `dbo.proofupload_master` (
  `id` tinyint(4) DEFAULT NULL,
  `proof_name` varchar(12) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.proofupload_master`
--

INSERT INTO `dbo.proofupload_master` (`id`, `proof_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'AADHAAR CARD', 0, 1, '', '', ''),
(2, 'VOTER ID', 0, 1, '', '', ''),
(3, 'PAN CARD', 0, 1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.role_detail`
--

DROP TABLE IF EXISTS `dbo.role_detail`;
CREATE TABLE IF NOT EXISTS `dbo.role_detail` (
  `id` smallint(6) DEFAULT NULL,
  `code` varchar(8) DEFAULT NULL,
  `menu_id` tinyint(4) DEFAULT NULL,
  `submenu_id` varchar(2) DEFAULT NULL,
  `view_only` varchar(4) DEFAULT NULL,
  `edit_only` varchar(1) DEFAULT NULL,
  `all_only` varchar(1) DEFAULT NULL,
  `approval` varchar(1) DEFAULT NULL,
  `created_by` varchar(1) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(1) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.role_detail`
--

INSERT INTO `dbo.role_detail` (`id`, `code`, `menu_id`, `submenu_id`, `view_only`, `edit_only`, `all_only`, `approval`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'ROLE-001', 1, '1', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(2, 'ROLE-001', 1, '2', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(3, 'ROLE-001', 2, '3', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(4, 'ROLE-001', 2, '4', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(5, 'ROLE-001', 3, '5', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(6, 'ROLE-001', 3, '6', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(7, 'ROLE-001', 3, '8', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(8, 'ROLE-001', 3, '9', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(9, 'ROLE-001', 3, '10', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(10, 'ROLE-001', 3, '11', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(11, 'ROLE-001', 3, '12', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(12, 'ROLE-001', 3, '13', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(13, 'ROLE-001', 3, '14', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(14, 'ROLE-001', 3, '15', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(15, 'ROLE-001', 3, '16', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(16, 'ROLE-001', 3, '24', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(17, 'ROLE-001', 3, '25', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(18, 'ROLE-001', 3, '26', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(19, 'ROLE-001', 3, '27', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(20, 'ROLE-001', 3, '28', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(21, 'ROLE-001', 3, '41', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(22, 'ROLE-001', 3, '42', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(23, 'ROLE-001', 3, '43', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(24, 'ROLE-001', 5, '17', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(25, 'ROLE-001', 5, '21', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(26, 'ROLE-001', 5, '22', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(27, 'ROLE-001', 5, '23', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(28, 'ROLE-001', 5, '33', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(29, 'ROLE-001', 5, '34', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(30, 'ROLE-001', 5, '35', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(31, 'ROLE-001', 5, '36', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(32, 'ROLE-001', 5, '37', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(33, 'ROLE-001', 5, '38', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(34, 'ROLE-001', 5, '39', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(35, 'ROLE-001', 5, '40', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(47, 'ROLE-001', 1, '1', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(37, 'ROLE-001', 6, '18', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(38, 'ROLE-001', 6, '29', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(39, 'ROLE-001', 6, '30', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(40, 'ROLE-001', 7, '19', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(41, 'ROLE-001', 7, '20', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(42, 'ROLE-001', 8, '31', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(43, 'ROLE-001', 9, '32', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(44, 'ROLE-001', 10, '44', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(45, 'ROLE-001', 11, '45', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(46, 'ROLE-001', 12, '46', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(48, 'ROLE-002', 1, '2', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(49, 'ROLE-002', 2, '3', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(50, 'ROLE-002', 2, '4', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(51, 'ROLE-002', 3, '5', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(52, 'ROLE-002', 3, '6', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(53, 'ROLE-002', 3, '8', 'All', '0', '0', '1', '', '2017-10-23', '', '2017-10-23'),
(54, 'ROLE-002', 3, '9', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(55, 'ROLE-002', 3, '10', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(56, 'ROLE-002', 3, '11', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(57, 'ROLE-002', 3, '12', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(58, 'ROLE-002', 3, '13', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(59, 'ROLE-002', 3, '14', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(60, 'ROLE-002', 3, '15', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(61, 'ROLE-002', 3, '16', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(62, 'ROLE-002', 3, '24', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(63, 'ROLE-002', 3, '25', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(64, 'ROLE-002', 3, '26', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(65, 'ROLE-002', 3, '27', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(66, 'ROLE-002', 3, '28', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(67, 'ROLE-002', 3, '41', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(68, 'ROLE-002', 3, '42', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(69, 'ROLE-002', 3, '43', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(70, 'ROLE-002', 5, '17', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(71, 'ROLE-002', 5, '21', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(72, 'ROLE-002', 5, '22', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(73, 'ROLE-002', 5, '23', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(74, 'ROLE-002', 5, '33', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(75, 'ROLE-002', 5, '34', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(76, 'ROLE-002', 5, '35', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(77, 'ROLE-002', 5, '36', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(78, 'ROLE-002', 5, '37', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(79, 'ROLE-002', 5, '38', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(80, 'ROLE-002', 5, '39', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(81, 'ROLE-002', 5, '40', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(82, 'ROLE-002', 6, '18', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(83, 'ROLE-002', 6, '29', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(84, 'ROLE-002', 6, '30', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(85, 'ROLE-002', 7, '19', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(86, 'ROLE-002', 7, '20', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(87, 'ROLE-002', 8, '31', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(88, 'ROLE-002', 9, '32', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(89, 'ROLE-002', 10, '44', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(90, 'ROLE-002', 11, '45', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(91, 'ROLE-002', 12, '46', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(92, 'ROLE-002', 9, '47', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(93, 'ROLE-002', 9, '48', 'All', '0', '0', '1', '', '2017-10-24', '', '2017-10-24'),
(96, 'ROLE-003', 1, '1', 'All', '0', '0', '0', '1', '2017-10-24', '1', '2017-11-15'),
(97, 'ROLE-003', 1, '2', 'All', '0', '0', '0', '1', '2017-10-24', '', '2017-10-24'),
(98, 'ROLE-003', 2, '3', '', '0', '0', '0', '1', '2017-10-24', '1', '2017-11-15'),
(99, 'ROLE-003', 2, '4', '', '0', '0', '0', '1', '2017-10-24', '', '2017-10-24'),
(100, 'ROLE-003', 3, '5', 'All', '0', '0', '0', '1', '2017-10-24', '1', '2017-11-15'),
(101, 'ROLE-003', 3, '6', '', '0', '0', '0', '1', '2017-10-24', '1', '2017-11-15'),
(102, 'ROLE-003', 3, '8', '', '0', '0', '0', '1', '2017-10-24', '1', '2017-11-15'),
(103, 'ROLE-003', 3, '9', '', '0', '0', '0', '1', '2017-10-24', '1', '2017-11-15');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.role_mapping`
--

DROP TABLE IF EXISTS `dbo.role_mapping`;
CREATE TABLE IF NOT EXISTS `dbo.role_mapping` (
  `id` tinyint(4) DEFAULT NULL,
  `code` varchar(8) DEFAULT NULL,
  `user_id` varchar(18) DEFAULT NULL,
  `status` varchar(1) DEFAULT NULL,
  `created_by` varchar(1) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.role_mapping`
--

INSERT INTO `dbo.role_mapping` (`id`, `code`, `user_id`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'ROLE-001', '120287TJ', '0', '', '2017-10-23', '', '2017-10-23'),
(2, 'ROLE-002', '100070TJ', '', '', '2017-10-23', '', '2017-10-23'),
(3, 'ROLE-003', 'vikram', '0', '1', '2017-10-24', '', '2017-10-24'),
(4, 'ROLE-006', '100071TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(5, 'ROLE-004', '100042TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(6, 'ROLE-004', '110115TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(7, 'ROLE-004', '110170TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(8, 'ROLE-004', '120212TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(9, 'ROLE-008', '120226TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(10, 'ROLE-004', '120234TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(11, 'ROLE-004', '120240TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(12, 'ROLE-006', '140784TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(13, 'ROLE-004', 'E-00006', '0', '1', '2017-11-24', '', '2017-11-24'),
(14, 'ROLE-004', 'E-00030', '0', '1', '2017-11-24', '', '2017-11-24'),
(15, 'ROLE-005', '100043TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(16, 'ROLE-006', '110084TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(17, 'ROLE-005', '130383TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(18, 'ROLE-005', '140639TJ', '0', '1', '2017-11-24', '', '2017-11-24'),
(19, 'ROLE-007', '120274TJ', '0', '1', '2017-12-12', '', '2017-12-12'),
(20, 'ROLE-006', '100019TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(29, 'ROLE-008', 'K Venkatesan', '0', '1', '2018-02-10', '', '2018-02-10'),
(30, 'ROLE-008', '120318TJ', '0', '1', '2018-02-10', '', '2018-02-10'),
(31, 'ROLE-008', '100044TJ', '0', '1', '2018-02-10', '', '2018-02-10'),
(33, 'ROLE-008', '100058TJ', '0', '1', '2018-02-10', '', '2018-02-10'),
(34, 'ROLE-008', '100059TJ', '0', '1', '2018-02-10', '', '2018-02-10'),
(35, 'ROLE-008', '100067TJ', '0', '1', '2018-02-10', '', '2018-02-10'),
(36, 'ROLE-008', '110097TJ', '0', '1', '2018-02-10', '', '2018-02-10'),
(37, 'ROLE-008', '110101TJ', '0', '1', '2018-02-10', '', '2018-02-10'),
(38, 'ROLE-006', '110184TJ', '0', '1', '2018-02-15', '', '2018-02-15'),
(39, 'ROLE-009', '171107TJ', '0', '1', '2018-02-15', '', '2018-02-15'),
(40, 'ROLE-009', '150915TJ', '0', '1', '2018-02-15', '', '2018-02-15'),
(41, 'ROLE-010', 'Security', '0', '1', '2018-02-15', '', '2018-02-15'),
(42, 'ROLE-011', '176148TC', '0', '1', '2018-02-15', '', '2018-02-15'),
(43, 'ROLE-008', '120256TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(44, 'ROLE-008', '120257TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(45, 'ROLE-008', '120316TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(46, 'ROLE-008', '140834TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(47, 'ROLE-008', '120326TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(48, 'ROLE-008', '130367TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(49, 'ROLE-008', '110117TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(50, 'ROLE-008', '130408TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(51, 'ROLE-008', '140700TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(52, 'ROLE-008', '120307TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(53, 'ROLE-008', '120324TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(54, 'ROLE-008', '161061TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(56, 'ROLE-008', '130333TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(57, 'ROLE-008', '110146TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(58, 'ROLE-008', '110146TJ', '0', '1', '2018-09-17', '', '2018-09-17'),
(59, 'ROLE-005', 'Raghu Balakrishnan', '0', '1', '2018-12-13', '', '2018-12-13'),
(60, 'ROLE-010', 'CSO', '0', '1', '2018-12-13', '', '2018-12-13'),
(61, 'ROLE-005', '120305TJ', '0', '1', '2018-12-13', '', '2018-12-13'),
(62, 'ROLE-005', '191242TJ', '0', '1', '2019-04-23', '', '2019-04-23'),
(63, 'ROLE-005', '191242TJ', '0', '1', '2019-04-23', '', '2019-04-23'),
(64, 'ROLE-005', '191293TJ', '0', '1', '2019-10-17', '', '2019-10-17'),
(21, 'ROLE-006', '110085TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(22, 'ROLE-006', '110085TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(23, 'ROLE-006', '140809TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(24, 'ROLE-006', '140809TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(25, 'ROLE-006', '150927TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(26, 'ROLE-006', '150927TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(27, 'ROLE-006', '130401TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(28, 'ROLE-006', '130401TJ', '0', '1', '2018-01-31', '', '2018-01-31'),
(32, 'ROLE-008', '110189TJ', '0', '1', '2018-02-10', '', '2018-02-10'),
(55, 'ROLE-008', '120309TJ', '0', '1', '2018-09-17', '', '2018-09-17');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.role_master`
--

DROP TABLE IF EXISTS `dbo.role_master`;
CREATE TABLE IF NOT EXISTS `dbo.role_master` (
  `id` tinyint(4) DEFAULT NULL,
  `code` varchar(8) DEFAULT NULL,
  `role_name` varchar(15) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(1) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.role_master`
--

INSERT INTO `dbo.role_master` (`id`, `code`, `role_name`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'ROLE-001', 'ADMIN', 0, '', '2017-10-23', '', '2017-10-23'),
(2, 'ROLE-002', 'SUPER ADMIN', 0, '', '2017-10-23', '', '2017-10-23'),
(3, 'ROLE-003', 'TEST', 0, '1', '2017-10-24', '', '2017-10-24'),
(4, 'ROLE-004', 'USER', 0, '1', '2017-11-24', '', '2017-11-24'),
(5, 'ROLE-005', 'HSE', 0, '1', '2017-12-12', '', '2017-12-12'),
(6, 'ROLE-006', 'PROCURMENT', 0, '1', '2017-12-12', '', '2017-12-12'),
(9, 'ROLE-009', 'CLMS WORKPERMIT', 0, '1', '2018-02-15', '', '2018-02-15'),
(10, 'ROLE-010', 'SECURITY', 0, '1', '2018-02-15', '', '2018-02-15'),
(11, 'ROLE-011', 'CLMS INITIATOR', 0, '1', '2018-02-15', '', '2018-02-15'),
(7, 'ROLE-007', 'CSO', 0, '1', '2017-12-12', '', '2017-12-12'),
(8, 'ROLE-008', 'PFM', 0, '1', '2017-12-12', '', '2017-12-12');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.safety`
--

DROP TABLE IF EXISTS `dbo.safety`;
CREATE TABLE IF NOT EXISTS `dbo.safety` (
  `id` mediumint(9) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `employee_code` varchar(8) DEFAULT NULL,
  `safety_date` varchar(10) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(10) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.safety`
--

INSERT INTO `dbo.safety` (`id`, `contractor_code`, `employee_code`, `safety_date`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CON-045', 'EMP-001', '2017-12-07', 1, '2017-12-07', '', ''),
(2, 'CON-045', 'EMP-413', '2017-12-07', 1, '2017-12-07', '', ''),
(3, 'CON-065', 'EMP-726', '2017-12-07', 1, '2017-12-07', '', ''),
(4, 'CON-065', 'EMP-725', '2017-12-07', 1, '2017-12-07', '', ''),
(5, 'CON-045', 'EMP-737', '2017-12-08', 1, '2017-12-08', '', ''),
(6, 'CON-045', 'EMP-736', '2017-12-08', 1, '2017-12-08', '', ''),
(34, 'CON-002', 'EMP-116', '2017-12-19', 33, '2017-12-19', '', ''),
(35, 'CON-002', 'EMP-118', '2017-12-19', 33, '2017-12-19', '', ''),
(36, 'CON-002', 'EMP-102', '2017-12-19', 33, '2017-12-19', '', ''),
(37, 'CON-002', 'EMP-632', '2017-12-19', 33, '2017-12-19', '', ''),
(48, 'CON-062', 'EMP-695', '2017-12-19', 33, '2017-12-19', '', ''),
(49, 'CON-062', 'EMP-696', '2017-12-19', 33, '2017-12-19', '', ''),
(50, 'CON-066', 'EMP-729', '2017-12-19', 33, '2017-12-19', '', ''),
(51, 'CON-066', 'EMP-728', '2017-12-19', 33, '2017-12-19', '', ''),
(52, 'CON-011', 'EMP-637', '2017-12-19', 33, '2017-12-19', '', ''),
(53, 'CON-011', 'EMP-636', '2017-12-19', 33, '2017-12-19', '', ''),
(54, 'CON-047', 'EMP-612', '2017-12-19', 33, '2017-12-19', '', ''),
(55, 'CON-021', 'EMP-681', '2017-12-19', 33, '2017-12-19', '', ''),
(56, 'CON-021', 'EMP-720', '2017-12-19', 33, '2017-12-19', '', ''),
(57, 'CON-021', 'EMP-721', '2017-12-19', 33, '2017-12-19', '', ''),
(58, 'CON-021', 'EMP-676', '2017-12-19', 33, '2017-12-19', '', ''),
(59, 'CON-021', 'EMP-685', '2017-12-19', 33, '2017-12-19', '', ''),
(60, 'CON-021', 'EMP-686', '2017-12-19', 33, '2017-12-19', '', ''),
(61, 'CON-021', 'EMP-694', '2017-12-19', 33, '2017-12-19', '', ''),
(62, 'CON-015', 'EMP-678', '2017-12-19', 33, '2017-12-19', '', ''),
(63, 'CON-015', 'EMP-679', '2017-12-19', 33, '2017-12-19', '', ''),
(64, 'CON-015', 'EMP-680', '2017-12-19', 33, '2017-12-19', '', ''),
(65, 'CON-051', 'EMP-731', '2017-12-19', 33, '2017-12-19', '', ''),
(66, 'CON-047', 'EMP-611', '2017-12-19', 33, '2017-12-19', '', ''),
(67, 'CON-021', 'EMP-482', '2017-12-19', 33, '2017-12-19', '', ''),
(68, 'CON-021', 'EMP-521', '2017-12-19', 33, '2017-12-19', '', ''),
(69, 'CON-021', 'EMP-473', '2017-12-19', 33, '2017-12-19', '', ''),
(70, 'CON-021', 'EMP-474', '2017-12-19', 33, '2017-12-19', '', ''),
(71, 'CON-021', 'EMP-475', '2017-12-19', 33, '2017-12-19', '', ''),
(72, 'CON-021', 'EMP-476', '2017-12-19', 33, '2017-12-19', '', ''),
(73, 'CON-021', 'EMP-477', '2017-12-19', 33, '2017-12-19', '', ''),
(74, 'CON-021', 'EMP-478', '2017-12-19', 33, '2017-12-19', '', ''),
(75, 'CON-021', 'EMP-479', '2017-12-19', 33, '2017-12-19', '', ''),
(76, 'CON-021', 'EMP-480', '2017-12-19', 33, '2017-12-19', '', ''),
(77, 'CON-021', 'EMP-481', '2017-12-19', 33, '2017-12-19', '', ''),
(78, 'CON-021', 'EMP-483', '2017-12-19', 33, '2017-12-19', '', ''),
(79, 'CON-021', 'EMP-484', '2017-12-19', 33, '2017-12-19', '', ''),
(80, 'CON-021', 'EMP-485', '2017-12-19', 33, '2017-12-19', '', ''),
(81, 'CON-021', 'EMP-486', '2017-12-19', 33, '2017-12-19', '', ''),
(82, 'CON-021', 'EMP-488', '2017-12-19', 33, '2017-12-19', '', ''),
(83, 'CON-021', 'EMP-489', '2017-12-19', 33, '2017-12-19', '', ''),
(84, 'CON-021', 'EMP-490', '2017-12-19', 33, '2017-12-19', '', ''),
(85, 'CON-021', 'EMP-491', '2017-12-19', 33, '2017-12-19', '', ''),
(86, 'CON-021', 'EMP-493', '2017-12-19', 33, '2017-12-19', '', ''),
(87, 'CON-021', 'EMP-494', '2017-12-19', 33, '2017-12-19', '', ''),
(88, 'CON-021', 'EMP-495', '2017-12-19', 33, '2017-12-19', '', ''),
(89, 'CON-015', 'EMP-544', '2017-12-19', 33, '2017-12-19', '', ''),
(90, 'CON-015', 'EMP-545', '2017-12-19', 33, '2017-12-19', '', ''),
(92, 'CON-005', 'EMP-135', '2017-12-19', 33, '2017-12-19', '', ''),
(93, 'CON-005', 'EMP-136', '2017-12-19', 33, '2017-12-19', '', ''),
(94, 'CON-005', 'EMP-137', '2017-12-19', 33, '2017-12-19', '', ''),
(95, 'CON-005', 'EMP-139', '2017-12-19', 33, '2017-12-19', '', ''),
(96, 'CON-056', 'EMP-599', '2017-12-19', 33, '2017-12-19', '', ''),
(97, 'CON-057', 'EMP-614', '2017-12-19', 33, '2017-12-19', '', ''),
(98, 'CON-057', 'EMP-613', '2017-12-19', 33, '2017-12-19', '', ''),
(99, 'CON-015', 'EMP-562', '2017-12-19', 33, '2017-12-19', '', ''),
(100, 'CON-015', 'EMP-563', '2017-12-19', 33, '2017-12-19', '', ''),
(101, 'CON-021', 'EMP-492', '2017-12-19', 33, '2017-12-19', '', ''),
(102, 'CON-015', 'EMP-555', '2017-12-19', 33, '2017-12-19', '', ''),
(103, 'CON-015', 'EMP-600', '2017-12-19', 33, '2017-12-19', '', ''),
(104, 'CON-015', 'EMP-602', '2017-12-19', 33, '2017-12-19', '', ''),
(105, 'CON-015', 'EMP-601', '2017-12-19', 33, '2017-12-19', '', ''),
(106, 'CON-053', 'EMP-520', '2017-12-19', 33, '2017-12-19', '', ''),
(107, 'CON-011', 'EMP-430', '2017-12-19', 33, '2017-12-19', '', ''),
(108, 'CON-011', 'EMP-431', '2017-12-19', 33, '2017-12-19', '', ''),
(109, 'CON-011', 'EMP-432', '2017-12-19', 33, '2017-12-19', '', ''),
(110, 'CON-011', 'EMP-433', '2017-12-19', 33, '2017-12-19', '', ''),
(111, 'CON-011', 'EMP-419', '2017-12-19', 33, '2017-12-19', '', ''),
(112, 'CON-015', 'EMP-533', '2017-12-19', 33, '2017-12-19', '', ''),
(113, 'CON-015', 'EMP-539', '2017-12-19', 33, '2017-12-19', '', ''),
(114, 'CON-015', 'EMP-541', '2017-12-19', 33, '2017-12-19', '', ''),
(115, 'CON-015', 'EMP-756', '2017-12-19', 33, '2017-12-19', '', ''),
(116, 'CON-015', 'EMP-572', '2017-12-19', 33, '2017-12-19', '', ''),
(117, 'CON-015', 'EMP-573', '2017-12-19', 33, '2017-12-19', '', ''),
(118, 'CON-015', 'EMP-651', '2017-12-19', 33, '2017-12-19', '', ''),
(119, 'CON-018', 'EMP-576', '2017-12-19', 33, '2017-12-19', '', ''),
(120, 'CON-018', 'EMP-585', '2017-12-19', 33, '2017-12-19', '', ''),
(121, 'CON-015', 'EMP-537', '2017-12-19', 33, '2017-12-19', '', ''),
(122, 'CON-015', 'EMP-547', '2017-12-19', 33, '2017-12-19', '', ''),
(123, 'CON-015', 'EMP-548', '2017-12-19', 33, '2017-12-19', '', ''),
(124, 'CON-015', 'EMP-549', '2017-12-19', 33, '2017-12-19', '', ''),
(125, 'CON-015', 'EMP-551', '2017-12-19', 33, '2017-12-19', '', ''),
(126, 'CON-015', 'EMP-552', '2017-12-19', 33, '2017-12-19', '', ''),
(127, 'CON-015', 'EMP-554', '2017-12-19', 33, '2017-12-19', '', ''),
(128, 'CON-015', 'EMP-556', '2017-12-19', 33, '2017-12-19', '', ''),
(129, 'CON-015', 'EMP-558', '2017-12-19', 33, '2017-12-19', '', ''),
(130, 'CON-015', 'EMP-559', '2017-12-19', 33, '2017-12-19', '', ''),
(131, 'CON-015', 'EMP-560', '2017-12-19', 33, '2017-12-19', '', ''),
(132, 'CON-015', 'EMP-561', '2017-12-19', 33, '2017-12-19', '', ''),
(133, 'CON-050', 'EMP-044', '2017-12-19', 33, '2017-12-19', '', ''),
(134, 'CON-050', 'EMP-045', '2017-12-19', 33, '2017-12-19', '', ''),
(135, 'CON-050', 'EMP-046', '2017-12-19', 33, '2017-12-19', '', ''),
(136, 'CON-050', 'EMP-049', '2017-12-19', 33, '2017-12-19', '', ''),
(137, 'CON-046', 'EMP-074', '2017-12-19', 33, '2017-12-19', '', ''),
(138, 'CON-046', 'EMP-083', '2017-12-19', 33, '2017-12-19', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.shift_master`
--

DROP TABLE IF EXISTS `dbo.shift_master`;
CREATE TABLE IF NOT EXISTS `dbo.shift_master` (
  `shift_id` tinyint(4) DEFAULT NULL,
  `shift_code` varchar(50) DEFAULT NULL,
  `session1_from_time` varchar(8) DEFAULT NULL,
  `session1_to_time` varchar(8) DEFAULT NULL,
  `session2_from_time` varchar(8) DEFAULT NULL,
  `session2_to_time` varchar(8) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL,
  `created_by` varchar(1) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.shift_master`
--

INSERT INTO `dbo.shift_master` (`shift_id`, `shift_code`, `session1_from_time`, `session1_to_time`, `session2_from_time`, `session2_to_time`, `status`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(1, 'Shift A                                           ', '07:00:00', '11:30:00', '12:00:00', '15:30:00', 0, '', '', '', ''),
(2, 'Shift B                                           ', '15:30:00', '19:30:00', '20:00:00', '23:59:00', 0, '', '1', '', ''),
(3, 'General-Corp                                      ', '08:00:00', '12:30:00', '13:00:00', '17:30:00', 0, '', '1', '', ''),
(5, 'General-Plant                                     ', '08:00:00', '12:00:00', '12:45:00', '16:45:00', 0, '', '1', '', ''),
(6, 'General-G1                                        ', '09:00:00', '13:00:00', '13:30:00', '18:00:00', 0, '', '1', '', ''),
(7, 'Shift-A1                                          ', '06:00:00', '11:30:00', '12:00:00', '15:00:00', 0, '', '1', '', ''),
(8, 'Shift-C                                           ', '23:59:00', '03:00:00', '03:30:00', '07:00:00', 0, '', '1', '', ''),
(9, 'Others                                            ', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '1', '', ''),
(10, '                                                  ', '00:00:00', '00:00:00', '00:00:00', '00:00:00', 0, '', '1', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.shift_roaster`
--

DROP TABLE IF EXISTS `dbo.shift_roaster`;
CREATE TABLE IF NOT EXISTS `dbo.shift_roaster` (
  `date` varchar(0) DEFAULT NULL,
  `shift_id` varchar(0) DEFAULT NULL,
  `emp_id` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.sms_log`
--

DROP TABLE IF EXISTS `dbo.sms_log`;
CREATE TABLE IF NOT EXISTS `dbo.sms_log` (
  `id` tinyint(4) DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `message` varchar(15) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `send_date` varchar(21) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.sms_log`
--

INSERT INTO `dbo.sms_log` (`id`, `mobile_no`, `message`, `status`, `send_date`) VALUES
(1, 8608401612, 'Hai', 0, '2017-05-17 06:05:09am'),
(2, 8608401612, 'test', 0, '2017-05-18 02:05:39am'),
(3, 8608401612, '31/05/2017 test', 0, '2017-05-31 08:05:08am'),
(4, 8608401612, 'test', 0, '2017-06-02 10:06:29am'),
(5, 7708036648, 'test bulk sms', 0, '2017-06-14 04:06:56am'),
(6, 7708036648, 'sdfvfdb', 0, '2017-06-14 04:06:11am'),
(7, 7708036648, 'Test Bulk SMS', 0, '2017-06-14 05:06:43am'),
(8, 7708036648, 'test Bluek SMS', 0, '2017-06-14 05:06:44am');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.submenu_master`
--

DROP TABLE IF EXISTS `dbo.submenu_master`;
CREATE TABLE IF NOT EXISTS `dbo.submenu_master` (
  `id` tinyint(4) DEFAULT NULL,
  `submenu_code` varchar(25) DEFAULT NULL,
  `submenu_order` tinyint(4) DEFAULT NULL,
  `menu_id` tinyint(4) DEFAULT NULL,
  `submenu_class` varchar(12) DEFAULT NULL,
  `submenu_url` varchar(31) DEFAULT NULL,
  `created_by` varchar(1) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.submenu_master`
--

INSERT INTO `dbo.submenu_master` (`id`, `submenu_code`, `submenu_order`, `menu_id`, `submenu_class`, `submenu_url`, `created_by`, `created_on`) VALUES
(1, 'New Contractor Master', 1, 1, 'fa fa-laptop', '/Contractor/new.php', '1', ''),
(50, 'Form 18 Entry', 1, 13, 'fa fa-laptop', '/setting/accident.php', '1', ''),
(3, 'New Employee Master', 1, 2, 'fa fa-laptop', '/Employee/new.php', '1', ''),
(51, 'Form 18 Print', 2, 13, 'fa fa-laptop', '/setting/form18print.php', '', ''),
(5, 'Contractor Master Reports', 1, 3, 'fa fa-laptop', '/Reports/creports.php', '1', ''),
(6, 'Employee Reports', 2, 3, 'fa fa-laptop', '/Reports/ereports.php', '1', ''),
(7, 'IN', 1, 4, 'fa fa-laptop', '/Barcode/barcode_in.php', '1', ''),
(8, 'Manpower Report', 3, 3, 'fa fa-laptop', '/Reports/manpowerreports.php', '1', ''),
(9, 'Attendance Report', 4, 3, 'fa fa-laptop', '/Reports/attendancereport.php', '1', ''),
(10, 'Manhour Reports', 5, 3, 'fa fa-laptop', '/Reports/manhourreports.php', '1', ''),
(11, 'Contractor Attendance', 6, 3, 'fa fa-laptop', '/Reports/contractattendance.php', '1', ''),
(12, 'In-Out Report', 7, 3, 'fa fa-laptop', '/Reports/inoutreport.php', '1', ''),
(13, 'Holiday Reports', 8, 3, 'fa fa-laptop', '/Reports/holidayreports.php', '1', ''),
(14, 'Over time Reports', 9, 3, 'fa fa-laptop', '/Reports/overtimereports.php', '1', ''),
(15, 'Deviation Report Contract', 10, 3, 'fa fa-laptop', '/Reports/devitationreport.php', '1', ''),
(16, 'Deviation Report employee', 11, 3, 'fa fa-laptop', '/Reports/devitionemp.php', '1', ''),
(17, 'Shift Master', 1, 5, 'fa fa-laptop', '/Master/shift.php', '1', ''),
(18, 'Holiday Allocation', 1, 6, 'fa fa-laptop', '/Holiday/allocation.php', '1', ''),
(19, 'Compliance Entry', 1, 7, 'fa fa-laptop', '/Audit/entry.php', '1', ''),
(20, 'Compliance Report', 2, 7, 'fa fa-laptop', '/Audit/report.php', '1', ''),
(21, 'Department Master', 2, 5, 'fa fa-laptop', '/Master/dep.php', '1', ''),
(22, 'Designation Master', 3, 5, 'fa fa-laptop', '/Master/desg.php', '1', ''),
(23, 'Area Master', 4, 5, 'fa fa-laptop', '/Master/area.php', '1', ''),
(24, 'Log Report', 12, 3, 'fa fa-laptop', '/Reports/logreport.php', '1', ''),
(25, 'Contractor Status', 13, 3, 'fa fa-laptop', '/Reports/constatus.php', '1', ''),
(26, 'Employee Status', 14, 3, 'fa fa-laptop', '/Reports/empstatus.php', '1', ''),
(27, 'Work Permit Report', 15, 3, 'fa fa-laptop', '/Reports/workpermitreport.php', '1', ''),
(28, 'Daily In-Out Report', 16, 3, 'fa fa-laptop', '/Reports/dailyinoutreport.php', '1', ''),
(29, 'Holiday Upload', 2, 6, 'fa fa-laptop', '/Holiday/holidayupload.php', '1', ''),
(30, 'View Holiday', 3, 6, 'fa fa-laptop', '/Holiday/holidayview.php', '1', ''),
(31, 'Change Password', 1, 8, 'fa fa-laptop', '/change_password/change.php', '1', ''),
(32, 'User Registration', 1, 9, 'fa fa-laptop', '/login/register.php', '1', ''),
(33, 'Bulk SMS', 5, 5, 'fa fa-laptop', '/Master/bulksms.php', '1', ''),
(34, 'Bulk Mail', 6, 5, 'fa fa-laptop', '/Master/bulkmail.php', '1', ''),
(35, 'Proof Upload', 7, 5, 'fa fa-laptop', '/Master/proofupload.php', '1', ''),
(36, 'SMS Group Upload', 9, 5, 'fa fa-laptop', '/Master/groupupload.php', '1', ''),
(37, 'SMS Group Master', 8, 5, 'fa fa-laptop', '/Master/groupmaster.php', '1', ''),
(38, 'Mail Group Upload', 11, 5, 'fa fa-laptop', '/Master/mailgroupupload.php', '1', ''),
(39, 'Mail Group Master', 10, 5, 'fa fa-laptop', '/Master/mailgroupmaster.php', '1', ''),
(40, 'Mail Master', 12, 5, 'fa fa-laptop', '/Master/mailmaster.php', '1', ''),
(41, 'Contractor Block List', 17, 3, 'fa fa-laptop', '/Reports/conblocklist.php', '1', ''),
(42, 'Employee Block List', 18, 3, 'fa fa-laptop', '/Reports/empblocklist.php', '1', ''),
(43, 'Late Commers Report', 19, 3, 'fa fa-laptop', '/Reports/late.php', '1', ''),
(44, 'Capture Photo', 1, 10, 'fa fa-laptop', '/Photo/photo.php', '1', ''),
(45, 'Remove Finger', 1, 11, 'fa fa-laptop', '/finger/reportview.php', '1', ''),
(46, 'Approve', 1, 12, 'fa fa-laptop', '/Approve/workpermit_approve.php', '1', ''),
(47, 'Role Master', 2, 9, 'fa fa-laptop', '/role/role.php', '1', ''),
(48, 'Role Mapping', 3, 9, 'fa fa-laptop', '/role/rolemapping.php', '1', ''),
(49, 'Approval Report', 2, 12, 'fa fa-laptop', '/Approve/report.php', '', ''),
(52, 'Occupier Master', 3, 13, 'fa fa-laptop', '/setting/occupier.php', '', ''),
(53, 'Other Master', 4, 13, 'fa fa-laptop', '/setting/otherdetail.php', '', ''),
(54, 'Address Master', 5, 13, 'fa fa-laptop', '/setting/address.php', '', ''),
(55, 'Upload', 3, 7, 'fa fa-laptop', '/Audit/audit_upload.php', '', ''),
(56, 'Upload', 2, 2, 'fa fa-laptop', '/Employee/empupload.php', '', ''),
(57, 'Status Report', 3, 12, 'fa fa-laptop', '/Reports/status_report.php', '1', ''),
(62, 'Blood Group Mater', 11, 5, 'fa fa-laptop', '/Master/bloodmaster.php', '1', ''),
(58, 'Safety Induction', 3, 2, 'fa fa-laptop', '/safety/safety.php', '1', ''),
(59, 'Safety Report', 4, 2, 'fa fa-laptop', '/Reports/safety_report.php', '1', ''),
(61, 'Holiday Approval Report', 4, 12, 'fa fa-laptop', '/Approve/h_report.php', '', ''),
(60, 'Out', 2, 4, 'fa fa-laptop', '/Barcode/barcode_out.php', '1', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.sub_law_master`
--

DROP TABLE IF EXISTS `dbo.sub_law_master`;
CREATE TABLE IF NOT EXISTS `dbo.sub_law_master` (
  `sub_law_id` tinyint(4) DEFAULT NULL,
  `law_id` tinyint(4) DEFAULT NULL,
  `sub_law_name` varchar(77) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.sub_law_master`
--

INSERT INTO `dbo.sub_law_master` (`sub_law_id`, `law_id`, `sub_law_name`, `status`) VALUES
(1, 1, 'Form XXVI - Register of Employment of Contract Labour ', 0),
(2, 1, 'Form XXVII - Register of Wages ', 0),
(3, 1, 'Form XXVIII - Wage Slip', 0),
(4, 1, 'Form XXIX - Register of Advances, Deduction for Damages and Loss, Fines  ', 0),
(5, 1, 'Half yearly return in Form XXIV for HYE 31-12', 0),
(6, 1, 'Wage Register signed / attested by Principal Employer / Ackn. Transfer letter', 0),
(7, 2, 'Form VI - Register of N/F Holidays ', 0),
(8, 2, 'Whether N/F Holidays allowed with wages', 0),
(9, 3, 'Service Card Form No.25-B', 0),
(10, 3, 'Leave Register', 0),
(11, 3, 'Working hours including OT  - Whether according to the Act', 0),
(12, 3, 'Extra wages for OT - Whether paid as per Act', 0),
(13, 4, 'Deductions from wages - Whether made as per law', 0),
(14, 5, 'Form IV - OT Register', 0),
(15, 5, 'Whether minimum wages are paid', 0),
(16, 6, 'Bonus Paid Register in Form C. for the period 1/4/ to 31/3/', 0),
(17, 6, 'Annual Returns in Form D to be submitted before 30.12.', 0),
(18, 7, 'PF monthly Contribution Challan\nRemittance Confirmation Slip (RCS)', 0),
(19, 7, 'ECR \nHighligting site employees\' names ', 0),
(20, 8, 'ESI Monthly Contribution Challan', 0),
(21, 8, 'Contribution History printout highlighting site employees\' names', 0),
(22, 8, 'TIC / PIC of site employees', 0),
(23, 8, 'Form 11 - Accident Book', 0),
(24, 9, 'WC Act policy', 0),
(25, 10, 'Remittance of Labour Welfare Fund for the year 2013', 0),
(26, 11, 'Remittance of Profession Tax for 1st or 2nd HYE', 0),
(27, 12, 'Legal compliance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `dbo.thosiba_employee_master`
--

DROP TABLE IF EXISTS `dbo.thosiba_employee_master`;
CREATE TABLE IF NOT EXISTS `dbo.thosiba_employee_master` (
  `id` smallint(6) DEFAULT NULL,
  `thosiba_emp_code` varchar(10) DEFAULT NULL,
  `thosiba_emp_department` varchar(48) DEFAULT NULL,
  `thosiba_emp_name` varchar(44) DEFAULT NULL,
  `mobile` varchar(12) DEFAULT NULL,
  `mail` varchar(49) DEFAULT NULL,
  `head_code` varchar(10) DEFAULT NULL,
  `head_name` varchar(43) DEFAULT NULL,
  `head_dep` varchar(48) DEFAULT NULL,
  `head_mail` varchar(44) DEFAULT NULL,
  `head_mobile` varchar(12) DEFAULT NULL,
  `toshiba_emp_des` varchar(70) DEFAULT NULL,
  `costcenter` varchar(49) DEFAULT NULL,
  `head_des` varchar(55) DEFAULT NULL,
  `permanent_address` varchar(114) DEFAULT NULL,
  `present_address` varchar(86) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `office_number` varchar(0) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.thosiba_employee_master`
--

INSERT INTO `dbo.thosiba_employee_master` (`id`, `thosiba_emp_code`, `thosiba_emp_department`, `thosiba_emp_name`, `mobile`, `mail`, `head_code`, `head_name`, `head_dep`, `head_mail`, `head_mobile`, `toshiba_emp_des`, `costcenter`, `head_des`, `permanent_address`, `present_address`, `blood_group`, `office_number`, `grade`) VALUES
(1, '130409TJ', 'Manufacturing', 'Udhayakumar M', '9843717038', 'Santhoshkumar.Ramakrishna@toshiba-tjps.in', '100021TJ', 'Santhoshkumar M V', 'Manufacturing', 'Santhoshkumar.Ramakrishna@toshiba-tjps.in', '9962461101', 'Team Member - Welding', 'Large Fabrication  - 360511', 'Manager - Fabrication  for LP Casing', '', '', '', '', ''),
(2, '110145TJ', 'Manufacturing', 'Hareesh', '9994349268', 'hareesh.alijan@toshiba-tjps.in', '100046TJ', 'Satish Kumar K', 'Manufacturing', 'SatishKumar.Kandaswamy@toshiba-tjps.in', '7299298225', 'Engineer - Valve Assembly ', 'Control Device - 360231', 'Associate Manager - Assembly', '', '', '', '', ''),
(3, '110184TJ', 'Procurement Department ( Chennai )', 'Mohamed Asik  M', '8754577252', 'Mohamedasik.Iqbal@toshiba-tjps.in', '100071TJ', 'Nandakumar L', 'Procurement Department ( Chennai )', 'Nandakumar.Lingadas@toshiba-tjps.in', '9677251313', 'Senior Engineer - Procurement ', 'Procurement Group (Chennai) - 340211', 'Associate Manager - Procurement', '', '', '', '', ''),
(4, '110188TJ', 'Manufacturing', 'Gurumoorthy R', '9750142432', 'Selvaraj.Jayaram@toshiba-tjps.in', '100032TJ', 'Selvaraj J', 'Manufacturing', 'Selvaraj.Jayaram@toshiba-tjps.in', '9789833976', 'Senior Team Member  - Welding for Nozzle', 'Fabrication - 360331', 'Assistant Manager - Welding ', '', '', '', '', ''),
(5, '130336TJ', 'Manufacturing', 'Deva Sivakumar C', '', 'devanesan.chakkaraverthi@toshiba-tjps.in', '140764TJ', 'Devanesan  C', 'Manufacturing', 'devanesan.chakkaraverthi@toshiba-tjps.in', '9940218547', 'Senior Team Member - Machining for Nozzle', 'Nozzle diaphragm machining - 360321', 'Assistant Engineer - Large Machining', '', '', '', '', ''),
(6, '090003TJ', 'Human Resources & General Affairs Department', 'Praveena', '9840910413', 'Praveena.Gokul@toshiba-tjps.in', '100070TJ', 'Ankireddy  Hari Mohan Reddy', 'Human Resources & General Affairs Department', 'Harimohan.Ramachandra@toshiba-tjps.in', '', 'Senior Executive - Administration', 'General Affairs Group ( Chennai ) - 110211', 'Manager - HR & Administration ', '', '', '', '', ''),
(7, '090004TJ', 'Information System Department', 'Muruganand', '', 'muruganand.ramalingam@toshiba-tjps.in', '120240TJ', 'Moses  Savarimuthu', 'Information System Department', 'Moses.Savarimuthu@toshiba-tjps.in', '8754447460', 'Senior Manager - MIS', 'Information System Group ( Chennai ) - 220311', 'General Manager - MIS', '', '', '', '', ''),
(8, '090010TJ', 'Manufacturing Engineering', 'Manoharan P', '9940371822', 'Manoharan.Palamuthu@toshiba-tjps.in', '110200TJ', 'Manish  Verma', 'Manufacturing Engineering', 'Manish.RamkumarVerma@toshiba-tjps.in', '8754448175', 'Assistant Manager - Machining for Diaphragm', 'Nozzle Diaphragm Machining - 360122', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(9, '090011TJ', 'Manufacturing', 'P Kumaravel', '9626949624', 'Kumaravel.Padavettan@toshiba-tjps.in', '120212TJ', 'Kumar Mysore Narasimhanna', 'Manufacturing', 'Kumar.Narasimhanna@toshiba-tjps.in', '8754570665', 'Senior Manager - Machining', 'Rotor machining - 360431', 'General Manager - Manufacturing ', '', '', '', '', ''),
(10, '090012TJ', 'Manufacturing Engineering', 'Praveen Kumar K', '8754488878', 'PraveenKumar.Kusuma@toshiba-tjps.in', '120212TJ', 'Kumar Mysore Narasimhanna', 'Manufacturing Engineering', 'Kumar.Narasimhanna@toshiba-tjps.in', '8754570665', 'Deputy Manager - Holding Fixtures', 'Tool Engineering - 360124', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(11, '090015TJ', 'Manufacturing Engineering', 'Sasikumar M', '9791372370', 'Sasikumar.Muniappan@toshiba-tjps.in', '110200TJ', 'Manish  Verma', 'Manufacturing Engineering', 'Manish.RamkumarVerma@toshiba-tjps.in', '8754448175', 'Assistant Manager - Machining for Diaphragm', 'Blade and partition machining - 360121', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(495, '3000926', 'Construction & Maintenance', 'kasiraman ', '', 'kasiraman.aravamudhan@toshiba-tjps.in', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(12, '090018TJ', 'Manufacturing Engineering', 'Karthikeyan M', '9003750486', 'Karthikeyan.Muniapillai@toshiba-tjps.in', '110200TJ', 'Manish  Verma', 'Manufacturing Engineering', 'Manish.RamkumarVerma@toshiba-tjps.in', '8754448175', 'Associate Manager - Holding Fixtures', 'Tool Engineering - 360124', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(13, '100019TJ', 'Procurement Department ( Chennai )', 'Dinesh J Shetty', '9962468145', 'Dinesh.Shetty@toshiba-tjps.in', '140784TJ', 'Shafiqur Rahman', 'Procurement Department ( Chennai )', 'shafiqur.rahman@toshiba-tjps.in', '9902625102', 'Senior Manager - Procurement', 'Procurement Development Group (Chennai) - 340111', 'General Manager', '', '', '', '', ''),
(14, '100020TJ', 'Production Management', 'Kannan S', '9715274785', 'Kannan.Sankaran@toshiba-tjps.in', '120234TJ', 'P A Kamesh Varagunan', 'Production Management', 'Kameswaran.Palanichamy@toshiba-tjps.in', '7299077254', 'Assistant Manager - Machining for Gantry Miller', 'Production Management Department - 330911', 'General Manager - Production Management ', '', '', '', '', ''),
(15, '100021TJ', 'Manufacturing', 'Santhoshkumar M V', '9962461101', 'Santhoshkumar.Ramakrishna@toshiba-tjps.in', '120212TJ', 'Kumar Mysore  Narasimhanna', 'Manufacturing', 'Kumar.Narasimhanna@toshiba-tjps.in', '8754570665', 'Manager - Fabrication  for LP Casing', 'Large Fabrication  - 360511', 'General Manager - Manufacturing ', '', '', '', '', ''),
(16, '100022TJ', 'Manufacturing', 'Kannan M', '9894267559', 'Kannan.Masanam@toshiba-tjps.in', '120212TJ', 'Kumar Mysore  Narasimhanna', 'Manufacturing', 'Kumar.Narasimhanna@toshiba-tjps.in', '8754570665', 'Deputy Manager - Fabrication', 'Large Fabrication  - 360511', 'General Manager - Manufacturing ', '', '', '', '', ''),
(17, '100026TJ', 'Production Management', 'Saravanan E', '9444541696', 'Saravanan.Ethirajan@toshiba-tjps.in', '120234TJ', 'P A Kamesh Varagunan', 'Production Management', 'Kameswaran.Palanichamy@toshiba-tjps.in', '8754577254', 'Engineer - Machining  of Turn Miller', 'Production Management Department - 330911', 'General Manager - Production Management ', '', '', '', '', ''),
(18, '100030TJ', 'Manufacturing', 'Naveenthiran R', '8754676409', 'Naveenthiran.Rethinam@toshiba-tjps.in', '120282TJ', 'V Kumaresan', 'Manufacturing', 'Kumaresan.Veeraiyan@toshiba-tjps.in', '9943735804', 'Junior Engineer - Rotor Machining', 'Rotor machining - 360431', 'Assistant Manager - Manufacturing ', '', '', '', '', ''),
(19, '100032TJ', 'Manufacturing', 'Selvaraj J', '9789833976', 'Selvaraj.Jayaram@toshiba-tjps.in', '120212TJ', 'Kumar Mysore Narasimhanna', 'Manufacturing', 'Kumar.Narasimhanna@toshiba-tjps.in', '8754570665', 'Assistant Manager - Welding ', 'Medium and Small fabrication and welding - 360339', 'General Manager - Manufacturing ', '', '', '', '', ''),
(20, '100033TJ', 'Manufacturing Engineering', 'Manikandan V', '9840204686', 'Manikandan.Vasudevan@toshiba-tjps.in', '090011TJ', 'P Kumaravel', 'Manufacturing Engineering', 'Kumaravel.Padavettan@toshiba-tjps.in', '9626949624', 'Deputy Manager - Machining ( CAM Group )', 'Computer-aided drawing & manufacturing - 360141', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(21, '100035TJ', 'Quality Assurance Department ( Chennai )', 'Zachariah Sam', '8122923680', 'Zachariah.Sam@toshiba-tjps.in', '110170TJ', 'Sandip Prabhudas Ghiya', 'Quality Assurance Department ( Chennai )', 'Sandipghiya.Prabhudas@toshiba-tjps.in', '9677047012', 'Senior Manager - QC For Large Machinning', 'Large Machining - 240241', 'General Manager - QA', '', '', '', '', ''),
(22, '100041TJ', 'Technology & Design', 'Ramakrishna Prasad V S', '9600063441', 'Ramakrishna.Velakkayala@toshiba-tjps.in', '171137TJ', 'Thigulla Praveen Kumar', 'Technology & Design', 'praveenkumar.narsimha@toshiba-tjps.in', '8208609795', 'Manager - Mechnical Design', 'Mechanical Technology - 250221', 'General Manager - Technology & Design ', '', '', '', '', ''),
(23, '100042TJ', 'Finance & Accounts Department', 'Venkataramani S', '', 'Venkataramani.Srinivasan@toshiba-tjps.in', 'E-00014', 'Shinzo Kameoka', 'Finance & Accounts Department', 'shinzo.kameoka@toshiba.co.jp', '', 'Vice President - Finance & Accounts', 'Finance & Accounts Department - 120911', 'Chief Financial Officer', '', '', '', '', ''),
(24, '100043TJ', 'HSE', 'Rajmohan Palanivelu', '9865235580', 'Rajmohan.Palanivelu@toshiba-tjps.in', 'E-00039', 'Mitsuhiro Tanaka', 'Human Resources & General Affairs Department', 'mitsuhiro.tanaka@toshiba.co.jp', '', 'Deputy General Manager - HSE', 'Health Safety & Environment Group - 110391', 'Chief Administrative Officer', '', '', '', '', ''),
(25, '100044TJ', 'Construction & Maintenance', 'Rameshkumar Ramalingam', '8754498902', 'RameshKumar.Ramalingam@toshiba-tjps.in', '120226TJ', 'Varadappan  Saravanan', 'Construction & Maintenance', 'saravanan.varadhappan@toshiba-tjps.in', '', 'Manager - Electrical Project', 'Electrical Services - 370112', 'General Manager - Projects', '', '', '', '', ''),
(26, '100046TJ', 'Manufacturing', 'Satish Kumar K', '7299298225', 'SatishKumar.Kandaswamy@toshiba-tjps.in', '120212TJ', 'Kumar Mysore Narasimhanna', 'Manufacturing', 'Kumar.Narasimhanna@toshiba-tjps.in', '8754570665', 'Associate Manager - Assembly', 'Turbine - 360211', 'General Manager - Manufacturing ', '', '', '', '', ''),
(27, '100048TJ', 'Quality Assurance Department ( Chennai )', 'Dhamotharan M', '9952910627', 'Dhamotharan.Murugaiyan@toshiba-tjps.in', '110170TJ', 'Sandip Prabhudas Ghiya', 'Quality Assurance Department ( Chennai )', 'Sandipghiya.Prabhudas@toshiba-tjps.in', '9677047012', 'Manager - QC- ST Assembly', 'Turbine Assembly - 240211', 'General Manager - QA', '', '', '', '', ''),
(28, '100050TJ', 'Manufacturing Engineering', 'Mani Krishnan', '8056194139', 'Krishnan.Mani@toshiba-tjps.in', '090012TJ', 'Praveen Kumar K', 'Manufacturing Engineering', 'PraveenKumar.Kusuma@toshiba-tjps.in', '8754488878', 'Senior Engineer - Tool Engineering', 'Machining - 360311', 'Deputy Manager - Holding Fixtures', '', '', '', '', ''),
(29, '100052TJ', 'Technology & Design', ' Bhavani Vikram Kasula ', '9791151865', 'BhavaniVikram.Kasula@toshiba-tjps.in', '110105TJ', 'Jyotirmoy Mukherjee', 'Technology & Design', 'Jyotirmoy.Mukherjee@toshiba-tjps.in', '8754479761', 'Associate Manager - Technology (Mechanical)', 'P&D Design - 250321', 'General Manager - Technology & Design ', '', '', '', '', ''),
(30, '100054TJ', 'Construction & Maintenance', 'Arul Kumar Thangaraj', '9788245115', 'ArulKumar.Thangaraj@toshiba-tjps.in', '100044TJ', 'Rameshkumar Ramalingam', 'Construction & Maintenance', 'RameshKumar.Ramalingam@toshiba-tjps.in', '8754498902', 'Junior Engineer - Project (Electrical)', 'Electrical Services - 370112', 'Manager - Electrical Project', '', '', '', '', ''),
(31, '100058TJ', 'Construction & Maintenance', 'Bharath Kumar Krishnan', '9488844556', 'BharathKumar.Krishnan@toshiba-tjps.in', '120226TJ', 'Varadappan Saravanan', 'Construction & Maintenance', 'saravanan.varadhappan@toshiba-tjps.in', '8754498901', 'Deputy Manager - Maintenance ', 'Machine Maintenance - 370121', 'General Manager - Projects', '', '', '', '', ''),
(32, '100059TJ', 'Construction & Maintenance', 'Kalaiselvan Raja', '-9840847149', 'Kalaiselvan.Raja@toshiba-tjps.in', '100058TJ', 'Bharath Kumar Krishnan', 'Construction & Maintenance', 'BharathKumar.Krishnan@toshiba-tjps.in', '9488844556', 'Senior Team Member - Equipment Maintenance', 'Machine Maintenance - 370121', 'Deputy Manager - Maintenance ', '', '', '', '', ''),
(33, '100060TJ', 'Technology & Design', 'Lokesh Gunda', '9176676547', 'Lokesh.Chandrasekharasetty@toshiba-tjps.in', '110094TJ', 'Gomathi K', 'Technology & Design', 'Gomathi.Kasipandian@toshiba-tjps.in', '8754405339', 'Deputy Manager - Design (Electrical)', 'Electrical Technology - 250231', 'Senior Manager - Electrical Design', '', '', '', '', ''),
(34, '100063TJ', 'Finance & Accounts Department', 'Rajesh S V', '8754469686', 'Rajesh.Seshan@toshiba-tjps.in', '100042TJ', 'Venkataramani S', 'Finance & Accounts Department', 'Venkataramani.Srinivasan@toshiba-tjps.in', '9840295356', 'Deputy General Manager- Company Secretary & Finance ', 'Secretarial & Treasury Group -120111', 'Vice President - Finance & Accounts', '', '', '', '', ''),
(35, '110128TJ', 'Quality Assurance Department ( Chennai )', 'Palani  K', '9677250494', 'Palani.Kandasamy@toshiba-tjps.in', '100035TJ', 'Zachariah Sam', 'Quality Assurance Department ( Chennai )', 'Zachariah.Sam@toshiba-tjps.in', '8122923680', 'Assistant Manager - QC', 'Blade and nozzle partition  - 240271', 'Senior Manager - QC For Large Machinning', '', '', '', '', ''),
(36, '110131TJ', 'Quality Assurance Department ( Chennai )', 'Dayakar Reddy M', '9884573263', 'DayakarReddy.Ramana@toshiba-tjps.in', '110170TJ', 'Sandip Prabhudas Ghiya', 'Quality Assurance Department ( Chennai )', 'Sandipghiya.Prabhudas@toshiba-tjps.in', '9677047012', 'Assistant Manager - QA', 'Quality Management Group - 240111', 'General Manager - QA', '', '', '', '', ''),
(37, 'E-00006', 'Human Resources & General Affairs Department', 'Hiroshi Nishimura', '', 'hiroshi1.nishimura@toshiba.co.jp', 'E-00009', 'Yoshiaki Inayama', 'Manufacturing', 'yoshiaki.inayama@toshiba.co.jp', '', 'Chief Administrative Officer', 'CAO (Chief Administrative officerÂ¿ - 111111', 'Managing Director', '', '', '', '', ''),
(38, '130373TJ', 'Manufacturing', 'Shanmugam G', '7550004055', 'prabhu.kuppusamy@toshiba-tjps.in', '120260TJ', 'K Prabhu', 'Manufacturing', 'prabhu.kuppusamy@toshiba-tjps.in', '9789940927', 'Senior Team Member - Assembly', 'Stator Assembly - 360724', 'Deputy  Manager - Manufacturing for General Assembly  ', '', '', '', '', ''),
(39, '120221TJ', 'Quality Assurance Department ( Chennai )', 'Santhakumar M', '9942485005', 'Santhakumar.Muthu@toshiba-tjps.in', '130351TJ', 'Sathiyaraj P', 'Quality Assurance Department ( Chennai )', 'sathiyaraj.palanisamy@toshiba-tjps.in', '9952466467', 'Assistant Engineer - QC for Nozzle DPH', 'Blade and nozzle partition  - 240271', 'Senior Engineer - NDT ', '', '', '', '', ''),
(40, '130351TJ', 'Quality Assurance Department ( Chennai )', 'Sathiyaraj P', '9952466467', 'sathiyaraj.palanisamy@toshiba-tjps.in', '100035TJ', 'Zachariah Sam', 'Quality Assurance Department ( Chennai )', 'Zachariah.Sam@toshiba-tjps.in', '8122923680', 'Senior Engineer - NDT ', 'Large Machining - 240241', 'Senior Manager - QC For Large Machinning', '', '', '', '', ''),
(41, '120284TJ', 'Manufacturing', 'Murali L', '9894347560', 'Murali.Loganathan@toshiba-tjps.in', '120212TJ', 'Kumar Mysore Narasimhanna', 'Manufacturing Engineering', 'Kumar.Narasimhanna@toshiba-tjps.in', '8754570665', 'Senior Engineer - Manufacturing for Rotor Assembly', 'Turbine Assembly - 360111', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(42, '130364TJ', 'Quality Assurance Department ( Chennai )', 'Malaravan R', '9750505032', 'malaravan.rajagopal@toshiba-tjps.in', '130351TJ', 'Sathiyaraj P', 'Quality Assurance Department ( Chennai )', 'sathiyaraj.palanisamy@toshiba-tjps.in', '9952466467', 'Team Member - NDT', 'Large Machining - 240241', 'Senior Engineer - NDT ', '', '', '', '', ''),
(43, '130424TJ', 'Manufacturing', 'Pavan Kumar Addagalla', '', 'SatishKumar.Kandaswamy@toshiba-tjps.in', '100046TJ', 'Satish Kumar K', 'Manufacturing', 'SatishKumar.Kandaswamy@toshiba-tjps.in', '7299298225', 'Senior Team Member - Turbine Assembly', 'Turbine - 360211', 'Associate Manager - Assembly', '', '', '', '', ''),
(44, '100067TJ', 'Construction & Maintenance', 'Govindaswamy Ganesh', '9994756629', 'Ganesh.Govindasamy@toshiba-tjps.in', '120226TJ', 'Varadappan  Saravanan', 'Construction & Maintenance', 'saravanan.varadhappan@toshiba-tjps.in', '', 'Senior Team Member - Technical Services', 'Mechanical Services - 370113', 'General Manager - Projects', '', '', '', '', ''),
(45, '110183TJ', 'Manufacturing', 'Saravanan Rajagopal', '9941259592', 'Santhoshkumar.Ramakrishna@toshiba-tjps.in', '100032TJ', 'Selvaraj J', 'Manufacturing', 'Selvaraj.Jayaram@toshiba-tjps.in', '9789833976', 'Senior Team Member - Welding for Casing', 'Large Welding - 360521', 'Manager - Fabrication  for LP Casing', '', '', '', '', ''),
(46, '120311TJ', 'Production Management', 'Nithish V M', '919952349015', 'nithish.vijayakumarannair@toshiba-tjps.in', '120234TJ', 'P A Kamesh Varagunan', 'Production Management', 'Kameswaran.Palanichamy@toshiba-tjps.in', '7299077254', 'Engineer - Production Management ', 'Production Information system Group - 330411', 'Deputy Manager - Costing ', '', '', '', '', ''),
(47, '130356TJ', 'Manufacturing Engineering', 'Robinson T', '9841288486', 'robinson.thangamoni@toshiba-tjps.in', '090011TJ', 'P Kumaravel', 'Manufacturing Engineering', 'Kumaravel.Padavettan@toshiba-tjps.in', '9626949624', 'Engineer - CAM ', 'Computer-aided drawing & manufacturing - 360141', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(48, '130368TJ', 'Manufacturing', 'Daril ', '9786277789', 'Santhoshkumar.Ramakrishna@toshiba-tjps.in', '100032TJ', 'Selvaraj J', 'Manufacturing', 'Selvaraj.Jayaram@toshiba-tjps.in', '9789833976', 'Team Member - Fabrication', 'Large Fabrication  - 360511', 'Manager - Fabrication  for LP Casing', '', '', '', '', ''),
(49, '120211TJ', 'Quality Assurance Department ( Chennai )', 'Mirza Jalal Baig', '8695992224', 'MirzaJalal.Zainul@toshiba-tjps.in', '100035TJ', 'Zachariah Sam', 'Quality Assurance Department ( Chennai )', 'Zachariah.Sam@toshiba-tjps.in', '8122923680', 'Assistant Engineer - Large Machining QC', 'Large Machining - 240241', 'Senior Manager - QC For Large Machinning', '', '', '', '', ''),
(50, '110119TJ', 'Manufacturing', 'Rajesh Duraiswamy', '9840752660', 'Rajesh.Duraiswamy@toshiba-tjps.in', '090011TJ', 'P Kumaravel', 'Manufacturing', 'Kumaravel.Padavettan@toshiba-tjps.in', '9626949624', 'Junior Engineer - Machining', 'Machining - 360311', 'Senior Manager - Machining', '', '', '', '', ''),
(51, '110122TJ', 'Manufacturing', 'Mohan Gopal', '9941906848', 'Mohan.Gopal@toshiba-tjps.in', '090011TJ', 'P Kumaravel', 'Manufacturing', 'Kumaravel.Padavettan@toshiba-tjps.in', '9626949624', 'Junior Engineer - Cutting & Polishing', 'Cutting and polishing  - 360312', 'Senior Manager - Machining', '', '', '', '', ''),
(52, '120307TJ', 'Construction & Maintenance', 'Srinivasan S', '9952458872', 'srinivasan.selvam@toshiba-tjps.in', '100058TJ', 'Bharath Kumar Krishnan', 'Construction & Maintenance', 'BharathKumar.Krishnan@toshiba-tjps.in', '9488844556', 'Assistant Engineer - Maintenance (Electrical)', 'Blade Shop - 370122', 'Deputy Manager - Maintenance ', '', '', '', '', ''),
(53, '120308TJ', 'Quality Assurance Department ( Chennai )', 'Elangovan M', '9003607444', 'elangovan.murugesan@toshiba-tjps.in', '120252TJ', 'Karthickeyan S', 'Quality Assurance Department ( Chennai )', 'Karthickeyan.Subburaju@toshiba-tjps.in', '9789564182', 'Engineer - Procurement QC (Metallurgy) ', 'Procurement QA Group - 240511', 'Deputy Manager - Procurement QC', '', '', '', '', ''),
(54, '120310TJ', 'Manufacturing', 'Murali M', '9003077531', 'santhoshkumar.balakrishnan@toshiba-tjps.in', '140764TJ', 'Devanesan  C', 'Manufacturing', 'devanesan.chakkaraverthi@toshiba-tjps.in', '9940218547', 'Senior Team Member - Machining for Casing (Gantry Type VMC / HMC/ VTL)', 'Large Machining - 360411', 'Assistant Engineer - Large Machining', '', '', '', '', ''),
(55, '130426TJ', 'Manufacturing', 'Dass M', '9884554268', 'Kumaresan.Veeraiyan@toshiba-tjps.in', '120282TJ', 'V Kumaresan', 'Manufacturing', 'Kumaresan.Veeraiyan@toshiba-tjps.in', '9943735804', 'Team Member - Machining ', 'Rotor machining - 360431', 'Assistant Manager - Manufacturing ', '', '', '', '', ''),
(56, '110189TJ', 'Construction & Maintenance', 'K Venkatesan', '9952657076', 'Venkatesan.Kubendran@toshiba-tjps.in', '100044TJ', 'Rameshkumar Ramalingam', 'Construction & Maintenance', 'RameshKumar.Ramalingam@toshiba-tjps.in', '8754498902', 'Engineer - Facility Management', 'Electrical Services - 370112', 'Manager - Electrical Project', '', '', '', '', ''),
(57, '110191TJ', 'Manufacturing', 'K Baskar', '8015132061', 'Vijayanand.Varadharajan@toshiba-tjps.in', '100074TJ', 'V Vijay Anand', 'Manufacturing', 'Vijayanand.Varadharajan@toshiba-tjps.in', '9940547418', 'Senior Team Member - Large Machining for Casing', 'Large Machining - 360411', 'Assistant Manager - Machining ', '', '', '', '', ''),
(58, '130346TJ', 'Finance & Accounts Department', 'Sathya Narayanan M', '9677090072', 'sathyanarayanan.meenakshisundaram@toshiba-tjps.in', '100042TJ', 'Venkataramani S', 'Finance & Accounts Department', 'Venkataramani.Srinivasan@toshiba-tjps.in', '9840295356', 'Senior Executive - Finance & Accounts', 'Accounting  (Chennai ) - 120221', 'Vice President - Finance & Accounts', '', '', '', '', ''),
(59, '110113TJ', 'Manufacturing', 'Gunalan Pravin Kumar', '9677624742', 'pravinkumar.gunalan@toshiba-tjps.in', '110164TJ', 'Thavamani M', 'Manufacturing Engineering', 'Thavamani.Muthaiah@toshiba-tjps.in', '9944443191', 'Team Member - Machining for Blade', 'Blade and partition machining - 360121', 'Assistant Manager - Manufacturing Engineering ', '', '', '', '', ''),
(60, '110114TJ', 'Manufacturing', 'Satish Kumar  Challa', '9043134407', 'satishkumar.krishnaiah@toshiba-tjps.in', '100081TJ', 'Narayanamoorthy H', 'Manufacturing', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '9840978458', 'Team Member - Cutting & Polishing', 'Cutting and polishing  - 360312', 'Engineer - Machining for Blade ', '', '', '', '', ''),
(61, '110116TJ', 'Manufacturing', 'Sivaram Rajendran', '9790853621', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '100081TJ', 'Narayana Murthy Hari  Krishnan', 'Manufacturing', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '9840978458', 'Team Member - Machining for Blade', 'Machining - 360311', 'Engineer - Machining for Blade ', '', '', '', '', ''),
(62, '130360TJ', 'Production Management', 'Prashanth Velpula', '', 'prashanth.gopal@toshiba-tjps.in', '110088TJ', 'Muthukrishnan S', 'Production Management', 'Muthukrishnan.Subramanian@toshiba-tjps.in', '8903403346', 'Senior Engineer - PPC', 'Turbine Assembly - 330211', 'Manager - PPC', '', '', '', '', ''),
(63, '130438TJ', 'Manufacturing', 'Ranjith kumar V', '9677121124', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '100081TJ', 'Narayana Murthy Hari  Krishnan', 'Manufacturing', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '9840978458', 'Team Member - Machining for Blade', 'Machining - 360311', 'Engineer - Machining for Blade ', '', '', '', '', ''),
(64, '130440TJ', 'Manufacturing', 'Manickavasagam D', '9655220108', 'hareesh.alijan@toshiba-tjps.in', '110145TJ', 'Hareesh', 'Manufacturing', 'hareesh.alijan@toshiba-tjps.in', '9994349268', 'Team Member - Valve Assembly', 'Control Device - 360231', 'Engineer - Valve Assembly ', '', '', '', '', ''),
(65, '120240TJ', 'Information System Department', 'Moses  Savarimuthu', '8754447460', 'Moses.Savarimuthu@toshiba-tjps.in', 'E-00011', 'Masahiro Daigen', 'Marketing & Sales', 'masahiro.daigen@toshiba.co.jp', '', 'General Manager - MIS', 'Information System Department - 220111', 'Chief Quality Executive', '', '', '', '', ''),
(66, '120280TJ', 'Technology & Design', 'Balaji V C', '9787472288', 'balaji.chandrasekaran@toshiba-tjps.in', '100060TJ', 'Lokesh Gunda', 'Technology & Design', 'Lokesh.Chandrasekharasetty@toshiba-tjps.in', '9176676547', 'Senior Engineer - Projects', 'Electrical Technology - 250231', 'Deputy Manager - Design (Electrical)', '', '', '', '', ''),
(67, '120289TJ', 'Information System Department', 'Sathish L C', '9841533997', 'sathish.chandersekar@toshiba-tjps.in', '120240TJ', 'Moses Savarimuthu', 'Information System Department', 'Moses.Savarimuthu@toshiba-tjps.in', '9976175561', 'Engineer - MIS', 'Information System Group ( Chennai ) - 220311', 'General Manager - MIS', '', '', '', '', ''),
(68, '120294TJ', 'Manufacturing', 'Cinraj S', '9677882345', 'Murugan.Kandaswamy@toshiba-tjps.in', '090011TJ', 'P Kumaravel', 'Manufacturing', 'Kumaravel.Padavettan@toshiba-tjps.in', '9626949624', 'Team Member - Machining', 'Nozzle diaphragm machining - 360321', 'Engineer - Nozzle DPH Machining', '', '', '', '', ''),
(69, '120296TJ', 'Manufacturing', 'Nageswaran C', '9952926829', 'santhoshkumar.balakrishnan@toshiba-tjps.in', '100074TJ', 'V Vijay Anand', 'Manufacturing', 'Vijayanand.Varadharajan@toshiba-tjps.in', '9940547418', 'Team Member - Machining', 'Large Machining - 360411', 'Assistant Engineer - Large Machining', '', '', '', '', ''),
(70, '120243TJ', 'Production Management', 'Balakotaiah Binginpalli', '9042216411', 'Balakotaiah.Brahmaiah@toshiba-tjps.in', '110088TJ', 'Muthukrishnan S', 'Production Management', 'Muthukrishnan.Subramanian@toshiba-tjps.in', '8903403346', 'Senior Engineer - PPC', 'Blade and Nozzle partition - 330271', 'Manager - PPC', '', '', '', '', ''),
(71, '130330TJ', 'Manufacturing Engineering', 'Ananda Krishnan K R', '9655737345', 'anandakrishnan.radhakrishnan@toshiba-tjps.in', '110200TJ', 'Manish  Verma', 'Manufacturing Engineering', 'Manish.RamkumarVerma@toshiba-tjps.in', '8754448175', 'Assistant Engineer - Manufacturing Engineering', 'Large Machining - 360123', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(72, '120245TJ', 'Construction & Maintenance', 'Sachithanandam  S', '9787018905', 'Sachithanandam.Subramanian@toshiba-tjps.in', '110097TJ', 'Selvakumar Chinnakali', 'Construction & Maintenance', 'Selvakumar.Chinnakali@toshiba-tjps.in', '9025884110', 'Senior Team Member - Landscaping', 'Construction & Civil Group - 370211', 'Senior Engineer - Design ', '', '', '', '', ''),
(73, '120263TJ', 'Manufacturing', 'Govindaraj K', '8148389381', 'Vijayanand.Varadharajan@toshiba-tjps.in', '120293TJ', 'Vignesh Kumar M', 'Manufacturing', 'Vigneshkumar.Malayapillai@toshiba-tjps.in', '9841380837', 'Team Member - Machining (HBM) for Nozzle', 'Large Machining - 360411', 'Assistant Manager - Machining ', '', '', '', '', ''),
(74, '120265TJ', 'Manufacturing', 'Madhusudhanan  G', '9790797857', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '100081TJ', 'Narayana Murthy Hari  Krishnan', 'Manufacturing', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '9840978458', 'Team Member - Machining for Blade', 'Machining - 360311', 'Engineer - Machining for Blade ', '', '', '', '', ''),
(75, '120266TJ', 'Quality Assurance Department ( Chennai )', 'Vimalan  R', '9842415047', 'Vimalan.Rajkumar@toshiba-tjps.in', '100035TJ', 'Zachariah Sam', 'Quality Assurance Department ( Chennai )', 'Zachariah.Sam@toshiba-tjps.in', '8122923680', 'Senior Engineer - QC ', 'Nozzle diaphragm  - 240261', 'Senior Manager - QC For Large Machinning', '', '', '', '', ''),
(76, '130335TJ', 'Manufacturing', 'Vijay  N', '9941548909', 'Murugan.Kandaswamy@toshiba-tjps.in', '110168TJ', 'Murugan K', 'Manufacturing', 'Murugan.Kandaswamy@toshiba-tjps.in', '9500031506', 'Senior Team Member - Machining', 'Nozzle diaphragm machining - 360321', 'Engineer - Nozzle DPH Machining', '', '', '', '', ''),
(77, '130365TJ', 'Manufacturing', 'Subramani D', '9003332810', 'subramani.dhandapani@toshiba-tjps.in', '100021TJ', 'Santhoshkumar M V', 'Manufacturing', 'Santhoshkumar.Ramakrishna@toshiba-tjps.in', '9962461101', 'Assistant Engineer - Fabrication', 'Large Fabrication  - 360511', 'Manager - Fabrication  for LP Casing', '', '', '', '', ''),
(78, '130399TJ', 'Manufacturing', 'Thiruppathi E', '', 'Kumaresan.Veeraiyan@toshiba-tjps.in', '120282TJ', 'V Kumaresan', 'Manufacturing', 'Kumaresan.Veeraiyan@toshiba-tjps.in', '9943735804', 'Team Member - Machining', 'Rotor machining - 360431', 'Assistant Manager - Manufacturing ', '', '', '', '', ''),
(79, '130417TJ', 'Manufacturing', 'Madhan Singh N', '', 'SatishKumar.Kandaswamy@toshiba-tjps.in', '100046TJ', 'Satish Kumar K', 'Manufacturing', 'SatishKumar.Kandaswamy@toshiba-tjps.in', '7299298225', 'Team Member - Turbine Assembly', 'Turbine - 360211', 'Associate Manager - Assembly', '', '', '', '', ''),
(80, '100071TJ', 'Procurement Department ( Chennai )', 'Nandakumar  L', '919677251313', 'Nandakumar.Lingadas@toshiba-tjps.in', '140784TJ', 'Shafiqur Rahman', 'Procurement Department ( Chennai )', 'shafiqur.rahman@toshiba-tjps.in', '9902625102', 'Associate Manager - Procurement', 'Procurement Group (Chennai) - 340211', 'General Manager', '', '', '', '', ''),
(81, 'E-00002', 'Manufacturing', 'Masachika Odawara', '', 'masa.odawara@toshiba.co.jp', 'E-00009', 'Yoshiaki Inayama', 'Manufacturing', 'yoshiaki.inayama@toshiba.co.jp', '', 'Executive Director', 'Executive Director- 301111', 'Managing Director', '', '', '', '', ''),
(82, '110142TJ', 'Production Management', 'Janarthanam', '9884428486', 'Janarthanam.Rajendran@toshiba-tjps.in', '120234TJ', 'P A Kamesh Varagunan', 'Production Management', 'Kameswaran.Palanichamy@toshiba-tjps.in', '7299077254', 'Assistant Manager - Production Information ', 'Production Information system Group - 330411', 'General Manager - Production Management ', '', '', '', '', ''),
(83, '120228TJ', 'Quality Assurance Department ( Chennai )', 'Anandaraj  Rayar', '9444160125', 'Anandaraj.Rayar@toshiba-tjps.in', '110170TJ', 'Sandip Prabhudas Ghiya', 'Quality Assurance Department ( Chennai )', 'Sandipghiya.Prabhudas@toshiba-tjps.in', '9677047012', 'Senior Engineer - QC (Electrical Test)', 'Electrical Quality Control Group - 240391', 'General Manager - QA', '', '', '', '', ''),
(84, '120233TJ', 'Manufacturing Engineering', 'Karthi J', '9789854752', 'Karthi.Janakiraman@toshiba-tjps.in', '120212TJ', 'Kumar Mysore Narasimhanna', 'Manufacturing Engineering', 'Kumar.Narasimhanna@toshiba-tjps.in', '8754570665', 'Senior Engineer - Manufacturing Engineering (Generator Rotor)', 'Generator Assembly - 360114', 'Senior Manager - Manufacturing  Engineering', '', '', '', '', ''),
(85, '120234TJ', 'Production Management', 'P A Kamesh Varagunan', '8754577254', 'Kameswaran.Palanichamy@toshiba-tjps.in', 'E-00030', 'Taro Sakamoto', 'Manufacturing', 'taro.sakamoto@toshiba.co.jp', '', 'General Manager - Production Management ', 'Production Management Department - 330911', 'Vice President', '', '', '', '', ''),
(86, '120235TJ', 'Manufacturing', 'Senthilkumar R S', '', 'Selvaraj.Jayaram@toshiba-tjps.in', '100032TJ', 'Selvaraj J', 'Manufacturing', 'Selvaraj.Jayaram@toshiba-tjps.in', '9789833976', 'Team Member - Fabrication for Nozzle', 'Fabrication - 360331', 'Assistant Manager - Welding ', '', '', '', '', ''),
(87, '110151TJ', 'Manufacturing', 'Munusamy   N', '9003339623', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '100081TJ', 'Narayanamoorthy H', 'Manufacturing', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '9840978458', 'Team Member - Cutting & Polishing', 'Cutting and polishing  - 360312', 'Engineer - Machining for Blade ', '', '', '', '', ''),
(88, '110155TJ', 'Manufacturing', 'Jyothi Babu C H', '7200111473', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '100081TJ', 'Narayana Murthy Hari  Krishnan', 'Manufacturing', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '9840978458', 'Team Member - Machining for Blade', 'Machining - 360311', 'Engineer - Machining for Blade ', '', '', '', '', ''),
(89, '120237TJ', 'Production Management', 'John Ebinizer Pothuri', '8148713909', 'johnebinizer.venkataramana@toshiba-tjps.in', '110088TJ', 'Muthukrishnan  S', 'Production Management', 'Muthukrishnan.Subramanian@toshiba-tjps.in', '8903403346', 'Senior Engineer - Production Control', 'Control Device Assembly - 330231', 'Manager - PPC', '', '', '', '', ''),
(90, '120321TJ', 'Technology & Design', 'Jawad K A', '9946964211', 'jawad.abdulrahim@toshiba-tjps.in', '100041TJ', 'Ramakrishna Prasad V S', 'Technology & Design', 'Ramakrishna.Velakkayala@toshiba-tjps.in', '9600063441', 'Engineer - Design & Engineering ', 'Mechanical Technology - 250221', 'Manager - Mechnical Design', '', '', '', '', ''),
(91, '120325TJ', 'Manufacturing Engineering', 'Dinesh G', '9942872523', 'Dinesh.Govindarajan@toshiba-tjps.in', '120247TJ', 'Vikas Srivastav', 'Manufacturing Engineering', 'Vikas.Srivastav@toshiba-tjps.in', '9003576447', 'Engineer - Manufacturing', 'Large Welding Parts - 360132', 'Deputy Manager  - Welding & Heat Treatment', '', '', '', '', ''),
(92, '130389TJ', 'Information System Department', 'Johnson Christopher J', '', 'johnson.christopher@toshiba-tjps.in', '120240TJ', 'Moses  Savarimuthu', 'Information System Department', 'Moses.Savarimuthu@toshiba-tjps.in', '8754447460', 'Assistant Engineer - MIS', 'Information System Group ( Chennai ) - 220311', 'General Manager - MIS', '', '', '', '', ''),
(93, '110097TJ', 'Construction & Maintenance', 'Selvakumar Chinnakali', '9025884110', 'Selvakumar.Chinnakali@toshiba-tjps.in', '120226TJ', 'Varadappan  Saravanan', 'Construction & Maintenance', 'saravanan.varadhappan@toshiba-tjps.in', '', 'Senior Engineer - Design ', 'Construction & Civil Group - 370211', 'General Manager - Projects', '', '', '', '', ''),
(94, '110105TJ', 'Technology & Design', 'Jyotirmoy Mukherjee', '8754479761', 'Jyotirmoy.Mukherjee@toshiba-tjps.in', 'E-00030', 'Taro Sakamoto', 'Manufacturing', 'taro.sakamoto@toshiba.co.jp', '', 'General Manager - Technology & Design ', 'Technology & Design Department - 250911', 'Vice President', '', '', '', '', ''),
(95, '110112TJ', 'Manufacturing', 'Srinivasan M', '919487227166', 'srinivasan.markabandu@toshiba-tjps.in', '100081TJ', 'Narayana Murthy Hari  Krishnan', 'Manufacturing', 'Narayanamoorthy.Harikrishnan@toshiba-tjps.in', '9840978458', 'Team Member - Machining for Blade', 'Machining - 360311', 'Engineer - Machining for Blade ', '', '', '', '', ''),
(96, '110115TJ', 'Marketing & Proposal  Department ( Chennai )', 'Govindaraju Ganesan', '', 'Govindaraju.Ganesan@toshiba-tjps.in', 'E-00022', 'Shuji Hirono', 'Marketing & Sales Department ', 'shuji.hirono@toshiba.co.jp', '', 'General Manager - Marketing & Business Development', 'Marketing & Proposal Group (Chennnai) - 230911', 'Chief Marketing Officer', '', '', '', '', ''),
(97, '110117TJ', 'Construction & Maintenance', 'Perumalraja  Krishnamoorthy', '9003935987', 'perumalraja.krishnamoorthy@toshiba-tjps.in', '100058TJ', 'Bharath Kumar Krishnan', 'Construction & Maintenance', 'BharathKumar.Krishnan@toshiba-tjps.in', '9488844556', 'Junior Engineer  - Maintenance ', 'Blade Shop - 370122', 'Deputy Manager - Maintenance ', '', '', '', '', ''),
(98, '110133TJ', 'Manufacturing', 'Narayanan', '9444459888', 'Narayanan.Mohanasundaram@toshiba-tjps.in', '100032TJ', 'Selvaraj J', 'Manufacturing', 'Selvaraj.Jayaram@toshiba-tjps.in', '9789833976', 'Engineer -Welding ', 'Final Finish & Assembly - 360333', 'Assistant Manager - Welding ', '', '', '', '', ''),
(99, '110180TJ', 'Manufacturing', 'Manikandan A', '9600153882', 'Santhoshkumar.Ramakrishna@toshiba-tjps.in', '100021TJ', 'Santhoshkumar M V', 'Manufacturing', 'Santhoshkumar.Ramakrishna@toshiba-tjps.in', '9962461101', 'Senior Team Member - Welding for Casing', 'Large Welding - 360521', 'Manager - Fabrication  for LP Casing', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.transaction_attendance`
--

DROP TABLE IF EXISTS `dbo.transaction_attendance`;
CREATE TABLE IF NOT EXISTS `dbo.transaction_attendance` (
  `id` mediumint(9) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL,
  `emp_code` varchar(50) DEFAULT NULL,
  `shift_code` varchar(50) DEFAULT NULL,
  `in_time` varchar(8) DEFAULT NULL,
  `out_time` varchar(8) DEFAULT NULL,
  `entry_flag` varchar(1) DEFAULT NULL,
  `Device_code` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.transaction_attendance`
--

INSERT INTO `dbo.transaction_attendance` (`id`, `date`, `emp_code`, `shift_code`, `in_time`, `out_time`, `entry_flag`, `Device_code`) VALUES
(1, '2017-11-28', 'EMP-001', 'General-Corp                                      ', '08:18:08', '', '1', 'In Device 1'),
(2, '2017-11-28', 'EMP-001', 'General-Corp                                      ', '', '08:18:12', '1', 'Out Device 1'),
(3, '2017-11-28', 'EMP-001', 'General-Corp                                      ', '08:18:20', '', '1', 'In Device 1'),
(4, '2017-11-28', 'EMP-001', 'General-Corp                                      ', '08:18:27', '', '1', 'In Device 1'),
(5, '2017-11-28', 'EMP-001', 'General-Corp                                      ', '', '08:18:28', '1', 'Out Device 1'),
(6, '2017-11-28', 'EMP-001', 'General-Corp                                      ', '15:10:09', '', '1', 'In Device 1'),
(7, '2017-11-28', 'EMP-001', 'General-Corp                                      ', '15:10:14', '', '1', 'In Device 1'),
(8, '2017-11-29', 'EMP-413', 'General-Plant                                     ', '08:31:15', '', '1', 'In Device 1'),
(9, '2017-11-29', 'EMP-001', 'General-Corp                                      ', '08:31:39', '', '1', 'In Device 1'),
(10, '2017-11-29', 'EMP-001', 'General-Corp                                      ', '08:31:51', '', '1', 'In Device 1'),
(11, '2017-11-29', 'EMP-413', 'General-Plant                                     ', '08:32:12', '', '1', 'In Device 1'),
(13, '2017-11-29', 'EMP-001', 'General-Corp                                      ', '10:15:40', '', '1', 'In Device 1'),
(14, '2017-11-29', 'EMP-001', 'General-Corp                                      ', '10:16:20', '', '1', 'In Device 1'),
(15, '2017-11-29', 'EMP-001', 'General-Corp                                      ', '10:16:49', '', '1', 'In Device 1'),
(16, '2017-11-29', 'EMP-413', 'General-Plant                                     ', '10:17:04', '', '1', 'In Device 1'),
(21, '2017-12-01', 'EMP-413', 'General-Plant                                     ', '09:00:57', '', '1', 'In Device 1'),
(22, '2017-12-01', 'EMP-433', 'General-Plant                                     ', '09:01:32', '', '1', 'In Device 1'),
(27, '2017-12-01', 'EMP-420', 'General-Plant                                     ', '09:15:55', '', '1', 'In Device 1'),
(28, '2017-12-01', 'EMP-468', 'Shift A                                           ', '09:16:23', '', '1', 'In Device 1'),
(35, '2017-12-01', 'EMP-632', 'General-Plant                                     ', '09:37:18', '', '1', 'In Device 1'),
(36, '2017-12-01', 'EMP-633', 'General-Plant                                     ', '', '09:44:07', '1', 'Out Device 1'),
(37, '2017-12-01', 'EMP-633', 'General-Plant                                     ', '09:44:28', '', '1', 'In Device 1'),
(38, '2017-12-01', 'EMP-633', 'General-Plant                                     ', '', '09:44:41', '1', 'Out Device 1'),
(41, '2017-12-01', 'EMP-408', 'General-Plant                                     ', '10:06:55', '', '1', 'In Device 1'),
(42, '2017-12-01', 'EMP-410', 'General-Plant                                     ', '10:07:01', '', '1', 'In Device 1'),
(43, '2017-12-01', 'EMP-407', 'General-Plant                                     ', '10:07:06', '', '1', 'In Device 1'),
(57, '2017-12-01', 'EMP-640', 'General-Plant                                     ', '12:24:49', '', '1', 'In Device 1'),
(58, '2017-12-01', 'EMP-634', 'General-Plant                                     ', '', '12:29:06', '1', 'Out Device 1'),
(62, '2017-12-01', 'EMP-640', 'General-Plant                                     ', '', '16:45:02', '1', 'Out Device 1'),
(70, '2017-12-04', 'EMP-141', 'General-Corp                                      ', '09:16:51', '', '1', 'In Device 1'),
(71, '2017-12-04', 'EMP-641', 'General-Plant                                     ', '09:18:47', '', '1', 'In Device 1'),
(72, '2017-12-04', 'EMP-374', 'General-Corp                                      ', '09:20:11', '', '1', 'In Device 1'),
(73, '2017-12-04', 'EMP-374', 'General-Corp                                      ', '09:20:25', '', '1', 'In Device 1'),
(74, '2017-12-04', 'EMP-097', 'General-Corp                                      ', '09:23:42', '', '1', 'In Device 1'),
(75, '2017-12-04', 'EMP-097', 'General-Corp                                      ', '09:24:12', '', '1', 'In Device 1'),
(76, '2017-12-04', 'EMP-097', 'General-Corp                                      ', '09:24:52', '', '1', 'In Device 1'),
(85, '2017-12-04', 'EMP-645', 'Others                                            ', '10:05:26', '', '1', 'In Device 1'),
(86, '2017-12-04', 'EMP-093', 'Others                                            ', '10:05:40', '', '1', 'In Device 1'),
(87, '2017-12-04', 'EMP-637', 'Others                                            ', '10:06:29', '', '1', 'In Device 1'),
(88, '2017-12-04', 'EMP-535', 'Others                                            ', '10:06:47', '', '1', 'In Device 1'),
(89, '2017-12-04', 'EMP-608', 'Others                                            ', '10:07:15', '', '1', 'In Device 1'),
(90, '2017-12-04', 'EMP-603', 'Others                                            ', '10:07:37', '', '1', 'In Device 1'),
(91, '2017-12-04', 'EMP-644', 'Others                                            ', '10:08:13', '', '1', 'In Device 1'),
(92, '2017-12-04', 'EMP-568', 'Others                                            ', '10:09:07', '', '1', 'In Device 1'),
(93, '2017-12-04', 'EMP-441', 'Others                                            ', '10:14:04', '', '1', 'In Device 1'),
(94, '2017-12-04', 'EMP-651', 'Others                                            ', '10:24:43', '', '1', 'In Device 1'),
(96, '2017-12-04', 'EMP-649', 'Others                                            ', '10:26:10', '', '1', 'In Device 1'),
(98, '2017-12-04', 'EMP-653', 'Others                                            ', '10:43:08', '', '1', 'In Device 1'),
(99, '2017-12-04', 'EMP-513', 'Others                                            ', '10:45:10', '', '1', 'In Device 1'),
(100, '2017-12-04', 'EMP-514', 'Others                                            ', '10:45:19', '', '1', 'In Device 1'),
(101, '2017-12-04', 'EMP-428', 'Others                                            ', '10:50:50', '', '1', 'In Device 1'),
(102, '2017-12-04', 'EMP-344', 'Others                                            ', '10:59:17', '', '1', 'In Device 1'),
(118, '2017-12-04', 'EMP-390', 'Others                                            ', '15:21:35', '', '1', 'In Device 1'),
(119, '2017-12-04', 'EMP-473', 'Others                                            ', '', '15:22:58', '1', 'Out Device 1'),
(120, '2017-12-04', 'EMP-384', 'Others                                            ', '15:23:50', '', '1', 'In Device 1'),
(125, '2017-12-04', 'EMP-020', 'Others                                            ', '15:47:42', '', '1', 'In Device 1'),
(126, '2017-12-04', 'EMP-638', 'Others                                            ', '15:47:54', '', '1', 'In Device 1'),
(132, '2017-12-04', 'EMP-018', 'Others                                            ', '16:00:49', '', '1', 'In Device 1'),
(133, '2017-12-04', 'EMP-006', 'Others                                            ', '16:05:14', '', '1', 'In Device 1'),
(138, '2017-12-04', 'EMP-002', 'Others                                            ', '16:20:06', '', '1', 'In Device 1'),
(139, '2017-12-04', 'EMP-040', 'Others                                            ', '16:26:20', '', '1', 'In Device 1'),
(140, '2017-12-04', 'EMP-040', 'Others                                            ', '16:26:21', '', '1', 'In Device 1'),
(150, '2017-12-04', 'EMP-532', 'Others                                            ', '', '16:57:50', '1', 'Out Device 1'),
(151, '2017-12-04', 'EMP-654', 'Others                                            ', '17:00:01', '', '1', 'In Device 1'),
(155, '2017-12-04', 'EMP-001', 'Others                                            ', '', '17:06:16', '1', 'Out Device 1'),
(156, '2017-12-04', 'EMP-496', 'Others                                            ', '', '17:10:22', '1', 'Out Device 1'),
(157, '2017-12-04', 'EMP-502', 'Others                                            ', '', '17:11:00', '1', 'Out Device 1'),
(158, '2017-12-04', 'EMP-501', 'Others                                            ', '', '17:11:26', '1', 'Out Device 1'),
(159, '2017-12-04', 'EMP-500', 'Others                                            ', '17:15:42', '', '1', 'In Device 1'),
(160, '2017-12-04', 'EMP-500', 'Others                                            ', '', '17:15:52', '1', 'Out Device 1'),
(161, '2017-12-04', 'EMP-634', 'Others                                            ', '', '17:16:06', '1', 'Out Device 1'),
(162, '2017-12-04', 'EMP-115', 'Others                                            ', '', '17:17:50', '1', 'Out Device 1'),
(163, '2017-12-04', 'EMP-115', 'Others                                            ', '', '17:17:57', '1', 'Out Device 1'),
(12, '2017-11-29', 'EMP-431', 'General-Plant                                     ', '09:36:33', '', '1', 'In Device 1'),
(17, '2017-12-01', 'EMP-430', 'General-Plant                                     ', '08:56:54', '', '1', 'In Device 1'),
(18, '2017-12-01', 'EMP-430', 'General-Plant                                     ', '08:57:10', '', '1', 'In Device 1'),
(19, '2017-12-01', 'EMP-430', 'General-Plant                                     ', '08:58:34', '', '1', 'In Device 1'),
(20, '2017-12-01', 'EMP-419', 'General-Plant                                     ', '08:59:09', '', '1', 'In Device 1'),
(24, '2017-12-01', 'EMP-413', 'General-Plant                                     ', '', '09:06:23', '1', 'Out Device 1'),
(25, '2017-12-01', 'EMP-456', 'General-Plant                                     ', '09:06:24', '', '1', 'In Device 1'),
(26, '2017-12-01', 'EMP-469', '                                                  ', '09:07:53', '', '1', 'In Device 1'),
(32, '2017-12-01', 'EMP-413', 'General-Plant                                     ', '', '09:25:47', '1', 'Out Device 1'),
(33, '2017-12-01', 'EMP-415', 'General-Plant                                     ', '09:26:22', '', '1', 'In Device 1'),
(34, '2017-12-01', 'EMP-416', 'General-Plant                                     ', '09:27:05', '', '1', 'In Device 1'),
(39, '2017-12-01', 'EMP-634', 'General-Plant                                     ', '10:05:18', '', '1', 'In Device 1'),
(40, '2017-12-01', 'EMP-407', 'General-Plant                                     ', '10:05:45', '', '1', 'In Device 1'),
(52, '2017-12-01', 'EMP-413', 'General-Plant                                     ', '', '12:02:01', '1', 'Out Device 1'),
(53, '2017-12-01', 'EMP-413', 'General-Plant                                     ', '', '12:02:10', '1', 'Out Device 1'),
(54, '2017-12-01', 'EMP-526', '                                                  ', '12:10:13', '', '1', 'In Device 1'),
(55, '2017-12-01', 'EMP-413', 'General-Plant                                     ', '12:15:30', '', '1', 'In Device 1'),
(56, '2017-12-01', 'EMP-413', 'General-Plant                                     ', '', '12:16:13', '1', 'Out Device 1'),
(83, '2017-12-04', 'EMP-647', 'Others                                            ', '10:03:58', '', '1', 'In Device 1'),
(84, '2017-12-04', 'EMP-646', 'Others                                            ', '10:04:39', '', '1', 'In Device 1'),
(97, '2017-12-04', 'EMP-652', 'Others                                            ', '10:42:29', '', '1', 'In Device 1'),
(108, '2017-12-04', 'EMP-368', 'Others                                            ', '14:37:33', '', '1', 'In Device 1'),
(117, '2017-12-04', 'EMP-385', 'Others                                            ', '15:19:05', '', '1', 'In Device 1'),
(121, '2017-12-04', 'EMP-389', 'Others                                            ', '15:26:12', '', '1', 'In Device 1'),
(122, '2017-12-04', 'EMP-388', 'Others                                            ', '15:28:21', '', '1', 'In Device 1'),
(123, '2017-12-04', 'EMP-639', 'Others                                            ', '', '15:31:17', '1', 'Out Device 1'),
(124, '2017-12-04', 'EMP-543', 'Others                                            ', '', '15:31:21', '1', 'Out Device 1');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.upload_emp_master`
--

DROP TABLE IF EXISTS `dbo.upload_emp_master`;
CREATE TABLE IF NOT EXISTS `dbo.upload_emp_master` (
  `id` varchar(0) DEFAULT NULL,
  `emp_code` varchar(0) DEFAULT NULL,
  `type` varchar(0) DEFAULT NULL,
  `type_detail` varchar(0) DEFAULT NULL,
  `file_name` varchar(0) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.upload_master`
--

DROP TABLE IF EXISTS `dbo.upload_master`;
CREATE TABLE IF NOT EXISTS `dbo.upload_master` (
  `id` tinyint(4) DEFAULT NULL,
  `contractor_code` varchar(7) DEFAULT NULL,
  `type` varchar(8) DEFAULT NULL,
  `type_detail` varchar(11) DEFAULT NULL,
  `file_name` varchar(60) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.upload_master`
--

INSERT INTO `dbo.upload_master` (`id`, `contractor_code`, `type`, `type_detail`, `file_name`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CON-002', 'PAN CARD', ' ACLPT8714H', '/TOSHIBA/images/Contractor/Upload/CON-002-PAN SCAN COPY2.jpg', 1, '2017-11-22 00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.user_group_master`
--

DROP TABLE IF EXISTS `dbo.user_group_master`;
CREATE TABLE IF NOT EXISTS `dbo.user_group_master` (
  `user_group_id` tinyint(4) DEFAULT NULL,
  `user_group_name` varchar(11) DEFAULT NULL,
  `user_group_code` varchar(6) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.user_group_master`
--

INSERT INTO `dbo.user_group_master` (`user_group_id`, `user_group_name`, `user_group_code`, `created_by`, `created_on`) VALUES
(1, 'SUPER ADMIN', 'BB-001', '', ''),
(2, 'ADMIN', 'BB-002', '', ''),
(3, 'ENTRY USER', 'BB-003', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.user_master`
--

DROP TABLE IF EXISTS `dbo.user_master`;
CREATE TABLE IF NOT EXISTS `dbo.user_master` (
  `user_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(26) DEFAULT NULL,
  `user_name` varchar(8) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `email_id` varchar(45) DEFAULT NULL,
  `user_group_code` varchar(6) DEFAULT NULL,
  `mobile_no` bigint(20) DEFAULT NULL,
  `profile` varchar(42) DEFAULT NULL,
  `created_by` tinyint(4) DEFAULT NULL,
  `created_date` varchar(19) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.user_master`
--

INSERT INTO `dbo.user_master` (`user_id`, `full_name`, `user_name`, `password`, `email_id`, `user_group_code`, `mobile_no`, `profile`, `created_by`, `created_date`) VALUES
(1, 'Sureshkumar Bathirappan', '120287TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'sureshkumar.bathirappan@toshiba-tjps.in', 'BB-001', 9962943087, '/TOSHIBA/images/profile/toshiba-sample.jpg', 1, '2017-04-06 11:14:05'),
(15, 'Hari Mohan Reddy', '100070TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Harimohan.Ramachandra@toshiba-tjps.in', 'BB-002', 8754456130, '', 1, '2017-11-16 10:08:20'),
(18, 'VIKRAMAN', 'vikram', 'cd84d683cc5612c69efe115c80d0b7dc', 'vikraman@bluebase.in', '', 8608401212, '', 1, '2017-10-24 08:39:23'),
(19, 'Nandakumar Lingadas', '100071TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'nandakumar.lingadas@toshiba-tjps.in', '', 9677002567, '', 1, '2017-11-16 10:08:43'),
(20, 'Venkataramani S', '100042TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'venkataramani.srinivasan@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 06:59:26'),
(21, 'Govindaraju Ganesan', '110115TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'sureshkumar.bathirappan@toshiba-tjps.in', '', 1234567890, '', 1, '2018-03-28 03:36:22'),
(22, 'Sandip Prabhudas', '110170TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'sandipghiya.prabhudas@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 07:02:23'),
(23, 'Narasimhanna', '120212TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'kumar.narasimhanna@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 07:03:35'),
(24, 'Varadappan  Saravanan', '120226TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'saravanan.varadhappan@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 07:05:30'),
(25, 'P A Kamesh Varagunan', '120234TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'kameswaran.palanichamy@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 07:06:15'),
(26, 'Moses  Savarimuthu', '120240TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'moses.savarimuthu@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 07:07:06'),
(27, 'Shafiqur  Rahman', '140784TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'shafiqur.rahman@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 07:07:44'),
(28, 'Hiroshi Nishimura', 'E-00006', 'cd84d683cc5612c69efe115c80d0b7dc', 'hiroshi1.nishimura@toshiba.co.jp', '', 1234567890, '', 1, '2017-11-24 07:08:19'),
(29, 'Taro Sakamoto', 'E-00030', 'cd84d683cc5612c69efe115c80d0b7dc', 'taro.sakamoto@toshiba.co.jp', '', 1234567890, '', 1, '2017-11-24 07:08:53'),
(30, 'Rajmohan Palanivelu', '100043TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'rajmohan.palanivelu@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 07:10:28'),
(32, 'Kannappan  R', '130383TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'kannappan.radhakrishnan@toshiba-tjps.in', '', 1234567890, '', 1, '2017-11-24 07:12:04'),
(33, 'Sivakarthigeyan  J', '140639TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'sivakarthigeyan.janakiraman@toshiba-tjps.in', '', 1234656789, '', 1, '2017-11-24 07:12:47'),
(34, 'Vasanthaselvan', 'CSO', 'cd84d683cc5612c69efe115c80d0b7dc', 'vasanthaselvan.karuppasamy@toshiba-tjps.in', '', 8754456138, '', 1, '2018-10-20 08:05:50'),
(35, 'Dinesh J Shetty ', '100019TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Dinesh.Shetty@toshiba-tjps.in', '', 8754456136, '', 1, '2018-01-31 06:16:31'),
(36, 'Arumugadas P', '110085TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Arumugadas.Palavesam@toshiba-tjps.in', '', 8754577251, '', 1, '2018-01-31 06:19:59'),
(37, 'Lingadurai Arumugam', '110084TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Lingadurai.Arumugam@toshiba-tjps.in', '', 8754468373, '', 1, '2018-01-31 06:21:41'),
(38, 'Venkatesan  P', '130401TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'venkatesan.pattaiyan@toshiba-tjps.in', '', 9500360750, '', 1, '2018-01-31 06:25:19'),
(39, 'Karthik C', '140809TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'karthik.chandrasekar@toshiba-tjps.in', '', 9677153666, '', 1, '2018-01-31 06:26:12'),
(40, 'Mohan Raj A', '150927TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'mohanraj.anbalagan@toshiba-tjps.in', '', 7358050757, '', 1, '2018-01-31 06:26:52'),
(41, 'Rameshkumar Ramalingam', '100044TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'RameshKumar.Ramalingam@toshiba-tjps.in', '', 8754498902, '', 1, '2018-02-10 08:58:43'),
(42, 'Bharath Kumar Krishnan', '100058TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'BharathKumar.Krishnan@toshiba-tjps.in', '', 9488844556, '', 1, '2018-02-10 08:59:18'),
(43, 'Kalaiselvan Raja', '100059TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Kalaiselvan.Raja@toshiba-tjps.in', '', 9840847240, '', 1, '2018-02-10 09:00:10'),
(44, 'Govindaswamy Ganesh', '100067TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Ganesh.Govindasamy@toshiba-tjps.in', '', 8754498904, '', 1, '2018-02-10 09:00:42'),
(45, 'Selvakumar Chinnakali', '110097TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Selvakumar.Chinnakali@toshiba-tjps.in', '', 9566160083, '', 1, '2018-02-10 09:01:12'),
(46, 'Murasoli P', '110101TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Murasoli.Palanivel@toshiba-tjps.in', '', 9566022267, '', 1, '2018-09-25 03:02:23'),
(47, 'K Venkatesan', '110189TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Venkatesan.Kubendran@toshiba-tjps.in', '', 9952657076, '', 1, '2018-04-26 08:01:03'),
(48, 'Sudhakar J', '120318TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'sudhakar.jayaraj@toshiba-tjps.in', '', 8754498905, '', 1, '2018-02-10 09:03:40'),
(49, 'Mohamed Asik M', '110184TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Mohamedasik.Iqbal@toshiba-tjps.in', '', 8754577252, '', 1, '2018-02-15 08:24:26'),
(50, 'Anbu', '171107TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'anbu.arokiasamy@toshiba-tjps.in', '', 9840569255, '', 1, '2018-02-15 10:22:24'),
(51, 'Sridhar K R', '150915TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'sridhar.raju@toshiba-tjps.in', '', 7358077066, '', 1, '2018-02-15 10:23:13'),
(52, 'Security', 'Security', 'cd84d683cc5612c69efe115c80d0b7dc', 'security.chennai@toshiba-tjps.in', '', 8754456138, '', 1, '2018-05-08 03:30:44'),
(53, 'Vinothganesh', '176148TC', 'cd84d683cc5612c69efe115c80d0b7dc', 'vinoth.ganesh@toshiba-tjps.in', '', 9500109378, '', 1, '2018-02-15 10:53:24'),
(54, 'Aravinth Thirumalai', '120256TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'aravinth.thirumalai@toshiba-tjps.in', '', 9486088751, '', 1, '2018-09-17 05:54:26'),
(55, 'Dillibabu S', '120257TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'dillibabu.sundharajan@toshiba-tjps.in', '', 9884256707, '', 1, '2018-09-17 05:54:55'),
(56, 'Karthikeyan S', '140834TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'karthikeyan.sivasankaran@toshiba-tjps.in', '', 8072612303, '', 1, '2018-09-17 05:55:11'),
(57, 'Kovendan T', '120316TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Kovendan.Thilakaran@toshiba-tjps.in', '', 7708179039, '', 1, '2018-09-17 05:55:33'),
(58, 'Mohanselvarajan K', '120326TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Mohanselvarajan.kumaran@toshiba-tjps.in', '', 9442604219, '', 1, '2018-09-17 05:55:49'),
(59, 'Munusamy K', '130367TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'munusamy.krishnamoorthy@toshiba-tjps.in', '', 7810036076, '', 1, '2018-09-17 05:56:07'),
(60, 'Perumalraja Krishnamoorthy', '110117TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'perumalraja.krishnamoorthy@toshiba-tjps.in', '', 9003055770, '', 1, '2018-09-17 05:56:23'),
(61, 'Ramachandra Raja K', '120309TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Ramachandraraja.krishnamurthy@toshiba-tjps.in', '', 9677261161, '', 1, '2018-09-17 05:56:39'),
(62, 'Ramesh Kumar T M', '130408TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'rameshkumar.murugan@toshiba-tjps.in', '', 9043271698, '', 1, '2018-09-17 05:56:55'),
(63, 'Silambuselvan V', '140700TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'silambuselvan.villalan@toshiba-tjps.in', '', 8678977042, '', 1, '2018-09-17 05:57:11'),
(64, 'Srinivasan S', '120307TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'srinivasan.selvam@toshiba-tjps.in', '', 9952458872, '', 1, '2018-09-17 05:57:27'),
(65, 'Suresh Velu', '120324TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'suresh.velu@toshiba-tjps.in', '', 9585454550, '', 1, '2018-09-17 05:57:43'),
(66, 'Thanigachalam T', '130333TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Thanigachalam.thangavel@toshiba-tjps.in', '', 9003116214, '', 1, '2018-09-17 05:58:01'),
(67, 'Vaithiyalingam E', '110146TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'Vaithiyalingam.Elumalai@toshiba-tjps.in', '', 9003220882, '', 1, '2018-09-17 05:58:24'),
(68, 'Yuvaraj U ', '161061TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'yuvaraj.ungappan@toshiba-tjps.in', '', 9840992916, '', 1, '2018-09-17 05:58:39'),
(69, 'Raghu Balakrishnan', '120305TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'raghu.balakrishnan@toshiba-tjps.in', '', 9944710473, '', 1, '2018-12-13 03:19:19'),
(70, 'Sathish M', '191242TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'sathish.manohar@toshiba-tjps.in', '', 9962470508, '', 1, '2019-04-23 04:23:50'),
(71, 'Guhan P M', '191293TJ', 'cd84d683cc5612c69efe115c80d0b7dc', 'guhan.muruganandham@toshiba-tjps.in', '', 8608783364, '', 1, '2019-10-17 04:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.user_validation`
--

DROP TABLE IF EXISTS `dbo.user_validation`;
CREATE TABLE IF NOT EXISTS `dbo.user_validation` (
  `id` int(11) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `allow` tinyint(4) DEFAULT NULL,
  `reason` varchar(25) DEFAULT NULL,
  `date` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.user_validation`
--

INSERT INTO `dbo.user_validation` (`id`, `emp_code`, `allow`, `reason`, `date`) VALUES
(24402357, 'EMP-745', 1, 'Employee Inactive', '2020-01-28'),
(24402358, 'EMP-746', 1, 'Employee Inactive', '2020-01-28'),
(24402359, 'EMP-760', 1, 'Employee Inactive', '2020-01-28'),
(24402360, 'EMP-761', 1, 'Employee Inactive', '2020-01-28'),
(24402361, 'EMP-762', 1, 'Employee Inactive', '2020-01-28'),
(24402362, 'EMP-765', 1, 'Employee Inactive', '2020-01-28'),
(24402363, 'EMP-794', 1, 'Employee Inactive', '2020-01-28'),
(24402364, 'EMP-795', 1, 'Employee Inactive', '2020-01-28'),
(24402365, 'EMP-734', 1, 'Employee Inactive', '2020-01-28'),
(24402366, 'EMP-790', 1, 'Employee Inactive', '2020-01-28'),
(24402367, 'EMP-793', 1, 'Employee Inactive', '2020-01-28'),
(24402368, 'EMP-796', 1, 'Employee Inactive', '2020-01-28'),
(24402369, 'EMP-797', 1, 'Employee Inactive', '2020-01-28'),
(24402370, 'EMP-798', 1, 'Employee Inactive', '2020-01-28'),
(24402371, 'EMP-800', 1, 'Employee Inactive', '2020-01-28'),
(24402372, 'EMP-802', 1, 'Employee Inactive', '2020-01-28'),
(24402373, 'EMP-810', 1, 'Employee Inactive', '2020-01-28'),
(24402374, 'EMP-737', 1, 'Employee Inactive', '2020-01-28'),
(24402375, 'EMP-751', 1, 'Employee Inactive', '2020-01-28'),
(24402376, 'EMP-814', 1, 'Employee Inactive', '2020-01-28'),
(24402377, 'EMP-815', 1, 'Employee Inactive', '2020-01-28'),
(24402378, 'EMP-821', 1, 'Employee Inactive', '2020-01-28'),
(24402379, 'EMP-829', 1, 'Employee Inactive', '2020-01-28'),
(24402380, 'EMP-748', 1, 'Employee Inactive', '2020-01-28'),
(24402381, 'EMP-824', 1, 'Employee Inactive', '2020-01-28'),
(24402382, 'EMP-830', 1, 'Employee Inactive', '2020-01-28'),
(24402383, 'EMP-849', 1, 'Employee Inactive', '2020-01-28'),
(24402384, 'EMP-850', 1, 'Employee Inactive', '2020-01-28'),
(24402385, 'EMP-879', 1, 'Employee Inactive', '2020-01-28'),
(24402386, 'EMP-909', 1, 'Employee Inactive', '2020-01-28'),
(24402387, 'EMP-741', 1, 'Employee Inactive', '2020-01-28'),
(24402388, 'EMP-742', 1, 'Employee Inactive', '2020-01-28'),
(24402389, 'EMP-743', 1, 'Employee Inactive', '2020-01-28'),
(24402390, 'EMP-812', 1, 'Employee Inactive', '2020-01-28'),
(24402391, 'EMP-910', 1, 'Employee Inactive', '2020-01-28'),
(24402392, 'EMP-766', 1, 'Employee Inactive', '2020-01-28'),
(24402393, 'EMP-791', 1, 'Employee Inactive', '2020-01-28'),
(24402394, 'EMP-792', 1, 'Employee Inactive', '2020-01-28'),
(24402395, 'EMP-823', 1, 'Employee Inactive', '2020-01-28'),
(24402396, 'EMP-905', 1, 'Employee Inactive', '2020-01-28'),
(24402397, 'EMP-915', 1, 'Employee Inactive', '2020-01-28'),
(24402398, 'EMP-839', 1, 'Employee Inactive', '2020-01-28'),
(24402399, 'EMP-869', 1, 'Employee Inactive', '2020-01-28'),
(24402400, 'EMP-892', 1, 'Employee Inactive', '2020-01-28'),
(24402401, 'EMP-916', 1, 'Employee Inactive', '2020-01-28'),
(24402402, 'EMP-822', 1, 'Employee Inactive', '2020-01-28'),
(24402403, 'EMP-825', 1, 'Employee Inactive', '2020-01-28'),
(24402404, 'EMP-858', 1, 'Employee Inactive', '2020-01-28'),
(24402405, 'EMP-902', 1, 'Employee Inactive', '2020-01-28'),
(24402406, 'EMP-903', 1, 'Employee Inactive', '2020-01-28'),
(24402407, 'EMP-871', 1, 'Employee Inactive', '2020-01-28'),
(24402408, 'EMP-867', 1, 'Employee Inactive', '2020-01-28'),
(24402409, 'EMP-868', 1, 'Employee Inactive', '2020-01-28'),
(24402410, 'EMP-893', 1, 'Employee Inactive', '2020-01-28'),
(24402411, 'EMP-900', 1, 'Employee Inactive', '2020-01-28'),
(24402412, 'EMP-901', 1, 'Employee Inactive', '2020-01-28'),
(24402413, 'EMP-908', 1, 'Employee Inactive', '2020-01-28'),
(24402414, 'EMP-911', 1, 'Employee Inactive', '2020-01-28'),
(24402415, 'EMP-938', 1, 'Employee Inactive', '2020-01-28'),
(24402416, 'EMP-912', 1, 'Employee Inactive', '2020-01-28'),
(24402417, 'EMP-947', 1, 'Employee Inactive', '2020-01-28'),
(24402418, 'EMP-954', 1, 'Employee Inactive', '2020-01-28'),
(24402419, 'EMP-960', 1, 'Employee Inactive', '2020-01-28'),
(24402420, 'EMP-961', 1, 'Employee Inactive', '2020-01-28'),
(24402421, 'EMP-962', 1, 'Employee Inactive', '2020-01-28'),
(24402422, 'EMP-963', 1, 'Employee Inactive', '2020-01-28'),
(24402423, 'EMP-988', 1, 'Employee Inactive', '2020-01-28'),
(24402424, 'EMP-990', 1, 'Employee Inactive', '2020-01-28'),
(24402425, 'EMP-991', 1, 'Employee Inactive', '2020-01-28'),
(24402426, 'EMP-967', 1, 'Employee Inactive', '2020-01-28'),
(24402427, 'EMP-980', 1, 'Employee Inactive', '2020-01-28'),
(24402428, 'EMP-571', 1, 'Employee Inactive', '2020-01-28'),
(24402429, 'EMP-572', 1, 'Employee Inactive', '2020-01-28'),
(24402430, 'EMP-573', 1, 'Employee Inactive', '2020-01-28'),
(24402431, 'EMP-574', 1, 'Employee Inactive', '2020-01-28'),
(24402432, 'EMP-604', 1, 'Employee Inactive', '2020-01-28'),
(24402433, 'EMP-631', 1, 'Employee Inactive', '2020-01-28'),
(24402434, 'EMP-634', 1, 'Employee Inactive', '2020-01-28'),
(24402435, 'EMP-626', 1, 'Employee Inactive', '2020-01-28'),
(24402436, 'EMP-627', 1, 'Employee Inactive', '2020-01-28'),
(24402437, 'EMP-630', 1, 'Employee Inactive', '2020-01-28'),
(24402438, 'EMP-652', 1, 'Employee Inactive', '2020-01-28'),
(24402439, 'EMP-653', 1, 'Employee Inactive', '2020-01-28'),
(24402440, 'EMP-659', 1, 'Employee Inactive', '2020-01-28'),
(24402441, 'EMP-661', 1, 'Employee Inactive', '2020-01-28'),
(24402442, 'EMP-662', 1, 'Employee Inactive', '2020-01-28'),
(24402443, 'EMP-622', 1, 'Employee Inactive', '2020-01-28'),
(24402444, 'EMP-635', 1, 'Employee Inactive', '2020-01-28'),
(24402445, 'EMP-642', 1, 'Employee Inactive', '2020-01-28'),
(24402446, 'EMP-678', 1, 'Employee Inactive', '2020-01-28'),
(24402447, 'EMP-679', 1, 'Employee Inactive', '2020-01-28'),
(24402448, 'EMP-680', 1, 'Employee Inactive', '2020-01-28'),
(24402449, 'EMP-681', 1, 'Employee Inactive', '2020-01-28'),
(24402450, 'EMP-682', 1, 'Employee Inactive', '2020-01-28'),
(24402451, 'EMP-683', 1, 'Employee Inactive', '2020-01-28'),
(24402452, 'EMP-690', 1, 'Employee Inactive', '2020-01-28'),
(24402453, 'EMP-693', 1, 'Employee Inactive', '2020-01-28'),
(24402454, 'EMP-705', 1, 'Employee Inactive', '2020-01-28'),
(24402455, 'EMP-668', 1, 'Employee Inactive', '2020-01-28'),
(24402456, 'EMP-709', 1, 'Employee Inactive', '2020-01-28');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.wage_period_master`
--

DROP TABLE IF EXISTS `dbo.wage_period_master`;
CREATE TABLE IF NOT EXISTS `dbo.wage_period_master` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(7) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.wage_period_master`
--

INSERT INTO `dbo.wage_period_master` (`id`, `name`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'DAILY', '', '', '', ''),
(2, 'WEEKLY', '', '', '', ''),
(3, 'MONTHLY', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.workers_category_master`
--

DROP TABLE IF EXISTS `dbo.workers_category_master`;
CREATE TABLE IF NOT EXISTS `dbo.workers_category_master` (
  `id` tinyint(4) DEFAULT NULL,
  `name` varchar(10) DEFAULT NULL,
  `creted_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.workers_category_master`
--

INSERT INTO `dbo.workers_category_master` (`id`, `name`, `creted_by`, `created_on`) VALUES
(2, 'UNSKILLED', '', ''),
(3, 'SEMISKILED', '', ''),
(1, 'SKILLED', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.workpermit_approve`
--

DROP TABLE IF EXISTS `dbo.workpermit_approve`;
CREATE TABLE IF NOT EXISTS `dbo.workpermit_approve` (
  `id` mediumint(9) DEFAULT NULL,
  `emp_code` varchar(8) DEFAULT NULL,
  `from_date` varchar(10) DEFAULT NULL,
  `to_date` varchar(10) DEFAULT NULL,
  `permit_code` varchar(8) DEFAULT NULL,
  `incharge_approve` varchar(1) DEFAULT NULL,
  `incharge_remarks` varchar(20) DEFAULT NULL,
  `incharge_date` varchar(10) DEFAULT NULL,
  `incharge_name` varchar(2) DEFAULT NULL,
  `po_approve` varchar(1) DEFAULT NULL,
  `po_remarks` varchar(26) DEFAULT NULL,
  `po_date` varchar(10) DEFAULT NULL,
  `po_name` varchar(2) DEFAULT NULL,
  `hse_approve` varchar(1) DEFAULT NULL,
  `hse_remarks` varchar(42) DEFAULT NULL,
  `hse_date` varchar(10) DEFAULT NULL,
  `hse_name` varchar(2) DEFAULT NULL,
  `hr_approve` varchar(1) DEFAULT NULL,
  `hr_remarks` varchar(6) DEFAULT NULL,
  `hr_date` varchar(10) DEFAULT NULL,
  `hr_name` varchar(2) DEFAULT NULL,
  `isdeviation` varchar(2) DEFAULT NULL,
  `approver_name` varchar(2) DEFAULT NULL,
  `spl_name` varchar(0) DEFAULT NULL,
  `spl_remarks` varchar(0) DEFAULT NULL,
  `spl_date` varchar(0) DEFAULT NULL,
  `spl_approve` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.workpermit_approve`
--

INSERT INTO `dbo.workpermit_approve` (`id`, `emp_code`, `from_date`, `to_date`, `permit_code`, `incharge_approve`, `incharge_remarks`, `incharge_date`, `incharge_name`, `po_approve`, `po_remarks`, `po_date`, `po_name`, `hse_approve`, `hse_remarks`, `hse_date`, `hse_name`, `hr_approve`, `hr_remarks`, `hr_date`, `hr_name`, `isdeviation`, `approver_name`, `spl_name`, `spl_remarks`, `spl_date`, `spl_approve`) VALUES
(1, 'EMP-001', '2017-12-01', '2018-03-31', 'PER-001', '1', '', '2018-02-02', '34', '1', '', '2018-02-02', '19', '1', '', '2018-02-02', '33', '1', '', '2018-02-02', '1', '', '', '', '', '', ''),
(2, 'EMP-002', '2017-12-01', '2018-03-31', 'PER-002', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-02-02', '1', '', '', '', '', '', ''),
(3, 'EMP-003', '2017-12-01', '2018-03-31', 'PER-003', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(4, 'EMP-004', '2017-12-01', '2018-03-31', 'PER-004', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(5, 'EMP-005', '2017-12-01', '2018-03-31', 'PER-005', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(6, 'EMP-006', '2017-12-01', '2018-03-31', 'PER-006', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(7, 'EMP-007', '2017-12-01', '2018-03-31', 'PER-007', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(8, 'EMP-008', '2017-12-01', '2018-03-31', 'PER-008', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(9, 'EMP-009', '2017-12-01', '2018-03-31', 'PER-009', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(10, 'EMP-010', '2017-12-01', '2018-03-31', 'PER-010', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-10-03', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(11, 'EMP-011', '2017-12-01', '2018-03-31', 'PER-011', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(12, 'EMP-012', '2017-12-01', '2018-03-31', 'PER-012', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(13, 'EMP-013', '2017-12-01', '2018-03-31', 'PER-013', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(14, 'EMP-014', '2017-12-01', '2018-03-31', 'PER-014', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(15, 'EMP-015', '2017-12-01', '2018-03-31', 'PER-015', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(16, 'EMP-016', '2017-12-01', '2018-03-31', 'PER-016', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(17, 'EMP-017', '2017-12-01', '2018-03-31', 'PER-017', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(18, 'EMP-018', '2017-12-01', '2018-03-31', 'PER-018', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(19, 'EMP-019', '2017-12-01', '2018-03-31', 'PER-019', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(20, 'EMP-020', '2017-12-01', '2018-03-31', 'PER-020', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-10-22', '33', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(21, 'EMP-021', '2017-12-01', '2018-03-31', 'PER-021', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(22, 'EMP-022', '2017-12-01', '2018-03-31', 'PER-022', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(23, 'EMP-023', '2017-12-01', '2018-03-31', 'PER-023', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-10-03', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(24, 'EMP-024', '2017-12-01', '2018-03-31', 'PER-024', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(25, 'EMP-025', '2017-12-01', '2018-03-31', 'PER-025', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(26, 'EMP-026', '2017-12-01', '2018-03-31', 'PER-026', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(27, 'EMP-027', '2017-12-01', '2018-03-31', 'PER-027', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(28, 'EMP-028', '2017-12-01', '2018-03-31', 'PER-028', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(29, 'EMP-029', '2017-12-01', '2018-03-31', 'PER-029', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(30, 'EMP-030', '2017-12-01', '2018-03-31', 'PER-030', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(31, 'EMP-031', '2017-12-01', '2018-03-31', 'PER-031', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(32, 'EMP-032', '2017-12-01', '2018-03-31', 'PER-032', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(33, 'EMP-033', '2017-12-01', '2018-03-31', 'PER-033', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(34, 'EMP-034', '2017-12-01', '2018-03-31', 'PER-034', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(35, 'EMP-035', '2017-12-01', '2018-03-31', 'PER-035', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(36, 'EMP-036', '2017-12-01', '2018-03-31', 'PER-036', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(37, 'EMP-037', '2017-12-01', '2018-03-31', 'PER-037', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(38, 'EMP-038', '2017-12-01', '2018-03-31', 'PER-038', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(39, 'EMP-039', '2017-12-01', '2018-03-31', 'PER-039', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(40, 'EMP-040', '2017-12-01', '2018-03-31', 'PER-040', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(41, 'EMP-041', '2017-12-01', '2018-03-31', 'PER-041', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(42, 'EMP-042', '2017-12-01', '2018-03-31', 'PER-042', '1', '', '2018-06-30', '45', '1', '', '2019-01-25', '49', '1', 'HSE Induction Required', '2018-06-27', '33', '1', '', '2018-07-06', '1', '', '', '', '', '', ''),
(43, 'EMP-043', '2017-12-01', '2018-03-31', 'PER-043', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(44, 'EMP-044', '2017-12-01', '2018-03-31', 'PER-044', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(45, 'EMP-045', '2017-12-01', '2018-03-31', 'PER-045', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(46, 'EMP-046', '2017-12-01', '2018-03-31', 'PER-046', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(47, 'EMP-047', '2017-12-01', '2018-03-31', 'PER-047', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(48, 'EMP-048', '2017-12-01', '2018-03-31', 'PER-048', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(49, 'EMP-049', '2017-12-01', '2018-03-31', 'PER-049', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(50, 'EMP-050', '2017-12-01', '2018-03-31', 'PER-050', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(51, 'EMP-051', '2017-12-01', '2018-03-31', 'PER-051', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(52, 'EMP-052', '2017-12-01', '2018-03-31', 'PER-052', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(53, 'EMP-053', '2017-12-01', '2018-03-31', 'PER-053', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(54, 'EMP-054', '2017-12-01', '2018-03-31', 'PER-054', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(55, 'EMP-055', '2017-12-01', '2018-03-31', 'PER-055', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(56, 'EMP-056', '2017-12-01', '2018-03-31', 'PER-056', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(57, 'EMP-057', '2017-12-01', '2018-03-31', 'PER-057', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '1', '', '', '', ''),
(58, 'EMP-058', '2017-12-01', '2018-03-31', 'PER-058', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(59, 'EMP-059', '2017-12-01', '2018-03-31', 'PER-059', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(60, 'EMP-060', '2017-12-01', '2018-03-31', 'PER-060', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(61, 'EMP-061', '2017-12-01', '2018-03-31', 'PER-061', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(62, 'EMP-062', '2017-12-01', '2018-03-31', 'PER-062', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(63, 'EMP-063', '2017-12-01', '2018-03-31', 'PER-063', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(64, 'EMP-064', '2017-12-01', '2018-03-31', 'PER-064', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(65, 'EMP-065', '2017-12-01', '2018-03-31', 'PER-065', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(66, 'EMP-066', '2017-12-01', '2018-03-31', 'PER-066', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(67, 'EMP-067', '2017-12-01', '2018-03-31', 'PER-067', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(68, 'EMP-068', '2017-12-01', '2018-03-31', 'PER-068', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(69, 'EMP-069', '2017-12-01', '2018-03-31', 'PER-069', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(70, 'EMP-070', '2017-12-01', '2018-03-31', 'PER-070', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(71, 'EMP-071', '2017-12-01', '2018-03-31', 'PER-071', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(72, 'EMP-072', '2017-12-01', '2018-03-31', 'PER-072', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(73, 'EMP-073', '2017-12-01', '2018-03-31', 'PER-073', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(74, 'EMP-074', '2017-12-01', '2018-03-31', 'PER-074', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(75, 'EMP-075', '2017-12-01', '2018-03-31', 'PER-075', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(76, 'EMP-076', '2017-12-01', '2018-03-31', 'PER-076', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(77, 'EMP-077', '2017-12-01', '2018-03-31', 'PER-077', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(78, 'EMP-078', '2017-12-01', '2018-03-31', 'PER-078', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(79, 'EMP-079', '2017-12-01', '2018-03-31', 'PER-079', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(80, 'EMP-080', '2017-12-01', '2018-03-31', 'PER-080', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(81, 'EMP-081', '2017-12-01', '2018-03-31', 'PER-081', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(82, 'EMP-082', '2017-12-01', '2018-03-31', 'PER-082', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(83, 'EMP-083', '2017-12-01', '2018-03-31', 'PER-083', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(84, 'EMP-084', '2017-12-01', '2018-03-31', 'PER-084', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(85, 'EMP-085', '2017-12-01', '2018-03-31', 'PER-085', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(86, 'EMP-086', '2017-12-01', '2018-03-31', 'PER-086', '1', 'HR One Time Approval', '2017-12-04', '1', '1', '', '2017-12-04', '19', '1', '', '2017-12-04', '30', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(87, 'EMP-087', '2017-12-01', '2018-03-31', 'PER-087', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(88, 'EMP-088', '2017-12-01', '2018-03-31', 'PER-088', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(89, 'EMP-089', '2017-12-01', '2018-03-31', 'PER-089', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(90, 'EMP-090', '2017-12-01', '2018-03-31', 'PER-090', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(91, 'EMP-091', '2017-12-01', '2018-03-31', 'PER-091', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(92, 'EMP-092', '2017-12-01', '2018-03-31', 'PER-092', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2017-12-04', '1', '', '', '', '', '', ''),
(93, 'EMP-093', '2017-12-01', '2018-03-31', 'PER-093', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-04-13', '1', '', '', '', '', '', ''),
(94, 'EMP-094', '2017-12-01', '2018-03-31', 'PER-094', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-04-13', '1', '', '', '', '', '', ''),
(95, 'EMP-095', '2017-12-01', '2018-03-31', 'PER-095', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-04-13', '1', '', '', '', '', '', ''),
(96, 'EMP-096', '2017-12-01', '2018-03-31', 'PER-096', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-04-13', '1', '', '', '', '', '', ''),
(97, 'EMP-097', '2017-12-01', '2018-03-31', 'PER-097', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-04-13', '1', '', '', '', '', '', ''),
(98, 'EMP-098', '2017-12-01', '2018-03-31', 'PER-098', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-04-13', '1', '', '', '', '', '', ''),
(99, 'EMP-099', '2017-12-01', '2018-03-31', 'PER-099', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-04-13', '1', '', '', '', '', '', ''),
(100, 'EMP-100', '2017-12-01', '2018-03-31', 'PER-100', '1', '', '2019-01-25', '46', '1', '', '2019-01-25', '49', '1', '', '2018-09-27', '32', '1', '', '2018-04-13', '1', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `dbo.workpermit_approve_access`
--

DROP TABLE IF EXISTS `dbo.workpermit_approve_access`;
CREATE TABLE IF NOT EXISTS `dbo.workpermit_approve_access` (
  `id` varchar(0) DEFAULT NULL,
  `menu` varchar(0) DEFAULT NULL,
  `user_id` varchar(0) DEFAULT NULL,
  `status` varchar(0) DEFAULT NULL,
  `created_by` varchar(0) DEFAULT NULL,
  `created_on` varchar(0) DEFAULT NULL,
  `modified_by` varchar(0) DEFAULT NULL,
  `modified_on` varchar(0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `dbo.work_area_master`
--

DROP TABLE IF EXISTS `dbo.work_area_master`;
CREATE TABLE IF NOT EXISTS `dbo.work_area_master` (
  `area_id` tinyint(4) DEFAULT NULL,
  `area_name` varchar(12) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(1) DEFAULT NULL,
  `created_on` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dbo.work_area_master`
--

INSERT INTO `dbo.work_area_master` (`area_id`, `area_name`, `status`, `created_by`, `created_on`) VALUES
(1, 'Admin Block', 0, '', '2016-02-14 13:33:11'),
(2, 'Blade Shop', 0, '', '2016-02-14 13:33:36'),
(3, 'Casing', 0, '', '2016-02-14 13:33:40'),
(4, 'Core Shop', 0, '', '2016-02-14 13:33:58'),
(5, 'Cutting', 0, '', '2016-02-14 13:34:03'),
(6, 'CVM', 0, '', '2016-02-14 13:34:06'),
(7, 'CVA', 0, '', '2016-02-14 13:34:18'),
(8, 'Finace', 0, '', '2016-02-14 13:34:22'),
(9, 'FL Optr', 0, '', '2016-02-14 13:34:51'),
(10, 'Gen Assby', 0, '', '2016-02-14 13:35:11'),
(11, 'H T Weld', 0, '', '2016-02-14 13:35:36'),
(12, 'HR Admin', 0, '', '2016-02-14 13:35:40'),
(13, 'Marketing', 0, '', '2016-02-14 13:35:45'),
(14, 'Large M/C', 0, '', '2016-02-14 13:36:08'),
(15, 'NDT', 0, '', '2016-02-14 13:36:11'),
(16, 'NOZZELE NABR', 0, '', '2016-02-14 13:36:52'),
(17, 'NOZZELE M/C', 0, '', '2016-02-14 13:37:08'),
(18, 'NOZZELE FSHG', 0, '', '2016-02-14 13:37:36'),
(19, 'Paint Booth', 0, '', '2016-02-14 13:38:06'),
(20, 'PFM', 0, '', '2016-02-14 13:38:09'),
(21, 'Plant', 0, '', '2016-02-14 13:38:12'),
(22, 'PMD', 0, '', '2016-02-14 13:38:32'),
(23, 'PMG', 0, '', '2016-02-14 13:38:35'),
(24, 'Procurment', 0, '', '2016-02-14 13:38:41'),
(25, 'RTR Assby', 0, '', '2016-02-14 13:39:10'),
(26, 'RTR M/C', 0, '', '2016-02-14 13:39:18'),
(27, 'RTR Coil MFG', 0, '', '2016-02-14 13:39:43'),
(28, 'Stores', 0, '', '2016-02-14 13:39:49'),
(29, 'STATOR Assby', 0, '', '2016-02-14 13:40:51'),
(30, 'STATOR Coil', 0, '', '2016-02-14 13:40:58'),
(31, 'Trub Assby', 0, '', '2016-02-14 13:41:15'),
(32, 'Test', 0, '1', '2016-02-16 14:14:06'),
(33, 'test 1', 0, '1', '2017-04-12 11:24:27'),
(34, 'test2edit2', 0, '1', '2017-04-12 11:48:04'),
(35, 'ALL AREA', 0, '1', '2017-11-27 12:11:38'),
(36, 'Garden', 0, '1', '2017-12-08 14:10:35'),
(37, 'Bus Terminus', 0, '1', '2018-02-15 11:03:37'),
(38, 'canteen', 0, '1', '2018-02-19 10:59:23'),
(39, 'Canteen', 0, '1', '2018-02-22 12:13:25');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
