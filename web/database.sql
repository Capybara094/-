-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 09:36 AM
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
-- Database: `database`
--

-- --------------------------------------------------------

--
-- Table structure for table `fee_manage`
--

CREATE TABLE `fee_manage` (
  `Stu_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `pay_date` date DEFAULT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fee_manage`
--

INSERT INTO `fee_manage` (`Stu_id`, `name`, `pay_date`, `status`) VALUES
('412401001', '黃旭', '2023-12-01', 'Y'),
('412401002', '李梅', '2023-12-02', 'N'),
('412401003', '張強', '2023-12-03', 'Y'),
('412401004', '王芳', '2023-12-04', 'N'),
('412401005', '陳建', '2023-12-05', 'Y'),
('412401006', '林華', '2023-12-06', 'Y'),
('412401007', '劉明', '2023-12-07', 'N'),
('412401008', '鄭秀', '2023-12-08', 'Y'),
('412401009', '郭玉', '2023-12-09', 'N'),
('412401010', '徐勇', '2023-12-10', 'Y'),
('412401094', '黃旭', '2024-12-01', 'Y'),
('412401123', '楊沛蓁', '2024-12-03', 'Y'),
('412401135', '鄔雨彤', NULL, 'N');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fee_manage`
--
ALTER TABLE `fee_manage`
  ADD PRIMARY KEY (`Stu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
