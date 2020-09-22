-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2020 at 08:03 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventory_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `bid` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`bid`, `brand_name`, `status`) VALUES
(11, 'LG', '1'),
(12, 'GUCCI', '1'),
(16, 'bata', '1'),
(17, 'samsung', '1'),
(20, 'anabolla', '1'),
(23, 'indomaret', '1'),
(24, 'phillips ', '1');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cid` int(11) NOT NULL,
  `parent_cat` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cid`, `parent_cat`, `category_name`, `status`) VALUES
(1, 0, 'Electronics', '1'),
(2, 0, 'Clothes', '1'),
(44, 0, 'Software', '1'),
(45, 0, 'Grocery product', '1'),
(46, 0, 'Footwear', '1'),
(48, 2, 'mens wear', '1'),
(49, 2, 'women wear', '1'),
(50, 2, 'kids wear', '1'),
(52, 44, 'filmora video editing ', '1'),
(53, 44, 'Photoshop design software', '1'),
(55, 44, 'illustrator', '1');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `invoice_no` int(11) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `order_date` date NOT NULL,
  `sub_total` double NOT NULL,
  `gst` double NOT NULL,
  `discount` double NOT NULL,
  `net_total` double NOT NULL,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `payment_type` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_no`, `customer_name`, `order_date`, `sub_total`, `gst`, `discount`, `net_total`, `paid`, `due`, `payment_type`) VALUES
(1, 'krishna', '2020-08-24', 5664, 1019.52, 0, 6683.52, 6683.52, 0, ''),
(2, 'krishna', '2020-08-24', 5664, 1019.52, 0, 6683.52, 6683.52, 0, ''),
(3, 'riddhi', '2020-08-24', 2866, 515.88, 0, 3381.88, 3381.88, 0, ''),
(4, 'riddhi', '2020-08-24', 2866, 515.88, 0, 3381.88, 3381.88, 0, ''),
(5, 'jamila', '2020-08-24', 1332, 239.76, 0, 1571.76, 1571.76, 0, ''),
(6, 'hhh', '2020-08-24', 444, 79.92, 0, 523.92, 523.92, 0, ''),
(7, 'mmm', '2020-08-24', 666, 119.88, 0, 785.88, 785.88, 0, ''),
(8, 'kkkika', '2020-08-24', 2500, 450, 0, 2950, 2950, 0, ''),
(9, 'kaju', '2020-08-24', 11776, 2119.68, 0, 13895.68, 13895.68, 0, ''),
(10, 'rahul', '2020-09-16', 1332, 239.76, 0, 1571.76, 1571.76, 0, ''),
(11, 'milan', '2020-09-18', 1100, 198, 0, 1298, 1298, 0, ''),
(12, 'drashti', '2020-09-18', 444, 79.92, 0, 523.92, 523.92, 0, ''),
(13, 'kkk', '2020-09-18', 0, 0, 0, 0, 0, 0, ''),
(14, '', '2020-09-18', 0, 0, 0, 0, 0, 0, ''),
(15, '', '2020-09-18', 0, 0, 0, 0, 0, 0, ''),
(16, '', '2020-09-18', 0, 0, 0, 0, 0, 0, ''),
(17, '', '2020-09-18', 0, 0, 0, 0, 0, 0, ''),
(18, '', '2020-09-18', 0, 0, 0, 0, 0, 0, ''),
(19, 'minati', '2020-09-18', 444, 79.92, 0, 523.92, 0, 523.92, ''),
(20, '', '2020-09-18', 666, 119.88, 0, 785.88, 785.88, 0, 'cash'),
(21, 'jigar dave', '2020-09-18', 666, 119.88, 0, 785.88, 785.88, 0, 'cash'),
(22, 'veena', '2020-09-18', 444, 79.92, 0, 523.92, 523.92, 0, 'draft'),
(23, 'aan patel', '2020-09-18', 11000, 1980, 0, 12980, 12980, 0, 'cheque'),
(24, 'leelaben', '2020-09-18', 20000, 3600, 0, 23600, 23600, 0, 'cheque'),
(25, 'monica pandya', '2020-09-18', 2220, 399.59999999999997, 0, 2619.6, 2619.6, 0, 'card'),
(26, 'snehal patel', '2020-09-18', 1332, 239.76, 0, 1571.76, 1571.76, 0, 'draft'),
(27, 'snehal', '2020-09-18', 1332, 239.76, 0, 1571.76, 1571.76, 0, 'draft'),
(28, 'snehal', '2020-09-18', 1332, 239.76, 0, 1571.76, 1571.76, 0, 'card'),
(29, 'prince patel', '2020-09-18', 2220, 399.59999999999997, 0, 2619.6, 2619.6, 0, 'card'),
(30, 'ashish', '2020-09-18', 5944, 1069.92, 0, 7013.92, 7013.92, 0, 'cheque'),
(31, 'kajal', '2020-09-18', 5644, 1015.92, 0, 6659.92, 3119.92, 6659.92, 'draft'),
(32, 'kaju', '2020-09-19', 2000, 360, 0, 2360, 2360, 0, 'card'),
(33, 'munmun', '2020-09-19', 2000, 360, 0, 2360, 2360, 0, 'draft'),
(34, 'kuku', '2020-09-19', 2000, 360, 0, 2360, 2360, 0, 'draft'),
(35, 'pavitra punya', '2020-09-22', 2220, 399.59999999999997, 0, 2619.6, 2619.6, 0, 'card'),
(36, 'rana hetal', '2020-09-22', 1998, 359.64, 0, 2357.64, 2357.64, 0, 'cash');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_details`
--

CREATE TABLE `invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_no` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `invoice_details`
--

INSERT INTO `invoice_details` (`id`, `invoice_no`, `product_name`, `price`, `qty`) VALUES
(1, 8, 'women green DRESS PAIR', 2500, 1),
(2, 9, 'baby girl skirt', 444, 1),
(3, 9, 'women yellow pajama', 666, 2),
(4, 9, 'women green DRESS PAIR', 2500, 4),
(5, 10, 'women carrot kurta', 666, 2),
(6, 11, 'mens black  jabbha-payjama', 1100, 1),
(7, 12, 'baby girl skirt', 444, 1),
(8, 13, '', 0, 1),
(9, 14, '', 0, 0),
(10, 15, '', 0, 0),
(11, 16, '', 0, 0),
(12, 17, '', 0, 0),
(13, 18, '', 0, 0),
(14, 19, 'baby girl skirt', 444, 1),
(15, 20, 'women yellow pajama', 666, 1),
(16, 21, 'women yellow pajama', 666, 1),
(17, 22, 'baby girl skirt', 444, 1),
(18, 23, 'mens black  jabbha-payjama', 1100, 10),
(19, 28, 'baby girl skirt', 444, 3),
(20, 29, 'baby girl skirt', 444, 5),
(21, 30, 'baby girl skirt', 444, 1),
(22, 30, 'mens black  jabbha-payjama', 1100, 5),
(23, 31, 'baby girl skirt', 444, 1),
(24, 31, 'mens black  jabbha-payjama', 1100, 2),
(25, 31, 'woman black gagara', 1000, 3),
(26, 32, 'women yellow kurta-Black payjama', 2000, 1),
(27, 33, 'women yellow kurta-Black payjama', 2000, 1),
(28, 34, 'women yellow kurta-Black payjama', 2000, 1),
(29, 35, 'women carrot kurta', 666, 2),
(30, 35, 'baby girl skirt', 444, 2),
(31, 36, 'women carrot kurta', 666, 1),
(32, 36, 'baby girl skirt', 444, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `pid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` double NOT NULL,
  `product_stock` int(11) NOT NULL,
  `added_date` date NOT NULL,
  `p_status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`pid`, `cid`, `bid`, `product_name`, `product_price`, `product_stock`, `added_date`, `p_status`) VALUES
(89, 49, 12, 'women yellow kurta-Black payjama', 2000, 197, '2020-08-02', '1'),
(90, 2, 20, 'women yellow pajama', 666, 20, '2020-08-01', '1'),
(96, 49, 20, 'women carrot kurta', 666, 41, '2020-08-01', '1'),
(97, 50, 20, 'baby girl skirt', 444, 85, '2020-08-01', '1'),
(98, 2, 12, 'mens black  jabbha-payjama', 1100, 103, '2020-08-02', '1'),
(101, 49, 12, 'women green DRESS PAIR', 2500, 250, '2020-08-02', '1'),
(102, 50, 20, 'baby girl black pents', 1500, 100, '2020-08-01', '1'),
(103, 49, 12, 'woman black gagara', 1000, 47, '2020-08-02', '1');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(300) NOT NULL,
  `usertype` enum('Admin','Other') NOT NULL,
  `register_date` date NOT NULL,
  `last_login` datetime NOT NULL,
  `notes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES
(7, 'Monik', 'monikpatel@gmail.com', '$2y$08$SXLv1Ed1P6IpxCcaTrBQuu8oJ0CtXhvgLRqyt22swLnTvQ0/dPTNS', 'Admin', '2020-07-13', '0000-00-00 00:00:00', ''),
(18, 'Riddhi', 'ridpatel2907@gmail.com', '$2y$08$qXmuticYSiBfsVLmXAjSneAGV2PK6M1mr1MUaLIg3q9d5OdrwtarW', 'Admin', '2020-07-15', '2020-09-22 06:51:21', ''),
(23, 'smit', 'smit2707@gmail.com', '$2y$08$VSg03wJ2JeEAGdlB3iw01.MF37U0gsqVa6pH2bsXj78fCqttb.EkO', 'Admin', '2020-09-22', '2020-09-22 06:53:26', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bid`),
  ADD UNIQUE KEY `UNIQUE` (`brand_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cid`),
  ADD UNIQUE KEY `UNIQUE` (`category_name`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`invoice_no`);

--
-- Indexes for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `invoice_no` (`invoice_no`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`pid`),
  ADD UNIQUE KEY `product_name` (`product_name`),
  ADD KEY `cid` (`cid`),
  ADD KEY `bid` (`bid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `invoice_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `invoice_details`
--
ALTER TABLE `invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoice_details`
--
ALTER TABLE `invoice_details`
  ADD CONSTRAINT `invoice_details_ibfk_1` FOREIGN KEY (`invoice_no`) REFERENCES `invoice` (`invoice_no`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `categories` (`cid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_ibfk_2` FOREIGN KEY (`bid`) REFERENCES `brands` (`bid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
