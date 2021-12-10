<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 08/04/2020
 * Time: 11:59
 */


namespace App\Qubit
{
    use App\Qubit\Framework\Router;

    class Routes
    {
        public function start()
        {
            $router = new Router();

            $router->setNamespace('App\Pattern\Controllers');

            $router->get('/', 'Main@index');
            $router->get('/register', 'Register@index');

            $router->start();
        }
    }
}