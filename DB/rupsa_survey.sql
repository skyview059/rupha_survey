-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 19, 2022 at 07:14 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rupsa_survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `acls`
--

DROP TABLE IF EXISTS `acls`;
CREATE TABLE IF NOT EXISTS `acls` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) DEFAULT NULL,
  `permission_name` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permKey` (`permission_key`),
  KEY `module_id` (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=350 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `acls`
--

INSERT INTO `acls` (`id`, `module_id`, `permission_name`, `permission_key`, `order_id`) VALUES
(1, 4, 'User Management', 'user', 0),
(2, 4, 'Add New User', 'user/create', 0),
(3, 4, 'View User Profile', 'user/create_action', 0),
(7, 4, 'Delete User', 'user/delete', 0),
(8, 4, 'Add New Access Control', 'user/role', 0),
(9, 5, 'Update General Settings', 'settings', 0),
(12, 1, 'Dashboard', 'dashboard', 0),
(82, 4, 'users/profile', 'user/profile', 0),
(83, 4, 'users/update', 'user/update', 0),
(100, 5, 'settings/update', 'settings/update', 0),
(121, 6, 'module', 'module', 0),
(122, 6, 'create', 'module/create', 0),
(123, 6, 'update', 'module/update', 0),
(124, 6, 'delete', 'module/delete', 0),
(125, 6, 'create_action', 'module/create_action', 0),
(126, 6, 'update_action', 'module/update_action', 0),
(157, 7, 'db_sync', 'db_sync', 0),
(169, 5, 'settings/items', 'settings/items', 0),
(251, 6, 'create', 'module/acl', 0),
(272, 4, 'users/password', 'users/password', 0),
(334, 4, 'profile', 'profile', 0),
(335, 4, 'Update Password', 'profile/password', 0),
(336, 2, 'Member', 'member', 0),
(337, 2, 'Member create', 'member/create', 0),
(338, 2, 'Member/save create action', 'member/create_action', 0),
(339, 2, 'Member/update', 'member/update', 0),
(340, 2, 'Member/read', 'member/read', 0),
(341, 2, 'Member/delete', 'member/delete', 0),
(342, 2, 'Member/update_action', 'member/update_action', 0),
(343, 8, 'Trans', 'trans', 0),
(344, 8, 'Trans create', 'trans/create', 0),
(345, 8, 'Trans/save create action', 'trans/create_action', 0),
(346, 8, 'Trans/update', 'trans/update', 0),
(347, 8, 'Trans/read', 'trans/read', 0),
(348, 8, 'Trans/delete', 'trans/delete', 0),
(349, 8, 'Trans/update_action', 'trans/update_action', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trans_date` date NOT NULL,
  `head_id` int(11) NOT NULL,
  `sub_head_id` int(11) NOT NULL,
  `remark` varchar(120) DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `timestamp` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('OK','Void') DEFAULT 'OK',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ledger_heads`
--

DROP TABLE IF EXISTS `ledger_heads`;
CREATE TABLE IF NOT EXISTS `ledger_heads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` enum('Income','Expense') NOT NULL DEFAULT 'Expense',
  `type` enum('Head','SubHead') NOT NULL DEFAULT 'Head',
  `name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ledger_heads`
--

INSERT INTO `ledger_heads` (`id`, `category`, `type`, `name`, `status`) VALUES
(1, 'Expense', 'Head', 'Salary', 'Active'),
(2, 'Expense', 'Head', 'Office Cost', 'Active'),
(3, 'Expense', 'SubHead', 'Manager ( Rubel )', 'Active'),
(4, 'Income', 'Head', 'Deposit', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(80) CHARACTER SET utf8 DEFAULT NULL,
  `address` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  `join_date` date DEFAULT NULL,
  `total_dr` int(11) NOT NULL,
  `total_cr` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `remark` varchar(1000) CHARACTER SET utf8 DEFAULT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `ref_id`, `name`, `photo`, `contact`, `address`, `join_date`, `total_dr`, `total_cr`, `balance`, `created_on`, `updated_on`, `remark`, `status`) VALUES
(9, 9, 'SK. Asafuddwla (Sagor)', NULL, '01712813367', '19/4, B.K. Main Road,Khulna', '2021-01-01', 0, 0, 0, '2021-01-10 13:00:00', '2021-01-10 13:00:00', '', 'Active'),
(10, 10, 'Md. Robiul Islam(Tutul)', NULL, '01979666658', 'Tutpara khulna', '2021-01-01', 0, 0, 0, '2021-01-10 13:00:00', '2021-01-10 13:00:00', '', 'Active'),
(11, 11, 'Sayed Jafor Sadik', NULL, '01619677123', 'Jalil tower khulna', '2021-01-01', 0, 0, 0, '2021-01-10 13:00:00', '2021-01-10 13:00:00', '', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `member_stmt`
--

DROP TABLE IF EXISTS `member_stmt`;
CREATE TABLE IF NOT EXISTS `member_stmt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `trans_date` date NOT NULL,
  `head_id` int(11) DEFAULT NULL,
  `sub_head_id` int(11) DEFAULT NULL,
  `month_of_dps` date DEFAULT NULL,
  `remark` varchar(250) DEFAULT NULL,
  `dr` int(11) NOT NULL DEFAULT '0' COMMENT 'Withdraw',
  `cr` int(11) NOT NULL DEFAULT '0' COMMENT 'Deposit',
  `status` enum('OK','Void') NOT NULL DEFAULT 'OK',
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `member_id` (`member_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `added_date` date NOT NULL,
  `order` int(11) NOT NULL,
  `type` enum('Module','Utility','Accounts') CHARACTER SET latin1 DEFAULT NULL,
  `name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `folder` varchar(100) CHARACTER SET latin1 NOT NULL,
  `description` text CHARACTER SET latin1 NOT NULL,
  `status` enum('Enable','Disable','Locked') CHARACTER SET latin1 NOT NULL DEFAULT 'Disable',
  PRIMARY KEY (`id`),
  UNIQUE KEY `folder` (`folder`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `added_date`, `order`, `type`, `name`, `folder`, `description`, `status`) VALUES
(1, '2014-09-07', 1, 'Module', 'Dashboard', 'dashboard', '', 'Locked'),
(2, '2022-08-04', 1, 'Module', 'Members', 'member', 'Micro Credit Members', 'Enable'),
(4, '2014-09-07', 10, 'Module', 'Admin User', 'user', '', 'Locked'),
(5, '2014-09-07', 15, 'Module', 'Site Setting', 'settings', '', 'Locked'),
(6, '2016-11-24', 32, 'Module', 'Manage Modules', 'module', '', 'Locked'),
(7, '2016-11-24', 33, 'Module', 'DB Sync', 'db_sync', '', 'Locked'),
(8, '2022-08-04', 1, 'Module', 'Trans & Report', 'trans', 'Trans & Report', 'Enable');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Locked','Unlocked') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Unlocked',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `status`) VALUES
(1, 'Developer', 'Locked'),
(2, 'Site Owner / Admin', 'Locked'),
(3, 'Secretary', 'Locked'),
(4, 'Operator/Accounts', 'Unlocked');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

DROP TABLE IF EXISTS `role_permissions`;
CREATE TABLE IF NOT EXISTS `role_permissions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `acl_id` int(11) NOT NULL,
  `access` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roleID_2` (`role_id`,`acl_id`),
  UNIQUE KEY `role_id` (`role_id`,`acl_id`)
) ENGINE=InnoDB AUTO_INCREMENT=171 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Role Permit ACL';

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `acl_id`, `access`) VALUES
(1, 1, 12, 1),
(2, 1, 1, 1),
(3, 1, 332, 1),
(4, 1, 272, 1),
(5, 1, 83, 1),
(6, 1, 82, 1),
(7, 1, 8, 1),
(8, 1, 7, 1),
(9, 1, 3, 1),
(10, 1, 2, 1),
(11, 1, 9, 1),
(12, 1, 100, 1),
(13, 1, 169, 1),
(14, 1, 251, 1),
(15, 1, 126, 1),
(16, 1, 125, 1),
(17, 1, 124, 1),
(18, 1, 123, 1),
(19, 1, 121, 1),
(20, 1, 122, 1),
(21, 1, 157, 1),
(22, 1, 258, 1),
(23, 1, 257, 1),
(24, 1, 256, 1),
(25, 1, 255, 1),
(26, 1, 254, 1),
(27, 1, 253, 1),
(28, 1, 252, 1),
(29, 1, 270, 1),
(30, 1, 269, 1),
(31, 1, 268, 1),
(32, 1, 267, 1),
(33, 1, 264, 1),
(34, 1, 265, 1),
(35, 1, 266, 1),
(36, 1, 273, 1),
(37, 1, 291, 1),
(38, 1, 281, 1),
(39, 1, 280, 1),
(40, 1, 279, 1),
(41, 1, 278, 1),
(42, 1, 277, 1),
(43, 1, 276, 1),
(44, 1, 275, 1),
(45, 1, 274, 1),
(46, 1, 288, 1),
(47, 1, 316, 1),
(48, 1, 314, 1),
(49, 1, 290, 1),
(50, 1, 289, 1),
(51, 1, 287, 1),
(52, 1, 286, 1),
(53, 1, 285, 1),
(54, 1, 284, 1),
(55, 1, 331, 1),
(56, 1, 330, 1),
(57, 1, 329, 1),
(58, 1, 328, 1),
(59, 1, 327, 1),
(60, 1, 326, 1),
(61, 1, 325, 1),
(62, 1, 323, 1),
(63, 1, 322, 1),
(64, 1, 324, 1),
(65, 1, 334, 1),
(66, 1, 335, 1),
(111, 2, 12, 1),
(112, 2, 334, 1),
(113, 2, 335, 1),
(114, 2, 258, 1),
(115, 2, 257, 1),
(116, 2, 256, 1),
(117, 2, 255, 1),
(118, 2, 254, 1),
(119, 2, 253, 1),
(120, 2, 252, 1),
(121, 2, 270, 1),
(122, 2, 269, 1),
(123, 2, 268, 1),
(124, 2, 264, 1),
(125, 2, 265, 1),
(126, 2, 266, 1),
(127, 2, 267, 1),
(128, 2, 291, 1),
(129, 2, 281, 1),
(130, 2, 280, 1),
(131, 2, 279, 1),
(132, 2, 278, 1),
(133, 2, 277, 1),
(134, 2, 276, 1),
(135, 2, 275, 1),
(136, 2, 274, 1),
(137, 2, 273, 1),
(138, 2, 289, 1),
(139, 2, 316, 1),
(140, 2, 314, 1),
(141, 2, 290, 1),
(142, 2, 288, 1),
(143, 2, 287, 1),
(144, 2, 286, 1),
(145, 2, 284, 1),
(146, 2, 285, 1),
(147, 2, 331, 1),
(148, 2, 330, 1),
(149, 2, 329, 1),
(150, 2, 328, 1),
(151, 2, 327, 1),
(152, 2, 326, 1),
(153, 2, 324, 1),
(154, 2, 323, 1),
(155, 2, 322, 1),
(156, 2, 325, 1),
(157, 1, 336, 1),
(158, 1, 337, 1),
(159, 1, 338, 1),
(160, 1, 339, 1),
(161, 1, 340, 1),
(162, 1, 341, 1),
(163, 1, 342, 1),
(164, 1, 343, 1),
(165, 1, 344, 1),
(166, 1, 345, 1),
(167, 1, 346, 1),
(168, 1, 347, 1),
(169, 1, 348, 1),
(170, 1, 349, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `label` (`label`),
  UNIQUE KEY `label_2` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `label`, `value`) VALUES
(1, 'ComName', 'Rupsha'),
(2, 'Title', 'House Hold Servey'),
(3, 'Address', ''),
(4, 'Contact', 'Tel: 01713-900-423'),
(20, 'IncomingEmail', 'skyview059@gmail.com'),
(21, 'OutgoingEmail', 'skyview059@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `full_name` varchar(65) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `last_access` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `full_name`, `email`, `password`, `contact`, `last_access`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Khairul Azam', 'skyview059@gmail.com', '$2y$10$ESkO1tqNorvd9vYraMhNZejnWEMldpHhMt/.nk93seVTzwZNUJfle', '01713-900-423', '10/23/2016 1:10', 'Active', '2016-11-11 00:00:00', NULL),
(2, 2, 'Hiron', 'rihen786@gmail.com', '$2y$10$E/eddxAc0WU0p0Rfk8FTHeV4wCfN6lOkDcSxY3/dwJ.uj.pCwFcla', '01712-662979', 'Last Access', 'Active', '2016-11-11 00:00:00', '2022-08-11 14:58:40');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `acls`
--
ALTER TABLE `acls`
  ADD CONSTRAINT `acls_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `member_stmt`
--
ALTER TABLE `member_stmt`
  ADD CONSTRAINT `member_stmt_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
