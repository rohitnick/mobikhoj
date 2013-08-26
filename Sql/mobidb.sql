-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2012 at 07:59 AM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mobidb`
--

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `uid` int(7) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(30) NOT NULL,
  `signUpTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`email`),
  UNIQUE KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=74 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`uid`, `email`, `password`, `name`, `signUpTime`) VALUES
(72, 'rohit', '83d5e1e49bd5f0ebbf6c9ba40416057fac1b5d76', 'Rohit Agarwal', '2012-04-06 01:07:43'),
(73, 'nitish', '1cab521f47ea6f5764db209638c5179b45f257a3', 'nitish bansal', '2012-04-07 12:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `mid` int(9) NOT NULL AUTO_INCREMENT,
  `unumber` varchar(40) NOT NULL,
  `message` varchar(800) NOT NULL,
  `mtype` int(2) NOT NULL,
  `moderator` varchar(20) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`mid`, `unumber`, `message`, `mtype`, `moderator`, `time`) VALUES
(4, '9543262164', 'hey this is the first question of mobikhoj .... so what does mobikhoj mean ???', 0, '0', '2012-04-06 22:55:53'),
(5, '9543262164', 'how can i use this service ?? do i have to pay u anything ??', 0, '0', '2012-04-06 22:56:49'),
(7, '8124005902', 'what is the cheapest price online for samsung galaxy android enabled model ??', 0, '0', '2012-04-06 23:48:14'),
(10, '9790109891', 'the quick brown fox jumps over the lazy dog', 1, 'rohit', '2012-04-07 12:41:03'),
(11, '9790109891', 'Who jumps over the lazy dog??', 0, '0', '2012-04-07 12:42:09'),
(12, '9543262164', 'the quick brown fox jumps over the', 1, 'rohit', '2012-04-07 12:43:36'),
(13, '9790123456', 'The territory of Porus who offered strong resistance to Alexander was situated between the rivers of', 0, '0', '2012-04-07 12:53:54'),
(14, '9790123456', '	Jhelum and Chenab', 1, 'nitish', '2012-04-07 12:54:19'),
(15, '9790123456', 'military affairs', 1, 'nitish', '2012-04-07 12:54:51'),
(16, '9790109891', 'Tripitakas are sacred books of', 0, '0', '2012-04-07 12:55:14'),
(17, '9790109891', '	Buddhists', 1, 'rohit', '2012-04-07 12:55:35'),
(18, '9543262164', '	\r\n\r\nThe trident-shaped symbol of Buddhism does not represent', 0, '0', '2012-04-07 12:56:25'),
(19, '9543262164', '	Nirvana', 1, 'nitish', '2012-04-07 12:56:51'),
(20, '9543262164', 'just send a sms..we will answer to u queries..no u need nt pay anything', 1, 'nitish', '2012-04-07 12:59:19');
