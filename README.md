PHPGlobalWebService
===================

It contains PHP script for Select, Update, Insert and Delete from server. That will be work as Web Service for Mobile device. 

For calling this utility you need to follow below instructions:

- Need to send post request.
- Need to send below parameters with request.(Both are required parameters)
	- dbQuery
	- queryType (S,I,U,D)


Details Discription of Parameters:
1) dbQuery: in this user will pass a db query that user wants to perform.

2) queryType: in this user only return any one value from options:
  - S: When user perform *Select* query.
  - I: When user perform *Insert* query.
  - U: When user perform *Update* query.
  - D: When user perform *Delete* query.
