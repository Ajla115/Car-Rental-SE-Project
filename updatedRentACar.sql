CREATE DATABASE  IF NOT EXISTS `rentacar` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rentacar`;
-- MySQL dump 10.13  Distrib 8.0.29, for Win64 (x86_64)
--
-- Host: localhost    Database: rentacar
-- ------------------------------------------------------
-- Server version	8.0.29

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
-- Table structure for table `bookings`
--

DROP TABLE IF EXISTS `bookings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bookings` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_id` int DEFAULT NULL,
  `vehicle_id` int DEFAULT NULL,
  `date_of_booking` date DEFAULT NULL,
  `paid` tinyint NOT NULL,
  `date_of_payment` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bookings_customer_id_idx` (`customer_id`),
  KEY `bookings_vehicle_id_idx` (`vehicle_id`),
  CONSTRAINT `bookings_customer_id` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  CONSTRAINT `bookings_vehicle_id` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bookings`
--

LOCK TABLES `bookings` WRITE;
/*!40000 ALTER TABLE `bookings` DISABLE KEYS */;
INSERT INTO `bookings` VALUES (1,1,1,'2020-05-07',1,'2020-05-07'),(2,2,7,'2020-06-18',1,'2020-06-18'),(3,3,11,'2020-07-20',1,'2020-07-21'),(4,2,3,'2020-08-01',1,'2020-08-01'),(5,4,4,'2020-09-15',1,'2020-09-16'),(6,5,8,'2023-03-23',0,NULL),(7,6,9,'2023-04-26',0,NULL),(8,7,5,'2023-04-26',0,NULL),(9,1,7,'2020-01-01',1,'2020-01-02'),(10,5,2,'2020-04-28',1,'2020-04-28'),(11,8,13,'2023-04-23',0,NULL),(12,9,10,'2021-07-17',1,'2021-07-17'),(13,10,16,'2020-01-18',1,'2020-01-19'),(14,5,4,'2022-05-23',1,'2022-05-24');
/*!40000 ALTER TABLE `bookings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carinfo`
--

DROP TABLE IF EXISTS `carinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carinfo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `car_name` varchar(51) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `age` int DEFAULT NULL,
  `mileage` varchar(50) DEFAULT NULL,
  `fuel` varchar(50) DEFAULT NULL,
  `fuel_usage` varchar(50) DEFAULT NULL,
  `gearbox` varchar(50) DEFAULT NULL,
  `max_passengers` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carinfo`
--

LOCK TABLES `carinfo` WRITE;
/*!40000 ALTER TABLE `carinfo` DISABLE KEYS */;
INSERT INTO `carinfo` VALUES (1,'VW GOLF 7 FACELIFT','80 BAM per day',2021,'34.000 km','Diesel','6.5 l/km','Automatic',5),(2,'SKODA OCTAVIA','75 BAM per day',2017,'75.000 km','Diesel','6 l/km','Automatic',5);
/*!40000 ALTER TABLE `carinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(45) DEFAULT NULL,
  `customer_surname` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` VALUES (1,'Tarik','Karahodzic','tarik.karahodzic@live.com','Bosanska 13'),(2,'Benjamin','Dlakic','benjamin.dlakic@live.com','Ilidzanska 2'),(3,'Mustafa','Ajanovic','mustafa.ajanovic@live.com','Kiseljak 9'),(4,'Amir','Basovic','amir.basovic@live.com','Visoko 6'),(5,'Mujo','Mujic','mujo.mujic@live.com','Trg Nezavisnosti 13'),(6,'Rijad','Cvorak','rijad.cvorak@live.com','Bosanska 13'),(7,'Aner','Salcin','aner.salcin@live.com','Stupska 34'),(8,'Haris','Kadic','haris.kadic@live.com','Bajrama Zenunija 6'),(9,'Naim','Pjanic','naim.pjanic@live.com','Hasana Mujezinovica'),(10,'Nur','Fulin','nur.fulin@live.com','Trg Nezavisnosti 2'),(11,'Lamija','Zuko','lamija.zuko@live.com','Stupska 64'),(12,'Melisa','Geca','melisa.geca@live.com','Meha Drljevica 4'),(13,'Asja','Maric','asja.maric@live.com','Hamdije Kresevljakovica 14'),(14,'asdasd','asdasd','ajla.korman@stu.ibu.edu.ba','R.4NLQ5V7'),(15,'Ajla','Korman','ajla.korman@stu.ibu.edu.ba','1234'),(16,'Mustafa','Ajanovic','mustafa.ajanovic@stu.ibu.edu.ba','81dc9bdb52d04dc20036dbd8313ed055'),(17,'Ajla','Korman','ajla.korman@stu.ibu.edu.ba','827ccb0eea8a706c4c34a16891f84e7b'),(18,'Suada','Korman','suada.korman@stu.ibu.edu.ba','8cf52cf24260bc49455e30d6cc7acee1'),(19,'Suada','Korman','suada.korman@stu.ibu.edu.ba','8cf52cf24260bc49455e30d6cc7acee1'),(20,'Tarik','Korman','tarik.korman@gmail.com','fb5472d0ee866623186cf0b83ac8f8f1'),(21,'Lamija','Colic','lamija.colic@gmail.com','00dc2efa66ca952ad177f437a00c5bdc'),(22,'Selma','Grabovica','selma.grabovica@gmail.com','2bfa99427eef278ff198a11cdaaf2b35'),(23,'Suad','Grabovica','suad.grabovica@gmail.com','8253c06bad235d7a7418a24ececd9b96'),(24,'Emrah','Grabovica','emrah.grabovica@gmail.com','4468d7aab92f910f7b3ce92d57a86bc2'),(48,'demo65','demo65','demo65@gmail.com','5d78e2fbabdeef078fa614f133738bc5'),(49,'Azra','Maric','azra.maric@gmail.com','9fd250719005a092b414627772c18700'),(50,'deo678','deo678','deo678@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(51,'demo36','demo36','demo36@gmail.com','d534579c65afccfb460d3d2fc7594303'),(52,'demo37','demo37','demo37@gmail.com','ae8554037601dbcc6a74991d6eb3e151'),(53,'demo38','demo38','demo38@gmail.com','3e156eb55122d98eee23b5a345d788dd'),(54,'demo1','demo1','demo1@gmail.com','e10adc3949ba59abbe56e057f20f883e'),(55,'demo2','demo2','demo2@gmail.com','1066726e7160bd9c987c9968e0cc275a'),(56,'demo3','demo3','demo3@gmail.com','297e430d45e7bf6f65f5dc929d6b072b'),(57,'demo71','demo71','demo71@gmail.com','ac8e5b2d61b1064f2678a9b7a9af4521'),(58,'demo72','demo72','demo72@gmail.com','b518451660b34e65c753b5aedb5c5800'),(59,'demo36','demo36','demo36@gmail.com','d534579c65afccfb460d3d2fc7594303'),(60,'Huso','husic','huso@mail.com','d5fe63abe1bf5b2c847ec3f6bb7a284f'),(61,'demo40','demo40','demo40@gmail.com','4497f0f358e037095dc36f10af9be898'),(62,'demo99','demo99','demo99@gmail.com','06a926a8a48a5feff8b1bd581f390917'),(63,'demo100','demo100','demo100@gmail.com','78c247a5c2bb2370289e43031086fb5a'),(64,'Elvedin','Sakic','elvedin.sakic@gmail.com','49c4ea46fa0852701fe1f40e02aa8824'),(65,'Zikrija','Maslenjak','ziki.maslo@gmail.com','213f0e64755fad83929e59e027dce9f6'),(66,'User1','User1','user1@gmail.com','24c9e15e52afc47c225b757e7bee1f9d'),(67,'Ajla','Korman','korman.ajla115@gmail.com','59e86d9b7519708c8001edc5c015700f');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reviews`
--

DROP TABLE IF EXISTS `reviews`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `reviews` (
  `id` int NOT NULL AUTO_INCREMENT,
  `booking_id` int DEFAULT NULL,
  `review_score` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reviews_booking_id_idx` (`booking_id`),
  CONSTRAINT `reviews_booking_id` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reviews`
--

LOCK TABLES `reviews` WRITE;
/*!40000 ALTER TABLE `reviews` DISABLE KEYS */;
INSERT INTO `reviews` VALUES (1,1,10),(2,2,8),(3,3,9),(4,4,6),(5,5,2),(6,6,5),(7,7,8),(8,6,7);
/*!40000 ALTER TABLE `reviews` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `testemonials`
--

DROP TABLE IF EXISTS `testemonials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `testemonials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `comment` varchar(10000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `testemonials`
--

LOCK TABLES `testemonials` WRITE;
/*!40000 ALTER TABLE `testemonials` DISABLE KEYS */;
INSERT INTO `testemonials` VALUES (1,'Jurica','Koletic','The customer service was exceptional! The staff went above and beyond to accommodate my needs and ensure a smooth rental experience.'),(2,'Damir','Begic','I had a last-minute change of plans and needed a rental car ASAP. This company was able to accommodate my request and provide excellent service and help despite the short notice. Thank you!'),(3,'Sanja','Omeragic','Great rental experience. The staff was friendly and helpful, and the car was in excellent condition. Highly recommend this company.'),(4,'Kerim','Kolic','I rented a car for a weekend getaway and was impressed with the affordable rates and variety of vehicle options. Will definitely use this rental company again.'),(5,'Yiu-han','Hodzic','As a new foreign resident, I had an excellent rental experience. The process was quick, the car was clean and well-maintained.');
/*!40000 ALTER TABLE `testemonials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicles`
--

DROP TABLE IF EXISTS `vehicles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `vehicles` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model` varchar(45) DEFAULT NULL,
  `year` int DEFAULT NULL,
  `color` varchar(45) DEFAULT NULL,
  `mileage` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicles`
--

LOCK TABLES `vehicles` WRITE;
/*!40000 ALTER TABLE `vehicles` DISABLE KEYS */;
INSERT INTO `vehicles` VALUES (1,'SUV',2006,'Red','183943'),(2,'Sedan',2014,'Blue','120458'),(3,'Hatchback',2016,'Grey','156048'),(4,'Sedan',2007,'Blue','175063'),(5,'SUV',2020,'Grey','100265'),(7,'SUV',2016,'White','145689'),(8,'SUV',2016,'Black','154628'),(9,'Hatchback',2020,'White','125489'),(10,'Sedan',2020,'White','135498'),(11,'Sedan',2015,'Grey','154895'),(12,'SUV',2020,'Red','115790'),(13,'Sedan',2021,'Maroon','86542'),(14,'SUV',2020,'Black','100548'),(15,'SUV',2016,'White','168795'),(16,'Minivan',2016,'Red','187456'),(17,'SUV',2016,'Red','183943');
/*!40000 ALTER TABLE `vehicles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visits`
--

DROP TABLE IF EXISTS `visits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visits` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categories` varchar(45) DEFAULT NULL,
  `men` varchar(45) DEFAULT NULL,
  `women` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visits`
--

LOCK TABLES `visits` WRITE;
/*!40000 ALTER TABLE `visits` DISABLE KEYS */;
INSERT INTO `visits` VALUES (1,'2017/18','120','78'),(2,'2018/19','250','370'),(3,'2019/20','500','400'),(4,'2020/21','657','830'),(5,'2021/22','1202','910');
/*!40000 ALTER TABLE `visits` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-06 13:47:22
