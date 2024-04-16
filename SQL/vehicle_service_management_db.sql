-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 16, 2024 at 06:22 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_service_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `Branch_Id` int(3) NOT NULL,
  `Branch_Name` varchar(20) NOT NULL,
  `Phone` bigint(10) NOT NULL,
  `City` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`Branch_Id`, `Branch_Name`, `Phone`, `City`) VALUES
(101, 'RR Nagar', 1234567890, 'RR nagar'),
(102, 'Nitte', 5739648609, 'Mangalore');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_Id` int(5) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gender` varchar(6) NOT NULL,
  `Phone` bigint(10) NOT NULL,
  `City` varchar(20) NOT NULL,
  `Email_Id` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_Id`, `Name`, `Gender`, `Phone`, `City`, `Email_Id`) VALUES
(1, 'Bramha Kashyap', '', 985866480, 'RR nagar', 'kashyap.567@gmail.com'),
(2, 'Skanda Kumar', '', 8688768699, 'Benagluru', 'kumar.skanda@yahoo.in'),
(3, 'Vinay A M', 'Male', 9844115643, 'Bengaluru', 'stonevinay@gmail.com'),
(5, 'Ujwal', 'Male', 235875639, 'Koppa', 'ujwal@gmail.com'),
(6, 'Deekshith', 'Male', 7349585797, 'Bengaluru', 'deekshithjain@gmail.com'),
(7, 'Bharath R', 'Male', 8861151432, 'Durga', 'bharthraj@gmail.com'),
(9, 'Ujwal', 'Male', 8618317936, 'Bengaluru', 'ujwalhu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `Dname` varchar(20) NOT NULL,
  `Dept_No` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`Dname`, `Dept_No`) VALUES
('Accounting', 11),
('Admin', 12),
('Logistic', 13);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Emp_No` int(6) NOT NULL,
  `Emp_Name` varchar(20) NOT NULL,
  `Phone` bigint(10) NOT NULL,
  `DOB` date NOT NULL,
  `Email_Id` varchar(35) NOT NULL,
  `password` varchar(9) NOT NULL,
  `Branch_Id` int(3) NOT NULL,
  `Dept_No` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Emp_No`, `Emp_Name`, `Phone`, `DOB`, `Email_Id`, `password`, `Branch_Id`, `Dept_No`) VALUES
(1019, 'H U Ujwal', 1234567890, '2002-07-20', 'ujwalhu@gmail.com', 'Ujwal@123', 101, 12),
(1020, 'Shriram', 1234567890, '1998-10-26', 'shriram@gmail.com', '@Shriram1', 101, 12),
(1021, 'Satwik', 7795739541, '2002-11-08', 'satwik@gmail.com', '@Satwik1', 102, 13);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `Service_No` int(5) NOT NULL,
  `Service_Type` varchar(15) NOT NULL,
  `Date` date NOT NULL,
  `Amount` int(5) NOT NULL,
  `Payment_Status` varchar(10) NOT NULL,
  `Brach_Id` int(3) NOT NULL,
  `Vehicle_No` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`Service_No`, `Service_Type`, `Date`, `Amount`, `Payment_Status`, `Brach_Id`, `Vehicle_No`) VALUES
(1, 'Complete', '2022-08-04', 999999, 'Pending', 102, 'KA05EU4665'),
(9, 'Complete', '2022-08-16', 51545, 'Pending', 102, 'KA02KK5981'),
(10, 'Spring arm repl', '2022-08-26', 23664, 'Pending', 102, 'KA05EU4665'),
(11, 'Complete', '2022-09-14', 1784, 'Pending', 102, 'ka11kk0987');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `Vehicle_No` char(10) NOT NULL,
  `Type` varchar(10) NOT NULL,
  `Model_Name` varchar(20) NOT NULL,
  `Year_Of_Manufacture` int(4) NOT NULL,
  `KM` int(5) NOT NULL,
  `Color` varchar(15) NOT NULL,
  `Customer_Id` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`Vehicle_No`, `Type`, `Model_Name`, `Year_Of_Manufacture`, `KM`, `Color`, `Customer_Id`) VALUES
('ASDC', 'SUV', 'Honda Livo', 2018, 35000, 'Black', 3),
('KA02KK5981', 'HatchBack', 'Duke 200', 2021, 5400, 'White', 6),
('KA05EU4665', '4W', 'Enova', 2015, 127456, 'White', 2),
('ka11kk0987', 'MUV', 'XASXS', 1235, 123456, 'Blac', 5),
('KA16AF4226', 'Sedan', 'Alto 800', 2011, 50192, 'Sliver White', 7),
('KA18EF7005', '2W', 'Honda Livo', 2018, 30567, 'Black', 1),
('KA18EF7050', 'Sedan', 'Alto 800', 2001, 55698, 'Black', 9);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`Branch_Id`),
  ADD UNIQUE KEY `UNIQUE` (`Phone`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_Id`),
  ADD UNIQUE KEY `Email_Id` (`Email_Id`),
  ADD UNIQUE KEY `Phone` (`Phone`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`Dept_No`),
  ADD UNIQUE KEY `Dname` (`Dname`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Emp_No`),
  ADD KEY `Branch_Id` (`Branch_Id`),
  ADD KEY `Dept_No` (`Dept_No`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`Service_No`) USING BTREE,
  ADD KEY `Brach_Id` (`Brach_Id`),
  ADD KEY `Vehicle_No` (`Vehicle_No`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`Vehicle_No`),
  ADD KEY `Customer_Id` (`Customer_Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `Service_No` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employee`
--
ALTER TABLE `employee`
  ADD CONSTRAINT `employee_ibfk_1` FOREIGN KEY (`Dept_No`) REFERENCES `department` (`Dept_No`) ON DELETE CASCADE,
  ADD CONSTRAINT `employee_ibfk_2` FOREIGN KEY (`Branch_Id`) REFERENCES `branch` (`Branch_Id`) ON DELETE CASCADE;

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `services_ibfk_1` FOREIGN KEY (`Vehicle_No`) REFERENCES `vehicle` (`Vehicle_No`) ON DELETE CASCADE,
  ADD CONSTRAINT `services_ibfk_2` FOREIGN KEY (`Brach_Id`) REFERENCES `branch` (`Branch_Id`) ON DELETE CASCADE;

--
-- Constraints for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`Customer_Id`) REFERENCES `customer` (`Customer_Id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
