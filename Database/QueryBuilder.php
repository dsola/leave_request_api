<?php

namespace LeaveRequest\Database;
use RedBeanPHP\R;
use RedBeanPHP\RedException;

class QueryBuilder
{
    public static function select($fields, $from, $condition, $params = array())
    {
        try
        {
            return R::getAll("SELECT $fields FROM $from WHERE $condition",$params);
        }
        catch(RedException $e)
        {
            print "DB Select Exception: " . $e->getMessage();
            exit();
        }
    }

    public static function row($fields, $from, $condition, $params = array())
    {
        try
        {
            return R::getRow("SELECT $fields FROM $from WHERE $condition",$params);
        }
        catch(RedException $e)
        {
            print "DB Select Row Exception: " . $e->getMessage();
            exit();
        }
    }

    public static function query($query, $params = array())
    {
        try
        {
            return R::getAll($query,$params);
        }
        catch(RedException $e)
        {
            print "DB Query Exception: " . $e->getMessage();
            exit();
        }
    }

    public static function insert($table, $values = array())
    {
        try
        {
            R::exec("INSERT INTO $table VALUES(" . implode(',', $values) . ")");
            //return the insert ID
            return R::getInsertID();
        }
        catch(RedException $e)
        {
            print "DB Insert Exception: " . $e->getMessage();
            exit();
        }

    }

    public static function update($table, $where,  $values = array())
    {
        try
        {
            $params = "";
            foreach($values as $key => $value)
            {
                if ($params != "") $params .= ",";
                $params .= "$key = $value";
            }
            R::exec("UPDATE $table SET $params WHERE $where");
        }
        catch(RedException $e)
        {
            print "DB Update Exception: " . $e->getMessage();
            exit();
        }
    }

    public static function delete()
    {

    }

}