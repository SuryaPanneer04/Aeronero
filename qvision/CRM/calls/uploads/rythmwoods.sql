-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 16, 2024 at 04:11 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb3 */;

--
-- Database: `rythm`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(250) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `password` varchar(100) NOT NULL,
  `createdon` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`id`, `username`, `password`, `createdon`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2024-02-15');

-- --------------------------------------------------------

--
-- Table structure for table `daily_event`
--

DROP TABLE IF EXISTS `daily_event`;
CREATE TABLE IF NOT EXISTS `daily_event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `singer_type` varchar(100) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `daily_task`
--

DROP TABLE IF EXISTS `daily_task`;
CREATE TABLE IF NOT EXISTS `daily_task` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `completed_date` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `created` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `singer_type` varchar(250) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `daily_task`
--

INSERT INTO `daily_task` (`id`, `user_id`, `title`, `description`, `date`, `completed_date`, `created`, `status`, `singer_type`) VALUES
(1, 1, 'Email', ' qwerty', '2022-09-23', '2022-09-23 09:29:11', '2022-09-23', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `following_details`
--

DROP TABLE IF EXISTS `following_details`;
CREATE TABLE IF NOT EXISTS `following_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `role_master_id` int NOT NULL,
  `following_sts` int NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

DROP TABLE IF EXISTS `forgot_password`;
CREATE TABLE IF NOT EXISTS `forgot_password` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `otp` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `forgot_password`
--

INSERT INTO `forgot_password` (`id`, `user_name`, `otp`) VALUES
(4, 'devika', 6831543),
(14, 'sanjay', 2192528),
(28, 'smk', 2158751),
(39, 'basker', 2716965),
(57, 'Gopalabr', 1857094),
(67, 'Manoj ', 3205804),
(71, 'ganesan', 2451587),
(72, 'Pioneer Suresh', 5086585),
(81, 'hnspad', 8996524),
(84, 'Balaji', 8345127),
(88, 'admin', 7494447),
(91, 'CGPMG', 7739060),
(148, 'sudha65', 8423036),
(153, 'prabhu', 7484619),
(155, 'praveen', 7161862);

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

DROP TABLE IF EXISTS `languages`;
CREATE TABLE IF NOT EXISTS `languages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `language_name` varchar(255) NOT NULL,
  `language_code` varchar(255) NOT NULL,
  `singer_type` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `language_name`, `language_code`, `singer_type`, `status`) VALUES
(1, 'Tamil', 'ta', '', ''),
(2, 'Hindi', 'hi', '', ''),
(3, 'Malayalam', 'ma', '', ''),
(4, 'Telugu', 'te', '', ''),
(5, 'Sinhala', 'si', '', ''),
(6, 'English', 'en', '', ''),
(7, 'Bengali', 'Be', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `lyrics`
--

DROP TABLE IF EXISTS `lyrics`;
CREATE TABLE IF NOT EXISTS `lyrics` (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_name` varchar(255) NOT NULL,
  `year` year NOT NULL,
  `language_id` int NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `singer_type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `masters_menu`
--

DROP TABLE IF EXISTS `masters_menu`;
CREATE TABLE IF NOT EXISTS `masters_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_description` varchar(255) DEFAULT NULL,
  `menu_order` varchar(255) DEFAULT NULL,
  `menu_class` varchar(255) DEFAULT NULL,
  `menu_url` varchar(255) DEFAULT NULL,
  `call_method` varchar(125) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masters_menu`
--

INSERT INTO `masters_menu` (`id`, `menu_name`, `menu_description`, `menu_order`, `menu_class`, `menu_url`, `call_method`, `created_by`, `created_on`) VALUES
(1, 'Neha Girish', 'Album', '1', 'emp', 'Album', 'Album()', 1, '2020-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `masters_sub_menu`
--

DROP TABLE IF EXISTS `masters_sub_menu`;
CREATE TABLE IF NOT EXISTS `masters_sub_menu` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `call_method` varchar(255) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masters_sub_menu`
--

INSERT INTO `masters_sub_menu` (`id`, `menu_id`, `name`, `call_method`, `status`, `created_by`, `created_on`, `modified_by`, `modified_on`) VALUES
(1, 1, 'Music_Directors', 'music_director()', 1, 1, '2020-12-01 00:00:00', NULL, NULL),
(3, 1, 'Add_Song', 'songs()', 1, 1, '2020-12-01 00:00:00', NULL, NULL),
(4, 1, 'Event Planer', 'calendar()', 1, 1, '2020-12-01 00:00:00', NULL, NULL),
(5, 1, 'Add Event', 'calendaradd()', 1, 1, '2021-02-25 00:00:00', NULL, NULL),
(6, 1, 'Users', 'Users()', 1, 1, '2021-02-25 00:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `movie_composer`
--

DROP TABLE IF EXISTS `movie_composer`;
CREATE TABLE IF NOT EXISTS `movie_composer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NOT NULL,
  `composer_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `movie_singer`
--

DROP TABLE IF EXISTS `movie_singer`;
CREATE TABLE IF NOT EXISTS `movie_singer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `movie_id` int NOT NULL,
  `singer_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `music_directors`
--

DROP TABLE IF EXISTS `music_directors`;
CREATE TABLE IF NOT EXISTS `music_directors` (
  `id` int NOT NULL AUTO_INCREMENT,
  `music_director_name` varchar(255) NOT NULL,
  `singer_type` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `music_directors`
--

INSERT INTO `music_directors` (`id`, `music_director_name`, `singer_type`) VALUES
(6, 'AR Rahman', ''),
(7, 'Illayaraja', ''),
(8, 'Vidyasagar', ''),
(9, 'D Imman', ''),
(10, 'Yuvan Shankar Raja', '');

-- --------------------------------------------------------

--
-- Table structure for table `otptable`
--

DROP TABLE IF EXISTS `otptable`;
CREATE TABLE IF NOT EXISTS `otptable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `confirmpassword` varchar(250) NOT NULL,
  `otpcode` varchar(250) NOT NULL,
  `created_on` date NOT NULL,
  `modify_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `otptable`
--

INSERT INTO `otptable` (`id`, `email`, `password`, `confirmpassword`, `otpcode`, `created_on`, `modify_on`) VALUES
(15, 'priyadevi09404@gmail.com', '12345678', '12345678', '4016', '2024-01-22', '0000-00-00'),
(14, 'priyadevi09404@gmail.com', '12345678', '12345678', '8055', '2024-01-22', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `posters`
--

DROP TABLE IF EXISTS `posters`;
CREATE TABLE IF NOT EXISTS `posters` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(2000) NOT NULL,
  `username_id` int NOT NULL,
  `poster_id` int NOT NULL,
  `post_type` varchar(250) NOT NULL,
  `postimg` varchar(2000) NOT NULL,
  `postvideos` varchar(2000) NOT NULL,
  `location` varchar(250) NOT NULL,
  `posters_caption` varchar(2000) NOT NULL,
  `likestatus` int NOT NULL,
  `liker_id` int NOT NULL,
  `likesdate` date NOT NULL,
  `ownlikessts` int NOT NULL,
  `status` int NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `posters`
--

INSERT INTO `posters` (`id`, `username`, `username_id`, `poster_id`, `post_type`, `postimg`, `postvideos`, `location`, `posters_caption`, `likestatus`, `liker_id`, `likesdate`, `ownlikessts`, `status`, `created_on`) VALUES
(1, 'bluebase', 2, 1, 'video', '', '/rythm/assets/samplevedio.mp4', 'chennai', 'All is well🥳🥳', 1, 3, '2024-02-08', 0, 1, '2024-01-09'),
(2, 'ryhtmwoods', 3, 2, 'image', '/rythm/assets/postime22.jpg', '', 'coimbatour', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 1, '2024-02-08', 0, 1, '2024-01-29'),
(3, 'skyworld', 3, 2, 'image', '/rythm/assets/meet.jpg', '', 'coimbatour', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 2, '2023-01-11', 0, 1, '2024-01-29'),
(4, 'bluestar', 3, 2, 'image', '/rythm/assets/postimg1.jpg', '', 'coimbatour', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 3, '2023-01-01', 0, 1, '2024-01-29'),
(5, 'blue', 3, 2, 'video', '', '/rythm/posters/v2.mp4', 'coimbatour', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 3, '2024-02-10', 0, 1, '2024-01-29'),
(6, 'quadsel', 3, 2, 'video', '', '/rythm/posters/v4.mp4', 'chennai', 'Elevate your marketing leadership quotient with our 10-month live online programme. Join now to gain from real-world... ', 1, 2, '2024-02-08', 0, 1, '2024-01-29');

-- --------------------------------------------------------

--
-- Table structure for table `posters_commads`
--

DROP TABLE IF EXISTS `posters_commads`;
CREATE TABLE IF NOT EXISTS `posters_commads` (
  `id` int NOT NULL AUTO_INCREMENT,
  `posterid` int NOT NULL,
  `commander_id` int NOT NULL,
  `commands` varchar(2000) NOT NULL,
  `likests_cmd` int NOT NULL,
  `likeorno` int NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `posters_commads`
--

INSERT INTO `posters_commads` (`id`, `posterid`, `commander_id`, `commands`, `likests_cmd`, `likeorno`, `created_on`) VALUES
(3, 2, 2, 'this picture is very nice', 0, 0, '2024-01-27'),
(4, 2, 2, 'good', 0, 0, '2024-01-29'),
(5, 2, 2, 'nice', 0, 0, '2024-01-29'),
(6, 2, 2, 'super', 0, 0, '2024-01-29'),
(11, 1, 2, 'nice vedio😍😍😍', 0, 0, '2024-01-29'),
(10, 2, 2, 'goodimggg😍😍', 1, 0, '2024-01-29'),
(12, 1, 2, 'dfghj', 0, 0, '2024-01-31'),
(16, 2, 3, 'verynice😍😎', 0, 0, '2024-02-02'),
(17, 1, 3, 'good vedio', 0, 0, '2024-02-02'),
(18, 6, 2, 'fsdfdsf', 0, 0, '2024-02-12'),
(19, 6, 2, 'sdasd', 0, 0, '2024-02-12'),
(20, 6, 2, 'ddad', 0, 0, '2024-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `poster_download`
--

DROP TABLE IF EXISTS `poster_download`;
CREATE TABLE IF NOT EXISTS `poster_download` (
  `id` int NOT NULL AUTO_INCREMENT,
  `poster_id` int NOT NULL,
  `downloader_id` int NOT NULL,
  `donwload_sts` int NOT NULL,
  `poster_path` varchar(3000) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `profile_details`
--

DROP TABLE IF EXISTS `profile_details`;
CREATE TABLE IF NOT EXISTS `profile_details` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rolemaster_id` int NOT NULL,
  `about` varchar(2000) NOT NULL,
  `facebook` varchar(1000) NOT NULL,
  `twitter` varchar(1000) NOT NULL,
  `instagram` varchar(1000) NOT NULL,
  `youtube` varchar(1000) NOT NULL,
  `imagevedioprotfloio` varchar(1000) NOT NULL,
  `title_1` varchar(200) NOT NULL,
  `title_2` varchar(200) DEFAULT NULL,
  `title_3` varchar(200) DEFAULT NULL,
  `title_4` varchar(200) DEFAULT NULL,
  `title_5` varchar(200) DEFAULT NULL,
  `title_6` varchar(200) DEFAULT NULL,
  `title_7` varchar(200) DEFAULT NULL,
  `title_8` varchar(200) DEFAULT NULL,
  `title_9` varchar(200) DEFAULT NULL,
  `title_10` varchar(200) DEFAULT NULL,
  `year_1` year NOT NULL,
  `year_2` year NOT NULL,
  `year_3` year NOT NULL,
  `year_4` year NOT NULL,
  `year_5` year NOT NULL,
  `year_6` year NOT NULL,
  `year_7` year NOT NULL,
  `year_8` year NOT NULL,
  `year_9` year NOT NULL,
  `year_10` year NOT NULL,
  `awardedby_1` varchar(200) NOT NULL,
  `awardedby_2` varchar(100) NOT NULL,
  `awardedby_3` varchar(100) NOT NULL,
  `awardedby_4` varchar(100) NOT NULL,
  `awardedby_5` varchar(100) NOT NULL,
  `awardedby_6` varchar(100) NOT NULL,
  `awardedby_7` varchar(100) NOT NULL,
  `awardedby_8` varchar(100) NOT NULL,
  `awardedby_9` varchar(100) NOT NULL,
  `awardedby_10` varchar(100) NOT NULL,
  `description_1` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_2` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_3` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_4` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_5` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_6` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_7` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_8` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_9` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `description_10` varchar(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image_1` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `image_2` varchar(20) NOT NULL,
  `image_3` varchar(20) NOT NULL,
  `image_4` varchar(20) NOT NULL,
  `image_5` varchar(20) NOT NULL,
  `image_6` varchar(20) NOT NULL,
  `image_7` varchar(20) NOT NULL,
  `image_8` varchar(20) NOT NULL,
  `image_9` varchar(20) NOT NULL,
  `image_10` varchar(20) NOT NULL,
  `youtubeLink_1` varchar(200) NOT NULL,
  `youtubeLink_2` varchar(20) NOT NULL,
  `youtubeLink_3` varchar(20) NOT NULL,
  `youtubeLink_4` varchar(20) NOT NULL,
  `youtubeLink_5` varchar(20) NOT NULL,
  `youtubeLink_6` varchar(20) NOT NULL,
  `youtubeLink_7` varchar(20) NOT NULL,
  `youtubeLink_8` varchar(20) NOT NULL,
  `youtubeLink_9` varchar(20) NOT NULL,
  `youtubeLink_10` varchar(20) NOT NULL,
  `pjtitle_1_1` varchar(20) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `pjtitle_1_2` varchar(200) DEFAULT NULL,
  `pjtitle_1_3` varchar(200) DEFAULT NULL,
  `pjtitle_1_4` varchar(200) DEFAULT NULL,
  `pjtitle_1_5` varchar(200) DEFAULT NULL,
  `pjtitle_1_6` varchar(200) DEFAULT NULL,
  `pjtitle_1_7` varchar(200) DEFAULT NULL,
  `pjtitle_1_8` varchar(200) DEFAULT NULL,
  `pjtitle_1_9` varchar(200) DEFAULT NULL,
  `pjtitle_1_10` varchar(200) DEFAULT NULL,
  `link_1_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `link_1_2` varchar(200) NOT NULL,
  `link_1_3` varchar(200) NOT NULL,
  `link_1_4` varchar(200) NOT NULL,
  `link_1_5` varchar(200) NOT NULL,
  `link_1_6` varchar(200) NOT NULL,
  `link_1_7` varchar(200) NOT NULL,
  `link_1_8` varchar(200) NOT NULL,
  `link_1_9` varchar(200) NOT NULL,
  `link_1_10` varchar(200) NOT NULL,
  `link_2_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `link_2_2` varchar(20) NOT NULL,
  `link_2_3` varchar(20) NOT NULL,
  `link_2_4` varchar(20) NOT NULL,
  `link_2_5` varchar(20) NOT NULL,
  `link_2_6` varchar(20) NOT NULL,
  `link_2_7` varchar(20) NOT NULL,
  `link_2_8` varchar(20) NOT NULL,
  `link_2_9` varchar(20) NOT NULL,
  `link_2_10` varchar(20) NOT NULL,
  `link_3_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `link_3_2` varchar(20) NOT NULL,
  `link_3_3` varchar(20) NOT NULL,
  `link_3_4` varchar(20) NOT NULL,
  `link_3_5` varchar(20) NOT NULL,
  `link_3_6` varchar(20) NOT NULL,
  `link_3_7` varchar(20) NOT NULL,
  `link_3_8` varchar(20) NOT NULL,
  `link_3_9` varchar(20) NOT NULL,
  `link_3_10` varchar(20) NOT NULL,
  `link_4_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `link_4_2` varchar(20) NOT NULL,
  `link_4_3` varchar(20) NOT NULL,
  `link_4_4` varchar(20) NOT NULL,
  `link_4_5` varchar(20) NOT NULL,
  `link_4_6` varchar(20) NOT NULL,
  `link_4_7` varchar(20) NOT NULL,
  `link_4_8` varchar(20) NOT NULL,
  `link_4_9` varchar(20) NOT NULL,
  `link_4_10` varchar(20) NOT NULL,
  `link_5_1` varchar(200) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `link_5_2` varchar(10) NOT NULL,
  `link_5_3` varchar(10) NOT NULL,
  `link_5_4` varchar(10) NOT NULL,
  `link_5_5` varchar(10) NOT NULL,
  `link_5_6` varchar(10) NOT NULL,
  `link_5_7` varchar(10) NOT NULL,
  `link_5_8` varchar(10) NOT NULL,
  `link_5_9` varchar(10) NOT NULL,
  `link_5_10` varchar(10) NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `admin_status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `profile_details`
--

INSERT INTO `profile_details` (`id`, `rolemaster_id`, `about`, `facebook`, `twitter`, `instagram`, `youtube`, `imagevedioprotfloio`, `title_1`, `title_2`, `title_3`, `title_4`, `title_5`, `title_6`, `title_7`, `title_8`, `title_9`, `title_10`, `year_1`, `year_2`, `year_3`, `year_4`, `year_5`, `year_6`, `year_7`, `year_8`, `year_9`, `year_10`, `awardedby_1`, `awardedby_2`, `awardedby_3`, `awardedby_4`, `awardedby_5`, `awardedby_6`, `awardedby_7`, `awardedby_8`, `awardedby_9`, `awardedby_10`, `description_1`, `description_2`, `description_3`, `description_4`, `description_5`, `description_6`, `description_7`, `description_8`, `description_9`, `description_10`, `image_1`, `image_2`, `image_3`, `image_4`, `image_5`, `image_6`, `image_7`, `image_8`, `image_9`, `image_10`, `youtubeLink_1`, `youtubeLink_2`, `youtubeLink_3`, `youtubeLink_4`, `youtubeLink_5`, `youtubeLink_6`, `youtubeLink_7`, `youtubeLink_8`, `youtubeLink_9`, `youtubeLink_10`, `pjtitle_1_1`, `pjtitle_1_2`, `pjtitle_1_3`, `pjtitle_1_4`, `pjtitle_1_5`, `pjtitle_1_6`, `pjtitle_1_7`, `pjtitle_1_8`, `pjtitle_1_9`, `pjtitle_1_10`, `link_1_1`, `link_1_2`, `link_1_3`, `link_1_4`, `link_1_5`, `link_1_6`, `link_1_7`, `link_1_8`, `link_1_9`, `link_1_10`, `link_2_1`, `link_2_2`, `link_2_3`, `link_2_4`, `link_2_5`, `link_2_6`, `link_2_7`, `link_2_8`, `link_2_9`, `link_2_10`, `link_3_1`, `link_3_2`, `link_3_3`, `link_3_4`, `link_3_5`, `link_3_6`, `link_3_7`, `link_3_8`, `link_3_9`, `link_3_10`, `link_4_1`, `link_4_2`, `link_4_3`, `link_4_4`, `link_4_5`, `link_4_6`, `link_4_7`, `link_4_8`, `link_4_9`, `link_4_10`, `link_5_1`, `link_5_2`, `link_5_3`, `link_5_4`, `link_5_5`, `link_5_6`, `link_5_7`, `link_5_8`, `link_5_9`, `link_5_10`, `created_by`, `created_on`, `admin_status`) VALUES
(1, 2, 'Sample about information', 'sample_facebook', 'sample_twitter', 'sample_instagram', 'sample_youtube', 'sample_image', 'Sample Title 1', 'Sample Title 2', 'Sample Title 3', 'Sample Title 4', 'Sample Title 5', NULL, NULL, NULL, NULL, NULL, 2023, 2022, 2021, 2020, 2019, 0000, 0000, 0000, 0000, 0000, 'Sample Awarded By 1', 'Sample Awarded By 2', 'Sample Awarded By 3', 'Sample Awarded By 4', 'Sample Awarded By 5', '', '', '', '', '', 'Sample Des', '', '', '', '', '', '', '', '', '', 'image1.jpg', '', '', '', '', '', '', '', '', '', 'youtube_link1', '', '', '', '', '', '', '', '', '', 'Project Title 1-1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'link1', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'created_user', '2024-02-15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `role_mapping`
--

DROP TABLE IF EXISTS `role_mapping`;
CREATE TABLE IF NOT EXISTS `role_mapping` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `submenu_id` int NOT NULL,
  `view_only` varchar(200) NOT NULL,
  `edit_only` int NOT NULL,
  `all_only` varchar(50) NOT NULL,
  `approval` int NOT NULL,
  `created_by` varchar(200) NOT NULL,
  `created_on` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_mapping`
--

INSERT INTO `role_mapping` (`id`, `role_id`, `menu_id`, `submenu_id`, `view_only`, `edit_only`, `all_only`, `approval`, `created_by`, `created_on`) VALUES
(1, 1, 1, 1, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(2, 1, 1, 2, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(3, 1, 1, 3, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(4, 1, 1, 4, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(5, 1, 1, 5, '0', 0, '1', 0, '1', '2020-12-01 00:00:00'),
(6, 1, 1, 6, '0', 0, '1', 0, '1', '2020-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

DROP TABLE IF EXISTS `role_master`;
CREATE TABLE IF NOT EXISTS `role_master` (
  `id` int NOT NULL AUTO_INCREMENT,
  `role_name` varchar(200) NOT NULL,
  `status` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`id`, `role_name`, `status`) VALUES
(1, 'Admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sendingmessage`
--

DROP TABLE IF EXISTS `sendingmessage`;
CREATE TABLE IF NOT EXISTS `sendingmessage` (
  `id` int NOT NULL AUTO_INCREMENT,
  `sender_id` int NOT NULL,
  `receiver_id` int NOT NULL,
  `messages` varchar(3000) NOT NULL,
  `senddatetime` datetime NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `sendingmessage`
--

INSERT INTO `sendingmessage` (`id`, `sender_id`, `receiver_id`, `messages`, `senddatetime`, `created_on`) VALUES
(1, 2, 9, 'very nice', '2024-02-12 09:22:03', '2024-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `shareposter`
--

DROP TABLE IF EXISTS `shareposter`;
CREATE TABLE IF NOT EXISTS `shareposter` (
  `id` int NOT NULL AUTO_INCREMENT,
  `posters_id` int NOT NULL,
  `postfrom_id` int NOT NULL,
  `postto_id` int NOT NULL,
  `message_content` varchar(2000) NOT NULL,
  `created_on` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `shareposter`
--

INSERT INTO `shareposter` (`id`, `posters_id`, `postfrom_id`, `postto_id`, `message_content`, `created_on`) VALUES
(1, 2, 1, 1, 'hiii this img was very nice', '2024-02-01'),
(2, 1, 1, 9, 'this video is very nice', '2024-02-01'),
(3, 2, 1, 9, 'ok', '2024-02-01'),
(4, 1, 1, 1, 'good', '2024-02-01'),
(5, 2, 1, 1, 'good', '2024-02-01'),
(6, 2, 2, 1, 'dfgdrth', '2024-02-05');

-- --------------------------------------------------------

--
-- Table structure for table `singers`
--

DROP TABLE IF EXISTS `singers`;
CREATE TABLE IF NOT EXISTS `singers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `singer_name` varchar(255) NOT NULL,
  `singer_type` varchar(250) NOT NULL,
  `status` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `singers`
--

INSERT INTO `singers` (`id`, `singer_name`, `singer_type`, `status`) VALUES
(1, 'S Janaki', '', ''),
(2, 'P Susheela', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `song_master`
--

DROP TABLE IF EXISTS `song_master`;
CREATE TABLE IF NOT EXISTS `song_master` (
  `id` int NOT NULL AUTO_INCREMENT,
  `music_director` varchar(255) CHARACTER SET armscii8 COLLATE armscii8_general_ci DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `language_id` varchar(255) DEFAULT NULL,
  `file_location` varchar(255) DEFAULT NULL,
  `lyrics_location` varchar(255) DEFAULT NULL,
  `singer_type` varchar(250) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `song_master`
--

INSERT INTO `song_master` (`id`, `music_director`, `title`, `language_id`, `file_location`, `lyrics_location`, `singer_type`, `created_on`) VALUES
(9, '7', 'Chinna Chinna Vanna Kuyil', '1', 'Chinna Chinna Vanna Kuyil.mp3', 'Chinna Chinna Vanna Kuyil.pdf', '0', '2023-02-14 10:44:18'),
(10, '7', 'Paal Polavae', '1', 'WhatsApp Audio 2023-01-11 at 16.40.04.mpeg', 'Paal Polave.pdf', '0', '2023-03-04 18:43:38'),
(11, '', 'asd', '', '', '', '0', '2023-04-15 12:40:48'),
(12, '6', 'sdf', '1', 'Bombay_Theme.mp3', 'Partner introduction (1).pdf', '0', '2023-05-18 11:54:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

DROP TABLE IF EXISTS `user_master`;
CREATE TABLE IF NOT EXISTS `user_master` (
  `id` int NOT NULL AUTO_INCREMENT,
  `users_id` int DEFAULT NULL,
  `role_master_id` int DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `profile_img` varchar(2000) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` varchar(255) DEFAULT NULL,
  `experience` varchar(11) DEFAULT NULL,
  `tamil` varchar(255) DEFAULT NULL COMMENT '0 - Unknown1 -  Known',
  `malayalam` varchar(255) DEFAULT NULL COMMENT '0 - Unknown1 - Known',
  `hindi` varchar(255) DEFAULT NULL COMMENT '0 - Unknown1 - Known',
  `status` varchar(10) NOT NULL DEFAULT '0' COMMENT '0 - Inactive 1 - Active',
  `location` varchar(250) NOT NULL,
  `followsts` int NOT NULL,
  `mobile_no` varchar(255) DEFAULT NULL,
  `admin_status` int NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_on` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `users_id`, `role_master_id`, `name`, `profile_img`, `last_name`, `user_name`, `password`, `email`, `title`, `gender`, `date_of_birth`, `experience`, `tamil`, `malayalam`, `hindi`, `status`, `location`, `followsts`, `mobile_no`, `admin_status`, `created_on`, `modified_on`) VALUES
(1, 1, 1, 'Neha Girish', '/rythm/assets/penguin.png', '', 'nehagirish', '8ace0553f2e5cbc047b699cbb260cf64', 'singernehag@gmail.com', 'singer', 'Female', '11-10-2010', NULL, NULL, NULL, NULL, '0', 'chennai', 0, NULL, 0, '2023-02-03 12:40:20', NULL),
(9, 2, 2, 'blue', '/rythm/assets/bluebaselogooooooo.png', 'base', 'bluebase', 'cd84d683cc5612c69efe115c80d0b7dc', 'rythmwoods@gmail.in', 'singer', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', 'chennai', 0, '8675746545', 0, '2024-01-19 16:33:25', ''),
(10, 3, 3, 'rythm', '/rythm/assets/rsz_logo2.png', 'woods', 'rythmwoods', 'cd84d683cc5612c69efe115c80d0b7dc', 'bluebase@gmail.com', 'singer', NULL, '0000-00-00', NULL, NULL, NULL, NULL, '0', 'coimbatoure', 0, '8675746545', 0, '2024-01-19 16:33:25', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
