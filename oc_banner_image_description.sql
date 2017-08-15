-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2017-08-15 15:19:48
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
-- 表的结构 `oc_banner_image_description`
--

CREATE TABLE `oc_banner_image_description` (
  `banner_image_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `oc_banner_image_description`
--

INSERT INTO `oc_banner_image_description` (`banner_image_id`, `language_id`, `banner_id`, `title`, `content`) VALUES
(102, 1, 7, 'asdasdasd', 'asdasdasdasdsdasdasdasdasdasd'),
(87, 1, 6, 'HP Banner', ''),
(93, 1, 8, 'Canon', ''),
(92, 1, 8, 'Burger King', ''),
(91, 1, 8, 'Coca Cola', ''),
(90, 1, 8, 'Disney', ''),
(89, 1, 8, 'Dell', ''),
(88, 1, 8, 'Harley Davidson', ''),
(94, 1, 8, 'NFL', ''),
(95, 1, 8, 'RedBull', ''),
(96, 1, 8, 'Sony', ''),
(97, 1, 8, 'Starbucks', ''),
(98, 1, 8, 'Nintendo', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `oc_banner_image_description`
--
ALTER TABLE `oc_banner_image_description`
  ADD PRIMARY KEY (`banner_image_id`,`language_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
