-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2020 at 10:42 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `judgesystem`
--
CREATE DATABASE IF NOT EXISTS `judgesystem` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `judgesystem`;

-- --------------------------------------------------------

--
-- Table structure for table `problems`
--

CREATE TABLE `problems` (
  `prob_id` int(5) NOT NULL,
  `prob_name` varchar(50) NOT NULL,
  `score` int(3) NOT NULL,
  `difficulty` varchar(10) NOT NULL,
  `acceptance` decimal(10,0) NOT NULL DEFAULT 0,
  `attempts` mediumint(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `problems`
--

INSERT INTO `problems` (`prob_id`, `prob_name`, `score`, `difficulty`, `acceptance`, `attempts`) VALUES
(19, 'Balanced Brackets', 30, 'Medium', '0', 20);

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--

CREATE TABLE `profile` (
  `UID` int(5) NOT NULL,
  `User_type` varchar(5) NOT NULL DEFAULT 'norm',
  `Name` varchar(35) NOT NULL,
  `Mob_no` bigint(10) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `pwd` varchar(8) NOT NULL,
  `score` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`UID`, `User_type`, `Name`, `Mob_no`, `Email`, `Username`, `pwd`, `score`) VALUES
(25, 'admin', 'admin', 9876543210, 'admin@admin.com', 'admin', 'admin', 0),
(26, 'norm', 'test1', 9988776655, 'test1@mail.com', 'test1', '12345678', 0);

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `SUB_ID` int(10) NOT NULL,
  `prob_id` int(5) NOT NULL,
  `UID` int(5) NOT NULL,
  `prob_name` varchar(50) NOT NULL,
  `Language` varchar(8) NOT NULL,
  `sub_time` datetime NOT NULL DEFAULT current_timestamp(),
  `run_time` double DEFAULT NULL,
  `memory` varchar(6) DEFAULT NULL,
  `result` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `problems`
--
ALTER TABLE `problems`
  ADD PRIMARY KEY (`prob_id`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`UID`),
  ADD UNIQUE KEY `Mobile no` (`Mob_no`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`SUB_ID`),
  ADD KEY `prob_id` (`prob_id`),
  ADD KEY `UID` (`UID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `problems`
--
ALTER TABLE `problems`
  MODIFY `prob_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
  MODIFY `UID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `SUB_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=138;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `submissions`
--
ALTER TABLE `submissions`
  ADD CONSTRAINT `submissions_ibfk_1` FOREIGN KEY (`prob_id`) REFERENCES `problems` (`prob_id`),
  ADD CONSTRAINT `submissions_ibfk_2` FOREIGN KEY (`UID`) REFERENCES `profile` (`UID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
