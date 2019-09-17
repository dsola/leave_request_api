<?php
namespace LeaveRequest\Service;
use LeaveRequest\Model\Employee;
use LeaveRequest\Model\LeaveRequest;
use LeaveRequest\Database\QueryBuilder;

/**
 * Class EmployeeService
 * @package LeaveRequest\Service
 */
class EmployeeService
{
    public function __construct()
    {
    }

    public function getLeaveRequests($id)
    {
        $employee = new Employee($id);
        return $employee->getLeaveRequests();
    }

    public function registerLeaveRequest($title, $dateStart, $dateEnd, $comment, $employeeId)
    {
        $leaveRequest = new LeaveRequest(
            $title,
            $dateStart,
            $dateEnd,
            $comment,
            $employeeId
        );
        return $leaveRequest->create();
    }

}