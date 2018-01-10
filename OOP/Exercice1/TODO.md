# Exercice 1

To represent some records in the database, the goal of this exercise is to create two classes.

A class Person
 * Into the namespace Model
 * With the following properties :
 	* id			a private property
 	* firstname		a protected property
 	* lastname		a protected property
 	* emails		a protected property
 * The property "emails" must be initialized as empty array
 * With the following public methods :
 	* getId()		return the stored id
 	* getFirstname  return the stored firstname
 	* getLastname	return the stored lastname
 	* getEmails	  	return the stored emails
 	* setFirstname	set up the stored firstname
 	* setLastname	set up the stored lastname
 	* setEmails	set up the stored emails


A class User
 * Into the namespace Model
 * With the following properties :
 	* id			a private property
 	* roles			a protected property
 	* password		a protected property
 	* salt			a protected property
 	* username		a protected property
 * The property "roles" must be initialized as empty array
 * With the following public methods :
 	* getId()			return the stored id
 	* getRoles			return the stored roles
 	* getPassword		return the stored password
 	* getSalt			return the stored salt
 	* getUsername		return the stored username
 	* setRoles			set up the stored roles
 	* setPassword		set up the stored password
 	* setSalt			set up the stored salt
 	* setUsername		set up the stored username
 	* eraseCredentials	Erase stored salt and password data

The files must be created into the "src" folder.

To validate it, just cd into the exercice folder and run "php phpunit-6.5.5.phar".
 	