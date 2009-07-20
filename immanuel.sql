-- MySQL dump 10.13  Distrib 5.1.30, for apple-darwin8.11.1 (i386)
--
-- Host: localhost    Database: immanuel
-- ------------------------------------------------------
-- Server version	5.0.41

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
-- Not dumping tablespaces as no INFORMATION_SCHEMA.FILES table on this server
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (1,'golden-pavillion','Golden Pavillion',1246875704,1247733331,0,0,1199176531,2,1),(2,'temple-of-light','Temple of Light',1246875704,1247759431,0,0,1242575431,7,1),(3,'gallery-three','Gallery three',1246875704,1246875704,0,0,1246875704,0,1),(4,'test-one','Test One',1247755628,1247755628,0,0,1247755628,0,1),(5,'test-two','Test Two',1247755628,1247755628,0,0,1247755628,0,1),(6,'test-three','Test Three',1247755628,1247755628,0,0,1247755628,0,1);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'image1','Rock Garden',1246889153,1247434170,1,'1.jpg',1,0,0,0),(2,'image2','Path Leading To The Main Gate',1246889153,1247424065,1,'2.jpg',1,0,0,0),(3,'image3','Old Monks Quarters',1246889153,1247432983,1,'3.jpg',1,0,0,0),(4,'image4','Big Green Pond',1246889153,1247432984,1,'4.jpg',1,0,0,0),(5,'image5','A Butterfly Behind The Golden Pavillion',1246889153,1247424025,1,'5.jpg',1,0,0,0),(6,'image6','Side View Of the Pavillion',1246889153,1247416583,1,'6.jpg',1,0,0,0),(7,'image7','Fountain',1246889153,1247445787,2,'7.jpg',1,0,0,0),(8,'image8','Path',1246889153,1247445794,2,'8.jpg',1,0,0,0),(9,'image9','Image 9',1246889153,1247435712,2,'9.jpg',1,0,0,0),(26,'image10','title',1247755628,1247755628,4,'26.jpg',1,0,0,0),(27,'image11','title',1247755628,1247755628,4,'27.jpg',1,0,0,0),(28,'image12','title',1247755628,1247755628,4,'28.jpg',1,0,0,0),(29,'image13','title',1247755628,1247755628,5,'29.jpg',1,1,0,0),(30,'image14','title',1247755628,1247755628,5,'30.jpg',1,0,0,0),(31,'image15','title',1247755628,1247755628,5,'31.jpg',1,0,0,0),(32,'image16','title',1247755628,1247755628,6,'32.jpg',1,0,0,0),(33,'image17','title',1247755628,1247755628,6,'33.jpg',1,0,0,0),(34,'image18','title',1247755628,1247755628,6,'34.jpg',1,0,0,0);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `newsevents`
--

LOCK TABLES `newsevents` WRITE;
/*!40000 ALTER TABLE `newsevents` DISABLE KEYS */;
INSERT INTO `newsevents` VALUES (31,'year-10-jakobovits-visit','Year 10 Jakobovits Visit',1247266184,1247736982,'<p>Year 10 Immanuel College pupils, were today privileged to have Lady Jakobovits, the widow of the late Chief Rabbi Lord Jakobovits, the founder of the College, come and speak about her experiences in World War II.</p>\r\n<p>The account of her family&rsquo;s escape from Paris before the German bombing assault began on the city, through Nice, and then over the border into Switzerland, and of their commitment to their Torah lifestyle throughout the journey, keeping kashrut, Shabbat, Yomim Tovim and the father rising to the challenge of finding a minyan to daven with, was one that captivated every pupil and staff member in the room.</p>\r\n<p>Lady Jakobovits recalled times of hardship, sadness, and indeed happiness, when her mother gave birth to twins during the war, and concluded with a message that &ldquo;in every clamaity facing the Jewish people throughout history, Hashem has sent someone or some people who help to save the others. The Jewish people have special traits that ensure that we will always survive, and today, it is so special to see Jewish children, learning about their Judaism in such a wonderful Jewish school, so proud of being Jewish.&rdquo;</p>','description text','keyword1, keyword2',1247007600,2,1),(32,'maccabi-boys-tennis-tournament-results','Maccabi Boys Tennis Tournament Results',1247266529,1247418378,'<p>Immanuel College dominated the Year 8 Maccabi Tennis Final when Oliver Donne and Sam Lipton faced Jack Reece (who played up a year group) and Joshua Foley-Comer. Jack and Joshua took the title of Boys Tennis Maccabi Champions. The year 10s also registered a victory with Sam Rosenberg and Josh Nathan defeating a partnership from JFS. Well done to the whole squad.</p>\r\n<p>Y7 team</p>\r\n<p>JAKE NORTON, JAKE GREEN, GAVRIEL NUSSBAUM, JACOB ALBERGA</p>\r\n<p>Y8 team</p>\r\n<p>JACK REECE, JOSHUA FOLEY-COMER, OLIVER DONNE, SAMUEL LIPTON</p>\r\n<p>Y10 team</p>\r\n<p>SAMUEL MARCHANT, DAVID KURZER, SAMUEL ROSENBERG, JOSHUA NATHAN</p>','description text','keyword1, keyword2',1246921200,2,1),(33,'ecdl-success','ECDL Success',1247266625,1247266767,'<p>The following Upper School pupils have completed the 7-module ECDL programme:</p>\r\n<p>Amos Wittenberg         Yr 11</p>\r\n<p>Harry Levene            Yr 10</p>\r\n<p>Joshua Silverblatt       Yr 10</p>\r\n<p>Eitan Lovat               Yr 10</p>\r\n<p>In addition, Marcus Kay and Michael Gilbert both in Year 11 also completed the programme successfully (not featured in the photographs).</p>\r\n<p>This elective programme, completed outside scheduled lessons and supported by Mrs Kanabar and Mr Brzezinski, was offered to a group of pupils demonstrating talent in ICT.</p>','description text','keyword1, keyword2',1246575600,2,1),(34,'immanuel-college-book-award-winner','Immanuel College Book Award - Winner',1247266769,1247331823,'<p>We are pleased to announce the results of the Immanuel Collge Book Award 2009:</p>\r\n<p>In first place, &quot;The Book Thief&quot;, nominated by Jonatan Benarroch and Roey Erez of 9NGA, which received twice as many votes as the runner up.</p>\r\n<p>Second Place - &quot;Alone on a Wide Wide Sea&quot;</p>\r\n<p>Third Place - &quot;H.I.V.E.&quot;</p>\r\n<p>Fourth Place - &quot;Arthur:The Seeing Stone&quot;</p>\r\n<p>Tied Fifth Place - &quot;Runemarks and Mudbound&quot;</p>','description text','keyword1, keyword2',1246402800,2,1),(35,'year-7-cricket-team-win-watford-district-b-league','Year 7 Cricket Team Win Watford District B League',1247266860,1247406861,'<p>The Immanuel College Year 7 Cricket team showed outstanding form throughout the season wining all four of their league matches and one friendly to win the Watford District B league. They won all their matches in convincing fashion beating the larger comprehensive schools of Bushey Meads, Bushey Hall, Westfield and Francis Coombe. The team were captained superbly by Adam Ellis and assisted by vice Captain Jake Norton who showed excellent leadership skills and knowledge of the game throughout the season. Mr. David Moss, Head of Physical Education commented, &ldquo;There are too many outstanding individual performances to mention and this shows great depth in the team&rsquo;s ability. I feel the team have a really good chance of competing with the best sides in Division One next year.&rdquo;</p>','description text','keyword1, keyword2',1245193200,2,1),(36,'immanuel-college-a-good-schools-guide-winner','Immanuel College - A \'Good Schools Guide\' Winner',1247266919,1247331812,'<p>Immanuel College has won the 2009 Good Schools Guide &lsquo;A&rsquo; Level Award for Boys taking Modern Hebrew at &lsquo;A&rsquo; level at an English School. The Good Schools Guide makes these awards on the basis of the data underlying schools&rsquo; post-16 performance table results for the three years 2006, 2007 and 2008 combined, and, in particular, on the basis of the popularity of each subject relative to similar schools, and of the success that pupils achieve relative to the other examinations that they take. The aim of the award is to highlight excellent teaching in individual subjects.</p>\r\n<p>Head Master, Philip Skelker, comments: &ldquo;This well-deserved award reflects the outstanding dedication and expertise of the teachers of Modern Hebrew at Immanuel College. The results show how enthusiastically they communicate their love of their subject to their pupils.&rdquo;</p>','description text','keyword1, keyword2',1244674800,2,1),(37,'time-to-crack-the-code','Time to \'Crack the Code\'',1247267282,1247334118,'<p>The Immanuel College Science department hosted Year 5 of the Independent Jewish Day School to a &lsquo;crack the code&rsquo; Science morning. In the Biology lab, the pupils used our powerful microscopes to look at tiny pond life and discover the difference between hair colour types and in the Chemistry lab, pupils were able to make use of a selection of chemicals to test acidity and produce gases. The Physics experiments challenged the pupils with optics and measurement puzzles. All activities generated letters to a password and in the Physics lab, the password unlocked the computer.</p>\r\n<p>We would like to thank the Lower 6th Scientists for their help in making the event so successful.</p>','description text','keyword1, keyword2',1244502000,2,1),(38,'sports-day-successes','Sports Day Successes',1247267366,1247267428,'<p>Sports Day this year took place on Thursday 4th June at Barnet Copthall Stadium. All pupils in Years 7-10 had the chance to compete in various sports, including: relay, high jump, long jump, triple jump, shot put, javelin and 100m, 200m, 400m, and 800m races.</p>\r\n<p>Final individual scores from Sports Day were:</p>\r\n<p>Yr 7 - 	Jack Reece                	(64 points),	Darcy Tarn                 	(30 points)</p>\r\n<p>Yr 8 - 	Zachary Collins           	(58 points),	Tanya Abrahams          	(56 points)</p>\r\n<p>Yr 9 - 	Jonathan Gaon          	        (42 points),	Jennifer Moses             	(53 points)</p>\r\n<p>Yr 10 - Yoav Kestenbaum     	        (49 points),	Jennifer Murad             	(46 points)</p>\r\n<p>&nbsp;</p>\r\n<p>House Winners for each year group were:</p>\r\n<p>Yr 7 - 	Nahal	   (329 points)</p>\r\n<p>Yr 8 - 	Modi&rsquo;in	   (258 points)</p>\r\n<p>Yr 9 - 	Golani	   (256 points)</p>\r\n<p>Yr 10 - Modi&rsquo;in	   (255 points)</p>\r\n<p>&nbsp;</p>\r\n<p>Overall House Winner for the day was Nahal, who won with 922 points, only one point in front of Golani.</p>','description text','keyword1, keyword2',1244070000,2,1),(39,'announcement-of-200910-head-prefect-team','Announcement of 2009/10 Head Prefect Team',1247267519,1247267556,'<p>We are delighted to announce this years Head Prefect Team:</p>\r\n<p>Head Boy: David Gee</p>\r\n<p>Deputy Head Boys: Alexander Seftel and Samuel Kennard</p>\r\n<p>Head Girl: Joanna Tamman</p>\r\n<p>Deputy Head Girls: Natasha Rosenfeld and Hannah Skolnick</p>\r\n<p>We wish them an excellent term of office.</p>','description text','keyword1, keyword2',1242255600,2,1),(40,'rounders-success-for-year-7--8-girls','Rounders Success for Year 7 & 8 Girls',1247267590,1247331655,'<p>The Immanuel College Girls&rsquo; Rounders Club has thrived this year, with as many as 45 girls attending lunchtime practices. Earlier this week, girls from Years 7 and 8 participated in the annual Maccabi Rounders Tournament, held at the JFS School. Immanuel&rsquo;s Year 8 team, captained by Katy David, took third place. The Year 7 team won all but one of their games and were placed joint first with Yavneh College. Congratulations are due to all our players, especially to Chloe Gordon, Emily Balsam and Deborah Eder, on being designated outstanding players by the members of the teams of the other schools taking part.</p>','description text','keyword1, keyword2',1242169200,2,1),(41,'immanuel-college-celebrates-its-18th-birthday','Immanuel College Celebrates Its 18th Birthday',1247267690,1247422648,'<p>On Thurday 7th May, Immanuel College celebrated its 18th Birthday with a Gala Dinner at St. John&rsquo;s Wood Synagogue. The guest speakers were The Chief Rabbi, Sir Jonathan Sacks, Lady Amile Jakobovits, and Dr. Rafael Beyar, Director of the Rambam Hospital, Haifa.</p>\r\n<p>The Dinner celebrated the achievements of Immanuel College since it opened in 1991 with 40 pupils. Among the 200 plus guests were communal leaders who had helped to make Harav Lord Jakobovits&rsquo; vision a reality, the first two head teachers of the College, Denis Felsenstein and Myrna Jacobs, and parents of current and past pupils. Almost &pound;200,000 was raised at the Gala Dinner towards the building of a new eight-classroom block to replace the unsightly portakabins installed at the College in recent years to accommodate the expansion of the school roll to over 490 pupils. Canvassing for the project in the weeks leading to the Dinner had raised a further &pound;350,000. With &pound;700,000 now raised, work on the building will begin later this year.</p>\r\n<p>The Chief Rabbi said that Immanuel College had &ldquo;achieved everything that Lord Jakobovits, the school&rsquo;s founder, had wanted to achieve.&rdquo; He praised the College&rsquo;s integrated curriculum which ensured that Jewish and secular learning enriched one another at &ldquo;this model school.&rdquo; He commended the staff and governors for creating a hugely successful, top-ranking school that the entire community is proud of and thanked them for providing pupils, including his daughter, Gila, with the direction and support needed for success in adult life. He recalled his friendship whilst an undergraduate with the current Head Master, Philip Skelker and spoke warmly of his insight into children and his ability to ensure that they reached their potential, qualities which are reflected in Immanuel College&rsquo;s position in the top 3% of all secondary schools in terms of pupils&rsquo; admission to the leading 13 UK universities.</p>\r\n<p>Lady Jakobovits, spoke with great affection for the school &ndash; &ldquo;Immanuel College is a bijoux school &ndash; a real gem of our community and, indeed, an example for schools across the globe. It is with huge emotion, that I recall the very evening in my house, 18 years ago, when my husband and a small group of people, dreamt up the idea of a Jewish &lsquo;Eton&rsquo; so that Jewish children would have the same opportunities as their non-Jewish counterparts. By the end of the evening, although many in the room though the idea was crazy, my husband decided to call &ldquo;The Jewish Chronicle&rdquo; and announce the inception of this new school! With the grace and help of Hashem, Immanuel College has grown and thrived, and is a huge success. There could be no greater tribute to my husband and what he wanted to give back to the community that had grown and educated him than Immanuel College.&rdquo;</p>\r\n<p>Dr. Rafael Beyar, General Director of the Rambam Hospital in Haifa, was the last speaker of the evening. The Rambam Hospital is the pupils&rsquo; chosen Israel charity for this academic year and, accordingly, the Dinner Committee had decided to allocate some of the funds raised during the evening to the Rambam which is the leading medical centre in the North of Israel. Dr Beyar expressed delight at Immanuel College&rsquo;s support for the Rambam and presented the College with a history of the hospital&rsquo;s first 70 years.</p>\r\n<p>Members of the Dinner Committee, who worked tirelessly to ensure that the event was an overwhelming success included Michael and Audrey Dangoor, Lynda Dullop (Chair), Annette Koslover, Ruth Basrawy, Sari Eleini, Jacqui Chody, Jane Murad and Sabine Smouha.</p>','description text','keyword1, keyword2',1241650800,2,1),(46,'event-1','Event 1',1247336868,1247348338,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt, ligula ac auctor blandit, lacus diam adipiscing ante, at ultricies dolor sem ac felis. Duis nisl turpis, sodales vitae rutrum vel, vulputate vel massa. Suspendisse sed nisi eu felis condimentum bibendum. Donec suscipit venenatis vehicula. Ut ligula purus, pulvinar ut rutrum ullamcorper, scelerisque vitae purus. Donec in ante ac velit varius sagittis. Morbi dictum semper consequat. Etiam elementum lorem a nibh egestas vitae congue nibh aliquet. Integer at erat mi. Sed sit amet velit id lectus imperdiet laoreet. Nulla sollicitudin tempor urna a tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed ultricies vulputate cursus. Sed vel aliquet orci. Nullam suscipit hendrerit diam a volutpat. Nullam consequat venenatis nunc, in varius metus volutpat ac.</p>\r\n<p>Aliquam vel imperdiet tellus. Ut lacinia venenatis nibh, et pellentesque est varius id. Sed congue, arcu sit amet lacinia mollis, lorem urna interdum nibh, in elementum nunc velit in urna. Aliquam erat volutpat. Nulla mi augue, fermentum id blandit et, rhoncus eget augue. Pellentesque ante mi, blandit malesuada adipiscing eu, placerat dignissim libero. Aenean velit justo, malesuada id feugiat a, rutrum a metus. Proin euismod velit sit amet quam ullamcorper sit amet egestas risus tincidunt. Duis eget ipsum lectus, vitae sagittis libero. Cras eget justo eros, in viverra libero. Etiam quis lorem risus, nec aliquam nisl. Etiam ullamcorper dignissim lacus, non posuere sem convallis at. Integer non leo ut sem hendrerit lobortis. Curabitur ante elit, pretium feugiat ullamcorper sit amet, tincidunt nec nulla. Mauris turpis mauris, vulputate quis fermentum a, sagittis in sem.</p>','event description','keyword1, keyword2',1247353200,3,1),(47,'event-2','Event 2',1247336868,1247348342,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt, ligula ac auctor blandit, lacus diam adipiscing ante, at ultricies dolor sem ac felis. Duis nisl turpis, sodales vitae rutrum vel, vulputate vel massa. Suspendisse sed nisi eu felis condimentum bibendum. Donec suscipit venenatis vehicula. Ut ligula purus, pulvinar ut rutrum ullamcorper, scelerisque vitae purus. Donec in ante ac velit varius sagittis. Morbi dictum semper consequat. Etiam elementum lorem a nibh egestas vitae congue nibh aliquet. Integer at erat mi. Sed sit amet velit id lectus imperdiet laoreet. Nulla sollicitudin tempor urna a tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed ultricies vulputate cursus. Sed vel aliquet orci. Nullam suscipit hendrerit diam a volutpat. Nullam consequat venenatis nunc, in varius metus volutpat ac.</p>\r\n<p>Aliquam vel imperdiet tellus. Ut lacinia venenatis nibh, et pellentesque est varius id. Sed congue, arcu sit amet lacinia mollis, lorem urna interdum nibh, in elementum nunc velit in urna. Aliquam erat volutpat. Nulla mi augue, fermentum id blandit et, rhoncus eget augue. Pellentesque ante mi, blandit malesuada adipiscing eu, placerat dignissim libero. Aenean velit justo, malesuada id feugiat a, rutrum a metus. Proin euismod velit sit amet quam ullamcorper sit amet egestas risus tincidunt. Duis eget ipsum lectus, vitae sagittis libero. Cras eget justo eros, in viverra libero. Etiam quis lorem risus, nec aliquam nisl. Etiam ullamcorper dignissim lacus, non posuere sem convallis at. Integer non leo ut sem hendrerit lobortis. Curabitur ante elit, pretium feugiat ullamcorper sit amet, tincidunt nec nulla. Mauris turpis mauris, vulputate quis fermentum a, sagittis in sem.</p>','event description','keyword1, keyword2',1247266800,3,1),(48,'another-august-event','Another August Event',1247336868,1247423585,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt, ligula ac auctor blandit, lacus diam adipiscing ante, at ultricies dolor sem ac felis. Duis nisl turpis, sodales vitae rutrum vel, vulputate vel massa. Suspendisse sed nisi eu felis condimentum bibendum. Donec suscipit venenatis vehicula. Ut ligula purus, pulvinar ut rutrum ullamcorper, scelerisque vitae purus. Donec in ante ac velit varius sagittis. Morbi dictum semper consequat. Etiam elementum lorem a nibh egestas vitae congue nibh aliquet. Integer at erat mi. Sed sit amet velit id lectus imperdiet laoreet. Nulla sollicitudin tempor urna a tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed ultricies vulputate cursus. Sed vel aliquet orci. Nullam suscipit hendrerit diam a volutpat. Nullam consequat venenatis nunc, in varius metus volutpat ac.</p>\r\n<p>Aliquam vel imperdiet tellus. Ut lacinia venenatis nibh, et pellentesque est varius id. Sed congue, arcu sit amet lacinia mollis, lorem urna interdum nibh, in elementum nunc velit in urna. Aliquam erat volutpat. Nulla mi augue, fermentum id blandit et, rhoncus eget augue. Pellentesque ante mi, blandit malesuada adipiscing eu, placerat dignissim libero. Aenean velit justo, malesuada id feugiat a, rutrum a metus. Proin euismod velit sit amet quam ullamcorper sit amet egestas risus tincidunt. Duis eget ipsum lectus, vitae sagittis libero. Cras eget justo eros, in viverra libero. Etiam quis lorem risus, nec aliquam nisl. Etiam ullamcorper dignissim lacus, non posuere sem convallis at. Integer non leo ut sem hendrerit lobortis. Curabitur ante elit, pretium feugiat ullamcorper sit amet, tincidunt nec nulla. Mauris turpis mauris, vulputate quis fermentum a, sagittis in sem.</p>','event description','keyword1, keyword2',1249945200,3,1),(51,'future-news-story','Future News Story',1247336356,1247336977,'<p>news text</p>','description text','keyword1, keyword2',1278802800,2,0),(52,'new-news-story','New News Story',1247336433,1247337789,'<p>news text</p>','description text','keyword1, keyword2',1152572400,3,0),(54,'august-event','August Event',1247347375,1247348357,'<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin tincidunt, ligula ac auctor blandit, lacus diam adipiscing ante, at ultricies dolor sem ac felis. Duis nisl turpis, sodales vitae rutrum vel, vulputate vel massa. Suspendisse sed nisi eu felis condimentum bibendum. Donec suscipit venenatis vehicula. Ut ligula purus, pulvinar ut rutrum ullamcorper, scelerisque vitae purus. Donec in ante ac velit varius sagittis. Morbi dictum semper consequat. Etiam elementum lorem a nibh egestas vitae congue nibh aliquet. Integer at erat mi. Sed sit amet velit id lectus imperdiet laoreet. Nulla sollicitudin tempor urna a tincidunt. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed ultricies vulputate cursus. Sed vel aliquet orci. Nullam suscipit hendrerit diam a volutpat. Nullam consequat venenatis nunc, in varius metus volutpat ac.</p>\r\n<p>Aliquam vel imperdiet tellus. Ut lacinia venenatis nibh, et pellentesque est varius id. Sed congue, arcu sit amet lacinia mollis, lorem urna interdum nibh, in elementum nunc velit in urna. Aliquam erat volutpat. Nulla mi augue, fermentum id blandit et, rhoncus eget augue. Pellentesque ante mi, blandit malesuada adipiscing eu, placerat dignissim libero. Aenean velit justo, malesuada id feugiat a, rutrum a metus. Proin euismod velit sit amet quam ullamcorper sit amet egestas risus tincidunt. Duis eget ipsum lectus, vitae sagittis libero. Cras eget justo eros, in viverra libero. Etiam quis lorem risus, nec aliquam nisl. Etiam ullamcorper dignissim lacus, non posuere sem convallis at. Integer non leo ut sem hendrerit lobortis. Curabitur ante elit, pretium feugiat ullamcorper sit amet, tincidunt nec nulla. Mauris turpis mauris, vulputate quis fermentum a, sagittis in sem.</p>','description text','keyword1, keyword2',1249945200,3,1),(55,'september-event','September Event',1247347419,1247347488,'<p>news text</p>','description text','keyword1, keyword2',1252450800,3,1),(56,'another-september-event','Another September Event',1247347432,1247347494,'<p>news text</p>','description text','keyword1, keyword2',1252018800,3,1),(57,'october-event','October Event',1247347497,1247347508,'<p>news text</p>','description text','keyword1, keyword2',1254610800,3,1),(58,'another-october-event','Another October Event',1247347519,1247347545,'<p>news text</p>','description text','keyword1, keyword2',1255215600,3,1),(59,'june-event','June Event',1247347582,1247347626,'<p>news text</p>','description text','keyword1, keyword2',1244674800,3,1),(60,'another-june-event','Another June Event',1247347599,1247347611,'<p>news text</p>','description text','keyword1, keyword2',1244674800,3,1),(61,'new-event','New Event',1247360074,1247360091,'<p>news text</p>','description text','keyword1, keyword2',1278889200,3,1),(62,'february-2010-event','February 2010 event',1247360456,1247360716,'<p>news text</p>','description text','keyword1, keyword2',1265932800,3,1),(63,'february-2009-event','February 2009 Event',1247360477,1247360720,'<p>news text</p>','description text','keyword1, keyword2',1234396800,3,1),(65,'new-news-story2','New News Story',1247406937,1247406940,'<p>news text</p>','description text','keyword1, keyword2',1215817200,2,0),(66,'new-news-story3','New News Story',1247406946,1247406949,'<p>news text</p>','description text','keyword1, keyword2',1184194800,2,0);
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,'the-school','The School',1244716036,1247423589,'<p>text about the school</p>','description text','school, college, more keywords',1,0,'<p>no value</p>'),(2,'joining-us','Joining Us',1244716036,1244716036,'text about joining us','description text','school, admissions, etc',0,0,''),(3,'way-of-life','Way Of Life',1244716036,1244716036,'text about way of life','description text','life, school, stuff',0,0,''),(4,'about-the-school','About The School',1244716036,1246807091,'<p>text about about the school</p>','description text','the school, keyword 1, keyword 2',1,1,''),(5,'our-ethos','Our Ethos',1244716036,1246807140,'<p>text about our ethos</p>','description text','keyword 1, keyword 2, keyword 3',1,1,''),(6,'the-immanuel-curriculum','The Immanuel Curriculum',1244716036,1246871431,'<p>text about the immanuel curriculum</p>','description text','keyword 1, keyword 2, keyword 3',1,1,''),(7,'the-sixth-form','The Sixth Form',1244716036,1246871518,'<p>text about the sixth form</p>','description text','keyword 1, keyword 3, keyword 3,',1,1,''),(8,'alumni','Alumni',1244716036,1246871532,'<p>text about alumni</p>','description text','keyword 1, keyword 2, keyword 3',1,1,''),(9,'open-day','Open Day',1244716036,1246566851,'<p>text about open day</p>','description text','keyword 1, keyword 2, keyword 3',1,2,''),(10,'entrance-requirements','Entrance Requirements',1244716036,1246628161,'<p>text about entrance requirements</p>','description text','keyword 1, keyword 2 keyword 3',1,2,''),(11,'admissions','Admissions',1244716036,1246628168,'<p>text about admissions</p>','description text','keyword 2, keyword 2, keyword 3',1,2,''),(12,'fees','Fees',1244716036,1246628174,'<p>text about fees</p>','description text','keyword 1, keyword 2, keyword 3',1,2,''),(13,'application-forms','Application Forms',1244716036,1246628180,'<p>text about application forms</p>','description text','keyword 1, keyword 2, keyword 3',1,2,''),(14,'staff','Staff',1244716036,1246628186,'<p>text about staff</p>','description text','keyword 1, keyword 2, keyword 3',1,2,''),(15,'nurturing-our-pupils','Nurturing Our Pupils',1244716036,1246628204,'<p>text about nurturing pupils</p>','description text','keyword 1, keyword 2, keyword 3',1,3,''),(16,'jewish-life-and-learning','Jewish Life And Learning',1244716036,1246628211,'<p>text about jewish life and learning</p>','description text','keyword 1, keyword 2, keyword 3',1,3,''),(17,'extra-curricular-activities','Extra Curricular Activities',1244716036,1246628220,'<p>text about extra curricular activities</p>','description text','keyword 1, keyword 2, keyword 3',1,3,''),(18,'ethos','Ethos',1245168145,1246628242,'<p>text about ethos</p>','description text','keyword 1, keyword 2, keyword 3',1,4,''),(19,'history-about-the-founder','History - About The Founder',1245168145,1246960859,'<p>text about the founder</p><p>&nbsp;</p>','description text','keyword 1, keyword 2, keyword 3, keyword 4',1,4,''),(20,'isc-inspection','ISC Inspection',1245168145,1246628255,'<p>text about isc inspection</p>','description text','keyword 1, keyword 2, keyword 3',1,4,''),(21,'senior-management-teams','Senior Management Teams',1245168145,1247423658,'<p>text about senior management team</p>','description text','keyword 1, keyword 2, keyword 3',1,4,'<p>intro to smt</p>'),(22,'governers','Governers',1245168145,1246628268,'<p>text about governers</p>','description text','keyword 1, keyword 2, keyword 3',1,4,''),(23,'psa','PSA',1245168145,1246628276,'<p>text about PSA</p>','description text','keyword 1, keyword 2',1,4,''),(24,'school-policies','School Policies',1245168145,1247068340,'<p>text about School Policies</p>','description text','keyword 1, keyword 2',1,4,'<p>School Policies Intro</p>'),(25,'gallery','Gallery',1246875704,1246875704,'Gallery Text','description text','keyword 1, keyword 2',1,0,'empty'),(27,'prospective-students','Prospective Students',1247826754,1248090489,'<p>text</p>','description','keywords',1,0,'<p>introduction</p>'),(28,'current','Current Students',1247826754,1247826754,'text','description','keywords',1,0,'introduction'),(29,'staff2','Staff',1247826754,1247842403,'<p>text\'s</p>','description','keywordsasas',1,0,'<p>introduction\'s</p>');
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `suggested_links`
--

DROP TABLE IF EXISTS `suggested_links`;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
CREATE TABLE `suggested_links` (
  `id` int(5) NOT NULL auto_increment,
  `href` varchar(255) default NULL,
  `page_id` int(5) default NULL,
  `position` int(3) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
SET character_set_client = @saved_cs_client;

--
-- Dumping data for table `suggested_links`
--

LOCK TABLES `suggested_links` WRITE;
/*!40000 ALTER TABLE `suggested_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `suggested_links` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2009-07-20 18:54:34
