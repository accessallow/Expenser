-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2016 at 05:57 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `expenser`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE IF NOT EXISTS `chapter` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`id`, `user`, `name`) VALUES
(1, 'user1', 'chapter1'),
(2, 'user1', 'chapter1'),
(3, 'user1', 'chapter1'),
(4, 'user1', 'chapter1'),
(5, NULL, 'Pankaj'),
(6, NULL, 'Bingo'),
(8, 'pankaj', 'Linux Releted'),
(9, 'pankaj', 'Hadoop'),
(13, 'pankaj', 'Web Development'),
(12, 'adam', 'General'),
(14, 'pankaj', 'SQL'),
(15, 'pankaj', 'Spring'),
(16, 'pankaj', 'Hadoop IP''s'),
(17, 'pankaj', 'Vim Configuration'),
(18, 'pankaj', 'Programmer Spirit'),
(19, 'pankaj', 'Jenkins'),
(20, 'pankaj', 'CV'),
(21, 'pankaj', 'ExtJS'),
(22, 'pankaj', 'Android'),
(23, 'pankaj', 'Javascript');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('5893c0b6f16bb1fb040c4302cd3b8b19', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', 1463819022, ''),
('ed4641488a23587f6e90531eec7abd7b', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', 1463848607, ''),
('d49a65b2154b3a42567284682a2f2db8', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', 1463284901, 'a:4:{s:9:"user_data";s:0:"";s:8:"username";s:6:"pankaj";s:7:"user_id";s:1:"1";s:5:"login";b:1;}'),
('c376d952870739fa6ef4459a9b09dd44', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.102 Safari/537.36', 1463322690, 'a:4:{s:9:"user_data";s:0:"";s:8:"username";s:6:"pankaj";s:7:"user_id";s:1:"1";s:5:"login";b:1;}'),
('b31328f24441b43a669271496f5cf39f', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', 1462812412, ''),
('707a3d6d6e8802f27b30fb1f2fbda274', '::1', 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.94 Safari/537.36', 1462812382, 'a:4:{s:9:"user_data";s:0:"";s:8:"username";s:6:"pankaj";s:7:"user_id";s:1:"1";s:5:"login";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `comment` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `user` varchar(20) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=149 ;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `amount`, `comment`, `date`, `user`, `tag`) VALUES
(8, 15, 'auto', '0000-00-00', 'pankaj', 1009),
(6, 15, 'Auto', '0000-00-00', 'pankaj', 1009),
(7, 7, 'Tea', '0000-00-00', 'pankaj', 1007),
(9, 17, 'horlicks', '0000-00-00', 'pankaj', 1007),
(10, 10, 'bhutta', '0000-00-00', 'pankaj', 1007),
(11, 15, 'Auto', '0000-00-00', 'pankaj', 1009),
(12, 15, 'auto', '0000-00-00', 'pankaj', 1009),
(13, 45, 'noodles', '0000-00-00', 'pankaj', 1007),
(14, 17, 'horlicks', '0000-00-00', 'pankaj', 1007),
(15, 15, 'auto', '0000-00-00', 'pankaj', 1009),
(16, 20, 'Halua', '0000-00-00', 'pankaj', 1007),
(17, 7, 'Tea', '0000-00-00', 'pankaj', 1008),
(18, 20, 'Auto __arti', '0000-00-00', 'pankaj', 1009),
(19, 30, 'paratha', '0000-00-00', 'pankaj', 1007),
(20, 15, 'paan', '0000-00-00', 'pankaj', 1007),
(21, 30, 'Auto du', '0000-00-00', 'pankaj', 1009),
(22, 510, 'balance', '0000-00-00', 'pankaj', 1012),
(23, 50, 'Soap', '0000-00-00', 'pankaj', 1011),
(24, 10, 'auto', '0000-00-00', 'pankaj', 1009),
(25, 30, 'auto', '0000-00-00', 'pankaj', 1009),
(26, 35, 'scissor, comb', '0000-00-00', 'pankaj', 1010),
(27, 7, 'tea', '0000-00-00', 'pankaj', 1007),
(28, 30, 'snacks', '0000-00-00', 'pankaj', 1007),
(29, 20, 'notebook', '0000-00-00', 'pankaj', 1010),
(30, 30, 'auto', '0000-00-00', 'pankaj', 1009),
(31, 7, 'Tea', '0000-00-00', 'pankaj', 1007),
(32, 30, 'snacks', '0000-00-00', 'pankaj', 1007),
(33, 30, 'Auto', '0000-00-00', 'pankaj', 1009),
(34, 55, 'poha upma dabeli', '0000-00-00', 'pankaj', 1007),
(35, 30, 'Auto', '0000-00-00', 'pankaj', 1009),
(36, 78, 'Food', '0000-00-00', 'pankaj', 1007),
(37, 7, 'tea', '0000-00-00', 'pankaj', 1007),
(38, 17, 'appy', '0000-00-00', 'pankaj', 1007),
(39, 100, 'auto', '0000-00-00', 'pankaj', 1009),
(40, 152, 'Food,Tea,Corn', '0000-00-00', 'pankaj', 1007),
(41, 45, 'Auto', '0000-00-00', 'pankaj', 1009),
(42, 31, 'Medicine', '0000-00-00', 'pankaj', 1008),
(43, 12, 'Creamroll', '0000-00-00', 'pankaj', 1007),
(44, 20, 'Bhutta', '0000-00-00', 'pankaj', 1007),
(45, 50, 'Dinner', '0000-00-00', 'pankaj', 1007),
(46, 30, 'auto', '0000-00-00', 'pankaj', 1009),
(47, 42, 'Medicine', '0000-00-00', 'pankaj', 1008),
(48, 100, 'Food', '0000-00-00', 'pankaj', 1007),
(49, 92, 'Food', '0000-00-00', 'pankaj', 1007),
(50, 30, 'Auto', '0000-00-00', 'pankaj', 1009),
(51, 17, 'Breakfast', '0000-00-00', 'pankaj', 1007),
(52, 50, 'Dabeli Pepsi', '0000-00-00', 'pankaj', 1007),
(53, 36, 'Khichdi', '0000-00-00', 'pankaj', 1007),
(54, 100, 'Auto', '0000-00-00', 'pankaj', 1009),
(55, 30, 'auto', '2015-10-28', 'pankaj', 1009),
(56, 43, 'Lunch', '2015-10-28', 'pankaj', 1007),
(57, 80, 'full thali', '2015-10-28', 'pankaj', 1007),
(58, 20, 'icecream', '2015-10-28', 'pankaj', 1007),
(59, 30, 'auto', '2015-10-29', 'pankaj', 1009),
(60, 30, 'Auto', '2015-10-30', 'pankaj', 1009),
(61, 20, 'Breakfast', '2015-10-30', 'pankaj', 1007),
(62, 40, 'Raw Snacks', '2015-10-29', 'pankaj', 1007),
(63, 28, 'Lunch', '2015-10-30', 'pankaj', 1007),
(64, 80, 'dinner', '2015-10-30', 'pankaj', 1007),
(65, 15, 'appy', '2015-10-30', 'pankaj', 1000),
(66, 24, 'coffey', '2015-10-30', 'pankaj', 1007),
(67, 20, 'Milk', '2015-11-01', 'pankaj', 1007),
(68, 400, 'water purifier', '2015-11-01', 'pankaj', 1008),
(69, 20, 'Milk', '2015-11-01', 'pankaj', 1007),
(70, 80, 'dinner', '2015-11-01', 'pankaj', 1007),
(71, 30, 'auto', '2015-11-02', 'pankaj', 1009),
(72, 35, 'sprouts', '2015-11-02', 'pankaj', 1007),
(73, 30, 'auto', '2015-11-04', 'pankaj', 1009),
(74, 30, 'snacks and juice', '2015-11-03', 'pankaj', 1007),
(75, 35, 'Lunch', '2015-11-03', 'pankaj', 1007),
(76, 20, 'Sweets', '2015-11-03', 'pankaj', 1007),
(77, 10, 'Breakfast', '2015-11-04', 'pankaj', 1007),
(78, 30, 'auto', '2015-11-03', 'pankaj', 1009),
(79, 1000, 'du', '2015-11-04', 'pankaj', 1009),
(80, 50, 'Lunch + Juice', '2015-11-04', 'pankaj', 1007),
(81, 10, 'pj milk', '2015-11-05', 'yuvi', 1015),
(82, 30, 'Auto', '2015-11-05', 'pankaj', 1007),
(83, 45, 'Lunch fruit sprouts', '2015-11-05', 'pankaj', 1007),
(84, 30, 'Auto', '2015-11-06', 'pankaj', 1009),
(85, 7, 'Tea', '2015-11-06', 'pankaj', 1007),
(86, 17, 'poha chai', '2015-11-05', 'pankaj', 1007),
(87, 45, 'Lunch', '2015-11-17', 'pankaj', 1007),
(88, 30, 'Auto', '2015-11-17', 'pankaj', 1009),
(89, 10, 'poha', '2015-11-17', 'pankaj', 1007),
(90, 21, 'Tea', '2015-11-17', 'pankaj', 1007),
(91, 70, 'Dinner', '2015-11-17', 'pankaj', 1007),
(92, 30, 'Auto', '2015-11-18', 'pankaj', 1009),
(93, 10, 'Breakfast', '2015-11-18', 'pankaj', 1007),
(94, 47, 'Lunch', '2015-11-18', 'pankaj', 1007),
(95, 30, 'Auto', '2015-11-24', 'pankaj', 1009),
(96, 40, 'lunch', '2015-11-24', 'pankaj', 1007),
(97, 30, 'Breakfast', '2015-11-24', 'pankaj', 1007),
(98, 30, 'Auto', '2015-11-25', 'pankaj', 1009),
(99, 15, 'colddrink', '2015-11-25', 'pankaj', 1007),
(100, 45, 'Dinner', '2015-11-24', 'pankaj', 1007),
(101, 80, 'vegetables', '2015-11-24', 'pankaj', 1007),
(102, 32, 'sandwhich', '2015-11-25', 'pankaj', 1007),
(103, 20, 'Grape Juice', '2015-12-21', 'pankaj', 1017),
(104, 65, '2 Corn Sandwitches', '2015-12-21', 'pankaj', 1007),
(105, 30, 'Travel', '2015-12-22', 'pankaj', 1009),
(106, 32, 'sandwhich', '2015-12-22', 'pankaj', 1007),
(107, 20, 'Bourvitas', '2015-12-22', 'pankaj', 1007),
(108, 125, 'Gifts', '2015-12-22', 'pankaj', 1000),
(109, 32, 'Corn sandwitches', '2015-12-21', 'pankaj', 1007),
(110, 30, 'Auto', '2015-12-23', 'pankaj', 1009),
(111, 20, 'Upma breakfast', '2015-12-23', 'pankaj', 1007),
(112, 30, 'Auto', '2015-12-24', 'pankaj', 1009),
(113, 25, 'Orange Juice', '2015-12-24', 'pankaj', 1017),
(114, 20, 'Poha', '2015-12-24', 'pankaj', 1007),
(115, 8, 'Tea', '2015-12-24', 'pankaj', 1007),
(116, 40, 'Dinner', '2015-12-23', 'pankaj', 1007),
(117, 30, 'Tea Coffee', '2016-02-22', 'pankaj', 1007),
(118, 50, 'Lunch', '2016-02-22', 'pankaj', 1007),
(119, 30, 'Auto', '2016-02-22', 'pankaj', 1009),
(120, 20, 'Juice', '2016-04-02', 'pankaj', 1007),
(121, 35, 'Breakfast', '2016-04-03', 'pankaj', 1007),
(122, 20, 'Juice', '2016-04-03', 'pankaj', 1017),
(146, 80, 'Dinner', '2016-04-03', 'pankaj', 1007),
(126, 50, 'Medicines', '2016-03-15', 'pankaj', 1008),
(127, 20, 'Juice', '2016-03-15', 'pankaj', 1007),
(128, 78, 'tea', '2016-03-08', 'pankaj', 1007),
(129, 67, 'jug', '2016-02-29', 'pankaj', 1017),
(130, 3, 'Dinner', '2016-02-29', 'pankaj', 1007),
(148, 10, 'Butter Milk', '2016-04-09', 'pankaj', 1018);

-- --------------------------------------------------------

--
-- Table structure for table `linklogs`
--

CREATE TABLE IF NOT EXISTS `linklogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(200) NOT NULL,
  `info` varchar(200) NOT NULL,
  `user` varchar(30) NOT NULL,
  `chapter_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `index_foreignkey_linklogs_chapter` (`chapter_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `linklogs`
--

INSERT INTO `linklogs` (`id`, `link`, `info`, `user`, `chapter_id`) VALUES
(9, 'http://stackoverflow.com/questions/15035778/hadoop-m-r-to-implement-people-you-might-know-friendship-recommendation', 'Hadoop M/R to implement “People You Might Know” friendship recommendation', 'pankaj', 9),
(6, 'http://localhost/Expenser/index.php/Logger#', 'Logger Entries', 'adam', 12),
(7, 'http://localhost/Expenser/index.php/Logger#', 'Logger entry', 'adam', 12),
(8, 'http://localhost/Expenser/index.php/Logger#', 'avc', 'adam', 12),
(10, 'http://blog.eviac.net/2014/11/mapreduce-features-custom-data-types.html', 'Map reduce Features Custom Datatypes', 'pankaj', 9),
(11, 'http://www.mkyong.com/tutorials/spring-tutorials/', 'Mkyong Spring Totorials', 'pankaj', 15),
(12, 'http://www.mkyong.com/spring/quick-start-maven-spring-example/', 'Maven Spring Quickstart', 'pankaj', 15),
(13, 'https://mysite.knowmax.ultimatix.net/personal/forms_tcsknowmax_124637/Documents/Shared%20with%20Everyone/Hadoop%20in%20Practice-1.pdf#search=hadoop', 'Book : Hadoop in Practice', 'pankaj', 9),
(14, 'http://185.27.134.10/sql.php?db=b31_16654388_expenser&table=users&token=da6a7e7e04c3e8dee2b4ddf84ad8c148', 'PHP MyAdmin Remote', 'pankaj', 13),
(15, 'http://10.136.26.169:50030/', 'Job Tracker (Administration)', 'pankaj', 16),
(16, 'http://10.136.26.169:50070/dfshealth.jsp', 'Namenode', 'pankaj', 16),
(17, 'http://10.136.26.169:50060/tasktracker.jsp', 'Task Tracker', 'pankaj', 16),
(18, 'http://10.136.26.169:50090/status.jsp', 'Secondary Namenode', 'pankaj', 16),
(19, 'https://realpython.com/blog/python/vim-and-python-a-match-made-in-heaven/#.Vi99VN1oCdM.facebook', 'Vim and Python : A match made in heaven', 'pankaj', 17),
(20, 'https://www.digitalocean.com/community/tutorials/how-to-install-and-secure-phpmyadmin-on-a-centos-6-4-vps', 'How To Install and Secure phpMyAdmin on a CentOS 6.4 VPS', 'pankaj', 8),
(21, 'http://stackoverflow.com/questions/5915534/accessing-a-mysql-database-from-external-host-ip-ie-mysql-workbench', 'MySQL Permission Issue', 'pankaj', 8),
(22, 'http://stackoverflow.com/questions/20315862/hadoop-jar-jobtracker-is-in-safe-mode', 'Hadoop JAR: “JobTracker is in safe mode”', 'pankaj', 9),
(23, 'http://www.epubbud.com/read.php?g=MURGMDDC&p=2', 'Coders at work', 'pankaj', 18),
(24, 'https://www.youtube.com/watch?v=US8PwyOzwmE', 'Jenkins setup with maven project', 'pankaj', 19),
(25, 'http://code.tutsplus.com/tutorials/the-ins-and-outs-of-gradle--cms-22978', 'In and out of Gradle', 'pankaj', 19),
(26, 'https://www.youtube.com/watch?v=Wnt3epUBrZk', 'dino james', 'pankaj', 8),
(27, 'http://stackoverflow.com/questions/33372938/ios-code-signing-fails-only-for-jenkins', 'iOS Code Signing Fails Only For Jenkins', 'pankaj', 19),
(28, 'https://issues.jenkins-ci.org/browse/JENKINS-28130', 'Jenkins Clang Workaround', 'pankaj', 19),
(29, 'https://wiki.jenkins-ci.org/display/JENKINS/Keychains+and+Provisioning+Profiles+Plugin', 'Jenkins Keychain ', 'pankaj', 19),
(30, 'http://cvmkr.com/fL0q', 'online cv', 'pankaj', 20),
(31, 'http://blog.octo.com/en/jenkins-quality-dashboard-ios-development/', 'iOS dev: How to setup quality metrics on your Jenkins job?', 'pankaj', 19),
(32, 'http://stackoverflow.com/questions/10568480/application-init-method-as-advertised-in-the-docs', 'ExtJS Application', 'pankaj', 21),
(33, 'https://www.sencha.com/forum/showthread.php?179216-MVC-amp-amp-Ext.app.Application.init()', 'ExtJS init example', 'pankaj', 21),
(34, 'http://stackoverflow.com/questions/1965784/streaming-audio-from-a-url-in-android-using-mediaplayer', 'Streaming Audio from A URL in Android using MediaPlayer?', 'pankaj', 22),
(35, 'http://developer.android.com/training/basics/firstapp/starting-activity.html', 'Adding Intent', 'pankaj', 22),
(36, 'Android ListView with onClick items', 'Android list view onClick', 'pankaj', 22),
(37, 'http://stackoverflow.com/questions/8166497/custom-adapter-for-list-view', 'Custom adapter for listView', 'pankaj', 22),
(38, 'http://pastebin.com/6xyY83QZ', 'NoSleep Java code', 'pankaj', 13),
(39, 'http://javascriptissexy.com/', 'Javascript is sexy', 'pankaj', 23),
(40, 'http://www.instructables.com/', 'Instructables', 'pankaj', 13),
(41, 'https://github.com/probonogeek/extjs', 'ExtJS 4.x.x', 'pankaj', 21),
(42, 'https://github.com/bjornharrtell/extjs', 'ExtJS 5.x.x', 'pankaj', 21),
(43, 'http://examples.extjs.eu/', 'Sushil''s EXTJS Examples', 'pankaj', 21),
(44, 'http://blog.ashwani.co.in/blog/2013-07-28/connect-and-access-sharepoint-webservice-from-java/', 'Connect and Access Sharepoint Webservice From Java', 'pankaj', 13),
(45, 'http://docs.nativescript.org/start/getting-started', 'Native Script', 'pankaj', 13);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE IF NOT EXISTS `product_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_category_name` varchar(20) NOT NULL,
  `user` varchar(20) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1019 ;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `product_category_name`, `user`, `tag`) VALUES
(1000, 'uncategorized', 'pankaj', 1),
(1007, 'Food', 'pankaj', 1),
(1008, 'Health', 'pankaj', 1),
(1009, 'Travel', 'pankaj', 1),
(1010, 'Stationary', 'pankaj', 1),
(1011, 'Daily use', 'pankaj', 1),
(1012, 'Mobile', 'pankaj', 1),
(1013, 'travel', 'yuvi', 1),
(1014, 'food', 'yuvi', 1),
(1015, 'Borrow', 'yuvi', 1),
(1016, 'sample', 'pankaj', 1),
(1017, 'Juice', 'pankaj', 1),
(1018, 'Softdrink', 'pankaj', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shortcuts`
--

CREATE TABLE IF NOT EXISTS `shortcuts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` int(11) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `user` varchar(50) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `shortcuts`
--

INSERT INTO `shortcuts` (`id`, `amount`, `comment`, `user`, `tag`) VALUES
(20, 25, 'Orange Juice X', 'pankaj', 1017),
(21, 80, 'Dinner', 'pankaj', 1007),
(22, 500, 'party', 'pankaj', 1007),
(23, 32, 'Pepsi', 'pankaj', 1018),
(24, 15, 'Appy Fiz', 'pankaj', 1018),
(25, 40, 'Coke', 'pankaj', 1018),
(26, 10, 'Butter Milk', 'pankaj', 1018),
(27, 15, 'Auto', 'pankaj', 1009);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'pankaj', '12345'),
(2, 'demo', 'demo'),
(3, 'yuvi', 'yuvi');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
