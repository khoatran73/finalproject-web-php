-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 07, 2021 lúc 05:10 AM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `courseonline`
--
CREATE DATABASE IF NOT EXISTS `courseonline` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci;
USE `courseonline`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account`
--

CREATE TABLE `account` (
  `name` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `position` varchar(20) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `account`
--

INSERT INTO `account` (`name`, `email`, `password`, `position`, `image`) VALUES
('Báº£o Vy', 'baovy@gmail.com', '123', 'student', 'images/baovy.jpg'),
('Duy Tuáº¥n', 'duytuan@gmail.com', '123', 'teacher', 'images/tuan.jpg'),
('Minh HÃ o', 'hao@gmail.com', '123', 'teacher', 'images/non-avt.png'),
('Anh Khoa', 'khoa@gmail.com', '123456', 'admin', 'images/khoa.jpg'),
('quang minh', 'minh@123', '123', 'manager', 'images/minh.jpg'),
('Ngá»c Tháº£o', 'ngocthao@gmail.com', '123', 'teacher', 'images/ngocthao.jpg'),
('ThÃ¡i Há»c', 'thaihoc@gmail.com', '123', 'teacher', 'images/hoc.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

CREATE TABLE `course` (
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `id_course` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `email_teacher` varchar(255) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `course`
--

INSERT INTO `course` (`name`, `content`, `image`, `token`, `id_course`, `email_teacher`) VALUES
('ToÃ¡n 7', 'ToÃ¡n 7 ráº¥t hay', 'toan7.jpg', '97c7d35db83fc7cf1a0efc9b2a4c30eb', 'C001', 'duytuan@gmail.com'),
('Lá»‹ch sá»­ 8 ', 'Lá»‹ch sá»­ 8', 'lichsu8.jpg', 'c60d522b23ef0a06a307c43c85a69bfe', 'C002', 'duytuan@gmail.com'),
('ToÃ¡n 5', 'ToÃ¡n 5', 'toan5.jpg', '5a2532802f14403e5caf327f20a4e413', 'C003', 'duytuan@gmail.com'),
('ToÃ¡n 3', 'ToÃ¡n 3', 'toan3.jpg', '0bfdfd1d12e4291e297ec0fd315f119d', 'C004', 'duytuan@gmail.com'),
('Lá»‹ch sá»­ 7', 'Lá»‹ch sá»­ lá»›p 7 rÃ¢t hay, cuá»‘n hÃºt', 'lichsu7.jpg', '0fc47fad3c4dc5930090b4b2aa58c1cd', 'C005', 'hao@gmail.com'),
('HÃ³a há»c 11', 'HÃ³a há»c 11 lÃ  má»™t mÃ´n há»c ráº¥t hack nÃ£o', 'hoa11.jpg', 'd84d2901d44ac5c0a02e2e5f9460911e', 'C006', 'ngocthao@gmail.com'),
('Ngá»¯ vÄƒn 7', 'Ngá»¯ vÄƒn 7 ráº¥t hay', 'van9.jpg', '9293b24b33a4b94c78a08d4065a06abd', 'C007', 'duytuan@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `mycourses`
--

CREATE TABLE `mycourses` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_course` varchar(10) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `mycourses`
--

INSERT INTO `mycourses` (`email`, `id_course`) VALUES
('baovy@gmail.com', 'C002'),
('duytuan@gmail.com', 'C001'),
('duytuan@gmail.com', 'C002'),
('duytuan@gmail.com', 'C003'),
('duytuan@gmail.com', 'C004'),
('hao@gmail.com', 'C005');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `thecao`
--

CREATE TABLE `thecao` (
  `soseri` varchar(11) COLLATE utf8mb4_vietnamese_ci NOT NULL,
  `mathe` varchar(13) COLLATE utf8mb4_vietnamese_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_vietnamese_ci;

--
-- Đang đổ dữ liệu cho bảng `thecao`
--

INSERT INTO `thecao` (`soseri`, `mathe`) VALUES
('75117114441', '0732227414247'),
('75117183333', '0732265302334'),
('75117220738', '0732286977930'),
('75117543166', '0732217690151');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id_course`);

--
-- Chỉ mục cho bảng `mycourses`
--
ALTER TABLE `mycourses`
  ADD PRIMARY KEY (`email`,`id_course`),
  ADD KEY `id_course` (`id_course`);

--
-- Chỉ mục cho bảng `thecao`
--
ALTER TABLE `thecao`
  ADD PRIMARY KEY (`soseri`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `mycourses`
--
ALTER TABLE `mycourses`
  ADD CONSTRAINT `FK_mycourses_email` FOREIGN KEY (`email`) REFERENCES `account` (`email`),
  ADD CONSTRAINT `FK_mycourses_id` FOREIGN KEY (`ID_course`) REFERENCES `course` (`id_course`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
