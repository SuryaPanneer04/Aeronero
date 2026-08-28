-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 29, 2021 at 07:55 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` text,
  `fax` text,
  `point_of_contact_name` text,
  `website` text,
  `phone1` text,
  `phone2` text,
  `telephone` text,
  `email` text,
  `mailing_address` text,
  `contact_email` text,
  `details_of_services` text,
  `business_type` text,
  `annual_sales` text,
  `years_previous` text,
  `insured` text,
  `license_number` text,
  `date_company_established` text,
  `service_area` text,
  `legal_structure` text,
  `bonded` text,
  `licensed` text,
  `additional_info` text,
  `bank_name` text,
  `bank_name1` text,
  `account_number` text,
  `bank_address` text,
  `typed_name` text,
  `title` text,
  `signature` text,
  `date` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `company_name`, `fax`, `point_of_contact_name`, `website`, `phone1`, `phone2`, `telephone`, `email`, `mailing_address`, `contact_email`, `details_of_services`, `business_type`, `annual_sales`, `years_previous`, `insured`, `license_number`, `date_company_established`, `service_area`, `legal_structure`, `bonded`, `licensed`, `additional_info`, `bank_name`, `bank_name1`, `account_number`, `bank_address`, `typed_name`, `title`, `signature`, `date`) VALUES
(1, 'bluebase', '235345', 'dvd', 'cv', '08110956075', '08110956075', '8989898989', 'sdf', 'xcv', 'cxv', 'zxc', 'fuestech', 'dsc', 'zdc', 'asc', 'sc', 'fuestech', 'zxC', 'sad', 'sac', 'asc', 'asc', 'zxc', 'sa', 'adsc', 'Ambattur', 'sac', 'savc', 'sc', 'zxc'),
(2, 'quadsel', 'saf', 'sdfffsf', 'sf', 'dsf', 'dsg', 'sdfds', 'sdf', 'saffs', 'sf', 'dsg', 'dgs', '1000', 'dsv', 'ds', 'drsg', 'dssg', 'dg', 'cdz', 'dsv', 'ed', 'sge', 'esgd', 'sgde', 'esg', 'sgd', 'sdge', 'esg', 'sdg', 'sdg');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
