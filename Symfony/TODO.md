# Exercice 6

In this exercise, you will create a REST CRUD system to manipulate the projects. You will be allowed to use : Symfony\Component\HttpFoundation\JsonResponse

The URIs must be compliant with these specifications :

/projects:
	Method:		GET
	Parameters: []
	Response:	All not deleted and published projects into a JSON array

/project/{id}:
	Method:		GET
	Parameters: []
	Response:	The asked project as JSON

/project/{id}:
	Method:		DELETE
	Parameters: []
	Response:

/project/{id}:
	Method:		PUT
	Parameters: ['title', 'description', 'published']
	Response:

/project:
	Method:		POST
	Parameters: ['title', 'description', 'published']
	Response:	The created project as JSON
