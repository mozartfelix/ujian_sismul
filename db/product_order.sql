-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Bulan Mei 2025 pada 16.43
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `product_order`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `order`
--

INSERT INTO `order` (`id`, `data`, `status`) VALUES
(17, '2025-05-06 17:57:37', 1),
(18, '2025-05-06 17:58:22', 1),
(19, '2025-05-06 18:16:48', 0),
(20, '2025-05-06 18:16:54', 0),
(21, '2025-05-06 19:08:12', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `stok` int(10) NOT NULL,
  `nama` varchar(90) NOT NULL,
  `deskripsi` longtext DEFAULT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `harga` decimal(10,2) NOT NULL,
  `status` varchar(45) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `product`
--

INSERT INTO `product` (`id`, `stok`, `nama`, `deskripsi`, `gambar`, `harga`, `status`) VALUES
(20, 15, 'Produk 1', 'Produk 1 - Meja', NULL, '100000.00', '1'),
(21, 30, 'Produk 2', 'Produk 2 - Kursi', NULL, '2000000.00', '1'),
(22, 20, 'Produk 3', 'Produk 3 - Laptop', NULL, '10000000.00', '1'),
(23, 100, 'Produk 4', 'Produk 4 - Keyboard', NULL, '300000.00', '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `product_order`
--

CREATE TABLE `product_order` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_qtd` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `product_order`
--

INSERT INTO `product_order` (`id`, `order_id`, `product_id`, `product_qtd`) VALUES
(20, 17, 20, 1),
(21, 17, 22, 2),
(22, 18, 20, 3),
(23, 18, 21, 1),
(24, 20, 23, 1),
(25, 21, 20, 3),
(26, 21, 22, 2),
(27, 21, 23, 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_po_idx` (`order_id`),
  ADD KEY `product_po_idx` (`product_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `product_order`
--
ALTER TABLE `product_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `order_po` FOREIGN KEY (`order_id`) REFERENCES `order` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `product_po` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
