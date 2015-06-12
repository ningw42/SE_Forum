create database forum;
use forum;

#primary info for user
create table user_simple(u_id int auto_increment,
                         username varchar(20) not null,
                         passwd varchar(20),
                         role tinyint,
                         status tinyint,
  unique key(username),
  primary key(u_id));

#alter table user_simple add username varchar(20) not null;

#user info in detail
create table user_details(u_id int,
                          photo int,
                          gender char,
                          description varchar(50),
                          phone varchar(20),
                          email varchar(25),
                          posts_counts int default 0,
  primary key(u_id),
  foreign key(u_id) references user_simple(u_id));

#forum board
create table forum_board(b_id int auto_increment,
                         b_name char(20),
                         description varchar(80),
                         posts_count int default 0,
  unique key(b_name),
  primary key(b_id));

#post topic
create table posts_topic(p_id int auto_increment,
                         title varchar(60),
                         author_id int,
                         author varchar(20),
                         post_time timestamp not null default current_timestamp,
                         board_id int,
                         hits int default 0,
                         reply_count int default 0,
                         is_announcement boolean,
  primary key(p_id),
  foreign key(author_id) references user_simple(u_id),
  foreign key(board_id) references forum_board(b_id));

#post content
create table posts_content(p_id int,
                           content text,
                           attachment int,
  primary key(p_id),
  foreign key(p_id) references posts_topic(p_id));

#post reply
create table posts_reply(r_id int auto_increment,
                         p_id int,
                         replier_id int,
                         replier varchar(20),
                         content text,
                         reply_time timestamp not null default current_timestamp,
  primary key(r_id),
  foreign key(p_id) references posts_topic(p_id),
  foreign key(replier_id) references user_simple(u_id));

#forum message
create table forum_message(m_id int auto_increment,
                           sender_id int,
                           sender varchar(20),
                           receiver_id int,
                           send_time timestamp not null default current_timestamp,
                           content text,
  primary key(m_id),
  foreign key(sender_id) references user_simple(u_id),
  foreign key(receiver_id) references user_simple(u_id));


#select * from forum_board;

#alter table forum_board change description description varchar(80);
