USE todo;

CREATE TABLE todo_items (

id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
creation_time TIMESTAMP,
update_time TIMESTAMP,
short_desc CHAR(40) NOT NULL,
long_desc TEXT NOT NULL,

project_name CHAR(40) NOT NULL,
project_url CHAR(60),

contact_name CHAR(40) NOT NULL,
contact_mail CHAR(40) NOT NULL,

required_skill TINYINT NOT NULL,
required_familiarity TINYINT NOT NULL,

category ENUM('application','core','ui','docs','translation','graphics','web','other'),
importance ENUM('casual','medium','high','severe'),
status ENUM('new','interest','work','closed')

);
