-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2025 at 02:20 PM
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
-- Database: `sipandhu`
--

-- --------------------------------------------------------

--
-- Table structure for table `bap_dokumen`
--

CREATE TABLE `bap_dokumen` (
  `id` int(11) NOT NULL,
  `berita_acara_id` int(11) NOT NULL,
  `jenis_dokumen` enum('berita_acara') NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bap_dokumen`
--

INSERT INTO `bap_dokumen` (`id`, `berita_acara_id`, `jenis_dokumen`, `nama_file`, `path_file`, `created_at`, `updated_at`) VALUES
(28, 55, 'berita_acara', '6fc92c54ef327eb2a88644ca68b7597f.pdf', '', '2025-06-04 09:10:35', '2025-06-04 09:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `berita_acara`
--

CREATE TABLE `berita_acara` (
  `id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `no_bap` varchar(225) NOT NULL,
  `jenis_pengajuan` enum('dd_earmark_60','alokasi_dana_desa','dana_lain','dd_non_earmark_40','ketahanan_pangan_tpk','ketahanan_pangan_bumdesa') NOT NULL,
  `status` enum('pending','diterima','ditolak') DEFAULT 'pending',
  `jumlah_bantuan` decimal(15,2) DEFAULT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_verifikasi` timestamp NULL DEFAULT NULL,
  `verifikator_id` int(11) DEFAULT NULL,
  `no_pengajuan` varchar(225) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `berita_acara`
--

INSERT INTO `berita_acara` (`id`, `desa_id`, `no_bap`, `jenis_pengajuan`, `status`, `jumlah_bantuan`, `tanggal_pengajuan`, `tanggal_verifikasi`, `verifikator_id`, `no_pengajuan`, `catatan`, `created_at`, `updated_at`) VALUES
(55, 232, '633/010/401/2025', 'alokasi_dana_desa', '', 12000000000.00, '2025-06-04 04:10:35', NULL, NULL, '704/232/010/2025', NULL, '2025-06-04 09:10:35', '2025-06-04 09:10:35');

-- --------------------------------------------------------

--
-- Table structure for table `dana_lain`
--

CREATE TABLE `dana_lain` (
  `id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `jenis_pengajuan` enum('dana_desa','alokasi_dana_desa','dana_lain','pades') NOT NULL,
  `status` enum('pending','diterima','ditolak') DEFAULT 'pending',
  `jumlah_bantuan` decimal(15,2) DEFAULT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_verifikasi` timestamp NULL DEFAULT NULL,
  `verifikator_id` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dana_lain`
--

INSERT INTO `dana_lain` (`id`, `desa_id`, `jenis_pengajuan`, `status`, `jumlah_bantuan`, `tanggal_pengajuan`, `tanggal_verifikasi`, `verifikator_id`, `catatan`, `created_at`, `updated_at`) VALUES
(1, 3, 'dana_desa', 'pending', 25000.00, '2025-06-01 03:24:52', '2025-06-17 03:24:23', 1, 'asdadsa', '2025-06-01 03:24:52', '2025-06-01 03:24:52');

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id` int(11) NOT NULL,
  `kecamatan_id` int(11) NOT NULL,
  `nama_desa` varchar(255) NOT NULL,
  `nama_kepala_desa` varchar(255) DEFAULT NULL,
  `no_kontak_kades` varchar(50) DEFAULT NULL,
  `nama_bank` varchar(100) DEFAULT NULL,
  `no_rekening` varchar(100) DEFAULT NULL,
  `alamat` varchar(225) NOT NULL,
  `jabatan` varchar(225) NOT NULL,
  `kode_desa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`id`, `kecamatan_id`, `nama_desa`, `nama_kepala_desa`, `no_kontak_kades`, `nama_bank`, `no_rekening`, `alamat`, `jabatan`, `kode_desa`) VALUES
(232, 2, 'Soa-Sio', 'ikul', '32131321', 'bca', '0224525254', 'jl. tanjung', 'sekretaris', 401),
(233, 2, 'Pune', 'olik', '08432143242', 'bri', '022323232', 'jl. media', 'kadis', 402),
(234, 2, 'Mamuya', NULL, NULL, NULL, NULL, 'Mamuya', 'Kepala Desa Mamuya', 403),
(235, 2, 'Toweka', NULL, NULL, NULL, NULL, 'Toweka', 'Kepala Desa Toweka', 416),
(236, 2, 'Simau', NULL, NULL, NULL, NULL, 'Simau', 'Kepala Desa Simau', 424),
(237, 2, 'Barataku', NULL, NULL, NULL, NULL, 'Barataku', 'Kepala Desa Barataku', 431),
(238, 2, 'Towara', NULL, NULL, NULL, NULL, 'Towara', 'Kepala Desa Towara', 432),
(239, 6, 'Gamsungi', NULL, NULL, NULL, NULL, 'Gamsungi', 'Kepala Desa Gamsungi', 504),
(240, 6, 'Gura', NULL, NULL, NULL, NULL, 'Gura', 'Kepala Desa Gura', 505),
(241, 6, 'Wari', NULL, NULL, NULL, NULL, 'Wari', 'Kepala Desa Wari', 506),
(242, 6, 'Kakara', NULL, NULL, NULL, NULL, 'Kakara', 'Kepala Desa Kakara', 512),
(243, 6, 'Kumo', NULL, NULL, NULL, NULL, 'Kumo', 'Kepala Desa Kumo', 513),
(244, 6, 'Gosoma', NULL, NULL, NULL, NULL, 'Gosoma', 'Kepala Desa Gosoma', 514),
(245, 6, 'Rawajaya', NULL, NULL, NULL, NULL, 'Rawajaya', 'Kepala Desa Rawajaya', 515),
(246, 6, 'MKCM', NULL, NULL, NULL, NULL, 'MKCM', 'Kepala Desa MKCM', 518),
(247, 6, 'Tagalaya', NULL, NULL, NULL, NULL, 'Tagalaya', 'Kepala Desa Tagalaya', 524),
(248, 6, 'Wari Ino', NULL, NULL, NULL, NULL, 'Wari Ino', 'Kepala Desa Wari Ino', 525),
(249, 7, 'Kupa Kupa', NULL, NULL, NULL, NULL, 'Kupa Kupa', 'Kepala Desa Kupa Kupa', 601),
(250, 7, 'Gamhoku', NULL, NULL, NULL, NULL, 'Gamhoku', 'Kepala Desa Gamhoku', 602),
(251, 7, 'Efi Efi', NULL, NULL, NULL, NULL, 'Efi Efi', 'Kepala Desa Efi Efi', 603),
(252, 7, 'Tomahalu', NULL, NULL, NULL, NULL, 'Tomahalu', 'Kepala Desa Tomahalu', 604),
(253, 7, 'Paca', NULL, NULL, NULL, NULL, 'Paca', 'Kepala Desa Paca', 605),
(254, 7, 'Leleoto', NULL, NULL, NULL, NULL, 'Leleoto', 'Kepala Desa Leleoto', 606),
(255, 7, 'Tobe', NULL, NULL, NULL, NULL, 'Tobe', 'Kepala Desa Tobe', 609),
(256, 7, 'Kakara B', NULL, NULL, NULL, NULL, 'Kakara B', 'Kepala Desa Kakara B', 615),
(257, 7, 'Talaga Paca', NULL, NULL, NULL, NULL, 'Talaga Paca', 'Kepala Desa Talaga Paca', 6018),
(258, 7, 'Tioua', NULL, NULL, NULL, NULL, 'Tioua', 'Kepala Desa Tioua', 620),
(259, 7, 'Pale', NULL, NULL, NULL, NULL, 'Pale', 'Kepala Desa Pale', 621),
(260, 7, 'Kupa-kupa Selatan (Halehe)', NULL, NULL, NULL, NULL, 'Kupa-kupa Selatan (Halehe)', 'Kepala Desa Kupa-kupa Selatan (Halehe)', 622),
(261, 7, 'Lemah Ino', NULL, NULL, NULL, NULL, 'Lemah Ino', 'Kepala Desa Lemah Ino', 624),
(262, 8, 'Kao', NULL, NULL, NULL, NULL, 'Kao', 'Kepala Desa Kao', 701),
(263, 8, 'Jati', NULL, NULL, NULL, NULL, 'Jati', 'Kepala Desa Jati', 702),
(264, 8, 'Kusu', NULL, NULL, NULL, NULL, 'Kusu', 'Kepala Desa Kusu', 703),
(265, 8, 'Waringin Lelewi', NULL, NULL, NULL, NULL, 'Waringin Lelewi', 'Kepala Desa Waringin Lelewi', 709),
(266, 8, 'Soa Sangaji Dim-Dim', NULL, NULL, NULL, NULL, 'Soa Sangaji Dim-Dim', 'Kepala Desa Soa Sangaji Dim-Dim', 710),
(267, 8, 'Sasur', NULL, NULL, NULL, NULL, 'Sasur', 'Kepala Desa Sasur', 711),
(268, 8, 'Popon', NULL, NULL, NULL, NULL, 'Popon', 'Kepala Desa Popon', 712),
(269, 8, 'Biang', NULL, NULL, NULL, NULL, 'Biang', 'Kepala Desa Biang', 736),
(270, 8, 'Patang', NULL, NULL, NULL, NULL, 'Patang', 'Kepala Desa Patang', 737),
(271, 8, 'Kukumutuk', NULL, NULL, NULL, NULL, 'Kukumutuk', 'Kepala Desa Kukumutuk', 738),
(272, 8, 'Waringin Lamo', NULL, NULL, NULL, NULL, 'Waringin Lamo', 'Kepala Desa Waringin Lamo', 739),
(273, 8, 'Goruang', NULL, NULL, NULL, NULL, 'Goruang', 'Kepala Desa Goruang', 750),
(274, 8, 'Kusu Lofra', NULL, NULL, NULL, NULL, 'Kusu Lofra', 'Kepala Desa Kusu Lofra', 751),
(275, 8, 'Sumber Agung', NULL, NULL, NULL, NULL, 'Sumber Agung', 'Kepala Desa Sumber Agung', 752),
(276, 9, 'Ngofa Kiaha', NULL, NULL, NULL, NULL, 'Ngofa Kiaha', 'Kepala Desa Ngofa Kiaha', 801),
(277, 9, 'Ngofa Gita', NULL, NULL, NULL, NULL, 'Ngofa Gita', 'Kepala Desa Ngofa Gita', 802),
(278, 9, 'Samsuma', NULL, NULL, NULL, NULL, 'Samsuma', 'Kepala Desa Samsuma', 803),
(279, 9, 'Tahane', NULL, NULL, NULL, NULL, 'Tahane', 'Kepala Desa Tahane', 804),
(280, 9, 'Matsa', NULL, NULL, NULL, NULL, 'Matsa', 'Kepala Desa Matsa', 805),
(281, 9, 'Bobawa', NULL, NULL, NULL, NULL, 'Bobawa', 'Kepala Desa Bobawa', 807),
(282, 9, 'Talapao', NULL, NULL, NULL, NULL, 'Talapao', 'Kepala Desa Talapao', 808),
(283, 9, 'Tafasoho', NULL, NULL, NULL, NULL, 'Tafasoho', 'Kepala Desa Tafasoho', 809),
(284, 9, 'Sabaleh', NULL, NULL, NULL, NULL, 'Sabaleh', 'Kepala Desa Sabaleh', 810),
(285, 9, 'Tagono', NULL, NULL, NULL, NULL, 'Tagono', 'Kepala Desa Tagono', 811),
(286, 9, 'Soma', NULL, NULL, NULL, NULL, 'Soma', 'Kepala Desa Soma', 812),
(287, 9, 'Ngofa Bobawa', NULL, NULL, NULL, NULL, 'Ngofa Bobawa', 'Kepala Desa Ngofa Bobawa', 813),
(288, 9, 'Malapa', NULL, NULL, NULL, NULL, 'Malapa', 'Kepala Desa Malapa', 814),
(289, 9, 'Mailoa', NULL, NULL, NULL, NULL, 'Mailoa', 'Kepala Desa Mailoa', 815),
(290, 9, 'Peleri', NULL, NULL, NULL, NULL, 'Peleri', 'Kepala Desa Peleri', 816),
(291, 9, 'Bukit Tinggi', NULL, NULL, NULL, NULL, 'Bukit Tinggi', 'Kepala Desa Bukit Tinggi', 819),
(292, 9, 'Terpadu', NULL, NULL, NULL, NULL, 'Terpadu', 'Kepala Desa Terpadu', 822),
(293, 9, 'Tabobo', NULL, NULL, NULL, NULL, 'Tabobo', 'Kepala Desa Tabobo', 823),
(294, 9, 'Balisosang', NULL, NULL, NULL, NULL, 'Balisosang', 'Kepala Desa Balisosang', 824),
(295, 9, 'Sosol/Malifut', NULL, NULL, NULL, NULL, 'Sosol/Malifut', 'Kepala Desa Sosol/Malifut', 825),
(296, 9, 'Wangeotek', NULL, NULL, NULL, NULL, 'Wangeotek', 'Kepala Desa Wangeotek', 826),
(297, 9, 'Gayok', NULL, NULL, NULL, NULL, 'Gayok', 'Kepala Desa Gayok', 827),
(298, 10, 'Dorume', NULL, NULL, NULL, NULL, 'Dorume', 'Kepala Desa Dorume', 901),
(299, 10, 'Apule', NULL, NULL, NULL, NULL, 'Apule', 'Kepala Desa Apule', 902),
(300, 10, 'Asimiro', NULL, NULL, NULL, NULL, 'Asimiro', 'Kepala Desa Asimiro', 903),
(301, 10, 'Doitia', NULL, NULL, NULL, NULL, 'Doitia', 'Kepala Desa Doitia', 904),
(302, 10, 'Ngajam', NULL, NULL, NULL, NULL, 'Ngajam', 'Kepala Desa Ngajam', 905),
(303, 10, 'Kailupa', NULL, NULL, NULL, NULL, 'Kailupa', 'Kepala Desa Kailupa', 906),
(304, 10, 'Gisik', NULL, NULL, NULL, NULL, 'Gisik', 'Kepala Desa Gisik', 907),
(305, 10, 'Kapa Kapa', NULL, NULL, NULL, NULL, 'Kapa Kapa', 'Kepala Desa Kapa Kapa', 908),
(306, 10, 'Pacao', NULL, NULL, NULL, NULL, 'Pacao', 'Kepala Desa Pacao', 909),
(307, 10, 'Tate', NULL, NULL, NULL, NULL, 'Tate', 'Kepala Desa Tate', 910),
(308, 10, 'Posi- Posi', NULL, NULL, NULL, NULL, 'Posi- Posi', 'Kepala Desa Posi- Posi', 911),
(309, 10, 'Supu', NULL, NULL, NULL, NULL, 'Supu', 'Kepala Desa Supu', 912),
(310, 10, 'Igo', NULL, NULL, NULL, NULL, 'Igo', 'Kepala Desa Igo', 922),
(311, 10, 'Galao', NULL, NULL, NULL, NULL, 'Galao', 'Kepala Desa Galao', 923),
(312, 10, 'Teru-Teru', NULL, NULL, NULL, NULL, 'Teru-Teru', 'Kepala Desa Teru-Teru', 924),
(313, 10, 'Wori Moi', NULL, NULL, NULL, NULL, 'Wori Moi', 'Kepala Desa Wori Moi', 926),
(314, 10, 'Podol', NULL, NULL, NULL, NULL, 'Podol', 'Kepala Desa Podol', 927),
(315, 10, 'Momojiu', NULL, NULL, NULL, NULL, 'Momojiu', 'Kepala Desa Momojiu', 928),
(316, 11, 'Gorua', NULL, NULL, NULL, NULL, 'Gorua', 'Kepala Desa Gorua', 1001),
(317, 11, 'Popilo', NULL, NULL, NULL, NULL, 'Popilo', 'Kepala Desa Popilo', 1002),
(318, 11, 'Luari', NULL, NULL, NULL, NULL, 'Luari', 'Kepala Desa Luari', 1003),
(319, 11, 'Popilo Utara', NULL, NULL, NULL, NULL, 'Popilo Utara', 'Kepala Desa Popilo Utara', 1004),
(320, 11, 'Tolonuo', NULL, NULL, NULL, NULL, 'Tolonuo', 'Kepala Desa Tolonuo', 1005),
(321, 11, 'Gorua Selatan', NULL, NULL, NULL, NULL, 'Gorua Selatan', 'Kepala Desa Gorua Selatan', 1006),
(322, 11, 'Gorua Utara', NULL, NULL, NULL, NULL, 'Gorua Utara', 'Kepala Desa Gorua Utara', 1007),
(323, 11, 'Kokota Jaya', NULL, NULL, NULL, NULL, 'Kokota Jaya', 'Kepala Desa Kokota Jaya', 1008),
(324, 11, 'Ruko', NULL, NULL, NULL, NULL, 'Ruko', 'Kepala Desa Ruko', 1009),
(325, 11, 'Tolonua Selatan', NULL, NULL, NULL, NULL, 'Tolonua Selatan', 'Kepala Desa Tolonua Selatan', 1010),
(326, 12, 'Upa', NULL, NULL, NULL, NULL, 'Upa', 'Kepala Desa Upa', 1101),
(327, 12, 'Pitu', NULL, NULL, NULL, NULL, 'Pitu', 'Kepala Desa Pitu', 1102),
(328, 12, 'Wosia', NULL, NULL, NULL, NULL, 'Wosia', 'Kepala Desa Wosia', 1103),
(329, 12, 'WKO', NULL, NULL, NULL, NULL, 'WKO', 'Kepala Desa WKO', 1104),
(330, 12, 'Kalipitu', NULL, NULL, NULL, NULL, 'Kalipitu', 'Kepala Desa Kalipitu', 1105),
(331, 12, 'Kali Upa', NULL, NULL, NULL, NULL, 'Kali Upa', 'Kepala Desa Kali Upa', 1106),
(332, 12, 'Lina Ino', NULL, NULL, NULL, NULL, 'Lina Ino', 'Kepala Desa Lina Ino', 1107),
(333, 12, 'Mahia (Wosia Tengah)', NULL, NULL, NULL, NULL, 'Mahia (Wosia Tengah)', 'Kepala Desa Mahia (Wosia Tengah)', 1108),
(334, 12, 'Tanjung Niara (Wosia Selatan)', NULL, NULL, NULL, NULL, 'Tanjung Niara (Wosia Selatan)', 'Kepala Desa Tanjung Niara (Wosia Selatan)', 1109),
(335, 13, 'Yaro', 'iman', '0812313214124', 'bca', '231321555', 'jl. tanjung', 'sekretaris', 1201),
(336, 13, 'Mawea', NULL, NULL, NULL, NULL, 'Mawea', 'Kepala Desa Mawea', 1202),
(337, 13, 'Meti', NULL, NULL, NULL, NULL, 'Meti', 'Kepala Desa Meti', 1203),
(338, 13, 'Katana', NULL, NULL, NULL, NULL, 'Katana', 'Kepala Desa Katana', 1204),
(339, 13, 'Gonga', NULL, NULL, NULL, NULL, 'Gonga', 'Kepala Desa Gonga', 1205),
(340, 13, 'Todokuiha', NULL, NULL, NULL, NULL, 'Todokuiha', 'Kepala Desa Todokuiha', 1206),
(341, 13, 'Magaliho', NULL, NULL, NULL, NULL, 'Magaliho', 'Kepala Desa Magaliho', 1207),
(342, 14, 'Kusuri', NULL, NULL, NULL, NULL, 'Kusuri', 'Kepala Desa Kusuri', 1301),
(343, 14, 'Sukamaju', NULL, NULL, NULL, NULL, 'Sukamaju', 'Kepala Desa Sukamaju', 1302),
(344, 14, 'Togoliua', NULL, NULL, NULL, NULL, 'Togoliua', 'Kepala Desa Togoliua', 1303),
(345, 14, 'Birinoa', NULL, NULL, NULL, NULL, 'Birinoa', 'Kepala Desa Birinoa', 1304),
(346, 14, 'Wangongira', NULL, NULL, NULL, NULL, 'Wangongira', 'Kepala Desa Wangongira', 1305),
(347, 14, 'Hero Ino', NULL, NULL, NULL, NULL, 'Hero Ino', 'Kepala Desa Hero Ino', 1306),
(348, 4, 'Soatobaru', NULL, NULL, NULL, NULL, 'Soatobaru', 'Kepala Desa Soatobaru', 1401),
(349, 4, 'Dokulamo', NULL, NULL, NULL, NULL, 'Dokulamo', 'Kepala Desa Dokulamo', 1402),
(350, 4, 'Duma', NULL, NULL, NULL, NULL, 'Duma', 'Kepala Desa Duma', 1403),
(351, 4, 'Gotalamo', 'ijun', '08122144151', 'bca', '21313131', 'Gotalamo', 'Kepala Desa Gotalamo', 1404),
(352, 4, 'Makete', NULL, NULL, NULL, NULL, 'Makete', 'Kepala Desa Makete', 1405),
(353, 4, 'Ngidiho', 'Iman', '081231321321', 'bri', '12315353543', 'Ngidiho', 'Kepala Desa Ngidiho', 1406),
(354, 4, 'Roko', NULL, NULL, NULL, NULL, 'Roko', 'Kepala Desa Roko', 1407),
(355, 4, 'Samuda', NULL, NULL, NULL, NULL, 'Samuda', 'Kepala Desa Samuda', 1408),
(356, 4, 'Kira', NULL, NULL, NULL, NULL, 'Kira', 'Kepala Desa Kira', 1409),
(357, 1, 'Limau', NULL, NULL, NULL, NULL, 'Limau', 'Kepala Desa Limau', 1501),
(358, 1, 'Lalonga', NULL, NULL, NULL, NULL, 'Lalonga', 'Kepala Desa Lalonga', 1502),
(359, 1, 'Bobisingo', NULL, NULL, NULL, NULL, 'Bobisingo', 'Kepala Desa Bobisingo', 1503),
(360, 1, 'Salimuli', NULL, NULL, NULL, NULL, 'Salimuli', 'Kepala Desa Salimuli', 1504),
(361, 1, 'Tutumaloleo', NULL, NULL, NULL, NULL, 'Tutumaloleo', 'Kepala Desa Tutumaloleo', 1505),
(362, 1, 'Saluta', NULL, NULL, NULL, NULL, 'Saluta', 'Kepala Desa Saluta', 1506),
(363, 1, 'Jere', NULL, NULL, NULL, NULL, 'Jere', 'Kepala Desa Jere', 1507),
(364, 1, 'Dodowo', NULL, NULL, NULL, NULL, 'Dodowo', 'Kepala Desa Dodowo', 1508),
(365, 1, 'Togasa', NULL, NULL, NULL, NULL, 'Togasa', 'Kepala Desa Togasa', 1509),
(366, 1, 'Beringin Jaya', NULL, NULL, NULL, NULL, 'Beringin Jaya', 'Kepala Desa Beringin Jaya', 1510),
(367, 1, 'Pelita', NULL, NULL, NULL, NULL, 'Pelita', 'Kepala Desa Pelita', 1511),
(368, 1, 'Jere Tua', NULL, NULL, NULL, NULL, 'Jere Tua', 'Kepala Desa Jere Tua', 1512),
(369, 3, 'Seki', NULL, NULL, NULL, NULL, 'Seki', 'Kepala Desa Seki', 1601),
(370, 3, 'Togawa', NULL, NULL, NULL, NULL, 'Togawa', 'Kepala Desa Togawa', 1602),
(371, 3, 'Soakonora', NULL, NULL, NULL, NULL, 'Soakonora', 'Kepala Desa Soakonora', 1603),
(372, 3, 'Igobula', 'Iman', '081232131', 'BRI', '12313155', 'Igobula', 'Kepala Desa Igobula', 1604),
(373, 3, 'Bale', NULL, NULL, NULL, NULL, 'Bale', 'Kepala Desa Bale', 1605),
(374, 3, 'Togawabesi', NULL, NULL, NULL, NULL, 'Togawabesi', 'Kepala Desa Togawabesi', 1606),
(375, 3, 'Ori', NULL, NULL, NULL, NULL, 'Ori', 'Kepala Desa Ori', 1607),
(376, 18, 'Salube', NULL, NULL, NULL, NULL, 'Salube', 'Kepala Desa Salube', 1901),
(377, 18, 'Dama', NULL, NULL, NULL, NULL, 'Dama', 'Kepala Desa Dama', 1902),
(378, 18, 'Dowonggila', NULL, NULL, NULL, NULL, 'Dowonggila', 'Kepala Desa Dowonggila', 1903),
(379, 18, 'Tuakara', NULL, NULL, NULL, NULL, 'Tuakara', 'Kepala Desa Tuakara', 1904),
(380, 18, 'Jikolamo', NULL, NULL, NULL, NULL, 'Jikolamo', 'Kepala Desa Jikolamo', 1905),
(381, 18, 'Dagasuli', NULL, NULL, NULL, NULL, 'Dagasuli', 'Kepala Desa Dagasuli', 1906),
(382, 18, 'Dedeta', NULL, NULL, NULL, NULL, 'Dedeta', 'Kepala Desa Dedeta', 1907),
(383, 18, 'Fitako', NULL, NULL, NULL, NULL, 'Fitako', 'Kepala Desa Fitako', 1908),
(384, 18, 'Tobo Tobo', NULL, NULL, NULL, NULL, 'Tobo Tobo', 'Kepala Desa Tobo Tobo', 1909),
(385, 18, 'Cera', NULL, NULL, NULL, NULL, 'Cera', 'Kepala Desa Cera', 1910),
(386, 19, 'Wateto', NULL, NULL, NULL, NULL, 'Wateto', 'Kepala Desa Wateto', 2001),
(387, 19, 'Gulo', NULL, NULL, NULL, NULL, 'Gulo', 'Kepala Desa Gulo', 2002),
(388, 19, 'Tunuo', NULL, NULL, NULL, NULL, 'Tunuo', 'Kepala Desa Tunuo', 2003),
(389, 19, 'Pediwang', NULL, NULL, NULL, NULL, 'Pediwang', 'Kepala Desa Pediwang', 2004),
(390, 19, 'Bori', NULL, NULL, NULL, NULL, 'Bori', 'Kepala Desa Bori', 2005),
(391, 19, 'Doro', NULL, NULL, NULL, NULL, 'Doro', 'Kepala Desa Doro', 2006),
(392, 19, 'Daru', NULL, NULL, NULL, NULL, 'Daru', 'Kepala Desa Daru', 2007),
(393, 19, 'Bobale', NULL, NULL, NULL, NULL, 'Bobale', 'Kepala Desa Bobale', 2008),
(394, 19, 'Gamlaha', NULL, NULL, NULL, NULL, 'Gamlaha', 'Kepala Desa Gamlaha', 2009),
(395, 19, 'Boulamo', NULL, NULL, NULL, NULL, 'Boulamo', 'Kepala Desa Boulamo', 2010),
(396, 19, 'Warudu', NULL, NULL, NULL, NULL, 'Warudu', 'Kepala Desa Warudu', 2011),
(397, 19, 'Dowongimaiti', NULL, NULL, NULL, NULL, 'Dowongimaiti', 'Kepala Desa Dowongimaiti', 2012),
(398, 20, 'Gaga Apok', NULL, NULL, NULL, NULL, 'Gaga Apok', 'Kepala Desa Gaga Apok', 2101),
(399, 20, 'Ngoali', NULL, NULL, NULL, NULL, 'Ngoali', 'Kepala Desa Ngoali', 2102),
(400, 20, 'Momoda', NULL, NULL, NULL, NULL, 'Momoda', 'Kepala Desa Momoda', 2103),
(401, 20, 'Toliwang', NULL, NULL, NULL, NULL, 'Toliwang', 'Kepala Desa Toliwang', 2104),
(402, 20, 'Tolabit', NULL, NULL, NULL, NULL, 'Tolabit', 'Kepala Desa Tolabit', 2105),
(403, 20, 'Leleseng', NULL, NULL, NULL, NULL, 'Leleseng', 'Kepala Desa Leleseng', 2106),
(404, 20, 'Soa Hukum', NULL, NULL, NULL, NULL, 'Soa Hukum', 'Kepala Desa Soa Hukum', 2107),
(405, 20, 'Soa Maetek', NULL, NULL, NULL, NULL, 'Soa Maetek', 'Kepala Desa Soa Maetek', 2108),
(406, 20, 'Bailengit', NULL, NULL, NULL, NULL, 'Bailengit', 'Kepala Desa Bailengit', 2109),
(407, 20, 'Tuguis', NULL, NULL, NULL, NULL, 'Tuguis', 'Kepala Desa Tuguis', 2110),
(408, 20, 'Parseba', NULL, NULL, NULL, NULL, 'Parseba', 'Kepala Desa Parseba', 2111),
(409, 20, 'Pitago', NULL, NULL, NULL, NULL, 'Pitago', 'Kepala Desa Pitago', 2112),
(410, 20, 'Kai', NULL, NULL, NULL, NULL, 'Kai', 'Kepala Desa Kai', 2113),
(411, 20, 'Toboulamo', NULL, NULL, NULL, NULL, 'Toboulamo', 'Kepala Desa Toboulamo', 2114),
(412, 20, 'Makarti', NULL, NULL, NULL, NULL, 'Makarti', 'Kepala Desa Makarti', 2115),
(413, 20, 'Sangaji Jaya', NULL, NULL, NULL, NULL, 'Sangaji Jaya', 'Kepala Desa Sangaji Jaya', 2116),
(414, 20, 'Takimo', NULL, NULL, NULL, NULL, 'Takimo', 'Kepala Desa Takimo', 2117),
(415, 20, 'Torawat', NULL, NULL, NULL, NULL, 'Torawat', 'Kepala Desa Torawat', 2118),
(416, 20, 'Wonosari', NULL, NULL, NULL, NULL, 'Wonosari', 'Kepala Desa Wonosari', 2119),
(417, 20, 'Beringin Agung', NULL, NULL, NULL, NULL, 'Beringin Agung', 'Kepala Desa Beringin Agung', 2120),
(418, 20, 'Margomolyo', NULL, NULL, NULL, NULL, 'Margomolyo', 'Kepala Desa Margomolyo', 2121),
(419, 20, 'Sidomulyo', NULL, NULL, NULL, NULL, 'Sidomulyo', 'Kepala Desa Sidomulyo', 2122),
(420, 21, 'Tiowor', NULL, NULL, NULL, NULL, 'Tiowor', 'Kepala Desa Tiowor', 2201),
(421, 21, 'Makaeling', NULL, NULL, NULL, NULL, 'Makaeling', 'Kepala Desa Makaeling', 2202),
(422, 21, 'Tobanoma', NULL, NULL, NULL, NULL, 'Tobanoma', 'Kepala Desa Tobanoma', 2203),
(423, 21, 'Barumadehe', NULL, NULL, NULL, NULL, 'Barumadehe', 'Kepala Desa Barumadehe', 2204),
(424, 21, 'Kuntum Mekar', NULL, NULL, NULL, NULL, 'Kuntum Mekar', 'Kepala Desa Kuntum Mekar', 2205),
(425, 21, 'Pasir Putih', NULL, NULL, NULL, NULL, 'Pasir Putih', 'Kepala Desa Pasir Putih', 2206),
(426, 21, 'Bobaneigo', NULL, NULL, NULL, NULL, 'Bobaneigo', 'Kepala Desa Bobaneigo', 2207),
(427, 21, 'Tetewang', NULL, NULL, NULL, NULL, 'Tetewang', 'Kepala Desa Tetewang', 2208),
(428, 21, 'Akelamo Kao', NULL, NULL, NULL, NULL, 'Akelamo Kao', 'Kepala Desa Akelamo Kao', 2209),
(429, 21, 'Gamsungi', NULL, NULL, NULL, NULL, 'Gamsungi', 'Kepala Desa Gamsungi', 2210),
(430, 21, 'Dum-Dum', NULL, NULL, NULL, NULL, 'Dum-Dum', 'Kepala Desa Dum-Dum', 2211),
(431, 21, 'Toigo', NULL, NULL, NULL, NULL, 'Toigo', 'Kepala Desa Toigo', 2212),
(432, 21, 'Akelamo Kao Cibok', NULL, NULL, NULL, NULL, 'Akelamo Kao Cibok', 'Kepala Desa Akelamo Kao Cibok', 2213),
(433, 21, 'Ngebaino', NULL, NULL, NULL, NULL, 'Ngebaino', 'Kepala Desa Ngebaino', 2214),
(434, 21, 'Maraeli', NULL, NULL, NULL, NULL, 'Maraeli', 'Kepala Desa Maraeli', 2215);

-- --------------------------------------------------------

--
-- Table structure for table `dokumen`
--

CREATE TABLE `dokumen` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `jenis_dokumen` enum('surat_permohonan_ke_bupati_cq_kepala_dpm','kertas_kerja_hasil_pemeriksaan_lpj_tahap_sebelumnya','rekomendasi_camat','foto_baliho_realisasi_apbdes_tahun_sebelumnya','SPP1_SPP2_SPTB','foto_baliho_apbdes_tahun_berjalan','rencana_penggunaan_dana','foto_buku_tabungan','berita_acara_hasil_verivikasi_rkpdes_dan_apbdes_tahun_berjalan','lpj_tahap_sebelumnya','surat_permohonan_ke_bank','surat_permohonan_penerimaan','bukti_pembayaran_bulan_sebelumnya','bukti_setoran_pades','npwp_tpk','foto_copi_ktp_ketua_tpk','nomor_rekening_tpk','sk_pembentukan_tpk','sk_bumdesa','npwp_bumdesa_dan_bendahara_bumdesa','buku_rekening_bumdesa','akta_pendirian_badan_hukum') NOT NULL,
  `nama_file` varchar(255) NOT NULL,
  `path_file` varchar(255) NOT NULL,
  `upload_session_id` varchar(225) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dokumen`
--

INSERT INTO `dokumen` (`id`, `pengajuan_id`, `jenis_dokumen`, `nama_file`, `path_file`, `upload_session_id`, `created_at`, `updated_at`) VALUES
(406, 185, 'surat_permohonan_ke_bank', 'd997296f53335ee77db097db96036450.pdf', '', NULL, '2025-06-04 09:04:33', '2025-06-04 09:04:33'),
(407, 185, 'surat_permohonan_penerimaan', 'dd2c694f2d1a822b67bf162641d69cac.pdf', '', NULL, '2025-06-04 09:04:33', '2025-06-04 09:04:33'),
(408, 185, 'rekomendasi_camat', 'b004dd15bf5b773588f927ea973ccd26.pdf', '', NULL, '2025-06-04 09:04:33', '2025-06-04 09:04:33'),
(409, 185, 'SPP1_SPP2_SPTB', '5e4c0c40f87e440ee4a929553436d8a4.pdf', '', NULL, '2025-06-04 09:04:33', '2025-06-04 09:04:33'),
(410, 185, 'rencana_penggunaan_dana', '4b5ec2f6bfefbbdc5fb8c25bb97d4aeb.pdf', '', NULL, '2025-06-04 09:04:33', '2025-06-04 09:04:33'),
(411, 185, 'foto_buku_tabungan', '40c6903d2b012c31eb18830dbf251df8.pdf', '', NULL, '2025-06-04 09:04:33', '2025-06-04 09:04:33'),
(412, 185, 'bukti_pembayaran_bulan_sebelumnya', 'bc272e9d5a7e6d7478adafcbf49c7648.pdf', '', NULL, '2025-06-04 09:04:33', '2025-06-04 09:04:33'),
(413, 186, 'surat_permohonan_penerimaan', 'a5ef8ba96df58f641197563ef3805682.pdf', '', NULL, '2025-06-05 01:26:24', '2025-06-05 01:26:24'),
(414, 186, 'rekomendasi_camat', '9e665e3ab4f6d4b00c18cf1929a17454.pdf', '', NULL, '2025-06-05 01:26:24', '2025-06-05 01:26:24'),
(415, 186, 'SPP1_SPP2_SPTB', '71bbd3958314718d2d98d2387fcd687f.pdf', '', NULL, '2025-06-05 01:26:24', '2025-06-05 01:26:24'),
(416, 186, 'rencana_penggunaan_dana', '61560cf1ad00112b9cf156b1cd1ebce5.pdf', '', NULL, '2025-06-05 01:26:24', '2025-06-05 01:26:24'),
(417, 186, 'foto_buku_tabungan', '03591ca80d628efa61a39956e2cf6fb4.pdf', '', NULL, '2025-06-05 01:26:24', '2025-06-05 01:26:24'),
(418, 186, 'bukti_setoran_pades', '66329b02fb39e634b73c1574a1d34d0c.pdf', '', NULL, '2025-06-05 01:26:24', '2025-06-05 01:26:24'),
(419, 187, 'surat_permohonan_penerimaan', '369b8e00ba7eea34e6624ce94a4746f8.pdf', '', NULL, '2025-06-05 01:30:48', '2025-06-05 01:30:48'),
(420, 187, 'rekomendasi_camat', '6cb4789e689dfb9adf1938427f26b3ac.pdf', '', NULL, '2025-06-05 01:30:48', '2025-06-05 01:30:48'),
(421, 187, 'SPP1_SPP2_SPTB', 'bf0262bd4952d85d50d426dfcd61f76b.pdf', '', NULL, '2025-06-05 01:30:48', '2025-06-05 01:30:48'),
(422, 187, 'rencana_penggunaan_dana', '1a7b148ba3e53fb7730c58a09a9a7999.pdf', '', NULL, '2025-06-05 01:30:48', '2025-06-05 01:30:48'),
(423, 187, 'foto_buku_tabungan', 'b445aa7b1c3a1187b001a1dcf1f9c4a2.pdf', '', NULL, '2025-06-05 01:30:48', '2025-06-05 01:30:48'),
(424, 187, 'bukti_setoran_pades', '69bf02f57334bd1cd0c0760e2f111bd2.pdf', '', NULL, '2025-06-05 01:30:48', '2025-06-05 01:30:48'),
(425, 188, 'surat_permohonan_penerimaan', '6b769faae930c48271f005883f43b4fc.pdf', '', NULL, '2025-06-05 01:33:34', '2025-06-05 01:33:34'),
(426, 188, 'rekomendasi_camat', '52b15af007859fb7054d78e6f395885a.pdf', '', NULL, '2025-06-05 01:33:34', '2025-06-05 01:33:34'),
(427, 188, 'SPP1_SPP2_SPTB', '1c763d4ada2fd5ddbc971360950aef37.pdf', '', NULL, '2025-06-05 01:33:34', '2025-06-05 01:33:34'),
(428, 188, 'rencana_penggunaan_dana', '70a2454f7937d44df6e2d8bd2d4f53c7.pdf', '', NULL, '2025-06-05 01:33:34', '2025-06-05 01:33:34'),
(429, 188, 'foto_buku_tabungan', 'f0ded74acbd85239ac6cf509417cb84f.pdf', '', NULL, '2025-06-05 01:33:34', '2025-06-05 01:33:34'),
(430, 188, 'bukti_setoran_pades', '9dd743bfcf6965158bc2e2d0af6ac386.pdf', '', NULL, '2025-06-05 01:33:34', '2025-06-05 01:33:34'),
(431, 189, 'surat_permohonan_penerimaan', 'f67f6cb9494ed682bd935f0aa8d3126b.pdf', '', NULL, '2025-06-05 02:17:33', '2025-06-05 02:17:33'),
(432, 189, 'rekomendasi_camat', 'f3ebbed0bb70be519ff2e5a2fd7c6ff2.pdf', '', NULL, '2025-06-05 02:17:33', '2025-06-05 02:17:33'),
(433, 189, 'SPP1_SPP2_SPTB', 'dc31099facee6ee5132ba1db70d9d03f.pdf', '', NULL, '2025-06-05 02:17:34', '2025-06-05 02:17:34'),
(434, 189, 'rencana_penggunaan_dana', '84b4ccf71eee40d436fb7076db79bf6c.pdf', '', NULL, '2025-06-05 02:17:34', '2025-06-05 02:17:34'),
(435, 189, 'foto_buku_tabungan', '66af780639963fcad8cbd198bb9c6069.pdf', '', NULL, '2025-06-05 02:17:34', '2025-06-05 02:17:34'),
(436, 189, 'bukti_setoran_pades', '33f576acebc3782f8700d85cee7ca5de.pdf', '', NULL, '2025-06-05 02:17:34', '2025-06-05 02:17:34'),
(437, 190, 'surat_permohonan_penerimaan', '89d3b289c84e3711e4930e74f20ebbf7.pdf', '', NULL, '2025-06-05 02:23:18', '2025-06-05 02:23:18'),
(438, 190, 'rekomendasi_camat', '6905773bc0529af9e06d6d463e5fb6a4.pdf', '', NULL, '2025-06-05 02:23:18', '2025-06-05 02:23:18'),
(439, 190, 'SPP1_SPP2_SPTB', 'e759b0de75452ff20d8dee56c98983ca.pdf', '', NULL, '2025-06-05 02:23:18', '2025-06-05 02:23:18'),
(440, 190, 'rencana_penggunaan_dana', '70ab281e448b74b0316efe3cd89a783d.pdf', '', NULL, '2025-06-05 02:23:18', '2025-06-05 02:23:18'),
(441, 190, 'foto_buku_tabungan', 'a63daeb7c1806a445609029165a78f50.pdf', '', NULL, '2025-06-05 02:23:18', '2025-06-05 02:23:18'),
(442, 190, 'bukti_setoran_pades', '90f2350b59deae0a01b8bd2945cd6a1c.pdf', '', NULL, '2025-06-05 02:23:18', '2025-06-05 02:23:18'),
(443, 191, 'surat_permohonan_penerimaan', '519e9fd7534ae563a4bc831dd64aae6a.pdf', '', NULL, '2025-06-05 02:25:44', '2025-06-05 02:25:44'),
(444, 191, 'rekomendasi_camat', '3135074719762d583928559d50e862d1.pdf', '', NULL, '2025-06-05 02:25:44', '2025-06-05 02:25:44'),
(445, 191, 'SPP1_SPP2_SPTB', '89261a987aa581a94b24d72690d97c14.pdf', '', NULL, '2025-06-05 02:25:44', '2025-06-05 02:25:44'),
(446, 191, 'rencana_penggunaan_dana', '1071d2f0f29c4c085893b863014230c1.pdf', '', NULL, '2025-06-05 02:25:44', '2025-06-05 02:25:44'),
(447, 191, 'foto_buku_tabungan', '643a87abfaddbdb013bc3bd3705fdbb7.pdf', '', NULL, '2025-06-05 02:25:44', '2025-06-05 02:25:44'),
(448, 191, 'bukti_setoran_pades', '8cf939655f4ca215e1b31ad1711e94c2.pdf', '', NULL, '2025-06-05 02:25:44', '2025-06-05 02:25:44'),
(449, 192, 'surat_permohonan_penerimaan', '3cf171664a84b491633ee86cc83462b3.pdf', '', NULL, '2025-06-05 02:29:37', '2025-06-05 02:29:37'),
(450, 192, 'rekomendasi_camat', '55d55bc1accce58eb85759bd8be1de32.pdf', '', NULL, '2025-06-05 02:29:37', '2025-06-05 02:29:37'),
(451, 192, 'SPP1_SPP2_SPTB', 'f721c346a38c084cf3644b8795bd348f.pdf', '', NULL, '2025-06-05 02:29:37', '2025-06-05 02:29:37'),
(452, 192, 'rencana_penggunaan_dana', '93ac7d6092828b705ca05287d7d9f435.pdf', '', NULL, '2025-06-05 02:29:37', '2025-06-05 02:29:37'),
(453, 192, 'foto_buku_tabungan', '7f6076523f9151e8cd175a7377198ba5.pdf', '', NULL, '2025-06-05 02:29:37', '2025-06-05 02:29:37'),
(454, 192, 'bukti_setoran_pades', '095bd7288a28513115186f234574cb3b.pdf', '', NULL, '2025-06-05 02:29:37', '2025-06-05 02:29:37'),
(455, 193, 'surat_permohonan_penerimaan', '9cc2a08e1e42403422386c8bf30e66f8.pdf', '', NULL, '2025-06-05 02:32:18', '2025-06-05 02:32:18'),
(456, 193, 'rekomendasi_camat', '4b25152e49fac1f55d55d26562bffcf7.pdf', '', NULL, '2025-06-05 02:32:18', '2025-06-05 02:32:18'),
(457, 193, 'SPP1_SPP2_SPTB', '67e2377b8e849742753d6900c382d7b8.pdf', '', NULL, '2025-06-05 02:32:18', '2025-06-05 02:32:18'),
(458, 193, 'rencana_penggunaan_dana', '5411a9496accbcb5f3b3d53c9f0791e5.pdf', '', NULL, '2025-06-05 02:32:18', '2025-06-05 02:32:18'),
(459, 193, 'foto_buku_tabungan', '3d87e709366788be05cddef555ca740d.pdf', '', NULL, '2025-06-05 02:32:18', '2025-06-05 02:32:18'),
(460, 193, 'bukti_setoran_pades', '50ec53120162c79c5e2b9bcf8e97aa85.pdf', '', NULL, '2025-06-05 02:32:18', '2025-06-05 02:32:18');

-- --------------------------------------------------------

--
-- Table structure for table `kecamatan`
--

CREATE TABLE `kecamatan` (
  `id` int(11) NOT NULL,
  `nama_kecamatan` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kecamatan`
--

INSERT INTO `kecamatan` (`id`, `nama_kecamatan`, `created_at`, `updated_at`) VALUES
(1, 'Galela Utara', '2025-05-24 11:24:20', '2025-05-24 11:24:20'),
(2, 'Galela', '2025-05-24 11:24:20', '2025-05-24 11:24:20'),
(3, 'Galela Selatan', '2025-05-24 11:24:20', '2025-05-24 11:24:20'),
(4, 'Galela Barat', '2025-05-24 11:24:20', '2025-05-24 11:24:20'),
(6, 'Tobelo', '2025-06-04 06:54:00', '2025-06-04 06:54:00'),
(7, 'Tobelo Selatan', '2025-06-04 06:54:00', '2025-06-04 07:45:24'),
(8, 'Kao', '2025-06-04 06:54:00', '2025-06-04 06:54:00'),
(9, 'Malifut', '2025-06-04 06:54:00', '2025-06-04 06:54:00'),
(10, 'Loloda Utara', '2025-06-04 06:54:00', '2025-06-04 07:45:27'),
(11, 'Tobelo Utara', '2025-06-04 06:54:00', '2025-06-04 07:45:29'),
(12, 'Tobelo Tengah', '2025-06-04 06:54:00', '2025-06-04 07:45:33'),
(13, 'Tobelo Timur', '2025-06-04 06:54:00', '2025-06-04 07:45:37'),
(14, 'Tobelo Barat', '2025-06-04 06:54:00', '2025-06-04 07:45:40'),
(18, 'Loloda Kepulauan', '2025-06-04 06:54:00', '2025-06-04 07:45:12'),
(19, 'Kao Utara', '2025-06-04 06:54:00', '2025-06-04 07:45:47'),
(20, 'Kao Barat', '2025-06-04 06:54:00', '2025-06-04 07:45:50'),
(21, 'Kao Teluk', '2025-06-04 06:54:00', '2025-06-04 07:45:53');

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan`
--

CREATE TABLE `pengajuan` (
  `id` int(11) NOT NULL,
  `desa_id` int(11) NOT NULL,
  `no_pengajuan` varchar(225) NOT NULL,
  `jenis_pengajuan` enum('dd_earmark_60','alokasi_dana_desa','dana_lain','dd_non_earmark_40','ketahanan_pangan_tpk','ketahanan_pangan_bumdesa') NOT NULL,
  `status` enum('diajukan','diterima','ditolak','verifikasi','berita_acara_siap','disposisi','disposisi_ditolak','verifikasi_ditolak') DEFAULT NULL,
  `jumlah_bantuan` decimal(15,2) DEFAULT NULL,
  `jenis_bantuan` varchar(225) NOT NULL,
  `tanggal_pengajuan` timestamp NOT NULL DEFAULT current_timestamp(),
  `tanggal_verifikasi` timestamp NULL DEFAULT NULL,
  `verifikator_id` int(11) DEFAULT NULL,
  `berita_acara_id` int(11) DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengajuan`
--

INSERT INTO `pengajuan` (`id`, `desa_id`, `no_pengajuan`, `jenis_pengajuan`, `status`, `jumlah_bantuan`, `jenis_bantuan`, `tanggal_pengajuan`, `tanggal_verifikasi`, `verifikator_id`, `berita_acara_id`, `catatan`, `created_at`, `updated_at`) VALUES
(185, 232, '704/232/010/2025', 'alokasi_dana_desa', 'ditolak', 12000000000.00, '', '2025-06-04 04:04:33', '2025-06-04 04:11:43', 3, 55, 'kurang relevan', '2025-06-04 09:04:33', '2025-06-04 09:11:43'),
(186, 353, '285/353/030/2025', 'dana_lain', 'diajukan', 15000000.00, 'bertahap', '2025-06-04 20:26:24', NULL, NULL, NULL, NULL, '2025-06-05 01:26:24', '2025-06-05 01:26:24'),
(187, 351, '104/351/030/2025', 'dana_lain', 'verifikasi', 1400000.00, 'partial', '2025-06-04 20:30:48', '2025-06-05 04:41:27', 1, NULL, NULL, '2025-06-05 01:30:48', '2025-06-05 02:41:27'),
(188, 232, '217/232/030/2025', 'dana_lain', 'diajukan', 1400000.00, 'partial', '2025-06-04 20:33:34', '2025-06-04 20:33:34', NULL, NULL, NULL, '2025-06-05 01:33:34', '2025-06-05 01:33:34'),
(189, 335, '683/232/030/2025', 'dana_lain', 'diajukan', 1240000000.00, 'BLT', '2025-06-04 21:17:33', '2025-06-04 21:17:33', NULL, NULL, NULL, '2025-06-05 02:17:33', '2025-06-05 02:17:33'),
(190, 232, '209/232/030/2025', 'dana_lain', 'verifikasi_ditolak', 125000000.00, 'BLT Non Tunai', '2025-06-04 21:23:18', '2025-06-05 14:17:41', 1, NULL, 'belum lengkap dokumennya', '2025-06-05 02:23:18', '2025-06-05 12:17:41'),
(191, 233, '580/233/030/2025', 'dana_lain', 'verifikasi_ditolak', 9000000000.00, 'BLT', '2025-06-04 21:25:44', '2025-06-05 14:14:45', 1, NULL, 'kurang relevan', '2025-06-05 02:25:44', '2025-06-05 12:14:45'),
(192, 233, '344/233/030/2025', 'dana_lain', 'verifikasi', 1000000000.00, 'BLT', '2025-06-04 21:29:37', '2025-06-05 04:41:17', 1, NULL, NULL, '2025-06-05 02:29:37', '2025-06-05 02:41:17'),
(193, 233, '297/233/030/2025', 'dana_lain', 'verifikasi', 200000000.00, 'BLT', '2025-06-05 04:32:18', '2025-06-05 04:38:58', 1, NULL, NULL, '2025-06-05 02:32:18', '2025-06-05 02:38:58');

-- --------------------------------------------------------

--
-- Table structure for table `riwayat_pengajuan`
--

CREATE TABLE `riwayat_pengajuan` (
  `id` int(11) NOT NULL,
  `pengajuan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status_sebelum` enum('pending','diterima','ditolak') DEFAULT NULL,
  `status_sesudah` enum('pending','diterima','ditolak') DEFAULT NULL,
  `catatan` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('super_admin','admin_desa','kadis','kabid') NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `desa_id` int(11) DEFAULT NULL,
  `kecamatan_id` int(11) DEFAULT NULL,
  `foto` varchar(225) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `nama_lengkap`, `email`, `no_hp`, `desa_id`, `kecamatan_id`, `foto`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$FJBsZqbO46SbA/jGxwKvduGddp5u3e4h/rj12tTpwvQylFuzPDZK6', 'super_admin', 'Administrator Aja', 'admin@example.com', '08123456789', NULL, NULL, '', '2025-05-24 11:27:04', '2025-06-05 12:15:48'),
(2, 'admin_desa', '$2y$10$5gMsAN7m0GvfJ7nVoRugwelb/oYk6Tl05k2utQWke92xdqNtXBq4.', 'admin_desa', 'Admin Desa Gamhoku1', 'admin.desa@example.com2', '0851617558544455', 232, 2, 'foto_2_1749046571.jpg', '2025-05-24 11:27:04', '2025-06-04 14:16:11'),
(3, 'Kadis', '$2a$12$Qgk41Zn/7ni4aL9pRWQRxORFefQxmXF1pl3st2iJmfGzyqHF6ztIu', 'kadis', 'Kadis Galela Utara', 'kadis@example.com', '08123456791', NULL, NULL, '', '2025-05-24 11:27:04', '2025-06-04 09:29:09'),
(4, 'Kabid', '$2y$10$EsLyrMPOFZD2bGvfTMpL7.VVmzLnbng1UybxNNaY.BVkukZviCy6q', 'kabid', 'Kabid DPMD', 'kabid@example.coms', '08123456792', NULL, NULL, 'foto_4_1749117720.png', '2025-05-24 11:27:04', '2025-06-05 11:59:45'),
(12, 'Admin1', '$2a$12$o3tf.O3K8yywU8GwXed2JObouHI.qTkoWKVxYcvQuZ5LN6.yM6MSi', 'super_admin', '', NULL, NULL, NULL, NULL, '', '2025-06-04 08:31:42', '2025-06-04 08:31:42'),
(13, 'Admin2', '$2a$12$ywsu8J2y5RHuOHbcCi5xi.YaqbCid3DD5aEbQu9IR7EMuaEi2SoOC', 'super_admin', '', NULL, NULL, NULL, NULL, '', '2025-06-04 08:31:42', '2025-06-04 08:31:42'),
(14, 'Admin3', '$2a$12$B1l2jSVatr1oszgC8CCB9ucMjbDoziapiPHk5vObar4mf9KZhHNyu', 'super_admin', '', NULL, NULL, NULL, NULL, '', '2025-06-04 08:31:42', '2025-06-04 08:31:42'),
(15, 'Admin4', '$2a$12$JK.4J4NarFm0wtU6CTl7c.jc6P2GTzqv3TW/Ya0A4adPkeYdDXFFS', 'super_admin', '', NULL, NULL, NULL, NULL, '', '2025-06-04 08:31:42', '2025-06-04 08:31:42'),
(16, 'Admin5', '$2a$12$eEh1iCTeagR4LPsHqbNX3OeFZnHH0oHFAkB7rhb/0tt05UtqQyJ/.', 'super_admin', '', NULL, NULL, NULL, NULL, '', '2025-06-04 08:31:42', '2025-06-04 08:31:42'),
(17, 'Soa-Sio', '$2a$12$0/a9RlBdh0Mhmjkm1D./ouwUAFZEIhCJwJTxKkDfoCQWhBeNrCTmu', 'admin_desa', '', NULL, NULL, 232, 2, '', '2025-06-04 08:53:48', '2025-06-04 08:53:48'),
(18, 'Pune', '$2a$12$0C2RKUyejfnh8zRU3n7cFeQSaBeqA81/OlczCFMXYZu/nmbQYkgEK', 'admin_desa', '', NULL, NULL, 233, 2, '', '2025-06-04 08:53:48', '2025-06-04 08:53:48'),
(19, 'Mamuya', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 234, 2, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(20, 'Toweka', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 235, 2, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(21, 'Simau', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 236, 2, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(22, 'Barataku', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 237, 2, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(23, 'Towara', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 238, 2, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(24, 'Gamsungi', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 239, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(25, 'Gura', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 240, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(26, 'Wari', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 241, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(27, 'Kakara', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 242, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(28, 'Kumo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 243, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(29, 'Gosoma', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 244, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(30, 'Rawajaya', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 245, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(31, 'MKCM', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 246, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(32, 'Tagalaya', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 247, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(33, 'Wari Ino', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 248, 6, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(34, 'Kupa Kupa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 249, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(35, 'Gamhoku', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 250, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(36, 'Efi Efi', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 251, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(37, 'Tomahalu', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 252, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(38, 'Paca', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 253, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(39, 'Leleoto', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 254, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(40, 'Tobe', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 255, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(41, 'Kakara B', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 256, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(42, 'Talaga Paca', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 257, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(43, 'Tioua', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 258, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(44, 'Pale', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 259, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(45, 'Kupa-kupa Selatan (Halehe)', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 260, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(46, 'Lemah Ino', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 261, 7, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(47, 'Kao', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 262, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(48, 'Jati', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 263, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(49, 'Kusu', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 264, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(50, 'Waringin Lelewi', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 265, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(51, 'Soa Sangaji Dim-Dim', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 266, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(52, 'Sasur', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 267, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(53, 'Popon', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 268, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(54, 'Biang', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 269, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(55, 'Patang', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 270, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(56, 'Kukumutuk', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 271, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(57, 'Waringin Lamo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 272, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(58, 'Goruang', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 273, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(59, 'Kusu Lofra', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 274, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(60, 'Sumber Agung', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 275, 8, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(61, 'Ngofa Kiaha', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 276, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(62, 'Ngofa Gita', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 277, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(63, 'Samsuma', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 278, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(64, 'Tahane', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 279, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(65, 'Matsa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 280, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(66, 'Bobawa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 281, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(67, 'Talapao', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 282, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(68, 'Tafasoho', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 283, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(69, 'Sabaleh', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 284, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(70, 'Tagono', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 285, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(71, 'Soma', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 286, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(72, 'Ngofa Bobawa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 287, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(73, 'Malapa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 288, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(74, 'Mailoa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 289, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(75, 'Peleri', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 290, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(76, 'Bukit Tinggi', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 291, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(77, 'Terpadu', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 292, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(78, 'Tabobo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 293, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(79, 'Balisosang', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 294, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(80, 'Sosol/Malifut', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 295, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(81, 'Wangeotek', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 296, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(82, 'Gayok', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 297, 9, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(83, 'Dorume', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 298, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(84, 'Apule', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 299, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(85, 'Asimiro', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 300, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(86, 'Doitia', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 301, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(87, 'Ngajam', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 302, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(88, 'Kailupa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 303, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(89, 'Gisik', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 304, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(90, 'Kapa Kapa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 305, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(91, 'Pacao', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 306, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(92, 'Tate', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 307, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(93, 'Posi- Posi', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 308, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(94, 'Supu', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 309, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(95, 'Igo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 310, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(96, 'Galao', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 311, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(97, 'Teru-Teru', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 312, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(98, 'Wori Moi', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 313, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(99, 'Podol', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 314, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(100, 'Momojiu', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 315, 10, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(101, 'Gorua', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 316, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(102, 'Popilo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 317, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(103, 'Luari', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 318, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(104, 'Popilo Utara', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 319, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(105, 'Tolonuo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 320, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(106, 'Gorua Selatan', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 321, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(107, 'Gorua Utara', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 322, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(108, 'Kokota Jaya', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 323, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(109, 'Ruko', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 324, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(110, 'Tolonua Selatan', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 325, 11, '', '2025-06-05 00:59:46', '2025-06-05 00:59:46'),
(111, 'Upa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 326, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(112, 'Pitu', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 327, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(113, 'Wosia', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 328, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(114, 'WKO', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 329, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(115, 'Kalipitu', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 330, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(116, 'Kali Upa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 331, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(117, 'Lina Ino', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 332, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(118, 'Mahia (Wosia Tengah)', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 333, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(119, 'Tanjung Niara (Wosia Selatan)', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 334, 12, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(120, 'Yaro', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 335, 13, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(121, 'Mawea', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 336, 13, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(122, 'Meti', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 337, 13, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(123, 'Katana', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 338, 13, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(124, 'Gonga', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 339, 13, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(125, 'Todokuiha', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 340, 13, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(126, 'Magaliho', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 341, 13, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(127, 'Kusuri', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 342, 14, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(128, 'Sukamaju', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 343, 14, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(129, 'Togoliua', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 344, 14, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(130, 'Birinoa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 345, 14, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(131, 'Wangongira', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 346, 14, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(132, 'Hero Ino', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 347, 14, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(133, 'Soatobaru', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 348, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(134, 'Dokulamo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 349, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(135, 'Duma', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 350, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(136, 'Gotalamo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 351, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(137, 'Makete', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 352, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(138, 'Ngidiho', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 353, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(139, 'Roko', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 354, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(140, 'Samuda', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 355, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(141, 'Kira', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 356, 4, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(142, 'Limau', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 357, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(143, 'Lalonga', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 358, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(144, 'Bobisingo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 359, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(145, 'Salimuli', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 360, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(146, 'Tutumaloleo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 361, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(147, 'Saluta', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 362, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(148, 'Jere', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 363, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(149, 'Dodowo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 364, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(150, 'Togasa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 365, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(151, 'Beringin Jaya', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 366, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(152, 'Pelita', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 367, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(153, 'Jere Tua', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 368, 1, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(154, 'Seki', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 369, 3, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(155, 'Togawa', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 370, 3, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(156, 'Soakonora', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 371, 3, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(157, 'Igobula', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 372, 3, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(158, 'Bale', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 373, 3, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(159, 'Togawabesi', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 374, 3, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(160, 'Ori', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 375, 3, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(161, 'Salube', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 376, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(162, 'Dama', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 377, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(163, 'Dowonggila', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 378, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(164, 'Tuakara', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 379, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(165, 'Jikolamo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 380, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(166, 'Dagasuli', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 381, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(167, 'Dedeta', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 382, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(168, 'Fitako', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 383, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(169, 'Tobo Tobo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 384, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(170, 'Cera', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 385, 18, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(171, 'Wateto', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 386, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(172, 'Gulo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 387, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(173, 'Tunuo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 388, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(174, 'Pediwang', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 389, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(175, 'Bori', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 390, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(176, 'Doro', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 391, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(177, 'Daru', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 392, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(178, 'Bobale', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 393, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(179, 'Gamlaha', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 394, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(180, 'Boulamo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 395, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(181, 'Warudu', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 396, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(182, 'Dowongimaiti', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 397, 19, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(183, 'Gaga Apok', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 398, 20, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(184, 'Ngoali', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 399, 20, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(185, 'Momoda', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 400, 20, '', '2025-06-05 01:01:53', '2025-06-05 01:01:53'),
(220, 'Toliwang', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 401, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(221, 'Tolabit', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 402, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(222, 'Leleseng', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 403, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(223, 'Soa Hukum', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 404, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(224, 'Soa Maetek', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 405, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(225, 'Bailengit', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 406, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(226, 'Tuguis', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 407, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(227, 'Parseba', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 408, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(228, 'Pitago', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 409, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(229, 'Kai', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 410, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(230, 'Toboulamo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 411, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(231, 'Makarti', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 412, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(232, 'Sangaji Jaya', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 413, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(233, 'Takimo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 414, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(234, 'Torawat', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 415, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(235, 'Wonosari', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 416, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(236, 'Beringin Agung', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 417, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(237, 'Margomolyo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 418, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(238, 'Sidomulyo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 419, 20, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(239, 'Tiowor', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 420, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(240, 'Makaeling', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 421, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(241, 'Tobanoma', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 422, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(242, 'Barumadehe', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 423, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(243, 'Kuntum Mekar', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 424, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(244, 'Pasir Putih', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 425, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(245, 'Bobaneigo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 426, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(246, 'Tetewang', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 427, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(247, 'Akelamo Kao', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 428, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(248, 'Gamsungi Kao Teluk', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 429, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(249, 'Dum-Dum', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 430, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(250, 'Toigo', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 431, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(251, 'Akelamo Kao Cibok', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 432, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(252, 'Ngebaino', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 433, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41'),
(253, 'Maraeli', '$2a$12$X2z6ScQ776xejNRxo.IhzOd5KdozQSj2psrJacWSAuPyYAj5oCXfG', 'admin_desa', '', NULL, NULL, 434, 21, '', '2025-06-05 01:13:41', '2025-06-05 01:13:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bap_dokumen`
--
ALTER TABLE `bap_dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `berita_acara_id` (`berita_acara_id`) USING BTREE;

--
-- Indexes for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_id` (`desa_id`),
  ADD KEY `verifikator_id` (`verifikator_id`);

--
-- Indexes for table `dana_lain`
--
ALTER TABLE `dana_lain`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_id` (`desa_id`),
  ADD KEY `verifikator_id` (`verifikator_id`);

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kecamatan_id` (`kecamatan_id`);

--
-- Indexes for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_id` (`pengajuan_id`);

--
-- Indexes for table `kecamatan`
--
ALTER TABLE `kecamatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `desa_id` (`desa_id`),
  ADD KEY `verifikator_id` (`verifikator_id`),
  ADD KEY `berita_acara_id` (`berita_acara_id`);

--
-- Indexes for table `riwayat_pengajuan`
--
ALTER TABLE `riwayat_pengajuan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pengajuan_id` (`pengajuan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bap_dokumen`
--
ALTER TABLE `bap_dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `berita_acara`
--
ALTER TABLE `berita_acara`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `dana_lain`
--
ALTER TABLE `dana_lain`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=435;

--
-- AUTO_INCREMENT for table `dokumen`
--
ALTER TABLE `dokumen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=461;

--
-- AUTO_INCREMENT for table `kecamatan`
--
ALTER TABLE `kecamatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `pengajuan`
--
ALTER TABLE `pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=194;

--
-- AUTO_INCREMENT for table `riwayat_pengajuan`
--
ALTER TABLE `riwayat_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=254;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bap_dokumen`
--
ALTER TABLE `bap_dokumen`
  ADD CONSTRAINT `bapdokumen_ibfk_1` FOREIGN KEY (`berita_acara_id`) REFERENCES `berita_acara` (`id`);

--
-- Constraints for table `berita_acara`
--
ALTER TABLE `berita_acara`
  ADD CONSTRAINT `bap_ibfk_1` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`id`),
  ADD CONSTRAINT `bap_ibfk_2` FOREIGN KEY (`verifikator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `desa`
--
ALTER TABLE `desa`
  ADD CONSTRAINT `desa_ibfk_1` FOREIGN KEY (`kecamatan_id`) REFERENCES `kecamatan` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dokumen`
--
ALTER TABLE `dokumen`
  ADD CONSTRAINT `dokumen_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`);

--
-- Constraints for table `pengajuan`
--
ALTER TABLE `pengajuan`
  ADD CONSTRAINT `pengajuan_ibfk_1` FOREIGN KEY (`desa_id`) REFERENCES `desa` (`id`),
  ADD CONSTRAINT `pengajuan_ibfk_2` FOREIGN KEY (`verifikator_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `riwayat_pengajuan`
--
ALTER TABLE `riwayat_pengajuan`
  ADD CONSTRAINT `riwayat_pengajuan_ibfk_1` FOREIGN KEY (`pengajuan_id`) REFERENCES `pengajuan` (`id`),
  ADD CONSTRAINT `riwayat_pengajuan_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
