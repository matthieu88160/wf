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

CREATE TABLE person_address (
  Personid       int(10) NOT NULL, 
  Addressid      int(10) NOT NULL, 
  Address_typeid int(10) NOT NULL, 
  PRIMARY KEY (Personid, 
  Addressid, 
  Address_typeid)
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
  
ALTER TABLE person_address ADD INDEX a (Personid), ADD CONSTRAINT a FOREIGN KEY (Personid) REFERENCES Person (id);
ALTER TABLE person_address ADD INDEX c (Addressid), ADD CONSTRAINT c FOREIGN KEY (Addressid) REFERENCES Address (id);
ALTER TABLE Address ADD INDEX d (Townid), ADD CONSTRAINT d FOREIGN KEY (Townid) REFERENCES Town (id);
ALTER TABLE Town ADD INDEX e (Countryid), ADD CONSTRAINT e FOREIGN KEY (Countryid) REFERENCES Country (id);
ALTER TABLE person_address ADD INDEX b (Address_typeid), ADD CONSTRAINT b FOREIGN KEY (Address_typeid) REFERENCES Address_type (id);
