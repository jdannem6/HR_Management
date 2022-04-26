-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 25, 2022 at 04:14 PM
-- Server version: 10.5.4-MariaDB
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hrmanagement`
--
CREATE DATABASE IF NOT EXISTS `hrmanagement` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hrmanagement`;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--
CREATE TABLE IF NOT EXISTS `department` (
  `dept_name` varchar(20) NOT NULL,
  `budget` numeric(12,2) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `building` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_name`, `budget`, `phone`, `building`) VALUES
('comp', 1000000.00, 23434234, 'csi'),
('econ', 6000000.55, 23434234, 'csi'),
('math', 420401.00, 23434234, 'csi');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `emp_id` int(12) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `dept_name` varchar(20) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `salary` numeric(9,2) DEFAULT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`emp_id`),
  FOREIGN KEY (`dept_name`) references department(`dept_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `name`, `dept_name`, `phone`, `email`, `salary`, `start_date`) VALUES
(3, 'thang3', 'math',  23434234, 'dfsjdlf', 95000.00, '2018-05-01 13:07:24'),
(5, 'thang1', 'comp',  23434234, 'dfsjdlf', 120000.50, '2018-05-01 13:07:24'),
(7, 'thang2', 'econ',  23434234, 'dfsjdlf', 64000.99, '2018-05-01 13:07:24');


-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

DROP TABLE IF EXISTS `manager`;
CREATE TABLE IF NOT EXISTS `manager` (
  `manager_id` int(6) NOT NULL,
  `name` varchar(30) DEFAULT NULL,
  `phone` int(10) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `name`, `phone`, `email`) VALUES
(567891, 'Javis', 23434234, 'qefej9'),
(567898, 'Thana', 23434234, 'qefej10*'),
(567890, 'Zuoc', 23434234, 'qefej9*');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--


-- --------------------------------------------------------

--
-- Table structure for table `emp_team`
--

-- Adding Auto Increment constraints for manager_id and emp_d
--
ALTER TABLE `employee` -- emp_id autoincremented by 17 with every new tuple
  MODIFY `emp_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

-- manager_id autoincremented by 17 with every new tuple
ALTER TABLE `manager`
  MODIFY `manager_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
-- Constraints for dumped tables
--



CREATE TABLE IF NOT EXISTS `team` (
  `team_name` varchar(30) NOT NULL,
  `manager_id` int(6) DEFAULT NULL,
  `total_members` int(6) DEFAULT NULL,
  PRIMARY KEY (`team_name`),
  foreign key (`manager_id`) references manager(`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`team_name`, `manager_id`, `total_members`) VALUES
('JS', 567891, 1),
('PYTHON', 567898, 1),
('PHP', 567890, 1);




DROP TABLE IF EXISTS `emp_team`;
CREATE TABLE IF NOT EXISTS `emp_team` (
  `emp_id` int(12) DEFAULT NULL,
  `team_name` varchar(30) DEFAULT NULL,
  foreign key (`emp_id`) references employee(`emp_id`),
  foreign key (`team_name`) references team(`team_name`),
  PRIMARY KEY (`emp_id`, `team_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




