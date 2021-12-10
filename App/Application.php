<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 03/09/2019
 * Time: 21:21
 */

namespace App
{

    use App\Qubit\Framework\Router;
    use App\Environment;

    class Application
    {
        private $config = [];

        public function __construct()
        {

        }

        private function load()
        {
            spl_autoload_register(function($class) {
                require '../' . str_replace('\\', '/', $class) . '.php';
            });
       }
       private function db()
       {
           $db = new Qubit\Database\DB();
           return $db;
       }
       private function config()
       {
            if(file_exists(__DIR__.'/Configuration/site.php'))
            {
                require __DIR__.'/Configuration/site.php';
            }
            else
            {
                die('Configuration file not found');
            }
       }
       public function init()
       {
           $this->config();
           $this->load();
           $this->db();
       }
    }
}