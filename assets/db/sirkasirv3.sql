-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2018 at 08:09 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sirkasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `hitung`
--

CREATE TABLE `hitung` (
  `id_hitung` int(11) NOT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nomer` int(4) UNSIGNED ZEROFILL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hitung`
--

INSERT INTO `hitung` (`id_hitung`, `kode`, `nomer`) VALUES
(1, 'penjual', 0001),
(2, 'pelanggan', 0001),
(3, 'transaksi', 0001),
(4, 'pembayaran_penjual', 0001),
(5, 'pesanan', 0001),
(6, 'meja', 0001),
(7, 'karyawan', 0001),
(8, 'makanan', 0002);

-- --------------------------------------------------------

--
-- Table structure for table `item_pesanan`
--

CREATE TABLE `item_pesanan` (
  `id_pesanan` varchar(20) NOT NULL,
  `id_makanan` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `id_karyawan` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(14) NOT NULL,
  `no_ktp` varchar(16) NOT NULL,
  `bagian` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`id_karyawan`, `username`, `password`, `no_hp`, `no_ktp`, `bagian`) VALUES
('k001', 'aminudin', '1234', '0812345678', '1234567890123456', 'kasir'),
('k002', 'petugas', 'petugas', '08123456778', '1234678903234', 'petugas');

--
-- Triggers `karyawan`
--
DELIMITER $$
CREATE TRIGGER `tg_after_karyawan` AFTER INSERT ON `karyawan` FOR EACH ROW BEGIN
UPDATE `hitung` SET `nomer`=nomer+1 WHERE kode='karyawan' ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_before_karyawan` BEFORE INSERT ON `karyawan` FOR EACH ROW BEGIN
DECLARE vhitung int;
SELECT nomer from hitung where kode='karyawan' INTO vhitung;
SET NEW.id_karyawan =concat('KY',vhitung);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `makanan`
--

CREATE TABLE `makanan` (
  `id_makanan` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `gambar` varchar(100) NOT NULL,
  `id_penjual` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`id_makanan`, `nama`, `harga`, `stok`, `gambar`, `id_penjual`) VALUES
('m001', 'Jagung Bakar', 5000, 40, '', 'p001'),
('MK1', 'Soto Kambing', 10000, 20, '', 'p001');

--
-- Triggers `makanan`
--
DELIMITER $$
CREATE TRIGGER `tg_after_makanan` AFTER INSERT ON `makanan` FOR EACH ROW BEGIN
UPDATE `hitung` SET `nomer`=nomer+1 WHERE kode='makanan' ;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_before_makanan` BEFORE INSERT ON `makanan` FOR EACH ROW BEGIN
DECLARE vhitung int;
SELECT nomer FROM hitung WHERE kode='makanan' INTO vhitung;
SET NEW.id_makanan =concat('MK',vhitung);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `meja`
--

CREATE TABLE `meja` (
  `id_meja` varchar(20) NOT NULL,
  `status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `meja`
--
DELIMITER $$
CREATE TRIGGER `tg_after_meja` AFTER INSERT ON `meja` FOR EACH ROW BEGIN
UPDATE `hitung` SET `nomer`=nomer+1 WHERE kode='meja' ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_before_meja` BEFORE INSERT ON `meja` FOR EACH ROW BEGIN
DECLARE vhitung int;
SELECT nomer from hitung where kode='meja' INTO vhitung;
SET NEW.id_meja =concat('MJ',vhitung);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` varchar(20) NOT NULL,
  `nama` varchar(40) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `no_hp` varchar(14) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `pelanggan`
--
DELIMITER $$
CREATE TRIGGER `tg_after_pelanggan` AFTER INSERT ON `pelanggan` FOR EACH ROW BEGIN
UPDATE `hitung` SET `nomer`=nomer+1 WHERE kode='pelanggan' ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_bf_pembeli` BEFORE INSERT ON `pelanggan` FOR EACH ROW BEGIN
DECLARE vhitung int;
SELECT nomer from hitung where kode='pelanggan' INTO vhitung;
SET NEW.id_pelanggan =concat('PL',vhitung);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran_penjual`
--

CREATE TABLE `pembayaran_penjual` (
  `id_pem_penjual` varchar(20) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `id_transaksi` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `pembayaran_penjual`
--
DELIMITER $$
CREATE TRIGGER `tg_after_pem_penjual` AFTER INSERT ON `pembayaran_penjual` FOR EACH ROW BEGIN
UPDATE `hitung` SET `nomer`=nomer+1 WHERE kode='pembayaran_penjual' ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_bf_pembayaran_penjual` BEFORE INSERT ON `pembayaran_penjual` FOR EACH ROW BEGIN
DECLARE vhitung int;
SELECT nomer from hitung where kode='pembayaran_penjual' INTO vhitung;
SET NEW.id_pem_penjual =concat('PP',vhitung);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `penjual`
--

CREATE TABLE `penjual` (
  `id_penjual` varchar(20) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_stand` varchar(10) NOT NULL,
  `no_npwp` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`id_penjual`, `nama`, `username`, `password`, `no_stand`, `no_npwp`) VALUES
('p001', 'Soto Barokah', 'barokah', 'barokah', '01', NULL);

--
-- Triggers `penjual`
--
DELIMITER $$
CREATE TRIGGER `tg_after_penjual` AFTER INSERT ON `penjual` FOR EACH ROW BEGIN
UPDATE `hitung` SET `nomer`=nomer+1 WHERE kode='penjual' ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_bf_penjual` BEFORE INSERT ON `penjual` FOR EACH ROW BEGIN
DECLARE vhitung int;
SELECT nomer from hitung where kode='penjual' INTO vhitung;
SET NEW.id_penjual=concat('PJ',vhitung);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` varchar(20) NOT NULL,
  `tanggal_pesanan` date NOT NULL,
  `total_pesanan` int(11) NOT NULL,
  `id_meja` varchar(20) DEFAULT NULL,
  `id_karyawan` varchar(20) NOT NULL,
  `id_pelanggan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `pesanan`
--
DELIMITER $$
CREATE TRIGGER `tg_after_pesanan` AFTER INSERT ON `pesanan` FOR EACH ROW BEGIN
UPDATE `hitung` SET `nomer`=nomer+1 WHERE kode='pesanan' ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_bf_pesanan` BEFORE INSERT ON `pesanan` FOR EACH ROW BEGIN
DECLARE vhitung int;
SELECT nomer from hitung where kode='pesanan' INTO vhitung;
SET NEW.id_pesanan =concat('PES',vhitung);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` varchar(20) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `id_pesanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `tg_after_transaksi` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
UPDATE `hitung` SET `nomer`=nomer+1 WHERE kode='transaksi' ;
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `tg_bf_transaksi` BEFORE INSERT ON `transaksi` FOR EACH ROW BEGIN
DECLARE vhitung int;
SELECT nomer from hitung where kode='transaksi' INTO vhitung;
SET NEW.id_transaksi =concat('TR',vhitung);
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hitung`
--
ALTER TABLE `hitung`
  ADD PRIMARY KEY (`id_hitung`);

--
-- Indexes for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  ADD KEY `item_makanan_fk1` (`id_makanan`),
  ADD KEY `item_makanan_fk2` (`id_pesanan`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`id_karyawan`);

--
-- Indexes for table `makanan`
--
ALTER TABLE `makanan`
  ADD PRIMARY KEY (`id_makanan`),
  ADD KEY `id_penjual` (`id_penjual`);

--
-- Indexes for table `meja`
--
ALTER TABLE `meja`
  ADD PRIMARY KEY (`id_meja`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `pembayaran_penjual`
--
ALTER TABLE `pembayaran_penjual`
  ADD PRIMARY KEY (`id_pem_penjual`),
  ADD KEY `pem_penjual_fk1` (`id_transaksi`);

--
-- Indexes for table `penjual`
--
ALTER TABLE `penjual`
  ADD PRIMARY KEY (`id_penjual`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_meja` (`id_meja`),
  ADD KEY `id_karyawan` (`id_karyawan`),
  ADD KEY `pesanan_ibfk_3` (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_fk1` (`id_pesanan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hitung`
--
ALTER TABLE `hitung`
  MODIFY `id_hitung` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_pesanan`
--
ALTER TABLE `item_pesanan`
  ADD CONSTRAINT `item_makanan_fk1` FOREIGN KEY (`id_makanan`) REFERENCES `makanan` (`id_makanan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `item_makanan_fk2` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON UPDATE CASCADE;

--
-- Constraints for table `makanan`
--
ALTER TABLE `makanan`
  ADD CONSTRAINT `makanan_ibfk_1` FOREIGN KEY (`id_penjual`) REFERENCES `penjual` (`id_penjual`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pembayaran_penjual`
--
ALTER TABLE `pembayaran_penjual`
  ADD CONSTRAINT `pem_penjual_fk1` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id_transaksi`) ON UPDATE CASCADE;

--
-- Constraints for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`id_meja`) REFERENCES `meja` (`id_meja`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_fk1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
