-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2023 at 08:23 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klbcustomer`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbldocuments`
--

CREATE TABLE `tbldocuments` (
  `ID` varchar(255) NOT NULL,
  `KRAPIN` varchar(255) NOT NULL,
  `BUSINESSPERMIT` varchar(255) NOT NULL,
  `NATIONALID` varchar(255) NOT NULL,
  `STATUS` int(1) NOT NULL,
  `DATEADDED` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldocuments`
--

INSERT INTO `tbldocuments` (`ID`, `KRAPIN`, `BUSINESSPERMIT`, `NATIONALID`, `STATUS`, `DATEADDED`) VALUES
('kirwadaniel03@gmail.com', 'documents', 'documents', 'documents', 0, '2022-12-13 11:00:06');

-- --------------------------------------------------------

--
-- Table structure for table `tblsubmision`
--

CREATE TABLE `tblsubmision` (
  `ID` varchar(255) NOT NULL,
  `NATIONALID` int(1) NOT NULL,
  `KRAPIN` int(1) NOT NULL,
  `PERMIT` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsubmision`
--

INSERT INTO `tblsubmision` (`ID`, `NATIONALID`, `KRAPIN`, `PERMIT`) VALUES
('kirwadaniel03@gmail.com', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbluserdetails`
--

CREATE TABLE `tbluserdetails` (
  `FIRSTNAME` varchar(255) NOT NULL,
  `LASTNAME` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `STATUS` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbluserdetails`
--

INSERT INTO `tbluserdetails` (`FIRSTNAME`, `LASTNAME`, `EMAIL`, `STATUS`) VALUES
('Daniel', 'kipchirchir', 'kirwadaniel03@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `PRIVILLAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`USERNAME`, `PASSWORD`, `PRIVILLAGE`) VALUES
('kirwadaniel03@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'User');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbldocuments`
--
ALTER TABLE `tbldocuments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `CATCOM` (`KRAPIN`),
  ADD KEY `COMUSER` (`ID`);

--
-- Indexes for table `tblsubmision`
--
ALTER TABLE `tblsubmision`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluserdetails`
--
ALTER TABLE `tbluserdetails`
  ADD PRIMARY KEY (`EMAIL`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD UNIQUE KEY `USERNAME` (`USERNAME`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbldocuments`
--
ALTER TABLE `tbldocuments`
  ADD CONSTRAINT `COMUSER` FOREIGN KEY (`ID`) REFERENCES `tbluserdetails` (`EMAIL`) ON UPDATE CASCADE;

--
-- Constraints for table `tblsubmision`
--
ALTER TABLE `tblsubmision`
  ADD CONSTRAINT `SUBFILE` FOREIGN KEY (`ID`) REFERENCES `tbluserdetails` (`EMAIL`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
