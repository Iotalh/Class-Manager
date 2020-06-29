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
  `id` int(10) UNSIGNED NOT NULL,
  `userRole` enum('admin','student') CHARACTER SET utf8 NOT NULL,
  `studentId` int(10) UNSIGNED NOT NULL,
  `hashValue` varchar(100) CHARACTER SET utf8 NOT NULL,
  `userName` varchar(10) CHARACTER SET utf8 NOT NULL,
  `department` enum('資傳系','資工系','資英系') CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `account`
--

INSERT INTO `account` (`id`, `userRole`, `studentId`, `hashValue`, `userName`, `department`) VALUES
(1, 'admin', 1072026, '$2y$10$/1iWp2l9JNr8y2lwO3aHre9VyoSN.0k15TMf2ybbPUUcSUKpQfW8O', 'Luna', '資傳系'),
(5, 'student', 0, '$2y$10$wA6wdHQJ.cfNuelu4jdcrOXtVpga/MZ4kxBiMoYZoqConstV8vFJC', '1', '資傳系'),
(6, 'admin', 1024, '$2y$10$ex0UQBOE/a4DMWNwaaz6h.oiuHm7xviayWCysIy/Z1HKpywDjbJ7G', '蔥蔥', '資工系'),
(7, 'admin', 12345, '$2y$10$m3sQ5YmwowkAfTnDrlxRy.8dqZLtJHnAGh/oUETPO581OX4QLUU9S', '呱呱', '資傳系'),
(8, 'student', 1072020, '$2y$10$CdveU4VrsP9eKP2JpjGJRe04cOaA2RfKV7rQ0KLuhlIiD3k7EGLVW', '路人1', '資工系'),
(9, 'student', 1072021, '$2y$10$TinK6LJwZr1edaWHrWaVzee2t.KhMJ.DdpQv7G4YaCexYVXijl3d6', '同學1', '資傳系');

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
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

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
-- 使用資料表自動遞增(AUTO_INCREMENT) `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `class`
--
ALTER TABLE `class`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
