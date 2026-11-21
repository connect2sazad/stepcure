-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2026 at 04:53 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stepcure`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_states`
--

CREATE TABLE `address_states` (
  `id` int(11) NOT NULL,
  `state_name` varchar(50) NOT NULL,
  `state_code` char(3) NOT NULL,
  `gst_code` int(11) NOT NULL,
  `last_id` varchar(10) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '	0=present,1=deleted',
  `remarks` varchar(100) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `address_states`
--

INSERT INTO `address_states` (`id`, `state_name`, `state_code`, `gst_code`, `last_id`, `is_active`, `is_deleted`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Andhra Pradesh', 'AP', 37, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(2, 'Arunachal Pradesh', 'AR', 12, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(3, 'Assam', 'AS', 18, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(4, 'Bihar', 'BR', 10, '01', 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(5, 'Chhattisgarh', 'CG', 22, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(6, 'Goa', 'GA', 30, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(7, 'Gujarat', 'GJ', 24, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(8, 'Haryana', 'HR', 6, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(9, 'Himachal Pradesh', 'HP', 2, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(10, 'Jharkhand', 'JH', 20, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(11, 'Karnataka', 'KA', 29, '01', 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(12, 'Kerala', 'KL', 32, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(13, 'Madhya Pradesh', 'MP', 23, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(14, 'Maharashtra', 'MH', 27, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(15, 'Manipur', 'MN', 14, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(16, 'Meghalaya', 'ML', 17, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(17, 'Mizoram', 'MZ', 15, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(18, 'Nagaland', 'NL', 13, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(19, 'Odisha', 'OD', 21, '06', 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(20, 'Punjab', 'PB', 3, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(21, 'Rajasthan', 'RJ', 8, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(22, 'Sikkim', 'SK', 11, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(23, 'Tamil Nadu', 'TN', 33, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(24, 'Telangana', 'TG', 36, '05', 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(25, 'Tripura', 'TR', 16, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(26, 'Uttar Pradesh', 'UP', 9, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(27, 'Uttarakhand', 'UK', 5, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(28, 'West Bengal', 'WB', 19, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(29, 'Andaman and Nicobar Islands', 'AN', 35, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(30, 'Chandigarh', 'CH', 4, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(31, 'Dadra and Nagar Haveli and Daman and Diu', 'DN', 26, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(32, 'Delhi', 'DL', 7, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(33, 'Jammu and Kashmir', 'JK', 1, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:08:43'),
(34, 'Ladakh', 'LA', 38, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(35, 'Lakshadweep', 'LD', 31, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33'),
(36, 'Puducherry', 'PY', 34, NULL, 1, 0, '', 1, 1, '2025-07-08 20:43:11', '2025-10-07 02:20:33');

-- --------------------------------------------------------

--
-- Table structure for table `admin_updates`
--

CREATE TABLE `admin_updates` (
  `id` int(11) NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `update_text` mediumtext NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_updates`
--

INSERT INTO `admin_updates` (`id`, `updated_by`, `update_text`, `updated_at`, `created_at`) VALUES
(3, '1', 'Added a new User Group Admin for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://projects.lyncdigit.com/stepcure/admin/user-groups?id=44\">Check</a>', '2025-08-22 18:59:15', '2025-08-22 18:59:15'),
(4, '1', 'Updated User Group <b>Admin</b> successfully. <a target=\"_blank\" href=\"https://projects.lyncdigit.com/stepcure/admin/user-groups?id=44\">View</a>', '2025-08-22 18:59:42', '2025-08-22 18:59:42'),
(5, '1', 'Updated User Group <b>Admin</b> successfully. <a target=\"_blank\" href=\"https://projects.lyncdigit.com/stepcure/admin/user-groups?id=44\">View</a>', '2025-08-22 19:00:20', '2025-08-22 19:00:20'),
(6, '1', 'Updated User Group <b>Admin</b> successfully. <a target=\"_blank\" href=\"https://projects.lyncdigit.com/stepcure/admin/user-groups?id=44\">View</a>', '2025-08-22 19:00:32', '2025-08-22 19:00:32'),
(15, '13', 'Updated details for the site \"Hyderabad Site\". <a target=\"_blank\" href=\"https://projects.lyncdigit.com/stepcure/admin/treatment-sites/?id=34\">View all details</a>!', '2025-08-22 19:02:29', '2025-08-22 19:02:29'),
(16, '13', 'Updated details for the site \"Hyderabad Site\". <a target=\"_blank\" href=\"https://projects.lyncdigit.com/stepcure/admin/treatment-sites/?id=34\">View all details</a>!', '2025-08-22 19:03:29', '2025-08-22 19:03:29'),
(17, '13', 'Updated details for the site \"Hyderabad Site\". <a target=\"_blank\" href=\"https://projects.lyncdigit.com/stepcure/admin/treatment-sites/?id=34\">View all details</a>!', '2025-08-22 19:06:34', '2025-08-22 19:06:34'),
(27, '1', 'Added a new User Designation Doctor for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/user-designations?id=1\">Check</a>', '2025-08-22 19:36:21', '2025-08-22 19:36:21'),
(28, '1', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=admin\">@admin (StepCure )</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=13\">Check</a>', '2025-08-22 19:36:44', '2025-08-22 19:36:44'),
(29, '1', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=admin\">@admin (StepCure )</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=13\">Check</a>', '2025-08-22 19:38:16', '2025-08-22 19:38:16'),
(30, '1', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=admin\">@admin (StepCure )</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=13\">Check</a>', '2025-08-22 19:48:49', '2025-08-22 19:48:49'),
(31, '1', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=admin\">@admin (StepCure )</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=13\">Check</a>', '2025-08-22 19:52:16', '2025-08-22 19:52:16'),
(32, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=max\">@max (Max Planck)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=20\">Check</a>', '2025-08-22 19:53:14', '2025-08-22 19:53:14'),
(33, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=pvroq7j0\">@pvroq7j0 (Pravat Panda)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=21\">Check</a>', '2025-08-22 19:53:36', '2025-08-22 19:53:36'),
(34, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=_nehapal_\">@_nehapal_ (Nehapal Joshna)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=23\">Check</a>', '2025-08-22 19:53:58', '2025-08-22 19:53:58'),
(45, '13', 'Added a new site StepCure Odisha 2 for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/treatment-sites?id=36\">Check</a>', '2025-08-22 20:03:05', '2025-08-22 20:03:05'),
(46, '13', 'Updated User Group <b>Staffs</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=24\">View</a>', '2025-08-22 20:04:03', '2025-08-22 20:04:03'),
(47, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=max\">@max (Max Planck)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=20\">Check</a>', '2025-08-22 20:04:35', '2025-08-22 20:04:35'),
(48, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=amit\">@amit (Amit Shukla)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=14\">Check</a>', '2025-08-22 20:05:17', '2025-08-22 20:05:17'),
(53, '14', 'Added a new patient Sazad Ahemad for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=1\">Check</a>', '2025-08-22 20:06:16', '2025-08-22 20:06:16'),
(69, '14', 'Added Consultation (CI-001) for PI-001 - Sazad Ahemad (UHID: 123456789000) with Dr. Amit Shukla (@amit)', '2025-08-22 20:07:32', '2025-08-22 20:07:32'),
(79, '14', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=1\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250823013837_CI-001.pdf\">View Finalized Report</a>!', '2025-08-22 20:08:38', '2025-08-22 20:08:38'),
(114, '13', 'Added a new product_category Test for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/product-categories?id=1&view\">Check</a>', '2025-08-22 20:09:51', '2025-08-22 20:09:51'),
(115, '13', 'Added a new product Test Product for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/products?id=1&view\">Check</a>', '2025-08-22 20:12:45', '2025-08-22 20:12:45'),
(125, '1', 'Added 10 units of stock for Product: Test Product at Site: SC-OD-ODI-04', '2025-08-22 20:14:34', '2025-08-22 20:14:34'),
(134, '1', 'Added 10 units of stock for Product: Test Product at Site: SC-OD-KHO-06', '2025-08-22 20:15:18', '2025-08-22 20:15:18'),
(135, '13', 'Added a new product Product 2 for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/products?id=2&view\">Check</a>', '2025-08-22 20:16:56', '2025-08-22 20:16:56'),
(144, '1', 'Added 10 units of stock for Product: Product 2 at Site: SC-OD-KHO-06', '2025-08-22 20:17:44', '2025-08-22 20:17:44'),
(172, '14', 'Sale Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250823015013_SI-001.pdf\">View Invoice</a>!', '2025-08-22 20:20:13', '2025-08-22 20:20:13'),
(213, '13', 'Added a new site AED HOSPITAL for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/treatment-sites?id=37\">Check</a>', '2025-08-23 03:36:58', '2025-08-23 03:36:58'),
(214, '13', 'Updated details for the site \"AED HOSPITAL\". <a target=\"_blank\" href=\"https://stepcure.co/admin/treatment-sites/?id=37\">View all details</a>!', '2025-08-23 03:37:16', '2025-08-23 03:37:16'),
(215, '13', 'Updated details for the site \"AED HOSPITAL\". <a target=\"_blank\" href=\"https://stepcure.co/admin/treatment-sites/?id=37\">View all details</a>!', '2025-08-23 03:37:21', '2025-08-23 03:37:21'),
(216, '13', 'Updated details for the site \"Advanced Endocrine & Diabetic Hospital\". <a target=\"_blank\" href=\"https://stepcure.co/admin/treatment-sites/?id=37\">View all details</a>!', '2025-08-23 03:39:33', '2025-08-23 03:39:33'),
(217, '13', 'Updated details for the site \"Advanced Endocrine & Diabetic Hospital\". <a target=\"_blank\" href=\"https://stepcure.co/admin/treatment-sites/?id=37\">View all details</a>!', '2025-08-23 03:40:16', '2025-08-23 03:40:16'),
(218, '13', 'Updated details for the site \"Advanced Endocrine & Diabetic Hospital\". <a target=\"_blank\" href=\"https://stepcure.co/admin/treatment-sites/?id=37\">View all details</a>!', '2025-08-23 03:40:19', '2025-08-23 03:40:19'),
(219, '13', 'Added a new User Group ORTHOTIST for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=45\">Check</a>', '2025-08-23 03:42:38', '2025-08-23 03:42:38'),
(220, '13', 'Updated User Group <b>ORTHOTIST</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=45\">View</a>', '2025-08-23 03:42:54', '2025-08-23 03:42:54'),
(221, '13', 'Added a new User Designation Prosthetist & Orthotist for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/user-designations?id=2\">Check</a>', '2025-08-23 03:44:01', '2025-08-23 03:44:01'),
(222, '13', 'Added a new User Group MANAGER for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=46\">Check</a>', '2025-08-23 03:54:20', '2025-08-23 03:54:20'),
(223, '13', 'Updated User Group <b>MANAGER</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=46\">View</a>', '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(224, '13', 'Added a new User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-08-23 04:00:05', '2025-08-23 04:00:05'),
(225, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-08-23 04:00:32', '2025-08-23 04:00:32'),
(230, '25', 'Added a new patient AYANTRAS BARIK for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=2\">Check</a>', '2025-08-23 04:03:41', '2025-08-23 04:03:41'),
(241, '25', 'Added Consultation (CI-002) for PI-002 - AYANTRAS BARIK (UHID: 00001) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-23 04:09:35', '2025-08-23 04:09:35'),
(242, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=2\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250823094159_CI-002.pdf\">View Finalized Report</a>!', '2025-08-23 04:12:12', '2025-08-23 04:12:12'),
(243, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-08-23 04:14:58', '2025-08-23 04:14:58'),
(244, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-08-23 04:20:41', '2025-08-23 04:20:41'),
(245, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-08-23 04:20:42', '2025-08-23 04:20:42'),
(273, '25', 'Updated details for the patient \"AYANTRAS BARIK\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=2\">View all details</a>!', '2025-08-23 04:23:02', '2025-08-23 04:23:02'),
(274, '25', 'Updated details for the patient \"AYANTRAS BARIK\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=2\">View all details</a>!', '2025-08-23 04:23:03', '2025-08-23 04:23:03'),
(280, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=2\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250823095318_CI-002.pdf\">View Finalized Report</a>!', '2025-08-23 04:23:32', '2025-08-23 04:23:32'),
(285, '25', 'Added a new patient MARIYAMMA P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=3\">Check</a>', '2025-08-23 06:22:57', '2025-08-23 06:22:57'),
(299, '25', 'Added Consultation (CI-003) for PI-003 - MARIYAMMA P (UHID: 57098) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-23 06:24:03', '2025-08-23 06:24:03'),
(300, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=3\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250823121139_CI-003.pdf\">View Finalized Report</a>!', '2025-08-23 06:41:52', '2025-08-23 06:41:52'),
(312, '25', 'Added a new patient IPSHITA  P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=4\">Check</a>', '2025-08-23 06:50:11', '2025-08-23 06:50:11'),
(319, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-08-23 06:58:22', '2025-08-23 06:58:22'),
(320, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-08-23 06:58:32', '2025-08-23 06:58:32'),
(327, '25', 'Added a new User Designation CENTER INCHARGE for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/user-designations?id=3\">Check</a>', '2025-08-23 07:01:05', '2025-08-23 07:01:05'),
(344, '25', 'Added a new patient RAVI KUMAR k for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=5\">Check</a>', '2025-08-23 11:23:35', '2025-08-23 11:23:35'),
(350, '25', 'Added Consultation (CI-004) for PI-005 - RAVI KUMAR k (UHID: 057108) with    (@)', '2025-08-23 11:23:51', '2025-08-23 11:23:51'),
(351, '25', 'Added Consultation (CI-005) for PI-005 - RAVI KUMAR k (UHID: 057108) with    (@)', '2025-08-23 11:23:58', '2025-08-23 11:23:58'),
(352, '25', 'Added Consultation (CI-006) for PI-005 - RAVI KUMAR k (UHID: 057108) with    (@)', '2025-08-23 11:24:03', '2025-08-23 11:24:03'),
(358, '25', 'Added Consultation (CI-007) for PI-005 - RAVI KUMAR k (UHID: 057108) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-23 11:24:33', '2025-08-23 11:24:33'),
(359, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=7\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250823051217_CI-007.pdf\">View Finalized Report</a>!', '2025-08-23 11:42:31', '2025-08-23 11:42:31'),
(368, '25', 'Updated User Group <b>Admin</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=44\">View</a>', '2025-08-23 11:53:47', '2025-08-23 11:53:47'),
(369, '25', 'Updated User Group <b>Adminstrator</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=44\">View</a>', '2025-08-23 11:54:15', '2025-08-23 11:54:15'),
(374, '25', 'Updated User Group <b>ORTHOTIST</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=45\">View</a>', '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(379, '25', 'Added a new User Group Admin for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=47\">Check</a>', '2025-08-23 11:57:03', '2025-08-23 11:57:03'),
(380, '25', 'Updated User Group <b>Admin</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=47\">View</a>', '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(392, '25', 'Added a new User Group CENTER INCHARGE for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=48\">Check</a>', '2025-08-23 12:00:00', '2025-08-23 12:00:00'),
(393, '25', 'Updated User Group <b>CENTER INCHARGE</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=48\">View</a>', '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(412, '25', 'Added a new User Designation ADMIN for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/user-designations?id=4\">Check</a>', '2025-08-23 12:01:27', '2025-08-23 12:01:27'),
(436, '1', 'Updated User Group <b>Adminstrator</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=44\">View</a>', '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(476, '25', 'Added a new patient JOSHUVA  VIKAS A for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=6\">Check</a>', '2025-08-25 05:50:28', '2025-08-25 05:50:28'),
(482, '25', 'Added Consultation (CI-008) for PI-006 - JOSHUVA  VIKAS A (UHID: 57118) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-25 05:50:53', '2025-08-25 05:50:53'),
(483, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=8\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250825113346_CI-008.pdf\">View Finalized Report</a>!', '2025-08-25 06:03:59', '2025-08-25 06:03:59'),
(488, '25', 'Added a new patient AMMAJI  KEDARASI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=7\">Check</a>', '2025-08-25 07:49:44', '2025-08-25 07:49:44'),
(494, '25', 'Added Consultation (CI-009) for PI-007 - AMMAJI  KEDARASI (UHID: 57125) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-25 07:50:09', '2025-08-25 07:50:09'),
(495, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=9\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250825013008_CI-009.pdf\">View Finalized Report</a>!', '2025-08-25 08:00:22', '2025-08-25 08:00:22'),
(509, '25', 'Added a new patient PUSHPA VENI S for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=8\">Check</a>', '2025-08-26 05:10:52', '2025-08-26 05:10:52'),
(515, '25', 'Added Consultation (CI-010) for PI-008 - PUSHPA VENI S (UHID: 041648) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-26 05:11:07', '2025-08-26 05:11:07'),
(516, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=10\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250826105054_CI-010.pdf\">View Finalized Report</a>!', '2025-08-26 05:21:08', '2025-08-26 05:21:08'),
(522, '25', 'Added a new patient LAKSHMI  DEVI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=9\">Check</a>', '2025-08-26 08:32:15', '2025-08-26 08:32:15'),
(528, '25', 'Added Consultation (CI-011) for PI-009 - LAKSHMI  DEVI (UHID: 027650) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-26 08:32:37', '2025-08-26 08:32:37'),
(529, '25', 'Added Consultation (CI-012) for PI-009 - LAKSHMI  DEVI (UHID: 027650) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-26 08:32:38', '2025-08-26 08:32:38'),
(530, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=12\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250826021501_CI-012.pdf\">View Finalized Report</a>!', '2025-08-26 08:45:14', '2025-08-26 08:45:14'),
(538, '25', 'Added a new patient SUKKMMA  DASARI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=10\">Check</a>', '2025-08-26 09:36:38', '2025-08-26 09:36:38'),
(544, '25', 'Added Consultation (CI-013) for PI-010 - SUKKMMA  DASARI (UHID: 07492) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-26 09:37:00', '2025-08-26 09:37:00'),
(545, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=13\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250826031952_CI-013.pdf\">View Finalized Report</a>!', '2025-08-26 09:50:07', '2025-08-26 09:50:07'),
(550, '25', 'Added a new patient PRAVEEN KUMAR V for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=11\">Check</a>', '2025-08-28 05:08:32', '2025-08-28 05:08:32'),
(556, '25', 'Added Consultation (CI-014) for PI-011 - PRAVEEN KUMAR V (UHID: 036377) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-28 05:10:03', '2025-08-28 05:10:03'),
(557, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=14\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250828104834_CI-014.pdf\">View Finalized Report</a>!', '2025-08-28 05:18:48', '2025-08-28 05:18:48'),
(643, '25', 'Added a new patient ANURADHA  NOOKALA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=12\">Check</a>', '2025-08-29 06:57:04', '2025-08-29 06:57:04'),
(649, '25', 'Added Consultation (CI-015) for PI-012 - ANURADHA  NOOKALA (UHID: 57169) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-29 06:57:31', '2025-08-29 06:57:31'),
(650, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=15\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250829124154_CI-015.pdf\">View Finalized Report</a>!', '2025-08-29 07:12:07', '2025-08-29 07:12:07'),
(651, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=15\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250829124154_CI-015.pdf\">View Finalized Report</a>!', '2025-08-29 07:12:08', '2025-08-29 07:12:08'),
(655, '25', 'Added a new patient SUJATHA N for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=13\">Check</a>', '2025-08-29 07:15:43', '2025-08-29 07:15:43'),
(661, '25', 'Added Consultation (CI-016) for PI-013 - SUJATHA N (UHID: 57172) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-29 07:15:59', '2025-08-29 07:15:59'),
(662, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=16\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250829125716_CI-016.pdf\">View Finalized Report</a>!', '2025-08-29 07:27:29', '2025-08-29 07:27:29'),
(667, '25', 'Added a new patient ANIL  KUMAR V for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=14\">Check</a>', '2025-08-29 08:26:08', '2025-08-29 08:26:08'),
(673, '25', 'Added Consultation (CI-017) for PI-014 - ANIL  KUMAR V (UHID: 38658) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-29 08:26:55', '2025-08-29 08:26:55'),
(674, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=17\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250829021536_CI-017.pdf\">View Finalized Report</a>!', '2025-08-29 08:45:49', '2025-08-29 08:45:49'),
(683, '25', 'Added a new patient VENKATA SURESH KUMAR  YELLA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=15\">Check</a>', '2025-08-30 05:24:46', '2025-08-30 05:24:46'),
(689, '25', 'Added Consultation (CI-018) for PI-015 - VENKATA SURESH KUMAR  YELLA (UHID: 57180) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-30 05:54:56', '2025-08-30 05:54:56'),
(690, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=18\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250830112529_CI-018.pdf\">View Finalized Report</a>!', '2025-08-30 05:55:42', '2025-08-30 05:55:42'),
(694, '25', 'Added a new patient LILLY MERUGA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=16\">Check</a>', '2025-08-30 06:14:14', '2025-08-30 06:14:14'),
(700, '25', 'Added Consultation (CI-019) for PI-016 - LILLY MERUGA (UHID: 57182) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-30 06:14:43', '2025-08-30 06:14:43'),
(701, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=19\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250830120121_CI-019.pdf\">View Finalized Report</a>!', '2025-08-30 06:31:34', '2025-08-30 06:31:34'),
(706, '25', 'Added a new patient RAJASEKHAR B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=17\">Check</a>', '2025-08-30 07:24:38', '2025-08-30 07:24:38'),
(718, '25', 'Added Consultation (CI-020) for PI-017 - RAJASEKHAR B (UHID: 56808) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-30 07:24:51', '2025-08-30 07:24:51'),
(719, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=20\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250830010814_CI-020.pdf\">View Finalized Report</a>!', '2025-08-30 07:38:27', '2025-08-30 07:38:27'),
(747, '25', 'Added a new patient AKASH  ARE for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=18\">Check</a>', '2025-08-30 09:28:30', '2025-08-30 09:28:30'),
(753, '25', 'Added Consultation (CI-021) for PI-018 - AKASH  ARE (UHID: 57192) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-30 09:28:45', '2025-08-30 09:28:45'),
(754, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=21\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250830030828_CI-021.pdf\">View Finalized Report</a>!', '2025-08-30 09:38:41', '2025-08-30 09:38:41'),
(759, '25', 'Added a new patient MANDA  D for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=19\">Check</a>', '2025-08-30 10:40:08', '2025-08-30 10:40:08'),
(765, '25', 'Added Consultation (CI-022) for PI-019 - MANDA  D (UHID: 57197) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-30 10:40:20', '2025-08-30 10:40:20'),
(766, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=22\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250830043102_CI-022.pdf\">View Finalized Report</a>!', '2025-08-30 11:01:16', '2025-08-30 11:01:16'),
(770, '25', 'Added a new patient SRINIVASA RAO CHAVA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=20\">Check</a>', '2025-08-30 11:05:34', '2025-08-30 11:05:34'),
(776, '25', 'Added Consultation (CI-023) for PI-020 - SRINIVASA RAO CHAVA (UHID: 57198) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-08-30 11:06:21', '2025-08-30 11:06:21'),
(777, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=23\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250830045844_CI-023.pdf\">View Finalized Report</a>!', '2025-08-30 11:28:57', '2025-08-30 11:28:57'),
(785, '25', 'Added a new patient DURGA  G for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=21\">Check</a>', '2025-09-01 05:37:06', '2025-09-01 05:37:06'),
(791, '25', 'Added Consultation (CI-024) for PI-021 - DURGA  G (UHID: 19466) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-01 05:37:26', '2025-09-01 05:37:26'),
(792, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=24\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250901112435_CI-024.pdf\">View Finalized Report</a>!', '2025-09-01 05:54:49', '2025-09-01 05:54:49'),
(797, '25', 'Added a new patient ARUNA KUMARI BAI  S for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=22\">Check</a>', '2025-09-01 07:07:12', '2025-09-01 07:07:12'),
(803, '25', 'Added Consultation (CI-025) for PI-022 - ARUNA KUMARI BAI  S (UHID: 057203) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-01 07:07:35', '2025-09-01 07:07:35'),
(804, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=25\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250901125336_CI-025.pdf\">View Finalized Report</a>!', '2025-09-01 07:23:50', '2025-09-01 07:23:50'),
(809, '25', 'Added a new patient LAXMI  B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=23\">Check</a>', '2025-09-01 11:52:26', '2025-09-01 11:52:26'),
(815, '25', 'Added Consultation (CI-026) for PI-023 - LAXMI  B (UHID: 048881) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-01 11:53:34', '2025-09-01 11:53:34'),
(816, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=26\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250901054423_CI-026.pdf\">View Finalized Report</a>!', '2025-09-01 12:14:37', '2025-09-01 12:14:37'),
(820, '25', 'Added a new patient RAJESH  SHERVIRALA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=24\">Check</a>', '2025-09-01 12:20:00', '2025-09-01 12:20:00'),
(826, '25', 'Added Consultation (CI-027) for PI-024 - RAJESH  SHERVIRALA (UHID: 057214) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-01 12:20:13', '2025-09-01 12:20:13'),
(827, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=27\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250901061424_CI-027.pdf\">View Finalized Report</a>!', '2025-09-01 12:44:37', '2025-09-01 12:44:37'),
(828, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=27\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250901061424_CI-027.pdf\">View Finalized Report</a>!', '2025-09-01 12:44:37', '2025-09-01 12:44:37'),
(836, '25', 'Added a new patient NAGAVANI  CHANDOLU for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=25\">Check</a>', '2025-09-02 05:31:24', '2025-09-02 05:31:24'),
(842, '25', 'Added Consultation (CI-028) for PI-025 - NAGAVANI  CHANDOLU (UHID: 57225) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-02 05:31:40', '2025-09-02 05:31:40'),
(843, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=28\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250902110902_CI-028.pdf\">View Finalized Report</a>!', '2025-09-02 05:39:16', '2025-09-02 05:39:16'),
(847, '25', 'Added a new patient CHANDANA  K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=26\">Check</a>', '2025-09-02 05:59:05', '2025-09-02 05:59:05'),
(853, '25', 'Added Consultation (CI-029) for PI-026 - CHANDANA  K (UHID: 57224) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-02 05:59:20', '2025-09-02 05:59:20'),
(854, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=29\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250902114246_CI-029.pdf\">View Finalized Report</a>!', '2025-09-02 06:13:00', '2025-09-02 06:13:00'),
(858, '25', 'Added a new patient RANI  YALAVARTHY for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=27\">Check</a>', '2025-09-02 06:22:28', '2025-09-02 06:22:28'),
(864, '25', 'Added Consultation (CI-030) for PI-027 - RANI  YALAVARTHY (UHID: 57226) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-02 06:22:41', '2025-09-02 06:22:41'),
(865, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=30\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250902120134_CI-030.pdf\">View Finalized Report</a>!', '2025-09-02 06:31:48', '2025-09-02 06:31:48'),
(866, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=30\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250902120134_CI-030.pdf\">View Finalized Report</a>!', '2025-09-02 06:31:48', '2025-09-02 06:31:48'),
(870, '25', 'Added a new patient VENKATA RAMANA GANTENA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=28\">Check</a>', '2025-09-02 06:43:06', '2025-09-02 06:43:06'),
(876, '25', 'Added Consultation (CI-031) for PI-028 - VENKATA RAMANA GANTENA (UHID: 57228) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-02 06:43:26', '2025-09-02 06:43:26'),
(877, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=31\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250902122408_CI-031.pdf\">View Finalized Report</a>!', '2025-09-02 06:54:24', '2025-09-02 06:54:24'),
(886, '25', 'Updated details for the patient \"NAGAVANI  CHANDOLU\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=25\">View all details</a>!', '2025-09-02 07:06:33', '2025-09-02 07:06:33'),
(887, '25', 'Updated details for the patient \"NAGAVANI  CHANDOLU\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=25\">View all details</a>!', '2025-09-02 07:06:37', '2025-09-02 07:06:37'),
(888, '25', 'Updated details for the patient \"NAGAVANI  CHANDOLU\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=25\">View all details</a>!', '2025-09-02 07:06:44', '2025-09-02 07:06:44'),
(889, '25', 'Updated details for the patient \"NAGAVANI  CHANDOLU\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=25\">View all details</a>!', '2025-09-02 07:06:53', '2025-09-02 07:06:53'),
(897, '25', 'Added a new patient RAMASHARMA A.V for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=29\">Check</a>', '2025-09-02 08:36:34', '2025-09-02 08:36:34'),
(903, '25', 'Added Consultation (CI-032) for PI-029 - RAMASHARMA A.V (UHID: 29236) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-02 08:37:22', '2025-09-02 08:37:22'),
(904, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=32\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250902021907_CI-032.pdf\">View Finalized Report</a>!', '2025-09-02 08:49:21', '2025-09-02 08:49:21'),
(909, '25', 'Added a new patient NARESH KUMAR CH for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=30\">Check</a>', '2025-09-02 09:38:40', '2025-09-02 09:38:40'),
(915, '25', 'Added Consultation (CI-033) for PI-030 - NARESH KUMAR CH (UHID: 57029) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-02 09:41:49', '2025-09-02 09:41:49'),
(916, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=33\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250902031558_CI-033.pdf\">View Finalized Report</a>!', '2025-09-02 09:46:11', '2025-09-02 09:46:11'),
(927, '25', 'Added a new patient SATHAIAH  G for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=31\">Check</a>', '2025-09-02 13:05:51', '2025-09-02 13:05:51'),
(933, '25', 'Added Consultation (CI-034) for PI-031 - SATHAIAH  G (UHID: 57238) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-02 13:06:23', '2025-09-02 13:06:23'),
(934, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=34\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250902065139_CI-034.pdf\">View Finalized Report</a>!', '2025-09-02 13:21:52', '2025-09-02 13:21:52'),
(962, '25', 'Added a new patient RAJA SEKHAR  TALPURI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=32\">Check</a>', '2025-09-03 05:09:03', '2025-09-03 05:09:03'),
(973, '25', 'Added Consultation (CI-035) for PI-032 - RAJA SEKHAR  TALPURI (UHID: 57239) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-03 05:09:33', '2025-09-03 05:09:33'),
(974, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=35\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250903105557_CI-035.pdf\">View Finalized Report</a>!', '2025-09-03 05:26:12', '2025-09-03 05:26:12'),
(978, '25', 'Added a new patient SRIHITHA  MOVVA  for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=33\">Check</a>', '2025-09-03 05:43:41', '2025-09-03 05:43:41'),
(984, '25', 'Added Consultation (CI-036) for PI-033 - SRIHITHA  MOVVA  (UHID: 57241) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-03 05:44:19', '2025-09-03 05:44:19'),
(985, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=36\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250903112322_CI-036.pdf\">View Finalized Report</a>!', '2025-09-03 05:53:39', '2025-09-03 05:53:39'),
(991, '25', 'Added a new patient RAJESH K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=34\">Check</a>', '2025-09-03 12:36:07', '2025-09-03 12:36:07'),
(997, '25', 'Added Consultation (CI-037) for PI-034 - RAJESH K (UHID: 057221) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-03 12:36:29', '2025-09-03 12:36:29'),
(998, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=37\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250903060721_CI-037.pdf\">View Finalized Report</a>!', '2025-09-03 12:37:34', '2025-09-03 12:37:34'),
(1018, '14', 'Added Consultation (CI-038) for PI-001 - Sazad Ahemad (UHID: 123456789000) with Dr. Amit Shukla (@amit)', '2025-09-05 12:05:23', '2025-09-05 12:05:23'),
(1029, '14', 'Added a new patient Sazad2 Ahemad2 for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=35\">Check</a>', '2025-09-05 12:08:52', '2025-09-05 12:08:52'),
(1035, '14', 'Added Consultation (CI-039) for PI-035 - Sazad2 Ahemad2 (UHID: 123456789123) with Dr. Amit Shukla (@amit)', '2025-09-05 12:09:31', '2025-09-05 12:09:31'),
(1057, '1', 'Updated User Group <b>Staffs</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=24\">View</a>', '2025-09-05 12:23:12', '2025-09-05 12:23:12'),
(1094, '25', 'Added a new patient RAHEEM KHAN MD for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=36\">Check</a>', '2025-09-06 05:49:07', '2025-09-06 05:49:07'),
(1100, '25', 'Added Consultation (CI-040) for PI-036 - RAHEEM KHAN MD (UHID: 057269) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 05:49:20', '2025-09-06 05:49:20'),
(1101, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=40\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906112855_CI-040.pdf\">View Finalized Report</a>!', '2025-09-06 05:59:07', '2025-09-06 05:59:07'),
(1105, '25', 'Added a new patient SWARAJYAM  D for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=37\">Check</a>', '2025-09-06 06:09:32', '2025-09-06 06:09:32'),
(1111, '25', 'Added Consultation (CI-041) for PI-037 - SWARAJYAM  D (UHID: 031479) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 06:10:01', '2025-09-06 06:10:01'),
(1117, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=41\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906114900_CI-041.pdf\">View Finalized Report</a>!', '2025-09-06 06:19:14', '2025-09-06 06:19:14'),
(1121, '25', 'Added a new patient LIYAKHAT  KHAN for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=38\">Check</a>', '2025-09-06 06:25:52', '2025-09-06 06:25:52'),
(1127, '25', 'Added Consultation (CI-042) for PI-038 - LIYAKHAT  KHAN (UHID: 57270) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 06:26:02', '2025-09-06 06:26:02'),
(1128, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=42\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906120808_CI-042.pdf\">View Finalized Report</a>!', '2025-09-06 06:38:21', '2025-09-06 06:38:21'),
(1132, '25', 'Added a new patient KAVITHA  S for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=39\">Check</a>', '2025-09-06 06:50:01', '2025-09-06 06:50:01'),
(1138, '25', 'Added Consultation (CI-043) for PI-039 - KAVITHA  S (UHID: 01130) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 06:50:12', '2025-09-06 06:50:12'),
(1139, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=43\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906122339_CI-043.pdf\">View Finalized Report</a>!', '2025-09-06 06:53:52', '2025-09-06 06:53:52'),
(1152, '25', 'Added a new patient SATYAVANI  VARANASI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=40\">Check</a>', '2025-09-06 07:34:23', '2025-09-06 07:34:23'),
(1158, '25', 'Added Consultation (CI-044) for PI-040 - SATYAVANI  VARANASI (UHID: 57275) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 07:34:44', '2025-09-06 07:34:44'),
(1159, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=44\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906010647_CI-044.pdf\">View Finalized Report</a>!', '2025-09-06 07:37:00', '2025-09-06 07:37:00'),
(1163, '25', 'Added a new patient VENKATA SAIRAM VARANASI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=41\">Check</a>', '2025-09-06 07:46:32', '2025-09-06 07:46:32'),
(1169, '25', 'Added Consultation (CI-045) for PI-041 - VENKATA SAIRAM VARANASI (UHID: 57276) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 07:46:47', '2025-09-06 07:46:47'),
(1170, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=45\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906011800_CI-045.pdf\">View Finalized Report</a>!', '2025-09-06 07:48:14', '2025-09-06 07:48:14'),
(1174, '25', 'Added a new patient RAMAKRISHNA  GADIPUDI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=42\">Check</a>', '2025-09-06 08:22:27', '2025-09-06 08:22:27'),
(1180, '25', 'Added Consultation (CI-046) for PI-042 - RAMAKRISHNA  GADIPUDI (UHID: 57281) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 08:22:42', '2025-09-06 08:22:42'),
(1181, '25', 'Added Consultation (CI-047) for PI-042 - RAMAKRISHNA  GADIPUDI (UHID: 57281) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 08:22:42', '2025-09-06 08:22:42'),
(1182, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=46\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906015343_CI-046.pdf\">View Finalized Report</a>!', '2025-09-06 08:23:55', '2025-09-06 08:23:55'),
(1187, '25', 'Added a new patient YESUPADAM P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=43\">Check</a>', '2025-09-06 09:19:16', '2025-09-06 09:19:16'),
(1193, '25', 'Added Consultation (CI-048) for PI-043 - YESUPADAM P (UHID: 057278) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 09:19:52', '2025-09-06 09:19:52'),
(1194, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=48\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906030612_CI-048.pdf\">View Finalized Report</a>!', '2025-09-06 09:36:25', '2025-09-06 09:36:25'),
(1202, '25', 'Added a new patient J N RAO for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=44\">Check</a>', '2025-09-06 10:54:07', '2025-09-06 10:54:07'),
(1213, '25', 'Added Consultation (CI-049) for PI-044 - J N RAO (UHID: 000001) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 10:55:10', '2025-09-06 10:55:10'),
(1214, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=49\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906044501_CI-049.pdf\">View Finalized Report</a>!', '2025-09-06 11:15:14', '2025-09-06 11:15:14'),
(1218, '25', 'Added a new patient SAI SIVA RAM  DANTU for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=45\">Check</a>', '2025-09-06 11:25:54', '2025-09-06 11:25:54'),
(1224, '25', 'Added Consultation (CI-050) for PI-045 - SAI SIVA RAM  DANTU (UHID: 069557) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 11:26:19', '2025-09-06 11:26:19'),
(1225, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=50\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906050806_CI-050.pdf\">View Finalized Report</a>!', '2025-09-06 11:38:21', '2025-09-06 11:38:21'),
(1245, '25', 'Added a new patient SRINIVASA  REDDY for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=46\">Check</a>', '2025-09-06 12:03:46', '2025-09-06 12:03:46'),
(1251, '25', 'Added Consultation (CI-051) for PI-046 - SRINIVASA  REDDY (UHID: 69568) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-06 12:04:04', '2025-09-06 12:04:04'),
(1252, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=51\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250906054833_CI-051.pdf\">View Finalized Report</a>!', '2025-09-06 12:18:45', '2025-09-06 12:18:45'),
(1257, '25', 'Added a new patient SAMRAJYAM  N for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=47\">Check</a>', '2025-09-08 05:20:08', '2025-09-08 05:20:08'),
(1263, '25', 'Added Consultation (CI-052) for PI-047 - SAMRAJYAM  N (UHID: 052362) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-08 05:20:31', '2025-09-08 05:20:31');
INSERT INTO `admin_updates` (`id`, `updated_by`, `update_text`, `updated_at`, `created_at`) VALUES
(1264, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=52\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250908111019_CI-052.pdf\">View Finalized Report</a>!', '2025-09-08 05:40:33', '2025-09-08 05:40:33'),
(1268, '25', 'Added a new patient PRAVEENA GEETHA  A.S for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=48\">Check</a>', '2025-09-08 06:03:48', '2025-09-08 06:03:48'),
(1274, '25', 'Added Consultation (CI-053) for PI-048 - PRAVEENA GEETHA  A.S (UHID: 057316) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-08 06:04:18', '2025-09-08 06:04:18'),
(1275, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=53\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250908114635_CI-053.pdf\">View Finalized Report</a>!', '2025-09-08 06:16:49', '2025-09-08 06:16:49'),
(1279, '25', 'Added a new patient SUNITHA  C for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=49\">Check</a>', '2025-09-08 06:53:37', '2025-09-08 06:53:37'),
(1285, '25', 'Added Consultation (CI-054) for PI-049 - SUNITHA  C (UHID: 054674) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-08 06:53:47', '2025-09-08 06:53:47'),
(1286, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=54\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250908124412_CI-054.pdf\">View Finalized Report</a>!', '2025-09-08 07:14:27', '2025-09-08 07:14:27'),
(1290, '25', 'Added a new patient T MADHAVI LATHA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=50\">Check</a>', '2025-09-08 07:38:25', '2025-09-08 07:38:25'),
(1296, '25', 'Added Consultation (CI-055) for PI-050 - T MADHAVI LATHA (UHID: 18476) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-08 07:38:37', '2025-09-08 07:38:37'),
(1297, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=55\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250908010923_CI-055.pdf\">View Finalized Report</a>!', '2025-09-08 07:39:39', '2025-09-08 07:39:39'),
(1301, '25', 'Added a new patient SURYA LAKSHMI  JANDHYALA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=51\">Check</a>', '2025-09-08 07:44:08', '2025-09-08 07:44:08'),
(1307, '25', 'Added Consultation (CI-056) for PI-051 - SURYA LAKSHMI  JANDHYALA (UHID: 57323) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-08 07:45:03', '2025-09-08 07:45:03'),
(1308, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=56\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250908012648_CI-056.pdf\">View Finalized Report</a>!', '2025-09-08 07:57:01', '2025-09-08 07:57:01'),
(1346, '25', 'Added a new patient SUPRIYA P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=52\">Check</a>', '2025-09-08 09:31:38', '2025-09-08 09:31:38'),
(1360, '25', 'Added Consultation (CI-057) for PI-052 - SUPRIYA P (UHID: 098765) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-08 09:32:32', '2025-09-08 09:32:32'),
(1361, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=57\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250908030606_CI-057.pdf\">View Finalized Report</a>!', '2025-09-08 09:36:20', '2025-09-08 09:36:20'),
(1369, '25', 'Added a new patient SURYA RAJ Y for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=53\">Check</a>', '2025-09-08 12:30:08', '2025-09-08 12:30:08'),
(1375, '25', 'Added Consultation (CI-058) for PI-053 - SURYA RAJ Y (UHID: 57333) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-08 12:30:22', '2025-09-08 12:30:22'),
(1376, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=58\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250908060058_CI-058.pdf\">View Finalized Report</a>!', '2025-09-08 12:31:11', '2025-09-08 12:31:11'),
(1384, '25', 'Added a new patient SIVA RAJASEKHAR M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=54\">Check</a>', '2025-09-08 13:37:17', '2025-09-08 13:37:17'),
(1390, '25', 'Added Consultation (CI-059) for PI-054 - SIVA RAJASEKHAR M (UHID: 57327) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-08 13:37:29', '2025-09-08 13:37:29'),
(1391, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=59\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250908071441_CI-059.pdf\">View Finalized Report</a>!', '2025-09-08 13:44:53', '2025-09-08 13:44:53'),
(1396, '25', 'Added a new patient AMMANI P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=55\">Check</a>', '2025-09-09 05:20:39', '2025-09-09 05:20:39'),
(1402, '25', 'Added Consultation (CI-060) for PI-055 - AMMANI P (UHID: 12599) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-09 05:20:53', '2025-09-09 05:20:53'),
(1403, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=60\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250909105201_CI-060.pdf\">View Finalized Report</a>!', '2025-09-09 05:22:14', '2025-09-09 05:22:14'),
(1407, '25', 'Added a new patient RAMACHANDRA REDDY for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=56\">Check</a>', '2025-09-09 05:39:14', '2025-09-09 05:39:14'),
(1413, '25', 'Added Consultation (CI-061) for PI-056 - RAMACHANDRA REDDY (UHID: 57341) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-09 05:39:37', '2025-09-09 05:39:37'),
(1414, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=61\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250909111827_CI-061.pdf\">View Finalized Report</a>!', '2025-09-09 05:48:41', '2025-09-09 05:48:41'),
(1418, '25', 'Added a new patient SRINIVASARAO . for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=57\">Check</a>', '2025-09-09 06:02:50', '2025-09-09 06:02:50'),
(1424, '25', 'Added Consultation (CI-062) for PI-057 - SRINIVASARAO . (UHID: 57318) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-09 06:10:53', '2025-09-09 06:10:53'),
(1425, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=62\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250909114225_CI-062.pdf\">View Finalized Report</a>!', '2025-09-09 06:12:39', '2025-09-09 06:12:39'),
(1437, '25', 'Added a new patient JYOTI A for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=58\">Check</a>', '2025-09-09 11:01:05', '2025-09-09 11:01:05'),
(1473, '25', 'Added Consultation (CI-063) for PI-058 - JYOTI A (UHID: 57348) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-09 11:04:04', '2025-09-09 11:04:04'),
(1474, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=63\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250909043438_CI-063.pdf\">View Finalized Report</a>!', '2025-09-09 11:04:53', '2025-09-09 11:04:53'),
(1493, '25', 'Added a new patient VARALAKSHMI  K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=59\">Check</a>', '2025-09-10 07:26:25', '2025-09-10 07:26:25'),
(1499, '25', 'Added Consultation (CI-064) for PI-059 - VARALAKSHMI  K (UHID: 57358) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-10 07:26:54', '2025-09-10 07:26:54'),
(1500, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=64\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250910012735_CI-064.pdf\">View Finalized Report</a>!', '2025-09-10 07:57:49', '2025-09-10 07:57:49'),
(1505, '25', 'Added a new patient SURESH  KUMAR  K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=60\">Check</a>', '2025-09-10 09:24:26', '2025-09-10 09:24:26'),
(1511, '25', 'Added Consultation (CI-065) for PI-060 - SURESH  KUMAR  K (UHID: 53959) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-10 09:49:33', '2025-09-10 09:49:33'),
(1512, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=65\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250910032312_CI-065.pdf\">View Finalized Report</a>!', '2025-09-10 09:53:25', '2025-09-10 09:53:25'),
(1524, '25', 'Added a new patient V VASU VASU for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=61\">Check</a>', '2025-09-11 06:21:30', '2025-09-11 06:21:30'),
(1530, '25', 'Added Consultation (CI-066) for PI-061 - V VASU VASU (UHID: 20438) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-11 06:21:55', '2025-09-11 06:21:55'),
(1531, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=66\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250911122038_CI-066.pdf\">View Finalized Report</a>!', '2025-09-11 06:50:53', '2025-09-11 06:50:53'),
(1535, '25', 'Added a new patient SRINIVAS  M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=62\">Check</a>', '2025-09-11 07:07:39', '2025-09-11 07:07:39'),
(1541, '25', 'Added Consultation (CI-067) for PI-062 - SRINIVAS  M (UHID: 037969) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-11 07:35:05', '2025-09-11 07:35:05'),
(1542, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=67\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250911010733_CI-067.pdf\">View Finalized Report</a>!', '2025-09-11 07:37:47', '2025-09-11 07:37:47'),
(1546, '25', 'Added a new patient GUNDAPPA  R for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=63\">Check</a>', '2025-09-11 07:56:34', '2025-09-11 07:56:34'),
(1552, '25', 'Added Consultation (CI-068) for PI-063 - GUNDAPPA  R (UHID: 026520) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-11 07:56:44', '2025-09-11 07:56:44'),
(1553, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=68\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250911012801_CI-068.pdf\">View Finalized Report</a>!', '2025-09-11 07:58:14', '2025-09-11 07:58:14'),
(1557, '25', 'Added a new patient SUKANYA M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=64\">Check</a>', '2025-09-11 08:31:09', '2025-09-11 08:31:09'),
(1563, '25', 'Added Consultation (CI-069) for PI-064 - SUKANYA M (UHID: 057373) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-11 08:43:04', '2025-09-11 08:43:04'),
(1564, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=69\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250911021415_CI-069.pdf\">View Finalized Report</a>!', '2025-09-11 08:44:29', '2025-09-11 08:44:29'),
(1569, '25', 'Added a new patient SRILATHA  M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=65\">Check</a>', '2025-09-11 12:39:22', '2025-09-11 12:39:22'),
(1575, '25', 'Added Consultation (CI-070) for PI-065 - SRILATHA  M (UHID: 035937) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-11 12:39:43', '2025-09-11 12:39:43'),
(1576, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=70\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250911061854_CI-070.pdf\">View Finalized Report</a>!', '2025-09-11 12:49:06', '2025-09-11 12:49:06'),
(1584, '25', 'Added a new patient SUBHASHINI GADDAMI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=66\">Check</a>', '2025-09-12 06:12:49', '2025-09-12 06:12:49'),
(1590, '25', 'Added Consultation (CI-071) for PI-066 - SUBHASHINI GADDAMI (UHID: 52569) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-12 06:13:11', '2025-09-12 06:13:11'),
(1591, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=71\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250912115243_CI-071.pdf\">View Finalized Report</a>!', '2025-09-12 06:22:58', '2025-09-12 06:22:58'),
(1595, '25', 'Added a new patient RATAN  RAJ B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=67\">Check</a>', '2025-09-12 06:34:03', '2025-09-12 06:34:03'),
(1601, '25', 'Added Consultation (CI-072) for PI-067 - RATAN  RAJ B (UHID: 039107) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-12 06:34:16', '2025-09-12 06:34:16'),
(1602, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=72\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250912121626_CI-072.pdf\">View Finalized Report</a>!', '2025-09-12 06:46:40', '2025-09-12 06:46:40'),
(1606, '25', 'Added a new patient S  SATYAVATHI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=68\">Check</a>', '2025-09-12 06:53:30', '2025-09-12 06:53:30'),
(1612, '25', 'Added Consultation (CI-073) for PI-068 - S  SATYAVATHI (UHID: 057393) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-12 06:54:23', '2025-09-12 06:54:23'),
(1613, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=73\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250912122949_CI-073.pdf\">View Finalized Report</a>!', '2025-09-12 07:00:03', '2025-09-12 07:00:03'),
(1617, '25', 'Updated details for the patient \"S  SATYAVATHI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=68\">View all details</a>!', '2025-09-12 07:00:48', '2025-09-12 07:00:48'),
(1618, '25', 'Updated details for the patient \"S  SATYAVATHI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=68\">View all details</a>!', '2025-09-12 07:00:50', '2025-09-12 07:00:50'),
(1619, '25', 'Updated details for the patient \"S  SATYAVATHI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=68\">View all details</a>!', '2025-09-12 07:00:51', '2025-09-12 07:00:51'),
(1628, '25', 'Added a new patient SURYANARAYANA  KUMAR S for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=69\">Check</a>', '2025-09-12 07:09:04', '2025-09-12 07:09:04'),
(1634, '25', 'Added Consultation (CI-074) for PI-069 - SURYANARAYANA  KUMAR S (UHID: 12278) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-12 07:09:27', '2025-09-12 07:09:27'),
(1635, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=74\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250912124448_CI-074.pdf\">View Finalized Report</a>!', '2025-09-12 07:15:02', '2025-09-12 07:15:02'),
(1639, '25', 'Added a new patient SURENDER  REDDY for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=70\">Check</a>', '2025-09-12 07:50:54', '2025-09-12 07:50:54'),
(1645, '25', 'Added Consultation (CI-075) for PI-070 - SURENDER  REDDY (UHID: 052568) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-12 07:51:22', '2025-09-12 07:51:22'),
(1646, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=75\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250912012915_CI-075.pdf\">View Finalized Report</a>!', '2025-09-12 07:59:29', '2025-09-12 07:59:29'),
(1650, '25', 'Added a new patient SHARADA G for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=71\">Check</a>', '2025-09-12 08:05:23', '2025-09-12 08:05:23'),
(1656, '25', 'Added Consultation (CI-076) for PI-071 - SHARADA G (UHID: 34385) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-12 08:05:59', '2025-09-12 08:05:59'),
(1657, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=76\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250912014019_CI-076.pdf\">View Finalized Report</a>!', '2025-09-12 08:10:33', '2025-09-12 08:10:33'),
(1661, '25', 'Added a new patient RANGA  LAKSHMI V for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=72\">Check</a>', '2025-09-12 08:16:48', '2025-09-12 08:16:48'),
(1667, '25', 'Added Consultation (CI-077) for PI-072 - RANGA  LAKSHMI V (UHID: 031067) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-12 08:17:11', '2025-09-12 08:17:11'),
(1668, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=77\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250912015055_CI-077.pdf\">View Finalized Report</a>!', '2025-09-12 08:21:09', '2025-09-12 08:21:09'),
(1673, '25', 'Added a new patient UMA MAHESHWARI  K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=73\">Check</a>', '2025-09-12 10:35:49', '2025-09-12 10:35:49'),
(1679, '25', 'Added Consultation (CI-078) for PI-073 - UMA MAHESHWARI  K (UHID: 057390) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-12 10:36:06', '2025-09-12 10:36:06'),
(1680, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=78\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250912041937_CI-078.pdf\">View Finalized Report</a>!', '2025-09-12 10:49:52', '2025-09-12 10:49:52'),
(1685, '25', 'Added a new patient CHANDRA MOULI  P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=74\">Check</a>', '2025-09-13 05:09:09', '2025-09-13 05:09:09'),
(1691, '25', 'Added Consultation (CI-079) for PI-074 - CHANDRA MOULI  P (UHID: 47149) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-13 05:10:03', '2025-09-13 05:10:03'),
(1692, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=79\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250913105156_CI-079.pdf\">View Finalized Report</a>!', '2025-09-13 05:22:10', '2025-09-13 05:22:10'),
(1697, '25', 'Added a new patient VENKATESWARLU PAVANI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=75\">Check</a>', '2025-09-13 06:33:31', '2025-09-13 06:33:31'),
(1703, '25', 'Added Consultation (CI-080) for PI-075 - VENKATESWARLU PAVANI (UHID: 57409) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-13 06:34:21', '2025-09-13 06:34:21'),
(1704, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=80\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250913121836_CI-080.pdf\">View Finalized Report</a>!', '2025-09-13 06:48:49', '2025-09-13 06:48:49'),
(1708, '25', 'Added a new patient SWAROOPA RANI E.G for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=76\">Check</a>', '2025-09-13 07:10:06', '2025-09-13 07:10:06'),
(1714, '25', 'Added Consultation (CI-081) for PI-076 - SWAROOPA RANI E.G (UHID: 057406) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-13 07:10:22', '2025-09-13 07:10:22'),
(1715, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=81\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250913124253_CI-081.pdf\">View Finalized Report</a>!', '2025-09-13 07:13:07', '2025-09-13 07:13:07'),
(1719, '25', 'Added a new patient KANCHANAM  MANI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=77\">Check</a>', '2025-09-13 07:38:13', '2025-09-13 07:38:13'),
(1725, '25', 'Added Consultation (CI-082) for PI-077 - KANCHANAM  MANI (UHID: 57423) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-13 07:38:45', '2025-09-13 07:38:45'),
(1726, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=82\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250913012119_CI-082.pdf\">View Finalized Report</a>!', '2025-09-13 07:51:32', '2025-09-13 07:51:32'),
(1733, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-09-13 09:49:19', '2025-09-13 09:49:19'),
(1734, '13', 'Updated User <a target=\"_blank\" href=\"https://stepcure.co/admin/profile/?userid=supriya01\">@supriya01 (Supriya  Priyadarshini)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/users?id=25\">Check</a>', '2025-09-13 09:49:21', '2025-09-13 09:49:21'),
(1735, '25', 'Added a new patient VENKATESHWARA RAO P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=78\">Check</a>', '2025-09-13 09:51:15', '2025-09-13 09:51:15'),
(1757, '25', 'Added Consultation (CI-083) for PI-078 - VENKATESHWARA RAO P (UHID: 57248) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-13 09:52:07', '2025-09-13 09:52:07'),
(1758, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=83\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250913032601_CI-083.pdf\">View Finalized Report</a>!', '2025-09-13 09:56:15', '2025-09-13 09:56:15'),
(1759, '13', 'Added Consultation (CI-084) for PI-075 - VENKATESWARLU PAVANI (UHID: 57409) with    (@)', '2025-09-13 09:57:27', '2025-09-13 09:57:27'),
(1760, '13', 'Added Consultation (CI-085) for PI-075 - VENKATESWARLU PAVANI (UHID: 57409) with    (@)', '2025-09-13 09:57:28', '2025-09-13 09:57:28'),
(1772, '25', 'Added a new patient LAKSHMI A.V for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=79\">Check</a>', '2025-09-13 10:28:22', '2025-09-13 10:28:22'),
(1778, '25', 'Added Consultation (CI-086) for PI-079 - LAKSHMI A.V (UHID: 57431) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-13 10:28:47', '2025-09-13 10:28:47'),
(1779, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=86\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250913041816_CI-086.pdf\">View Finalized Report</a>!', '2025-09-13 10:48:29', '2025-09-13 10:48:29'),
(1783, '25', 'Added a new patient MANOHAR A for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=80\">Check</a>', '2025-09-13 11:35:20', '2025-09-13 11:35:20'),
(1789, '25', 'Added Consultation (CI-087) for PI-080 - MANOHAR A (UHID: 57435) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-13 11:35:37', '2025-09-13 11:35:37'),
(1790, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=87\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250913051928_CI-087.pdf\">View Finalized Report</a>!', '2025-09-13 11:49:42', '2025-09-13 11:49:42'),
(1796, '25', 'Added Consultation (CI-088) for PI-080 - MANOHAR A (UHID: 57435) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-13 11:50:53', '2025-09-13 11:50:53'),
(1797, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=88\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250913052441_CI-088.pdf\">View Finalized Report</a>!', '2025-09-13 11:54:54', '2025-09-13 11:54:54'),
(1809, '25', 'Added a new patient BEULAH KARUMURI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=81\">Check</a>', '2025-09-15 06:49:59', '2025-09-15 06:49:59'),
(1815, '25', 'Added Consultation (CI-089) for PI-081 - BEULAH KARUMURI (UHID: 57452) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-15 06:50:28', '2025-09-15 06:50:28'),
(1816, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=89\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250915122741_CI-089.pdf\">View Finalized Report</a>!', '2025-09-15 06:57:55', '2025-09-15 06:57:55'),
(1821, '25', 'Added a new patient DHARMAVATHI N for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=82\">Check</a>', '2025-09-15 07:33:56', '2025-09-15 07:33:56'),
(1827, '25', 'Added Consultation (CI-090) for PI-082 - DHARMAVATHI N (UHID: 48832) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-15 07:54:10', '2025-09-15 07:54:10'),
(1828, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=90\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250915013242_CI-090.pdf\">View Finalized Report</a>!', '2025-09-15 08:02:54', '2025-09-15 08:02:54'),
(1833, '25', 'Added a new patient SHANKAR D for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=83\">Check</a>', '2025-09-15 09:54:26', '2025-09-15 09:54:26'),
(1839, '25', 'Added Consultation (CI-091) for PI-083 - SHANKAR D (UHID: 57457) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-15 09:54:46', '2025-09-15 09:54:46'),
(1840, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=91\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250915033915_CI-091.pdf\">View Finalized Report</a>!', '2025-09-15 10:09:31', '2025-09-15 10:09:31'),
(1850, '25', 'Added a new patient PRAKASH  T.K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=84\">Check</a>', '2025-09-15 12:37:49', '2025-09-15 12:37:49'),
(1856, '25', 'Added Consultation (CI-092) for PI-084 - PRAKASH  T.K (UHID: 046183) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-15 12:38:01', '2025-09-15 12:38:01'),
(1857, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=92\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250915060926_CI-092.pdf\">View Finalized Report</a>!', '2025-09-15 12:39:38', '2025-09-15 12:39:38'),
(1865, '25', 'Added a new patient SUSEELA  G for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=85\">Check</a>', '2025-09-16 05:22:18', '2025-09-16 05:22:18'),
(1871, '25', 'Added Consultation (CI-093) for PI-085 - SUSEELA  G (UHID: 057465) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-16 05:23:04', '2025-09-16 05:23:04'),
(1872, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=93\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250916110027_CI-093.pdf\">View Finalized Report</a>!', '2025-09-16 05:30:43', '2025-09-16 05:30:43'),
(1876, '25', 'Added a new patient PARVATHI  KANDI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=86\">Check</a>', '2025-09-16 06:23:12', '2025-09-16 06:23:12'),
(1882, '25', 'Added Consultation (CI-094) for PI-086 - PARVATHI  KANDI (UHID: 057408) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-16 06:23:33', '2025-09-16 06:23:33'),
(1883, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=94\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250916120830_CI-094.pdf\">View Finalized Report</a>!', '2025-09-16 06:38:43', '2025-09-16 06:38:43'),
(1887, '25', 'Added a new patient HEMA SUNDER  RAO V for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=87\">Check</a>', '2025-09-16 06:51:28', '2025-09-16 06:51:28'),
(1893, '25', 'Added Consultation (CI-095) for PI-087 - HEMA SUNDER  RAO V (UHID: 57470) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-16 06:51:41', '2025-09-16 06:51:41'),
(1894, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=95\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250916125121_CI-095.pdf\">View Finalized Report</a>!', '2025-09-16 07:21:35', '2025-09-16 07:21:35'),
(1899, '25', 'Added a new patient NAGAMANI  B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=88\">Check</a>', '2025-09-16 10:53:32', '2025-09-16 10:53:32'),
(1905, '25', 'Added Consultation (CI-096) for PI-088 - NAGAMANI  B (UHID: 057475) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-16 10:53:44', '2025-09-16 10:53:44'),
(1906, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=96\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250916042627_CI-096.pdf\">View Finalized Report</a>!', '2025-09-16 10:56:40', '2025-09-16 10:56:40'),
(1914, '25', 'Added a new patient VENKATAMMA  NOWDASARI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=90\">Check</a>', '2025-09-17 05:23:46', '2025-09-17 05:23:46'),
(1920, '25', 'Added Consultation (CI-097) for PI-089 - VENKATAMMA  NOWDASARI (UHID: 057478) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-17 05:25:03', '2025-09-17 05:25:03'),
(1921, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=97\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250917110722_CI-097.pdf\">View Finalized Report</a>!', '2025-09-17 05:37:37', '2025-09-17 05:37:37'),
(1927, '25', 'Updated details for the patient \"VENKATAMMA  NOWDASARI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=90\">View all details</a>!', '2025-09-17 05:38:25', '2025-09-17 05:38:25'),
(1928, '25', 'Updated details for the patient \"VENKATAMMA  NOWDASARI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=90\">View all details</a>!', '2025-09-17 05:38:27', '2025-09-17 05:38:27'),
(1929, '25', 'Updated details for the patient \"VENKATAMMA  NOWDASARI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=90\">View all details</a>!', '2025-09-17 05:38:28', '2025-09-17 05:38:28'),
(1930, '25', 'Updated details for the patient \"VENKATAMMA  NOWDASARI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=90\">View all details</a>!', '2025-09-17 05:38:29', '2025-09-17 05:38:29'),
(1931, '25', 'Updated details for the patient \"VENKATAMMA  NOWDASARI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=90\">View all details</a>!', '2025-09-17 05:38:32', '2025-09-17 05:38:32'),
(1932, '25', 'Updated details for the patient \"VENKATAMMA  NOWDASARI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=90\">View all details</a>!', '2025-09-17 05:38:33', '2025-09-17 05:38:33'),
(1933, '25', 'Updated details for the patient \"VENKATAMMA  NOWDASARI\". <a target=\"_blank\" href=\"https://stepcure.co/admin/patients/?id=90\">View all details</a>!', '2025-09-17 05:38:33', '2025-09-17 05:38:33'),
(1956, '25', 'Added a new patient SUNIL  KUMAR U for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=91\">Check</a>', '2025-09-17 05:44:00', '2025-09-17 05:44:00'),
(1962, '25', 'Added Consultation (CI-098) for PI-090 - SUNIL  KUMAR U (UHID: 046326) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-17 05:44:22', '2025-09-17 05:44:22'),
(1963, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=98\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250917113414_CI-098.pdf\">View Finalized Report</a>!', '2025-09-17 06:04:29', '2025-09-17 06:04:29'),
(1972, '25', 'Added a new patient SWAPNA KUMARI S for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=92\">Check</a>', '2025-09-17 06:09:53', '2025-09-17 06:09:53'),
(1978, '25', 'Added Consultation (CI-099) for PI-091 - SWAPNA KUMARI S (UHID: 057484) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-17 06:10:11', '2025-09-17 06:10:11'),
(1979, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=99\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250917114945_CI-099.pdf\">View Finalized Report</a>!', '2025-09-17 06:19:59', '2025-09-17 06:19:59'),
(1988, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=97\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250917120231_CI-097.pdf\">View Finalized Report</a>!', '2025-09-17 06:32:45', '2025-09-17 06:32:45'),
(1992, '25', 'Added a new patient NAGAMMA  P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=93\">Check</a>', '2025-09-17 06:37:01', '2025-09-17 06:37:01'),
(1998, '25', 'Added Consultation (CI-100) for PI-092 - NAGAMMA  P (UHID: 036741) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-17 06:37:19', '2025-09-17 06:37:19'),
(1999, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=100\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250917121820_CI-100.pdf\">View Finalized Report</a>!', '2025-09-17 06:48:35', '2025-09-17 06:48:35'),
(2003, '25', 'Added a new patient SUDHA RANI VELAGA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=94\">Check</a>', '2025-09-17 07:08:44', '2025-09-17 07:08:44'),
(2009, '25', 'Added Consultation (CI-101) for PI-093 - SUDHA RANI VELAGA (UHID: 45314) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-17 07:08:57', '2025-09-17 07:08:57'),
(2010, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=101\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250917125035_CI-101.pdf\">View Finalized Report</a>!', '2025-09-17 07:20:51', '2025-09-17 07:20:51'),
(2015, '25', 'Added a new patient ANKNNA  KASARLA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=95\">Check</a>', '2025-09-17 08:20:57', '2025-09-17 08:20:57'),
(2027, '25', 'Added Consultation (CI-102) for PI-094 - ANKNNA  KASARLA (UHID: 051654) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-17 08:21:22', '2025-09-17 08:21:22'),
(2028, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=102\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250917021041_CI-102.pdf\">View Finalized Report</a>!', '2025-09-17 08:40:54', '2025-09-17 08:40:54'),
(2034, '25', 'Added a new patient GIRIDHAR  J for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=96\">Check</a>', '2025-09-17 12:18:34', '2025-09-17 12:18:34'),
(2040, '25', 'Added Consultation (CI-103) for PI-095 - GIRIDHAR  J (UHID: 057493) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-17 12:18:46', '2025-09-17 12:18:46'),
(2041, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=103\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250917060346_CI-103.pdf\">View Finalized Report</a>!', '2025-09-17 12:33:59', '2025-09-17 12:33:59'),
(2049, '25', 'Added a new patient MOHAN  RAO D for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=97\">Check</a>', '2025-09-18 05:34:26', '2025-09-18 05:34:26'),
(2055, '25', 'Added Consultation (CI-104) for PI-096 - MOHAN  RAO D (UHID: 27407) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-18 05:35:03', '2025-09-18 05:35:03'),
(2056, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=104\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250918111246_CI-104.pdf\">View Finalized Report</a>!', '2025-09-18 05:42:59', '2025-09-18 05:42:59'),
(2061, '25', 'Added a new patient SATYANARAYANA  A for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=98\">Check</a>', '2025-09-18 10:23:50', '2025-09-18 10:23:50'),
(2067, '25', 'Added Consultation (CI-105) for PI-097 - SATYANARAYANA  A (UHID: 031392) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-18 10:24:58', '2025-09-18 10:24:58'),
(2068, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=105\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250918041127_CI-105.pdf\">View Finalized Report</a>!', '2025-09-18 10:41:40', '2025-09-18 10:41:40'),
(2076, '25', 'Added a new patient ARUN TEJA  CH for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=99\">Check</a>', '2025-09-19 05:20:29', '2025-09-19 05:20:29'),
(2082, '25', 'Added Consultation (CI-106) for PI-098 - ARUN TEJA  CH (UHID: 57510) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-19 05:20:45', '2025-09-19 05:20:45'),
(2083, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=106\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250919110923_CI-106.pdf\">View Finalized Report</a>!', '2025-09-19 05:39:37', '2025-09-19 05:39:37'),
(2087, '25', 'Added a new patient ANANTHA RATNA MANI  VEERA  for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=100\">Check</a>', '2025-09-19 06:29:13', '2025-09-19 06:29:13'),
(2093, '25', 'Added Consultation (CI-107) for PI-099 - ANANTHA RATNA MANI  VEERA  (UHID: 57514) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-19 06:30:19', '2025-09-19 06:30:19'),
(2094, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=107\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250919121323_CI-107.pdf\">View Finalized Report</a>!', '2025-09-19 06:43:37', '2025-09-19 06:43:37'),
(2098, '25', 'Added a new patient VIJAYA LAKSHMI  M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=101\">Check</a>', '2025-09-19 06:45:45', '2025-09-19 06:45:45'),
(2104, '25', 'Added Consultation (CI-108) for PI-100 - VIJAYA LAKSHMI  M (UHID: 57513) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-19 06:46:09', '2025-09-19 06:46:09'),
(2105, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=108\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250919123305_CI-108.pdf\">View Finalized Report</a>!', '2025-09-19 07:03:22', '2025-09-19 07:03:22'),
(2109, '25', 'Added a new patient MALLIKARJUN RAO K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=102\">Check</a>', '2025-09-19 07:06:06', '2025-09-19 07:06:06'),
(2115, '25', 'Added Consultation (CI-109) for PI-101 - MALLIKARJUN RAO K (UHID: 37954) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-19 07:06:33', '2025-09-19 07:06:33'),
(2116, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=109\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250919124702_CI-109.pdf\">View Finalized Report</a>!', '2025-09-19 07:17:17', '2025-09-19 07:17:17'),
(2124, '25', 'Added a new patient MADHU . for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=103\">Check</a>', '2025-09-19 13:17:07', '2025-09-19 13:17:07'),
(2130, '25', 'Added Consultation (CI-110) for PI-102 - MADHU . (UHID: 57522) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-19 13:17:46', '2025-09-19 13:17:46'),
(2131, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=110\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250919065454_CI-110.pdf\">View Finalized Report</a>!', '2025-09-19 13:25:09', '2025-09-19 13:25:09'),
(2136, '25', 'Added a new patient P. NARESH for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=104\">Check</a>', '2025-09-20 05:19:40', '2025-09-20 05:19:40'),
(2142, '25', 'Added Consultation (CI-111) for PI-103 - P. NARESH (UHID: 01672) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-20 05:20:26', '2025-09-20 05:20:26'),
(2143, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=111\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250920110218_CI-111.pdf\">View Finalized Report</a>!', '2025-09-20 05:32:32', '2025-09-20 05:32:32'),
(2147, '25', 'Added a new patient HARIKA  ADIMULAM for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=105\">Check</a>', '2025-09-20 05:37:14', '2025-09-20 05:37:14'),
(2153, '25', 'Added Consultation (CI-112) for PI-104 - HARIKA  ADIMULAM (UHID: 57523) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-20 05:37:50', '2025-09-20 05:37:50'),
(2154, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=112\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250920112407_CI-112.pdf\">View Finalized Report</a>!', '2025-09-20 05:54:22', '2025-09-20 05:54:22'),
(2161, '25', 'Added a new patient VENKATA RAMANA  MURTHY P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=106\">Check</a>', '2025-09-20 06:48:41', '2025-09-20 06:48:41'),
(2167, '25', 'Added Consultation (CI-113) for PI-105 - VENKATA RAMANA  MURTHY P (UHID: 057525) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-20 06:49:05', '2025-09-20 06:49:05'),
(2168, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=113\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250920124542_CI-113.pdf\">View Finalized Report</a>!', '2025-09-20 07:15:55', '2025-09-20 07:15:55'),
(2172, '25', 'Added a new patient SIKANDAR . for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=107\">Check</a>', '2025-09-20 07:33:24', '2025-09-20 07:33:24'),
(2178, '25', 'Added Consultation (CI-114) for PI-106 - SIKANDAR . (UHID: 057531) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-20 07:33:49', '2025-09-20 07:33:49'),
(2179, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=114\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250920010439_CI-114.pdf\">View Finalized Report</a>!', '2025-09-20 07:34:52', '2025-09-20 07:34:52'),
(2184, '25', 'Added a new patient SARASWATHI GUNTURU for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=108\">Check</a>', '2025-09-20 08:18:20', '2025-09-20 08:18:20'),
(2198, '25', 'Added Consultation (CI-115) for PI-107 - SARASWATHI GUNTURU (UHID: 57257) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-20 08:19:28', '2025-09-20 08:19:28'),
(2199, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=115\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250920015754_CI-115.pdf\">View Finalized Report</a>!', '2025-09-20 08:28:13', '2025-09-20 08:28:13'),
(2204, '25', 'Added a new patient AHALYA  MACHARLA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=109\">Check</a>', '2025-09-20 09:07:17', '2025-09-20 09:07:17'),
(2210, '25', 'Added Consultation (CI-116) for PI-108 - AHALYA  MACHARLA (UHID: 057528) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-20 09:08:03', '2025-09-20 09:08:03'),
(2211, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=116\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250920024647_CI-116.pdf\">View Finalized Report</a>!', '2025-09-20 09:17:01', '2025-09-20 09:17:01'),
(2219, '25', 'Added a new patient ANJALI  M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=110\">Check</a>', '2025-09-22 05:41:46', '2025-09-22 05:41:46'),
(2225, '25', 'Added Consultation (CI-117) for PI-109 - ANJALI  M (UHID: 046602) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-22 05:42:50', '2025-09-22 05:42:50'),
(2226, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=117\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250922112519_CI-117.pdf\">View Finalized Report</a>!', '2025-09-22 05:55:34', '2025-09-22 05:55:34'),
(2230, '25', 'Added a new patient RAJU  S for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=111\">Check</a>', '2025-09-22 06:07:38', '2025-09-22 06:07:38'),
(2236, '25', 'Added Consultation (CI-118) for PI-110 - RAJU  S (UHID: 057556) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-22 06:07:54', '2025-09-22 06:07:54'),
(2237, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=118\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250922114923_CI-118.pdf\">View Finalized Report</a>!', '2025-09-22 06:19:44', '2025-09-22 06:19:44');
INSERT INTO `admin_updates` (`id`, `updated_by`, `update_text`, `updated_at`, `created_at`) VALUES
(2238, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=118\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250922114923_CI-118.pdf\">View Finalized Report</a>!', '2025-09-22 06:19:44', '2025-09-22 06:19:44'),
(2243, '25', 'Added a new patient SRINIVAS  REDDY V for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=112\">Check</a>', '2025-09-22 08:45:35', '2025-09-22 08:45:35'),
(2249, '25', 'Added Consultation (CI-119) for PI-111 - SRINIVAS  REDDY V (UHID: 057562) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-22 08:46:05', '2025-09-22 08:46:05'),
(2250, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=119\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250922022549_CI-119.pdf\">View Finalized Report</a>!', '2025-09-22 08:56:02', '2025-09-22 08:56:02'),
(2256, '13', 'Added a new product_category INSOLES for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/product-categories?id=2&view\">Check</a>', '2025-09-23 05:21:07', '2025-09-23 05:21:07'),
(2261, '25', 'Added a new patient VICTORIA R for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=113\">Check</a>', '2025-09-23 06:01:23', '2025-09-23 06:01:23'),
(2275, '25', 'Added Consultation (CI-120) for PI-112 - VICTORIA R (UHID: 57572) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-23 06:02:00', '2025-09-23 06:02:00'),
(2276, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=120\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250923115436_CI-120.pdf\">View Finalized Report</a>!', '2025-09-23 06:24:50', '2025-09-23 06:24:50'),
(2277, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=120\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250923115436_CI-120.pdf\">View Finalized Report</a>!', '2025-09-23 06:24:50', '2025-09-23 06:24:50'),
(2282, '25', 'Added a new patient BHASKARA RAJU HAMPI K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=114\">Check</a>', '2025-09-23 06:51:30', '2025-09-23 06:51:30'),
(2288, '25', 'Added Consultation (CI-121) for PI-113 - BHASKARA RAJU HAMPI K (UHID: 50479) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-23 06:51:50', '2025-09-23 06:51:50'),
(2289, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=121\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250923122546_CI-121.pdf\">View Finalized Report</a>!', '2025-09-23 06:56:01', '2025-09-23 06:56:01'),
(2294, '25', 'Added a new patient RAMESH R for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=115\">Check</a>', '2025-09-23 07:36:33', '2025-09-23 07:36:33'),
(2300, '25', 'Added Consultation (CI-122) for PI-114 - RAMESH R (UHID: 57571) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-23 07:37:00', '2025-09-23 07:37:00'),
(2301, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=122\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250923011023_CI-122.pdf\">View Finalized Report</a>!', '2025-09-23 07:40:37', '2025-09-23 07:40:37'),
(2306, '25', 'Added a new patient SRINIVAS B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=116\">Check</a>', '2025-09-23 07:47:24', '2025-09-23 07:47:24'),
(2312, '25', 'Added Consultation (CI-123) for PI-115 - SRINIVAS B (UHID: 26467) with    (@)', '2025-09-23 07:47:49', '2025-09-23 07:47:49'),
(2313, '25', 'Added Consultation (CI-124) for PI-115 - SRINIVAS B (UHID: 26467) with    (@)', '2025-09-23 07:47:52', '2025-09-23 07:47:52'),
(2314, '25', 'Added Consultation (CI-125) for PI-115 - SRINIVAS B (UHID: 26467) with    (@)', '2025-09-23 07:47:55', '2025-09-23 07:47:55'),
(2332, '25', 'Added Consultation (CI-126) for PI-115 - SRINIVAS B (UHID: 26467) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-23 08:05:18', '2025-09-23 08:05:18'),
(2333, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=126\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250923013818_CI-126.pdf\">View Finalized Report</a>!', '2025-09-23 08:08:32', '2025-09-23 08:08:32'),
(2343, '25', 'Added a new patient ASHOK REDDY  DEVI REDDY for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=117\">Check</a>', '2025-09-24 06:30:59', '2025-09-24 06:30:59'),
(2349, '25', 'Added Consultation (CI-127) for PI-116 - ASHOK REDDY  DEVI REDDY (UHID: 057588) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-24 06:31:28', '2025-09-24 06:31:28'),
(2350, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=127\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250924120946_CI-127.pdf\">View Finalized Report</a>!', '2025-09-24 06:39:59', '2025-09-24 06:39:59'),
(2355, '25', 'Added a new patient RAMBABU P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=118\">Check</a>', '2025-09-24 08:06:17', '2025-09-24 08:06:17'),
(2361, '25', 'Added Consultation (CI-128) for PI-117 - RAMBABU P (UHID: 032552) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-24 08:06:51', '2025-09-24 08:06:51'),
(2362, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=128\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250924014606_CI-128.pdf\">View Finalized Report</a>!', '2025-09-24 08:16:20', '2025-09-24 08:16:20'),
(2367, '25', 'Added a new patient MANMADA RAO N for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=119\">Check</a>', '2025-09-24 08:42:45', '2025-09-24 08:42:45'),
(2373, '25', 'Added Consultation (CI-129) for PI-118 - MANMADA RAO N (UHID: 06615) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-24 08:44:44', '2025-09-24 08:44:44'),
(2374, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=129\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250924022554_CI-129.pdf\">View Finalized Report</a>!', '2025-09-24 08:56:07', '2025-09-24 08:56:07'),
(2378, '25', 'Added a new patient SHANKAR  K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=120\">Check</a>', '2025-09-24 09:22:03', '2025-09-24 09:22:03'),
(2384, '25', 'Added Consultation (CI-130) for PI-119 - SHANKAR  K (UHID: 057594) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-24 09:22:28', '2025-09-24 09:22:28'),
(2385, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=130\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250924030337_CI-130.pdf\">View Finalized Report</a>!', '2025-09-24 09:33:50', '2025-09-24 09:33:50'),
(2389, '25', 'Added a new patient NAGA  JYOTHI Y for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=121\">Check</a>', '2025-09-24 09:49:53', '2025-09-24 09:49:53'),
(2395, '25', 'Added Consultation (CI-131) for PI-120 - NAGA  JYOTHI Y (UHID: 057548) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-24 09:50:16', '2025-09-24 09:50:16'),
(2396, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=131\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250924033051_CI-131.pdf\">View Finalized Report</a>!', '2025-09-24 10:01:04', '2025-09-24 10:01:04'),
(2469, '13', 'Added a new product_category Sandles for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/product-categories?id=3&view\">Check</a>', '2025-09-25 02:19:50', '2025-09-25 02:19:50'),
(2470, '13', 'Added a new product Test Product Sandle for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/products?id=3&view\">Check</a>', '2025-09-25 02:20:38', '2025-09-25 02:20:38'),
(2488, '1', 'Updated User Group <b>Adminstrator</b> successfully. <a target=\"_blank\" href=\"https://stepcure.co/admin/user-groups?id=2\">View</a>', '2025-09-25 02:29:20', '2025-09-25 02:29:20'),
(2507, '13', 'Added 1 units of stock for Product: Test Product Sandle at Site: SC-OD-KHO-06', '2025-09-25 02:31:16', '2025-09-25 02:31:16'),
(2516, '13', 'Added 10 units of stock for Product: Test Product Sandle at Site: SC-OD-ODI-04', '2025-09-25 02:32:00', '2025-09-25 02:32:00'),
(2557, '13', 'Added a new product_category Test Category for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/product-categories?id=4&view\">Check</a>', '2025-09-25 04:00:13', '2025-09-25 04:00:13'),
(2566, '13', 'Added a new product Shoes ABC for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/products?id=4&view\">Check</a>', '2025-09-25 04:01:42', '2025-09-25 04:01:42'),
(2586, '13', 'Added 10 units of stock for Product: Shoes ABC at Site: SC-OD-KHO-06', '2025-09-25 04:07:26', '2025-09-25 04:07:26'),
(2656, '14', 'Sale Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/sales/?id=2&view\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250925100600_SI-002.pdf\">View Invoice</a>!', '2025-09-25 04:36:01', '2025-09-25 04:36:01'),
(2664, '25', 'Added a new patient KALAVATI R for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=122\">Check</a>', '2025-09-25 05:31:06', '2025-09-25 05:31:06'),
(2670, '25', 'Added Consultation (CI-132) for PI-121 - KALAVATI R (UHID: 032715) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-25 05:44:23', '2025-09-25 05:44:23'),
(2671, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=132\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250925111501_CI-132.pdf\">View Finalized Report</a>!', '2025-09-25 05:45:15', '2025-09-25 05:45:15'),
(2675, '25', 'Added a new patient PADMAVATHI M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=123\">Check</a>', '2025-09-25 05:55:53', '2025-09-25 05:55:53'),
(2681, '25', 'Added Consultation (CI-133) for PI-122 - PADMAVATHI M (UHID: 4) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-25 05:56:21', '2025-09-25 05:56:21'),
(2682, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=133\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250925113442_CI-133.pdf\">View Finalized Report</a>!', '2025-09-25 06:04:55', '2025-09-25 06:04:55'),
(2687, '25', 'Added a new patient J Y for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=124\">Check</a>', '2025-09-25 06:35:34', '2025-09-25 06:35:34'),
(2701, '25', 'Added Consultation (CI-134) for PI-123 - J Y (UHID: 056945) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-25 06:36:09', '2025-09-25 06:36:09'),
(2702, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=134\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250925122752_CI-134.pdf\">View Finalized Report</a>!', '2025-09-25 06:58:04', '2025-09-25 06:58:04'),
(2707, '25', 'Added a new patient J Y for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=125\">Check</a>', '2025-09-25 07:00:03', '2025-09-25 07:00:03'),
(2713, '25', 'Added Consultation (CI-135) for PI-124 - J Y (UHID: 09876) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-25 07:00:57', '2025-09-25 07:00:57'),
(2719, '25', 'Added Consultation (CI-136) for PI-124 - J Y (UHID: 09876) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-25 07:01:29', '2025-09-25 07:01:29'),
(2728, '25', 'Added a new patient PRATHIBHA  B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=126\">Check</a>', '2025-09-26 05:21:53', '2025-09-26 05:21:53'),
(2734, '25', 'Added Consultation (CI-137) for PI-125 - PRATHIBHA  B (UHID: 026135) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-26 05:22:05', '2025-09-26 05:22:05'),
(2735, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=137\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250926110016_CI-137.pdf\">View Finalized Report</a>!', '2025-09-26 05:30:31', '2025-09-26 05:30:31'),
(2741, '25', 'Added a new patient MANOJ KUMAR R for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=127\">Check</a>', '2025-09-26 08:18:19', '2025-09-26 08:18:19'),
(2747, '25', 'Added Consultation (CI-138) for PI-126 - MANOJ KUMAR R (UHID: 057600) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-26 08:18:45', '2025-09-26 08:18:45'),
(2748, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=138\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250926015705_CI-138.pdf\">View Finalized Report</a>!', '2025-09-26 08:27:20', '2025-09-26 08:27:20'),
(2753, '25', 'Added a new patient RAMULU  P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=128\">Check</a>', '2025-09-26 10:04:48', '2025-09-26 10:04:48'),
(2759, '25', 'Added Consultation (CI-139) for PI-127 - RAMULU  P (UHID: 055410) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-26 10:05:23', '2025-09-26 10:05:23'),
(2760, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=139\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250926034631_CI-139.pdf\">View Finalized Report</a>!', '2025-09-26 10:16:45', '2025-09-26 10:16:45'),
(2764, '25', 'Added a new patient VENKATESH  GUPTA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=129\">Check</a>', '2025-09-26 10:32:02', '2025-09-26 10:32:02'),
(2770, '25', 'Added Consultation (CI-140) for PI-128 - VENKATESH  GUPTA (UHID: 057582) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-26 10:32:28', '2025-09-26 10:32:28'),
(2771, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=140\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250926041309_CI-140.pdf\">View Finalized Report</a>!', '2025-09-26 10:43:24', '2025-09-26 10:43:24'),
(2775, '25', 'Added a new patient ESWARA RAO GEDELA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=130\">Check</a>', '2025-09-26 10:57:56', '2025-09-26 10:57:56'),
(2781, '25', 'Added Consultation (CI-141) for PI-129 - ESWARA RAO GEDELA (UHID: 036461) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-26 10:58:10', '2025-09-26 10:58:10'),
(2782, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=141\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250926043211_CI-141.pdf\">View Finalized Report</a>!', '2025-09-26 11:02:24', '2025-09-26 11:02:24'),
(2786, '25', 'Added a new patient SUNIL KUMAR L for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=131\">Check</a>', '2025-09-26 11:16:44', '2025-09-26 11:16:44'),
(2792, '25', 'Added Consultation (CI-142) for PI-130 - SUNIL KUMAR L (UHID: 057601) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-26 11:16:58', '2025-09-26 11:16:58'),
(2793, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=142\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250926045709_CI-142.pdf\">View Finalized Report</a>!', '2025-09-26 11:27:23', '2025-09-26 11:27:23'),
(2798, '25', 'Added a new patient PRAMEELA  K for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=132\">Check</a>', '2025-09-26 13:05:10', '2025-09-26 13:05:10'),
(2804, '25', 'Added Consultation (CI-143) for PI-131 - PRAMEELA  K (UHID: 057603) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-26 13:06:30', '2025-09-26 13:06:30'),
(2805, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=143\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250926064738_CI-143.pdf\">View Finalized Report</a>!', '2025-09-26 13:17:51', '2025-09-26 13:17:51'),
(2811, '25', 'Added a new patient PAL PRASAD  DANDALA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=133\">Check</a>', '2025-09-27 06:24:29', '2025-09-27 06:24:29'),
(2817, '25', 'Added Consultation (CI-144) for PI-132 - PAL PRASAD  DANDALA (UHID: 057608) with    (@)', '2025-09-27 06:25:22', '2025-09-27 06:25:22'),
(2818, '25', 'Added Consultation (CI-145) for PI-132 - PAL PRASAD  DANDALA (UHID: 057608) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-27 06:25:28', '2025-09-27 06:25:28'),
(2819, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=145\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250927120501_CI-145.pdf\">View Finalized Report</a>!', '2025-09-27 06:35:16', '2025-09-27 06:35:16'),
(2824, '25', 'Added a new patient PRASHANTH  B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=134\">Check</a>', '2025-09-27 10:47:47', '2025-09-27 10:47:47'),
(2831, '25', 'Added Consultation (CI-146) for PI-133 - PRASHANTH  B (UHID: 038269) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-27 10:48:33', '2025-09-27 10:48:33'),
(2832, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=146\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250927043537_CI-146.pdf\">View Finalized Report</a>!', '2025-09-27 11:05:50', '2025-09-27 11:05:50'),
(2840, '25', 'Added a new patient RAJESWARI  B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=135\">Check</a>', '2025-09-27 12:26:27', '2025-09-27 12:26:27'),
(2846, '25', 'Added Consultation (CI-147) for PI-134 - RAJESWARI  B (UHID: 057620) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-27 12:26:38', '2025-09-27 12:26:38'),
(2847, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=147\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250927055940_CI-147.pdf\">View Finalized Report</a>!', '2025-09-27 12:29:53', '2025-09-27 12:29:53'),
(2852, '25', 'Added a new patient SUNITHA RANI  T for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=136\">Check</a>', '2025-09-29 07:01:24', '2025-09-29 07:01:24'),
(2858, '25', 'Added Consultation (CI-148) for PI-135 - SUNITHA RANI  T (UHID: 35707) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-29 07:01:45', '2025-09-29 07:01:45'),
(2859, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=148\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250929123750_CI-148.pdf\">View Finalized Report</a>!', '2025-09-29 07:08:04', '2025-09-29 07:08:04'),
(2864, '25', 'Added a new patient VENKATESWARA REDDY  M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=137\">Check</a>', '2025-09-29 07:19:12', '2025-09-29 07:19:12'),
(2870, '25', 'Added Consultation (CI-149) for PI-136 - VENKATESWARA REDDY  M (UHID: 57637) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-29 07:19:35', '2025-09-29 07:19:35'),
(2871, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=149\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250929010856_CI-149.pdf\">View Finalized Report</a>!', '2025-09-29 07:39:10', '2025-09-29 07:39:10'),
(2875, '25', 'Added a new patient ESWAR RAO N for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=138\">Check</a>', '2025-09-29 08:21:02', '2025-09-29 08:21:02'),
(2881, '25', 'Added Consultation (CI-150) for PI-137 - ESWAR RAO N (UHID: 57642) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-29 08:21:28', '2025-09-29 08:21:28'),
(2882, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=150\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250929022121_CI-150.pdf\">View Finalized Report</a>!', '2025-09-29 08:51:36', '2025-09-29 08:51:36'),
(2886, '25', 'Added a new patient RAJENDRA PRASAD RATH for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=139\">Check</a>', '2025-09-29 09:13:55', '2025-09-29 09:13:55'),
(2892, '25', 'Added Consultation (CI-151) for PI-138 - RAJENDRA PRASAD RATH (UHID: 57641) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-29 09:14:16', '2025-09-29 09:14:16'),
(2893, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=151\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250929030057_CI-151.pdf\">View Finalized Report</a>!', '2025-09-29 09:31:10', '2025-09-29 09:31:10'),
(2913, '25', 'Added a new patient bala kumar  kumar for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=140\">Check</a>', '2025-09-30 05:48:25', '2025-09-30 05:48:25'),
(2919, '25', 'Added Consultation (CI-152) for PI-139 - bala kumar  kumar (UHID: 46204) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-30 05:49:37', '2025-09-30 05:49:37'),
(2920, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=152\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250930113828_CI-152.pdf\">View Finalized Report</a>!', '2025-09-30 06:08:41', '2025-09-30 06:08:41'),
(2924, '25', 'Added a new patient PRABHAKAR  NAIDU for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=141\">Check</a>', '2025-09-30 06:12:18', '2025-09-30 06:12:18'),
(2930, '25', 'Added Consultation (CI-153) for PI-140 - PRABHAKAR  NAIDU (UHID: 45181) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-30 06:12:41', '2025-09-30 06:12:41'),
(2931, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=153\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250930120354_CI-153.pdf\">View Finalized Report</a>!', '2025-09-30 06:34:07', '2025-09-30 06:34:07'),
(2936, '25', 'Added a new patient VENKATA RAMI REDDY REDDY for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=142\">Check</a>', '2025-09-30 07:24:14', '2025-09-30 07:24:14'),
(2942, '25', 'Added Consultation (CI-154) for PI-141 - VENKATA RAMI REDDY REDDY (UHID: 057651) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-30 07:24:35', '2025-09-30 07:24:35'),
(2943, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=154\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250930011239_CI-154.pdf\">View Finalized Report</a>!', '2025-09-30 07:42:54', '2025-09-30 07:42:54'),
(2947, '25', 'Added a new patient NAGESWARA  RAO for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=143\">Check</a>', '2025-09-30 07:56:57', '2025-09-30 07:56:57'),
(2953, '25', 'Added Consultation (CI-155) for PI-142 - NAGESWARA  RAO (UHID: 057652) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-09-30 07:57:18', '2025-09-30 07:57:18'),
(2954, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=155\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20250930014302_CI-155.pdf\">View Finalized Report</a>!', '2025-09-30 08:13:16', '2025-09-30 08:13:16'),
(2959, '25', 'Added a new patient MARTHA  G for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=144\">Check</a>', '2025-10-01 05:15:05', '2025-10-01 05:15:05'),
(2965, '25', 'Added Consultation (CI-156) for PI-143 - MARTHA  G (UHID: 057655) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-01 05:15:50', '2025-10-01 05:15:50'),
(2966, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=156\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251001105533_CI-156.pdf\">View Finalized Report</a>!', '2025-10-01 05:25:47', '2025-10-01 05:25:47'),
(2970, '25', 'Added a new patient ANIL KUMAR  BALLA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=145\">Check</a>', '2025-10-01 05:36:38', '2025-10-01 05:36:38'),
(2976, '25', 'Added Consultation (CI-157) for PI-144 - ANIL KUMAR  BALLA (UHID: 041268) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-01 05:44:05', '2025-10-01 05:44:05'),
(2977, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=157\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251001111431_CI-157.pdf\">View Finalized Report</a>!', '2025-10-01 05:44:44', '2025-10-01 05:44:44'),
(2981, '25', 'Added a new patient BHANU  MURTHY G for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=146\">Check</a>', '2025-10-01 06:42:54', '2025-10-01 06:42:54'),
(2987, '25', 'Added Consultation (CI-158) for PI-145 - BHANU  MURTHY G (UHID: 057659) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-01 06:43:43', '2025-10-01 06:43:43'),
(2988, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=158\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251001122931_CI-158.pdf\">View Finalized Report</a>!', '2025-10-01 06:59:46', '2025-10-01 06:59:46'),
(2992, '25', 'Added a new patient SUJATHA  N for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=147\">Check</a>', '2025-10-01 07:12:36', '2025-10-01 07:12:36'),
(2998, '25', 'Added Consultation (CI-159) for PI-146 - SUJATHA  N (UHID: 057658) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-01 07:13:28', '2025-10-01 07:13:28'),
(2999, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=159\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251001125457_CI-159.pdf\">View Finalized Report</a>!', '2025-10-01 07:25:12', '2025-10-01 07:25:12'),
(3005, '25', 'Added a new patient UDA  KIRAN for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=148\">Check</a>', '2025-10-01 10:08:41', '2025-10-01 10:08:41'),
(3011, '25', 'Added Consultation (CI-160) for PI-147 - UDA  KIRAN (UHID: 057663) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-01 10:09:31', '2025-10-01 10:09:31'),
(3012, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=160\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251001035237_CI-160.pdf\">View Finalized Report</a>!', '2025-10-01 10:22:50', '2025-10-01 10:22:50'),
(3016, '25', 'Added a new patient TEENA  KUMARI P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=149\">Check</a>', '2025-10-01 10:41:19', '2025-10-01 10:41:19'),
(3022, '25', 'Added Consultation (CI-161) for PI-148 - TEENA  KUMARI P (UHID: 057667) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-01 10:41:41', '2025-10-01 10:41:41'),
(3023, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=161\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251001042311_CI-161.pdf\">View Finalized Report</a>!', '2025-10-01 10:53:25', '2025-10-01 10:53:25'),
(3028, '25', 'Added a new patient RAMESH A for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=150\">Check</a>', '2025-10-01 12:15:07', '2025-10-01 12:15:07'),
(3034, '25', 'Added Consultation (CI-162) for PI-149 - RAMESH A (UHID: 057671) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-01 12:22:43', '2025-10-01 12:22:43'),
(3035, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=162\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251001055536_CI-162.pdf\">View Finalized Report</a>!', '2025-10-01 12:25:51', '2025-10-01 12:25:51'),
(3044, '25', 'Added a new patient VENKATA REDDY M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=151\">Check</a>', '2025-10-03 06:11:12', '2025-10-03 06:11:12'),
(3050, '25', 'Added Consultation (CI-163) for PI-150 - VENKATA REDDY M (UHID: 057682) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-03 06:11:29', '2025-10-03 06:11:29'),
(3051, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=163\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251003120005_CI-163.pdf\">View Finalized Report</a>!', '2025-10-03 06:30:21', '2025-10-03 06:30:21'),
(3058, '25', 'Added a new patient NAGAVENI  B for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=152\">Check</a>', '2025-10-03 06:41:52', '2025-10-03 06:41:52'),
(3064, '25', 'Added Consultation (CI-164) for PI-151 - NAGAVENI  B (UHID: 057685) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-03 06:42:35', '2025-10-03 06:42:35'),
(3065, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=164\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251003122400_CI-164.pdf\">View Finalized Report</a>!', '2025-10-03 06:54:12', '2025-10-03 06:54:12'),
(3072, '25', 'Added a new patient GEETA  DEVI  for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=153\">Check</a>', '2025-10-03 09:50:03', '2025-10-03 09:50:03'),
(3078, '25', 'Added Consultation (CI-165) for PI-152 - GEETA  DEVI  (UHID: 057687) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-03 10:05:09', '2025-10-03 10:05:09'),
(3079, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=165\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251003033603_CI-165.pdf\">View Finalized Report</a>!', '2025-10-03 10:06:18', '2025-10-03 10:06:18'),
(3088, '25', 'Added a new patient RAMANA KUMAR M for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=154\">Check</a>', '2025-10-04 06:04:51', '2025-10-04 06:04:51'),
(3094, '25', 'Added Consultation (CI-166) for PI-153 - RAMANA KUMAR M (UHID: 053587) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 06:05:17', '2025-10-04 06:05:17'),
(3095, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=166\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004113555_CI-166.pdf\">View Finalized Report</a>!', '2025-10-04 06:06:09', '2025-10-04 06:06:09'),
(3099, '25', 'Added a new patient SUNITHA  PATLI for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=155\">Check</a>', '2025-10-04 06:29:07', '2025-10-04 06:29:07'),
(3105, '25', 'Added Consultation (CI-167) for PI-154 - SUNITHA  PATLI (UHID: 057700) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 06:29:42', '2025-10-04 06:29:42'),
(3106, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=167\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004120039_CI-167.pdf\">View Finalized Report</a>!', '2025-10-04 06:30:54', '2025-10-04 06:30:54'),
(3110, '25', 'Added a new patient NAYEEM BIN  SALAM for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=156\">Check</a>', '2025-10-04 07:26:09', '2025-10-04 07:26:09'),
(3116, '25', 'Added Consultation (CI-168) for PI-155 - NAYEEM BIN  SALAM (UHID: 057148) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 07:27:00', '2025-10-04 07:27:00'),
(3117, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=168\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004010838_CI-168.pdf\">View Finalized Report</a>!', '2025-10-04 07:38:53', '2025-10-04 07:38:53'),
(3121, '25', 'Added a new patient SYED KHALEEL UR RAHMAN for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=157\">Check</a>', '2025-10-04 07:55:28', '2025-10-04 07:55:28'),
(3127, '25', 'Added Consultation (CI-169) for PI-156 - SYED KHALEEL UR RAHMAN (UHID: 057697) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 07:56:11', '2025-10-04 07:56:11'),
(3128, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=169\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004012713_CI-169.pdf\">View Finalized Report</a>!', '2025-10-04 07:57:28', '2025-10-04 07:57:28'),
(3132, '25', 'Added a new patient ISMATH  UNNISA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=158\">Check</a>', '2025-10-04 08:15:08', '2025-10-04 08:15:08'),
(3138, '25', 'Added Consultation (CI-170) for PI-157 - ISMATH  UNNISA (UHID: 057698) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 08:15:43', '2025-10-04 08:15:43'),
(3139, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=170\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004014624_CI-170.pdf\">View Finalized Report</a>!', '2025-10-04 08:16:38', '2025-10-04 08:16:38'),
(3143, '25', 'Added a new patient JOY  V for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=159\">Check</a>', '2025-10-04 08:19:55', '2025-10-04 08:19:55'),
(3149, '25', 'Added Consultation (CI-171) for PI-158 - JOY  V (UHID: 034333) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 08:20:46', '2025-10-04 08:20:46'),
(3150, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=171\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004015825_CI-171.pdf\">View Finalized Report</a>!', '2025-10-04 08:28:38', '2025-10-04 08:28:38'),
(3154, '25', 'Added a new patient MAHESH KUMAR J for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=160\">Check</a>', '2025-10-04 08:36:57', '2025-10-04 08:36:57'),
(3160, '25', 'Added Consultation (CI-172) for PI-159 - MAHESH KUMAR J (UHID: 057706) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 08:37:34', '2025-10-04 08:37:34'),
(3161, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=172\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004021656_CI-172.pdf\">View Finalized Report</a>!', '2025-10-04 08:47:10', '2025-10-04 08:47:10'),
(3166, '25', 'Added a new patient SULOCHANA  S for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=161\">Check</a>', '2025-10-04 09:55:54', '2025-10-04 09:55:54'),
(3172, '25', 'Added Consultation (CI-173) for PI-160 - SULOCHANA  S (UHID: 035097) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 09:57:25', '2025-10-04 09:57:25'),
(3173, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=173\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004033918_CI-173.pdf\">View Finalized Report</a>!', '2025-10-04 10:09:33', '2025-10-04 10:09:33'),
(3177, '25', 'Added a new patient DEVI G for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=162\">Check</a>', '2025-10-04 10:11:01', '2025-10-04 10:11:01'),
(3183, '25', 'Added Consultation (CI-174) for PI-161 - DEVI G (UHID: 057705) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 10:11:20', '2025-10-04 10:11:20'),
(3184, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=174\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004035242_CI-174.pdf\">View Finalized Report</a>!', '2025-10-04 10:22:56', '2025-10-04 10:22:56'),
(3188, '25', 'Added a new patient RAVI KUMAR B.K.R for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=163\">Check</a>', '2025-10-04 10:56:52', '2025-10-04 10:56:52'),
(3202, '25', 'Added Consultation (CI-175) for PI-162 - RAVI KUMAR B.K.R (UHID: 051285) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 10:57:33', '2025-10-04 10:57:33'),
(3203, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=175\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004043606_CI-175.pdf\">View Finalized Report</a>!', '2025-10-04 11:06:20', '2025-10-04 11:06:20'),
(3207, '25', 'Added a new patient BHARATHI  Y for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=164\">Check</a>', '2025-10-04 11:18:01', '2025-10-04 11:18:01'),
(3213, '25', 'Added Consultation (CI-176) for PI-163 - BHARATHI  Y (UHID: 057712) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 11:18:44', '2025-10-04 11:18:44'),
(3214, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=176\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004045900_CI-176.pdf\">View Finalized Report</a>!', '2025-10-04 11:29:13', '2025-10-04 11:29:13'),
(3219, '25', 'Added a new patient P. DEVAKAMMA  for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=165\">Check</a>', '2025-10-04 12:56:46', '2025-10-04 12:56:46'),
(3225, '25', 'Added Consultation (CI-177) for PI-164 - P. DEVAKAMMA  (UHID: 022191) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-04 13:10:17', '2025-10-04 13:10:17'),
(3226, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=177\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251004064110_CI-177.pdf\">View Finalized Report</a>!', '2025-10-04 13:11:25', '2025-10-04 13:11:25'),
(3239, '25', 'Added a new patient AJAY ROHIT PALA for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=166\">Check</a>', '2025-10-06 06:14:55', '2025-10-06 06:14:55'),
(3260, '25', 'Added Consultation (CI-178) for PI-165 - AJAY ROHIT PALA (UHID: 57727) with    (@)', '2025-10-06 06:48:07', '2025-10-06 06:48:07'),
(3261, '25', 'Added Consultation (CI-179) for PI-165 - AJAY ROHIT PALA (UHID: 57727) with Dr. Supriya  Priyadarshini (@supriya01)', '2025-10-06 06:48:15', '2025-10-06 06:48:15'),
(3262, '25', 'Consultation Details: <a target=\"_blank\" href=\"https://stepcure.co/admin/consultations/?id=179\">View all details</a>! <a target=\"_blank\" href=\"https://stepcure.co/system_generated/20251006121923_CI-179.pdf\">View Finalized Report</a>!', '2025-10-06 06:49:40', '2025-10-06 06:49:40'),
(3269, '13', 'Trashed User @rahulyadav (Rahul Yadav) from the organization!', '2025-10-06 07:30:40', '2025-10-06 07:30:40'),
(3270, '13', 'Trashed User @_sieezu_ (Akash Kumar) from the organization!', '2025-10-06 07:30:42', '2025-10-06 07:30:42'),
(3271, '13', 'Trashed User @_sieezu_ (Akash Kumar) from the organization!', '2025-10-06 07:30:51', '2025-10-06 07:30:51'),
(3272, '13', 'Trashed User @max (Max Planck) from the organization!', '2025-10-06 07:30:53', '2025-10-06 07:30:53'),
(3273, '13', 'Trashed User @ankita (Ankita Ghosla) from the organization!', '2025-10-06 07:30:55', '2025-10-06 07:30:55'),
(3274, '13', 'Trashed User @sumit (Sumit Arora) from the organization!', '2025-10-06 07:30:58', '2025-10-06 07:30:58'),
(3275, '25', 'Added a new patient LINGA RAJU CH for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=167\">Check</a>', '2025-10-06 07:43:42', '2025-10-06 07:43:42'),
(3295, '25', 'Added a new patient RAJESWARI P for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"https://stepcure.co/admin/patients?id=168\">Check</a>', '2025-10-06 08:11:38', '2025-10-06 08:11:38'),
(3309, '1', 'Added Consultation (CI-180) for PI-001 - Sazad Ahemad (UHID: 123456789000) with    (@)', '2025-10-06 19:00:17', '2025-10-06 19:00:17'),
(3310, '1', 'Added Consultation (CI-181) for PI-001 - Sazad Ahemad (UHID: 123456789000) with    (@)', '2025-10-06 19:00:24', '2025-10-06 19:00:24'),
(3312, '1', 'Updated User Group <b>Adminstrator</b> successfully. <a target=\"_blank\" href=\"http://localhost/stepcure/admin/user-groups?id=2\">View</a>', '2025-10-09 01:06:52', '2025-10-09 01:06:52'),
(3315, '1', 'Updated User Group <b>Staffs</b> successfully. <a target=\"_blank\" href=\"http://localhost/stepcure/admin/user-groups?id=24\">View</a>', '2025-10-09 01:18:11', '2025-10-09 01:18:11'),
(3316, '1', 'Updated User Group <b>Staffs</b> successfully. <a target=\"_blank\" href=\"http://localhost/stepcure/admin/user-groups?id=24\">View</a>', '2025-10-09 01:18:21', '2025-10-09 01:18:21'),
(3327, '1', 'Updated User Group <b>Staffs</b> successfully. <a target=\"_blank\" href=\"http://localhost/stepcure/admin/user-groups?id=24\">View</a>', '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(3405, 'connect2sazad', 'Updated the Application Settings. They have changed the consent_form_text from \"<ol>\r\n<li>Your orthotist has prescribed a custom orthotic insole following a thorough assessment and detailed procedure. Orthotists can play an integral role in patient care by helping to manage foot pain, correct foot deformities, and accommodate abnormal foot function.</li>\r\n<li>Abnormal foot function may lead to pain in the legs, knees, hips, and spine.</li>\r\n<li>Orthotics are designed based on the degree of abnormal foot function, the patient\'s activity level, posture, and the type of footwear in which the orthotics will be worn. Custom orthotics are foot inserts placed inside footwear to provide support and improve foot function.</li>\r\n<li>Your orthotist will assess your foot function to determine whether you require foot orthotics and, if so, what type of orthotic will benefit you most.</li>\r\n<li>Many patients experience reduced pain and increased comfort when wearing custom foot orthotics. A small percentage of patients may experience discomfort and/or pain during the break-in period. An even smaller percentage may experience significant pain that prevents them from wearing the orthotics altogether.</li>\r\n<li>I have read the information above and hereby request and consent to the assessment of my foot function and the prescription of custom foot orthotics.</li>\r\n<li>I acknowledge that I have had the opportunity to discuss the purpose, benefits, and risks of custom foot orthotics with my orthotist. I understand and have been informed that, as with any orthotic treatment, there are potential risks, including but not limited to foot pain, leg pain, and back or neck pain.</li>\r\n<li>I have read the above consent form and have had the opportunity to ask questions about its contents. By signing below, I agree to the treatment/procedure described above. I intend for this consent to cover the entire course of treatment for both present and future conditions for which I seek foot orthotic treatment with thermoformed insoles.</li>\r\n</ol>\" to \"<ol>\\r\\n<li>Your orthotist has prescribed a custom orthotic insole following a thorough assessment and detailed procedure. Orthotists can play an integral role in patient care by helping to manage foot pain, correct foot deformities, and accommodate abnormal foot function.</li>\\r\\n<li>Abnormal foot function may lead to pain in the legs, knees, hips, and spine.</li>\\r\\n<li>Orthotics are designed based on the degree of abnormal foot function, the patient\\\'s activity level, posture, and the type of footwear in which the orthotics will be worn. Custom orthotics are foot inserts placed inside footwear to provide support and improve foot function.</li>\\r\\n<li>Your orthotist will assess your foot function to determine whether you require foot orthotics and, if so, what type of orthotic will benefit you most.</li>\\r\\n<li>Many patients experience reduced pain and increased comfort when wearing custom foot orthotics. A small percentage of patients may experience discomfort and/or pain during the break-in period. An even smaller percentage may experience significant pain that prevents them from wearing the orthotics altogether.</li>\\r\\n<li>I have read the information above and hereby request and consent to the assessment of my foot function and the prescription of custom foot orthotics.</li>\\r\\n<li>I acknowledge that I have had the opportunity to discuss the purpose, benefits, and risks of custom foot orthotics with my orthotist. I understand and have been informed that, as with any orthotic treatment, there are potential risks, including but not limited to foot pain, leg pain, and back or neck pain.</li>\\r\\n<li>I have read the above consent form and have had the opportunity to ask questions about its contents. By signing below, I agree to the treatment/procedure described above. I intend for this consent to cover the entire course of treatment for both present and future conditions for which I seek foot orthotic treatment with thermoformed insoles.</li>\\r\\n</ol>\"', '2025-10-09 02:37:27', '2025-10-09 02:37:27'),
(3406, 'connect2sazad', 'Updated the Application Settings. They have changed the default_site_id from \"34\" to \"37\"', '2025-10-09 02:39:12', '2025-10-09 02:39:12');
INSERT INTO `admin_updates` (`id`, `updated_by`, `update_text`, `updated_at`, `created_at`) VALUES
(3407, 'connect2sazad', 'Updated the Application Settings. They have changed the consent_form_text from \"<ol>\r\n<li>Your orthotist has prescribed a custom orthotic insole following a thorough assessment and detailed procedure. Orthotists can play an integral role in patient care by helping to manage foot pain, correct foot deformities, and accommodate abnormal foot function.</li>\r\n<li>Abnormal foot function may lead to pain in the legs, knees, hips, and spine.</li>\r\n<li>Orthotics are designed based on the degree of abnormal foot function, the patient\'s activity level, posture, and the type of footwear in which the orthotics will be worn. Custom orthotics are foot inserts placed inside footwear to provide support and improve foot function.</li>\r\n<li>Your orthotist will assess your foot function to determine whether you require foot orthotics and, if so, what type of orthotic will benefit you most.</li>\r\n<li>Many patients experience reduced pain and increased comfort when wearing custom foot orthotics. A small percentage of patients may experience discomfort and/or pain during the break-in period. An even smaller percentage may experience significant pain that prevents them from wearing the orthotics altogether.</li>\r\n<li>I have read the information above and hereby request and consent to the assessment of my foot function and the prescription of custom foot orthotics.</li>\r\n<li>I acknowledge that I have had the opportunity to discuss the purpose, benefits, and risks of custom foot orthotics with my orthotist. I understand and have been informed that, as with any orthotic treatment, there are potential risks, including but not limited to foot pain, leg pain, and back or neck pain.</li>\r\n<li>I have read the above consent form and have had the opportunity to ask questions about its contents. By signing below, I agree to the treatment/procedure described above. I intend for this consent to cover the entire course of treatment for both present and future conditions for which I seek foot orthotic treatment with thermoformed insoles.</li>\r\n</ol>\" to \"<ol>\\r\\n<li>Your orthotist has prescribed a custom orthotic insole following a thorough assessment and detailed procedure. Orthotists can play an integral role in patient care by helping to manage foot pain, correct foot deformities, and accommodate abnormal foot function.</li>\\r\\n<li>Abnormal foot function may lead to pain in the legs, knees, hips, and spine.</li>\\r\\n<li>Orthotics are designed based on the degree of abnormal foot function, the patient\\\'s activity level, posture, and the type of footwear in which the orthotics will be worn. Custom orthotics are foot inserts placed inside footwear to provide support and improve foot function.</li>\\r\\n<li>Your orthotist will assess your foot function to determine whether you require foot orthotics and, if so, what type of orthotic will benefit you most.</li>\\r\\n<li>Many patients experience reduced pain and increased comfort when wearing custom foot orthotics. A small percentage of patients may experience discomfort and/or pain during the break-in period. An even smaller percentage may experience significant pain that prevents them from wearing the orthotics altogether.</li>\\r\\n<li>I have read the information above and hereby request and consent to the assessment of my foot function and the prescription of custom foot orthotics.</li>\\r\\n<li>I acknowledge that I have had the opportunity to discuss the purpose, benefits, and risks of custom foot orthotics with my orthotist. I understand and have been informed that, as with any orthotic treatment, there are potential risks, including but not limited to foot pain, leg pain, and back or neck pain.</li>\\r\\n<li>I have read the above consent form and have had the opportunity to ask questions about its contents. By signing below, I agree to the treatment/procedure described above. I intend for this consent to cover the entire course of treatment for both present and future conditions for which I seek foot orthotic treatment with thermoformed insoles.</li>\\r\\n</ol>\"', '2025-10-09 02:39:12', '2025-10-09 02:39:12'),
(3408, '1', 'Updated details for the site \"Odisha Site 1\". <a target=\"_blank\" href=\"http://localhost/stepcure/admin/treatment-sites/?id=34\">View all details</a>!', '2025-10-09 06:20:44', '2025-10-09 06:20:44'),
(3409, '1', 'Updated details for the site \"StepCure Odisha Site 1\". <a target=\"_blank\" href=\"http://localhost/stepcure/admin/treatment-sites/?id=34\">View all details</a>!', '2025-10-09 06:21:08', '2025-10-09 06:21:08'),
(3410, '1', 'Updated details for the site \"StepCure Odisha 1\". <a target=\"_blank\" href=\"http://localhost/stepcure/admin/treatment-sites/?id=34\">View all details</a>!', '2025-10-09 06:21:21', '2025-10-09 06:21:21'),
(3411, '1', 'Added 10 units of stock for Product: Test Product at Site: SC-TG-HYD-05', '2025-10-09 06:27:37', '2025-10-09 06:27:37'),
(3412, '1', 'Added 20 units of stock for Product: Product 2 at Site: SC-TG-HYD-05', '2025-10-09 06:28:18', '2025-10-09 06:28:18'),
(3413, '1', 'Added 200 units of stock for Product: Test Product Sandle at Site: SC-TG-HYD-05', '2025-10-09 06:28:31', '2025-10-09 06:28:31'),
(3414, '1', 'Added 10 units of stock for Product: Shoes ABC at Site: SC-TG-HYD-05', '2025-10-09 06:28:45', '2025-10-09 06:28:45'),
(3415, '1', 'Sale Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011110506_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 05:35:09', '2025-10-11 05:35:09'),
(3416, '1', 'Sale Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011112712_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 05:57:15', '2025-10-11 05:57:15'),
(3417, '1', 'Sale Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011113315_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:03:16', '2025-10-11 06:03:16'),
(3418, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011113728_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:07:28', '2025-10-11 06:07:28'),
(3419, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011114256_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:12:57', '2025-10-11 06:12:57'),
(3420, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011114644_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:16:44', '2025-10-11 06:16:44'),
(3421, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011114808_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:18:09', '2025-10-11 06:18:09'),
(3422, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011114937_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:19:37', '2025-10-11 06:19:37'),
(3423, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011115131_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:21:32', '2025-10-11 06:21:32'),
(3424, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011115228_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:22:29', '2025-10-11 06:22:29'),
(3425, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011115327_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:23:28', '2025-10-11 06:23:28'),
(3426, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011115549_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:25:50', '2025-10-11 06:25:50'),
(3427, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011120805_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:38:06', '2025-10-11 06:38:06'),
(3428, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011120838_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 06:38:38', '2025-10-11 06:38:38'),
(3429, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011123741_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:07:42', '2025-10-11 07:07:42'),
(3430, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011123917_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:09:18', '2025-10-11 07:09:18'),
(3431, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011124000_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:10:01', '2025-10-11 07:10:01'),
(3432, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011124103_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:11:04', '2025-10-11 07:11:04'),
(3433, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011124205_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:12:06', '2025-10-11 07:12:06'),
(3434, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011124459_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:15:00', '2025-10-11 07:15:00'),
(3435, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011124659_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:17:00', '2025-10-11 07:17:00'),
(3436, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011124903_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:19:04', '2025-10-11 07:19:04'),
(3437, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011125048_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:20:49', '2025-10-11 07:20:49'),
(3438, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011125323_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:23:24', '2025-10-11 07:23:24'),
(3439, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011131121_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:41:23', '2025-10-11 07:41:23'),
(3440, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011131620_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:46:21', '2025-10-11 07:46:21'),
(3441, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011131737_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:47:37', '2025-10-11 07:47:37'),
(3442, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011132052_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:50:53', '2025-10-11 07:50:53'),
(3443, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011132238_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:52:39', '2025-10-11 07:52:39'),
(3444, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=1&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011132635_CSI-001.pdf\">View Invoice</a>!', '2025-10-11 07:56:36', '2025-10-11 07:56:36'),
(3445, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=4&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011132656_CSI-003.pdf\">View Invoice</a>!', '2025-10-11 07:56:57', '2025-10-11 07:56:57'),
(3446, '1', 'Updated details for the Product \"Test Product\". <a target=\"_blank\" href=\"http://localhost/stepcure/admin/products/?id=1\">View all details</a>!', '2025-10-11 08:20:42', '2025-10-11 08:20:42'),
(3447, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=6&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011140918_CSI-005.pdf\">View Invoice</a>!', '2025-10-11 08:39:19', '2025-10-11 08:39:19'),
(3448, '1', 'Added 10 units of stock for Product: Test Product at Site: SC-TG-HYD-05', '2025-10-11 08:40:23', '2025-10-11 08:40:23'),
(3449, '1', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=5&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251011141113_CSI-004.pdf\">View Invoice</a>!', '2025-10-11 08:41:13', '2025-10-11 08:41:13'),
(3457, '14', 'Added Consultation (CI-182) for PI-001 - Sazad Ahemad (UHID: 123456789000) with Dr. Amit Shukla (@amit)', '2025-11-06 03:05:02', '2025-11-06 03:05:02'),
(3461, '14', 'Consultation Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/consultations/?id=182\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20251106083540_CI-182.pdf\">View Finalized Report</a>!', '2025-11-06 03:05:41', '2025-11-06 03:05:41'),
(3468, '1', 'Updated details for the Address State \"Andhra Pradesh\". <a target=\"_blank\" href=\"http://localhost/stepcure/admin/address-states/?id=1\">View all details</a>!', '2026-03-19 06:25:26', '2026-03-19 06:25:26'),
(3502, 'admin', 'Updated their profile details.', '2026-07-18 20:59:24', '2026-07-18 20:59:24'),
(3503, '1', 'Updated User Group Adminstrator successfully. <a target=\"_blank\" href=\"http://localhost/stepcure/admin/user-groups?id=2\">View</a>', '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(3504, '13', 'Created service SC001.', '2026-07-18 21:25:51', '2026-07-18 21:25:51'),
(3505, '13', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=7&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20260719031307_CSI-006.pdf\">View Invoice</a>!', '2026-07-18 21:43:07', '2026-07-18 21:43:07'),
(3506, '13', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=7&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20260719031416_CSI-006.pdf\">View Invoice</a>!', '2026-07-18 21:44:16', '2026-07-18 21:44:16'),
(3507, '13', 'Invoice Details: <a target=\"_blank\" href=\"http://localhost/stepcure/admin/sales/?id=7&view\">View all details</a>! <a target=\"_blank\" href=\"http://localhost/stepcure/system_generated/20260719191508_CSI-006.pdf\">View Invoice</a>!', '2026-07-19 13:45:08', '2026-07-19 13:45:08'),
(3508, '13', 'Updated User <a target=\"_blank\" href=\"http://localhost/stepcure/admin/profile/?userid=amit\">@amit (Amit Shukla)</a> for the organization! Check out, how they have managed to do it! <a target=\"_blank\" href=\"http://localhost/stepcure/admin/users?id=14\">Check</a>', '2026-07-19 13:46:56', '2026-07-19 13:46:56');

-- --------------------------------------------------------

--
-- Table structure for table `consultations`
--

CREATE TABLE `consultations` (
  `id` int(11) NOT NULL,
  `consultationid` int(11) NOT NULL,
  `recomended_by_user_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `prior_issues` mediumtext DEFAULT NULL,
  `scan_3d_parameter` int(2) DEFAULT 0 COMMENT '0=no, 1=yes',
  `scan_3d_left_foot_type` varchar(50) DEFAULT NULL,
  `scan_3d_left_arch_type` varchar(50) DEFAULT NULL,
  `scan_3d_left_heel_angle` varchar(50) DEFAULT NULL,
  `scan_3d_right_foot_type` varchar(50) DEFAULT NULL,
  `scan_3d_right_arch_type` varchar(50) DEFAULT NULL,
  `scan_3d_right_heel_angle` varchar(50) DEFAULT NULL,
  `scan_3d_file` mediumtext DEFAULT NULL,
  `scan_planter_pressure_parameters` int(2) DEFAULT 0 COMMENT '0=no, 1=yes',
  `scan_planter_pressure_left_morpho_type` varchar(50) DEFAULT NULL,
  `scan_planter_pressure_left_max_pressure` varchar(50) DEFAULT NULL,
  `scan_planter_pressure_right_morpho_type` varchar(50) DEFAULT NULL,
  `scan_planter_pressure_right_max_pressure` varchar(50) DEFAULT NULL,
  `scan_planter_pressure_file` mediumtext DEFAULT NULL,
  `ankle_brachial_index` int(2) NOT NULL DEFAULT 0,
  `ankle_brachial_left_dorsalis_pedis` int(11) DEFAULT NULL,
  `ankle_brachial_left_arm_ap` int(11) DEFAULT NULL,
  `ankle_brachial_right_dorsalis_pedis` int(11) DEFAULT NULL,
  `ankle_brachial_right_arm_ap` int(11) DEFAULT NULL,
  `summary_report` longtext NOT NULL,
  `prescriptions` longtext NOT NULL,
  `is_report_finalized` int(2) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `report_file` mediumtext NOT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active	',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '	0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `consultations`
--

INSERT INTO `consultations` (`id`, `consultationid`, `recomended_by_user_id`, `user_id`, `patient_id`, `site_id`, `prior_issues`, `scan_3d_parameter`, `scan_3d_left_foot_type`, `scan_3d_left_arch_type`, `scan_3d_left_heel_angle`, `scan_3d_right_foot_type`, `scan_3d_right_arch_type`, `scan_3d_right_heel_angle`, `scan_3d_file`, `scan_planter_pressure_parameters`, `scan_planter_pressure_left_morpho_type`, `scan_planter_pressure_left_max_pressure`, `scan_planter_pressure_right_morpho_type`, `scan_planter_pressure_right_max_pressure`, `scan_planter_pressure_file`, `ankle_brachial_index`, `ankle_brachial_left_dorsalis_pedis`, `ankle_brachial_left_arm_ap`, `ankle_brachial_right_dorsalis_pedis`, `ankle_brachial_right_arm_ap`, `summary_report`, `prescriptions`, `is_report_finalized`, `report_file`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 23, 14, 1, 36, '1,5', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 1, 3, 2, 4, '<p>scfsdvcsd</p>', '<p>dsdvsd</p>', 1, '20250823013837_CI-001.pdf', 'test', 1, 0, 14, 14, '2025-08-22 20:07:32', '2025-08-22 20:08:38'),
(2, 2, 25, 25, 2, 37, '1,5', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>hjkl</p>', '<p>hjkl</p>', 1, '20250823095318_CI-002.pdf', '', 1, 0, 25, 25, '2025-08-23 04:09:35', '2025-08-23 04:23:32'),
(3, 3, 14, 25, 3, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,MILD RISK FOR DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250823121139_CI-003.pdf', '', 1, 0, 25, 25, '2025-08-23 06:24:03', '2025-08-23 06:41:52'),
(4, 4, 0, 25, 5, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-08-23 11:23:51', '2025-08-25 04:09:15'),
(5, 5, 13, 25, 5, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-08-23 11:23:58', '2025-08-25 04:09:18'),
(6, 6, 13, 25, 5, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-08-23 11:24:03', '2025-08-25 04:09:21'),
(7, 7, 14, 25, 5, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,MIXED FIBER NEUROPATHY,MODERATE RISK FOR DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250823051217_CI-007.pdf', '', 1, 0, 25, 25, '2025-08-23 11:24:33', '2025-08-23 11:42:31'),
(8, 8, 14, 25, 6, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p><span style=\"color: #e03e2d;\"><strong>INSOLES</strong></span></p>', 1, '20250825113346_CI-008.pdf', '', 1, 0, 25, 25, '2025-08-25 05:50:53', '2025-08-25 06:03:59'),
(9, 9, 25, 25, 7, 37, '', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p><span style=\"color: #e03e2d;\"><strong>CUSTOMISED MCP FOOTWEAR</strong></span></p>', 1, '20250825013008_CI-009.pdf', '', 1, 0, 25, 25, '2025-08-25 07:50:09', '2025-08-25 08:00:22'),
(10, 10, 25, 25, 8, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK FOR DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250826105054_CI-010.pdf', '', 1, 0, 25, 25, '2025-08-26 05:11:07', '2025-08-26 05:21:08'),
(11, 11, 13, 25, 9, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-08-26 08:32:37', '2025-08-26 08:32:37'),
(12, 12, 13, 25, 9, 37, '', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250826021501_CI-012.pdf', '', 1, 0, 25, 25, '2025-08-26 08:32:38', '2025-08-26 08:45:14'),
(13, 13, 13, 25, 10, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250826031952_CI-013.pdf', '', 1, 0, 25, 25, '2025-08-26 09:37:00', '2025-08-26 09:50:07'),
(14, 14, 25, 25, 11, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Normal', NULL, 1, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250828104834_CI-014.pdf', '', 1, 0, 25, 25, '2025-08-28 05:10:03', '2025-08-28 05:18:48'),
(15, 15, 13, 25, 12, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,RT MILD FLATFOOT,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250829124154_CI-015.pdf', '', 1, 0, 25, 25, '2025-08-29 06:57:31', '2025-08-29 07:12:07'),
(16, 16, 13, 25, 13, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250829125716_CI-016.pdf', '', 1, 0, 25, 25, '2025-08-29 07:15:59', '2025-08-29 07:27:29'),
(17, 17, 13, 25, 14, 37, '1', 1, 'Cavus', 'Normal', 'Eversion', 'Cavus', 'Normal', 'Eversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,CAVUS FEET,EVERTED HEEL,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>INSOLES</p>', 1, '20250829021536_CI-017.pdf', '', 1, 0, 25, 25, '2025-08-29 08:26:55', '2025-08-29 08:45:49'),
(18, 18, 13, 25, 15, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250830112529_CI-018.pdf', '', 1, 0, 25, 25, '2025-08-30 05:54:56', '2025-08-30 05:55:42'),
(19, 19, 13, 25, 16, 37, '1', 1, 'Normal', 'Normal', 'Eversion', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,RT MILD FLATFOOT,LT EVERTED HEEL,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250830120121_CI-019.pdf', '', 1, 0, 25, 25, '2025-08-30 06:14:43', '2025-08-30 06:31:34'),
(20, 20, 13, 25, 17, 37, '1,3', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 1, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250830010814_CI-020.pdf', '', 1, 0, 25, 25, '2025-08-30 07:24:51', '2025-08-30 07:38:27'),
(21, 21, 13, 25, 18, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250830030828_CI-021.pdf', '', 1, 0, 25, 25, '2025-08-30 09:28:45', '2025-08-30 09:38:41'),
(22, 22, 13, 25, 19, 37, '1', 1, 'Cavus', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>LT CAVUS FOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250830043102_CI-022.pdf', '', 1, 0, 25, 25, '2025-08-30 10:40:20', '2025-08-30 11:01:16'),
(23, 23, 13, 25, 20, 37, '1', 1, 'Flatfoot', 'Severe', 'Eversion', 'Flatfoot', 'Severe', 'Normal', NULL, 1, 'Flat', 'Hindfoot', 'Flat', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLTFEET,LT EVERTED HEEL,MULTIPLE CORN ON PLANTAR SURFACE OF RT FOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250830045844_CI-023.pdf', '', 1, 0, 25, 25, '2025-08-30 11:06:21', '2025-08-30 11:28:57'),
(24, 24, 13, 25, 21, 37, '1,4', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,FOCAL NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250901112435_CI-024.pdf', '', 1, 0, 25, 25, '2025-09-01 05:37:25', '2025-09-01 05:54:49'),
(25, 25, 13, 25, 22, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,RT FLAT FOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250901125336_CI-025.pdf', '', 1, 0, 25, 25, '2025-09-01 07:07:35', '2025-09-01 07:23:50'),
(26, 26, 13, 25, 23, 37, '', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'High', 'Normal', 'High', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT FOREFOOT,CAVUS FEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250901054423_CI-026.pdf', '', 1, 0, 25, 25, '2025-09-01 11:53:34', '2025-09-01 12:14:37'),
(27, 27, 13, 25, 24, 37, '1', 1, 'Flatfoot', 'Moderate', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LT FLATFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250901061424_CI-027.pdf', '', 1, 0, 25, 25, '2025-09-01 12:20:13', '2025-09-01 12:44:37'),
(28, 28, 13, 25, 25, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250902110902_CI-028.pdf', '', 1, 0, 25, 25, '2025-09-02 05:31:40', '2025-09-02 05:39:16'),
(29, 29, 13, 25, 26, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT AND RT FOREFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250902114246_CI-029.pdf', '', 1, 0, 25, 25, '2025-09-02 05:59:20', '2025-09-02 06:13:00'),
(30, 30, 13, 25, 27, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT,FOCAL NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250902120134_CI-030.pdf', '', 1, 0, 25, 25, '2025-09-02 06:22:41', '2025-09-02 06:31:48'),
(31, 31, 13, 25, 28, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>INSOLES</p>', 1, '20250902122408_CI-031.pdf', '', 1, 0, 25, 25, '2025-09-02 06:43:26', '2025-09-02 06:54:24'),
(32, 32, 13, 25, 29, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250902021907_CI-032.pdf', '', 1, 0, 25, 25, '2025-09-02 08:37:22', '2025-09-02 08:49:21'),
(33, 33, 13, 25, 30, 37, '1', 1, 'Cavus', 'Mild', 'Normal', 'Cavus', 'Mild', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT,CAVUS FEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250902031558_CI-033.pdf', '', 1, 0, 25, 25, '2025-09-02 09:41:49', '2025-09-02 09:46:11'),
(34, 34, 13, 25, 31, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>HIGH RISK FOR DIABETIC FOOT,MIXED FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250902065139_CI-034.pdf', '', 1, 0, 25, 25, '2025-09-02 13:06:23', '2025-09-02 13:21:52'),
(35, 35, 13, 25, 32, 37, '1', 1, 'Flatfoot', 'Normal', 'Eversion', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Flat', 'Normal', 'Flat', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT FOREFOOT,FLATFEET,LT EVERTED HEEL,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250903105557_CI-035.pdf', '', 1, 0, 25, 25, '2025-09-03 05:09:33', '2025-09-03 05:26:11'),
(36, 36, 13, 25, 33, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250903112322_CI-036.pdf', '', 1, 0, 25, 25, '2025-09-03 05:44:19', '2025-09-03 05:53:39'),
(37, 37, 13, 25, 34, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,RT FLATFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250903060721_CI-037.pdf', '', 1, 0, 25, 25, '2025-09-03 12:36:29', '2025-09-03 12:37:34'),
(38, 38, 24, 14, 1, 36, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', 'test', 1, 0, 14, 14, '2025-09-05 12:05:23', '2025-09-05 12:05:23'),
(39, 39, 23, 14, 35, 36, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', 'test', 1, 0, 14, 14, '2025-09-05 12:09:31', '2025-09-05 12:09:31'),
(40, 40, 13, 25, 36, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 1, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>INSOLES</p>', 1, '20250906112855_CI-040.pdf', '', 1, 0, 25, 25, '2025-09-06 05:49:20', '2025-09-06 05:59:07'),
(41, 41, 13, 25, 37, 37, '1', 1, 'Cavus', 'Normal', 'Normal', 'Cavus', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,CAVUS FEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP FOOTWEAR</p>', 1, '20250906114900_CI-041.pdf', '', 1, 0, 25, 25, '2025-09-06 06:10:01', '2025-09-06 06:19:14'),
(42, 42, 13, 25, 38, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MIXED FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250906120808_CI-042.pdf', '', 1, 0, 25, 25, '2025-09-06 06:26:02', '2025-09-06 06:38:21'),
(43, 43, 13, 25, 39, 37, '1', 1, 'Flatfoot', 'Mild', 'Eversion', 'Flatfoot', 'Mild', 'Eversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,EVERTED HEELS,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH ARCH SUPPORTS</p>', 1, '20250906122339_CI-043.pdf', '', 1, 0, 25, 25, '2025-09-06 06:50:12', '2025-09-06 06:53:52'),
(44, 44, 13, 25, 40, 37, '1', 1, 'Flatfoot', 'Moderate', 'Eversion', 'Flatfoot', 'Moderate', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>FLATFEET,LT EVERTED HEEL,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH ARCH SUPPORTS</p>', 1, '20250906010647_CI-044.pdf', '', 1, 0, 25, 25, '2025-09-06 07:34:44', '2025-09-06 07:37:00'),
(45, 45, 13, 25, 41, 37, '1', 1, 'Flatfoot', 'Moderate', 'Normal', 'Flatfoot', 'Moderate', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT RT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250906011800_CI-045.pdf', '', 1, 0, 25, 25, '2025-09-06 07:46:47', '2025-09-06 07:48:14'),
(46, 46, 13, 25, 42, 37, '1', 1, 'Cavus', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LT CAVUS FOOT RT FLAT FOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUTSOMISED MCP FOOTWEAR</p>', 1, '20250906015343_CI-046.pdf', '', 1, 0, 25, 25, '2025-09-06 08:22:42', '2025-09-06 08:23:55'),
(47, 47, 13, 25, 42, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-09-06 08:22:42', '2025-09-06 08:22:42'),
(48, 48, 13, 25, 43, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>PARALYSIS ON RT SIDE, LARGE FIBER NEUROPATHY, MAX PREASSURE ON LT SIDE</p>', '<p>CUSTOMISED FOOTWEAR</p>', 1, '20250906030612_CI-048.pdf', '', 1, 0, 25, 25, '2025-09-06 09:19:52', '2025-09-06 09:36:25'),
(49, 49, 13, 25, 44, 37, '1,4', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>BURNING SENSATION , MIXED FIBER NEUROPATHY, EVERTED HEELS</p>', '<p>FOOTWEAR &amp; SILLICON SOCKS</p>', 1, '20250906044501_CI-049.pdf', '', 1, 0, 25, 25, '2025-09-06 10:55:10', '2025-09-06 11:15:14'),
(50, 50, 13, 25, 45, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON FORE FOOT</p>', '<p>INSOLES</p>', 1, '20250906050806_CI-050.pdf', '', 1, 0, 25, 25, '2025-09-06 11:26:19', '2025-09-06 11:38:21'),
(51, 51, 13, 25, 46, 37, '1', 1, 'Flatfoot', 'Mild', 'Eversion', 'Flatfoot', 'Mild', 'Eversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HEEL,EVERTED HEELS, FLAT FEET</p>', '<p>CUSTOMISED FOOTWEAR</p>', 1, '20250906054833_CI-051.pdf', '', 1, 0, 25, 25, '2025-09-06 12:04:04', '2025-09-06 12:18:45'),
(52, 52, 13, 25, 47, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,MODERATE RISK FOR DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250908111019_CI-052.pdf', '', 1, 0, 25, 25, '2025-09-08 05:20:31', '2025-09-08 05:40:33'),
(53, 53, 13, 25, 48, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250908114635_CI-053.pdf', '', 1, 0, 25, 25, '2025-09-08 06:04:18', '2025-09-08 06:16:49'),
(54, 54, 13, 25, 49, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250908124412_CI-054.pdf', '', 1, 0, 25, 25, '2025-09-08 06:53:47', '2025-09-08 07:14:27'),
(55, 55, 13, 25, 50, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250908010923_CI-055.pdf', '', 1, 0, 25, 25, '2025-09-08 07:38:37', '2025-09-08 07:39:39'),
(56, 56, 13, 25, 51, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,FOCAL NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250908012648_CI-056.pdf', '', 1, 0, 25, 25, '2025-09-08 07:45:03', '2025-09-08 07:57:00'),
(57, 57, 13, 25, 52, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDF</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250908030606_CI-057.pdf', '', 1, 0, 25, 25, '2025-09-08 09:32:32', '2025-09-08 09:36:20'),
(58, 58, 13, 25, 53, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250908060058_CI-058.pdf', '', 1, 0, 25, 25, '2025-09-08 12:30:22', '2025-09-08 12:31:11'),
(59, 59, 13, 25, 54, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,MILD FLATFEET,LOW RISK DAIBETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250908071441_CI-059.pdf', '', 1, 0, 25, 25, '2025-09-08 13:37:29', '2025-09-08 13:44:53'),
(60, 60, 13, 25, 55, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250909105201_CI-060.pdf', '', 1, 0, 25, 25, '2025-09-09 05:20:53', '2025-09-09 05:22:14'),
(61, 61, 13, 25, 56, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250909111827_CI-061.pdf', '', 1, 0, 25, 25, '2025-09-09 05:39:37', '2025-09-09 05:48:41'),
(62, 62, 13, 25, 57, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250909114225_CI-062.pdf', '', 1, 0, 25, 25, '2025-09-09 06:10:53', '2025-09-09 06:12:39'),
(63, 63, 13, 25, 58, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250909043438_CI-063.pdf', '', 1, 0, 25, 25, '2025-09-09 11:04:04', '2025-09-09 11:04:53'),
(64, 64, 13, 25, 59, 37, '1', 1, 'Flatfoot', 'Mild', 'Eversion', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLAT FEET,LT EVERTED HEEL,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH ARCH SUPPORTS</p>', 1, '20250910012735_CI-064.pdf', '', 1, 0, 25, 25, '2025-09-10 07:26:54', '2025-09-10 07:57:49'),
(65, 65, 13, 25, 60, 37, '1,5', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOSK RISL DIABETIC FOOT EXCEPT ON LT GREAT TOE,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMIZED MCP&nbsp; SANDALS</p>', 1, '20250910032312_CI-065.pdf', '', 1, 0, 25, 25, '2025-09-10 09:49:33', '2025-09-10 09:53:25'),
(66, 66, 13, 25, 61, 37, '1', 1, 'Cavus', 'Moderate', 'Normal', 'Cavus', 'Moderate', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,CAVUS FEET,LOW RISK DIABETIC FOOT EXCEPT RT GREAT TOE,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250911122038_CI-066.pdf', '', 1, 0, 25, 25, '2025-09-11 06:21:55', '2025-09-11 06:50:53'),
(67, 67, 13, 25, 62, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT,RT FLATFOOT,HIGH RISK FOR DIABETIC FOOT,MIXED FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250911010733_CI-067.pdf', '', 1, 0, 25, 25, '2025-09-11 07:35:05', '2025-09-11 07:37:47'),
(68, 68, 13, 25, 63, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT FOREFOOT,MILD FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250911012801_CI-068.pdf', '', 1, 0, 25, 25, '2025-09-11 07:56:44', '2025-09-11 07:58:14'),
(69, 69, 13, 25, 64, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250911021415_CI-069.pdf', '', 1, 0, 25, 25, '2025-09-11 08:43:04', '2025-09-11 08:44:29'),
(70, 70, 13, 25, 65, 37, '', 1, 'Flatfoot', 'Severe', 'Eversion', 'Flatfoot', 'Severe', 'Eversion', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLATFEET,EVERTED HEEL,FOCAL NEUROPATHY,LOW RISK DIABETIC FOOT</p>', '<p>MCP FOOTWEAR ALONG WITH ARCH SUPPORTS</p>', 1, '20250911061854_CI-070.pdf', '', 1, 0, 25, 25, '2025-09-11 12:39:43', '2025-09-11 12:49:06'),
(71, 71, 13, 25, 66, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,LARGE FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250912115243_CI-071.pdf', '', 1, 0, 25, 25, '2025-09-12 06:13:11', '2025-09-12 06:22:58'),
(72, 72, 13, 25, 67, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON FOREFEET,FLATFEET,LARGE FIBER NEUROPATHY,MODERATE RISK FOR DIBETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250912121626_CI-072.pdf', '', 1, 0, 25, 25, '2025-09-12 06:34:16', '2025-09-12 06:46:40'),
(73, 73, 13, 25, 68, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250912122949_CI-073.pdf', '', 1, 0, 25, 25, '2025-09-12 06:54:23', '2025-09-12 07:00:03'),
(74, 74, 13, 25, 69, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT,FOCAL NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250912124448_CI-074.pdf', '', 1, 0, 25, 25, '2025-09-12 07:09:27', '2025-09-12 07:15:02'),
(75, 75, 13, 25, 70, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250912012915_CI-075.pdf', '', 1, 0, 25, 25, '2025-09-12 07:51:22', '2025-09-12 07:59:29'),
(76, 76, 13, 25, 71, 37, '1', 1, 'Flatfoot', 'Severe', 'Normal', 'Flatfoot', 'Severe', 'Eversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,RT EVERTED HEEL,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH ARCH SUPPORTS</p>', 1, '20250912014019_CI-076.pdf', '', 1, 0, 25, 25, '2025-09-12 08:05:59', '2025-09-12 08:10:33'),
(77, 77, 13, 25, 72, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,MILD FLATFEET,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250912015055_CI-077.pdf', '', 1, 0, 25, 25, '2025-09-12 08:17:11', '2025-09-12 08:21:09'),
(78, 78, 13, 25, 73, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,FOCAL NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250912041937_CI-078.pdf', '', 1, 0, 25, 25, '2025-09-12 10:36:06', '2025-09-12 10:49:52'),
(79, 79, 13, 25, 74, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET, FLATFEET,LOW RISK FOR DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250913105156_CI-079.pdf', '', 1, 0, 25, 25, '2025-09-13 05:10:03', '2025-09-13 05:22:10'),
(80, 80, 13, 25, 75, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,HIGH RISK FOR DIABETIC FOOT,MIXED FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250913121836_CI-080.pdf', '', 1, 0, 25, 25, '2025-09-13 06:34:21', '2025-09-13 06:48:49'),
(81, 81, 13, 25, 76, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP SLIPPERS</p>', 1, '20250913124253_CI-081.pdf', '', 1, 0, 25, 25, '2025-09-13 07:10:22', '2025-09-13 07:13:07'),
(82, 82, 13, 25, 77, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250913012119_CI-082.pdf', '', 1, 0, 25, 25, '2025-09-13 07:38:45', '2025-09-13 07:51:32'),
(83, 83, 13, 25, 78, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY,MILD ARTEOSCLEROTIC CHANGE IN LT ARTERIES SIDE</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250913032601_CI-083.pdf', '', 1, 0, 25, 25, '2025-09-13 09:52:07', '2025-09-13 09:56:15'),
(84, 84, 25, 25, 75, 34, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 13, 13, '2025-09-13 09:57:27', '2025-09-23 03:24:56'),
(85, 85, 25, 25, 75, 34, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 13, 13, '2025-09-13 09:57:28', '2025-09-23 03:24:58'),
(86, 86, 13, 25, 79, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 1, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,RT FLATFOOT,LOW RISK DIABETIC FOOT,FOCAL NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250913041816_CI-086.pdf', '', 1, 0, 25, 25, '2025-09-13 10:28:47', '2025-09-13 10:48:29'),
(87, 87, 13, 25, 80, 37, '', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '', '', 1, '20250913051928_CI-087.pdf', '', 1, 0, 25, 25, '2025-09-13 11:35:37', '2025-09-13 11:49:42'),
(88, 88, 13, 25, 80, 37, '1', 1, 'Flatfoot', 'Severe', 'Eversion', 'Flatfoot', 'Moderate', 'Eversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,FLATFEET,EVERTED HEELS, LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH RIGID ARCH SUPPORT</p>', 1, '20250913052441_CI-088.pdf', '', 1, 0, 25, 25, '2025-09-13 11:50:53', '2025-09-13 11:54:54'),
(89, 89, 13, 25, 81, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESURRE ON BOTH FEET,LOW RISK DIABETIC FOOT,</p>', '<p>INSOLE</p>', 1, '20250915122741_CI-089.pdf', '', 1, 0, 25, 25, '2025-09-15 06:50:28', '2025-09-15 06:57:55'),
(90, 90, 13, 25, 82, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Midfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT MIDFOOT,FLATFEET,LT EVERTED HEEL,MIXED FIBER NEUROPATHY,MILD ARTEROSCLEROTIC CHANGE IN BOTH ARTERIES SIDES,HAVING VARICOSE VEINS</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250915013242_CI-090.pdf', '', 1, 0, 25, 25, '2025-09-15 07:54:10', '2025-09-15 08:02:54'),
(91, 91, 13, 25, 83, 37, '1,6', 1, 'Normal', 'Mild', 'Inversion', 'Normal', 'Mild', 'Inversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH FOOT,</p>', '<p>INSOLE</p>', 1, '20250915033915_CI-091.pdf', '', 1, 0, 25, 25, '2025-09-15 09:54:46', '2025-09-15 10:09:31'),
(92, 92, 13, 25, 84, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250915060926_CI-092.pdf', '', 1, 0, 25, 25, '2025-09-15 12:38:01', '2025-09-15 12:39:38'),
(93, 93, 13, 25, 85, 37, '', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250916110027_CI-093.pdf', '', 1, 0, 25, 25, '2025-09-16 05:23:04', '2025-09-16 05:30:43'),
(94, 94, 13, 25, 86, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Eversion', NULL, 1, 'Flat', 'Normal', 'Flat', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>FLATFEET,RT EVERTED HEEL,MILD RISK FOR DIABETIC FOOT,MIXED FIBER NEUROPATHY,MILD ARTEROSCLEROTIC CHANGE IN BOTH ARTERIES SIDE.</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250916120830_CI-094.pdf', '', 1, 0, 25, 25, '2025-09-16 06:23:33', '2025-09-16 06:38:43'),
(95, 95, 13, 25, 87, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,MILD RISK FOR DIABETIC FOOT,MIXED FIBER NEUROPATHY,MODERATE ARTEROSCLEROTIC CHANGE IN RT ARTERIES SIDE&nbsp;</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250916125121_CI-095.pdf', '', 1, 0, 25, 25, '2025-09-16 06:51:41', '2025-09-16 07:21:35'),
(96, 96, 13, 25, 88, 37, '1', 1, 'Cavus', 'Normal', 'Normal', 'Cavus', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,CAVUS FEET,HIGH RISK FOR DIABETIC FOOT,MIXED FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250916042627_CI-096.pdf', '', 1, 0, 25, 25, '2025-09-16 10:53:44', '2025-09-16 10:56:40'),
(97, 97, 13, 25, 90, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,EVERTED HEELS,LOW RISK DIABETIC FOOT</p>', '<p>MCP FOOTWEAR WITH CUSTOMISATION</p>', 1, '20250917120231_CI-097.pdf', '', 1, 0, 25, 25, '2025-09-17 05:25:03', '2025-09-17 06:32:45'),
(98, 98, 13, 25, 91, 37, '', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 1, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250917113414_CI-098.pdf', '', 1, 0, 25, 25, '2025-09-17 05:44:22', '2025-09-17 06:04:29'),
(99, 99, 13, 25, 92, 37, '', 1, 'Normal', 'Normal', 'Normal', 'Cavus', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,RT CAVUS FOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250917114945_CI-099.pdf', '', 1, 0, 25, 25, '2025-09-17 06:10:11', '2025-09-17 06:19:59'),
(100, 100, 13, 25, 93, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIER NEUROPATHY</p>', '<p>CUSTOMISED MCP SLIPPERS</p>', 1, '20250917121820_CI-100.pdf', '', 1, 0, 25, 25, '2025-09-17 06:37:19', '2025-09-17 06:48:35'),
(101, 101, 13, 25, 94, 37, '1', 1, 'Flatfoot', 'Severe', 'Normal', 'Flatfoot', 'Severe', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLATFEET,LT EVERTED HEEL,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH RIGID ARCH SUPPORTS</p>', 1, '20250917125035_CI-101.pdf', '', 1, 0, 25, 25, '2025-09-17 07:08:57', '2025-09-17 07:20:51'),
(102, 102, 13, 25, 95, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250917021041_CI-102.pdf', '', 1, 0, 25, 25, '2025-09-17 08:21:22', '2025-09-17 08:40:54'),
(103, 103, 14, 25, 96, 37, '1', 1, 'Cavus', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT FOREFOOT,LT CAVUS FOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOT ALONG WITH HALLUX VALGUS SPLINT</p>', 1, '20250917060346_CI-103.pdf', '', 1, 0, 25, 25, '2025-09-17 12:18:46', '2025-09-17 12:33:59'),
(104, 104, 13, 25, 97, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,MILD FLATFEET,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250918111246_CI-104.pdf', '', 1, 0, 25, 25, '2025-09-18 05:35:03', '2025-09-18 05:42:59'),
(105, 105, 13, 25, 98, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,SMALL FIBER NEUROPATHY,HIGH RISK FOR DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250918041127_CI-105.pdf', '', 1, 0, 25, 25, '2025-09-18 10:24:58', '2025-09-18 10:41:40'),
(106, 106, 13, 25, 99, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,MILD FLATFEET,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250919110923_CI-106.pdf', '', 1, 0, 25, 25, '2025-09-19 05:20:45', '2025-09-19 05:39:37'),
(107, 107, 13, 25, 100, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH RIGID ARCH SUPPORTS</p>', 1, '20250919121323_CI-107.pdf', '', 1, 0, 25, 25, '2025-09-19 06:30:19', '2025-09-19 06:43:37'),
(108, 108, 13, 25, 101, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT FOREFOOT,CAVUS FEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250919123305_CI-108.pdf', '', 1, 0, 25, 25, '2025-09-19 06:46:09', '2025-09-19 07:03:22'),
(109, 109, 13, 25, 102, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBERV</p>', '', 1, '20250919124702_CI-109.pdf', '', 1, 0, 25, 25, '2025-09-19 07:06:33', '2025-09-19 07:17:17'),
(110, 110, 13, 25, 103, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,MILD FLATFEET,SMALL FIBER NEUROPATHY,HIGH RISK FOR DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250919065454_CI-110.pdf', '', 1, 0, 25, 25, '2025-09-19 13:17:46', '2025-09-19 13:25:09'),
(111, 111, 13, 25, 104, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250920110218_CI-111.pdf', '', 1, 0, 25, 25, '2025-09-20 05:20:26', '2025-09-20 05:32:32'),
(112, 112, 13, 25, 105, 37, '1', 1, 'Normal', 'Normal', 'Eversion', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH FOREFEET,LT EVERTED HEEL,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250920112407_CI-112.pdf', '', 1, 0, 25, 25, '2025-09-20 05:37:50', '2025-09-20 05:54:22'),
(113, 113, 13, 25, 106, 37, '1', 1, 'Flatfoot', 'Moderate', 'Normal', 'Flatfoot', 'Moderate', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250920124542_CI-113.pdf', '', 1, 0, 25, 25, '2025-09-20 06:49:05', '2025-09-20 07:15:55'),
(114, 114, 13, 25, 107, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250920010439_CI-114.pdf', '', 1, 0, 25, 25, '2025-09-20 07:33:49', '2025-09-20 07:34:52'),
(115, 115, 13, 25, 108, 37, '1,6', 1, 'Normal', 'Mild', 'Eversion', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH FEET,LOW RISK DIABETIC FOOT,LT FLATFOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250920015754_CI-115.pdf', '', 1, 0, 25, 25, '2025-09-20 08:19:28', '2025-09-20 08:28:13'),
(116, 116, 13, 25, 109, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LT FLATFOOT,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250920024647_CI-116.pdf', '', 1, 0, 25, 25, '2025-09-20 09:08:03', '2025-09-20 09:17:01'),
(117, 117, 13, 25, 110, 37, '', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250922112519_CI-117.pdf', '', 1, 0, 25, 25, '2025-09-22 05:42:50', '2025-09-22 05:55:34'),
(118, 118, 13, 25, 111, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250922114923_CI-118.pdf', '', 1, 0, 25, 25, '2025-09-22 06:07:54', '2025-09-22 06:19:44'),
(119, 119, 13, 25, 112, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FOCAL NEUROPATHY,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250922022549_CI-119.pdf', '', 1, 0, 25, 25, '2025-09-22 08:46:05', '2025-09-22 08:56:02'),
(120, 120, 13, 25, 113, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT FOREFOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250923115436_CI-120.pdf', '', 1, 0, 25, 25, '2025-09-23 06:02:00', '2025-09-23 06:24:50'),
(121, 121, 13, 25, 114, 37, '1', 1, 'Normal', 'Mild', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH FOREFEET</p>', '<p>CUSTOMISED MCP FOOT WEAR</p>', 1, '20250923122546_CI-121.pdf', '', 1, 0, 25, 25, '2025-09-23 06:51:50', '2025-09-23 06:56:01'),
(122, 122, 13, 25, 115, 37, '1', 1, 'Normal', 'Mild', 'Normal', 'Normal', 'Normal', 'Inversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH FEET,LT EVERSION ,RT INVERSION,HIGH RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP SHOE</p>', 1, '20250923011023_CI-122.pdf', '', 1, 0, 25, 25, '2025-09-23 07:37:00', '2025-09-23 07:40:37'),
(123, 123, 0, 0, 116, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-09-23 07:47:49', '2025-10-06 19:09:08'),
(124, 124, 0, 0, 116, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-09-23 07:47:52', '2025-10-06 19:09:10'),
(125, 125, 0, 0, 116, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-09-23 07:47:55', '2025-10-06 19:09:11'),
(126, 126, 13, 25, 116, 37, '1', 1, 'Normal', 'Mild', 'Inversion', 'Normal', 'Moderate', 'Inversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH FOREFEET,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR,INSOLE</p>', 1, '20250923013818_CI-126.pdf', '', 1, 0, 25, 25, '2025-09-23 08:05:18', '2025-09-23 08:08:32'),
(127, 127, 13, 25, 117, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT FOREFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250924120946_CI-127.pdf', '', 1, 0, 25, 25, '2025-09-24 06:31:28', '2025-09-24 06:39:59'),
(128, 128, 13, 25, 118, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250924014606_CI-128.pdf', '', 1, 0, 25, 25, '2025-09-24 08:06:51', '2025-09-24 08:16:20'),
(129, 129, 13, 25, 119, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT SIDE,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROAPTHY</p>', '<p>MCP FOOTWEAR</p>', 1, '20250924022554_CI-129.pdf', '', 1, 0, 25, 25, '2025-09-24 08:44:44', '2025-09-24 08:56:07'),
(130, 130, 13, 25, 120, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK FOR DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250924030337_CI-130.pdf', '', 1, 0, 25, 25, '2025-09-24 09:22:27', '2025-09-24 09:33:50'),
(131, 131, 13, 25, 121, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIAETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250924033051_CI-131.pdf', '', 1, 0, 25, 25, '2025-09-24 09:50:16', '2025-09-24 10:01:04'),
(132, 132, 13, 25, 122, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 1, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250925111501_CI-132.pdf', '', 1, 0, 25, 25, '2025-09-25 05:44:23', '2025-09-25 05:45:15'),
(133, 133, 13, 25, 123, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>LOW RISK DIABETIC FOOT,CAVUS FEET,LT EVERTED HEEL</p>', '<p>MCP SLIPPERS</p>', 1, '20250925113442_CI-133.pdf', '', 1, 0, 25, 25, '2025-09-25 05:56:21', '2025-09-25 06:04:55'),
(134, 134, 13, 25, 124, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,EVERTED HEELS,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20250925122752_CI-134.pdf', '', 1, 0, 25, 25, '2025-09-25 06:36:09', '2025-09-25 06:58:04'),
(135, 135, 13, 25, 125, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-09-25 07:00:57', '2025-09-25 07:00:57'),
(136, 136, 13, 25, 125, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-09-25 07:01:29', '2025-09-25 07:01:29'),
(137, 137, 13, 25, 126, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK FOR DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20250926110016_CI-137.pdf', '', 1, 0, 25, 25, '2025-09-26 05:22:05', '2025-09-26 05:30:31');
INSERT INTO `consultations` (`id`, `consultationid`, `recomended_by_user_id`, `user_id`, `patient_id`, `site_id`, `prior_issues`, `scan_3d_parameter`, `scan_3d_left_foot_type`, `scan_3d_left_arch_type`, `scan_3d_left_heel_angle`, `scan_3d_right_foot_type`, `scan_3d_right_arch_type`, `scan_3d_right_heel_angle`, `scan_3d_file`, `scan_planter_pressure_parameters`, `scan_planter_pressure_left_morpho_type`, `scan_planter_pressure_left_max_pressure`, `scan_planter_pressure_right_morpho_type`, `scan_planter_pressure_right_max_pressure`, `scan_planter_pressure_file`, `ankle_brachial_index`, `ankle_brachial_left_dorsalis_pedis`, `ankle_brachial_left_arm_ap`, `ankle_brachial_right_dorsalis_pedis`, `ankle_brachial_right_arm_ap`, `summary_report`, `prescriptions`, `is_report_finalized`, `report_file`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(138, 138, 13, 25, 127, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Flatfoot', 'Mild', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,MILD FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP FOOTWEAR ALONG WITH ARCH SUPPORTS</p>', 1, '20250926015705_CI-138.pdf', '', 1, 0, 25, 25, '2025-09-26 08:18:45', '2025-09-26 08:27:20'),
(139, 139, 13, 25, 128, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MILD FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP SLIPPERS</p>', 1, '20250926034631_CI-139.pdf', '', 1, 0, 25, 25, '2025-09-26 10:05:23', '2025-09-26 10:16:45'),
(140, 140, 13, 25, 129, 37, '1', 1, 'Flatfoot', 'Moderate', 'Normal', 'Flatfoot', 'Moderate', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT,FLATFEET,SMALL FIBER NEUROPATHY,HIGH RISK FOR DIABETIC FOOT,LT SIDE BUNION PRESENT</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH BUNION SPLINT</p>', 1, '20250926041309_CI-140.pdf', '', 1, 0, 25, 25, '2025-09-26 10:32:28', '2025-09-26 10:43:24'),
(141, 141, 13, 25, 130, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON FOREFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20250926043211_CI-141.pdf', '', 1, 0, 25, 25, '2025-09-26 10:58:10', '2025-09-26 11:02:24'),
(142, 142, 13, 25, 131, 37, '1', 1, 'Cavus', 'Normal', 'Normal', 'Cavus', 'Normal', 'Normal', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT AND RT HINDFOOT,CAVUS FEET,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250926045709_CI-142.pdf', '', 1, 0, 25, 25, '2025-09-26 11:16:58', '2025-09-26 11:27:23'),
(143, 143, 13, 25, 132, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP SLIPPERS&nbsp;</p>', 1, '20250926064738_CI-143.pdf', '', 1, 0, 25, 25, '2025-09-26 13:06:30', '2025-09-26 13:17:51'),
(144, 144, 13, 0, 133, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-09-27 06:25:22', '2025-10-06 19:08:55'),
(145, 145, 13, 25, 133, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>SMALL FIBER NEUROPATHY,LOW RISK FOR DIABETIC FOOT,MAX PRESSURE ON LT HINDFOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250927120501_CI-145.pdf', '', 1, 0, 25, 25, '2025-09-27 06:25:28', '2025-09-27 06:35:16'),
(146, 146, 13, 25, 134, 37, '1,4', 1, 'Cavus', 'Mild', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>SMALL FIBER NEUROPATHY,LOW RISK FOR DIABETIC FOOT,MAX PRESSURE ON LT HINDFOOT,LT CAVUS FOOT,LT EVERTED HEEL</p>', '<p>INSOLES</p>', 1, '20250927043537_CI-146.pdf', '', 1, 0, 25, 25, '2025-09-27 10:48:33', '2025-09-27 11:05:50'),
(147, 147, 13, 25, 135, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Midfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MIXED FIBER NEUROPATHY,MAX PRESSURE ON LT MIDFOOT,LT FLATFOOT,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250927055940_CI-147.pdf', '', 1, 0, 25, 25, '2025-09-27 12:26:38', '2025-09-27 12:29:53'),
(148, 148, 13, 25, 136, 37, '1', 1, 'Normal', 'Normal', 'Eversion', 'Normal', 'Mild', 'Eversion', NULL, 1, 'Normal', 'Forefoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT FOREFOOT,LT 1 EVE,RT 1 EVE,MILD RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250929123750_CI-148.pdf', '', 1, 0, 25, 25, '2025-09-29 07:01:45', '2025-09-29 07:08:04'),
(149, 149, 13, 25, 137, 37, '1', 1, 'Normal', 'Normal', 'Inversion', 'Normal', 'Mild', 'Inversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH FOREFOOT,LT RT INV</p>', '<p>INSOLES</p>', 1, '20250929010856_CI-149.pdf', '', 1, 0, 25, 25, '2025-09-29 07:19:35', '2025-09-29 07:39:10'),
(150, 150, 13, 25, 138, 37, '1,5', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH FOREFOOT,MODERATE RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250929022121_CI-150.pdf', '', 1, 0, 25, 25, '2025-09-29 08:21:28', '2025-09-29 08:51:36'),
(151, 151, 13, 25, 139, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON BOTH HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20250929030057_CI-151.pdf', '', 1, 0, 25, 25, '2025-09-29 09:14:16', '2025-09-29 09:31:10'),
(152, 152, 25, 25, 140, 37, '1,3', 1, 'Flatfoot', 'Mild', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Flat', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>SMALL FIBER NEUROPATHY,LOW RISK DIABETIC, MAX PRESSURE ON HEEL</p>', '<p>INSOLES</p>', 1, '20250930113828_CI-152.pdf', '', 1, 0, 25, 25, '2025-09-30 05:49:37', '2025-09-30 06:08:41'),
(153, 153, 25, 25, 141, 37, '1', 1, 'Cavus', 'Severe', 'Normal', 'Cavus', 'Severe', 'Eversion', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 0, 0, 0, 0, '<p>BURNING SENSATION, LEFT FINGER DISCOULARITON, MIXED FIBER NEUROPATHY,&nbsp; HIGH RISK DIABETIC,</p>\r\n<p>EVERTED HEELS, CAVUS FEET, MAX PRESSURE ON LT HEEL</p>', '<p>CUSTOMISDED DIABETIC FOOTWEAR</p>', 1, '20250930120354_CI-153.pdf', '', 1, 0, 25, 25, '2025-09-30 06:12:41', '2025-09-30 06:34:07'),
(154, 154, 25, 25, 142, 37, '', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>FOCAL NEUROPATHY, MAX PRESSURE ON HEELS</p>', '<p>INSOLES</p>', 1, '20250930011239_CI-154.pdf', '', 1, 0, 25, 25, '2025-09-30 07:24:35', '2025-09-30 07:42:54'),
(155, 155, 25, 25, 143, 37, '', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>RIGHT FIFTH TOE AMPUTATION, MIXED FIBER NEUROPATHY, LOW RISK, MAX PRESSURE ON RT HEEL&nbsp;</p>', '<p>CUSTOMISED DIABETIC FOOTWEAR</p>', 1, '20250930014302_CI-155.pdf', '', 1, 0, 25, 25, '2025-09-30 07:57:18', '2025-09-30 08:13:16'),
(156, 156, 13, 25, 144, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20251001105533_CI-156.pdf', '', 1, 0, 25, 25, '2025-10-01 05:15:50', '2025-10-01 05:25:47'),
(157, 157, 13, 25, 145, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20251001111431_CI-157.pdf', '', 1, 0, 25, 25, '2025-10-01 05:44:05', '2025-10-01 05:44:44'),
(158, 158, 13, 25, 146, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MIXED FIBER NEUROPATHY,HIGH RISK FOR DIABETIC FOOT,MAX PRESSURE ON RT FOREFOOT,LT FLATFOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20251001122931_CI-158.pdf', '', 1, 0, 25, 25, '2025-10-01 06:43:43', '2025-10-01 06:59:46'),
(159, 159, 13, 25, 147, 37, '1', 1, 'Cavus', 'Normal', 'Normal', 'Cavus', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,RT CAVUS FOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20251001125457_CI-159.pdf', '', 1, 0, 25, 25, '2025-10-01 07:13:28', '2025-10-01 07:25:12'),
(160, 160, 13, 25, 148, 37, '1', 1, 'Flatfoot', 'Moderate', 'Normal', 'Flatfoot', 'Moderate', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT</p>', '<p>CUSTOMISED MCP FOOTWEAR ALONG WITH ARCH SUPPORTS</p>', 1, '20251001035237_CI-160.pdf', '', 1, 0, 25, 25, '2025-10-01 10:09:31', '2025-10-01 10:22:50'),
(161, 161, 13, 25, 149, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON HINDFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEURPOPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20251001042311_CI-161.pdf', '', 1, 0, 25, 25, '2025-10-01 10:41:41', '2025-10-01 10:53:25'),
(162, 162, 13, 25, 150, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Forefoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT FOREFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP FOOTWEAR</p>', 1, '20251001055536_CI-162.pdf', '', 1, 0, 25, 25, '2025-10-01 12:22:43', '2025-10-01 12:25:51'),
(163, 163, 13, 25, 151, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20251003120005_CI-163.pdf', '', 1, 0, 25, 25, '2025-10-03 06:11:29', '2025-10-03 06:30:21'),
(164, 164, 13, 25, 152, 37, '1,4', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20251003122400_CI-164.pdf', '', 1, 0, 25, 25, '2025-10-03 06:42:35', '2025-10-03 06:54:12'),
(165, 165, 13, 25, 153, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT,FOCAL NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20251003033603_CI-165.pdf', '', 1, 0, 25, 25, '2025-10-03 10:05:09', '2025-10-03 10:06:18'),
(166, 166, 13, 25, 154, 37, '1', 1, 'Flatfoot', 'Severe', 'Normal', 'Flatfoot', 'Severe', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT</p>', '<p>INSOLES</p>', 1, '20251004113555_CI-166.pdf', '', 1, 0, 25, 25, '2025-10-04 06:05:17', '2025-10-04 06:06:09'),
(167, 167, 13, 25, 155, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20251004120039_CI-167.pdf', '', 1, 0, 25, 25, '2025-10-04 06:29:42', '2025-10-04 06:30:54'),
(168, 168, 13, 25, 156, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIDE-ONS</p>', 1, '20251004010838_CI-168.pdf', '', 1, 0, 25, 25, '2025-10-04 07:27:00', '2025-10-04 07:38:53'),
(169, 169, 13, 25, 157, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Eversion', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,RT EVERTED HEEL,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20251004012713_CI-169.pdf', '', 1, 0, 25, 25, '2025-10-04 07:56:11', '2025-10-04 07:57:28'),
(170, 170, 13, 25, 158, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOW RISK FOR DIABETIC FOOT</p>', '<p>MCP FOOTWEAR ALONG WITH ARCH SUPPORTS</p>', 1, '20251004014624_CI-170.pdf', '', 1, 0, 25, 25, '2025-10-04 08:15:43', '2025-10-04 08:16:38'),
(171, 171, 13, 25, 159, 37, '1', 1, 'Cavus', 'Moderate', 'Normal', 'Cavus', 'Moderate', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>CAVUS FEET,MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20251004015825_CI-171.pdf', '', 1, 0, 25, 25, '2025-10-04 08:20:46', '2025-10-04 08:28:38'),
(172, 172, 13, 25, 160, 37, '1', 1, 'Flatfoot', 'Moderate', 'Normal', 'Flatfoot', 'Moderate', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,LT EVERTED HEEL,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS ALONG WITH ARCH SUPPORTS</p>', 1, '20251004021656_CI-172.pdf', '', 1, 0, 25, 25, '2025-10-04 08:37:34', '2025-10-04 08:47:10'),
(173, 173, 13, 25, 161, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20251004033918_CI-173.pdf', '', 1, 0, 25, 25, '2025-10-04 09:57:25', '2025-10-04 10:09:33'),
(174, 174, 13, 25, 162, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LOW RISK DIABETIC FOOT,RT CAVUS FOOT</p>', '<p>MCP SLIPPERS</p>', 1, '20251004035242_CI-174.pdf', '', 1, 0, 25, 25, '2025-10-04 10:11:20', '2025-10-04 10:22:56'),
(175, 175, 13, 25, 163, 37, '1', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 1, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,LOW RISK DIABETIC FOOT,MILD FLATFEET</p>', '<p>INSOLES</p>', 1, '20251004043606_CI-175.pdf', '', 1, 0, 25, 25, '2025-10-04 10:57:33', '2025-10-04 11:06:20'),
(176, 176, 13, 25, 164, 37, '1', 1, 'Flatfoot', 'Mild', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Hindfoot', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON RT HINDFOOT,LT MILD FLATFOOT,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>MCP SLIPPERS</p>', 1, '20251004045900_CI-176.pdf', '', 1, 0, 25, 25, '2025-10-04 11:18:44', '2025-10-04 11:29:13'),
(177, 177, 13, 25, 165, 37, '1', 1, 'Flatfoot', 'Normal', 'Normal', 'Flatfoot', 'Normal', 'Normal', NULL, 1, 'Normal', 'Hindfoot', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>MAX PRESSURE ON LT HINDFOOT,FLATFEET,LOW RISK DIABETIC FOOT,SMALL FIBER NEUROPATHY</p>', '<p>CUSTOMISED MCP FOOTWEAR</p>', 1, '20251004064110_CI-177.pdf', '', 1, 0, 25, 25, '2025-10-04 13:10:17', '2025-10-04 13:11:25'),
(178, 178, 0, 0, 166, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', '', 1, 0, 25, 25, '2025-10-06 06:48:06', '2025-10-06 19:08:37'),
(179, 179, 13, 25, 166, 37, '1', 1, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 1, 0, 0, 0, 0, '<p>LOW RISK DIABETIC FOOT</p>', '', 1, '20251006121923_CI-179.pdf', '', 1, 0, 25, 25, '2025-10-06 06:48:14', '2025-10-06 06:49:40'),
(180, 180, 0, 0, 1, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', 'fbnfdg', 1, 0, 1, 1, '2025-10-06 19:00:17', '2025-10-06 19:08:32'),
(181, 181, 0, 0, 1, 37, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, '', '', 0, '', 'fbnfdg', 1, 0, 1, 1, '2025-10-06 19:00:24', '2025-10-06 19:08:34'),
(182, 182, 13, 14, 1, 36, '1,5', 0, 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 'Normal', 'Normal', 'Normal', 'Normal', NULL, 0, 0, 0, 0, 0, '<p>htrtgytrnjty</p>', '<p>njhjmhg</p>', 1, '20251106083540_CI-182.pdf', 'hgnjhgj', 1, 0, 14, 14, '2025-11-06 03:05:02', '2025-11-06 03:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `customer_invoices`
--

CREATE TABLE `customer_invoices` (
  `id` int(11) NOT NULL,
  `customerinvoiceuid` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `gst` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address_state` int(11) NOT NULL,
  `address_city` varchar(50) NOT NULL,
  `address_pin` char(6) NOT NULL,
  `supply_place` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `is_igst` int(2) NOT NULL DEFAULT 0,
  `tax_mode` enum('exclusive','inclusive','none') NOT NULL DEFAULT 'exclusive',
  `discount_type` enum('none','fixed','percent') NOT NULL DEFAULT 'none',
  `discount_value` decimal(12,2) NOT NULL DEFAULT 0.00,
  `discount_before_tax` tinyint(1) NOT NULL DEFAULT 1,
  `shipping_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `rounding_mode` enum('none','nearest','up','down') NOT NULL DEFAULT 'nearest',
  `currency_code` char(3) NOT NULL DEFAULT 'INR',
  `taxable_amount` float NOT NULL DEFAULT 0,
  `tax` float NOT NULL DEFAULT 0,
  `adjustment` float NOT NULL DEFAULT 0,
  `total_amount` float NOT NULL DEFAULT 0,
  `grand_total` float NOT NULL DEFAULT 0,
  `is_invoice_generated` int(2) NOT NULL DEFAULT 0,
  `invoice_file` mediumtext NOT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `payment_terms` varchar(500) DEFAULT NULL,
  `footer_note` varchar(500) DEFAULT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1,
  `is_deleted` int(2) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_invoices`
--

INSERT INTO `customer_invoices` (`id`, `customerinvoiceuid`, `invoice_date`, `due_date`, `customer_name`, `gst`, `address`, `address_state`, `address_city`, `address_pin`, `supply_place`, `site_id`, `is_igst`, `tax_mode`, `discount_type`, `discount_value`, `discount_before_tax`, `shipping_amount`, `rounding_mode`, `currency_code`, `taxable_amount`, `tax`, `adjustment`, `total_amount`, `grand_total`, `is_invoice_generated`, `invoice_file`, `remarks`, `payment_terms`, `footer_note`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-10-08', '2025-10-10', 'DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', '36EKAPK0049B2ZP', '16-11-310/14/6/3/1/2/3 Moosaram Bagh Main Road', 24, 'Hyderabad', '500036', 24, NULL, 0, 'exclusive', 'none', 0.00, 1, 0.00, 'nearest', 'INR', 5100, 918, 0.5, 6175.5, 6176, 1, '20251011132635_CSI-001.pdf', 'abc', NULL, NULL, 1, 0, 1, 1, '2025-10-08 04:20:32', '2025-10-11 07:56:36'),
(3, 2, '2025-09-09', '2025-09-09', 'DR. KVNNS ADVANCED WOUND HEALING CLINIC', '36EKAPK0049B2ZP', '16-11-310/14/6/3/1/2/3 Moosaram Bagh Main Road', 24, 'Hyderabad', '500036', 24, NULL, 0, 'exclusive', 'none', 0.00, 1, 0.00, 'nearest', 'INR', 0, 0, 0.44, 2193.56, 2194, 0, '', 'abc', NULL, NULL, 1, 0, 1, 1, '2025-10-08 04:20:32', '2025-10-11 03:22:42'),
(4, 3, '2025-10-08', '2025-10-11', 'Lyncdigit Technologies', 'dfbfdbfdd65152', 'Khordha', 19, 'Bhubaneswar', '752055', 19, NULL, 1, 'exclusive', 'none', 0.00, 1, 0.00, 'nearest', 'INR', 0, 0, 0.03, 7476.97, 7477, 1, '20251011132656_CSI-003.pdf', 'test', NULL, NULL, 1, 0, 1, 1, '2025-10-10 03:30:08', '2025-10-11 07:56:57'),
(5, 4, '2025-10-01', '2025-10-10', 'Sazad Ahemad', 'dfbfdbfdd65152', 'Khordha', 19, 'Khordha', '752055', 19, NULL, 1, 'exclusive', 'none', 0.00, 1, 0.00, 'nearest', 'INR', 0, 0, 0, 840, 840, 1, '20251011141113_CSI-004.pdf', 'Testing Invoice', NULL, NULL, 1, 0, 1, 1, '2025-10-10 03:34:49', '2025-10-11 08:41:13'),
(6, 5, '2025-10-09', '2025-10-10', 'Test Customer', 'GSTIR657512', 'Khordha', 0, 'Bhubaneswar', '752054', 19, NULL, 1, 'exclusive', 'none', 0.00, 1, 0.00, 'nearest', 'INR', 0, 0, 0, 168, 168, 1, '20251011140918_CSI-005.pdf', 'test', NULL, NULL, 1, 0, 1, 1, '2025-10-10 03:37:12', '2025-10-11 08:39:19'),
(7, 6, '2026-07-19', '2026-07-26', 'Sazad Ahemad', '36EKAPK0049B2ZP', 'Basavanapura Main Road, Bhattarahalli', 11, 'Bangalore', '560049', 11, 37, 1, 'inclusive', 'none', 0.00, 1, 0.00, 'nearest', 'INR', 458.72, 41.28, 0.5, 500, 501, 1, '20260719191508_CSI-006.pdf', 'dfbd', '<p>N/A</p>', '<p>N/A</p>', 1, 0, 13, 13, '2026-07-18 21:20:40', '2026-07-19 13:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `customer_invoice_items`
--

CREATE TABLE `customer_invoice_items` (
  `id` int(11) NOT NULL,
  `customer_invoice_id` int(11) NOT NULL,
  `item_type` enum('product','service','custom') NOT NULL DEFAULT 'product',
  `product_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `item_name` varchar(200) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `service_month` tinyint(2) DEFAULT NULL,
  `service_year` smallint(4) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `rate` float NOT NULL,
  `discount_type` enum('none','fixed','percent') NOT NULL DEFAULT 'none',
  `discount_value` decimal(12,2) NOT NULL DEFAULT 0.00,
  `tax_mode` enum('inherit','exclusive','inclusive','none') NOT NULL DEFAULT 'inherit',
  `cgst` float NOT NULL DEFAULT 0,
  `sgst` float NOT NULL DEFAULT 0,
  `igst` float NOT NULL DEFAULT 0,
  `amount` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_invoice_items`
--

INSERT INTO `customer_invoice_items` (`id`, `customer_invoice_id`, `item_type`, `product_id`, `service_id`, `item_name`, `description`, `site_id`, `service_month`, `service_year`, `quantity`, `rate`, `discount_type`, `discount_value`, `tax_mode`, `cgst`, `sgst`, `igst`, `amount`, `created_at`, `updated_at`) VALUES
(6, 3, 'product', 2, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1769, 'none', 0.00, 'inherit', 12, 12, 0, 2193.56, '2025-10-11 03:22:42', '2025-10-11 03:22:42'),
(118, 1, 'product', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 1500, 'none', 0.00, 'inherit', 9, 9, 0, 1770, '2025-10-11 07:56:35', '2025-10-11 07:56:35'),
(119, 1, 'product', 2, NULL, NULL, NULL, NULL, NULL, NULL, 3, 1200, 'none', 0.00, 'inherit', 9, 9, 0, 4248, '2025-10-11 07:56:35', '2025-10-11 07:56:35'),
(120, 1, 'product', 3, NULL, NULL, NULL, NULL, NULL, NULL, 1, 150, 'none', 0.00, 'inherit', 2.5, 2.5, 0, 157.5, '2025-10-11 07:56:35', '2025-10-11 07:56:35'),
(121, 4, 'product', 1, NULL, NULL, NULL, NULL, NULL, NULL, 5, 150, 'none', 0.00, 'inherit', 0, 0, 10, 825, '2025-10-11 07:56:56', '2025-10-11 07:56:56'),
(122, 4, 'product', 3, NULL, NULL, NULL, NULL, NULL, NULL, 10, 150, 'none', 0.00, 'inherit', 0, 0, 5, 1575, '2025-10-11 07:56:56', '2025-10-11 07:56:56'),
(123, 4, 'product', 2, NULL, NULL, NULL, NULL, NULL, NULL, 2, 1769, 'none', 0.00, 'inherit', 0, 0, 24, 4387.12, '2025-10-11 07:56:56', '2025-10-11 07:56:56'),
(124, 4, 'product', 4, NULL, NULL, NULL, NULL, NULL, NULL, 3, 219, 'none', 0.00, 'inherit', 0, 0, 5, 689.85, '2025-10-11 07:56:56', '2025-10-11 07:56:56'),
(125, 6, 'product', 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 150, 'none', 0.00, 'inherit', 0, 0, 12, 168, '2025-10-11 08:39:18', '2025-10-11 08:39:18'),
(126, 5, 'product', 1, NULL, NULL, NULL, NULL, NULL, NULL, 5, 150, 'none', 0.00, 'inherit', 0, 0, 12, 840, '2025-10-11 08:41:13', '2025-10-11 08:41:13'),
(130, 7, 'service', NULL, 1, 'service', '', 37, 7, 2026, 1, 500, 'none', 0.00, 'inherit', 0, 0, 9, 500, '2026-07-19 13:45:08', '2026-07-19 13:45:08');

-- --------------------------------------------------------

--
-- Table structure for table `group_permissions`
--

CREATE TABLE `group_permissions` (
  `id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `allow` int(2) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `group_permissions`
--

INSERT INTO `group_permissions` (`id`, `group_id`, `permission_id`, `allow`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(272, 46, 17, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(273, 46, 57, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(274, 46, 33, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(275, 46, 43, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(276, 46, 42, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(277, 46, 29, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(278, 46, 26, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(279, 46, 27, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(280, 46, 37, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(281, 46, 34, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(282, 46, 35, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(283, 46, 41, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(284, 46, 38, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(285, 46, 39, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(286, 46, 47, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(287, 46, 44, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(288, 46, 45, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(289, 46, 51, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(290, 46, 48, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(291, 46, 49, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(292, 46, 14, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(293, 46, 4, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(294, 46, 5, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(295, 46, 25, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(296, 46, 22, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(297, 46, 23, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(298, 46, 13, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(299, 46, 1, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(300, 46, 2, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(301, 46, 21, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(302, 46, 18, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(303, 46, 19, 1, 13, 13, '2025-08-23 03:54:28', '2025-08-23 03:54:28'),
(414, 45, 33, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(415, 45, 30, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(416, 45, 31, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(417, 45, 43, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(418, 45, 42, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(419, 45, 29, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(420, 45, 26, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(421, 45, 27, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(422, 45, 37, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(423, 45, 34, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(424, 45, 35, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(425, 45, 41, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(426, 45, 38, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(427, 45, 39, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(428, 45, 47, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(429, 45, 44, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(430, 45, 45, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(431, 45, 51, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(432, 45, 48, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(433, 45, 49, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(434, 45, 14, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(435, 45, 25, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(436, 45, 13, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(437, 45, 21, 1, 25, 25, '2025-08-23 11:55:16', '2025-08-23 11:55:16'),
(455, 47, 43, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(456, 47, 42, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(457, 47, 29, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(458, 47, 37, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(459, 47, 34, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(460, 47, 35, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(461, 47, 41, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(462, 47, 38, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(463, 47, 39, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(464, 47, 47, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(465, 47, 51, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(466, 47, 48, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(467, 47, 49, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(468, 47, 14, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(469, 47, 25, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(470, 47, 13, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(471, 47, 21, 1, 25, 25, '2025-08-23 11:57:33', '2025-08-23 11:57:33'),
(490, 48, 43, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(491, 48, 42, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(492, 48, 29, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(493, 48, 26, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(494, 48, 27, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(495, 48, 37, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(496, 48, 41, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(497, 48, 39, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(498, 48, 47, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(499, 48, 44, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(500, 48, 45, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(501, 48, 51, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(502, 48, 48, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(503, 48, 49, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(504, 48, 14, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(505, 48, 25, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(506, 48, 13, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(507, 48, 21, 1, 25, 25, '2025-08-23 12:00:04', '2025-08-23 12:00:04'),
(508, 44, 17, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(509, 44, 57, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(510, 44, 56, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(511, 44, 33, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(512, 44, 30, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(513, 44, 31, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(514, 44, 32, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(515, 44, 43, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(516, 44, 42, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(517, 44, 29, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(518, 44, 26, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(519, 44, 27, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(520, 44, 28, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(521, 44, 37, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(522, 44, 34, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(523, 44, 35, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(524, 44, 36, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(525, 44, 41, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(526, 44, 38, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(527, 44, 39, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(528, 44, 40, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(529, 44, 47, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(530, 44, 44, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(531, 44, 45, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(532, 44, 46, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(533, 44, 55, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(534, 44, 53, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(535, 44, 51, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(536, 44, 48, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(537, 44, 49, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(538, 44, 50, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(539, 44, 14, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(540, 44, 4, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(541, 44, 5, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(542, 44, 6, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(543, 44, 25, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(544, 44, 22, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(545, 44, 23, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(546, 44, 24, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(547, 44, 13, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(548, 44, 1, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(549, 44, 2, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(550, 44, 3, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(551, 44, 21, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(552, 44, 18, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(553, 44, 19, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(554, 44, 20, 1, 1, 1, '2025-08-24 13:12:42', '2025-08-24 13:12:42'),
(709, 24, 33, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(710, 24, 30, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(711, 24, 31, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(712, 24, 43, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(713, 24, 42, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(714, 24, 61, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(715, 24, 58, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(716, 24, 29, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(717, 24, 26, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(718, 24, 27, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(719, 24, 37, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(720, 24, 34, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(721, 24, 35, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(722, 24, 41, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(723, 24, 38, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(724, 24, 39, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(725, 24, 47, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(726, 24, 44, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(727, 24, 45, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(728, 24, 14, 1, 1, 1, '2025-10-09 01:22:15', '2025-10-09 01:22:15'),
(729, 2, 17, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(730, 2, 57, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(731, 2, 56, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(732, 2, 33, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(733, 2, 30, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(734, 2, 31, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(735, 2, 32, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(736, 2, 43, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(737, 2, 42, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(738, 2, 61, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(739, 2, 58, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(740, 2, 59, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(741, 2, 60, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(742, 2, 29, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(743, 2, 26, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(744, 2, 27, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(745, 2, 28, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(746, 2, 37, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(747, 2, 34, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(748, 2, 35, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(749, 2, 36, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(750, 2, 41, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(751, 2, 38, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(752, 2, 39, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(753, 2, 40, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(754, 2, 47, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(755, 2, 44, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(756, 2, 45, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(757, 2, 46, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(758, 2, 68, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(759, 2, 65, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(760, 2, 66, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(761, 2, 67, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(762, 2, 51, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(763, 2, 48, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(764, 2, 49, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(765, 2, 50, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(766, 2, 14, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(767, 2, 4, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(768, 2, 5, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(769, 2, 6, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(770, 2, 25, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(771, 2, 22, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(772, 2, 23, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(773, 2, 24, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(774, 2, 13, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(775, 2, 1, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(776, 2, 2, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(777, 2, 3, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(778, 2, 21, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(779, 2, 18, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(780, 2, 19, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24'),
(781, 2, 20, 1, 1, 1, '2026-07-18 21:17:24', '2026-07-18 21:17:24');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `id` int(11) NOT NULL,
  `inventoryid` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`id`, `inventoryid`, `site_id`, `product_id`, `quantity`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 34, 1, 10, 13, 1, '2025-08-22 20:12:45', '2025-08-22 20:14:34'),
(2, 2, 36, 1, 3, 1, 14, '2025-08-22 20:15:18', '2025-09-25 04:36:00'),
(3, 3, 34, 2, 0, 13, 13, '2025-08-22 20:16:56', '2025-08-22 20:16:56'),
(4, 4, 36, 2, 7, 1, 14, '2025-08-22 20:17:44', '2025-08-22 20:20:13'),
(5, 5, 34, 3, 10, 13, 13, '2025-09-25 02:20:38', '2025-09-25 02:32:00'),
(6, 6, 36, 3, 1, 13, 13, '2025-09-25 02:31:16', '2025-09-25 02:31:16'),
(7, 7, 34, 4, 0, 13, 13, '2025-09-25 04:01:42', '2025-09-25 04:01:42'),
(8, 8, 36, 4, 5, 13, 14, '2025-09-25 04:07:26', '2025-09-25 04:36:00'),
(9, 9, 37, 1, 6, 1, 1, '2025-10-09 06:27:37', '2025-10-11 08:41:13'),
(10, 10, 37, 2, 1, 1, 1, '2025-10-09 06:28:18', '2025-10-11 05:24:39'),
(11, 11, 37, 3, 126, 1, 1, '2025-10-09 06:28:31', '2025-10-11 07:56:56'),
(12, 12, 37, 4, 1, 1, 1, '2025-10-09 06:28:45', '2025-10-11 03:42:52');

-- --------------------------------------------------------

--
-- Table structure for table `inventory_transactions`
--

CREATE TABLE `inventory_transactions` (
  `id` int(11) NOT NULL,
  `transactionid` int(11) NOT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `site_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `old_quantity` int(11) NOT NULL,
  `new_quantity` int(11) NOT NULL,
  `change_quantity` int(11) DEFAULT NULL,
  `transaction_type` int(2) NOT NULL COMMENT '0=incoming,1=outgoing',
  `amount` float DEFAULT NULL,
  `invoice` varchar(50) DEFAULT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory_transactions`
--

INSERT INTO `inventory_transactions` (`id`, `transactionid`, `inventory_id`, `site_id`, `product_id`, `old_quantity`, `new_quantity`, `change_quantity`, `transaction_type`, `amount`, `invoice`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 34, 1, 0, 0, 0, 0, 0, '', 'Initial Inventory Entry', 13, 13, '2025-08-22 20:12:45', '2025-08-22 20:12:45'),
(2, 2, 1, 34, 1, 0, 10, 10, 0, 1500, '', 'added first stock', 1, 1, '2025-08-22 20:14:34', '2025-08-22 20:14:34'),
(3, 3, 2, 36, 1, 0, 10, 10, 0, 1500, '', 'added', 1, 1, '2025-08-22 20:15:18', '2025-08-22 20:15:18'),
(4, 4, 3, 34, 2, 0, 0, 0, 0, 0, '', 'Initial Inventory Entry', 13, 13, '2025-08-22 20:16:56', '2025-08-22 20:16:56'),
(5, 5, 4, 36, 2, 0, 10, 10, 0, 17690, '', 'dvdsv', 1, 1, '2025-08-22 20:17:44', '2025-08-22 20:17:44'),
(6, 6, 2, 36, 1, 10, 5, 5, 1, 825, '20250823015013_SI-001.pdf', 'Sale done for PI-001: Sazad Ahemad (UHID: 123456789000)', 0, 14, '2025-08-22 20:20:13', '2025-08-22 20:20:13'),
(7, 7, 4, 36, 2, 10, 7, 3, 1, 6580.68, '20250823015013_SI-001.pdf', 'Sale done for PI-001: Sazad Ahemad (UHID: 123456789000)', 0, 14, '2025-08-22 20:20:13', '2025-08-22 20:20:13'),
(8, 8, 5, 34, 3, 0, 0, 0, 0, 0, '', 'Initial Inventory Entry', 13, 13, '2025-09-25 02:20:38', '2025-09-25 02:20:38'),
(9, 9, 6, 36, 3, 0, 1, 1, 0, 150, '', '', 13, 13, '2025-09-25 02:31:16', '2025-09-25 02:31:16'),
(10, 10, 5, 34, 3, 0, 10, 10, 0, 1500, '', '', 13, 13, '2025-09-25 02:32:00', '2025-09-25 02:32:00'),
(11, 11, 7, 34, 4, 0, 0, 0, 0, 0, '', 'Initial Inventory Entry', 13, 13, '2025-09-25 04:01:42', '2025-09-25 04:01:42'),
(12, 12, 8, 36, 4, 0, 10, 10, 0, 2190, '', 'Intial Site Stock', 13, 13, '2025-09-25 04:07:26', '2025-09-25 04:07:26'),
(13, 13, 8, 36, 4, 10, 5, 5, 1, 1149.75, '20250925100600_SI-002.pdf', 'Sale done for PI-001: Sazad Ahemad (UHID: 123456789000)', 0, 14, '2025-09-25 04:36:00', '2025-09-25 04:36:01'),
(14, 14, 2, 36, 1, 5, 3, 2, 1, 330, '20250925100600_SI-002.pdf', 'Sale done for PI-001: Sazad Ahemad (UHID: 123456789000)', 0, 14, '2025-09-25 04:36:00', '2025-09-25 04:36:01'),
(15, 15, 9, 37, 1, 0, 10, 10, 0, 1500, '', '', 1, 1, '2025-10-09 06:27:37', '2025-10-09 06:27:37'),
(16, 16, 10, 37, 2, 0, 20, 20, 0, 35380, '', '', 1, 1, '2025-10-09 06:28:18', '2025-10-09 06:28:18'),
(17, 17, 11, 37, 3, 0, 200, 200, 0, 30000, '', '', 1, 1, '2025-10-09 06:28:31', '2025-10-09 06:28:31'),
(18, 18, 12, 37, 4, 0, 10, 10, 0, 2190, '', '', 1, 1, '2025-10-09 06:28:45', '2025-10-09 06:28:45'),
(19, 19, 10, 37, 2, 20, 19, 1, 1, 2193.56, NULL, 'Sale done for Customer Invoice ID: CSI-002, Customer Name: DR. KVNNS ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:19:40', '2025-10-11 03:19:40'),
(20, 20, 10, 37, 2, 19, 18, 1, 1, 2193.56, NULL, 'Sale done for Customer Invoice ID: CSI-002, Customer Name: DR. KVNNS ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:20:04', '2025-10-11 03:20:04'),
(21, 21, 10, 37, 2, 18, 17, 1, 1, 2193.56, NULL, 'Sale done for Customer Invoice ID: CSI-002, Customer Name: DR. KVNNS ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:21:10', '2025-10-11 03:21:10'),
(22, 22, 10, 37, 2, 17, 16, 1, 1, 2193.56, NULL, 'Sale done for Customer Invoice ID: CSI-002, Customer Name: DR. KVNNS ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:22:42', '2025-10-11 03:22:42'),
(23, 23, 9, 37, 1, 10, 9, 1, 1, 1770, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:31:38', '2025-10-11 03:31:38'),
(24, 24, 10, 37, 2, 16, 13, 3, 1, 4248, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:31:38', '2025-10-11 03:31:38'),
(25, 25, 11, 37, 3, 200, 199, 1, 1, 157.5, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:31:38', '2025-10-11 03:31:38'),
(26, 26, 9, 37, 1, 9, 8, 1, 1, 1770, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:31:55', '2025-10-11 03:31:55'),
(27, 27, 10, 37, 2, 13, 10, 3, 1, 4248, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:31:55', '2025-10-11 03:31:55'),
(28, 28, 11, 37, 3, 199, 198, 1, 1, 157.5, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 03:31:55', '2025-10-11 03:31:55'),
(29, 29, 9, 37, 1, 8, 3, 5, 1, 825, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:33:55', '2025-10-11 03:33:55'),
(30, 30, 11, 37, 3, 198, 188, 10, 1, 1575, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:33:55', '2025-10-11 03:33:55'),
(31, 31, 10, 37, 2, 10, 8, 2, 1, 4387.12, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:33:55', '2025-10-11 03:33:55'),
(32, 32, 12, 37, 4, 10, 7, 3, 1, 689.85, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:33:55', '2025-10-11 03:33:55'),
(33, 33, 11, 37, 3, 188, 178, 10, 1, 1575, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:39:41', '2025-10-11 03:39:41'),
(34, 34, 10, 37, 2, 8, 6, 2, 1, 4387.12, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:39:41', '2025-10-11 03:39:41'),
(35, 35, 12, 37, 4, 7, 4, 3, 1, 689.85, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:39:42', '2025-10-11 03:39:42'),
(36, 36, 11, 37, 3, 178, 168, 10, 1, 1575, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:42:52', '2025-10-11 03:42:52'),
(37, 37, 10, 37, 2, 6, 4, 2, 1, 4387.12, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:42:52', '2025-10-11 03:42:52'),
(38, 38, 12, 37, 4, 4, 1, 3, 1, 689.85, NULL, 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 03:42:52', '2025-10-11 03:42:52'),
(39, 39, 9, 37, 1, 3, 2, 1, 1, 1770, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 05:24:38', '2025-10-11 05:24:38'),
(40, 40, 10, 37, 2, 4, 1, 3, 1, 4248, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 05:24:39', '2025-10-11 05:24:39'),
(41, 41, 11, 37, 3, 168, 167, 1, 1, 157.5, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 05:24:39', '2025-10-11 05:24:39'),
(42, 42, 9, 37, 1, 2, 1, 1, 1, 1770, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 05:24:44', '2025-10-11 05:24:44'),
(43, 43, 11, 37, 3, 167, 166, 1, 1, 157.5, NULL, 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 05:24:44', '2025-10-11 05:24:44'),
(44, 44, 11, 37, 3, 166, 165, 1, 1, 157.5, '20251011110506_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 05:35:06', '2025-10-11 05:35:09'),
(45, 45, 11, 37, 3, 165, 164, 1, 1, 157.5, '20251011112712_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 05:57:12', '2025-10-11 05:57:15'),
(46, 46, 11, 37, 3, 164, 163, 1, 1, 157.5, '20251011113315_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:03:15', '2025-10-11 06:03:16'),
(47, 47, 11, 37, 3, 163, 162, 1, 1, 157.5, '20251011113728_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:07:27', '2025-10-11 06:07:28'),
(48, 48, 11, 37, 3, 162, 161, 1, 1, 157.5, '20251011114256_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:12:56', '2025-10-11 06:12:57'),
(49, 49, 11, 37, 3, 161, 160, 1, 1, 157.5, '20251011114644_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:16:44', '2025-10-11 06:16:44'),
(50, 50, 11, 37, 3, 160, 159, 1, 1, 157.5, '20251011114808_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:18:07', '2025-10-11 06:18:09'),
(51, 51, 11, 37, 3, 159, 158, 1, 1, 157.5, '20251011114937_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:19:37', '2025-10-11 06:19:37'),
(52, 52, 11, 37, 3, 158, 157, 1, 1, 157.5, '20251011115131_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:21:31', '2025-10-11 06:21:32'),
(53, 53, 11, 37, 3, 157, 156, 1, 1, 157.5, '20251011115228_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:22:28', '2025-10-11 06:22:29'),
(54, 54, 11, 37, 3, 156, 155, 1, 1, 157.5, '20251011115327_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:23:27', '2025-10-11 06:23:28'),
(55, 55, 11, 37, 3, 155, 154, 1, 1, 157.5, '20251011115549_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:25:49', '2025-10-11 06:25:50'),
(56, 56, 11, 37, 3, 154, 153, 1, 1, 157.5, '20251011120805_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:38:05', '2025-10-11 06:38:06'),
(57, 57, 11, 37, 3, 153, 152, 1, 1, 157.5, '20251011120838_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 06:38:38', '2025-10-11 06:38:38'),
(58, 58, 11, 37, 3, 152, 151, 1, 1, 157.5, '20251011123741_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:07:41', '2025-10-11 07:07:42'),
(59, 59, 11, 37, 3, 151, 150, 1, 1, 157.5, '20251011123917_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:09:17', '2025-10-11 07:09:18'),
(60, 60, 11, 37, 3, 150, 149, 1, 1, 157.5, '20251011124000_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:10:00', '2025-10-11 07:10:01'),
(61, 61, 11, 37, 3, 149, 148, 1, 1, 157.5, '20251011124103_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:11:03', '2025-10-11 07:11:04'),
(62, 62, 11, 37, 3, 148, 147, 1, 1, 157.5, '20251011124205_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:12:05', '2025-10-11 07:12:06'),
(63, 63, 11, 37, 3, 147, 146, 1, 1, 157.5, '20251011124459_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:14:59', '2025-10-11 07:15:00'),
(64, 64, 11, 37, 3, 146, 145, 1, 1, 157.5, '20251011124659_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:16:59', '2025-10-11 07:17:00'),
(65, 65, 11, 37, 3, 145, 144, 1, 1, 157.5, '20251011124903_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:19:03', '2025-10-11 07:19:04'),
(66, 66, 11, 37, 3, 144, 143, 1, 1, 157.5, '20251011125048_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:20:48', '2025-10-11 07:20:49'),
(67, 67, 11, 37, 3, 143, 142, 1, 1, 157.5, '20251011125323_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:23:23', '2025-10-11 07:23:24'),
(68, 68, 11, 37, 3, 142, 141, 1, 1, 157.5, '20251011131121_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:41:21', '2025-10-11 07:41:23'),
(69, 69, 11, 37, 3, 141, 140, 1, 1, 157.5, '20251011131620_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:46:20', '2025-10-11 07:46:21'),
(70, 70, 11, 37, 3, 140, 139, 1, 1, 157.5, '20251011131737_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:47:37', '2025-10-11 07:47:37'),
(71, 71, 11, 37, 3, 139, 138, 1, 1, 157.5, '20251011132052_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:50:52', '2025-10-11 07:50:53'),
(72, 72, 11, 37, 3, 138, 137, 1, 1, 157.5, '20251011132238_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:52:38', '2025-10-11 07:52:39'),
(73, 73, 11, 37, 3, 137, 136, 1, 1, 157.5, '20251011132635_CSI-001.pdf', 'Sale done for Customer Invoice ID: CSI-001, Customer Name: DR. KVNN\'S ADVANCED WOUND HEALING CLINIC', 0, 1, '2025-10-11 07:56:35', '2025-10-11 07:56:36'),
(74, 74, 11, 37, 3, 136, 126, 10, 1, 1575, '20251011132656_CSI-003.pdf', 'Sale done for Customer Invoice ID: CSI-003, Customer Name: Lyncdigit Technologies', 0, 1, '2025-10-11 07:56:56', '2025-10-11 07:56:57'),
(75, 75, 9, 37, 1, 1, 11, 10, 0, 1500, '', '', 1, 1, '2025-10-11 08:40:23', '2025-10-11 08:40:23'),
(76, 76, 9, 37, 1, 11, 6, 5, 1, 840, '20251011141113_CSI-004.pdf', 'Sale done for Customer Invoice ID: CSI-004, Customer Name: Sazad Ahemad', 0, 1, '2025-10-11 08:41:13', '2025-10-11 08:41:13');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL,
  `menu_name` varchar(50) NOT NULL,
  `primary_secondary` varchar(50) NOT NULL,
  `link_to` varchar(255) NOT NULL,
  `is_trashed` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `updated_by` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`menu_id`, `menu_name`, `primary_secondary`, `link_to`, `is_trashed`, `is_deleted`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Home', 'primary_secondary', 'http://127.0.0.1/biswajit-packers-and-movers/', 0, 0, 'connect2sazad', '2024-07-22 22:13:35', '2024-07-22 22:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `metas`
--

CREATE TABLE `metas` (
  `meta_id` int(11) NOT NULL,
  `meta_unique_name` varchar(100) NOT NULL,
  `attr_type` varchar(50) NOT NULL,
  `attr_value` varchar(255) NOT NULL,
  `content` mediumtext NOT NULL,
  `updated_by` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `metas`
--

INSERT INTO `metas` (`meta_id`, `meta_unique_name`, `attr_type`, `attr_value`, `content`, `updated_by`, `updated_at`, `created_at`) VALUES
(99, 'pages_UyIGnVsT', 'name', 'keywords', 'StepCure', 'admin', '2025-07-08 19:59:24', '2025-07-08 19:59:24'),
(100, 'pages_UyIGnVsT', 'name', 'description', 'StepCure', 'admin', '2025-07-08 19:59:24', '2025-07-08 19:59:24'),
(101, 'pages_12', 'name', 'keywords', 'StepCure, smart footcare, precision orthotics, foot pain relief, custom insoles', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(102, 'pages_12', 'name', 'description', 'StepCure offers smart footcare solutions with precision orthotics designed to relieve foot pain, enhance mobility, and support long-term recovery with advanced technology.', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(103, 'pages_12', 'name', 'laungauge', 'English', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(104, 'pages_12', 'name', 'allow-search', 'yes', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(105, 'pages_12', 'name', 'robots', 'index,follow', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(106, 'pages_12', 'name', 'rating', 'general', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(107, 'pages_12', 'name', 'copyright', '2025 StepCure', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(108, 'pages_12', 'name', 'expires', 'never', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(109, 'pages_12', 'name', 'audience', 'ALL', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(110, 'pages_12', 'name', 'author', 'Lyncdigit Technologies Pvt. Ltd.', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(111, 'pages_12', 'name', 'classification', 'service', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(112, 'pages_12', 'name', 'distribution', 'global', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(113, 'pages_12', 'name', 'DC.title', 'StepCure', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(114, 'pages_12', 'name', 'geo.region', 'IN-OR', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(115, 'pages_12', 'name', 'geo.placename', 'Bhubaneswar Municipal Corporation', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(116, 'pages_12', 'name', 'google-site-verification', 'hUrUhUc0P8Ut_dl8uQWva2LrIWZo5CAtyXxYQzjNhmk', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(117, 'pages_12', 'name', 'geo.position', '20.238216;85.831201', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(118, 'pages_12', 'name', 'ICBM', '20.238216;85.831201', 'connect2sazad', '2025-07-14 22:44:40', '2025-07-14 22:44:40'),
(133, 'pages_z1p28NXc', 'name', 'keywords', '', 'connect2sazad', '2025-07-14 22:50:19', '2025-07-14 22:50:19'),
(134, 'pages_z1p28NXc', 'name', 'description', '', 'connect2sazad', '2025-07-14 22:50:19', '2025-07-14 22:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `online_users`
--

CREATE TABLE `online_users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` varchar(200) NOT NULL,
  `address_state` int(11) NOT NULL,
  `address_city` varchar(50) NOT NULL,
  `address_pin` char(6) NOT NULL,
  `patients` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`patients`)),
  `is_business_or_person` int(2) NOT NULL DEFAULT 0 COMMENT '0=person,1=business',
  `registered_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `remarks` varchar(200) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '	0=inactive,1=active',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL DEFAULT 1,
  `updated_by` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `online_users`
--

INSERT INTO `online_users` (`id`, `email`, `password`, `first_name`, `last_name`, `phone`, `address`, `address_state`, `address_city`, `address_pin`, `patients`, `is_business_or_person`, `registered_on`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'ravisingh2002@gmail.com', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', 'Ravi', 'Singh', '9226633131', '315, Navratan Building, P D Melostreet, Carnac, Masjid Bunder (west)', 14, 'Mumbai', '400003', '[1,2]', 0, '2025-10-19 10:10:01', '', 1, 0, 1, 1, '2025-10-19 10:10:01', '2025-10-19 11:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_unique_name` varchar(50) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `page_htmls` longtext NOT NULL,
  `page_content` longtext NOT NULL,
  `featured_image` mediumtext NOT NULL,
  `updated_by` varchar(255) NOT NULL,
  `is_trashed` int(11) NOT NULL DEFAULT 0,
  `is_deleted` int(11) NOT NULL DEFAULT 0,
  `meta_unique_name` varchar(100) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_unique_name`, `page_title`, `slug`, `page_htmls`, `page_content`, `featured_image`, `updated_by`, `is_trashed`, `is_deleted`, `meta_unique_name`, `updated_at`, `created_at`) VALUES
(1, 'front_page', 'HOME', 'front_page', '', '[\n    {\n        \"block_unique_name\": \"triple_boxes_with_image\",\n        \"block_values\": {\n            \"title\": \"our packages\",\n            \"box1_title\": \"golden triangle tour odisha\",\n            \"box1_image_link\": \"https://media.istockphoto.com/photos/sun-temple-picture-id1327095675?b=1&k=20&m=1327095675&s=170667a&w=0&h=Bh3N879fgVrpen_KZqWK0AiNrMNQctCSa6XPS1dtm7Q=\",\n            \"box1_content\": \"02 nights & 03 days\",\n            \"box1_btn_name\": \"enquire\",\n            \"box1_btn0_link\": \"packages.php?package=golden-triangle-tour-odisha\",\n            \"box1_btn_link\": \"book.php\",\n            \"box2_image_link\": \"https://c0.wallpaperflare.com/preview/594/723/825/india-chilika-lake-birds-lake.jpg\",\n            \"box2_title\": \"Bhubaneswar Puri Konark Tour Package\",\n            \"box2_content\": \"04 nights & 05 days\",\n            \"box2_btn_name\": \"enquire\",\n            \"box2_btn0_link\": \"packages.php?package=bhubaneswar-konark-puri-tour\",\n            \"box2_btn_link\": \"book.php\",\n            \"box3_image_link\": \"https://www.outlookindia.com/outlooktraveller//public/uploads/filemanager/images/Gopalpur-Beach-(2).jpg\",\n            \"box3_title\": \"Beach & Temple Tour Odisha\",\n            \"box3_content\": \"06 nights & 05 days\",\n            \"box3_btn_name\": \"enquire\",\n            \"box3_btn0_link\": \"packages.php?package=beach--temple-tour-odisha\",\n            \"box3_btn_link\": \"book.php\",\n            \"end_btn_name\": \"load more\",\n            \"end_btn_link\": \"packages.php\"\n        }\n    },\n    {\n        \"block_unique_name\": \"tiles_boxes\",\n        \"block_values\": {\n            \"title\": \"Our Services\",\n            \"tile1_image_link\": \"images/icon-7.png\",\n            \"tile1_name\": \"Car Rent\",\n            \"tile2_image_link\": \"images/icon-1.png\",\n            \"tile2_name\": \"Adventure\",\n            \"tile3_image_link\": \"images/icon-2.png\",\n            \"tile3_name\": \"Tour Guide\",\n            \"tile4_image_link\": \"images/icon-3.png\",\n            \"tile4_name\": \"Trekking\",\n            \"tile5_image_link\": \"images/icon-4.png\",\n            \"tile5_name\": \"Camp Fire\",\n            \"tile6_image_link\": \"images/icon-5.png\",\n            \"tile6_name\": \"Off Road\",\n            \"tile7_image_link\": \"images/icon-6.png\",\n            \"tile7_name\": \"Camping\"\n        }\n    },\n    {\n        \"block_unique_name\": \"image_with_content\",\n        \"block_values\": {\n            \"title\": \"About Us\",\n            \"image_link\": \"images/about-img.jpg\",\n            \"image_alt\": \"Holding Hands\",\n            \"content\": \"Advice from the ocean: Be shore of yourself. Come out of your shell. Take time to coast. Avoid pier pressure. Sea life\'s beauty. Don\'t get so tide down on work that you miss out on life\'s beautiful waves.\",\n            \"btn_name\": \"Read more\",\n            \"btn_link\": \"about.php\"\n        }\n    },\n    {\n        \"block_unique_name\": \"content_with_button_car_rental\",\n        \"block_values\": {\n            \"title\": \"car rentals in odisha\",\n            \"btn_name\": \"Book a car\",\n            \"btn_link\": \"car-rentals.php\"\n        }\n    },\n    {\n        \"block_unique_name\": \"content_with_button\",\n        \"block_values\": {\n            \"title\": \"we have expertise in providing you best tour packages\",\n            \"btn_name\": \"Read more\",\n            \"btn_link\": \"about.php\"\n        }\n    }\n]', 'http://127.0.0.1/stepcure/themes/LT-367/assets/img/breadcrumb.png', 'connect2sazad', 0, 0, 'pages_12', '2025-07-16 14:13:27', '2022-08-19 20:12:05'),
(2, 'privacy-policy', 'Privacy Policy', 'privacy-policy', '<p data-start=\"204\" data-end=\"432\">At <strong data-start=\"207\" data-end=\"219\">StepCure</strong>, we value your privacy and are committed to safeguarding the personal information you share with us. This policy outlines how we collect, use, and protect your data when you interact with our website or services.</p>\r\n<p data-start=\"204\" data-end=\"432\">&nbsp;</p>\r\n<h3 data-start=\"439\" data-end=\"472\">1. <strong data-start=\"446\" data-end=\"472\">Information We Collect</strong></h3>\r\n<p data-start=\"473\" data-end=\"537\">We may collect personally identifiable information such as your:</p>\r\n<ul data-start=\"539\" data-end=\"657\">\r\n<li data-start=\"539\" data-end=\"547\">\r\n<p data-start=\"541\" data-end=\"547\">Name</p>\r\n</li>\r\n<li data-start=\"548\" data-end=\"559\">\r\n<p data-start=\"550\" data-end=\"559\">Address</p>\r\n</li>\r\n<li data-start=\"560\" data-end=\"576\">\r\n<p data-start=\"562\" data-end=\"576\">Phone number</p>\r\n</li>\r\n<li data-start=\"577\" data-end=\"594\">\r\n<p data-start=\"579\" data-end=\"594\">Email address</p>\r\n</li>\r\n<li data-start=\"595\" data-end=\"657\">\r\n<p data-start=\"597\" data-end=\"657\">Medical requirements (where applicable for service delivery)</p>\r\n</li>\r\n</ul>\r\n<p data-start=\"659\" data-end=\"774\">We only collect this data when you voluntarily provide it through our website forms, contact channels, or bookings.</p>\r\n<p data-start=\"659\" data-end=\"774\">&nbsp;</p>\r\n<h3 data-start=\"781\" data-end=\"806\">2. <strong data-start=\"788\" data-end=\"806\">Use of Cookies</strong></h3>\r\n<p data-start=\"807\" data-end=\"998\">Some of our web pages use &ldquo;<strong data-start=\"834\" data-end=\"845\">cookies</strong>&rdquo; to personalize your experience. Cookies are small files sent to your browser to store preferences and help us provide tailored content when you return.</p>\r\n<p data-start=\"1000\" data-end=\"1163\">You can modify your browser settings to alert you before accepting cookies or disable them altogether. However, disabling cookies may impact some website features.</p>\r\n<p data-start=\"1000\" data-end=\"1163\">&nbsp;</p>\r\n<h3 data-start=\"1170\" data-end=\"1214\">3. <strong data-start=\"1177\" data-end=\"1214\">Purpose of Information Collection</strong></h3>\r\n<p data-start=\"1215\" data-end=\"1254\">The information you provide is used to:</p>\r\n<ul data-start=\"1256\" data-end=\"1477\">\r\n<li data-start=\"1256\" data-end=\"1310\">\r\n<p data-start=\"1258\" data-end=\"1310\">Confirm appointments, travel, or footcare bookings</p>\r\n</li>\r\n<li data-start=\"1311\" data-end=\"1357\">\r\n<p data-start=\"1313\" data-end=\"1357\">Personalize your experience on our website</p>\r\n</li>\r\n<li data-start=\"1358\" data-end=\"1395\">\r\n<p data-start=\"1360\" data-end=\"1395\">Offer service updates and support</p>\r\n</li>\r\n<li data-start=\"1396\" data-end=\"1477\">\r\n<p data-start=\"1398\" data-end=\"1477\">Comply with legal requirements (e.g., billing, taxation, and medical referrals)</p>\r\n</li>\r\n</ul>\r\n<p data-start=\"1479\" data-end=\"1594\">You may choose not to provide certain information, but this may limit your access to specific services or features.</p>\r\n<p data-start=\"1479\" data-end=\"1594\">&nbsp;</p>\r\n<h3 data-start=\"1601\" data-end=\"1639\">4. <strong data-start=\"1608\" data-end=\"1639\">Data Sharing and Disclosure</strong></h3>\r\n<p data-start=\"1640\" data-end=\"1730\"><strong data-start=\"1640\" data-end=\"1652\">StepCure</strong> does <strong data-start=\"1658\" data-end=\"1686\">not sell, trade, or rent</strong> your personal information to third parties.</p>\r\n<p data-start=\"1732\" data-end=\"1902\">We may share your data only with trusted service partners (such as hospitals, wellness centers, or travel partners) solely to fulfill your confirmed bookings or services.</p>\r\n<p data-start=\"1904\" data-end=\"2016\">We may also disclose your information if required by law, legal process, or to protect the safety of any person.</p>\r\n<p data-start=\"1904\" data-end=\"2016\">&nbsp;</p>\r\n<h3 data-start=\"2023\" data-end=\"2060\">5. <strong data-start=\"2030\" data-end=\"2060\">Data Protection &amp; Security</strong></h3>\r\n<p data-start=\"2061\" data-end=\"2301\">We implement the latest <strong data-start=\"2085\" data-end=\"2124\">security technologies and protocols</strong> to protect your data from unauthorized access, misuse, or disclosure. Our team follows strict internal policies to ensure the confidentiality and integrity of your information.</p>\r\n<p data-start=\"2303\" data-end=\"2438\">As technology evolves, StepCure will continue to update its security practices to maintain the highest standards of privacy protection.</p>\r\n<p data-start=\"2303\" data-end=\"2438\">&nbsp;</p>\r\n<h3 data-start=\"2445\" data-end=\"2470\">6. <strong data-start=\"2452\" data-end=\"2470\">Policy Updates</strong></h3>\r\n<p data-start=\"2471\" data-end=\"2690\">Our privacy practices may change from time to time. Any updates will be reflected on this page with a new effective date. We encourage you to check this page periodically to stay informed about how we protect your data.</p>\r\n<p data-start=\"2471\" data-end=\"2690\">&nbsp;</p>\r\n<h3 data-start=\"2697\" data-end=\"2718\">7. <strong data-start=\"2704\" data-end=\"2718\">Contact Us</strong></h3>\r\n<p data-start=\"2719\" data-end=\"2808\">For questions, feedback, or concerns regarding this privacy policy, please contact us at:</p>\r\n<p data-start=\"2810\" data-end=\"2861\">📧 <a href=\"mailto:privacy@stepcure.co\"><strong data-start=\"2813\" data-end=\"2836\">privacy@stepcure.co</strong></a><br data-start=\"2836\" data-end=\"2839\" />🌐 <strong data-start=\"2842\" data-end=\"2861\"><a class=\"\" href=\"http://www.stepcure.co\" data-start=\"2844\" data-end=\"2859\">www.stepcure.co</a></strong></p>\r\n<p>&nbsp;</p>\r\n<p data-start=\"2863\" data-end=\"2939\">We aim to respond to all legitimate inquiries within <strong data-start=\"2916\" data-end=\"2938\">five business days</strong>.</p>', '', 'http://127.0.0.1/stepcure/themes/LT-367/assets/img/breadcrumb.png', 'connect2sazad', 0, 0, 'pages_z1p28NXc', '2025-07-14 22:44:50', '2022-10-01 04:11:07'),
(3, 'terms-and-conditions', 'Terms and Conditions', 'terms-and-conditions', '<p data-start=\"242\" data-end=\"406\">Welcome to StepCure. By accessing our website and booking our services, you agree to the following Terms &amp; Conditions. Please read them carefully before proceeding.</p>\n<p data-start=\"242\" data-end=\"406\">&nbsp;</p>\n<h3 data-start=\"413\" data-end=\"447\">1. <strong data-start=\"420\" data-end=\"447\">Communication &amp; Booking</strong></h3>\n<p data-start=\"448\" data-end=\"632\">All communication regarding bookings, queries, or service-related requests should be addressed to <strong data-start=\"546\" data-end=\"563\">M/s. StepCure</strong> through our official website, email, or authorized contact channels.</p>\n<p data-start=\"448\" data-end=\"632\">&nbsp;</p>\n<h3 data-start=\"639\" data-end=\"658\">2. <strong data-start=\"646\" data-end=\"658\">Payments</strong></h3>\n<p data-start=\"659\" data-end=\"834\">To confirm your booking, a minimum <strong data-start=\"694\" data-end=\"713\">advance payment</strong> must be made, the percentage of which will be determined based on the service type, urgency, and peak season conditions.</p>\n<ul data-start=\"836\" data-end=\"1042\">\n<li data-start=\"836\" data-end=\"915\">\n<p data-start=\"838\" data-end=\"915\"><strong data-start=\"838\" data-end=\"857\">Balance Payment</strong>: Must be cleared before the commencement of the services.</p>\n</li>\n<li data-start=\"916\" data-end=\"1042\">\n<p data-start=\"918\" data-end=\"1042\"><strong data-start=\"918\" data-end=\"942\">Peak Season Bookings</strong> (e.g., December 20 &ndash; January 5): <strong data-start=\"976\" data-end=\"992\">Full payment</strong> is required in advance and is <strong data-start=\"1023\" data-end=\"1041\">non-refundable</strong>.</p>\n</li>\n</ul>\n<h3 data-start=\"1049\" data-end=\"1075\">3. <strong data-start=\"1056\" data-end=\"1075\">Mode of Payment</strong></h3>\n<ul data-start=\"1076\" data-end=\"1264\">\n<li data-start=\"1076\" data-end=\"1157\">\n<p data-start=\"1078\" data-end=\"1157\">For domestic clients: UPI, Bank Transfer, or any accepted digital payment mode.</p>\n</li>\n<li data-start=\"1158\" data-end=\"1261\">\n<p data-start=\"1160\" data-end=\"1261\">For international clients: Payment must be made via <strong data-start=\"1212\" data-end=\"1229\">Wire Transfer</strong> to our designated bank account.</p>\n</li>\n</ul>\n<p data-start=\"1265\" data-end=\"1341\">All payments must be acknowledged by StepCure through official confirmation.</p>\n<p data-start=\"1265\" data-end=\"1341\">&nbsp;</p>\n<h3 data-start=\"1348\" data-end=\"1378\">4. <strong data-start=\"1355\" data-end=\"1378\">Cancellation Policy</strong></h3>\n<p data-start=\"1379\" data-end=\"1467\">Cancellations must be made in <strong data-start=\"1409\" data-end=\"1425\">written form</strong> via email. Charges will apply as follows:</p>\n<ul data-start=\"1469\" data-end=\"1661\">\n<li data-start=\"1469\" data-end=\"1522\">\n<p data-start=\"1471\" data-end=\"1522\"><strong data-start=\"1471\" data-end=\"1507\">More than 45 days before service</strong>: 10% deduction</p>\n</li>\n<li data-start=\"1523\" data-end=\"1569\">\n<p data-start=\"1525\" data-end=\"1569\"><strong data-start=\"1525\" data-end=\"1554\">15&ndash;45 days before service</strong>: 25% deduction</p>\n</li>\n<li data-start=\"1570\" data-end=\"1615\">\n<p data-start=\"1572\" data-end=\"1615\"><strong data-start=\"1572\" data-end=\"1600\">7&ndash;14 days before service</strong>: 50% deduction</p>\n</li>\n<li data-start=\"1616\" data-end=\"1661\">\n<p data-start=\"1618\" data-end=\"1661\"><strong data-start=\"1618\" data-end=\"1650\">Less than 48 hours / No-show</strong>: No refund</p>\n</li>\n</ul>\n<blockquote data-start=\"1663\" data-end=\"1770\">\n<p data-start=\"1665\" data-end=\"1770\"><strong data-start=\"1665\" data-end=\"1674\">Note:</strong> Cancellations received on Sundays or public holidays will be processed on the next working day.</p>\n</blockquote>\n<p data-start=\"1772\" data-end=\"1864\">Refunds will be processed within <strong data-start=\"1805\" data-end=\"1827\">10&ndash;15 working days</strong> through the original payment method.</p>\n<p data-start=\"1772\" data-end=\"1864\">&nbsp;</p>\n<h3 data-start=\"1871\" data-end=\"1905\">5. <strong data-start=\"1878\" data-end=\"1905\">Non-Refundable Services</strong></h3>\n<ul data-start=\"1906\" data-end=\"2226\">\n<li data-start=\"1906\" data-end=\"2025\">\n<p data-start=\"1908\" data-end=\"2025\"><strong data-start=\"1908\" data-end=\"1932\">Medical appointments</strong>, <strong data-start=\"1934\" data-end=\"1962\">custom orthotic fittings</strong>, and <strong data-start=\"1968\" data-end=\"1989\">wellness programs</strong> once booked are <strong data-start=\"2006\" data-end=\"2024\">non-refundable</strong>.</p>\n</li>\n<li data-start=\"2026\" data-end=\"2138\">\n<p data-start=\"2028\" data-end=\"2138\"><strong data-start=\"2028\" data-end=\"2048\">Wildlife safaris</strong> or any integrated tourism booked through us are also non-refundable and non-transferable.</p>\n</li>\n<li data-start=\"2139\" data-end=\"2226\">\n<p data-start=\"2141\" data-end=\"2226\"><strong data-start=\"2141\" data-end=\"2155\">No refunds</strong> for partially used services, missed appointments, or early check-outs.</p>\n</li>\n</ul>\n<h3 data-start=\"2233\" data-end=\"2272\">&nbsp;</h3>\n<h3 data-start=\"2233\" data-end=\"2272\">6. <strong data-start=\"2240\" data-end=\"2272\">Amendments &amp; Price Revisions</strong></h3>\n<p data-start=\"2273\" data-end=\"2444\">If government taxes, medical facility charges, transport rates, or hotel tariffs change after booking, StepCure reserves the right to adjust the final invoice accordingly.</p>\n<p data-start=\"2273\" data-end=\"2444\">&nbsp;</p>\n<h3 data-start=\"2451\" data-end=\"2482\">7. <strong data-start=\"2458\" data-end=\"2482\">Liability Disclaimer</strong></h3>\n<p data-start=\"2483\" data-end=\"2594\">StepCure acts as a facilitator between clients and medical/wellness/tour providers. We shall not be liable for:</p>\n<ul data-start=\"2596\" data-end=\"2914\">\n<li data-start=\"2596\" data-end=\"2696\">\n<p data-start=\"2598\" data-end=\"2696\">Delays or service disruptions caused by natural calamities, political unrest, or technical issues.</p>\n</li>\n<li data-start=\"2697\" data-end=\"2774\">\n<p data-start=\"2699\" data-end=\"2774\">Loss, theft, or damage to personal belongings during the trip or treatment.</p>\n</li>\n<li data-start=\"2775\" data-end=\"2914\">\n<p data-start=\"2777\" data-end=\"2914\">Medical complications arising before, during, or after treatment. All medical decisions are the responsibility of licensed professionals.</p>\n</li>\n</ul>\n<h3 data-start=\"2921\" data-end=\"2941\">8. <strong data-start=\"2928\" data-end=\"2941\">Insurance</strong></h3>\n<p data-start=\"2942\" data-end=\"3115\">StepCure <strong data-start=\"2951\" data-end=\"2979\">does not offer insurance</strong> coverage for travel, health, or personal loss. Clients are strongly advised to arrange comprehensive insurance from their home country.</p>\n<p data-start=\"2942\" data-end=\"3115\">&nbsp;</p>\n<h3 data-start=\"3122\" data-end=\"3151\">9. <strong data-start=\"3129\" data-end=\"3151\">Medical Disclaimer</strong></h3>\n<p data-start=\"3152\" data-end=\"3360\">StepCure provides <strong data-start=\"3170\" data-end=\"3237\">non-emergency medical travel and footcare facilitation services</strong>. We do not provide direct medical advice or treatment. All treatments are administered by certified clinics and hospitals.</p>\n<p data-start=\"3152\" data-end=\"3360\">&nbsp;</p>\n<h3 data-start=\"3367\" data-end=\"3391\">10. <strong data-start=\"3375\" data-end=\"3391\">Jurisdiction</strong></h3>\n<p data-start=\"3392\" data-end=\"3526\">All disputes shall be subject to the jurisdiction of <strong data-start=\"3445\" data-end=\"3467\">Indian courts only</strong>, specifically in the city of StepCure&rsquo;s registered office.</p>\n<p data-start=\"3392\" data-end=\"3526\">&nbsp;</p>\n<p>&nbsp;</p>\n<p data-start=\"3533\" data-end=\"3615\">For any queries or further clarification, please write to <a title=\"Support Email\" href=\"mailto:support@stepcure.in\"><strong data-start=\"3591\" data-end=\"3614\">support@stepcure.in</strong></a>.</p>', '', 'http://127.0.0.1/stepcure/themes/LT-367/assets/img/breadcrumb.png', 'connect2sazad', 0, 0, 'pages_hvEpOT9B', '2025-07-14 22:52:49', '2022-10-01 04:12:42'),
(4, 'disclaimer', 'Disclaimer', 'disclaimer', '<p data-start=\"146\" data-end=\"177\"><strong data-start=\"146\" data-end=\"163\">Last Updated:</strong> 09-07-2025</p>\r\n<p data-start=\"179\" data-end=\"350\">The information provided on <strong data-start=\"207\" data-end=\"226\"><a class=\"\" href=\"http://www.stepcure.co\" data-start=\"209\" data-end=\"224\">www.stepcure.co</a></strong> is for <strong data-start=\"234\" data-end=\"273\">general informational purposes only</strong> and is not intended as professional medical advice, diagnosis, or treatment.</p>\r\n<p data-start=\"352\" data-end=\"757\">While StepCure connects clients with licensed medical professionals, clinics, wellness centers, and travel service providers, we do <strong data-start=\"484\" data-end=\"491\">not</strong> offer any direct medical treatment or travel insurance. All medical decisions should be made in consultation with qualified healthcare professionals. Any reliance you place on information provided by StepCure or its representatives is <strong data-start=\"727\" data-end=\"756\">strictly at your own risk</strong>.</p>\r\n<p data-start=\"759\" data-end=\"802\">StepCure shall not be held responsible for:</p>\r\n<ul data-start=\"803\" data-end=\"1105\">\r\n<li data-start=\"803\" data-end=\"888\">\r\n<p data-start=\"805\" data-end=\"888\">The accuracy or completeness of medical or travel advice provided by third parties.</p>\r\n</li>\r\n<li data-start=\"889\" data-end=\"1011\">\r\n<p data-start=\"891\" data-end=\"1011\">Any adverse effects, complications, or delays resulting from treatments, travel disruptions, or service provider errors.</p>\r\n</li>\r\n<li data-start=\"1012\" data-end=\"1105\">\r\n<p data-start=\"1014\" data-end=\"1105\">Loss, injury, or damage (direct or indirect) during any phase of your journey or treatment.</p>\r\n</li>\r\n</ul>\r\n<p data-start=\"1107\" data-end=\"1330\">Users are responsible for verifying the credentials of any third-party service providers we refer or partner with. Always consult a licensed physician or health provider before starting any treatment plan or medical travel.</p>\r\n<p>&nbsp;</p>\r\n<p data-start=\"1332\" data-end=\"1397\">By using our services, you agree to the terms of this disclaimer.</p>', '', 'http://127.0.0.1/stepcure/themes/LT-367/assets/img/breadcrumb.png', 'connect2sazad', 0, 0, 'pages_UyIGnVsT', '2025-07-14 22:53:17', '2025-06-26 07:34:05');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `online_user_id` int(11) DEFAULT NULL,
  `patientid` int(11) NOT NULL,
  `uhid` char(20) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` varchar(2) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `alt_phone` varchar(15) DEFAULT NULL,
  `whatsapp_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `address_state` int(11) NOT NULL,
  `address_city` varchar(50) NOT NULL,
  `address_pin` char(6) NOT NULL,
  `age` int(3) NOT NULL,
  `height` int(3) DEFAULT NULL COMMENT 'in cm',
  `weight` int(3) DEFAULT NULL COMMENT 'in kg',
  `is_diabetic` int(2) DEFAULT 0 COMMENT '0=not diabetic,1=diabetic',
  `diabetic_type` varchar(50) DEFAULT NULL,
  `diabetic_years` char(5) DEFAULT NULL,
  `diabetic_level` varchar(50) DEFAULT NULL,
  `diabetic_value` int(5) DEFAULT NULL,
  `is_inherited` int(2) DEFAULT NULL COMMENT '0=not inherited,1=inherited',
  `is_foot_examination_done` int(2) DEFAULT NULL COMMENT '0=not done, 1=done',
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active	',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `online_user_id`, `patientid`, `uhid`, `first_name`, `last_name`, `gender`, `phone`, `alt_phone`, `whatsapp_no`, `email`, `address`, `address_state`, `address_city`, `address_pin`, `age`, `height`, `weight`, `is_diabetic`, `diabetic_type`, `diabetic_years`, `diabetic_level`, `diabetic_value`, `is_inherited`, `is_foot_examination_done`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `updated_at`, `created_at`) VALUES
(1, 1, 1, '123456789000', 'Sazad', 'Ahemad', 'm', '7281327219', '7737914162', '7737914162', 'lyncdigit@gmail.com', 'Khordha', 19, 'Khordha', '752055', 25, 125, 50, 0, NULL, '', '', 0, 0, 1, 'test', 1, 0, 14, 14, '2025-08-22 20:06:16', '2025-11-06 03:07:42'),
(2, 1, 2, '00001', 'AYANTRAS', 'BARIK', 'm', '9861572334', '', '', '', '', 0, 'HYD', '500016', 29, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-23 04:03:41', '2025-11-06 03:07:44'),
(3, NULL, 3, '57098', 'MARIYAMMA', 'P', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 49, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-23 06:22:57', '2025-08-23 06:22:57'),
(4, NULL, 4, '056567', 'IPSHITA ', 'P', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 32, 0, 0, 1, NULL, '1', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-23 06:50:11', '2025-08-23 06:50:11'),
(5, NULL, 5, '057108', 'RAVI KUMAR', 'k', 'm', '9948496697', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '3', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-08-23 11:23:35', '2025-08-23 11:23:35'),
(6, NULL, 6, '57118', 'JOSHUVA ', 'VIKAS A', 'm', '9966849425', '', '', '', '', 0, 'HYDERABAD', '500072', 38, 0, 0, 1, NULL, '4', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-25 05:50:28', '2025-08-25 05:50:28'),
(7, NULL, 7, '57125', 'AMMAJI ', 'KEDARASI', 'f', '9642321341', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '7', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-25 07:49:44', '2025-08-25 07:49:44'),
(8, NULL, 8, '041648', 'PUSHPA', 'VENI S', 'f', '9491016541', '', '', '', '', 0, 'HYDERABAD', '500072', 64, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-26 05:10:52', '2025-08-26 05:10:52'),
(9, NULL, 9, '027650', 'LAKSHMI ', 'DEVI', 'f', '7989509358', '', '', '', '', 0, 'HYDERABAD', '500072', 43, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-26 08:32:15', '2025-08-26 08:32:15'),
(10, NULL, 10, '07492', 'SUKKMMA ', 'DASARI', 'f', '7842221218', '', '', '', '', 0, 'HYDERABAD', '500072', 60, 0, 0, 1, NULL, '8', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-26 09:36:38', '2025-08-26 09:36:38'),
(11, NULL, 11, '036377', 'PRAVEEN', 'KUMAR V', 'm', '9741410808', '', '', '', '', 0, 'HYDERABAD', '500072', 40, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-28 05:08:32', '2025-08-28 05:08:32'),
(12, NULL, 12, '57169', 'ANURADHA ', 'NOOKALA', 'f', '9705399490', '', '', '', '', 0, 'HYDERABAD', '500072', 57, 0, 0, 1, NULL, '1', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-29 06:57:04', '2025-08-29 06:57:04'),
(13, NULL, 13, '57172', 'SUJATHA', 'N', 'f', '9032918369', '', '', '', '', 0, 'HYDERABAD', '500072', 49, 0, 0, 1, NULL, '5', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-29 07:15:43', '2025-08-29 07:15:43'),
(14, NULL, 14, '38658', 'ANIL ', 'KUMAR V', 'm', '9666684473', '', '', '', '', 0, 'HYDERABAD', '500072', 33, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-29 08:26:08', '2025-08-29 08:26:08'),
(15, NULL, 15, '57180', 'VENKATA SURESH KUMAR ', 'YELLA', 'm', '9000603984', '', '', '', '', 0, 'HYDERABAD', '500072', 41, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-30 05:24:46', '2025-08-30 05:24:46'),
(16, NULL, 16, '57182', 'LILLY', 'MERUGA', 'f', '8790387457', '', '', '', '', 0, 'HYDERABAD', '500072', 47, 0, 0, 1, NULL, '4', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-30 06:14:14', '2025-08-30 06:14:14'),
(17, NULL, 17, '56808', 'RAJASEKHAR', 'B', 'm', '9963987774', '', '', '', '', 0, 'HYDERABAD', '500072', 45, 0, 0, 1, NULL, '3', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-30 07:24:38', '2025-08-30 07:24:38'),
(18, NULL, 18, '57192', 'AKASH ', 'ARE', 'm', '9640121868', '', '', '', '', 0, 'HYDERABAD', '500072', 32, 0, 0, 1, NULL, '2', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-30 09:28:30', '2025-08-30 09:28:30'),
(19, NULL, 19, '57197', 'MANDA ', 'D', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 64, 0, 0, 1, NULL, '19', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-30 10:40:08', '2025-08-30 10:40:08'),
(20, NULL, 20, '57198', 'SRINIVASA RAO', 'CHAVA', 'm', '9959430499', '', '', '', '', 0, 'HYDERABAD', '500072', 52, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-08-30 11:05:34', '2025-08-30 11:05:34'),
(21, NULL, 21, '19466', 'DURGA ', 'G', 'f', '8106079885', '', '', '', '', 0, 'HYDERABAD', '500072', 60, 0, 0, 1, NULL, '9', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-01 05:37:06', '2025-09-01 05:37:06'),
(22, NULL, 22, '057203', 'ARUNA KUMARI BAI ', 'S', 'f', '9110552962', '', '', '', '', 0, 'HYDERABAD', '500072', 52, 0, 0, 1, NULL, '7', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-01 07:07:12', '2025-09-01 07:07:12'),
(23, NULL, 23, '048881', 'LAXMI ', 'B', 'f', '9985394911', '', '', '', '', 0, 'HYDERABAD', '500072', 57, 0, 0, 1, NULL, '5', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-01 11:52:26', '2025-09-01 11:52:26'),
(24, NULL, 24, '057214', 'RAJESH ', 'SHERVIRALA', 'm', '9030645168', '', '', '', '', 0, 'HYDERABAD', '500072', 35, 0, 0, 1, NULL, '4', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-01 12:20:00', '2025-09-01 12:20:00'),
(25, NULL, 25, '57225', 'NAGAVANI ', 'CHANDOLU', 'f', '9492614736', '', '', '', '', 0, 'HYDERABAD', '500072', 51, 0, 0, 1, NULL, '13', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-02 05:31:24', '2025-09-02 05:31:24'),
(26, NULL, 26, '57224', 'CHANDANA ', 'K', 'f', '9963481063', '', '', '', '', 0, 'HYDERABAD', '500072', 47, 0, 0, 1, NULL, '5', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-02 05:59:05', '2025-09-02 05:59:05'),
(27, NULL, 27, '57226', 'RANI ', 'YALAVARTHY', 'f', '9491566977', '', '', '', '', 0, 'HYDERABAD', '500072', 54, 0, 0, 1, NULL, '5', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-02 06:22:28', '2025-09-02 06:22:28'),
(28, NULL, 28, '57228', 'VENKATA RAMANA', 'GANTENA', 'm', '9959511339', '', '', '', '', 0, 'HYDERABAD', '500072', 49, 0, 0, 1, NULL, '7', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-02 06:43:06', '2025-09-02 06:43:06'),
(29, NULL, 29, '29236', 'RAMASHARMA', 'A.V', 'm', '6303848498', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '20', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-02 08:36:34', '2025-09-02 08:36:34'),
(30, NULL, 30, '57029', 'NARESH KUMAR', 'CH', 'm', '9848593000', '', '', '', '', 0, 'HYDERABAD', '500072', 41, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-02 09:38:40', '2025-09-02 09:38:40'),
(31, NULL, 31, '57238', 'SATHAIAH ', 'G', 'm', '6303715044', '', '', '', '', 0, 'HYDERABAD', '500072', 74, 0, 0, 1, NULL, '17', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-02 13:05:51', '2025-09-02 13:05:51'),
(32, NULL, 32, '57239', 'RAJA SEKHAR ', 'TALPURI', 'm', '9885573943', '', '', '', '', 0, 'HYDERABAD', '500072', 47, 0, 0, 1, NULL, '3', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-03 05:09:03', '2025-09-03 05:09:03'),
(33, NULL, 33, '57241', 'SRIHITHA ', 'MOVVA ', 'f', '8712121314', '', '', '', '', 0, 'HYDERABAD', '500072', 30, 0, 0, 1, NULL, '3', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-03 05:43:41', '2025-09-03 05:43:41'),
(34, NULL, 34, '057221', 'RAJESH', 'K', 'm', '8885885221', '', '', '', '', 0, 'HYDERABAD', '500072', 31, 0, 0, 1, NULL, '7', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-03 12:36:07', '2025-09-03 12:36:07'),
(35, NULL, 35, '123456789123', 'Sazad2', 'Ahemad2', 'm', '7737914162', '', '', 'mail2sazad@gmail.com', 'Khordha', 19, 'Khordha', '752055', 25, 165, 70, 1, NULL, '2', 'rbs', 25, 0, 1, 'test', 1, 0, 14, 14, '2025-09-05 12:08:52', '2025-09-05 12:08:52'),
(36, NULL, 36, '057269', 'RAHEEM KHAN', 'MD', 'm', '9133278682', '', '', '', '', 0, 'HYDERABAD', '500072', 43, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 05:49:07', '2025-09-06 05:49:07'),
(37, NULL, 37, '031479', 'SWARAJYAM ', 'D', 'f', '9652968456', '', '', '', '', 0, 'HYDERABAD', '500072', 64, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 06:09:32', '2025-09-06 06:09:32'),
(38, NULL, 38, '57270', 'LIYAKHAT ', 'KHAN', 'm', '9908872786', '', '', '', '', 0, 'HYDERABAD', '500072', 45, 0, 0, 1, NULL, '3', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 06:25:52', '2025-09-06 06:25:52'),
(39, NULL, 39, '01130', 'KAVITHA ', 'S', 'f', '9704814441', '', '', '', '', 0, 'HYDERABAD', '500072', 39, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 06:50:01', '2025-09-06 06:50:01'),
(40, NULL, 40, '57275', 'SATYAVANI ', 'VARANASI', 'f', '9866735298', '', '', '', '', 0, 'HYDERABAD', '500072', 48, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 07:34:23', '2025-09-06 07:34:23'),
(41, NULL, 41, '57276', 'VENKATA SAIRAM', 'VARANASI', '', '9493835298', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-06 07:46:32', '2025-09-06 07:46:32'),
(42, NULL, 42, '57281', 'RAMAKRISHNA ', 'GADIPUDI', 'm', '998526911', '', '', '', '', 0, 'HYDERABAD', '500072', 50, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 08:22:27', '2025-09-06 08:22:27'),
(43, NULL, 43, '057278', 'YESUPADAM', 'P', 'm', '9392936461', '', '', '', '', 1, 'HYDERABAD', '500072', 56, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 09:19:16', '2025-09-06 09:19:16'),
(44, NULL, 44, '000001', 'J N', 'RAO', 'm', '9849093747', '', '', '', '', 1, 'HYDERABAD', '500072', 72, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 10:54:07', '2025-09-06 10:54:07'),
(45, NULL, 45, '069557', 'SAI SIVA RAM ', 'DANTU', 'm', '7730903034', '', '', '', '', 1, 'HYDERABAD', '500072', 50, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 11:25:54', '2025-09-06 11:25:54'),
(46, NULL, 46, '69568', 'SRINIVASA ', 'REDDY', 'm', ' 9848406316', '', '', '', '', 1, 'HYDERABAD', '500072', 59, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-06 12:03:46', '2025-09-06 12:03:46'),
(47, NULL, 47, '052362', 'SAMRAJYAM ', 'N', 'f', '6302373889', '', '', '', '', 0, 'HYDERABAD', '500072', 61, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-08 05:20:08', '2025-09-08 05:20:08'),
(48, NULL, 48, '057316', 'PRAVEENA GEETHA ', 'A.S', 'f', '8977255578', '', '', '', '', 0, 'HYDERABAD', '500072', 48, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-08 06:03:48', '2025-09-08 06:03:48'),
(49, NULL, 49, '054674', 'SUNITHA ', 'C', 'f', '9573146881', '', '', '', '', 0, 'HYDERABAD', '500072', 36, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-08 06:53:37', '2025-09-08 06:53:37'),
(50, NULL, 50, '18476', 'T MADHAVI', 'LATHA', 'f', '7075053183', '', '', '', '', 0, 'HYDERABAD', '500072', 50, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-08 07:38:25', '2025-09-08 07:38:25'),
(51, NULL, 51, '57323', 'SURYA LAKSHMI ', 'JANDHYALA', 'f', '7207338479', '', '', '', '', 0, 'HYDERABAD', '500072', 79, 0, 0, 1, NULL, '33', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-08 07:44:08', '2025-09-08 07:44:08'),
(52, NULL, 52, '098765', 'SUPRIYA', 'P', 'f', '987654321', '', '', '', '', 0, 'HYDERABAD', '500072', 25, 0, 0, 1, NULL, '7', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-08 09:31:38', '2025-09-08 09:31:38'),
(53, NULL, 53, '57333', 'SURYA RAJ', 'Y', 'm', '9494727444', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '15', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-08 12:30:08', '2025-09-08 12:30:08'),
(54, NULL, 54, '57327', 'SIVA', 'RAJASEKHAR M', 'm', '8125891034', '', '', '', '', 0, 'HYDERABAD', '500072', 34, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-08 13:37:17', '2025-09-08 13:37:17'),
(55, NULL, 55, '12599', 'AMMANI', 'P', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 70, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-09 05:20:39', '2025-09-09 05:20:39'),
(56, NULL, 56, '57341', 'RAMACHANDRA', 'REDDY', 'm', '7780708838', '', '', '', '', 0, 'HYDERABAD', '500072', 70, 0, 0, 1, NULL, '1', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-09 05:39:14', '2025-09-09 05:39:14'),
(57, NULL, 57, '57318', 'SRINIVASARAO', '.', 'm', '9871463627', '', '', '', '', 0, 'HYDERABAD', '500072', 37, 0, 0, 1, NULL, '13', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-09 06:02:50', '2025-09-09 06:02:50'),
(58, NULL, 58, '57348', 'JYOTI', 'A', 'f', '9866011152', '', '', '', '', 0, 'HYDERABAD', '500072', 48, 0, 0, 1, NULL, '1', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-09 11:01:05', '2025-09-09 11:01:05'),
(59, NULL, 59, '57358', 'VARALAKSHMI ', 'K', 'f', '998926509', '', '', '', '', 0, 'HYDERABAD', '500072', 50, 0, 0, 1, NULL, '20', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-10 07:26:25', '2025-09-10 07:26:25'),
(60, NULL, 60, '53959', 'SURESH', ' KUMAR  K', '', '9742843539', '', '', '', '', 0, 'HYDERABAD', '500072', 43, 0, 0, 1, NULL, '4', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-10 09:24:26', '2025-09-10 09:24:26'),
(61, NULL, 61, '20438', 'V VASU', 'VASU', 'm', '7799898888', '', '', '', '', 0, 'HYDERABAD', '500072', 45, 0, 0, 1, NULL, '8', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-11 06:21:30', '2025-09-11 06:21:30'),
(62, NULL, 62, '037969', 'SRINIVAS ', 'M', 'm', '8121178379', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-11 07:07:39', '2025-09-11 07:07:39'),
(63, NULL, 63, '026520', 'GUNDAPPA ', 'R', 'm', '9618676047', '', '', '', '', 0, 'HYDERABAD', '500072', 63, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-11 07:56:34', '2025-09-11 07:56:34'),
(64, NULL, 64, '057373', 'SUKANYA', 'M', 'f', '8500810028', '', '', '', '', 0, 'HYDERABAD', '500072', 31, 0, 0, 1, NULL, '9', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-11 08:31:09', '2025-09-11 08:31:09'),
(65, NULL, 65, '035937', 'SRILATHA ', 'M', 'f', '9849716427', '', '', '', '', 0, 'HYDERABAD', '500072', 53, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-11 12:39:22', '2025-09-11 12:39:22'),
(66, NULL, 66, '52569', 'SUBHASHINI', 'GADDAMI', 'f', '9885552950', '', '', '', '', 0, 'HYDERABAD', '500072', 61, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-12 06:12:49', '2025-09-12 06:12:49'),
(67, NULL, 67, '039107', 'RATAN ', 'RAJ B', 'm', '9866844302', '', '', '', '', 0, 'HYDERABAD', '500072', 67, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-12 06:34:03', '2025-09-12 06:34:03'),
(68, NULL, 68, '057393', 'S ', 'SATYAVATHI', 'f', '9441055888', '', '', '', '', 0, 'HYDERABAD', '500072', 77, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-12 06:53:30', '2025-09-12 06:53:30'),
(69, NULL, 69, '12278', 'SURYANARAYANA ', 'KUMAR S', 'm', '9441055888', '', '', '', '', 0, 'HYDERABAD', '500072', 78, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-12 07:09:04', '2025-09-12 07:09:04'),
(70, NULL, 70, '052568', 'SURENDER ', 'REDDY', 'm', '9885552950', '', '', '', '', 0, 'HYDERABAD', '500072', 65, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-12 07:50:54', '2025-09-12 07:50:54'),
(71, NULL, 71, '34385', 'SHARADA', 'G', 'f', '9490314196', '', '', '', '', 0, 'HYDERABAD', '500072', 58, 0, 0, 1, NULL, '3', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-12 08:05:23', '2025-09-12 08:05:23'),
(72, NULL, 72, '031067', 'RANGA ', 'LAKSHMI V', 'f', '9878282868', '', '', '', '', 0, 'HYDERABAD', '500072', 62, 0, 0, 1, NULL, '3', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-12 08:16:48', '2025-09-12 08:16:48'),
(73, NULL, 73, '057390', 'UMA MAHESHWARI ', 'K', 'f', '9441017928', '', '', '', '', 0, 'HYDERABAD', '500072', 56, 0, 0, 1, NULL, '20', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-12 10:35:49', '2025-09-12 10:35:49'),
(74, NULL, 74, '47149', 'CHANDRA MOULI ', 'P', 'm', '9160068860', '', '', '', '', 0, 'HYDERABAD', '500072', 36, 0, 0, 1, NULL, '2', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-13 05:09:09', '2025-09-13 05:09:09'),
(75, NULL, 75, '57409', 'VENKATESWARLU', 'PAVANI', 'm', '9000849488', '', '', '', '', 0, 'HYDERABAD', '500072', 63, 0, 0, 1, NULL, '20', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-13 06:33:31', '2025-09-13 06:33:31'),
(76, NULL, 76, '057406', 'SWAROOPA RANI', 'E.G', 'f', '9701381813', '', '', '', '', 0, 'HYDERABAD', '500072', 60, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-13 07:10:06', '2025-09-13 07:10:06'),
(77, NULL, 77, '57423', 'KANCHANAM ', 'MANI', 'f', '9985118559', '', '', '', '', 0, 'HYDERABAD', '500072', 62, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-13 07:38:13', '2025-09-13 07:38:13'),
(78, NULL, 78, '57248', 'VENKATESHWARA RAO', 'P', 'm', '9290099529', '', '', '', '', 0, 'HYDERABAD', '500072', 55, 0, 0, 1, NULL, '12', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-13 09:51:15', '2025-09-13 09:51:15'),
(79, NULL, 79, '57431', 'LAKSHMI', 'A.V', 'f', '9347462525', '', '', '', '', 0, 'HYDERABAD', '500072', 71, 0, 0, 1, NULL, '20', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-13 10:28:22', '2025-09-13 10:28:22'),
(80, NULL, 80, '57435', 'MANOHAR', 'A', 'm', '8985083055', '', '', '', '', 0, 'HYDERABAD', '500072', 33, 0, 0, 1, NULL, '0', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-13 11:35:20', '2025-09-13 11:35:20'),
(81, NULL, 81, '57452', 'BEULAH', 'KARUMURI', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 33, 0, 0, 1, NULL, '1', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-15 06:49:59', '2025-09-15 06:49:59'),
(82, NULL, 82, '48832', 'DHARMAVATHI', 'N', 'f', '9701608884', '', '', '', '', 0, 'HYDERABAD', '500072', 55, 0, 0, 1, NULL, '2', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-15 07:33:56', '2025-09-15 07:33:56'),
(83, NULL, 83, '57457', 'SHANKAR', 'D', 'm', '9000721153', '', '', '', '', 0, 'HYDERABAD', '500072', 41, 0, 0, 1, NULL, '11', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-15 09:54:26', '2025-09-15 09:54:26'),
(84, NULL, 84, '046183', 'PRAKASH ', 'T.K', 'm', '9705039039', '', '', '', '', 0, 'HYDERABAD', '500072', 52, 0, 0, 1, NULL, '2', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-15 12:37:49', '2025-09-15 12:37:49'),
(85, NULL, 85, '057465', 'SUSEELA ', 'G', 'f', '6300629295', '', '', '', '', 0, 'HYDERABAD', '500072', 32, 0, 0, 1, NULL, '5', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-16 05:22:18', '2025-09-16 05:22:18'),
(86, NULL, 86, '057408', 'PARVATHI ', 'KANDI', 'f', '9246696211', '', '', '', '', 0, 'HYDERABAD', '500072', 69, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-16 06:23:12', '2025-09-16 06:23:12'),
(87, NULL, 87, '57470', 'HEMA SUNDER ', 'RAO V', 'm', '7906414591', '', '', '', '', 0, 'HYDERABAD', '500072', 66, 0, 0, 1, NULL, '10', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-16 06:51:28', '2025-09-16 06:51:28'),
(88, NULL, 88, '057475', 'NAGAMANI ', 'B', 'f', '9949729116', '', '', '', '', 0, 'HYDERABAD', '500072', 53, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-16 10:53:32', '2025-09-16 10:53:32'),
(90, NULL, 89, '057478', 'VENKATAMMA ', 'NOWDASARI', 'f', '8919457268', '', '', '', '', 0, 'HYDERABAD', '500072', 60, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-17 05:23:46', '2025-09-17 05:23:46'),
(91, NULL, 90, '046326', 'SUNIL ', 'KUMAR U', 'm', '7330875792', '', '', '', '', 0, 'HYDERABAD', '500072', 48, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-17 05:44:00', '2025-09-17 05:44:00'),
(92, NULL, 91, '057484', 'SWAPNA KUMARI', 'S', 'f', '733087579', '', '', '', '', 0, 'HYDERABAD', '500072', 43, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-17 06:09:53', '2025-09-17 06:09:53'),
(93, NULL, 92, '036741', 'NAGAMMA ', 'P', 'f', '9618624027', '', '', '', '', 0, 'HYDERABAD', '500072', 51, 0, 0, 1, NULL, '8', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-17 06:37:01', '2025-09-17 06:37:01'),
(94, NULL, 93, '45314', 'SUDHA RANI', 'VELAGA', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 34, 0, 0, 1, NULL, '2', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-17 07:08:44', '2025-09-17 07:08:44'),
(95, NULL, 94, '051654', 'ANKNNA ', 'KASARLA', 'm', '9866502581', '', '', '', '', 0, 'HYDERABAD', '500072', 60, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-17 08:20:57', '2025-09-17 08:20:57'),
(96, NULL, 95, '057493', 'GIRIDHAR ', 'J', 'm', '9533434600', '', '', '', '', 0, 'HYDERABAD', '500072', 72, 0, 0, 1, NULL, '30', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-17 12:18:34', '2025-09-17 12:18:34'),
(97, NULL, 96, '27407', 'MOHAN ', 'RAO D', 'm', '9908196393', '', '', '', '', 0, 'HYDERABAD', '500072', 45, 0, 0, 1, NULL, '7', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-18 05:34:26', '2025-09-18 05:34:26'),
(98, NULL, 97, '031392', 'SATYANARAYANA ', 'A', 'm', '9440311029', '', '', '', '', 0, 'HYDERABAD', '500072', 60, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-18 10:23:50', '2025-09-18 10:23:50'),
(99, NULL, 98, '57510', 'ARUN TEJA ', 'CH', 'm', '7981145412', '', '', '', '', 0, 'HYDERABAD', '500072', 35, 0, 0, 1, NULL, '2', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-19 05:20:29', '2025-09-19 05:20:29'),
(100, NULL, 99, '57514', 'ANANTHA RATNA MANI ', 'VEERA ', 'f', '9866919922', '', '', '', '', 0, 'HYDERABAD', '500072', 51, 0, 0, 1, NULL, '5', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-19 06:29:13', '2025-09-19 06:29:13'),
(101, NULL, 100, '57513', 'VIJAYA LAKSHMI ', 'M', 'f', '9989156741', '', '', '', '', 0, 'HYDERABAD', '500072', 66, 0, 0, 1, NULL, '14', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-19 06:45:45', '2025-09-19 06:45:45'),
(102, NULL, 101, '37954', 'MALLIKARJUN RAO', 'K', 'm', '9701118396', '', '', '', '', 0, 'HYDERABAD', '500072', 42, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-19 07:06:06', '2025-09-19 07:06:06'),
(103, NULL, 102, '57522', 'MADHU', '.', 'm', '9394777177', '', '', '', '', 0, 'HYDERABAD', '500072', 43, 0, 0, 1, NULL, '12', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-19 13:17:07', '2025-09-19 13:17:07'),
(104, NULL, 103, '01672', 'P.', 'NARESH', 'm', '9573045703', '', '', '', '', 0, 'HYDERABAD', '500072', 44, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-20 05:19:40', '2025-09-20 05:19:40'),
(105, NULL, 104, '57523', 'HARIKA ', 'ADIMULAM', 'f', '9550330075', '', '', '', '', 0, 'HYDERABAD', '500072', 31, 0, 0, 1, NULL, '4', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-20 05:37:14', '2025-09-20 05:37:14'),
(106, NULL, 105, '057525', 'VENKATA RAMANA ', 'MURTHY P', 'm', '8341230007', '', '', '', '', 0, 'HYDERABAD', '500072', 56, 0, 0, 1, NULL, '17', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-20 06:48:41', '2025-09-20 06:48:41'),
(107, NULL, 106, '057531', 'SIKANDAR', '.', 'm', '9030064982', '', '', '', '', 0, 'HYDERABAD', '500072', 45, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-20 07:33:24', '2025-09-20 07:33:24'),
(108, NULL, 107, '57257', 'SARASWATHI', 'GUNTURU', 'f', '9666266649', '', '', '', '', 0, 'HYDERABAD', '500072', 49, 0, 0, 1, NULL, '1', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-20 08:18:20', '2025-09-20 08:18:20'),
(109, NULL, 108, '057528', 'AHALYA ', 'MACHARLA', 'f', '8884117833', '', '', '', '', 0, 'HYDERABAD', '500072', 65, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-20 09:07:17', '2025-09-20 09:07:17'),
(110, NULL, 109, '046602', 'ANJALI ', 'M', 'f', '9849057615', '', '', '', '', 0, 'HYDERABAD', '500072', 42, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-22 05:41:46', '2025-09-22 05:41:46'),
(111, NULL, 110, '057556', 'RAJU ', 'S', 'm', '8008387975', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '7', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-22 06:07:38', '2025-09-22 06:07:38'),
(112, NULL, 111, '057562', 'SRINIVAS ', 'REDDY V', 'm', '8367630365', '', '', '', '', 0, 'HYDERABAD', '500072', 58, 0, 0, 1, NULL, '12', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-22 08:45:35', '2025-09-22 08:45:35'),
(113, NULL, 112, '57572', 'VICTORIA', 'R', 'f', '9133173553', '', '', '', '', 0, 'HYDERABAD', '500072', 43, 0, 0, 1, NULL, '2', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-23 06:01:23', '2025-09-23 06:01:23'),
(114, NULL, 113, '50479', 'BHASKARA RAJU HAMPI', 'K', 'm', '9866010675', '', '', '', '', 0, 'HYDERABAD', '500072', 71, 0, 0, 1, NULL, '5', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-23 06:51:30', '2025-09-23 06:51:30'),
(115, NULL, 114, '57571', 'RAMESH', 'R', 'm', '9133173553', '', '', '', '', 0, 'HYDERABAD', '500072', 44, 0, 0, 1, NULL, '5', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-23 07:36:33', '2025-09-23 07:36:33'),
(116, NULL, 115, '26467', 'SRINIVAS', 'B', 'm', '9885652593', '', '', '', '', 0, 'HYDERABAD', '500072', 50, 0, 0, 1, NULL, '6', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-23 07:47:24', '2025-09-23 07:47:24'),
(117, NULL, 116, '057588', 'ASHOK REDDY ', 'DEVI REDDY', 'm', '9100877745', '', '', '', '', 0, 'HYDERABAD', '500072', 32, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-24 06:30:59', '2025-09-24 06:30:59'),
(118, NULL, 117, '032552', 'RAMBABU', 'P', 'm', '9052762407', '', '', '', '', 0, 'HYDERABAD', '500072', 41, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-24 08:06:17', '2025-09-24 08:06:17'),
(119, NULL, 118, '06615', 'MANMADA RAO', 'N', 'm', '9912314412', '', '', '', '', 0, 'HYDERABAD', '500072', 58, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-24 08:42:45', '2025-09-24 08:42:45'),
(120, NULL, 119, '057594', 'SHANKAR ', 'K', 'm', '7386669491', '', '', '', '', 0, 'HYDERABAD', '500072', 39, 0, 0, 1, NULL, '3', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-24 09:22:03', '2025-09-24 09:22:03'),
(121, NULL, 120, '057548', 'NAGA ', 'JYOTHI Y', 'f', '9502783032', '', '', '', '', 0, 'HYDERABAD', '500072', 57, 0, 0, 1, NULL, '15', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-24 09:49:53', '2025-09-24 09:49:53'),
(122, NULL, 121, '032715', 'KALAVATI', 'R', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 57, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-25 05:31:06', '2025-09-25 05:31:06'),
(123, NULL, 122, '4', 'PADMAVATHI', 'M', 'f', '7995522636', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '1', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-25 05:55:53', '2025-09-25 05:55:53'),
(124, NULL, 123, '056945', 'J', 'Y', 'f', '987654321', '', '', '', '', 0, 'HYDERABAD', '500072', 30, 0, 0, 1, NULL, '1', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-25 06:35:34', '2025-09-25 06:35:34'),
(125, NULL, 124, '09876', 'J', 'Y', 'f', '9441055888', '', '', '', '', 0, 'HYDERABAD', '500072', 45, 0, 0, 1, NULL, '2', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-25 07:00:03', '2025-09-25 07:00:03'),
(126, NULL, 125, '026135', 'PRATHIBHA ', 'B', 'f', '9493174751', '', '', '', '', 0, 'HYDERABAD', '500072', 40, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-26 05:21:53', '2025-09-26 05:21:53'),
(127, NULL, 126, '057600', 'MANOJ KUMAR', 'R', 'm', '7013944309', '', '', '', '', 0, 'HYDERABAD', '500072', 30, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-26 08:18:19', '2025-09-26 08:18:19'),
(128, NULL, 127, '055410', 'RAMULU ', 'P', 'm', '9912304146', '', '', '', '', 0, 'HYDERABAD', '500072', 54, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-26 10:04:48', '2025-09-26 10:04:48'),
(129, NULL, 128, '057582', 'VENKATESH ', 'GUPTA', 'm', '9993328639', '', '', '', '', 0, 'HYDERABAD', '500072', 62, 0, 0, 1, NULL, '15', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-26 10:32:02', '2025-09-26 10:32:02'),
(130, NULL, 129, '036461', 'ESWARA RAO', 'GEDELA', 'm', '8309470618', '', '', '', '', 0, 'HYDERABAD', '500072', 53, 0, 0, 1, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-26 10:57:56', '2025-09-26 10:57:56'),
(131, NULL, 130, '057601', 'SUNIL KUMAR', 'L', 'm', '7815858076', '', '', '', '', 0, 'HYDERABAD', '500072', 45, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-26 11:16:44', '2025-09-26 11:16:44'),
(132, NULL, 131, '057603', 'PRAMEELA ', 'K', 'f', '9440688656', '', '', '', '', 0, 'HYDERABAD', '500072', 58, 0, 0, 1, NULL, '7', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-26 13:05:10', '2025-09-26 13:05:10'),
(133, NULL, 132, '057608', 'PAL PRASAD ', 'DANDALA', 'm', '7396289130', '', '', '', '', 0, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '10', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-27 06:24:29', '2025-09-27 06:24:29'),
(134, NULL, 133, '038269', 'PRASHANTH ', 'B', 'm', '9618842797', '', '', '', '', 0, 'HYDERABAD', '500072', 44, 0, 0, 1, NULL, '2', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-27 10:47:47', '2025-09-27 10:47:47'),
(135, NULL, 134, '057620', 'RAJESWARI ', 'B', 'f', '8639087449', '', '', '', '', 0, 'HYDERABAD', '500072', 58, 0, 0, 1, NULL, '6', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-27 12:26:27', '2025-09-27 12:26:27'),
(136, NULL, 135, '35707', 'SUNITHA RANI ', 'T', 'f', '9000351567', '', '', '', '', 0, 'HYDERABAD', '500072', 40, 0, 0, 1, NULL, '9', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-29 07:01:24', '2025-09-29 07:01:24'),
(137, NULL, 136, '57637', 'VENKATESWARA REDDY ', 'M', 'm', '6305935132', '', '', '', '', 0, 'HYDERABAD', '500072', 44, 0, 0, 1, NULL, '12', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-29 07:19:12', '2025-09-29 07:19:12'),
(138, NULL, 137, '57642', 'ESWAR RAO', 'N', 'm', '9490042025', '', '', '', '', 0, 'HYDERABAD', '500072', 58, 0, 0, 1, NULL, '8', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-09-29 08:21:02', '2025-09-29 08:21:02'),
(139, NULL, 138, '57641', 'RAJENDRA PRASAD', 'RATH', 'm', '9437217825', '', '', '', '', 0, 'HYDERABAD', '500072', 64, 0, 0, 1, NULL, '20', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-29 09:13:55', '2025-09-29 09:13:55'),
(140, NULL, 139, '46204', 'bala kumar', ' kumar', 'm', '9494627937', '', '', '', '', 1, 'HYDERABAD', '500072', 53, 0, 0, 1, NULL, '3', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-30 05:48:25', '2025-09-30 05:48:25'),
(141, NULL, 140, '45181', 'PRABHAKAR ', 'NAIDU', 'm', '7601078448', '', '', '', '', 1, 'HYDERABAD', '500072', 0, 0, 0, 1, NULL, '15', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-30 06:12:18', '2025-09-30 06:12:18'),
(142, NULL, 141, '057651', 'VENKATA RAMI REDDY', 'REDDY', 'm', '9652989758', '', '', '', '', 1, 'HYDERABAD', '500072', 0, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-30 07:24:14', '2025-09-30 07:24:14'),
(143, NULL, 142, '057652', 'NAGESWARA ', 'RAO', 'm', '9966580178', '', '', '', '', 1, 'HYDERABAD', '500072', 68, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-09-30 07:56:57', '2025-09-30 07:56:57'),
(144, NULL, 143, '057655', 'MARTHA ', 'G', 'f', '9985779963', '', '', '', '', 0, 'HYDERABAD', '500072', 55, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-01 05:15:05', '2025-10-01 05:15:05'),
(145, NULL, 144, '041268', 'ANIL KUMAR ', 'BALLA', 'm', '9666555764', '', '', '', '', 0, 'HYDERABAD', '500072', 37, 0, 0, 1, NULL, '3', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-01 05:36:38', '2025-10-01 05:36:38'),
(146, NULL, 145, '057659', 'BHANU ', 'MURTHY G', 'f', '9866666632', '', '', '', '', 0, 'HYDERABAD', '500072', 67, 0, 0, 1, NULL, '30', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-10-01 06:42:54', '2025-10-01 06:42:54'),
(147, NULL, 146, '057658', 'SUJATHA ', 'N', 'f', '8712574472', '', '', '', '', 0, 'HYDERABAD', '500072', 55, 0, 0, 1, NULL, '1', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-01 07:12:36', '2025-10-01 07:12:36'),
(148, NULL, 147, '057663', 'UDA ', 'KIRAN', 'm', '6382397756', '', '', '', '', 0, 'HYDERABAD', '500072', 43, 0, 0, 1, NULL, '2', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-01 10:08:41', '2025-10-01 10:08:41'),
(149, NULL, 148, '057667', 'TEENA ', 'KUMARI P', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 43, 0, 0, 1, NULL, '10', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-01 10:41:19', '2025-10-01 10:41:19'),
(150, NULL, 149, '057671', 'RAMESH', 'A', 'm', '9948597610', '', '', '', '', 0, 'HYDERABAD', '500072', 62, 0, 0, 1, NULL, '10', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-01 12:15:07', '2025-10-01 12:15:07'),
(151, NULL, 150, '057682', 'VENKATA', 'REDDY M', 'm', '9440213757', '', '', '', '', 0, 'HYDERABAD', '500072', 48, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-03 06:11:12', '2025-10-03 06:11:12'),
(152, NULL, 151, '057685', 'NAGAVENI ', 'B', 'f', '9886995455', '', '', '', '', 0, 'HYDERABAD', '500072', 53, 0, 0, 1, NULL, '3', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-03 06:41:52', '2025-10-03 06:41:52'),
(153, NULL, 152, '057687', 'GEETA ', 'DEVI ', 'f', '6300896844', '', '', '', '', 0, 'HYDERABAD', '500072', 57, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-03 09:50:03', '2025-10-03 09:50:03'),
(154, NULL, 153, '053587', 'RAMANA KUMAR', 'M', 'm', '9491391711', '', '', '', '', 0, 'HYDERABAD', '500072', 54, 0, 0, 1, NULL, '10', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 06:04:51', '2025-10-04 06:04:51'),
(155, NULL, 154, '057700', 'SUNITHA ', 'PATLI', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 54, 0, 0, 0, NULL, '', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-10-04 06:29:07', '2025-10-04 06:29:07'),
(156, NULL, 155, '057148', 'NAYEEM BIN ', 'SALAM', 'm', '9542036179', '', '', '', '', 0, 'HYDERABAD', '500072', 53, 0, 0, 1, NULL, '2', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 07:26:09', '2025-10-04 07:26:09'),
(157, NULL, 156, '057697', 'SYED KHALEEL UR', 'RAHMAN', 'm', '8179534488', '', '', '', '', 0, 'HYDERABAD', '500072', 75, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 07:55:28', '2025-10-04 07:55:28'),
(158, NULL, 157, '057698', 'ISMATH ', 'UNNISA', 'f', '9398042794', '', '', '', '', 0, 'HYDERABAD', '500072', 63, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 08:15:08', '2025-10-04 08:15:08'),
(159, NULL, 158, '034333', 'JOY ', 'V', 'f', '7702778984', '', '', '', '', 0, 'HYDERABAD', '500072', 53, 0, 0, 1, NULL, '7', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 08:19:55', '2025-10-04 08:19:55'),
(160, NULL, 159, '057706', 'MAHESH KUMAR', 'J', 'm', '7032352972', '', '', '', '', 0, 'HYDERABAD', '500072', 49, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 08:36:57', '2025-10-04 08:36:57'),
(161, NULL, 160, '035097', 'SULOCHANA ', 'S', 'f', '9652856127', '', '', '', '', 0, 'HYDERABAD', '500072', 58, 0, 0, 1, NULL, '7', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 09:55:54', '2025-10-04 09:55:54'),
(162, NULL, 161, '057705', 'DEVI', 'G', 'f', '9493596191', '', '', '', '', 0, 'HYDERABAD', '500072', 32, 0, 0, 1, NULL, '3', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 10:11:01', '2025-10-04 10:11:01'),
(163, NULL, 162, '051285', 'RAVI KUMAR', 'B.K.R', 'm', '8977535177', '', '', '', '', 0, 'HYDERABAD', '500072', 49, 0, 0, 1, NULL, '15', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 10:56:52', '2025-10-04 10:56:52'),
(164, NULL, 163, '057712', 'BHARATHI ', 'Y', 'f', '9949032017', '', '', '', '', 0, 'HYDERABAD', '500072', 54, 0, 0, 1, NULL, '7', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 11:18:01', '2025-10-04 11:18:01'),
(165, NULL, 164, '022191', 'P.', 'DEVAKAMMA ', 'f', '', '', '', '', '', 0, 'HYDERABAD', '500072', 73, 0, 0, 1, NULL, '', '', 0, 0, 1, '', 1, 0, 25, 25, '2025-10-04 12:56:46', '2025-10-04 12:56:46'),
(166, NULL, 165, '57727', 'AJAY ROHIT', 'PALA', 'm', '9121688977', '', '', '', '', 0, 'HYDERABAD', '500072', 32, 0, 0, 1, NULL, '2', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-10-06 06:14:46', '2025-10-06 06:14:46'),
(167, NULL, 166, '57730', 'LINGA RAJU', 'CH', 'm', '9151414191', '', '', '', '', 0, 'HYDERABAD', '500072', 42, 0, 0, 1, NULL, '3', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-10-06 07:43:40', '2025-10-06 07:43:40'),
(168, NULL, 167, '36057', 'RAJESWARI', 'P', 'f', '7893579799', '', '', '', '', 0, 'HYDERABAD', '500072', 41, 0, 0, 1, NULL, '6', '', 0, 0, 0, '', 1, 0, 25, 25, '2025-10-06 08:11:38', '2025-10-06 08:11:38');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `slug` varchar(60) NOT NULL,
  `description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `slug`, `description`) VALUES
(1, 'User Groups', 'user_group:create', 'This permissions lets User create User Group.'),
(2, 'User Groups', 'user_group:update', 'This permissions lets User update User Group & their permissions.'),
(3, 'User Groups', 'user_group:delete', 'This permissions lets User delete User Groups.'),
(4, 'Treatment Sites', 'treatment_site:create', 'This permissions lets User create Treatment Sites.'),
(5, 'Treatment Sites', 'treatment_site:update', 'This permissions lets User update Treatment Sites.'),
(6, 'Treatment Sites', 'treatment_site:delete', 'This permissions lets User delete Treatment Sites.'),
(7, 'Web Pages', 'pages:create', 'This permissions lets User create Web Pages for the website.'),
(8, 'Web Pages', 'pages:update', 'This permissions lets User update Web Pages for the website.'),
(9, 'Web Pages', 'pages:delete', 'This permissions lets User delete unwanted Web Pages for the website.'),
(10, 'Web Menus', 'menus:create', 'This permissions lets User create Web Menus for the website.'),
(11, 'Web Menus', 'menus:update', 'This permissions lets User update Web Menus for the website.'),
(12, 'Web Menus', 'menus:delete', 'This permissions lets User delete unwanted Web Menus for the website.'),
(13, 'User Groups', 'user_group:view', 'This permissions lets User view User Groups.'),
(14, 'Treatment Sites', 'treatment_site:view', 'This permissions lets User view Treatment Sites.'),
(15, 'Web Pages', 'pages:view', 'This permissions lets User view Web Pages in the website.'),
(16, 'Web Menus', 'menus:view', 'This permissions lets User View Web Menus in the website.'),
(17, 'Admin Logs', 'logs:view', 'This permission lets User View Admin Logs.'),
(18, 'Users', 'user:create', 'This permissions lets User create other Users.'),
(19, 'Users', 'user:update', 'This permissions lets User update other Users.'),
(20, 'Users', 'user:delete', 'This permissions lets User delete other Users.'),
(21, 'Users', 'user:view', 'This permissions lets User view other Users.'),
(22, 'User Designations', 'user_designation:create', 'This permissions lets User create User Designation.'),
(23, 'User Designations', 'user_designation:update', 'This permissions lets User update User Designation.'),
(24, 'User Designations', 'user_designation:delete', 'This permissions lets User delete User Designations.'),
(25, 'User Designations', 'user_designation:view', 'This permissions lets User view other Designations.'),
(26, 'Patients', 'patient:create', 'This permissions lets User create Patients.'),
(27, 'Patients', 'patient:update', 'This permissions lets User update Patients.'),
(28, 'Patients', 'patient:delete', 'This permissions lets User delete Patients.'),
(29, 'Patients', 'patient:view', 'This permissions lets User view other Patients.'),
(30, 'Consultations', 'consultation:create', 'This permissions lets User create Consultations.'),
(31, 'Consultations', 'consultation:update', 'This permissions lets User update Consultations.'),
(32, 'Consultations', 'consultation:delete', 'This permissions lets User delete Consultations.'),
(33, 'Consultations', 'consultation:view', 'This permissions lets User view other Consultations.'),
(34, 'Product Categories', 'product_category:create', 'This permissions lets User create Product Categories.'),
(35, 'Product Categories', 'product_category:update', 'This permissions lets User update Product Categories.'),
(36, 'Product Categories', 'product_category:delete', 'This permissions lets User delete Product Categories.'),
(37, 'Product Categories', 'product_category:view', 'This permissions lets User view Product Categories.'),
(38, 'Products', 'product:create', 'This permissions lets User create Products.'),
(39, 'Products', 'product:update', 'This permissions lets User update Products.'),
(40, 'Products', 'product:delete', 'This permissions lets User delete Products.'),
(41, 'Products', 'product:view', 'This permissions lets User view Products.'),
(42, 'Inventory', 'inventory:update', 'This permissions lets User update Inventory.'),
(43, 'Inventory', 'inventory:view', 'This permissions lets User view Inventory.'),
(44, 'Sales', 'sale:create', 'This permissions lets User create Sales.'),
(45, 'Sales', 'sale:update', 'This permissions lets User update Sales.'),
(46, 'Sales', 'sale:delete', 'This permissions lets User delete Sales.'),
(47, 'Sales', 'sale:view', 'This permissions lets User view Sales.'),
(48, 'Support', 'support:create', 'This permissions lets User create Support Tickets.'),
(49, 'Support', 'support:update', 'This permissions lets User update Support Tickets.'),
(50, 'Support', 'support:delete', 'This permissions lets User delete Support Tickets.'),
(51, 'Support', 'support:view', 'This permissions lets User view Support Tickets.'),
(53, 'SEO Maker', 'seo_maker_settings:update', 'This permissions lets User update SEO Maker Settings.'),
(55, 'SEO Maker', 'seo_maker_settings:view', 'This permissions lets User view SEO Maker Settings.'),
(56, 'Application Settings', 'app_settings:update', 'This permissions lets User update Application Settings.'),
(57, 'Application Settings', 'app_settings:view', 'This permissions lets User view Application Settings.'),
(58, 'Invoices', 'invoice:create', 'This permissions lets User create new Invoices.'),
(59, 'Invoices', 'invoice:update', 'This permissions lets User update Invoices.'),
(60, 'Invoices', 'invoice:delete', 'This permissions lets User delete Invoices.'),
(61, 'Invoices', 'invoice:view', 'This permissions lets User view Invoices.'),
(62, 'Address States', 'address_state:create', 'This permissions lets User create new Address State.'),
(63, 'Address States', 'address_state:update', 'This permissions lets User update Address States.'),
(64, 'Address States', 'address_state:view', 'This permissions lets User view Address States.'),
(65, 'Services', 'service:create', 'Create services.'),
(66, 'Services', 'service:update', 'Update and activate services.'),
(67, 'Services', 'service:delete', 'Soft delete and restore services.'),
(68, 'Services', 'service:view', 'View services.');

-- --------------------------------------------------------

--
-- Table structure for table `prior_issues`
--

CREATE TABLE `prior_issues` (
  `id` int(11) NOT NULL,
  `issue_name` varchar(50) NOT NULL,
  `issue_slug` varchar(50) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active	',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prior_issues`
--

INSERT INTO `prior_issues` (`id`, `issue_name`, `issue_slug`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Diabetic', 'diabetic', 1, 0, 13, 13, '2025-07-25 20:28:53', '2025-07-25 20:29:16'),
(2, 'Lower Back Pain', 'lower_back_pain', 1, 0, 13, 13, '2025-07-25 20:28:53', '2025-07-25 20:29:22'),
(3, 'Knee Pain', 'knee_pain', 1, 0, 13, 13, '2025-07-25 20:28:53', '2025-07-25 20:29:22'),
(4, 'Numbness', 'numbness', 1, 0, 13, 13, '2025-07-25 20:28:53', '2025-07-25 20:29:16'),
(5, 'Heel Pain', 'heel_pain', 1, 0, 13, 13, '2025-07-25 20:28:53', '2025-07-25 20:29:22'),
(6, 'Ankle Pain', 'ankle_pain', 1, 0, 13, 13, '2025-07-25 20:28:53', '2025-07-25 20:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `product_color` varchar(15) NOT NULL,
  `product_images` varchar(250) DEFAULT NULL,
  `type` int(2) NOT NULL COMMENT '0=women,1=men,2=orthotics,3=custom',
  `details` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`details`)),
  `technology` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`technology`)),
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `pathology` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`pathology`)),
  `price` float NOT NULL,
  `discounted_price` float NOT NULL,
  `tax1_percent` float NOT NULL DEFAULT 0 COMMENT 'cgst',
  `tax2_percent` float NOT NULL DEFAULT 0 COMMENT 'sgst',
  `igst_percent` float NOT NULL DEFAULT 0,
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active	',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `product_name`, `slug`, `product_color`, `product_images`, `type`, `details`, `technology`, `features`, `pathology`, `price`, `discounted_price`, `tax1_percent`, `tax2_percent`, `igst_percent`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Test Product', 'test-product', 'black', '[\"202508230142_2358.webp\",\"202508230142_9355.webp\",\"202508230142_4040.webp\",\"202508230142_6010.webp\"]', 1, '{\"Upper Material\":\"Genuine Leather\"}', '{\"Seam ProTec\":\"Seam ProTec\"}', '{\"Tor Volume\":\" High Toe Box\"}', '{\"Toe Clawing\":\"Toes bend into a claw shape, often due to nerve damage or muscle imbalance.\"}', 200, 150, 6, 6, 12, 'test', 1, 0, 13, 1, '2025-08-22 20:12:45', '2025-10-11 08:20:42'),
(2, 1, 'Product 2', 'product-2', 'blue', '[\"202508230146_2085.webp\",\"202508230146_1860.webp\",\"202508230146_6041.webp\",\"202508230146_7573.webp\"]', 2, '{\"Upper Material\":\"Genuine Leather\"}', '{\"Seam ProTec\":\"Seam ProTec\"}', '{\"Tor Volume\":\"High Toe Box\"}', '{\"Toe Clawing\":\"Toes bend into a claw shape, often due to nerve damage or muscle imbalance.\"}', 2000, 1769, 12, 12, 24, 'teswt 2', 1, 0, 13, 13, '2025-08-22 20:16:56', '2025-10-10 03:44:46'),
(3, 3, 'Test Product Sandle', 'test-product-sandle', 'blue', '[\"202509250750_8417.webp\",\"\",\"\",\"\"]', 1, '{\"Upper Material\":\"Genuine Leather\"}', '{\"Seam ProTec\":\"Seam ProTec\"}', '{\" Tor Volume\":\"High Toe Box\"}', '{\"Toe Clawing\":\"Toes bend into a claw shape, often due to nerve damage or muscle imbalance.\"}', 200, 150, 2.5, 2.5, 5, 'test', 1, 0, 13, 13, '2025-09-25 02:20:38', '2025-10-10 03:44:48'),
(4, 4, 'Shoes ABC', 'shoes-abc', 'yellow', '[\"202509250931_5272.webp\",\"202509250931_7009.webp\",\"202509250931_7288.webp\",\"\"]', 1, '{\"Upper Material\":\"Genuine Leather\"}', '{\"Seam ProTec\":\"Seam ProTec\"}', '{\" Tor Volume\":\"High Toe Box\"}', '{\"Toe Clawing\":\"Toes bend into a claw shape, often due to nerve damage or muscle imbalance.\"}', 250, 219, 2.5, 2.5, 5, 'test shoes product', 1, 0, 13, 13, '2025-09-25 04:01:42', '2025-10-10 03:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

CREATE TABLE `product_categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `slug` varchar(50) NOT NULL,
  `category_image` mediumtext DEFAULT NULL,
  `color_code` varchar(10) DEFAULT NULL COMMENT '#566B30',
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active	',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `category_name`, `slug`, `category_image`, `color_code`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Test', 'test', '', '#000000', 'test', 1, 0, 13, 13, '2025-08-22 20:09:51', '2025-08-22 20:09:51'),
(2, 'INSOLES', 'insoles', '', '#000000', '', 1, 0, 13, 13, '2025-09-23 05:21:07', '2025-09-23 05:21:07'),
(3, 'Sandles', 'sandles', '202509250749_9350.webp', '#000000', 'test', 1, 0, 13, 13, '2025-09-25 02:19:50', '2025-09-25 02:19:50'),
(4, 'Test Category', 'test-category', '202509250930_6390.webp', '#aba6a6', 'Shoes Test', 1, 0, 13, 13, '2025-09-25 04:00:13', '2025-09-25 04:00:13');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `saleid` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `patient_id` int(11) NOT NULL,
  `site_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `consultation_id` int(11) DEFAULT NULL,
  `is_purchased_online` int(2) NOT NULL DEFAULT 0 COMMENT '0=no,1=yes',
  `total_amount` float NOT NULL,
  `adjustment` float NOT NULL DEFAULT 0,
  `grand_total` float NOT NULL,
  `is_consent_done` int(2) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `consent_file` mediumtext NOT NULL,
  `is_sale_finalized` int(2) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `sale_file` mediumtext NOT NULL COMMENT 'invoice_file',
  `is_active` int(11) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active	',
  `is_deleted` int(11) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `remarks` varchar(200) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `saleid`, `date`, `patient_id`, `site_id`, `user_id`, `consultation_id`, `is_purchased_online`, `total_amount`, `adjustment`, `grand_total`, `is_consent_done`, `consent_file`, `is_sale_finalized`, `sale_file`, `is_active`, `is_deleted`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, '2025-08-23', 1, 36, 14, 1, 0, 7405.68, 0.32, 7406, 1, '20250823014955_CF.pdf', 1, '20250823015013_SI-001.pdf', 1, 0, 'test', 14, 14, '2025-08-22 20:19:43', '2025-10-08 04:06:28'),
(2, 2, '2025-09-25', 1, 36, 14, 0, 0, 1479.75, 0.25, 1480, 1, '20250925100327_CF.pdf', 1, '20250925100600_SI-002.pdf', 1, 0, '', 14, 14, '2025-09-25 04:32:52', '2025-09-25 04:36:01');

-- --------------------------------------------------------

--
-- Table structure for table `sales_items`
--

CREATE TABLE `sales_items` (
  `id` int(11) NOT NULL,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `tax` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales_items`
--

INSERT INTO `sales_items` (`id`, `sale_id`, `product_id`, `quantity`, `rate`, `tax`, `amount`, `created_at`, `updated_at`) VALUES
(3, 1, 1, 5, 150, '5,5', 825, '2025-08-22 20:20:13', '2025-08-22 20:20:13'),
(4, 1, 2, 3, 1769, '12,12', 6580.68, '2025-08-22 20:20:13', '2025-08-22 20:20:13'),
(7, 2, 4, 5, 219, '2.5,2.5', 1149.75, '2025-09-25 04:36:00', '2025-09-25 04:36:00'),
(8, 2, 1, 2, 150, '5,5', 330, '2025-09-25 04:36:00', '2025-09-25 04:36:00');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `service_code` varchar(30) NOT NULL,
  `service_name` varchar(120) NOT NULL,
  `description` text DEFAULT NULL,
  `sac_code` varchar(20) DEFAULT NULL,
  `billing_cycle` enum('one_time','monthly','quarterly','yearly','custom') NOT NULL DEFAULT 'one_time',
  `default_rate` decimal(12,2) NOT NULL DEFAULT 0.00,
  `cgst` decimal(6,3) NOT NULL DEFAULT 0.000,
  `sgst` decimal(6,3) NOT NULL DEFAULT 0.000,
  `igst` decimal(6,3) NOT NULL DEFAULT 0.000,
  `default_site_id` int(11) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_code`, `service_name`, `description`, `sac_code`, `billing_cycle`, `default_rate`, `cgst`, `sgst`, `igst`, `default_site_id`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'SC001', 'service', 'test', 'sdvdfsbv', 'monthly', 500.00, 0.000, 9.000, 9.000, 37, 'tets', 1, 0, 13, 13, '2026-07-18 21:25:51', '2026-07-18 21:26:15');

-- --------------------------------------------------------

--
-- Table structure for table `sites`
--

CREATE TABLE `sites` (
  `id` int(11) NOT NULL,
  `site_id` varchar(12) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_logo` mediumtext DEFAULT NULL,
  `ref_person_name` varchar(50) DEFAULT NULL,
  `ref_person_details` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `address_state` int(11) NOT NULL,
  `address_city` varchar(50) NOT NULL,
  `address_pin` char(6) NOT NULL,
  `color_code` varchar(10) NOT NULL DEFAULT '#566B30',
  `remarks` varchar(200) DEFAULT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sites`
--

INSERT INTO `sites` (`id`, `site_id`, `site_name`, `site_logo`, `ref_person_name`, `ref_person_details`, `address`, `address_state`, `address_city`, `address_pin`, `color_code`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(34, 'SC-OD-ODI-04', 'StepCure Odisha 1', '202508230036_3747.webp', 'Dr. Ayantras', 'Director', 'Odisha', 19, 'Odisha', '752055', '#566b30', 'Please do not delete this hub. It is the centre for all products', 1, 0, 1, 1, '2025-08-11 12:05:54', '2025-10-09 06:21:21'),
(36, 'SC-OD-KHO-06', 'StepCure Odisha 2', '', 'Dr. Shikhar Pradhan', 'MD, Endocrinologist', 'Khordha', 19, 'Khordha', '752055', '#566b30', 'test', 1, 0, 13, 13, '2025-08-22 20:03:05', '2025-08-22 20:03:05'),
(37, 'SC-TG-HYD-05', 'Advanced Endocrine & Diabetic Hospital', '202508230906_3948.webp', 'Dr. Ravi K. Muppidi', 'M.B.B.S,M.D.(MEDICINE), DM (ENDOCRINOLOGY).', 'MIG-73/0, Rd Number 1, K P H B Phase 1, Kukatpally', 24, 'Hyderabad', '500072', '#566b30', '', 1, 0, 13, 13, '2025-08-23 03:36:58', '2025-08-23 03:40:16');

-- --------------------------------------------------------

--
-- Table structure for table `support_tickets`
--

CREATE TABLE `support_tickets` (
  `id` int(11) NOT NULL,
  `ticketid` varchar(50) NOT NULL,
  `reply_to_id` int(11) DEFAULT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_url` varchar(100) NOT NULL,
  `title` varchar(50) NOT NULL,
  `issue_type` varchar(50) NOT NULL,
  `description` mediumtext NOT NULL,
  `attachments` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`attachments`)),
  `status` varchar(10) NOT NULL DEFAULT 'Pending',
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active	',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `support_tickets`
--

INSERT INTO `support_tickets` (`id`, `ticketid`, `reply_to_id`, `site_name`, `site_url`, `title`, `issue_type`, `description`, `attachments`, `status`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(6, '230825085908SC', 0, 'StepCure', 'https://stepcure.co/', 'Unable to add stock in inventory', 'Others', '<p>Hi Team,</p>\r\n<p>@wassy @ravi</p>\r\n<p>Users are unable to add stock in the inventory.</p>\r\n<p>The Site selection is also disabled for the Admin User</p>\r\n<p>PFA the error image.</p>\r\n<p>Fix this ASAP.</p>\r\n<p>Regards,</p>', '[\"uploads\\/202508230859_1298.webp\"]', 'Replied', 1, 0, 1, 0, '2025-08-23 03:29:08', '2025-08-23 04:27:16'),
(7, '230825095546SC', 0, 'StepCure', 'https://stepcure.co/', 'ert', 'Website Not Loading', '<p>qwert</p>', '[]', 'Pending', 1, 0, 13, 13, '2025-08-23 04:25:46', '2025-08-23 04:25:46'),
(8, '230825095716SC', 6, 'StepCure', 'https://stepcure.co/', '', '', '<p>wqsdv</p>', '[]', 'Pending', 1, 0, 13, 13, '2025-08-23 04:27:16', '2025-08-23 04:27:16');

-- --------------------------------------------------------

--
-- Table structure for table `systemv`
--

CREATE TABLE `systemv` (
  `id` int(11) NOT NULL,
  `variable` varchar(50) NOT NULL,
  `value` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `systemv`
--

INSERT INTO `systemv` (`id`, `variable`, `value`) VALUES
(1, 'SITE_NAME', 'StepCure'),
(2, 'SITE_DIR', 'http://localhost/stepcure/'),
(3, 'SITE_HOME', 'http://localhost/stepcure/'),
(4, 'meta_keywords_limit', '5'),
(5, 'default_featured_image', 'breadcrumb.png'),
(6, 'default_site_color', '#566b30'),
(7, 'default_user_group_color', '#566b30'),
(8, 'default_user_designation_color', '#566b30'),
(9, 'default_user_group', '24'),
(12, 'SITE_LOGO', 'favicon.png'),
(13, 'default_site_id', '37'),
(14, 'consent_form_text', '<ol>\r\n<li>Your orthotist has prescribed a custom orthotic insole following a thorough assessment and detailed procedure. Orthotists can play an integral role in patient care by helping to manage foot pain, correct foot deformities, and accommodate abnormal foot function.</li>\r\n<li>Abnormal foot function may lead to pain in the legs, knees, hips, and spine.</li>\r\n<li>Orthotics are designed based on the degree of abnormal foot function, the patient\'s activity level, posture, and the type of footwear in which the orthotics will be worn. Custom orthotics are foot inserts placed inside footwear to provide support and improve foot function.</li>\r\n<li>Your orthotist will assess your foot function to determine whether you require foot orthotics and, if so, what type of orthotic will benefit you most.</li>\r\n<li>Many patients experience reduced pain and increased comfort when wearing custom foot orthotics. A small percentage of patients may experience discomfort and/or pain during the break-in period. An even smaller percentage may experience significant pain that prevents them from wearing the orthotics altogether.</li>\r\n<li>I have read the information above and hereby request and consent to the assessment of my foot function and the prescription of custom foot orthotics.</li>\r\n<li>I acknowledge that I have had the opportunity to discuss the purpose, benefits, and risks of custom foot orthotics with my orthotist. I understand and have been informed that, as with any orthotic treatment, there are potential risks, including but not limited to foot pain, leg pain, and back or neck pain.</li>\r\n<li>I have read the above consent form and have had the opportunity to ask questions about its contents. By signing below, I agree to the treatment/procedure described above. I intend for this consent to cover the entire course of treatment for both present and future conditions for which I seek foot orthotic treatment with thermoformed insoles.</li>\r\n</ol>'),
(15, 'background_image', 'background-image5.jpg'),
(16, 'SITE_ICON', 'favicon.png'),
(17, 'bank_name', 'IDFC FIRST'),
(18, 'bank_account_name', 'STEPCURE CUSTOM ORTHOTICS & HEALTH CARE LLP'),
(19, 'bank_account_number', '80190419968'),
(20, 'bank_ifsc_code', 'IDFB0080203'),
(21, 'bank_branch', 'SECUNDERABAD BRANCH'),
(22, 'company_gstin', '29AAFCF1356C1ZV'),
(23, 'company_address', '3rd floor, 1-11-111/2, Risha Residency, Shyamlal Buildings, Begumpet'),
(24, 'company_city', 'Hyderabad'),
(25, 'company_state', '24'),
(26, 'company_pin', '500016'),
(27, 'company_phone', '+91-9861572334'),
(28, 'company_email', 'info@stepcure.co'),
(29, 'swift_code', 'IDFBINBBMUM'),
(30, 'GOOGLE_CLIENT_ID', ''),
(31, 'GOOGLE_CLIENT_SECRET', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_group` int(11) DEFAULT NULL,
  `treatment_site` int(11) DEFAULT NULL,
  `user_designation` int(11) DEFAULT NULL,
  `userid` varchar(50) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `aadhaar_no` char(12) DEFAULT NULL,
  `pan_no` char(10) DEFAULT NULL,
  `phone` varchar(15) NOT NULL,
  `whatsapp_no` varchar(15) DEFAULT NULL,
  `alt_phone` varchar(15) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `address_state` int(11) DEFAULT NULL,
  `address_city` varchar(50) NOT NULL,
  `address_pin` char(6) NOT NULL,
  `profile_image` mediumtext DEFAULT NULL,
  `aadhaar_image` mediumtext DEFAULT NULL,
  `pan_image` mediumtext DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `twitter_url` varchar(255) DEFAULT NULL,
  `facebook_url` varchar(255) DEFAULT NULL,
  `instagram_url` varchar(255) DEFAULT NULL,
  `linkedin_url` varchar(255) DEFAULT NULL,
  `remarks` varchar(200) NOT NULL,
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '0=inactive,1=active	',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `def_pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_group`, `treatment_site`, `user_designation`, `userid`, `first_name`, `last_name`, `email`, `aadhaar_no`, `pan_no`, `phone`, `whatsapp_no`, `alt_phone`, `address`, `address_state`, `address_city`, `address_pin`, `profile_image`, `aadhaar_image`, `pan_image`, `password`, `twitter_url`, `facebook_url`, `instagram_url`, `linkedin_url`, `remarks`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `updated_at`, `created_at`, `def_pass`) VALUES
(1, 1, NULL, NULL, 'connect2sazad', 'Sazad', 'Ahemad', 'sazad.ahemad@lyncdigit.com', '123456789012', 'ABCDE1234F', '8763438208', '', '8596829975', 'Near Baramunda Bus Stand', 19, 'Bhubaneswar', '752054', 'admin_connect2sazad.png', '', '', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', '', '', '', '', '', 1, 0, 15, 15, '2025-07-23 23:06:53', '2022-08-21 23:59:07', 'abc123'),
(13, 2, NULL, NULL, 'admin', 'StepCure', '', 'admin@stepcure.co', NULL, NULL, '', '', '', '', 19, '', '', '202607190229_5146.webp', '', '', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', '', '', '', '', '', 1, 0, 1, 13, '2026-07-18 21:17:24', '2022-08-21 23:59:07', 'abc123'),
(14, 24, 36, 1, 'amit', 'Amit', 'Shukla', 'amit@stepcure.co', NULL, NULL, '7855849551', '', '', '', 19, '', '', 'admin_amit.png', '', '', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', '', '', '', '', '', 1, 0, 13, 13, '2025-10-09 01:22:15', '2022-08-21 23:59:07', 'abc123'),
(15, 1, NULL, NULL, 'lyncdigit', 'Lyncdigit', '', 'sazad.ahemad@lyncdigit.com', NULL, NULL, '', '', '', '', 19, '', '', 'admin_lyncdigit.jpg', '', '', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', '', '', '', '', '', 1, 0, 1, 1, '2025-07-16 19:42:56', '2022-08-21 23:59:07', 'abc123'),
(16, 4, 30, 8, 'sumit', 'Sumit', 'Arora', 'sumit@stepcure.co', NULL, NULL, '', '', '', '', 19, '', '', 'admin_sumit.png', '', '', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', '', '', '', '', '', 0, 0, 13, 13, '2025-10-06 07:30:57', '2022-08-21 23:59:07', 'abc123'),
(19, 4, 33, 8, 'ankita', 'Ankita', 'Ghosla', 'ankita@stepcure.co', NULL, NULL, '', '', '', '', 19, '', '', 'admin_ankita.png', '', '', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', '', '', '', '', 'new dr.', 0, 0, 13, 13, '2025-10-06 07:30:55', '2022-08-21 23:59:07', 'abc123'),
(20, 24, 36, 1, 'max', 'Max', 'Planck', 'max@stepcure.co', NULL, NULL, '', '', '', '', 19, '', '', 'admin_max.png', '', '', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', '', '', '', '', '', 0, 0, 13, 13, '2025-10-06 07:30:52', '2022-08-21 23:59:07', 'abc123'),
(21, 24, 34, 1, 'pvroq7j0', 'Pravat', 'Panda', 'ulkployo@lyncdigit.com', '658396499535', 'MPCTJ4997V', '7828171848', '7095274802', '8004441355', '286 Marine Drive, Patna', 17, 'Delhi', '911011', '202507180608_2102.webp', '202507162205_9052.webp', '202507162205_9173.webp', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'test', 1, 0, 13, 13, '2025-10-09 01:22:15', '2025-07-16 16:35:25', ''),
(22, 6, NULL, NULL, '_sieezu_', 'Akash', 'Kumar', 'kvzahncs@lyncdigit.com', '488791640478', 'FVSII3280V', '7383400545', '9223609385', '7994034970', '321 Baner Road, Bhubaneswar', 33, 'Kolkata', '204409', '202507180608_2201.webp', '202507162210_1954.webp', '202507162210_9192.webp', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'test', 0, 0, 13, 13, '2025-10-06 07:30:42', '2025-07-16 16:40:01', ''),
(23, 24, 34, 1, '_nehapal_', 'Nehapal', 'Joshna', 'ydsnsyea@lyncdigit.com', '154764243767', 'EVLKP1109Y', '7737914162', '7737914162', '7737914162', '354 MG Road, Mehrauli, Delhi', 32, 'NCR', '110030', '202507180031_7346.webp', '202507170319_5829.webp', '202507170319_7169.webp', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', 'http://127.0.0.1/stepcure/admin', 'http://127.0.0.1/stepcure/admin/users', 'http://127.0.0.1/stepcure', 'http://127.0.0.1', 'New Female Manager', 1, 0, 13, 13, '2025-10-09 01:22:15', '2025-07-16 17:03:19', ''),
(24, 43, 6, 11, 'rahulyadav', 'Rahul', 'Yadav', 'gpevtfly@lyncdigit.com', '439234730507', 'KQFVP0707O', '7715658368', '7193317370', '7115495665', '211 MG Road, Indore', 7, 'Bangalore', '608857', '', '', '', '$2y$10$Ex.T7T4VL2/a3mqrDJayPuENbTXD6hszWf0rpY6BrnckNjEm4jYTC', 'http://127.0.0.1/stepcure/admin/users/?new_user', 'http://127.0.0.1/stepcure/admin/users', 'http://127.0.0.1/stepcure/admin/users/', 'https://linkedin.com/', 'test', 0, 0, 13, 13, '2025-10-06 07:30:40', '2025-07-18 21:26:07', ''),
(25, 46, 37, 2, 'supriya01', 'Supriya ', 'Priyadarshini', 'supriyap@stepcure.co', '301100825072', 'OJTPS2860A', '8374872334', '', '6370268366', 'ANANDAPUR,NEAR MODEL SCHOOL', 19, 'KEONJHAR', '758021', '', '', '', '$2y$10$Fp72/UzhVgRAByb6.ThQyOwXmlOXTbDC6hbKy8JaTndNjk3nP9WKW', '', '', 'supriya.priyadarshini.169', '', '', 1, 0, 13, 13, '2025-08-23 06:58:22', '2025-08-23 04:00:05', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_designations`
--

CREATE TABLE `user_designations` (
  `id` int(11) NOT NULL,
  `designation_name` varchar(50) NOT NULL,
  `default_honorifics` varchar(5) NOT NULL,
  `default_user_group` int(11) DEFAULT NULL,
  `is_consultant` int(2) NOT NULL DEFAULT 0 COMMENT '0=no, 1=yes',
  `remarks` varchar(200) NOT NULL,
  `color_code` varchar(10) NOT NULL DEFAULT '#566B30',
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '	0=inactive,1=active',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_designations`
--

INSERT INTO `user_designations` (`id`, `designation_name`, `default_honorifics`, `default_user_group`, `is_consultant`, `remarks`, `color_code`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Doctor', 'Dr.', 24, 1, '', '#566b30', 1, 0, 1, 1, '2025-08-22 19:36:21', '2025-08-22 19:36:21'),
(2, 'Prosthetist & Orthotist', 'Dr.', 45, 1, '', '#566b30', 1, 0, 13, 13, '2025-08-23 03:44:01', '2025-08-23 03:44:01'),
(3, 'CENTER INCHARGE', 'IN', 24, 0, '', '#edf038', 1, 0, 25, 25, '2025-08-23 07:01:05', '2025-08-23 07:01:05'),
(4, 'ADMIN', 'AD', 47, 0, '', '#defb04', 1, 0, 25, 25, '2025-08-23 12:01:27', '2025-08-23 12:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `user_groups`
--

CREATE TABLE `user_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(50) NOT NULL,
  `is_super_admin` int(1) NOT NULL DEFAULT 0 COMMENT '0=not super admin,1=super admin',
  `remarks` varchar(200) DEFAULT NULL,
  `color_code` varchar(10) NOT NULL DEFAULT '#566B30',
  `is_active` int(2) NOT NULL DEFAULT 1 COMMENT '	0=inactive,1=active',
  `is_deleted` int(2) NOT NULL DEFAULT 0 COMMENT '0=present,1=deleted	',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_groups`
--

INSERT INTO `user_groups` (`id`, `group_name`, `is_super_admin`, `remarks`, `color_code`, `is_active`, `is_deleted`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 1, 'Super Admin', '#ffffff', 1, 0, 1, 1, '2025-08-22 18:41:25', '2025-08-22 18:41:25'),
(2, 'Adminstrator', 0, 'Admin Group', '#566b30', 1, 0, 1, 1, '2025-08-22 18:59:14', '2025-09-25 02:27:31'),
(24, 'Staffs', 0, 'Least Permission for New Joiners | default User Group', '#ababab', 1, 0, 1, 1, '2025-07-13 18:22:40', '2025-09-05 12:23:12'),
(45, 'ORTHOTIST', 0, '', '#566b30', 1, 0, 13, 25, '2025-08-23 03:42:38', '2025-08-23 11:55:16'),
(46, 'MANAGER', 0, '', '#92edc2', 1, 0, 13, 13, '2025-08-23 03:54:20', '2025-08-23 03:54:20'),
(47, 'Admin', 0, '', '#105298', 1, 0, 25, 25, '2025-08-23 11:57:03', '2025-08-23 11:57:33'),
(48, 'CENTER INCHARGE', 0, '', '#c38c2c', 1, 0, 25, 25, '2025-08-23 12:00:00', '2025-08-23 12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_permissions`
--

CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `allow` int(2) NOT NULL DEFAULT 0,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_permissions`
--

INSERT INTO `user_permissions` (`id`, `user_id`, `permission_id`, `allow`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(19, 25, 30, 1, 13, 13, '2025-09-13 09:49:21', '2025-09-13 09:49:21'),
(20, 25, 31, 1, 13, 13, '2025-09-13 09:49:21', '2025-09-13 09:49:21'),
(21, 25, 26, 1, 13, 13, '2025-09-13 09:49:21', '2025-09-13 09:49:21'),
(22, 25, 27, 1, 13, 13, '2025-09-13 09:49:21', '2025-09-13 09:49:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_states`
--
ALTER TABLE `address_states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `state_code` (`state_code`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `admin_updates`
--
ALTER TABLE `admin_updates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `consultations`
--
ALTER TABLE `consultations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `public_id` (`consultationid`),
  ADD KEY `idx_consultations_list` (`is_deleted`,`is_active`,`site_id`,`created_at`),
  ADD KEY `idx_consultations_user_list` (`user_id`,`is_deleted`,`is_active`,`created_at`),
  ADD KEY `idx_consultations_patient` (`patient_id`),
  ADD KEY `idx_consultations_recommender` (`recomended_by_user_id`);

--
-- Indexes for table `customer_invoices`
--
ALTER TABLE `customer_invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ciid` (`customerinvoiceuid`);

--
-- Indexes for table `customer_invoice_items`
--
ALTER TABLE `customer_invoice_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_invoice_items_service` (`service_id`),
  ADD KEY `idx_invoice_items_period` (`site_id`,`service_year`,`service_month`);

--
-- Indexes for table `group_permissions`
--
ALTER TABLE `group_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_group_permission` (`group_id`,`permission_id`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `inventoryid` (`inventoryid`);

--
-- Indexes for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `transactionid` (`transactionid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `metas`
--
ALTER TABLE `metas`
  ADD PRIMARY KEY (`meta_id`);

--
-- Indexes for table `online_users`
--
ALTER TABLE `online_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`),
  ADD UNIQUE KEY `page_unique_name` (`page_unique_name`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uhid` (`uhid`),
  ADD UNIQUE KEY `patientid` (`patientid`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `prior_issues`
--
ALTER TABLE `prior_issues`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `issue_slug` (`issue_slug`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `product_categories`
--
ALTER TABLE `product_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `saleid` (`saleid`);

--
-- Indexes for table `sales_items`
--
ALTER TABLE `sales_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uq_services_code` (`service_code`),
  ADD KEY `idx_services_state` (`is_deleted`,`is_active`,`service_name`),
  ADD KEY `idx_services_site` (`default_site_id`);

--
-- Indexes for table `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_id` (`site_id`),
  ADD KEY `sites_ibfk_1` (`address_state`);

--
-- Indexes for table `support_tickets`
--
ALTER TABLE `support_tickets`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ticketid` (`ticketid`);

--
-- Indexes for table `systemv`
--
ALTER TABLE `systemv`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `variable` (`variable`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_username` (`userid`),
  ADD KEY `user_type` (`user_group`),
  ADD KEY `users_ibfk_2` (`treatment_site`),
  ADD KEY `user_designation` (`user_designation`),
  ADD KEY `address_state` (`address_state`);

--
-- Indexes for table `user_designations`
--
ALTER TABLE `user_designations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`),
  ADD KEY `default_user_group` (`default_user_group`);

--
-- Indexes for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `user_permissions`
--
ALTER TABLE `user_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_permission` (`user_id`,`permission_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_states`
--
ALTER TABLE `address_states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `admin_updates`
--
ALTER TABLE `admin_updates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3509;

--
-- AUTO_INCREMENT for table `consultations`
--
ALTER TABLE `consultations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `customer_invoices`
--
ALTER TABLE `customer_invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `customer_invoice_items`
--
ALTER TABLE `customer_invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `group_permissions`
--
ALTER TABLE `group_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=782;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inventory_transactions`
--
ALTER TABLE `inventory_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `metas`
--
ALTER TABLE `metas`
  MODIFY `meta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `online_users`
--
ALTER TABLE `online_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `prior_issues`
--
ALTER TABLE `prior_issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_categories`
--
ALTER TABLE `product_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sales_items`
--
ALTER TABLE `sales_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sites`
--
ALTER TABLE `sites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `support_tickets`
--
ALTER TABLE `support_tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `systemv`
--
ALTER TABLE `systemv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `user_designations`
--
ALTER TABLE `user_designations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_groups`
--
ALTER TABLE `user_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `user_permissions`
--
ALTER TABLE `user_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address_states`
--
ALTER TABLE `address_states`
  ADD CONSTRAINT `address_states_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `address_states_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `sites`
--
ALTER TABLE `sites`
  ADD CONSTRAINT `sites_ibfk_1` FOREIGN KEY (`address_state`) REFERENCES `address_states` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_designations`
--
ALTER TABLE `user_designations`
  ADD CONSTRAINT `user_designations_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_designations_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_designations_ibfk_3` FOREIGN KEY (`default_user_group`) REFERENCES `user_groups` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `user_groups`
--
ALTER TABLE `user_groups`
  ADD CONSTRAINT `user_groups_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_groups_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
