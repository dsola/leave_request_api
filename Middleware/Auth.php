<?php
namespace LeaveRequest\Middleware;

class Auth
{
    public function __construct()
    {
    }

    public function checkAuthenticate()
    {
        //in this function we want to check the user's authentication by a supposed token
        //int this code snippet it's a good idea to apply OAuth2 protocol for example
    }

}