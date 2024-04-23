-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8888
-- Generation Time: Mar 18, 2024 at 06:59 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `servicesphere`
--

-- --------------------------------------------------------

--
-- Table structure for table `access_level`
--

CREATE TABLE `access_level` (
  `access_id` int(11) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `accesslevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `access_level`
--

INSERT INTO `access_level` (`access_id`, `user_type`, `accesslevel`) VALUES
(1, 'admin', 3),
(2, 'service_provider', 2),
(6, 'user', 1);

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addr_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `addrs` int(11) NOT NULL,
  `geo_location` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accesslevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `book_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `start_otp` bigint(6) NOT NULL,
  `end_otp` bigint(6) NOT NULL,
  `address_id` int(11) NOT NULL,
  `total_price` float(7,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_mob` bigint(11) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `access_token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cus_sp_review`
--

CREATE TABLE `cus_sp_review` (
  `review_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `rating` float(4,2) NOT NULL,
  `comment` mediumtext NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_desc` longtext NOT NULL,
  `cat_id` int(11) NOT NULL,
  `s_price` float(7,2) NOT NULL,
  `s_duration` time NOT NULL,
  `sp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

CREATE TABLE `service_provider` (
  `sp_id` int(11) NOT NULL,
  `sp_name` varchar(255) NOT NULL,
  `sp_email` varchar(255) NOT NULL,
  `sp_phone` bigint(11) NOT NULL,
  `sp_password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `access_token` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sp_cus_review`
--

CREATE TABLE `sp_cus_review` (
  `review_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `rating` float(4,2) NOT NULL,
  `comment` mediumtext NOT NULL,
  `review_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `access_level`
--
ALTER TABLE `access_level`
  ADD PRIMARY KEY (`access_id`),
  ADD UNIQUE KEY `accesslevel` (`accesslevel`),
  ADD UNIQUE KEY `user_type` (`user_type`);

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addr_id`),
  ADD KEY `foreign_key_addr1` (`user_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`email`),
  ADD KEY `foreign_key` (`accesslevel`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `foreign_key_bk1` (`address_id`),
  ADD KEY `foreign_key_bk2` (`user_id`),
  ADD KEY `foreign_key_bk3` (`service_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `foreign_key_c1` (`user_type`),
  ADD KEY `foreign_key_c2` (`access_token`);

--
-- Indexes for table `cus_sp_review`
--
ALTER TABLE `cus_sp_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `foreign_key_rc1` (`book_id`),
  ADD KEY `foreign_key_rc2` (`sp_id`),
  ADD KEY `foreign_key_rc3` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `foreign_key_s1` (`cat_id`),
  ADD KEY `foreign_key_s2` (`sp_id`);

--
-- Indexes for table `service_provider`
--
ALTER TABLE `service_provider`
  ADD PRIMARY KEY (`sp_id`),
  ADD UNIQUE KEY `sp_email` (`sp_email`),
  ADD KEY `foreign_key_sp1` (`access_token`),
  ADD KEY `foreign_key_sp2` (`user_type`);

--
-- Indexes for table `sp_cus_review`
--
ALTER TABLE `sp_cus_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `foreign_key_rv1` (`book_id`),
  ADD KEY `foreign_key_rv2` (`user_id`),
  ADD KEY `foreign_key_rv3` (`sp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `access_level`
--
ALTER TABLE `access_level`
  MODIFY `access_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addr_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cus_sp_review`
--
ALTER TABLE `cus_sp_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_provider`
--
ALTER TABLE `service_provider`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sp_cus_review`
--
ALTER TABLE `sp_cus_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `foreign_key_addr1` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`);

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `foreign_key` FOREIGN KEY (`accesslevel`) REFERENCES `access_level` (`accesslevel`);

--
-- Constraints for table `booking`
--
ALTER TABLE `booking`
  ADD CONSTRAINT `foreign_key_bk1` FOREIGN KEY (`address_id`) REFERENCES `address` (`addr_id`),
  ADD CONSTRAINT `foreign_key_bk2` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`),
  ADD CONSTRAINT `foreign_key_bk3` FOREIGN KEY (`service_id`) REFERENCES `services` (`service_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `foreign_key_c1` FOREIGN KEY (`user_type`) REFERENCES `access_level` (`user_type`),
  ADD CONSTRAINT `foreign_key_c2` FOREIGN KEY (`access_token`) REFERENCES `access_level` (`accesslevel`);

--
-- Constraints for table `cus_sp_review`
--
ALTER TABLE `cus_sp_review`
  ADD CONSTRAINT `foreign_key_rc1` FOREIGN KEY (`book_id`) REFERENCES `booking` (`book_id`),
  ADD CONSTRAINT `foreign_key_rc2` FOREIGN KEY (`sp_id`) REFERENCES `service_provider` (`sp_id`),
  ADD CONSTRAINT `foreign_key_rc3` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`);

--
-- Constraints for table `services`
--
ALTER TABLE `services`
  ADD CONSTRAINT `foreign_key_s1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`),
  ADD CONSTRAINT `foreign_key_s2` FOREIGN KEY (`sp_id`) REFERENCES `service_provider` (`sp_id`);

--
-- Constraints for table `service_provider`
--
ALTER TABLE `service_provider`
  ADD CONSTRAINT `foreign_key_sp1` FOREIGN KEY (`access_token`) REFERENCES `access_level` (`accesslevel`),
  ADD CONSTRAINT `foreign_key_sp2` FOREIGN KEY (`user_type`) REFERENCES `access_level` (`user_type`);

--
-- Constraints for table `sp_cus_review`
--
ALTER TABLE `sp_cus_review`
  ADD CONSTRAINT `foreign_key_rv1` FOREIGN KEY (`book_id`) REFERENCES `booking` (`book_id`),
  ADD CONSTRAINT `foreign_key_rv2` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`),
  ADD CONSTRAINT `foreign_key_rv3` FOREIGN KEY (`sp_id`) REFERENCES `service_provider` (`sp_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
