-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2018 at 05:37 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1',
  `deleted` tinyint(4) DEFAULT '1',
  `create_date` timestamp NULL DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `user_create` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`id`, `name`, `picture`, `status`, `deleted`, `create_date`, `updated_date`, `user_create`) VALUES
(1, 'picture', '001.jpg', 1, 1, '2018-05-22 17:00:00', '2018-05-23 00:00:00', 'sreymom'),
(2, 'picture', '002.jpg', 1, 1, '2018-05-22 17:00:00', '2018-05-23 00:00:00', 'sreymom'),
(3, 'picture', '003.jpg', 1, 1, '2018-05-22 17:00:00', '2018-05-23 00:00:00', 'sreymom'),
(4, 'picture', '004.jpg', 1, 1, '2018-05-22 17:00:00', '2018-05-23 00:00:00', 'sreymom');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `bnd_id` int(11) NOT NULL,
  `bnd_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`bnd_id`, `bnd_name`) VALUES
(1, 'Armani'),
(2, 'Versace'),
(3, 'Carlo Bruni'),
(4, 'Jack Honey');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `cat_name`) VALUES
(1, 'Man'),
(2, 'Ladies'),
(3, 'Kids');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_color`
--

CREATE TABLE `tbl_color` (
  `col_id` int(11) NOT NULL,
  `col_name` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_color`
--

INSERT INTO `tbl_color` (`col_id`, `col_name`) VALUES
(1, 'Red'),
(2, 'Green'),
(3, 'Blue'),
(4, 'Yellow');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer`
--

CREATE TABLE `tbl_customer` (
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(250) DEFAULT NULL,
  `cus_email` varchar(250) DEFAULT NULL,
  `cus_pwd` varchar(250) DEFAULT NULL,
  `cus_phone` varchar(250) DEFAULT NULL,
  `cus_order` varchar(250) DEFAULT NULL,
  `img_profile` varchar(250) DEFAULT NULL,
  `cus_status` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cus_id`, `cus_name`, `cus_email`, `cus_pwd`, `cus_phone`, `cus_order`, `img_profile`, `cus_status`) VALUES
(1, 'kanha', NULL, NULL, NULL, NULL, NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `order_detail` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `cus_id`, `order_detail`) VALUES
(1, 1, NULL),
(2, 1, NULL),
(3, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `ord_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `pro_id` int(11) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `list` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`ord_id`, `order_id`, `pro_id`, `price`, `list`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 3, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` int(11) NOT NULL,
  `pro_cat_id` int(11) DEFAULT NULL,
  `pro_name` varchar(250) DEFAULT NULL,
  `pro_feature` varchar(250) DEFAULT NULL,
  `pro_img_folder` varchar(250) DEFAULT NULL,
  `pro_detail` varchar(250) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `pro_keyword` varchar(250) DEFAULT NULL,
  `pro_status` enum('Y','N') DEFAULT 'Y',
  `col_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `pro_cat_id`, `pro_name`, `pro_feature`, `pro_img_folder`, `pro_detail`, `price`, `pro_keyword`, `pro_status`, `col_id`) VALUES
(1, 1, 'MAN SHIRTS', 'upload/001/1.jpg', 'upload/001', NULL, '12.50', NULL, 'Y', 0),
(2, 1, 'MAN PANTS', 'upload/002/1.jpg', 'upload/002', NULL, '25.80', NULL, 'Y', 0),
(3, 1, 'LADIES PANTS', 'upload/003/1.jpg', 'upload/003', NULL, '13.67', NULL, 'Y', 0),
(4, 1, 'LADIES T-SHIRTS', 'upload/004/1.jpg', 'upload/004', NULL, '56.89', NULL, 'Y', 0),
(5, 1, 'MAN T-SHIRTS', 'upload/005/1.jpg', 'upload/005', NULL, '89.34', NULL, 'Y', 0),
(6, 1, 'KID SHIRTS', 'upload/006/1.jpg', 'upload/006', NULL, '65.56', NULL, 'Y', 0),
(7, 1, 'LADIES', 'upload/007/1.jpg', 'upload/007', NULL, '89.34', NULL, 'Y', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `pro_cat_id` int(11) NOT NULL,
  `pro_cat_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product_category`
--

INSERT INTO `tbl_product_category` (`pro_cat_id`, `pro_cat_name`) VALUES
(1, 'MAN'),
(2, 'Ladies'),
(3, 'Kids');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`bnd_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `tbl_color`
--
ALTER TABLE `tbl_color`
  ADD PRIMARY KEY (`col_id`);

--
-- Indexes for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK__customer` (`cus_id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `FK__order` (`order_id`),
  ADD KEY `FK_order_detail_product_category` (`pro_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `FK_tbl_product_tbl_product_category` (`pro_cat_id`);

--
-- Indexes for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  ADD PRIMARY KEY (`pro_cat_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `bnd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `pro_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `FK__customer` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customer` (`cus_id`);

--
-- Constraints for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `FK__order` FOREIGN KEY (`order_id`) REFERENCES `tbl_order` (`order_id`),
  ADD CONSTRAINT `FK_order_detail_product_category` FOREIGN KEY (`pro_id`) REFERENCES `tbl_product_category` (`pro_cat_id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `FK_tbl_product_tbl_product_category` FOREIGN KEY (`pro_cat_id`) REFERENCES `tbl_product_category` (`pro_cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
