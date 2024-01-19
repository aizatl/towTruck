-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 11, 2024 at 10:45 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminID` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminID`, `username`, `password`) VALUES
(2, 'aizat', 'aizat');

-- --------------------------------------------------------

--
-- Table structure for table `billing`
--

CREATE TABLE `billing` (
  `billing_id` int NOT NULL,
  `customer_id` int NOT NULL,
  `issue_date` date NOT NULL,
  `due_date` date NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `totalAmountPaid` int NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `billing`
--

INSERT INTO `billing` (`billing_id`, `customer_id`, `issue_date`, `due_date`, `total_amount`, `totalAmountPaid`, `status`) VALUES
(1, 1, '2024-01-02', '2024-01-09', '100.00', 100, 'paid'),
(2, 2, '2024-01-03', '2024-01-09', '200.00', 10, 'partially'),
(3, 5, '2024-01-11', '2024-01-25', '220124.20', 0, 'paid'),
(4, 5, '2024-01-11', '2024-01-25', '220124.20', 0, 'paid'),
(5, 5, '2024-01-11', '2024-01-25', '220124.20', 0, 'partially'),
(6, 5, '2024-01-11', '2024-01-25', '220134.20', 0, 'partially'),
(7, 1, '2024-01-11', '2024-01-25', '139.40', 0, 'paid'),
(8, 1, '2024-01-11', '2024-01-25', '139.40', 50, 'partially'),
(9, 1, '2024-01-11', '2024-01-25', '139.40', 50, 'partially'),
(10, 1, '2024-01-11', '2024-01-25', '139.40', 139, 'paid');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `cost_id` int NOT NULL,
  `ServiceType_ID` int NOT NULL,
  `cost_base_rate` decimal(10,2) NOT NULL,
  `cost_distance_rate` decimal(10,2) NOT NULL,
  `cost_urgency_rate` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`cost_id`, `ServiceType_ID`, `cost_base_rate`, `cost_distance_rate`, `cost_urgency_rate`) VALUES
(1, 1, '100.00', '1.10', '1.50'),
(2, 2, '125.00', '1.20', '1.20');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Customer_ID` int NOT NULL,
  `Customer_FirstName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Customer_LastName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Customer_PhoneNum` int NOT NULL,
  `Customer_Address` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Customer_ID`, `Customer_FirstName`, `Customer_LastName`, `Customer_PhoneNum`, `Customer_Address`) VALUES
(1, 'aizat', 'nasir', 123, 'tanjung malim'),
(2, 'badrul', 'cetiak', 456, 'cheng'),
(4, 'wan', 'kang', 222, 'kulim'),
(5, 'hairil', 'din', 333, 'bidor'),
(6, 'jiqos', 'petro', 9524, 'tapah');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `Driver_ID` int NOT NULL,
  `Driver_FirstName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Driver_LastName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `Driver_LicenseNumber` int NOT NULL,
  `Driver_PhoneNumber` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`Driver_ID`, `Driver_FirstName`, `Driver_LastName`, `Driver_LicenseNumber`, `Driver_PhoneNumber`) VALUES
(1, 'aizat', 'nasir', 666, 174608719),
(2, 'haziq', 'petro', 999, 12345),
(3, 'fadli', 'fadlo', 111764, 85236);

-- --------------------------------------------------------

--
-- Table structure for table `driver_assignment`
--

CREATE TABLE `driver_assignment` (
  `DriverAssign_ID` int NOT NULL,
  `TowTruckID` int NOT NULL,
  `Driver_ID` int NOT NULL,
  `Towing_Request_ID` int NOT NULL,
  `DriverAssign_Time` datetime NOT NULL,
  `DriverAssign_Details` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `DriverAssign_Location` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `DriverAssign_Duration` datetime NOT NULL,
  `ServiceType_ID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `driver_assignment`
--

INSERT INTO `driver_assignment` (`DriverAssign_ID`, `TowTruckID`, `Driver_ID`, `Towing_Request_ID`, `DriverAssign_Time`, `DriverAssign_Details`, `DriverAssign_Location`, `DriverAssign_Duration`, `ServiceType_ID`) VALUES
(2, 2, 2, 2, '2024-01-09 20:08:03', 'buang', 'meru', '2024-01-09 20:08:03', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_transaction`
--

CREATE TABLE `payment_transaction` (
  `transaction_id` int NOT NULL,
  `billing_id` int NOT NULL,
  `TowTruckAssign_ID` int NOT NULL,
  `payment_date` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment_transaction`
--

INSERT INTO `payment_transaction` (`transaction_id`, `billing_id`, `TowTruckAssign_ID`, `payment_date`, `amount`, `payment_method`) VALUES
(1, 1, 2, '2024-01-09', '100.00', 'cash'),
(2, 1, 3, '2024-01-09', '200.00', 'debit'),
(3, 4, 5, '2024-01-11', '220124.20', 'cash'),
(4, 5, 3, '2024-01-11', '220124.20', 'cash'),
(5, 6, 9, '2024-01-11', '220134.20', 'credit'),
(6, 7, 10, '2024-01-11', '139.40', 'cash'),
(7, 8, 11, '2024-01-11', '139.40', 'cash'),
(8, 9, 11, '2024-01-11', '139.40', 'cash'),
(9, 10, 11, '2024-01-11', '139.40', 'debit'),
(10, 10, 11, '2024-01-11', '20.00', 'cash'),
(11, 10, 11, '2024-01-11', '20.40', 'credit');

-- --------------------------------------------------------

--
-- Table structure for table `service_type`
--

CREATE TABLE `service_type` (
  `ServiceType_ID` int NOT NULL,
  `ServiceType_Name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ServiceType_Description` varchar(300) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_type`
--

INSERT INTO `service_type` (`ServiceType_ID`, `ServiceType_Name`, `ServiceType_Description`) VALUES
(1, 'Flatbed tow service', 'guna Flatbed tow service'),
(2, 'Hook and Chain service', 'guna Hook and Chain service');

-- --------------------------------------------------------

--
-- Table structure for table `towing_request`
--

CREATE TABLE `towing_request` (
  `Towing_Request_ID` int NOT NULL,
  `Customer_ID` int NOT NULL,
  `ServiceType_ID` int NOT NULL,
  `Request_Date` date NOT NULL,
  `Request_Time` time NOT NULL,
  `Pickup_Location` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `Reason_For_Tow` varchar(300) COLLATE utf8mb4_general_ci NOT NULL,
  `Request_Urgency` tinyint(1) NOT NULL,
  `Request_Distance` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `towing_request`
--

INSERT INTO `towing_request` (`Towing_Request_ID`, `Customer_ID`, `ServiceType_ID`, `Request_Date`, `Request_Time`, `Pickup_Location`, `Reason_For_Tow`, `Request_Urgency`, `Request_Distance`) VALUES
(2, 5, 1, '2024-01-09', '19:57:40', 'mana', 'ninggoi', 0, 200022),
(3, 1, 2, '2024-10-05', '18:35:00', 'kajang', 'rosak', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `tow_truck`
--

CREATE TABLE `tow_truck` (
  `TowTruck_ID` int NOT NULL,
  `TowTruck_Registration_Number` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `TowTruck_Brand` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `TowTruck_Model` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `TowTruck_Availability_Status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tow_truck`
--

INSERT INTO `tow_truck` (`TowTruck_ID`, `TowTruck_Registration_Number`, `TowTruck_Brand`, `TowTruck_Model`, `TowTruck_Availability_Status`) VALUES
(1, 'abc123', 'proton', 'x70', 0),
(2, 'abc345', 'perodua', 'kancil', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tow_truck_assignment`
--

CREATE TABLE `tow_truck_assignment` (
  `TowTruckAssign_ID` int NOT NULL,
  `Driver_ID` int NOT NULL,
  `TowTruck_ID` int NOT NULL,
  `Towing_Request_ID` int NOT NULL,
  `billing_id` int DEFAULT NULL,
  `TowTruckAssign_Time` time NOT NULL,
  `TowTruckAssign_Details` varchar(200) COLLATE utf8mb4_general_ci NOT NULL,
  `TowTruckAssign_Location` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `TowTruckAssign_Duration` decimal(65,0) NOT NULL,
  `ServiceType_ID` int NOT NULL,
  `vehicle_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `assigmentStatus` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tow_truck_assignment`
--

INSERT INTO `tow_truck_assignment` (`TowTruckAssign_ID`, `Driver_ID`, `TowTruck_ID`, `Towing_Request_ID`, `billing_id`, `TowTruckAssign_Time`, `TowTruckAssign_Details`, `TowTruckAssign_Location`, `TowTruckAssign_Duration`, `ServiceType_ID`, `vehicle_type`, `assigmentStatus`) VALUES
(2, 2, 2, 2, 1, '20:12:57', 'buang aizat', 'meru', '12', 2, 'sedan', 'done'),
(3, 1, 1, 2, 2, '02:23:00', 'sadsadadsadasdas', 'asdsadasdasdas', '4', 1, 'sedan', 'done'),
(5, 2, 2, 2, 3, '16:43:00', 'TAMBAH', 'vbvbc', '3', 2, 'suv', 'done'),
(6, 2, 2, 2, 4, '05:21:00', 'daddadada', 'meru', '32323', 1, 'mpv', 'done'),
(7, 2, 2, 2, 5, '15:25:00', 'tamah status', 'status', '45', 2, 'suv', 'done'),
(8, 2, 2, 3, 6, '17:28:20', 'mencubaaizat', 'mencubaaizat', '25', 2, 'suv', 'done'),
(9, 1, 1, 2, 7, '19:10:00', 'bcvbcvbvcbcvbvcb', 'vcbcvbcvbvcb', '3434', 1, 'mpv', 'done'),
(10, 2, 2, 3, NULL, '01:16:00', 'bcvbcvbvcbcvbvcb', 'vcbcvbcvbvcb', '3434', 1, 'mpv', 'ongoing'),
(11, 3, 2, 3, 10, '04:25:00', 'try untuk remaining', 'try untuk remaining', '21', 1, 'mpv', 'done');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `billing`
--
ALTER TABLE `billing`
  ADD PRIMARY KEY (`billing_id`),
  ADD KEY `qq` (`customer_id`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`cost_id`),
  ADD KEY `bnm` (`ServiceType_ID`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Customer_ID`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`Driver_ID`);

--
-- Indexes for table `driver_assignment`
--
ALTER TABLE `driver_assignment`
  ADD PRIMARY KEY (`DriverAssign_ID`),
  ADD KEY `1` (`TowTruckID`),
  ADD KEY `2` (`Driver_ID`),
  ADD KEY `3` (`Towing_Request_ID`),
  ADD KEY `4` (`ServiceType_ID`);

--
-- Indexes for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `bil` (`billing_id`),
  ADD KEY `tr` (`TowTruckAssign_ID`);

--
-- Indexes for table `service_type`
--
ALTER TABLE `service_type`
  ADD PRIMARY KEY (`ServiceType_ID`);

--
-- Indexes for table `towing_request`
--
ALTER TABLE `towing_request`
  ADD PRIMARY KEY (`Towing_Request_ID`),
  ADD KEY `test` (`Customer_ID`),
  ADD KEY `test1` (`ServiceType_ID`);

--
-- Indexes for table `tow_truck`
--
ALTER TABLE `tow_truck`
  ADD PRIMARY KEY (`TowTruck_ID`);

--
-- Indexes for table `tow_truck_assignment`
--
ALTER TABLE `tow_truck_assignment`
  ADD PRIMARY KEY (`TowTruckAssign_ID`),
  ADD KEY `11` (`Driver_ID`),
  ADD KEY `22` (`TowTruck_ID`),
  ADD KEY `33` (`Towing_Request_ID`),
  ADD KEY `44` (`ServiceType_ID`),
  ADD KEY `55` (`billing_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billing`
--
ALTER TABLE `billing`
  MODIFY `billing_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `cost_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Customer_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `Driver_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `driver_assignment`
--
ALTER TABLE `driver_assignment`
  MODIFY `DriverAssign_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  MODIFY `transaction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service_type`
--
ALTER TABLE `service_type`
  MODIFY `ServiceType_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `towing_request`
--
ALTER TABLE `towing_request`
  MODIFY `Towing_Request_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tow_truck`
--
ALTER TABLE `tow_truck`
  MODIFY `TowTruck_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tow_truck_assignment`
--
ALTER TABLE `tow_truck_assignment`
  MODIFY `TowTruckAssign_ID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `billing`
--
ALTER TABLE `billing`
  ADD CONSTRAINT `qq` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cost`
--
ALTER TABLE `cost`
  ADD CONSTRAINT `bnm` FOREIGN KEY (`ServiceType_ID`) REFERENCES `service_type` (`ServiceType_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `driver_assignment`
--
ALTER TABLE `driver_assignment`
  ADD CONSTRAINT `1` FOREIGN KEY (`TowTruckID`) REFERENCES `tow_truck` (`TowTruck_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `2` FOREIGN KEY (`Driver_ID`) REFERENCES `driver` (`Driver_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `3` FOREIGN KEY (`Towing_Request_ID`) REFERENCES `towing_request` (`Towing_Request_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `4` FOREIGN KEY (`ServiceType_ID`) REFERENCES `service_type` (`ServiceType_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_transaction`
--
ALTER TABLE `payment_transaction`
  ADD CONSTRAINT `bil` FOREIGN KEY (`billing_id`) REFERENCES `billing` (`billing_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tr` FOREIGN KEY (`TowTruckAssign_ID`) REFERENCES `tow_truck_assignment` (`TowTruckAssign_ID`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `towing_request`
--
ALTER TABLE `towing_request`
  ADD CONSTRAINT `test` FOREIGN KEY (`Customer_ID`) REFERENCES `customer` (`Customer_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `test1` FOREIGN KEY (`ServiceType_ID`) REFERENCES `service_type` (`ServiceType_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tow_truck_assignment`
--
ALTER TABLE `tow_truck_assignment`
  ADD CONSTRAINT `11` FOREIGN KEY (`Driver_ID`) REFERENCES `driver` (`Driver_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `22` FOREIGN KEY (`TowTruck_ID`) REFERENCES `tow_truck` (`TowTruck_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `33` FOREIGN KEY (`Towing_Request_ID`) REFERENCES `towing_request` (`Towing_Request_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `44` FOREIGN KEY (`ServiceType_ID`) REFERENCES `service_type` (`ServiceType_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `55` FOREIGN KEY (`billing_id`) REFERENCES `billing` (`billing_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
