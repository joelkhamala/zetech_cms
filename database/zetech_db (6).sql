-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 25, 2022 at 09:23 PM
-- Server version: 8.0.27
-- PHP Version: 8.1.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zetech_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `certificates`
--

DROP TABLE IF EXISTS `certificates`;
CREATE TABLE IF NOT EXISTS `certificates` (
  `certificate_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `certificate_serial_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int NOT NULL,
  `program_id` int NOT NULL,
  `picked` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not picked',
  `issued_by` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`certificate_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `certificates`
--

INSERT INTO `certificates` (`certificate_id`, `email`, `certificate_serial_number`, `file_name`, `department_id`, `program_id`, `picked`, `issued_by`, `created_at`, `updated_at`) VALUES
(1, 'jusiah@gmail.com', '60270', '1661458653~jusiah@gmail.com-Joel Application letter MedAfrica.docx', 3, 5, 'not picked', '0', '2022-08-25 17:17:33', '2022-08-25 17:17:33'),
(2, 'lisibu@gmail.com', '81785', '1661458657~lisibu@gmail.com-Joel Application letter QuestHoldings.docx', 3, 16, 'not picked', '0', '2022-08-25 17:17:37', '2022-08-25 17:17:37');

-- --------------------------------------------------------

--
-- Table structure for table `clearances`
--

DROP TABLE IF EXISTS `clearances`;
CREATE TABLE IF NOT EXISTS `clearances` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `department` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not cleared',
  `library` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not cleared',
  `finance` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not cleared',
  `gown` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not picked',
  `certTrans` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not picked',
  `gown_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `clearances_department_id_foreign` (`department_id`),
  KEY `clearances_program_id_foreign` (`program_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clearances`
--

INSERT INTO `clearances` (`id`, `email`, `department_id`, `program_id`, `department`, `library`, `finance`, `gown`, `certTrans`, `gown_id`, `created_at`, `updated_at`) VALUES
(1, 'jusiah@gmail.com', 3, 5, 'cleared', 'cleared', 'cleared', 'picked', 'picked', '0', '2022-08-25 15:23:30', '2022-08-25 17:29:15'),
(2, 'lisibu@gmail.com', 3, 16, 'cleared', 'cleared', 'not cleared', 'not picked', 'not picked', '0', '2022-08-25 15:27:53', '2022-08-25 15:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_transcripts`
--

DROP TABLE IF EXISTS `deleted_transcripts`;
CREATE TABLE IF NOT EXISTS `deleted_transcripts` (
  `transcript_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transcript_serial_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int NOT NULL,
  `program_id` int NOT NULL,
  `retrieved` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not retrieved',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transcript_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deleted_transcripts`
--

INSERT INTO `deleted_transcripts` (`transcript_id`, `email`, `transcript_serial_number`, `file_name`, `department_id`, `program_id`, `retrieved`, `created_at`, `updated_at`) VALUES
(1, 'jusiah@gmail.com', '70314', '1661456290~jusiah@gmail.com-Joel Curriculum Vitae (1) (1).pdf', 3, 5, 'not retrieved', '2022-08-25 16:38:14', '2022-08-25 16:38:14'),
(2, 'jusiah@gmail.com', '62319', '1661456290~jusiah@gmail.com-Joel Application letter MedAfrica.docx', 3, 5, 'not retrieved', '2022-08-25 16:40:10', '2022-08-25 16:40:10'),
(3, 'jusiah@gmail.com', '70400', '1661458556~jusiah@gmail.com-Joel Curriculum Vitae (1) (1).pdf', 3, 5, 'not retrieved', '2022-08-25 17:17:43', '2022-08-25 17:17:43');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `department_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`, `created_at`, `updated_at`) VALUES
(1, 'School of Business', '2022-08-25 14:28:11', '2022-08-25 14:28:11'),
(2, 'SCHOOL OF ICT, MEDIA & ENGINEERING', '2022-08-25 14:28:19', '2022-08-25 14:28:19'),
(3, 'School of Hospitality', '2022-08-25 14:29:01', '2022-08-25 14:29:01'),
(4, 'School Of Development Studies', '2022-08-25 14:29:10', '2022-08-25 14:29:10'),
(5, 'Non Teaching Staff', '2022-08-25 14:29:22', '2022-08-25 14:29:22');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fees_data`
--

DROP TABLE IF EXISTS `fees_data`;
CREATE TABLE IF NOT EXISTS `fees_data` (
  `fee_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reason` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fee_id`),
  UNIQUE KEY `fees_data_code_unique` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fees_data`
--

INSERT INTO `fees_data` (`fee_id`, `email`, `amount`, `reason`, `bank`, `code`, `created_at`, `updated_at`) VALUES
(1, 'jusiah@gmail.com', '70000', 'tuition', 'KCB', 'iofjwfhIHWF', '2022-08-25 16:02:05', '2022-08-25 16:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `finances`
--

DROP TABLE IF EXISTS `finances`;
CREATE TABLE IF NOT EXISTS `finances` (
  `finance_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `officer_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `gown_fees` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '5000',
  `school_fees` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '50000',
  `extra_fee` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`finance_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `finances`
--

INSERT INTO `finances` (`finance_id`, `email`, `department_id`, `program_id`, `officer_id`, `gown_fees`, `school_fees`, `extra_fee`, `created_at`, `updated_at`) VALUES
(1, 'jusiah@gmail.com', '3', '5', '6', '0', '0', '15000', '2022-08-25 15:23:30', '2022-08-25 16:02:16'),
(2, 'lisibu@gmail.com', '3', '16', '0', '5000', '50000', '0', '2022-08-25 15:27:53', '2022-08-25 15:27:53');

-- --------------------------------------------------------

--
-- Table structure for table `finance_officers`
--

DROP TABLE IF EXISTS `finance_officers`;
CREATE TABLE IF NOT EXISTS `finance_officers` (
  `officer_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`officer_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gowns`
--

DROP TABLE IF EXISTS `gowns`;
CREATE TABLE IF NOT EXISTS `gowns` (
  `gown_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gown_serial_number` int NOT NULL,
  `condition` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'good',
  `size` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'small',
  `picked` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not picked',
  `returned` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'returned',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`gown_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gowns`
--

INSERT INTO `gowns` (`gown_id`, `email`, `gown_serial_number`, `condition`, `size`, `picked`, `returned`, `created_at`, `updated_at`) VALUES
(1, 'gown@gownsdepartment.com', 487135, 'Well maintained and clean', 'small', 'not picked', 'returned', '2022-08-25 16:08:25', '2022-08-25 16:08:25'),
(2, 'gown@gownsdepartment.com', 347386, 'Well maintained and clean', 'small', 'not picked', 'returned', '2022-08-25 16:08:25', '2022-08-25 16:08:25'),
(3, 'gown@gownsdepartment.com', 969475, 'Well maintained and clean', 'small', 'not picked', 'returned', '2022-08-25 16:08:25', '2022-08-25 16:08:25'),
(4, 'gown@gownsdepartment.com', 495480, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(5, 'gown@gownsdepartment.com', 155314, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(6, 'gown@gownsdepartment.com', 114497, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(7, 'gown@gownsdepartment.com', 914022, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(8, 'gown@gownsdepartment.com', 878868, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(9, 'gown@gownsdepartment.com', 807566, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(10, 'gown@gownsdepartment.com', 912745, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(11, 'gown@gownsdepartment.com', 840454, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(12, 'gown@gownsdepartment.com', 573603, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(13, 'gown@gownsdepartment.com', 870382, 'Good as New', 'medium', 'not picked', 'returned', '2022-08-25 16:08:48', '2022-08-25 16:08:48'),
(14, 'gown@gownsdepartment.com', 248767, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(15, 'gown@gownsdepartment.com', 490122, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(16, 'gown@gownsdepartment.com', 905671, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(17, 'gown@gownsdepartment.com', 235404, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(18, 'gown@gownsdepartment.com', 184194, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(19, 'gown@gownsdepartment.com', 237354, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(20, 'gown@gownsdepartment.com', 104826, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(21, 'jusiah@gmail.com', 117913, 'Well maintained and clean, Brand New', 'large', 'picked', 'not returned', '2022-08-25 16:09:07', '2022-08-25 16:12:08'),
(22, 'gown@gownsdepartment.com', 275549, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(23, 'gown@gownsdepartment.com', 289311, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(24, 'gown@gownsdepartment.com', 885989, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07'),
(25, 'gown@gownsdepartment.com', 618782, 'Well maintained and clean, Brand New', 'large', 'not picked', 'returned', '2022-08-25 16:09:07', '2022-08-25 16:09:07');

-- --------------------------------------------------------

--
-- Table structure for table `h_o_d_s`
--

DROP TABLE IF EXISTS `h_o_d_s`;
CREATE TABLE IF NOT EXISTS `h_o_d_s` (
  `hod_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`hod_id`),
  KEY `h_o_d_s_department_id_foreign` (`department_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `librarians`
--

DROP TABLE IF EXISTS `librarians`;
CREATE TABLE IF NOT EXISTS `librarians` (
  `librarian_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `book_author` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_borrowed` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cleared` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`librarian_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `librarians`
--

INSERT INTO `librarians` (`librarian_id`, `email`, `department_id`, `book_title`, `book_name`, `book_author`, `date_borrowed`, `cleared`, `created_at`, `updated_at`) VALUES
(1, 'jusiah@gmail.com', '3', 'June The Second', '2nd', 'Hunila Manuali', '2022-08-08', 'yes', '2022-08-25 15:43:56', '2022-08-25 15:44:18'),
(2, 'jusiah@gmail.com', '3', 'James Bond', '2022', 'Jackie Chan', '2022-08-01', 'yes', '2022-08-25 15:43:56', '2022-08-25 15:44:19');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `message_subject` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_08_15_061629_create_students_table', 1),
(6, '2022_08_15_063319_create_h_o_d_s_table', 1),
(7, '2022_08_15_063341_create_librarians_table', 1),
(8, '2022_08_15_063410_create_finance_officers_table', 1),
(9, '2022_08_15_063429_create_records_offices_table', 1),
(10, '2022_08_15_063448_create_registrars_table', 1),
(11, '2022_08_15_063559_create_departments_table', 1),
(12, '2022_08_15_064033_create_gowns_table', 1),
(13, '2022_08_15_064108_create_programs_table', 1),
(14, '2022_08_15_071040_create_trials_table', 1),
(15, '2022_08_15_190455_create_roles_table', 1),
(16, '2022_08_16_104744_create_messages_table', 1),
(17, '2022_08_18_113458_create_remarks_table', 1),
(18, '2022_08_19_173003_create_clearances_table', 1),
(19, '2022_08_21_135403_create_finances_table', 1),
(20, '2022_08_21_160512_create_fees_data_table', 1),
(21, '2022_08_23_143647_create_certificates_table', 1),
(22, '2022_08_23_143932_create_transcripts_table', 1),
(23, '2022_08_25_073526_create_deleted_transcripts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

DROP TABLE IF EXISTS `programs`;
CREATE TABLE IF NOT EXISTS `programs` (
  `program_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `program_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_code` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_type` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`program_id`),
  UNIQUE KEY `programs_program_name_unique` (`program_name`),
  UNIQUE KEY `programs_program_code_unique` (`program_code`),
  KEY `programs_department_id_foreign` (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`program_id`, `program_name`, `program_code`, `program_type`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'Bachelor of Business Administration and Management', 'BBAM', 'degree', 1, '2022-08-25 14:29:57', '2022-08-25 14:29:57'),
(2, 'Bachelor of Purchasing and Supply Management', 'BPSM', 'degree', 1, '2022-08-25 14:30:21', '2022-08-25 14:30:21'),
(3, 'Bachelor of Business Information and Technology', 'BBIT', 'degree', 2, '2022-08-25 14:30:45', '2022-08-25 14:30:45'),
(4, 'Bachelor of Science in Information Technology', 'BIT', 'degree', 2, '2022-08-25 14:31:09', '2022-08-25 14:31:09'),
(5, 'Bachelors in Hospitality and Tourism Management', 'BHTM', 'degree', 3, '2022-08-25 14:31:35', '2022-08-25 14:31:35'),
(6, 'Diploma in Entrepreneurship', 'DE', 'diploma', 1, '2022-08-25 14:31:53', '2022-08-25 14:31:53'),
(7, 'Diploma in Banking & Finance', 'DBF', 'diploma', 1, '2022-08-25 14:32:18', '2022-08-25 14:32:18'),
(8, 'Diploma in Accounting and Finance', 'DAF', 'diploma', 1, '2022-08-25 14:32:40', '2022-08-25 14:32:40'),
(9, 'Diploma in Business Management and Administration', 'DBMA', 'diploma', 1, '2022-08-25 14:33:48', '2022-08-25 14:33:48'),
(10, 'Diploma in Marketing', 'DM', 'diploma', 1, '2022-08-25 14:34:13', '2022-08-25 14:34:13'),
(11, 'Diploma in Office Management', 'DOM', 'diploma', 1, '2022-08-25 14:34:43', '2022-08-25 14:34:43'),
(12, 'Diploma in Telecommunications Engineering', 'DTE', 'Diploma', 2, '2022-08-25 14:36:30', '2022-08-25 14:36:47'),
(13, 'Diploma in Information Technology', 'DICT', 'diploma', 2, '2022-08-25 14:37:17', '2022-08-25 14:37:17'),
(14, 'Diploma in Computer Engineering', 'DCE', 'diploma', 2, '2022-08-25 14:37:39', '2022-08-25 14:37:39'),
(15, 'Diploma in Communication and Computer Networks', 'DCCN', 'diploma', 2, '2022-08-25 14:38:09', '2022-08-25 14:38:09'),
(16, 'Diploma in Travel & Tour Guiding Management', 'DTGM', 'diploma', 3, '2022-08-25 14:38:33', '2022-08-25 14:38:33'),
(17, 'Diploma in Tourism Management', 'DTM', 'diploma', 3, '2022-08-25 14:38:49', '2022-08-25 14:38:49'),
(18, 'Diploma in Criminology and Security Studies', 'DCSS', 'diploma', 4, '2022-08-25 14:39:13', '2022-08-25 14:39:13'),
(19, 'Diploma in International Relations and Diplomacy', 'DIRD', 'diploma', 4, '2022-08-25 14:39:34', '2022-08-25 14:39:34'),
(20, 'Diploma in Early Childhood Development and Education', 'DECD', 'certificate', 4, '2022-08-25 14:39:56', '2022-08-25 14:39:56');

-- --------------------------------------------------------

--
-- Table structure for table `records_offices`
--

DROP TABLE IF EXISTS `records_offices`;
CREATE TABLE IF NOT EXISTS `records_offices` (
  `record_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `type_of_file` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number_of_files` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`record_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registrars`
--

DROP TABLE IF EXISTS `registrars`;
CREATE TABLE IF NOT EXISTS `registrars` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

DROP TABLE IF EXISTS `remarks`;
CREATE TABLE IF NOT EXISTS `remarks` (
  `remark_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `remark_title` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  `user_department_id` int NOT NULL,
  `remark_to` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `issue` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`remark_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `role_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', '2022-08-16 20:25:24', '2022-08-16 20:25:24'),
(2, 'HOD', '2022-08-16 20:25:24', '2022-08-16 20:25:24'),
(4, 'Finance Officer', '2022-08-16 20:25:47', '2022-08-16 20:25:47'),
(5, 'Records Officer', '2022-08-16 20:26:04', '2022-08-16 20:26:04'),
(6, 'Librarian', '2022-08-16 20:26:04', '2022-08-16 20:26:04'),
(7, 'Student', '2022-08-16 20:26:13', '2022-08-16 20:26:13');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `student_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middle_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `national_id` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guardianPhone` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admissionNumber` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yearOfAdmission` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program_id` bigint UNSIGNED NOT NULL,
  `confirmed` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not confirmed',
  `department_id` bigint UNSIGNED NOT NULL,
  `status_of_graduation` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not approved',
  `gown_id` int NOT NULL DEFAULT '0',
  `created_by` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `signed` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`student_id`),
  KEY `students_program_id_foreign` (`program_id`),
  KEY `students_department_id_foreign` (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `user_name`, `first_name`, `middle_name`, `last_name`, `email`, `national_id`, `phone`, `guardianPhone`, `admissionNumber`, `yearOfAdmission`, `program_id`, `confirmed`, `department_id`, `status_of_graduation`, `gown_id`, `created_by`, `signed`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Jusiah', 'Jarunda', 'Jamil', 'Jusiah', 'jusiah@gmail.com', '89765436', '0723423152', '0729351429', 'BHTM/4343/2021', '2021-02-25', 5, 'confirmed', 3, 'approved', 21, '0', '0', '$2y$10$XE4geTcDbol9Wa5j3xS78Oe.BiXpopTxc01a.baLT1737sc3BrleG', '2022-08-25 15:23:30', '2022-08-25 16:12:08'),
(2, 'Lisibu', 'Ngugwa', 'Munisi', 'Lisibu', 'lisibu@gmail.com', '95786536', '0723232345', '0745754345', 'DTGM/2363/2020', '2020-01-28', 16, 'confirmed', 3, 'approved', 0, '0', '0', '$2y$10$hcca.jFaYAqwjHJ09Qf0cu6M1.iIq0M.utXc.TpbqgH6ghCgYnE7G', '2022-08-25 15:27:53', '2022-08-25 15:29:39');

-- --------------------------------------------------------

--
-- Table structure for table `transcripts`
--

DROP TABLE IF EXISTS `transcripts`;
CREATE TABLE IF NOT EXISTS `transcripts` (
  `transcript_id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `transcript_serial_number` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int NOT NULL,
  `program_id` int NOT NULL,
  `picked` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'not picked',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`transcript_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transcripts`
--

INSERT INTO `transcripts` (`transcript_id`, `email`, `transcript_serial_number`, `file_name`, `department_id`, `program_id`, `picked`, `created_at`, `updated_at`) VALUES
(1, 'jusiah@gmail.com', '68123', '1661458556~jusiah@gmail.com-Joel Application letter QuestHoldings.pdf', 3, 5, 'not picked', '2022-08-25 17:15:56', '2022-08-25 17:15:56'),
(2, 'jusiah@gmail.com', '90758', '1661458556~jusiah@gmail.com-Joel Application letter QuestHoldings.docx', 3, 5, 'not picked', '2022-08-25 17:15:56', '2022-08-25 17:15:56'),
(3, 'jusiah@gmail.com', '64985', '1661458556~jusiah@gmail.com-Joel Application letter MedAfrica.docx', 3, 5, 'not picked', '2022-08-25 17:15:56', '2022-08-25 17:15:56'),
(5, 'lisibu@gmail.com', '10702', '1661458563~lisibu@gmail.com-Joel Application letter QuestHoldings.pdf', 3, 16, 'not picked', '2022-08-25 17:16:03', '2022-08-25 17:16:03'),
(6, 'lisibu@gmail.com', '76585', '1661458563~lisibu@gmail.com-Joel Application letter QuestHoldings.docx', 3, 16, 'not picked', '2022-08-25 17:16:03', '2022-08-25 17:16:03'),
(7, 'lisibu@gmail.com', '48612', '1661458563~lisibu@gmail.com-Joel Application letter MedAfrica.docx', 3, 16, 'not picked', '2022-08-25 17:16:03', '2022-08-25 17:16:03');

-- --------------------------------------------------------

--
-- Table structure for table `trials`
--

DROP TABLE IF EXISTS `trials`;
CREATE TABLE IF NOT EXISTS `trials` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_name` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_id` bigint UNSIGNED NOT NULL,
  `department_id` bigint UNSIGNED NOT NULL,
  `email` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logged_once` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_department_id_foreign` (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `user_name`, `role_id`, `department_id`, `email`, `email_verified_at`, `password`, `logged_once`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Joel', 'Khamala', 'Kham', 1, 0, 'jwanyoa@gmail.com', NULL, '$2y$10$cWkD.a7ze0E0vHCjjg9LXOk.ZXIIpj02ACwIuuQgQ.xxfdxYOQdYy', '0', NULL, '2022-08-25 14:27:34', '2022-08-25 14:27:34'),
(2, 'Paul', 'Makini', 'Makini', 2, 1, 'makini@zetech.com', NULL, '$2y$10$i2Hyi/yDaHmJ3il.U7Ope.pbBVR9yI/QNLxJvYWGHxeQTg.zciEpO', '0', NULL, '2022-08-25 14:41:12', '2022-08-25 14:41:12'),
(3, 'Jamila', 'Janet', 'Janet', 2, 3, 'janet@zetech.ac.ke', NULL, '$2y$10$8hB7eNipTSfhgEJsBGDc8.4HzamxRE8U9flTUuFkT3ifShhCHiKmK', '1', NULL, '2022-08-25 14:42:13', '2022-08-25 18:21:27'),
(4, 'James', 'Muliuri', 'Muliuri', 2, 2, 'james@gmail.com', NULL, '$2y$10$pN8r/4mWQfk5ReHjs/1GPelsG7L6z/xfnlwECJftWLWkg0TWqHV1.', '1', NULL, '2022-08-25 14:42:47', '2022-08-25 18:19:28'),
(5, 'Kirui', 'Kiplong', 'Kiplong', 2, 4, 'kiplong@gmail.com', NULL, '$2y$10$Dyy74bRn41P5w7NJXRYiY.7Ri34LgqQoQB0yiwtjAyZTqbpSluRZC', '0', NULL, '2022-08-25 14:54:48', '2022-08-25 14:54:48'),
(6, 'Karimi', 'Misila', 'Musila', 4, 5, 'karimi@gmail.com', NULL, '$2y$10$4FvfOVbDQLXMrvNMdqmRQuYtzM8jDKVAmcSytPVZy8zuAhNlexiNm', '1', NULL, '2022-08-25 15:16:01', '2022-08-25 17:30:23'),
(7, 'Salandar', 'Jusin', 'Jusin', 5, 5, 'jusin@gmail.com', NULL, '$2y$10$OqNw.gtf7vP4myXw4K7i.eFT4DyFQo74H4LqQWFU4lJIdSYFk6ewa', '1', NULL, '2022-08-25 15:20:23', '2022-08-25 18:13:02'),
(8, 'Librian', 'Labonda', 'Librian', 6, 5, 'librian@gmail.com', NULL, '$2y$10$tlq1eyxEZndIrTyBcW7.9ufdeWhECNTgvV2n1PYYR6tc6dLia4bHO', '1', NULL, '2022-08-25 15:21:04', '2022-08-25 15:37:09'),
(9, 'Jarunda', 'Jusiah', 'Jusiah', 7, 3, 'jusiah@gmail.com', NULL, '$2y$10$qcy1Dp6CHUKhNVexZ/fNweNAH5EUCp85TEHE9jJlEbD/pTsNuSXeq', '1', NULL, '2022-08-25 15:23:30', '2022-08-25 15:41:27'),
(10, 'Ngugwa', 'Lisibu', 'Lisibu', 7, 3, 'lisibu@gmail.com', NULL, '$2y$10$CynIwq9FLMVqBQ/PsHUdc.jKvudIxkh5ZkS9q3N7Y1wCSkIJ83P0.', '1', NULL, '2022-08-25 15:27:53', '2022-08-25 15:28:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
