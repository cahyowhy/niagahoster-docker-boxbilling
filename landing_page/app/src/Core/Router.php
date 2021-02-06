<?php

namespace NiagahosterTest\Core;

use \Closure;

class Router
{
    public $path;
    public $method;
    public $body;
    public $params;
    public $request;
    public $routes = [];

    public function __construct($request)
    {
        $this->path = $request['REQUEST_URI'];
        if (!empty($request['QUERY_STRING'])) {
            $this->path = str_replace($request['QUERY_STRING'], '', $this->path);

            if (strpos($this->path, '?')) {
                $this->path = str_replace('?', '', $this->path);
            }
        }

        $this->method = basename($request['REQUEST_METHOD']);
        $this->params = array_merge($_POST, $_GET);
        $this->body = @file_get_contents('php://input');
        $this->request = $request;
    }

    public function addRoute($uri, $method, Closure $fn)
    {
        array_push(
            $this->routes,
            array("path" => $uri, "method" => $method, "fn" => $fn)
        );
    }

    public function hasRoute($uri)
    {
        $found = -1;
        $index = 0;
        foreach ($this->routes as $routes) {
            if ($this->method == $routes['method']) {
                if (strpos($routes['path'], ':')) {
                    $toListPath = function ($param) {
                        return array_values(array_filter(explode('/', $param), function ($item) {
                            return !empty($item);
                        }));
                    };

                    $listPath = $toListPath($routes['path']);
                    $listUri = $toListPath($uri);
                    $valid = count($listPath) == count($listUri);

                    if ($valid) {
                        foreach ($listPath as $idx => $value) {
                            $idxCount = $idx + 1;

                            if ($idxCount % 2 == 0 && $valid) {
                                $key = str_replace(":", "", $value);
                                $valueUri = $listUri[$idx];
                                $newParams = [];
                                $newParams[$key] = $valueUri;

                                $this->params = array_merge($this->params, $newParams);
                            } else if ($idxCount % 2 != 0) {
                                $valid = $value == $listUri[$idx];
                            }

                            if (!$valid) break;
                        }

                        if ($valid) {
                            $found = $index;
                            break;
                        }
                    }
                } else {
                    if ($routes['path'] == $uri) {
                        $found = $index;
                        break;
                    }
                }
            }

            $index += 1;
        }

        return $found;
    }

    public function run()
    {
        $urlPath = $this->path;

        if (strpos($urlPath, '/src/')) {
            http_response_code(404);
        }

        $index = $this->hasRoute($urlPath);

        if ($index > -1) {
            $this->routes[$index]["fn"]->call($this);
        } else {
            http_response_code(404);
        }
    }
}
