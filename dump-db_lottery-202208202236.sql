-- MySQL dump 10.13  Distrib 5.5.62, for Win64 (AMD64)
--
-- Host: localhost    Database: db_lottery
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.21-MariaDB

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
-- Table structure for table `lol_answer_issue`
--

DROP TABLE IF EXISTS `lol_answer_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_answer_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `issueId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lol_issueAnswerIssue` (`issueId`),
  KEY `lol_createdByAnswerIssue` (`createdBy`),
  CONSTRAINT `lol_createdByAnswerIssue` FOREIGN KEY (`createdBy`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lol_issueAnswerIssue` FOREIGN KEY (`issueId`) REFERENCES `lol_issue` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_answer_issue`
--

LOCK TABLES `lol_answer_issue` WRITE;
/*!40000 ALTER TABLE `lol_answer_issue` DISABLE KEYS */;
INSERT INTO `lol_answer_issue` VALUES (1,'<p>Ok</p>\r\n',1,1,'2018-06-10 21:31:32','2018-06-10 21:31:32'),(2,'<p>5555</p>\r\n',1,7,'2018-06-10 23:55:49','2018-06-10 23:55:49');
/*!40000 ALTER TABLE `lol_answer_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_auth_assignment`
--

DROP TABLE IF EXISTS `lol_auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `lol_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `lol_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_auth_assignment`
--

LOCK TABLES `lol_auth_assignment` WRITE;
/*!40000 ALTER TABLE `lol_auth_assignment` DISABLE KEYS */;
INSERT INTO `lol_auth_assignment` VALUES ('2','9',1528651250),('3','1',1528697854),('4','4',1528631467),('4','5',1528631467),('4','8',1528650990),('5','10',1528868967),('5','2',1528631449),('5','3',1528631449),('5','7',1528634159),('admin','1',1528616136);
/*!40000 ALTER TABLE `lol_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_auth_item`
--

DROP TABLE IF EXISTS `lol_auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `lol_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `lol_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_auth_item`
--

LOCK TABLES `lol_auth_item` WRITE;
/*!40000 ALTER TABLE `lol_auth_item` DISABLE KEYS */;
INSERT INTO `lol_auth_item` VALUES ('1',1,NULL,NULL,NULL,1528616136,1528616136),('2',1,NULL,NULL,NULL,1528616136,1528616136),('3',1,NULL,NULL,NULL,1528616136,1528616136),('4',1,NULL,NULL,NULL,1528616136,1528616136),('5',1,NULL,NULL,NULL,1528616136,1528616136),('admin',1,NULL,NULL,NULL,1528616136,1528616136),('manageBanckend',2,'Manage Banckend',NULL,NULL,1528616136,1528616136),('manageFrontend',2,'Manage Frontend',NULL,NULL,1528616136,1528616136),('manageInformation',2,'Manage Information',NULL,NULL,1528616136,1528616136),('manageMenu',2,'Manage Menu',NULL,NULL,1528616136,1528616136),('manageSetting',2,'Manage Settinge',NULL,NULL,1528616136,1528616136);
/*!40000 ALTER TABLE `lol_auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_auth_item_child`
--

DROP TABLE IF EXISTS `lol_auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `lol_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `lol_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `lol_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `lol_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_auth_item_child`
--

LOCK TABLES `lol_auth_item_child` WRITE;
/*!40000 ALTER TABLE `lol_auth_item_child` DISABLE KEYS */;
INSERT INTO `lol_auth_item_child` VALUES ('1','manageBanckend'),('1','manageFrontend'),('1','manageInformation'),('1','manageMenu'),('2','manageBanckend'),('2','manageInformation'),('3','manageBanckend'),('3','manageFrontend'),('3','manageInformation'),('3','manageMenu'),('3','manageSetting'),('4','manageFrontend'),('admin','manageBanckend'),('admin','manageFrontend'),('admin','manageInformation'),('admin','manageMenu'),('admin','manageSetting');
/*!40000 ALTER TABLE `lol_auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_auth_rule`
--

DROP TABLE IF EXISTS `lol_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_auth_rule`
--

LOCK TABLES `lol_auth_rule` WRITE;
/*!40000 ALTER TABLE `lol_auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `lol_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_bank`
--

DROP TABLE IF EXISTS `lol_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_bank`
--

LOCK TABLES `lol_bank` WRITE;
/*!40000 ALTER TABLE `lol_bank` DISABLE KEYS */;
INSERT INTO `lol_bank` VALUES (1,'ธนาคารออมสิน','2018-05-04 23:12:50','2018-05-04 23:12:50','030',1),(2,'ธนาคารกสิกรไทย','2018-05-04 23:32:12','2018-05-04 23:32:12','004',1),(3,'ธนาคารไทยพาณิชย์','2018-05-04 23:32:12','2018-05-04 23:32:12','014',1),(4,'ธนาคารกรุงไทย','2018-05-04 23:32:12','2018-05-04 23:32:12','006',1),(5,'ธนาคารกรุงศรี','2018-05-04 23:32:12','2018-05-04 23:32:12','025',1),(6,'ธนาคารกรุงเทพ','2018-05-04 23:32:12','2018-05-04 23:32:12','002',1);
/*!40000 ALTER TABLE `lol_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_bank_owner`
--

DROP TABLE IF EXISTS `lol_bank_owner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_bank_owner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `accountName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) DEFAULT 1,
  `code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_bank_owner`
--

LOCK TABLES `lol_bank_owner` WRITE;
/*!40000 ALTER TABLE `lol_bank_owner` DISABLE KEYS */;
INSERT INTO `lol_bank_owner` VALUES (1,'ธนาคารกรุงไทย','23456789','2017-12-21 20:51:37','2017-12-21 20:51:37','นาย A',1,'002'),(2,'ธนาคารกรุงเทพ','2455588999','2018-01-18 22:27:23','2018-01-18 22:27:23','นาย B',0,'002'),(3,'ธนาคารกรุงไทย','24990908855','2018-01-18 22:27:23','2018-01-18 22:27:23','นาย A',1,'006'),(4,'ธนาคารกรุงไทย','24494882200','2018-01-18 22:32:54','2018-01-18 22:32:54','นาย B',1,'006'),(5,'ธนาคารกสิกรไทย','244485888999','2018-01-18 22:33:29','2018-01-18 22:33:29','นาย A',1,'004'),(6,'ธนาคารไทยพาณิชย์','234353888899','2018-01-18 22:33:29','2018-01-18 22:33:29','นาย B',1,'014'),(7,'ธนาคารไทยพาณิชย์','234348899988','2018-01-18 22:51:55','2018-01-18 22:51:55','นาย A',1,'014'),(8,'ธนาคารกรุงศรี','5656455522','2018-01-18 22:51:55','2018-01-18 22:51:55','นาย A',0,'025'),(9,'ธนาคารกรุงเทพ','2323285999','2018-01-22 23:36:33','2018-01-22 23:36:33','นาย A',1,'002'),(10,'ธนาคารกรุงเทพ','8899555220009','2018-01-24 22:25:40','2018-01-24 22:25:40','นาย B',0,'002'),(11,'True money','089111188899','2018-02-04 22:26:52','2018-02-04 22:26:52','True money Wallet',1,'001');
/*!40000 ALTER TABLE `lol_bank_owner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_bill_football`
--

DROP TABLE IF EXISTS `lol_bill_football`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_bill_football` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `buyId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lol_bill_football_buy_id` (`buyId`),
  KEY `lol_bill_football_created_by` (`createdBy`),
  CONSTRAINT `lol_bill_football_buy_id` FOREIGN KEY (`buyId`) REFERENCES `lol_buy_football` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lol_bill_football_created_by` FOREIGN KEY (`createdBy`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_bill_football`
--

LOCK TABLES `lol_bill_football` WRITE;
/*!40000 ALTER TABLE `lol_bill_football` DISABLE KEYS */;
INSERT INTO `lol_bill_football` VALUES (1,'BLF20180610-001',1,'2018-06-10 21:25:22',7);
/*!40000 ALTER TABLE `lol_bill_football` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_bill_lottery`
--

DROP TABLE IF EXISTS `lol_bill_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_bill_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `idBuyLottery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `userId` int(11) DEFAULT NULL,
  `total` float DEFAULT NULL,
  `totalPaid` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userBillId` (`userId`),
  CONSTRAINT `userBillId` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_bill_lottery`
--

LOCK TABLES `lol_bill_lottery` WRITE;
/*!40000 ALTER TABLE `lol_bill_lottery` DISABLE KEYS */;
INSERT INTO `lol_bill_lottery` VALUES (2,'BLT2018-06-02/001','3,4,5','2018-06-10 23:44:48',7,300,186),(3,'BLT20180602-002','6,7,8,9','2018-06-11 22:39:07',7,200,142),(4,'BLT20180602-003','10','2018-06-11 22:41:03',7,10,6),(5,'BLLT20180917-00004','11,12,13','2018-09-29 15:44:34',10,300,290),(9,'BLLT20220817-00005','18','2022-08-20 22:15:12',10,10001,10001);
/*!40000 ALTER TABLE `lol_bill_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_buy_football`
--

DROP TABLE IF EXISTS `lol_buy_football`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_buy_football` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matchId` int(11) NOT NULL,
  `teamWinByMatchId` int(11) NOT NULL,
  `moneyPlay` varchar(255) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `isTrue` int(11) DEFAULT 0,
  `createdAt` datetime DEFAULT current_timestamp(),
  `rate` float DEFAULT NULL,
  `type` int(11) DEFAULT 1 COMMENT '1 = hdp, 2 = over, 3 = HxA',
  `isFullTime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lol_buy_football_match_id` (`matchId`),
  KEY `lol_buy_football_created_by` (`createdBy`),
  CONSTRAINT `lol_buy_football_created_by` FOREIGN KEY (`createdBy`) REFERENCES `lol_user` (`id`),
  CONSTRAINT `lol_buy_football_match_id` FOREIGN KEY (`matchId`) REFERENCES `lol_matchfootball` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_buy_football`
--

LOCK TABLES `lol_buy_football` WRITE;
/*!40000 ALTER TABLE `lol_buy_football` DISABLE KEYS */;
INSERT INTO `lol_buy_football` VALUES (1,1,1,'200',7,0,'2018-06-10 21:25:22',1,1,NULL);
/*!40000 ALTER TABLE `lol_buy_football` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_buy_lottery`
--

DROP TABLE IF EXISTS `lol_buy_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_buy_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moneyPlay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moneyPay` float NOT NULL,
  `paymentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `isTrue` int(11) DEFAULT 0,
  `typeLotteryId` int(11) NOT NULL,
  `lotteryId` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `paymentId` (`paymentId`),
  KEY `userId` (`userId`),
  KEY `buyLottery_typeLotteryId` (`typeLotteryId`),
  KEY `buyLottery_lotteryId` (`lotteryId`),
  CONSTRAINT `buyLottery_lotteryId` FOREIGN KEY (`lotteryId`) REFERENCES `lol_lottery_period` (`id`) ON DELETE CASCADE,
  CONSTRAINT `buyLottery_typeLotteryId` FOREIGN KEY (`typeLotteryId`) REFERENCES `lol_type_lottery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `paymentId` FOREIGN KEY (`paymentId`) REFERENCES `lol_payment_lottery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_buy_lottery`
--

LOCK TABLES `lol_buy_lottery` WRITE;
/*!40000 ALTER TABLE `lol_buy_lottery` DISABLE KEYS */;
INSERT INTO `lol_buy_lottery` VALUES (3,'831','100',62,297,7,'2018-06-10 23:44:48','2018-06-10 23:44:48',2,1,13),(4,'831','100',62,299,7,'2018-06-10 23:44:48','2018-06-10 23:44:48',0,3,13),(5,'831','100',62,299,7,'2018-06-10 23:44:48','2018-06-10 23:44:48',0,3,13),(6,'323','50',31,297,7,'2018-06-11 22:39:07','2018-06-11 22:39:07',2,1,13),(7,'323','50',31,299,7,'2018-06-11 22:39:07','2018-06-11 22:39:07',0,3,13),(8,'83','50',40,301,7,'2018-06-11 22:39:07','2018-06-11 22:39:07',2,5,13),(9,'83','50',40,302,7,'2018-06-11 22:39:07','2018-06-11 22:39:07',0,6,13),(10,'831','10',6,305,7,'2018-06-11 22:41:03','2018-06-11 22:41:03',2,1,13),(11,'323','100',95,433,10,'2018-09-29 15:44:34','2018-09-29 15:44:34',2,1,20),(12,'565','100',95,435,10,'2018-09-29 15:44:34','2018-09-29 15:44:34',0,3,20),(13,'65','100',100,437,10,'2018-09-29 15:44:34','2018-09-29 15:44:34',2,5,20),(18,'01','10001',10001,651,10,'2022-08-20 22:15:12','2022-08-20 22:15:12',0,6,51);
/*!40000 ALTER TABLE `lol_buy_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_chanel_bank`
--

DROP TABLE IF EXISTS `lol_chanel_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_chanel_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_chanel_bank`
--

LOCK TABLES `lol_chanel_bank` WRITE;
/*!40000 ALTER TABLE `lol_chanel_bank` DISABLE KEYS */;
INSERT INTO `lol_chanel_bank` VALUES (0,'Not specified','2018-06-10 13:44:08'),(1,'อินเทอร์เน็ต แบงค์กึ้ง','2018-06-10 13:44:06'),(2,'ผ่านเคาวน์เตอร์ธนาคาร','2018-06-10 13:44:06'),(3,'เอทีเอ็ม','2018-06-10 13:44:06'),(4,'ผ่านมือถือแบงค์','2018-06-10 13:44:06'),(5,'ตู้ฝากเงินสด','2018-06-10 13:44:06');
/*!40000 ALTER TABLE `lol_chanel_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_comment_feed_news`
--

DROP TABLE IF EXISTS `lol_comment_feed_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_comment_feed_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `feedNewsId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lol_comment_feed_news_feedNewsId` (`feedNewsId`),
  CONSTRAINT `lol_comment_feed_news_feedNewsId` FOREIGN KEY (`feedNewsId`) REFERENCES `lol_feed_news` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_comment_feed_news`
--

LOCK TABLES `lol_comment_feed_news` WRITE;
/*!40000 ALTER TABLE `lol_comment_feed_news` DISABLE KEYS */;
INSERT INTO `lol_comment_feed_news` VALUES (1,'ok',1,'2018-10-16 19:03:38',1);
/*!40000 ALTER TABLE `lol_comment_feed_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_condition_lottery`
--

DROP TABLE IF EXISTS `lol_condition_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_condition_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `condition` int(11) DEFAULT NULL,
  `limit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `lotteryId` int(11) DEFAULT NULL,
  `typeLotteryId` int(11) NOT NULL,
  `isPurchaseLimit` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `lotteryConditionId` (`lotteryId`),
  KEY `lol_typeLotteryId` (`typeLotteryId`),
  CONSTRAINT `lol_typeLotteryId` FOREIGN KEY (`typeLotteryId`) REFERENCES `lol_type_lottery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lotteryConditionId` FOREIGN KEY (`lotteryId`) REFERENCES `lol_lottery_period` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_condition_lottery`
--

LOCK TABLES `lol_condition_lottery` WRITE;
/*!40000 ALTER TABLE `lol_condition_lottery` DISABLE KEYS */;
INSERT INTO `lol_condition_lottery` VALUES (1,'Test หวยอั่น 01 ขายไม่เกิน 10000 บ.','01',1,'10000','2022-08-20 20:15:26','2022-08-20 20:15:26',51,6,1);
/*!40000 ALTER TABLE `lol_condition_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_feed_news`
--

DROP TABLE IF EXISTS `lol_feed_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_feed_news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `createdBy` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_feed_news`
--

LOCK TABLES `lol_feed_news` WRITE;
/*!40000 ALTER TABLE `lol_feed_news` DISABLE KEYS */;
INSERT INTO `lol_feed_news` VALUES (1,'555','2018-10-16 19:03:17',1);
/*!40000 ALTER TABLE `lol_feed_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_group`
--

DROP TABLE IF EXISTS `lol_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `showFrontend` int(11) DEFAULT 0,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_group`
--

LOCK TABLES `lol_group` WRITE;
/*!40000 ALTER TABLE `lol_group` DISABLE KEYS */;
INSERT INTO `lol_group` VALUES (1,'เจ้ามือ',1,0,'2018-01-13 15:30:25','2018-01-13 15:30:25'),(2,'Admin Website',1,0,'2018-01-13 15:30:31','2018-01-13 15:30:31'),(3,'Administrator',1,0,'2018-01-17 22:11:27','2018-01-17 22:11:27'),(4,'ตัวแทนขาย',1,1,'2018-01-28 19:35:17','2018-01-28 19:35:17'),(5,'ผู้ใช้ทั่วไป',1,1,'2018-01-28 19:35:27','2018-01-28 19:35:27');
/*!40000 ALTER TABLE `lol_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_information`
--

DROP TABLE IF EXISTS `lol_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_information` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menuId` int(11) NOT NULL,
  `detail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `menuId` (`menuId`),
  CONSTRAINT `menuId` FOREIGN KEY (`menuId`) REFERENCES `lol_menu` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_information`
--

LOCK TABLES `lol_information` WRITE;
/*!40000 ALTER TABLE `lol_information` DISABLE KEYS */;
INSERT INTO `lol_information` VALUES (1,1,'<p>ติดต่อเรา Line ID :</p>\r\n','2017-12-11 14:52:43','2017-12-11 14:52:43'),(2,2,'<p>ข่าวสาร</p>\r\n','2017-12-11 14:59:09','2017-12-11 14:59:09'),(3,3,'<p>คู่มือการสมัครสมาชิก</p>\r\n','2017-12-11 14:59:31','2017-12-11 14:59:31'),(4,5,'<p style=\"text-align:center\">โปรโมชั่นแบบ User ธรรมดา</p>\r\n\r\n<p style=\"text-align:center\">สมัครครั้งแรกมี ID. Refer<br />\r\nST000x ของคนที่เป็นสมาชิกอยู่แล้ว ทั้งคนสมัครกับคนที่ให้ ID. Refer ST000xจะได้<br />\r\nCredit free 50) และจะมีส่วนสดพิเศษ ตามยอดที่ซื้อ&nbsp;หรือเป็น Credit</p>\r\n\r\n<table align=\"center\" cellspacing=\"0\" style=\"border-collapse:collapse; border-color:initial; border-style:none\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"3\" style=\"background-color:yellow; height:21pt; text-align:center; vertical-align:bottom; white-space:nowrap; width:170pt\"><span style=\"font-size:14pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">โปรมือสมัครเล่น</span></span></strong></span></td>\r\n			<td style=\"height:21pt; text-align:center; vertical-align:bottom; white-space:nowrap; width:16pt\">&nbsp;</td>\r\n			<td colspan=\"3\" style=\"background-color:red; height:21pt; text-align:center; vertical-align:bottom; white-space:nowrap; width:166pt\"><span style=\"font-size:14pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">โปรเซียน</span></span></strong></span></td>\r\n			<td style=\"height:21pt; text-align:center; vertical-align:bottom; white-space:nowrap; width:17pt\">&nbsp;</td>\r\n			<td colspan=\"3\" style=\"background-color:#00b050; height:21pt; text-align:center; vertical-align:bottom; white-space:nowrap; width:174pt\"><span style=\"font-size:14pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">โปรปราบเซียน</span></span></strong></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">ประเภท</span></span></strong></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">อัตราการจ่าย</span></span></strong></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">ส่วนลด %</span></span></strong></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">ประเภท</span></span></strong></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">อัตราการจ่าย</span></span></strong></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">ส่วนลด %</span></span></strong></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">ประเภท</span></span></strong></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">อัตราการจ่าย</span></span></strong></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:bottom; white-space:nowrap\"><span style=\"font-size:12pt\"><strong><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">ส่วนลด %</span></span></strong></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวบน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">900</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">5</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวบน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">550</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">38</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวบน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">500</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">40</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวบนโต๊ด</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">150</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">5</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวบนโต๊ด</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">100</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">38</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวบนโต๊ด</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">90</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">40</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">200</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">5</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">120</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">38</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">110</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">40</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวล่างโต๊ด</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">150</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">5</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวล่างโต๊ด</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">100</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">38</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3ตัวล่างโต๊ด</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">90</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">40</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">2บน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">90</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">0</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">2บน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">70</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">20</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">2บน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">65</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">20</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">2ล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">90</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">0</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">2ล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">70</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">20</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">2ล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">65</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">20</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">วิ่ง-บน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">10</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">วิ่ง-บน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">4</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">10</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">วิ่ง-บน</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">3</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">10</span></span></span></td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">วิ่ง-ล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">4</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">10</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">วิ่ง-ล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">4</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">10</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\">&nbsp;</td>\r\n			<td style=\"height:18.6pt; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">วิ่ง-ล่าง</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">4</span></span></span></td>\r\n			<td style=\"height:18.6pt; text-align:center; vertical-align:top; white-space:nowrap\"><span style=\"font-size:12pt\"><span style=\"font-family:&quot;TH Sarabun New&quot;,sans-serif\"><span style=\"color:black\">10</span></span></span></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n','2017-12-11 15:00:04','2017-12-11 15:00:04'),(5,6,'<p>โปรโมชั่นตัวแทนขาย</p>\r\n\r\n<p>ตัวแทนขาย (มีส่วนสดพิเศษ ตามยอดที่ขายก้อคือซื้อ เงือนไขการเป็นตัวแทน<br />\r\nขายต้องจ่ายสมัคร<br />\r\n&nbsp;</p>\r\n','2017-12-11 15:00:39','2017-12-11 15:00:39'),(6,7,'<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h1 style=\"text-align:center\">เปิดให้บริการ 8.00น. - 24.00น.</h1>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h5 style=\"text-align:center\"><span style=\"color:#2ecc71\"><span style=\"font-size:14px\">(ปัญหาฝากเงิน โอนผิด ลืมเศษสตางค์ เริ่มแก้ยอดให้ตอน 10.00น.)</span></span></h5>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#2980b9\"><strong>ฝากเงินได้24ชั่วโมง ไม่มีขั้นต่ำ / ถอนเงินขั้นต่ำ500บาทฟรีค่าธรรมเนียม / แนะนำเพื่อนAFF 5% / รางวัลปิงปอง 300 บาท/รอบ</strong>&nbsp;&nbsp;</span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#e74c3c\"><span style=\"background-color:#ffff99\">เว็บจะปรับยอดเงินให้กับลูกค้าที่ใช้บัญชีถอนโอนเติมเข้ามาเท่านั้น หากเราพบความผิดปกติ ยกเลิกปรับให้ทุกกรณีและระงับuserถาวร&nbsp;</span></span></p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><span style=\"color:#ecf0f1\"><strong><span style=\"background-color:#ff0000\">ห้ามฝากเพื่อนหรือบุคคลอื่นโอน ต้องใช้บัญชีถอนเงินกับทางเว็บโอนเท่านั้น ตรวจพบแบนทุกกรณี</span></strong></span>&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h3 style=\"text-align:center\">ยินดีต้อนรับ LOTTOLUCKY</h3>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; เว็บ<strong>แทงหวยออนไลน์</strong> รูปแบบใหม่ ทำงานด้วยระบบอัตโนมัติ&nbsp; การฝากเงิน การถอนเงิน รวดเร็ว ปลอดภัย การเงินมั่นคง&nbsp;เหมาะสำหรับลูกค้าที่ต้องการความสะดวกสบาย โปรงใส่100% มีให้เลือกแทงหวยแทบทุกชนิด หวยรัฐบาล หวยล็อตเตอรี่ หวยหุ้น หวยต่างประเทศ หวยมาเล และ หวยปิงปอง(จับยีกี) 24&nbsp;ชั่วโมง ทุก15นาที การประมวลผลด้วยทีมงานมืออาขีพ&nbsp;ท่านจึงมั่นใจได้ว่าท่านจะได้รับการบริการและการแก้ไขปัญหาต่างๆในระดับที่ดีที่สุดไม่ว่าท่านจะแทง1บาท 5บาท 10บาท ท่านจะได้รับความสะดวกสบายแน่นอน สำหรับมือใหม่ เรามีคู่มือให้อ่านตั้งแต่เริ่มต้น พร้อมอธิบายทุกรายละเอียด&nbsp; มีทีมงานค่อยบริการตลอดการใช้งาน สามารถติดต่อทีมงานได้ที่เมนูของเว็บ&nbsp;&nbsp;หมดปัญหาการถูกหลอกลวงอีกต่อไป เราเท่านั้นที่กล้าให้ เฮียบิ๊ก@ปอยเปต</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h3 style=\"text-align:center\"><span style=\"background-color:#9b59b6\">สำหรับลูกค้าใหม่ การฝากเงิน</span></h3>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; ระบบเราเป็นระบบฝากเงินอัตโนมัติ&nbsp;ลูกค้าที่โอนเงินเข้ามาอย่าเซฟเลขบัญชีเป็นรายการโปรด ให้กรอกเพื่อโอนเองทุกครั้ง ระบบอาจมีการเปลี่ยนแปลงบัญชีฝากเงิน ให้ดูยอดเงินที่ต้องโอนทุกครั้ง ห้ามปัดเศษสตางค์ ห้ามลืมเศษสตางค์ ใช้บัญชีที่ถอนเงินโอนเข้ามาเท่านั้น ไม่เช่นนั้นระบบจะไม่ปรับเครดิตและแบนถอนuserทันที</p>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h3 style=\"text-align:center\"><span style=\"background-color:#3498db\">#&nbsp;วิธีใช้งานเว็บ/วิธีดูหวยอยู่ในคู่มือใช้งาน&nbsp;(อ่านครั้งเดียวเป็นครับ)</span></h3>\r\n\r\n<p style=\"text-align:center\">&nbsp;</p>\r\n\r\n<h2 style=\"text-align:center\">ติดต่อทีมงาน / บริหารงานโดย เฮียบิ๊ก @ ปอยเปต</h2>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><strong>#</strong>&nbsp;เนื่องจากทีมงานทำงานต่างประเทศ ลูกค้าสามารถติดต่อได้ทางเมนูของเว็บเท่านั้นค่ะ&nbsp; &nbsp;&nbsp;<strong>คลิ้กที่นี้เพื่อติดต่อทีมงานโดยด่วน</strong>&nbsp;</p>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h5 style=\"text-align:center\"><span style=\"color:#3498db\"><span style=\"font-size:14px\">(ระวังมิจฉาชีพหลอกให้โอนเงิน เว็บไม่มีนโยบายชักชวนให้เติมเงินผ่านทางแชทหรือLINE ให้เติมผ่านเมนูในระบบเว็บเท่านั้นค่ะ)&nbsp;</span></span></h5>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<h3 style=\"text-align:center\"><span style=\"color:#e74c3c\">สิทธิพิเศษลูกค้า&nbsp;สามารถรับผลหวยปิงปอง หวยหุ้น หวยต่างๆ ผ่าน LINE ได้แล้วค่ะ</span></h3>\r\n\r\n<p style=\"text-align:center\">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>\r\n\r\n<p style=\"text-align:center\"><img alt=\"แทงหวยออนไลน์\" src=\"https://999lucky.com/assets/global/img/lucky.jpg\" /></p>\r\n','2018-02-19 22:53:48','2018-02-19 22:53:48');
/*!40000 ALTER TABLE `lol_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_issue`
--

DROP TABLE IF EXISTS `lol_issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_issue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `lol_createdByIssue` (`createdBy`),
  CONSTRAINT `lol_createdByIssue` FOREIGN KEY (`createdBy`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_issue`
--

LOCK TABLES `lol_issue` WRITE;
/*!40000 ALTER TABLE `lol_issue` DISABLE KEYS */;
INSERT INTO `lol_issue` VALUES (1,'ไม่ปรับยอดฝาก','<p>800</p>\r\n',7,'2018-06-10 21:28:57','2018-06-10 21:28:57',1),(2,'ไม่ตัดยอด','<p></p>\r\n\r\n<table><tbody><tr><td>BLLT20180917-00004</td>\r\n			<td>หวยรัฐบาลประจำงวดวันที่ 1 ตุลาคม 2561</td>\r\n			<td>300</td>\r\n			<td>-</td>\r\n			<td>รอผล<br />\r\n			เล่นเสีย</td>\r\n			<td>2018-09-29 15:44:34</td>\r\n		</tr></tbody></table><p></p>\r\n',10,'2022-08-20 21:51:35','2022-08-20 21:51:35',1);
/*!40000 ALTER TABLE `lol_issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_leaguefootball`
--

DROP TABLE IF EXISTS `lol_leaguefootball`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_leaguefootball` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_leaguefootball`
--

LOCK TABLES `lol_leaguefootball` WRITE;
/*!40000 ALTER TABLE `lol_leaguefootball` DISABLE KEYS */;
INSERT INTO `lol_leaguefootball` VALUES (1,'พรีเมียร์ลีก อังกฤษ','2018-05-13 20:14:19','2018-05-13 20:14:19'),(2,'ลา ลีกา สเปน','2018-05-13 20:14:53','2018-05-13 20:14:53'),(3,'เซเรีย อา อิตาลี','2018-05-13 20:15:15','2018-05-13 20:15:15'),(4,'โตโยต้า ไทยลีก','2018-05-13 20:15:29','2018-05-13 20:15:29'),(5,'ฟุตบอลโลก 2018','2018-05-20 21:17:19','2018-05-20 21:17:19');
/*!40000 ALTER TABLE `lol_leaguefootball` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_lottery_period`
--

DROP TABLE IF EXISTS `lol_lottery_period`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_lottery_period` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `startDateTime` datetime NOT NULL,
  `endDateTime` datetime NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_lottery_period`
--

LOCK TABLES `lol_lottery_period` WRITE;
/*!40000 ALTER TABLE `lol_lottery_period` DISABLE KEYS */;
INSERT INTO `lol_lottery_period` VALUES (1,'หวยรัฐบาลประจำงวดวันที่ 16 ธันวาคม 2560','2017-12-01 17:00:31','2017-12-16 12:00:31',1,'2017-12-16 16:27:24','2017-12-16 16:27:24'),(2,'หวยรัฐบาลประจำงวดวันที่ 30 ธันวาคม 2560','2017-12-16 18:00:02','2017-12-30 12:00:02',1,'2017-12-19 01:18:50','2017-12-19 01:18:50'),(3,'หวยรัฐบาลประจำงวดวันที่ 17 มกราคม 2561','2017-12-31 00:00:56','2018-01-17 12:00:56',1,'2017-12-19 01:21:21','2017-12-19 01:21:21'),(4,'หวยรัฐบาลประจำงวดวันที่ 1 กุมภาพันธ์ 2561','2018-01-17 17:00:03','2018-02-01 12:00:03',1,'2017-12-19 01:23:54','2017-12-19 01:23:54'),(5,'หวยรัฐบาลประจำงวดวันที่ 17 กุมภาพันธ์ 2561','2018-02-01 18:30:15','2018-02-17 12:00:15',1,'2018-01-09 02:16:39','2018-01-09 02:16:39'),(6,'หวยรัฐบาลประจำงวดวันที่ 1 มีนาคม 2561','2018-02-17 18:00:39','2018-03-01 12:00:40',1,'2018-01-11 06:38:41','2018-01-11 06:38:41'),(7,'หวยรัฐบาลประจำงวดวันที่ 16 มีนาคม 2561','2018-03-01 18:00:07','2018-03-16 12:00:07',1,'2018-01-19 15:33:22','2018-01-19 15:33:22'),(8,'หวยรัฐบาลประจำงวดวันที่ 1 เมษายน 2561','2018-03-16 18:30:13','2018-04-01 12:00:13',1,'2018-01-19 15:33:22','2018-01-19 15:33:22'),(9,'หวยรัฐบาลประจำงวดวันที่ 16 เมษายน 2561','2018-04-01 18:30:13','2018-04-16 12:00:13',1,'2018-01-19 15:33:22','2018-01-19 15:33:22'),(10,'หวยรัฐบาลประจำงวดวันที่ 2 พฤษภาคม 2561','2018-04-16 18:30:59','2018-05-02 12:00:59',1,'2018-01-19 15:38:10','2018-01-19 15:38:10'),(11,'หวยรัฐบาลประจำงวดวันที่ 16 พฤษภาคม 2561','2018-05-01 18:30:59','2018-05-16 12:30:59',1,'2018-01-19 15:38:10','2018-01-19 15:38:10'),(12,'หวยรัฐบาลประจำงวดวันที่ 1 มิถุนายน 2561','2018-05-16 18:30:59','2018-06-01 12:30:59',1,'2018-01-19 15:38:10','2018-01-19 15:38:10'),(13,'หวยรัฐบาลประจำงวดวันที่ 16 มิถุนายน 2561','2018-06-01 18:00:15','2018-06-16 12:00:15',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(14,'หวยรัฐบาลประจำงวดวันที่ 1 กรกฎาคม 2561','2018-06-16 18:00:15','2018-07-01 12:00:15',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(15,'หวยรัฐบาลประจำงวดวันที่ 16 กรกฎาคม 2561','2018-07-01 18:00:15','2018-07-16 12:00:15',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(16,'หวยรัฐบาลประจำงวดวันที่ 1 สิงหาคม 2561','2018-07-17 18:00:52','2018-08-01 12:00:52',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(17,'หวยรัฐบาลประจำงวดวันที่ 16 สิงหาคม 2561','2018-08-01 18:00:52','2018-08-16 12:00:52',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(18,'หวยรัฐบาลประจำงวดวันที่ 1 กันยายน 2561','2018-08-16 18:30:36','2018-09-01 12:00:00',1,'2018-01-19 15:56:51','2018-01-19 15:56:51'),(19,'หวยรัฐบาลประจำงวดวันที่ 16 กันยายน 2561','2018-09-01 18:00:36','2018-09-16 12:00:36',1,'2018-01-19 15:56:51','2018-01-19 15:56:51'),(20,'หวยรัฐบาลประจำงวดวันที่ 1 ตุลาคม 2561','2018-09-16 18:30:36','2018-10-01 12:00:36',1,'2018-01-19 15:56:51','2018-01-19 15:56:51'),(21,'หวยรัฐบาลประจำงวดวันที่ 16 ตุลาคม 2561','2018-10-01 19:00:36','2018-10-16 12:00:36',1,'2018-01-19 15:56:51','2018-01-19 15:56:51'),(22,'หวยรัฐบาลประจำงวดวันที่ 1 พฤศจิกายน 2561','2018-10-16 18:30:23','2018-11-01 12:00:23',1,'2018-01-19 16:01:15','2018-01-19 16:01:15'),(23,'หวยรัฐบาลประจำงวดวันที่ 16 พฤศจิกายน 2561','2018-11-01 19:00:34','2018-11-16 12:00:34',1,'2018-01-19 16:01:15','2018-01-19 16:01:15'),(24,'หวยรัฐบาลประจำงวดวันที่ 1 ธันวาคม 2561','2018-11-16 19:00:13','2018-12-01 12:00:13',1,'2018-01-19 16:01:15','2018-01-19 16:01:15'),(25,'หวยรัฐบาลประจำงวดวันที่ 16 ธันวาคม 2561','2018-12-01 18:30:13','2018-12-16 12:00:13',1,'2018-01-19 16:01:15','2018-01-19 16:01:15'),(26,'หวยรัฐบาลประจำงวดวันที่ 30 ธันวาคม 2561','2018-12-16 18:00:02','2018-12-30 12:00:02',1,'2018-12-19 01:18:50','2018-12-19 01:18:50'),(27,'หวยรัฐบาลประจำงวดวันที่ 17 มกราคม 2562','2018-12-31 00:00:56','2019-01-17 12:00:56',1,'2019-12-19 01:21:21','2019-12-19 01:21:21'),(28,'หวยรัฐบาลประจำงวดวันที่ 1 กุมภาพันธ์ 2562','2019-01-17 17:00:03','2019-02-16 11:00:03',1,'2019-12-19 01:23:54','2019-12-19 01:23:54'),(29,'หวยรัฐบาลประจำงวดวันที่ 16 กุมภาพันธ์ 2562','2019-02-01 18:30:15','2019-02-17 12:00:15',1,'2018-01-09 02:16:39','2018-01-09 02:16:39'),(30,'หวยรัฐบาลประจำงวดวันที่ 1 มีนาคม 2562','2019-02-17 18:00:39','2019-03-01 12:00:40',1,'2018-01-11 06:38:41','2018-01-11 06:38:41'),(31,'หวยรัฐบาลประจำงวดวันที่ 16 มีนาคม 2562','2019-03-01 18:00:07','2019-03-16 12:00:07',1,'2018-01-19 15:33:22','2018-01-19 15:33:22'),(32,'หวยรัฐบาลประจำงวดวันที่ 1 เมษายน 2562','2019-03-16 18:30:13','2019-04-01 12:00:13',1,'2018-01-19 15:33:22','2018-01-19 15:33:22'),(33,'หวยรัฐบาลประจำงวดวันที่ 16 เมษายน 2562','2019-04-01 18:30:13','2019-04-16 12:00:13',1,'2018-01-19 15:33:22','2018-01-19 15:33:22'),(34,'หวยรัฐบาลประจำงวดวันที่ 1 พฤษภาคม 2562','2019-04-16 18:30:59','2019-05-01 12:00:59',1,'2018-01-19 15:38:10','2018-01-19 15:38:10'),(35,'หวยรัฐบาลประจำงวดวันที่ 16 พฤษภาคม 2562','2019-05-01 18:30:59','2019-05-16 12:30:59',1,'2018-01-19 15:38:10','2018-01-19 15:38:10'),(36,'หวยรัฐบาลประจำงวดวันที่ 1 มิถุนายน 2562','2019-05-16 18:30:59','2019-06-01 12:30:59',1,'2018-01-19 15:38:10','2018-01-19 15:38:10'),(37,'หวยรัฐบาลประจำงวดวันที่ 16 มิถุนายน 2562','2019-06-01 18:00:15','2019-06-16 12:00:15',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(38,'หวยรัฐบาลประจำงวดวันที่ 1 กรกฎาคม 2562','2019-06-16 18:00:15','2019-07-01 12:00:15',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(39,'หวยรัฐบาลประจำงวดวันที่ 16 กรกฎาคม 2562','2019-07-01 18:00:15','2019-07-16 12:00:15',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(40,'หวยรัฐบาลประจำงวดวันที่ 1 สิงหาคม 2562','2019-07-17 18:00:52','2019-08-01 12:00:52',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(41,'หวยรัฐบาลประจำงวดวันที่ 16 สิงหาคม 2562','2019-08-01 18:00:52','2019-08-16 12:00:52',1,'2018-01-19 15:51:04','2018-01-19 15:51:04'),(42,'หวยรัฐบาลประจำงวดวันที่ 1 กันยายน 2562','2019-08-16 18:30:36','2019-09-01 12:00:00',1,'2018-01-19 15:56:51','2018-01-19 15:56:51'),(43,'หวยรัฐบาลประจำงวดวันที่ 16 กันยายน 2562','2019-09-01 18:00:36','2019-09-16 12:00:36',1,'2018-01-19 15:56:51','2018-01-19 15:56:51'),(44,'หวยรัฐบาลประจำงวดวันที่ 1 ตุลาคม 2562','2019-09-16 18:30:36','2019-10-01 12:00:36',1,'2018-01-19 15:56:51','2018-01-19 15:56:51'),(45,'หวยรัฐบาลประจำงวดวันที่ 16 ตุลาคม 2562','2019-10-01 19:00:36','2019-10-16 12:00:36',1,'2018-01-19 15:56:51','2018-01-19 15:56:51'),(46,'หวยรัฐบาลประจำงวดวันที่ 1 พฤศจิกายน 2562','2019-10-16 18:30:23','2019-11-01 12:00:23',1,'2018-01-19 16:01:15','2018-01-19 16:01:15'),(47,'หวยรัฐบาลประจำงวดวันที่ 16 พฤศจิกายน 2562','2019-11-01 19:00:34','2019-11-16 12:00:34',1,'2018-01-19 16:01:15','2018-01-19 16:01:15'),(48,'หวยรัฐบาลประจำงวดวันที่ 1 ธันวาคม 2562','2019-11-16 19:00:13','2019-12-01 12:00:13',1,'2018-01-19 16:01:15','2018-01-19 16:01:15'),(49,'หวยรัฐบาลประจำงวดวันที่ 16 ธันวาคม 2562','2019-12-01 18:30:13','2019-12-16 12:00:13',1,'2018-01-19 16:01:15','2018-01-19 16:01:15'),(50,'หวยรัฐบาลประจำงวดวันที่ 30 ธันวาคม 2562','2019-12-16 18:00:22','2019-12-30 11:30:22',1,'2018-01-28 19:15:17','2018-01-28 19:15:17'),(51,'หวยรัฐบาลประจำงวดวันที่ 1 กันยายน 2565','2022-08-17 12:00:44','2022-09-01 12:00:44',1,'2022-08-20 20:17:39','2022-08-20 20:17:39'),(52,'หวยรัฐบาลประจำงวดวันที่ 16 กันยายน 2565','2022-09-01 18:00:09','2022-09-12 12:00:09',1,'2022-08-20 20:18:43','2022-08-20 20:18:43'),(53,'หวยรัฐบาลประจำงวดวันที่ 1 ตุลาคม 2565','2022-09-16 18:00:33','2022-10-01 12:00:33',1,'2022-08-20 21:33:52','2022-08-20 21:33:52'),(54,'หวยรัฐบาลประจำงวดวันที่ 16 ตุลาคม 2565','2022-10-01 18:00:09','2022-10-16 12:00:09',1,'2022-08-20 21:33:52','2022-08-20 21:33:52');
/*!40000 ALTER TABLE `lol_lottery_period` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_matchfootball`
--

DROP TABLE IF EXISTS `lol_matchfootball`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_matchfootball` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leagueId` int(11) NOT NULL,
  `teamId1` int(11) NOT NULL,
  `teamId2` int(11) NOT NULL,
  `scoreTeam1` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `scoreTeam2` varchar(255) COLLATE utf8_unicode_ci DEFAULT '0',
  `detail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `startMatch` datetime NOT NULL,
  `endMatch` datetime NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `hdpFirstTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeFirstTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `awayFirstTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `overFirstTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `underFirstTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goalFirstTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isFullTime` int(11) DEFAULT NULL,
  `hdpFullTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeFullTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `awayFullTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `overFullTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `underFullTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `goalFullTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `startBuy` datetime DEFAULT NULL,
  `endBuy` datetime DEFAULT NULL,
  `isSecondTeam` int(11) DEFAULT NULL,
  `rangeOverFirstTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rangeOverFullTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `homeWinFirstTime` float DEFAULT NULL,
  `awayWinFirstTime` float DEFAULT NULL,
  `drawWinFirstTime` float DEFAULT NULL,
  `homeWinFullTime` float DEFAULT NULL,
  `awayWinFullTime` float DEFAULT NULL,
  `drawWinFullTime` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `leagueId` (`leagueId`),
  CONSTRAINT `leagueId` FOREIGN KEY (`leagueId`) REFERENCES `lol_leaguefootball` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_matchfootball`
--

LOCK TABLES `lol_matchfootball` WRITE;
/*!40000 ALTER TABLE `lol_matchfootball` DISABLE KEYS */;
INSERT INTO `lol_matchfootball` VALUES (1,5,1,2,'0','0',NULL,1,'2018-06-14 22:00:00','2018-06-14 23:30:00','2018-06-10 21:18:39','2018-06-10 21:18:39','0.50','0.75','1.00','0.80','1.00','1.5',1,'0.50','0.80','1.20','0.80','1.20','3','2018-06-10 00:00:00','2018-06-14 21:40:00',1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `lol_matchfootball` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_menu`
--

DROP TABLE IF EXISTS `lol_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentId` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT 1,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_menu`
--

LOCK TABLES `lol_menu` WRITE;
/*!40000 ALTER TABLE `lol_menu` DISABLE KEYS */;
INSERT INTO `lol_menu` VALUES (1,'contact-us','ติดต่อเรา',NULL,0,'2017-12-11 14:48:19','2017-12-11 14:48:19'),(2,'news','ข่าวสาร',NULL,1,'2017-12-11 14:49:38','2017-12-11 14:49:38'),(3,'manual-register','คู่มือการสมัครสมาชิก',NULL,1,'2017-12-11 14:50:28','2017-12-11 14:50:28'),(4,'#','โปรโมชั่น',NULL,1,'2017-12-11 14:51:25','2017-12-11 14:51:25'),(5,'promotion-normal','โปรโมชั่นสมาชิกปกติ',4,1,'2017-12-11 14:51:47','2017-12-11 14:51:47'),(6,'promotion-agent','โปรโมชั่นตัวแทนขาย',4,1,'2017-12-11 14:52:20','2017-12-11 14:52:20'),(7,'home','หน้าแรก',NULL,0,'2018-02-19 22:50:59','2018-02-19 22:50:59'),(8,'article ','Article',4,0,'2019-10-23 00:03:12','2019-10-23 00:03:12');
/*!40000 ALTER TABLE `lol_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_migration`
--

DROP TABLE IF EXISTS `lol_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_migration`
--

LOCK TABLES `lol_migration` WRITE;
/*!40000 ALTER TABLE `lol_migration` DISABLE KEYS */;
INSERT INTO `lol_migration` VALUES ('m000000_000000_base',1528613008),('m171209_095640_bank',1528613038),('m171209_101050_user',1528613038),('m171209_222150_group',1528613038),('m171209_224050_group_user',1528613039),('m171210_211250_menu',1528613039),('m171210_222440_information',1528613039),('m171211_094740_type_lottery',1528613039),('m171211_095040_lottery',1528613039),('m171211_095550_promotion_lottery',1528613039),('m171211_100040_payment_lottery',1528613040),('m171214_190440_condition_lottery',1528613040),('m171216_152440_leagueFootball',1528613040),('m171216_152840_teamFootball',1528613040),('m171216_152950_matchFootball',1528613040),('m171217_085450_buy_lottery',1528613040),('m171217_210550_bank_owner',1528613040),('m171217_211020_transfer_money',1528613040),('m171217_211520_withdraw_money',1528613041),('m171217_212420_transaction_bank',1528613041),('m171219_204040_user_log',1528613041),('m171220_221050_bill_lottery',1528613041),('m171224_093540_note_transfer_money',1528613041),('m171224_225750_win_lottery',1528613041),('m171225_172050_add_column_user',1528613042),('m171226_225250_add_field_condition_lottery_table',1528613042),('m180113_124450_add_field_bill_lottery',1528613042),('m180118_220550_add_fields_bank_owner_table',1528613042),('m180120_110250_add_fields_win_lottery',1528613042),('m180120_110350_add_fields_buy_lottery',1528613043),('m180122_225150_rename_colum_user_table',1528613043),('m180122_232820_add_field_code_bank_owner',1528613043),('m180125_214850_add_fields_bank',1528613043),('m180126_000650_add_fields_user',1528613044),('m180217_190850_order_lottery',1528613044),('m180218_191220_add_field_total_bill_lottery',1528613044),('m180220_214050_add_field_total_paid_bill_lottery',1528613044),('m180220_214250_wallet_user_table',1528613044),('m180303_233750_add_filed_show_frontend_in_type_lottery',1528613044),('m180311_212550_add_field_detail_in_with_draw_money',1528613045),('m180318_203740_add_field_type_lottery_in_condition_lottery',1528613045),('m180325_170750_add_field_ispurchase_in_condition_lottery_table',1528613045),('m180325_212330_create_issue_table',1528613045),('m180325_213830_create_answer_issue_table',1528613045),('m180331_134850_add_field_total_and_created_at_in_transaction_bank',1528613046),('m180429_204150_visitor_table',1528613046),('m180503_222340_add_field_transaction_number_and_chanel_bank_id_and_chanl_bank_table',1528613046),('m180504_211920_add_fields_in_match_football',1528613047),('m180512_163340_add_field_in_match_football',1528613048),('m180513_121340_result_football',1528613048),('m180513_240450_buy_football',1528613048),('m180519_170250_add_data_chanel',1528613048),('m180524_135450_add_field_transactionDate_in_transfer_money_table',1528613048),('m180525_214020_add_field_is_seconed_team_in_match_football',1528616481),('m180526_092350_add_field_rate_buy_football',1528616481),('m180529_195550_add_field_league_id_in_team_football',1528616481),('m180529_200930_bill_football',1528616481),('m180610_215050_add_field_status_issue_table',1528649630),('m180617_243250_add_field_logo_team_football',1537979925),('m180621_222450_add_field_in_user_table',1537979925),('m180628_230950_add_fields_match_football_table',1537979926),('m180630_163250_add_field_type_result_football_and_buy_football_table',1537979926),('m180711_135250_create_feed_news_table',1537979926),('m180711_135650_create_comment_feed_news_table',1537979926),('m180721_095050_add_filed_is_fulltime_in_buy_football_and_result_football',1537979927);
/*!40000 ALTER TABLE `lol_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_note_transfer_money`
--

DROP TABLE IF EXISTS `lol_note_transfer_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_note_transfer_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `photos` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `idTransferMoney` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updateAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `idTransferMoney` (`idTransferMoney`),
  CONSTRAINT `idTransferMoney` FOREIGN KEY (`idTransferMoney`) REFERENCES `lol_transfer_money` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_note_transfer_money`
--

LOCK TABLES `lol_note_transfer_money` WRITE;
/*!40000 ALTER TABLE `lol_note_transfer_money` DISABLE KEYS */;
INSERT INTO `lol_note_transfer_money` VALUES (2,'รอตรวจสอบการฝากเงิน','',2,'2018-06-10 19:38:17','2018-06-10 19:38:17'),(3,'รอตรวจสอบการฝากเงิน ครับ','',4,'2018-06-13 12:51:10','2018-06-13 12:51:10'),(4,'รอตรวจสอบการฝากเงิน','',5,'2018-06-22 07:59:33','2018-06-22 07:59:33'),(5,'รอตรวจสอบการฝากเงิน','',6,'2018-06-22 08:18:58','2018-06-22 08:18:58'),(6,'รอตรวจสอบการฝากเงิน','c24af65a3148e14ba4b5dd9cb39229eb.png',7,'2018-12-31 10:44:17','2018-12-31 10:44:17'),(7,'รอตรวจสอบการฝากเงิน','',8,'2022-08-20 20:25:17','2022-08-20 20:25:17');
/*!40000 ALTER TABLE `lol_note_transfer_money` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_order_lottery`
--

DROP TABLE IF EXISTS `lol_order_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_order_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moneyPlay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moneyPay` float NOT NULL,
  `paymentId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `typeLotteryId` int(11) NOT NULL,
  `OrderlotteryId` int(11) NOT NULL,
  `isExistBuy` int(11) DEFAULT 0,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `orderLottery_typeLotteryId` (`typeLotteryId`),
  KEY `orderPaymentId` (`paymentId`),
  KEY `orderUserId` (`userId`),
  KEY `order_Lottery_lotteryId` (`OrderlotteryId`),
  CONSTRAINT `orderLottery_typeLotteryId` FOREIGN KEY (`typeLotteryId`) REFERENCES `lol_type_lottery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orderPaymentId` FOREIGN KEY (`paymentId`) REFERENCES `lol_payment_lottery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `orderUserId` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `order_Lottery_lotteryId` FOREIGN KEY (`OrderlotteryId`) REFERENCES `lol_lottery_period` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_order_lottery`
--

LOCK TABLES `lol_order_lottery` WRITE;
/*!40000 ALTER TABLE `lol_order_lottery` DISABLE KEYS */;
INSERT INTO `lol_order_lottery` VALUES (1,'323','100',62,297,7,1,13,1,'2018-06-10 20:06:16','2018-06-10 20:06:16'),(2,'815','100',62,299,7,3,13,1,'2018-06-10 20:06:29','2018-06-10 20:06:29'),(3,'831','100',62,297,7,1,13,1,'2018-06-10 23:44:35','2018-06-10 23:44:35'),(4,'831','100',62,299,7,3,13,1,'2018-06-10 23:44:44','2018-06-10 23:44:44'),(5,'831','100',62,299,7,3,13,1,'2018-06-10 23:44:44','2018-06-10 23:44:44'),(6,'323','50',31,297,7,1,13,1,'2018-06-11 22:38:20','2018-06-11 22:38:20'),(7,'323','50',31,299,7,3,13,1,'2018-06-11 22:38:28','2018-06-11 22:38:28'),(8,'83','50',40,301,7,5,13,1,'2018-06-11 22:38:45','2018-06-11 22:38:45'),(9,'83','50',40,302,7,6,13,1,'2018-06-11 22:39:00','2018-06-11 22:39:00'),(10,'831','10',6,305,7,1,13,1,'2018-06-11 22:40:39','2018-06-11 22:40:39'),(11,'323','100',95,433,10,1,20,1,'2018-09-29 15:43:47','2018-09-29 15:43:47'),(12,'565','100',95,435,10,3,20,1,'2018-09-29 15:44:02','2018-09-29 15:44:02'),(13,'65','100',100,437,10,5,20,1,'2018-09-29 15:44:11','2018-09-29 15:44:11'),(14,'01','10001',10001,651,10,6,51,1,'2022-08-20 20:26:20','2022-08-20 20:26:20'),(15,'01','10001',10001,651,10,6,51,1,'2022-08-20 21:05:55','2022-08-20 21:05:55'),(16,'01','2000',2000,652,10,5,51,1,'2022-08-20 21:06:03','2022-08-20 21:06:03'),(17,'01','10001',10001,651,10,6,51,1,'2022-08-20 22:13:44','2022-08-20 22:13:44'),(18,'01','10001',10001,651,10,6,51,1,'2022-08-20 22:15:09','2022-08-20 22:15:09');
/*!40000 ALTER TABLE `lol_order_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_payment_lottery`
--

DROP TABLE IF EXISTS `lol_payment_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_payment_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeLotteryId` int(11) NOT NULL,
  `lotteryId` int(11) NOT NULL,
  `promotionLotteryId` int(11) NOT NULL,
  `payment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `lotteryId` (`lotteryId`),
  KEY `typeLotteryId` (`typeLotteryId`),
  KEY `promotionLotteryId` (`promotionLotteryId`),
  CONSTRAINT `lotteryId` FOREIGN KEY (`lotteryId`) REFERENCES `lol_lottery_period` (`id`) ON DELETE CASCADE,
  CONSTRAINT `promotionLotteryId` FOREIGN KEY (`promotionLotteryId`) REFERENCES `lol_promotion_lottery` (`id`) ON DELETE CASCADE,
  CONSTRAINT `typeLotteryId` FOREIGN KEY (`typeLotteryId`) REFERENCES `lol_type_lottery` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=655 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_payment_lottery`
--

LOCK TABLES `lol_payment_lottery` WRITE;
/*!40000 ALTER TABLE `lol_payment_lottery` DISABLE KEYS */;
INSERT INTO `lol_payment_lottery` VALUES (1,1,1,1,'900','5','2020-12-17 22:31:00','2020-12-17 22:31:00'),(2,2,1,1,'150','5','2023-12-17 22:45:00','2023-12-17 22:45:00'),(3,3,1,1,'900','5','2028-01-18 12:28:00','2028-01-18 12:28:00'),(4,4,1,1,'150','5','2028-01-18 12:31:00','2028-01-18 12:31:00'),(5,5,1,1,'90','0','2028-01-18 12:31:00','2028-01-18 12:31:00'),(6,6,1,1,'90','0','2028-01-18 12:31:00','2028-01-18 12:31:00'),(7,7,1,1,'30','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(8,8,1,1,'40','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(9,1,1,2,'550','38','2028-01-18 12:40:00','2028-01-18 12:40:00'),(10,2,1,2,'100','38','2017-12-20 22:31:00','2017-12-20 22:31:00'),(11,3,1,2,'120','38','2017-12-23 22:45:00','2017-12-23 22:45:00'),(12,4,1,2,'100','38','2018-01-28 12:28:00','2018-01-28 12:28:00'),(13,5,1,2,'70','20','2018-01-28 12:31:00','2018-01-28 12:31:00'),(14,6,1,2,'70','20','2018-01-28 12:31:00','2018-01-28 12:31:00'),(15,7,1,2,'4','10','2018-01-28 12:31:00','2018-01-28 12:31:00'),(16,8,1,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(17,1,1,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(18,2,1,3,'90','40','2018-01-28 12:40:00','2018-01-28 12:40:00'),(19,3,1,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(20,4,1,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(21,5,1,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(22,6,1,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(23,7,1,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(24,8,1,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(25,1,2,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(26,2,2,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(27,3,2,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(28,4,2,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(29,5,2,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(30,6,2,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(31,7,2,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(32,8,2,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(33,1,2,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(34,2,2,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(35,3,2,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(36,4,2,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(37,5,2,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(38,6,2,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(39,7,2,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(40,8,2,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(41,1,2,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(42,2,2,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(43,3,2,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(44,4,2,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(45,5,2,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(46,6,2,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(47,7,2,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(48,8,2,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(49,1,3,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(50,2,3,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(51,3,3,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(52,4,3,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(53,5,3,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(54,6,3,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(55,7,3,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(56,8,3,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(57,1,3,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(58,2,3,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(59,3,3,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(60,4,3,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(61,5,3,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(62,6,3,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(63,7,3,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(64,8,3,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(65,1,3,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(66,2,3,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(67,3,3,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(68,4,3,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(69,5,3,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(70,6,3,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(71,7,3,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(72,8,3,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(73,1,4,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(74,2,4,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(75,3,4,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(76,4,4,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(77,5,4,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(78,6,4,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(79,7,4,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(80,8,4,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(81,1,4,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(82,2,4,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(83,3,4,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(84,4,4,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(85,5,4,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(86,6,4,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(87,7,4,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(88,8,4,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(89,1,4,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(90,2,4,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(91,3,4,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(92,4,4,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(93,5,4,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(94,6,4,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(95,7,4,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(96,8,4,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(97,1,5,1,'900','5','2017-12-20 22:31:00','2017-12-20 22:31:00'),(98,2,5,1,'150','5','2017-12-23 22:45:00','2017-12-23 22:45:00'),(99,3,5,1,'900','5','2018-01-28 12:28:00','2018-01-28 12:28:00'),(100,4,5,1,'150','5','2018-01-28 12:31:00','2018-01-28 12:31:00'),(101,5,5,1,'90','0','2018-01-28 12:31:00','2018-01-28 12:31:00'),(102,6,5,1,'90','0','2018-01-28 12:31:00','2018-01-28 12:31:00'),(103,7,5,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(104,8,5,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(105,1,5,2,'550','38','2018-01-28 12:40:00','2018-01-28 12:40:00'),(106,2,5,2,'100','38','2020-12-17 22:31:00','2020-12-17 22:31:00'),(107,3,5,2,'120','38','2023-12-17 22:45:00','2023-12-17 22:45:00'),(108,4,5,2,'100','38','2028-01-18 12:28:00','2028-01-18 12:28:00'),(109,5,5,2,'70','20','2028-01-18 12:31:00','2028-01-18 12:31:00'),(110,6,5,2,'70','20','2028-01-18 12:31:00','2028-01-18 12:31:00'),(111,7,5,2,'4','10','2028-01-18 12:31:00','2028-01-18 12:31:00'),(112,8,5,2,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(113,1,5,3,'500','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(114,2,5,3,'90','40','2028-01-18 12:40:00','2028-01-18 12:40:00'),(115,3,5,3,'110','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(116,4,5,3,'90','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(117,5,5,3,'65','25','2028-01-18 12:33:00','2028-01-18 12:33:00'),(118,6,5,3,'65','25','2028-01-18 12:33:00','2028-01-18 12:33:00'),(119,7,5,3,'3','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(120,8,5,3,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(121,1,6,1,'900','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(122,2,6,1,'150','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(123,3,6,1,'900','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(124,4,6,1,'150','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(125,5,6,1,'90','0','2028-01-18 12:33:00','2028-01-18 12:33:00'),(126,6,6,1,'90','0','2028-01-18 12:33:00','2028-01-18 12:33:00'),(127,7,6,1,'30','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(128,8,6,1,'40','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(129,1,6,2,'550','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(130,2,6,2,'100','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(131,3,6,2,'120','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(132,4,6,2,'100','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(133,5,6,2,'70','20','2028-01-18 12:33:00','2028-01-18 12:33:00'),(134,6,6,2,'70','20','2028-01-18 12:33:00','2028-01-18 12:33:00'),(135,7,6,2,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(136,8,6,2,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(137,1,6,3,'500','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(138,2,6,3,'90','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(139,3,6,3,'110','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(140,4,6,3,'90','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(141,5,6,3,'65','25','2028-01-18 12:33:00','2028-01-18 12:33:00'),(142,6,6,3,'65','25','2028-01-18 12:33:00','2028-01-18 12:33:00'),(143,7,6,3,'3','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(144,8,6,3,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(145,1,7,1,'900','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(146,2,7,1,'150','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(147,3,7,1,'900','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(148,4,7,1,'150','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(149,5,7,1,'90','0','2028-01-18 12:33:00','2028-01-18 12:33:00'),(150,6,7,1,'90','0','2028-01-18 12:33:00','2028-01-18 12:33:00'),(151,7,7,1,'30','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(152,8,7,1,'40','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(153,1,7,2,'550','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(154,2,7,2,'100','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(155,3,7,2,'120','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(156,4,7,2,'100','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(157,5,7,2,'70','20','2028-01-18 12:33:00','2028-01-18 12:33:00'),(158,6,7,2,'70','20','2028-01-18 12:33:00','2028-01-18 12:33:00'),(159,7,7,2,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(160,8,7,2,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(161,1,7,3,'500','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(162,2,7,3,'90','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(163,3,7,3,'110','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(164,4,7,3,'90','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(165,5,7,3,'65','25','2028-01-18 12:33:00','2028-01-18 12:33:00'),(166,6,7,3,'65','25','2028-01-18 12:33:00','2028-01-18 12:33:00'),(167,7,7,3,'3','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(168,8,7,3,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(169,1,8,1,'900','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(170,2,8,1,'150','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(171,3,8,1,'900','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(172,4,8,1,'150','5','2028-01-18 12:33:00','2028-01-18 12:33:00'),(173,5,8,1,'90','0','2028-01-18 12:33:00','2028-01-18 12:33:00'),(174,6,8,1,'90','0','2028-01-18 12:33:00','2028-01-18 12:33:00'),(175,7,8,1,'30','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(176,8,8,1,'40','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(177,1,8,2,'550','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(178,2,8,2,'100','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(179,3,8,2,'120','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(180,4,8,2,'100','38','2028-01-18 12:33:00','2028-01-18 12:33:00'),(181,5,8,2,'70','20','2028-01-18 12:33:00','2028-01-18 12:33:00'),(182,6,8,2,'70','20','2028-01-18 12:33:00','2028-01-18 12:33:00'),(183,7,8,2,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(184,8,8,2,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(185,1,8,3,'500','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(186,2,8,3,'90','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(187,3,8,3,'110','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(188,4,8,3,'90','40','2028-01-18 12:33:00','2028-01-18 12:33:00'),(189,5,8,3,'65','25','2028-01-18 12:33:00','2028-01-18 12:33:00'),(190,6,8,3,'65','25','2028-01-18 12:33:00','2028-01-18 12:33:00'),(191,7,8,3,'3','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(192,8,8,3,'4','10','2028-01-18 12:33:00','2028-01-18 12:33:00'),(193,1,9,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(194,2,9,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(195,3,9,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(196,4,9,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(197,5,9,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(198,6,9,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(199,7,9,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(200,8,9,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(201,1,9,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(202,2,9,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(203,3,9,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(204,4,9,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(205,5,9,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(206,6,9,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(207,7,9,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(208,8,9,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(209,1,9,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(210,2,9,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(211,3,9,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(212,4,9,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(213,5,9,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(214,6,9,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(215,7,9,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(216,8,9,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(217,1,10,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(218,2,10,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(219,3,10,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(220,4,10,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(221,5,10,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(222,6,10,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(223,7,10,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(224,8,10,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(225,1,10,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(226,2,10,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(227,3,10,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(228,4,10,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(229,5,10,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(230,6,10,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(231,7,10,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(232,8,10,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(233,1,10,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(234,2,10,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(235,3,10,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(236,4,10,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(237,5,10,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(238,6,10,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(239,7,10,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(240,8,10,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(241,1,11,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(242,2,11,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(243,3,11,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(244,4,11,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(245,5,11,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(246,6,11,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(247,7,11,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(248,8,11,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(249,1,11,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(250,2,11,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(251,3,11,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(252,4,11,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(253,5,11,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(254,6,11,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(255,7,11,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(256,8,11,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(257,1,11,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(258,2,11,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(259,3,11,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(260,4,11,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(261,5,11,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(262,6,11,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(263,7,11,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(264,8,11,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(265,1,12,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(266,2,12,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(267,3,12,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(268,4,12,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(269,5,12,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(270,6,12,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(271,7,12,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(272,8,12,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(273,1,12,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(274,2,12,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(275,3,12,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(276,4,12,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(277,5,12,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(278,6,12,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(279,7,12,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(280,8,12,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(281,1,12,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(282,2,12,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(283,3,12,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(284,4,12,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(285,5,12,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(286,6,12,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(287,7,12,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(288,8,12,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(289,1,13,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(290,2,13,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(291,3,13,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(292,4,13,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(293,5,13,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(294,6,13,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(295,7,13,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(296,8,13,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(297,1,13,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(298,2,13,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(299,3,13,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(300,4,13,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(301,5,13,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(302,6,13,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(303,7,13,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(304,8,13,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(305,1,13,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(306,2,13,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(307,3,13,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(308,4,13,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(309,5,13,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(310,6,13,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(311,7,13,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(312,8,13,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(313,1,14,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(314,2,14,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(315,3,14,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(316,4,14,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(317,5,14,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(318,6,14,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(319,7,14,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(320,8,14,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(321,1,14,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(322,2,14,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(323,3,14,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(324,4,14,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(325,5,14,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(326,6,14,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(327,7,14,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(328,8,14,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(329,1,14,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(330,2,14,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(331,3,14,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(332,4,14,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(333,5,14,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(334,6,14,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(335,7,14,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(336,8,14,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(337,1,15,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(338,2,15,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(339,3,15,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(340,4,15,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(341,5,15,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(342,6,15,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(343,7,15,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(344,8,15,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(345,1,15,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(346,2,15,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(347,3,15,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(348,4,15,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(349,5,15,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(350,6,15,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(351,7,15,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(352,8,15,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(353,1,15,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(354,2,15,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(355,3,15,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(356,4,15,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(357,5,15,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(358,6,15,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(359,7,15,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(360,8,15,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(361,1,16,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(362,2,16,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(363,3,16,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(364,4,16,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(365,5,16,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(366,6,16,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(367,7,16,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(368,8,16,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(369,1,16,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(370,2,16,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(371,3,16,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(372,4,16,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(373,5,16,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(374,6,16,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(375,7,16,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(376,8,16,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(377,1,16,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(378,2,16,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(379,3,16,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(380,4,16,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(381,5,16,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(382,6,16,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(383,7,16,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(384,8,16,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(385,1,17,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(386,2,17,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(387,3,17,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(388,4,17,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(389,5,17,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(390,6,17,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(391,7,17,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(392,8,17,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(393,1,17,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(394,2,17,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(395,3,17,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(396,4,17,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(397,5,17,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(398,6,17,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(399,7,17,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(400,8,17,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(401,1,17,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(402,2,17,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(403,3,17,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(404,4,17,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(405,5,17,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(406,6,17,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(407,7,17,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(408,8,17,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(409,1,18,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(410,2,18,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(411,3,18,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(412,4,18,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(413,5,18,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(414,6,18,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(415,7,18,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(416,8,18,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(417,1,18,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(418,2,18,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(419,3,18,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(420,4,18,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(421,5,18,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(422,6,18,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(423,7,18,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(424,8,18,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(425,1,18,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(426,2,18,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(427,3,18,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(428,4,18,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(429,5,18,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(430,6,18,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(431,7,18,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(432,8,18,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(433,1,20,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(434,2,20,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(435,3,20,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(436,4,20,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(437,5,20,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(438,6,20,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(439,7,20,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(440,8,20,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(441,1,20,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(442,2,20,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(443,3,20,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(444,4,20,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(445,5,20,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(446,6,20,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(447,7,20,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(448,8,20,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(449,1,20,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(450,2,20,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(451,3,20,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(452,4,20,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(453,5,20,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(454,6,20,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(455,7,20,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(456,8,20,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(457,1,21,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(458,2,21,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(459,3,21,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(460,4,21,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(461,5,21,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(462,6,21,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(463,7,21,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(464,8,21,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(465,1,21,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(466,2,21,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(467,3,21,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(468,4,21,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(469,5,21,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(470,6,21,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(471,7,21,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(472,8,21,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(473,1,21,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(474,2,21,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(475,3,21,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(476,4,21,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(477,5,21,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(478,6,21,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(479,7,21,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(480,8,21,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(481,1,23,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(482,2,23,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(483,3,23,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(484,4,23,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(485,5,23,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(486,6,23,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(487,7,23,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(488,8,23,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(489,1,23,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(490,2,23,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(491,3,23,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(492,4,23,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(493,5,23,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(494,6,23,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(495,7,23,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(496,8,23,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(497,1,23,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(498,2,23,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(499,3,23,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(500,4,23,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(501,5,23,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(502,6,23,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(503,7,23,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(504,8,23,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(505,1,24,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(506,2,24,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(507,3,24,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(508,4,24,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(509,5,24,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(510,6,24,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(511,7,24,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(512,8,24,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(513,1,24,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(514,2,24,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(515,3,24,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(516,4,24,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(517,5,24,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(518,6,24,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(519,7,24,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(520,8,24,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(521,1,24,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(522,2,24,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(523,3,24,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(524,4,24,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(525,5,24,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(526,6,24,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(527,7,24,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(528,8,24,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(529,1,25,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(530,2,25,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(531,3,25,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(532,4,25,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(533,5,25,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(534,6,25,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(535,7,25,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(536,8,25,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(537,1,25,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(538,2,25,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(539,3,25,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(540,4,25,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(541,5,25,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(542,6,25,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(543,7,25,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(544,8,25,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(545,1,25,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(546,2,25,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(547,3,25,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(548,4,25,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(549,5,25,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(550,6,25,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(551,7,25,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(552,8,25,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(553,1,27,1,'900','5','2018-12-31 10:50:17','2018-12-31 10:50:17'),(556,4,27,1,'150','5','2018-12-31 10:52:35','2018-12-31 10:52:35'),(557,2,27,1,'150','5','2018-12-31 10:53:18','2018-12-31 10:53:18'),(558,3,27,1,'900','5','2019-01-10 00:06:37','2019-01-10 00:06:37'),(559,5,27,1,'90	','0','2019-01-10 00:08:09','2019-01-10 00:08:09'),(560,6,27,1,'90','0','2019-01-10 00:08:41','2019-01-10 00:08:41'),(561,7,27,1,'4','0','2019-01-10 00:13:53','2019-01-10 00:13:53'),(562,8,27,1,'4','0','2019-01-10 00:14:18','2019-01-10 00:14:18'),(563,1,27,2,'550','38','2019-01-10 00:15:41','2019-01-10 00:15:41'),(564,2,27,2,'100','38','2019-01-10 00:17:13','2019-01-10 00:17:13'),(565,3,27,2,'120','38','2019-01-10 00:17:54','2019-01-10 00:17:54'),(566,4,27,2,'100','38','2019-01-10 00:19:30','2019-01-10 00:19:30'),(567,5,27,2,'70','20','2019-01-10 00:20:01','2019-01-10 00:20:01'),(568,6,27,2,'70','20','2019-01-10 00:20:28','2019-01-10 00:20:28'),(569,7,27,2,'4','10','2019-01-10 00:21:45','2019-01-10 00:21:45'),(570,8,27,2,'4','10','2019-01-10 00:21:59','2019-01-10 00:21:59'),(571,1,27,3,'500','40','2019-01-10 00:23:04','2019-01-10 00:23:04'),(572,2,27,3,'90','40','2019-01-10 00:23:31','2019-01-10 00:23:31'),(573,3,27,3,'110','40','2019-01-10 00:23:55','2019-01-10 00:23:55'),(574,4,27,3,'90','40','2019-01-10 00:24:30','2019-01-10 00:24:30'),(575,5,27,3,'65','20','2019-01-10 00:25:10','2019-01-10 00:25:10'),(576,6,27,3,'65','25','2019-01-10 00:25:28','2019-01-10 00:25:28'),(577,7,27,3,'4','10','2019-01-10 00:25:56','2019-01-10 00:25:56'),(578,8,27,3,'4','10','2019-01-10 00:26:14','2019-01-10 00:26:14'),(579,1,28,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(580,2,28,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(581,3,28,1,'900','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(582,4,28,1,'150','5','2018-01-28 12:33:00','2018-01-28 12:33:00'),(583,5,28,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(584,6,28,1,'90','0','2018-01-28 12:33:00','2018-01-28 12:33:00'),(585,7,28,1,'30','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(586,8,28,1,'40','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(587,1,28,2,'550','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(588,2,28,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(589,3,28,2,'120','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(590,4,28,2,'100','38','2018-01-28 12:33:00','2018-01-28 12:33:00'),(591,5,28,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(592,6,28,2,'70','20','2018-01-28 12:33:00','2018-01-28 12:33:00'),(593,7,28,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(594,8,28,2,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(595,1,28,3,'500','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(596,2,28,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(597,3,28,3,'110','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(598,4,28,3,'90','40','2018-01-28 12:33:00','2018-01-28 12:33:00'),(599,5,28,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(600,6,28,3,'65','25','2018-01-28 12:33:00','2018-01-28 12:33:00'),(601,7,28,3,'3','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(602,8,28,3,'4','10','2018-01-28 12:33:00','2018-01-28 12:33:00'),(603,1,29,1,'900','5','2018-01-29 12:33:00','2018-01-29 12:33:00'),(604,2,29,1,'150','5','2018-01-29 12:33:00','2018-01-29 12:33:00'),(605,3,29,1,'900','5','2018-01-29 12:33:00','2018-01-29 12:33:00'),(606,4,29,1,'150','5','2018-01-29 12:33:00','2018-01-29 12:33:00'),(607,5,29,1,'90','0','2018-01-29 12:33:00','2018-01-29 12:33:00'),(608,6,29,1,'90','0','2018-01-29 12:33:00','2018-01-29 12:33:00'),(609,7,29,1,'30','10','2018-01-29 12:33:00','2018-01-29 12:33:00'),(610,8,29,1,'40','10','2018-01-29 12:33:00','2018-01-29 12:33:00'),(611,1,29,2,'550','38','2018-01-29 12:33:00','2018-01-29 12:33:00'),(612,2,29,2,'100','38','2018-01-29 12:33:00','2018-01-29 12:33:00'),(613,3,29,2,'120','38','2018-01-29 12:33:00','2018-01-29 12:33:00'),(614,4,29,2,'100','38','2018-01-29 12:33:00','2018-01-29 12:33:00'),(615,5,29,2,'70','20','2018-01-29 12:33:00','2018-01-29 12:33:00'),(616,6,29,2,'70','20','2018-01-29 12:33:00','2018-01-29 12:33:00'),(617,7,29,2,'4','10','2018-01-29 12:33:00','2018-01-29 12:33:00'),(618,8,29,2,'4','10','2018-01-29 12:33:00','2018-01-29 12:33:00'),(619,1,29,3,'500','40','2018-01-29 12:33:00','2018-01-29 12:33:00'),(620,2,29,3,'90','40','2018-01-29 12:33:00','2018-01-29 12:33:00'),(621,3,29,3,'110','40','2018-01-29 12:33:00','2018-01-29 12:33:00'),(622,4,29,3,'90','40','2018-01-29 12:33:00','2018-01-29 12:33:00'),(623,5,29,3,'65','25','2018-01-29 12:33:00','2018-01-29 12:33:00'),(624,6,29,3,'65','25','2018-01-29 12:33:00','2018-01-29 12:33:00'),(625,7,29,3,'3','10','2018-01-29 12:33:00','2018-01-29 12:33:00'),(626,8,29,3,'4','10','2018-01-29 12:33:00','2018-01-29 12:33:00'),(627,1,30,1,'900','5','2018-01-30 12:33:00','2018-01-30 12:33:00'),(628,2,30,1,'150','5','2018-01-30 12:33:00','2018-01-30 12:33:00'),(629,3,30,1,'900','5','2018-01-30 12:33:00','2018-01-30 12:33:00'),(630,4,30,1,'150','5','2018-01-30 12:33:00','2018-01-30 12:33:00'),(631,5,30,1,'90','0','2018-01-30 12:33:00','2018-01-30 12:33:00'),(632,6,30,1,'90','0','2018-01-30 12:33:00','2018-01-30 12:33:00'),(633,7,30,1,'30','10','2018-01-30 12:33:00','2018-01-30 12:33:00'),(634,8,30,1,'40','10','2018-01-30 12:33:00','2018-01-30 12:33:00'),(635,1,30,2,'550','38','2018-01-30 12:33:00','2018-01-30 12:33:00'),(636,2,30,2,'100','38','2018-01-30 12:33:00','2018-01-30 12:33:00'),(637,3,30,2,'120','38','2018-01-30 12:33:00','2018-01-30 12:33:00'),(638,4,30,2,'100','38','2018-01-30 12:33:00','2018-01-30 12:33:00'),(639,5,30,2,'70','20','2018-01-30 12:33:00','2018-01-30 12:33:00'),(640,6,30,2,'70','20','2018-01-30 12:33:00','2018-01-30 12:33:00'),(641,7,30,2,'4','10','2018-01-30 12:33:00','2018-01-30 12:33:00'),(642,8,30,2,'4','10','2018-01-30 12:33:00','2018-01-30 12:33:00'),(643,1,30,3,'500','40','2018-01-30 12:33:00','2018-01-30 12:33:00'),(644,2,30,3,'90','40','2018-01-30 12:33:00','2018-01-30 12:33:00'),(645,3,30,3,'110','40','2018-01-30 12:33:00','2018-01-30 12:33:00'),(646,4,30,3,'90','40','2018-01-30 12:33:00','2018-01-30 12:33:00'),(647,5,30,3,'65','25','2018-01-30 12:33:00','2018-01-30 12:33:00'),(648,6,30,3,'65','25','2018-01-30 12:33:00','2018-01-30 12:33:00'),(649,7,30,3,'3','10','2018-01-30 12:33:00','2018-01-30 12:33:00'),(650,8,30,3,'4','10','2018-01-30 12:33:00','2018-01-30 12:33:00'),(651,6,51,1,'60','0','2022-08-20 20:21:26','2022-08-20 20:21:26'),(652,5,51,1,'60','0','2022-08-20 20:22:34','2022-08-20 20:22:34'),(653,3,51,1,'100','0','2022-08-20 20:23:06','2022-08-20 20:23:06'),(654,1,51,1,'100','0','2022-08-20 20:23:43','2022-08-20 20:23:43');
/*!40000 ALTER TABLE `lol_payment_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_promotion_lottery`
--

DROP TABLE IF EXISTS `lol_promotion_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_promotion_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_promotion_lottery`
--

LOCK TABLES `lol_promotion_lottery` WRITE;
/*!40000 ALTER TABLE `lol_promotion_lottery` DISABLE KEYS */;
INSERT INTO `lol_promotion_lottery` VALUES (1,'โปรมือสมัครเล่น','2017-12-20 22:29:10','2017-12-20 22:29:10'),(2,'โปรเซียน','2018-01-13 17:06:45','2018-01-13 17:06:45'),(3,'โปรปราบเซียน','2018-01-13 17:06:45','2018-01-13 17:06:45');
/*!40000 ALTER TABLE `lol_promotion_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_result_football`
--

DROP TABLE IF EXISTS `lol_result_football`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_result_football` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matchId` int(11) NOT NULL,
  `teamWinByMatchId` int(11) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `type` int(11) DEFAULT 1 COMMENT '1 = hdp, 2 = over, 3 = HxA',
  `isFullTime` int(11) DEFAULT NULL,
  `isAnswer` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `lol_result_football_match_id` (`matchId`),
  KEY `lol_result_football_created_by` (`createdBy`),
  CONSTRAINT `lol_result_football_created_by` FOREIGN KEY (`createdBy`) REFERENCES `lol_user` (`id`),
  CONSTRAINT `lol_result_football_match_id` FOREIGN KEY (`matchId`) REFERENCES `lol_matchfootball` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_result_football`
--

LOCK TABLES `lol_result_football` WRITE;
/*!40000 ALTER TABLE `lol_result_football` DISABLE KEYS */;
/*!40000 ALTER TABLE `lol_result_football` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_teamfootball`
--

DROP TABLE IF EXISTS `lol_teamfootball`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_teamfootball` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `leagueId` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `lol_team_football_league_id` (`leagueId`),
  CONSTRAINT `lol_team_football_league_id` FOREIGN KEY (`leagueId`) REFERENCES `lol_leaguefootball` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_teamfootball`
--

LOCK TABLES `lol_teamfootball` WRITE;
/*!40000 ALTER TABLE `lol_teamfootball` DISABLE KEYS */;
INSERT INTO `lol_teamfootball` VALUES (1,'รัสเซีย','2018-06-10 20:39:17','2018-06-10 20:39:17',5,NULL),(2,'ซาอุดีอาระเบีย','2018-06-10 20:39:30','2018-06-10 20:39:30',5,NULL);
/*!40000 ALTER TABLE `lol_teamfootball` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_transaction_bank`
--

DROP TABLE IF EXISTS `lol_transaction_bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_transaction_bank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bankName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bankNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `money` float NOT NULL,
  `status` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `triggerId` int(11) NOT NULL,
  `triggerName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `transaction_userId` (`userId`),
  CONSTRAINT `transaction_userId` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_transaction_bank`
--

LOCK TABLES `lol_transaction_bank` WRITE;
/*!40000 ALTER TABLE `lol_transaction_bank` DISABLE KEYS */;
INSERT INTO `lol_transaction_bank` VALUES (1,'ธนาคารกรุงไทย','24990908855',1000,0,7,2,'ฝากเงิน',1528634297,0,7),(2,'ธนาคารกรุงไทย','24990908855',1000,1,7,2,'ฝากเงิน',1528634340,1000,1),(3,'ธนาคารไทยพาณิชย์','88899888999',124,1,7,7,'แทงหวย',1528635994,876,7),(4,'ธนาคารไทยพาณิชย์','88899888999',200,1,7,7,'แทงบอล',1528640722,676,7),(5,'ธนาคารไทยพาณิชย์','88899888999',200,1,7,7,'แทงบอล',1528640731,476,7),(6,'ธนาคารไทยพาณิชย์','88899888999',200,1,7,7,'ยกเลิกรายการแทงบอล',1528640773,676,7),(7,'ธนาคารไทยพาณิชย์','88899888999',124,1,7,7,'คืนเงินค่ายกเลิกหวย',1528649051,NULL,NULL),(8,'ธนาคารไทยพาณิชย์','88899888999',186,1,7,7,'แทงหวย',1528649088,NULL,NULL),(9,'ธนาคารไทยพาณิชย์','88899888999',142,1,7,7,'แทงหวย',1528731547,472,7),(10,'ธนาคารไทยพาณิชย์','88899888999',6,1,7,7,'แทงหวย',1528731663,466,7),(11,'ธนาคารกรุงไทย','24990908855',1000,0,10,4,'ฝากเงิน',1528869070,0,10),(12,'ธนาคารกรุงไทย','24990908855',1000,1,10,4,'ฝากเงิน',1528869142,1000,1),(13,'ธนาคารกรุงไทย','24494882200',1000,0,10,5,'ฝากเงิน',1529672373,1000,10),(14,'ธนาคารกรุงไทย','24494882200',1000,1,10,5,'ฝากเงิน',1529672429,2000,1),(15,'ธนาคารกรุงไทย','24494882200',1500,0,10,6,'ฝากเงิน',1529673538,2000,10),(16,'ธนาคารกรุงไทย','24494882200',1500,1,10,6,'ฝากเงิน',1529673583,3500,1),(17,'ธนาคารออมสิน','861632651212',290,1,10,10,'แทงหวย',1538210674,3210,10),(18,'ธนาคารกรุงไทย','24990908855',500,0,8,7,'ฝากเงิน',1546227857,0,8),(19,'ธนาคารกรุงไทย','24990908855',500,1,8,7,'ฝากเงิน',1546227939,500,1),(20,'ธนาคารกรุงไทย','23456789',500000,0,10,8,'ฝากเงิน',1661001917,3210,10),(21,'ธนาคารกรุงไทย','23456789',500000,0,10,8,'ฝากเงิน',1661001929,3210,1),(22,'ธนาคารกรุงไทย','23456789',500000,1,10,8,'ฝากเงิน',1661001944,503210,1),(23,'ธนาคารออมสิน','861632651212',10001,1,10,10,'แทงหวย',1661001984,493209,10),(24,'ธนาคารออมสิน','861632651212',10001,1,10,10,'คืนเงินค่ายกเลิกหวย',1661002714,503210,10),(25,'ธนาคารออมสิน','861632651212',12001,1,10,10,'แทงหวย',1661004366,491209,10),(26,'ธนาคารออมสิน','861632651212',12001,1,10,10,'คืนเงินค่ายกเลิกหวย',1661004467,503210,10),(27,'ธนาคารออมสิน','861632651212',10001,1,10,10,'แทงหวย',1661008430,493209,10),(28,'ธนาคารออมสิน','861632651212',10001,1,10,10,'คืนเงินค่ายกเลิกหวย',1661008446,503210,10),(29,'ธนาคารออมสิน','861632651212',10001,1,10,10,'แทงหวย',1661008512,493209,10);
/*!40000 ALTER TABLE `lol_transaction_bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_transfer_money`
--

DROP TABLE IF EXISTS `lol_transfer_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_transfer_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bankOwnerId` int(11) NOT NULL,
  `money` float NOT NULL,
  `status` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `transactionNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chanelBankId` int(11) NOT NULL,
  `transactionDate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bankOwnerId` (`bankOwnerId`),
  KEY `transfer_userId` (`userId`),
  KEY `lol_transfer_money_chanel_bank` (`chanelBankId`),
  CONSTRAINT `bankOwnerId` FOREIGN KEY (`bankOwnerId`) REFERENCES `lol_bank_owner` (`id`) ON DELETE CASCADE,
  CONSTRAINT `lol_transfer_money_chanel_bank` FOREIGN KEY (`chanelBankId`) REFERENCES `lol_chanel_bank` (`id`) ON DELETE CASCADE,
  CONSTRAINT `transfer_userId` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_transfer_money`
--

LOCK TABLES `lol_transfer_money` WRITE;
/*!40000 ALTER TABLE `lol_transfer_money` DISABLE KEYS */;
INSERT INTO `lol_transfer_money` VALUES (2,3,1000,1,7,1,'2018-06-10 19:38:17','2018-06-10 19:38:17','20180610-TF4139',1,'2018-06-10 19:38:00'),(3,3,124,1,7,7,'2018-06-10 23:44:10','2018-06-10 23:44:10','',0,'0000-00-00 00:00:00'),(4,3,1000,1,10,1,'2018-06-13 12:51:10','2018-06-13 12:51:10','20180613-TF8303',4,'2018-06-13 12:50:00'),(5,4,1000,1,10,1,'2018-06-22 07:59:33','2018-06-22 07:59:33','20180622-TF2659',2,'2018-06-22 19:56:00'),(6,4,1500,1,10,1,'2018-06-22 08:18:58','2018-06-22 08:18:58','20180622-TF6899',1,'2018-06-22 20:11:00'),(7,3,500,1,8,1,'2018-12-31 10:44:17','2018-12-31 10:44:17','20181231-TF5092',4,'2018-12-31 10:43:00'),(8,1,500000,1,10,1,'2022-08-20 20:25:17','2022-08-20 20:25:17','20220820-TF4112',4,'2022-08-20 20:24:00'),(9,1,10001,1,10,10,'2022-08-20 20:38:34','2022-08-20 20:38:34','',0,'0000-00-00 00:00:00'),(10,1,12001,1,10,10,'2022-08-20 21:07:47','2022-08-20 21:07:47','',0,'0000-00-00 00:00:00'),(11,1,10001,1,10,10,'2022-08-20 22:14:06','2022-08-20 22:14:06','',0,'0000-00-00 00:00:00');
/*!40000 ALTER TABLE `lol_transfer_money` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_type_lottery`
--

DROP TABLE IF EXISTS `lol_type_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_type_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `status` int(11) DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_type_lottery`
--

LOCK TABLES `lol_type_lottery` WRITE;
/*!40000 ALTER TABLE `lol_type_lottery` DISABLE KEYS */;
INSERT INTO `lol_type_lottery` VALUES (1,'3 ตัวบน','2017-12-20 22:30:57','2017-12-20 22:30:57',1),(2,'3 ตัวบนโต๊ด','2017-12-23 22:43:50','2017-12-23 22:43:50',1),(3,'3 ตัวล่าง\n','2018-01-13 17:11:39','2018-01-13 17:11:39',1),(4,'3 ตัวล่างโต๊ด','2018-01-13 17:11:39','2018-01-13 17:11:39',1),(5,'2 ตัวบน','2018-01-28 09:58:23','2018-01-28 09:58:23',1),(6,'2 ตัวล่าง\n','2018-01-28 09:58:39','2018-01-28 09:58:39',1),(7,'วิ่ง-บน','2018-01-28 09:59:16','2018-01-28 09:59:16',1),(8,'วิ่ง-ล่าง','2018-01-28 09:59:16','2018-01-28 09:59:16',1),(9,'2 ตัวล่าง + กลับ','2022-08-20 22:01:45','2022-08-20 22:01:45',1),(10,'2 ตัวบน + กลับ','2022-08-20 22:02:00','2022-08-20 22:02:00',1),(11,'2 ตัวบน + ล่าง','2022-08-20 22:02:13','2022-08-20 22:02:13',1),(12,'2 ตัวบน + ล่าง + กลับ','2022-08-20 22:02:25','2022-08-20 22:02:25',1);
/*!40000 ALTER TABLE `lol_type_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_user`
--

DROP TABLE IF EXISTS `lol_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `bankId` int(11) NOT NULL,
  `numberBank` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enabled` int(11) NOT NULL DEFAULT 1,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lineId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profileImage` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `referCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referenceReferCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`),
  KEY `fk-bank` (`bankId`),
  CONSTRAINT `fk-bank` FOREIGN KEY (`bankId`) REFERENCES `lol_bank` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_user`
--

LOCK TABLES `lol_user` WRITE;
/*!40000 ALTER TABLE `lol_user` DISABLE KEYS */;
INSERT INTO `lol_user` VALUES (1,'sys','admin','','sys','','$2y$10$qcYb/rySpeWjJa6/GPWSwe7Du3U/eVxR78Qq/u2r5Mf/FleoXV29O',NULL,'sys@sys.com',10,1,'788499',1,'2018-05-04 23:12:50','2018-05-04 23:12:50','','','5e2b928174949eb0f1b1b72c3b4020ee.jpg',NULL,NULL,NULL,NULL),(7,'userdemo_04','Test','55','userdemo_04','hJD9teHHYbH0lfAc0oXzShGY5zvRfFJV','$2y$13$uNPkxjpjlNjBEfIULDexHellZf1mHp8p/nQBmoNWil1QALJdpcIwa',NULL,'userdemo_04@gmail.com',10,3,'88899888999',1,'2018-06-10 19:35:58','2018-06-10 19:35:58','089864454545','userdemo_04','d94ae8e1c6ff63e5546d3fdb0ad536ed.png','1986-10-10',NULL,NULL,NULL),(8,'SALE','Test','555','SALE01','OtJAcoHp3l8s5RTW-21m_bNBJLb9a0y6','$2y$13$8AJ3saLEoVSz6cKl8CMsyOCgo6dp1qd02HeIcQT7qnBZMR18siZJi',NULL,'sal20@gmail.com',10,3,'88899888555',1,'2018-06-11 00:16:30','2018-06-11 00:16:30','0899989999','sale01','19d8813145bb4ff20a169306b776f865.png','2018-06-11','',NULL,NULL),(9,'webmaster','b','599','webmaster_b','_aFaOQ6ijAoEZYUVwdpKMB9XNWgmGO5t','$2y$13$RWKamW9/Z/mYt9vcwcytQe3MwLJqoy/9HfCiNti4PS8J9vJXOFfp2',NULL,'webmaster@gmail.com',10,1,'88899888555',1,'2018-06-11 00:19:35','2018-06-11 00:19:35','0899986699','webmaster',NULL,'2018-06-11','',NULL,NULL),(10,'userdemo','userdemotest','555','userdemo','Pd8fJiQSSMVeVmq6Y6o8prV1QkhdGNlw','$2y$13$SOCi6CFz/VfoJ7DFpCaFqesD4n/ljNwJvChhqggz3LuoyxAVuFpFu',NULL,'userdemo@gmail.com',10,1,'861632651212',1,'2018-06-13 12:49:27','2018-06-13 12:49:27','08999800000','userdemo',NULL,'2018-06-13',NULL,NULL,NULL);
/*!40000 ALTER TABLE `lol_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_user_group`
--

DROP TABLE IF EXISTS `lol_user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `groupId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `userIdFk` (`userId`),
  KEY `groupIdFk` (`groupId`),
  CONSTRAINT `groupIdFk` FOREIGN KEY (`groupId`) REFERENCES `lol_group` (`id`) ON DELETE CASCADE,
  CONSTRAINT `userIdFk` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_user_group`
--

LOCK TABLES `lol_user_group` WRITE;
/*!40000 ALTER TABLE `lol_user_group` DISABLE KEYS */;
INSERT INTO `lol_user_group` VALUES (5,7,5,'2018-06-10 19:35:58','2018-06-10 19:35:58'),(6,8,4,'2018-06-11 00:16:30','2018-06-11 00:16:30'),(8,9,2,'2018-06-11 00:20:50','2018-06-11 00:20:50'),(9,1,3,'2018-06-11 13:17:34','2018-06-11 13:17:34'),(10,10,5,'2018-06-13 12:49:27','2018-06-13 12:49:27');
/*!40000 ALTER TABLE `lol_user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_user_log`
--

DROP TABLE IF EXISTS `lol_user_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_user_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ipAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL COMMENT '1 = login, 2 = logout',
  `userId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `userLog_userId` (`userId`),
  CONSTRAINT `userLog_userId` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_user_log`
--

LOCK TABLES `lol_user_log` WRITE;
/*!40000 ALTER TABLE `lol_user_log` DISABLE KEYS */;
INSERT INTO `lol_user_log` VALUES (1,'172.20.10.3',1,1,'2018-06-10 18:38:53'),(4,'172.20.10.3',1,7,'2018-06-10 19:37:39'),(5,'172.20.10.3',2,7,'2018-06-11 00:13:49'),(6,'172.20.10.3',2,1,'2018-06-11 00:22:40'),(7,'172.20.10.3',1,1,'2018-06-11 00:24:14'),(8,'172.20.10.3',2,1,'2018-06-11 00:26:06'),(9,'172.20.10.3',1,9,'2018-06-11 00:26:59'),(10,'172.20.10.3',1,7,'2018-06-11 00:37:03'),(11,'192.168.1.47',2,7,'2018-06-13 12:48:31'),(12,'192.168.1.47',1,10,'2018-06-13 12:50:01'),(13,'192.168.1.47',2,10,'2018-06-13 12:50:16'),(14,'192.168.1.47',1,10,'2018-06-13 12:50:37'),(15,'216.12.199.3',1,10,'2018-06-13 03:02:20'),(16,'216.12.199.3',2,10,'2018-06-13 03:02:25'),(17,'216.12.199.3',1,10,'2018-06-13 03:03:19'),(18,'216.12.199.3',2,10,'2018-06-13 03:06:26'),(19,'216.12.199.3',1,1,'2018-06-14 09:03:25'),(20,'216.12.199.3',1,1,'2018-06-14 09:04:48'),(21,'216.12.199.3',1,10,'2018-06-21 11:16:03'),(22,'192.168.1.103',1,1,'2018-09-28 16:46:17'),(23,'172.20.10.3',1,1,'2018-09-29 15:36:49'),(24,'172.20.10.3',1,10,'2018-09-29 15:42:14'),(25,'127.0.0.1',2,1,'2018-10-15 21:44:56'),(26,'127.0.0.1',2,10,'2018-10-15 21:45:12'),(27,'192.168.1.233',1,1,'2018-10-16 19:01:08'),(28,'192.168.1.233',1,1,'2018-10-16 19:25:26'),(29,'192.168.101.116',1,1,'2018-12-28 15:27:06'),(30,'192.168.101.116',1,1,'2018-12-28 15:55:17'),(31,'192.168.101.116',2,1,'2018-12-28 15:58:10'),(32,'192.168.101.116',1,1,'2018-12-28 15:58:51'),(33,'172.20.10.3',1,8,'2018-12-31 10:40:01'),(34,'127.0.0.1',2,8,'2019-01-09 23:46:49'),(35,'127.0.0.1',1,7,'2019-01-09 23:48:05'),(36,'172.20.10.3',1,1,'2019-05-22 15:04:55'),(37,'192.168.214.1',1,1,'2019-10-22 22:56:24'),(38,'192.168.214.1',1,1,'2019-10-22 23:54:49'),(39,'192.168.1.142',1,1,'2022-08-20 17:06:30'),(40,'192.168.1.142',1,10,'2022-08-20 20:19:54'),(41,'192.168.1.142',1,10,'2022-08-20 20:57:18'),(42,'192.168.1.142',1,1,'2022-08-20 21:54:42');
/*!40000 ALTER TABLE `lol_user_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_visitor`
--

DROP TABLE IF EXISTS `lol_visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_visitor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `visitorByDate` date DEFAULT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_visitor`
--

LOCK TABLES `lol_visitor` WRITE;
/*!40000 ALTER TABLE `lol_visitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `lol_visitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_wallet_user`
--

DROP TABLE IF EXISTS `lol_wallet_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_wallet_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` float NOT NULL,
  `userId` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `walletUserId` (`userId`),
  CONSTRAINT `walletUserId` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_wallet_user`
--

LOCK TABLES `lol_wallet_user` WRITE;
/*!40000 ALTER TABLE `lol_wallet_user` DISABLE KEYS */;
INSERT INTO `lol_wallet_user` VALUES (5,466,7,'2018-06-10 19:35:58','2018-06-11 22:41:03'),(6,500,8,'2018-06-11 00:16:30','2018-12-31 10:45:39'),(7,0,9,'2018-06-11 00:19:35','2018-06-11 00:19:35'),(8,493209,10,'2018-06-13 12:49:27','2022-08-20 22:15:12');
/*!40000 ALTER TABLE `lol_wallet_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_win_lottery`
--

DROP TABLE IF EXISTS `lol_win_lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_win_lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lotteryId` int(11) NOT NULL,
  `typeLotteryId` int(11) NOT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `createdBy` int(11) NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `answer` int(11) DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `win_lotteryId` (`lotteryId`),
  KEY `win_typeLotteryId` (`typeLotteryId`),
  CONSTRAINT `win_lotteryId` FOREIGN KEY (`lotteryId`) REFERENCES `lol_lottery_period` (`id`) ON DELETE CASCADE,
  CONSTRAINT `win_typeLotteryId` FOREIGN KEY (`typeLotteryId`) REFERENCES `lol_type_lottery` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_win_lottery`
--

LOCK TABLES `lol_win_lottery` WRITE;
/*!40000 ALTER TABLE `lol_win_lottery` DISABLE KEYS */;
INSERT INTO `lol_win_lottery` VALUES (1,10,1,'038',1,1,'2018-05-05 02:10:01','2018-05-05 02:10:01',1),(2,10,5,'38',1,1,'2018-05-05 02:10:02','2018-05-05 02:10:02',1),(3,10,2,'038',1,1,'2018-05-05 02:10:02','2018-05-05 02:10:02',1),(4,10,2,'083',1,1,'2018-05-05 02:10:02','2018-05-05 02:10:02',1),(5,10,2,'308',1,1,'2018-05-05 02:10:02','2018-05-05 02:10:02',1),(6,10,2,'380',1,1,'2018-05-05 02:10:02','2018-05-05 02:10:02',1),(7,10,2,'830',1,1,'2018-05-05 02:10:02','2018-05-05 02:10:02',1),(8,10,2,'803',1,1,'2018-05-05 02:10:02','2018-05-05 02:10:02',1),(9,3,1,'823',1,1,'2018-05-06 13:48:03','2018-05-06 13:48:03',1),(10,3,5,'23',1,1,'2018-05-06 13:48:03','2018-05-06 13:48:03',1),(11,3,2,'823',1,1,'2018-05-06 13:48:03','2018-05-06 13:48:03',1),(12,3,2,'832',1,1,'2018-05-06 13:48:03','2018-05-06 13:48:03',1),(13,3,2,'283',1,1,'2018-05-06 13:48:03','2018-05-06 13:48:03',1),(14,3,2,'238',1,1,'2018-05-06 13:48:03','2018-05-06 13:48:03',1),(15,3,2,'328',1,1,'2018-05-06 13:48:03','2018-05-06 13:48:03',1),(16,3,2,'382',1,1,'2018-05-06 13:48:03','2018-05-06 13:48:03',1),(17,4,1,'853',1,1,'2018-05-06 13:48:23','2018-05-06 13:48:23',1),(18,4,5,'53',1,1,'2018-05-06 13:48:23','2018-05-06 13:48:23',1),(19,4,2,'853',1,1,'2018-05-06 13:48:23','2018-05-06 13:48:23',1),(20,4,2,'835',1,1,'2018-05-06 13:48:23','2018-05-06 13:48:23',1),(21,4,2,'583',1,1,'2018-05-06 13:48:23','2018-05-06 13:48:23',1),(22,4,2,'538',1,1,'2018-05-06 13:48:23','2018-05-06 13:48:23',1),(23,4,2,'358',1,1,'2018-05-06 13:48:23','2018-05-06 13:48:23',1),(24,4,2,'385',1,1,'2018-05-06 13:48:23','2018-05-06 13:48:23',1),(25,5,1,'915',1,1,'2018-05-06 13:48:42','2018-05-06 13:48:42',1),(26,5,5,'15',1,1,'2018-05-06 13:48:42','2018-05-06 13:48:42',1),(27,5,2,'915',1,1,'2018-05-06 13:48:42','2018-05-06 13:48:42',1),(28,5,2,'951',1,1,'2018-05-06 13:48:42','2018-05-06 13:48:42',1),(29,5,2,'195',1,1,'2018-05-06 13:48:42','2018-05-06 13:48:42',1),(30,5,2,'159',1,1,'2018-05-06 13:48:42','2018-05-06 13:48:42',1),(31,5,2,'519',1,1,'2018-05-06 13:48:42','2018-05-06 13:48:42',1),(32,5,2,'591',1,1,'2018-05-06 13:48:42','2018-05-06 13:48:42',1),(33,6,1,'415',1,1,'2018-05-06 13:50:48','2018-05-06 13:50:48',1),(34,6,5,'15',1,1,'2018-05-06 13:50:48','2018-05-06 13:50:48',1),(35,6,2,'415',1,1,'2018-05-06 13:50:48','2018-05-06 13:50:48',1),(36,6,2,'451',1,1,'2018-05-06 13:50:48','2018-05-06 13:50:48',1),(37,6,2,'145',1,1,'2018-05-06 13:50:48','2018-05-06 13:50:48',1),(38,6,2,'154',1,1,'2018-05-06 13:50:48','2018-05-06 13:50:48',1),(39,6,2,'514',1,1,'2018-05-06 13:50:48','2018-05-06 13:50:48',1),(40,6,2,'541',1,1,'2018-05-06 13:50:48','2018-05-06 13:50:48',1),(41,7,1,'559',1,1,'2018-05-06 13:51:01','2018-05-06 13:51:01',1),(42,7,5,'59',1,1,'2018-05-06 13:51:01','2018-05-06 13:51:01',1),(43,7,2,'559',1,1,'2018-05-06 13:51:01','2018-05-06 13:51:01',1),(44,7,2,'595',1,1,'2018-05-06 13:51:01','2018-05-06 13:51:01',1),(45,7,2,'559',1,1,'2018-05-06 13:51:01','2018-05-06 13:51:01',1),(46,7,2,'595',1,1,'2018-05-06 13:51:01','2018-05-06 13:51:01',1),(47,7,2,'955',1,1,'2018-05-06 13:51:01','2018-05-06 13:51:01',1),(48,7,2,'955',1,1,'2018-05-06 13:51:01','2018-05-06 13:51:01',1),(49,8,1,'073',1,1,'2018-05-06 13:51:15','2018-05-06 13:51:15',1),(50,8,5,'73',1,1,'2018-05-06 13:51:15','2018-05-06 13:51:15',1),(51,8,2,'073',1,1,'2018-05-06 13:51:15','2018-05-06 13:51:15',1),(52,8,2,'037',1,1,'2018-05-06 13:51:15','2018-05-06 13:51:15',1),(53,8,2,'703',1,1,'2018-05-06 13:51:15','2018-05-06 13:51:15',1),(54,8,2,'730',1,1,'2018-05-06 13:51:15','2018-05-06 13:51:15',1),(55,8,2,'370',1,1,'2018-05-06 13:51:15','2018-05-06 13:51:15',1),(56,8,2,'307',1,1,'2018-05-06 13:51:15','2018-05-06 13:51:15',1),(57,9,1,'229',1,1,'2018-05-06 13:51:36','2018-05-06 13:51:36',1),(58,9,5,'29',1,1,'2018-05-06 13:51:36','2018-05-06 13:51:36',1),(59,9,2,'229',1,1,'2018-05-06 13:51:36','2018-05-06 13:51:36',1),(60,9,2,'292',1,1,'2018-05-06 13:51:36','2018-05-06 13:51:36',1),(61,9,2,'229',1,1,'2018-05-06 13:51:36','2018-05-06 13:51:36',1),(62,9,2,'292',1,1,'2018-05-06 13:51:36','2018-05-06 13:51:36',1),(63,9,2,'922',1,1,'2018-05-06 13:51:36','2018-05-06 13:51:36',1),(64,9,2,'922',1,1,'2018-05-06 13:51:36','2018-05-06 13:51:36',1),(65,10,3,'225',1,1,'2018-05-13 23:54:51','2018-05-13 23:54:51',1),(66,10,4,'225',1,1,'2018-05-13 23:55:14','2018-05-13 23:55:14',1),(67,10,4,'252',1,1,'2018-05-13 23:55:14','2018-05-13 23:55:14',1),(68,10,4,'225',1,1,'2018-05-13 23:55:14','2018-05-13 23:55:14',1),(69,10,4,'252',1,1,'2018-05-13 23:55:14','2018-05-13 23:55:14',1),(70,10,4,'522',1,1,'2018-05-13 23:55:14','2018-05-13 23:55:14',1),(71,10,4,'522',1,1,'2018-05-13 23:55:14','2018-05-13 23:55:14',1),(72,10,3,'527',1,1,'2018-05-13 23:56:15','2018-05-13 23:56:15',1),(73,10,4,'527',1,1,'2018-05-13 23:56:35','2018-05-13 23:56:35',1),(74,10,4,'572',1,1,'2018-05-13 23:56:35','2018-05-13 23:56:35',1),(75,10,4,'257',1,1,'2018-05-13 23:56:35','2018-05-13 23:56:35',1),(76,10,4,'275',1,1,'2018-05-13 23:56:35','2018-05-13 23:56:35',1),(78,10,4,'752',1,1,'2018-05-13 23:56:35','2018-05-13 23:56:35',1),(79,10,3,'602',1,1,'2018-05-13 23:58:08','2018-05-13 23:58:08',1),(80,11,1,'629',1,1,'2018-05-20 01:58:05','2018-05-20 01:58:05',1),(81,11,5,'29',1,1,'2018-05-20 01:58:05','2018-05-20 01:58:05',1),(82,11,2,'629',1,1,'2018-05-20 01:58:05','2018-05-20 01:58:05',1),(83,11,2,'692',1,1,'2018-05-20 01:58:05','2018-05-20 01:58:05',1),(84,11,2,'269',1,1,'2018-05-20 01:58:05','2018-05-20 01:58:05',1),(85,11,2,'296',1,1,'2018-05-20 01:58:05','2018-05-20 01:58:05',1),(86,11,2,'926',1,1,'2018-05-20 01:58:05','2018-05-20 01:58:05',1),(87,11,2,'962',1,1,'2018-05-20 01:58:05','2018-05-20 01:58:05',1),(88,11,3,'357',1,1,'2018-05-20 02:07:58','2018-05-20 02:07:58',1),(89,11,3,'130',1,1,'2018-05-20 02:07:58','2018-05-20 02:07:58',1),(90,11,3,'506',1,1,'2018-05-20 02:07:58','2018-05-20 02:07:58',1),(91,11,3,'047',1,1,'2018-05-20 02:07:58','2018-05-20 02:07:58',1),(92,11,4,'357',1,1,'2018-05-20 02:08:29','2018-05-20 02:08:29',1),(93,11,4,'375',1,1,'2018-05-20 02:08:29','2018-05-20 02:08:29',1),(94,11,4,'537',1,1,'2018-05-20 02:08:29','2018-05-20 02:08:29',1),(95,11,4,'573',1,1,'2018-05-20 02:08:29','2018-05-20 02:08:29',1),(96,11,4,'753',1,1,'2018-05-20 02:08:29','2018-05-20 02:08:29',1),(97,11,4,'735',1,1,'2018-05-20 02:08:29','2018-05-20 02:08:29',1),(98,11,4,'130',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(99,11,4,'103',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(100,11,4,'310',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(101,11,4,'301',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(102,11,4,'031',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(103,11,4,'013',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(104,11,4,'506',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(105,11,4,'560',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(106,11,4,'056',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(107,11,4,'065',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(108,11,4,'605',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(109,11,4,'650',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(110,11,4,'047',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(111,11,4,'074',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(112,11,4,'407',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(113,11,4,'470',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(114,11,4,'740',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(115,11,4,'704',1,1,'2018-05-20 02:09:55','2018-05-20 02:09:55',1),(116,11,6,'20',1,1,'2018-05-29 14:13:42','2018-05-29 14:13:42',1),(118,10,6,'85',1,1,'2018-06-06 16:53:04','2018-06-06 16:53:04',1),(119,12,1,'117',1,1,'2018-06-06 16:55:22','2018-06-06 16:55:22',1),(120,12,5,'17',1,1,'2018-06-06 16:55:22','2018-06-06 16:55:22',1),(121,12,2,'117',1,1,'2018-06-06 16:55:22','2018-06-06 16:55:22',1),(122,12,2,'171',1,1,'2018-06-06 16:55:22','2018-06-06 16:55:22',1),(123,12,2,'117',1,1,'2018-06-06 16:55:22','2018-06-06 16:55:22',1),(124,12,2,'171',1,1,'2018-06-06 16:55:22','2018-06-06 16:55:22',1),(125,12,2,'711',1,1,'2018-06-06 16:55:22','2018-06-06 16:55:22',1),(126,12,2,'711',1,1,'2018-06-06 16:55:22','2018-06-06 16:55:22',1),(127,12,4,'553',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(128,12,4,'535',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(129,12,4,'553',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(130,12,4,'535',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(131,12,4,'355',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(132,12,4,'355',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(133,12,4,'310',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(134,12,4,'301',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(135,12,4,'130',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(136,12,4,'103',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(137,12,4,'013',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(138,12,4,'031',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(139,12,4,'248',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(140,12,4,'284',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(141,12,4,'428',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(142,12,4,'482',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(143,12,4,'842',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(144,12,4,'824',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(145,12,4,'650',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(146,12,4,'605',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(147,12,4,'560',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(148,12,4,'506',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(149,12,4,'056',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(150,12,4,'065',1,1,'2018-06-06 16:58:16','2018-06-06 16:58:16',1),(151,12,3,'553',1,1,'2018-06-06 16:59:30','2018-06-06 16:59:30',1),(152,12,3,'310',1,1,'2018-06-06 16:59:30','2018-06-06 16:59:30',1),(153,12,3,'248',1,1,'2018-06-06 16:59:30','2018-06-06 16:59:30',1),(154,12,3,'650',1,1,'2018-06-06 16:59:30','2018-06-06 16:59:30',1),(155,12,6,'95',1,1,'2018-06-11 00:39:41','2018-06-11 00:39:41',1),(156,13,1,'131',1,1,'2019-01-09 23:51:26','2019-01-09 23:51:26',1),(157,13,5,'31',1,1,'2019-01-09 23:51:26','2019-01-09 23:51:26',1),(158,13,2,'131',1,1,'2019-01-09 23:51:26','2019-01-09 23:51:26',1),(159,13,2,'113',1,1,'2019-01-09 23:51:26','2019-01-09 23:51:26',1),(160,13,2,'311',1,1,'2019-01-09 23:51:26','2019-01-09 23:51:26',1),(161,13,2,'311',1,1,'2019-01-09 23:51:26','2019-01-09 23:51:26',1),(162,13,2,'131',1,1,'2019-01-09 23:51:26','2019-01-09 23:51:26',1),(163,13,2,'113',1,1,'2019-01-09 23:51:26','2019-01-09 23:51:26',1),(164,14,1,'262',1,1,'2019-01-09 23:52:27','2019-01-09 23:52:27',1),(165,14,5,'62',1,1,'2019-01-09 23:52:27','2019-01-09 23:52:27',1),(166,14,2,'262',1,1,'2019-01-09 23:52:27','2019-01-09 23:52:27',1),(167,14,2,'226',1,1,'2019-01-09 23:52:27','2019-01-09 23:52:27',1),(168,14,2,'622',1,1,'2019-01-09 23:52:27','2019-01-09 23:52:27',1),(169,14,2,'622',1,1,'2019-01-09 23:52:27','2019-01-09 23:52:27',1),(170,14,2,'262',1,1,'2019-01-09 23:52:27','2019-01-09 23:52:27',1),(171,14,2,'226',1,1,'2019-01-09 23:52:27','2019-01-09 23:52:27',1),(172,13,4,'432',1,1,'2019-01-09 23:55:42','2019-01-09 23:55:42',1),(173,13,4,'423',1,1,'2019-01-09 23:55:42','2019-01-09 23:55:42',1),(174,13,4,'342',1,1,'2019-01-09 23:55:42','2019-01-09 23:55:42',1),(175,13,4,'324',1,1,'2019-01-09 23:55:42','2019-01-09 23:55:42',1),(176,13,4,'234',1,1,'2019-01-09 23:55:42','2019-01-09 23:55:42',1),(177,13,4,'243',1,1,'2019-01-09 23:55:42','2019-01-09 23:55:42',1),(178,13,4,'507',1,1,'2019-01-09 23:56:17','2019-01-09 23:56:17',1),(179,13,4,'570',1,1,'2019-01-09 23:56:17','2019-01-09 23:56:17',1),(180,13,4,'057',1,1,'2019-01-09 23:56:17','2019-01-09 23:56:17',1),(181,13,4,'075',1,1,'2019-01-09 23:56:17','2019-01-09 23:56:17',1),(182,13,4,'705',1,1,'2019-01-09 23:56:17','2019-01-09 23:56:17',1),(183,13,4,'750',1,1,'2019-01-09 23:56:17','2019-01-09 23:56:17',1),(184,20,1,'643',1,1,'2022-08-20 21:12:58','2022-08-20 21:12:58',1),(185,20,5,'43',1,1,'2022-08-20 21:12:58','2022-08-20 21:12:58',1),(186,20,2,'643',1,1,'2022-08-20 21:12:58','2022-08-20 21:12:58',1),(187,20,2,'634',1,1,'2022-08-20 21:12:58','2022-08-20 21:12:58',1),(188,20,2,'463',1,1,'2022-08-20 21:12:58','2022-08-20 21:12:58',1),(189,20,2,'436',1,1,'2022-08-20 21:12:58','2022-08-20 21:12:58',1),(190,20,2,'346',1,1,'2022-08-20 21:12:58','2022-08-20 21:12:58',1),(191,20,2,'364',1,1,'2022-08-20 21:12:58','2022-08-20 21:12:58',1),(192,44,6,'65',1,1,'2022-08-20 21:13:45','2022-08-20 21:13:45',1),(194,20,4,'565',1,1,'2022-08-20 21:15:44','2022-08-20 21:15:44',1),(195,20,4,'556',1,1,'2022-08-20 21:15:44','2022-08-20 21:15:44',1),(196,20,4,'655',1,1,'2022-08-20 21:15:44','2022-08-20 21:15:44',1),(197,20,4,'655',1,1,'2022-08-20 21:15:44','2022-08-20 21:15:44',1),(198,20,4,'565',1,1,'2022-08-20 21:15:44','2022-08-20 21:15:44',1),(199,20,4,'556',1,1,'2022-08-20 21:15:44','2022-08-20 21:15:44',1),(201,44,3,'565',1,1,'2022-08-20 21:17:54','2022-08-20 21:17:54',1),(202,20,3,'565',1,1,'2022-08-20 21:18:52','2022-08-20 21:18:52',1);
/*!40000 ALTER TABLE `lol_win_lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lol_withdraw_money`
--

DROP TABLE IF EXISTS `lol_withdraw_money`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lol_withdraw_money` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bankName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bankNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `money` float NOT NULL,
  `status` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `updatedBy` int(11) NOT NULL,
  `createdAt` datetime DEFAULT current_timestamp(),
  `updatedAt` datetime DEFAULT current_timestamp(),
  `detail` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdBy` int(11) DEFAULT NULL,
  `transactionNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `withdraw_userId` (`userId`),
  CONSTRAINT `withdraw_userId` FOREIGN KEY (`userId`) REFERENCES `lol_user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lol_withdraw_money`
--

LOCK TABLES `lol_withdraw_money` WRITE;
/*!40000 ALTER TABLE `lol_withdraw_money` DISABLE KEYS */;
/*!40000 ALTER TABLE `lol_withdraw_money` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_rbac`
--

DROP TABLE IF EXISTS `migration_rbac`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_rbac` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_rbac`
--

LOCK TABLES `migration_rbac` WRITE;
/*!40000 ALTER TABLE `migration_rbac` DISABLE KEYS */;
INSERT INTO `migration_rbac` VALUES ('m000000_000000_base',1528613080),('m140506_102106_rbac_init',1528613082),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1528613082);
/*!40000 ALTER TABLE `migration_rbac` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'db_lottery'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-20 22:36:11
