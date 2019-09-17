<?php
use LeaveRequest\Request\Request;
use LeaveRequest\Controllers\ApiController;
use LeaveRequest\Controllers\EmployeeController;
use LeaveRequest\Controllers\ManagerController;
use LeaveRequest\Middleware\Auth;

use LeaveRequest\Service\EmployeeService;
use LeaveRequest\Service\ManagerService;

$router = new AltoRouter();
$auth = new Auth();
$request = new Request();

$employeeService = new EmployeeService();
$employeeController = new EmployeeController($employeeService);

$managerService = new ManagerService();
$managerController = new ManagerController($managerService);

$apiController = new ApiController($router, $request, $auth, $employeeController, $managerController);