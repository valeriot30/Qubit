<?php

namespace App\Qubit\Sessions;

class Cookies
{
    public static function setCookie($name, $value = null, $expire = null, $path = null, $domain = null, $secure = null, $httponly = null)
    {
        $set = setcookie($name, $value, $expire, $path, $domain, $secure, $httponly);
        return $set;
    }
    public static function getCookie($name)
    {
        if (isset($_COOKIE) && is_array($_COOKIE) && array_key_exists($name, $_COOKIE))
        {
            return $_COOKIE[$name];
        }
        return false;
    }
    public static function desroyCookie($name)
    {
        if (self::getCookie($name) != false)
        {
            setcookie($name, "", time() - 3600);
            return true;
        }
        return false;
    }
}