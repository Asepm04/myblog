-- Active: 1704899309520@@127.0.0.1@3306@shoppeme
create database myblog;
use myblog;

create table categories 
(
    id int(10) not null primary key,
    name varchar(20) not null,
    alamat VARCHAR(20) not null
);

select * from categories;
alter table categories add date_at datetime  null;

create table counters(
    id int(10) primary key not null,
    counter varchar(10) not null
) engine innodb;


select * from counters;
drop TABLE counters;
drop table categories;
show tables;

desc counters;

desc categoriess;

select * from categoriess;

create table categoriess (Nik varchar(100) PRIMARY key,Nama varchar(200),Descriptions text(200) );

drop table category;
