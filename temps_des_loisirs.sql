-- MySQL dump 10.13  Distrib 8.0.23, for Linux (x86_64)
--
-- Host: localhost    Database: temps_des_loisirs
-- ------------------------------------------------------
-- Server version	8.0.23-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activity` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `weekday` varchar(50) NOT NULL,
  `instructor_name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity`
--

LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO `activity` VALUES (1,'danse','Lundi','Didier',NULL,'Danse de salon','00:00:00','00:00:00'),(2,'bingo','Mardi','Jacques',NULL,'incontournable bingo','00:00:00','00:00:00'),(3,'dictee','Jeudi','Emma',NULL,'attention aux mauvaises notes','00:00:00','00:00:00'),(4,'Salsa','Vendredi','Emma Guesbaya','Https://picsum.photos/id/1/200/300','Let\'s danse! Ca va transpirer','19:00:00','20:00:00');
/*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `album`
--

DROP TABLE IF EXISTS `album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `album` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `album`
--

LOCK TABLES `album` WRITE;
/*!40000 ALTER TABLE `album` DISABLE KEYS */;
INSERT INTO `album` VALUES (1,'Soir??e Bingo','2020-02-17'),(2,'Voyage au Br??sil','2019-02-17'),(3,'Atelier Salsa','2021-07-01'),(4,'Parc du Poutyl','2015-09-15');
/*!40000 ALTER TABLE `album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `board`
--

DROP TABLE IF EXISTS `board`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `board` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(80) NOT NULL,
  `surname` varchar(80) NOT NULL,
  `role` varchar(80) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table `board`
--

LOCK TABLES `board` WRITE;
/*!40000 ALTER TABLE `board` DISABLE KEYS */;
INSERT INTO `board` VALUES (1,'Jeanine','Armand','Secr??taire','https://images.unsplash.com/photo-1543430720-fa600c67e423'),(3,'Yvon','Saquefouille','Pr??sident','https://images.unsplash.com/photo-1560031788-093b3a661715'),(4,'Hilaire','Tronchacake','Tr??sorier','https://images.unsplash.com/photo-1468218457742-ee484fe2fe4c '),(5,'Henry','Pasissaimple','Adjoint','https://images.unsplash.com/photo-1484611941511-3628849e90f7 ');
/*!40000 ALTER TABLE `board` ENABLE KEYS */;
LOCK TABLES `activity` WRITE;
/*!40000 ALTER TABLE `activity` DISABLE KEYS */;
INSERT INTO
  `activity`
VALUES
  (
    1,
    'danse',
    'Lundi',
    'Didier',
    NULL,
    'Danse de salon',
    '00:00:00',
    '00:00:00'
  ),(
    2,
    'bingo',
    'Mardi',
    'Jacques',
    NULL,
    'incontournable bingo',
    '00:00:00',
    '00:00:00'
  ),(
    3,
    'dictee',
    'Jeudi',
    'Emma',
    NULL,
    'attention aux mauvaises notes',
    '00:00:00',
    '00:00:00'
  ),(
    4,
    'Salsa',
    'Vendredi',
    'Emma Guesbaya',
    'Https://picsum.photos/id/1/200/300',
    'Let\'s danse! Ca va transpirer',
    '19:00:00',
    '20:00:00'
  );
  /*!40000 ALTER TABLE `activity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `event` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date DEFAULT NULL,
  `price` int NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` VALUES (1,'Voyage Saint Malo','2021-05-13','2021-05-27',150,'nous irons a st malo','https://picsum.photos/200'),(3,'Voyage Nice','2021-07-16','2020-08-17',150,'Nous irons ?? Nice.','https://picsum.photos/200'),(4,'Visit Parc de Potyl','2021-09-15',NULL,20,'Nous visiterons le parc de potyl pour prendre des photos.','https://picsum.photos/200'),(6,'Voyage ?? Mont-Saint-Michel','2021-06-09','2021-06-12',800,'Voyage ?? Mont-Saint-Michel.','https://picsum.photos/200'),(7,'Voyage au Br??sil','2021-04-22','2021-04-29',5500,'Voyage ?? Rio de Janeiro.','https://picsum.photos/200'),(12,'Bingo familial','2021-04-25','2021-04-25',15,'bingo!','https://picsum.photos/id/1/200/300'),(13,'Voyage ?? Nice','2022-07-17','2022-07-17',20,'','https://picsum.photos/200/300');
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `photo`
--

DROP TABLE IF EXISTS `photo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `photo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) NOT NULL,
  `album_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  CONSTRAINT `photo_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `photo`
--

LOCK TABLES `photo` WRITE;
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
INSERT INTO `photo` VALUES (1,'photo001','https://picsum.photos/200/300',1),(2,'photo002','https://picsum.photos/200/300',1),(3,'photo001','https://picsum.photos/200/300',2),(4,'photo002','https://picsum.photos/200/300',2),(5,'photo003','https://picsum.photos/200/300',2),(6,'photo004','https://picsum.photos/200/300',2),(7,'photo001','https://picsum.photos/200/300',3),(8,'photo002','https://picsum.photos/200/300',3),(9,'photo003','https://picsum.photos/200/300',3),(10,'photo004','https://picsum.photos/200/300',4);
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-29 10:23:41
--
-- Table structure for table `information`
--
DROP TABLE IF EXISTS `information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `information` (
  `id` int NOT NULL AUTO_INCREMENT,
  `type` varchar(80) NOT NULL,
  `content` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 4 DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Dumping data for table `information`
--
LOCK TABLES `information` WRITE;
/*!40000 ALTER TABLE `information` DISABLE KEYS */;
INSERT INTO
  `information`
VALUES
  (
    1,
    'alert',
    'En raison du Covid, le club Bingo est annul??',
    '2021-02-07'
  ),(
    2,
    'warning',
    "L'atelier danse se fera en visioconf??rence",
    '2021-02-17'
  ),(3, 'info', 'Jeanine est malade', '2021-02-18');
  /*!40000 ALTER TABLE `information` ENABLE KEYS */;
UNLOCK TABLES;
  /*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
  /*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
  /*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
  /*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
  /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
  /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
  /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
  /*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
-- Dump completed on 2021-04-14 12:34:28