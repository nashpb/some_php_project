-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 07, 2020 at 06:12 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tc_salon`
--
CREATE DATABASE IF NOT EXISTS `tc_salon` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `tc_salon`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `admin`
--

TRUNCATE TABLE `admin`;
--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` varchar(200) NOT NULL,
  `appointment_service_type` enum('0','1') NOT NULL,
  `appointment_status` enum('0','1','2','3') NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `appointments`
--

TRUNCATE TABLE `appointments`;
-- --------------------------------------------------------

--
-- Table structure for table `appointment_services_junc`
--

DROP TABLE IF EXISTS `appointment_services_junc`;
CREATE TABLE `appointment_services_junc` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `appointment_services_junc`
--

TRUNCATE TABLE `appointment_services_junc`;
--
-- Dumping data for table `appointment_services_junc`
--

INSERT INTO `appointment_services_junc` (`id`, `appointment_id`, `service_id`) VALUES
(15, 4, 4),
(16, 4, 8),
(17, 5, 5),
(18, 5, 8),
(19, 6, 6),
(20, 9, 4),
(21, 9, 6);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `customers`
--

TRUNCATE TABLE `customers`;
--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `gender`, `phone_no`, `address`) VALUES
(5, 'Nishadh', 'nashpb@gmail.com', 'Male', '9711123789', 'nashpb@gmail.com'),
(6, 'Minq', 'nashpn@gmail.com', 'Male', '9731123897', 'Nska');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `employees`
--

TRUNCATE TABLE `employees`;
--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `phone_no`, `email`) VALUES
(10, 'LOL', '9812198291', 'lom@lom.com');

-- --------------------------------------------------------

--
-- Table structure for table `emp_service_junc`
--

DROP TABLE IF EXISTS `emp_service_junc`;
CREATE TABLE `emp_service_junc` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `emp_service_junc`
--

TRUNCATE TABLE `emp_service_junc`;
-- --------------------------------------------------------

--
-- Table structure for table `salons`
--

DROP TABLE IF EXISTS `salons`;
CREATE TABLE `salons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `salons`
--

TRUNCATE TABLE `salons`;
-- --------------------------------------------------------

--
-- Table structure for table `salon_services_junc`
--

DROP TABLE IF EXISTS `salon_services_junc`;
CREATE TABLE `salon_services_junc` (
  `id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `salon_services_junc`
--

TRUNCATE TABLE `salon_services_junc`;
-- --------------------------------------------------------

--
-- Table structure for table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Truncate table before insert `services`
--

TRUNCATE TABLE `services`;
--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`) VALUES
(14, 'Hair Wash', 'Wash your Hair', '12.00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `user_type` enum('A','E','C') NOT NULL,
  `user_info_id` int(11) NOT NULL,
  `verified` enum('0','1') NOT NULL DEFAULT '0',
  `otp` varchar(6) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `user_type`, `user_info_id`, `verified`, `otp`, `created_at`) VALUES
(7, 'n-1', 'Msdmmshkr@1', 'C', 5, '0', NULL, '2020-04-30 04:27:08'),
(8, 'admin', 'admin', 'A', 0, '0', NULL, '2020-04-30 04:43:24'),
(9, 'minq', 'Msdmmshkr@1', 'C', 6, '0', NULL, '2020-05-06 09:53:16'),
(17, 'essl', 'essl', 'E', 10, '0', NULL, '2020-05-07 06:07:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD UNIQUE KEY `password_UNIQUE` (`password`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment_services_junc`
--
ALTER TABLE `appointment_services_junc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`),
  ADD UNIQUE KEY `phone_no_UNIQUE` (`phone_no`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_no_UNIQUE` (`phone_no`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `emp_service_junc`
--
ALTER TABLE `emp_service_junc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salons`
--
ALTER TABLE `salons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salon_services_junc`
--
ALTER TABLE `salon_services_junc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `appointment_services_junc`
--
ALTER TABLE `appointment_services_junc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `emp_service_junc`
--
ALTER TABLE `emp_service_junc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salons`
--
ALTER TABLE `salons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `salon_services_junc`
--
ALTER TABLE `salon_services_junc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
