-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2024 at 10:00 AM
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
('412401002', '李梅', NULL, 'N'),
('412401003', '張強', '2023-12-03', 'Y'),
('412401004', '王芳', '2023-12-04', 'N'),
('412401004', '王芳', NULL, 'N'),
('412401005', '陳建', '2023-12-05', 'Y'),
('412401006', '林華', '2023-12-06', 'Y'),
('412401007', '劉明', '2023-12-07', 'N'),
('412401007', '劉明', NULL, 'N'),
('412401008', '鄭秀', '2023-12-08', 'Y'),
('412401009', '郭玉', '2023-12-09', 'N'),
('412401009', '郭玉', NULL, 'N'),
('412401010', '徐勇', '2023-12-10', 'Y'),
('412401094', '黃旭', '2024-12-01', 'Y'),
('412401123', '楊沛蓁', '2024-12-03', 'Y'),

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `Stu_id` varchar(20) NOT NULL,
  `1` varchar(20) NOT NULL,
  `2` varchar(20) NOT NULL,
  `3` varchar(20) NOT NULL,
  `4` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`Stu_id`, `1`, `2`, `3`, `4`) VALUES
('412401001', '會長', '公關', '財務', '美宣'),
('412401002', '副會長', '公關長', '器材', '行政'),
('412401003', '財務長', '會長', '活動策劃', '公關'),
('412401004', '秘書長', '活動策劃', '副會長', '財務'),
('412401005', '財務', '副會長', '器材', '會長'),
('412401006', '活動策劃', '財務', '公關', '器材'),
('412401007', '美選長', '美宣長', '活動策劃', '副會長'),
('412401008', '美宣', '財務長', '秘書長', '活動策劃'),
('412401009', '公關長', '秘書長', '美宣', '會長'),
('412401010', '公關', '器材', '會長', '活動策劃'),
('412401094', '副會長', '會長', '', ''),
('412401123', '公關', '美宣', '', ''),
('412401135', '會長', '副會長', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`account`, `password`) VALUES
('412401001', '0912345678'),
('412401002', '0987654321'),
('412401003', '0911123456'),
('412401004', '0933334441'),
('412401005', '0922111223'),
('412401006', '0955444334'),
('412401007', '0944556675'),
('412401008', '0911223346'),
('412401009', '0988776657'),
('412401010', '0901234568');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `Stu_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`Stu_id`, `name`, `contact`, `time`) VALUES
('412401001', '黃旭', '0912345678', '2023-12-01'),
('412401002', '李梅', '0987654321', '2023-12-02'),
('412401003', '張強', '0911123456', '2023-12-03'),
('412401004', '王芳', '0933334441', '2023-12-04'),
('412401005', '陳建', '0922111223', '2023-12-05'),
('412401006', '林華', '0955444334', '2023-12-06'),
('412401007', '劉明', '0944556675', '2023-12-07'),
('412401008', '鄭秀', '0911223346', '2023-12-08'),
('412401009', '郭玉', '0988776657', '2023-12-09'),
('412401010', '徐勇', '0901234568', '2023-12-10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fee_manage`
--
ALTER TABLE `fee_manage`
  ADD PRIMARY KEY (`Stu_id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`Stu_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`account`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`Stu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
