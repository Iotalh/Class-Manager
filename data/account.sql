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
-- 資料表結構 `account`
--

CREATE TABLE `account` (
  `Id` int(10) UNSIGNED NOT NULL,
  `role` enum('admin','student') CHARACTER SET utf8 NOT NULL,
  `studentId` int(10) UNSIGNED NOT NULL,
  `salt` varchar(100) CHARACTER SET utf8 NOT NULL,
  `hashValue` varchar(100) CHARACTER SET utf8 NOT NULL,
  `name` varchar(10) CHARACTER SET utf8 NOT NULL,
  `department` enum('資傳系','資工系','資訊英專') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account`
--
ALTER TABLE `account`
  MODIFY `Id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
