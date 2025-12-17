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
DROP DATABASE IF EXISTS `hotel_reservation`;
CREATE DATABASE IF NOT EXISTS `hotel_reservation` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hotel_reservation`;

-- Dumping structure for table hotel_reservation.hotels
DROP TABLE IF EXISTS `hotels`;
CREATE TABLE IF NOT EXISTS `hotels` (
  `id_hotel` int NOT NULL AUTO_INCREMENT,
  `hotel_name` varchar(100) NOT NULL,
  `hotel_address` varchar(255) NOT NULL,
  `hotel_description` text,
  PRIMARY KEY (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.hotels: ~0 rows (approximately)
DELETE FROM `hotels`;
INSERT INTO `hotels` (`id_hotel`, `hotel_name`, `hotel_address`, `hotel_description`) VALUES
	(21, 'Nishiyama Onsen Keiunkan', 'Japan', 'With a staggering 1,300 years of history, Nishiyama Onsen Keiunkan has been certified as the oldest hotel in the world by the Guinness Book of World Records. The hotel is nestled into the serene natural landscape of Yamanashi Prefecture and offers access to a range of natural attractions in the immediate vicinity and surrounding region. For those simply looking for a relaxing getaway, the inn also has plenty to offer, with six different baths and seasonal kaiseki cuisine of the mountains.'),
	(22, 'Asakusa Temple Hotel', 'Arima Onsen, Japan', 'Blending modern convenience with subtle traditional accents, the rooms are clean, well-designed, and thoughtfully arranged to maximize space. Guests can enjoy amenities such as comfortable beds, a private bathroom, air conditioning, and complimentary Wi-Fi, making it an ideal base for exploring the city.'),
	(23, 'Palace Osaka Hotel', 'Osaka, Japan', 'Palace Osaka Hotel is an elegant urban retreat that combines modern city comfort with refined Japanese hospitality. Located in a convenient area of Osaka with easy access to cultural landmarks, shopping districts, and transportation hubs, the hotel offers a peaceful escape from the city’s energy.'),
	(24, 'Kusatsu Hotel', 'Kurokawa onsen', 'With easy access to the Yubatake hot spring field and local streets lined with shops and ryokan, the hotel is an ideal base for enjoying Kusatsu’s therapeutic waters, seasonal cuisine, and tranquil atmosphere.');

-- Dumping structure for table hotel_reservation.hotel_images
DROP TABLE IF EXISTS `hotel_images`;
CREATE TABLE IF NOT EXISTS `hotel_images` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `id_hotel` int NOT NULL,
  `file_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `hotel_images_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.hotel_images: ~4 rows (approximately)
DELETE FROM `hotel_images`;
INSERT INTO `hotel_images` (`id_image`, `id_hotel`, `file_path`) VALUES
	(17, 21, 'http://localhost/Pemograman-Web/uploads/hotelimage2.jpg'),
	(18, 22, 'http://localhost/Pemograman-Web/uploads/hotelimage1.webp'),
	(19, 23, 'http://localhost/Pemograman-Web/uploads/hotelimage3.jpg'),
	(20, 24, 'http://localhost/Pemograman-Web/uploads/hotelimage4.jpg');

-- Dumping structure for table hotel_reservation.reservations
DROP TABLE IF EXISTS `reservations`;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.reservations: ~0 rows (approximately)
DELETE FROM `reservations`;
INSERT INTO `reservations` (`id_reservation`, `id_hotel`, `guest_name`, `total_price`, `check_in_date`, `check_out_date`) VALUES
	(8, 21, 'Filbert', 1483620, '2025-12-16 00:00:00', '2025-12-17 00:00:00'),
	(9, 21, 'Queenie', 1483620, '2025-12-15 00:00:00', '2025-12-16 00:00:00'),
	(10, 21, 'Queenie', 1483620, '2025-12-15 00:00:00', '2025-12-16 00:00:00'),
	(11, 21, 'Queenie', 1483620, '2025-12-15 00:00:00', '2025-12-16 00:00:00'),
	(12, 21, '8', 1200000, '0008-08-08 00:00:00', '0008-08-08 00:00:00');

-- Dumping structure for table hotel_reservation.reservation_rooms
DROP TABLE IF EXISTS `reservation_rooms`;
CREATE TABLE IF NOT EXISTS `reservation_rooms` (
  `id_reservation` int NOT NULL,
  `id_room` int NOT NULL,
  `quantity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.reservation_rooms: ~0 rows (approximately)
DELETE FROM `reservation_rooms`;
INSERT INTO `reservation_rooms` (`id_reservation`, `id_room`, `quantity`) VALUES
	(8, 7, 12),
	(8, 8, 12),
	(9, 7, 12),
	(9, 8, 12),
	(10, 7, 12),
	(10, 8, 12),
	(11, 7, 12),
	(11, 8, 12),
	(12, 7, 100);

-- Dumping structure for table hotel_reservation.rooms
DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `id_room` int NOT NULL AUTO_INCREMENT,
  `id_hotel` int NOT NULL,
  `room_name` varchar(100) NOT NULL,
  `room_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `price_per_night` double NOT NULL,
  `status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_room`),
  KEY `id_hotel` (`id_hotel`),
  CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id_hotel`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.rooms: ~0 rows (approximately)
DELETE FROM `rooms`;
INSERT INTO `rooms` (`id_room`, `id_hotel`, `room_name`, `room_description`, `price_per_night`, `status`) VALUES
	(7, 21, 'Deluxe', 'A deluxe room at Nishiyama Onsen Keiunkan offers an elevated traditional Japanese accommodation experience that blends classic ryokan elegance with serene natural views. ', 12000, 'Available'),
	(9, 21, 'Basic', 'A basic room at Nishiyama Onsen Keiunkan provides a serene and authentic ryokan stay rooted in traditional Japanese design. The room features tatami-matted flooring, simple wooden furnishings, and sliding shoji screens.', 2000, 'Available'),
	(10, 22, 'Washitsu', 'The washitsu basic room is a traditional Japanese-style space featuring tatami-matted floors, sliding shoji doors, and simple wooden furnishings. Guests sleep on futons that are prepared in the evening, with a low table and floor seating creating a calm and uncluttered atmosphere.', 3000, 'Available'),
	(11, 22, 'Toku Washitsu', 'The toku washitsu deluxe room offers a more spacious and refined interpretation of traditional Japanese lodging. In addition to tatami flooring and elegant wooden interiors, the room includes a separate seating area and enhanced views of the surrounding landscape.', 20000, 'Available'),
	(12, 23, 'Kihon Washitsu', 'The kihon washitsu is a traditional Japanese-style room designed for simplicity and comfort. Featuring tatami-matted floors, sliding shoji screens, and minimalist wooden furnishings, the room provides a calm and uncluttered space.', 200, 'Available'),
	(13, 23, 'Miyabi Washitsu', 'The room creates a sense of sophistication and comfort. Guests may enjoy upgraded amenities and city views, making this room type perfect for those looking for a premium stay.', 300, 'Available'),
	(14, 24, 'Nagomi Washitsu', 'The nagomi washitsu is a cozy Japanese-style room designed to create a sense of calm and balance. Tatami flooring, sliding shoji doors, and simple wooden furnishings define the space, while futon bedding is laid out in the evening for restful sleep.', 200, 'Available');

-- Dumping structure for table hotel_reservation.room_images
DROP TABLE IF EXISTS `room_images`;
CREATE TABLE IF NOT EXISTS `room_images` (
  `id_image` int NOT NULL AUTO_INCREMENT,
  `id_room` int NOT NULL,
  `file_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id_image`),
  KEY `id_room` (`id_room`),
  CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`id_room`) REFERENCES `rooms` (`id_room`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table hotel_reservation.room_images: ~0 rows (approximately)
DELETE FROM `room_images`;
INSERT INTO `room_images` (`id_image`, `id_room`, `file_path`) VALUES
	(10, 7, 'http://localhost/Pemograman-Web/uploads/1765814857_hotel2.jpg'),
	(11, 9, 'http://localhost/Pemograman-Web/uploads/1765815014_hotel1.webp'),
	(13, 10, 'http://localhost/Pemograman-Web/uploads/1765815644_hotel7.jpg'),
	(15, 11, 'http://localhost/Pemograman-Web/uploads/1765815759_hotell8.jpg'),
	(16, 12, 'http://localhost/Pemograman-Web/uploads/1765815972_hotel6.jpg'),
	(17, 13, 'http://localhost/Pemograman-Web/uploads/1765816054_hotel5.avif'),
	(18, 14, 'http://localhost/Pemograman-Web/uploads/1765816512_hotel3.avif');

-- Dumping structure for table hotel_reservation.users
DROP TABLE IF EXISTS `users`;
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
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
	(1, 'admin', 'admin@hotel.com', '123', '2025-11-26 11:50:05');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
