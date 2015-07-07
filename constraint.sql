use forum;
#posts_topic(b_id) on delete cascade
alter table posts_topic drop foreign key posts_topic_ibfk_2;
alter table posts_topic add constraint foreign key(board_id) references forum_board(b_id) on delete cascade;

#posts_reply(p_id) on delete cascade
alter table posts_reply drop foreign key posts_reply_ibfk_1;
alter table posts_reply add constraint foreign key(p_id) references posts_topic(p_id) on delete cascade;

#posts_content(p_id) on delete cascade
alter table posts_content drop foreign key posts_content_ibfk_1;
alter table posts_content add constraint foreign key(p_id) references posts_topic(p_id) on delete cascade;

CREATE TRIGGER `reply_increament` AFTER INSERT ON `posts_reply` FOR EACH ROW UPDATE posts_topic SET reply_count=reply_count+1 WHERE p_id=NEW.p_id;