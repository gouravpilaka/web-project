-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.18 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table vuelogin.exercise
CREATE TABLE IF NOT EXISTS `exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `description` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table vuelogin.exercise: ~0 rows (approximately)
/*!40000 ALTER TABLE `exercise` DISABLE KEYS */;
INSERT INTO `exercise` (`id`, `name`, `description`) VALUES
	(1, 'Push ups', 'lie flat and use hands'),
	(2, 'Jumping', 'Jumping'),
	(3, 'Walking', 'Walking'),
	(4, 'Swimming', 'Swimming');
/*!40000 ALTER TABLE `exercise` ENABLE KEYS */;

-- Dumping structure for table vuelogin.routine
CREATE TABLE IF NOT EXISTS `routine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `exercises` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table vuelogin.routine: ~0 rows (approximately)
/*!40000 ALTER TABLE `routine` DISABLE KEYS */;
INSERT INTO `routine` (`id`, `name`, `description`, `user_id`, `exercises`) VALUES
	(1, 'dsaf', 'sdfdsaf', NULL, NULL),
	(3, 'sd', 'ddd', NULL, NULL),
	(4, 'My Routine 1', 'Routine Test', 2, NULL),
	(5, 'Routine Monday', 'My routine for monday', 5, NULL);
/*!40000 ALTER TABLE `routine` ENABLE KEYS */;

-- Dumping structure for table vuelogin.routine_exercise
CREATE TABLE IF NOT EXISTS `routine_exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `routine` int(11) DEFAULT NULL,
  `exercise` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table vuelogin.routine_exercise: ~0 rows (approximately)
/*!40000 ALTER TABLE `routine_exercise` DISABLE KEYS */;
INSERT INTO `routine_exercise` (`id`, `routine`, `exercise`) VALUES
	(1, 2, 2),
	(2, 2, 4),
	(3, 4, 1),
	(4, 4, 3);
/*!40000 ALTER TABLE `routine_exercise` ENABLE KEYS */;

-- Dumping structure for table vuelogin.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `pass` varchar(30) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table vuelogin.user: ~2 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `pass`, `email`, `mobile`, `user_type`) VALUES
	(1, 'admin', 'admin', 'admin@g.com', '072133232', 'admin'),
	(2, 'user', 'user', 'user@m.com', '123434', 'user'),
	(5, 'user2', 'user2', 'user2@g.com', '2133223', 'user');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
