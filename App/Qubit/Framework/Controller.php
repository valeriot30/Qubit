<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 07/09/2019
 * Time: 15:11
 */

namespace App\Qubit\Framework;


abstract class Controller
{
    protected $route_params = [];

    public function __construct($params = [])
    {
        $this->view = new View();
    }

    public function start() {

    }

    public function getMethod() {
        $method = $_SERVER['REQUEST_METHOD'];

        if ($_SERVER['REQUEST_METHOD'] == 'HEAD') {
            ob_start();
            $method = 'GET';
        }
        elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $headers = $this->getRequestHeaders();
            if (isset($headers['X-HTTP-Method-Override']) && in_array($headers['X-HTTP-Method-Override'], array('PUT', 'DELETE', 'PATCH'))) {
                $method = $headers['X-HTTP-Method-Override'];
            }
        }

        return $method;
    }
}