-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 28, 2021 at 12:32 AM
-- Server version: 5.7.33-cll-lve
-- PHP Version: 7.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onethree_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `isbn` varchar(30) NOT NULL,
  `title` varchar(30) NOT NULL,
  `author` varchar(30) NOT NULL,
  `publisher` varchar(30) NOT NULL,
  `genre` varchar(30) NOT NULL,
  `date_published` date NOT NULL,
  `status` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `isbn`, `title`, `author`, `publisher`, `genre`, `date_published`, `status`, `quantity`, `date_added`) VALUES
(2, '3245235552', 'database', 'Talha Noel', 'Chicago Defender', 'Novel', '2021-04-07', 'available', 1, '2021-04-11'),
(122, '12345623423', 'map', 'Judah Adams', 'Playground Maps', 'Reference', '2021-04-01', 'available', 1, '2021-04-02'),
(12346, '12', '12', '12', '12', '12', '2021-02-09', 'available', 2, '2021-03-01'),
(123, '10121345678', 'Here\'s A Quick Way To Solve Th', 'Kimora Charlton', 'Western Mule', 'Self Help', '2020-12-16', 'available', 1, '2021-04-03'),
(12349, '1234', '123', '123', '123', '123', '2021-04-07', 'available', 3, '2021-01-04'),
(125, '2342342532', 'The Easy Way', 'Kara Wade', 'Amelia Islander ', 'Novel', '2020-09-16', 'available', 1, '2021-04-07'),
(34, '21331233', 'Benjamin Franklin', 'Joseph Priestley', 'Nabu Press', 'Biography', '2020-10-13', 'available', 1, '2021-04-21'),
(12359, '123123123', 'New Book', 'Author', 'Publisher', 'Genre', '2021-03-10', 'available', 3, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `borrow`
--

CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL,
  `cardnumber` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `date_issued` date NOT NULL,
  `date_due` date NOT NULL,
  `date_returned` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `borrow`
--

INSERT INTO `borrow` (`borrow_id`, `cardnumber`, `id`, `type`, `date_issued`, `date_due`, `date_returned`) VALUES
(45, 11111, 12345, 'book', '2021-04-18', '2021-05-02', '2021-04-18'),
(46, 11111, 12345, 'book', '2021-04-01', '2021-04-15', '2021-04-20'),
(47, 11111, 51342, 'media', '2021-04-18', '2021-05-02', '2021-04-18'),
(48, 11111, 51342, 'media', '2021-04-18', '2021-05-02', '2021-04-18'),
(49, 11111, 51342, 'media', '2021-04-18', '2021-05-02', '2021-04-18'),
(50, 11111, 51342, 'media', '2021-04-18', '2021-05-02', '2021-04-18'),
(51, 11111, 7, 'device', '2021-04-18', '2021-05-02', '2021-04-18'),
(52, 11111, 7, 'device', '2021-04-18', '2021-05-02', '2021-04-18'),
(53, 11111, 51342, 'media', '2021-04-18', '2021-05-02', '2021-04-18'),
(54, 11111, 7, 'device', '2021-04-18', '2021-05-02', '2021-04-18'),
(55, 11111, 87465, 'journal', '2021-04-18', '2021-05-02', '2021-04-18'),
(56, 11111, 51342, 'media', '2021-04-18', '2021-05-02', '2021-04-18'),
(57, 11111, 12346, 'book', '2021-04-18', '2021-05-02', '2021-04-18'),
(58, 11111, 7, 'device', '2021-04-18', '2021-05-02', '2021-04-18'),
(59, 22222, 7, 'device', '2021-04-05', '2021-05-02', '2021-04-18'),
(60, 22222, 51342, 'media', '2021-04-18', '2021-05-08', '2021-04-18'),
(61, 11111, 7, 'device', '2021-04-18', '2021-05-02', '2021-04-18'),
(62, 22222, 12346, 'book', '2021-04-18', '2021-05-08', '2021-04-18'),
(63, 22222, 87465, 'journal', '2021-04-18', '2021-05-08', '2021-04-18'),
(12, 42071, 2, 'book', '2021-03-02', '2021-03-16', '0000-00-00'),
(11, 3333, 122, 'book', '2021-04-01', '2021-04-15', '0000-00-00'),
(13, 456790, 7, 'device', '2021-04-01', '2021-04-16', '0000-00-00'),
(14, 456789, 87465, 'journal', '2021-04-02', '2021-04-16', '0000-00-00'),
(15, 456790, 51342, 'media', '2021-03-16', '2021-03-30', '0000-00-00'),
(64, 11111, 2, 'book', '2021-04-18', '2021-05-08', '2021-04-18'),
(17, 456791, 123, 'book', '2021-03-23', '2021-04-06', '0000-00-00'),
(65, 11111, 2, 'book', '2021-04-18', '2021-05-08', '2021-04-18'),
(66, 11111, 1, 'book', '2021-04-18', '2021-05-08', '2021-04-18'),
(67, 11111, 12346, 'book', '2021-04-18', '2021-05-08', '2021-04-18'),
(68, 11111, 87465, 'journal', '2021-04-18', '2021-05-08', '2021-04-18'),
(69, 22222, 7, 'device', '2021-04-18', '2021-05-02', '2021-04-18'),
(70, 22222, 7, 'device', '2021-04-18', '2021-05-08', '2021-04-18'),
(18, 456791, 101, 'device', '2021-04-05', '2021-04-19', '0000-00-00'),
(71, 22222, 7, 'device', '2021-04-18', '2021-05-08', '2021-04-18'),
(72, 22222, 7, 'device', '2021-04-18', '2021-05-02', '2021-04-18'),
(73, 11111, 7, 'device', '2021-04-18', '2021-05-08', '2021-04-18'),
(74, 22222, 7, 'device', '2021-04-18', '2021-05-02', '2021-04-18'),
(75, 11111, 7, 'device', '2021-04-18', '2021-05-08', '2021-04-18'),
(76, 11111, 7, 'device', '2021-04-18', '2021-05-08', '2021-04-18'),
(77, 11111, 7, 'device', '2021-04-18', '2021-05-08', '2021-04-18'),
(78, 22222, 7, 'device', '2021-04-18', '2021-05-08', '2021-04-18'),
(79, 11111, 7, 'device', '2021-04-18', '2021-05-08', '2021-04-18'),
(80, 11111, 7, 'device', '2021-04-19', '2021-05-09', '2021-04-19'),
(81, 11111, 51342, 'media', '2021-04-19', '2021-05-09', '2021-04-19'),
(82, 3333, 7, 'device', '2021-04-19', '2021-05-03', '2021-04-19'),
(83, 11111, 7, 'device', '2021-04-19', '2021-05-03', '2021-04-19'),
(84, 3333, 7, 'device', '2021-04-19', '2021-05-03', '2021-04-19'),
(85, 3333, 12346, 'book', '2021-04-19', '2021-05-03', '2021-04-19'),
(86, 22222, 12346, 'book', '2021-04-19', '2021-05-09', '2021-04-19'),
(87, 3333, 12346, 'book', '2021-04-19', '2021-05-03', '2021-04-19'),
(88, 3333, 12346, 'book', '2021-04-19', '2021-05-03', '2021-04-19'),
(89, 3333, 12346, 'book', '2021-04-19', '2021-05-09', '2021-04-19'),
(90, 11111, 12346, 'book', '2021-04-19', '2021-05-09', '2021-04-19'),
(91, 3333, 12346, 'book', '2021-04-19', '2021-05-03', '2021-04-20'),
(92, 3333, 1, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(93, 3333, 2, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(94, 3333, 12349, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(95, 3333, 1, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(96, 3333, 12346, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(97, 3333, 51342, 'media', '2021-04-20', '2021-05-04', '2021-04-20'),
(98, 3333, 1, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(99, 3333, 78653, 'device', '2021-04-20', '2021-05-04', '2021-04-20'),
(100, 3333, 7, 'device', '2021-04-20', '2021-05-04', '2021-04-20'),
(101, 3333, 7, 'device', '2021-04-20', '2021-05-04', '2021-04-20'),
(102, 42071, 7, 'device', '2021-04-20', '2021-05-04', '2021-04-20'),
(103, 3333, 12345, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(104, 3333, 7, 'device', '2021-04-20', '2021-05-04', '2021-04-20'),
(105, 3333, 12345, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(16, 456790, 125, 'book', '2021-03-31', '2021-04-14', '0000-00-00'),
(20, 3333, 100, 'device', '2021-04-01', '2021-04-15', '0000-00-00'),
(106, 3333, 2, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(107, 3333, 2, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(108, 3333, 122, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(121, 22222, 2, 'book', '2021-04-21', '2021-05-11', '2021-04-21'),
(109, 3333, 2, 'book', '2021-04-20', '2021-05-04', '2021-04-20'),
(110, 456790, 12346, 'book', '2021-04-20', '2021-05-10', '2021-04-20'),
(111, 456790, 12349, 'book', '2021-04-20', '2021-05-10', '2021-04-20'),
(112, 456790, 87465, 'journal', '2021-04-20', '2021-05-10', '2021-04-20'),
(113, 456790, 7, 'device', '2021-04-20', '2021-05-10', '2021-04-20'),
(114, 456790, 12346, 'book', '2021-04-20', '2021-05-10', '2021-04-20'),
(115, 456790, 87466, 'journal', '2021-04-20', '2021-05-10', '2021-04-20'),
(116, 456790, 12346, 'book', '2021-04-20', '2021-05-10', '2021-04-20'),
(117, 11111, 12349, 'book', '2021-04-20', '2021-05-10', '2021-04-20'),
(118, 11111, 100, 'device', '2021-04-20', '2021-05-10', '2021-04-20'),
(119, 22222, 2, 'book', '2021-04-21', '2021-05-11', '2021-04-21'),
(120, 22222, 87466, 'journal', '2021-04-21', '2021-05-11', '2021-04-21'),
(122, 22222, 51342, 'media', '2021-04-21', '2021-05-11', '2021-04-21'),
(123, 22222, 2, 'book', '2021-04-21', '2021-05-11', '2021-04-21'),
(124, 3333, 78653, 'device', '2021-04-21', '2021-05-05', '2021-04-22'),
(125, 456791, 78653, 'device', '2021-04-21', '2021-05-05', '2021-04-21'),
(126, 456791, 34, 'book', '2021-04-21', '2021-05-05', '2021-04-21'),
(127, 11111, 34, 'book', '2021-04-21', '2021-05-05', '2021-04-21'),
(128, 11111, 34, 'book', '2021-04-21', '2021-05-11', '2021-04-21'),
(129, 22222, 34, 'book', '2021-04-21', '2021-05-05', '2021-04-21'),
(130, 11111, 34, 'book', '2021-04-21', '2021-05-05', '2021-04-21'),
(131, 22222, 12346, 'book', '2021-04-22', '2021-05-12', '2021-04-22'),
(132, 11111, 51342, 'media', '2021-04-22', '2021-05-12', '2021-04-22'),
(133, 22222, 2, 'book', '2021-04-22', '2021-05-12', '2021-04-22'),
(134, 22222, 2, 'book', '2021-04-22', '2021-05-12', '2021-04-22'),
(135, 22222, 2, 'book', '2021-04-22', '2021-05-12', '2021-04-22'),
(136, 11111, 122, 'book', '2021-04-22', '2021-05-12', '2021-04-22'),
(137, 11111, 87465, 'journal', '2021-04-22', '2021-05-12', '2021-04-22'),
(138, 11111, 2, 'book', '2021-04-22', '2021-05-06', '2021-04-22'),
(139, 22222, 2, 'book', '2021-04-22', '2021-05-12', '2021-04-23'),
(140, 11111, 122, 'book', '2021-04-22', '2021-05-12', '2021-04-22'),
(141, 11111, 101, 'device', '2021-04-22', '2021-05-12', '2021-04-22'),
(142, 22222, 2, 'book', '2021-04-24', '2021-05-14', '2021-04-25'),
(143, 22222, 12349, 'book', '2021-04-24', '2021-05-14', '2021-04-24'),
(144, 11111, 122, 'book', '2021-04-24', '2021-05-14', '2021-04-25'),
(175, 22222, 2, 'book', '2021-04-27', '2021-05-11', '2021-04-27'),
(160, 11111, 51342, 'media', '2021-04-25', '2021-05-15', '2021-04-25'),
(173, 11111, 2, 'book', '2021-04-26', '2021-05-16', '2021-04-27'),
(170, 11111, 2, 'book', '2021-04-25', '2021-05-15', '2021-04-25'),
(171, 11111, 2, 'book', '2021-04-26', '2021-05-16', '2021-04-26'),
(172, 22222, 2, 'book', '2021-04-26', '2021-05-10', '2021-04-26'),
(169, 11111, 2, 'book', '2021-04-25', '2021-05-15', '2021-04-25'),
(174, 22222, 122, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(176, 22222, 122, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(177, 22222, 12346, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(178, 22222, 123, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(179, 22222, 125, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(180, 22222, 12349, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(181, 22222, 125, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(182, 11111, 2, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(183, 22222, 12346, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(184, 11111, 2, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(185, 22222, 123, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(186, 22222, 12349, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(187, 22222, 12346, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(188, 22222, 12346, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(189, 11111, 2, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(190, 11111, 122, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(191, 11111, 12346, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(192, 11111, 123, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(193, 11111, 12349, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(194, 11111, 2, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(195, 22222, 2, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(196, 22222, 12349, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(197, 22222, 87466, 'journal', '2021-04-27', '2021-05-17', '2021-04-27'),
(198, 22222, 2, 'book', '2021-04-27', '2021-05-17', '2021-04-27'),
(199, 22222, 2, 'book', '2021-04-27', '2021-05-11', '2021-04-27'),
(200, 22222, 12346, 'book', '2021-04-27', '2021-05-11', '2021-04-27'),
(201, 22222, 2, 'book', '2021-04-27', '2021-05-11', '2021-04-27'),
(202, 11111, 2, 'book', '2021-04-27', '2021-05-11', '2021-04-27'),
(203, 11111, 125, 'book', '2021-04-27', '2021-05-17', '0000-00-00'),
(204, 11111, 101, 'device', '2021-04-27', '2021-05-17', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `DaysOpened`
--

CREATE TABLE `DaysOpened` (
  `days_passed` int(11) NOT NULL,
  `CurrentDate` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `DaysOpened`
--

INSERT INTO `DaysOpened` (`days_passed`, `CurrentDate`) VALUES
(582, '2021-04-28');

--
-- Triggers `DaysOpened`
--
DELIMITER $$
CREATE TRIGGER `UpdateDays` AFTER UPDATE ON `DaysOpened` FOR EACH ROW UPDATE fines SET days_passed = days_passed + 1 WHERE paid = 0
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `UpdateFine` AFTER UPDATE ON `DaysOpened` FOR EACH ROW UPDATE fines SET Fine_Amount = Fine_Amount + 0.5 where paid = 0 AND Days_Passed >= 14
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `deletedemployees`
--

CREATE TABLE `deletedemployees` (
  `ssn` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `sex` enum('M','F') NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

CREATE TABLE `devices` (
  `id` int(11) NOT NULL,
  `model_no` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `date_published` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `model_no`, `title`, `brand`, `date_published`, `status`, `quantity`, `date_added`) VALUES
(78653, '12568', 'da vice', 'ye', '2021-04-01', 'available', 12, '2021-02-01'),
(7, '987654', 'tablet', 'dell', '2020-12-22', 'available', 1, '2021-01-05'),
(100, '3180', 'Chromebook', 'Dell', '2021-02-23', 'available', 2, '2021-04-12'),
(101, 'pro', 'Macbook', 'Apple', '2020-08-19', 'available', 1, '2021-04-14'),
(78658, '123123', 'New Device', 'Brand', '2021-03-04', 'available', 3, '0000-00-00'),
(78657, '412345366', 'device11', '12', '2021-04-15', 'available', 3, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `ssn` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `bdate` date NOT NULL,
  `sex` enum('M','F') NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`ssn`, `username`, `fname`, `lname`, `bdate`, `sex`, `phone`, `email`, `address`, `password`) VALUES
(1, 'cool guy', 'Cool', 'Guy', '1968-09-14', 'F', '1234567890', 'cool@guy.com', 'cool street', 'passwrod'),
(3, 'the three', '123', '123', '1996-04-14', 'M', '123', '123@mail.com', '123', 'pass'),
(4, 'joe123', 'joe', 'last', '1978-03-31', 'M', '123455', 'joe@mail.com', '123', 'ya'),
(12345, 'sass', 'sasdas', 'dfssa', '1989-03-29', 'M', '4444444', 'sddsafds@mail.com', '2134 fsdfdsfds', 'dsdfdsf'),
(123435, 'cass', 'name', 'last', '1974-04-17', 'F', '7137774000', 'sancheas@mail.com', 'sdee dr.', '123456'),
(1234455, 'derp', 'dan', 'bon', '1980-04-08', 'M', '7134008000', 'sqn@mail.com', '12345 ger Dr', 'qweryt'),
(2147483647, 'm342', 'dan', 'green', '2002-01-30', 'F', '123345344', '1dfwwwwwd@g.com', '1233 richmond st', '123');

--
-- Triggers `employees`
--
DELIMITER $$
CREATE TRIGGER `check_age` BEFORE INSERT ON `employees` FOR EACH ROW BEGIN
    IF (unix_timestamp() - unix_timestamp(new.bdate) < 60* 60 *24 * 365*18) THEN 
        SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'Warning: Cannot hire an employee younger than 18 years old!';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_age` BEFORE UPDATE ON `employees` FOR EACH ROW BEGIN
    IF (unix_timestamp() - unix_timestamp(new.bdate) < 60* 60 *24 * 365*18) THEN 
        SIGNAL SQLSTATE '02000' SET MESSAGE_TEXT = 'Warning: Employee cannot be youger than 18 years old!';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `fines`
--

CREATE TABLE `fines` (
  `fine_id` int(11) NOT NULL,
  `cardnumber` int(11) NOT NULL,
  `fine_amount` double NOT NULL,
  `date_issued` date NOT NULL,
  `paid` tinyint(1) NOT NULL,
  `days_passed` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fines`
--

INSERT INTO `fines` (`fine_id`, `cardnumber`, `fine_amount`, `date_issued`, `paid`, `days_passed`, `id`, `type`) VALUES
(44, 11111, 0, '2021-05-02', 1, 0, 51342, 'media'),
(43, 11111, 0, '2021-05-02', 1, 0, 51342, 'media'),
(45, 11111, 1000, '2021-05-02', 1, 0, 51342, 'media'),
(46, 11111, 0, '2021-05-02', 1, 0, 7, 'device'),
(47, 11111, 100, '2021-05-02', 1, 0, 7, 'device'),
(48, 11111, 0, '2021-05-02', 1, 0, 51342, 'media'),
(49, 11111, 0, '2021-05-02', 1, 0, 7, 'device'),
(50, 11111, 0, '2021-05-02', 1, 0, 87465, 'journal'),
(51, 11111, 15.5, '2021-05-02', 1, 46, 51342, 'media'),
(52, 11111, 15.5, '2021-05-02', 1, 46, 12346, 'book'),
(53, 11111, 0, '2021-05-02', 1, 0, 7, 'device'),
(54, 22222, 0, '2021-05-02', 1, 0, 7, 'device'),
(55, 22222, 15.5, '2021-05-08', 1, 46, 51342, 'media'),
(56, 11111, 15.5, '2021-05-02', 1, 46, 7, 'device'),
(57, 22222, 15.5, '2021-05-08', 1, 46, 12346, 'book'),
(58, 22222, 15.5, '2021-05-08', 1, 46, 87465, 'journal'),
(59, 11111, 7.5, '2021-05-08', 1, 28, 2, 'book'),
(60, 11111, 5, '2021-05-08', 1, 9, 2, 'book'),
(61, 11111, 0, '2021-05-08', 1, 3, 1, 'book'),
(62, 11111, 0, '2021-05-08', 1, 9, 12346, 'book'),
(63, 11111, 0, '2021-05-08', 1, 3, 87465, 'journal'),
(64, 22222, 0, '2021-05-02', 1, 0, 7, 'device'),
(65, 22222, 0, '2021-05-08', 1, 0, 7, 'device'),
(66, 22222, 0, '2021-05-08', 1, 0, 7, 'device'),
(67, 22222, 0, '2021-05-02', 1, 0, 7, 'device'),
(68, 11111, 0, '2021-05-08', 1, 2, 7, 'device'),
(69, 22222, 0, '2021-05-02', 1, 0, 7, 'device'),
(70, 11111, 0, '2021-05-08', 1, 2, 7, 'device'),
(71, 11111, 0, '2021-05-08', 1, 2, 7, 'device'),
(72, 11111, 0, '2021-05-08', 1, 2, 7, 'device'),
(73, 22222, 0, '2021-05-08', 1, 0, 7, 'device'),
(74, 11111, 0, '2021-05-08', 1, 2, 7, 'device'),
(75, 11111, 0, '2021-05-09', 1, 1, 7, 'device'),
(76, 11111, 6, '2021-05-09', 1, 1, 51342, 'media'),
(77, 3333, 6, '2021-05-03', 1, 1, 7, 'device'),
(78, 11111, 0, '2021-05-03', 1, 1, 7, 'device'),
(79, 3333, 0, '2021-05-03', 1, 1, 7, 'device'),
(80, 3333, 0, '2021-05-03', 1, 0, 12346, 'book'),
(81, 22222, 0, '2021-05-09', 1, 0, 12346, 'book'),
(82, 3333, 7.5, '2021-05-03', 1, 28, 12346, 'book'),
(83, 3333, 0, '2021-05-03', 1, 12, 12346, 'book'),
(84, 3333, -3, '2021-05-09', 1, 0, 12346, 'book'),
(85, 11111, -3, '2021-05-09', 1, 0, 12346, 'book'),
(86, 3333, 1, '2021-05-03', 1, 15, 12346, 'book'),
(87, 3333, 0.5, '2021-05-04', 1, 14, 1, 'book'),
(88, 3333, 0, '2021-05-04', 1, 0, 2, 'book'),
(89, 3333, 0, '2021-05-04', 1, 0, 12349, 'book'),
(90, 3333, 0.5, '2021-05-04', 1, 14, 1, 'book'),
(91, 3333, 0.5, '2021-05-04', 1, 14, 12346, 'book'),
(92, 3333, 0, '2021-05-04', 1, 13, 51342, 'media'),
(93, 3333, 1, '2021-05-04', 1, 15, 1, 'book'),
(94, 3333, 2, '2021-05-04', 1, 17, 78653, 'device'),
(95, 3333, 0, '2021-05-04', 1, 0, 7, 'device'),
(96, 3333, 0, '2021-05-04', 1, 0, 7, 'device'),
(97, 42071, 0, '2021-05-04', 1, 0, 7, 'device'),
(98, 3333, 0.5, '2021-05-04', 1, 14, 12345, 'book'),
(99, 3333, 0, '2021-05-04', 1, 12, 7, 'device'),
(100, 3333, 0.5, '2021-05-04', 1, 14, 12345, 'book'),
(101, 3333, 0, '2021-05-04', 1, 0, 2, 'book'),
(102, 3333, 0, '2021-05-04', 1, 0, 2, 'book'),
(103, 3333, 0, '2021-05-04', 1, 0, 122, 'book'),
(104, 3333, 16, '2021-05-04', 1, 45, 2, 'book'),
(105, 456790, 1, '2021-05-10', 1, 21, 12346, 'book'),
(106, 456790, -3, '2021-05-10', 1, 0, 12349, 'book'),
(107, 456790, -3, '2021-05-10', 1, 0, 87465, 'journal'),
(108, 456790, 1, '2021-05-10', 1, 21, 7, 'device'),
(109, 456790, 2.5, '2021-05-10', 1, 24, 12346, 'book'),
(110, 456790, -3, '2021-05-10', 1, 0, 87466, 'journal'),
(111, 456790, -3, '2021-05-10', 1, 0, 12346, 'book'),
(112, 11111, -3, '2021-05-10', 1, 2, 12349, 'book'),
(113, 11111, -3, '2021-05-10', 1, 0, 100, 'device'),
(114, 22222, -3, '2021-05-11', 1, 0, 2, 'book'),
(115, 22222, -3, '2021-05-11', 1, 0, 87466, 'journal'),
(116, 22222, -3, '2021-05-11', 1, 0, 2, 'book'),
(117, 22222, -3, '2021-05-11', 1, 0, 51342, 'media'),
(118, 22222, -3, '2021-05-11', 1, 0, 2, 'book'),
(119, 3333, 3, '2021-05-05', 1, 19, 78653, 'device'),
(120, 456791, 2.5, '2021-05-05', 1, 18, 78653, 'device'),
(121, 456791, 0, '2021-05-05', 1, 0, 34, 'book'),
(122, 11111, 0, '2021-05-05', 1, 0, 34, 'book'),
(123, 11111, -3, '2021-05-11', 1, 0, 34, 'book'),
(124, 22222, 0, '2021-05-05', 1, 0, 34, 'book'),
(125, 11111, 0, '2021-05-05', 1, 0, 34, 'book'),
(126, 22222, -3, '2021-05-12', 1, 0, 12346, 'book'),
(127, 11111, -3, '2021-05-12', 1, 0, 51342, 'media'),
(128, 22222, -3, '2021-05-12', 1, 1, 2, 'book'),
(129, 22222, 1, '2021-05-12', 1, 21, 2, 'book'),
(130, 22222, -3, '2021-05-12', 1, 0, 2, 'book'),
(131, 11111, -3, '2021-05-12', 1, 0, 122, 'book'),
(132, 11111, -3, '2021-05-12', 1, 0, 87465, 'journal'),
(133, 11111, 2, '2021-05-06', 1, 17, 2, 'book'),
(134, 22222, -3, '2021-05-12', 1, 1, 2, 'book'),
(135, 11111, -3, '2021-05-12', 1, 0, 122, 'book'),
(136, 11111, -3, '2021-05-12', 1, 0, 101, 'device'),
(137, 22222, -3, '2021-05-14', 1, 1, 2, 'book'),
(138, 22222, -3, '2021-05-14', 1, 0, 12349, 'book'),
(139, 11111, -3, '2021-05-14', 1, 1, 122, 'book'),
(140, 11111, -3, '2021-05-15', 1, 0, 12352, 'book'),
(141, 11111, -3, '2021-05-15', 1, 0, 12353, 'book'),
(142, 11111, -3, '2021-05-15', 1, 0, 12354, 'book'),
(143, 11111, -3, '2021-05-15', 1, 0, 51344, 'media'),
(144, 11111, -3, '2021-05-15', 1, 0, 87467, 'journal'),
(145, 11111, -3, '2021-05-15', 1, 0, 78655, 'device'),
(148, 22222, -3, '2021-05-15', 1, 0, 12355, 'book'),
(155, 11111, -3, '2021-05-15', 1, 0, 51342, 'media'),
(164, 11111, -3, '2021-05-15', 1, 0, 2, 'book'),
(152, 11111, 1, '2021-05-15', 1, 21, 78656, 'device'),
(168, 11111, 3.5, '2021-05-16', 1, 26, 2, 'book'),
(166, 11111, -3, '2021-05-16', 1, 0, 2, 'book'),
(160, 22222, -3, '2021-05-15', 1, 0, 78656, 'device'),
(167, 22222, 5, '2021-05-10', 1, 23, 2, 'book'),
(165, 11111, -3, '2021-05-15', 1, 0, 2, 'book'),
(169, 22222, 2.5, '2021-05-17', 1, 24, 122, 'book'),
(170, 22222, 7, '2021-05-11', 1, 27, 2, 'book'),
(171, 22222, 4, '2021-05-17', 1, 27, 122, 'book'),
(172, 22222, 4, '2021-05-17', 1, 27, 12346, 'book'),
(173, 22222, 4, '2021-05-17', 1, 27, 123, 'book'),
(174, 22222, 4, '2021-05-17', 1, 27, 125, 'book'),
(175, 22222, -3, '2021-05-17', 1, 0, 12349, 'book'),
(176, 22222, -3, '2021-05-17', 1, 0, 125, 'book'),
(177, 11111, -3, '2021-05-17', 1, 0, 2, 'book'),
(178, 22222, 0.5, '2021-05-17', 1, 20, 12346, 'book'),
(179, 11111, -3, '2021-05-17', 1, 2, 2, 'book'),
(180, 22222, -3, '2021-05-17', 1, 0, 123, 'book'),
(181, 22222, -3, '2021-05-17', 1, 0, 12349, 'book'),
(182, 22222, 3, '2021-05-17', 1, 25, 12346, 'book'),
(183, 22222, 12, '2021-05-17', 1, 43, 12346, 'book'),
(184, 11111, 7.5, '2021-05-17', 1, 34, 2, 'book'),
(185, 11111, 7.5, '2021-05-17', 1, 34, 122, 'book'),
(186, 11111, 7.5, '2021-05-17', 1, 34, 12346, 'book'),
(187, 11111, 7.5, '2021-05-17', 1, 34, 123, 'book'),
(188, 11111, 7.5, '2021-05-17', 1, 34, 12349, 'book'),
(189, 11111, -3, '2021-05-17', 1, 9, 2, 'book'),
(190, 22222, 4.5, '2021-05-17', 1, 28, 2, 'book'),
(191, 22222, -3, '2021-05-17', 1, 0, 12349, 'book'),
(192, 22222, -3, '2021-05-17', 1, 0, 87466, 'journal'),
(193, 22222, 2, '2021-05-17', 1, 23, 2, 'book'),
(194, 22222, 0.5, '2021-05-11', 1, 14, 2, 'book'),
(195, 22222, 0, '2021-05-11', 1, 0, 12346, 'book'),
(196, 22222, 0, '2021-05-11', 1, 0, 2, 'book'),
(197, 11111, 3.5, '2021-05-11', 1, 20, 2, 'book'),
(198, 11111, -3, '2021-05-17', 0, 1, 125, 'book'),
(199, 11111, -3, '2021-05-17', 0, 1, 101, 'device');

--
-- Triggers `fines`
--
DELIMITER $$
CREATE TRIGGER `cancheckout` BEFORE UPDATE ON `fines` FOR EACH ROW BEGIN 
UPDATE members SET members.isallowedtorent = 0 WHERE members.cardnumber = NEW.cardnumber AND NEW.paid = 0 AND NEW.fine_amount>0;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `givepermission` BEFORE UPDATE ON `fines` FOR EACH ROW BEGIN 
UPDATE members SET members.isallowedtorent = 1 WHERE members.cardnumber = NEW.cardnumber AND NEW.paid = 1;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hold`
--

CREATE TABLE `hold` (
  `hold_id` int(11) NOT NULL,
  `cardnumber` int(11) NOT NULL,
  `id` int(11) NOT NULL,
  `type` varchar(15) NOT NULL,
  `queue` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id` int(11) NOT NULL,
  `journal_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `date_published` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`id`, `journal_id`, `title`, `author`, `publisher`, `date_published`, `status`, `quantity`, `date_added`) VALUES
(87466, 123, '123', '123', '123', '2021-04-05', 'available', 123, '2021-04-19'),
(87465, 22, 'If You Don\'t Journal Now, You\'ll Hate Yourself Later', 'Emre Flynn', 'Energy News Today', '2021-04-14', 'available', 1, '2021-04-05'),
(87469, 43256777, 'journal1', '12', '12', '2021-04-06', 'available', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `identification` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `director` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `date_published` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_added` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `identification`, `title`, `director`, `genre`, `date_published`, `status`, `quantity`, `date_added`) VALUES
(51342, 111045, 'movie', 'yeah', 'Thriller', '2021-04-01', 'available', 48, '2021-04-19'),
(51346, 123456778, 'media11', '11', '11', '2021-03-31', 'available', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `cardnumber` int(11) NOT NULL,
  `username` varchar(120) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `numitemscheckedout` int(11) NOT NULL,
  `isallowedtorent` tinyint(1) NOT NULL DEFAULT '1',
  `password` varchar(255) NOT NULL,
  `usertype` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`cardnumber`, `username`, `fname`, `lname`, `phone`, `email`, `numitemscheckedout`, `isallowedtorent`, `password`, `usertype`) VALUES
(11111, 'm', 'mane', 'nn', 1234567899, 'tm13library@gmail.com', 2, 1, '123', 'faculty'),
(22222, 'test', 't', 'e', 555555555, 'mailfer@mail.com', 0, 1, '123', 'student'),
(42071, 'user1', 'user', 'name', 2147483647, 'y@mail.com', 1, 1, '123', 'student'),
(3333, 'q', 'qwe', 'rty', 1234567899, 'rm3337575@gmail.com', 5, 1, '123', 'student'),
(456789, 'record', 're', 'co', 1234567899, 'asdfadsfds', 2, 1, '123', 'student'),
(456790, 'guy', 'bill', 'nye', 2147483647, 'tm1@mail.com', 3, 1, 'science', 'faculty'),
(456791, 'johnjones', 'john', 'johnson', 2147483647, 'mynamesnotjohn@mail.com', 2, 1, 'jonesyboy', 'student'),
(456801, 'yeah', 'man', 'mann', 2147483647, 'man@mail.com', 0, 1, '123', 'faculty'),
(456800, 'testing', '12356', '143242314', 2147483647, 'mynamesnot3john@mail.com', 0, 1, '123', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `borrow`
--
ALTER TABLE `borrow`
  ADD PRIMARY KEY (`borrow_id`);

--
-- Indexes for table `DaysOpened`
--
ALTER TABLE `DaysOpened`
  ADD PRIMARY KEY (`days_passed`);

--
-- Indexes for table `deletedemployees`
--
ALTER TABLE `deletedemployees`
  ADD PRIMARY KEY (`ssn`);

--
-- Indexes for table `devices`
--
ALTER TABLE `devices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`ssn`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `fines`
--
ALTER TABLE `fines`
  ADD PRIMARY KEY (`fine_id`);

--
-- Indexes for table `hold`
--
ALTER TABLE `hold`
  ADD PRIMARY KEY (`hold_id`);

--
-- Indexes for table `journals`
--
ALTER TABLE `journals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`cardnumber`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12360;

--
-- AUTO_INCREMENT for table `borrow`
--
ALTER TABLE `borrow`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=205;

--
-- AUTO_INCREMENT for table `DaysOpened`
--
ALTER TABLE `DaysOpened`
  MODIFY `days_passed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=583;

--
-- AUTO_INCREMENT for table `deletedemployees`
--
ALTER TABLE `deletedemployees`
  MODIFY `ssn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `devices`
--
ALTER TABLE `devices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78659;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `ssn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483648;

--
-- AUTO_INCREMENT for table `fines`
--
ALTER TABLE `fines`
  MODIFY `fine_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=200;

--
-- AUTO_INCREMENT for table `hold`
--
ALTER TABLE `hold`
  MODIFY `hold_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `journals`
--
ALTER TABLE `journals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87470;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51348;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `cardnumber` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=456802;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
