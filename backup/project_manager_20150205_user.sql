-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2015 at 07:56 AM
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
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `project_idx` int(11) NOT NULL,
  `parent_idx` int(11) DEFAULT '0',
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`idx`, `name`, `slug`, `project_idx`, `parent_idx`, `insert_date`) VALUES
(1, '인클루드', 'Include', 1, 0, '2014-11-14 04:02:29'),
(2, '메인', 'main', 1, 0, '2014-11-14 04:20:00'),
(3, '지붕시스템', 'roof_system', 1, 0, '2014-11-14 04:23:32'),
(4, '제품 안내', 'product_guide', 1, 3, '2014-11-14 05:22:33'),
(5, '지붕상식', 'roof_basic', 1, 3, '2014-11-14 05:30:14');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE IF NOT EXISTS `page` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(255) NOT NULL,
  `name` varchar(50) NOT NULL,
  `state` tinyint(4) NOT NULL DEFAULT '0',
  `description` varchar(255) NOT NULL,
  `project_idx` int(11) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finish_date` date DEFAULT NULL,
  `category_idx` int(11) DEFAULT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`idx`, `link`, `name`, `state`, `description`, `project_idx`, `insert_date`, `finish_date`, `category_idx`) VALUES
(1, 'http://ow.tendency.kr/new/inc/footer.asp', 'footer.asp하단 공통 페이지 ', 4, '여기는 상세설명', 1, '2014-11-12 15:00:00', NULL, 1),
(2, 'http://ow.tendency.kr/new/inc/header.asp', '헤더', 0, '상단 공통 파일', 1, '2014-11-13 23:34:26', NULL, 1),
(3, 'http://ow.tendency.kr/new/product/roof/product_guide.asp', '제품 안내', 0, '디자인: 탭 이미지 hover 레이어 필요', 1, '2014-11-13 23:39:08', NULL, 4);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`idx`, `name`, `insert_date`) VALUES
(1, '오웬스코닝', '2014-11-14 02:19:27'),
(3, '고캐쉬백', '2014-11-13 21:32:07');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `project_idx` int(11) NOT NULL,
  `page_idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `receiver_idx` int(11) NOT NULL,
  `status` int(2) NOT NULL DEFAULT '1' COMMENT '상태값 1.진행 2. 완료 3.삭제',
  `due_date` date NOT NULL,
  `title` varchar(255) NOT NULL,
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `finish_date` date NOT NULL,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `level` int(2) NOT NULL,
  `password` varchar(50) NOT NULL,
  `team` varchar(20) DEFAULT NULL COMMENT '소속팀명',
  `insert_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idx`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`idx`, `id`, `name`, `level`, `password`, `team`, `insert_date`) VALUES
(1, 'guruahn', '안정우', 0, '9c4d61ec636053f7c6d32cd5f71f537178571c8a', '개발팀', '2014-11-14 02:30:54'),
(2, 'heo02602', '허영은', 3, 'ca81be983f223a108b09e0cd1690a34a97ddabc4', '개발팀', '2015-02-05 05:21:24'),
(7, 'test3', 'test3', 3, '61f5fe8de4b93f81b3e081c10ce4d5421cfa0380', 'test3', '2015-02-05 06:30:30'),
(8, '11', '11', 2, 'be863a8c9989bf83e35bb6e0a6cb3d05e020a411', '11', '2015-02-05 06:30:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
