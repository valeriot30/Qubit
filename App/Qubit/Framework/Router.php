<?php
/**
 * Created by PhpStorm.
 * User: Valerio Triolo
 * Date: 04/09/2019
 * Time: 21:46
 */

namespace App\Qubit\Framework
{

    use ReflectionMethod;

    class Router
    {
        private $routes = [];
        private $params = [];

        private $namespace;

        private $base = '/';

        public function __construct()
        {

        }

        public function setNamespace($namespace)
        {
            $this->namespace = $namespace;
        }

        public function put($route, $func, $method = 'PUT')
        {

        }

        public function get($route, $func, $method = 'GET')
        {
            $this->add($route, $func, 'GET');
        }

        public function post($route, $func, $method = 'POST')
        {
            $this->add($route, $func, 'POST');
        }

        public function start()
        {
            $requestMethod = (
                isset($_POST['_method'])
                && ($_method = strtoupper($_POST['_method']))
                && in_array($_method, array('GET', 'POST'), true)
            ) ? $_method : $_SERVER['REQUEST_METHOD'];

            $url = $_SERVER['REQUEST_URI'];

            if (($pos = strpos($url, '?')) !== false) {
                $url = substr($url, 0, $pos);
            }

            if(isset($_POST)) {
                $this->params[] = json_decode(file_get_contents('php://input'), true);
            }

            return $this->match($url, $requestMethod);
        }

        public function add($route, $func, $method)
        {
            $params = [];

            array_push($this->routes, [
                'path' => $route,
                'method' => $method,
                'exec' => $func
            ]);
        }

        public function match($url, $method): void
        {
            foreach ($this->routes as $route) {

                if ($route['path'] == $url) {
                    if (is_callable($route['exec'])) {
                        $args = func_get_args();
                        call_user_func($route['exec']);
                    }
                    $params = [];

                    if (preg_match_all('/:([\w-%]+)/', $url, $argument_keys)) {
                        $argument_keys = $argument_keys[1];

                        if (!empty($argument_keys)) {
                            continue;
                        }
                        foreach ($argument_keys as $key => $name) {
                            if (isset($matches[$key + 1])) {
                                $params[$name] = $matches[$key + 1];
                            }
                        }
                    }

                    if (is_string($route['exec'])) {
                        $action = explode("@", $route['exec']);
                        $className = $this->namespace . '\\' . $action[0];

                        $controller = new $className();

                        call_user_func_array([$controller, $action[1]], $params);


                    }
                }

            }
        }
        public function getNamespace() {
            return $this->namespace;
        }

        public function setBase($base) {

        }
    }
}