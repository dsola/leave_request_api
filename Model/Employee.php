<?php
/**
 * Created by PhpStorm.
 * User: solaing
 * Date: 07-Mar-16
 * Time: 21:05
 */

namespace LeaveRequest\Model;
use LeaveRequest\Database\QueryBuilder;

class Employee
{
    private $id;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /** Return all the leave request of the employee with the manager's checks
     *
     * @return array
     */
    public function getLeaveRequests()
    {
        return QueryBuilder::query(
            "SELECT l.title, l.date_start, l.date_end, l.comment, lc.accepted, lc.comment
              FROM leave_request l
              LEFT JOIN leave_request_checked lc ON lc.leave_request_id = l.id
              WHERE l.employee_id = :id", array(
                ":id" => $this->id
            )
        );
    }

}