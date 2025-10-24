-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2025 at 03:20 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mia_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `attached_file_table`
--

CREATE TABLE `attached_file_table` (
  `fileId` int(225) NOT NULL,
  `fileTitle` varchar(225) NOT NULL COMMENT 'fileCreatedAt',
  `certificateFile_category` varchar(10) NOT NULL,
  `fileCertificateId` varchar(225) NOT NULL COMMENT 'fileCreatedAt',
  `fileCreatedBy` int(6) NOT NULL COMMENT 'fileCreatedAt',
  `fileCreatedAt` date NOT NULL COMMENT 'fileCreatedAt',
  `certificateFile` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attached_file_table`
--

INSERT INTO `attached_file_table` (`fileId`, `fileTitle`, `certificateFile_category`, `fileCertificateId`, `fileCreatedBy`, `fileCreatedAt`, `certificateFile`) VALUES
(2, 'Test Certificate document', 'divorce', '1', 3, '2025-07-12', '1752338088_287d0e3657dcc3288256.pdf'),
(5, 'Another file for test', 'marriage', '1', 4, '2025-07-12', '1752340195_573205c6a6b91a795bec.pdf'),
(6, 'Test File and for view', 'marriage', '2', 14, '2025-07-12', '1752362341_5b11ee6d0b9ea4db343c.pdf'),
(7, 'Supporting documents', 'divorce', '2', 4, '2025-08-01', '1754007619_192a2d1af04ede21396b.pdf'),
(8, 'Marriage ', 'marriage', '5', 4, '2025-08-05', '1754394102_2ff04ad01454ecd6b3be.jpg'),
(9, 'Marriage ', 'marriage', '1', 4, '2025-08-24', '1755997251_bcd4aac49ce7708c0e93.jpg'),
(10, 'Tarnue ', 'marriage', '1', 4, '2025-08-29', '1756492595_1c4d7133d1592b159029.jpg'),
(11, 'Marriage ', 'marriage', '4', 4, '2025-08-29', '1756493630_9be327ff68a918584dc3.jpg'),
(12, 'Marriage ', 'marriage', '4', 4, '2025-08-29', '1756493714_f358d3bd5f060244d562.jpg'),
(13, 'Marriage Receipt ', 'marriage', '6', 4, '2025-08-30', '1756585465_f2d39e5692fefc02eeba.jpg'),
(14, 'Marriage Picture', 'marriage', '6', 4, '2025-08-30', '1756585587_8b61b5f86ba870d2ac1a.jpg'),
(15, 'The file of mrs jame and paul', 'marriage', '6', 1, '2025-08-30', '1756586482_06bddd9e0219f5e074cb.png'),
(16, 'test file', 'marriage', '4', 1, '2025-10-13', '1760352639_642af2a60ede901cc67a.pdf'),
(17, 'Marriage Receipt ', 'marriage', '8', 4, '2025-10-14', '1760457798_2627dd75ed20a9d17550.jpg'),
(18, 'Receipt ', 'marriage', '9', 15, '2025-10-17', '1760660123_3529d14c8ab35401c211.png'),
(19, 'Marriage Receipt ', 'marriage', '9', 15, '2025-10-17', '1760660209_eda3858e8e4ee133643b.png'),
(20, 'Marriage Receipt ', 'marriage', '9', 15, '2025-10-17', '1760661285_0a7647444b0230fdb937.png');

-- --------------------------------------------------------

--
-- Table structure for table `branchs_table`
--

CREATE TABLE `branchs_table` (
  `branchId` int(11) NOT NULL,
  `branchName` varchar(100) NOT NULL,
  `branchCounty` varchar(100) NOT NULL,
  `branchCityOrTown` varchar(100) NOT NULL,
  `branchCode` varchar(20) NOT NULL,
  `branchContact` varchar(20) NOT NULL,
  `branchEmail` varchar(255) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT 1,
  `branchCreatedBy` varchar(100) DEFAULT NULL,
  `branchCreatedAt` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branchs_table`
--

INSERT INTO `branchs_table` (`branchId`, `branchName`, `branchCounty`, `branchCityOrTown`, `branchCode`, `branchContact`, `branchEmail`, `isActive`, `branchCreatedBy`, `branchCreatedAt`) VALUES
(1, 'Head Office Branch', 'Montserrado', 'MONROVIA', 'LR-MO258C87F', '0775577736', 'mia@liberia.lra', 1, '3', '2025-07-12 03:36:12'),
(2, 'Lofa  County (DDCMS) Service Center', 'Lofa', 'Voinjama City', 'LR-LO2524A54', '0775577736', 'voinjamabranch@mia.lr', 1, '3', '2025-07-12 18:01:36'),
(3, 'Bomi County  (DDCMS) Service Center', 'Bomi', 'Tubmanburg', 'LR-BM2531A7B', '0777123456', 'bomicounty22@gmail.com', 1, '3', '2025-10-16 19:14:12'),
(4, 'Bong County  (DDCMS) Service Center', 'Bong', 'Gbarnga', 'LR-BG2510BE3', '0777023456', 'bongcounty21@gmail.com', 1, '3', '2025-10-16 19:22:11'),
(5, 'Gbarpolu County (DDCMS) Service Center', 'Gbarpolu', 'Bopolu', 'LR-GP2566F4F', '0777123450', 'gbarpolucounty23@gmail.com', 1, '3', '2025-10-16 19:27:09'),
(6, 'Grand Bassa County (DDCMS) Service Center', 'Grand Bassa', 'Buchanan', 'LR-GB25AD0A0', '0770023456', 'grandbassacounty24@gmail.com', 1, '3', '2025-10-16 19:29:14'),
(7, 'Grand Cape Mount County (DDCMS) Service Center', 'Grand Cape Mount', 'Robertsport', 'LR-CM25EFD87', '0770123450', 'grandcapemountcounty35@gmail.com', 1, '3', '2025-10-16 19:32:26'),
(8, 'Grand Gedeh County (DDCMS) Service Center', 'Grand Gedeh', 'Zwedru', 'LR-GG25927B9', '0880123450', 'grandgedehcounty26@gmail.com', 1, '3', '2025-10-16 19:34:06'),
(9, 'Grand Kru County (DDCMS) Service Center', 'Grand Kru', 'Barclayville', 'LR-GK2500A2E', '0888123450', 'grandkrucounty27@gmail.com', 1, '3', '2025-10-16 19:35:37'),
(10, 'Margibi County (DDCMS) Service Center', 'Margibi', 'Kakata', 'LR-MG253C288', '0775577700', 'margibicounty28@gmail.com', 1, '3', '2025-10-16 19:38:12'),
(11, 'Maryland County (DDCMS) Service Center', 'Maryland', 'Harper ', 'LR-MY2594A4B', '0880023456', 'marylandcounty29@gmail.com', 1, '3', '2025-10-16 19:40:59'),
(12, 'Nimba County (DDCMS) Service Center', 'Nimba', 'Sanniquellie', 'LR-NI2561751', '0770020056', 'nimbacounty12@gmail.com', 1, '3', '2025-10-16 20:13:39'),
(13, 'River Cess County (DDCMS) Service Center', 'River Cess', 'Cestos', 'LR-RI2590375', '0770123555', 'rivercesscounty13@gmail.com', 1, '3', '2025-10-16 20:15:23'),
(14, 'River Gee (DDCMS) Service Center', 'River Gee', 'Fish Town', 'LR-RG25FDA61', '0770020056', 'rivergeecounty14@gmail.com', 1, '3', '2025-10-16 20:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `certificate_comments`
--

CREATE TABLE `certificate_comments` (
  `comment_id` int(11) NOT NULL,
  `certificate_id` int(11) NOT NULL,
  `certificate_type` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `certificate_comments`
--

INSERT INTO `certificate_comments` (`comment_id`, `certificate_id`, `certificate_type`, `user_id`, `comment_text`, `created_at`, `updated_at`) VALUES
(1, 1, 'divorce', 4, 'I&#039;ve the certificate information about Jane Doe and John Doe, please peruse it and let me know if you have any questions before I print it.', '2025-07-12 08:56:41', '2025-07-12 08:56:41'),
(2, 1, 'divorce', 3, 'I&#039;ve Signed. I hope you guys review the document and sign as well.', '2025-07-12 09:04:41', '2025-07-12 09:04:41'),
(3, 1, 'divorce', 1, 'High Guys, I held back my signature because the clerk forget to attach supporting documents. Clerk, can you please attach them for our perusal?', '2025-07-12 09:07:46', '2025-07-12 09:07:46'),
(4, 1, 'divorce', 1, 'This is good', '2025-07-12 12:50:17', '2025-07-12 12:50:17'),
(6, 1, 'marriage', 4, 'High this is signed by the assistant minister already, the two remaining signatories sign it please', '2025-07-12 17:37:37', '2025-07-12 17:37:37'),
(7, 1, 'marriage', 1, 'This is printed?', '2025-07-12 17:48:48', '2025-07-12 17:48:48'),
(8, 2, 'marriage', 14, 'Hi Sir, I&#039;ve uploaded the files for Robert Harris. Please Review and sign if need be.', '2025-07-12 23:20:10', '2025-07-12 23:20:10'),
(9, 1, 'divorce', 3, 'This is finished', '2025-07-12 23:59:24', '2025-07-12 23:59:24'),
(10, 2, 'marriage', 14, 'Still waiting for signatures', '2025-07-13 00:00:09', '2025-07-13 00:00:09'),
(11, 1, 'marriage', 3, 'this document is ready for print', '2025-07-21 17:19:28', '2025-07-21 17:19:28'),
(12, 2, 'divorce', 3, 'What&#039;s going with this document duwana?', '2025-08-01 00:17:59', '2025-08-01 00:17:59'),
(13, 5, 'marriage', 4, 'the quick brown fox jumps over the lazy dog', '2025-08-05 11:42:58', '2025-08-05 11:42:58'),
(14, 6, 'marriage', 4, 'I have just uploaded some document for the couple Mr. and Mrs. Kamara for your perusal ', '2025-08-30 20:27:52', '2025-08-30 20:27:52'),
(15, 6, 'marriage', 3, 'Please upload LRA receipts', '2025-08-30 20:30:31', '2025-08-30 20:30:31'),
(16, 6, 'marriage', 3, 'I&#039;ve affixed my signature. Please sign in the sonnets possible time as this document is needed for print today.', '2025-08-30 20:32:09', '2025-08-30 20:32:09'),
(17, 6, 'marriage', 4, 'Noted Boss I am waiting for the other two persons to sign ', '2025-08-30 20:32:58', '2025-08-30 20:32:58'),
(18, 6, 'marriage', 4, 'The bearer of this certificate in person of  Mr. Kammah A. Duwan has verified his certificate and confirm that all information provided are truth and correct to the best his knowledge', '2025-08-30 20:58:47', '2025-08-30 20:58:47'),
(19, 6, 'marriage', 4, 'This couple meet the requirements including payment of the LRA&#039;s receipt ', '2025-09-15 11:15:40', '2025-09-15 11:15:40'),
(20, 4, 'marriage', 4, 'admin', '2025-10-13 11:01:56', '2025-10-13 11:01:56'),
(21, 4, 'marriage', 4, 'test remark\r\n', '2025-10-13 11:02:09', '2025-10-13 11:02:09'),
(22, 8, 'marriage', 4, 'I&#039;ve uploaded this for your perusal', '2025-10-14 16:03:45', '2025-10-14 16:03:45'),
(23, 7, 'marriage', 4, 'I just filed an applicant info for your perusal.', '2025-10-15 13:37:39', '2025-10-15 13:37:39'),
(24, 7, 'marriage', 1, 'I have sighed this certificate. Please sign and speed up Mr. Borbor work', '2025-10-17 21:04:11', '2025-10-17 21:04:11');

-- --------------------------------------------------------

--
-- Table structure for table `divorce_certificates`
--

CREATE TABLE `divorce_certificates` (
  `divorceCertId` int(11) NOT NULL,
  `divorceRefNo` varchar(50) DEFAULT NULL,
  `divorceCode` varchar(20) DEFAULT NULL,
  `divorceRevNo` varchar(20) DEFAULT NULL,
  `divorceplaintiff` varchar(255) NOT NULL,
  `divorcedefendant` varchar(255) NOT NULL,
  `divorcedefendantPic` varchar(255) DEFAULT NULL,
  `divorceplaintiffPic` varchar(255) DEFAULT NULL,
  `divorcemarriageDate` date NOT NULL,
  `divorcedateOfDivorce` date NOT NULL,
  `divorceissuanceDate` date NOT NULL,
  `divorceSIGN_A` varchar(225) DEFAULT NULL,
  `divorceSIGN_A_ID` varchar(225) DEFAULT NULL,
  `divorceSIGN_A_DATE_SIGNED` date DEFAULT NULL,
  `divorceSIGN_B` varchar(225) DEFAULT NULL,
  `divorceSIGN_B_ID` varchar(225) DEFAULT NULL,
  `divorceSIGN_B_DATE_SIGNED` date DEFAULT NULL,
  `divorceSIGN_C` varchar(225) DEFAULT NULL,
  `divorceSIGN_C_ID` varchar(225) DEFAULT NULL,
  `divorceSIGN_C_DATE_SIGNED` date DEFAULT NULL,
  `divorcebreanch_id` int(225) NOT NULL,
  `divorcecreated_by` int(225) NOT NULL,
  `divorcecreated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `divorceupdated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divorce_certificates`
--

INSERT INTO `divorce_certificates` (`divorceCertId`, `divorceRefNo`, `divorceCode`, `divorceRevNo`, `divorceplaintiff`, `divorcedefendant`, `divorcedefendantPic`, `divorceplaintiffPic`, `divorcemarriageDate`, `divorcedateOfDivorce`, `divorceissuanceDate`, `divorceSIGN_A`, `divorceSIGN_A_ID`, `divorceSIGN_A_DATE_SIGNED`, `divorceSIGN_B`, `divorceSIGN_B_ID`, `divorceSIGN_B_DATE_SIGNED`, `divorceSIGN_C`, `divorceSIGN_C_ID`, `divorceSIGN_C_DATE_SIGNED`, `divorcebreanch_id`, `divorcecreated_by`, `divorcecreated_at`, `divorceupdated_at`) VALUES
(1, 'MT-11-B9B2', 'MIA-11-25-B9B2', '554467', 'Jane Doe II', 'John Doe', '1752310525_6556ceefdb0d43970502.jpg', '1752310525_ab7e7670c575479468d2.jpeg', '2023-06-15', '2025-07-10', '2025-07-01', '1751038816_563548c0d2293b4fc4bb.png', '1', NULL, '1751040265_347a46b747f7ed344b6d.png', '2', NULL, '1751059002_d8e91207777fea61d704.png', '3', '2025-07-12', 1, 4, '2025-07-12 08:55:25', '2025-07-12 21:33:10'),
(2, 'MT-11-341F', 'MIA-11-25-341F', '78698', 'Sylvestrees A Johnson', 'Bernice Twalla Johnson', '1752356776_abad23e14bb692b7bf3b.jpg', '1752356776_f336e946e85fbda0e4fc.jpg', '2025-07-11', '2025-07-17', '2025-07-04', NULL, NULL, NULL, NULL, NULL, NULL, '1751059002_d8e91207777fea61d704.png', '3', '2025-07-21', 1, 4, '2025-07-12 21:46:16', '2025-07-21 17:20:53'),
(3, 'MT-11-5D71', 'MIA-11-25-5D71', '93939', 'Abraham Momo', 'Princess Johnson', '1754011032_1d6f1defce2725f0d5bb.jpeg', '1754011032_1ebe38f9b7102875d552.jpeg', '2025-08-07', '2025-08-15', '2025-08-09', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, 4, '2025-08-01 01:17:12', '2025-08-01 01:17:12');

-- --------------------------------------------------------

--
-- Table structure for table `login_users`
--

CREATE TABLE `login_users` (
  `userId` int(11) NOT NULL,
  `userFullName` varchar(100) NOT NULL,
  `userEmail` varchar(150) NOT NULL,
  `userPhone` varchar(15) DEFAULT NULL,
  `userPosition` varchar(100) DEFAULT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userPicture` varchar(255) DEFAULT NULL,
  `userBreanch` int(6) DEFAULT NULL,
  `userAccountType` enum('SIGNA','SIGNB','SIGNC','ENTRY') DEFAULT 'ENTRY',
  `userSignature` varchar(225) NOT NULL,
  `userApplicationFile` varchar(225) NOT NULL,
  `userAccountActiveStatus` tinyint(1) DEFAULT 1,
  `userCreatedBy` varchar(100) DEFAULT NULL,
  `userDateCreated` datetime DEFAULT current_timestamp(),
  `userAccountLastModifiedDate` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `userAccountLastModifiedBy` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_users`
--

INSERT INTO `login_users` (`userId`, `userFullName`, `userEmail`, `userPhone`, `userPosition`, `userPassword`, `userPicture`, `userBreanch`, `userAccountType`, `userSignature`, `userApplicationFile`, `userAccountActiveStatus`, `userCreatedBy`, `userDateCreated`, `userAccountLastModifiedDate`, `userAccountLastModifiedBy`) VALUES
(1, 'G. Dennison Wesseh', 'superientendent@gmail.com', '0775577744', 'Superientendents', '$2y$10$AvdFP9irPGzpFLWTzr6QDOKHKp5GuuMe2A0MwyzAEQ4wveHj6lg0.', '1752276849_c89e534426c9b416fb6d.jpeg', 1, 'SIGNA', '1751038816_563548c0d2293b4fc4bb.png', '1750669250_7365bce52c76ec5e7b14.pdf', 1, '3', '2025-06-23 09:00:50', '2025-07-12 02:29:36', '1'),
(2, 'Samuel F. Brown', 'deputyminister@gmail.com', '0777169180', 'Deputy Minister', '$2y$10$ZELthgcyCXoEQH7dQnAdWuVbnKC39y/dptPyizUnZEbjdICJfnAJC', '1752282536_945af8038fd6b63a01f0.jpeg', 1, 'SIGNB', '1751040265_347a46b747f7ed344b6d.png', '1750675854_f8581c20752654f0cc7b.pdf', 1, '3', '2025-06-23 10:50:54', '2025-07-12 02:19:33', '3'),
(3, 'Losene F. Bility', 'assistantminister@gmail.com', '0775577736', 'Assistant Minister', '$2y$10$nXVI7BdI0r0prJVgELGC3Oe/FkqinIcqOvxX0IdYCcjG8vS3UMv2G', '1752283120_20588e38b65226a9da4d.jpeg', 1, 'SIGNC', '1751059002_d8e91207777fea61d704.png', '1751058956_eae1ce8e044491885033.pdf', 1, '3', '2025-06-27 21:15:56', '2025-07-12 01:20:18', '2'),
(4, 'Edward Tulay', 'admi4n@gmail.com', '0777169180', 'Data Entry Clerk', '$2y$10$wGXpikgDeoWt2reRe8jhoeHQftb5DkM6wBYsGC78wSw7mrGsF07NO', '1751096694_3fc160c3adbe52ef25e3.png', 1, 'ENTRY', '1751096694_aea24bbc92ed62875e2f.png', '1751096694_1372a3f61950be48b76a.pdf', 1, '1', '2025-06-28 07:44:54', '2025-07-11 22:35:42', '3'),
(11, 'Mark Jalateh', 'lofacommissioner@gmail.com', '0777169180', 'Commissioner', '$2y$10$mloGxveciltc71Pb6nqhpujETS.fogKJ2.IOUnjXJGmzgjrwPBTym', '1752357277_25c20c2c19048995813a.jpg', 2, 'SIGNC', '1752357277_adc344c41ab175611aeb.png', '1752357277_4e474e4ae80cd2392011.pdf', 1, '3', '2025-07-12 21:54:38', '2025-07-12 23:40:44', '11'),
(12, 'Kolubah Zazay', 'lofasuperientendent@gmail.com', '0775577744', 'Superientendent', '$2y$10$hitA2zIWjZR9vuJ4coYFfef7CR0vkkyZzClkmMxH8LHDcBXG.93tC', '1752361527_9bb891f94e61e89bc4f1.jpg', 2, 'SIGNA', '1752361527_ccd6a73ec812788721b4.png', '1752361527_b94f1caf741801d04d61.pdf', 1, '3', '2025-07-12 23:05:27', '2025-07-12 23:05:27', NULL),
(13, 'Sekou Jallah', 'lofacitymajor@gmail.com', '0775577744', 'City Mayor', '$2y$10$oKfxS1GBmuvmXGL3q9ZtjuodBvqRRh/qH0iRwFBHWPxy554BeseO.', '1752361744_f2a5d2f2c189ef5b562e.jpg', 2, 'SIGNB', '1752361744_a9a51089aa04b66b9fd9.png', '1752361744_200639092fc8823ffe16.pdf', 1, '3', '2025-07-12 23:09:04', '2025-07-12 23:09:04', NULL),
(14, 'Mawolo Kollie', 'lofaentryclerk@gmail.com', '0770423352', 'Data Entry Clerk', '$2y$10$CZIeqfIjFzWJAM2HiwU7leDTPXDlNSPdA7hjrdc11WCrfyqgWIb7a', '1752361940_87a871dd327b4ffe31df.jpg', 2, 'ENTRY', '1752361940_a82dcd8863cc76a4227b.png', '1752361940_cef356aceb33e8006e4c.pdf', 1, '3', '2025-07-12 23:12:20', '2025-07-12 23:12:20', NULL),
(15, 'Festus Kamara', 'festuskamara13@gmail.com', '0777077575', 'Clerk', '$2y$10$G4Yhho.4.D.iTZWMWcP7O.4dYGw9io0PEEdAfPUPVA77IaXas4uGC', '1760647202_4ed9f651f93011f6c996.jpg', 3, 'ENTRY', '1760647202_ac8ca00887ae4d5d33fb.png', '1760647202_06a7fd2ad1baf352a117.pdf', 1, '3', '2025-10-16 20:40:02', '2025-10-16 13:40:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `marriage_certificates`
--

CREATE TABLE `marriage_certificates` (
  `marriage_cert_id` int(11) NOT NULL,
  `groom_name` varchar(100) DEFAULT NULL,
  `groom_cell` varchar(20) DEFAULT NULL,
  `groom_county_of_origin` varchar(50) DEFAULT NULL,
  `groom_nationality` varchar(50) DEFAULT NULL,
  `groom_dob` date DEFAULT NULL,
  `groom_birth_city` varchar(50) DEFAULT NULL,
  `groom_birth_county` varchar(50) DEFAULT NULL,
  `groom_age` int(11) DEFAULT NULL,
  `groom_address` text DEFAULT NULL,
  `groom_married_before` tinyint(1) DEFAULT NULL,
  `groom_previous_marriage_date` date DEFAULT NULL,
  `groom_previous_spouse_name` varchar(100) DEFAULT NULL,
  `groom_father_name` varchar(100) DEFAULT NULL,
  `groom_mother_name` varchar(100) DEFAULT NULL,
  `bride_name` varchar(100) DEFAULT NULL,
  `bride_cell` varchar(20) DEFAULT NULL,
  `bride_county_of_origin` varchar(50) DEFAULT NULL,
  `bride_nationality` varchar(50) DEFAULT NULL,
  `bride_dob` date DEFAULT NULL,
  `bride_birth_city` varchar(50) DEFAULT NULL,
  `bride_birth_county` varchar(50) DEFAULT NULL,
  `bride_age` int(11) DEFAULT NULL,
  `bride_address` text DEFAULT NULL,
  `bride_married_before` tinyint(1) DEFAULT NULL,
  `bride_previous_marriage_date` date DEFAULT NULL,
  `bride_previous_spouse_name` varchar(100) DEFAULT NULL,
  `bride_father_name` varchar(100) DEFAULT NULL,
  `bride_mother_name` varchar(100) DEFAULT NULL,
  `groom_passport_photo` varchar(255) DEFAULT NULL,
  `bride_passport_photo` varchar(255) DEFAULT NULL,
  `place_of_marriage` varchar(100) DEFAULT NULL,
  `date_of_marriage` date DEFAULT NULL,
  `bride_proposed_name` varchar(100) DEFAULT NULL,
  `witness_name` varchar(100) DEFAULT NULL,
  `witness_contact` varchar(50) DEFAULT NULL,
  `officiator_name` varchar(100) DEFAULT NULL,
  `officiator_contact` varchar(50) DEFAULT NULL,
  `certificate_cost` decimal(10,2) DEFAULT NULL,
  `certificate_cost_words` varchar(255) DEFAULT NULL,
  `declarant_name` varchar(100) DEFAULT NULL,
  `declaration_date` date DEFAULT NULL,
  `reference_no` varchar(50) DEFAULT NULL,
  `marriage_code` varchar(50) DEFAULT NULL,
  `revenue_no` varchar(50) DEFAULT NULL,
  `certification_day` varchar(10) DEFAULT NULL,
  `certification_month` varchar(20) DEFAULT NULL,
  `certification_year` year(4) DEFAULT NULL,
  `SIGNA` varchar(100) DEFAULT NULL,
  `SIGNB` varchar(100) DEFAULT NULL,
  `SIGNC` varchar(100) DEFAULT NULL,
  `ENTRY` int(10) DEFAULT NULL,
  `cert_branch` int(6) NOT NULL,
  `last_edited_by` varchar(100) DEFAULT NULL,
  `last_edited_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `SIGNA_id` int(11) DEFAULT NULL,
  `SIGNA_signedDate` date DEFAULT NULL,
  `SIGNB_id` int(11) DEFAULT NULL,
  `SIGNB_signedDate` date DEFAULT NULL,
  `SIGNC_id` int(11) DEFAULT NULL,
  `SIGNC_signedDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriage_certificates`
--

INSERT INTO `marriage_certificates` (`marriage_cert_id`, `groom_name`, `groom_cell`, `groom_county_of_origin`, `groom_nationality`, `groom_dob`, `groom_birth_city`, `groom_birth_county`, `groom_age`, `groom_address`, `groom_married_before`, `groom_previous_marriage_date`, `groom_previous_spouse_name`, `groom_father_name`, `groom_mother_name`, `bride_name`, `bride_cell`, `bride_county_of_origin`, `bride_nationality`, `bride_dob`, `bride_birth_city`, `bride_birth_county`, `bride_age`, `bride_address`, `bride_married_before`, `bride_previous_marriage_date`, `bride_previous_spouse_name`, `bride_father_name`, `bride_mother_name`, `groom_passport_photo`, `bride_passport_photo`, `place_of_marriage`, `date_of_marriage`, `bride_proposed_name`, `witness_name`, `witness_contact`, `officiator_name`, `officiator_contact`, `certificate_cost`, `certificate_cost_words`, `declarant_name`, `declaration_date`, `reference_no`, `marriage_code`, `revenue_no`, `certification_day`, `certification_month`, `certification_year`, `SIGNA`, `SIGNB`, `SIGNC`, `ENTRY`, `cert_branch`, `last_edited_by`, `last_edited_at`, `created_at`, `SIGNA_id`, `SIGNA_signedDate`, `SIGNB_id`, `SIGNB_signedDate`, `SIGNC_id`, `SIGNC_signedDate`) VALUES
(1, 'Mill Junes', '0775577737', 'Bomi', 'Liberian', '2025-07-11', 'MONROVIA', 'Bong', 34, 'New Georgia Signboard, Monrovia - Liberia', 0, '0000-00-00', '', 'Kollie Junes', 'Mamie Junes', 'Princess Kamara', '0998760987', 'Grand Bassa', 'Liberian', '2025-07-13', 'MONROVIA', 'Montserrado', 33, 'New Georgia Signboard, Monrovia - Liberia', 0, '2025-07-11', 'Miatta ', 'Amara Kamara', 'Garmai Kamara', '1752339875_fe6f7ab823f29c74c993.jpg', '1752339875_29c3498197b0e68f70e4.jpeg', 'Monrovia', '2025-06-04', 'Princess Junes', 'Tarnue P. Borbor', '0775566678', 'Rev. Philip Menifix', '8888888888', 35.00, 'Thirty five united states dollars', 'Mark James', '2025-07-11', '02-25BVI9', 'BG-02-25BVI9', '3535', NULL, NULL, NULL, '1751038816_563548c0d2293b4fc4bb.png', '1751040265_347a46b747f7ed344b6d.png', '1751059002_d8e91207777fea61d704.png', 4, 1, NULL, '2025-08-31 02:55:03', '2025-07-12 17:04:36', 1, '2025-07-12', 2, '2025-07-12', 3, '2025-08-30'),
(2, 'Robert Harris', '0998877667', 'Bomi', 'Liberian', '2013-02-02', 'Greensville', 'Montserrado', 34, 'Randall Street', 0, '0000-00-00', '', 'Robertson Harris', 'Pauline McDonald', 'Jamesetta Marshell', '0778889989', 'Bong', 'Liberian', '2019-02-12', 'Bento', 'Montserrado', 34, 'Randall Street Monrovia, Liberia', 0, '0000-00-00', '', 'Amara Johnson', 'Heretta Princess', '1752362275_27fe94ebf40582aa0ad9.jpg', '1752362275_ef61bb55ecd6b0fe30d7.jpg', 'Monrovia Liberia', '2025-07-11', 'Jamesetta Harris', 'Tarnue P. Borbor', '0775577736', 'Rev. Philib C. Menifix', '0775588836', 35.00, 'Thirty United States Dollars', 'Mark Anthony', '2025-07-11', '11-25MZDV', 'MT-11-25MZDV', '3434', NULL, NULL, NULL, NULL, NULL, '1752357277_adc344c41ab175611aeb.png', 14, 2, NULL, '2025-07-12 23:32:19', '2025-07-12 23:17:55', NULL, NULL, NULL, NULL, 11, '2025-07-12'),
(6, 'Kammah A. Duwana', '0776077575', 'Lofa', 'Liberian', '1988-07-30', 'Voinjama', 'Lofa', 36, 'New Georgia Estate', 0, '0000-00-00', '', 'Kammah A. Duwana, Sr', 'Fatumata S.K. Kamara ', 'Denise D. Kromah', '0776224226', 'Lofa', 'Liberian', '1990-10-01', 'Voinjama', 'Lofa', 35, 'New Georgia Estate', 0, '0000-00-00', '', 'Dominic Kromah', 'Mariama Konneh', '1756585211_0c705b08c58a73ed60db.jpg', '1756585211_65dfd90923c117d47c0a.jpg', 'New Georgia Estate', '2022-10-01', 'Denise D. Duwana', 'Moiseleke Duwana', '0886381508', 'Imam Moniru Nyei', '0886886773', 110.00, 'One Hundred Ten United States Dollars', 'Losene F. Bility', '2022-10-10', '08-25N871', 'LF-08-25N871', '7309557', NULL, NULL, NULL, '1751038816_563548c0d2293b4fc4bb.png', '1751040265_347a46b747f7ed344b6d.png', '1751059002_d8e91207777fea61d704.png', 4, 1, NULL, '2025-08-31 03:39:29', '2025-08-31 03:20:11', 1, '2025-08-30', 2, '2025-08-30', 3, '2025-08-30'),
(7, 'Tarnue P Borbor', '0775577736', 'Lofa', 'Liberian', '1994-10-05', 'Monrovia', 'Lofa', 25, 'New Georgia', 0, '0000-00-00', '', 'Test Father Name', 'Test Mother Name', 'Mary Tarnue ', '0775577736', 'Grand Bassa', 'Liberian', '1994-02-03', 'test birth city', 'Margibi', 23, 'test address', 0, '0000-00-00', '', 'no', 'no', '1760354388_fc09ce40388eae2fdc9a.png', '1760354388_51912f5809449a7da912.jpg', 'New georgia gulf', '2025-10-07', 'lay try', 'test try ', '0775577736', 'test try 2', '0775577736', 30.00, 'thirty dollars', 'jennie', '2025-10-07', '08-25KXG3', 'LF-08-25KXG3', '345', NULL, NULL, NULL, '1751038816_563548c0d2293b4fc4bb.png', NULL, NULL, 4, 1, NULL, '2025-10-15 00:08:38', '2025-10-13 18:19:48', 1, '2025-10-14', NULL, NULL, NULL, NULL),
(8, 'Mark James', '0776077575', 'Gbarpolu', 'Liberian', '2025-10-07', 'Voinjama', 'Lofa', 23, 'New Georgia Gulf ', 1, '2025-10-02', 'Mary ', 'Kammah A. Duwana, Sr', 'Fatumata S.K. Kamara ', 'Princess Kollie', '0776224226', 'River Cess', 'Liberian', '2025-10-31', 'Voinjama', 'Montserrado', 34, 'Newport Street', 0, '0000-00-00', '', 'Dominic Kromah', 'Mariama Konneh', '1760457474_8ad2cb7edfded83697cb.jpg', '1760457474_ed803491deff03e6b1e2.jpg', 'New Georgia Estate', '2025-10-10', 'Princess Abu', 'Moiseleke Duwana', '0886381508', 'Imam Moniru Nyei', '0886886773', 100.00, 'One Hundred Ten United States Dollars', 'Losene F. Bility', '2025-10-15', '08-25VIHM', 'LF-08-25VIHM', '7309556', NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, '2025-10-14 22:57:54', '2025-10-14 22:57:54', NULL, NULL, NULL, NULL, NULL, NULL),
(9, 'Mark James', '0776077577', 'Bomi', 'Liberian', '1999-03-07', 'Tubmanburg', 'Montserrado', 26, 'New Georgia Estate, Montserrado County', 0, '0000-00-00', '', 'Momolu James ', 'Korpo James ', 'Princess Kanneh', '0776224222', 'Lofa', 'Liberian', '2000-10-01', 'Voinjama', 'Lofa', 25, 'Red Light, Paynesville', 0, '0000-00-00', '', 'Dominic Kanneh', 'Mariama Kanneh', '1760648242_8ecf6426e5e1433f9534.png', '1760648242_2e278f438ebf3f48fe33.jpg', 'Tubmanburg ', '2025-10-11', 'Princess K. James', 'Moiseleke Kanneh', '0886381500', 'Imam Moniru Nyei', '0886886773', 50.00, 'Fifty United States Dollars', 'Festus Kamara ', '2025-10-11', '11-25VVX4', 'MT-11-25VVX4', '7309559', NULL, NULL, NULL, NULL, NULL, NULL, 15, 3, NULL, '2025-10-17 03:57:22', '2025-10-17 03:57:22', NULL, NULL, NULL, NULL, NULL, NULL),
(10, 'Tarnue P Borbor', '0775577736', 'Maryland', 'Liberian', '2025-10-16', 'New Georgia Township', 'Montserrado', 68, 'New Georgia Gulf', 1, '2025-10-22', '76', 'Test Father Name', 'Test Mother Name', 'Mary Tarnue ', '0775577736', 'Maryland', 'Liberian', '2025-10-15', 'New Georgia Township', 'River Gee', 56, 'New Georgia Gulf', 0, '0000-00-00', '', 'no', 'no', '1760739490_a23c3552745d651f2d3f.jpg', '1760739490_e971b0317d9b3b23887d.jpg', 'New georgia gulf', '2025-10-28', 'lay try', 'test try ', '0775577736', 'test try 2', '0775577736', 609.00, 'thirty dollars', 'jennie', '2025-10-24', '11-2520K7', 'MT-11-2520K7', '345', NULL, NULL, NULL, NULL, NULL, NULL, 0, 1, NULL, '2025-10-17 22:18:10', '2025-10-17 22:18:10', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notification_table`
--

CREATE TABLE `notification_table` (
  `notificationId` int(11) NOT NULL,
  `commentId` int(225) NOT NULL,
  `notification_userId` int(11) NOT NULL,
  `ENTRY_VIEW` tinyint(1) DEFAULT 0,
  `SIGNA_VIEW` tinyint(1) DEFAULT 0,
  `SIGNB_VIEW` tinyint(1) DEFAULT 0,
  `SIGNC_VIEW` tinyint(1) DEFAULT 0,
  `notification_branch_id` int(11) NOT NULL,
  `date_notified` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notification_table`
--

INSERT INTO `notification_table` (`notificationId`, `commentId`, `notification_userId`, `ENTRY_VIEW`, `SIGNA_VIEW`, `SIGNB_VIEW`, `SIGNC_VIEW`, `notification_branch_id`, `date_notified`) VALUES
(1, 23, 4, 1, 1, 0, 1, 1, '2025-10-15 13:37:39'),
(2, 24, 1, 0, 1, 0, 0, 1, '2025-10-17 21:04:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attached_file_table`
--
ALTER TABLE `attached_file_table`
  ADD PRIMARY KEY (`fileId`);

--
-- Indexes for table `branchs_table`
--
ALTER TABLE `branchs_table`
  ADD PRIMARY KEY (`branchId`);

--
-- Indexes for table `certificate_comments`
--
ALTER TABLE `certificate_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `divorce_certificates`
--
ALTER TABLE `divorce_certificates`
  ADD PRIMARY KEY (`divorceCertId`);

--
-- Indexes for table `login_users`
--
ALTER TABLE `login_users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- Indexes for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  ADD PRIMARY KEY (`marriage_cert_id`);

--
-- Indexes for table `notification_table`
--
ALTER TABLE `notification_table`
  ADD PRIMARY KEY (`notificationId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attached_file_table`
--
ALTER TABLE `attached_file_table`
  MODIFY `fileId` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `branchs_table`
--
ALTER TABLE `branchs_table`
  MODIFY `branchId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `certificate_comments`
--
ALTER TABLE `certificate_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `divorce_certificates`
--
ALTER TABLE `divorce_certificates`
  MODIFY `divorceCertId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_users`
--
ALTER TABLE `login_users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  MODIFY `marriage_cert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notification_table`
--
ALTER TABLE `notification_table`
  MODIFY `notificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
