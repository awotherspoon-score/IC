-- MySQL dump 10.11
--
-- Host: localhost    Database: immanuel
-- ------------------------------------------------------
-- Server version	5.0.75-0ubuntu10.2

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
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `albums` (
  `id` int(5) NOT NULL auto_increment,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `datecreated` int(11) NOT NULL,
  `datemodified` int(11) NOT NULL,
  `newsid` int(5) NOT NULL,
  `eventid` int(5) NOT NULL,
  `datedisplayed` int(11) NOT NULL,
  `featuredimageid` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (1,'golden-pavillion','Golden Pavillion',1246875704,1246875704,0,0,1246875704,0,1),(2,'temple-of-water','Temple of Water',1246875704,1246875704,0,0,1246875704,0,1),(3,'gallery-three','Gallery three',1246875704,1246875704,0,0,1246875704,0,1);
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `images` (
  `id` int(5) NOT NULL auto_increment,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `datecreated` int(11) NOT NULL,
  `datemodified` int(11) NOT NULL,
  `albumid` int(5) NOT NULL,
  `filename` text NOT NULL,
  `status` int(5) NOT NULL,
  `prospective` int(1) NOT NULL,
  `current` int(1) NOT NULL,
  `staff` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'image1','Image 1',1246889153,1246889153,1,'1.jpg',1,0,0,1),(2,'image2','Image 2',1246889153,1246889153,1,'2.jpg',1,0,0,1),(3,'image3','Image 3',1246889153,1246889153,1,'3.jpg',1,0,0,1),(4,'image4','Image 4',1246889153,1246889153,1,'4.jpg',1,0,0,1),(5,'image5','Image 5',1246889153,1246889153,1,'5.jpg',1,0,0,1),(6,'image6','Image 6',1246889153,1246889153,1,'6.jpg',1,0,0,1),(7,'image7','Image 7',1246889153,1246889153,2,'7.jpg',1,0,0,1),(8,'image8','Image 8',1246889153,1246889153,2,'8.jpg',1,0,0,1),(9,'image9','Image 9',1246889153,1246889153,2,'9.jpg',1,0,0,1);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsevents`
--

DROP TABLE IF EXISTS `newsevents`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `newsevents` (
  `id` int(5) NOT NULL auto_increment,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `datecreated` int(11) NOT NULL,
  `datemodified` int(11) NOT NULL,
  `text` text NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `datedisplayed` int(11) NOT NULL,
  `type` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `newsevents`
--

LOCK TABLES `newsevents` WRITE;
/*!40000 ALTER TABLE `newsevents` DISABLE KEYS */;
INSERT INTO `newsevents` VALUES (1,'news-one','News Story 1a',1246971082,1247074719,'<p>News Content</p>','News Description','keyword 1, keyword 2',1289260800,2,1),(2,'news-two','News Story 2',1246971082,1247075089,'<p>News Content</p>','News Description','keyword 1, keyword 2',1246662000,2,0),(3,'news-three','Eleventh January',1246971082,1247075067,'<p>News Content</p>','News Description','keyword 1, keyword 2',1263168000,2,1),(16,'','Born On Fourth Of July',1247074320,1247075387,'<p>news text</p>','description text','keyword1, keyword2',1246662000,2,0),(17,'','Brand New News Story, 14th February',1247075009,1247075383,'<p>news text</p>','description text','keyword1, keyword2',1266105600,2,0);
/*!40000 ALTER TABLE `newsevents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `pages` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `datecreated` int(11) NOT NULL,
  `datemodified` int(11) NOT NULL,
  `text` text NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `status` int(5) unsigned NOT NULL,
  `parentid` int(5) unsigned NOT NULL,
  `introduction` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'the-school','The School',1244716036,1246615548,'<p>text about the school</p>','description text','school, college, more keywords',1,0,'<p>no value</p>'),(2,'joining-us','Joining Us',1244716036,1244716036,'text about joining us','description text','school, admissions, etc',0,0,''),(3,'way-of-life','Way Of Life',1244716036,1244716036,'text about way of life','description text','life, school, stuff',0,0,''),(4,'about-the-school','About The School',1244716036,1246807091,'<p>text about about the school</p>','description text','the school, keyword 1, keyword 2',1,1,''),(5,'our-ethos','Our Ethos',1244716036,1246807140,'<p>text about our ethos</p>','description text','keyword 1, keyword 2, keyword 3',1,1,''),(6,'the-immanuel-curriculum','The Immanuel Curriculum',1244716036,1246871431,'<p>text about the immanuel curriculum</p>','description text','keyword 1, keyword 2, keyword 3',1,1,''),(7,'the-sixth-form','The Sixth Form',1244716036,1246871518,'<p>text about the sixth form</p>','description text','keyword 1, keyword 3, keyword 3,',1,1,''),(8,'alumni','Alumni',1244716036,1246871532,'<p>text about alumni</p>','description text','keyword 1, keyword 2, keyword 3',1,1,''),(9,'open-day','Open Day',1244716036,1246566851,'<p>text about open day</p>','description text','keyword 1, keyword 2, keyword 3',1,2,''),(10,'entrance-requirements','Entrance Requirements',1244716036,1246628161,'<p>text about entrance requirements</p>','description text','keyword 1, keyword 2 keyword 3',1,2,''),(11,'admissions','Admissions',1244716036,1246628168,'<p>text about admissions</p>','description text','keyword 2, keyword 2, keyword 3',1,2,''),(12,'fees','Fees',1244716036,1246628174,'<p>text about fees</p>','description text','keyword 1, keyword 2, keyword 3',1,2,''),(13,'application-forms','Application Forms',1244716036,1246628180,'<p>text about application forms</p>','description text','keyword 1, keyword 2, keyword 3',1,2,''),(14,'staff','Staff',1244716036,1246628186,'<p>text about staff</p>','description text','keyword 1, keyword 2, keyword 3',1,2,''),(15,'nurturing-our-pupils','Nurturing Our Pupils',1244716036,1246628204,'<p>text about nurturing pupils</p>','description text','keyword 1, keyword 2, keyword 3',1,3,''),(16,'jewish-life-and-learning','Jewish Life And Learning',1244716036,1246628211,'<p>text about jewish life and learning</p>','description text','keyword 1, keyword 2, keyword 3',1,3,''),(17,'extra-curricular-activities','Extra Curricular Activities',1244716036,1246628220,'<p>text about extra curricular activities</p>','description text','keyword 1, keyword 2, keyword 3',1,3,''),(18,'ethos','Ethos',1245168145,1246628242,'<p>text about ethos</p>','description text','keyword 1, keyword 2, keyword 3',1,4,''),(19,'history-about-the-founder','History - About The Founder',1245168145,1246960859,'<p>text about the founder</p><p>&nbsp;</p>','description text','keyword 1, keyword 2, keyword 3, keyword 4',1,4,''),(20,'isc-inspection','ISC Inspection',1245168145,1246628255,'<p>text about isc inspection</p>','description text','keyword 1, keyword 2, keyword 3',1,4,''),(21,'senior-management-team','Senior Management Team',1245168145,1247050241,'<p>text about senior management team</p>','description text','keyword 1, keyword 2, keyword 3',1,4,'<p>intro to smt</p>'),(22,'governers','Governers',1245168145,1246628268,'<p>text about governers</p>','description text','keyword 1, keyword 2, keyword 3',1,4,''),(23,'psa','PSA',1245168145,1246628276,'<p>text about PSA</p>','description text','keyword 1, keyword 2',1,4,''),(24,'school-policies','School Policies',1245168145,1247068340,'<p>text about School Policies</p>','description text','keyword 1, keyword 2',1,4,'<p>School Policies Intro</p>'),(25,'gallery','Gallery',1246875704,1246875704,'Gallery Text','description text','keyword 1, keyword 2',1,0,'empty');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-07-08 17:51:53
