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
-- 資料表結構 `class`
--

CREATE TABLE `class` (
  `id` int(10) UNSIGNED NOT NULL,
  `department` varchar(20) CHARACTER SET utf8 NOT NULL,
  `semester` enum('1071','1072','1081','1082','1091') NOT NULL,
  `classId` varchar(6) NOT NULL,
  `credit` int(2) UNSIGNED NOT NULL,
  `title` varchar(20) CHARACTER SET utf8 NOT NULL,
  `teacher` varchar(10) CHARACTER SET utf8 NOT NULL,
  `link` varchar(200) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `class`
--

INSERT INTO `class` (`id`, `department`, `semester`, `classId`, `credit`, `title`, `teacher`, `link`) VALUES
(1, '資傳系', '1082', 'IC261', 3, '網路資料庫概論', '張家榮', 'https://portal.yzu.edu.tw/cosSelect/Cos_Plan.aspx?y=108&s=2&id=IC261&c=A'),
(2, '資工系', '1082', 'CS380', 3, 'Ｗｅｂ程式設計', '歐昱言', 'https://portal.yzu.edu.tw/cosSelect/Cos_Plan.aspx?y=109&s=1&id=CS380&c=A'),
(4, '資工系', '1082', 'IC338', 3, '網頁遊戲程式設計', '張家榮', 'https://portal.yzu.edu.tw/cosSelect/Cos_Plan.aspx?y=108&s=2&id=IC338&c=A'),
(5, '資傳系', '1091', 'IC257', 3, '網際網路程式設計', '張家榮', 'https://portal.yzu.edu.tw/cosSelect/Cos_Plan.aspx?y=109&s=1&id=IC257&c=A');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
