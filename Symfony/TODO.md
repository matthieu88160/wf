# Exercice 5

In this exercise, using 'make' and 'doctrine', you will create a new database and an entity 'Project'.

The 'Project' entity will represent the following table definition :
 * id 			auto incremental primary key
 * name			the name of the project
 * description 	the description of the project
 * createdAt	the project date of insertion
 * published	a publication status, true or false
 * deleted		a deletion state, take precedence on published, true or false
