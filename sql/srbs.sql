-- phpMyAdmin SQL Dump
-- version 4.2.6deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-04-24 19:19:30
-- 服务器版本： 5.5.43-0ubuntu0.14.10.1
-- PHP Version: 5.5.12-2ubuntu4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `srbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `bookings`
--

CREATE TABLE IF NOT EXISTS `bookings` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `room_id` int(10) unsigned DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `timeslot` varchar(16) DEFAULT NULL,
  `created` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `room_id`, `booking_date`, `timeslot`, `created`) VALUES
(0, 1, 1, '2015-04-24', '18:00-19:00', '2015-04-24 18:29:51');

-- --------------------------------------------------------

--
-- 表的结构 `devices`
--

CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(10) unsigned NOT NULL,
  `devicename` varchar(250) DEFAULT NULL,
  `function` text,
  `extra` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `room_id` int(10) unsigned DEFAULT NULL,
  `produced_date` date DEFAULT NULL,
  `introduced_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `devices`
--

INSERT INTO `devices` (`id`, `devicename`, `function`, `extra`, `created`, `modified`, `room_id`, `produced_date`, `introduced_date`) VALUES
(0, '空调', '用于夏日降温', '打开空调时请注意关紧门窗。', '2015-04-24 18:29:27', '2015-04-24 18:29:27', 1, '2015-04-24', '2015-04-24');

-- --------------------------------------------------------

--
-- 表的结构 `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `content` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `title` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `notices`
--

INSERT INTO `notices` (`id`, `user_id`, `content`, `created`, `modified`, `title`) VALUES
(0, NULL, '由于天花板漏水，部分研讨室暂时不开放。', '2015-04-24 18:31:56', '2015-04-24 18:31:56', '部分研讨室关闭');

-- --------------------------------------------------------

--
-- 表的结构 `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
`id` int(10) unsigned NOT NULL,
  `roomname` varchar(255) NOT NULL,
  `seat_nums` int(10) unsigned DEFAULT NULL,
  `has_network` int(4) NOT NULL DEFAULT '0',
  `is_available` int(4) NOT NULL DEFAULT '1',
  `extra` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `rooms`
--

INSERT INTO `rooms` (`id`, `roomname`, `seat_nums`, `has_network`, `is_available`, `extra`, `created`, `modified`) VALUES
(1, '101', 20, 1, 1, '', '2015-04-24 18:26:39', '2015-04-24 18:26:39');

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` int(10) unsigned NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `created`, `modified`, `is_admin`, `is_active`) VALUES
(1, 'zhoujqia', '7f322a1a156ecc8d02e4c2780b786ef0b87fcaa6', 'zhoujqia@mail2.sysu.edu.com', '2015-03-18 22:57:32', '2015-04-24 19:17:54', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
