create database board;
create table board.users(
      id int not null auto_increment primary key,
      email varchar(255) unique,
      password varchar(255),
      created timestamp not null default current_timestamp
);
create table board.posts(
      id int not null auto_increment primary key,
      parentId int,
      email varchar(255),
      imagePath varchar(255),
      message varchar(420),
      created timestamp not null default current_timestamp
);
create user  boardMaintainer@localhost identified by 'board';
grant all on board.* to boardMaintainer@localhost identified by 'board';
