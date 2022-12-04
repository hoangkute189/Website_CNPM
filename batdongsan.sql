-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 03, 2022 lúc 02:21 AM
-- Phiên bản máy phục vụ: 10.4.24-MariaDB
-- Phiên bản PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `batdongsan`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `Account_id` varchar(11) NOT NULL,
  `User_id` varchar(11) NOT NULL,
  `Name` varchar(30) NOT NULL,
  `Address` varchar(150) NOT NULL,
  `Phone` varchar(10) NOT NULL,
  `Gender` varchar(5) NOT NULL,
  `Email` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`Account_id`, `User_id`, `Name`, `Address`, `Phone`, `Gender`, `Email`) VALUES
('0001', '0001', 'Trần Gia Hoàng', '19 Nguyễn Hữu Thọ, Tân Phong, Quận 7', '0353713399', 'Nam', 'trangiahoang99@gmail.com'),
('0003', '0003', 'Admin', '', '0353713388', 'Nữ', 'admin@gmail.com'),
('0004', '0004', 'Hoàng', '142/21 Thống Nhất', '0818978445', 'Nam', 'trangiahoang99@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `User_id` varchar(11) NOT NULL,
  `Project_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`User_id`, `Project_id`) VALUES
('0001', '0002'),
('0001', '0005');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order project`
--

CREATE TABLE `order project` (
  `User_id` varchar(11) NOT NULL,
  `Project_id` varchar(11) NOT NULL,
  `State_order` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `order project`
--

INSERT INTO `order project` (`User_id`, `Project_id`, `State_order`) VALUES
('0001', '0006', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `project`
--

CREATE TABLE `project` (
  `Project_id` varchar(11) NOT NULL,
  `Name` varchar(150) NOT NULL,
  `Investor` varchar(50) NOT NULL,
  `Location` varchar(150) NOT NULL,
  `Area` float NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Image` varchar(200) NOT NULL,
  `Kind_purchase` varchar(50) NOT NULL,
  `Classify` varchar(50) NOT NULL,
  `Price` float NOT NULL,
  `Unit` varchar(50) NOT NULL,
  `State` tinyint(1) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Region_id` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `project`
--

INSERT INTO `project` (`Project_id`, `Name`, `Investor`, `Location`, `Area`, `Description`, `Image`, `Kind_purchase`, `Classify`, `Price`, `Unit`, `State`, `Type`, `Region_id`) VALUES
('0001', 'Căn chung cư cao cấp quận 7', 'Tổng Công Ty Xây Dựng Thanh Hóa(CTCP)', 'Số 3 Tôn Thất Thuyết', 30, 'Căn chung cư rộng lớn, hiện đang được bán với giá rẻ trên địa bàn quận 7', 'images/item1.jpg', 'Cho bán', 'HOT', 2.5, 'Tỷ', 1, 'Chung cư', '0001'),
('0002', 'Căn hộ nhỏ quận 7', 'Ông. Dương Trọng Đức', 'Số 629 Lê Văn Lương, Tân Phong, Quận 7', 60, 'Căn hộ nhỏ giá rẻ, không gian rộng rãi, gần khu dân cư', 'images/item2.jpg', 'Cho thuê', 'NEW', 15, 'Triệu / Tháng', 1, 'Căn hộ', '0001'),
('0003', 'Mặt bằng quận 1', 'Bà. Hồ Cẩm Loan', '214 Lê Lợi, Quận 1', 60, 'Mặt bằng rộng rãi, thoáng mát, phù hợp để mở nhà hàng', 'images/item3.jpg', 'Cho thuê', 'NEW', 30, 'Triệu / Tháng', 1, 'Mặt bằng', '0001'),
('0004', 'Mặt bằng quận 3', 'Bà. Hồ Cẩm Thơ', '214 Lê Thái Tổ, Quận 1', 70, 'Mặt bằng rộng rãi, thoáng mát, phù hợp để mở nhà hàng', 'images/item4.jpg', 'Cho thuê', 'NEW', 25, 'Triệu / Tháng', 1, 'Mặt bằng', '0001'),
('0005', 'Mặt bằng khu An Đông', 'Ông. Dương Trọng Chí', 'Xã Diêm Hồng', 60, 'Mặt bằng bự nhất thành phố này', 'images/item6.jpg', 'Cho thuê', 'HOT', 30, 'Triệu / Tháng', 1, 'Mặt bằng', '0002'),
('0006', 'Mặt bằng khu dân cư Kim Sơn', 'Ông. Mai Anh Tài', '142 Thống Nhất, Phủ Hà, Phan Rang - Tháp Chàm', 80, 'Mặt bằng đang cho thuê với giá cực hời, gần khu dân cư Kim Sơn, rộng rãi thoáng mát', 'images/item7.jpg', 'Cho thuê', 'HOT', 20, 'Triệu / tháng', 0, 'Mặt bằng', '0005');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `region`
--

CREATE TABLE `region` (
  `Region_id` varchar(11) NOT NULL,
  `Name_region` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `region`
--

INSERT INTO `region` (`Region_id`, `Name_region`) VALUES
('0001', 'Hà Nội'),
('0002', 'TP Hồ Chí Minh'),
('0003', 'Đồng Tháp'),
('0004', 'TP Đà Nẵng'),
('0005', 'Ninh Thuận');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `User_id` varchar(11) NOT NULL,
  `Username` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Permission` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`User_id`, `Username`, `Password`, `Permission`) VALUES
('0001', 'giahoang189', 'hoang189', 0),
('0002', 'hoangkun189', 'hoang189', 0),
('0003', 'admin', '123', 1),
('0004', '52000759', 'hoang189', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Account_id`),
  ADD KEY `User_id` (`User_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`User_id`,`Project_id`),
  ADD KEY `Project_id` (`Project_id`);

--
-- Chỉ mục cho bảng `order project`
--
ALTER TABLE `order project`
  ADD PRIMARY KEY (`User_id`,`Project_id`),
  ADD KEY `Project_id` (`Project_id`);

--
-- Chỉ mục cho bảng `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`Project_id`),
  ADD KEY `Region_id` (`Region_id`);

--
-- Chỉ mục cho bảng `region`
--
ALTER TABLE `region`
  ADD PRIMARY KEY (`Region_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`);

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`Project_id`) REFERENCES `project` (`Project_id`);

--
-- Các ràng buộc cho bảng `order project`
--
ALTER TABLE `order project`
  ADD CONSTRAINT `order project_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `user` (`User_id`),
  ADD CONSTRAINT `order project_ibfk_2` FOREIGN KEY (`Project_id`) REFERENCES `project` (`Project_id`);

--
-- Các ràng buộc cho bảng `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`Region_id`) REFERENCES `region` (`Region_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
