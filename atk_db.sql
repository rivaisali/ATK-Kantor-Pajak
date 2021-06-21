-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Jun 2021 pada 06.47
-- Versi server: 10.4.13-MariaDB
-- Versi PHP: 7.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atk_db`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(5) UNSIGNED NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `barcode` varchar(50) NOT NULL,
  `kategori_id` int(5) NOT NULL,
  `tipe_id` int(5) NOT NULL,
  `merk` varchar(100) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(3) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `kode_barang`, `barcode`, `kategori_id`, `tipe_id`, `merk`, `nama_barang`, `stok`, `updated_at`, `created_at`) VALUES
(17, '123', '321211', 2, 3, 'Lifebuoy', 'Sabun Cuci2', 50, '2021-06-20 23:22:48', '2021-06-21 12:11:43'),
(19, '1234', '321211333', 2, 3, 'Lifebuoy', 'Sabun Cuci2343', 50, '2021-06-20 23:27:45', '2021-06-20 23:23:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id` int(5) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `keterangan` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `keterangan`) VALUES
(1, 'Buku', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `stok_keluar_id` int(5) NOT NULL,
  `tgl_keluar` date NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah_stok` int(8) NOT NULL,
  `Keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `stok_masuk_id` int(5) NOT NULL,
  `tgl_masuk` date NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah_stok` int(8) NOT NULL,
  `keterangan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tipe`
--

CREATE TABLE `tipe` (
  `id` int(5) NOT NULL,
  `kategori_id` int(5) NOT NULL,
  `tipe` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(5) NOT NULL,
  `nomor_transaksi` varchar(50) NOT NULL,
  `user_id` int(5) NOT NULL,
  `user_pelanggan_id` int(5) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `status` int(2) NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `id` int(5) NOT NULL,
  `transaksi_id` int(5) NOT NULL,
  `kode_barang` varchar(50) NOT NULL,
  `jumlah` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(5) UNSIGNED NOT NULL,
  `nip` varchar(25) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `pangkat` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `foto` text NOT NULL,
  `level` int(2) NOT NULL,
  `last_logged` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nip`, `nama_lengkap`, `username`, `email`, `jabatan`, `pangkat`, `password`, `foto`, `level`, `last_logged`, `updated_at`, `created_at`) VALUES
(3, '12345', 'Moh Rivai Sali', 'rivaisali', 'rivai@gmail.com', '50000', '11', '$2y$10$bNVA5H/Cdyce3egQIt21B.OQ6gXNIbGddzj1DFg5Ssm5AHg4hxTGe', 'foto.jpg', 1, NULL, NULL, '2021-05-28 13:48:49'),
(4, '123456789', 'Moh Rivai Sali', 'rivaisali', 'riva@gmail.com', 'direktur', 'akpol', '$2y$10$hov38otnXCUq0fQH/TwvaekteXpNK6dmeAwhvvYRyiCy5QbI.deJS', '12.jpg', 2, '2021-06-20 23:46:21', '2021-06-20 23:46:21', '2021-06-20 14:48:02');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`stok_keluar_id`);

--
-- Indeks untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`stok_masuk_id`);

--
-- Indeks untuk tabel `tipe`
--
ALTER TABLE `tipe`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`nip`),
  ADD UNIQUE KEY `password` (`password`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `stok_keluar_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `stok_masuk_id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tipe`
--
ALTER TABLE `tipe`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
