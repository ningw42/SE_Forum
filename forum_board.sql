-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2015 年 06 月 11 日 11:21
-- 服务器版本: 5.6.12-log
-- PHP 版本: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `forum`
--

-- --------------------------------------------------------

--
-- 表的结构 `forum_board`
--

CREATE TABLE IF NOT EXISTS `forum_board` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` char(20) DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL,
  `posts_count` int(11) DEFAULT NULL,
  PRIMARY KEY (`b_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `forum_board`
--

INSERT INTO `forum_board` (`b_id`, `b_name`, `description`, `posts_count`) VALUES
(1, 'b1', 'd1', 0),
(2, 'b2', 'd2', 0),
(3, 'b3', 'd3', 0),
(4, 'b4', 'd4', 0),
(5, 'b5', 'd5', 0),
(6, 'b6', 'd6', 0),
(7, 'b7', 'd7', 0),
(8, 'b8', 'd8', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
