create table projects (project_id varchar(64) not null,
primary key (project_id),
project_name varchar(64),
description text,
parent_id varchar(64),
contact varchar(255) not null,
url varchar(255) not null);

#CREATE TABLE projects (
#	name VARCHAR PRIMARY KEY NOT NULL,
#	description TEXT,
#	parent_name VARCHAR,
#	parent_name FOREIGN KEY projects (name),
#	contact VARCHAR,
#	url VARCHAR
#);

CREATE TABLE screenshots (
	img_url VARCHAR,
# bool
	approved TINYINT,
	submitter VARCHAR,
	submitter FOREIGN KEY users (username),
	projects_shown TEXT
);
