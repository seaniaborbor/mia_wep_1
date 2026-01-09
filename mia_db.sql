-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2025 at 12:36 AM
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
  `certificateFile_category` varchar(20) NOT NULL,
  `fileCertificateId` varchar(225) NOT NULL COMMENT 'fileCreatedAt',
  `fileCreatedBy` int(6) NOT NULL COMMENT 'fileCreatedAt',
  `fileCreatedAt` date NOT NULL COMMENT 'fileCreatedAt',
  `certificateFile` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attached_file_table`
--

INSERT INTO `attached_file_table` (`fileId`, `fileTitle`, `certificateFile_category`, `fileCertificateId`, `fileCreatedBy`, `fileCreatedAt`, `certificateFile`) VALUES
(6, 'Test File and for view', 'marriage', '2', 14, '2025-07-12', '1752362341_5b11ee6d0b9ea4db343c.pdf'),
(8, 'Marriage ', 'marriage', '5', 4, '2025-08-05', '1754394102_2ff04ad01454ecd6b3be.jpg'),
(11, 'Marriage ', 'marriage', '4', 4, '2025-08-29', '1756493630_9be327ff68a918584dc3.jpg'),
(12, 'Marriage ', 'marriage', '4', 4, '2025-08-29', '1756493714_f358d3bd5f060244d562.jpg'),
(13, 'Marriage Receipt ', 'marriage', '6', 4, '2025-08-30', '1756585465_f2d39e5692fefc02eeba.jpg'),
(14, 'Marriage Picture', 'marriage', '6', 4, '2025-08-30', '1756585587_8b61b5f86ba870d2ac1a.jpg'),
(15, 'The file of mrs jame and paul', 'marriage', '6', 1, '2025-08-30', '1756586482_06bddd9e0219f5e074cb.png'),
(16, 'test file', 'marriage', '4', 1, '2025-10-13', '1760352639_642af2a60ede901cc67a.pdf'),
(17, 'Marriage Receipt ', 'marriage', '8', 4, '2025-10-14', '1760457798_2627dd75ed20a9d17550.jpg'),
(18, 'Receipt ', 'marriage', '9', 15, '2025-10-17', '1760660123_3529d14c8ab35401c211.png'),
(19, 'Marriage Receipt ', 'marriage', '9', 15, '2025-10-17', '1760660209_eda3858e8e4ee133643b.png'),
(20, 'Marriage Receipt ', 'marriage', '9', 15, '2025-10-17', '1760661285_0a7647444b0230fdb937.png'),
(24, 'test file', 'divorce_ce', '2', 4, '2025-10-28', '1761668715_aa2eb35c0beefa8e4a78.jpg'),
(26, 'test file', 'traditiona', '8', 3, '2025-10-28', '1761669504_029153db9481f3c98930.jpg'),
(32, 'test file mehn', 'divorce', '3', 3, '2025-10-29', '1761703547_55f11e03205f624ea746.pdf'),
(33, 'test file mehn', 'marriage', '7', 3, '2025-10-29', '1761729979_39bf4898ace2b665319c.png'),
(34, 'test file mehn', 'traditiona', '8', 3, '2025-10-29', '1761739494_1557c2942002fe6e4aa9.png'),
(36, 'test file mehn', 'traditional', '8', 19, '2025-10-30', '1761784986_41beddb3cb6ab29ebcef.png'),
(37, 'test file mehn', 'traditional', '13', 19, '2025-11-01', '1761999261_868416d12b3d915c39b6.docx'),
(39, 'test file mehn', 'marriage', '1', 3, '2025-11-02', '1762079833_6fc15ee18a3d23b477b6.png'),
(40, 'cccc cccc', 'marriage', '1', 3, '2025-11-02', '1762079887_b127a3b22473dd15b537.png'),
(41, 'test file mehn', 'marriage', '1', 3, '2025-11-02', '1762080358_a01521fa31fb383b1679.png'),
(42, 'test file mehn', 'divorce', '1', 4, '2025-11-02', '1762085959_632d50e238786e97539c.png'),
(43, 'test file mehn', 'divorce', '2', 3, '2025-11-02', '1762087695_40c4b9bd1b2b4eb34c61.png'),
(47, 'test file', 'traditional', '1', 17, '2025-11-02', '1762105100_f3c0e9820fb9ec401255.png'),
(48, 'test file mehn', 'traditional', '1', 17, '2025-11-02', '1762105454_39dbb78448a03e2f0a18.png'),
(49, 'test file', 'traditional', '1', 17, '2025-11-02', '1762105574_a129a06c0bc919a1c6c2.png');

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
(1, 'Head Office Branch', 'Montserrado', 'MONROVIA', 'LR-MO258C87F', '0775577736', 'mia@liberia.lra', 1, '1', '2025-07-12 03:36:12');

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
  `divorceupdated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `divorceupdated_by` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `divorce_certificates`
--

INSERT INTO `divorce_certificates` (`divorceCertId`, `divorceRefNo`, `divorceCode`, `divorceRevNo`, `divorceplaintiff`, `divorcedefendant`, `divorcedefendantPic`, `divorceplaintiffPic`, `divorcemarriageDate`, `divorcedateOfDivorce`, `divorceissuanceDate`, `divorceSIGN_A`, `divorceSIGN_A_ID`, `divorceSIGN_A_DATE_SIGNED`, `divorceSIGN_B`, `divorceSIGN_B_ID`, `divorceSIGN_B_DATE_SIGNED`, `divorceSIGN_C`, `divorceSIGN_C_ID`, `divorceSIGN_C_DATE_SIGNED`, `divorcebreanch_id`, `divorcecreated_by`, `divorcecreated_at`, `divorceupdated_at`, `divorceupdated_by`) VALUES
(1, 'MT-11-53E9', 'MIA-11-25-53E9', 'James Jallah', 'Tarnue P Jallah', 'People One', '1762092501_e3164d0410e467479179.jpg', '1762092501_cf462ac98d613418195e.jpg', '2025-11-20', '2025-11-20', '2025-11-28', '1751038816_563548c0d2293b4fc4bb.png', '1', '2025-11-02', '1751040265_347a46b747f7ed344b6d.png', '2', '2025-11-02', '1751059002_d8e91207777fea61d704.png', '3', '2025-11-02', 1, 4, '2025-11-02 14:08:21', '2025-11-02 14:37:45', '1');

-- --------------------------------------------------------

--
-- Table structure for table `login_users`
--

CREATE TABLE `login_users` (
  `userId` int(11) UNSIGNED NOT NULL,
  `userFullName` varchar(255) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPhone` varchar(20) DEFAULT NULL,
  `userPosition` varchar(255) DEFAULT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userPicture` varchar(255) DEFAULT NULL,
  `userBreanch` int(11) DEFAULT NULL,
  `userAccountType` varchar(50) DEFAULT NULL,
  `userSignature` varchar(255) DEFAULT NULL,
  `userApplicationFile` varchar(255) DEFAULT NULL,
  `userAccountActiveStatus` tinyint(1) NOT NULL DEFAULT 0,
  `userAccountActivationCode` varchar(225) DEFAULT NULL,
  `userAccountVerificationCode` varchar(100) DEFAULT NULL,
  `userAccountVerified` tinyint(1) NOT NULL DEFAULT 0,
  `userFailedLoginAttempts` int(11) NOT NULL DEFAULT 0,
  `userLastFailedLogin` datetime DEFAULT NULL,
  `userAccountLockedUntil` datetime DEFAULT NULL,
  `userDepartment` varchar(255) DEFAULT NULL,
  `userCreatedBy` varchar(255) DEFAULT NULL,
  `userDateCreated` datetime DEFAULT NULL,
  `userAccountLastModifiedDate` datetime DEFAULT NULL,
  `userAccountLastModifiedBy` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `login_users`
--

INSERT INTO `login_users` (`userId`, `userFullName`, `userEmail`, `userPhone`, `userPosition`, `userPassword`, `userPicture`, `userBreanch`, `userAccountType`, `userSignature`, `userApplicationFile`, `userAccountActiveStatus`, `userAccountActivationCode`, `userAccountVerificationCode`, `userAccountVerified`, `userFailedLoginAttempts`, `userLastFailedLogin`, `userAccountLockedUntil`, `userDepartment`, `userCreatedBy`, `userDateCreated`, `userAccountLastModifiedDate`, `userAccountLastModifiedBy`) VALUES
(1, 'Tarnue P. Borbor', 'tarnueatalx@gmail.com', '0880123456', 'System Administrator', '$2y$10$0QEO9WhRzszD1QG0jFZCVO62XBeZihiZqEP6RlDPt54bDW0IDIypC', 'tarnue_profile.jpg', 1, 'SIGNC', 'tarnue_signature.png', 'tarnue_application.pdf', 1, NULL, NULL, 1, 0, NULL, NULL, 'IT Department', 'System', '2025-11-23 14:37:19', '2025-11-23 14:37:19', 'System'),
(10, 'Seania Borbor', 'mathematics104@gmail.com', '0774477747', 'Data Entry Clerk', '$2y$10$ZSgD.FvT3MYTadfNPj.EEO0Htz7E.YrWlnjfOQTLnA3RZCGnxAySW', '1764164427_28002add724dd5be9ba7.jpg', 1, 'ENTRY', NULL, '1764164427_f8f556704f158e593527.pdf', 1, NULL, NULL, 1, 0, NULL, NULL, 'Matrimonial', '1', '2025-11-26 13:40:27', NULL, NULL);

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
  `SIGNC_signedDate` date DEFAULT NULL,
  `isWedCertIssued` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marriage_certificates`
--

INSERT INTO `marriage_certificates` (`marriage_cert_id`, `groom_name`, `groom_cell`, `groom_county_of_origin`, `groom_nationality`, `groom_dob`, `groom_birth_city`, `groom_birth_county`, `groom_age`, `groom_address`, `groom_married_before`, `groom_previous_marriage_date`, `groom_previous_spouse_name`, `groom_father_name`, `groom_mother_name`, `bride_name`, `bride_cell`, `bride_county_of_origin`, `bride_nationality`, `bride_dob`, `bride_birth_city`, `bride_birth_county`, `bride_age`, `bride_address`, `bride_married_before`, `bride_previous_marriage_date`, `bride_previous_spouse_name`, `bride_father_name`, `bride_mother_name`, `groom_passport_photo`, `bride_passport_photo`, `place_of_marriage`, `date_of_marriage`, `bride_proposed_name`, `witness_name`, `witness_contact`, `officiator_name`, `officiator_contact`, `certificate_cost`, `certificate_cost_words`, `declarant_name`, `declaration_date`, `reference_no`, `marriage_code`, `revenue_no`, `certification_day`, `certification_month`, `certification_year`, `SIGNA`, `SIGNB`, `SIGNC`, `ENTRY`, `cert_branch`, `last_edited_by`, `last_edited_at`, `created_at`, `SIGNA_id`, `SIGNA_signedDate`, `SIGNB_id`, `SIGNB_signedDate`, `SIGNC_id`, `SIGNC_signedDate`, `isWedCertIssued`) VALUES
(1, 'Tarnue P Borbor', '0775577736', 'Maryland', 'Liberian', '2025-11-14', 'New Georgia Township', 'Margibi', 78, 'New Georgia Gulf', 0, '0000-00-00', '', 'Test Father Name', 'Test Mother Name', 'Mary Tarnue ', '0775577736', 'River Cess', 'Liberian', '2025-11-29', 'New Georgia Township', 'River Gee', 20, 'New Georgia Gulf', 0, '0000-00-00', '', 'test spouse name', 'test mother name', '1762059518_8b6380e503d8e220686b.jpg', '1762059518_8b6380e503d8e220686b.jpg', 'New georgia gulf', '2025-11-13', 'lay try', 'test try ', '0775577736', 'test try 2', '0775577736', 600.00, 'thirty dollars', 'jennie', '2025-11-14', '09-25FFNI', 'MG-09-25FFNI', '7309556', NULL, NULL, NULL, '1751038816_563548c0d2293b4fc4bb.png', '1751040265_347a46b747f7ed344b6d.png', '1751059002_d8e91207777fea61d704.png', 4, 1, '4', '2025-11-02 11:20:29', '2025-11-02 04:58:38', 1, '2025-11-02', 2, '2025-11-02', 3, '2025-11-02', 1),
(2, 'Tarnue P Borbor', '0775577736', 'Montserrado', 'Liberian', '1994-06-24', 'New Georgia Township', 'Nimba', 31, 'New Georgia Gulf', 0, '0000-00-00', '', 'Test Father Name', 'Test Mother Name', 'Mary Tarnue ', '0775577736', 'Nimba', 'Liberian', '1988-01-07', 'New Georgia Township', 'River Gee', 37, 'New Georgia Gulf', 0, '0000-00-00', '', 'test spouse name', 'test mother name', '1762112286_b4e7ed8059bce82d8360.jpg', '1762112286_f55d038cd80bc5b29d2e.jpg', 'New georgia gulf', '2025-11-06', '', 'test try ', '0775577736', 'test try 2', '0775577736', 67.00, 'thirty dollars', 'jennie', '2025-11-04', '12-25HGBK', 'NM-12-25HGBK', '73095576', NULL, NULL, NULL, NULL, NULL, NULL, 4, 1, NULL, '2025-11-02 19:38:06', '2025-11-02 19:38:06', NULL, NULL, NULL, NULL, NULL, NULL, 0),
(3, 'James', '0775577736', 'River Cess', 'Liberian', '2004-09-16', 'Kakata', 'Maryland', 21, 'New Georgia Gulf', 0, '2025-11-12', '', 'Karl', 'Mary', 'Jemmy', '0888610312', 'River Gee', 'Liberian', '2007-11-08', 'Monrovia', 'Montserrado', 18, 'New Georgia Gulf', 0, '0000-00-00', '', 'Jarke', 'Peterline', '1764178696_83040098073e010a3764.jpg', '1764178696_5349e1e591d7041b4a58.jpg', 'Monrovia', '2025-10-02', 'Mary kille', 'Abel Joel', '0775577736', 'James Kollie', '0775577736', 600.00, 'Liberia', 'Princes', '2025-11-19', '10-25Z9K7', 'MY-10-25Z9K7', '6755', NULL, NULL, NULL, NULL, NULL, NULL, 10, 1, NULL, '2025-11-26 17:38:16', '2025-11-26 17:38:16', NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2025-11-23-141721', 'App\\Database\\Migrations\\CreateLoginUsersTable', 'default', 'App', 1763908386, 1);

-- --------------------------------------------------------

--
-- Table structure for table `traditionalcertificates`
--

CREATE TABLE `traditionalcertificates` (
  `tradCertId` int(11) NOT NULL,
  `tradCertSn` varchar(50) NOT NULL,
  `tradCertCevNo` varchar(100) DEFAULT NULL,
  `tradRevenueNo` varchar(100) DEFAULT NULL,
  `tradCertHolderPic` varchar(225) NOT NULL,
  `tradCertHolderName` varchar(255) NOT NULL,
  `tradCertHolderTownorCity` varchar(100) DEFAULT NULL,
  `tradCertHolderDistrict` varchar(100) DEFAULT NULL,
  `tradCertHoldercounty` varchar(100) DEFAULT NULL,
  `tradCertHolderOperationType` varchar(200) DEFAULT NULL,
  `tradCertDateIssued` date DEFAULT NULL,
  `tradCertDuration` int(11) DEFAULT NULL,
  `tradCertSignatoryA` varchar(255) DEFAULT NULL,
  `tradCertSignatoryB` varchar(255) DEFAULT NULL,
  `tradCertSignatoryC` varchar(255) DEFAULT NULL,
  `tradCertInsertedBy` varchar(100) NOT NULL,
  `tradCertAmtPaid` decimal(20,0) NOT NULL,
  `tradCertAppliedType` enum('Online','Clerk Entry') NOT NULL,
  `tradCertBranch` varchar(150) DEFAULT NULL,
  `tradCertCertCreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `tradCertLastUpdatedBy` varchar(100) DEFAULT NULL,
  `tradCertLastUpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `tradCertSignatoryAID` int(20) NOT NULL,
  `tradCertSignatoryADate` int(10) NOT NULL,
  `tradCertSignatoryBID` int(20) NOT NULL,
  `tradCertSignatoryBDate` int(10) NOT NULL,
  `tradCertSignatoryCID` int(20) NOT NULL,
  `tradCertSignatoryCDate` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `traditionalcertificates`
--

INSERT INTO `traditionalcertificates` (`tradCertId`, `tradCertSn`, `tradCertCevNo`, `tradRevenueNo`, `tradCertHolderPic`, `tradCertHolderName`, `tradCertHolderTownorCity`, `tradCertHolderDistrict`, `tradCertHoldercounty`, `tradCertHolderOperationType`, `tradCertDateIssued`, `tradCertDuration`, `tradCertSignatoryA`, `tradCertSignatoryB`, `tradCertSignatoryC`, `tradCertInsertedBy`, `tradCertAmtPaid`, `tradCertAppliedType`, `tradCertBranch`, `tradCertCertCreatedAt`, `tradCertLastUpdatedBy`, `tradCertLastUpdatedAt`, `tradCertSignatoryAID`, `tradCertSignatoryADate`, `tradCertSignatoryBID`, `tradCertSignatoryBDate`, `tradCertSignatoryCID`, `tradCertSignatoryCDate`) VALUES
(1, 'LR-RG-2025-B1D18', 'CEV-ZOB-2025-D18E', '45511', '1762095657_3a2cb2e054adea3a9ee9.jpg', 'Alex Bodoe', 'New Georgia Township', 'Voinjama', 'River Gee', 'zoebah', '2025-11-02', 365, '1761408956_08f0c76f3d76acba15bf.png', '1761424021_c59b11dbd63a3e518eff.png', '1761427488_0ca3cdc211cec87cdb92.png', '19', 87, 'Clerk Entry', '1', '2025-11-02 15:00:57', '16', '2025-11-02 17:51:01', 16, 2025, 17, 2025, 18, 2025);

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
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `traditionalcertificates`
--
ALTER TABLE `traditionalcertificates`
  ADD PRIMARY KEY (`tradCertId`),
  ADD UNIQUE KEY `tradCertSn` (`tradCertSn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attached_file_table`
--
ALTER TABLE `attached_file_table`
  MODIFY `fileId` int(225) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

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
  MODIFY `divorceCertId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_users`
--
ALTER TABLE `login_users`
  MODIFY `userId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `marriage_certificates`
--
ALTER TABLE `marriage_certificates`
  MODIFY `marriage_cert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `traditionalcertificates`
--
ALTER TABLE `traditionalcertificates`
  MODIFY `tradCertId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
