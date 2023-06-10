-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2023 at 12:37 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsp_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `no_reg` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user_id`, `name`, `signature`, `no_reg`, `created_at`, `updated_at`) VALUES
(1, 3, 'Hisyam Ali', 'public/admin///signature_1672825256_.png', '123456789', '2023-01-04 09:40:56', '2023-01-04 09:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `asesis`
--

CREATE TABLE `asesis` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `prodi_id` int(10) UNSIGNED NOT NULL,
  `nim` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `nik` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `house_phone` varchar(255) DEFAULT NULL,
  `office_phone` varchar(255) DEFAULT NULL,
  `tmpt_lahir` varchar(255) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` enum('p','l') DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `kode_pos` varchar(255) DEFAULT NULL,
  `kebangsaan` varchar(255) DEFAULT NULL,
  `kualifikasi_pendidikan` varchar(255) DEFAULT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `office` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `office_address` varchar(255) DEFAULT NULL,
  `kode_pos_office` varchar(255) DEFAULT NULL,
  `is_filled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asesis`
--

INSERT INTO `asesis` (`id`, `user_id`, `prodi_id`, `nim`, `name`, `nik`, `phone`, `house_phone`, `office_phone`, `tmpt_lahir`, `birth_date`, `gender`, `address`, `kode_pos`, `kebangsaan`, `kualifikasi_pendidikan`, `profile`, `office`, `position`, `office_address`, `kode_pos_office`, `is_filled`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, '2103050', 'Asesi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL),
(2, 5, 1, '2103055', 'Imam Arif', '1111111111111111', '08123456789', '-', '-', 'Indramayu', '2003-05-03', 'l', 'Indramayu', '45140', 'Indonesia', 'SMK', 'public/asesi/2//profile_1672825847_2.jpg', 'SMKN 02 INDRAMAYU', 'Pelajar', 'Indramayu', '45890', 1, NULL, '2023-01-04 09:50:47', NULL),
(3, 6, 1, '2103043', 'Hilyah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `asesment_mandiri`
--

CREATE TABLE `asesment_mandiri` (
  `id` int(10) UNSIGNED NOT NULL,
  `asesi_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `skema_id` int(10) UNSIGNED NOT NULL,
  `unit_kompetensi_id` int(10) UNSIGNED NOT NULL,
  `element_id` int(10) UNSIGNED NOT NULL,
  `kompeten` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `persyaratan_asesi_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asesment_mandiri`
--

INSERT INTO `asesment_mandiri` (`id`, `asesi_id`, `event_id`, `skema_id`, `unit_kompetensi_id`, `element_id`, `kompeten`, `created_at`, `updated_at`, `deleted_at`, `persyaratan_asesi_id`) VALUES
(1, 2, 2, 1, 1, 1, 1, '2023-01-04 09:58:59', '2023-01-04 09:58:59', NULL, 1),
(2, 2, 2, 1, 1, 2, 1, '2023-01-04 09:59:04', '2023-01-04 09:59:04', NULL, 1),
(3, 2, 2, 1, 1, 3, 1, '2023-01-04 09:59:12', '2023-01-04 09:59:12', NULL, 1),
(4, 2, 2, 1, 2, 4, 1, '2023-01-04 09:59:24', '2023-01-04 09:59:24', NULL, 1),
(5, 2, 2, 1, 2, 5, 1, '2023-01-04 10:00:25', '2023-01-04 10:00:25', NULL, 1),
(6, 2, 2, 1, 2, 6, 1, '2023-01-04 10:00:40', '2023-01-04 10:00:40', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `asesment_mandiri_result`
--

CREATE TABLE `asesment_mandiri_result` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_asesi_id` int(10) UNSIGNED NOT NULL,
  `tgl_ttd_asesi` date NOT NULL,
  `tgl_ttd_asesor` date DEFAULT NULL,
  `continue` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asesment_mandiri_result`
--

INSERT INTO `asesment_mandiri_result` (`id`, `skema_asesi_id`, `tgl_ttd_asesi`, `tgl_ttd_asesor`, `continue`, `created_at`, `updated_at`) VALUES
(1, 1, '2023-01-04', '2023-01-04', 1, '2023-01-04 10:04:54', '2023-01-04 10:07:24');

-- --------------------------------------------------------

--
-- Table structure for table `asesors`
--

CREATE TABLE `asesors` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `nik` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `birth_date` date NOT NULL,
  `phone` varchar(255) NOT NULL,
  `profile` varchar(255) DEFAULT NULL,
  `gender` enum('p','l') NOT NULL,
  `address` varchar(255) NOT NULL,
  `reg_number` varchar(255) NOT NULL,
  `blanko_number` varchar(255) NOT NULL,
  `education` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `sertificate` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `expired_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `asesors`
--

INSERT INTO `asesors` (`id`, `user_id`, `nik`, `name`, `birth_date`, `phone`, `profile`, `gender`, `address`, `reg_number`, `blanko_number`, `education`, `profession`, `sertificate`, `start_date`, `expired_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '12343545', 'Hanif', '1995-01-25', '081324770103', NULL, 'p', 'Indrmayu', 'No. Reg. Met.000.007167 2018', '5922222', 'S1 Informatika', 'Guru', NULL, '2021-03-26', '2024-03-26', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ceklis_observasi`
--

CREATE TABLE `ceklis_observasi` (
  `id` int(10) UNSIGNED NOT NULL,
  `asesi_id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `skema_id` int(10) UNSIGNED NOT NULL,
  `unit_kompetensi_id` int(10) UNSIGNED NOT NULL,
  `element_id` int(10) UNSIGNED NOT NULL,
  `unjuk_kerja_id` int(10) UNSIGNED NOT NULL,
  `kompeten` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ceklis_observasi`
--

INSERT INTO `ceklis_observasi` (`id`, `asesi_id`, `event_id`, `skema_id`, `unit_kompetensi_id`, `element_id`, `unjuk_kerja_id`, `kompeten`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, 1, 1, 1, 1, 1, '2023-01-04 10:07:36', '2023-01-04 10:07:43', NULL),
(2, 2, 2, 1, 1, 1, 2, 1, '2023-01-04 10:07:52', '2023-01-04 10:07:52', NULL),
(3, 2, 2, 1, 1, 1, 3, 1, '2023-01-04 10:07:53', '2023-01-04 10:07:53', NULL),
(4, 2, 2, 1, 1, 1, 4, 1, '2023-01-04 10:07:54', '2023-01-04 10:07:54', NULL),
(5, 2, 2, 1, 1, 1, 5, 1, '2023-01-04 10:07:55', '2023-01-04 10:07:55', NULL),
(6, 2, 2, 1, 1, 1, 6, 1, '2023-01-04 10:07:56', '2023-01-04 10:07:56', NULL),
(7, 2, 2, 1, 1, 1, 7, 1, '2023-01-04 10:07:57', '2023-01-04 10:07:57', NULL),
(8, 2, 2, 1, 1, 1, 8, 1, '2023-01-04 10:08:00', '2023-01-04 10:08:00', NULL),
(9, 2, 2, 1, 1, 2, 9, 1, '2023-01-04 10:08:02', '2023-01-04 10:08:02', NULL),
(10, 2, 2, 1, 1, 2, 10, 1, '2023-01-04 10:08:03', '2023-01-04 10:08:03', NULL),
(11, 2, 2, 1, 1, 2, 11, 1, '2023-01-04 10:08:04', '2023-01-04 10:08:04', NULL),
(12, 2, 2, 1, 1, 3, 12, 1, '2023-01-04 10:08:06', '2023-01-04 10:08:06', NULL),
(13, 2, 2, 1, 2, 4, 13, 1, '2023-01-04 10:08:22', '2023-01-04 10:08:22', NULL),
(14, 2, 2, 1, 2, 4, 14, 1, '2023-01-04 10:08:22', '2023-01-04 10:08:22', NULL),
(15, 2, 2, 1, 2, 4, 15, 1, '2023-01-04 10:08:23', '2023-01-04 10:08:23', NULL),
(16, 2, 2, 1, 2, 4, 16, 1, '2023-01-04 10:08:24', '2023-01-04 10:08:24', NULL),
(17, 2, 2, 1, 2, 4, 17, 1, '2023-01-04 10:08:25', '2023-01-04 10:08:25', NULL),
(18, 2, 2, 1, 2, 4, 18, 1, '2023-01-04 10:08:26', '2023-01-04 10:08:26', NULL),
(19, 2, 2, 1, 2, 4, 19, 1, '2023-01-04 10:08:29', '2023-01-04 10:08:29', NULL),
(20, 2, 2, 1, 2, 4, 20, 1, '2023-01-04 10:08:30', '2023-01-04 10:08:30', NULL),
(21, 2, 2, 1, 2, 5, 21, 1, '2023-01-04 10:08:31', '2023-01-04 10:08:31', NULL),
(22, 2, 2, 1, 2, 6, 22, 1, '2023-01-04 10:08:32', '2023-01-04 10:08:32', NULL),
(23, 2, 2, 1, 2, 6, 23, 1, '2023-01-04 10:08:33', '2023-01-04 10:08:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ceklis_observasi_result`
--

CREATE TABLE `ceklis_observasi_result` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_asesi_id` int(10) UNSIGNED NOT NULL,
  `unit_kompetensi` varchar(255) NOT NULL,
  `demonstrasi` tinyint(1) NOT NULL DEFAULT 0,
  `portofolio` tinyint(1) NOT NULL DEFAULT 0,
  `pihak_ketiga` tinyint(1) NOT NULL DEFAULT 0,
  `wawancara` tinyint(1) NOT NULL DEFAULT 0,
  `lisan` tinyint(1) NOT NULL DEFAULT 0,
  `tertulis` tinyint(1) NOT NULL DEFAULT 0,
  `proyek` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ceklis_observasi_result`
--

INSERT INTO `ceklis_observasi_result` (`id`, `skema_asesi_id`, `unit_kompetensi`, `demonstrasi`, `portofolio`, `pihak_ketiga`, `wawancara`, `lisan`, `tertulis`, `proyek`, `created_at`, `updated_at`) VALUES
(1, 1, 'Merencanakan Aktifitas dan proses asesmen', 1, 0, 0, 0, 0, 0, 0, NULL, '2023-01-04 10:09:03'),
(2, 1, 'Melaksanakan Asesmen', 1, 0, 0, 1, 0, 0, 0, NULL, '2023-01-05 07:42:22'),
(3, 1, 'Memberikan kontribusi dalam validasi asesmen', 1, 0, 0, 0, 0, 0, 0, NULL, '2023-01-04 10:08:59');

-- --------------------------------------------------------

--
-- Table structure for table `element`
--

CREATE TABLE `element` (
  `id` int(10) UNSIGNED NOT NULL,
  `unit_kompetensi_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `element`
--

INSERT INTO `element` (`id`, `unit_kompetensi_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Mengkomunikasikan informasi tentang tugas, proses, peristiwa atau keahlian-keahlian ', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(2, 1, 'Berpartisipasi dalam diskusi kelompok untuk mencapai hasil-hasil kerja yang tepat', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(3, 1, 'Mewakili pandangan Kelompok', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(4, 2, 'Mengikuti praktek-praktek kerja yang aman', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(5, 2, 'Melaporkan bahaya-bahaya ditempat kerja', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(6, 2, 'Mengikuti prosedur-prosedur darurat', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` enum('Draft','Waiting','Approved','Unapproved') NOT NULL,
  `qty` int(11) NOT NULL,
  `tuk` varchar(255) NOT NULL,
  `desc` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `skema_id`, `title`, `start_date`, `end_date`, `status`, `qty`, `tuk`, `desc`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Coba dulu', '2023-02-09 07:00:00', '2023-02-09 10:12:00', 'Draft', 20, 'RK. 201', NULL, 1, '2023-01-04 09:42:32', '2023-01-04 09:42:32', NULL),
(2, 1, 'Skema Sertifikasi', '2023-01-01 10:00:00', '2023-02-01 10:00:00', 'Approved', 20, 'Ruang Kelas XII', NULL, 1, '2023-01-04 09:44:19', '2023-01-04 09:44:19', NULL);

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
-- Table structure for table `meninjau_asesmen_notes`
--

CREATE TABLE `meninjau_asesmen_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_asesi_id` int(10) UNSIGNED NOT NULL,
  `komentar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meninjau_asesmen_notes`
--

INSERT INTO `meninjau_asesmen_notes` (`id`, `skema_asesi_id`, `komentar`, `created_at`, `updated_at`) VALUES
(1, 1, 'lorem ipsum', '2023-01-04 10:10:57', '2023-01-04 10:10:57');

-- --------------------------------------------------------

--
-- Table structure for table `meninjau_instrument`
--

CREATE TABLE `meninjau_instrument` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_asesi_id` int(10) UNSIGNED NOT NULL,
  `kegiatan_asesmen` varchar(255) NOT NULL,
  `result` tinyint(1) NOT NULL DEFAULT 0,
  `komentar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `meninjau_instrument`
--

INSERT INTO `meninjau_instrument` (`id`, `skema_asesi_id`, `kegiatan_asesmen`, `result`, `komentar`, `created_at`, `updated_at`) VALUES
(1, 1, 'Instruksi perangkat asesmen dan kondisi asesmen diidentifikasi dengan jelas', 1, NULL, NULL, '2023-01-04 10:09:44'),
(2, 1, 'Informasi tertulis dituliskan secara tepat', 1, NULL, NULL, '2023-01-04 10:10:37'),
(3, 1, 'Kegiatan asesmen mebahas persyaratan bukti untuk kompetensi yang diases', 1, NULL, NULL, '2023-01-04 10:10:33'),
(4, 1, 'Tingkat kesulitan bahasa, literasi, dan berhitung sesuai dengan tingkat unit kompetensi yang dinilai', 1, NULL, NULL, '2023-01-04 10:10:30'),
(5, 1, 'Tingkat kesulitan bahasa, literasi, dan berhitung sesuai dengan tingkat unit kompetensi yang dinilai', 1, NULL, NULL, '2023-01-04 10:10:26'),
(6, 1, 'Tingkat kesulitan kegiatan disesuaikan dengan kompetensi atau kompetensi yang diases', 1, NULL, NULL, '2023-01-04 10:10:16'),
(7, 1, 'Contoh, benchmark dan / atau ceklis asesmen tersedia untuk digunakan dalam pengambilan keputusan asesmen ', 0, NULL, NULL, NULL),
(8, 1, 'Diperlukan modifikasi (seperti yang diidentifikasi dalam komentar)', 1, NULL, NULL, '2023-01-04 10:10:06'),
(9, 1, 'Tugas asesmen siap digunakan', 1, NULL, NULL, '2023-01-04 10:10:02');

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
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_05_08_133357_create_asesor', 1),
(6, '2022_05_09_230711_create_prodi', 1),
(7, '2022_05_10_125135_create_skemas', 1),
(8, '2022_05_13_142550_create_assesis', 1),
(9, '2022_05_31_134102_create_event', 1),
(10, '2022_05_31_134611_create_skema_asesis', 1),
(11, '2022_05_31_135104_create_skema_asesor', 1),
(12, '2022_05_31_140402_create_unit_kompetensi', 1),
(13, '2022_05_31_140701_create_element', 1),
(14, '2022_05_31_141017_create_unjuk_kerja', 1),
(15, '2022_05_31_142053_create_asesment_mandiri', 1),
(16, '2022_05_31_143711_create_ceklis_observasi', 1),
(17, '2022_06_04_101935_create_persyaratan_skema', 1),
(18, '2022_07_12_165851_create_persyaratan_asesi', 1),
(19, '2022_07_16_040242_create_admin', 1),
(20, '2022_07_16_125123_add_admin_skema_asesis', 1),
(21, '2022_07_20_122301_add_persyaratan_asesi', 1),
(22, '2022_07_22_155526_create_asesment_mandiri_result', 1),
(23, '2022_07_29_133650_create_ceklis_observasi_result', 1),
(24, '2022_07_30_134754_create_umpan_balik_notes', 1),
(25, '2022_08_07_143807_create_umpan_balik', 1),
(26, '2022_08_10_000144_create_sertifikat_asesi', 1),
(27, '2022_08_15_055042_create_persetujuan_asesmen', 1),
(28, '2022_08_15_060054_create_meninjau_instrument', 1),
(29, '2022_08_17_143241_create_meninjau_asesmen_notes', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `persetujuan_asesmen`
--

CREATE TABLE `persetujuan_asesmen` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_asesi_id` int(10) UNSIGNED NOT NULL,
  `portofolio` tinyint(1) NOT NULL DEFAULT 0,
  `observasi_langsung` tinyint(1) NOT NULL DEFAULT 0,
  `tes_tulis` tinyint(1) NOT NULL DEFAULT 0,
  `tes_lisan` tinyint(1) NOT NULL DEFAULT 0,
  `wawancara` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persetujuan_asesmen`
--

INSERT INTO `persetujuan_asesmen` (`id`, `skema_asesi_id`, `portofolio`, `observasi_langsung`, `tes_tulis`, `tes_lisan`, `wawancara`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 0, 0, 0, 0, '2023-01-04 10:04:54', '2023-01-04 10:07:19');

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
-- Table structure for table `persyaratan_asesi`
--

CREATE TABLE `persyaratan_asesi` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `skema_id` int(10) UNSIGNED NOT NULL,
  `asesi_id` int(10) UNSIGNED NOT NULL,
  `persyaratan_id` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) NOT NULL,
  `status` enum('Sedang diperiksa','Memenuhi Syarat','Tidak Memenuhi Syarat') NOT NULL DEFAULT 'Sedang diperiksa',
  `desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persyaratan_asesi`
--

INSERT INTO `persyaratan_asesi` (`id`, `event_id`, `skema_id`, `asesi_id`, `persyaratan_id`, `file`, `status`, `desc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 2, 1, 'public/event/2/asesi/2//persyaratan_1672825864_2.jpg', 'Memenuhi Syarat', NULL, '2023-01-04 09:51:04', '2023-01-04 09:52:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `persyaratan_skema`
--

CREATE TABLE `persyaratan_skema` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `persyaratan_skema`
--

INSERT INTO `persyaratan_skema` (`id`, `skema_id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Fotocopy Izajah SMP / Sederajat', '2023-01-04 09:44:19', '2023-01-04 09:44:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'RPL', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sertifikat_asesi`
--

CREATE TABLE `sertifikat_asesi` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_asesi_id` int(10) UNSIGNED NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `sertifikat` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `skemas`
--

CREATE TABLE `skemas` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `nomor` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skemas`
--

INSERT INTO `skemas` (`id`, `name`, `nomor`, `active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Skema Sertifikasi KKNI Level II Pada Kompetensi Keahlian Rekayasa Perangkat Lunak', '47', 1, '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `skema_asesis`
--

CREATE TABLE `skema_asesis` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `asesi_id` int(10) UNSIGNED NOT NULL,
  `asesor_id` int(10) UNSIGNED DEFAULT NULL,
  `ttd_asesor` varchar(255) DEFAULT NULL,
  `tujuan_asesmen` varchar(255) NOT NULL,
  `ttd_asesi` varchar(255) NOT NULL,
  `tgl_ttd_asesi` date NOT NULL,
  `tgl_ttd_admin` date DEFAULT NULL,
  `status` enum('Menunggu Keputusan','Diterima','Tidak Diterima') NOT NULL DEFAULT 'Menunggu Keputusan',
  `skema_status` enum('Kompeten','Belum Kompeten') DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skema_asesis`
--

INSERT INTO `skema_asesis` (`id`, `event_id`, `asesi_id`, `asesor_id`, `ttd_asesor`, `tujuan_asesmen`, `ttd_asesi`, `tgl_ttd_asesi`, `tgl_ttd_admin`, `status`, `skema_status`, `created_at`, `updated_at`, `deleted_at`, `admin_id`) VALUES
(1, 2, 2, 1, 'public/event/2/asesi/2//signature_asesor1672826844_1.png', 'Sertifikasi', 'public/event/2/asesi/2//signature_1672825873_2.png', '2023-01-04', '2023-01-04', 'Diterima', 'Kompeten', '2023-01-04 09:51:13', '2023-01-04 10:09:07', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `skema_asesor`
--

CREATE TABLE `skema_asesor` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `asesor_id` int(10) UNSIGNED NOT NULL,
  `surat_tugas` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `skema_asesor`
--

INSERT INTO `skema_asesor` (`id`, `event_id`, `asesor_id`, `surat_tugas`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, NULL, '2023-01-04 10:06:30', '2023-01-04 10:06:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `umpan_balik`
--

CREATE TABLE `umpan_balik` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_asesi_id` int(10) UNSIGNED NOT NULL,
  `komponen` varchar(255) NOT NULL,
  `hasil` tinyint(1) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `umpan_balik`
--

INSERT INTO `umpan_balik` (`id`, `skema_asesi_id`, `komponen`, `hasil`, `notes`, `created_at`, `updated_at`) VALUES
(1, 1, 'Saya mendapatkan penjelasan yang cukup memadai mengenai proses asesmen/uji kompetensi', NULL, NULL, NULL, NULL),
(2, 1, 'Saya diberikan kesempatan untuk mempelajari standar kompetensi yang akan diujikan dan menilai diri sendiri terhadap pencapaiannya', NULL, NULL, NULL, NULL),
(3, 1, 'Asesor memberikan kesempatan untuk mendiskusikan/menegosiasikan metoda, instrumen dan sumber asesmen serta jadwal asesmen', NULL, NULL, NULL, NULL),
(4, 1, 'Saya sepenuhnya diberikan kesempatan untuk mendemonstrasikan kompetensi yang saya miliki selama asesmen', NULL, NULL, NULL, NULL),
(5, 1, 'Asesor memberikan umpan balik yang mendukung setelah asesmen serta tindak lanjutnya', NULL, NULL, NULL, NULL),
(6, 1, 'Asesor bersama  saya mempelajari semua dokumen asesmen serta menandatanganinya', NULL, NULL, NULL, NULL),
(7, 1, 'Saya mendapatkan jaminan kerahasiaan hasil asesmen serta penjelasan penanganan dokumen asesmen', NULL, NULL, NULL, NULL),
(8, 1, 'Asesor menggunakan keterampilan komunikasi yang efektif selama asesmen', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `umpan_balik_notes`
--

CREATE TABLE `umpan_balik_notes` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_asesi_id` int(10) UNSIGNED NOT NULL,
  `datetime` datetime NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `unit_kompetensi`
--

CREATE TABLE `unit_kompetensi` (
  `id` int(10) UNSIGNED NOT NULL,
  `skema_id` int(10) UNSIGNED NOT NULL,
  `kode` varchar(255) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit_kompetensi`
--

INSERT INTO `unit_kompetensi` (`id`, `skema_id`, `kode`, `judul`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'LOG.OO01.001.01', 'Melakukan Komunikasi Kerja Timbal Balik', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(2, 1, 'LOG.0001.002.01', 'Menerapkan prinsip-prinsip keselamatan dan kesehatan kerja dilingkungan kerja', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unjuk_kerja`
--

CREATE TABLE `unjuk_kerja` (
  `id` int(10) UNSIGNED NOT NULL,
  `element_id` int(10) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unjuk_kerja`
--

INSERT INTO `unjuk_kerja` (`id`, `element_id`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '1.1. Menggunakan teknik komunikasi yang tepat, misalnya telpon, secara langsung, laporan tertulis, sketsa-sketsa dsb', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(2, 1, '1.2. Mengkomunikasikan pengoperasian ganda yang melibatkan beberapa topik/area.', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(3, 1, '1.3. Mendengarkan tanpa terus menerus menginterupsi (memotong) pembicara yang sedang berbicara', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(4, 1, '1.4. Menggunakan pertanyaan-pertanyaan untuk mendapatkan informasi ekstra', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(5, 1, '1.5. Mengenali sumber-sumber informasi yang benar', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(6, 1, '1.6. Memilih dan mengurutkan informasi dengan tepat', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(7, 1, '1.7. Memlakukan laporan lisan dan tertulis', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(8, 1, '1.8. Mendemonstrasikan komunikasi yang baik dalam situasi akrab maupun tidak akrab dan untuk individu dan kelompok yang akrab maupun tidak akrab', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(9, 2, '2.1. Memberikan tanggapan-tanggapan untuk orang-orang dalam kelompok', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(10, 2, '2.2. Membuat kontribusi yang membangun, berkenaan dengan proses produksi terkait.', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(11, 2, '2.3. Mengkomunikasikan cita-cita dan tujuan', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(12, 3, '3.1. Mengerti dan menggambarkan pandangan, pendapat orang lain dengan akurat', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(13, 4, '1.1. Melaksanakan kerja dengan aman sehubungan dengan kebijakan dan prosedur perusahaan serta persyaratan perundang-undangan', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(14, 4, '1.2. Melakukan kegiatan rumah tangga perusahaan sesuai dengan prosedur perusahaan.', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(15, 4, '1.3. Mengerti dan mendemonstrasikan tanggung jawab dan tugas-tugas karyawan dalam kegiatan sehari-hari', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(16, 4, '1.4. Memakai dan menyimpan perlengkapan pelindung diri sesuai dengan prosedur perusahaan', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(17, 4, '1.5. Menggunakan  semua perlengkapan dan alat-alat keselamatan sesuai dengan persyaratan perundang-undangan dan prosedur perusahaan', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(18, 4, '1.6. Mengenali dan mengikuti tanda-tanda/simbol sesuai instruksi', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(19, 4, '1.7. Melaksanakan semua pedoman penanganan sesuai dengan persyaratan, prosedur perusahaan dan pedoman Komisi Kesehatan dan Keselamatan Kerja Nasional yang sah', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(20, 4, '1.8. Mengenali dan mendemonstrasikan  perlengkapan darurat  dengan tepat', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(21, 5, '2.1. Mengenali dan melaporkan bahaya-bahaya di tempat kerja selama waktu kerja kepada orang yang tepat sesuai dengan prosedur pengoperasian standar', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(22, 6, '3.1. Mendemonsrtasikan cara-cara menghubungi personil yang tepat dan layanan darurat jika terjadi kecelakaan', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL),
(23, 6, '3.2. Mengerti dan melaksanakan prosedur kondisi darurat dan evakuasi (pengungsian)', '2023-01-04 09:39:33', '2023-01-04 09:39:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `email_verified_at`, `password`, `role`, `active`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'lspasesor@gmail.com', NULL, '$2y$10$5p1MycIPnWJp5zMk.3367OxvzgTtzt/.hVh4Ni9Gykn4PmM7bR0EO', 'asesor', 1, NULL, NULL, NULL),
(2, 'lspasesi@gmail.com', NULL, '$2y$10$G2sueyFZg03477bsUg0Cu.CjE.cmuHd9jnq3WOJVFSvxU5NJF8KMW', 'asesi', 1, NULL, NULL, NULL),
(3, 'lspadmin@gmail.com', NULL, '$2y$10$d6KjAi4lTWhIz20JHJNTW.ouK0ShoqnzIvgWEux9wsgd.kK/SzUiK', 'admin', 1, NULL, NULL, NULL),
(4, 'lspms@gmail.com', NULL, '$2y$10$pbf3aB8oCEyuQar2v/9TuOCb.lEn8qRhPapcFMD7uwVKIPw5.mz3e', 'ms', 1, NULL, NULL, NULL),
(5, 'imam@gmail.com', NULL, '$2y$10$jmlM3vxxmZuuTQlLwu7yj.0zS7hNafljZpBQWPiani1W6VQ3o8DVe', 'asesi', 1, NULL, NULL, NULL),
(6, 'hilyah@gmail.com', NULL, '$2y$10$77oX9wQaG4YkWR8ZTCcE8OXG9UNmjWuw28VTX6JH.RDsUpexOJUv2', 'asesi', 1, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_user_id_index` (`user_id`);

--
-- Indexes for table `asesis`
--
ALTER TABLE `asesis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asesis_nik_unique` (`nik`),
  ADD KEY `asesis_user_id_index` (`user_id`),
  ADD KEY `asesis_prodi_id_index` (`prodi_id`),
  ADD KEY `asesis_nim_index` (`nim`),
  ADD KEY `asesis_name_index` (`name`);

--
-- Indexes for table `asesment_mandiri`
--
ALTER TABLE `asesment_mandiri`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asesment_mandiri_asesi_id_index` (`asesi_id`),
  ADD KEY `asesment_mandiri_event_id_index` (`event_id`),
  ADD KEY `asesment_mandiri_skema_id_index` (`skema_id`),
  ADD KEY `asesment_mandiri_unit_kompetensi_id_index` (`unit_kompetensi_id`),
  ADD KEY `asesment_mandiri_element_id_index` (`element_id`),
  ADD KEY `asesment_mandiri_persyaratan_asesi_id_index` (`persyaratan_asesi_id`);

--
-- Indexes for table `asesment_mandiri_result`
--
ALTER TABLE `asesment_mandiri_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `asesment_mandiri_result_skema_asesi_id_index` (`skema_asesi_id`);

--
-- Indexes for table `asesors`
--
ALTER TABLE `asesors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `asesors_nik_unique` (`nik`),
  ADD KEY `asesors_user_id_index` (`user_id`),
  ADD KEY `asesors_name_index` (`name`);

--
-- Indexes for table `ceklis_observasi`
--
ALTER TABLE `ceklis_observasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ceklis_observasi_asesi_id_index` (`asesi_id`),
  ADD KEY `ceklis_observasi_event_id_index` (`event_id`),
  ADD KEY `ceklis_observasi_skema_id_index` (`skema_id`),
  ADD KEY `ceklis_observasi_unit_kompetensi_id_index` (`unit_kompetensi_id`),
  ADD KEY `ceklis_observasi_element_id_index` (`element_id`),
  ADD KEY `ceklis_observasi_unjuk_kerja_id_index` (`unjuk_kerja_id`);

--
-- Indexes for table `ceklis_observasi_result`
--
ALTER TABLE `ceklis_observasi_result`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ceklis_observasi_result_skema_asesi_id_index` (`skema_asesi_id`);

--
-- Indexes for table `element`
--
ALTER TABLE `element`
  ADD PRIMARY KEY (`id`),
  ADD KEY `element_unit_kompetensi_id_index` (`unit_kompetensi_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_skema_id_index` (`skema_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `meninjau_asesmen_notes`
--
ALTER TABLE `meninjau_asesmen_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meninjau_asesmen_notes_skema_asesi_id_index` (`skema_asesi_id`);

--
-- Indexes for table `meninjau_instrument`
--
ALTER TABLE `meninjau_instrument`
  ADD PRIMARY KEY (`id`),
  ADD KEY `meninjau_instrument_skema_asesi_id_index` (`skema_asesi_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `persetujuan_asesmen`
--
ALTER TABLE `persetujuan_asesmen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persetujuan_asesmen_skema_asesi_id_index` (`skema_asesi_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `persyaratan_asesi`
--
ALTER TABLE `persyaratan_asesi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persyaratan_asesi_event_id_index` (`event_id`),
  ADD KEY `persyaratan_asesi_skema_id_index` (`skema_id`),
  ADD KEY `persyaratan_asesi_asesi_id_index` (`asesi_id`),
  ADD KEY `persyaratan_asesi_persyaratan_id_index` (`persyaratan_id`);

--
-- Indexes for table `persyaratan_skema`
--
ALTER TABLE `persyaratan_skema`
  ADD PRIMARY KEY (`id`),
  ADD KEY `persyaratan_skema_skema_id_index` (`skema_id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sertifikat_asesi`
--
ALTER TABLE `sertifikat_asesi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sertifikat_asesi_skema_asesi_id_index` (`skema_asesi_id`);

--
-- Indexes for table `skemas`
--
ALTER TABLE `skemas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `skemas_nomor_unique` (`nomor`);

--
-- Indexes for table `skema_asesis`
--
ALTER TABLE `skema_asesis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skema_asesis_event_id_index` (`event_id`),
  ADD KEY `skema_asesis_asesi_id_index` (`asesi_id`),
  ADD KEY `skema_asesis_asesor_id_index` (`asesor_id`),
  ADD KEY `skema_asesis_admin_id_index` (`admin_id`);

--
-- Indexes for table `skema_asesor`
--
ALTER TABLE `skema_asesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `skema_asesor_asesor_id_foreign` (`asesor_id`),
  ADD KEY `skema_asesor_event_id_index` (`event_id`);

--
-- Indexes for table `umpan_balik`
--
ALTER TABLE `umpan_balik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umpan_balik_skema_asesi_id_index` (`skema_asesi_id`);

--
-- Indexes for table `umpan_balik_notes`
--
ALTER TABLE `umpan_balik_notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `umpan_balik_notes_skema_asesi_id_index` (`skema_asesi_id`);

--
-- Indexes for table `unit_kompetensi`
--
ALTER TABLE `unit_kompetensi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_kompetensi_skema_id_index` (`skema_id`);

--
-- Indexes for table `unjuk_kerja`
--
ALTER TABLE `unjuk_kerja`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unjuk_kerja_element_id_index` (`element_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asesis`
--
ALTER TABLE `asesis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `asesment_mandiri`
--
ALTER TABLE `asesment_mandiri`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `asesment_mandiri_result`
--
ALTER TABLE `asesment_mandiri_result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `asesors`
--
ALTER TABLE `asesors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ceklis_observasi`
--
ALTER TABLE `ceklis_observasi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `ceklis_observasi_result`
--
ALTER TABLE `ceklis_observasi_result`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `element`
--
ALTER TABLE `element`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meninjau_asesmen_notes`
--
ALTER TABLE `meninjau_asesmen_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meninjau_instrument`
--
ALTER TABLE `meninjau_instrument`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `persetujuan_asesmen`
--
ALTER TABLE `persetujuan_asesmen`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `persyaratan_asesi`
--
ALTER TABLE `persyaratan_asesi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `persyaratan_skema`
--
ALTER TABLE `persyaratan_skema`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sertifikat_asesi`
--
ALTER TABLE `sertifikat_asesi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `skemas`
--
ALTER TABLE `skemas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skema_asesis`
--
ALTER TABLE `skema_asesis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `skema_asesor`
--
ALTER TABLE `skema_asesor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `umpan_balik`
--
ALTER TABLE `umpan_balik`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `umpan_balik_notes`
--
ALTER TABLE `umpan_balik_notes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unit_kompetensi`
--
ALTER TABLE `unit_kompetensi`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unjuk_kerja`
--
ALTER TABLE `unjuk_kerja`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `asesis`
--
ALTER TABLE `asesis`
  ADD CONSTRAINT `asesis_prodi_id_foreign` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`id`),
  ADD CONSTRAINT `asesis_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `asesment_mandiri`
--
ALTER TABLE `asesment_mandiri`
  ADD CONSTRAINT `asesment_mandiri_asesi_id_foreign` FOREIGN KEY (`asesi_id`) REFERENCES `asesis` (`id`),
  ADD CONSTRAINT `asesment_mandiri_element_id_foreign` FOREIGN KEY (`element_id`) REFERENCES `element` (`id`),
  ADD CONSTRAINT `asesment_mandiri_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `asesment_mandiri_persyaratan_asesi_id_foreign` FOREIGN KEY (`persyaratan_asesi_id`) REFERENCES `persyaratan_asesi` (`id`),
  ADD CONSTRAINT `asesment_mandiri_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`),
  ADD CONSTRAINT `asesment_mandiri_unit_kompetensi_id_foreign` FOREIGN KEY (`unit_kompetensi_id`) REFERENCES `unit_kompetensi` (`id`);

--
-- Constraints for table `asesment_mandiri_result`
--
ALTER TABLE `asesment_mandiri_result`
  ADD CONSTRAINT `asesment_mandiri_result_skema_asesi_id_foreign` FOREIGN KEY (`skema_asesi_id`) REFERENCES `skema_asesis` (`id`);

--
-- Constraints for table `asesors`
--
ALTER TABLE `asesors`
  ADD CONSTRAINT `asesors_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `ceklis_observasi`
--
ALTER TABLE `ceklis_observasi`
  ADD CONSTRAINT `ceklis_observasi_asesi_id_foreign` FOREIGN KEY (`asesi_id`) REFERENCES `asesis` (`id`),
  ADD CONSTRAINT `ceklis_observasi_element_id_foreign` FOREIGN KEY (`element_id`) REFERENCES `element` (`id`),
  ADD CONSTRAINT `ceklis_observasi_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `ceklis_observasi_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`),
  ADD CONSTRAINT `ceklis_observasi_unit_kompetensi_id_foreign` FOREIGN KEY (`unit_kompetensi_id`) REFERENCES `unit_kompetensi` (`id`),
  ADD CONSTRAINT `ceklis_observasi_unjuk_kerja_id_foreign` FOREIGN KEY (`unjuk_kerja_id`) REFERENCES `unjuk_kerja` (`id`);

--
-- Constraints for table `ceklis_observasi_result`
--
ALTER TABLE `ceklis_observasi_result`
  ADD CONSTRAINT `ceklis_observasi_result_skema_asesi_id_foreign` FOREIGN KEY (`skema_asesi_id`) REFERENCES `skema_asesis` (`id`);

--
-- Constraints for table `element`
--
ALTER TABLE `element`
  ADD CONSTRAINT `element_unit_kompetensi_id_foreign` FOREIGN KEY (`unit_kompetensi_id`) REFERENCES `unit_kompetensi` (`id`);

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`);

--
-- Constraints for table `meninjau_asesmen_notes`
--
ALTER TABLE `meninjau_asesmen_notes`
  ADD CONSTRAINT `meninjau_asesmen_notes_skema_asesi_id_foreign` FOREIGN KEY (`skema_asesi_id`) REFERENCES `skema_asesis` (`id`);

--
-- Constraints for table `meninjau_instrument`
--
ALTER TABLE `meninjau_instrument`
  ADD CONSTRAINT `meninjau_instrument_skema_asesi_id_foreign` FOREIGN KEY (`skema_asesi_id`) REFERENCES `skema_asesis` (`id`);

--
-- Constraints for table `persetujuan_asesmen`
--
ALTER TABLE `persetujuan_asesmen`
  ADD CONSTRAINT `persetujuan_asesmen_skema_asesi_id_foreign` FOREIGN KEY (`skema_asesi_id`) REFERENCES `skema_asesis` (`id`);

--
-- Constraints for table `persyaratan_asesi`
--
ALTER TABLE `persyaratan_asesi`
  ADD CONSTRAINT `persyaratan_asesi_asesi_id_foreign` FOREIGN KEY (`asesi_id`) REFERENCES `asesis` (`id`),
  ADD CONSTRAINT `persyaratan_asesi_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `persyaratan_asesi_persyaratan_id_foreign` FOREIGN KEY (`persyaratan_id`) REFERENCES `persyaratan_skema` (`id`),
  ADD CONSTRAINT `persyaratan_asesi_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`);

--
-- Constraints for table `persyaratan_skema`
--
ALTER TABLE `persyaratan_skema`
  ADD CONSTRAINT `persyaratan_skema_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`);

--
-- Constraints for table `sertifikat_asesi`
--
ALTER TABLE `sertifikat_asesi`
  ADD CONSTRAINT `sertifikat_asesi_skema_asesi_id_foreign` FOREIGN KEY (`skema_asesi_id`) REFERENCES `skema_asesis` (`id`);

--
-- Constraints for table `skema_asesis`
--
ALTER TABLE `skema_asesis`
  ADD CONSTRAINT `skema_asesis_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`),
  ADD CONSTRAINT `skema_asesis_asesi_id_foreign` FOREIGN KEY (`asesi_id`) REFERENCES `asesis` (`id`),
  ADD CONSTRAINT `skema_asesis_asesor_id_foreign` FOREIGN KEY (`asesor_id`) REFERENCES `asesors` (`id`),
  ADD CONSTRAINT `skema_asesis_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Constraints for table `skema_asesor`
--
ALTER TABLE `skema_asesor`
  ADD CONSTRAINT `skema_asesor_asesor_id_foreign` FOREIGN KEY (`asesor_id`) REFERENCES `asesors` (`id`),
  ADD CONSTRAINT `skema_asesor_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`);

--
-- Constraints for table `umpan_balik`
--
ALTER TABLE `umpan_balik`
  ADD CONSTRAINT `umpan_balik_skema_asesi_id_foreign` FOREIGN KEY (`skema_asesi_id`) REFERENCES `skema_asesis` (`id`);

--
-- Constraints for table `umpan_balik_notes`
--
ALTER TABLE `umpan_balik_notes`
  ADD CONSTRAINT `umpan_balik_notes_skema_asesi_id_foreign` FOREIGN KEY (`skema_asesi_id`) REFERENCES `skema_asesis` (`id`);

--
-- Constraints for table `unit_kompetensi`
--
ALTER TABLE `unit_kompetensi`
  ADD CONSTRAINT `unit_kompetensi_skema_id_foreign` FOREIGN KEY (`skema_id`) REFERENCES `skemas` (`id`);

--
-- Constraints for table `unjuk_kerja`
--
ALTER TABLE `unjuk_kerja`
  ADD CONSTRAINT `unjuk_kerja_element_id_foreign` FOREIGN KEY (`element_id`) REFERENCES `element` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
