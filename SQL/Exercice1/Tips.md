# Create a database

```BAKUS NAUR
CREATE {DATABASE | SCHEMA} [IF NOT EXISTS] db_name
    [create_specification] ...

create_specification:
    [DEFAULT] CHARACTER SET [=] charset_name
  | [DEFAULT] COLLATE [=] collation_name
```
  
# Select a database

``` SQL
USE db_name;
```

# Create a table

```BAKUS NAUR
CREATE TABLE tbl_name (create_definition,...)

create_definition: col_name column_definition

column_definition:
    data_type [NOT NULL | NULL] [DEFAULT default_value]
      [AUTO_INCREMENT] [[PRIMARY] KEY] [COMMENT 'string']

data_type:
  TINYINT[(length)] [UNSIGNED] [ZEROFILL]
  | INT[(length)] [UNSIGNED] [ZEROFILL]
  | DOUBLE[(length,decimals)] [UNSIGNED] [ZEROFILL]
  | FLOAT[(length,decimals)] [UNSIGNED] [ZEROFILL]
  | DATETIME[(fsp)]
  | VARCHAR(length) [CHARACTER SET charset_name] [COLLATE collation_name]
```
