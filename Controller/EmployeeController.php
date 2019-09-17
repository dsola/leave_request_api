<?php
/**
 * Created by PhpStorm.
 * User: solaing
 * Date: 07-Mar-16
 * Time: 20:57
 */

namespace LeaveRequest\Controllers;
use LeaveRequest\Controllers\BaseController;
use LeaveRequest\Model\LeaveRequest;
use LeaveRequest\Service\EmployeeService;
use LeaveRequest\Utils\Json;

class EmployeeController extends BaseController
{
    protected $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        parent::__construct();
        $this->employeeService = $employeeService;
    }

    public function getLeaveRequests($id)
    {
        //get leave requests
        $leaveRequests = $this->employeeService->getLeaveRequests($id);

        if (count($leaveRequests) > 0)
        {
            Json::generateJSONResponse(200,
                array(
                    "leave_requests" => $leaveRequests
                )
            );
        } else {
            Json::generateJSONResponse(404,
                array(
                    "message" => "Not found"
                )
            );
        }
    }

    public function registerLeaveRequest($id, $params = array())
    {
        if (
        empty($params['title']) ||
        empty($params['date_start']) ||
        empty($params['date_end']) ||
        empty($params['comment'])
        )
        {
            Json::generateJSONResponse(400,
                array(
                    "message" => "Bad Request: Missing Parameters"
                )
            );
        } else {

            $id = $this->employeeService->registerLeaveRequest(
                $params['title'],
                $params['date_start'],
                $params['date_end'],
                $params['comment'],
                $id
            );

            if(isset($id) && $id)
            {
                Json::generateJSONResponse(200,
                    array(
                        "message" => "Leave Request successfully created",
                        "id" => $id
                    )
                );
            } else {
                Json::generateJSONResponse(500,
                    array(
                        "message" => "Error when creating Leave Request."
                    )
                );
            }
        }
    }

}