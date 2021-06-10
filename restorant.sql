-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2021 at 09:13 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `restorant`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `pref` varchar(10) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Id`, `fname`, `lname`, `pref`, `address`, `phone_no`, `pass`) VALUES
(1, 'Rus', 'Potd', 'veg', 'A/p Kavhtepiran, Miraj', 253, 'asd'),
(2, 'adam', 'zampa', 'veg', 'oppo conter, gao bagh, sangli', 555, 'asd');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `action` varchar(20) NOT NULL COMMENT 'cart or buy',
  `quantity` int(11) NOT NULL,
  `amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `cust_id`, `seller_id`, `status`, `product_id`, `action`, `quantity`, `amount`) VALUES
(24, 1, 1, 'Accepted', 23, 'buy', 1, 10),
(27, 1, 1, 'Cancel', 23, 'buy', 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `pname` varchar(50) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `pref` varchar(10) NOT NULL,
  `new price` int(11) NOT NULL,
  `descri` text DEFAULT NULL,
  `img1` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `seller_id`, `pname`, `brand`, `pref`, `new price`, `descri`, `img1`) VALUES
(18, 1, 'Oreo', 'Biscuits', 'veg', 28, 'Oreo taste great', 'p4.jpg'),
(19, 2, 'Himalaya', 'Soap', 'veg', 22, 'Feel the chill air', 'p1.png'),
(20, 2, 'Detol', 'Soap', 'veg', 25, 'Kills all gems', 'p3.jpg'),
(21, 2, 'Haldi Chandan', 'Soap', 'veg', 28, 'Haldi jaisi twacha', 'p2.jpg'),
(23, 1, 'Parle G', 'Biscuits ', 'veg', 10, 'Parle G... G mane Genius ', 'p5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `seller`
--

CREATE TABLE `seller` (
  `Id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `phone_no` int(11) NOT NULL,
  `pass` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seller`
--

INSERT INTO `seller` (`Id`, `fname`, `lname`, `phone_no`, `pass`) VALUES
(1, 'Shridhar', 'Potdar', 123, 'asd'),
(2, 'Raju', 'Varma', 333, 'asd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`Id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `seller`
--
ALTER TABLE `seller`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
