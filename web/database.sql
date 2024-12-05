-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-12-05 09:42:29
-- 伺服器版本： 10.4.32-MariaDB
-- PHP 版本： 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `database`
--

-- --------------------------------------------------------

--
-- 資料表結構 `fee_manage`
--

CREATE TABLE `fee_manage` (
  `Stu_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `pay_date` date DEFAULT NULL,
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `fee_manage`
--

INSERT INTO `fee_manage` (`Stu_id`, `name`, `pay_date`, `status`) VALUES
('412401094', '黃旭', '2024-12-01', 'Y'),
('412401123', '楊沛蓁', '2024-12-03', 'Y'),
('412401135', '鄔雨彤', NULL, 'N');

-- --------------------------------------------------------

--
-- 資料表結構 `job`
--

CREATE TABLE `job` (
  `Stu_id` varchar(20) NOT NULL,
  `1` varchar(20) NOT NULL,
  `2` varchar(20) NOT NULL,
  `3` varchar(20) NOT NULL,
  `4` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `job`
--

INSERT INTO `job` (`Stu_id`, `1`, `2`, `3`, `4`) VALUES
('412401094', '副會長', '會長', '', ''),
('412401123', '公關', '美宣', '', ''),
('412401135', '會長', '副會長', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `login`
--

CREATE TABLE `login` (
  `account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `login`
--

INSERT INTO `login` (`account`, `password`) VALUES
('412401094', '0912455788'),
('412401123', '0923566899'),
('412401135', '0939855766'),
('student4', '4'),
('student5', '5'),
('student6', '6');

-- --------------------------------------------------------

--
-- 資料表結構 `people`
--

CREATE TABLE `people` (
  `Stu_id` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `time` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `people`
--

INSERT INTO `people` (`Stu_id`, `name`, `contact`, `time`) VALUES
('412401094', '黃旭', '0912345678', '2023-12-08'),
('412401123', '楊沛蓁', '0923566899', '2023-12-08'),
('412401135', '鄔雨彤', '0908411766', '2023-12-08');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `fee_manage`
--
ALTER TABLE `fee_manage`
  ADD PRIMARY KEY (`Stu_id`);

--
-- 資料表索引 `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`Stu_id`);

--
-- 資料表索引 `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`account`),
  ADD UNIQUE KEY `password` (`password`),
  ADD UNIQUE KEY `password_2` (`password`);

--
-- 資料表索引 `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`Stu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
