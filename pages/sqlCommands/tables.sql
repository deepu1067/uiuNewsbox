DROP DATABASE IF EXISTS uiuNewsBox;
CREATE DATABASE IF NOT EXISTS uiuNewsBox;
USE uiuNewsBox;

create table admin
(
    id int AUTO_INCREMENT,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100) UNIQUE,
    phone_number varchar(50),
    passwords VARCHAR(20),
    primary key(id)
);

create table general_user(
    id int AUTO_INCREMENT,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100) UNIQUE,
    phone_number varchar(50),
    passwords VARCHAR(20),
    primary key(id)
);

create table forumRep(
    id int AUTO_INCREMENT,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100) UNIQUE,
    phone_number varchar(50),
    passwords VARCHAR(20),
    primary key(id)
);


create table newsPost(
    post_id int AUTO_INCREMENT,
    title varchar(100),
    content varchar(1000),
    likes int,
    types varchar(50),
    admin_id int,
    forum_id int,
    primary key(post_id),
    foreign key(admin_id) REFERENCES admin(id),
    foreign key(forum_id) REFERENCES forumRep(id)
);

create table post_comment(
    cDates date,
    cTime time,
    content varchar(1000),
    cLike int,
    post_id int,
    foreign key(post_id) references newsPost(post_id)
);

create table job_post(
    post_id int AUTO_INCREMENT,
    likes int,
    content varchar(1000),
    title varchar(50),
    primary key(post_id),
    
    admin_id int,
    foreign key(admin_id) references admin(id),

    general_user_id int,
    foreign key(general_user_id) references general_user(id),

    forumRep_id int,
    foreign key(forumRep_id) references forumRep(id)
);

create table jobPost_comment(
    cDates date ,
    cTime time,
    content varchar(1000),
    cLike int,
    jpost_id int,
    foreign key(jpost_id) references job_post(post_id)
);

create table events(
    event_id int AUTO_INCREMENT,
    title varchar(100),
    eDates date,
    eTime time,
    details varchar(100),
    locations varchar(100),
    contact_Number varchar(50),
    forumRep_id int,

    primary key(event_id),
    foreign key(forumRep_id) REFERENCES forumRep(id)
);

create table questions(
    course_id int AUTO_INCREMENT,
    course_name varchar(100),
    files varchar(100),
    general_user_id int,

    primary key(course_id),
    FOREIGN KEY (general_user_id) REFERENCES general_user(id)
);

create table room(
    id int AUTO_INCREMENT,
    forum_name VARCHAR(100),
    forumRep_id int, 

    primary key(id),
    Foreign Key (forumRep_id) REFERENCES forumRep(id)
);

create table users(
    room_id int,
    users_id int,
    approve int, 

    Foreign Key (room_id) REFERENCES room(id),
    Foreign Key (users_id) REFERENCES general_user(id)
);

create table chats(
    room_id int,
    users_id int,
    forumRep_id int,
    texts varchar(200), 
    sl_no int AUTO_INCREMENT PRIMARY KEY,
    dates date,
    mtime time,

    Foreign Key (room_id) REFERENCES room(id),
    Foreign Key (users_id) REFERENCES general_user(id),
    Foreign Key (forumRep_id) REFERENCES forumRep(id)
);

CREATE TABLE categories (
  id int(11) NOT NULL,
  cat_name varchar(255) NOT NULL,
  cat_order varchar(255) NOT NULL
);

INSERT INTO `categories` (`id`, `cat_name`, `cat_order`) VALUES
(1, 'Events', '1'),
(2, 'Job Post', '2');

CREATE TABLE posts (
  id int(11) NOT NULL AUTO_INCREMENT,
  title varchar(255) NOT NULL,
  description longtext NOT NULL,
  img varchar(255) NOT NULL,
  old_img varchar(255) NOT NULL,
  cat_id varchar(255) NOT NULL,
  date varchar(255) NOT NULL,
  view int(11) NOT NULL,
  f_email varchar(50) not null
);


-- DROP TABLE post_comment;
-- create table post_comment(
--     id int (5) AUTO_INCREMENT,
--     cDates date,
--     cTime time,
--     content varchar(1000),
--     cLike int,
--     post_id int,
--     PRIMARY key(id) 
-- );