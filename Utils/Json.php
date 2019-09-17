<?php
/**
 * Created by PhpStorm.
 * User: solaing
 * Date: 07-Mar-16
 * Time: 19:33
 */

namespace LeaveRequest\Utils;


class Json
{

    /** Format a JSON Response and put the desired HTTP Status Code
     *
     * @param int $code The status HTTP code
     * @param string|array $content The content to transform in json format
     * @return bool
     */
    public static function generateJSONResponse($code, $content)
    {
        header('Content-Type: application/json; charset=utf8');
        http_response_code($code);
        echo json_encode($content);
        return true;
    }

}