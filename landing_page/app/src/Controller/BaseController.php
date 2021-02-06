<?php

namespace NiagahosterTest\Controller;

class BaseController
{
    public $allowed_fields;

    public $params;

    public $body;

    public $method;

    public function __construct($method, $params, $body)
    {
        header('Content-type: application/json');

        $this->method = $method;
        $this->params = array_intersect_key($params, array_flip($this->allowed_fields));
        $this->body =  json_decode($body, true);
    }
}
