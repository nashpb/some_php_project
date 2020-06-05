-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 05, 2020 at 03:27 AM
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

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

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
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `cust_id`, `appointment_date`, `appointment_time`, `appointment_service_type`, `appointment_status`, `emp_id`, `created`) VALUES
(10, 6, '2020-05-10', '12:10 AM', '0', '3', NULL, '2020-05-10 18:10:55'),
(11, 6, '2020-05-10', '12:10 AM', '0', '3', NULL, '2020-05-10 18:11:45'),
(12, 5, '2020-05-16', '12:07 PM', '0', '3', NULL, '2020-05-16 06:47:55'),
(13, 5, '2020-05-16', '12:47 PM', '0', '3', NULL, '2020-05-16 06:53:14'),
(14, 5, '2020-05-16', '12:47 PM', '0', '3', NULL, '2020-05-16 06:55:15'),
(15, 5, '2020-05-16', '12:47 PM', '0', '3', NULL, '2020-05-16 06:56:11'),
(16, 5, '2020-05-16', '12:47 PM', '1', '3', NULL, '2020-05-16 07:04:32'),
(17, 5, '2020-05-16', '12:47 PM', '1', '3', NULL, '2020-05-16 07:05:11'),
(18, 5, '2020-05-16', '12:47 PM', '1', '3', NULL, '2020-05-16 07:05:35'),
(19, 5, '2020-05-16', '12:47 PM', '1', '3', NULL, '2020-05-16 07:06:02'),
(20, 5, '2020-05-16', '12:47 PM', '1', '3', NULL, '2020-05-16 07:07:14'),
(22, 5, '2020-05-21', '7:15 AM', '1', '2', 10, '2020-05-21 01:32:09'),
(23, 5, '2020-05-21', '10:49 AM', '1', '3', NULL, '2020-05-21 04:50:50'),
(24, 5, '2020-05-21', '10:51 AM', '1', '3', NULL, '2020-05-21 04:51:43'),
(25, 5, '2020-05-21', '10:51 AM', '1', '3', NULL, '2020-05-21 04:52:32'),
(26, 5, '2020-05-21', '10:52 AM', '1', '3', NULL, '2020-05-21 04:56:04'),
(27, 5, '2020-05-21', '10:52 AM', '1', '3', NULL, '2020-05-21 04:59:28'),
(28, 5, '2020-05-21', '10:59 AM', '1', '3', NULL, '2020-05-21 05:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_services_junc`
--

CREATE TABLE `appointment_services_junc` (
  `id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(21, 9, 6),
(22, 10, 14),
(23, 11, 14),
(24, 12, 14),
(25, 12, 20),
(26, 12, 21),
(27, 13, 14),
(28, 14, 14),
(29, 15, 14),
(30, 16, 14),
(31, 17, 14),
(32, 18, 14),
(33, 19, 14),
(34, 20, 14),
(36, 22, 14),
(37, 22, 20),
(38, 22, 21),
(39, 23, 14),
(40, 24, 14),
(41, 24, 20),
(42, 24, 21),
(43, 25, 14),
(44, 25, 20),
(45, 25, 21),
(46, 26, 14),
(47, 26, 20),
(48, 26, 21),
(49, 27, 14),
(50, 27, 20),
(51, 27, 21),
(52, 28, 14),
(53, 28, 20),
(54, 28, 21);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(250) NOT NULL,
  `phone_no` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `gender`, `phone_no`, `address`) VALUES
(5, 'Nishad', 'nashpb@gmail.com', 'Female', '9731134958', 'nashpb@gmail.com'),
(6, 'Minq', 'nashpn@gmail.com', 'Male', '9731123897', 'Nska');

-- --------------------------------------------------------

--
-- Table structure for table `customer_payment`
--

CREATE TABLE `customer_payment` (
  `id` int(11) NOT NULL,
  `app_id` int(11) NOT NULL,
  `card_number` varchar(250) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_payment`
--

INSERT INTO `customer_payment` (`id`, `app_id`, `card_number`, `amount`, `created_at`) VALUES
(1, 15, '4716 1089 9971 6531', '12.00', '2020-05-16 06:56:11'),
(2, 23, '4716 1089 9971 6531', '13.00', '2020-05-21 04:50:50'),
(3, 27, '4716 1089 9971 6531', '48.00', '2020-05-21 04:59:28'),
(4, 28, '4716 1089 9971 6531', '48.00', '2020-05-21 05:00:12');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_no` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `designation` varchar(250) NOT NULL,
  `gender` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `phone_no`, `email`, `designation`, `gender`) VALUES
(10, 'LOL', '9812198291', 'lom@lom.com', 'HRI', 'Male'),
(15, 'LLO', '7188978379', 'midhunnoble@gmail.com', 'HOD', 'Male');

-- --------------------------------------------------------

--
-- Table structure for table `emp_service_junc`
--

CREATE TABLE `emp_service_junc` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salons`
--

CREATE TABLE `salons` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `salon_services_junc`
--

CREATE TABLE `salon_services_junc` (
  `id` int(11) NOT NULL,
  `salon_id` int(11) NOT NULL,
  `services_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` decimal(5,2) NOT NULL,
  `gender` varchar(250) NOT NULL DEFAULT 'Female'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`, `price`, `gender`) VALUES
(14, 'Hair Wash', 'Wash your Hair', '13.00', 'Female'),
(20, 'Hair Dry', 'Dry', '20.00', 'Female'),
(21, 'Hair Colour', 'Colour Hair', '15.00', 'Female'),
(22, 'Hair Wash returns', 'Wash your Hair again', '30.00', 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

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
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `user_type`, `user_info_id`, `verified`, `otp`, `created_at`) VALUES
(7, 'n-1', 'nash4958', 'C', 5, '0', NULL, '2020-04-30 04:27:08'),
(8, 'admin', 'admin', 'A', 0, '0', NULL, '2020-04-30 04:43:24'),
(9, 'minq', 'Msdmmshkr@1', 'C', 6, '0', NULL, '2020-05-06 09:53:16'),
(17, 'essl', 'essl', 'E', 10, '0', NULL, '2020-05-07 06:07:37'),
(20, 'lll', 'lll', 'E', 13, '0', NULL, '2020-06-05 02:42:49'),
(22, 'll', 'll', 'E', 15, '0', NULL, '2020-06-05 02:47:26');

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
-- Indexes for table `customer_payment`
--
ALTER TABLE `customer_payment`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `appointment_services_junc`
--
ALTER TABLE `appointment_services_junc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `customer_payment`
--
ALTER TABLE `customer_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
