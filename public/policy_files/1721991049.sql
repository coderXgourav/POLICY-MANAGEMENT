-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 19, 2024 at 11:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `policy-management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_status`, `created_at`, `updated_at`) VALUES
(1, 'Gourav', 'gourav@gmail.com', '1234', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `status`, `created_at`, `updated_at`) VALUES
(2, 'IT', '0', '2024-07-11 02:30:35', '2024-07-11 02:30:35'),
(3, 'CST', '0', '2024-07-15 03:04:26', '2024-07-15 03:04:26'),
(7, 'ETC', '0', '2024-07-16 02:14:18', '2024-07-16 02:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_email` varchar(255) NOT NULL,
  `employee_number` varchar(255) NOT NULL,
  `department_id` varchar(255) NOT NULL,
  `employee_password` varchar(255) NOT NULL,
  `employee_policy_status` varchar(255) NOT NULL DEFAULT '0',
  `employee_status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_name`, `employee_email`, `employee_number`, `department_id`, `employee_password`, `employee_policy_status`, `employee_status`, `created_at`, `updated_at`) VALUES
(2, 'ABIR SAHA', 'abir@gmail.com', '1234567890', '4', '1234', '0', '0', '2024-07-15 03:05:04', '2024-07-15 03:05:04'),
(3, 'GOURAV', 'gouravcst@gmail.com', '6296665900', '3', '1234', '0', '0', '2024-07-15 03:05:32', '2024-07-15 03:05:32'),
(4, 'PRATIK', 'pratik@gmail.com', '1234567895', '2', '1234', '0', '0', '2024-07-15 03:06:26', '2024-07-15 03:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mcq`
--

CREATE TABLE `mcq` (
  `mcq_id` bigint(20) UNSIGNED NOT NULL,
  `main_policy_id` varchar(255) NOT NULL,
  `question` text NOT NULL,
  `option_a` text NOT NULL,
  `option_b` text NOT NULL,
  `option_c` text NOT NULL,
  `option_d` text NOT NULL,
  `ans` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq`
--

INSERT INTO `mcq` (`mcq_id`, `main_policy_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `ans`, `status`, `created_at`, `updated_at`) VALUES
(3, '1', 'what is best restaurant in kolkata', 'mirza', 'tabba', 'hoppo', 'thakki', 'B', 0, '2024-07-09 05:52:52', '2024-07-09 05:52:52'),
(4, '1', 'what is best restaurant in kolkata ?', 'mirza', 'tabba', 'hoppo', 'thakki', 'B', 0, '2024-07-09 05:53:30', '2024-07-09 05:53:30');

-- --------------------------------------------------------

--
-- Table structure for table `mcq_result`
--

CREATE TABLE `mcq_result` (
  `mcq_result_id` bigint(20) UNSIGNED NOT NULL,
  `main_policy_id` varchar(255) NOT NULL,
  `main_employee_id` varchar(255) NOT NULL,
  `marks` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mcq_result`
--

INSERT INTO `mcq_result` (`mcq_result_id`, `main_policy_id`, `main_employee_id`, `marks`, `date_time`, `created_at`, `updated_at`) VALUES
(13, '1', '3', '10', '31:05:07 19-07-2024', '2024-07-19 01:35:31', '2024-07-19 01:35:31'),
(14, '1', '3', '10', '25:53:07 19-07-2024', '2024-07-19 02:23:25', '2024-07-19 02:23:25');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(7, '2024_06_21_061728_create_admin_table', 4),
(12, '2024_07_08_065519_create_mcq_table', 7),
(14, '2024_07_09_080213_create_pass_mark_table', 8),
(15, '2024_07_04_070750_create_policy_table', 9),
(16, '2024_07_11_063728_create_department_table', 10),
(18, '2024_06_21_063525_create_employee_table', 11),
(20, '2024_07_12_065110_create_policy_assign_to_employee_table', 12),
(21, '2024_07_15_095923_create_policy_assign_to_group_table', 13),
(22, '2024_07_18_123214_create_mcq_result_table', 14);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pass_mark`
--

CREATE TABLE `pass_mark` (
  `pass_mark_id` bigint(20) UNSIGNED NOT NULL,
  `policy_main_id` varchar(255) NOT NULL,
  `pass_mark` int(11) NOT NULL,
  `mark_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pass_mark`
--

INSERT INTO `pass_mark` (`pass_mark_id`, `policy_main_id`, `pass_mark`, `mark_status`, `created_at`, `updated_at`) VALUES
(6, '1', 2, 0, '2024-07-10 02:14:59', '2024-07-10 02:14:59');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `policy_id` bigint(20) UNSIGNED NOT NULL,
  `policy_title` text NOT NULL,
  `policy_file` text NOT NULL,
  `pass_mark_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`policy_id`, `policy_title`, `policy_file`, `pass_mark_status`, `created_at`, `updated_at`) VALUES
(1, 'time management', '1720512705.pdf', 1, '2024-07-09 02:41:45', '2024-07-10 02:14:59'),
(2, 'SALLERY POLICY', '1721204032.pdf', 0, '2024-07-17 02:43:52', '2024-07-17 02:43:52'),
(3, 'DEVICE RULES', '1721204828.png', 0, '2024-07-17 02:57:08', '2024-07-17 02:57:08');

-- --------------------------------------------------------

--
-- Table structure for table `policy_assign_to_employee`
--

CREATE TABLE `policy_assign_to_employee` (
  `policy_assign_to_employee_id` bigint(20) UNSIGNED NOT NULL,
  `main_department_id` varchar(255) NOT NULL,
  `main_employee_id` varchar(255) NOT NULL,
  `main_policy_id` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policy_assign_to_employee`
--

INSERT INTO `policy_assign_to_employee` (`policy_assign_to_employee_id`, `main_department_id`, `main_employee_id`, `main_policy_id`, `status`, `created_at`, `updated_at`) VALUES
(2, '3', '3', '1', 0, '2024-07-15 03:25:36', '2024-07-15 03:25:36'),
(3, '3', '3', '3', 0, '2024-07-17 02:57:26', '2024-07-17 02:57:26');

-- --------------------------------------------------------

--
-- Table structure for table `policy_assign_to_group`
--

CREATE TABLE `policy_assign_to_group` (
  `policy_assign_to_group_id` bigint(20) UNSIGNED NOT NULL,
  `main_department_id` varchar(255) NOT NULL,
  `main_policy_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policy_assign_to_group`
--

INSERT INTO `policy_assign_to_group` (`policy_assign_to_group_id`, `main_department_id`, `main_policy_id`, `created_at`, `updated_at`) VALUES
(1, '3', '1', '2024-07-15 05:06:57', '2024-07-15 05:06:57'),
(2, '4', '1', '2024-07-15 05:07:13', '2024-07-15 05:07:13'),
(3, '3', '2', '2024-07-17 02:44:35', '2024-07-17 02:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `mcq`
--
ALTER TABLE `mcq`
  ADD PRIMARY KEY (`mcq_id`);

--
-- Indexes for table `mcq_result`
--
ALTER TABLE `mcq_result`
  ADD PRIMARY KEY (`mcq_result_id`);

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
-- Indexes for table `pass_mark`
--
ALTER TABLE `pass_mark`
  ADD PRIMARY KEY (`pass_mark_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`policy_id`);

--
-- Indexes for table `policy_assign_to_employee`
--
ALTER TABLE `policy_assign_to_employee`
  ADD PRIMARY KEY (`policy_assign_to_employee_id`);

--
-- Indexes for table `policy_assign_to_group`
--
ALTER TABLE `policy_assign_to_group`
  ADD PRIMARY KEY (`policy_assign_to_group_id`);

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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mcq`
--
ALTER TABLE `mcq`
  MODIFY `mcq_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `mcq_result`
--
ALTER TABLE `mcq_result`
  MODIFY `mcq_result_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `pass_mark`
--
ALTER TABLE `pass_mark`
  MODIFY `pass_mark_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `policy_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `policy_assign_to_employee`
--
ALTER TABLE `policy_assign_to_employee`
  MODIFY `policy_assign_to_employee_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `policy_assign_to_group`
--
ALTER TABLE `policy_assign_to_group`
  MODIFY `policy_assign_to_group_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
