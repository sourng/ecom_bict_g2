-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2018 at 05:25 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpproject`
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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `bnd_id` int(11) NOT NULL,
  `bnd_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cat_id` int(11) NOT NULL,
  `categorys` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`cat_id`, `categorys`) VALUES
(1, 'Electroic'),
(2, 'Ladies Wears'),
(3, 'Men Wears'),
(4, 'Kids Wears'),
(5, 'Food');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `order_detail` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `pro_name` varchar(250) DEFAULT NULL,
  `picture` varchar(250) DEFAULT NULL,
  `pro_detail` varchar(250) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `pro_keyword` varchar(250) DEFAULT NULL,
  `col_id` varchar(250) DEFAULT NULL,
  `pro_status` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `cat_id`, `pro_name`, `picture`, `pro_detail`, `price`, `pro_keyword`, `col_id`, `pro_status`) VALUES
(1, 5, 'Almara', 'Almara.jpg', NULL, '5', NULL, NULL, 'Y'),
(2, 5, 'Milk', 'milk.jpg', NULL, '4', NULL, NULL, 'Y'),
(3, 5, 'Nestle', 'nestle.jpg', NULL, '6', NULL, NULL, 'Y'),
(4, 5, 'Soya', 'soya.jpg', NULL, '6', NULL, NULL, 'Y'),
(5, 5, 'Fresh Milk', 'fresh_milk.jpg', NULL, '8', NULL, NULL, 'Y'),
(6, 5, 'Fresh Milk Cow', '980.jpg', NULL, '5', NULL, NULL, 'Y'),
(7, 1, '41enJA96pbL', '41enJA96pbL.jpg', NULL, '100', NULL, NULL, 'Y'),
(8, 1, 'Asus-Zenfone-Selfie-Silver', 'Asus-Zenfone-Selfie-Silver.jpg', NULL, '200', NULL, NULL, 'Y'),
(9, 1, 'Oppo-F5', 'Oppo-F5.jpg', NULL, '280', NULL, NULL, 'Y'),
(10, 1, 'Oppo-f7-0ph1819-original', 'oppo-f7-cph1819-original.jpeg', NULL, '329', NULL, NULL, 'Y'),
(11, 1, 'Red-me-pro-2', 'red-me-pro-2.jpg', NULL, '300', NULL, NULL, 'Y'),
(12, 1, 'Samsung-Note8-Gold', 'Samsung-Note8-Gold.jpg', NULL, '780', NULL, NULL, 'Y'),
(13, 2, 'Ladies one piece dress', 'ladies-one-piece-dress.jpg', NULL, '80', NULL, NULL, 'Y'),
(14, 2, 'Ladies western wear', 'ladies-western-wear.jpg', NULL, '80', NULL, NULL, 'Y'),
(15, 2, 'Fancy ladies designer suits', 'fancy-ladies-designer-suits.jpg', NULL, '80', NULL, NULL, 'Y'),
(16, 2, 'Casual wear', 'casual-wear.jpg', NULL, '50', NULL, NULL, 'Y'),
(17, 2, 'Western wear', 'western-wear.jpg', NULL, '70', NULL, NULL, 'Y'),
(18, 2, 'Casual wear', 'casual-wear.jpg', NULL, '75', NULL, NULL, 'Y'),
(19, 3, 'Kvg8 ansh fashion wear men', 'kvg8-ansh-fashion-wear-men.jpg', NULL, '50', NULL, NULL, 'Y'),
(20, 3, 'Popular Royal Blue Men', 'Popular-Royal-Blue-Men.jpg', NULL, '45', NULL, NULL, 'Y'),
(21, 3, 'ZYLUS15', 'ZYLUS15.jpg', NULL, '31', NULL, NULL, 'Y'),
(22, 3, 'ZYLUS17', 'ZYLUS17.jpg', NULL, '32', NULL, NULL, 'Y'),
(23, 3, 'Big man', 'Big_man.jpg', NULL, '25', NULL, NULL, 'Y'),
(24, 3, 'Man', 'Man.jpeg', NULL, '30', NULL, NULL, 'Y'),
(25, 4, '81ixXPOc vL UL', '81ixXPOc-vL._UL.jpg', NULL, '10', NULL, NULL, 'Y'),
(26, 4, 'Free shipping springtime', 'Free-shipping-springtime.jpg', NULL, '9', NULL, NULL, 'Y'),
(27, 4, 'unisex pre winter set', 'unisex-pre-winter-set.jpg', NULL, '9.50', NULL, NULL, 'Y'),
(28, 4, 'kids wear', 'kids-wear.jpg', NULL, '7', NULL, NULL, 'Y'),
(29, 4, 'Kid weare', 'Kid_weare.jpg', NULL, '8', NULL, NULL, 'Y'),
(30, 4, 'gents.jpg', 'gents.jpg', NULL, '10.50', NULL, NULL, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product_category`
--

CREATE TABLE `tbl_product_category` (
  `pro_cat_id` int(11) NOT NULL,
  `pro_cat_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  ADD KEY `FK_tbl_product_tbl_category` (`cat_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `bnd_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `pro_cat_id` int(11) NOT NULL AUTO_INCREMENT;
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
  ADD CONSTRAINT `FK_tbl_product_tbl_category` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
