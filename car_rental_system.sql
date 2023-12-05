-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2023 at 05:42 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_accounts`
--

CREATE TABLE `admin_accounts` (
  `admin_id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_accounts`
--

INSERT INTO `admin_accounts` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$r.IRSWm7z0U/xOXFRXPKI.SWAHfiRWNbS5OlU2WPxpfIcRPBSl2I6'),
(2, 'marco', '$2y$10$Ddt6RiBxMjq8Gja9tKqu.OBJ5dw0m4SgVVEdl3H1AmmvQdaZIGWxi');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `carId` int(11) NOT NULL,
  `carName` varchar(100) DEFAULT NULL,
  `brand` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `yearModel` int(11) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`carId`, `carName`, `brand`, `model`, `yearModel`, `color`) VALUES
(1, 'Car 1', 'Toyota', '1GD-FTV', 2023, 'Gray');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customerId` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `number` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerId`, `name`, `number`) VALUES
(1, 'Yvan Anuyo', '2147483647'),
(2, 'Don-Don Maranan', '2147483647'),
(3, 'Miko Salangsang', '2147483647'),
(4, 'maria clara', '2147483647'),
(5, 'Pedro', '9214573438');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `rentalId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `carId` int(11) DEFAULT NULL,
  `borrowDate` date DEFAULT NULL,
  `returnDate` date DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `fine_per_day` decimal(10,2) DEFAULT NULL,
  `dateReturned` date DEFAULT NULL,
  `penalty` decimal(10,2) DEFAULT NULL,
  `grossIncome` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`rentalId`, `customerId`, `carId`, `borrowDate`, `returnDate`, `price`, `fine_per_day`, `dateReturned`, `penalty`, `grossIncome`, `status`) VALUES
(1, 1, 1, '2023-12-05', '2023-12-06', '5000.00', '5000.00', '2023-12-06', '0.00', '5000.00', 'completed'),
(2, 2, 1, '2023-12-05', '2023-12-06', '5000.00', '5000.00', '2023-12-06', '0.00', '5000.00', 'completed'),
(3, 3, 1, '2023-12-05', '2023-12-06', '7000.00', '7000.00', '2023-12-06', '0.00', NULL, 'completed'),
(4, 4, 1, '2023-12-05', '2023-12-07', '6000.00', '6000.00', NULL, NULL, NULL, 'upcoming'),
(5, 5, 1, '2023-12-05', '2023-12-06', '5000.00', '5000.00', NULL, NULL, NULL, 'ongoing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`carId`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`rentalId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `carId` (`carId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_accounts`
--
ALTER TABLE `admin_accounts`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `carId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `rentalId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customers` (`customerId`),
  ADD CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`carId`) REFERENCES `cars` (`carId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
