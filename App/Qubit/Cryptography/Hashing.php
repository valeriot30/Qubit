<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 08/04/2020
 * Time: 17:48
 */

namespace App\Qubit\Cryptography
{
    class Hashing
    {
        protected $hashing = [];

        private $cost = 11;

        public function hash($data, $algorithm = 'md5')
        {
            return password_hash($data, $algorithm, ['cost' => $this->cost]);
        }
        public function passwordCrypt($data)
        {
            return password_hash($data, PASSWORD_BCRYPT, ['cost' => $this->cost]);
        }
        public static function random()
        {
            $i = 0;
            $random = "";
            while($i < 1):
                $i++;
                $random .= sha1(chr(mt_rand(0, 255)).md5(time()).$i);
            endwhile;

            return substr('QUBIT-'.$random, 0);
        }
    }
}