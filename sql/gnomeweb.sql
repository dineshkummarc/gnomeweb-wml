CREATE TABLE projects (
	name VARCHAR PRIMARY KEY NOT NULL,
	description TEXT,
	parent_name VARCHAR,
	parent_name FOREIGN KEY projects (name),
	contact VARCHAR,
	url VARCHAR
);

CREATE TABLE screenshots (
	img_url VARCHAR,
# bool
	approved TINYINT,
	submitter VARCHAR,
	submitter FOREIGN KEY users (username),
	projects_shown TEXT
);
