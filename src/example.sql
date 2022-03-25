-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2022 年 03 月 25 日 06:59
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `example`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ex_category`
--

CREATE TABLE `ex_category` (
  `wcid` int(5) NOT NULL COMMENT '分類ID',
  `wcorder` int(5) NOT NULL COMMENT '分類順序',
  `wcname` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '分類名稱',
  `wcbrief` text COLLATE utf8_unicode_ci NOT NULL COMMENT '分類說明'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='分類列表';

--
-- 傾印資料表的資料 `ex_category`
--

INSERT INTO `ex_category` (`wcid`, `wcorder`, `wcname`, `wcbrief`) VALUES
(1, 1, '油畫', '油畫的介紹'),
(2, 2, '膠彩', '膠彩的介紹'),
(4, 3, '水彩', '水彩的介紹');

-- --------------------------------------------------------

--
-- 資料表結構 `ex_works`
--

CREATE TABLE `ex_works` (
  `woid` int(5) NOT NULL COMMENT '作品ID',
  `wocategory` varchar(4) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '分類',
  `wotitle` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '作品名稱',
  `woyear` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '年份',
  `womaterial` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '材質',
  `wosize` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '尺寸',
  `wostatus` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '收藏狀態',
  `woext` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '圖片副檔名',
  `wodate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='作品收藏';

--
-- 傾印資料表的資料 `ex_works`
--

INSERT INTO `ex_works` (`woid`, `wocategory`, `wotitle`, `woyear`, `womaterial`, `wosize`, `wostatus`, `woext`, `wodate`) VALUES
(2, '1', '嘉義街外（一）', '1926', '畫布油彩', '40號', '不明', 'jpg', '2022-02-08 05:39:50'),
(21, '1', '枇杷樹', '1924', '絹上膠彩', '61×51cm', '私人收藏', 'jpg', '2022-02-22 05:28:07'),
(22, '2', '野生杜鵑', '1924', '紙本膠彩', '63×45.5cm', '私人收藏', 'jpg', '2022-02-22 05:29:28');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ex_category`
--
ALTER TABLE `ex_category`
  ADD PRIMARY KEY (`wcid`);

--
-- 資料表索引 `ex_works`
--
ALTER TABLE `ex_works`
  ADD PRIMARY KEY (`woid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ex_category`
--
ALTER TABLE `ex_category`
  MODIFY `wcid` int(5) NOT NULL AUTO_INCREMENT COMMENT '分類ID', AUTO_INCREMENT=5;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ex_works`
--
ALTER TABLE `ex_works`
  MODIFY `woid` int(5) NOT NULL AUTO_INCREMENT COMMENT '作品ID', AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
