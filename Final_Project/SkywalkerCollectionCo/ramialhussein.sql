-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 02, 2020 at 07:37 AM
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
-- Database: `ramialhusseindatabase`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `address_id` int(11) NOT NULL,
  `address1` varchar(200) NOT NULL,
  `address2` varchar(200) DEFAULT NULL,
  `post_code` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_id`, `address1`, `address2`, `post_code`, `city`, `state`, `users_id`) VALUES
(1, '5601 Blvd East', 'Apt 6L', '07093', 'West New York', 'NJ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `users_id`) VALUES
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_product`
--

CREATE TABLE `cart_product` (
  `cart_product_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cart_id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `quantity` int(11) NOT NULL,
  `category` varchar(200) DEFAULT NULL,
  `price` double NOT NULL,
  `pictureURL` varchar(255) DEFAULT NULL,
  `product_description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `quantity`, `category`, `price`, `pictureURL`, `product_description`) VALUES
(1, 'Speeder Bike', 4, 'figurine', 329.99, 'https://www.sideshow.com/storage/product-images/100121/speeder-bike_star-wars_silo_sm.png', 'Sixth Scale Figure Accessory by Sideshow Collectibles '),
(2, 'Spider-Gwen', 1, 'Hot-Toys', 255, 'https://www.sideshow.com/storage/product-images/906347/spider-gwen_marvel_feature.jpg', 'Movie Masterpiece Series - Spider-Man: Into the Spider-Verse'),
(3, 'Grey Hulk', 1, 'Hot-Toys', 585, 'https://www.sideshow.com/storage/product-images/2003562/grey-hulk_marvel_gallery_5c4f7c06e6dd9.jpg', 'Avengers Assemble!'),
(4, 'Iron Man Stealth Suite', 1, 'Hot-Toys', 370, 'https://www.sideshow.com/storage/product-images/2003543/iron-man-stealth-suit_marvel_gallery_5c4c4637bc242.jpg', 'Avengers Assemble!'),
(5, 'Stormtropper', 1, 'Hot-Toys', 550, 'https://www.sideshow.com/storage/product-images/3005261/stormtrooper_star-wars_gallery_5c4d051baa0f0.jpg', '“Open the blast doors!  Open the blast doors!”'),
(6, 'Yoda', 1, 'Hot-Toys', 2550, 'https://www.sideshow.com/storage/product-images/400302/yoda_star-wars_gallery_5d8547748f4af.jpg', 'Life-Size Figure by Sideshow Collectibles'),
(8, 'Kylo Ren', 1, 'Hot-Toys', 569.99, 'https://www.sideshow.com/storage/product-images/300423/kylo-ren_star-wars_gallery_5c4ddad76f872.jpg', 'Premium Format™ Figure by Sideshow Collectibles'),
(9, 'Wolf Predator', 1, 'Bust', 649.99, 'https://www.sideshow.com/storage/product-images/200250/wolf-predator_aliens-vs-predator-requiem_gallery_5c4db6f0795c3.jpg', 'Legendary Scale™ Bust by Sideshow Collectibles'),
(10, 'Tchaka', 1, 'Hot-Toys', 220, 'https://www.sideshow.com/storage/product-images/903623/tchaka_marvel_gallery_5c4fb5876bae2.jpg', 'Sixth Scale Figure by Hot Toys'),
(11, 'Harley Quinn', 1, 'Life Size', 5500, 'https://www.sideshow.com/storage/product-images/904444/harley-quinn_dc-comics_gallery_5dcc493978e25.jpg', 'Life-Size Figure by DC Direct'),
(12, 'Batgirl', 1, 'Hot-Toys', 575, 'https://www.sideshow.com/storage/product-images/3006811/batgirl_dc-comics_gallery_5e4ece90a1739.jpg', 'Premium Format™ Figure by Sideshow Collectibles'),
(13, 'Venom Pool', 1, 'Hot-Toys', 405, 'https://www.sideshow.com/storage/product-images/9049371/venompool-special-edition_marvel_gallery_5d361d3cb6b60.jpg', 'Video Game Masterpiece Series - Marvel Contest of Champions'),
(14, 'Cammey', 1, 'Statue', 950, 'https://www.sideshow.com/storage/product-images/905759/cammy_street-fighter_gallery_5e72a4a49ca8a.jpg', 'Street Fighter 2 Classic - 1:3 Scale'),
(15, 'Cyrax', 1, 'Figures', 1200, 'https://www.sideshow.com/storage/product-images/903833/cyborg-mkx-pack_mortal-kombat_silo.png', 'Collectible Set by PCS Collectibles');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `users_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `email`, `Password`, `users_id`) VALUES
('Ramial', 'Ramialhussein98@gmail.com', 'ba526ebb2f3faaa3eb110002f9ee9d5b', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`address_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Indexes for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD PRIMARY KEY (`cart_product_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_product`
--
ALTER TABLE `cart_product`
  MODIFY `cart_product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address`
--
ALTER TABLE `address`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_product`
--
ALTER TABLE `cart_product`
  ADD CONSTRAINT `cart_product_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_product_ibfk_2` FOREIGN KEY (`userId`) REFERENCES `users` (`users_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--create user to query product database --
GRANT SELECT, INSERT, DELETE, UPDATEON ramialhusseindatabase.*TO ramialhussein@localhostIDENTIFIED BY 'ramialhusseinpass';
