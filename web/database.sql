-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2024-11-20 09:18:24
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
-- 資料表結構 `job`
--

CREATE TABLE `job` (
  `postid` int(11) NOT NULL,
  `company` varchar(45) NOT NULL,
  `content` text NOT NULL,
  `pdate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `job`
--

INSERT INTO `job` (`postid`, `company`, `content`, `pdate`) VALUES
(1, 'Microsoft', '誠徵雲端工程師，三年以上工作經驗', '2024-10-18'),
(2, 'Google', '誠徵雲端工程師，需三年以上工作經驗', '2024-10-20'),
(3, 'AWS Taiwan', '誠徵雲端工程師，三年以上工作經驗', '2024-10-25'),
(4, '萬里雲', '誠徵雲端工程師，無經驗可', '2024-10-24');

-- --------------------------------------------------------

--
-- 資料表結構 `user`
--

CREATE TABLE `user` (
  `account` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(10) NOT NULL,
  `role` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `user`
--

INSERT INTO `user` (`account`, `password`, `name`, `role`) VALUES
('student1', '1', 'capybara', 'M'),
('student2', '2', 'elio', 'U'),
('student3', '3', 'Billie', 'U'),
('student4', '4', 'ikea', 'U'),
('student5', '5', 'beat', 'U'),
('student6', '6', 'lemon', 'U');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`postid`);

--
-- 資料表索引 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`account`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `job`
--
ALTER TABLE `job`
  MODIFY `postid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
