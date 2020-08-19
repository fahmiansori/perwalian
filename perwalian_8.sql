-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for perwalian
CREATE DATABASE IF NOT EXISTS `perwalian` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `perwalian`;

-- Dumping structure for table perwalian.dosen
CREATE TABLE IF NOT EXISTS `dosen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(20) DEFAULT NULL,
  `nama_dosen` varchar(100) DEFAULT NULL,
  `alamat_dosen` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tanda_tangan` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip` (`nip`),
  UNIQUE KEY `user_id` (`user_id`),
  CONSTRAINT `FK_dosen_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table perwalian.dosen: ~0 rows (approximately)
DELETE FROM `dosen`;
/*!40000 ALTER TABLE `dosen` DISABLE KEYS */;
INSERT INTO `dosen` (`id`, `nip`, `nama_dosen`, `alamat_dosen`, `user_id`, `tanda_tangan`) VALUES
	(3, '1111', 'dosen wali', 'alamatan dosne', 26, '3.png'),
	(5, '1111222', 'sadasd', 'dasda', 31, '5.png');
/*!40000 ALTER TABLE `dosen` ENABLE KEYS */;

-- Dumping structure for table perwalian.jadwal_perwalian
CREATE TABLE IF NOT EXISTS `jadwal_perwalian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  `semester` int(11) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_jadwal_perwalian_mahasiswa` (`nim`),
  KEY `FK_jadwal_perwalian_dosen` (`dosen_id`),
  KEY `FK_jadwal_perwalian_user` (`user_id`),
  CONSTRAINT `FK_jadwal_perwalian_dosen` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  CONSTRAINT `FK_jadwal_perwalian_mahasiswa` FOREIGN KEY (`nim`) REFERENCES `mahasiswa` (`nim`),
  CONSTRAINT `FK_jadwal_perwalian_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Dumping data for table perwalian.jadwal_perwalian: ~7 rows (approximately)
DELETE FROM `jadwal_perwalian`;
/*!40000 ALTER TABLE `jadwal_perwalian` DISABLE KEYS */;
INSERT INTO `jadwal_perwalian` (`id`, `nim`, `dosen_id`, `user_id`, `waktu`, `semester`, `status`) VALUES
	(5, '13221sd11', 3, 1, '1970-01-01 01:00:00', NULL, 'expired'),
	(6, '13221sd11', 3, 1, '2020-08-13 17:30:00', NULL, 'done'),
	(7, '13221sd11', 3, 1, '2020-08-14 23:04:00', NULL, 'expired'),
	(8, '13221sd11', 3, 1, '2020-08-19 09:25:00', 12, 'waiting'),
	(9, '11213', 3, 1, '2020-08-18 10:26:00', 6, 'expired'),
	(10, '11213', 3, 26, '2020-08-20 14:05:00', 5, 'waiting'),
	(11, '11213', 3, 26, '2020-08-19 14:52:00', 4, 'done');
/*!40000 ALTER TABLE `jadwal_perwalian` ENABLE KEYS */;

-- Dumping structure for table perwalian.mahasiswa
CREATE TABLE IF NOT EXISTS `mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nim` varchar(20) NOT NULL DEFAULT '',
  `nama_mahasiswa` varchar(100) DEFAULT NULL,
  `alamat_mahasiswa` text DEFAULT NULL,
  `dosen_id` int(11) DEFAULT NULL,
  `program_studi_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tahun_masuk` int(11) DEFAULT NULL,
  PRIMARY KEY (`nim`),
  UNIQUE KEY `user_id` (`user_id`,`id`) USING BTREE,
  KEY `FK__dosen` (`dosen_id`),
  KEY `FK_mahasiswa_program_studi` (`program_studi_id`),
  KEY `id` (`id`),
  CONSTRAINT `FK__dosen` FOREIGN KEY (`dosen_id`) REFERENCES `dosen` (`id`),
  CONSTRAINT `FK_mahasiswa_program_studi` FOREIGN KEY (`program_studi_id`) REFERENCES `program_studi` (`id`),
  CONSTRAINT `FK_mahasiswa_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

-- Dumping data for table perwalian.mahasiswa: ~2 rows (approximately)
DELETE FROM `mahasiswa`;
/*!40000 ALTER TABLE `mahasiswa` DISABLE KEYS */;
INSERT INTO `mahasiswa` (`id`, `nim`, `nama_mahasiswa`, `alamat_mahasiswa`, `dosen_id`, `program_studi_id`, `user_id`, `tahun_masuk`) VALUES
	(7, '11213', 'nama', 'sdadasdas', 3, 1, 28, 2019),
	(6, '13221sd11', 'asdasazzzzzzzz', 'asdaszzzzzzz', 3, 1, 27, 2000);
/*!40000 ALTER TABLE `mahasiswa` ENABLE KEYS */;

-- Dumping structure for table perwalian.perwalian
CREATE TABLE IF NOT EXISTS `perwalian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_perwalian_id` int(11) DEFAULT NULL,
  `isi_perwalian` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_perwalian_jadwal_perwalian` (`jadwal_perwalian_id`),
  CONSTRAINT `FK_perwalian_jadwal_perwalian` FOREIGN KEY (`jadwal_perwalian_id`) REFERENCES `jadwal_perwalian` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table perwalian.perwalian: ~0 rows (approximately)
DELETE FROM `perwalian`;
/*!40000 ALTER TABLE `perwalian` DISABLE KEYS */;
INSERT INTO `perwalian` (`id`, `jadwal_perwalian_id`, `isi_perwalian`) VALUES
	(3, 6, 'dlksadklsakldjkls'),
	(4, 11, '');
/*!40000 ALTER TABLE `perwalian` ENABLE KEYS */;

-- Dumping structure for table perwalian.perwalian_mahasiswa
CREATE TABLE IF NOT EXISTS `perwalian_mahasiswa` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jadwal_perwalian_id` int(11) DEFAULT NULL,
  `index` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `jenis` varchar(255) DEFAULT NULL,
  `uraian` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_perwalian_mahasiswa_jadwal_perwalian` (`jadwal_perwalian_id`),
  KEY `index` (`index`),
  CONSTRAINT `FK_perwalian_mahasiswa_jadwal_perwalian` FOREIGN KEY (`jadwal_perwalian_id`) REFERENCES `jadwal_perwalian` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

-- Dumping data for table perwalian.perwalian_mahasiswa: ~2 rows (approximately)
DELETE FROM `perwalian_mahasiswa`;
/*!40000 ALTER TABLE `perwalian_mahasiswa` DISABLE KEYS */;
INSERT INTO `perwalian_mahasiswa` (`id`, `jadwal_perwalian_id`, `index`, `tanggal`, `jenis`, `uraian`, `status`) VALUES
	(24, 10, 1, '2020-08-20 14:05:00', 'werwerwerewr', 'rewrwerwerew', 1),
	(25, 10, 2, '2020-08-20 14:05:00', 'sa dasd asd asd asd ', 'aaadasdas dasdsad ', 1),
	(26, 11, 2, '2020-08-20 14:05:00', 'sa dasd asd asd asd ', 'aaadasdas dasdsad ', 1);
/*!40000 ALTER TABLE `perwalian_mahasiswa` ENABLE KEYS */;

-- Dumping structure for table perwalian.program_studi
CREATE TABLE IF NOT EXISTS `program_studi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_prodi` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table perwalian.program_studi: ~0 rows (approximately)
DELETE FROM `program_studi`;
/*!40000 ALTER TABLE `program_studi` DISABLE KEYS */;
INSERT INTO `program_studi` (`id`, `nama_prodi`) VALUES
	(1, 'Teknik Informatika');
/*!40000 ALTER TABLE `program_studi` ENABLE KEYS */;

-- Dumping structure for table perwalian.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table perwalian.user: ~0 rows (approximately)
DELETE FROM `user`;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table perwalian.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `role` tinyint(4) NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `photo` varchar(64) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_active` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

-- Dumping data for table perwalian.users: ~11 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `full_name`, `role`, `last_login`, `photo`, `created_at`, `is_active`) VALUES
	(1, 'admin', '$2y$10$1kOWVTY47Fp3rLNma6wTEeqYyNS0ARJBQW7onIoaUZ74ZfH5hMVv2', NULL, 'Administrator', 1, '2020-08-19 16:24:47', NULL, '2020-08-11 14:51:43', 1),
	(2, 'username', '$2y$10$28suhs6vq3n7TbQSvRNQe.ycIbCciMvKxfIHsxL8FtR5cwI/Enomy', 'a', 'nama', 1, '2020-08-12 14:13:31', NULL, '2020-08-12 14:13:31', 0),
	(6, 'ada2', '$2y$10$U9WAUjOh/ZWE5Zw1TvJWjuipQQUAGOIa2AAUO59dRnhf1AMgDh0Rq', '', 'ddsa', 2, '2020-08-12 16:26:40', NULL, '2020-08-12 16:26:40', 1),
	(7, 'ada22', '$2y$10$h9eeLDY8kpK4pdSq89pYwe9y2mnmFMqt./Jl/jZ8kcvpP1Q08EYm2', '', 'ddsa', 2, '2020-08-12 16:26:40', NULL, '2020-08-12 16:26:40', 1),
	(8, 'ada222', '$2y$10$h9eeLDY8kpK4pdSq89pYwe9y2mnmFMqt./Jl/jZ8kcvpP1Q08EYm2', '', 'ddsa', 2, '2020-08-12 16:26:40', NULL, '2020-08-12 16:26:40', 1),
	(10, 'ada2222', '$2y$10$h9eeLDY8kpK4pdSq89pYwe9y2mnmFMqt./Jl/jZ8kcvpP1Q08EYm2', '', 'ddsa', 2, '2020-08-12 16:26:40', NULL, '2020-08-12 16:26:40', 1),
	(12, 'ada22222', '$2y$10$h9eeLDY8kpK4pdSq89pYwe9y2mnmFMqt./Jl/jZ8kcvpP1Q08EYm2', '', 'ddsa', 2, '2020-08-12 16:26:40', NULL, '2020-08-12 16:26:40', 1),
	(13, 'ada222222', '$2y$10$h9eeLDY8kpK4pdSq89pYwe9y2mnmFMqt./Jl/jZ8kcvpP1Q08EYm2', '', 'ddsa', 3, '2020-08-12 16:26:40', NULL, '2020-08-12 16:26:40', 1),
	(14, 'ada2222222', '$2y$10$h9eeLDY8kpK4pdSq89pYwe9y2mnmFMqt./Jl/jZ8kcvpP1Q08EYm2', '', 'ddsa', 2, '2020-08-12 16:26:40', NULL, '2020-08-12 16:26:40', 1),
	(26, 'dosen', '$2y$10$tkvEyyuH9Tvn.JLESrd.4O9rulS1ha8Qb06eCdWn1Qfii1EsQcKwe', NULL, 'dosen wali', 2, '2020-08-19 16:19:30', NULL, '2020-08-13 15:21:29', 1),
	(27, 'amahas', '$2y$10$IeqQhVdBi/G5WUNHXhOQUe1yfm7eaHY8idcXQ/4V1Cdm5mKo1SQyW', NULL, 'asdasazzzzzzzz', 3, '2020-08-13 15:22:36', NULL, '2020-08-13 15:22:36', 1),
	(28, 'mahasiswa', '$2y$10$LGS8EV05UQvXfVlwDK/FoeavsUQJ6PXXqbj2npkY0oNPRAiCXmlqm', NULL, 'nama', 3, '2020-08-19 16:19:58', NULL, '2020-08-18 10:14:18', 1),
	(29, 'dosen2', '$2y$10$Ga9Yhnqwa9vljOQ0CLNl8OMclrQqR6Gxkb5AsFx8VhVwBUvmoBOli', NULL, 'sadasd', 2, '2020-08-19 15:58:50', NULL, '2020-08-19 15:58:50', 1),
	(31, 'dosen3', '$2y$10$CL9c8.thiUHBHdo1JY3x4O1vqn0d4CLoJ0TNNPsAq4Vuw1EHEsipK', NULL, 'sadasd', 2, '2020-08-19 15:59:07', NULL, '2020-08-19 15:59:07', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
