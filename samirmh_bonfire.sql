-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 28, 2017 at 01:51 PM
-- Server version: 5.6.36
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `samirmh_22102017`
--

-- --------------------------------------------------------

--
-- Table structure for table `alt_kateqoriyalar`
--

CREATE TABLE `alt_kateqoriyalar` (
  `id` int(10) UNSIGNED NOT NULL,
  `ad` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_kateqoriya_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `alt_kateqoriyalar`
--

INSERT INTO `alt_kateqoriyalar` (`id`, `ad`, `slug`, `foreign_kateqoriya_id`, `created_at`, `updated_at`) VALUES
(2, 'women1', 'women1', 4, '2017-10-24 11:04:16', '2017-10-24 11:04:16'),
(3, 'men1', 'men1', 1, '2017-10-24 14:45:25', '2017-10-24 14:45:25'),
(4, 'men2', 'men234235', 1, '2017-10-24 15:12:20', '2017-10-24 15:12:20'),
(5, 'men 3', 'men433', 1, '2017-10-24 15:12:35', '2017-10-24 15:12:35'),
(6, 'women23', 'women44335', 4, '2017-10-24 15:12:49', '2017-10-24 15:12:49');

-- --------------------------------------------------------

--
-- Table structure for table `kateqoriyalar`
--

CREATE TABLE `kateqoriyalar` (
  `id` int(10) UNSIGNED NOT NULL,
  `ad` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt_kateqoriya` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 - yoxdur, 1 - var',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kateqoriyalar`
--

INSERT INTO `kateqoriyalar` (`id`, `ad`, `slug`, `alt_kateqoriya`, `created_at`, `updated_at`) VALUES
(1, 'men', 'men', 1, '2017-10-23 11:50:46', '2017-10-23 13:27:22'),
(4, 'women', 'women', 1, '2017-10-23 13:43:43', '2017-10-23 13:43:43'),
(5, 'child', 'child', 0, '2017-10-24 14:37:47', '2017-10-24 14:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2017_10_23_004615_create_kateqoriyalars_table', 2),
(5, '2017_10_23_005107_create_alt_kateqoriyalars_table', 3),
(6, '2017_10_25_183414_create_products_table', 4),
(7, '2017_10_25_184507_create_product__tags_table', 5),
(8, '2017_10_25_185243_create_product__colors_table', 6),
(9, '2017_10_25_185520_create_product__sizes_table', 7),
(10, '2017_10_25_185829_create_product__photos_table', 8),
(11, '2017_10_25_190105_create_product__reviews_table', 9),
(12, '2017_10_28_154136_create_product__ratings_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `stock` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 -var; 0 -yoxdur',
  `code` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kateqoriya` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `price`, `stock`, `code`, `description`, `kateqoriya`, `created_at`, `updated_at`) VALUES
(9, 'the atelier tailored', 499.5, 0, '4657', 'sleek, polished, and boasting an impeccably modern fit, this blue, 2-but-ton lazio suit features a notch lapel, flap pockets, and accompanying flat front trousers—all in pure wool by vitale barberis canonico.\r\n\r\n•  dark blue suit for a tone-on-tone look\r\n•  regular fit\r\n•  100% cotton\r\n•  free shipping with 4 days delivery', '4_6', '2017-10-26 20:23:20', '2017-10-27 18:15:57'),
(10, 'lorem ipsum', 250, 1, '159852', 'lorem ipsum lorem ipsum lorem ipsum dolor lorem ipsum sit lorem ipsum amet', '1_3', '2017-10-27 15:24:27', '2017-10-27 15:24:27');

-- --------------------------------------------------------

--
-- Table structure for table `product__colors`
--

CREATE TABLE `product__colors` (
  `id` int(10) UNSIGNED NOT NULL,
  `reng` char(6) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product__colors`
--

INSERT INTO `product__colors` (`id`, `reng`, `fk_product_id`, `created_at`, `updated_at`) VALUES
(30, 'B83B5E', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(31, '6A2C70', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(32, '3482AA', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(33, '477D7F', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(86, 'F08A5D', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(87, 'B83B5E', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(88, '6A2C70', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(89, '3482AA', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `product__photos`
--

CREATE TABLE `product__photos` (
  `id` int(10) UNSIGNED NOT NULL,
  `fayl` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product__photos`
--

INSERT INTO `product__photos` (`id`, `fayl`, `fk_product_id`, `created_at`, `updated_at`) VALUES
(10, '1509114267155.jpg', 10, '2017-10-27 15:24:28', '2017-10-27 15:24:28'),
(11, '1509114268583.png', 10, '2017-10-27 15:24:28', '2017-10-27 15:24:28'),
(12, '1509114268393.png', 10, '2017-10-27 15:24:28', '2017-10-27 15:24:28'),
(34, '1509187475699.jpg', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(35, '150918747534.jpg', 9, '2017-10-28 11:44:36', '2017-10-28 11:44:36'),
(36, '1509187476116.jpg', 9, '2017-10-28 11:44:36', '2017-10-28 11:44:36'),
(37, '1509187476492.jpg', 9, '2017-10-28 11:44:36', '2017-10-28 11:44:36'),
(38, '1509187476493.jpg', 9, '2017-10-28 11:44:36', '2017-10-28 11:44:36'),
(39, '1509187476822.jpg', 9, '2017-10-28 11:44:36', '2017-10-28 11:44:36');

-- --------------------------------------------------------

--
-- Table structure for table `product__ratings`
--

CREATE TABLE `product__ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `count` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product__ratings`
--

INSERT INTO `product__ratings` (`id`, `count`, `fk_product_id`, `created_at`, `updated_at`) VALUES
(141, '2', 9, '2017-10-28 13:42:55', '2017-10-28 13:42:55'),
(142, '1', 9, '2017-10-28 13:42:57', '2017-10-28 13:42:57'),
(143, '3', 9, '2017-10-28 13:42:58', '2017-10-28 13:42:58'),
(144, '5', 9, '2017-10-28 13:56:43', '2017-10-28 13:56:43'),
(145, '2', 9, '2017-10-28 13:59:45', '2017-10-28 13:59:45'),
(146, '2', 9, '2017-10-28 14:02:14', '2017-10-28 14:02:14'),
(147, '2', 9, '2017-10-28 14:04:36', '2017-10-28 14:04:36'),
(148, '3', 9, '2017-10-28 14:04:40', '2017-10-28 14:04:40'),
(149, '2', 9, '2017-10-28 14:05:40', '2017-10-28 14:05:40'),
(150, '2', 9, '2017-10-28 14:05:43', '2017-10-28 14:05:43'),
(151, '3', 9, '2017-10-28 14:06:35', '2017-10-28 14:06:35'),
(152, '3', 9, '2017-10-28 14:07:51', '2017-10-28 14:07:51'),
(153, '2', 9, '2017-10-28 14:12:17', '2017-10-28 14:12:17'),
(154, '3', 9, '2017-10-28 14:19:20', '2017-10-28 14:19:20'),
(155, '2', 9, '2017-10-28 14:19:47', '2017-10-28 14:19:47'),
(156, '3', 9, '2017-10-28 14:20:37', '2017-10-28 14:20:37'),
(157, '2', 9, '2017-10-28 14:22:54', '2017-10-28 14:22:54'),
(158, '2', 9, '2017-10-28 14:23:00', '2017-10-28 14:23:00'),
(159, '2', 9, '2017-10-28 14:23:30', '2017-10-28 14:23:30'),
(160, '3', 9, '2017-10-28 14:25:23', '2017-10-28 14:25:23');

-- --------------------------------------------------------

--
-- Table structure for table `product__sizes`
--

CREATE TABLE `product__sizes` (
  `id` int(10) UNSIGNED NOT NULL,
  `olcu` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product__sizes`
--

INSERT INTO `product__sizes` (`id`, `olcu`, `fk_product_id`, `created_at`, `updated_at`) VALUES
(103, '45', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(104, '46', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(105, '47', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(106, '48', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(159, '45', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(160, '46', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(161, '47', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(162, '48', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `product__tags`
--

CREATE TABLE `product__tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `tag` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fk_product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product__tags`
--

INSERT INTO `product__tags` (`id`, `tag`, `fk_product_id`, `created_at`, `updated_at`) VALUES
(60, 'lorem', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(61, 'ipsum', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(62, 'dolor', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(63, 'sit', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(64, 'amet', 10, '2017-10-27 15:24:27', '2017-10-27 15:24:27'),
(123, 'fashion', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(124, 'hood', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(125, 'classic', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35'),
(126, 'yeni', 9, '2017-10-28 11:44:35', '2017-10-28 11:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `admin`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'samir', 'samirmh00@gmail.com', '$2y$10$SnswXPwXhdIU2X0iqY1TDeU3EQiRTx4zvkdETNQRfgE1eCV8x8aQa', 1, 'RiNvHgU6TcrOqMF9amJt6VF1KhKAnAZpiGUWorw5rpn9wD4oNtJRydnNtST0', '2017-10-22 21:20:29', '2017-10-22 21:20:29'),
(2, 'test', 'test@test.com', '$2y$10$u24TvTlfNJoj4bUzl.McQOEETol7SMgIdk7zt7J/JndJnliPiAnHK', 1, 'LChm86PaAgVzOzdbxkv8EohPNs2LGrm1pDK5RButSUoufmwmNgTDIQ7APM2t', '2017-10-28 14:38:51', '2017-10-28 14:38:51');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alt_kateqoriyalar`
--
ALTER TABLE `alt_kateqoriyalar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `alt_kateqoriyalar_slug_unique` (`slug`),
  ADD KEY `alt_kateqoriyalar_foreign_kateqoriya_id_foreign` (`foreign_kateqoriya_id`);

--
-- Indexes for table `kateqoriyalar`
--
ALTER TABLE `kateqoriyalar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kateqoriyalar_slug_unique` (`slug`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product__colors`
--
ALTER TABLE `product__colors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product__colors_fk_product_id_foreign` (`fk_product_id`);

--
-- Indexes for table `product__photos`
--
ALTER TABLE `product__photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product__photos_fk_product_id_foreign` (`fk_product_id`);

--
-- Indexes for table `product__ratings`
--
ALTER TABLE `product__ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product__ratings_fk_product_id_foreign` (`fk_product_id`);

--
-- Indexes for table `product__sizes`
--
ALTER TABLE `product__sizes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product__sizes_fk_product_id_foreign` (`fk_product_id`);

--
-- Indexes for table `product__tags`
--
ALTER TABLE `product__tags`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product__tags_fk_product_id_foreign` (`fk_product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alt_kateqoriyalar`
--
ALTER TABLE `alt_kateqoriyalar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `kateqoriyalar`
--
ALTER TABLE `kateqoriyalar`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `product__colors`
--
ALTER TABLE `product__colors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;
--
-- AUTO_INCREMENT for table `product__photos`
--
ALTER TABLE `product__photos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `product__ratings`
--
ALTER TABLE `product__ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=161;
--
-- AUTO_INCREMENT for table `product__sizes`
--
ALTER TABLE `product__sizes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=163;
--
-- AUTO_INCREMENT for table `product__tags`
--
ALTER TABLE `product__tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `alt_kateqoriyalar`
--
ALTER TABLE `alt_kateqoriyalar`
  ADD CONSTRAINT `alt_kateqoriyalar_foreign_kateqoriya_id_foreign` FOREIGN KEY (`foreign_kateqoriya_id`) REFERENCES `kateqoriyalar` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product__colors`
--
ALTER TABLE `product__colors`
  ADD CONSTRAINT `product__colors_fk_product_id_foreign` FOREIGN KEY (`fk_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product__photos`
--
ALTER TABLE `product__photos`
  ADD CONSTRAINT `product__photos_fk_product_id_foreign` FOREIGN KEY (`fk_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product__ratings`
--
ALTER TABLE `product__ratings`
  ADD CONSTRAINT `product__ratings_fk_product_id_foreign` FOREIGN KEY (`fk_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product__sizes`
--
ALTER TABLE `product__sizes`
  ADD CONSTRAINT `product__sizes_fk_product_id_foreign` FOREIGN KEY (`fk_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product__tags`
--
ALTER TABLE `product__tags`
  ADD CONSTRAINT `product__tags_fk_product_id_foreign` FOREIGN KEY (`fk_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
