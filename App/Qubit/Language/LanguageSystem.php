<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 01/02/2020
 * Time: 11:13
 */

namespace App\Qubit\Language
{
    use App\Environment;

    class LanguageSystem
    {
        /*
         * @var result : array
         */
        public function handle(): array
        {
            $result = NULL;

            if(Environment::getConfig()['site']['lang'] == '')
                $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
            else
                $lang = Environment::getConfig()['site']['lang'];

            $locale = dirname(__DIR__).'/Language/langs/'.$lang.'.php';

            if(file_exists($locale)) {
                require $locale;

                $result = $vars;
            }
            else {
                die('Sorry, locale file not found!');
            }

            return $result;
        }
    }
}