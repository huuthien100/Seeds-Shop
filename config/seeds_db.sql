-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 10, 2023 lúc 03:17 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `seeds_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `carts`
--

CREATE TABLE `carts` (
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `total_price` decimal(10,2) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderitems`
--

CREATE TABLE `orderitems` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orderitems`
--

INSERT INTO `orderitems` (`order_item_id`, `order_id`, `product_id`, `quantity`) VALUES
(14, 30, 21, 1),
(15, 30, 25, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`) VALUES
(30, 21, '2023-11-08 16:50:06', 'Đã Xác Nhận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `img_url` varchar(255) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` int(255) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`product_id`, `img_url`, `product_name`, `description`, `price`, `stock_quantity`) VALUES
(21, 'img/productImage/Hoa_hướng_dương.png', 'Hoa hướng dươngg', 'Hạt giống hoa hướng dương 500gm\r\n', 25000, 24),
(22, 'img/productImage/Atiso.png', 'Atiso', 'Hoa Atiso 300gm', 30000, 8),
(23, 'img/productImage/Hạt_giống_hoa_sen.png', 'Hạt giống hoa sen', 'Hạt giống hoa sen \r\n200gm', 15000, 30),
(24, 'img/productImage/Hạt_giống_củ_su_hào.png', 'Hạt giống củ su hào', 'Hạt giống cũ su hao 200gm', 40000, 32),
(25, 'img/productImage/Hạt_giống_củ_dền_đỏ.png', 'Hạt giống củ dền đỏ', 'Hạt giống củ dền đỏ', 23000, 4),
(26, 'img/productImage/Hạt_bắp_cải_hoa_hồng.png', 'Hạt bắp cải hoa hồng', 'bắp cải hoa hồng 400gm', 60000, 16),
(27, 'img/productImage/Hoa_hồng_ngoại.png', 'Hoa hồng ngoại', 'Hoa hồng ngoại', 34000, 45),
(28, 'img/productImage/Hạt_giống_trúc_mai_xanh.png', 'Hạt giống trúc mai xanh', 'Hạt giống trúc mai xanh', 40000, 34),
(29, 'img/productImage/Hạt_giống_hoa_cát_tường.png', 'Hạt giống hoa cát tường', 'Hjat giống hoa cat tường 100mg', 15000, 45),
(30, 'img/productImage/Hạt_giống_dâu_tây.png', 'Hạt giống dâu tây', 'Hạt giống dâu tây đà lạt', 45000, 20),
(31, 'img/productImage/hạt_giống_đu_đủ.png', 'hạt giống đu đủ', 'Hạt giống đu đủ 200gm', 30000, 30),
(32, 'img/productImage/Hạt_giống_ớt_hàn_quốc.png', 'Hạt giống ớt hàn quốc', 'Giống ớt lạ hàng quốc', 55000, 30),
(33, 'img/productImage/Hạt_giống_hoa_cúc_trắng.png', 'Hạt giống hoa cúc trắng', 'Hạt giống hoa cúc trắng', 40000, 35),
(34, 'img/productImage/Hạt_giống_hoa_xương_rồng.png', 'Hạt giống hoa xương rồng', 'Hạt giống hoa xương rồng', 45000, 10),
(35, 'img/productImage/Hạt_giống_hoa_tóc_tiên.png', 'Hạt giống hoa tóc tiên', 'Hạt giống hoa tóc tiên', 38000, 45),
(36, 'img/productImage/Hạt_giống_củ_hành_tây.png', 'Hạt giống củ hành tây', 'Hạt giống củ hành tây', 30000, 40),
(37, 'img/productImage/Hạt_giống_ngô_mỹ.png', 'Hạt giống ngô mỹ', 'Hạt giống hoa cúc trắng', 20000, 55);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `access` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `full_name`, `address`, `phone`, `access`) VALUES
(20, 'admin', 'admin@admin', '$2y$10$vMYAO8R1i..lwXSonN73gudtjlquH2XRzxXAO1UnULcZSbmYKnDTG', 'admin', 'admin', '1234567890', 1),
(21, 'user', 'user@user', '$2y$10$0DI2wE/B8MyN5I9C4AP2Ju/z.ZwXv2ajLysazkgTwK1fci1uGY8jC', 'user', 'user', '1234567890', 2),
(24, 'test', 'test@test', '$2y$10$D1aNRE0UjOGswMTeLqnvPuLMMPIgImlWbrgMwVKYaZdqQxDtLZoFS', 'test', 'test', '1234567890', 2),
(25, 'nhu', 'nhu@123', '$2y$10$xpc53zhucIAZdZMt6jAbeeA.yWQeaAF1zP9psGLtbqVSLnJC1TDgq', 'Hồng Như', 'Kiên Giang', '0924932232', 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `fk_user` (`user_id`);

--
-- Chỉ mục cho bảng `orderitems`
--
ALTER TABLE `orderitems`
  ADD PRIMARY KEY (`order_item_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `carts`
--
ALTER TABLE `carts`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `orderitems`
--
ALTER TABLE `orderitems`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Các ràng buộc cho bảng `orderitems`
--
ALTER TABLE `orderitems`
  ADD CONSTRAINT `orderitems_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `orderitems_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
