-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 26, 2019 at 03:09 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inovice`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `cust_id` int(11) NOT NULL,
  `cust_name` varchar(30) NOT NULL,
  `cust_email` varchar(30) NOT NULL,
  `cust_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_name`, `cust_email`, `cust_address`) VALUES
(1, 'samin', 'samin@gmail.com', 'dhaka');

-- --------------------------------------------------------

--
-- Table structure for table `inovice`
--

CREATE TABLE `inovice` (
  `inovice_id` int(11) NOT NULL,
  `cust_id` int(11) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `ino_product` varchar(30) NOT NULL,
  `pro_quantity` int(11) NOT NULL,
  `pro_price` double NOT NULL,
  `pro_discount` double NOT NULL,
  `Pro_total` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inovice`
--

INSERT INTO `inovice` (`inovice_id`, `cust_id`, `currency`, `date`, `ino_product`, `pro_quantity`, `pro_price`, `pro_discount`, `Pro_total`) VALUES
(7, 1, 'doller', '2019-08-21', 'Product 3', 5, 100, 30, 350),
(8, 1, 'doller', '2019-08-30', 'Product 1', 100, 500, 10, 45000);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(30) NOT NULL,
  `prod_cat` varchar(30) NOT NULL,
  `prod_desc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`prod_id`, `prod_name`, `prod_cat`, `prod_desc`) VALUES
(1, 'Product 1', '1', 'This is product 1'),
(2, 'Product 3', '2', 'this is product'),
(3, 'Product 4', '3', 'this is product');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `address`) VALUES
(1, 'maruf', 'marufahamed26@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dhaka'),
(2, 'sayon', 'sayon@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'dhaka'),
(3, 'demo', 'demon@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'dhaka'),
(4, 'kana', 'kana@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'tongi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `inovice`
--
ALTER TABLE `inovice`
  ADD PRIMARY KEY (`inovice_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `cust_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `inovice`
--
ALTER TABLE `inovice`
  MODIFY `inovice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
