CREATE TABLE Person (
  id            int(10) NOT NULL AUTO_INCREMENT, 
  firstname     varchar(255) NOT NULL, 
  lastname      varchar(255) NOT NULL, 
  date_of_birth date, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id)
) type=InnoDB;

CREATE TABLE Address (
  id              int(10) NOT NULL AUTO_INCREMENT, 
  address_field_1 varchar(255) NOT NULL, 
  address_field_2 varchar(255), 
  address_field_3 varchar(255), 
  Townid          int(10) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id)
) type=InnoDB;

CREATE TABLE Country (
  id   int(10) NOT NULL AUTO_INCREMENT, 
  name varchar(255) NOT NULL, 
  CONSTRAINT id 
    PRIMARY KEY (id), 
  UNIQUE INDEX (id), 
  UNIQUE INDEX (name)
) type=InnoDB;

CREATE TABLE Address_type (
  id    int(10) NOT NULL AUTO_INCREMENT, 
  label varchar(50) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id), 
  UNIQUE INDEX (label)
) type=InnoDB;

CREATE TABLE Town (
  id          int(10) NOT NULL AUTO_INCREMENT, 
  name        varchar(255) NOT NULL, 
  postal_code varchar(255) NOT NULL, 
  Countryid   int(10) NOT NULL, 
  PRIMARY KEY (id), 
  UNIQUE INDEX (id), 
  UNIQUE INDEX (name), 
  UNIQUE INDEX (postal_code)
) type=InnoDB;
