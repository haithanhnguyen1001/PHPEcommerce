-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th12 20, 2024 lúc 08:35 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shop`
--
CREATE DATABASE IF NOT EXISTS `shop` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `shop`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`) VALUES
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_detail`
--

DROP TABLE IF EXISTS `cart_detail`;
CREATE TABLE IF NOT EXISTS `cart_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `price` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `combo`
--

DROP TABLE IF EXISTS `combo`;
CREATE TABLE IF NOT EXISTS `combo` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` bigint(20) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `combodetails`
--

DROP TABLE IF EXISTS `combodetails`;
CREATE TABLE IF NOT EXISTS `combodetails` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `combo_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `combo_id` (`combo_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image`
--

DROP TABLE IF EXISTS `image`;
CREATE TABLE IF NOT EXISTS `image` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `path` varchar(500) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `image`
--

INSERT INTO `image` (`id`, `path`, `product_id`, `sort_order`) VALUES
(1, '../images/product/img_6762b1ab5258e4.08428793.jpg', 13, 1),
(2, '../images/product/img_6762b1ab532f49.38567724.jpg', 13, 2),
(3, '../images/product/img_6762b1ab5386d3.25582811.jpg', 13, 3),
(4, '../images/product/img_6762b1ab5422b3.69722976.jpg', 13, 4),
(5, '../images/product/img_6762b1ab546871.57330472.jpg', 13, 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE IF NOT EXISTS `order` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `customer_id`, `datetime`) VALUES
(1, 1, '2024-11-01 10:00:00'),
(2, 2, '2024-11-02 11:00:00'),
(3, 3, '2024-11-03 12:00:00'),
(4, 4, '2024-11-04 13:00:00'),
(5, 5, '2024-11-05 14:00:00'),
(6, 1, '2024-11-06 15:00:00'),
(7, 2, '2024-11-07 16:00:00'),
(8, 3, '2024-11-08 17:00:00'),
(9, 4, '2024-11-09 18:00:00'),
(10, 5, '2024-11-10 19:00:00'),
(12, 1, '2024-12-20 20:28:57'),
(13, 1, '2024-12-20 20:29:26');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `order_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 2, 400000),
(2, 13, 13, 6, 12000000),
(3, 13, 5, 1, 0),
(4, 13, 2, 4, 0),
(5, 13, 6, 5, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `price`
--

DROP TABLE IF EXISTS `price`;
CREATE TABLE IF NOT EXISTS `price` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `price`
--

INSERT INTO `price` (`id`, `product_id`, `price`, `datetime`) VALUES
(2, 13, 500000, '2024-12-19 21:40:43'),
(3, 13, 12000000, '2024-12-19 21:40:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `unit_id` bigint(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `unit_id` (`unit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `unit_id`) VALUES
(1, 'Product 1', 'Description for product 1', 1),
(2, 'Product 2', 'Description for product 2', 2),
(3, 'Product 3', 'Description for product 3', 3),
(5, 'Product 5', 'Description for product 5', 1),
(6, 'Product 6', 'Description for product 6', 2),
(7, 'Product 7', 'Description for product 7', 3),
(8, 'Product 8', 'Description for product 8', 4),
(9, 'Product 9', 'Description for product 9', 1),
(13, 'Posrche', 'Siêu xe thể thao', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `receipt`
--

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE IF NOT EXISTS `receipt` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `supplier_id` bigint(20) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_id` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `receipt`
--

INSERT INTO `receipt` (`id`, `supplier_id`, `datetime`) VALUES
(1, 1, '2024-01-01 10:00:00'),
(2, 2, '2024-02-01 11:00:00'),
(3, 3, '2024-03-01 12:00:00'),
(4, 4, '2024-04-01 13:00:00'),
(5, 5, '2024-05-01 14:00:00'),
(6, 6, '2024-06-01 15:00:00'),
(7, 7, '2024-07-01 16:00:00'),
(8, 8, '2024-08-01 17:00:00'),
(9, 9, '2024-09-01 18:00:00'),
(10, 10, '2024-10-01 19:00:00'),
(13, 7, '2024-12-19 21:40:43'),
(14, 6, '2024-12-19 21:40:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `receipt_details`
--

DROP TABLE IF EXISTS `receipt_details`;
CREATE TABLE IF NOT EXISTS `receipt_details` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `receipt_id` bigint(20) NOT NULL,
  `product_id` bigint(20) NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `receipt_id` (`receipt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `receipt_details`
--

INSERT INTO `receipt_details` (`id`, `receipt_id`, `product_id`, `price`, `quantity`) VALUES
(11, 1, 1, 200000, 10),
(12, 2, 2, 250000, 5),
(13, 3, 3, 300000, 8),
(14, 4, 13, 150000, 12),
(15, 5, 5, 350000, 7),
(16, 6, 6, 400000, 6),
(17, 7, 7, 450000, 9),
(18, 8, 8, 500000, 4),
(19, 9, 9, 550000, 11),
(20, 10, 13, 600000, 3),
(23, 13, 13, 500000, 50),
(24, 14, 13, 12000000, 12);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `role`
--

INSERT INTO `role` (`id`, `name`, `description`) VALUES
(1, 'Admin', 'Administrator role'),
(2, 'Customer', 'Customer role'),
(3, 'Employee', 'Employee role');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supplier`
--

DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `description`) VALUES
(1, 'Supplier 1', 'Description for supplier 1'),
(2, 'Supplier 2', 'Description for supplier 2'),
(3, 'Supplier 3', 'Description for supplier 3'),
(4, 'Supplier 4', 'Description for supplier 4'),
(5, 'Supplier 5', 'Description for supplier 5'),
(6, 'Supplier 6', 'Description for supplier 6'),
(7, 'Supplier 7', 'Description for supplier 7'),
(8, 'Supplier 8', 'Description for supplier 8'),
(9, 'Supplier 9', 'Description for supplier 9'),
(10, 'Supplier 10', 'Description for supplier 10');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `unit`
--

INSERT INTO `unit` (`id`, `name`, `description`) VALUES
(1, 'Cái', 'Unit for individual items'),
(2, 'Bộ', 'Unit for boxed items'),
(3, 'Hộp', 'Unit for weight in kilograms'),
(4, 'Chiếc', 'Unit for liquids in liters');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(500) NOT NULL,
  `familyname` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `familyname`, `firstname`, `phone`, `email`) VALUES
(1, 'user1', 'password1', 'Nguyen', 'An Phước', '0123456789', 'user1@example.com'),
(2, 'user2', 'password2', 'Tran', 'Binh', '0987654321', 'user2@example.com'),
(3, 'user3', 'password3', 'Le', 'Cuong', '0912345678', 'user3@example.com'),
(4, 'user4', 'password4', 'Hoang', 'Duc', '0945678901', 'user4@example.com'),
(5, 'user6', 'password6', 'Vu', 'Phong', '0934567890', 'user6@example.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_role`
--

DROP TABLE IF EXISTS `user_role`;
CREATE TABLE IF NOT EXISTS `user_role` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_role`
--

INSERT INTO `user_role` (`id`, `role_id`, `user_id`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 2, 3),
(4, 2, 4),
(5, 2, 5);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `combodetails`
--
ALTER TABLE `combodetails`
  ADD CONSTRAINT `combodetails_ibfk_1` FOREIGN KEY (`combo_id`) REFERENCES `combo` (`id`),
  ADD CONSTRAINT `combodetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `image`
--
ALTER TABLE `image`
  ADD CONSTRAINT `image_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `price`
--
ALTER TABLE `price`
  ADD CONSTRAINT `price_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`);

--
-- Các ràng buộc cho bảng `receipt_details`
--
ALTER TABLE `receipt_details`
  ADD CONSTRAINT `receipt_details_ibfk_1` FOREIGN KEY (`receipt_id`) REFERENCES `receipt` (`id`),
  ADD CONSTRAINT `receipt_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`);

--
-- Các ràng buộc cho bảng `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
