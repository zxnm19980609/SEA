-- --------------------------------------------------------
-- 主机:                           bdm721868123.my3w.com
-- Server version:               5.7.25-log - Source distribution
-- Server OS:                    Linux
-- HeidiSQL 版本:                  10.1.0.5464
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table bdm721868123_db.group5_answer
DROP TABLE IF EXISTS `group5_answer`;
CREATE TABLE IF NOT EXISTS `group5_answer` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `score` int(11) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_answer: 6 rows
DELETE FROM `group5_answer`;
/*!40000 ALTER TABLE `group5_answer` DISABLE KEYS */;
INSERT INTO `group5_answer` (`aid`, `uid`, `qid`, `score`, `content`) VALUES
	(5, 2, 1, 1, 'A'),
	(6, 2, 2, 1, 'D'),
	(7, 2, 3, 1, 'excuse me'),
	(8, 2, 4, 2, 'i am ok'),
	(9, 2, 18, 1, 'A'),
	(10, 2, 19, NULL, '');
/*!40000 ALTER TABLE `group5_answer` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_comment
DROP TABLE IF EXISTS `group5_comment`;
CREATE TABLE IF NOT EXISTS `group5_comment` (
  `coid` int(11) NOT NULL AUTO_INCREMENT,
  `did` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `tcid` int(11) DEFAULT NULL,
  `cotime` datetime NOT NULL,
  `ccontent` text NOT NULL,
  PRIMARY KEY (`coid`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_comment: 16 rows
DELETE FROM `group5_comment`;
/*!40000 ALTER TABLE `group5_comment` DISABLE KEYS */;
INSERT INTO `group5_comment` (`coid`, `did`, `uid`, `tcid`, `cotime`, `ccontent`) VALUES
	(1, 1, 2, NULL, '2019-10-22 00:00:00', 'So, until now, I don\'t think SRS can do anything useful'),
	(2, 1, 1, 1, '2019-10-23 00:00:00', 'You are not in the state.'),
	(3, 1, 1, NULL, '2019-10-28 00:00:00', '123'),
	(4, 1, 1, NULL, '2019-10-28 00:00:00', 'wen shijie zhen niu bi'),
	(5, 1, 2, NULL, '2019-10-28 00:00:00', 'xht geng niu bi'),
	(6, 1, 1, NULL, '2019-10-29 01:21:19', 'asdasdasdasd'),
	(7, 2, 3, NULL, '2019-10-30 14:15:33', 'wen shijie zhen niu bi'),
	(8, 2, 3, NULL, '2019-10-30 14:15:40', 'xht geng niu bi'),
	(9, 2, 1, NULL, '2019-10-31 01:27:53', 'Shuo sha ne?'),
	(10, 2, 9, NULL, '2019-10-31 02:03:22', 'sdadadas'),
	(11, 4, 1, NULL, '2019-11-07 22:44:34', '12345'),
	(12, 6, 3, NULL, '2019-11-07 22:45:42', '12345'),
	(13, 2, 2, NULL, '2019-11-07 22:58:11', '123456'),
	(14, 2, 1, NULL, '2019-11-13 20:06:45', 'Qwerty'),
	(15, 2, 1, NULL, '2019-11-13 20:26:00', ''),
	(16, 2, 1, NULL, '2019-11-13 20:57:45', 'what is your problem');
/*!40000 ALTER TABLE `group5_comment` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_course
DROP TABLE IF EXISTS `group5_course`;
CREATE TABLE IF NOT EXISTS `group5_course` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cname` text NOT NULL,
  `ctime` text NOT NULL,
  `clocat` text NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_course: 6 rows
DELETE FROM `group5_course`;
/*!40000 ALTER TABLE `group5_course` DISABLE KEYS */;
INSERT INTO `group5_course` (`cid`, `cname`, `ctime`, `clocat`, `uid`) VALUES
	(1, 'software engineer', '[[1573344000000,1573351200000],[1573948800000,1573956000000],[1574553600000,1574560800000]]', 'Yifu', 5),
	(2, 'software engineer practice', '[[1573624800000,1573632000000],[1574229600000,1574236800000],[1574834400000,1574841600000]]', 'Jingxin', 3),
	(3, 'computer foreign language', '[[1573988400000,1573995600000],[1574593200000,1574600400000],[1575198000000,1575205200000]]', 'Sanjiao', 7),
	(4, 'learning PHP', '[[1573344000000,1573351200000],[1573948800000,1573956000000],[1574553600000,1574560800000]]', 'Lisiguang', 7),
	(8, 'test', '[[1567382400000,1567396800000],[1567987200000,1568001600000],[1567400400000,1567414800000],[1568005200000,1568019600000]]', 'yifu', 3),
	(9, 'Cname', '[[1567555200000,1567569600000],[1568160000000,1568174400000],[1567659600000,1567674000000],[1568264400000,1568278800000]]', 'sanjiao', 3);
/*!40000 ALTER TABLE `group5_course` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_discuss
DROP TABLE IF EXISTS `group5_discuss`;
CREATE TABLE IF NOT EXISTS `group5_discuss` (
  `did` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `dname` text NOT NULL,
  `unid` int(11) NOT NULL,
  PRIMARY KEY (`did`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_discuss: 6 rows
DELETE FROM `group5_discuss`;
/*!40000 ALTER TABLE `group5_discuss` DISABLE KEYS */;
INSERT INTO `group5_discuss` (`did`, `cid`, `dname`, `unid`) VALUES
	(1, 1, 'Do you think SRS is useful or not?', 4),
	(2, 1, 'discuss', 14),
	(3, 1, 'how to calc a+b?', 3),
	(4, 2, 'discuss', 20),
	(5, 8, 'aaa', 21),
	(6, 2, 'discuss', 22);
/*!40000 ALTER TABLE `group5_discuss` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_homework
DROP TABLE IF EXISTS `group5_homework`;
CREATE TABLE IF NOT EXISTS `group5_homework` (
  `hid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `unid` int(11) NOT NULL,
  `pcnt` int(11) NOT NULL DEFAULT '0',
  `hname` text NOT NULL,
  PRIMARY KEY (`hid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_homework: 6 rows
DELETE FROM `group5_homework`;
/*!40000 ALTER TABLE `group5_homework` DISABLE KEYS */;
INSERT INTO `group5_homework` (`hid`, `cid`, `unid`, `pcnt`, `hname`) VALUES
	(1, 1, 2, 3, 'Preview the next unit and answer: what is SRS'),
	(2, 1, 14, 0, 'homework'),
	(4, 2, 20, 0, 'homework'),
	(5, 2, 20, 0, 'wulalala'),
	(6, 2, 22, 0, 'homework'),
	(7, 2, 20, 0, '123');
/*!40000 ALTER TABLE `group5_homework` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_mail
DROP TABLE IF EXISTS `group5_mail`;
CREATE TABLE IF NOT EXISTS `group5_mail` (
  `maid` int(11) NOT NULL AUTO_INCREMENT,
  `suid` int(11) NOT NULL,
  `tuid` int(11) NOT NULL,
  `maname` text NOT NULL,
  `content` text NOT NULL,
  `matime` datetime NOT NULL,
  PRIMARY KEY (`maid`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_mail: 24 rows
DELETE FROM `group5_mail`;
/*!40000 ALTER TABLE `group5_mail` DISABLE KEYS */;
INSERT INTO `group5_mail` (`maid`, `suid`, `tuid`, `maname`, `content`, `matime`) VALUES
	(1, 1, 2, 'test mail title', 'jlu to kayaking. a test mail content.', '2019-10-01 11:23:00'),
	(2, 2, 1, 'YesterdayNullam quis risus eget urna mollis ornare\r\n', 'Have you ever been involuntarily terminated for cause (e.g. violation of company policy, performance, theft, etc) by an employer?', '2019-10-09 16:14:00'),
	(3, 3, 1, 'test mail title', 'test mail content from 3 to 1', '2019-10-11 00:00:00'),
	(4, 2, 4, 'to dhh', 'Hello dhh, we are now classmates', '2019-10-03 09:00:00'),
	(5, 4, 2, 'to kayaking', 'hi, nice to meet you', '2019-10-11 12:00:00'),
	(6, 2, 4, 'to dhh', 'why you answer me a week later? what have you been doing?', '2019-10-11 14:00:00'),
	(7, 4, 2, 'to kayaking', 'i have been sleeping all these days.\r\nnice to meet you!', '2019-10-22 11:00:00'),
	(8, 2, 4, 'to dahaha', 'nice ni mei', '2019-10-22 12:00:00'),
	(9, 2, 5, 'about software engineer', 'dear professor BB, I love your class. But I am worried about that cannot catch the class, can I ask you some questions in WeiXin? yours sincerely， kayaking', '2019-10-06 14:19:30'),
	(17, 1, 2, 'PHP', 'PHP js html5 ajax dom', '2019-10-29 21:38:50'),
	(10, 5, 2, 'about weixin', 'what is WeiXin?', '2019-10-06 15:00:00'),
	(11, 2, 5, '...', '????????', '2019-10-06 16:00:00'),
	(12, 5, 2, 'to kayaking', 'work hard![微笑]', '2019-10-06 18:00:00'),
	(13, 1, 2, 'test js function', 'test js and php func', '2019-10-29 13:18:28'),
	(14, 1, 2, 'test html page', 'here is a test content typed in html message textarea.test CRLF.', '2019-10-29 13:33:29'),
	(15, 1, 2, 'woyoulaile', 'youshiwo wolaileÂ ', '2019-10-29 13:34:36'),
	(16, 1, 2, '', '', '2019-10-29 13:35:50'),
	(18, 1, 2, 'PHP', 'PHP HTML5 JS DOMÂ ', '2019-10-29 21:40:39'),
	(19, 1, 2, 'zrxnb', 'zrxnbao aoligei', '2019-10-29 22:16:20'),
	(20, 1, 9, 'no', 'hahahahaha', '2019-10-30 23:08:08'),
	(21, 1, 2, 'test subject', '11222fafasdfasdfasdfafsd', '2019-10-31 10:13:57'),
	(22, 2, 1, 'test in my3w', 'test in my3w', '2019-11-07 22:52:25'),
	(23, 2, 3, 'question1', '123123', '2019-11-07 22:57:46'),
	(24, 1, 3, 'No', 'No', '2019-11-13 20:06:15');
/*!40000 ALTER TABLE `group5_mail` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_module
DROP TABLE IF EXISTS `group5_module`;
CREATE TABLE IF NOT EXISTS `group5_module` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL,
  `mname` text NOT NULL,
  `mlabel` int(11) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_module: 14 rows
DELETE FROM `group5_module`;
/*!40000 ALTER TABLE `group5_module` DISABLE KEYS */;
INSERT INTO `group5_module` (`mid`, `cid`, `mname`, `mlabel`) VALUES
	(1, 1, 'The History of Software Engineer', 1),
	(2, 1, 'SRS', 2),
	(3, 2, 'How to Write SRS', 1),
	(4, 3, 'What is Computer Foreign Language', 1),
	(5, 2, 'How to Design and Code', 2),
	(8, 1, 'Coding in Software Engineer', 3),
	(6, 4, 'PHP A', 1),
	(7, 4, 'PHP B', 2),
	(9, 4, 'PHP C', 4),
	(10, 1, 'new module', 4),
	(11, 7, 'another new module', 1),
	(12, 2, 'new module', 3),
	(13, 8, 'ma', 1),
	(14, 2, 'module', 4);
/*!40000 ALTER TABLE `group5_module` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_question
DROP TABLE IF EXISTS `group5_question`;
CREATE TABLE IF NOT EXISTS `group5_question` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `hid` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `title` text NOT NULL,
  `selector` json DEFAULT NULL,
  `answer` text NOT NULL,
  PRIMARY KEY (`qid`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_question: 6 rows
DELETE FROM `group5_question`;
/*!40000 ALTER TABLE `group5_question` DISABLE KEYS */;
INSERT INTO `group5_question` (`qid`, `hid`, `type`, `score`, `title`, `selector`, `answer`) VALUES
	(1, 1, 0, 1, 'What is the answer？', '{"A": "A", "B": "B", "C": "C", "D": "D"}', 'A'),
	(2, 1, 0, 1, 'What is the answer of last question?', '{"A": "D", "B": "C", "C": "B", "D": "A"}', 'D'),
	(3, 1, 1, 1, 'an objective question.', NULL, 'this is answer'),
	(4, 1, 1, 2, 'Are you ok?', NULL, 'I am ok.'),
	(18, 4, 0, 1, 'question1', '{"A": "A", "B": "B", "C": "C", "D": "D"}', 'A'),
	(19, 4, 1, 1, 'question1', NULL, '123123');
/*!40000 ALTER TABLE `group5_question` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_reading
DROP TABLE IF EXISTS `group5_reading`;
CREATE TABLE IF NOT EXISTS `group5_reading` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `unid` int(11) NOT NULL,
  `rname` text NOT NULL,
  PRIMARY KEY (`rid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_reading: 6 rows
DELETE FROM `group5_reading`;
/*!40000 ALTER TABLE `group5_reading` DISABLE KEYS */;
INSERT INTO `group5_reading` (`rid`, `unid`, `rname`) VALUES
	(1, 14, 'reading'),
	(2, 3, 'how to read'),
	(3, 20, 'reading'),
	(4, 21, 'aaa'),
	(5, 20, 'what is your father'),
	(6, 22, 'reading');
/*!40000 ALTER TABLE `group5_reading` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_studentcourse
DROP TABLE IF EXISTS `group5_studentcourse`;
CREATE TABLE IF NOT EXISTS `group5_studentcourse` (
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `cscore` int(11) DEFAULT NULL,
  PRIMARY KEY (`uid`,`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_studentcourse: 8 rows
DELETE FROM `group5_studentcourse`;
/*!40000 ALTER TABLE `group5_studentcourse` DISABLE KEYS */;
INSERT INTO `group5_studentcourse` (`uid`, `cid`, `cscore`) VALUES
	(2, 2, NULL),
	(2, 1, NULL),
	(4, 1, NULL),
	(4, 2, NULL),
	(4, 3, 95),
	(9, 3, 90),
	(9, 4, NULL),
	(1, 10, NULL);
/*!40000 ALTER TABLE `group5_studentcourse` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_unit
DROP TABLE IF EXISTS `group5_unit`;
CREATE TABLE IF NOT EXISTS `group5_unit` (
  `unid` int(11) NOT NULL AUTO_INCREMENT,
  `mid` int(11) NOT NULL,
  `unname` text NOT NULL,
  `unlabel` int(11) NOT NULL,
  PRIMARY KEY (`unid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_unit: 22 rows
DELETE FROM `group5_unit`;
/*!40000 ALTER TABLE `group5_unit` DISABLE KEYS */;
INSERT INTO `group5_unit` (`unid`, `mid`, `unname`, `unlabel`) VALUES
	(1, 1, 'The Start of Software Engineer', 1),
	(2, 1, 'Nowadays\' Software Engineer', 2),
	(3, 2, 'The Structure of SRS', 1),
	(4, 2, 'What can SRS do', 2),
	(5, 3, 'SRS Writing Practice', 1),
	(6, 4, 'The Introduction of Computer Foreign Language', 1),
	(7, 5, 'How to Design a Software', 1),
	(8, 5, 'Details in Coding', 2),
	(9, 6, 'PHP1', 1),
	(10, 6, 'PHP2', 2),
	(11, 6, 'PHP3', 3),
	(12, 7, 'PHP4', 1),
	(13, 7, 'PHP5', 2),
	(14, 8, 'Program Control', 1),
	(15, 9, 'PHP6', 1),
	(16, 8, 'new unit', 2),
	(17, 2, 'another new unit', 3),
	(18, 10, 'new module unit', 1),
	(19, 11, 'unit', 1),
	(20, 12, 'new unit', 1),
	(21, 13, 'ua', 1),
	(22, 14, 'unit', 1);
/*!40000 ALTER TABLE `group5_unit` ENABLE KEYS */;

-- Dumping structure for table bdm721868123_db.group5_user
DROP TABLE IF EXISTS `group5_user`;
CREATE TABLE IF NOT EXISTS `group5_user` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `uname` text NOT NULL,
  `pwd` text NOT NULL,
  `role` int(3) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- Dumping data for table bdm721868123_db.group5_user: 9 rows
DELETE FROM `group5_user`;
/*!40000 ALTER TABLE `group5_user` DISABLE KEYS */;
INSERT INTO `group5_user` (`uid`, `uname`, `pwd`, `role`) VALUES
	(1, 'jlu', '1084c29da0ccd38cfcf3d9c92c148026', 0),
	(2, 'kayaking', '1bbd886460827015e5d605ed44252251', 2),
	(3, 'AA', '1f75826299f8baa41cd82ae2e712bf13', 1),
	(5, 'BB', 'a8d638a23c4673ef0aef65577c678c1e', 1),
	(7, 'CC', '2ee0c725afd488f38d60ec5e1b66a7bc', 1),
	(4, 'dahaha', '88943c1e65f016c41f5217d623baaa9f', 2),
	(6, 'wenniu', 'f612601e9abd4bd281aada7f20b6311e', 1),
	(9, 'canoeing', '25d55ad283aa400af464c76d713c07ad', 2),
	(12, 'canoeing1', '7fa8282ad93047a4d6fe6111c93b308a', 1);
/*!40000 ALTER TABLE `group5_user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
