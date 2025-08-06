-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2024 at 03:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ongyi`
--

-- --------------------------------------------------------

--
-- Table structure for table `delivery_partners`
--

CREATE TABLE `delivery_partners` (
  `PersonalID` int(11) NOT NULL,
  `ContactNo` varchar(20) NOT NULL,
  `Driving_Licence_DocumentID` int(11) NOT NULL,
  `Vehicle_DocumentID` int(11) NOT NULL,
  `Residentail_DocumentID` int(11) NOT NULL,
  `AccountNo` varchar(20) NOT NULL,
  `AccountHolderName` varchar(20) NOT NULL,
  `BankName` varchar(20) NOT NULL,
  `BankBranch` varchar(20) NOT NULL,
  `IFSC` varchar(20) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `CreatedDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `isApproved` tinyint(1) DEFAULT NULL,
  `RejectedReason` varchar(50) DEFAULT NULL,
  `RejectedDateTime` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `delivery_partners`
--

INSERT INTO `delivery_partners` (`PersonalID`, `ContactNo`, `Driving_Licence_DocumentID`, `Vehicle_DocumentID`, `Residentail_DocumentID`, `AccountNo`, `AccountHolderName`, `BankName`, `BankBranch`, `IFSC`, `isActive`, `CreatedDateTime`, `UpdateDateTime`, `isApproved`, `RejectedReason`, `RejectedDateTime`) VALUES
(1, '9366535583', 6, 5, 7, '1234567891234567', 'Dev Testing', 'SBI', 'Polo', '888888', 1, '2024-09-26 21:52:04', '2024-09-26 20:22:04', 1, NULL, '2024-11-14 01:51:25');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `DocumentsID` int(11) NOT NULL,
  `DocumentsCategoryID` int(11) DEFAULT NULL,
  `DocumentEncryptedID` varchar(200) NOT NULL,
  `DocumentSettingID` int(11) DEFAULT NULL,
  `DocumentPath` varchar(100) DEFAULT NULL,
  `ThumbnailPath` varchar(100) DEFAULT NULL,
  `DocumentTitle` varchar(450) DEFAULT NULL,
  `DocumentAccess` varchar(3) DEFAULT NULL,
  `DocumentDisplayName` varchar(120) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `AddedByID` int(11) DEFAULT NULL,
  `AddedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdatedOn` datetime DEFAULT NULL,
  `UpdatedByID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`DocumentsID`, `DocumentsCategoryID`, `DocumentEncryptedID`, `DocumentSettingID`, `DocumentPath`, `ThumbnailPath`, `DocumentTitle`, `DocumentAccess`, `DocumentDisplayName`, `StudentID`, `AddedByID`, `AddedOn`, `UpdatedOn`, `UpdatedByID`) VALUES
(1, 1, '4F8ymCEMg3AeOQZIT9cmP8MWlyuWnyKEH1tZNMEBFSHNiWwfpW', NULL, 'vendorrccfile/DOC_66f10bd9d6f65.pdf', NULL, 'Admit Card August.pdf', '111', 'Admit Card August.pdf', NULL, 1, '2024-09-22 23:34:01', NULL, NULL),
(2, 2, 'x7K5cojDk5Tae6sKeoDMHuPAi0k68rjNeq8X1ta1xGYaeeWsY2', NULL, 'vendordriverlicence/DOC_66f10bd9d91de.pdf', NULL, '32a686aa-5980-49c9-a083-80d775351259.pdf', '111', '32a686aa-5980-49c9-a083-80d775351259.pdf', NULL, 1, '2024-09-22 23:34:01', NULL, NULL),
(3, 1, 'XklCxDWnQwDPQThliXymtpxkYXMAP8VCcVYlLfuX7rUr9J5J8x', NULL, 'vendorrccfile/DOC_66f19d66a2ca3.pdf', NULL, 'DailyAttendance.pdf', '111', 'DailyAttendance.pdf', NULL, 1, '2024-09-23 09:55:02', NULL, NULL),
(4, 2, 'PR2T4pkf6yk2yUle33fQPwxIi27Y3ZUhtTkICyfXzzTC9ysP3Z', NULL, 'vendordriverlicence/DOC_66f19d66a3de9.pdf', NULL, 'DailyAttendance.pdf', '111', 'DailyAttendance.pdf', NULL, 1, '2024-09-23 09:55:02', NULL, NULL),
(5, 3, 'rLpchIHaMNWMgYy9NPKFkuHM7PjgtE4vYQTw7udGQ2AgTnht9o', NULL, 'deliveryvehiclefile/DOC_66f624dcdcbe4.pdf', NULL, 'AttendanceSummary.pdf', '111', 'AttendanceSummary.pdf', NULL, 1, '2024-09-26 20:22:04', NULL, NULL),
(6, 4, 'AfqcAeTO298VnAgwtE0nih2psQLs0Ijlczfui7sVqTtakmpmzR', NULL, 'deliverydriverlicence/DOC_66f624dcddf32.pdf', NULL, 'AttendanceSummary.pdf', '111', 'AttendanceSummary.pdf', NULL, 1, '2024-09-26 20:22:04', NULL, NULL),
(7, 5, 'RKJFcXwequBsvKxqGki0mcy9V12A1DUSwYKI9nSuMrTCgwScxK', NULL, 'deliveryrccfile/DOC_66f624dcdf1e8.pdf', NULL, 'AttendanceSummary.pdf', '111', 'AttendanceSummary.pdf', NULL, 1, '2024-09-26 20:22:04', NULL, NULL);

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
(0, 1, '0997536db9376a96b04b31129543642c', '2024-12-13 21:51:56', '::1', '2024-11-13 16:21:56', b'1', b'1', NULL, NULL, '2024-11-13 21:51:56'),
(0, 1, '3d643699ff78562ca7bb1b712955be47', '2024-12-13 21:57:42', '::1', '2024-11-13 16:27:42', b'1', b'1', NULL, NULL, '2024-11-13 21:57:42'),
(0, 1, '7a2f99d69186bb4d3dfde09ad5405887', '2024-12-14 06:36:37', '::1', '2024-11-14 01:06:37', b'1', b'1', NULL, NULL, '2024-11-14 06:36:37'),
(0, 5, '2a0e3044fc535c185eeacbbde138ad64', '2024-12-14 07:04:41', '::1', '2024-11-14 01:34:44', b'1', b'1', NULL, NULL, '2024-11-14 07:04:44'),
(0, 5, '5e71f3d75f23420c27a6eebbe89f8bdd', '2024-12-14 07:10:13', '::1', '2024-11-14 01:40:15', b'1', b'1', NULL, NULL, '2024-11-14 07:10:15'),
(0, 6, 'c4ee8befbdd06d7f7aede9b60480d9f1', '2024-12-14 07:28:05', '::1', '2024-11-14 01:58:07', b'1', b'1', NULL, NULL, '2024-11-14 07:28:07'),
(0, 7, '796d782b7a2601cf461989243f6bafa3', '2024-12-14 07:33:07', '::1', '2024-11-14 02:03:11', b'1', b'1', NULL, NULL, '2024-11-14 07:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `settings_documents_category`
--

CREATE TABLE `settings_documents_category` (
  `DocumentsCategoryID` tinyint(4) NOT NULL,
  `DocumentsCategory` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings_documents_category`
--

INSERT INTO `settings_documents_category` (`DocumentsCategoryID`, `DocumentsCategory`) VALUES
(1, 'VENDORrccFile'),
(2, 'VendorDriverLicence'),
(3, 'DeliveryVehicleFile'),
(4, 'DeliveryDriverLicence'),
(5, 'DeliveryRCCFile');

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
(1, 'admin', 'admin', '7c04837eb356565e28bb14e5a1dedb240a5ac2561f8ed318c54a279fb6a9665e', 'admin@gmail.com', '9366535583', 1, 1, NULL, NULL, b'1', b'1', '2024-09-23 00:40:59', NULL, NULL, '2024-09-22 23:10:59'),
(6, 'Dev Testing', '9366535583', 'd3ccfb544a09aee6e854e8fafecd7538dc71a95821373ac015d0308d0a5c43e2', 'delivery@gmail.com', '9366535583', 3, 1, NULL, 1, b'0', b'0', '2024-11-14 01:53:30', NULL, 1, '2024-11-14 07:23:30'),
(7, 'Dev', '9089609855', 'c49cfa8925d0b7d69a008f22c15bbde1945df4ffad69232977b028393b72ae09', 'vendor@gmail.com', '9089609855', 2, 1, 1, NULL, b'0', b'0', '2024-11-14 01:54:29', NULL, 1, '2024-11-14 07:24:29');

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `VendorID` int(11) NOT NULL,
  `AccountNo` varchar(20) NOT NULL,
  `AccountHolderName` varchar(20) NOT NULL,
  `BankName` varchar(20) NOT NULL,
  `BankBranch` varchar(20) NOT NULL,
  `IFSC` varchar(20) NOT NULL,
  `Registration_DocumentID` varchar(200) NOT NULL,
  `FSSAILicenceDocumentID` int(11) NOT NULL,
  `ContactNo` varchar(20) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `CreatedDateTime` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdateDateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `isApproved` tinyint(1) DEFAULT NULL,
  `RejectedReason` varchar(50) NOT NULL,
  `RejectedDateTime` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`VendorID`, `AccountNo`, `AccountHolderName`, `BankName`, `BankBranch`, `IFSC`, `Registration_DocumentID`, `FSSAILicenceDocumentID`, `ContactNo`, `isActive`, `CreatedDateTime`, `UpdateDateTime`, `isApproved`, `RejectedReason`, `RejectedDateTime`) VALUES
(1, '1234567890123456', 'Dev', 'SBI', 'Polo', '11111111111111', '3', 4, '9089609855', 0, '2024-09-23 11:25:02', '2024-09-23 09:55:02', 1, '', '2024-11-14 01:54:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `delivery_partners`
--
ALTER TABLE `delivery_partners`
  ADD PRIMARY KEY (`PersonalID`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`DocumentsID`);

--
-- Indexes for table `iplogging`
--
ALTER TABLE `iplogging`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`VendorID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
