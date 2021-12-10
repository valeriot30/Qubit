<?php


namespace App;

use Pecee\SimpleRouter\SimpleRouter as Router;
use Pecee\Http\Url;
use Pecee\Http\Response;
use Pecee\Http\Request;


class Helpers
{
    function url(string $name = null, $parameters = null, array $getParams = null): Url
    {
    return Router::getUrl($name, $parameters, $getParams);
    }

    function response(): Response
    {
        return Router::response();
    }


    function request(): Request
    {
        return Router::request();
    }


    function input($index = null, $defaultValue = null, ...$methods)
    {
        if ($index !== null) {
            return \App\request()->getInputHandler()->value($index, $defaultValue, ...$methods);
        }

        return request()->getInputHandler();
    }

    function redirect(string $url, int $code = null): void
    {
        if ($code !== null) {
            \App\response()->httpCode($code);
        }

        response()->redirect($url);
    }

    function csrf_token(): string
    {
        $baseVerifier = Router::router()->getCsrfVerifier();
        if ($baseVerifier !== null) {
            return $baseVerifier->getTokenProvider()->getToken();
        }

        return null;
    }
}