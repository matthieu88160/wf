# Exercice 1

In this exercice we will create a new database named `test`, and add a table named `roles` to this database.

The `roles` table will have three columns :
 * An `id` column, as positive integer to be used as primary key.
 * A `createdAt` column to automatically store the date of creation of the element.
 * A `label` column where we will store the role name

The `id` column will be automatically incremented to avaoid need of select lastest id.  