drop database if exists tasktracker;
create database tasktracker;
use tasktracker;

create table users (
    username char(100) primary key,
    password char(255) not null
);

create table tasks (
    username char(100) not null,
    task char(255) not null,
    start_date date not null,
    end_date date not null,
    completed bool not null,

    primary key(username, task),
    foreign key(username) references users(username)
);
