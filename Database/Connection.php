<?php
namespace LeaveRequest\Database;
use RedBeanPHP\R;

class Connection
{

    static function connect($driver = "mysql", $host, $dbName, $dbUser, $dbPassword)
    {
        R::setup(
            "$driver:host=$host;dbname=$dbName",
            $dbUser,
            $dbPassword
        );
    }

    static function close()
    {
        R::close();
    }
}