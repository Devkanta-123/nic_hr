-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 05, 2025 at 01:31 PM
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
-- Database: `nic_hr`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `attendance_date` date NOT NULL,
  `in_time` time DEFAULT NULL,
  `shift` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'present',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `emp_id`, `attendance_date`, `in_time`, `shift`, `status`, `created_at`) VALUES
(1, 1, '2025-08-05', '14:12:35', 'Night', 'Present', '2025-08-05 14:12:35'),
(2, 2, '2025-08-05', '14:12:37', NULL, 'Absent', '2025-08-05 14:12:37');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `emp_id` int(11) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `emp_contact` varchar(15) DEFAULT NULL,
  `emp_address` text DEFAULT NULL,
  `emp_email` varchar(100) DEFAULT NULL,
  `sector_id` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`emp_id`, `emp_name`, `emp_contact`, `emp_address`, `emp_email`, `sector_id`, `status`, `created_at`) VALUES
(1, 'Konsam Devkanta Singh', '9366535589', 'Imphal East', 'devakantakonsam782@gmail.com', 1, 'active', '2025-07-24 16:08:00'),
(2, 'Sachin Kumar Ray', '9366535545', 'Polo', 'ray@gmail.com', 2, 'active', '2025-07-24 16:08:48'),
(3, 'Mohor das', '9366535582', 'Jail Road', 'mohorshi@gmail.com', 1, 'active', '2025-08-05 12:45:23');

-- --------------------------------------------------------

--
-- Table structure for table `iplogging`
--

CREATE TABLE `iplogging` (
  `ID` bigint(20) NOT NULL,
  `IPAddress` varchar(20) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `URL` text NOT NULL,
  `DATA` text NOT NULL,
  `AccessTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `SessionID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `loc_id` int(11) NOT NULL,
  `loc_name` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`loc_id`, `loc_name`, `status`, `created_at`) VALUES
(1, 'Mairang', 'active', '2025-08-05 12:42:58'),
(2, 'Jhalupara', 'active', '2025-08-05 12:43:07'),
(3, 'Polo', 'active', '2025-08-05 12:43:12');

-- --------------------------------------------------------

--
-- Table structure for table `logindetails`
--

CREATE TABLE `logindetails` (
  `LoginDetailsID` bigint(20) NOT NULL,
  `UserID` int(11) NOT NULL,
  `SessionKey` varchar(50) NOT NULL,
  `SessionExpiryDateTime` datetime NOT NULL,
  `IPAddress` varchar(20) NOT NULL,
  `LoginDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `isSuccessfull` bit(1) NOT NULL DEFAULT b'0',
  `isActive` bit(1) NOT NULL DEFAULT b'0',
  `SessionID` tinyint(4) DEFAULT NULL,
  `DeviceInformation` varchar(450) DEFAULT NULL,
  `UpdateDateTime` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logindetails`
--

INSERT INTO `logindetails` (`LoginDetailsID`, `UserID`, `SessionKey`, `SessionExpiryDateTime`, `IPAddress`, `LoginDateTime`, `isSuccessfull`, `isActive`, `SessionID`, `DeviceInformation`, `UpdateDateTime`) VALUES
(0, 1, '65c82b2218598aca360ca79dd091630d', '2025-08-23 12:31:53', '::1', '2025-07-23 07:01:53', b'1', b'1', NULL, NULL, '2025-07-23 12:31:53'),
(0, 1, '753aa6436243afa2195a4b134c65f684', '2025-08-23 12:31:55', '::1', '2025-07-23 07:01:55', b'1', b'1', NULL, NULL, '2025-07-23 12:31:55'),
(0, 1, '993e757c9e337b714f6ec0dfb2231916', '2025-08-23 12:35:21', '::1', '2025-07-23 07:05:21', b'1', b'1', NULL, NULL, '2025-07-23 12:35:21'),
(0, 1, '06d1ee2d890e38a82bafd7f515950cc8', '2025-08-23 12:35:52', '::1', '2025-07-23 07:05:52', b'1', b'1', NULL, NULL, '2025-07-23 12:35:52'),
(0, 1, 'ee37f72b7a071e9336c91eeaebe9ad23', '2025-08-23 12:36:52', '::1', '2025-07-23 07:06:56', b'1', b'1', NULL, NULL, '2025-07-23 12:36:56'),
(0, 1, 'dbad98160493d41e6b475c7e083362d7', '2025-08-23 12:37:34', '::1', '2025-07-23 07:07:34', b'1', b'1', NULL, NULL, '2025-07-23 12:37:34'),
(0, 1, '00715028c379812bdcf030f3b1e8cec7', '2025-08-23 12:38:02', '::1', '2025-07-23 07:08:02', b'1', b'1', NULL, NULL, '2025-07-23 12:38:02'),
(0, 1, 'd1fe8ccdebd9a1e4d1ce6150a4be0f39', '2025-08-23 12:45:40', '::1', '2025-07-23 07:15:40', b'1', b'1', NULL, NULL, '2025-07-23 12:45:40'),
(0, 1, '342a8015de30bbc7d646076424954883', '2025-08-23 12:50:27', '::1', '2025-07-23 07:20:27', b'1', b'1', NULL, NULL, '2025-07-23 12:50:27'),
(0, 1, 'c69f7603a797b83586879e627e9e7ca7', '2025-08-23 12:58:57', '::1', '2025-07-23 07:28:57', b'1', b'1', NULL, NULL, '2025-07-23 12:58:57'),
(0, 1, '782c7aa8036bcf9bf67578bdd6b96383', '2025-08-23 13:32:27', '::1', '2025-07-23 08:02:27', b'1', b'1', NULL, NULL, '2025-07-23 13:32:27'),
(0, 1, '1eef47400c426c8eb98846e87bb35680', '2025-08-23 15:47:29', '::1', '2025-07-23 10:17:29', b'1', b'1', NULL, NULL, '2025-07-23 15:47:29'),
(0, 1, 'b7ccfe921623e75a7706bafcace035bf', '2025-08-24 10:28:22', '::1', '2025-07-24 04:58:22', b'1', b'1', NULL, NULL, '2025-07-24 10:28:22'),
(0, 1, '37bd694d79e26b39f7282fd054534ce6', '2025-08-24 16:04:18', '::1', '2025-07-24 10:34:18', b'1', b'1', NULL, NULL, '2025-07-24 16:04:18'),
(0, 1, '9ebc19fa7687e3d9c8f42effa3d6a3db', '2025-08-24 16:38:35', '::1', '2025-07-24 11:08:35', b'1', b'1', NULL, NULL, '2025-07-24 16:38:35'),
(0, 1, '89ee7533f715db99492c14c23b300331', '2025-08-25 09:37:35', '::1', '2025-07-25 04:07:35', b'1', b'1', NULL, NULL, '2025-07-25 09:37:35'),
(0, 1, '3349865ef6b225a7744283ab3ff51d63', '2025-09-01 11:27:52', '::1', '2025-08-01 05:57:52', b'1', b'1', NULL, NULL, '2025-08-01 11:27:52'),
(0, 1, 'b7ad622c47b0059f2e7f70e58ae65ac2', '2025-09-01 11:30:16', '::1', '2025-08-01 06:00:16', b'1', b'1', NULL, NULL, '2025-08-01 11:30:16'),
(0, 1, '5eff0d50d2e09ba3260f851ef53394af', '2025-09-05 09:52:34', '::1', '2025-08-05 04:22:34', b'1', b'1', NULL, NULL, '2025-08-05 09:52:34'),
(0, 1, 'f1e82f68f03fd68a19db9a3045c5905e', '2025-09-05 09:53:09', '::1', '2025-08-05 04:23:09', b'1', b'1', NULL, NULL, '2025-08-05 09:53:09'),
(0, 7, 'cffa5fcfb1779b05fa7a4c80bd4a4d72', '2025-09-05 09:57:06', '::1', '2025-08-05 04:27:06', b'1', b'1', NULL, NULL, '2025-08-05 09:57:06'),
(0, 7, '46b86518c1e5e8215da1f94aba7342de', '2025-09-05 09:58:15', '::1', '2025-08-05 04:28:18', b'1', b'1', NULL, NULL, '2025-08-05 09:58:18'),
(0, 7, '2dec43d383558bb074937f6406aba0d8', '2025-09-05 10:02:16', '::1', '2025-08-05 04:32:16', b'1', b'1', NULL, NULL, '2025-08-05 10:02:16'),
(0, 7, '35791cef4f59fb3836d86cd581d68746', '2025-09-05 10:04:55', '::1', '2025-08-05 04:34:55', b'1', b'1', NULL, NULL, '2025-08-05 10:04:55'),
(0, 7, 'a4cf0b72d32b18e33940df1717d12046', '2025-09-05 10:05:06', '::1', '2025-08-05 04:35:06', b'1', b'1', NULL, NULL, '2025-08-05 10:05:06'),
(0, 1, 'd3d9c8d27a5f7f4d8dbde7f0fbdb189d', '2025-09-05 10:05:59', '::1', '2025-08-05 04:35:59', b'1', b'1', NULL, NULL, '2025-08-05 10:05:59'),
(0, 7, '1261f004681366bd61b5e1f2011fd9e8', '2025-09-05 10:06:41', '::1', '2025-08-05 04:36:41', b'1', b'1', NULL, NULL, '2025-08-05 10:06:41'),
(0, 7, '3ec552656916b1e490e1ccb43972cc89', '2025-09-05 10:08:44', '::1', '2025-08-05 04:38:44', b'1', b'1', NULL, NULL, '2025-08-05 10:08:44'),
(0, 7, 'c80b2d40d303a0087398275ba37386f9', '2025-09-05 10:11:49', '::1', '2025-08-05 04:41:49', b'1', b'1', NULL, NULL, '2025-08-05 10:11:49'),
(0, 7, '7ac59598da0b34e323922b7f8d07e6d1', '2025-09-05 10:12:33', '::1', '2025-08-05 04:42:33', b'1', b'1', NULL, NULL, '2025-08-05 10:12:33'),
(0, 7, 'f54e859a1e8a10a107c46cb04c27894e', '2025-09-05 10:14:08', '::1', '2025-08-05 04:44:08', b'1', b'1', NULL, NULL, '2025-08-05 10:14:08'),
(0, 1, '0b3385154f149bd57b68dc81a3f3eef0', '2025-09-05 10:14:49', '::1', '2025-08-05 04:44:49', b'1', b'1', NULL, NULL, '2025-08-05 10:14:49'),
(0, 7, 'bd73227c4b41b2703b0f466623d87170', '2025-09-05 10:15:01', '::1', '2025-08-05 04:45:01', b'1', b'1', NULL, NULL, '2025-08-05 10:15:01'),
(0, 7, '6f713c00857d61d1dfdc1760c43294b5', '2025-09-05 10:16:28', '::1', '2025-08-05 04:46:28', b'1', b'1', NULL, NULL, '2025-08-05 10:16:28'),
(0, 1, '2aeb4a5abcc4e47eb757f8607afae52c', '2025-09-05 10:16:59', '::1', '2025-08-05 04:46:59', b'1', b'1', NULL, NULL, '2025-08-05 10:16:59'),
(0, 7, '0868c45994f1742b229c6c20ab6d9a3c', '2025-09-05 10:21:37', '::1', '2025-08-05 04:51:37', b'1', b'1', NULL, NULL, '2025-08-05 10:21:37'),
(0, 1, '7278b2de5beb082fa7008ec25a832a8a', '2025-09-05 10:35:34', '::1', '2025-08-05 05:05:34', b'1', b'1', NULL, NULL, '2025-08-05 10:35:34'),
(0, 7, 'a49a7e0c7d19689fd97c6ce6cddb517b', '2025-09-05 10:35:46', '::1', '2025-08-05 05:05:46', b'1', b'1', NULL, NULL, '2025-08-05 10:35:46'),
(0, 7, '91ccb043704ac703832330de496f21d5', '2025-09-05 10:43:25', '::1', '2025-08-05 05:13:25', b'1', b'1', NULL, NULL, '2025-08-05 10:43:25'),
(0, 7, 'ead6861e546b3cf78fb5bdf47d63143a', '2025-09-05 10:44:37', '::1', '2025-08-05 05:14:37', b'1', b'1', NULL, NULL, '2025-08-05 10:44:37'),
(0, 1, 'f3b3faba8053994ce5c6289bfa70b7a4', '2025-09-05 11:13:32', '::1', '2025-08-05 05:43:32', b'1', b'1', NULL, NULL, '2025-08-05 11:13:32'),
(0, 7, 'd3d6e3c85511c022d74928243194b37b', '2025-09-05 11:29:54', '::1', '2025-08-05 05:59:54', b'1', b'1', NULL, NULL, '2025-08-05 11:29:54'),
(0, 1, 'bbad65feb21b1076b7763677607555d9', '2025-09-05 11:30:06', '::1', '2025-08-05 06:00:06', b'1', b'1', NULL, NULL, '2025-08-05 11:30:06'),
(0, 1, '1bab41a9c6e6de47cada12511f8b083d', '2025-09-05 12:32:06', '::1', '2025-08-05 07:02:06', b'1', b'1', NULL, NULL, '2025-08-05 12:32:06'),
(0, 7, 'c69f298de381e25a4a37a97f92180cad', '2025-09-05 13:16:46', '::1', '2025-08-05 07:46:46', b'1', b'1', NULL, NULL, '2025-08-05 13:16:46'),
(0, 7, '4981633b7324c6460add21707e53d61c', '2025-09-05 13:34:49', '::1', '2025-08-05 08:04:49', b'1', b'1', NULL, NULL, '2025-08-05 13:34:49'),
(0, 7, '8a5759f1fd71815be2ef162e10974654', '2025-09-05 13:35:30', '::1', '2025-08-05 08:05:30', b'1', b'1', NULL, NULL, '2025-08-05 13:35:30'),
(0, 7, 'ea92dddf6df8cb0d94652f998fe713e4', '2025-09-05 13:59:58', '::1', '2025-08-05 08:29:58', b'1', b'1', NULL, NULL, '2025-08-05 13:59:58'),
(0, 1, '588c7351093ab0e157eb338cdc338fa2', '2025-09-05 14:10:30', '::1', '2025-08-05 08:40:30', b'1', b'1', NULL, NULL, '2025-08-05 14:10:30');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `created_at`) VALUES
(1, 'Admin', '2025-07-23 12:26:08'),
(2, 'Viewer', '2025-07-23 12:26:08'),
(3, 'User', '2025-07-23 12:26:08'),
(4, 'DEO', '2025-07-23 12:26:08');

-- --------------------------------------------------------

--
-- Table structure for table `sector`
--

CREATE TABLE `sector` (
  `sector_id` int(11) NOT NULL,
  `sector_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sector`
--

INSERT INTO `sector` (`sector_id`, `sector_name`, `created_at`) VALUES
(1, 'East Khasi Hills', '2025-07-23 12:59:50'),
(2, 'South', '2025-07-23 14:45:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` mediumint(9) NOT NULL,
  `Name` varchar(200) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `EmailID` varchar(100) NOT NULL,
  `ContactNo` varchar(15) NOT NULL,
  `UserType` tinyint(4) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `VendorID` tinyint(4) DEFAULT NULL,
  `DeliveryPersonalID` tinyint(4) DEFAULT NULL,
  `isMultipleAppLogin` bit(1) NOT NULL,
  `isMultipleWebLogin` bit(1) NOT NULL,
  `CreatedDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `FCMToken` text DEFAULT NULL,
  `SessionID` tinyint(4) DEFAULT NULL,
  `UpdateDateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Username`, `Password`, `EmailID`, `ContactNo`, `UserType`, `isActive`, `VendorID`, `DeliveryPersonalID`, `isMultipleAppLogin`, `isMultipleWebLogin`, `CreatedDateTime`, `FCMToken`, `SessionID`, `UpdateDateTime`) VALUES
(1, 'admin', 'admin', '7c04837eb356565e28bb14e5a1dedb240a5ac2561f8ed318c54a279fb6a9665e', 'admin@gmail.com', '9366535583', 1, 1, NULL, NULL, b'1', b'1', '2024-09-22 19:10:59', NULL, NULL, '2024-09-22 23:10:59'),
(6, 'Dev Testing', '9366535583', 'd3ccfb544a09aee6e854e8fafecd7538dc71a95821373ac015d0308d0a5c43e2', 'delivery@gmail.com', '9366535583', 3, 1, NULL, 1, b'0', b'0', '2024-11-13 20:23:30', NULL, 1, '2024-11-14 07:23:30'),
(7, 'Dev', 'deo', '256839e38767b2a813e9a109844b6f0632d0ba21c69eb0f2f687055805d89937', 'vendor@gmail.com', '9089609855', 4, 1, 1, NULL, b'0', b'0', '2024-11-13 20:24:29', NULL, 1, '2024-11-14 07:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `work`
--

CREATE TABLE `work` (
  `work_id` int(11) NOT NULL,
  `work_title` varchar(150) NOT NULL,
  `work_description` text DEFAULT NULL,
  `loc_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT 'ongoing',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work`
--

INSERT INTO `work` (`work_id`, `work_title`, `work_description`, `loc_id`, `start_date`, `end_date`, `status`, `created_at`) VALUES
(1, 'Test Work', 'Test Work', 1, '2025-07-23', '2025-07-24', 'assigned', '2025-07-23 16:31:09'),
(2, 'Test', 'Test', 3, '2025-07-25', '2025-07-26', 'assigned', '2025-07-24 10:45:48'),
(3, 'Work for Polo Block 4 Shillong', 'Work for Polo Block 4 Shillong', 2, '2025-07-26', '2025-07-28', 'assigned', '2025-07-25 10:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `work_assign`
--

CREATE TABLE `work_assign` (
  `assign_id` int(11) NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `work_id` int(11) DEFAULT NULL,
  `assigned_date` date DEFAULT curdate(),
  `status` varchar(20) DEFAULT 'pending',
  `remarks` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_assign`
--

INSERT INTO `work_assign` (`assign_id`, `emp_id`, `work_id`, `assigned_date`, `status`, `remarks`, `created_at`) VALUES
(1, 2, 1, '2025-07-25', 'pending', NULL, '2025-07-25 10:29:24'),
(2, 1, 3, '2025-07-25', 'pending', NULL, '2025-07-25 10:32:10'),
(3, 2, 2, '2025-08-05', 'pending', NULL, '2025-08-05 13:16:19');

--
-- Indexes for dumped tables
--


CREATE TABLE ledger_entries (
    ledger_id INT AUTO_INCREMENT PRIMARY KEY,
    entry_date DATE NOT NULL,
    ledger_head VARCHAR(255) NOT NULL,
    particulars TEXT,
    debit DECIMAL(10, 2) DEFAULT 0,
    credit DECIMAL(10, 2) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--dummy data 
 INSERT INTO `attendance` (`attendance_id`, `emp_id`, `attendance_date`, `in_time`, `shift`, `status`, `created_at`) VALUES
(1, 1, '2025-08-03', '09:00:00', 'Morning', 'Present', '2025-08-03 09:00:00'),
(2, 2, '2025-08-03', '14:00:00', 'Night', 'Present', '2025-08-03 14:00:00'),
(3, 3, '2025-08-03', NULL, NULL, 'Absent', '2025-08-03 00:00:00'),

(4, 1, '2025-08-04', '09:05:00', 'Morning', 'Present', '2025-08-04 09:05:00'),
(5, 2, '2025-08-04', NULL, NULL, 'Absent', '2025-08-04 00:00:00'),
(6, 3, '2025-08-04', '21:00:00', 'Night', 'Present', '2025-08-04 21:00:00'),

(7, 1, '2025-08-05', '09:10:00', 'Morning', 'Present', '2025-08-05 09:10:00'),
(8, 2, '2025-08-05', '14:05:00', 'Night', 'Present', '2025-08-05 14:05:00'),
(9, 3, '2025-08-05', NULL, NULL, 'Absent', '2025-08-05 00:00:00');

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD UNIQUE KEY `unique_emp_date` (`emp_id`,`attendance_date`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`emp_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`loc_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`sector_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `work`
--
ALTER TABLE `work`
  ADD PRIMARY KEY (`work_id`);

--
-- Indexes for table `work_assign`
--
ALTER TABLE `work_assign`
  ADD PRIMARY KEY (`assign_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `emp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `loc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sector`
--
ALTER TABLE `sector`
  MODIFY `sector_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `work`
--
ALTER TABLE `work`
  MODIFY `work_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `work_assign`
--
ALTER TABLE `work_assign`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



ALTER TABLE `employee`
ADD COLUMN `id_proof_file` LONGTEXT DEFAULT NULL,
ADD COLUMN `residential_certificate_file` LONGTEXT DEFAULT NULL,
ADD COLUMN `date_of_joining` DATE DEFAULT NULL,
ADD COLUMN `increment_date` DATE DEFAULT NULL,
ADD COLUMN `wages_amount` DECIMAL(10,2) DEFAULT NULL;


CREATE TABLE PaySlip (
  PaySlipID int(11) NOT NULL AUTO_INCREMENT,
  EmployeeID int(11) NOT NULL,
  FromDate date DEFAULT NULL,   -- starting period date
  ToDate date DEFAULT NULL,     -- ending period date
  PresentDays int(11) DEFAULT 0,
  OpeningBalance decimal(10,2) DEFAULT 0.00,
  Advance decimal(10,2) DEFAULT 0.00,
  CurrentAdvance decimal(10,2) DEFAULT 0.00,
  AmountPaid decimal(10,2) DEFAULT 0.00,
  TotalPay int(11) DEFAULT NULL,
  GrossAmount decimal(10,2) DEFAULT 0.00,
  NetPay decimal(10,2) DEFAULT 0.00,
  AmountDue decimal(10,2) DEFAULT 0.00, 
  NewOpeningBalance decimal(10,2) DEFAULT 0.00,
  NewCurrentAdvance decimal(10,2) DEFAULT 0.00,
  NewBalance decimal(10,2) DEFAULT 0.00,
  IsGenerated tinyint(1) DEFAULT 0,
  CreatedAt datetime DEFAULT current_timestamp(),
  UpdatedAt datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (PaySlipID)
);



ALTER TABLE `payslip` CHANGE `PaySlipID` `PaySlipID` INT(11) NOT NULL AUTO_INCREMENT;



CREATE TABLE Master_AdvancePayment (
    id INT AUTO_INCREMENT PRIMARY KEY,
    EmpID INT NOT NULL,
    TypesOfPayment VARCHAR(50) NOT NULL,
    Amount DECIMAL(10,2) NOT NULL
);



CREATE TABLE Master_AllowanceAmount (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(10,2) NOT NULL
);





CREATE TABLE Master_AccountName (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_name VARCHAR(100) NOT NULL
);

