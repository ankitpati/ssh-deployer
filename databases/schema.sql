drop database if exists sshdeployer;
create database sshdeployer;
use sshdeployer;

create table users (
    username char(100) primary key,
    password char(255) not null
);
