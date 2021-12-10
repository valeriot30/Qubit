<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 03/09/2019
 * Time: 21:15
 */

use App\Helpers;

require dirname(__DIR__).'/App/Application.php';
require  dirname(__DIR__).'/vendor/autoload.php';

session_start();
error_reporting(E_ALL);
ini_set('display_errors','On');

$app = new \App\Application();

$app->init();

$routes = new \App\Qubit\Routes();

$routes->start();
