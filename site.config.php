<?php
function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = true;

define('DS', DIRECTORY_SEPARATOR);
if (__DIR__ == '/var/www/html/Boom-Cms') {
    define('BASE_URL', '/Boom-Cms/');//spécial thomas qui bosse pas en virtual host :p
} else {
    define('BASE_URL', '/');
}

if (endsWith($_SERVER['HTTP_HOST'], 'desaintvincent.com')) {

    define('DB_HOST', '0.0.0.0');
    define('DB_USER', 'kisaaaco_boom');
    define('DB_PASS', 'supermdpde0uF');
    define('DB_NAME', 'kisaaaco_boom_cms');
    define('ENV', 'preprod');
} else if (endsWith($_SERVER['HTTP_HOST'], 'dev') || endsWith($_SERVER['HTTP_HOST'], 'novius.fr:8082')) {
    define('DB_HOST', '0.0.0.0');
    define('DB_USER', 'boom_cms');
    define('DB_PASS', 'boom_cms');
    define('DB_NAME', 'boom_cms');
    define('ENV', 'dev');
} else {
    define('DB_HOST', 'tanmofrtuekimtan.mysql.db');
    define('DB_USER', 'tanmofrtuekimtan');
    define('DB_PASS', '5Dsw2FSrV9uU');
    define('DB_NAME', 'tanmofrtuekimtan');
    define('ENV', 'prod');
}

\Cake\Datasource\ConnectionManager::config('default', [
    'className' => 'Cake\Database\Connection',
    'driver'    => 'Cake\Database\Driver\Mysql',
    'database'  => DB_NAME,
    'username'  => DB_USER,
    'password'  => DB_PASS,
    'host'      => DB_HOST
]);

return $config;