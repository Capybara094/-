-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-12-12 07:46:43
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
('412401001', '黃旭', '2023-12-01', 'Y'),
('412401002', '李梅', NULL, 'N'),
('412401003', '張強', '2023-12-03', 'Y'),
('412401004', '王芳', NULL, 'N'),
('412401005', '陳建', '2023-12-05', 'Y'),
('412401006', '林華', '2023-12-06', 'Y'),
('412401007', '劉明', NULL, 'N'),
('412401008', '鄭秀', '2023-12-08', 'Y'),
('412401009', '郭玉', NULL, 'N'),
('412401010', '徐勇', '2023-12-10', 'Y'),
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
('412401001', '0912345678'),
('412401002', '0987654321'),
('412401003', '0911123456'),
('412401004', '0933334441'),
('412401005', '0922111223'),
('412401006', '0955444334'),
('412401007', '0944556675'),
('412401008', '0911223346'),
('412401009', '0988776657'),
('412401010', '0901234568'),
('412401094', '0906123456'),
('412401123', '0908456789'),
('412401135', '0909123456');

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
('412401001', '黃旭', '0912345678', '2023-09-01'),
('412401002', '李梅', '0987654321', '2023-09-01'),
('412401003', '張強', '0911123456', '2023-09-01'),
('412401004', '王芳', '0933334441', '2023-09-01'),
('412401005', '陳建', '0922111223', '2023-09-01'),
('412401006', '林華', '0955444334', '2023-09-01'),
('412401007', '劉明', '0944556675', '2023-09-01'),
('412401008', '鄭秀', '0911223346', '2023-09-01'),
('412401009', '郭玉', '0988776657', '2019-09-02'),
('412401010', '徐勇', '0901234568', '2023-09-01'),
('412401094', '黃旭', '0908123456', '2021-09-02'),
('412401123', '楊沛蓁', '0908456789', '2019-12-18'),
('412401135', '鄔雨彤', '0909123456', '2019-12-08');

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
  ADD PRIMARY KEY (`account`);

--
-- 資料表索引 `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`Stu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
