-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 09, 2022 at 08:44 AM
-- Server version: 5.7.31
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ss_info_new`
--

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
  `created_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` varchar(50) NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll_master`
--

INSERT INTO `payroll_master` (`id`, `month`, `year`, `date`, `flag`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 2022, '2022-08-09', 0, '1', '2022-08-09 11:00:27', '', '2022-08-09 11:00:27'),
(2, 2, 2022, '2022-08-09', 0, '1', '2022-08-09 11:00:27', '', '2022-08-09 11:00:27'),
(3, 3, 2022, '2022-08-09', 0, '1', '2022-08-09 11:01:37', '', '2022-08-09 11:01:37'),
(4, 4, 2022, '2022-08-09', 0, '1', '2022-08-09 11:01:37', '', '2022-08-09 11:01:37'),
(5, 5, 2022, '2022-08-09', 0, '1', '2022-08-09 11:02:36', '', '2022-08-09 11:02:36'),
(6, 6, 2022, '2022-08-09', 0, '1', '2022-08-09 11:02:36', '', '2022-08-09 11:02:36'),
(7, 7, 2022, '2022-08-09', 2, '1', '2022-08-09 11:03:32', '', '2022-08-09 11:03:32'),
(8, 8, 2022, '2022-08-09', 0, '1', '2022-08-09 11:03:32', '', '2022-08-09 11:03:32'),
(9, 9, 2022, '2022-08-09', 0, '1', '2022-08-09 11:04:24', '', '2022-08-09 11:04:24'),
(10, 10, 2022, '2022-08-09', 0, '1', '2022-08-09 11:04:24', '', '2022-08-09 11:04:24'),
(11, 11, 2022, '2022-08-09', 0, '1', '2022-08-09 11:05:16', '', '2022-08-09 11:05:16'),
(12, 12, 2022, '2022-08-09', 0, '1', '2022-08-09 11:05:16', '', '2022-08-09 11:05:16');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
