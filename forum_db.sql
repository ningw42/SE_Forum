use forum;

#user simple
CREATE TABLE `user_simple` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `passwd` char(32) DEFAULT NULL,
  `role` tinyint(4) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

#user_details
CREATE TABLE `user_details` (
  `u_id` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(40) DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(25) DEFAULT NULL,
  `posts_counts` int(11) DEFAULT '0',
  PRIMARY KEY (`u_id`),
  CONSTRAINT `user_details_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `user_simple` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#forum_board
CREATE TABLE `forum_board` (
  `b_id` int(11) NOT NULL AUTO_INCREMENT,
  `b_name` char(20) DEFAULT NULL,
  `description` varchar(80) DEFAULT NULL,
  `posts_count` int(11) DEFAULT '0',
  PRIMARY KEY (`b_id`),
  UNIQUE KEY `b_name` (`b_name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

#forum_message
CREATE TABLE `forum_message` (
  `m_id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) DEFAULT NULL,
  `sender` varchar(20) DEFAULT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `send_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `content` text,
  PRIMARY KEY (`m_id`),
  KEY `sender_id` (`sender_id`),
  KEY `receiver_id` (`receiver_id`),
  CONSTRAINT `forum_message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user_simple` (`u_id`),
  CONSTRAINT `forum_message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user_simple` (`u_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

#post_topic
CREATE TABLE `posts_topic` (
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
  KEY `board_id` (`board_id`),
  CONSTRAINT `posts_topic_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `user_simple` (`u_id`),
  CONSTRAINT `posts_topic_ibfk_2` FOREIGN KEY (`board_id`) REFERENCES `forum_board` (`b_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

#post_content
CREATE TABLE `posts_content` (
  `p_id` int(11) NOT NULL DEFAULT '0',
  `content` text,
  `attachment` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`p_id`),
  CONSTRAINT `posts_content_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `posts_topic` (`p_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

#post_reply
CREATE TABLE `posts_reply` (
  `r_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_id` int(11) DEFAULT NULL,
  `replier_id` int(11) DEFAULT NULL,
  `replier` varchar(20) DEFAULT NULL,
  `content` text,
  `reply_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`r_id`),
  KEY `replier_id` (`replier_id`),
  KEY `p_id` (`p_id`),
  CONSTRAINT `posts_reply_ibfk_2` FOREIGN KEY (`replier_id`) REFERENCES `user_simple` (`u_id`),
  CONSTRAINT `posts_reply_ibfk_3` FOREIGN KEY (`p_id`) REFERENCES `posts_topic` (`p_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;






