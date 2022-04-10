-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 10, 2022 at 09:19 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_rahul`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`addressId`, `customerId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shipping`) VALUES
(1, 1, 'djhfiujrfMandir Bhargav Road Kubernagar', 382340, 'Ahmedabad', 'Gujarat', 'dfdf', 0, 0),
(11, 22, 'dsfsff', 382340, 'Ahmedabad', 'Gujarat', 'jnkjk', 1, 0),
(12, 23, 'sdoif', 382340, 'Ahmedabad', 'Gujarat', 'sansju', 1, 0),
(48, 28, 'sddjfisfd', 382340, 'Ahmedabad', 'Gujarat', 'england', 1, 0),
(49, 29, '37/ Chandan Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 0),
(50, 30, 'muhar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(51, 31, 'mkssodoksd', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 1),
(52, 42, 'dfns,a', 0, 'fsjbm,', 'fbdm,js', 'dvjns,', 1, 1),
(53, 43, 'dfns,a', 0, 'fsjbm,', 'fbdm,js', 'dvjns,', 1, 1),
(54, 44, 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(55, 45, '37/ Chandan Nagar', 121, 'surat', 'Gujarat', 'India', 1, 0),
(56, 46, 'rahul', 453, 'snjd,', 'fskn,', 'flnkaj', 1, 1),
(57, 47, 'rahul', 54312, 'jndqak', 'njbhkqfa', ' mfansw', 1, 1),
(58, 48, 'ndka', 456, 'njkqdfeh', 'qnfkj', 'kjqnf', 1, 1),
(59, 48, 'rshul', 0, '', 'whjg', 'qbjfdkh', 1, 1),
(61, 49, 'RAHUL', 0, 'JFSWBHS', 'SJK', 'SJAK', 0, 1),
(62, 50, ' NM', 1564, 'ND MB', 'H DBH', 'DQNJBM', 0, 1),
(63, 50, ' NM', 1564, 'ND MB', 'H DBH', 'DQNJBM', 0, 1),
(66, 51, 'rahul', 12, 'fak', 'faskbhj', 'fbakhj', 0, 1),
(67, 52, 'kjabshfdj', 123456, ' sndfmbhja', 'dvs,njk', 'dvsm,jnk', 1, 0),
(68, 52, 'dsvjk', 0, 'dvs,m njek', 'qdsv njwk', 'sdfekj', 0, 1),
(69, 52, 'dsvjk', 0, 'dvs,m njek', 'qdsv njwk', 'sdfekj', 0, 1),
(70, 53, 'djksjkfsd', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(71, 54, 'ssjdhjsd', 382340, 'Ahmedabad', 'Gujarat', ' mfansw', 0, 1),
(72, 58, 'ssjdhisud', 382340, 'Ahmedabad', 'Gujarat', 'SFJNM', 0, 1),
(73, 59, '37/ Chandan Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(74, 61, '37/ Chandan Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(75, 62, ' Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(76, 63, 'okkkk', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(77, 63, 'jay bhavani', 382340, 'Ahmedabad', 'Gujarat', ' mfansw', 0, 1),
(78, 64, 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'kunnu', 1, 0),
(79, 64, 'agar NR', 382340, 'Ahmedabad', 'Gujarat', 'munnu', 0, 1),
(80, 69, 'NR Mahakaliji', 382340, 'Surat', 'Gujarat', 'sjdsd', 1, 0),
(81, 70, 'NR Mahakaliji', 382340, 'Surat', 'Gujarat', 'sjdsd', 1, 0),
(82, 71, 'NR Mahakaliji', 382340, 'Jaamnagar', 'Gujarat', 'sjdsd', 1, 0),
(83, 71, 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'kuchhipudi', 'hsdjshds', 0, 1),
(84, 73, 'munu', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 0),
(92, 45, 'bhargav Road kubernagar', 380016, 'Ahmedabad', 'Gujarat', 'India', 0, 1),
(93, 29, 'chhunu', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 1),
(94, 29, 'munu', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(95, 30, 'nuhar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 1),
(96, 103, 'jdfhjdsf  dskfjhfd', 382340, 'Ahmedabad', 'Gujarat', 'India', 1, 0),
(97, 104, 'hakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(98, 105, 'mdnjddf', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(99, 105, 'sjdfsdfdsfdfdfd', 382340, 'Ahmedabad', 'Gujarat', 'qbjfdkh', 0, 1),
(100, 81, '', 0, '', '', '', 1, 0),
(101, 81, '', 0, '', '', '', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(10) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(25) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `firstName`, `lastName`, `email`, `password`, `status`, `createdDate`, `updatedDate`) VALUES
(85, 'nbhujgtg', 'Prajapati', 'prajapatirahul43868@gmail.com', '', 1, '0000-00-00 00:00:00', '2022-04-06 19:04:23'),
(86, 'manoj', 'Prajapati', 'deshu@gmail.com', '8a09b0a6f765e4345f0ae03f5', 1, '0000-00-00 00:00:00', '2022-03-12 13:03:23'),
(87, 'muku', 'Prajapati', 'deshu@gmail.com', '8a09b0a6f765e4345f0ae03f5', 1, '2022-03-12 12:03:05', '2022-03-12 13:03:48'),
(94, 'Rahul', 'makvana', 'deshu@gmail.com', 'a3ad34c11ab46148d6c79c3d7', 1, '2022-03-17 18:03:20', '2022-03-17 19:03:06'),
(102, 'vgy', 'Prajapati', 'prajapatirahul43868@gmail.com', 'sdsdsdsd', 1, '2022-04-02 12:04:02', '2022-04-02 18:04:21'),
(103, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'sdsdsdsd', 1, '2022-04-02 12:04:02', NULL),
(104, 'munu', 'Prajapati', 'prajapatirahul43868@gmail.com', 'sdsd', 1, '2022-04-02 12:04:44', NULL),
(105, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'qsssd', 1, '2022-04-02 12:04:45', NULL),
(106, 'mknj', 'Prajapati', 'prajapatirahul43868@gmail.com', 'hsjhd', 1, '2022-04-02 12:04:39', NULL),
(108, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'ssdsd', 1, '2022-04-02 12:04:23', NULL),
(109, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'SSS', 1, '2022-04-02 13:04:04', NULL),
(110, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'ssdsds', 1, '2022-04-02 13:04:30', NULL),
(111, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'shdshd', 1, '2022-04-02 13:04:42', NULL),
(112, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'SSs', 1, '2022-04-02 13:04:03', NULL),
(113, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'xzcc', 1, '2022-04-02 13:04:30', NULL),
(114, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'zxzxzc', 1, '2022-04-02 13:04:44', NULL),
(116, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'jhjh', 1, '2022-04-02 15:04:19', NULL),
(117, 'Munni', 'Prajapati', 'prajapatirahul43868@gmail.com', 'asdf', 2, '2022-04-02 18:04:24', NULL),
(119, 'kk', 'kk', 'kk@gmil.com', '1254', 1, '2022-04-06 11:04:19', NULL),
(120, 'gt', 'jhd', 'hyt@gmail.com', '', 1, '2022-04-06 11:04:15', '2022-04-06 20:04:51'),
(121, 'djxn', 'kfj', 'sd@gmail.com', 'jjd', 1, '2022-04-06 12:04:52', NULL),
(122, 'djxn', 'kfj', 'sd@gmail.com', 'jjd', 1, '2022-04-06 12:04:00', NULL),
(123, 'Rahulfffff', 'Prajapati', 'prajapatirahul43868@gmail.com', 'ffffff', 1, '2022-04-06 12:04:36', NULL),
(124, 'Rahulfffff', 'Prajapati', 'prajapatirahul43868@gmail.com', 'ffffff', 1, '2022-04-06 12:04:37', NULL),
(125, 'Rahulfffff', 'Prajapati', 'prajapatirahul43868@gmail.com', 'ffffff', 1, '2022-04-06 12:04:13', NULL),
(126, 'Rahulfffff', 'Prajapati', 'prajapatirahul43868@gmail.com', 'ffffff', 2, '2022-04-06 12:04:22', NULL),
(127, 'srh', 'wnej', 'ehje@gmail.com', 'sjdsdfdf', 1, '2022-04-06 19:04:11', NULL),
(128, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'jgjh', 1, '2022-04-06 19:04:49', NULL),
(129, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'jgjh', 1, '2022-04-06 19:04:54', NULL),
(130, 'dsjhf', 'sjfj', 'ljre@gmil.com', 'ushe', 1, '2022-04-06 19:04:47', NULL),
(131, 'dsjhf', 'sjfj', 'ljre@gmil.com', 'ushe', 1, '2022-04-06 19:04:39', NULL),
(132, 'dsjhf', 'sjfj', 'ljre@gmil.com', 'ushe', 1, '2022-04-06 19:04:41', NULL),
(133, 'dsjhf', 'sjfj', 'ljre@gmil.com', 'ushe', 1, '2022-04-06 19:04:42', NULL),
(134, 'mdjnf', 'kjkhfj', 'jjhrje@gmil.com', 'sje', 1, '2022-04-06 19:04:36', NULL),
(135, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'ututut', 1, '2022-04-06 19:04:55', NULL),
(136, 'jrjr', 'sjeje', 'esnrlk@gmail.com', 'jkjrr', 1, '2022-04-06 19:04:32', NULL),
(137, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 'fuyfy', 1, '2022-04-06 19:04:51', NULL),
(138, 'hjgjh', 'jgjh', 'jhkj@gmail.com', 'ksmdk', 1, '2022-04-06 20:04:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `subTotal` float DEFAULT NULL,
  `paymentMethod` int(11) DEFAULT NULL,
  `shippingMethod` int(11) DEFAULT NULL,
  `deliveryCharge` float DEFAULT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartId`, `customerId`, `subTotal`, `paymentMethod`, `shippingMethod`, `deliveryCharge`, `createdDate`, `updatedDate`) VALUES
(1, 29, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(2, 30, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(3, 77, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(4, 42, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(5, 43, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(6, 49, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(7, 48, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(8, 44, NULL, 2, 1, 250, '0000-00-00 00:00:00', NULL),
(9, 45, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(10, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(11, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(12, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(13, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(14, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(15, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(16, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(17, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(18, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(19, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(20, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(21, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(22, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(23, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(24, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(25, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(26, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(27, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(28, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(29, 70, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL),
(30, 0, NULL, NULL, NULL, NULL, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `addressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `billing` tinyint(1) NOT NULL DEFAULT 0,
  `shipping` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_address`
--

INSERT INTO `cart_address` (`addressId`, `cartId`, `address`, `postalCode`, `city`, `state`, `country`, `billing`, `shipping`) VALUES
(1, 1, 'chhunu', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 1),
(2, 1, 'munu', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(3, 3, 'fgkfgNagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 1),
(4, 3, '37/ Chandan Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(5, 2, 'nuhar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 1),
(6, 2, 'muhar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0),
(7, 8, 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 0, 1),
(8, 8, 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `itemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` float NOT NULL,
  `price` float NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_item`
--

INSERT INTO `cart_item` (`itemId`, `cartId`, `productId`, `quantity`, `discount`, `price`, `createdDate`, `updatedDate`) VALUES
(1, 7, 2, 20, 0, 19000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 8, 2, 20, 0, 19000, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cart_payment`
--

CREATE TABLE `cart_payment` (
  `paymentId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `note` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_payment`
--

INSERT INTO `cart_payment` (`paymentId`, `name`, `note`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'QR', '', 0, '0000-00-00 00:00:00', NULL),
(2, 'Credit Card/Debit Card', '', 0, '2022-03-23 07:06:30', '2022-03-23 07:06:30'),
(3, 'UPI', '', 0, '2022-03-23 07:07:25', '2022-03-23 07:07:25'),
(4, 'COD', '', 0, '2022-03-23 07:08:28', '2022-03-23 07:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `cart_shipping`
--

CREATE TABLE `cart_shipping` (
  `shippingId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `amount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart_shipping`
--

INSERT INTO `cart_shipping` (`shippingId`, `name`, `note`, `amount`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'EXPRESS DELIVERY', 'GOOD', 250, 0, '2022-03-23 06:33:40', '2022-03-23 06:33:40'),
(2, 'NORMAL DELIVERY', 'GOOD', 50, 0, '2022-03-23 06:34:46', '2022-03-23 06:34:46'),
(3, 'SAME DAY DELIVERY', 'GOOD', 200, 0, '2022-03-23 06:34:46', '2022-03-23 06:34:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(10) NOT NULL,
  `parentId` int(10) DEFAULT NULL,
  `path` varchar(100) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `parentId`, `path`, `name`, `status`, `createdDate`, `updatedDate`) VALUES
(82, 82, '82', 'Sofaaa', 2, '2022-02-13 12:02:43', '2022-04-06 21:04:19'),
(101, 101, '101', 'Livingrooms', 1, '2022-02-14 01:02:01', '2022-03-16 23:03:02'),
(102, 101, '101/102', 'Sofa', 1, '2022-02-14 01:02:13', NULL),
(103, 103, '101/103', 'Sofa', 1, '2022-02-28 11:02:44', '2022-03-16 23:03:01'),
(104, 104, '101/104', 'Chair', 1, '2022-03-08 15:58:18', '2022-03-12 17:03:31'),
(141, 0, '', 'jhj', 1, '2022-04-06 21:04:41', NULL),
(142, 0, '', 'jhj', 1, '2022-04-06 21:04:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category_image`
--

CREATE TABLE `category_image` (
  `imageId` int(11) NOT NULL,
  `categoryId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `base` tinyint(2) NOT NULL DEFAULT 2,
  `thumbnail` tinyint(2) NOT NULL DEFAULT 2,
  `small` tinyint(2) NOT NULL DEFAULT 2,
  `gallery` tinyint(2) NOT NULL DEFAULT 2,
  `remove` tinyint(2) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_image`
--

INSERT INTO `category_image` (`imageId`, `categoryId`, `name`, `base`, `thumbnail`, `small`, `gallery`, `remove`) VALUES
(1, 82, '20220228225441.jpg', 2, 2, 2, 1, 2),
(2, 82, '20220228225453.jpg', 2, 2, 2, 1, 2),
(4, 82, '20220305151235.jpg', 2, 2, 2, 1, 2),
(5, 101, '20220312172656.jpg', 1, 1, 1, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

CREATE TABLE `category_product` (
  `entityId` int(11) NOT NULL,
  `productId` int(10) DEFAULT NULL,
  `categoryId` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`entityId`, `productId`, `categoryId`) VALUES
(2, 51, 83),
(3, 51, 100),
(170, 13, 83),
(171, 13, 100),
(172, 13, 101),
(173, 13, 103),
(189, 1, 100),
(190, 1, 101),
(191, 1, 103),
(192, 24, 104),
(193, 35, 114),
(194, 35, 115),
(201, 4, 83),
(202, 4, 114),
(203, 4, 115);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `code` varchar(30) NOT NULL,
  `value` varchar(255) NOT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `name`, `code`, `value`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'huhuhu', 'gdf', 'dgfdg', 2, '2022-02-03 12:52:53', '2022-04-06 21:04:37'),
(8, 'wee', 'wsa', 'dfdfd', 1, '2022-04-03 18:23:16', '2022-04-03 18:23:16'),
(19, 'ksnj', 'sdn', 'ldk', 1, '2022-04-06 12:04:12', NULL),
(20, 's,dm ', 'jnsd', 'jnd', 1, '2022-04-06 12:04:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `salesmanId` int(11) DEFAULT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(29, NULL, 'mukunu', 'Prajapati', 'rahul@gmail.com', 9558298, 2, '2022-03-12 16:03:20', '2022-04-06 10:04:49'),
(30, 1, 'Rahul', 'Prajapati', 'rahul@gmail.com', 9558291, 1, '2022-03-12 18:03:31', '2022-03-14 09:03:35'),
(42, NULL, 'jhdsak', 'dnjsz,', ',JVADNMB', 12342, 1, '2022-03-15 11:03:52', NULL),
(43, NULL, 'jhdsak', 'dnjsz,', ',JVADNMB', 12342, 1, '2022-03-15 11:03:21', NULL),
(44, NULL, 'nisarg', 'dsa,jn', 'ndjsa,', 321, 1, '2022-03-15 11:03:11', NULL),
(45, NULL, 'nsciddcnj', 'njsfdbhsjm', 'fdsmj', 123, 1, '2022-03-15 11:03:57', NULL),
(46, NULL, 'jands,', 'snfjm', 'smn,', 15634, 1, '2022-03-15 11:03:27', NULL),
(47, NULL, 'afnk', 'snmf', 'snmf', 4563, 1, '2022-03-15 11:03:20', NULL),
(48, NULL, 'asuk', 'casbjh', '31254', 21213, 1, '2022-03-15 11:03:59', NULL),
(63, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 9558298, 1, '2022-03-15 22:03:50', '2022-03-15 22:03:01'),
(69, NULL, 'Manoj', 'Prajapati', 'rahul@gmail.com', 58298958, 1, '2022-03-19 11:03:47', NULL),
(70, NULL, 'Manoj', 'Prajapati', 'rahul@gmail.com', 58298958, 1, '2022-03-19 11:03:10', NULL),
(71, NULL, 'Manoj', 'Prajapati', 'rahul@gmail.com', 58298958, 1, '2022-03-19 12:03:16', '2022-03-19 12:03:38'),
(77, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 58298958, 1, '2022-03-19 20:03:07', '2022-03-19 21:03:14'),
(79, NULL, 'Savit', 'hsdbhdb', 'hsdd@gmail.com', 123456, 2, '2022-03-27 19:03:41', NULL),
(80, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 558298958, 1, '2022-03-27 22:03:27', NULL),
(82, NULL, 'mnhu', 'Prajapati', 'rahul@gmail.com', 558298958, 1, '2022-03-27 23:03:51', NULL),
(83, NULL, 'manoj', 'Prajapati', 'deshu@gmail.com', 558298958, 1, '2022-03-28 10:03:23', NULL),
(84, NULL, 'manoj', 'Prajapati', 'deshu@gmail.com', 558298958, 1, '2022-03-28 10:03:13', NULL),
(85, NULL, 'sejal', 'Prajapati', 'deshu@gmail.com', 558298958, 1, '2022-03-28 10:03:53', NULL),
(86, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 558298958, 1, '2022-03-28 13:03:03', NULL),
(87, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 558298958, 1, '2022-03-28 13:03:24', NULL),
(88, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 558298958, 1, '2022-03-28 13:03:28', NULL),
(89, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 558298958, 1, '2022-03-28 13:03:51', '2022-03-28 13:03:55'),
(90, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:08', NULL),
(91, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:26', NULL),
(92, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:59', NULL),
(93, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:35', NULL),
(94, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:54', NULL),
(95, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:25', NULL),
(96, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:00', NULL),
(97, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:35', NULL),
(98, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:04', NULL),
(99, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:30', '2022-03-28 13:03:52'),
(100, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:57', NULL),
(101, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:33', NULL),
(102, NULL, 'Rahul', 'Prajapati', 'rahul@gmail.com', 2147483647, 1, '2022-03-28 13:03:56', NULL),
(103, NULL, 'JUgadram', 'Prajapati', 'rahul@gmail.com', 558298958, 1, '2022-03-28 19:03:22', NULL),
(105, NULL, 'muku', 'Prajapati', 'rahul@gmail.com', 558298958, 1, '2022-03-28 19:03:25', '2022-03-28 20:03:52'),
(107, NULL, 'dsfsd', 'dsdnq', 'lkslk', 14785, 2, '2022-04-06 00:04:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_price`
--

CREATE TABLE `customer_price` (
  `entityId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `price` float(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_price`
--

INSERT INTO `customer_price` (`entityId`, `customerId`, `productId`, `price`) VALUES
(1, 4, 1, 11.40),
(2, 4, 2, 999.99),
(3, 4, 4, 949.99),
(4, 4, 10, 11.40),
(5, 4, 13, 38.95),
(6, 4, 17, 11.40),
(7, 4, 18, 11.40),
(8, 4, 19, 11.40),
(9, 4, 24, 11.40),
(10, 4, 26, 11.40),
(11, 4, 28, 34.20),
(12, 4, 29, 10.45),
(13, 4, 30, 51.30),
(14, 4, 31, 51.30),
(15, 4, 35, 13.30);

-- --------------------------------------------------------

--
-- Table structure for table `image`
--

CREATE TABLE `image` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `base` tinyint(2) DEFAULT 2,
  `thumbnail` tinyint(2) DEFAULT 2,
  `small` tinyint(2) DEFAULT 2,
  `gallery` tinyint(2) DEFAULT 2,
  `remove` tinyint(2) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image`
--

INSERT INTO `image` (`imageId`, `productId`, `name`, `base`, `thumbnail`, `small`, `gallery`, `remove`) VALUES
(15, 51, '20220305144331.jpg', 2, 2, 2, 1, 2),
(16, 51, '20220305144353.jpg', 2, 2, 2, 1, 2),
(17, 51, '20220305170515.jpg', 2, 2, 2, 2, 2),
(18, 51, '20220305170547.jpg', 2, 2, 2, 2, 2),
(19, 51, '20220305195756.jpg', 2, 2, 2, 1, 2),
(20, 51, '20220305195922.jpg', 2, 2, 2, 1, 2),
(22, 10, '20220312214206.jpg', 2, 2, 2, 2, 2),
(23, 10, '20220312214221.jpg', 2, 2, 2, 2, 2),
(27, 35, '20220315233525.jpg', 2, 2, 2, 1, 2),
(28, 2, '20220331221238.jpg', 1, 1, 1, 1, 2),
(30, 35, '20220405102921.jpg', 2, 2, 2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `orderId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `grandTotal` float NOT NULL,
  `shippingId` int(11) NOT NULL,
  `shippingAmount` float NOT NULL,
  `paymentId` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT 2,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderId`, `customerId`, `firstName`, `lastName`, `mobile`, `email`, `grandTotal`, `shippingId`, `shippingAmount`, `paymentId`, `state`, `status`, `createdDate`) VALUES
(1, 44, 'Rahul', 'dsa,jn', 321, 'ndjsa,', 368850, 1, 250, 2, 1, 1, '2022-03-28 12:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `addressId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `mobile` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`addressId`, `orderId`, `firstName`, `lastName`, `mobile`, `email`, `address`, `postalCode`, `city`, `state`, `country`, `type`, `createdDate`) VALUES
(1, 1, 'rahul', 'dsa,jn', 321, 'ndjsa,', 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, '2022-03-28 12:39:25'),
(2, 1, 'rahul', 'dsa,jn', 321, 'ndjsa,', 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sjdsd', 1, '2022-03-28 12:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `itemId` int(11) NOT NULL,
  `orderId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sku` varchar(50) NOT NULL,
  `cost` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount` float NOT NULL,
  `taxPercentage` decimal(10,2) NOT NULL,
  `taxAmount` float NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`itemId`, `orderId`, `productId`, `name`, `sku`, `cost`, `price`, `quantity`, `discount`, `taxPercentage`, `taxAmount`, `createdDate`) VALUES
(1, 1, 2, 'mobile', 'mbi21', 19000, 19000, 20, 5, '2.00', 3, '2022-03-28 12:39:25');

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

CREATE TABLE `page` (
  `pageId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` varchar(30) NOT NULL,
  `content` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`pageId`, `name`, `code`, `content`, `status`, `createdDate`, `updatedDate`) VALUES
(19, 'saads20', 'sadsd19', 'dsadsadd', 2, '0000-00-00 00:00:00', '2022-04-06 12:04:57'),
(21, 'saads22', 'sadsd21', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 'saads23', 'sadsd22', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 'saads24', 'sadsd23', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 'saads25', 'sadsd24', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 'saads26', 'sadsd25', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 'saads27', 'sadsd26', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 'saads28', 'sadsd27', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 'saads29', 'sadsd28', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 'saads30', 'sadsd29', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 'saads33', 'sadsd32', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 'saads34', 'sadsd33', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 'saads35', 'sadsd34', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 'saads38', 'sadsd37', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 'saads39', 'sadsd38', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 'saads40', 'sadsd39', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 'saads41', 'sadsd40', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 'saads42', 'sadsd41', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 'saads45', 'sadsd44', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 'saads48', 'sadsd47', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 'saads49', 'sadsd48', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 'saads50', 'sadsd49', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 'saads51', 'sadsd50', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 'saads52', 'sadsd51', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 'saads53', 'sadsd52', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 'saads54', 'sadsd53', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 'saads55', 'sadsd54', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 'saads56', 'sadsd55', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 'saads57', 'sadsd56', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 'saads58', 'sadsd57', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 'saads59', 'sadsd58', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 'saads60', 'sadsd59', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 'saads61', 'sadsd60', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 'saads62', 'sadsd61', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 'saads63', 'sadsd62', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 'saads64', 'sadsd63', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 'saads65', 'sadsd64', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 'saads66', 'sadsd65', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 'saads67', 'sadsd66', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 'saads96', 'sadsd95', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 'saads97', 'sadsd96', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 'saads98', 'sadsd97', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 'saads99', 'sadsd98', 'dsadsadd', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 'asdsad', 'dfgg5', 'sdsadsd', 2, '2022-03-16 22:03:55', '2022-03-16 22:03:52'),
(110, 'asdsad', 'erdtf', 'rrtrttry', 1, '2022-03-29 08:03:00', NULL),
(114, 'asdsad', 'assas', 'sdsadsd', 1, '2022-03-29 12:03:08', NULL),
(115, 'nnnnn', 'mkjj', 'jhhkj', 1, '2022-03-29 12:03:11', NULL),
(116, 'sdjsdsjdsdjfidsfbj', 'kjhiuhiuhuui', 'jjhihi', 1, '2022-03-29 12:03:32', NULL),
(117, 'sdjsdsjdsdjfidsfbj', 'kjhiuhiuhuui', 'jjhihi', 1, '2022-03-29 12:03:33', NULL),
(118, 'rtuut', 'uer', 'uher', 1, '2022-03-29 12:03:39', NULL),
(119, 'rtuut', 'uer', 'uher', 1, '2022-03-29 12:03:39', NULL),
(120, 'sdsds', 'dd', 'rdtrd', 1, '2022-03-29 12:03:30', NULL),
(126, 'mukeshhhhh', '123', 'sdsadsd', 1, '2022-03-29 12:03:41', NULL),
(127, 'sdkjffj', 'lllll', 'jnkj', 1, '2022-03-29 12:03:13', NULL),
(128, 'mnjkh', 'lkjo', 'koij', 1, '2022-03-29 12:03:53', NULL),
(129, 'add new', 'newAdd', 'jsdjs', 1, '2022-03-29 20:03:52', NULL),
(130, 'kuku', 'kuku', 'kuku', 1, '2022-03-29 22:03:05', NULL),
(131, 'mml', 'mlml', 'mlm', 1, '2022-03-29 22:03:14', NULL),
(132, 'asdsad', 'assas', 'miki', 1, '2022-03-29 23:03:31', NULL),
(133, 'asdsad', '123', 'miki', 1, '2022-03-29 23:03:07', NULL),
(136, 'kum', 'kjuhu', 'khnh', 1, '2022-03-30 14:03:25', '2022-03-30 14:03:21'),
(137, 'muni', 'muni', 'nbjh', 1, '2022-04-04 08:04:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sku` varchar(10) NOT NULL,
  `map` float(5,2) NOT NULL,
  `msp` float(5,2) NOT NULL,
  `cost_price` float(5,2) NOT NULL,
  `price` float(5,2) NOT NULL,
  `quantity` int(10) NOT NULL,
  `discount` float DEFAULT NULL,
  `tax` float DEFAULT NULL,
  `taxAmount` float NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `name`, `sku`, `map`, `msp`, `cost_price`, `price`, `quantity`, `discount`, `tax`, `taxAmount`, `status`, `createdDate`, `updatedDate`) VALUES
(2, 'mobile', 'mbi21', 999.99, 0.00, 999.99, 999.99, 20, 5, 2, 3, 1, '2022-03-08 14:23:46', '2022-04-06 09:04:24'),
(4, 'iphone', 'mimi2', 999.99, 45.99, 999.99, 999.99, 10, 2, 2, 5, 1, '2022-03-09 12:23:11', '2022-03-11 01:03:51'),
(10, 'asdsad', 'jhsdf', 56789.00, 0.00, 56789.00, 12.00, 20, 5, 2, 5, 1, '2022-03-09 23:03:54', NULL),
(29, 'muku', '52', 12.00, 0.00, 11.00, 11.00, 11, 5, 2, 4, 1, '2022-03-10 18:03:53', NULL),
(31, 'asdsad', '65', 12.00, 0.00, 32.00, 54.00, 45, 5, 2, 5, 1, '2022-03-10 19:03:58', NULL),
(35, 'blenket', 'blk', 254.00, 0.00, 145.00, 14.00, 12, 5, 2, 1, 1, '2022-03-10 23:03:28', NULL),
(37, 'dsnfj', 'jnewk', 999.99, 12.00, 12.00, 12.00, 0, 10, NULL, 0, 1, '2022-04-06 21:04:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `salesman`
--

CREATE TABLE `salesman` (
  `salesmanId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) DEFAULT NULL,
  `discount` float(5,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `salesman`
--

INSERT INTO `salesman` (`salesmanId`, `firstName`, `lastName`, `email`, `mobile`, `discount`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 'Rahul', 'Prajapati', 'qsewqee', 95582989, 5.00, 1, '2022-03-01 00:16:09', '2022-04-04 09:04:05'),
(2, 'Rahul', 'Prajapati', 'qsewqee', 95582989, 0.00, 2, '2022-03-01 00:18:22', '2022-03-01 11:12:11'),
(3, 'munu', 'Prajapati', 'qsewqee', 95582989, 0.00, 1, '2022-03-01 00:18:58', '2022-04-04 09:04:38'),
(4, 'ji', 'Prajapati', 'qsewqee', 95582989, 10.00, 1, '2022-03-01 00:19:28', '2022-04-04 09:04:04'),
(7, 'miku', 'jssdj', 'sdsdj@gmail.com', 251436, 20.00, 1, '2022-03-09 12:14:10', NULL),
(13, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 2147483647, 8.00, 1, '2022-04-04 09:04:27', '2022-04-04 09:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `vendorId` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(52) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 2,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendorId`, `firstName`, `lastName`, `email`, `mobile`, `status`, `createdDate`, `updatedDate`) VALUES
(4, 'mun', 'Prajapati', 'aasas@gmail.com', 95582989, 2, '2022-03-12 16:03:53', '2022-04-05 18:04:19'),
(5, 'Rahul', 'Prajapati', 'aasas@gmail.com', 95582989, 1, '2022-03-12 16:03:24', NULL),
(6, 'Rahul', 'Prajapati', 'aasas@gmail.com', 95582989, 1, '2022-03-12 16:03:36', NULL),
(8, 'Rahul', 'Prajapati', 'aasas@gmail.com', 95582989, 1, '2022-03-12 17:03:39', NULL),
(9, 'DSNISJDF', 'Prajapati', 'aasas@gmail.com', 95582989, 2, '2022-03-12 17:03:49', '2022-03-12 17:03:39'),
(10, 'Rahul', 'Prajapati', 'aasas@gmail.com', 95582989, 1, '2022-03-12 18:03:20', '2022-03-12 18:03:36'),
(13, 'nisha', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-15 12:03:05', '2022-03-15 12:03:57'),
(14, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:26', NULL),
(15, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:51', NULL),
(16, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:10', NULL),
(17, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:31', NULL),
(18, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:41', NULL),
(19, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:59', NULL),
(20, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:56', NULL),
(21, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:40', NULL),
(23, 'Rahul', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 09:03:32', '2022-03-19 10:03:08'),
(25, 'Savitri', 'Prajapati', 'aasas@gmail.com', 95582989, 1, '2022-03-19 10:03:05', NULL),
(26, 'Savitry', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 10:03:16', NULL),
(30, 'Savitry', 'Prajapati', 'aasas@gmail.com', 9558298, 1, '2022-03-19 10:03:25', NULL),
(32, 'Rahul', 'Prajapati', 'aasas@gmail.com', 58298958, 1, '2022-03-19 10:03:09', NULL),
(33, 'Rahul', 'Prajapati', 'aasas@gmail.com', 58298958, 1, '2022-03-19 10:03:19', NULL),
(34, 'Rahul', 'Prajapati', 'aasas@gmail.com', 2147483647, 1, '2022-03-19 10:03:44', NULL),
(35, 'Rahul', 'Prajapati', 'aasas@gmail.com', 58298958, 1, '2022-03-19 10:03:46', NULL),
(36, 'Rahul', 'Prajapati', 'aasas@gmail.com', 58298958, 1, '2022-03-19 10:03:50', NULL),
(37, 'Rahul', 'Prajapati', 'aasas@gmail.com', 58298958, 1, '2022-03-19 10:03:10', NULL),
(38, 'Rahul', 'Prajapati', 'aasas@gmail.com', 58298958, 1, '2022-03-19 10:03:16', NULL),
(39, 'Rahul', 'Prajapati', 'aasas@gmail.com', 58298958, 1, '2022-03-19 10:03:33', NULL),
(40, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 10:03:36', NULL),
(41, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 10:03:40', NULL),
(42, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 10:03:51', NULL),
(43, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 11:03:13', NULL),
(44, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 11:03:34', NULL),
(45, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 11:03:15', NULL),
(46, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 11:03:21', NULL),
(47, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 11:03:21', NULL),
(48, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 11:03:10', NULL),
(49, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 11:03:46', NULL),
(50, 'Rahul', 'Prajapati', 'aasas@gmail.com', 58298958, 1, '2022-03-19 11:03:54', '2022-03-19 11:03:26'),
(55, 'Rahul', 'Prajapati', 'aasas@gmail.com', 558298958, 1, '2022-03-19 11:03:16', '2022-03-19 11:03:38'),
(56, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 2147483647, 1, '2022-03-31 22:03:42', NULL),
(57, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 2147483647, 1, '2022-03-31 22:03:52', NULL),
(58, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 2147483647, 1, '2022-03-31 23:03:06', NULL),
(59, 'Aadarsh', 'senger', 'senger@gmil.com', 25414, 1, '2022-04-05 16:04:22', NULL),
(60, 'payal', 'pukhi', 'pauah@gmail.com', 124575, 1, '2022-04-05 17:04:19', NULL),
(61, 'suraj', 'mukhu', 'ksdfk@gmail.com', 5655465, 1, '2022-04-05 17:04:50', NULL),
(62, 'suman', 'devi', 'devi@gmail.com', 54215, 1, '2022-04-05 17:04:30', NULL),
(63, 'nigam', 'minh', 'sjkdj@gmail.com', 451575, 1, '2022-04-05 18:04:11', NULL),
(64, 'sjndjk', 'jsndjsk', 'nsd@gmail.com', 4521, 1, '2022-04-05 18:04:23', NULL),
(65, 'djnfdkj', 'sds', 'djnfj@gmail.com', 52145, 1, '2022-04-05 18:04:06', NULL),
(66, 'demo', 'demo', 'demo@gmail.com', 254154, 1, '2022-04-05 22:04:12', NULL),
(67, 'demo', 'demo', 'demo@gmail.com', 254154, 1, '2022-04-05 22:04:14', NULL),
(68, 'demo', 'demo', 'demo@gmail.com', 254154, 1, '2022-04-05 22:04:15', NULL),
(69, 'demo', 'demo', 'demo@gmail.com', 254154, 1, '2022-04-05 22:04:24', NULL),
(70, 'demo', 'demo', 'evi@gmail.com', 1254, 1, '2022-04-05 22:04:59', NULL),
(71, 'demo', 'demo', 'evi@gmail.com', 1254, 1, '2022-04-05 22:04:18', NULL),
(72, 'ssmd', 'snd', 'smdn@gmil.com', 2154, 1, '2022-04-05 22:04:13', NULL),
(73, 'skjdn', 'jsdi', 'jndjiw', 2154, 1, '2022-04-05 22:04:38', NULL),
(74, 'dsn', 'jsndj', 'djnf', 1245, 1, '2022-04-05 23:04:16', NULL),
(75, 'dsf', 'llklkf', 'ddkflk@gmail.com', 2546, 1, '2022-04-05 23:04:00', NULL),
(76, 'kuni', 'nkhu', 'njh@gmail.com', 2356, 1, '2022-04-05 23:04:29', NULL),
(77, 'sdjjd', 'jskdn', 'jdn@gmail.com', 14524, 1, '2022-04-05 23:04:00', NULL),
(78, 'ewjfn', 'jknd', 'kjjfn@gmil.com', 546565, 1, '2022-04-05 23:04:00', NULL),
(79, 'jndkjew', 'jnj', 'ndjk@gmial.com', 465465, 1, '2022-04-05 23:04:51', NULL),
(80, 'djnj', 'jwenj', 'jenejw@gmail.com', 1245, 1, '2022-04-05 23:04:52', NULL),
(81, 'ejrwer', 'eehrihe', 'erh@gmail.com', 421, 1, '2022-04-05 23:04:20', NULL),
(82, 'ewkjbi', 'jne', 'jenw@gmail.com', 147, 1, '2022-04-05 23:04:30', NULL),
(83, 'iuhwiw', 'jhej', 'heiujh@gmail.com', 145, 1, '2022-04-06 00:04:37', NULL),
(84, 'Rahul', 'Prajapati', 'prajapatirahul43868@gmail.com', 2147483647, 1, '2022-04-06 00:04:08', NULL),
(85, 'dheh', 'wheihjh', 'weh@gmail.com', 14785, 1, '2022-04-06 00:04:51', NULL),
(86, 'lkfdlfjl', 'dndfd', 'lqwkj@gmail.com', 2546, 1, '2022-04-06 21:04:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_address`
--

CREATE TABLE `vendor_address` (
  `addressId` int(11) NOT NULL,
  `vendorId` int(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `postalCode` int(6) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vendor_address`
--

INSERT INTO `vendor_address` (`addressId`, `vendorId`, `address`, `postalCode`, `city`, `state`, `country`) VALUES
(4, 4, 'sdksdd', 382, 'Ahmedabad', 'Gujarat', 'sadsadsd'),
(5, 9, 'NR Mahakaliji', 382340, 'Ahmedabad', 'sSS', 'sadsadsd'),
(6, 10, 'xklcmlkdf', 382344, 'Ahmedabad', 'Gujarat', 'sadsadsd'),
(9, 13, 'sdsfkd', 382340, 'newTork', 'Rajsthan', 'sadsadsd'),
(11, 23, 'Nagar NR', 382340, 'Ahmedabad', 'Gujarat', 'sadsadsd'),
(13, 50, 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'sadsadsd'),
(17, 50, 'Nagar NR Mahakaliji', 382340, 'surat', 'Gujarat', 'sadsadsd'),
(18, 55, 'Nagar NR Mahakaliji', 382340, 'Surat', 'Gujarat', 'sadsadsd'),
(19, 56, 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'India'),
(20, 57, 'Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'India'),
(21, 58, 'Chandan Nagar NR Mahakaliji', 382340, 'Ahmedabad', 'Gujarat', 'India');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `foreign key` (`customerId`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`addressId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`itemId`);

--
-- Indexes for table `cart_payment`
--
ALTER TABLE `cart_payment`
  ADD PRIMARY KEY (`paymentId`);

--
-- Indexes for table `cart_shipping`
--
ALTER TABLE `cart_shipping`
  ADD PRIMARY KEY (`shippingId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`),
  ADD KEY `category` (`parentId`);

--
-- Indexes for table `category_image`
--
ALTER TABLE `category_image`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `category_product`
--
ALTER TABLE `category_product`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`);

--
-- Indexes for table `customer_price`
--
ALTER TABLE `customer_price`
  ADD PRIMARY KEY (`entityId`);

--
-- Indexes for table `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`orderId`),
  ADD KEY `orders_ibfk_1` (`customerId`),
  ADD KEY `shippingId` (`shippingId`),
  ADD KEY `paymentId` (`paymentId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`itemId`),
  ADD UNIQUE KEY `sku` (`sku`),
  ADD KEY `order_item_ibfk_1` (`orderId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `page`
--
ALTER TABLE `page`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`),
  ADD UNIQUE KEY `sku` (`sku`);

--
-- Indexes for table `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`salesmanId`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`vendorId`);

--
-- Indexes for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `vendorId` (`vendorId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_payment`
--
ALTER TABLE `cart_payment`
  MODIFY `paymentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cart_shipping`
--
ALTER TABLE `cart_shipping`
  MODIFY `shippingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;

--
-- AUTO_INCREMENT for table `category_image`
--
ALTER TABLE `category_image`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `category_product`
--
ALTER TABLE `category_product`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `customer_price`
--
ALTER TABLE `customer_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `image`
--
ALTER TABLE `image`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `itemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `page`
--
ALTER TABLE `page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `salesman`
--
ALTER TABLE `salesman`
  MODIFY `salesmanId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `vendorId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `vendor_address`
--
ALTER TABLE `vendor_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `category_image`
--
ALTER TABLE `category_image`
  ADD CONSTRAINT `category_image_ibfk_1` FOREIGN KEY (`categoryId`) REFERENCES `categories` (`categoryId`) ON DELETE CASCADE;

--
-- Constraints for table `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`),
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`shippingId`) REFERENCES `cart_shipping` (`shippingId`),
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`paymentId`) REFERENCES `cart_payment` (`paymentId`);

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`);

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `orders` (`orderId`),
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`);

--
-- Constraints for table `vendor_address`
--
ALTER TABLE `vendor_address`
  ADD CONSTRAINT `vendor_address_ibfk_1` FOREIGN KEY (`vendorId`) REFERENCES `vendor` (`vendorId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
