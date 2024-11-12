-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 07, 2024 lúc 02:26 PM
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
-- Cơ sở dữ liệu: `clock`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `ten_admin` varchar(40) NOT NULL,
  `mat_khau_admin` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `ten_admin`, `mat_khau_admin`) VALUES
(1, 'admin@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
--

CREATE TABLE `don_hang` (
  `ten` varchar(100) NOT NULL,
  `sdt` varchar(11) NOT NULL,
  `diachi` varchar(100) NOT NULL,
  `tongtien` int(9) NOT NULL,
  `tensanpham` varchar(150) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`ten`, `sdt`, `diachi`, `tongtien`, `tensanpham`, `user_id`) VALUES
('trường xuy3ến', '0173647364', 'Hải hậu nam định', 39506000, 'Tổng giỏ hàng', 6);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
--

CREATE TABLE `gio_hang` (
  `id` int(9) NOT NULL,
  `user_id` int(9) NOT NULL,
  `sanpham_id` int(9) NOT NULL,
  `so_luong` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `gio_hang`
--

INSERT INTO `gio_hang` (`id`, `user_id`, `sanpham_id`, `so_luong`) VALUES
(46, 6, 9, 1),
(47, 6, 10, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `lienhe`
--

CREATE TABLE `lienhe` (
  `id` int(11) NOT NULL,
  `ten` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `tin_nhan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `lienhe`
--

INSERT INTO `lienhe` (`id`, `ten`, `email`, `sdt`, `tin_nhan`) VALUES
(1, 'Nguyễn Văn A', 'nguyenvana@example.com', '0123456789', ''),
(2, 'Trần Thị B', 'tranthib@example.com', '0987654321', ''),
(3, 'Lê C', 'le.c@example.com', '0912345678', ''),
(4, 'trường', 'vut1611@gmail.com', '0394403178', 'tôi muốn mua đồng hồ'),
(5, 'Hiền', 'hien@gmail.com', '0394403178', 'tôi muốn xem đồng hồ'),
(6, 'Anh', 'anh@gmail.com', '0332730926', 'Tôi muốn huỷ đơn hàng'),
(7, 'uyên', 'uyen@gmail.com', '0213584756', 'Tôi chưa nhận đueocj hàng'),
(8, 'sang', 'c@gmail.com', '0394403178', 'ccccccccccccc');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `sanpham`
--

CREATE TABLE `sanpham` (
  `sanpham_id` int(9) NOT NULL,
  `ten_san_pham` varchar(150) NOT NULL,
  `gia` int(9) NOT NULL,
  `mo_ta` varchar(200) NOT NULL,
  `images` varchar(200) NOT NULL,
  `soluong` int(9) NOT NULL,
  `hangmoi` tinyint(1) NOT NULL,
  `hangbanchay` tinyint(1) NOT NULL,
  `hanggiamgia` tinyint(1) NOT NULL,
  `gioitinh` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `sanpham`
--

INSERT INTO `sanpham` (`sanpham_id`, `ten_san_pham`, `gia`, `mo_ta`, `images`, `soluong`, `hangmoi`, `hangbanchay`, `hanggiamgia`, `gioitinh`) VALUES
(1, 'Đồng Hồ Citizen Nữ Dây Kim Loại Eco-Drive EM0892-80D', 12000000, 'Với Logo hình đôi cánh, các thiết kế của Breitling và dẫn đầu trong công nghệ sản xuất đồng hồ.', 'images/dongho1.jpeg', 12, 1, 1, 1, 0),
(2, 'Đồng Hồ Citizen Nam Dây Kim Loại Eco-Drive AW1676-86A', 7110000, 'Thương hiệu	Citizen\r\nXuất xứ	Nhật Bản\r\nMã đồng hồ	AW1676-86A\r\nGiới tính	Nam\r\nĐộ chịu nước	10 ATM\r\nĐộ dày	10 mm', 'images/dongho5.jpeg', 20, 1, 0, 1, 1),
(3, 'Đồng Hồ Citizen Tsuyosa Nam Dây Kim Loại Automatic NJ0153-82X', 13285000, 'Thương hiệu	Citizen\r\nXuất xứ	Nhật Bản\r\nMã đồng hồ	NJ0153-82X\r\nGiới tính	Nam\r\nĐộ chịu nước	5 ATM', 'images/dongho2.jpeg', 9, 1, 1, 1, 1),
(4, 'Đồng Hồ Citizen Nữ Dây Kim Loại Eco-Drive EM0809-83Z', 13826000, 'Thương hiệu	Citizen\r\nXuất xứ	Nhật Bản\r\nMã đồng hồ	NJ0153-82X\r\nGiới tính	Nam\r\n', 'images/dongho4.jpeg', 3, 1, 1, 1, 0),
(5, 'Đồng Hồ Citizen Nam Dây Kim Loại Eco-Drive BM6774-51A', 6490000, 'Thương hiệu	Citizen\r\nXuất xứ	Nhật Bản\r\nMã đồng hồ	BM6774-51A\r\nGiới tính	Nam\r\nĐộ chịu nước	3 ATM', 'images/dongho7.jpeg', 12, 0, 1, 1, 1),
(6, 'Đồng Hồ Citizen Nam Dây Kim Loại Eco-Drive BM7140-54A', 4081000, 'Thương hiệu	Citizen\r\nXuất xứ	Nhật Bản\r\nMã đồng hồ	BM7140-54A\r\nGiới tính	Nam', 'images/dongho8.jpeg', 19, 1, 0, 1, 1),
(7, 'Đồng Hồ Citizen Nam Dây Kim Loại Eco-Drive CA4035-57E', 7000000, 'Thương hiệu	Citizen\r\nXuất xứ	Nhật Bản\r\nMã đồng hồ	CA4035-57E\r\nGiới tính	Nam', 'images/dongho9.jpeg', 20, 1, 0, 1, 1),
(8, 'Đồng Hồ Citizen Nữ Dây Kim Loại Quartz ED8142-51E', 3500000, 'Thương hiệu	Citizen\r\nXuất xứ	Nhật Bản\r\nMã đồng hồ	ED8142-51E\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho10.jpeg', 23, 1, 1, 1, 0),
(9, 'Đồng Hồ Bulova Nam Dây Da Automatic 98A165', 14236000, 'Thương hiệu	Bulova\r\nXuất xứ	Thụy Sĩ / Mỹ\r\nMã đồng hồ	98A165\r\nGiới tính	Nam\r\nĐộ chịu nước	10 ATM', 'images/dongho11.jpeg', 23, 1, 0, 1, 1),
(10, 'Đồng Hồ Bulova Nam Dây Kim Loại Automatic 98A166', 12635000, 'Thương hiệu	Bulova\r\nXuất xứ	Thụy Sĩ / Mỹ\r\nMã đồng hồ	98A166\r\nGiới tính	Nam\r\nĐộ chịu nước	10 ATM', 'images/dongho11.jpeg', 28, 0, 1, 0, 1),
(11, 'Đồng Hồ Bulova Nam Dây Kim Loại Automatic 96A118', 12635000, 'Thương hiệu	Bulova\r\nXuất xứ	Thụy Sĩ / Mỹ\r\nMã đồng hồ	96A118\r\nGiới tính	Nam\r\nĐộ chịu nước	3 ATM', 'images/dongho13.jpeg', 9, 0, 1, 1, 1),
(12, 'Đồng Hồ Bulova Nữ Dây Kim Loại Quartz 96P195', 9100000, 'Thương hiệu	Bulova\r\nXuất xứ	Thụy Sĩ / Mỹ\r\nMã đồng hồ	96P195\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho14.jpeg', 15, 1, 0, 1, 0),
(13, 'Đồng Hồ Bulova Nữ Dây Kim Loại Quartz 98L245', 11635000, 'Thương hiệu	Bulova\r\nXuất xứ	Thụy Sĩ / Mỹ\r\nMã đồng hồ	98L245\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho15.jpeg', 29, 1, 0, 0, 0),
(14, 'Đồng Hồ Lacoste Nam Dây Kim Loại Quartz 2010635', 5600000, 'Thương hiệu	Lacoste\r\nXuất xứ	Pháp\r\nMã đồng hồ	2010635\r\nGiới tính	Nam\r\nĐộ chịu nước	5 ATM', 'images/dongho16.jpeg', 11, 0, 1, 0, 1),
(15, 'Đồng Hồ Lacoste Nam Dây Kim Loại Quartz 2010969', 6700000, 'Thương hiệu	Lacoste\r\nXuất xứ	Pháp\r\nMã đồng hồ	2010969\r\nGiới tính	Nam\r\nĐộ chịu nước	5 ATM', 'images/dongho17.jpeg', 12, 0, 1, 1, 1),
(16, 'Đồng Hồ Lacoste Nam Dây Cao Su Quartz 2011011', 3100000, 'Thương hiệu	Lacoste\r\nXuất xứ	Pháp\r\nMã đồng hồ	2011011\r\nGiới tính	Nam\r\nĐộ chịu nước	5 ATM', 'images/dongho18.jpeg', 25, 0, 1, 0, 1),
(17, 'Đồng Hồ Lacoste Nữ Dây Kim Loại Quartz 2000718', 5500000, 'Thương hiệu	Lacoste\r\nXuất xứ	Pháp\r\nMã đồng hồ	2000718\r\nGiới tính	Nữ\r\nĐộ chịu nước	5 ATM', 'images/dongho19.jpeg', 30, 1, 0, 0, 0),
(18, 'Đồng Hồ Lacoste Nữ Dây Da Quartz 2000652', 4500000, 'Thương hiệu	Lacoste\r\nXuất xứ	Pháp\r\nMã đồng hồ	2000652\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho20.jpeg', 22, 1, 1, 0, 0),
(19, 'Đồng Hồ Tommy Hilfiger Nam Dây Kim Loại Quartz 1791709', 5440000, 'Thương hiệu	Tommy Hilfiger\r\nXuất xứ	USA\r\nMã đồng hồ	1791709\r\nGiới tính	Nam\r\nĐộ chịu nước	5 ATM', 'images/dongho21.jpeg', 20, 0, 0, 1, 1),
(20, 'Đồng Hồ Tommy Hilfiger Nam Dây Kim Loại Quartz 1791713', 2800000, 'Thương hiệu	Tommy Hilfiger\r\nXuất xứ	USA\r\nMã đồng hồ	1791713\r\nGiới tính	Nam\r\nĐộ chịu nước	3 ATM', 'images/dongho22.jpeg', 33, 1, 1, 0, 1),
(21, 'Đồng Hồ Tommy Hilfiger Nam Dây Da Quartz 1791747', 2800000, 'Thương hiệu	Tommy Hilfiger\r\nXuất xứ	USA\r\nMã đồng hồ	1791747\r\nGiới tính	Nam\r\nĐộ chịu nước	3 ATM', 'images/dongho23.jpeg', 13, 0, 1, 0, 1),
(22, 'Đồng Hồ Tommy Hilfiger Nữ Dây Kim Loại Quartz 1782207', 3400000, 'Thương hiệu	Tommy Hilfiger\r\nXuất xứ	USA\r\nMã đồng hồ	1782207\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho24.jpeg', 21, 0, 1, 1, 0),
(23, 'Đồng Hồ Tommy Hilfiger Nữ Dây Kim Loại Quartz 1781970', 2660000, 'Thương hiệu	Tommy Hilfiger\r\nXuất xứ	USA\r\nMã đồng hồ	1781970\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho25.jpeg', 30, 0, 0, 1, 0),
(24, 'Đồng Hồ Tommy Hilfiger Nữ Dây Cao Su Quartz 1782233', 1800000, 'Thương hiệu	Tommy Hilfiger\r\nXuất xứ	USA\r\nMã đồng hồ	1782233\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho26.jpeg', 12, 1, 0, 0, 0),
(25, 'Đồng Hồ Tommy Hilfiger Nữ Dây Cao Su Quartz 1781258', 3500000, 'Thương hiệu	Tommy Hilfiger\r\nXuất xứ	USA\r\nMã đồng hồ	1781258\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho27.jpeg', 27, 0, 1, 0, 0),
(26, 'Đồng Hồ Ferrari Nam Dây Da Quartz 0830845', 5900000, 'Thương hiệu	Ferrari\r\nXuất xứ	Ý\r\nMã đồng hồ	0830845\r\nGiới tính	Nam\r\nĐộ chịu nước	5 ATM', 'images/dongho28.jpeg', 27, 1, 1, 0, 1),
(27, 'Đồng Hồ Ferrari Nam Dây Cao Su Quartz 0830639  Giá giảm:', 6175000, 'Thương hiệu	Ferrari\r\nXuất xứ	Ý\r\nMã đồng hồ	0830639\r\nGiới tính	Nam\r\nĐộ chịu nước	5 ATM', 'images/dongho29.jpeg', 11, 1, 1, 0, 1),
(28, 'Đồng Hồ Ferrari Nam Dây Cao Su Quartz 0830615', 2900000, 'Thương hiệu	Ferrari\r\nXuất xứ	Ý\r\nMã đồng hồ	0830615\r\nGiới tính	Nam\r\nĐộ chịu nước	3 ATM', 'images/dongho30.jpeg', 11, 0, 0, 1, 1),
(29, 'Đồng Hồ Ferrari Nữ Dây Cao Su Quartz 0840036', 2800000, 'Thương hiệu	Ferrari\r\nXuất xứ	Ý\r\nMã đồng hồ	0840036\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho31.jpeg', 19, 0, 1, 0, 0),
(30, 'Đồng Hồ Ferrari Nữ Dây Cao Su Quartz 0840028', 2900000, 'Thương hiệu	Ferrari\r\nXuất xứ	Ý\r\nMã đồng hồ	0840028\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho32.jpeg', 37, 0, 1, 1, 0),
(31, 'Đồng Hồ Coach Nữ Dây Da Quartz 14503122', 2300000, 'Thương hiệu	Coach\r\nXuất xứ	USA\r\nMã đồng hồ	14503122\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho33.jpeg', 20, 0, 1, 0, 0),
(32, 'Đồng Hồ Coach Nữ Dây Kim Loại Quartz 14502976', 3500000, 'Thương hiệu	Coach\r\nXuất xứ	USA\r\nMã đồng hồ	14502976\r\nGiới tính	Nữ\r\nĐộ chịu nước	3 ATM', 'images/dongho34.jpeg', 23, 1, 0, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `ten_tai_khoan` varchar(100) NOT NULL,
  `ten_dang_nhap` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `sdt` varchar(20) DEFAULT NULL,
  `dia_chi` text DEFAULT NULL,
  `mat_khau` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`user_id`, `ten_tai_khoan`, `ten_dang_nhap`, `email`, `sdt`, `dia_chi`, `mat_khau`) VALUES
(1, 'Van Anh', 'nguyenvananh', 'vana@gamil.com', '0123456789', 'sài gòn', '123'),
(2, 'Tran Thi Bình', 'tranthib', 'thib@gamil.com', '0987654321', 'Lâm đồng', '123'),
(3, 'Lê Cường', 'levanc', 'levanc@gamil.com', '0912345678', 'Tây nguyên', '123'),
(4, 'truong@123', 'truong@123', 'truong@gmail.com', '0394403178', 'Thái Bình', '123'),
(5, 'hien123', 'hien123', 'hiendao@gmail.com', '0358221552', 'Hà Nội', '123'),
(6, 'sang', 'sang123', 'sang@gmail.com', '0394403178', 'Thái Bình', '123'),
(7, 'anh1123', 'anh1123', 'anh@gmail.com', '0343487364', 'Hà nam', '123'),
(8, 'cuong123', 'cuong123', 'cuong@gmail.com', '0383765322', 'Thanh hoá', '123');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Khoa_ngoai_user` (`user_id`),
  ADD KEY `Khoa_ngoai_sanpham` (`sanpham_id`);

--
-- Chỉ mục cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`sanpham_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `ten_dang_nhap` (`ten_dang_nhap`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `lienhe`
--
ALTER TABLE `lienhe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `Khoa_ngoai_sanpham` FOREIGN KEY (`sanpham_id`) REFERENCES `sanpham` (`sanpham_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Khoa_ngoai_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
