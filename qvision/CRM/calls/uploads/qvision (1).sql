-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2025 at 10:39 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qvision`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `type`, `description`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Assets', NULL, 1, '2016-05-21 00:00:00', NULL, '0000-00-00 00:00:00'),
(2, 'Liability', NULL, 1, '2016-05-21 00:00:00', NULL, NULL),
(3, 'Equity', NULL, 1, '2016-05-21 00:00:00', NULL, NULL),
(4, 'Revenue/Receipts/Income', NULL, 1, '2016-05-21 00:00:00', NULL, NULL),
(5, 'Expense/Payments', NULL, 1, '2016-05-21 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_bank`
--

CREATE TABLE `accounts_bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL COMMENT 'This is used to travel over in the database for reference bank code by developer',
  `ledger_code` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `account_no` varchar(50) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_bank`
--

INSERT INTO `accounts_bank` (`id`, `code`, `ledger_code`, `name`, `account_no`, `description`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'BANK-001', 'L001', 'CURRENT A/C WITH CC BANK CHENNAI H.O.', '', '', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'BANK-002', 'L002', 'CURRENT A/C WITH UCO BANK (SOWCARPET)', '1118000222', '', 1, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(3, 'BANK-003', 'L003', 'CURRENT A/C WITH UCO BANK (MAIN)', '', '', 1, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00'),
(4, 'BANK-004', 'L004', 'SAVING BANK A/C WITH CCB - HO', '', 'staff related', 1, '0000-00-00 00:00:00', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_bs_group_master`
--

CREATE TABLE `accounts_bs_group_master` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `order_by` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `flag_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_bs_group_master`
--

INSERT INTO `accounts_bs_group_master` (`id`, `name`, `order_by`, `type`, `flag_id`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Members share capital', 1, 'liablities', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Current liablities', 2, 'liablities', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Adjustment heads', 3, 'liablities', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Undisbursed profit previous year', 4, 'liablities', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Overdue interest', 5, 'liablities', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'Cash on hand', 1, 'assets', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Investments', 2, 'assets', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'Advance', 3, 'Assets', 2, 0, '0000-00-00 00:00:00', 28, '2018-01-04 11:55:38'),
(9, 'Staff loans', 4, 'assets', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, 'Adjustment heads', 5, 'assets', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, 'Overdue interest', 6, 'assets', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_daybook_master`
--

CREATE TABLE `accounts_daybook_master` (
  `id` int(11) NOT NULL,
  `main_entity` varchar(255) NOT NULL,
  `main_entity_type` varchar(255) NOT NULL,
  `ledger_code` varchar(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_on` date NOT NULL,
  `modified_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_daybook_master`
--

INSERT INTO `accounts_daybook_master` (`id`, `main_entity`, `main_entity_type`, `ledger_code`, `flag`, `created_on`, `created_by`, `modified_on`, `modified_by`) VALUES
(11, 'VOUCHER', 'ADJUSTMENT SLIP', '', 1, '0000-00-00', 0, '0000-00-00', 0),
(12, 'VOUCHER', 'ADJUSTMENT SLIP FOR FD LOAN', '', 1, '0000-00-00', 0, '0000-00-00', 0),
(13, 'CASH VOUCHER', 'CASH RECEIPT', 'Z001', 1, '0000-00-00', 0, '0000-00-00', 0),
(14, 'CASH VOUCHER', 'CASH PAYMENT', '', 1, '0000-00-00', 0, '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_domain_entries`
--

CREATE TABLE `accounts_domain_entries` (
  `id` int(11) NOT NULL,
  `candids_id` int(11) DEFAULT NULL,
  `hire_id` int(11) DEFAULT NULL,
  `round_id` int(11) DEFAULT NULL,
  `round_name_id` int(11) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_on` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_ledger`
--

CREATE TABLE `accounts_ledger` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `accounts_id` int(11) NOT NULL,
  `pl_group_id` int(11) NOT NULL,
  `bs_group_id` int(11) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_ledger`
--

INSERT INTO `accounts_ledger` (`id`, `code`, `name`, `accounts_id`, `pl_group_id`, `bs_group_id`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '10000000', 'LIABILITY', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, '10100000', 'CAPITAL', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, '10300000', 'RESERVES & SURPLUS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, '10500000', 'LOANS & ADVANCES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, '10501000', 'SECURED LOAN', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, '10501100', 'VEHICLE LOAN', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, '10501200', 'BANK FACILITY', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'ACG122', 'BUSINESS LOAN', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, '10503000', 'UN SECURED LOAN', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(10, '10700000', 'CURRENT LIABILITIES & PROVISIONS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(11, '10701000', 'ADVANCE RECEIVED', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(12, '10703000', 'SUNDRY CREDITORS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(13, '10705000', 'PROV.FOR DEFERRED TAX', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(14, '10707000', 'OUTSTANDING EXP', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(15, '10709000', 'TAXES & DUTIES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(16, '10709100', 'PROVISION FOR TAXATION', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(17, '10709200', 'TDS PAYABLE-NEW', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(18, '10709300', 'SERVICE TAX', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(19, '10709500', 'SALES TAX', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(20, 'ACG125', 'GST', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(21, '52700000', 'TAXES & DUTIES.', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(22, 'ACG129', 'GST PAYABLE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(23, 'ACG130', 'SGST PAYABLE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(24, '11200000', 'OTHER LIABILITY AC', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(25, '20000000', 'ASSET', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(26, '20100000', 'FIXED ASSET - OFFICE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(27, '20101000', 'COMPUTERS & PERIPHERALS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(28, '20102000', 'OFFICE  EQUIPMENT & OTHERS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(29, '20104000', 'FURNITURE & FITTINGS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(30, '20106000', 'MOTOR VEHICLE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(31, '20107000', 'LAND & BUILDING', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(32, 'ACG123', 'ELECTRICAL', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(33, '20300000', 'CURRENT ASSET,  DEPOSITS, LOANS & ADVANCES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(34, '20301000', 'CURRENT ASSET', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(35, '20301100', 'CASH BALANCE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(36, '20301300', 'BANK ACCOUNT', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(37, '20301500', 'STOCK IN TRADE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(38, '20301700', 'SUNDRY DEBTORS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(39, 'ACG132', 'GROUP / DIVISION', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(40, '20303000', 'DEPOSITS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(41, '20303100', 'DEPOSIT AGST PERF. BG', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(42, '20303300', 'BANK DEPOSITS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(43, '20303400', 'EMD', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(44, '20303700', 'SECURITY DEPOSITS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(45, 'ACG124', 'DEPOSIT OTHERS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(46, '20305000', 'ADVANCES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(47, '20305100', 'TAX DEDUCTED SOURCES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(48, '20305300', 'ADVANCE TO STAFF', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(49, '20305500', 'IT REFUND RECEIVABLE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(50, '20307000', 'LOAN', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(51, '20307100', 'LOANS (ASSEST)', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(52, '20307300', 'LOANS (ASSETS)', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(53, 'ACG131', 'TDS RECEIVABLE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(54, '20900000', 'DEFERRED REVENUE EXPENSES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(55, '21200000', 'NON CLASSIFIED A/C', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(56, '30000000', 'DIRECT EXPENSES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(57, '30100000', 'COST OF GOODS SOLD', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(58, '30300000', 'PURCHASE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(59, '30301000', 'PURCHASE ACCOUNTS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(60, '30303000', 'PURCHASE RTN/DEBIT NOTE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(61, '30500000', 'OPENING STOCK', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(62, '30900000', 'DIRECT EXPENSES GROUP', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(63, '31200000', 'INTER BRANCH TRANSFER (DB)', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(64, '39900000', 'GROSS PROFIT C/D', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(65, '40000000', 'DIRECT INCOME', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(66, '40100000', 'SALES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(67, '40103000', 'SALES ACCOUNT', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(68, '40106000', 'OVER RAIDING COMMISSION', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(69, '40109000', 'SALES RTN/ CREDIT NOTE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(70, '41000000', 'CLOSING STOCK', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(71, '41200000', 'INTER BRANCH TRANSFER (CR)', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(72, 'ACG128', 'GROSS LOSS C/D', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(73, '50000000', 'EXPENSES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(74, '50200000', 'SALARIES AND BENEFITS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(75, '50400000', 'STAFFWELFARE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(76, '50600000', 'TELEPHONE & COMMUNICATION', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(77, '50900000', 'RENT AND OFFICE MAINTENANCE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(78, '51200000', 'FUEL, EQUIPMENT  REPAIRS & MAINTANANCE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(79, '51201000', 'VEHICAL MAINTANANCE', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(80, '51500000', 'SELLING AND DISTRIBUTION EXP.', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(81, '51800000', 'INTEREST & FINANCE CHARGES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(82, '51803000', 'CHARGES ON STATUTORY', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(83, '51806000', 'CHARGES ON BANK', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(84, '51809000', 'INTEREST ON HIRE PURCHASES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(85, '51812000', 'FINANCIAL CHARGES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(86, '51912000', 'OTHER INTEREST CHARGES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(87, '52100000', 'INDIRECT EXPENSES', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(88, '52400000', 'PRINTING & STATIONARY', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(89, '53000000', 'ADMINISTRATIVE EXP.', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(90, '53300000', 'DEPRECIATION', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(91, '59900000', 'NETT PROFIT', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(92, 'ACG126', 'GROSS LOSS B/D', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(93, '60000000', 'INCOME', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(94, '61000000', 'OTHER INCOME', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(95, '62000000', 'GROSS PROFIT B/D', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(96, 'ACG121', 'UNKNOW GROUP', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(97, 'ACG127', 'NETT LOSS', 1, 1, 1, '1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_ledger_opening_balance`
--

CREATE TABLE `accounts_ledger_opening_balance` (
  `id` int(11) NOT NULL,
  `year` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `ledger_code` varchar(4) DEFAULT NULL,
  `balance` decimal(30,2) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_ledger_opening_balance`
--

INSERT INTO `accounts_ledger_opening_balance` (`id`, `year`, `month`, `date`, `ledger_code`, `balance`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '2021', '04', '2021-04-01', 'Z001', 10000.00, 1, 1, '2021-08-19', 1, '2021-08-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_pl_group_master`
--

CREATE TABLE `accounts_pl_group_master` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `order_by` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `flag_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_pl_group_master`
--

INSERT INTO `accounts_pl_group_master` (`id`, `name`, `order_by`, `type`, `flag_id`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Interest received and accrued', 1, 'profit', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(2, 'Miscellaneous income received and due', 2, 'profit', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(3, 'Non statutory reserve', 3, 'profit', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(4, 'Interest paid and due', 1, 'loss', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(5, 'Provision for gratuity', 2, 'loss', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(6, 'Establishment and contingencies', 3, 'loss', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(7, 'Non statutory reserve', 4, 'loss', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(8, 'By release of res (furniture,library)', 5, 'loss', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
(9, 'Audit fees paid and due', 6, 'loss', 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `accounts_sub_ledger`
--

CREATE TABLE `accounts_sub_ledger` (
  `id` int(11) NOT NULL,
  `code` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `accounts_id` int(11) NOT NULL,
  `pl_group_id` int(11) NOT NULL,
  `bs_group_id` int(11) NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounts_voucher`
--

CREATE TABLE `accounts_voucher` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `voucher_category_code` varchar(50) NOT NULL,
  `voucher_purpose_code` varchar(100) NOT NULL,
  `slip_no` varchar(50) DEFAULT NULL,
  `reference_voucher` varchar(255) DEFAULT NULL,
  `member_no` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `branch_code` varchar(50) DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `ledger_code` varchar(50) NOT NULL,
  `amount` float(50,2) NOT NULL,
  `bank_code` varchar(50) DEFAULT NULL,
  `cheque_no` varchar(50) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `narration` varchar(150) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(10) UNSIGNED NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_voucher`
--

INSERT INTO `accounts_voucher` (`id`, `code`, `date`, `voucher_category_code`, `voucher_purpose_code`, `slip_no`, `reference_voucher`, `member_no`, `name`, `branch_code`, `reference_no`, `ledger_code`, `amount`, `bank_code`, `cheque_no`, `cheque_date`, `description`, `narration`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'VOU-001', '2021-08-18', 'CAT-001', 'PUR-001', '2', '', '', '', '', '2', 'O010', 1500.00, '', '', NULL, 'Adjustment Slip Against Ledger', 'Cash Voucher', 2, 1, '2021-08-19 12:17:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_voucher_category`
--

CREATE TABLE `accounts_voucher_category` (
  `id` int(11) NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(150) NOT NULL,
  `description` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_voucher_category`
--

INSERT INTO `accounts_voucher_category` (`id`, `code`, `name`, `description`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'CAT-001', 'Cash Voucher', 'This is used to enter cash voucher details', 1, '2016-06-16 00:00:00', NULL, NULL),
(2, 'CAT-002', 'Credit Voucher', 'This is used to enter credit voucher details', 1, '2016-06-16 11:19:51', NULL, NULL),
(3, 'CAT-003', ' Debit Voucher', 'This is used to enter debit voucherdetails', 1, '2016-06-16 11:56:24', NULL, NULL),
(4, 'CAT-004', 'Adjustment Receipt', 'This is used to enter adjustment receipt details', 1, '2016-06-16 11:57:12', NULL, NULL),
(5, 'CAT-005', 'Adjustment Slip', 'This is used to enter adjustment slip details', 1, '2016-06-16 11:57:56', NULL, NULL),
(6, 'CAT-006', 'Sundry Creditor Rec', 'This is used to enter scr receipt details', 1, '0000-00-00 00:00:00', NULL, NULL),
(7, 'CAT-007', 'Sundry Debtor Rec', 'This is used to enter sdr receipt details', 1, '2021-08-19 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_voucher_detail`
--

CREATE TABLE `accounts_voucher_detail` (
  `id` int(10) UNSIGNED NOT NULL,
  `voucher_code` varchar(100) NOT NULL,
  `sequence` int(11) NOT NULL,
  `ledger_code` varchar(50) NOT NULL,
  `reference` varchar(500) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `type` text NOT NULL,
  `narration` varchar(100) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_voucher_detail`
--

INSERT INTO `accounts_voucher_detail` (`id`, `voucher_code`, `sequence`, `ledger_code`, `reference`, `amount`, `type`, `narration`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'VOU-001', 1, 'O010', '2', 1500.00, 'debit', 'Adjustment Slip Against Ledger', 2, 1, '2021-08-19 06:47:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accounts_voucher_purpose`
--

CREATE TABLE `accounts_voucher_purpose` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(50) NOT NULL,
  `voucher_category_code` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `narration` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `accounts_voucher_purpose`
--

INSERT INTO `accounts_voucher_purpose` (`id`, `code`, `voucher_category_code`, `name`, `narration`, `description`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'PUR-001', 'CAT-001', 'PAYMENT VOUCHER', 'Adjustment Slip Against Ledger', 'This is spend cash for some expenses', 1, 1, '2021-08-18 18:30:00', NULL, '2021-08-18 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `account_entry`
--

CREATE TABLE `account_entry` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `sequence` int(11) NOT NULL COMMENT 'This is sequence order for the transaction details',
  `main_entity` varchar(100) DEFAULT NULL COMMENT 'This is used to categorised information',
  `main_entity_type` varchar(100) DEFAULT NULL,
  `reference` varchar(150) NOT NULL COMMENT 'This is reference for transaction like voucher,loan,collection and so on',
  `search_no` varchar(150) DEFAULT NULL COMMENT 'This is search no for user reference like slip no and other reference no',
  `date` date NOT NULL,
  `ledger_code` varchar(150) NOT NULL,
  `amount` float(50,2) NOT NULL,
  `type` varchar(20) NOT NULL COMMENT 'This is used to display wheher its credit/debit',
  `bank_code` varchar(150) DEFAULT NULL,
  `cheque_no` varchar(50) DEFAULT NULL,
  `cheque_date` date DEFAULT NULL,
  `narration` varchar(500) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `account_entry`
--

INSERT INTO `account_entry` (`id`, `code`, `sequence`, `main_entity`, `main_entity_type`, `reference`, `search_no`, `date`, `ledger_code`, `amount`, `type`, `bank_code`, `cheque_no`, `cheque_date`, `narration`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '', 0, 'Cash Voucher', 'Cash Payment', 'VOU-001', '2', '2021-08-18', 'O010', 1500.00, 'debit', '', '', NULL, 'Adjustment Slip Against Ledger', 1, '2021-08-19 14:32:49', NULL, NULL);

--
-- Triggers `account_entry`
--
DELIMITER $$
CREATE TRIGGER `ACCOUNTENTRY_AFTER_UPDATE` AFTER UPDATE ON `account_entry` FOR EACH ROW BEGIN

DECLARE LOGUSER VARCHAR(50);

SELECT USER() INTO LOGUSER;

INSERT INTO account_entry_audit (`reference`, `search_no`, `date`, `ledger_code`, `amount`, `type`, `status`, `created_on`, `created_by`) VALUES(reference,search_no, date, ledger_code, amount, type,'AFTER UPDATE',SYSDATE(),LOGUSER);

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ACCOUNTENTRY_BEFORE_UPDATE` BEFORE UPDATE ON `account_entry` FOR EACH ROW BEGIN 

DECLARE USERNAME VARCHAR(50);

SELECT USER() INTO USERNAME;	

    INSERT INTO account_entry_audit (`reference`, `search_no`, `date`, `ledger_code`, `amount`, `type`, `status`, `created_on`, `created_by`) VALUES(reference,search_no, date, ledger_code, amount, type,'BEFORE UPDATE',SYSDATE(),USERNAME);

  END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BLOCK_BALANCE_SHEET` BEFORE INSERT ON `account_entry` FOR EACH ROW IF NEW.DATE <'2018-04-01' THEN SET NEW.AMOUNT=0;

END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_percentage_master`
--

CREATE TABLE `allowance_percentage_master` (
  `id` int(11) NOT NULL,
  `scale` varchar(50) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `basic_pay` varchar(50) DEFAULT NULL,
  `hra` varchar(50) DEFAULT NULL,
  `da` varchar(50) DEFAULT NULL,
  `cca` varchar(50) DEFAULT NULL,
  `Other_allow` varchar(100) DEFAULT NULL,
  `Bonus` varchar(100) DEFAULT NULL,
  `splallow` varchar(100) DEFAULT NULL,
  `ds` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

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
-- Table structure for table `appraisal_details`
--

CREATE TABLE `appraisal_details` (
  `id` int(11) NOT NULL,
  `dep_name` varchar(100) DEFAULT NULL,
  `div_name` varchar(100) DEFAULT NULL,
  `dsgn_name` varchar(100) DEFAULT NULL,
  `emp_name` varchar(100) DEFAULT NULL,
  `cand_id` varchar(50) DEFAULT NULL,
  `from_date` varchar(50) DEFAULT NULL,
  `to_date` varchar(50) DEFAULT NULL,
  `person_id` varchar(100) DEFAULT NULL,
  `recommend_full_appraisal` varchar(50) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `full_appraisal_meet_date` date DEFAULT NULL,
  `salary` varchar(100) DEFAULT NULL,
  `new_designation` varchar(100) DEFAULT NULL,
  `new_salary_start_date` date DEFAULT NULL,
  `round_id` int(11) DEFAULT NULL,
  `self_appraisal_point` int(11) DEFAULT NULL,
  `appraisal_point` int(11) DEFAULT NULL,
  `overall_points` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `reject_remark` varchar(150) DEFAULT NULL,
  `md_reject__remark` varchar(150) DEFAULT NULL,
  `hike` varchar(50) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_master`
--

CREATE TABLE `appraisal_master` (
  `id` int(11) NOT NULL,
  `dep_name` varchar(250) DEFAULT NULL,
  `div_name` varchar(250) DEFAULT NULL,
  `dsgn_name` varchar(250) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `person_id` varchar(250) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_question`
--

CREATE TABLE `appraisal_question` (
  `id` int(11) NOT NULL,
  `dep_name` varchar(11) DEFAULT NULL,
  `question` varchar(200) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT current_timestamp(),
  `person_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `appraisal_Master_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_rating`
--

CREATE TABLE `appraisal_rating` (
  `id` int(11) NOT NULL,
  `emp_name` varchar(100) DEFAULT NULL,
  `persons_id` int(11) DEFAULT NULL,
  `question_id` varchar(100) DEFAULT NULL,
  `rating` varchar(100) DEFAULT NULL,
  `from_date` varchar(200) DEFAULT NULL,
  `to_date` varchar(200) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_rounds`
--

CREATE TABLE `appraisal_rounds` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT current_timestamp(),
  `modified_on` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appraisal_rounds`
--

INSERT INTO `appraisal_rounds` (`id`, `name`, `status`, `created_on`, `modified_on`) VALUES
(1, 'MD', 1, '2022-06-23 04:32:04', NULL),
(2, 'HR', 1, '2022-06-23 04:32:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appraisal_rounds_mapping`
--

CREATE TABLE `appraisal_rounds_mapping` (
  `id` int(11) NOT NULL,
  `round_id` int(11) DEFAULT NULL,
  `dep` int(11) DEFAULT NULL,
  `person_name` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_on` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `area_of_visit`
--

CREATE TABLE `area_of_visit` (
  `id` int(11) NOT NULL,
  `area_of_visit` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_on` datetime NOT NULL,
  `modified_on` datetime NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `modified_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `area_of_visit`
--

INSERT INTO `area_of_visit` (`id`, `area_of_visit`, `status`, `created_on`, `modified_on`, `created_by`, `modified_by`) VALUES
(1, 'HR', '0', '2018-09-25 10:21:42', '2019-11-19 07:08:14', '192.168.202.12', '::1'),
(2, 'Accounts', '0', '2019-04-29 09:42:24', '2019-04-29 09:42:24', '192.168.202.4', '192.168.202.4'),
(3, 'Purchase', '0', '2018-09-25 10:22:11', '2018-09-25 11:17:12', '192.168.202.12', '192.168.202.12'),
(5, 'marketing', '0', '2019-04-29 09:42:44', '2019-04-29 09:42:44', '192.168.202.4', '192.168.202.4'),
(6, 'service', '0', '2019-04-29 09:42:54', '2019-04-29 09:42:54', '192.168.202.4', '192.168.202.4'),
(7, 'bluebase', '0', '2019-05-02 00:00:00', '0000-00-00 00:00:00', '', ''),
(8, 'quadsel', '0', '2019-05-10 05:05:07', '2019-05-10 05:05:07', '192.168.202.5', '192.168.202.5');

-- --------------------------------------------------------

--
-- Table structure for table `arrear_pay`
--

CREATE TABLE `arrear_pay` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `payroll_month` varchar(50) NOT NULL,
  `amount` int(11) NOT NULL,
  `remark` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `arrear_pay`
--

INSERT INTO `arrear_pay` (`id`, `emp_id`, `payroll_month`, `amount`, `remark`, `status`, `created_on`) VALUES
(1, 110, '2022-12', 915, 'Attendance Shortage', 0, '2023-01-03 14:52:47'),
(2, 8, '2024-01', 2000, 'balance', 0, '2024-06-07 23:45:57');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_qn_master`
--

CREATE TABLE `assessment_qn_master` (
  `id` int(11) NOT NULL,
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
  `modified_on` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `assessment_qn_master`
--

INSERT INTO `assessment_qn_master` (`id`, `qn_name`, `section`, `Questions`, `Option_A`, `Option_B`, `Option_C`, `Option_D`, `answer_key`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, '1', '1', 'add a+b a=5 b=10', '10', '15', '25', '35', '2', 1, NULL, NULL, NULL, NULL),
(2, '1', '2', 'subtract 2 num a=50 b=20', '10', '25', '20', '30', '4', 1, NULL, NULL, NULL, NULL),
(3, '7', '4', 'The handshake that conveys confidence is', 'Limp', 'Firm', 'Loose', 'Double', '2', 1, NULL, NULL, NULL, NULL),
(4, '7', '4', 'Identify the subject and predicate in the given sentence â€“ â€˜The Sun was shining.â€™', 'The, the sun was shining', 'The Sun. was shining', 'The Sun was, shining', 'None of the above', '2', 1, NULL, NULL, NULL, NULL),
(5, '7', '4', 'Understanding a written text means', 'Reading comprehension', 'Extracting the required information', 'Understand writerâ€™s meaning', 'Both a & b', '4', 1, NULL, NULL, NULL, NULL),
(6, '7', '4', 'Communication is a ______________', 'One way process', 'Two way process', 'Three way process', 'Four way process', '2', 1, NULL, NULL, NULL, NULL),
(7, '7', '4', 'Communication saves time in', 'Internal communication', 'Interview', 'Oral communication', 'Schedule', '3', 1, NULL, NULL, NULL, NULL),
(8, '10', '4', 'The following is (are) non-verbal communication', 'Facial expression', 'Appearance', 'Posture', 'All of the above', '4', 1, NULL, NULL, NULL, NULL),
(9, '10', '4', 'A group of words which forms part of a sentence, and contains a subject and a predicate, is called â€“', 'Clause', 'Phrase', 'Gambit', 'Idioms', '1', 1, NULL, NULL, NULL, NULL),
(10, '10', '4', 'It is a Psycho-linguistic guessing game', 'Reading', 'Writing', 'Learning', 'Listening', '1', 1, NULL, NULL, NULL, NULL),
(11, '10', '4', 'Realizing the potential of the self is part of the', 'Communication development', 'Language development', 'Skill development', 'Personality development', '4', 1, NULL, NULL, NULL, NULL),
(12, '10', '4', 'The term communis derived from ______________ word', 'Greek', 'Latin', 'Chinese', 'English', '2', 1, NULL, NULL, NULL, NULL),
(13, '9', '4', 'Communication is the task of imparting ________', 'Training', 'Information', 'Knowledge', 'Message', '2', 1, NULL, NULL, NULL, NULL),
(14, '9', '4', 'â€˜Babur was a wise king who ruled India. Identify the proper noun.', 'King', 'India', 'Babur', 'Wise King', '2', 1, NULL, NULL, NULL, NULL),
(15, '9', '4', 'Biographies, Historical stories etc. are the example of â€“', 'Imaginative essays', 'Narrative essays', 'Descriptive essays', 'Expository essays', '2', 1, NULL, NULL, NULL, NULL),
(16, '9', '4', 'A group discussion of a real life situation with in a training environment is ______________', 'Discussion', 'Listening', 'Case study method', 'All of the above', '1', 1, NULL, NULL, NULL, NULL),
(17, '9', '4', 'The information the receiver gets is called ______________', 'Message', 'Output', 'Input', 'Source', '1', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assets_form_detail`
--

CREATE TABLE `assets_form_detail` (
  `id` int(11) NOT NULL,
  `asset` varchar(255) DEFAULT NULL,
  `asset_type` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `asset_no` varchar(255) DEFAULT NULL,
  `asset_name` varchar(255) DEFAULT NULL,
  `brand_name` varchar(255) DEFAULT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `p_date` varchar(255) DEFAULT NULL,
  `Serial_no` varchar(255) DEFAULT NULL,
  `config` varchar(255) DEFAULT NULL,
  `warranty` varchar(255) DEFAULT NULL,
  `hsn_code` varchar(255) DEFAULT NULL,
  `part_no` varchar(255) DEFAULT NULL,
  `asset_value` varchar(205) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `stock_in_hand` varchar(255) DEFAULT NULL,
  `new_stock` varchar(255) DEFAULT NULL,
  `invoice_no` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `created_by` int(11) DEFAULT 1,
  `created_on` timestamp NULL DEFAULT current_timestamp(),
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL,
  `description` varchar(3000) NOT NULL,
  `gst_code` varchar(500) DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assets_master`
--

CREATE TABLE `assets_master` (
  `id` int(11) NOT NULL,
  `name` varchar(234) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `prefix_code` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL,
  `modified_on` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `assets_master`
--

INSERT INTO `assets_master` (`id`, `name`, `type`, `prefix_code`, `status`, `created_on`, `modified_on`) VALUES
(1, 'Monitor', 'IT Asset', 'MON', 1, NULL, '2021-07-27'),
(2, 'Keyboard', 'IT Asset', 'KEY', 1, NULL, '2021-07-27'),
(3, 'CPU', 'IT Asset', 'CPU', 1, NULL, '2021-07-29'),
(4, 'Mouse', 'IT Asset', 'MOU', 1, NULL, '2021-07-27'),
(5, 'Fan', NULL, NULL, 1, NULL, NULL),
(6, 'AC', NULL, NULL, 1, NULL, NULL),
(7, 'Chairs', 'Non IT Asset', 'CHA', 1, '2021-07-19', '2021-07-29'),
(8, 'Notepad', NULL, NULL, 1, '2021-07-19', NULL),
(9, 'Laptop', 'IT Asset', 'LAP', 1, '2021-07-26', '2021-07-26');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `emp_code` varchar(155) DEFAULT NULL,
  `log_tpye` varchar(155) DEFAULT NULL,
  `log_time` datetime DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `emp_code`, `log_tpye`, `log_time`, `Status`, `created_by`, `created_on`) VALUES
(1, '0016', 'in', '2021-07-01 09:00:00', 1, 1, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_files`
--

CREATE TABLE `attendance_files` (
  `id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `file_name` varchar(150) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attendance_files`
--

INSERT INTO `attendance_files` (`id`, `month`, `year`, `file_name`, `created_on`) VALUES
(1, 4, 2023, 'SS Info.csv', '2023-04-27 16:32:02'),
(2, 8, 2022, 'SS Info.csv', '2023-04-27 17:26:37'),
(3, 8, 2023, 'qvision_attendance.csv', '2023-09-15 14:48:35'),
(4, 9, 2023, 'qvision_attendance -18.10.2023.csv', '2023-10-06 09:26:22'),
(5, 1, 1970, 'qvision_attendance.csv', '2023-11-08 14:54:21'),
(6, 1, 2024, 'qvision_attendance.csv', '2024-02-16 04:16:47'),
(7, 3, 2024, 'qvision_attendance  Mar2024.csv', '2024-04-22 00:04:19');

-- --------------------------------------------------------

--
-- Table structure for table `attire_form`
--

CREATE TABLE `attire_form` (
  `id` int(11) NOT NULL,
  `emp_no` varchar(255) DEFAULT NULL,
  `dep_id` varchar(255) DEFAULT NULL,
  `design_id` varchar(255) DEFAULT NULL,
  `yes` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `yes1` varchar(255) DEFAULT NULL,
  `remark1` varchar(255) DEFAULT NULL,
  `yes2` varchar(255) DEFAULT NULL,
  `remark2` varchar(255) DEFAULT NULL,
  `yes3` varchar(255) DEFAULT NULL,
  `remark3` varchar(255) DEFAULT NULL,
  `yes4` varchar(255) DEFAULT NULL,
  `remark4` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `daily_in` varchar(255) DEFAULT NULL,
  `daily_out` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_on` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `attire_form`
--

INSERT INTO `attire_form` (`id`, `emp_no`, `dep_id`, `design_id`, `yes`, `remark`, `yes1`, `remark1`, `yes2`, `remark2`, `yes3`, `remark3`, `yes4`, `remark4`, `date`, `daily_in`, `daily_out`, `status`, `created_on`) VALUES
(51, '87', '2', '34', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-13', '09:16', '18:09', '1', '2024-06-14'),
(52, '70', '5', '5', '1', '', '1', '', '2', '', '1', '', '2', '', '2024-06-13', '09:06', '18:03', '1', '2024-06-14'),
(50, '68', '4', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-13', '09:24', '', '1', '2024-06-14'),
(42, '70', '5', '5', '1', '', '1', '', '1', '', '', '', '', '', '2024-06-05', '08:59', '18:07', '1', '2024-06-06'),
(41, '68', '4', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-05', '09:22', '18:00', '1', '2024-06-06'),
(40, '81', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-05', '09:02', '18:00', '1', '2024-06-06'),
(39, '82', '2', '32', '1', '', '1', '', '1', '', '', '', '2', '', '2024-06-05', '08:23', '18:00', '1', '2024-06-06'),
(38, '70', '5', '5', '1', '', '1', '', '1', '', '', '', '2', '', '2024-06-04', '08:58', '18:09', '1', '2024-06-05'),
(37, '81', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-04', '08:36', '18:08', '1', '2024-06-05'),
(36, '82', '2', '32', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-04', '', '', '1', '2024-06-05'),
(35, '68', '4', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-04', '09:00', '18:04', '1', '2024-06-05'),
(49, '87', '2', '34', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-10', '09:27', '18:02', '1', '2024-06-11'),
(48, '82', '2', '32', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-10', '08:47', '17:57', '1', '2024-06-11'),
(46, '68', '4', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-10', '09:04', '18:08', '1', '2024-06-11'),
(47, '81', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-10', '08:27', '13:30', '1', '2024-06-11'),
(53, '82', '2', '32', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-17', '09:03', '17:44', '1', '2024-06-17'),
(54, '81', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-17', '08:27', '14:30', '1', '2024-06-17'),
(55, '68', '4', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-17', '08:57', '18:08', '1', '2024-06-17'),
(56, '69', '4', '8', '1', '', '1', '', '1', '', '', '', '', '', '2024-06-17', '09:30', '17:33', '1', '2024-06-17'),
(57, '70', '5', '5', '1', '', '1', '', '1', '', '', '', '', '', '2024-06-17', '08:57', '18:02', '1', '2024-06-17'),
(58, '87', '2', '34', '1', '', '1', '', '1', '', '', '', '2', '', '2024-06-19', '', '', '1', '2024-06-20'),
(59, '81', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-06-19', '08:25', '14:01', '1', '2024-06-20'),
(60, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-07-02', '09:25', '18:02', '1', '2024-07-03'),
(61, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-07-02', '09:00', '18:00', '1', '2024-07-03'),
(62, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-07-09', '08:30', '18:12', '1', '2024-07-10'),
(63, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-07-09', '09:22', '18:03', '1', '2024-07-10'),
(64, '48', '2', '4', '', '', '', '', '', '', '', '', '', '', '2024-07-10', '09:03', '18:01', '1', '2024-07-11'),
(65, '40', '2', '3', '', '', '', '', '', '', '', '', '', '', '2024-07-10', '08:38', '18:00', '1', '2024-07-11'),
(66, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-07-29', '09:22', '18:10', '1', '2024-07-30'),
(67, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-07-29', '08:46', '18:20', '1', '2024-07-30'),
(68, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-07-29', '09:00', '18:10', '1', '2024-07-30'),
(69, '49', '3', '37', '1', '', '1', '', '', '', '', '', '', '', '2024-07-29', '08:52', '18:04', '1', '2024-07-30'),
(70, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-07-30', '09:20', '18:06', '1', '2024-07-31'),
(71, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-08-01', '09:10', '18:05', '1', '2024-08-02'),
(72, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-08-01', '09:06', '18:14', '1', '2024-08-02'),
(73, '49', '3', '37', '1', '', '1', '', '', '', '', '', '', '', '2024-08-01', '09:10', '18:03', '1', '2024-08-02'),
(74, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-08-02', '09:45', '18:02', '1', '2024-08-03'),
(75, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-08-02', '09:12', '18:04', '1', '2024-08-03'),
(76, '50', '4', '35', '1', '', '1', '', '', '', '', '', '1', '', '2024-08-02', '08:55', '18:02', '1', '2024-08-03'),
(77, '49', '3', '37', '1', '', '1', '', '', '', '', '', '', '', '2024-08-02', '09:12', '18:04', '1', '2024-08-03'),
(78, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-03', '08:41', '12:07', '1', '2024-08-05'),
(79, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-08-03', '09:00', '13:25', '1', '2024-08-05'),
(80, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-08-03', '09:15', '13:26', '1', '2024-08-05'),
(81, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-03', '09:05', '13:35', '1', '2024-08-05'),
(82, '49', '3', '37', '1', '', '1', '', '1', '', '', '', '', '', '2024-08-03', '08:58', '13:26', '1', '2024-08-05'),
(83, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-08-05', '08:55', '18:05', '1', '2024-08-06'),
(84, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-05', '08:45', '18:00', '1', '2024-08-06'),
(85, '53', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-05', '09:07', '18:00', '1', '2024-08-06'),
(86, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-05', '09:06', '18:00', '1', '2024-08-06'),
(87, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-08-05', '09:34', '18:03', '1', '2024-08-06'),
(88, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-06', '08:42', '18:00', '1', '2024-08-07'),
(89, '48', '2', '4', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-06', '08:59', '18:02', '1', '2024-08-07'),
(90, '50', '4', '35', '', '', '', '', '', '', '', '', '', '', '2024-08-06', '09:00', '18:00', '1', '2024-08-07'),
(91, '53', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-06', '08:51', '18:00', '1', '2024-08-07'),
(92, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-08-06', '09:04', '18:07', '1', '2024-08-07'),
(93, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-07', '08:53', '18:04', '1', '2024-08-08'),
(94, '53', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-07', '08:49', '18:00', '1', '2024-08-08'),
(95, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-08-07', '09:09', '18:14', '1', '2024-08-08'),
(96, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-08-07', '09:20', '18:03', '1', '2024-08-08'),
(97, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-07', '09:09', '18:09', '1', '2024-08-08'),
(98, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-08', '08:42', '18:02', '1', '2024-08-09'),
(99, '53', '3', '33', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-08', '10:00', '18:00', '1', '2024-08-09'),
(100, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-08-08', '09:06', '06:08', '1', '2024-08-09'),
(101, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-08-08', '09:23', '18:04', '1', '2024-08-09'),
(102, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-08', '08:58', '18:08', '1', '2024-08-09'),
(103, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-08-09', '09:07', '18:13', '1', '2024-08-12'),
(104, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-08-10', '09:07', '13:09', '1', '2024-08-12'),
(105, '50', '4', '35', '1', '', '1', '', '', '', '', '', '', '', '2024-08-10', '08:50', '13:33', '1', '2024-08-12'),
(106, '53', '3', '33', '1', '', '1', '', '', '', '', '', '1', '', '2024-08-09', '09:00', '18:00', '1', '2024-08-12'),
(107, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-09', '08:38', '18:03', '1', '2024-08-12'),
(108, '40', '2', '3', '1', '', '1', '', '', '', '', '', '', '', '2024-08-10', '08:30', '13:38', '1', '2024-08-12'),
(109, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-08-09', '09:06', '18:13', '1', '2024-08-12'),
(110, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-08-10', '09:24', '13:09', '1', '2024-08-12'),
(111, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-08-12', '09:12', '18:02', '1', '2024-08-16'),
(112, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-08-13', '09:16', '18:08', '1', '2024-08-16'),
(113, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-08-15', '09:19', '18:23', '1', '2024-08-16'),
(114, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-12', '08:42', '18:16', '1', '2024-08-16'),
(115, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-13', '10:50', '18:30', '1', '2024-08-16'),
(116, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-14', '09:00', '18:00', '1', '2024-08-16'),
(117, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-08-12', '09:00', '18:02', '1', '2024-08-16'),
(118, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-08-13', '09:08', '18:11', '1', '2024-08-16'),
(119, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-08-14', '09:01', '18:23', '1', '2024-08-16'),
(120, '56', '4', '32', '1', '', '1', '', '1', '', '', '', '', '', '2024-08-12', '09:40', '18:00', '1', '2024-08-16'),
(121, '56', '4', '32', '1', '', '1', '', '1', '', '', '', '1', '', '2024-08-14', '09:30', '18:00', '1', '2024-08-16'),
(122, '48', '2', '4', '1', '', '2', '', '1', '', '1', '', '1', '', '2024-10-27', '09:55', '18:00', '1', '2024-10-28'),
(123, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-10-27', '08:57', '18:12', '1', '2024-10-28'),
(124, '56', '4', '32', '1', '', '2', '', '1', '', '', '', '', '', '2024-10-27', '09:00', '17:50', '1', '2024-10-28'),
(125, '48', '2', '4', '', '', '', '', '', '', '', '', '', '', '2024-08-16', '08:45', '18:10', '1', '2024-10-29'),
(126, '48', '2', '4', '', '', '', '', '', '', '', '', '', '', '2024-10-29', '09:36', '06:36', '1', '2024-10-30'),
(127, '44', '1', '1', '', '', '', '', '', '', '', '', '', '', '2024-10-29', '10:38', '16:44', '1', '2024-10-30'),
(128, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-08-27', '08:57', '18:32', '1', '2024-10-30'),
(129, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-08-28', '08:58', '18:02', '1', '2024-10-30'),
(130, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-08-29', '08:55', '18:04', '1', '2024-10-30'),
(131, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-08-30', '08:57', '18:16', '1', '2024-10-30'),
(132, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-08-31', '08:56', '13:21', '1', '2024-10-30'),
(133, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-10-21', '08:58', '18:34', '1', '2024-10-30'),
(134, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-10-22', '08:53', '18:31', '1', '2024-10-30'),
(135, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-10-23', '08:59', '18:21', '1', '2024-10-30'),
(136, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-10-24', '08:59', '18:10', '1', '2024-10-30'),
(137, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-10-25', '08:58', '18:15', '1', '2024-10-30'),
(138, '40', '2', '3', '', '', '', '', '', '', '', '', '', '', '2024-10-21', '08:53', '18:00', '1', '2024-10-30'),
(139, '40', '2', '3', '', '', '', '', '', '', '', '', '', '', '2024-10-22', '08:48', '18:00', '1', '2024-10-30'),
(140, '40', '2', '3', '', '', '', '', '', '', '', '', '', '', '2024-10-23', '08:56', '18:00', '1', '2024-10-30'),
(141, '40', '2', '3', '', '', '', '', '', '', '', '', '', '', '2024-10-24', '08:46', '18:00', '1', '2024-10-30'),
(142, '40', '2', '3', '', '', '', '', '', '', '', '', '', '', '2024-10-29', '10:00', '17:30', '1', '2024-10-30'),
(143, '56', '4', '32', '', '', '', '', '', '', '', '', '', '', '2024-10-21', '09:50', '17:45', '1', '2024-10-30'),
(144, '56', '4', '32', '', '', '', '', '', '', '', '', '', '', '2024-10-22', '09:00', '18:00', '1', '2024-10-30'),
(145, '50', '4', '35', '', '', '', '', '', '', '', '', '', '', '2024-10-27', '09:15', '18:15', '1', '2024-10-30'),
(146, '50', '4', '35', '', '', '', '', '', '', '', '', '', '', '2024-10-17', '09:03', '18:13', '1', '2024-10-30'),
(147, '44', '1', '1', '', '', '', '', '', '', '', '', '', '', '2024-10-29', '11:31', '17:38', '1', '2024-10-30'),
(148, '40', '2', '3', '', '', '', '', '', '', '', '', '', '', '2024-11-18', '08:52', '18:30', '1', '2024-11-19'),
(149, '48', '2', '4', '', '', '', '', '', '', '', '', '', '', '2024-11-18', '09:16', '18:18', '1', '2024-11-19'),
(150, '42', '5', '5', '', '', '', '', '', '', '', '', '', '', '2024-11-18', '08:57', '18:18', '1', '2024-11-19'),
(151, '50', '4', '35', '', '', '', '', '', '', '', '', '', '', '2024-11-18', '09:35', '18:19', '1', '2024-11-19'),
(152, '56', '4', '32', '', '', '', '', '', '', '', '', '', '', '2024-11-18', '10:00', '18:00', '1', '2024-11-19'),
(153, '48', '2', '4', '1', '', '1', '', '', '', '1', '', '', '', '2024-11-18', '09:16', '18:18', '1', '2024-11-19'),
(154, '40', '2', '3', '1', '', '1', '', '1', '', '1', '', '1', '', '2024-11-19', '08:52', '18:15', '1', '2024-11-20'),
(155, '48', '2', '4', '1', '', '1', '', '', '', '', '', '', '', '2024-11-19', '08:56', '18:08', '1', '2024-11-20'),
(156, '41', '2', '8', '1', '', '1', '', '', '', '', '', '', '', '2024-11-19', '08:30', '15:00', '1', '2024-11-20'),
(157, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-11-19', '08:57', '18:08', '1', '2024-11-20'),
(158, '49', '3', '37', '1', '', '1', '', '', '', '', '', '', '', '2024-11-19', '09:15', '17:40', '1', '2024-11-20'),
(159, '50', '4', '35', '1', '', '1', '', '1', '', '1', '', '2', '', '2024-11-19', '09:15', '18:07', '1', '2024-11-20'),
(160, '40', '2', '3', '1', '', '1', '', '1', '', '1', '', '1', '', '2024-11-16', '08:48', '13:00', '1', '2024-11-20'),
(161, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-11-16', '09:00', '12:24', '1', '2024-11-20'),
(162, '56', '4', '32', '1', '', '2', '', '1', '', '', '', '1', '', '2024-11-16', '', '13:00', '1', '2024-11-20'),
(163, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-11-16', '09:18', '13:06', '1', '2024-11-20'),
(164, '50', '4', '35', '1', '', '1', '', '1', '', '1', '', '2', '', '2024-11-19', '20:58', '10:30', '1', '2024-11-20'),
(165, '49', '3', '37', '1', '', '', '', '', '', '', '', '', '', '2024-11-19', '09:15', '12:51', '1', '2024-11-20'),
(166, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-20', '08:48', '18:00', '1', '2024-11-21'),
(167, '42', '5', '5', '1', '', '1', '', '', '', '', '', '', '', '2024-11-20', '08:59', '18:18', '1', '2024-11-21'),
(168, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-11-20', '09:12', '18:08', '1', '2024-11-21'),
(169, '50', '4', '35', '1', '', '1', '', '1', '', '1', '', '', '', '2024-11-20', '08:58', '18:10', '1', '2024-11-21'),
(170, '49', '3', '37', '1', '', '1', '', '', '', '', '', '', '', '2024-11-20', '09:06', '17:34', '1', '2024-11-21'),
(171, '40', '2', '3', '1', '', '2', '', '', '', '', '', '1', '', '2024-11-21', '08:30', '18:30', '1', '2024-11-22'),
(172, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-21', '09:17', '18:06', '1', '2024-11-22'),
(173, '49', '3', '37', '1', '', '', '', '', '', '', '', '', '', '2024-11-21', '09:09', '17:38', '1', '2024-11-22'),
(174, '40', '2', '3', '1', '', '', '', '1', '', '', '', '1', '', '2024-11-22', '09:12', '18:10', '1', '2024-11-28'),
(175, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-22', '09:30', '13:30', '1', '2024-11-28'),
(176, '40', '2', '3', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-27', '08:50', '', '1', '2024-11-28'),
(177, '40', '2', '3', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-26', '08:45', '18:00', '1', '2024-11-28'),
(178, '40', '2', '3', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-27', '08:44', '18:00', '1', '2024-11-28'),
(179, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-27', '09:09', '18:07', '1', '2024-11-28'),
(180, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-11-22', '08:59', '13:08', '1', '2024-11-28'),
(181, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-11-25', '09:11', '18:04', '1', '2024-11-28'),
(182, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-11-26', '08:49', '18:01', '1', '2024-11-28'),
(183, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-11-27', '08:57', '18:03', '1', '2024-11-28'),
(184, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-11-22', '08:59', '18:07', '1', '2024-11-28'),
(185, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-11-27', '08:59', '13:08', '1', '2024-11-28'),
(186, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-11-27', '09:00', '18:03', '1', '2024-11-28'),
(187, '50', '4', '35', '1', '', '2', '', '1', '', '', '', '1', '', '2024-11-22', '09:05', '18:05', '1', '2024-11-28'),
(188, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '', '', '2024-11-23', '09:05', '', '1', '2024-11-28'),
(189, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '', '', '2024-11-25', '09:50', '18:05', '1', '2024-11-28'),
(190, '50', '4', '35', '1', '', '2', '', '1', '', '', '', '', '', '2024-11-27', '09:00', '18:03', '1', '2024-11-28'),
(191, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-04', '08:55', '18:10', '1', '2024-11-29'),
(192, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-05', '08:50', '18:10', '1', '2024-11-29'),
(193, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-06', '09:01', '18:00', '1', '2024-11-29'),
(194, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-07', '08:50', '18:00', '1', '2024-11-29'),
(195, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-08', '08:54', '13:10', '1', '2024-11-29'),
(196, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '', '', '2024-11-09', '10:40', '13:32', '1', '2024-11-29'),
(197, '40', '2', '3', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-11', '09:05', '18:00', '1', '2024-11-29'),
(198, '40', '2', '3', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-12', '08:50', '18:05', '1', '2024-11-29'),
(199, '40', '2', '3', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-12', '08:50', '18:05', '1', '2024-11-29'),
(200, '40', '2', '3', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-13', '08:50', '18:00', '1', '2024-11-29'),
(201, '40', '2', '3', '1', '', '1', '', '1', '', '1', '', '', '', '2024-11-14', '08:40', '18:00', '1', '2024-11-29'),
(202, '40', '2', '3', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-15', '08:57', '18:00', '1', '2024-11-29'),
(203, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-04', '08:58', '18:09', '1', '2024-11-29'),
(204, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-05', '08:59', '18:19', '1', '2024-11-29'),
(205, '42', '5', '5', '1', '', '1', '', '', '', '1', '', '', '', '2024-11-06', '08:50', '18:00', '1', '2024-11-29'),
(206, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-07', '09:00', '18:14', '1', '2024-11-29'),
(207, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-08', '08:58', '18:04', '1', '2024-11-29'),
(208, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-09', '09:10', '13:09', '1', '2024-11-29'),
(209, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-11', '08:59', '18:21', '1', '2024-11-29'),
(210, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-12', '08:56', '18:01', '1', '2024-11-29'),
(211, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-13', '08:50', '19:02', '1', '2024-11-29'),
(212, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-14', '09:08', '18:12', '1', '2024-11-29'),
(213, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-15', '09:03', '18:09', '1', '2024-11-29'),
(214, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-04', '09:16', '18:09', '1', '2024-11-29'),
(215, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-05', '09:32', '18:19', '1', '2024-11-29'),
(216, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-06', '09:03', '18:08', '1', '2024-11-29'),
(217, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-07', '09:15', '18:11', '1', '2024-11-29'),
(218, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-08', '09:25', '18:04', '1', '2024-11-29'),
(219, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-09', '09:19', '13:09', '1', '2024-11-29'),
(220, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-11', '09:09', '18:07', '1', '2024-11-29'),
(221, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-12', '09:10', '18:01', '1', '2024-11-29'),
(222, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-13', '09:05', '19:02', '1', '2024-11-29'),
(223, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-14', '09:40', '18:12', '1', '2024-11-29'),
(224, '48', '2', '4', '1', '', '', '', '', '', '1', '', '', '', '2024-11-15', '09:04', '18:09', '1', '2024-11-29'),
(225, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-04', '08:58', '18:00', '1', '2024-11-29'),
(226, '50', '4', '35', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-05', '08:59', '18:19', '1', '2024-11-29'),
(227, '50', '4', '35', '1', '', '1', '', '1', '', '1', '', '', '', '2024-11-06', '09:00', '18:00', '1', '2024-11-29'),
(228, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '', '', '2024-11-07', '09:00', '18:14', '1', '2024-11-29'),
(229, '50', '4', '35', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-08', '09:11', '18:06', '1', '2024-11-29'),
(230, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '1', '', '2024-11-09', '08:55', '13:09', '1', '2024-11-29'),
(231, '50', '4', '35', '1', '', '2', '', '1', '', '', '', '2', '', '2024-11-11', '09:00', '18:00', '1', '2024-11-29'),
(232, '50', '4', '35', '1', '', '1', '', '', '', '2', '', '1', '', '2024-11-12', '09:00', '18:01', '1', '2024-11-29'),
(233, '50', '4', '35', '1', '', '1', '', '', '', '', '', '2', '', '2024-11-13', '09:00', '18:02', '1', '2024-11-29'),
(234, '50', '4', '35', '1', '', '2', '', '', '', '2', '', '', '', '2024-11-14', '09:01', '18:12', '1', '2024-11-29'),
(235, '50', '4', '35', '1', '', '1', '', '1', '', '1', '', '', '', '2024-11-15', '08:56', '18:00', '1', '2024-11-29'),
(236, '40', '2', '3', '1', '', '2', '', '1', '', '2', '', '1', '', '2024-11-28', '08:37', '18:05', '1', '2024-11-29'),
(237, '48', '2', '4', '1', '', '', '', '', '', '2', '', '', '', '2024-11-28', '09:22', '18:16', '1', '2024-11-29'),
(238, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-11-28', '09:01', '18:16', '1', '2024-11-29'),
(239, '50', '4', '35', '1', '', '2', '', '1', '', '2', '', '', '', '2024-11-28', '09:00', '18:18', '1', '2024-11-29'),
(240, '56', '4', '32', '1', '', '2', '', '1', '', '2', '', '1', '', '2024-11-25', '10:00', '15:00', '1', '2024-11-29'),
(241, '56', '4', '32', '1', '', '2', '', '1', '', '2', '', '1', '', '2024-11-18', '10:00', '18:00', '1', '2024-11-29'),
(242, '56', '4', '32', '1', '', '2', '', '1', '', '2', '', '1', '', '2024-11-22', '10:00', '17:00', '1', '2024-11-29'),
(243, '56', '4', '32', '1', '', '1', '', '1', '', '2', '', '1', '', '2024-11-15', '10:22', '17:30', '1', '2024-11-29'),
(244, '56', '4', '32', '1', '', '', '', '1', '', '', '', '1', '', '2024-11-13', '10:13', '18:10', '1', '2024-11-29'),
(245, '56', '4', '32', '1', '', '2', '', '1', '', '1', '', '1', '', '2024-11-12', '09:40', '18:10', '1', '2024-11-29'),
(246, '56', '4', '32', '1', '', '2', '', '1', '', '', '', '1', '', '2024-11-08', '09:45', '18:00', '1', '2024-11-29'),
(247, '56', '4', '32', '1', '', '2', '', '', '', '', '', '1', '', '2024-11-06', '09:40', '17:40', '1', '2024-11-29'),
(248, '56', '4', '32', '1', '', '1', '', '', '', '', '', '1', '', '2024-11-04', '09:40', '18:10', '1', '2024-11-29'),
(249, '40', '2', '3', '1', '', '2', '', '1', '', '', '', '1', '', '2024-12-02', '08:55', '18:16', '1', '2024-12-03'),
(250, '48', '2', '4', '1', '', '', '', '', '', '2', '', '', '', '2024-12-02', '09:11', '18:08', '1', '2024-12-03'),
(251, '56', '4', '32', '1', '', '1', '', '1', '', '', '', '1', '', '2024-12-02', '10:12', '17:32', '1', '2024-12-03'),
(252, '50', '4', '35', '1', '', '1', '', '1', '', '', '', '1', '', '2024-12-02', '09:01', '18:10', '1', '2024-12-03'),
(253, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-12-02', '09:01', '18:10', '1', '2024-12-03'),
(254, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-12-02', '09:01', '18:10', '1', '2024-12-03'),
(255, '40', '2', '3', '1', '', '2', '', '1', '', '', '', '1', '', '2024-12-03', '08:58', '18:15', '1', '2024-12-06'),
(256, '40', '2', '3', '1', '', '2', '', '1', '', '', '', '1', '', '2024-12-04', '08:52', '18:00', '1', '2024-12-06'),
(257, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-12-03', '09:09', '18:13', '1', '2024-12-06'),
(258, '48', '2', '4', '1', '', '', '', '', '', '', '', '', '', '2024-12-05', '09:40', '18:05', '1', '2024-12-06'),
(259, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-12-02', '09:01', '18:10', '1', '2024-12-06'),
(260, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-12-03', '08:50', '18:13', '1', '2024-12-06'),
(261, '42', '5', '5', '1', '', '', '', '', '', '1', '', '', '', '2024-12-04', '08:59', '18:05', '1', '2024-12-06'),
(262, '42', '5', '5', '1', '', '', '', '', '', '', '', '', '', '2024-12-05', '08:51', '18:08', '1', '2024-12-06'),
(263, '50', '4', '35', '1', '', '2', '', '1', '', '', '', '1', '', '2024-12-03', '09:05', '18:10', '1', '2024-12-06'),
(264, '50', '4', '35', '1', '', '1', '', '', '', '', '', '', '', '2024-12-04', '09:05', '18:05', '1', '2024-12-06'),
(265, '50', '4', '35', '2', '', '1', '', '1', '', '', '', '1', '', '2024-12-05', '09:00', '18:05', '1', '2024-12-06');

-- --------------------------------------------------------

--
-- Table structure for table `bank_master`
--

CREATE TABLE `bank_master` (
  `id` int(11) NOT NULL,
  `vendor_name` varchar(255) DEFAULT NULL,
  `vendor_type` int(11) DEFAULT NULL,
  `address1` varchar(255) DEFAULT NULL,
  `address2` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `town_city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `district` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `acc_holder_name` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_no` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `mail_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NULL DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bank_master`
--

INSERT INTO `bank_master` (`id`, `vendor_name`, `vendor_type`, `address1`, `address2`, `area`, `town_city`, `state`, `district`, `country`, `pincode`, `branch_name`, `acc_holder_name`, `account_name`, `account_no`, `swift_code`, `ifsc_code`, `mail_id`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 'Quadsel Systems Pvt Ltd', 2, 'Quadsel Towers, No,118,', 'Manickam Lane, Annasalai,', 'Guindy', 'Chennai', 'Tamilnadu', 'Tamilnadu', 'INDIA', 600032, 'PURASAWAKKAM', 'Quadsel Systems Pvt Ltd', 'UCO BANK', '01000500001217', '0', 'UCBA0000100', 'UCO', 1, 3, '2021-04-05 10:09:05', 3, '2021-04-09 04:45:46'),
(2, 'Quadsel Systems Pvt Ltd', 1, 'Quadsel Towers, No,118,', 'Periyar Pathai West, 1/102, Jawaharlal Nehru Rd, Tiru NagarManickam Lane, Annasalai,', 'Guindy', 'Chennai', 'Tamilnadu', 'Tamilnadu', 'INDIA', 600032, 'PURASAWAKKAM', 'Quadsel Systems Pvt Ltd', 'UCO BANK', '01000500001217', '0', 'UCBA0000100', 'ciub@gmail.com', 1, 3, '2021-04-05 10:20:34', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `bb_attendance`
--

CREATE TABLE `bb_attendance` (
  `id` int(11) NOT NULL,
  `emp_code` varchar(255) NOT NULL,
  `emp_name` varchar(255) NOT NULL,
  `dep_id` varchar(25) NOT NULL,
  `div_id` varchar(11) NOT NULL,
  `design_id` varchar(11) NOT NULL,
  `in_log_date` date NOT NULL,
  `log_day` varchar(9) NOT NULL,
  `out_log_date` date DEFAULT NULL,
  `punch_in_time` time NOT NULL,
  `punch_out_time` time NOT NULL,
  `work_hours` int(11) NOT NULL,
  `status` int(11) DEFAULT NULL,
  `total_days` decimal(6,1) DEFAULT NULL,
  `working_days` decimal(6,1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bb_attendance`
--

INSERT INTO `bb_attendance` (`id`, `emp_code`, `emp_name`, `dep_id`, `div_id`, `design_id`, `in_log_date`, `log_day`, `out_log_date`, `punch_in_time`, `punch_out_time`, `work_hours`, `status`, `total_days`, `working_days`) VALUES
(82963, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82962, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82961, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82960, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82959, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82958, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82957, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82956, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82955, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82954, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82953, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82952, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82951, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82950, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82949, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82948, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82947, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82946, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82945, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82944, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82943, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82942, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82941, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82940, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82939, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82938, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82935, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82937, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82936, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82934, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82933, 'QSPLE235', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82932, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82930, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82931, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82929, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82928, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82927, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82924, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82925, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82926, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82923, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82922, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82921, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82920, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82919, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82918, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82917, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82916, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82915, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82914, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82913, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82912, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82911, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82910, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82909, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82908, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82907, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82906, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82905, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82904, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82903, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82902, 'QSPLE232', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82901, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82900, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82899, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82898, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82897, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82894, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82895, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82896, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82893, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82891, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82892, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82890, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82889, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82886, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82887, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82888, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82885, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82884, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82883, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82882, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82879, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82880, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82881, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82878, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82877, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82875, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82876, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82874, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82871, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82873, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82872, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82868, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82869, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82870, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82867, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82866, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82864, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82865, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82863, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82862, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82861, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82859, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82860, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82856, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82858, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82857, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82854, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82855, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82852, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82853, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82851, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82850, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82849, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82847, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82848, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82844, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82846, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82845, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82843, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82842, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82840, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82841, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82839, 'QSPLE231', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82836, 'QSPLE229', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82837, 'QSPLE230', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82838, 'QSPLE231', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82835, 'QSPLE228', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82834, 'QSPLE227', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82833, 'QSPLE226', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82832, 'QSPLE225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82831, 'QSPLE224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82830, 'QSPLE223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82829, 'QSPLE222', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82828, 'QSPLE221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82827, 'QSPLE220', 'Hinduja', '5', '5', '5', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82826, 'QSPLE219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82825, 'QSPLE218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82824, 'QSPLE217', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82823, 'QSPLE216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82822, 'QSPLE215', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82821, 'QSPLE214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82820, 'QSPLE213', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82819, 'QSPLE212', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82818, 'QSPLE211', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82817, 'QSPLE210', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82816, 'QSPLE209', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82815, 'QSPLE208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82814, 'QSPLE207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82813, 'QSPLE206', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82812, 'QSPLE205', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82811, 'QSPLE204', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82810, 'QSPLE203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82809, 'QSPLE202', 'Kalaimani R', '2', '2', '3', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82808, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82807, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82806, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82805, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82804, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82803, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82802, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82801, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82800, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82799, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82798, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82797, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82796, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82795, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82794, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82793, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82792, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82791, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82790, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82789, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82788, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82787, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82786, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82785, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82784, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82783, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82782, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82781, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82780, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82779, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82778, 'QSPLO1006', 'Subramanian S', '7', '7', '22', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82777, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82776, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82775, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82774, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82773, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82771, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82772, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82769, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82770, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82767, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82768, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82765, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82766, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82762, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82763, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82764, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82761, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82759, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82760, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82758, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82755, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82756, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82757, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82752, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82753, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82754, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82750, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82751, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82748, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82749, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82747, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82744, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82746, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82745, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82741, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82742, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82743, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82740, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82739, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82738, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82737, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82736, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82735, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82734, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82733, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82732, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82731, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82730, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82729, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82728, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82727, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82725, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82726, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82724, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82723, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82721, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82722, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82720, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82718, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82719, 'QSPLO1221', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82717, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82715, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82716, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82713, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82714, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82710, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82711, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82712, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82708, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82709, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82706, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82707, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82704, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82705, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82702, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82703, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82699, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82700, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82701, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82697, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82698, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82695, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82696, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82694, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82692, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82693, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82689, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82690, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82691, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82687, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82688, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82686, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82685, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82684, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82683, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82682, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82680, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82681, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82678, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82679, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82677, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82676, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82675, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82674, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82673, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82672, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82671, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82670, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82669, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82668, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82667, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82666, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82665, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82664, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82663, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82662, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82661, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82660, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82659, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82658, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82657, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82656, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82655, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82654, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82653, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82652, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82651, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82650, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82649, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82648, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82646, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82647, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82645, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82644, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82642, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82643, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82641, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82640, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82639, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82637, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82638, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82636, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82635, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82633, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82634, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82632, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82631, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82630, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82628, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82629, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82627, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82626, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82624, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82625, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82623, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82622, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82621, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82620, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82618, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82619, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82616, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82617, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82614, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82615, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82611, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82612, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82613, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82609, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82610, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82606, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82607, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82608, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82604, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82605, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82601, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82602, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82603, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82598, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82599, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82600, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82596, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82597, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82593, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82594, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82595, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82592, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82591, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82589, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82590, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82588, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82587, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82586, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82585, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82584, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82583, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82582, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82581, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82579, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82580, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82578, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82576, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82577, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82574, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82575, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82573, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82572, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82571, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82570, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82569, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82568, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82567, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82566, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82565, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82564, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82563, 'QSPLO1220', 'Nikhil Kumar Mishra', '7', '7', '22', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82561, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82562, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0);
INSERT INTO `bb_attendance` (`id`, `emp_code`, `emp_name`, `dep_id`, `div_id`, `design_id`, `in_log_date`, `log_day`, `out_log_date`, `punch_in_time`, `punch_out_time`, `work_hours`, `status`, `total_days`, `working_days`) VALUES
(82560, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82558, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82559, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82557, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82555, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82556, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82554, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82552, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82553, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82550, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82551, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82549, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82547, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82548, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82546, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82545, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82543, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82544, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82542, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82541, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82540, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82539, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82538, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82537, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82536, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82535, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82534, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82533, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82532, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82531, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82529, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82530, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82528, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82527, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82526, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82525, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82524, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82523, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82522, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82521, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82520, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82519, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82518, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82517, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82516, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82515, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82514, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82513, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82512, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82510, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82511, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82508, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82509, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82506, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82507, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82504, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82505, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82502, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82503, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82500, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82501, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82498, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82499, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82496, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82497, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82494, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82495, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82492, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82493, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82490, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82491, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82487, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82488, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82489, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82486, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82485, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82484, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82483, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82482, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82479, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82480, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82481, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82478, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82477, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82476, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82475, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82473, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82474, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82472, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82471, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82470, 'QSPLO1225', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82467, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82469, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82468, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82464, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82466, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82465, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82463, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82462, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82459, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82460, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82461, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82458, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82457, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82456, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82453, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82454, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82455, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82452, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82451, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82450, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82449, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82447, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82448, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82446, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82445, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82444, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82441, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82442, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82443, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82440, 'QSPLO1223', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82439, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82438, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82437, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82436, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82435, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82433, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82434, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82432, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82431, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82430, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82427, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82428, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82429, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82426, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82425, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82424, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82423, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82422, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82421, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82419, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82420, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82417, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82418, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82416, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82414, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82415, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82413, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82412, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82409, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82411, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82410, 'QSPLO1164', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82406, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82408, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82407, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82404, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82405, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82403, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82402, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82401, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82398, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82399, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82400, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82397, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82396, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82395, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82392, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82393, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82394, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82391, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82390, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82389, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82388, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82387, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82385, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82386, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82384, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82383, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82382, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82381, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82378, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82380, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82379, 'QSPLO1165', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82377, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82374, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82376, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82375, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82372, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82373, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82371, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82370, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82369, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82366, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82367, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82368, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82365, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82364, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82363, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82362, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82361, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82358, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82359, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82360, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82357, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82355, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82356, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82354, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82353, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82350, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82352, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82351, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82348, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82349, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82347, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82346, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82345, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82342, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82343, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82344, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82341, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82340, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82339, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82337, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82338, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82334, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82335, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82336, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82333, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82332, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82331, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82330, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82329, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82328, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82327, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82326, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82325, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82323, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82324, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82322, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82321, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82318, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82319, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82320, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82317, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82316, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82313, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82314, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82315, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82311, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82312, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82310, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82309, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82308, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82305, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82306, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82307, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82302, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82304, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82303, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82301, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82300, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82299, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82298, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82297, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82296, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82295, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82294, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82293, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82292, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82291, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82290, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82289, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82288, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82287, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82286, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82285, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82283, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82284, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82282, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82281, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82280, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82279, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82278, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82275, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82276, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82277, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82274, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82273, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82272, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82271, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82270, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82269, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82268, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82267, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82266, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82265, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82264, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82263, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82262, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82261, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82260, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82259, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82258, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82257, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82256, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82255, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82254, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82253, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82252, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82251, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82250, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82248, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82249, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82247, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82245, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82246, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82242, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82244, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82243, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82241, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82240, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82239, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82236, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82237, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82238, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82235, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82234, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82233, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82232, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82231, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82228, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82230, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82229, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82227, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82224, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82226, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82225, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82223, 'QSPLO1091', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82221, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82222, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82220, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82219, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82218, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82215, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82216, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82217, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82214, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82213, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82212, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82211, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82209, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82210, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82207, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82208, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82206, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82205, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82204, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82203, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82202, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82201, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82200, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82199, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82198, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82197, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82196, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82195, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82194, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82193, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82192, 'QSPLO1109', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82191, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82188, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82189, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82190, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82187, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82185, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82186, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82183, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82184, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82180, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82181, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82182, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82179, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82178, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82177, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82174, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82175, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82176, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82173, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82172, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82169, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82170, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82171, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82167, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82168, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82165, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82166, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82163, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82164, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0);
INSERT INTO `bb_attendance` (`id`, `emp_code`, `emp_name`, `dep_id`, `div_id`, `design_id`, `in_log_date`, `log_day`, `out_log_date`, `punch_in_time`, `punch_out_time`, `work_hours`, `status`, `total_days`, `working_days`) VALUES
(82161, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82162, 'QSPLO1219', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82160, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82157, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82159, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82158, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82156, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82155, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82154, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82153, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82151, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82152, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82150, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82148, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82149, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82146, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82147, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82144, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82145, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82141, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82142, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82143, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82140, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82138, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82139, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82136, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82137, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82135, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82133, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82134, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82132, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82130, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82131, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82128, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82129, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82127, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82126, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82125, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82123, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82124, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82122, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82121, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82120, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82119, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82117, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82118, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82116, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82115, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82114, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82113, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82112, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82111, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82110, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82109, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82108, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82107, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82105, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82106, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82103, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82104, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82102, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82101, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82100, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82099, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82097, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82098, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82096, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82095, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82094, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82091, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82092, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82093, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82090, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82089, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82088, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82087, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82086, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82085, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82084, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82083, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82082, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82081, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82080, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82078, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82079, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82077, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82076, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82075, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82074, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82073, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82071, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82072, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82070, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82069, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82068, 'QSPLO1224', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82067, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82066, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82065, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82064, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82063, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82062, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82061, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82059, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82060, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82058, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82056, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82057, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82055, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82054, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82053, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82050, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82051, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82052, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82049, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82048, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82045, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82046, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82047, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82044, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82043, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82042, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82040, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82041, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82039, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82038, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82037, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82036, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82033, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82034, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82035, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(82032, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82030, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82031, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82029, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82028, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82025, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82027, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82026, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82024, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82023, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82022, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82019, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82020, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82021, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82018, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82017, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82016, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82014, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82015, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82013, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82012, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82011, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82010, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82009, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82008, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82005, 'QSPLO1171', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82006, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82007, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82004, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82003, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82001, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82002, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(82000, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81999, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81998, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81997, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81994, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81996, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81995, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81993, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81990, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81992, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81991, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81988, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81989, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81987, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81986, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81985, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81984, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81983, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81981, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81982, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81980, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81979, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81978, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81977, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81976, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81975, 'QSPLO1170', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81974, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81972, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81973, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81970, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81971, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81969, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81968, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81967, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81964, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81965, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81966, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81963, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81962, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81961, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81960, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81959, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81957, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81958, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81956, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81954, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81955, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81952, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81953, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81951, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81950, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81949, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81948, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81946, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81947, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81945, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81944, 'QSPLO1141', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81943, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81942, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81939, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81940, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81941, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81936, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81937, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81938, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81935, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81934, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81933, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81932, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81931, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81930, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81929, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81928, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81927, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81926, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81925, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81924, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81923, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81922, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81921, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81920, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81919, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81918, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81917, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81916, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81915, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81914, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81913, 'QSPLO1149', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81912, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81911, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81910, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81909, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81908, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81907, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81906, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81905, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81903, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81904, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81901, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81902, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81900, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81899, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81897, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81898, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81895, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81896, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81894, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81892, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81893, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81890, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81891, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81889, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81888, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81887, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81885, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81886, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81884, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81883, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81882, 'QSPLO1218', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81881, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81880, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81879, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81878, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81877, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81876, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81875, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81874, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81873, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81872, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81871, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81870, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81869, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81868, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81867, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81866, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81865, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81864, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81863, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81862, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81861, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81860, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81859, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81858, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81857, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81856, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81855, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81854, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81853, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81852, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81851, 'QSPLO1082', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81850, 'QSPLO1227', 'Manoj Kumar A', '7', '7', '17', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81849, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81848, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81847, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81846, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81845, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81844, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81841, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81843, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81842, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81840, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81839, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81837, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81838, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81836, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81834, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81835, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81833, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81832, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81831, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81830, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81829, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81827, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81828, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81826, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81825, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81824, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81823, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81822, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81821, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81820, 'QSPLO1226', 'Sebasthiyan S', '7', '7', '9', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81819, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81818, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81817, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81816, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81815, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81814, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81813, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81812, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81811, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81810, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81809, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81808, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81807, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81806, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81805, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81804, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81803, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81802, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81801, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81800, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81799, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81798, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81797, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81796, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81795, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81794, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81793, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81792, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81791, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81790, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81789, 'QSPLO1222', 'Nitesh', '7', '7', '17', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81788, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81787, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81786, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81785, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81784, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81783, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81781, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81782, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81779, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81780, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81777, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81778, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81775, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81776, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 0, 31.0, 0.0),
(81772, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81773, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81774, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81771, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81769, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81770, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81766, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81768, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81767, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81764, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81765, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81761, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81762, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81763, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0);
INSERT INTO `bb_attendance` (`id`, `emp_code`, `emp_name`, `dep_id`, `div_id`, `design_id`, `in_log_date`, `log_day`, `out_log_date`, `punch_in_time`, `punch_out_time`, `work_hours`, `status`, `total_days`, `working_days`) VALUES
(81760, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81758, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81759, 'QSPLO1095', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81755, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81757, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81756, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81752, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81753, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81754, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81751, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81750, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81749, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81748, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81745, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81746, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81747, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81744, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81743, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81741, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81742, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81738, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81740, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81739, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81737, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81734, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81736, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81735, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81733, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81732, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81731, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81730, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81728, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81729, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81727, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81726, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81725, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81724, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81723, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81722, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81719, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81720, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81721, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81718, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81717, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81716, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81713, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81715, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81714, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81712, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81711, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81710, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81709, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81708, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81707, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81706, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81705, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81704, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81703, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81702, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81701, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81700, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81699, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81698, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81697, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81696, 'QSPLO1187', 'Suresh Kumar S', '7', '7', '19', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81695, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81694, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81693, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81692, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81691, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81690, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81689, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81688, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81687, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81686, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81685, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81684, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81682, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81683, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81681, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81679, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81680, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81678, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81676, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81677, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81675, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81673, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81674, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81672, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81670, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81671, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81668, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81669, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81667, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81665, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81666, 'QSPLO1151', 'Dhinesh Kumar', '7', '7', '9', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81664, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81663, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81660, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81661, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81662, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81659, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81657, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81658, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81655, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81656, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81652, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81653, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81654, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81651, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81649, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81650, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81647, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81648, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81644, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81645, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81646, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81641, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81643, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81642, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81639, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81640, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81637, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81638, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81635, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81636, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81633, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81634, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81631, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81632, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81629, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81630, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81627, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81628, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81625, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81626, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81623, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81624, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81621, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81622, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81620, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81619, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81618, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81617, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81616, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81615, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81614, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81613, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81612, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81611, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81610, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81609, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81608, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81607, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81606, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81605, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81604, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81603, 'QSPLO1123', 'Fathimuthu Jagara', '7', '7', '18', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81602, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81601, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81600, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81599, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81598, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81597, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81596, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81595, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81594, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81593, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81592, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81591, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81590, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81589, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81588, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81587, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81586, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81585, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81584, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81583, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81582, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81581, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81580, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81579, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81578, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81577, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81576, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81575, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81574, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81573, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81572, 'QSPLO1013', 'Vinothraj', '7', '7', '34', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81571, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81570, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81569, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81568, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81567, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81566, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81565, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81564, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81563, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81562, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81561, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81560, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81559, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81558, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81556, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81557, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81555, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81553, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81554, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81551, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81552, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81548, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81550, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81549, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81547, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81545, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81546, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81543, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81544, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81540, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81542, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81541, 'QSPLO1181', 'Anisha', '7', '7', '17', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81539, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81538, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81537, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81536, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81535, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81534, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81533, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81532, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81531, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81530, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81529, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81528, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81527, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81526, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81525, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81524, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81523, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81522, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81521, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81520, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81519, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81518, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81517, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81516, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81515, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81514, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81513, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81512, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81511, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81509, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81510, 'QSPLO1088', 'Siva K', '7', '7', '9', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81508, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81507, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81506, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81504, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81505, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81503, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81502, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81501, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81499, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81500, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81498, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81496, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81497, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81495, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81494, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81493, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81492, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81491, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81490, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81488, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81489, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81486, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81487, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81485, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81484, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81482, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81483, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81481, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81479, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81480, 'QSPLO1124', 'Sakthivel', '7', '7', '16', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81478, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81477, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81475, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81476, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81474, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81472, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81473, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81471, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81470, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81468, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81469, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81467, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81465, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81466, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81464, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81463, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81461, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81462, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81460, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81459, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81458, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81456, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81457, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81455, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81453, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81454, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81452, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81451, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81449, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81450, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81447, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81448, 'QSPLO1008', 'Parthiban', '7', '7', '15', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81446, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81444, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81445, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81443, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81441, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81442, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81439, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81440, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81437, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81438, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81435, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81436, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81433, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81434, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81431, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81432, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81430, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81428, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81429, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81426, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81427, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81425, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81423, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81424, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81421, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81422, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81420, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81419, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81418, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81417, 'QSPLO1079', 'Imthiaz Basha', '7', '7', '17', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81416, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81415, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81414, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81413, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81411, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81412, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81410, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81409, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81408, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81407, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81406, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81405, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81404, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81403, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81402, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81401, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81400, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81399, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81398, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81397, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81396, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81395, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81394, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81393, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81392, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81391, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81390, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81389, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81388, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81387, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81386, 'QSPLO1017', 'Chandhiramohan', '7', '7', '16', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81385, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81384, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81383, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81382, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81381, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81380, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81379, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81378, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81377, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81376, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81374, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81375, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81373, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81372, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81371, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81369, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81370, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81368, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81366, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81367, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81365, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81364, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81363, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81362, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81361, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81360, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81358, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81359, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81357, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81355, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81356, 'QSPLO1108', 'Elavarasan', '7', '7', '15', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0);
INSERT INTO `bb_attendance` (`id`, `emp_code`, `emp_name`, `dep_id`, `div_id`, `design_id`, `in_log_date`, `log_day`, `out_log_date`, `punch_in_time`, `punch_out_time`, `work_hours`, `status`, `total_days`, `working_days`) VALUES
(81353, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81354, 'QSPLE215', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81351, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81352, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81349, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81350, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81347, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81348, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81345, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81346, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81343, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81344, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81341, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81342, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81339, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81340, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81337, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81338, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81335, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81336, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81334, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81333, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81332, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81331, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81330, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81329, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81328, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81327, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81325, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81326, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81324, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81323, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81322, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81321, 'QSPLO1217', 'Yugandhar N Goru', '7', '7', '22', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81320, 'QSPLO1216', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81319, 'QSPLO1215', 'Muralitharan', '7', '7', '9', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81317, 'QSPLO1213', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81318, 'QSPLO1214', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81316, 'QSPLO1212', 'Chevvu Venu', '7', '7', '22', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81315, 'QSPLO1211', 'Anandan', '7', '7', '22', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81314, 'QSPLO1210', 'Vikrant Shyamgiri Gosavi', '7', '7', '22', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81313, 'QSPLO1209', 'Ashwin Joshi', '7', '7', '24', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81312, 'QSPLO1208', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81311, 'QSPLO1207', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81309, 'QSPLO1205', 'Subin', '7', '7', '20', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81310, 'QSPLO1206', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81308, 'QSPLO1204', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81307, 'QSPLO1203', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81306, 'QSPLO1202', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81304, 'QSPLO1200', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81305, 'QSPLO1201', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81303, 'QSPLO1199', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81301, 'QSPLO1197', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81302, 'QSPLO1198', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81300, 'QSPLO1196', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81299, 'QSPLO1195', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81298, 'QSPLO1194', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81297, 'QSPLO1193', 'Kamalesh', '7', '7', '22', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81296, 'QSPLO1192', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81294, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81295, 'QSPLO1191', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81293, 'QSPLO1189', 'Dharmadurai', '7', '7', '9', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81292, 'QSPLO1188', 'Vanjinathan A', '7', '7', '34', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81290, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81291, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81288, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81289, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81287, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81286, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81285, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81284, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81282, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81283, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81281, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81280, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81279, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81278, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81277, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81275, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81276, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81273, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81274, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81271, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81272, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81269, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81270, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81268, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81267, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81266, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81265, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81264, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81263, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81262, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81261, 'QSPLO1190', 'Nill', 'Nill', 'Nill', 'Nill', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81260, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-31', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81259, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-30', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81258, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-29', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81257, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-28', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81256, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-27', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81255, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-26', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81254, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-25', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81253, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-24', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81252, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-23', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81251, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-22', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81250, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-21', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81249, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-20', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81248, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-19', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81247, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-18', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81246, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-17', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81245, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-16', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81244, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-15', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81243, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-14', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81242, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-13', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81241, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-12', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81240, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-11', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81239, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-10', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81238, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-09', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81237, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-08', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81236, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-07', 'Thursday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81235, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-06', 'Wednesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81234, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-05', 'Tuesday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81233, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-04', 'Monday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81232, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-03', 'Sunday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81231, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-02', 'Saturday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0),
(81230, 'QSPLO1185', 'Sivagurunathan R', '7', '7', '9', '2024-03-01', 'Friday', NULL, '09:00:00', '06:00:00', 9, 1, 31.0, 1.0);

-- --------------------------------------------------------

--
-- Table structure for table `bom_component`
--

CREATE TABLE `bom_component` (
  `id` int(11) NOT NULL,
  `cost_sheet_id` int(11) NOT NULL,
  `po_ticket_id` int(11) NOT NULL,
  `bom` int(11) NOT NULL,
  `component_remark` varchar(500) NOT NULL,
  `status` int(11) NOT NULL,
  `reject_remark` varchar(500) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `calls_master`
--

CREATE TABLE `calls_master` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `calls_master`
--

INSERT INTO `calls_master` (`id`, `name`, `status`, `created_by`) VALUES
(1, 'Incoming', 1, '2021-04-01 04:48:00'),
(2, 'Outgoing', 1, '2021-04-01 04:48:00'),
(3, 'Direct', 1, '2021-04-01 04:48:00'),
(4, 'By Mail', 1, '2021-10-14 02:33:37');

-- --------------------------------------------------------

--
-- Table structure for table `candicate_results`
--

CREATE TABLE `candicate_results` (
  `id` int(11) NOT NULL,
  `qn_name_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL,
  `ueser_id` int(11) NOT NULL,
  `question` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `Status` int(11) NOT NULL DEFAULT 1,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candicate_results`
--

INSERT INTO `candicate_results` (`id`, `qn_name_id`, `section_id`, `ueser_id`, `question`, `answer`, `Status`, `created`) VALUES
(1, 1, 1, 86, 1, 2, 1, '2021-10-21 05:24:16'),
(2, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(3, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(4, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(5, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(6, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(7, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(8, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(9, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(10, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(11, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(12, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(13, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(14, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(15, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(16, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(17, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(18, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(19, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(20, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(21, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(22, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(23, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(24, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(25, 0, NULL, 6, 0, 0, 1, '2024-08-06 08:44:58'),
(26, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(27, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(28, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(29, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(30, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(31, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(32, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(33, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(34, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(35, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(36, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(37, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(38, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(39, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(40, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(41, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(42, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(43, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(44, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(45, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(46, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(47, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(48, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16'),
(49, 0, NULL, 42, 0, 0, 1, '2024-09-19 10:02:16');

-- --------------------------------------------------------

--
-- Table structure for table `candidate_accept_reject`
--

CREATE TABLE `candidate_accept_reject` (
  `id` int(11) NOT NULL,
  `candidateID` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `reject_remark` varchar(250) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `available_date` varchar(50) DEFAULT NULL,
  `available_time` varchar(50) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `candidate_accept_reject`
--

INSERT INTO `candidate_accept_reject` (`id`, `candidateID`, `staff_id`, `reject_remark`, `status`, `available_date`, `available_time`, `created_on`) VALUES
(1, 137, 4, NULL, 2, NULL, NULL, '2022-11-24 18:06:15'),
(2, 138, 17, NULL, 2, '2022-12-19', '17:50', '2022-12-19 17:51:23'),
(3, 138, 17, NULL, 1, '2022-12-20', '10:00', '2022-12-19 17:53:16'),
(4, 1202, 1, NULL, 2, '2023-04-01', '08:35', '2023-03-31 20:35:38'),
(5, 1201, 1, NULL, 1, '2023-03-31', '09:09', '2023-03-31 21:09:06'),
(6, 1211, 1, NULL, 2, '2023-04-20', '17:00', '2023-04-20 16:53:49'),
(7, 1206, 1, NULL, 1, '2023-04-20', '17:00', '2023-04-20 16:54:13'),
(8, 1213, 1, NULL, 2, '2023-04-21', '03:07', '2023-04-21 15:07:07'),
(9, 1215, 1, NULL, 2, '2023-04-25', '16:53', '2023-04-25 16:46:59'),
(10, 1216, 1, NULL, 2, '2023-04-25', '16:53', '2023-04-25 16:47:14'),
(11, 1218, 1, NULL, 2, '2023-05-04', '14:00', '2023-05-04 11:45:41'),
(12, 1205, 13, NULL, 1, '2023-05-07', '17:16', '2023-05-07 17:16:58'),
(13, 1207, 13, NULL, 2, '2023-05-07', '17:17', '2023-05-07 17:17:14'),
(14, 1207, 1, NULL, 1, '2023-05-07', '17:21', '2023-05-07 17:21:24'),
(15, 1219, 1, NULL, 2, '2023-05-07', '17:24', '2023-05-07 17:24:23'),
(16, 1221, 1, NULL, 2, '2023-06-26', '16:00', '2023-06-26 15:39:55'),
(17, 1225, 1, NULL, 2, '2023-06-27', '19:43', '2023-06-27 17:44:03'),
(18, 1212, 1, NULL, 1, '2023-06-28', '12:14', '2023-06-28 12:15:03'),
(19, 1227, 1, NULL, 1, '2023-06-29', '13:15', '2023-06-29 12:13:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `type` (`type`);

--
-- Indexes for table `accounts_bank`
--
ALTER TABLE `accounts_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_bs_group_master`
--
ALTER TABLE `accounts_bs_group_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_daybook_master`
--
ALTER TABLE `accounts_daybook_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_domain_entries`
--
ALTER TABLE `accounts_domain_entries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_ledger`
--
ALTER TABLE `accounts_ledger`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `accounts_ledger_opening_balance`
--
ALTER TABLE `accounts_ledger_opening_balance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_pl_group_master`
--
ALTER TABLE `accounts_pl_group_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_sub_ledger`
--
ALTER TABLE `accounts_sub_ledger`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `accounts_voucher`
--
ALTER TABLE `accounts_voucher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `accounts_voucher_category`
--
ALTER TABLE `accounts_voucher_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_voucher_detail`
--
ALTER TABLE `accounts_voucher_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `accounts_voucher_purpose`
--
ALTER TABLE `accounts_voucher_purpose`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `account_entry`
--
ALTER TABLE `account_entry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `allowance_percentage_master`
--
ALTER TABLE `allowance_percentage_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_details`
--
ALTER TABLE `appraisal_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_master`
--
ALTER TABLE `appraisal_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_question`
--
ALTER TABLE `appraisal_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_rating`
--
ALTER TABLE `appraisal_rating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_rounds`
--
ALTER TABLE `appraisal_rounds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appraisal_rounds_mapping`
--
ALTER TABLE `appraisal_rounds_mapping`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area_of_visit`
--
ALTER TABLE `area_of_visit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `arrear_pay`
--
ALTER TABLE `arrear_pay`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assessment_qn_master`
--
ALTER TABLE `assessment_qn_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_form_detail`
--
ALTER TABLE `assets_form_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assets_master`
--
ALTER TABLE `assets_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_files`
--
ALTER TABLE `attendance_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attire_form`
--
ALTER TABLE `attire_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_master`
--
ALTER TABLE `bank_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bb_attendance`
--
ALTER TABLE `bb_attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bom_component`
--
ALTER TABLE `bom_component`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `calls_master`
--
ALTER TABLE `calls_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candicate_results`
--
ALTER TABLE `candicate_results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidate_accept_reject`
--
ALTER TABLE `candidate_accept_reject`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `accounts_bank`
--
ALTER TABLE `accounts_bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `accounts_bs_group_master`
--
ALTER TABLE `accounts_bs_group_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `accounts_daybook_master`
--
ALTER TABLE `accounts_daybook_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `accounts_domain_entries`
--
ALTER TABLE `accounts_domain_entries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts_ledger`
--
ALTER TABLE `accounts_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `accounts_ledger_opening_balance`
--
ALTER TABLE `accounts_ledger_opening_balance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounts_pl_group_master`
--
ALTER TABLE `accounts_pl_group_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `accounts_sub_ledger`
--
ALTER TABLE `accounts_sub_ledger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accounts_voucher`
--
ALTER TABLE `accounts_voucher`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounts_voucher_category`
--
ALTER TABLE `accounts_voucher_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `accounts_voucher_detail`
--
ALTER TABLE `accounts_voucher_detail`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `accounts_voucher_purpose`
--
ALTER TABLE `accounts_voucher_purpose`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `account_entry`
--
ALTER TABLE `account_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `allowance_percentage_master`
--
ALTER TABLE `allowance_percentage_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appraisal_details`
--
ALTER TABLE `appraisal_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisal_master`
--
ALTER TABLE `appraisal_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisal_question`
--
ALTER TABLE `appraisal_question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisal_rating`
--
ALTER TABLE `appraisal_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appraisal_rounds`
--
ALTER TABLE `appraisal_rounds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appraisal_rounds_mapping`
--
ALTER TABLE `appraisal_rounds_mapping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `area_of_visit`
--
ALTER TABLE `area_of_visit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `arrear_pay`
--
ALTER TABLE `arrear_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `assessment_qn_master`
--
ALTER TABLE `assessment_qn_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `assets_form_detail`
--
ALTER TABLE `assets_form_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assets_master`
--
ALTER TABLE `assets_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance_files`
--
ALTER TABLE `attendance_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attire_form`
--
ALTER TABLE `attire_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;

--
-- AUTO_INCREMENT for table `bank_master`
--
ALTER TABLE `bank_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bb_attendance`
--
ALTER TABLE `bb_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82964;

--
-- AUTO_INCREMENT for table `bom_component`
--
ALTER TABLE `bom_component`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `calls_master`
--
ALTER TABLE `calls_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `candicate_results`
--
ALTER TABLE `candicate_results`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `candidate_accept_reject`
--
ALTER TABLE `candidate_accept_reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
