-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2017 at 10:44 PM
-- Server version: 5.5.54-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Haizahn`
--
CREATE DATABASE IF NOT EXISTS `Haizahn` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `Haizahn`;

-- --------------------------------------------------------

--
-- Table structure for table `Bookmark`
--

DROP TABLE IF EXISTS `Bookmark`;
CREATE TABLE IF NOT EXISTS `Bookmark` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Title` varchar(100) NOT NULL,
  `Url` varchar(500) NOT NULL,
  `User_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Url` (`Url`,`User_Id`),
  UNIQUE KEY `Title` (`Title`,`User_Id`),
  KEY `User_Id` (`User_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Bookmark_Tag`
--

DROP TABLE IF EXISTS `Bookmark_Tag`;
CREATE TABLE IF NOT EXISTS `Bookmark_Tag` (
  `Bookmark_Id` int(11) NOT NULL,
  `Tag_Id` int(11) NOT NULL,
  KEY `Bookmark_Tag` (`Bookmark_Id`,`Tag_Id`),
  KEY `Bookmark_Id` (`Bookmark_Id`),
  KEY `Tag_Id` (`Tag_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Tag`
--

DROP TABLE IF EXISTS `Tag`;
CREATE TABLE IF NOT EXISTS `Tag` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Text` varchar(50) NOT NULL,
  `User_Id` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Text_User` (`Text`,`User_Id`),
  KEY `User_Id` (`User_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
CREATE TABLE IF NOT EXISTS `User` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Name` (`Name`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Bookmark`
--
ALTER TABLE `Bookmark`
  ADD CONSTRAINT `Bookmark_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `Bookmark_Tag`
--
ALTER TABLE `Bookmark_Tag`
  ADD CONSTRAINT `Bookmark_Tag_ibfk_2` FOREIGN KEY (`Tag_Id`) REFERENCES `Tag` (`Id`),
  ADD CONSTRAINT `Bookmark_Tag_ibfk_1` FOREIGN KEY (`Bookmark_Id`) REFERENCES `Bookmark` (`Id`);

--
-- Constraints for table `Tag`
--
ALTER TABLE `Tag`
  ADD CONSTRAINT `Tag_ibfk_1` FOREIGN KEY (`User_Id`) REFERENCES `User` (`Id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
