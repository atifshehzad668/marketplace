-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2024 at 02:08 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `market_place`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('spatie.permission.cache', 'a:3:{s:5:\"alias\";a:3:{s:1:\"a\";s:2:\"id\";s:1:\"b\";s:4:\"name\";s:1:\"c\";s:10:\"guard_name\";}s:11:\"permissions\";a:29:{i:0;a:3:{s:1:\"a\";i:1;s:1:\"b\";s:9:\"role-list\";s:1:\"c\";s:3:\"web\";}i:1;a:3:{s:1:\"a\";i:2;s:1:\"b\";s:11:\"role-create\";s:1:\"c\";s:3:\"web\";}i:2;a:3:{s:1:\"a\";i:3;s:1:\"b\";s:9:\"role-edit\";s:1:\"c\";s:3:\"web\";}i:3;a:3:{s:1:\"a\";i:4;s:1:\"b\";s:11:\"role-delete\";s:1:\"c\";s:3:\"web\";}i:4;a:3:{s:1:\"a\";i:5;s:1:\"b\";s:15:\"permission-list\";s:1:\"c\";s:3:\"web\";}i:5;a:3:{s:1:\"a\";i:6;s:1:\"b\";s:15:\"permission-show\";s:1:\"c\";s:3:\"web\";}i:6;a:3:{s:1:\"a\";i:7;s:1:\"b\";s:17:\"permission-create\";s:1:\"c\";s:3:\"web\";}i:7;a:3:{s:1:\"a\";i:8;s:1:\"b\";s:15:\"permission-edit\";s:1:\"c\";s:3:\"web\";}i:8;a:3:{s:1:\"a\";i:9;s:1:\"b\";s:17:\"permission-delete\";s:1:\"c\";s:3:\"web\";}i:9;a:3:{s:1:\"a\";i:10;s:1:\"b\";s:17:\"permission-update\";s:1:\"c\";s:3:\"web\";}i:10;a:3:{s:1:\"a\";i:11;s:1:\"b\";s:13:\"category-list\";s:1:\"c\";s:3:\"web\";}i:11;a:3:{s:1:\"a\";i:12;s:1:\"b\";s:15:\"category-create\";s:1:\"c\";s:3:\"web\";}i:12;a:3:{s:1:\"a\";i:13;s:1:\"b\";s:13:\"category-edit\";s:1:\"c\";s:3:\"web\";}i:13;a:3:{s:1:\"a\";i:14;s:1:\"b\";s:15:\"category-delete\";s:1:\"c\";s:3:\"web\";}i:14;a:3:{s:1:\"a\";i:15;s:1:\"b\";s:12:\"listing-list\";s:1:\"c\";s:3:\"web\";}i:15;a:3:{s:1:\"a\";i:16;s:1:\"b\";s:14:\"listing-create\";s:1:\"c\";s:3:\"web\";}i:16;a:3:{s:1:\"a\";i:17;s:1:\"b\";s:12:\"listing-edit\";s:1:\"c\";s:3:\"web\";}i:17;a:3:{s:1:\"a\";i:18;s:1:\"b\";s:14:\"listing-delete\";s:1:\"c\";s:3:\"web\";}i:18;a:3:{s:1:\"a\";i:19;s:1:\"b\";s:10:\"order-list\";s:1:\"c\";s:3:\"web\";}i:19;a:3:{s:1:\"a\";i:20;s:1:\"b\";s:12:\"order-create\";s:1:\"c\";s:3:\"web\";}i:20;a:3:{s:1:\"a\";i:21;s:1:\"b\";s:10:\"order-edit\";s:1:\"c\";s:3:\"web\";}i:21;a:3:{s:1:\"a\";i:22;s:1:\"b\";s:12:\"order-delete\";s:1:\"c\";s:3:\"web\";}i:22;a:3:{s:1:\"a\";i:23;s:1:\"b\";s:9:\"user-list\";s:1:\"c\";s:3:\"web\";}i:23;a:3:{s:1:\"a\";i:24;s:1:\"b\";s:11:\"user-create\";s:1:\"c\";s:3:\"web\";}i:24;a:3:{s:1:\"a\";i:25;s:1:\"b\";s:9:\"user-edit\";s:1:\"c\";s:3:\"web\";}i:25;a:3:{s:1:\"a\";i:26;s:1:\"b\";s:11:\"user-delete\";s:1:\"c\";s:3:\"web\";}i:26;a:3:{s:1:\"a\";i:27;s:1:\"b\";s:20:\"purchase-order-index\";s:1:\"c\";s:3:\"web\";}i:27;a:3:{s:1:\"a\";i:28;s:1:\"b\";s:12:\"admin-wallet\";s:1:\"c\";s:3:\"web\";}i:28;a:3:{s:1:\"a\";i:29;s:1:\"b\";s:12:\"admin-orders\";s:1:\"c\";s:3:\"web\";}}s:5:\"roles\";a:0:{}}', 1731410207);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories_parent_id_foreign` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'shirts', NULL, '2024-11-11 06:20:04', '2024-11-11 06:20:04');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city_name`, `created_at`, `updated_at`) VALUES
(1, 'Lahore', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(2, 'Karachi', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(3, 'Islamabad', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(4, 'Faisalabad', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(5, 'Rawalpindi', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(6, 'Multan', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(7, 'Gujranwala', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(8, 'Sialkot', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(9, 'Bahawalpur', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(10, 'Peshawar', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(11, 'Hyderabad', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(12, 'Quetta', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(13, 'Abbottabad', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(14, 'Mardan', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(15, 'Sukkur', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(16, 'Larkana', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(17, 'Mirpurkhas', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(18, 'Gwadar', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(19, 'Swat', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(20, 'Dera Ismail Khan', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(21, 'Nawabshah', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(22, 'Nowshera', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(23, 'Jhang', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(24, 'Sargodha', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(25, 'Khuzdar', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(26, 'Kasur', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(27, 'Sheikhupura', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(28, 'Okara', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(29, 'Rahim Yar Khan', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(30, 'Chiniot', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(31, 'Attock', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(32, 'Kamoke', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(33, 'Batagram', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(34, 'Hangu', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(35, 'Kohat', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(36, 'Dera Ghazi Khan', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(37, 'Tando Allahyar', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(38, 'Tando Adam', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(39, 'Jacobabad', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(40, 'Sahiwal', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(41, 'Muzaffarabad', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(42, 'Mirpur (AJK)', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(43, 'Kotli (AJK)', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(44, 'Skardu', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(45, 'Hunza', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(46, 'Ghotki', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(47, 'Dadu', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(48, 'Mandi Bahauddin', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(49, 'Mianwali', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(50, 'Gujrat', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(51, 'Jhelum', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(52, 'Khanewal', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(53, 'Hafizabad', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(54, 'Bhakkar', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(55, 'Narowal', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(56, 'Khanpur', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(57, 'Chakwal', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(58, 'Chaman', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(59, 'Zhob', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(60, 'Kalat', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(61, 'Sibi', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(62, 'Naseerabad', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(63, 'Loralai', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(64, 'Kharan', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(65, 'Qila Abdullah', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(66, 'Ziarat', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(67, 'Dera Bugti', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(68, 'Lasbela', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(69, 'Pishin', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(70, 'Dera Murad Jamali', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(71, 'Panjgur', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(72, 'Gilgit', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(73, 'Gupis', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(74, 'Astore', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(75, 'Chitral', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(76, 'Dir', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(77, 'Mansehra', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(78, 'Battagram', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(79, 'Bannu', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(80, 'Tank', '2024-11-11 06:16:20', '2024-11-11 06:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

DROP TABLE IF EXISTS `listings`;
CREATE TABLE IF NOT EXISTS `listings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `region_id` bigint UNSIGNED NOT NULL,
  `headline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(8,2) NOT NULL,
  `expiration_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listings_user_id_foreign` (`user_id`),
  KEY `listings_category_id_foreign` (`category_id`),
  KEY `listings_city_id_foreign` (`city_id`),
  KEY `listings_region_id_foreign` (`region_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`id`, `user_id`, `category_id`, `city_id`, `region_id`, `headline`, `description`, `quantity`, `price`, `expiration_date`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 2, 7, 'test 1', 'some information', 0, '100.00', '2024-11-30', '2024-11-11 06:20:32', '2024-11-11 06:26:29'),
(2, 2, 1, 2, 7, 'test 2', 'asdfa', 1, '200.00', '2024-11-30', '2024-11-11 08:15:46', '2024-11-11 08:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `listing_bump_schedules`
--

DROP TABLE IF EXISTS `listing_bump_schedules`;
CREATE TABLE IF NOT EXISTS `listing_bump_schedules` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `listing_id` bigint UNSIGNED NOT NULL,
  `last_dump` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_bump_schedules_listing_id_foreign` (`listing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `listing_images`
--

DROP TABLE IF EXISTS `listing_images`;
CREATE TABLE IF NOT EXISTS `listing_images` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `listing_id` bigint UNSIGNED NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_main` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `listing_images_listing_id_foreign` (`listing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `listing_images`
--

INSERT INTO `listing_images` (`id`, `listing_id`, `image_url`, `is_main`, `created_at`, `updated_at`) VALUES
(1, 1, 'uploads/listings_image/1731324032_jawad1.jpg', 1, '2024-11-11 06:20:32', '2024-11-11 06:20:32'),
(2, 2, 'uploads/listings_image/1731330946_logo3.jpg', 1, '2024-11-11 08:15:46', '2024-11-11 08:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  `uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `collection_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `disk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conversions_disk` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `size` bigint UNSIGNED NOT NULL,
  `manipulations` json NOT NULL,
  `custom_properties` json NOT NULL,
  `generated_conversions` json NOT NULL,
  `responsive_images` json NOT NULL,
  `order_column` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `media_uuid_unique` (`uuid`),
  KEY `media_model_type_model_id_index` (`model_type`,`model_id`),
  KEY `media_order_column_index` (`order_column`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000001_create_cache_table', 1),
(2, '0001_01_01_000002_create_jobs_table', 1),
(3, '0001_10_01_000001_create_users_table', 1),
(4, '0001_10_01_052759_create_transactions_table', 1),
(5, '0001_10_01_073941_create_categories_table', 1),
(6, '0001_10_01_080926_create_wanted_items_table', 1),
(7, '0001_10_01_105243_create_point_trades_table', 1),
(8, '0001_10_01_120129_create_cities_table', 1),
(9, '0001_10_01_120915_create_regions_table', 1),
(10, '0001_10_01_120916_create_listings_table', 1),
(11, '0001_10_01_120917_create_listing_bump_schedules_table', 1),
(12, '0001_10_01_127918_create_listing_images_table', 1),
(13, '0001_10_01_127919_create_orders_table', 1),
(14, '0001_10_01_127920_create_point_transactions_table', 1),
(15, '0001_10_01_142169_create_sub_categories_table', 1),
(16, '0001_10_01_152921_create_points_table', 1),
(17, '2024_10_23_121737_create_practices_table', 1),
(18, '2024_10_24_083255_create_permission_tables', 1),
(19, '2024_10_24_115254_create_articles_table', 1),
(20, '2024_10_28_092416_create_media_table', 1),
(21, '2024_11_05_115722_create_wallets_table', 1),
(22, '2024_11_05_120213_create_wallet_transactions_table', 1),
(23, '2024_11_06_115410_create_payments_table', 1),
(24, '2024_11_06_120808_add_order_id_after_gateway_response_to_payments_table', 1),
(25, '2024_11_06_120938_add_order_id_after_wallet_id_to_wallet_transactions_table', 1),
(26, '2024_11_06_152640_add_seller_status_and_buyer_status_to_orders_table', 1),
(27, '2024_11_07_103117_update_status_in_orders_table', 1),
(28, '2024_11_07_125506_add_contact_to_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `listing_id` bigint UNSIGNED NOT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `buyer_id` bigint UNSIGNED NOT NULL,
  `status` enum('Pending','Paid','Delivered','Shipping') COLLATE utf8mb4_unicode_ci NOT NULL,
  `seller_status` enum('Pending','Shipping','Delivered') COLLATE utf8mb4_unicode_ci NOT NULL,
  `buyer_status` enum('Pending','Paid','Received') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_listing_id_foreign` (`listing_id`),
  KEY `orders_seller_id_foreign` (`seller_id`),
  KEY `orders_buyer_id_foreign` (`buyer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `listing_id`, `seller_id`, `buyer_id`, `status`, `seller_status`, `buyer_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 3, 'Delivered', 'Delivered', 'Received', '2024-11-11 06:26:29', '2024-11-11 06:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `trx_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `payment_method` enum('credit_card','paypal','stripe','other') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','successful','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `gateway_response` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payments_order_id_foreign` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `trx_id`, `amount`, `payment_method`, `status`, `gateway_response`, `order_id`, `created_at`, `updated_at`) VALUES
(1, '7RT373749R8592628', '100.00', 'paypal', 'successful', '{\"transaction_for_listing\":\"test 1\",\"payer\":{\"name\":\"John Doe\",\"email\":\"sb-a8sj030805609@personal.example.com\"},\"receiver\":{\"name\":\"sir kosar\",\"role\":\"Listing owner\"},\"amount\":\"100.00 USD\",\"net_amount_after_fees\":\"96.02 USD\"}', 1, '2024-11-11 06:26:51', '2024-11-11 06:26:51');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'role-list', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(2, 'role-create', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(3, 'role-edit', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(4, 'role-delete', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(5, 'permission-list', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(6, 'permission-show', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(7, 'permission-create', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(8, 'permission-edit', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(9, 'permission-delete', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(10, 'permission-update', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(11, 'category-list', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(12, 'category-create', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(13, 'category-edit', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(14, 'category-delete', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(15, 'listing-list', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(16, 'listing-create', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(17, 'listing-edit', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(18, 'listing-delete', 'web', '2024-11-11 06:16:19', '2024-11-11 06:16:19'),
(19, 'order-list', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(20, 'order-create', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(21, 'order-edit', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(22, 'order-delete', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(23, 'user-list', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(24, 'user-create', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(25, 'user-edit', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(26, 'user-delete', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(27, 'purchase-order-index', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(28, 'admin-wallet', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(29, 'admin-orders', 'web', '2024-11-11 06:16:20', '2024-11-11 06:16:20');

-- --------------------------------------------------------

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
CREATE TABLE IF NOT EXISTS `points` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `type` enum('bonus','penalty','transfer','trade') COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_user_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `points_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_trades`
--

DROP TABLE IF EXISTS `point_trades`;
CREATE TABLE IF NOT EXISTS `point_trades` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `buyer_id` bigint UNSIGNED NOT NULL,
  `seller_id` bigint UNSIGNED NOT NULL,
  `points_amount` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `fee` decimal(10,2) GENERATED ALWAYS AS ((`price` * 0.20)) VIRTUAL,
  `status` enum('pending','completed','canceled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `point_trades_buyer_id_foreign` (`buyer_id`),
  KEY `point_trades_seller_id_foreign` (`seller_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_transactions`
--

DROP TABLE IF EXISTS `point_transactions`;
CREATE TABLE IF NOT EXISTS `point_transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `seller_id` bigint UNSIGNED NOT NULL,
  `buyer_id` bigint UNSIGNED DEFAULT NULL,
  `listing_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('bonus','penalty') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `point_transactions_seller_id_foreign` (`seller_id`),
  KEY `point_transactions_buyer_id_foreign` (`buyer_id`),
  KEY `point_transactions_listing_id_foreign` (`listing_id`),
  KEY `point_transactions_order_id_foreign` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `point_transactions`
--

INSERT INTO `point_transactions` (`id`, `seller_id`, `buyer_id`, `listing_id`, `order_id`, `description`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, 1, NULL, 'Listing point', 'bonus', '2024-11-11 06:20:32', '2024-11-11 06:20:32'),
(2, 2, 3, 1, 1, 'Listing Shipped', 'bonus', '2024-11-11 06:41:25', '2024-11-11 06:41:25'),
(3, 2, NULL, 2, NULL, 'Listing point', 'bonus', '2024-11-11 08:15:46', '2024-11-11 08:15:46');

-- --------------------------------------------------------

--
-- Table structure for table `practices`
--

DROP TABLE IF EXISTS `practices`;
CREATE TABLE IF NOT EXISTS `practices` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `region_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `regions_city_id_foreign` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `region_name`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 'Gulberg', 1, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(2, 'Model Town', 1, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(3, 'Defense', 1, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(4, 'Allama Iqbal Town', 1, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(5, 'Johar Town', 1, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(6, 'Clifton', 2, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(7, 'Korangi', 2, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(8, 'Nazimabad', 2, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(9, 'Gulshan-e-Iqbal', 2, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(10, 'Faisal Cantonment', 2, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(11, 'F-6', 3, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(12, 'F-7', 3, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(13, 'G-9', 3, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(14, 'G-11', 3, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(15, 'I-8', 3, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(16, 'Samanabad', 4, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(17, 'Madina Town', 4, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(18, 'D Ground', 4, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(19, 'Faisal Town', 4, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(20, 'Iqbal Town', 4, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(21, 'Murray Road', 5, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(22, 'Satellite Town', 5, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(23, 'Westridge', 5, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(24, 'Liaquat Bagh', 5, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(25, 'Chaklala', 5, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(26, 'Liaquatabad', 6, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(27, 'Bahar Colony', 6, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(28, 'Shah Rukh Neelum', 6, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(29, 'Kachehri', 6, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(30, 'Pakpattan', 6, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(31, 'Allama Iqbal', 7, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(32, 'Al-Madina', 7, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(33, 'Al-Khalid', 7, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(34, 'Gujranwala City', 7, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(35, 'Gujranwala Chowk', 7, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(36, 'Allama Iqbal Town Sialkot', 8, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(37, 'Chowk Sialkot', 8, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(38, 'Daska Road', 8, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(39, 'Pasrur', 8, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(40, 'Sialkot Cantt', 8, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(41, 'Bahatwala', 9, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(42, 'Bahawalpur City', 9, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(43, 'Sadar Bahawalpur', 9, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(44, 'Islamia University', 9, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(45, 'Nawab Bahawal Khan', 9, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(46, 'University Town', 10, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(47, 'Ring Road Peshawar', 10, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(48, 'Peshawar Cantt', 10, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(49, 'Hayatabad', 10, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(50, 'Charsadda Road', 10, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(51, 'Qasimabad', 11, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(52, 'Latifabad', 11, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(53, 'Auto Bhan Road', 11, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(54, 'Sadar', 11, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(55, 'Kacheri', 11, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(56, 'Saryab', 12, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(57, 'Hana Road', 12, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(58, 'Jinnah Road', 12, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(59, 'Airport Road', 12, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(60, 'Kachhi Abadi', 12, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(61, 'Khanaspur', 13, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(62, 'Mirpur', 13, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(63, 'Thandiani', 13, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(64, 'Havelian', 13, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(65, 'Khanaspur', 13, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(66, 'Mardan Cantt', 14, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(67, 'Khanpur', 14, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(68, 'Ghalibabad', 14, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(69, 'Nowshera', 14, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(70, 'Takkar', 14, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(71, 'Kandhra', 15, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(72, 'Sukkur City', 15, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(73, 'Pano Aqil', 15, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(74, 'Rohri', 15, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(75, 'Shikarpur', 15, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(76, 'Larkana City', 16, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(77, 'Ratodero', 16, '2024-11-11 06:16:20', '2024-11-11 06:16:20'),
(78, 'Dokri', 16, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(79, 'Sujawal', 16, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(80, 'Nawabshah', 16, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(81, 'Mirpurkhas City', 17, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(82, 'Kot Ghulam Muhammad', 17, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(83, 'Shahdadpur', 17, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(84, 'Digri', 17, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(85, 'Sanghar', 17, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(86, 'Gwadar City', 18, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(87, 'Pasni', 18, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(88, 'Jewani', 18, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(89, 'Turbat', 18, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(90, 'Kech', 18, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(91, 'Mingora', 19, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(92, 'Bahrain', 19, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(93, 'Kalam', 19, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(94, 'Charbagh', 19, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(95, 'Barikot', 19, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(96, 'Dera Ismail Khan City', 20, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(97, 'Paharpur', 20, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(98, 'Darazinda', 20, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(99, 'Tota', 20, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(100, 'Ghani Bacha', 20, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(101, 'Jhelum City', 21, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(102, 'Mirpur', 21, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(103, 'Kharian', 21, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(104, 'Dina', 21, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(105, 'Shahkot', 21, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(106, 'Sheikhupura City', 22, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(107, 'Faisalabad Road', 22, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(108, 'Kot Abdul Malik', 22, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(109, 'Baddomalhi', 22, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(110, 'Gohar Shahi', 22, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(111, 'Sargodha City', 23, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(112, 'Gulberg', 23, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(113, 'Malkhanwala', 23, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(114, 'Haq Nawaz', 23, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(115, 'Aam Khas', 23, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(116, 'Attock City', 24, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(117, 'Jand', 24, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(118, 'Hazro', 24, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(119, 'Pindigheb', 24, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(120, 'Makhad', 24, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(121, 'Kasur City', 25, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(122, 'Raiwind', 25, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(123, 'Pattoki', 25, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(124, 'Khudian', 25, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(125, 'Sakhi Sarwar', 25, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(126, 'Mandi Bahauddin City', 26, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(127, 'Mandi Khas', 26, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(128, 'Malakwal', 26, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(129, 'Phalia', 26, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(130, 'Naseerabad', 26, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(131, 'Narowal City', 27, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(132, 'Shakargarh', 27, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(133, 'Daska', 27, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(134, 'Zafarwal', 27, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(135, 'Waris Shah', 27, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(136, 'Khushab City', 28, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(137, 'Noor Pur', 28, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(138, 'Jauharabad', 28, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(139, 'Mithra', 28, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(140, 'Kehli Rattan', 28, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(141, 'Sahiwal City', 29, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(142, 'Chichawatni', 29, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(143, 'Kahror Pakka', 29, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(144, 'Pakpattan', 29, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(145, 'Arifwala', 29, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(146, 'Thatta City', 30, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(147, 'Makli', 30, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(148, 'Jati', 30, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(149, 'Ghorabari', 30, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(150, 'Keti Bunder', 30, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(151, 'Nankana Sahib City', 31, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(152, 'Sangla Hill', 31, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(153, 'Shahkot', 31, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(154, 'Buddhu Sukh', 31, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(155, 'Kamoke', 31, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(156, 'Mianwali City', 32, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(157, 'Isakhel', 32, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(158, 'Piplan', 32, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(159, 'Makhad', 32, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(160, 'Kalabagh', 32, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(161, 'Shikarpur City', 33, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(162, 'Lakhi Ghulam Shah', 33, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(163, 'Khanpur', 33, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(164, 'Garhi Yasin', 33, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(165, 'Sakrand', 33, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(166, 'Khairpur City', 34, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(167, 'Faiz Ganj', 34, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(168, 'Kot Diji', 34, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(169, 'Nao Sharif', 34, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(170, 'Thari Mirwah', 34, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(171, 'Jhang City', 35, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(172, 'Ahmadpur Sial', 35, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(173, 'Shahkot', 35, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(174, 'Chiniot', 35, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(175, 'Mandi Shah Jewna', 35, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(176, 'Bhakkar City', 36, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(177, 'Darya Khan', 36, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(178, 'Dahranwala', 36, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(179, 'Mankera', 36, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(180, 'Kachhi Kacheri', 36, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(181, 'Layyah City', 37, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(182, 'Chaubara', 37, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(183, 'Karor Lal Esan', 37, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(184, 'Fatehpur', 37, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(185, 'Tareem', 37, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(186, 'Tando Allahyar City', 38, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(187, 'Tando Jam', 38, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(188, 'Sakrand', 38, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(189, 'Shadi Palli', 38, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(190, 'Dhoronaro', 38, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(191, 'Hala City', 39, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(192, 'Hala Naka', 39, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(193, 'Bhit Shah', 39, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(194, 'Jhando Mari', 39, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(195, 'Khairpur Nathan Shah', 39, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(196, 'Sukkur City', 40, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(197, 'Pano Aqil', 40, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(198, 'Rohri', 40, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(199, 'Saleh Pat', 40, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(200, 'Dokri', 40, '2024-11-11 06:16:21', '2024-11-11 06:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2024-11-11 06:16:21', '2024-11-11 06:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint UNSIGNED NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('cidjJf7sK5QEZCD5ZyNQvGGnb5mkkOjiXTQYvq51', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ3hRekhpT1pBWk9OUHRFV05oWmQ3Z3Y4MjgzaWU4Wkk3TTgwakgycSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM0OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vb3JkZXJzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1731330898),
('ULzSUfZlreGiFquZNc7pcfbSKTaAMZeIS6Vcmq77', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoicmRXelZYSlk1TktidkxJMG5kWjdkczZjRnVDMnhoSUhKSjlNY1NZZCI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL21hcmtldC9wbGFjZSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMwOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvbGlzdGluZ3MiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1731330946),
('xsTQ2tS84vfvP7nv3z9faqHFVXS50Z082hTtxlyh', 3, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaFNid3pmSk81dllIVlhqQ2ROZTBwa0RCVkxVdFY3Y0JPT2dTU0J0NSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9tYXJrZXQvcGxhY2UiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTozO30=', 1731333996);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

DROP TABLE IF EXISTS `sub_categories`;
CREATE TABLE IF NOT EXISTS `sub_categories` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id_from` bigint UNSIGNED NOT NULL,
  `user_id_to` bigint UNSIGNED NOT NULL,
  `transaction_id` bigint UNSIGNED NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('purchase','trade') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('completed','pending') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transactions_user_id_from_foreign` (`user_id_from`),
  KEY `transactions_user_id_to_foreign` (`user_id_to`),
  KEY `transactions_transaction_id_foreign` (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `points_balance` int NOT NULL DEFAULT '0',
  `region_id` bigint UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `profile_image`, `email`, `contact`, `email_verified_at`, `password`, `username`, `points_balance`, `region_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Atif Shehzad', NULL, 'aatifshehzad668@gmail.com', NULL, NULL, '$2y$12$jwUmm60773NcoqkfiQcwSuz5hLfgWI05eqhZ0J6V7L4ylp3YScf3.', 'atif.shehzad', 0, NULL, NULL, '2024-11-11 06:16:21', '2024-11-11 06:16:21'),
(2, 'sir kosar', 'uploads/profile_images/1731330915_room1.jpeg', 'sirkosar123@gmail.com', '1345678', NULL, '$2y$12$oGn8UTwtrsw4ePKPGquTX.92xwrwbBp5EMnP14gxVUqesjHAyKYDu', NULL, 3, NULL, NULL, '2024-11-11 06:17:32', '2024-11-11 08:15:15'),
(3, 'Shayan Ahmad', 'uploads/profile_images/1731326543_profile.jpeg', 'shayanahmad123@gmail.com', '12345678', NULL, '$2y$12$oQ0yTbIcEb4CVUCb2GPwyO.Zh24k.BkFQIkvh72bYuJHyhT9il3OG', NULL, 0, NULL, NULL, '2024-11-11 06:24:39', '2024-11-11 08:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

DROP TABLE IF EXISTS `wallets`;
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallets_user_id_foreign` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`id`, `user_id`, `balance`, `created_at`, `updated_at`) VALUES
(1, 1, '20.00', '2024-11-11 06:26:51', '2024-11-11 06:44:00'),
(2, 2, '0.00', '2024-11-11 06:44:00', '2024-11-11 06:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `wallet_transactions`
--

DROP TABLE IF EXISTS `wallet_transactions`;
CREATE TABLE IF NOT EXISTS `wallet_transactions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `wallet_id` bigint UNSIGNED NOT NULL,
  `order_id` bigint UNSIGNED DEFAULT NULL,
  `amount` decimal(8,2) NOT NULL,
  `type` enum('Credit','Debit') COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(8,2) NOT NULL,
  `transaction_ref` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wallet_transactions_user_id_foreign` (`user_id`),
  KEY `wallet_transactions_wallet_id_foreign` (`wallet_id`),
  KEY `wallet_transactions_order_id_foreign` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wallet_transactions`
--

INSERT INTO `wallet_transactions` (`id`, `user_id`, `wallet_id`, `order_id`, `amount`, `type`, `balance`, `transaction_ref`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '100.00', 'Credit', '100.00', '7RT373749R8592628', NULL, '{\"transaction_for_listing\":\"test 1\",\"payer\":{\"name\":\"John Doe\",\"email\":\"sb-a8sj030805609@personal.example.com\"},\"receiver\":{\"name\":\"sir kosar\",\"role\":\"Listing owner\"},\"amount\":\"100.00 USD\",\"net_amount_after_fees\":\"96.02 USD\"}', '2024-11-11 06:26:51', '2024-11-11 06:26:51'),
(2, 2, 2, 1, '80.00', 'Debit', '0.00', 'internal', 'seller_payment_details/1731325511_lap3.jpeg', '{\"message\":\"This amount of 80 has been deducted from the wallet of seller: sir kosar.\",\"order_id\":\"1\",\"seller_name\":\"sir kosar\",\"payment_amount\":\"80\",\"new_balance\":0}', '2024-11-11 06:45:11', '2024-11-11 06:45:11');

-- --------------------------------------------------------

--
-- Table structure for table `wanted_items`
--

DROP TABLE IF EXISTS `wanted_items`;
CREATE TABLE IF NOT EXISTS `wanted_items` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint UNSIGNED NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `wanted_items_user_id_foreign` (`user_id`),
  KEY `wanted_items_category_id_foreign` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listings`
--
ALTER TABLE `listings`
  ADD CONSTRAINT `listings_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `listings_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_bump_schedules`
--
ALTER TABLE `listing_bump_schedules`
  ADD CONSTRAINT `listing_bump_schedules_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `listing_images`
--
ALTER TABLE `listing_images`
  ADD CONSTRAINT `listing_images_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `point_trades`
--
ALTER TABLE `point_trades`
  ADD CONSTRAINT `point_trades_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `point_trades_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `point_transactions`
--
ALTER TABLE `point_transactions`
  ADD CONSTRAINT `point_transactions_buyer_id_foreign` FOREIGN KEY (`buyer_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `point_transactions_listing_id_foreign` FOREIGN KEY (`listing_id`) REFERENCES `listings` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `point_transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `point_transactions_seller_id_foreign` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_from_foreign` FOREIGN KEY (`user_id_from`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transactions_user_id_to_foreign` FOREIGN KEY (`user_id_to`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wallet_transactions`
--
ALTER TABLE `wallet_transactions`
  ADD CONSTRAINT `wallet_transactions_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wallet_transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wallet_transactions_wallet_id_foreign` FOREIGN KEY (`wallet_id`) REFERENCES `wallets` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wanted_items`
--
ALTER TABLE `wanted_items`
  ADD CONSTRAINT `wanted_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wanted_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
