<?php
/**
 * Created by PhpStorm.
 * User: solaing
 * Date: 07-Mar-16
 * Time: 21:05
 */

namespace LeaveRequest\Model;


use LeaveRequest\Database\QueryBuilder;

class Manager
{
    private $id;

    public function __construct($id = null)
    {
        if (!empty($id)) $this->id = $id;
    }

    /** Returns all the leave requests from the all employees of the department where the manager comes from
     *
     * @return array
     */
    public function getLeaveRequests()
    {
        return QueryBuilder::query(
            "SELECT l.title, l.date_start, l.date_end, l.comment, lc.accepted, lc.comment
              FROM leave_request l
              INNER JOIN employee e ON e.id = l.employee_id AND e.department_id = (SELECT department_id FROM manager WHERE manager.id = :id)
              LEFT JOIN leave_request_checked lc ON lc.leave_request_id = l.id", array(
                ":id" => $this->id
            )
        );
    }

    /** Answer a Leave Request from an employee from his department
     *
     * @param int $leaveRequestId Id of the leave request
     * @param int $accepted 0 or 1 depending if it's accepted or not
     * @param string $comment a comment of the answer
     *
     * @return int Error Code (-1: leave request not found or -2: leave request answered for another manager)
     */
    public function answerLeaveRequest($leaveRequestId, $accepted, $comment)
    {
        //check if this leave request corresponds with this manager
        $leaveRequest = QueryBuilder::query(
            'SELECT l.* FROM leave_request l
              INNER JOIN employee e ON e.id = l.employee_id AND
              e.department_id = (SELECT department_id FROM manager WHERE manager.id = :id) WHERE l.id = :leaveId',
            [':id' => $this->id, ':leaveId' => $leaveRequestId]
        );

        if (count($leaveRequest) <= 0)
        {
            return -1;
        }

        //check if this leave request has been checked before
        $leaveRequestChecked = QueryBuilder::row(
            "*",
            "leave_request_checked",
            "manager_id = :id AND leave_request_id = :leaveId",
            [':id' => $this->id, ':leaveId' => $leaveRequestId]
        );

        if (count($leaveRequestChecked) > 0)
        {
            //if exists, update
            QueryBuilder::update(
                "leave_request_checked",
                "manager_id = " . $this->id . " AND leave_request_id = $leaveRequestId",
                array(
                    "accepted" => $accepted,
                    "comment" => "'" . $comment . "'"
                )
            );
            return 1;
        } else {
            ///check if this leave request has been checked before
            $leaveRequestChecked = QueryBuilder::row(
                "*",
                "leave_request_checked",
                "leave_request_id = :leaveId",
                [':leaveId' => $leaveRequestId]
            );

            if (count($leaveRequestChecked) > 0)
            {
                return -2;
            }
            //if it's the first time that has been checked, answer
            QueryBuilder::insert(
                "leave_request_checked",
                array(
                    "leave_request_id" => $leaveRequestId,
                    "manager_id" => $this->id,
                    "accepted" => $accepted,
                    "comment" => "'" . $comment . "'"
                )
            );
            return 1;
        }
    }

}