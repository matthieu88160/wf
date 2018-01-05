CREATE TABLE person_address (
  Personid       int(10) NOT NULL, 
  Addressid      int(10) NOT NULL, 
  Address_typeid int(10) NOT NULL, 
  PRIMARY KEY (Personid, 
  Addressid, 
  Address_typeid)
) type=InnoDB;

ALTER TABLE person_address ADD INDEX 'is shelted by' (Personid), ADD CONSTRAINT a FOREIGN KEY (Personid) REFERENCES Person (id);
ALTER TABLE person_address ADD INDEX 'has address' (Addressid), ADD CONSTRAINT c FOREIGN KEY (Addressid) REFERENCES Address (id);
ALTER TABLE Address ADD INDEX 'is in' (Townid), ADD CONSTRAINT d FOREIGN KEY (Townid) REFERENCES Town (id);
ALTER TABLE Town ADD INDEX 'located in' (Countryid), ADD CONSTRAINT e FOREIGN KEY (Countryid) REFERENCES Country (id);
ALTER TABLE person_address ADD INDEX 'is of type' (Address_typeid), ADD CONSTRAINT b FOREIGN KEY (Address_typeid) REFERENCES Address_type (id);
