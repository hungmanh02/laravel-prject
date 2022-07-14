-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2022 at 03:36 PM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE IF NOT EXISTS `carts` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `carts_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cart_products`
--

DROP TABLE IF EXISTS `cart_products`;
CREATE TABLE IF NOT EXISTS `cart_products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_size` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_quantity` smallint(6) NOT NULL,
  `product_price` double NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cart_products_product_id_foreign` (`product_id`),
  KEY `cart_products_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `parent_id`, `created_at`, `updated_at`) VALUES
(22, 'VÁY ĐẸP - ĐẦM ĐẸP', 23, '2022-07-14 05:51:56', '2022-07-14 06:13:38'),
(23, 'Women\'s', NULL, '2022-07-14 06:12:05', '2022-07-14 06:12:05'),
(24, 'Men\'s', NULL, '2022-07-14 06:12:25', '2022-07-14 06:12:25'),
(25, 'Baby\'s', NULL, '2022-07-14 06:12:36', '2022-07-14 06:12:36'),
(26, 'Bags', NULL, '2022-07-14 06:13:21', '2022-07-14 06:13:21'),
(27, 'ÁO SƠ MI NỮ', 23, '2022-07-14 06:14:41', '2022-07-14 06:14:41'),
(28, 'ÁO KHOÁC NỮ', 23, '2022-07-14 06:15:05', '2022-07-14 06:15:05'),
(29, 'ĐẦM LEN', 23, '2022-07-14 06:15:19', '2022-07-14 06:15:19'),
(30, 'ÁO LEN', 23, '2022-07-14 06:15:30', '2022-07-14 06:15:35'),
(31, 'GIÀY DÉP', 26, '2022-07-14 06:16:11', '2022-07-14 06:16:11'),
(32, 'CHÂN VÁY', 23, '2022-07-14 06:33:08', '2022-07-14 06:33:08');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE IF NOT EXISTS `category_product` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_product_category_id_foreign` (`category_id`),
  KEY `category_product_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`id`, `category_id`, `product_id`, `created_at`, `updated_at`) VALUES
(5, 22, 15, NULL, NULL),
(7, 22, 18, NULL, NULL),
(8, 27, 19, NULL, NULL),
(9, 27, 21, NULL, NULL),
(10, 27, 23, NULL, NULL),
(11, 27, 24, NULL, NULL),
(12, 28, 25, NULL, NULL),
(13, 28, 26, NULL, NULL),
(14, 28, 27, NULL, NULL),
(15, 28, 28, NULL, NULL),
(16, 30, 29, NULL, NULL),
(17, 30, 30, NULL, NULL),
(19, 32, 32, NULL, NULL),
(20, 31, 33, NULL, NULL),
(21, 31, 34, NULL, NULL),
(22, 31, 35, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

DROP TABLE IF EXISTS `coupons`;
CREATE TABLE IF NOT EXISTS `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` double NOT NULL,
  `expery_date` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `coupons_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_user`
--

DROP TABLE IF EXISTS `coupon_user`;
CREATE TABLE IF NOT EXISTS `coupon_user` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `value` double NOT NULL,
  `coupon_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `coupon_user_user_id_foreign` (`user_id`),
  KEY `coupon_user_order_id_foreign` (`order_id`),
  KEY `coupon_user_coupon_id_foreign` (`coupon_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `imageable_id` bigint(20) UNSIGNED NOT NULL,
  `imageable_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `url`, `imageable_id`, `imageable_type`, `created_at`, `updated_at`) VALUES
(25, '1657785131.jpg', 35, 'App\\Models\\User', '2022-07-14 00:52:11', '2022-07-14 00:52:11'),
(27, '1657803628.jpg', 15, 'App\\Models\\Product', '2022-07-14 06:00:28', '2022-07-14 06:00:28'),
(30, '1657803787.jpg', 17, 'App\\Models\\Product', '2022-07-14 06:03:08', '2022-07-14 06:03:08'),
(31, '1657803705.jpg', 16, 'App\\Models\\Product', '2022-07-14 06:03:27', '2022-07-14 06:03:27'),
(32, '1657803875.jpg', 18, 'App\\Models\\Product', '2022-07-14 06:04:35', '2022-07-14 06:04:35'),
(33, '1657804672.jpg', 19, 'App\\Models\\Product', '2022-07-14 06:17:52', '2022-07-14 06:17:52'),
(35, '1657804775.jpg', 21, 'App\\Models\\Product', '2022-07-14 06:19:35', '2022-07-14 06:19:35'),
(37, '1657804879.jpg', 23, 'App\\Models\\Product', '2022-07-14 06:21:19', '2022-07-14 06:21:19'),
(38, '1657804926.jpg', 24, 'App\\Models\\Product', '2022-07-14 06:22:06', '2022-07-14 06:22:06'),
(39, '1657805074.jpg', 25, 'App\\Models\\Product', '2022-07-14 06:24:34', '2022-07-14 06:24:34'),
(40, '1657805122.jpg', 26, 'App\\Models\\Product', '2022-07-14 06:25:22', '2022-07-14 06:25:22'),
(41, '1657805175.jpg', 27, 'App\\Models\\Product', '2022-07-14 06:26:15', '2022-07-14 06:26:15'),
(42, '1657805226.jpg', 28, 'App\\Models\\Product', '2022-07-14 06:27:06', '2022-07-14 06:27:06'),
(43, '1657805398.jpg', 29, 'App\\Models\\Product', '2022-07-14 06:29:58', '2022-07-14 06:29:58'),
(44, '1657805453.jpeg', 30, 'App\\Models\\Product', '2022-07-14 06:30:53', '2022-07-14 06:30:53'),
(46, '1657805571.jpg', 31, 'App\\Models\\Product', '2022-07-14 06:33:19', '2022-07-14 06:33:19'),
(47, '1657805639.jpg', 32, 'App\\Models\\Product', '2022-07-14 06:33:59', '2022-07-14 06:33:59'),
(48, '1657805719.jpg', 33, 'App\\Models\\Product', '2022-07-14 06:35:19', '2022-07-14 06:35:19'),
(49, '1657805764.jpg', 34, 'App\\Models\\Product', '2022-07-14 06:36:04', '2022-07-14 06:36:04'),
(50, '1657805846.jpg', 35, 'App\\Models\\Product', '2022-07-14 06:37:26', '2022-07-14 06:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_07_07_041216_create_permission_tables', 1),
(6, '2022_07_07_072359_create_products_table', 1),
(7, '2022_07_07_072457_create_categories_table', 1),
(8, '2022_07_07_072559_create_product_details_table', 1),
(9, '2022_07_07_072625_create_images_table', 1),
(10, '2022_07_07_072644_create_carts_table', 1),
(11, '2022_07_07_072702_create_cart_products_table', 1),
(12, '2022_07_07_072729_create_coupons_table', 1),
(13, '2022_07_07_072745_create_orders_table', 1),
(14, '2022_07_07_072759_create_product_orders_table', 1),
(15, '2022_07_07_072825_create_coupon_users_table', 1),
(16, '2022_07_12_064100_update_user_table', 2),
(17, '2022_07_13_160358_refactor_field_parent_id_in_categories_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 34),
(1, 'App\\Models\\User', 35);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `status` varchar(255) NOT NULL,
  `total` double NOT NULL,
  `ship` double NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `customer_address` text NOT NULL,
  `note` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `group` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `group`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'create-user', 'Create user', 'User', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(2, 'update-user', 'Update user', 'User', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(3, 'show-user', 'Show user', 'User', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(4, 'delete-user', 'Delete user', 'User', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(5, 'create-role', 'Create role', 'Role', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(6, 'update-role', 'Update role', 'Role', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(7, 'show-role', 'Show role', 'Role', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(8, 'delete-role', 'Delete role', 'Role', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(9, 'create-category', 'Create category', 'Category', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(10, 'update-category', 'Update category', 'Category', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(11, 'show-category', 'Show category', 'Category', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(12, 'delete-category', 'Delete category', 'Category', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(13, 'create-product', 'Create product', 'Product', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(14, 'update-product', 'Update product', 'Product', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(15, 'show-product', 'Show product', 'Product', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(16, 'delete-product', 'Delete product', 'Product', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(17, 'create-coupon', 'Create coupon', 'Coupon', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(18, 'update-coupon', 'Update coupont', 'Coupon', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(19, 'show-coupon', 'Show coupon', 'Coupon', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31'),
(20, 'delete-coupon', 'Delete coupon', 'Coupon', 'web', '2022-07-07 08:03:31', '2022-07-07 08:03:31');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `sale` smallint(10) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `sale`, `price`, `created_at`, `updated_at`) VALUES
(15, 'Đầm voan hoa cúc dài cổ bẻ búp bê viền ren', '<p>Đầm voan hoa cúc dài cổ bẻ búp bê viền ren</p>', 5, 485000, '2022-07-14 06:00:28', '2022-07-14 06:00:28'),
(16, 'Đầm voan hoa nhí xòe cổ chữ V', '<p>Đầm voan hoa nhí xòe cổ chữ V</p>', 0, 450000, '2022-07-14 06:01:45', '2022-07-14 06:01:45'),
(17, 'Đầm voan hoa nhí xòe cổ chữ V', '<p>Đầm voan hoa nhí xòe cổ chữ V</p>', 0, 450000, '2022-07-14 06:01:57', '2022-07-14 06:01:57'),
(18, 'Đầm voan in hình nơ cổ chữ V chun eo', '<p>Đầm voan in hình nơ cổ chữ V chun eo</p>', 1, 450000, '2022-07-14 06:04:35', '2022-07-14 06:04:35'),
(19, 'Áo sơ mi voan dập phồng cổ vuông đơn giản', '<p>Áo sơ mi voan dập phồng cổ vuông đơn giản</p>', 0, 350000, '2022-07-14 06:17:52', '2022-07-14 06:17:52'),
(21, 'Áo sơ mi dập hoa nổi cổ chữ V viền đen đính nơ', '<p>Áo sơ mi dập hoa nổi cổ chữ V viền đen đính nơ</p>', 0, 385000, '2022-07-14 06:19:35', '2022-07-14 06:19:35'),
(23, 'Áo thun trắng cổ tròn tay phồng HQ đính hoa', '<p>Áo thun trắng cổ tròn tay phồng HQ đính hoa</p>', 0, 350000, '2022-07-14 06:21:19', '2022-07-14 06:21:19'),
(24, 'Áo thun trắng đơn giản in hình lá phong trẻ trung', '<p>Áo thun trắng đơn giản in hình lá phong trẻ trung</p>', 0, 285000, '2022-07-14 06:22:06', '2022-07-14 06:22:06'),
(25, 'Áo khoác phao thân dài lót 100% lông vũ nhẹ nhàng ấm áp', '<p>Áo khoác phao thân dài lót 100% lông vũ nhẹ nhàng ấm áp.</p><p>Hàng nhập khẩu cao cấp.</p><p>Chất phao bên ngoài chống thấm nước.</p><p>Thắt đai eo tôn dáng.</p>', 0, 1350000, '2022-07-14 06:24:34', '2022-07-14 06:24:34'),
(26, 'Áo khoác phao thân dài mũ lông thú thắt đai eo.', '<p>Áo khoác phao thân dài mũ lông thú thắt đai eo.</p><p>Lót bông tự nhiên 3 lớp.</p><p>Mũ sau lông thú trùm đầu ấm áp.</p><p>Lớp ngoài chống thấm nước.</p>', 0, 1250000, '2022-07-14 06:25:22', '2022-07-14 06:25:22'),
(27, 'Áo khoác phao thân dài 2 túi hộp mũ lông thú ấm áp', '<p>Lót bông tự nhiên 4 lớp.</p><p>Lớp phao ngoài chống thấm nước.</p><p>Mũ lông thú trùm đầu ấm áp.</p><p>Mặc được thời tiết âm độ.</p>', 0, 1150000, '2022-07-14 06:26:15', '2022-07-14 06:26:15'),
(28, 'Áo khoác phao thân dài sọc trám mũ lông thú ấm áp.', '<p>Áo khoác phao thân dài sọc trám mũ lông thú ấm áp.</p><p>Lót bông tự nhiên 4 lớp.</p><p>Lớp ngoài chống thấm nước.</p><p>Mũ lông thú dày, ấm.</p>', 0, 1150000, '2022-07-14 06:27:06', '2022-07-14 06:27:06'),
(29, 'Áo len dệt kim dáng thụng dài cổ lọ gập đính nút 1 bên', '<p>Áo len dệt kim dáng thụng dài cổ lọ gập đính nút 1 bên</p>', 0, 500000, '2022-07-14 06:29:58', '2022-07-14 06:29:58'),
(30, 'Áo len dệt kim kim tuyến thắt đai eo', '<p>Áo len dệt kim kim tuyến thắt đai eo</p>', 0, 450000, '2022-07-14 06:30:53', '2022-07-14 06:30:53'),
(31, 'Chân váy Jean chữ A cạp cao xẻ giữa', '<p>CV223 : Chân váy Jean chữ A cạp cao xẻ giữa</p><p>Size M : Eo 71, Mông 93, Dài 71</p><p>Size L : Eo 75, Mông 97, Dài 71</p><p>Kích thước thực tế có thể xê dịch 1-3cm so với bảng size.</p>', 0, 450000, '2022-07-14 06:32:51', '2022-07-14 06:32:51'),
(32, 'Chân váy Jean midi xòe cạp chun sau', '<p>CV222 : Chân váy Jean midi xòe cạp chun sau</p><p>Size M : Eo 72-78, Mông 118, Dài 71</p><p>Size L : Eo 75-82, Mông 120, Dài 72</p><p>Kích thước thực tế có thể xê dịch 1-3cm so với bảng size.</p>', 0, 450000, '2022-07-14 06:33:59', '2022-07-14 06:33:59'),
(33, 'XĂNG ĐAN DA LỘN CAO GÓT KÉO KHÓA SAU', '<h2>XĂNG ĐAN DA LỘN CAO GÓT KÉO KHÓA SAU</h2>', 0, 330000, '2022-07-14 06:35:19', '2022-07-14 06:35:19'),
(34, 'XĂNG ĐAN CAO GÓT QUAI ĐAN PHỐI 2 MÀU', '<h2>XĂNG ĐAN CAO GÓT QUAI ĐAN PHỐI 2 MÀU</h2>', 0, 335000, '2022-07-14 06:36:04', '2022-07-14 06:36:04'),
(35, 'XĂNG ĐAN ĐẾ XUỒNG ĐINH TÁN MÀU', '<p>XĂNG ĐAN ĐẾ XUỒNG ĐINH TÁN MÀU</p>', 0, 410000, '2022-07-14 06:37:26', '2022-07-14 06:37:26');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

DROP TABLE IF EXISTS `product_details`;
CREATE TABLE IF NOT EXISTS `product_details` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `size` varchar(255) NOT NULL,
  `quantity` smallint(6) NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_details_product_id_foreign` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

DROP TABLE IF EXISTS `product_orders`;
CREATE TABLE IF NOT EXISTS `product_orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_size` varchar(255) NOT NULL,
  `product_color` varchar(255) NOT NULL,
  `product_quantity` smallint(6) NOT NULL,
  `product_price` double NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_orders_order_id_foreign` (`order_id`),
  KEY `product_orders_user_id_foreign` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `group` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `display_name`, `group`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'web', 'Super Admin', 'system', '2022-07-07 07:34:53', '2022-07-07 07:34:53'),
(4, 'manager', 'web', 'manager', 'system', '2022-07-07 07:34:53', '2022-07-07 07:34:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `address` text,
  `gender` varchar(255) NOT NULL DEFAULT 'male',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_phone_unique` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `phone`, `address`, `gender`) VALUES
(35, 'Trần đình quế quyên', 'admin@admin.com', NULL, '$2y$10$/wTk8lEwQ6UxioT9IDQXSeLvTf3mP1K18dqmyYGAgf7MPVrUJwai6', NULL, '2022-07-14 00:41:24', '2022-07-14 00:52:11', '0706351541', 'Tổ 16 ấp an hòa xã an thới đông', 'male');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_products`
--
ALTER TABLE `cart_products`
  ADD CONSTRAINT `cart_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_products_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD CONSTRAINT `coupon_user_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_user_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_details`
--
ALTER TABLE `product_details`
  ADD CONSTRAINT `product_details_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_orders`
--
ALTER TABLE `product_orders`
  ADD CONSTRAINT `product_orders_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
