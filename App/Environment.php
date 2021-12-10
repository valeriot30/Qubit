<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 02/09/2019
 * Time: 22:04
 */

namespace App
{
    use App\Qubit\Framework\Router;

    class Environment
    {
        public static function getConfig()
        {
            include __DIR__.'/Configuration/site.php';
            return $config;
        }
    }
}