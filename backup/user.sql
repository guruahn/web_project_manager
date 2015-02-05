-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2015 at 09:56 AM
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
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  `level` int(2) NOT NULL,
  `password` varchar(50) NOT NULL,
  `team` varchar(20) DEFAULT NULL COMMENT '소속팀명',
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idx`, `id`, `name`, `level`, `password`, `team`, `insert_date`) VALUES
(1, 'guruahn', '안정우', 0, '9c4d61ec636053f7c6d32cd5f71f537178571c8a', '개발팀', '2014-11-14 02:30:54'),
(2, 'erin@tendency.co.kr', '허영은', 3, 'ed2ac911453d5444d81e98f83197e002e702e4c4', '개발팀', '2015-02-05 08:16:49'),
(7, 'test3', 'test3', 3, '61f5fe8de4b93f81b3e081c10ce4d5421cfa0380', 'test3', '2015-02-05 06:30:30'),
(8, '11', '11', 2, 'be863a8c9989bf83e35bb6e0a6cb3d05e020a411', '11', '2015-02-05 06:30:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
