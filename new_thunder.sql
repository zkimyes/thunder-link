-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-08-26 08:57:17
-- 服务器版本： 5.7.18
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new_thunder`
--

-- --------------------------------------------------------

--
-- 表的结构 `oc_review`
--

CREATE TABLE `oc_review` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `author` varchar(64) NOT NULL,
  `text` text NOT NULL,
  `rating` int(1) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oc_review`
--

INSERT INTO `oc_review` (`review_id`, `product_id`, `customer_id`, `author`, `text`, `rating`, `status`, `date_added`, `date_modified`) VALUES
(1, 30, 2, 'zkim yes', 'asdasdasdasdasdasdaasdasdasdasdasdasdasdasdasdasdasdasdasdasd', 5, 1, '2017-08-20 13:58:18', '2017-08-20 14:01:05'),
(2, 30, 2, 'asdasdasdasd', 'asdasdasdasdasdasdasdasdasdasaadasdasdasdasdasdasdasdasdasdasdasd', 5, 0, '2017-08-20 13:58:40', '0000-00-00 00:00:00'),
(3, 30, 2, 'zkim yes', 'asdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasdasdasdasdasdasdasdasddasdasd', 2, 0, '2017-08-21 13:33:48', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- 表的结构 `oc_review_reply`
--

CREATE TABLE `oc_review_reply` (
  `id` int(11) NOT NULL,
  `review_id` int(11) NOT NULL,
  `content` text COLLATE utf8_bin NOT NULL,
  `author` varchar(200) COLLATE utf8_bin NOT NULL,
  `product_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 转存表中的数据 `oc_review_reply`
--

INSERT INTO `oc_review_reply` (`id`, `review_id`, `content`, `author`, `product_id`, `date_added`) VALUES
(10, 3, '啊实打实大师的', 'Thunder Link', 30, '2017-08-22 17:52:53'),
(9, 3, 'hello  i am recard  i am glad to notify you my company was copey.', 'Thunder Link', 30, '2017-08-22 10:11:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_review`
--
ALTER TABLE `oc_review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `oc_review_reply`
--
ALTER TABLE `oc_review_reply`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `oc_review`
--
ALTER TABLE `oc_review`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `oc_review_reply`
--
ALTER TABLE `oc_review_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
