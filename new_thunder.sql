-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-08-06 08:48:10
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
-- 表的结构 `oc_support_article`
--

CREATE TABLE `oc_support_article` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `summary` varchar(255) DEFAULT NULL,
  `content` text,
  `createAt` datetime DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `banner_id` int(11) DEFAULT NULL,
  `related_product_ids` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `oc_support_category`
--

CREATE TABLE `oc_support_category` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_desc` text,
  `url` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oc_support_category`
--

INSERT INTO `oc_support_category` (`id`, `title`, `meta_keyword`, `meta_desc`, `url`) VALUES
(125, 'Access Network', 'Access Network', 'Access Network', ''),
(126, 'Transmission Network', 'Transmission Network', 'Transmission Network', ''),
(127, 'Data Communication', 'Data Communication', 'Data Communication', 'Data Communication');

-- --------------------------------------------------------

--
-- 表的结构 `oc_support_tags`
--

CREATE TABLE `oc_support_tags` (
  `id` int(11) NOT NULL,
  `name` varchar(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `oc_support_tags`
--

INSERT INTO `oc_support_tags` (`id`, `name`) VALUES
(1, 'tagss'),
(2, 'dd'),
(3, 'ww'),
(4, 'ww22'),
(5, 'asd'),
(6, 'wwww'),
(7, 'asdasda'),
(8, 'wwwwaaa'),
(9, 'dawdawd'),
(10, 'wwadasd'),
(11, 'wetwetwvsfs'),
(12, 'asdadasdasd'),
(13, 'adwadwasdaw'),
(14, 'asdasdwadaw'),
(15, 'wwwwwadd'),
(16, 'ddww');

-- --------------------------------------------------------

--
-- 表的结构 `oc_support_tag_relative`
--

CREATE TABLE `oc_support_tag_relative` (
  `support_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_support_article`
--
ALTER TABLE `oc_support_article`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oc_support_category`
--
ALTER TABLE `oc_support_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oc_support_tags`
--
ALTER TABLE `oc_support_tags`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `oc_support_article`
--
ALTER TABLE `oc_support_article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `oc_support_category`
--
ALTER TABLE `oc_support_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;
--
-- 使用表AUTO_INCREMENT `oc_support_tags`
--
ALTER TABLE `oc_support_tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
