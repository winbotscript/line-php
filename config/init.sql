create database linedb character set utf8 collate utf8_general_ci;

create table user (id mediumint unsigned not null auto_increment primary key, name varchar(255) not null unique, email varchar(255) not null unique, password varchar(255) not null);

create table friend (id int unsigned not null auto_increment primary key, user_id int unsigned not null, selected_id int unsigned not null, name varchar(255) not null);

create table talk (id int unsigned not null primary key, user_id int unsigned not null, friend_id int unsigned not null, text text not null, time time not null);

create table post (user_name varchar(255) not null, text text not null);
