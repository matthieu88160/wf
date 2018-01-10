# Exercice 2

You must create a new class Model\Role with the following properties :
 * id			a private property
 * label		a protected property

The Role class must also own the following constant :
 * ROLE\_USER	a public constant with 'ROLE\_USER' as value
 * ROLE\_ADMIN	a public constant with 'ROLE\_ADMIN' as value

The Role class must own a constructor that allow to define the label as argument.
 
The Role class must implement "getter" for properties, and "setter" for label

The user class must be updated in several way :
 * The roles property must only contain Role instances
 * The getRoles() method must return a set of Role labels and not a set of Roles
 * The getRoles() method must allays return the 'ROLE\_USER' in the set of roles
 * A method "addRole" must be added 

To validate it, just cd into the exercice folder and run "php phpunit-6.5.5.phar".
