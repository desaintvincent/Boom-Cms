<?php


namespace Boom\Model\Orm;

use PDO;

class DbProvider
{

    private $db = null;
    private static $_instance = null;

    private function __construct()
    {
        try {
            $this->db = new PDO(
                'mysql:dbname=' . DB_NAME . ';host=' . DB_HOST,
                DB_USER,
                DB_PASS,
                [
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                ]
            );
        } catch (PDOException $e) {
            echo "Erreur de connexion à l abase de donnée";
        }
    }

    public static function getDb()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DbProvider();
        }
        return self::$_instance->db;
    }

} 