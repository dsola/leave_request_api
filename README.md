# Leave Request API
Test Application to check my OOP skills for Digital Dimmension. Made in 

# Description

* I've created a new Entity called Department to match the employees and managers.
* Every manager and every employees are associated to one department.
* The manager can list and update only the leave request from his department.
* Employees can request his leave requests.
* Employees can register a new leave request.
* Manager can request the leave requests from the employees of his department.
* Manager can answer the leave request from employees.

## Getting started

1. Update the .env file (you can find at the root directory) and set the database connection parameters.
2. Execute the SQL Scripts (/Scripts/sql) on your DB in order to add the tables and registers.
3. You can install the composer dependencies if you want, but I've included in order to save your time.
4. If you want to make a light test you can use the employee ID 1 and the manager ID 1. There are leave request from Id 3 to 25.

## Routing
```
**These are the following routes which compose these API.**
[GET] /employees/[id]/leave_requests                  // List all the leave request from the employee
[GET] /managers/[id]/leave_requests                  // List all the leave request from the employee
[POST] /employees/[id]/leave_requests/register                  // Create a new Leave Request
Params: [title: String (obligatory), date_start: Timestamp (obligatory), date_end: Timestamp (obligatory), comment: String (obligatory)]
[PUT] /managers/[id]/leave_requests/[id]/accept                  // Accept a leave request
Params: [comment: String (obligatory)]
[PUT] /managers/[id]/leave_requests/[id]/decline                  // Decline a leave request
Params: [comment: String (obligatory)]
```

**Dependencies**

In this project I'm using two libraries but not really complex to mantain my own class structure:
 1. **ReadBeanPHP:** to make the queryBuilder faster.
 2. **AltoRouterPHP:** to make the router mapping easier and clean.

**Class Structure**

I want to explain in a few lines my class structure to resolve possible doubts:
* **Bootstrap**: these files load all the dependencies of the project and create a dependency container.
* **Controller**: the Controllers are the responsibles to recieve an HTTP request and call the service module with the obtained parameters. After that, it formats by the optained output. The ApiController is the main responsible of call the router and drive to the correct controller.
* **Database**: the Database classes are the responsibles of connecting to database and make the final queries connections.
* **Middleware**: the Middlewares perfom an action before the controller recieve the HTTP input. A perfect example is the Authorization Middleware.
* **Model**: the Models represents the logic entities of the project. It contains the attributes and the methods which communicate with database.
* **Request**: these classes make the routing job of the ApiController easier. The request allow to retrieve information about the HTTP input and the Router map the routes with the functions (Instead of use this class I've used AltoRouterPHP in order to don't waste a lot of time).
* **Service**: these classes are the responsibles to execute the business or logic part and call the models. The service communicate with controllers and recieve the input values.
* **Utils**: these classes contains static functions which are used in a lot of parts of the project.

