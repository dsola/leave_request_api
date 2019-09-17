<?php

namespace LeaveRequest\Request;

class Request
{
    private $urlElements;
    private $verb;
    private $parameters;
    private $format;

    public function __construct()
    {
        $this->verb = $_SERVER['REQUEST_METHOD'];
        if (isset($_SERVER['REQUEST_URI'])) $this->urlElements = explode('/', $_SERVER['REQUEST_URI']);
        $this->_parseIncomingParams();
        // initialise json as default format
        $this->format = 'json';
        if(isset($this->parameters['format'])) {
            $this->format = $this->parameters['format'];
        }
        return true;
    }

    public function check()
    {
        return (!empty($this->urlElements) && count($this->urlElements) >= 2);
    }

    public function getParams()
    {
        if (isset($this->parameters))
        {
            return $this->parameters;
        } else return false;
    }

    public function getMethod()
    {
        if (isset($this->verb))
        {
            return $this->verb;
        } else return false;
    }

    public function getFirstURIFragment()
    {
        return $this->urlElements[1];
    }

    public function getSecondURIFragment()
    {
        return $this->urlElements[2];
    }

    public function getThirdURIFragment()
    {
        return $this->urlElements[3];
    }

    public function getFourthURIFragment()
    {
        return $this->urlElements[4];
    }

    private function _parseIncomingParams()
    {
        $parameters = array();

        // first of all, pull the GET vars
        if (isset($_SERVER['QUERY_STRING']))
        {
            parse_str($_SERVER['QUERY_STRING'], $parameters);
        }

        // now how about PUT/POST bodies? These override what we got from GET
        $body = file_get_contents("php://input");

        $content_type = false;
        if(isset($_SERVER['CONTENT_TYPE']))
        {
            $content_type = $_SERVER['CONTENT_TYPE'];
        }

        switch($content_type)
        {
            case "application/json":
                $body_params = json_decode($body);
                if($body_params) {
                    foreach($body_params as $param_name => $param_value) {
                        $parameters[$param_name] = $param_value;
                    }
                }
                $this->format = "json";
                break;

            case "application/x-www-form-urlencoded":
                parse_str($body, $postvars);
                foreach($postvars as $field => $value) {
                    $parameters[$field] = $value;

                }
                $this->format = "html";
                break;

            default:
                //check if coming from a post with not encrypted URL
                if (strstr($content_type, "form-data"))
                {
                    $postvars = $_POST;
                    foreach($postvars as $field => $value) {
                        $parameters[$field] = $value;
                    }
                    $this->format = "html";
                }
                break;
        }
        $this->parameters = $parameters;
    }
}