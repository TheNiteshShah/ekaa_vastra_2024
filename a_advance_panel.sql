-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 22, 2024 at 03:13 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `a_advance_panel`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_sidebar`
--

CREATE TABLE `admin_sidebar` (
  `id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(2000) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_sidebar`
--

INSERT INTO `admin_sidebar` (`id`, `name`, `url`, `icon`, `seq`) VALUES
(1, 'Dashboard', 'admin_index', 'fa fa-bar-chart', 1),
(2, 'Team', '#', 'fas fa-users-cog', 2),
(3, 'Sliders', '#', 'fa fa-picture-o', 3),
(4, 'Users', 'users.index', 'fa fa-users', 4),
(5, 'Category', 'category.index', 'fa fa-th-large', 5),
(7, 'Contact Enquiries', 'contact_enquiry', 'fa fa-envelope', 15),
(8, 'Orders', '#', 'fa fa-shopping-bag', 8),
(9, 'SubCategory', 'subcategory.index', 'fa fa-th', 6),
(10, 'Pop Image', 'popup.index', 'fa fa-picture-o', 9),
(11, 'Testimonials', 'testimonial.index', 'fa fa-comments', 10),
(12, 'PromoCodes', 'promo.index', 'fa fa-tags', 11),
(13, 'MinorCategory', 'minorcategory.index', 'fa fa-th', 7),
(14, 'Popup Enquiries', 'popup_enquiry', 'fa fa-envelope', 16),
(15, 'Master Types', 'master_type.index', 'fa fa-th-large', 11);

-- --------------------------------------------------------

--
-- Table structure for table `admin_sidebar2`
--

CREATE TABLE `admin_sidebar2` (
  `id` int(11) NOT NULL,
  `main_id` int(11) NOT NULL,
  `name` varchar(1000) NOT NULL,
  `url` varchar(2000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_sidebar2`
--

INSERT INTO `admin_sidebar2` (`id`, `main_id`, `name`, `url`) VALUES
(1, 2, 'View Team', 'view_team'),
(2, 2, 'Add Team', 'add_team_view'),
(3, 8, 'New Orders', 'new_orders'),
(4, 8, 'Accepted Orders', 'accepted_orders'),
(5, 8, 'Dispatched Orders', 'dispatched_orders'),
(6, 8, 'Delivered Orders', 'delivered_orders'),
(7, 8, 'Rejected Orders', 'rejected_orders'),
(8, 3, 'Slider1', 'sliders.index'),
(9, 3, 'Slider2', 'sliders2.index'),
(10, 3, 'Slider3', 'sliders3.index'),
(11, 3, 'Slider4', 'slider4.index'),
(12, 3, 'Slider5', 'slider5.index');

-- --------------------------------------------------------

--
-- Table structure for table `admin_teams`
--

CREATE TABLE `admin_teams` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(2000) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(2000) DEFAULT NULL,
  `image` varchar(1000) DEFAULT NULL,
  `power` int(11) NOT NULL,
  `services` varchar(1000) DEFAULT NULL,
  `ip` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `added_by` int(11) NOT NULL,
  `is_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_teams`
--

INSERT INTO `admin_teams` (`id`, `name`, `email`, `password`, `phone`, `address`, `image`, `power`, `services`, `ip`, `created_at`, `updated_at`, `deleted_at`, `added_by`, `is_active`) VALUES
(37, 'demo', 'demo@gmail.com', '202cb962ac59075b964b07152d234b70', '9809786655', '16, vaishali nagar, jaipur', '', 1, '[\"999\"]', '183.83.42.146', '2020-10-28 14:10:45', '2023-03-02 09:50:48', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `type_id`, `quantity`, `ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 2, NULL, '2024-02-21 15:11:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `seq`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nitesh', 'uploads/image/category/1708435946.png', NULL, 1, '127.0.0.1', 37, '2024-02-20 15:43:46', '2024-02-20 10:13:46', '2024-02-20 10:13:46'),
(2, 'Category', 'uploads/image/category/1708507513.jpg', 1, 1, '127.0.0.1', 37, '2024-02-21 03:55:13', '2024-02-21 09:39:51', NULL),
(3, 'vdvdvd', NULL, 1, 1, '127.0.0.1', 37, '2024-02-21 05:48:46', '2024-02-21 05:48:53', '2024-02-21 05:48:53'),
(4, 'Subcategory', 'uploads/image/category/1708516556.jpg', 1, 1, '127.0.0.1', 37, '2024-02-21 06:25:56', '2024-02-21 06:26:31', '2024-02-21 06:26:31');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone`, `message`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'NItesh', 'ns@gmail.com', '4587458748', 'hello', NULL, NULL, '2024-02-20 15:57:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_attributes`
--

CREATE TABLE `master_attributes` (
  `id` int(11) NOT NULL,
  `master_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_attributes`
--

INSERT INTO `master_attributes` (`id`, `master_id`, `name`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 'Bfbf', 1, '127.0.0.1', 37, '2024-02-22 07:35:51', '2024-02-22 07:35:51', NULL),
(2, 4, 'Bfbfvdvd', 1, '127.0.0.1', 37, '2024-02-22 07:36:31', '2024-02-22 07:36:42', NULL),
(3, 1, 'Red', 1, '127.0.0.1', 37, '2024-02-22 08:11:38', '2024-02-22 08:11:38', NULL),
(4, 2, 'L', 1, '127.0.0.1', 37, '2024-02-22 08:12:14', '2024-02-22 08:12:14', NULL),
(5, 3, '10M', 1, '127.0.0.1', 37, '2024-02-22 08:15:02', '2024-02-22 08:15:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_types`
--

CREATE TABLE `master_types` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `master_types`
--

INSERT INTO `master_types` (`id`, `name`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Color', 1, '127.0.0.1', 37, '2024-02-22 07:11:05', '2024-02-22 08:06:48', NULL),
(2, 'Size', 1, '127.0.0.1', 37, '2024-02-22 07:14:25', '2024-02-22 07:14:25', NULL),
(3, 'Length', 1, '127.0.0.1', 37, '2024-02-22 07:14:33', '2024-02-22 08:06:42', NULL),
(4, 'Clarity', 1, '127.0.0.1', 37, '2024-02-22 07:14:37', '2024-02-22 08:06:31', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `minorcategory`
--

CREATE TABLE `minorcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `minorcategory`
--

INSERT INTO `minorcategory` (`id`, `category_id`, `subcategory_id`, `name`, `image`, `seq`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 'Kurta', 'uploads/image/minorcategory/1708589963.png', 10, 0, '127.0.0.1', 37, '2024-02-22 02:49:23', '2024-02-22 02:51:25', '2024-02-22 02:51:25'),
(2, 2, 1, 'Cscs', 'uploads/image/minorcategory/1708590094.jpg', 1, 1, '127.0.0.1', 37, '2024-02-22 02:51:34', '2024-02-22 02:51:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order1`
--

CREATE TABLE `order1` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `promo_id` int(11) DEFAULT NULL,
  `promo_discount` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `final_amount` varchar(255) DEFAULT NULL,
  `payment_status` tinyint(4) DEFAULT NULL COMMENT '0 for not paid, 1 for paid',
  `order_status` int(11) DEFAULT NULL COMMENT '1 for placed, 2 for accepted, 3 for dispatched , 4 for delivered, 5 for rejected',
  `payment_type` tinyint(4) DEFAULT NULL COMMENT '1 for cod, 2 for online',
  `address` varchar(500) DEFAULT NULL,
  `tracking_url` varchar(500) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order1`
--

INSERT INTO `order1` (`id`, `user_id`, `promo_id`, `promo_discount`, `total_amount`, `final_amount`, `payment_status`, `order_status`, `payment_type`, `address`, `tracking_url`, `ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '20', '1520', '1500', 1, 3, 1, 'Shyam Nagar', 'https://www.google.com', NULL, '2024-02-20 10:11:38', '2024-02-22 06:55:47', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order2`
--

CREATE TABLE `order2` (
  `id` int(11) NOT NULL,
  `main_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `gst_percentage` varchar(255) DEFAULT NULL,
  `total_price` varchar(255) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order2`
--

INSERT INTO `order2` (`id`, `main_id`, `product_id`, `type_id`, `quantity`, `price`, `gst_percentage`, `total_price`, `ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 2, '100', '2', '200', NULL, '2024-02-21 09:08:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `popup`
--

CREATE TABLE `popup` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `form_active` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popup`
--

INSERT INTO `popup` (`id`, `image`, `link`, `form_active`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/image/popup/1708529725.jpg', 'https://www.google.com', 0, 1, '127.0.0.1', 37, '2024-02-21 15:17:44', '2024-02-22 03:43:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `popup_enquiry`
--

CREATE TABLE `popup_enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `popup_enquiry`
--

INSERT INTO `popup_enquiry` (`id`, `name`, `email`, `phone`, `message`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'NItesh', 'ns@gmail.com', '4587458748', 'hello', NULL, NULL, '2024-02-20 15:57:53', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `minorcategory_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sku` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_top` int(11) DEFAULT NULL,
  `is_trending` int(11) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `subcategory_id`, `minorcategory_id`, `name`, `sku`, `description`, `is_top`, `is_trending`, `seq`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, NULL, NULL, 'gfsgs', 'ngng', '<p>,j,j,</p>', 1, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-20 17:09:03', '2024-02-20 10:13:46', '2024-02-04 18:30:00'),
(2, 1, NULL, NULL, 'gfsgs', 'ngng', '<p>,j,j,</p>', 1, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-20 15:43:46', '2024-02-20 10:13:46', '2024-02-20 10:13:46'),
(3, 2, NULL, NULL, 'cscsc', 'c', '<p>cscs</p>', 1, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-21 04:08:59', '2024-02-21 09:39:51', NULL),
(4, 2, NULL, NULL, 'cscsc', 'c', '<p>cscs</p>', 1, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-21 04:09:22', '2024-02-21 09:39:51', NULL),
(5, 2, NULL, NULL, 'cscsc', 'c', '<p>cscs</p>', 1, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-21 09:43:56', '2024-02-21 04:13:56', '2024-02-21 04:13:56'),
(6, 2, NULL, NULL, 'cscsc', 'c', '<p>cscs</p>', 1, NULL, NULL, 0, '127.0.0.1', 37, '2024-02-21 09:42:22', '2024-02-21 04:12:22', '2024-02-21 04:12:22'),
(7, NULL, 1, NULL, 'Product', 'cscs', '<p>cscs</p>', 1, 1, 10, 1, '127.0.0.1', 37, '2024-02-21 06:56:09', '2024-02-22 02:27:56', NULL),
(8, 2, 1, 2, 'Dbdb', 'bdbdb', '<p>bdbdb</p>', 1, 1, 1, 0, '127.0.0.1', 37, '2024-02-22 03:14:09', '2024-02-22 03:14:09', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `promocodes`
--

CREATE TABLE `promocodes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL COMMENT '1 for one time, 2 for multiple time',
  `discount_type` int(11) DEFAULT NULL COMMENT '1 for percentage off, 2 for flat off',
  `discount` varchar(255) DEFAULT NULL,
  `max_discount` varchar(255) DEFAULT NULL,
  `mini_amount` varchar(255) DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promocodes`
--

INSERT INTO `promocodes` (`id`, `name`, `type`, `discount_type`, `discount`, `max_discount`, `mini_amount`, `expiry_date`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Cscscs', 2, 2, '41', NULL, '4444', '2024-02-29', 1, '127.0.0.1', 37, '2024-02-21 10:53:16', '2024-02-22 06:34:20', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(255) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `ratings` int(11) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `ratings`, `review`, `ip`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 8, 5, 'good', NULL, '2024-02-22 10:36:38', '2024-02-22 05:07:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `image`, `link`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'uploads/image/sliders/1708432668.jpg', NULL, 1, '127.0.0.1', 37, '2024-02-20 12:43:45', '2024-02-20 07:13:45', '2024-02-20 07:13:45'),
(5, 'uploads/image/sliders/1708433033.jpg', NULL, 1, '127.0.0.1', 37, '2024-02-20 12:45:17', '2024-02-20 07:15:17', '2024-02-20 07:15:17'),
(6, 'uploads/image/sliders/1708433124.jpg', 'https://www.google.com', 1, '127.0.0.1', 37, '2024-02-20 12:47:18', '2024-02-21 05:40:09', '2024-02-21 05:40:09');

-- --------------------------------------------------------

--
-- Table structure for table `sliders2`
--

CREATE TABLE `sliders2` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders2`
--

INSERT INTO `sliders2` (`id`, `image`, `link`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 'uploads/image/sliders/1708432668.jpg', NULL, 1, '127.0.0.1', 37, '2024-02-20 12:43:45', '2024-02-20 07:13:45', '2024-02-20 07:13:45'),
(5, 'uploads/image/sliders/1708433033.jpg', NULL, 1, '127.0.0.1', 37, '2024-02-20 12:45:17', '2024-02-20 07:15:17', '2024-02-20 07:15:17'),
(6, 'uploads/image/sliders/1708433124.jpg', 'https://www.google.com', 1, '127.0.0.1', 37, '2024-02-20 12:47:18', '2024-02-21 05:40:09', '2024-02-21 05:40:09'),
(7, 'uploads/image/sliders/1708513873.png', NULL, 1, '127.0.0.1', 37, '2024-02-21 05:41:13', '2024-02-21 05:41:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders3`
--

CREATE TABLE `sliders3` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders3`
--

INSERT INTO `sliders3` (`id`, `image`, `link`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/image/sliders/1708514018.jpg', NULL, 1, '127.0.0.1', 37, '2024-02-21 05:43:38', '2024-02-21 05:43:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sliders4`
--

CREATE TABLE `sliders4` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders4`
--

INSERT INTO `sliders4` (`id`, `image`, `link`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/image/slider4/1708588402.jpg', NULL, 1, '127.0.0.1', 37, '2024-02-22 02:23:22', '2024-02-22 02:23:35', '2024-02-22 02:23:35');

-- --------------------------------------------------------

--
-- Table structure for table `sliders5`
--

CREATE TABLE `sliders5` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sliders5`
--

INSERT INTO `sliders5` (`id`, `image`, `link`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'uploads/image/slider5/1708588424.jpg', NULL, 1, '127.0.0.1', 37, '2024-02-22 02:23:44', '2024-02-22 02:23:55', '2024-02-22 02:23:55');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `category_id`, `name`, `image`, `seq`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 'Subcategory Fbfbf', 'uploads/image/subcategory/1708516607.jpg', 1, 1, '127.0.0.1', 37, '2024-02-21 06:26:47', '2024-02-21 09:39:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `review` text DEFAULT NULL,
  `seq` int(11) DEFAULT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `image`, `review`, `seq`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Hello', 'uploads/image/testimonial/1708530267.jpg', 'cacacaca', NULL, '127.0.0.1', 37, '2024-02-21 10:14:27', '2024-02-21 10:14:48', '2024-02-21 10:14:48'),
(2, 'Fsfs', NULL, 'fsfsfs', 10, '127.0.0.1', 37, '2024-02-22 02:32:40', '2024-02-22 02:32:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE `types` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `mrp` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `gst_percentage` varchar(255) DEFAULT NULL,
  `selling_price` varchar(255) DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `inventory` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `image2` varchar(255) DEFAULT NULL,
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `attribute1` int(11) DEFAULT NULL,
  `attribute2` int(11) DEFAULT NULL,
  `attribute3` int(11) DEFAULT NULL,
  `attribute4` int(11) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `product_id`, `name`, `mrp`, `price`, `gst_percentage`, `selling_price`, `gst`, `inventory`, `image`, `image2`, `image3`, `image4`, `attribute1`, `attribute2`, `attribute3`, `attribute4`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'tt', '1500', '1545.45', '10', '1700', '154.55', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-20 17:09:03', '2024-02-20 10:13:46', '2024-02-04 18:30:00'),
(2, 1, 'gfsgs', '1500', '1545.45', '10', '1700', '154.55', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-20 15:43:46', '2024-02-20 10:13:46', '2024-02-20 10:13:46'),
(3, 2, 'cscsc', '1500', '1545.45', '10', '1700', '154.55', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-21 04:08:59', '2024-02-21 04:08:59', NULL),
(4, 2, 'cscsc', '1500', '1545.45', '10', '1700', '154.55', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-21 04:09:22', '2024-02-21 04:09:22', NULL),
(5, 2, 'cscsc', '1500', '1545.45', '10', '1700', '154.55', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-21 09:43:56', '2024-02-21 04:13:56', '2024-02-21 04:13:56'),
(6, 2, 'cscsc', '1500', '1545.45', '10', '1700', '154.55', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, '127.0.0.1', 37, '2024-02-21 09:42:22', '2024-02-21 04:12:22', '2024-02-21 04:12:22'),
(7, NULL, 'Product', NULL, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-21 06:56:09', '2024-02-21 06:58:07', NULL),
(8, 7, 'Type', '1500', '1545.45', '10', '1700', '154.55', 150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, '127.0.0.1', 37, '2024-02-21 08:07:50', '2024-02-21 09:40:37', NULL),
(9, 8, 'Vdvdv', '1500', '1545.45', '10', '1700', '154.55', 10, 'uploads/image/types/1708592585_65d70dc978e56.jpg', 'uploads/image/types/1708608560_65d74c30a7a2a.jpg', 'uploads/image/types/1708592585_65d70dc97a9c1.jpg', 'uploads/image/types/1708592585_65d70dc97adff.png', 3, 4, 5, NULL, 1, '127.0.0.1', 37, '2024-02-22 03:26:40', '2024-02-22 08:33:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1,
  `ip` varchar(255) DEFAULT NULL,
  `added_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `is_active`, `ip`, `added_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Nitesh', 'ns@gmail.com', '5181818181', '202cb962ac59075b964b07152d234b70', 1, '127.0.0.1', 37, '2024-02-21 08:59:46', '2024-02-20 07:55:24', '2024-02-11 18:30:00'),
(2, 'Nitesh', 'ns1@gmail.com', '4587458777', '202cb962ac59075b964b07152d234b70', 1, '127.0.0.1', 37, '2024-02-21 05:50:13', '2024-02-21 05:50:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_sidebar`
--
ALTER TABLE `admin_sidebar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_sidebar2`
--
ALTER TABLE `admin_sidebar2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_teams`
--
ALTER TABLE `admin_teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_attributes`
--
ALTER TABLE `master_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_types`
--
ALTER TABLE `master_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minorcategory`
--
ALTER TABLE `minorcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order1`
--
ALTER TABLE `order1`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order2`
--
ALTER TABLE `order2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `popup`
--
ALTER TABLE `popup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `popup_enquiry`
--
ALTER TABLE `popup_enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promocodes`
--
ALTER TABLE `promocodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders2`
--
ALTER TABLE `sliders2`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders3`
--
ALTER TABLE `sliders3`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders4`
--
ALTER TABLE `sliders4`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders5`
--
ALTER TABLE `sliders5`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_sidebar`
--
ALTER TABLE `admin_sidebar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `admin_sidebar2`
--
ALTER TABLE `admin_sidebar2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `admin_teams`
--
ALTER TABLE `admin_teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_attributes`
--
ALTER TABLE `master_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `master_types`
--
ALTER TABLE `master_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `minorcategory`
--
ALTER TABLE `minorcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order1`
--
ALTER TABLE `order1`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order2`
--
ALTER TABLE `order2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `popup`
--
ALTER TABLE `popup`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `popup_enquiry`
--
ALTER TABLE `popup_enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `promocodes`
--
ALTER TABLE `promocodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sliders2`
--
ALTER TABLE `sliders2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders3`
--
ALTER TABLE `sliders3`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders4`
--
ALTER TABLE `sliders4`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sliders5`
--
ALTER TABLE `sliders5`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `types`
--
ALTER TABLE `types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
