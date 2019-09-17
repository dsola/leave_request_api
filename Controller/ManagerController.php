<?php

namespace LeaveRequest\Controllers;
use LeaveRequest\Controllers\BaseController;
use LeaveRequest\Service\ManagerService;
use LeaveRequest\Utils\Json;

class ManagerController extends BaseController
{
    protected $managerService;

    public function __construct(ManagerService $managerService)
    {
        $this->managerService = $managerService;
    }

    public function getLeaveRequests($id)
    {
        //get leave requests
        $leaveRequests = $this->managerService->getLeaveRequests($id);
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
                    "message" => "Not Found"
                )
            );
        }
    }

    public function acceptLeaveRequest($id, $leaveRequestId, $params)
    {
        if (empty($params) || empty($params['comment']))
        {
            Json::generateJSONResponse(400,
                array(
                    "message" => "Bad Request"
                )
            );
        } else {
            $comment = $params['comment'];
            if ($error = $this->managerService->answerLeaveRequest($id, $leaveRequestId, 1, $comment) > 0) {
                Json::generateJSONResponse(200,
                    array(
                        "message" => "The request has been accepted."
                    )
                );

            } else {
                $this->_handleAnswerLeaveRequestErrors($error);
            }
        }
    }

    public function declineLeaveRequest($id, $leaveRequestId, $params)
    {
        if (empty($params) || empty($params['comment']))
        {
            Json::generateJSONResponse(400,
                array(
                    "message" => "Bad Request"
                )
            );
        } else {
            $comment = $params['comment'];
            if ($error = $this->managerService->answerLeaveRequest($id, $leaveRequestId, 0, $comment) > 0)
            {
                Json::generateJSONResponse(200,
                    array(
                        "message" => "The request has been declined."
                    )
                );

            } else {
                $this->_handleAnswerLeaveRequestErrors($error);
            }
        }
    }

    private function  _handleAnswerLeaveRequestErrors($error)
    {
        if ($error == -1)
        {
            Json::generateJSONResponse(403,
                array(
                    "message" => "Sorry but the request comes from another department."
                )
            );
        } elseif ($error == -2)
        {
            Json::generateJSONResponse(403,
                array(
                    "message" => "Sorry but the request has been answered for other manager."
                )
            );
        }
    }
}