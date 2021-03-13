-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Mar 2021 pada 12.20
-- Versi server: 10.4.14-MariaDB
-- Versi PHP: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `starbhakmarket`
--

DELIMITER $$
--
-- Prosedur
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `checkbarangdihapus` ()  BEGIN
SELECT * FROM
stockbarang WHERE IsDeleted = 1;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `belibarang`
--

CREATE TABLE `belibarang` (
  `history_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `belibarang`
--

INSERT INTO `belibarang` (`history_id`, `barang_id`, `stock`) VALUES
(1, 1, 2),
(1, 2, 1),
(2, 1, 3),
(2, 2, 3),
(3, 2, 1),
(3, 1, 5),
(4, 2, 1),
(4, 1, 1),
(5, 2, 1),
(5, 1, 4),
(6, 1, 5),
(6, 6, 1),
(6, 7, 1),
(7, 3, 3);

--
-- Trigger `belibarang`
--
DELIMITER $$
CREATE TRIGGER `after_insert_databeli` AFTER INSERT ON `belibarang` FOR EACH ROW BEGIN
	UPDATE stockbarang 
    SET stockbarang.stock = stockbarang.stock - new.stock WHERE stockbarang.id = new.barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `historybarang`
--

CREATE TABLE `historybarang` (
  `id` int(11) NOT NULL,
  `jumlah_stock` varchar(255) NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `historybarang`
--

INSERT INTO `historybarang` (`id`, `jumlah_stock`, `jumlah_harga`, `created_at`) VALUES
(1, '3', 16500, '2021-03-08 13:52:09'),
(2, '6', 33000, '2021-03-08 09:01:07'),
(3, '6', 33000, '2021-03-08 10:11:45'),
(4, '2', 10500, '2021-03-08 10:12:12'),
(5, '5', 27500, '2021-03-08 10:50:15'),
(6, '7', 49500, '2021-03-08 16:55:29'),
(7, '3', 26400, '2021-03-08 21:12:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stockbarang`
--

CREATE TABLE `stockbarang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `stock` int(11) NOT NULL,
  `jenis` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `IsDeleted` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `stockbarang`
--

INSERT INTO `stockbarang` (`id`, `nama`, `harga`, `stock`, `jenis`, `gambar`, `IsDeleted`) VALUES
(1, 'Nasi Goreng', 5000, 0, 'Makanan', 'https://img-global.cpcdn.com/recipes/8979ffdea7759481/400x400cq70/photo.jpg', 0),
(2, 'Mie Instan', 5000, 0, 'Makanan', 'https://upload.wikimedia.org/wikipedia/commons/7/7f/Korea_Ramyeon.jpg', 0),
(3, 'Es Cincau', 8000, 17, 'Minuman', 'https://www.resepkuerenyah.com/wp-content/uploads/2016/01/es_cincau_hijau_700.jpg', 0),
(4, 'Nasi Kuning', 5000, 10, 'Makanan', 'https://ecs7.tokopedia.net/img/cache/700/product-1/2019/10/6/494062/494062_dd40d962-0b4e-4132-baf6-8727627f414a_1358_1358.jpg', 0),
(5, 'Ramen', 10000, 9, 'Makanan', 'https://upload.wikimedia.org/wikipedia/commons/f/fc/Soy_ramen.jpg', 0),
(6, 'Tamagoyaki', 8000, 6, 'Makanan', 'https://img-global.cpcdn.com/recipes/72e064886d1d570c/1200x630cq70/photo.jpg', 0),
(7, 'Chiken Katsu', 12000, 7, 'Makanan', 'https://cdn.yummy.co.id/content-images/images/20200115/UxI3zfZJmFGB29jlA7pBT0cxcNEdFuhW-31353739303638363838d41d8cd98f00b204e9800998ecf8427e_800x800.jpg', 0),
(8, 'Ebi Furai', 16000, 15, 'Makanan', 'https://img-global.cpcdn.com/recipes/c60cbbb2086da76d/751x532cq70/ebi-furai-salad-mayonaise-ala-ala-hokben-foto-resep-utama.jpg', 0),
(9, 'Takoyaki', 12000, 12, 'Makanan', 'https://upload.wikimedia.org/wikipedia/commons/c/cb/Takoyaki.jpg', 0),
(10, 'Manju', 7000, 6, 'Makanan', 'https://upload.wikimedia.org/wikipedia/commons/thumb/c/c1/Carinto_manjyu.JPG/1200px-Carinto_manjyu.JPG', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `belibarang`
--
ALTER TABLE `belibarang`
  ADD KEY `kelas_barang_id_foreign` (`barang_id`),
  ADD KEY `kelas_history_id_foreign` (`history_id`);

--
-- Indeks untuk tabel `historybarang`
--
ALTER TABLE `historybarang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stockbarang`
--
ALTER TABLE `stockbarang`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `historybarang`
--
ALTER TABLE `historybarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `stockbarang`
--
ALTER TABLE `stockbarang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `belibarang`
--
ALTER TABLE `belibarang`
  ADD CONSTRAINT `kelas_barang_id_foreign` FOREIGN KEY (`barang_id`) REFERENCES `stockbarang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `kelas_history_id_foreign` FOREIGN KEY (`history_id`) REFERENCES `historybarang` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
