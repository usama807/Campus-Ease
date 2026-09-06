-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 06, 2026 at 02:32 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `campus_ease`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Electronics', '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(2, 'Documents & ID Cards', '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(3, 'Bags & Wallets', '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(4, 'Keys', '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(5, 'Jewelry & Accessories', '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(6, 'Clothing', '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(7, 'Books & Stationery', '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(8, 'Other', '2026-09-06 08:03:36', '2026-09-06 08:03:36');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint UNSIGNED NOT NULL,
  `claim_id` bigint UNSIGNED NOT NULL,
  `sender_id` bigint UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `found_item_id` bigint UNSIGNED NOT NULL,
  `verification_answers` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `reviewed_by` bigint UNSIGNED DEFAULT NULL,
  `reviewed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`id`, `user_id`, `found_item_id`, `verification_answers`, `status`, `reviewed_by`, `reviewed_at`, `created_at`, `updated_at`) VALUES
(1, 4, 7, 'this watch have a unique text written on with my pencil', 'approved', 2, '2026-09-06 08:52:36', '2026-09-06 08:11:13', '2026-09-06 08:52:36'),
(3, 4, 9, 'laptop has a broken screen mirror', 'approved', 2, '2026-09-06 09:08:13', '2026-09-06 09:07:40', '2026-09-06 09:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `found_items`
--

CREATE TABLE `found_items` (
  `id` bigint UNSIGNED NOT NULL,
  `logged_by` bigint UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_found` date NOT NULL,
  `time_found` time DEFAULT NULL,
  `location_found` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `storage_location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('in_storage','claimed','donated','disposed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'in_storage',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `found_items`
--

INSERT INTO `found_items` (`id`, `logged_by`, `item_name`, `category_id`, `color`, `brand_model`, `date_found`, `time_found`, `location_found`, `storage_location`, `description`, `status`, `created_at`, `updated_at`) VALUES
(7, 2, 'watch', 1, 'black', 'rolex', '2026-09-06', '06:00:00', 'computer lab', 'security office', 'sdfsdfsfs', 'claimed', '2026-09-06 08:08:36', '2026-09-06 08:52:36'),
(9, 2, 'laptop', 1, 'black', 'lenovo', '2026-09-06', NULL, 'library', 'security office', 'kjafshdjk', 'claimed', '2026-09-06 09:06:55', '2026-09-06 09:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `found_item_photos`
--

CREATE TABLE `found_item_photos` (
  `id` bigint UNSIGNED NOT NULL,
  `found_item_id` bigint UNSIGNED NOT NULL,
  `photo_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `item_matches`
--

CREATE TABLE `item_matches` (
  `id` bigint UNSIGNED NOT NULL,
  `lost_item_id` bigint UNSIGNED NOT NULL,
  `found_item_id` bigint UNSIGNED NOT NULL,
  `match_confidence` tinyint UNSIGNED NOT NULL,
  `status` enum('suggested','confirmed','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'suggested',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lost_items`
--

CREATE TABLE `lost_items` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_model` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_lost` date NOT NULL,
  `time_lost` time DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('pending','approved','matched','claimed','closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `lost_items`
--

INSERT INTO `lost_items` (`id`, `user_id`, `item_name`, `category_id`, `color`, `brand_model`, `date_lost`, `time_lost`, `location`, `description`, `photo`, `status`, `created_at`, `updated_at`) VALUES
(1, 4, 'watch', 1, 'black', 'rolex', '2026-09-06', '06:00:00', 'computer lab', 'sdfsdkfsdjfs', 'lost-items/qDhmlnM8rA06TQwNcFCxD4uz9yxntPpcf85QferN.jpg', 'closed', '2026-09-06 08:06:48', '2026-09-06 08:53:11'),
(3, 4, 'bag', 3, 'white', 'gucci', '2026-09-06', '06:16:00', 'library', 'sdfsdfs', 'lost-items/kP7vCI6tXSON7DRBx4y8Isy11WkaoKqpsuBHSC5b.png', 'closed', '2026-09-06 08:16:36', '2026-09-06 08:23:06'),
(6, 4, 'Pen', 7, 'red', 'piano', '2026-09-05', '06:53:00', 'flour', 'fkasldfjsklf', 'lost-items/StAD786kU4tzRF1vxO8mXgLapbvzKF0NciLEClfh.webp', 'approved', '2026-09-06 08:54:18', '2026-09-06 08:54:56'),
(8, 4, 'laptop', 1, 'black', 'lenovo', '2026-09-06', '07:05:00', 'library', 'kjafshdjk', 'lost-items/DSu4Y7QcBoEYrks2Pk0OagG7bqKKqwWMulGjh7Nz.jpg', 'approved', '2026-09-06 09:06:15', '2026-09-06 09:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_08_14_000002_create_categories_table', 1),
(5, '2026_08_14_000003_create_lost_items_table', 1),
(6, '2026_08_14_000004_create_found_items_table', 1),
(7, '2026_08_14_000005_create_found_item_photos_table', 1),
(8, '2026_08_14_000006_create_item_matches_table', 1),
(9, '2026_08_14_000007_create_claims_table', 1),
(10, '2026_08_14_000008_create_chat_messages_table', 1),
(11, '2026_08_14_000009_create_system_logs_table', 1),
(12, '2026_08_14_000010_create_settings_table', 1),
(13, '2026_08_15_020856_add_role_column_to_users_table', 1),
(14, '2026_09_06_132621_add_approved_status_to_lost_items_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3hHBGkE0t3ycm5OTbpdMdTfxmtTpXqxDZaiFGWoj', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJQMXk0a2s4N1pUTkpoVlgxc05ZSzYwMGowNnA0cUl2bUFZcVV0VERIIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI2XC9hZG1pblwvY2xhaW1zXC8yIiwicm91dGUiOiJhZG1pbi5jbGFpbXMuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbInN0YXR1cyJdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInN0YXR1cyI6IkNsYWltIGFwcHJvdmVkLiBUaGUgaXRlbSBoYXMgYmVlbiBtYXJrZWQgYXMgY2xhaW1lZC4ifQ==', 1788703294),
('a6qdVv0lP0V6yXuIBHTrqx0RmgT2NQz6u3MM4Eqo', 1, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJTNUdPdnpvTUlzUUVrUzdpclQ4b2dyS3NqRk02T1A5Sk1nZ2o3eExPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI4XC9zdXBlci1hZG1pblwvc2V0dGluZ3MiLCJyb3V0ZSI6InN1cGVyYWRtaW4uc2V0dGluZ3MuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6WyJfb2xkX2lucHV0IiwiZXJyb3JzIl0sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwiX29sZF9pbnB1dCI6eyJfdG9rZW4iOiJTNUdPdnpvTUlzUUVrUzdpclQ4b2dyS3NqRk02T1A5Sk1nZ2o3eExPIiwiX21ldGhvZCI6IlBBVENIIiwibWF0Y2hfc2Vuc2l0aXZpdHlfdGhyZXNob2xkIjpudWxsLCJ1bmNsYWltZWRfaXRlbV9leHBpcmF0aW9uX2RheXMiOiI5MCJ9LCJlcnJvcnMiOnsiZGVmYXVsdCI6eyJmb3JtYXQiOiI6bWVzc2FnZSIsIm1lc3NhZ2VzIjp7Im1hdGNoX3NlbnNpdGl2aXR5X3RocmVzaG9sZCI6WyJUaGUgbWF0Y2ggc2Vuc2l0aXZpdHkgdGhyZXNob2xkIGZpZWxkIGlzIHJlcXVpcmVkLiJdfX19fQ==', 1788703914),
('AKJWwUhyCrbmuEJHfgOj7R5A9IM10VPRYpv9XWdk', 3, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJGVEtySFFRT2ZPWW9zVDM5eEdFY0JYS0U0c2EycDdPYjg0TWVpZ0NzIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjIzXC9sb3N0LWl0ZW1zXC9jcmVhdGUiLCJyb3V0ZSI6InVzZXIubG9zdC1pdGVtcy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6WyJzdGF0dXMiXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjozLCJzdGF0dXMiOiJZb3VyIGxvc3QgaXRlbSByZXBvcnQgaGFzIGJlZW4gc3VibWl0dGVkLiJ9', 1788700446),
('DgeXIBQHV5drAt84hGUaTBUrRWcLEvJGUUnuR9ER', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiIyS0licmUzZWYxeGs2VHprZUgyMHdPZXc5QUNOTWNmNGRNUGF5Q1lPIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI2XC9hZG1pblwvbG9zdC1pdGVtc1wvNyIsInJvdXRlIjoiYWRtaW4ubG9zdC1pdGVtcy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOlsic3RhdHVzIl0sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6Miwic3RhdHVzIjoiUmVwb3J0IGFwcHJvdmVkIGFuZCBsb2dnZWQgYXMgYSBmb3VuZCBpdGVtLiBJdCBub3cgYXBwZWFycyBpbiBGb3VuZCBJdGVtcyBhbmQgY2FuIGJlIGNsYWltZWQuIn0=', 1788703289),
('dMlltZnATAe7NU2MzWpINdx7YEgrP0rX916o3UNm', 3, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJkcmZ5enJoMTc1c2RZTmZIVGdWRUpYZm83SGVKdXllemlrU0JSMEJhIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI1XC9sb3N0LWl0ZW1zXC9jcmVhdGUiLCJyb3V0ZSI6InVzZXIubG9zdC1pdGVtcy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6WyJzdGF0dXMiXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjozLCJzdGF0dXMiOiJZb3VyIGxvc3QgaXRlbSByZXBvcnQgaGFzIGJlZW4gc3VibWl0dGVkLiJ9', 1788701324),
('f52Hal7vWDAQgBNNwDzYaLuY8vEBSOiGSz7FyNpx', 1, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiIzRTRrdnliUldoWlV6UzhvTzFxT1BBN0dDb0hFTWE2bG9KSThLWExNIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjMzXC9zdXBlci1hZG1pblwvc2V0dGluZ3MiLCJyb3V0ZSI6InN1cGVyYWRtaW4uc2V0dGluZ3MuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1788704123),
('GzUsrvUftfubOnVbUxfUAepsXG0HyYKLqXqoJN1A', 3, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJmaTR1dExOV1FkYkJwa3JTVDdoSXk5RFgxYUVKcmtteGhkTEVwc2RCIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI2XC9sb3N0LWl0ZW1zXC9jcmVhdGUiLCJyb3V0ZSI6InVzZXIubG9zdC1pdGVtcy5jcmVhdGUifSwiX2ZsYXNoIjp7Im9sZCI6WyJzdGF0dXMiXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjozLCJzdGF0dXMiOiJZb3VyIGxvc3QgaXRlbSByZXBvcnQgaGFzIGJlZW4gc3VibWl0dGVkLiJ9', 1788703287),
('hTO6E8R97RVf6nBgD8VSbJw61DEOK054j8EM2jik', 3, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJUYnB5aE9uTjlOMnVDa3REaVJBVnI0VUk3MVhHVXhnVGxlNFJhNTRFIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI0XC9sb3N0LWl0ZW1zXC80Iiwicm91dGUiOiJ1c2VyLmxvc3QtaXRlbXMuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjozfQ==', 1788700888),
('iBGmYqJzGLpqQY4UyTr2LIlOwgVr3kFlhWRpyw8p', 1, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJwQ1ZNYlBTNVRzV3hqMFA5ZGJPY1U4aGM0dTF1SVJNdWtZWDJoNnBvIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjMxXC9zdXBlci1hZG1pblwvc2V0dGluZ3MiLCJyb3V0ZSI6InN1cGVyYWRtaW4uc2V0dGluZ3MuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6WyJfb2xkX2lucHV0IiwiZXJyb3JzIl0sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MSwiX29sZF9pbnB1dCI6eyJfdG9rZW4iOiJwQ1ZNYlBTNVRzV3hqMFA5ZGJPY1U4aGM0dTF1SVJNdWtZWDJoNnBvIiwiX21ldGhvZCI6IlBBVENIIiwibWF0Y2hfc2Vuc2l0aXZpdHlfdGhyZXNob2xkIjpudWxsLCJ1bmNsYWltZWRfaXRlbV9leHBpcmF0aW9uX2RheXMiOiIzMCJ9LCJlcnJvcnMiOnsiZGVmYXVsdCI6eyJmb3JtYXQiOiI6bWVzc2FnZSIsIm1lc3NhZ2VzIjp7Im1hdGNoX3NlbnNpdGl2aXR5X3RocmVzaG9sZCI6WyJUaGUgbWF0Y2ggc2Vuc2l0aXZpdHkgdGhyZXNob2xkIGZpZWxkIGlzIHJlcXVpcmVkLiJdfX19fQ==', 1788704075),
('ket5vbpBZGsfQleVuZOdLgFayeJLn55Jtb90lhcC', 3, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiI0SXlNYUFiOXRuZERIVUExZklscFVDM0FDSTlqV2d6bnNER3VZZHpyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI3XC9mb3VuZC1pdGVtcz9kYXRlX2ZvdW5kPTIwMjYtMDktMDYiLCJyb3V0ZSI6InVzZXIuZm91bmQtaXRlbXMuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6M30=', 1788703381),
('L5vy4szj4mu6YmeGGnIfYijLBZm9Z89fj7JmION0', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJMeDRiNUg5UG9QU0dmZjVkb1VPWWlTMTF2RWlMdEFNb3Z2cVFFRTEyIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI4XC9hZG1pblwvcmVwb3J0cyIsInJvdXRlIjoiYWRtaW4ucmVwb3J0cy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1788703917),
('N13Qr2nm5XmnWDf8gzHFeYY59J6bnsai3pDMwj7p', 1, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJTODVxYXdobHN6NldNOTNsZVBSU244ZEpzVWMyRFBya0pFWUpENlRLIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI5XC9zdXBlci1hZG1pblwvc2V0dGluZ3MiLCJyb3V0ZSI6InN1cGVyYWRtaW4uc2V0dGluZ3MuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6WyJzdGF0dXMiXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoxLCJzdGF0dXMiOiJTZXR0aW5ncyB1cGRhdGVkLiJ9', 1788703947),
('ngv0vGtLEqJcYyjD4gi6LuZKxauCMCbW0Iz8fOOP', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJKVDdZU0VTaXJDeDRybVJuaVdaWHFGQXRUMVVrbWg2NDlsc3plcExoIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI5XC9hZG1pblwvcmVwb3J0cyIsInJvdXRlIjoiYWRtaW4ucmVwb3J0cy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1788703949),
('NpzO2D68C54oC2rG7CCkuEl5JRh49k7PyMZhT87j', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJINVo2SnltUjhHalRJblc4WFI5bzEyZVNzUGxVYkMybmNmQ21Jb01lIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI1XC9hZG1pblwvbG9zdC1pdGVtc1wvNSIsInJvdXRlIjoiYWRtaW4ubG9zdC1pdGVtcy5zaG93In0sIl9mbGFzaCI6eyJvbGQiOltdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjJ9', 1788701328),
('NzoazsfHLu9DatdJVp09vrWJSqPRi40vFpQk5KAi', 1, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJwZ2w3RnJnYkMybGduZHh1MTJpR3QxTkFNYlJXNWhpemdDWVpmWmlmIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjMyXC9zdXBlci1hZG1pblwvc2V0dGluZ3MiLCJyb3V0ZSI6InN1cGVyYWRtaW4uc2V0dGluZ3MuaW5kZXgifSwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI6MX0=', 1788704094),
('OoRcekOmklLabgo4huRrzxw40liRoHjh5YEkiroz', 3, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJPUGZmdm1Pb0hqZ3JrZ0hCSlMyNWY3RkRscGRQSVB1b3RGakhuREZWIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI2XC9mb3VuZC1pdGVtc1wvOFwvY2xhaW0iLCJyb3V0ZSI6InVzZXIuY2xhaW1zLmNyZWF0ZSJ9LCJfZmxhc2giOnsib2xkIjpbInN0YXR1cyJdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjMsInN0YXR1cyI6IllvdXIgY2xhaW0gaGFzIGJlZW4gc3VibWl0dGVkIGZvciByZXZpZXcuIn0=', 1788703292),
('OxOVL1duokCqF3xv3PdOLDm81Ww5uPu398OMOFtW', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiIxaTFaeTF0amxuODlXSlc0Wm53elRGOGx1MXVNdGhleGlOUjAwRmloIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjMxXC9hZG1pblwvcmVwb3J0cyIsInJvdXRlIjoiYWRtaW4ucmVwb3J0cy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1788704077),
('tp8Y0lfJFmHz4FKDlTQ7TgJL3CzJ5MrAgQraUxkQ', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJHd2l4REhUQmlVRGhHMjFHTmxKMUJoRmI0bk5sZlpnZ201eDh6M2FZIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjIzXC9hZG1pblwvbG9zdC1pdGVtcyIsInJvdXRlIjoiYWRtaW4ubG9zdC1pdGVtcy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1788700447),
('uJaJIjwLGkZ8k9EG4GYGHCOainMdu6VBAYMYKmO6', 3, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJYR0k5UnpzWXJONGYzdVdKd3pnR3VSMDAySmxlcDI3QkQ4SmhWT0E1IiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjI1XC9sb3N0LWl0ZW1zXC81Iiwicm91dGUiOiJ1c2VyLmxvc3QtaXRlbXMuc2hvdyJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjozfQ==', 1788701330),
('y3DFzmbCsYJ1CamBKYel0888thU40RFfpArcF85o', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/152.0.0.0 Safari/537.36', 'eyJfdG9rZW4iOiJrNzIwTXlZcDNrRWpnaTJXUEk3U3oyVDZWalMxQ1l5a2xHWUdPdGpQIiwiX2ZsYXNoIjp7Im9sZCI6W10sIm5ldyI6W119LCJfcHJldmlvdXMiOnsidXJsIjoiaHR0cDpcL1wvY2FtcHVzZS1lYXNlLnRlc3RcL2xvZ2luIiwicm91dGUiOiJsb2dpbiJ9fQ==', 1788704976),
('Yf4vwK8Z99n00arzsAEJwjT4yd2pjiZ8G8rH7IUP', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJicFltaDdLMElvZXFPTnFiWWxGOXdsN0VGZ2oxWHJXQUM0c2VwUE9vIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjMwXC9hZG1pblwvcmVwb3J0cyIsInJvdXRlIjoiYWRtaW4ucmVwb3J0cy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbInN0YXR1cyJdLCJuZXciOltdfSwibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiOjIsInN0YXR1cyI6IjEgdW5jbGFpbWVkIGl0ZW0ocykgb2xkZXIgdGhhbiA5MCBkYXlzIG1vdmVkIHRvIERvbmF0ZWQgc3RhdHVzLiJ9', 1788703971),
('z7sMX6n9zd4a7r3VL3EaSYK29j3WCcjmfgNS2AL4', 2, '127.0.0.1', 'curl/8.16.0', 'eyJfdG9rZW4iOiJ5ZDBrdFJHeGRHcWJMdHBGTzc0ZG01dzJEeWZ6WXBKMm1PSkRCQUtxIiwiX3ByZXZpb3VzIjp7InVybCI6Imh0dHA6XC9cLzEyNy4wLjAuMTo4MjMzXC9hZG1pblwvcmVwb3J0cyIsInJvdXRlIjoiYWRtaW4ucmVwb3J0cy5pbmRleCJ9LCJfZmxhc2giOnsib2xkIjpbXSwibmV3IjpbXX0sImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjoyfQ==', 1788704124);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint UNSIGNED NOT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created_at`, `updated_at`) VALUES
(1, 'match_sensitivity_threshold', '40', '2026-09-06 09:12:25', '2026-09-06 09:12:27'),
(2, 'unclaimed_item_expiration_days', '30', '2026-09-06 09:12:26', '2026-09-06 09:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `user_id`, `action`, `description`, `created_at`, `updated_at`) VALUES
(1, 2, 'lost_item_approved', 'Security Admin approved lost item report \"watch\" (reported by iram).', '2026-09-06 08:28:41', '2026-09-06 08:28:41'),
(2, 2, 'lost_item_approved', 'Security Admin approved lost item report \"Approve Test Item\" (reported by Test User).', '2026-09-06 08:28:47', '2026-09-06 08:28:47'),
(3, 2, 'lost_item_approved', 'Security Admin approved lost item report \"Pen\" (reported by iram).', '2026-09-06 08:54:56', '2026-09-06 08:54:56'),
(4, 2, 'lost_item_approved', 'Security Admin approved lost item report \"Approve Flow Pen\" (reported by Test User) and logged it as a found item.', '2026-09-06 09:01:29', '2026-09-06 09:01:29'),
(5, 2, 'lost_item_approved', 'Security Admin approved lost item report \"laptop\" (reported by iram) and logged it as a found item.', '2026-09-06 09:06:55', '2026-09-06 09:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('normal_user','security_admin','super_admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal_user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@campusease.com', 'super_admin', '2026-09-06 08:03:36', '$2y$12$KhHWwXi6pjm4CtCihSHexuU0.KEPC8YkviIleQYA54gp1HR00vtQ2', NULL, '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(2, 'Security Admin', 'security@campusease.com', 'security_admin', '2026-09-06 08:03:36', '$2y$12$pYtWzfhf.mbsr9YWdVPxOuNvLebt1N64VOdGFxB7VJa6xKsbjnCtW', NULL, '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(3, 'Test User', 'test@example.com', 'normal_user', '2026-09-06 08:03:36', '$2y$12$voN1Tj/52.4.K9GdRkBNlue8Uzee5hYywOgwtaciSDdVaOcwcVeUe', NULL, '2026-09-06 08:03:36', '2026-09-06 08:03:36'),
(4, 'iram', 'bc210205288@vu.edu.pk', 'normal_user', NULL, '$2y$12$M/KAwgFvSu.nTBnWu9bfAOCbg5k9hB43wvwcCpldDPRsKZk1n17/K', NULL, '2026-09-06 08:05:27', '2026-09-06 08:05:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `chat_messages_claim_id_foreign` (`claim_id`),
  ADD KEY `chat_messages_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`id`),
  ADD KEY `claims_user_id_foreign` (`user_id`),
  ADD KEY `claims_found_item_id_foreign` (`found_item_id`),
  ADD KEY `claims_reviewed_by_foreign` (`reviewed_by`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `found_items`
--
ALTER TABLE `found_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `found_items_logged_by_foreign` (`logged_by`),
  ADD KEY `found_items_category_id_foreign` (`category_id`);

--
-- Indexes for table `found_item_photos`
--
ALTER TABLE `found_item_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `found_item_photos_found_item_id_foreign` (`found_item_id`);

--
-- Indexes for table `item_matches`
--
ALTER TABLE `item_matches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `item_matches_lost_item_id_foreign` (`lost_item_id`),
  ADD KEY `item_matches_found_item_id_foreign` (`found_item_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lost_items_user_id_foreign` (`user_id`),
  ADD KEY `lost_items_category_id_foreign` (`category_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `system_logs_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `found_items`
--
ALTER TABLE `found_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `found_item_photos`
--
ALTER TABLE `found_item_photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `item_matches`
--
ALTER TABLE `item_matches`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lost_items`
--
ALTER TABLE `lost_items`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `chat_messages_claim_id_foreign` FOREIGN KEY (`claim_id`) REFERENCES `claims` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `chat_messages_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `claims`
--
ALTER TABLE `claims`
  ADD CONSTRAINT `claims_found_item_id_foreign` FOREIGN KEY (`found_item_id`) REFERENCES `found_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `claims_reviewed_by_foreign` FOREIGN KEY (`reviewed_by`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `claims_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `found_items`
--
ALTER TABLE `found_items`
  ADD CONSTRAINT `found_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `found_items_logged_by_foreign` FOREIGN KEY (`logged_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `found_item_photos`
--
ALTER TABLE `found_item_photos`
  ADD CONSTRAINT `found_item_photos_found_item_id_foreign` FOREIGN KEY (`found_item_id`) REFERENCES `found_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `item_matches`
--
ALTER TABLE `item_matches`
  ADD CONSTRAINT `item_matches_found_item_id_foreign` FOREIGN KEY (`found_item_id`) REFERENCES `found_items` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `item_matches_lost_item_id_foreign` FOREIGN KEY (`lost_item_id`) REFERENCES `lost_items` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lost_items`
--
ALTER TABLE `lost_items`
  ADD CONSTRAINT `lost_items_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE RESTRICT,
  ADD CONSTRAINT `lost_items_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD CONSTRAINT `system_logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
