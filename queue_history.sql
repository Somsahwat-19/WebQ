-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2024 at 09:18 AM
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
-- Database: `queue_aoi`
--

-- --------------------------------------------------------

--
-- Table structure for table `queue_history`
--

CREATE TABLE `queue_history` (
  `id` int(11) NOT NULL,
  `normal_queue_start` int(11) NOT NULL,
  `normal_queue_end` int(11) NOT NULL,
  `missed_queue_start` int(11) NOT NULL,
  `missed_queue_end` int(11) NOT NULL,
  `failed_queue_start` int(11) NOT NULL,
  `failed_queue_end` int(11) NOT NULL,
  `timestamp` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `queue_history`
--

INSERT INTO `queue_history` (`id`, `normal_queue_start`, `normal_queue_end`, `missed_queue_start`, `missed_queue_end`, `failed_queue_start`, `failed_queue_end`, `timestamp`) VALUES
(1, 1, 200, 0, 0, 0, 0, '2024-12-16 11:02:05'),
(2, 201, 400, 1, 200, 0, 0, '2024-12-16 11:02:09'),
(3, 401, 600, 201, 400, 1, 200, '2024-12-16 11:02:12'),
(4, 601, 800, 401, 600, 201, 400, '2024-12-16 11:02:12'),
(5, 801, 1000, 601, 800, 401, 600, '2024-12-16 11:02:13'),
(6, 1001, 1200, 801, 1000, 601, 800, '2024-12-16 11:02:19'),
(7, 1201, 1400, 1001, 1200, 801, 1000, '2024-12-16 11:02:23'),
(8, 1401, 1600, 1201, 1400, 1001, 1200, '2024-12-16 11:02:26'),
(9, 1601, 1800, 1401, 1600, 1201, 1400, '2024-12-16 11:02:33'),
(10, 1801, 2000, 1601, 1800, 1401, 1600, '2024-12-16 11:02:39'),
(11, 2001, 2200, 1801, 2000, 1601, 1800, '2024-12-16 11:02:43'),
(12, 2201, 2400, 2001, 2200, 1801, 2000, '2024-12-16 11:02:48'),
(13, 2401, 2600, 2201, 2400, 2001, 2200, '2024-12-16 11:02:51'),
(14, 2601, 2800, 2401, 2600, 2201, 2400, '2024-12-16 11:02:53'),
(15, 2801, 3000, 2601, 2800, 2401, 2600, '2024-12-16 11:02:56'),
(16, 1, 200, 2801, 3000, 2601, 2800, '2024-12-16 11:03:08'),
(17, 201, 400, 1, 200, 0, 0, '2024-12-16 11:03:27'),
(18, 401, 600, 201, 400, 1, 200, '2024-12-16 11:12:22'),
(19, 601, 800, 401, 600, 201, 400, '2024-12-16 11:20:25'),
(20, 801, 1000, 601, 800, 401, 600, '2024-12-16 13:03:27'),
(21, 1001, 1200, 801, 1000, 601, 800, '2024-12-16 13:43:45'),
(22, 1201, 1400, 1001, 1200, 801, 1000, '2024-12-17 15:11:04'),
(23, 1401, 1600, 1201, 1400, 1001, 1200, '2024-12-19 16:56:42'),
(24, 1601, 1800, 1401, 1600, 1201, 1400, '2024-12-21 09:45:23'),
(25, 1801, 2000, 1601, 1800, 1401, 1600, '2024-12-21 10:35:02'),
(26, 2001, 2200, 1801, 2000, 1601, 1800, '2024-12-21 12:38:37'),
(27, 2201, 2400, 2001, 2200, 1801, 2000, '2024-12-21 14:34:56'),
(28, 2401, 2600, 2201, 2400, 2001, 2200, '2024-12-21 16:34:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `queue_history`
--
ALTER TABLE `queue_history`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `queue_history`
--
ALTER TABLE `queue_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
