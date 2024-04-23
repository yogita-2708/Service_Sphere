-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:8888
-- Generation Time: Apr 23, 2024 at 07:26 PM
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
  `addrs` varchar(255) NOT NULL,
  `geo_location` mediumtext NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `alter_phone` bigint(20) NOT NULL,
  `landmark` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addr_id`, `user_id`, `addrs`, `geo_location`, `name`, `phone`, `alter_phone`, `landmark`) VALUES
(2, 4, 'SANANKO, AUL', '20.3610116,85.8322369', 'Bikash Swain', 7326907009, 7326907009, '');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accesslevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`email`, `password`, `accesslevel`) VALUES
('bikashswain09@gmail.com', 'Bikash@2001', 3);

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
  `end_otp` bigint(6) DEFAULT NULL,
  `address_id` int(11) NOT NULL,
  `total_price` float(7,2) NOT NULL,
  `slot` varchar(20) NOT NULL,
  `sp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`book_id`, `user_id`, `service_id`, `book_date`, `start_time`, `end_time`, `start_otp`, `end_otp`, `address_id`, `total_price`, `slot`, `sp_id`) VALUES
(2, 4, 7, '2024-04-09', '00:00:00', '00:00:00', 1465, 0, 2, 548.90, '8.10', 2),
(3, 4, 9, '2024-04-09', '00:00:00', '00:00:00', 4180, 0, 2, 6598.90, '10.12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
(1, 'Home Maintenance'),
(2, 'Vehicle Repairing'),
(8, 'Hair Spa');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `city_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'Bhubaneswar'),
(2, 'Cuttack'),
(3, 'Rourkela');

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
  `accesslevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`user_id`, `user_name`, `user_email`, `user_password`, `user_mob`, `user_type`, `accesslevel`) VALUES
(4, 'Yogita', 'yogita@gmail.com', 'Yog@2708', 7325800401, 'user', 1),
(6, 'K Yamuna', 'yamuna@gmail.com', 'Yamuna@27', 7326907001, 'user', 1);

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

--
-- Dumping data for table `cus_sp_review`
--

INSERT INTO `cus_sp_review` (`review_id`, `book_id`, `user_id`, `sp_id`, `rating`, `comment`, `review_date`) VALUES
(1, 2, 4, 2, 4.20, 'Fantastic work and value for money.', '2024-04-10');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `inbox_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`inbox_id`, `name`, `email`, `subject`, `message`) VALUES
(5, 'Bikash Swain', 'bikash@gmail.com', 'Reset My Password', 'fnewfwf fksjfa aofvia'),
(7, 'Stuti Biswal', 'stuti01@gmail.com', 'Preventative maintenance agreement', 'Can you provide details about preventative measurements..');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `notify_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `date` varchar(15) NOT NULL,
  `time` varchar(15) NOT NULL,
  `stat` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`notify_id`, `user_id`, `subject`, `message`, `date`, `time`, `stat`) VALUES
(3, 4, 'Confirmation', 'Thank You for joining us...', '07 Apr 2024', '10:51 AM', 'NO');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `s_name` varchar(255) NOT NULL,
  `s_desc` longtext NOT NULL,
  `cat_id` int(11) NOT NULL,
  `s_duration` time NOT NULL,
  `sp_id` int(11) NOT NULL,
  `picture` longblob NOT NULL,
  `s_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `s_name`, `s_desc`, `cat_id`, `s_duration`, `sp_id`, `picture`, `s_status`) VALUES
(7, 'Wheel Swap', 'Experience seamless tyre changes with our professional tyre changer service. Our skilled technicians guarantee swift and effective tyre replacements, ensuring your vehicle\'s safety and readiness. We provide thorough tyre inspections to detect any potential issues, offer optimal performance and longevity.', 2, '00:30:00', 2, 0x74797265736572766963652e6a7067, 'YES'),
(9, 'Wall Painting', 'We specialize in professional wall painting services, delivering top-quality results for both interior and exterior spaces. Our expert team ensures meticulous attention to detail and uses premium paints and techniques to achieve stunning transformations that enhance any environment.', 1, '04:00:00', 1, 0x7061696e74696e67322e6a7067, 'YES'),
(10, 'Electrical Maintenance', 'Our electrical maintenance service ensures the smooth functioning and safety of your electrical systems in residential and commercial settings. From routine inspections to preventive repairs, we provide comprehensive solutions to ensure the longevity of your electrical infrastructure.', 1, '01:30:00', 3, 0x656c6563747269632e6a706567, 'YES'),
(11, 'Mechanical Repairing', 'Our mechanical repair service offers expert solutions for a wide range of mechanical issues in vehicles. From engine repairs to transmission maintenance and brake system overhauls, our skilled technicians ensure efficient and reliable repairs to keep your equipment running smoothly.', 2, '00:40:00', 2, 0x73657276696365322e6a706567, 'YES'),
(12, 'PipeWorks Plumbing Services', 'PipeWorks Plumbing Services provides reliable and professional plumbing solutions for residential and commercial customers. With a team of experienced plumbers, we offer a wide range of services including repairs, and maintenance to ensure optimal functionality of plumbing systems.', 1, '00:25:00', 4, 0x706c756d62696e672e6a706567, 'YES'),
(16, 'Shampooing', 'Indulge in the ultimate relaxation with a hair spa shampooing experience. Let your worries wash away as skilled hands massage nourishing shampoo into your locks, revitalizing your hair from root to tip. Treat yourself to the luxury your hair deserves.', 8, '00:40:00', 1, 0x686169725f7370615f7368616d706f6f696e672e6a7067, 'YES');

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
  `accesslevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_provider`
--

INSERT INTO `service_provider` (`sp_id`, `sp_name`, `sp_email`, `sp_phone`, `sp_password`, `user_type`, `accesslevel`) VALUES
(1, 'Bikash Swain', 'bikash@gmail.com', 8754320912, 'Bikash@27', 'service_provider', 2),
(2, 'Bhaskar', 'bhaskar@gmail.com', 9543210428, 'Bhaskar@27', 'service_provider', 2),
(3, 'Stuti Biswal', 'stuti01@gmail.com', 7623901845, 'Stuti@0102', 'service_provider', 2),
(4, 'Gaurav Singh', 'gaurav30@gmail.com', 7723459016, 'Gaurav@3008', 'service_provider', 2),
(5, 'K Yogita', 'kyogita@gmail.com', 6739889291, 'kyogita@2024', 'service_provider', 2);

-- --------------------------------------------------------

--
-- Table structure for table `service_service_provider`
--

CREATE TABLE `service_service_provider` (
  `service_id` int(11) NOT NULL,
  `sp_id` int(11) NOT NULL,
  `s_price` float(7,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `service_service_provider`
--

INSERT INTO `service_service_provider` (`service_id`, `sp_id`, `s_price`, `status`) VALUES
(6, 1, 550.00, 'YES'),
(6, 2, 599.00, 'YES'),
(7, 2, 498.00, 'YES'),
(9, 1, 5999.00, 'YES'),
(10, 3, 599.00, 'YES'),
(11, 2, 1099.00, 'YES'),
(12, 4, 449.00, 'YES'),
(7, 1, 449.00, 'YES'),
(9, 4, 7099.00, 'YES'),
(16, 1, 1500.00, 'YES'),
(16, 3, 599.00, 'YES'),
(7, 3, 449.00, 'NO'),
(12, 3, 1099.00, 'NO'),
(16, 4, 400.00, 'NO');

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

-- --------------------------------------------------------

--
-- Table structure for table `user_block`
--

CREATE TABLE `user_block` (
  `block_id` int(11) NOT NULL,
  `email_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_block`
--

INSERT INTO `user_block` (`block_id`, `email_id`) VALUES
(6, 'yamuna@gmail.com');

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
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`city_id`),
  ADD UNIQUE KEY `city_name` (`city_name`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `foreign_key_c1` (`user_type`),
  ADD KEY `foreign_key_c2` (`accesslevel`);

--
-- Indexes for table `cus_sp_review`
--
ALTER TABLE `cus_sp_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `foreign_key_rc1` (`book_id`),
  ADD KEY `foreign_key_rc2` (`sp_id`),
  ADD KEY `foreign_key_rc3` (`user_id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`inbox_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`notify_id`),
  ADD KEY `foreign_key_not` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `foreign_key_s1` (`cat_id`);

--
-- Indexes for table `service_provider`
--
ALTER TABLE `service_provider`
  ADD PRIMARY KEY (`sp_id`),
  ADD UNIQUE KEY `sp_email` (`sp_email`),
  ADD KEY `foreign_key_sp2` (`user_type`),
  ADD KEY `foreign_key_sp3` (`accesslevel`);

--
-- Indexes for table `sp_cus_review`
--
ALTER TABLE `sp_cus_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `foreign_key_rv1` (`book_id`),
  ADD KEY `foreign_key_rv2` (`user_id`),
  ADD KEY `foreign_key_rv3` (`sp_id`);

--
-- Indexes for table `user_block`
--
ALTER TABLE `user_block`
  ADD PRIMARY KEY (`block_id`),
  ADD UNIQUE KEY `email_id` (`email_id`);

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
  MODIFY `addr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `city_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cus_sp_review`
--
ALTER TABLE `cus_sp_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inbox`
--
ALTER TABLE `inbox`
  MODIFY `inbox_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `service_provider`
--
ALTER TABLE `service_provider`
  MODIFY `sp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sp_cus_review`
--
ALTER TABLE `sp_cus_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_block`
--
ALTER TABLE `user_block`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `foreign_key_c2` FOREIGN KEY (`accesslevel`) REFERENCES `access_level` (`accesslevel`);

--
-- Constraints for table `cus_sp_review`
--
ALTER TABLE `cus_sp_review`
  ADD CONSTRAINT `foreign_key_rc1` FOREIGN KEY (`book_id`) REFERENCES `booking` (`book_id`),
  ADD CONSTRAINT `foreign_key_rc2` FOREIGN KEY (`sp_id`) REFERENCES `service_provider` (`sp_id`),
  ADD CONSTRAINT `foreign_key_rc3` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `foreign_key_not` FOREIGN KEY (`user_id`) REFERENCES `customer` (`user_id`);

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
  ADD CONSTRAINT `foreign_key_sp2` FOREIGN KEY (`user_type`) REFERENCES `access_level` (`user_type`),
  ADD CONSTRAINT `foreign_key_sp3` FOREIGN KEY (`accesslevel`) REFERENCES `access_level` (`accesslevel`);

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
