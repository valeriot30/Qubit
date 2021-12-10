<?php
/**
 * Created by PhpStorm.
 * User: Kaost
 * Date: 08/04/2020
 * Time: 17:56
 */

namespace App\Qubit\Filters
{
    class Sanitize
    {
        protected $form;

        /**
         * @var int
         */
        protected $filter = FILTER_DEFAULT;

        /**
         * @var array
         */
        protected $options = [];

        /**
         * @var array
         */
        protected $flags = [];

        /**
         * @param int $filter
         * @return $this
         */
        public function setFilter(int $filter)
        {
            $this->filter = $filter;
            return $this;
        }

        /**
         * @param string $email
         * @param int $filter
         * @return $this
         */
        public function email($email, $filter = FILTER_SANITIZE_EMAIL)
        {
            $this->setForm($email);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function encoded($variable, $filter = FILTER_SANITIZE_ENCODED)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function magicQuotes($variable, $filter = FILTER_SANITIZE_MAGIC_QUOTES)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function float($variable, $filter = FILTER_SANITIZE_NUMBER_FLOAT)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function int($variable, $filter = FILTER_SANITIZE_NUMBER_INT)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function specialChars($variable, $filter = FILTER_SANITIZE_SPECIAL_CHARS)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function fullSpecialChars($variable, $filter = FILTER_SANITIZE_FULL_SPECIAL_CHARS)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function string($variable, $filter = FILTER_SANITIZE_STRING)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function stripped($variable, $filter = FILTER_SANITIZE_STRIPPED)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $variable
         * @param int $filter
         * @return $this
         */
        public function url($variable, $filter = FILTER_SANITIZE_URL)
        {
            $this->setForm($variable);
            $this->setFilter($filter);

            return $this;
        }

        /**
         * @param $form
         * @return $this
         */
        public function setForm($form)
        {
            $this->form = $form;
            return $this;
        }

        /**
         * @return bool|mixed
         */
        public function sanitize()
        {
            return filter_var($this->form, $this->filter, ['options' => $this->options, 'flags' => $this->parseFlags($this->flags)]);
        }

        /**
         * @param array $options
         * @return $this
         */
        public function setOptions(array $options)
        {
            $this->options = $options;
            return $this;
        }

        /**
         * @param $option
         * @param $value
         * @return $this
         */
        public function setOption($option, $value)
        {
            $this->options[$option] = $value;
            return $this;
        }

        /**
         * @param array $flags
         * @return $this
         */
        public function setFlags(array $flags)
        {
            $this->flags = $flags;
            return $this;
        }

        /**
         * @param $flag
         * @return $this
         */
        public function setFlag($flag)
        {
            $this->flags[] = $flag;
            return $this;
        }

        /**
         * @param $flags
         * @return mixed
         */
        protected function parseFlags($flags)
        {
            if(count($flags) == 1)
            {
                return $flags[0];
            }

            return $flags;
        }

        /**
         * @param $email
         * @return mixed
         */
        public static function sanitizeEmail($email)
        {
            return filter_var($email, FILTER_SANITIZE_EMAIL);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeEncoded($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_ENCODED);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeMagicQuotes($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_MAGIC_QUOTES);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeFloat($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_NUMBER_FLOAT);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeInt($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_NUMBER_INT);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeSpecialChars($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_SPECIAL_CHARS);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeFullSpecialChars($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeString($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_STRING);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeStripped($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_STRIPPED);
        }

        /**
         * @param $variable
         * @return mixed
         */
        public static function sanitizeUrl($variable)
        {
            return filter_var($variable, FILTER_SANITIZE_URL);
        }
        /**
         * @param $variable
         * @return mixed
         */
    }
}