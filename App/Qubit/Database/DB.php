<?php

namespace App\Qubit\Database
{

    use App\Environment;
    use PDO;
    use PDOException;
    use ClanCats\Hydrahon\Builder;

    class DB
    {
        protected static $db;
        
        public function __construct()
        {
            self::$db = self::init();
        }
        public static function init()
        {
            try {
                $connection = new \PDO('mysql:host='.Environment::getConfig()['database']['hostname'].';dbname='.Environment::getConfig()['database']['db'].'', Environment::getConfig()['database']['user'], Environment::getConfig()['database']['password'], [
                    PDO::ATTR_TIMEOUT => 5,
                    PDO::ATTR_EMULATE_PREPARES => false,
                    PDO::ATTR_PERSISTENT => true,
                ]);

            }
            catch(PDOException $e)
            {
                die($e->getMessage());
            }

            return $connection;
        }

        public static function getDB()
        {
            $connection = self::$db;

            $db = new \ClanCats\Hydrahon\Builder('mysql', function($query, $queryString, $queryParameters) use($connection)
            {
                $statement = $connection->prepare($queryString);
                $statement->execute($queryParameters);

                if ($query instanceof \ClanCats\Hydrahon\Query\Sql\FetchableInterface)
                {
                    return $statement->fetchAll(\PDO::FETCH_ASSOC);
                }
            });

            return $db;
        }
    }
}