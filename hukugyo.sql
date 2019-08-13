-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: hukugyo
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,'default','App\\Permission model has been created',1,'App\\Permission',NULL,NULL,'[]','2019-02-19 06:45:31','2019-02-19 06:45:31'),(2,'default','App\\Role model has been created',1,'App\\Role',NULL,NULL,'[]','2019-02-19 06:46:02','2019-02-19 06:46:02');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `job_id` int(10) unsigned NOT NULL,
  `body` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `comments_user_id_foreign` (`user_id`),
  KEY `comments_job_id_foreign` (`job_id`),
  CONSTRAINT `comments_job_id_foreign` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE,
  CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,1,11,'aaaaaaaaaaa',4,'2019-02-20 19:04:16','2019-02-20 19:04:16'),(3,1,13,'トラさんこの間はありがとうございました。',1,'2019-02-21 04:45:46','2019-02-21 04:45:46'),(4,1,15,'トラさんこの間はありがとうございました。',1,'2019-02-21 04:50:10','2019-02-21 04:50:10'),(8,1,40,'助かった。またお願いします。',5,'2019-02-21 11:57:38','2019-02-21 11:57:38'),(10,1,55,'ありがとうございました。',3,'2019-02-25 06:23:19','2019-02-25 06:23:19'),(11,1,28,'tora!!!!!',5,'2019-03-02 15:56:45','2019-03-02 15:56:45'),(12,1,55,'test',3,'2019-03-14 08:28:43','2019-03-14 08:28:43'),(13,11,55,'頑張った',3,'2019-05-01 15:31:54','2019-05-01 15:31:54');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_user_id_foreign` (`user_id`),
  CONSTRAINT `jobs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
INSERT INTO `jobs` VALUES (11,1,'ギター教えます','バレーコードなど初心者がつまづきやすい所を重点的にフォローします。課題曲をジブリに設定しますので、楽しいですよ。\r\n※金額は時給です',10000,'user_0000001/original.png','2019-02-20 18:23:20','2019-02-20 18:23:20'),(13,1,'運転代行します。','急な飲み会の後も安心。',2000,'user_0000001/car_keijidousya.png','2019-02-20 23:15:09','2019-02-20 23:15:09'),(15,1,'JavaScriptでタイピングゲームを作ろう','レジュメあり',5000,'user_0000001/20160410154524.jpg','2019-02-21 00:28:55','2019-02-21 00:28:55'),(16,1,'プログラミング教えます','やります',3000,'','1970-05-02 17:02:00','1987-12-04 05:00:04'),(17,1,'プログラミング教えます','やります',3000,'','1995-03-14 20:46:19','2018-08-25 05:02:35'),(18,2,'Neque officia id consequatur.','Commodi quo quidem qui amet aperiam sunt. Possimus a ex at. Reprehenderit rerum tenetur et odio ex et consectetur voluptatum.',3922,'noimage.jpg','2000-12-04 13:32:54','2014-12-23 21:15:02'),(19,3,'Vero qui a qui est.','Porro non ut vel. Ad voluptatibus consequatur qui quam. Delectus eligendi maxime quia quis sapiente.',4369,'noimage.jpg','1981-02-17 01:20:58','2008-11-15 00:11:16'),(20,4,'Quia rerum nemo aut.','Et dolores non repellendus assumenda quidem. Magnam qui consequatur aut ea recusandae fugit rerum. Id et ad ut sapiente nesciunt sit.',4434,'noimage.jpg','1987-06-12 09:57:00','2001-01-21 10:22:50'),(21,5,'Rem qui harum dicta soluta.','Accusantium itaque voluptates maiores voluptas sed ea. Nostrum praesentium praesentium non explicabo omnis. Quia cupiditate illo quibusdam. Ipsa deleniti pariatur rerum est minima.',2684,'noimage.jpg','1982-10-11 19:40:27','1986-05-07 21:54:02'),(22,6,'In sit eos quia numquam.','Qui ea culpa id nostrum. Vel molestiae voluptas dolores quod ad modi. Voluptates nulla sapiente ut dolor aut est perferendis.',9768,'noimage.jpg','2014-04-04 01:45:08','1994-07-26 06:45:26'),(23,7,'Numquam corporis et rerum.','Vitae atque laboriosam occaecati quasi et ad corrupti. Dolorum dicta cupiditate dolorum voluptate quidem quae distinctio. Et aut nobis consequatur.',9462,'noimage.jpg','1981-03-10 18:26:12','2018-07-08 11:16:46'),(24,8,'Rem in illo quisquam saepe.','Et velit est dolor est voluptates. Eaque ullam nam quas dolorem aliquam provident.',1543,'noimage.jpg','1988-12-09 12:11:18','1982-04-21 09:54:04'),(25,9,'Facere illo soluta rerum.','Dolore dignissimos quo sunt quia a sapiente. Porro consequatur impedit consequatur ullam aut animi eos. Quidem saepe quia eveniet non corrupti.',8812,'noimage.jpg','1977-05-31 08:19:21','1995-06-05 02:17:26'),(27,2,'Est enim mollitia vitae.','Quas ad ut distinctio repudiandae nihil sunt vel magnam. Quod dolore magnam fugit quo animi. Error mollitia eaque dolores. Autem et ut incidunt sequi deserunt.',9342,'noimage.jpg','1971-03-03 01:50:23','1998-10-09 11:22:08'),(28,3,'Quos consequatur totam quis.','Sit ab aut reiciendis voluptates est quia. Ut error et aut architecto. Ut ipsum veritatis iste omnis debitis neque velit. Totam temporibus blanditiis dignissimos labore velit.',2070,'noimage.jpg','2018-06-17 21:27:42','1978-12-28 22:26:20'),(29,4,'Esse nemo nemo fugit.','Accusantium vel ullam error aut dolores architecto. Harum omnis laudantium hic architecto. Dolores et facere ducimus sunt aperiam. Rerum minima omnis non sed illum.',9092,'noimage.jpg','2010-07-06 23:23:32','1982-08-15 10:54:46'),(30,5,'Sed cumque quasi dolorem.','Omnis voluptatum sunt molestias voluptas fugiat aut. Id molestiae provident nesciunt doloribus eum sint dolorem sed. Maiores qui eum omnis id. Expedita voluptatem eaque odit dolorem soluta.',7742,'noimage.jpg','1976-12-09 16:34:50','1982-12-20 19:01:33'),(31,6,'Et debitis est iure.','Sed consequatur blanditiis est adipisci facere qui quasi. Modi dignissimos consequatur aut et placeat quidem. Sunt dolores quod officia explicabo exercitationem in quisquam.',3223,'noimage.jpg','2001-12-31 01:53:19','2012-11-03 23:00:22'),(32,7,'Sed velit dolorum ex veniam.','Id nihil ex suscipit modi. Iste rem odit est exercitationem libero. Atque et dolores est ea asperiores est. Ipsam ut doloremque consequuntur fugit consequuntur ut dicta dolor.',1345,'noimage.jpg','1970-12-02 01:17:15','1995-10-03 04:00:55'),(33,8,'Quo corporis nam minus ipsum.','Impedit a quaerat qui facilis et. Tenetur modi non consequatur veniam et quidem. Praesentium eos minus rem molestias sunt. Voluptates delectus quam et sunt.',5929,'noimage.jpg','1987-04-30 05:54:02','2007-02-02 22:23:09'),(34,9,'In nemo voluptas qui.','Repellat molestiae vel animi quasi. Voluptatem dolores aspernatur eum voluptas impedit non. Et nihil maxime dolores aut facere ad ut sit.',3843,'noimage.jpg','2018-04-19 05:22:53','1991-08-25 04:21:06'),(36,2,'Quam ut eius nihil dolorem.','Voluptates voluptatem modi cumque quidem. Maiores ab eos at nisi ut. Maiores ipsa iure eveniet sit nesciunt quia dolores. Et suscipit quod dolorem nobis odio.',6633,'noimage.jpg','1988-10-10 09:08:47','1982-04-04 02:57:04'),(37,3,'Sit vel omnis mollitia.','Nemo doloremque neque repudiandae dolores. Reprehenderit porro ex et officia sequi. Iusto aut est dolores voluptatem. Qui officia error incidunt fuga molestiae.',7180,'noimage.jpg','1979-04-23 23:50:39','2000-10-03 08:50:04'),(38,4,'Id aliquid et maiores magnam.','Necessitatibus ex qui quis reprehenderit fugiat. Maiores tempore laborum quae. Voluptatum molestias sint placeat.',1068,'noimage.jpg','1998-10-15 20:14:44','1973-08-04 20:03:52'),(39,5,'Odit dolores qui non aliquid.','Asperiores rem sunt alias. Et quaerat consequuntur quasi. Mollitia delectus corporis nobis commodi et et.',4772,'noimage.jpg','1984-11-13 09:19:06','2014-09-25 08:11:13'),(40,6,'Sint ut deleniti recusandae.','Ex occaecati suscipit commodi nisi inventore. Qui sunt voluptatem nemo a sit nostrum. Et quia praesentium sunt optio. In et culpa vero vel dolor aliquid laborum.',5774,'noimage.jpg','2003-12-26 04:34:23','2000-08-14 22:09:20'),(41,7,'Quis sed laborum ut totam.','Officia earum odio eum. Quo nulla earum voluptatem ad sapiente suscipit. Sunt eaque ab veritatis asperiores architecto atque et voluptas.',4146,'noimage.jpg','1988-02-05 21:32:31','1983-07-03 10:03:11'),(42,8,'Et rem illum non nihil.','Natus autem provident dolorum ut exercitationem in. Nihil itaque cupiditate ex omnis reprehenderit quisquam.',7990,'noimage.jpg','2001-07-05 00:02:02','1973-10-06 03:13:44'),(43,9,'Non fugit aut sunt.','Cumque qui dolore deleniti voluptas necessitatibus consequatur dolores. Et rem voluptatibus maxime ratione sit. Illo molestias odio fugit placeat.',7605,'noimage.jpg','2000-04-20 20:54:22','1971-10-10 04:31:20'),(44,2,'Ad accusamus quis eos.','Repudiandae inventore optio quae animi odit cumque libero. At necessitatibus fuga numquam nobis odit et et. Illum sunt laudantium quod id cupiditate omnis.',6857,'noimage.jpg','1970-04-24 06:40:32','1999-10-18 23:03:13'),(45,3,'Vitae vero fugit at est.','Atque vero voluptatem eligendi tempore qui. Aut soluta iure inventore expedita sint aspernatur. Nulla id aliquam delectus saepe. Et officia est quia laboriosam.',8785,'noimage.jpg','2001-03-06 01:19:07','1982-08-09 20:36:25'),(46,4,'Unde quis quia et.','Aut doloribus deserunt consequuntur voluptatibus nemo numquam id. In quia sed quasi vero possimus. Excepturi atque rem laboriosam est nulla doloribus sequi.',5052,'noimage.jpg','2005-07-21 19:49:09','1997-06-08 01:00:38'),(47,5,'Quod ut cum placeat in.','Fuga dolorem reiciendis quia nihil id voluptatum minus. Error sit recusandae a fuga nam. Quas quis quisquam sed odit. Omnis veritatis consequatur debitis quo voluptatem.',9228,'noimage.jpg','2016-02-12 04:35:09','2009-02-17 13:05:26'),(48,6,'Quo rerum esse et enim magni.','Eos dignissimos cum quasi a aut. Et consequatur placeat nihil. Voluptatem voluptatem voluptatem ut eum non odio incidunt.',3278,'noimage.jpg','1991-03-05 18:01:09','2000-04-04 16:55:53'),(49,7,'Veniam et quidem similique.','Sint quaerat pariatur et modi cum libero. Dolores et quis quis. Perspiciatis error cupiditate tempore.',4005,'noimage.jpg','2008-05-15 00:37:59','2014-07-22 10:50:09'),(50,8,'Et sed odio veniam et.','Nulla sint sint adipisci ut et a dolores. Totam itaque vitae a libero. Quis cum cupiditate omnis. Velit sunt aut ad reprehenderit.',7471,'noimage.jpg','1993-05-26 06:22:58','2002-12-27 21:13:28'),(51,9,'Velit ut consequatur quam.','Amet optio molestiae mollitia. Quia commodi qui sed et quo delectus et nemo. Dolorem quia hic et omnis est sit maxime. Mollitia quas ullam aut voluptates.',6308,'noimage.jpg','2002-03-24 02:14:35','2018-12-23 09:58:35'),(52,2,'Hic libero repellendus eum.','Quaerat accusantium qui voluptate voluptate est saepe rerum quibusdam. Corrupti vel magni et eius voluptas. Atque aut maxime laboriosam similique repellat est.',6719,'noimage.jpg','2008-03-11 12:38:06','2016-10-10 16:12:49'),(53,3,'Earum corporis enim qui.','Corporis vero laboriosam a modi exercitationem dolore. Est non temporibus aperiam quas temporibus libero ut. Id fugit ut sed quis sit ut.',9157,'noimage.jpg','1982-02-27 13:55:03','1985-04-21 17:24:36'),(55,3,'なんでもやります。','仕事ください。',2000,'noimage.jpg','2019-02-24 05:06:56','2019-02-24 05:06:56');
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (7,'2014_10_12_000000_create_users_table',1),(8,'2014_10_12_100000_create_password_resets_table',1),(9,'2016_01_01_193651_create_roles_permissions_tables',1),(10,'2018_08_01_183154_create_pages_table',1),(11,'2018_08_04_122319_create_settings_table',1),(12,'2019_02_19_153729_create_activity_log_table',1),(13,'2019_02_20_163355_create_jobs_table',2),(14,'2019_02_21_032617_create_comments_table',3),(15,'2019_02_22_221203_create_stories_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb4_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
INSERT INTO `permission_role` VALUES (1,1);
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (1,'admin','admin','2019-02-19 06:45:31','2019-02-19 06:45:31');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `role_user_user_id_foreign` (`user_id`),
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin','admin','2019-02-19 06:46:02','2019-02-19 06:46:02');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `settings_key_unique` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `body` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stories_user_id_foreign` (`user_id`),
  CONSTRAINT `stories_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stories`
--

LOCK TABLES `stories` WRITE;
/*!40000 ALTER TABLE `stories` DISABLE KEYS */;
/*!40000 ALTER TABLE `stories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'tora','rcr126126@gmail.com',NULL,'$2y$10$X3RXn8RfNDcvBMceNkXKF.83/4ZIAkN/9iGIHua/lAgk23IbZ5Gpq',NULL,NULL,'kOoYP7TD8u8ZOTNMtvqhxLTJkQIlD326Kn751pTp5rF0ZjvROxeJN38P3oEa','2019-02-19 06:44:08','2019-02-19 06:46:32'),(2,'トラ',NULL,NULL,NULL,'twitter','729196112767131649','11PxoglNX29vKL4cGovFds3y0BkSqr3jdPFl8KcUsMgqmjvalJapFDyeTsNa','2019-02-19 06:44:32','2019-02-19 06:44:32'),(3,'ラ ト','rcr126126@gmail.com',NULL,NULL,'facebook','119230082531396','hT9CUao2GJx9yoBfDYlT5X0wcsALTFxkcGkqrzWXQNeNv75U217goZte1Mkq','2019-02-19 06:53:09','2019-02-19 06:53:09'),(4,'ああああ','example@example.com',NULL,'$2y$10$MY0cgMqYdP7JU0q/5xLIA.NgeGBGuAdOQTUPLCHX8KbHSbn64GItG',NULL,NULL,'N9Jq8PguSpbpq7hGPG4hLeTP586qPr2NBzQaXzxmIAxiBEJ91FMFKoPplXn3','2019-02-19 15:45:00','2019-02-19 15:45:00'),(5,'pontaso','pontaso@example.com',NULL,'$2y$10$S01nd6CrA4lXtuQXr373yOoBmdaBf4fTdKCNBbXPPUcz9dGdmeLcS',NULL,NULL,'rySB1jSs8fYhgw9uKLtrJ7tFyQdBA2CxvmDn7bdYlxI0ELBGpHyvS0nvTq0d','2019-02-19 16:50:17','2019-02-19 16:50:17'),(6,'akashi','akashi@example.com',NULL,'$2y$10$8.0.hbbdl8Pa7ALMHmQiZOnN0YnJT5YpFjcI7wyrBFjmE325PXVti',NULL,NULL,'7IjD3AqSU9QUwjyD3XNP7BQFIagd0C2tmvCGHoMGoPj3eHndrxioeHFREUOi','2019-02-19 17:35:11','2019-02-19 17:35:11'),(7,'takeuchi','takeuchi@gmail.com',NULL,'$2y$10$p8q0HRbJIFIhbuGH4Pnuv.oOwNutp3Dwg0D/bRfeMBC7wQ5YcPhlO',NULL,NULL,'UPWtO82ESqyyEoIygk40YyIb3lkPFBKwESDcx9zzMvLDNkp4whW51g9NrYnj','2019-02-19 17:52:58','2019-02-19 17:52:58'),(8,'matsui','matsui@example.com',NULL,'$2y$10$lNQhx0cfTKoF8DMzXiXYme6FnMfu5fM5Uw83R7Ajr4Bl987XO7PDa',NULL,NULL,'dq8S6SaNFeJd7B9pLsiMl8BtfppD9EgDnB8XF0IAhz91XtlP45KcCzkI62Hy','2019-02-19 18:34:53','2019-02-19 18:34:53'),(9,'taka','taka@gmail.com',NULL,'$2y$10$1jTIwqZtXPwQfxTAGBsWrOHJNJCZvp2ja6q.Su376ykKKpP2tQd1O',NULL,NULL,'i5K8yNAPstCN3XrgxFeOUIE2skCRW6p6lblKKQVlpkEFsq1YSTWUmCPmvCAT','2019-02-20 03:22:06','2019-02-20 03:22:06'),(10,'ichiro','ichiro@example.com',NULL,'$2y$10$JaIDOErWNyjJcIjT1ypeRe5IlhD7iSSsUrHk0QgUzj1XZlkF8goDO',NULL,NULL,'LtwQdkJ87GBTKpJluwtoYqHCPOVOQRuPTO4KsNwik8JQFfo9HTIeUYTRt8P3','2019-02-21 05:56:19','2019-02-21 05:56:19'),(11,'moku@新米Webエンジニア',NULL,NULL,NULL,'twitter','1123595084920807424','LScwPa8kDzVZuv7JVtKQQRYDKGxHzl2XZyrf3jA1NyPJc1ooTs8lpSJjvpyL','2019-05-01 15:30:39','2019-05-01 15:30:39'),(12,'しーちゃん。','torakichisite@gmail.com',NULL,'$2y$10$dDhPRl90.e61BZfw5BXWGOOWtO4q8XiKTxT5JXL7VQgvxjA1.0Iym',NULL,NULL,'EER0wQzCHshKzivsRA2kw3zzhkh8Phi5HCZ5Q1TavZ7OVYz8gxu5B4vVtl1W','2019-06-21 12:17:21','2019-06-21 12:17:21'),(13,'あかさたな','rcr126126@mineo.jp',NULL,'$2y$10$jW19RtWXyWIfWenPPKcx0ON1GPgFx/RDBMODnXzYWfYlEa09fSmLe',NULL,NULL,NULL,'2019-07-01 12:57:59','2019-07-01 12:57:59');
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

-- Dump completed on 2019-07-25 23:18:38
