<?php


namespace Boom\Model\Orm;

use Illuminate\Database\Capsule\Manager;

class DbProvider
{

    private $db = null;
    private static $_instance = null;

    public function __construct()
    {
        $manager = new Manager();

        $manager->addConnection([
            'driver'    => 'mysql',
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASS,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ]);

        $manager->setAsGlobal();
        $manager->bootEloquent();

    }

    public static function getDb()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new DbProvider();
        }
        return self::$_instance->db;
    }

} 