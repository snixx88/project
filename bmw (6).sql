-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 07:32 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bmw`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `admin_email` varchar(100) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'admin@bmw.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- --------------------------------------------------------

--
-- Table structure for table `car`
--

CREATE TABLE `car` (
  `car_id` int(10) UNSIGNED NOT NULL,
  `car_type` varchar(20) NOT NULL,
  `car` varchar(255) NOT NULL,
  `car_name` varchar(50) NOT NULL,
  `car_speed` int(11) NOT NULL,
  `car_hp` int(11) NOT NULL,
  `car_price` int(11) NOT NULL,
  `car_image` varchar(255) NOT NULL,
  `car_description` text DEFAULT NULL,
  `car_fuel_type` varchar(20) DEFAULT 'Petrol',
  `car_acceleration` varchar(50) DEFAULT NULL,
  `car_range` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car`
--

INSERT INTO `car` (`car_id`, `car_type`, `car`, `car_name`, `car_speed`, `car_hp`, `car_price`, `car_image`, `car_description`, `car_fuel_type`, `car_acceleration`, `car_range`) VALUES
(1, 'i', 'ix', 'BMW ix', 200, 516, 87000, '../img/ix.webp', 'The BMW ix is a fully electric luxury SUV with impressive range and performance.', 'Electric', '4.6s 0-100 km/h', '475 km'),
(2, 'i', 'i7', 'BMW i7', 240, 536, 120000, '../img/i7.webp', 'The BMW i7 is the pinnacle of electric luxury sedans.', 'Electric', '4.7s 0-100 km/h', '625 km'),
(3, 'X', 'X1', 'NEW BMW X1', 205, 241, 55300, '../img/cosySec.webp', 'The compact luxury SUV that started it all.', 'Petrol', '6.5s 0-100 km/h', NULL),
(4, 'X', 'X5', 'BMW X5', 230, 523, 83000, '../img/x5.webp', 'The benchmark for midsize luxury SUVs.', 'Petrol', '4.6s 0-100 km/h', NULL),
(5, 'M', 'M4', 'BMW M4 Coupe', 250, 473, 79100, '../img/bmw 4 series m automobile.webp', 'High-performance sports coupe with racing DNA.', 'Petrol', '3.9s 0-100 km/h', NULL),
(6, 'Z', 'Z4', 'BMW Z4', 250, 255, 75500, '../img/cosy.webp', 'The ultimate open-top driving experience.', 'Petrol', '5.2s 0-100 km/h', NULL),
(7, 'i', 'i4', 'BMW i4 Gran Coupé', 190, 335, 56900, '../img\\i4 cyran.webp', 'The sporty electric Gran Coupe with impressive range.', 'Electric', '5.7s 0-100 km/h', '483 km'),
(9, 'X', 'X3', 'BMW X3 xDrive30i', 210, 248, 47900, '../img/x3.webp', 'The perfect balance of sportiness and versatility.', 'Petrol', '6.0s 0-100 km/h', NULL),
(10, 'i', 'iX1', 'BMW iX1 ', 180, 313, 53900, '../img\\ix1.webp', 'Compact electric SAV with premium features.', 'Electric', '5.6s 0-100 km/h', '440 km'),
(11, 'i', 'iX2', 'BMW iX2', 180, 313, 56900, '../img\\ix2.webp', 'Sporty electric SAC with coupe-like design.', 'Electric', '5.6s 0-100 km/h', '449 km'),
(12, 'i', 'i5', 'BMW i5', 230, 340, 71900, '../img/i5.webp', 'All-wheel drive electric executive sedan.', 'Electric', '5.8s 0-100 km/h', '556 km');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(10) UNSIGNED NOT NULL,
  `car_id` int(50) UNSIGNED NOT NULL,
  `user_id` int(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `car_id`, `user_id`, `price`, `quantity`, `created_at`) VALUES
(28, 7, 15, 56900.00, 1, '2025-05-19 08:47:46');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `checkout_id` int(50) NOT NULL,
  `user_id` int(50) NOT NULL,
  `order_id` int(50) NOT NULL,
  `payment_method` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(50) NOT NULL,
  `car_id` int(50) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'pending',
  `payment_method` varchar(255) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `delivery_address` text DEFAULT NULL,
  `status` varchar(20) DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `user_id`, `car_id`, `total_price`, `payment_status`, `payment_method`, `order_date`, `delivery_address`, `status`) VALUES
(1, 12, 0, 327000.00, 'pending', 'PayPal', '2025-05-18 18:23:38', 'rqrq', 'pending'),
(2, 12, 0, 83000.00, 'pending', 'Credit Card', '2025-05-18 18:25:48', 'twt', 'pending'),
(3, 12, 0, 410000.00, 'pending', 'Credit Card', '2025-05-18 18:49:34', 'fwf', 'pending'),
(4, 12, 0, 120000.00, 'pending', 'Bank Transfer', '2025-05-18 19:01:31', 'wwtw', 'pending'),
(5, 12, 0, 240000.00, 'pending', 'Credit Card', '2025-05-18 19:03:54', 'uy', 'pending'),
(6, 12, 0, 120000.00, 'pending', 'Credit Card', '2025-05-18 19:16:47', 'gwg', 'pending'),
(7, 4, 0, 120000.00, 'pending', 'Credit Card', '2025-05-18 19:54:31', 'qrq', 'pending'),
(8, 4, 0, 240000.00, 'pending', 'Credit Card', '2025-05-18 19:55:21', 'wetw', 'pending'),
(9, 14, 0, 158500.00, 'pending', 'Bank Transfer', '2025-05-19 06:28:53', 'egypt', 'pending'),
(10, 15, 0, 113800.00, 'pending', 'Bank Transfer', '2025-05-19 08:47:04', 'yrr', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `detail_id` int(10) UNSIGNED NOT NULL,
  `order_id` int(10) UNSIGNED NOT NULL,
  `car_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`detail_id`, `order_id`, `car_id`, `quantity`, `price`) VALUES
(1, 1, 2, 2, 120000.00),
(2, 1, 1, 1, 87000.00),
(3, 2, 4, 1, 83000.00),
(4, 3, 1, 1, 87000.00),
(5, 3, 2, 2, 120000.00),
(6, 3, 4, 1, 83000.00),
(7, 4, 2, 1, 120000.00),
(8, 5, 2, 2, 120000.00),
(9, 6, 2, 1, 120000.00),
(10, 7, 2, 1, 120000.00),
(11, 8, 2, 2, 120000.00),
(12, 9, 6, 1, 75500.00),
(13, 9, 4, 1, 83000.00),
(14, 10, 7, 2, 56900.00);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(55) NOT NULL,
  `password` varchar(55) NOT NULL,
  `phone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `phone`) VALUES
(1, 'boroke5359', 'snixx4@yahoo.com', '123', 12345677),
(2, 'boroke53592', 'snixx2@yahoo.com', '123', 2147483647),
(3, 'boroke5359', 'snixx98@yahoo.com', '123', 12345677),
(4, 'boroke5359', 'snixx@yahoo.com', '123', 2147483647),
(5, 'boroke5359', 'snixx111@yahoo.com', '123', 12345677),
(6, 'boroke5359', 'snixx53@yahoo.com', '123', 123),
(7, 'boroke5359', 'snixx112@yahoo.com', '123', 124),
(8, 'boroke5359', 'snixx4124151@yahoo.com', '123', 2147483647),
(9, 'snixx', 'snixx11241@yahoo.com', '123', 41244151),
(10, 'boroke5359', 'snixx5555@yahoo.com', '123', 2147483647),
(11, 'boroke5359', 'snixx77@yahoo.com', '123', 2147483647),
(12, 'Hana', 'hana@gmail.com', '123', 123456789),
(13, 'snixx', 'snixx88@yahoo.com', '123', 2147483647),
(14, 'hana2', 'hana2@gmail.com', '1234', 123456789),
(15, 'yousef', 'yousef@gmail.com', '123', 57575755);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `car`
--
ALTER TABLE `car`
  ADD PRIMARY KEY (`car_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `FK_Car_ID` (`car_id`),
  ADD KEY `FK_User_ID_cart` (`user_id`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`checkout_id`),
  ADD KEY `FK_Order_ID` (`order_id`),
  ADD KEY `FK_User_ID` (`user_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `FK_User_ID_2` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `car`
--
ALTER TABLE `car`
  MODIFY `car_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `checkout_id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `detail_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `FK_Car_ID` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_User_ID_cart` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `FK_User_ID` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `FK_User_ID_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`car_id`) REFERENCES `car` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
