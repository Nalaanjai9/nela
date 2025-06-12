-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 07:29 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uasnela`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `idberita` int(11) NOT NULL,
  `judul` varchar(20) NOT NULL,
  `kategori` varchar(20) NOT NULL,
  `headline` varchar(20) NOT NULL,
  `isi_berita` text NOT NULL,
  `pengirim` varchar(20) NOT NULL,
  `tanggal_publish` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`idberita`, `judul`, `kategori`, `headline`, `isi_berita`, `pengirim`, `tanggal_publish`) VALUES
(4, 'Kekerasan Seksual', '1', 'Penangkapan inisial ', '<p>Pengakuan warga ditemukan korban inisial AJ yang mengaku telah menerima kekerasan seksual oleh seorang paman nya sendiri. warga yang melihat tanda kekerasa tersebut langsung melaporkan kepada pihak berwajib dan akan tindak lanjuti kepada pelaku, sejauh mana ia melakukan kekesaran terhadap AJ</p>', 'Filan', '2025-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `nidn` int(10) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jeniskel` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`nidn`, `nama`, `alamat`, `jeniskel`, `email`, `telp`) VALUES
(234683082, 'lilis', 'kalimantan', 'Perempuan', 'lilis@gmail.com', '9287398722'),
(1111111111, 'wwwaa', 'semarangw', 'Laki-Laki', 'warn1i@gmail.com', '08936812839'),
(2147483647, 'warni', 'semarang', 'Laki-Laki', 'warni@gmail.com', '08936812839');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_berita`
--

CREATE TABLE `kategori_berita` (
  `idberita` int(11) NOT NULL,
  `kategori` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_berita`
--

INSERT INTO `kategori_berita` (`idberita`, `kategori`) VALUES
(1, 'langsung'),
(2, 'tidak langsung');

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(255) DEFAULT NULL,
  `alamat_pelanggan` text NOT NULL,
  `telepon_pelanggan` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `alamat_pelanggan`, `telepon_pelanggan`, `created_at`, `updated_at`) VALUES
(3, 'Rina', 'Cisoka', '084567890876', '2025-06-12 05:19:09', '2025-06-12 05:19:09');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(256) NOT NULL,
  `nama_produk` varchar(256) NOT NULL,
  `harga_produk` decimal(65,0) NOT NULL,
  `stok_produk` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id_produk`, `kode_produk`, `nama_produk`, `harga_produk`, `stok_produk`, `created_at`, `update_at`) VALUES
(5, 'BK08', 'Beras', '15000', 13, '2025-06-12 05:10:35', '2025-06-12 05:20:26');

-- --------------------------------------------------------

--
-- Table structure for table `sales_orders`
--

CREATE TABLE `sales_orders` (
  `id_sales_order` int(11) NOT NULL,
  `nomor_order` varchar(50) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `id_sales_person` int(11) NOT NULL,
  `tanggal_order` datetime NOT NULL,
  `total_harga` decimal(15,2) NOT NULL DEFAULT '0.00',
  `status_order` enum('draft','dikirim','selesai','dibatalkan') NOT NULL DEFAULT 'draft',
  `catatan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_orders`
--

INSERT INTO `sales_orders` (`id_sales_order`, `nomor_order`, `id_pelanggan`, `id_sales_person`, `tanggal_order`, `total_harga`, `status_order`, `catatan`, `created_at`, `updated_at`) VALUES
(5, 'SO-20250612-0001', 3, 3, '2025-06-12 12:20:00', '30000.00', 'selesai', 'hajsohdaud', '2025-06-12 05:20:26', '2025-06-12 05:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_items`
--

CREATE TABLE `sales_order_items` (
  `id_order_item` int(11) NOT NULL,
  `id_sales_order` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_saat_order` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order_items`
--

INSERT INTO `sales_order_items` (`id_order_item`, `id_sales_order`, `id_produk`, `jumlah`, `harga_saat_order`, `subtotal`) VALUES
(5, 5, 5, 2, '15000.00', '30000.00');

-- --------------------------------------------------------

--
-- Table structure for table `sales_persons`
--

CREATE TABLE `sales_persons` (
  `id_sales_person` int(11) NOT NULL,
  `kode_sales` varchar(50) NOT NULL,
  `nama_sales` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_persons`
--

INSERT INTO `sales_persons` (`id_sales_person`, `kode_sales`, `nama_sales`, `created_at`, `updated_at`) VALUES
(3, 'SAL45', 'Halim', '2025-06-12 05:19:40', '2025-06-12 05:19:40');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('Admin','user','Sales','Manager') NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `create_at`) VALUES
(21, 'Karina', '$2y$10$Vl0uKJpKJpSGaQx/NtyR5uty6iMN/G9XlfY4DDLaRy5uPY3mmdvC.', 'Admin', '2025-06-12 05:26:40'),
(22, 'Gisel', '$2y$10$UusE4YWs0Ixke/NyCn8UpON.LrZp9sBNEWg4.JHQduY8EMkPW9kva', 'user', '2025-06-12 05:27:28'),
(23, 'widia', '$2y$10$TwnnILcxiPMQDEdeLREJvu4ATpivZptVC1oHPmh8DC4/2PEOHp0F6', 'Sales', '2025-06-12 05:28:26'),
(24, 'farah', '$2y$10$zLn6IJyuZYrKvH7U64GK/O4a24dwgIWTXd8yH1rgAQJnG9AMDCQDa', 'Manager', '2025-06-12 05:29:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`idberita`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`nidn`);

--
-- Indexes for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  ADD PRIMARY KEY (`idberita`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD PRIMARY KEY (`id_sales_order`),
  ADD UNIQUE KEY `nomor_order` (`nomor_order`),
  ADD KEY `id_pelanggan` (`id_pelanggan`),
  ADD KEY `id_sales_person` (`id_sales_person`);

--
-- Indexes for table `sales_order_items`
--
ALTER TABLE `sales_order_items`
  ADD PRIMARY KEY (`id_order_item`),
  ADD KEY `id_sales_order` (`id_sales_order`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `sales_persons`
--
ALTER TABLE `sales_persons`
  ADD PRIMARY KEY (`id_sales_person`),
  ADD UNIQUE KEY `kode_sales` (`kode_sales`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `idberita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `nidn` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2147483647;

--
-- AUTO_INCREMENT for table `kategori_berita`
--
ALTER TABLE `kategori_berita`
  MODIFY `idberita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_orders`
--
ALTER TABLE `sales_orders`
  MODIFY `id_sales_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_order_items`
--
ALTER TABLE `sales_order_items`
  MODIFY `id_order_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sales_persons`
--
ALTER TABLE `sales_persons`
  MODIFY `id_sales_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sales_orders`
--
ALTER TABLE `sales_orders`
  ADD CONSTRAINT `sales_orders_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `sales_orders_ibfk_2` FOREIGN KEY (`id_sales_person`) REFERENCES `sales_persons` (`id_sales_person`);

--
-- Constraints for table `sales_order_items`
--
ALTER TABLE `sales_order_items`
  ADD CONSTRAINT `sales_order_items_ibfk_1` FOREIGN KEY (`id_sales_order`) REFERENCES `sales_orders` (`id_sales_order`) ON DELETE CASCADE,
  ADD CONSTRAINT `sales_order_items_ibfk_2` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id_produk`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
