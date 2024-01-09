-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 12:46 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parkingsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `Book_ID` int(50) NOT NULL,
  `Book_Reff_num` int(10) DEFAULT NULL,
  `Cust_ID` int(11) DEFAULT NULL,
  `Vehicle_ID` int(11) DEFAULT NULL,
  `Date_IN` date DEFAULT NULL,
  `Date_OUT` date DEFAULT NULL,
  `KLIA` varchar(10) DEFAULT NULL,
  `Depart_no` varchar(20) DEFAULT NULL,
  `Arrive_no` varchar(20) DEFAULT NULL,
  `status_booking` varchar(50) DEFAULT NULL,
  `Payment_ID` int(50) NOT NULL,
  `duration` int(11) NOT NULL,
  `parkType` varchar(50) NOT NULL,
  `booking_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`Book_ID`, `Book_Reff_num`, `Cust_ID`, `Vehicle_ID`, `Date_IN`, `Date_OUT`, `KLIA`, `Depart_no`, `Arrive_no`, `status_booking`, `Payment_ID`, `duration`, `parkType`, `booking_date`) VALUES
(2, NULL, 28, 5, '2024-01-06', '2024-01-05', 'KLIA1', 'dsad', 'ada', NULL, 0, 1, 'roof', NULL),
(4, NULL, 32, 9, '2024-01-08', '2024-01-05', 'KLIA2', 'dsad', 'adad', NULL, 3, 3, 'noRoof', NULL),
(5, NULL, 33, 10, '2024-01-08', '2024-01-05', 'KLIA2', 'dsad', 'adad', NULL, 4, 3, 'noRoof', NULL),
(6, NULL, 37, 14, '2024-01-10', '2024-01-05', 'KLIA1', 'dsad', 'dsad', NULL, 5, 5, 'roof', NULL),
(7, NULL, 38, 15, '2024-01-10', '2024-01-05', 'KLIA1', 'dsad', 'asda', NULL, 6, 5, 'noRoof', NULL),
(8, NULL, 39, 16, '2024-01-08', '2024-01-07', 'KLIA1', 'dsad', 'sada', NULL, 7, 1, 'roof', NULL),
(9, NULL, 40, 17, '2024-01-08', '2024-01-05', 'KLIA1', 'dsa', 'ddad', NULL, 8, 3, 'roof_parking', NULL),
(10, NULL, 51, 28, '2024-01-08', '2024-01-05', 'KLIA1', 'dsad', 'sada', NULL, 9, 3, 'roof_parking', NULL),
(11, NULL, 55, 31, '2024-01-09', '2024-01-06', 'KLIA1', 'dsa', 'dsa', NULL, 10, 3, 'roof_parking', NULL),
(12, NULL, 56, 32, '2024-01-08', '2024-01-06', 'KLIA1', 'ds', 'dsad', NULL, 11, 2, 'roof_parking', NULL),
(13, NULL, 57, 33, '2024-01-08', '2024-01-06', 'KLIA1', 'vcx', 'fdgd', NULL, 12, 2, 'noroof_parking', NULL),
(14, NULL, 58, 34, '2024-01-09', '2024-01-06', 'KLIA1', 'dsf', 'sdf', NULL, 13, 3, 'noroof_parking', NULL),
(15, NULL, 59, 35, '2024-01-18', '2024-01-03', 'KLIA1', 'mh567', 'mh879', NULL, 14, 15, 'roof_parking', NULL),
(16, NULL, 60, 36, '2024-01-19', '2024-01-10', 'KLIA1', 'mh567', 'mh879', NULL, 15, 9, 'roof_parking', NULL),
(17, NULL, 61, 37, '2024-01-15', '2024-01-10', 'KLIA1', 'mh567', 'mh879', NULL, 16, 5, 'roof_parking', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cust_ID` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Pnum` varchar(15) DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `Book_ID` int(11) DEFAULT NULL,
  `deposit_paid` int(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_ID`, `Name`, `Pnum`, `User_ID`, `Address`, `Book_ID`, `deposit_paid`) VALUES
(16, 'alvin', '138723121', 19, 'Parit Raja', NULL, 0),
(17, 'akil', '138723121', 20, 'Parit Raja', NULL, 0),
(18, 'dsa', '138723121', 21, 'Parit Raja', NULL, 0),
(19, 'amin', '138723121', 22, 'Parit Raja', NULL, 0),
(20, 'kim', '138723121', 23, 'Parit Raja', NULL, 0),
(21, 'sam', '138723121', 24, 'Parit Raja', NULL, 0),
(22, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(23, 'super', '138723121', 26, 'Parit Raja', NULL, 0),
(24, NULL, NULL, 25, NULL, NULL, 14),
(25, 'ham', '138723121', 25, 'Parit Raja', NULL, 14),
(26, 'ham', '138723121', 25, 'Parit Raja', NULL, 20),
(27, 'ham', '138723121', 25, 'Parit Raja', NULL, 7),
(28, 'ham', '138723121', 25, 'Parit Raja', NULL, 7),
(29, 'ham', '138723121', 25, 'Parit Raja', NULL, 50),
(30, 'ham', '138723121', 25, 'Parit Raja', NULL, 21),
(32, 'ham', '138723121', 25, 'Parit Raja', NULL, 30),
(33, 'ham', '138723121', 25, 'Parit Raja', NULL, 30),
(37, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(38, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(39, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(40, 'ham', '138723121', 25, 'Parit Raja', NULL, 30),
(51, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(52, 'ifwat', '138723121', 27, 'Parit Raja', NULL, 0),
(55, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(56, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(57, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(58, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(59, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(60, 'ham', '138723121', 25, 'Parit Raja', NULL, 0),
(61, 'ham', '138723121', 25, 'Parit Raja', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `park_id` int(11) NOT NULL,
  `parking_type` varchar(50) DEFAULT NULL,
  `numpark_available` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`park_id`, `parking_type`, `numpark_available`, `price`, `description`) VALUES
(1, 'roof_parking', -3, 10, 'roof parking'),
(2, 'noroof_parking', 18, 7, 'open space parking');

-- --------------------------------------------------------

--
-- Table structure for table `parking_availability`
--

CREATE TABLE `parking_availability` (
  `availability_id` int(11) NOT NULL,
  `Cust_ID` int(11) NOT NULL,
  `parking_type` varchar(50) DEFAULT NULL,
  `available_date` date DEFAULT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parking_availability`
--

INSERT INTO `parking_availability` (`availability_id`, `Cust_ID`, `parking_type`, `available_date`, `date_start`, `date_end`) VALUES
(1, 55, 'roof_parking', NULL, '2024-01-09', '2024-01-06'),
(2, 56, 'roof_parking', NULL, '2024-01-08', '2024-01-06'),
(3, 57, 'noroof_parking', NULL, '2024-01-08', '2024-01-06'),
(4, 58, 'noroof_parking', NULL, '2024-01-09', '2024-01-06'),
(5, 59, 'roof_parking', NULL, '2024-01-18', '2024-01-03'),
(6, 60, 'roof_parking', NULL, '2024-01-19', '2024-01-10'),
(7, 61, 'roof_parking', NULL, '2024-01-15', '2024-01-10');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `Payment_ID` int(11) NOT NULL,
  `Cust_ID` int(11) DEFAULT NULL,
  `Book_ID` int(11) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `Transaction_ID` varchar(50) DEFAULT NULL,
  `Payment_Method` varchar(20) DEFAULT NULL,
  `Payment_Status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`Payment_ID`, `Cust_ID`, `Book_ID`, `Amount`, `Transaction_ID`, `Payment_Method`, `Payment_Status`) VALUES
(1, 28, NULL, 7.00, NULL, 'cash', NULL),
(3, 32, NULL, 30.00, NULL, 'cash', NULL),
(4, 33, NULL, 30.00, NULL, 'cash', NULL),
(5, 37, NULL, 0.00, NULL, 'cash', NULL),
(6, 38, NULL, 0.00, NULL, 'cash', NULL),
(7, 39, NULL, 0.00, NULL, 'cash', NULL),
(8, 40, NULL, 30.00, NULL, 'cash', NULL),
(9, 51, NULL, 30.00, NULL, 'cash', 'pending'),
(10, 55, NULL, 30.00, NULL, 'cash', 'pending'),
(11, 56, NULL, 20.00, NULL, 'cash', 'pending'),
(12, 57, NULL, 14.00, NULL, 'cash', 'pending'),
(13, 58, NULL, 21.00, NULL, 'cash', 'pending'),
(14, 59, NULL, 150.00, NULL, 'cash', 'pending'),
(15, 60, NULL, 90.00, NULL, 'cash', 'pending'),
(16, 61, NULL, 50.00, NULL, 'cash', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `username`, `email`, `password`, `role`) VALUES
(19, 'alvin', 'awat@gmail.com', '$2y$12$vn7cHrDcfLU/kqsE78vdKe9PnLFu6oz9dwpcYlBDxskgbe6RAox7O', 'customer'),
(20, 'akil', 'akil@gmail.com', '$2y$12$nxe0fNX7DFbUEVYTzSKTjOG1MwI/oCmKcfukXH2.IQqQN8ok0kgeq', 'customer'),
(21, 'dsa', 'ds@gmail.com', '$2y$10$8DTclLo1ZNLCv4ahxodFguleSDjyKdna8UxyCJr/Fuq9gZ91w5gIq', 'customer'),
(22, 'amin', 'am@gmail.com', '$2y$10$QmH9AgGuN77gd0pmxiqyhOKGt7kxBT5Npx6X1yrUsR9ZL4BOft1hS', 'customer'),
(23, 'kim', 'kim@gmail.com', '$2y$10$ulKAd9lmbFMTtT3vfIp.YewF2KSbUP6KnpayE73MI1autcqwaVxAS', 'customer'),
(24, 'sam', 'sam@gmail.com', '$2y$10$ZvWx6RihviZxywsN5g2di.pAQc93hAm562vfXQx2e6tML2xHAf2KC', 'customer'),
(25, 'ham', 'ham@gmail.com', '$2y$10$ImYDSr5PuWFc.oWTNc9taeCluiIEiOZlmPrCOQfKxGzTOGOBl.EI.', 'customer'),
(26, 'super', 'ifwat@gmail.com', '$2y$10$kl99hnRpkfc3doozZFALMONm29O5YS81oTblgycSe4AVOBRaCdvvW', 'admin'),
(27, 'ifwat', 'zifwat001@gmail.com', '$2y$10$oYSg9m5pyTLcGW37DLNpd.BRTL0knFdP8zFhE7.swjCIH4SJvmhi2', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `Vehicle_ID` int(11) NOT NULL,
  `Cust_ID` int(11) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Color` varchar(20) DEFAULT NULL,
  `Plate_Number` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`Vehicle_ID`, `Cust_ID`, `Model`, `Color`, `Plate_Number`) VALUES
(1, 24, 'dsa', NULL, 'dsa'),
(2, 25, 'dsa', NULL, 'dsa'),
(3, 26, 'dsa', NULL, 'dsa'),
(4, 27, 'dsa', NULL, 'dsa'),
(5, 28, 'dsa', NULL, 'dsa'),
(6, 29, 'dasd', NULL, 'dsad'),
(7, 30, 'dada', NULL, 'dada'),
(9, 32, 'dsad', NULL, 'adad'),
(10, 33, 'dsad', NULL, 'adad'),
(14, 37, 'dada', NULL, 'ada'),
(15, 38, 'da', NULL, 'dada'),
(16, 39, 'dsad', NULL, 'dsad'),
(17, 40, 'dsa', NULL, 'dsa'),
(28, 51, 'dsa', NULL, 'da'),
(31, 55, 'das', NULL, 'dsad'),
(32, 56, 'dsa', NULL, 'sad'),
(33, 57, 'fdgfd', NULL, 'gfdg'),
(34, 58, 'fsd', NULL, 'fds'),
(35, 59, 'vios', NULL, 'WER3456'),
(36, 60, 'vios', NULL, 'WER3456'),
(37, 61, 'bezza', NULL, 'WER3456');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`Book_ID`),
  ADD KEY `booking_ibfk_1` (`Cust_ID`),
  ADD KEY `booking_ibfk_2` (`Vehicle_ID`),
  ADD KEY `booking_ibfk_3` (`Payment_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cust_ID`),
  ADD KEY `customer_ibfk_1` (`User_ID`),
  ADD KEY `fk_customer_booking` (`Book_ID`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`park_id`);

--
-- Indexes for table `parking_availability`
--
ALTER TABLE `parking_availability`
  ADD PRIMARY KEY (`availability_id`),
  ADD KEY `parkingavailability_ibfk1` (`Cust_ID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`Payment_ID`),
  ADD KEY `Cust_ID` (`Cust_ID`),
  ADD KEY `Book_ID` (`Book_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`Vehicle_ID`),
  ADD KEY `Cust_ID` (`Cust_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Book_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Cust_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `parking_availability`
--
ALTER TABLE `parking_availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `booking_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_2` FOREIGN KEY (`Vehicle_ID`) REFERENCES `vehicle` (`Vehicle_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `booking_ibfk_3` FOREIGN KEY (`Payment_ID`) REFERENCES `payment` (`Payment_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_customer_booking` FOREIGN KEY (`Book_ID`) REFERENCES `booking` (`Book_ID`);

--
-- Constraints for table `parking_availability`
--
ALTER TABLE `parking_availability`
  ADD CONSTRAINT `parkingavailability_ibfk1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`Book_ID`) REFERENCES `booking` (`Book_ID`);

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
