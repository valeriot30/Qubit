<?php

namespace App\Qubit\Sessions
{

    use App\Qubit\Cryptography\Hashing;

    class Session
    {
        protected $proxies = []; // todo check proxies

        public static function start($name, $limit = 0, $path = '/', $domain = null, $secure = null)
        {
            session_name($name);

            if(isset($_SESSION['token']))
            {
                self::generateCSFRToken();
            }

            $https = isset($secure) ? $secure : isset($_SERVER['HTTPS']);

            session_set_cookie_params($limit, $path, $domain, $https, true);
            session_start();

            if(self::validateSession())
            {
                if(!self::preventHijacking())
                {
                    $_SESSION = array();
                    $_SESSION['IPaddress'] = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                        ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
                    $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
                    self::regenerateSession();


                }elseif(rand(1, 100) <= 5){
                    self::regenerateSession();
                }
            }else{
                $_SESSION = array();
                session_destroy();
                session_start();
            }
        }
        /**
         * @return bool
         */
        public static function validateSession(): boolean // ritorna un booleano
        {
            if( isset($_SESSION['OBSOLETE']) && !isset($_SESSION['EXPIRES']) )
                return false;

            if(isset($_SESSION['EXPIRES']) && $_SESSION['EXPIRES'] < time())
                return false;

            return true;
        }
        public static function validateCSFR(): boolean
        {
            if(!isset($_SESSION['token']) || !isset($_SESSION['token_time'])){
                return false;
            }
            else if(isset($_SESSION['token']) && !isset($_SESSION['token_time'])){
                return false;
            }
            else if($_SESSION['token_time'] < time()) {
                // session csfr time has expired, generate new
                return false;
            }

            return true;

        }
        public static function generateCSFRToken()
        {
            if(!isset($_SESSION['token']))
            {
                $_SESSION['token'] = md5(bin2hex(Hashing::random()));
                $_SESSION['token_time'] = time();
            }
        }
        public static function preventHijacking()
        {
            if(!isset($_SESSION['IPaddress']) || !isset($_SESSION['userAgent']))
                return false;

            if( $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']
                && !( strpos($_SESSION['userAgent'], ÔTridentÕ) !== false
                    && strpos($_SERVER['HTTP_USER_AGENT'], ÔTridentÕ) !== false))
            {
                return false;
            }

            $sessionIpSegment = substr($_SESSION['IPaddress'], 0, 7);

            $remoteIpHeader = isset($_SERVER['HTTP_X_FORWARDED_FOR'])
                ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];

            $remoteIpSegment = substr($remoteIpHeader, 0, 7);

            if( $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT'])
                return false;

            return true;
        }
        public static function destroySession($name)
        {
            if(!isset($_SESSION[$name]))  {
                session_destroy();
                unset($_SESSION[$name]);
            }
        }

    }
}