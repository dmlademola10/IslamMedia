-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 05:12 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `islammedia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Feb 28, 2022 at 04:08 AM
-- Last update: Feb 28, 2022 at 04:11 AM
--

CREATE TABLE IF NOT EXISTS `users` (
  `userID` int(40) NOT NULL AUTO_INCREMENT,
  `userName` varchar(255) NOT NULL,
  `passWord` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `surName` varchar(255) NOT NULL,
  `otherName` varchar(255) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephoneNumber` varchar(255) NOT NULL,
  `maritalStatus` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `placeOfWork` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `about` varchar(255) NOT NULL,
  `lifeMoments` varchar(255) NOT NULL,
  `dateJoined` date NOT NULL DEFAULT current_timestamp(),
  `userType` varchar(255) NOT NULL DEFAULT 'user',
  `mailVerified` varchar(255) NOT NULL,
  `online` varchar(40) NOT NULL,
  `suspended` varchar(255) NOT NULL,
  `darkMode` varchar(255) NOT NULL,
  `profPicDate` varchar(255) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE KEY `userName` (`userName`),
  UNIQUE KEY `telephoneNumber` (`telephoneNumber`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `users`:
--
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
