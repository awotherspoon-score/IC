/*
MySQL Data Transfer
Source Host: localhost
Source Database: immanuel
Target Host: localhost
Target Database: immanuel
Date: 17/06/2009 17:02:12
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for albums
-- ----------------------------
DROP TABLE IF EXISTS `albums`;
CREATE TABLE `albums` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `datecreated` int(11) NOT NULL,
  `datemodified` int(11) NOT NULL,
  `newsid` int(5) NOT NULL,
  `eventid` int(5) NOT NULL,
  `datedisplayed` int(11) NOT NULL,
  `featuredimageid` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for newsevents
-- ----------------------------
DROP TABLE IF EXISTS `newsevents`;
CREATE TABLE `newsevents` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(5) unsigned NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `datecreated` int(11) NOT NULL,
  `datemodified` int(11) NOT NULL,
  `text` text NOT NULL,
  `description` text NOT NULL,
  `keywords` text NOT NULL,
  `status` int(5) unsigned NOT NULL,
  `parentid` int(5) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `pages` VALUES ('1', 'the-school', 'the school', '1244716036', '1244716036', 'text about the school', 'text about text about the school', 'school, college, more keywords', '0', '0');
INSERT INTO `pages` VALUES ('2', 'joining-us', 'Joining Us', '1244716036', '1244716036', 'text about joining us', 'text about text about joining us', 'school, admissions, etc', '0', '0');
INSERT INTO `pages` VALUES ('3', 'way-of-life', 'Way Of Life', '1244716036', '1244716036', 'text about way of life', 'text about text about way of life', 'life, school, stuff', '0', '0');
INSERT INTO `pages` VALUES ('4', 'about-the-school', 'About The School', '1244716036', '1244716036', 'text about about the school', 'description text', 'the school, keyword 1, keyword 2', '0', '1');
INSERT INTO `pages` VALUES ('5', 'our-ethos', 'Our Ethos', '1244716036', '1244716036', 'text about our ethos', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '1');
INSERT INTO `pages` VALUES ('6', 'the-immanuel-curriculum', 'The Immanuel Curriculum', '1244716036', '1244716036', 'text about the immanuel curriculum', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '1');
INSERT INTO `pages` VALUES ('7', 'the-sixth-form', 'The Sixth Form', '1244716036', '1244716036', 'text about the sixth form', 'description text', 'keyword 1, keyword 3, keyword 3,', '0', '1');
INSERT INTO `pages` VALUES ('8', 'alumni', 'Alumni', '1244716036', '1244716036', 'text about alumni', 'descrption text', 'keyword 1, keyword 2, keyword 3', '0', '1');
INSERT INTO `pages` VALUES ('9', 'open-day', 'Open Day', '1244716036', '1244716036', 'text about open day', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '2');
INSERT INTO `pages` VALUES ('10', 'entrance-requirements', 'Entrance Requirements', '1244716036', '1244716036', 'text about entrance requirements', 'description text', 'keyword 1, keyword 2 keyword 3', '0', '2');
INSERT INTO `pages` VALUES ('11', 'admissions', 'Admissions', '1244716036', '1244716036', 'text about admissions', 'descriptiont text', 'keyword 2, keyword 2, keyword 3', '0', '2');
INSERT INTO `pages` VALUES ('12', 'fees', 'Fees', '1244716036', '1244716036', 'text about fees', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '2');
INSERT INTO `pages` VALUES ('13', 'application-forms', 'Application Forms', '1244716036', '1244716036', 'text about application forms', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '2');
INSERT INTO `pages` VALUES ('14', 'staff', 'Staff', '1244716036', '1244716036', 'text about staff', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '2');
INSERT INTO `pages` VALUES ('15', 'nurturing-our-pupils', 'Nurturing Our Pupils', '1244716036', '1244716036', 'text about nurturing pupils', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '3');
INSERT INTO `pages` VALUES ('16', 'jewish-life-and-learning', 'Jewish Life And Learning', '1244716036', '1244716036', 'text about jewish life and learning', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '3');
INSERT INTO `pages` VALUES ('17', 'extra-curricular-activities', 'Extra Curricular Activities', '1244716036', '1244716036', 'text about extra curricular activities', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '3');
INSERT INTO `pages` VALUES ('18', 'ethos', 'ethos', '1245168145', '1245168145', 'text about ethos', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '4');
INSERT INTO `pages` VALUES ('19', 'history-about-the-founder', 'History - About The Founder', '1245168145', '1245168145', 'text about the founder', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '4');
INSERT INTO `pages` VALUES ('20', 'isc-inspection', 'ISC Inspection', '1245168145', '1245168145', 'text about isc inspection', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '4');
INSERT INTO `pages` VALUES ('21', 'senior-management-team', 'Senior Management Team', '1245168145', '1245168145', 'text about senior management team', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '4');
INSERT INTO `pages` VALUES ('22', 'governers', 'Governers', '1245168145', '1245168145', 'text about governers', 'description text', 'keyword 1, keyword 2, keyword 3', '0', '4');
INSERT INTO `pages` VALUES ('23', 'psa', 'PSA', '1245168145', '1245168145', 'text about PSA', 'description text', 'keyword 1, keyword 2', '0', '4');
INSERT INTO `pages` VALUES ('24', 'school-policies', 'School Policies', '1245168145', '1245168145', 'text about School Policies', 'description text', 'keyword 1, keyword 2', '0', '4');
