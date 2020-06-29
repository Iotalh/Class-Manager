-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `class_manager`
--

-- --------------------------------------------------------

--
-- 資料表結構 `comment`
--

CREATE TABLE `comment` (
  `id` int(10) UNSIGNED NOT NULL,
  `class` int(10) UNSIGNED NOT NULL,
  `student` int(10) UNSIGNED NOT NULL,
  `createTime` datetime NOT NULL DEFAULT current_timestamp(),
  `updateTime` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` text CHARACTER SET utf8 NOT NULL,
  `sweetScore` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL,
  `hwScore` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL,
  `learnScore` enum('0','1','2','3','4','5','6','7','8','9','10') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `comment`
--

INSERT INTO `comment` (`id`, `class`, `student`, `createTime`, `updateTime`, `content`, `sweetScore`, `hwScore`, `learnScore`) VALUES
(25, 2, 6, '2020-06-28 19:47:02', '2020-06-28 19:47:02', 'AAAAAAAAAAAAAAAAAAAAA', '3', '7', '6'),
(26, 1, 7, '2020-06-28 22:28:51', '2020-06-29 22:43:05', '讚讚讚', '5', '7', '10'),
(27, 5, 8, '2020-06-28 23:49:15', '2020-06-28 23:49:15', '1234', '7', '3', '10');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_ibfk_class` (`class`),
  ADD KEY `comment_ibfk_student` (`student`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_class` FOREIGN KEY (`class`) REFERENCES `class` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_student` FOREIGN KEY (`student`) REFERENCES `account` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
