-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 26, 2018 at 11:59 PM
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
(1, 'penjual', 0005),
(2, 'pelanggan', 0002),
(3, 'transaksi', 0021),
(4, 'pembayaran_penjual', 0001),
(5, 'pesanan', 0027),
(6, 'meja', 0002),
(7, 'karyawan', 0001),
(8, 'makanan', 0011);

-- --------------------------------------------------------

--
-- Table structure for table `item_pesanan`
--

CREATE TABLE `item_pesanan` (
  `id_pesanan` varchar(20) NOT NULL,
  `id_makanan` varchar(20) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `subtotal` int(20) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_pesanan`
--

INSERT INTO `item_pesanan` (`id_pesanan`, `id_makanan`, `jumlah`, `subtotal`, `status`) VALUES
('PES3', 'm001', 1, 5000, 1),
('PES3', 'MK10', 0, 0, 0),
('PES3', 'm001', 1, 5000, 1),
('PES3', 'm001', 1, 5000, 1),
('PES3', 'm001', 1, 5000, 1),
('PES3', 'MK10', 0, 0, 0),
('PES3', 'MK10', 0, 0, 0),
('PES3', 'm001', 1, 5000, 1),
('PES3', 'MK10', 0, 0, 0),
('PES3', 'MK10', 0, 0, 0),
('PES4', 'MK10', 3, 24000, 0),
('PES5', 'MK10', 3, 24000, 0),
('PES6', 'MK10', 3, 24000, 0),
('PES7', 'MK10', 3, 24000, 0),
('PES8', 'MK10', 3, 24000, 0),
('PES9', 'm001', 2, 10000, 0),
('PES9', 'm001', 0, 0, 0),
('PES9', 'm001', 1, 5000, 0),
('PES9', 'm001', 2, 10000, 0),
('PES14', 'm001', 2, 10000, 0),
('PES15', 'm001', 2, 10000, 0),
('PES18', 'm001', 1, 5000, 0),
('PES18', 'MK10', 1, 8000, 0),
('PES19', 'm001', 1, 5000, 1),
('PES19', 'MK10', 2, 16000, 0),
('PES20', 'm001', 3, 15000, 1),
('PES24', 'm001', 4, 20000, 1),
('PES25', 'm001', 6, 30000, 1),
('PES26', 'm001', 2, 10000, 1),
('PES26', 'MK10', 1, 8000, 0);

--
-- Triggers `item_pesanan`
--
DELIMITER $$
CREATE TRIGGER `countSubTotal` BEFORE INSERT ON `item_pesanan` FOR EACH ROW BEGIN
DECLARE vharga int;
SELECT harga FROM makanan WHERE id_makanan=new.id_makanan INTO vharga;
SET NEW.subtotal =vharga*new.jumlah;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `countSubTotalUpdate` BEFORE UPDATE ON `item_pesanan` FOR EACH ROW BEGIN
DECLARE vharga int;
SELECT harga FROM makanan WHERE id_makanan=new.id_makanan INTO vharga;
SET NEW.subtotal =vharga*new.jumlah;
END
$$
DELIMITER ;

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
  `id_penjual` varchar(20) NOT NULL,
  `desc` varchar(50) NOT NULL,
  `deskripsi` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `makanan`
--

INSERT INTO `makanan` (`id_makanan`, `nama`, `harga`, `stok`, `gambar`, `id_penjual`, `desc`, `deskripsi`) VALUES
('m001', 'Jagung Bakar', 5000, 40, 'jagung_bakar_1_1.jpg', 'p001', '', NULL),
('MK10', 'mi dog dog', 8000, 14, '', 'PJ2', 'MIE RA ENAK', NULL);

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
-- Dumping data for table `meja`
--

INSERT INTO `meja` (`id_meja`, `status`) VALUES
('MJ1', 'free');

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
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `username`, `password`, `no_hp`) VALUES
('PL1', 'arif', '16.11.0058', '1234', NULL);

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
  `no_npwp` varchar(20) DEFAULT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  `desc` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `penjual`
--

INSERT INTO `penjual` (`id_penjual`, `nama`, `username`, `password`, `no_stand`, `no_npwp`, `gambar`, `desc`) VALUES
('p001', 'Soto Barokah', 'barokah', 'barokah', '01', NULL, NULL, NULL),
('PJ1', 'Mas Kobis', 'maskobis', 'maskobis', '02', '', NULL, NULL),
('PJ2', 'Prek Su', 'preksu', 'preksu', '03', '', NULL, NULL),
('PJ3', 'Bu Bagyo', 'bagyo', 'bagyo', '04', '', NULL, NULL),
('PJ4', 'Olive', 'olive', 'plive', '05', '', NULL, NULL);

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
  `tanggal_pesanan` datetime NOT NULL,
  `total_pesanan` int(11) NOT NULL,
  `id_meja` varchar(20) DEFAULT NULL,
  `id_pelanggan` varchar(20) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `tanggal_pesanan`, `total_pesanan`, `id_meja`, `id_pelanggan`, `status`) VALUES
('PES10', '2018-12-24 00:00:00', 0, 'MJ1', 'PL1', 1),
('PES11', '2018-12-24 00:00:00', 5000, 'MJ1', 'PL1', 1),
('PES12', '2018-12-24 00:00:00', 10000, 'MJ1', 'PL1', 1),
('PES13', '2018-12-24 21:02:59', 0, 'MJ1', 'PL1', 1),
('PES14', '2018-12-24 21:03:52', 10000, 'MJ1', 'PL1', 1),
('PES15', '2018-12-24 22:10:22', 10000, 'MJ1', 'PL1', 1),
('PES16', '2018-12-24 22:10:58', 0, 'MJ1', 'PL1', 1),
('PES17', '2018-12-24 22:11:12', 0, 'MJ1', 'PL1', 1),
('PES18', '2018-12-24 22:16:46', 13000, 'MJ1', 'PL1', 1),
('PES19', '2018-12-25 03:02:14', 21000, 'MJ1', 'PL1', 1),
('PES20', '2018-12-25 08:10:12', 15000, 'MJ1', 'PL1', 1),
('PES24', '2018-12-26 06:25:37', 20000, 'MJ1', 'PL1', 1),
('PES25', '2018-12-26 06:29:28', 30000, 'MJ1', 'PL1', 1),
('PES26', '2018-12-26 06:42:45', 18000, 'MJ1', 'PL1', 1),
('PES3', '2018-12-20 00:00:00', 0, 'MJ1', 'PL1', 1),
('PES4', '2018-12-24 00:00:00', 24000, 'MJ1', 'PL1', 1),
('PES5', '2018-12-24 00:00:00', 24000, 'MJ1', 'PL1', 1),
('PES6', '2018-12-24 00:00:00', 24000, 'MJ1', 'PL1', 0),
('PES7', '2018-12-24 00:00:00', 24000, 'MJ1', 'PL1', 0),
('PES8', '2018-12-24 00:00:00', 24000, 'MJ1', 'PL1', 1),
('PES9', '2018-12-24 00:00:00', 10000, 'MJ1', 'PL1', 1);

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
  `bayar` varchar(20) NOT NULL,
  `kembalian` varchar(20) NOT NULL,
  `id_karyawan` varchar(20) NOT NULL,
  `id_pesanan` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `tanggal_transaksi`, `bayar`, `kembalian`, `id_karyawan`, `id_pesanan`) VALUES
('TR10', '2018-12-23', '20', '10', 'k001', 'PES3'),
('TR11', '2018-12-21', '30', '10', 'k002', 'PES3'),
('TR12', '2018-12-25', '24000', '0', 'k001', 'PES8'),
('TR13', '2018-12-25', '21000', '0', 'k001', 'PES19'),
('TR14', '2018-12-25', '20000', '5000', 'k001', 'PES20'),
('TR15', '2018-12-25', '30000', '5000', 'k001', 'PES3'),
('TR16', '2018-12-26', '25000', '1000', 'k001', 'PES4'),
('TR17', '2018-12-26', '24000', '0', 'k001', 'PES5'),
('TR18', '2018-12-26', '25000', '5000', 'k001', 'PES24'),
('TR19', '2018-12-26', '40000', '10000', 'k001', 'PES25'),
('TR20', '2018-12-26', '18000', '0', 'k001', 'pes26');

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
  ADD KEY `pesanan_ibfk_3` (`id_pelanggan`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `transaksi_fk1` (`id_pesanan`),
  ADD KEY `transaksi_fk2` (`id_karyawan`);

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
  ADD CONSTRAINT `pesanan_ibfk_3` FOREIGN KEY (`id_pelanggan`) REFERENCES `pelanggan` (`id_pelanggan`) ON UPDATE CASCADE;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_fk1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_fk2` FOREIGN KEY (`id_karyawan`) REFERENCES `karyawan` (`id_karyawan`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
