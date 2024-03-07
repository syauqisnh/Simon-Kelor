-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Jun 2023 pada 11.56
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
-- Struktur dari tabel `documentations`
--

CREATE TABLE `documentations` (
  `id_dokumen` bigint(20) UNSIGNED NOT NULL,
  `id_user` int(11) NOT NULL,
  `nama_dokumen` varchar(255) NOT NULL,
  `jenis_dokumen` enum('perencanaan','evaluasi','profil_kelistrikan','sop_pengoperasian','singel_line_diagram') NOT NULL,
  `size_dokumen` bigint(20) NOT NULL,
  `path` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `documentations`
--

INSERT INTO `documentations` (`id_dokumen`, `id_user`, `nama_dokumen`, `jenis_dokumen`, `size_dokumen`, `path`) VALUES
(10, 26, 'STRUKTUR DATABASE SIMONKELOR.xlsx', 'perencanaan', 1018710, 'assets/file/documentation/STRUKTUR DATABASE SIMONKELOR.xlsx'),
(11, 30, 'ALUR FORECASTING.xlsx', 'perencanaan', 113695, 'assets/file/documentation/ALUR FORECASTING.xlsx');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `documentations`
--
ALTER TABLE `documentations`
  ADD PRIMARY KEY (`id_dokumen`),
  ADD KEY `id_user` (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `documentations`
--
ALTER TABLE `documentations`
  MODIFY `id_dokumen` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
