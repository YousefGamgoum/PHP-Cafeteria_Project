-- MySQL dump 10.13  Distrib 8.0.38, for Win64 (x86_64)
--
-- Host: localhost    Database: php project
-- ------------------------------------------------------
-- Server version	9.1.0

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (4,'Hot Drinks'),(5,'Cold Drinks'),(6,'Main Dish');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_items`
--

DROP TABLE IF EXISTS `order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `order_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `order_id` int DEFAULT NULL,
  `product_id` int DEFAULT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_items`
--

LOCK TABLES `order_items` WRITE;
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
INSERT INTO `order_items` VALUES (5,45,107,2,75.00),(6,45,108,1,50.00),(7,45,106,2,75.00),(8,45,106,1,50.00),(9,54,NULL,1,26.00),(10,54,NULL,1,30.00),(11,55,NULL,3,15.00),(12,56,NULL,6,50.00),(13,57,NULL,4,15.00),(14,58,NULL,1,30.00),(15,58,NULL,2,50.00),(16,58,NULL,1,30.00),(17,58,NULL,1,15.00),(18,59,106,3,26.00),(19,59,117,1,70.00),(20,60,107,2,15.00),(21,60,108,2,30.00),(22,61,107,1,15.00),(23,61,108,2,30.00),(24,62,108,1,30.00),(25,63,107,5,15.00),(26,63,108,6,30.00),(27,63,106,8,26.00),(28,63,119,1,50.00),(29,63,118,1,30.00),(30,64,107,2,15.00),(31,64,108,2,30.00),(32,65,106,2,26.00),(33,65,107,1,15.00),(34,66,107,1,15.00),(35,66,108,1,30.00),(36,67,106,4,26.00),(37,67,107,3,15.00),(38,67,108,2,30.00),(39,68,106,1,26.00),(40,68,107,1,15.00),(41,68,108,1,30.00),(42,69,106,1,26.00),(43,69,107,2,15.00),(44,70,106,1,26.00),(45,70,107,1,15.00),(46,70,108,1,30.00),(47,71,107,1,15.00),(48,71,108,2,30.00),(49,72,106,1,26.00),(50,72,107,2,15.00),(51,73,107,2,15.00),(52,73,108,2,30.00),(53,74,107,3,15.00),(54,74,108,2,30.00),(55,75,106,2,26.00),(56,75,108,2,30.00),(57,75,107,6,15.00),(58,76,106,2,26.00),(59,76,107,2,15.00),(60,77,106,2,26.00),(61,77,107,3,15.00),(62,78,107,4,15.00),(63,79,106,3,26.00),(64,80,106,1,26.00),(65,80,107,2,15.00),(66,80,108,3,30.00),(67,81,107,2,15.00),(68,81,108,1,30.00),(69,82,108,5,30.00),(70,82,117,4,70.00);
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `order_id` int NOT NULL AUTO_INCREMENT,
  `Amount` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) DEFAULT 'pending',
  `user_id` int DEFAULT NULL,
  `room_id` int DEFAULT NULL,
  PRIMARY KEY (`order_id`),
  KEY `fk_user_id` (`user_id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (46,2,200.00,400.00,'2025-03-08 11:52:03','confirmed',25,102),(47,3,75.50,226.50,'2025-03-08 11:52:03','shipped',25,103),(60,92,22.50,2070.00,'2025-03-10 05:27:46','shipped',25,102),(61,3,25.00,75.00,'2025-03-10 05:28:17','shipped',25,101),(62,1,30.00,30.00,'2025-03-10 06:11:20','confirmed',25,104),(67,9,23.22,209.00,'2025-03-10 06:32:42','pending',24,101),(68,3,23.67,71.00,'2025-03-10 06:34:35','pending',24,102),(79,3,26.00,78.00,'2025-03-10 06:55:28','pending',24,101),(80,6,24.33,146.00,'2025-03-10 07:10:25','confirmed',6,103),(81,3,20.00,60.00,'2025-03-10 11:34:03','confirmed',6,103);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `category_id` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `category_id` (`category_id`),
  CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  CONSTRAINT `products_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (107,'tea',15.00,'67ce2c36b9ec1_tea.jpg',4),(108,'dsds',30.00,'67ce2c3cd0bff_espresso.jpg',4),(117,'Mango',70.00,'67ce2e1bce048_mango.jpg',5),(118,'Pepsi',30.00,'67ce2e28ab093_pepsi.jpg',5),(119,'Orange',50.00,'67ce2e335b9a9_orange.jpg',5),(120,'coffee',20.00,'67cece90db9c9_coffee.jpg',4),(121,'asd',60.00,'67ceceb35e551_contact.jpg',6);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rooms` (
  `id` int NOT NULL AUTO_INCREMENT,
  `room_number` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `capacity` int NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `room_number` (`room_number`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (1,'101',2),(2,'102',4),(3,'103',1),(4,'104',3);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `profile_picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `roomno` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (6,'ABDELRHMAN1123','abdelArhmza11nali981@gmail.com','$2y$10$t97o390Mo45W5zkEQeyAUO3znn93q49kr013/7P9Mcy1UE6xG7KbC','67c7181fc9c31_7ea167c86498c6587b8f99967019f4b7.jpg','user','2025-03-04 15:11:27','A2'),(8,'abdo11','abdelqrhmzanali981@gmail.com','$2y$10$KvEO6cHDOFA5XjPLj5nC1OwGX.tYYnzGWyIAbhtXPhaf8mot8Vu56','67ca0ba12c9af_7ea167c86498c6587b8f99967019f4b7.jpg','user','2025-03-06 20:54:57','A11'),(9,'abdo','abdelrhamzanali981@gmail.com','$2y$10$OaS8HkyAOyQ.SSWT41KlW.yVfqQyE65d4RkQUK/tye74gig2H5jKK','OIP (4).jpg','admin','2025-03-06 21:08:08','A122a'),(12,'ssxsdaa','abdelrhmzsasanali981@gmail.com','$2y$10$D6wsHvcakmPqLbDJ62dpe.bfZpgVxrqdbQqa0vde9J0aItHNjfvea','4k-fc-zamalek-logo-egyptian-premier-league-epl-besthqwallpapers.com-2048x1536.jpg','admin','2025-03-06 21:39:53','Aaaa'),(24,'YousefGamgoum22','yousef@gmail.com','$2y$10$CFB/G2JP867GZQW1i/hyr.UYRayQqYm6yWebO4AQrPitaC8aVmUHu','1634408549182.jpg','admin','2025-03-09 22:58:05','A100'),(25,'YousefSalah','yousefsalah@gmail.com','$2y$10$CLAWj3MuIotbrxstJM1qh.mx7qyVJZqveLxMknpymGUVP2oc.zmgK',NULL,'user','2025-03-10 00:56:42','A200');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-11 19:38:54
