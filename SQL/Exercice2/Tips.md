# Insert element into a table

```BAKUS NAUR
INSERT [INTO] tbl_name[(col_name [, col_name] ...)]
    {VALUES | VALUE} (value_list) [, (value_list)] ...
```

# Select elements in a table

```BAKUS NAUR
SELECT select_expr [, select_expr ...]
    [FROM table_references
    [WHERE where_condition]]
```

# Select distinct elements in a table

```BAKUS NAUR
SELECT [DISTINCT] select_expr [, select_expr ...]
    [FROM table_references [WHERE where_condition]]
```

# Ordered selection of elements in a table

```BAKUS NAUR
SELECT [DISTINCT] select_expr [, select_expr ...]
    [FROM table_references [WHERE where_condition]]
    [ORDER BY {col_name} [ASC | DESC], ...]
```

# SQL Subqueries

```SQL
SELECT * FROM roles WHERE id IN (SELECT id FROM roles WHERE label = “ROLE_USER”);
```

# Aggregation function

```SQL
SELECT count(id) FROM roles;

SELECT MAX(createdAt) FROM roles;

SELECT SUM(id) FROM roles;

SELECT AVG(id) FROM roles;

SELECT id FROM roles WHERE createdAt = (SELECT MAX(createdAt) FROM roles);


# The following will not work
SELECT label, MAX(createdAt) FROM roles
```

# Grouping elements in a table

```BAKUS NAUR
SELECT [DISTINCT] select_expr [, select_expr ...]
    [FROM table_references [WHERE where_condition]]
    [ORDER BY {col_name} [ASC | DESC], ...]
    [GROUP BY {col_name}]
```

