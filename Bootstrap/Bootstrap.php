<?php
//this file requires all files and define all instances
//dependencies
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../Request/Request.php';
//middlewares
require_once __DIR__ . '/../Middleware/Auth.php';
//controllerss
require_once __DIR__ . '/../Controller/ApiController.php';
require_once __DIR__ . '/../Controller/BaseController.php';
require_once __DIR__ . '/../Controller/EmployeeController.php';
require_once __DIR__ . '/../Controller/ManagerController.php';
//services
require_once __DIR__ . '/../Service/EmployeeService.php';
require_once __DIR__ . '/../Service/LeaveRequestService.php';
require_once __DIR__ . '/../Service/ManagerService.php';
require_once __DIR__ . '/../Service/DepartmentService.php';
//models
require_once __DIR__ . '/../Model/Model.php';
require_once __DIR__ . '/../Model/Department.php';
require_once __DIR__ . '/../Model/Employee.php';
require_once __DIR__ . '/../Model/LeaveRequest.php';
require_once __DIR__ . '/../Model/Manager.php';
//database
require_once __DIR__ .'/../Database/Connection.php';
require_once __DIR__ .'/../Database/QueryBuilder.php';
//utils
require_once __DIR__ . '/../Utils/Json.php';

