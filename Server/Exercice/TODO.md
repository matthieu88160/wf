# Exercice 3

To perform the CSRF token validation, it's necessary to store this token between requests. Using the session management of PHP, store a set of generated CSRF token to be further validated.

Take care about the fact a client can request multiple forms or CRSF tokens and apply them after a time.

You must keep in mind the server usage to scale the session storage weight.
