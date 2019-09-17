<?php
/**
 * Created by PhpStorm.
 * User: solaing
 * Date: 07-Mar-16
 * Time: 21:05
 */

namespace LeaveRequest\Model;


use LeaveRequest\Database\QueryBuilder;
use DateTime;

class LeaveRequest
{
    private $title, $dateStart, $dateEnd, $comment, $employeeId;

    public function __construct($title = null, $dateStart = null, $dateEnd = null, $comment = null, $employeeId = null)
    {
        if (!empty($title)) $this->title = $title;
        if (!empty($dateStart)) $this->dateStart = $dateStart;
        if (!empty($dateEnd)) $this->dateEnd = $dateEnd;
        if (!empty($comment)) $this->comment = $comment;
        if (!empty($employeeId)) $this->employeeId = $employeeId;
    }


    /** This function creates a new leave Request
     *
     * @return integer - The ID of the inserted row
     */
    public function create()
    {
        $dateStart = new DateTime("@" . $this->dateStart);
        $dateEnd =  new DateTime("@" . $this->dateEnd);
        return QueryBuilder::insert(
            "leave_request",
            array(
                "id" => "NULL",
                "title" => "'" . $this->title . "'",
                "date_start" =>  "'" . $dateStart->format("Y-m-d H:i:s") . "'",
                "date_end" =>  "'" . $dateEnd->format("Y-m-d H:i:s") . "'",
                "comment" => "'" . $this->comment . "'",
                "employee_id" => $this->employeeId,
            )
        );
    }

}