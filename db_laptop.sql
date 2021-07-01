-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th6 10, 2021 lúc 06:26 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `db_laptop`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `coupon`
--

CREATE TABLE `coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `expire` datetime DEFAULT NULL,
  `status` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `coupon`
--

INSERT INTO `coupon` (`id`, `coupon_code`, `value`, `customer_id`, `expire`, `status`) VALUES
(2, 'qwerty', 10000, 1, '2021-06-30 00:00:00', b'0'),
(3, 'EQE3Q', 15000, 1, '2021-06-24 00:00:00', b'0'),
(4, 'QQQQQQ', 10000, 1, '2021-06-30 02:47:44', b'0'),
(5, 'DVLLM', 15000, 2, '2021-06-30 00:00:00', b'0'),
(6, '9WARH', 15000, 2, '2021-06-30 00:00:00', b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` bit(1) DEFAULT b'0',
  `address_other` varchar(5000) DEFAULT NULL,
  `role_id` int(1) DEFAULT 3,
  `status` bit(1) DEFAULT b'1',
  `remember_token` varchar(5000) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer`
--

INSERT INTO `customer` (`id`, `name`, `email`, `password`, `phone`, `address`, `date_of_birth`, `gender`, `address_other`, `role_id`, `status`, `remember_token`, `deleted`) VALUES
(1, 'Trung Hiếu', 'trunghieu@gmail.com', '$2y$10$zNfndCw/pIUfcCYyBZIrE.NSAPaJfVi4LfvtTMLvuU8YpUV/8h9O.', '0123456789', 'BG, Bình Giang, Hải Dương, Việt Nam', '2021-06-27', b'1', NULL, 3, b'1', NULL, b'0'),
(2, 'Minh Minh', 'quangminh12@utehy.vn', '$2y$10$1rEXHtgqoM2LwJgDw7reKOjksowiMdgQpNG/A6S3nd/3rBIiTSmNm', '0122233344', 'Hải Dương, Thanh Bình, Hải Dương', '1998-06-02', b'1', NULL, 3, b'1', '0hRPyGzv3HHf9vvuIOGFUwGIcglADvTCniL6XOOXVZTOpVDBvrNmfLuGNij1', b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `make_appointment`
--

CREATE TABLE `make_appointment` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(11) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `closed_date` datetime DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `make_appointment`
--

INSERT INTO `make_appointment` (`id`, `first_name`, `last_name`, `email`, `phone`, `subject`, `description`, `created_date`, `closed_date`, `creator_id`, `status`) VALUES
(2, 'Hieu', 'Hieu', 'trunghieu@utehy.vn', '0123456789', 'Test hệ thống', 'Đây là mô tả của form đặt lịch hẹn', NULL, '2021-06-03 03:17:52', 3, 1),
(3, 'Quang', 'Minh', 'quangminh@utehy.vn', '0123456789', 'Test hệ thống', 'Test đấy, thế có định liên hệ lại không?', '2021-06-05 00:54:12', '2021-06-05 00:55:00', 4, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `address` varchar(5000) DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `order_detail` varchar(255) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `status` int(11) DEFAULT 0,
  `note` varchar(5000) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order`
--

INSERT INTO `order` (`id`, `customer_id`, `address`, `coupon_id`, `total_price`, `order_detail`, `order_date`, `status`, `note`, `deleted`) VALUES
(1, 1, 'Bình Giang, Bình Giang, Hải Dương, Việt Nam', 3, 1425000, '[{\"code\":\"GWHBDE\",\"name\":\"\\u00d4\\u0309 c\\u01b0\\u0301ng SSD 512Gb\",\"price\":\"720000\",\"quantity\":\"2\"}]', '2021-06-03', 1, NULL, b'0'),
(2, 1, 'Bình Giang, Bình Giang, Hải Dương, Việt Nam', 2, 730000, '[{\"code\":\"XOLXFG\",\"name\":\"Norton Internet Security\",\"price\":\"180000\",\"quantity\":\"1\"},{\"code\":\"LLRGLG\",\"name\":\"Mcafee Livesafe Antivirus\",\"price\":\"280000\",\"quantity\":\"2\"}]', '2021-06-03', 1, 'Gửi hàng vào giờ hành chính nhé shốp', b'0'),
(3, 1, 'BG, Bình Giang, Hải Dương, Việt Nam', 4, 350000, '[{\"code\":\"3L4ZKP\",\"name\":\"Jack chia\",\"price\":\"180000\",\"quantity\":\"2\"}]', '2021-06-03', 4, NULL, b'0'),
(4, 2, 'Test, Thanh Trì, Hà Nội, Việt Nam', 0, 200000, '[{\"code\":\"QMKTKG\",\"name\":\"Window 10 ba\\u0309n quy\\u00ea\\u0300n\",\"price\":\"100000\",\"quantity\":\"2\"}]', '2021-06-05', 2, 'Test choi choi', b'0'),
(5, 2, 'Hải Dương, Bình Giang, Hải Dương, Việt Nam', 5, 28145000, '[{\"code\":\"A1BAMR\",\"name\":\"Laptop va\\u0300 chu\\u00f4\\u0323t ma\\u0301y ti\\u0301nh\",\"price\":\"28000000\",\"quantity\":\"1\"},{\"code\":\"3L4ZKP\",\"name\":\"Jack chia\",\"price\":\"160000\",\"quantity\":\"1\"}]', '2021-06-05', 4, 'Mua hàng có mã giảm giá nhé', b'0'),
(6, 2, '123, Bình Giang, Hải Dương, Việt Nam', 0, 380000, '[{\"code\":\"J0PGPT\",\"name\":\"USB Mcafee Livesafe Antivirus\",\"price\":\"380000\",\"quantity\":\"1\"}]', '2021-06-10', 4, NULL, b'0'),
(7, 2, '123, Thanh Trì, Hà Nội, Việt Nam', 0, 650000, '[{\"code\":\"GWHBDE\",\"name\":\"\\u00d4\\u0309 c\\u01b0\\u0301ng SSD 512Gb\",\"price\":\"650000\",\"quantity\":\"1\"}]', '2021-06-10', 4, NULL, b'0'),
(8, 2, '123, Thanh Trì, Hải Dương, Việt Nam', 6, 365000, '[{\"code\":\"MMRGWX\",\"name\":\"Ba\\u0300n phi\\u0301m laptop kh\\u00f4ng d\\u00e2y\",\"price\":\"380000\",\"quantity\":\"1\"}]', '2021-06-10', 4, NULL, b'0'),
(9, 2, '123, Bình Giang, Hải Dương, Việt Nam', 6, 27985000, '[{\"code\":\"A1BAMR\",\"name\":\"Laptop va\\u0300 chu\\u00f4\\u0323t ma\\u0301y ti\\u0301nh\",\"price\":\"28000000\",\"quantity\":\"1\"}]', '2021-06-10', 4, 'Chụp ảnh demo', b'0'),
(10, 2, ', , , Việt Nam', 0, 280000, '[{\"code\":\"LLRGLG\",\"name\":\"USB Mcafee Livesafe Antivirus\",\"price\":\"280000\",\"quantity\":\"1\"}]', '2021-06-10', 4, NULL, b'0');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `product_type_id` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `cost_price` int(11) DEFAULT NULL,
  `cost_sale` int(11) DEFAULT NULL,
  `unit` int(11) DEFAULT 0,
  `status` bit(1) DEFAULT b'0',
  `deleted` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `product_type_id`, `image`, `description`, `title`, `cost_price`, `cost_sale`, `unit`, `status`, `deleted`) VALUES
(2, 'LLRGLG', 'USB Mcafee Livesafe Antivirus', 1, 'EaWc42.jpg', 'Phần mềm diệt virus bản quyền được đội ngũ Laptop365 thiết kế', 'Mcafee Livesafe Antivirus', 280000, 260000, 0, b'1', NULL),
(3, 'QMKTKG', 'Window 10 bản quyền', 2, '62sT44.png', 'Sửa máy tính', 'Sửa máy tính', 50000, 100000, 0, b'1', NULL),
(4, '3L4ZKP', 'Jack chia', 3, '6QzjXn.png', 'Jack chia', 'Jack chia', 160000, 180000, 0, b'1', NULL),
(5, 'MMRGWX', 'Bàn phím laptop không dây', 2, 'rxKDxw.jpg', 'Bàn phím laptop không dây, tiện lợi và tương thích trên mọi thiết bị qua cổng kết nối Bluetool', 'Bàn phím laptop không dây', 380000, 400000, 0, b'1', NULL),
(6, 'A1BAMR', 'Laptop và chuột máy tính', 2, 'h4mAzj.jpg', 'Laptop văn phòng và chuột không dây. Ram 16GB, SSD 512GB. Hỗ trợ cái phần mềm miễn phí 1 năm', 'Laptop văn phòng và chuột không dây', 28000000, 30000000, 0, b'1', NULL),
(7, 'XOLXFG', 'Norton Internet Security', 4, '0dz8fG.png', 'Norton Internet Security', 'Norton Internet Security', 160000, 180000, 0, b'1', NULL),
(8, 'GWHBDE', 'Ổ cứng SSD 512Gb', 1, 'YxqElx.jpg', 'Ổ cứng SSD tăng tốc độ đọc và ghi của thiết bị lên nhiều lần', 'Ổ cứng SSD 512Gb', 650000, 720000, 0, b'1', NULL),
(9, 'V3IXDX', 'Loa', 2, 'aSV77h.jpg', 'Loa máy tính với chất lượng âm thanh trong sáng. Giá thành lại rẻ', 'Loa', 320000, 350000, 0, b'1', NULL),
(10, 'J0PGPT', 'USB Mcafee Livesafe Antivirus', 1, 's9y7bD.jpg', 'Phần mềm bản quyền có giá trị lên đến 3 năm.', 'USB Mcafee Livesafe Antivirus', 380000, 1800000, 0, b'1', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `description`) VALUES
(1, 'Sao lưu/Phục hồi', 'Dịch vụ sao lưu/phục hồi dữ liệu'),
(2, 'Máy tính', 'Dịch vụ máy tính'),
(3, 'Di động', 'Dịch vụ di động'),
(4, 'Mạng', 'Dịch vụ/Giải pháp mạng');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(10) DEFAULT NULL,
  `status` bit(1) DEFAULT b'0',
  `remember_token` varchar(5000) DEFAULT NULL,
  `deleted` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `role_id`, `status`, `remember_token`, `deleted`) VALUES
(1, 'aaa1', 'aaa@aaa.com', '$2y$10$Ypd1M68pHjdpU2zDzUg73.lhUzZjutfVB7SkhpsIN3yZ3oCU/PJy.', 2, b'1', 'famj84WbYHHDdr6sr7eB7JpyxkQNyGqvlj1DJBFWxjleCSIJv3oZ8bYj08PB', b'1'),
(3, 'admin', 'hieu@gmail.com', '$2y$10$sjO44.sMlB/BngbPsjlv3OK1i7swZn0XfDoYentaJiL0YwaYO2jaO', 1, b'1', 'iyuxJAsQaJmtqDrK6amqMF4vIVWN4VsCRn2j6AYpfxIjhQC3nE1kjdnHHMfU', b'0'),
(4, 'trunghieu', 'trunghieu@utehy.vn', '$2y$10$QswWdo5xtw/kvOpD.BRa6.luj1eH841KZyGxJaA5A4OlKBEi7mEna', 2, b'1', NULL, b'0');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Chỉ mục cho bảng `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `make_appointment`
--
ALTER TABLE `make_appointment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `coupon_id` (`coupon_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_type_id` (`product_type_id`);

--
-- Chỉ mục cho bảng `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT cho bảng `coupon`
--
ALTER TABLE `coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `make_appointment`
--
ALTER TABLE `make_appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
