-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2018 at 03:15 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `group2`
--

-- --------------------------------------------------------

--
-- Table structure for table `slide`
--

CREATE TABLE `slide` (
  `slide_id` int(11) NOT NULL,
  `image` varchar(250) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `delete_date` datetime DEFAULT NULL,
  `user_create` varchar(250) DEFAULT NULL,
  `slide_status` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `slide`
--

INSERT INTO `slide` (`slide_id`, `image`, `upload_date`, `delete_date`, `user_create`, `slide_status`) VALUES
(1, 'main-slider1.jpg', '2018-05-23 11:03:23', '2018-05-23 11:03:25', NULL, 'Y'),
(2, 'main-slider2.jpg', '2018-05-23 11:03:23', '2018-05-23 11:03:25', NULL, 'Y'),
(3, 'main-slider3.jpg', '2018-05-23 11:03:23', '2018-05-23 11:03:25', NULL, 'Y'),
(4, 'main-slider4.jpg', '2018-05-23 11:03:23', '2018-05-23 11:03:25', NULL, 'Y');

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
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `c_id` int(11) NOT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `namecard` varchar(250) DEFAULT NULL,
  `card_number` varchar(250) DEFAULT NULL,
  `cvv` varchar(250) DEFAULT NULL,
  `holdername` varchar(250) DEFAULT NULL,
  `valid_date` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`c_id`, `cus_id`, `namecard`, `card_number`, `cvv`, `holdername`, `valid_date`) VALUES
(13, 21, NULL, NULL, NULL, NULL, NULL),
(14, 22, 'Paypal', '366668877', '045', 'San', '2018-07-28');

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
(3, 'Kids'),
(4, 'Electronics');

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
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `company` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `street` varchar(250) DEFAULT NULL,
  `zip` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `cus_status` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer`
--

INSERT INTO `tbl_customer` (`cus_id`, `fname`, `lname`, `company`, `phone`, `email`, `street`, `zip`, `state`, `country`, `password`, `cus_status`) VALUES
(21, 'kanha', 'phoy', 'Banking', '0957585037', 'phoykanha@gmail.com', '60', '50', 'Bangkok', 'Thailand', 'ss', 'Y'),
(22, 'San', 'Seam', 'Banking', '0967585037', 'san@gmail.com', '267', '56', 'Bangkok', 'Thailand', '123', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_section`
--

CREATE TABLE `tbl_customer_section` (
  `sec_id` int(11) NOT NULL,
  `section_name` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_customer_section`
--

INSERT INTO `tbl_customer_section` (`sec_id`, `section_name`) VALUES
(1, 'My Orders'),
(2, 'My Wishlist'),
(3, 'My Account'),
(4, 'Log Out');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery`
--

CREATE TABLE `tbl_delivery` (
  `de_id` int(11) NOT NULL,
  `cus_id` int(11) DEFAULT NULL,
  `delivery` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_delivery`
--

INSERT INTO `tbl_delivery` (`de_id`, `cus_id`, `delivery`) VALUES
(14, 21, 'cruise'),
(15, 22, 'cruise');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login_test`
--

CREATE TABLE `tbl_login_test` (
  `id` int(11) NOT NULL,
  `username` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `ord_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL DEFAULT '0',
  `pro_id` int(11) DEFAULT NULL,
  `image` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `qty` varchar(250) DEFAULT NULL,
  `price` varchar(250) DEFAULT NULL,
  `subtotal` float DEFAULT NULL,
  `order_status` enum('Y','N') DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`ord_id`, `cus_id`, `pro_id`, `image`, `name`, `qty`, `price`, `subtotal`, `order_status`) VALUES
(9, 21, 1, 'a1.jpg', 'MAN SHIRTS', '1', '12', 12, 'Y'),
(10, 21, 8, 'b1.jpg', 'LADIES PANTS', '1', '12', 12, 'Y'),
(11, 22, 1, 'a1.jpg', 'MAN SHIRTS', '11', '12', 132, 'Y'),
(12, 22, 7, 'g1.jpg', 'MAN PANTS', '51', '90', 4590, 'Y'),
(13, 22, 4, 'd1.jpg', 'MAN T-SHIRTS', '16', '15', 240, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `pro_id` int(11) NOT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `pro_name` varchar(250) DEFAULT NULL,
  `pro_feature` varchar(250) DEFAULT NULL,
  `img1` varchar(250) DEFAULT NULL,
  `img2` varchar(250) DEFAULT NULL,
  `pro_img_folder` varchar(250) DEFAULT NULL,
  `pro_detail` longtext,
  `price` decimal(10,0) DEFAULT NULL,
  `discount` decimal(10,0) DEFAULT NULL,
  `pro_keyword` varchar(250) DEFAULT NULL,
  `pro_status` enum('Y','N') DEFAULT 'Y',
  `col_id` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`pro_id`, `cat_id`, `pro_name`, `pro_feature`, `img1`, `img2`, `pro_img_folder`, `pro_detail`, `price`, `discount`, `pro_keyword`, `pro_status`, `col_id`) VALUES
(1, 1, 'MAN SHIRTS', 'a1.jpg', 'a2.jpg', 'a3.jpg', 'product', '<h4><strong>Detail Product</strong></h4>\r\n\r\n<p>&nbsp; &nbsp; &nbsp; &nbsp; White lace top, woven, has a round neck, short sleeves, has knitted lining attached</p>\r\n\r\n<h4>Material &amp; care</h4>\r\n\r\n<ul>\r\n	<li>&nbsp;Polyester</li>\r\n	<li>Machine wash</li>\r\n</ul>\r\n\r\n<h4>Size &amp; Fit</h4>\r\n\r\n<ul>\r\n	<li>Regular fit</li>\r\n	<li>The model (height 5''8&quot; and chest 33&quot;) is wearing a size S</li>\r\n</ul>\r\n\r\n<p><em>Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.</em></p>', '12', '15', NULL, 'Y', 0),
(2, 2, 'LADIES PANTS', 'b1.jpg', 'b2.jpg', 'b3.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '12', '25', NULL, 'Y', 0),
(3, 2, 'LADIES T-SHIRTS', 'c1.jpg', 'c2.jpg', 'c3.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '12', '20', NULL, 'Y', 0),
(4, 1, 'MAN T-SHIRTS', 'd1.jpg', 'd2.jpg', 'd3.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '15', '10', NULL, 'Y', 0),
(5, 3, 'KID T-SHIRTS', 'e1.jpg', 'e2.jpg', 'e3.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '56', '30', NULL, 'Y', 0),
(6, 2, 'LADIES', 'f1.jpg', 'f2.jpg', 'f3.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '35', '35', NULL, 'Y', 0),
(7, 1, 'MAN PANTS', 'g1.jpg', 'g2.jpg', 'g3.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '90', '40', NULL, 'Y', 0),
(8, 2, 'LADIES PANTS', 'buyuy3.jpg', 'sdsd.jpg', '4.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '12', '25', NULL, 'Y', 0),
(9, 2, 'LADIES PANTS', 'quarter-pant.jpg', 'US500_.jpg', 'US500_.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '12', '20', NULL, 'Y', 0),
(10, 1, 'MAN T-SHIRTS', '186-V2.jpg', '201.jpg', 'Men-s-T-shirt-4.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '15', '10', NULL, 'Y', 0),
(11, 3, 'KID SHIRTS', 'AJ-Dezines.jpg', 'boy-party-wear-.jpg', '5f6943e7bs.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '56', '30', NULL, 'Y', 0),
(12, 2, 'LADIES', 'Sweatshirt-3.jpg', 'Weight-T-Shirt.jpg', '71i5vkO54d.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '35', '35', NULL, 'Y', 0),
(13, 1, 'MAN PANTS', 'g1.jpg', 'g2.jpg', 'g3.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '90', '40', NULL, 'Y', 0),
(14, 1, 'MAN T-SHIRTS', '186.jpg', 'Sleeve-T-Shirt.jpg', 'Neck-T-Shirt.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '15', '10', NULL, 'Y', 0),
(15, 1, 'MAN T-SHIRTS', 'download.jpeg', 'men.jpg', 'dow .jpeg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '15', '10', NULL, 'Y', 0),
(16, 1, 'MAN SHIRTS', '46fc2260f21.jpg', 'coat-pant.jpg', 'downl.jpeg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '15', '10', NULL, 'Y', 0),
(17, 3, 'KID T-SHIRTS', 'kids-front.jpg', '8fdb949e8cb3.jpg', '41aFs.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '56', '30', NULL, 'Y', 0),
(18, 3, 'KID JEANS', 'modern-kids.jpg', 'stylish-kids-jeans.jpg', '436696-.jpg', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '56', '30', NULL, 'Y', 0),
(19, 4, 'ASUS ZENFONE', 'asus-zenfone.jpg', 'asus-zenfone-.png', 'Q3Dlpm.png', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '56', '30', NULL, 'Y', 0),
(20, 4, 'DELL DESKTOP', 'dell-desktop.jpg', 'lenovo.jpg', 'PUBG_Web.png', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '56', '30', NULL, 'Y', 0),
(21, 4, 'SAMSUNG', '41ZQryYBFiL.jpg', '903752310.jpg', 'samsung.JPG', 'product', 'Define style this season with Armani''s new range of trendy tops, crafted with intricate details. Create a chic statement look by teaming this lace number with skinny jeans and pumps.', '56', '30', NULL, 'Y', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `fname` varchar(250) DEFAULT NULL,
  `lname` varchar(250) DEFAULT NULL,
  `company` varchar(250) DEFAULT NULL,
  `phone` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `street` varchar(250) DEFAULT NULL,
  `zip` varchar(250) DEFAULT NULL,
  `state` varchar(250) DEFAULT NULL,
  `country` varchar(250) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `u_status` char(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `fname`, `lname`, `company`, `phone`, `email`, `street`, `zip`, `state`, `country`, `password`, `u_status`) VALUES
(1, 'phoy', 'kanha', 'company', '0967585037', 'phoykanha@gmail.com', '#6', '0078', '223', 'cambodia', 'admin', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `slide`
--
ALTER TABLE `slide`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`bnd_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `FK__tbl_customer` (`cus_id`);

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
-- Indexes for table `tbl_customer_section`
--
ALTER TABLE `tbl_customer_section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `tbl_delivery`
--
ALTER TABLE `tbl_delivery`
  ADD PRIMARY KEY (`de_id`),
  ADD KEY `FK_tbl_delivery_tbl_customer` (`cus_id`);

--
-- Indexes for table `tbl_login_test`
--
ALTER TABLE `tbl_login_test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `FK_order_detail_product_category` (`pro_id`),
  ADD KEY `FK_tbl_order_detail_tbl_customer` (`cus_id`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `slide`
--
ALTER TABLE `slide`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `bnd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_color`
--
ALTER TABLE `tbl_color`
  MODIFY `col_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_customer`
--
ALTER TABLE `tbl_customer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `tbl_customer_section`
--
ALTER TABLE `tbl_customer_section`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tbl_delivery`
--
ALTER TABLE `tbl_delivery`
  MODIFY `de_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tbl_login_test`
--
ALTER TABLE `tbl_login_test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `tbl_product_category`
--
ALTER TABLE `tbl_product_category`
  MODIFY `pro_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD CONSTRAINT `FK__tbl_customer` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customer` (`cus_id`);

--
-- Constraints for table `tbl_delivery`
--
ALTER TABLE `tbl_delivery`
  ADD CONSTRAINT `FK_tbl_delivery_tbl_customer` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customer` (`cus_id`);

--
-- Constraints for table `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `FK_tbl_order_detail_tbl_customer` FOREIGN KEY (`cus_id`) REFERENCES `tbl_customer` (`cus_id`);

--
-- Constraints for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `FK_tbl_product_tbl_category` FOREIGN KEY (`cat_id`) REFERENCES `tbl_category` (`cat_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
