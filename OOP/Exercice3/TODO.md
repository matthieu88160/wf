# Exercice 3

You must create an autoloader system, in the file src/autoload.php to manage the class into the src folder. It will be automatically called by the exercice test to dynamically load the resources.

You must create a class 'Exception\NotAllowedRoleException', that extends the \RuntimeException. This exception must take, additionally to the constructor parameter, the list of allowed role label (as array) and the current unmatching label. The message of this exception MUST in every cases make an explicit reference to the allowed role label, as comma separated label list, and an explicit reference to the mismatching label.

The Model\Role class MUST be updated to throw the exception on setting a Role not contained in the constants.

To validate it, just cd into the exercice folder and run "php phpunit-6.5.5.phar".
