-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 
-- 伺服器版本： 10.4.11-MariaDB
-- PHP 版本： 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
  `woext` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '圖片副檔名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='作品收藏';

--
-- 傾印資料表的資料 `ex_works`
--

INSERT INTO `ex_works` (`woid`, `wocategory`, `wotitle`, `woyear`, `womaterial`, `wosize`, `wostatus`, `woext`) VALUES
(1, '分類一', '標題', '年份', '材質', '尺寸', '狀態', '副檔名'),
(2, '分類一', '清風亮節（陳澄波等人）', '1942之前', '紙本彩墨', '153x80cm', '台北市立美術館藏', 'IW01'),
(3, '分類一', '清風亮節（陳澄波等人）', '1942之前', '紙本彩墨', '153x80cm', '台北市立美術館藏', 'IW01'),
(4, '分類一', '清風亮節（陳澄波等人）', '1942之前', '紙本彩墨', '153x80cm', '台北市立美術館藏', 'IW01'),
(5, '分類一', '清風亮節（陳澄波等人）', '1942之前', '紙本彩墨', '153x80cm', '台北市立美術館藏', 'IW01'),
(6, '分類二', '不一樣的標題', '2021', '水彩', '20x30m', '私人蒐藏', 'IMG_');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `ex_works`
--
ALTER TABLE `ex_works`
  ADD PRIMARY KEY (`woid`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `ex_works`
--
ALTER TABLE `ex_works`
  MODIFY `woid` int(5) NOT NULL AUTO_INCREMENT COMMENT '作品ID', AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
