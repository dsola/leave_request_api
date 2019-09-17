<?php
//autoload files
require_once __DIR__ . '/Bootstrap/Bootstrap.php';
//get environment constants
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();
//connect to database
\LeaveRequest\Database\Connection::connect(
    "mysql",
    getenv('DB_HOST'),
    getenv('DB_DATABASE'),
    getenv('DB_USER'),
    getenv('DB_PASSWORD')
);
//create dependency container
require_once __DIR__ . '/Bootstrap/DependencyContainer.php';
//routing to requested controller
$apiController->process();
//close database connection
RedBeanPHP\R::close();