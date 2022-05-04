-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 19, 2021 at 06:56 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pinkish_fantasy`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Korea Brands', '/brand_images/', 1, 1, 1, NULL, '2021-01-08 02:34:42', NULL, NULL),
(2, 'China Brands', '/brand_images/', 1, 1, 1, NULL, '2021-01-08 02:34:58', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(10) UNSIGNED NOT NULL,
  `products_id` int(11) NOT NULL,
  `product_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double(8,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `user_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `session_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_categories_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `sub_categories_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'T-shirts', 1, 1, 1, 1, NULL, '2021-01-07 23:32:49', NULL, NULL),
(2, 'Shirts', 1, 1, 1, 1, NULL, '2021-01-07 23:32:57', NULL, NULL),
(3, 'Blouses', 1, 1, 1, 1, NULL, '2021-01-07 23:33:02', '2021-01-07 23:33:09', NULL),
(4, 'Hoodies', 2, 1, 1, 1, NULL, '2021-01-07 23:33:38', '2021-01-07 23:33:58', NULL),
(5, 'Sweaters', 2, 1, 1, 1, NULL, '2021-01-07 23:34:32', NULL, NULL),
(6, 'Long Coats', 3, 1, 1, 1, NULL, '2021-01-07 23:34:42', NULL, NULL),
(7, 'Tunic Dresses', 4, 1, 1, 1, NULL, '2021-01-07 23:35:17', NULL, NULL),
(8, 'Yoke Dresses', 4, 1, 1, 1, NULL, '2021-01-07 23:35:30', NULL, NULL),
(9, 'Sun Dresses', 4, 1, 1, 1, NULL, '2021-01-07 23:35:50', NULL, NULL),
(10, 'Tuxedo', 3, 1, 1, 1, NULL, '2021-01-07 23:36:41', NULL, NULL),
(11, 'Mini-Skirts', 5, 1, 1, 1, NULL, '2021-01-07 23:37:28', NULL, NULL),
(12, 'Zero Quarter', 5, 1, 1, 1, NULL, '2021-01-07 23:37:53', NULL, NULL),
(13, 'Jeans', 7, 1, 1, 1, NULL, '2021-01-07 23:38:13', NULL, NULL),
(14, 'Sweat Pants', 7, 1, 1, 1, NULL, '2021-01-07 23:38:29', NULL, NULL),
(15, 'Shorts', 7, 1, 1, 1, NULL, '2021-01-07 23:38:37', NULL, NULL),
(16, 'Acne', 8, 1, 1, 1, NULL, '2021-01-07 23:39:26', NULL, NULL),
(17, 'Botox', 8, 1, 1, 1, NULL, '2021-01-07 23:39:38', NULL, NULL),
(18, 'Facial', 8, 1, 1, 1, NULL, '2021-01-07 23:39:47', NULL, NULL),
(19, 'Cologne', 10, 1, 1, 1, NULL, '2021-01-07 23:40:12', NULL, NULL),
(20, 'Perfumes', 10, 1, 1, 1, NULL, '2021-01-07 23:40:28', NULL, NULL),
(21, 'Face Powders', 9, 1, 1, 1, NULL, '2021-01-07 23:41:01', NULL, NULL),
(22, 'Lipsticks', 9, 1, 1, 1, NULL, '2021-01-07 23:41:11', NULL, NULL),
(23, 'Toner', 9, 1, 1, 1, NULL, '2021-01-07 23:41:20', NULL, NULL),
(24, 'Foundation', 9, 1, 1, 1, NULL, '2021-01-07 23:41:33', NULL, NULL),
(25, 'Base coats and Under coats', 11, 1, 1, 1, NULL, '2021-01-07 23:42:21', NULL, NULL),
(26, 'Nail Extenders', 11, 1, 1, 1, NULL, '2021-01-07 23:42:39', NULL, NULL),
(27, 'Nail Polishes', 11, 1, 1, 1, NULL, '2021-01-07 23:42:50', NULL, NULL),
(28, 'Dentifrices', 12, 1, 1, 1, NULL, '2021-01-07 23:43:09', NULL, NULL),
(29, 'Mouthwashes', 12, 1, 1, 1, NULL, '2021-01-07 23:43:22', NULL, NULL),
(30, 'Bath Bombs', 13, 1, 1, 1, NULL, '2021-01-07 23:43:38', NULL, NULL),
(31, 'Soaps and Detergents', 13, 1, 1, 1, NULL, '2021-01-07 23:43:54', NULL, NULL),
(32, 'Lotions', 13, 1, 1, 1, NULL, '2021-01-07 23:44:11', NULL, NULL),
(33, 'Mini-bags', 15, 1, 1, 1, NULL, '2021-01-07 23:45:17', NULL, NULL),
(34, 'Side-bags', 15, 1, 1, 1, NULL, '2021-01-07 23:45:30', NULL, NULL),
(35, 'String Bags', 15, 1, 1, 1, NULL, '2021-01-07 23:45:45', NULL, NULL),
(36, 'Caps', 16, 1, 1, 1, NULL, '2021-01-07 23:45:54', NULL, NULL),
(37, 'Hats', 16, 1, 1, 1, NULL, '2021-01-07 23:46:04', NULL, NULL),
(38, 'High Heels', 17, 1, 1, 1, NULL, '2021-01-07 23:46:15', NULL, NULL),
(39, 'Sandels', 17, 1, 1, 1, NULL, '2021-01-07 23:46:28', NULL, NULL),
(40, 'Walking shoes', 17, 1, 1, 1, NULL, '2021-01-07 23:46:55', NULL, NULL),
(41, 'Digital watches', 18, 1, 1, 1, NULL, '2021-01-07 23:47:28', NULL, NULL),
(42, 'Smart Watches', 18, 1, 1, 1, NULL, '2021-01-07 23:47:38', NULL, NULL),
(43, 'Dress Watches', 18, 1, 1, 1, NULL, '2021-01-07 23:47:50', NULL, NULL),
(44, 'Necklaces', 19, 1, 1, 1, NULL, '2021-01-07 23:48:54', NULL, NULL),
(45, 'Earrings', 19, 1, 1, 1, NULL, '2021-01-07 23:49:04', NULL, NULL),
(46, 'Rings', 19, 1, 1, 1, NULL, '2021-01-07 23:49:12', NULL, NULL),
(47, 'Denim Jackets', 6, 1, 1, 1, NULL, '2021-01-07 23:51:24', NULL, NULL),
(48, 'Track Jackets', 6, 1, 1, 1, NULL, '2021-01-07 23:51:47', '2021-01-07 23:52:25', NULL),
(49, 'Hooded Jackets', 6, 1, 1, 1, NULL, '2021-01-07 23:51:59', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Ayeyarwady', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(2, 'Bago', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(3, 'Chin', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(4, 'Kachin', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(5, 'Kayah', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(6, 'Kayin', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(7, 'Magway', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(8, 'Mandalay', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(9, 'Mon', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(10, 'Rakhine', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(11, 'Sagaing', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(12, 'Shan', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(13, 'Tanintharyi', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(14, 'Yangon', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(15, 'Naypyidaw', 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Myanmar', 1, 1, 1, NULL, '2021-01-07 23:28:30', NULL, NULL),
(2, 'China', 1, 1, 1, NULL, '2021-01-07 23:28:36', NULL, NULL),
(3, 'Korea', 1, 1, 1, NULL, '2021-01-07 23:28:43', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` int(10) UNSIGNED NOT NULL,
  `coupon_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `amount_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiry_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `delivery_address`
--

CREATE TABLE `delivery_address` (
  `id` int(10) UNSIGNED NOT NULL,
  `users_id` int(11) NOT NULL,
  `users_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pincode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `users_id` int(10) UNSIGNED NOT NULL,
  `items_id` int(10) UNSIGNED NOT NULL,
  `inactive_at` int(11) DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`users_id`, `items_id`, `inactive_at`, `created_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 3, NULL, 4, NULL, '2021-01-15 23:13:46', '2021-01-15 23:13:46', NULL),
(4, 7, NULL, 4, NULL, '2021-01-15 23:14:29', '2021-01-15 23:14:29', NULL),
(4, 8, NULL, 4, NULL, '2021-01-16 02:29:12', '2021-01-16 02:29:12', NULL),
(4, 9, NULL, 4, NULL, '2021-01-16 02:50:59', '2021-01-16 02:50:59', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `item_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categories_id` int(11) NOT NULL,
  `countries_id` int(11) NOT NULL,
  `brands_id` int(11) NOT NULL,
  `url` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url4` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url5` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url6` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url7` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_url8` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_type` int(11) NOT NULL DEFAULT 1,
  `detail_info` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `purchase_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sale_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `inactive_at` date DEFAULT NULL,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `name`, `item_code`, `categories_id`, `countries_id`, `brands_id`, `url`, `image_url1`, `image_url2`, `image_url3`, `image_url4`, `image_url5`, `image_url6`, `image_url7`, `image_url8`, `sale_type`, `detail_info`, `description`, `remark`, `purchase_price`, `sale_price`, `status`, `inactive_at`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cotton T-shirt', '1111', 1, 1, 1, 'www.google.com', '/item_images/5ff825d363f7b.jpg', '/item_images/5ff825d37c49a.jpg', '/item_images/5ff825d3bc9d0.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 2, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Maxime maiores corrupti, enim culpa adipisci minima cumque nobis sint.', 'Korea branded T-shirts made of cotton', 'New', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 02:58:51', NULL, NULL),
(2, 'V-shaped Shirt', '1122', 2, 3, 1, 'www.qwerzv.com', '/item_images/5ff828aaccd6a.jpg', '/item_images/5ff828aae1ddc.jpg', '/item_images/5ff828ab1019a.jpg', '/item_images/5ff828ab3cb82.jpg', '/item_images/5ff828ab55d53.jpg', '/item_images/5ff828ab69592.jpg', '/item_images/5ff828ab8097a.jpg', '/item_images/5ff828ab94802.jpg', 1, 'Maxime maiores corrupti, enim culpa adipisci minima cumque nobis sint, ut rem similique reprehenderit illum laboriosam dolorum tempora ipsa beatae deleniti praesentium.', 'Korea made V-shaped shirt', 'Best Selling', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 03:10:58', '2021-01-11 04:29:47', NULL),
(3, 'Blouse', '1133', 3, 2, 2, 'www.fsugagrs.com', '/item_images/5ff82b1440590.jpg', '/item_images/5ff82b14557ee.jpg', '/item_images/5ff82b146e45d.jpg', '/item_images/5ff82b1481320.jpg', '/item_images/5ff82b149506f.jpg', '/item_images/5ff82b14a825f.jpg', '/item_images/5ff82b14bf136.jpg', '/item_images/5ff82b14d258f.jpg', 2, 'Maxime maiores corrupti, enim culpa adipisci minima cumque nobis sint, ut rem similique reprehenderit illum laboriosam dolorum tempora ipsa beatae deleniti praesentium.', 'Chinese branded Blouse', 'New', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 03:21:16', NULL, NULL),
(4, 'Armani Exchange', '210204', 20, 3, 1, 'www.armaniexchange.com', '/item_images/5ff843268dc70.jpg', '/item_images/5ff84326a8ab7.jpg', '/item_images/5ff84326bd201.jpg', '/item_images/5ff84326d22d2.jpg', '/item_images/5ff84326e5284.jpg', '/item_images/5ff8432706679.jpg', '/item_images/5ff843271a36c.jpg', '/item_images/5ff843273073b.jpg', 1, 'Maxime maiores corrupti, enim culpa adipisci minima cumque nobis sint, ut rem similique reprehenderit illum laboriosam dolorum tempora ipsa beatae deleniti praesentium.', 'Armani exchange Branded Ladies\' Perfumes', 'Discount', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 05:03:58', NULL, NULL),
(5, 'Baby-G', '318415', 41, 2, 2, 'www.baby-G.com', '/item_images/5ff845367dc35.jpg', '/item_images/5ff845369337d.jpg', '/item_images/5ff84536a70f4.jpg', '/item_images/5ff84536b8ff8.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 1, 'Lorem ipsum dolor sit amet elit obcaecati nobis commodi, ipsa dolorem, doloribus iste excepturi saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'Baby-G digital watch from China', 'Best Selling', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 05:12:46', NULL, NULL),
(6, 'Addidas', '317406', 40, 1, 2, 'www.addidas.com', '/item_images/5ff8465384e63.jpg', '/item_images/5ff84653ab83c.jpg', '/item_images/5ff84653ef636.jpg', '/item_images/5ff846540ec34.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 1, 'Lorem ipsum dolor sit amet  Illo molestiae vel, obcaecati nobis commodi, ipsa dolorem, doloribus saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'Year end sale from Adidas Myanmar', 'Discount', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 05:17:31', NULL, NULL),
(7, 'String Bag', '315357', 35, 3, 1, 'www.string_bag.com', '/item_images/5ff86a5db12af.png', '/item_images/5ff86a5dddcb7.png', '/item_images/5ff86a5df3a68.png', '/item_images/5ff86a5e16320.png', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 2, 'Lorem ipsum dolor sit amet  Illo molestiae vel, obcaecati nobis commodi, ipsa dolorem, doloribus saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'String bag', 'New', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 07:51:17', NULL, NULL),
(8, 'Face Masks', '28188', 18, 1, 1, 'www.facemasks.com', '/item_images/5ff86b43d61b6.jpg', '/item_images/5ff86b442fb85.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 2, 'Lorem ipsum dolor sit amet  Illo molestiae vel, obcaecati nobis commodi, ipsa dolorem, doloribus saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'Charcoal face masks for whitening and softening', 'New', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 07:55:07', NULL, NULL),
(9, 'Hoodie Jeans Jacket', '16499', 49, 2, 2, 'www.hoodiejj.com', '/item_images/5ff86db8a5ade.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 2, 'Lorem ipsum dolor sit amet  Illo molestiae vel, obcaecati nobis commodi, ipsa dolorem, doloribus saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'China Branded Hoodie Jeans Jacket', 'New', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-08 08:05:36', NULL, NULL),
(10, 'Leather Tuxedo', '131010', 10, 3, 1, 'www.leathertuxedo.com', '/item_images/5ff97cc3086f4.jpg', '/item_images/5ff97cc33dc69.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 1, 'Lorem ipsum dolor sit amet elit obcaecati nobis commodi, ipsa dolorem, doloribus iste excepturi saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'Brown colored Leather Tuxedo, made in Korea', 'Best Selling', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-09 03:22:03', NULL, NULL),
(11, 'Sai Lipstick', '292211', 22, 1, 2, 'www.sai_lipsticks.com', '/item_images/5ff97d8ad5462.jpg', '/item_images/5ff97d8aea48e.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 1, 'Lorem ipsum dolor sit amet elit obcaecati nobis commodi, ipsa dolorem, doloribus iste excepturi saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'Myanmar Sai brand lipsticks imported to China', 'Best Selling', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-09 03:25:22', NULL, NULL),
(12, 'Fancy Platinum Ring', '3194612', 46, 2, 2, 'www.rings.com', '/item_images/5ff97e74ac152.jpg', '/item_images/5ff97e74d0f82.jpg', '/item_images/5ff97e74e37af.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 1, 'Lorem ipsum dolor sit amet elit obcaecati nobis commodi, ipsa dolorem, doloribus iste excepturi saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'Fancy Platinum ring from China', 'Best Selling', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-09 03:29:16', NULL, NULL),
(13, 'Nike Sweat pants', '171413', 14, 3, 1, 'www.nike_sweat_pants.com', '/item_images/5ff9825f1127b.jpg', '/item_images/5ff9825f284e8.jpg', '/item_images/5ff9825f3da15.jpg', '/item_images/', '/item_images/', '/item_images/', '/item_images/', '/item_images/', 1, 'Lorem ipsum dolor sit amet elit obcaecati nobis commodi, ipsa dolorem, doloribus iste excepturi saepe est. Neque aliquid dolorem optio corrupti nulla dicta.', 'Nike branded sweatpants promotion from Korea Nike Branch', 'Discount', NULL, NULL, 1, NULL, 1, 1, NULL, '2021-01-09 03:45:59', '2021-01-14 02:12:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `items_specification`
--

CREATE TABLE `items_specification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` int(11) NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `items_specification`
--

INSERT INTO `items_specification` (`id`, `items_id`, `size`, `color`, `qty`, `price`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'S', '#0ca711', 10, 4, 1, 1, 1, NULL, '2021-01-08 03:05:11', NULL, NULL),
(2, 1, 'M', '#221fe0', 5, 4, 1, 1, 1, NULL, '2021-01-08 03:05:11', NULL, NULL),
(3, 1, 'L', '#e62828', 15, 4, 1, 1, 1, NULL, '2021-01-08 03:05:11', NULL, NULL),
(4, 2, 'S', '#93019d', 10, 6, 1, 1, 1, NULL, '2021-01-08 03:11:53', '2021-01-11 04:29:47', NULL),
(5, 2, 'M', '#000000', 15, 6, 1, 1, 1, NULL, '2021-01-08 03:11:53', '2021-01-11 04:29:47', NULL),
(6, 3, 'S', '#000000', 5, 8, 1, 1, 1, NULL, '2021-01-08 03:22:37', NULL, NULL),
(7, 3, 'M', '#000000', 5, 8, 1, 1, 1, NULL, '2021-01-08 03:22:37', NULL, NULL),
(8, 3, 'L', '#000000', 5, 8, 1, 1, 1, NULL, '2021-01-08 03:22:37', NULL, NULL),
(9, 4, '250 ML', '#d80e22', 5, 20, 1, 1, 1, NULL, '2021-01-08 05:04:56', NULL, NULL),
(10, 4, '500 ML', '#cf1717', 10, 35, 1, 1, 1, NULL, '2021-01-08 05:04:56', NULL, NULL),
(11, 5, '25 cm', '#c520b2', 20, 12, 1, 1, 1, NULL, '2021-01-08 05:14:30', NULL, NULL),
(12, 6, '38', '#c92f26', 5, 10, 1, 1, 1, NULL, '2021-01-08 05:19:36', NULL, NULL),
(13, 6, '38', '#000000', 10, 10, 1, 1, 1, NULL, '2021-01-08 05:19:36', NULL, NULL),
(14, 6, '39', '#000000', 5, 10, 1, 1, 1, NULL, '2021-01-08 05:19:36', NULL, NULL),
(15, 6, '39', '#2f0fd2', 10, 10, 1, 1, 1, NULL, '2021-01-08 05:19:36', NULL, NULL),
(16, 6, '40', '#f2f2f2', 15, 10, 1, 1, 1, NULL, '2021-01-08 05:19:36', NULL, NULL),
(17, 7, 'M', '#f2f2f2', 5, 12, 1, 1, 1, NULL, '2021-01-08 07:52:30', NULL, NULL),
(18, 7, 'M', '#000000', 5, 10, 1, 1, 1, NULL, '2021-01-08 07:52:30', NULL, NULL),
(19, 8, 'S', '#000000', 10, 3, 1, 1, 1, NULL, '2021-01-08 07:55:58', NULL, NULL),
(20, 8, 'M', '#000000', 10, 3, 1, 1, 1, NULL, '2021-01-08 07:55:58', NULL, NULL),
(21, 8, 'L', '#000000', 10, 4, 1, 1, 1, NULL, '2021-01-08 07:55:58', NULL, NULL),
(22, 9, 'M', '#0107bc', 5, 15, 1, 1, 1, NULL, '2021-01-08 08:07:12', NULL, NULL),
(23, 9, 'L', '#0107bc', 5, 20, 1, 1, 1, NULL, '2021-01-08 08:07:12', NULL, NULL),
(24, 10, 'M', '#8d4502', 5, 40, 1, 1, 1, NULL, '2021-01-09 03:23:21', NULL, NULL),
(25, 10, 'L', '#8d4502', 5, 50, 1, 1, 1, NULL, '2021-01-09 03:23:21', NULL, NULL),
(26, 11, '350 ML', '#c80e0e', 10, 21, 1, 1, 1, NULL, '2021-01-09 03:26:50', NULL, NULL),
(27, 11, '350 ML', '#ff47f0', 10, 21, 1, 1, 1, NULL, '2021-01-09 03:26:50', NULL, NULL),
(28, 11, '350 ML', '#d13400', 10, 21, 1, 1, 1, NULL, '2021-01-09 03:26:50', NULL, NULL),
(29, 11, '350 ML', '#6326c0', 10, 21, 1, 1, 1, NULL, '2021-01-09 03:26:50', NULL, NULL),
(30, 12, 'M', '#9c9c9c', 20, 12, 1, 1, 1, NULL, '2021-01-09 03:29:43', NULL, NULL),
(31, 13, 'M', '#000000', 10, 25, 1, 1, 1, NULL, '2021-01-09 03:47:08', '2021-01-14 02:12:31', NULL),
(32, 13, 'M', '#5e5e5e', 10, 25, 1, 1, 1, NULL, '2021-01-09 03:47:08', '2021-01-14 02:12:31', NULL),
(33, 6, '40', '#f5a8ab', 0, 10, 1, 1, 1, NULL, '2021-01-18 03:10:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `items_id` int(11) NOT NULL,
  `items_specification_id` int(11) NOT NULL,
  `old_size` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_color` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `old_qty` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `old_price` int(11) DEFAULT NULL,
  `price` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 0,
  `updated_by` int(11) NOT NULL DEFAULT 0,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `items_id`, `items_specification_id`, `old_size`, `size`, `old_color`, `color`, `old_qty`, `qty`, `old_price`, `price`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 31, 'M', 'M', '#000000', '#000000', 10, 10, 25000, 25000, 1, 0, 1, NULL, NULL, '2021-01-14 02:12:31', NULL),
(2, 13, 32, 'M', 'M', '#5e5e5e', '#5e5e5e', 10, 10, 25000, 25000, 1, 0, 1, NULL, NULL, '2021-01-14 02:12:31', NULL),
(3, 6, 33, NULL, '40', NULL, '#f5a8ab', NULL, 20, NULL, 10, 1, 1, 0, NULL, '2021-01-18 03:10:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_categories`
--

CREATE TABLE `main_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `main_categories`
--

INSERT INTO `main_categories` (`id`, `name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Clothings', 1, 1, 1, NULL, '2021-01-07 23:15:52', NULL, NULL),
(2, 'Cosmetics', 1, 1, 1, NULL, '2021-01-07 23:16:06', NULL, NULL),
(3, 'Accessories', 1, 1, 1, NULL, '2021-01-07 23:16:16', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(68, '2020_12_27_103112_create_log_table', 2),
(66, '2014_10_12_000000_create_users_table', 2),
(63, '2020_12_17_043943_create_items_specification_table', 1),
(64, '2020_12_17_084710_create_items_table', 1),
(62, '2020_12_16_105811_create_sub_categories_table', 1),
(61, '2020_12_16_105756_create_main_categories_table', 1),
(59, '2020_12_12_135000_create_cities_table', 1),
(60, '2020_12_12_135009_create_townships_table', 1),
(67, '2014_10_12_100000_create_password_resets_table', 2),
(52, '2018_10_20_040609_create_categories_table', 1),
(53, '2018_11_26_070031_create_cart_table', 1),
(54, '2018_11_28_072535_create_coupons_table', 1),
(55, '2018_12_01_042342_create_countries_table', 1),
(56, '2018_12_03_093548_create_delivery_address_table', 1),
(79, '2021_01_17_060705_create_orders_table', 4),
(58, '2020_12_12_082940_create_brands_table', 1),
(78, '2021_01_15_093028_create_favorites_table', 3),
(80, '2021_01_17_060713_create_orders_detail_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `order_date` date NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `township_id` int(11) NOT NULL,
  `delivery_address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_qty` int(11) NOT NULL,
  `sub_total` int(11) NOT NULL DEFAULT 0,
  `discount` int(11) DEFAULT NULL,
  `discount_amt` int(11) DEFAULT NULL,
  `total_amt` int(11) NOT NULL,
  `payment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `payment_status` int(11) NOT NULL DEFAULT 0,
  `preorder_status` int(11) NOT NULL DEFAULT 0,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_detail`
--

CREATE TABLE `orders_detail` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `specification_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_amt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `main_category_discount` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_categories_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `main_categories_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Tops', 1, 1, 1, 1, NULL, '2021-01-07 23:17:22', NULL, NULL),
(2, 'Outerwears', 1, 1, 1, 1, NULL, '2021-01-07 23:18:29', '2021-01-07 23:18:38', NULL),
(3, 'Coats', 1, 1, 1, 1, NULL, '2021-01-07 23:18:51', NULL, NULL),
(4, 'Dresses', 1, 1, 1, 1, NULL, '2021-01-07 23:19:01', NULL, NULL),
(5, 'Skirts', 1, 1, 1, 1, NULL, '2021-01-07 23:19:28', NULL, NULL),
(6, 'Jackets', 1, 1, 1, 1, NULL, '2021-01-07 23:19:48', NULL, NULL),
(7, 'Trousers & shorts', 1, 1, 1, 1, NULL, '2021-01-07 23:20:01', '2021-01-07 23:20:17', NULL),
(8, 'Face Treatments', 2, 1, 1, 1, NULL, '2021-01-07 23:21:05', '2021-01-07 23:23:06', NULL),
(9, 'Makeup', 2, 1, 1, 1, NULL, '2021-01-07 23:21:26', '2021-01-07 23:22:49', NULL),
(10, 'Fragrance', 2, 1, 1, 1, NULL, '2021-01-07 23:22:17', NULL, NULL),
(11, 'Manicuring', 2, 1, 1, 1, NULL, '2021-01-07 23:23:20', NULL, NULL),
(12, 'Oral Hygiene', 2, 1, 1, 1, NULL, '2021-01-07 23:23:36', NULL, NULL),
(13, 'Personal Clealines', 2, 1, 1, 1, NULL, '2021-01-07 23:24:17', NULL, NULL),
(14, 'Nails', 2, 0, 1, 1, NULL, '2021-01-07 23:24:36', '2021-01-07 23:44:56', NULL),
(15, 'Bags', 3, 1, 1, 1, NULL, '2021-01-07 23:25:16', NULL, NULL),
(16, 'Headwears', 3, 1, 1, 1, NULL, '2021-01-07 23:25:29', NULL, NULL),
(17, 'Footwears', 3, 1, 1, 1, NULL, '2021-01-07 23:25:37', NULL, NULL),
(18, 'Watches', 3, 1, 1, 1, NULL, '2021-01-07 23:26:38', NULL, NULL),
(19, 'Jewellery', 3, 1, 1, 1, NULL, '2021-01-07 23:27:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `townships`
--

CREATE TABLE `townships` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `townships`
--

INSERT INTO `townships` (`id`, `name`, `city_id`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Myitkyina', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(2, 'Bhamo (Bamaw)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(3, 'Bharma', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(4, 'Chipwi (Chibwe)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(5, 'Hpakant (Hpakan, Farkent)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(6, 'Hopin (Hobik)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(7, 'Hsinbo (Sinbo)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(8, 'Hsawlaw (Sawlaw)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(9, 'Injangyang', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(10, 'Kamaing (Kamine)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(11, 'Kawnglanghpu (Kaunglanfu)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(12, 'Lweje (Loije, Lwalgyai)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(13, 'Machanbaw', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(14, 'Mansi', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(15, 'Momauk', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(16, 'Moekaung', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(17, 'Mohnyin', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(18, 'Nogmung (Naungmoon)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(19, 'Pannandin', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(20, 'Putao', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(21, 'Shwegu', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(22, 'Sumprabum', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(23, 'Tanai (Tanain)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(24, 'Tsawlaw (Sawlaw)', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(25, 'Waingmaw', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(26, 'Ywathit', 4, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(27, 'Loikaw', 5, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(28, 'Demawso', 5, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(29, 'Pruhso', 5, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(30, 'Shadaw', 5, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(31, 'Bawlakhe', 5, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(32, 'Hpasawng', 5, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(33, 'Maisal', 5, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(34, 'Hpa-an', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(35, 'Hlaingbwe (Hlinebwe)', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(36, 'Papun (Phapun)', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(37, 'Thandang', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(38, 'Thandanggyi (Thantaunggyi)', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(39, 'Myawaddy (Myawadi)', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(40, 'Kawkareik (Kawkareit)', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(41, 'Kyeikdon', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(42, 'Kyain Seikgyi (Kyainseikkyi)', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(43, 'Payathonsu (Hpayarthonesu)', 6, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(44, 'Tedim', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(45, 'Tonzang', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(46, 'Falam (Phalam)', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(47, 'Hakha (Haka, Harkhar)', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(48, 'Thantlang (Htantlang)', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(49, 'Kanpetlet (Kanpatlat)', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(50, 'Matupi (Matupe)', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(51, 'Mindat (Minthet)', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(52, 'Paletwa', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(53, 'Cikha', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(54, 'Rih Khawdar', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(55, 'Razua (Yay Zwar)', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(56, 'Sami (Samee)', 3, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(57, 'Mawlamyaing(Moulmein)', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(58, 'Bilin', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(59, 'Kyaikmaraw', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(60, 'Chaungzon', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(61, 'Thanbyuzayat', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(62, 'Kyaikkami', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(63, 'Mudon', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(64, 'Ye', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(65, 'Thaton', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(66, 'Paung', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(67, 'Kyaikto', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(68, 'Mottama', 9, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(69, 'Sittwe', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(70, 'Ann', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(71, 'Buthidaung', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(72, 'Dalet (Dalat)', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(73, 'Gwa', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(74, 'Kyaukpyu', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(75, 'Kyauktaw', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(76, 'Kyeintali', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(77, 'Manaung', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(78, 'Maungdaw', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(79, 'Minbya', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(80, 'Mrauk U', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(81, 'Myebon', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(82, 'Ngapali', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(83, 'Pauktaw', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(84, 'Ponnagyun', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(85, 'Ramree', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(86, 'Rathedaung', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(87, 'Thandwe', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(88, 'Toungup', 10, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(89, 'Toungup', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(90, 'Aungban', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(91, 'Toungup', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(92, 'Ayetharyar', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(93, 'Chinshwehaw', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(94, 'Ho-pin', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(95, 'Hopang', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(96, 'Hopong', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(97, 'Hseni', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(98, 'Hsi Hseng', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(99, 'Hsipaw', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(100, 'Kalaw', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(101, 'Kengtong', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(102, 'Kunhing', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(103, 'Kunlong', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(104, 'Kutkai', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(105, 'Kyaukme', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(106, 'Kyethi', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(107, 'Lai-Hka', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(108, 'Langkho', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(109, 'Lashio', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(110, 'Lawksawk', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(111, 'Loilen', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(112, 'Laukkaing', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(113, 'Mabein', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(114, 'Mantong', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(115, 'Mawkmai', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(116, 'Mine Hsu', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(117, 'Mine Khet', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(118, 'Mine Kung', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(119, 'Mine Nai', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(120, 'Mine Pan', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(121, 'Mine Ping', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(122, 'Mine Tong', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(123, 'Mine Yang', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(124, 'Mine Yawng', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(125, 'Mine Hsat', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(126, 'Mineko', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(127, 'Minemit', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(128, 'Mineyai', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(129, 'Mu Se', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(130, 'Namhsan', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(131, 'Namtu', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(132, 'Nanhkan', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(133, 'Nansang', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(134, 'Nawnghkio', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(135, 'Nyaungshwe', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(136, 'Pang Long', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(137, 'Pekon', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(138, 'Pindaya', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(139, 'Pinlaung', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(140, 'Tant Yan', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(141, 'Taunggyi', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(142, 'Techilelk', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(143, 'Ywangan', 12, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(144, 'Ayadaw', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(145, 'Banmauk', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(146, 'Budalin', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(147, 'Chaung', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(148, 'Dabayin', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(149, 'Hkamti', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(150, 'Homalin', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(151, 'Htigyaing', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(152, 'Indaw', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(153, 'Kalaymyo', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(154, 'Kalewa', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(155, 'Kanbalu', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(156, 'Kani', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(157, 'Katha', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(158, 'Kawlin', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(159, 'Khin U', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(160, 'Kyadet', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(161, 'Kyunhla', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(162, 'Mawlaik', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(163, 'Mingun', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(164, 'Monywa', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(165, 'Myaung', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(166, 'Myinmu', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(167, 'Pale', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(168, 'Paungbyin', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(169, 'Pinlebu', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(170, 'Sagaing', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(171, 'Salingyi', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(172, 'Shwebo', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(173, 'Tamu', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(174, 'Tantsal', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(175, 'Wetlet', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(176, 'Wuntho', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(177, 'Ye-U', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(178, 'Yinmabin', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(179, 'Mungnii', 11, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(180, 'Dawei', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(181, 'Launglon', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(182, 'Thayetchaung', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(183, 'Yebyu', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(184, 'Myeik', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(185, 'Kyunsu', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(186, 'Palaw', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(187, 'Taninthayi', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(188, 'Kawthoung', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(189, 'Bokpyin', 13, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(190, 'Bago', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(191, 'Thanatpin', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(192, 'Kawa', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(193, 'Waw', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(194, 'Nyaunglebin', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(195, 'Madauk', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(196, 'Pyuntaza', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(197, 'Kyauktaga', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(198, 'Pennwegone', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(199, 'Daik-U', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(200, 'Shwegyin', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(201, 'Taungoo', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(202, 'Kututmatyi', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(203, 'Yaytarshay', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(204, 'Kyaukkyi', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(205, 'Phyu', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(206, 'Oktwin', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(207, 'Htantabin', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(208, 'Pyay', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(209, 'Paukkhaung', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(210, 'Padaung', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(211, 'Paungde', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(212, 'Thegon', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(213, 'Shwedaung', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(214, 'Thayarwaddy', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(215, 'Thonze', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(216, 'Letpadan', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(217, 'Minhla', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(218, 'Okpo', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(219, 'Zigon', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(220, 'Nattalin', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(221, 'Monyo', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(222, 'Gyobingauk', 2, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(223, 'Magwe', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(224, 'Allanmyo (Aunglan, Myaydo)', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(225, 'Chauck', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(226, 'Gangaw', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(227, 'Kamma', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(228, 'Minbu', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(229, 'Mindon', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(230, 'Minhla', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(231, 'Myaing', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(232, 'Myothit', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(233, 'Natmauk', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(234, 'Ngape', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(235, 'Pakokku', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(236, 'Pauk', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(237, 'Pwintbyu', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(238, 'Sagu', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(239, 'Salin', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(240, 'Swar', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(241, 'Seikphyu', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(242, 'Sidoktaya', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(243, 'Sinbyugyun', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(244, 'Taungdwingyi', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(245, 'Thayet', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(246, 'Tilin', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(247, 'Yenangyaung', 7, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(248, ' Ahlon', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(249, ' Bahan', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(250, 'Botataung', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(251, 'Cocokyun', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(252, 'Dagon', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(253, 'Dagon Myothit(East)', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(254, 'Dagon Myothit(North)', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(255, 'Dagon Myothit(Seikkan)', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(256, 'Dagon Myothit(South)', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(257, 'Dala', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(258, 'Dawbon', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(259, 'Hlaing', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(260, 'Hlaingtharya', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(261, 'Hlegu', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(262, 'Hmawbi', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(263, 'Htantabin', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(264, 'Insein', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(265, 'Kamaryut', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(266, 'Kayan', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(267, 'Kawhmu', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(268, 'Kungyangon', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(269, 'Kyauktada', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(270, 'Kyauktan', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(271, 'Kyeemyindaing', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(272, 'Lanmadaw', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(273, 'Latha', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(274, 'Mayangone', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(275, 'Mingaladon', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(276, 'Mingalartaungnyunt', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(277, 'North Okkalapa', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(278, 'Pabedan', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(279, 'Pazundaung', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(280, 'Sanchaung', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(281, 'Seikgyikanaungto', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(282, 'Seikkan', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(283, 'Shwepyithar', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(284, 'South Okkalapa', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(285, 'Taikkyi', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(286, 'Tamwe', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(287, 'Thaketa', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(288, 'Thanlyin', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(289, 'Thingangkuun', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(290, 'Thongwa', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(291, 'Twantay', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(292, 'Yankin', 14, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(293, 'Pathein', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(294, 'Kangyidaut', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(295, 'Thabaung', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(296, 'Ngapudaw', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(297, 'Haigyi Island', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(298, 'Kyonpyaw', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(299, 'Yekyi', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(300, 'Kyaunggon', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(301, 'Hinthada', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(302, 'Zalun', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(303, 'Lemyethna', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(304, 'Myan Aung', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(305, 'Kanaung', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(306, 'Kyangin', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(307, 'Ingapu', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(308, 'Myaungmya', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(309, 'Einme', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(310, 'Letputta', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(311, 'Wakema', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(312, 'Mawlamyinegyun', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(313, 'Maubin', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(314, 'Pantanaw', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(315, 'Nyaungdon', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(316, 'Danubyu', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(317, 'Pyapon', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(318, 'Bogale', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(319, 'Kyaiklat', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(320, 'Dedaye', 1, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(321, 'Amarapura', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(322, 'Aungmyaythazan', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(323, 'Chanayethazan', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(324, 'Chanmyathazi', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(325, 'Kyaukpadaung', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(326, 'Kyaukse', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(327, 'Lewe', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(328, 'Madaya', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(329, 'Mahaaungmyay', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(330, 'Mahlaing', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(331, 'Meiktila', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(332, 'Mogoke', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(333, 'Myingyan', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(334, 'Myittha', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(335, 'Natogyi', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(336, 'Ngazun', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(337, 'Nyaung-U', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(338, 'Patheingyi', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(339, 'Pyawbwe', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(340, 'Pyigyitagon', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(341, 'Pyinmana', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(342, 'Pyinoolwin', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(343, 'Singu', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(344, 'Sintgaing', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(345, 'Sintgaing', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(346, 'Tada-U', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(347, 'Tatkon', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(348, 'Taungtha', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(349, 'Thabeikkyin', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(350, 'Thazi', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(351, 'Wundwin', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(352, 'Yamethin', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(353, 'Pyinmana', 15, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(354, 'Tatkon', 15, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(355, 'Lewe', 15, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(356, 'Ottarathiri', 15, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(357, 'Dekkhinathiri', 15, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(358, 'Pobbathiri', 15, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(359, 'Zabuthiri', 15, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(360, 'Zeyathiri', 15, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(361, 'Bagan', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(362, 'Old Bagan', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL),
(363, 'New Bagan', 8, 1, 1, 1, NULL, '2021-01-14 01:55:17', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `township_id` int(11) DEFAULT NULL,
  `image` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(4) DEFAULT NULL,
  `role_id` int(11) NOT NULL DEFAULT 4,
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `country_id`, `city_id`, `township_id`, `image`, `admin`, `role_id`, `created_by`, `updated_by`, `deleted_by`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'SUPER', 'ADMIN', 'superadmin@gmail.com', NULL, '$2y$10$g2qQ1E9uVLofv7/wWb2QLujGJz4FZWLLpRFxVWCPjDDWB.Q9i7Nzi', '09250676233', 'home', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, 'xAhLPkaMR48XMnLwEszckGGnc5Y2ryPFv7JIHB2WFQE3B42WANFSChGiWZmY', NULL, NULL, NULL),
(2, 'PF', 'Administrator', 'administrator@gmail.com', NULL, '$2y$10$KDarx27N4/WgKdW5TOspmOXdpxFQe8OJaeDPq1V0XSsXodrWBgB02', '09250676233', 'home', NULL, NULL, NULL, NULL, NULL, 2, NULL, NULL, NULL, 'eFdJJkUjxOZifQn8pABSCEJoJkHLNiuKqFyf8SWZtisK2Nh35KtqnGJhFJ6u', NULL, NULL, NULL),
(3, 'PF', 'Admin', 'admin@gmail.com', NULL, '$2y$10$KDarx27N4/WgKdW5TOspmOXdpxFQe8OJaeDPq1V0XSsXodrWBgB02', '09250676233', 'home', NULL, NULL, NULL, NULL, NULL, 3, NULL, NULL, NULL, 'UGcONfdGCGqzvNXBegiWkXvjcrvDNxCPSvK0RSFax79XyAJeYFMaJqS8p7y4', NULL, NULL, NULL),
(4, 'PF', 'User', 'user@gmail.com', NULL, '$2y$10$KDarx27N4/WgKdW5TOspmOXdpxFQe8OJaeDPq1V0XSsXodrWBgB02', '09250676233', 'home', NULL, NULL, NULL, NULL, NULL, 4, NULL, NULL, NULL, 'CA0EbDSTvTRO6lEkiZQMO47i5NQYMNWUuhCh9nXeuEj2xZPhqUJke7t7Wxzt', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `brands_name_unique` (`name`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_name_unique` (`name`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cities_name_unique` (`name`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `countries_name_unique` (`name`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `delivery_address`
--
ALTER TABLE `delivery_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`users_id`,`items_id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `items_url_unique` (`url`);

--
-- Indexes for table `items_specification`
--
ALTER TABLE `items_specification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `main_categories`
--
ALTER TABLE `main_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `main_categories_name_unique` (`name`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_detail`
--
ALTER TABLE `orders_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sub_categories_name_unique` (`name`);

--
-- Indexes for table `townships`
--
ALTER TABLE `townships`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `delivery_address`
--
ALTER TABLE `delivery_address`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `items_specification`
--
ALTER TABLE `items_specification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `main_categories`
--
ALTER TABLE `main_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_detail`
--
ALTER TABLE `orders_detail`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `townships`
--
ALTER TABLE `townships`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=364;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
