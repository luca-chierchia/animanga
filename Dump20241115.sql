-- MySQL dump 10.13  Distrib 8.0.40, for Win64 (x86_64)
--
-- Host: localhost    Database: animanga
-- ------------------------------------------------------
-- Server version	8.0.40

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
-- Table structure for table `media_items`
--

DROP TABLE IF EXISTS `media_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media_items` (
  `media_item_id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `author` varchar(255) DEFAULT NULL,
  `media_type` enum('video','book','audio') NOT NULL,
  `release_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stagioni_totali` int DEFAULT '0',
  `episodi_totali` int DEFAULT '0',
  `volumi_totali` int DEFAULT '0',
  `capitoli_totali` int DEFAULT '0',
  PRIMARY KEY (`media_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_items`
--

LOCK TABLES `media_items` WRITE;
/*!40000 ALTER TABLE `media_items` DISABLE KEYS */;
INSERT INTO `media_items` VALUES (6,'Naruto','Naruto is manga and anime famous in the japan and world','Togashi Kishimimotomotura','book','2024-11-09','2024-11-09 14:19:39','2024-11-09 14:19:39',0,0,15,144),(7,'One Piece','One Piece Movie, ispirato al celebre manga di Eichiro <strong>Oda</strong>','???','video','2024-11-12','2024-11-12 12:58:58','2024-11-15 08:48:49',1,7,0,0),(9,'Stranger Things','Stranger Things, è una serie fantascientifica prodotta da Netflix','Qualcuno','video','2024-11-12','2024-11-12 13:01:19','2024-11-12 13:03:42',4,36,0,0),(10,'The Walking Dead','The Walking Dead, è una serie televisiva survival-horror.\nUn gruppo di sopravvissuti dovrà fuggire dal pericolo degli zombie.','ODMWM','video','2024-11-12','2024-11-12 13:03:12','2024-11-12 13:03:42',12,150,0,0),(11,'Bleach','Bleach','Hojime Katajuro','video','2024-11-12','2024-11-12 14:43:32','2024-11-15 08:46:48',0,0,0,0),(12,'Bleach','Bleach','Pei-Pai','video','2024-11-12','2024-11-12 14:43:35','2024-11-15 08:46:48',15,161,0,0),(13,'L\'Attacco dei giganti','Known in Japan as Shingeki no Kyojin, many years ago, the last remnants of humanity were forced to retreat behind the towering walls of a fortified city to escape the massive, man-eating Titans that roamed the land outside their fortress. Only the heroic members of the Scouting Legion dared to stray beyond the safety of the walls – but even those brave warriors seldom returned alive. Those within the city clung to the illusion of a peaceful existence until the day that dream was shattered, and their slim chance at survival was reduced to one horrifying choice: kill – or be devoured!','Hajime Isayama','video','2024-11-14','2024-11-14 10:30:41','2024-11-14 10:30:41',4,90,0,0),(14,'Solo Levelling','They say whatever doesn’t kill you makes you stronger, but that’s not the case for the world’s weakest hunter Sung Jinwoo. After being brutally slaughtered by monsters in a high-ranking dungeon, Jinwoo came back with the System, a program only he could see, that’s leveling him up in every way. Now, he’s inspired to discover the secrets behind his powers and the dungeon that spawned them.','Chu-Chong','book','2024-11-14','2024-11-14 10:32:51','2024-11-14 10:32:52',0,0,9,123),(15,'La caduta della casata Usher','I fratelli <em>Rodrick</em> e Madeline Usher hanno costruito un\'azienda farmaceutica trasformandola in un impero di ricchezza, privilegio e potere. Tuttavia, i segreti vengono alla luce quando gli eredi della dinastia Usher iniziano a morire.','Jean Epstein','video','2024-11-14','2024-11-14 10:34:56','2024-11-15 08:48:49',1,8,0,0),(16,'Berserk','Berserk (ベルセルク, Beruseruku) è un manga scritto e disegnato da Kentarō Miura. Le vicende si incentrano su Gatsu, un antieroico guerriero solitario costretto a vagare senza sosta per sopravvivere e trovare vendetta.','Kentaro Miura','book','2024-11-14','2024-11-14 10:36:32','2024-11-14 10:36:33',0,0,42,373),(17,'One Punch Man','Dopo tre anni di allenamento, un venticinquenne di nome Saitama ha raggiunto il suo obiettivo: essere un eroe talmente forte da poter sconfiggere chiunque con un solo pugno. Tuttavia, essere diventato così potente ha reso talmente facile il ruolo di eroe a Saitama da renderlo perennemente annoiato e portarlo alla depressione. In seguito alla conoscenza del cyborg Genos (che diventerà suo allievo), Saitama entrerà a far parte dell\'Associazione Eroi, un\'organizzazione che riunisce gli eroi della Terra con lo scopo di combattere criminali, mostri e disastri vari. Il nuovo obiettivo di Saitama diventa quello di scalare le classifiche dell\'associazione e diventare uno degli eroi più popolari.','Yusuke MUrata','book','2024-11-14','2024-11-14 10:38:11','2024-11-14 10:38:11',0,0,5,125);
/*!40000 ALTER TABLE `media_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `progress`
--

DROP TABLE IF EXISTS `progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `progress` (
  `progress_id` int NOT NULL AUTO_INCREMENT,
  `media_item_id` int DEFAULT NULL,
  `episodes_watched` int DEFAULT '0',
  `chapters_read` int DEFAULT '0',
  `last_updated` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  PRIMARY KEY (`progress_id`),
  KEY `media_item_id` (`media_item_id`),
  KEY `progress_ibfk_2` (`user_id`),
  CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`media_item_id`) REFERENCES `media_items` (`media_item_id`),
  CONSTRAINT `progress_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress`
--

LOCK TABLES `progress` WRITE;
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
INSERT INTO `progress` VALUES (1,6,15,0,'2024-11-12 18:00:56',1),(2,10,0,0,'2024-11-13 10:24:34',2),(6,12,5,0,'2024-11-13 13:53:22',2),(7,6,0,4,'2024-11-14 11:20:17',2),(8,10,0,0,'2024-11-14 10:45:19',6),(9,10,1,0,'2024-11-14 10:45:33',1),(10,13,0,0,'2024-11-14 10:46:00',5),(11,6,0,4,'2024-11-14 11:20:17',2),(12,9,0,0,'2024-11-14 10:47:18',4),(13,10,0,0,'2024-11-14 10:47:56',5),(14,9,0,0,'2024-11-14 10:47:28',2),(15,9,0,0,'2024-11-14 10:47:58',5),(16,16,0,0,'2024-11-14 10:49:28',1),(17,16,0,0,'2024-11-14 10:49:33',3),(18,16,0,0,'2024-11-14 10:49:34',6),(19,15,0,0,'2024-11-14 13:10:40',1),(20,15,1,0,'2024-11-14 13:10:42',2),(21,15,7,0,'2024-11-14 13:10:43',3),(22,15,2,0,'2024-11-14 13:10:47',4),(23,15,0,0,'2024-11-14 13:10:46',5);
/*!40000 ALTER TABLE `progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mario','mariorossi@gmail.com','potter21','2024-11-12 12:18:31','2024-11-12 12:18:33'),(2,'Ellech','lc1912@simpsxon.it','1029dmkl','2024-11-13 10:12:25','2024-11-13 10:12:25'),(3,'McDonald','iamlovinit@hotmail.com','si23\'0','2024-11-14 10:42:06','2024-11-14 10:42:06'),(4,'lelloIlPazzo','pazzarello13213@gmail.com','3290n20\'ìcmcm','2024-11-14 10:42:35','2024-11-14 10:42:36'),(5,'giuliaaa','giulia35@gmail.com','giuly3','2024-11-14 10:43:01','2024-11-14 10:43:01'),(6,'theBeast','pistola9@hotmail.it','magNuel1203','2024-11-14 10:43:44','2024-11-14 10:43:44');
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

-- Dump completed on 2024-11-15 10:01:17
