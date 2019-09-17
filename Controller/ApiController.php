<?php
namespace LeaveRequest\Controllers;

use LeaveRequest\Request\Request;
use LeaveRequest\Middleware\Auth;
use LeaveRequest\Utils\Json;

class ApiController
{
    private $request, $auth, $router, $employeeController, $managerController;

    public function __construct(
        \AltoRouter $router,
        Request $request,
        Auth $auth,
        EmployeeController $employeeController,
        ManagerController $managerController
    )
    {
        $this->request = $request;
        $this->auth = $auth;
        //we are using a simple router library. The idea is to implement our own Router from Request/Router.class.php
        $this->router = $router;
        $this->router->setBasePath('');
        $this->employeeController = $employeeController;
        $this->managerController = $managerController;
        //check oauth
        //$auth->checkAuthenticate($token);
    }

    public function process()
    {
        //check if the uri is correct
        if (!$this->request->check()) {
            Json::generateJSONResponse(400,
                array(
                    "message" => "Bad Request"
                )
            );
        } else {
            // map employees/[{id}/leave_requests
            $this->router->map('GET', '/employees/[i:id]/leave_requests', function()
            {
                $this->employeeController->getLeaveRequests($this->request->getSecondURIFragment());
            }, 'employees/leave_requests');

            // map employees/[{id}/leave_requests/register
            $this->router->map('POST', '/employees/[i:id]/leave_requests/register', function()
            {
                $this->employeeController->registerLeaveRequest($this->request->getSecondURIFragment(), $this->request->getParams());
            }, 'employees/leave_requests/register');


            // map managers/[{id}/leave_requests
            $this->router->map('GET', '/managers/[i:id]/leave_requests', function()
            {
                $this->managerController->getLeaveRequests(
                    $this->request->getSecondURIFragment(),
                    $this->request->getFourthURIFragment(),
                    $this->request->getParams()
                );
            },'managers/leave_requests');

            // map managers/[{id}/leave_requests/{leaveId]/accept
            $this->router->map('PUT', '/managers/[i:id]/leave_requests/[i:leaveId]/accept', function()
            {
                $this->managerController->acceptLeaveRequest(
                    $this->request->getSecondURIFragment(),
                    $this->request->getFourthURIFragment(),
                    $this->request->getParams()
                );
            },'managers/leave_requests/accept');

            // map managers/[{id}/leave_requests/{leaveId]/decline
            $this->router->map('PUT', '/managers/[i:id]/leave_requests/[i:leaveId]/decline', function()
            {
                $this->managerController->declineLeaveRequest(
                    $this->request->getSecondURIFragment(),
                    $this->request->getFourthURIFragment(),
                    $this->request->getParams()
                );
            },'managers/leave_requests/decline');

            // match current request url
            $match = $this->router->match();
            // call closure or throw 404 status
            if($match && is_callable($match['target']))
            {
                call_user_func_array($match['target'], $match['params']);
            } else {
                // no route was matched
                Json::generateJSONResponse(404,
                    array(
                        "message" => "Not Found."
                    )
                );
            }
        }
    }
}