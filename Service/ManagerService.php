<?php
namespace LeaveRequest\Service;
use LeaveRequest\Database\QueryBuilder;
use LeaveRequest\Model\LeaveRequest;
use LeaveRequest\Model\Manager;

class ManagerService
{
    public function __construct()
    {
    }

    public function getLeaveRequests($id)
    {
        $manager = new Manager($id);
        return $manager->getLeaveRequests();
    }

    public function answerLeaveRequest($id, $leaveRequestId, $accepted, $comment)
    {
        $manager = new Manager($id);
        return $manager->answerLeaveRequest($leaveRequestId, $accepted, $comment);
    }
}