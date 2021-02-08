-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.11-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for database_kawasaki
CREATE DATABASE IF NOT EXISTS `database_kawasaki` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `database_kawasaki`;

-- Dumping structure for table database_kawasaki.gejala
CREATE TABLE IF NOT EXISTS `gejala` (
  `id_gejala` int(11) NOT NULL AUTO_INCREMENT,
  `kode_gejala` varchar(50) NOT NULL,
  `nama_gejala` varchar(255) NOT NULL,
  `nilai_ds` float NOT NULL,
  PRIMARY KEY (`id_gejala`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_kawasaki.gejala: ~11 rows (approximately)
/*!40000 ALTER TABLE `gejala` DISABLE KEYS */;
INSERT INTO `gejala` (`id_gejala`, `kode_gejala`, `nama_gejala`, `nilai_ds`) VALUES
	(1, 'G1', 'Kondisi filter kosong', 0.7),
	(2, 'G2', 'Tekanan kompersi rendah', 0.6),
	(3, 'G3', 'Piston dan silinder aus', 0.5),
	(4, 'G4', 'Pilot jet mampet membuat suplai bensin berkurang', 0.5),
	(5, 'G5', 'Busi kotor menyebabkan api busi tidak maksimal', 0.6),
	(6, 'G6', 'Api busi terlalu kecil bias juga karena kerusakan didalam busi', 0.7),
	(7, 'G7', 'Kompresi silinder rendah', 0.4),
	(8, 'G8', 'Sistem pengapian rusak', 0.4),
	(9, 'G9', 'Saringan injeksi rusak ', 0.6),
	(10, 'G10', 'Pasokan bahan bakar terlalu rendah', 0.2),
	(11, 'G11', 'Baterai soak', 0.5),
	(12, 'G12', 'Campuran bensin terlalu kurus (Lean AFM)', 0.6),
	(13, 'G13', 'Kompresi mesin rendah ', 0.4);
/*!40000 ALTER TABLE `gejala` ENABLE KEYS */;

-- Dumping structure for table database_kawasaki.kerusakan
CREATE TABLE IF NOT EXISTS `kerusakan` (
  `id_kerusakan` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kerusakan` varchar(255) NOT NULL,
  `nama_kerusakan` varchar(255) NOT NULL,
  `solusi` text NOT NULL,
  PRIMARY KEY (`id_kerusakan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_kawasaki.kerusakan: ~3 rows (approximately)
/*!40000 ALTER TABLE `kerusakan` DISABLE KEYS */;
INSERT INTO `kerusakan` (`id_kerusakan`, `kode_kerusakan`, `nama_kerusakan`, `solusi`) VALUES
	(4, 'K1', 'Tenaga Mesin Berkurang', 'Harus  tune up , atau mengganti part-part yang sudah lama dan haus , dan lakukan service secara berkala agar menjadi lebih baik'),
	(5, 'K2', 'Suara mesin ribut atau tidak stabil', 'Mengganti part mesin bagian piston maupub kruk as , agar lebih halus dan mengganti busi agar tetap stabil dan netral'),
	(6, 'K3', 'Bensin terlalu kotor', 'Disarankan untuk selalu memakai pertamax yang ada di spbu , membersihkan tangki bensin selama 6 bulan 1 kali penggantian . dan juga selalu service karburator .');
/*!40000 ALTER TABLE `kerusakan` ENABLE KEYS */;

-- Dumping structure for table database_kawasaki.pemilik
CREATE TABLE IF NOT EXISTS `pemilik` (
  `id_pemilik` int(11) NOT NULL AUTO_INCREMENT,
  `nama_pemilik` varchar(100) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `alamat` text NOT NULL,
  `tgl_konsul` date NOT NULL,
  `id_kerusakan` int(11) NOT NULL,
  `gejala` longtext DEFAULT NULL,
  `total_perhitungan` float NOT NULL,
  PRIMARY KEY (`id_pemilik`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_kawasaki.pemilik: ~7 rows (approximately)
/*!40000 ALTER TABLE `pemilik` DISABLE KEYS */;
INSERT INTO `pemilik` (`id_pemilik`, `nama_pemilik`, `no_hp`, `alamat`, `tgl_konsul`, `id_kerusakan`, `gejala`, `total_perhitungan`) VALUES
	(31, 'Titra Adi Jaya', '12345678', 'Jl. Apa aja yang penting rumah ', '2020-08-11', 6, 'a:6:{i:0;i:4;i:1;i:9;i:2;i:10;i:3;i:11;i:4;i:12;i:5;i:13;}', 0.9616),
	(32, 'Muhammad Ilham', '082378900001', 'Jl. Merdeka N. 29', '2020-08-12', 5, 'a:4:{i:0;i:4;i:1;i:6;i:2;i:7;i:3;i:8;}', 0.892),
	(33, 'N. Simatupang', '08237890001', 'Jl. Merdeka No. 29', '2020-08-13', 5, 'a:4:{i:0;i:4;i:1;i:6;i:2;i:7;i:3;i:8;}', 0.892),
	(34, 'testes', '12345678', 'Jl. Apa aja yang penting rumah ', '2020-08-21', 4, 'a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}', 0.94),
	(35, 'Titra Adi Jaya', '12345678', 'jlnjln jln aja', '2020-08-26', 4, 'a:6:{i:0;i:1;i:1;i:3;i:2;i:4;i:3;i:6;i:4;i:7;i:5;i:10;}', 0.493947),
	(36, 'dedi', '999', 'gsffffffffd', '2020-09-05', 4, 'a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}', 0.94),
	(37, 'dedi', '999', 'gsffffffffd', '2020-09-05', 4, 'a:3:{i:0;i:1;i:1;i:2;i:2;i:3;}', 0.94);
/*!40000 ALTER TABLE `pemilik` ENABLE KEYS */;

-- Dumping structure for table database_kawasaki.rule
CREATE TABLE IF NOT EXISTS `rule` (
  `id_rule` int(11) NOT NULL AUTO_INCREMENT,
  `id_gejala` int(11) NOT NULL DEFAULT 0,
  `id_kerusakan` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_rule`),
  KEY `fk_rule_gejala` (`id_gejala`),
  KEY `fk_rule_kerusakan` (`id_kerusakan`),
  CONSTRAINT `fk_rule_gejala` FOREIGN KEY (`id_gejala`) REFERENCES `gejala` (`id_gejala`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_rule_kerusakan` FOREIGN KEY (`id_kerusakan`) REFERENCES `kerusakan` (`id_kerusakan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_kawasaki.rule: ~14 rows (approximately)
/*!40000 ALTER TABLE `rule` DISABLE KEYS */;
INSERT INTO `rule` (`id_rule`, `id_gejala`, `id_kerusakan`) VALUES
	(3, 1, 4),
	(4, 2, 4),
	(5, 3, 4),
	(6, 4, 4),
	(7, 4, 5),
	(8, 5, 5),
	(9, 6, 5),
	(10, 7, 5),
	(11, 8, 5),
	(12, 4, 6),
	(13, 9, 6),
	(14, 10, 6),
	(15, 11, 6),
	(16, 12, 6),
	(17, 13, 6);
/*!40000 ALTER TABLE `rule` ENABLE KEYS */;

-- Dumping structure for table database_kawasaki.user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table database_kawasaki.user: ~0 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `nama_lengkap`, `email`, `no_hp`, `password`) VALUES
	(1, 'Sopan', 'sopansopian@gmail.com', '081238888878', 'sopan');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
