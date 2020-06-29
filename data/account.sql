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

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `account`
--
ALTER TABLE `account`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
