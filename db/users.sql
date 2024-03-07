-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 26 Jun 2023 pada 13.10
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simonkelor_native`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(255) NOT NULL,
  `nip` char(25) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `role` enum('Super Admin','Admin Dispacher','Admin Pembangkit','Pegawai') NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gambar` text NOT NULL,
  `path` varchar(200) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`user_id`, `nama_user`, `nip`, `instansi`, `role`, `email`, `password`, `gambar`, `path`, `created_at`, `updated_at`) VALUES
(26, 'Admin', '1234567891234567', 'Nama Instansi', 'Super Admin', 'superadmin@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'default_profil.png', '', NULL, NULL),
(30, 'Dispacher', '1234567891234567', 'Nama Instansi', 'Admin Dispacher', 'admindispacher@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'default_profil.png', NULL, NULL, NULL),
(31, 'Pegawai', '1234567891234567', 'Nama Instansi', 'Pegawai', 'pegawai@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'default_profil.png', '', NULL, NULL),
(32, 'Pembangkit', '1234567891234567', 'Nama Instansi', 'Admin Pembangkit', 'adminpembangkit@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'default_profil.png', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
