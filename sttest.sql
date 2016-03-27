-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 27, 2016 at 11:11 AM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sttest`
--

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `description` text,
  `size` varchar(250) DEFAULT NULL,
  `color` varchar(250) DEFAULT NULL,
  `last` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `title`, `image`, `price`, `description`, `size`, `color`, `last`) VALUES
(14, 'Keyboard', 'keyboard.jpg', 90, 'balh balh', 'a:5:{i:0;s:1:"0";i:1;s:5:"sizeA";i:2;s:5:"sizeB";i:3;s:5:"sizeE";i:4;s:5:"sizeG";}', 'a:5:{i:0;s:1:"0";i:1;s:3:"red";i:2;s:5:"green";i:3;s:5:"white";i:4;s:6:"yellow";}', '0000-00-00 00:00:00'),
(5, 'Mouse', 'mouse.jpg', 10, 'b', 'a:5:{i:0;s:1:"0";i:1;s:5:"sizeA";i:2;s:5:"sizeD";i:3;s:5:"sizeF";i:4;s:5:"sizeG";}', 'a:3:{i:0;s:1:"0";i:1;s:3:"red";i:2;s:5:"white";}', '0000-00-00 00:00:00'),
(15, 'Smartwatch', 'smartwatch (1).jpg', 155, 'bbb', 'a:3:{i:0;s:1:"0";i:1;s:5:"sizeA";i:2;s:5:"sizeE";}', 'a:3:{i:0;s:1:"0";i:1;s:5:"white";i:2;s:5:"brown";}', '0000-00-00 00:00:00'),
(16, 'BMW', 'bmw-r-s-07.jpg', 1500, 'Bike', 'a:3:{i:0;s:1:"0";i:1;s:5:"sizeD";i:2;s:5:"sizeG";}', 'a:3:{i:0;s:1:"0";i:1;s:3:"red";i:2;s:5:"black";}', '0000-00-00 00:00:00'),
(17, 'BMW', '', 3500, 'car', 'a:3:{i:0;s:1:"0";i:1;s:5:"sizeD";i:2;s:5:"sizeF";}', 'a:3:{i:0;s:1:"0";i:1;s:5:"black";i:2;s:5:"white";}', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `pass` varchar(250) NOT NULL,
  `last` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `pass`, `last`) VALUES
(1, 'test', '81dc9bdb52d04dc20036dbd8313ed055', '2016-03-23 11:12:53');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
