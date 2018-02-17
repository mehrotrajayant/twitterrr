-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2018 at 03:46 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jayant`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `ID` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`ID`, `Name`, `Username`, `Password`) VALUES
(1, 'Jayant', 'jayant', '12345'),
(2, 'Atul Singh', '140507', '7075');

-- --------------------------------------------------------

--
-- Table structure for table `image_up`
--

CREATE TABLE `image_up` (
  `email` varchar(225) NOT NULL,
  `image` varchar(225) NOT NULL,
  `filepath` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `ID_no` int(225) NOT NULL,
  `Reg` int(225) NOT NULL,
  `name` varchar(500) NOT NULL,
  `pass` varchar(500) NOT NULL,
  `cpass` varchar(500) NOT NULL,
  `email` varchar(500) NOT NULL,
  `Mobile_no` bigint(15) NOT NULL,
  `time` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  `fileToUpload` varchar(100) NOT NULL,
  `filepath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`ID_no`, `Reg`, `name`, `pass`, `cpass`, `email`, `Mobile_no`, `time`, `fileToUpload`, `filepath`) VALUES
(12, 123456, 'ASDFG', '1234567', '1234567', 'atulsingh834@gmail.com01', 8659574852, '2018-02-17 09:41:09.690385', '20160818_082413.jpg', 'http://localhost/Jayant/upload/20160818_082413.jpg'),
(13, 15896, 'Atul yadav', 'asdf', 'asdf', 'd@m.in', 9568754868, '2018-02-17 09:47:06.592711', 'BeautyPlus_20160826071405_save_1-hires.jpg', 'http://localhost/Jayant/upload/BeautyPlus_20160826071405_save_1-hires.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `image_up`
--
ALTER TABLE `image_up`
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`ID_no`),
  ADD UNIQUE KEY `Reg` (`Reg`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_login`
--
ALTER TABLE `admin_login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `registration`
--
ALTER TABLE `registration`
  MODIFY `ID_no` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
