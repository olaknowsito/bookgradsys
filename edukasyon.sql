-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 23, 2020 at 05:17 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 5.6.40-8+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `edukasyon`
--

-- --------------------------------------------------------

--
-- Table structure for table `grade_records`
--

CREATE TABLE `grade_records` (
  `id` int(11) NOT NULL,
  `qr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `grade` int(11) NOT NULL,
  `grade_category` enum('H','T') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_records`
--

INSERT INTO `grade_records` (`id`, `qr_id`, `user_id`, `grade`, `grade_category`) VALUES
(1, 1, 1, 75, 'H'),
(2, 1, 1, 88, 'H'),
(3, 1, 1, 100, 'H'),
(4, 1, 1, 95, 'H'),
(5, 1, 1, 84, 'H'),
(6, 1, 1, 68, 'H'),
(7, 1, 1, 91, 'H'),
(8, 1, 1, 74, 'H'),
(9, 1, 1, 100, 'H'),
(10, 1, 1, 82, 'H'),
(11, 1, 1, 93, 'H'),
(12, 1, 1, 73, 'T'),
(13, 1, 1, 82, 'T'),
(14, 1, 1, 81, 'T'),
(15, 1, 1, 92, 'T'),
(16, 1, 1, 85, 'T'),
(17, 2, 2, 86, 'H'),
(18, 2, 2, 55, 'H'),
(19, 2, 2, 96, 'H'),
(20, 2, 2, 78, 'H'),
(21, 2, 2, 82, 'T'),
(22, 2, 2, 89, 'T'),
(23, 2, 2, 93, 'T'),
(24, 2, 2, 70, 'T'),
(25, 2, 2, 74, 'T'),
(26, 2, 2, 93, 'H'),
(27, 2, 2, 85, 'H'),
(28, 2, 2, 80, 'H'),
(29, 2, 2, 74, 'H'),
(30, 2, 2, 76, 'H'),
(31, 2, 2, 82, 'H'),
(32, 2, 2, 62, 'H'),
(33, 3, 3, 88, 'T'),
(34, 3, 3, 94, 'T'),
(35, 3, 3, 100, 'T'),
(36, 3, 3, 82, 'T'),
(37, 3, 3, 95, 'T'),
(38, 3, 3, 84, 'H'),
(39, 3, 3, 66, 'H'),
(40, 3, 3, 74, 'H'),
(41, 3, 3, 98, 'H'),
(42, 3, 3, 92, 'H'),
(43, 3, 3, 85, 'H'),
(44, 3, 3, 100, 'H'),
(45, 3, 3, 95, 'H'),
(46, 3, 3, 96, 'H'),
(47, 3, 3, 42, 'H'),
(48, 3, 3, 88, 'H'),
(49, 4, 4, 73, 'H'),
(50, 4, 4, 99, 'H'),
(51, 4, 4, 98, 'H'),
(52, 4, 4, 83, 'H'),
(53, 4, 4, 85, 'H'),
(54, 4, 4, 92, 'H'),
(55, 4, 4, 100, 'H'),
(56, 4, 4, 60, 'H'),
(57, 4, 4, 74, 'H'),
(58, 4, 4, 98, 'H'),
(59, 4, 4, 92, 'H'),
(60, 4, 4, 84, 'T'),
(61, 4, 4, 96, 'T'),
(62, 4, 4, 79, 'T'),
(63, 4, 4, 91, 'T'),
(64, 4, 4, 95, 'T'),
(65, 5, 5, 65, 'H'),
(66, 5, 5, 72, 'H'),
(67, 5, 5, 78, 'H'),
(68, 5, 5, 80, 'H'),
(69, 5, 5, 82, 'H'),
(70, 5, 5, 74, 'H'),
(71, 5, 5, 76, 'H'),
(72, 5, 5, 0, 'H'),
(73, 5, 5, 85, 'H'),
(74, 5, 5, 75, 'H'),
(75, 5, 5, 76, 'H'),
(76, 5, 5, 74, 'T'),
(77, 5, 5, 79, 'T'),
(78, 5, 5, 70, 'T'),
(79, 5, 5, 99, 'T'),
(80, 5, 5, 100, 'T'),
(81, 6, 6, 75, 'H'),
(82, 6, 6, 88, 'H'),
(83, 6, 6, 100, 'H'),
(84, 6, 6, 95, 'H'),
(85, 6, 6, 84, 'H'),
(86, 6, 6, 68, 'H'),
(87, 6, 6, 91, 'H'),
(88, 6, 6, 74, 'H'),
(89, 6, 6, 100, 'H'),
(90, 6, 6, 82, 'H'),
(91, 6, 6, 93, 'H'),
(92, 6, 6, 73, 'T'),
(93, 6, 6, 82, 'T'),
(94, 6, 6, 81, 'T'),
(95, 6, 6, 92, 'T'),
(96, 6, 6, 85, 'T'),
(97, 7, 6, 75, 'H'),
(98, 7, 6, 88, 'H'),
(99, 7, 6, 100, 'H'),
(100, 7, 6, 95, 'H'),
(101, 7, 6, 84, 'H'),
(102, 7, 6, 68, 'H'),
(103, 7, 6, 91, 'H'),
(104, 7, 6, 74, 'H'),
(105, 7, 6, 100, 'H'),
(106, 7, 6, 82, 'H'),
(107, 7, 6, 93, 'H'),
(108, 7, 6, 73, 'T'),
(109, 7, 6, 82, 'T'),
(110, 7, 6, 81, 'T'),
(111, 7, 6, 92, 'T'),
(112, 7, 6, 85, 'T'),
(113, 8, 6, 75, 'H'),
(114, 8, 6, 88, 'H'),
(115, 8, 6, 100, 'H'),
(116, 8, 6, 95, 'H'),
(117, 8, 6, 84, 'H'),
(118, 8, 6, 68, 'H'),
(119, 8, 6, 91, 'H'),
(120, 8, 6, 74, 'H'),
(121, 8, 6, 100, 'H'),
(122, 8, 6, 82, 'H'),
(123, 8, 6, 93, 'H'),
(124, 8, 6, 73, 'T'),
(125, 8, 6, 82, 'T'),
(126, 8, 6, 81, 'T'),
(127, 8, 6, 92, 'T'),
(128, 8, 6, 85, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `quarter_records`
--

CREATE TABLE `quarter_records` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `quarter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quarter_records`
--

INSERT INTO `quarter_records` (`id`, `user_id`, `year`, `quarter`) VALUES
(1, 1, 2044, 4),
(2, 2, 2044, 4),
(3, 3, 2044, 4),
(4, 4, 2044, 4),
(5, 5, 2044, 4),
(6, 6, 2044, 4),
(7, 6, 2009, 2),
(8, 6, 2022, 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `last_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `full_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `test_average` int(11) NOT NULL,
  `hw_average` int(11) NOT NULL,
  `final_average` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `full_name`, `test_average`, `hw_average`, `final_average`) VALUES
(1, '', '', 'Susan Smith', 0, 0, 0),
(2, '', '', 'John Wright', 0, 0, 0),
(3, '', '', 'Jane Jones', 0, 0, 0),
(4, '', '', 'Jimmy Doe', 0, 0, 0),
(5, '', '', 'Suzy Johnson', 0, 0, 0),
(6, '', '', 'Susan Smitsh', 0, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grade_records`
--
ALTER TABLE `grade_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quarter_records`
--
ALTER TABLE `quarter_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grade_records`
--
ALTER TABLE `grade_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `quarter_records`
--
ALTER TABLE `quarter_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
