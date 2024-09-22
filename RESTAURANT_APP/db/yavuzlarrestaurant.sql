-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 22 Eyl 2024, 16:43:12
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `yavuzlarrestaurant`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `basket`
--

CREATE TABLE `basket` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `note` varchar(145) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `restaurant_id` int(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `title` varchar(45) NOT NULL,
  `description` varchar(145) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `restaurant_id`, `username`, `title`, `description`, `score`, `created_at`, `updated_at`, `order_id`) VALUES
(2, 15, 1, 'sefa', 'bbbbbbbbbbbb', 'bbbbbbbbbbbbbb', 10, '2024-09-20 10:03:58', '0000-00-00 00:00:00', 2),
(3, 15, 2, 'root', 'dasdasd', 'adasda', 8, '2024-09-20 10:04:04', '0000-00-00 00:00:00', 6);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(145) DEFAULT NULL,
  `logo_path` varchar(145) DEFAULT NULL,
  `deleted_at` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `company`
--

INSERT INTO `company` (`id`, `name`, `description`, `logo_path`, `deleted_at`) VALUES
(1, 'Oncu', 'Dönerci', NULL, 0),
(2, 'KFC', 'tavukçu efsane', NULL, 0),
(3, 'Hatayca', 'dönerciyiz', NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cupon`
--

CREATE TABLE `cupon` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `cupon`
--

INSERT INTO `cupon` (`id`, `restaurant_id`, `name`, `discount`, `created_at`) VALUES
(3, -1, 'sepette', 40, '2024-09-21 15:45:09'),
(4, 1, 'efsane ', 50, '2024-09-21 15:45:18');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `food`
--

CREATE TABLE `food` (
  `id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(145) DEFAULT NULL,
  `image_path` varchar(145) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `food`
--

INSERT INTO `food` (`id`, `restaurant_id`, `name`, `description`, `image_path`, `price`, `discount`, `created_at`, `deleted_at`) VALUES
(1, 1, 'soslu dürüm', 'bol soslu', NULL, 75, 5, NULL, 0),
(2, 2, 'soslu tavuk', 'üfff', NULL, 110, 0, '2024-09-15 19:48:53', 0),
(3, 1, 'ekmek arası tavuk', 'kızarmış tavuklar', NULL, 55, 0, '2024-09-17 23:33:54', 0),
(4, 1, 'Patates Kızartması', 'çıtır çıtır kızartma', NULL, 50, NULL, '2024-09-21 21:39:57', 1),
(5, 4, 'Patates Kızartması', 'adadad', NULL, 35, NULL, '2024-09-22 14:07:53', 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_status` varchar(45) DEFAULT NULL,
  `total_price` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `order`
--

INSERT INTO `order` (`id`, `user_id`, `order_status`, `total_price`, `created_at`) VALUES
(2, 15, 'Teslim Edildi', 195, '2024-09-17 22:35:32'),
(3, 15, 'Teslim Edildi', 70, '2024-09-17 22:37:00'),
(4, 15, 'Teslim Edildi', 70, '2024-09-18 09:43:05'),
(5, 15, 'Hazırlanıyor', 70, '2024-09-18 09:48:40'),
(6, 15, 'Teslim Edildi', 180, '2024-09-18 11:02:14'),
(7, 15, 'Hazırlanıyor', 210, '2024-09-20 09:51:58'),
(8, 15, 'Hazırlanıyor', 210, '2024-09-20 14:02:30');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `food_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `order_items`
--

INSERT INTO `order_items` (`id`, `food_id`, `order_id`, `quantity`, `price`) VALUES
(3, 1, 2, 2, 70),
(4, 3, 2, 1, 55),
(5, 1, 3, 1, 70),
(6, 1, 4, 1, 70),
(7, 1, 5, 1, 70),
(8, 2, 6, 1, 110),
(9, 1, 6, 1, 70),
(10, 1, 7, 2, 70),
(11, 1, 7, 1, 70),
(12, 1, 8, 1, 70),
(13, 1, 8, 2, 70);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `restaurant`
--

CREATE TABLE `restaurant` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(145) DEFAULT NULL,
  `image_path` varchar(145) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `restaurant`
--

INSERT INTO `restaurant` (`id`, `company_id`, `name`, `description`, `image_path`, `created_at`) VALUES
(1, 1, 'OncuDoner', 'Soslu Doner', NULL, '2024-09-21 17:28:16'),
(2, 2, 'çıtırtavukçu', 'soslu tavuk iyi', NULL, '2024-09-15 19:48:09'),
(3, 1, 'Hatayca', 'en güzel döner bizde', NULL, '2024-09-21 17:28:07'),
(4, 3, 'Kızılay Hatayca', 'Kızılay da en işlek yerdeyiz', NULL, '2024-09-22 14:07:40');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `surname` varchar(45) DEFAULT NULL,
  `username` varchar(45) DEFAULT NULL,
  `sifre` varchar(250) DEFAULT NULL,
  `balance` int(11) DEFAULT 5000,
  `created_at` datetime DEFAULT NULL,
  `deleted_at` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `company_id`, `role`, `name`, `surname`, `username`, `sifre`, `balance`, `created_at`, `deleted_at`) VALUES
(15, -1, 'Musteri', 'Arif Sefa', 'Bölükbaşı', 'sefa', '$argon2id$v=19$m=65536,t=4,p=1$ZlA3S3BLV3M5TE5YZ01rdg$C/ca3sdTPUKWmMbL7D49p1QbByzKNKhk/pl2adtCAc0', 4790, '2024-09-15 18:40:21', 0),
(16, 1, 'Firma', 'aaa', 'aaa', 'Oncu', '$argon2id$v=19$m=65536,t=4,p=1$WEVVZjNSUHVzQlEzUkRVYg$47Hv9q0FJ3mRcEgT56LVRnPzDcV5B5brglUzWXvV50g', 5000, '2024-09-15 19:45:04', 0),
(17, 2, 'Firma', 'bbb', 'bbb', 'kfc', '$argon2id$v=19$m=65536,t=4,p=1$WEVVZjNSUHVzQlEzUkRVYg$47Hv9q0FJ3mRcEgT56LVRnPzDcV5B5brglUzWXvV50g', 5000, '2024-09-15 19:47:20', 0),
(18, -1, 'Musteri', 'ismail', 'bıyık', 'iso', '$argon2id$v=19$m=65536,t=4,p=1$Q25lL1MvVW9QY1ZrUjJ1SA$7/q9VH3jZ9jMa+HSYp2J6EKIhRwugNpft89sHsUUoTw', 5000, '2024-09-20 20:32:26', 1),
(19, -1, 'Admin', 'root', 'root', 'Admin', '$argon2id$v=19$m=65536,t=4,p=1$SERCalpUV3kzOGxKTWFZMw$40XHS32kLLwOcvs4fdqJkyfeBMlTps9GEJWTMNZ2/Ls', 5000, '2024-09-21 16:07:05', 0),
(20, 3, 'Firma', 'Hatayca', 'Firma', 'Hatayca', '$argon2id$v=19$m=65536,t=4,p=1$SVJ3a244OG1BRWlPWjR1Qg$nP0gdmCkwN8DleALPlrjcCTNqn10H9r5JCUIpZd1T1E', 5000, '2024-09-22 13:38:59', 0);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `basket`
--
ALTER TABLE `basket`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cupon`
--
ALTER TABLE `cupon`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `restaurant`
--
ALTER TABLE `restaurant`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `basket`
--
ALTER TABLE `basket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `cupon`
--
ALTER TABLE `cupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `food`
--
ALTER TABLE `food`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Tablo için AUTO_INCREMENT değeri `restaurant`
--
ALTER TABLE `restaurant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
