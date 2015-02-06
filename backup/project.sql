-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2015 at 02:59 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `project_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `closed` char(1) NOT NULL DEFAULT 'N',
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`idx`, `name`, `insert_date`, `closed`) VALUES
(1, '오웬스코닝', '2014-11-14 02:19:27', 'N'),
(3, '고캐쉬백', '2014-11-13 21:32:07', 'N'),
(5, '테스트 프로젝트', '2015-02-06 01:38:36', 'Y');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
