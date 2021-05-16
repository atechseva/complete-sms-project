-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 16, 2021 at 01:45 PM
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
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  PRIMARY KEY (`s_no`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`s_no`, `admin_email`, `admin_password`) VALUES
(2, 'atechseva@gmail.com', '$2y$10$psUT3.nLfihYBli6raM13O3EcYOlvpNT94I7WG/40WPtIKackRPUq'),
(4, 'admin@gmail.com', '$2y$10$MB4iukq/v/Cv8d.aKgAyhOnAt1H8VZpizR8AMUrj6y8N4E0qZl9zu');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`branch_id`, `branch`, `address`, `detail`, `date`) VALUES
(2, 'Meerut', '195, Ganga Nagar Meerut', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2021-01-28 13:17:51'),
(3, 'Hapur', '259, Xyz Colony Hapur', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. ', '2021-01-28 13:18:55');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`notice_id`, `cource`, `notice_title`, `notice_description`, `date`) VALUES
(9, 'M.A', 'hvh', 'chgc', '2021-02-02 08:00:37'),
(13, 'MCA', 'Test Notice', 'Test Notice', '2021-04-04 13:10:39'),
(16, 'To All Students', 'All Student Notice', 'All Student Notice', '2021-04-05 13:59:53');

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
  `student_name` varchar(100) NOT NULL,
  `fathername` varchar(100) DEFAULT NULL,
  `mothername` varchar(100) DEFAULT NULL,
  `cource` varchar(100) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `student_email` varchar(255) NOT NULL,
  `student_password` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `dob` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`std_reg_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studentregister`
--

INSERT INTO `studentregister` (`std_reg_id`, `student_name`, `fathername`, `mothername`, `cource`, `img`, `student_email`, `student_password`, `phone`, `dob`, `gender`, `address`, `date`) VALUES
(15, 'akash kumar', '', '', 'M.A', 'images.png', 'demo@gmail.com', '$2y$10$lWrO5semP6ZHIuMJnG/.5eSLqnKJoDdEDgMv2W.nB4b2Fm/viRuPG', '07017742830', '2021-05-21', '', 'kaseru khera', '2021-05-16 11:40:10'),
(16, 'sagar', '', '', 'B.sc', 'gy.png', 'sagar@gmail.com', '$2y$10$gKaec2yp1V.Y9/k7.rzgCe51rdr3UHutYfa9Z9.S0tXTjOJoMVNiu', '', '2021-05-14', '', '', '2021-05-16 11:53:51'),
(17, 'mca', NULL, NULL, 'MCA', NULL, 'mca@gmail.com', '$2y$10$0Co15RfSO19JHWAd/.UOku795TTcjHEe4oYBqDkQsr6XERN3ym1q.', '', '2021-05-21', 'male', NULL, '2021-05-16 12:03:10');

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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `studymaterial`
--

INSERT INTO `studymaterial` (`study_mat_id`, `cource`, `description`, `pdf`, `date`) VALUES
(16, 'B.A', 'lk', '25th August MCA _New__First_Year_Syllabus_2020.pdf', '2021-01-31 09:41:13'),
(17, 'MCA', 'example', '26.png', '2021-02-01 14:00:54'),
(21, 'M.A', 'New Notice', '', '2021-05-16 11:42:21'),
(22, 'M.A', 'Welcome', '', '2021-05-16 11:51:14'),
(23, 'B.sc', 'Syllabus', '', '2021-05-16 11:53:12'),
(24, 'MCA', 'NEW MCA NOTICE\r\n\r\n', '', '2021-05-16 12:02:11');

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

DROP TABLE IF EXISTS `support`;
CREATE TABLE IF NOT EXISTS `support` (
  `support_id` int(255) NOT NULL AUTO_INCREMENT,
  `student_email` varchar(255) NOT NULL,
  `support` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`support_id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support`
--

INSERT INTO `support` (`support_id`, `student_email`, `support`, `date`) VALUES
(23, 'mca@gmail.com', '4 th support', '2021-05-16 13:30:32'),
(22, 'mca@gmail.com', '3rd support', '2021-05-16 13:28:14'),
(21, 'mca@gmail.com', 'MCA 2nd Support', '2021-05-16 13:24:28'),
(20, 'mca@gmail.com', 'New Query MCA', '2021-05-16 13:20:41'),
(19, 'mca@gmail.com', 'MCA support need ', '2021-05-16 13:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `support_answer`
--

DROP TABLE IF EXISTS `support_answer`;
CREATE TABLE IF NOT EXISTS `support_answer` (
  `answer_id` int(255) NOT NULL AUTO_INCREMENT,
  `support_id` int(255) NOT NULL,
  `student_email` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`answer_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `support_answer`
--

INSERT INTO `support_answer` (`answer_id`, `support_id`, `student_email`, `answer`, `date`) VALUES
(1, 10, 'mca@gmail.com', 'My answer to support id 10', '2021-05-16 13:43:47'),
(2, 19, 'mca@gmail.com', 'Hy all resolve', '2021-05-16 13:43:47'),
(3, 21, 'mca@gmail.com', 'MCA 2nd Support Answer', '2021-05-16 13:43:47'),
(4, 20, 'mca@gmail.com', 'New Query MCA Answer', '2021-05-16 13:43:47'),
(5, 22, 'mca@gmail.com', '3rd support answer', '2021-05-16 13:43:47'),
(6, 23, 'mca@gmail.com', '4 th support answer', '2021-05-16 13:43:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
