CREATE TABLE categories (
  id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name varchar(200) NOT NULL
);

CREATE TABLE dishes (
  id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name varchar(100) NOT NULL,
  price decimal(10,0) NOT NULL,
  category int NOT NULL,
  photo varchar(200) NOT NULL,
  ingredients text NOT NULL,
  country varchar(200) NOT NULL,
  quantity int NOT NULL,
  CONSTRAINT FOREIGN KEY (category) REFERENCES categories (id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE users (
  id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  name varchar(50) NOT NULL,
  surname varchar(50) NOT NULL,
  patronymic varchar(50) NOT NULL,
  login varchar(50) NOT NULL UNIQUE,
  email varchar(200) NOT NULL UNIQUE,
  password varchar(200) NOT NULL,
  is_admin boolean NOT NULL default false
);

CREATE TABLE cart (
  id int AUTO_INCREMENT NOT NULL PRIMARY KEY,
  user_id int,
  dish_id int,
  CONSTRAINT UNIQUE (user_id,dish_id),
  CONSTRAINT FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT FOREIGN KEY (dish_id) REFERENCES dishes (id) ON DELETE CASCADE ON UPDATE CASCADE
);
