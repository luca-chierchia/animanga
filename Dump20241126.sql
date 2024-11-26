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
  `media_type` varchar(255) NOT NULL,
  `release_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `stagioni_totali` int DEFAULT '0',
  `episodi_totali` int DEFAULT '0',
  `volumi_totali` int DEFAULT '0',
  `capitoli_totali` int DEFAULT '0',
  PRIMARY KEY (`media_item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media_items`
--

LOCK TABLES `media_items` WRITE;
/*!40000 ALTER TABLE `media_items` DISABLE KEYS */;
INSERT INTO `media_items` VALUES (6,'Naruto','Naruto is manga and anime famous in the japan and world','Togashi Kishimimotomotura','book','2024-11-09','2024-11-09 14:19:39','2024-11-09 14:19:39',0,0,15,144),(7,'One Piece','One Piece Movie, ispirato al celebre manga di Eichiro <strong>Oda</strong>','???','video','2024-11-12','2024-11-12 12:58:58','2024-11-15 08:48:49',1,7,0,0),(9,'Stranger Things','Stranger Things, è una serie fantascientifica prodotta da Netflix','Qualcuno','video','2024-11-12','2024-11-12 13:01:19','2024-11-12 13:03:42',4,36,0,0),(10,'The Walking Dead','The Walking Dead, è una serie televisiva survival-horror.\nUn gruppo di sopravvissuti dovrà fuggire dal pericolo degli zombie.','ODMWM','video','2024-11-12','2024-11-12 13:03:12','2024-11-12 13:03:42',12,150,0,0),(11,'Patatine','patatine e popcorn','popcorn','video','2203-08-12','2024-11-12 14:43:32','2024-11-26 15:50:04',4,44,12,1000),(12,'Bleach','Bleach','Pei-Pai','video','2024-11-12','2024-11-12 14:43:35','2024-11-15 08:46:48',15,161,0,0),(13,'L\'Attacco dei giganti','Known in Japan as Shingeki no Kyojin, many years ago, the last remnants of humanity were forced to retreat behind the towering walls of a fortified city to escape the massive, man-eating Titans that roamed the land outside their fortress. Only the heroic members of the Scouting Legion dared to stray beyond the safety of the walls – but even those brave warriors seldom returned alive. Those within the city clung to the illusion of a peaceful existence until the day that dream was shattered, and their slim chance at survival was reduced to one horrifying choice: kill – or be devoured!','Hajime Isayama','video','2024-11-14','2024-11-14 10:30:41','2024-11-14 10:30:41',4,90,0,0),(14,'Solo Levelling','They say whatever doesn’t kill you makes you stronger, but that’s not the case for the world’s weakest hunter Sung Jinwoo. After being brutally slaughtered by monsters in a high-ranking dungeon, Jinwoo came back with the System, a program only he could see, that’s leveling him up in every way. Now, he’s inspired to discover the secrets behind his powers and the dungeon that spawned them.','Chu-Chong','book','2024-11-14','2024-11-14 10:32:51','2024-11-14 10:32:52',0,0,9,123),(15,'La caduta della casata Usher','I fratelli <em>Rodrick</em> e Madeline Usher hanno costruito un\'azienda farmaceutica trasformandola in un impero di ricchezza, privilegio e potere. Tuttavia, i segreti vengono alla luce quando gli eredi della dinastia Usher iniziano a morire.','Jean Epstein','video','2024-11-14','2024-11-14 10:34:56','2024-11-15 08:48:49',1,8,0,0),(17,'One Punch Man','Dopo tre anni di allenamento, un venticinquenne di nome Saitama ha raggiunto il suo obiettivo: essere un eroe talmente forte da poter sconfiggere chiunque con un solo pugno. Tuttavia, essere diventato così potente ha reso talmente facile il ruolo di eroe a Saitama da renderlo perennemente annoiato e portarlo alla depressione. In seguito alla conoscenza del cyborg Genos (che diventerà suo allievo), Saitama entrerà a far parte dell\'Associazione Eroi, un\'organizzazione che riunisce gli eroi della Terra con lo scopo di combattere criminali, mostri e disastri vari. Il nuovo obiettivo di Saitama diventa quello di scalare le classifiche dell\'associazione e diventare uno degli eroi più popolari.','Yusuke MUrata','book','2024-11-14','2024-11-14 10:38:11','2024-11-14 10:38:11',0,0,5,125),(21,'il cacciatore','il cacciatore dsewgfrewasdgfw.','catchiu','video','2024-11-15','2024-11-15 20:35:36','2024-11-18 13:17:37',1,1,0,0),(22,'Winni The Pooh ','Film versione Horror Movie di Winnie The Pooh','winnysss','video','2024-11-15','2024-11-15 20:36:14','2024-11-18 13:17:37',1,1,0,0),(24,'Morgan Grey','dwdojpwjdwpodjwopdjwopdjwdp','grey','video','2024-11-16','2024-11-16 12:57:25','2024-11-18 13:17:37',1,1,0,0),(25,'Doraemon','Nobita Nobi è un ragazzino giapponese di dieci anni che frequenta la quinta elementare; sebbene sia una persona gentile e altruista, è pigro, pauroso e distratto. Per questo motivo viene deriso e maltrattato da Takeshi Gōda, da tutti soprannominato Gian[3], un bullo irascibile e forzuto, e da Suneo Honekawa, un ragazzo facoltoso e viziato che sfrutta l\'amicizia di Gian per ottenere il rispetto degli altri ragazzi del luogo. L\'unico sogno di Nobita, quello di sposare l\'amica e compagna di classe Shizuka Minamoto, viene ostacolato dalla presenza di Dekisugi Hidetoshi, un giovane estremamente intelligente che esercita su di lei una forte attrazione.\r\n\r\nA causa dei suoi scarsi risultati in campo scolastico e sportivo, Nobita viene continuamente rimproverato dal maestro e dai genitori, Tamako e Nobisuke, i quali cercano invano di stimolarlo ad impegnarsi di più e ad assumersi le proprie responsabilità. Ma Nobita continuerà a collezionare fallimenti che porteranno la sua futura famiglia e i suoi discendenti in condizioni di povertà. Il suo agire lo avrebbe inoltre portato in futuro a non essere ammesso all\'università, a fondare un\'azienda di fuochi artificiali che avrebbe prodotto soltanto debiti e a non sposare la ragazza di cui si era innamorato, Shizuka, bensì la sorella di Gian, Jaiko. Sewashi Nobi, un discendente di Nobita proveniente dal XXII secolo, decide allora di tornare indietro nel tempo per aiutare il ragazzo a migliorare il suo futuro, lasciando a vegliare su di lui un gatto robot, Doraemon. Quest\'ultimo, grazie al \"gattopone\", una tasca quadri-dimensionale contenente innumerevoli gadget detti \"chiusky\", rivoluziona completamente la vita di Nobita, migliorando i rapporti che il giovane ha con i genitori e gli amici.','Fujiko F. Fujio,','book','2024-11-16','2024-11-16 12:59:46','2024-11-18 13:17:19',0,0,6,45),(26,'Slam Dunk','Hanamichi Sakuragi è un giovane teppista attaccabrighe che si iscrive al primo anno della scuola superiore Shohoku, nella prefettura di Kanagawa. È particolarmente sfortunato con le ragazze e ciò lo rende il triste bersaglio delle ripetute prese in giro da parte dei suoi amici Mito, Okusu, Takamiya e Noma. Dopo essere stato scaricato da una ragazza che era innamorata di un giocatore di basket, Hanamichi inizia ad odiare visceralmente questo sport; le cose, tuttavia, cambiano quando incontra Haruko Akagi, matricola come lui e appassionata di pallacanestro: la ragazza, infatti, lo incoraggia ad entrare nella squadra di basket della scuola impressionata dalla sua altezza e dalla sua prestanza fisica. Hanamichi se ne innamora perdutamente e accetta solo per poterla conquistare.\r\n\r\nLo Shohoku è in quel momento una squadra mediocre in quanto l\'unico elemento di spicco è il fratello maggiore di Haruko, nonché capitano della squadra, Takenori Akagi (subito ribattezzato \"Gorilla\" da Hanamichi per via del suo mastodontico aspetto fisico); l\'approdo in squadra della matricola Kaede Rukawa, proveniente dalle scuole medie Tomigaoka e considerato un fuoriclasse, sembra tuttavia aprire nuovi ed insperati scenari. Sakuragi, saputa della fortissima infatuazione che Haruko ha nei confronti del nuovo arrivato (come buona parte delle ragazze della scuola), svilupperà nei confronti di Rukawa un fortissimo e comico dualismo. Hanamichi dimostra una notevole predisposizione per questo sport sebbene gli inizi siano estremamente problematici, visto che dovrà imparare alla perfezione i fondamentali prima di poter iniziare ad esercitarsi anche nei tiri e poter giocare nelle partitelle di allenamento. Tutto ciò provoca in lui una profonda insofferenza, che lo porterà più di una volta a scontrarsi con Akagi.\r\n\r\nLa prima amichevole si disputa contro l\'ottima squadra del Ryonan, le cui punte di diamante sono l\'enorme centro Jun Uozumi e l\'ala Akira Sendo, considerato uno dei migliori giocatori del basket liceale giapponese: il risultato finale è 87-86 per il Ryonan, ma nonostante la sconfitta lo Shohoku dà dimostrazione di essere una buonissima squadra, trascinata dalle giocate di Akagi e Rukawa i quali si rivelano entrambi degli ottimi attaccanti, sebbene Uozumi e Sendo non sono da meno essendo due grandi finalizzatori. Per essere al suo esordio assoluto nel basket, compensando la sua totale inesperienza con la prestanza fisica e con una grande determinazione, Hanamichi gioca bene pur creando non poco scompiglio sia fra i suoi compagni che fra i suoi avversari facendosi notare soprattutto in fase difensiva per la sua grande abilità nel rimbalzo e segnando anche un canestro in terzo tempo, che porta in vantaggio lo Shohoku a pochi secondi dalla fine. Sakuragi è convinto di aver vinto e la sua esultanza anticipata permette al Ryonan di riportarsi in vantaggio all\'ultima azione e di vincere la partita: questo porterà Hanamichi a sentirsi in colpa dopo il match. Prima che inizino le eliminatorie entrano in squadra altri due giocatori: Ryota Miyagi, playmaker piccolo di statura ma dotato di grande velocità e di un perfetto palleggio, e l\'ottimo tiratore Hisashi Mitsui, MVP ai tempi delle medie poi datosi al teppismo, che entra in squadra dopo aver provocato una furibonda rissa in palestra (nel tentativo di far ricadere la colpa su Miyagi) e dopo essere stato convinto a tornare sulla retta via da Kogure, vicecapitano dello Shohoku, e soprattutto dall\'allenatore Anzai, per cui prova un profondo rispetto.','Takehiko Inoue','book','2024-11-16','2024-11-16 13:02:23','2024-11-18 13:17:19',0,0,31,62),(27,'Bless 5','CHE LA COMPETIZIONE ABBIA INIZIO! Agli allievi della Mirror è stato affidato un progetto: ideare un makeup convincente per promuovere un nuovo rossetto sul mercato. Aia e Nakano hanno scelto lo stesso colore… e quest’ultimo si propone per truccare Jun. Chi vincerà?','Yukino Sonoyama ','book','2024-11-25','2024-11-25 12:40:50','2024-11-25 12:40:50',1,1,1,1),(28,'Hunter x Hunter','Gon Freecss è un bambino di dodici anni che vive sull\'Isola Balena con la zia Mito, sua madre adottiva. Incontrando Kaito, un hunter professionista, Gon scopre che suo padre Ging, che lui non ha mai conosciuto, è vivo ed è uno dei migliori hunter al mondo e decide perciò di partecipare all\'esame per diventare egli stesso un hunter allo scopo di trovarlo.','Yoshihiro Togashi','book','2024-11-25','2024-11-25 12:43:38','2024-11-25 12:43:38',1,1,38,406);
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
  KEY `progress_ibfk_2` (`user_id`),
  KEY `progress_ibfk_1` (`media_item_id`),
  CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`media_item_id`) REFERENCES `media_items` (`media_item_id`) ON DELETE CASCADE,
  CONSTRAINT `progress_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `progress`
--

LOCK TABLES `progress` WRITE;
/*!40000 ALTER TABLE `progress` DISABLE KEYS */;
INSERT INTO `progress` VALUES (1,6,15,0,'2024-11-12 18:00:56',1),(2,10,0,0,'2024-11-13 10:24:34',2),(6,12,5,0,'2024-11-13 13:53:22',2),(7,6,0,4,'2024-11-14 11:20:17',2),(9,10,4,0,'2024-11-25 17:11:49',1),(10,13,4,0,'2024-11-25 19:41:20',5),(11,6,0,4,'2024-11-14 11:20:17',2),(12,9,0,0,'2024-11-14 10:47:18',4),(14,9,0,0,'2024-11-14 10:47:28',2),(15,9,2,0,'2024-11-25 17:22:45',5),(19,15,2,0,'2024-11-25 17:12:52',1),(20,15,1,0,'2024-11-14 13:10:42',2),(21,15,7,0,'2024-11-14 13:10:43',3),(22,15,2,0,'2024-11-14 13:10:47',4),(23,15,8,0,'2024-11-25 17:19:36',5),(24,13,9,0,'2024-11-25 17:12:55',1),(25,9,1,0,'2024-11-25 17:11:43',1),(26,14,0,0,'2024-11-25 14:00:03',1),(28,15,1,0,'2024-11-26 00:10:28',6),(29,26,0,0,'2024-11-25 14:03:10',6),(30,17,0,5,'2024-11-25 17:22:54',5),(31,6,0,2,'2024-11-26 15:52:49',7),(32,13,10,0,'2024-11-26 15:52:47',7),(33,7,1,0,'2024-11-26 15:52:48',7);
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Mario','mariorossi@gmail.com','potter21','2024-11-12 12:18:31','2024-11-12 12:18:33'),(2,'Ellech','lc1912@simpsxon.it','1029dmkl','2024-11-13 10:12:25','2024-11-13 10:12:25'),(3,'McDonald','iamlovinit@hotmail.com','si23\'0','2024-11-14 10:42:06','2024-11-14 10:42:06'),(4,'lelloIlPazzo','pazzarello13213@gmail.com','3290n20\'ìcmcm','2024-11-14 10:42:35','2024-11-14 10:42:36'),(5,'giuliaaa','giulia35@gmail.com','giuly3','2024-11-14 10:43:01','2024-11-14 10:43:01'),(6,'theBeast','pistola9@hotmail.it','magNuel1203','2024-11-14 10:43:44','2024-11-14 10:43:44'),(7,'Prezzemolino','prezzemolino@gmail.com','$2y$10$59pCAO9eL/XI90GpHhLEdedw2Nudv8k1UJiy8fepct/ywy3EP6r06','2024-11-26 15:51:27','2024-11-26 15:51:27');
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

-- Dump completed on 2024-11-26 16:55:49
