SET NAMES latin1;
SET FOREIGN_KEY_CHECKS = 0;

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

insert into `pages` values('1','the-school','the school','1244716036','1244716036','text about the school','text about text about the school','school, college, more keywords','0','0',''),
 ('2','joining-us','Joining Us','1244716036','1244716036','text about joining us','text about text about joining us','school, admissions, etc','0','0',''),
 ('3','way-of-life','Way Of Life','1244716036','1244716036','text about way of life','text about text about way of life','life, school, stuff','0','0',''),
 ('4','about-the-school','About The School','1244716036','1244716036','text about about the school','description text','the school, keyword 1, keyword 2','0','1',''),
 ('5','our-ethos','Our Ethos','1244716036','1245596139','<p>text about our ethos</p>','description text','keyword 1, keyword 2, keyword 3','0','1',''),
 ('6','the-immanuel-curriculum','The Immanuel Curriculum','1244716036','1245596801','<p>text about the immanuel curriculum</p>','description text','keyword 1, keyword 2, keyword 3','0','1',''),
 ('7','the-sixth-form','The Sixth Form','1244716036','1245596152','<p>text about the sixth form</p>','description text','keyword 1, keyword 3, keyword 3,','0','1',''),
 ('8','alumni','Alumni','1244716036','1244716036','text about alumni','descrption text','keyword 1, keyword 2, keyword 3','0','1',''),
 ('9','open-day','Open Day','1244716036','1244716036','text about open day','description text','keyword 1, keyword 2, keyword 3','0','2',''),
 ('10','entrance-requirements','Entrance Requirements','1244716036','1245594647','<p>text about entrance requirements</p>','description text','keyword 1, keyword 2 keyword 3','0','2',''),
 ('11','admissions','Admissions','1244716036','1244716036','text about admissions','descriptiont text','keyword 2, keyword 2, keyword 3','0','2',''),
 ('12','fees','Fees','1244716036','1244716036','text about fees','description text','keyword 1, keyword 2, keyword 3','0','2',''),
 ('13','application-forms','Application Forms','1244716036','1244716036','text about application forms','description text','keyword 1, keyword 2, keyword 3','0','2',''),
 ('14','staff','Staff','1244716036','1244716036','text about staff','description text','keyword 1, keyword 2, keyword 3','0','2',''),
 ('15','nurturing-our-pupils','Nurturing Our Pupils','1244716036','1244716036','text about nurturing pupils','description text','keyword 1, keyword 2, keyword 3','0','3',''),
 ('16','jewish-life-and-learning','Jewish Life And Learning','1244716036','1244716036','text about jewish life and learning','description text','keyword 1, keyword 2, keyword 3','0','3',''),
 ('17','extra-curricular-activities','Extra Curricular Activities','1244716036','1244716036','text about extra curricular activities','description text','keyword 1, keyword 2, keyword 3','0','3',''),
 ('18','ethos','Ethos','1245168145','1245595727','<p>text about ethos</p>','description text','keyword 1, keyword 2, keyword 3','0','4',''),
 ('19','history-about-the-founder','History - About The Founder','1245168145','1245607069','<p>text about the founder</p><p>&nbsp;</p>','description text','keyword 1, keyword 2, keyword 3, keyword 4','0','4',''),
 ('20','isc-inspection','ISC Inspection','1245168145','1245612867','<p>text about isc inspection</p>','description text','keyword 1, keyword 2, keyword 3','0','4',''),
 ('21','senior-management-team','Senior Management Team','1245168145','1245607769','<p>text about senior management team</p>','description text','keyword 1, keyword 2, keyword 3','0','4','<p>intro to smt</p>'),
 ('22','governers','Governers','1245168145','1245607236','<p>text about governers</p>','a lengthy description','keyword 1, keyword 2, keyword 3','0','4',''),
 ('23','psa','PSA','1245168145','1245598460','<p>text about PSA</p>','description text','keyword 1, keyword 2','0','4',''),
 ('24','school-policies','School Policies','1245168145','1245612863','<p>text about School Policies</p>','description text','keyword 1, keyword 2','0','4','');

SET FOREIGN_KEY_CHECKS = 1;
