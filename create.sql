create table disk(
 idDisk int AUTO_INCREMENT,
 name varchar(64),
 label varchar(64),
 size varchar(64),
 comment varchar(512), primary key(idDisk));

create table actor(
 idActor int AUTO_INCREMENT,
 firstName varchar(64),
 lastName varchar(64), primary key(idActor));
 
create table content_type(
 idContentType int AUTO_INCREMENT,
 name varchar(64), primary key(idContentType));

insert into content_type(name) values ('Film');
insert into content_type(name) values ('Série');
insert into content_type(name) values ('Dessin animé');
insert into content_type(name) values ('Manga');

create table category(
 idCategory int AUTO_INCREMENT,
 name varchar(32), primary key(idCategory));

insert into category(name) values ('Action');
insert into category(name) values ('Horreur');
insert into category(name) values ('Policier');
 
create table quality(
 idQuality int AUTO_INCREMENT,
 name varchar(32), primary key(idQuality));

insert into quality(name) values ('HD 720p');
insert into quality(name) values ('HD 1080p');
insert into quality(name) values ('DVDRIP');
insert into quality(name) values ('BDRIP');
insert into quality(name) values ('SCREEN');
insert into quality(name) values ('Autre');
insert into quality(name) values ('Refaire');

create table language(
 idLanguage int AUTO_INCREMENT,
 name varchar(32), primary key(idLanguage));

insert into language(name) values ('Vo');
insert into language(name) values ('Vostfr');
insert into language(name) values ('Fr');
insert into language(name) values ('Multi');
 
create table bundle(
	idBundle int AUTO_INCREMENT, 
	name varchar(64),
	idContentType int,primary key(idBundle));

create table content(
 idContent int AUTO_INCREMENT,
 idContentType int, 
 name varchar(128),
 search varchar(128),
 year int,
 idDisk int,
 idLanguage int,
 idQuality int, primary key(idContent) );

create table content_bundle(
 idContentBundle int AUTO_INCREMENT,
 idBundle int,
 idContent int,primary key(idContentBundle));

create table content_actor(
 idContentActor int AUTO_INCREMENT,
 idActor int,
 idContent int,primary key(idContentActor));

 create table content_category(
 idContentCategory int AUTO_INCREMENT,
 idCategory int,
 idContent int,primary key(idContentCategory));