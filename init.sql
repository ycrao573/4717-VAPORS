-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 09, 2020 at 08:00 PM
-- Server version: 5.5.44-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f32ee`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` char(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(150) DEFAULT NULL,
  `gender` char(1) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `postal` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `email`, `password`, `name`, `address`, `gender`, `phone`, `postal`) VALUES
(1, 'ryc@ryc.com', 'e10adc3949ba59abbe56e057f20f883e', 'Yuchen', '52 Nanyang', 'W', '66666666', '639928'),
(2, 'asdf@asdf.com', 'e10adc3949ba59abbe56e057f20f883e', 'Liangyu', '50 NANYANG AVE', 'W', '66666666', '639798');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cartId` int(10) unsigned NOT NULL,
  `accountId` int(10) unsigned NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` char(4) NOT NULL,
  `gender` char(1) NOT NULL,
  `color` varchar(10) NOT NULL,
  `size` int(10) unsigned NOT NULL,
  `price` decimal(7,2) unsigned NOT NULL,
  `discount` float(4,2) unsigned DEFAULT '0.00',
  `quantity` int(10) unsigned NOT NULL,
  `paid` int(1) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `cartId`, `accountId`, `name`, `category`, `gender`, `color`, `size`, `price`, `discount`, `quantity`, `paid`) VALUES
(1, 1, 1, 'Nike MAX 2020', 'BRD', 'M', 'White', 9, 129.90, 0.00, 2, 1),
(2, 2, 1, 'Nike MAX 2020', 'BRD', 'M', 'White', 9, 129.90, 10.00, 2, 1),
(3, 2, 1, 'Nike ZOOM', 'RUN', 'W', 'White', 9, 129.90, 0.00, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE IF NOT EXISTS `inventory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `productID` int(10) unsigned NOT NULL,
  `color` varchar(20) NOT NULL,
  `size` varchar(3) NOT NULL,
  `stock` int(10) unsigned NOT NULL,
  `sale` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `productID` (`productID`,`color`,`size`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `productID`, `color`, `size`, `stock`, `sale`) VALUES
(1, 1, 'Blue', '7', 0, 0),
(2, 1, 'Blue', '8', 10, 0),
(3, 1, 'Blue', '9', 10, 0),
(4, 1, 'Blue', '10', 180, 0),
(5, 1, 'Blue', '11', 12, 0),
(6, 1, 'Blue', '12', 103, 0),
(7, 1, 'White', '7', 12, 0),
(8, 1, 'White', '8', 1862, 0),
(9, 1, 'White', '9', 182, 0),
(10, 1, 'White', '10', 192, 0),
(11, 2, 'Brown', '6', 686, 0),
(12, 2, 'Brown', '7', 686, 0),
(13, 2, 'Brown', '8', 896, 0),
(14, 2, 'Brown', '9', 6332, 0),
(15, 2, 'Brown', '10', 6865, 0),
(16, 2, 'White', '6', 6526, 0),
(17, 2, 'White', '7', 638, 0),
(18, 2, 'White', '8', 6634, 0),
(19, 2, 'White', '9', 686, 0),
(20, 2, 'White', '10', 6, 0),
(21, 3, 'Black', '6', 686, 0),
(22, 3, 'Black', '7', 686, 0),
(23, 3, 'Black', '8', 896, 0),
(24, 3, 'Black', '9', 6332, 0),
(25, 3, 'Black', '10', 6865, 0),
(26, 3, 'White', '6', 6526, 0),
(27, 3, 'White', '7', 638, 0),
(28, 3, 'White', '8', 6634, 0),
(29, 3, 'White', '9', 686, 0),
(30, 3, 'White', '10', 6, 0),
(31, 4, 'Black', '6', 686, 0),
(32, 4, 'Black', '7', 686, 0),
(33, 4, 'Black', '8', 896, 0),
(34, 4, 'Black', '9', 6333, 0),
(35, 4, 'Black', '10', 6865, 0),
(36, 4, 'White', '6', 6536, 0),
(37, 4, 'White', '7', 638, 0),
(38, 4, 'White', '8', 6634, 0),
(39, 4, 'White', '9', 686, 0),
(40, 4, 'White', '10', 6, 0),
(41, 5, 'Black', '6', 686, 0),
(42, 5, 'Black', '7', 686, 0),
(43, 5, 'Black', '8', 896, 0),
(44, 5, 'Black', '9', 6333, 0),
(45, 5, 'Black', '10', 6865, 0),
(46, 5, 'Orange', '6', 6536, 0),
(47, 5, 'White', '7', 638, 0),
(48, 5, 'Orange', '8', 6634, 0),
(49, 5, 'White', '9', 686, 0),
(50, 5, 'Orange', '10', 6, 0),
(51, 6, 'Blue', '6', 686, 0),
(52, 6, 'Blue', '7', 686, 0),
(53, 6, 'Blue', '8', 896, 0),
(54, 6, 'Blue', '9', 6333, 0),
(55, 6, 'Blue', '10', 6865, 0),
(57, 6, 'Blue', '11', 638, 0),
(58, 6, 'Blue', '12', 6634, 0),
(59, 6, 'Blue', '13', 686, 0),
(71, 7, 'Brown', '6', 686, 0),
(72, 7, 'Brown', '7', 686, 0),
(73, 7, 'Brown', '8', 896, 0),
(74, 7, 'Brown', '9', 6333, 0),
(75, 7, 'Brown', '10', 6865, 0),
(76, 7, 'Pink', '6', 6536, 0),
(77, 7, 'Pink', '7', 638, 0),
(78, 7, 'Pink', '8', 6634, 0),
(79, 7, 'Pink', '9', 686, 0),
(80, 7, 'Pink', '10', 6, 0),
(81, 8, 'White', '6', 686, 0),
(82, 8, 'White', '7', 686, 0),
(83, 8, 'White', '8', 896, 0),
(84, 8, 'White', '9', 6333, 0),
(85, 8, 'White', '10', 6865, 0),
(86, 8, 'Pink', '6', 6536, 0),
(87, 8, 'Pink', '7', 638, 0),
(88, 8, 'Pink', '8', 6634, 0),
(89, 8, 'Pink', '9', 686, 0),
(90, 8, 'Pink', '10', 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ordersDate` datetime NOT NULL,
  `accountID` int(10) unsigned NOT NULL,
  `total` decimal(7,2) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders` (`accountID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `ordersDate`, `accountID`, `total`) VALUES
(1, '2020-11-09 17:37:22', 1, 135.90);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `category` char(4) NOT NULL,
  `gender` char(1) NOT NULL,
  `description` varchar(500) NOT NULL,
  `price` decimal(7,2) unsigned NOT NULL,
  `discount` float(4,2) unsigned DEFAULT '0.00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `category`, `gender`, `description`, `price`, `discount`) VALUES
(1, 'Nike MAX 2020', 'BRD', 'M', 'Comfortable experience in casual style.', 129.90, 0.00),
(2, 'Air RUN MAX', 'RUN', 'M', 'Running performance, at joy.', 199.90, 0.00),
(3, 'Air ZOOMX', 'RUN', 'W', 'Running performance, at joy.', 199.90, 0.00),
(4, 'Zebro Slipper', 'CAS', 'W', 'Casual style.', 39.90, 0.00),
(5, 'Air JORDAN F', 'BAS', 'W', 'Beyond capable and controllable.', 399.90, 0.00),
(6, 'Air JORDAN M', 'BAS', 'M', 'Beyond capable and controllable.', 399.90, 0.00),
(7, 'Nike MAX SE', 'CAS', 'M', 'Mate on the ground.', 199.90, 0.00),
(8, 'Nike ZOOM', 'RUN', 'W', 'Running performance, at joy.', 249.90, 0.00);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
