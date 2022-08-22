DROP DATABASE IF EXISTS uiuNewsBox;
CREATE DATABASE
IF NOT EXISTS uiuNewsBox;
USE uiuNewsBox;

create table admin
(
    id int,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100),
    phone_number varchar(50),
    primary key(id)
);

create table admin_address
(
    address varchar(100) not null,
    id int,
    foreign key(id) references admin(id)
);

create table general_user(
    id int,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100),
    phone_number varchar(50),
    primary key(id)
);

create table general_address(
    address varchar(100) not null,
    id int,
    foreign key(id) references general_user(id)
);

create table forumRep(
    id int,
    first_name varchar(50) not null,
    last_name varchar(50) not null,
    email varchar(100),
    phone_number varchar(50),
    primary key(id)
);

create table forumRep_address(
    address varchar(100) not null,
    id int,
    foreign key(id) references forumRep(id)
);

create table newsPost(
    post_id int,
    title varchar(100),
    content varchar(1000),
    likes int,
    types varchar(50),
    admin_id int,
    forum_id int,
    foreign key(admin_id) REFERENCES admin(id),
    foreign key(forum_id) REFERENCES forumRep(id)
);

