-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2015-07-11 07:32:37
-- 服务器版本： 5.6.16
-- PHP Version: 5.5.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- 表的结构 `forum_board`
--
DROP DATABASE IF EXISTS forum;
CREATE DATABASE forum;
use forum;

CREATE TABLE IF NOT EXISTS `forum_board` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` char(20) DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL,
  `posts_count` int(11) DEFAULT '0',
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_name` (`b_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `forum_board`
--

INSERT INTO `forum_board` (`b_id`, `b_name`, `description`, `posts_count`) VALUES
(1, '学习交流', '交流经验，答疑解惑，相互促进，共同进步', 8),
(2, '学习资源', '资源共享，学习路上不再孤单', 0),
(3, '选课交流', '解读培养计划，介绍选课技巧，交流课程心得', 0),
(4, '计算机科学与技术', '10001001001101——We are the future! http://cs.cc98.org', 4),
(5, '专业咨询', '解析专业概况，交流专业规划', 0);

-- --------------------------------------------------------

--
-- 表的结构 `forum_message`
--

CREATE TABLE IF NOT EXISTS `forum_message` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `sender` varchar(20) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text,
  PRIMARY KEY (`m_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `forum_message`
--

INSERT INTO `forum_message` (`m_id`, `sender_id`, `sender`, `receiver_id`, `send_time`, `content`) VALUES
(1, 10, 'student2', 9, '2015-07-11 05:14:17', '【一路走来 一路有你】CC98十二周年坛庆期待您的光临'),
(2, 11, 'student3', 9, '2015-07-11 05:14:17', '期末又到了...大家快来版上交流啦！！！');

-- --------------------------------------------------------

--
-- 表的结构 `posts_content`
--

CREATE TABLE IF NOT EXISTS `posts_content` (
  `p_id` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `attachment` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `posts_content`
--

INSERT INTO `posts_content` (`p_id`, `content`, `attachment`) VALUES
(1, '1.关于“重修”\r\n   根据浙大发本〔2008〕1号《浙江大学本科学生学籍管理细则（2008年9月修订）》第四章第十二条的规定：“学生应按时参加所修读课程的考核。考核成绩无论合格与否，一律记入学生成绩单和学籍档案”，从2013-2014学年春夏学期开始修读的课程成绩，一律记入学校出具的成绩单（包括毕业成绩单和出国成绩单）。\r\n   解读：按照既往不究的原则，这个秋冬学期及以前的不及格成绩都不会在以后的最终毕业成绩单上出现，但是春夏学期开始，任何选上的课的任何成绩都会在最终毕业成绩单上体现，包括及格、不及格、缺考、弃考。\r\n   详细解读：\r\nif重修之前学期的课\r\n if以前及格了\r\n     if分数比之前高的，比如原来是70分现在是80分的，\r\n          那么之前学期课程成绩不显示，只显示这个重修后的实际成绩；\r\n     else（分数比之前低的）\r\n          那么之前的学期课程和现在都显示；\r\n else（以前挂了）\r\n     那么以前的不显示，现在不论几分都显示实际成绩\r\nelse（从这学期开始重修的）\r\n    不论如何情况，每次修读都显示每次的实际成绩\r\n注：\r\n在打印出国成绩单算绩点的时候，会按高的那次算绩点，但是成绩单里面课程列表以上面情况处理。\r\n毕业成绩单亦然。\r\n评奖评优和保研排名保持以往做法，只算第一次的成绩。\r\n\r\n2.关于“补考”\r\n补考以后及格是指你挂掉的那门课的成绩显示为“补及格”，绩点为0，但拿到学分；\r\n补考以后又挂了是指你挂掉的那门课的成绩显示为“补不及格”，绩点为0，未拿到学分；\r\n但不影响挂掉时候的分数显示。\r\n\r\n3.关于“毕业清考”\r\n毕业清考课程只适用于未在当前春夏学期开课且挂掉（不包括弃考、缺考，但包括补不及格）的课程，\r\n如果当前春夏学期开课的话，不能清考，只能跟教学班补考或重修。', NULL),
(2, '求问我这暑学期选了绘画基础，但是不知道上课讲什么的。。？\r\n\r\n我是社科的没有基础，能不能修啊。。？\r\n\r\n上课有什么作业？有没有考试？？需要买绘画用品吗。。。？\r\n\r\n求问', NULL),
(3, '马原上课真的听不懂  结果在考前刷了几道选择题 课本上的套话背了几句  结果成绩出来 呵呵', NULL),
(4, 'RT 感觉周围的同学们都出了 就我没出额 陈明飞老师班级里的', NULL),
(5, '求问！', NULL),
(6, '求问线代挂了之后可以通过修高代覆盖吗？如果不能覆盖挂科记录会影响保研吗？', NULL),
(7, '学弟希望在这个暑假能对编程有所长进，学长们能推荐一些关于编程方面的书看吗？', NULL),
(8, '浙江大学计算机学院与软件学院 2015 飞跃手册隆重出炉啦！\r\n\r\n感谢每一位参与飞跃手册制作的同学。\r\n\r\n希望该手册可以帮助学弟学妹，并预祝申请顺利！\r\n\r\n链接: URL http://pan.baidu.com/s/1pJHZRar\r\n密码: 8mz6', NULL),
(9, 'lz是研究生，平时项目主要做工程，也做一些科研，但是由于项目调派等原因，项目做得有点杂，好多领域都接触过，但没有一个精通的。本来以为电话面试会问一些基础理论问题、算法题之类的，这几天也一直在恶补基础知识，结果投机失败。。\r\n\r\n今天下午接到面试官电话，双方先简单自我介绍\r\n\r\n第一个问题是：\r\n\r\n看你简历上项目经历挺多的，挑一个你印象最深刻的给我讲讲吧。\r\n\r\n这一块由于是自己做过的东西，讲起来并不难，但这是lz第一次找工作面试，很紧张，说话有点语无伦次，好几次都在讲面试官不关心的细节。\r\n\r\n我回忆了一下，面试官对项目经历最关心的是我在这个项目里解决了一个什么问题，最好能给出清晰的问题定义，或者用明确的输入输出来举例，其次，面试官也很想知道我解决这个问题用了什么样的算法，或者说解决思路，最好能把框架描述出来，这中间面试官会抓一些细节提问。\r\n\r\n第二个问题是：\r\n\r\n这个是阿里项目组自己出的题目，由于忘了问面试官可不可以公开，先暂时不说具体的问题吧。面试官看我在简历上有做过关于LBS方面的研究，就问了一个跟用户签到数据分析有关的问题。\r\n\r\nlz这一块答得不好，一上来就是机器学习、轨迹相似度、稀疏轨迹修正等等各种学术思路，后来面试官非常好心的提醒我：你看，机器学习需要训练数据集，算法也比较复杂，有没有什么简单的适合工程的做法？或者说用户签到数据有哪些重要的特征是我们关心的？lz的思维还是停留在轨迹数据的处理上，马上就说是数据的时序特征。。。\r\n\r\n最后面试官给我说了他的思路，确实很简单。。。我觉得没做过这方面研究的人也能想到，是我自己把问题复杂化了\r\n\r\n电面结束，面了37分钟，赶紧记录下来，供小伙伴们参考\r\n\r\n附上lz的总结：\r\n\r\n1.简历上写的所有东西一定要非常熟悉，最好把一些关键信息记在纸上，方便面试时参考，lz面试的时候手忙脚乱，面试官让lz讲一下算法思路，lz还要先找以前的算法ppt找半天。。。\r\n\r\n2.面试的时候想办法调整心态、语速，lz今天面试的时候太激动，语速飞快，在自己的世界里天马行空。。。自己答得不好，还不停打断面试官，还好对方态度非常nice，听声音好像一个小学弟，lz求了联系方式没成功。。。\r\n\r\n3.面试官挺有耐心的，很多问题真的应该从对方的需求角度稍微思考一下再回答，不用抢时间', NULL),
(10, '阿里巴巴集团2016校园招聘内推啦！\r\n面向人群：2016届毕业生 (2016.1.1-2017.3.31期间毕业的同学)，正式员工！\r\n招聘职位：技术、产品、UED、运营、客户代言人、综合职能等7大类30多个岗位等你来！参考：URL http://campus.alibaba.com\r\n我们是B2B技术部，为阿里全球贸易和农村淘宝战略护航，在全球化架构、云电商服务平台、B类大数据计算（金融保险等）、多语言技术等方面业界领先。来吧，一起实现全球贸易全球购的梦想！\r\nPS：\r\n1、参与内推可以免笔试、提前拿到录用意向书。面试不通过，后续还可以参加笔试哦！\r\n2、有兴趣可以发送你的简历到towbg@qq.com，写明你的求职意向。也可以加QQ：997086458 咨询下哈！\r\n3、内推截至7月26号！每位童鞋只能被内推一次！要注意哈！', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `posts_reply`
--

CREATE TABLE IF NOT EXISTS `posts_reply` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) DEFAULT NULL,
  `replier_id` int(11) DEFAULT NULL,
  `replier` varchar(20) DEFAULT NULL,
  `content` text,
  `reply_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`r_id`),
  KEY `replier_id` (`replier_id`),
  KEY `p_id` (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `posts_reply`
--

INSERT INTO `posts_reply` (`r_id`, `p_id`, `replier_id`, `replier`, `content`, `reply_time`) VALUES
(1, 1, 11, 'student3', '平均分68的那个。。。真的吗？', '2015-07-11 05:11:37'),
(2, 1, 12, 'student4', '鸭子学长都毕业了还为敝校着想', '2015-07-11 05:11:37'),
(3, 1, 13, 'student5', '也没什么心情去重修了。。', '2015-07-11 05:11:37'),
(4, 6, 20, 'student20', '保研只看专业课吧。。。不看大类课', '2015-07-11 05:21:08'),
(5, 6, 17, 'student9', '不是说高代比线代难吗', '2015-07-11 05:21:08');

--
-- 触发器 `posts_reply`
--
DROP TRIGGER IF EXISTS `reply_increament`;
DELIMITER //
CREATE TRIGGER `reply_increament` AFTER INSERT ON `posts_reply`
 FOR EACH ROW UPDATE posts_topic SET reply_count=reply_count+1 WHERE p_id=NEW.p_id
//
DELIMITER ;


-- --------------------------------------------------------

--
-- 表的结构 `posts_topic`
--

CREATE TABLE IF NOT EXISTS `posts_topic` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `author` varchar(20) DEFAULT NULL,
  `post_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `board_id` int(11) DEFAULT NULL,
  `hits` int(11) DEFAULT '0',
  `reply_count` int(11) DEFAULT '0',
  `is_announcement` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  KEY `author_id` (`author_id`),
  KEY `board_id` (`board_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `posts_topic`
--

INSERT INTO `posts_topic` (`p_id`, `title`, `author_id`, `author`, `post_time`, `board_id`, `hits`, `reply_count`, `is_announcement`) VALUES
(1, '关于学业政策（重修补考等）方面的整理', 1, 'admin1', '2015-07-11 05:04:12', 1, 10, 3, 0),
(2, '有没有上过绘画基础的同学～？', 2, 'admin2', '2015-07-11 05:04:12', 1, 3, 0, 0),
(3, '怒挂马原', 9, 'student1', '2015-07-11 05:04:12', 1, 6, 0, 0),
(4, '为什么我的微三还没出', 10, 'student2', '2015-07-11 05:04:12', 1, 4, 0, 0),
(5, '交论文的课程能申请结业换证考吗？', 24, 'teacher1', '2015-07-11 05:04:12', 1, 0, 0, 0),
(6, '社科妹子的痛，一失足成。。。', 16, 'student8', '2015-07-11 05:18:51', 1, 20, 2, 0),
(7, '大一的暑假该怎么过？', 14, 'student6', '2015-07-11 05:24:27', 4, 30, 0, 0),
(8, '浙江大学计算机学院与软件学院 2015 飞跃手册', 17, 'student9', '2015-07-11 05:24:27', 4, 26, 0, 0),
(9, '分享阿里内推第一次电话面试经历', 25, 'teacher2', '2015-07-11 05:26:11', 4, 21, 0, 1),
(10, '[内推][正式]阿里巴巴集团2016校园招聘内推啦！-B2B技术部', 7, 'admin7', '2015-07-11 05:26:11', 4, 50, 0, 1),
(11, '（急）计算方法  朱建新老师和助教王玉芳学姐联系方式 成绩还没有出', 15, 'student7', '2015-07-11 05:30:37', 1, 17, 0, 0),
(12, '求问罗天华的现代汉语怎么样啊？求学长学姐指导', 16, 'student8', '2015-07-11 05:30:37', 1, 24, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `u_id` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(40) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `posts_counts` int(11) DEFAULT '0',
  PRIMARY KEY (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_details`
--

INSERT INTO `user_details` (`u_id`, `photo`, `gender`, `description`, `phone`, `email`, `posts_counts`) VALUES
(1, NULL, 'F', 'GO', '12345678912', '111@qq.com', 0),
(2, NULL, 'F', 'GO', '12345678912', '222@qq.com', 0),
(3, NULL, 'M', NULL, '12345678912', NULL, 0),
(4, NULL, 'F', 'GO', '12345678912', NULL, 0),
(5, NULL, 'F', '', '12345678912', NULL, 0),
(6, NULL, 'F', '', '12345678912', NULL, 0),
(7, NULL, 'M', 'GO', '12345678912', NULL, 0),
(8, NULL, 'F', '', '12345678912', NULL, 0),
(9, NULL, 'M', '', '12345678912', NULL, 0),
(10, NULL, 'F', '', '12345678912', NULL, 0),
(11, NULL, 'F', '', '12345678912', '333@qq.com', 0),
(12, NULL, 'F', '', '12345678912', NULL, 0);

-- --------------------------------------------------------

--
-- 表的结构 `user_simple`
--

CREATE TABLE IF NOT EXISTS `user_simple` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `passwd` char(32) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `user_simple`
--

INSERT INTO `user_simple` (`u_id`, `username`, `passwd`, `role`, `status`) VALUES
(1, 'admin1', '81DC9BDB52D04DC20036DBD8313ED055', 0, 0),
(2, 'admin2', '81DC9BDB52D04DC20036DBD8313ED055', 0, 0),
(3, 'admin3', '81DC9BDB52D04DC20036DBD8313ED055', 0, 0),
(4, 'admin4', '81DC9BDB52D04DC20036DBD8313ED055', 0, 0),
(5, 'admin5', '81DC9BDB52D04DC20036DBD8313ED055', 0, 0),
(6, 'admin6', '81DC9BDB52D04DC20036DBD8313ED055', 0, 0),
(7, 'admin7', '81DC9BDB52D04DC20036DBD8313ED055', 0, 0),
(8, 'admin8', '81DC9BDB52D04DC20036DBD8313ED055', 0, 1),
(9, 'student1', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(10, 'student2', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(11, 'student3', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(12, 'student4', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(13, 'student5', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(14, 'student6', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(15, 'student7', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(16, 'student8', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(17, 'student9', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(18, 'student10', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(19, 'student11', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(20, 'student12', '81DC9BDB52D04DC20036DBD8313ED055', 1, 0),
(21, 'student13', '81DC9BDB52D04DC20036DBD8313ED055', 1, 1),
(22, 'student14', '81DC9BDB52D04DC20036DBD8313ED055', 1, 1),
(23, 'student15', '81DC9BDB52D04DC20036DBD8313ED055', 1, 1),
(24, 'teacher1', '81DC9BDB52D04DC20036DBD8313ED055', 2, 0),
(25, 'teacher2', '81DC9BDB52D04DC20036DBD8313ED055', 2, 0),
(26, 'teacher3', '81DC9BDB52D04DC20036DBD8313ED055', 2, 0),
(27, 'teacher4', '81DC9BDB52D04DC20036DBD8313ED055', 2, 0),
(28, 'teacher5', '81DC9BDB52D04DC20036DBD8313ED055', 2, 0),
(29, 'teacher6', '81DC9BDB52D04DC20036DBD8313ED055', 2, 0),
(30, 'teacher7', '81DC9BDB52D04DC20036DBD8313ED055', 2, 1),
(31, 'teacher8', '81DC9BDB52D04DC20036DBD8313ED055', 2, 1);

--
-- 限制导出的表
--

--
-- 限制表 `forum_message`
--
ALTER TABLE `forum_message`
  ADD CONSTRAINT `forum_message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user_simple` (`u_id`),
  ADD CONSTRAINT `forum_message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user_simple` (`u_id`);

--
-- 限制表 `posts_content`
--
ALTER TABLE `posts_content`
  ADD CONSTRAINT `posts_content_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `posts_topic` (`p_id`) ON DELETE CASCADE;

--
-- 限制表 `posts_reply`
--
ALTER TABLE `posts_reply`
  ADD CONSTRAINT `posts_reply_ibfk_2` FOREIGN KEY (`replier_id`) REFERENCES `user_simple` (`u_id`),
  ADD CONSTRAINT `posts_reply_ibfk_3` FOREIGN KEY (`p_id`) REFERENCES `posts_topic` (`p_id`) ON DELETE CASCADE;

--
-- 限制表 `posts_topic`
--
ALTER TABLE `posts_topic`
  ADD CONSTRAINT `posts_topic_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user_simple` (`u_id`),
  ADD CONSTRAINT `posts_topic_ibfk_2` FOREIGN KEY (`board_id`) REFERENCES `forum_board` (`b_id`) ON DELETE CASCADE;

--
-- 限制表 `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_simple` (`u_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
