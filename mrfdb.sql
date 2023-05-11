-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 04, 2023 at 09:11 AM
-- Server version: 5.7.31
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mrfdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `cip_type`
--

DROP TABLE IF EXISTS `cip_type`;
CREATE TABLE IF NOT EXISTS `cip_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cip_id` int(5) NOT NULL,
  `cip_account` varchar(300) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cip_type`
--

INSERT INTO `cip_type` (`id`, `cip_id`, `cip_account`, `status`) VALUES
(1, 1, 'CIP - Architectural - Bldg Lease', 1),
(2, 1, 'CIP - Auxiliary Works - Bldg Lease', 1),
(3, 1, 'CIP - Conveying System - Bldg Lease', 1),
(4, 1, 'CIP - Electrical - Bldg Lease', 1),
(5, 1, 'CIP - Fire Protection - Bldg Lease', 1),
(6, 1, 'CIP - General Requirements - Bldg Lease', 1),
(7, 1, 'CIP - Mechanical - Bldg Lease', 1),
(8, 1, 'CIP - Plumbing & Sanitary - Bldg Lease', 1),
(9, 1, 'CIP - Site Development & Landscaping - Bldg Lease', 1),
(10, 1, 'CIP - Specialties - Bldg Lease', 1),
(11, 1, 'CIP - Structural - Bldg Lease', 1),
(12, 2, 'Construction in Progress - Condo : CIP - Architectural - Condo', 1),
(13, 2, 'Construction in Progress - Condo : CIP - Auxiliary Works - Condo', 1),
(14, 2, 'Construction in Progress - Condo : CIP - Conveying System - Condo', 1),
(16, 2, 'Construction in Progress - Condo : CIP - Electrical - Condo', 1),
(17, 2, 'Construction in Progress - Condo : CIP - Fire Protection - Condo', 1),
(18, 2, 'Construction in Progress - Condo : CIP - General Requirements - Condo', 1),
(19, 2, 'Construction in Progress - Condo : CIP - Mechanical - Condo', 1),
(20, 2, 'Construction in Progress - Condo : CIP - Plumbing & Sanitary - Condo', 1),
(21, 2, 'Construction in Progress - Condo : CIP - Site Development & Landscaping - Condo', 1),
(22, 2, 'Construction in Progress - Condo : CIP - Specialties - Condo', 1),
(23, 2, 'Construction in Progress - Condo : CIP - Structural - Condo', 1),
(24, 3, 'Construction in Progress - House & Lot : CIP - Architectural - H&L', 1),
(25, 3, 'Construction in Progress - House & Lot : CIP - Auxiliary Works - H&L', 1),
(26, 3, 'Construction in Progress - House & Lot : CIP - Conveying System - H&L', 1),
(27, 3, 'Construction in Progress - House & Lot : CIP - Electrical - H&L', 1),
(28, 3, 'Construction in Progress - House & Lot : CIP - Fire Protection - H&L', 1),
(29, 3, 'Construction in Progress - House & Lot : CIP - General Requirements - H&L', 1),
(30, 3, 'Construction in Progress - House & Lot : CIP - Mechanical - H&L', 1),
(31, 3, 'Construction in Progress - House & Lot : CIP - Plumbing & Sanitary - H&L', 1),
(32, 3, 'Construction in Progress - House & Lot : CIP - Site Development & Landscaping - H&L', 1),
(33, 3, 'Construction in Progress - House & Lot : CIP - Specialties - H&L', 1),
(34, 3, 'Construction in Progress - House & Lot : CIP - Structural - H&L', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_of_item`
--

DROP TABLE IF EXISTS `class_of_item`;
CREATE TABLE IF NOT EXISTS `class_of_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `class_item_id` int(11) NOT NULL,
  `items` varchar(100) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_of_item`
--

INSERT INTO `class_of_item` (`id`, `class_item_id`, `items`, `status`) VALUES
(1, 0, 'Architectural', 1),
(2, 1, 'Civil', 1),
(3, 2, 'Structural', 1),
(4, 3, 'HVAC', 1),
(5, 4, 'Mechanical', 1),
(6, 5, 'Plumbing', 1),
(7, 6, 'Electrical', 1),
(8, 7, 'Control Systems/Instrumentation', 1),
(9, 8, 'Paints/Insulation', 1),
(10, 9, 'Miscellaneous', 1);

-- --------------------------------------------------------

--
-- Table structure for table `generateddata`
--

DROP TABLE IF EXISTS `generateddata`;
CREATE TABLE IF NOT EXISTS `generateddata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` varchar(20) NOT NULL,
  `project` varchar(150) NOT NULL,
  `typeof_project` varchar(150) NOT NULL,
  `classification` varchar(150) NOT NULL,
  `sub_class` varchar(150) NOT NULL,
  `con_num` varchar(50) DEFAULT NULL,
  `cip_account` varchar(200) NOT NULL,
  `user_id` int(5) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generateddata`
--

INSERT INTO `generateddata` (`id`, `date_added`, `project`, `typeof_project`, `classification`, `sub_class`, `con_num`, `cip_account`, `user_id`, `status`) VALUES
(1, '2023-04-04', '1', '2', '3', 'test1', 'PM1-23-00001', '12', 1, 1),
(2, '2023-04-04', '2', '3', '1', 'tsest', 'PM2-23-00002', '24', 1, 1),
(3, '2023-04-04', '0', '0', '0', '0', 'MRF-23-00003', '0', 1, 2),
(4, '2023-04-04', '1', '2', '3', 'test1', 'PM1-23-00004', '12', 1, 1),
(5, '2023-04-04', '6', '2', '6', 'test', 'PDW-23-00005', '12', 1, 1),
(6, '2023-04-04', '6', '2', '6', 'test', 'PDW-23-00006', '12', 1, 1),
(7, '2023-04-04', '6', '2', '6', 'test', 'PDW-23-00007', '12', 1, 1),
(8, '2023-04-04', '6', '2', '6', 'test', 'PDW-23-00008', '12', 1, 1),
(9, '2023-04-04', '6', '2', '6', 'test', 'PDW-23-00009', '12', 1, 1),
(10, '2023-04-04', '6', '2', '6', 'test', 'PDW-23-000010', '12', 1, 1),
(11, '2023-04-04', '6', '2', '6', 'test', 'PDW-23-000011', '12', 1, 1),
(12, '2023-04-04', '0', '0', '0', '0', 'MRF-23-000012', '0', 1, 2),
(13, '2023-04-04', '0', '0', '0', '0', 'MRF-23-000013', '0', 1, 2),
(14, '2023-04-04', '0', '0', '0', '0', 'MRF-23-000014', '0', 1, 2),
(15, '2023-04-04', '0', '0', '0', '0', 'MRF-23-000015', '0', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_as_draft`
--

DROP TABLE IF EXISTS `item_as_draft`;
CREATE TABLE IF NOT EXISTS `item_as_draft` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(20) NOT NULL,
  `qty` varchar(10) NOT NULL,
  `oum` varchar(100) NOT NULL,
  `itemcode` varchar(100) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `color` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `user_id` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_as_draft`
--

INSERT INTO `item_as_draft` (`id`, `item_id`, `qty`, `oum`, `itemcode`, `brand`, `description`, `color`, `remarks`, `user_id`, `status`) VALUES
(1, 1, '123', '', 'dak', '', 'da', '', '', 1, 1),
(2, 1, '123', '', 'dad', '', 'da', '', '', 1, 1),
(3, 1, '312', '', 'ad', '', 'da', '', '', 1, 1),
(4, 1, '123', '', 'ada', '', 'da', '', '', 1, 0),
(5, 2, '123', '123', '21', '', '123231', '', '', 1, 1),
(6, 2, '123', 'a', '23', '', 'a', '', '', 1, 1),
(7, 2, '123', '231', 'a', '', '231', '', '', 1, 1),
(8, 2, '123', 'a', '123', '', 'a', '', '', 1, 1),
(9, 2, 'ad', 'ad', 'ad', '', 'v', '', '', 1, 1),
(10, 3, '', '', '', '', '', '', '', 1, 4),
(11, 3, '', '', '', '', '', '', '', 1, 4),
(12, 3, '', '', '', '', '', '', '', 1, 4),
(13, 3, '', '', '', '', '', '', '', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `item_description`
--

DROP TABLE IF EXISTS `item_description`;
CREATE TABLE IF NOT EXISTS `item_description` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(50) DEFAULT NULL,
  `qty` varchar(10) NOT NULL,
  `oum` varchar(100) NOT NULL,
  `itemcode` varchar(100) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `color` varchar(100) NOT NULL,
  `remarks` varchar(200) NOT NULL,
  `user_id` int(5) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_description`
--

INSERT INTO `item_description` (`id`, `item_id`, `qty`, `oum`, `itemcode`, `brand`, `description`, `color`, `remarks`, `user_id`, `status`) VALUES
(1, 1, '123', '', 'dak', '', 'da', '', '', 1, 1),
(2, 1, '123', '', 'dad', '', 'da', '', '', 1, 1),
(3, 1, '312', '', 'ad', '', 'da', '', '', 1, 1),
(4, 1, '123', '', 'ada', '', 'da', '', '', 1, 1),
(5, 2, '234', '', 'dh', '', 'hd', '', '', 1, 1),
(6, 2, '234', '', 'dhd', '', 'hdh', '', '', 1, 1),
(7, 2, '234', '', 'hd', '', 'dh', '', '', 1, 1),
(8, 2, '432', '', 'h', '', 'dh', '', '', 1, 1),
(9, 2, 'dh', 'd', 'hd', '', 'hd', '', '', 1, 1),
(10, 4, '123', '', 'dak', '', 'da', '', '', 1, 1),
(11, 4, '123', '', 'dad', '', 'da', '', '', 1, 1),
(12, 4, '312', '', 'ad', '', 'da', '', '', 1, 1),
(13, 4, '123', '', '', '', '', '', '', 1, 1),
(14, 4, '123', '', '', '', '', '', '', 1, 1),
(15, 5, '123', '123', '21', '', '123231', '', '', 1, 1),
(16, 5, '123', 'a', '23', '', 'a', '', '', 1, 1),
(17, 5, '123', '231', 'a', '', '231', '', '', 1, 1),
(18, 5, '123', 'a', '123', '', 'a', '', '', 1, 1),
(19, 5, 'ad', 'ad', 'ad', '', 'ad', '', '', 1, 1),
(20, 5, '', '', '', '', '', '', '', 1, 1),
(21, 6, '123', '123', '21', '', '123231', '', '', 1, 1),
(22, 6, '123', 'a', '23', '', 'a', '', '', 1, 1),
(23, 6, '123', '231', 'a', '', '231', '', '', 1, 1),
(24, 6, '123', 'a', '123', '', 'a', '', '', 1, 1),
(25, 6, 'ad', 'ad', 'ad', '', '', '', '', 1, 1),
(26, 7, '123', '123', '21', '', '123231', '', '', 1, 1),
(27, 7, '123', 'a', '23', '', 'a', '', '', 1, 1),
(28, 7, '123', '231', 'a', '', '231', '', '', 1, 1),
(29, 7, '123', 'a', '123', '', 'a', '', '', 1, 1),
(30, 7, 'ad', 'ad', 'ad', '', 'v', '', '', 1, 1),
(31, 8, '123', '123', '21', '', '123231', '', '', 1, 1),
(32, 8, '123', 'a', '23', '', 'a', '', '', 1, 1),
(33, 8, '123', '231', 'a', '', '231', '', '', 1, 1),
(34, 8, '123', 'a', '123', '', 'a', '', '', 1, 1),
(35, 8, 'ad', 'ad', 'ad', '', 'v', '', '', 1, 1),
(36, 8, '', '', '', '', '', '', '', 1, 1),
(37, 9, '123', '123', '21', '', '123231', '', '', 1, 1),
(38, 9, '123', 'a', '23', '', 'a', '', '', 1, 1),
(39, 9, '123', '231', 'a', '', '231', '', '', 1, 1),
(40, 9, '123', 'a', '123', '', 'a', '', '', 1, 1),
(41, 9, 'ad', 'ad', 'ad', '', 'v', '', '', 1, 1),
(42, 9, '', '', '', '', '', '', '', 1, 1),
(43, 10, '123', '123', '21', '', '123231', '', '', 1, 1),
(44, 10, '123', 'a', '23', '', 'a', '', '', 1, 1),
(45, 10, '123', '231', 'a', '', '231', '', '', 1, 1),
(46, 10, '123', 'a', '123', '', 'a', '', '', 1, 1),
(47, 10, 'ad', 'ad', 'ad', '', 'v', '', '', 1, 1),
(48, 10, '', '', '', '', '', '', '', 1, 1),
(49, 11, '123', '123', '21', '', '123231', '', '', 1, 1),
(50, 11, '123', 'a', '23', '', 'a', '', '', 1, 1),
(51, 11, '123', '231', 'a', '', '231', '', '', 1, 1),
(52, 11, '123', 'a', '123', '', 'a', '', '', 1, 1),
(53, 11, 'ad', 'ad', 'ad', '', 'v', '', '', 1, 1),
(54, 11, 'da', '', 'g', '', 'g', '', '', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Project` varchar(50) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `Project`, `status`) VALUES
(1, 'The Median', 1),
(2, 'The Median Flats', 1),
(3, 'One Montage', 1),
(4, 'Two Montage', 1),
(5, 'Altaire', 1),
(6, 'Danao Logistics Warehouse', 1),
(7, 'Altaire Office Suites', 1),
(8, 'Montage Office Suites', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_code`
--

DROP TABLE IF EXISTS `project_code`;
CREATE TABLE IF NOT EXISTS `project_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `proj_code` varchar(10) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_code`
--

INSERT INTO `project_code` (`id`, `proj_code`, `status`) VALUES
(1, 'PM1', 1),
(2, 'PM2', 1),
(3, 'PCL', 1),
(4, 'P2M', 1),
(5, 'PAL', 1),
(6, 'PDW', 1);

-- --------------------------------------------------------

--
-- Table structure for table `save_as_draft`
--

DROP TABLE IF EXISTS `save_as_draft`;
CREATE TABLE IF NOT EXISTS `save_as_draft` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` varchar(20) NOT NULL,
  `project` varchar(150) NOT NULL,
  `typeof_project` varchar(150) NOT NULL,
  `classification` varchar(150) NOT NULL,
  `sub_class` varchar(150) NOT NULL,
  `cip_account` varchar(200) NOT NULL,
  `user_id` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `save_as_draft`
--

INSERT INTO `save_as_draft` (`id`, `date_added`, `project`, `typeof_project`, `classification`, `sub_class`, `cip_account`, `user_id`, `status`) VALUES
(1, '2023-04-04', '1', '2', '3', 'test1', '12', 1, 1),
(2, '2023-04-04', '6', '2', '6', 'test', '12', 1, 1),
(3, '2023-04-04', '1', '1', '2', 'test', '1', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `type_of_project`
--

DROP TABLE IF EXISTS `type_of_project`;
CREATE TABLE IF NOT EXISTS `type_of_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project_type` varchar(100) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type_of_project`
--

INSERT INTO `type_of_project` (`id`, `project_type`, `status`) VALUES
(1, 'Commercial', 1),
(2, 'Condominium', 1),
(3, 'Townhouse', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(150) NOT NULL,
  `account_type` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `username`, `password`, `account_type`, `status`) VALUES
(1, 'Danilo', 'Medallo', 'danilo.medallo@innogroup.com.ph', 'danilo.medallo', 'e10adc3949ba59abbe56e057f20f883e', 3, 1),
(2, 'Danilo', 'Medallo', 'danilo.medallo@innogroup.com.ph', 'danilo.medallo', 'e10adc3949ba59abbe56e057f20f883e', 3, 1),
(3, 'Danilo', 'Medallo', 'danilo.medallo@innogroup.com.ph', 'danilo.medallo', 'ee62505cc6591e2429a725a06a563b90', 3, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
