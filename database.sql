Create database instashare;

Create table users (
	uid int(100) AUTO_INCREMENT primary key,
	username varchar(100),
	fname varchar(100),
	lname varchar(100),
	email varchar(100),
	password varchar(100),
	verified int(1),
	hash varchar(500)
);

Create table uploads (
	uid int(100) AUTO_INCREMENT primary key,
	username varchar(100),
	tags varchar(100),
	image varchar(255),
	uploadDate DATE
);

CREATE table download (
	pid int(100) AUTO_INCREMENT primary key,
	image varchar(255),
	count int(100)
);

CREATE table hashtagCount (
	pid int(100) AUTO_INCREMENT primary key,
	hashtag varchar(255),
	count int(100)
);