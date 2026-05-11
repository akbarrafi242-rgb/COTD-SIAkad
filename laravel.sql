-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2026 pada 13.27
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prodi` varchar(255) NOT NULL,
  `angkatan` int(11) NOT NULL,
  `jenis_kelamin` varchar(1) NOT NULL,
  `status_lulus` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `created_at`, `updated_at`, `prodi`, `angkatan`, `jenis_kelamin`, `status_lulus`) VALUES
(1, 'Savira', 'savira@gmail.com', '2026-05-10 23:00:13', '2026-05-10 23:49:35', 'Sistem Informasi', 2024, 'P', 0),
(2, 'Rafi', 'rafi@gmil.com', '2026-05-10 23:47:39', '2026-05-10 23:47:39', 'Sistem Informasi', 2024, 'L', 0),
(3, 'Faris', 'faris@gmail.com', '2026-05-10 23:47:59', '2026-05-10 23:49:45', 'Informatika', 2022, 'L', 0),
(4, 'Adam', 'adam@gmail.com', '2026-05-10 23:48:24', '2026-05-10 23:48:24', 'Bisnis Digital', 2021, 'L', 1),
(5, 'Tono', 'tono@gmail.com', '2026-05-10 23:48:52', '2026-05-10 23:48:52', 'Sains Data', 2022, 'L', 0),
(6, 'Hana', 'hana@gmail.com', '2026-05-10 23:49:19', '2026-05-10 23:49:19', 'Informatika', 2023, 'P', 1),
(7, 'Rembo', 'rembo@gmail.com', '2026-05-10 23:50:32', '2026-05-10 23:50:32', 'Informatika', 2021, 'L', 0),
(8, 'Dira', 'angela@gmail.com', '2026-05-10 23:51:00', '2026-05-10 23:51:10', 'Sistem Informasi', 2020, 'P', 1),
(9, 'Bahar', 'bahar@gmail.com', '2026-05-10 23:57:37', '2026-05-10 23:57:37', 'Informatika', 2021, 'L', 1),
(10, 'Linda', 'linda@gmail.com', '2026-05-10 23:58:07', '2026-05-10 23:58:07', 'Sains Data', 2020, 'P', 1),
(11, 'lala', 'lala@gmail.com', '2026-05-10 23:58:36', '2026-05-10 23:58:36', 'Bisnis Digital', 2024, 'P', 1),
(12, 'Dinda', 'dinda@gmail.com', '2026-05-11 00:07:10', '2026-05-11 00:07:10', 'Sistem Informasi', 2025, 'P', 0),
(13, 'Razi', 'razi@gmail.com', '2026-05-11 00:07:38', '2026-05-11 00:07:38', 'Sistem Informasi', 2023, 'L', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
