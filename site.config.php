<?php
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

define('DS', DIRECTORY_SEPARATOR);
if (__DIR__ == '/var/www/html/Boom-Cms') {
    define('BASE_URL', '/Boom-Cms/');//spécial thomas qui bosse pas en virtual host :p
} else {
    define('BASE_URL', '/');
}

define('DB_HOST', '0.0.0.0');
define('DB_USER', 'boom_cms');
define('DB_PASS', 'boom_cms');
define('DB_NAME', 'boom_cms');

define('ENV', 'dev');//or prod

\Cake\Datasource\ConnectionManager::config('default', [
    'className' => 'Cake\Database\Connection',
    'driver'    => 'Cake\Database\Driver\Mysql',
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASS,
    'host'      => DB_HOST
]);

return $config;