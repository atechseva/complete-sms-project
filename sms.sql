-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2021 at 07:04 AM
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
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

DROP TABLE IF EXISTS `adminlogin`;
CREATE TABLE IF NOT EXISTS `adminlogin` (
  `s_no` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`s_no`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`s_no`, `name`, `email`, `password`) VALUES
(1, 'admin', 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
CREATE TABLE IF NOT EXISTS `branch` (
  `branch_id` int(255) NOT NULL AUTO_INCREMENT,
  `branch` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`branch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch`, `address`, `detail`, `date`) VALUES
(2, 'Meerut', '195, Ganga Nagar Meerut', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2021-01-28 13:17:51'),
(3, 'Hapur', '259, Xyz Colony Hapur', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2021-01-28 13:18:55');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(100) NOT NULL AUTO_INCREMENT,
  `class` varchar(100) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `class`) VALUES
(1, '1st'),
(2, '2nd'),
(3, '3rd'),
(4, '4th'),
(5, '5th'),
(6, '6th');

-- --------------------------------------------------------

--
-- Table structure for table `cource`
--

DROP TABLE IF EXISTS `cource`;
CREATE TABLE IF NOT EXISTS `cource` (
  `cource_id` int(100) NOT NULL AUTO_INCREMENT,
  `cource` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cource_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cource`
--

INSERT INTO `cource` (`cource_id`, `cource`, `date`) VALUES
(1, 'B.A', '2021-01-28 07:24:59'),
(2, 'M.A', '2021-01-28 07:25:08'),
(3, 'B.com', '2021-01-28 07:25:12'),
(4, 'M.com', '2021-01-28 07:25:16'),
(5, 'B.sc', '2021-01-28 07:25:25'),
(6, 'BCA', '2021-01-28 07:25:35'),
(7, 'MCA', '2021-01-28 07:25:43');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `notice_id` int(100) NOT NULL AUTO_INCREMENT,
  `cource` varchar(100) NOT NULL,
  `notice_title` varchar(100) NOT NULL,
  `notice_description` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `cource`, `notice_title`, `notice_description`, `date`) VALUES
(8, 'To All', 'fx', 'hfhv', '2021-02-02 08:00:30'),
(9, 'M.A', 'hvh', 'chgc', '2021-02-02 08:00:37'),
(11, 'MCA', 'knoknon', 'injnjn', '2021-02-08 14:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
CREATE TABLE IF NOT EXISTS `options` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `question_number` int(255) NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `coption` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `question_number` int(255) NOT NULL AUTO_INCREMENT,
  `question_text` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`question_number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

DROP TABLE IF EXISTS `result`;
CREATE TABLE IF NOT EXISTS `result` (
  `s_no` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cource` varchar(30) NOT NULL,
  `p1` int(3) NOT NULL,
  `p2` int(3) NOT NULL,
  `p3` int(3) NOT NULL,
  `p4` int(3) NOT NULL,
  `p5` int(3) NOT NULL,
  `p6` int(3) NOT NULL,
  `str_reg_id` int(100) NOT NULL,
  `marks` int(3) NOT NULL,
  `percentage` float NOT NULL,
  PRIMARY KEY (`s_no`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`s_no`, `name`, `email`, `cource`, `p1`, `p2`, `p3`, `p4`, `p5`, `p6`, `str_reg_id`, `marks`, `percentage`) VALUES
(3, '', '', '', 55, 55, 11, 78, 15, 0, 29, 214, 35.6667),
(5, '', '', 'M.A', 6, 161, 11, 5, 51, 0, 6, 234, 39),
(6, '', '', '', 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `studentregister`
--

DROP TABLE IF EXISTS `studentregister`;
CREATE TABLE IF NOT EXISTS `studentregister` (
  `std_reg_id` int(100) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `fathername` varchar(100) NOT NULL,
  `mothername` varchar(100) NOT NULL,
  `cource` varchar(100) NOT NULL,
  `img` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`std_reg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentregister`
--

INSERT INTO `studentregister` (`std_reg_id`, `name`, `fathername`, `mothername`, `cource`, `img`, `email`, `password`, `phone`, `dob`, `gender`, `address`, `date`) VALUES
(27, 'khushi', 'bablu kumar', 'soniya', 'B.A', '1.jpg', 'khushi@gmail.com', 'khushi', '9634345525', '2021-01-05', 'female', 'xyz', '0000-00-00 00:00:00'),
(29, 'sagar kumar', 'ramesh kumar', 'radha', 'MCA', 'IMG20201222183744.jpg', 'sagar@gmail.com', 'sagar', '9634345525', '2000-09-10', 'male', '183, kaseru khera meerut', '2021-01-30 15:17:47');

-- --------------------------------------------------------

--
-- Table structure for table `studymaterial`
--

DROP TABLE IF EXISTS `studymaterial`;
CREATE TABLE IF NOT EXISTS `studymaterial` (
  `study_mat_id` int(255) NOT NULL AUTO_INCREMENT,
  `cource` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `pdf` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`study_mat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studymaterial`
--

INSERT INTO `studymaterial` (`study_mat_id`, `cource`, `description`, `pdf`, `date`) VALUES
(16, 'B.A', 'lk', '25th August MCA _New__First_Year_Syllabus_2020.pdf', '2021-01-31 09:41:13'),
(17, 'MCA', 'example', '26.png', '2021-02-01 14:00:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
