-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 07, 2024 at 04:59 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

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
  `Book_Reff_num` varchar(100) DEFAULT NULL,
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
(3, '0', 9, 8, '2024-01-07', '2024-01-09', 'KLIA1', 'dsa', 'dsa', 'pending', 3, 2, 'roof_parking', NULL),
(4, '0', 10, 9, '2024-01-07', '2024-01-10', 'KLIA1', 'dsa', 'dsa', 'pending', 4, 3, 'roof_parking', NULL),
(5, '2', 11, 10, '2024-01-07', '2024-01-10', 'KLIA1', 'dsa', 'dsad', 'pending', 5, 3, 'roof_parking', NULL),
(6, '0', 12, 11, '2024-01-07', '2024-01-09', 'KLIA1', 'dsa', 'dsa', 'pending', 6, 2, 'roof_parking', NULL),
(7, 'BRNA0723dfd1', 13, 12, '2024-01-07', '2024-01-10', 'KLIA1', 'dsad', 'dasd', 'pending', 7, 3, 'roof_parking', NULL);

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
(7, 'akim', '0138723421', 1, 'parit raja', 1, 11),
(9, 'akim', '0138723421', 1, 'parit raja', 3, 11),
(10, 'akim', '0138723421', 1, 'parit raja', 4, 11),
(11, 'akim', '0138723421', 1, 'parit raja', 5, 11),
(12, 'akim', '0138723421', 1, 'parit raja', 6, 11),
(13, 'akim', '0138723421', 1, 'parit raja', 7, 11),
(14, 'NAGULAN PANIR SELWAM', '149033884', 2, 'no 9, Jalan 4/1A, Bandar Baru Selayang, Fasa 2B,', NULL, 0);

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
(1, 'roof_parking', 20, 10, 'roof parking'),
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
(1, 7, 'roof_parking', NULL, '2024-01-09', '2024-01-07'),
(2, 8, 'roof_parking', NULL, '2024-01-09', '2024-01-07'),
(3, 9, 'roof_parking', NULL, '2024-01-09', '2024-01-07'),
(4, 10, 'roof_parking', NULL, '2024-01-10', '2024-01-07'),
(5, 11, 'roof_parking', NULL, '2024-01-10', '2024-01-07'),
(6, 12, 'roof_parking', NULL, '2024-01-09', '2024-01-07'),
(7, 13, 'roof_parking', NULL, '2024-01-10', '2024-01-07');

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
(1, 7, 1, '20.00', NULL, 'cash', 'pending'),
(2, 8, 2, '20.00', NULL, 'cash', 'pending'),
(3, 9, 3, '20.00', NULL, 'cash', 'Complete'),
(4, 10, 4, '30.00', NULL, 'cash', 'pending'),
(5, 11, 5, '30.00', NULL, 'cash', 'pending'),
(6, 12, 6, '20.00', NULL, 'cash', 'pending'),
(7, 13, 7, '30.00', NULL, 'cash', 'pending');

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
(1, 'ALVIN', 'awat@gmail.com', '$2y$10$b3Q7KFKG6H7XnJFOuRs2LuDaZRx273ue7lMn0xnD3tbzkRrQ3H1m.', 'customer'),
(2, 'NAGULAN PANIR SELWAM', 'nagu1370@gmail.com', '$2y$10$huvFKPuwzEBA8bo9CAhkpuzPO6qSe1uZLszuv078fZiQLB3OftExC', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `Vehicle_ID` int(11) NOT NULL,
  `Cust_ID` int(11) DEFAULT NULL,
  `Model` varchar(50) DEFAULT NULL,
  `Plate_Number` varchar(10) DEFAULT NULL,
  `Book_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`Vehicle_ID`, `Cust_ID`, `Model`, `Plate_Number`, `Book_ID`) VALUES
(6, 7, 'PERODUA', 'fe', 0),
(8, 9, 'dsa', 'dsa', 3),
(9, 10, 'dsa', 'dsa', 4),
(10, 11, 'dsa', 'asd', 5),
(11, 12, 'asd', 'dsad', 6),
(12, 13, 'dsa', 'dsa', 7);

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
  ADD KEY `Cust_ID` (`Cust_ID`),
  ADD KEY `vehicle_fk` (`Book_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `Book_ID` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Cust_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `parking_availability`
--
ALTER TABLE `parking_availability`
  MODIFY `availability_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `Payment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `Vehicle_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_fk1` FOREIGN KEY (`Cust_ID`) REFERENCES `customer` (`Cust_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
