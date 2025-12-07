-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.4.3 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for hotel_reservation
CREATE DATABASE IF NOT EXISTS `hotel_reservation` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hotel_reservation`;

-- Dumping structure for table hotel_reservation.hotels
CREATE TABLE IF NOT EXISTS `hotels` (
  `id_hotel` int NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(100) NOT NULL,
  `hotel_address` varchar(255) NOT NULL,
  `hotel_description` text,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.hotels: ~2 rows (approximately)
INSERT INTO `hotels` (`id_hotel`, `hotel_name`, `hotel_address`, `hotel_description`) VALUES
	(21, 'QUEZA', 'BATAM', 'ASOIDASOIDHAO');

-- Dumping structure for table hotel_reservation.hotel_images
CREATE TABLE IF NOT EXISTS `hotel_images` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `id_hotel` int NOT NULL,
  `file_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `hotel_images_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.hotel_images: ~0 rows (approximately)

-- Dumping structure for table hotel_reservation.reservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id_reservation` int NOT NULL AUTO_INCREMENT,
  `id_hotel` int NOT NULL,
  `guest_name` varchar(100) NOT NULL,
  `total_price` double NOT NULL,
  `check_in_date` datetime NOT NULL,
  `check_out_date` datetime NOT NULL,
  PRIMARY KEY (`id_reservation`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id_hotel`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.reservations: ~0 rows (approximately)

-- Dumping structure for table hotel_reservation.reservation_rooms
CREATE TABLE IF NOT EXISTS `reservation_rooms` (
  `id_reservation` int NOT NULL,
  `id_room` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.reservation_rooms: ~0 rows (approximately)

-- Dumping structure for table hotel_reservation.rooms
CREATE TABLE IF NOT EXISTS `rooms` (
  `id_room` int NOT NULL AUTO_INCREMENT,
  `id_hotel` int NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `price_per_night` double NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_room`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.rooms: ~1 rows (approximately)
INSERT INTO `rooms` (`id_room`, `id_hotel`, `room_name`, `price_per_night`, `status`) VALUES
	(7, 21, 'AHSUDHSAIUDAGSDAGSDASGD', 123123, 'Available');

-- Dumping structure for table hotel_reservation.room_images
CREATE TABLE IF NOT EXISTS `room_images` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `id_room` int NOT NULL,
  `file_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `id_room` (`id_room`),
  CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.room_images: ~0 rows (approximately)

-- Dumping structure for table hotel_reservation.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.users: ~0 rows (approximately)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
	(1, 'admin', 'admin@hotel.com', '123', '2025-11-26 11:50:05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
